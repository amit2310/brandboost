<tbody>
@php
if (!empty($oData)) {
    foreach ($oData as $oRow) {
        if (!($oRow->deleted || $oRow->delete_status || $oRow->status == '3' || $oRow->status == 'archive')) {
            if ($moduleName == 'onsite') {
                $campaignName = $oRow->brand_title;
                $moduleUnitID = $oRow->id;
                $ratings = getCampaignReviewRA($oRow->id);
                $brandImgArray = unserialize($oRow->brand_img);
                $brand_img = $brandImgArray[0]['media_url'];

                if (empty($brand_img)) {
                    $imgSrc = base_url('assets/images/default_table_img2.png');
                } else {
                    $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
                }
            }else if ($moduleName == 'offsite') {
                $campaignName = $oRow->brand_title;
                $moduleUnitID = $oRow->id;
                $ratings = getCampaignReviewRA($oRow->id);
                $brandImgArray = unserialize($oRow->brand_img);
                $brand_img = $brandImgArray[0]['media_url'];

                if (empty($brand_img)) {
                    $imgSrc = base_url('assets/images/default_table_img2.png');
                } else {
                    $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
                }
            } else if ($moduleName == 'nps') {
                $campaignName = $oRow->title;
                $moduleUnitID = $oRow->hashcode;
                $imgSrc = base_url('assets/images/default_table_img2.png');

            }else if ($moduleName == 'referral') {
                $campaignName = $oRow->title;
                $moduleUnitID = $oRow->hashcode;
                $imgSrc = base_url('assets/images/default_table_img2.png');

            }else {
                $campaignName = $oRow->title;
                $moduleUnitID = $oRow->id;
            }
            @endphp
            <tr>
                <td>
                    <div class="media-left">
                        <label class="custmo_checkbox">
                            <input type="checkbox" name="aCampaign[{{ $moduleName }}][]" value="{{ $moduleUnitID }}">
                            <span class="custmo_checkmark blue"></span>
                        </label>
                    </div>
                    <div class="media-left">
                        <img class="br5" width="24" height="24" src="{{ $imgSrc }}"/>
                    </div>
                    <div class="media-left">
                        <a href="#" class="text-default text-semibold bbot">{{ ($campaignName) ? $campaignName : '[No Data]' }}</a>
                    </div>
                </td>
                <td>
                    <div class="media-left pl10 pr10 brig blef" style="min-width:81px;">
                        @if (!empty($ratings) && ($ratings !='nan') && ($ratings>0))
                            <span class="pt-1 pull-left mr10">
                                {{ number_format($ratings,1) }}
                            </span>
                            @if ($ratings >= 4)
                                <img width="20" src="{{ base_url("assets/images/smiley_green_26.png") }}"/>
                            @elseif ($ratings == 3)
                                <img width="20" src="{{ base_url("assets/images/smiley_grey_26.png") }}"/>
                            @elseif ($ratings < 3)
                                <img width="20" src="{{ base_url("assets/images/smiley_red_26.png") }}"/>
                            @endif
                        @else
                            {!! displayNoData() !!}
                        @endif
                    </div>
                </td>
                <td class="text-right">{!! dataFormat($oRow->created) !!}</td>
            </tr>

            @php
        }
    }
}
@endphp
</tbody>
