<template>
    <div class="tab-pane " id="right-icon-tab0">
        <div class="clearfix">&nbsp;</div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-flat review_ratings">
<!--                    <form id="frmGeneralBusinessInfo" name="frmGeneralBusinessInfo" method="post">-->
                        <div class="panel-heading" style="padding: 10px;">
                            <h4  class="panel-title">Brand Info</h4>
                        </div>
                        <div class="panel-body p0">
                            <div class="bbot p30">
                                <div class="brand_subs">
                                    <div class="row">
                                        <div class="col-md-7"><img width="24" class="pull-left mr-20" src="/assets/images/company_profile_dark.png"/><p class="mb0"><span class="text-muted">Current plan:</span> {{ oCurrentPlanData != '' ? oCurrentPlanData.level_name : '[No Data]' }}</p></div>
                                        <div class="col-md-5 text-right"><a style="text-decoration:underline;" class="txt_purple showSubPage" href="javascript:void(0);">Manage Subscription</a></div>
                                    </div>
                                </div>
                            </div>
                            <!--====LOGO SETTINGS====-->
                            <div class="bbot p30">
                                <div class="row">
                                    <div class="col-md-3"><p class="text-muted">Logo</p></div>
                                    <div class="col-md-2 brig"><img class="img-circle" id="brand_logo_image_preview" width="64" height="64" :src="oUser.company_logo ? 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+oUser.company_logo : '/assets/images/wakerslogo.png'"/></div>

                                    <div class="col-md-6 col-md-offset-1">
                                        <div class="form-group mb0">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-upload7"></i></span>
                                                <div class="dropzone" id="myDropzone" style="min-height: 0px; width: 300px!important;"></div>
                                                <div style="display: none;" id="uploadedSiteFiles"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="company_logo" name="company_logo" :value="oUser.company_logo">
                            </div>
                            <!--====GENERAL SETTINGS====-->
                            <div class="bbot p30">
                                <div class="row">
                                    <div class="col-md-3"><p class="text-muted">General Info</p></div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="control-label">Business name</label>
                                            <div class="">
                                                <input name="company_name" class="form-control" required="" type="text" v-model="oUser.company_name" placeholder="Wakers Inc.">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Country</label>
                                            <div class="">
                                                <select class="form-control" v-model="oUser.country">
                                                    <option v-for="country in countries" :value="country.country_code" :selected="country.country_code? 'selected' : ''">
                                                        {{ country.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Business address</label>
                                            <span class="display-inline-block pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" id="business_address_dppa" v-model="oUser.business_address_dppa" :checked="(oUser.business_address_dppa) ? 'checked' : ''">
												<span class="toggle blue"></span>
											</label>
										</span>
                                            <div class="">
                                                <input name="company_address" class="form-control" type="text" v-model="oUser.company_address" placeholder="Kiev, Ukraine">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Phone number</label>
                                            <span class="display-inline-block pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" id="phone_no_dppa" v-model="oUser.phone_no_dppa == 1 ? 'checked' : ''">
												<span class="toggle blue"></span>
											</label>
										</span>
                                            <div class="">
                                                <input name="company_phone" class="form-control" type="text" v-model="oUser.company_phone" placeholder="+3 8063 612 53 69">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Website</label>
                                            <span class="display-inline-block pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
											<label class="custom-form-switch pull-right">
												<input class="field" type="checkbox" id="website_dppa" v-model="oUser.website_dppa == 1 ? 'checked' : ''">
												<span class="toggle blue"></span>
											</label>
										</span>
                                            <div class="">
                                                <input name="company_website" class="form-control" type="text" v-model="oUser.company_website" placeholder="www.wakers.co">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--====SOCIAL SETTINGS====-->
                            <div class="bbot p30">
                                <div class="row">
                                    <div class="col-md-3"><p class="text-muted">Socials</p></div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="control-label">Facebook</label>
                                            <div class="">
                                                <input name="social_facebook" class="form-control" type="text" v-model="oUser.social_facebook" placeholder="@wakers">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Instagram</label>
                                            <div class="">
                                                <input name="social_instagram" class="form-control" type="text" v-model="oUser.social_instagram" placeholder="@wakers.agency">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Twitter</label>
                                            <div class="">
                                                <input name="social_twitter" class="form-control" type="text" v-model="oUser.social_twitter" placeholder="@wakers">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Linkedin</label>
                                            <div class="">
                                                <input name="social_linkedin" class="form-control" type="text" v-model="oUser.social_linkedin" placeholder="@wakersco">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--====SAVE====-->
                            <div class="p30">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <!-- saveUserOtherInfo<button type="button" class="btn white_btn ml20 txt_purple" >Preview</span> </button> -->
                                        <button type="submit" class="btn btn-success btn-sm bkg_green_300 light_000 float-right mr-3" v-on:click="saveGeneralInfo()"><span>Save</span> </button>

                                    </div>
                                </div>
                            </div>
                        </div>
<!--                    </form>-->
                </div>
                <!--====DELETE====-->
                <div class="panel panel-flat review_ratings">
                    <div class="panel-heading">
                        <h6 class="panel-title">Delete brand account</h6>
                    </div>
                    <div class="panel-body p0">
                        <div class="p30">
                            <div class="row">
                                <div class="col-md-5">
                                    <p>Please note:<br><span class="text-muted">If you delete your account, you won’t be able to reactive it later.</span></p>
                                </div>
                                <div class="col-md-7 text-right mt-20">
                                    <button type="button" class="btn white_btn ml20 txt_purple" ><span>Delete "Wakers" brand account</span> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel panel-flat review_ratings">
<!--                    <form id="frmGeneralBusinessInfo2" name="frmGeneralBusinessInfo2" method="post">-->
                        <div class="panel-heading" style="padding: 10px;">
                            <h4 class="panel-title">Public Profile</h4>
                        </div>
                        <div class="panel-body p0">
                            <div class="bbot p30">
                                <div class="brand_subs" style="border-top:2px solid #9b83ff;">
                                    <div class="row">
                                        <div class="col-md-2 text-center mt10"><img src="/assets/images/public_profile.png"/></div>
                                        <div class="col-md-10">
                                            <p class="mb-20">Public profiles are free and increase your online presence and trust. Show reviews, photos and more on a pixel-prerfect, mobile-friendly brand page.</p>

                                            <a href="http://pleasereviewmehere.com/campaign/raymond-194" target="_blank"><button type="button" class="btn white_btn mr20 txt_purple" ><span>View example</span> </button></a>
                                            <button type="button" class="btn dark_btn mr20 bkg_purple" ><span>Set live now</span> </button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bbot p30">
                                <div class="row">
                                    <div class="col-md-3"><p class="text-muted">Public profile link</p></div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="control-label">Shareable link to your public profile</label>

                                            <div class="input-group">
                                                <input name="public_profile_link" class="form-control txt_purple" type="text" v-model="oUser.public_profile_link" placeholder="https://zipbooks.com/brand/wakers">
                                                <span class="input-group-addon"><i class="icon-link txt_grey"></i></span>
                                                <span class="input-group-addon"><i class="icon-pencil txt_grey"></i></span>
                                            </div>
                                        </div>

                                        <p class="pull-left">Publish page <span class="text-muted">Last publication {{ displayDateFormat('M d, h:i A', oUser.updated)  }}</span></p>
                                        <label class="custom-form-switch pull-right">
                                            <input class="field" id="public_publish_page" type="checkbox" v-model="oUser.public_publish_page ? 'checked' : ''" @change="synPublicPublishPage()">
                                            <span class="toggle"></span>
                                        </label>
<!--                                        <input class="field" name="public_publish_page" type="hidden" v-model="oUser.public_publish_page">-->

                                    </div>
                                </div>
                            </div>

                            <div class="bbot p30">
                                <div class="row">
                                    <div class="col-md-3"><p class="text-muted">Business info</p></div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="control-label">Business types</label>
                                            <div class="form-group-material">
                                                <input name="company_type" class="form-control token-field" type="text" v-model="oUser.company_type" placeholder="Business types">
                                            </div>


                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Where you operate</label>
                                            <div class="">

                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn white_btn { oUser.company_operate_scope == 'worldwide' || oUser.company_operate_scope == '') ? 'txt_purple' : '' } h40 m0 width_170 changeBA1" @click="synCompanyOperateScope('worldwide')">
                                                        <input type="radio" name="company_operate_scope" id="company_operate_scope1" value="worldwide" v-model="oUser.company_operate_scope" :checked="(oUser.company_operate_scope == 'worldwide' || oUser.company_operate_scope == '') ? 'checked' : ''" ><i class="fa fa-globe"></i> Worldwide
                                                    </label>
                                                    <label class="btn white_btn { oUser.company_operate_scope == 'locally' ? 'txt_purple' : '' } h40 m0 width_170 changeBA1" @click="synCompanyOperateScope('locally')">
                                                        <input type="radio" name="company_operate_scope" id="company_operate_scope2" value="locally" v-model="oUser.company_operate_scope" :checked="oUser.company_operate_scope == 'locally' ? 'checked' : ''" ><i class="icon-location3"></i> Locally
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Working hours</label>
                                            <div class="">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn white_btn { (oUser.company_working_hours == '8' || oUser.company_working_hours == '') ? 'txt_purple' : '' } h40 m0 width_170 changeBA2"  @click="synCompanyWorkingHours(8)" >
                                                        <input type="radio" name="company_working_hours" id="company_working_hours1" :value="8" v-model="oUser.company_working_hours" :checked="(oUser.company_working_hours == '8' || oUser.company_working_hours == '') ? 'checked' : ''" >8 AM
                                                    </label>
                                                    <label class="btn white_btn h40 m0 width_170 { oUser.company_working_hours == '6' ? 'txt_purple' : '' } changeBA2"  @click="synCompanyWorkingHours(6)" >
                                                        <input type="radio" name="company_working_hours" id="company_working_hours2" :value="6" v-model="oUser.company_working_hours" @if :checked="(oUser.company_working_hours == '6') ? 'checked' : ''" >6 PM
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bbot p30">
                                <div class="row">
                                    <div class="col-md-3"><p class="text-muted">Description & SEO</p></div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="control-label">Business description</label>
                                            <div class="">
                                                <textarea name="company_description" v-model="oUser.company_description" style="height:200px; resize:none;" class="form-control" placeholder="So strongly and metaphysically did I conceive of my situation then, that while earnestly watching his motions, I seemed distinctly to perceive that my own individuality was now merged in a joint stock company of two; that my free will had received a mortal wound; and that another's mistake or misfortune might plunge innocent me into unmerited disaster and death."></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">SEO Keywords</label>
                                            <div class="">
                                                <textarea name="company_seo_keywords"  v-model="oUser.company_seo_keywords"  style="height:120px; resize:none;" class="form-control" placeholder="e.g. design, agency, studio, website design, web design, designer, logo, branding, ui, ux, webdesign, app design, website templates, user expirience, website dev"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p30">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="http://pleasereviewmehere.com/campaign/raymond-194" target="_blank"><button type="button" class="btn white_btn ml20 txt_purple">Preview </button></a>
                                        <button type="submit" class="btn dark_btn ml20 bkg_purple" v-on:click="savePublicProfile()">Save </button>
                                    </div>
                                </div>
                            </div>

                        </div>
<!--                    </form>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        title: 'Admin Settings - Brand Boost',
        name: "General",
        data() {
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                seletedTab: 1,
                settingsData: '',
                notificationData: '',
                oImportHistory: '',
                oExportHistory: '',
                oMemberships: '',
                oCurrentPlanData: '',
                oCurrentTopupPlanData: '',
                oInvoices: '',
                notificationlisting: '',
                oUser: '',
                countries: ''
            }
        },
        mounted() {
            this.loadData();
            setTimeout(function(){
                loadJQCode();
            },2000);
        },
        methods: {
            loadData: function () {
                //getData
                axios.get('/admin/settings')
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.settingsData = response.data.settingsData;
                        this.notificationData = response.data.notificationData;
                        this.oImportHistory = response.data.oImportHistory;
                        this.oExportHistory = response.data.oExportHistory;
                        this.oMemberships = response.data.oMemberships;
                        this.oCurrentPlanData = response.data.oCurrentPlanData;
                        this.oCurrentTopupPlanData = response.data.oCurrentTopupPlanData;
                        this.seletedTab = response.data.seletedTab;
                        this.oInvoices = response.data.oInvoices;
                        this.notificationlisting = response.data.notificationlisting;
                        this.oUser = response.data.oUser;
                        this.countries = response.data.countries;
                    });
            },
            saveGeneralInfo: function () {
                this.loading = false;

                axios.post('/admin/settings/saveGeneralInfo',{
                    // this.oUser
                    company_name:this.oUser.company_name,
                    company_address:this.oUser.company_address,
                    business_address_dppa:this.oUser.business_address_dppa,
                    phone_no_dppa:this.oUser.phone_no_dppa,
                    company_phone:this.oUser.company_phone,
                    website_dppa:this.oUser.website_dppa,
                    country:this.oUser.country,
                    social_facebook:this.oUser.social_facebook,
                    social_instagram:this.oUser.social_instagram,
                    social_twitter:this.oUser.social_twitter,
                    social_linkedin:this.oUser.social_linkedin,
                })
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.loadData();
                    });
            },

            savePublicProfile: function () {
                this.loading = false;

                axios.post('/admin/settings/savePublicProfile',{
                    // this.oUser
                    company_description:this.oUser.company_description,
                    company_working_hours:this.oUser.company_working_hours,
                    company_operate_scope:this.oUser.company_operate_scope,
                    company_type:this.oUser.company_type,
                    public_profile_link:this.oUser.public_profile_link,
                    company_seo_keywords:this.oUser.company_seo_keywords,
                    public_publish_page:this.oUser.public_publish_page,

                })
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.loadData();
                    });
            },

            synPublicPublishPage: function(e){
                if(e.target.checked){
                    this.oUser.public_publish_page=1
                }else{
                    this.oUser.public_publish_page=0
                }

            },
            synCompanyOperateScope: function(e){
                this.oUser.company_operate_scope=e
            },
            synCompanyWorkingHours: function(e){
                this.oUser.company_working_hours=e
            },
        }
    }
    function loadJQCode(){
        $(document).ready(function () {
            $(".token-field").on('tokenfield:createdtoken tokenfield:removedtoken change', function (e) {
                if($(this).parent().children().hasClass('token')) {
                    $(this).parent().find('.token-input').attr('placeholder', '');
                }
                else {
                    $(this).parent().find('.token-input').attr('placeholder', '- Tokenfield');
                }
            }).trigger('change');

            $('.showSubPage').click(function(){
                $('.nav-tabs a[href="#right-icon-tab2"]').tab('show');
            });


            $('.changeBA1').click(function(){
                $('.changeBA1').removeClass('txt_purple');
                $(this).addClass('txt_purple');
            });

            $('.changeBA2').click(function(){
                $('.changeBA2').removeClass('txt_purple');
                $(this).addClass('txt_purple');
            });

            $('#public_publish_page').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="public_publish_page"]').attr("value", 1);
                } else {
                    $('input[name="public_publish_page"]').attr("value", 0);
                }
            });

            $('#business_address_dppa').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="business_address_dppa"]').attr("value", 1);
                } else {
                    $('input[name="business_address_dppa"]').attr("value", 0);
                }
            });

            $('#phone_no_dppa').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="phone_no_dppa"]').attr("value", 1);
                } else {
                    $('input[name="phone_no_dppa"]').attr("value", 0);
                }
            });

            $('#website_dppa').change(function () {
                if ($(this).is(":checked") == true) {
                    $('input[name="website_dppa"]').attr("value", 1);
                } else {
                    $('input[name="website_dppa"]').attr("value", 0);
                }
            });


            Dropzone.autoDiscover = false;
            var settingUserId = $("#settingsUserId").val();
            var myDropzone = new Dropzone(
                '#myDropzone', //id of drop zone element 1
                {
                    url: '/webchat/dropzone/upload_s3_attachment/'+settingUserId+'/onsite',
                    uploadMultiple: false,
                    maxFiles: 1,
                    maxFilesize: 600,
                    acceptedFiles: 'image/*',
                    addRemoveLinks: false,
                    success: function (response) {

                        if(response.xhr.responseText != "") {

                            $('#brand_logo_image_preview').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+response.xhr.responseText).show();
                            var dropImage = $('#company_logo').val();
                            $.ajax({
                                url: 'admin/brandboost/deleteObjectFromS3',
                                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                                type: "POST",
                                data: {dropImage: dropImage},
                                dataType: "json",
                                success: function (data) {
                                    console.log(data);
                                }
                            });

                            $('#company_logo').val(response.xhr.responseText);
                            $('.saveUserOtherInfo').trigger('click');
                        }
                    }
                });

            myDropzone.on("complete", function(file) {
                myDropzone.removeFile(file);
            });
        });

    }
</script>

<style scoped>

</style>
