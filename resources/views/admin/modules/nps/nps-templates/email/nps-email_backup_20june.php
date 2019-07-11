<div style="width: 485px;height: 240px; font-family: arial; margin: 35px auto;">
    <div style="text-align: center; padding: 50px; margin-bottom: 0px; width: 100%;border-radius: 5px;background-color: #ffffff;box-shadow: 0 10px 20px 0 rgba(12, 12, 44, 0.05), 0 2px 2px 0 rgba(0, 0, 0, 0.03);position: relative; box-sizing: border-box;">
        <p style="font-family: 'Open Sans', sans-serif; text-align: center; margin:10px 0 15px; font-size: 20px; color:#0c0c2c; font-weight: 600; padding: 0px;min-width:450px; display:none;" id="wf_edit_template_greeting">
            {GREETING}
        </p>
        <p style="line-height: 25px; padding:0; margin: 0; font-size: 14px; font-weight: normal; color: #494968; font-family: 'Open Sans', sans-serif; text-align: center; display:none;" id="wf_edit_template_introduction">
            {INTRODUCTION}
        </p>
        <div style="width: 66px;height: 66px;position: absolute;padding: 8px;border-radius: 100px;background-color: #fafafd;top: -33px;left: 50%;
             margin-left: -33px; box-sizing: border-box;"><img style="width: 50px; height: 50px; border-radius: 100px;<?php if (!$oNPS->display_logo): ?>display:none;<?php endif; ?>" src="{{BRAND_LOGO}}" class="logo_img" /></div>
        <p  style="font-weight: bold; font-size: 16px; color: {{TEXT_COLOR}}; margin-bottom: 15px; font-family: arial;<?php if (!$oNPS->display_additional): ?>display:none;<?php endif; ?>" class="questionEamilText">{{QUESTION}}</p>
        <p style="font-weight: 400; font-size: 14px; color: {{INTRODUCTION_TEXT_COLOR}}; margin: 0; font-family: arial;"><span class="introductionText" <?php if (!$oNPS->display_intro): ?>style="display:none;"<?php endif; ?>>{{INTRODUCTION}} </span></p>
    </div>
    <div style="margin-top: 1px; text-align: center; width: 100%;padding: 20px;border-radius: 5px;background-color: #ffffff;box-shadow: 0 10px 20px 0 rgba(12, 12, 44, 0.05), 0 2px 2px 0 rgba(0, 0, 0, 0.03);position: relative;margin-bottom: 10px; box-sizing: border-box;">
        <ul style="margin: 0; padding: 0;">
            <li style="margin: 0; padding: 0; display: inline-block"><a  class="buttonStyle"style=" text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: {{BUTTON_SHAPE}};background: {{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: {{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px;" href="{{RATE_LINK}}?s=1">1</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: {{BUTTON_SHAPE}};background: {{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: {{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px;" href="{{RATE_LINK}}?s=2">2</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style=" text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: {{BUTTON_SHAPE}};background: {{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: {{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px;" href="{{RATE_LINK}}?s=3">3</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: {{BUTTON_SHAPE}};background: {{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: {{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px;" href="{{RATE_LINK}}?s=4">4</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: {{BUTTON_SHAPE}};background: {{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: {{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px;" href="{{RATE_LINK}}?s=5">5</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: {{BUTTON_SHAPE}};background: {{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: {{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px;" href="{{RATE_LINK}}?s=6">6</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: {{BUTTON_SHAPE}};background: {{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: {{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px;" href="{{RATE_LINK}}?s=7">7</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: {{BUTTON_SHAPE}};background: {{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: {{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px;" href="{{RATE_LINK}}?s=8">8</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: {{BUTTON_SHAPE}};background: {{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: {{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px;" href="{{RATE_LINK}}?s=9">9</a></li>
            <li style="margin: 0; padding: 0; display: inline-block"><a class="buttonStyle" style="text-decoration: none; margin: 0;padding: 0;display: inline-block;width: 24px;height: 24px;box-shadow: 0 1px 1px 0 rgba(0, 36, 128, 0.07);border-radius: {{BUTTON_SHAPE}};background: {{BUTTON_COLOR}};border: 1px solid #e7e7f0;color: {{BUTTON_TEXT_COLOR}};font-size: 10px;line-height: 22px;" href="{{RATE_LINK}}?s=10">10</a></li>

        </ul>
    </div>
</div>	



