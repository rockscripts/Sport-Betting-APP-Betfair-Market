<?php defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Authentication Class
 *
 * Very basic user authentication for CodeIgniter.
 * 
 * @package		Authentication
 * @version		1.0
 * @author		Joel Vardy <info@joelvardy.com>
 * @link		https://github.com/joelvardy/Basic-CodeIgniter-Authentication
 */
class Authentication {


	/**
	 * CodeIgniter
	 *
	 * @access	private
	 */
	private $ci;


	/**
	 * Config items
	 *
	 * @access	private
	 */
	private $user_table;
	private $identifier_field;
	private $username_field;
	private $password_field;


	/**
	 * Constructor
	 */
	function __construct()
	{

		// Assign CodeIgniter object to $this->ci
		$this->ci =& get_instance();

		// Load config
		$this->ci->config->load('authentication');
		$authentication_config = $this->ci->config->item('authentication');

		// Set config items
		$this->user_table = $authentication_config['user_table'];
		$this->identifier_field = $authentication_config['identifier_field'];
		$this->username_field = $authentication_config['username_field'];
		$this->password_field = $authentication_config['password_field'];

		// Load database
		$this->ci->load->database();

		// Load libraries
		$this->ci->load->library('session');

	}


	/**
	 * Check whether the username is unique
	 *
	 * @access	public
	 * @param	string [$username] The username to query
	 * @return	boolean
	 */
	public function username_check($username)
	{

		// Read users where username matches
		$query = $this->ci->db->where($this->username_field, $username)->get($this->user_table);

		// If there are users
		if ($query->num_rows() > 0)
		{
			// Username is not available
			return FALSE;
		}

		// No users were found
		return TRUE;

	}


	/**
	 * Generate a salt
	 *
	 * @access	protected
	 * @param	integer [$cost] The strength of the resulting hash, must be within the range 04-31
	 * @return	string The generated salt
	 */
	protected function generate_salt($cost = 16)
	{

		// We are using blowfish, so this must be set at the beginning of the salt
		$salt = '$2a$'.$cost.'$';

		// Generate a random string based on time
		$salt .= substr(str_replace('+', '.', base64_encode(sha1(microtime(TRUE), TRUE))), 0, 22);

		// Return salt
		return $salt.'$';

	}


	/**
	 * Generate a hash
	 *
	 * @access	protected
	 * @param	string [$password] The password for which the hash should be generated for
	 * @param	string [$salt] The salt can either be the one returned from the generate_salt method or the current password
	 * @return	string The generated hash
	 */
	protected function generate_hash($password, $salt)
	{

		// Hash the generated details with a salt to form a secure password hash
		return crypt($password, $salt);

	}


	/**
	 * Create user
	 *
	 * @access	public
	 * @param	string [$username] The username of the user to be created
	 * @param	string [$password] The users password
	 * @return	integer|boolean Either the user ID or FALSEupon failure
	 */
	public function create_user($username, $password)
	{

		// Ensure username is available
		if ( ! $this->username_check($username))
		{
			// Username is not available
			return FALSE;
		}

		// Generate salt
		$salt = $this->generate_salt();

		// Generate hash
		$password = $this->generate_hash($password, $salt);

		// Define data to insert
		$data = array(
			$this->username_field => $username,
			$this->password_field => $password
		);

		// If inserting data fails
		if ( ! $this->ci->db->insert($this->user_table, $data))
		{
			// Return false
			return FALSE;
		}

		// Return user ID
		return (int) $this->ci->db->insert_id();

	}


	/**
	 * Login
	 *
	 * @access	public
	 * @param	string [$username] The username of the user to authenticate
	 * @param	string [$password] The password to authenticate
	 * @return	boolean Either TRUE or FALSE depending upon successful login
	 */
	public function login($username, $password)
	{

		// Select user details
		$user = $this->ci->db
			->select($this->identifier_field.' as identifier, '.$this->username_field.' as username, '.$this->password_field.' as password')
			->where($this->username_field, $username)
			->get($this->user_table);

		// Ensure there is a user with that username
		if ($user->num_rows() == 0)
		{
			// There is no user with that username, but we won't tell the user that
			return FALSE;
		}

		// Set the user details
		$user_details = $user->row();

		// Do passwords match
		if ($this->generate_hash($password, $user_details->password) == $user_details->password)
		{

			// Yes, the passwords match

			// Set the userdata for the current user
			$this->ci->session->set_userdata(array(
				'identifier' => $user_details->identifier,
				'username' => $user_details->username,
				'logged_in' => $_SERVER['REQUEST_TIME']
			));

			return TRUE;

		// The passwords don't match
		} else {
			// The passwords don't match, but we won't tell the user that
			return FALSE;
		}

	}


	/**
	 * Check whether a user is logged in
	 *
	 * @access	public
	 * @return	boolean TRUE for a logged in user otherwise FALSE
	 */
	public function is_loggedin()
	{

		// Return true or flase based on the presence of user data
		return (bool) $this->ci->session->userdata('identifier');

	}


	/**
	 * Read user details
	 *
	 * @access	public
	 * @return	mixed or FALSE
	 */
	public function read($key)
	{

		// Only allow us to read certain data
		switch ($key)
		{
			case 'identifier': {

				// If the user is not logged in return false
				if ( ! $this->is_loggedin()) return false;

				// Return user identifier
				return (int) $this->ci->session->userdata('identifier');

				break;

			}
			case 'username': {

				// If the user is not logged in return false
				if ( ! $this->is_loggedin()) return false;

				// Return username
				return (string) $this->ci->session->userdata('username');

				break;

			}
			case 'login': {

				// If the user is not logged in return false
				if ( ! $this->is_loggedin()) return false;

				// Return time the user logged in at
				return (int) $this->ci->session->userdata('logged_in');

				break;

			}
			case 'logout': {

				// Return time the user logged out at
				return (int) $this->ci->session->userdata('logged_out');

				break;

			}
		}

		// If nothing has been returned yet
		return false;

	}


	/**
	 * Change password
	 *
	 * @access	public
	 * @param	string [$password] The new password
	 * @param	string [$user_identifier] The identifier of the user whos password will be changed, if none is set the current users password will be changed
	 * @return	boolean Either TRUE or FALSE depending upon successful login
	 */
	public function change_password($password, $user_identifier = null)
	{

		// If no user identifier has been set
		if ( ! $user_identifier)
		{
			// Ensure the current user is logged in
			if ($this->is_loggedin())
			{

				// Read the user identifier
				$user_identifier = $this->ci->session->userdata('identifier');

			// There is no current logged in user
			} else {
				return FALSE;
			}
		}

		// Generate salt
		$salt = $this->generate_salt();

		// Generate hash
		$password = $this->generate_hash($password, $salt);

		// Define data to update
		$data = array(
			$this->password_field => $password
		);

		// Update the users password
		if ($this->ci->db->where($this->identifier_field, $user_identifier)->update($this->user_table, $data))
		{
			return TRUE;
		// There was an error updating the user
		} else {
			return FALSE;
		}

	}


	/**
	 * Log a user out
	 *
	 * @access	public
	 * @return	boolean Will always return TRUE
	 */
	public function logout()
	{

		// Remove userdata
		$this->ci->session->unset_userdata('identifier');
		$this->ci->session->unset_userdata('username');
		$this->ci->session->unset_userdata('logged_in');

		// Set logged out userdata
		$this->ci->session->set_userdata(array(
			'logged_out' => $_SERVER['REQUEST_TIME']
		));

		// Return true
		return TRUE;

	}


	/**
	 * Delete user account
	 *
	 * @access	public
	 * @param	string [$user_identifier] The identifier of the user to delete
	 * @return	boolean Either TRUE or FALSE depending upon successful login
	 */
	public function delete_user($user_identifier)
	{

		// Update the users password
		if ($this->ci->db->where($this->identifier_field, $user_identifier)->delete($this->user_table))
		{
			return TRUE;
		// There was an error deleting the user
		} else {
			return FALSE;
		}

	}


}

/* End of file Authentication.php */
/* Location: ./application/libraries/Authentication.php */