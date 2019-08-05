<?php
$tab = $this->input->get()['tab'];
?>
<script type="text/javascript" src="<?php echo base_url("/assets/js/plugins/pickers/color/spectrum.js"); ?>"></script>
<link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>
<style>
    .radion_container {
        display: inline-block;
        position: relative;
        padding-left: 12px;
        margin-bottom: 0px;
        margin-left:15px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        height: 25px;
        line-height: 56px;
        padding-right: 35px;
    }
    .radion_container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 40px;
        width: 40px;
        background-color: #fff;
        border-radius: 5px;
        border: 1px solid #9fd1f6;
    }

    .checkmark_round {
        position: absolute;
        top: 0;
        left: -8px;
        height: 40px;
        width: 40px;
        background-color: #fff;
        border-radius: 20px;
        border: 1px solid #9fd1f6;
    }
    .radion_container:hover input ~ .checkmark {
        background-color: #e4f3fd;
    }
    .radion_container input:checked ~ .checkmark {
        background-color: #fff;
        border: 1px solid #9fd1f6;
    }
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }
    .checkmark_round:after {
        content: "";
        position: absolute;
        display: none;
    }
    .radion_container input:checked ~ .checkmark:after {
        display: block;
    }

    .radion_container input:checked ~ .checkmark_round:after {
        display: block;
    }
    .radion_container .checkmark:after {
        /*        top: 9px;
        left: 9px;*/
        width: 32px;
        height: 32px;
        border-radius: 5px;
        background: #e3f500;
    }

    .radion_container .checkmark_round:after {
        top: 3px;
        left: 3px;
        width: 32px;
        height: 32px;
        border-radius: 20px;
        background: #e3f500;
    }
</style>    
<style>
    .right_content {max-width: 100%;}
    .emil_priview_sec{padding:0; text-align: center; border: 1px solid #eee; text-align:center; border-top: 4px solid #00BCD4; border-radius: 6px; min-height: 200px;}
    .well-footer{padding: 15px 20px;}
    .well-footer h3{margin: 0; font-size: 14px;}
    .well-footer h3 a{color: #bbb; text-decoration: underline;}

    .phone_sms{background:url('<?php echo base_url(); ?>assets/images/iphone.png') center top no-repeat; margin: 40px auto 10px; width: 357px; height: 716px; padding: 80px 40px;}
    .phone_sms .inner{ background: #ebece7; padding: 15px; font-size: 13px; border-radius:0 12px 12px; margin-bottom: 10px;}
    .phone_sms .inner p{margin: 0;}
</style>

<div class="tab-pane <?php echo ($defalutTab == 'customize') ? 'active' : ''; ?>" id="right-icon-tab2">
    <form method="post" name="frmSubmit" id="frmSubmit" action="javascript:void(0);"  enctype="multipart/form-data">
        <div class="panel-group panel-group-control content-group-lg"> 
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-flat mb30">
                        <div class="panel-heading">
                            <h6 class="panel-title">Email Preview</h6>
                        </div>
                        <div class="panel-body">
                            <div class="email_preview">

                                <div style="display:none;"><textarea name="emailPreviewData" id="emailPreviewData"></textarea></div>
                                <div class="emil_priview_sec">
                                    <table border="0" cellpadding="0" cellspacing="0" style="max-width:100%; width:616px; margin:0; padding:0" width="100%">
                                        <tr>
                                            <td align="center" style="border-top:#F40460 5px solid; background-color:#ffffff; height:80px; padding:30px 0" bgcolor="#ffffff" height="80"><img style="width:120px; height:120px; border-radius:50%;" src="<?php echo (!empty($oNPS->brand_logo)) ? 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $oNPS->brand_logo : base_url() . 'assets/images/face2.jpg'; ?>" width="120" class="logo_img" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="border-bottom:1px solid #e3e3e3; padding-bottom:29px">
                                                <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin:0">
                                                    <tr>
                                                        <td align="center" style="font-size:16px;line-height:26px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif; color:#777777; text-align:center"class="introductionText"><?php echo (!empty($oNPS->description)) != '' ? $oNPS->description : '{INTRODUCTION}'; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="background-color:#f6f6f6" bgcolor="#f6f6f6">
                                                <table border="0" cellpadding="0" cellspacing="0" style="width:540px;">
                                                    <tr>
                                                        <td align="center" style="padding:18px 0">
                                                            <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                                                <tr>
                                                                    <td align="center" style="font-size:19px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:normal;line-height:30px;color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#111111'; ?>;text-align:center"class="questionText"><?php echo (!empty($oNPS->question)) != '' ? $oNPS->question : '{QUESTION}'; ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center">
                                                            <table align="right" border="0" cellpadding="0" cellspacing="0" style="width:44px; height:44px; margin-right:5px;" width="44" height="44">
                                                                <tr>
                                                                    <td align="center" width="42" height="40">
                                                                        <div style="width:42px; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>; height:42px; box-shadow:rgba(0, 0, 0, 0.06) 0 2px 4px 0; border:2px solid #cccccc; padding:8px 0; border-radius:<?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'circle' ? '50%' : '0px' : '5px'; ?>;" class="buttonStyle">
                                                                            <a href="<?php echo base_url(); ?>nps/t/{ACCOUNTHASHCODE}?s=10" style="font-size:16px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold; color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>;">10</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <table align="right" border="0" cellpadding="0" cellspacing="0" style="width:44px; height:44px; margin-right:5px;" width="44" height="44">
                                                                <tr>
                                                                    <td align="center" width="42" height="40">
                                                                        <div style="width:42px; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>; height:42px; box-shadow:rgba(0, 0, 0, 0.06) 0 2px 4px 0; border:2px solid #cccccc; padding:8px 0; border-radius:<?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'circle' ? '50%' : '0px' : '5px'; ?>;" class="buttonStyle">
                                                                            <a href="<?php echo base_url(); ?>nps/t/{ACCOUNTHASHCODE}?s=9" style="font-size:16px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold; color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>;">9</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <table align="right" border="0" cellpadding="0" cellspacing="0" style="width:44px; height:44px; margin-right:5px;" width="44" height="44">
                                                                <tr>
                                                                    <td align="center" width="42" height="40">
                                                                        <div style="width:42px; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>; height:42px; box-shadow:rgba(0, 0, 0, 0.06) 0 2px 4px 0; border:2px solid #cccccc; padding:8px 0; border-radius:<?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'circle' ? '50%' : '0px' : '5px'; ?>;" class="buttonStyle">
                                                                            <a href="<?php echo base_url(); ?>nps/t/{ACCOUNTHASHCODE}?s=8" style="font-size:16px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold; color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>;">8</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <table align="right" border="0" cellpadding="0" cellspacing="0" style="width:44px; height:44px; margin-right:5px;" width="44" height="44">
                                                                <tr>
                                                                    <td align="center" width="42" height="40">
                                                                        <div style="width:42px; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>; height:42px; box-shadow:rgba(0, 0, 0, 0.06) 0 2px 4px 0; border:2px solid #cccccc; padding:8px 0; border-radius:<?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'circle' ? '50%' : '0px' : '5px'; ?>;" class="buttonStyle">
                                                                            <a href="<?php echo base_url(); ?>nps/t/{ACCOUNTHASHCODE}?s=7" style="font-size:16px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold; color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>;">7</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <table align="right" border="0" cellpadding="0" cellspacing="0" style="width:44px; height:44px; margin-right:5px;" width="44" height="44">
                                                                <tr>
                                                                    <td align="center" width="42" height="40">
                                                                        <div style="width:42px; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>; height:42px; box-shadow:rgba(0, 0, 0, 0.06) 0 2px 4px 0; border:2px solid #cccccc; padding:8px 0; border-radius:<?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'circle' ? '50%' : '0px' : '5px'; ?>;" class="buttonStyle">
                                                                            <a href="<?php echo base_url(); ?>nps/t/{ACCOUNTHASHCODE}?s=6" style="font-size:16px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold; color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>;">6</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <table align="right" border="0" cellpadding="0" cellspacing="0" style="width:44px; height:44px; margin-right:5px;" width="44" height="44">
                                                                <tr>
                                                                    <td align="center" width="42" height="40">
                                                                        <div style="width:42px; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>; height:42px; box-shadow:rgba(0, 0, 0, 0.06) 0 2px 4px 0; border:2px solid #cccccc; padding:8px 0; border-radius:<?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'circle' ? '50%' : '0px' : '5px'; ?>;" class="buttonStyle">
                                                                            <a href="<?php echo base_url(); ?>nps/t/{ACCOUNTHASHCODE}?s=5" style="font-size:16px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold; color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>;">5</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <table align="right" border="0" cellpadding="0" cellspacing="0" style="width:44px; height:44px; margin-right:5px;" width="44" height="44">
                                                                <tr>
                                                                    <td align="center" width="42" height="40">
                                                                        <div style="width:42px; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>; height:42px; box-shadow:rgba(0, 0, 0, 0.06) 0 2px 4px 0; border:2px solid #cccccc; padding:8px 0; border-radius:<?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'circle' ? '50%' : '0px' : '5px'; ?>;" class="buttonStyle">
                                                                            <a href="<?php echo base_url(); ?>nps/t/{ACCOUNTHASHCODE}?s=4" style="font-size:16px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold; color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>;">4</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <table align="right" border="0" cellpadding="0" cellspacing="0" style="width:44px; height:44px; margin-right:5px;" width="44" height="44">
                                                                <tr>
                                                                    <td align="center" width="42" height="40">
                                                                        <div style="width:42px; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>; height:42px; box-shadow:rgba(0, 0, 0, 0.06) 0 2px 4px 0; border:2px solid #cccccc; padding:8px 0; border-radius:<?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'circle' ? '50%' : '0px' : '5px'; ?>;" class="buttonStyle">
                                                                            <a href="<?php echo base_url(); ?>nps/t/{ACCOUNTHASHCODE}?s=3" style="font-size:16px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold; color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>;">3</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <table align="right" border="0" cellpadding="0" cellspacing="0" style="width:44px; height:44px; margin-right:5px;" width="44" height="44">
                                                                <tr>
                                                                    <td align="center" width="42" height="40">
                                                                        <div style="width:42px; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>; height:42px; box-shadow:rgba(0, 0, 0, 0.06) 0 2px 4px 0; border:2px solid #cccccc; padding:8px 0; border-radius:<?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'circle' ? '50%' : '0px' : '5px'; ?>;" class="buttonStyle">
                                                                            <a href="<?php echo base_url(); ?>nps/t/{ACCOUNTHASHCODE}?s=2" style="font-size:16px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold; color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>;">2</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <table align="right" border="0" cellpadding="0" cellspacing="0" style="width:44px; height:44px; margin-right:5px;" width="44" height="44">
                                                                <tr>
                                                                    <td align="center" width="42" height="40">
                                                                        <div style="width:42px; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>; height:42px; box-shadow:rgba(0, 0, 0, 0.06) 0 2px 4px 0; border:2px solid #cccccc; padding:8px 0; border-radius:<?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'circle' ? '50%' : '0px' : '5px'; ?>;" class="buttonStyle">
                                                                            <a href="<?php echo base_url(); ?>nps/t/{ACCOUNTHASHCODE}?s=1" style="font-size:16px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold; color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>;">1</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            <table align="right" border="0" cellpadding="0" cellspacing="0" style="width:44px; height:44px; margin-right:5px;" width="44" height="44">
                                                                <tr>
                                                                    <td align="center" width="42" height="40">
                                                                        <div style="width:42px; background:<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>; height:42px; box-shadow:rgba(0, 0, 0, 0.06) 0 2px 4px 0; border:2px solid #cccccc; padding:8px 0; border-radius:<?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'circle' ? '50%' : '0px' : '5px'; ?>;" class="buttonStyle">
                                                                            <a href="<?php echo base_url(); ?>nps/t/{ACCOUNTHASHCODE}?s=0" style="font-size:16px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-weight:bold; color:<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>;">0</a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td  style="padding:20px;">
                                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="left" style="font-size:18px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;color:#777777;width:50%;text-align:left" width="50%">
                                                                            Not likely
                                                                        </td>
                                                                        <td align="right" style="font-size:18px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;color:#777777;width:50%;text-align:right" width="50%">
                                                                            Very likely
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center"  style="border-top:1px solid #e3e3e3; height:46px; background-color:#ffffff; padding:0px 20px;" bgcolor="#ffffff" height="46">
                                                <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin:0;">
                                                    <tr>
                                                        <td align="left" valign="middle" style="height:48px;font-size:14px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;color:#cccccc;width:40%;text-align:left" width="40%" height="48"><a href="#" style="color:#cccccc">Unsubscribe</a></td>
                                                        <td align="right" valign="middle" style="height:48px;font-size:14px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;color:#cccccc;width:60%;text-align:right" width="60%" height="48">Powered by&nbsp;<a href="<?php echo base_url(); ?>" style="color:#cccccc">Brandboost</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-flat mb30">
                        <div class="panel-heading">
                            <h6 class="panel-title">SMS Preview</h6>
                        </div>
                        <div class="panel-body">
                            <div class="sms_preview">
                                <div class="input-group mb-15"> <span class="input-group-addon left">From &nbsp;&nbsp;</span>
                                    <input class="form-control" value="<?php echo $userTwilioData->contact_no; ?>" type="text" name="fromNumber" readonly>
                                </div>
                                <div class="phone_sms">
                                    <div class="inner">
                                        <p><?php echo (!empty($oNPS->question)) != '' ? $oNPS->question : 'How likely are you to recommend My Store to a friend?'; ?></p>
                                        <p>Please Reply with a number from "0" (not likely) to "10" (very likely). </p>
                                    </div>
                                    <p><small>09:52, 14/08/2018</small></p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 w50m0">
                    <div class="panel panel-flat min1566">
                        <div class="panel-heading">
                            <h6 class="panel-title"><?php echo ucfirst($oNPS->platform); ?> Basic Setup</h6>
                        </div>

                        <div class="panel-body">
                            <div class="right_content">
                                <div class="row">

                                    <div class="col-xs-12">

                                        <div class="">
                                            <div class="form-group">
                                                <label>Brand/Product Name:</label>
                                                <input class="form-control" name="brand_name" id="brand_title" placeholder="Enter Brand/Product Name" type="text" value="<?php echo (!empty($oNPS->brand_name)) != '' ? $oNPS->brand_name : ''; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Introduction:</label>
                                                <textarea rows="5" cols="5" name="description" class="form-control" id="description" placeholder="Placeholder Text"  required><?php echo (!empty($oNPS->description)) != '' ? $oNPS->description : ''; ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Question:</label>
                                                <textarea rows="5" cols="5" class="form-control" id="question" placeholder="How likely are you to recommend <?php echo (!empty($oNPS->brand_name)) != '' ? $oNPS->brand_name : 'My Store'; ?> to a friend?
                                                          " name="question" required><?php echo (!empty($oNPS->question)) != '' ? $oNPS->question : ''; ?></textarea>
                                            </div>


                                        </div>
                                        <div class="form-group">
                                            <label>Upload Brand/Product Logo:</label>
                                            <!-- <input type="file" class="file-input"> -->
                                            <div class="dropzone" id="myDropzone_logo_img"></div>
                                            <input type="hidden" name="brand_logo" id="logo_img" value="<?php echo (!empty($oNPS->brand_logo)) ? $oNPS->brand_logo : ''; ?>" required>
                                        </div>

                                    </div> 

                                    <div class="col-xs-12"><hr></div>

                                    <input type="hidden" value="<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>" name='web_text_color' id="text_color">
                                    <input type="hidden" value="<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#FFFFFF'; ?>" name='web_button_color' id="button_color">
                                    <input type="hidden" name="nps_id" value="<?php echo $oNPS->id; ?>" />

                                    <?php if ($oNPS->platform == 'email'): ?>
                                        <div class="col-xs-12">

                                            <div class="">
                                                <div class="form-group">
                                                    <label>From Name:</label>
                                                    <input class="form-control" name="email_from" id="email_from" placeholder="Enter Brand/Product Name" type="text" value="<?php echo (!empty($oNPS->email_from)) != '' ? $oNPS->email_from : $oNPS->firstname; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Reply to email:</label>
                                                    <input class="form-control" name="email_replyto" id="email_replyto" placeholder="Enter Reply to email" type="text" value="<?php echo (!empty($oNPS->email_replyto)) != '' ? $oNPS->email_replyto : $oNPS->email; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Email Subject:</label>
                                                    <textarea rows="5" cols="5" name="email_subject" class="form-control" id="brand_desc" placeholder="How likely are you to recommend <?php echo (!empty($oNPS->brand_name)) != '' ? $oNPS->brand_name : 'My Store'; ?> to a friend?" required><?php echo (!empty($oNPS->email_subject)) != '' ? $oNPS->email_subject : ''; ?></textarea>
                                                </div>
                                            </div>

                                        </div> 
                                    <?php endif; ?>

                                    <div class="col-xs-12">
                                        <div class="">
                                            <div class="form-group">
                                                <label>Text Color:</label>
                                                <input class="form-control colorpickerText" name="web_text_color111">
                                            </div>

                                            <div class="form-group">
                                                <label>Button Color:</label>
                                                <input class="form-control colorpickerbutton" name="web_button_color111">
                                            </div>
                                            <?php if ($oNPS->platform == 'web'): ?>
                                                <div class="form-group">
                                                    <label>Button Style: &nbsp;</label>
                                                    <label class="radion_container">
                                                        <input type="radio" checked="checked" value="withbg" name="web_button_style">
                                                        <span class="checkmark"></span> </label>
                                                    <label class="radion_container">
                                                        <input type="radio" value="withoutbg" name="web_button_style">
                                                        <span class="checkmark"></span>
                                                    </label>

                                                </div>

                                                <div class="form-group">
                                                    <label>Button Shape:</label>
                                                    <label class="radion_container">
                                                        <input type="radio" value="square" <?php echo (!empty($oNPS->web_button_shape)) ? $oNPS->web_button_shape == 'square' ? 'checked' : '' : 'checked'; ?> name="web_button_shape">
                                                        <span class="checkmark getShapeValue" shape_value="0px"></span> 
                                                    </label>
                                                    <label class="radion_container">
                                                        <input type="radio" value="circle" <?php echo $oNPS->web_button_shape == 'circle' ? 'checked' : ''; ?> name="web_button_shape">
                                                        <span class="checkmark_round getShapeValue" shape_value="50%"></span>
                                                    </label>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pull-right">
            <button type="submit" class="btn bl_cust_btn bg-blue-600">Save & Continue</button>
        </div>
    </form>

</div>

<script>
    $(document).ready(function () {
        $('#question').keyup(function () {
            $('.questionText').html($(this).val());
        });

        $('#description').keyup(function () {
            $('.introductionText').html($(this).val());
        });

        var myDropzoneLogoImg = new Dropzone(
                '#myDropzone_logo_img', //id of drop zone element 1
                {
                    url: '<?php echo site_url("/dropzone/upload_image"); ?>',
                    uploadMultiple: false,
                    maxFiles: 1,
                    maxFilesize: 600,
                    acceptedFiles: 'image/*',
                    addRemoveLinks: true,
                    success: function (response) {
                        $('#logo_img').val(response.xhr.responseText);
                        $('.logo_img').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' + response.xhr.responseText);
                    }
                });

        Dropzone.autoDiscover = false;


        var text_color = $('#text_color').val();
        var button_color = $('#button_color').val();

        $(".colorpickerbutton").spectrum({
            color: button_color,
            change: function (color) {
                $('#button_color').val(color.toHexString());
                $('.buttonStyle').css('background', color.toHexString());
            }
        });

        $(".colorpickerText").spectrum({
            color: text_color,
            change: function (color) {
                //alert(color.toHexString());
                $('#text_color').val(color.toHexString());
                $('.questionText, .buttonStyle a').css('color', color.toHexString());
            }
        });

        $('.getShapeValue').click(function () {
            var shapeValue = $(this).attr('shape_value');
            $('.buttonStyle').css('border-radius', shapeValue);
        });

        $("#frmSubmit").submit(function () {
            $('#emailPreviewData').val($('.emil_priview_sec').html());
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '<?php echo base_url('admin/modules/nps/updateNPSCustomize'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {
                        window.location.href = '<?php echo base_url("/admin/modules/nps/setup/{$programID}?t=workflow") ?>';
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








