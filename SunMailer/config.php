<?php

return [

    'mail' => [

        /**
         *	Mail Server
         */
        'host'		    => 'smtp.mail.yahoo.com',
        'port'		    =>  465,
        'encryption'	=> 'ssl',

        /**
         * User Credential
         */
        'username'      => 'deytinne@yahoo.com',
        'password'	    => '1234567t',

        /**
         *  Sender email address & name			 *
         */
        'from' => [

            'email'     => 'deytinne@yahoo.com',
            'name'	    => 'Administrator'

        ],

        /**
         * reply email address & name			 *
         */
        'reply' => [

            'email'     => 'deytinne@yahoo.com',
            'name'      => 'Information'

        ],

        /**
         *  Log Email
		 *	if truee email not send. just log email
         */
        'log'       => false,

        /**
         * Email View Path
         */
        'view-directory'    => 'bank/view/'
    ]

];