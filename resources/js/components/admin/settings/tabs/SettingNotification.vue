<template>
    <div>
        <!--******************Top Heading area **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Brand Settings</h3>
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li><a href="#/settings/general" tyle="cursor:pointer; padding: 5px;">General&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/preferences" style="cursor:pointer; padding: 5px;"> Preferences&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/subscription" style="cursor:pointer; padding: 5px;">Subscription & Credits&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/billing" style="cursor:pointer; padding: 5px;">Billing&nbsp;</a></li>&nbsp;&nbsp;
                            <li class="active"><a href="#/settings/notification" style="cursor:pointer; padding: 5px;">Notifications&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/import" style="cursor:pointer; padding: 5px;">Import&nbsp;</a></li>&nbsp;&nbsp;
                            <li><a href="#/settings/export" style="cursor:pointer;">Export</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix">&nbsp;</div>


            <loading :isLoading="loading"></loading>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-flat review_ratings">
                    <div class="panel-heading" style="padding: 10px;">
                        <h4  class="panel-title">Notification Center</h4>
                    </div>

                    <div class="panel-body p0">
                        <!--====GENERAL SETTINGS====-->
                        <div class="bbot p30">
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="text-muted">General</p>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <p class="pull-left mb0">System Notification<br>
                                            <span class="text-muted fsize11">Receive system notification every time you get new event
                                            </span></p>
                                        <label class="custom-form-switch pull-right">
                                            <input class="field updatecompanyprofileinfo" name="system_notify" type="checkbox" v-model="notificationData.system_notify" @change="synSystemNotify($event)">
                                            <span class="toggle"></span> </label>
                                        <div class="clearfix"></div>
                                    </div>


                                    <div class="form-group">
                                        <p class="pull-left mb0">Floating notification sound<br>
                                            <span class="text-muted fsize11">Play sound when a visitor sends a new message.
                                            </span></p>
                                        <label class="custom-form-switch pull-right">
                                            <input class="field updatecompanyprofileinfo"
                                            v-model="notificationData.notify_sound" @change="synNotifySound($event)" type="checkbox" >
                                            <span class="toggle"></span> </label>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-group">
                                        <p class="pull-left mb0">New unread notifications icon in browser tab<br>
                                            <span class="text-muted fsize11">Show that you have new unread notifications in your notification center by displaying a red dot on the Brand Boost icon in your browser tab.
                                            </span></p>
                                        <label class="custom-form-switch pull-right">
                                            <input class="field updatecompanyprofileinfo" v-model="notificationData.browser_notify" type="checkbox" @change="synBrowserNotify($event)">
                                            <span class="toggle"></span> </label>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="text-muted">Events</p>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group" v-for="notifyEvent in notificationlisting">
                                        <p class="pull-left mb0">{{notifyEvent.notification_name}}</p>
                                        <label class="custom-form-switch pull-right">
                                            <input class="field" @change="updateNotificationPermisson(notifyEvent.notification_slug)"
                                            :checked="checkPermissionentry(notifyEvent.notification_slug)" type="checkbox" >
                                            <span class="toggle"></span> </label>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="text-muted">Inactivity Length</p>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label">Minutes</label>
                                        <div class="">
                                            <input name="company_phone" class="form-control" type="text" placeholder="120"
                                                   v-model="notificationData.inactivity_length" @blur="synInactivityLength($event)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-md-5">
                <div class="panel panel-flat review_ratings">
                    <div class="panel-heading" style="padding: 10px;">
                        <h4  class="panel-title">Email Notifications</h4>
                    </div>
                </div>
                <div class="panel-body p0">
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted">Email</p>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                        <label class="control-label">Email notification</label>
                                        <span class="display-inline-block pull-right fsize11 text-muted">Receive an email every time you get new event &nbsp; &nbsp;
                                            <label class="custom-form-switch pull-right">
                                                <input class="field" type="checkbox" v-model="notificationData.email_notify" @change="synEmailNotify($event)">
                                                <span class="toggle blue"></span>
                                            </label>
                                        </span>
                                        <div class="">
                                            <label class="control-label">Email</label>
                                            <input name="company_phone" class="form-control"
                                                   v-model="notificationData.notify_email" @blur="synNotifyEmail($event)"
                                                   type="text" placeholder="max@wakers.co">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-flat review_ratings">
                    <div class="panel-heading" style="padding: 10px;">
                        <h4  class="panel-title">Sms Notifications</h4>
                    </div>
                </div>
                <div class="panel-body p0">
                    <div class="bbot p30">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-muted">Sms</p>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                        <label class="control-label">Sms notification</label>
                                        <span class="display-inline-block pull-right fsize11 text-muted">Receive an Sms every time you get new event &nbsp; &nbsp;
                                            <label class="custom-form-switch pull-right">
                                                <input class="field" type="checkbox"
                                                @change="synSmsNotify($event)" v-model="notificationData.sms_notify">
                                                <span class="toggle blue"></span>
                                            </label>
                                        </span>
                                        <div class="">
                                            <label class="control-label">SMS</label>
                                            <input @blur="synNotifyPhone($event)" v-model="notificationData.notify_phone"
                                                   class="form-control" type="text" placeholder="xx-xx-xx-xx">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SettingNotification",
        title: 'Admin Settings - Brand Boost',
        data() {
            return {
                refreshMessage: '',


                loading: true,
                breadcrumb: '',
                seletedTab: 1,
                settingsData: '',
                notificationData: '',
                notificationEventData: '',
                oImportHistory: '',
                oExportHistory: '',
                oMemberships: '',
                oCurrentPlanData: '',
                oCurrentTopupPlanData: '',
                oInvoices: '',
                invoiceData: '',
                notificationlisting: '',
                oUser: '',
                countries: {},
                ccCardDetail: {},
                current_page: 1,
            }
        },
        mounted() {
            this.loadData();
            setTimeout(function(){
                loadJQCode();
            },2000);
        },
        filters: {
            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            }
        },

        methods: {

            loadData: function () {
                //getData
                this.loading = true;
                console.log(this.current_page);
                axios.get('/admin/settings?page='+this.current_page,{
                        params: {
                            current_tab:'notification'
                        }
                    })
                    .then(response => {
                        //console.log(response.data);
                        this.loading = false;
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.settingsData = response.data.settingsData;
                        this.notificationData = response.data.notificationData;
                        this.notificationEventData = response.data.notificationEventData;
                        this.oImportHistory = response.data.oImportHistory;
                        this.oExportHistory = response.data.oExportHistory;
                        this.oMemberships = response.data.oMemberships;
                        this.oCurrentPlanData = response.data.oCurrentPlanData;
                        this.oCurrentTopupPlanData = response.data.oCurrentTopupPlanData;
                        this.seletedTab = response.data.seletedTab;
                        this.oInvoices = response.data.oInvoices;
                        this.invoiceData = response.data.invoiceData;
                        this.notificationlisting = response.data.notificationlisting;
                        this.oUser = response.data.oUser;
                        this.countries = response.data.countries;
                    });
            },
            checkPermissionentry: function(notification_slug){
                var i =0;
                var found =0;
                for (i=0; i < this.notificationEventData.length; i++) {
                    if(this.notificationEventData[i].notification_slug == notification_slug){
                        found =1;
                        return true;
                    }else{
                        found =0;
                    }
                }
                if(found ==0){
                    return false;
                }
            },
            synSystemNotify: function(e){
                this.updateSingleField('system_notify',this.notificationData.system_notify);
            },
            synNotifySound: function(e){
                this.updateSingleField('notify_sound',this.notificationData.notify_sound);
            },
            synBrowserNotify: function(e){
                this.updateSingleField('browser_notify',this.notificationData.browser_notify);
            },
            synInactivityLength: function(e){
                this.updateSingleField('inactivity_length',this.notificationData.inactivity_length);
            },

            synEmailNotify: function(e){
                this.updateSingleField('email_notify',this.notificationData.email_notify);
            },
            synNotifyEmail: function(e){
                this.updateSingleField('notify_email',this.notificationData.notify_email);
            },
            synSmsNotify: function(e){
                this.updateSingleField('sms_notify',this.notificationData.sms_notify);
            },
            synNotifyPhone: function(e){
                this.updateSingleField('notify_phone',this.notificationData.notify_phone);
            },
            updateSingleField: function (fieldName, fieldValue) {
                this.loading = true;
                axios.post('admin/settings/updateNotificationSettings', {
                    _token: this.csrf_token(),
                    fieldname: fieldName,
                    fieldval: fieldValue,
                }).then(response => {

                    this.displayMessage('success', 'Test email sent successfully!');
                    this.loadData();
                    this.loading = false;
                });

            },
            updateNotificationPermisson: function (notification_slug) {
                console.log(notification_slug);
                this.loading = true;
                axios.post('admin/settings/updateNotificationPermisson', {
                    _token: this.csrf_token(),
                    notification_slug: notification_slug,
                }).then(response => {

                    this.displayMessage('success', 'Test email sent successfully!');
                    this.loadData();
                    this.loading = false;
                });

            },

        }
    }
    function loadJQCode(){
        $(document).ready(function () {

        });

    }
</script>

<style scoped>

</style>
