<?php

namespace App\Enum;

class TIPO_LOG
{
    public static $LOGIN = 1;
    public static $LOGOUT = 2;
    public static $ARQUIVO = 3;
    public static $ACESSO = 4;
    public static $RESET_SENHA = 5;
    public static $ALTERACAO_SENHA = 6;
    public static $NOVO_USUARIO = 7;
    public static $ALTERACAO_USUARIO = 8;


    public static function GetTipo($valor)
    {
        if($valor == TIPO_LOG::$LOGIN)
        {
            return  'Login';
        }
        else if($valor == TIPO_LOG::$LOGOUT)
        {
            return 'Logout';
        }
        else if($valor == TIPO_LOG::$ARQUIVO)
        {
            return 'Arquivo';
        }
        else if($valor == TIPO_LOG::$ACESSO)
        {
            return 'Acesso';
        }
        else if($valor == TIPO_LOG::$RESET_SENHA)
        {
            return 'Reset de Senha';
        }
        else if($valor == TIPO_LOG::$ALTERACAO_SENHA)
        {
            return 'Alteração de Senha';
        }
        else if($valor == TIPO_LOG::$NOVO_USUARIO)
        {
            return 'Novo usuário';
        }
        else if($valor == TIPO_LOG::$ALTERACAO_USUARIO)
        {
            return 'Atualiza usuário';
        }
    }

    public static function Combo()
    {
        return 
        [
            TIPO_LOG::$LOGIN => TIPO_LOG::GetTipo(TIPO_LOG::$LOGIN),
            TIPO_LOG::$LOGOUT => TIPO_LOG::GetTipo(TIPO_LOG::$LOGOUT),
            TIPO_LOG::$ARQUIVO => TIPO_LOG::GetTipo(TIPO_LOG::$ARQUIVO),
            TIPO_LOG::$ACESSO => TIPO_LOG::GetTipo(TIPO_LOG::$ACESSO),
            TIPO_LOG::$RESET_SENHA => TIPO_LOG::GetTipo(TIPO_LOG::$RESET_SENHA),
            TIPO_LOG::$ALTERACAO_SENHA => TIPO_LOG::GetTipo(TIPO_LOG::$ALTERACAO_SENHA),
            TIPO_LOG::$NOVO_USUARIO => TIPO_LOG::GetTipo(TIPO_LOG::$NOVO_USUARIO),
            TIPO_LOG::$ALTERACAO_USUARIO => TIPO_LOG::GetTipo(TIPO_LOG::$ALTERACAO_USUARIO),
        ];
    }
}
