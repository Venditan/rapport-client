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

    public function testMessage()
    {
        $str_client = 'test';
        $str_api_key = '123test';
        $str_event = 'service_message';
        $str_title = "Hello";
        $str_body = "From 1885";
        $str_from = "ELB";
        $obj_client = new \Venditan\Rapport\Client($str_client, $str_api_key);
        $obj_client->addMessage()->title($str_title)->body($str_body)->from($str_from);
        $obj_data = $obj_client->event($str_event)->compile();
        $this->assertEquals((object)[
            'client' => $str_client,
            'key' => $str_api_key,
            'event' => $str_event,
            'message' => (object)[
                'title' => $str_title,
                'body' => $str_body,
                'from' => $str_from
            ]
        ], $obj_data);
    }

}