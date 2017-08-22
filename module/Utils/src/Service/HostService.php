<?php
/**
 * Created by PhpStorm.
 * User: hayk
 * Date: 8/21/17
 * Time: 1:31 PM
 */

namespace Utils\Service;


use Zend\Http\Client;
use Zend\Http\Headers;
use Zend\Http\Request;

class HostService
{
    public static  function makeApiCall($url, $params = null, $isPost = false, $contentType = null)
    {
        $client = new Client();

        $client->setAdapter(new Client\Adapter\Curl());

        $request = new Request();



        if(false == $isPost) {
            $requestStr = '?';
            foreach ($params as $key => $param) {
                $requestStr .= $key . '=' . $param . '&';
            }

            $url .= $requestStr;
        } else {
            $request->setMethod(Request::METHOD_POST);
        }

        $request->setUri($url);

        $header = new Headers();
        if(!is_null($contentType)) {


        $header->addHeaderLine("Content-Type", $contentType);
        $request->setHeaders($header);

        } elseif($contentType == 'application/json') {
            $request->setContent(json_encode($params));
        } else {
            $request->setContent($params);
        }

        $response = $client->dispatch($request);

        return $response->getContent();
    }
}