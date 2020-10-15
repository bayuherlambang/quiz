@extends('layouts.app')

@section('content')
    <!-- <h3 class="page-title">@lang('quickadmin.questions-options.title')</h3> -->

    <p>
        <a href="{{ route('questions_options.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.list')
        </div>

        <div class="card-header">
            <table id='dataTable' class="table table-bordered table-striped {{ count($questions_options) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('quickadmin.questions-options.fields.option')</th>
                        <th>@lang('quickadmin.questions-options.fields.question')</th>
                        <th>@lang('quickadmin.questions-options.fields.correct')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('quickadmin.questions-options.fields.option')</th>
                        <th>@lang('quickadmin.questions-options.fields.question')</th>
                        <th>@lang('quickadmin.questions-options.fields.correct')</th>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>

                <tbody>
                    @if (count($questions_options) > 0)
                        @foreach ($questions_options as $questions_option)
                            <tr data-entry-id="{{ $questions_option->id }}">
                                <td></td>
                                <td>{{ $questions_option->option }}</td>
                                <td>{{ $questions_option->question->question_text or '' }}</td>
                                <td>{{ $questions_option->correct == 1 ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('questions_options.show',[$questions_option->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    <a href="{{ route('questions_options.edit',[$questions_option->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['questions_options.destroy', $questions_option->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('questions_options.mass_destroy') }}';
    </script>
    <script type="text/javascript">
    //current month :
    var date = new Date();
    m = date.getMonth();
    y = date.getFullYear();
    //fungsi untuk filtering data berdasarkan tanggal
   //var start_date = '1/'+m+'/'+y;
   //var end_date = '31/'+m+'/'+y;
   var start_date;
   var end_date;
   var DateFilterFunction = (function (oSettings, aData, iDataIndex) {
      var dateStart = parseDateValue(start_date);
      var dateEnd = parseDateValue(end_date);
      //Kolom tanggal yang akan kita gunakan berada dalam urutan 2, karena dihitung mulai dari 0
      //nama depan = 0
      //nama belakang = 1
      //tanggal terdaftar =2
      var evalDate= parseDateValue(aData[10]);
        if ( ( isNaN( dateStart ) && isNaN( dateEnd ) ) ||
             ( isNaN( dateStart ) && evalDate <= dateEnd ) ||
             ( dateStart <= evalDate && isNaN( dateEnd ) ) ||
             ( dateStart <= evalDate && evalDate <= dateEnd ) )
        {
            return true;
        }
        return false;
      });

  // fungsi untuk converting format tanggal dd/mm/yyyy menjadi format tanggal javascript menggunakan zona aktubrowser
  function parseDateValue(rawDate) {
      console.log(rawDate);
      var date = rawDate.split(" ");
      var dateArray= date[0].split("/");
      var parsedDate= new Date(dateArray[2], parseInt(dateArray[1])-1, dateArray[0]);  // -1 because months are from 0 to 11
      return parsedDate;
  }
  $(document).ready(function() {
        var tabel = $('#dataTable').DataTable( {
            dom: '<Bf><r>t<lip>',
            //"dom":'<Bflr<<'datesearchbox'>>tip>',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ],
            columnDefs: [
             { type: 'date-eu', targets: 0 }
           ],
           order: [0, 'desc'],
            initComplete: function () {
              this.api().columns().every( function () {
                  var column = this;
                  var select = $('<select><option value=""></option></select>')
                      .appendTo( $(column.footer()).empty() )
                      .on( 'change', function () {
                          var val = $.fn.dataTable.util.escapeRegex(
                              $(this).val()
                          );

                          column
                              .search( val ? '^'+val+'$' : '', true, false )
                              .draw();
                      } );

                  column.data().unique().sort().each( function ( d, j ) {
                      select.append( '<option value="'+d+'">'+d+'</option>' )
                  } );
              });
          },
        });
        //menambahkan daterangepicker di dalam datatables
       $("div.datesearchbox").html('<div class="input-group"> <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar" aria-hidden="true"></i></span></div><input type="text" class="" style="position: relative;" id="datesearch" placeholder="Search by date range.."></div>');

       //document.getElementsByClassName("datesearchbox")[0].style.textAlign = "right";

       //konfigurasi daterangepicker pada input dengan id datesearch
       $('#datesearch').daterangepicker({
          autoUpdateInput: false
        });

       //menangani proses saat apply date range
        $('#datesearch').on('apply.daterangepicker', function(ev, picker) {
           $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
           start_date=picker.startDate.format('DD/MM/YYYY');
           end_date=picker.endDate.format('DD/MM/YYYY');
           $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
           tabel.draw();
        });

        $('#datesearch').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
          start_date='';
          end_date='';
          $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
          tabel.draw();
        });
      });



    </script>
@endsection
