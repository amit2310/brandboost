<style type="text/css">
    .tab_list{ margin:0px; padding:0px;}
    .tab_list li {
        list-style: none;
        width: 50%;
        float: left;
    }

    .tooltip_table {
        position: relative; cursor: pointer;
    }

    .tooltip_table .tooltiptext {
        display: none;
        width: 224px;
        background-color: #fff;
        color: #333;
        text-align: left;
        border-radius: 3px;
        padding: 10px 15px;
        position: absolute;
        z-index: 1;
        top: -33px;
        border: 1px solid #cccccc;
        left: 113px;
        -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .tooltiptext::before {
        content: "";
        position: absolute;
        top: 40px;
        left: -9px;
        border-style: solid;
        border-width: 6px 6px 0;
        border-color: #ccc transparent;
        display: block;
        width: 0;
        z-index: 0;
        transform: rotate(90deg);
    }

    .tooltiptext::after {
        content: "";
        position: absolute;
        top: 40px;
        left: -7px;
        border-style: solid;
        border-width: 5px 5px 0;
        border-color: #FFFFFF transparent;
        display: block;
        width: 0;
        z-index: 1;
        transform: rotate(90deg);
    }

    .tooltip_table .tooltiptext strong {
        text-transform: uppercase;
        margin-bottom: 10px;
        display: block;
    }

    .tooltip_table:hover .tooltiptext {
        display: block;
    }

    .tab-pane p{ font-size: 16px;}

    .highlighted { color:#008000;font-size:15px !important;}

</style>

<!-- Content area -->
<div class="content">


    <!-- Dashboard content -->


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-12">
                            <h6 class="panel-title">Email/Sms Templates</h6>

                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="tabbable">
                                <ul class="nav nav-tabs nav-tabs-bottom">
                                    <li class="active"><a href="#Emailtab" data-toggle="tab"><i class="icon-file-text position-left"></i> Email </a></li>
                                    <li><a href="#SMStab" data-toggle="tab"><i class="icon-menu7 position-left"></i> SMS </a></li>
                                </ul>
                                <div class="tab-content" style="min-height:500px;">
                                    <!--########################TAB 1 ##########################-->
                                    <div class="tab-pane active" id="Emailtab">
                                        <?php
                                        if (!empty($oCampaigns)) {
                                            foreach ($oCampaigns as $oCampaign) {
                                                if ($oCampaign->campaign_type == 'Email') {
                                                    ?>
                                                    <div class="alert alert-info chooseTemplate" style="cursor:pointer" templateid="<?php echo $oCampaign->id; ?>">
                                                        <?php echo $oCampaign->name; ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>

                                    </div>
                                    <!--########################TAB 2 ##########################-->
                                    <div class="tab-pane" id="SMStab"> 
                                        <?php
                                        if (!empty($oCampaigns)) {
                                            foreach ($oCampaigns as $oCampaign) {
                                                if ($oCampaign->campaign_type == 'Sms') {
                                                    ?>
                                                    <div class="alert alert-warning chooseTemplate" style="cursor:pointer" templateid="<?php echo $oCampaign->id; ?>">
                                                        <?php echo $oCampaign->name; ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <!--########################TAB end ##########################-->
                                </div>
                            </div>

                        </div>

                        <div class="col-md-9">
                            <div class="tab-pane" id="post_purchase_tab">

                                <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/wysihtml5.min.js"></script>
                                <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/toolbar.js"></script>
                                <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/parsers.js"></script>
                                <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js"></script>
                                <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pages/editor_wysihtml5.js"></script>
                                <?php $aTags = array('FIRST_NAME', 'LAST_NAME', 'EMAIL', 'ADVOCATE_REWARD', 'FRIEND_REWARD', 'REFERRAL_LINK', 'STORE_NAME', 'STORE_URL', 'STORE_EMAIL'); ?>


                                <div style="width:100%;" id="template-info">
                                    <div style="position:relative; top:100px; left:150px;"><h3><strong>Edit and Design Email/Sms templates for your users</strong></h3></div>

                                </div>
                                <div class="clearfix"></div>


                                <?php
                                if (!empty($oCampaigns)) {
                                    foreach ($oCampaigns as $oCampaign) {
                                        if ($oCampaign->campaign_type == 'Email') {
                                            ?>

                                            <div class="template-content" id="template_<?php echo $oCampaign->id; ?>" style="display:none;">
                                                <h2 class="text text-center"><strong><?php echo $oCampaign->name; ?> Template</strong></h2>
                                                <div class="clearfix"></div>
                                                <form method="post" name="updateEmailTempaltes" id="updateTempaltes_<?php echo $oCampaign->id; ?>" action="javascript:void();">

                                                    <div class="snoteeditoe">
                                                        <textarea rows="15" name="emailtemplate" id="emailtemplate_<?php echo $oCampaign->id;?>" class="wysihtml5 wysihtml5-default form-control" style="height:600px;" required><?php echo base64_decode($oCampaign->html); ?></textarea>

                                                        <div class="col-lg-12" style="margin-top:10px;">
                                                            <?php
                                                            foreach ($aTags as $value) {
                                                                ?><button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo '{' . $value . '}'; ?>" class="btn btn-default add_btn draggable insert_tag_button" campaignid="<?php echo $oCampaign->id;?>"><?php echo '{' . $value . '}'; ?></button>&nbsp;&nbsp;<?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 text-right" style="margin-top:30px;">
                                                        <input name="campaignId" id="campaignId" value="<?php echo $oCampaign->id; ?>" type="hidden">
                                                        <input name="campaignType" id="campaignType" value="<?php echo $oCampaign->campaign_type; ?>" type="hidden">
                                                        <button type="submit"  class="btn bl_cust_btn new btn-default">Save</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <?php
                                        }
                                    }
                                }
                                ?>

                                <!-- SMS templates -->
                                <?php
                                if (!empty($oCampaigns)) {
                                    foreach ($oCampaigns as $oCampaign) {
                                        if ($oCampaign->campaign_type == 'Sms') {
                                            ?>

                                            <div class="template-content" id="template_<?php echo $oCampaign->id; ?>" style="display:none;">
                                                <h2 class="text text-center"><strong><?php echo $oCampaign->name; ?> Template</strong></h2>
                                                <form method="post" name="updateSmsTempaltes" id="updateTempaltes_<?php echo $oCampaign->id; ?>" action="javascript:void();">

                                                    <div class="snoteeditoe">
                                                        <textarea rows="15" name="smstemplate" id="emailtemplate_<?php echo $oCampaign->id;?>" class="wysihtml5 wysihtml5-default form-control" style="height:600px;" required><?php echo base64_decode($oCampaign->html); ?></textarea>

                                                        <div class="col-lg-12" style="margin-top:10px;">
                                                            <?php
                                                            foreach ($aTags as $value) {
                                                                ?><button type="button" data-toggle="tooltip" title="Click to insert Tag" data-tag-name="<?php echo '{' . $value . '}'; ?>" class="btn btn-default add_btn draggable insert_tag_button"><?php echo '{' . $value . '}'; ?></button>&nbsp;&nbsp;<?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 text-right" style="margin-top:30px;">
                                                        <input name="campaignId" id="campaignId" value="<?php echo $oCampaign->id; ?>" type="hidden">
                                                        <input name="campaignType" id="campaignType" value="<?php echo $oCampaign->campaign_type; ?>" type="hidden">
                                                        <button type="submit"  class="btn bl_cust_btn new btn-default">Save</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <?php
                                        }
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>



    <!-- /dashboard content -->

</div>
<!-- /content area -->
<script>
    $(document).ready(function () {

        $(".chooseTemplate").click(function () {

            var campaignID = $(this).attr("templateid");
            $("#template-info").hide();
            $(".template-content").hide();
            $("#template_" + campaignID).show();

        });


        $("[id^=updateTempaltes_]").submit(function () {

            var formID = $(this).attr("id");
            $('.overlaynew').show();
            var formdata = $("#"+formID).serialize();
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/updateUserCampaign'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        window.location.href = window.location.href;
                    } else {
                        $('.overlaynew').hide();
                        alertMessage('Error: Some thing wrong!');
                    }
                }, error: function () {
                    $('.overlaynew').hide();
                    alertMessage('Error: Some thing wrong!');
                }
            });


        });

        $('.insert_tag_button').on('click', function () {
            var campaignID = $(this).attr("campaignid");
            var tagname = $(this).attr('data-tag-name');
            var wysihtml5Editor = $("#emailtemplate_"+campaignID).data("wysihtml5").editor;
            wysihtml5Editor.composer.commands.exec("insertHTML", tagname);
        });
    });
</script>