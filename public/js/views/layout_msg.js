
function MensagemBox(tipo,titulo,mensagem,timer=null,botao=null)
{
    var icone = '' ;

    switch(tipo)
    {
        case 'sucesso':
            icone = 'success';
            break;
        case 'alerta':
            icone = 'warning';
            break;
        case 'erro':
            icone = 'error';
            break;
        case 'info':
            icone = 'info';
            break;
        case 'pergunta':
            icone = 'question';
            break;
    }

    Swal.fire(
    {
        icon:icone,
        //backdrop:true,
        title:(titulo != null ? titulo : ''),
        text:mensagem,
        showConfirmButton: (timer == null || timer == ''),
        confirmButtonText:'OK',
        focusConfirm:true,
        //width:'30%',
        //target:'body',
        //showCancelButton:false,
        //cancelButtonText:'Cancelar',
        //showCloseButton:false,
        timer: timer,
        timerProgressBar:true,
        //toast:true,
        //grow:true,
        allowOutsideClick:false, //evita que a mensagem suma com um clique na página
        allowEscapeKey:true,
        allowEnterKey:true
    });
}

function ConfirmarBox(titulo,mensagem,funcao_confirmar)
{

    Swal.fire(
    {
        title: titulo,
        text: mensagem,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '<i class="fa fa-check text-success"></i> Confirmar',
        cancelButtonText: 'Cancelar',
    })
    .then((result) =>
    {
        if (result.value && funcao_confirmar != null)
        {
            funcao_confirmar();
        }
    });
}

function ToastBox(tipo,mensagem,timer,elemento=null,posicao=null,botao=null)
{
    var icone = '' ;

    switch(tipo)
    {
        case 'sucesso':
            icone = 'success';
            break;
        case 'alerta':
            icone = 'warning';
            break;
        case 'erro':
            icone = 'error';
            break;
        case 'info':
            icone = 'info';
            break;
        case 'pergunta':
            icone = 'question';
            break;
    }

    //posições
    //'top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', or 'bottom-end'.

    Swal.fire(
    {
        icon:icone,
        toast:true,
        position: (posicao == null ? 'center' : posicao),
        text:mensagem,
        showConfirmButton:(botao != null),
        confirmButtonText:botao,
        timer: timer,
        timerProgressBar:true,
        //allowOutsideClick:false, //evita que a mensagem suma com um clique na página
        onBeforeOpen:function()
        {
            //adiciona borda vermelha aos elementos
            if(elemento != null)
            {
                elemento.addClass('border border-danger');
            }
        },
        onDestroy: function()
        {
            //retira borda vermelha aos elementos
            if(elemento != null)
            {
                elemento.removeClass('border border-danger');
            }
        }

    });
}

function ModalAjaxCarregando(ativo,titulo=null,texto=null)
{
    if(ativo)
    {
        Swal.fire(
        {
            title: titulo,
            text: texto,
            imageUrl: "/img/loader.gif",
            imageHeight:100,
            showConfirmButton: false,
            allowOutsideClick: false
        });
    }
    else
    {
        Swal.close();
    }
}
