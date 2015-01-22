<?php

namespace ZF2XmlApiSendeffect\Api\Response;

/**
 * Response Interface
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Api
 */
interface ResponseInterface
{
    /**
     * Creates the response object based on the returned response data
     *
     * @param $data
     *
     * @return mixed
     */
    public function create($data);

    /**
     * Check if the response is a successful response
     *
     * @return mixed
     */
    public function isSuccess();
}
