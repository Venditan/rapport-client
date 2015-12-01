<?php
/**
 * ClientTest
 *
 * @author Tom Walder <tom@docnet.nu>
 */

class ClientTest extends \PHPUnit_Framework_TestCase
{

    public function testBasic()
    {
        $str_client = 'test';
        $str_api_key = '123test';
        $str_event = 'some_event';
        $obj_client = new \Venditan\Rapport\Client($str_client, $str_api_key);
        $obj_client->event($str_event);
        $obj_data = $obj_client->compile();
        $this->assertEquals((object)[
            'client' => $str_client,
            'key' => $str_api_key,
            'event' => $str_event
        ], $obj_data);
    }

}