@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý Câu hỏi ôn tập</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa Câu hỏi ôn tập</li>
                    </ol>
                </div>
                <h4 class="page-title">Danh sách Câu hỏi ôn tập</h4>
            </div>
        </div>
    </div>
    <div class="row mr-auto">
        <div class="col-12">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    <form action="{{route('student-reviews.store')}}" method="POST"
                          enctype="multipart/form-data" class="form-horizontal well">
                        @csrf
                        <input type="text" name="lesson_id" value="{{$id}}" hidden readonly>
                        @foreach($reviewQuestions as $review)
                            <div class="col-12 mt-2">
                                <h4 class="mt-0 header-title">{{ $loop->iteration }}. {{$review->question}}</h4>
                                @foreach(json_decode($review->answer,JSON_FORCE_OBJECT) as $key => $answer)
                                    <div class="radio">
                                        <input type="radio" name="review_{{$review->id}}" id="{{$review->id.$key}}"
                                               value="{{$key}}">
                                        <label for="{{$review->id.$key}}">
                                            {{$answer}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <button onclick="return test()" class="btn btn-primary mt-3">Hoàn thành</button>
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


