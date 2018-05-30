<?php

namespace AppBundle\Services\API;


class CURL
{


    /**
     * @param $url
     * @param $data array of key and values
     * ['name'=>'abc','age'=>'10']
     * @return mixed
     */
    public function httpGet($url,$data = null)
    {
        $curl = curl_init();
        if($data != null && is_array($data)){

            $isFirst = true;
            foreach($data as $key => $value){
                if($isFirst == true){
                    $url = $url . '?';
                    $isFirst = false;

                }else{
                    $url = $url . '&';
                }
                $url = $url . $key . '=' . $value;
            }
        }
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

        $ret = new \stdClass();
        $ret->response = curl_exec($curl);
        if($ret->response == false){
            $ret->error = 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
        }

        curl_close($curl);
        return $ret;
    }

    /**
     * @param $url
     * @param $data array of key and values
     * ['name'=>'abc','age'=>'10']
     * @return mixed
     */
    public function httpPost($url,$data){

        // Get cURL resource

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
//            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Content-Length: '.strlen(json_encode($data))
            )

        ));

        // Send the request & save response to $resp

        $ret = new \stdClass();
        $ret->response = curl_exec($curl);
        if($ret->response == false){
            $ret->error = 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
        }

        curl_close($curl);
        return $ret;
    }

    /**
     * @param $url
     * @param $data array of key and values
     * @return mixed
     */
    public function httpPostForm($url,$data){

        // Get cURL resource

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
//            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
//            CURLOPT_HTTPHEADER => array(
//                'Content-Type: application/x-www-form-urlencoded',
//            )

        ));

        // Send the request & save response to $resp

        $ret = new \stdClass();
        $ret->response = curl_exec($curl);
        if($ret->response == false){
            $ret->error = 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl);
        }

        curl_close($curl);
        return $ret;
    }





}