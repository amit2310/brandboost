<template>

    <div class="content" id="masterContainer">

        <!--******************
          Top Heading area
         **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Account Settings</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        &nbsp;
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
          Content Area
         **********************-->
        <div class="content-area">

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading">
                            <h6 class="panel-title">Account Info</h6>
                        </div>
                        <div class="panel-body p0">

                            <!--====LOGO SETTINGS====-->
                            <form method="POST" name="frmSubmit" id="frmSubmit" action="#"  enctype="multipart/form-data">
                                <div class="bbot p30 profile_photo_settings">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Avatar</p></div>
                                        <div class="col-md-2 brig">
                                            <img v-if="aUInfo.avatar !== ''" class="avatar userAvatar" :src="'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'+aUInfo.avatar"/>
                                            <img v-else class="avatar userAvatar" :src="'/profile_images/avatar_image.png'" />
                                        </div>
                                        <div class="col-md-6 col-md-offset-1">
                                            <div class="form-group mb0">
                                                <label class="control-label">Photo</label>
                                                <div class="input-group dropzone" id="myDropzone_avatar" style="min-height:40px!important;">
                                                    <span class="input-group-addon"><i class="icon-upload7"></i></span>
                                                    <div class=""></div>
                                                    <input style="display: none;" type="text" name="avatar" id="avatar" :value="aUInfo.avatar" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--====GENERAL SETTINGS====-->
                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">General Info</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Firstname</label>
                                                <div class="">
                                                    <input name="firstname" id="firstname" class="form-control" required="" type="text" placeholder="maxive" :value="aUInfo.firstname">
                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Lastname</label>
                                                <div class="">
                                                    <input name="lastname" id="lastname" class="form-control" required="" type="text" placeholder="maxive" :value="aUInfo.lastname">
                                                </div>
                                            </div>


                                            <div v-if="countries" class="form-group">
                                                <label class="control-label">Country</label>
                                                <div class="">
                                                    <select class="form-control"  name="country" v-model="country">
                                                        <option v-for="country in countries" :value="country.country_code" :selected="country.country_code == country ? 'selected' : ''">
                                                            {{ country.name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label w100">Phone number <span class="pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
                                                <label class="custom-form-switch pull-right">
                                                    <input class="field chk_change" name="phone_display" chkName="phone_display" :value="aUInfo.phone_display" type="checkbox" :checked="(aUInfo.phone_display) ? 'checked' : ''">
                                                    <span class="toggle"></span>
                                                </label>
                                            </span>
                                                </label>
                                                <div class="">
                                                    <input name="mobile" id="mobile" class="form-control" required="" type="text" placeholder="+3 8063 612 53 69" :value="aUInfo.mobile">
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label class="control-label w100">Website <span class="pull-right fsize11 text-muted">Display on public profile &nbsp; &nbsp;
                                                <label class="custom-form-switch pull-right">
                                                    <input class="field chk_change" name="website_display" chkName="website_display" :value="aUInfo.website_display" type="checkbox" :checked="(aUInfo.website_display) ? 'checked' : ''">
                                                    <span class="toggle"></span>
                                                </label>
                                            </span>
                                                </label>

                                                <div class="">
                                                    <input name="website" id="website" class="form-control"  type="text" placeholder="www.wakers.co" :value="aUInfo.website">
                                                </div>
                                            </div>

                                            <input type="hidden" name="userId" id="userId" :value="aUInfo.id">

                                            <!--====SAVE====-->

                                            <button type="submit" style="float: right;" class="btn dark_btn ml20 bkg_purple" >Save</span> </button>

                                        </div>

                                    </div>


                                </div>




                            </form>
                            <!--====SOCIAL SETTINGS====-->

                            <form method="POST" name="frmChangePasswordN" id="frmChangePasswordN" action="#" >
                                <div class="bbot p30">
                                    <div class="row">
                                        <div class="col-md-3"><p class="text-muted">Password</p></div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="control-label">Current password</label>
                                                <div class="">
                                                    <input type="password" name="oldPassword" id="oldPassword" placeholder="Enter current password" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">New password</label>
                                                <div class="">
                                                    <input type="password" name="newPassword" id="newPassword" placeholder="Enter new password" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Repeat new password</label>
                                                <div class="">
                                                    <input type="password" name="rePassword" id="rePassword" placeholder="Repeat new password" class="form-control" required>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!--====SAVE====-->
                                <div class="p30">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button type="button" class="btn white_btn ml20 txt_purple" >Cancel</span> </button>
                                            <button type="submit" class="btn dark_btn ml20 bkg_purple" >Save</span> </button>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                    <!--====DELETE====-->
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading">
                            <h6 class="panel-title">Delete user account</h6>
                        </div>
                        <div class="panel-body p0">
                            <div class="p30">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p>Please note:<br><span class="text-muted">If you delete your account, you won’t be able to reactive it later.</span></p>
                                    </div>
                                    <div class="col-md-7 text-right mt-20">
                                        <button type="button" class="btn white_btn ml20 txt_purple delete_account" >Delete  account</span> </button>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat review_ratings">
                        <div class="panel-heading">
                            <h6 class="panel-title">Email Notifications</h6>
                        </div>
                        <div class="panel-body p0">
                            <div class="bbot p30">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="text-muted">Email</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <p class="pull-left mb0">Email notification<br>
                                                <span class="text-muted fsize11">Receive an email every time you get new event</span></p>
                                            <label class="custom-form-switch pull-right">
                                                <input class="field chk_change" name="email_noti" chkName="email_noti" :value="aUInfo.email_noti" type="checkbox" :checked="(aUInfo.email_noti == 1) ? 'checked' : ''">
                                                <span class="toggle"></span> </label>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <div class="">
                                                <input name="user_email" class="form-control" :value="aUInfo.email" type="text" placeholder="max@wakers.co" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p30">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="text-muted">Events</p>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group mb10">
                                            <p class="pull-left mb0">Password expiaration notification</p>
                                            <label class="custom-form-switch pull-right">
                                                <input class="field chk_change" name="pass_ex_noti" chkName="pass_ex_noti" :value="aUInfo.pass_ex_noti" type="checkbox" :checked="(aUInfo.pass_ex_noti == 1) ? 'checked' : ''">
                                                <span class="toggle"></span> </label>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group mb10">
                                            <p class="pull-left mb0">New message notification</p>
                                            <label class="custom-form-switch pull-right">
                                                <input class="field chk_change" name="new_msg_noti" chkName="new_msg_noti" :value="aUInfo.new_msg_noti" type="checkbox" :checked="(aUInfo.new_msg_noti == 1) ? 'checked' : ''">
                                                <span class="toggle"></span> </label>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group mb10">
                                            <p class="pull-left mb0">New task notifitcation</p>
                                            <label class="custom-form-switch pull-right">
                                                <input class="field chk_change" name="new_task_noti" chkName="new_task_noti" :value="aUInfo.new_task_noti" type="checkbox" :checked="(aUInfo.new_task_noti == 1) ? 'checked' : ''">

                                                <span class="toggle"></span> </label>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group mb0">
                                            <p class="pull-left mb0">New contact request notification</p>
                                            <label class="custom-form-switch pull-right">
                                                <input class="field chk_change" name="new_contact_req_noti" chkName="new_contact_req_noti" :value="aUInfo.new_contact_req_noti" type="checkbox" :checked="(aUInfo.new_contact_req_noti == 1) ? 'checked' : ''">
                                                <span class="toggle"></span> </label>
                                            <div class="clearfix"></div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--******************
          Content Area End
         **********************-->

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import PeopleListCreateSmartPopup from '@/components/helpers/PeopleListCreateSmartPopup';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        title: 'Email Lists - Brand Boost',
        components: {UserAvatar, PeopleListCreateSmartPopup, Pagination},
        data() {
            return {
                form: {
                    title: '',
                    listDescription: '',
                    list_id: ''
                },
                formLabel: 'Create',
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                userDetail: '',
                onsiteList: '',
                offsiteList: '',
                getCampEmail: '',
                getCampSms: '',
                membershipData: '',
                emailFooterData: '',
                bbStatsData: '',
                aUInfo: '',
                aTeamInfo: '',
                countries: ''
            }
        },
        mounted() {
            this.loadData();

            console.log('Component mounted')
        },
        methods: {
            loadData: function () {
                //getData
                axios.get('/admin/profile/')
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.aUInfo = response.data.userDetail;
                        this.onsiteList = response.data.onsiteList;
                        this.offsiteList = response.data.offsiteList;
                        this.getCampEmail = response.data.getCampEmail;
                        this.getCampSms = response.data.getCampSms;
                        this.membershipData = response.data.membershipData;
                        this.emailFooterData = response.data.emailFooterData;
                        this.bbStatsData = response.data.bbStatsData;
                        this.userData = response.data.userData;
                        this.aTeamInfo = response.data.aTeamInfo;
                        this.countries = response.data.countries;
                        console.log(this.aUInfo);
                    });
            }
        }
    }


    $(document).ready(function () {

    });

    /*var myDropzoneLogoImg = new Dropzone(
        '#myDropzone_avatar', //id of drop zone element 1
        {
            url: 'webchat/dropzone/upload_profile_image',
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 600,
            acceptedFiles: 'image/!*',
            addRemoveLinks: false,
            success: function (response) {
                $('#avatar').val(response.xhr.responseText);
                $('.userAvatar').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' + response.xhr.responseText);
                setTimeout(function () {
                    $('#myDropzone_avatar .dz-preview').hide();
                }, 3500);
            }
        });

    myDropzoneLogoImg.on("complete", function (file) {
        myDropzoneLogoImg.removeFile(file);
    });

    Dropzone.autoDiscover = false;*/
</script>
