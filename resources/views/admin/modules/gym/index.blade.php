@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Gyms</h4>
                </div>
                <div class="database-btn">
                    <a href="{{ url('admin/modules/gym/create') }}" data-toggle="" data-target="#search-db-model"  class="BE-btn">New Gym</a>
                </div>
            </div>

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Gym</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>Phone Number</th>
                            <th>Active Statue</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gyms as $gym)
                            <tr style="cursor: pointer;" data-id="{{ $gym->id }}" class="gym-row">
                                <td>{{ $gym->gym_name }}</td>
                                <td>{{ $gym->country_name }}</td>
                                <td>{{ $gym->state }}</td>
                                <td>{{ $gym->phone }}</td>
                                <td>{{ $gym->active }}</td>
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

