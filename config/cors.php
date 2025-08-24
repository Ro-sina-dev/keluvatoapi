<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Les chemins API que tu veux protéger

    'allowed_methods' => ['*'], // Autorise toutes les méthodes HTTP (GET, POST, etc.)

    'allowed_origins' => ['http://127.0.0.1:5500'], // Autorise uniquement ton frontend local

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Autorise tous les headers

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false, // true si tu veux gérer les cookies/authentification cross-origin

];
