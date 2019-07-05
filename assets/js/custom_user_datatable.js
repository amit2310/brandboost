function custom_user_data_table(tableId, sortingIndex = null, orderbytype = null) {

        
        if ($.trim(sortingIndex).length > 0) {
            sortingIndex = sortingIndex;
        }
        else {
            sortingIndex = 0;
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
                        "info": '<div class=""><ul class="custom_pagination m0"><li><a style="curder:pointer;">View</a></li><li><a class="number" style="cursor: pointer;" id="_5'+tableId+'">5</a></li><li><a class="number" style="cursor: pointer;" id="_10'+tableId+'">10</a></li><li><a class="number" style="cursor: pointer;" id="_20'+tableId+'">20</a></li><li><a style="cursor: pointer;" class="number" id="all'+tableId+'">All</a></li></ul></div>',
                        "lengthMenu": ''
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
        
        tableBase.page.len(5).draw();
        $('#_5'+tableId).addClass('active');

        $(document).on('click', '#all'+tableId, function () {

            $('#all'+tableId).removeClass('active');
            $('#_5'+tableId).removeClass('active');
            $('#_10'+tableId).removeClass('active');
            $('#_20'+tableId).removeClass('active');
            $('#_40'+tableId).removeClass('active');

            
            tableBase.page.len(-1).draw();
            $('#all'+tableId).addClass('active');
        });

        $(document).on('click', '#_5'+tableId, function () {

            $('#all'+tableId).removeClass('active');
            $('#_5'+tableId).removeClass('active');
            $('#_10'+tableId).removeClass('active');
            $('#_20'+tableId).removeClass('active');
            $('#_40'+tableId).removeClass('active');

            tableBase.page.len(5).draw();
            $('#_5'+tableId).addClass('active');
        });

        $(document).on('click', '#_10'+tableId, function () {

            $('#all'+tableId).removeClass('active');
            $('#_5'+tableId).removeClass('active');
            $('#_10'+tableId).removeClass('active');
            $('#_20'+tableId).removeClass('active');
            $('#_40'+tableId).removeClass('active');

            tableBase.page.len(10).draw();
            $('#_10'+tableId).addClass('active');
        });

        $(document).on('click', '#_20'+tableId, function () {

            $('#all'+tableId).removeClass('active');
            $('#_5'+tableId).removeClass('active');
            $('#_10'+tableId).removeClass('active');
            $('#_20'+tableId).removeClass('active');
            $('#_40'+tableId).removeClass('active');

            tableBase.page.len(20).draw();
            $('#_20'+tableId).addClass('active');
        });

        $(document).on('click', '#_40'+tableId, function () {

            $('#all'+tableId).removeClass('active');
            $('#_5'+tableId).removeClass('active');
            $('#_10'+tableId).removeClass('active');
            $('#_20'+tableId).removeClass('active');
            $('#_40'+tableId).removeClass('active');

            tableBase.page.len(40).draw();
            $('#_40'+tableId).addClass('active');
        });

    /* $(document).on('keyup', '.cus_search', function () {
            var valuenew = $(this).val();
            var tableID = $(this).attr('tableID');
            $('#'+tableID+'_filter input').val(valuenew);
            $('#'+tableID+'_filter input').keyup();
        });*/

        $('table#'+tableId+' thead tr:eq(1)').hide();

        return tableBase;
    }