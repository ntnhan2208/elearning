<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>ADMINISTRATOR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="ADMINISTRATOR" name="description" />
    <meta content="ADMINISTRATOR" name="author" />
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{asset('admin/assets/images/heart.png')}}">
</head>
<body class="account-body accountbg">
<!-- Log In page -->
<div class="row vh-100 ">
    <div class="col-12 align-self-center">
        <div class="auth-page">
            <div class="card auth-card shadow-lg">
                <div class="card-body">
                    <div class="px-3">
                        <div class="text-center auth-logo-text">
                            <img src="{{ asset('admin/assets/images/logo.png') }}" style="max-height: 70px">
                            <p>Vui lòng nhập vào 6 số google</p>
                        </div>
                        @if (count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <span >{{ $error}}</span><br/>
                                @endforeach
                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('2fa') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus>
                                </div>
                            </div>
                            <div class="form-group mb-0 row">
                                <div class="col-12 mt-2">
                                    <button class="btn btn-primary btn-round btn-block waves-effect waves-light"
                                            type="submit">{{ trans('site.login') }}<i class="fas fa-sign-in-alt
                                            ml-1"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
</body>
</html>
