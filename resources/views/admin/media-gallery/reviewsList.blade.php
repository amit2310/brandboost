<table class="table datatable-basic-new gallerytable" id="reviewMedia">
	<thead >
		<tr>
			<th><i class="icon-image2"></i> Campaign Name</th>
			<th><i class="icon-image2"></i> Review Title</th>
			<th><i class="icon-image2"></i> User Name</th>
		</tr>
	</thead>
	<tbody>
	@php
	if(!empty($reviewsData)) {
		foreach ($reviewsData as $review) {
			$mediaUrl = unserialize($review->media_url);
			$mediaImageUrl = '';
			if(!empty($mediaUrl)) {
				foreach ($mediaUrl as $value) {
					if($value['media_type'] == 'image')
					{
						$mediaImageUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$value['media_url'];
						break;
					}
				}
			}
			if($mediaImageUrl != ''){
				$brandImgArray = unserialize($review->brand_img);
				$brand_img = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$brandImgArray[0]['media_url'];
				
				$reviewsIdArray = unserialize($galleryData->reviews_id);
				$checkedVal = false;
				if (in_array($review->id, $reviewsIdArray))
				{
					$checkedVal = true;
				}
				@endphp
				<tr>
					<td>
						<div class="media-left media-middle">
							<label class="custmo_checkbox pull-left" style="margin-top:5px;">
								<input type="checkbox" name="reviewsId[]" class="reviewsId" value="{{ $review->id }}" {!! $checkedVal == true ? 'checked' : '' !!} >
								<span class="custmo_checkmark"></span>
							</label> &nbsp; 
							<a class="icons" href="#">
								<img src="{{ $brand_img }}" onerror="this.src='{{ base_url('assets/images/wakerslogo.png') }}'" class="img-circle br5 img-xs" alt="">
							</a> 
						</div>
						<div class="media-left">
							<div class=""><a href="javascript:void(0);" class="text-default text-semibold">{{ $review->brand_title }}</a> </div>
						</div>
					</td>
					<td>
						<div class="media-left media-middle"> <a class="icons" href="#"><img src="{{ $mediaImageUrl }}" onerror="this.src='{{ base_url('assets/images/wakerslogo.png') }}'" class="img-circle br5 img-xs" alt=""></a> </div>
						<div class="media-left">
							<div class=""><a href="javascript:void(0);" class="text-default text-semibold">{{ $review->review_title }}</a><br>
							<div>
								@php
									for ($i = 1; $i <= 5; $i++) {
										if ($i <= $review->ratings) {
											echo '<i class="icon-star-full2 fsize11 txt_yellow"></i> ';
										} else {
											echo '<i class="icon-star-full2 fsize11 txt_grey"></i> ';
										}
									}
								@endphp
							</div>
							</div>
						</div>
					</td>
					<td>{{ $review->firstname.' '.$review->lastname }}</td>
				</tr>
				@php
			}
		}
	}
	@endphp
	</tbody>
</table>