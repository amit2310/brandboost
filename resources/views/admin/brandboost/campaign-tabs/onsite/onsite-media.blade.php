<?php list($canRead, $canWrite) = fetchPermissions('Onsite Campaign'); 
$imageClass="";
?>
<div class="tab-pane <?php echo $imageClass; ?>" id="right-icon-tab9">
<div class="row">
						  <div class="col-md-12">
							<div class="panel panel-flat">
							  <div class="panel-heading"> <span class="pull-left">
								  <h6 class="panel-title">Images</h6>
								  </span>
								  
								  <div class="heading-elements">
									<div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
									  <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
									  <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
									</div>
									<!-- &nbsp; &nbsp;
									<button type="button" class="btn btn-xs btn-default"><i class="icon-pencil position-left"></i> Edit</button> -->
								  </div>
								</div>
							  
							  <div class="panel-body gallerytabtable p0">
							  <table class="table datatable-basic gallerytable">
							  <thead style="display: none;">
								<tr>
								  <th><i class="icon-image2"></i>Media</th>
								  <th><i class="icon-image2"></i>&nbsp; </th>
								</tr>
							  </thead>
							  <tbody>
								<tr>
								  <td>
								  	<div class="imagetab">
              	  <div class="row">


              	  	<?php
	$allMediaImagesShow = array();
	//pre($aReviews);
	if(!empty($aReviews)) {
	$incDel = 1;
	foreach ($aReviews as $review) {
	//pre($value->media_url);
	$mediaUrl = unserialize($review->media_url);
	if(!empty($mediaUrl)) {
		//pre($mediaUrl);
		foreach ($mediaUrl as $value) {
			//pre($review);
			$filePath = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$value['media_url'];

			$fileExt = pathinfo($value['media_url'], PATHINFO_EXTENSION);

			if($fileExt == 'mp4') {
				$extFileImage = base_url('assets/images/mp4.png');
			}
			else if($fileExt == 'png') {
				$extFileImage = base_url('assets/images/png.png');
			}
			else if($fileExt == 'jpg' || $fileExt == 'jpeg') {
				$extFileImage = base_url('assets/images/jpg.png');
			}
			else {
				$extFileImage = base_url('assets/images/file_blank.png');
			}

			$ch = curl_init($filePath);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, TRUE);
			curl_setopt($ch, CURLOPT_NOBODY, TRUE);
			$data = curl_exec($ch);
			$fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
			curl_close($ch);
			$getFileSize = FileSizeConvert($fileSize);

			if($value['media_type'] == 'image')
			{
			
				$mediaImageUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/".$value['media_url'];
			
			}
			else
			{
				$mediaImageUrl = base_url('assets/images/media1.jpg');
			}
			
			$brandImgArray = unserialize($review->brand_img);
			$brand_img = $brandImgArray[0]['media_url'];
			
			
			
			if (in_array($value['media_url'], $allMediaImagesShow))
			{
				
			}
			else
			{
				$allMediaImagesShow[] = $value['media_url'];
				
				
				
				if (empty($brand_img)) {
					$imgSrc = base_url('assets/images/default_table_img2.png');
					} else {
					$imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
				}
				//if($value['media_type'] == 'image')
				//{
			?>

						<div class="col-lg-3 col-sm-6">
							<div class="thumbnail">
								<div class="thumb">
									<img src="<?php echo $mediaImageUrl; ?>" alt="Images">
												                        
									<div class="caption-overflow">
										<span>
											<a href="<?php echo $mediaImageUrl; ?>" data-popup="lightbox" class="btn white_btn"><i class="icon-eye txt_purple"></i></a>
											<a href="<?php echo $filePath; ?>" class="btn white_btn ml-5"><i class="icon-download4 txt_red"></i></a>
											<a href="#" class="btn white_btn ml-5"><i class="icon-redo2 txt_blue"></i></a>
											<a style='cursor: pointer;' class="btn white_btn ml-5 deleteSingleVideo"  reviewId="<?php echo $review->id; ?>"  mediaName="<?php echo $value['media_url']; ?>"><i class="icon-bin txt_grey"></i></a>
										</span>
									</div>
								</div>
								<div class="caption">
								   <p><?php echo $review->brand_title; ?></p>
								   <p class="text-size-small text-muted"><?php echo date('g:iA d M Y', strtotime($review->created)); ?></p>
								</div>
								<div class="caption bot">
									<div class="media_details">
									<p><strong class="text-size-small">Review </strong> <span><i class="icon-primitive-dot txt_green"></i> <?php echo $review->ratings; ?></span></p>
									<p><strong class="text-size-small">Contact </strong> <span><?php echo $review->firstname.' '.$review->lastname; ?></span></p>
									<p><strong class="text-size-small">Email </strong> <span><?php echo $review->email; ?></span></p>
									</div>
								</div>
							</div>
						</div>

						 <?php
						//}
						}
						$incDel++;
					}
				}
			}
		}
	?>

					</div>
			
              </div>
								  </td>
								  <td class="hidden">&nbsp; </td>
								</tr>
							  </tbody>
							</table>
							  </div>
							  
							  
							  
							</div>
						  </div>
						</div>
						</div>
