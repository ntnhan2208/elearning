<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/assets/js/metisMenu.min.js')}}"></script>
<script src="{{asset('admin/assets/js/waves.min.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('admin/assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('admin/assets/pages/jquery.sweet-alert.init.js')}}"></script>
<script src="{{asset('admin/assets/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('admin/assets/pages/jquery.form-editor.init.js')}}"></script>
<script src="{{asset('admin/assets/assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<script src="{{asset('admin/assets/pages/jquery.validation.init.js')}}"></script>
<script src="{{asset('admin/assets/plugins/repeater/jquery.repeater.min.js')}}"></script>
<script src="{{asset('admin/assets/pages/jquery.form-repeater.js')}}"></script>
{{--@include('ckfinder::setup')--}}
{{--<script src={{ asset('ckeditor/ckeditor.js') }}></script>--}}
<script src="{{asset('admin/assets/js/bootstrap-tagsinput.min.js')}}"></script>
<script>
    $("body").on('input', '.integerInput', function () {
        $(this).val($(this).val().replace(/[^0-9]/gi, ''));
    });

</script>
@toastr_js
@toastr_render
@yield('script')
<script src="{{asset('admin/assets/js/app.js')}}"></script>
