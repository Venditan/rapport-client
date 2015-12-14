<?php
/**
 * Get a transaction thread
 */
require(__DIR__ . '/../vendor/autoload.php');

$obj_client = new \Venditan\Rapport\Client('test', 'api-key-goes-here-121gw');
$obj_thread = $obj_client->getThreadForTransaction('abc123');