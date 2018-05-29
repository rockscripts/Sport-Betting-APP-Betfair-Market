<?php

namespace spec\Betfair\Client;

use Betfair\Client\BetfairGuzzleClient;
use Betfair\Client\BetfairJsonRpcClientInterface;
use Betfair\Credential\CredentialInterface;
use Betfair\Model\Param;
use GuzzleHttp\Message\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BetfairClientSpec extends ObjectBehavior
{
    public function let(CredentialInterface $credential, BetfairGuzzleClient $betfairHttpClient)
    {
        $this->beConstructedWith($credential, $betfairHttpClient);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Betfair\Client\BetfairClient');
    }

    public function it_do_sport_api_ng_request_with_authenticated_credentials(
        CredentialInterface $credential,
        BetfairGuzzleClient $betfairHttpClient,
        Param $param,
        Response $response
    ) {
        $operationName = 'listApiThing';

        $credential->isAuthenticated()->willReturn(true);
        $credential->getApplicationKey()->willReturn('app-key');
        $credential->getSessionToken()->willReturn('session-token');

        $expectedGuzzleParameters = array(
            "X-Application" => 'app-key',
            "X-Authentication" => 'session-token',
            'method' => "SportsAPING/v1.0/" . $operationName,
            'type' => 'betting',
            'params' => $param
        );

        $betfairHttpClient->apiNgRequest($expectedGuzzleParameters)
            ->shouldBeCalled()
            ->willReturn($response);

        $response->getBody()->shouldBeCalled()->willReturn('body response');

        $this->apiNgRequest($operationName, $param, "betting")->shouldReturn("body response");
    }

    public function it_authenticate_credentials(
        CredentialInterface $credential,
        BetfairGuzzleClient $betfairHttpClient,
        Response $response
    ) {
        $credential->getUsername()->shouldBeCalled()->willReturn('usr1');
        $credential->getPassword()->shouldBeCalled()->willReturn('pwd1');
        $credential->getApplicationKey()->shouldBeCalled()->willReturn('appkey');

        $expectedLoginGuzzleParameters = array(
            'X-Application' => 'appkey',
            'username' => 'usr1',
            'password' => 'pwd1'
        );

        $betfairHttpClient->betfairLogin($expectedLoginGuzzleParameters)
            ->shouldBeCalled()
            ->willReturn($response);

        $response->getStatusCode()->shouldBeCalled()->willReturn(200);
        $response->getBody()->shouldBeCalled()->willReturn(json_encode(array("status" => "SUCCESS", "token" => "12345")));

        $credential->setSessionToken("12345")->shouldBeCalled();
        $this->authenticateCredential();
    }

    public function it_raise_betfar_login_exception_when_user_authenticate_with_invalid_credentials(
        CredentialInterface $credential,
        BetfairGuzzleClient $betfairHttpClient,
        Response $response
    ) {
        $credential->getUsername()->shouldBeCalled()->willReturn('usr1');
        $credential->getPassword()->shouldBeCalled()->willReturn('pwd1');
        $credential->getApplicationKey()->shouldBeCalled()->willReturn('appkey');

        $expectedLoginGuzzleParameters = array(
            'username' => 'usr1',
            'password' => 'pwd1',
            'X-Application' => 'appkey'
        );

        $betfairHttpClient->betfairLogin($expectedLoginGuzzleParameters)
            ->shouldBeCalled()
            ->willReturn($response);

        $response->getStatusCode()->shouldBeCalled()->willReturn(200);
        $response->getBody()->shouldBeCalled()->willReturn(json_encode(array("status" => "FAILED")));

        $this->shouldThrow('Betfair\Exception\BetfairLoginException')->
            duringAuthenticateCredential();
    }

    public function it_raise_betfar_login_exception_when_response_not_have_a_valid_body(
        CredentialInterface $credential,
        BetfairGuzzleClient $betfairHttpClient,
        Response $response
    ) {
        $credential->getUsername()->shouldBeCalled()->willReturn('usr1');
        $credential->getPassword()->shouldBeCalled()->willReturn('pwd1');
        $credential->getApplicationKey()->shouldBeCalled()->willReturn('appkey');

        $expectedLoginGuzzleParameters = array(
            'username' => 'usr1',
            'password' => 'pwd1',
            'X-Application' => 'appkey'
        );

        $betfairHttpClient->betfairLogin($expectedLoginGuzzleParameters)
            ->shouldBeCalled()
            ->willReturn($response);

        $response->getStatusCode()->shouldBeCalled()->willReturn(200);
        $response->getBody()->shouldBeCalled()->willReturn(null);

        $this->shouldThrow('Betfair\Exception\BetfairLoginException')->
            duringAuthenticateCredential();
    }

    public function it_raise_betfar_login_exception_when_response_not_have_a_200_status_code(
        CredentialInterface $credential,
        BetfairGuzzleClient $betfairHttpClient,
        Response $response
    ) {
        $credential->getUsername()->shouldBeCalled()->willReturn('usr1');
        $credential->getPassword()->shouldBeCalled()->willReturn('pwd1');
        $credential->getApplicationKey()->shouldBeCalled()->willReturn('appkey');

        $expectedLoginGuzzleParameters = array(
            'username' => 'usr1',
            'password' => 'pwd1',
            'X-Application' => 'appkey'
        );

        $betfairHttpClient->betfairLogin($expectedLoginGuzzleParameters)
            ->shouldBeCalled()
            ->willReturn($response);

        $response->getStatusCode()->shouldBeCalled()->willReturn(401);
        $response->getBody()->shouldNotBeCalled();

        $this->shouldThrow('Betfair\Exception\BetfairLoginException')->
            duringAuthenticateCredential();
    }
}
