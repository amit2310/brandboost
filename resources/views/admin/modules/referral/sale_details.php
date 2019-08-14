<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pre($oSale);
//die;
?>
<!-- Content area -->
<script type="text/javascript" src="<?php echo site_url('assets/js/viewbox.min.js'); ?>"></script>
<style>
    body{font-family: "Gotham SSm A", "Gotham SSm B"!important; background: #f4f4f4!important;/*font-family: 'Montserrat', sans-serif!important;*/}
    .cust_details{ margin-bottom: 0px; border-radius: 0px; padding: 20px!important; background: #ffffff!important;  border-radius: 6px; border: 1px solid #f5f4f5; box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055);}
    .cust_details p{font-size: 13px; color: #4d4b4b}
    .cust_details p strong{font-size: 12px; color: #484545; font-weight: 500;}
    .cust_details p strong .fa{color: #484545}
    .cust_details .inner p strong{width: 95px; float: left;}
    .cust_details .inner p span{font-family: "Whitney SSm A", "Whitney SSm B";}
    .cust_details h3{margin: 0 0 20px; font-size: 14px; font-weight: 500; color: #333333;}
    .cust_details h3:after{height: 1px; left: 28px; top: 28px; width:calc(100% - 35px); position: absolute; background: #eee; content: '';}
    .cust_details p .fa{color: #e3dede; font-size: 14px; margin: 0 1px;}
    .cust_details p .fa.yellow{color: #ffd000;}
    .cust_details .btn.bg-blue-600{width: 100%!important; max-width: 128px; background: #5e80c0 }
    .cust_details hr{border-color: #ddd!important;}

    .imgvid h3{margin: 0 0 20px; font-size: 14px; font-weight: 300; color: #868587;}
    .imgvid h3:after{height: 1px; left: 28px; top: 28px; width:calc(100% - 35px); position: absolute; background: #eee; content: '';}

    hr{border-color: #f5f4f5}

    .reviewbox{background: #fff; border: 1px solid #f5f4f5; padding: 0px; margin-bottom: 0px; border-radius: 0px; cursor: pointer; border-radius: 5px;	-webkit-box-shadow: 0 0px 20px rgba(204, 204, 204, 0.2);	box-shadow: 0 0px 20px rgba(204, 204, 204, 0.2);}
    .reviewbox p{font-size: 15px; color: #9b9898}
    .reviewbox p strong{font-size: 13px; color: #484545; font-weight: 500;}
    .reviewbox p .fa{color: #e3dede; font-size: 14px; margin: 0 1px;}
    .reviewbox p .fa.yellow{color: #ffd000;}
    .reviewbox p .fa.fa-user, .reviewbox p .fa.fa-info-circle, .reviewbox p .fa.fa-mail-reply{color: #333;}
    .reviewstars{border-left: 1px solid #eee; padding-left: 20px}
    .reviewstars p{margin: 0 0 2px;}

    .reviewbox_inner{background: #f9f9f9; border: 1px solid #f5f4f5; margin-top: 2px; padding: 20px; margin-bottom: 0px; border-radius: 0px; display: none; border-radius:0 0 5px 5px;}
    .reviewbox_inner p{font-size: 13px; color: #9b9898}
    .reviewbox_inner p strong{font-size: 13px; color: #484545; font-weight: 500;}
    .reviewbox_inner .inner p strong{width: 150px; float: left;}
    .reviewbox_inner h3{margin: 0 0 20px; font-size: 18px; font-weight: 500; color: #333;}
    .reviewbox_inner p .fa{color: #e3dede; font-size: 14px; margin: 0 1px;}
    .reviewbox_inner p .fa.yellow{color: #ffd000;}
    .dotbox{padding: 10px; border: 1px dashed #ddd;}

    .bg-blue-600 {	background-color: #5e80c0;	border-color: #5e80c0;	color: #fff; font-weight: 500; box-shadow: 0 1px 3px 0 rgba(0,0,0,.12); font-family: "Whitney SSm A", "Whitney SSm B"; font-size: 14px;}
    .bg-blue-600:hover {	background-color: #6488cc;	border-color: #6488cc;	color: #fff;}	
    .bg-blue-600.blank{background: #fff!important; border-color: #4261a2; color: #4261a2!important}



    .panel-heading{border-bottom: 1px solid #f5f4f5!important}

    .panel-flat > .panel-heading + .panel-body {	padding-top: 20px;}
    .panel-heading.services{background: #6598c7; color: #fff; padding: 10px 20px;}
    .panel-heading.services p, .panel-heading.services p strong{color: #fff; margin: 0; font-size: 13px;}
    .panel-heading.services p .fa {	font-size: 13px;	margin: 0 3px;}

    .pbodynor .blog-preview{ position: relative; background: #fff; margin: 0!important; padding:0 40px 0px 0!important;}
    .blog-preview-inner{position: absolute; top: 20px; right: 20px; z-index: 99; width: 290px;}
    .blog-preview-inner .btn.bg-blue-600{width: 100%!important; max-width: 128px; margin:0 0 0 15px;}

    .blog-preview p{ font-size: 14px;	font-weight: 400;	color: #333333;	line-height: 1.5; font-family: "Whitney SSm A", "Whitney SSm B"; }
    .blog-preview .fa{color: #f8e81d; font-size: 18px; margin: 0 2px;}
    .blog-preview .fa.yellow{color: #f8e81d;}
    .blog-horizontal h3.revcom{font-size: 18px; color: #000; margin: 30px 0;}
    .content-group {padding-right: 0;}
    .blog-horizontal .blog-title > a {	color: #1e1f1f; font-size: 20px; font-weight: 600; font-family: "Whitney SSm A", "Whitney SSm B"; }
    .blog-horizontal h4{font-weight: 400; font-size: 12px; font-family: "Gotham SSm A", "Gotham SSm B"!important; color: #1e88e5; margin-top: 5px!important;}
    .blog-horizontal h4 small{font-size: 12px!important}
    p.filter{float: left; margin: 7px;}
    .panel-body + .panel-body, .panel-body + .table, .panel-body + .table-responsive, .panel-body.has-top-border {	border-top: 1px solid #f5f4f5;}
    .pbodynor{padding: 0!important; background: #fff; border: none!important; box-shadow: none!important;}
    .mainpanel{margin-left: -20px!important; margin-right: -20px!important; margin-bottom: 0!important; border: none!important; box-shadow: none!important;}
    .panel.blog-horizontal{border: none!important; box-shadow: none!important;}
    .list-inline > li.number{font-size: 13px; font-weight: 500;}

    .label.bg-success {	padding: 2px 8px 2px 8px !important; font-size: 9px!important;	margin: 0 5px;	color: #fff;	background: #4baf4f !important;	border-color: #4baf4f !important; letter-spacing: 1px; cursor: pointer;   }
    .label.bg-success:hover{background: #3f9b42!important;  }

    .label.bg-success.animated {-webkit-transition: width 1s; /* For Safari 3.1 to 6.0 */    transition: width 1s; width: 95px; margin-bottom: 0px; }
    .label.bg-success.animated:hover{background: #3f9b42!important; width: 115px;  }

    .label.bg-success i {	display: none;	font-size: 9px;	color: #fff;	font-weight: 300 !important;	font-style: normal;	text-transform: none; }
    .label.bg-success:hover i{display: inline-block; }


    textarea.form-control{border: 1px dotted #c3c3c3; }
    textarea.form-control:focus{border: 1px dotted #c3c3c3; box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055);}

    .label.bg-success.addtag{background: #f1f1f1!important; border-color: #ebebeb!important; color: #000; cursor: pointer;}	
    .label.bg-success.addtag:hover{background: #e3e3e3!important; border-color: #e3e3e3!important;}
    .media-body p {	color: #333; font-family: "Whitney SSm A", "Whitney SSm B";}
    .list-inline > li a, a.text-semibold{color: #1e88e5;}
    .list-inline > li{position: relative; font-family: "Whitney SSm A", "Whitney SSm B"; color: #4d4b4b!important; }
    .commentsnu{font-size: 12px; font-weight: 300; }
    .thumbnail2 img{border-radius: 4px; max-width: 100%; width: 100%; margin-bottom: 20px; border: 1px dotted #eeeeee; box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055);}
    .thumbnail2 img.big{height: 210px!important; width: 100%;}
    .thumbnail2 img.small{height: 62px!important; width: 100%;}

    .media-list .media{ letter-spacing: 0.4px}
    h5.panel-title, .h5.panel-title {	font-size: 15px; font-weight: 400; color: #4d4b4b	}
    .replybox{ text-align: center;}
    .replybox a{display: block; padding: 13px; background: #f3f3f3; border-radius: 5px; }
    .replybox a:hover{background: #f1f1f1}

    .videobox{border-radius: 0px; border-radius: 4px; box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055);}
    p.npsnotes strong{width: auto!important; float: none!important; line-height: 30px;}
    p.npsnotes em{font-size: 11px; font-style: normal;}



    .viddetails p{font-family: "Whitney SSm A", "Whitney SSm B";}
    .viddetails p span{float: left; width: 125px; font-size: 12px;	color: #484545;	font-weight: 500; font-family: "Gotham SSm A", "Gotham SSm B"!important;}


    .list-inline > li.stars{position: relative; cursor: pointer;}
    .ratingdetails{position: absolute; width: 300px; border: 1px solid #f5f4f5; min-height: 200px; border-radius: 5px; top: 23px; left: -78px; z-index: 9999; background: #fff; padding: 15px; box-shadow: 0 1px 2px 0 rgba(0,0,0,.02),0 6px 18px 0 rgba(0,0,0,.055)!important;  
                   transition:opacity 0.5s linear; opacity: 0; z-index: -9999;}
    .list-inline > li.stars:hover .ratingdetails{ display: block; opacity: 1; z-index: 9999}

    .ratingdetails p{margin: 0}
    .ratingdetails p strong {
        font-size: 14px;
        color: #333;
        font-weight: 400;
    }

    .ratingdetails:after, .ratingdetails:before {
        bottom: 100%;
        left: 50%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
    }
    .ratingdetails:after {
        border-color: rgba(255, 255, 255, 0);
        border-bottom-color: #ffffff;
        border-width: 6px;
        margin-left: -6px;
    }
    .ratingdetails:before {
        border-color: rgba(204, 204, 204, 0);
        border-bottom-color: #cccccc;
        border-width: 7px;
        margin-left: -7px;
    }

    .ratingdetails .progress{height: 15px; margin-top: 3px;}
    .ratingdetails .progress-bar{background: #f2f2f2; width: 100%; height: 15px; border: 1px solid #e2e2e2;}
    .ratingdetails .progress-bar-warning{background: #ffbd00!important; border: 1px solid #e6b555!important;}
    .ratingdetails .pl0{padding-left: 0!important;}
    .ratingdetails .pr0{padding-right: 0!important;}

    .modal p strong{font-size: 12px; color: #484545; font-weight: 500;}
    .modal .label.bg-success{padding: 2px 8px!important; font-size: 7px; font-weight: 500;}
    .modal .list-inline > li{padding-right: 7px!important;}
    .modal .list-inline > li:before{right: 1px !important;}


    .ratingstar{text-align: center;}
    .ratingstar{text-align: center;}

    @media only screen and (max-width:1600px){
        .hidebbb{display: none!important;}
    }				


    .nav-tabs.nav-tabs-bottom > li > a:after {	height: 1px!important;}
    h6.content-group, h6.panel-title, .h6.panel-title{ color: #4d4b4b;}
    .media-heading .media-annotation {	margin-left: 4px;}
    .media-annotation.dotted:not(.pull-right):before {	margin-right: 4px;}
    .replyCommentBox{margin:10px 0 10px 50px; padding:10px; clear:both;}

</style>

<style>
    .viewbox-container{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,.5);
        z-index: 99999;
    }
    .viewbox-body{
        position: absolute;
        top: 50%;
        left: 50%;
        background: #fff;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        overflow: auto;
    }
    .viewbox-header{
        margin: 10px;
    }
    .viewbox-content{
        margin: 10px;
        width: 300px;
        height: 300px;
    }
    .viewbox-footer{
        margin: 10px;
    }
    .viewbox-content .viewbox-image{
        width: 100%;
        height: 100%;
    }

    /* buttons */
    .viewbox-button-default{
        cursor: pointer;
        height: 64px;
        width: 64px;
    }
    .viewbox-button-default > svg{
        width: 100%;
        height: 100%;
        background: inherit;
        fill: inherit;
        pointer-events: none;
        transform: translateX(0px);
    }
    .viewbox-button-default{
        fill: #999;
    }
    .viewbox-button-default:hover{
        fill: #fff;
    }

    .viewbox-button-close{
        position:absolute;
        top:10px;
        right: 10px;
        z-index:9;
    }
    .viewbox-button-next,
    .viewbox-button-prev{
        position:absolute;
        top: 50%;
        height: 128px;
        width: 128px;
        margin: -64px 0 0;
        z-index:9;
    }
    .viewbox-button-next{
        right: 10px;
    }
    .viewbox-button-prev{
        left: 10px;
    }

    /* loader */
    .viewbox-container .loader{
        widows: 100%;
        position: absolute;
        left: 50%;
        top: 50%;
        margin:-25px 0 0 -25px;
    }
    .viewbox-container .loader *{
        margin: 0;
        padding: 0;
    }
    .viewbox-container .loader .spinner{
        width: 50px;
        height: 50px;
        position: relative;
        margin: 0 auto;
    }
    .viewbox-container .loader .double-bounce1,
    .viewbox-container .loader .double-bounce2{
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #999;
        opacity: 0.6;
        position: absolute;
        top: 0;
        left: 0;
        -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
        animation: sk-bounce 2.0s infinite ease-in-out;
    }

    .media_review .img-cust{width: 64px!important; height: 64px!important}
    .media_review .media-heading{margin-bottom: 20px;}
    .media_review .media-heading a.text-semibold{ color: #231f20!important; font-size: 14px; font-weight: 400;}
    .media_review .media-heading a.text-semibold strong{  font-weight: 500;}
    .media_review .mediastar .fa{font-size: 17px; margin: 0 2px; color: #fc9951;}
    .media_review .label.bg-success {padding: 1px 5px 2px !important;	margin: 0 5px; color: #1d2129; background: #fadeb8!important; border-color: #f3d1a2!important; width:auto; min-width:60px;}
    .media_review p{font-size: 14px!important; color: #231f20; margin-bottom: 20px; font-size: 14px; font-weight: 400; line-height: 24px;}
    .media_review a.readmore{ color: #6598c7; font-weight: 300; font-size: 14px; text-decoration:underline; margin-bottom: 15px; display: inline-block;}
    .media_review span.date{ float: right; font-weight: 300; font-size: 14px; color: #777274;}
    .media_review .media {	margin-top: 25px;	border-bottom: 1px solid #f5f4f5;	padding-bottom: 25px;}
    .media_review .media:first-child {	margin-top: 0!important;}
    .media_review .media:last-child{border: none!important}
    .label.bg-success.addtag {	background: #f1f1f1 !important;	border-color: #ebebeb !important;	color: #000;	cursor: pointer; font-size: 9px;}
    .label.bg-success.addtag:hover{background: #e3e3e3!important; border-color: #e3e3e3!important;}
    .viewbox-container .loader .double-bounce2 {
        -webkit-animation-delay: -1.0s;
        animation-delay: -1.0s;
    }
    @-webkit-keyframes sk-bounce{
        0%, 100% { -webkit-transform: scale(0.0) }
        50% { -webkit-transform: scale(1.0) }
    }

    @keyframes sk-bounce{
        0%, 100% { 
            transform: scale(0.0);
            -webkit-transform: scale(0.0);
        } 50% { 
            transform: scale(1.0);
            -webkit-transform: scale(1.0);
        }
    }

</style>	

<div class="content" style="margin: 0 20px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-flat mainpanel">
                <div class="panel-body">
                    <div class="blog-horizontal blog-horizontal-3">
                        <div class="pbodynor">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs nav-tabs-bottom">
                                            <li class="active"><a href="#imagetab" data-toggle="tab"><i class="icon-image2 position-left"></i> Images </a></li>
                                            <li><a href="#videotab" data-toggle="tab"><i class="icon-video-camera2 position-left"></i> Video </a></li>
                                        </ul>
                                        <div class="tab-content"> 
                                            <!--########################TAB 1 ##########################-->
                                            <div class="tab-pane active" id="imagetab">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <?php
                                                            //pre($reviewID);
                                                            //pre($reviewData);
                                                            $mediaArray = unserialize($reviewData->media_url);
                                                            if (!empty($mediaArray)) {
                                                                foreach ($mediaArray as $key => $data) :
                                                                    if ($key == 0) {
                                                                        ?>
                                                                        <div class="col-xs-12 col-md-12"> <a href="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $data['media_url']; ?>" class="thumbnail2"> <img class="big" src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $data['media_url']; ?>" alt=""> </a> </div>
                                                                    <?php } ?>
                                                                    <div class="col-xs-6 col-md-4"> <a href="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $data['media_url']; ?>" class="thumbnail2"> <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/<?php echo $data['media_url']; ?>" alt="" class=" small"> </a> </div>
                                                                <?php
                                                                endforeach;
                                                            } else {
                                                                ?>
                                                                <div class="col-xs-12 col-md-12"> <a href="<?php echo site_url('assets/images/No_Image_Available.png'); ?>" class="thumbnail2"> <img class="mb0 big" src="<?php echo site_url('assets/images/No_Image_Available.png'); ?>" alt=""> </a> </div>
<?php } ?>															
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--########################TAB 2 ##########################-->
                                            <div class="tab-pane" id="videotab">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="embed-responsive embed-responsive-16by9 mb-20">
                                                            <iframe class="embed-responsive-item videobox" src="https://www.youtube.com/embed/lVKTP_rr5DM"></iframe>
                                                        </div>

                                                        <div class="viddetails">
                                                            <p><span>File Name : </span>ReviewVideo.mp4</p>
                                                            <p><span>File Format :</span> MP4</p>
                                                            <p><span>File Size : </span>128 MB</p>
                                                            <p><span>Uploaded :</span> May 26th, 2018 at 2:10 AM</p>
                                                            <p><span>Download Video:</span> <a style="text-decoration: underline;" href="#">Download Video</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--===========Center Sale Details===========-->
                                <div class="col-lg-6 mt-5">
                                    <!--=====Sale Details=======-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="blog-preview">
                                                <h5 class="panel-title">Referral Sale For <strong>"<?php echo $oSale->title; ?>"</strong> <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                                                <h5 class="blog-title mb0 text-semibold"> <?php echo $oSale->title; ?> </h5>
                                                <h4>by <?php echo $oSale->firstname; ?> <?php echo $oSale->lastname; ?> &nbsp; &nbsp; <small class="text-success-400"><i class="fa text-success-400 fa-check"></i> Verified Purchase</small></h4>
                                                <ul class="list-inline list-inline-separate mb-15">
                                                    <li>
                                                        <?php foreach ($oTags as $tagData) { ?>
                                                            <span class="label bg-success animated"><?php echo $tagData->tag_name; ?> <i class="removetxt" tag_id="<?php echo $tagData->id; ?>" sale_id="<?php echo $tagData->referral_response_id; ?>">&nbsp; (x)</i></span> 
<?php } ?>
                                                        <span class="label bg-success addtag applyInsightTags" action_name="referral-tag" saleid="<?php echo $oSale->saleID; ?>">+ Add Tag</span>
                                                    </li>

                                                </ul>
                                                <p><strong>Store Name: </strong><?php echo $oSale->store_name; ?></p>
                                                <p><strong>Store URL: </strong><?php echo $oSale->store_url; ?></p>
                                                <p><strong>Referral Link: </strong><?php echo $refLink = site_url() . 'ref/t/' . $oSale->refkey; ?></p>
                                                <p><strong>Referred By: </strong><?php echo $oSale->aff_firstname . ' ' . $oSale->aff_lastname; ?></p>
                                                <p><strong>Invoice ID: </strong><?php echo $oSale->invoice_id;?></p>
                                                <p><strong>Sale Amount: </strong><?php echo number_format($oSale->amount, 2); ?></p>
                                                <p><strong>Currency: </strong><?php echo $oSale->currency;?></p>

                                                <hr>
                                            </div>
                                        </div>
                                    </div>


                                </div> 
                                <!--===========RIGHT Info===========-->
                                <div class="col-lg-3">
                                    <div class="cust_details mb30">
                                        <div class="row">

                                            <div class="col-md-12 inner">
                                                <h3><i class="fa fa-info-circle"></i>&nbsp; Customer Information</h3>
                                                <p><strong><i class="fa fa-angle-double-right"></i> &nbsp; Ref: </strong> <span><?php echo $oSale->aff_firstname . ' ' . $oSale->aff_lastname; ?></span></p>
                                                <p><strong><i class="fa fa-angle-double-right"></i> &nbsp; Name: </strong> <span><?php echo $oSale->firstname; ?> <?php echo $oSale->lastname; ?></span></p>
                                                <p><strong><i class="fa fa-angle-double-right"></i> &nbsp; Email: </strong> <span><?php echo $oSale->email; ?></span></p>
                                                <p><strong><i class="fa fa-angle-double-right"></i> &nbsp; Mobile: </strong> <span><?php echo $oSale->mobile == '' ? 'N/A' : $oSale->mobile; ?></span></p>
                                            </div>

                                            <div class="col-md-12 inner mt-15">
                                                <h3><i class="fa fa-tags"></i>&nbsp; Referral Notes</h3>
                                            </div>
                                            <div class="col-md-12 inner mb-15">
                                                <?php
                                                foreach ($oNotes as $key => $noteData) {
                                                    if ($key < 3) {
                                                        ?>
                                                        <p class="npsnotes"><strong><i class="fa fa-angle-double-right"></i> &nbsp; <?php echo $noteData->notes; ?></strong><br> <em>By <?php echo $noteData->firstname; ?> <?php echo $noteData->lastname; ?><br>On <?php echo date('F d, Y h:i A', strtotime($noteData->created)); ?> (<?php echo timeAgo($noteData->created); ?>)</em></p>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>

                                            <div class="col-md-6 text-center inner"><button data-toggle="modal" data-target="#addnotes" type="button" class="btn bg-blue-600"> Add Notes  </button></div>
                                            <div class="col-md-6 text-center inner"><button data-toggle="modal" data-target="#addnotes" type="button" class="btn bg-blue-600 blank"> View <span class="hidebbb">All</span> Notes  </button></div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="editNoteSection" class="modal fade" style="z-index:99999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal" id="updateNote" action="javascript:void();">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Note</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-lg-3">Note</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  placeholder="Note" name="edit_note_content" id="edit_note_content" required ></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="edit_noteid" id="edit_noteid" value="">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="addnotes" class="modal fade in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Referral Notes</h5>
            </div>
            <div class="modal-body">
                <div class="row">
<?php foreach ($oNotes as $key => $noteData) { ?>
                        <div class="col-md-7 inner">
                            <p class="npsnotes"><strong><i class="fa fa-angle-double-right"></i> &nbsp; <?php echo $noteData->notes; ?></strong><br> <em>By <?php echo $noteData->firstname; ?> <?php echo $noteData->lastname; ?><br>On <?php echo date('F d, Y h:i A', strtotime($noteData->created)); ?> (<?php echo timeAgo($noteData->created); ?>)</em></p>
                        </div>
                        <div class="col-md-5 text-right">
                            <ul class="list-inline list-inline-separate text-size-small text-right mt-5">
                                <li><a href="javascript:void(0)" class="editNote" noteid="<?php echo $noteData->id; ?>"> <span class="label bg-success addtag text-success-400"> Modify</span></a> </li>
                                <li><a href="javascript:void(0)" class="deleteNote" noteid="<?php echo $noteData->id; ?>"> <span class="label bg-success addtag text-danger-400"> Delete</span></a> </li>
                            </ul>
                        </div>
<?php } ?>
                    <form method="post" class="form-horizontal" id="frmSaveNote" action="javascript:void();">
                        <div class="col-md-12 mb-15">
                            <textarea class="form-control" name="notes" style="padding: 20px; height: 75px;" placeholder="Add Note"></textarea>
                        </div>
                        <div class="col-md-12 text-right ">
                            <input type="hidden" name="saleid" id="saleid" value="<?php echo $oSale->saleID; ?>">
                            <input type="hidden" name="uid" id="uid" value="<?php echo $oSale->user_id; ?>">
                            <input type="hidden" name="referralid" id="referralid" value="<?php echo $oSale->id; ?>">
                            <button data-toggle="modal" data-target="#addnotes" type="button" id="saveReferralNotes" class="btn bg-blue-600"> Add Notes &nbsp; <i class="fa fa-angle-double-right"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="ReferralTagListModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmReferralTagListModal" id="frmReferralTagListModal" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
                </div>
                <div class="modal-body" id="tagEntireList"></div>
                <div class="modal-footer modalFooterBtn">
                    <input type="hidden" name="sale_id" id="tag_sale_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $(document).on("click", ".removetxt", function () {
            var saleID = $(this).attr("sale_id");
            var tagID = $(this).attr("tag_id");
            var elem = $(this);
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/removeReferralTag'); ?>',
                type: "POST",
                data: {saleID: saleID, tag_id: tagID},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $(elem).parent().remove();
                    }
                }
            });
        });


        $(document).on('click', '.editNote', function () {
            var noteId = $(this).attr('noteid');
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/getReferralNoteById'); ?>',
                type: "POST",
                data: {noteid: noteId},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var noteData = data.result[0];
                        $('#edit_note_content').val(noteData.notes);
                        $('#edit_noteid').val(noteData.id);
                        $("#editNoteSection").modal();
                    } else {

                    }
                }
            });
        });

        $(document).on('click', '.deleteNote', function () {
            $('.overlaynew').show();
            var conf = confirm("Are you sure? You want to delete this note!");
            if (conf == true) {
                var noteId = $(this).attr('noteid');
                $.ajax({
                    url: '<?php echo base_url('admin/modules/referral/deleteReferralNote'); ?>',
                    type: "POST",
                    data: {noteid: noteId},
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

        $("#updateNote").submit(function () {
            $('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/updatNotes'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#editNoteSection").modal('hide');
                        window.location.href = '';
                    } else {
                        alertMessage('Error: Some thing wrong!');
                        $('.overlaynew').hide();
                    }
                }
            });
        });



        $(document).on("click", ".applyInsightTags", function () {
            var sale_id = $(this).attr("saleid");
            var action_name = $(this).attr("action_name");
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/listAllTags'); ?>',
                type: "POST",
                data: {sale_id: sale_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.overlaynew').hide();
                        var dataString = data.list_tags;
                        if (dataString.search('have any tags yet :-') > 0) {
                            $('.modalFooterBtn').hide();
                        } else {
                            $('.modalFooterBtn').show();
                        }
                        $("#tagEntireList").html(dataString);
                        $("#tag_sale_id").val(sale_id);
                        if (action_name == 'referral-tag') {
                            $("#ReferralTagListModal").modal("show");
                        }
                    }
                }
            });
        });

        $("#frmReferralTagListModal").submit(function () {
            var formdata = $("#frmReferralTagListModal").serialize();
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/applySaleTag'); ?>',
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $("#ReferralTagListModal").modal("hide");
                        window.location.href = window.location.href;
                    }
                }
            });
            return false;
        });

        $(document).on("click", "#saveReferralNotes", function () {
            var formdata = $("#frmSaveNote").serialize();
            $('.overlaynew').show();
            $.ajax({
                url: "<?php echo base_url('/admin/modules/referral/saveReferralNotes'); ?>",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        window.location.href = window.location.href;
                    }
                },
                error: function (response) {
                    alertMessage(response.message);
                }
            });
        });
    });
</script>	