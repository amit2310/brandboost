<?php
$allStatus = '';
$openStatus = '';
$clickStatus = '';
if ($selected_tab == 'send') {
    $allStatus = 'active';
} else if ($selected_tab == 'delivered') {
    $openStatus = 'active';
} else if ($selected_tab == 'open') {
    $openStatus = 'active';
} else {
    $allStatus = 'active';
}
?>

<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><i class="icon-vcard"></i> &nbsp; Broadcast Report:<?php echo $oBroadcast->title;?></h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="<?php echo $allStatus; ?>"><a href="#right-icon-tab1" data-toggle="tab"> Sent </a></li>
                    <li class="<?php echo $openStatus; ?>"><a href="#right-icon-tab2" data-toggle="tab"> Delivered </a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <div class="tab-content">
        <!--########################TAB 1 ##########################-->
        <?php $this->load->view("admin/broadcast/reports/subscriber-delivered", array('delivered' => $oBroadcastSub['smsSent'], 'allStatus'=> $allStatus, 'tableId'=>'smsDelivered')); ?>
        <!--########################TAB 2 ##########################-->
        <?php $this->load->view("admin/broadcast/reports/subscriber-open", array('delivered' => $oBroadcastSub['smsOpen'], 'openStatus' => $openStatus, 'tableId'=>'smsOpen')); ?>
    </div>
  
    <?php /* ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Onsite Brand Boost Campaign : <strong><?php echo $oBroadcast->title; ?></strong> </h6>
                    <div class="heading-elements">
                        <!-- <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                            <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                        </button> -->
                    </div>
                </div>
                <div class="panel-body">
                    <div class="tabbable">
                        <input name="min" id="min" type="hidden">
                        <input name="max" id="max" type="hidden">
                        <ul class="nav nav-tabs nav-tabs-bottom" id="nav-tabs-bottom">
                            <li class="<?php echo $allStatus; ?>"><a href="#right-icon-tab1" data-toggle="tab"><i class="icon-pencil7 position-left"></i> Sent </a></li>
                            <li class="<?php echo $openStatus; ?>"><a href="#right-icon-tab2" data-toggle="tab"><i class="icon-comment-discussion position-left"></i> Open </a></li>

                        </ul>
                        <div class="tab-content">

                            <!--########################TAB 1 ##########################-->
                            <?php $this->load->view("admin/broadcast/reports/subscriber-delivered", array('delivered' => $oBroadcastSub['smsSent'], 'allStatus'=> $allStatus)); ?>
                            <!--########################TAB 2 ##########################-->
                            <?php $this->load->view("admin/broadcast/reports/subscriber-open", array('open' => $oBroadcastSub['smsOpen'], 'openStatus' => $openStatus)); ?>
                           



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php */ ?>

</div>






