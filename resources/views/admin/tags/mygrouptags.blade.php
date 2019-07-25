<?php
$previousGroupID = 0;
foreach ($aTag as $oData) {
	$groupID = $oData->id;
	if ($groupID != $previousGroupID):
		?>
		<p style="padding:10px;border-bottom: 1px solid #ccc;"><strong><a href="javascript:void(0);" groupID="<?php echo $oData->id; ?>" class="listTags"><?php echo $oData->group_name; ?></a></strong><div style="text-align:right;width:50px;float:right;margin-top:-40px;"><ul class="icons-list">  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="javascript:void(0);" class="editTagGroup" groupID="<?php echo $oData->id; ?>"><i class="icon-file-stats"></i> Edit</a></li>
						<li><a href="javascript:void(0);" class="deleteTagGroup" groupID="<?php echo $oData->id; ?>"><i class="icon-file-text2"></i> Delete</a></li>


					</ul>
				</li>
			</ul></div></p>
		<?php $previousGroupID = $groupID; ?>       
	<?php endif; ?>    
<?php } ?>