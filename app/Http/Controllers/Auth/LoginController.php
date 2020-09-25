<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'usuario';
    }

    protected function authenticated(Request $request, $user)
    {
        //bloqueia o acesso se o usuário estiver inativo ou sem nenhuma permissão
        if(!$user->getAtivo() || $user->Permissoes->count() == 0)
        {
            auth::logout();

            Util::Mensagem(MENSAGEM::$ALERTA,"Usuário sem acesso ao sistema",'entre em contato com o administrador do sistema');

            return redirect()->route('login');
        }

        return redirect()->route('filial.login');
    }
}
