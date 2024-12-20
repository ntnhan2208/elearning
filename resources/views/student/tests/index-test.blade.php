@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Bài kiểm tra</h4>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-rep-plugin">
                        @if($test)
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            @if($student->result && $student->result->test_id == $test->id)
                                                <div class="alert alert-secondary border-0" role="alert">
                                                    <strong>Số câu đúng: {{$correct}}/{{$test->reviews()->count()}} -
                                                        Điểm: {{$student->result->score}}  </strong>
                                                </div>
                                            @else
                                                <div class="alert alert-info alert-dismissible" role="alert">

                                                    <strong>Bạn chưa làm bài kiểm tra</strong>
                                                </div>
                                            @endif
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div><!--end col-->
                            </div>  <!--end row-->
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                @if($student->result && $student->result->test_id == $test->id)
                                    @foreach($test->reviews()->get() as $review)
                                        <div class="col-12 mt-2">
                                            <h4 class="mt-0 header-title">{{ $loop->iteration }}
                                                . {{$review->question}}</h4>
                                            @foreach(json_decode($review->answer,JSON_FORCE_OBJECT) as $key => $answer)
                                                <div class="radio">
                                                    <input type="radio" name="review_{{$review->id}}"
                                                           id="{{$review->id.$key}}"
                                                           value="{{$key}}"
                                                           @if(array_key_exists($review->id, $arrReviewAnswers)
                                                            && $arrReviewAnswers[$review->id] == $key)checked @endif
                                                           disabled>
                                                    <label for="{{$review->id.$key}}">
                                                        {{$answer}}
                                                        @if(array_key_exists($review->id, $arrReviewAnswers)
                                                            && ($arrReviewAnswers[$review->id] == $key && $arrReviewAnswers[$review->id] == $review->correct_answer)
                                                            || ($arrReviewAnswers[$review->id] != $key && $review->correct_answer == $key ))
                                                            <i class="dripicons-checkmark" style="color:green"></i>
                                                        @elseif((array_key_exists($review->id, $arrReviewAnswers)
                                                            && ($arrReviewAnswers[$review->id] == $key && $arrReviewAnswers[$review->id] != $review->correct_answer)))
                                                            <i class="dripicons-cross" style="color:red"></i>
                                                        @endif
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                    @endforeach
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