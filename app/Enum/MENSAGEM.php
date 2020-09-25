<?php

namespace App\Enum;

class MENSAGEM
{
    public static $SUCESSO = 0;
    public static $ERRO = 1;
    public static $ALERTA = 2;
    public static $INFO = 3;


    public static function GetTipo($valor)
    {
        if($valor == MENSAGEM::$SUCESSO)
        {
            return  'sucesso';
        }
        else if($valor == MENSAGEM::$ERRO)
        {
            return 'erro';
        }
        else if($valor == MENSAGEM::$ALERTA)
        {
            return 'alerta';
        }
        else if($valor == MENSAGEM::$INFO)
        {
            return 'info';
        }
    }
}
