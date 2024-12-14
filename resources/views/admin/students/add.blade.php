@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý Học sinh</a></li>
                        <li class="breadcrumb-item active">Thêm Học sinh</li>
                    </ol>
                </div>
                <h4 class="page-title">Thêm Học sinh</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body shadow-lg bg-white rounded">
                    <form action="{{ route('students.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tên Học sinh</label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="name" class="form-control"
                                               placeholder="Tên Học sinh">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <div class="input-group">
                                        <select name="gender"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                            @foreach(config('system.gender') as $k => $v)
                                                <option value="{{ $k }}" >{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control"
                                               placeholder="Mật khẩu">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="email" class="form-control"
                                               placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.phone') }} </label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="phone"
                                               class="form-control integerInput"
                                               placeholder="Số điện thoại">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary px-4 mb-3 mt-2"><i class="mdi
                        mdi-plus-circle-outline mr-2"></i>Thêm mới</button>
                        <a href="{{ route('students.index') }}">
                            <button type="button" class="btn btn-danger ml-2
                    px-4 mb-3 mt-2"><i class="fas fa-window-close mr-2"></i>Huỷ bỏ</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

