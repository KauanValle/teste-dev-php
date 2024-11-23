<?php

namespace App\Helpers;

class Formatter
{
    public static function formatCnpj(string $documento)
    {
        return preg_replace('/\D/', '', $documento);
    }
}
