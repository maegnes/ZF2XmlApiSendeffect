<?php

namespace XmlApiSendeffect\Api\Request;

use XmlApiSendeffect\Api\Response\ResponseInterface;

/**
 * Response Interface
 *
 * @author Magnus Buk <MagnusBuk@gmx.de>
 * @package XmlApiSendeffect\Api
 */
interface RequestInterface
{
    /**
     * @param $data
     * @return ResponseInterface
     */
    public function send($data);
}
