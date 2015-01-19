<?php

namespace ZF2XmlApiSendeffect\Service;

use ZF2XmlApiSendeffect\Api\Request\RequestInterface;
use ZF2XmlApiSendeffect\Api\Response\ResponseInterface;
use ZF2XmlApiSendeffect\Converter\ConverterInterface;
use InvalidArgumentException;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

/**
 * Base class for all available API services
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Service
 */
abstract class AbstractService implements EventManagerAwareInterface
{
    /**
     * API User Name
     *
     * @var string
     */
    public $userName = null;

    /**
     * API User Token
     *
     * @var string
     */
    public $userToken = null;

    /**
     * API Request Type
     *
     * @var string
     */
    public $requestType = null;

    /**
     * API Request Method
     *
     * @var string
     */
    public $requestMethod = null;

    /**
     * @var RequestInterface
     */
    public $request = null;

    /**
     * @var ConverterInterface
     */
    public $converter = null;

    /**
     * @var EventManagerInterface
     */
    public $eventManager = null;

    /**
     * Populate given data to output array
     *
     * @return mixed
     */
    abstract function  populate();

    /**
     * @param string $userName
     * @param string $userToken
     * @throws InvalidArgumentException
     */
    public function __construct($userName, $userToken) {
        if (empty($userName)) {
            throw new InvalidArgumentException('No username for the ZF2XmlApiSendeffect given!');
        }
        if (empty($userToken)) {
            throw new InvalidArgumentException('No usertoken for the ZF2XmlApiSendeffect given!');
        }
        $this->setUserName($userName);
        $this->setUserToken($userToken);
    }

    /**
     * Send the data to the API
     *
     * @access public
     * @return ResponseInterface
     */
    public function send()
    {
        $data = $this->getConverter()->convert($this->populate());

        $response = $this->getRequest()->send($data);

        // If the call was successful, throw event
        if ($response->isSuccess()) {
            $this->getEventManager()->trigger(
                'addedSubscriberToList',
                null,
                [
                    'service' => $this,
                    'response' => $response
                ]
            );
        }
        return $response;
    }

    /**
     * Inject an EventManager instance
     *
     * @param  EventManagerInterface $eventManager
     *
     * @return void
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->addIdentifiers([get_called_class()]);
        $this->eventManager = $eventManager;
    }

    /**
     * Retrieve the event manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userToken
     */
    public function setUserToken($userToken)
    {
        $this->userToken = $userToken;
    }

    /**
     * @return string
     */
    public function getUserToken()
    {
        return $this->userToken;
    }

    /**
     * @param string $requestMethod
     */
    public function setRequestMethod($requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @param string $requestType
     */
    public function setRequestType($requestType)
    {
        $this->requestType = $requestType;
    }

    /**
     * @return string
     */
    public function getRequestType()
    {
        return $this->requestType;
    }

    /**
     * @param RequestInterface $request
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param ConverterInterface $converter
     */
    public function setConverter(ConverterInterface $converter)
    {
        $this->converter = $converter;
    }

    /**
     * @return ConverterInterface
     */
    public function getConverter()
    {
        return $this->converter;
    }
}
