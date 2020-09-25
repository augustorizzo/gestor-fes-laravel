{{--
    Cria um input:text simples.
    * id - identificação do componente no DOM (obrigatório)
    * name - identificação do valor no controller (obrigatório)
    * label - nome que aparecerá na tela acima do componente
    * classe - permite adicionar classes CSS ao componente
    * tamanho - limitador da quantidade de caracteres no componente
    * obrigatorio - indica se o componente terá a propriedade 'required' ativa
    * texto - valor do campo ao criar o componente

    exemplo de implementação:

    @include('partials.controle.texto',
    [
        'id'=>'txtIdComponente',
        'name'=>'componente_name',
        'label'=>'Componente Texto',
        'classe'=>'border border-primary',
        'tamanho'=>'50',
        'obrigatorio'=>true,
        'texto'=>'Seu_texto_aqui',
    ])

--}}

<input name="{{$name}}" id="{{$id}}" class="form-control {{!empty($classe) ? $classe : ''}}" type="text" maxlength="{{!empty($tamanho) ? $tamanho : ''}}"  {{!empty($obrigatorio) && $obrigatorio ? 'required' : ''}} value="{{!empty($texto) ? $texto : ''}}">
