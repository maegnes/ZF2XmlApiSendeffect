<?php

namespace ZF2XmlApiSendeffect\Api\Request;

use InvalidArgumentException;
use Zend\Http\Client;
use ZF2XmlApiSendeffect\Api\Response\ResponseInterface;
use ZF2XmlApiSendeffect\Converter\ConverterInterface;

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
     * @var Client
     */
    public $client = null;

    /**
     * @var ConverterInterface
     */
    public $converter = null;

    /**
     * @param string             $url
     * @param Client             $client
     * @param ResponseInterface  $response
     * @param ConverterInterface $converter
     */
    public function __construct(
        $url = null, Client $client, ResponseInterface $response = null, ConverterInterface $converter
    ) {
        $this->setUrl($url);
        $this->setResponse($response);
        $this->setClient($client);
        $this->setConverter($converter);
    }

    /**
     * Send the given data to the API and return the Response Object
     *
     * @param $data
     *
     * @throws InvalidArgumentException
     * @return ResponseInterface
     */
    public function send($data)
    {
        if (is_null($this->getUrl())) {
            throw new InvalidArgumentException('No XmlApiSendEffect URL is given!');
        }
        $client = $this->getClient();
        $client->setMethod('POST');
        $client->setRawBody($this->getConverter()->convert($data));
        $client->setOptions(['sslverifypeer' => false]);
        $client->send();

        return $this->getResponse()->create(
            $this->getConverter()->reconvert(
                $client->getResponse()->getBody()
            )
        );
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

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the converter for the request data
     *
     * @param ConverterInterface $converter
     *
     * @return mixed
     */
    public function setConverter(ConverterInterface $converter)
    {
        $this->converter = $converter;
    }

    /**
     * Returns the converter for the request data
     *
     * @return ConverterInterface
     */
    public function getConverter()
    {
        return $this->converter;
    }
}
