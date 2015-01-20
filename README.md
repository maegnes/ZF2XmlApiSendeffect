# ZF2XmlApiSendeffect
ZF2 module which integrates the sendeffect xml api into your application

Installation via Composer
======================
Just add the following dependency to your composer.json file and add the module "ZF2XmlApiSendeffect" to your modules list
in the application.config.php.

    {
        "require": {
			"maegnes/zf2xmlapisendeffect": ">=1.0.0"
        }
    }

Then, add the following structure to your application config:

    <?php
    return array(
        'ZF2XmlApiSendeffect' => array(
            'apiUrl' => 'The https Endpoint of the API',
            'username'  => 'Your API Username',
            'usertoken' => 'Your API Usertoken'
        )
    );

Available Services
======================

AddSubscriberToList
----------------------
Adds a subscriber to a defined sendeffect subscriber list.

#### Usage

    <?php

    // Inside your zf2 application, just fetch the service by the service manager

    /** \ZF2XmlApiSendeffect\Service\AddSubscriberToList $emailService */
    $emailService = $this->getServiceManager()->get('sendeffect_add_subscriber_to_list');

    // Set the email address of the subscriber and the target list id
    $emailService->setEmailAddress('John.Doe@yahoo.com');
    $emailService->setMailingList(233);

    // Then, add optional defined fields
    $name = array(
        'fieldid' => 12,
        'value' => 'John'
    );

    $surname = array(
        'fieldid' => 13,
        'value' => 'Doe'
    );

    $emailService->addCustomFields([$name, $surname]);


    # Finally call the api

    /** \ZF2XmlApiSendeffect\Api\Response\ResponseInterface $response */
    $response = $emailService->send();

    if ($response->isSuccess()) {
        # Your logic
    }

DeleteSubscriber
----------------------
Deletes a subscriber from the given list

#### Usage

    <?php

    // Inside your zf2 application, just fetch the service by the service manager

    /** \ZF2XmlApiSendeffect\Service\DeleteSubscriber $emailService */
    $emailService = $this->getServiceManager()->get('sendeffect_delete_subscriber');

    // Set the email address of the subscriber and the target list id
    $emailService->setEmailAddress('John.Doe@yahoo.com');
    $emailService->setMailingList(233);

    # Finally call the api

    /** \ZF2XmlApiSendeffect\Api\Response\ResponseInterface $response */
    $response = $emailService->send();

    if ($response->isSuccess()) {
        # Your logic
    }

GetSubscribers
----------------------
Returns all subscribers from a given subscriber list

#### Usage

    <?php

    // Inside your zf2 application, just fetch the service by the service manager

    /** \ZF2XmlApiSendeffect\Service\GetSubscribers $emailService */
    $emailService = $this->getServiceManager()->get('sendeffect_get_subscribers');

    // For instance its possible to search for all @yahoo.com mail addresses
    $emailService->setEmailAddress('@yahoo.com');
    $emailService->setMailingList(233);

    # Finally call the api

    /** \ZF2XmlApiSendeffect\Api\Response\GetSubscribersResponse $response */
    $response = $emailService->send();

    if ($response->isSuccess()) {

        # Your logic

        // Get the subscribers count
        $count = $response->getCount();

        // Get the subscribers
        $subscribers = $response->getSubscribers();
    }

IsSubscriberOnList
----------------------
Checks if the given user is on the given subscribers list

#### Usage

    <?php

    // Inside your zf2 application, just fetch the service by the service manager

    /** \ZF2XmlApiSendeffect\Service\IsSubscriberOnList $emailService */
    $emailService = $this->getServiceManager()->get('sendeffect_is_subscriber_on_list');

    // Check if the user John.Doe@yahoo.com is on the mailing list 233
    $emailService->setEmailAddress('John.Doe@yahoo.com');
    $emailService->setMailingList(233);

    # Finally call the api

    /** \ZF2XmlApiSendeffect\Api\Response\IsSubscriberOnListResponse $response */
    $response = $emailService->send();

    if ($response->isSuccess()) {

        # Your logic

        $userExists = $response->userExists(); # true/false

    }

ToDo
--------
- Add Unit Tests
- Add travis-ci support