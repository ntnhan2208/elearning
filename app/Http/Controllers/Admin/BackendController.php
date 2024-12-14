<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use View;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Language;
use App;

class BackendController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $adminLangs = Language::active()->get();
        $locale = App::getLocale();
        View::share(['adminLangs' => $adminLangs, 'locale' => $locale]);
    }

    public function index()
    {
        return view('admin.pages.dashboard');
    }
}