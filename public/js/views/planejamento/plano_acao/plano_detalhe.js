//<script src="{{ URL::asset('js/views/planejamento/plano_acao/plano_acao_editar.js') }}"></script>


//desabilita que o ENTER submeta o formulário quando o foco estiver na tabela de ações
$(window).keydown(function(event)
{
    if(event.keyCode == 13 && $("#tbAcoes tbody tr table tbody tr[name=detalhe] input").is(':focus'))
    {
      event.preventDefault();
      return false;
    }
});

//Mostra ou esconde os detalhes
$("#tbAcoes tbody").on('click','tr td[name=td_detalhe] i[name=detalhe-acao]',function()
{
    var icone = $(this),
        linha = icone.closest('tr');

    //abre os detalhes
    if(icone.hasClass('fa-plus-circle'))
    {
        //adiciona as bordas da primeria e ultima coluna
        linha.find('td:first').addClass('border-primary border-right-0 border-bottom-0');
        linha.find('td:last').addClass('border-primary border-left-0 border-bottom-0');

        //muda ícone para o minus vermelho
        icone.removeClass('fa-plus-circle text-success');
        icone.addClass('fa-minus-circle text-danger');

        //cria tabela
        CriaTabelaDetalhe(linha,icone.attr('data-detalhe'));

        //mostra os detalhes
        $("#tbAcoes tbody tr[id='"+ icone.attr('data-detalhe')+"']").show();
    }
    //fecha os detalhes
    else
    {
        //remove as bordas da primeria e ultima coluna
        linha.find('td:first').removeClass('border-primary border-right-0 border-bottom-0');
        linha.find('td:last').removeClass('border-primary border-left-0 border-bottom-0');

        //muda o ícone para o plus verrde
        icone.removeClass('fa-minus-circle text-danger');
        icone.addClass('fa-plus-circle text-success');

        //esconde os detalhes
        $("#tbAcoes tbody tr[id='"+ icone.attr('data-detalhe')+"']").hide();
    }
});

//calcula o valor total da linha quando a qtd ou valor unitário forem alterados
$("#tbAcoes tbody").on('change blur keyup','tr table tbody tr td .calcula',function()
{
    var linha = $(this).closest('tr'),
        qtd = parseFloat(linha.find('input[id^=txtQtd]').val()),
        vlr_unit = parseFloat(limparMoeda(linha.find('input[id^=txtVlrUnd]').val())),
        label_total = linha.find('b[id^=txtVlrTotal]'),
        vlr_calculado = (vlr_unit * qtd); //calcula o valor total do detalhe

    //atribui o valor total do detalhe ao elemento
    label_total.text((qtd < 0 || isNaN(vlr_calculado)) ? '0,00' : formataMoeda(vlr_calculado));

    //Chama a função para calcular o valor total da ação
    CalculaValorTotalAcao(linha.closest('table').attr('data-acao'),linha.closest('table').attr('id'));

    //chama a função para atualizar os valores totais
    CalculaTodasAcoes();
});

//apertar o ENTER dentro da linha do detalhe
$("#tbAcoes tbody").on('keyup','tr table tbody tr',function(e)
{
    //apertar enter dentro da linha
    if(e.keyCode == 13)
    {

        //recupera os elementos importantes
        let linha = $(this).closest('tr'),
            tabela_detalhe = linha.closest('table');


        //só insere nova linha se os campos estiverem OK
        if(ValidaCamposPreenchidosLinhaEditavel($(this).attr('id')))
        {
            //cria nova linha editável de detalhe
            LinhaEditavel(tabela_detalhe.attr('data-acao'),tabela_detalhe.attr('data-detalhe'));
        }
    }
});


//click do checkbox master do detalhe
$("#tbAcoes tbody").on('click','tr table thead th input[type=checkbox][name=ckb_all]',function()
{
    $(this).closest('table').find('input[type=checkbox][name=ckbDetalhe]').prop('checked',$(this).prop('checked'));
});

//mostra ou esconde o botão master de excluir
$("#tbAcoes tbody").on('change','tr table input[type=checkbox]',function()
{
    let tabela = $(this).closest('table');

    if(tabela.find('tbody input[type=checkbox][name=ckbDetalhe]:checked').length > 0)
    {
        //mostra o botão excluir
        tabela.find('i[name=exclui_detalhe_ckb]').removeClass('d-none')
    }
    else
    {
        //esconde o botão excluir
        tabela.find('i[name=exclui_detalhe_ckb]').addClass('d-none');
    }

    //seleciona ou não o checkbox master caso a quantidade selecionada seja igual a quantidade de checkboxes
    tabela.find('thead th input[type=checkbox][name=ckb_all]').prop('checked',tabela.find('tbody input[type=checkbox][name=ckbDetalhe]:checked').length == tabela.find('tbody input[type=checkbox][name=ckbDetalhe]').length);

});

//click do botão master de excluir
$("#tbAcoes tbody").on('click','tr table thead th i[name=exclui_detalhe_ckb]',function()
{
    //componentes
    let tabela = $(this).closest('table'),
    //pega os checkboxes selecionados
    selecionadas = tabela.find('input[type=checkbox][name=ckbDetalhe]:checked');

    //apresenta mensagem de confirmação antes de excluir
    ConfirmarBox('Deseja realmente excluir os detalhes selecionados?','',function()
    {
        //percorre os checboxes7
        selecionadas.each(function()
        {
            //chama a função de remover a linha
            RemoverLinhaDetalhe($(this).closest('tr'));
        });

        //descheca o checkbox principal
        let ckbMaster = tabela.find('thead th input[type=checkbox][name=ckb_all]');
        ckbMaster.prop('checked',false);
        ckbMaster.trigger('change');
    });
});

//################################ EDIÇÃO DO DETALHE ################################

//cancela edição da linha editável
$("#tbAcoes tbody").on('click','tr table tbody tr[name=detalhe] td i[name=btn_cancela_edicao]',function()
{
    let linha = $(this).closest('tr');

    //apresenta mensagem de confirmação antes de excluir
    ConfirmarBox('Deseja realmente excluir este detalhe ?','',function()
    {
        RemoverLinhaDetalhe(linha);
    });
});


//Botão adicionar linha do detalhe
$("#tbAcoes tbody").on('click','tr table tbody tr[name=detalhe] td i[name=btn_adiciona_linha]',function(e)
{
          //recupera os elementos importantes
        let linha = $(this).closest('td'),
            tabela_detalhe = linha.closest('table');

            //só insere nova linha se os campos estiverem OK
         if(ValidaCamposPreenchidosLinhaEditavel($(this).closest('tr').attr('id')))
            //cria nova linha editável de detalhe
            LinhaEditavel(tabela_detalhe.attr('data-acao'),tabela_detalhe.attr('data-detalhe'));
        {
        }
});


//função para remover a linha sempre verificando se a tabela está vazia
function RemoverLinhaDetalhe(linha)
{
    //recupera a tabela
    let tabela = $("#"+linha.closest('table').attr('id'));

    //remove a linha
    linha.remove();

    //verifica se a tabela está vazia
    if(tabela.find('tbody tr').length == 0)
    {
        //adiciona a linha
        LinhaEditavel(tabela.attr('data-acao'),tabela.attr('data-detalhe'));
    }

    DisparaCalculoAcaoItem();
}

//cria tabela de detalhes caso a ação ainda não tenha
function CriaTabelaDetalhe(linha,id_detalhe,visivel=false,linhaVazia=true)
{
    if($("#tbAcoes tbody tr[id='"+ id_detalhe +"']").length == 0)
    {
        linha.after
        (
            '<tr id="'+ id_detalhe +'" style="'+ (visivel ? '' : 'display:none;') +'">'
            +   '<td colspan="8" class="border border-primary border-top-0">'
            +       '<table id="tbl_'+ id_detalhe +'" class="table table-hover table-striped table-bordered" data-acao="'+ linha.attr('id') +'" data-detalhe="'+ id_detalhe +'">'
            +           '<thead class="bg-primary text-white text-center">'
            +                   '<th class="align-middle pt-1 pb-1 w-5"><input type="checkbox" name="ckb_all"/>'
            +                   '<i class="fa fa-times-circle btn btn-outline-dark cursor-pointer d-none text-danger" name="exclui_detalhe_ckb" title="Excluir detalhes selecionados"></i>'
            +                   '</th>'
            +                   '<th class="align-middle pt-1 pb-1 w-10">Grupo</th>'
            +                   '<th class="align-middle pt-1 pb-1 w-10">Beneficiário</th>'
            +                   '<th class="align-middle pt-1 pb-1 w-60">Descrição</th>'
            +                   '<th class="align-middle pt-1 pb-1 w-5">Unidade</th>'
            +                   '<th class="align-middle pt-1 pb-1 w-5">QTD</th>'
            +                   '<th class="align-middle pt-1 pb-1 w-10">Valor Unitário (R$)</th>'
            +                   '<th class="align-middle pt-1 pb-1 w-10">Valor Total(R$)</th>'
            +                   '<th class="align-middle pt-1 pb-1 w-5"></th>'
            +               '</tr>'
            +           '</thead>'
            +           '<tbody>'
            +           '</tbody>'
            +       '</table>'
            +   '</td>'
            +'</tr>'
        );

        if(linhaVazia)
        {
            LinhaEditavel(linha.attr('id'),id_detalhe);
        }
    }
}

//cria linha editável
function LinhaEditavel(id_acao,id_detalhe,item=null)
{
    var tabela = $("#tbl_"+ id_detalhe),
        numero_detalhe = (tabela.find('tbody tr[name=detalhe]').length + 1),
        id_linha = (id_detalhe +'_'+ numero_detalhe),
        id_gerado = getIdData() + 'x';
        // $("#cbBeneficiario_").select2();

    //insere a linha editável
    tabela.append
    (
        '<tr id="'+ id_linha +'" data-numero="'+ numero_detalhe +'" name="detalhe">'
        +   '<input id="hdnIdDetalhe_'+ id_linha +'" type="hidden" name="detalhe['+ id_linha +'][id]" value="'+ id_gerado +'"/>'
        +   '<input type="hidden" name="detalhe['+ id_linha +'][acao]" value="'+ id_acao +'"/>'
        +   '<td class="text-center">'
        +       '<input type="checkbox" name="ckbDetalhe"/>'
        +   '</td>'
            //Classificação INVESTIMENTO ou CUSTEIO
        +   '<td class="text-center">'
        +       '<select id="cbClassificacao_'+ id_linha +'" class="form-control p-0 calcula" name="detalhe['+ id_linha +'][tipo]" >'
        +           '<option value="">Selecione</option>'
        +           OpcoesTipoDespesa()
        +       '</select>'
        +   '</td>'
        //     //beneficiário
        +   '<td class="text-center">'
        +       '<select id="cbBeneficiario_'+ id_linha +'" class="form-control p-0" name="detalhe['+ id_linha +'][beneficiario]" multiple>'
        +           '<option value="">Selecione</option>'
        +           OpcoesCorporacao()
        +       '</select>'
        +   '</td>'
          //descrição da ação
        +   '<td>'
        +       '<input id="txtDesc_'+ id_linha +'" class="form-control" name="detalhe['+ id_linha +'][descricao]"  type="text" value=""/>'
        +   '</td>'
            //unidade de medida
        +   '<td>'
        +       '<select id="cbUnid_'+ id_linha +'" class="form-control p-0" name="detalhe['+ id_linha +'][unidade]" >'
        +           OpcoesUnidades()
        +       '</select>'
        +   '</td>'
        +   '<td>'
        +       '<input id="txtQtd_'+ id_linha +'" class="form-control p-0 text-right calcula" name="detalhe['+ id_linha +'][qtd]"  type="number" step="0.5" min="1" value="1"/>'
        +   '</td>'
        +   '<td>'
        +       '<input id="txtVlrUnd_'+ id_linha +'" class="form-control mask_moeda text-right calcula"  name="detalhe['+ id_linha +'][vlr_unitario]" type="text" value="0,00"/>'
        +   '</td>'
        +   '<td class="text-right">'
        +       '<b class="form-control" id="txtVlrTotal_'+ id_linha +'">0,00</b>'
        +   '</td>'
        +   '<td class="text-center">'
        //+       '<i class="cursor-pointer fa fa-2x fa-check text-success mr-2" title="Salvar"></i>'
        +       '<i class="cursor-pointer fas fa-plus-circle text-success" name="btn_adiciona_linha" title="Adicionar"></i>'
        +       '&nbsp'
        +       '<i class="cursor-pointer fa fa- fa-times text-danger" name="btn_cancela_edicao" title="Cancelar"></i>'
        +   '</td>'
        +'</tr>'
    );

    //se o item não for vazio, preenche as informações
    if(item != null)
    {
        $('#hdnIdDetalhe_'+ id_linha).val(item.id);
        $('#cbClassificacao_'+ id_linha).val(item.fk_grupo_despesa)
        $('#cbBeneficiario_'+ id_linha).val(item.fk_beneficiario);
        $('#txtDesc_'+ id_linha).val(item.descricao);
        $('#cbUnid_'+ id_linha).val(item.unidade);
        $('#txtQtd_'+ id_linha).val(item.qtd);
        $('#txtVlrUnd_'+ id_linha).val(item.vlr_unitario);
    }

    InciarMaskara($("#txtVlrUnd_"+ id_linha),'moeda');
    $("#txtDesc_"+ id_linha).focus();
}

//validar se campos da linha editável estão vazios
function ValidaCamposPreenchidosLinhaEditavel(id_linha,mostra_msg=true)
{
    let elementos = [],
        tipo_despesa = $('#cbClassificacao_'+ id_linha),
        beneficiario = $('#cbBeneficiario_'+ id_linha),
        descricao = $('#txtDesc_'+ id_linha),
        unidade = $('#cbUnid_'+ id_linha),
        qtd = $('#txtQtd_'+ id_linha),
        vlr_unitario = $('#txtVlrUnd_'+ id_linha),
        ok = true;

    //validação combo beneficiário
    if(tipo_despesa.val() == '')
    {
        elementos.push('#' + tipo_despesa.attr('id'));
        ok = false;
    }

    //validação combo beneficiário
    if(beneficiario.val() == '')
    {
        elementos.push('#' + beneficiario.attr('id'));
        ok = false;
    }

    //validação campo descricao
    if(descricao.val() == '')
    {
        elementos.push('#' + descricao.attr('id'));
        ok = false;
    }

    //validação campo unidade
    if(unidade.val() == '')
    {
        elementos.push('#' + unidade.attr('id'));
        ok = false;
    }

    //validação campo quantidade
    if(qtd.val() == '' || qtd.val() <= 0)
    {
        elementos.push('#' + qtd.attr('id'));
        ok = false;
    }

    //validação campo valor unitário
    if(vlr_unitario.val() ==  '' || isNaN(parseFloat(limparMoeda(vlr_unitario.val()))))
    {
        elementos.push('#' + vlr_unitario.attr('id'));
        ok=false;
    }

    //caso algum campo tenha falhado na validação
    if(!ok && mostra_msg)
    {
        ToastBox('erro',' Preencha corretamente os campos.',5000,$(elementos.join()));
    }

    return ok;
}

//calcula todas as ações
function CalculaTodasAcoes()
{
    //guarda os valores totais para depois setar
    let vlr_total_custeio = 0.0, vlr_total_investimento = 0.0;

    //percorre as ações
    $("#tbAcoes tbody tr[name=acao]").each(function()
    {
        //Chama a função para calcular cada ação
        CalculaValorTotalAcao($(this).attr('id'),('tbl_detalhes_' + $(this).attr('id')));

        //seta o valor total da ação
        vlr_total_custeio += parseFloat(limparMoeda($(this).find('td[name="td_valor_custeio"]').text()));
        vlr_total_investimento += parseFloat(limparMoeda($(this).find('td[name="td_valor_investimento"]').text()));
    });

    //atualiza os valores e gráficos
    AtualizaValoresTotaisPlano(vlr_total_custeio,vlr_total_investimento);
}

//Calcula o valor total da ação com base nos detalhes da mesma+
function CalculaValorTotalAcao(id_acao,id_tbl_detalhe)
{
    let acao = $("#"+id_acao),
        detalhes = $("#"+id_tbl_detalhe).find('tbody tr[name=detalhe]'),
        vlr_acao = 0.0,
        vlr_investimento = 0.0,
        vlr_custeio = 0.0;

    //percorre os detalhes para somar os valores dos detalhes
    if(detalhes.length > 0)
    {
        detalhes.each(function()
        {
            //força o cálculo da linha -- comentado porque está disparando mta recursividade
            //$(this).find("input[type=text][id^=txtVlrUnd]").trigger('change');

            let tipo = $(this).find('select[id*=cbClassificacao_]:first').val(),
                valor = parseFloat(limparMoeda($(this).find('b[id*=txtVlrTotal]:first').text()));

            //investimento
            if(tipo == 1)
            {
                vlr_investimento += valor;   //b[id*=txtVlrTotal]'
            }
            //custeio
            else if(tipo == 2)
            {
                vlr_custeio += valor;
            }

            //valor total
            vlr_acao += valor;
        });
    }

    //seta o valor total da ação
    acao.find('td[name="td_valor_custeio"]').text(formataMoeda(vlr_custeio));
    acao.find('td[name="td_valor_investimento"]').text(formataMoeda(vlr_investimento));
    acao.find('td[name="td_valor"]').text(formataMoeda(vlr_acao));
}

//retorna as opções para o combo de beneficiários
function OpcoesCorporacao()
{
    let opcoes = "";

    $("#cbCorporacao option").each(function()
    {
        opcoes += ('<option value="'+ $(this).val() +'">'+  $(this).text() +'</option>');
    });

    return opcoes;
}

//retorna as opções para o combo de tipo de despesa
function OpcoesTipoDespesa()
{
    let opcoes = "";

    $("#cbGrupoDespesa option").each(function()
    {
        opcoes += ('<option value="'+ $(this).val() +'">'+  $(this).text() +'</option>');
    });

    return opcoes;
}

//retorna as opções para o combo de unidade de medida
function OpcoesUnidades()
{
    let opcoes = "";

    $("#cbUnidadesMedida option").each(function()
    {
        opcoes += ('<option value="'+ $(this).val() +'">'+  $(this).text() +'</option>');
    });

    return opcoes;
}

//atualiza os valores e o gráfico
function AtualizaValoresTotaisPlano(total_custeio,total_investimento)
{
    //cálculo valores do plano
    let valor_total = (total_custeio + total_investimento),
        valor_total_eixo = (VLR_LOA_CUSTEIO + VLR_LOA_INVESTIMENTO),
        perc_investimento = Porcentagem(total_investimento,VLR_LOA_INVESTIMENTO),
        perc_custeio = Porcentagem(total_custeio,VLR_LOA_CUSTEIO),
        perc_eixo = Porcentagem(valor_total,valor_total_eixo);

    //valores restantes
    $("#lblValorInvestimento").text('R$ ' + formataMoeda(VLR_LOA_INVESTIMENTO - total_investimento));
    $("#lblValorCusteio").text('R$ ' + formataMoeda(VLR_LOA_CUSTEIO - total_custeio));

    //atualiza valores
    $("#lblValorTotalEixo").text('R$ ' + formataMoeda(valor_total_eixo - valor_total));
    $("#lblTotalInvestimentoPlano").text('R$ ' + formataMoeda(total_investimento));
    $("#lblTotalCusteioPlano").text('R$ ' + formataMoeda(total_custeio));

    //atualiza porcentagens
    $("#lblInvestimentoPercentual").text(perc_investimento + '%');
    $("#lblCusteioPercentual").text(perc_custeio + '%');

    //atualiza os gauges
    gauge_investimento.set(Porcentagem(total_investimento,VLR_LOA_INVESTIMENTO,2,true));
    gauge_custeio.set(Porcentagem(total_custeio,VLR_LOA_CUSTEIO,2,true));

    //atualiza gauge eixo
    TryCatch(function(){gauge_eixo.setDataForId('pointer_eixo_porcentagem',Porcentagem(valor_total,valor_total_eixo,2,true));});
}
