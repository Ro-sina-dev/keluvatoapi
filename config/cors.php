<?php

return [

    'paths' => ['sanctum/csrf-cookie'], // Plus besoin de protéger api/* puisqu'on utilise web

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'], // Simplifié car plus de problème CORS avec les routes web

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
