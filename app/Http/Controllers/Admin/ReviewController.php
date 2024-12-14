<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use DB;
use Auth;

class ReviewController extends BaseAdminController
{
    protected $chapter;
    protected $review;

    public function __construct(Review $review, Chapter $chapter, Teacher $teacher, Subject $subject, Lesson $lesson)
    {
        $this->review = $review;
        $this->chapter = $chapter;
        $this->teacher = $teacher;
        $this->subject = $subject;
        $this->lesson = $lesson;
        parent::__construct();
    }

    public function index()
    {
        $subjects = $this->subject->OfTeacher()->get();
        return view('teacher.reviews.index', compact('subjects'));
    }

    public function indexOfChapter($subjectId)
    {
        $subject = $this->subject->OfTeacher()->find($subjectId);
        if ($subject) {
            $chapters = $subject->chapters()->OfTeacher()->get();
            return view('teacher.reviews.index-of-chapter', compact('chapters'));
        }
        toastr()->error(trans('site.message.error'));
        return back();
    }

    public function indexOfLesson($chapterId)
    {
        $chapter = $this->chapter->OfTeacher()->find($chapterId);
        if ($chapter) {
            $lessons = $chapter->lessons()->get();
            return view('teacher.reviews.index-of-lesson', compact('lessons'));

        }
        toastr()->error(trans('site.message.error'));
        return back();
    }


    public function store(Request $request, Review $review)
    {
        DB::beginTransaction();
        try {
            $this->syncRequest($request, $review);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }

    }


    public function show($id)
    {
        $reviews = $this->review->where('lesson_id', $id)->get();
        return view('teacher.reviews.add', compact('reviews', 'id'));
    }


    public function edit($id)
    {
        $review = $this->review->find($id);
        if ($review) {
            return view('teacher.reviews.edit', compact('review'));
        }
        toastr()->error(trans('site.message.error'));
        return redirect()->route('reviews.show', $review->chapter_id);
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $review = $this->review->find($id);
            $this->syncRequest($request, $review);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }


    public function destroy($id)
    {
        $review = $this->review->find($id);

        if ($review->tests->isNotEmpty() || $review->students->isNotEmpty()) {
            toastr()->error('Không thể xoá bài học');
            return back();
        } else {
            $this->review->destroy($id);
            toastr()->success(trans('site.message.delete_success'));
            return back();
        };
    }

    public function syncRequest($request, Review $review)
    {
        $arrayAnswers = [];
        $answers = $request->question_answer;

        foreach ($answers as $key => $value) {
            if (isset($value["correct_answer"])) {
                $correctAnswer = $key;
            }
            $arrayAnswers[$key] = $value["answer"];
        }


        $review->question = $request->question;
        $review->answer = json_encode($arrayAnswers, JSON_FORCE_OBJECT);
        $review->correct_answer = $correctAnswer;
        $review->lesson_id = $request->lesson_id;
        $review->teacher_id = $this->teacher->where('account_id', Auth::user()->id)->first()->id;
        $review->save();
    }
}
