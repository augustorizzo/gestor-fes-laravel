
// ################################## PLANO ITENS ##################################

//abre modal
$("#btnNovoPlanoItem").click(function()
{
    var inicia_modal = function()
    {
        //chama a função para limpar os campos
        LimpaCamposPlanoItem();

        AlimentarComboPai();
    };

    MostrarModal("mdlPlanoItem",inicia_modal,'txtTituloPlanoItem');
});


//editar item do plano de ação
$("#tbAcoes tbody.acoes").on('click','tr[name=acao] span[name=btn_editar]',function()
{
    //chama a função para limpar os campos
    LimpaCamposPlanoItem();
    AlimentarComboPai();

    //recupera os campos
    var id = $(this).attr('data-id'),
        linha = $(this).closest('tr'),
        justificativa = linha.find(format("input[type=hidden][id='hdn_justificativa_{0}']:first",id)).val(),
        territorio = linha.find(format("input[type=hidden][id='hdn_territorio_{0}']:first",id)).val(),
        estrategia = linha.find(format("input[type=hidden][id='hdn_estrategia_{0}']:first",id)).val(),
        objetivo = linha.find(format("input[type=hidden][id='hdn_objetivo_{0}']:first",id)).val(),
        resultado = linha.find(format("input[type=hidden][id='hdn_resultado_{0}']:first",id)).val(),
        impacto = linha.find(format("input[type=hidden][id='hdn_impacto_{0}']:first",id)).val(),
        titulo = linha.find(format("input[type=hidden][id='hdn_titulo_{0}']:first",id)).val(),
        meta = linha.find(format("input[type=hidden][id='hdn_meta_{0}']:first",id)).val(),
        indicador = linha.find(format("input[type=hidden][id='hdn_indicador_{0}']:first",id)).val(),
        idx = linha.find("td[name=td_idx]:first").text(),

        editar_plano = function()
        {
            var id_pai = linha.find("input[type=hidden][id='hdn_pai_"+ id +"']:first").val();

            $("#cbPlanoItemPai").val(id_pai);
            $("#sldSubItem").prop('checked',(id_pai != 'null' && id_pai != ''));
            $("#sldSubItem").trigger('change');
            $("#hdnIdPlanoItem").val(id);
            $("#hdnIdxPlanoItem").val(idx);
            $("#txtTituloPlanoItem").val(titulo);
            $("#txtMetaPlanoItem").trumbowyg('html',(meta != "null" ? meta : ""));
            $("#txtIndicadorPlanoItem").trumbowyg('html',(indicador != "null" ? indicador : ""));
            $('#txtJustificativaPlanoItem').trumbowyg('html',(justificativa != "null" ? justificativa : ""));
            $("#txtTerritorioPlanoItem").trumbowyg('html',(territorio != "null" ? territorio : ""));
            $("#txtEstrategiaPlanoItem").trumbowyg('html',(estrategia != "null" ? estrategia : ""));
            $("#txtObjetivoPlanoItem").trumbowyg('html',(objetivo != "null" ? objetivo : ""));
            $("#txtResultadoPlanoItem").trumbowyg('html',(resultado != "null" ? resultado : ""));
            $("#txtImpactoPlanoItem").trumbowyg('html',(impacto != "null" ? impacto : ""));

        };

    MostrarModal("mdlPlanoItem",editar_plano,'txtTituloPlanoItem');
});

//excluir a ação
$("#tbAcoes tbody.acoes").on('click','tr[name=acao] span[name=btn_excluir]',function()
{
    //pega a linha do botão
    var linha = $(this).closest('tr');

    //mostra a caixa de confirmação
    ConfirmarBox('Deseja realmente excluir a ação?','Os subitens e os detalhes também serão excluídos.',function()
    {
        //remove os subitens da ação
        linha.parent().find('tr[name=acao]').has('input[type=hidden][id*=hdn_pai][value='+ linha.attr('id') +']').each(function()
        {
            //remove os detalhes dos subitens
            $("#detalhes_" + $(this).attr('id')).remove();

            //remove o subitem
            $(this).remove();
        });


        //remove os detalhes da ação
        $("#detalhes_" + linha.attr('id')).remove();

        //remove a ação
        linha.remove();
    });
});

//evento ao mudar o slider de subitem
$("#sldSubItem").change(function()
{
    let linha = $("#cbPlanoItemPai").closest('.row');

    if($(this).prop('checked'))
    {
        linha.removeClass('d-none');
    }
    else
    {
        linha.addClass('d-none');
    }
});

//submit do Formulário PlanoItem
$("#form_modal_mdlPlanoItem").submit(function(event)
{
    //pára o envio do formulário
    event.preventDefault();

    //dados
    var id = $("#hdnIdPlanoItem").val(),
        id_pai = $("#cbPlanoItemPai").val(),
        titulo = $("#txtTituloPlanoItem").val(),
        indicador = $("#txtIndicadorPlanoItem").val(),
        meta = $("#txtMetaPlanoItem").val(),
        justificativa = $('#txtJustificativaPlanoItem').trumbowyg('html'),
        territorio = $("#txtTerritorioPlanoItem").trumbowyg('html'),
        estrategia = $("#txtEstrategiaPlanoItem").trumbowyg('html'),
        objetivo = $("#txtObjetivoPlanoItem").trumbowyg('html'),
        resultado = $("#txtResultadoPlanoItem").trumbowyg('html'),
        impacto = $("#txtImpactoPlanoItem").trumbowyg('html'),
        idx = $("#hdnIdxPlanoItem").val(),
        valor = {investimento:0.0,custeio:0.0};

    //atualiza linha do item
    InserirPlanoItem(id,(id_pai == '' ? null : id_pai),(idx == '' ? null : idx),titulo,justificativa,valor,indicador,meta,territorio,estrategia,objetivo,resultado,impacto);

    //dispara o cálculo dos itens
    DisparaCalculoAcaoItem();

    //mensagem de sucesso
    MensagemBox('sucesso','','',1500);

    //fecha a modal
    FecharModal('mdlPlanoItem');
});

//adiciona os itens do combo do pai
function AlimentarComboPai()
{
    //limpa o combo
    $("#cbPlanoItemPai option").remove();
    $("#cbPlanoItemPai").append('<option value="">Selecione</option>');

    //procura os itens que não tem pai, forçando apenas 1 nivel
    $("#tbAcoes tbody.acoes tr[name=acao]").has('input[type=hidden][id*=hdn_pai][value=null]').each(function()
    {
        let id_pai = $(this).attr('id'),
            idx = $(this).find('td[name=td_idx]:first').text(),
            titulo = $(this).find('td[name=td_titulo]:first').text();

        $("#cbPlanoItemPai").append
        (
            format('<option value="{0}">{1} - {2}</option>' ,id_pai,idx,titulo)
        );
    });
}

//limpa os campos da modal
function LimpaCamposPlanoItem()
{
    $("#cbPlanoItemPai,#hdnIdPlanoItem,#hdnIdxPlanoItem,#txtTituloPlanoItem").val('');
    $('#mdlPlanoItem textarea').each(function(){$(this).trumbowyg("empty");});
    $("#sldSubItem").prop('checked',false);
    $("#sldSubItem").trigger('change');
    //seleciona a aba com a classe 'ativo'
    $("#mdlPlanoItem #tbasAutuacao li a.ativo").trigger('click');
}

//Função que insere o item do plano de ação
function InserirPlanoItem(id,id_pai,idx,titulo,descricao,valor,indicador,meta,territorio,estrategia,objetivo,resultado,impacto)
{
    //pega a qtd de itens com o mesmo pai
    var qtd_item = $("#tbAcoes tbody.acoes tr[name=acao] input[type=hidden][id*=hdn_pai][value="+ id_pai +"]").length;

    //ID da linha
    id = ((id == null || id == '') ? (getIdData() + 'x') : id);

    //numeração do item, caso não seja setado
    idx = (idx != null ? idx : ((id_pai != null ? ($("#tbAcoes tbody.acoes tr[name=acao][id="+ id_pai +"] td[name=td_idx]").text() + '.') : '') + (qtd_item + 1)));

    //nome da tabela detalhe
    var id_detalhe = ('detalhes_'+ id);

    //conteúdo da linha
    var linha =
    (
        '<td name="td_detalhe" class="text-center">'
        +   '<i name="detalhe-acao" class="fa fa-plus-circle cursor-pointer text-success" '
        +       'title="detalhar" '
        +       'data-detalhe="'+ id_detalhe +'"></i>'
        +'</td>'
        +'<td name="td_idx" class="'+ (id_pai == null ? 'text-center font-weight-bold':'text-right') +'">'+ idx +'</td>'
        +'<td name="td_titulo" class="'+ (id_pai == null ? 'font-weight-bold':'') +'">'+ titulo +'</td>'
        +'<td class="text-right" name="td_valor_investimento">'+ formataMoeda(valor.investimento) +'</td>'
        +'<td class="text-right" name="td_valor_custeio">'+ formataMoeda(valor.custeio) +'</td>'
        +'<td class="text-right" name="td_valor">'+ formataMoeda(valor.custeio + valor.investimento) +'</td>'
        +'<td name="td_acoes" class="text-center">'
        +    format('<span name="btn_editar" class="cursor-pointer  mr-2" data-id="{0}" title="Editar Ação"><i class="fa fa-edit text-success"></i></span>',id)
        +    format('<span name="btn_excluir" class="cursor-pointer" data-id="{0}" title="Excluir Ação"><i class="fa fa-times text-danger"></i></span>',id)
        +'</td>'
        + format('<input id="hdn_pai_{0}" type="hidden" name="planoitem[{1}][pai]" value="{2}"/>',id,id,id_pai)
        + format('<input id="hdn_idx_{0}" type="hidden" name="planoitem[{1}][idx]" value="{2}"/>',id,id,idx)
        + format('<input id="hdn_id_{0}" type="hidden" name="planoitem[{1}][id]" value="{2}"/>',id,id,id)
        + format('<input id="hdn_titulo_{0}" type="hidden" name="planoitem[{1}][titulo]" value="{2}"/>',id,id,titulo)
        + format('<input id="hdn_indicador_{0}" type="hidden" name="planoitem[{1}][indicador]" value="{2}"/>',id,id,indicador)
        + format('<input id="hdn_meta_{0}" type="hidden" name="planoitem[{1}][meta]" value="{2}"/>',id,id,meta)
        + format('<input id="hdn_justificativa_{0}" type="hidden" name="planoitem[{1}][justificativa]" value="{2}"/>',id,id,descricao)
        + format('<input id="hdn_territorio_{0}" type="hidden" name="planoitem[{1}][territorio]" value="{2}"/>',id,id,territorio)
        + format('<input id="hdn_estrategia_{0}" type="hidden" name="planoitem[{1}][estrategia]" value="{2}"/>',id,id,estrategia)
        + format('<input id="hdn_objetivo_{0}" type="hidden" name="planoitem[{1}][objetivo]" value="{2}"/>',id,id,objetivo)
        + format('<input id="hdn_resultado_{0}" type="hidden" name="planoitem[{1}][resultado]" value="{2}"/>',id,id,resultado)
        + format('<input id="hdn_impacto_{0}" type="hidden" name="planoitem[{1}][impacto]" value="{2}"/>',id,id,impacto)
        + format('<input id="hdn_vlr_custeio_{0}" type="hidden" name="planoitem[{1}][custeio]" value="{2}"/>',id,id,valor.custeio)
        + format('<input id="hdn_vlr_investimento_{0}" type="hidden" name="planoitem[{1}][investimento]" value="{2}"/>',id,id,valor.investimento)
    );

    //pega o elemento para atualizar
    var elementoLinha = $("#tbAcoes tbody tr[id='"+ id +"']");

    //verifica se encontrou o elemento pelo ID. Entra no IF caso não encontre
    if(elementoLinha.length == 0)
    {
        if(id_pai == null)
        {
            //se o elemento não tem pai, então é adiciona nova linha diretamente
            $("#tbAcoes tbody.acoes").append('<tr id="'+ id +'" name="acao">'+ linha +'</tr>');
        }
        else
        {
            //caso o elemento tenha pai, é incluído na última linha dos filhos do elemento pai
            $("#tbAcoes tbody.acoes tr[name=acao] input[type=hidden][id*=hdn_" +  (qtd_item > 0 ? "pai" : "id") +"][value="+ id_pai +"]:last").closest('tr').after('<tr id="'+ id +'" name="acao">'+ linha +'</tr>');
        }
    }
    else
    {
        //atualiza a linha caso encontre o elemtento
        elementoLinha.html(linha);
    }
}

//Carrega os itens do plano
function CarregarAcoesPlano()
{
    var id_plano = $("#hdnIdPlano").val();

    if(id_plano != null && id_plano != '')
    {
        var dados = {id_plano:id_plano},
            before = function()
            {
                $("#tbAcoes tbody tr").remove();

                $("#tbAcoes tbody").append('<tr id="linhaCarregandoAcoes" class="text-center font-weight-bold"><td  colspan="7"><i class="fa fa-refresh fa-spin"></i> Carregando ações...</td></tr>');
            },
            complete = function()
            {
                $("#linhaCarregandoAcoes").remove();
            },
            sucesso = function(itens)
            {
                $("#tbAcoes tbody tr").remove();

                if(itens.length > 0)
                {
                    //percorre as ações para criar as linhas do plano
                    itens.forEach(item =>
                    {
                        InserirPlanoItem(item.id,item.id_pai,item.idx,item.titulo,item.justificativa,item.valor,item.indicador,item.meta,item.territorio,item.estrategia,item.objetivo,item.resultado,item.impacto);
                    });

                    //percorre as ações para criar os detalhes
                    itens.forEach(item =>
                    {
                        let linha = $("#tbAcoes tbody tr[id='"+ item.id +"']");

                        //cria tabela detalhe
                        CriaTabelaDetalhe(linha,('detalhes_'+ item.id),false,item.detalhes.length == 0);

                        //percorre os detalhes
                        item.detalhes.forEach(detalhe =>
                        {
                            LinhaEditavel(item.id,('detalhes_'+ item.id),detalhe);
                        });
                    });

                    //dispara evento para calcular cada um dos detalhes
                    DisparaCalculoAcaoItem();
                }
                else
                {
                    $("#tbAcoes tbody").append('<tr class="text-center font-weight-bold"><td  colspan="7">Nenhuma ação encontrada.</td></tr>');
                }

            };
        AjaxMetodo('planejamento/plano/ajax-carrega-acoes-plano','POST',dados,sucesso,before,complete);
    }
}

//aciona o disparo do evento para cálculo das ações
function DisparaCalculoAcaoItem()
{
    $("#tbAcoes tbody tr table tbody tr td .calcula").trigger('change');
}
