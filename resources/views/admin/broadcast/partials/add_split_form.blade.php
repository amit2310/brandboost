<style>
    .variation_container{
        border-bottom: 1px solid #f4f6fa!important;
    }
</style>
<div class="split_container" id="split_container">
    @php
    if (!empty($oVariations)) {
        $k = 0;
        $bDefault = false;
        foreach ($oVariations as $oVariation) {
            $k++;
            $bDefault = false;
            if($k == 1){
                $bDefault=true;
                foreach($oTemplates as $oTemplate){
                    
                    if($oVariation->template_source == $oTemplate->id){
                        $aDefaultVariationTemplate = $oTemplate;
                        break;
                    }
                }
            }
            @endphp

            <div class="variation_container" id="variation_container_{{ $oVariation->id }}">
                <div class="p20">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Variation Name</label>
                                <input class="form-control h52 updateVariation" type="text" name="variation_name" value="{{ $oVariation->variation_name }}" variation_id="{{ $oVariation->id }}" name="variation_name" placeholder="Enter title for the variation" required="required">
                            </div>
                        </div>
                        <div class="col-md-1 text-right" style="top:30px!important;">
                            @if($bDefault == false)
                            <button class="btn dark_btn bkg_red btnDeleteVariation"  variation-id="{{ $oVariation->id }}">X</button>
                            @endif
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Choose Template</label>
                                <select class="form-control h52 updateVariation" name="variation_template" variation_id="{{ $oVariation->id }}" placeholder="" required="required" 
                                    @if($bDefault)
                                    {{ 'disabled="disabled"' }}
                                    @endif
                                    >
                                    @if($bDefault == true)
                                    <option>{{ $oTemplate->template_name }}</option>
                                    @endif
                                    <option value="">Choose Template</option>
                                    @if (!empty($oUserTemplates))
                                        @foreach ($oUserTemplates as $oTemplate)
                                            @if($oTemplate->user_id == $userData->id)
                                                <option value="{{ $oTemplate->id }}" @if($oVariation->template_source == $oTemplate->id) {{ 'selected="selected"' }} >
                                                    {{ $oTemplate->template_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>

                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Split Load(%)</label>
                                <input class="form-control h52 updateVariation" name="variation_load" variation_id="{{ $oVariation->id }}" required="required" type="number" value="{{ $oVariation->split_load }}" placeholder="e.g. 20%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
        }
    }
    @endphp

    
</div>    

<div class="row mt20">
    <div class="col-md-12 text-center">
        <button class="btn dark_btn {{ (strtolower($campaignType) == 'email') ? 'bkg_sblue2' : 'bkg_green' }}" name="btnAddMoreVariations" broadcast_id="{{ $oBroadcast->broadcast_id }}" id="btnAddMoreVariations">Add More Variations</button>
    </div>
</div>