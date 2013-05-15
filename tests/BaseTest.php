<?php

namespace MovieDb;

require_once 'MockModel.php';

class BaseTest extends \PHPUnit_Framework_TestCase
{
    private $model = null;

    public function setUp()
    {
        $client = new \stdClass();
        $session = new \MovieDb\Session($client);
        $this->model = new \MovieDb\MockModel($session);
    }

    /**
     * Test the getter/setter for properties
     * @covers \MovieDb\Base::getProperties
     * @covers \MovieDb\Base::setProperties
     */
    public function testGetSetProperties()
    {
        $prop = array(
            'testing' => array(
                'type' => 'string'
            )
        );

        $this->model->setProperties($prop);
        $this->assertEquals(
            $prop,
            $this->model->getProperties()
        );
    }

    /**
     * Test that the data load works correctly with valid data
     * @covers \MovieDb\Base::load
     */
    public function testLoadValidData()
    {
        $id = 12345;
        $title = 'this is a test';

        $data = array(
            'id' => $id,
            'title' => $title
        );
        $this->model->load($data);
        $this->assertTrue(
            $this->model->id === $id && $this->model->title = $title
        );
    }

    /**
     * Test that the getter/setter for sessions is working correctly
     * @covers \MovieDb\Base::getSession
     * @covers \MovieDb\Base::setSession
     */
    public function testGetSetSession()
    {
        $client = new \stdClass();
        $session = new \MovieDb\Session(
            $client,
            array('api_key' => '1234567890')
        );

        $this->model->setSession($session);
        $this->assertEquals(
            $session,
            $this->model->getSession()
        );
    }
}