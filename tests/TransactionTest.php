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
        $str_notes = 'Delivery by hand';
        $str_address = '123 Street, Town, County';
        $obj_txn
            ->id($str_id)
            ->courier($str_courier)
            ->tracking($str_tracking)
            ->notes($str_notes)
            ->deliverTo($str_address);
        $obj_data = $obj_txn->compile();
        $this->assertEquals($obj_data, (object)[
            'order_id' => $str_id,
            'tracking' => $str_tracking,
            'courier' => $str_courier,
            'notes' => $str_notes,
            'deliver_to' => $str_address
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

    public function testLinePartial()
    {
        $obj_txn = new \Venditan\Rapport\Client\Transaction();
        $str_id = "123";
        $str_courier = "Royal Mail";
        $str_tracking = "ABC123";
        $obj_txn->id($str_id)->courier($str_courier)->tracking($str_tracking);

        $str_line_desc = 'T-shirt';
        $obj_txn->addLine()->describe($str_line_desc);

        $obj_data = $obj_txn->compile();
        $this->assertEquals($obj_data, (object)[
            'order_id' => $str_id,
            'tracking' => $str_tracking,
            'courier' => $str_courier,
            'lines' => [
                (object)[
                    'description' => $str_line_desc
                ]
            ]
        ]);
    }

    public function testLineFull()
    {
        $obj_txn = new \Venditan\Rapport\Client\Transaction();
        $str_id = "123";
        $str_courier = "Royal Mail";
        $str_tracking = "ABC123";
        $obj_txn->id($str_id)->courier($str_courier)->tracking($str_tracking);

        $str_line_desc = 'T-shirt';
        $obj_txn->addLine()
            ->describe($str_line_desc)
            ->quantity(5)
            ->image('http://a.b.c/d.jpg')
            ->attribute('Colour', 'Red')
            ->attribute('Size', '12');

        $obj_data = $obj_txn->compile();
        $this->assertEquals($obj_data, (object)[
            'order_id' => $str_id,
            'tracking' => $str_tracking,
            'courier' => $str_courier,
            'lines' => [
                (object)[
                    'description' => $str_line_desc,
                    'qty' => 5,
                    'image' => 'http://a.b.c/d.jpg',
                    'attributes' => [
                        (object)['Colour' => 'Red'],
                        (object)['Size' => '12']
                    ]

                ]
            ]
        ]);
    }

}