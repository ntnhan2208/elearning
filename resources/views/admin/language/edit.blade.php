@extends('admin.master')
@section('content')
<div class="page-content pl-3">
    <div class="row mt-3 mr-auto ">
        <div class="col-6">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    <form action="{{ route('languages.update',$language)}}" method="POST">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="form-group">
                            <label for="example-input2-group1">{{ trans('site.language.name_lang') }}</label>
                            <div class="input-group">
                                <input type="text" id="example-input2-group1" name="name" class="form-control" value="{{$language-> name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-input2-group1">{{ trans('site.language.slug_lang') }}</label>
                            <div class="input-group">
                                <input type="text" id="example-input2-group1" name="slug" class="form-control" value="{{$language-> slug}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-input2-group1">{{ trans('site.language.code_lang') }}</label>
                            <div class="input-group">
                                <input type="text" id="example-input2-group1" name="code" class="form-control" value="{{$language-> code}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.language.flag_lang') }}</label>
                            <div class="input-group">
                                <input type="text"  name="flag" class="form-control" value="{{$language->flag}}"
                                       placeholder="{{ trans('site
                                .language.flag_lang') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.language.status_lang') }}</label>
                            <select name="status" class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="1" {{ ($language->status == 1) ? 'selected' : '' }}>{{ trans('site.enable') }}</option>
                                <option value="0" {{ ($language->status == 0) ? 'selected' : '' }}>{{ trans('site.disable') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.language.default_lang') }}</label>
                            <select name="default" class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="1" {{ ($language->default == 1) ? 'selected' : '' }}>{{ trans('site.yes') }}</option>
                                <option value="0" {{ ($language->default == 0) ? 'selected' : '' }}>{{ trans('site.no') }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 mb-3 mt-2"><i class="fas fa-save"></i>
                            {{trans('site.button_update') }} </button>
                        <a href="{{ route('languages.index') }}"><button type="button" class="btn btn-danger ml-2
                        px-4 mb-3 mt-2"><i class="fas fa-window-close"></i> {{trans('site.reset') }} </button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


