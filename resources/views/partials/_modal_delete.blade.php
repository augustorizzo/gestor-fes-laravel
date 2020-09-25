<div class="modal fade" id="dlgDelete" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{route($rota)}}" method="POST">
            @csrf

            <input type="hidden" id="id_delete_modal" name="id"/>

            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title"><i class="fa fa-trash"></i> <txt id="titulo_delete_modal">{{$titulo}}</txt></h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <h3>{{$mensagem_delete}} <b id="item_delete"></b>?</h3>
                    </div>
                </div>

                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>
