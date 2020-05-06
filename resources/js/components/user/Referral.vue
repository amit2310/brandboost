<template>

    <div class="content" id="masterContainer">

        <div class="row">
            <div class="col-md-12">
                <div class="white_box profile_sec mb20">
                    <div class="backbtn">
                        <a href="#/user/profile"><img
                            src="/assets/profile_images/back_40.png"></a>
                    </div>

                    <div class="p25 bbot text-center">
                        <h3>My Referrals</h3>
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
                                        <li><strong><a class="active" style="cursor: pointer;"><img class="small"
                                                                                                    src="/assets/images/cd_icon1.png">All
                                            (1) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="/assets/images/cd_icon3.png">Active
                                            (1) </a></strong></li>
                                        <li><strong><a style="cursor: pointer;"><img class="small"
                                                                                     src="/assets/images/cd_icon2.png">Inactive
                                            (0) </a></strong></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- <div class="col-md-6 col-sm-6 col-xs-6">
                                  <a class="pull-right txt_grey fsize12" style="cursor: pointer;"><i><img style="vertical-align: top; margin-top: 4px" src="/assets/profile_images/edit_icon.png" width="12"></i> &nbsp; Edit</a>
                              </div> -->
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div v-if="referralData.length > 0" class="row profile_media_outer">
            <div class="col-md-3">
                <table style="width: 100%;">

                    <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th class="nosort" style="display: none;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="referral in referralData">
                        <td style="display: none;">{{ referral.id }}</td>
                        <td>
                            <ul class="nps_feedback ref">
                                <li>
                                    <div class="pull-left">
                                        <div class="media-left"><img
                                            src="/assets/profile_images/user_placeholder.png"/>
                                        </div>
                                        <div class="media-left"><p class="txt_dark">{{ referral.title }}</p></div>
                                    </div>
                                    <div class="pull-right">
                                        <div class="media-left text-left pr40 w100"><p><strong><img class="email"
                                                                                                    src="/assets/profile_images/email_icon16.png"/>{{ capitalizeFirstLetter(referral.source_type) }}
                                        </strong></p></div>
                                        <div class="media-left text-left pr30 w100"><p>
                                            <strong>{{ referral.status == 1 ? '<i class="icon-circle2 txt_green"></i>active' : '<i class="icon-circle2 txt_red"></i>inactive' }}</strong>
                                        </p></div>
                                        <div class="media-left text-left pr30 w100"><p>
                                            <strong>{{ displayDateFormat('M d, h:i A', referral.created) }}</strong></p></div>
                                        <div class="media-left p0">
                                            <div class="tdropdown"><a class="table_more dropdown-toggle"
                                                                      data-toggle="dropdown"><img
                                                src="/assets/images/more.svg"></a>
                                                <ul style="right: 0;"
                                                    class="dropdown-menu dropdown-menu-right status">
                                                    <li>
                                                        <a v-if="referral.status != 1"  href="javascript:void(0);" @click="changeStatus(referral.id, '1')"><i
                                                            class="icon-primitive-dot txt_green"></i> Active</a>

                                                        <a v-else  href="javascript:void(0);" @click="changeStatus(referral.id, '0')"><i
                                                            class="icon-primitive-dot txt_red"></i> Inactive</a>
                                                    </li>
                                                    <li>
                                                        <a :href="`#/user/referral/reports/{ referral.id }`"><i
                                                            class="icon-primitive-dot txt_grey"></i> Report</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div v-else class="row profile_media_outer">
            <div class="col-md-12 text-center">
                <ul class="nps_feedback">
                    <li>
                        No Referral Found
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
        title: 'My Referrals - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {


                loading: true,
                breadcrumb: '',
                referralData: ''
            }
        },
        mounted() {
            this.loadData();

            console.log('Component mounted');
        },
        methods: {
            loadData: function () {
                //getData
                axios.get('/user/referral')
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.referralData = response.data.referralData;
                        //console.log(this.referralData)
                    });
            },
            changeStatus: function(id, status) {
                if(confirm('Are you sure you want to change the status of this item?')){
                    //Do axios
                    axios.post('/user/referral/updateReferralUser', {
                        referral_id:id,
                        status:status,
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            if(response.data.status == 'success'){
                                syncContactSelectionSources();
                                this.loadData();
                            }

                        });
                }
            }
        }
    }

    $(document).ready(function () {

    });
</script>
