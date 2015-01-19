<?php

namespace XmlApiSendeffect\Factory\Service;

/**
 * Factory Class for the GetSubscribers Service
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package XmlApiSendeffect\Factory\Service
 */
class IsSubscriberOnListFactory extends AbstractServiceFactory
{
    protected $class = 'IsSubscriberOnList';

    protected $responseClass = '\\XmlApiSendeffect\\Api\\Response\\IsSubscriberOnListResponse';
}
