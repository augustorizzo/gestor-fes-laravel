var CRONOMETRO_SESSAO = null;

$(window).on('load',function()
{
    //fecha o menu entre as mudanças de páginas
    if (localStorage['menu'] == 0)
    {
        $("a.app-sidebar__toggle").trigger('click');
    }

    splashOut();
});

$(window).on('beforeunload',function()
{
    splashIn();
});

$("a.app-sidebar__toggle").click(function()
{
    if($("body.sidebar-mini").hasClass('sidenav-toggled'))
    {
        localStorage['menu'] = 0;
    }
    else
    {
        localStorage['menu'] = 1;
    }
});

$(document).ready(function ()
{
    IniciarSessao();
});

//ativa a propriedade maxlength para limitar o conteúdo do campo
$("input[type='text'], textarea").maxlength({text: ''});

//máscaras dos campos via classe
$(".mask_cpf").mask('000.000.000-00',{reverse:true,placeholder:"___.___.___-__"});
$('.mask_cnpj').mask('00.000.000/0000-00', {reverse: true,placeholder:"__.___.___/____-__"});
$(".mask_cep").mask('00000-000',{reverse:true,placeholder:"_____-___"});
$(".mask_celular").mask('(00) 00000-0000',{reverse:false,placeholder:"(__) _____-____"});
$(".mask_telefone").mask('(00) 0000-0000',{reverse:false,placeholder:"(__) ____-____"});
$(".mask_placa").mask('SSS-0000',{reverse:false,placeholder:"___-____"});
$(".mask_data").mask('00/00/0000',{reverse:false,placeholder:"__/__/____"});
$('.mask_moeda').mask("#.##0,00", {reverse: true});
$('.money').mask('000.000.000.000.000,00', {reverse: true});

/* ----------------------------------- FUNÇÕES ----------------------------------- */
function InciarMaskara(campo,tipo)
{
    var mascara = '';

    switch(tipo)
    {
        case 'moeda':
            mascara = '#.##0,00';
            break;
        default: '';
    }

    campo.mask(mascara, {reverse: true});
}


function linhaNenhumResultado(colunas,texto=null,tag='h2')
{
   return  '<tr>'
         +     '<td colspan="'+ colunas +'" class="text-center">'
         +         '<'+ tag +'><br/>'+ ((texto != null) ? texto : 'Nenhum resultado encontrado' ) +'</'+ tag +'>'
         +     '</td>'
         + '</tr>';
}

function formataData(data = null,horario = false)
{
    var date = (data == null ? new Date() : data);
    var dia = addZero(date.getDate()),
        mes = addZero(date.getMonth() + 1),
        ano = date.getFullYear(),
        hora = addZero(date.getHours()),
        minuto = addZero(date.getMinutes()),
        segundo = addZero(date.getSeconds());


    var resultado = dia + '/' + mes + '/' + ano;

    if(horario)
    {
        resultado += (' ' + hora + ':' + minuto + ':'+ segundo)
    }


    return resultado;
}

function getIdData()
{
    var date = new Date()
    var dia = addZero(date.getDate()),
        mes = addZero(date.getMonth() + 1),
        ano = date.getFullYear(),
        hora = addZero(date.getHours()),
        minuto = addZero(date.getMinutes()),
        segundo = addZero(date.getSeconds()),
        milesimo = addZero(date.getMilliseconds());

    return (dia +''+ mes +''+ ano +''+ hora +''+ minuto +''+ segundo +''+ milesimo);
}

function isNullVazio(item){if(item == null){return '';}else{return item;}}
function addZero(numero){if (numero < 10){numero = '0' + numero;}return numero;}
function splashOut(){$(".se-pre-con").fadeOut("slow");}
function splashIn(){$(".se-pre-con").fadeIn("slow");}

function Popover(elemento,titulo,conteudo,lugar = 'top')
{
    elemento.popover(
    {
        title:titulo,
        placement:lugar,
        container:'body',
        html:true,
        animation:true,
        content:conteudo
    });


    elemento.popover('show');
}

function abreMenu()
{
    var menu = $("#sidebar a[href='"+ window.location.href + "']").first();

    menu.parent().parent().collapse()
}

function InicializaTabela(id_tabela,pesquisa = false,paginacao=false,scrollY=0,exportacao=false)
{
    var table = $('#'+id_tabela).DataTable(
    {
        scrollY:  scrollY != 0 ? scrollY : '100%',
        rowReorder: false,
        paginate:paginacao,
        info: false,
        searching:pesquisa,
        retrieve: true,
        dom: (exportacao ? 'Bfrtip' : 'lfrtip'),
        buttons: (exportacao ? ['excel', 'print'] : false),
        language:
        {
            buttons:
            {
                print: 'Imprimir'
            },
            lengthMenu: "Mostrar _MENU_ registros por página",
            emptyTable: "Nenhum resultado encontrado",
            decimal:",",
            info:"Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty:"Mostrando 0 de 0 registros",
            infoFiltered:"(filtrado de _MAX_ do total de registros)",
            paginate:
            {
                first:"Primeiro",
                last:"Último",
                next:"Próximo",
                previous:"Anterior"
            },
            thousands:".",
            zeroRecords:"Nenhum registro encontrado",
            search:"Pesquisar:",
            loadingRecords:"Carregando...",
            processing:"Processando...",
        }
    });

    //table.columns.adjust().draw();
}

function ValidaCpf(cpf)
{
    cpf = cpf.replace('.','').replace('.','').replace('-','');

    while(cpf.length < 11)
    {
        cpf = "0"+ cpf;
    }

    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/,
        a = [],
        b = new Number,
        c = 11;

    for (i=0; i<11; i++){a[i] = cpf.charAt(i);if (i < 9){b += (a[i] * --c);}}

    if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }

    b = 0,c = 11;

    for (y=0; y<10; y++){b += (a[y] * c--);}

    if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

    var retorno = true;

    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

    return retorno;
}

function ValidaData(data)
{
    return moment(data, 'DD/MM/YYYY', true).isValid();
}

function InicializaDatas()
{
   /* $('.mask_data').each(function()
    {
        var campo = $(this);
        campo.attr('data-toggle','datetimepicker');
        campo.addClass("datetimepicker-input");
        campo.attr('data-target','#' + campo.attr('id'));
    });

    $('.mask_data').datetimepicker({format:'DD/MM/YYYY'});
    */

    $(".mask_data").datepicker({dateFormat:'dd/mm/yy'});
}

function ImagemInput(input,id_output)
{

    if (input.files && input.files[0])
    {
      var reader = new FileReader();

      reader.onload = function(e) {$('#'+ id_output).attr('src', e.target.result);}

      reader.readAsDataURL(input.files[0]);
    }
}

function UrlBase(url = null)
{
    var url_base = $("#hdnUrlBase").val();

    if(url == null)
    {
        return url_base;
    }
    else
    {
        return (url_base + '/' + url);
    }
}

function InicializaCombos()
{
    $("select").selectpicker({size:4,liveSearch:true,styleBase:'form-control border'});

   // $("select").selectpicker("refresh");
}

function AtualizaCombos()
{
    $("select").selectpicker('refresh');
}

function AjaxMetodo(url,metodo,dados,sucesso=null,before=null,complete=null,erro=null,sincrono=false)
{
    $.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax(
    {
        url: UrlBase(url),
        method: metodo,
        data:dados,
        async: !sincrono,
        beforeSend: function()
        {
            if(before != null)
            {
                before();
            }
        },
        complete: function()
        {
            if(complete != null)
            {
                complete();
            }
        },
        success: function(retorno)
        {
            if(sucesso != null)
            {
                sucesso(retorno);
            }
        },
        error:function(error)
        {
            if(erro != null)
            {
                erro(error);
            }
            else
            {
                console.log(error);
                MensagemBox('erro', 'Erro',error.getMessage());
            }
        }
    });
}

function formataMoeda(valor)
{
    if(valor != null)
    {
        return $('.mask_moeda').masked(parseFloat(valor).toFixed(2));
    }

    return valor;
}

function limparMoeda(valor)
{
    return ReplaceAll(valor.replace('R$',''),'.','').replace(',','.');
}


function ReplaceAll(texto,caractere,substituto)
{
    let _texto = texto;

    while(_texto.indexOf(caractere) >= 0)
    {
        _texto = _texto.replace(caractere,substituto);
    }

    return _texto;
}


$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function MostrarModal(id_modal,func_before = null,id_campo_foco=null)
{
    if(func_before != null)
    {
        func_before();
    }

    if(id_campo_foco != null)
    {
        $(format("#{0}",id_modal)).on('shown.bs.modal',function(){$("#"+id_campo_foco).focus()});
    }

    $("#"+id_modal).modal({backdrop:'static'}).show();


}

function FecharModal(id_modal)
{
    $("#"+id_modal).modal('toggle');
}

function InicializaEditorTextarea(ids,btn_fullscreen=false,btn_link=false,btn_image=false,btn_removeFormat=false)
{
    $(ids).trumbowyg(
    {
        lang:'pt_br',
        btns:
        [
            ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em', 'del'],
            ['superscript', 'subscript'],
            (btn_link ? ['link'] : null),
            (btn_image ? ['insertImage'] : null),
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            (btn_removeFormat ? ['removeformat'] : null),
            (btn_fullscreen ? ['fullscreen'] : null)
        ],
    });
}

function format(fmt, ...args)
{
    if (!fmt.match(/^(?:(?:(?:[^{}]|(?:\{\{)|(?:\}\}))+)|(?:\{[0-9]+\}))+$/)) {
        throw new Error('invalid format string.');
    }
    return fmt.replace(/((?:[^{}]|(?:\{\{)|(?:\}\}))+)|(?:\{([0-9]+)\})/g, (m, str, index) => {
        if (str) {
            return str.replace(/(?:{{)|(?:}})/g, m => m[0]);
        } else {
            if (index >= args.length) {
                throw new Error('argument index is out of range in format');
            }
            return args[index];
        }
    });
}

function Porcentagem(valor,total,precisao=2,zerar_range_fora=false)
{
    let percentual = ((valor / (total < 0 ? 1 : total)) * 100);

    if(zerar_range_fora)
    {
        if(percentual > 100)
        {
            return (100.00).toFixed(precisao);
        }
        else if(percentual < 0)
        {
            return (0.00).toFixed(precisao);
        }
        else
        {
            return percentual.toFixed(precisao);
        }
    }
    else
    {
        return percentual.toFixed(precisao);
    }
}

function ValorPercentual(percentual,valor,precisao=2)
{

    let resultado = ((percentual * valor) / 100);

    return resultado.toFixed(precisao);
}

function IniciarSessao()
{
    if(SESSAO_USUARIO != null && typeof SESSAO_USUARIO !== 'undefined')
    {
        TempoSessao();

        //countdown da sessão
        CRONOMETRO_SESSAO = setInterval(TempoSessao, 1000);
    }
}

function TempoSessao()
{
    //essa variável estará vazia se o usuário não estiver logado
    if(SESSAO_USUARIO != null && typeof SESSAO_USUARIO !== 'undefined')
    {
        //recupera o elemento que mostrará o cronômetro
        let cronometro = $("#spnTempoSessao");

        //em segundos - tempo para começar a alertar sobre a renovação da sessão
        let tempo_minimo = 60;

        //verifica se o tempo da sessão já foi calculado, estará vazio caso a página seja recarregada
        if(TEMPO_SESSAO_RESTANTE == null)
        {
            //recupera a hora em que o usuário logou e o tempo de vida da sessão em minutos
            let fim = moment.unix(SESSAO_USUARIO),
                agora = moment.unix(HORA_ATUAL_SERVIDOR);

            //adiciona os minutos de sessão ao tempo em que o usuário logou
            fim.add(TEMPO_SESSAO,'m');

            //armazena a diferença entre agora e quando o usuário logou
            TEMPO_SESSAO_RESTANTE = moment.utc(fim.diff(agora));
        }

        //mostra o cronômetro enquanto a contagem não for negativa
        if(TEMPO_SESSAO_RESTANTE.unix() > 0)
        {
            //tira um segundo do tempo restante
            TEMPO_SESSAO_RESTANTE.subtract(1, 'seconds');

            //mostra o tempo atual para o usuário
            cronometro.text(TEMPO_SESSAO_RESTANTE.format("HH:mm:ss"));

            //após o tempo especificado o texto fica vermelho e piscante
            if(TEMPO_SESSAO_RESTANTE.unix() < tempo_minimo)
            {
                cronometro.addClass("pisca-pisca text-danger");

                //mostra a mensagem caso não esteja visivel
                if(!Swal.isVisible())
                {
                    ToastBox('alerta','Salve seu trabalho ou renove a sessão.',null,null,'top','Renovar');
                }
            }
        }
        else
        {
            if(CRONOMETRO_SESSAO != null)
            {
                //após acabar o tempo mantém o texto vermelho
                cronometro.addClass("text-danger");
                //retira o efeito piscante
                cronometro.removeClass("pisca-pisca");

                //interrompe o loop de contagem de tempo
                clearInterval(CRONOMETRO_SESSAO);

                //expira a sessão
                AjaxMetodo('ajax-logout','GET',null,null,null,null,null,true);

                //redireciona para a página de login
                window.location.replace(UrlBase('login'));
            }
        }
    }
}

function TryCatch(funcao_fazer,funcao_erro = null,funcao_finally=null)
{
    try
    {
        funcao_fazer();
    }
    catch(erro)
    {
        if(funcao_erro != null)
        {
            funcao_erro(erro);
        }
    }
    finally
    {
        if(funcao_finally != null)
        {
            funcao_finally();
        }
    }
}
