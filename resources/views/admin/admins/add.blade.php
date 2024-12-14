@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-body shadow-lg bg-white rounded">
                    <form action="{{ route('admins.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.name') }} </label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="name" class="form-control"
                                               placeholder="{{ trans('site.admin.name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.personal_id') }} </label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="personal_id"
                                               class="form-control"
                                               placeholder="{{ trans('site.admin.personal_id') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.gender') }} </label>
                                    <div class="input-group">
                                        <select name="gender"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                            @foreach(config('system.gender') as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
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
                                               placeholder="{{ trans('site.admin.email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.phone') }} </label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="phone"
                                               class="form-control"
                                               placeholder="{{ trans('site.admin.phone') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.image') }}</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="image"
                                                       id="image" readonly hidden/>
                                                <button type="button" data-avatar="image"
                                                        class="btn btn-blue btn-square waves-effect waves-light px-4 mt-3 mb-3 get_image">
                                                    {{ trans('site.button_choose')}}
                                                </button>
                                                <button type="button" data-avatar="image"
                                                        disabled='disabled'
                                                        class="btn btn-danger btn-square waves-effect waves-light px-4 mt-3 mb-3 ml-3 remove_image">
                                                    {{ trans('site.button_remove')}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <img id="image_avatar"
                                                 src="{{asset('admin/assets/images/no_img.jpg')}}"
                                                 class="img-thumbnail"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ trans('site.admin.password') }}  </label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control"
                                               placeholder="{{ trans('site.admin.password') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('site.admin.role') }}  </label>
                                    <div class="input-group">
                                        <select name="role"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                            @foreach(config('system.role') as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary px-4 mb-3 mt-2"><i class="mdi
                        mdi-plus-circle-outline mr-2"></i>{{ trans('site.button_add') }}</button>
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

