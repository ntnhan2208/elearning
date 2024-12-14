@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý Môn học</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa Môn học</li>
                    </ol>
                </div>
                <h4 class="page-title">Chỉnh sửa Môn học</h4>
            </div>
        </div>
    </div>
    <div class="row mr-auto ">
        <div class="col-12">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    <form action="{{ route('subjects.update',$subject->id)}}" method="POST" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.name') }} </label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="subject_name" class="form-control"
                                               value="{{$subject->subject_name}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary px-4 mb-3 mt-2"><i class="fas fa-save"></i>
                            {{trans('site.button_update') }} </button>
                        <a href="{{ route('subjects.index') }}">
                            <button type="button" class="btn btn-danger ml-2
                    px-4 mb-3 mt-2"><i class="fas fa-window-close"></i> {{trans('site.reset') }} </button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

