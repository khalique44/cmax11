@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Team Members</h4>
                </div>
                <div class="database-btn">
                    <a href="{{ url('admin/home_page/team_members/create') }}" data-toggle="" data-target="#search-db-model"  class="BE-btn">Add</a>
                </div>
            </div>

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Position</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Designation</th>
                            <th>Description</th>                            
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $key => $record)
                            <tr data-entry-id="{{ $record->id }}">

                                <td class="cursor-pointer" >{{($key+1)}}</td>
                                <td>{{ $record->member_name }}</td>
                                <td>
                                    @if(!empty($record->file_url))
                                        <a href="{!! url('public') !!}/{{$record->file_url}}" target="_blank">
                                             
                                            <img src="{!! url('public') !!}/{{$record->file_url}}" class="logo" alt="Logo" width="30%">
                                            

                                        </a>
                                    @endif

                                </td>    
                                <td>

                                    {{ $record->designation }}


                                </td>   
                                <td>

                                    {{ $record->description }}


                                </td>                        
                                <td>

                                    @if($record->status == 'yes') 
                                    <span class="label label-success">Yes</span>
                                    @else
                                    <span class="label label-danger">No</span>
                                    @endif


                                </td>

                                <td>

                                    <a href="{{ url('admin/home_page/team_members/') }}/{{ $record->id }}/edit/" class="text-success" title="Edit Record"><i class="fa fa-pencil"></i></a>


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
             $(document).ready(function() {
                let datatable = $('#table_main').DataTable({
                    "order": [0,'asc'],
                    "pageLength": 100,
                    "rowReorder": true,
                    dom: 'Bfrtip',
                    buttons: [
                        //'copyHtml5',
                        //'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                    "lengthMenu": [[100, "All", 50, 25], [100, "All", 50, 25]]
                });

                datatable.on('row-reorder', function (e, details) {
                    if(details.length) {
                        let rows = [];
                        details.forEach(element => {
                            rows.push({
                                id: $(element.node).data('entry-id'),
                                position: element.newData
                            });
                            console.log(element.newData, $(element.node).data('entry-id'))
                        });

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            method: 'POST',
                            url: "{{ url('admin/home_page/team_members/update_position') }}",
                            data: { rows }
                        }).done(function () { datatable.draw(); });
                    }

                });
            });
        });
    </script>
@endsection

