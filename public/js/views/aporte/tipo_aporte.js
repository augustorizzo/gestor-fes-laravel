$("#btnNovoTipoAporte").click(function()
{
    MostrarModal('mdlTipoAporte',LimparCamposTipoAporte,'txtDescricao');
});

//editar o tipo de aporte
$("#tbTipoAporte tbody tr td span[name=editBtn]").click(function()
{
    let id = $(this).attr('data');

    LimparCamposTipoAporte();

    $("#titulo_form_modal_mdlTipoAporte").text('Atualizar Tipo de Aporte');
    $("#id_form_modal_mdlTipoAporte").val(id);
    $("#txtDescricao").val($(format('#nome_{0}',id)).text());

    MostrarModal('mdlTipoAporte',null,'txtDescricao');
});

//deletar o tipo de aporte
$("#tbTipoAporte tbody tr td span[name=delBtn]").click(function()
{
    let id = $(this).attr('data');

    $("#id_delete_modal").val(id);
    $("#item_delete").text($(format('#nome_{0}',id)).text());

    MostrarModal('dlgDelete');
});

//limpa campos da modal tipo aporte
function LimparCamposTipoAporte()
{
    $("#titulo_form_modal_mdlTipoAporte").text('Novo Tipo de Aporte');
    $("#id_form_modal_mdlTipoAporte,#txtDescricao").val('');
}
