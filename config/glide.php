<?php

return [
    'source' => storage_path('app/public/Partners'), // Emplacement des images d'origine
    'cache' => storage_path('app/public/thumbnails'), // Emplacement pour les miniatures en cache
    'cache_path_prefix' => '.cache',
    'base_url' => '/storage/thumbnails', // Assurez-vous que l'URL de base est correcte pour accéder aux miniatures

    'defaults' => [
        'fm' => 'jpg',
        'q' => 80, // Qualité de l'image
    ],

    'max_image_size' => 2000 * 2000, // Limite de taille pour l'image en pixels

    'use_secure_urls' => true, // Activer les URLs sécurisées
];
