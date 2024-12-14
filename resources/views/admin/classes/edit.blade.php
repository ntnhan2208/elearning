@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý Lớp học</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa Lớp học</li>
                    </ol>
                </div>
                <h4 class="page-title">Chỉnh sửa Lớp học</h4>
            </div>
        </div>
    </div>
    <div class="row mr-auto">
        <div class="col-6">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    <form action="{{ route('classes.update',$class->id)}}" method="POST" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.name') }} </label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="class_name" class="form-control"
                                               value="{{$class->class_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label> Sỉ số </label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="quantity" class="form-control integerInput"
                                               value="{{$class->quantity}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Giáo viên chủ nhiệm</label>
                                    <div class="input-group">
                                        <select name="teacher_id"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="">Không phân công giáo viên</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" @if($teacher->id==$class->teacher_id))
                                                        selected @endif>{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary px-4 mb-3 mt-2"><i class="fas fa-save"></i>
                            {{trans('site.button_update') }} </button>
                        <a href="{{ route('classes.index') }}">
                            <button type="button" class="btn btn-danger ml-2
                    px-4 mb-3 mt-2"><i class="fas fa-window-close"></i> {{trans('site.reset') }} </button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection

