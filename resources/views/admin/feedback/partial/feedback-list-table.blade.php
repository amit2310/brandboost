<?php if (count($result) > 0) {?>
<table class="table" id="offsiteFeedback">
    <thead>
        <tr>
            <th style="display: none;"></th>
            <th style="display: none;"></th>
            <th class="nosort editAction" style="display:none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
            <th><i class="icon-user"></i>Name</th>
            <th><i class="icon-user"></i>Campaign</th>
            <th><i class="icon-star-full2"></i>Ratings</th>
            <th><i class="icon-paragraph-left3"></i>Feedback</th>
            <th><i class="icon-calendar"></i>Created</th>
            <th><i class="icon-hash"></i>Tags</th>
            <th><i class="icon-folder2"></i>Category</th>
            <th><i class="icon-diff-modified"></i>Status</th>
            <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
            <th style="display: none;"></th>
            <!-- <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i>Action</th> -->
        </tr>
    </thead>
    <tbody>

        <?php
        
            foreach ($result as $data) {
                $feedbackTags = \App\Models\Admin\TagsModel::getTagsDataByFeedbackID($data->id);
                /*$brandImgArray = unserialize($data->brand_img);
                $brand_img = $brandImgArray[0]['media_url'];

                if (empty($brand_img)) {
                    $imgSrc = base_url('assets/images/default_table_img2.png');
                } else {
                    $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
                }*/
				
				$imgSrc = base_url('assets/images/default_table_img2.png');

                if (!empty($data->avatar)) {
                    $avatarImage = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $data->avatar;
                } else {
                    $avatarImage = base_url('profile_images/avatar_image.png');
                }
                ?>
                <tr id="append-feedback-<?php echo $data->id; ?>" class="selectedClass">
                    <td style="display: none;"><?php echo date('m/d/Y', strtotime($data->created)); ?></td>
                    <td style="display: none;"><?php echo $data->id; ?></td>
                    <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows"  value="<?php echo $data->id; ?>" ><span class="custmo_checkmark"></span></label></td>

                    <td class="viewSmartPopup" feedbackid="<?php echo $data->id; ?>">
                        <div class="media-left media-middle"> <?php echo showUserAvtar($data->avatar, $data->firstname, $data->lastname); ?> </div>

                        <div class="media-left">
                            <?php if ($data->firstname != '') { ?>
                                <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold"><span><?php echo $data->firstname; ?> <?php echo $data->lastname; ?></span> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/us.png"/></a></div>
                                <div class="text-muted text-size-small"><?php echo $data->email; ?></div>
                                <?php
                            } else {
                                echo displayNoData();
                            }
                            ?>
                        </div>
                    </td>
                    <td>
                        <div class="media-left media-middle">
                            <a href="<?php echo base_url('admin/brandboost/offsite_setup/' . $data->brandboost_id); ?>" brandID="<?php echo $data->brandboost_id; ?>" b_title="<?php echo $data->brand_title; ?>">
                                <img src="<?php echo $imgSrc; ?>" class="img-circle img-xs br5" alt="Img"></a>
                        </div>
                        <div class="media-left">
                            <div class=""><a href="<?php echo base_url('admin/brandboost/offsite_setup/' . $data->brandboost_id); ?>" brandID="<?php echo $data->brandboost_id; ?>" b_title="<?php echo $data->brand_title; ?>" class="text-default text-semibold"><?php echo $data->brand_title; ?></a></div>
                            <div class="text-muted text-size-small">
                                <?php echo setStringLimit($data->brand_desc, 28); ?>
                            </div>
                        </div>

                    </td>

                    <td>
                        <?php
                        if ($data->category == 'Positive') {
                            $ratingValue = 5;
                        } else if ($data->category == 'Neutral') {
                            $ratingValue = 3;
                        } else {
                            $ratingValue = 1;
                        }
                        ?>
                        <?php echo $smilyImage = ratingView($ratingValue); ?>
                    </td>

                    <td>
                        <a href="<?php echo base_url('admin/feedback/details/' . $data->id); ?>" class="txt_dblack">
                            <div class="text-semibold"><?php echo (!empty($data->title)) ? setStringLimit($data->title, '23') : displayNoData(); ?></div>
                            <div class="text-size-small text-muted">
                                <?php echo (!empty($data->feedback)) ? setStringLimit(str_replace(array('  ', '<br>'), array('', ''), strip_tags($data->feedback)), '31') : displayNoData(); ?>
                            </div>
                        </a>
                    </td>

                    <td>
                        <div class="media-left">
                            <div class="pt-5"><a href="#" class="text-default text-semibold"><?php //echo date('d M Y', strtotime($data->created));             ?><?php echo dataFormat($data->created); ?> </a></div>
                            <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->created)); ?></div>
                        </div>
                    </td>

                    <td id="feedback_tag_<?php echo $data->id; ?>">
                        <div class="media-left pl30 blef">
                            <div class=""><a href="javascript:void(0);" class="text-default text-semibold bbot"><?php echo count($feedbackTags); ?> Tags</a> </div>
                        </div>
                        <div class="media-left pr30 brig">
                            <div class="tdropdown">
                                <button class="btn btn-xs plus_icon dropdown-toggle ml10" data-toggle="dropdown" aria-expanded="false"><i class="icon-plus3"></i></button>
                                <ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss">
                                    <?php
                                    if (count($feedbackTags) > 0) {
                                        foreach ($feedbackTags as $oTag) {
                                            ?>
                                            <button class="btn btn-xs btn_white_table pr10"> <?php echo $oTag->tag_name; ?> </button>                                                            
                                            <?php
                                        }
                                    }
                                    ?>
                                    <button class="btn btn-xs plus_icon ml10 applyInsightTagsFeedback" feedback_id="<?php echo base64_url_encode($data->id); ?>" action_name="feedback-tag"><i class="icon-plus3"></i></button>
                                </ul>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="tdropdown">
                            <?php
                            if ($data->category == 'Positive') {
                                ?><i class="icon-primitive-dot txt_green fsize16"></i> <?php
                            } else if ($data->category == 'Neutral') {
                                ?><i class="icon-primitive-dot txt_grey fsize16"></i> <?php
                            } else {
                                ?><i class="icon-primitive-dot txt_red fsize16"></i> <?php }
                            ?>

                            <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                                <?php
                                echo (!empty($data->category)) ? $data->category : 'Negative';
                                ?>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right status">
                                <?php if ($data->category == 'Positive') { ?>
                                    <li><a href="javascript:void(0);" feedback_id="<?php echo $data->id; ?>" fb_status="Neutral" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_grey"></i> Neutral</a> </li>
                                    <li><a href="javascript:void(0);" feedback_id="<?php echo $data->id; ?>" fb_status="Negative" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_red"></i> Negative</a> </li>
                                <?php } else if ($data->category == 'Neutral') { ?>
                                    <li><a href="javascript:void(0);" feedback_id="<?php echo $data->id; ?>" fb_status="Positive" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_green"></i> Positive</a> </li>
                                    <li><a href="javascript:void(0);" feedback_id="<?php echo $data->id; ?>" fb_status="Negative" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_red"></i> Negative</a> </li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a href="javascript:void(0);" feedback_id="<?php echo $data->id; ?>" fb_status="Positive" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_green"></i> Positive</a> </li>
                                    <li><a href="javascript:void(0);" feedback_id="<?php echo $data->id; ?>" fb_status="Neutral" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_grey"></i> Neutral</a> </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </td>

                    <td>
                        <div class="tdropdown">
                            <?php
                            if ($data->status == 0) {
                                echo '<i class="icon-primitive-dot txt_red fsize16"></i> ';
                            } else if ($data->status == 2) {
                                echo '<i class="icon-primitive-dot txt_grey fsize16"></i> ';
                            } else {
                                echo '<i class="icon-primitive-dot txt_green fsize16"></i> ';
                            }
                            ?>
                            <a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
                                <?php
                                if ($data->status == 0) {
                                    echo 'Inactive';
                                } else if ($data->status == 2) {
                                    echo 'Pending';
                                } else {
                                    echo 'Active';
                                }
                                ?>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-right status">
                                <?php
                                if ($canWrite) {
                                    if ($data->status == 1) {
                                        echo "<li><a feedback_id='" . $data->id . "' change_status = '0'  class='chg_status'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>";
                                    } else if ($data->status == 2) {
                                        echo "<li><a feedback_id='" . $data->id . "' change_status = '1' class='chg_status'><i class='icon-primitive-dot txt_green'></i> Active</a></li>";
                                        echo "<li><a feedback_id='" . $data->id . "' change_status = '0'  class='chg_status'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>";
                                    } else {
                                        echo "<li><a feedback_id='" . $data->id . "' change_status = '1' class='chg_status'><i class='icon-primitive-dot txt_green'></i> Active</a></li>";
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </td>

                    <td class="text-center">
                        <div class="tdropdown ml10"> 
                            <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/images/more.svg"></a>
                            <ul class="dropdown-menu dropdown-menu-right more_act">
                                <a href="javascript:void();" class="dropdown_close">X</a>

                                <?php
                                if ($canWrite) {

                                    if ($data->status == 1) {
                                        echo "<li><a feedback_id='" . $data->id . "' change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>";
                                    } else if ($data->status == 2) {
                                        echo "<li><a feedback_id='" . $data->id . "' change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>";
                                        echo "<li><a feedback_id='" . $data->id . "' change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>";
                                    } else {
                                        echo "<li><a feedback_id='" . $data->id . "' change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>";
                                    }
                                }
                                echo '<li><a target="_blank" href="' . base_url('admin/feedback/details/' . $data->id) . '"><i class="icon-file-locked"></i> View Details</a></li>';
                                ?>

                            </ul>
                        </div>
                    </td>

                    <td style="display: none;">
                        <?php
                        if ($data->category == 'Positive'):
                            echo 'positive';
                        elseif ($data->category == 'Neutral'):
                            echo 'neutral';
                        elseif ($data->category == 'Negative'):
                            echo 'negative';
                        endif;
                        ?>
                    </td>

                </tr>
                <?php
            }
        
        ?>	
    </tbody>
</table>
<?php } else {

    ?>
    <table class="table datatable-basic">
        <thead>
            <tr>
                <th><i class="icon-user"></i>Name</th>
                <th><i class="icon-user"></i>Campaign</th>
                <th><i class="icon-star-full2"></i>Ratings</th>
                <th><i class="icon-paragraph-left3"></i>Feedback</th>
                <th><i class="icon-calendar"></i>Created</th>
                <th><i class="icon-hash"></i>Tags</th>
                <th><i class="icon-folder2"></i>Category</th>
                <th><i class="icon-diff-modified"></i>Status</th>
                <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>

            </tr>
        </thead>

        <tbody>
            <td style="display: none"></td>
            <td style="display: none"></td>
            <td colspan="10">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin: 20px 0px 0;" class="text-center">
                            <h5 class="mb-20 mt40">
                                Looks Like You Don’t Have Any Feedback Yet <img src="<?php echo base_url('assets/images/smiley.png'); ?>"> <br>
                                Lets Create Your First Feedback.
                            </h5>

                            <?php //if ($canWrite): ?>
                                <!-- <button <?php if ($bActiveSubsription == false) { ?> title="No Active Subscription" class="btn bl_cust_btn btn-default dark_btn ml20 pDisplayNoActiveSubscription mb40" <?php } else { ?> id="addOnSiteReview" class="btn bl_cust_btn btn-default dark_btn ml20 mb40" <?php } ?> type="button" ><i class="icon-plus3"></i> Add On Site Review</button> -->
                            <?php //endif; ?>

                        </div>
                    </div>
                </div>
            </td>
            <td style="display: none"></td>
            <td style="display: none"></td>
            <td style="display: none"></td>
            <td style="display: none"></td>
            <td style="display: none"></td>
            <td style="display: none"></td>
        </tbody>
    </table>
    <?php
}?>