function customtable(tableName) {

	// Basic datatable
        var tableBase = $(tableName)
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
                        "lengthMenu": 'View <a style="cursor: pointer;" class="_5" >5</a><a style="cursor: pointer;" class="_10" >10</a><a style="cursor: pointer;" class="_20" >20</a><a style="cursor: pointer;" class="_40" >40</a><a style="cursor: pointer;" class="all" >All</a>'
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

        setTimeout(function() {
        	//$('._10').addClass('current');
        	$('._10').trigger('click');
        }, 3000);
        
        $(document).on('click', '.all', function () {

            $('.all').removeClass('current');
            $('._5').removeClass('current');
            $('._10').removeClass('current');
            $('._20').removeClass('current');
            $('._40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(-1).draw();
        });

        $(document).on('click', '._5', function () {

            $('.all').removeClass('current');
            $('._5').removeClass('current');
            $('._10').removeClass('current');
            $('._20').removeClass('current');
            $('._40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(5).draw();
        });

        $(document).on('click', '._10', function () {

            $('.all').removeClass('current');
            $('._5').removeClass('current');
            $('._10').removeClass('current');
            $('._20').removeClass('current');
            $('._40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(10).draw();
        });

        $(document).on('click', '._20', function () {

            $('.all').removeClass('current');
            $('._5').removeClass('current');
            $('._10').removeClass('current');
            $('._20').removeClass('current');
            $('._40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(20).draw();
        });

        $(document).on('click', '._40', function () {

            $('.all').removeClass('current');
            $('._5').removeClass('current');
            $('._10').removeClass('current');
            $('._20').removeClass('current');
            $('._40').removeClass('current');

            $(this).addClass('current');
            tableBase.page.len(40).draw();
        });

}


