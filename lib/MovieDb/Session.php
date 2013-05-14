<?php

namespace MovieDb;

class Session
{
    /**
     * Currnt HTTP client
     * @var object
     */
    private $client = null;

    /**
     * Object configuration
     * @var arraygo 
     */
    private $config = array();

    /**
     * Init the object with the client and configuration
     * @param object $client HTTP client object
     * @param array $config Configuration array
     */
    public function __construct($client, array $config = null)
    {
        $this->setClient($client);
        if ($config !== null) {
            $this->setConfig($config);
        }
    }

    /**
     * Magic getter method for session properties
     * @param string $name Property name
     * @return mixed Data or null if not found
     */
    public function __get($name)
    {
        return (isset($_SESSION[$name])) ? $_SESSION[$name] : null;
    }

    /**
     * Magic setter for the session properties
     * @param string $name Property name
     * @param mixed $value Property value
     */
    public function __set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Set the current HTTP client
     * @param object $client HTTP client object
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * Get current HTTP client
     * @return object
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Get the current session token
     * @return string Token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the current session token
     * @param string $token Token string
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Set the current session's configuration
     * @param array $config Configuration array
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * Get the current configuration (or a specific key)
     * @param string $key Key to locate [optional]
     * @return mixed Value of key if found, all config if not
     */
    public function getConfig($key = null)
    {
        return (array_key_exists($key, $this->config))
            ? $this->config[$key] : $this->config;
    }

    /**
     * Using our token ID, get the Request Token
     *     to use for the user permissioning of the API requests
     * @return string Request Token
     */
    public function authenticate()
    {
        $apiKey = $this->getConfig('api_key');
        $url = '/3/authentication/token/new?'.http_build_query(
            array('api_key' => $apiKey)
        );
        error_log('url: '.$url);

        $request = $this->getClient()->get($url);
        $response = $request
            ->setHeader('Accept', 'application/json')
            ->send();
        $body = json_decode($response->getBody(true));
        $token = $body->request_token;
        $this->token = $token;

        return $token;
    }

    /**
     * Generic request method given URL and params
     * @param string $url URL to request
     * @param array $params Additional parameters to send [optional]
     * @return object JSON object of response
     */
    public function request($url, array $params = null)
    {
        $client = $this->getClient();
        $baseParams = array(
            'api_key' => $this->getConfig('api_key'),
            'request_token' => $this->getToken()
        );

        if ($params !== null) {
            $params = array_merge($baseParams, $params);
        } else {
            $params = $baseParams;
        }

        $url = $url.'?'.http_build_query($params);

        $request = $this->getClient()->get($url);
        $response = $request
            ->setHeader('Accept', 'application/json')
            ->send();
        $body = json_decode($response->getBody(true));
        return $body;
    }
}
