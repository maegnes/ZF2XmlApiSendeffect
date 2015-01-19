# ZF2XmlApiSendeffect
ZF2 module which integrates the sendeffect xml api into your application

Installation via Composer
--------
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
            'apiUrl' => 'https://sendlx.com/xml.php',
            'username'  => 'Your API Username',
            'usertoken' => 'Your API Usertoken'
        )
    );

Available Services
--------
Description coming soon

ToDo
--------
- Add Unit Tests
- Add travis-ci support
- Complete documentation