@if (!empty($oCampaignTags))
    @foreach ($oCampaignTags as $oRec)
        $aSelectedTags[] = $oRec->tag_id;
    @endforeach
@endif
<div class="row" id="tagSection"
@if ($oBroadcast->audience_type != 'tags')
    {!! 'style="display:none;"' !!}>
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <span class="pull-left">
                    <h6 class="panel-title">{{ count($aTags) }} Tags</h6>

                </span>
                <div class="heading_links pull-left">
                    <button type="button" class="btn btn-xs btn_white_table bkg_blue ml20"
                            style="background:#4285f4!important;background-color:#4285f4!important;color:#ffffff!important;">
                        <span id="totalTagCount">{{ count($aSelectedTags) }}</span> tags added
                    </button>

                </div>


                <div class="heading-elements">
                    <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                        <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                        <div class="form-control-feedback">
                            <i class=""><img src="{{ base_url() }}assets/images/icon_search.png" width="14"></i>
                        </div>

                    </div>
                    <a href="javascript:void(0);" class="btn dark_btn bkg_blue selectAudience" style="margin-top:-8px;">Change
                        Selection</a>

                </div>

            </div>
            <div class="panel-body p0">
                <table class="table datatable-basic">
                    <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th style="display: none;"></th>
                        <th class="nosort" style="width:30px;"></th>

                        <th>
                            <i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Tag Name
                        </th>
                        <th><i class="icon-calendar"></i>Created</th>
                        <th>
                            <div class="media-left"><i class="icon-stack-star"></i>Group Name</div>
                        </th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($aTags as $aTag)

                        <tr>
                            <td style="display: none;">{{ date('m/d/Y', strtotime($aTag->tag_created)) }}</td>
                            <td style="display: none;">{{ $aTag->tagid }}</td>
                            <td>
                                <label class="custmo_checkbox pull-left">
                                    <input type="checkbox" name="checkRows[]" class="addTagToCampaign"
                                           value="{{ $aTag->tagid }}"
                                           @if (in_array($aTag->tagid, $aSelectedTags))
                                           checked="checked"
                                        @endif >
                                    <span class="custmo_checkmark"></span>
                                </label>
                            </td>

                            <td>
                                {{ $aTag->tag_name }}
                            </td>

                            <td>
                                {{ dataFormat($aTag->tag_created) }}
                            </td>

                            <td>
                                {{ $aTag->group_name }}
                            </td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <input type="hidden" name="automation_id" value="{{ $oBroadcast->broadcast_id }}"/>
            </div>
        </div>
    </div>
</div>
