<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BrandBoost::Admin</title>
	<link rel="icon" href="<?php echo base_url(); ?>assets/images/icon.ico" sizes="16x16" type="image/ico">

	<!-- Global stylesheets -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/profile_css/profile.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core/libraries/bootstrap.min.js"></script>
	<!-- /core JS files -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/datatables_basic.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom_user_datatable.js"></script>

  <style type="text/css">
    .dataTables_filter{display: none;}
    .datatable-footer { border-top:none!important; font-size: 12px!important }
    .dataTables_paginate .paginate_button {
      display: inline-block;
      padding: 0 5px!important;
      min-width: 28px;
      margin-left: 2px;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
      color: #333333;
      border: 1px solid transparent;
      border-radius: 100px!important;
        line-height: 25px;
    }
    .dataTables_paginate .paginate_button.current, .dataTables_paginate .paginate_button.current:hover, .dataTables_paginate .paginate_button.current:focus {
      color: #6d788e!important;
      background-color: #dbe1eb!important;
    }
    .dataTables_info{padding: 0!important}
  </style>

</head>

<body>

<?php 
	//pre($this->uri->segment(1));
	//pre($this->uri->segment(2));
	//pre($this->uri->segment(3));

  $aUInfo = getLoggedUser();

	$profileActive = '';
	$reviewActive = '';
	$settingActive = '';
	if ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'profile') {
      $profileActive = 'active';
      $headerStyle = "";
  }
  else if ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == '') {
      $profileActive = 'active';
      $headerStyle = "";
  }
  else if ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'review'&& $this->uri->segment(3) == '') {
      $reviewActive = 'active';
      $headerStyle = "style='height:257px'";
  }
   else if ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'review' && $this->uri->segment(3) == 'edit') {
      $reviewActive = 'active';
      $headerStyle = "style='height:209px'";
  }
  else if ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'setting') {
      $settingActive = 'active';
      $headerStyle = "style='height:209px'";
  }
  else if ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'media') {
      $mediaActive = 'active';
      $headerStyle = "style='height:257px'";
  }
  else if ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'nps') {
      $npsActive = 'active';
      $headerStyle = "style='height:257px'";
  }
  else if ($this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'referral') {
      $referralActive = 'active';
      $headerStyle = "style='height:257px'";
  }
?>

<div class="profile_main"> 
  <!--======================profile_header=======================-->
  
  <div class="profile_header_bkg" <?php echo $headerStyle; ?>></div>
  <div class="page_header">
    <div class="row">
      <div class="col-md-6"><a class="logo" href="#"><img src="<?php echo base_url(); ?>assets/profile_images/logo_icon.png" alt="">BrandBoost</a> </div>
      <div class="col-md-6">
        <ul class="navigation_menu">
          <li><a class="<?php echo $profileActive; ?>" href="<?php echo base_url().'user/profile'; ?>">Profile</a></li>
          <li><a class="<?php echo $reviewActive; ?>" href="<?php echo base_url().'user/review'; ?>">My Reviews</a></li>
          <li><a class="<?php echo $mediaActive; ?>" href="<?php echo base_url().'user/media'; ?>">Media</a></li>
          <li><a class="<?php echo $npsActive; ?>" href="<?php echo base_url().'user/nps'; ?>">NPS</a></li>
          <li><a class="<?php echo $referralActive; ?>" href="<?php echo base_url().'user/referral'; ?>">Referral</a></li>
          <li><a class="<?php echo $settingActive; ?>" href="<?php echo base_url().'user/setting'; ?>">Settings</a></li>
          <li><a style="cursor: pointer;">Help</a></li>
          <li><a href="<?php echo base_url().'user/login/logout'; ?>">Log Out</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!--======================profile_header=======================-->
<?php echo $contents; ?>
</div>


<!-- ******** alertMessagePopup ******** -->
<div id="alertMessagePopup" style="z-index: 99999" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="message"></div>
            </div>
            <div class="modal-footer">
                <button data-bb-handler="confirm" type="button" class="btn btn-primary confirmOk">OK</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  
  function alertMessage(message) {
      $("#alertMessagePopup").modal();
      $('.message').html(message);
  }

</script>

<script type="text/javascript">
    var specialKeys = new Array();
    specialKeys.push(8); //Backspace
    function IsNumeric(e) {
        var keyCode = e.which ? e.which : e.keyCode
        var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
        document.getElementById("error").style.display = ret ? "none" : "inline";
        return ret;
    }
</script>
  
</body>
</html>