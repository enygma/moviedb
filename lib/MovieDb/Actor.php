<?php

namespace MovieDb;

class Actor extends \MovieDb\Base
{
    protected $properties = array(
        'adult' => array(
            'type' => 'string'
        ),
        'id' => array(
            'type' => 'integer'
        ),
        'name' => array(
            'type' => 'string'
        ),
        'popularity' => array(
            'type' => 'integer'
        ),
        'profile_path' => array(
            'type' => 'string'
        )
    );

    /**
     * Find the actor by the query
     * @param string $query Query string
     * @return array Result data (one or more actors)
     */
    public function find($query)
    {
        $result = $this->getSession()->request(
            '/3/search/person',
            array('query' => $query)
        );

        if (isset($result->results)) {
            if (count($result->results) == 1) {
                $this->load($result->results[0]);
            }
            return $result->results;
        } else {
            return array();
        }
    }

    /**
     * Get the "credits" for the actor
     * @param integer $actorId Unique Actor ID
     * @return Credit details
     */
    public function getCredits($actorId = null)
    {
        $actorId = ($actorId !== null) ? $actorId : $this->id;
        $result = $this->getSession()->request(
            '/3/person/'.$actorId.'/credits'
        );
        return (isset($result->cast)) ? $result->cast : array();
    }
}