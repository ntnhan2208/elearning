<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Teacher;
use App\Models\Test;
use Illuminate\Http\Request;
use Auth;
use DB;

class TestController extends BaseAdminController
{
    protected $test;
    protected $review;

    public function __construct(Test $test, Review $review, Teacher $teacher)
    {
        $this->test = $test;
        $this->review = $review;
        $this->teacher = $teacher;
        parent::__construct();
    }

    public function index()
    {
        $test=$this->test->OfTeacher()->first();
        return view('teacher.tests.index', compact('test'));
    }


    public function create()
    {
        $test = $this->test->first();
        if ($test) {
            $questionsInTest = $test->reviews()->get();
            $questionsOutTest = $this->review->whereNotIn('id', $questionsInTest->pluck('id')->toArray())->get();
            return view('teacher.tests.edit', compact( 'questionsOutTest','test'));
        }
        return view('teacher.tests.add', compact( 'questionsOutTest'));

    }

    public function store(Request $request, Test $test, Teacher $teacher)
    {
        DB::beginTransaction();
        try {
            $this->syncTestRequest($request, $test, $teacher);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('tests.index');
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
            return redirect()->route('tests.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function detachTests($testId,$reviewId)
    {
        $test = $this->test->find($testId);
        $test->reviews()->detach($reviewId);
    }

    public function syncTestRequest($request, Test $test, Teacher $teacher)
    {
        $test->test_name = $request->test_name;
        $test->teacher_id = $this->teacher->where('account_id', Auth::user()->id)->first()->id;
        $test->save();
        if($request->review_id){
            foreach ($request->review_id as $key => $value) {
                $test->reviews()->attach($value);
            }
        }
   }
}
