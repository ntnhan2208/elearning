@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <h4 class="page-title">Câu hỏi ôn tập</h4>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable" class="table table-custom table-striped dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th data-priority="1" class="text-center"></th>
                                    <th data-priority="1">Tên chương bài học</th>
                                    <th data-priority="1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lessons as $lesson)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $lesson->lesson_name }}</td>
                                        <td class="text-right">
                                            <div class="float-right">
                                                <a class="btn btn-xs btn-primary mr-3"
                                                   href="{{ route('student-reviews.show',$lesson->id) }}">
                                                    <i class="far fa-edit"> Vào câu hỏi ôn tập</i>
                                                </a>
                                            </div>
                                            <div class="float-right">
                                                <a class="btn btn-xs btn-success waves-effect waves-light mr-3"
                                                   href="{{ route('student-reviews.edit',$lesson->id)}}">
                                                    <i class="mdi mdi-check-all">Xem kết quả bài ôn tập gần nhất</i>
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
        </div>
    </div>
@endsection
