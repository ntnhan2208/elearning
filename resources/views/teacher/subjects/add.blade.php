@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý Môn học</a></li>
                        <li class="breadcrumb-item active">Thêm Môn học</li>
                    </ol>
                </div>
                <h4 class="page-title">Thêm Môn học</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-lg bg-white rounded">
                    <form action="{{ route('subjects.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tên Môn học</label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="subject_name"
                                               class="form-control"
                                               placeholder="Tên Môn học">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 mb-3 mt-2"><i class="mdi
                        mdi-plus-circle-outline mr-2"></i>Thêm mới
                        </button>
                        <a href="{{ route('subjects.index') }}">
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

