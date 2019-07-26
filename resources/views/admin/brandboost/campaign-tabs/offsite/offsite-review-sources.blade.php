<?php list($canRead, $canWrite) = fetchPermissions('Offsite Campaign'); ?>
<div class="tab-pane <?php echo $sources; ?>" id="right-icon-tab0">
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-flat" style="margin-bottom:7px!important">
                <div class="panel-heading">
                    <h6 class="panel-title">Review Source</h6>
                </div>
                <div class="panel-body pl20 pr20 pt-10 pb-10 bkg_white">
                    <div class="form-group mb0">
                        <div class="input-group review_source_search w100">
                            <input id="myCustomInput" type="text" class="form-control h40 pl0" placeholder="Search review sites..."/>
                            <span class="input-group-addon pr0"><i class="fa fa-search txt_grey"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .othersources .rev_col {
                width: 220px!important;
                max-width: 220px!important;
                margin: 0 0px 20px 0;
            }
            .othersources .thumbnail {
                margin-bottom: 0px;
                border: 1px solid #e5ebe5!important;
                border-radius: 6px;
                transition: transform .15s ease;
                padding: 0px;
                box-shadow: 0 1px 2px 0 rgba(0,0,0,.02), 0 6px 18px 0 rgba(0,0,0,.055);
            }
            .othersources .thumbnail .thumb {
                padding: 33px 0;
                background: #f1f6ff;
                border-radius: 6px 6px 0 0!important;
                height: 124px;
                text-align: center;
            }
            .othersources .thumbnail .caption {
                padding-top: 15px!important;
                padding-left: 15px!important;
                padding-right: 15px!important;
                position: relative;
            }
        </style>
        <!-- Other Source category -->
        <div class="notFoundRow othersources" style="display: none;">
            <div class="panel-heading sidebarheadings active">
                <h6 class="panel-title"> <a class="" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-groupaccordion-control-group10" aria-expanded="true"><i class="icon-power2"></i>&nbsp;Other Sources</a> </h6>
            </div>
            <div id="" data-toggle="modal" data-target="#OtherSourcesId" aria-expanded="true" style="display:block">
                <div class="panel-body">
                    <div class="row filter_campaign">

                        <div class="col-xs-12 col-md-2 col-sm-2 rev_col">
                            <div class="thumbnail">
                                <div class="thumb bkg1">
                                    <a href="javascript:void(0);"><i class="txt_blue" style="font-style:inherit">M</i></a>
                                </div>
                                <div class="caption text-center">
                                    <div class="pull-left">
                                        <h5 class="no-margin sea">Custom Source</h5>
                                        <h6 class="text-muted">Use Custom Domain</h6> 
                                    </div>
                                    <div class="clearfix"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Other Source category -->


        <div class="col-md-12">

            <div class="filter_campaign_new">

                <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                    <?php
                    if (!empty($offsite_ids)) {
                        $selected_list = implode(",", $offsite_ids);
                    } else {
                        $selected_list = 0;
                    }
                    ?>

                    <input type="hidden" name="selected_list" id='selected_list' value="<?php echo $selected_list; ?>">

                    <?php
                    $siteDatarray = array();
                    $cateList = array(
                        'accordion-control-group1' => array(
                            'icon' => 'icon-stack2',
                            'title' => 'Most Popular',
                            'cat_img' => 'star_purple.png'
                        ),
                        'accordion-control-group2' => array(
                            'icon' => 'icon-copy',
                            'title' => 'Automotive',
                            'cat_img' => 'automative.png'
                        ),
                        'accordion-control-group3' => array(
                            'icon' => 'icon-droplet2',
                            'title' => 'Dental',
                            'cat_img' => 'dental.png'
                        ),
                        'accordion-control-group4' => array(
                            'icon' => 'icon-cart2',
                            'title' => 'E-commerce',
                            'cat_img' => 'ecom.png'
                        ),
                        'accordion-control-group5' => array(
                            'icon' => 'icon-select2',
                            'title' => 'Financial services',
                            'cat_img' => 'finse.png'
                        ),
                        'accordion-control-group6' => array(
                            'icon' => 'icon-user-plus',
                            'title' => 'Healthcare',
                            'cat_img' => '',
                            'icon_class' => 'icon-user-plus'
                        ),
                        'accordion-control-group7' => array(
                            'icon' => 'icon-home7',
                            'title' => 'Home services',
                            'cat_img' => '',
                            'icon_class' => 'icon-home2'
                        ),
                        'accordion-control-group8' => array(
                            'icon' => 'icon-office',
                            'title' => 'Hotels',
                            'cat_img' => '',
                            'icon_class' => 'icon-office'
                        ),
                        'accordion-control-group9' => array(
                            'icon' => 'icon-design',
                            'title' => 'Insurance',
                            'cat_img' => '',
                            'icon_class' => 'icon-power2'
                        ),
                        'accordion-control-group10' => array(
                            'icon' => 'icon-stamp',
                            'title' => 'Legal',
                            'cat_img' => '',
                            'icon_class' => 'icon-user-tie'
                        ),
                        'accordion-control-group11' => array(
                            'icon' => 'icon-stack',
                            'title' => 'Personal Services',
                            'cat_img' => '',
                            'icon_class' => 'icon-hammer-wrench'
                        ),
                        'accordion-control-group12' => array(
                            'icon' => 'icon-city',
                            'title' => 'Real Estate',
                            'cat_img' => '',
                            'icon_class' => ''
                        ),
                        'accordion-control-group13' => array(
                            'icon' => 'icon-home4',
                            'title' => 'Restaurants',
                            'cat_img' => '',
                            'icon_class' => ''
                        ),
                        'accordion-control-group14' => array(
                            'icon' => 'icon-database-edit2',
                            'title' => 'Software',
                            'cat_img' => '',
                            'icon_class' => ''
                        ),
                        'accordion-control-group15' => array(
                            'icon' => 'icon-database-edit2',
                            'title' => 'OtherSources',
                            'cat_img' => '',
                            'icon_class' => ''
                        )
                    );
                    $cinc = 0;
                    echo '<div  id="myTable">';
                    ?>

                    <?php
                    $searchfalg = 0;
                    $showextra = 0;
                    $showcount = 0;
                    foreach ($cateList as $key => $cate) {
                        ?>
                        <div class="panel panel-white" id="SPanel<?php echo $key; ?>">
                            <div class="panel-heading sidebarheadings active">
                                <h6 class="panel-title"> <a class="<?php echo $cinc > 0 ? 'collapsed' : ''; ?>" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group<?php echo $key; ?>">

                                        <?php if (!empty($cate['cat_img'])) { ?>
                                            <i class="">
                                                <img src="/new_pages/assets/images/<?php echo $cate['cat_img']; ?>"></i>
                                        <?php } else if (!empty($cate['icon_class'])) { ?>
                                            <i class="<?php echo $cate['icon_class']; ?>"></i> 
                                        <?php } else { ?>
                                            <i class="icon-power2"></i> 
                                        <?php } ?>

                                        &nbsp;<?php
                                        if ($cate['title'] == 'OtherSources') {
                                            echo 'Other Sources';
                                        } else {
                                            echo $cate['title'];
                                        }
                                        ?></a> </h6>
                            </div>
                            <div id="accordion-control-right-group<?php echo $key; ?>" class="panel-collapse collapse <?php echo $cinc == '0' ? 'in firstRow' : ''; ?>">
                                <div class="panel-body">
                                    <div class="row">

                                        <?php
                                        $thumbColor = array('bkg1', 'bkg2', 'bkg3', 'bkg4', 'bkg5', 'bkg6');


                                        foreach ($offSiteData as $siteData) {

                                            //pre($siteData->image);

                                            $categoryunserilize = unserialize($siteData->site_categories);
                                            if ($categoryunserilize[0] == 'OtherSources') {


                                                $showextra = 1;
                                            }


                                            if (in_array($cate['title'], unserialize($siteData->site_categories))) {
                                                //$inc = rand(0, 5);
                                                $getLinksSocial = $offsites_links[$siteData->id]['link'];
                                                $sourceName = strtolower($siteData->name);


                                                if ($sourceName == 'yelp') {
                                                    $sourceClass = 'txt_red';
                                                    $thumbclass = 'bkg2';
                                                    $sourceImg = 'yelp_logo.png';
                                                } else if ($sourceName == 'google') {
                                                    $sourceClass = 'txt_blue';
                                                    $thumbclass = 'bkg1';
                                                    $sourceImg = 'google_add_co.png';
                                                } else if ($sourceName == 'yahoo') {
                                                    $sourceClass = 'txt_purple';
                                                    $thumbclass = 'bkg5';
                                                    $sourceImg = 'yahoo_logo.png';
                                                } else if ($sourceName == 'facebook') {
                                                    $sourceClass = 'txt_dblue';
                                                    $thumbclass = 'bkg3';
                                                    $sourceImg = 'facebook_icon.png';
                                                } else {
                                                    $sourceClass = 'txt_blue';
                                                    $thumbclass = 'bkg1';
                                                    $sourceImg = 'lawyers_logo.png';
                                                }

                                                $sourceName = !empty($sourceName) ? $sourceName : 'NA';
                                                ?>

                                                <?php if (in_array('OtherSources', unserialize($siteData->site_categories)) && $showcount < 1) { ?>
                                                    <div data-toggle="modal" id="rowDefault" data-target="#OtherSourcesId" class="col-xs-12 col-md-2 col-sm-2 rev_col">
                                                        <div class="thumbnail">
                                                            <div class="thumb bkg1">
                                                                <a href="javascript:void(0);"><i class="txt_blue" style="font-style:inherit">M</i></a>
                                                            </div>
                                                            <div class="caption text-center">
                                                                <div class="pull-left">
                                                                    <h5 class="no-margin sea">Custom Source</h5>
                                                                    <h6 class="text-muted">Use Custom Domain</h6> 
                                                                </div>
                                                                <div class="clearfix"></div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $showcount++;
                                                }
                                                ?>



                                                <div onmouseover="ShowImg('<?php echo $siteData->id; ?>')" onmouseleave="HideImg('<?php echo $siteData->id; ?>')" class="<?php if (in_array('OtherSources', unserialize($siteData->site_categories))) { ?>OtMouseover_<?php
                                                         echo $siteData->id;
                                                     }
                                                     ?> col-xs-12 col-md-2 col-sm-2 rev_col <?php
                                                     if (in_array($siteData->id, $offsite_ids)) {
                                                         echo 'selected';
                                                     }
                                                     ?>" offsetId="<?php echo $siteData->id; ?>" id="review_steps<?php echo $siteData->id; ?>">
                                                    <?php if (in_array('OtherSources', unserialize($siteData->site_categories))) { ?>
                                                        <a id="tickImg_<?php echo $siteData->id; ?>" style="display:none" CsourceId="<?php echo $siteData->id; ?>" href="javascript:void(0);" class="deleteCustomSource"><i class="icon-cross2"></i></a>
            <?php } ?>
                                                    <div class="thumbnail">

                                                        <div class="thumb <?php echo $thumbclass; ?>">
                                                            <a href="javascript:void(0);"> <?php if (in_array('OtherSources', unserialize($siteData->site_categories))) { ?><i class="icon-<?php echo $sourceName . ' ' . $sourceClass; ?>" style="font-style:inherit">M</i> <?php } else { ?>

                                                <!-- <img src="/new_pages/assets/images/<?php echo $sourceImg; ?>"> -->
                                                                    <img src="<?php echo '/uploads/' . $siteData->image; ?>">


            <?php } ?></a>
                                                        </div>



                                                        <div class="caption text-center">
                                                            <div class="pull-left">
                                                                <h5 class="no-margin sea"><?php echo ucfirst($siteData->name); ?></h5>
                                                                <h6 class="text-muted"><?php
                                                                    if (in_array('OtherSources', unserialize($siteData->site_categories))) {
                                                                        $getLinksSocial = $getLinksSocial != '' ? $getLinksSocial : $siteData->website_url;
                                                                        $str = str_replace("www.", "", preg_replace('#^https?://#', '', $getLinksSocial));
                                                                        echo $str;
                                                                    } else {

                                                                        $str = preg_replace('#^https?://#', '', $siteData->website_url);
                                                                        echo $str;
                                                                    }
                                                                    ?></h6>
                                                            </div>
                                                                <?php if ($canWrite): ?>
                                                                <label class="custom-form-switch pull-right mt10">
                                                                    <input class="field offsite_selected" type="checkbox" <?php
                                                                    if (in_array($siteData->id, $offsite_ids)) {
                                                                        echo 'checked';
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                    ?> offsiteSelected="<?php
                                                                           if (in_array($siteData->id, $offsite_ids)) {
                                                                               echo '1';
                                                                           } else {
                                                                               echo '0';
                                                                           }
                                                                           ?>" offsiteId="<?php echo $siteData->id; ?>">
                                                                    <span class="toggle green"></span>
                                                                </label>
            <?php endif; ?>
                                                            <div class="clearfix"></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
    <?php }
    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $cinc++;
                    }
                    if ($showextra == 0) {
                        ?> 

                        <script>

                            if (document.getElementById("SPanelaccordion-control-group15") !== null) {
                                document.getElementById("SPanelaccordion-control-group15").style.display = 'none';
                            }
                            if (document.getElementById('rowDefault') !== null) {
                                document.getElementById('rowDefault').style.display = 'none';
                            }
                        </script>
                        <!-- Other Source category -->
                        <div class="notFoundRow othersources" style="display: block;" id="defaultothersources">
                            <div class="panel-heading sidebarheadings active">
                                <h6 class="panel-title"> <a class="" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-groupaccordion-control-group15" aria-expanded="true"><i class="icon-power2"></i>&nbsp;Other Sources</a> </h6>
                            </div>
                            <div id="" data-toggle="modal" data-target="#OtherSourcesId" aria-expanded="true" style="display:block">
                                <div class="panel-body">
                                    <div class="row filter_campaign">

                                        <div class="col-xs-12 col-md-2 col-sm-2 rev_col">
                                            <div class="thumbnail">
                                                <div class="thumb bkg1">
                                                    <a href="javascript:void(0);"><i class="txt_blue" style="font-style:inherit">M</i></a>
                                                </div>
                                                <div class="caption text-center">
                                                    <div class="pull-left">
                                                        <h5 class="no-margin sea">Custom Source</h5>
                                                        <h6 class="text-muted">Use Custom Domain</h6> 
                                                    </div>
                                                    <div class="clearfix"></div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Other Source category --> 
                        <?php
                    }
                    ?>


                </div>
            </div>
        </div>


    </div>
</div>
<div class="row">
    <div class="col-md-12 text-right">
<?php if ($canWrite): ?>
            <a href="javascript:void(0);" class="btn dark_btn mt10 saveReviewSource hidden" data-brandid="<?php echo $brandboostID; ?>">
                Continue
                <i class=" icon-arrow-right13 text-size-base position-right"></i>
            </a>
<?php endif; ?>
    </div>
</div>
</div>
<script>

    function ShowImg(divid)
    {

        document.getElementById("tickImg_" + divid).style.display = 'block';
    }

    function HideImg(divid)
    {

        document.getElementById("tickImg_" + divid).style.display = 'none';
    }

    $(document).ready(function () {


        $("#myCustomInput").on("keyup", function () {
            $(".notFoundRow").hide();
            var myLength = $("#myCustomInput").val().length;
            var cnt = 0;
            var flag = 0;

            if (myLength > 0)
            {
                var value = $(this).val().toLowerCase();
                $("#myTable .panel-body .col-xs-12").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    if ($(this).text().toLowerCase().indexOf(value) == -1) {
                        //$(".notFoundRow").show();
                    } else {
                        $(".notFoundRow").hide();
                        cnt++;
                    }

                });

                $("#myTable .panel").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    if ($(this).text().toLowerCase().indexOf(value) == -1) {
                        $(".notFoundRow").show();
                    } else {
                        $(".notFoundRow").hide();
                        cnt++;
                    }

                });

            } else
            {
                $(".notFoundRow").hide();
                $(".panel").css("display", "block");
                $(".col-xs-12").css("display", "block");
                $('.panel-collapse').removeClass('in');
                $('.firstRow').addClass('in');
                $("#defaultothersources").show();
                flag = 1;


            }
            if (flag == 0)
            {
                if (cnt > 0)
                {
                    $(".notFoundRow").hide();
                    $("#defaultothersources").show();
                } else
                {
                    $(".notFoundRow").show();
                    $("#defaultothersources").hide();
                }

            }


        });

        $("#OtherSourcesPopupFrm").submit(function () {
            //$('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/offsite/add_website'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        //$('.overlaynew').hide();
                        var offstepIds = [];
                        var selected_list = $('#selected_list').val();
                        selected_list += ',' + data.id;
                        var offstepIds = selected_list.split(",");
                        CustomAddSource(offstepIds, data.brandboostID);
                        $('#selected_list').val(offstepIds);
                        //$('.saveReviewSource').trigger('click');

                        (function () {
                            $.ajax({
                                url: "<?php echo base_url('admin/brandboost/campaignPreferences'); ?>",
                                data: {brandboostID: '<?php echo $brandboostData->id; ?>'},
                                method: "POST",
                                dataType: "json",
                                success: function (data)
                                {
                                    if (data.status == 'success') {
                                        //$('.overlaynew').hide();
                                        $('.media-list').html(data.socialList);
                                        $('#selected_list_r').val(data.selectedList);
                                    } else {
                                        //$('.overlaynew').hide();
                                    }
                                }
                            });
                        })();
                        $('#offsitename').val('');
                        $('#txtURL').val('');
                        $('#OtherSourcesId').modal('hide');
                        displayMessagePopup();
                        $('[href="#right-icon-tab1"]').trigger('click');
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $(document).on('click', '.deleteCustomSource', function () {
            var elem = $(this);
            var CsourceId = $(this).attr('CsourceId');
            deleteConfirmationPopup(
                    "This Source will deleted immediately.<br>You can't undo this action.",
                    function () {

                        $('.overlaynew').show();
                        $.ajax({
                            url: '<?php echo base_url('admin/offsite/delete_customsource'); ?>',
                            type: "POST",
                            data: {'CustomSourceID': CsourceId},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    $('#review_steps' + CsourceId).hide();
                                    $('.overlaynew').hide();
                                    var offstepIds = [];
                                    var selected_list = $('#selected_list').val();
                                    var offstepIds = selected_list.split(",");
                                    offstepIds = $.grep(offstepIds, function (value) {
                                        return value != CsourceId;
                                    });
                                    offstepIds = offstepIds.join();
                                    $('#selected_list').val(offstepIds);
                                    //DelSourcefrmPrefrence(offstepIds);

                                    $('.saveReviewSource').trigger('click');
                                    (function () {
                                        $.ajax({
                                            url: "<?php echo base_url('admin/brandboost/campaignPreferences'); ?>",
                                            data: {brandboostID: '<?php echo $brandboostData->id; ?>'},
                                            method: "POST",
                                            dataType: "json",
                                            success: function (data)
                                            {
                                                if (data.status == 'success') {
                                                    $('.overlaynew').hide();
                                                    $('.media-list').html(data.socialList);
                                                    $('#selected_list_r').val(data.selectedList);
                                                } else {
                                                    $('.overlaynew').hide();
                                                }
                                            }
                                        });
                                    })();

                                    //$('[href="#right-icon-tab1"]').trigger('click');
                                    $('.overlaynew').hide();
                                    //displayMessagePopup('success', 'Success!', 'Your data has been deleted successfully.');
                                    // location.reload();
                                    window.location.href = "<?php echo base_url('admin/brandboost/offsite_setup/'); ?><?php echo $brandboostData->id; ?>?type=del";
                                } else {
                                    alertMessage('Error: Some thing wrong!');
                                    $('.overlaynew').hide();
                                }
                            }
                        });
                    });
        });

        $(document).on('click', '.offsite_selected', function () {

            $('.overlaynew').show();
            var offsiteId = $(this).attr('offsiteid');
            var offsiteSelected = $(this).attr('offsiteselected');
            if (offsiteSelected == 0) {
                $(this).attr('offsiteselected', '1');
                $('#review_steps' + offsiteId).addClass('selected');
                $(this).addClass('btn-success');

                var selected_list = $('#selected_list').val();
                $('#selected_list').val(selected_list + ',' + offsiteId);
            } else {
                $(this).attr('offsiteselected', '0');
                $('#review_steps' + offsiteId).removeClass('selected');
                $(this).removeClass('btn-success');

                var selected_list = $('#selected_list').val();
                var offstepIds = selected_list.split(",");
                offstepIds = $.grep(offstepIds, function (value) {
                    return value != offsiteId;
                });
                offstepIds = offstepIds.join();
                $('#selected_list').val(offstepIds);
            }

            $('.saveReviewSource').trigger('click');

            (function () {
                $.ajax({
                    url: "<?php echo base_url('admin/brandboost/campaignPreferences'); ?>",
                    data: {brandboostID: '<?php echo $brandboostData->id; ?>'},
                    method: "POST",
                    dataType: "json",
                    success: function (data)
                    {
                        if (data.status == 'success') {
                            $('.overlaynew').hide();
                            $('.media-list').html(data.socialList);
                            $('#selected_list_r').val(data.selectedList);
                        } else {
                            $('.overlaynew').hide();
                        }
                    }
                });
            })();
        });
    });

    function CustomAddSource(offstepIds, brandboostID) {
        if (offstepIds.length > 0) {
            $.ajax({
                url: '<?php echo base_url('admin/brandboost/add_offsite_edit'); ?>',
                type: "POST",
                data: {'offstepIds': offstepIds, brandboostID: brandboostID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = "<?php echo base_url('admin/brandboost/offsite_setup/'); ?>" + brandboostID + "?type=add";
                    } else {
                        alertMessage('Error: Some thing wrong!');
                    }
                }
            });
        } else {
            alertMessage('Please select atleast one of them.')
        }
    }
    ;

    /*function DelSourcefrmPrefrence(offstepIds) {           
     if (offstepIds.length > 0) {
     $.ajax({
     url: '<?php echo base_url('admin/brandboost/add_offsite_edit'); ?>',
     type: "POST",
     data: {'offstepIds': offstepIds, brandboostID:'<?php echo $brandboostData->id; ?>'},
     dataType: "json",
     success: function (data) {
     if (data.status == 'success') {
     window.location.href = "<?php echo base_url('admin/brandboost/offsite_setup/'); ?><?php echo $brandboostData->id; ?>?type=CmPre";
     } else {
     alertMessage('Error: Some thing wrong!');
     }
     }
     });
     } else {
     alertMessage('Please select atleast one of them.')
     }
     };*/

</script>		