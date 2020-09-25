<?php

namespace App\Enum;

class STATUS_PLANO
{
    public static $RASCUNHO = 'RS';
    public static $AGUARDANDO_APROVACAO = 'AG';
    public static $APROVADO = 'AP';
    public static $RECUSADO = 'XX';

    public static function GetStatus($valor)
    {
        if($valor == STATUS_PLANO::$RASCUNHO)
        {
            return  'Rascunho';
        }
        else if($valor == STATUS_PLANO::$AGUARDANDO_APROVACAO)
        {
            return 'Aguardando aprovação';
        }
        else if($valor == STATUS_PLANO::$APROVADO)
        {
            return 'Aprovado';
        }
        else if($valor == STATUS_PLANO::$RECUSADO)
        {
            return 'Recusado';
        }
        else
        {
            return 'Não Indentificado';
        }
    }

    public static function GetBadge($valor)
    {
        if($valor == STATUS_PLANO::$RASCUNHO)
        {
            return  'badge-warning';
        }
        else if($valor == STATUS_PLANO::$AGUARDANDO_APROVACAO)
        {
            return 'badge-secondary';
        }
        else if($valor == STATUS_PLANO::$APROVADO)
        {
            return 'badge-success';
        }
        else if($valor == STATUS_PLANO::$RECUSADO)
        {
            return 'badge-danger';
        }
        else
        {
            return 'badge-info';
        }
    }
}
