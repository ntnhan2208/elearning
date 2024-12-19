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
        <div class="col-12">
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
                                        <input type="text" id="example-input1-group1" name="class_name"
                                               class="form-control"
                                               value="{{$class->class_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label> Sỉ số </label>
                                    <div class="input-group">
                                        <input type="text" id="example-input1-group1" name="quantity"
                                               class="form-control integerInput"
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
                                                <option value="{{ $teacher->id }}"
                                                        @if($teacher->id==$class->teacher_id))
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
        <div class="col-12">
            <div class="card shadow-lg bg-white rounded">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Sỉ
                        số: {{($class->students() ? $class->students()->count() : 0) ."/". $class->quantity}}</h4>
                    <button type="button" class="btn btn-xs btn-primary mt-2 mb-2" data-toggle="modal"
                            data-animation="bounce" data-target=".bs-example-modal-lg">Thêm học sinh vào lớp
                    </button>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable" class="table table-custom table-striped dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th data-priority="1" class="text-center"></th>
                                    <th data-priority="1">Tên học sinh</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($class->students()->get() as $student)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td class="text-right">
                                            <form class="float-right"
                                                  action="{{route('classes.delete-student',[$class->id, $student->id])}}"
                                                  method="POST" onSubmit="if(!confirm('Bạn chắc chắn muốn xoá?'))
												  {return false;}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger"><i class="fas
												fa-trash"></i></button>
                                            </form>
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

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Thêm học sinh</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{route('classes.add-students',$class->id)}}" method="POST"
                          enctype="multipart/form-data" class="form-horizontal well">
                        @csrf
                        <table id="datatable1" class="table table-custom table-striped dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th data-priority="1" class="text-center"></th>
                                <th data-priority="1">Tên học sinh</th>
                                <th data-priority="1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td><input type="checkbox" name="student_ids[]" value="{{$student->id}}"></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <button onclick="return checkQuantity()" class="btn btn-xs btn-primary">Xác nhận</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function checkQuantity() {

        var quantity = "<?php echo $class->quantity ?>";
        var currentQuantity = "<?php echo $currentQuantity ?>";

        var checked = document.querySelectorAll('input[type="checkbox"]:checked').length;
        if (quantity * 1 < currentQuantity * 1 + checked*1) {
            alert('Số lượng vượt quá sỉ số tối đa lớp học')
            return false
        }
        return true
    }

</script>

