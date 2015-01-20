<?php

namespace ZF2XmlApiSendeffect\Factory\Service;

/**
 * Factory Class for the GetSubscribers Service
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Factory\Service
 */
class GetSubscribersFactory extends AbstractServiceFactory
{
    public $class = 'GetSubscribers';

    public $responseClass = '\\ZF2XmlApiSendeffect\\Api\\Response\\GetSubscribersResponse';
}
