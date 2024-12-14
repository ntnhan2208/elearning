@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý Lớp học</a></li>
                        <li class="breadcrumb-item active">Thêm Lớp học</li>
                    </ol>
                </div>
                <h4 class="page-title">Thêm Lớp học</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-lg bg-white rounded">
                    <form action="{{ route('classes.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Tên lớp học</label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="class_name"
                                               class="form-control"
                                               placeholder="Tên lớp học">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Sỉ số tối đa</label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="quantity"
                                               class="form-control integerInput"
                                               placeholder="Sỉ số tối đa">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Giáo viên chủ nhiệm</label>
                                    <div class="input-group">
                                        <select name="teacher_id"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="">Không phân công giáo viên</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 mb-3 mt-2"><i class="mdi
                        mdi-plus-circle-outline mr-2"></i>Thêm mới
                        </button>
                        <a href="{{ route('classes.index') }}">
                            <button type="button" class="btn btn-danger ml-2
                    px-4 mb-3 mt-2"><i class="fas fa-window-close mr-2"></i>Huỷ bỏ</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

