<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content ">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-5">
                <h3><i class="icon-vcard"></i> &nbsp;My Reviews</h3>
                <!-- <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Reviews</a></li>
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
                    <h6 class="panel-title"> <?php echo count($aReviews); ?> Reviews</h6>
                    <div class="heading-elements">
                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                            <div class="form-control-feedback">
                                <i class="icon-search4"></i>
                            </div>
                        </div>&nbsp; &nbsp;

                        <button type="button" class="btn btn-xs btn-default editDataReview"><i class="icon-pencil position-left"></i> Edit</button>

                        <button id="deleteButtonReviewList" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                    </div>
                </div>


                <div class="panel-body p0">

                    <table class="table datatable-basic datatable-sorting" >
                        <thead>
                            <tr>
                                <th><i class="icon-stack-star"></i> Name</th>
                                <th><i class="icon-calendar"></i> Review Date</th>
                                <th class="text-center "><i class="icon-atom"></i> Review Ratings</th>
                                <th><i class="icon-hash"></i> Review</th>
                                <th class="text-center "><i class="fa fa-dot-circle-o"></i> Status</th>
                                <th class="nosort"><i class="fa fa-dot-circle-o"></i> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($oMyReviews)): ?>
                                <?php
                                foreach ($oMyReviews as $oReview):

                                    $brandboostTitle = $oReview->brand_title;
                                    $brandboostTitle = (!empty($brandboostTitle)) ? $brandboostTitle : 'NA';

                                    if (strlen($brandboostTitle) > 30) {
                                        $brandboostTitle = substr($brandboostTitle, 0, 29) . '...';
                                    }
                                    //pre($oReview);
                                    ?>
                                    <tr id="append-<?php echo $oReview->reviewid; ?>" class="selectedClass">

                                        <td>
                                            <div class="media-left media-middle"> <a href="javascript:void(0);"><img src="<?php echo base_url("assets/images/smiley_green.png"); ?>" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="javascript:void(0);" class="text-default text-semibold"><?php echo $brandboostTitle; ?></a>
                                                </div>
                                                <div class="text-muted text-size-small">Public</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($oReview->review_created)); ?></a></div>
                                                <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($oReview->review_created)); ?></div>
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
                                                        echo '<i class="icon-star-full2 fsize10 "></i> ';
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
                                                <a target="_blank" href="<?php echo site_url('admin/brandboost/reviewdetails/' . $oReview->reviewid); ?>"><span class="text-default text-semibold"><?php echo setStringLimit($oReview->review_title); ?></span></a>
                                                <div class="text-muted text-size-small">
                                                    <?php echo setStringLimit($oReview->comment_text); ?>
                                                </div>
                                            </div> 
                                        </td>

                                        <td style="text-align: center;">
                                            <button class="btn btn-xs btn_white_table pr10">
                                                <?php
                                                if ($oReview->rstatus == 0) {
                                                    echo '<i class="icon-primitive-dot txt_red"></i> Disapproved';
                                                } else if ($oReview->rstatus == 2) {
                                                    echo '<i class="icon-primitive-dot txt_blue"></i> Pending';
                                                } else {
                                                    echo '<i class="icon-primitive-dot txt_green"></i> Approved';
                                                }
                                                ?>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <div class="tdropdown">
                                                <ul class="icons-list">
                                                    <?php
                                                    if ($inc > 5) {
                                                        echo '  <li class="dropup">';
                                                    } else {
                                                        echo '  <li class="dropdown">';
                                                    }
                                                    ?>


                                                    <button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right width-200">

                                                        <?php
                                                        if ($oReview->review_type == 'text') {

                                                            echo '<li><a href="javascript:void(0);" class="editReview" reviewid="' . $oReview->reviewid . '"><i class="icon-gear"></i> Edit</a></li>';
                                                        } else {
                                                            echo '<li><a href="javascript:void(0);" class="editVideoReview" reviewid="' . $oReview->reviewid . '"><i class="icon-pencil"></i> Edit</a></li>';
                                                        }
                                                        echo '<li><a href="javascript:void(0);" class="deleteReview" reviewid="' . $oReview->reviewid . '" ><i class="icon-trash"></i> Delete</a></li>';
                                                        ?>
                                                    </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /dashboard content -->
</div>
<!-- =======================edit users popup========================= -->
<div id="editReview" class="modal modalpopup fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" id="updateReview" action="javascript:void();">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Review</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input_box">
                                <label>Title</label>
                                <input type="text" name="edit_review_title" id="edit_review_title" placeholder="Title" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input_box" style="height:200px;">
                                <label>Comment</label>
                                <textarea style="height:150px; width:100%; padding:10px; margin-top:10px;" placeholder="Leave Review" name="edit_content" id="edit_content" required ></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input_box" style="height:80px;">
                                <label>Rating</label>
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

                                <input type="hidden" value="0" id="ratingValue" name="ratingValue">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="edit_reviewid" id="edit_reviewid" value="">
                            <input type="submit" class="btn blue" value="Update & Close" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- =======================edit video popup========================= -->
<div id="editVideoReview" class="modal modalpopup fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" id="updateVideoReview" action="javascript:void();">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Review</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input_box">
                                <label>Title</label>
                                <input type="text" name="edit_review_title" id="edit_review_title" placeholder="Title" required>
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
                            <div class="input_box" >
                                <label>Video</label>
                                <input type="file" name="video"  />

                            </div> 
                        </div> -->
                        <div class="col-md-12">
                            <div class="input_box" style="height:80px;">
                                <label>Rating</label>
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
                            <input type="hidden" value="0" id="ratingValueVideo" name="ratingValueVideo">
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="edit_video_reviewid" id="edit_video_reviewid" value="">
                            <input type="submit" class="btn blue" value="Update & Close" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {

        $(document).on('click', '.deleteReview', function () {

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

                            alert('Your review has been delete successfully.');
                            setTimeout(function () {
                                window.location.href = window.location.href;
                            }, 1000);

                        } else {

                        }
                    }
                });
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
                        $('#edit_review_title').val(reviewData.review_title);
                        $('#edit_video_reviewid').val(reviewData.id);
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

                    console.log(data);
                    if (data.status == 'success') {
                        alert('Review has been update successfully.');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 1000);
                    } else {
                        alert('Error: Some thing wrong!');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 1000);
                    }
                }
            });
        });


        $("#updateVideoReview").submit(function () {

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
                        alert('Review has been update successfully.');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 1000);
                    } else {
                        alert('Error: Some thing wrong!');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 1000);
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


    });
</script>

