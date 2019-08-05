<style>
	#nps_widget_preview .buttonStyle{background: <?php echo $oNPS->web_button_color; ?>!important; color: <?php echo $oNPS->web_button_text_color; ?>!important; border-color:<?php echo ($oNPS->web_button_color == '#ffffff' || $oNPS->web_button_color == '#FFFFFF' || $oNPS->web_button_color == '') ? '#e7e7f0' : $oNPS->web_button_color; ?>!important}
	#nps_widget_preview .buttonStyle:hover{background: <?php echo $oNPS->web_button_over_color; ?>!important; color: <?php echo $oNPS->web_button_over_text_color; ?>!important; border-color:<?php echo $oNPS->web_button_over_color; ?>!important}
</style>
<div id="nps_widget_preview" style="position: absolute;width: 485px;height: 240px;top: 50%;left: 50%;margin-left: -240px;margin-top: -120px; font-family: arial;">
    <div style="text-align: center; padding: 50px; margin-bottom: 0px; width: 100%;border-radius: 5px;background-color: #ffffff;box-shadow: 0 10px 20px 0 rgba(12, 12, 44, 0.05), 0 2px 2px 0 rgba(0, 0, 0, 0.03);position: relative; box-sizing: border-box;">
        <div style="width: 66px;height: 66px;position: absolute;padding: 8px;border-radius: 100px;background-color: #fafafd;top: -33px;left: 50%;
             margin-left: -33px; box-sizing: border-box;"><img style="width: 50px; height: 50px; border-radius: 100px;<?php if ((!$oNPS->display_logo) && $oNPS->brand_logo != ''): ?>display:none;<?php endif; ?>" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $oNPS->brand_logo; ?>" class="logo_img" /></div>
        <p  style="font-weight: bold; font-size: 16px; color: <?php echo $oNPS->web_text_color; ?>; margin-bottom: 15px; font-family: arial;" class="questionEamilText"><?php echo $oNPS->question; ?></p>
        <p style="font-weight: 400; font-size: 14px; color: <?php echo $oNPS->web_int_text_color; ?>; margin: 0; font-family: arial;"><span class="introductionText" <?php if (!$oNPS->display_intro): ?>style="display:none;"<?php endif; ?>><?php echo $oNPS->description; ?></span></p>
    </div>
    <div style="margin-top: 1px; text-align: center; width: 100%;padding: 20px;border-radius: 5px;background-color: #ffffff;box-shadow: 0 10px 20px 0 rgba(12, 12, 44, 0.05), 0 2px 2px 0 rgba(0, 0, 0, 0.03);position: relative;margin-bottom: 10px; box-sizing: border-box;">
        <ul style="margin: 0; padding: 0;">
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle"style=" text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius:25px; border: 1px solid #e7e7f0;font-size: 10px;line-height: 22px;" href="javascript:void(0);">1</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: 25px;border: 1px solid #e7e7f0;font-size: 10px;line-height: 22px;" href="javascript:void(0);">2</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style=" text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: 25px;border: 1px solid #e7e7f0;font-size: 10px;line-height: 22px;" href="javascript:void(0);">3</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: 25px;border: 1px solid #e7e7f0;font-size: 10px;line-height: 22px;" href="javascript:void(0);">4</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: 25px;border: 1px solid #e7e7f0;font-size: 10px;line-height: 22px;" href="javascript:void(0);">5</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: 25px;border: 1px solid #e7e7f0;font-size: 10px;line-height: 22px;" href="javascript:void(0);">6</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: 25px;border: 1px solid #e7e7f0;font-size: 10px;line-height: 22px;" href="javascript:void(0);">7</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: 25px;border: 1px solid #e7e7f0;font-size: 10px;line-height: 22px;" href="javascript:void(0);">8</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: 25px;border: 1px solid #e7e7f0;font-size: 10px;line-height: 22px;" href="javascript:void(0);">9</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: 25px;border: 1px solid #e7e7f0;font-size: 10px;line-height: 22px;" href="javascript:void(0);">10</a></li>

        </ul>
    </div>
</div>	



