<?php

namespace ZF2XmlApiSendeffect\Api\Response;

/**
 * Response Interface
 *
 * @author Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Api
 */
interface ResponseInterface
{
    public static function create($data);

    public function isSuccess();
}
