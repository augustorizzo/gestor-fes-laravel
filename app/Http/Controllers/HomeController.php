<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classe_Rota;
use App\Chamado;
use App\Rota;
use App\Http\Enum\STATUS;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera a rota padrão
        $rotaPadrao = Classe_Rota::where(Classe_rota::$fk_classe,Auth::user()->Classe->first()->getId())->where(Classe_rota::$rota_padrao,true)->first();

        if(!empty($rotaPadrao))
        {
           // return dd($rotaPadrao->getFkRota());

            $rota = Rota::find($rotaPadrao->getFkRota());

            if($rota->getRota() != 'home')
            {
                return redirect()->route($rota->getRota());
            }
        }

        return $this->ViewHome();
    }

    public function ViewHome()
    {
        $pendentes = 0;
        $andamento = 0;
        $concluidos = 0;
        $tma = 0;

        return View('home',
        [
            'pendentes'=>$pendentes,
            'andamento'=>$andamento,
            'concluidos'=>$concluidos,
            'tma'=>$tma
        ]);
    }
}
