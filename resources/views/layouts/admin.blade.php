<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cmax | Admin </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="admin_url" content="{{ url('admin') }}">
    <link href="{!! asset('assets/fontawesome/css/all.min.css') !!}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{!! asset('assets/css/animate.css')!!}" rel="stylesheet">
    <link href="{!! asset('assets/css/admin-style.css') !!}" rel="stylesheet">

    <link href="{!! asset('assets/css/datatables/jquery.dataTables.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/css/datatables/buttons.dataTables.min.css') !!}" rel="stylesheet">

    <link rel="stylesheet" href="{!! asset('assets/css/jquery.minicolors.css') !!}">
    <link href="{!! asset('assets/css/bootstrap-datepicker.css') !!}" rel="stylesheet">
    <link href="{!! asset('select2/select2.min.css')!!}" rel="stylesheet" />
    <link href="{!! asset('multi-select/css/multi-select.css')!!}" rel="stylesheet" />
    <link href="{!! asset('assets/css/bootstrap-colorpicker.css')!!}" rel="stylesheet" />
    <link href="{!! asset('assets/css/jquery.timepicker.min.css')!!}" rel="stylesheet" />
    <!-- <link href="css/bootstrap-colorpicker/bootstrap-colorpicker.css" rel="stylesheet"> -->
    <!-- SweetAlert2 CSS (Optional, for custom styling) -->
    <link rel="stylesheet" href="{!! asset('assets/css/sweetalert2.min.css') !!}">    

    <script src="{!! asset('assets/js/jquery.min.js') !!}"></script>
    <script src="{!! asset('assets/js/jquery.minicolors.js') !!}"></script>
    <!-- SweetAlert2 JS -->
    <script src="{!! asset('assets/js/sweetalert2@11.js') !!}"></script>
    
    <link rel="icon" href="{!! asset('assets/img/favicon.png') !!}">

    <!-- FilePond Styles -->
    <link href="{!! asset('assets/filepond/css/filepond.css') !!}" rel="stylesheet" />
    <link href="{!! asset('assets/filepond/css/filepond-plugin-image-preview.css') !!}" rel="stylesheet" />
    <!-- Include Google Places API JS -->

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_map_api') }}&libraries=places"></script>
    

    <style>
        .number_arrow::-webkit-inner-spin-button,
        .number_arrow::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }


        /*#table_main_users_wrapper .dt-buttons a{
            color: #fff;
            font-weight: 700;
            background: #c30505 none repeat scroll 0 0;
            border: 1px solid #666;
            padding: 5px 16px;
        }

        #table_main_users_wrapper .dt-buttons a:focus{
            color: #c30505;
        }

        #table_main_users_wrapper .dt-buttons a:hover{
            color: #c30505;
            background: #fff;
        }*/

        .district-form-content .form-sec-content label{
            width: auto;
        }
        .form-users {
            width: 50%;
            float: left;
            padding: 0 5px;
        }

        .form-sec {
            background: #e9e9e9;
            border-radius: 5px;
            padding: 40px 0 35px 0;
            margin: 35px 0 0 0;
        }

        .form-content {
            width: 100%;
            display: inline-block;
            padding: 7px 5px 0px 5px;
            border: 1px solid #fff;
            background: #fff;
        }

        /*.district-form-content.add-new-district-form .form-group {
            width: 100% !important;
            display: inline-block;
        }*/

        .form-sec-content {
            width: 100%;
            display: inline-block;
        }
    </style>
    <script>
        window.cmax = {
            csrfToken: "{{ csrf_token() }}",
            adminUrl:  "{{ url('admin') }}",
               
        };
    </script>
</head>
<body id="user-backend">
    <div id="loader" class="lds-dual-ring hidden overlay"></div>
<header>
    <div id="backend-header" class="backend-header">
        <div class="container">
            <div class="logo">
                <div  class="logo-image">
                    @php $header_logo = App\Http\Helpers\GeneralHelper::getOption('header_logo') @endphp
                    <a href="{!! route('admin.dashboard') !!}" style="background:none; height: auto;"><img src="@if(!empty($header_logo))  {{ asset($header_logo) }} @else {!! asset('assets/images/logo-white.png') !!} @endif" class="logo" alt="Logo"></a>
                </div>
                
            </div>
            <div class="backend-header-content-area">
                <div class="name-title">
                    <h3>Welcome {{ auth('admin')->user()->name }}</h3>
                </div>
                <div class="header-login-btn-area">
                    <a  class="btn" href="{!! route('admin.logout') !!}">{{ __('Logout') }}</a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="admin-page-whole-content">

     @include("layouts.includes.admin.sidebar")

    {{-- Confirmation Alert Box Model for confirm to delete--}}

    <div class="modal" id="DeleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="DeleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeleteConfirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> This action can not be un-done, Are you sure you want to permanently Remove this? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-sm btn-success" data-dismiss="modal">Close</button>
                    {{--<a type="hidden" id="approve-users-approve-div" class='btn-sm btn-danger' href=''>Approve</a>
                    <a type="hidden" id="approve-users-delete-div" class='btn-sm btn-danger' href=''>Decline</a>--}}

                    <form style="display: inline-block;" type="hidden" class="data-delete-form" method="POST" action="">
                        {{ method_field('DELETE' )}}
                        {{ csrf_field()}}
                        <div class="action-buttons">
                            <button type="submit" class="btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @yield('content')

<script src="{!! asset('assets/js/jquery.js') !!}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{!! asset('assets/js/parallax.js') !!}"></script>
<script src="{!! asset('assets/js/moment.min.js') !!}"></script>
<script src="{!! asset('assets/js/bootstrap-datepicker.min.js') !!}"></script>
<script src="{!! asset('assets/js/jQuery.formError.js') !!}"></script>

<script src="{!! asset('assets/js/dataTables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('assets/js/dataTables/dataTables.buttons.min.js') !!}"></script>
<script src="{!! asset('assets/js/dataTables/pdfmake.min.js') !!}"></script>
<script src="{!! asset('assets/js/dataTables/vfs_fonts.js') !!}"></script>
<script src="{!! asset('assets/js/dataTables/buttons.html5.min.js') !!}"></script>
<script src="{!! asset('assets/js/dataTables/rowReorder.min.js') !!}"></script>

<script src="{!! asset('assets/js/app.js') !!}"></script>
<script src="{!! asset('select2/select2.js')!!}"></script>


<script src="{!! asset('assets/js/bootstrap-colorpicker.js') !!}"></script>
<script src="{!! asset('assets/js/ckeditor.js') !!}"></script>
<script src="{!! asset('assets/js/jquery.timepicker.min.js') !!}"></script>

<!-- FilePond Scripts -->
<script src="{!! asset('assets/filepond/js/filepond-plugin-file-validate-type.js') !!}"></script>
<script src="{!! asset('assets/filepond/js/filepond-plugin-file-validate-size.min.js') !!}"></script>
<script src="{!! asset('assets/filepond/js/filepond-plugin-image-preview.js') !!}"></script>

<script src="{!! asset('assets/filepond/js/filepond.js') !!}"></script>


<script src="{!! asset('assets/js/main-admin.js')!!}"></script>




<script type="text/javascript">


/*Just For Pdf Downloads*/
function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    source = $('#district_membership_table_main_div')[0];

    specialElementHandlers = {
        '#bypassme': function(element, renderer) {
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    pdf.fromHTML(
        source, // HTML string or DOM elem ref.
        margins.left, // x coord
        margins.top, {// y coord
            'width': margins.width, // max width of content on PDF
            'elementHandlers': specialElementHandlers
        },
        function(dispose) {
            pdf.save('Test.pdf');
        }
        , margins);
}

/* DataTable Use For Data display in the table and search filters,pagination and entity limits there */
/* Common alert box for confirm to delete in modules*/

$(document).ready(function() {
    if($("textarea#txtEditor").length > 0){
        ClassicEditor
        .create(document.querySelector('#txtEditor'))
        .then(editor => {
            editor.ui.view.editable.element.style.minHeight = '300px';
        })
        .catch(error => {
            console.error(error);
        });
    }

    /*document.querySelectorAll('.editor').forEach(el => {
        ClassicEditor.create(el)
            .then(editor => {
                editor.ui.view.editable.element.style.minHeight = '300px';
            })
            .catch(error => console.error(error));
    });*/
    /*if($("textarea#txtEditor").length > 0){
        CKEDITOR.replace( 'txtEditor' );

        // Wait for CKEditor to be ready
        CKEDITOR.on('instanceReady', function () {
            const saved = sessionStorage.getItem('description');
            if (saved) {
                CKEDITOR.instances['txtEditor'].setData(saved);
            }

            // Save content on change
            CKEDITOR.instances['txtEditor'].on('change', function () {
                const data = CKEDITOR.instances['txtEditor'].getData();
                sessionStorage.setItem('description', data);
            });
        });
    }*/

     $('.colors').colorpicker({
        popover: false,
        inline: true,
        container: '.color'
      });

    $('.dt-buttons').css({'margin-top':'60px'});
    $('.dt-buttons').css('float', 'right');

    $('.dataTables_length').css('margin-top', '60px');
    $('.dataTables_length').css('margin-left', '-385px');
    /*$('#table_main').DataTable({
        "order": [],
        "pageLength": 2
    });*/
    // $('#table_main').DataTable( {
    //     "processing": false,
    //     "serverSide": false,
    //     "dom": 'Blfrtip',
    //     'pageLength':25,
    //     "buttons": [
    //             'copy', 'csv', 'excel', 'pdf', 'print'
    //             ]
    // });

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });

});

/* Just For .csv File Downloads */
$("#tableHTMLExportToCsv").click(function(){
    //$("#table_main").tableToCSV();
    $("#table_main_download").tableToCSV();
});

/* Get States By Clicking On (Country DropDown Selector) */

function DropDownGetStates(countryID)
{
    if(countryID)
    {
        $.ajax({
            type:"GET",
            url:"{{url('getstatelist')}}?countryid="+countryID,
            success:function(res)
            {
                //alert(res);
                if(res)
                {
                    $("#sel_state").empty();
                    $("#sel_state").append('<option value="" selected>State/Province</option>');
                    $.each(res,function(key,value){
                        $("#sel_state").append('<option value="'+key+'">'+value+'</option> selected');
                    });

                     $.ajax({
                        type:"GET",
                        url:"{{url('getyearslist')}}?countryid="+countryID,
                        success:function(res1)
                        {

                            if(res1)
                            {
                                if($("#registration_year").length>0){
                                    $("#registration_year").empty();
                                    $("#registration_year").append('<option value="" selected>Select Year</option>');
                                    $.each(res1,function(key,value){
                                        $("#registration_year").append('<option value="'+key+'">'+value+'</option> selected');
                                    });

                                }
                            }
                        }
                    });
                }
                else
                {
                    $("#sel_state").empty();
                }
            }
        });
    }
    else
    {
        $("#state").empty();
        $("#sel_state").empty();
        $("#sel_state").append('<option value="" selected>State/Province</option>');
        $("#sel_district").empty();
        $("#sel_district").append('<option value="" selected>Select District</option>');
    }
}

/* Get Districts By Clicking On (State DropDown Selector) */

function DropDownGetDistricts(stateID)
{
    if(stateID)
    {
        $.ajax({
            type:"GET",
            url:"{{url('getdistrictlist')}}?stateid="+stateID,

            success:function(res)
            {
                //alert(res);
                if(res)
                {
                    $("#sel_district").empty();
                    $("#sel_district").append('<option value="" selected>Select District</option>');
                    $.each(res,function(key,value){
                        $("#sel_district").append('<option value="'+key+'">'+value+'</option> selected');
                    });
                }
                else
                {
                    $("#sel_district").empty();
                }
            }
        });
    }
    else
    {
        $("#state").empty();
        $("#sel_district").empty();
        $("#sel_district").append('<option value="" selected>Select District</option>');
    }
}
    /* District Update Link at Admin Pannel*/

$(document).on('click','.districts-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/modules/districts/"+id+"/edit";
});

    /* Categories Update Link at Admin Pannel*/

$(document).on('click','.categories-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/modules/categories/"+id+"/edit";

});


/* IP Restriction Update Link at Admin Pannel by KHL */
$(document).on('click','.ip_restrictions-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/modules/ip_restrictions/"+id+"/edit";

});
    /* Countries Update Link at Admin Pannel*/

$(document).on('click','.countries-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/modules/countries/"+id+"/edit";

});

    /* Gym Update Link at Admin Pannel*/

$(document).on('click','.gym-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/modules/gym/"+id+"/edit";
});

    /* MemberShip-Year-Color Update Link at Admin Pannel*/

$(document).on('click','.membership_year_color-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/modules/membership_year_color/"+id+"/edit";
});

    /* Registration Fees Update Link at Admin Pannel*/

$(document).on('click','.registration_fee-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/modules/registration_fee/"+id+"/edit";
});

$(document).on('click','.registration_types-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/modules/registration_types/"+id+"/edit";
});

$(document).on('click','.registration_years-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/modules/registration_years/"+id+"/edit";
});

/* Contests Update Link at Admin Pannel*/

$(document).on('click','.contest-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/contests/"+id+"/edit";
});

/* about sectuion Update Link at Admin Pannel by KHL */
$(document).on('click','.about_section-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/home_page/about_section/"+id+"/edit";

});

/* testimonial Update Link at Admin Pannel by KHL */
$(document).on('click','.testimonial-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/home_page/testimonials/"+id+"/edit";

});


/* team_members Update Link at Admin Pannel by KHL */
$(document).on('click','.team_members-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/home_page/team_members/"+id+"/edit";

});

/* about_accom_gallery Update Link at Admin Pannel by KHL */
$(document).on('click','.about_accom_gallery-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/about_accommodation/gallery/"+id+"/edit";

});

/* for_accom_content Update Link at Admin Pannel by KHL */
$(document).on('click','.for_accom_content-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/for_accommodation/content/"+id+"/edit";

});


/* blogg Update Link at Admin Pannel by KHL */
$(document).on('click','.blog_post-row',function(){
    var id = $(this).data('id');
    window.location.href = "{{ url('') }}/admin/blog/posts/"+id+"/edit";

});




</script>
<script type="text/javascript">
    jQuery(document).on('click','input[name=is_video]', function(){

        if(jQuery(this).val() == 'yes'){
            //jQuery(".image_area").addClass('hide');
            jQuery(".video_area").removeClass('hide');
            jQuery(".add_more_images").addClass('hide');
            
        }else{

            //jQuery(".image_area").removeClass('hide');
            jQuery(".video_area").addClass('hide');
            jQuery(".add_more_images").removeClass('hide');
        }
    });


    var counter = 0;
jQuery(document).on('click','.add_more_images', function(){
counter++;
    var cloned = jQuery(".clone_me").clone().html();
    var newCloned = '<div class="row remove_me_'+counter+'"><legend><span title="Remove" class="text-danger cursor-pointer" data-toggle="modal" data-target="#removeRecord" onclick="removeRow('+counter+')"><i class="fa fa-remove"></i></span></legend>'+cloned+'</div>';
    jQuery(".cloned_area").append(newCloned);
    setTimeout(function(){
            jQuery('.remove_me_'+counter).find(".is_video_radio_button_area").remove();
            jQuery('.remove_me_'+counter).find(".video_area").remove();
            jQuery('.remove_me_'+counter).find(".available-image-area").remove();
            jQuery('.remove_me_'+counter).find("input[name='title[]']").val('title');
            jQuery('.remove_me_'+counter).find(".col-xs-12:eq(0)").hide();
            jQuery('.remove_me_'+counter).find("input[name='title2[]']").val('title2');
            jQuery('.remove_me_'+counter).find(".col-xs-12:eq(1)").hide();
            jQuery('.remove_me_'+counter).find("textarea[name='description[]']").val('description');
            jQuery('.remove_me_'+counter).find(".col-xs-12:eq(2)").hide();
            jQuery(".is_video_radio_button_area").find("#is_video_no").trigger("click");
                        
        },500);
})

function removeRow(count){

    //if(confirm("Are you sure want to remove this row?")){ 
                

        jQuery("#data-remove-record").attr("onclick","removeRecord("+count+")");
            
    //}

}


function  removeRecord(count){
    
    jQuery(".remove_me_"+count).remove();
    jQuery("button.close").trigger('click');
}



    $(document).on('click', '.delete-rec', function () {
        let id = $(this).data('id');
        let route = $(this).data('route');
        let tableId = $(this).data('tableid');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "This will be deleted permanently!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: route,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            response.success,
                            'success'
                        );
                        $(".delete-rec[data-id='"+id+"']").parents("tr").remove();
                        setTimeout(function(){
                            $("#"+tableId).DataTable().columns.adjust().draw();
                        },500);
                        
                    },
                    error: function () {
                        Swal.fire(
                            'Error!',
                            'Something went wrong.',
                            'error'
                        );
                    }
                });
            }
        });
    });


</script>



@yield('scripts')

</body>
</html>
