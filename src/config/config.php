<?php
    return array(
        /*
        |--------------------------------------------------------------------------
        | Paytm Default Gateway
        |--------------------------------------------------------------------------
        | "sandbox" is for testing purpose
        | "live" is for production 
        |
        */
        'default'       => 'sandbox',

        /*
        |--------------------------------------------------------------------------
        | Paytm Aditional settings
        |--------------------------------------------------------------------------
        |
        */
        'industry_type' => 'Retail',
        'channel'       => 'WEB',
        'order_prefix'  => 'EDU',
        'website'       => 'your-website',

        /*
        |--------------------------------------------------------------------------
        | Paytm Connection Credentials
        |--------------------------------------------------------------------------
        | sandbox,live
        |
        */
        'connections' => [

            'sandbox' => [
                'merchant_key'  => 'your-merchant-key',
                'merchant_mid'  => 'your-merchant-id',
            ],

            'live' => [
                'merchant_key'  => 'your-merchant-key',
                'merchant_mid'  => 'your-merchant-id',
            ]

        ],
    );
