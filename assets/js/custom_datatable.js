function custom_data_table(tableId, sortingIndex = null, orderbytype = null) {

        
        if ($.trim(sortingIndex).length > 0) {
            sortingIndex = sortingIndex;
        }
        else {
            sortingIndex = 1;
        }

        if ($.trim(orderbytype).length > 0) {
            orderbytype = orderbytype;
        }
        else {
            orderbytype = "desc";
        }

        // Basic datatable
        var tableBase = $('#'+tableId)
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
                    'order': [sortingIndex, orderbytype],
                    'aoColumnDefs': [
                        {
                            'bSortable': false,
                            'aTargets': ['nosort']
                        }

                    ],
                    "dom": '<"top"f>rt<"datatable-footer"pil><"clear">',
                    "language": {
                        "info": '<span><span class="text-muted ml10">Showing results</span><span class="txt_black ml10"> _START_ - _END_ of _TOTAL_</span></span>',
                        "lengthMenu": 'View <a style="cursor: pointer;" id="_5'+tableId+'" >5</a><a style="cursor: pointer;" id="_10'+tableId+'" >10</a><a style="cursor: pointer;" id="_20'+tableId+'" >20</a><a style="cursor: pointer;" id="_40'+tableId+'" >40</a><a style="cursor: pointer;" id="all'+tableId+'" >All</a>'
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


        $('#_10'+tableId).addClass('current');

        $(document).on('click', '#all'+tableId, function () {

            $('#all'+tableId).removeClass('current');
            $('#_5'+tableId).removeClass('current');
            $('#_10'+tableId).removeClass('current');
            $('#_20'+tableId).removeClass('current');
            $('#_40'+tableId).removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(-1).draw();
        });

        $(document).on('click', '#_5'+tableId, function () {

            $('#all'+tableId).removeClass('current');
            $('#_5'+tableId).removeClass('current');
            $('#_10'+tableId).removeClass('current');
            $('#_20'+tableId).removeClass('current');
            $('#_40'+tableId).removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(5).draw();
        });

        $(document).on('click', '#_10'+tableId, function () {

            $('#all'+tableId).removeClass('current');
            $('#_5'+tableId).removeClass('current');
            $('#_10'+tableId).removeClass('current');
            $('#_20'+tableId).removeClass('current');
            $('#_40'+tableId).removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(10).draw();
        });

        $(document).on('click', '#_20'+tableId, function () {

            $('#all'+tableId).removeClass('current');
            $('#_5'+tableId).removeClass('current');
            $('#_10'+tableId).removeClass('current');
            $('#_20'+tableId).removeClass('current');
            $('#_40'+tableId).removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(20).draw();
        });

        $(document).on('click', '#_40'+tableId, function () {

            $('#all'+tableId).removeClass('current');
            $('#_5'+tableId).removeClass('current');
            $('#_10'+tableId).removeClass('current');
            $('#_20'+tableId).removeClass('current');
            $('#_40'+tableId).removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(40).draw();
        });

        $(document).on('keyup', '.cus_search', function () {
            var valuenew = $(this).val();
            var tableID = $(this).attr('tableID');
            $('#'+tableID+'_filter input').val(valuenew);
            $('#'+tableID+'_filter input').keyup();
        });

        $('table#'+tableId+' thead tr:eq(1)').hide();

        return tableBase;
    }