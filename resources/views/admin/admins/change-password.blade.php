@extends('admin.master')
@section('content')
    <div class="row mt-3 mr-auto ">
        <div class="col-12">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    <form action="{{ route('update_password')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ trans('site.admin.old_password') }}</label>
                            <div class="input-group">
                                <input type="password" name="old_password" class="form-control"
                                       placeholder="{{ trans('site.admin.old_password') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.admin.new_password') }}</label>
                            <div class="input-group">
                                <input type="password" id="new-password" name="new_password" class="form-control"
                                       placeholder="{{ trans('site.admin.new_password') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.admin.confirm_password') }}</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control"
                                       placeholder="{{ trans('site.admin.confirm_password') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-4 mb-3 mt-2"><i class="fas fa-save"></i>
                            {{trans('site.button_update') }} </button>
                        <a href="{{ route('dashboard') }}">
                            <button type="button" class="btn btn-danger ml-2
                        px-4 mb-3 mt-2"><i class="fas fa-window-close"></i> {{trans('site.reset') }} </button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
