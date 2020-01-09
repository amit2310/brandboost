<template>

    <div id="Design" class="tab-pane fade">
        <div class="p20 bbot pt10 pb10">
            <p class="text-uppercase m-0 fw400 dark_200">Page appearance <a class="float-right" href="javascript:void(0);"><i class="icon-arrow-down12 fsize15"></i></a></p>
        </div>
        <div class="p20 bbot">
            <img class="circle-icon-64" width="65" src="assets/images/avatar/01.png"/>
            <img class="circle-icon-64" width="65" src="assets/images/avatar/02.png"/>
        </div>
        <div class="p20">
            <div class="form-group">
                <label class="fsize12">Company Avatar:</label>
                <label class="m0 w-100" for="upload">
                    <div class="img_vid_upload_medium">
                        <input class="d-none" type="file" name="" value="" id="upload">
                    </div>
                </label>
            </div>

            <div class="form-group">
                <label class="fsize12">Header Avatar:</label>
                <label class="m0 w-100" for="upload">
                    <div class="img_vid_upload_medium">
                        <input class="d-none" type="file" name="" value="" id="upload">
                    </div>
                </label>
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
                    <input class="field" v-model="brandData.header_color_solid" type="checkbox" :checked="brandData.area_type=='1' && brandData.header_color_solid">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group" v-show="brandData.area_type=='1' && brandData.header_color_solid">
                <input type="text" class="form-control" value="#ffffff" v-model="brandData.header_solid_color" />
            </div>


            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">MAIN Gradient color <small class="text-lowercase dark_200">Gradient</small>
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" v-model="brandData.header_color_fix" :checked="brandData.area_type=='1' && brandData.header_color_fix">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group" v-show="brandData.area_type=='1' && brandData.header_color_fix">
                <div class="color_box">
                    <div v-for="color in colors" @click="brandData.header_color=color" :class="`color_cube ${color} ${brandData.header_color == color ? 'active': ''}`"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation</h3>
            <div class="form-group" v-show="brandData.area_type=='1' && brandData.header_color_fix">
                <ul class="choose_orientation">
                    <li class="torighttop"><a class="active" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                    <li class="toright"><a class="" color-orientation="to right" href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li class="torightbottom"><a class="" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                    <li class="tobottom"><a class="" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                    <li class="toleftbottom"><a class="" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                    <li class="toleft"><a class="" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                    <li class="tolefttop"><a class="" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                    <li class="totop"><a class="" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                    <li class="circle"><a class="" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                </ul>
            </div>


            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Gradient Color picker <small class="text-lowercase dark_200">Custom Gradient color</small>
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" checked="">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control colorpicker-basic1" value="#20BF7E">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control colorpicker-basic2" value="#000000">
                    </div>
                </div>
            </div>
            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation</h3>
            <div class="form-group">
                <ul class="choose_orientation">
                    <li class="torighttop"><a class="active" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                    <li class="toright"><a class="" color-orientation="to right" href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li class="torightbottom"><a class="" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                    <li class="tobottom"><a class="" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                    <li class="toleftbottom"><a class="" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                    <li class="toleft"><a class="" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                    <li class="tolefttop"><a class="" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                    <li class="totop"><a class="" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                    <li class="circle"><a class="" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                </ul>
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
                    <input class="field" v-model="brandData.header_color_solid" type="checkbox" :checked="brandData.area_type=='2' && brandData.header_color_solid">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group" v-show="brandData.area_type=='2' && brandData.header_color_solid">
                <input type="text" class="form-control" value="#ffffff" />
            </div>


            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">MAIN Gradient color <small class="text-lowercase dark_200">Gradient</small>
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" checked="">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group">
                <div class="color_box">
                    <div class="color_cube dred"></div>
                    <div class="color_cube yellow"></div>
                    <div class="color_cube red"></div>
                    <div class="color_cube green active"></div>
                    <div class="color_cube blue"></div>
                    <div class="color_cube black"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation</h3>
            <div class="form-group">
                <ul class="choose_orientation">
                    <li class="torighttop"><a class="active" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                    <li class="toright"><a class="" color-orientation="to right" href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li class="torightbottom"><a class="" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                    <li class="tobottom"><a class="" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                    <li class="toleftbottom"><a class="" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                    <li class="toleft"><a class="" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                    <li class="tolefttop"><a class="" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                    <li class="totop"><a class="" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                    <li class="circle"><a class="" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                </ul>
            </div>


            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Gradient Color picker <small class="text-lowercase dark_200">Custom Gradient color</small>
                <label class="custom-form-switch float-right">
                    <input class="field" type="checkbox" checked="">
                    <span class="toggle email"></span>
                </label>
            </h3>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control colorpicker-basic1" value="#20BF7E">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control colorpicker-basic2" value="#000000">
                    </div>
                </div>
            </div>
            <h3 class="dark_500 mb0 fsize12 fw400 text-uppercase">Choose orientation</h3>
            <div class="form-group">
                <ul class="choose_orientation">
                    <li class="torighttop"><a class="active" color-orientation="to right top" href="javascript:void(0);"><i class="fa fa-arrow-right degtop" aria-hidden="true"></i></a></li>
                    <li class="toright"><a class="" color-orientation="to right" href="javascript:void(0);"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
                    <li class="torightbottom"><a class="" color-orientation="to right bottom" href="javascript:void(0);"><i class="fa fa-arrow-right degbot" aria-hidden="true"></i></a></li>
                    <li class="tobottom"><a class="" color-orientation="to bottom" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a></li>
                    <li class="toleftbottom"><a class="" color-orientation="to left bottom" href="javascript:void(0);"><i class="fa fa-arrow-left degtop" aria-hidden="true"></i></a></li>
                    <li class="toleft"><a class="" color-orientation="to left" href="javascript:void(0);"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
                    <li class="tolefttop"><a class="" color-orientation="to left top" href="javascript:void(0);"><i class="fa fa-arrow-left degbot" aria-hidden="true"></i></a></li>
                    <li class="totop"><a class="" color-orientation="to top" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a></li>
                    <li class="circle"><a class="" color-orientation="circle" href="javascript:void(0);"><i class="fa fa-undo" aria-hidden="true"></i></a></li>
                </ul>
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
            }
        },
        methods:{
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

</script>
