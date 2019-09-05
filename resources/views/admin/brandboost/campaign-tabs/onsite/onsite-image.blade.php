<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="{{ base_url() }}assets/js/pages/gallery.js"></script>
<style type="text/css">
    .thumbnail .thumb img {border-radius: 5px 5px 0 0; height: 220px;}
    .caption-overflow.smallovfl{ color: #333;  width: 60px; line-height: 44px;  }
    .caption-overflow.smallovfl a {    display: block;    height: 44px;    text-align: center; color: #fff; }
    .caption-overflow.smallovfl a i{font-size: 18px;}
    .small_media_icon:hover .caption-overflow.smallovfl{ visibility: visible!important; opacity: 1!important; background: rgba(0,0,0,0.4); border-radius: 5px;}
</style>
@php 
    list($canRead, $canWrite) = fetchPermissions('Onsite Campaign') 
@endphp
<div class="tab-pane {{ $imageClass }}" id="right-icon-tab9">


    <div class="all_media">
        <!-- *** online image *** -->
        <div class="row">
            <div class="col-md-12">
                <div style="margin: 0;" class="panel panel-flat">
                    <div class="panel-heading"> 
                        <span class="pull-left">
                            <h6 class="panel-title"> Images & Video</h6>
                        </span>
                        <div class="heading_links pull-left">
                            <a class="top_links btn btn-xs btn_white_table" href="#right-icon-tab101" data-toggle="tab">All</a>
                            <a class="top_links" href="#right-icon-tab111" data-toggle="tab">Images</a> 
                            <a class="top_links" href="#right-icon-tab121" data-toggle="tab">Videos</a> 
                            <a class="top_links" href="#right-icon-tab131" data-toggle="tab">Media New</a>
                        </div>

                        <div class="heading-elements">
                            <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                                <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                                <div class="form-control-feedback"> <i class="icon-search4"></i> </div>
                            </div>
                            &nbsp; &nbsp;
                            <div class="table_action_tool">
                                <a href="javascript:void();"><i class="icon-calendar2"></i></a>
                                <a style="cursor: pointer;" class="editMediaItem"><i class="icon-pencil4"></i></a>
                                <a style="cursor: pointer; display: none;" style="" id="deleteContactsBtn" class="custom_action_box"><i class="icon-trash position-left"></i></a>
                            </div>

                        </div>
                    </div>
                    <div class="tab-content"> 

                        <div class="tab-pane active" id="right-icon-tab101">
                            <div class="panel-body p0">
                                <table class="table datatable-basic datatable-sorting">
                                    <thead>
                                        <tr>
                                            <th style="display: none;"></th>
                                            <th style="display: none;"></th>
                                            <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                            <th><i class="icon-image2"></i>Media</th>
                                            <th><i class="icon-star-full2"></i>Review Name</th>
                                            <th><i class="icon-user"></i>Contact</th>
                                            <th><i class="icon-iphone"></i>Phone</th>
                                            <th><i class="icon-calendar"></i>Created</th>
                                            <th><i class="icon-file-empty2"></i>File</th>
                                            <th class="text-center nosort sorting_disabled"><i class="fa fa-dot-circle-o"></i>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $allMediaImagesShow = array();
                                        $aReviews = '';
                                        if (!empty($aReviews)) {
                                            $incDel = 1;
                                            foreach ($aReviews as $review) {
                                                $mediaUrl = unserialize($review->media_url);
                                                if (!empty($mediaUrl)) {
                                                    foreach ($mediaUrl as $value) {
                                                        $brandImgArray = unserialize($review->brand_img);
                                                        $brand_img = $brandImgArray[0]['media_url'];
                                                        if (in_array($value['media_url'], $allMediaImagesShow)) {
                                                            
                                                        } else {
                                                            $allMediaImagesShow[] = $value['media_url'];
                                                            if (empty($brand_img)) {
                                                                $imgSrc = base_url('assets/images/default_table_img2.png');
                                                            } else {
                                                                $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $brand_img;
                                                            }

                                                            $smilyImage = smilyRating($review->ratings);

                                                            $filePath = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $value['media_url'];

                                                            $fileExt = pathinfo($value['media_url'], PATHINFO_EXTENSION);

                                                            if ($fileExt == 'mp4') {
                                                                $extFileImage = base_url('assets/images/mp4.png');
                                                            } else if ($fileExt == 'png') {
                                                                $extFileImage = base_url('assets/images/png.png');
                                                            } else if ($fileExt == 'jpg' || $fileExt == 'jpeg') {
                                                                $extFileImage = base_url('assets/images/jpg.png');
                                                            } else {
                                                                $extFileImage = base_url('assets/images/file_blank.png');
                                                            }

                                                            $getFileSize = getRemoteFileSize($filePath);
                                                            
                                                            $imageUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $value['media_url'];
                                                            
                                                            @endphp
                                                            <tr id="append-{{ $review->id . $incDel }}" class="selectedClass">
                                                                <td style="display: none;">{{ date('m/d/Y', strtotime($review->created)) }}</td>
                                                                <td style="display: none;">{{ $review->id }}</td>
                                                                <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="{{ $review->id }}" id="chk{{ $review->id }}"  mediaName="{{ $value['media_url'] }}" delattr="{{ $incDel }}"><span class="custmo_checkmark"></span></label></td>
                                                                <td>
                                                                    @if ($value['media_type'] == 'image') 
                                                                        <div class="small_media_icon" style="position: relative; width: 60px;">
                                                                            <img class="media br5" src="{{ $imageUrl }}" alt="">
                                                                            <div class="caption-overflow smallovfl">
                                                                                <a href="{{ $imageUrl }}" data-popup="lightbox"><i class="icon-eye"></i></a>
                                                                            </div>
                                                                        </div>

                                                                    @else

                                                                        <div class="small_media_icon" style="position: relative; width: 60px;">
                                                                            <video class="media br5" width="100%">
                                                                                <source src="{{ $filePath }}" type="video/{{ $fileExt }}">
                                                                            </video>

                                                                            <div class="caption-overflow smallovfl">
                                                                                <a class="videoReview" style="cursor: pointer;" filepath="{{ $imageUrl }}" fileext="{{ $fileExt }}"><i class="icon-eye"></i></a>
                                                                            </div>
                                                                        </div>

                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="media-left media-middle"> <a class="icons" style="cursor: text;"><img src="{{ $smilyImage }}" class="img-circle img-xs" alt=""></a> </div>
                                                                    <div class="media-left">
                                                                        <div class="pt-5"><a style="cursor: text;" class="text-default text-semibold editBrandboost"><span>{{ $review->brand_title }}</span></a> </div>
                                                                        <div class="text-muted text-size-small">{!! setStringLimit($review->brand_desc) !!}</div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="media-left media-middle"> <a style="cursor: text;">{!! showUserAvtar($review->avatar, $review->firstname, $review->lastname) !!}</a> </div>
                                                                    <div class="media-left">
                                                                        <div class="pt-5"><a style="cursor: text;" class="text-default text-semibold bbot">{{ $review->firstname }} {{ $review->lastname }}</a>
                                                                            <img class="flags" src="{{ base_url() }}assets/images/flags/{{ strtolower($review->country) }}.png" onerror="this.src='{{ base_url('assets/images/flags/us.png') }}'"/></div>
                                                                        <div class="text-muted text-size-small">{{ $review->email }}</div>

                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="media-left">
                                                                        <div class="pt-5"><a href="#" class="text-default text-semibold">{!! $review->mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : mobileNoFormat($review->mobile) !!}</a></div>
                                                                        {!! $review->mobile == '' ? '' : '<div class="text-muted text-size-small">Chat</div>' !!}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="media-left">
                                                                        <div class="pt-5"><a href="#" class="text-default text-semibold">{{ dataFormat($review->created) }}</a></div>
                                                                        <div class="text-muted text-size-small">{{ date('h:i A', strtotime($review->created)) }}</div>
                                                                    </div>
                                                                </td>
                                                                <td><div class="media-left media-middle"> <a class="icons" href="javascript:void(0);"><img src="{{ $extFileImage }}" class="img-xs file" alt=""></a> </div>
                                                                    <div class="media-left">
                                                                        <div class="pt-5"><a href="javascript:void(0);" class="text-default text-semibold">{{ $getFileSize }}</a> </div>
                                                                        <div class="text-muted text-size-small">{{ strtoupper($fileExt) }}</div>
                                                                    </div>
                                                                </td>

                                                                <td class="text-center"> 
                                                                    <div class="tdropdown">
                                                                        <a class="table_more dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><img src="{{ base_url() }}assets/images/more.svg"></a>
                                                                        <ul class="dropdown-menu dropdown-menu-right more_act">
                                                                            <li><a href="{{ $filePath }}" data-popup="lightbox"><i class="icon-eye txt_purple"></i> View</a></li>
                                                                            <li><a href="{{ $filePath }}"><i class="icon-download4 txt_red"></i> Download</a></li>
                                                                            <li><a href="javascript:void(0);"><i class="icon-redo2 txt_blue"></i> Share</a></li>
                                                                            <li><a href="javascript:void(0);" class="deleteSingleVideo" reviewId="{{ $review->id }}"  mediaName="{{ $value['media_url'] }}"><i class="icon-bin txt_grey"></i> Delete</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            @php
                                                        }
                                                        $incDel++;
                                                    }
                                                }
                                            }
                                        }
                                        @endphp
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- *** online image *** -->
    </div>

</div>

<div id="videoReviewShowModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Video review</h5>
            </div>
            <div class="modal-body" id="vReviewShow">
                <video width="100%" controls>
                    <source src="" type="">
                </video>
            </div>
            <!-- <div class="modal-footer modalFooterBtn">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        var media = 0;
        if ($('.changeMedia').parent().hasClass('active')) {

            $('.overlaynew').show();
            var brandboostID = '{{ $brandboostID }}';
            $.ajax({
                url: "/admin/reviews/getReviewMedia",
                type: "POST",
                data: {'brandboostID': brandboostID, _token: '{{csrf_token()}}'},
                dataType: "html",
                success: function (data) {
                    $('.all_media').html(data);
                    $('.datatable-basic').dataTable();
                    media++;

                    setTimeout(function () {
                        $('.overlaynew').hide();
                    }, 3000);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }


        $(document).on('click', '.changeMedia', function () {

            if (media == 0) {
                $('.overlaynew').show();
                var brandboostID = '{{ $brandboostID }}';
                $.ajax({
                    url: "/admin/reviews/getReviewMedia",
                    type: "POST",
                    data: {'brandboostID': brandboostID, _token: '{{csrf_token()}}'},
                    dataType: "html",
                    success: function (data) {
                        $('.all_media').html(data);
                        $('.datatable-basic').dataTable();
                        media++;

                        setTimeout(function () {
                            $('.overlaynew').hide();
                        }, 3000);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        });

        $(document).on('click', '.top_links', function () {
            $('.heading_links').each(function (i) {
                $(this).children('a').removeClass('btn btn-xs btn_white_table');
            });
            $(this).addClass('btn btn-xs btn_white_table');
        });

        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });

        $(document).on('click', '.videoReview', function () {
            var filepath = $(this).attr('filepath');
            var fileext = $(this).attr('fileext');
            $('#vReviewShow video source').attr('src', filepath);
            $('#vReviewShow video source').attr('type', 'video/' + fileext);
            $("#vReviewShow video")[0].load();
            $('#videoReviewShowModal').modal();
        });


        $(document).on('click', '.editMediaItem', function () {
            $('.editAction').toggle();
        });

        // new 
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

        // new 
        $(document).on('click', '.checkRows', function () {
            var inc = 0;
            var rowId = $(this).val();
            var delattr = $(this).attr('delattr');

            if (false == $(this).prop("checked")) {
                //$('#append-' + rowId).removeClass('success');
                $('#append-' + rowId + delattr).removeClass('success');
            } else {
                //$('#append-' + rowId).addClass('success');
                $('#append-' + rowId + delattr).addClass('success');
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

        // New 
        $(document).on('click', '#deleteContactsBtn', function () {

            var val = [];
            var mediaName = [];
            $('.checkRows:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
                mediaName[i] = $(this).attr('mediaName');
            });
            //console.log(mediaName, val);
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
                        "This media will deleted immediately.<br>You can't undo this action.",
                        function () {

                            $('.overlaynew').show();
                            $.ajax({
                                url: "/reviews/deleteReviewMultipal",
                                type: "POST",
                                data: {reviewid: val, mediaName: mediaName, _token: '{{csrf_token()}}'},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        location.reload();
                                    } else {
                                        alert("Having some error.");
                                    }
                                },
                                error: function (error) {
                                    console.log(error);
                                }
                            });
                        });

            }
        });



        $(document).on('click', '.deleteSingleVideo', function () {

            var val = [];
            var mediaName = [];

            val[0] = $(this).attr('reviewId');
            mediaName[0] = $(this).attr('mediaName');
            //console.log(mediaName, val);
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                deleteConfirmationPopup(
                        "This media will deleted immediately.<br>You can't undo this action.",
                        function () {

                            $('.overlaynew').show();
                            $.ajax({
                                url: "/reviews/deleteReviewMultipal",
                                type: "POST",
                                data: {reviewid: val, mediaName: mediaName, _token: '{{csrf_token()}}'},
                                dataType: "json",
                                success: function (data) {
                                    if (data.status == 'success') {
                                        location.reload();
                                    } else {
                                        alert("Having some error.");
                                    }
                                },
                                error: function (error) {
                                    console.log(error);
                                }
                            });
                        });
            }
        });

    });
</script>
