@php
    $aSelectedContacts = array();
    if (!empty($oCampaignContacts)) {
        foreach ($oCampaignContacts as $oRec) {
            $aSelectedContacts[] = $oRec->subscriber_id;
        }
    }

    $iActiveCount = $iArchiveCount = 0;
    if (!empty($oBroadcastSubscriber)) {
        foreach ($oBroadcastSubscriber as $oCount) {
            if ($oCount->status == 2) {
                $iArchiveCount++;
            } else {
                $iActiveCount++;
            }
        }
    }
@endphp
<div id="broadcastReviewAudience" class="broadcastTab"
     @if ($activeTab != 'Review Contacts' || empty($activeTab))
     style="display:none;"
    @endif >
    <div class="col-md-12 p0">
        <div class="panel panel-flat">
            @include('admin.components.smart-popup.smart-contact-widget')
            <div class="panel-heading">
                <span class="pull-left">
                    <h6 class="panel-title"><span id="totalBroadcastReviewAudience">{{ $iActiveCount }}</span> Contacts</h6>

                </span>

                <div class="heading-elements">
                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                        <input class="form-control input-sm cus_search" tableID="editBroadcastAudience"
                               placeholder="Search by name" type="text">
                        <div class="form-control-feedback">
                            <i class=""><img src="{{ base_url() }}assets/images/icon_search.png" width="14"></i>
                        </div>
                    </div>

                    <div class="table_action_tool">
                        <a href="javascript:void(0);" class="brig pr-15">Updated just now &nbsp; <i class=""><img
                                    src="{{ base_url() }}assets/images/icon_refresh.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img
                                    src="{{ base_url() }}assets/images/icon_calender.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img
                                    src="{{ base_url() }}assets/images/icon_download.png"></i></a>
                        <a href="javascript:void(0);"><i class=""><img
                                    src="{{ base_url() }}assets/images/icon_upload.png"></i></a>
                        @if($bExpired == false)
                            <a href="javascript:void(0);" class="editDataListContact"><i class="icon-pencil"></i></a>
                        @endif
                        <a href="javascript:void(0);" style="display: none;"
                           class="custom_action_box_con deleteBulkBoradcastAudience"
                           broadcast_id="{{ $oBroadcast->broadcast_id }}"><i class="icon-trash position-left"></i></a>
                    </div>
                </div>

            </div>
            <div class="panel-body p0 bkg_white">
                <div id="liveReviewAudience">
                    @include('admin.broadcast.partials.broadcast_audience', ['recordSource' => 'review-audience'])
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $(document).on('click', '.editDataListContact', function () {
            $('.editActionContact').toggle();
        });

        $(document).on('change', '#checkAllContact', function (e) {
            e.stopImmediatePropagation();
            if (false == $(this).prop("checked")) {

                $(".addToBroadcast").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box_con').hide();
            } else {

                $(".addToBroadcast").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box_con').show();
            }
        });

        $(document).on('click', '.addToBroadcast', function () {
            var inc = 0;
            var rowId = $(this).val();
            if (false == $(this).prop("checked")) {
                $('#append-con-ml-' + rowId).removeClass('success');
                $('#append-con-cl-' + rowId).removeClass('success');
            } else {
                $('#append-con-ml-' + rowId).addClass('success');
                $('#append-con-cl-' + rowId).addClass('success');
            }

            $('.addToBroadcast:checkbox:checked').each(function (i) {
                inc++;
            });
            if (inc == 0) {
                $('.custom_action_box_con').hide();
            } else {
                $('.custom_action_box_con').show();
            }

            var numberOfChecked = $('.addToBroadcast:checkbox:checked').length;
            var totalCheckboxes = $('.addToBroadcast:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAllContact').prop('checked', false);
            }
        });
    });

</script>
