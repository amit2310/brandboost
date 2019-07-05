/* ------------------------------------------------------------------------------
*
*  # Datatable sorting
*
*  Specific JS code additions for datatable_sorting.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Table setup
    // ------------------------------


    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            //console.log(data);
            var startDate = new Date(data[7]);
            if (min == null && max == null) { return true; }
            if (min == null && startDate <= max) { return true;}
            if(max == null && startDate >= min) {return true;}
            if (startDate <= max && startDate >= min) { return true; }
            return false;
        }
    );

   
    $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
    $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });


    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px'
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    var allTable = $('.datatable-sorting').DataTable({
        //order: [3, "desc"]
        order: [0, "desc"],
        aoColumnDefs: [{ "bSortable": false, "aTargets": [ 0 ] }, 
                        { "bSearchable": false, "aTargets": [ 0 ] }]
    });

    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var currentDate = 
        ((''+month).length<2 ? '0' : '') + month + '/' +
        ((''+day).length<2 ? '0' : '') + day+ '/' +d.getFullYear();

    

    $('.daterange-ranges').daterangepicker(
        {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: currentDate,
            //dateLimit: { days: 60 },
            ranges: {   
                'All':[moment().add(1, 'days'), moment()],                            
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            applyClass: 'btn-small bg-slate-600 btn-block',
            cancelClass: 'btn-small btn-default btn-block',
            format: 'MM/DD/YYYY'
        },
        function(start, end) {

            if(start.format('MM/DD/YYYY') > end.format('MM/DD/YYYY')) {

                $('#min').val('');
                $('#max').val('');
                $('.daterange-ranges span').html('Sort by date.');
            }
            else {

                $('#min').val(start.format('MM/DD/YYYY'));
                $('#max').val(end.format('MM/DD/YYYY'));
                $('.daterange-ranges span').html(start.format('MMMM DD YYYY') + ' - ' + end.format('MMMM DD YYYY'));
            }
            
            allTable.draw();
        }
    );

    //$('.daterange-ranges span').html(moment().subtract(29, 'days').format('MMMM DD YYYY') + ' - ' + moment().format('MMMM DD YYYY'));

    $('.daterange-ranges span').html('Sort by date.');


    // Default ordering example
    /*$('.datatable-sorting').DataTable({
        //order: [3, "desc"]
        order: [],
        aoColumnDefs: [{ "bSortable": false, "aTargets": [ 0 ] }, 
                        { "bSearchable": false, "aTargets": [ 0 ] }]
    });*/


    // Multi column ordering
    $('.datatable-multi-sorting').DataTable({
        columnDefs: [{
            targets: [0],
            orderData: [0, 1]
        }, {
            targets: [1],
            orderData: [1, 0]
        }, {
            targets: [4],
            orderData: [4, 0]
        }, {
            orderable: false,
            width: '100px',
            targets: [5]
        }]
    });


    // Complex headers with sorting
    $('.datatable-complex-header').DataTable({
        columnDefs: []
    });


    // Sequence control
    $('.datatable-sequence-control').dataTable( {
        "aoColumns": [
            null,
            null,
            {"orderSequence": ["asc"]},
            {"orderSequence": ["desc", "asc", "asc"]},
            {"orderSequence": ["desc"]},
            null
        ]
    });



    // External table additions
    // ------------------------------

    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    
});
