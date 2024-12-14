@extends('admin.master')
@section('content')
    <div class="row mt-3 mr-auto ">
        <div class="col-6">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    <form action="{{ route('admins.update',$admin->id)}}" method="POST" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="form-group">
                            <label>{{ trans('site.admin.email') }}</label>
                            <div class="input-group">
                                <input type="text" name="email" class="form-control" readonly value="{{$admin->email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="text-muted mb-3">{{ trans('site.admin.image') }}</p>
                            <input type="file" name="images" id="input-file-now" class="dropify" data-height="300"
                                   data-default-file="{{ asset('images/'.$admin->image) }}"/>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.admin.name') }}</label>
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" value="{{$admin->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.admin.phone') }}</label>
                            <div class="input-group">
                                <input type="text" name="phone" class="form-control" value="{{$admin->phone}}">
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
        <div class="col-6">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    @if(isset($QRImage))
                        <div class="panel-body text-center">
                            <p>{{ trans('site.note_2fa1') }}</p>
                            <p>{{ trans('site.note_2fa2') }}</p>
                            <p>{{ trans('site.note_2fa') }} </p>
                            <div>
                                <img src="{{ $QRImage }}">
                            </div>
                            <h2>{{ $admin->secret_code }}</h2>
                            <div>
                                <form action="{{ route('admins.complete_2fa')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $admin->id }}">
                                    <input type="hidden" name="google2fa_enable"
                                           value="{{ $admin->google2fa_enable == 1 ? 0 : 1 }}">
                                    @if($admin->google2fa_enable == 1)
                                        <button type="submit" class="btn btn-danger px-4 mt-2">
                                            {{ trans('site.disable_2fa') }}</button>
                                    @else
                                        <button type="submit" class="btn btn-primary px-4 mt-2">
                                            {{ trans('site.enable_2fa') }}</button>
                                    @endif
                                    <a class="btn btn-warning ml-2 px-4 mt-2" href="{{ route('admins.reset_2fa',
                                $admin->id) }}">
                                        {{trans('site.reset_2fa') }}
                                    </a>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


