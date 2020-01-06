<template>

    <div class="content">
        <!--******************
          Top Heading area
         **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">Reviews</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="assets/images/filter_review.svg"/></button>
                        <button class="btn btn-md light_000 bkg_reviews_300 slidebox" >Create Request <span><img src="assets/images/review_plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--******************
        Content Area
        **********************-->
        <div class="content-area">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card p30 pl40 pr50 user_profile">
                            <div class="row">
                                <div class="col-md-6 brig">
                                    <div class="media_left">
                                        <div class="profile_icon bkg_green_300 mr15">
                                            <img src="assets/images/review_smiley.svg">
                                        </div>
                                    </div>


                                    <div class="media_left">
                                        <div class="">
                                            <h3 class="htxt_medium_32 dark_700 mb-2 mt-0">79.3%</h3>
                                            <p class="fsize12 dark_200 text-uppercase mb0 fw500">YOUR ONLINE REPUTATION IS GOOD &nbsp;<span class="green_400">+5%</span></p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="media_left mt-1 ml-5">
                                        <img src="assets/images/lightbulb-fill-24.svg"/>
                                    </div>
                                    <div class="media_left">
                                        <p class="fsize14 dark_400 mb-0">
                                            Your recent emails have low avg. 9% bounce<br>
                                            rate. We suggest you to send new email <br>
                                            in next 3 days.
                                        </p>
                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 d-flex">
                        <div class="card p0 animate_top col">
                            <div class="p15 pt15 bbot text-center">
                                <ul class="workflow_list">
                                    <li><a class="text-uppercase fw500 dark_600" href="#">OVERALL RATING</a></li>
                                </ul>
                            </div>
                            <div class="p30 text-center mt-1">
                                <h3 class="htxt_regular_28 dark_700 mb-1">4.5</h3>
                                <p class="mb-4"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>

                                <div class="ratingbox">
                                    <ul>
                                        <li><a href="#"><img src="assets/images/star-fill-24.svg"/></a></li>
                                        <li><a href="#"><img src="assets/images/star-fill-24.svg"/></a></li>
                                        <li><a href="#"><img src="assets/images/star-fill-24.svg"/></a></li>
                                        <li><a href="#"><img src="assets/images/star-fill-24.svg"/></a></li>
                                        <li><a href="#"><img src="assets/images/star-half-fill-24.svg"/></a></li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex">
                        <div class="card p0 animate_top col">
                            <div class="p15 pt15 bbot text-center">
                                <ul class="workflow_list">
                                    <li><a class="text-uppercase fw500 dark_600" href="#">Review requests</a></li>
                                </ul>
                            </div>
                            <div class="p30 text-center">
                                <h3 class="htxt_regular_28 dark_700 mt-0 mb-1">128</h3>
                                <p class="m-0 mb-3"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"/></i>33,87%</span>last week</p>
                                <div style="min-height: 40px; margin: 40px 0 0;" class="img_box">
                                    <div id="Reviewrequests" class=""></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex">
                        <div class="card p0 animate_top col">
                            <div class="p15 pt15 bbot text-center">
                                <ul class="workflow_list">
                                    <li><a class="text-uppercase fw500 dark_600" href="#">MONTHLY GOAL</a></li>
                                </ul>
                            </div>
                            <div class="p30 text-center mt-1">
                                <div class="circle-icon-56 m-auto"><img src="assets/images/review_goal.svg"></div>
                                <h3 class="htxt_regular_28 dark_700 mt-4 mb-1">32 <span class="dark_200">/ 50</span></h3>
                                <p class="m-0"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>last week</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card p0 col">
                            <div class="p15 pl30 bbot">
                                <a class="fsize12 dark_200 fw500" href="#">REVIEWS</a>
                            </div>
                            <div class="p30 pl40 pb0">
                                <h3 class="htxt_regular_28 dark_700 mb10">31</h3>
                                <p class="fsize14 mb-0"><span class="green_400">33.87%</span> &nbsp;  <span class="dark_400"> / week</span></p>
                                <div id="basiclinechart" style="margin-left: -25px">
                                    <!--<apexchart type=line height=160 :options="chartOptions2" :series="series" />-->
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="card p0 col">
                            <div class="p15 pl30 bbot">
                                <a class="fsize12 dark_200 fw500" href="#">OFF SITE REVIEWS</a>
                            </div>
                            <div class="p30 pl40 pb0">
                                <h3 class="htxt_regular_28 dark_700 mb10">19</h3>
                                <p class="fsize14"><span class="green_400">33,87%</span> &nbsp;  <span class="dark_400">  last month</span></p>

                                <div class="clearfix"></div>
                                <img style="max-width: 100%" src="assets/images/social_graph.png"/>
                                <!--<div id="OffSiteReviews">
                               <apexchart type=bar height=160 :options="chartOptions" :series="series" />
                             </div>-->



                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--******************
        Content Area End
        **********************-->

    </div>

</template>

<script>
    export default {
        props : ['pageColor', 'title'],
        data(){
            return {

            }
        },
        mounted() {
            console.log("component mounted")
        }
    }
</script>
