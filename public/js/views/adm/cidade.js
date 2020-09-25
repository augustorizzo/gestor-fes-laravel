$(document).ready(function()
{
    $("#tbCidades tbody").on("click","span[name=editBtn]",function()
    {
        $('#titulo_form_modal').text("Atualizar Cidade");

        var id = $(this).attr("data");

        $('#id_form_modal').val(id);
        $('#txtNome').val($("#" + id + "_nome").text());
        $('#cbEstado').val($("#" + id + "_estado").attr('data'));

        $("#dlgFormulario").modal({backdrop: "static"}).show();
    });
});