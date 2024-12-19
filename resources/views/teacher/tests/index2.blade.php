@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý Câu hỏi bài kiểm tra</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa Câu hỏi bài kiểm tra</li>
                    </ol>
                </div>
                <h4 class="page-title">Danh sách Câu hỏi bài kiểm tra</h4>
                <div class="float-left mt-1 mb-2">
                    <a class="btn btn-primary" href="{{ route('create-test',$chapter) }}">Thêm/Sửa câu hỏi</a>
                </div>
            </div>
        </div>
    </div>
    @if($test)
        <div class="row mr-auto">
            <div class="col-12">
                <div class="card shaAdow-lg bg-white rounded">
                    <div class="card-body">
                        <table id="datatable" class="table table-custom table-striped dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th data-priority="1" class="text-center"></th>
                                <th data-priority="1">Câu hỏi</th>
{{--                                <th data-priority="1">Chương</th>--}}
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($test->reviews()->get() as $review)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $review->question }}</td>
{{--                                    <td>{{ $review->chapter->chapter_name }}</td>--}}
                                    <td class="text-right">
                                        <form class="float-right"
                                              action="{{route('detach-tests',[$test->id,$review->id])}}"
                                              method="POST" onSubmit="if(!confirm('Bạn chắc chắn muốn xoá?'))
												  {return false;}">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-xs btn-danger"><i class="fas
												fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

