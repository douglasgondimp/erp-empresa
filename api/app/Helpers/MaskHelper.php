<?php

namespace App\Helpers;

class MaskHelper
{
    static public function maskCPFCNPJ($value)
    {
        if (strlen($value) === 11)
            return self::mask($value, '###.###.###-##');
        
        return self::mask($value, '##.###.###/####-##');
    }

    static public function mask($val, $mask)
    {
        if (!$val) return null;
        
        $maskared = '';
        $k        = 0;

        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '#') {
                if(isset($val[$k])) $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i])) $maskared .= $mask[$i];
            }
        }
        
        return $maskared;
    }
}
