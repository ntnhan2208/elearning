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
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            @if($student->result)
                            <p> Bạn đã làm bài kiểm tra. Điểm số: {{$student->result->score}}</p>
                            @else
                            <a class="btn btn-xs btn-success waves-effect waves-light mr-3"
                               href="{{ route('student-tests.show',$test->id)}}">
                                <i class="mdi mdi-check-all"> Vào làm bài kiểm tra</i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
