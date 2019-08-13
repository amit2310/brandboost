<!--########################TAB 4 ##########################-->
<div class="tab-pane <?php echo ($defalutTab == 'workflow') ? 'active' : ''; ?>" id="right-icon-tab4">
    <?php $this->load->view("admin/workflow2/tree", array("oEvents" => $oEvents)); ?>

    <!-- <div class="row pull-right">
        <a href="javascript:void(0);" class="btn bl_cust_btn bg-blue-600 updateAllCampaign">Continue</a>
    </div> -->


</div>

<script>
    /*$('.updateAllCampaign').click(function () {
        var referralId = <?php echo $programID; ?>;
        $.ajax({
            url: '<?php echo base_url('admin/modules/referral/updateAllCampaign'); ?>',
            type: "POST",
            data: {referral_id: referralId},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    window.location.href = '<?php echo base_url("/admin/modules/referral/setup/{$programID}?t=advocates") ?>';
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }
        });
        return false;
    });*/

</script>
