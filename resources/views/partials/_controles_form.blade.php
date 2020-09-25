

@if($controle["tipo"] == 'hidden')

    <input type="hidden" id="{{$controle['id']}}" name="{{$controle['nome']}}" />

@elseif($controle["tipo"] == 'slider')

    <div class="form-group row mb-0">
        <div class="col-form">
            <label class="switch  pull-right">
                <input id="{{$controle['id']}}" name="{{$controle['nome']}}" type="checkbox" checked>
                <span class="slider round"></span>
            </label>
        </div>
    </div>

@elseif($controle["tipo"] == 'txt')

    <input id="{{$controle['id']}}"
        class="form-control {{ (!empty($controle["classe"]) ? $controle["classe"] : '' ) }}"
        type="text"
        maxlength="{{$controle['tamanho']}}"
        name="{{$controle['nome']}}"
        {{ (!empty($controle["style"]) ? 'style='.$controle["style"] : '' ) }}
        {{ (!empty($controle["autocomplete"])  ? 'autocomplete='.$controle["autocomplete"] : '') }}
        {{ (!empty($controle["placeholder"]) ? 'placeholder='.$controle["placeholder"] :'') }}
        {{ (!empty($controle["required"]) && $controle["required"] == 'true' ? 'required':'') }}
        {{ (!empty($controle["autofocus"]) && $controle["autofocus"] == 'true' ? 'autofocus' :'') }}
        {{ (!empty($controle["disabled"]) && $controle['disabled'] == 'true' ? 'disabled' : '') }} />

@elseif($controle["tipo"] == 'password')

    <input id="{{$controle['id']}}"
        class="form-control {{ (!empty($controle["classe"]) ? $controle["classe"] : '' ) }}"
        type="password"
        maxlength="{{$controle['tamanho']}}"
        name="{{$controle['nome']}}"
        {{ (!empty($controle["style"]) ? 'style='.$controle["style"] : '' ) }}
        {{ (!empty($controle["autocomplete"])  ? 'autocomplete='.$controle["autocomplete"] : '') }}
        {{ (!empty($controle["placeholder"]) ? 'placeholder='.$controle["placeholder"] :'') }}
        {{ (!empty($controle["required"]) && $controle["required"] == 'true' ? 'required':'') }}
        {{ (!empty($controle["autofocus"]) && $controle["autofocus"] == 'true' ? 'autofocus' :'') }}
        {{ (!empty($controle["disabled"]) && $controle['disabled'] == 'true' ? 'disabled' : '') }} />

@elseif($controle["tipo"] == 'email')

    <input id="{{$controle['id']}}"
        class="form-control {{ (!empty($controle["classe"]) ? $controle["classe"] : '' ) }}"
        type="email"
        maxlength="{{$controle['tamanho']}}"
        name="{{$controle['nome']}}"
        {{ (!empty($controle["style"]) ? 'style='.$controle["style"] : '' ) }}
        {{ (!empty($controle["autocomplete"])  ? 'autocomplete='.$controle["autocomplete"] : '') }}
        {{ (!empty($controle["placeholder"]) ? 'placeholder='.$controle["placeholder"] :'') }}
        {{ (!empty($controle["required"]) && $controle["required"] == 'true' ? 'required':'') }}
        {{ (!empty($controle["autofocus"]) && $controle["autofocus"] == 'true' ? 'autofocus' :'') }}
        {{ (!empty($controle["disabled"]) && $controle['disabled'] == 'true' ? 'disabled' : '') }} />

@elseif($controle["tipo"] == 'div')

    <div id="{{$controle['id']}}"
        class="form-control {{ (!empty($controle["classe"]) ? $controle["classe"] : '' ) }}"
        {{ (!empty($controle["style"]) ? 'style='.$controle["style"] : '' ) }}
        {{ (!empty($controle["disabled"]) && $controle['disabled'] == 'true' ? 'disabled' : '') }}>
    </div>

@elseif($controle["tipo"] == 'textarea')

    <textarea id="{{$controle['id']}}"
            class="form-control noresize"
            type="textarea"
            maxlength="{{$controle['tamanho']}}"
            name="{{$controle['nome']}}"
            rows="{{$controle['rows']}}"
            {{ (!empty($controle["style"]) ? 'style='.$controle["style"] : '' ) }}
            {{ (!empty($controle["autocomplete"])  ? 'autocomplete='.$controle["autocomplete"] : '') }}
            {{ (!empty($controle["placeholder"]) ? 'placeholder='.$controle["placeholder"] :'') }}
            {{ (!empty($controle["required"]) && $controle["required"] == 'true' ? 'required':'') }}
            {{ (!empty($controle["autofocus"]) && $controle["autofocus"] == 'true' ? 'autofocus' :'') }}
            {{ (!empty($controle["disabled"]) && $controle['disabled'] == 'true' ? 'disabled' : '') }}></textarea>

@elseif($controle["tipo"] == 'arquivo')

<input id="{{$controle['id']}}"
        type="file"
        class="form-control {{ (!empty($controle["classe"]) ? $controle["classe"] : '' ) }}"
        name="{{$controle['nome']}}"
        {{ (!empty($controle["multiplo"]) && $controle["multiplo"] == 'true' ? 'multiple="multiple"' : '' ) }}
        {{ (!empty($controle["style"]) ? 'style='.$controle["style"] : '' ) }}
        {{ (!empty($controle["filtro"]) ?  'accept='.$controle["filtro"] : '') }}
        {{ (!empty($controle["required"]) && $controle["required"] == 'true' ? 'required':'') }}
        {{ (!empty($controle["autofocus"]) && $controle["autofocus"] == 'true' ? 'autofocus' :'') }}
        {{ (!empty($controle["disabled"]) && $controle['disabled'] == 'true' ? 'disabled' : '') }}/>

@elseif($controle["tipo"] == 'icone')
    <br/>
    <i id="{{$controle['id']}}"
        class="{{ (!empty($controle["classe"]) ? $controle["classe"] : '' ) }}"
        {{ (!empty($controle["style"]) ? 'style='.$controle["style"] : '' ) }} ></i>

@elseif($controle["tipo"] == 'combo')

    <select id="{{$controle['id']}}"
            class="form-control {{ (!empty($controle["classe"]) ? $controle["classe"] : '' ) }}"
            name="{{$controle['nome']}}"
            {{ (!empty($controle["multiplo"]) && $controle["multiplo"] == 'true' ? 'multiple=multiple' : '' ) }}
            {{ (!empty($controle["style"]) ? 'style='.$controle["style"] : '' ) }}
            {{ (!empty($controle["required"]) && $controle["required"] == 'true' ? 'required':'') }}
            {{ (!empty($controle["autofocus"]) && $controle["autofocus"] == 'true' ? 'autofocus' :'') }}
            {{ (!empty($controle["disabled"]) && $controle['disabled'] == 'true' ? 'disabled' : '') }}>

        @if(!empty($controle['default']))
            <option value="">{{$controle['default']}}</option>
        @endif

        @foreach($controle['opcoes'] as $valor=>$nome)

            <option value="{{$valor}}">{{$nome}}</option>

        @endforeach

    </select>


@elseif($controle["tipo"] == 'span')

<br/>

    @if(!empty($controle['tag']))
        <{{$controle['tag']}}>
    @endif

    <span id="{{$controle['id']}}"
          name="{{(!empty($controle['nome']) ? $controle['nome'] : '' )}}"
          class="form-control {{(!empty($controle['classe']) ? $controle['classe'] : '' )}}"
          data="{{(!empty($controle['dado']) ? $controle['dado'] : '' )}}"
          title="{{(!empty($controle['title']) ? $controle['title'] : '' )}}">

          {{(!empty($controle['valor']) ? $controle['valor'] : '' )}}

    </span>

    @if(!empty($controle['tag']))
        </{{$controle['tag']}}>
    @endif


@elseif($controle["tipo"] == 'botao')
    <button id="{{$controle['id']}}"
            type="button"
            class="form-control {{(!empty($controle['classe']) ? $controle['classe'] : '' )}}"
            data="{{(!empty($controle['dado']) ? $controle['dado'] : '' )}}"
            title="{{(!empty($controle['title']) ? $controle['title'] : '' )}}">

            <i class="{{(!empty($controle['icone']) ? $controle['icone'] : '' )}}"></i>

            {{(!empty($controle['texto']) ? $controle['texto'] : '' )}}

    </button>

@elseif($controle["tipo"] == 'tabela')
    <table id="{{$controle['id']}}" class="table table-hover table-striped {{(!empty($controle['classe']) ? $controle['classe'] : '' )}}">
        <thead>
            <tr>
                @foreach($controle['cabecalho'] as $cabecalho)
                    <th>{{$cabecalho}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

@elseif($controle["tipo"] == 'numero')
    <input id="{{$controle['id']}}"
            min="{{$controle['min']}}"
            {{ empty($controle['max']) ? '' : ('max='.$controle['max']) }}
            class="form-control {{(!empty($controle['classe']) ? $controle['classe'] : '' )}}"
            name="{{(!empty($controle['nome']) ? $controle['nome'] : '' )}}"
            type="number"
            value="{{$controle['min']}}"/>

@elseif($controle["tipo"] == 'img-miniatura')
    <img id="{{$controle['id']}}"
         class="img-thumbnail {{(!empty($controle['classe']) ? $controle['classe'] : '' )}}"
         src="{{$controle['src']}}"
         {{(!empty($controle["style"]) ? 'style='.$controle["style"] : '' )}}/>

@elseif($controle["tipo"] == 'titulo')

    <{{$controle['tag']}} id="{{$controle['id']}}"
        class="{{(!empty($controle['classe']) ? $controle['classe'] : '' )}}">
        {{$controle['texto']}}
    </{{$controle['tag']}}>

@elseif($controle["tipo"] == 'checkbox')

    @include('partials.controle.checkbox',
    [
        'id'=>$controle['id'],
        'label'=>$controle['label_controle'],
        'name'=>$controle['nome'],
        'valor'=>$controle['valor'],
        'valor_selecionado'=>$controle['selecionado'],
        'classe'=>(!empty($controle['classe']) ? $controle['classe'] : ''),
        'obrigatorio'=>(!empty($controle['required']) ? $controle['required'] : null)
    ])

@elseif($controle["tipo"] == 'radio')

    <br/>
    @include('partials.controle.radio',
    [
        'id'=>$controle['id'],
        'name'=>$controle['nome'],
        'opcoes'=>$controle['opcoes'],
        'valor_selecionado'=>$controle['selecionado'],
        'classe'=>(!empty($controle['classe']) ? $controle['classe'] : ''),
        'obrigatorio'=>(!empty($controle['required']) ? $controle['required'] : null)
    ])

@elseif($controle["tipo"] == 'link')

    <a id="{{$controle['id']}}" {{(!empty($controle['nova_janela']) && $controle['nova_janela'] == true) ? 'target="_blank"' : '' }}
        class="form-control {{(!empty($controle['classe']) ? $controle['classe'] : '' )}}"
        href="{{(!empty($controle['href']) ? $controle['href'] : '#' )}}"
        title="{{(!empty($controle['tooltip']) ? $controle['tooltip'] : '' )}}">

        <i class="{{(!empty($controle['icone']) ? $controle['icone'] : '' )}}"></i>

        {{(!empty($controle['texto']) ? $controle['texto'] : '' )}}

    </a>

@endif
