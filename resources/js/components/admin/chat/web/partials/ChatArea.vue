<template>
    <div>
        <loading :isLoading="loading"></loading>
        <div class="p25 pl30 pr30 bbot">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="fsize18 dark_800 fw500"><img src="assets/images/atrate_28.svg"/> &nbsp;
                        {{participantInfo.name}}</h3>
                </div>
                <div class="col-md-9">

                    <div class="action_list">
                        <ul>
                            <li><a href="javascript:void(0);"><img src="assets/images/bookmark-line.svg"/></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/price-tag-line.svg"/></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/time-line.svg"/></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/checklineGroup.svg"/></a></li>
                        </ul>
                    </div>
                    <div class="chat_user_list">
                        <ul>
                            <li><a href="javascript:void(0);"><img src="assets/images/avatar/01.png"/></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/avatar/02.png"/></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/avatar/03.png"/></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/avatar/04.png"/></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/Plus_grey_circle.svg"/></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="p0 bbot position-relative chat_mis_sec">
            <!--<a class="slidebox user_profile_show" href="javascript:void(0);"><img src="assets/images/user_profile_show.svg"/></a>-->

            <div class="tab-content">
                <!--======Tab 1====-->
                <div id="MessageView" class="tab-pane active">
                    <div class="mainchatsvroll2">
                        <ul class="media-list chat-list">

                            <li class="media" v-for="row in chatData" :class="{reversed: row.user_form == loggedId}">
                                <div class="media-body">
                                    <!--<span class="media-annotation user_icon" v-html="row.avatarImage">
                                        <span class="circle_green_status status-mark"></span>
                                        <img
                                            :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/${row.avatarImage}`"
                                            class="img-circle img-xxs" alt="">
                                    </span>-->
                                    <span class="media-annotation user_icon" v-if="row.avatar">
                                        <span class="icons s32">
                                            <img :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/${row.avatar}`" onerror="this.src='/assets/images/default_avt.jpeg'" class="img-circle" alt="" width="36" height="36">
                                        </span>
                                    </span>
                                    <span class="media-annotation user_icon" v-else>
                                        <span class="icons fl_letters s32" style="width:40px!important;height:40px!important;line-height:40px;font-size:13px;">{{row.firstname.charAt(0)+ '' +row.lastname.charAt(0)}}</span>
                                    </span>
                                    <div class="media-content" v-html="row.message"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--======Tab 2=====-->
                <div id="NoteView" class="tab-pane fade">
                    <div class="p20">
                        Note Section
                    </div>
                </div>
                <!--======Tab 3=====-->
                <div id="EmailView" class="tab-pane fade">
                    <div class="p20">
                        Email Section
                    </div>
                </div>
                <!--======Tab 4=====-->
                <div id="TextMessageView" class="tab-pane fade">

                    <div class="p20">
                        Text Message View
                    </div>
                </div>
            </div>
        </div>
        <div class="p30 pb0 bbot" style="min-height: 120px;">
     	<textarea
            class="p0 w-100 border-0 fsize16 dark_200"
            v-model="enteredMessage"
            style="height: 85px; resize: none;"
            @keypress="submitMessage($event)"
            @keyup="cleanManager($event)"
            placeholder="Shift + Enter to add a new line
    Start with ‘/’ to select a  Saved Message">
     	</textarea>
        </div>
        <div class="p30">
            <div class="row">
                <div class="col-md-7">
                    <ul class="nav nav-pills messanger_tab" role="tablist">
                        <li><a class="active" data-toggle="pill" href="#MessageView"><img
                            src="assets/images/message-2-line.svg"/> &nbsp; Message</a></li>
                        <li><a data-toggle="pill" href="#NoteView"><img src="assets/images/file-3-line-grey.svg"/>
                            &nbsp; Note</a></li>
                        <li><a data-toggle="pill" href="#EmailView"><img src="assets/images/mail-open-line.svg"/> &nbsp;
                            Email</a></li>
                        <li><a data-toggle="pill" href="#TextMessageView"><img
                            src="assets/images/message-3-line-grey.svg"/> &nbsp; Text Message</a></li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <div class="action_list">
                        <!--*****EMOJI*****-->
                        <div class="chat_emoji_box">
                            <div class="form-group">
                                <input type="text" class="form-control search fsize13 h48"
                                       placeholder="Search template"/>
                            </div>
                            <div class="emoji_box mb20">
                                <p class="htxt_medium_15 dark_800 mb-1 fw500">Recent</p>
                                <ul class="emojisec">
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-eye-face-joke-tongue-wink-emoji-stuckout-37676.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-hand-medium-skin-tone-v-victory-37773.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-blush-eye-face-smile-flirt-emoji-37658.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-angry-face-mad-pouting-rage-red-emoji-37653.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-biceps-comic-flex-medium-skin-tone-muscle-37748.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-face-mouth-open-sympathy-emoji-37685.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-grinning-face-smile-emoji-happy-37705.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-bright-cool-eye-eyewear-face-glasses-smile-sun-sunglasses-emoji-37654.svg"/></a>
                                    </li>

                                </ul>
                            </div>
                            <div class="emoji_box mb20">
                                <p class="htxt_medium_15 dark_800 mb-1 fw500">Smiles & People</p>
                                <ul class="emojisec">
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-eye-face-joke-tongue-wink-emoji-stuckout-37676.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-expressionless-face-inexpressive-unexpressive-emoji-37678.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-face-unamused-unhappy-angry-emoji-37702.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-blush-eye-face-smile-flirt-emoji-37658.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-face-sleep-emoji-tired-37692.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-face-sleep-zzz-tired-bore-emoji-37691.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-grinning-face-smile-emoji-happy-37705.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-face-tongue-stuck-out-emoji-37695.svg"/></a></li>


                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-face-kiss-flirt-emoji-37697.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-grinning-face-with-smiling-eyes-happy-emoji-37710.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-grinning-face-smile-emoji-happy-37705.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-delicious-face-savouring-smile-um-yum-eye-emoji-37671.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-dizzy-face-error-emoji-37670.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-confounded-face-sad-cry-unhappy-emoji-37707.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-cold-face-open-smile-sweat-happy-emoji-37709.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-disappointed-face-sad-emoji-37669.svg"/></a></li>


                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-blush-eye-face-smile-flirt-emoji-37658.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-expressionless-face-inexpressive-unexpressive-emoji-37678.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-eye-face-love-smile-heart-emoji-37674.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-angry-face-mad-emoji-37652.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-angry-face-mad-pouting-rage-red-emoji-37653.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-hand-medium-skin-tone-wave-waving-37774.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-clenched-fist-hand-medium-light-skin-tone-punch-37735.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-backhand-down-finger-hand-index-medium-light-skin-tone-point-37723.svg"/></a>
                                    </li>


                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-biceps-comic-flex-medium-skin-tone-muscle-37748.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-backhand-finger-hand-index-medium-light-skin-tone-point-up-37722.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-clap-hand-medium-skin-tone-37733.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-hand-medium-light-skin-tone-thumb-up-37775.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-cat-face-mouth-open-smile-emoji-37664.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-cat-face-joy-tear-happy-emoji-37666.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-cat-face-mouth-open-smile-emoji-37664.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img
                                        src="assets/images/emojie-cat-face-ironic-smile-wry-emoji-37662.svg"/></a></li>

                                </ul>
                            </div>
                        </div>
                        <!--*****SAVED MESSAGE*****-->
                        <div class="chat_saved_temp" v-show="showShortcuts"
                             style="display:block!important;overflow:auto;">
                            <a class="cross_icon pull-right" @click="hideSaveMessages"
                               style="margin-top:-30px;cursor:pointer;"><i>X</i></a>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-11">
                                        <input type="text" v-model="searchShortcut"
                                               class="form-control search fsize13 h48"
                                               placeholder="Search Saved Reply"/>
                                    </div>
                                    <div class="col-md-1 pl-0">
                                        <button class="btn_plus_icon saveReplyBox"><img
                                            src="assets/images/add-fill.svg"/></button>
                                    </div>
                                </div>
                            </div>
                            <div class="savedchat mb-2" v-for="sc in filteredListShortcut">
                                <p class="htxt_medium_16 dark_800 mb-2" v-html="sc.name"></p>
                                <p class="htxt_regular_14 dark_200" v-html="setStringLimit(sc.conversatation,100)"></p>
                            </div>
                        </div>
                        <ul>
                            <li><a class="active show_emoji" href="javascript:void(0);"><img
                                src="assets/images/user-smile-line.svg"></a></li>
                            <li><a class="show_saved_chat" href="javascript:void(0);"><img
                                src="assets/images/clipboard-line.svg"></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/Image_18.svg"></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/attachment-line.svg"></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/add-circle-line.svg"></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/submit_btn_icon.svg"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['currentTokenId', 'loggedId', 'loggedUserInfo', 'participantId', 'participantInfo', 'shortcuts'],
        data() {
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                loading: false,
                chatData: '',
                searchShortcut: '',
                enteredMessage: '',
                loggedAvatar: '',
                showShortcuts: false
            }
        },
        sockets:{
            connect: function () {
                this.$socket.emit('subscribe', this.currentTokenId);
            },
            'receiveMessage': function(data){
                //alert('Hello I recived something');
                let newObj = {
                    user_form: data.currentUser,
                    avatar: (data.currentUser == this.loggedId) ? this.loggedAvatar : '',//data.avatar,
                    message:data.msg,
                    firstname: 'New',
                    lastname: 'User'
                };
                this.chatData.push(newObj);
                let el = this;
                setTimeout(function () {
                    el.scrollToEnd();
                }, 10);
            }
        },
        mounted() {

        },
        computed: {
            filteredListShortcut() {
                if (this.shortcuts) {
                    return this.shortcuts.filter(shortcut => {
                        return (shortcut.name.toLowerCase().includes(this.searchShortcut.toLowerCase()) || shortcut.conversatation.toLowerCase().includes(this.searchShortcut.toLowerCase()))
                    });
                }

            }
        },
        watch: {
            loggedUserInfo: function(){
                //this.loggedAvatar = this.loggedUserInfo.avatar ? 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'+this.loggedUserInfo.avatar : this.siteUrl()+'admin_new/images/userp.png';
                this.loggedAvatar = this.loggedUserInfo.avatar;
            },
            currentTokenId: function () {
                this.$socket.emit('subscribe', this.currentTokenId);
                this.loading = true;
                axios.post('/webchat/getMessages', {
                    room: this.currentTokenId,
                    offset: '0',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if (response.data.status == 'ok') {
                            this.chatData = response.data.res;
                        }
                        this.loading = false;
                        let el = this;
                        setTimeout(function () {
                            el.scrollToEnd();
                        }, 500);
                    });

            },
            participantInfo: function () {

            },
        },
        methods: {
            submitMessage: function (ev) {
                this.showAuthorTyping();
                this.hideSaveMessages();
                if (ev.keyCode == 13 && ev.shiftKey) {
                    //Add New Line
                    //alert('Adding new line');
                    return false;
                }
                if (ev.keyCode === 13) {
                    //Pressed Enter
                    this.sendMessage();
                }
                if (ev.keyCode === 47) {
                    //Pressed slash(/)
                    this.listSaveMessages();
                }
            },
            showAuthorTyping: function () {
                let wait = '5000';
                this.$socket.emit('wait_message_widget', {
                    room: this.currentTokenId,
                    chatTo: this.participantId,
                    currentUser: this.loggedId,
                    wait: wait
                });
            },
            transmitMessage: function () {
                if (this.enteredMessage.length > 0) {
                    this.$socket.emit('chat_message', {
                        room: this.currentTokenId,
                        chatTo: this.participantId,
                        currentUser: this.loggedId,
                        msg: this.enteredMessage,
                        currentUserName: '',
                        avatar: this.loggedAvatar
                    });
                    /*let newObj = {
                        user_form: this.participantId,
                        avatarImage: this.loggedAvatar,
                        message:this.enteredMessage
                    };
                    this.chatData.push(newObj);
                    this.scrollToEnd();*/
                }
            },
            cleanManager: function (ev) {
                if (ev.keyCode === 8) {
                    //Pressed backspace(/)
                    this.hideSaveMessages();
                }
            }
            ,
            sendMessage: function () {
                this.transmitMessage();
                axios.post('/admin/webchat/addChatMsg', {
                    room: this.currentTokenId,
                    msg: this.enteredMessage,
                    chatTo: this.participantId,
                    currentUser: this.loggedId,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if (response.data.status == 'ok') {
                            this.enteredMessage = '';
                        }
                    });
            }
            ,
            listSaveMessages: function () {
                this.showShortcuts = true;
            }
            ,
            hideSaveMessages: function () {
                this.showShortcuts = false;
            }
            ,
            scrollToEnd: function () {
                let container = this.$el.querySelector(".mainchatsvroll2");
                container.scrollTop = container.scrollHeight;
            }
            ,
        }
    };
</script>
