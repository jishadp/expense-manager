<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dept Manager - JP</title>
    <!-- Google Font: Source Sans Pro -->
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/adminlte.css')}}">
  </head>
  <body class="sidebar-mini sidebar-collapse">
    <div class="wrapper">
      <!-- Main Sidebar Container --> @include('layouts.menu')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">

            <div class="row">
                <div class="m-t-10 col-md-2 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-success">
                      <i class="fa fa-money"></i>
                    </span>
                    <div class="info-box-content">
                      <span class="info-box-text">Capital</span>
                      <span class="info-box-number">{{''}}</span>
                      <span class="progress-description">&nbsp;</span>
                    </div>
                  </div>
                </div>

            </div>


            <div class="row">

            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('js/apexcharts.min.js')}}"></script>
    <script>
        dayChart();
        weekChart();
        monthChart();
        function dayChart(){
            $.ajax({
                url: $('#dayChart').attr('get-chart-url'),
                success: function(response) {
                  var optionsDay = {
                    colors: ["#008000", "#FF0000"],
                    series: [{
                      name: 'P & L',
                      type: 'column',
                      data: response.pnl
                    },{
                        name: 'MA',
                        type: 'line',
                        data: response.ma
                    }],
                    chart: {
                      height: 550,
                      width: '100%',
                      type: 'line',
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                        width: [0, 4],
                        curve: 'smooth'
                    },
                    xaxis: {
                      type: 'date',
                      categories: response.dates
                    },
                    plotOptions: {
                        bar: {
                          columnWidth: '80%'
                        }
                      },
                    tooltip: {
                      x: {
                        format: 'dd/MM/yy'
                      },
                    },
                  };
                  var chartDay = new ApexCharts(document.querySelector("#dayChart"), optionsDay);
                  chartDay.render().then(() => chartDay.ohYeahThisChartHasBeenRendered = true);

                }
              });
        }

        function weekChart(){
            $.ajax({
                url: $('#weekChart').attr('get-chart-url'),
                success: function(response) {
                  var optionsWeek = {
                    colors : ['#0002ff'],
                    series: [{
                      name: 'P & L',
                      data: response.pnl,

                    }],
                    chart: {
                      height: 550,
                      width: '100%',
                      type: 'area'
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      curve: 'smooth'
                    },
                    xaxis: {
                      type: 'date',
                      categories: response.dates
                    },
                    tooltip: {
                      x: {
                        format: 'dd/MM/yy'
                      },
                    },
                  };
                  var chartWeek = new ApexCharts(document.querySelector("#weekChart"), optionsWeek);
                  chartWeek.render().then(() => chartWeek.ohYeahThisChartHasBeenRendered = true);
                }
              });
        }

        function monthChart(){
            $.ajax({
                url: $('#monthChart').attr('get-chart-url'),
                success: function(response) {
                  var optionsMonth = {
                    colors: ["#000000"],
                    series: [{
                      name: 'P & L',
                      type: 'column',
                      data: response.pnl
                    }],
                    chart: {
                      height: 550,
                      width: '100%',
                      type: 'line',
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                        width: [0, 4],
                        curve: 'smooth'
                    },
                    xaxis: {
                      type: 'date',
                      categories: response.months
                    },
                    plotOptions: {
                        bar: {
                          columnWidth: '80%'
                        }
                      },
                    tooltip: {
                      x: {
                        format: 'dd/MM/yy'
                      },
                    },
                  };
                  var chartMonth = new ApexCharts(document.querySelector("#monthChart"), optionsMonth);
                  chartMonth.render().then(() => chartMonth.ohYeahThisChartHasBeenRendered = true);
                }
            });
        }

    </script>
</html>
