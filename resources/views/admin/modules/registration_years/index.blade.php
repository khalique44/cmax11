@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Registration Years</h4>
                </div>
                <div class="database-btn">
                    <a href="{{ url('admin/modules/registration_years/create') }}" data-toggle="" data-target="#search-db-model"  class="BE-btn">New Registration Year</a>

                </div>
            </div>

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Year</th>
                            <th>Active?</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($registration_years as $registration_year)
                            <tr style="cursor: pointer;" data-id="{{ $registration_year->id }}" class="registration_years-row">
                                <td>{{ $registration_year->year }}</td>
                                @if($registration_year->is_active == 1)
                                    <td>Yes</td>
                                @else
                                    <td style="color: red;">No</td>
                                @endif
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

