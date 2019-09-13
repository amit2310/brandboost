@extends('layouts.main_template')

@section('title')
    {{ $title }}
@endsection

@section('contents')

    @php
        list($canRead, $canWrite) = fetchPermissions('Reviews')
    @endphp

    <div class="content">
        <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
        <div class="page_header">
            <div class="row">
                <!--=============Headings & Tabs menu==============-->
                <div class="col-md-7">
                    <h3><i class="icon-star-half"></i> &nbsp; Tag Reviews</h3>
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active all"><a style="cursor:pointer" class="filterByColumn" fil="">All</a></li>
                        <li><a style="cursor:pointer" class="filterByColumn" fil="approved">Approved</a></li>
                        <li><a style="cursor:pointer" class="filterByColumn" fil="pending">Pending</a></li>
                    </ul>
                </div>
                <!--=============Button Area Right Side==============-->
                <div class="col-md-5 text-right btn_area">
                    <div class="btn-group">
                        <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter reviews&nbsp; &nbsp; <span
                                class="caret"></span>
                        </button>
                        <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                            <div class="dropdown-content-heading"> Filter
                                <ul class="icons-list">
                                    <li><a href="#"><i class="icon-more"></i></a></li>
                                </ul>
                            </div>
                            <div class="">
                                <div
                                    class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign"
                                    id="accordion-control-right">
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings active">
                                            <h6 class="panel-title"><a data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group1"><i
                                                        class="icon-star-empty3"></i>&nbsp;Campaign Type</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Most startups fail. But many of those failures are preventable.
                                                        The Lean Startup is a new approach being adopted across the
                                                        globe, changing the way companies are built and new products are
                                                        launched.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group2"><i
                                                        class="icon-arrow-up-left2"></i>&nbsp; Source</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group73"><i
                                                        class="icon-star-full2"></i>&nbsp; Rating</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group74"><i
                                                        class="icon-calendar"></i>&nbsp; Date Created</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12"> Conetent Goes here...</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-white">
                                        <div class="panel-heading sidebarheadings">
                                            <h6 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                                       data-parent="#accordion-control-right"
                                                                       href="#accordion-control-right-group83"><i
                                                        class="icon-thumbs-up2"></i>&nbsp; Reviews</a></h6>
                                        </div>
                                        <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary"
                                                                       checked="checked">
                                                                Total Reviews
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="20"/> <span class="dash">-</span> <input
                                                            class="form-control input-sm" type="text" name=""
                                                            value="100"/>
                                                    </div>

                                                </div>
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary"
                                                                       checked="checked">
                                                                Positive
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="20"/> <span class="dash">-</span> <input
                                                            class="form-control input-sm" type="text" name=""
                                                            value="100"/>
                                                    </div>

                                                </div>
                                                <div class="row mb20">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary">
                                                                Neutral
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="20" disabled/> <span class="dash">-</span> <input
                                                            class="form-control input-sm" type="text" name=""
                                                            value="100" disabled/>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="control-primary"
                                                                       checked="checked">
                                                                Negative
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <input class="form-control input-sm" type="text" name=""
                                                               value="0"/> <span class="dash">-</span> <input
                                                            class="form-control input-sm" type="text" name=""
                                                            value="10"/>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-content-footer">
                                <button type="button" class="btn dark_btn dropdown-toggle"
                                        style="display: inline-block;"><i
                                        class="icon-filter4"></i><span> &nbsp;  Filter</span></button>
                                &nbsp; &nbsp;
                                <a style="display: inline-block;" href="#">Clear All</a>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn dark_btn dropdown-toggle ml10"><i class="icon-plus3"></i><span> &nbsp;  Add Review</span>
                    </button>
                </div>
            </div>
        </div>
        <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->

        <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
        <div class="tab-content">
            <!--===========TAB 1===========-->
            <div class="tab-pane active" id="right-icon-tab0">
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin: 0;" class="panel panel-flat">
                            <div class="panel-heading">
							<span class="pull-left">
								<h6 class="panel-title">
									@if(!empty($aReviews))
                                        {{ count($aReviews) }}
                                    @endif
									Reviews
								</h6>
							</span>

                                <div class="heading_links pull-left">
                                    <a class="top_links top_links_clk btn btn-xs ml20 btn-default" startRate=""
                                       style="cursor: pointer;">All</a>
                                    <a class="top_links top_links_clk" startRate="positive" style="cursor: pointer;">#
                                        Positive</a>
                                    <a class="top_links top_links_clk" startRate="neutral" style="cursor: pointer;">#
                                        Neutral</a>
                                    <a class="top_links top_links_clk" startRate="negative" style="cursor: pointer;">#Negative</a>
                                    <a class="top_links top_links_clk link" startRate="commentLink"
                                       style="cursor: pointer;">#With comments only</a>
                                    <button type="button" class="btn btn-xs ml20 btn-default"><i class="icon-plus3"></i>
                                    </button>
                                </div>

                                <div class="heading-elements">
                                    <div style="display: inline-block; margin: 0;"
                                         class="form-group has-feedback has-feedback-left">
                                        <input class="form-control input-sm cus_search" tableID="onsitereviewReview"
                                               placeholder="Search by name" type="text">
                                        <div class="form-control-feedback"><i class="icon-search4"></i></div>
                                    </div>
                                    &nbsp; &nbsp;
                                    <button type="button" class="btn btn-xs btn-default editDataReview"><i
                                            class="icon-pencil position-left"></i> Edit
                                    </button>
                                    <button id="deleteButtonReviewList" class="btn btn-xs custom_action_box"><i
                                            class="icon-trash position-left"></i></button>
                                </div>
                            </div>

                            <div class="panel-body p0">
                                <!-- Table data -->
                                <table class="table datatable-basic-new" id="onsitereviewReview">
                                    <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th style="display: none;"></th>
                                        <th style="display: none;" class="nosort editAction"><label
                                                class="custmo_checkbox pull-left"><input type="checkbox"
                                                                                         name="checkAll[]"
                                                                                         class="control-primary"
                                                                                         id="checkAll"><span
                                                    class="custmo_checkmark"></span></label></th>
                                        <th><i class="icon-stack-star"></i>Name</th>
                                        <th><i class="icon-star-full2"></i>Rating</th>
                                        <th><i class="icon-star-full2"></i>Campaign Review</th>
                                        <th><i class="icon-calendar"></i>Created</th>
                                        <th><i class="icon-comment"></i>Comments</th>
                                        <th style="display: none;"><i class="icon-comment"></i>Comments</th>
                                        <th><i class="icon-price-tag2"></i>Tags</th>
                                        <th><i class="fa fa-dot-circle-o"></i>Status</th>
                                        <th class="nosort"><i class="fa fa-dot-circle-o"></i> Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <!--=======================-->
                                    @php
                                        if (!empty($tReview)) {
                                            $inc = 1;
                                            foreach ($tReview as $oReview) {
                                                $getComm = getCampaignCommentCount($oReview->id);
                                                $reviewTags = getTagsByReviewID($oReview->id);

                                                $reviewLikeCount = \App\Models\ReviewsModel::countHelpful($oReview->id);
                                                if(!empty($oReview->avatar)) {
                                                    $avatarImage = $oReview->avatar;
                                                }
                                                else {
                                                    $avatarImage = 'avatar_image.png';
                                                }

                                                $smilyImage = ratingView($oReview->ratings);

                                                $reviewCommentsData = \App\Models\ReviewsModel::getReviewAllComments($oReview->id,0, 100);

                                                $approved = 0;
                                                $pending = 0;
                                                $disApproved = 0;
                                                if(!empty($reviewCommentsData)) {

                                                    foreach($reviewCommentsData as $comm) {

                                                        if($comm->status == 1) {
                                                            $approved = $approved + 1;
                                                        }
                                                        else if($comm->status == 2){
                                                            $pending = $pending + 1;
                                                        }
                                                        else {
                                                            $disApproved = $disApproved + 1;
                                                        }
                                                    }
                                                }
                                    @endphp

                                    <tr id="append-{{ $oReview->id }}" class="selectedClass">
                                        <td style="display: none;">{{ date('m/d/Y', strtotime($oReview->created)) }}</td>
                                        <td style="display: none;">{{ $oReview->id }}</td>
                                        <td style="width: 40px!important; display: none;" class="editAction">
                                            <label class="custmo_checkbox pull-left">
                                                <input type="checkbox" name="checkRows[]" class="checkRows"
                                                       id="chk{{ $oReview->id }}" value="{{ $oReview->id }}">
                                                <span class="custmo_checkmark"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a class="icons" href="#">
                                                    <img src="{{ base_url('profile_images/').$avatarImage }}"
                                                         class="img-circle img-xs" alt="">
                                                </a>
                                            </div>
                                            <div class="media-left">
                                                <div class="pt-5">
                                                    <a href="#" class="text-default text-semibold">
                                                        <span>{{ $oReview->firstname.' '.$oReview->lastname }}</span>
                                                        <img class="flags"
                                                             src="{{ base_url() }}assets/images/flags/ao.png">
                                                    </a>
                                                </div>
                                                <div class="text-muted text-size-small">{{ $oReview->email }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $smilyImage }}</td>
                                        <td>
                                            <div
                                                class="text-semibold">{{ setStringLimit($oReview->review_title, '25') }}</div>
                                            <div
                                                class="text-size-small text-muted">{{ setStringLimit($oReview->comment_text, '61') }}</div>
                                        </td>
                                        <td>
                                            <div class="media-left">
                                                <div class="">
                                                    <a href="#" class="text-default text-semibold">
                                                        {{ date('d M Y', strtotime($oReview->created)) }}
                                                    </a>
                                                </div>
                                                <div
                                                    class="text-muted text-size-small">{{ date('h:iA', strtotime($oReview->created)) }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                @if ($getComm > 0)
                                                    <a style="cursor: pointer; color: #333333;"
                                                       onclick="showCommentsPopup({{ $oReview->id }})">{{ $getComm }}</a>
                                                @else
                                                    0
                                                @endif
                                            </div>
                                            <div>
                                                <span class="txt_green text-size-small">{{ $approved }}</span>
                                                <span class="pl0 pr0 text-size-small text-muted">/</span>
                                                <span class="txt_red text-size-small">{{ $disApproved }}</span>
                                            </div>
                                        </td>
                                        <td style="display: none;">{{ $getComm }}</td>
                                        <td width="200">
                                            <div class="tdropdown">
                                                <button type="button"
                                                        class="btn btn-xs btn_white_table dropdown-toggle "
                                                        data-toggle="dropdown">
                                                    <i class="icon-hash"></i>
                                                    {{ count($reviewTags) }} Tags &nbsp;
                                                    <span class="caret"></span>
                                                </button>

                                                @if (count($reviewTags) > 0)
                                                    <ul class="dropdown-menu dropdown-menu-right width-200">
                                                        @foreach ($reviewTags as $tagsData)
                                                            <li>
                                                                <a href="#"><i
                                                                        class="icon-screen-full"></i> {{ $tagsData->tag_name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                            @if($canWrite)
                                                <a href="javascript:void(0);"
                                                   class="applyInsightTags btn btn-xs btn_white_table"
                                                   action_name="review-tag"
                                                   reviewid="{{ base64_url_encode($oReview->id) }}">
                                                    <i class="icon-plus3"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-xs btn_white_table pr10">
                                                @($oReview->status == 0)
                                                <i class="icon-primitive-dot txt_red"></i> Disapproved
                                                @elseif ($oReview->status == 2)
                                                <i class="icon-primitive-dot txt_blue"></i> Pending
                                                @else
                                                    <i class="icon-primitive-dot txt_green"></i> Approved
                                                @endif
                                            </button>
                                        </td>
                                        <td>
                                            <div class="tdropdown">
                                                <ul class="icons-list">
                                                    @if ($inc > 5)
                                                        <li class="dropup">
                                                    @else
                                                        <li class="dropdown">
                                                            @endif

                                                            <button type="button"
                                                                    class="btn btn-xs btn_white_table ml20 dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="icon-more2 txt_blue"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right width-200">
                                                                @if ($canWrite)
                                                                    @if ($oReview->status == 1)
                                                                        <li><a review_id='{{ $oReview->id }}'
                                                                               change_status='0'
                                                                               title='Disapproved this review.'
                                                                               class='chg_status red'><i
                                                                                    class='icon-file-locked'></i>
                                                                                Disapproved</a></li>
                                                                    @elseif ($oReview->status == 2)
                                                                    <li><a review_id='{{ $oReview->id }}'
                                                                           change_status='1'
                                                                           title='Approved this review.'
                                                                           class='chg_status green'><i
                                                                                class='icon-file-locked'></i>
                                                                            Approved</a></li>
                                                                    <li><a review_id='{{ $oReview->id }}'
                                                                           change_status='0'
                                                                           title='Disapproved this review.'
                                                                           class='chg_status red'><i
                                                                                class='icon-file-locked'></i>
                                                                            Disapproved</a></li>
                                                                    @else
                                                                        <li><a review_id='{{ $oReview->id }}'
                                                                               change_status='1'
                                                                               title='Approved this review.'
                                                                               class='chg_status green'><i
                                                                                    class='icon-file-locked'></i>
                                                                                Approved</a></li>
                                                                    @endif

                                                                    <li><a href="javascript:void(0);"
                                                                           class="applyInsightTags"
                                                                           action_name="review-tag"
                                                                           reviewid="{{ base64_url_encode($oReview->id) }}"><i
                                                                                class="icon-file-locked"></i> Apply Tags</a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"
                                                                           class="displayReview"
                                                                           action_name="review-tag" tab_type="note"
                                                                           reviewid="{{ $oReview->id }}"
                                                                           review_time='{{ date("M d, Y h:i A", strtotime($oReview->created)) }}( {{ timeAgo($oReview->created) }})'><i
                                                                                class="icon-file-locked"></i> Add Notes</a>
                                                                    </li>
                                                                    }
                                                                    <li><a href="javascript:void(0);"
                                                                           class="showReviewPopup" tab_type="info"
                                                                           reviewid="{{ $oReview->id }}"><i
                                                                                class="icon-file-locked"></i> View
                                                                            Review Popup</a></li>

                                                                    <li><a target="_blank"
                                                                           href="{{ base_url('admin/brandboost/reviewdetails/' . $oReview->id) }}"><i
                                                                                class="icon-file-locked"></i> View
                                                                            Review</a></li>
                                                                    @if ($canWrite)
                                                                        @if ($oReview->review_type == 'text')
                                                                            <li><a href="javascript:void(0);"
                                                                                   class="editReview"
                                                                                   reviewid="{{ $oReview->id }}"><i
                                                                                        class="icon-gear"></i> Edit</a>
                                                                            </li>
                                                                        @else
                                                                            <li><a href="javascript:void(0);"
                                                                                   class="editVideoReview"
                                                                                   reviewid="{{ $oReview->id }}"><i
                                                                                        class="icon-pencil"></i>
                                                                                    Edit</a></li>
                                                                        @endif
                                                                        <li><a href="javascript:void(0);"
                                                                               class="deleteReview"
                                                                               reviewid="{{ $oReview->id }}"><i
                                                                                    class="icon-trash"></i> Delete</a>
                                                                        </li>
                                                                    @endif
                                                            </ul>
                                                        </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $inc++;
                                        }
                                    }
                                    @endphp
                                    </tbody>
                                </table>
                                <!-- End Table data -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================================= CONTENT AFTER TAB===============================-->
    </div>

    <!--=====================================Create new campaign================================-->
    <div id="addPeopleList" class="modal fade">
        <div style="max-width: 440px;ss" class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Create new campaign</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Campaign name</label>
                                    <div class="">
                                        <input placeholder="Enter campaign name" name="firstname" id="firstname"
                                               class="form-control" type="text" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb0">
                                    <label class="control-label">Campaign description</label>
                                    <div class="">
                                        <textarea placeholder="Enter campaign description" class="form-control" value=""
                                                  type="text" required> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p40">
                        <input type="hidden" name="listId" id="list_id" value="">
                        <button class="btn btn-link text-muted" data-dismiss="modal">Cancel</button>
                        <button data-toggle="modal" id="nextpopup" type="button" class="btn dark_btn bkg_purple">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--=====================================Add List Modal Popup End================================-->

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
                        <div class="form-group">
                            <label class="control-label col-lg-3">Title</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="edit_review_title" id="edit_review_title"
                                       placeholder="Title" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">Comment</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" placeholder="Leave Review" name="edit_content"
                                          id="edit_content" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">Rating</label>
                            <div class="col-lg-9">
                                <div class="step_star_new" style="padding: 5px 0;">
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
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Update Review</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-lg-3">Title</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="edit_review_title"
                                       id="edit_video_review_title" placeholder="Title" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">Rating</label>
                            <div class="col-lg-9">
                                <div class="step_star_new" style="padding: 5px 0;">
                                    <ul id='stars_video'></ul>
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
                    <a id="downloadVideo" class="btn btn-primary" href="" download><i class="icon-download"></i>&nbsp;&nbsp;
                        Download Video</a>
                </div>
            </div>
        </div>
    </div>


    <div id="reviewPopup" class="modal fade">
        <div class="modal-dialog">
            <div class="">
                <div class="col-md-12">
                    <div class="panel">
                        <div style="border-top: none; border-bottom: 1px solid #eee!important;"
                             class="panel-footer panel-footer-condensed">
                            <div class="heading-elements not-collapsible">
                            <span class="heading-text text-semibold">
                                <i class="icon-history position-left"></i>
                                <span class="reviewTime"></span>
                            </span>
                                <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i>
                                    Close
                                </button>
                            </div>
                        </div>
                        <div class="panel-body" id="reviewContent"></div>
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
                                <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i>
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="ReviewTagListModal" class="modal fade" style="z-index:9999;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div style="border-top: none; border-bottom: 1px solid #eee!important;"
                     class="panel-footer panel-footer-condensed">
                    <div class="heading-elements not-collapsible">
                    <span class="heading-text text-semibold">
                        <i class="fa fa-tag position-left"></i>
                        <span class="reviewTime">Apply Tags</span>
                    </span>
                        <button class="btn btn-link pull-right" data-dismiss="modal"><i class="icon-cross"></i> Close
                        </button>
                    </div>
                </div>

                <form method="post" name="frmReviewTagListModal" id="frmReviewTagListModal" action="javascript:void();">
                    @csrf
                    <div class="modal-body" id="tagEntireList"></div>
                    <div class="modal-footer modalFooterBtn">
                        <input type="hidden" name="review_id" id="tag_review_id"/>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply Tag</button>
                    </div>
                </form>
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
    <!-- /newreviewpopup -->

    <div id="commentpopup" class="modal fade">
    </div>

    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#onsitereviewReview thead tr').clone(true).appendTo('#onsitereviewReview thead');

            $('#onsitereviewReview thead tr:eq(1) th').each(function (i) {

                if (i === 10) {
                    //console.log(i);
                    var title = $(this).text();
                    $(this).html('<input type="text" id="filterBy" placeholder="Search ' + title + '" />');

                    $('input', this).on('keyup change', function () {
                        if (tableBase.column(i).search() !== this.value) {
                            tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });
                }
                if (i === 4) {
                    //console.log(i);
                    var title = $(this).text();
                    $(this).html('<input type="text" id="startRate" placeholder="Search ' + title + '" />');

                    $('input', this).on('keyup change', function () {
                        if (tableBase.column(i).search() !== this.value) {
                            tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });
                }
            });

            $(document).on('click', '.filterByColumn', function () {

                $('.nav-tabs').each(function (i) {
                    $(this).children().removeClass('active');
                });
                $(this).parent().addClass('active');
                var fil = $(this).attr('fil');
                $('#filterBy').val(fil);
                $('#filterBy').keyup();

                if (fil.length == 0) {
                    $('.heading_links').each(function (i) {
                        $(this).children('a').removeClass('btn btn-xs ml20 btn-default');
                    });
                    $('#startRate').val('');
                    $('#startRate').keyup();
                    $('.heading_links a:eq(0)').addClass('btn btn-xs ml20 btn-default');
                    tableBase.draw();
                }
            });

            $(document).on('click', '.top_links_clk', function () {

                $('.heading_links').each(function (i) {
                    $(this).children('a').removeClass('btn btn-xs ml20 btn-default');
                });
                $(this).addClass('btn btn-xs ml20 btn-default');
                var typ = $(this).attr('startRate');

                if (typ != 'commentLink') {
                    $('#startRate').val(typ);
                    $('#startRate').keyup();

                    if (typ.length == 0) {
                        $('.nav-tabs').each(function (i) {
                            $(this).children().removeClass('active');
                        });
                        $('#filterBy').val('');
                        $('#filterBy').keyup();
                        $('ul.nav-tabs li.all').addClass('active');
                        tableBase.draw();
                    }
                } else {
                    $('#startRate').val('');
                    $('#startRate').keyup();
                    tableBase.draw();
                }

            });

            var tableId = 'onsitereviewReview';
            var tableBase = custom_data_table(tableId);

            $('table thead tr:eq(1)').hide();
        });


        // top navigation fixed on scroll and side bar collasped

        $(window).scroll(function () {
            var sc = $(window).scrollTop();
            if (sc > 100) {
                $("#header-sroll").addClass("small-header");
            } else {
                $("#header-sroll").removeClass("small-header");
            }
        });

        function smallMenu() {
            if ($(window).width() < 1600) {
                $('body').addClass('sidebar-xs');
            } else {
                $('body').removeClass('sidebar-xs');
            }
        }

        $(document).ready(function () {
            smallMenu();

            window.onresize = function () {
                smallMenu();
            };
        });

        function showCommentsPopup(reviewID) {
            $.ajax({
                url: "{{ base_url('admin/reviews/getCommentsPopup') }}",
                type: "POST",
                data: {review_id: reviewID, _token: '{{ csrf_token() }}'},
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


        $(document).ready(function () {
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

            $(document).on('click', '#deleteButtonReviewList', function () {
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
                                    url: "{{ base_url('admin/reviews/deleteMultipalReview') }}",
                                    type: "POST",
                                    data: {multiReviewid: val, _token: '{{ csrf_token() }}'},
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
                    url: "{{ base_url('admin/tags/applyReviewTag') }}",
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

            $(document).on("click", ".showReviewPopup", function () {
                var reviewid = $(this).attr("reviewid");
                getReviewPopupData(reviewid, '');
            });

            function getReviewPopupData(reviewId, tabtype) {
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('/admin/reviews/getReviewPopupData') }}",
                    type: "POST",
                    data: {rid: reviewId, _token: '{{ csrf_token() }}'},
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {
                            $('.overlaynew').hide();
                            $("#newreviewpopup").modal("show");
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

            function displayReviewPopup(reviewid, tabtype, reviewTime) {
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('/admin/reviews/displayreview') }}",
                    type: "POST",
                    data: {rid: reviewid, _token: '{{ csrf_token() }}'},
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

            $(document).on("click", "#saveReviewNotes", function () {
                var formdata = $("#frmSaveNote").serialize();
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('/admin/reviews/saveReviewNotes') }}",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == "success") {
                            var reviewid = $("input[name='reviewid']").val();
                            var tabtype = 'note';
                            var reviewtime = $("input[name='reviewtime']").val();
                            displayReviewPopup(reviewid, tabtype, reviewtime);
                        }
                    },
                    error: function (response) {
                        alertMessage(response.message);
                    }
                });
            });

            $(document).on("click", "#saveReviewNotesPopup", function () {
                var formdata = $("#frmSaveNote").serialize();
                $('.overlaynew').show();
                $.ajax({
                    url: "{{ base_url('/admin/reviews/saveReviewNotes') }}",
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


        $(document).ready(function () {
            $(document).on('click', '.showVideo', function () {
                var videoUrl = $(this).attr('videoUrl');
                $("#showVideoPopup").modal();
                $('#divVideo video source').attr('src', videoUrl);
                $("#divVideo video")[0].load();
                $('#downloadVideo').attr('href', videoUrl);
            });

            $(document).on('click', '.deleteReview', function () {
                var reviewID = $(this).attr('reviewid');
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
                            $.ajax({
                                url: "{{ base_url('admin/reviews/deleteReview') }}",
                                type: "POST",
                                data: {reviewid: reviewID, _token: '{{ csrf_token() }}'},
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
            });


            $(document).on('click', '.editReview', function () {
                var reviewID = $(this).attr('reviewid');
                $.ajax({
                    url: "{{ base_url('admin/reviews/getReviewById') }}",
                    type: "POST",
                    data: {reviewid: reviewID, _token: '{{ csrf_token() }}'},
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
                        }
                    }
                });
            });


            $(document).on('click', '.editVideoReview', function () {
                var reviewID = $(this).attr('reviewid');
                $.ajax({
                    url: "{{ base_url('admin/reviews/getReviewById') }}",
                    type: "POST",
                    data: {reviewid: reviewID, _token: '{{ csrf_token() }}'},
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 'success') {
                            var reviewData = data.result[0];
                            $('#edit_video_content').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' + reviewData.comment_video);
                            $('#edit_video_reviewid').val(reviewData.id);
                            $('#edit_video_review_title').val(reviewData.review_title);
                            var start = '';
                            var startName = ['', 'Poor', 'Fair', 'Good', 'Excellent', 'WOW!!!'];
                            for (var inc = 1; inc <= 5; inc++) {
                                if (inc < reviewData.ratings || inc == reviewData.ratings) {

                                    start += "<li class='star' title='" + startName[inc] + "' data-value='" + inc + "'><i class='fa fa-star fa-fw' style='margin: 0;'></i></li>";
                                } else {
                                    start += "<li class='star' title='" + startName[inc] + "' data-value='" + inc + "'><i class='fa fa-star-o fa-fw' style='margin: 0;'></i></li>";
                                }
                            }
                            $('#stars_video').html(start);
                            $('#ratingValueVideo').val(reviewData.ratings);
                            $('#stars_video li').each(function (index, value) {

                                if (reviewData.ratings > index) {
                                    $(this).addClass('selected');
                                } else {
                                    $(this).removeClass('selected');
                                }
                            });
                            $("#editVideoReview").modal();

                        }
                    }
                });
            });


            $("#updateReview").submit(function () {
                $('.overlaynew').show();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: "{{ base_url('admin/reviews/update_review') }}",
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
                    url: "{{ base_url('admin/reviews/update_video_review') }}",
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
                    url: "{{ base_url('admin/reviews/updateReviewStatus') }}",
                    type: "POST",
                    data: {status: status, review_id: review_id, _token: '{{ csrf_token() }}'},
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
            $(document).on('click', '#stars_video li', function () {
                var onStar = parseInt($(this).data('value'), 10);
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                    $(stars[i]).children('i').removeClass('fa-star');
                    $(stars[i]).children('i').addClass('fa-star-o');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                    $(stars[i]).children('i').removeClass('fa-star-o');
                    $(stars[i]).children('i').addClass('fa-star');
                }

                ratingValueVideo = parseInt($('#stars_video li.selected').last().data('value'), 10);
                $('#ratingValueVideo').val(ratingValueVideo);

            });

            $(document).on("click", ".applyInsightTags", function () {
                var review_id = $(this).attr("reviewid");
                var feedback_id = $(this).attr("feedback_id");
                var action_name = $(this).attr("action_name");
                $.ajax({
                    url: "{{ base_url('admin/tags/listAllTags') }}",
                    type: "POST",
                    data: {review_id: review_id, _token: '{{ csrf_token() }}'},
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


            $(document).on('click', '.editDataReview', function () {
                $('.editAction').toggle();
            });
        });
    </script>
@endsection
