@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Categories</h4>
                </div>
                <div class="database-btn">
                    <a href="{{url('admin/modules/categories/create')}}" data-toggle="" data-target="#search-db-model"  class="BE-btn">New Category</a>
                </div>
            </div>

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->

                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Active?</th>

                        </tr>
                        </thead>
                        <tbody>

                           @foreach($categories_data as $c_data)
                            <tr style="cursor: pointer;" data-id="{{ $c_data->id }}" class="categories-row">
                                <td>{{$c_data->name}}</td>
                                <td>{{$c_data->active}}</td>
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


