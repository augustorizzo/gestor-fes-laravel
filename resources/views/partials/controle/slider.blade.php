<div class="form-group row mb-0">

    <div class="col col-form">
        <label class="switch {{(empty($posicao) || $posicao == 'right' ? 'pull-right' : 'pull-left' )}}">

            <input id="{{$id}}" name="{{$nome}}" type="checkbox" {{(!empty($ativo) && $ativo ? 'checked' : '' )}} />
            <span class="slider round"></span>
        </label>
    </div>

</div>
