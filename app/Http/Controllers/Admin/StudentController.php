<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use DB;
use Auth;

class StudentController extends BaseAdminController
{
    protected $student;

    public function __construct(Admin $admin, Student $student)
    {
        $this->student = $student;
        $this->admin = $admin;
        parent::__construct();
    }

    public function index()
    {
        $students = $this->student->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.add');
    }

    public function store(StudentRequest $request, Admin $admin, Student $student)
    {
        DB::beginTransaction();
        try {
            $this->syncStudentRequest($request, $admin, $student);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function edit($id)
    {
        $student = $this->student->find($id);
        if ($student) {
            return view('admin.students.edit', compact('student'));
        }
        toastr()->error(trans('site.message.error'));
        return redirect()->route('students.index');
    }


    public function update(StudentRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $student = $this->student->findOrFail($id);
            $admin = $this->admin->findOrFail($student->account_id);
            $this->syncStudentRequest($request, $admin, $student);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function destroy($id)
    {
        $student = $this->student->find($id);

        if ($student->class) {
            toastr()->error('Học sinh đang trong lớp học, không thể xoá');
            return redirect()->route('students.index');
        } else {
        $admin = $this->admin->findOrFail($student->account_id);
        $this->student->destroy($id);
        $this->admin->destroy($admin->id);
        toastr()->success(trans('site.message.delete_success'));
        return redirect()->route('students.index');
        };
    }
    public function syncStudentRequest($request, Admin $admin, Student $student)
    {
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = $request->password;
        $admin->role = 3;
        $admin->save();
        $this->syncStudentInfoRequest($request, $admin->id, $student);
    }

    public function syncStudentInfoRequest($request, $accountId, Student $student)
    {
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone_number = $request->phone;
        $student->gender = $request->gender;
        $student->account_id = $accountId;
        $student->admin_id = Auth::user()->id;
        $student->save();
    }
}
