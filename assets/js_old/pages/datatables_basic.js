/* ------------------------------------------------------------------------------
*
*  # Basic datatables
*
*  Specific JS code additions for datatable_basic.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {


    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '30px'
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': 'Next', 'previous': 'Prev' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
	

    // Basic datatable
   var tableBase = $('.datatable-basic')
	.on( 'order.dt',  function () { eventFired(); } )
	.on( 'search.dt', function () { eventFired(); } )
	.on( 'page.dt',   function () { eventFired(); } )
	.DataTable({
		'order': [1, "desc"],
		'aoColumnDefs': [
			{
				'bSortable': false,
				'aTargets': ['nosort']
			},
			/*{ "width": "30px", "targets": 2 },
			{ "width": "250px", "targets": 3 },
			{ "width": "null", "targets": 4 },
			{ "width": "150px", "targets": 5 },
			{ "width": "160px", "targets": 10 },
			{ "width": "null", "targets": 7 },
			{ "width": "null", "targets": 8 },
			{ "width": "null", "targets": 9 }*/
		],
		//"dom": '<"top">rt<"bottom"pil><"clear">',
		"dom": '<"top"f>rt<"datatable-footer"pil><"clear">',
		"language": {
			"info": '<span><span class="text-muted ml10">Showing results</span><span class="txt_black ml10"> _START_ - _END_ of _TOTAL_</span></span>',
		    "lengthMenu": 'View <a style="cursor: pointer;" id="_5" >5</a><a style="cursor: pointer;" id="_10" >10</a><a style="cursor: pointer;" id="_20" >20</a><a style="cursor: pointer;" id="_40" >40</a><a style="cursor: pointer;" id="all" >All</a>'
		}
	});

	$('#_10').addClass('current');
    //$('.dataTables_info').css('width', '82%');
 
	$(document).on( 'click', '#all', function () {

		    $('#all').removeClass('current');
			$('#_5').removeClass('current');
			$('#_10').removeClass('current');
			$('#_20').removeClass('current');
			$('#_40').removeClass('current');

		/*setTimeout(function(){
			$('#all').addClass('current');
		}, 500);*/
		$(this).addClass('current');
	    tableBase.page.len( -1 ).draw();
	});

	$(document).on( 'click', '#_5', function () {

			$('#all').removeClass('current');
			$('#_5').removeClass('current');
			$('#_10').removeClass('current');
			$('#_20').removeClass('current');
			$('#_40').removeClass('current');

		/*setTimeout(function(){
			$('#_5').addClass('current');
		}, 500);*/
		$(this).addClass('current');
	    tableBase.page.len( 5 ).draw();
	});
	 
	$(document).on( 'click', '#_10', function () {

			$('#all').removeClass('current');
			$('#_5').removeClass('current');
			$('#_10').removeClass('current');
			$('#_20').removeClass('current');
			$('#_40').removeClass('current');

		/*setTimeout(function(){
			$('#_10').addClass('current');
		}, 500);*/
		$(this).addClass('current');
	    tableBase.page.len( 10 ).draw();
	});

	$(document).on( 'click', '#_20', function () {

			$('#all').removeClass('current');
			$('#_5').removeClass('current');
			$('#_10').removeClass('current');
			$('#_20').removeClass('current');
			$('#_40').removeClass('current');

		/*setTimeout(function(){
			$('#_20').addClass('current');
		}, 500);*/
		$(this).addClass('current');
	    tableBase.page.len( 20 ).draw();
	});

	$(document).on( 'click', '#_40', function () {

		    $('#all').removeClass('current');
			$('#_5').removeClass('current');
			$('#_10').removeClass('current');
			$('#_20').removeClass('current');
			$('#_40').removeClass('current');

		/*setTimeout(function(){
			$('#_40').addClass('current');
		}, 500);*/
		$(this).addClass('current');
	    tableBase.page.len( 40 ).draw();
	});


    // Alternative pagination
    $('.datatable-pagination').DataTable({
        pagingType: "simple",
        language: {
            paginate: {'next': 'Next →', 'previous': '← Prev'}
        }
    });


    // Datatable with saving state
    $('.datatable-save-state').DataTable({
        stateSave: true
    });


    // Scrollable datatable
    $('.datatable-scroll-y').DataTable({
        autoWidth: true,
        scrollY: 300
    });



    // External table additions
    // ------------------------------

    // Enable Select2 select for the length option
    /*$('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });*/
    
});

function eventFired(){
	if($('#checkAll').is(":visible")){
		$('#checkAll').prop('checked', false);
		setTimeout(function(){
			$('.editAction').show();
		}, 10);
		
		setTimeout(function(){
			if($('.checkRows').length > 0){
				$('.checkRows').each(function(){
					$(this).prop('checked', false);
					$(this).parent().parent().parent().removeClass('success');
				});
			}
		}, 50);
	}
	
	if($('#checkAllArchive').is(":visible")){
		$('#checkAllArchive').prop('checked', false);
		setTimeout(function(){
			$('.editActionArchive').show();
		}, 10);
		
		setTimeout(function(){
			if($('.checkRowsArchive').length > 0){
				$('.checkRowsArchive').each(function(){
					$(this).prop('checked', false);
					$(this).parent().parent().parent().removeClass('success');
				});
			}
		}, 50);
	}
}
