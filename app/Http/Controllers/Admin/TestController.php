<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Test;
use Illuminate\Http\Request;
use Auth;
use DB;

class TestController extends BaseAdminController
{
    protected $test;
    protected $review;

    public function __construct(Test $test, Review $review, Teacher $teacher, Subject $subject, Chapter $chapter, Lesson $lesson)
    {
        $this->test = $test;
        $this->review = $review;
        $this->teacher = $teacher;
        $this->subject = $subject;
        $this->chapter = $chapter;
        $this->lesson = $lesson;
        parent::__construct();
    }

    public function index()
    {
        $subjects = $this->subject->OfTeacher()->get();
        return view('teacher.tests.index', compact('subjects'));
    }

    public function indexOfSubject($subjectId)
    {

        $subject = $this->subject->OfTeacher()->find($subjectId);
        if ($subject) {
            $chapters = $subject->chapters()->get();
            return view('teacher.tests.index-of-chapter', compact('chapters'));
        }
        toastr()->error(trans('site.message.error'));
        return back();

    }

    public function indexOfChapter($chapterId)
    {
        //dd($chapterId);
        $chapter = (int)$chapterId;
        $test = $this->test->OfTeacher()->where('chapter_id', $chapter)->first();
        return view('teacher.tests.index2', compact('test', 'chapter'));
    }


//    public function create()
//    {
//        $test = $this->test->first();
//        if ($test) {
//            $questionsInTest = $test->reviews()->get();
//            $questionsOutTest = $this->review->whereNotIn('id', $questionsInTest->pluck('id')->toArray())->get();
//            return view('teacher.tests.edit', compact( 'questionsOutTest','test'));
//        }
//        return view('teacher.tests.add', compact( 'questionsOutTest'));
//
//    }

    public function createWithChapterId($chapterId)
    {
        $test = $this->test->where('chapter_id', $chapterId)->first();
        if ($test) {
            $questionsInTest = $test->reviews()->get();
            $questionsOutTest = $this->review->whereNotIn('id', $questionsInTest->pluck('id')->toArray())->whereIn('lesson_id', $this->lesson->where('chapter_id', $chapterId)->pluck('id'))->get();
            return view('teacher.tests.edit', compact('questionsOutTest', 'test'));
        }

        $questionsOutTest = $this->review->whereIn('lesson_id', $this->lesson->where('chapter_id', $chapterId)->pluck('id'))->get();
        return view('teacher.tests.add', compact('questionsOutTest','chapterId'));
    }

    public function store(Request $request, Test $test, Teacher $teacher)
    {
        DB::beginTransaction();
        try {
            $this->syncTestRequest($request, $test, $teacher);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function update(Request $request, Test $test, Teacher $teacher)
    {
        DB::beginTransaction();
        try {
            $this->syncTestRequest($request, $test, $teacher);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function detachTests($testId, $reviewId)
    {
        $test = $this->test->find($testId);
        $test->reviews()->detach($reviewId);
        return back();
    }

    public function syncTestRequest($request, Test $test, Teacher $teacher)
    {
        $test->test_name = $request->test_name;
        $test->teacher_id = $this->teacher->where('account_id', Auth::user()->id)->first()->id;
        $test->chapter_id = $request->chapter_id;
        $test->save();
        if ($request->review_id) {
            foreach ($request->review_id as $key => $value) {
                $test->reviews()->attach($value);
            }
        }
    }
}
