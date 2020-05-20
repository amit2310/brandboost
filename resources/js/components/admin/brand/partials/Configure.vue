<template>

    <div id="Configurations" class="tab-pane active">


        <div class="p20 bbot pt10 pb10">
            <p class="text-uppercase m-0 fw400 dark_200">Template <a class="float-right" href="javascript:void(0);"><i class="icon-arrow-down12 fsize15"></i></a></p>
        </div>
        <div class="p20">
            <button class="btn br6 border p15 w-100 shadow-none chooseBrandTemplate" @click="openTemplateSelector">Horizontal Popup</button>
        </div>

        <div class="p20 bbot btop pt10 pb10">
            <p class="text-uppercase m-0 fw400 dark_200">Company info  <a class="float-right" href="javascript:void(0);"><i class="icon-arrow-down12 fsize15"></i></a></p>
        </div>
        <div class="p20">
            <h3 class="dark_500 mb0 fsize14 fw400">Avatar
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" v-model="brandData.avatar" :checked="brandData.avatar">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <h3 class="dark_500 mb0 fsize14 fw400">Company description
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" v-model="brandData.company_description"  :checked="brandData.company_description">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <h3 class="dark_500 mb0 fsize14 fw400">Services
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" v-model="brandData.services" :checked="brandData.services">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <h3 class="dark_500 mb0 fsize14 fw400">Contact Us Button
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" v-model="brandData.contact_button" :checked="brandData.contact_button">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <h3 class="dark_500 mb0 fsize14 fw400">Contact Info
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" v-model="brandData.contact_info" :checked="brandData.contact_info">
                    <span class="toggle email"></span>
                </label>
            </h3>

            <h3 class="dark_500 mb0 fsize14 fw400">Socials
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" v-model="brandData.socials" :checked="brandData.socials">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <h3 class="dark_500 mb0 fsize14 fw400">Customer Experiance
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" v-model="brandData.customer_experiance" :checked="brandData.customer_experiance">
                    <span class="toggle email"></span>
                </label>
            </h3>
        </div>

        <div class="p20 bbot btop pt10 pb10">
            <p class="text-uppercase m-0 fw400 dark_200">Position on page  <a class="float-right" href="javascript:void(0);"><i class="icon-arrow-down12 fsize15"></i></a></p>
        </div>
        <div class="p20">
            <div class="p0 m-0">
                <div class="form-group select_box">
                    <label class="mb0 float-left">About company / Media </label>
                    <select name="about_company_position" v-model="brandData.about_company_position" id="about_company_position" class="selectbox_cls form-control changeAction" action-type="about_company">
                        <option value="left" selected="">Left</option>
                        <option value="right">Right</option>
                    </select>
                    <div class="clearfix"></div>
                </div>

                <div class="form-group select_box">
                    <label class="float-left mb0">Reviews list </label>
                    <select name="reviews_list_position" v-model="brandData.review_list_position" id="reviews_list_position" class="selectbox_cls form-control changeAction" action-type="review_list">
                        <option value="left">Left</option>
                        <option value="right" selected="">Right</option>
                    </select>
                    <div class="clearfix"></div>
                </div>

                <div class="form-group select_box">
                    <label class="float-left mb0">Rating (Reviews Summary) </label>
                    <select name="show_rating" v-model="brandData.rating" id="show_rating" class="selectbox_cls form-control changeAction" action-type="rating">
                        <option value="">Show Rating</option>
                        <option value="on" selected="">On</option>
                        <option value="off">Off</option>
                    </select>
                    <div class="clearfix"></div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <div class="p20 bbot btop pt10 pb10">
            <p class="text-uppercase m-0 fw400 dark_200">Company info  <a class="float-right" href="javascript:void(0);"><i class="icon-arrow-down12 fsize15"></i></a></p>
        </div>
        <div class="p20">
            <h3 class="dark_500 mb0 fsize14 fw400">Show chat widget
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" v-model="brandData.chat_widget" :checked="brandData.chat_widget">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <h3 class="dark_500 mb0 fsize14 fw400">Show email & referral widgets
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" v-model="brandData.referral_widget" :checked="brandData.referral_widget">
                    <span class="toggle email"></span>
                </label>
            </h3>
        </div>
        <div class="p20 btop">
            <button class="btn btn-md bkg_blue_200 light_000 w-100" @click.prevent="saveConfiguration">Save </button>
        </div>

        <choose-template :brandData="brandData" @openTemplateSelector="openTemplateSelector" @selectTemplate="saveBrandTemplate" ></choose-template>
    </div>

</template>
<script>
    import ChooseTemplate from "./ChooseTemplate";
    import jq from "jquery";
    export default {
        props: ['brandData'],
        components: {ChooseTemplate},
        data(){
            return {
                refreshMessage: 1,


                loading: false,
            }
        },
        watch:{
            brandData: function(){
                this.$emit('syncConfigure', this.brandData);
            }
        },
        methods:{
            saveBrandTemplate: function(param2){
                this.brandData = param2;
            },
            openTemplateSelector: function(){
                jq(".chooseBrandTemplatePopup").animate({
                    width: "toggle"
                });
            },
            saveConfiguration: function(){
                this.showLoading(true);
                axios.post('/admin/brandboost/addBrandConfigurationData', {
                    formData: this.brandData,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.displayMessage('success', 'Configuration saved successfully!!');
                        this.showLoading(false);

                    });
            }
        }
    }

</script>
