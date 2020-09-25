//variáveis dos gráficos
var gauge_investimento,gauge_custeio,gauge_eixo;

function Gauges()
{   var opts =
    {
        angle: -0.2, // The span of the gauge arc
        lineWidth: 0.2, // The line thickness
        radiusScale: 1, // Relative radius
        pointer:
        {
            length: 0.6, // // Relative to gauge radius
            strokeWidth: 0.035, // The thickness
            color: '#000000' // Fill color
        },
        limitMax: false,     // If false, max value increases automatically if value > maxValue
        limitMin: false,     // If true, the min value of the gauge will be fixed
        colorStart: '#6FADCF',   // Colors
        colorStop: '#8FC0DA',    // just experiment with them
        strokeColor: '#E0E0E0',  // to see which ones work best for you
        generateGradient: true,
        highDpiSupport: true,     // High resolution support
        staticZones:
        [
            {strokeStyle: "#F03E3E", min: 0, max: 30}, // Red
            {strokeStyle: "#FFDD00", min: 31, max: 60}, // Yellow
            {strokeStyle: "#30B32D", min: 61, max: 100} // Green
        ],
    };

    //Investimento
    gauge_investimento = new Gauge(document.getElementById('gauge-investimento')).setOptions(opts); // create sexy gauge!
    gauge_investimento.maxValue = 100; // set max gauge value
    gauge_investimento.setMinValue(0);  // Prefer setter over gauge.minValue = 0
    gauge_investimento.animationSpeed = 32; // set animation speed (32 is default value)
    gauge_investimento.set(0);

    //Custeio
    gauge_custeio = new Gauge(document.getElementById('gauge-custeio')).setOptions(opts); // create sexy gauge!
    gauge_custeio.maxValue = 100; // set max gauge value
    gauge_custeio.setMinValue(0);  // Prefer setter over gauge.minValue = 0
    gauge_custeio.animationSpeed = 32; // set animation speed (32 is default value)
    gauge_custeio.set(0);


    /*
    //gauge eixo
    var opts_eixo =
    {
        angle: -0.2, // The span of the gauge arc
        lineWidth: 0.2, // The line thickness
        radiusScale: 1, // Relative radius
        pointer:
        {
            length: 0.6, // // Relative to gauge radius
            strokeWidth: 0.035, // The thickness
            color: '#000000' // Fill color
        },
        limitMax: false,     // If false, max value increases automatically if value > maxValue
        limitMin: false,     // If true, the min value of the gauge will be fixed
        colorStart: '#6FADCF',   // Colors
        colorStop: '#8FC0DA',    // just experiment with them
        strokeColor: '#E0E0E0',  // to see which ones work best for you
        generateGradient: true,
        highDpiSupport: true,     // High resolution support
        staticZones:
        [
            {strokeStyle: "#30B32D", min: 0, max: 1000}, // Green
            {strokeStyle: "#FFDD00", min: 1001, max: 2000}, // Yellow
            {strokeStyle: "#F03E3E", min: 2001, max: 3000}  // Red
        ],
    };

    //Eixo
    gauge_eixo = new Gauge(document.getElementById('gauge-eixo')).setOptions(opts_eixo); // create sexy gauge!
    gauge_eixo.maxValue = 3000; // set max gauge value
    gauge_eixo.setMinValue(0);  // Prefer setter over gauge.minValue = 0
    gauge_eixo.animationSpeed = 32; // set animation speed (32 is default value)
    gauge_eixo.set(1500);
    */

}

function GaugeLinear()
{
    FusionCharts.ready(function()
    {
        gauge_eixo = new FusionCharts(
        {
            type: 'hlineargauge',
            renderAt: 'gauge-eixo',
            id: 'cpu-linear-gauge',
            width: '100%',
            height: '80',
            dataFormat: 'json',
            dataSource:
            {
                "chart":
                {
                    "theme": "fusion",
                   // "caption": "Eixo",
                    //"subcaption": "food.hsm.com",
                    "lowerLimit": "0",
                    "upperLimit": "100",
                    "numberSuffix": "%",
                    "chartBottomMargin": "20",
                    "valueFontSize": "0",
                    "valueFontBold": "0"
                },
                "colorRange":
                {
                    "color":
                    [
                        {
                            "minValue": "0",
                            "maxValue": "35",
                            "code":"#ff654f",
                            "label": "",
                        },
                        {
                            "minValue": "35",
                            "maxValue": "70",
                            "code": "#ffdd00",
                            "label": "",
                        },
                        {
                            "minValue": "70",
                            "maxValue": "100",
                            "code": "#8bba00",
                            "label": "",
                        }
                    ]
                },
                "pointers":
                {
                    "pointer":
                    [
                        {
                            "id":"pointer_eixo_porcentagem",
                            "value": "0",
                            //"toolText": "Customer satisfaction $value%"
                        }
                    ]
                },
                /*
                "trendPoints":
                {
                    "point":
                    [
                        //Trendpoint
                        {
                            "startValue": "70",
                            "displayValue": " ",
                            "dashed": "1",
                            "showValues": "0"
                        },
                        {
                            "startValue": "85",
                            "displayValue": " ",
                            "dashed": "1",
                            "showValues": "0"
                        },
                        //Trendzone
                        {
                            "startValue": "70",
                            "endValue": "85",
                            "displayValue": " ",
                            "alpha": "40"
                        }
                    ]
                },
                */
               /*
                "annotations":
                {
                    "origw": "400",
                    "origh": "190",
                    "autoscale": "1",
                    "groups":
                    [
                        {
                            "id": "range",
                            "items":
                            [
                                {
                                    "id": "rangeBg",
                                    "type": "rectangle",
                                    "x": "$chartCenterX-115",
                                    "y": "$chartEndY-35",
                                    "tox": "$chartCenterX +115",
                                    "toy": "$chartEndY-15",
                                    "fillcolor": "#0075c2"
                                },
                                {
                                    "id": "rangeText",
                                    "type": "Text",
                                    "fontSize": "11",
                                    "fillcolor": "#ffffff",
                                    "text": "Recommended Utilization Range : 70% - 85%",
                                    "x": "$chartCenterX",
                                    "y": "$chartEndY-25"
                                }
                            ]
                        }
                    ]
                }
                */
            }
        })
        .render();
    });
}
