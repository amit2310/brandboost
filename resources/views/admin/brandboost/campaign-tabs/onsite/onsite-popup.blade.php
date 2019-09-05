@php
list($canRead, $canWrite) = fetchPermissions('Onsite Campaign');
$list_id = '';
@endphp
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


<div id="smsPreviewPopupPrimary" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="sendEmail" action="javascript:void();">
                <div class="modal-header">
                    <button type="button" class="canclepreviewpopup close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Sms Preview</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="margin:0px;">
                        <div class="smsPreviewContent">

                        </div>
                    </div>

                </div>
                <hr>
                <div class="modal-footer">
                    <div class="col-lg-8 showEmailBox" style="display:none;">
                        <div class="row">
                            <div class="col-lg-9"><input name="phoneNo" id="phoneNo" class="form-control" value="" placeholder="Enter your phone number" type="text" required></div>
                            <div class="col-lg-3"><button type="submit" class="btn btn-primary" id="sendPreviewSMS"><i class="icon-check"></i> Send</button></div>
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

<div id="addSubscriber" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <form method="post" class="form-horizontal" id="addSubscriberDataPop" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Add Subscriber</h5>
                </div>
                <div class="modal-body">

                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="control-label">First Name</label>
                            <div class="">
                                <input name="firstname" id="firstname" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Last Name</label>
                            <div class="">
                                <input name="lastname" id="lastname" class="form-control" value="" type="text" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <div class="">
                                <input name="email" id="email" value="" class="form-control" type="text" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Phone</label>
                            <div class="">
                                <input name="phone" id="phone" value="" class="form-control" type="text" required>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="listId" id="listId" value="{{ $list_id }}">
                    <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                    <button type="submit" id="addButton" class="btn btn-primary"><i class="icon-check"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="emailstats-modal" class="modal fade">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="canclepreviewpopup close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><i class="fa fontimgicon fa-envelope"></i> Campaign Email Stats</h5>
            </div>

            <div style="padding:0 0 20px 0;" class="modal-body mb-30">
                <div style="border-bottom: 1px solid #f5f4f5;" class="table-responsive">
                    <table class="table text-nowrap dataTable">
                        <thead>
                            <tr>
                                <th class="sorting_desc">Sent</th>
                                <th class="sorting">Delivered</th>
                                <th class="sorting">Open</th>
                                <th class="sorting">Click</th>
                                <th class="sorting">Bounce</th>
                                <th class="sorting">Dropped</th>
                                <th class="sorting">Unsubscribe</th>
                                <th class="sorting">Spam Report</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr style="display: none;">
                                <td><div class="media-left media-middle"> <a href="#"> <img src="https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/text_review_a08a0ef69875df3f4691970c2df01a1e207fdec4.png" class="img-circle img-xs" alt=""></a> </div>
                                    <div class="media-left">
                                        <div class=""><a href="#" class="text-default text-semibold">Test campaign 26</a></div>
                                        <div class="text-muted text-size-small"> 02:00 - 03:00 </div>
                                    </div></td>
                                <td><span class="text-muted" data-popup="popover" title="Popover title" data-trigger="hover" data-content="And here's some amazing content. It's very engaging. Right?">Test campaign...</span></td>
                                <td><span class="ratingBox" style="display: block"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fastar fa-star"></i><i class="fa fastar fa-star"></i> </span> <span class="text-muted reviewnum">(37 Reviews)</span></td>
                                <td><span class="ratingBox" style="display: block"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fastar fa-star"></i><i class="fa fastar fa-star"></i> </span> <span class="text-muted reviewnum">(37 Reviews)</span></td>
                                <td><span class="ratingBox" style="display: block"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fastar fa-star"></i><i class="fa fastar fa-star"></i> </span> <span class="text-muted reviewnum">(37 Reviews)</span></td>
                                <td>
                                    <div class="media-left">
                                        <div class=""><a href="#" class="text-default text-semibold">March 26, 2018</a></div>
                                        <div class="text-muted reviewnum text-size-small"> 7:45 PM (1 day ago) </div>
                                    </div>
                                </td>
                                <td><span class="label bg-danger">Draft</span></td>
                                <td class="text-center"><ul class="icons-list">
                                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#"><i class="icon-file-stats"></i> Edit</a></li>
                                                <li><a href="#"><i class="icon-file-text2"></i> Delete</a></li>
                                                <li><a href="#"><i class="icon-file-locked"></i> Get Embedded Code</a></li>
                                                <li><a href="#"><i class="icon-gear"></i> Subscribers</a></li>
                                            </ul>
                                        </li>
                                    </ul></td>
                            </tr>

                            <tr>
                                <td class="">8</td>
                                <td class="">2</td>
                                <td class="">
                                    <p class="emaildata"><strong>Total:</strong><span>52</span></p>
                                    <p class="emaildata"><strong>Unique:</strong><span>45</span></p>
                                    <p class="emaildata"><strong>Duplicate:</strong><span>7</span></p>
                                </td>
                                <td class="">
                                    <p class="emaildata"><strong>Total:</strong><span>520</span></p>
                                    <p class="emaildata"><strong>Unique:</strong><span>405</span></p>
                                    <p class="emaildata"><strong>Duplicate:</strong><span>70</span></p>
                                </td>
                                <td class=""><p class="emaildata"><strong>Total:</strong><span>8</span></p></td>
                                <td class=""><p class="emaildata"><strong>Total:</strong><span>5</span></p></td>
                                <td class=""><p class="emaildata"><strong>Total:</strong><span>56</span></p></td>
                                <td class=""><p class="emaildata"><strong>Total:</strong><span>5</span></p></td>
                            </tr>

                            <tr>
                                <td class="">8</td>
                                <td class="">2</td>
                                <td class="">
                                    <p class="emaildata"><strong>Total:</strong><span>52</span></p>
                                    <p class="emaildata"><strong>Unique:</strong><span>45</span></p>
                                    <p class="emaildata"><strong>Duplicate:</strong><span>7</span></p>
                                </td>
                                <td class="">
                                    <p class="emaildata"><strong>Total:</strong><span>520</span></p>
                                    <p class="emaildata"><strong>Unique:</strong><span>405</span></p>
                                    <p class="emaildata"><strong>Duplicate:</strong><span>70</span></p>
                                </td>
                                <td class=""><p class="emaildata"><strong>Total:</strong><span>8</span></p></td>
                                <td class=""><p class="emaildata"><strong>Total:</strong><span>5</span></p></td>
                                <td class=""><p class="emaildata"><strong>Total:</strong><span>56</span></p></td>
                                <td class=""><p class="emaildata"><strong>Total:</strong><span>5</span></p></td>
                            </tr>



                        </tbody>
                    </table>
                </div>
            </div>




            <div class="modal-body emailstatsdata">
            </div>

            </form>
        </div>
    </div>
</div>


