<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Test;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Auth;
use DB;

class StudentTestController extends BaseAdminController
{
    public function __construct(Test $test, Chapter $chapter, Teacher $teacher, Student $student, Result $result, Subject $subject)
    {
        $this->test = $test;
        $this->chapter = $chapter;
        $this->teacher = $teacher;
        $this->student = $student;
        $this->subject = $subject;
        $this->result = $result;
        parent::__construct();
    }
    public function index()
    {

        $student = $this->student->where('account_id', Auth::id())->first();
        $subjects = $this->subject->where('teacher_id', $student->class->teacher_id)->get();
        return view('student.tests.index', compact('subjects'));
    }
    public function indexOfChapter($subjectId)
    {
        $subject = $this->subject->find($subjectId);
        if ($subject) {
            $chapters = $subject->chapters()->get();
            return view('student.tests.index-of-chapter', compact('chapters'));
        }
        toastr()->error(trans('site.message.error'));
        return back();
    }

    public function indexOfTest($id){
        $student = $this->student->where('account_id', Auth::id())->first();
        $test = $this->test->where('teacher_id', $student->class->teacher_id)->where('chapter_id',$id)->first();
        return view('student.tests.index-test', compact('test','student'));
    }


    public function store(Request $request, Result $result)
    {
        DB::beginTransaction();
        try {
            $arrayAnswers = [];
            $test = $this->test->find($request->testId);
            $countTotalQuestions = $test->reviews()->count();
            foreach ($request->all() as $key => $value) {
                if (str_starts_with($key, 'test_')) {
                    $arrayAnswers[substr($key, 5)] = $value;
                }
            }

            $questionsOfTest = $test->reviews()->get(['reviews.id','correct_answer']);
            $countCorrect = 0;
            foreach ($questionsOfTest as $question){
                if((int)$arrayAnswers[$question->id] == $question->correct_answer){
                    $countCorrect++;
                }
            }
            $mark = ($countCorrect/$countTotalQuestions)*10;

            $result->answer = json_encode($arrayAnswers, JSON_FORCE_OBJECT);
            $result->score = $mark;
            $result->teacher_id = $test->teacher_id;
            $result->student_id = $this->student->where('account_id', Auth::user()->id)->first()->id;
            $result->test_id = $test->id;

            $result->save();

            DB::commit();
            toastr()->success(trans('Đã hoàn thành bài ôn tập'));
            return redirect()->route('student-tests.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }


    public function show($id)
    {
        $test = $this->test->find($id);
        $reviewQuestions =  $test->reviews()->get();
        return view('student.tests.show', compact('test', 'reviewQuestions'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

}
