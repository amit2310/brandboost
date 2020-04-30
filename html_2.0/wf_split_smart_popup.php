<div class="box" style="width: 424px; display:block; border-color:#67B7E4!important">
  <div style="width: 424px;overflow: hidden; height: 100%;">
    <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slidebox"><i class=""><img src="assets/images/cross.svg"/></i></a>
      <div class="p40">
        <div class="row">
          <div class="col-md-12"> <img width="44" src="assets/images/split_icon_44.svg"/>
            <h3 class="htxt_medium_24 dark_800 mt20">Split Test</h3>
            <p class="fsize14 dark_200 mb0 mt-1">Which event should trigger this automation?</p>
            <hr class="mt25 mb30">
          </div>
          
          
           <div class="col-md-12">
          	<div class="form-group">
                <label for="campaignname" class="fsize11 fw500 dark_600 ls4">SPLIT TEST NAME</label>
                <!--<select class="form-control h50 form-control-custom dark_800">
                	<option>Submitted a form</option>
                    <option>Submitted a form</option>
                    <option>Choose a trigger...</option>
                    <option>Choose a trigger...</option>
                </select>-->
                <input type="text" class="form-control h50" placeholder="Enter new split test name"/>
                
                
                
                
                
              </div>
              
              <div class="form-group mb30">
                <label for="campaignname" class="fsize11 fw500 dark_600 ls4">SPLIT INTO</label>
                <select class="form-control h50 form-control-custom dark_800">
                	<option>2 paths (A/B)</option>
                    <option>2 paths (A/B)</option>
                    
                </select>
              </div>
          </div>
          
          
          <div class="col-md-9">
              <div class="form-group">
                <label for="campaignname" class="fsize11 fw500 dark_600 ls4">DISTRIBUTE TRAFFIC EVENLY</label>
              </div>
          </div>
          
          <div class="col-md-3">
          <p class="m0 fsize11 email_400 fw500 float-left">YES</p>
            <label class="custom-form-switch float-right">
			  <input class="field" type="checkbox" checked="checked" >
			<span class="toggle email"></span>		</label>
          </div>
          
          <div class="col-md-12">
          	<div class="form-group">
                <label for="campaignname" class="fsize11 fw500 dark_600 ls4">PATHS PERCENTAGES</label>
                <div class="row">
                <div class="col-12">
                <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14"/>
                </div>
                <div class="col-6 pr5">
                <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text blue_300" style="width:48px; padding:0 17px; background: rgba(165, 206, 255, 0.1); border-color:#E1E9F6;">A</span>
  </div>
  <input type="text" class="form-control h48 brig_nonr" value="75">
  <div class="input-group-append bkg_light_000">
    <span class="input-group-text bkg_light_000 dark_100" style="border-color:#E1E9F6; width:48px; padding:0 17px;">%</span>
  </div>
</div>
                </div>
                <div class="col-6 pl5">
                <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text green_400" style="width:48px; padding:0 17px; background: rgba(148, 215, 169, 0.1); border-color:#E1E9F6;">B</span>
  </div>
  <input type="text" class="form-control h48 brig_nonr" value="25">
  <div class="input-group-append bkg_light_000">
    <span class="input-group-text bkg_light_000 dark_100" style="border-color:#E1E9F6; width:48px; padding:0 17px;">%</span>
  </div>
</div>
                </div>
                </div>
                
              </div>
          </div>
         
          
          
          
          
          
          <div class="col-md-9">
              <div class="form-group">
                <label for="campaignname" class="fsize11 fw500 dark_600 ls4 text-uppercase">Conditional Split</label>
              </div>
          </div>
          
          <div class="col-md-3">
          <p class="m0 fsize11 light_800 fw500 float-left">YES</p>
            <label class="custom-form-switch float-right">
			  <input class="field" type="checkbox" checked="checked" >
			<span class="toggle email"></span>		</label>
          </div>
          
          
           <div class="col-md-12">
           <hr class="mt0" />
          <p class="fsize14 dark_400">Spit traffic and send contacts to Path B until...</p>
          <div class="form-group">
                <label for="campaignname" class="fsize11 fw500 dark_600 ls4">THE FOLLOWING condition is met:</label>
                <select class="form-control h50 form-control-custom dark_800">
                	<option>X contacts have been sent to Path B</option>
                    <option>X contacts have been sent to Path B</option>
                    
                </select>
              </div>
              
              <div class="form-group mb30">
                <label for="campaignname" class="fsize11 fw500 dark_600 ls4">NUMBER OF CONTACTS</label>
                <select class="form-control h50 form-control-custom dark_800">
                	<option>500</option>
                    <option>1000</option>
                    
                </select>
              </div>
           
          </div>
          
          
          
          
          
          
          
          
        </div>


       <!-- <div class="row bottom-position">-->
        <div class="row">
          <div class="col-md-12 mb15">
            <hr>
          </div>
          <div class="col-md-12">
            <button class="btn btn-md bkg_email_400 light_000 pr20 min_w_160 fsize13 fw500 mr20">Run Split Test</button>
            <button class="btn btn-md bkg_light_000 dark_200 pr20 fsize13 fw500 border">Close</button>
            
        </div>
       
      </div>
    </div>
  </div>
</div>





