<?php

namespace ZF2XmlApiSendeffect\Service;

/**
 * GetSubscribers Service
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Service
 */
class GetSubscribers extends AbstractService
{

    /**
     * Init default fields
     */
    public function init()
    {
        $this->setRequestMethod('GetSubscribers');
        $this->setRequestType('subscribers');
    }

    /**
     * Populate data
     *
     * @return array|mixed
     * @todo - build hydrator
     */
    public function populate()
    {
        $result = array(
            'username'      => $this->getUserName(),
            'usertoken'     => $this->getUserToken(),
            'requesttype'   => $this->getRequestType(),
            'requestmethod' => $this->getRequestMethod(),
            'details'       => array(
                'searchinfo' => array(
                    'List' => $this->getMailingList(),
                    'Email'  => $this->getEmailAddress()
                )
            )
        );
        return $result;
    }
}
