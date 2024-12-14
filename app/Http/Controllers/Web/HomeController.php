<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use DB;

class HomeController extends BaseFEController
{
    public function index(){
        return view('web.homepage');
    }
}
