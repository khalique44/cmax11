@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Countries</h4>
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

                        @foreach($countries as $country)
                            <tr style="cursor: pointer;" data-id="{{ $country->id }}" class="countries-row">
                                <td>{{ $country->name }}</td>
                                @if($country->active == 1)
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


