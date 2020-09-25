$("#imgCorporacao").click(function()
{
    $("#dlgLogo").trigger('click');
});

//altera a miniatura da imagem
$("#dlgLogo").change(function()
{
    ImagemInput(this,'imgCorporacao');
});

//clique no botão novo
$("#btnNovaCorporacao").click(function()
{
    MostrarModal('mdlCorporacao',LimparCamposModal);
});

//clique edição
$("#tbCorporacao tr td span[name=editBtn]").click(function()
{
    LimparCamposModal();

    let id = $(this).attr('data');

    $("#titulo_form_modal_mdlCorporacao").text('Atualizar Corporação');
    $("#id_form_modal_mdlCorporacao").val(id);

    $("#txtSigla").val($(format("#{0}_sigla",id)).text());
    $("#txtNome").val($(format("#{0}_nome",id)).text());
    $("#imgCorporacao").attr('src',$(format("#{0}_logo",id)).attr('src'));


    MostrarModal('mdlCorporacao');
});

function LimparCamposModal()
{
    $("#titulo_form_modal_mdlCorporacao").text('Nova Corporação');
    $("#id_form_modal_mdlCorporacao,#txtSigla,#txtNome,#dlgLogo").val('');
    $("#imgCorporacao").attr('src','/img/placeholder_logo.png');
}
