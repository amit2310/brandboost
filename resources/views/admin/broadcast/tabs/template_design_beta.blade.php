<div id="broadcastDesignTemplate" class="broadcastTab"
     @if ($activeTab != 'Design Template Edit')
     style="display:none;"
    @endif>
    <div class="row">
        <div class="col-md-12">
            <div class="white_box mb20 p10">
                <iframe
                    src="{{ base_url("admin/workflow/loadStripoCampaign/$moduleName/{$oBroadcast->id}/{$oBroadcast->broadcast_id}") }}"
                    id="loadstripotemplate" scrolling="no" width="100%" height="1800"
                    style="overflow:hidden; border:none!important;"></iframe>
            </div>
        </div>
    </div>

</div>
