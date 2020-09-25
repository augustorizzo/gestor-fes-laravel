function MostraListaRotas(id_classe,dados)
{
   lista = $('#pick').pickList(
    {
        data: dados,
        buttons:
        [
            {
                action: 'add',
                label: '',
                className: 'btn btn-sm btn-block btn-success fas fa fa-angle-right'
            },
            {
                action: 'addAll',
                label: '',
                className: 'btn btn-sm btn-block btn-success fa fa-angle-double-right'
            },
            {
                action: 'remove',
                label: '',
                className: 'btn btn-sm btn-block btn-danger fa fa-angle-left'
            },
            {
                action: 'removeAll',
                label: '',
                className: 'btn btn-sm btn-block btn-danger fa fa-angle-double-left'
            }
        ],

        label:
        {
            content: ['Rotas disponíveis:', 'Rotas autorizadas:']
        }
    });

    lista.on('picklist.add', function (event, rota)
    {
        associaRota(id_classe,rota,true)
    });

    lista.on('picklist.remove', function (event, rota)
    {
        associaRota(id_classe,rota,false)
    });
};

$('#cbRotaPadrao').selectpicker();

$('#cbClasses').change(function()
{
    if($(this).val() != '')
    {
        var vincula = $("#btnVincularRotas"), rota = $("#btnRotaPadrao");

        if(rota.hasClass('active'))
        {
            rota.removeClass('active');
        }

        if(!vincula.hasClass('active'))
        {
            vincula.addClass('active');
        }

        CarregaRotasClasse($(this).val());
        MostraOpcoes(true);
        MostraRotaPadrao(false);
    }
    else
    {
        MostraOpcoes(false);
        MostraRotaPadrao(false);
        MostraListasVincular(false);
    }
});

$('#cbRotaPadrao').change(function()
{
    if($(this).val() != '')
    {
        RotaPadraoClasse($('#cbClasses').val(),$(this).val());
    }
});

$("#btnRotaPadrao").click(function()
{
    var rota = $(this), vincula = $("#btnVincularRotas");

    if(!rota.hasClass('active'))
    {
        rota.addClass('active');
    }

    if(vincula.hasClass('active'))
    {
        vincula.removeClass('active');
    }

    MostraListasVincular(false);
    MostraRotaPadrao(true);
});

$("#btnVincularRotas").click(function()
{
    $('#cbClasses').trigger('change');

    MostraListasVincular(true);
    MostraRotaPadrao(false);
});

function MostraOpcoes(mostra)
{
    var opcoes = $("#divOpcoes");

    if(mostra)
    {
        if(opcoes.hasClass('d-none'))
        {
            opcoes.removeClass('d-none');
        }
    }
    else
    {
        if(!opcoes.hasClass('d-none'))
        {
            opcoes.addClass('d-none');
        }
    }
}

function MostraRotaPadrao(mostra)
{
    var div = $("#divRotaPadrao");

    if(mostra)
    {
        if(div.hasClass("d-none"))
        {
            div.removeClass("d-none");
        }

        CarregaRotasPadrao($("#cbClasses").val());
    }
    else
    {
        if(!div.hasClass("d-none"))
        {
            div.addClass("d-none");
        }
    }
}

function associaRota(id_classe,rota,adiciona)
{
    if(rota != null && rota.length > 0)
    {
        var dados = {rotas: rota,idClasse:id_classe,associa:adiciona},
        before = function()
        {
            ModalAjaxCarregando(true,(adiciona ? 'Associando rotas' : 'Dessassociando rotas'),'');
        },
        complete = function()
        {
            ModalAjaxCarregando(false);
        },
        sucesso = function()
        {
            console.log('sucesso');
        },
        erro = function(error)
        {
            MensagemBox('erro','Erro',(error.responseJSON.exception != null && error.responseJSON.exception != '' ?  error.responseJSON.exception : error.responseJSON));
        };

        AjaxMetodo('adm/ajax-associa-classe-rota','post',dados,sucesso,before,complete,erro);
    }
}

function MostraListasVincular(mostra)
{
    if(mostra)
    {
        $('#colunaPagina').append('<div id="pick"></div>');
    }
    else
    {
        $('#colunaPagina div[id=pick]').remove();
    }
}

function CarregaRotasClasse(id_classe)
{
    var beforeSend = function()
        {
            MostraListasVincular(false);

            ModalAjaxCarregando(true,'Carregando...','por favor, aguarde...');
        },
        complete = function()
        {
            ModalAjaxCarregando(false);
        },
        sucesso = function(data)
        {
            MostraListasVincular(true);

            MostraListaRotas(id_classe,data);
        };

        BuscaRotas(id_classe,beforeSend,complete,sucesso);
}

function CarregaRotasPadrao(id_classe)
{
    var beforeSend = function()
    {
        $("#cbRotaPadrao").prop('disabled',false);

        $("#cbRotaPadrao option").remove();
        $("#cbRotaPadrao").append("<option>Carregando...</option>");
    },
    complete = function()
    {
        //ModalAjaxCarregando(false,$("#corpoPagina"),null);
    },
    sucesso = function(data)
    {
        $("#cbRotaPadrao option").remove();

        var lst = data['selected'];

        if(lst != null && lst.length > 0)
        {
            var padrao = null;

            lst.forEach(item =>
            {
                if(item.menu)
                {
                    if(item.padrao)
                    {
                        padrao = item.id;
                    }

                    $("#cbRotaPadrao").append('<option value="'+ item.id +'">'+ item.label +'</option>');
                }
            });

            if(padrao != null)
            {
                $("#cbRotaPadrao").val(padrao);
            }
            else
            {
                $("#cbRotaPadrao").prepend('<option value="">Selecione</option>');
                $("#cbRotaPadrao").val('');
            }

            $("#cbRotaPadrao").selectpicker('refresh');
        }
        else
        {
            $("#cbRotaPadrao").append("<option>Nenhuma rota disponível</option>");
            $("#cbRotaPadrao").prop('disabled',true);
        }
        //console.log(lst);
    };

    BuscaRotas(id_classe,beforeSend,complete,sucesso);
}

function BuscaRotas(id_classe,before,complete,sucesso)
{
    var dados = {id: id_classe},
    erro = function(error)
    {
        console.log(error);
        //MensagemBox('erro','Erro',(error.responseJSON.exception != null && error.responseJSON.exception != '' ?  error.responseJSON.exception : error.responseJSON));
    };

    AjaxMetodo('adm/ajax-carrega-classe-rotas','post',dados,sucesso,before,complete,erro);
}

function RotaPadraoClasse(id_classe,id_rota)
{
    var dados={classe: id_classe,rota: id_rota},
        sucesso = function(data)
        {
            console.log(data);
        },
        erro = function(error)
        {
            console.log(error);
            MensagemBox('erro','Erro',(error.responseJSON.exception != null && error.responseJSON.exception != '' ?  error.responseJSON.exception : error.responseJSON));
        };

    AjaxMetodo('adm/ajax-seta-rota-padrao','post',dados,sucesso,null,null,erro);
}
