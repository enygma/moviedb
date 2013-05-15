<?php

namespace MovieDb;

class MockModel extends \MovieDb\Base
{
    protected $properties = array(
        'id' => array(
            'type' => 'integer'
        ),
        'title' => array(
            'type' => 'string'
        )
    );
}