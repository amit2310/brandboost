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
		  <h3><img src="/assets/images/chat_icon.png"/> Chat</h3>
		  <ul class="nav nav-tabs nav-tabs-bottom">
			<li class="<?php echo $custom; ?>"><a href="#right-icon-tab3" data-toggle="tab">Chat Widget</a></li>
			<li class="<?php echo $widget; ?>"><a href="#right-icon-tab4" data-toggle="tab">Integration</a></li>
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

	  <!--===========TAB 2===========-->
	
	  <!--===========TAB 3====Preferences=======-->
	 
	  <!--===========TAB 4====Chat Widget=======-->
      <?php $this->load->view("admin/modules/chat/chat-tabs/chat-customization", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oChat' => $oChat)); ?>

	   <!--===========TAB 5===========-->
	  <?php $this->load->view("admin/modules/chat/chat-tabs/widget-code", array('userID' => $userID, 'defalutTab' => $defalutTab, 'programID' => $programID, 'oChat' => $oChat)); ?>

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

    $(document).ready(function() {

        $("#frmSubmit").submit(function (e) {
            //console.log($('.emil_priview_sec').html());
            //$('#emailPreviewData').val($('.emil_priview_sec').html());
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
                maxFiles: 1,
                maxFilesize: 600,
                acceptedFiles: 'image/*',
                addRemoveLinks: false,
                success: function (response) {
                    $('#chat_logo').val(response.xhr.responseText);
                    //$('.logo_img').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' + response.xhr.responseText);
                }
            });

      Dropzone.autoDiscover = false;

    });
	
</script>