@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý Giáo viên</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa Giáo viên</li>
                    </ol>
                </div>
                <h4 class="page-title">Chỉnh sửa Giáo viên</h4>
            </div>
        </div>
    </div>
    <div class="row mr-auto ">
        <div class="col-12">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    <form action="{{ route('teachers.update',$teacher->id)}}" method="POST" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.name') }} </label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="name" class="form-control"
                                               value="{{$teacher->name}}">
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
                                                <option value="{{ $v }}" @if($teacher->gender==$v))
                                                        selected @endif>{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.email') }} </label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="email" class="form-control"
                                               value="{{$teacher->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.phone') }} </label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="phone"
                                               class="form-control integerInput"
                                               value="{{$teacher->phone_number}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary px-4 mb-3 mt-2"><i class="fas fa-save"></i>
                            {{trans('site.button_update') }} </button>
                        <a href="{{ route('admins.index') }}">
                            <button type="button" class="btn btn-danger ml-2
                    px-4 mb-3 mt-2"><i class="fas fa-window-close"></i> {{trans('site.reset') }} </button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

