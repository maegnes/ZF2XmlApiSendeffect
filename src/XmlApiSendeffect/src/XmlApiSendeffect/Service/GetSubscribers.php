<?php

namespace XmlApiSendeffect\Service;

/**
 * GetSubscribers Service
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package XmlApiSendeffect\Service
 */
class GetSubscribers extends AbstractService
{

    /**
     * @var int
     */
    public $mailingList = null;

    /**
     * @var string
     */
    public $emailAddress = null;

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
