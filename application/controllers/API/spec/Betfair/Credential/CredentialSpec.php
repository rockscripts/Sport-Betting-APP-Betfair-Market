<?php

namespace spec\Betfair\Credential;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CredentialSpec extends ObjectBehavior
{
    public function let()
    {
        $applicationKey = '5s4a5';
        $username = 'daniele';
        $password = 'pippo';

        $this->beConstructedWith($applicationKey, $username, $password);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Betfair\Credential\Credential');
        $this->shouldImplement('Betfair\Credential\CredentialInterface');
    }

    public function it_is_have_getPassword()
    {
        $this->getPassword()->shouldReturn('pippo');
    }

    public function it_is_have_getUsername()
    {
        $this->getUsername()->shouldReturn('daniele');
    }

    public function it_is_have_getApplicationKey()
    {
        $this->getApplicationKey()->shouldReturn('5s4a5');
    }
}
