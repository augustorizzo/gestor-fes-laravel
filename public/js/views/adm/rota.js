com_github_culmat_jsTreeTable.register(this)

treeTable($('#tbRotas'));


$('#btnNovaRota').click(function()
{
    LimparCampos();

    CarregaRotaPai(null,null);

    $("#dlgRota").modal({backdrop: "static"}).show();
});

$("#tbRotas tbody").on("click","span[name=editBtn]",function()
{
    LimparCampos();

    $('#titulo_form_modal').text("Atualizar Rota");


    var id = $(this).attr("data");

    $('#id_form_modal_dlgRota').val(id);
    $('#txtNome').val($("#" + id + "_nome").text());
    $('#txtRota').val($("#" + id + "_rota").text());
    $('#txtIcone').val($("#" + id + "_icone").attr('data'));
    $('#icnRota').attr('class',$("#" + id + "_icone").attr('data'));
    $('#cbMenu').prop('checked',$("#" + id + "_menu").attr("data"));

    CarregaRotaPai(id,$("#" + id + "_rota_pai").attr("data"));

    $("#dlgRota").modal({backdrop: "static"}).show();
});

$("#tbRotas tbody").on("click","span[name=delBtn]",function()
{
    var id = $(this).attr("data");

    $('#id_delete_modal').val(id);
    $('#item_delete').text($("#" + id + "_nome").text());
    $("#dlgDelete").modal({backdrop: "static"}).show();
});

$("#txtIcone").keyup(function(e)
{
    $("#icnRota").attr("class",$(this).val());
});

function LimparCampos()
{
    $('#titulo_form_modal').text("Nova Rota");

    $('#id_form_modal').val('');
    $('#txtNome').val('');
    $('#txtRota').val('');
    $('#txtIcone').val('');
    $('#cbPai').val('');
    $('#icnRota').attr('class','');
    $('#cbMenu').prop('checked',true);
}

function CarregaRotaPai(id_rota,id_selecionado)
{
    $.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $.ajax(
    {
        url: UrlBase("adm/ajax-carrega-rota-pai"),
        method: 'post',
        data:
        {
            id: id_rota
        },
        beforeSend: function()
        {
            $("#cbPai option").remove();

           // ModalAjaxCarregando(true,$("#pgEquipamento"),'Carregando...');
        },
        complete: function()
        {
           // ModalAjaxCarregando(false,$("#pgEquipamento"),null);
        },
        success: function(data)
        {
            $("#cbPai").append('<option value="">Selecione</option>');

            data.forEach(item =>
            {
                $("#cbPai").append('<option value="'+ item.id +'">'+ item.nome +'</option>');
            });

            if(id_selecionado != null)
            {
                $("#cbPai").val(id_selecionado);
            }

            $("#cbPai").selectpicker('refresh')
        },
        error:function(error)
        {
            MensagemBox('erro',(error.responseJSON.exception != null && error.responseJSON.exception != '' ?  error.responseJSON.exception : error.responseJSON));
        }
    });
}

$(document).ready(function()
{
    $('#tbRotas tr').each(function(tr)
    {
        $(this).trigger('click');
    });
});

$("#tbRotas tbody").sortable
({
    cursor: "move",
    containment:"parent",
    update: function (e, ui)
    {
        organizaRotas();
    },
    out: function( event, ui )
    {
        organizaIndexMenus();
    }
});

function organizaRotas()
{
    $("#tbRotas tbody tr[data-tt-id]").each(function()
    {
        var filhos = $("#tbRotas tbody tr[data-tt-parent-id="+ $(this).attr("data-tt-id") +"]");

        if(filhos.length > 0)
        {
            filhos.detach().insertAfter(this);
        }
    });
}

function organizaIndexMenus()
{
    var indexes = [];

    $("#tbRotas > tbody > tr[data-tt-id]").each(function()
    {
        var rota = {id:$(this).attr('data-tt-id'), index:this.rowIndex}

        indexes.push(rota);
    });

    $.ajaxSetup(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax(
    {
        url: "ajax-rota-organiza-index",
        method: 'post',
        data:
        {
            indexes: indexes
        },
        success: function(data)
        {
        },
        error:function(error)
        {
            console.log('erro ao organizar as rotas');
        }
    });
}

