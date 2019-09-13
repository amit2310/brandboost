<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BrandBoost::Add Feedback</title>
    <link rel="icon" href="assets/images/icon.ico" sizes="16x16" type="image/ico">

    <!-- Global stylesheets -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ base_url("assets/css/icons/icomoon/styles.css") }}" rel="stylesheet" type="text/css">
    <link href="{{ base_url("assets/css/bootstrap.css") }}" rel="stylesheet" type="text/css">
    <link href="{{ base_url("assets/css/core.css") }}" rel="stylesheet" type="text/css">
    <link href="{{ base_url("assets/css/components.css") }}" rel="stylesheet" type="text/css">
    <link href="{{ base_url("assets/css/colors.css") }}" rel="stylesheet" type="text/css">
    <link href="{{ base_url("assets/css/theme1.css") }}" rel="stylesheet" type="text/css">
    <link href="{{ base_url("assets/css/bootstrap.css") }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <style>
        .star {
            cursor: pointer;
        }

        .dark_btn:hover {
            color: #fff !important;
            text-decoration: none;
        }
    </style>
    <script src="{{ base_url("assets/js/core/libraries/jquery.min.js") }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ base_url("assets/js/core/libraries/bootstrap.min.js") }}"></script>


</head>


<body>

<div class="review_request_sec">

    <div class="review_header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6">
                    <a class="fsize17 fw500 txt_white" href="{{ base_url() }}"><img
                            src="{{ base_url("assets/images/logo_icon_bb.png") }}" width="28" alt=""></a>
                </div>
                <div class="col-xs-6 text-right">
                    <a href="#" class="fsize12 txt_white">FAQ</a>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        @if ($ratingsType == 'happy')
            <div class="row">
                <div class="col-md-12">
                    <div class="review_main_box_new">
                        <div class="review_top_icon"><img width="74"
                                                          src="{{ base_url("assets/images/review/review_star_icon.png") }}"/>
                        </div>
                        <h2>Are you happy with our service?</h2>
                        <p>Hi
                            @if(!empty($oSubscriber))
                                {{ $oSubscriber[0]->firstname.' '. $oSubscriber[0]->lastname }}
                            @endif
                            ! Please take a moment to rate our service and leave us a feedback.</p>
                        <div class="review_button mt30">
                            <button class="btn dark_btn bkg_blue_light h52 mr10 sh_no" id="yesfeed"><img width="12"
                                                                                                         src="{{ base_url("assets/images/rating5.png") }}"/>&nbsp;
                                I'm happy
                            </button>
                            <button class="btn light_btn bkg_grey_light h52 ml10 txt_dark sh_no" id="nothappy"><img
                                    src="{{ base_url("assets/images/icons/rating2.svg") }}"/> &nbsp; Unhappy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="review_main_box_new">
                        <div class="review_top_icon"><img width="74"
                                                          src="{{ base_url("assets/images/review/review_star_icon.png") }}"/>
                        </div>
                        <h2>Are you happy with our service?</h2>
                        <p>Hi
                            @if(!empty($oSubscriber))
                                {{ $oSubscriber[0]->firstname.' '. $oSubscriber[0]->lastname }}
                            @endif
                            ! Please take a moment to rate our service and leave us a feedback.</p>

                        <div class="star_box" style="border:none !important;">
                            <i class="icon-star-full2 star selected yellow" title='Poor' data-value='1'></i>
                            <i class="icon-star-full2 star selected yellow" title='Fair' data-value='2'></i>
                            <i class="icon-star-full2 star selected yellow" title='Good' data-value='3'></i>
                            <i class="icon-star-full2 star selected yellow" title='Excellent' data-value='4'></i>
                            <i class="icon-star-full2 star" title='WOW!!!' data-value='5'></i>
                        </div>

                        <div class="review_button mt30">
                            <button class="btn dark_btn bkg_blue_light h52 sh_no" id="continueStarRatings">Submit review
                                <i class="icon-arrow-right13"></i></button>
                        </div>


                    </div>
                </div>
            </div>
        @endif

    </div>

</div>

<div id="addFeedback" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="addFeedbackFrm" name="addFeedbackFrm" class="form-horizontal"
                  action="javascript:void();">
                <div class="modal-header" style="border-bottom:none;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Feedback</h5>
                </div>
                <div class="modal-body" style="margin-top:-20px;">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <div class="">
                                <select name="category" class="form-control" id="category" required>
                                    <option value="">Select Category</option>
                                    <option value="Positive" selected="selected">Positive</option>
                                    <option value="Neutral">Neutral</option>
                                    <option value="Negative">Negative</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>FeedBack</label>
                            <label class="control-label">FeedBack</label>
                            <div class="">
                                <textarea name="feedback" id="feedback" class="form-control"
                                          placeholder="Please leave feedback here..." required
                                          style="width: 100%; height: 100px; padding-top: 10px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:none;">
                    <input type="hidden" name="clientId" id="clientId" value="{{ $clientId }}">
                    <input type="hidden" name="subscriberId" id="subscriberId" value="{{ $subscriberId }}">
                    <input type="hidden" name="bbID" id="bbID" value="{{ $brandboost_id }}">
                    <input type="hidden" name="redirect" id="redirectURL" value="{{ $redirect }}">
                    @if ($ratingsType == 'star')
                        <input type="hidden" value="4" id="ratingValue" name="ratingValue">
                    @endif
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#continueStarRatings").click(function () {
            var elem = $(this);
            var selectedRatings = $("#ratingValue").val();
            if (selectedRatings > 0) {
                if (selectedRatings <= 2) {
                    //display Resolution popup
                    $("#resolution").modal("show");
                    window.location.href = "{{ base_url('feedback/index/resolution/?'.$getParam) }}";
                } else {
                    //Proceed further and redirect to destination page
                    if (selectedRatings == 3) {
                        $("#category").val("Neutral");
                    } else {
                        $("#category").val("Positive");
                    }
                    var formdata;
                    $(this).attr("disabled", "disabled");
                    formdata = $("#addFeedbackFrm").serialize();
                    //alert(formdata);
                    $.ajax({
                        url: "{{ base_url('feedback/saveFeedback') }}",
                        type: "POST",
                        data: formdata + "&happy=yes&_token={{csrf_token()}}",
                        dataType: "text",
                        success: function () {
                            window.location.href = "{{ base_url('feedback/thankyou/?'.$getParam) }}";
                        }
                    });
                }
            }

        });


        $("#yesfeed").click(function () {
            window.location.href = "{{ base_url('/feedback/thankyou/?'.$getParam) }}";
        });


        $("#nothappy").click(function () {
            window.location.href = "{{ base_url('/feedback/resolution/?'.$getParam) }}";
        })


        $("#yesfeed_OLD").click(function () {
            var formdata;
            $(this).attr("disabled", "disabled");
            formdata = $("#addFeedbackFrm").serialize();
            //alert(formdata);
            $.ajax({
                url: "{{ base_url('/feedback/saveFeedback') }}",
                type: "POST",
                data: formdata + "&happy=yes",
                dataType: "text",
                success: function () {
                    window.location.href = "{{ base_url('feedback/thankyou/?'.$getParam) }}";

                });
        });

        $(".star").click(function () {
            var ix = $(this).index();

            $(".star").each(function () {
                //$(this).removeClass('yellow');
                var index = $(this).index();
                if (index <= ix) {
                    var ratingVal = $(this).attr('data-value');
                    $(this).addClass('yellow');
                    $("#ratingValue").val(ratingVal);
                } else {
                    $(this).removeClass('yellow');
                }
            });
        });


    });
</script>


</body>
</html>
