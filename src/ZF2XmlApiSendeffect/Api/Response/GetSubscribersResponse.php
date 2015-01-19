<?php

namespace ZF2XmlApiSendeffect\Api\Response;

/**
 * Class GetSubscribersResponse
 *
 * @author Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Api\Response
 */
class GetSubscribersResponse extends BaseResponse implements ResponseInterface
{
    /**
     * count of found subscribers
     *
     * @var int
     */
    public $count = 0;

    /**
     * Found subscribers
     *
     * @var array
     */
    public $subscribers = array();

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
        $response->setCount($data['count']);
        if($response->getCount() > 0) {
            $response->setSubscribers($data['subscriberlist']['item']);
        }
        return $response;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param array $subscribers
     */
    public function setSubscribers($subscribers)
    {
        $this->subscribers = $subscribers;
    }

    /**
     * @return array
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }
}
