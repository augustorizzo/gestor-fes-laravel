$(document).ready(function()
{

});

$("#cbAporte").change(function()
{
    CarregarDetalhesAportes();
});

//busca os
function CarregarDetalhesAportes()
{
    let dados = {aportes:$("#cbAporte").val()},
        sucesso = function(resultado)
        {
            VLR_LOA_CUSTEIO = 0.00;
            VLR_LOA_INVESTIMENTO = 0.00;

            resultado.forEach(item =>
            {
                if(item.categoria == 'investimento')
                {
                    VLR_LOA_INVESTIMENTO += item.valor;
                }
                else if(item.categoria == 'custeio')
                {
                    VLR_LOA_CUSTEIO += item.valor;
                }
            });

            $("#bxVlrInvestimento").text(formataMoeda(VLR_LOA_INVESTIMENTO));
            $("#bxVlrCusteio").text(formataMoeda(VLR_LOA_CUSTEIO));

            CalculaTodasAcoes();
        };

    AjaxMetodo('aporte/ajax-detalhes-aportes','POST',dados,sucesso);
}
