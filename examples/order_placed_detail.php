<?php
/**
 * Order placed example
 */
require(__DIR__ . '/../vendor/autoload.php');

$obj_client = new \Venditan\Rapport\Client('test', 'api-key-goes-here-121gw');
$obj_client->addUser()->id('1955')->name('Marty')->email('marty@mcfly.com')->mobile('07019551985');

$obj_txn = $obj_client->addTransaction()->id('2015');
$obj_txn->addLine()->describe('T-shirt')->quantity(1);
$obj_txn->addLine()->describe('Jeans')->quantity(1);
$obj_txn->addLine()->describe('Trainers')->attribute('Size', '12')->attribute('Colour', 'Blue');

$obj_client->event('order_placed')->send();