<?php
/**
 * Service message example
 */
require(__DIR__ . '/../vendor/autoload.php');

$obj_client = new \Venditan\Rapport\Client('test', 'api-key-goes-here-121gw');
$obj_client->addMessage()->title('Order Update')->body('Hi Marty. I have your order ready to ship.')->from('Emmett');
$obj_client->event('service_message')->send();