<?php

return array(

    'sprubixIOS'     => array(
        'environment' => 'production',
        'certificate' => base_path() . '/' . env('PEM_FILE'),
        'passPhrase'  => env('PEM_PASSPHRASE'),
        'service'     => 'apns'
    ),
    'sprubixAndroid' => array(
        'environment' => 'production',
        'apiKey'      => 'yourAPIKey',
        'service'     => 'gcm'
    )

);