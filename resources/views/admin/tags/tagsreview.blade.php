@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<?php list($canRead, $canWrite) = fetchPermissions('Tags'); ?>
<!-- Content area -->

<div class="content">


    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-5">
                <h3><i class="icon-price-tag2"></i> &nbsp; Tag Reviews</h3>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-7 text-right btn_area">
                <div class="btn-group">
                    <button type="button" class="btn light_btn btn-icon dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-calendar2"></i>&nbsp; &nbsp; Filter Tag Reviews &nbsp; &nbsp; <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-content width-320 dropdown-menu-right">
                        <div class="dropdown-content-heading"> Filter
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-more"></i></a> </li>
                            </ul>
                        </div>
                        <div class="">
                            <div class="panel-group panel-group-control panel-group-control-right content-group-lg filter_campaign" id="accordion-control-right">
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings active">
                                        <h6 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1"><i class="icon-star-empty3"></i>&nbsp;Campaign Type</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    Most startups fail. But many of those failures are preventable. The Lean Startup is a new approach being adopted across the globe, changing the way companies are built and new products are launched.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group2"><i class="icon-arrow-up-left2"></i>&nbsp; Source</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group73"><i class="icon-star-full2"></i>&nbsp; Rating</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group73" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group74"><i class="icon-calendar"></i>&nbsp; Date Created</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group74" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12"> Conetent Goes here... </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <div class="panel-heading sidebarheadings">
                                        <h6 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group83"><i class="icon-thumbs-up2"></i>&nbsp; Reviews</a> </h6>
                                    </div>
                                    <div id="accordion-control-right-group83" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Total Reviews
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                </div>
                                                
                                            </div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Positive
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" />
                                                </div>
                                                
                                            </div>
                                            <div class="row mb20">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary">
                                                            Neutral
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="20" disabled /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="100" disabled />
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  class="control-primary" checked="checked">
                                                            Negative
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control input-sm" type="text" name="" value="0" /> <span class="dash">-</span> <input class="form-control input-sm" type="text" name="" value="10" />
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-content-footer">
                            <button type="button" class="btn dark_btn dropdown-toggle" style="display: inline-block;"><i class="icon-filter4"></i><span> &nbsp;  Filter</span> </button>
                            &nbsp; &nbsp;
                            <a style="display: inline-block;" href="#">Clear All</a>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->


    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h6 class="panel-title"> <?php echo count($tagData); ?> Tag Reviews</h6>
                    <div class="heading-elements">
                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                            <div class="form-control-feedback">
                                <i class="icon-search4"></i>
                            </div>
                        </div>&nbsp; &nbsp;
                        
                        <button type="button" class="btn btn-xs btn-default editDataTagReview"><i class="icon-pencil position-left"></i> Edit</button>

                        <button id="deleteButtonTagReview" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                    </div>
                </div>

                <div class="panel-body p0">
                      
                        <?php if(!empty($tagData)) {?>
                        <table class="table datatable-basic datatable-sorting">
                            <thead>
                                <tr>
                                    <th style="display: none;"></th>
                                    <th style="display: none;"></th>
                                    <th style="width: 10px!important; display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                    <th class="col-md-3"><i class="icon-price-tag2"></i> Tag Group</th>
                                    <th class="col-md-3"><i class="icon-price-tag2"></i> Tag</th>
                                    <th class="col-md-3"><i class="icon-calendar"></i> Created</th>
                                    <th class="col-md-2"><i class="icon-hash"></i> Reviews</th>
                                    <th class="col-md-1 text-center"><i class="fa fa-dot-circle-o"></i> Action</th>
                                    

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (count($tagData) > 0) {
                                    foreach ($tagData as $data) {

                                        $tData = \App\Models\Admin\TagsModel::getReviewsByTagID($data->id);
                                        if (count($tData) > 0) {
                                            $reviewCount = '<a href="' . base_url('admin/tags/review/' . $data->id) . '"><span class="text-muted reviewnum">(' . count($tData) . ' Reviews)</span></a>';
                                        } else {
                                            $reviewCount = '<span class="text-muted reviewnum">(0 Review)</span>';
                                        }
                                        ?>
                                        <tr id="append-<?php echo $data->id; ?>" class="selectedClass">
                                            <td style="display: none;"><?php echo date('m/d/Y', strtotime($data->tag_created)); ?></td>
                                            <td style="display: none;"><?php echo $data->id; ?></td>
                                            <td style="width: 40px!important; display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" id="chk<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" ><span class="custmo_checkmark"></span></label></td>
											 <td>
												<div class="media-left media-middle"> 
													<a class="icons square" href="#"><i class="icon-indent-decrease2 txt_blue"></i></a> 
												</div>
												<div class="media-left">
												  <div><a href="#" class="text-default text-semibold"><?php echo $data->group_name; ?></a></div>
												</div>
											</td>
                                            <td>
                                                <button class="btn btn-xs btn_white_table pr10">
                                                    <i class="icon-primitive-dot txt_green"></i>
                                                    <?php echo $data->tag_name; ?>
                                                </button>
                                            </td>
                                            
                                            <td>
                                                <div class="media-left">
                                                    <div class="pt-5"><a href="#" class="text-default text-semibold"><?php echo date('d M Y', strtotime($data->tag_created)); ?></a></div>
                                                    <div class="text-muted text-size-small"><?php echo date('h:i A', strtotime($data->tag_created)); ?></div>
                                                </div>
                                            </td>
                                           
                                            											
											<td>
												<a href="<?php echo base_url('admin/tags/review/' . $data->id);?>" target="_blank" class="text-default text-semibold"><?php echo count($tData); ?></a>
												<div data-toggle="tooltip" title="" data-placement="top" class="progress" data-original-title="Total <?php echo count($tData); ?> Feedbacks">
													<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo count($tData); ?>" aria-valuemin="0" aria-valuemax="<?php echo count($tData); ?>" style="width:100%"></div>
												</div>
											</td>

                                            <td class="text-center">
                                                <div class="tdropdown">
                                                    <ul class="icons-list">
                                                        <li class="dropdown"> 
                                                            <button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <?php if($canWrite): ?>
                                                                <li><a href="javascript:void(0);" class="deleteTagGroupEntity" tagid="<?php echo $data->id; ?>" groupid="<?php echo $data->group_id; ?>"><i class="icon-trash"></i> Delete</a></li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                                
                                            </td>
                                           
                                            
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>	

                            </tbody>
                        </table>
                    <?php }
                    else {
                        ?>
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th style="display: none"></th>
                                    <th style="display: none"></th>
                                    <th class="col-md-3"><i class="icon-price-tag2"></i> Tag Group</th>
                                    <th class="col-md-3"><i class="icon-price-tag2"></i> Tag</th>
                                    <th class="col-md-3"><i class="icon-calendar"></i> Created</th>
                                    <th class="col-md-2"><i class="icon-hash"></i> Reviews</th>
                                    <th class="col-md-1 text-center"><i class="fa fa-dot-circle-o"></i> Action</th>

                                </tr>
                            </thead>

                            <tbody>
                                <td style="display: none"></td>
                                <td style="display: none"></td>
                                <td colspan="10">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="margin: 20px 0px 0;" class="text-center">
                                                <h5 class="mb-20 mt40">
                                                    Looks Like You Don’t Have Any Tag Review Yet <img src="<?php echo site_url('assets/images/smiley.png'); ?>"> 
                                                </h5>


                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="display: none"></td>
                                <td style="display: none"></td>
                                <td style="display: none"></td>
                                <td style="display: none"></td>
                            </tbody>
                        </table>
                        <?php
                    }?>
                </div>
            </div>
            <!-- /marketing campaigns -->
        </div>
    </div>
    <!-- /dashboard content -->

</div>
<!-- /content area -->

<script>

    $(document).ready(function() {

        $(document).on('click', '.editDataTagReview', function () {
            $('.editAction').toggle();
        });

        $('#checkAll').change(function () {

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

        $(document).on('click', '#deleteButtonTagReview', function () {

            var val = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to delete this record!",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $('.overlaynew').show();
                        $.ajax({
                            url: '<?php echo base_url('admin/tags/deleteMultipalTagGroupEntity'); ?>',
                            type: "POST",
                            data: {multiTagId: val},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 'success') {
                                    $('.overlaynew').hide();
                                    window.location.href = '';
                                }
                            }
                        });
                    }
                });
            }

        });

     $(document).on('click', '.deleteTagGroupEntity', function () {
var elem = $(this);

            deleteConfirmationPopup(
            "This record will deleted immediately.<br>You can't undo this action.", 
            function() {
                   $('.overlaynew').show();
                            var tagID = $(elem).attr('tagid');
                            var groupID = $(elem).attr('groupid');
                            $.ajax({
                                url: '<?php echo base_url('admin/tags/deleteTagGroupEntity'); ?>',
                                type: "POST",
                                data: {id: tagID,_token: '{{csrf_token()}}'},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        $('.overlaynew').hide();
                                        window.location.href = '';
                                    }
                                }
                            });
            });

        });

    });
    </script>
@endsection