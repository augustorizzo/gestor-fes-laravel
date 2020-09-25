$(document).ready(function()
{
    $('#btnNovaClasse').click(function()
    {
        LimparCampos();

        $("#dlgFormulario").modal({backdrop: "static"}).show();
    });


    $("#tbClasses tbody").on("click","span[name=editBtn]",function()
    {
        LimparCampos();
        
        $('#titulo_form_modal').text("Atualizar Classe");

        var id = $(this).attr("data");

        $('#id_form_modal').val(id);
        $('#txtCodigo').val($("#" + id + "_codigo").text());
        $('#txtDescricao').val($("#" + id + "_descricao").text());

        $("#dlgFormulario").modal({backdrop: "static"}).show();
    });


    $("#tbClasses tbody").on("click","span[name=delBtn]",function()
    {
        var id = $(this).attr("data");

        $('#id_delete_modal').val(id);
        $('#item_delete').text($("#" + id + "_codigo").text());
        $("#dlgDelete").modal({backdrop: "static"}).show();
    });
});

function LimparCampos()
{
    $('#id_form_modal').val('');
    $('#txtCodigo').val('');
    $('#txtDescricao').val('');   
}