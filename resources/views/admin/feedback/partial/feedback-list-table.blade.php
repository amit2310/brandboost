@if (count($result) > 0)
	<table class="table" id="offsiteFeedback">
		<thead>
			<tr>
				<th style="display: none;"></th>
				<th style="display: none;"></th>
				<th class="nosort editAction" style="display:none;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
				<th><i class="icon-user"></i>Name</th>
				<th><i class="icon-user"></i>Campaign</th>
				<th><i class="icon-star-full2"></i>Ratings</th>
				<th><i class="icon-paragraph-left3"></i>Feedback</th>
				<th><i class="icon-calendar"></i>Created</th>
				<th><i class="icon-hash"></i>Tags</th>
				<th><i class="icon-folder2"></i>Category</th>
				<th><i class="icon-diff-modified"></i>Status</th>
				<th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
				<th style="display: none;"></th>
				<th class="text-center nosort"><i class="fa fa-dot-circle-o"></i>Action</th>
			</tr>
		</thead>
		<tbody>
			@php
			foreach ($result as $data) {
				$feedbackTags = \App\Models\Admin\TagsModel::getTagsDataByFeedbackID($data->id);
				/*$brandImgArray = unserialize($data->brand_img);
				$brand_img = $brandImgArray[0]['media_url'];

				if (empty($brand_img)) {
					$imgSrc = base_url('assets/images/default_table_img2.png');
				} else {
					$imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
				}*/

				$imgSrc = base_url('assets/images/default_table_img2.png');

				if (!empty($data->avatar)) {
					$avatarImage = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $data->avatar;
				} else {
					$avatarImage = base_url('profile_images/avatar_image.png');
				}
				@endphp
				<tr id="append-feedback-{{ $data->id }}" class="selectedClass">
					<td style="display: none;">{{ date('m/d/Y', strtotime($data->created)) }}</td>
					<td style="display: none;">{{ $data->id }}</td>
					<td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows"  value="{{ $data->id }}" ><span class="custmo_checkmark"></span></label></td>
					<td class="viewSmartPopup" feedbackid="{{ $data->id }}">
						<div class="media-left media-middle"> {!! showUserAvtar($data->avatar, $data->firstname, $data->lastname) !!} </div>
						<div class="media-left">
							@if ($data->firstname != '')
								<div class="pt-5">
									<a href="javascript:void(0);" class="text-default text-semibold">
										<span>{{ $data->firstname }} {{ $data->lastname }}</span>
										<img class="flags" src="{{ base_url() }}assets/images/flags/us.png"/>
									</a>
								</div>
								<div class="text-muted text-size-small">{{ $data->email }}</div>
							@else
								{{ displayNoData() }}
							@endif
						</div>
					</td>
					<td>
						<div class="media-left media-middle">
							<a href="{{ base_url('admin/brandboost/offsite_setup/' . $data->brandboost_id) }}" brandID="{{ $data->brandboost_id }}" b_title="{{ $data->brand_title }}">
								<img src="{{ $imgSrc }}" class="img-circle img-xs br5" alt="Img">
							</a>
						</div>
						<div class="media-left">
							<div class="">
								<a href="{{ base_url('admin/brandboost/offsite_setup/' . $data->brandboost_id) }}" brandID="{{ $data->brandboost_id }}" b_title="{{ $data->brand_title }}" class="text-default text-semibold">
									{{ $data->brand_title }}
								</a>
							</div>
							<div class="text-muted text-size-small">
								{{ setStringLimit($data->brand_desc, 28) }}
							</div>
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
						<a href="{{ base_url('admin/feedback/details/' . $data->id) }}" class="txt_dblack">
							<div class="text-semibold">{!! (!empty($data->title)) ? setStringLimit($data->title, '23') : displayNoData() !!}</div>
							<div class="text-size-small text-muted">
								{!! (!empty($data->feedback)) ? setStringLimit(str_replace(array('  ', '<br>'), array('', ''), strip_tags($data->feedback)), '31') : displayNoData() !!}
							</div>
						</a>
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
						<div class="media-left pl30 blef">
							<div class=""><a href="javascript:void(0);" class="text-default text-semibold bbot">{{ count($feedbackTags) }} Tags</a> </div>
						</div>
						<div class="media-left pr30 brig">
							<div class="tdropdown">
								<button class="btn btn-xs plus_icon dropdown-toggle ml10" data-toggle="dropdown" aria-expanded="false"><i class="icon-plus3"></i></button>
								<ul style="right: 0px!important;" class="dropdown-menu dropdown-menu-right tagss">
									@if (count($feedbackTags) > 0)
										@foreach ($feedbackTags as $oTag)
											<button class="btn btn-xs btn_white_table pr10"> {{ $oTag->tag_name }} </button>
										@endforeach
									@endif
									<button class="btn btn-xs plus_icon ml10 applyInsightTagsFeedback" feedback_id="{{ base64_url_encode($data->id) }}" action_name="feedback-tag"><i class="icon-plus3"></i></button>
								</ul>
							</div>
						</div>
					</td>

					<td>
						<div class="tdropdown">
							@if ($data->category == 'Positive')
								<i class="icon-primitive-dot txt_green fsize16"></i>
							@elseif ($data->category == 'Neutral')
								<i class="icon-primitive-dot txt_grey fsize16"></i>
							@else
								<i class="icon-primitive-dot txt_red fsize16"></i>
							@endif

							<a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
								{{ (!empty($data->category)) ? $data->category : 'Negative' }}
							</a>

							<ul class="dropdown-menu dropdown-menu-right status">
								@if ($data->category == 'Positive')
									<li><a href="javascript:void(0);" feedback_id="{{ $data->id }}" fb_status="Neutral" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_grey"></i> Neutral</a> </li>
									<li><a href="javascript:void(0);" feedback_id="{{ $data->id }}" fb_status="Negative" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_red"></i> Negative</a> </li>
								@elseif ($data->category == 'Neutral')
									<li><a href="javascript:void(0);" feedback_id="{{ $data->id }}" fb_status="Positive" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_green"></i> Positive</a> </li>
									<li><a href="javascript:void(0);" feedback_id="{{ $data->id }}" fb_status="Negative" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_red"></i> Negative</a> </li>
								@else
									<li><a href="javascript:void(0);" feedback_id="{{ $data->id }}" fb_status="Positive" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_green"></i> Positive</a> </li>
									<li><a href="javascript:void(0);" feedback_id="{{ $data->id }}" fb_status="Neutral" class="updateFeedbackStatusNew"><i class="icon-primitive-dot txt_grey"></i> Neutral</a> </li>
								@endif
							</ul>
						</div>
					</td>

					<td>
						<div class="tdropdown">
							@if ($data->status == 0)
								<i class="icon-primitive-dot txt_red fsize16"></i>
							@elseif ($data->status == 2)
								<i class="icon-primitive-dot txt_grey fsize16"></i>
							@else
								<i class="icon-primitive-dot txt_green fsize16"></i>
							@endif
							<a class="text-default text-semibold bbot dropdown-toggle" data-toggle="dropdown">
								@if ($data->status == 0)
									{{ 'Inactive' }}
								@elseif ($data->status == 2) {
									{{ 'Pending' }}
								@else {
									{{ 'Active' }}
								@endif
							</a>
							<ul class="dropdown-menu dropdown-menu-right status">
								@if ($canWrite)
									@if ($data->status == 1)
										<li><a feedback_id='{{ $data->id }}' change_status = '0'  class='chg_status'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>
									@elseif ($data->status == 2)
										<li><a feedback_id='{{ $data->id }}' change_status = '1' class='chg_status'><i class='icon-primitive-dot txt_green'></i> Active</a></li>
										<li><a feedback_id='{{ $data->id }}' change_status = '0'  class='chg_status'><i class='icon-primitive-dot txt_red'></i> Inactive</a></li>
									@else
										<li><a feedback_id='{{ $data->id }}' change_status = '1' class='chg_status'><i class='icon-primitive-dot txt_green'></i> Active</a></li>
									@endif
								@endif
							</ul>
						</div>
					</td>

					<td class="text-center">
						<div class="tdropdown ml10">
							<a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ base_url() }}assets/images/more.svg"></a>
							<ul class="dropdown-menu dropdown-menu-right more_act">
								<a href="javascript:void();" class="dropdown_close">X</a>
								@if ($canWrite)
									@if ($data->status == 1)
										<li><a feedback_id='{{ $data->id }}' change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>
									@elseif ($data->status == 2) {
										<li><a feedback_id='{{ $data->id }}' change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>
										<li><a feedback_id='{{ $data->id }}' change_status = '0' class='chg_status red'><i class='icon-file-locked'></i> Inactive</a></li>
									@else {
										<li><a feedback_id='{{ $data->id }}' change_status = '1' class='chg_status green'><i class='icon-file-locked'></i> Active</a></li>";
									@endif
								@endif

								<li><a target="_blank" href="{{ base_url('admin/feedback/details/' . $data->id) }}"><i class="icon-file-locked"></i> View Details</a></li>
							</ul>
						</div>
					</td>

					<td style="display: none;">
						@if ($data->category == 'Positive')
							{{ 'positive' }}
						@elseif ($data->category == 'Neutral')
							{{ 'neutral' }}
						@elseif ($data->category == 'Negative')
							{{ 'negative' }}
						@endif
					</td>
				</tr>
				@php
				}
			@endphp
		</tbody>
	</table>
@else
    <table class="table datatable-basic">
        <thead>
            <tr>
                <th><i class="icon-user"></i>Name</th>
                <th><i class="icon-user"></i>Campaign</th>
                <th><i class="icon-star-full2"></i>Ratings</th>
                <th><i class="icon-paragraph-left3"></i>Feedback</th>
                <th><i class="icon-calendar"></i>Created</th>
                <th><i class="icon-hash"></i>Tags</th>
                <th><i class="icon-folder2"></i>Category</th>
                <th><i class="icon-diff-modified"></i>Status</th>
                <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>

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
                                Looks Like You Don’t Have Any Feedback Yet <img src="{{ base_url('assets/images/smiley.png') }}"> <br>
                                Lets Create Your First Feedback.
                            </h5>
                        </div>
                    </div>
                </div>
            </td>
            <td style="display: none"></td>
            <td style="display: none"></td>
            <td style="display: none"></td>
            <td style="display: none"></td>
            <td style="display: none"></td>
            <td style="display: none"></td>
        </tbody>
    </table>
@endif
