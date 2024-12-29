<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;
use App\Models\Chapter;
use App\Models\Classes;
use App\Models\Review;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use DB;
use Auth;
use Mpdf\Mpdf;

class ClassesController extends BaseAdminController
{
    protected $class;
    protected $teacher;

    public function __construct(Classes $class, Teacher $teacher, Student $student, Subject $subject, Chapter $chapter, Review $review)
    {
        $this->class = $class;
        $this->teacher = $teacher;
        $this->student = $student;
        $this->subject = $subject;
        $this->chapter = $chapter;
        $this->review = $review;
        parent::__construct();
    }

    public function index()
    {
        if (Auth::user()->role == 1) {
            $classes = $this->class->get();
            return view('admin.classes.index', compact('classes'));
        } elseif (Auth::user()->role == 2) {
            $teacher = $this->teacher->where('account_id', Auth::user()->id)->first();
            $classes = $teacher->class()->get();
            if ($classes) {
                return view('admin.classes.index_of_teacher', compact('classes'));
            }
            toastr()->error('Hiện giáo viên chưa được phân công lớp!');
            return back();
        }
    }

    public function show($id)
    {
        $class = $this->class->find($id);
        if ($class) {
            $students = $class->students()->get();
            return view('admin.classes.students_of_class', compact('students', 'class'));
        }
    }

    public function create()
    {
//        $teachers = $this->teacher->whereNotIn('id', $this->class->get()->pluck('teacher_id')->toArray())->get();
        $teachers = $this->teacher->get();
        if (!$teachers) {
            toastr()->error('Vui lòng tạo giáo viên trước khi tạo lớp!');
            return redirect()->route('classes.index');
        }
        return view('admin.classes.add', compact('teachers'));
    }

    public function store(ClassRequest $request, Classes $class)
    {
        DB::beginTransaction();
        try {
            $this->syncClassRequest($request, $class);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('classes.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }


    public function edit($id)
    {
        $class = $this->class->find($id);
        if ($class) {
            $students = $this->student->whereNull('class_id')->orWhere('class_id', '')->get(['id', 'name']);
            $currentQuantity = $this->student->where('class_id', $class->id)->count();
            $teachers = $this->teacher->get();
            return view('admin.classes.edit', compact('class', 'teachers', 'students', 'currentQuantity'));
        }
        toastr()->error(trans('site.message.error'));
        return redirect()->route('teachers.index');
    }


    public function update(ClassRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $class = $this->class->findOrFail($id);
            $this->syncClassRequest($request, $class);
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return redirect()->route('classes.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function destroy($id)
    {
        $class = $this->class->find($id);
        if ($class->teacher || $class->students->isNotEmpty()) {
            toastr()->error('Không thể xoá lớp học');
            return redirect()->route('classes.index');
        } else {
            $this->class->destroy($id);
            toastr()->success(trans('site.message.delete_success'));
            return redirect()->route('classes.index');
        };
    }

    public function syncClassRequest($request, Classes $class)
    {
        $class->class_name = $request->class_name;
        $class->quantity = $request->quantity;
        $class->teacher_id = $request->teacher_id;
        $class->admin_id = Auth::user()->id;
        $class->save();
    }

    public function addStudents(Request $request, $classId)
    {
        DB::beginTransaction();
        try {
            $studentIds = $request->student_ids;
            if ($studentIds) {
                foreach ($studentIds as $studentId) {
                    $student = $this->student->find($studentId);
                    $student->class_id = $classId;
                    $student->save();
                }
                DB::commit();
            }
            toastr()->success(trans('site.message.update_success'));
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function deleteStudent(Request $request, $classId, $studentId)
    {
        DB::beginTransaction();
        try {
            $student = $this->student->where('id', $studentId)->where('class_id', $classId)->first();
            $student->class_id = null;
            $student->save();
            DB::commit();
            toastr()->success(trans('site.message.update_success'));
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error(trans('site.message.error'));
            return back();
        }
    }

    public function export($id)
    {
        $class = $this->class->find($id);

        $students = $class->students()->get();
        $mpdf = new Mpdf([
            'default_font' => 'dejavu_sans'
        ]);

        $html = view('admin.classes.pdf', array('students' => $students, 'class' => $class))->render();

        $mpdf->WriteHTML($html);
        $mpdf->Output('document.pdf', 'D');

    }

    public function process($id)
    {
        $student = $this->student->find($id);
        $subjects = $this->subject->where('teacher_id', $student->class->teacher_id)->get();
        if ($subjects){
            return view('admin.classes.process.home', compact('subjects','student'));
        }
        return back();
    }

    public function showProcess($studentId,$subjectId)
    {

        $student = $this->student->find($studentId);
        $chapters = $this->chapter->where('subject_id', $subjectId)->get();
        $countQuestionsOfChapter = [];
        $reviews = [];
        $arrayCountCorrect = [];
        foreach ($chapters as $chapter) {
            $countQuestionsOfChapter[$chapter->chapter_name] = count($this->review->questionsOfType('chapter', $chapter->id));

            $questionOfChapter = $this->review->questionsOfType('chapter', $chapter->id);
            $reviews[] = DB::table('review_student')
                ->where('student_id', $this->student->find($studentId)->id)
                ->whereIn('review_id', $questionOfChapter)->count();

            $reviewsDetail = DB::table('review_student')
                ->where('student_id', $this->student->find($studentId)->id)
                ->whereIn('review_id', $questionOfChapter)->get();
            $countCorrect = 0;
            foreach ($reviewsDetail as $review) {
                if($this->review->find($review->review_id)->correct_answer == $review->answer){
                    $countCorrect++;
                }
            }
            $arrayCountCorrect[] = $countCorrect;


        }

        return view('admin.classes.process.dashboards.chapters-of-subject', compact('student','chapters', 'countQuestionsOfChapter', 'reviews', 'arrayCountCorrect'));

    }

    public function detailProcess($studentId,$chapterId)
    {
        $student = $this->student->find($studentId);
        $chapter = $this->chapter->findOrFail($chapterId);
        $lessons = $chapter->lessons()->get();
        $countQuestionsOfLesson = [];
        $percentOfLesson = [];

        foreach ($lessons as $lesson) {
            $countQuestionsOfLesson[$lesson->id] = count($this->review->questionsOfType('lesson', $lesson->id));
            $questionOfLesson = $this->review->questionsOfType('lesson', $lesson->id);
            $reviews = DB::table('review_student')->where('student_id', $this->student->find($studentId)->id)->whereIn('review_id', $questionOfLesson)->get();
            $countCorrect = 0;
            foreach ($reviews as $review) {
                if($this->review->find($review->review_id)->correct_answer == $review->answer){
                    $countCorrect++;
                }
            }
            $percentOfLesson[$lesson->id] = count($questionOfLesson) == 0 ? 0 :  round($countCorrect/count($questionOfLesson),2) * 100;
        }

        return view('admin.classes.process.dashboards.chapter-detail', compact('chapter', 'lessons','countQuestionsOfLesson','percentOfLesson','student'));
    }

}
