<div class="tab-pane {{ $allStatus }} show_email_report" id="right-icon-tab1">
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                @include('admin.broadcast.reports.subscriber-data', ['tableId'=>$tableId])
            </div>
        </div>
    </div>
</div>
