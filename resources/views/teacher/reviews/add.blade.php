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
                <button type="button" class="btn btn-dark waves-effect waves-light mt-1" data-toggle="modal"
                        data-animation="bounce" data-target=".bs-example-modal-lg">{{ trans('site.add') }}</button>
            </div>
        </div>
    </div>
    <div class="row mr-auto">
        <div class="col-12">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    <table id="tech-companies-1" class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th data-priority="1" class="text-center"></th>
                            <th data-priority="1">Câu hỏi</th>
                            <th data-priority="1">Câu trả lời</th>
                            <th data-priority="1">Đáp án đúng</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $review->question }}</td>
                                <td>
                                    @foreach(json_decode($review->answer,JSON_FORCE_OBJECT) as $key => $answer)
                                        <p>{{config('system.answer.'.(string)($key+1))}} - {{ $answer }}</p>
                                    @endforeach
                                </td>
                                <td>
                                    <p>{{config('system.answer.'.(string)$review->correct_answer)}}</p>
                                </td>
                                <td class="text-right">
                                    <form class="float-right" action=""
                                          method="POST" onSubmit="if(!confirm('Bạn chắc chắn muốn xoá Giáo viên?'))
												  {return false;}">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fas
												fa-trash"></i></button>
                                    </form>
                                    <div class="float-right">
                                        <a class="btn btn-xs btn-primary mr-3"
                                           href="{{route('reviews.edit',$review->id)}}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Thêm câu hỏi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reviews.store')}}" method="POST"
                          enctype="multipart/form-data" class="form-horizontal well">
                        @csrf
                        <fieldset>
                            <div class="repeater-default">
                                <div data-repeater-list="question_answer">
                                    <div class="form-group">
                                        <label>Câu hỏi</label>
                                        <div class="input-group">
                                            <textarea type="text" id="example-input1-group1" name="question"
                                                      class="form-control"></textarea>
                                        </div>
                                        <input type="text" value="{{$id}}" name="lesson_id" hidden readonly>
                                    </div>
                                    <div data-repeater-item>
                                        <div class="form-group row d-flex align-items-end">
                                            <div class="col-sm-8">
                                                <label class="control-label">Câu trả lời</label>
                                                <input type="text" name="answer"
                                                       class="form-control">
                                            </div>

                                            <div class="col-sm-2">
                                                <input type="checkbox" name="correct_answer" value="1">
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
                                </div>
                                <div class="form-group mb-0 row">
                                    <div class="col-sm-12">
                                                        <span data-repeater-create="" class="btn btn-secondary">
                                                            <span class="fas fa-plus"></span>
                                                        </span>
                                        <input type="submit" value="Tạo câu hỏi" class="btn btn-primary">
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

