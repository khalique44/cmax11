<?php
if(isset($_REQUEST['submit'])){
        function processAPI($details)
    {

        $date = date("Y-m-d");
        $url = $_SERVER['HTTP_REFERER'];

        $data['fields'] = [
                    'TITLE'             =>  $details['name'],
                    'NAME'              =>  $details['name'],
                    'UF_CRM_1598271697' =>  $details['project'], 
                    'UF_CRM_1598273020' =>  599,  //state -- 599 (sindh)
                    'UF_CRM_1598273144' =>  731,  //city -- 731 (karachi)
                    'UF_CRM_1598272424' =>  $details['address'],  //area / locality
                    'UF_CRM_1599590735' =>  $details['interested'],  //interested in
                    'UF_CRM_1599654625' =>  $details['type'] == 'other' ? 1 : '', //other
                    'UF_CRM_1599654668' =>  $details['type'] == 'agent' ? 1 : '', //agent
                    'UF_CRM_1599654648' =>  $details['type'] == 'buyer' ? 1 : '', //buyer
                    'ASSIGNED_BY_ID'    =>  1,
                    //'COMMENTS'          =>  $details['message'],
                    'SOURCE_ID'         =>  2,
                    'UF_CRM_1600090315' =>  1,
                    'UF_CRM_1598964152' => $url, //Lead URL
                    'UF_CRM_1615931499915'=>$details['interested1'],
                    'UTM_SOURCE'=>$details['utm'],
                      'UF_CRM_1682602535194'=>$details['profession'],
                    'UF_CRM_1682605990889'=>$details['otherprofession'],
                    'UF_CRM_1682606196912'=>$details['purposeofbuying'],
                   // 'UF_CRM_1682606363687'=>$details['availabledownpayment'],
                    'UF_CRM_1682606447987'=>$details['totalbudget'],
                    'UF_CRM_1682606505543'=>$details['ownproperty'],
                ];
      // print_r( $data['fields']);die;
        $data['fields']['PHONE'] = [
            ["VALUE" => $details['phone'], "VALUE_TYPE" => 'WORK']
        ];

        $data['fields']['EMAIL'] = [
            ["VALUE" => $details['email'], "VALUE_TYPE" => 'WORK']
        ];


        $data['filter'] = [
                'PHONE'             =>  $details['phone'],
              // 'UF_CRM_1598271697'     => $details['project'],
                ///'EMAIL'             =>  $details['email']
        ];

        $data['select'] = ["UF_CRM_1600090315","ID"];

        $queryData      = http_build_query($data);
        
        $result_data= sendCurlRequest($queryData,"list","crm.lead");

        if( !empty( $result_data['result'][0]['ID'] ) ){

            $count = $result_data['result'][0]['UF_CRM_1600090315'] + 1;

            $data['ID']     = $result_data['result'][0]['ID'];
            $data['fields'] = [
                'UF_CRM_1600090315' => $count
            ];

            $queryData      = http_build_query($data);

            $result_data= sendCurlRequest($queryData,"update","crm.lead");

        } else {
           // print_r($data);die;
            $result_data= sendCurlRequest($queryData,"add","crm.lead");
            
        }
        
        return $result_data['result'];
    }

    function sendCurlRequest($queryData, $action, $method="crm.lead")
    {
        $endpoint = "https://cmax.bitrix24.com/rest/1/2pfw62cxmk22tti0/";
        
        $queryUrl              = $endpoint."/$method.$action/";
        $curl                  = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST           => 1,
            CURLOPT_HEADER         => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL            => $queryUrl,
            CURLOPT_POSTFIELDS     => $queryData,
        ]);

        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, 1);

    }
     $data['name'] = !empty($_POST['name']) ? $_POST['name'] : '';
        $data['phone'] = !empty($_POST['phone']) ? '+92'.$_POST['phone'] : '';
        $data['email'] = !empty($_POST['email']) ? $_POST['email'] : '';
        $data['address'] = !empty($_POST['address']) ? $_POST['address'] : '';
       // $data['message'] = !empty($_POST['message']) ? $_POST['message'] : '';
        $data['project'] = !empty($_POST['project']) ? $_POST['project'] : '';
        $data['locality'] = !empty($_POST['locality']) ? $_POST['locality'] : '';
        $data['type'] = !empty($_POST['type']) ? $_POST['type'] : '';
        $interested = !empty($_POST['interestedin']) ? $_POST['interestedin'] : '';
        
        $data['interested'] = [];

        if(!empty($interested)){
            $interestedArray = [
                'Studio'                =>  823,
                '1 Bedroom'             =>  825,
                '2 Bedroom'             =>  827,
                '3 Bedroom'             =>  829,
                '4 Bedroom'             =>  837,
                '5 Bedroom'             =>  839,
                '6 Bedroom'             =>  841,
                'Penthouse'             =>  843,
                'Duplex'                =>  845,
                '120 Single Storey'     =>  847,
                '120 One Unit'          =>  849,
                '160 Single Storey'     =>  851,
                '160 One Unit'          =>  853,
                '200 Classic'           =>  855,
                '240 One Unit'          =>  857,
                '500'                   =>  859,
                '1000'                  =>  861,
                'Ground'                =>  863,
                'First'                 =>  865,
                'Second'                =>  867,
                'Third'                 =>  869,
                '120 Sq. Yd.'           =>  871,
            ];
        }
        $data['interested1']=$interested;
        $data['interested'] = $interestedArray[$interested];
         $data['profession'] = !empty($_POST['profession']) ? $_POST['profession'] : '';
        $data['otherprofession'] = !empty($_POST['otherprofession']) ? $_POST['otherprofession'] : '';
        $data['purposeofbuying'] = !empty($_POST['purposeofbuying']) ? $_POST['purposeofbuying'] : '';
       // $data['availabledownpayment'] = !empty($_POST['availabledownpayment']) ? $_POST['availabledownpayment'] : '';
        $data['totalbudget'] = !empty($_POST['totalbudget']) ? $_POST['totalbudget'] : '';
        $data['ownproperty'] = !empty($_POST['ownproperty']) ? $_POST['ownproperty'] : '';

        if(isset($_REQUEST['utm_source'])){
        $data['utm']=$_REQUEST['utm_source'];
    }else{$data['utm']='';}
        processAPI($data);
         header("Location: https://www.cmax.pk/empire-boulevard-defence/empire-boulevard-defence-thankyou.html");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon -->
	<link rel="shortcut icon" href="https://cmax.pk/assets/img/favicon.png" />
	<title>CMax | Empire Boulevard Defence</title>
	
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5LH7ZF34');</script>
	<!-- Meta Pixel Code -->

<script>

!function(f,b,e,v,n,t,s)

{if(f.fbq)return;n=f.fbq=function(){n.callMethod?

n.callMethod.apply(n,arguments):n.queue.push(arguments)};

if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';

n.queue=[];t=b.createElement(e);t.async=!0;

t.src=v;s=b.getElementsByTagName(e)[0];

s.parentNode.insertBefore(t,s)}(window, document,'script',

'https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '2117634151692303');

fbq('track', 'PageView');

</script>

<noscript><img height="1" width="1" style="display:none"

src="https://www.facebook.com/tr?id=2117634151692303&ev=PageView&noscript=1"

/></noscript>

<!-- End Meta Pixel Code -->


	
	<link rel="stylesheet" type="text/css" href="libs/fonts/stylesheet.css" />
	
	<link rel="stylesheet" type="text/css" href="libs/intlTelInput/intlTelInput.min.css" />
	
    <!-- Main Style -->
	<link rel="stylesheet" type="text/css" href="css/style.css?ver=2022" />
	<!-- Main jQuery -->
	<script src="libs/jquery/jquery.min.js"></script>
</head>
<body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5LH7ZF34"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="page_main_section" style="background-image: url('images/Background-image.jpg');">
	
	<div class="container">

		<div class="page_header">
			<div class="row align-end">
				<div class="col-lg-8">
					<div class="logo_inner_box">
						<ul class="logo_box">
							<li class="logo_img"><a href="#"><img src="images/new-cmax-logo.png" alt="cmax"></a></li>
							<li class="logo_img"><a href="#"><img src="images/empire.png" alt="uptown"></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="phone_number_box">
						<div class="phone_box">
							<div class="phone_img">
								<img src="images/phone_icon.png" alt="phone">
							</div>
							<a href="tel:03238222016"> 03238222016</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="section_bg lading_page_wrap">
			<div class="landing_hero_section ">
				<div class="row flex-row-reverse">
					<div class="col-lg-5">
						<div class="hero_form" id="form1">
							<div class="hero_right_form">
								<div class="hero_form_hedding">
									<h3>Fill in the form below to schedule your site tour and receive project details in the next 24 hours.</h3>
								</div>
								<form action="" method="post"  class="af-form-wrapper" accept-charset="UTF-8">
									<div class="form-group">
										<input class="form-control" type="text" id="name" name="name" class="require" value="" placeholder="Name" required>		
									</div>
									<div class="form-group">
										<input type="tel" id="awf_field-101683281" class="form-control" name="phone" value="+92" maxlength="10" placeholder="Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'xxx xxxx xxxx'" tabindex="501" required="" autocomplete="off">
									</div>
									<div class="form-group">
										<input class="form-control" type="text" id="email" name="email" class="require" value="" placeholder="Email">		
									</div>
									
									<div class="form-group">
										<select class="form-control" name="interestedin">
										<option class="multiChoice" value="Interested in" disabled selected>Interested in</option>
                                        <option class="multiChoice" value="2 Bedrooms">2 Bedrooms</option>
                                        <option class="multiChoice" value="3 Bedrooms">3 Bedrooms</option>
                                        <option class="multiChoice" value="4 Bedrooms">4 Bedrooms</option>
										</select>	
									</div>
									
									<div class="submit_btn">
									        <input type="hidden" name="project" class="project" value="55"/>
                            <input type="hidden" name="locality" class="locality" value="850"/>
										<button type="submit" name="submit" class="btn btn-danger btn-block">Yes I am Interested!</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="banner_content">
							<h1>		
								2, 3 & 4 Bedrooms
								<span>Luxurious Apartments</span>
							</h1>
						</div>
						<div class="map_box">
							<img src="images/map.png" alt="map-icon">
							<h3>NEAR D.H.A, PHASE 7 KARACHI</h3>
						</div>
						<div class="feature_content">
							<h4>FEATURES:</h4>
							<ul>
								<li>Easy Payment Plan</li>
		                        <li>Spacious Apartments</li>
		                        <li>Modern Architecture</li>
		                        <li>Just 1km from Main Khayban -E- Itttehad</li>
		                        <li>Equipped with all amenities of life</li>
							</ul>
						</div>
					</div>

				</div>
			</div>

			<div class="schedule_bg">
				<div class="schedule_content">
					<h2><a href="#form1" style="color:#ffffff;">SCHEDULE YOUR SITE TOUR</a></h2>
				</div>
			</div>

			<div class="map_main">
				<div class="mad_hedding">
					<h2 class="h1"><span>LOCATION MAP</span></h2>
				</div>
				<div class="map_box">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14483.489508864923!2d67.077919!3d24.8340377!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf215118c1a5714bf!2sEmpire%20Boulevard%20Apartments!5e0!3m2!1sen!2s!4v1661716341197!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>

		<div class="footer_section">
			<div class="row">
				<div class="col-lg-9">
					<p>© 2022, All Rights Reserved. - Powered By CMAX.PK (Pvt) Ltd.</p>
				</div>
				<div class="col-lg-3">
					<div class="soical_icon_img">
						<ul>
							<li>
								<a href="https://www.instagram.com/cmax.pk/"><img src="images/instagram.png" alt="instagram"></a>
							</li>
							<li>
								<a href="https://bit.ly/367lJO0"><img src="images/youtube.png" alt="youtube"></a>
							</li>
							<li>
								<a href="https://www.facebook.com/cmaxrealestate"><img src="images/facebook.png" alt="facebook"></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</div>
		
</div>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/intlTelInput.min.js"></script>

<script>
    $(document).ready(function () {
        $('input#awf_field-101683281').keydown(function(e){ 
    this.value = this.value.replace(/^0+/, '');
    });
     $('form.af-form-wrapper').submit(function(){
    var name1=jQuery('input[name="name"]').val();
  if(name1==''){
    alert("Please Enter Name!");
    return false;
  }
  var email1=jQuery('input[name="email"]').val();
   if( !validate(email1, 'email') && email1!='') {
    alert("Please Enter Proper Email!");
    return false;
  }
  var phone1=jQuery('input[name="phone"]').val();

   if( !validate(phone1, 'tel')) {
    alert("Please Enter Proper Number!");
    return false;
  }
 });
  ga('send', 'event', { eventCategory: 'cgvbannerform', eventAction: 'submit', eventLabel: 'success'});
        //Form tracking code
        var emailval=jQuery('input[type="email"]');
        var phoneVal=jQuery('input[type="tel"]');
        $('form.af-form-wrapper').submit(function(){
            ga('send', 'event', { eventCategory: 'empform', eventAction: 'submit', eventLabel: 'success'});
            // console.log('track success');
        });

        // Numbers tracking code
        $('.phonenum').click(function(){    
            ga('send', 'event', { eventCategory: 'empcall', eventAction: 'click', eventLabel: 'success'});
            //  console.log('successv dsa');
        });
        
        $('#awf_field-101683281').intlTelInput({
            separateDialCode: true,
//            utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/utils.js',
            autoPlaceholder: true,
            preferredCountries: ['pk', 'us', 'gb']
        });

        $('#awf_field-101683281').on("input", function () {

            if (/^0/.test(this.value)) {
                this.value = this.value.replace(/^0/, "")
            }
        })
        

        var email;
        var phone;

        emailval.keyup(function() {
            if( !validate($(this).val(), 'email') ) {
                email1 = false;
            } else {
                email1 = true;
            }

            if( email1 !== true || phone1 !== true){
                jQuery(':input[type="submit"]').attr('disabled','disabled');
                console.log('disabled');
            } else {
                jQuery(':input[type="submit"]').removeAttr('disabled');
            }

            });
            phoneVal.keyup(function() {
            	if($.isNumeric( $(this).val())){
            		phone1 = false;
            	}else{phone1 = true;}
            	 

                if( email1 !== true || phone1 !== true ){
                    jQuery(':input[type="submit"]').attr('disabled','disabled');                
                } else {
                    jQuery(':input[type="submit"]').removeAttr('disabled');
                }

            });
            function validate(inputval, type){
                console.log(inputval.length);
                if(!inputval.length || inputval.length == 0 ){
                    return false;
                }

                if(type == 'email'){
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if(emailReg.test(inputval)){
                        return true;
                    } else {
                        return false;
                    }
                }
                if (type == 'tel') {
                    var numReg= /^[0-9]*$/;
                    if (numReg.test(inputval) && inputval.length>=10) {
                    
                        return true;
                    } else {
                    
                        return false;
                    }
                     
                }
            } 
        });
</script>



</body>
</html>