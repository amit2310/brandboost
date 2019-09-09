@php 
	list($canRead, $canWrite) = fetchPermissions('Feedbacks')
@endphp

<div class="tab-pane {{ $allTab }}" id="right-icon-tab1">
    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                @if ($this->uri->segment(2) != 'brandboost')
                    <div class="panel-heading">
                        <h6 class="panel-title">{{ count($result) }} Offsite Brand Boost Feedback</h6>
                        <div class="heading-elements">
                            <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                <div class="form-control-feedback">
                                    <i class="icon-search4"></i>
                                </div>
                            </div>&nbsp; &nbsp;

                            <button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
                            <button id="deleteButtonBrandboostFeedbacks" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                        </div>
                    </div>
                @endif
				
                <div class="table-responsive">
                    <table class="table datatable-basic datatable-sorting">
                        <thead>
                            <tr>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th class="nosort editAction" style="display:none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                <th><i class="icon-user"></i>Name</th>
                                <th><i class="icon-star-full2"></i>Ratings</th>
                                <th><i class="icon-star-full2"></i>Campaign Review</th>
                                <th><i class="icon-calendar"></i>Created</th>
                                <th><i class="icon-price-tag2"></i>Tags</th>
                                <th><i class="icon-atom"></i>Category</th>
                                <th><i class="icon-atom"></i>Status</th>
                                <th class="text-center nosort"><i class="fa fa-dot-circle-o"></i>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            if (count($result) > 0) {
                                foreach ($result as $data) {
                                    $feedbackTags = \App\Models\Admin\TagsModel::getTagsDataByFeedbackID($data->id);
                                    $brandImgArray = unserialize($data->brand_img);
                                    $brand_img = $brandImgArray[0]['media_url'];

                                    if (empty($brand_img)) {
                                        $imgSrc = base_url('assets/images/default_table_img2.png');
                                    } else {
                                        $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
                                    }

                                    if (!empty($data->avatar)) {
                                        $avatarImage = $data->avatar;
                                    } else {
                                        $avatarImage = 'avatar_image.png';
                                    }
                                    @endphp
                                    <tr id="append-feedback-{{ $data->id }}" class="selectedClass">
                                        <td style="display: none;">{{ date('m/d/Y', strtotime($data->created)) }}</td>
                                        <td style="display: none;">{{ $data->id }}</td>
                                        <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows"  value="{{ $data->id }}" ><span class="custmo_checkmark"></span></label></td>

                                        <td>
                                            <div class="media-left media-middle"> {{ showUserAvtar($data->avatar, $data->firstname, $data->lastname) }} </div>

                                            <div class="media-left">
                                                @if ($data->firstname != '')
                                                    <div class="pt-5"><a href="{{ base_url() }}admin/subscriber/activities/{{ $data->id }}" target="_blank" class="text-default text-semibold"><span>{{ $data->firstname }} {{ $data->lastname }}</span> <img class="flags" src="{{ base_url() }}assets/images/flags/us.png"/></a></div>
                                                    <div class="text-muted text-size-small">{{ $data->email }}</div>
                                                @else
													NA
                                                @endif
                                            </div>
                                        </td>

                                        <td>
                                            @php 
												if ($data->category == 'Positive') {
													$ratingValue = 5;
												} else if ($data->category == 'Neutral') {
													$ratingValue = 3;
												} else {
													$ratingValue = 1;
												} 
											@endphp
											
											{{ $smilyImage = ratingView($ratingValue) }}
                                        </td>

                                        <td>
                                            <div class="text-semibold">{{ setStringLimit($data->title) }}</div>
                                            <div class="text-size-small text-muted">{{ setStringLimit($data->feedback) }}</div>
                                        </td>

                                        <td>
                                            <div class="media-left">
                                                <div class="pt-5">
													<a href="#" class="text-default text-semibold">
														{{ dataFormat($data->created) }}
													</a>
												</div>
                                                <div class="text-muted text-size-small">{{ date('h:i A', strtotime($data->created)) }}</div>
                                            </div>
                                        </td>

                                        <td id="feedback_tag_{{ $data->id }}">
                                            <div class="tdropdown">
                                                <button type="button" class="btn btn-xs btn_white_table bluee dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> {{ count($feedbackTags) }} tags <span class="caret"></span> </button>

                                                <ul class="dropdown-menu dropdown-menu-right tagss">
                                                    @if (count($feedbackTags) > 0)
                                                        @foreach ($feedbackTags as $tagsData)
                                                            <button class="btn btn-xs btn_white_table pr10"> {{ $tagsData->tag_name }}</button>
														@endforeach
													@endif
													
													@if ($canWrite)
                                                        <button class="btn btn-xs plus_icon applyInsightTags" feedback_id="{{ base64_url_encode($data->id) }}" action_name="feedback-tag"><i class="icon-plus3"></i></button>
													@endif
                                                </ul>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="tdropdown">
                                                <button type="button" class="btn btn-xs btn_white_table dropdown-toggle " data-toggle="dropdown">
													@if ($data->category == 'Positive')
                                                        <span class="label txt_blue">Positive</span>
													@elseif ($data->category == 'Neutral')
                                                        <span class="label txt_green">Neutral</span>
													@elseif ($data->category == 'Negative')
                                                        <span class="label txt_red">Negative</span>
													@endif
													
                                                    &nbsp; <span class="caret"></span></button>
													
													@if (count($feedbackTags) > 0)
														<ul class="dropdown-menu dropdown-menu-right width-100">
															<li><a class="txt_blue updateFeedbackStatusNew" feedback_id="{{ $data->id }}" fb_status="Positive">Positive</a></li>
															<li><a class="txt_green updateFeedbackStatusNew" feedback_id="{{ $data->id }}" fb_status="Neutral">Neutral</a></li>
															<li><a class="txt_red updateFeedbackStatusNew" feedback_id="{{ $data->id }}" fb_status="Negative">Negative</a></li>
														</ul>
													@endif
                                            </div>
                                        </td>

                                        <td>
                                            <button class="btn btn-xs btn_white_table pr10">
                                                @if ($data->status == 0)
                                                    <i class="icon-primitive-dot txt_red"></i> Disapproved
                                                @else if ($data->status == 2)
                                                    <i class="icon-primitive-dot txt_blue"></i> Pending
                                                @else
                                                    <i class="icon-primitive-dot txt_green"></i> Approved
                                                @endif
                                            </button>
                                        </td>

                                        <td>
                                            <ul class="icons-list">  
                                                <li class="dropdown">
                                                    <button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="{{ base_url() }}admin/feedback/details/{{ $data->id }}" target="_blank"><i class="icon-file-stats "></i> View Details</a></li>

														@if ($canWrite)  
                                                            <li><a href="javascript:void(0);" class="applyInsightTags" action_name="feedback-tag" feedback_id="{{ $data->id }}"><i class="icon-file-stats"></i> Apply Tags</a></li>
														@endif
														
                                                        <li><a class="displayFeedback" fb_tab_type="feedback" feedback_id="{{ $data->id }}" fb_time="{{ date('M d, Y h:i A', strtotime($data->created)) }} ({{ timeAgo($data->created) }})" href="javascript:void(0);" ><i class="icon-file-stats "></i> View</a></li>
														
														@if ($canWrite)
                                                            <li><a class="displayFeedback" fb_tab_type="note" feedback_id="{{ $data->id }}" href="javascript:void(0);" fb_time="{{ date('M d, Y h:i A', strtotime($data->created)) }} ({{ timeAgo($data->created) }})"><i class="icon-pencil7"></i> Add Note</a></li>
														@endif

                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
									@php
								}
							}
							@endphp	
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /dashboard content -->
</div>

<script type="text/javascript">
    $(document).ready(function () {

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
                $('#append-feedback-' + rowId).removeClass('success');
            } else {
                $('#append-feedback-' + rowId).addClass('success');
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

            if (totalCheckboxes == numberOfChecked) {
                $('#checkAll').prop('checked', true);
            }
        });

        $(document).on('click', '#deleteButtonBrandboostFeedbacks', function () {

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
							url: "{{ base_url('admin/feedback/deleteMultipalFeedbackData') }}",
							type: "POST",
							data: {multi_feedback_id: val, _token: '{{csrf_token()}}'},
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

        $(document).on('click', '.editDataList', function () {
            $('.editAction').show();
        });
    });
</script>		