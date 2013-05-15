<?php

namespace MovieDb;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    private $session = null;

    public function setUp()
    {
        $client = new \stdClass();
        $this->session = new \MovieDb\Session($client);
    }

    /**
     * Test the getter/setter for the configuration value
     * @covers \MovieDb\Session::getConfig
     * @covers \MovieDb\Session::setConfig
     */
    public function testGetSetConfig()
    {
        $config = array('api_key' => 1234567890);
        $this->session->setConfig($config);
        $this->assertEquals(
            $config,
            $this->session->getConfig()
        );
    }

    /**
     * Test that the getter/setter for the token value works
     * @covers \MovieDb\Session::getToken
     * @covers \MovieDb\Session::setToken
     */
    public function testGetSetToken()
    {
        $token = md5('test');
        $this->session->setToken($token);
        $this->assertEquals(
            $token,
            $this->session->getToken()
        );
    }
}