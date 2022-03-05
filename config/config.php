<?php
return [

    'system2_host' => env('SYSTEM2_HOST'),
    'system2_client_id' => env('SYSTEM2_CLIENT_ID'),
    'system2_client_secret' => env('SYSTEM2_CLIENT_SECRET'),
    'system2_sso_client_id' => env('SYSTEM2_SSO_CLIENT_ID'),

    'callback' => url('/dashboard/sso-login-callback'),
];
