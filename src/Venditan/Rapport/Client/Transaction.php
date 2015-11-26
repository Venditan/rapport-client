<?php
/**
 * Transaction representation - PHP Client for Venditan Rapport
 *
 * @author Tom Walder <tom@docnet.nu>
 */

namespace Venditan\Rapport\Client;

class Transaction
{

    /**
     * @var null|string
     */
    private $str_id = null;

    /**
     * Set the user id
     *
     * @param $str_id
     * @return $this
     */
    public function id($str_id)
    {
        $this->str_id = $str_id;
        return $this;
    }

    /**
     * Compile the data for transmission
     *
     * @return \stdClass
     */
    public function compile()
    {
        $obj_data = new \stdClass();
        if(null !== $this->str_id) {
            $obj_data->order_id = $this->str_id;
        }
        return $obj_data;
    }

}