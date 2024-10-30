<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function showImage(Request $request, $filename)
    {
        // 1. Configurer le serveur Glide
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(),
            'source' => config('glide.source'), // Dossier source des images
            'cache' => config('glide.cache'), // Dossier cache pour les miniatures
            'cache_with_file_extensions' => true,
            'secure' => config('glide.use_secure_urls'), // Utiliser des URLs sécurisées si configuré
        ]);

        // 2. Paramètres de transformation
        $params = $request->only(['w', 'h', 'fit']); // Récupère les paramètres d'URL (ex : 'w', 'h', 'fit')
        $params = array_merge([
            'w' => 150,    // Largeur par défaut
            'h' => 150,    // Hauteur par défaut
            'fit' => 'crop', // Ajustement de l'image
        ], $params);

        // 3. Récupérer et retourner l'image transformée
        return $server->getImageResponse($filename, $params);
    }
}
