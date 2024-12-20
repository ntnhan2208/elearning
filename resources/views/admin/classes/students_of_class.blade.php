@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
{{--                <h4 class="page-title">Danh sách học sinh - {{$class->class_name}}</h4>--}}
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table class="table table-custom table-striped dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th data-priority="1" class="text-center"></th>
                                    <th data-priority="1" style="font-family: 'Times New Roman'">Tên học sinh</th>
                                    <th data-priority="1">Điểm bài kiểm tra</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $student->name }}</td>
                                        @php
                                            $results = \App\Models\Result::where('student_id', $student->id)->get(['test_id','score']);
                                        @endphp
                                        <td>
                                            @if($results->isNotEmpty())
                                                @foreach($results as $result)
                                                    <span>
                                                {{ $result->test->test_name}}: <b>{{$result->score}}</b></span>
                                                @endforeach
                                            @else
                                                <span class="badge badge-soft-danger">Chưa có bài kiểm tra</span>
                                            @endif

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
