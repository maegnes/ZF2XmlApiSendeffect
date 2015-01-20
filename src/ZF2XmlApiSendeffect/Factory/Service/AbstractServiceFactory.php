<?php

namespace ZF2XmlApiSendeffect\Factory\Service;

use ZF2XmlApiSendeffect\Api\Request\HttpRequest;
use ZF2XmlApiSendeffect\Converter\XmlConverter;
use ZF2XmlApiSendeffect\Api\Response\ResponseInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Exception;

class AbstractServiceFactory implements FactoryInterface
{

    /**
     * Namespace of the service classes
     *
     * @var string
     */
    public $namespace = '\\ZF2XmlApiSendeffect\\Service\\';

    /**
     * Name of the class to be created. Must be overwritten in the child class
     *
     * @var string
     */
    public $class = '';

    /**
     * Used Response class - can be overwritten in the child classes
     *
     * @var string
     */
    public $responseClass = '\\ZF2XmlApiSendeffect\\Api\\Response\\BaseResponse';

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws Exception
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $className = $this->namespace . $this->class;
        $config = $serviceLocator->get('config');
        $config = $config['ZF2XmlApiSendeffect'];

        $response = new $this->responseClass;

        if(empty($this->class)) {
            throw new Exception(
                'No class to instantiate given. Did you define property $class in the child class of the factory?'
            );
        }

        if(!$response instanceof ResponseInterface) {
            throw new Exception('No valid Response Object created!');
        }

        /** @var \ZF2XmlApiSendeffect\Service\AbstractService $service */
        $service = new $className($config['username'], $config['usertoken']);
        $service->init();
        $service->setRequest(new HttpRequest($config['apiUrl'], $response));
        $service->setConverter(new XmlConverter());
        return $service;
    }
}
