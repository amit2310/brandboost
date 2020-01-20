<template>
    <div class="box d-block" style="width: 280px; top: 129px!important; height: calc(100% - 129px); max-height: 798px; position: absolute!important; box-shadow: none!important; border-left: 1px solid #f5f6f8">
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
                    <div class="pt30 pb30 bbot">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="profile_image_bkg mb20" v-html="participantInfo.avatar">
                                    <!--<img width="72" src="assets/images/avatar/02.png"/>-->
                                </div>
                                <div class="bkg_green_light green_400 fsize10 pl10 pr10 pt-1 pb-0 br8 d-inline-block">Lead</div>
                                <h3 class="fsize16 fw500 dark_700 mb0 mt10">{{participantInfo.name}}</h3>
                                <p class="fsize14 fw400 dark_300 mb20">{{participantInfo.email}}</p>
                                <ul class="profile_social_icon">
                                    <li><a href="#"><img src="assets/images/Facebook.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/twitter.svg"/></a></li>
                                    <li><a href="#"><img src="assets/images/linkedin.svg"/></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pt20 pb20 bbot">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="fsize16 fw500 dark_700 mb-2 mt0">Details</h3>
                                <ul class="user_details_list">
                                    <li>{{participantInfo.phone}}</li>
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
        props: ['participantInfo']
    };
</script>
