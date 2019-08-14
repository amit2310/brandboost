<style type="text/css">
    .note-editor .note-toolbar { height:180px!important; }
    .note-toolbar {height: 180px!important; }
    .note-editor .note-codable { background-color: #000!important; }
    .email-container.table_main_mr{ margin: -136px 0px 0 -92px!important; transform: scale(0.7); } 
    .note-toolbar {display:none;}
    .overlaynew {z-index:999999999999999999999999999!important;}
</style>

<div class="box emailNotificationShow" style="width: 900px;">
    <div style="width: 900px;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">

<!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
<div class="row" style="height: 100%;">
               
               <!---------------Headings----------------->
                <div class="col-md-5 pr0 brig">
                    <a style="left: 35px; top: 15px;" class="reviews emailNotifictionBack slide-toggle bkg_grey_light" ><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_arrow_left.png"/></i></a> 
                    <h5 style="padding-left: 75px;" class="panel-title">Notification Email</h5>
                </div>
                <div class="col-md-7 pl0">
                    <h5 style="padding-left: 20px;" class="panel-title">Preview</h5>
                </div>
                

                
                <!---------------Left----------------->
                <form method="post" id="frmEditEmailTemplate" action="javascript:void();">
                <div class="col-md-5 pr0 brig" style="height: calc(100% - 56px);">
                    <div class="p20">
                     <div class="">
                                        <div class="showEmailMsg" style="color: green;"></div>
                                        <div class="showEmailErrMsg" style="color: red;"></div>
                                        <div class="form-group hidden">
                                          <label>Email template</label>
                                          <select class="form-control h52 eventEmailTag" name="template_tag">
                                            <?php 
                                            if(!empty($oEmailTemplates)) {
                                                foreach ($oEmailTemplates as $oTemplate) {
                                                    ?><option value="<?php echo $oTemplate->template_tag; ?>"><?php echo $oTemplate->title; ?></option><?php
                                                }
                                            } ?>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                          <label>Type</label>
                                          <!-- <input name="eventEmailType" placeholder="" class="form-control h52 eventEmailType" required="" type="text" readonly> -->
                                          <select class="form-control h52 eventEmailType" name="eventEmailType">
                                           <option value="admin">Admin</option>
                                           <option value="client">Client</option>
                                           <option value="user">User</option>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                          <label>Title</label>
                                          <div class="">
                                            <input name="title" placeholder="" class="form-control h52 emailTitle" required="" type="text">
                                          </div>
                                        </div>
                                        <div class="form-group eSubject adminSubject">
                                          <label>Subject</label>
                                          <div class="">
                                            <input name="admin_subject" placeholder="" id="" class="form-control h52 emailSubjectAdmin" type="text">
                                          </div>
                                        </div>

                                        <div class="form-group eSubject clientSubject" style="display: none;">
                                          <label>Subject</label>
                                          <div class="">
                                            <input name="subject" placeholder="" id="" class="form-control h52 emailSubjectClient" type="text">
                                          </div>
                                        </div>

                                        <div class="form-group eSubject userSubject" style="display: none;">
                                          <label>Subject</label>
                                          <div class="">
                                            <input name="user_subject" placeholder="" id="" class="form-control h52 emailSubjectUser" type="text">
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label>Greetings</label>
                                          <div class="">
                                            <input name="" placeholder="" id="" class="form-control h52 greetingMsgType" value="Hey , {FIRSTNAME} {LASTNAME}" required="" type="text">
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label>Email Preview</label>
                                          <div class="">
                                            <input class="form-control h52 testEmailNotificationpre" type="text" name="testEmailSubEdit" value="" placeholder="Enter email">
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label>Content</label>
                                          <div class="position-relative">
                                          <a class="fsize14 open_editor oEditor" href="javascript:void();"><i class=""><img src="<?php echo base_url(); ?>assets/images/open_editor.png"> </i> &nbsp; Open editor</a>
                                          <a class="fsize14 open_editor view_editor" href="javascript:void();" style="display: none;"><i class=""><img src="<?php echo base_url(); ?>assets/images/open_editor.png"> </i>  &nbsp; View</a>
                                        <textarea class="form-control min_h330 border p20 fsize12 shadow greetingTextType" style="box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; resize: none; padding-top: 65px!important;">Helen provided excellent customer service and made our introduction to a new company an wonderful experience. Your checklist helped us to avoid leaving off important information. Thank you for your thoughtful and thorough customer service. Fantastic experience with Kevin! 

Wasn't so happy with the quality of my purchase... no questions asked, they immediately exchanged it at no charge. The replacement is perfect and I couldn't be happier! I will purchase from them again ...</textarea> 
                                            <!-- <textarea class="summernote" rows="8"></textarea> -->
                                          </div>
                                        </div>
                                        
                                        
                                  </div>   
                    </div>
                    
                        <div class="btop p20 pl30 bkg_white" style="position: absolute; bottom: 0; width: 100%; left: 0;">
                        <input type="hidden" name="edit_content_type" value="html">
                        <input type="hidden" name="template_id" class="template_id" value="">
                        <button type="submit" class="btn dark_btn h52 mr20 bkg_blue_light" style="min-width: 108px;">Save</button>
                        <!-- <button style="min-width:120px;" type="button" class="btn btn-link h52 sendNotiEmailPreview">Send test email</button> -->
                        </div>
                        
                        
                </div>
                
                
                <!---------------Right----------------->
                <div class="col-md-7 pl0" style="height: calc(100% - 56px);">
                 <div class="p30" >
                        <textarea name="admin_text" class="summernote emailTextAdmin emailTextArea" rows="8"></textarea>
                        <textarea name="plain_text" class="summernote emailTextClient emailTextArea" rows="8"></textarea>
                        <textarea name="user_text" class="summernote emailTextUser emailTextArea" rows="8"></textarea>
                        
                    </div>
                </div>
                </form>

            </div>
<!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->





        </div>                  
    </div>
</div>   


<!-- ******************* sms notification *********************** -->
<div class="box smsNotificationShow" style="width: 400px">
    <div style="width: 100%;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">

<!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
<div class="row" style="height: 100%;">
               
               <!---------------Headings----------------->
                <div class="col-md-12 pr0 brig">
                    <a style="left: 35px; top: 15px;" class="reviews smsNotifictionBack slide-toggle bkg_grey_light" ><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_arrow_left.png"/></i></a> 
                    <h5 style="padding-left: 75px;" class="panel-title">Notification SMS</h5>

                    <form method="post" id="frmEditSMSTemplate" action="javascript:void();">
                <div class="col-md-12 pr0 brig" style="height: calc(100% - 56px);">
                    <div class="p20">
                     <div class="">
                                        <div class="showEmailMsg" style="color: green;"></div>
                                        <div class="showEmailErrMsg" style="color: red;"></div>
                                        <div class="form-group hidden">
                                          <label>Email template</label>
                                          <select class="form-control h52 eventEmailTag" name="template_tag">
                                            <?php 
                                            if(!empty($oEmailTemplates)) {
                                               foreach ($oEmailTemplates as $oTemplate) {
                                                    ?><option value="<?php echo $oTemplate->template_tag; ?>"><?php echo $oTemplate->title; ?></option><?php
                                                } 
                                            }?>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                          <label>Type</label>
                                         
                                          <select class="form-control h52 eventSMSType" name="eventSMSType">
                                           <option value="admin">Admin</option>
                                           <option value="client">Client</option>
                                           <option value="user">User</option>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                          <label>Title</label>
                                          <div class="">
                                            <input name="title" placeholder="" class="form-control h52 emailTitle" required="" type="text">
                                          </div>
                                        </div>
                                       

                                        <div class="form-group">
                                          <label>Content</label>
                                          <div class="position-relative">
                                          <textarea name="admin_sms_content" class="form-control min_h330 border p20 fsize12 shadow admin_sms_content" style="box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; "></textarea> 
                                          <textarea name="client_sms_content" class="form-control min_h330 border p20 fsize12 shadow client_sms_content" style="box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; display: none;"></textarea> 
                                          <textarea name="user_sms_content" class="form-control min_h330 border p20 fsize12 shadow user_sms_content" style="box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; display: none;"></textarea> 
                                          </div>
                                        </div>
                                        
                                        
                                  </div>   
                    </div>
                    
                        <div class="btop p20 pl30 bkg_white" style="position: absolute; bottom: 0; width: 100%; left: 0;">
                        <input type="hidden" name="template_id" class="template_id" value="">
                        <button type="submit" class="btn dark_btn h52 mr20 bkg_blue_light" style="min-width: 108px;">Save</button>
                      
                        </div>
                        
                        
                </div>
                
                
                <!---------------Right----------------->
                <!-- <div class="col-md-7 pl0" style="height: calc(100% - 56px);">
                 <div class="p30" >
                        <textarea name="admin_text" class="summernote emailTextAdmin emailTextArea" rows="8"></textarea>
                        <textarea name="plain_text" class="summernote emailTextClient emailTextArea" rows="8"></textarea>
                        <textarea name="user_text" class="summernote emailTextUser emailTextArea" rows="8"></textarea>
                        
                    </div>
                </div> -->
                </form>

                </div>
               <!--  <div class="col-md-7 pl0">
                    <h5 style="padding-left: 20px;" class="panel-title">Preview</h5>
                </div> -->
                

                
                <!---------------Left----------------->
                
            </div>
<!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->





        </div>                  
    </div>
</div>  
<!-- ******************* end sms notification *********************-->


<!-- ******************* system notification *********************** -->
<div class="box systemNotificationShow" style="width: 400px">
    <div style="width: 100%;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">

<!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
<div class="row" style="height: 100%;">
               
               <!---------------Headings----------------->
                <div class="col-md-12 pr0 brig">
                    <a style="left: 35px; top: 15px;" class="reviews systemNotifictionBack slide-toggle bkg_grey_light" ><i class=""><img src="<?php echo base_url(); ?>assets/images/icon_arrow_left.png"/></i></a> 
                    <h5 style="padding-left: 75px;" class="panel-title">Notification System</h5>

                    <form method="post" id="frmEditSystemTemplate" action="javascript:void();">
                <div class="col-md-12 pr0 brig" style="height: calc(100% - 56px);">
                    <div class="p20">
                     <div class="">
                                        <div class="showEmailMsg" style="color: green;"></div>
                                        <div class="showEmailErrMsg" style="color: red;"></div>
                                       

                                        <div class="form-group">
                                          <label>Type</label>
                                         
                                          <select class="form-control h52 eventSystemType" name="eventSystemType">
                                           <option value="admin">Admin</option>
                                           <option value="client">Client</option>
                                           <option value="user">User</option>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                          <label>Title</label>
                                          <div class="">
                                            <input name="title" placeholder="" class="form-control h52 emailTitle" required="" type="text">
                                          </div>
                                        </div>
                                       

                                        <div class="form-group">
                                          <label>Content</label>
                                          <div class="position-relative">
                                          <textarea name="admin_system_content" class="form-control min_h330 border p20 fsize12 shadow admin_system_content" style="box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; "></textarea> 
                                          <textarea name="client_system_content" class="form-control min_h330 border p20 fsize12 shadow client_system_content" style="box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; display: none;"></textarea> 
                                          <textarea name="user_system_content" class="form-control min_h330 border p20 fsize12 shadow user_system_content" style="box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; display: none;"></textarea> 
                                          </div>
                                        </div>
                                        
                                        
                                  </div>   
                    </div>
                    
                        <div class="btop p20 pl30 bkg_white" style="position: absolute; bottom: 0; width: 100%; left: 0;">
                        <input type="hidden" name="template_id" class="template_id" value="">
                        <button type="submit" class="btn dark_btn h52 mr20 bkg_blue_light" style="min-width: 108px;">Save</button>
                      
                        </div>
                        
                        
                </div>
                
                
                <!---------------Right----------------->
                <!-- <div class="col-md-7 pl0" style="height: calc(100% - 56px);">
                 <div class="p30" >
                        <textarea name="admin_text" class="summernote emailTextAdmin emailTextArea" rows="8"></textarea>
                        <textarea name="plain_text" class="summernote emailTextClient emailTextArea" rows="8"></textarea>
                        <textarea name="user_text" class="summernote emailTextUser emailTextArea" rows="8"></textarea>
                        
                    </div>
                </div> -->
                </form>

                </div>
               <!--  <div class="col-md-7 pl0">
                    <h5 style="padding-left: 20px;" class="panel-title">Preview</h5>
                </div> -->
                

                
                <!---------------Left----------------->
                
            </div>
<!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->





        </div>                  
    </div>
</div>  
<!-- ******************* end system notification *********************-->

<style type="text/css">
  .reviewsNoti {
    position: fixed;
    top: 50%;
    left: -30px;
    color: #fff;
    z-index: 9;
    display: block;
    padding: 0px;
    border-radius: 100px;
    width: 28px;
    height: 28px;
    text-align: center;
    line-height: 26px;
    background-color: #5d7df3;
}
</style>
<a style="position: fixed; top: 50%; right: 12px; display: none;" class="reviewsNoti slide-toggle visible emailNotiSmartPopup"  type="admin" template_id="<?php if(!empty($oEmailTemplates)) { echo $oEmailTemplates[0]->id; } ?>" ><i class="icon-arrow-left5"></i></a>
