<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Review;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Auth;
use DB;

class StudentReviewController extends BaseAdminController
{
    public function __construct(Review $review, Chapter $chapter, Teacher $teacher, Student $student)
    {
        $this->review = $review;
        $this->chapter = $chapter;
        $this->teacher = $teacher;
        $this->student = $student;
        parent::__construct();
    }

    public function index()
    {
        $chapters = $this->chapter->all();
        return view('student.reviews.index', compact('chapters'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $student = $this->student->where('account_id', Auth::user()->id)->first();
            $student->reviews()->detach(); // todo: detach cau hoi theo chuong
            foreach ($request->all() as $key => $value) {
                if (str_starts_with($key, 'review')) {
                    $student->reviews()->attach(substr($key, 7), ['answer' => $value]);
                }
            }
            DB::commit();
            toastr()->success(trans('Đã hoàn thành bài ôn tập'));
            return redirect()->route('student-reviews.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }


    }

    public function show($id)
    {
        $reviewQuestions = $this->review->where('chapter_id', $id)->get();
        return view('student.reviews.show', compact('reviewQuestions', 'id'));
    }

    public function edit($id)
    {
        $arrReviewAnswers = [];
        $reviewQuestions = $this->review->where('chapter_id', $id)->get();
        $arrReviewQuestions = array_flip($this->review->where('chapter_id', $id)->pluck('id')->toArray());// đảo key value
        $student = $this->student->where('account_id', Auth::user()->id)->first();
        $reviewAnswers = DB::table('review_student')->where('student_id', $student->id)
            ->whereIn('review_id',
                $this->review->where('chapter_id', $id)->pluck('id')->toArray())
            ->get(['review_id', 'answer']);
        foreach ($reviewAnswers as $key => $value) {
            $arrReviewAnswers[$value->review_id] = $value->answer;
        }
        return view('student.reviews.review-result', compact('reviewQuestions','arrReviewQuestions', 'arrReviewAnswers', 'student'));
    }

}
