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
    
    private $str_tracking_number = null;
    
    private $str_courier = null;

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
     * Set the tracking reference
     *
     * @param $str_tracking
     * @return $this
     */
    public function tracking($str_tracking)
    {
        $this->str_tracking_number = $str_tracking;
        return $this;
    }

    /**
     * Set the courier used to ship the order
     *
     * @param $str_courier
     * @return $this
     */
    public function courier($str_courier)
    {
        $this->str_courier = $str_courier;
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
        if(null !== $this->str_tracking_number) {
            $obj_data->tracking = $this->str_tracking_number;
        }
        if(null !== $this->str_courier) {
            $obj_data->courier = $this->str_courier;
        }
        return $obj_data;
    }

}