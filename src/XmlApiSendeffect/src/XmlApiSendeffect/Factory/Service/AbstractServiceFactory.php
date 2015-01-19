<?php

namespace XmlApiSendeffect\Factory\Service;

use XmlApiSendeffect\Api\Request\HttpRequest;
use XmlApiSendeffect\Converter\XmlConverter;
use XmlApiSendeffect\Api\Response\ResponseInterface;
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
    protected $namespace = '\\XmlApiSendeffect\\Service\\';

    /**
     * Name of the class to be created. Must be overwritten in the child class
     *
     * @var string
     */
    protected $class = '';

    /**
     * Used Response class - can be overwritten in the child classes
     *
     * @var string
     */
    protected $responseClass = '\\XmlApiSendeffect\\Api\\Response\\BaseResponse';

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
        $config = $config['XmlApiSendeffect'];

        $response = new $this->responseClass;

        if(empty($this->class)) {
            throw new Exception(
                'No class to instantiate given. Did you define property $class in the child class of the factory?'
            );
        }

        if(!$response instanceof ResponseInterface) {
            throw new Exception('No valid Response Object created!');
        }

        /** @var \XmlApiSendeffect\Service\AbstractService $service */
        $service = new $className($config['username'], $config['usertoken']);
        $service->init();
        $service->setRequest(new HttpRequest($config['apiUrl'], $response));
        $service->setConverter(new XmlConverter());
        return $service;
    }
}
