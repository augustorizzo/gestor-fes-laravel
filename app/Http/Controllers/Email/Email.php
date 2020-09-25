<?php

namespace App\Http\Controllers\Email;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Util;
use PHPMailer\PHPMailer\PHPMailer;
use App\User;

class Email extends Controller
{

    private static function EnviarEmail($destinatario,$assunto,$mensagem)
    {
        try
        {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->CharSet = 'utf-8';
            $mail->SMTPAuth =true;
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Host = env('MAIL_HOST');
            $mail->Port = env('MAIL_PORT');
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->setFrom(env('MAIL_EMAIL'), env('MAIL_NOME')); 
            $mail->Subject = $assunto;
            $mail->MsgHTML($mensagem);
            $mail->addAddress($destinatario);
            $mail->send();
        }
        catch(phpmailerException $ex)
        {
            //dd($ex);
        }
        catch(Exception $ex)
        {
            //dd($ex);
        }
    }

    public static function AlteracaoSenha(User $usuario)
    {
        try
        {
            Email::EnviarEmail
            (
                $usuario->getEmail(),
                ('['. env('APP_SISTEMA') .'][SENHA][ALTERAÇÃO] alteração de senha de acesso'),
                view('emails.auth.alteracao_senha',['nome' =>$usuario->getNome(), 'id_usuario' => $usuario->getId()])->render()
            );
        }
        catch(\Exception $ex)
        {
            //faz nada
        }

    }

    public static function ResetSenha(User $usuario,$senha)
    {
        Email::EnviarEmail
        (
            $usuario->getEmail(),
            ('['. env('APP_SISTEMA') .'][SENHA][RESET] nova senha de acesso'),
            view
            (
                'emails.auth.resetar_senha',
                [
                    'nome'=>$usuario->getNome(),
                    'id_usuario'=>$usuario->getId(),
                    'senha'=>$senha
                ]
            )->render()
        );
    }

    public static function NovoUsuario(User $usuario,$senha)
    {
        Email::EnviarEmail
        (
            $usuario->getEmail(),
            ('Seja bem vindo ao '. env('APP_SISTEMA')),
            view
            (
                'emails.adm.novo_usuario',
                [
                    'nome'=>$usuario->getNome(),
                    'id_usuario'=>$usuario->getId(),
                    'senha'=>$senha
                ]
            )->render()
        );
    }
}