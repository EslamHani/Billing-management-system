@extends('layouts.master')

@section('title')
لوحة التحكم
@stop

@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
              <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
                <!-- row -->
                <div class="row row-sm">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-primary-gradient">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">TODAY ORDERS</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div class="">
                                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                {{ thousandsCurrencyFormat( \App\Models\Order::whereDay('created_at', Date('d'))->sum('total')) }}
                                            </h4>
                                            <p class="mb-0 tx-12 text-white op-7">
                                                {{ \App\Models\Order::whereDay('created_at', Date('d'))->count() }}
                                            </p>
                                        </div>
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">
                                                100%
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-danger-gradient">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">Total Orders</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div class="">
                                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                {{ thousandsCurrencyFormat( \App\Models\Order::whereYear('created_at', Date('Y'))->sum('total')) }}
                                            </h4>
                                            <p class="mb-0 tx-12 text-white op-7">
                                                {{ \App\Models\Order::whereYear('created_at', Date('Y'))->count() }}
                                            </p>
                                        </div>
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-down text-white"></i>
                                            <span class="text-white op-7">100%</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-success-gradient">
                           
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">Total Products</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div class="">
                                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                {{ thousandsCurrencyFormat(\App\Models\Product::sum('selling_price')) }}
                                            </h4>
                                            <p class="mb-0 tx-12 text-white op-7">
                                                {{ \App\Models\Product::count() }}
                                            </p>
                                        </div>
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7"> 100%</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-warning-gradient">
                           
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">PRODUCT SOLD</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div class="">
                                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                {{ thousandsCurrencyFormat(\App\Models\Product::where('stock', 0)->sum('selling_price')) }}
                                            </h4>
                                            <p class="mb-0 tx-12 text-white op-7">
                                                {{ \App\Models\Product::where('stock', 0)->count() }}
                                            </p>
                                        </div>
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-down text-white"></i>
                                            <span class="text-white op-7">
                                                 100%
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                        </div>
                    </div>
                </div>
                <!-- row closed -->

                <div class="row row-sm">
                    <div class="col-md-12 col-lg-12 col-xl-7">
                        <div class="card">
                            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-0">Orders Count</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart-container"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-5">
                        <div class="card">
                            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-0">Orders status</h4>
                                </div>
                            </div>
                            <div class="card-body">
                               <canvas id="myChart" width="400" height="340"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row row-sm">
                    <div class="col-md-12 col-lg-12 col-xl-7">
                        <div class="card">
                            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-0">Invoices Count</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="barchart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-5">
                        <div class="card">
                            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-0">Invoices Status</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart2" width="400" height="290"></canvas>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
        <!-- Container closed -->
@endsection
@section('js')
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>

<script>
    var newData = new Date();
    var year = newData.getFullYear();

    var datas = <?php echo json_encode($ordersHighChart); ?>

    Highcharts.chart('chart-container', {
        title:{
            text: "New Order Growth, " + year 
        },
        subtitle:{
            text: "Source: Jomla Shop"
        },
        xAxis:{
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis:{
            title:{
                text: 'Number Of New Order'
            }
        },
        legend:{
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions:{
            series:{
                allowPointSelect: true
            }
        },
        series:[{
            name: 'New Order',
            data: datas
        }],
        responsive:{
            rules:[{
                condition:{
                    maxWidth:500
                },
                chartOptions:{
                    legend:{
                        layout:'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>

<script>
    $(function(){
        var newData = new Date();
        var year = newData.getFullYear();
        var data = <?php echo json_encode($invoiceBarChart); ?>;
        var barcanvas = $('#barchart');
        var barchart = new Chart(barcanvas, {
            type: 'bar',
            data:{
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'New Invoice Growth, ' + year,
                        data: data,
                        backgroundColor: ['#DAF7A6', '#FFC300', '#FF5733', '#C70039', '#900C3F', '#581845', '#1B4F72', 'purple', '#0B5345', '#424949', '#7E5109', 'silver']
                    }
                ]
            },
            options:{
                scales:{
                    yAxes:[{
                        ticks:{
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
    // var ctx = document.getElementById("barchart");
    // ctx.height = 255;
</script>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var data = <?php echo json_encode($orderStatusPie); ?>;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Approved', 'Pendding', 'Refused'],
            datasets: [{
                label: '# of Votes',
                data: data,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        }
    });
</script>

<script>
    var ctx = document.getElementById('myChart2').getContext('2d');
    var data = <?php echo json_encode($invoiceStatusPie); ?>;
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['مدفوعة', 'غير مدفوعة'],
            datasets: [{
                label: '# of Votes',
                data: data,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        }
    });
</script>
@endsection