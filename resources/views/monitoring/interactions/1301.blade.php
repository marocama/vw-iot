<?php $array = json_decode($readouts[0]->protocol); ?>
<div class="row">
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ key($array) }}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ current($array) }} ºC
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-temperature-high fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <?php next($array); ?>
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ key($array) }}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ current($array) }}%
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-water fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <?php next($array); ?>
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ key($array) }}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ current($array) }}%
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-lightbulb fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php next($array); ?>
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ key($array) }}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ current($array) }}%
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sliders-h fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php reset($array); ?>
</div>
<div class="row">
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card shadow mb-4 border-left-warning">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-secondary">Temperatura</h6>
            </div>
            <div class="card-body align-center">
                <div id="g1"></div>
            </div>
        </div>
    </div> 
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card shadow mb-4 border-left-info">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-secondary">Umidade</h6>
            </div>
            <div class="card-body align-center">
                <div id="g2"></div>
            </div>
        </div>
    </div> 
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card shadow mb-4 border-left-secondary">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-secondary">Luminosidade</h6>
            </div>
            <div class="card-body align-center">
                <div id="g3"></div>
            </div>
        </div>
    </div> 
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card shadow mb-4 border-left-danger">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-secondary">Potênciometro</h6>
            </div>
            <div class="card-body align-center">
                <div id="g4"></div>
            </div>
        </div>
    </div> 
</div>
<div class="row">
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Atuador 1</div>
                        <div class="h6 mb-0 font-weight-bold text-success">
                            LIGADO
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-lightbulb fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <?php next($array); ?>
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Atuador 2</div>
                        <div class="h6 mb-0 font-weight-bold text-danger">
                            DESLIGADO
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-lightbulb fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <?php next($array); ?>
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Atuador 3</div>
                        <div class="h6 mb-0 font-weight-bold text-danger">
                            DESLIGADO
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-plug fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php next($array); ?>
    <div class="col-xl-3 col-md-3 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Atuador 4</div>
                        <div class="h6 mb-0 font-weight-bold text-success">
                            LIGADO
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-plug fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php reset($array); ?>
</div>
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Condição Climática</h6>
    </div>
    <div class="card-body">
        <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
        </div>
    </div>
</div>

@section('js')  
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/raphael-2.1.4.min.js') }}"></script>
<script src="{{ asset('js/justgage.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        
        var dflt = {
            min: 0,
            max: 100,
            donut: false,
            gaugeWidthScale: 0.6,
            counter: true,
            hideInnerShadow: true,
            symbol: ' ºC',
            pointer: true
        }
        var g1 = new JustGage({
            id: 'g1',
            value: {{ current($array) }},
            defaults: dflt
        });

        var g2 = new JustGage({
            id: 'g2',
            value: {{ next($array) }},
            min: 0,
            max: 100,
            donut: false,
            gaugeWidthScale: 0.6,
            counter: true,
            hideInnerShadow: true,
            symbol: ' %',
            pointer: true
        });

        var g3 = new JustGage({
            id: 'g3',
            value: {{ next($array) }},
            min: 0,
            max: 100,
            donut: true,
            gaugeWidthScale: 0.6,
            counter: true,
            hideInnerShadow: true,
            symbol: ' %',
            pointer: true
        });

        var g4 = new JustGage({
            id: 'g4',
            value: {{ next($array) }},
            min: 0,
            max: 100,
            donut: true,
            gaugeWidthScale: 0.6,
            counter: true,
            hideInnerShadow: true,
            symbol: ' %',
            pointer: true
        });
    });

    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            @foreach($readouts->sortBy('created_at') as $readout)
                "{{ date('d/m, H:i:s', strtotime($readout->created_at)) }}",
            @endforeach
        ],
        datasets: [{
        label: "Temperatura",
        lineTension: 0.3,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: [
            @foreach($readouts->sortBy('created_at') as $readout)
                "{{ current(json_decode($readout->protocol)) }}",
            @endforeach
        ],
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
        padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
        }
        },
        scales: {
        xAxes: [{
            time: {
            unit: 'date'
            },
            gridLines: {
            display: false,
            drawBorder: false
            },
            ticks: {
            maxTicksLimit: 7
            }
        }],
        yAxes: [{
            ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
                return number_format(value);
            }
            },
            gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
            }
        }],
        },
        legend: {
        display: false
        },
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
            label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' ºC';
            }
        }
        }
    }
    });
</script>
@endsection




