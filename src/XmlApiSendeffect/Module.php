<?php

namespace XmlApiSendeffect;

/**
 * Module.php for the SendEffect API
 *
 * @author Magnus Buk <MagnusBuk@gmx.de>
 */
class Module
{
    /**
     * Get module config
     *
     * @access public
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Get autoloader config
     *
     * @access public
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Get service config
     *
     * @access public
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'sendeffect_add_subscriber_to_list' => 'XmlApiSendeffect\Factory\Service\AddSubscriberToListFactory',
                'sendeffect_delete_subscriber' => 'XmlApiSendeffect\Factory\Service\DeleteSubscriberFactory',
                'sendeffect_get_subscribers' => 'XmlApiSendeffect\Factory\Service\GetSubscribersFactory',
                'sendeffect_is_subscriber_on_list' => 'XmlApiSendeffect\Factory\Service\IsSubscriberOnListFactory'
            )
        );
    }
}
