<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Sistema;
use App\Log;
use App\Enum\MENSAGEM;
use Hash;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Util extends Controller
{
    /**
     * Salva o arquivo no servidor e retorna o caminho do arquivo
     */
    public static function SalvarArquivo($arquivo,$pasta,$nome)
    {
        $nameFile = null;
        if(empty($nome))
        {
            $name = md5(uniqid(rand(), true));
            $extension = $arquivo->extension();
            $nameFile= "{$name}.{$extension}";
        }
        else
        {
            $nameFile = $nome;
        }

        return 'storage/'.$arquivo->storeAs($pasta, $nameFile);
    }

    /**
     * Busca no BD o sistema em questão
     */
    public static function getSistema()
    {
        return Sistema::where(Sistema::$codigo,env('APP_SISTEMA'))->first();
    }

     /**
     * Retorna o valor com a criptografia do sistema
     */
    public static function Criptografia($valor)
    {
        return Hash::make($valor);
    }

    /**
     * Retira os '.' e '-' do CPF
     */
    public static function LimpaCpf($cpf)
    {
        return str_replace('/','',str_replace('-','',str_replace('.','',$cpf)));
    }

    /**
     * Gera o registro na tabela de log do sistema
     */
    public static function Log(Request $request,$tipo,$descricao,$status=true,$target=null)
    {
        $log = New Log;
        $log->setFkTipo($tipo);
        $log->setFkTarget($target);
        $log->setFkFilial(Util::GetFilial()->getId());
        $log->setIp($request->ip());
        $log->setStatus($status);
        $log->setDescricao($descricao);
        $log->setData(Carbon::now());
        $log->setFkSistema(Util::getSistema()->getId());
        $log->setFkUsuario(Auth::user()->getId());
        $log->save();
    }

    public static function TrataMensagemErro($tipo,$ex)
    {
        $msg = '';

        if(strtolower($tipo) == 'pdo')
        {
            $msg = '[BD] ';
            switch($ex->getCode())
            {
                case '23000':
                    $msg .= 'O registro está em uso por outras tabelas';
                    break;
                default:
                    $msg .= '['. $ex->getCode() .'] '. $ex->getMessage();
                    break;
            }
        }

        return $msg;
    }

    public static function Mensagem($codigo,$titulo,$mensagem=null,$timer=null)
    {
        session()->flash('msg_titulo',$titulo);
        session()->flash(MENSAGEM::GetTipo($codigo),$mensagem);
        session()->flash('msg_timer',$timer);
    }

    public static function ImplodeTags($tags,$caractere)
    {
        return implode($caractere,array_map(function ($entry){return $entry->value;},json_decode($tags)));
    }

    public static function RemoveCaracter($palavra)
    {
        return str_replace(' ','_',str_replace('ã','a',str_replace('é','e',str_replace('ó','o',str_replace('ç','c',$palavra)))));
    }

    public static function VerificaDuplicidade($id_request,$consulta)
    {
        return ((empty($id_request) && !empty($consulta)) || (!empty($id_request) && !empty($consulta) && $id_request != $consulta->getId()));
    }

    public static function IsNull($valor,$substituir)
    {
        return !empty($valor) ? $valor : $substituir;
    }

    public static function SeNotNull($objeto,$valor,$outro)
    {
        return !empty($objeto) ? $valor : $outro;
    }

    public static function GetParametro($codigo)
    {
        $parametro = Parametro::where(Parametro::$codigo,$codigo)->first();
        return (empty($parametro) ? null : $parametro->getValor());
    }

    public static function Implode($separador,$array)
    {
        $valor = "";

        for($x = 0; $x < count($array); $x++)
        {
            $valor .= ($array[$x] . ($x+1 < count($array) ? $separador : ''));
        }

        return $valor;
    }

    public static function StringAleatoria()
    {
        return md5(uniqid(rand(), true));
    }

    public static function Ternario($condicao,$verdadeiro,$falso)
    {
        return ($condicao ? $verdadeiro : $falso);
    }

    public static function Explode($separador,$string)
    {
        return explode($separador,$string);
    }

    public static function TrataCampoMoeda($valor)
    {
        return (empty($valor) ? null : (float) str_replace(',','.',str_replace('.','',$valor)));
    }

    public static function FormataMoeda($valor)
    {
        return  number_format($valor,2,",",".");
    }

    public static function CaminhoCompleto($arquivo)
    {
        $host = env('APP_URL');

        //verifica se é um arquivo de imagem e se o mesmo existe. caso não exista, retorna uma imagem padrão para evitar quebrar o layout
        if((!file_exists($arquivo) && Util::Contem($arquivo,['.jpg','.png','.jpeg'])))
        {
            return ($host.'/img/img-nao-encontrada.jpg');
        }
        else if(!file_exists($arquivo))
        {
            return ($host.'/img/img-nao-encontrada.jpg');
        }
        else
        {
            return ($host.'/'.$arquivo);
        }
    }

    public static function getMes($mes)
    {
        switch($mes)
        {
            case 1: return 'Janeiro';
            case 2: return 'Fevereiro';
            case 3: return 'Março';
            case 4: return 'Abril';
            case 5: return 'Maio';
            case 6: return 'Junho';
            case 7: return 'Julho';
            case 8: return 'Agosto';
            case 9: return 'Setembro';
            case 10: return 'Outubro';
            case 11: return 'Novembro';
            case 12: return 'Dezembro';
            default: return '';
        }
    }

    public static function GetDataAtual()
    {
        return Carbon::now()->format('d/m/Y');
    }

    public static function GetData()
    {
        return Carbon::now();
    }

    public static function RetornaDataModel($data)
    {
        return !empty($data) ? (new Carbon($data))->format('d/m/Y') : null;
    }

    public static function RetornaHoraModel($hora)
    {
        return !empty($hora) ? (new Carbon($hora))->format('H:i') : null;
    }

    public static function RetornaDataHora($timestamp)
    {
        return !empty($timestamp) ? (new Carbon($timestamp))->format('d/m/Y H:i') : null;
    }

    public static function SetDataModel($valor)
    {
        return (!empty($valor) ? Carbon::createFromFormat('d/m/Y',$valor) : null);
    }

    public static function SetHoraModel($valor)
    {
        return (!empty($valor) ? Carbon::createFromFormat('H:i',$valor) : null);
    }

    public static function GeraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
    {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;

        if ($maiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        if ($simbolos) $caracteres .= $simb;

        $len = strlen($caracteres);

        for ($n = 1; $n <= $tamanho; $n++)
        {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand-1];
        }

        return $retorno;
    }

    public static function Criptografa($valor)
    {
	    return Crypt::encrypt($valor);
    }

    public static function Decriptografa($valor)
    {
	    return Crypt::decrypt($valor);
    }

    public static function tirarAcentos($string)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
    }

    public static function MenuHierarquia($rota,$submenus)
    {
        foreach($submenus as $subRota)
        {
            if($subRota['rota'] == $rota)
            {
                return true;
            }
        }
    }

    public static function GUID()
    {
        mt_srand((double)microtime()*10000);

        return strtoupper(md5(uniqid(rand(), true)));
    }

    public static function UsuarioFoto()
    {
        return Util::CaminhoCompleto(!empty(Auth::user()->getFoto()) ? Auth::user()->getFoto() : 'img/default-user.png');
    }

    public static function GetFilial()
    {
        return session('user.filial');
    }

    public static function ImagemTo64($arquivo)
    {
        $type = $arquivo->extension();
        $data = file_get_contents($arquivo);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return $base64;
    }

    public static function Contem($str, array $arr)
    {
        foreach($arr as $a)
        {

            if (stripos($str,$a) !== false)
            {
                return true;
            }
        }
        return false;
    }

    public static function CaminhoFisico($arquivo)
    {
        return base_path($arquivo);
    }

}
