<!-- Core JS files -->
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/loaders/pace.min') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/core/libraries/jquery.min') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/core/libraries/bootstrap.min') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/loaders/blockui.min') }}"></script>
<!-- /core JS files -->

<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/styling/uniform.min') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/notifications/sweet_alert.min') }}"></script>


<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/tables/datatables/datatables.min') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/pages/datatables_basic') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/core/app') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.slimscroll.min') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/notifications/pnotify.min') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/ui/moment/moment.min') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/pickers/daterangepicker') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/custom_datatable') }}"></script>
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