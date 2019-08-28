<script type="text/javascript" src="<?php echo base_url("assets/js/plugins/pickers/color/spectrum.js"); ?>"></script>
<link href="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/dropzone-master/dist/dropzone.js"></script>

<style type="text/css">
    .dropzone .dz-default.dz-message:before { content: ''!important; }
    .dropzone {min-height:80px; opacity:0;height:80px; }
    .dropzone .dz-default.dz-message{ top: 0%!important; height:40px;  margin-top:0px;}
    .dropzone .dz-default.dz-message span {    font-size: 13px;    margin-top: -10px;}
    .productSectionNew{margin-top: 30px; border-top: 3px solid #ECECEC; padding-top: 20px;}
</style>

<div class="tab-pane <?php echo ($defalutTab == 'customize') ? 'active' : ''; ?>" id="right-icon-tab2">
    <div class="row">
        <div class="col-md-3">
            <div style="margin: 0;" class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Configurations</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p0">
                    <div class="profile_sec">
                        <div class="profile_headings">Components <a class="pull-right plus_icon txt_green" href="#"><i class="icon-arrow-down12 txt_green"></i></a></div>

                        <form method="post" name="frmSubmit" id="frmSubmit" action="javascript:void(0);"  enctype="multipart/form-data">
                            @csrf
                            <div class="interactions configurations p25">
                                <ul class="chatwidgetsettings">
                                    <?php if ($oNPS->platform != 'sms'): ?>
                                        <li><small class="wauto">Logo</small> 
                                            <span class="pull-right">
                                                <label class="custom-form-switch mr0 pull-right">
                                                    <input class="field" name="display_logo" type="checkbox" <?php if ($oNPS->display_logo): ?>checked<?php endif; ?>>
                                                    <span class="toggle green"></span>
                                                </label>
                                            </span>
                                        </li>
                                    <?php endif; ?>
                                    <li><small class="wauto">Question</small> 
                                        <span class="pull-right">
                                            <label class="custom-form-switch mr0 pull-right">
                                                <input class="field" name="display_additional" type="checkbox" <?php if ($oNPS->display_additional): ?>checked<?php endif; ?> >
                                                <span class="toggle green"></span>
                                            </label>
                                        </span>
                                    </li>
                                    <li><small class="wauto">Introduction</small> 
                                        <span class="pull-right">
                                            <label class="custom-form-switch mr0 pull-right">
                                                <input class="field" name="display_intro" type="checkbox" <?php if ($oNPS->display_intro): ?>checked<?php endif; ?>>
                                                <span class="toggle green"></span>
                                            </label>
                                        </span>
                                    </li>

                                    <div class="clearfix"></div>
                                </ul>
                            </div>
                            <?php if ($oNPS->platform == 'web'): ?>
                                <div class="profile_headings">Feedback Form Settings <a class="pull-right plus_icon txt_green" href="#"><i class="icon-arrow-down12 txt_green"></i></a></div>
                                <div class="interactions configurations p25">
                                    <ul class="chatwidgetsettings">
                                        <li><small class="wauto">Allow Name Field</small> 
                                            <span class="pull-right">
                                                <label class="custom-form-switch mr0 pull-right">
                                                    <input class="field" name="display_name" type="checkbox" <?php if ($oNPS->display_name): ?>checked<?php endif; ?>>
                                                    <span class="toggle green"></span>
                                                </label>
                                            </span>
                                        </li>

                                        <li><small class="wauto">Allow Email Field</small> 
                                            <span class="pull-right">
                                                <label class="custom-form-switch mr0 pull-right">
                                                    <input class="field" name="display_email" type="checkbox" <?php if ($oNPS->display_email): ?>checked<?php endif; ?>>
                                                    <span class="toggle green"></span>
                                                </label>
                                            </span>
                                        </li>


                                        <div class="clearfix"></div>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <div class="profile_headings">Popup Details <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_green"></i></a></div>

                            <div class="configurations p25">
                                <div class="form-group">
                                    <label class="control-label">Brand/Product Name:</label>
                                    <div class="">
                                          <!-- <input name="domain" id="domain" class="form-control" required="" placeholder="iPhone 6s" type="text"> -->
                                        <input class="form-control" name="brand_name" id="brand_title" placeholder="Enter Brand/Product Name" type="text" value="<?php echo (!empty($oNPS->brand_name)) != '' ? $oNPS->brand_name : ''; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Question:</label>
                                    <div class="">
                                          <!-- <textarea class="form-control" name="">How much rating do you give to iPhone 6s?</textarea> -->
                                        <textarea  class="form-control" id="question" placeholder="How likely are you to recommend <?php echo (!empty($oNPS->brand_name)) != '' ? $oNPS->brand_name : 'My Store'; ?> to a friend?" name="question" required><?php echo (!empty($oNPS->question)) != '' ? $oNPS->question : ''; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Introduction:</label>
                                    <div class="">
                                          <!-- <textarea class="form-control" name="">This is very good apple product. </textarea> -->
                                        <textarea name="description" class="form-control" id="description" placeholder="Placeholder Text"  required><?php echo (!empty($oNPS->description)) != '' ? $oNPS->description : ''; ?></textarea>
                                    </div>
                                </div>

                                <?php if ($oNPS->platform != 'sms'): ?>

                                    <div class="form-group">
                                        <label class="control-label">Upload Brand/Product Logo:</label>
                                        <label class="display-block">
                                            <input type="hidden" name="brand_logo" id="logo_img" value="<?php echo (!empty($oNPS->brand_logo)) ? $oNPS->brand_logo : ''; ?>">
                                            @csrf
                                            <div class="img_vid_upload_small">
                                                <div class="dropzone" id="myDropzone_logo_img"></div>
                                            </div>
                                        </label>
                                    </div>


                                    
                                <?php endif; ?>


                            </div>
                            <?php if ($oNPS->platform != 'sms'): ?>
                                <div class="profile_headings">Settings <a class="pull-right plus_icon" href="#"><i class="icon-arrow-down12 txt_green"></i></a></div>

                                <div class="p25 review_setting">
                                    
                                    <div class="row mb20">
                                        <?php //pre($oNPS); ?>
                                        <input type="hidden" value="<?php echo!(empty($oNPS->web_text_color)) ? $oNPS->web_text_color : '#000000'; ?>" name='web_text_color' id="text_color">
                                        <input type="hidden" value="<?php echo (!empty($oNPS->web_int_text_color)) ? $oNPS->web_int_text_color : '#000'; ?>" name='web_int_text_color' id="int_text_color">
                                        <input type="hidden" value="<?php echo (!empty($oNPS->web_button_text_color)) ? $oNPS->web_button_text_color : '#ffffff'; ?>" name='web_button_text_color' id="button_text_color">
                                        <input type="hidden" value="<?php echo (!empty($oNPS->web_button_over_text_color)) ? $oNPS->web_button_over_text_color : '#636363'; ?>" name='web_button_over_text_color' id="button_over_text_color">
                                        <input type="hidden" value="<?php echo (!empty($oNPS->web_button_color)) ? $oNPS->web_button_color : '#636363'; ?>" name='web_button_color' id="button_color">
                                        <input type="hidden" value="<?php echo (!empty($oNPS->web_button_over_color)) ? $oNPS->web_button_over_color : '#dfdfdf'; ?>" name='web_button_over_color' id="button_over_color">

                                    </div>

                                    <div class="row mb20">
                                        <div class="col-xs-7">
                                            <p class="text-muted text-size-small mb0 mt10">Question Text Color:</p>
                                        </div>
                                        <div class="col-xs-5">
                                            <input class="form-control colorpickerText" name="web_text_color111">
                                        </div>
                                    </div>

                                    <div class="row mb20">
                                        <div class="col-xs-7">
                                            <p class="text-muted text-size-small mb0 mt10">Introduction Text Color:</p>
                                        </div>
                                        <div class="col-xs-5">
                                            <input class="form-control colorpickerITC" name="introduction_text_color">
                                        </div>
                                    </div>

                                    <div class="row mb20">
                                        <div class="col-xs-7">
                                            <p class="text-muted text-size-small mb0 mt10">Button Text Color:</p>
                                        </div>
                                        <div class="col-xs-5">
                                            <input class="form-control colorpickerBTC" name="button_text_color">
                                        </div>
                                    </div>

                                    <?php if ($oNPS->platform == 'web'): ?>
                                        <div class="row mb20">
                                            <div class="col-xs-7">
                                                <p class="text-muted text-size-small mb0 mt10">Button Over Text Color:</p>
                                            </div>
                                            <div class="col-xs-5">
                                                <input class="form-control colorpickerBOTC" name="button_over_text_color">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row mb20">
                                        <div class="col-xs-7">
                                            <p class="text-muted text-size-small mb0 mt10">Button Background Color:</p>
                                        </div>
                                        <div class="col-xs-5">
                                            <input class="form-control colorpickerbutton" name="web_button_color111">
                                        </div>
                                    </div>
                                    <?php if ($oNPS->platform == 'web'): ?>
                                        <div class="row mb20">
                                            <div class="col-xs-7">
                                                <p class="text-muted text-size-small mb0 mt10">Button Over Color:</p>
                                            </div>
                                            <div class="col-xs-5">
                                                <input class="form-control colorpickerBOC" name="button_background_over_color">
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                </div>


                                <div><textarea style="display: none;" name="emailPreviewData" id="emailPreviewData"></textarea></div>
                            <?php endif; ?>
                            <div class="p25 text-center btop">
                                <input type="hidden" name="nps_id" value="<?php echo $oNPS->id; ?>" />
                                <input type="hidden" name="platform" value="<?php echo $oNPS->platform; ?>" />

                                <button type="submit" class="btn dark_btn w100 bkg_green" >Save & Continue</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <?php if ($oNPS->platform == 'web' || $oNPS->platform == 'link'): ?>
            @include('admin.modules.nps.nps-tabs.partials.web-customization')
        <?php else: ?>
            @include('admin.modules.nps.nps-tabs.partials.email-sms-customization')
        <?php endif; ?>

    </div>

</div>


<script>
    $(document).ready(function () {
        $("input[name='display_logo']").change(function () {
            if ($(this).prop("checked")) {
                $(".logo_img").parent().show();
                $(".product_icon").show();
            } else {
                $(".product_icon").hide();
                $(".logo_img").parent().hide();
            }
        });
        $("input[name='display_additional']").change(function () {
            if ($(this).prop("checked")) {
                $(".questionText").show();
                $(".questionEamilText").show();
            } else {
                $(".questionText").hide();
                $(".questionEamilText").hide();
            }
        });
        $("input[name='display_intro']").change(function () {
            if ($(this).prop("checked")) {
                $(".introductionText").show();
            } else {
                $(".introductionText").hide();
            }
        });
        
        $("input[name='display_name']").change(function () {
            if ($(this).prop("checked")) {
                $(".bb_display_name").show();
            } else {
                $(".bb_display_name").hide();
            }
        });
        
        $("input[name='display_email']").change(function () {
            if ($(this).prop("checked")) {
                $(".bb_display_email").show();
            } else {
                $(".bb_display_email").hide();
            }
        });
        $('#question').keyup(function () {
            $('.questionEamilText').html($(this).val());
            $('.questionText').html($(this).val());
            $('.questionSMSText').html($(this).val() + '<br><br>Please Reply with a number from "0" (not likely) to "10" (very likely).');
        });

        $('#description').keyup(function () {
            $('.introductionText').html($(this).val());
        });

<?php if ($oNPS->platform != 'sms'): ?>

            Dropzone.autoDiscover = false;
            var myDropzoneLogoImg = new Dropzone(
            '#myDropzone_logo_img', //id of drop zone element 1
            {
                url: '<?php echo base_url("dropzone/upload_s3_attachment"); ?>/<?php echo $userID; ?>/nps',
                params: {
                    _token: '{{csrf_token()}}'
                },
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: 600,
                acceptedFiles: 'image/*',
                addRemoveLinks: false,
                success: function (response) {
                    
                    if(response.xhr.responseText != "") {

                        $('.logo_img').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
                        var dropImage = $('#logo_img').val();
                        $.ajax({
                            url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
                            type: "POST",
                            data: {_token: '{{csrf_token()}}', dropImage: dropImage},
                            dataType: "json",
                            success: function (data) {
                                console.log(data);
                            }
                        });
                        $('#logo_img').val(response.xhr.responseText);
                        //$('.saveOnsiteButton').trigger('click');

                    }
                    
                }
            });
            myDropzoneLogoImg.on("complete", function(file) {
              myDropzoneLogoImg.removeFile(file);
            });

<?php endif; ?>

        var text_color = $('#text_color').val();
        var int_text_color = $('#int_text_color').val();
        var button_text_color = $('#button_text_color').val();
        var button_over_text_color = $('#button_over_text_color').val();
        var button_color = $('#button_color').val();
        var button_over_color = $('#button_over_color').val();

        $(".colorpickerText").spectrum({
            color: text_color,
            change: function (color) {
                //alert(color.toHexString());
                $('#text_color').val(color.toHexString());
                $('.questionEamilText, .questionText').css('color', color.toHexString());
            },
            move: function (color) {
                //alert(color.toHexString());
                $('#text_color').val(color.toHexString());
                $('.questionEamilText, .questionText').css('color', color.toHexString());
            }
        });

        $(".colorpickerITC").spectrum({
            color: int_text_color,
            change: function (color) {
                $('#int_text_color').val(color.toHexString());
                $('.introductionText').css('color', color.toHexString());
            },
            move: function (color) {
                $('#int_text_color').val(color.toHexString());
                $('.introductionText').css('color', color.toHexString());
            }
        });

        $(".colorpickerBTC").spectrum({
            color: button_text_color,
            change: function (color) {
                $('#button_text_color').val(color.toHexString());
                $('.buttonStyle').css('color', color.toHexString());
            },
            move: function (color) {
                $('#button_text_color').val(color.toHexString());
                $('.buttonStyle').css('color', color.toHexString());
            }
        });

        $(".colorpickerBOTC").spectrum({
            color: button_over_text_color,
            change: function (color) {
                $('#button_over_text_color').val(color.toHexString());
            }
        });

        $(".colorpickerbutton").spectrum({
            color: button_color,
            change: function (color) {
                $('#button_color').val(color.toHexString());
                $('.buttonStyle').css('background', color.toHexString());
            },
            move: function (color) {
                $('#button_color').val(color.toHexString());
                $('.buttonStyle').css('background', color.toHexString());
            }
        });

        $(".colorpickerBOC").spectrum({
            color: button_over_color,
            change: function (color) {
                $('#button_over_color').val(color.toHexString());
            }
        });

<?php if ($oNPS->platform == 'web'): ?>
            $(".buttonStyle").mouseover(function () {
                var m;
                var selectedVal = $(this).text();
                var btnTextColor = $('#button_text_color').val();
                ;
                var btnTextOverColor = $('#button_over_text_color').val();
                var btnColor = $('#button_color').val();
                var btnOverColor = $('#button_over_color').val();
                for (m = 0; m < 10; m++) {
                    if (m < selectedVal) {
                        document.getElementsByClassName('buttonStyle')[m].style.background = btnOverColor;
                        document.getElementsByClassName('buttonStyle')[m].style.color = btnTextOverColor;
                    } else {
                        document.getElementsByClassName('buttonStyle')[m].style.background = btnColor;
                        document.getElementsByClassName('buttonStyle')[m].style.color = btnTextColor;
                    }
                }
            });
<?php endif; ?>

        $('.getShapeValue').click(function () {
            var shapeValue = $(this).attr('shape_value');
            $('.buttonStyle').css('border-radius', shapeValue);
        });

        $("#frmSubmit").submit(function () {
            //console.log($('.emil_priview_sec').html());
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

<?php if ($oNPS->platform == 'web' || $oNPS->platform == 'link'): ?>
                            window.location.href = '<?php echo base_url("admin/modules/nps/setup/{$programID}?t=widgets") ?>';

<?php else: ?>
                            window.location.href = '<?php echo base_url("admin/modules/nps/setup/{$programID}?t=workflow") ?>';
<?php endif; ?>
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








