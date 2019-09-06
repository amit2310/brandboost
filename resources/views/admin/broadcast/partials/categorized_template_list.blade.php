@php
$templateCount = 0;
$tempName = $campaignType;
@endphp
<div class="top"></div>
<table class="table" id="tblBroadcastTemplate" style="background: none!important; width: 100%!important;">
    <thead class="hidden">
        <tr style="display: none;">

            <th style="display: none;"></th>
            <th style="display: none;"></th>
            <th><i class="icon-image2"></i>Template Name</th>
            <th style="display: none;"></th>
        </tr>
    </thead>
    <tbody>
        @php
        $imgArr = array('template_prev1.png', 'template_prev2.png', 'template_prev3.png', 'template_prev4.png', 'template_prev5.png', 'template_prev6.png', 'template_prev7.png', 'template_prev8.png');
        if (!empty($oCategorizedTemplates)) {
            foreach ($oCategorizedTemplates as $oTemplate) {                
                if (($oTemplate->status == '1') && (strtolower($oTemplate->template_type) == $tempName)){
                    $bYesSelected = false;
                    if ($selected_template == $oTemplate->id && $source != 'draft') {
                        $bYesSelected = true;
                    }
                    @endphp


                    <tr class="template_row">
                        <td style="display: none;"></td>
                        <td style="display: none;">{{ $oTemplate->id }}</td>
                        <td>
                            <div class="white_box template_preview ">
                                <label class="custmo_checkbox">
                                    <input type="radio" class="continueChooseTemplateButton" template_id="{{ $oTemplate->id }}" source="{{ $source }}" name="selectedTemplate" value="{{ $oTemplate->id }}" id="templateID_{{ $oTemplate->id }}" @if ($bYesSelected) {{ 'checked="checked"' }}>
                                    <span class="custmo_checkmark sblue"></span>
                                </label>
                                <label for="templateID_{{ $oTemplate->id }}" class="m0">
                                    @if ($tempName == 'email')
                                        <img src="{{ base_url() }}assets/images/{{ $oTemplate->preview_icon }}"/>
                                    @endif
                                    @if ($tempName == 'sms')
                                        <div class="customsmspreview" style="display:block;width:165px;height:140px;padding:5px;">{!! setStringLimit(base64_decode($oTemplate->stripo_compiled_html), 120) !!}</div>
                                    @endif

                                    <a class="
                                       @if ($tempName == 'email') 
                                        {{ 'email_preview_button'}} 
                                       @else 
                                        {{'sms_preview_button'}} 
                                       @endif 
                                       previewDefaultTemplate small" href="javascript:void(0);" template_id="{{ $oTemplate->id }}" source="{{ $source }}"><i class="icon-eye8"></i></a>
                                    <div class="content_bx">
                                        <p>{{ $oTemplate->template_name }}</p>
                                    </div>
                                </label>
                            </div>
                        </td>
                        <td style="display: none;">&nbsp;

                        </td>
                    </tr>

                    @php
                }
            }
        }else {
            @endphp
            <tr class="mt20"><td style="display: none;"></td><td style="display: none;"></td><td class="text-center">No Template Found</td></tr>
                @php } @endphp

    </tbody>
</table>

