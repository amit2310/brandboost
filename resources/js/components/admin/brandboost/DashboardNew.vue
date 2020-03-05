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
                        <h3 class="htxt_medium_24 dark_700">Review General</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15"><img src="assets/images/settings-2-line-reviews.svg"></button>
                        <!--<button class="btn btn-md bkg_reviews_400 light_000" data-toggle="modal" data-target="#CREATEFORM">CREATE CAMPAIGN <span><img src="assets/images/reviews_plus_icon.svg"></span></button>-->
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

                <!--******************
                 PAGE LEFT SIDEBAR
                **********************-->`
                <!--<div class="page_sidebar bkg_light_000 fixed">
                    <div style="width: 279px;">
                        <div class="p20 bbot top_headings">
                            <div class="row">
                                <div class="col"><p>ReviewS</p></div>
                                <div class="col text-right"><p><a class="close_sidebar" href="#">OPEN MENU &nbsp; <img src="assets/images/menu-2-line.svg"></a></p></div>
                            </div>
                        </div>

                        <div class="p20 pt30 pb10">
                            <div class="row">
                                <div class="col"><h3 class="htxt_medium_24 dark_800">Campaigns</h3></div>
                                <div class="col text-right"><button class="circle-icon-32 shadow3"><img src="assets/images/add-fill-review.svg"></button></div>
                            </div>
                        </div>

                        <div class="p20 top_headings">
                            <div class="row">
                                <div class="col"><p><a href="#"><img src="assets/images/filter-line.svg"> &nbsp; Filter</a></p></div>
                                <div class="col text-right"><p><a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a> &nbsp; <a href="#"><i><img src="assets/images/sort_16_grey.svg"></i></a></p></div>
                            </div>
                        </div>
                        <div class="p20 pt0 pb0 bkg_light_050">
                            <ul class="list_with_icons3">
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/start-fill-white.svg"></span>IBM</span>
                                    <strong>4.5 <i class="ri-star-fill green_400"></i></strong>
                                </li>
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_green_200"><img src="assets/images/start-fill-white.svg"></span>General Electric</span>
                                    <strong>4.8 <i class="ri-star-fill green_400"></i></strong>
                                </li>
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_review_200"><img src="assets/images/start-fill-white.svg"></span>Louis Vuitton</span>
                                    <strong>3.2 <i class="ri-star-fill yellow_400"></i></strong>
                                </li>
                                <li class="d-flex active">
                                    <span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/start-fill-white.svg"></span>Apple</span>
                                    <strong>4.3 <i class="ri-star-fill green_400"></i></strong>
                                </li>
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_red_200"><img src="assets/images/start-fill-white.svg"></span>IBM</span>
                                    <strong>2.7 <i class="ri-star-fill red_400"></i></strong>
                                </li>
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/start-fill-white.svg"></span>General Electric</span>
                                    <strong>4.8 <i class="ri-star-fill green_400"></i></strong>
                                </li>
                                <li class="d-flex">
                                    <span><span class="circle_icon_24 bkg_yellow_200"><img src="assets/images/start-fill-white.svg"></span>Louis Vuitton</span>
                                    <strong>4.5 <i class="ri-star-fill green_400"></i></strong>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>-->
                <!--******************
                  PAGE LEFT SIDEBAR END
                 **********************-->

                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="table_filter">
                                <li><a class="active" href="#">Overview</a></li>
                                <li><a href="#">Requests</a></li>
                                <li><a href="#">Reviews</a></li>
                                <li><a href="#">Contacts</a></li>
                                <li><a href="#">Stats</a></li>
                                <!--<li><a href="#"><i><img src="assets/images/filter-3-fill.svg"></i> &nbsp; FILTER</a></li>-->
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="table_filter text-right">
                                <li><a href="#"><i><img src="assets/images/search-2-line_grey.svg"></i></a></li>
                                <li><a href="#"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                                <li><a href="#"><i><img src="assets/images/cards_16_grey.svg"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 d-flex">


                        <div class="card p25 pt20 animate_top col">
                            <div class="row">
                                <div class="col-9">
                                    <p class="fsize12 fw500 ls_4 dark_400 m-0 float-left">REVIEW REQUESTS</p>
                                </div>
                                <div class="col">
                                    <div class="float-right">
                                        <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical.svg"></span> </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(647px, 102px, 0px);"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <hr>
                                </div>
                            </div>
                            <div class="p0 pt20 pb0">
                                <div class="row">
                                    <div class="col-md-7 pr-0">
                                        <h3 class="htxt_regular_28 dark_700 mt-0 mb-1">284</h3>
                                        <p class="m-0 fsize14"><span class="red_400 mr-2"><i><img src="assets/images/arrow-right-down-line-red.svg"></i>15%</span>last week</p>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="float-right"><img height="96" src="assets/images/review_request_chart1.svg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="col-md-4 d-flex">
                        <div class="card p25 pt20 animate_top col">
                            <div class="row">
                                <div class="col-9">
                                    <p class="fsize12 fw500 ls_4 dark_400 m-0 float-left">REQUEST CLICK RATE</p>
                                </div>
                                <div class="col">
                                    <div class="float-right">
                                        <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical.svg"></span> </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(647px, 102px, 0px);"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <hr>
                                </div>
                            </div>
                            <div class="p0 pt20 pb0">
                                <div class="row">
                                    <div class="col-md-7 pr-0">
                                        <h3 class="htxt_regular_28 dark_700 mt-0 mb-1">46%</h3>
                                        <p class="m-0 fsize14"><span class="green_400 mr-2"><i><img src="assets/images/arrow-right-up-line.svg"></i>33,87%</span>/ last week</p>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="float-right"><img height="96" src="assets/images/review_chart_02.svg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex">
                        <div class="card p25 pt20 animate_top col">
                            <div class="row">
                                <div class="col-9">
                                    <p class="fsize12 fw500 ls_4 dark_400 m-0 float-left">REVIEWS SUMMARY</p>
                                </div>
                                <div class="col">
                                    <div class="float-right">
                                        <button type="button" class="dropdown-toggle table_dots_dd" data-toggle="dropdown" aria-expanded="false"> <span><img src="assets/images/more-vertical.svg"></span> </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(647px, 102px, 0px);"> <a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <hr>
                                </div>
                            </div>
                            <div class="p0 pt0 pb0">
                                <div class="row">
                                    <div class="col-md-5 pr-0">
                                        <div class="mt20"><img height="96" src="assets/images/review_chart_03.svg"></div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="list2">
                                            <li><span><i class="ri-star-s-fill fsize18 green_400"></i> 4-5</span>  <strong>129</strong></li>
                                            <li><span><i class="ri-star-s-fill fsize18 yellow_400"></i> 3</span>  <strong>74</strong></li>
                                            <li><span><i class="ri-star-s-fill fsize18 red_400"></i> 1-2</span>  <strong>13</strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table_head_action pb0 mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_14 dark_600">Review Requests</h3>
                        </div>
                        <div class="col-md-6">
                            <ul class="table_filter text-right">
                                <li><a href="#"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                <tr class="headings">
                                    <td width="20">
				  	<span>
						<label class="custmo_checkbox pull-left">
							<input type="checkbox">
							<span class="custmo_checkmark blue"></span>
						</label>
					</span>
                                    </td>
                                    <td><span class="fsize10 fw500">name </span></td>
                                    <td><span class="fsize10 fw500">EMAIL / phone</span></td>
                                    <td><span class="fsize10 fw500">CAMPAIGN</span></td>
                                    <td><span class="fsize10 fw500">SENT <img src="assets/images/arrow-down-line-14.svg"></span></td>
                                    <td><span class="fsize10 fw500">REVIEW  </span></td>
                                    <td><span class="fsize10 fw500"><img src="assets/images/eyeline.svg"></span></td>
                                    <td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"></span></td>

                                </tr>



                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">f</span></span> Floyd Howard</td>
                                    <td><img src="assets/images/atline.svg"> &nbsp; scott.gilbert@example.com</td>
                                    <td>New Customers Campaign</td>
                                    <td><span class="">Jun 20, 2020</span></td>
                                    <td><img src="assets/images/star-line.svg"> <span class="light_400">-</span></td>
                                    <td>&nbsp;</td>
                                    <td><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
                                </tr>

                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">g</span></span> Gregory Henry</td>
                                    <td><img src="assets/images/chatline.svg"> &nbsp; (201) 555-0124</td>
                                    <td>Smart SMS Campaign</td>
                                    <td><span class="">Jul 16, 2020</span></td>
                                    <td><img src="assets/images/star-line.svg"> <span class="light_400">-</span></td>
                                    <td><img src="assets/images/checklineblack.svg"></td>
                                    <td><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
                                </tr>

                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/03.png"></span></span> Arlene Bell</td>
                                    <td><img src="assets/images/atline.svg"> &nbsp; henry.frazier@example.com</td>
                                    <td>New Customers Campaign</td>
                                    <td><span class="">Apr 26, 2020</span></td>
                                    <td><img src="assets/images/star-line.svg"> <span class="light_400">-</span></td>
                                    <td>&nbsp;</td>
                                    <td><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
                                </tr>

                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">g</span></span> Gloria Fisher</td>
                                    <td><img src="assets/images/chatline.svg"> &nbsp; (225) 555-0118</td>
                                    <td>Email Requests </td>
                                    <td><span class="">Nov 30, 2020</span></td>
                                    <td><img src="assets/images/star-fill_yellow_16.svg" width="14"> &nbsp; <span class="dark_400">4.5</span></td>
                                    <td><img src="assets/images/check_double_green.svg"></td>
                                    <td><span class="float-right"><span class="status_icon bkg_blue_300"></span></span></td>
                                </tr>



                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/05.png"></span></span> Evan Robertson</td>
                                    <td><img src="assets/images/atline.svg"> &nbsp; benjamin.ray@example.com</td>
                                    <td>Default</td>
                                    <td><span class="">Nov 2, 2020</span></td>
                                    <td><img src="assets/images/star-line.svg"> <span class="light_400">-</span></td>
                                    <td>&nbsp;</td>
                                    <td><span class="float-right"><span class="status_icon bkg_light_800"></span></span></td>
                                </tr>


                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/06.png"></span></span> Gloria Fisher</td>
                                    <td><img src="assets/images/atline.svg"> &nbsp; tiffany.dean@example.com</td>
                                    <td>Customers Campaign </td>
                                    <td><span class="">Jul 27, 2020</span></td>
                                    <td><img src="assets/images/star-fill_yellow_16.svg" width="14"> &nbsp; <span class="dark_400">4.5</span></td>
                                    <td><img src="assets/images/check_double_green.svg"></td>
                                    <td><span class="float-right"><span class="status_icon bkg_blue_300"></span></span></td>
                                </tr>

                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200"><img src="assets/images/avatar/07.png"></span></span> Gloria Fisher</td>
                                    <td><img src="assets/images/chatline.svg"> &nbsp; (307) 555-0133</td>
                                    <td>Customers Campaign </td>
                                    <td><span class="">Jul 27, 2020</span></td>
                                    <td><img src="assets/images/star-fill_yellow_16.svg" width="14"> &nbsp; <span class="dark_400">4.5</span></td>
                                    <td><img src="assets/images/check_double_green.svg"></td>
                                    <td><span class="float-right"><span class="status_icon bkg_blue_300"></span></span></td>
                                </tr>










                                </tbody>
                            </table>

                            <div class="custom_pagination">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="mr-4">ITEMS PER PAGE:<select><option>10</option><option>10</option><option>15</option><option>20</option></select></span>
                                        <span>1-10 out of 137</span>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="page_list float-right">
                                            <li><a href="#"><img src="assets/images/arrow-right-s-line.svg"></a></li>
                                            <li><a class="active" href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">...</a></li>
                                            <li><a href="#">9</a></li>
                                            <li><a href="#"><img src="assets/images/arrow-left-s-line.svg"></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>

                <div class="table_head_action pb0 mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_14 dark_600">Reviews</h3>
                        </div>
                        <div class="col-md-6">
                            <ul class="table_filter text-right">
                                <li><a href="#"><i><img src="assets/images/sort_16_grey.svg"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                <tr class="headings">
                                    <td width="20">
				  	<span>
						<label class="custmo_checkbox pull-left">
							<input type="checkbox">
							<span class="custmo_checkmark blue"></span>
						</label>
					</span>
                                    </td>
                                    <td><span class="fsize10 fw500">CONTACT </span></td>
                                    <td><span class="fsize10 fw500">RATING</span></td>
                                    <td><span class="fsize10 fw500">REVIEW</span></td>
                                    <td><span class="fsize10 fw500"><img src="assets/images/circle_grey_right_arrow.svg"></span></td>
                                    <td><span class="fsize10 fw500">SUBMITTED <img src="assets/images/arrow-down-line-14.svg"></span></td>
                                    <td class="text-right"><span class="fsize10 fw500"><img src="assets/images/settings-2-line.svg"></span></td>

                                </tr>



                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td class="fw500 dark_600"><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">f</span></span> Floyd Howard</td>
                                    <td>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        &nbsp; <span>5.0</span></td>
                                    <td>Consectetur eiusmod aliquip aliquip ...</td>
                                    <td><i class="ri-at-line email_400 fsize15"></i></td>
                                    <td>3 month ago</td>
                                    <td><span class="float-right"><span class="status_icon bkg_green_400"></span></span></td>
                                </tr>

                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td class="fw500 dark_600"><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">f</span></span> Regina Flores</td>
                                    <td>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 light_600"></i>
                                        &nbsp; <span>4.0</span></td>
                                    <td>Consectetur eiusmod aliquip aliquip ...</td>
                                    <td><i class="ri-phone-line green_400 fsize15"></i></td>
                                    <td>3 month ago</td>
                                    <td><span class="float-right"><span class="status_icon bkg_green_400"></span></span></td>
                                </tr>

                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td class="fw500 dark_600"><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">f</span></span> Jorge Robertson</td>
                                    <td>
                                        <i class="ri-star-s-fill fsize18 yellow_400"></i>
                                        <i class="ri-star-s-fill fsize18 yellow_400"></i>
                                        <i class="ri-star-s-fill fsize18 yellow_400"></i>
                                        <i class="ri-star-s-fill fsize18 light_600"></i>
                                        <i class="ri-star-s-fill fsize18 light_600"></i>
                                        &nbsp; <span>4.0</span></td>
                                    <td>Consectetur eiusmod aliquip aliquip ...</td>
                                    <td><i class="ri-phone-line green_400 fsize15"></i></td>
                                    <td>3 month ago</td>
                                    <td><span class="float-right"><span class="status_icon bkg_green_400"></span></span></td>
                                </tr>


                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td class="fw500 dark_600"><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">f</span></span> Floyd Howard</td>
                                    <td>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        &nbsp; <span>5.0</span></td>
                                    <td>Consectetur eiusmod aliquip aliquip ...</td>
                                    <td><i class="ri-at-line email_400 fsize15"></i></td>
                                    <td>3 month ago</td>
                                    <td><span class="float-right"><span class="status_icon bkg_green_400"></span></span></td>
                                </tr>

                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td class="fw500 dark_600"><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">f</span></span> Regina Flores</td>
                                    <td>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 green_400"></i>
                                        <i class="ri-star-s-fill fsize18 light_600"></i>
                                        &nbsp; <span>4.0</span></td>
                                    <td>Consectetur eiusmod aliquip aliquip ...</td>
                                    <td><i class="ri-phone-line green_400 fsize15"></i></td>
                                    <td>3 month ago</td>
                                    <td><span class="float-right"><span class="status_icon bkg_green_400"></span></span></td>
                                </tr>

                                <tr>
                                    <td width="20">
						<span>
							<label class="custmo_checkbox pull-left">
								<input type="checkbox">
								<span class="custmo_checkmark blue"></span>
							</label>
						</span>
                                    </td>
                                    <td class="fw500 dark_600"><span class="table-img mr15"><span class="circle_icon_24 bkg_blue_200">f</span></span> Jorge Robertson</td>
                                    <td>
                                        <i class="ri-star-s-fill fsize18 yellow_400"></i>
                                        <i class="ri-star-s-fill fsize18 yellow_400"></i>
                                        <i class="ri-star-s-fill fsize18 yellow_400"></i>
                                        <i class="ri-star-s-fill fsize18 light_600"></i>
                                        <i class="ri-star-s-fill fsize18 light_600"></i>
                                        &nbsp; <span>4.0</span></td>
                                    <td>Consectetur eiusmod aliquip aliquip ...</td>
                                    <td><i class="ri-phone-line green_400 fsize15"></i></td>
                                    <td>3 month ago</td>
                                    <td><span class="float-right"><span class="status_icon bkg_green_400"></span></span></td>
                                </tr>










                                </tbody>
                            </table>

                            <div class="custom_pagination">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="mr-4">ITEMS PER PAGE:<select><option>10</option><option>10</option><option>15</option><option>20</option></select></span>
                                        <span>1-10 out of 137</span>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="page_list float-right">
                                            <li><a href="#"><img src="assets/images/arrow-right-s-line.svg"></a></li>
                                            <li><a class="active" href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">...</a></li>
                                            <li><a href="#">9</a></li>
                                            <li><a href="#"><img src="assets/images/arrow-left-s-line.svg"></a></li>
                                        </ul>
                                    </div>
                                </div>
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
    import UserAvatar from '@/components/helpers/UserAvatar';
    import Pagination from '@/components/helpers/Pagination';

    export default {
        props : ['pageColor', 'title', 'review_type'],
        components: {UserAvatar, Pagination},
        data(){
            return {
                moduleName: '',
                moduleUnitID: '',
                moduleAccountID: '',
                allData: {},
                oReviews : '',
                oCampaign: '',
                reviewTags: '',
                campaignId: '',
                current_page: 1,
                breadcrumb: '',
                viewType: 'List View',
                sortBy: 'Name',
                searchBy: ''
            }
        },
        created() {
            this.loadPaginatedData();
        },
        mounted() {
            this.$parent.pageColor = this.pageColor;
        },
        watch: {
            'sortBy' : function(){
                this.loadPaginatedData();
            }
        },
        methods: {
            searchItem: function(){
                this.loadPaginatedData();
            },
            showReview: function(id){
                window.location.href='#/reviews/onsite/reviews/'+id;
            },
            showQuestions: function(id){
                window.location.href='#/brandboost/questions/'+id;
            },
            loadPaginatedData : function(){
                axios.get('/admin/brandboost/reviews?page='+this.current_page+'&search='+this.searchBy+'&sortBy='+this.sortBy)
                    .then(response => {
                        this.breadcrumb = response.data.breadcrumb;
                        this.makeBreadcrumb(this.breadcrumb);
                        this.moduleName = response.data.moduleName;
                        this.oCampaign = response.data.oCampaign;
                        this.allData = response.data.allData;
                        this.oReviews = response.data.aReviews;
                        this.reviewTags = response.data.reviewTags;
                        this.reviewTags = response.data.reviewTags;
                        this.loading = false;
                        //console.log(this.campaigns)
                    });
            },
            showPaginationData: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            },
            navigatePagination: function(p){
                this.loading=true;
                this.current_page = p;
                this.loadPaginatedData();
            }
        }
    }
</script>
