<?php

namespace ZF2XmlApiSendeffect\Api\Response;

/**
 * Convert API Response to object
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Api
 */
class BaseResponse implements ResponseInterface
{
    /**
     * Success identifier
     */
    const SUCCESS = 'SUCCESS';

    /**
     * Error identifier
     */
    const ERROR = 'ERROR';

    /**
     * @var string
     */
    public $status = null;

    /**
     * @var string
     */
    public $errorMessage = null;

    /**
     * @var array
     */
    public $data = array();

    /**
     * Factory - create the response
     *
     * @param $data
     *
     * @return self|boolean
     */
    public function create($data)
    {
        $response = new self();

        // Parse XML
        try {
            $response->setStatus($data['response']['status']);
            if (isset($data['response']['errormessage'])) {
                $response->setErrormessage($data['response']['errormessage']);
            }
            if (isset($data['response']['data'])) {
                $response->setData($data['response']['data']);
            }
            return $response;
        } catch (\Exception $e) {
            $response->setStatus(self::ERROR);
            $response->setErrorMessage($e->getMessage());
            return false;
        }
    }

    /**
     * Check if the response is valid
     *
     * @return boolean
     */
    public function isSuccess()
    {
        return (self::SUCCESS == $this->getStatus());
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
