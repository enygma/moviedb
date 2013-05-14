<?php
session_start();
require_once 'vendor/autoload.php';

$config = array(
    'api_key' => '88bb5aede443ad4d861fe5b51dedc1df'
);
$client = new \Guzzle\Http\Client('http://api.themoviedb.org');
$actor = new \MovieDb\Actor($config, $client);

try {
    $results = $actor->find('Bill Murray');
    print_r($results);

} catch (\Exception $e) {
    echo 'ERROR: '.$e->getMessage().'<br/>';
}