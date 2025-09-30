@extends('layouts.admin')

@section('content')

    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>All Users</h4>
                </div>
                <div class="database-btn">
                    <a href="" data-toggle="modal" data-target="#search-db-model"  class="BE-btn hidden">Search Database</a>
                    <a href="{{ url('admin/users') }}" class="BE-btn hidden"> Clear</a>
                    <a href="{{url('admin/users/create')}}" data-toggle="" data-target="#search-db-model"  class="BE-btn">Add User</a></br></br>
                </div>
            </div>
       

            @include('layouts.partials.messages')

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="usersTable" class="display">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Type</th>                            
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                       
                    </table>
                </div>
                

            </div>
        </div>
    </div>

    

   <script>
        $(document).ready(function () {
            $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.data') }}",
                 pageLength: 10,
                columns: [
                   
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'username', name: 'username' },
                    { data: 'type', name: 'type' },
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
