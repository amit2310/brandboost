<div class="tab-pane <?php echo ($defalutTab == 'config')? 'active': '';?>" id="right-icon-tab1">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-flat">
          <div class="panel-heading">
            <h6 class="panel-title">General</h6>
            <div class="heading-elements"><a href="#"><img src="/assets/images/more.svg"/></a></div>
          </div>
          <div class="panel-body p0">
            <form name="frmSettings" method="post" id="frmSettings">
            <div class="bbot p20">
                <div class="form-group">
                      <label class="control-label">Campaign Name</label>
                      <div class="">
                        <input name="referral_title" id="referral_title" class="form-control autoSave" value="<?php echo $oReferral->title != ''?$oReferral->title:''; ?>" type="text" placeholder="Referral Title">
                      </div>
                    </div>
                    <div class="form-group mb0">
                      <label class="control-label pull-left">Active Campaign</label>
                      <label class="custom-form-switch pull-right">
                      <input class="field autoSave" type="checkbox" name="referralStatus" value="1" <?php echo $oReferral->status == 'active'?'checked':"";?>>
                      <span class="toggle teal"></span> 
                      </label>
                     <div class="clearfix"></div>
                    </div>
                    
            </div>
            <div class="bbot p20">
               
                    <input type="hidden" name="refid" id="refid" value="<?php echo $programID; ?>" />
                    <div class="form-group">
                        <label>Store Name <?php echo $defalutTab; ?></label>
                        <div class="">
                            <input type="text" class="form-control autoSave" name="storeName" value="<?php echo ($oAccountSettings->store_name) ? ($oAccountSettings->store_name) : ''; ?>" placeholder="Your store name" required="required" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Store URL</label>
                        <div class="">
                            <input type="text" class="form-control autoSave" name="storeURL" value="<?php echo ($oAccountSettings->store_url) ? ($oAccountSettings->store_url) : ''; ?>" placeholder="Your store url e.g. http://mystorename.com" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <div class="">
                            <input type="text" class="form-control autoSave" name="storeEmail" value="<?php echo ($oAccountSettings->store_email) ? ($oAccountSettings->store_email) : ''; ?>" placeholder="Your store email address" required="required">
                        </div>
                    </div>
                
            </div>
            <div class="p20 hidden">
                <button type="submit" class="btn dark_btn w100 bkg_green configSetting">Save &amp; Continue</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-flat">
          <div class="panel-heading">
            <h6 class="panel-title">Sharing Content</h6>
            <div class="heading-elements"><a href="#"><img src="/assets/images/more.svg"/></a></div>
          </div>
          <div class="panel-body p0">
<div class="">
  <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right22">
    <div class="panel panel-white">
      <div class="panel-heading sidebarheadings active">
        <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right22" href="#accordion-control-right-group1111"><i class="icon-facebook"></i>Facebook</a> </h6>
      </div>
      <div id="accordion-control-right-group1111" class="panel-collapse collapse in">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Facebook Title</label>
                  <div class="">
                    <input name="firstname" id="firstname" class="form-control" type="text" required="" placeholder="Apple iPhone XR">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Facebook Descriptions</label>
                  <div class="">
                    
                    <textarea rows="4" class="form-control" placeholder="">The iPhone XR display has rounded corners that follow a beautiful curved design, and these corners are within a standard rectangle. When measured as a standard rectangular shape, the screen is 5.85 inches diagonally (actual viewable area is less).</textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Image</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="icon-upload7"></i></span>
                    <input name="domain" id="domain" class="form-control" required="" placeholder="or drag and drop file" type="text">
                  </div>
                </div>
                <div class="form-group mb10">
                  <label class="control-label">Preview</label>
                </div>
                
                <div class="referral_img">
                <div>
                    <img class="img-responsive" src="/assets/images/apple_phone.jpg"/>
                </div>
                    
                    <div class="p20">
                        <h3 class="fsize18 mt0 mb10">Apple iPhone XS</h3>
                        <p class="fsize12">The iPhone XS display has rounded corners that follow a beautiful curved design, and these corners are within a standard rectangle. When measured as a standard rectangular shape, the screen is 5.85 inches diagonally (actual viewable area is less).</p>
                        <a class="text-muted text-uppercase fsize12" href="#">apple.com</a>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-white">
      <div class="panel-heading sidebarheadings">
        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right22" href="#accordion-control-right-group2222"><i class="icon-twitter"></i>Twitter</a> </h6>
      </div>
      <div id="accordion-control-right-group2222" class="panel-collapse collapse">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12"> Conetent Goes here... </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-white">
      <div class="panel-heading sidebarheadings">
        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right22" href="#accordion-control-right-group3333"><i class="icon-mention"></i>Email / Link</a> </h6>
      </div>
      <div id="accordion-control-right-group3333" class="panel-collapse collapse">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12"> Conetent Goes here... </div>
          </div>
        </div>
      </div>
    </div>
   
  </div>
</div>

          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-flat">
          <div class="panel-heading">
            <h6 class="panel-title">Display settings</h6>
            <div class="heading-elements"><a href="#"><img src="/assets/images/more.svg"/></a></div>
          </div>
          <div class="panel-body p0">
            <div class="p25 bbot">
            
                        <div class="form-group">
                          <label class="control-label">Display automatically</label>
                        </div>
                        
                        
                <label class="custmo_radiobox mb10">
                <input type="radio" name="rad1" checked="">
                <span class="custmo_radiomark"></span>
                Button Widget
                </label>

                <label class="custmo_radiobox mb10">
                <input type="radio" name="rad1">
                <span class="custmo_radiomark"></span>
                Automatic Popup
                </label>
                
                <label class="custmo_radiobox mb10">
                <input type="radio" name="rad1" checked="">
                <span class="custmo_radiomark"></span>
                Leave Intent Popup
                </label>
                
                <label class="custmo_radiobox mb10">
                <input type="radio" name="rad1" checked="">
                <span class="custmo_radiomark"></span>
                Slider Widget
                </label>
                
                
                
                <div class="clearfix"></div>
                </div>
                
                <div class="p20">
                <div class="form-group">
                          <label class="control-label">Automatically expire link </label>
                        </div>
                        
                <label class="custmo_radiobox mb10">
                <input type="radio" name="rad2" checked="">
                <span class="custmo_radiomark"></span>
                Never Expire
                </label>
                
                <label class="custmo_radiobox mb10">
                <input type="radio" name="rad2" >
                <span class="custmo_radiomark"></span>
                Expire After
                </label>

                
                
                
                
                <div class="clearfix"></div>
                </div>
                
                
          </div>
        </div>
      </div>
    </div>
</div>

<!-- <div class="tab-pane <?php echo ($defalutTab == 'config')? 'active': '';?>" id="right-icon-tab1">
    <form name="frmSettings" method="post" id="frmSettings">
        <input type="hidden" name="refid" id="refid" value="<?php echo $programID; ?>" />
        <div class="row" style="padding:50px;">
            <div class="form-group">
                <label>Store Name <?php echo $defalutTab; ?></label>
                <input type="text" class="form-control" name="storeName" value="<?php echo ($oAccountSettings->store_name) ? ($oAccountSettings->store_name) : ''; ?>" placeholder="Your store name" required="required" >
            </div>

            <div class="form-group">
                <label>Store URL</label>
                <input type="text" class="form-control" name="storeURL" value="<?php echo ($oAccountSettings->store_url) ? ($oAccountSettings->store_url) : ''; ?>" placeholder="Your store url e.g. http://mystorename.com" required="required">
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="text" class="form-control" name="storeEmail" value="<?php echo ($oAccountSettings->store_email) ? ($oAccountSettings->store_email) : ''; ?>" placeholder="Your store email address" required="required">
            </div>

            <div class="clearfix"></div>

        </div>
        <div class="row pull-right">
            <button type="submit" id="saveSettings" class="btn bl_cust_btn bg-blue-600" name="submit" value="Save">Save & Next</button>
        </div>
    </form>
</div>     -->







<script>
    $(document).ready(function () {

        $(document).on('change', '.autoSave', function() {
           $('.configSetting').trigger('click');
        });

        $("#frmSettings").submit(function () {

            //$('.overlaynew').show();
            var formData = new FormData($(this)[0]);
            $('#saveSettings').prop("disabled", true);
            $.ajax({
                url: '<?php echo base_url('admin/modules/referral/saveSettings'); ?>',
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    $('.overlaynew').hide();
                    if (data.status == 'success') {
                        displayMessagePopup();
                        //window.location.href= '<?php echo base_url("/admin/modules/referral/setup/{$programID}?t=reward") ?>';
                    } else {

                        alertMessage('Error: Some thing wrong!');
                        //$('.overlaynew').hide();
                    }
                }
            });
            return false;
        });

    });
</script>