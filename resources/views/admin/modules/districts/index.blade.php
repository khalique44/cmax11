@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Districts</h4>
                </div>
                <div class="database-btn">
                    <a href="{{url('admin/modules/districts/create')}}" data-toggle="" data-target="#search-db-model"  class="BE-btn">New District</a>
                </div>
            </div>

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>District</th>
                            <th>Number</th>
                            <th>Country</th>
                            <th>Zip Code From</th>
                            <th>Zip Code To</th>
                            <th>Active?</th>
                        </tr>
                        </thead>
                        <tbody>
                           @foreach($districts as $district)
                            <tr style="cursor: pointer;" data-id="{{ $district->id }}" class="districts-row">
                                <td>{{ $district->district_name }}</td>
                                <td>{{ $district->district_number }}</td>
                                <td>{{ $district->country_name }}</td>
                                <td>{{ $district->zip_code_from }}</td>
                                <td>{{ $district->zip_code_to }}</td>
                                <td>{{ $district->active }}</td>
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
            $('#table_main').DataTable({
                "order": [],
                "pageLength": 100
            });
        });
    </script>
@endsection

