{{--
    Cria um checkbox customizado
    * id - identificação do componente no DOM (obrigatório)
    * name - identificação do valor no controller (obrigatório)
    * valor - valor do componente (obrigatório)
    * label - texto que aparecerá na frente do componente
    * classe - permite adicionar classes CSS ao componente
    * obrigatorio - indica se o componente terá a propriedade 'required' ativa
    * valor_selecionado - esse valor será comparado ao valor do componente, caso seja igual, o componente ficará "marcado"

    exemplo de implementação:

    @include('partials.controle.checkbox',
    [
        'id'=>'txtIdComponente',
        'name'=>'componente_name',
        'label'=>'Componente Texto',
        'valor'=>'N',
        'valor_selecionado'=>'N',
        'classe'=>'text-danger',
        'obrigatorio'=>true,
    ])

--}}
<div class="animated-checkbox mr-2">
    <label>
      <input name="{{$name}}" id="{{$id}}" class="form-control {{!empty($classe) ? $classe : ''}}" {{!empty($obrigatorio) && $obrigatorio ? 'required' : ''}} type="checkbox" value="{{$valor}}" {{(!empty($valor_selecionado) && $valor_selecionado == $valor ? 'checked' : '')}}><span class="label-text">{{(!empty($label) ? $label : '')}}</span>
    </label>
</div>
