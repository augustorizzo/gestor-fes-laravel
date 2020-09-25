<?php

namespace App\Observers\Planejamento;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Planejamento\PlanoAcao;
use App\Models\Logs\Planejamento\LogPlanoAcao;
use App\Enum\TIPO_AUDITORIA;

class PlanoAcaoObserver
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Evento disparado ao criar um novo plano de ação.
     *
     * @param  PlanoAcao  $plano
     * @return void
     */
    public function created(PlanoAcao $plano)
    {
        LogPlanoAcao::create(
        [
            'fk_usuario' => auth::user()->id,
            'fk_plano'=>$plano->getId(),
            'fk_tipo'=>TIPO_AUDITORIA::$CRIACAO,
            'ip' => $this->request->ip(),
            'mensagem'=>'Plano de ação criado',
            'obs'=>null
        ]);
    }

    /**
     * Evento disparado ao atualizar um plano de ação.
     *
     * @param  PlanoAcao  $plano
     * @return void
     */
    public function updated(PlanoAcao $plano)
    {
        if(count($plano->getChanges()) > 0)
        {
            LogPlanoAcao::create(
            [
                'fk_usuario' => auth::user()->id,
                'fk_plano'=>$plano->getId(),
                'fk_tipo'=>TIPO_AUDITORIA::$ATUALIZACAO,
                'ip' => $this->request->ip(),
                'mensagem'=>'Plano de ação atualizado',
                'obs'=> 'campos atualizados: '.implode(',',array_keys($plano->getChanges()))
            ]);
        }
    }

    /**
     * Evento disparado ao deletar plano de ação.
     *
     * @param  PlanoAcao $plano
     * @return void
     */
    public function deleted(PlanoAcao $plano)
    {
        LogPlanoAcao::create(
        [
            'fk_usuario' => auth::user()->id,
            'fk_plano'=>$plano->getId(),
            'fk_tipo'=>TIPO_AUDITORIA::$ATUALIZACAO,
            'ip' => $this->request->ip(),
            'mensagem'=>'Plano de ação atualizado',
            'obs'=> 'campos atualizados: '.implode(',',array_keys($plano->getChanges()))
        ]);
    }
}
