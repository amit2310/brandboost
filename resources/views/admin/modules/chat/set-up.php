<link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/pickers/color/spectrum.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/picker_color.js"></script>
	
	<style>
	.panel-heading .nav-tabs > li.active > a, .panel-heading .nav-tabs > li.active > a:hover, .panel-heading .nav-tabs > li.active > a:focus {color: #3680dc;}
	/*.sp-replacer{display: block;	border-radius: 5px;	box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);	background-color: #ffffff;	border: solid 1px #e3e9f3;	appearance: none;	-webkit-appearance: none;	-moz-appearance: none;	position: relative;	height: 40px;}
	.sp-preview {	position: relative;	width: 15px;	height: 15px;	margin-right: 10px;	float: right;	margin-top: 6px;}
		.sp-dd{display: none!important;}	
		.sp-preview-inner{box-shadow: none!important; border-radius: 50px;}*/
	</style>

<?php 
    $widget = '';
    if($defalutTab == 'widgets') {
        $widget = 'active';
    }
    else {
        $custom = 'active';
    }
?>

  <div class="content">
  
  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
	<div class="page_header">
	  <div class="row">
	  <!--=============Headings & Tabs menu==============-->
		<div class="col-md-7">
		  <h3><img style="width:17px;"  src="/assets/images/chat_icon2.png"/> Chat</h3>
		  <ul class="nav nav-tabs nav-tabs-bottom">

			<li class="<?php echo ($defalutTab == 'customize')? 'active': '';?>"><a href="#right-icon-tab2" data-toggle="tab">Preferences</a></li>
            <li class="<?php echo ($defalutTab == 'chat_widget')? 'active': '';?>"><a href="#right-icon-tab3" data-toggle="tab">Chat Widget</a></li>
            <li class=""><a href="#right-icon-tab1" data-toggle="tab">Chat Contacts</a></li>
			<li class="<?php echo ($defalutTab == 'widgets') ? 'active' : ''; ?>"><a href="#right-icon-tab4" data-toggle="tab">Integration</a></li>
		  </ul>
		</div>
		<!--=============Button Area Right Side==============-->
		<div class="col-md-5 text-right btn_area">
			<button type="button" class="btn light_btn ml20" data-toggle="modal" data-target="#addPeopleList"><i class="icon-plus3"></i><span> &nbsp;  Add Contact</span> </button>
		 	<button type="button" class="btn dark_btn ml20" data-toggle="modal" data-target="#addPeopleList"><i class="icon-plus3"></i><span> &nbsp;  New Chat</span> </button>
		</div>
	  </div>
	</div>
	<!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->
	
	
	<!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
	<div class="tab-content"> 

	  <!--===========TAB 1===========-->
       <div class="tab-pane <?php echo ($defalutTab == 'customize')? 'active': '';?>" id="right-icon-tab2">
        <?php $this->load->view("admin/modules/chat/chat-tabs/availability", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oChat' => $oChat)); ?>
      </div>

       <!--===========TAB 2====Chat Widget=======-->
      <div class="tab-pane <?php echo ($defalutTab == 'chat_widget')? 'active': '';?>" id="right-icon-tab3">
        <?php $this->load->view("admin/modules/chat/chat-tabs/chat-widget", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oChat' => $oChat)); ?>
      </div>

      <!--===========TAB 3====Preferences=======-->
	  <div class="tab-pane" id="right-icon-tab1">
		<?php $this->load->view("admin/modules/chat/chat-tabs/chat-contact", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oChat' => $oChat)); ?>
	  </div>

	  <!--===========TAB 4===========-->
	  <div class="tab-pane <?php echo ($defalutTab == 'widgets') ? 'active' : ''; ?>" id="right-icon-tab4">
		<?php $this->load->view("admin/modules/chat/chat-tabs/widget", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oChat' => $oChat)); ?>
	  </div>
	</div>
	<!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->

  </div>
		
<!--=====================================Add List Modal Popup================================-->	
<div id="addPeopleList" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Create new list</h5>
                </div>
                <div class="modal-body">
                   <div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label class="control-label">List Name</label>
      <div class="">
        <input placeholder="Enter list name" name="firstname" id="firstname" class="form-control" type="text" required>
      </div>
    </div>
    </div>
    <div class="col-md-12">
    <div class="form-group mb0">
      <label class="control-label">List description</label>
      <div class="">
        <textarea placeholder="Enter list description"  class="form-control" value="" type="text" required> </textarea>
      </div>
    </div>
    </div>
   

    
  </div>
                </div>
                <div class="modal-footer p40">
                    <input type="hidden" name="listId" id="list_id" value="">
                    <button class="btn btn-link text-muted" data-dismiss="modal">Cancel </button>
                    <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_blue">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--=====================================Add List Modal Popup End================================-->






<script>
	
// top navigation fixed on scroll and side bar collasped
	
		$( window ).scroll( function () {
			var sc = $( window ).scrollTop();
			if ( sc > 100 ) {
				$( "#header-sroll" ).addClass( "small-header" );
			} else {
				$( "#header-sroll" ).removeClass( "small-header" );
			}
		} );

		function smallMenu() {
			if ( $( window ).width() < 1600 ) {
				$( 'body' ).addClass( 'sidebar-xs' );
			} else {
				$( 'body' ).removeClass( 'sidebar-xs' );
			}
		}

		$( document ).ready( function () {
			smallMenu();

			window.onresize = function () {
				smallMenu();
			};
		} );

</script>

<script type="text/javascript">
    $(function(){
      $('#testDiv2').slimscroll({
        disableFadeOut: true
      });
		
	  $('#testDiv3').slimscroll({
        disableFadeOut: true
      });
		$('#testDiv4').slimscroll({
        disableFadeOut: true
      });
		$('#testDiv5').slimscroll({
        disableFadeOut: true
      });
		
		$('#testDiv6').slimscroll({
        disableFadeOut: true
      });
		$('#testDiv7').slimscroll({
        disableFadeOut: true
      });
		$('#testDiv8').slimscroll({
        disableFadeOut: true
      });
		
		$('#testDiv18').slimscroll({
        disableFadeOut: true
      });
		$('#testDiv19').slimscroll({
        disableFadeOut: true
      });

    });

    function getColorName(colorName){
        if(colorName == 'red'){
            colorName = '#AB256F';
        }
        if(colorName == 'yellow'){
            colorName = '#F9A34A';
        }
        if(colorName == 'orange'){
            colorName = '#E2583D';
        }
        if(colorName == 'green'){
            colorName = '#368A5D';
        }
        if(colorName == 'blue'){
            colorName = '#2A4CBC';
        }
        if(colorName == 'purple'){
            colorName = '#33335B';
        }
        
        return colorName;
    }

    $(document).ready(function() {

        $("#frmSubmit").submit(function (e) {
           
            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '<?php echo base_url('admin/modules/chat/updateChatCustomize'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {

                        window.location.href = '<?php echo base_url("/admin/modules/chat/setup/{$programID}?t=widgets") ?>';

                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });

        $("#frmSubmitDesign").submit(function (e) {
           
            e.preventDefault();
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '<?php echo base_url('admin/modules/chat/updateChatDesign'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {

                       // window.location.href = '<?php echo base_url("/admin/modules/chat/setup/{$programID}?t=widgets") ?>';
						$('.overlaynew').hide();
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });

        $("#frmSubmitPreferences").submit(function(e) {

            e.preventDefault();
            $('.frmSubmitPreferences').show();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '<?php echo base_url('admin/modules/chat/updateChatPreferences'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url("/admin/modules/chat/setup/{$programID}?t=chat_widget") ?>';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;

        });

        $(document).on('click', '.addMoreMessage', function() {
            $('.addMoreMessage').hide();
            $(this).parent().parent().parent().append(`
                <span class="showMsg">
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="messages[]" placeholder="Hi! We are ready to help you. Ask us anything or share your feedback."></textarea>
                    </div>
                    <div class="form-group">
                        <div style="max-width: 170px;" class="input-group pull-left">
                            <span class="input-group-addon"><i class="icon-alarm"></i></span>
                            <input class="form-control" placeholder="Wait for 5 Sec" name="time[]" type="text">
                        </div>
                        <button type="button" class="btn white_btn ml20 h40 p10 removeMessage" ><i class="icon-minus3"></i></button> 
                        <button type="button" class="btn white_btn ml20 h40 p10 addMoreMessage" ><i class="icon-plus3"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </span>`);
        });

        $(document).on('click', '.removeMessage', function() {
            
            $(this).parent().parent().remove();
            var numItems = $('.showMsg').length;
            console.log(numItems);
            if(numItems > 0) {
                $( ".showMsg:nth-child("+numItems+")" ).find( ".addMoreMessage" ).show();
            }
            else {
                $( ".showMsg:nth-child(1)" ).find( ".addMoreMessage" ).show();
                //$( ".addMoreDiv .showMsg:nth-child(1)" ).find( ".addMoreMessage" ).show();
            }
            
        });

        $("#publishChatCampaign").click(function () {
            $.ajax({
                url: '<?php echo base_url('admin/modules/chat/publishChatCampaign'); ?>',
                type: "POST",
                data: {'chatId': '<?php echo $oChat->id; ?>'},
                dataType: "html",
                success: function (data) {
                    window.location.href = '<?php echo base_url("/admin/modules/chat/") ?>';
                }, error: function () {
                    alertMessage('Error: Some thing wrong!');
                }
            });
        });

        var myDropzoneLogoImg = new Dropzone(
            '#myDropzone_logo_img', //id of drop zone element 1
            {
                url: '<?php echo site_url("/dropzone/upload_chat_image"); ?>',
                uploadMultiple: false,
                maxFiles: 3,
                maxFilesize: 600,
                acceptedFiles: 'image/*',
                addRemoveLinks: false,
                success: function (response) {
                    console.log(response);
                    $('#chat_logo').val(response.xhr.responseText);
                    $('.company_avatar').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'+response.xhr.responseText);
                }
            });

      Dropzone.autoDiscover = false;


      $('#company_info_switch').change(function(){
            if($(this).prop("checked") == false){
                $('#custom_company_info_box').show();
                $('#default_company_info_box').hide();
            }else{
                $('#custom_company_info_box').hide();
                $('#default_company_info_box').show();
            }
      });

      $('#custom_company_name').keyup(function(){
        $('.company_name').html($(this).val());
      });
    
      $('#custom_company_description').keyup(function(){
        var contentVal = $(this).val();
        $('.company_description').html(contentVal.replace(/\n/g, "<br />"));
      });

      $(document).on('change', '.change_position', function() {
        var position = $(this).val();
        if(position == 'left') {
            $('.previewWidgetBox').addClass('position_left');
            $('.chat_icon').addClass('leftalign');
            $('.bb_chat_action_icon_white').addClass('iconLeft');
            $('.chat_badge').addClass('noti_left');
        }
        else {
            $('.previewWidgetBox').removeClass('position_left');
            $('.chat_icon').removeClass('leftalign');
            $('.bb_chat_action_icon_white').removeClass('iconLeft');
            $('.chat_badge').removeClass('noti_left');
        }
      });

      

      $('#logo_show').change(function(){
        if($(this).prop("checked") == false){
            $('.bb_img_icon_new').addClass('hidden');
        }else{
            $('.bb_img_icon_new').removeClass('hidden');
        }
      });

      $('#title_show').change(function(){
        if($(this).prop("checked") == false){
            $('.company_name').addClass('hidden');
        }else{
            $('.company_name').removeClass('hidden');
        }
      });
      
      $('#subtitle_show').change(function(){
        if($(this).prop("checked") == false){
            $('.company_description').addClass('hidden');
        }else{
            $('.company_description').removeClass('hidden');
        }
      });
	  
	  $('#allow_gift_message').change(function(){
        if($(this).prop("checked") == true){
            $('.woGiftChatBox').addClass('hidden');
			$('.giftChatBox').removeClass('hidden');
			$('.giftMessageBox').removeClass('hidden');
        }else{
            $('.woGiftChatBox').removeClass('hidden');
            $('.giftChatBox').addClass('hidden');
			$('.giftMessageBox').addClass('hidden');
        }
      });

      $('#smilie_show').change(function(){
        if($(this).prop("checked") == false){
            $('.smilieShow').addClass('hidden');
        }else{
            $('.smilieShow').removeClass('hidden');
        }
      });

      $('#attachment_show').change(function(){
        if($(this).prop("checked") == false){
            $('.attachmentShow').addClass('hidden');
        }else{
            $('.attachmentShow').removeClass('hidden');
        }
      });

      $('#notification_chat').change(function(){
        if($(this).prop("checked") == false){
            $('.chat_badge').addClass('hidden');
        }else{
            $('.chat_badge').removeClass('hidden');
        }
      });

      


      /* --------------- color start ----------------- */

        $('#main_color_switch').change(function(){
            if($(this).prop("checked") == false){
                $('#custom_color_switch').prop('checked', true);
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('red_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('yellow_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('orange_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('green_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('blue_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('purple_preview_1'); 
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', 'linear-gradient(45deg, '+$('#custom_colors1').val()+' 1%, '+$('#custom_colors2').val()+')');
                //$('.customColor, .customColor i').attr('style', 'color:'+$('#custom_colors1').val()+'!important');
                //$('.customColorBar').css('background-color', $('#custom_colors1').val());
				$('.orientation_top').hide();
            }else{
                $('#custom_color_switch').prop('checked', false);
                $('#solid_color_switch').prop('checked', false);
                $('#solid_color').attr('readonly', true);
                $('#custom_colors1').attr('readonly', true);
                $('#custom_colors2').attr('readonly', true);
                var gColor = $('.selectMainColor.active').attr('color-class');
                var colorName = $('.selectMainColor.active').attr('color-data');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').addClass(gColor);
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', '');
                //$('.customColor, .customColor i').attr('style', 'color:'+getColorName(colorName)+'!important');
                //$('.customColorBar').css('background-color', getColorName(colorName));
				$('.orientation_top').show();
            }
        });
        
        $('#custom_color_switch').change(function(){
            if($(this).prop("checked") == false){
                $('#custom_colors1').attr('readonly', true);
                $('#custom_colors2').attr('readonly', true);
                $('#main_color_switch').prop('checked', true);
                var gColor = $('.selectMainColor.active').attr('color-class');
                var colorName = $('.selectMainColor.active').attr('color-data');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').addClass(gColor);
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', '');
                //$('.customColor, .customColor i').attr('style', 'color:'+getColorName(colorName)+'!important');
                //$('.customColorBar').css('background-color', getColorName(colorName));
				$('.orientation_top').hide();
            }else{
                $('#main_color_switch').prop('checked', false);
                $('#solid_color_switch').prop('checked', false);
                $('#solid_color').attr('readonly', true);
                $('#custom_colors1').attr('readonly', false);
                $('#custom_colors2').attr('readonly', false);
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('red_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('yellow_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('orange_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('green_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('blue_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('purple_preview_1'); 
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', 'linear-gradient(45deg, '+$('#custom_colors1').val()+' 1%, '+$('#custom_colors2').val()+')');
                //$('.customColor, .customColor i').attr('style', 'color:'+$('#custom_colors1').val()+'!important');
                //$('.customColorBar').css('background-color', $('#custom_colors1').val());
				$('.orientation_top').show();
            }
        });
        
        $('#solid_color_switch').change(function(){
            if($(this).prop("checked") == false){
                $('#solid_color').attr('readonly', true);
                $('#main_color_switch').prop('checked', true);
                var gColor = $('.selectMainColor.active').attr('color-class');
                var colorName = $('.selectMainColor.active').attr('color-data');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').addClass(gColor);
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', '');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background', '');
                //$('.customColor, .customColor i').attr('style', 'color:'+getColorName(colorName)+'!important');
                //$('.customColorBar').css('background-color', getColorName(colorName));
				$('.orientation_top').show();
            }else{
                $('#solid_color').attr('readonly', false);
                $('#main_color_switch').prop('checked', false);
                $('#custom_color_switch').prop('checked', false);
                $('#custom_colors1').attr('readonly', true);
                $('#custom_colors2').attr('readonly', true);
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('red_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('yellow_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('orange_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('green_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('blue_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('purple_preview_1'); 
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', '');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').attr('style', 'background:'+$('#solid_color').val()+'!important');
                //$('.customColorBar').css('background-color', $('#solid_color').val());
                //$('.customColor, .customColor i').attr('style', 'color:'+$('#solid_color').val()+'!important');
				$('.orientation_top').hide();
            }
        });
        
        $('#company_info_switch').change(function(){
            if($(this).prop("checked") == false){
                $('#custom_company_info_box').show();
                $('#default_company_info_box').hide();
                var contentVal = $('#custom_company_description').val();
                $('.company_name').html($('#custom_company_name').val());
                $('.company_description').html(contentVal.replace(/\n/g, "<br />"));
            }else{
                $('#custom_company_info_box').hide();
                $('#default_company_info_box').show();
                var contentVal = $('#default_brand_desc').val();
                $('.company_name').html($('#default_brand_title').val());
                $('.company_description').html(contentVal.replace(/\n/g, "<br />"));
            }
        });
        
        $('#custom_company_name').keyup(function(){
            $('.company_name').html($(this).val());
        });
        
        $('#custom_company_description').keyup(function(){
            var contentVal = $(this).val();
            $('.company_description').html(contentVal.replace(/\n/g, "<br />"));
        });
        
        $('.selectMainColor').click(function(){
            $('#main_colors').val($(this).attr('color-data'));
            $('.selectMainColor').removeClass('active');
            $(this).addClass('active');
            $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('red_preview_1');
            $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('yellow_preview_1');
            $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('orange_preview_1');
            $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('green_preview_1');
            $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('blue_preview_1');
            $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('purple_preview_1'); 
            $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', '');
            $('#main_color_switch').prop('checked', true);
            $('#custom_color_switch').prop('checked', false);
            $('#solid_color_switch').prop('checked', false);
            $('#solid_color').attr('readonly', true);
            $('#custom_colors1').attr('readonly', true);
            $('#custom_colors2').attr('readonly', true);
            $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').addClass($(this).attr('color-class'));
            //var colorName = $('.selectMainColor.active').attr('color-data');
            //$('.customColor, .customColor i').attr('style', 'color:'+getColorName(colorName)+'!important');
            //$('.customColorBar').css('background-color', getColorName(colorName));
        });
        
        $('#custom_colors1, #custom_colors2').change(function(){
            //$('.customColor, .customColor i').attr('style', 'color:'+$('#custom_colors1').val()+'!important');
            //$('.customColorBar').css('background-color', $('#custom_colors1').val());
            if($('#custom_colors1').val() != '' && $('#custom_colors2').val() != ''){
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('red_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('yellow_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('orange_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('green_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('blue_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('purple_preview_1');
                $('#main_color_switch').prop('checked', false);
                $('#custom_color_switch').prop('checked', true);
                $('#solid_color_switch').prop('checked', false);
                $('#solid_color').attr('readonly', true);
                $('#custom_colors1').attr('readonly', false);
                $('#custom_colors2').attr('readonly', false);
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', 'linear-gradient(45deg, '+$('#custom_colors1').val()+' 1%, '+$('#custom_colors2').val()+')');
            }
        });

        var greadentColor1 = $('#custom_colors1').val();
        $(".colorpicker1").spectrum({
            change: function(color) {
                greadentColor1 = color.toHexString();
                $('#custom_colors1').val(color.toHexString());
                $('.colorpicker1 i').attr('style', 'color:'+color.toHexString()+'!important');
                //$('.customColor, .customColor i').attr('style', 'color:'+color.toHexString()+'!important');
                //$('.customColorBar').css('background-color', color.toHexString());
                if($('#custom_colors1').val() != '' && $('#custom_colors2').val() != ''){
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('red_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('yellow_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('orange_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('green_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('blue_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('purple_preview_1');
                    $('#main_color_switch').prop('checked', false);
                    $('#custom_color_switch').prop('checked', true);
                    $('#solid_color_switch').prop('checked', false);
                    $('#solid_color').attr('readonly', true);
                    $('#custom_colors1').attr('readonly', false);
                    $('#custom_colors2').attr('readonly', false);
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', 'linear-gradient(45deg, '+$('#custom_colors1').val()+' 1%, '+$('#custom_colors2').val()+')');
                }
            },
            move: function(color) {
                greadentColor1 = color.toHexString();
                $('#custom_colors1').val(color.toHexString());
                $('.colorpicker1 i').attr('style', 'color:'+color.toHexString()+'!important');
                //$('.customColor, .customColor i').attr('style', 'color:'+color.toHexString()+'!important');
                //$('.customColorBar').css('background-color', color.toHexString());
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('red_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('yellow_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('orange_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('green_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('blue_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('purple_preview_1');
                $('#main_color_switch').prop('checked', false);
                $('#custom_color_switch').prop('checked', true);
                $('#solid_color_switch').prop('checked', false);
                $('#solid_color').attr('readonly', true);
                $('#custom_colors1').attr('readonly', false);
                $('#custom_colors2').attr('readonly', false);
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', 'linear-gradient(45deg, '+color.toHexString()+' 1%, '+$('#custom_colors2').val()+')');
            }
        });
        
        $(".colorpicker2").spectrum({
            change: function(color) {
                $('#custom_colors2').val(color.toHexString());
                $('.colorpicker2 i').attr('style', 'color:'+color.toHexString()+'!important');
                //$('.customColor, .customColor i').attr('style', 'color:'+greadentColor1+'!important');
                //$('.customColorBar').css('background-color', greadentColor1);
                if($('#custom_colors1').val() != '' && $('#custom_colors2').val() != ''){
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('red_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('yellow_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('orange_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('green_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('blue_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('purple_preview_1');
                    $('#main_color_switch').prop('checked', false);
                    $('#custom_color_switch').prop('checked', true);
                    $('#solid_color_switch').prop('checked', false);
                    $('#solid_color').attr('readonly', true);
                    $('#custom_colors1').attr('readonly', false);
                    $('#custom_colors2').attr('readonly', false);
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', 'linear-gradient(45deg, '+$('#custom_colors1').val()+' 1%, '+$('#custom_colors2').val()+')');
                }
            },
            move: function(color) {
                $('#custom_colors2').val(color.toHexString());
                $('.colorpicker2 i').attr('style', 'color:'+color.toHexString()+'!important');
                //$('.customColor, .customColor i').attr('style', 'color:'+greadentColor1+'!important');
                //$('.customColorBar').css('background-color', greadentColor1);
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('red_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('yellow_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('orange_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('green_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('blue_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('purple_preview_1');
                    $('#main_color_switch').prop('checked', false);
                    $('#custom_color_switch').prop('checked', true);
                    $('#solid_color_switch').prop('checked', false);
                    $('#solid_color').attr('readonly', true);
                    $('#custom_colors1').attr('readonly', false);
                    $('#custom_colors2').attr('readonly', false);
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', 'linear-gradient(45deg, '+greadentColor1+' 1%, '+color.toHexString()+')');
                
            }
        });
        
        $(".solidcolorpicker").spectrum({
            change: function(color) {
                $('#solid_color').val(color.toHexString());
                $('.solidcolorpicker i').attr('style', 'color:'+color.toHexString()+'!important');
                //$('.customColor, .customColor i').attr('style', 'color:'+color.toHexString()+'!important');
                //$('.customColorBar').css('background-color', color.toHexString());
                if($('#solid_color').val() != ''){
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('red_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('yellow_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('orange_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('green_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('blue_preview_1');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('purple_preview_1');
                    $('#main_color_switch').prop('checked', false);
                    $('#custom_color_switch').prop('checked', false);
                    $('#solid_color_switch').prop('checked', true);
                    $('#solid_color').attr('readonly', false);
                    $('#custom_colors1').attr('readonly', true);
                    $('#custom_colors2').attr('readonly', true);
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', '');
                    $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background', $('#solid_color').val());
                }
            },
            move: function(color) {
                $('#solid_color').val(color.toHexString());
                $('.solidcolorpicker i').attr('style', 'color:'+color.toHexString()+'!important');
                //$('.customColor, .customColor i').attr('style', 'color:'+color.toHexString()+'!important');
                //$('.customColorBar').css('background-color', color.toHexString());
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('red_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('yellow_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('orange_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('green_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('blue_preview_1');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').removeClass('purple_preview_1');
                $('#main_color_switch').prop('checked', false);
                $('#custom_color_switch').prop('checked', false);
                $('#solid_color_switch').prop('checked', true);
                $('#solid_color').attr('readonly', false);
                $('#custom_colors1').attr('readonly', true);
                $('#custom_colors2').attr('readonly', true);
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background-image', '');
                $('.bb_msg_head_new, .bb_chat_action_icon_white, .bb_smg_smiley_new').css('background', color.toHexString());
            }
        });


      /* ---------------- color end -------------------- */


      $(document).on('click', '.chat_icon', function() {
        var icon = $(this).attr('attr');
        $('.chat_icon').removeClass('active');
        $(this).addClass('active');
        //$('.bb_iconbox').remove();
        var imgPath = "/assets/images/chat_design_icon"+icon+".png";
        $(".bb_iconbox_img").attr("src", imgPath);
        //$('.bb_iconbox').html('<img style="height: 25px; width: 25px;" src="/assets/images/chat_design_icon'+icon+'.png"> ');
        $('#changeChatIcon').val(icon);
      });

    });
	
</script>

</body>
</html>