{{--
    Cria um input:number simples.
    * id - identificação do componente no DOM (obrigatório)
    * name - identificação do valor no controller (obrigatório)
    * label - nome que aparecerá na tela acima do componente
    * classe - permite adicionar classes CSS ao componente
    * minimo - valor mínimo do componente
    * maximo - valor máximo do componente
    * intervalo - intervalo em que o valor será incrementado
    * obrigatorio - indica se o componente terá a propriedade 'required' ativa
    * valor - valor do campo ao criar o componente

    exemplo de implementação:

    @include('partials.controle.number',
    [
        'id'=>'txtIdComponente',
        'name'=>'componente_name',
        'label'=>'Componente Number',
        'classe'=>'border border-primary',
        'minimo'=>0,
        'maximo'=>20,
        'intervalo'=>0.5,
        'valor'=>11.5,
        'obrigatorio'=>true,
    ])

--}}
<label for="{{$id}}">{{$label}}</label>
<input name="{{$name}}" id="{{$id}}" class="form-control {{!empty($classe) ? $classe : ''}}" type="number" min="{{!empty($minimo) ? $minimo : ''}}" max="{{!empty($maximo) ? $maximo : ''}}" step="{{!empty($intervalo) ? $intervalo : ''}}"  {{!empty($obrigatorio) && $obrigatorio ? 'required' : ''}} value="{{!empty($valor) ? $valor : ''}}">
