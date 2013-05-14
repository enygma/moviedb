<?php

namespace MovieDb;

abstract class Base
{
    /**
     * Object properties
     * @var array
     */
    protected $propertes = array();

    /**
     * Object values
     * @var array
     */
    protected $values = array();

    /**
     * Current object's session
     * @var \MovieDb\Session
     */
    protected $session = null;

    /**
     * Create the object with the given session
     * @param \MovieDb\Session $session Current session
     */
    public function __construct(\MovieDb\Session $session)
    {
        $this->setSession($session);
    }

    /**
     * Load the data into the object based on properties/values
     * @param array|object $data Data to load
     * @return boolean True when method finishes
     */
    public function load($data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        $properties = $this->getProperties();
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $properties)) {
                $this->values[$key] = $value;
            }
        }
        return true;
    }

    /**
     * Magic setter for property values
     * @param string $name Property name
     * @return mixed Value if found, null if not
     */
    public function __get($name)
    {
        return (isset($this->values[$name])) ? $this->values[$name] : null;
    }

    /**
     * Magic setter for property values
     * @param string $name Property name
     */
    public function __set($name, $value)
    {
        $this->values[$name] = $value;
    }

    /**
     * Set the current object's session
     * @param \MovieDb\Session $session object
     */
    public function setSession(\MovieDb\Session $session)
    {
        $this->session = $session;
    }

    /**
     * Get the current object's session
     * @return \MovieDb\Sesssion object
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Get the object's current properties
     * @return array Current properties
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set the properties of the object
     * @param array $properties Properties definition
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;
    }
}