<template>

    <div class="content" id="masterContainer">

        <div class="row">
            <div class="col-md-12">
                <div class="white_box profile_sec mb20">
                    <div class="backbtn">
                        <a href="#/user/setting"><img src="/assets/profile_images/back_40.png"></a>
                    </div>

                    <div class="p25 bbot text-center">
                        <h3>My Media</h3>
                        <p>Basic information that you use in BrandBoost services.</p>
                    </div>

                    <div class="p20">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="tdropdown ml0"><a style="margin:0!important;"
                                                              class="dropdown-toggle fsize12 txt_grey"
                                                              data-toggle="dropdown" aria-expanded="false"> Sort by date
                                    <i class="icon-arrow-down22"></i></a>
                                    <ul style="left: 0px!important; margin-top: 15px; left: auto;"
                                        class="dropdown-menu dropdown-menu-left chat_dropdown">
                                        <li><strong><a class="active" href="#"><img class="small"
                                                                                    src="assets/images/cd_icon1.png">All
                                            (39) </a></strong></li>
                                        <li><strong><a href="#"><img class="small" src="assets/images/cd_icon2.png">Open
                                            (13) </a></strong></li>
                                        <li><strong><a href="#"><img class="small" src="assets/images/cd_icon3.png">Resolved
                                            (172) </a></strong></li>
                                        <li><strong><a href="#"><img class="small" src="assets/images/cd_icon4.png">Favorite
                                            (5) </a></strong></li>
                                        <li><strong><a href="#"><img class="small" src="assets/images/cd_icon5.png">Snoozed
                                            (28)</a></strong></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a class="pull-right txt_grey fsize12" href="#"><i><img
                                    style="vertical-align: top; margin-top: 4px"
                                    src="/assets/profile_images/edit_icon.png" width="12"></i>
                                    &nbsp; Edit</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div v-if="mediaURLs" class="row profile_media_outer">
            <div v-for="mediaURL in mediaURLs" class="col-md-3">
                <div v-if="mediaURL['media_type'] == 'video'" class="profile_media">
                    <video width="100%">
                        <source :src="mediaURL" type="video/mp4">
                    </video>
                </div>
                <div v-else class="profile_media">
                    <img :src="mediaURL" />
                </div>
            </div>
        </div>

        <div v-else class="row profile_media_outer">
            <div class="col-md-12 text-center">
                <ul class="nps_feedback">
                    <li>
                        No Media Found
                    </li>
                </ul>
            </div>
        </div>

    </div>

</template>

<script>
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';
    export default {
        title: 'My Media - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                myReview:'',
                mediaURLs: ''
            }
        },
        mounted() {
            this.loadData();

            console.log('Component mounted');
        },
        methods: {
            loadData: function () {
                //getData
                axios.get('/user/media')
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.myReview = response.data.myReview;
                        this.mediaURLs = response.data.myReview.media_url;
                    });
            }
        }
    }

    $(document).ready(function () {

    });
</script>
