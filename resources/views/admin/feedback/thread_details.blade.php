<script type="text/javascript" src="{{ base_url() }}assets/js/plugins/editors/summernote/summernote.min.js"></script>

<div class="content">
    <div class="has-detached-left">
        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Marketing campaigns -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="panel-title">Feedback Thread</h6>

                                <div class="heading-elements">
                                    <span class="label bg-success heading-text">{{ count($result) }} Messages</span>
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#"><i class="icon-sync"></i> Update data</a></li>
                                                <li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
                                                <li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top:15px;"><p class="content-group">WYSIHTML55 takes a textarea and transforms it into a rich text editor. The textarea acts as a fallback for unsupported browsers (eg. IE &lt; 8). Make sure the textarea element has an <code>id</code>, so we can later access it easily from javascript. The resulting rich text editor will much behave and look like the textarea since behavior (placeholder, autofocus, ...) and css styles will be copied over.</p></div>
                    </div>
                    <div class="panel-body">
                        <!-- Inner Side bar -->
                        <div class="sidebar-detached">
                            <div class="sidebar sidebar-default">
                                <div class="sidebar-content">
                                    <!-- Actions -->
                                    <div class="sidebar-category">
                                        <div class="category-title">
                                            <span>Actions</span>
                                            <ul class="icons-list">
                                                <li><a href="#" data-action="collapse"></a></li>
                                            </ul>
                                        </div>

                                        <div class="category-content">
                                            <a href="#" class="btn bg-indigo-400 btn-block">Compose mail</a>
                                        </div>
                                    </div>
                                    <!-- /actions -->

                                    <!-- Sub navigation -->
                                    <div class="sidebar-category">
                                        <div class="category-title">
                                            <span>Navigation</span>
                                            <ul class="icons-list">
                                                <li><a href="#" data-action="collapse"></a></li>
                                            </ul>
                                        </div>

                                        <div class="category-content no-padding">
                                            <ul class="navigation navigation-alt navigation-accordion no-padding-bottom">
                                                <li class="navigation-header">Folders</li>
                                                <li class="active"><a href="#"><i class="icon-drawer-in"></i> Inbox <span class="badge badge-success">32</span></a></li>
                                                <li><a href="#"><i class="icon-drawer3"></i> Drafts</a></li>
                                                <li><a href="#"><i class="icon-drawer-out"></i> Sent mail</a></li>
                                                <li><a href="#"><i class="icon-stars"></i> Starred</a></li>
                                                <li class="navigation-divider"></li>
                                                <li><a href="#"><i class="icon-spam"></i> Spam <span class="badge badge-danger">99+</span></a></li>
                                                <li><a href="#"><i class="icon-bin"></i> Trash</a></li>
                                                <li class="navigation-header">Labels</li>
                                                <li><a href="#"><span class="status-mark border-primary position-left"></span> Facebook</a></li>
                                                <li><a href="#"><span class="status-mark border-success position-left"></span> Spotify</a></li>
                                                <li><a href="#"><span class="status-mark border-indigo position-left"></span> Twitter</a></li>
                                                <li><a href="#"><span class="status-mark border-danger position-left"></span> Dribbble</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /sub navigation -->
                                </div>
                            </div>
                        </div>

                        <!-- Content Area -->
                        <div class="container-detached">
                            <div class="content-detached">
                                @php
                                if (!empty($thread_details_data)) {
                                    $i = 0;

                                    foreach ($thread_details_data AS $oRow) {
                                        $i++;
                                        @endphp
                                        <div class="panel panel-white">
                                            <!-- Mail toolbar -->
                                            <div class="panel-toolbar panel-toolbar-inbox">
                                                <div class="navbar navbar-default">
                                                    <ul class="nav navbar-nav visible-xs-block no-border">
                                                        <li>
                                                            <a class="text-center collapsed" data-toggle="collapse" data-target="#inbox-toolbar-toggle-single">
                                                                <i class="icon-circle-down2"></i>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <div class="navbar-collapse collapse" id="inbox-toolbar-toggle-single">
                                                        <div class="btn-group navbar-btn">
                                                            <a href="javascript:void(0);" class="btn btn-default threadreply" thread-id="{{ $i }}"><i class="icon-reply"></i> <span class="hidden-xs position-right">Reply</span></a>
                                                            <a href="#" class="btn btn-default"><i class="icon-bin"></i> <span class="hidden-xs position-right">Delete</span></a>

                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="icon-menu7"></i>
                                                                    <span class="caret"></span>
                                                                </button>

                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li><a href="#">Forward</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="pull-right-lg">
                                                            <p class="navbar-text">{{ date("H:i A- M d, Y", strtotime($oRow->created)) }}</p>
                                                            <div class="btn-group navbar-btn">
                                                                <a href="#" class="btn btn-default"><i class="icon-printer"></i> <span class="hidden-xs position-right">Print</span></a>
                                                                <a href="#" class="btn btn-default"><i class="icon-new-tab2"></i> <span class="hidden-xs position-right">Share</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /mail toolbar -->


                                            <!-- Mail details -->
                                            <div class="media stack-media-on-mobile mail-details-read thread" thread-id="{{ $i }}" style="cursor:pointer;">
                                                <a href="#" class="media-left">
                                                    <span class="btn bg-teal-400 btn-rounded btn-icon btn-xlg">
                                                        <span class="letter-icon">{{ substr($oRow->fname, 0, 1) }}</span>
                                                    </span>
                                                </a>

                                                <div class="media-body">
                                                    <h6 class="media-heading">
														{{ $oRow->fname . ' ' . $oRow->lname }} 
														<a href="#">&lt;{{ $oRow->semail }}&gt;</a>
                                                    </h6>
                                                    <div class="letter-icon-title text-semibold">
														{{ substr(strip_tags($oRow->feedback), 0, 50) }}...
													</div>
                                                </div>

                                                <div class="media-right media-middle text-nowrap">
                                                    <ul class="list-inline list-inline-condensed no-margin">
                                                        <li><a href="#"><img src="assets/images/demo/users/face1.jpg" class="img-circle img-xs" alt=""></a></li>
                                                        <li><a href="#"><img src="assets/images/demo/users/face24.jpg" class="img-circle img-xs" alt=""></a></li>
                                                        <li><a href="#"><img src="assets/images/demo/users/face11.jpg" class="img-circle img-xs" alt=""></a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- /mail details -->


                                            <!-- Mail container -->
                                            <div @if($i > 1) style="display:none;" @endif class="mail-container-read"  id="thread-body-{{ $i }}">
                                                <!-- Email sample (demo) -->
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                                    <tbody>
														<tr>
                                                            <td>
                                                                <!-- Hero -->
                                                                {{ $oRow->feedback }}
                                                                <!-- /hero -->
                                                            </td>
                                                        </tr>
                                                    </tbody>
												</table>
                                                <!-- /email sample (demo) -->
                                            </div>
                                            <!-- /mail container -->


                                            <!-- Reply -->
                                            <div class="mail-attachments-container" style="display:none;" id="thread-reply-{{ $i }}">
                                                <h6 class="mail-attachments-heading">Reply to: {{ $oRow->fname . ' ' . $oRow->lname }} <a>&lt;{{ $oRow->semail }}&gt;</a> </h6>
                                                <textarea rows="10" name="emailtemplate" id="reply-{{ $i }}" class="summernote" required><br><br>{{ ($oRow->direction == 'client') ? $oRow->client_fname . ' ' . $oRow->client_lname :  $oRow->fname . ' ' . $oRow->lname }} wrote on {{ date("M d, Y H:i A", strtotime($oRow->created)) }}:<div style="display:block;border-left:1px solid #ccc;min-height:50px;padding:10px;">{{ $oRow->feedback }}</div>
												</textarea>
												<div class="clearfix"></div>                                                
												<button type="button" class="btn btn-lg btn-success pull-right threadreplynow" style="margin-left:10px;" thread-id="{{ $i }}" client_id="{{ $oRow->client_id }}" subs_id="{{ $oRow->subscriber_id }}" bb_id="{{ $oRow->brandboost_id }}">
												<i class="icon-comment-discussion position-left"></i> Send
												</button>
												<button type="button" class="btn btn-lg btn-danger pull-right cancelthreadreply" thread-id="{{ $i }}" client_id="{{ $oRow->client_id }}" subs_id="{{ $oRow->subscriber_id }}" bb_id="{{ $oRow->brandboost_id }}">
												<i class="icon-comment-discussion position-left"></i> Cancel
												</button>
												<div class="clearfix"></div>
                                            </div>
                                            <!-- /attachments -->
                                        </div>
                                        @php
                                    }
                                }
                                @endphp
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- /marketing campaigns -->
            </div>
        </div>
        <!-- /dashboard content -->
    </div>
</div>
<!-- /content area -->

<script>
    $(document).ready(function () {

        $('.summernote').summernote({
            height: 200
        });
        $(".thread").click(function () {
            var threadid = $(this).attr("thread-id");
            $("#thread-body-" + threadid).toggle("slow");

        });

        $(".threadreply").click(function () {
            var threadid = $(this).attr("thread-id");
            $("#thread-reply-" + threadid).toggle("slow");

        });
        
        $(".cancelthreadreply").click(function(){
            var threadid = $(this).attr("thread-id");
            $("#thread-reply-" + threadid).toggle("slow");
        });
        
        $(".threadreplynow").click(function(){
            $('.overlaynew').show();
            var threadid = $(this).attr("thread-id");
            var clientid = $(this).attr('client_id');
            var subsid = $(this).attr('subs_id');
            var bbid = $(this).attr('bb_id');
            var emaildirectionFrom = 'client';
            var replycontent = $("#reply-"+threadid).val();
            $.ajax({
                url: "{{ base_url('/feedback/threadreply') }}",
                type: "POST",
                data: {bbid:bbid, clid:clientid, subsid:subsid, data:replycontent, direction:emaildirectionFrom, _token: '{{csrf_token()}}'},
                dataType: "json",
                success: function (response) {
                    if (response.status == "success") {
                        $('.overlaynew').hide();
                        alert('reply sent successfully');
                        window.location.href = window.location.href;
                    }
                },
                error: function (response) {
                    alert(response.message);
                }
            });
        });
    });
</script>