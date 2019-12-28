<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Brand Boost 2.0</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="icon" href="assets/images/icon.ico" sizes="16x16" type="image/ico">


 <!--******************
 CSS
 **********************-->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css">
<link href="assets/css/styleguide.css" rel="stylesheet" type="text/css">
<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
</head>
<body id="PeopleSection">

<div class="page-wrapper">
 <!--******************
 SIDEBAR
 **********************-->
  <?php include("sidebar.php"); ?>
 

  <div class="page-content">
 <!--******************
  TOPBAR
 **********************-->
  <?php include("topbar.php"); ?>
  
  
 <!--******************
  Top Heading area
 **********************-->
  <div class="top-bar-top-section bbot">
  <div class="container-fluid">
   <div class="row">
   	<div class="col-md-6">
   	<span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
   	<h3 class="htxt_medium_24 dark_700">Email Review</h3>
   	</div>
   	<div class="col-md-6 text-right">
   		<button class="circle-icon-40 mr15"><img src="assets/images/filter.svg"/></button>
   		<button class="btn btn-md bkg_blue_200 light_000">Main Action <span><img src="assets/images/blue-plus.svg"/></span></button>
   	</div>
   </div>
   </div>
    <div class="clearfix"></div>
</div>
	 
	  
	  
	  
 <!--******************
  Content Area
 **********************-->
   <div class="content-area">
   
   
  <!--============Seeting sidebar===================-->
  <div class="email_review_config p20">
    <div class="bbot pb10 mb15">
      <p class="fsize11 text-uppercase dark_200 m-0">Component</p>
    </div>
    <div class="p0">
      <h3 class="dark_400 mb0 fsize13 fw300">Logo &nbsp;
        <label class="custom-form-switch float-right">
        <input class="field" type="checkbox" checked="">
        <span class="toggle email"></span> </label>
      </h3>
      <h3 class="dark_400 mb0 fsize13 fw300">Question &nbsp;
        <label class="custom-form-switch float-right">
        <input class="field" type="checkbox" checked="">
        <span class="toggle email"></span> </label>
      </h3>
      <h3 class="dark_400 mb0 fsize13 fw300">Introduction &nbsp;
        <label class="custom-form-switch float-right">
        <input class="field" type="checkbox" checked="">
        <span class="toggle email"></span> </label>
      </h3>
    </div>
    <div class="bbot btop pb10 pt10 mb15 mt15">
      <p class="fsize11 text-uppercase dark_200 m-0">Popup Details</p>
    </div>
    <div class="p0">
      <div class="form-group">
        <label class="fsize12" for="fname">Brand / Product Name:</label>
        <input type="text" class="form-control h40" id="fname" placeholder="Enter name" name="fname">
      </div>
      <div class="form-group">
        <label class="fsize12" for="Questions">Questions:</label>
        <textarea class="form-control" id="Questions"></textarea>
      </div>
      <div class="form-group">
        <label class="fsize12" for="Introduction">Introduction:</label>
        <textarea class="form-control" id="Introduction"></textarea>
      </div>
      <div class="form-group">
        <label class="fsize12">Introduction:</label>
        <label class="m0 w-100" for="upload">
        <div class="img_vid_upload_medium">
          <input class="d-none" type="file" name="" value="" id="upload">
        </div>
        </label>
      </div>
    </div>
    <div class="bbot btop pb10 pt10 mb15 mt15">
      <p class="fsize11 text-uppercase dark_200 m-0">Settings</p>
    </div>
    <div class="p0 pb30">
      <div class="row">
        <div class="col-md-8">
          <p class="fsize13 dark_400 mt-2">Question Text Color :</p>
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control colorpicker-basic1" value="#20BF7E">
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <p class="fsize13 dark_400 mt-2">Introduction Text Color:</p>
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control colorpicker-basic2" value="#000000">
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <p class="fsize13 dark_400 mt-2">Button Text Color :</p>
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control colorpicker-basic3" value="#ffffff">
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <p class="fsize13 dark_400 mt-2">Button Background Color :</p>
        </div>
        <div class="col-md-4">
          <input type="text" class="form-control colorpicker-basic4" value="#333333">
        </div>
      </div>
    </div>
  </div>
  <!--============Seeting sidebar END===================-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card p0 m-auto text-center" style="max-width:500px;">
          <div class="text-center p30 bbot mb0"> <img width="70" class="mb20" src="assets/images/avatar/02.png"/>
            <p class="fsize14 fw500 dark_700 mb-2"> Mr. Anderson</p>
            <p class="fsize14 fw400 dark_300">Test Tester</p>
            <div class="text-center border shadow br5">
              <div class="p20 bbot">
                <p class="fsize14 fw500 dark_700 mb-2">How Likely are you to Recommend <br>
                  My store to a friend ?</p>
              </div>
              <div class="p20">
                <ul class="inline_numbers">
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#">6</a></li>
                  <li><a href="#">7</a></li>
                  <li><a href="#">8</a></li>
                  <li><a href="#">9</a></li>
                  <li><a href="#">10</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="p20">
            <p class="fsize11 fw400 dark_200 mb-2">If you don't know why you got this email, please tell us straight away so we can fix <br>
              this for you. </p>
            <p class="mb-0">Thanks</p>
            <p class="fsize14 fw500 m-0"> Brandboost Team</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

      
<!--******************
  Content Area End
 **********************-->
  </div>
  </div>
  
  
 
 
 
 
 
 
 <!--******************
  jQuery
 **********************-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/spectrum.js"></script>
<script src="assets/js/app.js"></script>

<script>
$(".colorpicker-basic1").spectrum();
$(".colorpicker-basic2").spectrum();
$(".colorpicker-basic3").spectrum();
$(".colorpicker-basic4").spectrum();
</script>


</body>
</html>