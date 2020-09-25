<label for="{{$id}}">{{$label}}</label>
<select name="{{$name}}" id="{{$id}}" class="form-control {{!empty($classe) ? $classe : ''}}" {{!empty($propriedades) ? $propriedades : ''}} {{!empty($obrigatorio) && $obrigatorio ? 'required' : ''}}>

    @if(!empty($padrao))
        <option value="">{{$padrao}}</option>
    @endif

    @foreach($opcoes as $key=>$value)
        <option value="{{$key}}" {{(!empty($selecionado) && $selecionado == $key) ? 'selected' : ''}} >{{$value}}</option>
    @endforeach
</select>
