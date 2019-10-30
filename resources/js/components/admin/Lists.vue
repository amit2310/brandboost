<template>

    <div class="content" id="masterContainer">

        <!--******************
          Top Heading area
         **********************-->
        <div class="top-bar-top-section bbot">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <span class="float-left mr20 back_btn"><img class="back_img_icon" src="assets/images/BACK.svg"/></span>
                        <h3 class="htxt_medium_24 dark_700">People Contact Manager</h3>
                    </div>
                    <div class="col-md-6 col-6 text-right">
                        <button class="circle-icon-40 mr15 back_btn"><img class="back_img_icon" src="assets/images/filter.svg"/></button>
                        <button class="btn btn-md bkg_blue_200 light_000 slidebox">Main Action <span><img src="assets/images/blue-plus.svg"/></span></button>
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

                <div class="table_head_action">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">Contact lists</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/date_created.svg"/></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/list_view.svg"/></span>&nbsp; List View
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input class="table_search" type="text" placeholder="Search" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div v-for="list in lists" class="col-md-3 text-center" @click="showListSubscribers(list[0].id)" style="cursor:pointer;">
                        <div class="card p30 h235 animate_top">
                            <img class="mt20" src="assets/images/subs-icon_big.svg">
                            <h3 class="htxt_bold_16 dark_700 mt25 mb15">
                                <span>{{ list[0].list_name }}</span>
                            </h3>
                            <p class="htxt_regular_12 dark_300 mb15"><i><img src="assets/images/user_16_grey.svg"/></i> {{ list.length }}</p>
                        </div>
                    </div>

                    <div class="col-md-3 text-center">
                        <div class="card p30 bkg_light_200 shadow_none h235 animate_top">
                            <img class="mt20 mb30" src="assets/images/plus_icon_circle_64.svg">
                            <p class="htxt_regular_16 dark_100 mb15">Create<br>contacts list</p>
                        </div>
                    </div>

                </div>


                <div class="table_head_action mt10">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="htxt_medium_16 dark_400">Latest contacts</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="table_action">
                                <div class="float-right">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/date_created.svg"/></span>&nbsp; Date Created
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right ml10 mr10">
                                    <button type="button" class="dropdown-toggle table_action_dropdown" data-toggle="dropdown">
                                        <span><img src="assets/images/list_view.svg"/></span>&nbsp; List View
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Link 1</a>
                                        <a class="dropdown-item" href="#">Link 2</a>
                                        <a class="dropdown-item" href="#">Link 3</a>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <input class="table_search" type="text" placeholder="Search" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--<div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td><span class="table-img mr15"><img src="assets/images/table_user.png"/></span> <span class="htxt_medium_14 dark_900">Courtney Black</span></td>
                                    <td class="text-right">nina.hernandez@example.com</td>
                                    <td># lead, subscriber</td>
                                    <td><span class="badge badge-dark">+4</span></td>
                                    <td>Customer</td>
                                    <td><span class="dot_6 bkg_blue_300">&nbsp;</span></td>
                                    <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td><span class="table-img mr15"><img src="assets/images/table_user2.png"/></span> <span class="htxt_medium_14 dark_900">Savannah Webb</span></td>
                                    <td class="text-right">ivan.carter@example.com</td>
                                    <td># lead, subscriber</td>
                                    <td><span class="badge badge-dark">+4</span></td>
                                    <td>Ticket</td>
                                    <td><span class="dot_6 bkg_yellow_500">&nbsp;</span></td>
                                    <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td><span class="table-img mr15"><img src="assets/images/table_user3.png"/></span> <span class="htxt_medium_14 dark_900">Bessie Flores</span></td>
                                    <td class="text-right">tim.jennings@example.com</td>
                                    <td># lead, subscriber</td>
                                    <td><span class="badge badge-dark">+4</span></td>
                                    <td>Customer</td>
                                    <td><span class="dot_6 bkg_blue_300">&nbsp;</span></td>
                                    <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                                    </td>
                                </tr>


                                <tr>
                                    <td><span class="table-img mr15"><img src="assets/images/table_user4.png"/></span> <span class="htxt_medium_14 dark_900">Dianne Mckinney</span></td>
                                    <td class="text-right">logan.hopkins@example.com</td>
                                    <td># lead, subscriber</td>
                                    <td><span class="badge badge-dark">+4</span></td>
                                    <td>Ticket</td>
                                    <td><span class="dot_6 bkg_yellow_500">&nbsp;</span></td>
                                    <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td><span class="table-img mr15"><img src="assets/images/table_user2.png"/></span> <span class="htxt_medium_14 dark_900">Dianne Mckinney</span></td>
                                    <td class="text-right">logan.hopkins@example.com</td>
                                    <td># lead, subscriber</td>
                                    <td><span class="badge badge-dark">+4</span></td>
                                    <td>Ticket</td>
                                    <td><span class="dot_6 bkg_yellow_500">&nbsp;</span></td>
                                    <td class="text-right"><span class="icons"><img src="assets/images/message-2-line.svg"/></span> <span class="icons"><img src="assets/images/mail-open-line-16.svg"/></span> <span class="icons"><img src="assets/images/message-3-line-16.svg"/></span> <span class="icons"><img src="assets/images/star-line.svg"/></span>
                                    </td>
                                </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>-->


            </div>

        </div>

        <!--******************
          Content Area End
         **********************-->

        <!--******************
          Create Contact Sliding Smart Popup
         **********************-->
        <div class="box" style="width: 424px;">
            <div style="width: 424px;overflow: hidden; height: 100%;">
                <div style="height: 100%; overflow-y:auto; overflow-x: hidden;"> <a class="cross_icon slidebox"><i class=""><img src="assets/images/cross.svg"/></i></a>
                    <div class="p40">
                        <div class="row">
                            <div class="col-md-12"> <img src="assets/images/list-icon.svg"/>
                                <h3 class="htxt_medium_24 dark_800 mt20">Create List </h3>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <form action="/action_page.php">
                                    <div class="form-group">
                                        <label for="fname">List name</label>
                                        <input type="text" class="form-control h56" id="fname" placeholder="Enter list name" name="fname">
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
                                        <textarea class="form-control min_h_185 p20 pt10" id="desc" placeholder="List description"></textarea>
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
    import UserAvatar from '../helpers/UserAvatar';
    import PeopleListCreateSmartPopup from '../helpers/PeopleListCreateSmartPopup';

    export default {
        title: 'Email Lists - Brand Boost',
        components: {UserAvatar, PeopleListCreateSmartPopup},
        data() {
            return {
                oData: {},
                oLists: {},
                lists: {}
            }
        },
        methods: {
            firstListname(object) {
                return object.value[0].list_name
            },
            showListSubscribers: function(listId){
                window.location.href='#/lists/getListContacts/'+listId;
            },
        },
        mounted() {
            //getData
            axios.get('/admin/lists/')
                .then(response => {
                    const rDataArr = response.data.split("^^^^^");

                    this.oData = JSON.parse(rDataArr[0]);
                    this.oLists = this.oData.oLists;
                    //console.log(this.oLists);
                    this.lists = JSON.parse(rDataArr[1]);
                    //console.log(this.lists);
                });
            console.log('Component mounted')
        }
    }


    $(document).ready(function () {

        $(".slidebox").click(function(){
            $(".box").animate({
                width: "toggle"
            });
        });

        $('[name=tags]').tagify();

    });


</script>
