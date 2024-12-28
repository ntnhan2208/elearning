@extends('admin.master')
@section('content')
    <div class="row mt-3">
        @foreach($subjects as $subject)
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 align-self-center">
                                <div class="icon-info">
                                    <i class="mdi mdi-book-multiple"></i>
                                </div>
                            </div>
                            <div class="col-8 align-self-center text-center">
                                <div class="ml-2">
                                    <a href="{{route('student-dashboard.show', $subject->id)}}"><h3>{{$subject->subject_name}}</h3></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
