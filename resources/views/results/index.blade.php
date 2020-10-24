@extends('layouts.app')

@section('content')
    <!-- @if(Auth::user()->isAdmin())
    <h3 class="page-title">@lang('quickadmin.results.title_admin')</h3>
    @else
    <h3 class="page-title">@lang('quickadmin.results.title')</h3>
    @endif -->
    <div class="card">
        <div class="card-header">
            @lang('quickadmin.list')
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped {{ count($results) > 0 ? 'datatable' : '' }}" id="dataTable">
                <thead>
                    <tr>
                    @if(Auth::user()->isAdmin())
                        <th>@lang('quickadmin.results.fields.user')</th>
                        <th>@lang('quickadmin.results.fields.last_login')</th>
                    @endif
                        <th>@lang('quickadmin.results.fields.date')</th>
                        <th>Result</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    @if(Auth::user()->isAdmin())
                        <th>@lang('quickadmin.results.fields.user')</th>
                        <th>@lang('quickadmin.results.fields.last_login')</th>
                    @endif
                        <th>@lang('quickadmin.results.fields.date')</th>
                        <th>Result</th>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if (count($results) > 0)
                        @foreach ($results as $result)
                            <tr>
							@php
							$split = explode(" ", $result->user->last_login);
                            $tanggal = explode("-", $split[0]);
                            $jam = $split[1];
                            $last_login = $tanggal[2]."/".$tanggal[1]."/".$tanggal[0]." ".$jam;
							@endphp
                            @if(Auth::user()->isAdmin())
                                <td>{{ $result->user->name or '' }} ({{ $result->user->email or '' }})</td>
                                <td>{{ $last_login }}</td>
                            @endif
                            @php
                            $split = explode(" ", $result->created_at);
                            $tanggal = explode("-", $split[0]);
                            $jam = $split[1];
                            $tanggal = $tanggal[2]."/".$tanggal[1]."/".$tanggal[0]." ".$jam;
                            @endphp
                                <td>{{ $tanggal or '' }}</td>
                                <td>{{ $result->result }}</td>
                                <td>
                                    <a href="{{ route('results.show',[$result->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
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
      var evalDate= parseDateValue(aData[1]);
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
            dom: '<Bf><"datesearchbox"><r>t<lip>',
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

       document.getElementsByClassName("datesearchbox")[0].style.textAlign = "right";

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
@stop
