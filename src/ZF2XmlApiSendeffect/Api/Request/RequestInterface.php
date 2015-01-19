<?php

namespace ZF2XmlApiSendeffect\Api\Request;

use ZF2XmlApiSendeffect\Api\Response\ResponseInterface;

/**
 * Response Interface
 *
 * @author Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Api
 */
interface RequestInterface
{
    /**
     * @param $data
     * @return ResponseInterface
     */
    public function send($data);
}
