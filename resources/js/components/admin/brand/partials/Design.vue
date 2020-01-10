<template>

    <div id="Design" class="tab-pane fade">
        <div class="p20 bbot pt10 pb10">
            <p class="text-uppercase m-0 fw400 dark_200">Page appearance <a class="float-right" href="javascript:void(0);"><i class="icon-arrow-down12 fsize15"></i></a></p>
        </div>
        <div class="p20">
            <div class="form-group">
                <label class="fsize12">Company Avatar:</label>
                <div class="input-group">
                    <input type="hidden" name="company_logo" id="company_logo" :value="brandData.company_logo">

                    <span class="input-group-addon"><i class="icon-upload7"></i></span>
                    <div class="dropzone" id="myDropzone_logo_img" style="height: 40px!important;border:1px solid #ddd!important;width:85%;"></div>
                </div>
            </div>

            <div class="form-group">
                <label class="fsize12">Header Avatar:</label>
                <div class="input-group">
                    <input type="hidden" name="company_logo" id="company_header_logo" :value="brandData.company_header_logo">

                    <span class="input-group-addon"><i class="icon-upload7"></i></span>
                    <div class="dropzone" id="myDropzone_company_header_logo" style="height: 40px!important;border:1px solid #ddd!important;width:85%;"></div>
                </div>
            </div>

            <div class="form-group">
                <label class="fsize12">Company info:</label>
                <div class="card border p-0">
                    <div class="p-2 bbot">
                        <input style="border: none;" type="text" v-model="brandData.company_info_name" class="form-control fsize14" placeholder="" value="Company" />
                    </div>
                    <div class="p-2">
                        <textarea class="form-control fsize13 dark_600" v-model="brandData.company_info_description" style="border: none; min-height: 120px;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">

                <select class="form-control h56 fsize14" name="brand_themes" id="brand_themes">
                    <option value="">Choose Brand Theme</option>
                    <option v-for="theme in brandThemeData" :value="theme.id">{{theme.brand_theme_title}}</option>
                </select>
            </div>









        </div>


        <!---------------Dual Pane Design----------------->
        <div class="p20 bbot btop pt10 pb10 bkg_light_050">
            <h3 class="text-uppercase m-0 fw400 dark_200 fsize13">Dual Pane Design
                <label class="custom-form-switch float-right">
                    <input class="field" @change="setField($event, 'area_type', '1')" type="checkbox" :checked="brandData.area_type=='1'">
                    <span class="toggle email"></span>
                </label>
            </h3>
        </div>
        <div class="p20"  v-show="brandData.area_type=='1'">
            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Single Color picker <small class="text-lowercase dark_200">Solid color</small>
                <label class="custom-form-switch float-right">
                    <input class="field" @change="DPSingleColor($event)" type="checkbox" :checked="brandData.area_type=='1' && brandData.header_color_solid">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group" v-show="brandData.area_type=='1' && brandData.header_color_solid">
                <input type="text" class="form-control clrpkr_solid1" value="#ffffff" v-model="brandData.header_solid_color" />
            </div>


            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">MAIN Gradient color <small class="text-lowercase dark_200">Gradient</small>
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" @change="DPMainGradient($event)" :checked="brandData.area_type=='1' && brandData.header_color_fix">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group" v-show="brandData.area_type=='1' && brandData.header_color_fix">
                <div class="color_box">
                    <div v-for="color in colors" @click="brandData.header_color=color" :class="`color_cube ${color} ${brandData.header_color == color ? 'active': ''}`"></div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group" v-show="brandData.area_type=='1' && brandData.header_color_fix">
                <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation A</h3>
                <ul class="choose_orientation">
                    <li v-for="orient in orientations" :class="orient.class"><a :class="{'active': brandData.color_orientation_top == orient.name}" :color-orientation="orient.name" href="javascript:void(0);"><i :class="orient.icon" aria-hidden="true"></i></a></li>
                </ul>
            </div>


            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Gradient Color picker <small class="text-lowercase dark_200">Custom Gradient color</small>
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" @change="DPMainCustomGradient($event)" :checked="brandData.area_type=='1' && brandData.header_color_custom">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group" v-show="brandData.area_type=='1' && brandData.header_color_custom">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control clrpkr_custom1" value="#20BF7E" v-model="brandData.header_custom_color1">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control clrpkr_custom2" value="#000000" v-model="brandData.header_custom_color2">
                    </div>
                </div>
            </div>
            <div class="orientation_top" v-show="brandData.area_type=='1' && brandData.header_color_custom">
            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation B</h3>
            <div class="form-group">
                <ul class="choose_orientation">
                    <li v-for="orient in orientations" :class="orient.class"><a :class="{'active': brandData.color_orientation_top == orient.name}" :color-orientation="orient.name" href="javascript:void(0);"><i :class="orient.icon" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            </div>
        </div>



        <!---------------Single Pane Design----------------->
        <div class="p20 bbot btop pt10 pb10 bkg_light_050">
            <h3 class="text-uppercase m-0 fw400 dark_200 fsize13">Single Pane Design
                <label class="custom-form-switch float-right">
                    <input class="field" @change="setField($event, 'area_type', '2')" type="checkbox" :checked="brandData.area_type=='2'">
                    <span class="toggle email"></span>
                </label>
            </h3>
        </div>

        <div class="p20" v-show="brandData.area_type=='2'">
            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Single Color picker <small class="text-lowercase dark_200">Solid color</small>
                <label class="custom-form-switch float-right">
                    <input class="field" @change="SPSingleColor($event)" v-model="brandData.header_color_solid" type="checkbox" :checked="brandData.area_type=='2' && brandData.header_color_solid">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group" v-show="brandData.area_type=='2' && brandData.header_color_solid">
                <input type="text" class="form-control clrpkr_solid2" value="#FF0000" v-model="brandData.header_solid_color" />
            </div>


            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">MAIN Gradient color <small class="text-lowercase dark_200">Gradient</small>
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" @change="SPMainGradient($event)" :checked="brandData.area_type=='2' && brandData.header_color_fix">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group" v-show="brandData.area_type=='2' && brandData.header_color_fix">
                <div class="color_box">
                    <div v-for="color in colors" @click="brandData.header_color=color" :class="`color_cube ${color} ${brandData.header_color == color ? 'active': ''}`"></div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group" v-show="brandData.area_type=='2' && brandData.header_color_fix">
                <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation C</h3>
                <ul class="choose_orientation">
                    <li v-for="orient in orientations" :class="orient.class"><a :class="{'active': brandData.color_orientation_full == orient.name}" :color-orientation="orient.name" href="javascript:void(0);"><i :class="orient.icon" aria-hidden="true"></i></a></li>
                </ul>
            </div>


            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Gradient Color picker <small class="text-lowercase dark_200">Custom Gradient color</small>
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" @change="SPMainCustomGradient($event)" :checked="brandData.area_type=='2' && brandData.header_color_custom">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group" v-show="brandData.area_type=='2' && brandData.header_color_custom">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control clrpkr_custom3" value="#20BF7E" v-model="brandData.header_custom_color1">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control clrpkr_custom4" value="#000000" v-model="brandData.header_custom_color2">
                    </div>
                </div>
            </div>
            <div class="orientation_top" v-show="brandData.area_type=='2' && brandData.header_color_custom">
            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation D</h3>
            <div class="form-group">
                <ul class="choose_orientation">
                    <li v-for="orient in orientations" :class="orient.class"><a :class="{'active': brandData.color_orientation_full == orient.name}" :color-orientation="orient.name" href="javascript:void(0);"><i :class="orient.icon" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            </div>
        </div>







        <div class="p20 bbot btop pt10 pb10">
            <p class="text-uppercase m-0 fw400 dark_200">Save Brand Theme Settings <a class="float-right" href="javascript:void(0);"><i class="icon-arrow-down12 fsize15"></i></a></p>
        </div>
        <div class="p20">
            <div class="form-group">
                <input type="text" class="form-control h40" id="fname" placeholder="Create Brand Theme" name="fname">
            </div>
            <button class="btn btn-md bkg_blue_200 light_000 w-100">Save Brand Theme </button>
        </div>



    </div>

</template>
<script>

    export default {
        props: ['brandData', 'brandThemeData'],
        data(){
            return {
                refreshMessage: 1,
                successMsg: '',
                errorMsg: '',
                loading: false,
                colors: ['white', 'dred', 'yellow', 'red', 'green', 'blue', 'purple'],
                orientations: [{class:'torighttop', name:'to right top', icon:'fa fa-arrow-right degtop'},
                    {class:'toright', name:'to right', icon:'fa fa-arrow-right'},
                    {class:'torightbottom', name:'to right bottom', icon:'fa fa-arrow-right degbot'},
                    {class:'tobottom', name:'to bottom', icon:'fa fa-arrow-down'},
                    {class:'toleftbottom', name:'to left bottom', icon:'fa fa-arrow-left degtop'},
                    {class:'toleft', name:'to left', icon:'fa fa-arrow-left'},
                    {class:'tolefttop', name:'to left top', icon:'fa fa-arrow-left degbot'},
                    {class:'totop', name:'to top', icon:'fa fa-arrow-up'},
                    {class:'circle', name:'circle', icon:'fa fa-undo'}]
            }
        },
        mounted() {
            let userid = this.brandData.user_id;
            setTimeout(function(){
                loadBrandDesignJQScript(userid);
            }, 500);
        },
        methods:{
            //Double Pane
            DPSingleColor: function(ev){
                if(ev.target.checked){
                    this.brandData.header_color_solid = true;
                    this.brandData.header_color_fix = false;
                }else{
                    this.brandData.header_color_solid = false;
                    this.brandData.header_color_fix = true;
                }

            },
            DPMainGradient: function(ev){
                if(ev.target.checked){
                    this.brandData.header_color_fix = true;
                    this.brandData.header_color_custom = false;
                }else{
                    this.brandData.header_color_fix = false;
                    this.brandData.header_color_custom = true;
                }

            },
            DPMainCustomGradient: function(ev){
                if(ev.target.checked){
                    this.brandData.header_color_custom = true;
                    this.brandData.header_color_fix = false;
                }else{
                    this.brandData.header_color_custom = false;
                    this.brandData.header_color_fix = true;
                }

            },
            //Single Pane
            SPSingleColor: function(ev){
                if(ev.target.checked){
                    this.brandData.header_color_solid = true;
                    this.brandData.header_color_fix = false;
                }else{
                    this.brandData.header_color_solid = false;
                    this.brandData.header_color_fix = true;
                }

            },
            SPMainGradient: function(ev){
                if(ev.target.checked){
                    this.brandData.header_color_fix = true;
                    this.brandData.header_color_custom = false;
                }else{
                    this.brandData.header_color_fix = false;
                    this.brandData.header_color_custom = true;
                }

            },
            SPMainCustomGradient: function(ev){
                if(ev.target.checked){
                    this.brandData.header_color_custom = true;
                    this.brandData.header_color_fix = false;
                }else{
                    this.brandData.header_color_custom = false;
                    this.brandData.header_color_fix = true;
                }

            },
            setField: function(e, field, value){
                let OtherValue;
                if(field == 'area_type'){
                    OtherValue = value == '1' ? '2' : '1';
                }
                if(e.target.checked){
                    this.brandData[field] = value;
                }else{
                    this.brandData[field] = OtherValue;
                }

            },
            saveConfiguration: function(){
                this.loading = true;
                axios.post('/admin/brandboost/addBrandConfigurationData', {
                    formData: this.brandData,
                    _token: this.csrf_token()
                })
                    .then(response => {
                        this.successMsg = 'Configuration saved successfully!!';
                        this.loading = false;

                    });
            }
        }
    }

    function loadBrandDesignJQScript(userid){
        var tkn = $('meta[name="_token"]').attr('content');
        $(".clrpkr_custom1").spectrum({
            change: function (color) {
                $('.clrpkr_custom1').val(color.toHexString());
            },
            move: function (color) {
                $('.clrpkr_custom1').val(color.toHexString());
            }
        });
        $(".clrpkr_custom2").spectrum({
            change: function (color) {
                $('.clrpkr_custom2').val(color.toHexString());
            },
            move: function (color) {
                $('.clrpkr_custom2').val(color.toHexString());
            }
        });
        $(".clrpkr_custom3").spectrum({
            change: function (color) {
                $('.clrpkr_custom3').val(color.toHexString());
            },
            move: function (color) {
                $('.clrpkr_custom3').val(color.toHexString());
            }
        });
        $(".clrpkr_custom4").spectrum({
            change: function (color) {
                $('.clrpkr_custom4').val(color.toHexString());
            },
            move: function (color) {
                $('.clrpkr_custom4').val(color.toHexString());
            }
        });
        $(".clrpkr_solid1").spectrum({
            change: function (color) {
                $('.clrpkr_solid1').val(color.toHexString());
            },
            move: function (color) {
                $('.clrpkr_solid1').val(color.toHexString());
            }
        });
        $(".clrpkr_solid2").spectrum({
            change: function (color) {
                $('.clrpkr_solid2').val(color.toHexString());
            },
            move: function (color) {
                $('.clrpkr_solid2').val(color.toHexString());
            }
        });

        Dropzone.autoDiscover = false;
        var myDropzoneLogoImg = new Dropzone(
            '#myDropzone_logo_img', //id of drop zone element 1
            {
                url: '/webchat/dropzone/upload_s3_attachment/'+userid+'/onsite',
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: 600,
                acceptedFiles: 'image/*',
                addRemoveLinks: false,
                success: function (response) {

                    if (response.xhr.responseText != "") {

                        $('.company_avatar').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/' + response.xhr.responseText).show();
                        var dropImage = $('#company_logo').val();
                        $.ajax({
                            url: "/admin/brandboost/deleteObjectFromS3",
                            type: "POST",
                            data: {dropImage: dropImage, _token: tkn},
                            dataType: "json",
                            success: function (data) {
                                console.log(data);
                            }
                        });
                        $('#company_logo').val(response.xhr.responseText);
                    }

                }
            });
        myDropzoneLogoImg.on("complete", function (file) {
            myDropzoneLogoImg.removeFile(file);
        });

        var myDropzoneHeaderLogo = new Dropzone(
            '#myDropzone_company_header_logo', //id of drop zone element 1
            {
                url: '/webchat/dropzone/upload_s3_attachment'+userid+'/onsite',
                uploadMultiple: false,
                maxFiles: 1,
                maxFilesize: 600,
                acceptedFiles: 'image/*',
                addRemoveLinks: false,
                success: function (response) {

                    if (response.xhr.responseText != "") {

                        $('.company_header_avatar').attr('src', 'https://s3-us-west-2.amazonaws.com/brandboost.io/' + response.xhr.responseText).show();
                        var dropImage = $('#company_header_logo').val();
                        $.ajax({
                            url: "/admin/brandboost/deleteObjectFromS3",
                            type: "POST",
                            data: {dropImage: dropImage, _token: tkn},
                            dataType: "json",
                            success: function (data) {
                                console.log(data);
                            }
                        });
                        $('#company_header_logo').val(response.xhr.responseText);
                    }

                }
            });
        myDropzoneHeaderLogo.on("complete", function (file) {
            myDropzoneHeaderLogo.removeFile(file);
        });
    }

</script>
<style>
    .dropzone .dz-default.dz-message:before { content: ''!important; }
    .dropzone {min-height:40px;}
    .dropzone .dz-default.dz-message span {    font-size: 13px;    margin-top: -10px;}
    .dropzone .dz-preview.dz-image-preview { display:none !important;}
    .dropzone .dz-message {margin:0px!important;}
    .dropzone .dz-default.dz-message {
        top: 0%!important;
        height: 40px;
        margin-top: -10px!important;
    }
    .input-group-addon {
        padding: 12px;
        font-size: 13px;
        font-weight: normal;
        line-height: 1;
        color: #333333;
        text-align: center;
        background-color: #fcfcfc;
        border: 1px solid #ddd;
        border-radius: 3px;
    }

</style>
