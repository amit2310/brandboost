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
                        <h3>My NPS Feedback</h3>
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

        <div v-if="oFeedbacks" class="row profile_media_outer">
            <div class="col-md-3">
                <table style="width: 100%;">

                    <thead>
                    <tr>
                        <th style="display: none;"></th>
                        <th class="nosort" style="display: none;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="oFeedback in oFeedbacks" >
                        <td style="display: none;">{{ oFeedback.id }}</td>
                        <td>
                            <ul class="nps_feedback">
                                <li>
                                    <div v-if="oFeedback.score > 7" class="pull-left">
                                        <div class="media-left"><img class="mt5" src="/assets/profile_images/smiley_green.png"/></div>
                                        <div class="media-left">
                                            <p><strong>{{ oFeedback.score }}</strong></p>
                                            <p>Positive</p>
                                        </div>
                                    </div>
                                    <div v-else-if="oFeedback.score <= 7 && oFeedback.score >=4" class="pull-left">
                                        <div class="media-left"><img class="mt5" src="/assets/profile_images/smiley_yellow.png"/></div>
                                        <div class="media-left">
                                            <p><strong>{{ oFeedback.score }}</strong></p>
                                            <p>Neutral</p>
                                        </div>
                                    </div>
                                    <div v-else class="pull-left">
                                        <div class="media-left"><img class="mt5" src="/assets/profile_images/smiley_red.png"/></div>
                                        <div class="media-left">
                                            <p><strong>{{ oFeedback.score }}</strong></p>
                                            <p>Negative</p>
                                        </div>
                                    </div>

                                    <div class="pull-right">
                                        <div class="media-left text-right pr40"><p>
                                            <strong>{{ oFeedback.title != ''?oFeedback.title:'N/A' }}</strong></p>
                                            <p> {{ oFeedback.feedback != ''?oFeedback.feedback:'N/A' }} </p></div>
                                        <div class="media-left text-right pr30"><p>{{ displayDateFormat('M d, h:i A', oFeedback.created_at) }}</p></div>
                                        <div class="media-left p0 text-right">
                                            <div class="tdropdown mt5"><a class="table_more dropdown-toggle"
                                                                          data-toggle="dropdown"><img
                                                src="/assets/images/more.svg"></a>
                                                <ul style="right: 0;"
                                                    class="dropdown-menu dropdown-menu-right status">

                                                    <li><a :href="'#/user/nps/reports/'+oFeedback.id"><i
                                                        class="icon-primitive-dot txt_green"></i> Report</a>
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
                        No Feedback Found
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
        title: 'My Feedbacks - Brand Boost',
        components: {UserAvatar, Pagination},
        data() {
            return {
                successMsg: '',
                errorMsg: '',
                loading: true,
                breadcrumb: '',
                oFeedbacks: ''
            }
        },
        mounted() {
            this.loadData();

            console.log('Component mounted');
        },
        methods: {
            loadData: function () {
                //getData
                axios.get('/user/nps')
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.oFeedbacks = response.data.oFeedbacks;
                    });
            }
        }
    }

    $(document).ready(function () {

    });
</script>
