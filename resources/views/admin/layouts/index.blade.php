<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dashboard - Bootstrap Admin Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<base href="{{ asset('') }}">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/sb-admin.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
@yield('stylesheet')
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">

@include('admin.includes.header')
<div class="content-wrapper">
  <div class="container-fluid">
    @include('admin.includes.session')
    @yield('page-title')
    @yield('toolbar')
    @yield('content')
  </div>
  @include('admin.includes.footer')
</div>

<!-- Le javascript
================================================== --> 
<!-- Bootstrap core JavaScript-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="js/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<!--<script src="js/Chart.js"></script>-->
<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>
<!-- Custom scripts for this page-->
<!--<script src="js/sb-admin-charts.min.js"></script>-->
<script src="js/main.js"></script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@yield('bottom-scripts')
</body>
</html>
