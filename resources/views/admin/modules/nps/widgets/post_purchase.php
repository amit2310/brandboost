<div class="bb-loaded">&nbsp;</div>
<div id="bbrefpopup" style="display:none;">
    <div class="modal-dialog" style="width: 100%; position: absolute; bottom: 0px;" >
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
                            <h3>Thank you for your order!</h3>

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
                                    Here is your referral link. Share it with your friends and network and get rewards
                                    <strong><h3><?php echo $refLink;?></h3></strong>
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