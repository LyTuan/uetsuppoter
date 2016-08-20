<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],'google' => [
    'client_id' => '929023425569-fl2armbnaio63o11qua0gk7f70bsbv8i.apps.googleusercontent.com',
    'client_secret' => 'F1Ac7MOtqa1BAmUNtFWWs_Ob',
    'redirect' => 'http://localhost/www/uetsupporter/public/google/callback',
    ],'facebook' => [
    'client_id' => '102423166874134',
    'client_secret' => '759f8c23268691e81872d1d518bcfb7f',
    'redirect' => 'http://localhost/www/uetsupporter/public/facebook/callback',
    ],

];
