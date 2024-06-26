@extends('layouts.admin.app')

@section('title','Rapport des commandes')

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="media mb-3">
            <!-- Avatar -->
            <div class="avatar avatar-xl avatar-4by3 mr-2">
                <img class="avatar-img" src="{{asset('assets/admin')}}/svg/illustrations/order.png" alt="Image Description">
            </div>
            <!-- End Avatar -->

            <div class="media-body">
                <div class="row">
                    <div class="col-lg mb-3 mb-lg-0">
                        <h1 class="page-header-title">{{\App\CentralLogics\translate('rapport')}} des {{\App\CentralLogics\translate('commandes')}}</h1>

                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span>{{\App\CentralLogics\translate('admin')}}:</span>
                                <a href="#">{{auth('admin')->user()->f_name.' '.auth('admin')->user()->l_name}}</a>
                            </div>

                            <div class="col-auto">
                                <div class="row align-items-center g-0">
                                    <div class="col-auto pr-2">{{\App\CentralLogics\translate('date')}}</div>

                                    <!-- Flatpickr -->
                                    <div>
                                        ( {{session('from_date')}} - {{session('to_date')}} )
                                    </div>
                                    <!-- End Flatpickr -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-auto">
                        <div class="d-flex">
                            <a class="btn btn-icon btn-primary rounded-circle" href="{{route('admin.dashboard')}}">
                                <i class="tio-home-outlined"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Media -->

        <!-- Nav -->
        <!-- Nav -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev" style="display: none;">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-left"></i>
                </a>
            </span>

            <span class="hs-nav-scroller-arrow-next" style="display: none;">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-right"></i>
                </a>
            </span>

            <ul class="nav nav-tabs page-header-tabs" id="projectsTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:">{{\App\CentralLogics\translate('aperçu général')}}</a>
                </li>
            </ul>
        </div>
        <!-- End Nav -->
    </div>
    <!-- End Page Header -->

    <div class="row border-bottom border-right border-left border-top" style="border-radius: 10px">
        <div class="col-lg-12 pt-3">
            <form action="{{route('admin.report.set-date')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{\App\CentralLogics\translate('afficher')}} les {{\App\CentralLogics\translate('données')}} par {{\App\CentralLogics\translate('date')}}
                                {{\App\CentralLogics\translate('portée')}}</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <input type="date" name="from" id="from_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <input type="date" name="to" id="to_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-block">{{\App\CentralLogics\translate('afficher')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @php
        $from = session('from_date');
        $to = session('to_date');
        $total=\App\Model\Order::whereBetween('created_at', [$from, $to])->count();
        if($total==0){
        $total=.01;
        }
        @endphp
        <div class="col-sm-6 col-lg-4 mb-3 mb-lg-6">
            @php
            $confirmed=\App\Model\Order::where(['order_status'=>'confirmed'])->whereBetween('created_at', [$from, $to])->count()
            @endphp
            <!-- Card -->
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <!-- Media -->
                            <div class="media">
                                <i class="tio-shopping-cart nav-icon"></i>

                                <div class="media-body">
                                    <h4 class="mb-1">{{\App\CentralLogics\translate('confirmée')}}</h4>
                                    <span class="font-size-sm text-success">
                                        <i class="tio-trending-up"></i> {{$confirmed}}
                                    </span>
                                </div>
                            </div>
                            <!-- End Media -->
                        </div>

                        <div class="col-auto">
                            <!-- Circle -->
                            <div class="js-circle" data-hs-circles-options='{
                                       "value": {{round(($confirmed/$total)*100)}},
                                       "maxValue": 100,
                                       "duration": 2000,
                                       "isViewportInit": true,
                                       "colors": ["#e7eaf3", "green"],
                                       "radius": 25,
                                       "width": 3,
                                       "fgStrokeLinecap": "round",
                                       "textFontSize": 14,
                                       "additionalText": "%",
                                       "textClass": "circle-custom-text",
                                       "textColor": "green"
                                     }'></div>
                            <!-- End Circle -->
                        </div>
                    </div>
                    <!-- End Row -->
                </div>
            </div>
            <!-- End Card -->
        </div>



        <div class="col-sm-6 col-lg-4 mb-3 mb-lg-6">
            @php
            $failed=\App\Model\Order::where(['order_status'=>'pending'])->whereBetween('created_at', [$from, $to])->count()
            @endphp
            <!-- Card -->
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <!-- Media -->
                            <div class="media">
                                <i class="tio-message-failed nav-icon"></i>

                                <div class="media-body">
                                    <h4 class="mb-1">{{\App\CentralLogics\translate('en attente')}}</h4>
                                    <span class="font-size-sm text-danger">
                                        <i class="tio-trending-up"></i> {{$failed}}
                                    </span>
                                </div>
                            </div>
                            <!-- End Media -->
                        </div>

                        <div class="col-auto">
                            <!-- Circle -->
                            <div class="js-circle" data-hs-circles-options='{
                           "value": {{round(($failed/$total)*100)}},
                           "maxValue": 100,
                           "duration": 2000,
                           "isViewportInit": true,
                           "colors": ["#e7eaf3", "darkred"],
                           "radius": 25,
                           "width": 3,
                           "fgStrokeLinecap": "round",
                           "textFontSize": 14,
                           "additionalText": "%",
                           "textClass": "circle-custom-text",
                           "textColor": "darkred"
                         }'></div>
                            <!-- End Circle -->
                        </div>
                    </div>
                    <!-- End Row -->
                </div>
            </div>
            <!-- End Card -->
        </div>

        <div class="col-sm-6 col-lg-4 mb-3 mb-lg-6">
            @php
            $canceled=\App\Model\Order::where(['order_status'=>'canceled'])->whereBetween('created_at', [$from, $to])->count()
            @endphp
            <!-- Card -->
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <!-- Media -->
                            <div class="media">
                                <i class="tio-flight-cancelled nav-icon"></i>

                                <div class="media-body">
                                    <h4 class="mb-1">{{\App\CentralLogics\translate('annulée')}}</h4>
                                    <span class="font-size-sm text-muted">
                                        <i class="tio-trending-up"></i> {{$canceled}}
                                    </span>
                                </div>
                            </div>
                            <!-- End Media -->
                        </div>

                        <div class="col-auto">
                            <!-- Circle -->
                            <div class="js-circle" data-hs-circles-options='{
                           "value": {{round(($canceled/$total)*100)}},
                           "maxValue": 100,
                           "duration": 2000,
                           "isViewportInit": true,
                           "colors": ["#e7eaf3", "gray"],
                           "radius": 25,
                           "width": 3,
                           "fgStrokeLinecap": "round",
                           "textFontSize": 14,
                           "additionalText": "%",
                           "textClass": "circle-custom-text",
                           "textColor": "gray"
                         }'></div>
                            <!-- End Circle -->
                        </div>
                    </div>
                    <!-- End Row -->
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
    <!-- End Stats -->
    <hr>
    <!-- Card -->
    <div class="card mb-3 mb-lg-5 border-bottom border-right border-left border-top">
        <!-- Header -->
        <div class="card-header">
            @php
            $x=1;
            $y=12;
            $total=\App\Model\Order::whereBetween('created_at', [date('Y-'.$x.'-01'), date('Y-'.$y.'-30')])->count()
            @endphp
            <h6 class="card-subtitle mb-0">{{\App\CentralLogics\translate('total')}} des {{\App\CentralLogics\translate('commandes')}} of {{date('Y')}}: <span class="h3 ml-sm-2">{{round($total)}}</span>
            </h6>

            <!-- Unfold -->
            <div class="hs-unfold">
                <a class="js-hs-unfold-invoker btn btn-white" href="{{route('admin.orders.list',['status'=>'all'])}}">
                    <i class="tio-shopping-cart-outlined mr-1"></i> {{\App\CentralLogics\translate('commandes')}}
                </a>
            </div>
            <!-- End Unfold -->
        </div>
        <!-- End Header -->

        @php
        $confirmed=[];
        for ($i=1;$i<=12;$i++) { $from=date('Y-'.$i.'-01'); $to=date('Y-'.$i.'-30'); $confirmed[$i]=\App\Model\Order::where(['order_status'=>'confirmed'])->whereBetween('created_at', [$from, $to])->count();
            }
            @endphp



            @php
            $fai=[];
            for ($i=1;$i<=12;$i++){ $from=date('Y-'.$i.'-01'); $to=date('Y-'.$i.'-30'); $fai[$i]=\App\Model\Order::where(['order_status'=>'pending'])->whereBetween('created_at', [$from, $to])->count();
                }
                @endphp

                @php
                $can=[];
                for ($i=1;$i<=12;$i++){ $from=date('Y-'.$i.'-01'); $to=date('Y-'.$i.'-30'); $can[$i]=\App\Model\Order::where(['order_status'=>'canceled'])->whereBetween('created_at', [$from, $to])->count();
                    }
                    @endphp

                    <!-- Body -->
                    <div class="card-body">
                        <!-- Bar Chart -->
                        <div class="chartjs-custom" style="height: 18rem;">
                            <canvas class="js-chart" data-hs-chartjs-options='{
                        "type": "line",
                        "data": {
                           "labels": ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                           "datasets": [{
                            "data": [{{$confirmed[1]}},{{$confirmed[2]}},{{$confirmed[3]}},{{$confirmed[4]}},{{$confirmed[5]}},{{$confirmed[6]}},{{$confirmed[7]}},{{$confirmed[8]}},{{$confirmed[9]}},{{$confirmed[10]}},{{$confirmed[11]}},{{$confirmed[12]}}],
                            "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                            "borderColor": "green",
                            "borderWidth": 3,
                            "pointRadius": 0,
                            "pointBorderColor": "#fff",
                            "pointBackgroundColor": "green",
                            "pointHoverRadius": 0,
                            "hoverBorderColor": "#fff",
                            "hoverBackgroundColor": "#377dff"
                          },
                        
                          {
                            "data": [{{$can[1]}},{{$can[2]}},{{$can[3]}},{{$can[4]}},{{$can[5]}},{{$can[6]}},{{$can[7]}},{{$can[8]}},{{$can[9]}},{{$can[10]}},{{$can[11]}},{{$can[12]}}],
                            "backgroundColor": ["rgba(0, 201, 219, 0)", "rgba(255, 255, 255, 0)"],
                            "borderColor": "gray",
                            "borderWidth": 2,
                            "pointRadius": 0,
                            "pointBorderColor": "#fff",
                            "pointBackgroundColor": "gray",
                            "pointHoverRadius": 0,
                            "hoverBorderColor": "#fff",
                            "hoverBackgroundColor": "#00c9db"
                          }]
                        },
                        "options": {
                          "gradientPosition": {"y1": 200},
                           "scales": {
                              "yAxes": [{
                                "gridLines": {
                                  "color": "#e7eaf3",
                                  "drawBorder": false,
                                  "zeroLineColor": "#e7eaf3"
                                },
                                "ticks": {
                                  "min": 0,
                                  "max": {{\App\CentralLogics\Helpers::max_orders()}},
                                  "stepSize": {{round(\App\CentralLogics\Helpers::max_orders()/4)}},
                                  "fontColor": "#97a4af",
                                  "fontFamily": "Open Sans, sans-serif",
                                  "padding": 10,
                                  "postfix": ""
                                }
                              }],
                              "xAxes": [{
                                "gridLines": {
                                  "display": false,
                                  "drawBorder": false
                                },
                                "ticks": {
                                  "fontSize": 12,
                                  "fontColor": "#97a4af",
                                  "fontFamily": "Open Sans, sans-serif",
                                  "padding": 5
                                }
                              }]
                          },
                          "tooltips": {
                            "prefix": "",
                            "postfix": "",
                            "hasIndicator": true,
                            "mode": "index",
                            "intersect": false,
                            "lineMode": true,
                            "lineWithLineColor": "rgba(19, 33, 68, 0.075)"
                          },
                          "hover": {
                            "mode": "nearest",
                            "intersect": true
                          }
                        }
                      }'>
                            </canvas>
                        </div>
                        <!-- End Bar Chart -->
                    </div>
                    <!-- End Body -->
    </div>
    <!-- End Card -->

    <div class="row">
        <div class="col-lg-12 mb-3 mb-lg-12">
            <!-- Card -->
            <div class="card h-100">
                <!-- Header -->
                <div class="card-header">
                    <h4 class="card-header-title">{{\App\CentralLogics\translate('rapport')}} {{\App\CentralLogics\translate('hebdomadaire ')}}</h4>

                    <!-- Nav -->
                    <ul class="nav nav-segment" id="eventsTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="this-week-tab" data-toggle="tab" href="#this-week" role="tab">
                                {{\App\CentralLogics\translate('cette')}} {{\App\CentralLogics\translate('semaine')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="last-week-tab" data-toggle="tab" href="#last-week" role="tab">
                                {{\App\CentralLogics\translate('semaine')}} {{\App\CentralLogics\translate('derniere')}}
                            </a>
                        </li>
                    </ul>
                    <!-- End Nav -->
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="card-body card-body-height">
                    @php
                    $orders= \App\Model\Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->get();
                    @endphp
                    <!-- Tab Content -->
                    <div class="tab-content" id="eventsTabContent">
                        <div class="tab-pane fade show active" id="this-week" role="tabpanel" aria-labelledby="this-week-tab">
                            <!-- Card -->
                            @foreach($orders as $order)
                            <a class="card card-border-left border-left-primary shadow-none rounded-0">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-sm mb-2 mb-sm-0">
                                            <h2 class="font-weight-normal mb-1">#{{$order['id']}} <small class="font-size-sm text-body text-uppercase">{{\App\CentralLogics\translate('id')}}</small>
                                            </h2>
                                            <h5 class="text-hover-primary mb-0"> {{\App\CentralLogics\translate('montant')}}
                                                : {{$order['order_amount']}} {{\App\CentralLogics\Helpers::currency_symbol()}}</h5>
                                            <small class="text-body">{{date('d M Y',strtotime($order['created_at']))}}</small>
                                        </div>

                                        <div class="col-sm-auto align-self-sm-end">
                                            <!-- Avatar Group -->
                                            <div class="">
                                                {{\App\CentralLogics\translate('status')}} <strong> : {{$order['order_status']}} <br></strong>
                                            </div>
                                            <!-- End Avatar Group -->
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                            <hr>
                            @endforeach
                        </div>

                        @php
                        $orders= \App\Model\Order::whereBetween('created_at', [now()->subDays(7)->startOfWeek(), now()->subDays(7)->endOfWeek()])->get();
                        @endphp

                        <div class="tab-pane fade" id="last-week" role="tabpanel" aria-labelledby="last-week-tab">
                            @foreach($orders as $order)
                            <a class="card card-border-left border-left-primary shadow-none rounded-0">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-sm mb-2 mb-sm-0">
                                            <h2 class="font-weight-normal mb-1">#{{$order['id']}} <small class="font-size-sm text-body text-uppercase">{{\App\CentralLogics\translate('id')}}</small>
                                            </h2>
                                            <h5 class="text-hover-primary mb-0">{{\App\CentralLogics\translate('montant')}}
                                                : {{$order['order_amount']}} {{\App\CentralLogics\Helpers::currency_symbol()}}</h5>
                                            <small class="text-body">{{date('d M Y',strtotime($order['created_at']))}}</small>
                                        </div>

                                        <div class="col-sm-auto align-self-sm-end">
                                            <!-- Avatar Group -->
                                            <div class="">
                                                {{\App\CentralLogics\translate('status')}} <strong> : {{$order['order_status']}} <br></strong>
                                            </div>
                                            <!-- End Avatar Group -->
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                            <hr>
                            @endforeach
                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- End Body -->
            </div>
            <!-- End Card -->
        </div>
    </div>
    <!-- End Row -->
</div>
@endsection

@push('script')

@endpush

@push('script_2')

<script src="{{asset('assets/admin')}}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{asset('assets/admin')}}/vendor/chartjs-chart-matrix/dist/chartjs-chart-matrix.min.js"></script>
<script src="{{asset('assets/admin')}}/js/hs.chartjs-matrix.js"></script>

<script>
    $(document).on('ready', function() {

        // INITIALIZATION OF FLATPICKR
        // =======================================================
        $('.js-flatpickr').each(function() {
            $.HSCore.components.HSFlatpickr.init($(this));
        });


        // INITIALIZATION OF NAV SCROLLER
        // =======================================================
        $('.js-nav-scroller').each(function() {
            new HsNavScroller($(this)).init()
        });


        // INITIALIZATION OF DATERANGEPICKER
        // =======================================================
        $('.js-daterangepicker').daterangepicker();

        $('.js-daterangepicker-times').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });

        var start = moment();
        var end = moment();

        function cb(start, end) {
            $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format('MMM D') + ' - ' + end.format('MMM D, YYYY'));
        }

        $('#js-daterangepicker-predefined').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);


        // INITIALIZATION OF CHARTJS
        // =======================================================
        $('.js-chart').each(function() {
            $.HSCore.components.HSChartJS.init($(this));
        });

        var updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));

        // Call when tab is clicked
        $('[data-toggle="chart"]').click(function(e) {
            let keyDataset = $(e.currentTarget).attr('data-datasets')

            // Update datasets for chart
            updatingChart.data.datasets.forEach(function(dataset, key) {
                dataset.data = updatingChartDatasets[keyDataset][key];
            });
            updatingChart.update();
        })


        // INITIALIZATION OF MATRIX CHARTJS WITH CHARTJS MATRIX PLUGIN
        // =======================================================
        function generateHoursData() {
            var data = [];
            var dt = moment().subtract(365, 'days').startOf('day');
            var end = moment().startOf('day');
            while (dt <= end) {
                data.push({
                    x: dt.format('YYYY-MM-DD'),
                    y: dt.format('e'),
                    d: dt.format('YYYY-MM-DD'),
                    v: Math.random() * 24
                });
                dt = dt.add(1, 'day');
            }
            return data;
        }

        $.HSCore.components.HSChartMatrixJS.init($('.js-chart-matrix'), {
            data: {
                datasets: [{
                    label: 'Commits',
                    data: generateHoursData(),
                    width: function(ctx) {
                        var a = ctx.chart.chartArea;
                        return (a.right - a.left) / 70;
                    },
                    height: function(ctx) {
                        var a = ctx.chart.chartArea;
                        return (a.bottom - a.top) / 10;
                    }
                }]
            },
            options: {
                tooltips: {
                    callbacks: {
                        title: function() {
                            return '';
                        },
                        label: function(item, data) {
                            var v = data.datasets[item.datasetIndex].data[item.index];

                            if (v.v.toFixed() > 0) {
                                return '<span class="font-weight-bold">' + v.v.toFixed() + ' hours</span> on ' + v.d;
                            } else {
                                return '<span class="font-weight-bold">No time</span> on ' + v.d;
                            }
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        position: 'bottom',
                        type: 'time',
                        offset: true,
                        time: {
                            unit: 'week',
                            round: 'week',
                            displayFormats: {
                                week: 'MMM'
                            }
                        },
                        ticks: {
                            "labelOffset": 20,
                            "maxRotation": 0,
                            "minRotation": 0,
                            "fontSize": 12,
                            "fontColor": "rgba(22, 52, 90, 0.5)",
                            "maxTicksLimit": 12,
                        },
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        type: 'time',
                        offset: true,
                        time: {
                            unit: 'day',
                            parser: 'e',
                            displayFormats: {
                                day: 'ddd'
                            }
                        },
                        ticks: {
                            "fontSize": 12,
                            "fontColor": "rgba(22, 52, 90, 0.5)",
                            "maxTicksLimit": 2,
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }
        });


        // INITIALIZATION OF CLIPBOARD
        // =======================================================
        $('.js-clipboard').each(function() {
            var clipboard = $.HSCore.components.HSClipboard.init(this);
        });


        // INITIALIZATION OF CIRCLES
        // =======================================================
        $('.js-circle').each(function() {
            var circle = $.HSCore.components.HSCircles.init($(this));
        });
    });
</script>

<script>
    $('#from_date,#to_date').change(function() {
        let fr = $('#from_date').val();
        let to = $('#to_date').val();
        if (fr != '' && to != '') {
            if (fr > to) {
                $('#from_date').val('');
                $('#to_date').val('');
                toastr.error('Invalid date range!', Error, {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
        }

    })
</script>
@endpush