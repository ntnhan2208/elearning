<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use DB;
use Auth;

class SubjectController extends BaseAdminController
{
   protected $subject;
   protected $teacher;

    public function __construct(Subject $subject, Teacher $teacher)
    {
        $this->subject = $subject;
        $this->teacher = $teacher;
        parent::__construct();
    }

    public function index()
    {
        $subjects = $this->subject->OfTeacher()->get();
        return view('teacher.subjects.index', compact('subjects'));
    }


    public function create()
    {
        return view('teacher.subjects.add');
    }

    public function store(Request $request, Subject $subject)
    {
        DB::beginTransaction();
        try {
            $this->syncRequest($request, $subject);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('subjects.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }


    public function edit($id)
    {
        $subject = $this->subject->find($id);
        if ($subject){
            return view('teacher.subjects.edit', compact('subject'));
        }
        toastr()->error(trans('site.message.error'));
        return redirect()->route('subjects.index');
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $subject = $this->subject->findOrFail($id);
            $this->syncRequest($request, $subject);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('subjects.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function destroy(Subject $subject)
    {

    }

    public function syncRequest($request, Subject $subject)
    {
        $subject->subject_name = $request->subject_name;
        $subject->teacher_id = $this->teacher->where('account_id', Auth::user()->id)->first()->id;
        $subject->save();
    }
}
