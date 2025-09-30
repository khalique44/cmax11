@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Registration Types</h4>
                </div>
                <div class="database-btn">
                    <a href="{{ url('admin/modules/registration_types/create') }}" data-toggle="" data-target="#search-db-model"  class="BE-btn">New Registration Type</a></br></br>
                </div>
            </div>

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Payment Active?</th>
                            <th>Active?</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($registration_types as $registration_type)
                            <tr style="cursor: pointer;" data-id="{{ $registration_type->id }}" class="registration_types-row">

                                <td>{{$registration_type->name}}</td>
                                <td>{{$registration_type->is_payment_active}}</td>
                                <td>{{$registration_type->is_active}}</td>
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

