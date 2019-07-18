<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content area -->
<?php list($canRead, $canWrite) = fetchPermissions('Reviews'); ?>
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-5">
                <h3><i class="icon-vcard"></i> &nbsp; Reviews</h3>
               <!--  <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Tags Reviews</a></li>
                </ul> -->
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-7 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Reviews &nbsp; &nbsp; <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                        <div class="dropdown-content-heading"> Filter
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-more"></i></a> </li>
                            </ul>
                        </div>
                        <div class="">
                            <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings active">
                                        <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Total Reviews
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                </div>
                                                
                                            </div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Positive
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                </div>
                                                
                                            </div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary">
                                                            Neutral
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Negative
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-content-footer">
                            <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                            &nbsp; &nbsp;
                            <a style="display: inline-block;" href="#">Clear All</a>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->
	
	<!-- Dashboard content -->
	<div class="row">
		<div class="col-lg-12">
			
			<!-- Marketing campaigns -->
			<div class="panel panel-flat">

                <div class="panel-heading">
                    <h6 class="panel-title"> <?php echo count($tReview); ?>  Reviews</h6>
                    <div class="heading-elements">
                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                            <div class="form-control-feedback">
                                <i class="icon-search4"></i>
                            </div>
                        </div>&nbsp; &nbsp;
                        
                        <button type="button" class="btn btn-xs btn-default editDataTagReview"><i class="icon-pencil position-left"></i> Edit</button>

                        <button id="deleteButtonTagReview" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                    </div>
                </div>

				

                <div class="panel-body p0">
                   
					<table class="table datatable-basic datatable-sorting">
						<thead>
							<tr>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th style="width: 40px!important; display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
								<th><i class="icon-user"></i> Name</th>
                                <th><i class="icon-display"></i>Phone</th>
								<th><i class="icon-calendar"></i> Created</th>
								<th><i class="icon-atom"></i> Ratings</th>
								<th><i class="icon-hash"></i> Reviews</th>
								<th class="text-center"><i class="icon-hash"></i> Comments</th>
								<th class="text-center" ><i class="icon-price-tag2"></i> Applied Tags</th>
								<th><i class="fa fa-dot-circle-o"></i> Status</th>
								<th class="text-center"><i class="fa fa-dot-circle-o"></i>Action</th>
							</tr>
						</thead>
						<tbody>

                            <?php
                        if (!empty($tReview)) {
                            $inc = 1;
                            foreach ($tReview as $oReview) {

                                $getComm = getCampaignCommentCount($oReview->id);
                                $reviewTags = getTagsByReviewID($oReview->id);
                                $CI = & get_instance();
                                $CI->load->model("Reviews_model", "mReviews");
                                $reviewLikeCount = $CI->mReviews->countHelpful($oReview->id);
                                
                                ?>
                                <tr id="append-<?php echo $oReview->id; ?>" class="selectedClass">
                                    <td style="display: none;"><?php echo date('m/d/Y', strtotime($oReview->created)); ?></td>
                                    <td style="display: none;"><?php echo $oReview->id; ?></td>
                                    <td style="width: 40px!important; display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk<?php echo $oReview->id; ?>" value="<?php echo $oReview->id; ?>" ><span class="custmo_checkmark"></span></label></td>
                                    <!-- <td><?php //echo $oReview->brand_title;  ?>
                                        <div style="vertical-align: top!important;" class="media-left media-middle">
                                            <a href="#">
                                                <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt=""></a>
                                        </div>


                                        <div class="media-left">
                                            <a href="javascript:void()" class="text-default text-semibold"><?php echo $oReview->firstname; ?> <?php echo $oReview->lastname; ?></a>
                                            <div class="text-muted text-size-small"><?php echo $oReview->email; ?></div>
                                            <div class="text-muted text-size-small"><?php echo $oReview->mobile; ?></div>
                                        </div>
                                    </td>

                                    <td><div class="text-semibold"><?php echo date('F d, Y', strtotime($oReview->created)); ?></div><div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oReview->created)) . ' (' . timeAgo($oReview->created) . ')'; ?></div></td> -->


            <td>
                <div class="media-left media-middle"> <a href="#"><img src="<?php echo base_url(); ?>assets/images/userp.png" class="img-circle img-xs" alt=""></a> </div>


                <div class="media-left">
                    <div class="pt-5"><a href="<?php echo base_url(); ?>admin/subscriber/activities/<?php echo $oReview->id; ?>" target="_blank" class="text-default text-semibold"><span><?php echo $oReview->firstname; ?> <?php echo $oReview->lastname; ?></span> <img class="flags" src="<?php echo base_url(); ?>assets/images/flags/us.png"/></a></div>
                    <div class="text-muted text-size-small"><?php echo $oReview->email; ?></div>

                </div>
            </td>

            <td>
                <div class="media-left">
                    <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo $oReview->mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : $oReview->mobile; ?></a></div>
                    <div class="text-muted text-size-small">Chat</div>
                </div>
            </td>

             <td>
                <div class="media-left">
                    <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oReview->created)); ?></a></div>
                    <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oReview->created)); ?></div>
                </div>

            </td>


                                    <td class="text-center">
                                        <span class="ratingBox" style="display: block">
                                            <?php
                                            $starInt = 1;
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($starInt <= $oReview->ratings) {
                                                    echo '<i class="icon-star-full2 fsize10 txt_green"></i>';
                                                } else {
                                                    echo '<i class="icon-star-full2 fsize10 "></i>';
                                                }

                                                $starInt++;
                                            }
                                            ?>
                                        </span>
                                        <?php
                                        echo '<span class="text-muted reviewnum">(' . $oReview->ratings . ' out of 5 Stars)</span>';
                                        ?>
                                    </td>
                                    <td>
                                        <div class="media-left">
                                            <a target="_blank" href="<?php echo site_url('admin/brandboost/reviewdetails/' . $oReview->id); ?>"><span class="text-default text-semibold"><?php echo setStringLimit($oReview->review_title); ?></span></a>
                                            <div class="text-muted text-size-small">
                                                <?php echo setStringLimit($oReview->comment_text); ?>
                                            </div>
                                        </div> 
                                    </td>

                                    <td class="media_review text-center">
                                        <div class="">
                                            <span class="text-muted text-size-small">
                                                <?php
                                                if ($getComm > 0) {
                                                    echo '<a style="curser:pointer;" onclick="showCommentsPopup(' . $oReview->id . ')">' . $getComm . '</a>';
                                                } else {
                                                    echo '<span style="color:#999999">No Data</span>';
                                                }
                                                ?>
                                            </span>
                                        </div> 
                                    </td>

            <td class="media_review text-center">

                <div class="tdropdown">
                    <button type="button" class="btn btn-xs btn_white_table dropdown-toggle " data-toggle="dropdown"><i class="icon-hash"></i> <?php echo count($reviewTags); ?> Tags &nbsp; <span class="caret"></span></button>
                    <?php if (count($reviewTags) > 0) { ?>
                    <ul class="dropdown-menu dropdown-menu-right width-200">
                        <?php
                            foreach ($reviewTags as $tagsData) {
                               
                                ?><li><a href="#"><i class="icon-screen-full"></i> <?php echo $tagsData->tag_name; ?></a>
                        </li><?php
                            }
                        ?>
                    </ul>
                    <?php } ?>
                </div>
                <?php if($canWrite): ?>
                <a href="javascript:void(0);" class="applyInsightTags btn btn-xs btn_white_table" action_name="review-tag" reviewid="<?php echo $oReview->id; ?>" > + </a>
                <!-- <button class="btn btn-xs btn_white_table"><i class="icon-plus3"></i></button> -->
                <?php endif; ?>

            </td>

            <td style="text-align: center;">
                <button class="btn btn-xs btn_white_table pr10">
                <?php
                if ($oReview->status == 0) {
                    echo '<i class="icon-primitive-dot txt_red"></i> Disapproved';
                } else if ($oReview->status == 2) {
                    echo '<i class="icon-primitive-dot txt_blue"></i> Pending';
                } else {
                    echo '<i class="icon-primitive-dot txt_green"></i> Approved';
                }
                ?>
                </button>
            </td>

                                   
                                   <!--  <td class="text-center">
                                        <ul class="icons-list">
                                <?php
                                if ($inc > 5) {
                                    echo '  <li class="dropup">';
                                } else {
                                    echo '  <li class="dropdown">';
                                }
                                ?>
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right">

                                <?php
                                if ($canWrite) {
                                    if ($oReview->status == 1) {
                                        echo "<li><a review_id='" . $oReview->id . "' change_status = '0' title='Disapproved this review.' class='chg_status red'><i class='icon-file-locked'></i> Disapproved</a></li>";
                                    } else if ($oReview->status == 2) {
                                        echo "<li><a review_id='" . $oReview->id . "' change_status = '1' title='Approved this review.' class='chg_status green'><i class='icon-file-locked'></i> Approved</a></li>";
                                        echo "<li><a review_id='" . $oReview->id . "' change_status = '0' title='Disapproved this review.' class='chg_status red'><i class='icon-file-locked'></i> Disapproved</a></li>";
                                    } else {
                                        echo "<li><a review_id='" . $oReview->id . "' change_status = '1' title='Approved this review.' class='chg_status green'><i class='icon-file-locked'></i> Approved</a></li>";
                                    }
                                    echo '<li><a href="javascript:void(0);" class="applyInsightTags" action_name="review-tag" reviewid="' . $oReview->id . '" ><i class="icon-file-locked"></i> Apply Tags</a></li>';
                                    echo '<li><a href="javascript:void(0);" class="displayReview" action_name="review-tag" tab_type="note" reviewid="' . $oReview->id . '" review_time="' . date("M d, Y h:i A", strtotime($oReview->created)) . '(' . timeAgo($oReview->created) . ')" ><i class="icon-file-locked"></i> Add Notes</a></li>';
                                }
                                echo '<li><a href="javascript:void(0);" class="showReviewPopup" tab_type="info" reviewid="' . $oReview->id . '" ><i class="icon-file-locked"></i> View Reivew Popup</a></li>';

                                echo '<li><a target="_blank" href="' . site_url('admin/brandboost/reviewdetails/' . $oReview->id) . '"><i class="icon-trash"></i> View Reivew</a></li>';
                                if ($canWrite) {
                                    if ($oReview->review_type == 'text') {

                                        echo '<li><a href="javascript:void(0);" class="editReview" reviewid="' . $oReview->id . '"><i class="icon-gear"></i> Edit</a></li>';
                                    } else {
                                        echo '<li><a href="javascript:void(0);" class="editVideoReview" reviewid="' . $oReview->id . '"><i class="icon-gear"></i> Edit</a></li>';
                                    }
                                    echo '<li><a href="javascript:void(0);" class="deleteReview" reviewid="' . $oReview->id . '" ><i class="icon-trash"></i> Delete</a></li>';
                                }
                                ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </td> -->



            <td class="text-center">
                <div class="tdropdown">
               
       <button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
        <ul class="dropdown-menu dropdown-menu-right width-200">

        <?php
        if ($canWrite) {

            if ($oReview->status == 1) {
                echo "<li><a review_id='" . $oReview->id . "' change_status = '0' title='Disapproved this review.' class='chg_status red'><i class='icon-file-locked'></i> Disapproved</a></li>";
            } else if ($oReview->status == 2) {
                echo "<li><a review_id='" . $oReview->id . "' change_status = '1' title='Approved this review.' class='chg_status green'><i class='icon-file-locked'></i> Approved</a></li>";
                echo "<li><a review_id='" . $oReview->id . "' change_status = '0' title='Disapproved this review.' class='chg_status red'><i class='icon-file-locked'></i> Disapproved</a></li>";
            } else {
                echo "<li><a review_id='" . $oReview->id . "' change_status = '1' title='Approved this review.' class='chg_status green'><i class='icon-file-locked'></i> Approved</a></li>";
            }
            echo '<li><a href="javascript:void(0);" class="applyInsightTags" action_name="review-tag" reviewid="' . $oReview->id . '" ><i class="icon-file-locked"></i> Apply Tags</a></li>';
            echo '<li><a href="javascript:void(0);" class="displayReview" action_name="review-tag" tab_type="note" reviewid="' . $oReview->id . '" review_time="' . date("M d, Y h:i A", strtotime($oReview->created)) . '(' . timeAgo($oReview->created) . ')" ><i class="icon-file-locked"></i> Add Notes</a></li>';
        }
        echo '<li><a href="javascript:void(0);" class="showReviewPopup" tab_type="info" reviewid="' . $oReview->id . '" ><i class="icon-file-locked"></i> View Review Popup</a></li>';

        echo '<li><a target="_blank" href="' . site_url('admin/brandboost/reviewdetails/' . $oReview->id ) . '"><i class="icon-file-locked"></i> View Review</a></li>';
        if ($canWrite) {
            if ($oReview->review_type == 'text') {

                echo '<li><a href="javascript:void(0);" class="editReview" reviewid="' . $oReview->id . '"><i class="icon-gear"></i> Edit</a></li>';
            } else {
                echo '<li><a href="javascript:void(0);" class="editVideoReview" reviewid="' . $oReview->id . '"><i class="icon-pencil"></i> Edit</a></li>';
            }
            echo '<li><a href="javascript:void(0);" class="deleteReview" reviewid="' . $oReview->id . '" ><i class="icon-trash"></i> Delete</a></li>';
        }
        ?>
                    </ul>
               
            </div>
        </td>


                                </tr>
                                <?php
                                $inc++;
                            }
                        }
                        ?>
                                      
                        </tbody>
					</table>
				</div>
			</div>
			
			<!-- /marketing campaigns -->
		</div>
	</div>
	
	<!-- /dashboard content -->
</div>
<!-- /content area -->

<!-- =======================edit users popup========================= -->


<div id="editReview" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateReview" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
                </div>
                <div class="modal-body">

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo $this->session->userdata('error_message'); ?>
                        <?php echo validation_errors(); ?></div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Title</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="edit_review_title" id="edit_review_title" placeholder="Title" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Comment</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" placeholder="Leave Review" name="edit_content" id="edit_content" required ></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Rating</label>
                        <div class="col-lg-9">
                            <div class="step_star" style="padding: 5px 0;">

                                <ul id='stars'>

                                    <li class='star' title='Poor' data-value='1'>

                                        <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                    </li>

                                    <li class='star' title='Fair' data-value='2'>

                                        <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                    </li>

                                    <li class='star' title='Good' data-value='3'>

                                        <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                    </li>

                                    <li class='star' title='Excellent' data-value='4'>

                                        <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                    </li>

                                    <li class='star' title='WOW!!!' data-value='5'>

                                        <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                    </li>

                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" value="0" id="ratingValue" name="ratingValue">
                    <input type="hidden" name="edit_reviewid" id="edit_reviewid" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div> 




<!-- =======================edit video popup========================= -->

<div id="editVideoReview" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateVideoReview" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
                </div>
                <div class="modal-body">

                    <div class="alert-danger" style="margin-bottom:10px;"><?php echo $this->session->userdata('error_message'); ?>
                        <?php echo validation_errors(); ?></div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Title</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="edit_review_title" id="edit_video_review_title" placeholder="Title" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Video</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="file" name="video"  />
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-lg-3">Rating</label>
                        <div class="col-lg-9">
                            <div class="step_star" style="padding: 5px 0;">

                                <ul id='stars_video'>

                                    <li class='star' title='Poor' data-value='1'>

                                        <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                    </li>

                                    <li class='star' title='Fair' data-value='2'>

                                        <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                    </li>

                                    <li class='star' title='Good' data-value='3'>

                                        <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                    </li>

                                    <li class='star' title='Excellent' data-value='4'>

                                        <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                    </li>

                                    <li class='star' title='WOW!!!' data-value='5'>

                                        <i class='fa fa-star fa-fw' style="margin: 0;"></i>

                                    </li>

                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" value="0" id="ratingValueVideo" name="ratingValueVideo">
                    <input type="hidden" name="edit_video_reviewid" id="edit_video_reviewid" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<div id="showVideoPopup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Video</h5>
            </div>
            <div class="modal-body">

                <div id="divVideo" class="form-group">
                    <video width="100%" height="auto" controls>
                        <source src="" type="video/mp4">
                    </video>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                <a id="downloadVideo" class="btn btn-primary" href="" download><i class="icon-download"></i>&nbsp;&nbsp; Download Video</a>
            </div>

        </div>
    </div>
</div>

<div id="reviewPopup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body" id="reviewContent"></div>
                    <div class="panel-footer panel-footer-condensed">
                        <div class="heading-elements not-collapsible">
                            <span class="heading-text text-semibold">
                                <i class="icon-history position-left"></i>
                                <span class="reviewTime"></span>
                            </span>

                            <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="previewReviewReply" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body" id="previewReviewReplyContent"></div>
                    <div class="panel-footer panel-footer-condensed">
                        <div class="heading-elements not-collapsible">
                            <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="ReviewTagListModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" name="frmReviewTagListModal" id="frmReviewTagListModal" action="javascript:void();">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Apply Tags</h5>
                        </div>

                        <div class="modal-body" id="tagEntireList">

                        </div>

                        <div class="modal-footer modalFooterBtn">
                            <input type="hidden" name="review_id" id="tag_review_id" />
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Apply Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
<!-- =======================commentpopup popup========================= -->       
<div id="commentpopup" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Add Comments</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div style="border: none!important; padding:0!important;" class="panel-body">
              <ul class="media-list stack-media-on-mobile">
                <li class="media">
                  <div class="media-left"> <a href="#"><img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-sm" alt=""></a> </div>
                  <div class="media-body">
                    <div class="media-heading"> <a href="#" class="text-semibold">William Jennings</a> <span class="media-annotation dotted">Just now</span> <span class="media-annotation text-success-400 dotted">Approved</span> </div>
                    <p>He moonlight difficult engrossed an it sportsmen. Interested has all devonshire difficulty gay assistance joy. Unaffected at ye of compliment alteration to.</p>
                    <ul class="list-inline list-inline-separate text-size-small">
                      <li>114 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                      <li><a id="" href="#reply1">Reply</a></li>
                      <li><a href="#">Edit</a></li>
                    </ul>
                  </div>
                </li>
                <li class="media">
                  <div class="media-left"> <a href="#"><img src="http://brandboost.io/admin_new/assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a> </div>
                  <div class="media-body">
                    <div class="media-heading"> <a href="#" class="text-semibold">Margo Baker</a> <span class="media-annotation dotted">5 minutes ago</span> <span class="text-danger-400 media-annotation dotted">Unapproved</span> </div>
                    <p>Place voice no arise along to. Parlors waiting so against me no. Wishing calling are warrant settled was luckily. Express besides it present if at an opinion visitor.</p>
                    <ul class="list-inline list-inline-separate text-size-small">
                      <li>90 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                      <li><a href="#reply1">Reply</a></li>
                      <li><a href="#">Edit</a></li>
                    </ul>
                  </div>
                </li>
                <li class="media">
                  <div class="media-left"> <a href="#"><img src="http://brandboost.io/admin_new/images/cust2.png" class="img-circle img-sm" alt=""></a> </div>
                  <div class="media-body">
                    <div class="media-heading"> <a href="#" class="text-semibold">James Alexander</a> <span class="media-annotation dotted">7 minutes ago</span> <span class="media-annotation dotted"> <span class="label bg-success addtag text-success-400"> Approve</span> </span> <span class="media-annotation dotted"> <span class="label bg-success addtag text-danger-400"> Disapprove</span> </span> </div>
                    <p>Savings her pleased are several started females met. Short her not among being any. Thing of judge fruit charm views do. Miles mr an forty along as he.</p>
                    <ul class="list-inline list-inline-separate text-size-small">
                      <li>70 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                      <li><a href="#reply1">Reply</a></li>
                      <li><a href="#">Edit</a></li>
                    </ul>
                    <div class="media">
                      <div class="media-left"> <a href="#"><img src="http://brandboost.io/admin_new/images/cust3.png" class="img-circle img-sm" alt=""></a> </div>
                      <div class="media-body">
                        <div class="media-heading"> <a href="#" class="text-semibold">Jack</a> <span class="media-annotation dotted">10 minutes ago</span> <span class="media-annotation dotted"> <span class="label bg-success addtag text-success-400"> Approve</span> </span> <span class="media-annotation dotted"> <span class="label bg-success addtag text-danger-400"> Disapprove</span> </span> </div>
                        <p>She education get middleton day agreement performed preserved unwilling. Do however as pleased offence outward beloved by present. By outward neither he so covered.</p>
                        <ul class="list-inline list-inline-separate text-size-small">
                          <li>67 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="media">
                  <div class="media-left"> <a href="#"><img src="http://brandboost.io/admin_new/images/cust1.png" class="img-circle img-sm" alt=""></a> </div>
                  <div class="media-body">
                    <div class="media-heading"> <a href="#" class="text-semibold">Victoria Johnson</a> <span class="media-annotation dotted">3 hours ago</span> </div>
                    <p>Finished why bringing but sir bachelor unpacked any thoughts. Unpleasing unsatiable particular inquietude did nor sir.</p>
                    <ul class="list-inline list-inline-separate text-size-small">
                      <li>32 <a href="#"><i class="icon-arrow-up22 text-success"></i></a><a href="#"><i class="icon-arrow-down22 text-danger"></i></a></li>
                      <li><a href="#reply1">Reply</a></li>
                      <li><a href="#">Edit</a></li>
                    </ul>
                  </div>
                </li>
              </ul>
              <div class="replybox mt-20"> <a href="#">view all comments</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- newreviewpopup -->
<div id="newreviewpopup" class="modal fade newreviewpopup2">
  <div class="modal-dialog">
    <div class="modal-content" id="reviewPopupBox"> 
     
    </div>
  </div>
</div>        
                
                        
                                
                                        
                                                        

<script>

    function showCommentsPopup(reviewID) {
        $.ajax({
            url: '<?php echo base_url('admin/reviews/getCommentsPopup'); ?>',
            type: "POST",
            data: {review_id: reviewID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.overlaynew').hide();
                    var dataString = data.popupData;
                    $("#commentpopup").html(dataString);
                    $("#commentpopup").modal("show");
                }
            }
        });
    }

    function displayReviewPopup(reviewid, tabtype, reviewTime) {
        //$('.overlaynew').show();
        $.ajax({
            url: "<?php echo base_url('/admin/reviews/displayreview'); ?>",
            type: "POST",
            data: {rid: reviewid},
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    $('.overlaynew').hide();
                    $("#reviewContent").html(response.popup_data);
                    $(".reviewTime").html(reviewTime);
                    $("#reviewPopup").modal("show");
                    if (tabtype == 'note') {
                        $('.tabbable a[href="#note-tab"]').trigger('click');
                    } else {
                        $('.tabbable a[href="#review-tab"]').trigger('click');
                    }
                }
            },
            error: function (response) {
                alertMessage(response.message);
            }
        });
    }

    $(document).ready(function () {

        $(document).on('click', '.editDataTagReview', function () {
            $('.editAction').toggle();
        });

        $('#checkAll').change(function () {

            if (false == $(this).prop("checked")) {

                $(".checkRows").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box').hide();
            } else {

                $(".checkRows").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box').show();
            }

        });

        $(document).on('click', '.checkRows', function () {
            var inc = 0;


            var rowId = $(this).val();

            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
            } else {
                $('#append-' + rowId).addClass('success');
            }

            $('.checkRows:checkbox:checked').each(function (i) {
                inc++;
            });
            if (inc == 0) {
               
                $('.custom_action_box').hide();
            } else {
                $('.custom_action_box').show();
            }

            var numberOfChecked = $('.checkRows:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll').prop('checked', false);
            }

        });

        $(document).on('click', '#deleteButtonTagReview', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to delete this record!",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $('.overlaynew').show();
                        $.ajax({
                            url: '<?php echo base_url('admin/reviews/deleteMultipalReview'); ?>',
                            type: "POST",
                            data: {multiReviewid: val},
                            dataType: "json",
                            success: function (data) {

                                if (data.status == 'success') {

                                    window.location.href = '';
                                } else {
                                    alertMessage('Error: Some thing wrong!');
                                    $('.overlaynew').hide();
                                }
                            }
                        });
                    }
                });
            }

        });

        
        
		$("#frmReviewTagListModal").submit(function () {
            var formdata = $("#frmReviewTagListModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/tags/applyReviewTag'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#ReviewTagListModal").modal("hide");
						window.location.href = '';
                    }
                }
            });
            return false;
        });

        $(document).on("click", ".displayReview", function () {
            var elem = $(this);
            var reviewid = $(this).attr("reviewid");
            var tabtype = $(this).attr('tab_type');
            var reviewTime = $(this).attr('review_time');
            displayReviewPopup(reviewid, tabtype, reviewTime);

        });

        
        
        $(document).on("click", "#saveReviewNotes", function () {
            var formdata = $("#frmSaveNote").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('/admin/reviews/saveReviewNotes'); ?>",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        var reviewid = $("input[name='reviewid']").val();
                        var reviewtime = $("input[name='reviewtime']").val();
                        var tabtype = 'note';
                        displayReviewPopup(reviewid, tabtype, reviewtime);
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        });
        
        
        
        /*
        var sort_type_element = 'DESC';
        var sort_by_element = 'id';*/

       /* $(document).on("click", ".sortingAction", function (event) {

            $('.sortingAction').removeClass('sorting');
            $('.sortingAction').removeClass('sorting_desc');
            $('.sortingAction').removeClass('sorting_asc');
            sort_by_element = $(this).attr('sort_by_element');
            sort_type_element = $(this).attr('sort_type_element');

            load_review_data(1, sort_by_element, sort_type_element);

            var newClass = sort_type_element == 'ASC' ? 'sorting_desc' : 'sorting_asc';
            var newSort = sort_type_element == 'ASC' ? 'DESC' : 'ASC';
            $('.sortingAction').addClass('sorting');
            $(this).removeClass('sorting');
            $(this).addClass(newClass);
            $(this).attr('sort_type_element', newSort);

        });*/

        /*function load_review_data(page, sortby, sort_type)
        {
            $.ajax({
                url: "<?php echo base_url(); ?>ajax_pagination/tag_review_pagination/" + page,
                data: {sortby: sortby, sort_type: sort_type, tag_id: '<?php echo $tag_id; ?>'},
                method: "GET",
                dataType: "json",
                success: function (data)
                {
                    $('#review_table').html(data.review_table);
                    $('#pagination_link').html(data.pagination_link);
                }
            });
        }*/

        /*load_review_data(1, 'id', 'DESC');

        $(document).on("click", ".pagination li a", function (event) {
            event.preventDefault();
            var page = $(this).data("ci-pagination-page");
            load_review_data(page, sort_by_element, sort_type_element);
        });*/

   

        $(document).on('click', '.showVideo', function () {

            var videoUrl = $(this).attr('videoUrl');
            $("#showVideoPopup").modal();
            $('#divVideo video source').attr('src', videoUrl);
            $("#divVideo video")[0].load();
            $('#downloadVideo').attr('href', videoUrl);
        });

        $(document).on('click', '.deleteReview', function () {

            $('.overlaynew').show();
            var conf = confirm("Are you sure? You want to delete this review!");
            if (conf == true) {

                var reviewID = $(this).attr('reviewid');
                $.ajax({
                    url: '<?php echo base_url('admin/reviews/deleteReview'); ?>',
                    type: "POST",
                    data: {reviewid: reviewID},
                    dataType: "json",
                    success: function (data) {

                        if (data.status == 'success') {

                            window.location.href = '';
                        } else {
                            alertMessage('Error: Some thing wrong!');
                            $('.overlaynew').hide();
                        }
                    }
                });
            } else {
                $('.overlaynew').hide();
            }
        });

        $(document).on('click', '.editReview', function () {
            var reviewID = $(this).attr('reviewid');
            $.ajax({
                url: '<?php echo base_url('admin/reviews/getReviewById'); ?>',
                type: "POST",
                data: {reviewid: reviewID},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        var reviewData = data.result[0];

                        $('#edit_content').val(reviewData.comment_text);
                        $('#edit_review_title').val(reviewData.review_title);
                        $('#edit_reviewid').val(reviewData.id);
                        $('#stars li').each(function (index, value) {
                            $('#ratingValue').val(reviewData.ratings);
                            if (reviewData.ratings > index) {
                                $(this).addClass('selected');
                            } else {
                                $(this).removeClass('selected');
                            }
                        });
                        $("#editReview").modal();

                    } else {

                    }
                }
            });
        });

        $(document).on('click', '.editVideoReview', function () {
            var reviewID = $(this).attr('reviewid');
            $.ajax({
                url: '<?php echo base_url('admin/reviews/getReviewById'); ?>',
                type: "POST",
                data: {reviewid: reviewID},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {
                        var reviewData = data.result[0];
                        $('#edit_video_content').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' + reviewData.comment_video);
                        $('#edit_video_reviewid').val(reviewData.id);
                        $('#edit_video_review_title').val(reviewData.review_title);
                        $('#ratingValueVideo').val(reviewData.ratings);
                        $('#stars_video li').each(function (index, value) {

                            if (reviewData.ratings > index) {
                                $(this).addClass('selected');
                            } else {
                                $(this).removeClass('selected');
                            }
                        });
                        $("#editVideoReview").modal();

                    } else {

                    }
                }
            });
        });

        $("#updateReview").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/reviews/update_review'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $("#updateVideoReview").submit(function () {

            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/reviews/update_video_review'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {

                        window.location.href = '';

                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });


        $(document).on('click', '.chg_status', function () {

            $('.overlaynew').show();
            var status = $(this).attr('change_status');
            var review_id = $(this).attr('review_id');

            $.ajax({
                url: '<?php echo base_url('admin/reviews/update_review_status'); ?>',
                type: "POST",
                data: {status: status, review_id: review_id},
                dataType: "json",
                success: function (data) {

                    if (data.status == 'success') {

                        window.location.href = '';
                    } else {

                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });

        var ratingValueVideo = 0;
        $('#stars_video li').on('mouseover', function () {
            var onStar = parseInt($(this).data('value'), 10);
            $(this).parent().children('li.star').each(function (e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function () {
            $(this).parent().children('li.star').each(function (e) {
                $(this).removeClass('hover');
            });
        });

        $('#stars_video li').on('click', function () {
            var onStar = parseInt($(this).data('value'), 10);
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            ratingValueVideo = parseInt($('#stars_video li.selected').last().data('value'), 10);
            $('#ratingValueVideo').val(ratingValueVideo);

        });
		
		$(document).on("click", ".applyInsightTags", function () {
            $('.btn-link').trigger('click');
            var review_id = $(this).attr("reviewid");
            var feedback_id = $(this).attr("feedback_id");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: '<?php echo base_url('admin/tags/listAllTags'); ?>',
                type: "POST",
                data: {review_id: review_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
						var dataString = data.list_tags;
						if(dataString.search('have any tags yet :-') > 0){
							$('.modalFooterBtn').hide();
						}else{
							$('.modalFooterBtn').show();
						}
                        $("#tagEntireList").html(dataString);
                        $("#tag_review_id").val(review_id);
                        $("#tag_feedback_id").val(feedback_id);
                        if (action_name == 'review-tag') {
                            $("#ReviewTagListModal").modal("show");
                        } else if (action_name == 'feedback-tag') {
                            $("#FeedbackTagListModal").modal("show");
                        }
                    }
                }
            });
        });

        $(document).on("click", ".showReviewPopup", function () {
            var reviewid = $(this).attr("reviewid");
            getReviewPopupData(reviewid, '');
        });

        $(document).on("click", "#saveReviewNotesPopup", function () {
            var formdata = $("#frmSaveNote").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('/admin/reviews/saveReviewNotes'); ?>",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        var reviewid = $("input[name='reviewid']").val();
                        var tabtype = 'note';
                        getReviewPopupData(reviewid, tabtype);
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        });

    });

    function getReviewPopupData(reviewId, tabtype) {
        //$("#newreviewpopup").modal();
        $('.overlaynew').show();
        $.ajax({
            url: "<?php echo base_url('/admin/reviews/getReviewPopupData'); ?>",
            type: "POST",
            data: {rid: reviewId},
            dataType: "json",
            success: function (response) {
                if (response.status == "success") {
                    $('.overlaynew').hide();
                    $("#newreviewpopup").modal();
                    $("#reviewPopupBox").html(response.popupData);
                    if (tabtype == 'note') {
                        $('.tabbable a[href="#note-tab"]').trigger('click');
                    } else {
                        $('.tabbable a[href="#review-tab"]').trigger('click');
                    }
                }
            },
            error: function (response) {
                alertMessage(response.message);
            }
        });
    }

</script>

