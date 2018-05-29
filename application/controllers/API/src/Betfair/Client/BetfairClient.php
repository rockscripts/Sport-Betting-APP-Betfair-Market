<?php
/**
 * This file is part of the Betfair library.
 *
 * (c) Daniele D'Angeli <dangeli88.daniele@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Betfair\Client;

use Betfair\BetfairActionType;
use Betfair\Credential\CredentialInterface;
use Betfair\Exception\BetfairLoginException;
use Betfair\Model\ParamInterface;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Operation;
use GuzzleHttp\Message\Response;

class BetfairClient implements BetfairClientInterface
{
    const LOGIN_ENDPOINT = "https://identitysso.betfair.com/api/login";

    /** @var \Betfair\Credential\CredentialInterface  */
    protected $credential;

    /** @var  GuzzleClient $client */
    protected $betfairGuzzleClient;

    public function __construct(CredentialInterface $credential, BetfairGuzzleClient $guzzleClient)
    {
        $this->credential = $credential;
        $this->betfairGuzzleClient = $guzzleClient;
    }

    /**
     * @param $operationName operation name
     * @param ParamInterface $param Param to be serialized in the request
     * @param string $type
     * @return string $bodyString
     */
    public function apiNgRequest($operationName, ParamInterface $param, $type = "betting")
    {
        $requestParameters = array_merge(
                $this->getDefaultAuthHeaderArray(),
                $this->builtJsonRpcArrayParameters($operationName, $param, $type),
                array("type" => $type)
        );

        $response = $this->betfairGuzzleClient->apiNgRequest(
            $requestParameters
        );

        return $response->getBody();
    }

    private function builtJsonRpcArrayParameters($operationName, ParamInterface $param, $type)
    {
        $methodName = $type === BetfairActionType::BETTING ? "SportsAPING" : "AccountAPING";
        $jsonRpcArrayParameters = array();
        $jsonRpcArrayParameters['method'] = $methodName . "/v1.0/" . $operationName;
        $jsonRpcArrayParameters['params'] = $param;

        return $jsonRpcArrayParameters;
    }

    /**
     * Login and set the sessionToken in Credential object
     */
    public function authenticateCredential()
    {
        $sessionToken = $this->login();
        $this->credential->setSessionToken($sessionToken);
    }

    /**
     * @return string $sessionToken
     * @throws \Betfair\Exception\BetfairLoginException
     */
    private function login()
    {
        /** @var Response $result */
        $result = $this->betfairGuzzleClient->betfairLogin($this->builtLoginArrayParameters());

        if ($result && $result->getStatusCode() == 200) {
            return $this->extractSessionTokenFromResponseBody($result->getBody());
        }

        throw new BetfairLoginException(sprintf("Error during credentials verification."));
    }


    private function getDefaultAuthHeaderArray()
    {
        if (!$this->credential->isAuthenticated()) {
            $this->authenticateCredential();
        }

        return array(
            "X-Application" => $this->credential->getApplicationKey(),
            "X-Authentication" => $this->credential->getSessionToken()
        );
    }

    private function builtLoginArrayParameters()
    {
        return array(
            'X-Application' => $this->credential->getApplicationKey(),
            'username' => $this->credential->getUsername(),
            'password' => $this->credential->getPassword()
        );
    }

    private function extractSessionTokenFromResponseBody($responseBody)
    {
        $bodyArray = json_decode($responseBody, true);

        if (isset($bodyArray["status"]) && $bodyArray["status"] == "SUCCESS") {
            return $bodyArray["token"];
        }

        throw new BetfairLoginException(sprintf("Error during credentials verification."));
    }
}
