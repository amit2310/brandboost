<template>
    <div class="page_sidebar bkg_light_000 absl">
        <div class="inner2 pb0">
            <div class="title-box">
                <h6 class="menu-title" style="line-height: 36px;">
                    <!--<span class="button-menu-mobile_sidebar"><img src="assets/images/close_menu_circle.svg"></span> &nbsp; -->
                    LIVE MESSENGER</h6>
            </div>
            <h3 class="htxt_medium_20 dark_800">Contacts </h3>
            <div class="bbot btop contact_sort pt15 pb15 mt-3">
                <div class="row">
                    <div class="col">
                        <div class="tdropdown ml0">
                            <a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey"
                               data-toggle="dropdown" aria-expanded="false">{{selTabTitle}}</a>
                            <ul style="right: 0px!important; margin-top: 18px; left: -20px;"
                                class="dropdown-menu dropdown-menu-left chat_dropdown">
                                <li><strong><a href="javascript:void(0);" class="chatdropdown" :class="{'active': this.selTab == 'all'}" @click="changeTab('all')"><img class="small"
                                                                                                  src="assets/images/cd_icon1.png">
                                    All ({{allChat.length}}) </a></strong></li>
                                <li><strong><a href="javascript:void(0);" class="chatdropdown" :class="{'active': this.selTab == 'unassign'}" @click="changeTab('unassign')"><img class="small"
                                                                                          src="assets/images/cd_icon2.png">Unassigned
                                    ({{unassignedChat.length}}) </a></strong></li>
                                <li><strong><a href="javascript:void(0);" class="chatdropdown" :class="{'active': this.selTab == 'you'}" @click="changeTab('you')"><img class="small"
                                                                                   src="assets/images/cd_icon3.png">You
                                    ({{assignedChat.length}}) </a></strong></li>
                                <li><strong><a href="javascript:void(0);" class="chatdropdown" :class="{'active': this.selTab == 'favorite'}" @click="changeTab('favorite')"><img class="small"
                                                                                        src="assets/images/cd_icon4.png">Favorite
                                    ({{favoriteChat.length}}) </a></strong></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="tdropdown ml0 pull-right">
                            <a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey"
                               data-toggle="dropdown" aria-expanded="true">{{sortTitle}}</a>
                            <ul style="margin-top: 18px; right: -20px;"
                                class="dropdown-menu dropdown-menu-left chat_dropdown width_170">
                                <li><strong><a :class="{ 'active': sortType == 'new' }" href="javascript:void(0);"
                                               @click="sortChatContacts('new', 'Newest')">Newest </a></strong></li>
                                <li><strong><a :class="{ 'active': sortType == 'old' }" href="javascript:void(0);"
                                               @click="sortChatContacts('old', 'Oldest')">Oldest </a></strong></li>
                                <li><strong><a :class="{ 'active': sortType == 'wait' }" href="javascript:void(0);"
                                               @click="sortChatContacts('wait', 'Waiting longest')">Waiting
                                    longest </a></strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar_search_big mt10">
                <input type="text" name="" value="" placeholder="Search">
                <button class="sidebar_search_submit"><img src="assets/images/filter-3-line.svg"></button>
            </div>
        </div>
        <div class="p20 pt0">
            <ul class="nav nav-pills chat_contact_tab" role="tablist">
                <li class="mr10"><a class="htxt_bold_13 chatdropdown active" ref="all" @click="updateSelectedTab($event, 'all', 'All ('+allChat.length+')')" data-toggle="pill" href="#All">All
                    ({{allChat.length}})</a></li>
                <li class="mr10"><a class="htxt_bold_13 chatdropdown" ref="unassign"  @click="updateSelectedTab($event, 'unassign', 'Unassigned ('+unassignedChat.length+')')" data-toggle="pill" href="#Unassigned">Unassigned
                    ({{unassignedChat.length}})</a></li>
                <li class=""><a class="htxt_bold_13 chatdropdown" ref="you"  @click="updateSelectedTab($event, 'you', 'You ('+assignedChat.length+')')" data-toggle="pill" href="#You">You ({{assignedChat.length}})</a>
                </li>
            </ul>
        </div>
        <div class="tab-content" style="height:600px;overflow-y:auto;overflow-x:hidden;">
            <!--======Tab 1====-->
            <div id="All" class="tab-pane active">
                <div class="p20 pt0 pb0 bkg_light_050">
                    <ul class="list_with_icons">
                        <li v-for="contact in allChat" class="d-flex" :class="{ 'active': selContacts == contact.user }"
                            :userid="contact.user" style="cursor:pointer;"
                            @mouseup="loadChatArea(contact.room, contact.user, contact)">
                            <div class="media_left">
                                <user-avatar
                                    :avatar="''"
                                    :firstname="getName(contact.user_name).firstName"
                                    :lastname="getName(contact.user_name).lastName"
                                ></user-avatar>
                                <!--<span class="circle_32 bkg_light_000"><img src="assets/images/avatar/02.png"/></span>-->
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">
                                    {{setStringLimit(getName(contact.user_name).fullName, 20)}}</p>
                                <p class="dark_300 fw300 fsize12 lh_16" :ref="`allLastMsg${contact.room}`">{{setStringLimit(contact.lastMessageInfo.lastMessage,20)}}</p>
                                <span class="time fsize10 light_800">{{contact.lastMessageInfo.messageTime}}</span>
                            </div>
                            <div class="time_badge" :ref="`all${contact.room}`" @click="refreshUnreadCount(contact)">
                                <span class="badge badge-grey chatlist" v-if="contact.unreadCount">{{contact.unreadCount}}</span>
                            </div>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!--======Tab 2=====-->
            <div id="Unassigned" class="tab-pane fade">
                <div class="p20 pt0 pb0 bkg_light_050">
                    <ul class="list_with_icons">
                        <li v-for="contact in unassignedChat" class="d-flex"
                            :class="{ 'active': selContacts == contact.user }" :userid="contact.user"
                            style="cursor:pointer;" @mouseup="loadChatArea(contact.room, contact.user, contact)">
                            <div class="media_left">
                                <user-avatar
                                    :avatar="''"
                                    :firstname="getName(contact.user_name).firstName"
                                    :lastname="getName(contact.user_name).lastName"
                                ></user-avatar>
                                <!--<span class="circle_32 bkg_light_000"><img src="assets/images/avatar/02.png"/></span>-->
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">
                                    {{setStringLimit(getName(contact.user_name).fullName, 20)}}</p>
                                <p class="dark_300 fw300 fsize12 lh_16" :ref="`unassignLastMsg${contact.room}`">{{contact.lastMessageInfo.lastMessage}}</p>
                                <span class="time fsize10 light_800">{{contact.lastMessageInfo.messageTime}}</span>
                            </div>
                            <div class="time_badge" :ref="`unassign${contact.room}`" @click="refreshUnreadCount(contact)">
                                <span class="badge badge-grey chatlist" v-if="contact.unreadCount">{{contact.unreadCount}}</span>
                            </div>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!--======Tab 3=====-->
            <div id="You" class="tab-pane fade">
                <div class="p20 pt0 pb0 bkg_light_050">
                    <ul class="list_with_icons">
                        <li v-for="contact in assignedChat" class="d-flex"
                            :class="{ 'active': selContacts == contact.user }" :userid="contact.user"
                            style="cursor:pointer;" @mouseup="loadChatArea(contact.room, contact.user, contact)">
                            <div class="media_left">
                                <user-avatar
                                    :avatar="''"
                                    :firstname="getName(contact.user_name).firstName"
                                    :lastname="getName(contact.user_name).lastName"
                                ></user-avatar>
                                <!--<span class="circle_32 bkg_light_000"><img src="assets/images/avatar/02.png"/></span>-->
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">
                                    {{setStringLimit(getName(contact.user_name).fullName, 20)}}</p>
                                <p class="dark_300 fw300 fsize12 lh_16" :ref="`assignLastMsg${contact.room}`">{{contact.lastMessageInfo.lastMessage}}</p>
                                <span class="time fsize10 light_800">{{contact.lastMessageInfo.messageTime}}</span>
                            </div>
                            <div class="time_badge" :ref="`assign${contact.room}`" @click="refreshUnreadCount(contact)">
                                <span class="badge badge-grey chatlist" v-if="contact.unreadCount">{{contact.unreadCount}}</span>
                            </div>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</template>
<script>
    import UserAvatar from "@/components/helpers/UserAvatar";

    export default {
        props: ['allChat', 'unassignedChat', 'assignedChat', 'favoriteChat', 'participantInfo'],
        components: {UserAvatar},
        data() {
            return {
                selContacts: '',
                sortType: 'new',
                sortTitle: 'Newest',
                selTab: 'all',
                selTabTitle: '',
                allChatRoom: [],
                unassignedChatRoom: [],
                assignedChatRoom: [],
                favoriteChatRoom: [],
                smileyReg: /[:;#@]{1,2}[\)\/\(\&\$\>\|xXbBcCdDpPoOhHsStTqQwW*?]{1,2}/g,
                smileyMap: '',
                objImage: '',
                objMedia: '',
            }
        },
        sockets:{
            newMessageLineup: function (data) {
                //All Chat Room List
                if(this.allChatRoom.includes(data.room)){
                    let key = 'all'+data.room;
                    this.$refs[key][0].click();
                    //Update Last Message
                    let keyLast = 'allLastMsg'+data.room;
                    this.$refs[keyLast][0].innerHTML= this.parseMsg(this.setStringLimit(data.msg, 20));
                }
                //All Unassigned List
                if(this.unassignedChatRoom.includes(data.room)){
                    let key = 'unassign'+data.room;
                    this.$refs[key][0].click();
                    //Update Last Message
                    let keyLast = 'unassignLastMsg'+data.room;
                    this.$refs[keyLast][0].innerHTML= this.parseMsg(this.setStringLimit(data.msg, 20));
                }
                //All Assigned List
                if(this.assignedChatRoom.includes(data.room)){
                    let key = 'assign'+data.room;
                    this.$refs[key][0].click();
                    //Update Last Message
                    let keyLast = 'assignLastMsg'+data.room;
                    this.$refs[keyLast][0].innerHTML= this.parseMsg(this.setStringLimit(data.msg, 20));
                }
                //All Favorite List
                if(this.favoriteChatRoom.includes(data.room)){
                    let key = 'favorite'+data.room;
                    this.$refs[key][0].click();
                    //Update Last Message
                    let keyLast = 'favoriteLastMsg'+data.room;
                    this.$refs[keyLast][0].innerHTML= this.parseMsg(this.setStringLimit(data.msg, 20));
                }
            }
        },
        mounted() {
            this.loadDefaultChat();
            this.smileyMap = this.getSmilyCollection();
        },
        methods: {
            parseMsg: function(msg){
                let parsedMessage = msg;
                //parsedMessage = this.parseEmojis(parsedMessage); //Parse Smilies
                parsedMessage = this.parseRich(parsedMessage); //Parse Images/Videos/Docs/Audio etc
                return parsedMessage;
            },
            parseRich: function(msg){
                let parsedMessage = msg;
                let fileext = (/[.]/.exec(parsedMessage)) ? /[^.]+$/.exec(parsedMessage) : undefined;
                if (typeof fileext != 'undefined' && fileext !== null) {
                    if (fileext[0] == 'png' || fileext[0] == 'jpg' || fileext[0] == 'jpeg' || fileext[0] == 'gif') {
                        parsedMessage = "Image Attachement";
                    }else if (fileext[0] == 'mp4') {
                        parsedMessage = "Video Attachement";
                    }else if (fileext[0] == 'doc' || fileext[0] == 'docx' || fileext[0] == 'odt' || fileext[0] == 'csv' || fileext[0] == 'pdf' || fileext[0] == 'txt') {
                        parsedMessage = "File Attachement";
                    }
                }
                return parsedMessage;
            },
            parseEmojis: function(msg){
                let parsedMessage = msg;
                let messageSmilies = msg.match(this.smileyReg) || [];
                let el = this;
                if(messageSmilies.length>0){
                    messageSmilies.forEach(function(item){
                        let smilyIcon = el.smileyMap[item.toLowerCase()];
                        if(smilyIcon){
                            parsedMessage = parsedMessage.replace(item, "<img src='/assets/img-smile/" + smilyIcon + ".gif' alt='smiley' />");
                        }
                    });
                }
                return parsedMessage;
            },
            refreshUnreadCount: function(data){
                if(this.selContacts != data.user){
                    axios.post('/admin/webchat/getUnreadMsgs', {room:data.room,userid:data.user,_token:this.csrf_token()})
                        .then(response => {
                            data.unreadCount = response.data;
                        });
                }

            },
            loadDefaultChat: function(){
                if (this.allChat.length > 0 && !this.selContacts) {
                    if (this.allChat.length > 0) {
                        //All Data has loaded now
                        //All Chat Room array
                        let el = this;
                        this.allChat.forEach(function(data){
                            el.allChatRoom.push(data.room);
                        });

                        //unassignedChat Chat Room array
                        this.unassignedChat.forEach(function(data){
                            el.unassignedChatRoom.push(data.room);
                        });

                        //assignedChat Chat Room array
                        this.assignedChat.forEach(function(data){
                            el.assignedChatRoom.push(data.room);
                        });

                        //favoriteChat Chat Room array
                        this.favoriteChat.forEach(function(data){
                            el.favoriteChatRoom.push(data.room);
                        });
                    }
                    this.loadChatArea(this.allChat[0].room, this.allChat[0].user, this.allChat[0]);
                    this.selTabTitle= 'All ('+this.allChat.length+')';
                }else{
                    let el = this;
                    setTimeout(function(){
                        el.loadDefaultChat();
                    },500);
                }
            },
            updateSelectedTab: function(ev, name, title){
                this.selTab = name;
                this.selTabTitle = title;
            },
            changeTab: function(name){
                let key = name;
                this.$refs[key].click();
            },
            sortChatContacts: function (sortType, title) {
                this.sortType = sortType;
                this.sortTitle = title;
                axios.post('/admin/webchat/sortWebChatContactList', {sort:sortType,_token:this.csrf_token()})
                    .then(response => {
                        this.allChat = response.data.allChat;
                    });
            },
            'getName': function (fullName) {
                let aName = fullName.split(' ');
                return {
                    firstName: aName[0],
                    lastName: aName[1],
                    fullName: this.capitalizeFirstLetter(aName[0]) + ' ' + this.capitalizeFirstLetter(aName[1])
                }
            },
            loadChatArea: function (roomId, userid, obj) {
                this.$emit('loadWebChat', roomId, userid);
                this.selContacts = userid;
                obj.unreadCount = 0;
            }
        },
        watch: {
            participantInfo: function(){
                let el = this;
                if(this.allChat.length>0){
                    this.allChat.forEach(function(item){
                        if(item.user == el.participantInfo.chatUserid){
                            item.user_name = el.participantInfo.name;
                            item.email = el.participantInfo.email;
                            item.phone = el.participantInfo.phone;
                        }
                    });
                }

                if(this.unassignedChat.length>0){
                    this.unassignedChat.forEach(function(item){
                        if(item.user == el.participantInfo.chatUserid){
                            item.user_name = el.participantInfo.name;
                            item.email = el.participantInfo.email;
                            item.phone = el.participantInfo.phone;
                        }
                    });
                }

                if(this.assignedChat.length>0){
                    this.assignedChat.forEach(function(item){
                        if(item.user == el.participantInfo.chatUserid){
                            item.user_name = el.participantInfo.name;
                            item.email = el.participantInfo.email;
                            item.phone = el.participantInfo.phone;
                        }
                    });
                }

            }
        }
    };
</script>
