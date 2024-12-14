<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Helpers\Utility\Sanitize;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Language;
use Carbon\Carbon;
use App;
use View;

class BaseAdminController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth:admin']);
        $adminLangs = Language::active()->get();
        $locale = App::getLocale();
        $time =  Carbon::now()->toDateTimeString();
        View::share(['adminLangs' => $adminLangs, 'locale' => $locale, 'time' => $time]);
    }
}
