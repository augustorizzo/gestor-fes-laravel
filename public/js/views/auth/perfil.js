
$(document).ready(function()
{
    $("#tabsPerfil li a[data-toggle=tab].ativo").trigger('click');
});

$("#imgFoto").click(function()
{
    $("#dlgArquivo").trigger('click');
});

//altera a miniatura da imagem
$("#dlgArquivo").change(function()
{
    ImagemInput(this,'imgFoto');
});


$("#frmPerfil").submit(function(event)
{
    //valida campos da aba informação
    var nome = $("#txtNome").val(),
        sobrenome = $("#txtSobreNome").val(),
        email = $("#txtEmail").val(),
        celular = $("#txtCelular").val();

    if(nome == '' || sobrenome == '' || email == '' || celular == '' )
    {
        MensagemBox('alerta','Atenção','Preencha todos os campos obrigatórios');

        $("#tab_dados").trigger('click');

        event.preventDefault();
        return;  
    }


    //senha
    var nova = $("#txtSenha").val(),
        confirmacao = $("#txtConfirmaSenha").val(),
        atual  = $("#txtSenhaAtual").val();

    if(nova != '' || confirmacao != '' || atual != '')
    {
        if(atual == '')
        {
            MensagemBox('alerta','Atenção','Informe a senha atual');
            $("#tab_senha").trigger('click');

            event.preventDefault();
            return;
        }
        else if(nova == '')
        {
            MensagemBox('alerta','Atenção','Informe a nova senha');
            $("#tab_senha").trigger('click');

            event.preventDefault();
            return;
        }
        else if(confirmacao == '')
        {
            MensagemBox('alerta','Atenção','Confirme a nova senha');
            $("#tab_senha").trigger('click');
            
            event.preventDefault();
            return;
        }
        else if(nova != confirmacao)
        {
            MensagemBox('alerta','Atenção','A nova senha e a confirmação não são iguais');
            $("#tab_senha").trigger('click');
            
            event.preventDefault();
            return;
        }
    }
});