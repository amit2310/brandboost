<div class="tab-pane @if($seletedTab=='import') active @endif" id="right-icon-tab5">
    <div class="row"> 
        <div class="col-md-12">
            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Import Data</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p30">
                    <p class="mb-5">Start new Import</p>
                    <p class="text-muted fsize13 mb-20">Import data into Copper from Google Contacts, CSV files, or Excel files.</p>

                    <div class="row">
                        <div class="col-md-3 text-center">
                            <div class="import_box">
                                <div class="img_icon mb20"><a href="javascript:void(0);"><img class="importModuleContact" data-modulename="people" data-moduleaccountid="{{ $oUser->id }}" data-redirect="{{ base_url() }}admin/settings" src="{{ base_url() }}assets/images/contact_icon.png" width="27"></a></div>
                                <p class="mb0">Import Contacts</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="import_box">
                                <div class="img_icon mb20"><img src="{{ base_url() }}assets/images/icon_star.png" width="27"></div>
                                <p class="mb0">Import Reviews</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="import_box">
                                <div class="img_icon mb20"><img src="{{ base_url() }}assets/images/icon_tab.png" width="27"></div>
                                <p class="mb0">Import Tags</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="import_box">
                                <div class="img_icon mb20"><img src="{{ base_url() }}assets/images/icon_media.png" width="27"></div>
                                <p class="mb0">Import  Media</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>					

        <div class="col-md-9">
            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Past Imports</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body p0">
                    <table class="table datatable-basic-new">
                        <tbody>
                           @if(!empty($oImportHistory)): 
								@foreach($oImportHistory as $oHistory)
									<tr>
										<td><div class="media-left media-middle"> <a class="icons br5" href="#"><i class="icon-arrow-down16 txt_purple"></i></a> </div>
											<div class="media-left">
												<div class="pt-5"><a href="#" class="text-default text-semibold">Import {{ $oHistory->import_name }}</a></div>
											</div></td>
										<td class="text-right"><span class="text-muted">{{ date("d M Y  h:iA", strtotime($oHistory->created)) }}</span></td>
										<td class="text-right"><span class="txt_purple">{{ $oHistory->item_count }} Items</span></td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="3" class="text-center">No Record found</td>
								</tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-flat review_ratings">
                <div class="panel-heading">
                    <h6 class="panel-title">Info Card</h6>
                    <div class="heading-elements"><a href="#"><i class="icon-more2"></i></a></div>
                </div>
                <div class="panel-body min_h405 p40 pt60 info_card text-center">
                    <div class="img_icon mb20"><img src="{{ base_url() }}assets/images/bulb.png" width="27"></div>
                    <p class="mb20"><strong>Tips For a Smooth Import</strong></p>
                    <p class="mb20"><span>We recommend using our formatted<br> Excel and CSV templates to ensure your<br> data is formatted properly.</span></p>
                    <a class="txt_purple" href="#">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>