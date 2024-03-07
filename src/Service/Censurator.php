<?php

namespace App\Service;

use phpDocumentor\Reflection\Types\Self_;

class Censurator
{
    public static array $OFFENSIVE_WORDS = ['mauvais', 'banane', 'fraise'];
    public function purify(string $string): string
    {
        foreach (self::$OFFENSIVE_WORDS as $word)
        {
            $stars = str_repeat('*',strlen($word));
            $string = str_replace($word, $stars, $string);
        }
        return $string;
    }
}