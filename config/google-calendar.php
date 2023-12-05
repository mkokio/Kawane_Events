<?php

return [

    'default_auth_profile' => env('GOOGLE_CALENDAR_AUTH_PROFILE', 'service_account'),

    'auth_profiles' => [

        /*
         * Authenticate using a service account.
         */
        'service_account' => [
            'service_account' => [
                'credentials_json' => [
                    'type' => env('GOOGLE_SERVICE_ACCOUNT_TYPE'),
                    'project_id' => env('GOOGLE_SERVICE_ACCOUNT_PROJECT_ID'),
                    'private_key_id' => env('GOOGLE_PRIVATE_KEY_ID'),
                    'private_key' => str_replace("\\n", "\n", env('GOOGLE_PRIVATE_KEY')),
                    'client_email' => env('GOOGLE_SERVICE_ACCOUNT_CLIENT_EMAIL'),
                    'client_id' => env('GOOGLE_SERVICE_ACCOUNT_CLIENT_ID'),
                    'auth_uri' => env('GOOGLE_AUTH_URI'),
                    'token_uri' => env('GOOGLE_TOKEN_URI'),
                    'auth_provider_x509_cert_url' => env('GOOGLE_AUTH_PROVIDER_CERT_URL'),
                    'client_x509_cert_url' => env('GOOGLE_CLIENT_CERT_URL'),
                    'universe_domain' => env('GOOGLE_UNIVERSE_DOMAIN'),
                ],
            ],
        ],

        /*
         * Authenticate with actual google user account.
         */
        'oauth' => [
            /*
             * Path to the json file containing the oauth2 credentials.
             */
            'credentials_json' => storage_path('app/google-calendar/oauth-credentials.json'),

            /*
             * Path to the json file containing the oauth2 token.
             */
            'token_json' => storage_path('app/google-calendar/oauth-token.json'),
        ],
    ],

    /*
     *  The id of the Google Calendar that will be used by default.
     */
    'calendar_id' => env('GOOGLE_CALENDAR_ID'),

     /*
     *  The email address of the user account to impersonate.
     */
    'user_to_impersonate' => env('GOOGLE_CALENDAR_IMPERSONATE'), //necessary??
];
