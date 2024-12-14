<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class LanguageController extends BaseAdminController
{
    const LIMIT = 1;
    protected $language;

    public function __construct(Language $language)
    {
        $this->language = $language;
        parent::__construct();
    }

    public function index()
    {
        $languages = $this->language->all();
        return view('admin.language.index',compact('languages'));
    }

    public function create()
    {
        return view('admin.language.add');
    }

    public function store(LanguageRequest $request)
    {
        DB::beginTransaction();
        try{
            $this->language->create($request->all());
            DB::commit();
            toastr()->success(trans('site.message.add_success'));
            return redirect()->route('language.index');
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function edit($id)
    {
        $language = $this->language->find($id);
        if($language){
            return view('admin.language.edit',compact('language'));
        }
        toastr()->error(trans('site.message.error'));
        return redirect()->route('language.index');
    }

    public function update(LanguageRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $language = $this->language->find($id);
            $language->update($request->all());
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('language.index');
        }catch(\Exception $e){
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function destroy($id)
    {
        if($this->language->count() == self::LIMIT){
            toastr()->error(trans('site.language.not_delete'));
            return redirect()->route('language.index');
        }else{
            $this->language->destroy($id);
            toastr()->success(trans('site.message.delete_success'));
            return redirect()->route('language.index');
        };
    }
}
