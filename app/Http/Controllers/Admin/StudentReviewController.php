<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Auth;
use DB;

class StudentReviewController extends BaseAdminController
{
    public function __construct(Review $review, Chapter $chapter, Teacher $teacher, Student $student, Subject $subject, Lesson $lesson)
    {
        $this->review = $review;
        $this->chapter = $chapter;
        $this->teacher = $teacher;
        $this->student = $student;
        $this->subject = $subject;
        $this->lesson = $lesson;
        parent::__construct();
    }

    public function index()
    {
        $student = $this->student->where('account_id', Auth::id())->first();
        if ($student->class_id) {
            $subjects = $this->subject->where('teacher_id', $student->class->teacher_id)->get();
            return view('student.reviews.index-of-subject', compact('subjects'));
        }
        toastr()->error('Học sinh chưa được xếp lớp!');
        return back();
    }

    public function indexOfChapter($subjectId)
    {
        $subject = $this->subject->find($subjectId);
        if ($subject) {
            $chapters = $subject->chapters()->get();
            return view('student.reviews.index-of-chapter', compact('chapters'));
        }
        toastr()->error(trans('site.message.error'));
        return back();
    }

    public function indexOfLesson($chapterId)
    {
        $chapter = $this->chapter->find($chapterId);
        if ($chapter) {
            $lessons = $chapter->lessons()->get();
            return view('student.reviews.index', compact('lessons'));

        }
        toastr()->error(trans('site.message.error'));
        return back();
    }

    public function store(Request $request)
    {
        $lessonId = $request->input('lesson_id');
        DB::beginTransaction();
        try {
            $student = $this->student->where('account_id', Auth::user()->id)->first();
            $reviews = $this->review->where('lesson_id', $lessonId)->get();

            foreach ($reviews as $review) {
                DB::table('review_student')
                    ->where('student_id', $student->id)
                    ->where('review_id', $review->id)
                    ->delete();
            }
            foreach ($request->all() as $key => $value) {
                if (str_starts_with($key, 'review')) {
                    $student->reviews()->attach(substr($key, 7), ['answer' => $value]);
                }
            }
            DB::commit();
            toastr()->success(trans('Đã hoàn thành bài ôn tập'));
            return redirect()->route('student-reviews.edit', $lessonId);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }


    }

    public function show($id)
    {
        $reviewQuestions = $this->review->where('lesson_id', $id)->inRandomOrder()->get();
        $lessonDescription = $this->lesson->find($id)->lesson_description;
        return view('student.reviews.show', compact('reviewQuestions', 'id', 'lessonDescription'));
    }

    public function edit($id)
    {
        $arrReviewAnswers = [];
        $reviewQuestions = $this->review->where('lesson_id', $id)->get();
        $arrReviewQuestions = array_flip($this->review->where('lesson_id', $id)->pluck('id')->toArray());// đảo key value
        $student = $this->student->where('account_id', Auth::user()->id)->first();
        $reviewAnswers = DB::table('review_student')->where('student_id', $student->id)
            ->whereIn('review_id',
                $this->review->where('lesson_id', $id)->pluck('id')->toArray())
            ->get(['review_id', 'answer']);
        if ($reviewAnswers->isNotEmpty()) {

            foreach ($reviewAnswers as $key => $value) {
                $arrReviewAnswers[$value->review_id] = $value->answer;
            }

            $correct = 0;
            foreach ($reviewQuestions as $review) {
                if ($arrReviewAnswers[$review->id] == $review->correct_answer) {
                    $correct++;
                }
            }
            return view('student.reviews.review-result', compact('reviewQuestions', 'arrReviewQuestions', 'arrReviewAnswers', 'student', 'correct'));

        }
        toastr()->error('Học sinh chưa làm bài ôn tập');
        return back();


    }

}
