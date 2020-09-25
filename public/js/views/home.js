$(document).ready(function()
{
    carregaHistoricoGraficoChamado();
    carregaOverviewChamadoByAno();
});


function carregaHistoricoGraficoChamado()
{
    Highcharts.chart('chartContainer',
    {
        chart: {type: 'column'},
        title: {text: 'Chamados por Mês em 2018'},
        subtitle: {text: ''},
        xAxis:
        {
            categories: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            crosshair: true
        },
        yAxis:
        {
            min: 0,
            title:
            {
                text: 'quantidade'
            }
        },
        tooltip:
        {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td><td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions:
        {
            column:
            {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series:
        [
            {
                name:'Abertos',
                data:[20,50,10,58,17,200,124,25,56,47,56,14]
            },
            {
                name:'Cancelados',
                data:[11,17,8,5,4,14,92,20,7,1,9,10],
                color:'red'
            },
            {
                name:'Resolvidos',
                data:[4,33,2,53,13,108,104,18,55,42,44,4],
                color:'green'
            }
        ]
    });
}


function carregaOverviewChamadoByAno()
{
    Highcharts.chart('chartContainer2',
    {
        lang:
        {
            drillUpText:'Voltar para {series.name}',
        },
        chart:
        {
            type: 'pie'
        },
        title:
        {
            text:''
        },
        subtitle:
        {
            text: ''
        },
        plotOptions:
        {
            series:
            {
                dataLabels:
                {
                    enabled: true,
                    format: '{point.name}: {point.y:.1f}%'
                }
            }
        },
        tooltip:
        {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },
        "series":
        [
            {
                "name": "status",
                "colorByPoint": true,
                "data":
                [
                    {
                        "name": "Cancelados",
                        "y": 20,
                        "color":"red",
                        "drilldown": "cancelados"
                    },
                    {
                        "name": "Resolvidos",
                        "y": 35,
                        "color":"green",
                        "drilldown": "resolvidos"
                    },
                    {
                        "name": "Abertos",
                        "y": 45,
                        "color":"rgb(124, 181, 236)",
                        "drilldown": "abertos"
                    }
                ]
            }
        ],
        "drilldown":
        {
            "series":
            [
                {
                    "name": "Resolvidos",
                    "id": "resolvidos",
                    "data":
                    [
                        ["Marcos",15],
                        ["Juliana",20],
                        ["Fernando",35],
                        ["Bruno",30]
                    ]
                },
                {
                    "name": "Abertos",
                    "id": "abertos",
                    "data":
                    [
                        ["Pendente",60],
                        ["Em Análise",10],
                        ["Em andamento",13],
                        ["Aguardando",17]
                    ]
                },
                {
                    "name": "Cancelados",
                    "id": "cancelados",
                    "data":
                    [
                        ["São Luís",23.68],
                        ["Caxias",17.96],
                        ["Chapadinha",39.58],
                        ["Viana",18.78]
                    ]
                }

            ]
        }
    });
}
