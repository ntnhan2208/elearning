<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Learning</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Phoenix CMS - ADMINISTRATOR" name="description" />
        <meta content="Phoenix CMS - ADMINISTRATOR" name="author" />
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
                                    <h4 class="mt-0 mb-3 mt-3">Trang quản trị</h4>
                                    <p class="text-muted mb-0">Đăng nhập để sử dụng hệ thống</p>
                                </div>
                                @if (count($errors)>0)
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <span >{{ $error}}</span><br/>
                                        @endforeach
                                    </div>
                                @endif
                                <form class="form-horizontal auth-form my-4" method="POST"  action="{{ route('admin.login.submit') }}"
                                      method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="name" name="email" value="{{ old('email') }}"
                                                   placeholder="Email đăng nhập">
                                        </div>
                                    </div><!--end form-group-->
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" name="password"
                                                   placeholder="Mật khẩu">
                                        </div>
                                    </div><!--end form-group-->
                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-primary btn-round btn-block waves-effect
                                            waves-light" type="submit">Đăng nhập <i class="fas fa-sign-in-alt
                                            ml-1"></i></button>
                                        </div><!--end col-->
                                    </div> <!--end form-group-->
                                </form><!--end form-->
                            </div><!--end /div-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end auth1-page-->
            </div><!--end col-->
        </div><!--end row-->
        <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
    </body>
</html>



