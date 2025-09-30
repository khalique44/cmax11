@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Home Page General Settings</h4>
                </div>
                
            </div>

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->

                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>

                        </tr>
                        </thead>
                        <tbody>

                           @foreach($home_settings as $c_data)
                            <tr style="cursor: pointer;" data-id="{{ $c_data->id }}" class="categories-row">
                                <td>{{$c_data->title}}</td>
                                <td>{{$c_data->description}}</td>
                            </tr>
                            </a>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
            $('#table_main').DataTable({
                "order": [],
                "pageLength": 100,
                dom: 'Bfrtip',
                buttons: [
                    //'copyHtml5',
                    //'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "lengthMenu": [[100, "All", 50, 25], [100, "All", 50, 25]]
            });
        });
    </script>
@endsection


