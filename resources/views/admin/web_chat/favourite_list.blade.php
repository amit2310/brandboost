<?php
$count = 0;
$flag = 0;
$userMessage = "";
foreach ($favchatlist as $key => $value) {
    $token = "";
    $userid="";
    $chatMessage = "";
    $created = "";
    $first_name = "";
    $last_name = "";
    $nameDetails = explode(" ", $value->user_name);
    $first_name = $nameDetails[0];
    $last_name = $nameDetails[1];

    $token = $value->room;
    $userid = $value->user;
    $chatMessageRes = getLastMessage($token);
    $chatMessage = $chatMessageRes->message;
    $created = $chatMessageRes->created;
   
        $fileext = explode('.', $chatMessage);
        $fileext = end($fileext);
        if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
        $userMessage = "File Attachment";
        }
        else if (strpos($chatMessage, '/Media/') !== false) {
        $userMessage="File Attachment";
        }
        else if (strpos($chatMessage, 'amazonaws') !== false) {
        $userMessage="File Attachment";
        }

        else {
        $userMessage = setStringLimit($chatMessage, 80);
        }
        
?>
<div class="activityShow <?php echo $count; ?> media chatbox_new bkg_white <?php if ($count == 1) {
            echo 'bbot';
        } ?>" style="<?php if ($count > 7) {
            echo "display:block";
        }
        if ($count == 1) {
            echo 'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px';
        }
        if ($count == 2) {
            echo 'border-radius:5px 5px 5px 5px';
        } ?>"> 
	<a href="javascript:void(0);" class="media-link <?php if ($count != 1) {
            echo 'bbot';
        } ?> tk_<?php echo $token; ?> getChatDetails WebBoxList <?php echo $count == 0 ? 'activechat' : ''; ?>" userId="<?php echo  $userid; ?>" 
        assign_to="<?php echo assignto($token); ?>" RwebId="<?php echo $token; ?>">
		
		
		<div class="media-left"><?php echo showUserAvtar($usersdata->avatar, $first_name, $last_name, 28, 28, 12); ?>
		<i class="fa  star_icon <?php echo $value->favourite == 1?'fa-star yellow':'fa-star-o'; ?> favouriteUser" userId="<?php echo $value->id; ?>"></i>
		</div>

		<div class="media-body"> 
			<span class="fsize12 txt_dark"><?php echo $first_name; ?> <?php echo $last_name; ?></span> 
           
           <span style="color: #6a7995!important; font-size: 12px!important; font-weight: 300!important " id="Big_assign_<?php echo  $userid; ?>" class="fsize12 assign_to"><span style="float: left; color: #6a7995!important; font-size: 12px!important; font-weight: 300!important  ">
            <?php if(assignto($token)!=""){ ?>Assigned to:&nbsp </span><?php echo assignto($token); } ?></span>
            
            
			<span id="Big_assign_message_<?php echo  $userid; ?>" class="slider-phone contacts txt_dark" style="margin:0px;font-weight:bold; font-size:12px!important"><?php echo $userMessage; ?></span> 
		</div>
		
		
		<div class="media-right" style="width:100px;"><span class="date_time txt_grey fsize11"><time class="autoTimeUpdate autoTime_<?php echo $userid; ?>"
         datetime="<?php echo $created; ?>"></time>

            <span class="read_status_<?php echo $userid; ?>">
			<?php 
            $readStatus = $chatMessageRes->read_status;
            if($readStatus == 1 || $chatMessageRes->user_to == $userid) {
                ?><i class="fa fa-circle txt_green fsize7"></i><?php
            }
            else {
                ?><i class="fa fa-circle txt_red fsize7"></i><?php
            }
			?>
            </span>
			
			</span></div>

	</a> 
</div>
<?php
        $count++;
      
    }

?>