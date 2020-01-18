<template>
    <div class="page_sidebar bkg_light_000 absl">
        <div class="inner2 pb0">
            <div class="title-box">
                <h6 class="menu-title" style="line-height: 36px;"><!--<span class="button-menu-mobile_sidebar"><img src="assets/images/close_menu_circle.svg"></span> &nbsp; -->LIVE MESSENGER</h6>
            </div>
            <h3 class="htxt_medium_20 dark_800" >Contacts </h3>
            <div class="bbot btop contact_sort pt15 pb15 mt-3">
                <div class="row">
                    <div class="col">
                        <div class="tdropdown ml0">
                            <a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="true">All (39)</a>
                            <ul style="right: 0px!important; margin-top: 18px; left: -20px;" class="dropdown-menu dropdown-menu-left chat_dropdown">
                                <li><strong><a class="active" href="#"><img class="small" src="assets/images/cd_icon1.png"> All (39) </a></strong></li>
                                <li><strong><a href="#"><img class="small" src="assets/images/cd_icon2.png">Open (13) </a></strong></li>
                                <li><strong><a href="#"><img class="small" src="assets/images/cd_icon3.png">Resolved (172) </a></strong></li>
                                <li><strong><a href="#"><img class="small" src="assets/images/cd_icon4.png">Favorite (5) </a></strong></li>
                                <li><strong><a href="#"><img class="small" src="assets/images/cd_icon5.png">Snoozed (28)</a></strong></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="tdropdown ml0 pull-right">
                            <a style="margin:0!important;" class="dropdown-toggle fsize12 txt_grey" data-toggle="dropdown" aria-expanded="true">Waiting longest</a>
                            <ul style="margin-top: 18px; right: -20px;" class="dropdown-menu dropdown-menu-left chat_dropdown width_170">
                                <li><strong><a class="active" href="#">Newest </a></strong></li>
                                <li><strong><a href="#">Waiting longest </a></strong></li>
                                <li><strong><a href="#">Oldest </a></strong></li>
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
                <li class="mr10"><a class="htxt_bold_13 active" data-toggle="pill" href="#All">All ({{allChat.length}})</a></li>
                <li class="mr10"><a class="htxt_bold_13" data-toggle="pill" href="#Unassigned">Unassigned (15)</a></li>
                <li class=""><a class="htxt_bold_13" data-toggle="pill" href="#You">You (12)</a></li>
            </ul>
        </div>
        <div class="tab-content" style="height:600px;overflow-y:auto;overflow-x:hidden;">
            <!--======Tab 1====-->
            <div id="All" class="tab-pane active">
                <div class="p20 pt0 pb0 bkg_light_050">
                    <ul class="list_with_icons">
                        <li v-for="contact in allChat" class="d-flex">
                            <div class="media_left">
                                <user-avatar
                                    :avatar="''"
                                    :firstname="getName(contact.user_name).firstName"
                                    :lastname="getName(contact.user_name).lastName"
                                ></user-avatar>
                                <!--<span class="circle_32 bkg_light_000"><img src="assets/images/avatar/02.png"/></span>-->
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">{{setStringLimit(getName(contact.user_name).fullName, 20)}}</p>
                                <p class="dark_300 fw300 fsize12 lh_16">{{contact.lastMessageInfo.lastMessage}}</p>
                                <span class="time fsize10 light_800">{{contact.lastMessageInfo.messageTime}}</span>
                            </div>
                            <div class="time_badge">
                                <!--<span class="badge badge-grey chatlist">28</span>-->
                            </div>
                        </li>
                        <li class="d-flex active">
                            <div class="media_left">
                                <span class="circle_32 bkg_light_000"><img src="assets/images/avatar/07.png"/></span>
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">Eduardo Williamson</p>
                                <p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
                            </div>
                            <div class="time_badge">
                                <span class="time fsize10 light_800">2m</span>
                                <span class="badge badge-grey chatlist">8</span>
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
                        <li class="d-flex">
                            <div class="media_left">
                                <span class="circle_32 bkg_light_000"><img src="assets/images/avatar/02.png"/></span>
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">Bruce Robertson</p>
                                <p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
                            </div>
                            <div class="time_badge">
                                <span class="time fsize10 light_800">5m</span>
                                <!--<span class="badge badge-grey chatlist">28</span>-->
                            </div>
                        </li>
                        <li class="d-flex active">
                            <div class="media_left">
                                <span class="circle_32 bkg_light_000"><img src="assets/images/avatar/07.png"/></span>
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">Eduardo Williamson</p>
                                <p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
                            </div>
                            <div class="time_badge">
                                <span class="time fsize10 light_800">2m</span>
                                <span class="badge badge-grey chatlist">8</span>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="media_left">
                                <span class="circle_32 bkg_light_000"><img src="assets/images/avatar/03.png"/></span>
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">Lily Pena</p>
                                <p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
                            </div>
                            <div class="time_badge">
                                <span class="time fsize10 light_800">1h</span>
                                <span class="badge badge-grey chatlist">5</span>
                            </div>
                        </li>

                        <li class="d-flex">
                            <div class="media_left">
                                <span class="circle_32 bkg_light_000"><img src="assets/images/avatar/04.png"/></span>
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">Theresa Fox</p>
                                <p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
                            </div>
                            <div class="time_badge">
                                <span class="time fsize10 light_800">3m</span>
                                <span class="badge badge-grey chatlist">2</span>
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
                        <li class="d-flex">
                            <div class="media_left">
                                <span class="circle_32 bkg_light_000"><img src="assets/images/avatar/03.png"/></span>
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">Lily Pena</p>
                                <p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
                            </div>
                            <div class="time_badge">
                                <span class="time fsize10 light_800">1h</span>
                                <span class="badge badge-grey chatlist">5</span>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="media_left">
                                <span class="circle_32 bkg_light_000"><img src="assets/images/avatar/04.png"/></span>
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">Theresa Fox</p>
                                <p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
                            </div>
                            <div class="time_badge">
                                <span class="time fsize10 light_800">3m</span>
                                <span class="badge badge-grey chatlist">2</span>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="media_left">
                                <span class="circle_32 bkg_light_000"><img src="assets/images/avatar/05.png"/></span>
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">Brooklyn Nguyen</p>
                                <p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
                            </div>
                            <div class="time_badge">
                                <span class="time fsize10 light_800">4m</span>
                                <!--<span class="badge badge-grey chatlist">7</span>-->
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="media_left">
                                <span class="fl_name bkg_green_light green_300">fg</span>
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">Bruce Robertson</p>
                                <p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
                            </div>
                            <div class="time_badge">
                                <span class="time fsize10 light_800">10s</span>
                                <span class="badge badge-grey chatlist">3</span>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="media_left">
                                <span class="circle_32 bkg_light_000"><img src="assets/images/avatar/06.png"/></span>
                            </div>
                            <div class="media_left">
                                <p class="htxt_bold_14 dark_600 mb-2">Nathan Simmmons</p>
                                <p class="dark_300 fw300 fsize12 lh_16">Adipiscing id vel donec non iaculis est tris. Ut tortor sed...</p>
                            </div>
                            <div class="time_badge">
                                <span class="time fsize10 light_800">1m</span>
                                <!--<span class="badge badge-grey chatlist">8</span>-->
                            </div>
                        </li>                    </ul>

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
        props: ['allChat'],
        components: {UserAvatar},
        methods:{
            'getName': function(fullName){
                let aName = fullName.split(' ');
                return {
                    firstName: aName[0],
                    lastName: aName[1],
                    fullName: this.capitalizeFirstLetter(aName[0])+ ' '+ this.capitalizeFirstLetter(aName[1])
                }
            }
        }
    };
</script>
