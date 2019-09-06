<style type="text/css">
    .note-editor .note-toolbar { height:180px!important; }
    .note-toolbar {height: 180px!important; }
    .note-editor .note-codable { background-color: #000!important; }
    .email-container.table_main_mr{ margin: -136px 0px 0 -92px!important; transform: scale(0.7); } 
    .note-toolbar {display:none;}
    .overlaynew {z-index:999999999999999999999999999!important;}
</style>




<!-- ******************* system notification *********************** -->
<div class="box systemNotificationShow" style="width: 400px">
    <div style="width: 100%;overflow: hidden; height: 100%;">
        <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">

            <!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
            <div class="row" style="height: 100%;">

                <div class="col-md-12 pr0 brig">
                    <a style="left: 35px; top: 15px;" class="reviews systemNotifictionBack slide-toggle bkg_grey_light" ><i class=""><img src="{{ base_url() }}assets/images/icon_arrow_left.png"/></i></a> 
                    <h5 style="padding-left: 75px;" class="panel-title">Configure Storage</h5>

                    <form method="post" id="frmEditSystemTemplate" action="javascript:void();">
                        @csrf
                        <div class="col-md-12 pr0 brig" style="height: calc(100% - 56px);">
                            <div class="p20">
                                <div class="">
                                    <div class="showEmailMsg" style="color: green;"></div>
                                    <div class="showEmailErrMsg" style="color: red;"></div>


                                    <div class="form-group"><label>User Id</label>&nbsp&nbsp:&nbsp&nbsp<span id="userid"></span></div>

                                    <div class="form-group"><label>User Name</label>&nbsp&nbsp:&nbsp&nbsp<span id="username"></span></div>


                                    <div class="form-group">
                                        <label>Storage (MB)</label>
                                        <input type="text" id="s3_allow_size" name="s3_allow_size" class="form-control h52 greetingMsgType" name="">
                                    </div>


                                </div>   
                            </div>

                            <div class="btop p20 pl30 bkg_white" style="width: 100%; left: 0;">
                                <input type="hidden" name="user_id_input" id="user_id_input" value="">
                                <button type="submit" class="btn dark_btn h52 mr20 bkg_blue_light" style="min-width: 108px;">Save</button>

                            </div>


                        </div>



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
<a style="position: fixed; top: 50%; right: 12px;" class="reviewsNoti slide-toggle visible emailNotiSmartPopup"  type="admin" template_id="
@if (isset($oEmailTemplates[0]->id)) 
    {{ $oEmailTemplates[0]->id }}
@endif
" ><i class="icon-arrow-left5"></i></a>