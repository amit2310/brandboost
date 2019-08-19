<div class="bb-loaded">&nbsp;</div>
<div class="bb_msg_box" id="bbrefpopup" style="display:none;">
  <div class="bb_msg_head">
    <div class="bb_drop_icon"><a href="javascript:void(0);" class="bb_close_popup"><i class="fa fa-close"></i></a></div>
    <p>Get Reward Free</p>
  </div>
  
  <!---- start chat with user name section ---->
  <div id="bb_msg_wrap_new" >
    <div class="bb-form-group new">
      <?php if(!empty($tagTitle)): ?>
	<p><?php echo $tagTitle;?></p>
	<?php endif; ?>
      <img width="50" src="<?php echo base_url(); ?>/assets/images/gift-reward.png"/>
      <?php if(!empty($tagLineDesc)): ?>
		<p><?php echo $tagLineDesc;?></p>
		<?php endif; ?>
      <div class="">
		<input type="hidden" name="bb-account-id" id="bb-account-id" value="<?php echo $accountID; ?>" >
        <input name="bbrefname" id="bbrefname" class="form-control user" placeholder="Your Name" type="text" required="">
      </div>
      <div class="">
        <input name="bbrefemail" id="bbrefemail" class="form-control email" placeholder="Your Email" type="text" required="">
      </div>
      <div class="">
        <input class="bbrefsubmit form-control" name="bbrefsubmit" value="Generate My Referral Link" type="button">
      </div>
	  <div class="">
			<div class="bb-hidden bb_txt_success">Thank you for signing up, copy your referral link and share it with your friend. Here is your referral link given below:<br>
				<h2 id="showmyreflink"></h2></div>
			<div class="bb-hidden bb_txt_danger">Error while creating your referral link. Try again</div>
		</div>
    </div>
  </div>
</div>