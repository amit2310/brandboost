<template>
    <div>

        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">{{campaign.title}}</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-md bkg_light_000 dark_300 slidebox mr10 pr20"
                                v-if="campaign.bc_status !='archive'" @click="saveDraft"> Save as draft
                        </button>
                        <button class="btn btn-md bkg_email_300 light_000 slidebox"> Next <span style="opacity: 1"><img
                            src="/assets/images/arrow-right-line-white.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--Content Area-->
        <div class="content-area">



            <div class="container-fluid">


                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="email_config_list">
                                <li><a class="done" href="javascript:void(0);" @click="displayStep(1)"><span
                                    class="num_circle"><span class="num">1</span><span class="check_img"><img
                                    src="/assets/images/email_check.svg"/></span></span>Basic campaign info</a></li>
                                <li><a class="done" href="javascript:void(0);" @click="displayStep(2)"><span
                                    class="num_circle"><span class="num">2</span><span class="check_img"><img
                                    src="/assets/images/email_check.svg"/></span></span>Content & Design</a></li>
                                <li><a class="done" href="javascript:void(0);" @click="displayStep(3)"><span
                                    class="num_circle"><span class="num">3</span><span class="check_img"><img
                                    src="/assets/images/email_check.svg"/></span></span>Recipients</a></li>
                                <li><a class="done" href="javascript:void(0);" @click="displayStep(4)"><span
                                    class="num_circle"><span class="num">4</span><span class="check_img"><img
                                    src="/assets/images/email_check.svg"/></span></span>Review & confirm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="htxt_bold_20 dark_700 mb20 mt40">Are you ready to send this email to {{totalSubscribers.total}}
                            subscribers?</h3>
                        <p class="htxt_normal_14 dark_200 mb40 mt20">It’s very easy to create or import!</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 text-center animate_top">
                        <label for="opt1" class="d-block mylablel"
                               :class="{active: set_scheduler=='now'}"
                               @click="setScheduler('now')"
                        >
                            <div class="card br8 p0 m-0">

                                <label class="custmo_checkbox email_config">
                                    <input id="opt1" type="radio" name="scheduler">
                                    <span class="custmo_checkmark"></span>

                                </label>


                                <div class="p40 pb20">
                                    <img class="mt20" src="/assets/images/send-right-now.svg"/>
                                    <h3 class="htxt_medium_16 dark_700 mb30 mt30">Send right now</h3>
                                </div>
                                <div class="p20 btop">
                                    <a class="fsize14 fw500 email_500" href="javascript:void(0);">Send email immediately</a>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-6 text-center animate_top">
                        <label for="opt2" class="d-block mylablel"
                               :class="{active: set_scheduler=='schedule'}"
                               @click="setScheduler('schedule')"
                        >
                            <div class="card br8 p0 m-0">
                                <label class="custmo_checkbox email_config">
                                    <input id="opt2" type="radio" name="scheduler" checked>
                                    <span class="custmo_checkmark"></span>
                                </label>
                                <div class="p40 pb20">
                                    <img class="mt20" src="/assets/images/schedule.svg"/>
                                    <h3 class="htxt_medium_16 dark_700 mb30 mt30">Send specific time</h3>
                                </div>
                                <div class="p20 btop">
                                    <a class="fsize14 fw500 email_500" href="javascript:void(0);">Schedule email on time
                                        or date</a>
                                </div>
                            </div>
                        </label>


                    </div>

                </div>

                <div class="row mt40">
                    <div class="col-md-12">
                        <hr class="mb25">
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_none border dark_200 pl10 min_w_96" @click="displayStep(4)"><span
                            class="ml0 mr10"><img src="/assets/images/arrow-left-line.svg"></span>Back
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-sm bkg_email_300 light_000 float-right" @click="launchCampaign">Launch
                            Campaign <span><img src="/assets/images/arrow-right-line.svg"></span></button>
                    </div>

                </div>

            </div>
        </div>
        <!--Content Area End-->
        <modal-popup v-if="showModal" @close="showModal = false" width="sm">
            <h3 slot="header">Schedule Time</h3>
            <div slot="body" class="pt0 pb0">

                <div v-show="isUpdatedSchedule" class="alert alert-success">Schedule updated successfully<i
                    class="close" @click="isUpdatedSchedule=false">x</i></div>
                <div class="media_left p10">
                    <label class="control-label">Date</label>
                    <datetime
                        v-model="scheduleDate"
                        input-class="my-class form-control"
                        format="LLL dd, yyyy"
                    ></datetime>
                </div>
                <div class="media_left p10">
                    <label class="control-label">Time</label>
                    <datetime
                        type="time"
                        v-model="scheduleTime"
                        input-class="my-class form-control"
                        format="hh:mm a"
                        use12-hour
                    ></datetime>
                </div>
                <div class="clearfix"></div>
            </div>
            <div slot="footer">
                <button type="button" class="btn btn-md bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600"
                        @click="confirmUpdateSchedule">Save
                </button>
                <a href="javascript:void(0);" class="blue_300 fsize16 fw600 ml20" @click="showModal = false">Close</a>
            </div>
        </modal-popup>

    </div>
</template>
<script>
    import {DateTime as LuxonDateTime} from 'luxon';
    import {Datetime} from 'vue-datetime';

    import 'vue-datetime/dist/vue-datetime.css';
    import modalPopup from "@/components/helpers/Common/ModalPopup";

    export default {
        components: {datetime: Datetime, modalPopup},
        data() {
            return {



                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                campaignId: this.$route.params.id,
                campaign: {},
                user: {},
                breadcrumb: '',
                set_scheduler: '',
                scheduleDate: '',
                scheduleTime: '',
                showModal: false,
                isUpdatedSchedule: false,
                totalSubscribers: 0
            }
        },
        mounted() {
            this.set_scheduler = 'schedule';
            axios.get('/admin/broadcast/setup/' + this.campaignId)
                .then(response => {
                    this.breadcrumb = response.data.breadcrumb;
                    this.makeBreadcrumb(this.breadcrumb);
                    this.moduleName = response.data.moduleName;
                    this.campaign = response.data.oBroadcast;
                    let scheduleData = JSON.parse(this.campaign.data);
                    let rawDate = this.displayDateFormat('Y-m-d', scheduleData.delivery_date);
                    this.scheduleDate = rawDate + 'T00:00:00.000Z';
                    this.scheduleTime = LuxonDateTime.fromFormat(scheduleData.delivery_time,'hh:mm a').toISO();
                    this.user = response.data.userData;
                    this.totalSubscribers = response.data.subscribers;
                    this.showLoading(false);
                });
        },
        methods: {
            confirmUpdateSchedule: function () {
                this.isUpdatedSchedule = false;
                let selectedDate = LuxonDateTime.fromISO(this.scheduleDate).toFormat('LL/dd/yyyy');
                let selectedTime = LuxonDateTime.fromISO(this.scheduleTime).toFormat('hh:mm a');

                //alert(selectedDate + ' And Time is ' + selectedTime);
                //Update settings now
                this.showLoading(true);
                axios.post('/admin/broadcast/updateBroadcastSettings', {
                    _token: this.csrf_token(),
                    delivery_date: selectedDate,
                    delivery_time: selectedTime,
                    event_id: this.campaign.event_id,
                    campaign_id: this.campaign.id,
                    broadcast_id: this.campaign.broadcast_id
                }).then(response => {
                    this.isUpdatedSchedule = true;
                    this.showLoading(false);
                });
            },
            displayStep: function (step) {
                let path = '/admin#/modules/emails/broadcast/setup/' + this.campaignId + '/' + step;
                window.location.href = path;
            },
            applyDefaultInfo: function (e) {
                if (e.target.checked) {
                    this.campaign.from_email = this.user.email;
                    this.campaign.from_name = this.user.firstname + ' ' + this.user.lastname;
                    this.updatesettings('from_email');
                    this.updatesettings('from_name');
                } else {

                }
            },
            updatesettings: function (fieldName) {
                this.showLoading(true);
                axios.post('/admin/broadcast/updateBroadcastSettings', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: this.campaign[fieldName],
                    event_id: this.campaign.event_id,
                    campaign_id: this.campaign.id,
                    broadcast_id: this.campaign.broadcast_id
                }).then(response => {
                    this.displayMessage('success', 'Test email sent successfully!');
                    this.showLoading(false);
                });

            },

            saveDraft: function () {
                this.showLoading(true);
                axios.post('/admin/broadcast/updateBroadcast', {
                    broadcastId: this.campaignId,
                    status: 'draft',
                    current_state: '',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.showLoading(false);
                        if (response.data.status == 'success') {
                            this.displayMessage('success', 'Campaign saved as a draft successfully');
                        } else {
                            this.displayMessage('error', 'Something went wrong');
                        }
                    });
            },
            setScheduler: function (method) {
                this.set_scheduler = method;
                if (method == 'schedule') {
                    this.showModal = true;
                }

                if(method == 'now'){
                    let isoTime = LuxonDateTime.local().toISO();
                    this.scheduleDate = isoTime;
                    this.scheduleTime = isoTime;
                    this.confirmUpdateSchedule();
                    this.isUpdatedSchedule = false;

                }

            },
            launchCampaign: function () {
                if (confirm('Are you sure? This will make your campaign active')) {
                    this.showLoading(true);
                    axios.post('/admin/broadcast/updateBroadcast', {
                        broadcastId: this.campaignId,
                        status: 'active',
                        current_state: '',
                        _token: this.csrf_token()
                    })
                        .then(response => {
                            this.showLoading(false);
                            if (response.data.status == 'success') {
                                this.displayMessage('success', 'Campaign has been launched successfully');
                            } else {
                                this.displayMessage('error', 'Something went wrong');
                            }
                        });
                }

            }
        }

    };
</script>



