@extends('admin.master')
@section('content')
    <h5>Quá trình của học sinh {{$student->name}}</h5>
    <h4 class="header-title mt-3">Tỉ lệ câu ôn tập đúng so với tổng số câu hỏi </h4>
    @foreach($lessons as $lesson)
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="header-title mt-0">{{$lesson->lesson_name}}</h4>
                <div class="progress m-4" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary"
                         id="bar_{{$lesson->id}}" role="progressbar"
                         style="width: {{$percentOfLesson[$lesson->id]}}%;"
                         aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                        {{$percentOfLesson[$lesson->id]}}%
                    </div>
                </div>
{{--                @if($percentOfLesson[$lesson->id] <50)--}}
{{--                    <div class="alert icon-custom-alert alert-outline-pink fade show m-4" role="alert">--}}
{{--                        <i class="mdi mdi-alert-outline alert-icon"></i>--}}
{{--                        <div class="alert-text">--}}
{{--                            <strong><h5>Bạn chỉ ôn tập đúng {{$percentOfLesson[$lesson->id]}}% số câu! Bạn cần ôn tập để:</h5></strong>--}}
{{--                            <p class="pt-1">{{$lesson->lesson_description}}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <a class="btn btn-xs btn-primary ml-4"--}}
{{--                       href="{{ route('student-reviews.show',$lesson->id) }}">--}}
{{--                        <i class="far fa-edit"> Vào câu hỏi ôn tập</i>--}}
{{--                    </a>--}}
{{--                @else--}}
{{--                    <div class="alert icon-custom-alert alert-outline-success alert-success-shadow m-4" role="alert">--}}
{{--                        <i class="mdi mdi-check-all alert-icon"></i>--}}
{{--                        <div class="alert-text">--}}
{{--                            <strong><h5>Bạn đã ôn tập đúng {{$percentOfLesson[$lesson->id]}}% số câu!</h5></strong>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
            </div>
        </div>
    @endforeach

@endsection
@section('script')

@endsection
