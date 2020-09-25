<div id="{{(empty($idModal) ? 'dlgFormulario' : $idModal)}}" class="modal fade {{(!empty($classeModal) ? $classeModal : '')}}"  tabindex="-1" role="dialog">
    <div class="modal-dialog {{!empty($tamanho) ? ('modal-'.$tamanho) : ''}}  modal-dialog-centered " role="document" {{empty($responsivo) ? ('style=width:'.(empty($largura) ? '500' : $largura).'px') : '' }} {{!empty($atributos) ? ('style='.$atributos) : ''}} >
        {{-- Modal content--}}
        <div class="modal-content">

            @if(empty($header) || (!empty($header) && $header == 'true'))
                <div class="modal-header bg-primary text-white {{(!empty($classeHeader) ? $classeHeader : '')}}">
                    <h4 class="modal-title"><i id="icone_form_modal{{(empty($idModal) ? '' :'_'.$idModal)}}" class="fa {{(empty($icone) ? '' : $icone)}}"></i> <txt id="titulo_form_modal{{(empty($idModal) ? '' :'_'.$idModal)}}">{{ $titulo }}</txt></h4>

                    @if(empty($controle_fechar) || (!empty($controle_fechar) && $controle_fechar == 'true'))

                        <button type="button" class="close" data-dismiss="modal">×</button>

                    @endif

                </div>
            @endif
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="form_modal{{(empty($idModal) ? '' :'_'.$idModal)}}" method="POST" enctype="multipart/form-data" action="{{(empty($rota) ? '' : route($rota))}}" >
                        @csrf

                        <input type="hidden" id="id_form_modal{{(empty($idModal) ? '' :'_'.$idModal)}}" name="id"/>

                        @foreach ($campos as $controle)

                            @if($controle["tipo"] == 'hidden')

                                @include('partials._controles_form',['controle'=>$controle])

                            @elseif($controle["tipo"] == 'tabs')

                                {{-- lista de abas --}}
                                <ul class="nav nav-tabs" id="{{$controle["id"]}}" role="tablist">

                                    @foreach($controle["abas"] as $aba)
                                        <li class="nav-item">
                                            <a id="tab_{{Util::RemoveCaracter($aba)}}{{(empty($idModal) ? '' :'_'.$idModal)}}"
                                               class="nav-link {{$loop->first ? 'ativo' : ''}}"
                                               data-toggle="tab"
                                               href="#content_tab_{{Util::RemoveCaracter($aba)}}{{(empty($idModal) ? '' :'_'.$idModal)}}"
                                               role="tab"
                                               aria-controls="content_tab_{{Util::RemoveCaracter($aba)}}{{(empty($idModal) ? '' :'_'.$idModal)}}"
                                               aria-selected="{{$loop->first ? 'true' : 'false'}}">{{$aba}}</a>
                                        </li>
                                    @endforeach

                                </ul>

                                {{-- conteúdo --}}
                                <div id="{{$controle["id"]}}_conteudo" class="tab-content pt-2 " style="overflow-y:auto;overflow-x:hidden; {{(!empty($controle["altura"]) ? ('height:'.$controle["altura"]  . ';max-height:'.$controle["altura"] ) : '')}}">


                                    @foreach($controle["conteudo"] as $conteudo)
                                        <div class="tab-pane fade"
                                             id="content_tab_{{Util::RemoveCaracter($conteudo['aba'])}}{{(empty($idModal) ? '' :'_'.$idModal)}}"
                                             role="tabpanel"
                                             aria-labelledby="tab_{{Util::RemoveCaracter($conteudo['aba'])}}{{(empty($idModal) ? '' :'_'.$idModal)}}">

                                            @foreach($conteudo["campos"] as $linha)
                                                @include('partials._modal_form_row',['controle'=>$linha,'sem_padding'=>'false'])
                                            @endforeach


                                        </div>
                                    @endforeach

                                </div>


                            @else

                                @include('partials._modal_form_row',['controle'=>$controle,'sem_padding'=>'false'])

                            @endif

                        @endforeach

                        @if(empty($controles_salvar) || $controles_salvar == 'true')
                            <div id="footer_salvar{{(empty($idModal) ? '' :'_'.$idModal)}}" class="modal-footer">
                                <button id="btnFormModal{{(empty($idModal) ? '' :'_'.$idModal)}}" type="submit" class="btn {{!empty($classe_botao_submit) ? $classe_botao_submit : 'btn-primary'}}" style="margin-right:10px;"><i class="{{!empty($icone_submit) ? $icone_submit :'fa fa-save'}}"></i> {{!empty($botao_submit) ? $botao_submit :'Salvar'}}</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancelar</button>
                            </div>
                        @endif

                    </form>
                </div>
            </div>

            @if(!empty($controles_fechar) && $controles_fechar == 'true')
                <div id="footer_fechar{{(empty($idModal) ? '' :'_'.$idModal)}}" class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">FECHAR</button>
                </div>
            @endif


        </div>
    </div>
</div>
