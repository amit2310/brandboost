<div class="box smart-broadcast-box" style="width: 400px;z-index:9999999999;">
    <div class="smart-broadcast-box-inner" style="width: 400px;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">
            <div class="row" style="height: 100%;" id="broadcastSmartPopupContainer">
                @include('admin.components.smart-popup.import-options') 
            </div>
        </div>					
    </div>
</div>   
<a style="position: fixed; top: 50%; right: 12px;" class="reviews smart-broadcast slide-toggle visible {{ (strtolower($oBroadcast->campaign_type) == 'email') ? 'bkg_sblue2' : 'bkg_green' }}"><i class="icon-arrow-left5"></i></a>

@include('admin.components.smart-popup.contacts') 

<script>
    $(document).ready(function () {

        $(document).on("click", ".smart-broadcast-import-back", function () {
            $(".viewBroadcastImportOptionSmartPopup").trigger("click");
        });

        $(document).on("click", ".smart-broadcast-export-back", function () {
            $(".viewBroadcastExcludeOptionSmartPopup").trigger("click");
        });


        $(document).on("click", ".smart-broadcast", function () {
            $(".smart-broadcast-box").animate({
                width: "toggle"
            });
        });

        $(document).on("click", ".viewBroadcastImportOptionSmartPopup", function (event, param1) {
            if (param1 == 'promptToChooseContacts') {
                setTimeout(function () {
                    $("#validateAddedContacts").show();
                }, 500);
            }
            $(document).bind("mouseup", function (e) {
                var container = $("#broadcastSmartPopupContainer"); 

                if (!container.is(e.target) && container.has(e.target).length === 0) // ... nor a descendant of the container
                {
                    $(".box").hide();
                }
            });
            $("#broadcastSmartPopupContainer").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
            var broadcastId = $(this).attr('broadcast-id');
            loadImportOptionSmartPopup(broadcastId);
            $(".smart-broadcast-box, .smart-broadcast-box-inner").css("width", "400px");
            $(".smart-broadcast-box").show();
        });

        $(document).on("click", ".viewBroadcastExcludeOptionSmartPopup", function () {
            $(document).bind("mouseup", function (e) {
                var container = $("#broadcastSmartPopupContainer"); 

                if (!container.is(e.target) && container.has(e.target).length === 0) // ... nor a descendant of the container
                {
                    $(".box").hide();
                }
            });
            $("#broadcastSmartPopupContainer").html('<h1 class="text-center" style="margin-top:450px;">Loading....</h1>');
            var broadcastId = $(this).attr('broadcast-id');
            loadExcludeOptionSmartPopup(broadcastId);
            $(".smart-broadcast-box, .smart-broadcast-box-inner").css("width", "400px");
            $(".smart-broadcast-box").show();
        });

        $(document).on("click", ".loadAudience", function () {
            var broadcastId = $(this).attr('broadcast-id');
            var audienceType = $(this).attr('audience-type');
            var actionType = $(this).attr('action-type');
            $("#validateAddedContacts").hide();
            $.ajax({
                url: '/admin/broadcast/loadBroadcastAudience',
                type: "POST",
                data: {_token: '{{csrf_token()}}', broadcastId: broadcastId, audienceType: audienceType, actionType: actionType},
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        var smartContent = data.content;
                        $("#broadcastSmartPopupContainer").html(smartContent);
                        $(".smart-broadcast-box, .smart-broadcast-box-inner").css("width", "680px");
                        var tableId = 'listSmartContacts';
                        var tableBase = custom_data_table(tableId);
                        $('.dataTables_filter input').addClass('search_item');
                    }
                }
            });
        });
    });
	

    function loadImportOptionSmartPopup(broadcastId) {
        $.ajax({
            url: '/admin/broadcast/loadImportOption',
            type: "POST",
            data: {_token: '{{csrf_token()}}', broadcastId: broadcastId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var smartContent = data.content;
                    $("#broadcastSmartPopupContainer").html(smartContent);
                }
            }
        });
    }


    function loadExcludeOptionSmartPopup(broadcastId) {
        $.ajax({
            url: '/admin/broadcast/loadExcludeOption',
            type: "POST",
            data: {_token: '{{csrf_token()}}', broadcastId: broadcastId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    var smartContent = data.content;
                    $("#broadcastSmartPopupContainer").html(smartContent);
                }
            }
        });
    }

</script>