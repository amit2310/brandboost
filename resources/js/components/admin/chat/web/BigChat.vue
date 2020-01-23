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
        <div class="content-area chat_messanger_area">
            <web-side-bar
                :allChat="allChat"
                :unassignedChat="unassignedChat"
                :assignedChat="assignedChat"
                :favoriteChat="favoriteChat"
                @loadWebChat="loadWebChat"
            ></web-side-bar>
            <web-profile-bar
                :currentTokenId="currentTokenId"
                :loggedId="loggedId"
                :participantId="participantId"
                :participantInfo="participantInfo"
            ></web-profile-bar>
            <chat-area
                :currentTokenId="currentTokenId"
                :loggedId="loggedId"
                :loggedUserInfo="user"
                :participantId="participantId"
                :participantInfo="participantInfo"
                :shortcuts="shortcuts"
            ></chat-area>
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
                successMsg: '',
                errorMsg: '',
                loading: true,
                allSubscribers: '',
                favoriteChat: '',
                assignedChat: '',
                assignedChatData: '',
                unassignedChat: '',
                unassignedChatData: '',
                allChat: '',
                loggedId: '',
                selectedCampaigns: '',
                currentTokenId: '',
                participantId: '',
                participantInfo: '',
                shortcuts: '',
                user: {},
                breadcrumb: ''
            }
        },
        created() {
            this.getChatContacts();
            this.fetchShortcuts();
        },
        mounted() {

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
                        this.loading = false;
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
                this.loading = true;
                this.campaign.source_type = source;
                axios.post('/admin/modules/referral/updateSource', {
                    source_type: source,
                    ref_id: this.campaignId,
                    _token: this.csrf_token(),
                })
                    .then(response => {
                        this.successMsg = 'Source has been updated successfully';
                        this.loading = false;
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
                this.loading = true;

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
                    this.refreshMessage = Math.random();
                    this.successMsg = 'Updated the changes successfully!!';
                    this.loading = false;
                });

            },
            saveDraft: function () {
                this.loading = true;
                axios.post('/admin/broadcast/updateBroadcast', {
                    broadcastId: this.campaignId,
                    status: 'draft',
                    current_state: '',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        if (response.data.status == 'success') {
                            this.successMsg = 'Campaign saved as a draft successfully';
                        } else {
                            this.errorMsg = 'Something went wrong';
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
        $(".show_emoji").click(function () {
            $(".chat_emoji_box").toggle();
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



