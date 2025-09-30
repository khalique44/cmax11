
function formatDate(date,format)
    {
        format = (typeof format !== 'undefined') ? format : 'dd/mm/yyyy';
        //date = new Date(d)
        var dd = date.getDate(); 
        var mm = date.getMonth()+1;
        var yyyy = date.getFullYear(); 
        if(dd<10){dd='0'+dd} 
        if(mm<10){mm='0'+mm};
        if(format == 'dd/mm/yyyy'){
            return d = dd+'/'+mm+'/'+yyyy;
        } else if(format == 'yyyy/mm/dd'){
            return d = yyyy+'/'+mm+'/'+dd;
        }
    }

function showAjaxLoader(){
    $("#loader").show();
    $("#loader").removeClass('hidden');
}

function hideAjaxLoader(){
    $("#loader").hide();
    $("#loader").addClass('hidden');
}

var datePicker = '';
function loadDatePicker(available_dates){
 // available_dates = (JSON.parse((available_dates)));
  $("div#datepicker2").datepicker({

    todayHighlight:true,
    startDate:'now',
    format: "dd/mm/yyyy",
    default: 'dd/mm/yyyy',
    autoclose: true,
    weekStart: 1,
    language : 'sw'
    /*beforeShowDay: function(date){                           
      var formattedDate = formatDate(date);     
             
      if ($.inArray(formattedDate.toString(), (available_dates)) == -1){
        return {
            enabled : false
        };
      }
      return;      
    }*/
  });
}

$(document).on('changeDate',"div#datepicker2", function(e) {
    var selectedDate = e.format(0,"dd/mm/yyyy");
    $("input.booking_date").val(selectedDate);
    var laundry_number = $("select.laundry_number").val();
    //var selectedDateHidden = e.format(0,"yyyy/mm/dd");
    //$("input.hidden_booking_date").val(selectedDateHidden);
    ajaxPostRequest("/laundry_booking/get_timeslots",{ 'selectedDate':selectedDate,laundry_number:laundry_number },successCallback,true);
    
});

function ajaxPostRequest(url,data,successCallback,ajaxErrorCallback,isJson){

    isJson = typeof isJson !== 'undefined' ? isJson : false;
    var contentType = false;
    var processData = false;

    if(!isJson){       
    
        console.log('isJson:',isJson,'contentType:',contentType,'processData:',processData);
        var ajaxParams = {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            url: $('meta[name="home_url"]').attr('content')+url,
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

    }else{

        //console.log('isJson:',isJson,'contentType:',contentType,'processData:',processData);
        var ajaxParams = {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            url: $('meta[name="home_url"]').attr('content')+url,
            data: data,
            dataType: "json",       
            success: successCallback,
            error: ajaxErrorCallback,
            
            beforeSend: function() {
                showAjaxLoader();
            }
        }
    }   


    $.ajax(ajaxParams)
    .always(function(){     
        hideAjaxLoader();
    });
}


function successCallback(response) {     
    $('select.booking_time').html(response.html); 
}

function ajaxErrorCallback(response){

    var  msgArea = $('.ajax-msg');
    var msgType = 'error';

    if (response.responseJSON && response.responseJSON.errors){
        let errors = response.responseJSON.errors;       
        let html = '<ul >';
        $.each(errors, function (key, value) {
            html += `<li>${value[0]}</li>`;
        });
        html += '</ul>';
        displayMsg(msgArea,html,msgType);         
        
    }else{

        displayMsg(msgArea,'Server Error!',msgType);
    }
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



        msgArea.html('<div class="alert alert-'+msgType+' alert-dismissible fade show" role="alert">'+msg+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').show();
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


$(document).ready(function(){
    $("select.select2").select2();
    /*$('#search-box').on('keyup', function(){
        var query = $(this).val();
        if(query.length > 1){
            $.ajax({
                url: '/search', // Your backend route here
                type: 'GET',
                data: { q: query },
                success: function(data){
                    let suggestions = '';
                    data.forEach(function(item){
                        suggestions += '<div class="suggestion-item" style="padding:5px; cursor:pointer;">'+item+'</div>';
                    });
                    $('#suggestions').html(suggestions).show();
                }
            });
        } else {
            $('#suggestions').hide();
        }
    });*/

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


    $('#subscriptionForm').on('submit', function(e){
        e.preventDefault();
        showAjaxLoader();
        $.ajax({
            url: "/subscribe",
            type: "POST",
            data: $(this).serialize(),
            success: function(response){
                if(response.success){
                    displayMsg($('#subscribe-message'),response.message,'success');
                   
                    $('#subscriptionForm')[0].reset();
                }
                hideAjaxLoader();
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                if(errors && errors.email){
                    displayMsg($('#subscribe-message'),errors.email[0],'danger');
                   
                }
                hideAjaxLoader();
            },
            always:function(){
                hideAjaxLoader();
            }
        });
    });

    $('#contactForm').on('submit', function (e) {
        e.preventDefault();
        showAjaxLoader();

        $.ajax({
            url: $('meta[name="home_url"]').attr('content')+"/contact-submit", // your route
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                
                displayMsg($('.contact-ajax-message'),response.message,'success');
                $('#contactForm')[0].reset();
                hideAjaxLoader();
            },
            error: function (xhr) {
               
                    displayMsg($('.contact-ajax-message'),'Something went wrong!','danger');                  
                
                    hideAjaxLoader();
            },
            always:function(){
                hideAjaxLoader();
            }
        });
    });



    $('#propertyForm').on('submit', function (e) {
        e.preventDefault();
        showAjaxLoader();
        $.ajax({
            url: $('meta[name="home_url"]').attr('content')+"/property-submit",
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                displayMsg($('.property-ajax-message'),response.message,'success');
                $('#propertyForm')[0].reset();
                hideAjaxLoader();
                
            },
            error: function () {
                displayMsg($('.property-ajax-message'),'Something went wrong!','danger');     
                
                hideAjaxLoader();
            },
            always:function(){
                hideAjaxLoader();
            }
        });
    });



});





// -------------------CMAX code by Rafique ------------------ //

// Function to add or remove "scrolled" class based on scroll position
function toggleScrolledClass() {
    if (window.scrollY > 0) {
        document.body.classList.add('scrolled');
    } else {
        document.body.classList.remove('scrolled');
    }
}
// Event listener for scroll event
window.addEventListener('scroll', toggleScrolledClass);

// For Counter
$(document).ready(function () {

    $('.counter').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

});

// Testomonial Carousel Logo
$('.testo-caro').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    dots: false,
    prevArrow: false,
    nextArrow: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
 })

//  AOS Animation
AOS.init({
    once: true
});

$(document).ready(function(){
    $('.btn-showgal').on('click', function(e){
        e.preventDefault();
        $('a[data-lightbox="gallery-group"]').first().click();
    });
});
$(document).ready(function(){
    var navbar = $('#navbar-example2');
    if(navbar.length > 0){

        var stickyOffset = navbar.offset().top;

        $(window).scroll(function(){
            if ($(window).scrollTop() >= stickyOffset) {
                navbar.addClass('sticky-nav');
                if (!$('.placeholder').length) {
                    navbar.before('<div class="placeholder"></div>');
                }
            } else {
                navbar.removeClass('sticky-nav');
                $('.placeholder').remove();
            }
        });

    }
    


});

$(document).on('click','.dropdown-price-range-toggle', function(){
    $('.dropdown-price-range-menu').slideToggle();
});

var slider = document.getElementById('slider');
if(slider){
    noUiSlider.create(slider, {
        start: [500000, 5000000],
        connect: true,
        range: {
            'min': 50000,
            'max': 5000000
        }
    });
    slider.noUiSlider.on('update', function (values, handle) {
        document.getElementById('slider-value-lower').innerText = Math.round(values[0]);
        document.getElementById('slider-value-upper').innerText = Math.round(values[1]);
    });
}


$(document).ready(function() {

    

    // Filter form submit
    $('#filter-form').on('change', 'select, input', function(e) {
        e.preventDefault();
        
            fetchProjects();
        
    });

    // Pagination link click
    /*$(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        if($(this).parents(".blog-posts").length > 0){
            
            fetchPosts(page)
        }else{
            fetchProjects(page);
        }
    });*/

    $(document).on('change','#minPrice, #maxPrice', function() {
        var min = parseInt($('#minPrice').val()) || 0;
        var max = parseInt($('#maxPrice').val()) || 0;

        if (min > max) {
            $('#priceError').text('Max price must be greater than Min price!');
        } else {
            $('#priceError').text('');
        }
    });

    $(document).on('change','#minInstallment, #maxInstallment', function() {
        var min = parseInt($('#minInstallment').val()) || 0;
        var max = parseInt($('#maxInstallment').val()) || 0;

        if (min > max) {
            $('#installmentError').text('Max installment must be greater than Min installment!');
        } else {
            $('#installmentError').text('');
        }
    });

    $('.toggle-description').on('click', function () {
        var container = $(this).closest('.description-container');
        var shortDesc = container.find('.short-description');
        var fullDesc = container.find('.full-description');

        if (fullDesc.is(':visible')) {
            fullDesc.hide();
            shortDesc.show();
            $(this).text('Show more');
        } else {
            fullDesc.show();
            shortDesc.hide();
            $('html, body').animate({ scrollTop: $('.toggle-description').offset().top}, 100);
            $(this).text('Show less');
        }
    });

    // handle compare select box

    $('.compare-select-box').select2({
        maximumSelectionLength: 4
      });

});



function fetchProjects(page = 1) {
    var formData = $('#filter-form').serialize() + '&page=' + page;
    showAjaxLoader();
    $.ajax({
        url: $('meta[name="home_url"]').attr('content')+"/projects/search-results",
        type: "GET",
        data: formData,
        success: function(data) {
            $('#project-list').html(data);
            hideAjaxLoader();
        }
    });
}





function fetchPosts(page = 1) {
    var formData = 'page=' + page;
    showAjaxLoader();
    $.ajax({
        url: $('meta[name="home_url"]').attr('content')+"/blog",
        type: "GET",
        data: formData,
        success: function(data) {
            $('#blog-posts-list').html(data);
            hideAjaxLoader();
        }
    });
}

// Pagination link click
$(document).on('click', '.page-item  a.page-link', function(e) {


    
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    console.log('length:',$(this).parents(".blog-posts").length);
    if($(this).parents(".blog-posts").length > 0){
        
        fetchPosts(page)
    }else{
        fetchProjects(page);
    }
    
});


document.addEventListener("DOMContentLoaded", function () {
    const compareBox = document.getElementById("compare-box");
    const compareItems = document.getElementById("compare-items");

    // Add project to compare
    document.querySelectorAll(".addToCompare").forEach(btn => {
        btn.addEventListener("click", function () {
            showAjaxLoader();
            let id = this.dataset.id;
            let title = this.dataset.title;
            let formData = new FormData();
            formData.append("id", id);

            fetch("/compare/add", {
                method: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                body: formData,
                //data: {id:id}
            })
            .then(res => res.json())
            .then(data => {
                console.log(data.status);
                if (data.status === "success") {                    

                    document.location = "/compare";

                } else {
                    alert(data.message);
                }
                hideAjaxLoader();
            });
        });
    });





    // Expose removeCompare globally
    //window.removeCompare = removeCompare;
});

// Remove project
function removeCompare(id) {

    showAjaxLoader();    

    $.ajax({
        url: $('meta[name="home_url"]').attr('content')+"/compare/remove",
        type: "POST",
        data: {id:id},
        dataType: "json",
        //contentType: false,
        //processData: false, 
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
            location.reload();
            hideAjaxLoader();
        }
    });
}

function addCompareMultiple() {

    showAjaxLoader();   
    var ids = $("select.compare-select-box").val();

    $.ajax({
        url: $('meta[name="home_url"]').attr('content')+"/compare/add-multiple",
        type: "POST",
        data: {ids:ids},
        dataType: "json",
        //contentType: false,
        //processData: false, 
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
            if(data.status == 'success'){
                displayMsg('','Project added to compare.','success')
                location.reload();
            }else{
                displayMsg('',data.message,'error')
            }        
            
            
        },
        error: function(){
            displayMsg('','Server Error! Please reload and try again.','error')
        },
        always: function(){
            hideAjaxLoader();
        }
    });
}


