
<tr data-tt-id="{{$rota_id}}"
    data-tt-parent-id="{{(empty($rota_pai_id) ? 0 : $rota_pai_id)}}"
    data-tt-level="{{$nivel}}"
    data-tt-isnode="true">

    <td id="{{$rota_id}}_nome">{{$rota_nome}}</td>
    <td id="{{$rota_id}}_rota">{{$rota_rota}}</td>
    <td id="{{$rota_id}}_rota_pai" data="{{(empty($rota_pai_id) ? '' : $rota_pai_id)}}">
        {{(empty($rota_pai) ? '' : $rota_pai)}}
    </td>
    <td id="{{$rota_id}}_menu" data="{{$rota->isMenu()}}">

        @if($rota_menu)
            <span class="badge badge-success">Sim</span>
        @else
            <span class="badge badge-danger">Não</span>
        @endif

    </td>
    <td id="{{$rota_id}}_icone" data="{{$rota_icone}}">
        <i class="{{$rota_icone}}"></i>
    </td>

    @if($permEditar || $permDelete)
        <td>
            @if($permEditar)
                <span name="editBtn" class="fa fa-edit cursor-pointer text-success" data="{{$rota_id}}" title="Editar"></span>
            @endif

            @if($permDelete)
                <span name="delBtn" class="fa fa-trash cursor-pointer text-danger" data="{{$rota_id}}" title="Excluir"></span>
            @endif
        </td>
    @endif
</tr>

@foreach($rotasFilhas as $rota)

    @include('partials.adm._linha_tabela_rota',
    [
        'rota_id'=>$rota->getId(),
        'rota_nome'=>$rota->getNome(),
        'rota_rota'=>$rota->getRota(),
        'rota_pai_id'=>(empty($rota->RotaPai) ? '' : $rota->RotaPai->getId()),
        'rota_pai'=>(empty($rota->RotaPai) ? '' : $rota->RotaPai->getNome()),
        'rota_menu'=>$rota->isMenu(),
        'rota_icone'=>$rota->getIcone(),
        'permEditar'=>$permEditar,
        'permDelete'=>$permDelete,
        'rotasFilhas'=>$rota->Rotas,
        'nivel'=> $nivel+1
    ])

@endforeach
