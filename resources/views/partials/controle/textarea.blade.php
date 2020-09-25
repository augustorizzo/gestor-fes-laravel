{{--
    Cria um input:textarea simples.
    * id - identificação do componente no DOM (obrigatório)
    * name - identificação do valor no controller (obrigatório)
    * label - nome que aparecerá na tela acima do componente
    * classe - permite adicionar classes CSS ao componente
    * tamanho - limitador da quantidade de caracteres no componente
    * obrigatorio - indica se o componente terá a propriedade 'required' ativa
    * texto - valor do campo ao criar o componente
    * linhas - quantidade de linhas do componente, por padrão é 5

    exemplo de implementação:

    @include('partials.controle.textarea',
    [
        'id'=>'txtIdComponente',
        'name'=>'componente_name',
        'label'=>'Componente Texto',
        'classe'=>'border border-primary',
        'tamanho'=>'200',
        'obrigatorio'=>true,
        'texto'=>'Seu_texto_aqui',
        'linhas'=>5,
    ])

--}}
<label for="{{$id}}">{{!empty($label) ? $label : ''}}</label>
<textarea name="{{$name}}" id="{{$id}}" rows="{{!empty($linhas) ? $linhas : '5'}}" class="form-control" maxlength="{{!empty($tamanho) ? $tamanho : ''}}" {{!empty($obrigatorio) && $obrigatorio ? 'required' : ''}}>{{!empty($texto) ? $texto : ''}}</textarea>
