<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Estado;
use App\Models\Administracao\Programa;
use App\Models\Administracao\Eixo;
use App\Models\Administracao\Orgao;
use App\Models\Administracao\Corporacao;
use App\Models\Planejamento\Loa;
use App\Enum\CARGO;
use App\User;
use App\Models\Financeiro\GrupoDespesa;
use App\Unidade;
use App\Models\Aporte\TipoAporte;

class ComboController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public static function Estado()
    {
        return Estado::select(Estado::$id,Estado::$nome)->orderby(Estado::$nome)->get()
        ->mapWithKeys(function ($item)
        {
            return [$item->getId() => $item->getNome()];
        });
    }

    public static function Meses()
    {
        return
        [
            1=>'Janeiro',
            2=>'Fevereiro',
            3=>'Março',
            4=>'Abril',
            5=>'Maio',
            6=>'Junho',
            7=>'Julho',
            8=>'Agosto',
            9=>'Setembro',
            10=>'Outubro',
            11=>'Novembro',
            12=>'Dezembro'
        ];
    }


    public static function Loa()
    {
        return Loa::select(Loa::$id,Loa::$ano)->get()
        ->mapWithKeys(function ($item)
        {
            return [$item->getId() => $item->getAno()];
        });
    }

    public static function Programas()
    {
        return Programa::select(Programa::$id,Programa::$titulo)->get()
        ->mapWithKeys(function ($item)
        {
            return [$item->getId() => $item->getTitulo()];
        });
    }

    public static function Orgaos()
    {
        return Orgao::select(Orgao::$id,Orgao::$descricao,Orgao::$sigla)->get()
        ->mapWithKeys(function ($item)
        {
            return [$item->getId() => $item->getSigla().' - '.$item->getDescricao()];
        });
    }

    public static function Corporacao()
    {
        return Corporacao::select(Corporacao::$id,Corporacao::$nome,Corporacao::$sigla)->get()
        ->mapWithKeys(function ($item)
        {
            return [$item->getId() => $item->getSigla().' - '.$item->getNome()];
        });
    }

    public static function GrupoDespesa()
    {
        return GrupoDespesa::select(GrupoDespesa::$id,GrupoDespesa::$descricao)->get()
        ->mapWithKeys(function ($item)
        {
            return [$item->getId() => $item->getDescricao()];
        });
    }

    public static function Unidades()
    {
        return Unidade::select(Unidade::$sigla,Unidade::$descricao)->get()
        ->mapWithKeys(function ($item)
        {
            return [$item->getSigla() => $item->getDescricao()];
        });
    }

    public static function Responsaveis()
    {
        return User::select(User::$id,User::$nome,User::$sobrenome)
            ->whereIn(User::$fk_funcao,[CARGO::$COORDENADOR_FES,CARGO::$SECRETARIO_SEGURANCA])
            ->get()
            ->mapWithKeys(function ($item)
            {
                return [$item->getId() => $item->getNomeCompleto()];
            });
    }

    public static function ajaxEixos($id_programa,$ajax=true)
    {
        $eixos = Eixo::select(Eixo::$id,Eixo::$nome,Eixo::$abrv)->where(Eixo::$fk_programa,$id_programa)->get();

        if($ajax)
        {
            return response()->json($eixos->map(function($item){return ['id'=>$item->getId(),'valor'=> $item->getNome(),'abreviacao'=>$item->getAbrv()];}),200);
        }
        else
        {
            return $eixos->mapWithKeys(function($item){return [$item->getId() => $item->getNome()];});
        }
    }

    public static function Eixos()
    {
        return Eixo::select(Eixo::$id,Eixo::$nome,Eixo::$abrv)
            ->get()
            ->mapWithKeys(function($item)
            {
                return [$item->getId() => $item->getNome()];
            });
    }

    public static function TipoAporte()
    {
        return TipoAporte::select(TipoAporte::$id,TipoAporte::$descricao)->get()
        ->mapWithKeys(function ($item)
        {
            return [$item->getId() => $item->getDescricao()];
        });
    }
}
