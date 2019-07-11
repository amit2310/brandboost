<div class="bb-loaded">&nbsp;</div>
<div id="bbrefpopup" style="display:none;">
    <div class="modal-dialog" style="width: 100%; position: relative;" >
        <div class="modal-content">
            <div class="">

                <!--==================================================scroll==================================================-->
                <div class="bb_widget_container"> 
                    <!--========bb_logo========-->
                    <div class="bb_logo"> <a class="fleft" href="#"><img src="<?php echo site_url();?>assets/images/bb_review_logo.png"/></a> <a data-dismiss="modal" class="fright" href="#"><img src="<?php echo site_url();?>assets/images/cross.png"/></a>
                        <div class="cboth"></div>
                    </div>
                    <!--========bb_main========-->
                    <div class="bb_main">
                        <div class="bb_heading">
                            <h3>Get Reward Free</h3>

                        </div>
                        <div class="bb_body">
                            <div class="mainrev" id="shadownone">
                                <?php if(!empty($tagTitle)): ?>
                                <h2><?php echo $tagTitle;?></h2>
                                <?php endif; ?>
                                <img src="<?php echo site_url();?>assets/images/gift-reward.png" style="width:100px;position:relative;left:150px;"/>
                                <?php if(!empty($tagLineDesc)): ?>
                                <h3><?php echo $tagLineDesc;?></h3>
                                <?php endif; ?>
                                
                                
                                <div class="row bb_forms">
                                    <input type="hidden" name="bb-account-id" id="bb-account-id" value="<?php echo $accountID; ?>" >
                                    
                                    <div class="w100">
                                        <input name="bbrefname" id="bbrefname" placeholder="Your Name" type="text" required="">
                                    </div>
                                    <div class="w100">
                                        <input name="bbrefemail" id="bbrefemail" placeholder="Your Email" type="text" required="">
                                    </div>
                                    <div class="w100">
                                        <input class="bbrefsubmit" name="bbrefsubmit" id="bbrefsubmit" value="Generate My Referral Link" type="button">
                                    </div>
                                    <div class="w100">
                                        <div class="w100 alert alert-success bb-hidden bb_txt_success">Thank you for signing up, copy your referral link and share it with your friend. Here is your referral link given below:<br>
                                            <h2 id="showmyreflink"></h2></div>
                                        <div class="w100 alert alert-danger bb-hidden bb_txt_danger">Error while creating your referral link. Try again</div>
                                        
                                    </div>
                                </div>
                                
                            </div>


                        </div>
                    </div>
                    <!--========bb_main========-->
                </div>

                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>