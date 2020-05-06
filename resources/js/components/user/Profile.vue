<template>

    <div class="content" id="masterContainer">

        <div class="row">
            <div class="col-md-12">
                <div class="white_box text-center profile_sec mb25">
                    <div class="review_edit">
                        <a href="#/user/setting"><img
                            src="/assets/profile_images/settings_40.png"></a>
                    </div>
                    <div class="p25 bbot">
                        <div class="profile_avatar">
                            <div style="cursor:pointer;" class="media-left media-middle pr10 uploadAvatar">
                                <a class="icons">
                                    <user-avatar
                                        :avatar="aUInfo.avatar"
                                        :firstname="aUInfo.firstname"
                                        :lastname="aUInfo.lastname"
                                        :width="80"
                                        :height="40"
                                        :fontsize="12"
                                    ></user-avatar>
                                </a>
                            </div>
                            <!--<div class="input-group dropzone hidden" id="myDropzone_avatar">
                                <span class="input-group-addon"><i class="icon-upload7"></i></span>
                                <div class=""></div>
                            </div>-->
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div>
                            <span><strong>Hello, {{ aUInfo.firstname }} {{ aUInfo.lastname }}!</strong></span>
                            <br />
                            <span>{{ aUInfo.email }}</span>
                        </div>

                        <div class="p40 text-center profile_user_data">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong class="txt_dark">{{ oReviews.length }}</strong><br>
                                        <span>Reviews Added</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong class="txt_dark">1,489</strong><br>
                                        <span>Reviews Views</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong class="txt_dark">251</strong><br>
                                        <span>Likes / Dislikes</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-md-12 text-center">
                    <div class="col-md-6">
                        <div class="white_box user_sections">
                            <div class="media-left"><img src="/assets/profile_images/user_review_icon.png"/>
                            </div>
                            <div class="media-left">
                                <h3>My reviews</h3>
                                <p>On BrandBoost, you can write reviews about companies, product or services you used and
                                    purchased . </p>
                                <a href="#/user/review">View all reviews <i
                                    class="icon-arrow-right13"></i></a></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white_box user_sections">
                            <div class="media-left"><img src="/assets/profile_images/user_profile_icon.png"/>
                            </div>
                            <div class="media-left">
                                <h3>Profile</h3>
                                <p>On BrandBoost, you can write reviews about companies, product or services you used and
                                    purchased . </p>
                                <a href="#/user/setting">Account settings <i
                                    class="icon-arrow-right13"></i></a></div>
                        </div>
                    </div>
            </div>
            <div class="row col-md-12 text-center">
                <div class="col-md-6">
                    <div class="white_box user_sections">
                        <div class="media-left"><img src="/assets/profile_images/user_pw_icon.png"/>
                        </div>
                        <div class="media-left">
                            <h3>Personal Website</h3>
                            <p>On BrandBoost, you can write reviews about companies, product or services you used and
                                purchased . </p>
                            <a style="cursor: pointer;">Account settings <i class="icon-arrow-right13"></i></a></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="white_box user_sections">
                        <div class="media-left"><img
                            src="/assets/profile_images/user_discover_icon.png"/></div>
                        <div class="media-left">
                            <h3>Discover Businesses</h3>
                            <p>On BrandBoost, you can write reviews about companies, product or services you used and
                                purchased . </p>
                            <a style="cursor: pointer;">View all businesses <i class="icon-arrow-right13"></i></a></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    export default {
        title: 'User Profile - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {


                loading: true,
                breadcrumb: '',
                aUInfo: '',
                oReviews:''
            }
        },
        mounted() {
            this.loadData();

            console.log('Component mounted');
        },
        methods: {
            loadData: function () {
                //getData
                axios.get('/user/profile')
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.aUInfo = response.data.aUInfo;
                        this.oReviews = response.data.oReviews;
                    });
            }
        }
    }

    $(document).ready(function () {
        $(document).on('click', '.uploadAvatar', function () {
            $('#myDropzone_avatar').trigger('click');
        });
    });

    /*Dropzone.autoDiscover = false;

    var myDropzoneLogoImg = new Dropzone(
        '#myDropzone_avatar', //id of drop zone element 1
        {
            url: "webchat/dropzone/upload_profile_image",
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 60000,
            acceptedFiles: 'image/!*',
            addRemoveLinks: false,
            success: function (response) {
                $('.media-left .icons').removeClass('fl_letters');
                $('.media-left .icons').html('<img class="img-circle" src="" >');
                $('.img-circle').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' + response.xhr.responseText);
                var logoImage = response.xhr.responseText;
                $.ajax({
                    url: 'user/setting/updateProfile',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    type: "POST",
                    data: {avatar: logoImage},
                    dataType: "json",
                    success: function (response) {

                        if (response.status == 'ok') {

                        } else {

                        }
                    },
                    error: function (response) {
                        /!*alertMessage(response.msg);
                        $('.overlaynew').hide();*!/
                    }
                });

                /!* setTimeout(function(){
                     $('#myDropzone_avatar .dz-preview').hide();
                 }, 3500);*!/
            }
        });

    myDropzoneLogoImg.on("complete", function (file) {
        myDropzoneLogoImg.removeFile(file);
    });*/

    //Dropzone.autoDiscover = false;

</script>
<style type="text/css">
    /*.icons.fl_letters { background-image: linear-gradient(79deg, #5869eb, #6190fa)!important; }*/

    .icons.fl_letters {
        background-image: linear-gradient(259deg, #9b83ff, #6145d4) !important;
    }

    span.icons.fl_letters {
        width: 32px;
        height: 32px;
        box-shadow: none !important;
        background: #7a8dae;
        background-image: none;
        text-align: center;
        text-transform: uppercase;
        line-height: 32px;
        color: #fff;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 500;
        display: block;
    }

    .user_sections p {
        max-width: 700px!important;
        margin: 50px;
    }
    .profile_avatar {
        height: auto!important;
    }
</style>
