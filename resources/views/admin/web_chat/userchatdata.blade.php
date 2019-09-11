@php
$aUInfo = getLoggedUser();
$teamMembers = getAllteam($aUInfo->id);

@endphp
<style>
    #CustomDiv2 {
	scroll-behavior: smooth;
	}
	.daterangepicker.dropdown-menu {
    padding: 0px !important;
    border: none !important;
	z-index:0!important;
	}
	.ranges {
    background: none;
    position: relative;
    border: none;
    border-radius: 3px;
    width: 200px;
    margin-top: 7px;
    -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin: 0 !important;
	}
	.ranges ul li.active {
    color: #fff!important;
    background-color: #5a99f6!important;
	}
	.addSubscriberNotes{background-image: linear-gradient(to bottom, rgba(255, 203, 101, 0.12), rgba(255, 255, 255, 0))!important; border-top: 1px solid #fcdcb2!important;}
	.addSubscriberNotes a#Addnotes{color: #f39c4c!important}
	.addSubscriberNotes button#notes_but{background: #f9b550!important; color: #fff!important; border-color: #f9b550!important}
	.mainchatsvroll2{min-height: 485px!important}
    #livesearch{width: 250px; background: #fff; z-index: 99;  margin-top: 5px; border-radius: 5px; position: relative; padding: 0px; }
	#livesearch ul{margin: 0; padding:10px;box-shadow: 0 3px 5px 0 rgba(1, 21, 64, 0.6);border-radius: 5px; position: relative;border: 1px solid #f4f6fa!important; }
	#livesearch ul li{list-style: none; margin:5px 0; padding: 0; font-size: 13px;}

	.userAdd {
		color: blue;
		padding: 5px 5px;
		margin-left: 0px;

	}
	.userAdd:hover {
		background-color: yellow;
		border: 1px solid;
		border-radius: 5px;
		padding: 5px 5px;
		margin-left: 10px;
	}

	.rmtag {
    position: absolute;
    top: -14px!important;
    right: 0px!important;
    color: #e44f73;
    background: #fdeef1;
    border-radius: 100px;
    width: 22px!important;
    height: 22px!important;
    line-height: 22px!important;
    font-size: 20px;
    display: none;
}
.tdropdown .fl_letters { float: left!important; }

	.chat-list .media {	margin-left: 42px; margin-top: 5px!important}
	.chat-list .media .media-annotation.user_icon {	left: -42px;}
	.chat-list .media.reversed {margin-right: 42px; margin-top: 5px!important}
	.chat-list .media.reversed .media-annotation.user_icon {right: -38px;}
	.chat-list .media-content{padding: 9px 15px!important; font-size: 14px!important; font-weight: 300!important}
	.slider-phone.contacts{line-height: 16px!important;}
	.team_list.droplist a span.icons.fl_letters{width: 16px !important; height: 16px !important; line-height: 17px!important; font-size: 7px!important; float: left; margin: 7px 7px 0 0!important;}

	.NotesThreadsBox.chat-list .media.reversed{margin-top: 30px!important}
</style>
<div class="col-md-6 pl6 pr6">
	<div class="panel panel-flat mb0">
		<div class="panel-heading">

		<!--New Search-->
<div style="width: 250px;float: left;margin: 5px 20px 0 0;display:none" class="chat_search_icon addtionalSearchDiv">
	<input style="width: calc(100% - 22px);"
	id="livesearchVal" onkeyup="showResult(this.value)" type="text" name="livesearchVal" value="" placeholder="Search">
	<button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
	<div id="livesearch"></div>
</div>
<!--New Search-->


			<h6 class="panel-title hIdelater"><a class="heading-elements-toggle"><i class="icon-more"></i></a> &nbsp; &nbsp;  <a style="cursor:pointer; float: left"><img src="/assets/images/phone_green.png" class="" alt="" style="margin-top: 5px;" width="" height="">&nbspWEB</a> &nbsp;  <b style="font-weight:300!important; display: none; color: #6a7995 !important; font-size: 12px; margin-bottom: 0px" class="bigwebassign"></b>  </h6>

			<div class="heading-elements" class="hIdelater">

                <div class="tdropdown">
					<a style="margin:0!important;" class="dropdown-toggle fsize13" data-toggle="dropdown" aria-expanded="false"><img width="16" src="/assets/images/user_img_blank.png"/> <b class="initUnassigned">Unassigned</b> <i class="icon-arrow-down22"></i></a>
					<ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right chat_dropdown">

						<li class="forceunassign" style="display: block;"><strong><a href="javascript:void(0)"><img src="/assets/images/user_img_blank.png"/> Unassigned</a></strong> </li>
						<li style="display: none;"> class="team_list" team_member_id="{{ $aUInfo->id }}" team_member_name="{{ $aUInfo->firstname.' '.$aUInfo->lastname }}" style="display: block;"><strong><a class="default team_active_{{ $loginMember }}" href="javascript:void(0)"><img src="/assets/images/user-06-a.png"/> Me</a></strong> </li>

                        @php
                        if($c_id == "") {
                            foreach ($teamMembers as $key=>$value) {
                        @endphp
						    <li class="team_list droplist"  team_member_id="{{ $value->id }}" team_member_name="{{ $value->firstname.' '.$value->lastname }}"><strong><a class="default team_active_{{ $value->id }}" href="javascript:void(0)">{!! showUserAvtar($value->avatar, $value->firstname, $value->lastname, 16, 16, 7) !!}{{ $value->firstname.' '.$value->lastname }}</a></strong> </li>
						@php
						    }
						}
						@endphp

					</ul>
				</div>
				<!--bottom div-->


				<!--<div class="tdropdown ml10 mr10">

					<a style="margin:0!important;" class="dropdown-toggle fsize13 daterangeChat" data-toggle="dropdown" aria-expanded="false"><img width="14" src="/assets/images/icon_clock_dark.png"/> <i class="icon-arrow-down22"></i></a>

				</div>-->

				<div class="tdropdown ml10 mr10 open">
										<a style="margin:0!important;" class="dropdown-toggle fsize13" data-toggle="dropdown" aria-expanded="true"><img src="/assets/images/icon_clock_dark.png" width="14"> <i class="icon-arrow-down22"></i></a>
										<ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right chat_dropdown">
										  <li><strong>Later today</strong> <span class="text-right pull-right">in 3 hours</span></li>
										  <li><strong>Tomorrow</strong> <span class="text-right pull-right">Sat 8am</span></li>
										  <li><strong>Monday</strong> <span class="text-right pull-right">Mon 8am</span></li>
										  <li><strong>One week</strong> <span class="text-right pull-right">Fri 2pm</span></li>
										  <li><strong>One month</strong> <span class="text-right pull-right">Apr 8</span></li>
										  <li><strong>Custom</strong> <span class="text-right pull-right">in 3 hours</span></li>
										</ul>
									  </div>



				<a href="javascript:void(0)" class="icons s20" style="background: #e6f7ef"><i class="fa fa-check txt_green"></i></a>
			</div>


		</div>

        <div class="tab-content">
		<!--===========TAB 1 WEB===========-->
			<div class="tab-pane active" id="massage_tab">
        <!-- WEB CHAT BOX -->
		<div class="panel-body p0 bkg_white minh_880 SecondDiv">


			<div class="p20 pr0 mainchatsvroll2" id="webparentsearch">


				<ul class="media-list chat-list messageThreadsBox WebChatTextarea" id="WebChatTextarea"  style="display:block; height: 615px!important; max-height: 615px!important; padding-right: 17px;">
                    <div class="msg_push_web"></div>

				</ul>

			</div>

			<!-- <div class="p20 pt0">
				<p class="fsize10 txt_grey txt_upper">Suggested:</p>
				<button class="btn suggested">How to import a teammate</button>
				<button class="btn suggested">Inviting a teammate</button>
				<button class="btn suggested">How can I add a teammate?</button>
			</div> -->

			<!-- WEB CHAT FOOTER BOX -->
			<div class="panel-footer p0 bkg_white no_shadow smschat_footer" >


                <!-- CHAT SHORTCUTS -->
			   <div style="display: none;" class="chat_shortcuts bigweb_chat_shortcut">
                                	<div class="p10 pl20 pr20 bbot">
                                				<div class="short_search_icon pull-left"><input class="Search_shortcut"  id="Search_shortcut" type="text" name="" value="" placeholder="Search shortcut">
												 <button type="submit"><img src="/assets/images/chat_search_icon.png"></button>
												</div>

                              				<div class="pull-right"><a style="cursor: pointer" class="txt_blue fsize13 bigweb_chat_create">Create &nbsp; <img width="14" height="14" src="/assets/images/chat_plus_icon.png"></a>&nbsp;
                              				<a href="javascript:void(0)" class="short_icon"><img width="14" height="14" src="/assets/images/close_red_20.png"></a>
                              				</div>

                               		<div class="clearfix"></div>
                                	</div>
                                	<div class="p10 pl20 pr20" style="overflow: auto; height: 200px">
                                		<ul id="shortcutBox"></ul>
                                	</div>
                                </div>
              <!-- CHAT SHORTCUTS -->

				<div class="p20">
                     <input type="hidden" id="em_id" value="">
                      <input type="hidden" id="userId_encode" value="">
                     <input type="hidden" id="em_token" value="">
                      <input type="hidden" id="em_current_user" value="">
                     <input type="hidden" id="em_image" value="">
                    <input type="hidden" id="em_inc_id" value="">
					<textarea id="messageContentBox" class="form-control addnote mb0 messageContent" placeholder="Shift + Enter to add a new line ,  Start with ‘/’ to select a  Saved Message"></textarea>


				</div>

				<div class="p20 btop" style="padding: 12px 20px!important">
					<div class="pull-left ">

						<a class="mr20 txt_grey msg active msg_tab_sec" href="#massage_tab" data-toggle="tab">Message</a>
						<a class="left_note txt_grey notes_tab_sec" href="#Notes_tabs" data-toggle="tab">Note</a>

					</div>
					<div class="pull-right">
					 <a id="" class="mr-15 short_icon bigweb_chat" href="javascript:void();"><img src="/assets/images/chat_list_icon.png"/> </a>
						<input style="display:none;" id="mmsFile" type="file">

						<div class="panel panel-default smilie_emoji supported_smilies_smschat hide" style="position:absolute; top:-194px; left:2px; background:#F0F0F0;"><div class="panel-heading"><span><strong>Supported Smilies</strong></span></div><div class="panel-body smiley_grid_smschat"></div></div>

						<a class="mr-15 smilieSmsIconMessage" href="javascript:void(0)"><img src="/assets/images/chat_grey_smiley.png"/> </a>
						<a class="mr-15" href="javascript:void(0)"><img src="/assets/images/chat_grey_image.png"/> </a>
						<a class="mr-15 smsFileAttechment" href="javascript:void(0)"><img src="/assets/images/chat_grey_attach.png"/> </a>
						<a class="mr-15" href="javascript:void(0)"><img src="/assets/images/chat_gray_calendar.png"/> </a>

						<button id="webChatButton" class="btn dark_btn btn-xs send_btn sendMsg">Send <img class="ml10" src="/assets/images/icon_send_arrow.png"></button>

					</div>
					<div class="clearfix"></div>
				</div>

			</div>
			<!-- WEB CHAT FOOTER BOX -->

		</div>
    <!-- WEB CHAT BOX -->
            </div>

          <!--===========TAB 2 Notes===========-->
             <div class="tab-pane" id="Notes_tabs">


					 <!-- Note BOX -->
					 @include('admin/web_chat/notes_listing')
      			     <!-- Note BOX -->

           </div>
            <!--===========TAB 2 Notes===========-->

        </div>

	</div>
</div>
<div class="col-md-3 pl6 ajaxUserinfo">
	<div class="panel panel-flat" style="overflow:inherit">
		<div class="panel-heading">
			<h6 class="panel-title">Profile</h6>
			<div class="heading-elements">
				<a class="table_more" href="#"><img src="/assets/images/more.svg"></a>
			</div>
		</div>
		<div class="panel-body p0 bkg_white minh_880" >
			<div class="profile_sec pb10" style="min-height:785px;">

				<div class="p40 text-center">
					<div class="profile_pic">
						<span class="picprofile"></span>
						<div class="profile_flags"><img src="/assets/images/flags/us.png"></div>
					</div>
					<h3 class="subs_name"></h3>
					<p class="text-size-small text-muted mb0"><span class="city"></span>, <span class="code"></span></p>
				</div>



				<div class="profile_headings">Info <a href="#" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>


				<div class="interactions xss p20">
					<ul>
						<li><span style="width: 15px; float: left;"><i class="fa fa-user"></i> </span><span class="userAdd"><strong class="subs_name"></strong></span> <input type="text" class="uAddText support_name" style="display:none;" name="support_name"> </li>

						<li><span style="width: 15px; float: left;"><i class="fa fa-envelope"></i> </span><span class="userAdd"><strong class="em"></strong></span> <input type="text" class="uAddText support_email" style="display:none;" name="support_email"> </li>

						<li><span style="width: 15px; float: left;"><i class="fa fa-phone"></i> </span><span class="userAdd"><strong class="ep main_web_phone"></strong></span> <input type="text" class="uAddText support_phone" style="display:none;" name="support_phone"></li>

						<li><i class="fa fa-clock-o"></i><strong>6AM, US/Estern</strong></li>
						<li><i class="fa fa-align-left"></i><strong>Opt-Out of All</strong></li>

						<li><i class="fa fa-globe"></i><strong>http://brandboost.io/alen.html</strong></li>


					</ul>
				</div>




				<div class="profile_headings">Segments <a href="javascript:void(0)" class="pull-right"><i class="fa fsize15 txt_grey fa-angle-down"></i></a></div>

				<div class="p20 pt15 pb0">

					<div id="tagBox"></div>
					<p class="count_tags" style="display: none">7 Tags</p>
					<button style="margin:0 10px 15px 0!important;" class="btn applyInsightTagsReviews dropdown-toggle btn-xs plus_icon ml10"><i class="icon-plus3"></i></button>




				</div>



				<!--<div class="p20 pt15 pb0">

					<div class="tdropdown">
					<button type="button" class="btn btn-xs btn_white_table bluee dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					 <p class="count_tags">7 Tags</p> <span class="caret"></span> </button>
						<button style="margin:0 10px 15px 0!important;" class="btn applyInsightTagsReviews dropdown-toggle btn-xs plus_icon ml10"><i class="icon-plus3"></i></button>
						<ul id="tagBox" style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss shadow p10">

						</ul>
					</div>
				</div>-->

			</div>
		</div>
	</div>
</div>
<div id="ReviewTagListModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmReviewTagListModal" id="frmReviewTagListModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
				</div>
                <div class="modal-body" id="tagEntireList"></div>

                <div class="modal-footer modalFooterBtn">
                	 <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" name="review_id" id="tag_review_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Apply Tag</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
var site_url = "{{ base_url() }}";
		site_url = site_url.replace(/\/$/, '');
		var socket = io(site_url+':3000');


	$(document).on("click", ".team_list", function () {
		var assign_to = $(this).attr('team_member_id');
		var team_member_name = $(this).attr('team_member_name');


		var room = $('#em_token').val();
		var user_id = $('#em_id').val();
		$.ajax({
               url: "{{ base_url('admin/webchat/reassignChat') }}",
                type: "POST",
               data: {room: room,assign_to:assign_to,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                	console.log(data);
                	socket.emit('reassign_post_data', {room:room, assign_to:assign_to, assign_from:data.preTeamId,assign_to_name:team_member_name ,user_id:user_id});

				}
		});

	});



$(document).on("click", ".forceunassign", function () {

		var room = $('#em_token').val();
		var user_id = '{{ $loginMember }}';
		$.ajax({
               url: "{{ base_url('admin/smschat/unassignChat') }}",
                type: "POST",
               data: {room: room,user_id:user_id},
                dataType: "json",
                success: function (data) {
                	if(data[0].preTeamId == 0)
                	{
                		displayMessagePopup('warnning', 'warnning', 'already Unassigned');

                	} else if(data[0].preTeamId == 1)
                	{

                		displayMessagePopup('warnning', 'warnning', 'You can not Unassigned other chats');
                	}
                	else
                	{
                	  socket.emit('forceunassign_post_data', {room:room,user_id:user_id,preTeamId:data[0].preTeamId});
                    }

				}
		});

	});




$(document).on("click", ".addTagfweb", function () {
var groupID = $(this).attr('groupID');
var txtTagName = $('#txtTagName_'+groupID).val();

$('#figure_'+groupID).css('margin-top','13px');
$('#figure_'+groupID).show();
$('#addnewtag_'+groupID).hide();


	if(txtTagName!="")
	  {
            $.ajax({
                url: "{{ base_url('admin/tags/addgroupentity') }}",
                type: "POST",
                data: {txtTagName: txtTagName,groupID:groupID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                       $('.applyInsightTagsReviews').trigger('click');
						} else if (data.status == 'error' && data.type == 'duplicate_entry') {
                        //$("#AddGroupEntityduplicateValidation").html(data.msg).show();
                        alert(data.msg);

					}
				}
			});
     }
     else
     {
     	$('#figure_'+groupID).css('margin-top','0px');
     	$('#figure_'+groupID).hide();
        $('#addnewtag_'+groupID).show();
     	$('#txtTagName_'+groupID).css('border-color','red');

     }


            return false;
		});


        $(document).on("click", ".addnewtag", function () {
            var groupid = $(this).attr('data-group-id');
            $("#addnewtag_" + groupid).toggle();
		});

      $(document).on("click", ".hidenewtag", function () {
      	var hideaddnewtag = $(this).attr('dataId');

            $('#addnewtag_'+hideaddnewtag).hide();

		});


        $("#frmReviewTagListModal").submit(function () {
        	var userID = $('#em_id').val();
            var formdata = $("#frmReviewTagListModal").serialize();
            $.ajax({
                url: "{{ base_url('admin/webchat/applyWebTag') }}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#review_tag_" + data.id).html(data.refreshTags);
                        $("#ReviewTagListModal").modal("hide");

						$.ajax({
						url: "{{ base_url('admin/webchat/getWebTaglist') }}",
						type: "POST",
						data: {'userId':userID,_token: '{{csrf_token()}}'},
						success: function (dataval) {
                         var obj =  $.parseJSON(dataval);
                         console.log(obj[0].taglist);
						var taglist = obj[0].taglist;
						//console.log(typeof taglist);
						if(jQuery.isEmptyObject(taglist)) {
						$('.count_tags').html('0 Tags');
						}
						else
						{
						var taglistitem="";
						for(var i=0;i<taglist.length;i++)
						{
						    taglistitem += '<button id="Tag_but_'+taglist[i].tag_id+'"  class="btn btn-xs btn_white_table pr10">'+taglist[i].tag_name+' <span GrpId='+taglist[i].group_id+' tag_id='+taglist[i].tag_id+' review_id='+taglist[i].review_id+' class="rmtag">x</span></button>';

						}
						$('.count_tags').html(taglist.length+'Tags');
						$('#tagBox').html(taglistitem);
						}

						}


						});
					}
				}
			});
            return false;
		});


            $(document).on("click", ".applyInsightTagsReviews", function () {
            var review_id = $('#userId_encode').val();
            var action_name = 'review-tag';
            $.ajax({
                url: "{{ base_url('admin/webchat/listAllTagsWebchat') }}",
                type: "POST",
                data: {review_id: review_id,_token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        var dataString = data.list_tags;
                        if (dataString.search('have any tags yet :-') > 0) {
                            $('.modalFooterBtn').hide();
							} else {
                            $('.modalFooterBtn').show();
						}
                        $("#tagEntireList").html(dataString);
                          $("#tag_review_id").val(review_id);
                        //$("#tag_feedback_id").val(feedback_id);
                        if (action_name == 'review-tag') {
                            $("#ReviewTagListModal").modal("show");
							} else if (action_name == 'feedback-tag') {
                            $("#FeedbackTagListModal").modal("show");
						}
					}
				}
			});
		});


    function set_shortcut(content)
    {
         var prev_val = $('#messageContentBox').val();
         prev_val = prev_val.replace('/','');
         var new_val = prev_val.concat(" ").concat(content);
    	 $('#messageContentBox').val(new_val);
    	 $('.chat_shortcuts').hide();
    	 $('#messageContentBox').focus();
    }



$(document).ready(function() {


	$(document).on('click', '.userAdd', function() {
		$(this).hide();
		$(this).next().show();
		$(this).next().focus();
	});



	$(document).on('click', '#Webonly .short_icon', function(){
			$.ajax({
			url: "{{ base_url('admin/smschat/shortcutListing') }}",
			type: "POST",
			data: { _token: '{{csrf_token()}}'},
			dataType: "html",
			success: function (data) {
				$('#shortcutBox').html(data);
				$('.chat_shortcuts').toggle();
			}
		});

	});


	$('#Webonly #Search_shortcut').on("keyup", function() {
		var textInput = $( this ).val().toLowerCase();

		$("#Webonly .shortcutlisting").filter(function() {
			$(this).toggle($(this).find('.shortcut_name').text().toLowerCase().indexOf(textInput) > -1)
		});


	});

});


	$(document).on('click', '.bigweb_chat_create', function(){
	//var user_id = $(this).attr('user_id');
		$('#addChatShortcutList').modal();
		var DynamicId = "bigweb_chat_"+$('#em_inc_id').val();
		var DynamicId_shortcut = "bigweb_chat_shortcut_"+$('#em_inc_id').val();

		$('#dvalue').val(DynamicId);
		$('#dvalue_shortcut').val(DynamicId_shortcut);

})

</script>
