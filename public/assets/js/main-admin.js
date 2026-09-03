
$(function(){
	$("select.select2").select2({
        
        placeholder: $("select.select2").data('placeholder'),
    });
});

function showAjaxLoader(){
    $("#loader").show();
    $("#loader").removeClass('hidden');
}

function hideAjaxLoader(){
    $("#loader").hide();
    $("#loader").addClass('hidden');
}

function displayMsg(msgArea, msg, msgType){


    if(typeof msgType == 'undefined'){

        msgType = 'danger';
    }

    msgType = (msgType == 'error') ? 'danger' : msgType;
    var msgIcon = (msgType == 'error' || msgType == 'danger') ? 'error' : 'success';

    if(jQuery('.custom-msg-area').length > 0){

        jQuery('.custom-msg-area').remove();

    }

    if(msgArea.length > 0){

        msgArea.html('<div class="alert alert-'+msgType+'" role="alert">'+msg+'</div>').show();
        $('html, body').animate({ scrollTop: msgArea.offset().top}, 100);

        

    }

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: msgIcon,
        title: msg,
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true
    });

}

function ajaxPostRequest(url,data,successCallback,ajaxErrorCallback,isJson){

    isJson = typeof isJson !== 'undefined' ? isJson : false;

    var ajaxParams = {
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'POST',
        url: $('meta[name="admin_url"]').attr('content')+url,
        data: data,
        dataType: "json",
        contentType: false,
        processData: false,
        success: successCallback,
        error: ajaxErrorCallback,
        
        beforeSend: function() {
            showAjaxLoader();
        }
    }
    var extraParams  = {
           datatype: "json"

        }

    /*if(!isJson){
     
     var extraParams  = {
            contentType: false,
            cache: false,
            processData: false,
        } 
    }

    ajaxParams = Object.assign(extraParams,ajaxParams);

    var moreParams = {
                        success: successCallback,
                        error: ajaxErrorCallback
                    }
    ajaxParams = Object.assign(moreParams,ajaxParams);*/
    $.ajax(ajaxParams)
    .always(function(){     
        hideAjaxLoader();
    });
}

function ajaxPostRequest2(url,data,successCallback,ajaxErrorCallback,isJson){

    isJson = typeof isJson !== 'undefined' ? isJson : false;

    var ajaxParams = {
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: 'POST',
        url: $('meta[name="admin_url"]').attr('content')+url,
        data: data,    
        
        success: successCallback,
        error: ajaxErrorCallback,
        
        beforeSend: function() {
            showAjaxLoader();
        }
    }
    var extraParams  = {
           datatype: "json"

        }

    if(!isJson){
     
     var extraParams  = {
            contentType: false,
            cache: false,
            processData: false,
        } 
    }

    ajaxParams = Object.assign(extraParams,ajaxParams);

    var moreParams = {
                        success: successCallback,
                        error: ajaxErrorCallback
                    }
    ajaxParams = Object.assign(moreParams,ajaxParams);
    $.ajax(ajaxParams)
    .always(function(){     
        hideAjaxLoader();
    });
}




function successCallback(response){
    if(response.success){
    	var targetObj = $("select.time-slot-days-dropdown");
    	targetObj.html(response.html);
    	if(targetObj.hasClass("edit-page")){
    		var val = targetObj.data("default-val");
    		var month = parseInt(targetObj.data("default-month"));
    		
	    	if(response.selected_month == month){
	    		//console.log(response.selected_month , month);
	    		targetObj.val(val);
	    	}
	    	
	    }
    }
}


/*-----CMAX----*/

$(document).on("submit","form#builder-form",function(e){
    e.preventDefault();    
    var frm = $('form#builder-form');
    var formData = new FormData(frm[0]);
    ajaxPostRequest("/builders",formData,builderSuccessCallback,ajaxErrorCallback,true);    

});

$(document).on("submit","form#builder-form-update",function(e){
    e.preventDefault();    
    var builder_id = $('input[name="builder_id"]').val();
    //var formData = $(this).serializeArray();
    var frm = $('form#builder-form-update');
    var formData = new FormData(frm[0]);
    ajaxPostRequest("/builders/"+builder_id,formData,builderSuccessCallback,ajaxErrorCallback,true);    

});

function builderSuccessCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 
        
        setTimeout(function(){            
            displayMsg(msgArea,response.message,msgType);
            $("form#builder-form")[0].reset();
            FilePond.find(document.querySelector('#filepond')).removeFiles();
            $("#uploaded-preview").html('');

        },1000);
    }else{

         displayMsg(msgArea,response.message,msgType);
    }
    
}


$(document).on("submit","form#cmspages",function(e){
    e.preventDefault();   
    var pg_name = $(".pg_name").val();
    var frm = $('form#cmspages');
    var formData = new FormData(frm[0]);
    ajaxPostRequest("/cms-pages/"+pg_name,formData,cmsSuccessCallback,ajaxErrorCallback,true);    

});

function cmsSuccessCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 
        
        setTimeout(function(){     

            displayMsg(msgArea,response.message,msgType);           

        },1000);
    }else{

         displayMsg(msgArea,response.message,msgType);
    }
    
}


$(document).on("submit","form#area-survey-form",function(e){
    e.preventDefault();    
    var frm = $('form#area-survey-form');
    var formData = new FormData(frm[0]);
    ajaxPostRequest("/surveys",formData,surveySuccessCallback,ajaxErrorCallback,true);    

});

$(document).on("submit","form#survey-form-update",function(e){
    e.preventDefault();    
    var survey_id = $('input[name="survey_id"]').val();
    //var formData = $(this).serializeArray();
    var frm = $('form#survey-form-update');
    var formData = new FormData(frm[0]);
    ajaxPostRequest("/surveys/"+survey_id,formData,surveySuccessCallback,ajaxErrorCallback,true);    

});

function surveySuccessCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 
        displayMsg(msgArea,response.message,msgType);
            if(response.action == 'created')  {
                
                $("form#area-survey-form")[0].reset();            
                setTimeout(function(){ 
                    document.location = $('meta[name="admin_url"]').attr('content')+"/surveys";
                },1000);
            }else{
                setTimeout(function(){ 
                    location.reload();
                },1000);
            }            
            
            
    }else{

         displayMsg(msgArea,response.message,msgType);
    }
    
}

$(document).on("submit","form#property-form",function(e){

    e.preventDefault(); 

    var frm = $('form#property-form');
    var formData = new FormData(frm[0]);   

    ajaxPostRequest("/properties",formData,propertySuccessCallback,ajaxErrorCallback,true);       

});

$(document).on("submit","form#property-form-update",function(e){

    e.preventDefault();    
    var id = $('input[name="property_id"]').val();
    var frm = $('form#property-form-update');
    var formData = new FormData(frm[0]); 
    ajaxPostRequest("/properties/"+id,formData,propertySuccessCallback,ajaxErrorCallback,true);

});

function propertySuccessCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if(response.status){
        msgType = 'success'; 
        
        setTimeout(function(){            
            displayMsg(msgArea,response.message,msgType);
            $("form#property-form")[0].reset();
            FilePond.find(document.querySelector('.filepond')).removeFiles();
            $(".uploaded-images").html('');
            console.log('response.property.id:'+response.property.id)
            if(response.property.id){
                document.location=window.cmax.adminUrl+"/properties/"+response.property.id+"/edit";
            }

        },1000);
    }else{

         displayMsg(msgArea,response.message,msgType);
    }
    
}




$(document).on("submit","form#project-form",function(e){
    e.preventDefault(); 

    var frm = $('form#project-form');
    var formData = new FormData(frm[0]);   

    ajaxPostRequest("/projects",formData,projectSuccessCallback,ajaxErrorCallback,true);    

});

$(document).on("submit","form#project-form-update",function(e){
    e.preventDefault();    
    var id = $('input[name="project_id"]').val();
    var frm = $('form#project-form-update');
    var formData = new FormData(frm[0]); 
    ajaxPostRequest("/projects/"+id,formData,projectSuccessCallback,ajaxErrorCallback,true);    

});

function projectSuccessCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 
        
        setTimeout(function(){            
            displayMsg(msgArea,response.message,msgType);
            $("form#project-form")[0].reset();
            FilePond.find(document.querySelector('.filepond')).removeFiles();
            $(".uploaded-images").html('');
            if(response.project.id){
                document.location=window.cmax.adminUrl+"/projects/"+response.project.id+"/edit";
            }

        },1000);
    }else{

         displayMsg(msgArea,response.message,msgType);
    }
    
}


function ajaxErrorCallback(response) {
    hideAjaxLoader();
    var msgArea = $('.ajax-msg');
    var msgType = 'error';

    // 1. Check if a draft project was created despite the error
    if (response.responseJSON && response.responseJSON.project && response.responseJSON.project.id) {
        var projectId = response.responseJSON.project.id;
        
        // Show a temporary message so the user knows what's happening
        displayMsg(msgArea, "Validation failed. Saving progress as draft and redirecting...", "error");

        // 2. Redirect to the edit page after a short delay
        // Replace '/admin/projects/' with your actual route prefix
        setTimeout(function() {
            window.location.href = '/admin/projects/' + projectId + '/edit';
        }, 2000); 
        
        return; // Stop further error processing
    }

    // Standard Error Handling logic below
    if (response.responseJSON && response.responseJSON.errors) {
        let errors = response.responseJSON.errors;
        let html = '<ul>';
        $.each(errors, function (key, value) {
            html += `<li>${value[0]}</li>`;
        });
        html += '</ul>';
        displayMsg(msgArea, html, msgType);
    } else {
        var msg = (response.responseJSON && response.responseJSON.message) 
                  ? response.responseJSON.message 
                  : 'Server Error!';
        displayMsg(msgArea, msg, msgType);
    }
}

function ajaxErrorSweetAlert(response){

    hideAjaxLoader();
   
    var msgType = 'error';

    if (response.responseJSON && response.responseJSON.errors){
        let errors = response.responseJSON.errors;       
        let html = '<ul >';
        $.each(errors, function (key, value) {
            html += `<li>${value[0]}</li>`;
        });
        html += '</ul>';
        displayMsg('',html,msgType);         
        
    }else{

        displayMsg('','Server Error!',msgType);
    }
}

$(document).on("change","select#area_id",function(e){
    e.preventDefault();    
    var area_id = $(this).val();
     $("#main_area_id").val(area_id);
     $(".area-title").val($("select#area_id option:selected").text());
    //var formData = new FormData(frm[0]); 
    ajaxPostRequest("/get-sub-area/"+area_id,[],subAreaSuccessCallback,ajaxErrorCallback,true);    

});

function subAreaSuccessCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 

        $('select#sub_area_id').empty();

        // Add placeholder again if needed
        $('select#sub_area_id').append('<option value=""></option>');
        
   
        response.subAreas.forEach(function(item){
           
             $('select#sub_area_id').append(new Option(item.name, item.id, false, false));
        });

        $('select#sub_area_id').trigger('change');

        //$('select#sub_area_id').html(options).show();

    }else{

         displayMsg(msgArea,response.message,msgType);
    }
}


FilePond.registerPlugin(
    //FilePondPluginImagePreview,
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType
);

// Create pond instance
FilePond.setOptions({
        allowMultiple: false,
        maxFileSize: '10MB',
        acceptedFileTypes: ['image/*'],
        server: {
            process: {
                url: '/admin/media/upload',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                onload: function (res) { 
                    //console.log(res)
                    const data = JSON.parse(res);
                    var preview_id = 'uploaded-preview';
                    if(data.mediaKey == 'project_gallery' || data.mediaKey == 'property_gallery'){
                        preview_id = 'gallery-preview';
                    } else if(data.mediaKey == 'payment_plan'){
                        preview_id = 'payment-preview';
                    } else if(data.mediaKey == 'project_progress'){
                        preview_id = 'project-progress-preview';
                    }
                    
                    const inputElement = document.getElementById(preview_id); // Works now

                    if (!inputElement) return; // Just in case

                    const collection = inputElement.dataset.collection || 'default';

                    // Hidden input
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = `media_ids[${collection}][]`;
                    hidden.value = data.id;
                    inputElement.closest('form').appendChild(hidden);
                    console.log('data.id:',data.id)
                    // Preview container
                    const previewContainerId = inputElement.dataset.preview;
                    if (previewContainerId) {
                        const container = document.getElementById(previewContainerId);
                        if (container) {
                            const wrapper = document.createElement('div');
                            wrapper.classList.add('media-item');
                            wrapper.classList.add('preview-box');                           
                            wrapper.classList.add('remove-media');
                            wrapper.dataset.mediaId = data.id;
                            wrapper.dataset.id = data.id;

                            const img = document.createElement('img');
                            img.src = data.url;

                            const link = document.createElement('a');
                            link.href = data.url;
                            link.target = "_blank"; // opens in new tab
                            link.setAttribute("data-fancybox", preview_id);
                            link.appendChild(img);

                            

                            const removeBtn = document.createElement('span');
                            removeBtn.classList.add('remove-media');
                            removeBtn.innerText = 'Remove';

                            /*removeBtn.onclick = function () {
                                wrapper.remove();
                                const hiddenInputs = document.querySelectorAll(`input[name="media_ids[${collection}][]"][value="${data.id}"]`);
                                hiddenInputs.forEach(i => i.remove());
                            };*/

                            const thumb = document.createElement('div');
                            thumb.classList.add('media-thumb');
                            thumb.appendChild(link);
                            console.log('preview_id:',preview_id)
                            if(preview_id == 'gallery-preview'){
                                // Create radio input
                                const radio = document.createElement('input');
                                radio.type = 'radio';
                                radio.name = 'featured_image'; // same name for group
                                radio.value = data.id; // set value according to your logic

                                // Create label
                                const label = document.createElement('label');
                                label.classList.add('form-label');
                                label.classList.add('featured-image-checkbox-label');
                                label.textContent = ' Set Featured';
                                label.prepend(radio); // put radio before text

                                // Append to thumb
                                thumb.appendChild(label);
                            }

                            const actions = document.createElement('div');
                            actions.classList.add('media-remove');
                            actions.appendChild(removeBtn);
                            thumb.appendChild(removeBtn);

                            wrapper.appendChild(thumb);
                            wrapper.appendChild(actions);
                            container.appendChild(wrapper);

                           
                        }
                    }

                    return data.id;
                }
            },
            revert: {
                url: '/admin/upload-temp-revert',
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }
        },

        onremovefile: (file,file2, file3) => {
            /*var mediaId = file2.source;
            if(typeof mediaId === 'number' && !isNaN(mediaId) && mediaId !== null){
                console.log(mediaId);
                document.querySelector(`.remove-media[data-media-id="${mediaId}"]`)?.remove();
                addDeletedFile(mediaId);
            }*/
                       
        }

        
});

FilePond.parse(document.body);


function addUploadedFile(filePath) {
        const field = document.getElementById('uploaded-files');
        let val = field.value ? JSON.parse(field.value) : [];
        val.push(filePath);
        field.value = JSON.stringify(val);
}

function addDeletedFile(mediaId) {
    const field = document.getElementById('deleted-files');
    let val = field.value ? JSON.parse(field.value) : [];
    val.push(mediaId);
    field.value = JSON.stringify(val);
}


function deleteUploadedFile(mediaId){

        // Send request to delete the media file
        fetch(`/admin/media/${mediaId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            //console.log('Media deleted:', data);
        })
        .catch(err => {
            console.error('Error deleting media:', err);
        });
    

}

$(document).on('click', 'span.remove-media', function(){
    var mediaId = $(this).parents('.preview-box').data('media-id');

    Swal.fire({
        title: 'Are you sure?',
        text: "The media will be deleted after you save the record.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            if(typeof mediaId === 'number' && !isNaN(mediaId) && mediaId !== null){
                
                addDeletedFile(mediaId);
                $(this).parents('.preview-box').remove();
            }
        }
    });
    
});


$(document).on("change", "select#property_type", function(){

    if($(this).val() == 'home'){

        $(".category-home").show();
        $(".amenity-home").show();
        $(".amenity-plot").hide();
        $(".amenity-commercial").hide();
        $(".category-commercial").hide();
        $(".amenity-apartment").hide();
        $(".category-apartment").hide();

    }else if($(this).val() == 'plot'){

        $(".amenity-plot").show();
        $(".category-plot").show();
        $(".amenity-home").hide();
        $(".category-home").hide();
        $(".amenity-commercial").hide();
        $(".category-commercial").hide();
        $(".amenity-apartment").hide();
        $(".category-apartment").hide();


    }else if($(this).val() == 'commercial'){

        $(".amenity-commercial").show();
        $(".category-commercial").show();
        $(".amenity-plot").hide();
        $(".amenity-home").hide();
        $(".category-plot").hide();
        $(".category-home").hide();
        $(".amenity-apartment").hide();
        $(".category-apartment").hide();
        
    }else if($(this).val() == 'apartment'){

        $(".amenity-apartment").show();
        $(".category-apartment").show();
        $(".amenity-commercial").hide();       
        $(".category-commercial").hide();
        $(".amenity-plot").hide();
        $(".amenity-home").hide();
        $(".category-plot").hide();
        $(".category-home").hide();
        
    }

});

function renderStatusBadge(is_active) {
    if (is_active === 1) {
        return '<span class="badge bg-success">Active</span>';
    } else {
        return '<span class="badge bg-danger">Inactive</span>';
    }
}


$(document).on("click",".updateStatus",function(e){
    e.preventDefault();
    var model_id = $(this).data("id");
    var model_name = $(this).data("model-name");
    var status = $(this).data("status");
    var status_type = $(this).data("status-type");
    var status_label = $(this).data("status-label");
    
    let $badge = $(this).children('.badge');
    var msgArea = '';
    showAjaxLoader();
    $.ajax({
        url: "/admin/"+model_name+"/update-status",
        type: "GET",
        data: {model_id:model_id,status:status,status_type:status_type},
        success: function(response) {
            //console.log(response.status);
            if(response.status == 'success'){
                //console.log($(this).children('.badge'));
                

                if ($badge.hasClass('bg-danger')) {
                    if(status_type == 'is_active' ){
                        status_label = 'Active';
                        
                    }else{
                        status_label = 'Yes';
                        
                    }
                    status = 1;
                    $badge.removeClass('bg-danger').addClass('bg-success').text(status_label);
                   
                } else {
                    if(status_type == 'is_active' ){
                        status_label = 'Deactive';
                        
                    }else{
                        status_label = 'No';
                       
                    }
                    status = 0;
                    $badge.removeClass('bg-success').addClass('bg-danger').text(status_label);
                }

                $(this).attr("data-status",status);
                $(this).attr("data-status-label",status_label);
                $(this).attr("title","Click to"+status_label);
                
                displayMsg(msgArea,response.message,'success');
                
            }
            hideAjaxLoader();
            
        },
        error: function(){
            displayMsg(msgArea,'Error occurred while updating status!','success');
        },
        always:function(){
            hideAjaxLoader();
        }
    });
});


$(document).on("submit","form#areaForm",function(e){
    e.preventDefault();    

    var msgArea = $(".ajax-msg-area");
    var frm = $('form#areaForm');
    var formData = new FormData(frm[0]);

    showAjaxLoader();
    $.ajax({
        url: "/admin/areas",
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false, 
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
            mainAreaSuccessCallback(data)
            hideAjaxLoader();
        },
        error: ajaxErrorSweetAlert,
        always: function(){
            hideAjaxLoader();
        }
    });    

});


function mainAreaSuccessCallback(response){

    var  msgArea = $('.ajax-msg-area');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 

        let newOption = new Option(response.area.name, response.area.id, true, true);
        //setTimeout(function(){
            //console.log(newOption);
            $('#area_id').append(newOption).trigger('change'); // Add and select
            $(".area-title").val($("select#area_id option:selected").text());
        //},3000);
        $('#areaModal').modal('hide'); // Close modal
        $('#areaForm')[0].reset(); // Reset form
        

    }else{
        
         displayMsg(msgArea,response.message,msgType);
    }

    hideAjaxLoader();
}



$(document).on("submit","form#subAreaForm",function(e){
    e.preventDefault();    

    var msgArea = $(".ajax-msg-area");
    var frm = $('form#subAreaForm');
    var formData = new FormData(frm[0]);

    showAjaxLoader();
    $.ajax({
        url: "/admin/sub-areas",
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false, 
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
            subAreaSuccessRecord(data)
            hideAjaxLoader();
        },
        error: ajaxErrorSweetAlert,
        always: function(){
            hideAjaxLoader();
        }
    });    

});


function subAreaSuccessRecord(response){

    var  msgArea = $('.ajax-msg-sub-area');
    var msgType = 'error';

    if(response.status && response.status == 'success'){
        msgType = 'success'; 

        let newOption = new Option(response.subarea.name, response.subarea.id, true, true);
        $('select#sub_area_id').append(newOption).trigger('change'); // Add and select
        //$("#main_area_id").append(newOption).trigger('change');

        $('#subAreaModal').modal('hide'); // Close modal
        $('#sub-area-name').val(''); // Reset form
        
        displayMsg('','Sub Area Added Successfully!',msgType);
    }else{
        
         displayMsg(msgArea,response.message,msgType);
    }

    hideAjaxLoader();
}

$(document).on("change", "[name='featured_image']", function () {
    $("#featured_media_id").val($(this).val());
    /* var media_id = $(this).val();
    showAjaxLoader();
    fetch(`/admin/media/${media_id}/set-featured`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        })
    })
    .then(res => res.json())
    .then(response => {
        if (response.success) {
            
            displayMsg('',response.message,'success');
        } else {
            displayMsg('','⚠ Failed to set featured image','danger');
        }
        hideAjaxLoader();
    })
    .catch(err => console.error('❌ Error:', err)); */
});

$(document).on('click', 'a.refresh_project', function(){
    var project_id = $(this).data('project_id');

    Swal.fire({
        title: 'Are you sure you want to refresh this project?',
        text: "The porject will be refrehsed for one month period.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#146c43',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Refresh it!'
    }).then((result) => {
        if (result.isConfirmed) {
            if(typeof project_id === 'number' && !isNaN(project_id) && project_id !== null){
                
                document.location=$('meta[name="admin_url"]').attr('content')+"/projects/"+project_id+"/refresh";
            }
        }
    });
    
});

$(document).on('click', 'a.remove_refresh_project', function(){
    var project_id = $(this).data('project_id');

    Swal.fire({
        title: 'Are you sure you want to clear this project from refreshed list?',
        text: "The porject will be clear from refreshed list.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Clear from Refresh!'
    }).then((result) => {
        if (result.isConfirmed) {
            if(typeof project_id === 'number' && !isNaN(project_id) && project_id !== null){
                
                document.location=$('meta[name="admin_url"]').attr('content')+"/projects/"+project_id+"/refresh";
            }
        }
    });
    
});

$('#search-area').on('keyup', function(e){
    e.preventDefault(); 
    var query = $(this).val();
    var data = {query:query};

    //ajaxPostRequest("/search-area",data,searchAreaCallback,ajaxErrorCallback,true);
    $('#suggestions').html('<i class="fa fa-spinner fa-spin"></i>').show();
    var formData = {query:query};
    //showAjaxLoader();
    $.ajax({
        url: "/search-area",
        type: "GET",
        data: formData,
        dataType: "json",
        //contentType: false,
        //processData: false, 
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
            searchAreaCallback(data);
            //hideAjaxLoader();
        }
    });
});

// When clicking a suggestion
$(document).on('click', '.suggestion-item', function(){
    $('#search-area').val($(this).text());
    $('#suggestions').hide();
});

// Hide if clicked outside
$(document).click(function(e) {
    if (!$(e.target).closest('#search-area, #suggestions').length) {
        $('#suggestions').hide();
    }
});

function searchAreaCallback(response){
    var  msgArea = $('.ajax-msg');
    var msgType = 'error';
    
        msgType = 'success'; 

        let suggestions = '';
        response.forEach(function(item){
            suggestions += '<div class="suggestion-item" style="padding:5px; cursor:pointer; font-size:11px;">'+item+'</div>';
        });
        $('#suggestions').html(suggestions).show();
    

    if(typeof response.errors !== 'undefined'){
        $(response.errors).each(function(i,o){
             displayMsg(msgArea,o,msgType);
        });
    }else{
        //displayMsg(msgArea,response.msg,msgType);
    }
}

$(document).on('click', 'a.remove_file', function(){
    var id = $(this).data('id');
    var path = $(this).data('path');

    Swal.fire({
        title: 'Are you sure you want to remove this file?',
        text: "The file will be removed from disk.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Remove!'
    }).then((result) => {
        if (result.isConfirmed) {
            if(path !== null){
                
                document.location=path;
            }
        }
    });
    
});

$(function(){
    $('#datepicker').datepicker({
        todayHighlight:true,
        startDate:'-5y',
        format: "yyyy-mm-dd",
        default: 'yyyy-mm-dd',
        autoclose: true
        /*beforeShowDay: function(date){                            
            var formattedDate = formatDate(date);                            
            if ($.inArray(formattedDate.toString(), available_Dates) == -1){
                return {
                    enabled : false
                };
            }
            return;
        }*/
    });

    var existingDate = $('#survey_date').val();
    console.log('existingDate:',existingDate);
    if (existingDate) {
        
        $('#datepicker').datepicker('setDate', existingDate);
    }

    $('#datepicker').datepicker().on('changeDate', function(e) {
        var selectedDate = e.format(0,"yyyy-mm-dd");
        $("input#survey_date").val(selectedDate);   

        
    });
});

$(document).ready(function() {
    let gallery_preview = document.getElementById('gallery-preview');
    if($("#gallery-preview").length > 0){
        Sortable.create(gallery_preview, {
            animation: 150,
            onEnd: function (evt) {
                var order = [];

                $('#gallery-preview .media-item').each(function(index) {
                    order.push({
                        id: $(this).data('id'),
                        position: index + 1
                    });
                });

                updateMediaPosition(order);
            }
        });
    }

    let progress_preview = document.getElementById('project-progress-preview');
    if($("#project-progress-preview").length > 0){
        Sortable.create(progress_preview, {
            animation: 150,
            onEnd: function (evt) {
                var order = [];

                $('#project-progress-preview .media-item').each(function(index) {
                    order.push({
                        id: $(this).data('id'),
                        position: index + 1
                    });
                });

                updateMediaPosition(order);
            }
        });
    }

    let payment_preview = document.getElementById('payment-preview');
    if($("#payment-preview").length > 0){
        Sortable.create(payment_preview, {
            animation: 150,
            onEnd: function (evt) {
                var order = [];

                $('#payment-preview .media-item').each(function(index) {
                    order.push({
                        id: $(this).data('id'),
                        position: index + 1
                    });
                });

                updateMediaPosition(order);
            }
        });
    }
    
});


function updateMediaPosition(order){
    console.log('order:',order);
    // Send AJAX to backend
    $.ajax({
        url: $('meta[name="admin_url"]').attr('content')+'/media/reorder',
        method: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            order: order
        },
        success: function(response) {
            displayMsg('','Reorder saved','success');
            console.log('Reorder saved');
        },
        error: function(xhr) {
            displayMsg('','Error saving order:'+ xhr.responseText,'error');
            console.error('Error saving order:', xhr.responseText);
        }
    });
}


// this is using in properties add/update section

jQuery(document).on("change", "input[name='listing_type']", function(){

    if($(this).val() == 'builder'){
        $(".builder-info").removeClass("display-none");
    }else{       
        $(".builder-info").addClass("display-none");
    }
});

jQuery(document).on('change','input.property-purpose', function() {
    // Radio button ki selected value check karein
    var selectedPurpose = jQuery('input.property-purpose:checked').val();


    if (selectedPurpose && selectedPurpose.toLowerCase() === 'rent') {
        jQuery('.property-price').text('Monthly Rent (PKR)*');
        jQuery('.installment-area').hide();
        jQuery('.rfp-area').hide();
    } else {
        jQuery('.property-price').text('Price (PKR)*');
        jQuery('.installment-area').show();
        jQuery('.rfp-area').show();
    }
});