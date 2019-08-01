<p>
<?php
if(!empty($selected_permission)){
    foreach($selected_permission as $selPermission){
        $selectedPermission[] = $selPermission->permission_id;
        $selectedPermissionVal[$selPermission->permission_id] = $selPermission->permission;
    }
}

 
     foreach($oAvailable_permission as $oPermission){ ?>
<p style="border-bottom: 1px solid #ccc;padding-bottom:10px;"><span style="float:left;display:block;"><input type="checkbox" class="choosePermission" chkText="<?php echo $oPermission->title; ?>" name="permission_id[]" <?php if(in_array($oPermission->id, $selectedPermission)):?> checked="checked" <?php endif;?> value="<?php echo $oPermission->id;?>"  /> <?php echo $oPermission->title; ?></span>
    <span style="float:right;display:block;">
    <select name="permission_val_<?php echo $oPermission->id;?>" class="choosePermissionVal" chkText="<?php echo $oPermission->title; ?>" >
        <option value="">Choose</option>
        <option value="1" <?php echo ($selectedPermissionVal[$oPermission->id] == 1) ? 'selected= "selected"': '';?>>Read</option>
        <option value="2" <?php echo ($selectedPermissionVal[$oPermission->id] == 2) ? 'selected= "selected"': '';?>>Read & Write</option>
    </select>
    </span>
    <br>
        <?php         
     }
 
?>
</p>

