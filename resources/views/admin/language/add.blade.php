@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card mt-3">
                <div class="card-body shadow-lg bg-white rounded">
                    <form action="{{ route('languages.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ trans('site.language.name_lang') }}</label>
                            <div class="input-group">
                                <input type="text" id="example-input1-group1" name="name" class="form-control"
                                       value="{{ old('name') }}"
                                       placeholder="{{ trans('site.language.name_lang') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.language.slug_lang') }}</label>
                            <div class="input-group">
                                <input type="text"  name="slug" class="form-control" value="{{ old('slug') }}"  placeholder="{{ trans('site.language.slug_lang') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.language.code_lang') }}</label>
                            <div class="input-group">
                                <input type="text"  name="code" class="form-control" value="{{ old('code') }}" placeholder="{{ trans('site.language.code_lang') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.language.flag_lang') }}</label>
                            <div class="input-group">
                                <input type="text"  name="flag" class="form-control" value="{{ old('flag') }}" placeholder="{{ trans('site.language.flag_lang') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.language.status_lang') }}</label>
                            <select name="status" class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="1" >{{ trans('site.enable') }}</option>
                                <option value="0" >{{ trans('site.disable') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.language.default_lang') }}</label>
                            <select name="default" class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="0" >{{ trans('site.no') }}</option>
                                <option value="1" >{{ trans('site.yes') }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 mt-3 mb-3"><i class="mdi
                        mdi-plus-circle-outline mr-2"></i>{{ trans('site.button_add') }}</button>
                        <a href="{{ route('languages.index') }}"><button type="button" class="btn btn-danger ml-2
                    px-4 mb-3 mt-3"><i class="fas fa-window-close"></i> {{trans('site.reset') }} </button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


