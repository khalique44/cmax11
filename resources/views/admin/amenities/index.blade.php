@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>All Amenities</h4>
                </div>
                <div class="database-btn">                 
  
                    <a href="{{url('admin/amenities/create')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-success"><i class="fa fa-plus"></i> Add Amenity</a></br></br>
                </div>
            </div>
       

            @include('layouts.partials.messages')

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="mainTable" class="display">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Icon</th> 
                            <th>Image</th> 
                            <th>Status</th>                           
                            <th>Actions</th>
                        </tr>
                        </thead>
                       
                    </table>
                </div>
                

            </div>
        </div>
    </div>

    

   <script>
        $(document).ready(function () {
            $('#mainTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('amenities.data') }}",
                 pageLength: 10,
                columns: [
                   
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'icon', name: 'icon' },
                    { data: 'file_url', name: 'file_url' },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                paging: true, // Ensure pagination is enabled
                searching: true, // Enable search
                ordering: true, // Enable sorting
                info: true, // Show info text (e.g., "Showing 1 to 5 of 25 entries")
                order: [[0, "desc"]]
            });
        });      

    </script>
@endsection
