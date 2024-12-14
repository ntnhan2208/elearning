@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('classes.create') }}">{{ trans('site.add') }}</a>
                </div>
                <h4 class="page-title">Quản lý Lớp học</h4>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th data-priority="1" class="text-center"></th>
                                    <th data-priority="1">Tên lớp</th>
                                    <th data-priority="1">Sỉ số</th>
                                    <th data-priority="1">Giáo viên chủ nhiệm</th>
                                    <th data-priority="1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($classes as $class)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $class->class_name }}</td>
                                        <td>{{ $class->quantity }}</td>
                                        <td> <span @if(!$class->teacher) class="badge badge-soft-danger" @endif> {{ $class->teacher ? $class->teacher->name : 'Chưa phân giáo viên chủ nhiệm' }} </span></td>
                                        <td class="text-right">
                                            <form class="float-right" action="{{route('classes.destroy',$class->id)}}"
                                                  method="POST" onSubmit="if(!confirm('Bạn chắc chắn muốn xoá Giáo viên?'))
												  {return false;}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-xs btn-danger"><i class="fas
												fa-trash"></i></button>
                                            </form>
                                            <div class="float-right">
                                                <a class="btn btn-xs btn-primary mr-3"
                                                   href="{{ route('classes.edit',$class->id) }}">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
