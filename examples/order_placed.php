<?php
/**
 * Order placed example
 */
require(__DIR__ . '/../vendor/autoload.php');

$obj_client = new \Venditan\Rapport\Client('test', 'api-key-goes-here-121gw');
$obj_client->addUser()->id('1955')->name('Marty')->email('marty@mcfly.com')->mobile('07019551985');
$obj_client->addTransaction()->id('2015');
$obj_client->event('order_placed')->send();