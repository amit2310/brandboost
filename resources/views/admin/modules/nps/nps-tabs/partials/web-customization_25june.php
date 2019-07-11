<div class="col-md-9">
    <div style="margin: 0;" class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title pull-left display-inline-block">Preview</h6> &nbsp; &nbsp; 
            <h6 class="panel-title display-inline-block"><a href="#"><i class="icon-rotate-ccw3"></i>&nbsp; Undo</a></h6> &nbsp; &nbsp; 
            <h6 class="panel-title display-inline-block"><a href="#"><i class="icon-rotate-cw3"></i>&nbsp; Redo</a></h6>

            <div class="heading-elements">
                <h6 class="panel-title display-inline-block"><a style="color: #4cbb85;" class="active" href="#"><i class="icon-display"></i>&nbsp; Desktop </a></h6>
                <h6 class="panel-title display-inline-block"><a href="#"><i class="icon-ipad"></i>&nbsp; Tablet</a></h6>
                <h6 class="panel-title display-inline-block"><a href="#"><i class="icon-iphone"></i>&nbsp; Mobile</a></h6>
            </div>

        </div>
        <div class="panel-body p20">
            <div class="widget_sec">
                <!--========review_widget================-->
                <div class="rating_widget">

                    <div class="emil_priview_sec">			
                        <div class="product_ratings">
                            <div class="white_box text-center p50 mb0">

                                <?php //$oNPS->brand_logo = ''; ?>

                                <div class="product_icon"><img src="<?php echo (!empty($oNPS->brand_logo)) ? 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $oNPS->brand_logo : base_url() . 'assets/images/apple_icon.png'; ?>" class="logo_img"/></div>
                                <p align="center" style="color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000'; ?>;text-align:center"class="questionText"><?php echo (!empty($oNPS->question)) != '' ? $oNPS->question : '{QUESTION}'; ?></p>
                                <p><span class="introductionText" style="color:<?php echo!(empty($oNPS->web_int_text_color)) ? $oNPS->web_int_text_color : '#000'; ?>;"><?php echo (!empty($oNPS->description)) != '' ? $oNPS->description : '{INTRODUCTION}'; ?></span></p>
                            </div>

                            <div style="margin-top: 1px;" class="white_box text-center">
                                <ul class="rating_numbers">
                                    <li><a href="#" style="color:<?php echo!(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#000000'; ?>; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>;" class="buttonStyle">1</a>
                                    </li>
                                    <li><a href="#" style="color:<?php echo!(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#000000'; ?>; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>;" class="buttonStyle">2</a>
                                    </li>
                                    <li><a href="#" style="color:<?php echo!(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#000000'; ?>; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>;" class="buttonStyle">3</a>
                                    </li>
                                    <li><a href="#" style="color:<?php echo!(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#000000'; ?>; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>;" class="buttonStyle">4</a>
                                    </li>
                                    <li><a href="#" style="color:<?php echo!(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#000000'; ?>; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>;" class="buttonStyle">5</a>
                                    </li>
                                    <li><a href="#" style="color:<?php echo!(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#000000'; ?>; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>;" class="buttonStyle">6</a>
                                    </li>
                                    <li><a href="#" style="color:<?php echo!(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#000000'; ?>; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>;" class="buttonStyle">7</a>
                                    </li>
                                    <li><a href="#" style="color:<?php echo!(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#000000'; ?>; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>;" class="buttonStyle">8</a>
                                    </li>
                                    <li><a href="#" style="color:<?php echo!(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#000000'; ?>; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>;" class="buttonStyle">9</a>
                                    </li>
                                    <li><a href="#" style="color:<?php echo!(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#000000'; ?>; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>;" class="buttonStyle">10</a>
                                    </li>

                                </ul>
                            </div>
                        </div>	
                    </div>
                </div>
                <!--========review_widget end================-->

                <img class="w100" src="/assets/images/config_bkg.png"/>

            </div>
        </div>
    </div>
</div>