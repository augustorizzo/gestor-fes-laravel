$("#frmLogin").submit(function(event)
{

    var usuario = $("#frmLogin input[name=usuario]"),
        senha = $("#frmLogin input[name=password]");

    if(usuario == null || usuario.val() == '' || senha == null || senha.val() == '')
    {
        event.preventDefault();

        MensagemBox('alerta','É necessário informar Usuário e Senha');
    }
});

