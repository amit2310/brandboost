<div class="tab-pane <?php echo ($defalutTab == 'platform')? 'active': '';?>" id="right-icon-tab1">
    <div class="row">
        <div class="col-md-12">
            <div style="margin: 0;" class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Review Source</h6>
                </div>
                <div class="panel-body p30">
                    <div class="row surveySourceBox">
					
                        <div class="col-md-3 review_source">
                            <div class="inner pb20 <?php echo ($oNPS->platform == 'email')? 'active' : '';?>">
                                
                                <figure><img src="/assets/images/rs_email.png"/></figure>
                                <div class="text_sec">
                                <p><strong>Email</strong></p>
                                <h5>Send Serverys to your <br>customers using emails</h5>   
                                </div>
                                <a href="javascript:void(0);" class="btn dark_btn bkg_purple selectwidget" data-nps-id="<?php echo $oNPS->id;?>" data-platform="email"> Setup</a>
                            </div>	
                        </div>

                        <div class="col-md-3 review_source">
                            <div class="inner pb20 <?php echo ($oNPS->platform == 'web')? 'active' : '';?>">

                                <figure><img src="/assets/images/rs_desk.png"/></figure>
                                <div class="text_sec">
                                <p><strong>Website</strong></p>
                                <h5>Survery your customers directly<br> on your website </h5>   
                                </div>
                                <a href="javascript:void(0);" class="btn dark_btn bkg_purple selectwidget" data-nps-id="<?php echo $oNPS->id;?>" data-platform="web"> Setup</a>

                            </div>	
                        </div>

                        <div class="col-md-3 review_source">
                            <div class="inner pb20 <?php echo ($oNPS->platform == 'sms')? 'active' : '';?>">

                                <figure><img src="/assets/images/rs_sms.png"/></figure>
                                <div class="text_sec">
                                <p><strong>SMS</strong></p>
                                <h5>Send Surveys to your customers<br> using mobile phones</h5> 
                                </div>
                                <a href="javascript:void(0);" class="btn dark_btn bkg_purple selectwidget" data-nps-id="<?php echo $oNPS->id;?>" data-platform="sms"> Setup</a>

                            </div>	
                        </div>
						
						<div class="col-md-3 review_source">
                            <div class="inner pb20 <?php echo ($oNPS->platform == 'link')? 'active' : '';?>">

                                <figure><img src="/assets/images/re_link.png"/></figure>
                                <div class="text_sec">
                                <p><strong>Link</strong></p>
                                <h5>Survery your customers directly<br>in a branboost page</h5> 
                                </div>
                                <a href="javascript:void(0);" class="btn dark_btn bkg_purple selectwidget" data-nps-id="<?php echo $oNPS->id;?>" data-platform="link"> Setup</a>

                            </div>	
                        </div>
						
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    







<script>
    $(document).ready(function () {

        $(".selectwidget").click(function () {
            $('.overlaynew').show();
            var nps_id = $(this).attr("data-nps-id");
            var selectedPlatform = $(this).attr("data-platform");
            $.ajax({
                url: '<?php echo base_url('admin/modules/nps/choosePlatform'); ?>',
                type: "POST",
                data: {nps_id:nps_id, platform:selectedPlatform},
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {

                        window.location.href= '<?php echo base_url("/admin/modules/nps/setup/{$programID}?t=customize") ?>';

                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
            return false;
        });

    });
</script>