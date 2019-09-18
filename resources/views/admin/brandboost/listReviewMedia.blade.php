<!-- *** online image *** -->
<style type="text/css">
    .loading {
        background: transparent url('{{ base_url() }}assets/images/widget_load.gif') center no-repeat;
        background-size: cover;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div style="margin: 0;" class="panel panel-flat">
            <div class="panel-heading">
                <span class="pull-left">
                    <h6 class="panel-title">Images & Video</h6>
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
                        <table class="table datatable-basic-new" id="reviewMediaImage">
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
                                if (!empty($aReviews)) {
                                    $incDel = 1;
                                    foreach ($aReviews as $review) {
                                        $mediaUrl = unserialize($review->media_url);
                                        if (!empty($mediaUrl)) {
                                            foreach ($mediaUrl as $value) {
                                                if (in_array($value['media_url'], $allMediaImagesShow)) {

                                                } else {
                                                    $allMediaImagesShow[] = $value['media_url'];

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

                                                    //$getFileSize = getRemoteFileSize($filePath);
                                                    $getFileSize = '510KB';
                                                    @endphp
                                                    <tr id="append-{{ $review->id . $incDel }}" class="selectedClass">
                                                        <td style="display: none;">{{ date('m/d/Y', strtotime($review->created)) }}</td>
                                                        <td style="display: none;">{{ $review->id }}</td>
                                                        <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="{{ $review->id }}" id="chk{{ $review->id }}"  mediaName="{{ $value['media_url'] }}" delattr="{{ $incDel }}"><span class="custmo_checkmark"></span></label></td>
                                                        <td>
                                                            <div class="small_media_icon" style="position: relative; width: 60px;">

                                                                @php
                                                                $imageUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $value['media_url'];

                                                                if ($value['media_type'] == 'image') {
                                                                    @endphp

                                                                    <img class="media br5 loading" src="{{ $imageUrl }}" alt="">
                                                                    <div class="caption-overflow smallovfl">
                                                                        <a href="{{ $imageUrl }}" data-popup="lightbox"><i class="icon-eye"></i></a>
                                                                    </div>

                                                                    @php
                                                                } else {
                                                                    @endphp
                                                                    <video class="media br5 " height="100%" width="100%">
                                                                        <source class="loading" src="{{ $filePath }}" type="video/{{ $fileExt }}">
                                                                    </video>

                                                                    <div class="caption-overflow smallovfl">
                                                                        <a class="videoReview" style="cursor: pointer;" filepath="{{ $imageUrl }}" fileext="{{ $fileExt }}"><i class="icon-eye"></i></a>
                                                                    </div>

                                                                    @php
                                                                }
                                                                @endphp
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="media-left media-middle"> <a class="icons" style="cursor: text;"><img src="{{ $smilyImage }}" class="img-circle img-xs" alt=""></a> </div>
                                                            <div class="media-left">
                                                                <div class="pt-5"><a style="cursor: text;" class="text-default text-semibold editBrandboost"><span>{{ $review->brand_title }}</span></a> </div>
                                                                <div class="text-muted text-size-small"></div>
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
                                                                <div class="pt-5"><a href="#" class="text-default text-semibold">{{ $review->mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : mobileNoFormat($review->mobile) }}</a></div>
                                                                {{ $review->mobile == '' ? '' : '<div class="text-muted text-size-small">Chat</div>' }}
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

                <div class="tab-pane" id="right-icon-tab111">
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
                                                @php
                                                $allMediaImagesShow = array();
                                                if (!empty($aReviews)) {
                                                    $incDel = 1;
                                                    $incMediaImg = 1;
                                                    foreach ($aReviews as $review) {
                                                        //pre($value->media_url);
                                                        $mediaUrl = unserialize($review->media_url);
                                                        if (!empty($mediaUrl)) {
                                                            //pre($mediaUrl);
                                                            foreach ($mediaUrl as $value) {
                                                                //pre($review);
                                                                $filePath = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $value['media_url'];

                                                                if ($value['media_type'] == 'image') {

                                                                    $mediaImageUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $value['media_url'];
                                                                } else {
                                                                    $mediaImageUrl = base_url('assets/images/media1.jpg');
                                                                }

                                                                if (in_array($value['media_url'], $allMediaImagesShow)) {

                                                                } else {
                                                                    $allMediaImagesShow[] = $value['media_url'];

                                                                    if ($value['media_type'] == 'image') {
                                                                        @endphp

                                                                        <div class="col-lg-3 col-sm-6">
                                                                            <div class="thumbnail">
                                                                                <div class="thumb">
                                                                                    <img src="{{ $mediaImageUrl }}" alt="Images">

                                                                                    <div class="caption-overflow">
                                                                                        <span>
                                                                                            <a href="{{ $mediaImageUrl }}" data-popup="lightbox" class="btn white_btn"><i class="icon-eye txt_purple"></i></a>
                                                                                            <a href="{{ $filePath }}" class="btn white_btn ml-5"><i class="icon-download4 txt_red"></i></a>
                                                                                            <a href="javascript:void()" class="btn white_btn ml-5"><i class="icon-redo2 txt_blue"></i></a>
                                                                                            <a style='cursor: pointer;' class="btn white_btn ml-5 deleteSingleVideo"  reviewId="{{ $review->id }}"  mediaName="{{ $value['media_url'] }}"><i class="icon-bin txt_grey"></i></a>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="caption">
                                                                                    <p>{{ $review->brand_title }}</p>
                                                                                    <p style="word-break: break-all;"></p>
                                                                                    <p class="text-size-small text-muted">{{ date('g:iA d M Y', strtotime($review->created)) }}</p>
                                                                                </div>
                                                                                <div class="caption bot">
                                                                                    <div class="media_details">
                                                                                        <p><strong class="text-size-small">Review </strong> <span><i class="icon-primitive-dot txt_green"></i> {{ $review->ratings }}</span></p>
                                                                                        <p><strong class="text-size-small">Contact </strong> <span>{{ $review->firstname . ' ' . $review->lastname }}</span></p>
                                                                                        <p><strong class="text-size-small">Email </strong> <span>{{ $review->email }}</span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        @php
                                                                        if ($incMediaImg % 4 == 0) {
                                                                            @endphp<div class="clearfix"></div>@php
                                                                        }
                                                                        $incMediaImg++;
                                                                    }
                                                                }
                                                                $incDel++;
                                                            }
                                                        }
                                                    }
                                                }
                                                if ($incMediaImg > 1) {

                                                } else {
                                                    @endphp<div class="text-center"> Image not found.</div>@php
                                                }
                                                @endphp
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden">&nbsp; </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane" id="right-icon-tab121">
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
                                        <div class="imagetab videotabs">
                                            <div class="row">

                                                @php
                                                $allMediaImagesShow = array();
                                                if (!empty($aReviews)) {
                                                    $incDel = 1;
                                                    $incmediaVideo = 1;
                                                    foreach ($aReviews as $review) {
                                                        //pre($value->media_url);
                                                        $mediaUrl = unserialize($review->media_url);
                                                        if (!empty($mediaUrl)) {
                                                            //pre($mediaUrl);
                                                            foreach ($mediaUrl as $value) {
                                                                //pre($review);
                                                                $filePath = 'https://s3-us-west-2.amazonaws.com/brandboost.io/' . $value['media_url'];

                                                                if ($value['media_type'] == 'image') {

                                                                    //$mediaUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/".$value['media_url'];
                                                                } else {
                                                                    $videoImgArr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
                                                                    $rand = rand(0, 19);
                                                                    $mediaUrl = base_url('assets/images/flat/' . $videoImgArr[$rand] . '.png');
                                                                }

                                                                if (in_array($value['media_url'], $allMediaImagesShow)) {

                                                                } else {
                                                                    $allMediaImagesShow[] = $value['media_url'];


                                                                    if ($value['media_type'] != 'image') {
                                                                        $fileExt = pathinfo($value['media_url'], PATHINFO_EXTENSION);
                                                                        @endphp
                                                                        <div class="col-lg-3 col-sm-6">
                                                                            <div class="thumbnail">
                                                                                <div class="thumb">
                                                                                    <video height="220px" width="100%">
                                                                                        <source src="{{ $filePath }}" type="video/{{ $fileExt }}">
                                                                                    </video>

                                                                                    <span class="video_icon">
                                                                                        <a href="{{ $filePath }}" data-popup="lightbox" class="btn white_btn fancybox fancybox.iframe"><i class="icon-menu txt_purple"></i></a>
                                                                                    </span>
                                                                                    <span class="video_icon_bot">
                                                                                        <a href="{{ $filePath }}" data-popup="lightbox" class="btn player_btn fancybox fancybox.iframe"><i class="icon-play4 txt_white"></i></a>
                                                                                    </span>
                                                                                    <div class="caption-overflow">
                                                                                        <span>
                                                                                            <a class="videoReview btn white_btn" style="cursor: pointer;" filepath="{{ $filePath }}" fileext="{{ $fileExt }}"><i class="icon-eye txt_purple"></i></a>
                                                                                            <a href="{{ $filePath }}" class="btn white_btn ml-5"><i class="icon-download4 txt_red"></i></a>
                                                                                            <a href="#" class="btn white_btn ml-5"><i class="icon-redo2 txt_blue"></i></a>
                                                                                            <a style='cursor: pointer;' class="btn white_btn ml-5 deleteSingleVideo"  reviewId="{{ $review->id }}"  mediaName="{{ $value['media_url'] }}"><i class="icon-bin txt_grey"></i></a>
                                                                                        </span>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="caption">
                                                                                    <p>{{ $review->brand_title }}</p>
                                                                                    <p style="word-break: break-all;">{{ $value['media_name'] }}</p>
                                                                                    <p class="text-size-small text-muted">{{ date('g:iA d M Y', strtotime($review->created)) }}</p>
                                                                                </div>
                                                                                <div class="caption bot">
                                                                                    <div class="media_details">
                                                                                        <p><strong class="text-size-small">Review </strong> <span><i class="icon-primitive-dot txt_green"></i> {{ $review->ratings }}</span></p>
                                                                                        <p><strong class="text-size-small">Contact </strong> <span>{{ $review->firstname . ' ' . $review->lastname }}</span></p>
                                                                                        <p><strong class="text-size-small">Email </strong> <span>{{ $review->email }}</span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @php
                                                                        if ($incmediaVideo % 4 == 0) {
                                                                            @endphp<div class="clearfix"></div>@php
                                                                        }
                                                                        $incmediaVideo++;
                                                                    }
                                                                }
                                                                $incDel++;
                                                            }
                                                        }
                                                    }
                                                }

                                                if ($incmediaVideo > 1) {

                                                } else {
                                                    @endphp<div class="text-center">Video not found.</div>@php }
                                                @endphp

                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden">&nbsp; </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="right-icon-tab131">
                    <div class="panel-body p0">
                        <table class="table datatable-basic datatable-sorting">
                            <thead>
                                <tr>
                                    <th style="display: none;"></th>
                                    <th style="display: none;"></th>
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
                                if (!empty($aReviews)) {
                                    $incDel = 1;
                                    foreach ($aReviews as $review) {
                                        $mediaUrl = unserialize($review->media_url);
                                        if (!empty($mediaUrl)) {
                                            foreach ($mediaUrl as $value) {

                                                if (in_array($value['media_url'], $allMediaImagesShow)) {

                                                } else {
                                                    $allMediaImagesShow[] = $value['media_url'];

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

                                                    if ($value['media_url'] != '') {
                                                        $getFileSize = getRemoteFileSize($filePath);
                                                    }

                                                    //if(date('Y-m-d') == date('Y-m-d', $review->created)) {
                                                    @endphp
                                                    <tr id="append-{{ $review->id . $incDel }}" class="selectedClass">
                                                        <td style="display: none;"></td>
                                                        <td style="display: none;"></td>
                                                        <td>
                                                            @php
                                                            $imageUrl = "https://s3-us-west-2.amazonaws.com/brandboost.io/" . $value['media_url'];

                                                            if ($value['media_type'] == 'image') {
                                                                @endphp
                                                                <img src="{{ $imageUrl }}" class="media br5" alt="">
                                                                @php
                                                            } else {
                                                                @endphp

                                                                <video class="media br5" width="100%">
                                                                    <source src="{{ $filePath }}" type="video/{{ $fileExt }}">
                                                                </video>
                                                                <div class="caption-overflow smallovfl">
                                                                    <a class="videoReview" style="cursor: pointer;" filepath="{{ $imageUrl }}" fileext="{{ $fileExt }}"><i class="icon-eye"></i></a>
                                                                </div>
                                                                @php
                                                            }
                                                            @endphp
                                                        </td>
                                                        <td>
                                                            <div class="media-left media-middle"> <a class="icons" style="cursor: text;"><img src="{{ $smilyImage }}" class="img-circle img-xs" alt=""></a> </div>
                                                            <div class="media-left">
                                                                <div class="pt-5"><a style="cursor: text;" class="text-default text-semibold editBrandboost"><span>{{ $review->brand_title }}</span></a> </div>
                                                                <div class="text-muted text-size-small"></div>
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
                                                                <div class="pt-5"><a href="#" class="text-default text-semibold">{{ $review->mobile == '' ? '<span style="color:#999999">Phone Unavailable</span>' : mobileNoFormat($review->mobile) }}</a></div>
                                                                {{ $review->mobile == '' ? '' : '<div class="text-muted text-size-small">Chat</div>' }}
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
                                                    //}
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

<script type="text/javascript">
    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#reviewMediaImage thead tr').clone(true).appendTo('#reviewMediaImage thead');

        $('#reviewMediaImage thead tr:eq(1) th').each(function (i) {

            if (i === 10) {
                var title = $(this).text();
                $(this).html('<input type="text" id="filterBy" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                    }
                });
            }
            if (i === 4) {
                var title = $(this).text();
                $(this).html('<input type="text" id="startRate" placeholder="Search ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (tableBase.column(i).search() !== this.value) {
                        tableBase
                                .column(i)
                                .search(this.value)
                                .draw();
                    }
                });
            }


        });

        $(document).on('click', '.filterByColumn', function () {

            $('.nav-tabs').each(function (i) {
                $(this).children().removeClass('active');
            });
            $(this).parent().addClass('active');
            var fil = $(this).attr('fil');
            $('#filterBy').val(fil);
            $('#filterBy').keyup();

            if (fil.length == 0) {
                $('.heading_links').each(function (i) {
                    $(this).children('a').removeClass('btn btn-xs ml20 btn_white_table');
                });
                $('#startRate').val('');
                $('#startRate').keyup();
                $('.heading_links a:eq(0)').addClass('btn btn-xs ml20 btn_white_table');
                tableBase.draw();
            }
        });

        $(document).on('click', '.top_links_clk', function () {

            $('.heading_links').each(function (i) {
                $(this).children('a').removeClass('btn btn-xs btn_white_table');
            });
            $(this).addClass('btn btn-xs btn_white_table');
            var typ = $(this).attr('startRate');

            if (typ != 'commentLink') {
                $('#startRate').val(typ);
                $('#startRate').keyup();

                if (typ.length == 0) {
                    $('.nav-tabs').each(function (i) {
                        $(this).children().removeClass('active');
                    });
                    $('#filterBy').val('');
                    $('#filterBy').keyup();
                    $('ul.nav-tabs li.all').addClass('active');
                    tableBase.draw();
                }
            } else {
                $('#startRate').val('');
                $('#startRate').keyup();
                tableBase.draw();
            }

        });


        // Basic datatable
        var tableBase = $('#reviewMediaImage')
                .on('order.dt', function () {
                    eventFired();
                })
                .on('search.dt', function () {
                    eventFired();
                })
                .on('page.dt', function () {
                    eventFired();
                })
                .DataTable({
                    'order': [1, "desc"],
                    'aoColumnDefs': [
                        {
                            'bSortable': false,
                            'aTargets': ['nosort']
                        }

                    ],
                    "dom": '<"top"f>rt<"datatable-footer"pil><"clear">',
                    "language": {
                        "info": '<span><span class="text-muted ml10">Showing results</span><span class="txt_black ml10"> _START_ - _END_ of _TOTAL_</span></span>',
                        "lengthMenu": 'View <a style="cursor: pointer;" id="_5" >5</a><a style="cursor: pointer;" id="_10" >10</a><a style="cursor: pointer;" id="_20" >20</a><a style="cursor: pointer;" id="_40" >40</a><a style="cursor: pointer;" id="all" >All</a>'
                    },
                    "orderCellsTop": true,
                    "fixedHeader": true

                });


        /* Custom filtering function which will search data in column four between two values */
        $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    //console.log($('.link').hasClass('btn'));
                    if ($('.link').hasClass('btn')) {
                        //console.log(data[8]);
                        var comment = parseInt(data[8], 0);
                        if (comment > 0) {
                            return true;
                        }
                        return false;
                    } else {
                        return true;
                    }

                }
        );

        $('table#reviewMediaImage thead tr:eq(1)').hide();


        $('#_10').addClass('current');

        $(document).on('click', '#all', function () {

            $('#all').removeClass('current');
            $('#_5').removeClass('current');
            $('#_10').removeClass('current');
            $('#_20').removeClass('current');
            $('#_40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(-1).draw();
        });

        $(document).on('click', '#_5', function () {

            $('#all').removeClass('current');
            $('#_5').removeClass('current');
            $('#_10').removeClass('current');
            $('#_20').removeClass('current');
            $('#_40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(5).draw();
        });

        $(document).on('click', '#_10', function () {

            $('#all').removeClass('current');
            $('#_5').removeClass('current');
            $('#_10').removeClass('current');
            $('#_20').removeClass('current');
            $('#_40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(10).draw();
        });

        $(document).on('click', '#_20', function () {

            $('#all').removeClass('current');
            $('#_5').removeClass('current');
            $('#_10').removeClass('current');
            $('#_20').removeClass('current');
            $('#_40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(20).draw();
        });

        $(document).on('click', '#_40', function () {

            $('#all').removeClass('current');
            $('#_5').removeClass('current');
            $('#_10').removeClass('current');
            $('#_20').removeClass('current');
            $('#_40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(40).draw();
        });


    });

</script>
