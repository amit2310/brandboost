<template>
    <div>
    <div class="top-bar-top-section bbot">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-6">
                    <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                    <h3 class="htxt_medium_24 dark_700">People Profile</h3>
                </div>
                <div class="col-md-6 col-6 text-right">
                    <button class="circle-icon-40 mr15"><img src="/assets/images/filter.svg"/></button>
                    <button class="btn btn-md bkg_blue_200 light_000">Main Action <span><img
                        src="/assets/images/blue-plus.svg"/></span></button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="content-area">
        <div class="container-fluid">



            <div class="row">
                <div class="col-md-12">
                    <div class="card p30 pl40 pr50 user_profile">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="profile_icon" v-if="personalData.avatar">
                                    <user-avatar
                                        :avatar="personalData.avatar"
                                        :firstname="personalData.firstname"
                                        :lastname="personalData.lastname"
                                        :width="76"
                                        :height="76"
                                        :fontsize="12"
                                    ></user-avatar>
                                </div>
                                <div class="profile_icon" v-else>
                                    <img src="/assets/images/profile-icon-36.svg" />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="profile_details">
                                    <h3 class="htxt_medium_20 dark_700 mb-2 mt15">{{personalData.firstname + ' ' + personalData.lastname}}</h3>
                                    <p class="fsize12 dark_200 text-uppercase mb0">#{{personalData.id}}. {{personalData.email}}</p>
                                </div>
                            </div>

                            <div class="col-md-4 text-center">
                                <img style="max-width: 250px;" class="mt15" src="/assets/images/profile_graph.svg"/>
                            </div>
                            <div class="col-md-2 text-center">
                                <img style="max-width: 86px;" src="/assets/images/lead_source.png" />
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8">
                    <div class="card p20 pl30 pr30 min_h_240">

                        <ul class="nav nav-pills profile_tab mt-0 mb20 bbot pb20" role="tablist">
                            <li class="mr30">
                                <a class="htxt_bold_14 active" data-toggle="pill" href="#AddNote"><img src="/assets/images/file-3-line.svg" /> &nbsp; Add Note</a>
                            </li>
                            <li class="mr30">
                                <a class="htxt_bold_14" data-toggle="pill" href="#Chat"><img src="/assets/images/message-2-line.svg" /> &nbsp; Chat</a>
                            </li>
                            <li class="mr30">
                                <a class="htxt_bold_14" data-toggle="pill" href="#Email"><img src="/assets/images/mail-open-line.svg" /> &nbsp; Email</a>
                            </li>
                            <li class="mr30">
                                <a class="htxt_bold_14" data-toggle="pill" href="#TextMessage"><img src="/assets/images/message-3-line-16.svg" /> &nbsp; Text Message</a>
                            </li>
                            <li class="">
                                <a class="htxt_bold_14" data-toggle="pill" href="#Review"><img src="/assets/images/star-line.svg" /> &nbsp; Review</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!--======Tab 1====-->
                            <div id="AddNote" class="tab-pane active">
                                <form method="post" @submit.prevent="submitNotes(this)">
                                <div class="p-0 mb20">
                                    <input type="hidden" name="subscriberid" v-model="formFields.subscriberid=personalData.id">
                                    <input type="hidden" name="_token" v-model="formFields._token=csrf_token()">
                                    <textarea required class="border-0 w-100 fsize15 dark_200" style="resize: none" placeholder="Leave your note here..." v-model="formFields.notes" ></textarea>
                                </div>
                                <div class="p-0 text-right">
                                    <button class="border-0 bkg_none p-0" type="submit" ><img src="/assets/images/blue_48_send_circle.svg"/></button>
                                </div>
                                </form>
                            </div>
                            <!--======Tab 2=====-->
                            <div id="Chat" class="tab-pane fade">
                                Chat
                            </div>
                            <!--======Tab 3=====-->
                            <div id="Email" class="tab-pane fade">
                                Email
                            </div>
                            <!--======Tab 4=====-->
                            <div id="TextMessage" class="tab-pane fade">
                                Text Message
                            </div>
                            <!--======Tab 5=====-->
                            <div id="Review" class="tab-pane fade">
                                Review
                            </div>
                        </div>




                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p20 min_h_240 profile_form">
                        <h3 class="htxt_medium_16 dark_800">Sales pipeline</h3>
                        <hr/>
                        <div class="form-group">
                            <label class="fsize12 fw400 dark_100" for="Leadsource">Lead source</label>
                            <select class="form-control h36">
                                <option>Email Campaign</option>
                                <option>Email Campaign</option>
                                <option>Email Campaign</option>
                                <option>Email Campaign</option>
                                <option>Email Campaign</option>
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <label class="fsize12 fw400 dark_100" for="Stage">Stage</label>
                            <select class="form-control h36">
                                <option>Email Campaign</option>
                                <option>Email Campaign</option>
                                <option>Email Campaign</option>
                                <option>Email Campaign</option>
                                <option>Email Campaign</option>
                            </select>
                        </div>


                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="table_head_action mt-1 mb25">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="htxt_bold_20 dark_700">Activity</h3>
                            </div>
                            <div class="col-md-6">
                                <div class="table_action">
                                    <div class="float-right">
                                        <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                            Last week
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Link 1</a>
                                            <a class="dropdown-item" href="#">Link 2</a>
                                            <a class="dropdown-item" href="#">Link 3</a>
                                        </div>
                                    </div>
                                    <div class="float-right ml10 mr10">
                                        <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                            All types
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Link 1</a>
                                            <a class="dropdown-item" href="#">Link 2</a>
                                            <a class="dropdown-item" href="#">Link 3</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">

                            <div class="activity_date_small">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="icons bkg_green_400"><i><img src="/assets/images/message-3-line.svg"></i></div>
                                        <p class="htxt_bold_16 dark_800 mb-2">Received SMS</p>
                                        <p class="htxt_regular_14 dark_400 mb0">Hey Alex, do you have few minutes for a quick call at 11:30 AM?</p>
                                        <button class="activity_button"><i><img src="/assets/images/message-3-line-16.svg"/></i> Answer with SMS</button>
                                    </div>
                                    <div class="time"><p class="htxt_regular_14 dark_200">11:44AM</p></div>
                                </div>
                            </div>

                            <div class="activity_date_small" v-for="(activity, index) in activityData">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="icons bkg_yellow_400" v-if="index%2 == 0"><i><img src="/assets/images/message-3-line.svg"></i></div>
                                        <div class="icons bkg_green_400" v-else-if="index%3 == 0"><i><img src="/assets/images/message-3-line.svg"></i></div>
                                        <div class="icons bkg_blue_200" v-else><i><img src="/assets/images/message-3-line.svg"></i></div>
                                        <p class="htxt_bold_16 dark_800 mb-2">{{capitalizeFirstLetter(activity.action_name.replace('_', ' '))}}</p>
                                        <p class="htxt_regular_14 dark_400 mb0">{{activity.activity_message}}</p>
                                        <button class="activity_button"><i><img src="/assets/images/message-3-line-16.svg"/></i> Answer with SMS</button>
                                    </div>
                                    <div class="time"><p class="htxt_regular_14 dark_200">{{displayDateFormat('d M Y, h:i A', activity.activity_created)}}</p></div>
                                </div>
                            </div>


                        </div>
                    </div>



                </div>
                <div class="col-md-4">
                    <div class="card p20 min_h_240 ">
                        <h3 class="htxt_medium_16 dark_800">Info</h3>
                        <hr/>

                        <ul class="info_list">
                            <li><span>Source</span><strong>Email</strong></li>
                            <li><span>First Seen</span>
                                <strong v-if="personalData.regdate">{{displayDateFormat('d M Y', personalData.regdate)}}</strong>
                                <strong v-else v-html="displayNoData()"></strong>
                            </li>
                            <li><span>Lase Seen</span>
                                <strong v-if="personalData.last_login">{{displayDateFormat('d M Y', personalData.last_login)}}</strong>
                                <strong v-else v-html="displayNoData()"></strong>
                            </li>
                            <li><span>Page views</span>
                                <strong v-html="displayNoData()"></strong>
                            </li>
                            <li><span>Reviews</span>
                                <strong v-if="reviewsData">{{reviewsData.length}}</strong>
                                <strong v-else v-html="displayNoData()"></strong>
                            </li>
                            <li><span>Notification</span>
                                <strong>{{ (notificationSettings.system_notify) ? 'On' : 'Off' }}</strong>
                            </li>
                            <li><span>Id</span><strong>{{personalData.id}}</strong></li>
                            <li><span>SMS</span>
                                <strong>{{ (notificationSettings.system_notify) ? 'On' : 'Off' }}</strong>
                            </li>

                        </ul>



                    </div>
                </div>
            </div>








        </div>

    </div>
    </div>

</template>

<script>
    import UserAvatar from '../../helpers/UserAvatar';
    export default {
        components: {UserAvatar},
        data(){
            return {
                formFields : {},
                newNote : '',
                profileID : this.$route.params.id,
                profileData : {},
                personalData: {firstname:'', lastname:'', email:''},
                notesData: {},
                listData: {},
                activityData: {},
                reviewsData: {},
                notificationSettings: {}
            }
        },
        mounted() {
            axios.get('/admin/contacts/profile/'+this.profileID)
                .then(response => {
                    this.profileData = response.data;
                    this.personalData = response.data.subscribersData;
                    this.notesData = response.data.oNotes;
                    this.listData = response.data.oLists;
                    this.activityData = response.data.userActivities;
                    this.reviewsData = response.data.aReviews;
                    this.notificationSettings = response.data.notificationSettings;
                    /*console.log(response.data);*/
                });
        },
        methods : {
            submitNotes : function () {
                console.log(this.formFields);
                axios.post('/admin/contacts/add_contact_notes', this.formFields)
                    .then(response => {
                        alert('Notes added succesfully');
                        this.formFields.notes = '';
                    });

            }
        }

    }
</script>


