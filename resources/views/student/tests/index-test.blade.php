@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Bài kiểm tra</h4>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-rep-plugin">
                        @if($test)
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                @if($student->result && $student->result->test_id == $test->id)
                                    <p> Bạn đã làm bài kiểm tra. Điểm số: {{$student->result->score}}</p>


                                @elseif($test->reviews->isNotEmpty())
                                    <a class="btn btn-xs btn-success waves-effect waves-light mr-3"
                                       href="{{ route('student-tests.show',$test->id)}}">
                                        <i class="mdi mdi-check-all"> Vào làm bài kiểm tra</i>
                                    </a>
                                @else
                                    <p> Chưa có bài kiểm tra</p>
                                @endif
                            </div>
                        @else
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <p> Chưa có bài kiểm tra</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection