<div class="variation_container" id="variation_container_{{ $variationID }}">
    <div class="p20">
        <div class="row">
            <div class="col-md-11">
                <div class="form-group">
                    <label>Variation Name</label>
                    <input class="form-control h52 updateVariation" type="text" variation_id="{{ $variationID }}" value="" name="variation_name" placeholder="Enter title for the variation" required="required">
                </div>
            </div>
            <div class="col-md-1 text-right" style="top:30px!important;">
                <button class="btn dark_btn bkg_red btnDeleteVariation"  variation-id="{{ $variationID }}">X</button>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label>Choose Template</label>
                    <select class="form-control h52 updateVariation" name="variation_template" variation_id="{{ $variationID }}" placeholder="" required="required">
                        <option value="">Choose Template</option>
                        @php
                        $i = 0;
                        $i++;
                        @endphp
                        @if (!empty($oUserTemplates))
                            @foreach ($oUserTemplates as $oTemplate)
                                <option value="{{ $oTemplate->id }}">{{ $oTemplate->template_name }}</option>
                            endforeach;
                        @endif
                        
                    </select>

                </div>

            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label>Split Load(%)</label>
                    <input class="form-control h52 updateVariation" required="required" type="number" value="" name="variation_load" variation_id="{{ $variationID }}" placeholder="e.g. 20%">
                </div>
            </div>
        </div>
    </div>
</div>    

