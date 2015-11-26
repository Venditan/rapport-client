# PHP Client Library for Venditan Rapport #

http://www.venditan.com/rapport

## Install with Composer ##

```bash
composer require venditan/rapport-client dev-master
```

## Example Usage ##

```php
// Create the client with your supplied client id and api key
$obj_client = new \Venditan\Rapport\Client('company', 'api-key');

// Add and configure the target recipient/user
$obj_client->addUser()->id('1955')->name('Marty')->email('marty@mcfly.com')->mobile('07019551985');

// Set-up the transaction
$obj_client->addTransaction()->id('2015');

// Set the type of event and publish
$obj_client->event('order_placed')->send();
```