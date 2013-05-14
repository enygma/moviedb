<?php

namespace MovieDb;

class Movie extends \MovieDb\Base
{
    protected $properties = array(
        'original_title' => array(
            'type' => 'string'
        ),
        'id' => array(
            'type' => 'id'
        ),
        'overview' => array(
            'type' => 'string'
        )
    );

    /**
     * Find the Movie by unique ID
     * @param integer $movieId Movie unique ID
     * @return array Movie data
     */
    public function findById($movieId)
    {
        $result = $this->getSession()->request(
            '/3/movie/'.$movieId
        );
        return $result;
    }
}