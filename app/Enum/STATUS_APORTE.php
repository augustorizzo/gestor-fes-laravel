<?php

namespace App\Enum;

class STATUS_APORTE
{
    public static $PREVISTO = 'PR';
    public static $BLOQUEADO = 'BL';
    public static $LIBERADO = 'LI';
    public static $PERDIDO = 'PD';

    public static function GetTipo($valor)
    {
        if($valor == STATUS_APORTE::$PREVISTO)
        {
            return  'Previsto';
        }
        else if($valor == STATUS_APORTE::$BLOQUEADO)
        {
            return 'Bloqueado';
        }
        else if($valor == STATUS_APORTE::$LIBERADO)
        {
            return 'Liberado';
        }
        else if($valor == STATUS_APORTE::$PERDIDO)
        {
            return 'Perdido';
        }
        else
        {
            return 'Não Indentificado';
        }
    }

    public static function GetBadge($valor)
    {
        if($valor == STATUS_APORTE::$PREVISTO)
        {
            return  'badge-warning';
        }
        else if($valor == STATUS_APORTE::$BLOQUEADO)
        {
            return 'badge-secondary';
        }
        else if($valor == STATUS_APORTE::$LIBERADO)
        {
            return 'badge-success';
        }
        else if($valor == STATUS_APORTE::$PERDIDO)
        {
            return 'badge-danger';
        }
        else
        {
            return 'badge-info';
        }
    }
}
