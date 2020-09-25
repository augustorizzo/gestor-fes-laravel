{{--
    Cria um checkbox toggle. Para o efeito desejado esse controle usa o plugin: Bootstrap Toggle (https://www.bootstraptoggle.com/)

    * id - identificação do componente no DOM (obrigatório)
    * name - identificação do valor no controller (obrigatório)
    * label_on - rótulo que aparecerá quando o controle estiver ativo
    * label_off - rótulo que aparecerá quando o controle estiver inativo
    * icone_on - icone do fontawesome que será incluído no rótulo do controle ativo
    * icone_off - icone do fontawesome que será incluído no rótulo do controle inativo
    * style_on - estilo que será incluído no rótulo do controle ativo (primary,success,info,warning,danger,default)
    * style_off - estilo que será incluído no rótulo do controle inativo (primary,success,info,warning,danger,default)
    * ligado - indica o estado inicial do controle

    exemplo de implementação:

    @include('partials.controle.toggle',
    [
        'id'=>'txtIdComponente',
        'name'=>'componente_name',
        'label_on'=>'Ligado',
        'label_off'=>'Desligado',
        'icone_on'=>'fa fa-check',
        'icone_off'=>'fa fa-times',
        'style_on'=>'success',
        'style_off'=>'danger',
        'ligado'=>true,
    ])

--}}
<div class="checkbox">
    <label>
        <input name="{{$name}}" id="{{$id}}" type="checkbox" data-toggle="toggle" data-on="{{(!empty($icone_on) ? ('<i class="'.$icone_on.'"></i> ') : '') . (!empty($label_on) ? $label_on : "On")}}" data-off="{{(!empty($icone_off) ? ('<i class="'.$icone_off.'"></i> ') : '') . (!empty($label_off) ? $label_off : "Off")}}" data-offstyle="{{!empty($style_off) ? $style_off : 'default'}}" data-onstyle="{{!empty($style_on) ? $style_on : 'success'}}" {{!empty($ligado)&& $ligado ? 'checked': ''}}/>
    </label>
</div>
