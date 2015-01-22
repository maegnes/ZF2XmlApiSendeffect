<?php

namespace ZF2XmlApiSendeffect\Service;

/**
 * IsSubscriberOnList Service
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Service
 */
class IsSubscriberOnList extends AbstractService
{

    /**
     * Init default fields
     */
    public function init()
    {
        $this->setRequestMethod('IsSubscriberOnList');
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
                'emailaddress' => $this->getEmailAddress(),
                'listids'      => $this->getMailingList()
            )
        );
        return $result;
    }
}
