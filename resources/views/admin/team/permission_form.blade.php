<p>
@php
	if($selected_permission->count()>0){
		foreach($selected_permission as $selPermission){
			$selectedPermission[] = $selPermission->permission_id;
			$selectedPermissionVal[$selPermission->permission_id] = $selPermission->permission;
		}
	}
	else
	{
		$selectedPermission= array();
	}
@endphp 
     
@foreach($oAvailable_permission as $oPermission)
	<p style="border-bottom: 1px solid #ccc;padding-bottom:10px;">
		<span style="float:left;display:block;">
			<input type="checkbox" class="choosePermission" chkText="{{ $oPermission->title }}" name="permission_id[]" 
			@if(in_array($oPermission->id, $selectedPermission)) checked="checked" @endif value="{{ $oPermission->id }}"  /> 
				{{ $oPermission->title }}
		</span>
		<span style="float:right;display:block;">
			<select name="permission_val_{{ $oPermission->id }}" class="choosePermissionVal" chkText="{{ $oPermission->title }}" >
				<option value="">Choose</option>
				<option value="1" {!! (!empty($selectedPermissionVal[$oPermission->id]) && $selectedPermissionVal[$oPermission->id] == 1) ? 'selected= "selected"': '' !!}>Read</option>
				<option value="2" {!! ( !empty($selectedPermissionVal[$oPermission->id]) &&  $selectedPermissionVal[$oPermission->id] == 2) ? 'selected= "selected"': '' !!}>Read & Write</option>
			</select>
		</span>
		<br>
	</p>
@endforeach
