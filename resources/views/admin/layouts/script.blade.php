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
<script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/assets/pages/jquery.datatable.init.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/ticker/jquery.jConveyorTicker.min.js') }}"></script>
<script src="{{ asset('admin/assets/pages/jquery.crypto-news.init.js') }}"></script>


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
<script>
    var table = $('.table-custom').DataTable({
        destroy: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/vi.json',
        },
        "ordering": false
    });
</script>
<script src="{{asset('admin/assets/js/app.js')}}"></script>
