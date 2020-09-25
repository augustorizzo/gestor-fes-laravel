function CarregarComboEixo(id_programa,id_elemento,id_eixo_selecionado=null,modal=false,disabled=false)
{
    var elemento = $("#"+id_elemento);

    if(id_programa != null && id_programa != '')
    {
        let dados = [],
        before = function()
        {
            elemento.prop('disabled',false);
            elemento.find('option').remove();

            if(modal)
            {
                ModalAjaxCarregando(true,'Carregando ações...');
            }
            else
            {
                elemento.append('<option value="">Carregando...</option>');
            }
        },
        complete = function()
        {
            if(modal)
            {
                ModalAjaxCarregando(false);
            }
        },
        sucesso = function(combo)
        {
            elemento.find('option').remove();
            elemento.append('<option value="">Selecione</option>');

            combo.forEach(item=>
            {
                let opcao = $(document.createElement('option'));
                opcao.val(item.id);
                opcao.attr('abrv',item.abreviacao);
                opcao.text(item.valor);
                opcao.prop('selected',(id_eixo_selecionado != null && id_eixo_selecionado == item.id));

                elemento.append(opcao);
            });

            elemento.prop('disabled',disabled);
        };

        AjaxMetodo('combo_ajax/eixos/' + id_programa,'POST',dados,sucesso,before,complete);
    }
    else
    {
        elemento.find('option').remove();
        elemento.prop('disabled',true);
    }
}
