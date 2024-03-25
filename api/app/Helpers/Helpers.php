<?php

namespace App\Helpers;

class Helpers
{
    static public function getNumbers($value)
    {
        return trim( preg_replace('/[^0-9]/', '', $value) );
    }
}
