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
    protected $class = 'IsSubscriberOnList';

    protected $responseClass = '\\ZF2XmlApiSendeffect\\Api\\Response\\IsSubscriberOnListResponse';
}
