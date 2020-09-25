//clique no botão novo
$("#btnNovoItemPlano").click(function()
{
    MostrarModal('mdlItem',LimparCamposModal);
});

//clique edição
$("#tbItemPlano tr td span[name=editBtn]").click(function()
{
    LimparCamposModal();

    let id = $(this).attr('data');

    $("#titulo_form_modal_mdlItemPlano").text('Atualizar Item');
    $("#id_form_modal_mdlItemPlano").val(id);

    $("#txtNome").val($(format("#{0}_nome",id)).text());


    MostrarModal('mdlItemPlano');
});

//clique da exclusão
$("#tbItemPlano tr td span[name=delBtn]").click(function()
{
    let id = $(this).attr('data');

    $("#id_delete_modal").val(id);
    $("#item_delete").text($(format("#{0}_nome",id)).text());

    MostrarModal("dlgDelete");
});

//limpa os campos da modal
function LimparCamposModal()
{
    $("#titulo_form_modal_mdlItemPlano").text('Novo Item');
    $("#id_form_modal_mdlItemPlano,#txtSigla,#txtNome").val('');
}
