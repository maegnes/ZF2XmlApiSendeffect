<?php

namespace XmlApiSendeffect\Factory\Service;

/**
 * Factory Class for the GetSubscribers Service
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package XmlApiSendeffect\Factory\Service
 */
class GetSubscribersFactory extends AbstractServiceFactory
{
    protected $class = 'GetSubscribers';

    protected $responseClass = '\\XmlApiSendeffect\\Api\\Response\\GetSubscribersResponse';
}
