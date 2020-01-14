<template>
    <div class="box chooseBrandTemplatePopup" style="width: 680px;">
        <div style="width: 680px;overflow: hidden; height: 100%;">
            <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"><a class="cross_icon chooseBrandTemplate" @click="$emit('openTemplateSelector')"><i
                class=""><img src="assets/images/cross.svg"/></i></a>
                <div class="p40">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="htxt_medium_24 dark_800 mt20">Choose Template </h3>
                            <p class="fsize13 dark_200">Choose type of brand page you want to create</p>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4 review_source_new bwwCWBox">
                                    <label for="active_soruce1">
                                        <div class="inner"> <span class="custmo_checkbox checkboxs">
						<input type="radio" class="template_select" value="1" name="template_type" v-model="brandData.template_style"
                               id="active_soruce1">
						<span class="custmo_checkmark red_tr "></span> </span>
                                            <figure><img src="http://brandboost.io/assets/images/brand_page1_icon.png">
                                            </figure>
                                            <a class="bot_txt active" href="#">Info &amp; Media</a></div>
                                    </label>
                                </div>
                                <div class="col-md-4 review_source_new bfwCWBox">
                                    <label for="active_soruce2">
                                        <div class="inner"> <span class="custmo_checkbox checkboxs">
						<input type="radio" class="template_select" value="2" name="template_type" id="active_soruce2" v-model="brandData.template_style">
						<span class="custmo_checkmark red_tr "></span> </span>
                                            <figure><img src="http://brandboost.io/assets/images/brand_page2_icon.png">
                                            </figure>
                                            <a class="bot_txt" href="#">Info &amp; Reviews</a></div>
                                    </label>
                                </div>
                                <div class="col-md-4 review_source_new vpwCWBox">
                                    <label for="active_soruce3">
                                        <div class="inner"> <span class="custmo_checkbox checkboxs">
							<input type="radio" class="template_select" value="3" name="template_type" v-model="brandData.template_style"
                                   id="active_soruce3">
							<span class="custmo_checkmark red_tr "></span> </span>
                                            <figure><img src="http://brandboost.io/assets/images/brand_page3_icon.png">
                                            </figure>
                                            <a class="bot_txt" href="#">Info &amp; Media 2</a></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row bottom-position">
                        <div class="col-md-12 mb15">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-lg bkg_blue_200  light_000 pr20 min_w_160 fsize16 fw600" @click="saveSelectedTemplate">Create
                            </button>
                            <a class="dark_300 fsize16 fw400 ml20" href="javascript:void(0);" @click="$emit('openTemplateSelector')">Close</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['brandData'],
        methods:{
            saveSelectedTemplate: function(){
                this.$emit('saveBrandTemplate', this.brandData);
                this.$emit('openTemplateSelector');
            }
        },

    }
</script>
<style scoped>
    .review_source_new{max-width: 210px; width: 100%; margin-bottom: 10px;}
    .review_source_new label{width: 100%;}
    .review_source_new .inner{text-align: center;  border-radius: 5px;  box-shadow: 0 2px 4px 0 rgba(1, 21, 64, 0.06);  background-color: #ffffff;  /*border: solid 1px #e3e9f3;*/ min-height: 248px; position: relative; padding: 15px; border: 1px solid #eeeeee!important}
    .review_source_new .inner figure{border-radius:0; margin-bottom: 15px;}
    .review_source_new .inner img{border-radius: 5px 5px 0 0; width: 100%;}
    .review_source_new .inner .text_sec{padding: 15px 10px 0; border-top: 1px solid #f4f6fa;}
    .review_source_new .inner .text_sec p{margin-bottom: 5px;}
    .review_source_new .inner .text_sec p strong{ font-size: 13px; font-weight: 400; color: #09204f;}
    .review_source_new .inner .text_sec h5{ font-size: 12px; font-weight: 300!important; color: #5e729d; line-height: 1.33; margin: 0;}
    .review_source_new .inner.active{border: 1px solid #9986e4!important }
    .review_source_new .inner:hover{border: 1px solid #9986e4!important}
    .review_source_new .inner .checkbox{position: absolute; right: -10px; top: -15px; z-index: 99}
    .review_source_new .inner .checkbox label{padding-left: 20px!important;}
    .review_source_new .inner .checker span{background: #9c88e6!important}
    .review_source_new .inner .custmo_radiobox input:checked ~ .custmo_radiomark {	background-color: #9986e4!important;}
    .review_source_new .inner .custmo_checkmark{border-radius: 50px; border: 1px solid #fff;}
    .review_source_new .inner:after{ position: absolute; top: 0; left: 0; width: 100%; height: 100%; content: ''; border-radius: 5px; display: none;}
    .review_source_new :hover .inner:after{display: block; cursor: pointer; }
    .review_source_new .custmo_checkbox.checkboxs{position: absolute; width: 17px; right: 5px!important; top: 11px; z-index: 9; display: inline-block;}
    .review_source_new .custmo_checkbox.checkboxs input:checked .inner:after{display: block; cursor: pointer;}
</style>
