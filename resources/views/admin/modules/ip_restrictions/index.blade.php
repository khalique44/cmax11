@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>IP Restrictions</h4>
                </div>
                <div class="database-btn">
                    <a href="{{url('admin/modules/ip_restrictions/create')}}" data-toggle="" data-target="#search-db-model"  class="BE-btn">Add New IP</a>
                </div>
            </div>

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->

                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>IP</th>
                            <th>Type</th>
                            <th>Mode</th>

                        </tr>
                        </thead>
                        <tbody>

                           @foreach($ip_restriction_data as $c_data)
                            <tr style="cursor: pointer;" data-id="{{ $c_data->id }}" class="ip_restrictions-row">
                                <td>{{$c_data->ip}}</td>
                                <td>{{$c_data->type}}</td>
                                <td>{{$c_data->mode}}</td>
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
                "pageLength": 100
            });
        });
    </script>
@endsection


