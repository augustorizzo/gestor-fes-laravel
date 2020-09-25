$("#imgFoto").click(function()
{
    $("#dlgArquivo").trigger('click');
});

//altera a miniatura da imagem
$("#dlgArquivo").change(function()
{
    ImagemInput(this,'imgFoto');
});

$("#btnNovoUsuario").click(function()
{
    LimparCampos();

    $("#dlgFormulario").modal({backdrop: "static"}).show();
});

$("#tbUsuarios tbody").on("click","span[name=editBtn]",function()
{
    var id = $(this).attr("data");

    LimparCampos();

    $('#titulo_form_modal').text("Atualizar Usuário");
    $('#id_form_modal').val(id);
    $('#txtUsuario').val($("#" + id + "_usuario").text());
    $('#txtNome').val($("#" + id + "_nome").text());
    $('#txtSobreNome').val($("#" + id + "_sobrenome").text());
    $('#imgFoto').attr('src',UrlBase($("#" + id + "_foto").val()));
    $('#txtCpf').val($("#" + id + "_cpf").text());
    $('#txtEmail').val($("#" + id + "_email").text());
    $('#txtCelular').val($("#" + id + "_celular").text());
    //$('#cbComunidade').val($("#" + id + "_comunidade").attr('data'));
    $('#cbClasse').val($("#" + id + "_classe").attr('data'));
    $('#cbAtivo').prop('checked',$("#" + id + "_ativo").attr('data')==1);

    $('#txtSenha,#txtConfirmSenha').prop('required',false);

    $("#dlgFormulario").modal({backdrop: "static"}).show();
});

$("#tbUsuarios tbody").on("click","span[name=delBtn]",function()
{
    var id = $(this).attr("data");

    $('#id_delete_modal').val(id);
    $('#item_delete').text($("#" + id + "_nome").text());
    $("#dlgDelete").modal({backdrop: "static"}).show();
});


function LimparCampos()
{
    $('#titulo_form_modal').text("Novo Usuário");

    $('#id_form_modal').val('');
    $('#txtUsuario').val('');
    $('#txtNome').val('');
    $('#txtSobreNome').val('');
    $('#imgFoto').attr('src',UrlBase('img/default-user.png'));
    $('#txtCpf').val('');
    $('#txtEmail').val('');
    $('#txtCelular').val('');
    //$('#cbComunidade').val('');
    $('#cbClasse').val('');
    $('#cbAtivo').prop('checked',true);
    $('#txtSenha,#txtConfirmSenha').prop('required',true);
}

