<template>
    <div class="h-100">
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Messenger</h3>
                    </div>
                    <div class="col-md-9 col-9 text-right">
                        <button class="circle-icon-40 mr15 bkg_light_300 shadow_none"><img
                            src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 slidebox">Main Action <span><img
                            src="assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="content-area chat_messanger_area withsidebar" style="background-color: #FFFFFF;">
            <web-side-bar
                :allChat="allChat"
                :unassignedChat="unassignedChat"
                :assignedChat="assignedChat"
                :favoriteChat="favoriteChat"
                :participantInfo="participantInfo"
                :loggedUser="user"
                :twilioNumber="twilioNumber"
                @loadWebChat="loadWebChat"
            ></web-side-bar>
            <chat-area
                :allChat="allChat"
                :unassignedChat="unassignedChat"
                :assignedChat="assignedChat"
                :favoriteChat="favoriteChat"
                :currentTokenId="currentTokenId"
                :loggedId="loggedId"
                :loggedUserInfo="user"
                :participantId="participantId"
                :participantInfo="participantInfo"
                :teamMembers="teamMembers"
                :shortcuts="shortcuts"
                :loggedUser="user"
                :twilioNumber="twilioNumber"
            ></chat-area>
            <web-profile-bar
                :currentTokenId="currentTokenId"
                :loggedId="loggedId"
                :participantId="participantId"
                :participantInfo="participantInfo"
                :loggedUser="user"
                :twilioNumber="twilioNumber"
                @loadWebChat="loadWebChat"
            ></web-profile-bar>
        </div>
        <SaveReplyPopup @updateShortcuts="fetchShortcuts"></SaveReplyPopup>
    </div>
</template>
<script>
    import WebSideBar from "./partials/WebSideBar";
    import WebProfileBar from "./partials/WebProfileBar";
    import ChatArea from "./partials/ChatArea";
    import SaveReplyPopup from "./partials/SaveReplyPopup";
    export default {
        components: {WebSideBar, WebProfileBar, ChatArea, SaveReplyPopup},
        data() {
            return {
                refreshMessage: 1,



                allSubscribers: '',
                favoriteChat: '',
                assignedChat: '',
                assignedChatData: '',
                unassignedChat: '',
                unassignedChatData: '',
                allChat: '',
                teamMembers: '',
                loggedId: '',
                selectedCampaigns: '',
                currentTokenId: '',
                participantId: '',
                participantInfo: '',
                twilioNumber: '',
                shortcuts: '',
                user: {},
                breadcrumb: ''
            }
        },
        created() {
            this.getChatContacts();
            this.fetchShortcuts();
        },
        methods: {
            getChatContacts: function () {
                axios.get('/admin/webchat')
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.allSubscribers = response.data.usersdata;
                        this.favoriteChat = response.data.favouriteUserData;
                        this.user = response.data.loginUserData;
                        this.assignedChat = response.data.assignedChat;
                        this.assignedChatData = response.data.assignedChatData;
                        this.unassignedChat = response.data.unassignedChat;
                        this.unassignedChatData = response.data.unassignedChatData;
                        this.allChat = response.data.allChat;
                        this.loggedId = response.data.loggedYou;
                        this.user = response.data.loginUserData;
                        this.twilioNumber = response.data.twilioNumber;
                        this.teamMembers = response.data.teamMembers;
                        this.showLoading(false);
                        //loadJQScript(this.user.id);
                    });
            },
            fetchShortcuts: function () {
                axios.post('/admin/webchat/listShortcuts')
                    .then(response => {
                        this.shortcuts = response.data;
                    });
            },
            loadWebChat: function (roomId, userid) {
                this.currentTokenId = roomId;
                this.participantId = userid;
                //Get Paticipant's details
                this.loadParticipantInfo(roomId, userid);
            },
            loadParticipantInfo: function (roomId, userid) {
                axios.post('/admin/webchat/getUserinfo', {
                    room: roomId,
                    chatUserid: userid,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.participantInfo = response.data;
                    });
            },
            syncConfigure: function (param1) {
                this.brandData = param1;
            },
            setSource: function (source) {
                this.showLoading(true);
                this.campaign.source_type = source;
                axios.post('/admin/modules/referral/updateSource', {
                    source_type: source,
                    ref_id: this.campaignId,
                    _token: this.csrf_token(),
                })
                    .then(response => {
                        this.displayMessage('success', 'Source has been updated successfully');
                        this.showLoading(false);
                    });
            },
            displayStep: function (step) {
                let path = '';
                if (!step) {
                    path = '/admin#/referral/';
                } else {
                    path = '/admin#/referral/setup/' + this.campaignId + '/' + step;
                }
                window.location.href = path;
            },
            updateSettings: function (fieldName, fieldValue, type) {
                this.showLoading(true);

                if (type == 'expiry') {
                    this.displayCustomLinkExpiry = fieldValue == 'custom' || fieldName == 'txtInteger' || fieldName == 'exp_duration' ? true : false;
                }
                axios.post('/admin/brandboost/saveOnsiteSettings', {
                    _token: this.csrf_token(),
                    fieldName: fieldName,
                    fieldVal: fieldValue,
                    brandboostId: this.campaignId,
                    linkExpiryData: this.campaign.link_expire_custom,
                    requestType: type
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
            }
        }
    };
    $(document).ready(function () {
        $(".saveReplyBox").click(function () {
            $(".box").animate({
                width: "toggle"
            });
        });
    });
    $(document).ready(function () {
        $(".show_saved_chat").click(function () {
            $(".chat_saved_temp").toggle();
        });
    });
    //side nav active script
    $(".nav-link.livechat").addClass("active");
    $(".nav-link.people").removeClass("active");
    $(".main-icon-menu-pane.livechat").addClass("active");
    $(".main-icon-menu-pane.people").removeClass("active");
</script>
