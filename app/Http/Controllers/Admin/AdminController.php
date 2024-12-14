<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Admin;
use DB;

class AdminController extends BaseAdminController
{
    protected $admins;

    public function __construct(Admin $admin)
    {
        $this->admins = $admin;
        parent::__construct();
    }

    public function index()
    {
        $admins = $this->admins->isTeacher()->get();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.add');
    }

    public function store(AdminRequest $request)
    {
        DB::beginTransaction();
        try {
            $admin = $this->admins->create($request->all());
            DB::commit();
            toastr()->success(trans('site.message.add_success'));
            return redirect()->route('admins.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function edit($id)
    {
        $admin = $this->admins->find($id);
        if ($admin) {
            return view('admin.admins.edit', compact('admin'));
        }
        toastr()->error(trans('site.message.error'));
        return redirect()->route('admins.index');
    }

    public function update(AdminRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $admin = $this->admins->findOrFail($id);
            $admin->update($request->all());
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('admins.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function destroy($id)
    {
        $admin = $this->admins->find($id);
        if ($this->admins->count() == 1) {
            toastr()->error(trans('site.admin.not_delete'));
            return redirect()->route('admins.index');
        } elseif ($admin->types()->exists() || $admin->rooms()->exists() || $admin->services()->exists() || $admin->employees()->exists()) {
            toastr()->error('Không thể xoá Admin');
            return redirect()->route('admins.index');
        } else {
            $this->admins->destroy($id);
            toastr()->success(trans('site.message.delete_success'));
            return redirect()->route('admins.index');
        };
    }

    public function changeProfile()
    {
        $admin = \Auth::User();
        return view('admin.admins.profile', compact('admin'));
    }

    public function changePassword()
    {
        return view('admin.admins.change-password');
    }

    public function updatePassword(PasswordRequest $request)
    {
        try {
            $currentPassword = \Auth::User()->password;
            if (\Hash::check($request->old_password, $currentPassword)) {
                \Auth::User()->update([
                    'password' => $request->new_password
                ]);
                toastr()->success(trans('site.message.update_success'));
                return redirect()->back();
            }
            toastr()->error(trans('site.message.wrong_password'));
            return back();
        } catch (\Exception $e) {
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }
}
