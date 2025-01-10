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
                    <form action="{{ route('reviews.update', $review->id)}}" method="POST"
                          enctype="multipart/form-data" class="form-horizontal well">
                        @method('PUT')
                        @csrf
                        <input type="text" value="{{$review->lesson_id}}" name="lesson_id" hidden readonly>
                        <fieldset>
                            <div class="repeater-default">
                                <div data-repeater-list="question_answer">
                                    <div class="form-group">
                                        <label>Câu hỏi</label>
                                        <div class="input-group">
                                            <textarea type="text" id="elm1" name="question"
                                                      class="form-control">{!! $review->question !!}</textarea>
                                        </div>
                                        <input type="text" value="{{$review->chapter_id}}" name="chapter_id" hidden readonly>
                                    </div>
                                    @foreach(json_decode($review->answer,JSON_FORCE_OBJECT) as $key => $answer)
                                        <div data-repeater-item>
                                            <div class="form-group row d-flex align-items-end">
                                                <div class="col-sm-8">
                                                    <label class="control-label">Câu trả lời</label>
                                                    <input type="text" name="answer"
                                                           class="form-control" value="{{$answer}}">
                                                </div>

                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="correct_answer" value="1" @if($review->correct_answer == $key) checked @endif>
                                                    <label>Đáp án đúng</label><br>
                                                </div>

                                                <div class="col-sm-2">
                                                                <span data-repeater-delete=""
                                                                      class="btn btn-danger btn-sm">
                                                                    <span class="far fa-trash-alt"></span> Xoá
                                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group mb-0 row">
                                    <div class="col-sm-12">
                                                        <span data-repeater-create="" class="btn btn-secondary">
                                                            <span class="fas fa-plus"></span>
                                                        </span>
                                        <input type="submit" value="Cập nhật" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

