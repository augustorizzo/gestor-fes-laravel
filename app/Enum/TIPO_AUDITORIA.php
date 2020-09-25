<?php

namespace App\Enum;

class TIPO_AUDITORIA
{
    public static $CRIACAO = 1;
    public static $ATUALIZACAO = 2;
    public static $EXCLUSAO = 3;
    public static $VISUALIZACAO = 4;

    public static function GetTipo($valor)
    {
        if($valor == TIPO_AUDITORIA::$CRIACAO)
        {
            return  'Criação';
        }
        else if($valor == TIPO_AUDITORIA::$ATUALIZACAO)
        {
            return 'Atualização';
        }
        else if($valor == TIPO_AUDITORIA::$EXCLUSAO)
        {
            return 'Exclusão';
        }
        else if($valor == TIPO_AUDITORIA::$VISUALIZACAO)
        {
            return 'Visualização';
        }
    }

    public static function Combo()
    {
        return
        [
            TIPO_AUDITORIA::$CRIACAO => TIPO_AUDITORIA::GetTipo(TIPO_AUDITORIA::$CRIACAO),
            TIPO_AUDITORIA::$ATUALIZACAO => TIPO_AUDITORIA::GetTipo(TIPO_AUDITORIA::$ATUALIZACAO),
            TIPO_AUDITORIA::$EXCLUSAO => TIPO_AUDITORIA::GetTipo(TIPO_AUDITORIA::$EXCLUSAO),
            TIPO_AUDITORIA::$VISUALIZACAO => TIPO_AUDITORIA::GetTipo(TIPO_AUDITORIA::$VISUALIZACAO)
        ];
    }
}
