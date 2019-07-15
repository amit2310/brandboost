
<?php
$aUInfo = $userDetail;
$cb_contact_id = $aUInfo->cb_contact_id;
$userId = $aUInfo->id;
//pre($aUInfo);

$avatar = $aUInfo->avatar;
$firstname = $aUInfo->firstname;
$lastname = $aUInfo->lastname;
$userRole = $aUInfo->user_role;

if ($userRole == '1') {

    $roleName = 'Administrator';
} else if ($userRole == '2') {

    $roleName = 'User';
} else if ($userRole == '3') {

    $roleName = 'Customer';
} else {

    $roleName = '';
}
$username = $firstname . ' ' . $lastname;
if (!empty($avatar)) {
    $srcUserImg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $avatar;
} else {
    $srcUserImg = '/profile_images/avatar_image.png';
}

$address = $aUInfo->address;
$city = $aUInfo->city;
$state = $aUInfo->state;
$country = $aUInfo->country;
$email = $aUInfo->email;
$mobile = $aUInfo->mobile;
?>
<link href="<?php echo base_url(); ?>assets/flags/flags.css" rel=stylesheet type="text/css">
<!-- <div class="content-wrapper people_sec"> -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-5">
                <h3><i class="icon-envelop5"></i> &nbsp; <?php echo $username; ?></h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Profile</a></li>
                    <li><a href="#right-icon-tab1" data-toggle="tab">Reviews</a></li>
                    <li><a href="#right-icon-tab2" data-toggle="tab">Referal Programm</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-7 text-right btn_area">
                <?php
                if ($oUser->user_role == '1') {
                    ?>
                <button type="button" class="btn light_btn ml20 addManualCredit" id="<?php echo base64_url_encode($aUInfo->id); ?>"><i class="icon-star-full2 txt_black"></i><span> &nbsp;  Add Credits</span> </button>
                <?php
                }
                ?>
                
                <button type="button" class="btn light_btn ml20" data-toggle="modal" data-target="#addContact"><i class="icon-star-full2 txt_black"></i><span> &nbsp;  Request Review</span> </button>
                <button type="button" class="btn light_btn ml20" data-toggle="modal" data-target="#addContact"><i class="icon-indent-increase2 txt_black"></i><span> &nbsp;  Add to List</span> </button>
                <button type="button" class="btn dark_btn ml20" data-toggle="modal" data-target="#addContact"><i class="icon-plus3"></i><span> &nbsp;  New Conversation</span> </button>
            </div>
        </div>
    </div>




    <!--&&&&&&&&&&&& TABBED CONTENT &&&&&&&&&&-->
    <div class="tab-content"> 
        <!--===========TAB 1===========-->
        <div class="tab-pane active" id="right-icon-tab0">
            <div class="row">
                <!------------------------->
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Profile</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body min_h270 p0" >
                            <div class="profile_sec">
                                <div class="p40 text-center">
                                    <div class="profile_pic">
                                        <img width="84" height="84" class="img-circle" src="<?php echo $srcUserImg; ?>"/>
                                        <div class="profile_flags">
											<img style="height:18px!important;" class="flags" src="<?php echo base_url(); ?>assets/images/flags/<?php echo strtolower($aUInfo->country); ?>.png" onerror="this.src='<?php echo base_url('assets/images/flags/us.png'); ?>'"/></div>
                                    </div>


                                    <h3><?php echo $username; ?></h3>
                                    <p class="text-size-small text-muted mb0"><?php echo $state; ?>, <?php echo $country; ?></p>
                                </div>



                                <div class="profile_headings">Info <a class="pull-right plus_icon" href="#"><i class="icon-plus3"></i></a></div>


                                <div class="interactions p25">
                                    <ul>
                                        <li><small>Email</small> <strong><?php echo $email; ?></strong></li>
                                        <li><small>Phone</small> <strong><?php echo $mobile; ?></strong></li>
                                        <li><small>Gender</small> <strong>Male</strong></li>
                                        <li><small>Timezone</small> <strong>US/Estern</strong></li>
                                        <li><small>Email Status</small> <strong>Opt-Out of All</strong></li>

                                    </ul>
                                </div>


                                <div class="profile_headings">Lists <a class="pull-right plus_icon" href= "<?php echo base_url('admin/lists/'); ?>"><i class="icon-plus3"></i></a></div>
                                <?php
                                $newolists = array();

                                foreach ($getMyLists as $key => $value) {
                                    $newolists[$value->id][] = $value;
                                }
                                ?>
                                <div class="p25">
                                    <?php
                                    if (!empty($newolists)) {
                                        foreach ($newolists as $value) {
                                            //pre($value[0]->list_name);
                                            ?><button class="btn btn-xs btn_white_table"><?php echo $value[0]->list_name; ?></button><?php
                                        }
                                    }
                                    ?>

                                </div>

                                <div class="profile_headings">Segments <a class="pull-right plus_icon" href="#"><i class="icon-plus3"></i></a></div>

                                <div class="p25">
                                    <button class="btn btn-xs btn_white_table">Added Review</button>
                                    <button class="btn btn-xs btn_white_table">Male 25+</button>
                                    <button class="btn btn-xs btn_white_table">USA, Canada, Australia</button>
                                    <button class="btn btn-xs btn_white_table">Positive</button>
                                    <button class="btn btn-xs btn_white_table">Referral</button>
                                    <button class="btn btn-xs btn_white_table">Added media</button>
                                    <button class="btn btn-xs btn_white_table">SF</button>
                                    <button class="btn btn-xs btn_white_table">SMS</button>
                                    <button class="btn btn-xs btn_white_table">Emails</button>
                                </div>

                                <div class="profile_headings">Tags <a class="pull-right plus_icon" href="<?php echo base_url('admin/tags'); ?>"><i class="icon-plus3"></i></a></div>

                                <div class="p25">
                                    <?php
                                    foreach ($getClientTags as $value) {

                                        if (!empty($value->tag_name)) {
                                            ?><button class="btn btn-xs btn_white_table"><?php echo $value->tag_name; ?></button><?php
                                        }
                                    }
                                    ?>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <!------------------------->
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <!--<h6 class="panel-title">New Note</h6>-->
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="active"><a href="#NewNote" data-toggle="tab">New Note</a></li>
                                <li><a href="#Email" data-toggle="tab">Email</a></li>
                                <li><a href="#SMS" data-toggle="tab">SMS</a></li>
                                <li><a href="#Chat" data-toggle="tab">Chat</a></li>
                                <li><a href="#ActivityLog" data-toggle="tab">Activity Log</a></li>
                            </ul>

                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content"> 
                                <div class="tab-pane active" id="NewNote">
                                    <textarea class="form-control addnote" placeholder="Start typing to leave a note..."></textarea>
                                </div>
                                <div class="tab-pane" id="Email">
                                    Email
                                </div>
                                <div class="tab-pane" id="SMS">
                                    SMS
                                </div>
                                <div class="tab-pane" id="Chat">
                                    Chat
                                </div>
                                <div class="tab-pane" id="ActivityLog">
                                    Activity Log
                                </div>
                            </div>


                        </div>
                        <div class="panel-footer p20 text-right">
                            <a href="#"><i class="icon-hash text-muted"></i></a> &nbsp; &nbsp; <a href="#"><i class="icon-reset text-muted"></i></a>
                            <button class="btn dark_btn btn-xs ml20">Add Note</button>
                        </div>
                    </div>

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Activity</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body min_h270 p0">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-envelop txt_blue"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">Email <span class="text-muted">sent in </span> New Product Campaign</a></div>

                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted text-size-small">24 Jul 2018 &nbsp; 11:44AM</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-user txt_dblue"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">Updated Info <span class="text-muted">Max </span> Phone, City</a></div>

                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted text-size-small">24 Jul 2018 &nbsp; 11:44AM</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-star-full2 txt_purple"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">Added <span class="text-muted">to </span> New Product Campaign</a></div>

                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted text-size-small">24 Jul 2018 &nbsp; 11:44AM</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-hash txt_blue"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">Tags <span class="text-muted">added </span> Positive, Product Launch, Like</a></div>

                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted text-size-small">24 Jul 2018 &nbsp; 11:44AM</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-envelop txt_blue"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">Email <span class="text-muted">sent in </span> New Product Campaign</a></div>

                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted text-size-small">24 Jul 2018 &nbsp; 11:44AM</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-user txt_dblue"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">Updated Info <span class="text-muted">Max </span> Phone, City</a></div>

                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted text-size-small">24 Jul 2018 &nbsp; 11:44AM</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-bubble-lines4 txt_red"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">Chat <span class="text-muted">with John </span> Product Issue</a></div>

                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted text-size-small">24 Jul 2018 &nbsp; 11:44AM</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-envelop txt_blue"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">Email <span class="text-muted">sent in </span> New Product Campaign</a></div>

                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted text-size-small">24 Jul 2018 &nbsp; 11:44AM</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-user txt_dblue"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">Updated Info <span class="text-muted">Max </span> Phone, City</a></div>

                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted text-size-small">24 Jul 2018 &nbsp; 11:44AM</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-star-full2 txt_purple"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">Added <span class="text-muted">to </span> New Product Campaign</a></div>

                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted text-size-small">24 Jul 2018 &nbsp; 11:44AM</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle"> <a class="icons" href="#"><i class="icon-hash txt_blue"></i></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">Tags <span class="text-muted">added </span> Positive, Product Launch, Like</a></div>

                                            </div>
                                        </td>
                                        <td class="text-right"><span class="text-muted text-size-small">24 Jul 2018 &nbsp; 11:44AM</span></td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>

                <!------------------------->
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Brandboost Credits</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body" >
                            <h1 class="m0"><?php echo (!empty($aUInfo->credits->total_credits)) ? number_format($aUInfo->credits->total_credits) : 0; ?></h1>
                            <p class="text-muted">Total Credits</p>
<!--                            <div class="interactions">
                                <ul>
                                    <li><small>Email Credits</small> <strong><?php echo (!empty($aUInfo->credits->total_email_credits)) ? number_format($aUInfo->credits->total_email_credits) : 0; ?></strong></li>
                                    <li><small>SMS Credits </small> <strong><?php echo (!empty($aUInfo->credits->total_sms_credits)) ? number_format($aUInfo->credits->total_sms_credits) : 0; ?></strong></li>
                                    <li><small>MMS Credits</small> <strong><?php echo (!empty($aUInfo->credits->total_mms_credits)) ? number_format($aUInfo->credits->total_mms_credits) : 0; ?></strong></li>

                                </ul>
                            </div>-->
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Statistic</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body" >
                            <h1 class="m0">135</h1>
                            <p class="text-muted">Interactions</p>
                            <figure class="text-center"><img style="width: 100%;" class="img-responsive" src="<?php echo base_url(); ?>assets/images/graph9.png"/></figure>
                        </div>
                    </div>

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Feedback</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body" >
                            <div class="media-left media-middle"> <a href="#"><img src="assets/images/smiley_green.png" class="img-circle img-xs" alt=""></a> </div>
                            <div class="media-left">
                                <div class=""><a href="#" class="text-default text-semibold">4.1</a>
                                </div>
                                <div class="text-muted text-size-small">Positive</div>
                            </div>
                            <div class="media-left pl40">
                                <div class=""><a href="#" class="text-default text-semibold">24 Sep 2018</a>
                                </div>
                                <div class="text-muted text-size-small">08:12PM</div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Interactions</h6>
                            <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                        </div>
                        <div class="panel-body" >
                            <div class="interactions">
                                <ul>
                                    <li><small>Source</small> <strong>Email</strong></li>
                                    <li><small>First Seen</small> <strong>17 Jan 2018</strong></li>
                                    <li><small>Last Seen</small> <strong>22 Apr 2018</strong></li>
                                    <li><small>Page views</small> <strong>139</strong></li>
                                    <li><small>Reviews</small> <strong>3</strong></li>
                                    <li><small>Notification</small> <strong>On</strong></li>
                                    <li><small>Id</small> <strong>310282</strong></li>
                                    <li><small>SMS</small> <strong>On</strong></li>
                                    <li><small>Emails</small> <strong>Off</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>



            </div>
        </div>
        <!--===========TAB 2===========-->
        <div class="tab-pane" id="right-icon-tab1">
            tab 2
        </div>
        <!--===========TAB 3===========-->
        <div class="tab-pane" id="right-icon-tab2">
            tab 3 
        </div>
    </div>
    <!--&&&&&&&&&&&& TABBED CONTENT  END &&&&&&&&&&-->




</div>
<!-- </div> -->
<?php
if ($oUser->user_role == '1') {
    $this->load->view("admin/modals/credits/add_credits");
}
?>

<script>

// top navigation fixed on scroll and side bar collasped

    $(window).scroll(function () {
        var sc = $(window).scrollTop();
        if (sc > 100) {
            $("#header-sroll").addClass("small-header");
        } else {
            $("#header-sroll").removeClass("small-header");
        }
    });

    function smallMenu() {
        if ($(window).width() < 1600) {
            $('body').addClass('sidebar-xs');
        } else {
            $('body').removeClass('sidebar-xs');
        }
    }

    $(document).ready(function () {
        smallMenu();

        window.onresize = function () {
            smallMenu();
        };
    });






    $(function () {










        // Checkboxes/radios (Uniform)
        // ------------------------------

        // Default initialization
        $(".styled, .multiselect-container input").uniform({
            radioClass: 'choice'
        });

        // File input
        $(".file-styled").uniform({
            wrapperClass: 'bg-blue',
            fileButtonHtml: '<i class="icon-file-plus"></i>'
        });


        //
        // Contextual colors
        //

        // Primary
        $(".control-primary").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-primary-600 text-primary-800'
        });

        // Danger
        $(".control-danger").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-danger-600 text-danger-800'
        });

        // Success
        $(".control-success").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-success-600 text-success-800'
        });

        // Warning
        $(".control-warning").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-warning-600 text-warning-800'
        });

        // Info
        $(".control-info").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-info-600 text-info-800'
        });

        // Custom color
        $(".control-custom").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-indigo-600 text-indigo-800'
        });




        // Bootstrap switch
        // ------------------------------

        //$(".switch").bootstrapSwitch();

    });

    document.getElementById("People").classList.add("active");
    document.getElementById("Peoplelist").classList.add("dblock");


</script>