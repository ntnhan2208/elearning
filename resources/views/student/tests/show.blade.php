@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Bài kiểm tra</h4>
            </div>
        </div>
    </div>
    <div class="row mr-auto">
        <div class="col-12">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    <form action="{{route('student-tests.store')}}" method="POST"
                          enctype="multipart/form-data" class="form-horizontal well">
                        <input type="text" name="testId" value="{{$test->id}}" readonly hidden>
                        @csrf
                        @foreach($reviewQuestions as $review)
                            <div class="col-12 mt-2">
                                <h4 class="mt-0 header-title">{{ $loop->iteration }}. {!! $review->question !!}</h4>
                                @php
                                    $arrayAnswers = json_decode($review->answer,JSON_FORCE_OBJECT);
                                    $keysOfArrayAnswers= array_keys($arrayAnswers);

                                    shuffle($keysOfArrayAnswers); //random key

                                    $randomAnswers = [];
                                    foreach($keysOfArrayAnswers as $key){
                                        $randomAnswers[$key] = $arrayAnswers[$key]; // tạo mảng câu hỏi mới từ key random
                                    }
                                @endphp
                                @foreach($randomAnswers as $key => $answer)
                                    <div class="radio">
                                        <input type="radio" name="test_{{$review->id}}" id="{{$review->id.$key}}"
                                               value="{{$key}}">
                                        <label for="{{$review->id.$key}}">
                                            {{$answer}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <button class="btn btn-primary mt-3" onclick="return test()">Hoàn thành</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function test() {
        var countQuestion = "<?php echo $reviewQuestions->count(); ?>";
        var checked = document.querySelectorAll('input[type="radio"]:checked').length;

        if (countQuestion * 1 != checked * 1) {
            alert('Vui lòng chọn đáp án cho tất cả các câu hỏi!')
            return false
        }
        return true
    }
</script>

