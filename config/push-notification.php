<?php

return array(

    'appNameIOS'     => array(
        'environment' => 'development',
        'certificate' => 'base_path()/sprubix_dev.pem',
        'passPhrase'  => env('PEM_PASSPHRASE'),
        'service'     => 'apns'
    ),
    'appNameAndroid' => array(
        'environment' => 'production',
        'apiKey'      => 'yourAPIKey',
        'service'     => 'gcm'
    )

);