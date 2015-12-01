<?php
/**
 * TransactionTest
 *
 * @author Tom Walder <tom@docnet.nu>
 */

class TransactionTest extends \PHPUnit_Framework_TestCase
{

    public function testFull()
    {
        $obj_txn = new \Venditan\Rapport\Client\Transaction();
        $str_id = "123";
        $str_courier = "Royal Mail";
        $str_tracking = "ABC123";
        $obj_txn->id($str_id)->courier($str_courier)->tracking($str_tracking);
        $obj_data = $obj_txn->compile();
        $this->assertEquals($obj_data, (object)[
            'order_id' => $str_id,
            'tracking' => $str_tracking,
            'courier' => $str_courier
        ]);
    }

    public function testEmpty()
    {
        $obj_txn = new \Venditan\Rapport\Client\Transaction();
        $obj_data = $obj_txn->compile();
        $this->assertEquals($obj_data, (object)[]);
    }

    public function testPartial()
    {
        $obj_txn = new \Venditan\Rapport\Client\Transaction();
        $str_id = "123";
        $obj_txn->id($str_id);
        $obj_data = $obj_txn->compile();
        $this->assertEquals($obj_data, (object)[
            'order_id' => $str_id
        ]);
    }

}