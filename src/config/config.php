<?php
    return array(
        /*
        |--------------------------------------------------------------------------
        | Paytm Payment Integrations
        |--------------------------------------------------------------------------
        | Sandbox,Live
        |
        */
        'environment'        => 'sandbox',
        'website'            => 'http://www.local.dev',

        /*
        |--------------------------------------------------------------------------
        | Connection Type
        |--------------------------------------------------------------------------
        |
        |
        |
        */
        'connections' => [

            'sandbox' => [
                'merchant_key'  => 'asldkfjsldkj',
                'merchant_mid'  => 'asldkfjsldkj',
            ],

            'live' => [
                'merchant_key'  => 'asldkfjsldkj',
                'merchant_mid' => 'asldkfjsldkj',
            ]


        ],
    );

?>