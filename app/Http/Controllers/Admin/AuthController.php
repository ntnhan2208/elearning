<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class AuthController extends AdminController
{
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->forget('admin');
        return redirect()->guest(route( 'admin.login' ));
    }
}
