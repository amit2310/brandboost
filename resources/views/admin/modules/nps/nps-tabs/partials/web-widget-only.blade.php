<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
    .nps_bb_cboth{clear: both;}
    .nps_bb_bot_widget{position:absolute; bottom: 0; left: 0;  background: #fff; text-align: center; padding:0; box-sizing: border-box; box-shadow: 0px 10px 30px 17px rgba(12, 12, 44, 0.05), 0 2px 2px 0 rgba(0, 0, 0, 0.03);  font-family: 'Open Sans', sans-serif; width: 100%; }	
    .nps_bb_bot_widget h3{ font-size: 15px; font-weight: 600; margin:20px 0;}
    .nps_bb_footer_box{width: 100%;padding: 15px;border-radius:0px;background-color: #ffffff;position: relative; margin-top: 1px;box-sizing: border-box; margin: 0; border-top: 1px solid #eee;}
    .nps_bb_rating{margin: 0; padding: 0;}
    .nps_rating_lists{list-style: none; display: inline-block; font-size: 12px; color: #ccc; line-height: 23px; margin: 0 2px;}
    .nps_rating_numbers{display: inline-block; border-radius: 3px; background: #636363; color: #fff; text-decoration: none; text-align: center; width: 23px; height: 23px; font-size: 12px; font-weight: 400; }
    .nps_poweredby{position: absolute; right: 20px; top: 20px; font-size: 12px; margin: 0;}
    .bb_nps_widget_close{position: absolute; right: 20px; top: 20px; font-size: 15px; margin: 0; color: #636363; text-decoration: none; font-weight: 600;}

    .nps_bb_form_box{ width:500px; margin: 15px auto; display: none; box-sizing: border-box; text-align: left;}
    .nps_bb_form_box .bb_nps_input {border-radius: 0px;box-shadow: 0 2px 1px 0 rgba(0, 57, 163, 0.03);background-color: #ffffff;border: solid 1px #e3e9f3;appearance: none;	-webkit-appearance: none;
    -moz-appearance: none;	position: relative;	height: 32px;box-sizing: border-box;width: 100%;margin-bottom: 5px;	padding: 10px;	color: #666;}
    .nps_bb_form_box .bb_nps_textarea {min-height: 80px;	resize: none;padding: 10px;	font-family: 'Open Sans', sans-serif;font-size: 13px;color: #666;height: 80px;}
    .bb_nps_submit_a {background: #000;height: 35px;padding: 7px 20px;font-weight: 400;border-radius: 0px;font-size: 13px;color: #fff;border: none;	margin-top: 10px;float: right;}

    .bb_nps_success_box{position: absolute; padding: 30px; bottom: 0; left: 0; width: 100%; background: #fff; box-sizing: border-box; text-align: center;  border-box; box-shadow: 0px 10px 30px 17px rgba(12, 12, 44, 0.05), 0 2px 2px 0 rgba(0, 0, 0, 0.03);  font-family: 'Open Sans', sans-serif; display: none;}
    .bb_nps_success_box p{font-size: 13px; font-weight: 600;}
    .bb_nps_success_box p a{font-size: 13px; font-weight: 600; color: #1d88d3; text-decoration: none;}
    .bb_nps_success_box h3{margin: 0; font-size: 18px; color: #7aa32a; font-weight: 600;}
    .bb_nps_success_box h4{margin: 15px 0 25px; font-size: 16px; color: #333333; font-weight: 600;}
    .bb_nps_success_box img.nps_share_btn{height: 25px; border-radius: 3px; margin: 0 3px;}
</style>

<div class="widget_sec">
    <!--========NPS WIDGET NEW================-->
    <div class="nps_bb_bot_widget" id="nps_bb_bot_widget">
        <a class="bb_nps_widget_close" href="javascript:void(0);"><i class="fa fa-times-circle"></i></a>
        <div class="product_icon"  style="top:-45px!important;"><img style="width:50px;" src="{{ (!empty($oNPS->brand_logo)) ? 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $oNPS->brand_logo : base_url() . 'assets/images/apple_icon.png' }}" class="logo_img"/></div>
        <h3 class="introductionText" style="color:{{ !(empty($oNPS->web_int_text_color)) ? $oNPS->web_int_text_color : '#000' }};">{{ (!empty($oNPS->description)) != '' ? $oNPS->description : '{INTRODUCTION}' }}</h3>
        <h3 class="questionText" style="color:{{ !(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000' }};">{{ (!empty($oNPS->question)) != '' ? $oNPS->question : '{QUESTION}' }}</h3>
 
        <div class="nps_bb_footer_box">
            <ul class="nps_bb_rating">
                <li class="nps_rating_lists">Not Likely</li>
                <li class="nps_rating_lists">
                    <a class="nps_rating_numbers buttonStyle" href="javascript:void(0);" style="color:{{ !(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#ffffff' }}; background:{{ (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#636363' }};">1</a>
                </li>
                <li class="nps_rating_lists">
                    <a class="nps_rating_numbers buttonStyle" href="javascript:void(0);" style="color:{{ !(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#ffffff' }}; background:{{ (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#636363' }};">2</a>
                </li>
                <li class="nps_rating_lists">
                    <a class="nps_rating_numbers buttonStyle" href="javascript:void(0);" style="color:{{ !(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#ffffff' }}; background:{{ (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#636363' }};">3</a>
                </li>
                <li class="nps_rating_lists">
                    <a class="nps_rating_numbers buttonStyle" href="javascript:void(0);" style="color:{{ !(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#ffffff' }}; background:{{ (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#636363' }};">4</a>
                </li>
                <li class="nps_rating_lists">
                    <a class="nps_rating_numbers buttonStyle" href="javascript:void(0);" style="color:{{ !(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#ffffff' }}; background:{{ (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#636363' }};">5</a>
                </li>
                <li class="nps_rating_lists">
                    <a class="nps_rating_numbers buttonStyle" href="javascript:void(0);" style="color:{{ !(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#ffffff' }}; background:{{ (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#636363' }};">6</a>
                </li>
                <li class="nps_rating_lists">
                    <a class="nps_rating_numbers buttonStyle" href="javascript:void(0);" style="color:{{ !(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#ffffff' }}; background:{{ (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#636363' }};">7</a>
                </li>
                <li class="nps_rating_lists">
                    <a class="nps_rating_numbers buttonStyle" href="javascript:void(0);" style="color:{{ !(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#ffffff' }}; background:{{ (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#636363' }};">8</a>
                </li>
                <li class="nps_rating_lists">
                    <a class="nps_rating_numbers buttonStyle" href="javascript:void(0);" style="color:{{ !(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#ffffff' }}; background:{{ (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#636363' }};">9</a>
                </li>
                <li class="nps_rating_lists">
                    <a class="nps_rating_numbers buttonStyle" href="javascript:void(0);" style="color:{{ !(empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#ffffff' }}; background:{{ (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#636363' }};">10</a>
                </li>
                <li class="nps_rating_lists">Very Likely</li>

            </ul>
            <p class="nps_poweredby">Powered by Brandboost.io</p>
        </div>


        <div class="nps_bb_form_box">
            <form id="nps_widget_form" name="">
                <input class="bb_nps_input bb_display_name"  style="display:{{ !(empty($oNPS->display_name)) ? 'block' : 'none' }}" type="text" name="" value="" placeholder="Name (Optional) :" />
                <input class="bb_nps_input bb_display_email" style="display:{{ !(empty($oNPS->display_email)) ? 'block' : 'none' }}" type="text" name="" value="" placeholder="Email (Optional) :" />
                <textarea name="feedbackDesc" id="bbnpsdesc" class="bb_nps_textarea bb_nps_input" placeholder="Write brief details here"></textarea>
                <input class="bbnpssubmit bb_nps_submit_a" name="bbnpssubmit" id="bbnpssubmit" value="Submit" type="submit">
            </form>
            <div class="nps_bb_cboth"></div>
        </div>
    </div>
    <div class="bb_nps_success_box" id="bb_nps_success_box">
        <h3>Thank you for your feedback</h3>
        <h4>Would you be willing to share your positive comments?</h4>
        <a href="#"><img class="nps_share_btn" src="/assets/images/share_fb.png"/></a>
        <a href="#"><img class="nps_share_btn" src="/assets/images/tweet_btn.png"/></a>
        <a href="#"><img class="nps_share_btn" src="/assets/images/no_thanks_btn.png"/></a>
        <a href="#"><img class="nps_share_btn" src="/assets/images/g2crowd.png"/></a>
        <p class="mt20">Powered by: <a target="_blank" href="{{ base_url() }}">Brandboost.io</a></p>
    </div>

    <!--========NPS WIDGET NEW END================-->
    <img class="w100" src="{{ base_url() }}assets/images/config_bkg.png"/>

</div>

<script>
    $(document).ready(function(){
        $(".nps_rating_numbers").click(function(){
            $(".nps_bb_form_box").show();
        });
        
        $(".bb_nps_widget_close").click(function(){
            $("#nps_bb_bot_widget").show();
            $("#nps_widget_form").hide();
            $("#bb_nps_success_box").hide();
        });
    });

    function nps_widget_hide() {
        var x = document.getElementById("nps_bb_bot_widget");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
    
    function nps_reset_preview(){
        document.getElementById('nps_bb_bot_widget').style.display = 'block';
        document.getElementById('nps_widget_form').style.display = 'none';
        document.getElementById('bb_nps_success_box').style.display = 'none';
    }


    document.getElementById('nps_widget_form').addEventListener('submit', function (evt) {
        evt.preventDefault();
        document.getElementById('nps_bb_bot_widget').style.display = 'none';
        document.getElementById('bb_nps_success_box').style.display = 'block';
    })
</script>