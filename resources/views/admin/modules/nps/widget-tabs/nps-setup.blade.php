
<div class="row">
    <div class="col-md-3">
        <div style="margin: 0;" class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">NPS Survey</h6>
                <div class="heading-elements"><a href="javascript:void(0);"><i class="icon-more2"></i></a></div>
            </div>
            <div class="tab-pane">
                <div class="profile_headings txt_upper p20 fsize11 fw600">Select NPS Survey <a class="pull-right plus_icon" href="javascript:void(0);"><i class="icon-arrow-down12 txt_grey fsize15"></i></a></div>
                <form method="post" name="frmSubmitNPSWidget" id="frmSubmitNPSWidget" action="javascript:void(0);">
                    {{ csrf_field() }}
                    <div class="p20">
                        <div class="row">
                            <div class="col-md-12">
                                <?php foreach ($oNPSList as $data) { ?>
                                    <div class="form-group mb10">
                                        <p class="pull-left mb0"><a href="<?php echo base_url('admin/modules/nps/' . $data->id); ?>" target="_blank"><?php echo $data->title; ?></a></p>
                                        <label class="custom-form-switch pull-right">
                                            <input class="field autoSaveNPSWidget" type="checkbox" data-hashcode="<?php echo $data->hashcode; ?>" id="nps_id_<?php echo $data->id; ?>" name="nps_id" value="<?php echo $data->id; ?>" 
                                                   <?php echo $data->id == $widgetData->nps_id ? 'checked' : ''; ?>>
                                            <span class="toggle dred"></span> 
                                        </label>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php } ?>
                            </div>
                            <input type="hidden" name="widget_id" id="widget_id" value="<?php echo $widgetData->id; ?>">
                            <button class="hidden saveNPSWidget btn dark_btn h52 w100 bkg_purple" type="submit"> Save NPS Widget </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php //echo $sEmailPreview; ?>
    <div class="col-md-9">
        <div style="margin: 0;" class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Preview</h6>
                <div class="heading-elements"><a href="javascript:void(0);"><i class="icon-more2"></i></a></div>
            </div>
            <div class="panel-body p20">
                @include('admin.modules.nps.nps-tabs.partials.web-widget-only')
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var hashcodeVal = '';
        var npsId = '';
        $('.autoSaveNPSWidget').change(function () {
            var npsCheckedVal = $(this).is(":checked");
            npsId = $(this).val();
            hashcodeVal = $(this).attr('data-hashcode');
            $('.autoSaveNPSWidget').each(function () {
                if ($(this).val() != npsId) {
                    $(this).attr('checked', false);
                }
            });

            if (npsCheckedVal === true) {
                setTimeout(function () {
                    $('.saveNPSWidget').trigger('click');
                }, 200);
            } else {
                $('#npsWidgetSection').html('');
            }
        });

        $('#frmSubmitNPSWidget').on('submit', function (e) {
            e.preventDefault();
            var widgetId = $('#widget_id').val();
            $.ajax({
                url: "<?php echo base_url(); ?>/admin/modules/nps/addNPSWidgetSurvey",
                method: "POST",
                data: {_token: '{{csrf_token()}}', 'hashcode': hashcodeVal, 'nps_id': npsId, 'widget_id': widgetId},
                dataType: "json",
                success: function (data)
                {
                    if (data.status == "success")
                    {
                        $('#npsWidgetSection').html(data.preview);
                        $('#npsScriptCode').html(data.npsScriptCode);
                        displayMessagePopup();
                    } else {
                        displayMessagePopup('error');
                    }
                }
            });
        });
    });
</script>					