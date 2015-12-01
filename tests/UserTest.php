<?php
/**
 * UserTest
 *
 * @author Tom Walder <tom@docnet.nu>
 */

class UserTest extends \PHPUnit_Framework_TestCase
{

    public function testFull()
    {
        $str_id = "1955";
        $str_name = "Marty";
        $str_email = "marty@mcfly.com";
        $str_mobile = "07719551985";
        $obj_user = new \Venditan\Rapport\Client\User();
        $obj_user->id($str_id)->name($str_name)->email($str_email)->mobile($str_mobile);
        $obj_data = $obj_user->compile();
        $this->assertEquals($obj_data, (object)[
            'user_id' => $str_id,
            'name' => $str_name,
            'email' => $str_email,
            'mobile' => $str_mobile
        ]);
    }

    public function testEmpty()
    {
        $obj_user = new \Venditan\Rapport\Client\User();
        $obj_data = $obj_user->compile();
        $this->assertEquals($obj_data, (object)[]);
    }

    public function testPartial()
    {
        $str_id = "1955";
        $obj_user = new \Venditan\Rapport\Client\User();
        $obj_user->id($str_id);
        $obj_data = $obj_user->compile();
        $this->assertEquals($obj_data, (object)[
            'user_id' => $str_id
        ]);
    }

}