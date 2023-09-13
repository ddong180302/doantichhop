<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '1428488814734690', //client face của bạn
        'client_secret' => '185c9bb8a5dc438b7e54836def9369cb', //client app service face của bạn
        'redirect' => 'http://localhost/shopbanhanglaravel/admin/callback' //callback trả về
    ],
    'google' => [
        'client_id' => '642968220642-gp4mj3kl4kg78omo8ej9mg8hav2vn417.apps.googleusercontent.com', //client face của bạn
        'client_secret' => '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', //client app service face của bạn
        'redirect' => 'http://localhost/shopbanhanglaravel/google/callback' //callback trả về
    ],



];
