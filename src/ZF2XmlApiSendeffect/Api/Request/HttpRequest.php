<?php

namespace ZF2XmlApiSendeffect\Api\Request;

use Zend\Http\Client;
use XmlApiSendeffect\Api\Response\ResponseInterface;
use Exception;

/**
 * Class Request
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Api
 */
class HttpRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $url = null;

    /**
     * @var ResponseInterface
     */
    public $response = null;

    /**
     * @param string $url
     * @param ResponseInterface $response
     */
    public function __construct($url = null, ResponseInterface $response = null)
    {
        $this->setUrl($url);
        $this->setResponse($response);
    }

    /**
     * Send the given data to the API and return the Response Object
     *
     * @param $data
     * @throws Exception
     * @return ResponseInterface
     */
    public function send($data)
    {
        if (is_null($this->getUrl())) {
            throw new Exception('No XmlApiSendEffect URL is given!');
        }
        $client = new Client($this->getUrl());
        $client->setMethod('POST');
        $client->setRawBody($data);
        $client->setOptions(array('sslverifypeer' => false));
        $client->send();
        return $this->response->create($client->getResponse()->getBody());
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
