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

    private $str_delivery_address = null;

    private $str_estimated_delivery = null;

    private $str_notes = null;

    /**
     * @var LineItem[]
     */
    private $arr_lines = [];

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
     * Set the delivery address description
     *
     * @param $str_address
     * @return $this
     */
    public function deliverTo($str_address)
    {
        $this->str_delivery_address = $str_address;
        return $this;
    }

    /**
     * Set the estimated delivery date
     *
     * @param $str_estimated_delivery
     * @return $this
     */
    public function estimatedDelivery($str_estimated_delivery)
    {
        $this->str_estimated_delivery = $str_estimated_delivery;
        return $this;
    }

    /**
     * Set any order notes
     *
     * @param $str_notes
     * @return $this
     */
    public function notes($str_notes)
    {
        $this->str_notes = $str_notes;
        return $this;
    }

    /**
     * Create and return a LineItem
     *
     * @return LineItem
     */
    public function addLine()
    {
        $obj_line = new LineItem();
        $this->arr_lines[] = $obj_line;
        return $obj_line;
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
        if(null !== $this->str_notes) {
            $obj_data->notes = $this->str_notes;
        }
        if(null !== $this->str_delivery_address) {
            $obj_data->deliver_to = $this->str_delivery_address;
        }
        if(null !== $this->str_estimated_delivery) {
            $obj_data->estimated_delivery = $this->str_estimated_delivery;
        }
        if(count($this->arr_lines) > 0) {
            $obj_data->lines = [];
            foreach($this->arr_lines as $obj_line) {
                $obj_data->lines[] = $obj_line->compile();
            }
        }
        return $obj_data;
    }

}