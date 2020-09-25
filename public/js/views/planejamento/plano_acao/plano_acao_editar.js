//const { isArguments } = require("lodash");

//Variáveis com os valores da LOA
var VLR_LOA_CUSTEIO = 0.0,VLR_LOA_INVESTIMENTO = 0.0;
$("#cbAporte").select2();
$(document).ready(function()
{
    /*
    VLR_LOA_CUSTEIO = 5000000.00;
    VLR_LOA_INVESTIMENTO = 7000000.00;
    */

    //$("#cbAporte").select2();

    $("#btnControleAportes").trigger('click');

    //inicializa os combos
    $("#cbLoaExercicio,#cbPlanoItemCorporacao").select2({ width : "100%" });

    if($("#hdnIdPlano").val() != '')
    {
        //$("#cbPrograma,#cbEixo").prop('disabled',true);

        //diapara o carregamento dos eixos qndo é a edição de um plano
        CarregarComboEixo($("#cbPrograma").val(),'cbEixo',$("#cbPrograma").attr('data-eixo'),false,false);//(($("#hdnIdPlano").val() != '' && !(typeof $("#cbPrograma").attr('data-eixo') === "undefined"))));

        //dispara o carregamento das ações do plano
        CarregarAcoesPlano();
    }
    else
    {
        LimpaCampos();
    }

    //contrói o graficos do LOA
    //ChartDonut();

    //inicializa os plugins do editor de texto
    InicializaEditorTextarea('#txtResumo,#txtJustificativa,#txtTerritorio,#txtResultado,#txtImpacto,#txtEstrategia,#txtObjetivo',true);
    InicializaEditorTextarea('#mdlPlanoItem textarea');

    //seta a aba que está ativa
    $("#tabsPlanoAcao li a[data-toggle=tab].ativo").trigger('click');

    Gauges();
    GaugeLinear();

    //inicializa o sticky nos gráficos
    $("#pnlGraficosEixo").sticky({topSpacing:0,zIndex:9999,responsiveWidth:true,wrapperClassName:'col-mb-3'});

    //$("#divGaugeCusteio").sticky({boundedBy: 'div.container-fluid'});
    //$("#divInvestimento").sticky({boundedBy: 'div.container-fluid'});



    CarregarDetalhesAportes();
});

/*
$("#pnlGraficosEixo").on('sticky-start',function()
{
    $("#divGaugeEixo,#divGaugeCusteio,#divInvestimento").removeClass('col-md-4');

    $("#divGaugeEixo").addClass('col-md-5');
    $("#divGaugeCusteio").addClass('col-md-3');
    $("#divInvestimento").addClass('col-md-5');

    //$("#pnlGraficosEixo").sticky('update');
});

$("#pnlGraficosEixo").on('sticky-end',function()
{
    $("#pnlGraficosEixo").sticky({wrapperClassName:'col-md-9'});

    //$("#pnlGraficosEixo").sticky('update');
});
*/

//altera a largura dos gráficos ao ficarem flutuantes
/*
    $(document).scroll(function()
    {
        if($("#pnlGraficosEixo").css("position") == 'static')
        {
            $("#pnlGraficosEixo").removeClass('col-md-12 row');
            $("#divGaugeEixo,#divGaugeCusteio,#divInvestimento").removeClass('col-md-4 col-md-5 col-md-3');

            $("#divGaugeEixo,#divGaugeCusteio,#divInvestimento").addClass('col-md-3');

        }
        else
        {
            $("#divGaugeEixo,#divGaugeCusteio,#divInvestimento").removeClass('col-md-3');

            $("#pnlGraficosEixo").addClass('col-md-12 row');
            $("#divGaugeEixo").addClass('col-md-5');
            $("#divGaugeCusteio").addClass('col-md-3');
            $("#divInvestimento").addClass('col-md-5');
        }
    });
*/

//abre a modal para imprimir o plano de ação
$("#btnImprimirPlano").click(function()
{
    MostrarModal('mdlImprimirPlano');
});

//fecha a modal para imprimir o plano de ação após uma oppção ser selecionada
$("#btnImprimirSemAnexo,#btnImprimirComAnexo").click(function()
{
    FecharModal('mdlImprimirPlano');
});

//evento para carregar os eixos quando mudar o programa
$("#cbPrograma").change(function()
{
    let eixo = $(this).attr('data-eixo');

    CarregarComboEixo($(this).val(),'cbEixo',eixo,false,false);//($("#hdnIdPlano").val() != '' && !(typeof eixo === "undefined")));

    GeraIdentificadorPlano();
});

$("#cbEixo").change(function()
{
    GeraIdentificadorPlano();
});


$("#frmPlanoAcao").submit(function(e)
{

    //caso seja encontrado alguma incosistência, pára o envio
    if(!ValidaCamposPlanoAcao())
    {
        e.preventDefault();
    }

});

function ValidaCamposPlanoAcao()
{
    let valida = true;

    //percorre todos os campos do formulário que tenham a classe 'valida'
    $("#frmPlanoAcao .valida").each(function()
    {
        let elemento = $(this);

        if(((elemento.is('select') || elemento.is('input:text')) && (elemento.val() == null || elemento.val() == '')) || (elemento.is('textarea') && elemento.text() == ''))
        {
            //marca a validação como inválida
            valida = false;

            //marca o campo como inválido
            elemento.addClass('is-invalid');
        }
        else
        {
            //remove a marcação de erro no campo
            elemento.removeClass('is-invalid');
        }
    });

    //percorre as abas procurando campos com marção inválida
    $("#tabsPlanoAcao li.nav-item a[role=tab]").each(function()
    {
        //recupera o nome da aba e o conteúdo
        let nome_aba = $(this), aba = $($(this).attr('href'));

        //verifica se no conteúdo da aba tem algum campo marcado como inválido
        if(aba.find('.is-invalid').length > 0)
        {
            //verifica se já tem o sinal de alerta
            if(nome_aba.find('i[name=aba_alerta]').length == 0)
            {
                //adiciona o sinal de alerta caso não tenha encontrado
                nome_aba.html(nome_aba.text() + ' <i name="aba_alerta" class="fa fa-exclamation-triangle text-warning"></i>');
            }
        }
        else
        {
            //remove marcação de alerta na aba
            nome_aba.find('i[name=aba_alerta]').remove();
        }
    });

    //mostra a mensagem de alerta caso encontre alguma inconsistência
    if(!valida)
    {
        MensagemBox('alerta','Preencha todos os campos obrigatórios','');
    }

    //retorna o resultado da validação
    return valida;
}


function LimpaCampos()
{
    $("#cbPrograma,#cbEixo,#cbOrgao,#cbResponsavel,#cbGestor").val('');
    $("#txtResumo,#txtJustificativa,#txtTerritorio,#txtImpacto,#txtResultado").text('');
}

function GeraIdentificadorPlano()
{
    if($("#hdnIdPlano").val() == '')
    {
        let programa = $("#cbPrograma").val(), eixo = $("#cbEixo").val(),
        before = function()
        {
            //$("#hdrIdentificador").text('Carregando...');
            $("#loading_identificador").removeClass('d-none');
        },
        complete = function()
        {
            $("#loading_identificador").addClass('d-none');
        },
        sucesso = function(valor)
        {
            $("#hdrIdentificador").text(valor);
            $("#hdnIdentificador").val(valor);
        };

        AjaxMetodo(format('planejamento/plano/ajax-gera-identificador-plano/{0}&{1}',(programa == '' ? 0 : programa),(eixo == '' ? 0 : eixo)),'POST',null,sucesso,before,complete);
    }
}
