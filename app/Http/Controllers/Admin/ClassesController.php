<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;
use DB;
use Auth;

class ClassesController extends BaseAdminController
{
    protected $class;
    protected $teacher;

    public function __construct(Classes $class, Teacher $teacher)
    {
        $this->class = $class;
        $this->teacher = $teacher;
        parent::__construct();
    }

    public function index()
    {
        if (Auth::user()->role == 1) {
            $classes = $this->class->get();
            return view('admin.classes.index', compact('classes'));
        } elseif (Auth::user()->role == 2) {
            $teacher = $this->teacher->where('account_id', Auth::user()->id)->first();
            $class = $teacher->class;
            if($class){
                $students = $class->students()->get();
                return view('admin.classes.teacher_index', compact('class', 'students'));
            }
            toastr()->error('Hiện giáo viên chưa được phân công lớp!');
            return back();
        }
    }

    public function create()
    {
        $teachers = $this->teacher->whereNotIn('id', $this->class->get()->pluck('teacher_id')->toArray())->get();
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
            $teachers = $this->teacher->whereNotIn('id', $this->class->where('id', '!=', $id)->get()->pluck('teacher_id')->toArray())->get();
            return view('admin.classes.edit', compact('class', 'teachers'));
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
}
