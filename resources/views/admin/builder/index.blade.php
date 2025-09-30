@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>All Builders</h4>
                </div>
                <div class="database-btn">                 
  
                    <a href="{{url('admin/builders/create')}}" data-toggle="" data-target="#search-db-model"  class="btn btn-success"><i class="fa fa-plus"></i> Add Builder</a></br></br>
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
                            <th>Email</th>                            
                            <th>Phone</th> 
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
            $('#mainTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('builders.data') }}",
                 pageLength: 10,
                columns: [
                   
                    { data: 'id', name: 'id' },
                    { data: 'builder_name', name: 'builder_name' },
                    { data: 'email', name: 'email' },
                    { data: 'mobile_number', name: 'mobile_number' },
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
