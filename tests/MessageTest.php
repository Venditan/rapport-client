<?php
/**
 * MessageTest
 *
 * @author Tom Walder <tom@docnet.nu>
 */

class MessageTest extends \PHPUnit_Framework_TestCase
{

    public function testFull()
    {
        $str_title = "Hello";
        $str_body = "From 1885";
        $str_from = "ELB";
        $obj_message = new \Venditan\Rapport\Client\Message();
        $obj_message->title($str_title)->body($str_body)->from($str_from);
        $obj_data = $obj_message->compile();
        $this->assertEquals($obj_data, (object)[
            'title' => $str_title,
            'body' => $str_body,
            'from' => $str_from
        ]);
    }

    public function testEmpty()
    {
        $obj_message = new \Venditan\Rapport\Client\Message();
        $obj_data = $obj_message->compile();
        $this->assertEquals($obj_data, (object)[]);
    }

    public function testPartial()
    {
        $str_title = "Hello";
        $str_body = "From 1885";
        $obj_message = new \Venditan\Rapport\Client\Message();
        $obj_message->title($str_title)->body($str_body);
        $obj_data = $obj_message->compile();
        $this->assertEquals($obj_data, (object)[
            'title' => $str_title,
            'body' => $str_body
        ]);
    }

}