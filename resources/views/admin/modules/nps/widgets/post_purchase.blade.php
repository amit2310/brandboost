<div class="bb-loaded">&nbsp;</div>
<div id="bbrefpopup" style="display:none;">
    <div class="modal-dialog" style="width: 100%; position: absolute; bottom: 0px;" >
        <div class="modal-content">
            <div class="">
                <!--==================================================scroll==================================================-->
                <div class="bb_widget_container"> 
                    <!--========bb_logo========-->
                    <div class="bb_logo"> <a class="fleft" href="#"><img src="{{ site_url() }}assets/images/bb_review_logo.png"/></a> <a data-dismiss="modal" class="fright" href="#"><img src="{{ site_url() }}assets/images/cross.png"/></a>
                        <div class="cboth"></div>
                    </div>
                    <!--========bb_main========-->
                    <div class="bb_main">
                        <div class="bb_heading">
                            <h3>Thank you for your order!</h3>
                        </div>
                        <div class="bb_body">
                            <div class="mainrev" id="shadownone">
                                @if(!empty($tagTitle))
									<h2>{{ $tagTitle }}</h2>
                                @endif
                                <img src="{{ site_url() }}assets/images/gift-reward.png" style="width:100px;position:relative;left:150px;"/>
                                
								@if(!empty($tagLineDesc))
									<h3>{{ $tagLineDesc }}</h3>
                                @endif
                                
                                <div class="row bb_forms">
                                    Here is your referral link. Share it with your friends and network and get rewards
                                    <strong><h3>{{ $refLink }}</h3></strong>
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