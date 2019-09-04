<div class="content offsite_feed">
    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-12">
            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="table-responsive">
                    <table class="table datatable-sorting text-nowrap">
                        <thead>
                            <tr>
                                <th class="col-md-2">Sent</th>
                                <th class="col-md-2">Delivered</th>
                                <th class="col-md-2">Open</th>
                                <th class="col-md-2">Click</th>
                                <th class="col-md-2">Bounce</th>
                                <th class="col-md-2">Dropped</th>
                                <th class="col-md-2">Unsubscribe</th>
                                <th class="col-md-2">Spam Report</th>

                            </tr>
                        </thead>
                        <tbody id="listsubscribers_table">

                            @if (!empty($aData))
                                <tr>
                                    <td class="">
                                        {{ $aData['processed']['TotalCount'] }}
                                    </td>

                                    <td class="">
                                        {{ $aData['delivered']['TotalCount'] }}
                                    </td>

                                    <td class="">
                                        Total: {{ $aData['open']['TotalCount'] }}<br>
                                        Unique: {{ $aData['open']['UniqueCount'] }}<br>
                                        Duplicate: {{ $aData['open']['DuplicateCount'] }}
                                    </td>

                                    <td class="">
                                        Total: {{ $aData['click']['TotalCount'] }}<br>
                                        Unique: {{ $aData['click']['UniqueCount'] }}<br>
                                        Duplicate: {{ $aData['click']['DuplicateCount'] }}
                                    </td>

                                    <td class="">
                                        Total: {{ $aData['bounce']['TotalCount'] }}<br>

                                    </td>

                                    <td class="">
                                        Total: {{ $aData['dropped']['TotalCount'] }}<br>

                                    </td>

                                    <td class="">
                                        Total: {{ $aData['unsubscribe']['TotalCount'] }}<br>

                                    </td>

                                    <td class="">
                                        Total: {{ $aData['spam_report']['TotalCount'] }}<br>

                                    </td>

                                </tr>
                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
            <div align="right" id="pagination_link"></div>
            <!-- /marketing campaigns -->
        </div>
    </div>
    <!-- /dashboard content -->

</div>
<!-- /content area -->






</div>
