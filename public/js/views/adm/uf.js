$(document).ready(function()
{
    $("#tbEstados tbody").on("click","span[name=editBtn]",function()
    {
        $('#titulo_form_modal').text("Atualizar Estado");

        var id = $(this).attr("data");

        $('#id_form_modal').val(id);
        $('#txtNome').val($("#" + id + "_nome").text());
        $('#txtSigla').val($("#" + id + "_sigla").text());

        $("#dlgFormulario").modal({backdrop: "static"}).show();
    });
});