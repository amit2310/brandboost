<div class="tab-pane {{ $clients }}" id="right-icon-tab5">
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <!-- ****** Load Smart Popup ***** -->
                @if (!empty($result))
                    @include('admin.components.smart-popup.smart-feedback-widget', ['bgClass' => 'bkg_purple'])
                @endif


                <!-- ****** end ********-->

                <div class="panel-heading">
                    <span class="pull-left">
                        <h6 class="panel-title">Requires Attention</h6>
                    </span>
                    <div class="heading_links pull-left">
                        <button type="button" class="btn btn-xs btn_white_table ml20 filterByColumn">All</button>
                        <a style="javascript:void();" class="top_links filterByColumn" fil="positive">Positive</a> 
                        <a style="javascript:void();" class="top_links filterByColumn" fil="neutral">Neutral</a> 
                        <a style="javascript:void();" class="top_links filterByColumn" fil="negative">Negative</a> 

                    </div>
                    <div class="heading-elements">
                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                            <div class="form-control-feedback">
                                <i class="icon-search4"></i>
                            </div>
                        </div>
                        <div class="table_action_tool">
                            <a href="javascript:void();"><i class="icon-calendar2"></i></a>
                            <a href="javascript:void();"><i class="icon-download4"></i></a>
                            <a href="javascript:void();"><i class="icon-upload4"></i></a>
                            <a href="javascript:void();" class="editDataList"><i class="icon-pencil4"></i></a>
                            <a href="javascript:void();" style="display: none;" id="deleteButtonBrandboostFeedbacks" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                        </div>

                    </div>
                </div>

                <div class="table-responsive">
                    @include('admin.feedback.partial.feedback-list-table')
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.modules.offsite.feedback_modal')
<script src="{{ base_url() }}assets/js/modules/offsite/feedback.js" type="text/javascript"></script>