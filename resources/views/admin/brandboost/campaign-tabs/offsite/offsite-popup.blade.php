<div id="modal_large" class="modal fade">

</div>


<div id="emailPreviewPopup" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="sendEmail" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="canclepreviewpopup close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Email Preview</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="margin:0px;">
                        <div class="emailPreviewContent">

                        </div>
                    </div>

                </div>
                <hr>
                <div class="modal-footer">
                    <div class="col-lg-8 showEmailBox" style="display:none;">
                        <div class="row">
                            <div class="col-lg-9"><input name="email" id="email" class="form-control" value="" placeholder="Email Address For Preview" type="text" required></div>
                            <div class="col-lg-3"><button type="submit" class="btn btn-primary" id="sendPreviewEmail"><i class="icon-check"></i> Send</button></div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="sendPreviewEmailBox" style="width:92px;"><i class="icon-check"></i> Send Me</button>
                    <button type="button" class="btn bg-danger" id="cancelPreviewEmailBox" style="display:none; width:92px;"><i class="icon-cross"></i> Cancel</button>
                    <button class="btn btn-link canclepreviewpopup" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Other Source category modal -->

<div id="OtherSourcesId" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" id="OtherSourcesPopupFrm" class="form-horizontal"  action="javascript:void();">
                <input name="siteCategories[]" type="hidden" value="OtherSources">
                <input type="hidden" name="brandboostID" value="{{ $brandboostID }}">
                <div class="modal-header">
                    <button type="button" class="canclepreviewpopup close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Other Source</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <div class="">
                            <input name="offsitename" id="offsitename" class="form-control" type="text" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Website URL</label>
                        <div class="">
                            <input name="txtURL" id="txtURL" class="form-control" type="text" required="">
                        </div>
                    </div>


                </div>
                <div class="modal-footer noBorder"> 
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Other Source category modal -->



<div id="socialIconPopupE" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="socialIconPopupFrm" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="canclepreviewpopup close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Review Property</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="margin:0px;">

                        <div class="row">
                            <div class="col-md-10">
                                <h6 class="no-margin text-semibold">Step 2: Where Would You Like To Boost Your Brand? </h6>
                                <p class="content-group-sm text-muted">Where Would You Like To Boost Your Brand?</p>

                            </div>
                            <div class="col-md-2 text-right">

                            </div>
                        </div>
                        <ul class="media-list" id="">
                            <li>You have added all of the offsite brandboost</li>
                        </ul>




                    </div>

                </div>

            </form>
        </div>
    </div>
</div>


<div id="socialIconPopup" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="socialIconPopupFrm" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="canclepreviewpopup close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Add Review Property</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="margin:0px;">
                        @php
                        $offsite_ids = $brandboostData->offsite_ids;
                        $offsite_ids = unserialize($offsite_ids);
                        if (!empty($offsite_ids)) {
                            $selected_list = implode(",", $offsite_ids);
                        } else {
                            $selected_list = 0;
                        }
                        @endphp

                        <div class="row">
                            <div class="col-md-4">
                                <input name="offsite_search" id="offsite_search" placeholder="Search..." class="search form-control" type="text"> 
                            </div>
                            <div class="col-md-2 pull-right">
                                <select name="offsiteLimit" id="offsiteLimit" class="form-control">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                </select>
                            </div>

                            <div class="col-md-12"><hr style="margin: 15px -20px;"></div>


                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <h6 class="no-margin text-semibold">Step 2: Where Would You Like To Boost Your Brand? </h6>
                                <p class="content-group-sm text-muted">Where Would You Like To Boost Your Brand?</p>

                            </div>
                            <div class="col-md-2 text-right">
                                    <!--<button data-toggle="modal" data-target="#addBrandboost" class="btn btn-default" type="button"><i class="icon-make-group position-left"></i> ADD OFFSITE BRAND BOOST</button>-->


                            </div>
                        </div>

                        <input type="hidden" name="selected_list" id='selected_list' value="{{ $selected_list }}">
                        <input type="hidden" name="selected_list_n" id='selected_list_n' value="{{ $selected_list }}">
                        <input type="hidden" name="selected_list_new" id='selected_list_new' value="0">
                        <hr style="margin: 0 -20px!important;">
                        <ul style="margin: 0 -20px;" class="media-list" id="offsite_list_detail">
                        </ul>
                        <hr style="margin: 0px -20px!important;">
                        <div class="row">
                            <div class="col-md-12 mt-20 text-left">
                                <div id="pagination_link_show"></div>
                            </div>
                            <div class="col-md-12 text-center">
                                <a href="javascript:void(0);" class="btn mt-20 green_cust_btn continueStep3">
                                    Save
                                    <i class=" icon-arrow-right13 text-size-base position-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

            </form>
        </div>
    </div>
</div>




