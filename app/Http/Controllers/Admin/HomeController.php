<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseAdminController
{

    public function index()
    {
        if (\Auth::user()->role == 3){
            return redirect()->route('student-dashboard.index');
        }
        return view('admin.home');
    }

    public function changeLanguage($language){
        \Session::put('website_language', $language);
        return redirect()->back();
    }
}
