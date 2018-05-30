<?php

namespace AppBundle\Services\API;



class NodeAPI
{

    private $curl;

    /**
     * NodeAPI constructor.
     */
    public function __construct(CURL $curl)
    {
        $this->curl = $curl;
    }

    public function newVirtualDevice($username)
    {
        $data = array('username' => $username);
        return $this->curl->httpGet('http://localhost:8081/newVirtualDevice', $data);

    }


    public function killVirtualDevice($username)
    {
        $data = array('username' => $username);
        return $this->curl->httpGet('http://localhost:8081/killVirtualDevice', $data);
    }


}