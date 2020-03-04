<template>
    <div>
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
                        <ul class="listTeamMembers">
                            <li v-for="(tm, idx) in teamMembers" v-if="idx<=3" :class="{'active': tm.id == activeThread.assign_team_member}">
                                <a href="javascript:void(0);" @click="assignChatToMember(tm.id)">
                                    <user-avatar
                                        :avatar="tm.avatar"
                                        :firstname="tm.firstname"
                                        :lastname="tm.lastname"
                                        :width="28"
                                        :height="28"
                                        :title="tm.firstname+ ' ' +tm.lastname"
                                    ></user-avatar>
                                    <!--<img src="assets/images/avatar/01.png"/>-->
                                </a>
                            </li>
                            <!--<li><a href="javascript:void(0);"><img src="assets/images/avatar/02.png"/></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/avatar/03.png"/></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/avatar/04.png"/></a></li>-->
                            <li><a href="javascript:void(0);" @click="showModal=true"><img src="assets/images/Plus_grey_circle.svg"/></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="p0 bbot position-relative chat_mis_sec">
            <!--<a class="slidebox user_profile_show" href="javascript:void(0);"><img src="assets/images/user_profile_show.svg"/></a>-->
            <div class="tab-content">
                <loading :isLoading="loading" style="position:relative;top:20px;"></loading>
                <!--======Tab 1====-->
                <div id="MessageView" class="tab-pane active">
                    <div class="mainchatsvroll2">
                        <ul class="media-list chat-list">
                            <li class="media" v-for="row in chatData" :class="{reversed: row.user_form == loggedId}">
                                <div class="media-body">
                                    <span class="media-annotation user_icon" v-if="row.avatar">
                                        <span class="icons s32">
                                            <img :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/${row.avatar}`" onerror="this.src='/assets/images/default_avt.jpeg'" class="img-circle" alt="" width="36" height="36">
                                        </span>
                                    </span>
                                    <span class="media-annotation user_icon" v-else>
                                        <span class="icons fl_letters s32" style="width:40px!important;height:40px!important;line-height:40px;font-size:13px;">{{row.firstname.charAt(0)+ '' +row.lastname.charAt(0)}}</span>
                                    </span>
                                    <div class="media-content" v-html="parseMessage(row.message)"></div>
                                </div>
                            </li>
                            <li class="media" v-show="isTyping">
                                <div class="media-body">
                                    <span class="media-annotation user_icon">
                                        <span class="icons fl_letters s32" style="width:40px!important;height:40px!important;line-height:40px;font-size:13px;">NU</span>
                                    </span>
                                    <div class="media-content"><img src="assets/images/messageloading.gif" style="height: 25px;"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--======Tab 2=====-->
                <div id="NoteView" class="tab-pane fade">
                    <div class="mainnotesvroll2" style="height:500px;overflow:auto;padding-right:30px;">
                        <div class="p20">
                            <ul class="media-list chat-list">
                                <li class="media reversed" v-for="row in notesData">
                                    <div class="media-body">
                                        <span class="media-annotation user_icon" v-if="row.avatar">
                                            <span class="icons s32">
                                                <img :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/${row.avatar}`" onerror="this.src='/assets/images/default_avt.jpeg'" class="img-circle" alt="" width="36" height="36">
                                            </span>
                                        </span>
                                        <span class="media-annotation user_icon" v-else>
                                            <span class="icons fl_letters s32" style="width:40px!important;height:40px!important;line-height:40px;font-size:13px;">{{row.firstname.charAt(0)+ '' +row.lastname.charAt(0)}}
                                            </span>
                                        </span>
                                        <div class="media-content" v-html="parseMessage(row.message)" ></div>
                                        <span style="font-size:12px;clear:both;" class="text-muted text-size-small pull-right mb-3">
                                            Added By {{row.assignTo + ' ' + row.created}}
                                        </span>
                                        <div style="height:10px" class="clearfix">&nbsp;</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--======Tab 3=====-->
                <div id="EmailView" class="tab-pane fade">
                    <div class="mainemailsvroll2" style="height:500px;overflow:auto;padding-right:30px;">
                        <div class="p20">
                            <ul class="media-list chat-list">
                                <li class="media reversed" v-for="row in emailData">
                                    <div class="media-body">
                                        <span class="media-annotation user_icon" v-if="loggedUserInfo.avatar">
                                            <span class="icons s32">
                                                <img :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/${loggedUserInfo.avatar}`" onerror="this.src='/assets/images/default_avt.jpeg'" class="img-circle" alt="" width="36" height="36">
                                            </span>
                                        </span>
                                        <span class="media-annotation user_icon" v-else>
                                            <span class="icons fl_letters s32" style="width:40px!important;height:40px!important;line-height:40px;font-size:13px;">{{loggedUserInfo.firstname.charAt(0)+ '' +loggedUserInfo.lastname.charAt(0)}}
                                            </span>
                                        </span>
                                        <div class="media-content" v-html="parseMessage(row.msg)" ></div>
                                        <span style="font-size:12px;clear:both;" class="text-muted text-size-small pull-right mb-3">
                                            Added By {{loggedUserInfo.firstname + ' ' + loggedUserInfo.lastname}}
                                        </span>
                                        <div style="height:10px" class="clearfix">&nbsp;</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--======Tab 4=====-->
                <div id="TextMessageView" class="tab-pane fade">
                    <div class="mainsmssvroll2" style="height:500px;overflow:auto;padding-right:30px;">
                        <ul class="media-list chat-list">
                            <li class="media" v-for="row in smsData" :class="{reversed: formatNumber(row.to) == formatNumber(participantInfo.phone)}">
                                <div class="media-body">
                                    <template v-if="formatNumber(row.to) == formatNumber(participantInfo.phone)">
                                        <span class="media-annotation user_icon" v-if="loggedUser.avatar">
                                        <span class="icons s32">
                                            <img :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/${loggedUser.avatar}`" onerror="this.src='/assets/images/default_avt.jpeg'" class="img-circle" alt="" width="36" height="36">
                                        </span>
                                    </span>
                                        <span class="media-annotation user_icon" v-else>
                                        <span class="icons fl_letters s32" style="width:40px!important;height:40px!important;line-height:40px;font-size:13px;">{{loggedUser.firstname.charAt(0)+ '' +loggedUser.lastname.charAt(0)}}</span>
                                    </span>
                                    </template>
                                    <template v-else>
                                        <span class="media-annotation user_icon" v-if="participantInfo.avatar_url">
                                        <span class="icons s32">
                                            <img :src="`https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/${participantInfo.avatar_url}`" onerror="this.src='/assets/images/default_avt.jpeg'" class="img-circle" alt="" width="36" height="36">
                                        </span>
                                    </span>
                                        <span class="media-annotation user_icon" v-else>
                                        <span class="icons fl_letters s32" style="width:40px!important;height:40px!important;line-height:40px;font-size:13px;">{{participantInfo.firstname.charAt(0)+ '' +participantInfo.lastname.charAt(0)}}</span>
                                    </span>
                                    </template>
                                    <div class="media-content" v-html="parseMessage(row.msg)"></div>
                                </div>
                            </li>
                            <li class="media" v-show="isTyping">
                                <div class="media-body">
                                    <span class="media-annotation user_icon">
                                        <span class="icons fl_letters s32" style="width:40px!important;height:40px!important;line-height:40px;font-size:13px;">NU</span>
                                    </span>
                                    <div class="media-content"><img src="assets/images/messageloading.gif" style="height: 25px;"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat_bot_area" style="">
        <div class="p30 pb0 bbot" style="min-height: 120px;">
     	<textarea
            class="p0 w-100 border-0 fsize16 dark_200"
            id="webChatTextarea"
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
                        <li><a class="active" data-toggle="pill" @click="makeTabActive('chat')" href="#MessageView"><img
                            src="assets/images/message-2-line.svg"/> &nbsp; Message</a></li>
                        <li><a data-toggle="pill" @click="makeTabActive('note')" href="#NoteView"><img src="assets/images/file-3-line-grey.svg"/>
                            &nbsp; Note</a></li>
                        <li><a data-toggle="pill" @click="makeTabActive('email')" href="#EmailView" ><img src="assets/images/mail-open-line.svg"/> &nbsp;
                            Email</a></li>
                        <li><a data-toggle="pill" @click="makeTabActive('text')" href="#TextMessageView"><img
                            src="assets/images/message-3-line-grey.svg"/> &nbsp; Text Message</a></li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <div class="action_list">
                        <!--*****EMOJI*****-->
                        <div class="chat_emoji_box" v-show="showSmilies" style="display: block;">
                            <div class="form-group">
                                <input type="text" class="form-control search fsize13 h48"
                                       placeholder="Search template"/>
                            </div>
                            <div class="emoji_box mb20">
                                <p class="htxt_medium_15 dark_800 mb-1 fw500">Recent</p>
                                <ul class="emojisec">
                                    <li><a href="javascript:void(0);" title=";)" @click="applySmily(';)')"><img
                                        src="assets/images/emojie-eye-face-joke-tongue-wink-emoji-stuckout-37676.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":S" @click="applySmily(':S')"><img
                                        src="assets/images/emojie-expressionless-face-inexpressive-unexpressive-emoji-37678.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":(" @click="applySmily(':(')"><img
                                        src="assets/images/emojie-face-unamused-unhappy-angry-emoji-37702.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":*" @click="applySmily(':*')"><img
                                        src="assets/images/emojie-blush-eye-face-smile-flirt-emoji-37658.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title="#O" @click="applySmily('#O')"><img
                                        src="assets/images/emojie-face-sleep-emoji-tired-37692.svg"/></a></li>
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
                                    <li><a href="javascript:void(0);" title=";)" @click="applySmily(';)')"><img
                                        src="assets/images/emojie-eye-face-joke-tongue-wink-emoji-stuckout-37676.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":S" @click="applySmily(':S')"><img
                                        src="assets/images/emojie-expressionless-face-inexpressive-unexpressive-emoji-37678.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":(" @click="applySmily(':(')"><img
                                        src="assets/images/emojie-face-unamused-unhappy-angry-emoji-37702.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":*" @click="applySmily(':*')"><img
                                        src="assets/images/emojie-blush-eye-face-smile-flirt-emoji-37658.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title="#O" @click="applySmily('#O')"><img
                                        src="assets/images/emojie-face-sleep-emoji-tired-37692.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-face-sleep-zzz-tired-bore-emoji-37691.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":D" @click="applySmily(':D')"><img
                                        src="assets/images/emojie-grinning-face-smile-emoji-happy-37705.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-face-tongue-stuck-out-emoji-37695.svg"/></a></li>


                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-face-kiss-flirt-emoji-37697.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-grinning-face-with-smiling-eyes-happy-emoji-37710.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-grinning-face-smile-emoji-happy-37705.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-delicious-face-savouring-smile-um-yum-eye-emoji-37671.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-dizzy-face-error-emoji-37670.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-confounded-face-sad-cry-unhappy-emoji-37707.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-cold-face-open-smile-sweat-happy-emoji-37709.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-disappointed-face-sad-emoji-37669.svg"/></a></li>


                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-blush-eye-face-smile-flirt-emoji-37658.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-expressionless-face-inexpressive-unexpressive-emoji-37678.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-eye-face-love-smile-heart-emoji-37674.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-angry-face-mad-emoji-37652.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-angry-face-mad-pouting-rage-red-emoji-37653.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-hand-medium-skin-tone-wave-waving-37774.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-clenched-fist-hand-medium-light-skin-tone-punch-37735.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-backhand-down-finger-hand-index-medium-light-skin-tone-point-37723.svg"/></a>
                                    </li>


                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-biceps-comic-flex-medium-skin-tone-muscle-37748.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-backhand-finger-hand-index-medium-light-skin-tone-point-up-37722.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-clap-hand-medium-skin-tone-37733.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-hand-medium-light-skin-tone-thumb-up-37775.svg"/></a>
                                    </li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-cat-face-mouth-open-smile-emoji-37664.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-cat-face-joy-tear-happy-emoji-37666.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
                                        src="assets/images/emojie-cat-face-mouth-open-smile-emoji-37664.svg"/></a></li>
                                    <li><a href="javascript:void(0);" title=":P" @click="applySmily(':P')"><img
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
                            <div class="savedchat mb-2" v-for="sc in filteredListShortcut" style="cursor:pointer" @click="applyShortcut(sc.conversatation)">
                                <p class="htxt_medium_16 dark_800 mb-2" v-html="sc.name"></p>
                                <p class="htxt_regular_14 dark_200" v-html="setStringLimit(sc.conversatation,100)"></p>
                            </div>
                        </div>
                        <!--*****Small footer buttons*****-->
                        <ul>
                            <li><a class="active show_emoji" href="javascript:void(0);" @click="showSmilies= !showSmilies"><img
                                src="assets/images/user-smile-line.svg"></a></li>
                            <li><a class="show_saved_chat" href="javascript:void(0);"><img
                                src="assets/images/clipboard-line.svg"></a></li>
                            <li><a href="javascript:void(0);" @click="triggerImageUploadButton"><img src="assets/images/Image_18.svg"></a></li>
                            <li><a href="javascript:void(0);" @click="triggerMediaUploadButton"><img src="assets/images/attachment-line.svg"></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/add-circle-line.svg"></a></li>
                            <li><a href="javascript:void(0);"><img src="assets/images/submit_btn_icon.svg"></a></li>
                            <input type="file" ref="chatImg" name="image" @change="uploadImage" id="uploadWebchatImage" accept="image/*" style="display: none;">
                            <input type="file" ref="chatMedia" name="media" @change="uploadMedia" id="uploadWebchatMedia" style="display: none;">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <modal-popup v-if="showModal" width="sm" @close="showModal = false" >
            <div slot="header">
                <h3>Assign chat to team members <button type="button" class="close pull-right" data-dismiss="modal" @click="showModal = false">&times;</button></h3>
            </div>
            <div slot="body" class="pt0 pb0">
                <div class="chat_user_list m-2 pb-5"  style="max-width: 400px!important;width:400px;border-right:none;">
                    <ul class="listTeamMembers">
                        <li v-for="(tm, idx) in teamMembers" :class="{'active': tm.id == activeThread.assign_team_member}">
                            <a href="javascript:void(0);" class="p-1" @click="assignChatToMember(tm.id)">
                                <user-avatar
                                    :avatar="tm.avatar"
                                    :firstname="tm.firstname"
                                    :lastname="tm.lastname"
                                    :width="40"
                                    :height="40"
                                    :fontsize="14"
                                    :title="tm.firstname+ ' ' +tm.lastname"
                                ></user-avatar>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div slot="footer">
                <a href="javascript:void(0);" class="blue_300 fsize16 fw600 ml20" @click="showModal = false">Close</a>
            </div>
        </modal-popup>
    </div>
</template>
<script>
    import UserAvatar from "@/components/helpers/UserAvatar";
    import ModalPopup from "@/components/helpers/Common/ModalPopup";
    export default {
        components: {ModalPopup, UserAvatar},
        props: ['currentTokenId', 'loggedId', 'loggedUserInfo', 'participantId', 'participantInfo', 'shortcuts', 'loggedUser', 'twilioNumber', 'teamMembers', 'allChat', 'unassignedChat', 'assignedChat', 'favoriteChat'],
        data() {
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                loading: false,
                chatData: '',
                notesData: '',
                emailData: [],
                smsData:'',
                searchShortcut: '',
                enteredMessage: '',
                loggedAvatar: '',
                showShortcuts: false,
                showSmilies: false,
                isTyping: false,
                smileyReg: /[:;#@]{1,2}[\)\/\(\&\$\>\|xXbBcCdDpPoOhHsStTqQwW*?]{1,2}/g,
                smileyMap: '',
                objImage: '',
                objMedia: '',
                chatTab: true,
                noteTab: false,
                emailTab: false,
                textTab: false,
                showModal: false,
                activeThread: ''
            }
        },
        sockets:{
            connect: function () {
                this.$socket.emit('subscribe', this.currentTokenId);
            },
            'wait_new_message': function(data){
                if(data.room == this.currentTokenId){
                    let el = this;
                    this.isTyping = true;
                    this.scrollToEndChat();
                    setTimeout(function() {
                        el.isTyping = false;
                    }, data.wait);
                }
            },
            'receiveMessage': function(data){
                if(data.room == this.currentTokenId){
                    let newObj = {
                        user_form: data.currentUser,
                        avatar: (data.currentUser == this.loggedId) ? this.loggedAvatar : '',//data.avatar,
                        message:data.msg,
                        firstname: 'New',
                        lastname: 'User'
                    };
                    this.chatData.push(newObj);
                    this.isTyping = false;
                    let el = this;
                    setTimeout(function () {
                        el.scrollToEndChat();
                    }, 10);
                }
            },
            'messageTresponse': function(data){
                let msgFrom = data.from;
                let msgTo = data.to;
                if((this.formatNumber(msgFrom) == this.formatNumber(this.participantInfo.phone)) && (this.formatNumber(msgTo) == this.formatNumber(this.twilioNumber))){
                    this.getSmsList();
                }
            },
        },
        computed: {
            filteredListShortcut() {
                if (this.shortcuts) {
                    return this.shortcuts.filter(shortcut => {
                        return (shortcut.name.toLowerCase().includes(this.searchShortcut.toLowerCase()) || shortcut.conversatation.toLowerCase().includes(this.searchShortcut.toLowerCase()))
                    });
                }
            },
            filteredContact(){
                if (this.allChat) {
                    return this.allChat.filter(contact => {
                        return contact.room.toLowerCase().includes(this.currentTokenId.toLowerCase());
                    });
                }
                if (this.unassignedChat) {
                    return this.unassignedChat.filter(contact => {
                        return contact.room.toLowerCase().includes(this.currentTokenId.toLowerCase());
                    });
                }
                if (this.assignedChat) {
                    return this.assignedChat.filter(contact => {
                        return contact.room.toLowerCase().includes(this.currentTokenId.toLowerCase());
                    });
                }
                if (this.favoriteChat) {
                    return this.favoriteChat.filter(contact => {
                        return contact.room.toLowerCase().includes(this.currentTokenId.toLowerCase());
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
                let el = this;
                this.smileyMap = this.getSmilyCollection();
                this.$socket.emit('subscribe', this.currentTokenId);
                this.loading = true;
                this.chatData= '';
                this.emailData = [];
                //this.getMessageList();
                this.getNotesList();
                this.markRead();
                this.refreshThreadInfo();
                //this.getSmsList();
            },
            participantInfo: function () {
                 this.getMessageList();
                 this.getSmsList();
                 this.getEmailList();
            },
        },
        methods: {
            assignChatToMember: function(userid, fullname){
                axios.post('/admin/webchat/reassignChat', {
                    room: this.currentTokenId,
                    assign_to: userid,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        this.refreshThreadInfo();
                        this.$socket.emit('reassign_post_data', {room:this.currentTokenId, assign_to:userid, assign_from:response.data.preTeamId,assign_to_name:fullname ,user_id:this.loggedUserInfo.id});
                    });

            },
            refreshThreadInfo: function(){
                axios.post('/admin/webchat/getThreadInfo', {
                    room: this.currentTokenId,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        this.activeThread = response.data.room;
                    });
            },
            formatNumber: function(number){
                let parsedNumber = number.trim().replace('+', '').replace('-', '').replace('(','').replace(')', '');
                return parsedNumber.substring(parsedNumber.length-10);
            },
            makeTabActive: function(tab){
              this.chatTab = false;
              this.noteTab = false;
              this.emailTab = false;
              this.textTab = false;
              let el = this;
              if(tab == 'chat'){
                  this.chatTab = true;
              }else if(tab == 'note'){
                  this.noteTab = true;
                  setTimeout(function () {
                      el.scrollToEndNotes();
                  }, 100);
              }else if(tab == 'email'){
                  this.emailTab = true;
              }else if(tab == 'text'){
                  this.textTab = true;
                  setTimeout(function () {
                      el.scrollToEndSms();
                  }, 100);

              }
            },
            getMessageList: function(){
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
                            el.scrollToEndChat();
                        }, 500);
                    });
            },
            getSmsList: function(){
                axios.post('/admin/smschat/showSmsThreads', {
                    room: this.currentTokenId,
                    userId: this.participantId,
                    SubscriberPhone: this.participantInfo.phone,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.smsData = response.data;
                        this.loading = false;
                        let el = this;
                        setTimeout(function () {
                            el.scrollToEndSms();
                        }, 500);
                    });
            },
            getEmailList: function(){
                axios.post('/admin/webchat/showEmailThread', {
                    to: this.participantInfo.email,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.emailData = response.data;
                        this.loading = false;
                        let el = this;
                        setTimeout(function () {
                            el.scrollToEndEmail();
                        }, 500);
                    });
            },
            getNotesList: function(){
                axios.post('/admin/webchat/listingNotes', {
                    NotesTo: this.participantId,
                    notes_from: 'web',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.notesData = response.data;
                        this.loading = false;
                        let el = this;
                        setTimeout(function () {
                            el.scrollToEndNotes();
                        }, 2000);
                    });
            },
            markRead: function(){
                axios.post('/webchat/markRead', {
                    room: this.currentTokenId,
                    userid: this.participantId,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        //Do nothing!
                    });
            },
            submitMessage: function (ev) {
                if(this.chatTab){
                    this.showAuthorTyping();
                }
                this.hideSaveMessages();
                this.hideSmilyPan();
                if (ev.keyCode == 13 && ev.shiftKey) {
                    //Add New Line
                    return false;
                }
                if (ev.keyCode === 13) {
                    //Pressed Enter
                    if(this.chatTab){
                        this.sendMessage();
                    }
                    if(this.noteTab){
                        this.saveNote();
                    }
                    if(this.emailTab){
                        this.sendEmail();
                    }
                    if(this.textTab){
                        this.sendSms();
                    }

                }
                if (ev.keyCode === 47) {
                    //Pressed slash(/)
                    this.listSaveMessages();
                }
                if (ev.keyCode === 58) {
                    //Pressed slash(:)
                    this.showSmilyPan();
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
                    //Update Last Message Info
                }
            },
            cleanManager: function (ev) {
                if (ev.keyCode === 8) {
                    //Pressed backspace(/)
                    this.hideSaveMessages();
                }
            },
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
                            this.enteredMessage = null;
                        }
                    });
            },
            sendSms: function () {
                this.loading = true;
                let msg = this.enteredMessage;
                this.enteredMessage = null;
                axios.post('/admin/smschat/sendMsg', {
                    smstoken: this.currentTokenId,
                    phoneNo: this.participantInfo.phone,
                    messageContent: msg,
                    moduleName: 'chat',
                    media_type: '',
                    videoUrl: '',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if (response.data.status == 'ok') {
                            this.enteredMessage = null;
                            this.getSmsList();
                            this.loading = false;
                        }
                    });
            },
            sendMms: function () {
                this.loading = true;
                let msg = this.enteredMessage;
                this.enteredMessage = null;
                axios.post('/admin/smschat/sendMMS', {
                    smstoken: this.currentTokenId,
                    phoneNo: this.participantInfo.phone,
                    messageContent: msg,
                    moduleName: 'chat',
                    media_type: 'image/video',
                    videoUrl: '',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        if (response.data.status == 'ok') {
                            this.enteredMessage = null;
                            this.getSmsList();
                            this.loading = false;
                        }
                    });
            },
            sendEmail: function () {
                this.loading = true;
                let msg = this.enteredMessage;
                this.enteredMessage = null;
                axios.post('/admin/webchat/sendEmail', {
                    email: this.participantInfo.email,
                    messageContent: msg,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.loading = false;
                        let newObj = {
                            avatar: this.loggedAvatar,
                            msg:msg
                        };
                        this.emailData.push(newObj);
                        this.enteredMessage = null;
                    });
            },
            saveNote: function () {
                axios.post('/admin/webchat/addWebNotes', {
                    room: this.currentTokenId,
                    msg: this.enteredMessage,
                    chatTo: this.participantId,
                    currentUser: this.loggedId,
                    notes: '1',
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.enteredMessage = null;
                        this.getNotesList();
                    });
            },
            parseMessage: function(msg){
                let parsedMessage = msg.replace("\n", "<br>");
                parsedMessage = this.parseSmilies(parsedMessage); //Parse Smilies
                parsedMessage = this.parseMedia(parsedMessage); //Parse Images/Videos/Docs/Audio etc
                return parsedMessage;
            },
            parseMedia: function(msg){
                let parsedMessage = msg;
                let fileext = (/[.]/.exec(parsedMessage)) ? /[^.]+$/.exec(parsedMessage) : undefined;
                let mmsFile = parsedMessage.split('/Media/');
                if (typeof fileext != 'undefined' && fileext !== null) {
                    if (fileext[0] == 'png' || fileext[0] == 'jpg' || fileext[0] == 'jpeg' || fileext[0] == 'gif') {
                        parsedMessage = "<a href='" + parsedMessage + "' class='previewImage' target='_blank'><img src='" + parsedMessage + "' height='auto' width='100%' /></a>";
                    }else if (fileext[0] == 'mp4') {
                        parsedMessage = "<video class='media_file' controls><source src='" + parsedMessage + "' type='video/" + fileext[0] + "'></video>";
                    }else if (fileext[0] == 'doc' || fileext[0] == 'docx' || fileext[0] == 'odt' || fileext[0] == 'csv' || fileext[0] == 'pdf' || fileext[0] == 'txt') {
                        parsedMessage = "<a href='" + parsedMessage + "' target='_blank'>Download '" + fileext[0].toUpperCase() + "' File</a>";
                    }
                }
                if(mmsFile.length>1){
                    parsedMessage = "<a href='" + parsedMessage + "' class='previewImage' target='_blank'><img src='" + parsedMessage + "' height='auto' width='100%' /></a>";
                }
                return parsedMessage;
            },
            parseSmilies: function(msg){
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
            listSaveMessages: function () {
                this.showShortcuts = true;
            },
            hideSaveMessages: function () {
                this.showShortcuts = false;
            },
            showSmilyPan: function () {
                this.showSmilies = true;
            },
            hideSmilyPan: function () {
                this.showSmilies = false;
            },
            applyShortcut:function(msg){
                this.enteredMessage = (this.enteredMessage.length>0) ? (this.enteredMessage.substring(0, (this.enteredMessage.length-1)) + msg) : msg;
                this.showShortcuts = false;
                document.querySelector("#webChatTextarea").focus();
            },
            applySmily:function(msg){
                this.enteredMessage = this.enteredMessage + msg;
                this.showSmilies = false;
                document.querySelector("#webChatTextarea").focus();
            },
            scrollToEndChat: function () {
                let container = this.$el.querySelector(".mainchatsvroll2");
                container.scrollTop = container.scrollHeight;
            },
            scrollToEndNotes: function () {
                let container = this.$el.querySelector(".mainnotesvroll2");
                container.scrollTop = container.scrollHeight;
            },
            scrollToEndSms: function () {
                let container = this.$el.querySelector(".mainsmssvroll2");
                container.scrollTop = container.scrollHeight;
            },
            scrollToEndEmail: function () {
                let container = this.$el.querySelector(".mainemailsvroll2");
                container.scrollTop = container.scrollHeight;
            },
            triggerImageUploadButton: function(){
                document.querySelector("#uploadWebchatImage").click();
            },
            triggerMediaUploadButton: function(){
                document.querySelector("#uploadWebchatMedia").click();
            },
            uploadImage: function(){
                this.loading = true;
                let res = this.$refs.chatImg.files[0];
                this.saveFile(res);
            },
            uploadMedia: function(){
                this.loading = true;
                let res = this.$refs.chatMedia.files[0];
                this.saveFile(res);
            },
            saveFile: function(files){
                let formData = new FormData();
                let formSrc = '';
                if(this.chatTab || this.noteTab || this.emailTab){
                    formSrc = '/dropzone/upload_s3_attachment/'+this.loggedId+'/webchat';
                }
                if(this.textTab){
                    formSrc = '/dropzone/upload_s3_attachment/'+this.loggedId+'/smschat';
                }
                formData.append('files[]', files);
                formData.append('_token', this.csrf_token());
                axios.post(formSrc, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(response => {
                        if (response.data.error == '') {
                            let fileName = response.data.result;
                            let msg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' + fileName;
                            this.enteredMessage = msg;
                            if(this.chatTab){
                                this.sendMessage();
                            }
                            if(this.noteTab){
                                this.saveNote();
                            }
                            if(this.textTab){
                                this.sendMms();
                            }

                            this.loading = false;
                            let el = this;
                            setTimeout(function(){ el.scrollToEndChat()}, 5000);
                        }else{
                            this.loading = true;
                        }
                    });
            }
        }
    };
</script>
<style scoped>
    .media_file{
        width: 250px !important;
    }
    .listTeamMembers li.active:after {
        content: '✓';
        position: fixed;
        font-size: 33px;
        font-weight: bold;
        margin-left: -20px;
        margin-top: -7px;
    }
</style>
