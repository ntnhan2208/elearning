<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>E-Learning</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Admin" name="description" />
        <meta content="Phoenix CMS" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('admin/assets/images/logo.png')}}">
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{asset('admin/assets/plugins/morris/morris.css')}}">
        <!-- App css -->
        <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/metisMenu.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/style.css?v='.$time)}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/tag-input.css')}}" rel="stylesheet" type="text/css" />
        <!-- DataTables -->
        <link href="{{ asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('admin/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets/plugins/ticker/jquery.jConveyorTicker.css') }}" rel="stylesheet" type="text/css" />
        @toastr_css
        <script>var baseURL = '<?php echo e(asset('/')); ?>'</script>
        @yield('stylesheet')
    </head>
<?php
header("Access-Control-Allow-Origin: *");
?>
