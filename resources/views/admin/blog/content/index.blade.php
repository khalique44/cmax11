@extends('layouts.admin')

@section('content')
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Blog</h4>
                </div>
                <div class="database-btn">
                    <a href="{{ url('admin/blog/posts/create') }}" data-toggle="" data-target="#search-db-model"  class="btn btn-success"><i class="fa fa-plus"></i> Add</a> <br><br>
                </div>
            </div>

            @include('layouts.partials.messages')

            <div class="database-table-section">
                <div class="db-table-content table-responsive">
                    <!-- Main Table Start-->
                    <table id="blogTable" class="display">
                        <thead>
                        <tr>
                                                      
                            <!-- <th>Position</th> -->
                            <th>Title</th>
                            <th>Image</th>
                            
                            <th>Status</th>
                            <th>Date</th>
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

    var table = $('#blogTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('blog.data')}}",
        pageLength: 10,
        columns: [

             
           
            { data: 'title', name: 'title' },                   
            { data: 'file_url', name: 'file_url' }, 
            //{ data: 'short_description', name: 'short_description' }, 
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        paging: true, // Ensure pagination is enabled
        searching: true, // Enable search
        ordering: true, // Enable sorting
        info: true // Show info text (e.g., "Showing 1 to 5 of 25 entries")
    });

    /*$('#projectsTable tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // Row is already open
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });*/
});      

</script>
@endsection

