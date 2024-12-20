<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Auth;
use DB;

class LessonController extends BaseAdminController
{
    protected $chapter;
    protected $teacher;
    protected $lesson;

    public function __construct(Chapter $chapter, Teacher $teacher, Lesson $lesson)
    {
        $this->chapter = $chapter;
        $this->teacher = $teacher;
        $this->lesson = $lesson;
        parent::__construct();
    }

    public function index()
    {
        $lessons = $this->lesson->OfTeacher()->get();
        return view('teacher.lessons.index', compact('lessons'));
    }


    public function create()
    {
        $chapters = $this->chapter->OfTeacher()->get();
        return view('teacher.lessons.add', compact('chapters'));
    }


    public function store(LessonRequest $request, Lesson $lesson)
    {
        DB::beginTransaction();
        try {
            $this->syncRequest($request, $lesson);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('lessons.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }


    public function edit($id)
    {
        $lesson = $this->lesson->find($id);
        if ($lesson){
            $chapters = $this->chapter->OfTeacher()->get();
            return view('teacher.lessons.edit', compact('lesson','chapters'));
        }
        toastr()->error(trans('site.message.error'));
        return redirect()->route('lessons.index');
    }


    public function update(LessonRequest $request, $id)
    {

        DB::beginTransaction();
        try {
            $lesson = $this->lesson->findOrFail($id);
            $this->syncRequest($request, $lesson);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('lessons.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function destroy($id)
    {
        $lesson = $this->lesson->find($id);

        if ($lesson->reviews->isNotEmpty()) {
            toastr()->error('Không thể xoá bài học');
            return redirect()->route('lessons.index');
        } else {
            $this->lesson->destroy($id);
            toastr()->success(trans('site.message.delete_success'));
            return redirect()->route('lessons.index');
        };
    }

    public function syncRequest($request, Lesson $lesson)
    {
        $lesson->lesson_name = $request->lesson_name;
        $lesson->teacher_id = $this->teacher->where('account_id', Auth::user()->id)->first()->id;
        $lesson->chapter_id = $request->chapter_id;
        $lesson->lesson_description = $request->lesson_description;
        $lesson->save();
    }
}
