<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Admin;
use App\Models\Teacher;
use Illuminate\Http\Request;
use DB;
use Auth;

class TeacherController extends BaseAdminController
{
    protected $teacher;

    public function __construct(Admin $admin, Teacher $teacher)
    {
        $this->teacher = $teacher;
        $this->admin = $admin;
        parent::__construct();
    }

    public function index()
    {
        $teachers = $this->teacher->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.add');
    }

    public function store(TeacherRequest $request, Admin $admin, Teacher $teacher)
    {
        $this->syncTeacherRequest($request, $admin, $teacher);
        DB::beginTransaction();
        try {
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('teachers.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function edit($id)
    {
        $teacher = $this->teacher->find($id);
        if ($teacher) {
            return view('admin.teachers.edit', compact('teacher'));
        }
        toastr()->error(trans('site.message.error'));
        return redirect()->route('teachers.index');
    }


    public function update(TeacherRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $teacher = $this->teacher->findOrFail($id);
            $admin = $this->admin->findOrFail($teacher->account_id);
            $this->syncTeacherRequest($request, $admin, $teacher);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('teachers.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function destroy($id)
    {
        $teacher = $this->teacher->find($id);

        if ($teacher->class || $teacher->chapters) {
            toastr()->error('Giáo viên không thể xoá');
            return redirect()->route('teachers.index');
        } else {
            $admin = $this->admin->findOrFail($teacher->account_id);
            $this->teacher->destroy($id);
            $this->admin->destroy($admin->id);
            toastr()->success(trans('site.message.delete_success'));
            return redirect()->route('teachers.index');
        };
    }
    public function syncTeacherRequest($request, Admin $admin, Teacher $teacher)
    {
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = $request->password;
        $admin->role = 2;
        $admin->save();
        $this->syncTeacherInfoRequest($request, $admin->id, $teacher);
    }

    public function syncTeacherInfoRequest($request, $accountId, Teacher $teacher)
    {
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone_number = $request->phone;
        $teacher->gender = $request->gender;
        $teacher->account_id = $accountId;
        $teacher->admin_id = Auth::user()->id;
        $teacher->save();
    }
}
