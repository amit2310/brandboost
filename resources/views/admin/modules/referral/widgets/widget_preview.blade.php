<style>
	.msg_box {
		position:absolute!important;
		bottom: 40px;
		width: 340px;
		right: 40px;
		background: white;
		z-index: 9!important;
		border-radius: 10px;
		font-size: 14px;
		box-sizing: border-box;
		font-family: 'Inter UI';
		font-weight: 400;
		box-shadow: 0 3px 2px 0 rgba(0, 3, 49, 0.03), 0 1px 1px 0 rgba(0, 17, 136, 0.03), 0 10px 20px 0 rgba(0, 0, 54, 0.03);
	}
	.bb_msg_head {
		color: #fff;
		padding: 19px;
		border-radius: 10px 10px 0px 0px;
		position: relative;
		font-size: 13px;
		width: 100%;
		box-sizing: border-box;
		box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.13);
		background-image: linear-gradient(103deg, #5c37f2, #aa7bff);
		height: 60px;
		text-align: center;
	}
	.bb_msg_head.big {
		height: 280px;
		text-align: center;
		padding: 45px 28px
	}
	.bb_msg_head p {
		font-weight: 500;
		font-size: 16px;
		line-height: 20px;
		margin: 0;
	}
	.bb_msg_head p span {
		font-size: 13px;
		font-weight: 400;
	}
	.bb_drop_icon {
		position: absolute;
		top: 20px;
		right: 23px;
		width: 15px;
		height: 15px;
	}
	.bb_drop_icon a {
		color: #fff;
		opacity: 0.5
	}
	.bb-form-group.new {
		padding: 25px 30px;
		text-align: center;
	}
	.bb-form-group p {
		margin: 15px 0;
		text-align: center;
		font-size: 14px!important;
		color: #09204f!important;
		line-height: 1.5;
	}
	.bb-form-group .form-control {
		width: 100%;
		padding: 6px 6px 6px 45px;
		margin: 0px 0 15px;
		box-sizing: border-box;
		border-radius: 5px;
		height: 52px;
		box-shadow: 0 1px 1px 0 rgba(1, 21, 64, 0.08);
		border: none;
		background: #fff;
		font-size: 14px;
		color: #5e729d!important;
		font-family: 'Inter UI'!important;
		font-weight: 300!important;
	}
	.bb-form-group .form-control.user {
		background: url(/assets/images/icon_user.png) 20px 21px no-repeat #fff;
		border: 1px solid #eee;
	}
	.bb-form-group .form-control.email {
		background: url(/assets/images/icon_envalope_small.png) 20px 21px no-repeat #fff;
		border: 1px solid #eee;
	}
	.bb-form-group textarea.form-control {
		font-family: 'Inter UI'!important;
		padding: 20px!important;
		height: 165px;
		resize: none;
	}
	.bb-form-group input[type=button] {
		height: 52px;
		box-shadow: 0 1px 1px 0 rgba(27, 147, 255, 0.2), 0 2px 4px 0 rgba(27, 147, 255, 0.05), inset 0 -1px 0 0 rgba(0, 0, 0, 0.05), inset 0 1px 0 0 rgba(255, 255, 255, 0.1);
		/*background-color: #1b93ff;*/
		background-image: linear-gradient(259deg, #9b83ff, #6145d4) !important;
		color: #fff!important;
		padding: 0;
		margin: 0!important;
	}
	.bb_cboth {
		clear: both;
	}
</style>

<div class="msg_box">
  <div class="bb_msg_head">
    <div class="bb_drop_icon"><a href="#"><i class="fa fa-close"></i></a></div>
    <p>Get Reward Free</p>
  </div>
  
  <!---- start chat with user name section ---->
  <div id="bb_msg_wrap_new" >
    <div class="bb-form-group new">
      <p><?php echo $oReferral['tagTitle']; ?></p>
      <img width="50" src="http://brandboost.io/assets/images/gift-reward.png"/>
      <p><?php echo $oReferral['tagLineDesc']; ?></p>
      <div class="">
        <input name="bb_chat_username" id="" class="form-control user" value="" type="text" required placeholder="Enter your name">
      </div>
      <div class="">
        <input name="bb_chat_username" id="" class="form-control email" value="" type="text" required placeholder="Enter your email adress">
      </div>
      <div class="">
        <input name="bb_un_submit_btn" id="" class="form-control bb_un_submit_btn" value="Generate My Referral Link" type="button">
      </div>
    </div>
  </div>
</div>