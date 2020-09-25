<?php

namespace App\Enum;

class TIPO_CREDITO
{
    public static $INVESTIMENTO = 1;
    public static $CUSTEIO = 2;


    public static function GetTipo($valor)
    {
        if($valor == TIPO_CREDITO::$INVESTIMENTO)
        {
            return  'Investimento';
        }
        else if($valor == TIPO_CREDITO::$CUSTEIO)
        {
            return 'Custeio';
        }
    }

    public static function Combo()
    {
        return 
        [
            TIPO_CREDITO::$INVESTIMENTO => TIPO_CREDITO::GetTipo(TIPO_CREDITO::$INVESTIMENTO),
            TIPO_CREDITO::$CUSTEIO => TIPO_CREDITO::GetTipo(TIPO_CREDITO::$CUSTEIO)
        ];
    }
}
