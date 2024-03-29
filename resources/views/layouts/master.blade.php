<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('icons/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('icons/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('icons/favicon-16x16.png')}}">
  <title>My Manager | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Theme style -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{asset('css/adminlte.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('layouts.menu')
@yield('content')
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2022-{{date('Y')}} <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
@yield('modals')


<!-- jQuery -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $("select[name=type]").change(function(){
        if($(this).val() ==0){
            $(".bankDiv").hide();
        }
    });

    $(".hoverMe").click(function(){
        var liability = JSON.parse($(this).attr('liability'));
        $('.hoverBody h4:first-child').html('Liability: '+liability.title);
        $('.hoverBody h4:nth-child(2)').html('Balance: '+$(this).attr('balance'));
        $('.hoverBody h4:nth-child(3)').html('Total Paid: '+$(this).attr('payments'));
        $('.hoverBody h4:nth-child(4)').html('Balance EMI : '+($(this).attr('balance')/liability.emi).toFixed(2));
        $('.hoverBody').show();
    });

    $(".hovermeClose").click(function(){
        $('.hoverBody').hide();
    });

    $( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd'
    });
</script>
</body>
</html>
