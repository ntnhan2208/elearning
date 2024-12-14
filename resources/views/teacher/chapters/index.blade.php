@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('chapters.create') }}">{{ trans('site.add') }}</a>
                </div>
                <h4 class="page-title">Quản lý Chương bài học</h4>
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
                                    <th data-priority="1">Tên chương bài học</th>
                                    <th data-priority="1">Môn học</th>
                                    <th data-priority="1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($chapters as $chaper)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $chaper->chapter_name }}</td>
                                        <td>{{ $chaper->subject->subject_name }}</td>
                                        <td class="text-right">
                                            <form class="float-right" action="{{route('chapters.destroy',$chaper->id)}}"
                                                  method="POST" onSubmit="if(!confirm('Bạn chắc chắn muốn xoá Giáo viên?'))
												  {return false;}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-xs btn-danger"><i class="fas
												fa-trash"></i></button>
                                            </form>
                                            <div class="float-right">
                                                <a class="btn btn-xs btn-primary mr-3"
                                                   href="{{ route('chapters.edit',$chaper->id) }}">
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
