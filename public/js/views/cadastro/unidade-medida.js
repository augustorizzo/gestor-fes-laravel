//clique no botão novo
$("#btnNovaUnidade").click(function()
{
    MostrarModal('mdlUnidadeMedida',LimparCamposModal);
});

//clique edição
$("#tbUnidadeMedida tr td span[name=editBtn]").click(function()
{
    LimparCamposModal();

    let id = $(this).attr('data');

    $("#titulo_form_modal_mdlUnidadeMedida").text('Atualizar Unidade de Medida');
    $("#id_form_modal_mdlUnidadeMedida").val(id);

    $("#txtSigla").val($(format("#{0}_sigla",id)).text());
    $("#txtNome").val($(format("#{0}_nome",id)).text());


    MostrarModal('mdlUnidadeMedida');
});

//clique da exclusão
$("#tbUnidadeMedida tr td span[name=delBtn]").click(function()
{
    let id = $(this).attr('data');

    $("#id_delete_modal").val(id);
    $("#item_delete").text($(format("#{0}_nome",id)).text());

    MostrarModal("dlgDelete");
});

//limpa os campos da modal
function LimparCamposModal()
{
    $("#titulo_form_modal_mdlUnidadeMedida").text('Nova Unidade de Medida');
    $("#id_form_modal_mdlUnidadeMedida,#txtSigla,#txtNome").val('');
}
