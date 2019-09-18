@php
list($canRead, $canWrite) = fetchPermissions('Onsite Campaign');
$aReviewData = array(
    'aReviews' => $aReviews,
    'campaignId' => "" //$brandboostData->id
);
$reviews = "";
$selectedCategory = "";
$bActiveSubsription = "";
@endphp
<div class="tab-pane {{ $reviews }}" id="right-icon-tab6">
    <div class="row">
        <div class="col-md-12">
            <div style="margin: 0;" class="panel panel-flat">
                <!-- ****** Load Smart Popup ***** -->
                @if (!empty($aReviews))
                    @include('admin.components.smart-popup.smart-review-widget')
                    @include('admin.components.smart-popup.smart-contact-widget-review')
                @endif
                <!-- ****** end ********-->
                <div class="panel-heading">
                    <span class="pull-left">
                        <h6 class="panel-title"> {{ count($aReviews) }} Reviews</h6>
                    </span>
                    <div class="heading_links pull-left">
                        @php
                        $positiveCate = '';
                        $neutralCate = '';
                        $negativeCate = '';
                        $all = '';
                        if ($selectedCategory == 'positive') {
                            $positiveCate = 'btn btn-xs btn_white_table';
                        } else if ($selectedCategory == 'neutral') {
                            $neutralCate = 'btn btn-xs btn_white_table';
                        } else if ($selectedCategory == 'negative') {
                            $negativeCate = 'btn btn-xs btn_white_table';
                        } else {
                            $all = 'btn btn-xs btn_white_table';
                        }
                        @endphp
                        <input type="hidden" name="selectedCategory" id="selectedCategory" value="{{ $selectedCategory }}" />

                        <a class="top_links top_links_clk {{ $all }}" startRate="">All</a>
                        <a class="top_links top_links_clk {{ $positiveCate }}" startRate="positive" style="cursor: pointer;">Positive</a>
                        <a class="top_links top_links_clk {{ $neutralCate }}" startRate="neutral" style="cursor: pointer;">Neutral</a>
                        <a class="top_links top_links_clk {{ $negativeCate }}" startRate="negative" style="cursor: pointer;">Negative</a>

                        <!-- <a class="top_links" href="#">Negative review</a>-->
                        <!-- <button type="button" class="btn btn-xs plus_icon ml20"><i class="icon-plus3"></i></button>  -->
                    </div>

                    <div class="heading-elements">
                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                            <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                        </div>
                        <div class="table_action_tool">
                            <a href="javascript:void();"><i class="icon-calendar2"></i></a>
                            <a href="javascript:void();" class="editDataReview"><i class="icon-pencil4"></i></a>
                            <a href="javascript:void();" style="display: none;" id="deleteButtonReviewList" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                        </div>
                    </div>
                </div>

                <div class="panel-body p0">
                    @if (!empty($aReviews))
                        @include('admin.brandboost.partial.review_table', array('access' => 'limited'))
                    @else
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th style="display: none;"></th>
                                    <th style="display: none;"></th>
                                    <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                    <th><i class="icon-user"></i>Name</th>
                                    <th><i class="icon-star-full2"></i>Review Rating</th>
                                    <th><i class="icon-paragraph-left3"></i>Site / Product / Service Details</th>
                                    <th><i class="icon-paragraph-left3"></i>Review</th>
                                    <th><i class="icon-calendar"></i>Created</th>
                                    <th><i class="icon-hash"></i>Tags</th>
                                    <th><i class="icon-folder2"></i>Category</th>
                                    <th class="text-center"><i class="icon-diff-modified"></i>Status</th>
                                    <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
                                    <th style="display: none;"></th>
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
                                                You Currently have No Reviews <img src="{{ site_url('assets/images/smiley.png') }}"> <br>
                                                Lets Configure Your Campaign.
                                            </h5>

                                            <a class="btn bl_cust_btn btn-default dark_btn ml20 mb40" href="{{ base_url() }}admin/brandboost/addreview/{{ $brandboostID }}">Add On Site Manual Review</a>

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
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>
