<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RotaController;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function gerarCartaCompromisso($prefixo,$id_acolhimento,$sufixo)
    {
        try
        {
            $acolhimento = Acolhimento::Find($id_acolhimento);


            return PDF::loadView('pdf.acolhimento.carta_compromisso',['acolhimento'=>$acolhimento])
                    ->setPaper('a4', 'portrait')
                    ->stream('');
        }
        catch(\Exception $ex)
        {
            return Util::TrataMensagemErro('home','erro ao tentar gerar a carta compromisso do acolhido',$ex);
        }
    }

    public function gerarListaPertences($entrada,$prefixo,$id_acolhimento,$sufixo)
    {
        try
        {
            $acolhimento = Acolhimento::Find($id_acolhimento);

            return PDF::loadView('pdf.acolhimento.pertences_acolhido',['acolhimento'=>$acolhimento,'entrada'=>$entrada])
                    ->setPaper('a4', 'portrait')
                    ->stream();
        }
        catch(\Exception $ex)
        {
            return Util::TrataMensagemErro('home','erro ao tentar gerar a carta compromisso do acolhido',$ex);
        }
    }
}
