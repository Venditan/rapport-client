<?php
/**
 * User representation - PHP Client for Venditan Rapport
 *
 * @author Tom Walder <tom@docnet.nu>
 */

namespace Venditan\Rapport\Client;

class User
{

    /**
     * @var null|string
     */
    private $str_id = null;

    /**
     * @var null|string
     */
    private $str_name = null;

    /**
     * @var null|string
     */
    private $str_email = null;

    /**
     * @var null|string
     */
    private $str_mobile = null;

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
     * Set the user name
     *
     * @param $str_name
     * @return $this
     */
    public function name($str_name)
    {
        $this->str_name = $str_name;
        return $this;
    }

    /**
     * Set the user email
     *
     * @param $str_email
     * @return $this
     */
    public function email($str_email)
    {
        $this->str_email = $str_email;
        return $this;
    }

    /**
     * Set the user mobile
     *
     * @param $str_mobile
     * @return $this
     */
    public function mobile($str_mobile)
    {
        $this->str_mobile = $str_mobile;
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
            $obj_data->user_id = $this->str_id;
        }
        if(null !== $this->str_name) {
            $obj_data->name = $this->str_name;
        }
        if(null !== $this->str_email) {
            $obj_data->email = $this->str_email;
        }
        if(null !== $this->str_mobile) {
            $obj_data->mobile = $this->str_mobile;
        }
        return $obj_data;
    }

}