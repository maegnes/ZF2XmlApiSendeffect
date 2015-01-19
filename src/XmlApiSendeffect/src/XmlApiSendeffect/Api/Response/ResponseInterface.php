<?php

namespace XmlApiSendeffect\Api\Response;

/**
 * Response Interface
 *
 * @author Magnus Buk <MagnusBuk@gmx.de>
 * @package XmlApiSendeffect\Api
 */
interface ResponseInterface
{
    public static function create($data);

    public function isSuccess();
}
