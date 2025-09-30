@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Membership Year Colors</h4>
                </div>
                <div class="database-btn">
                    <a href="{{url('admin/modules/membership_year_color/create')}}" data-toggle="" data-target="#search-db-model"  class="BE-btn">New Membership Year Color</a></br></br>
                </div>
            </div>
            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="table_main" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>Year</th>
                            <th>Color</th>
                            <th>Active?</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($year_color as $year_color_data)
                            <tr title="Click here to update" style="cursor: pointer;" data-id="{{ $year_color_data->id }}" class="membership_year_color-row">

                            <td>{{$year_color_data->year}}</td>
                                <td><input style="background-color:{{$year_color_data->color}}; text-align: center; width: 200px;" type="" name=" color[]" value="{{$year_color_data->color}}"></label></td>
                                <td>{{$year_color_data->active}}</td>

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

