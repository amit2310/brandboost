<div class="col-md-12">
    <a style="left: 35px; top: 15px;" class="reviews smart-broadcast slide-toggle bkg_grey_light" ><i class=""><img src="{{ base_url() }}assets/images/icon_arrow_left.png"/></i></a> 
    <h5 style="padding-left: 75px;" class="panel-title" id="smart-broadcast-title">Exclude Contacts</h5>
</div>

<div class="col-md-12">
    <div class="p30 bbot">
        <h3 class="fsize20 fw500 txt_dark m0">Exclude Contacts</h3>
        <p class="txt_grey m0 fw300">Choose how do you want to import contacts</p>
    </div>
	
    <div class="p30">
        <div class="contact_box">
            <div class="media-left pr10"> <a class="loadAudience icons s32" href="javascript:void(0);" audience-type="contacts" broadcast-id="{{ $broadcastID }}" action-type="exclude"><img class="img-circle img-xs" src="{{ base_url() }}assets/images/red_contact_32.png"></a> </div>
            <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);" class="loadAudience txt_dark" audience-type="contacts" broadcast-id="{{ $broadcastID }}" action-type="exclude"><strong>Contacts</strong></a></p>
                <p class="fsize12 fw300 txt_grey m0">Choose from all available contacts. The list of contacts will be created automatically based on this broadcast.</p>
            </div>
        </div>
        <div class="contact_box">
            <div class="media-left pr10"> <a class="loadAudience icons s32" href="javascript:void(0);" audience-type="lists" broadcast-id="{{ $broadcastID }}" action-type="exclude"><img class="img-circle img-xs" src="{{ base_url() }}assets/images/red_list_32.png"></a> </div>
            <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);" class="loadAudience txt_dark" audience-type="lists" broadcast-id="{{ $broadcastID }}" action-type="exclude"><strong>List</strong></a></p>
                <p class="fsize12 fw300 txt_grey m0">Select one or more of the pre-prepared contact lists. You can create a new list of contacts in the "People" module.</p>
            </div>
        </div>
        <div class="contact_box">
            <div class="media-left pr10"> <a class="loadAudience icons s32" href="javascript:void(0);" audience-type="segments" broadcast-id="{{ $broadcastID }}" action-type="exclude"><img class="img-circle img-xs" src="{{ base_url() }}assets/images/red_segment_32.png"></a> </div>
            <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);" class="loadAudience txt_dark" audience-type="segments" broadcast-id="{{ $broadcastID }}" action-type="exclude"><strong>Segment</strong></a></p>
                <p class="fsize12 fw300 txt_grey m0">Select one or more of the pre-prepared contact segments. You can create a new segment of contacts in the "People" module.</p>
            </div>
        </div>
        <div class="contact_box">
            <div class="media-left pr10"> <a class="loadAudience icons s32" href="javascript:void(0);" audience-type="tags" broadcast-id="{{ $broadcastID }}" action-type="exclude"><img class="img-circle img-xs" src="{{ base_url() }}assets/images/red_tags_32.png"></a> </div>
            <div class="media-left p0"><p class="txt_dark"><a href="javascript:void(0);" class="loadAudience txt_dark" audience-type="tags" broadcast-id="{{ $broadcastID }}" action-type="exclude"><strong>Tags</strong></a></p>
                <p class="fsize12 fw300 txt_grey m0">Select all contacts that match a specific tag or group of tags.</p>
            </div>
        </div>
    </div>
</div>