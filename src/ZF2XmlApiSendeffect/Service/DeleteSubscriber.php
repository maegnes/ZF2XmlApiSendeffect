<?php

namespace ZF2XmlApiSendeffect\Service;

/**
 * DeleteSubscriber Service
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Service
 */
class DeleteSubscriber extends AbstractService
{
    /**
     * @var string
     */
    public $emailAddress = null;

    /**
     * @var int
     */
    public $mailingList = null;

    /**
     * Init default fields
     */
    public function init()
    {
        $this->setRequestMethod('DeleteSubscriber');
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
                'mailinglist'  => $this->getMailingList(),
            )
        );
        return $result;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param int $mailingList
     */
    public function setMailingList($mailingList)
    {
        $this->mailingList = $mailingList;
    }

    /**
     * @return int
     */
    public function getMailingList()
    {
        return $this->mailingList;
    }
}
