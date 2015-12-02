<?php
/**
 * PHP Client for Venditan Rapport
 *
 * @author Tom Walder <tom@docnet.nu>
 */

namespace Venditan\Rapport;

use Venditan\Rapport\Client\Message;
use Venditan\Rapport\Client\Transaction;
use Venditan\Rapport\Client\User;

class Client
{
    private $str_endpoint = 'https://rapporteu.appspot.com';

    private $str_client = null;

    private $str_api_key = null;

    private $str_event = null;

    private $obj_user = null;

    private $obj_txn = null;

    private $obj_message = null;

    /**
     * Set the client ane api key
     *
     * @param $str_client
     * @param $str_api_key
     */
    public function __construct($str_client, $str_api_key)
    {
        $this->str_client = $str_client;
        $this->str_api_key = $str_api_key;
    }

    /**
     * Set the event identifier
     *
     * @param $str_event
     * @return $this
     */
    public function event($str_event)
    {
        $this->str_event = $str_event;
        return $this;
    }

    /**
     * Set the endpoint
     *
     * @param $str_endpoint
     * @return $this
     */
    public function endpoint($str_endpoint)
    {
        $this->str_endpoint = $str_endpoint;
        return $this;
    }

    /**
     * Add and return a User component
     *
     * @return User
     */
    public function addUser()
    {
        if(null === $this->obj_user) {
            $this->obj_user = new User();
        }
        return $this->obj_user;
    }

    /**
     * Add and return a Transaction component
     *
     * @return Transaction
     */
    public function addTransaction()
    {
        if(null === $this->obj_txn) {
            $this->obj_txn = new Transaction();
        }
        return $this->obj_txn;
    }

    /**
     * Add and return a MEssage component
     *
     * @return Message
     */
    public function addMessage()
    {
        if(null === $this->obj_message) {
            $this->obj_message = new Message();
        }
        return $this->obj_message;
    }

    /**
     * Send the event to Rapport
     *
     * @todo consider additional optional curl support
     */
    public function send()
    {
        // Stream post the data
        $this->evaluateResponse($this->httpPost($this->compile()));
    }

    /**
     * Compile the data for transmission
     *
     * @return object
     */
    public function compile()
    {
        if(null === $this->str_event) {
            throw new \RuntimeException("Event cannot be null");
        }
        $obj_payload = (object)[
            'client' => $this->str_client,
            'key' => $this->str_api_key,
            'event' => $this->str_event
        ];
        if($this->obj_user instanceof User) {
            $obj_payload->user = $this->obj_user->compile();
        }
        if($this->obj_txn instanceof Transaction) {
            $obj_payload->transaction = $this->obj_txn->compile();
        }
        if($this->obj_message instanceof Message) {
            $obj_payload->message = $this->obj_message->compile();
        }
        return $obj_payload;
    }

    /**
     * Send the data off
     *
     * @param object $obj_payload
     * @return array
     */
    private function httpPost($obj_payload)
    {
        $arr_opts = [
            'ssl' => [
                'verify_peer' => true,
                'CN_match' => '*.appspot.com',
                'disable_compression' => true
            ],
            'http' => [
                'ignore_errors' => true,
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => json_encode($obj_payload)
            ]
        ];

        // Make the request
        $obj_context = stream_context_create($arr_opts);
        $str_response = file_get_contents($this->str_endpoint . '/event', false, $obj_context);
        return [
            'headers' => $http_response_header,
            'response' => trim($str_response)
        ];
    }

    /**
     * Process any response data
     *
     * @param array $arr_response
     * @return bool
     */
    private function evaluateResponse(array $arr_response)
    {
        $arr_headers = $arr_response['headers'];
        if(!is_array($arr_headers)) {
            throw new \RuntimeException("No HTTP response headers");
        }
        if(strpos($arr_headers[0], '200 OK') < 1) {
            throw new \RuntimeException("Not a 200 OK response [{$arr_headers[0]}]");
        }
        $obj_response = json_decode($arr_response['response']);
        if (!is_object($obj_response)) {
            throw new \RuntimeException("Could not decode JSON response");
        }
    }

}