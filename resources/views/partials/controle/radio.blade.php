{{--
    Cria um radio customizado
    * id - identificação do componente no DOM (obrigatório)
    * name - identificação do valor no controller (obrigatório)
    * valor - valor do componente (obrigatório)
    * label - texto que aparecerá na frente do componente
    * classe - permite adicionar classes CSS ao componente
    * obrigatorio - indica se o componente terá a propriedade 'required' ativa
    * valor_selecionado - esse valor será comparado ao valor do componente, caso seja igual, o componente ficará "marcado"

    exemplo de implementação:

    @include('partials.controle.radio',
    [
        'id'=>'txtIdComponente',
        'name'=>'componente_name',
        'label'=>'Componente Texto',
        'opcoes'=>['N'=>'Não','S'=>'Sim'],
        'valor_selecionado'=>'N',
        'classe'=>'text-danger',
        'obrigatorio'=>true,
    ])
--}}

@foreach($opcoes as $key=>$value)

    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input {{!empty($classe) ? $classe : ''}}" name="{{$name}}" id="{{$id.'_'.$key}}" value="{{$key}}" {{(!empty($valor_selecionado) && $valor_selecionado == $key ? 'checked' : '')}} {{!empty($obrigatorio) && $obrigatorio ? 'required' : ''}}>
        <label class="custom-control-label" for="{{$id.'_'.$key}}">{{(!empty($value) ? $value : '')}}</label>
    </div>

@endforeach
