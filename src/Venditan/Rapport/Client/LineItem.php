<?php
/**
 * Transaction line item representation - PHP Client for Venditan Rapport
 *
 * @author Tom Walder <tom@docnet.nu>
 */

namespace Venditan\Rapport\Client;

class LineItem
{

    private $str_description = null;

    private $str_image = null;

    private $int_quantity = null;

    private $arr_attributes = [];

    /**
     * Describe the line
     *
     * @param $str_description
     * @return $this
     */
    public function describe($str_description)
    {
        $this->str_description = $str_description;
        return $this;
    }

    /**
     * Set the image for the line
     *
     * @param $str_image
     * @return $this
     */
    public function image($str_image)
    {
        $this->str_image = $str_image;
        return $this;
    }

    /**
     * Set the quantity
     *
     * @param $int_quantity
     * @return $this
     */
    public function quantity($int_quantity)
    {
        $this->int_quantity = $int_quantity;
        return $this;
    }

    /**
     * Add an attribute
     *
     * @param $str_key
     * @param $str_value
     * @return $this
     */
    public function attribute($str_key, $str_value)
    {
        $this->arr_attributes[] = [$str_key, $str_value];
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
        if(null !== $this->str_description) {
            $obj_data->description = $this->str_description;
        }
        if(null !== $this->str_image) {
            $obj_data->image = $this->str_image;
        }
        if(null !== $this->int_quantity) {
            $obj_data->qty = $this->int_quantity;
        }
        if(count($this->arr_attributes) > 0) {
            $obj_data->attributes = [];
            foreach($this->arr_attributes as $arr_attribute) {
                $obj_data->attributes[] = (object)[$arr_attribute[0] => $arr_attribute[1]];
            }
        }
        return $obj_data;
    }

}