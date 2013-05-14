<?php
session_start();
require_once '../vendor/autoload.php';

$client = new \Guzzle\Http\Client('http://api.themoviedb.org');

$session = new \MovieDb\Session($client);
$session->setConfig(array('api_key' => '88bb5aede443ad4d861fe5b51dedc1df'));
$token = $session->authenticate();

header('Location: https://www.themoviedb.org/authenticate/'.$token);