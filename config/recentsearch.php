<?php 

return [
     /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | This value defines the model used for users in the application.
    | You can change it to your custom User model if needed.
    |
    */
    'user_model' => App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | Recent Search Limit
    |--------------------------------------------------------------------------
    |
    | This value determines the maximum number of recent searches to store or
    | retrieve for a user. You can adjust this value to suit your application's
    | requirements.
    |
    */
    'recent_search_limit' => 10
];