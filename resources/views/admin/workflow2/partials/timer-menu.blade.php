<div class="panel panel-flat wfSwitchMenu" id="wfTimerMenu" style="display:none;">
    <div class="panel-heading">
        <h6 class="panel-title pull-left"><a style="color: #5e729d!important;" class="backtoMenu" href="javascript:void(0);"> <i class=""><img width="20" src="<?php echo base_url(); ?>assets/images/back_icon.png"/></i> &nbsp; Back</a></h6>
        <h6 class="panel-title pull-right">Time trigger</h6>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body p20 pt0 bkg_white">
        <div class="profile_headings m0 mb10">CONFIGURATION </div>

        <div class="row">
            <div class="col-md-4">

                <div class="form-group bbot pb20">
                    <label class="control-label">Time</label>
                    <input type="number" name="delay_value" value="10" id="wf_timer_event_value" class="form-control h52" />
                </div>

            </div>
            <div class="col-md-8">
                <div class="form-group bbot pb20">
                    <label class="control-label">&nbsp;</label>
                    <select name="delay_unit" id="wf_timer_event_unit" class="form-control h52">
                        <option value="minute" selected="">Minute(s)</option>
                        <option value="hour">Hour(s)</option>
                        <option value="day">Day(s)</option>
                        <option value="week">Week(s)</option>
                        <option value="month">Month(s)</option>
                        <option value="year">Year(s)</option>
                    </select>
                </div>
            </div>
            
            <input type="hidden" id="wf_timer_event_id" value="" />
            <input type="hidden" name="moduleName" value="<?php echo $moduleName;?>" id="wf_timer_moduleName" />
        </div>



        <div class="">
            <label class="custmo_checkbox pull-left mb0">
                <input type="checkbox" checked="checked">
                <span class="custmo_checkmark"></span>
                &nbsp;Enable time and day window
            </label>
            <div class="clearfix"></div>

        </div>

    </div>
</div> 