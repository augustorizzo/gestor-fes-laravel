<div class="form-group row {{(!empty($controle["classeLinha"]) ? $controle["classeLinha"] : '')}}">

    {{-- mais de um campo na mesma linha --}}
    @if($controle["tipo"] == 'array')

        @for($c = 0; $c < count($controle['campos']); $c++)

            <div class="col-form col-sm-{{$controle['campos'][$c]['largura']}} {{(!empty($controle['campos'][$c]['classeColuna']) ? $controle['campos'][$c]['classeColuna'] : '' )}}
                {{!empty($sem_padding) && $sem_padding == 'true' ? 'p-0' : '' }} {{($c > 0 ? 'pl-0' : '')}}"
                style="{{($c == (count($controle['campos']) - 1) ? '' : 'padding-right:'.(empty($controle['campos'][$c]['padding']) ? '10' : $controle['campos'][$c]['padding']).'px;')}}">

                @if(!empty($controle['campos'][$c]['label']))
                    <label id="{{$controle['campos'][$c]['id']}}_label" for="{{$controle['campos'][$c]['id']}}" class="text-md-left">{{$controle['campos'][$c]['label']}}</label>
                @endif

                @if(!empty($controle['campos'][$c]['tipo']) && $controle['campos'][$c]['tipo'] == 'array')
                
                    @include("partials._modal_form_row",['controle'=>$controle['campos'][$c],'sem_padding'=>'true'])

                @else

                    @include('partials._controles_form',['controle'=>$controle['campos'][$c]])
                    
                @endif
            
            </div>

        @endfor

    @else

        <div class="col-form col-sm-{{(!empty($controle['largura']) ? $controle['largura'] : '12')}} 
                    {{(!empty($controle['classeColuna']) ? $controle['classeColuna'] : '' )}}
                    {{!empty($sem_padding) && $sem_padding == 'true' ? 'p-0' : '' }}">

            @if(!empty($controle['label']))
                <label id="{{$controle['id']}}_label" for="{{$controle['id']}}" style="padding-right:20px;" class="col-form-label text-md-left">{{$controle['label']}}</label>
            @endif

            @include('partials._controles_form',['controle'=>$controle])
        </div>
    @endif

</div>
