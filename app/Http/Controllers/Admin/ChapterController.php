<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ChapterRequest;
use App\Models\Subject;
use App\Models\Teacher;
use Auth;
use App\Models\Chapter;
use Illuminate\Http\Request;
use DB;

class ChapterController extends BaseAdminController
{

    protected $chapter;
    protected $teacher;
    protected $subject;

    public function __construct(Chapter $chapter, Teacher $teacher, Subject $subject)
    {
        $this->chapter = $chapter;
        $this->teacher = $teacher;
        $this->subject = $subject;
        parent::__construct();
    }

    public function index()
    {
        $chapters = $this->chapter->OfTeacher()->get();
        return view('teacher.chapters.index', compact('chapters'));
    }


    public function create()
    {
        $subjects = $this->subject->OfTeacher()->get();
        return view('teacher.chapters.add', compact('subjects'));
    }


    public function store(ChapterRequest $request, Chapter $chapter)
    {
        DB::beginTransaction();
        try {
            $this->syncChapterRequest($request, $chapter);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('chapters.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }


    public function edit($id)
    {
        $chapter = $this->chapter->find($id);
        if ($chapter){
            $subjects = $this->subject->OfTeacher()->get();
            return view('teacher.chapters.edit', compact('chapter','subjects'));
        }
        toastr()->error(trans('site.message.error'));
        return redirect()->route('chapters.index');
    }


    public function update(ChapterRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $chapter = $this->chapter->findOrFail($id);
            $this->syncChapterRequest($request, $chapter);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('chapters.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function destroy(Chapter $chapter)
    {

    }

    public function syncChapterRequest($request, Chapter $chapter)
    {
        $chapter->chapter_name = $request->chapter_name;
        $chapter->teacher_id = $this->teacher->where('account_id', Auth::user()->id)->first()->id;
        $chapter->subject_id = $request->subject_id;
        $chapter->save();
    }
}
