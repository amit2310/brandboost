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
                                <li><strong><a class="chatdropdown" @click="updateSelectedTab($event, 'all', 'All ('+allChat.length+')')" data-toggle="pill" href="#All"><img class="small"
                                                                                                  src="assets/images/cd_icon1.png">
                                    All ({{allChat.length}}) </a></strong></li>
                                <li><strong><a class="chatdropdown" @click="updateSelectedTab($event, 'unassinged', 'Unassigned ('+unassignedChat.length+')')" data-toggle="pill" href="#Unassigned"><img class="small"
                                                                                          src="assets/images/cd_icon2.png">Unassigned
                                    ({{unassignedChat.length}}) </a></strong></li>
                                <li><strong><a class="chatdropdown" @click="updateSelectedTab($event, 'you', 'You ('+assignedChat.length+')')" data-toggle="pill" href="#You"><img class="small"
                                                                                   src="assets/images/cd_icon3.png">You
                                    ({{assignedChat.length}}) </a></strong></li>
                                <li><strong><a class="chatdropdown" @click="updateSelectedTab($event, 'favorite', 'Favorite ('+favoriteChat.length+')')" data-toggle="pill" href="#Favorite"><img class="small"
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
                <li class="mr10"><a class="htxt_bold_13 chatdropdown active" @click="updateSelectedTab($event, 'all', 'All ('+allChat.length+')')" data-toggle="pill" href="#All">All
                    ({{allChat.length}})</a></li>
                <li class="mr10"><a class="htxt_bold_13 chatdropdown" @click="updateSelectedTab($event, 'unassinged', 'Unassigned ('+unassignedChat.length+')')" data-toggle="pill" href="#Unassigned">Unassigned
                    ({{unassignedChat.length}})</a></li>
                <li class=""><a class="htxt_bold_13 chatdropdown" @click="updateSelectedTab($event, 'you', 'You ('+assignedChat.length+')')" data-toggle="pill" href="#You">You ({{assignedChat.length}})</a>
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
                            @click="loadChatArea(contact.room, contact.user, contact)">
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
                                <p class="dark_300 fw300 fsize12 lh_16">{{setStringLimit(contact.lastMessageInfo.lastMessage,20)}}</p>
                                <span class="time fsize10 light_800">{{contact.lastMessageInfo.messageTime}}</span>
                            </div>
                            <div class="time_badge">
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
                            style="cursor:pointer;" @click="loadChatArea(contact.room, contact.user, contact)">
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
                                <p class="dark_300 fw300 fsize12 lh_16">{{contact.lastMessageInfo.lastMessage}}</p>
                                <span class="time fsize10 light_800">{{contact.lastMessageInfo.messageTime}}</span>
                            </div>
                            <div class="time_badge">
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
                            style="cursor:pointer;" @click="loadChatArea(contact.room, contact.user, contact)">
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
                                <p class="dark_300 fw300 fsize12 lh_16">{{contact.lastMessageInfo.lastMessage}}</p>
                                <span class="time fsize10 light_800">{{contact.lastMessageInfo.messageTime}}</span>
                            </div>
                            <div class="time_badge">
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
        props: ['allChat', 'unassignedChat', 'assignedChat', 'favoriteChat'],
        components: {UserAvatar},
        data() {
            return {
                selContacts: '',
                sortType: 'new',
                sortTitle: 'Newest',
                selTab: 'all',
                selTabTitle: ''
            }
        },
        mounted() {
            let el = this;
            setTimeout(function () {
                if (el.allChat.length > 0) {
                    el.loadChatArea(el.allChat[0].room, el.allChat[0].user, el.allChat[0]);
                    el.selTabTitle= 'All ('+el.allChat.length+')';
                }
            }, 500);

        },
        methods: {
            updateSelectedTab: function(ev, name, title){
                this.selTab = name;
                this.selTabTitle = title;
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
        }
    };
</script>
