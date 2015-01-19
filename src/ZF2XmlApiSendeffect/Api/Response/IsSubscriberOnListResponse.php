<?php

namespace ZF2XmlApiSendeffect\Api\Response;

/**
 * Class IsSubscriberOnListResponse
 *
 * @author Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Api\Response
 */
class IsSubscriberOnListResponse extends BaseResponse implements ResponseInterface
{
    /**
     * Found subscribers
     *
     * @var boolean
     */
    public $userExists = false;

    /**
     * Factory - create the response
     *
     * @param $data
     * @return self|boolean
     */
    public static function create($data)
    {
        $parent = parent::create($data);

        $data = $parent->getData();

        $response = new self();
        $response->setStatus($parent->getStatus());
        $response->setErrorMessage($parent->getErrorMessage());
        $response->setUserExists(((int)$data > 0));

        return $response;
    }

    /**
     * Set if the user exists
     *
     * @param boolean $exists
     */
    public function setUserExists($exists) {
        $this->userExists = $exists;
    }

    /**
     * @return bool
     */
    public function userExists() {
        return $this->userExists;
    }
}
