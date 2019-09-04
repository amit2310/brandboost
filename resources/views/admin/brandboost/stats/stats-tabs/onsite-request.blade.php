<div class="tab-pane {{ $requestStatus }}" id="right-icon-tab2">
    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading" style="box-shadow:none;">
                    <h6 class="panel-title">Review Requests</h6>
                    <div class="heading-elements">
                        <div style="display: inline-block; margin: 0;" class="form-group has-feedback has-feedback-left">
                            <input class="form-control input-sm cus_search" placeholder="Search by name" type="text">
                            <div class="form-control-feedback">
                                <i class="icon-search4"></i>
                            </div>
                        </div>&nbsp; &nbsp;

                        <button type="button" class="btn btn-xs btn-default editDataList"><i class="icon-pencil position-left"></i> Edit</button>
                        <button id="deleteCampaignRequest" class="btn btn-xs custom_action_box"><i class="icon-trash position-left"></i> Delete</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datatable-basic datatable-sorting" id="onsiteRequest">
                        <thead>
                            <tr>
                                <th style="display: none;"></th>
                                <th style="display: none;"></th>
                                <th style="display: none;" class="nosort editAction" style="width:30px;"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkAll[]" class="control-primary" id="checkAll" ><span class="custmo_checkmark"></span></label></th>
                                <th><i class="icon-display"></i> Campaign Name</th>
                                <th><i class="icon-user"></i> Contact Name</th>
                                <th><i class="icon-display"></i> Campaign Review</th>
                                <th><i class="fa fa-dot-circle-o"></i> Source</th>
                                <th><i class="icon-calendar"></i> Created</th>
                                <th><i class="icon-calendar"></i> Request Sent Date</th>
                            </tr>
                        </thead>
                        <tbody id="listsubscribers_table">

                            @if (count($oRequest) > 0)
                                @foreach ($oRequest as $data)

                                   @php
                                   
                                        $brandImgArray = unserialize($data->brand_img);
                                        $brand_img = $brandImgArray[0]['media_url'];

                                        if (empty($brand_img)) {
                                            $imgSrc = base_url('assets/images/default_table_img2.png');
                                        } else {
                                            $imgSrc = 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/' . $brand_img;
                                        }
                                    @endphp
                                    <tr id="append-request-{{ $data->trackinglogid }}" class="selectedClass">
                                        <td style="display: none;">{{ date('m/d/Y', strtotime($data->created)) }}</td>
                                        <td style="display: none;">{{ $data->trackinglogid }}</td>
                                        <td style="display: none;" class="editAction"><label class="custmo_checkbox pull-left"><input type="checkbox" name="checkRows[]" class="checkRows" value="{{ $data->trackinglogid }}" id="chk{{ $data->trackinglogid }}"><span class="custmo_checkmark"></span></label></td>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="{{ base_url('admin/brandboost/onsite_setup/' . $data->brandboost_id) }}" class="text-default text-semibold">
                                                    <img src="{{ $imgSrc }}" class="img-circle img-xs br5" alt="Img"></a>
                                            </div>
                                            <div class="media-left">
                                                <div class=""><a href="{{ base_url('admin/brandboost/onsite_setup/' . $data->id) }}" class="text-default text-semibold">{{ $data->brand_title }}</a></div>
                                                <div class="text-muted text-size-small">
                                                    {{ setStringLimit($data->brand_desc) }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>			
                                            <div style="vertical-align: top!important;" class="media-left media-middle">
                                                <a href="#">
                                                    <img src="http://brandboost.io/admin_new/images/userp.png" class="img-circle img-xs" alt="">
                                                </a>
                                            </div>
                                            <div class="media-left">
                                                <a href="javascript:void()" class="text-default text-semibold">{{ $data->firstname }} {{ $data->lastname }}</a>
                                                <div class="text-muted text-size-small">{{ $data->email }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media-left media-middle"> 
                                                <a class="icons square" href="#"><i class="icon-indent-decrease2 txt_blue"></i></a> 
                                            </div>
                                            <div class="media-left">
                                                <div><a href="#" class="text-default text-semibold">{{ $data->subject == '' ? '<span style="color:#999999">No Data</span>' : setStringLimit($data->subject) }}</a></div>
                                                <div class="text-muted text-size-small">{{ setStringLimit($data->name) }}</div>
                                            </div>
                                        </td>
                                        <td>{{ ucfirst($data->tracksubscribertype) }}</td>
                                        <td>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">{{ date('d M Y', strtotime($data->created)) }}</a></div>
                                                <div class="text-muted text-size-small">{{ date('h:i A', strtotime($data->created)) }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media-left">
                                                <div class="pt-5"><a href="#" class="text-default text-semibold">{{ date('d M Y', strtotime($data->requestdate)) }}</a></div>
                                                <div class="text-muted text-size-small">{{ date('h:i A', strtotime($data->requestdate)) }}</div>
                                            </div>
                                        </td>                                       

                                    </tr>
                                @endforeach
                            @endif	
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /dashboard content -->
</div>


<script type="text/javascript">

    $(document).on("click", ".editBrandboost", function () {
        var brandboostID = $(this).attr('brandID');
        $.ajax({
            url: "{{ base_url('admin/brandboost/editOnsite') }}",
            type: "POST",
            data: {'brandboostID': brandboostID},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    window.open("{{ base_url('admin/brandboost/setup/onsite') }}", '_blank');                    
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }
        });
    });

</script>	