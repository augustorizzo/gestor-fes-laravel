$('#cbUF').change(function()
{

    if($('#cbUF').selectpicker('val') == '')
    {
        $('#cbCidade option').remove();
        $("#cbCidade").prop('disabled',true);
        $("#cbCidade").selectpicker('refresh');
    }
    else
    {
        CarregaCidades($('#cbUF').selectpicker('val'),'cbCidade',null);
    }
});

function LimparEndereco()
{
    $('#hdn_endereco_id,#txtEndereco,#txtNumero,#txtBairro,#txtComplemento,#txtCep,#cbUF').val('');
    $("#cbUF").trigger('change');
}

function PreencherEndereco(id,endereco,numero,bairro,complemento,cep,uf,cidade,id_cidade=null)
{
    $('#hdn_endereco_id').val(id);

    $('#txtEndereco').val(endereco);
    $('#txtNumero').val(numero);
    $('#txtBairro').val(bairro);
    $('#txtComplemento').val(complemento);
    $('#txtCep').val(cep);
    $('#cbUF').selectpicker('val',uf);

   CarregaCidades(uf,cidade,id_cidade);
}

function CarregaCidades(id_uf, cbCidade,id_cidade)
{
    $.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax(
    {
        url: UrlBase("adm/ajax-cidade-uf"),
        method: 'post',
        data:
        {
            estado: id_uf
        },
        beforeSend: function()
        {
            $("#"+ cbCidade +" option").remove();
            $("#"+ cbCidade).prop('disabled',true);
            $("#"+ cbCidade).append('<option>Carregando...</option>');

            $("#"+ cbCidade).selectpicker('refresh');
        },
        success: function(data)
        {
            console.log('sucesso');

            $("#"+ cbCidade +" option").remove();
            $("#"+ cbCidade).append('<option value="">Selecione</option>');

            data.forEach(item =>
            {
                $("#"+ cbCidade).append('<option value="' + item.id + '">' + item.nome + '</option>');
            });

			$("#"+ cbCidade).prop('disabled',false);

			if (id_cidade != null)
			{
				$("#"+ cbCidade).val(id_cidade);
            }

            $("#"+ cbCidade).selectpicker('refresh');
        },
        error:function(error)
        {
            MensagemBox('erro','Erro',(error.responseJSON.exception != null && error.responseJSON.exception != '' ?  error.responseJSON.exception : error.responseJSON));
        }
    });
}
