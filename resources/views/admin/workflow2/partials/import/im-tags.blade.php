@php
    $oCampaignTags = $aContactSelectionData['oCampaignImportTags'];
    $aSelectedTags = array();
    if (!empty($oCampaignTags)) {
        foreach ($oCampaignTags as $oRec) {
            $aSelectedTags[] = $oRec->tag_id;
        }
    }
@endphp
<div class="panel panel-flat wfSwitchMenu" id="wfImportFromTags" style="display:none;">
    <div class="panel-heading">
        <h6 class="panel-title pull-left"><a style="color: #5e729d!important;" class="backtoImportOptionMenu"
                                             href="javascript:void(0);"> <i class=""><img width="20"
                                                                                          src="{{ base_url() }}assets/images/back_icon.png"/></i>
                &nbsp; Back</a></h6>
        <h6 class="panel-title pull-right">Add Contacts</h6>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body pt0 bkg_white" style="padding:0;">
        <div class="col-md-12">

            <div class="p20 bbot">
                <h3 class="fsize20 fw500 txt_dark m0">Include From Tags <span
                        id="totalTagCount">{{ count($aSelectedTags) }}</span></h3>

            </div>
            <div class="alert alert-danger" id="validateAddedContacts" style="display:none;">You did not add any
                contacts yet
            </div>


            <div class="p0">

                <table class="table" id="listImportTags">
                    <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th style="display: none;"></th>
                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_list_small.png"></i>Tag Name</th>
                        <th><i class=""><img src="{{ base_url() }}assets/images/icon_name.png"></i>Contacts</th>


                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $aTags = $aContactSelectionData['aTags'];
                        foreach ($aTags as $aTag):
                            $tagID = $aTag->tagid;
                            $oTagSubscribers = App\Models\Admin\WorkflowModel::getWorkflowTagSubscribers($tagID);
                    @endphp
                    <tr role="row">
                        <td style="display: none;">{{ date('m/d/Y', strtotime($aTag->tag_created)) }}</td>
                        <td style="display: none;" class="sorting_1">{{ $aTag->tagid }}</td>
                        <td>
                            <div class="media-left brig pr10">
                                <label class="custmo_checkbox ">
                                    <input type="checkbox" name="checkRows[]" class="addTagToCampaign"
                                           value="{{ $aTag->tagid }}"
                                           @if (in_array($aTag->tagid, $aSelectedTags))
                                           checked="checked"
                                        @endif
                                    >
                                    <span class="custmo_checkmark sblue"></span>
                                </label>
                            </div>
                            <div class="media-left media-middle pl10">
                                <a class="icons s24" href="#"><img src="{{ base_url() }}assets/images/icon_list.png"
                                                                   class="img-circle img-xs" alt=""></a>
                            </div>
                            <div class="media-left">
                                <div class=""><a href="javascript:void(0);"
                                                 class="text-default text-semibold">{{ $aTag->tag_name }}</a></div>
                            </div>
                        </td>
                        <td class="text-right">
                            <div class="media-left text-right pull-right">
                                <div class=""><a href="#" class="txt_grey">{{ count($oTagSubscribers) }}</a></div>
                            </div>
                        </td>
                    </tr>
                    @php
                        endforeach
                    @endphp

                    </tbody>
                </table>

            </div>


        </div>
    </div>


</div>
<script>
    var tableId = 'listImportTags';
    custom_data_table(tableId);
</script>
