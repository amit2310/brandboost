<?php
$allStatus = '';
$openStatus = '';
$clickStatus = '';
if ($selected_tab == 'delivered') {
    $allStatus = 'active';
} else if ($selected_tab == 'open') {
    $openStatus = 'active';
} else if ($selected_tab == 'click') {
    $clickStatus = 'active';
}else {
    $allStatus = 'active';
}
?>

<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-5">
                <h3><i class="icon-vcard"></i> &nbsp; Broadcast Report:<?php echo $oBroadcast->title;?></h3>
                <ul class="nav nav-tabs nav-tabs-bottom">

                    <li class="<?php echo $allStatus; ?>"><a href="#right-icon-tab1" data-toggle="tab"> Sent </a></li>
                    <li class="<?php echo $openStatus; ?>"><a href="#right-icon-tab2" data-toggle="tab"> Open </a></li>
                    <li class="<?php echo $clickStatus; ?>"><a href="#right-icon-tab3" data-toggle="tab"> Click </a></li>

                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-7 text-right btn_area">
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <div class="tab-content">

        <!--########################TAB 1 ##########################-->
        <?php $this->load->view("admin/broadcast/reports/subscriber-delivered", array('delivered' => $oBroadcastSub['delivered'], 'allStatus'=> $allStatus, 'tableId'=>'emailDelivered')); ?>
        <!--########################TAB 2 ##########################-->
        <?php $this->load->view("admin/broadcast/reports/subscriber-open", array('delivered' => $oBroadcastSub['open'], 'openStatus' => $openStatus, 'tableId'=>'emailOpen')); ?>
        <!--########################TAB 3 ##########################-->
        <?php $this->load->view("admin/broadcast/reports/subscriber-click", array('delivered' => $oBroadcastSub['click'], 'clickStatus' => $clickStatus, 'tableId'=>'emailClick')); ?>

    </div>


</div>


<script type="text/javascript">

    $(document).ready(function() {

        /*$(document).on('click', '.emailRecord', function() {
            //$('.show_email_report').html(' ');
            var report = $(this).attr('record');
            var broadcastId = $(this).attr('broadcastId');
            $.ajax({
                url: "<?php echo base_url('admin/broadcast/getEmailReport'); ?>",
                type: "POST",
                data: {report: report, broadcastId: broadcastId},
                dataType: "html",
                success: function (data) {
                    $('.show_email_report').html(`
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-flat">${data}</div></div></div>`);

                    $('.dataTables_filter input').addClass('search_item');

                },
                error: function (error) {
                    console.log(error);
                }
            });
        });*/

        $(document).on('click', '.editDataList', function () {
            $('.editAction').toggle();
        });

        $(document).on('change', '#checkAll', function () {
            if (false == $(this).prop("checked")) {
                $(".checkRows").prop('checked', false);
                $(".selectedClass").removeClass('success');
                $('.custom_action_box').hide();
            } else {
                $(".checkRows").prop('checked', true);
                $(".selectedClass").addClass('success');
                $('.custom_action_box').show();
            }
        });

        $(document).on('click', '.checkRows', function () {
            var inc = 0;
            var rowId = $(this).val();

            if (false == $(this).prop("checked")) {
                $('#append-' + rowId).removeClass('success');
            } else {
                $('#append-' + rowId).addClass('success');
            }

            $('.checkRows:checkbox:checked').each(function (i) {
                inc++;
            });
            if (inc == 0) {
                $('.custom_action_box').hide();
            } else {
                $('.custom_action_box').show();
            }

            var numberOfChecked = $('.checkRows:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#checkAll').prop('checked', false);
            }

        });

        var nRecord = '';
        $(document).on('click', '#deleteButtonEmailAutomation', function () {
            nRecord = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                nRecord[i] = $(this).val();
            });
            if (nRecord.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
                "This record will deleted immediately.<br>You can't undo this action.", 
                function() {

                    
                    $('.overlaynew').show();
                    $.ajax({
                        url: "<?php echo base_url('admin/broadcast/multipalDeleteRecord'); ?>",
                        type: "POST",
                        data: {multi_record_id: nRecord},
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 'success') {
                                location.reload();
                            } else {
                                alert("Having some error.");
                            }
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });

                });
            }
        });

    });
</script>




