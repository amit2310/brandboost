@php
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
@endphp

<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><i class="icon-vcard"></i> &nbsp; Broadcast Report:{{ $oBroadcast->title }} </h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="{{ $allStatus }}"><a href="#right-icon-tab1" data-toggle="tab"> Sent </a></li>
                    <li class="{{ $openStatus }}"><a href="#right-icon-tab2" data-toggle="tab"> Delivered </a></li>
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
        @include("admin.broadcast.reports.subscriber-delivered", ['delivered' => $oBroadcastSub['smsSent'], 'allStatus'=> $allStatus, 'tableId'=>'smsDelivered'])
        <!--########################TAB 2 ##########################-->
        @include("admin.broadcast.reports.subscriber-open", ['delivered' => $oBroadcastSub['smsOpen'], 'openStatus' => $openStatus, 'tableId'=>'smsOpen'])
    </div>
</div>






