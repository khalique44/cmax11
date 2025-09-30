@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>All Properties</h4>
                </div>
                <div class="database-btn">                 
  
                    <a href="{{url('admin/properties/create')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-success"><i class="fa fa-plus"></i> Add Property</a></br></br>
                </div>
            </div>
       

            @include('layouts.partials.messages')

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="propertiesTable" class="display">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>                             
                            <th>Purpose</th>
                            <th>Price</th>
                            <th>Added At</th>
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
            $('#propertiesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('properties.data') }}",
                 pageLength: 5,
                columns: [
                   
                    { data: 'property_title', name: 'property_title' },
                    { data: 'property_type', name: 'property_type' },                    
                    { data: 'purpose', name: 'purpose' },                    
                    { data: 'price', name: 'price' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                paging: true, // Ensure pagination is enabled
                searching: true, // Enable search
                ordering: true, // Enable sorting
                info: true // Show info text (e.g., "Showing 1 to 5 of 25 entries")
            });
        });      

    </script>
@endsection
