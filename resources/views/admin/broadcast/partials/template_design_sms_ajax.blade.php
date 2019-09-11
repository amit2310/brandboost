@php
    $aCampaignTags = config('bbconfig.email_tags');

    $smsCharCount = strlen(preg_replace("!<br.*?>!is", "\n", trim(base64_decode($oBroadcast->stripo_compiled_html))));
    $smsPartsCount = $smsCharCount / 160;
@endphp
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">SMS Editor</h6>
                <div class="heading-elements"><a href="javascript:void(0);"><img alt=""
                            src="{{ base_url() }}assets/images/more.svg"></a></div>
            </div>
            <div class="panel-body p0 bkg_white min_h567">
                <form method="post" class="form-horizontal" id="saveWorkflowSmsTemplate" action="javascript:void(0);">
                    <div class="p30">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>SMS Template</label>
                                    <input class="form-control h52" type="text" value="{{ $oBroadcast->name }}"
                                           placeholder="Brandboost.io" readonly>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group position-relative">
                                    <div class="row">
                                        <div class="col-md-4"><label>SMS Content</label></div>
                                        <div class="col-md-8 text-right" style="color:#4ebc86;">Characters: <span
                                                class="smsCount {{ $smsCharCount == 918 ? 'active' : '' }}"><span
                                                    id="charactersCount">{{ $smsCharCount }}</span>/918</span> &nbsp;
                                            &nbsp; &nbsp; Parts: <span
                                                class="smsCount {{ ceil($smsPartsCount) == 6 ? 'active' : '' }}"><span
                                                    id="smsPartsCount">{{ ceil($smsPartsCount) }}</span>/6</span> &nbsp;
                                        </div>
                                    </div>
                                    <div class="border br5">
                                        <textarea class="form-control p25 min_h220 fsize12 txt_grey"
                                                  style="height: 200px; border:none;" created_date=""
                                                  name="smsWorkflowTemplateBody" id="smsWorkflowTemplateBody"
                                                  maxlength="918"
                                                  placeholder="SMS body">{!! preg_replace("!<br.*?>!is", "\n", trim(base64_decode($oBroadcast->stripo_compiled_html))) !!}</textarea>

                                        @if (!empty($aCampaignTags))
                                            <div class="p-15 btop smstagbox"
                                                 style="position: relative!important; overflow-y:scroll; height:110px;">
                                                @foreach ($aCampaignTags as $sTag)
                                                    <button type="button" data-toggle="tooltip"
                                                            title="Click to insert Tag" data-tag-name="{{ $sTag }}"
                                                            class="btn btn-xs btn_white_table pr10 draggable insert_tag_button">{{ $sTag }}</button>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 pt-5">
                                <button class="btn dark_btn bkg_green h40" id="saveStripoChanges"
                                        notification-mod="silent" style="min-width: 92px;float: left;">Save
                                </button>
                                <input type="hidden" name="wf_editor_campaign_id" id="wf_sms_editor_template_id"
                                       value="">
                                <input type="hidden" name="wf_editor_moduleName" id="wf_sms_editor_moduleName"
                                       value="{{ $moduleName }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="col-md-8">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Preview</h6>
                <div class="heading-elements"><a href="javascript:void(0);"><img alt=""
                            src="{{ base_url() }}assets/images/more.svg"></a></div>
            </div>
            <div class="panel-body p20 bkg_white min_h567">
                <div class="sms_preview_new">
                    <p class="text-center txt_grey" style="font-size: 7px;">{{ date("h:i") . ' ' . dataFormat() }}</p>
                    <div
                        class="sms_text_bubble_grey smsWorkflowTemplatePreview">{!! nl2br(base64_decode($oBroadcast->stripo_compiled_html)) !!}</div>
                    <div class="clearfix"></div>
                    <div class="sms_text_bubble_blue">Thanks</div>
                </div>
            </div>
        </div>
    </div>
</div>
