<div>
    @push('additional-css')
        <link rel="stylesheet" href="{{ URL::asset('css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/buttons.bootstrap4.min.css') }}">
    @endpush
    @push('additional-js')
      <script src="{{ URL::asset('js/datatables/jquery.dataTables.min.js') }}"></script>
      <script src="{{ URL::asset('js/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
      <script src="{{ URL::asset('js/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
      <script src="{{ URL::asset('js/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
      <script src="{{ URL::asset('js/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
      <script src="{{ URL::asset('js/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
      <script src="{{ URL::asset('js/jszip/jszip.min.js') }}"></script>
      <script src="{{ URL::asset('js/pdfmake/pdfmake.min.js') }}"></script>
      <script src="{{ URL::asset('js/pdfmake/vfs_fonts.js') }}"></script>
      <script src="{{ URL::asset('js/datatables-buttons/js/buttons.html5.min.js') }}"></script>
      <script src="{{ URL::asset('js/datatables-buttons/js/buttons.print.min.js') }}"></script>
      <script src="{{ URL::asset('js/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
      <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
      </script>
    @endpush
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{$title}}</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        {{$slot}}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
  