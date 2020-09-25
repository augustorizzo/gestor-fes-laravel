{{--
    Cria um combo simples.
    * id - identificação do componente no DOM (obrigatório)
    * name - identificação do valor no controller (obrigatório)
    * label - nome que aparecerá na tela acima do componente
    * classe - permite adicionar classes CSS ao componente
    * opcoes - array chave valor que serão as opções do combo
    * selecionado - valor que estará selecionado ao criar o combo
    * obrigatorio - indica se o componente terá a propriedade 'required' ativa
    * propriedades - outras propriedades do elemento
    * padrao - opção que será colocada como a padrão com valor ''


    exemplo de implementação:

    @include('partials.controle.combo',
    [
        'id'=>'cbIdComponente',
        'name'=>'componente_name',
        'label'=>'Componente Combo',
        'classe'=>'border border-primary',
        'opcoes'=>['S'=>'Sim','N'=>'Não'],
        'selecionado'=>'S',
        'obrigatorio'=>true,
        'propriedades'=>'data="1" data-color="azul"',
        'padrao'=>'Selecione',
    ])
--}}

<label for="{{$id}}">{{$label}}</label>
<select name="{{$name}}" id="{{$id}}" class="form-control {{!empty($classe) ? $classe : ''}}" {{!empty($propriedades) ? $propriedades : ''}}>

    @if(!empty($padrao))
        <option value="">{{$padrao}}</option>
    @endif

    @foreach($opcoes as $key=>$value)
        <option value="{{$key}}" {{(!empty($selecionado) && $selecionado == $key) ? 'selected' : ''}} >{{$value}}</option>
    @endforeach
</select>
