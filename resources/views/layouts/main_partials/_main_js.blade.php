<!-- Core JS files -->
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/core/libraries/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
<!-- /core JS files -->

<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>


<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/pages/datatables_basic.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/notifications/pnotify.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/pickers/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/custom_datatable.js') }}"></script>
<script>
    var redirectURL = '';

    function alertMessage(message) {
        $("#alertMessagePopup").modal();
        $('.message').html(message);
    }

    function alertMessageAndRedirect(message, urlRedirect) {
        $("#alertMessagePopup").modal();
        $('.message').html(message);
        redirectURL = urlRedirect;
        if (redirectURL != '') {
            setTimeout(function () {
                window.location.href = redirectURL;
            }, 1000);
        }
    }

    $(document).ready(function () {
        $(".confirmOk").click(function () {
            $("#alertMessagePopup").modal('hide');
        });
    });


    $(window).scroll(function () {
        var sc = $(window).scrollTop()
        if (sc > 200) {
            $("#header-sroll").addClass("small-header")
        } else {
            $("#header-sroll").removeClass("small-header")
        }
    });

    function smallMenu() {
        if ($(window).width() < 1300) {
            $('body').addClass('sidebar-xs');
        } else {
            $('body').removeClass('sidebar-xs');
        }
    }

    $(document).ready(function () {
        smallMenu();

        window.onresize = function () {
            smallMenu();
        };
    })

    function showTotalRecord(datatableFooterID, showRecordClass) {
        setTimeout(function () {
            var totalNoArray = $('#' + datatableFooterID + ' span .txt_black').text();
            var totalNo = totalNoArray.split('of');
            $('.' + showRecordClass).text(totalNo[1]);
        }, 200);
    }
</script>