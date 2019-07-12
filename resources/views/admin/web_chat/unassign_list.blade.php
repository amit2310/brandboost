
 <?php 

    $count=0;
    $flag=0;
$unassignedchatlist = getTeamUnAssignDataHelper();
foreach( $unassignedchatlist as $key=>$value)
{
 $token="";
 $token = $value->room;
 $userid = $value->user;
 $userMessage="";
 $chatName = explode(" ",$value->user_name );
 $getlastmessage = getlastChatMessage($token);
 $chatMessageRes = $getlastmessage[0];
 $getlastmessage = $getlastmessage[0];
 $getlastCreated =  $getlastmessage->created;
  $getlastmessage =  $getlastmessage->message;
  

   $fileext = explode('.', $getlastmessage);
   $fileext = end($fileext);
        if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
        $userMessage = "File Attachment";
        }
        else if (strpos($getlastmessage, '/Media/') !== false) {
        $userMessage="File Attachment";
        }
        else if (strpos($getlastmessage, 'amazonaws') !== false) {
        $userMessage="File Attachment";
        }

        else {
        $userMessage = setStringLimit($getlastmessage, 80);
        }


?>
<div class="tk_<?php echo $token; ?> activityShow <?php echo $count; ?> media chatbox_new bkg_white <?php if($count == 1){ echo 'bbot'; } ?>" style="<?php  if($count > 7) {  echo "display:block";   }  if($count == 1){ echo 'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px'; } if($count==2) {  echo 'border-radius:5px 5px 5px 5px';  }?>"> 
    <a href="javascript:void(0);" class="media-link <?php if($count!=1){ echo 'bbot'; } ?> getChatDetails WebBoxList <?php echo $count == 0 ? '' : ''; ?>" userId="<?php echo $value->user; ?>" RwebId="<?php echo $token; ?>" >
        <div class="media-left"><?php echo  showUserAvtar($usersdata->avatar, $chatName[0], $chatName[1],28,28,12); ?>
            <!-- <i class="fa fa-star-o star_icon"></i> -->
            <i class="fa star_icon <?php echo $value->favourite == 1?'fa-star yellow':'fa-star-o'; ?> favouriteUser" userId="<?php echo $value->id; ?>"></i>
        </div>

        <div class="media-body"> 
            <span class="fsize12 txt_dark"><?php echo $chatName[0]; ?> <?php echo $chatName[1]; ?></span> 
            <span class="slider-phone contacts txt_dark" style="margin:0px; color: #6a7995!important;font-weight:bold; font-size:12px!important"><?php echo $userMessage; ?></span> 
           
        </div>
        <div class="media-right" style="width: 90px"><span class="date_time txt_grey fsize11"><time class="autoTimeUpdate autoTime_<?php echo  $userid; ?>"  datetime="<?php echo usaDate($getlastCreated); ?>" title="<?php echo usaDate($getlastCreated); ?>"></time>

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
<script>
$(document).ready(function() {
  $(".autoTimeUpdate").timeago();
});
</script>

