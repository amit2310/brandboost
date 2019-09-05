<div class="tab-pane {{ $reviews }}" id="right-icon-tab6">

    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title"> {{ count($offSiteReviews) }} Reviews</h6>
                    <div class="heading-elements">
                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                            <div class="form-control-feedback">
                                <i class="icon-search4"></i>
                            </div>
                        </div>&nbsp; &nbsp;
                        <button type="button" class="btn btn-xs btn-default editDataReview"><i class="icon-pencil position-left"></i> Edit</button>
                        <button id="deleteButtonOffsiteReviewBrandboost" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                    </div>
                </div>


                <div class="panel-body p0">          
                    <table class="table datatable-basic datatable-sorting" >
                        <thead>
                            <tr>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th style="display: none;" class="nosort editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" >
                                        <span class="custmo_checkmark"></span></label></th>
                                <th><i class="icon-stack-star"></i>Name</th>
                                <th><i class="icon-star-full2"></i>Rating</th>
                                <th><i class="icon-star-full2"></i>Campaign Review</th>
                                <th><i class="icon-calendar"></i>Created</th>
                                <th><i class="icon-price-tag2"></i>Tags</th>
                                <th><i class="fa fa-dot-circle-o"></i>Status</th>
                                <th class="nosort text-center"><i class="fa fa-dot-circle-o"></i> Action</th>
                            </tr>
                        </thead>
                        <tbody id="review_table">
                            @if (!empty($offSiteReviews)) 
                                @foreach ($offSiteReviews as $oReview) 
                                    <tr id="append-offrev-{{ $oReview->id }}" class="selectedClass-offrev">
                                        <td style="display: none;">{{ date('m/d/Y', $oReview->created) }}</td>
                                        <td style="display: none;">{{ $oReview->id }}</td>
                                        <td style=" display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows-offrev"  value="{{ $oReview->id }}" ><span class="custmo_checkmark"></span></label></td>

                                        <td>
                                            <div class="media-left media-middle"> <a href="#"><img src="{{ $oReview->profile_photo_url }}" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="javascript:void(0);" target="_blank" class="text-default text-semibold"><span>{{ $oReview->name }}</span></a></div>
                                                <div class="text-muted text-size-small">{{ $oReview->source }}</div>
                                            </div>
                                        </td>

                                        <td><div class="media-left media-middle"> <a href="#"><img src="{{ base_url() }}assets/images/smiley_green.png" class="img-circle img-xs" alt=""></a> </div>
                                            <div class="media-left">
                                                <div class=""><a href="#" class="text-default text-semibold">{{ number_format($oReview->ratings, 1) }}</a> </div>
                                                <div class="text-muted text-size-small">Positive</div>
                                            </div>
                                        </td>

                        
                                        <td>{!! setStringLimit($oReview->review_content, 60) !!}</td>

                                        <td>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">{{ date('d M Y', $oReview->created) }}</a></div>
                                                <div class="text-muted text-size-small">{{ date('h:i A', $oReview->created) }}</div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="tdropdown">
                                                <button type="button" class="btn btn-xs btn_white_table dropdown-toggle " data-toggle="dropdown"><i class="icon-hash"></i> {{ count($reviewTags) }} Tags &nbsp; <span class="caret"></span></button>
                                                @if (count($reviewTags) > 0) 
                                                    <ul class="dropdown-menu dropdown-menu-right width-200">
                                                        @foreach ($reviewTags as $tagsData)
                                                        <li>
                                                            <a href="#"><i class="icon-screen-full"></i> {{ $tagsData->tag_name }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>

                                            <a href="javascript:void(0);" class="applyInsightTags btn btn-xs btn_white_table" action_name="review-tag" reviewid="{{ $oReview->id }}" > + </a>

                                        </td> 

                                        <td>
                                            <button class="btn btn-xs btn_white_table pr10">
                                                <i class="icon-primitive-dot txt_green"></i> Approved
                                            </button>
                                        </td>

                                        <td class="text-center">
                                            <div class="tdropdown">
                                                <ul class="icons-list">
                                                    @if ($inc > 5) 
                                                        <li class="dropup">
                                                    @else
                                                        <li class="dropdown">
                                                    @endif
                                                    <button type="button" class="btn btn-xs btn_white_table ml20 dropdown-toggle" data-toggle="dropdown"><i class="icon-more2 txt_blue"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right width-200">
                                                        <li>
                                                            <a href="javascript:void(0);" class="deleteReview" reviewid="{{ $oReview->id }}" ><i class="icon-trash"></i> Delete</a>
                                                        </li>

                                                    </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                    $inc++;
                                    @endphp
                                @endforeach
                            @endif										
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right">
            <a href="javascript:void(0);" id="publishCampaign" class="btn dark_btn mt10" data-brandid="{{ $brandboostID }}">Continue
                <i class=" icon-arrow-right13 text-size-base position-right"></i>
            </a>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#checkAll').change(function () {

            if (false == $(this).prop("checked")) {

                $(".checkRows-offrev").prop('checked', false);
                $(".selectedClass-offrev").removeClass('success');
                $('.custom_action_box').hide();
            } else {

                $(".checkRows-offrev").prop('checked', true);
                $(".selectedClass-offrev").addClass('success');
                $('.custom_action_box').show();
            }

        });

        $(document).on('click', '.checkRows-offrev', function () {
            var inc = 0;


            var rowId = $(this).val();

            if (false == $(this).prop("checked")) {
                $('#append-offrev-' + rowId).removeClass('success');
            } else {
                $('#append-offrev-' + rowId).addClass('success');
            }

            $('.checkRows-offrev:checkbox:checked').each(function (i) {
                inc++;
            });
            if (inc == 0) {

                $('.custom_action_box').hide();
            } else {
                $('.custom_action_box').show();
            }

            var numberOfChecked = $('.checkRows-offrev:checkbox:checked').length;
            var totalCheckboxes = $('.checkRows-offrev:checkbox').length;
            if (totalCheckboxes > numberOfChecked) {
                $('#check-offsite-review').prop('checked', false);
            }

        });

        $(document).on('click', '#deleteButtonOffsiteReviewBrandboost', function () {

            var val = [];
            $('.checkRows-offrev:checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
            if (val.length === 0) {
                alert('Please select a row.')
            } else {

                var elem = $(this);
                swal({
                    title: "Are you sure? You want to delete this record!",
                    text: "You will not be able to recover this record!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#EF5350",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                        function (isConfirm) {
                            if (isConfirm) {
                                $('.overlaynew').show();
                                $.ajax({
                                    url: "{{ base_url('admin/brandboost/delete_multipal_offsite_brandboost_review') }}",
                                    type: "POST",
                                    data: {multi_reviews_id: val},
                                    dataType: "json",
                                    success: function (data) {
                                        if (data.status == 'success') {
                                            $('.overlaynew').hide();
                                            window.location.href = '';
                                        }
                                    }
                                });
                            }
                        });
            }
        });

        $(document).on('click', '.editDataReview', function () {
            $('.editAction').toggle();
        });
    });
</script>




