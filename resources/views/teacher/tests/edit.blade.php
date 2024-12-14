@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý bài kiểm tra</a></li>
                        <li class="breadcrumb-item active">Cập nhật bài kiểm tra</li>
                    </ol>
                </div>
                <h4 class="page-title">Cập nhật bài kiểm tra</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-lg bg-white rounded">
                    <form action="{{ route('tests.update', $test->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tên bài kiểm tra</label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="test_name"
                                               class="form-control"
                                               value="{{$test->test_name}}"
                                               placeholder="Tên Chương bài kiểm tra">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label>Danh sách câu hỏi có thể thêm vào bài kiểm tra</label>
                                <table id="tech-companies-1" class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th data-priority="1" class="text-center"></th>
                                        <th data-priority="1">Câu hỏi</th>
                                        <th data-priority="1">Chương</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($questionsOutTest as $review)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $review->question }}</td>
                                            <td>{{ $review->chapter->chapter_name }}</td>
                                            <td><input type="checkbox" name="review_id[]" value="{{$review->id}}"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 mb-3 mt-2"><i class="mdi
                        mdi-plus-circle-outline mr-2"></i>Cập nhật
                        </button>
                        <a href="{{ route('tests.index') }}">
                            <button type="button" class="btn btn-danger ml-2
                                px-4 mb-3 mt-2"><i class="fas fa-window-close mr-2"></i>Huỷ bỏ
                            </button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

