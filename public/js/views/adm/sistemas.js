$('#btnNovoSistema').click(function()
{
    LimparCampos();
    
    $('#titulo_form_modal').text("Novo Sistema");

    $("#dlgFormulario").modal({backdrop: "static"}).show();
});


$("#tbSistema tbody").on("click","span[name=editBtn]",function()
{
    LimparCampos();
    
    $('#titulo_form_modal').text("Atualizar Sistema");

    var id = $(this).attr("data");

    $('#id_form_modal').val(id);
    $('#txtDescricao').val($("#" + id + "_descricao").text());
    $('#txtCodigo').val($("#" + id + "_codigo").text());

    $("#dlgFormulario").modal({backdrop: "static"}).show();
});


$("#tbSistema tbody").on("click","span[name=delBtn]",function()
{
    var id = $(this).attr("data");

    $('#id_delete_modal').val(id);
    $('#item_delete').text($("#" + id + "_codigo").text());
    $("#dlgDelete").modal({backdrop: "static"}).show();
});

function LimparCampos()
{
    $('#id_form_modal').val('');
    $('#txtCodigo').val('');
    $('#txtDescricao').val('');   
}