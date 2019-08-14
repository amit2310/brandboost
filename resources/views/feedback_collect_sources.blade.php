<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BrandBoost::Thank you</title>
        <link rel="icon" href="assets/images/icon.ico" sizes="16x16" type="image/ico">

        <!-- Global stylesheets -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url("assets/css/icons/icomoon/styles.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/core.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/components.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/colors.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("new_pages/assets/css/theme1.css"); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url("assets/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <style type="text/css">
            .socialIcon {
                font-size: 25px;
                display: block;
                width: 55px;
                height: 55px;
                background: #fff;
                line-height: 55px;
                border-radius: 100px;
                box-shadow: 0 2px 6px 0 rgba(0,0,0,.1);
            }
            .media-list.newd li.panel-body .media-left a{  padding: 35px 50px 0!important; }
            .input-group .form-control:not(:first-child):not(:last-child) { padding-left: 0; }
            .bkg1{background: #ffeceb!important}
            .bkg2{background: #d8f0e5!important}
            .bkg3{background: #e7f0ff!important}
            .bkg5{background: #dce9f6!important}
        </style>
        <script src="<?php echo base_url("assets/js/core/libraries/jquery.min.js"); ?>" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/core/libraries/bootstrap.min.js"); ?>"></script>


    </head>


    <body>

        <div class="review_request_sec">

            <div class="review_header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6">
                            <a class="fsize17 fw500 txt_white" href="<?php echo base_url(); ?>"><img src="<?php echo base_url("assets/images/logo_icon_bb.png"); ?>" width="28" alt=""></a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="#" class="fsize12 txt_white">FAQ</a>
                        </div>
                    </div>
                </div>
            </div>


            <?php //if ($ratingsType = 'star') ; ?>
            <div class="container">
                <div class="review_main_box_new">
                    <div class="review_top_icon"><img width="74" src="<?php echo base_url("assets/images/review/review_tick_icon.png"); ?>"/></div>
                    <h2>Thanks for your feedback!</h2>
                    <p>Here are the list of favorite channel where you can leave your reviews: </p>
                    <?php
                    if (!empty($aSourceLinks)):
                        $thumbColor = array('bkg1', 'bkg2', 'bkg3', 'bkg4', 'bkg5', 'bkg6');
                        ?>
                        <div class="p25">

                            <ul class="media-list newd">
                                <?php
                                foreach ($aSourceLinks as $id => $aLink):
                                    if($id > 0):
                                        $aSource = getOffsite($id);
                                        $sourceName = strtolower($aSource->name);
                                        if ($sourceName == 'yelp') {
                                            $sourceClass = 'txt_red';
                                            $thumbclass = 'bkg2';
                                        } else if ($sourceName == 'google') {
                                            $sourceClass = 'txt_blue';
                                            $thumbclass = 'bkg1';
                                        } else if ($sourceName == 'yahoo') {
                                            $sourceClass = 'txt_purple';
                                            $thumbclass = 'bkg5';
                                        } else if ($sourceName == 'facebook') {
                                            $sourceClass = 'txt_dblue';
                                            $thumbclass = 'bkg3';
                                        } else {
                                            $sourceClass = 'txt_blue';
                                            $thumbclass = 'bkg1';
                                        }
                                        //$sourceName = !empty($sourceName) ? $sourceName : 'NA';
                                        if (!empty($sourceName)):
                                            ?>
                                            <li class="media panel-body stack-media-on-mobile" id="socialIcon<?php echo $value; ?>">
                                                <div class="media-left"> 
                                                     
                                                    <?php if (in_array('OtherSources', unserialize($aSource->site_categories))) { 
                                                            if (filter_var($aLink['link'], FILTER_VALIDATE_URL)) {
                                                                
                                                            } else {
                                                                $aLink['link'] = 'http://'.$aLink['link'];
                                                            }
                                                        ?>
                                                        <a class="<?php echo $thumbclass; ?>" href="<?php echo $aLink['link']; ?>"> 
                                                            <i class="icon-<?php echo $sourceName . ' ' . $sourceClass; ?> socialIcon" style="font-style:inherit">M</i> 
                                                        </a>
                                                    <?php } else { ?>
                                                        <a class="<?php echo $thumbclass; ?>" href="<?php echo $aLink['longurl']; ?>"> 
                                                            <i class="icon-<?php echo $sourceName . ' ' . $sourceClass; ?> socialIcon"></i>
                                                        </a>
                                                    <?php } ?>
                                                     
                                                </div>
                                                <div class="media-body" style="vertical-align:middle;">
                                                    <div class="col-md-12 mb-10 pl0" style="padding-right:15px;">
                                                        <h5>
                                                            <?php if (in_array('OtherSources', unserialize($aSource->site_categories))) { 
                                                                if (filter_var($aLink['link'], FILTER_VALIDATE_URL)) {
                                                                    
                                                                } else {
                                                                    $aLink['link'] = 'http://'.$aLink['link'];
                                                                }
                                                                ?>
                                                                <a href="<?php echo $aLink['link']; ?>" style="color:#344977;">
                                                                    Click here to leave us a review on <?php echo ucfirst($sourceName); ?> 
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="<?php echo $aLink['longurl']; ?>" style="color:#344977;"> 
                                                                    Click here to leave us a review on <?php echo ucfirst($sourceName); ?>
                                                                </a>
                                                            <?php } ?>
                                                            
                                                        </h5>
                                                    </div>

                                                </div>

                                            </li>

                                        <?php
                                        endif;
                                    endif;
                                endforeach;
                                ?>
                            </ul>
                        </div>
<?php endif; ?>



                    <div class="review_button mt30">
                            <!--<button class="btn dark_btn bkg_blue_light h52 mr10 sh_no">Send feedback <i class="icon-paperplane"></i></button>-->
                        <a href="<?php echo (!empty($oBrandboost->store_url) ? $oBrandboost->store_url : site_url()); ?>" class="btn light_btn bkg_grey_light h52 ml10 txt_dark sh_no" style="padding-top:17px;">Back to the homepage <i class="icon-arrow-right13"></i></a>
                    </div>

                </div>
            </div>

        </div>



    </body>
</html>