<template>
    <div id="sms_template_preview_modal" class="modal fade" style="z-index:9999999;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h5 class="modal-title"><i class="fa fa-tags"></i>&nbsp; Preview Template</h5>
                </div>
                <div class="modal-body template_edit">
                    <form method="post" class="form-horizontal" action="javascript:void();">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="smsPreviewContainer"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name : 'sms-template-popups'
    }
</script>


