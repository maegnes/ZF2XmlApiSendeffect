<?php

namespace ZF2XmlApiSendeffect\Factory\Service;

/**
 * Factory Class for the GetSubscribers Service
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Factory\Service
 */
class IsSubscriberOnListFactory extends AbstractServiceFactory
{
    public $class = 'IsSubscriberOnList';

    public $responseClass = '\\ZF2XmlApiSendeffect\\Api\\Response\\IsSubscriberOnListResponse';
}
