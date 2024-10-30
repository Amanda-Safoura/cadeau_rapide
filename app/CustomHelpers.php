<?php

namespace App;

class CustomHelpers
{
    public static function extractLines(string $inputText): array
{
    // Transformation du texte en tableau, chaque ligne devenant un élément
    $inputTextArray = explode("\n", $inputText);

    // Filtrage des lignes vides ou contenant uniquement des espaces
    $lines = array_filter(array_map('trim', $inputTextArray), function($line) {
        return !empty($line);
    });

    return array_values($lines); // Réinitialisation des clés du tableau
}

}
