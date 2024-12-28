<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use DB;
use Auth;

class DashboardController extends BaseAdminController
{
    public function __construct(Subject $subject, Chapter $chapter, Review $review, Student $student, Lesson $lesson)
    {
        $this->subject = $subject;
        $this->chapter = $chapter;
        $this->review = $review;
        $this->student = $student;
        $this->lesson = $lesson;
        parent::__construct();
    }

    public function index()
    {
        $student = $this->student->where('account_id', Auth::id())->first();
        $subjects = $this->subject->where('teacher_id', $student->class->teacher_id)->get();
        return view('student.home', compact('subjects'));
    }
    public function show($id)
    {

        $chapters = $this->chapter->where('subject_id', $id)->get();
        $countQuestionsOfChapter = [];
        $reviews = [];
        $arrayCountCorrect = [];
        foreach ($chapters as $chapter) {
            $countQuestionsOfChapter[$chapter->chapter_name] = count($this->review->questionsOfType('chapter', $chapter->id));

                $questionOfChapter = $this->review->questionsOfType('chapter', $chapter->id);
                $reviews[] = DB::table('review_student')
                    ->where('student_id', $this->student->where('account_id', \Auth::user()->id)->first()->id)
                    ->whereIn('review_id', $questionOfChapter)->count();

                $reviewsDetail = DB::table('review_student')
                    ->where('student_id', $this->student->where('account_id', \Auth::user()->id)->first()->id)
                    ->whereIn('review_id', $questionOfChapter)->get();
                $countCorrect = 0;
                foreach ($reviewsDetail as $review) {
                    if($this->review->find($review->review_id)->correct_answer == $review->answer){
                        $countCorrect++;
                    }
                }
                $arrayCountCorrect[] = $countCorrect;


        }

        return view('student.dashboards.chapters-of-subject', compact('chapters', 'countQuestionsOfChapter', 'reviews', 'arrayCountCorrect'));

    }

    public function edit($id)
    {
        $chapter = $this->chapter->findOrFail($id);
        $lessons = $chapter->lessons()->get();
        $countQuestionsOfLesson = [];
        $percentOfLesson = [];

        foreach ($lessons as $lesson) {
            $countQuestionsOfLesson[$lesson->id] = count($this->review->questionsOfType('lesson', $lesson->id));
            $questionOfLesson = $this->review->questionsOfType('lesson', $lesson->id);
            $reviews = DB::table('review_student')->where('student_id', $this->student->where('account_id', \Auth::user()->id)->first()->id)->whereIn('review_id', $questionOfLesson)->get();
            $countCorrect = 0;
            foreach ($reviews as $review) {
                if($this->review->find($review->review_id)->correct_answer == $review->answer){
                    $countCorrect++;
                }
            }
            $percentOfLesson[$lesson->id] = count($questionOfLesson) == 0 ? 0 :  round($countCorrect/count($questionOfLesson),2) * 100;
        }

        return view('student.dashboards.chapter-detail', compact('chapter', 'lessons','countQuestionsOfLesson','percentOfLesson'));
    }

}
