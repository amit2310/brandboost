@php
$count=0;
$flag=0;
$unassignedchatlist = getTeamUnAssignDataHelper();
foreach( $unassignedchatlist as $key=>$value)
{
    $token="";
    $token = $value->room;
    $userid = $value->user;
    $userMessage="";
    $chatName = explode(" ",$value->user_name );
    $getlastmessage = getlastChatMessage($token);
    $chatMessageRes = $getlastmessage[0];
    $getlastmessage = $getlastmessage[0];
    $getlastCreated =  $getlastmessage->created;
    $getlastmessage =  $getlastmessage->message;


    $fileext = explode('.', $getlastmessage);
    $fileext = end($fileext);
        if ($fileext == 'png' || $fileext == 'jpg' || $fileext == 'jpeg' || $fileext == 'gif') {
            $userMessage = "File Attachment";
        }
        else if (strpos($getlastmessage, '/Media/') !== false) {
            $userMessage="File Attachment";
        }
        else if (strpos($getlastmessage, 'amazonaws') !== false) {
            $userMessage="File Attachment";
        }
        else {
            $userMessage = setStringLimit($getlastmessage, 80);
        }

@endphp

<div class="tk_{{ $token }} activityShow {{ $count }} media chatbox_new bkg_white
    @if($count == 1)
    {{ 'bbot' }}
    @endif
        " style="
    @if($count > 7)
    {{ "display:block" }}
    @endif
    @if($count == 1)
    {{ 'box-shadow:0 2px 4px 0 rgba(1, 21, 64, 0.06)!important; border-radius:0 0 5px 5px' }}
    @endif
    @if($count==2)
    {{ 'border-radius:5px 5px 5px 5px' }}
    @endif
    ">
    <a href="javascript:void(0);" class="media-link
        @if($count!=1)
    {{ 'bbot' }}
    @endif
        getChatDetails WebBoxList {{ $count == 0 ? '' : '' }}" userId="{{ $value->user }}" RwebId="{{ $token }}">
        <div class="media-left">{!! showUserAvtar($usersdata->avatar, $chatName[0], $chatName[1],28,28,12) !!}
        <!-- <i class="fa fa-star-o star_icon"></i> -->
            <i class="fa star_icon {{ $value->favourite == 1?'fa-star yellow':'fa-star-o' }} favouriteUser"
               userId="{{ $value->id }}"></i>
        </div>

        <div class="media-body">
            <span class="fsize12 txt_dark">{{ $chatName[0] }} {{ $chatName[1] }}</span>
            <span class="slider-phone contacts txt_dark"
                  style="margin:0px; color: #6a7995!important;font-weight:bold; font-size:12px!important">{{ $userMessage }}</span>

        </div>
        <div class="media-right" style="width: 90px"><span class="date_time txt_grey fsize11"><time
                    class="autoTimeUpdate autoTime_{{  $userid }}" datetime="{{ usaDate($getlastCreated) }}"
                    title="{{ usaDate($getlastCreated) }}"></time>

            <span class="read_status_{{ $userid }}">
            @php
                $readStatus = $chatMessageRes->read_status;
                if($readStatus == 1 || $chatMessageRes->user_to == $userid)
                {
                    echo '<i class="fa fa-circle txt_green fsize7"></i>';
                }
                else
                {
                    echo '<i class="fa fa-circle txt_red fsize7"></i>';
                }
            @endphp
            </span>

            </span></div>

    </a>
</div>

@php
    $count++;
}
@endphp

<script>
    $(document).ready(function () {
        $(".autoTimeUpdate").timeago();
    });
</script>

