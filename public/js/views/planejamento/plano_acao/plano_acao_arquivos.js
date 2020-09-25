//botão para anexar novo documento ao plano de ação
$('#btnEnviarArquivo').click(function ()
{
    MostrarModal('mdlPlanoArquivos',LimparCamposModalArquivoPlanoAcao,'txtNomeUploadPlanoAcao');
});

//dispara o evento que deleta o anexo
$("#tbArquivos tbody").on('click','tr td i[name=delete_upload]',function()
{
    //recupera os elementos
    let linha = $(this).closest('tr'),arquivo = linha.find('b[name=td_nome_arquivo]').text();

    //mostra a mensagem de confirmação e remove a linha
    ConfirmarBox(format('Deseja excluir anexo "{0}"?',arquivo),'será efetivado após salvar o plano de ação',function(){linha.remove();});
});

$('#form_modal_mdlPlanoArquivos').ajaxForm(
{
    url: UrlBase('planejamento/plano/ajax-anexa-arquivo'),
    beforeSubmit: function()
    {
        //desabilita o botão de enviar arquivo
        $("#btnEnviarArquivo").prop('disabled',true);

        //insere linha na tabela
        $("#tbArquivos tbody").append
        (
            '<tr id="linha_upload_temporario">'
            + format('<td>{0}</td>',$("#txtNomeUploadPlanoAcao").val())
            + '<td>'
            +   '<div class="progress progress-lg">'
            +        '<div id="progresso_arquivo_upload" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>'
            +    '</div>'
            + '</td>'
            + '<td>---</td>'
            + '<td>---</td>'
            + '<td class="text-center">'
            +     '<i class="fa fa-clock text-primary"></i> aguarde...'
            + '</td>'
            + '</tr>'
        );

        FecharModal('mdlPlanoArquivos');
    },
    uploadProgress: function (event, position, total, percentComplete)
    {
        //atualiza o progresso atual
        $("#progresso_arquivo_upload").attr(
        {
            'aria-valuenow': percentComplete,
            style:format("width: {0}%",percentComplete)
        });

        //mostra o texto do status atual
        $("#progresso_arquivo_upload").text(format("{0}%",percentComplete));
    },
    success:function(dado)
    {
        $("#linha_vazia_arquivos_upload").remove();

        $("#linha_upload_temporario").html
        (
            '<td class="text-center">'
            +     format('<a target="_blank" href="{0}"><i class="fa fa-file"></i> <b name="td_nome_arquivo">{1}</b></a>',UrlBase(dado.arquivo),dado.nome)
            + '</td>'
            + format('<td>{0}</td>',dado.mensagem)
            + format('<td class="text-center">{0}</td>',dado.usuario)
            + format('<td class="text-center">{0}</td>',dado.data)
            + '<td class="text-center">'
            +     '<i name="delete_upload" class="fa fa-lg fa-times-circle text-danger cursor-pointer" title="Excluir anexo"></i>'
            + '</td>'
            + format('<input type="hidden" name="anexo[{0}]" value="{0}"/>',dado.id_anexo)
        );

        $("#linha_upload_temporario").attr('id',getIdData());
    },
    error: function (response, status, e)
    {
        $("#progresso_arquivo_upload").removeClass('bg-success');
        $("#progresso_arquivo_upload").addClass('bg-danger');

        $("#linha_upload_temporario").remove();

        MensagemBox('erro','Erro ao anexar o arquivo',response.statusText);
    },
    complete: function()
    {
        //habilita o botão de enviar anexo
        $("#btnEnviarArquivo").prop('disabled',false);
    }
});


//função que limpa os campos da modal de anexo de arquivos do plano de ação
function LimparCamposModalArquivoPlanoAcao()
{
    $("#txtNomeUploadPlanoAcao,#txtComentarioUploadPlanoAcao,#arqUploadPlanoAcao").val('');

    $("#hdnFkPlanoAcaoUpload").val($("#hdnIdPlano").val());
}

