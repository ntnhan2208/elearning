@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Kết quả Câu hỏi ôn tập (Số câu đúng: {{$correct}}/{{$reviewQuestions->count()}}
                    )</h4>
            </div>
        </div>
    </div>
    <div class="row mr-auto">
        <div class="col-12">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    @foreach($reviewQuestions as $review)
                        @if(array_key_exists($review->id, $arrReviewAnswers))
                            <div class="col-12 mt-2">
                                <h4 class="mt-0 header-title">{{ $loop->iteration }}. {!!$review->question !!}</h4>
                                @foreach(json_decode($review->answer,JSON_FORCE_OBJECT) as $key => $answer)
                                    <div class="radio">
                                        <input type="radio" name="review_{{$review->id}}" id="{{$review->id.$key}}"
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
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

