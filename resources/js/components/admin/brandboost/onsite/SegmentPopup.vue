<template>

    <!-- Add Segment Popup -->
    <div id="addSegmentModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" name="frmAddSegment" id="frmAddSegment" action="javascript:void(0);">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h5 class="modal-title"><img src="/assets/css/menu_icons/Email_Color.svg"/> Add Segment &nbsp; <i class="icon-info22 fsize12 txt_grey"></i></h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Segment Title:</label>
                                    <input class="form-control" id="segmentName" name="segmentName" placeholder="Enter Segment Title" type="text" required>
                                    <div id="addSegmentValidation" style="color:#FF0000;display:none;"></div>
                                </div>

                                <div class="form-group mb0">
                                    <label>Segment Description:</label>
                                    <input class="form-control h52" type="text" id="segmentDescription" name="segmentDescription" value="" placeholder="Enter segment description"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="" name="moduleUnitID" id="hidSegmentCampaignID">
                        <input type="hidden" value="Email" name="segmentType" id="hidSegmentType">
                        <input type="hidden" value="Email" name="campaignType" id="hidCampaignType">
                        <input type="hidden" value="@{{$moduleName}}" name="moduleName" />
                        <input type="hidden" id="hidEventId" value="" name="eventID" />
                        <button data-toggle="modal" type="submit" class="btn dark_btn bkg_sblue fsize14 h52">Continue</button>
                        <button data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-link fsize14 txt_blue h52">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
    let tkn = $('meta[name="_token"]').attr('content');

    export default {
        name : 'segment-popup'
    }
</script>

<style scoped>
    .createSegment{
        cursor:pointer!important;
    }
</style>
