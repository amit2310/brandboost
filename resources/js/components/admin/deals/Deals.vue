<template>

    <div>

      <!--Top Heading area-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <span class="float-left mr20"><img src="/assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">People Deals</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="/assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 js-deals-slidebox">Create new<span><img src="/assets/images/blue-plus.svg"/></span></button>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--Content Area-->
        <div class="content-area">
            <div class="container-fluid" v-if="!hasData">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card_shadow min-h-280">

                            <div class="row mb65">
                                <div class="col-md-6 text-left">
                                    <a class="lh_32 blue_400 htxt_bold_14" href="#">
                                        <span class="circle-icon-32 float-left bkg_blue_000 mr10"><img src="/assets/images/download-fill.svg"/></span>
                                        Import Deals
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="lh_32 htxt_regular_14 dark_200" href="#">
                                        <span class="circle-icon-32 float-right ml10 bkg_light_200"><img src="/assets/images/question-line.svg"/></span>
                                        Learn how to use Deals
                                    </a>
                                </div>
                            </div>


                            <div class="row mb65">
                                <div class="col-md-12 text-center">
                                    <img class="mt40" style="max-width: 325px; " src="/assets/images/deals.png">
                                    <h3 class="htxt_bold_18 dark_700 mt30">Looks like you don’t have any deals yet</h3>
                                    <h3 class="htxt_regular_14 dark_200 mt20 mb25">It’s very easy to create or import deals!</h3>
                                    <button class="btn btn-sm bkg_blue_000 pr20 blue_300 js-deals-slidebox">New Deals</button>
                                </div>
                            </div>






                        </div>
                    </div>
                </div>


            </div>
            <div class="container-fluid" v-else>

                <div class="table_head_action bbot pb30">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">All Contacts (3)</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="/assets/images/date_created.svg"/></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="/assets/images/list_view.svg"/></span>&nbsp; List View
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input class="table_search" type="text" placeholder="Serch" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="headings mb30">
                            <h3 class="htxt_regular_18 dark_500"><i class="mr10"><img src="/assets/images/dot_circle_grey_16.svg"/></i>Lead <span class="dark_200">(2)</span></h3>
                        </div>

                        <div class="card p25">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="/assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
                            </div>
                            <img width="28" height="28" src="/assets/images/avatar/01.png"/>
                            <h3 class="htxt_medium_14 dark_700 mt15 mb10">Stella Fisher</h3>
                            <p class="htxt_regular_12 dark_300 mb0">stanley.baker@example.com</p>
                        </div>

                        <div class="card p25">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="/assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
                            </div>
                            <img width="28" height="28" src="/assets/images/avatar/02.png"/>
                            <h3 class="htxt_medium_14 dark_700 mt15 mb10">Max Howard</h3>
                            <p class="htxt_regular_12 dark_300 mb0">greg.neal@example.com</p>
                        </div>

                    </div>


                    <div class="col-md-3">
                        <div class="headings mb30">
                            <h3 class="htxt_regular_18 dark_500"><i class="mr10"><img src="/assets/images/dot_circle_voilet_16.svg"/></i>Deal <span class="dark_200">(3)</span></h3>
                        </div>

                        <div class="card p25">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="/assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
                            </div>
                            <img width="28" height="28" src="/assets/images/avatar/03.png"/>
                            <h3 class="htxt_medium_14 dark_700 mt15 mb10">Wendy Mccoy</h3>
                            <p class="htxt_regular_12 dark_300 mb0">sue.elliott@example.com</p>
                        </div>

                        <div class="card p25">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="/assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
                            </div>
                            <img width="28" height="28" src="/assets/images/avatar/04.png"/>
                            <h3 class="htxt_medium_14 dark_700 mt15 mb10">Jorge Miles</h3>
                            <p class="htxt_regular_12 dark_300 mb0">robert.castro@example.com</p>
                        </div>

                        <div class="card p25">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="/assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
                            </div>
                            <img width="28" height="28" src="/assets/images/avatar/05.png"/>
                            <h3 class="htxt_medium_14 dark_700 mt15 mb10">Jenny Henry</h3>
                            <p class="htxt_regular_12 dark_300 mb0">cherly.lawson@example.com</p>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="headings mb30">
                            <h3 class="htxt_regular_18 dark_500"><i class="mr10"><img src="/assets/images/dot_circle_blue_16.svg"/></i>Customers <span class="dark_200">(2)</span></h3>
                        </div>

                        <div class="card p25">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="/assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
                            </div>
                            <img width="28" height="28" src="/assets/images/avatar/06.png"/>
                            <h3 class="htxt_medium_14 dark_700 mt15 mb10">Marjorie Mckinney</h3>
                            <p class="htxt_regular_12 dark_300 mb0">max.hoffman@example.com</p>
                        </div>

                        <div class="card p25">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="/assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
                            </div>
                            <img width="28" height="28" src="/assets/images/avatar/07.png"/>
                            <h3 class="htxt_medium_14 dark_700 mt15 mb10">Devon Bell</h3>
                            <p class="htxt_regular_12 dark_300 mb0">willie.jennings@example.com</p>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="headings mb30">
                            <h3 class="htxt_regular_18 dark_500"><i class="mr10"><img src="/assets/images/dot_circle_green_16.svg"/></i>Ok <span class="dark_200">(1)</span></h3>
                        </div>

                        <div class="card p25">
                            <div class="dot_dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img class="" src="/assets/images/dots.svg" alt="profile-user"> </a>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a> <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a> <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a> <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a></div>
                            </div>
                            <img width="28" height="28" src="/assets/images/avatar/08.png"/>
                            <h3 class="htxt_medium_14 dark_700 mt15 mb10">Bessie Watson</h3>
                            <p class="htxt_regular_12 dark_300 mb0">michelle.rivera@example.com</p>
                        </div>


                    </div>

                </div>




            </div>

        </div>



        <!--Smart Popup-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon js-deals-slidebox"><i class=""><img src="/assets/images/cross.svg"/></i></a>
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="/assets/images/create_cotact_people.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Create New Deal </h3>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <form action="/action_page.php">
                                    <div class="form-group">
                                        <label for="fname">First name</label>
                                        <input type="text" class="form-control h56" id="fname" placeholder="Enter name" name="fname">
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Last name</label>
                                        <input type="text" class="form-control h56" id="lname" placeholder="Enter last name" name="lname">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control h56" id="email" placeholder="Enter email address" name="email">
                                    </div>
                                    <!--<div class="form-group">
                                      <label for="pwd">Phone number</label>
                                      <input type="text" class="form-control h56" id="pwd" placeholder="Enter phone number" name="pswd">
                                    </div>-->
                                    <div class="form-group">
                                        <label for="phonenumber">Phone number</label>
                                        <div class="phonenumber">
                                            <div class="float-left">
                                                <button type="button" class="dropdown-toggle table_action_dropdown p0 mt10" data-toggle="dropdown">
                                                    <span><img src="/assets/images/USA.png"/></span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Link 1</a>
                                                    <a class="dropdown-item" href="#">Link 2</a>
                                                    <a class="dropdown-item" href="#">Link 3</a>
                                                </div>
                                            </div>
                                            <input type="text" class="inputbox" id="phonenumber" placeholder="Enter phone number" name="phonenumber">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="tags">Tags</label>
                                        <div class="clearfix"></div>
                                        <input type="text" class="form-control h56" id="tags" value='Removeable Tag, Other Tag'  name="tags" style="display: none">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mb50">
                            <div class="col-md-6"><a class="htxt_medium_14 dark_300" href="#"><span class="mr10"><img src="/assets/images/plus_icon.svg"/></span>Contact Details</a> </div>
                            <div class="col-md-6 text-right"><a class="htxt_medium_14 dark_300" href="#">Assign Contact <span class="ml10"><img src="/assets/images/plus_icon.svg"/></span></a> </div>
                        </div>
                        <div class="row bottom-position">
                            <div class="col-md-12 mb15">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-lg bkg_blue_300 light_000 pr20 min_w_160 fsize16 fw600">Save</button>
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
                    'Deals': ''
                },
                hasData : true
            }
        },
        mounted() {
            this.makeBreadcrumb(this.breadcrumb);
        }
    };


    $(document).ready(function () {
        $(document).on('click', '.js-deals-slidebox', function(){
            $(".box").animate({
                width: "toggle"
            });
        });

    });

</script>



