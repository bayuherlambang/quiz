@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>

    <p>
        <a href="{{ route('users.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.list')
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }} dt-select" id="dataTable">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('quickadmin.users.fields.name')</th>
                        <th>@lang('quickadmin.users.fields.email')</th>
                        <th>@lang('quickadmin.users.fields.role')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('quickadmin.users.fields.name')</th>
                        <th>@lang('quickadmin.users.fields.email')</th>
                        <th>@lang('quickadmin.users.fields.role')</th>
                        <th>&nbsp;</th>
                    </tr>
                </tfoot>

                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->title or '' }}</td>
                                <td>
                                    <a href="{{ route('users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    <a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>

        window.route_mass_crud_entries_destroy = '{{ route('users.mass_destroy') }}';

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
                'columns' : [
                  {"width" : "10%"},
                ]
              });
              //menambahkan daterangepicker di dalam datatables
             $("div.datesearchbox").html('<div class="input-group"> <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar" aria-hidden="true"></i></span></div><input type="text" class="" style="position: relative;" id="datesearch" placeholder="Search by date range.."></div>');



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
