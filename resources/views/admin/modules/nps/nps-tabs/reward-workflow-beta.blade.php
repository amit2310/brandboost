
<!--########################TAB 4 ##########################-->
<div class="tab-pane {{ ($defalutTab == 'workflow') ? 'active' : '' }}" id="right-icon-tab3">
    @include('admin.workflow2.tree', array("oEvents" => $oEvents))
    <div class="row pull-right">
        <a href="javascript:void(0);" class="btn bl_cust_btn bg-blue-600 updateAllCampaign">Continue</a>
    </div>
</div>

<script>
    $('.updateAllCampaign').click(function () {
        var npsId = {{ $programID }};
        $.ajax({
            url: "{{ base_url('admin/modules/nps/updateAllCampaign') }}",
            type: "POST",
            data: {_token: '{{csrf_token()}}', nps_id: npsId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    window.location.href = "{{ base_url('/admin/modules/nps/setup/{$programID}?t=people') }}";
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }
        });
        return false;
    });
</script>

