$(document).ready(function()
{
    $("#cbPrograma").trigger('change');
});

$("#cbPrograma").change(function()
{
    CarregarComboEixo($(this).val(),'cbEixo');
});