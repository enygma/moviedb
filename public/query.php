<?php
session_start();

require_once '../vendor/autoload.php';

$query = $_GET['query'];
$type = $_GET['type'];
$results = array();

$session = new \MovieDb\Session(
    new \Guzzle\Http\Client('http://api.themoviedb.org'),
    array('api_key' => $_SERVER['API_KEY'])
);

try {
    switch (strtoupper($type)) {
        case 'ACTOR':
            $actor = new \MovieDb\Actor($session);
            $results = $actor->find($query);
            if (count($results) == 1) {
                $credits = $actor->getCredits();
                $results = $credits;

                // sort them on the "release_date"
                usort($results, function($credit1, $credit2) {
                    $dt1 = strtotime($credit1->release_date);
                    $dt2 = strtotime($credit2->release_date);

                    return ($dt1 > $dt2) ? +1 : -1;
                });
            }
            break;
        case 'MOVIE':
            // We're finding the move by ID here
            $movie = new \MovieDb\Movie($session);
            $results = $movie->findById($query);
            break;
    }
} catch (\Exception $e) {
    $results = array(
        'status' => 'error',
        'message' => $e->getMessage()
    );
}

echo json_encode($results);
