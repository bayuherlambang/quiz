<!-- <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="{{ url('quickadmin/js') }}/bootstrap.min.js"></script>
<script src="{{ url('quickadmin/js') }}/main.js"></script>
 -->


<!-- jQuery -->
<script src="{{ url('adminlte') }}/plugins/jquery/jquery.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('adminlte') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('adminlte') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('adminlte') }}/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('adminlte') }}/dist/js/demo.js"></script>


<script src="{{ url('datatables') }}/js/jquery.dataTables.min.js"></script>
<script src="{{ url('datatables') }}/js/dataTables.buttons.min.js"></script>
<script src="{{ url('datatables') }}/js/buttons.flash.min.js"></script>
<script src="{{ url('datatables') }}/js/jszip.min.js"></script>
<script src="{{ url('datatables') }}/js/pdfmake.min.js"></script>
<script src="{{ url('datatables') }}/js/vfs_fonts.js"></script>
<script src="{{ url('datatables') }}/js/buttons.html5.min.js"></script>
<script src="{{ url('datatables') }}/js/buttons.print.min.js"></script>
<script src="{{ url('datatables') }}/js/moment.min.js"></script>
<script src="{{ url('datatables') }}/js/daterangepicker.min.js"></script>


<script>
    window._token = '{{ csrf_token() }}';
</script>

@yield('javascript')
