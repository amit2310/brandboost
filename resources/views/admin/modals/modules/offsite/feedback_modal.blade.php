<!-- /content area -->
<div id="feedbackPopup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body" id="feedbackContent"></div>
                    <div class="panel-footer panel-footer-condensed">
                        <div class="heading-elements not-collapsible">
                            <span class="heading-text text-semibold">
                                <i class="icon-history position-left"></i>
                                <span class="feedbackTime"></span>
                            </span>

                            <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close</button>

                            <ul class="icons-list" style="float:right;">  
                                <li class="dropup"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                    @if ($canWrite)
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="text-semibold" style="border-bottom:1px solid #ddd; padding:5px 15px 10px;">Change Status</li>
                                            <li class="bg-danger updateFeedbackStatus" fb_status="Negative" style="color:#FFF; text-align:center; padding:10px; cursor: pointer;">Negative</li>
                                            <li class="bg-blue updateFeedbackStatus" fb_status="Neutral" style="color:#FFF; text-align:center; padding:10px; cursor: pointer;">Neutral</li>
                                            <li class="bg-success updateFeedbackStatus" fb_status="Positive" style="color:#FFF; text-align:center; padding:10px; cursor: pointer;">Positive</li>
                                        </ul>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="previewFeedbackReply" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body" id="previewFeedbackReplyContent"></div>
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

<div id="FeedbackTagListModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" name="frmFeedbackTagListModal" id="frmFeedbackTagListModal" action="javascript:void();">
				@csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Apply Tags</h5>
                </div>
                <div class="modal-body" id="tagEntireListFeedback"></div>
                <div class="modal-footer">
                    <input type="hidden" name="feedback_id" id="tag_feedback_id" />
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn dark_btn">Apply Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>