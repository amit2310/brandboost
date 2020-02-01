<template>
    <div class="box d-block" style="width: 280px; top: 129px!important; height: calc(100% - 129px); max-height: 798px; position: absolute!important; box-shadow: none!important; border-left: 1px solid #f5f6f8">
        <system-messages :successMsg="successMsg" :errorMsg="errorMsg" :key="refreshMessage"></system-messages>
        <div style="width: 280px;overflow: hidden; height: 100%;">
            <div style="height: 100%; overflow-y:auto; overflow-x: hidden;">
                <div class="p25 pl20 pr20">
                    <div class="pt0 pb20 bbot">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="fsize18 dark_800 fw500">Profile</h3>
                            </div>
                            <div class="col-md-6">
                                <!--<a class="slidebox float-right"><i class=""><img width="24" src="assets/images/cross@2x.png"/></i></a>-->
                            </div>
                        </div>
                    </div>
                    <div class="pt30 pb30 bbot" v-if="participantInfo">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="profile_image_bkg mb20">
                                    <img width="72" v-if="participantInfo.avatar_url" :src="participantInfo.avatar_url" />
                                    <span class="fl_name" v-else>{{participantInfo.firstname.charAt(0)+' '+participantInfo.lastname.charAt(0)}}</span>
                                </div>
                                <div class="bkg_green_light green_400 fsize10 pl10 pr10 pt-1 pb-0 br8 d-inline-block">Lead</div>
                                <!--<h3 class="fsize16 fw500 dark_700 mb0 mt10">{{participantInfo.name}}</h3>
                                <p class="fsize14 fw400 dark_300 mb20">{{participantInfo.email}}</p>-->
                                <div class="clearfix"></div>
                                <h3
                                    style="display:inline-block;cursor:pointer;"
                                    class="fsize16 fw500 dark_700 mb0 mt10"
                                    v-show="!editableUserName"
                                    @click="editableUserName=true"
                                >{{participantInfo.name}}</h3>
                                <span style="display:inline-block" v-show="editableUserName">
                                    <input class="editable_input" type="text" v-model="participantInfo.name" @blur="updateProfile('support_name')" /></span>
                                <div class="clearfix"></div>
                                <p
                                    style="display:inline-block;cursor:pointer;"
                                    class="fsize14 fw400 dark_300 mb20"
                                    v-show="!editableEmail"
                                    @click="editableEmail=true"
                                >{{participantInfo.email}}</p>
                                <span style="display:inline-block;margin-bottom:20px;" v-show="editableEmail">
                                    <input class="editable_input" type="email" v-model="participantInfo.email" @blur="updateProfile('support_email')" /></span>
                                <ul class="profile_social_icon">
                                    <li><a href="javascript:void(0);"><img src="assets/images/Facebook.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img src="assets/images/twitter.svg"/></a></li>
                                    <li><a href="javascript:void(0);"><img src="assets/images/linkedin.svg"/></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pt20 pb20 bbot">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="fsize16 fw500 dark_700 mb-2 mt0">Details</h3>
                                <ul class="user_details_list">
                                    <li>
                                        <span style="cursor:pointer;" v-show="!editablePhone" @click="editablePhone=true">{{participantInfo.phone}}</span>
                                        <span v-show="editablePhone">
                                    <input class="editable_input" type="phone" v-model="participantInfo.phone" @blur="updateProfile('support_phone')" /></span>
                                    </li>
                                    <li>6AM, US/Estern</li>
                                    <li>3 days ago</li>
                                    <li>1 year ago</li>
                                    <li>Paris, France</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pt20 pb20">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="fsize16 fw500 dark_700 mt0 mb-2">Tags</h3>
                                <button class="tag_btn br8" v-for="tag in participantInfo.taglist">{{tag.tag_name}}</button>
                                <button class="btn-link applyInsightTagsReviews" style="border: none; background: none;"><img src="assets/images/plus_grey.svg"/></button>
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
        props: ['participantInfo', 'currentTokenId', 'loggedUser'],
        data(){
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                editableUserName: false,
                editableEmail: false,
                editablePhone: false,
            }
        },
        methods: {
            updateProfile: function(fieldName){
                let fieldValue;
                let isValidated = false;
                this.errorMsg = '';
                this.successMsg = '';
                if(fieldName == 'support_name' ){
                    fieldValue = this.participantInfo.name;
                    if(fieldValue.trim() == ''){
                        //Display Validation Error
                        this.errorMsg = 'Please enter name';
                        this.participantInfo.name = 'Add Name';
                        return false;
                    }
                    isValidated = true;
                    this.editableUserName = false;
                }else if(fieldName == 'support_email' ){
                    fieldValue = this.participantInfo.email;
                    if(fieldValue.trim() == ''){
                        //Display Validation Error
                        this.errorMsg = 'Please enter email address';
                        this.participantInfo.email = 'Add Email';
                        return false;
                    }
                    isValidated = true;
                    this.editableEmail = false;
                }else if(fieldName == 'support_phone' ){
                    fieldValue = this.participantInfo.phone;
                    if(fieldValue.trim() == ''){
                        //Display Validation Error
                        this.errorMsg = 'Please enter phone number';
                        this.participantInfo.phone = 'Add Phone';
                        return false;
                    }
                    isValidated = true;
                    this.editablePhone = false;
                }
                if(isValidated == true){
                    axios.post('/admin/webchat/updateSupportuser', {
                        getName:fieldName,
                        getValue:fieldValue,
                        em_id: this.participantInfo.chatUserid,
                        _token:this.csrf_token()})
                        .then(response => {
                            this.successMsg = 'Changes updated successful';
                            this.$socket.emit('change_support_name', {room: this.currentTokenId, supportname: this.participantInfo.name});
                            this.$emit('loadWebChat', this.currentTokenId, this.participantInfo.chatUserid);
                        });
                }
            }
        }
    };
</script>
<style scoped>
    .editable_input{ border:1px solid #ddd; height:30px; padding:0 10px; border-radius:3px;display:block!important;}
</style>
