<?php
$primaryColor = App\Http\Helpers\RosenHelper::getOption('primary_color', '#0E0E0E');
$secondaryColor = App\Http\Helpers\RosenHelper::getOption('secondary_color', '#FFCC03');
$footerBackground = App\Http\Helpers\RosenHelper::getOption('footer_background', '#212124');
$homeContactUsBg = App\Http\Helpers\RosenHelper::getOption('home_contact_us_bg', '#FFF5CD');

?>
<style type="text/css">
.header-main .navbar.sticky{
	
    background: <?php echo $primaryColor; ?>;
   
}



.header-main .navbar ul.navbar-nav.ml-auto li a {
    color: #fff;    
}
.header-main .navbar ul.navbar-nav.ml-auto li a:hover {
    color: <?php echo $secondaryColor; ?>;
}
.header-main .navbar ul.navbar-nav.ml-auto li a.btn-success {
    background: <?php echo $secondaryColor; ?>;    
}
.header-main .navbar ul.navbar-nav.ml-auto li a.btn-success:hover{
	background: <?php echo $primaryColor; ?>;
	border-color:<?php echo $primaryColor; ?>;
    color: <?php echo $secondaryColor; ?>;
}
.slid-header h1.display-4{	
    color: #fff;
}
.slid-header h1.display-4 span{
	color: <?php echo $secondaryColor; ?>;
}
.slid-header p.lead-c{
	
    color: #fff;
   
}
.btn-success2 {
    background: <?php echo $secondaryColor; ?>;
    
    color: <?php echo $primaryColor; ?>;
    
}
.btn-success2:hover{
    background: <?php echo $primaryColor; ?>;
    border-color:<?php echo $primaryColor; ?>;
    color: <?php echo $secondaryColor; ?>;
}
.main-heading{
    
    color: <?php echo $primaryColor; ?>;
    
}
.main-heading span{
    color: <?php echo $secondaryColor; ?>;
}


.playlets{
   
    color: #fff;
    
}


.for-bgtesti{
    background: #fff; 
}

.testi1 .test-pic {    
    background: #fff;
}


.testi1 h3{
   
    color: <?php echo $secondaryColor; ?>;
   
}
.testi1 h3 span{
   
    color: <?php echo $primaryColor; ?>;
   
}

.testi .slick-prev, .testi .slick-next, .omultiimages .slick-next, .omultiimages .slick-prev{
    
    background: #fff;
   
   
}

.testi .slick-prev:before, .testi .slick-next:before,
.omultiimages .slick-prev:before, .omultiimages .slick-next:before{
   
    color: <?php echo $primaryColor; ?>;
    
}
.testi .slick-prev .fa:before, .testi .slick-next .fa:before,
.omultiimages .slick-prev .fa:before, .omultiimages .slick-next .fa:before{
   
    color: <?php echo $primaryColor; ?>;
}


.slick-dots li button{
    
    border: 1px solid #B5B5B5;
    
    background: #F5F5F5;
    
}
.slick-dots li.slick-active button{
    background: <?php echo $secondaryColor; ?>;
    
}

.team .team-group {
    background: #fff; 
}


.team-group .team-content h3{
   
    color: <?php echo $primaryColor; ?>;
}
.team-group .team-content h3 span{
    
    
    color: <?php echo $secondaryColor; ?>;
}

.class-to-stylo1, .class-to-stylo2 {
   
    background: #fff;
    
}


.class-to-stylo1:hover, .class-to-stylo2:hover{
    background: <?php echo $secondaryColor; ?>;
}
.kontakt{
    background: <?php echo $homeContactUsBg; ?>;    
}
.kontakt .box{
    background: #fff;
    
    box-shadow: 0 0 17px #ccc;
   
    color: <?php echo $primaryColor; ?>;
}
.box.yel{
    background: <?php echo $secondaryColor; ?>;
   
}
.kontakt .box a{
    color: <?php echo $primaryColor; ?>;
    
}
.kontakt .box.yel a{
    color: #fff;
}

#footer{
    background: <?php echo $footerBackground; ?>;
   
}
#footer h3{
    color: #fff;
    
}


#footer p{color: #fff;}
#footer ul{
    
    color: #fff;
}

#footer ul li a{
    color: #fff;
    
}
#footer ul li a:hover{
    color: <?php echo $secondaryColor; ?>;
}
#footer ul li::marker {
    color: <?php echo $secondaryColor; ?>;
}
#footer p a{
    color: #fff;
    
}
.bottom-bar{
    background: <?php echo $primaryColor; ?>;
    
}
.social .social1{
    color: <?php echo $secondaryColor; ?>;
    
    border: 2px solid <?php echo $secondaryColor; ?>;
   
}




.om-box .om-icon{
    color: #333;
    
    background: <?php echo $secondaryColor; ?>;
   
}
.om-box .om-text{ 
    background: rgb(255 243 195);
   
    color: <?php echo $primaryColor; ?>;
    
}



.om-box a:hover .om-text {
    background: rgb(255 204 3);
}
.om-box a:hover .om-icon {
   
    background: rgb(255 204 3 / 44%);
    
    color: #fff;
}

.om-modal .close{
    
    color: <?php echo $primaryColor; ?>;
    
    background: <?php echo $secondaryColor; ?>;
    
}

#gotop {
   
    color: #fff;
    
    background: #000;
    
  }
</style>