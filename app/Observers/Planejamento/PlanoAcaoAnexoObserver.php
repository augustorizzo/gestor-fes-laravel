<?php

namespace App\Observers\Planejamento;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Planejamento\PlanoAcaoAnexo;
use App\Models\Logs\Planejamento\LogPlanoAcao;
use App\Enum\TIPO_AUDITORIA;

class PlanoAcaoAnexoObserver
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Evento disparado ao criar um novo anexo do plano de ação.
     *
     * @param  PlanoAcaoAnexo  $anexo
     * @return void
     */
    public function created(PlanoAcaoAnexo $anexo)
    {
        LogPlanoAcao::create(
        [
            'fk_usuario' => auth::user()->id,
            'fk_plano'=>$anexo->getFkPlano(),
            'fk_tipo'=>TIPO_AUDITORIA::$CRIACAO,
            'ip' => $this->request->ip(),
            'mensagem'=>'Anexado arquivo "'.$anexo->getNome(). '"',
            'obs'=>null
        ]);
    }


    /**
     * Evento disparado ao deletar o anexo do plano de ação.
     *
     * @param  PlanoAcaoAnexo $anexo
     * @return void
     */
    public function deleted(PlanoAcaoAnexo $anexo)
    {
        LogPlanoAcao::create(
        [
            'fk_usuario' => auth::user()->id,
            'fk_plano'=>$anexo->getFkPlano(),
            'fk_tipo'=>TIPO_AUDITORIA::$ATUALIZACAO,
            'ip' => $this->request->ip(),
            'mensagem'=>'Excluído arquivo "'.$anexo->getNome(). '"',
            'obs'=> null
        ]);
    }
}
