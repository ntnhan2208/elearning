@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý Chương bài học</a></li>
                        <li class="breadcrumb-item active">Thêm Chương bài học</li>
                    </ol>
                </div>
                <h4 class="page-title">Thêm Chương bài học</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-lg bg-white rounded">
                    <form action="{{ route('lessons.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tên Chương bài học</label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="lesson_name"
                                               class="form-control"
                                               placeholder="Tên Chương bài học">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Môn học</label>
                                    <div class="input-group">
                                        <div class="input-group">
                                            <select name="chapter_id"
                                                    class="custom-select custom-select-sm form-control form-control-sm">
                                                @foreach($chapters as $value)
                                                    <option value="{{ $value->id }}" selected>{{ $value->chapter_name.' - '. $value->subject->subject_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Yêu cầu cần đạt</label>
                                    <div class="input-group">
                                        <textarea type="text" id="example-input1-group1" name="lesson_description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 mb-3 mt-2"><i class="mdi
                        mdi-plus-circle-outline mr-2"></i>Thêm mới
                        </button>
                        <a href="{{ route('lessons.index') }}">
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

