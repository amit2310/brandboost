$(document).ready(function () {

    $(document).on("click", ".createSegment", function () {

        var campaignID = $(this).attr('campaign-id');
        var segmentType = $(this).attr('segment-type');
        var campaignType = $(this).attr('campaign-type');
        var eventID = $(this).attr('event-id');
        $("#hidSegmentCampaignID").val(campaignID);
        $("#hidSegmentType").val(segmentType);
        $("#hidCampaignType").val(campaignType);
        $("#hidEventId").val(eventID);
        $("#addSegmentModal").modal("show");
    });

    $('#frmAddSegment').submit(function () {
        $('.overlaynew').show();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: '/admin/segments/createSegment',
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    $('.overlaynew').hide();
                    displayMessagePopup('sccess', '', 'Segment created successfully!');
                    $("#addSegmentModal").modal("hide");

                } else if (data.status == 'error' && data.msg == 'duplicate') {
                    $('.overlaynew').hide();
                    $("#addSegmentValidation").html('Segment with the same name already exists. Choose other title please').show();
                    setTimeout(function () {
                        $("#addSegmentValidation").html("").hide();
                    }, 5000);
                }
            }
        });
        return false;
    });
    
});

