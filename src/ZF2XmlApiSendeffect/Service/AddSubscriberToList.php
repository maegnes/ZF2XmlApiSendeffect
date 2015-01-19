<?php

namespace ZF2XmlApiSendeffect\Service;

/**
 * AddSubscriberToList Service
 *
 * @author  Magnus Buk <MagnusBuk@gmx.de>
 * @package ZF2XmlApiSendeffect\Service
 */
class AddSubscriberToList extends AbstractService
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
     * @var array
     */
    public $customFields = null;

    /**
     * @var string
     */
    public $format = null;

    /**
     * Init default fields
     */
    public function init()
    {
        $this->setRequestMethod('AddSubscriberToList');
        $this->setRequestType('subscribers');
        $this->setFormat('html');
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
                'format'       => $this->getFormat(),
                'confirmed'    => '1',
                'customfields' => array(
                    'item' => $this->getCustomFields()
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

    /**
     * Adds a custom field to the request
     *
     * @param array $field
     */
    public function addCustomField($field)
    {
        $this->customFields[] = $field;
    }

    /**
     * Returns all custom fields
     *
     * @return array
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }

    /**
     * add custom fields to the request
     *
     * @param array $fields
     * @return void
     */
    public function addCustomFields($fields = [])
    {
        if (is_array($fields)) {
            foreach ($fields as $field) {
                $this->addCustomField($field);
            }
        }
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }
}
