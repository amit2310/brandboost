	<?php 
	$productsData= array();
	if($brandData->template_style == 1)
	{?>
	@include("store.layer1"); 
	<?php
	}
	else if($brandData->template_style == 2)
	{?>
	@include("store.layer2"); 
	<?php 
	}
	else if($brandData->template_style == 3)
	{ ?>
	@include("store.layer3"); 
	<?php 
	}
	else
	{ ?>
	@include("store.layer1"); 
	<?php
	}

	?>

	<script type="text/javascript">
		
		$(document).ready(function () {
			var myDropzone_ = new Dropzone(	
				"#myDropzone",
				{
					url: '<?php echo base_url("dropzone/upload_s3_attachment_question_review/".$userDetail->id."/questions/"); ?>',
					uploadMultiple: false,
					maxFiles: 10,
					maxFilesize: 600,
					acceptedFiles: 'image/*,video/mp4',
					addRemoveLinks: true,
					removedfile: function(file) {
						var _ref;
						var xmlString = file.xhr.responseText;
						var totalStr = $('#uploadedQuestionFiles').html();
						var res_str = totalStr.replace(xmlString, " ");
						$('#uploadedQuestionFiles').html(res_str);
						var res = xmlString.split("||");
						var dropImage = res[0];
						$.ajax({
			                url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
			                type: "POST",
			                data: {dropImage: dropImage,_token: '{{csrf_token()}}'},
			                dataType: "json",
			                success: function (data) {
			                  
			                }
			            });

			            setTimeout(function() {
			            	return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			            }, 1000);
						
						
					},
					success: function (response) {
						$('#uploadedQuestionFiles').append(response.xhr.responseText);
					}
				});
			
			<?php
				if(count($productsData) > 0 ) {
					foreach($productsData as $productData){ ?>

					Dropzone.autoDiscover = false;
					var myDropzone_ = new Dropzone(	
						'#myDropzone_<?php echo $productData->id; ?>', //id of drop zone element 1
						{
							url: '<?php echo base_url("webchat/dropzone/upload_s3_attachment_product_review/".$userDetail->id."/reviews"); ?><?php echo $productData->id; ?>',
							uploadMultiple: false,
							maxFiles: 10,
							maxFilesize: 600,
							acceptedFiles: 'image/*,video/mp4',
							addRemoveLinks: true,
							removedfile: function(file) {
								var _ref;
								var xmlString = file.xhr.responseText;
								var totalStr = $('#uploadedReviewFiles<?php echo $productData->id; ?>').html();
								var res_str = totalStr.replace(xmlString, " ");
								$('#uploadedReviewFiles<?php echo $productData->id; ?>').html(res_str);
								var res = xmlString.split("||");
								var dropImage = res[0];
								$.ajax({
					                url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
					                type: "POST",
					                data: {dropImage: dropImage,_token: '{{csrf_token()}}'},
					                dataType: "json",
					                success: function (data) {
					                  
					                }
					            });

					            setTimeout(function() {
					            	return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
					            }, 1000);
								
								
							},
							success: function (response) {
								$('#uploadedReviewFiles<?php echo $productData->id; ?>').append(response.xhr.responseText);
							}
						});
					
			<?php } }else{ ?>
				var myDropzone2 = new Dropzone(	
				"#myDropzone2",
				{
					url: '<?php echo base_url("webchat/dropzone/upload_s3_attachment_product_review/".$userDetail->id."/reviews"); ?>',
					uploadMultiple: false,
					maxFiles: 10,
					maxFilesize: 600,
					acceptedFiles: 'image/*,video/mp4',
					addRemoveLinks: true,
					removedfile: function(file) {
						var _ref;
						var xmlString = file.xhr.responseText;
						var totalStr = $('#uploadedReviewFiles').html();
						var res_str = totalStr.replace(xmlString, " ");
						$('#uploadedReviewFiles').html(res_str);
						var res = xmlString.split("||");
						var dropImage = res[0];
						$.ajax({
			                url: '<?php echo base_url('admin/brandboost/DeleteObjectFromS3'); ?>',
			                type: "POST",
			                data: {dropImage: dropImage,_token: '{{csrf_token()}}'},
			                dataType: "json",
			                success: function (data) {
			                  
			                }
			            });

			            setTimeout(function() {
			            	return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			            }, 1000);
						
						
					},
					success: function (response) {
						$('#uploadedReviewFiles').append(response.xhr.responseText);
					}
				});
			<?php } ?>

	});

</script>

