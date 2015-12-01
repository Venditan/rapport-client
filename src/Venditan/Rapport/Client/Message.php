<?php
/**
 * Message representation - PHP Client for Venditan Rapport
 *
 * @author Tom Walder <tom@docnet.nu>
 */

namespace Venditan\Rapport\Client;

class Message
{

    /**
     * @var null|string
     */
    private $str_title = null;

    /**
     * @var null|string
     */
    private $str_body = null;

    /**
     * @var null|string
     */
    private $str_from = null;

    /**
     * Set the title
     *
     * @param $str_title
     * @return $this
     */
    public function title($str_title)
    {
        $this->str_title = $str_title;
        return $this;
    }

    /**
     * Set the body
     *
     * @param $str_body
     * @return $this
     */
    public function body($str_body)
    {
        $this->str_body = $str_body;
        return $this;
    }

    /**
     * Set the sending user
     *
     * @param $str_from
     * @return $this
     */
    public function from($str_from)
    {
        $this->str_from = $str_from;
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
        if(null !== $this->str_title) {
            $obj_data->title = $this->str_title;
        }
        if(null !== $this->str_body) {
            $obj_data->body = $this->str_body;
        }
        if(null !== $this->str_from) {
            $obj_data->from = $this->str_from;
        }
        return $obj_data;
    }

}