<template>

    <div>

      <!--Top Heading area-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Companies</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-companies-slidebox">New  Companies<span><img src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--Content Area-->
        <div class="content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 blue_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="/assets/images/download-fill.svg"/></span>
                                        Import Companies
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="/assets/images/question-line.svg"/></span>
                                        Learn how to use Companies
                                    </a>
                                </div>
                            </div>


                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 225px; " src="/assets/images/companies.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">No Companies so far. But you can change it!</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import Companies!</h3>
                                    <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-companies-slidebox">Add New Companies</button>
                                </div>
                            </div>






                        </div>
                    </div>
                </div>


            </div>

        </div>



        <!--Smart Popup-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-companies-slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="/assets/images/tag.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Add Companies </h3>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <form action="/action_page.php">
                                    <div class="form-group">
                                        <label for="fname">Company name</label>
                                        <input type="text" class="form-control h56" id="fname" placeholder="Enter company name" name="fname">
                                    </div>


                                    <div class="form-group">
                                        <label for="phonenumber">Color</label>
                                        <div class="phonenumber">
                                            <div class="colorbox">
                                                <div class="colorpickerplus-dropdown" id="color_picker">
                                                    <button type="button" class="dropdown-toggle pickerbutton" data-toggle="dropdown">
                                                        <span class="color-fill-icon dropdown-color-fill-icon"></span> &nbsp; Pick a Color  &nbsp; <b class="caret"></b></button>
                                                    <ul class="dropdown-menu">
                                                        <li class="disabled"><div class="colorpickerplus-container"></div></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="Company description"></textarea>
                                    </div>



                                </form>
                            </div>
                        </div>

                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">Create</button>
                                <a class="blue_300 fsize16 fw600 ml20" href="#">Close</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>
<script>
    export default {
        data(){
            return {
                breadcrumb: {
                    'Home': '#/',
                    'People': '#/contacts/dashboard',
                    'Companies': ''
                }
            }
        },
        mounted() {
            this.makeBreadcrumb(this.breadcrumb);
        }
    };


    $(document).ready(function () {
        $(document).on('click', '.js-companies-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });

    });

</script>



