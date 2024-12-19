<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use DB;
use Auth;

class ClassesController extends BaseAdminController
{
    protected $class;
    protected $teacher;

    public function __construct(Classes $class, Teacher $teacher, Student $student)
    {
        $this->class = $class;
        $this->teacher = $teacher;
        $this->student = $student;
        parent::__construct();
    }

    public function index()
    {
        if (Auth::user()->role == 1) {
            $classes = $this->class->get();
            return view('admin.classes.index', compact('classes'));
        } elseif (Auth::user()->role == 2) {
            $teacher = $this->teacher->where('account_id', Auth::user()->id)->first();
            $classes = $teacher->class()->get();
            if ($classes) {
                //$students = $class->students()->get();
                return view('admin.classes.index_of_teacher', compact('classes'));
            }
            toastr()->error('Hiện giáo viên chưa được phân công lớp!');
            return back();
        }
    }

    public function show($id)
    {
        $class = $this->class->find($id);
        if ($class) {
            $students = $class->students()->get();
            return view('admin.classes.students_of_class', compact('students', 'class'));
        }
    }

    public function create()
    {
//        $teachers = $this->teacher->whereNotIn('id', $this->class->get()->pluck('teacher_id')->toArray())->get();
        $teachers = $this->teacher->get();
        if (!$teachers) {
            toastr()->error('Vui lòng tạo giáo viên trước khi tạo lớp!');
            return redirect()->route('classes.index');
        }
        return view('admin.classes.add', compact('teachers'));
    }

    public function store(ClassRequest $request, Classes $class)
    {
        DB::beginTransaction();
        try {
            $this->syncClassRequest($request, $class);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('classes.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }


    public function edit($id)
    {
        $class = $this->class->find($id);
        if ($class) {
            $students = $this->student->whereNull('class_id')->orWhere('class_id', '')->get(['id', 'name']);
            $currentQuantity = $this->student->where('class_id',$class->id)->count();
            //$teachers = $this->teacher->whereNotIn('id', $this->class->where('id', '!=', $id)->get()->pluck('teacher_id')->toArray())->get();
            $teachers = $this->teacher->get();
            return view('admin.classes.edit', compact('class', 'teachers', 'students','currentQuantity'));
        }
        toastr()->error(trans('site.message.error'));
        return redirect()->route('teachers.index');
    }


    public function update(ClassRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $class = $this->class->findOrFail($id);
            $this->syncClassRequest($request, $class);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('classes.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function destroy($id)
    {
        $class = $this->class->find($id);
        if ($class->teacher || $class->students->isNotEmpty()) {
            toastr()->error('Không thể xoá lớp học');
            return redirect()->route('classes.index');
        } else {
            $this->class->destroy($id);
            toastr()->success(trans('site.message.delete_success'));
            return redirect()->route('classes.index');
        };
    }

    public function syncClassRequest($request, Classes $class)
    {
        $class->class_name = $request->class_name;
        $class->quantity = $request->quantity;
        $class->teacher_id = $request->teacher_id;
        $class->admin_id = Auth::user()->id;
        $class->save();
    }

    public function addStudents(Request $request, $classId)
    {
        DB::beginTransaction();
        try {
            $studentIds = $request->student_ids;
            foreach ($studentIds as $studentId) {
                $student = $this->student->find($studentId);
                $student->class_id = $classId;
                $student->save();
            }
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function deleteStudent(Request $request, $classId, $studentId)
    {
        DB::beginTransaction();
        try {
            $student = $this->student->where('id', $studentId)->where('class_id', $classId)->first();
            $student->class_id = null;
            $student->save();
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }
}
