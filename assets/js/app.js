//! function(e) {
//    "use strict";
//
//    function a() {
//        e(".slimscroll").slimscroll({
//            height: "auto",
//            position: "right",
//            size: "7px",
//            color: "#e0e5f1",
//            opacity: 0.1,
//            wheelStep: 5,
//            touchScrollStep: 50
//        })
//    }
//    a(),
//
//
//		e("#main_menu_side_nav").metisMenu(),
//		e(".button-menu-mobile").on("click", function(t) {
//        t.preventDefault(), e("body").toggleClass("enlarge-menu");
//		t.preventDefault(), e(".main-menu-inner").removeClass("active");
//    	}),
//
//
//
//		//e(window).width() < 1025 ? e("body").addClass("enlarge-menu") : 1 != e("body").data("keep-enlarged") && e("body").removeClass("enlarge-menu"),
//
//
//
//
//
//
//		e(".main-icon-menu .nav-link").on("mouseover", function(t) {
//        t.preventDefault(), e(this).addClass("active"), e(this).siblings().removeClass("active"), e(".main-menu-inner").addClass("active");
//        var a = e(this).attr("href");
//        e(a).addClass("active"), e(a).siblings().removeClass("active")
//        }),
//
//
//		e(".main-icon-menu .nav-link").on("onmouseleave", function(t) {
//        t.preventDefault(), e(".main-menu-inner").removeClass("active");
//        }),
//
//
//
//		$(".mobile-menu-control").click(function(){
//		  $(".left-sidenav").slideToggle();
//		});
//
//
//
//
//
//
//		Waves.init()
//}(jQuery);






$(".slimScrollBar").hide();





! function(e) {
    "use strict";

    function a() {
        e(".slimscroll").slimscroll({
            height: "auto",
            position: "right",
            size: "7px",
            color: "#e0e5f1",
            opacity: 0,
            wheelStep: 5,
            touchScrollStep: 50
        })
    }
    a(), e("#main_menu_side_nav").metisMenu(), e(".button-menu-mobile-new").on("click", function(t) {
        t.preventDefault(), e("body").toggleClass("enlarge-menu"), a()
    }), e(window).width() < 1025 ? e("body").addClass("enlarge-menu") : 1 != e("body").data("keep-enlarged") && e("body").removeClass("enlarge-menu"), e(".search-btn").on("click", function() {
        var t = e(this).data("target");
        t && e(t).toggleClass("open")
    }), e(".main-icon-menu .nav-link").on("click", function(t) {


        //t.preventDefault(), e("body").toggleClass("enlarge-menu"),


        t.preventDefault(), e(this).addClass("active"), e(this).siblings().removeClass("active"), e(".main-menu-inner").addClass("active");
        var a = e(this).attr("href");
        e(a).addClass("active"), e(a).siblings().removeClass("active")


    }), e.fn.tooltip && e('[data-toggle="tooltip"]').tooltip(), e('[data-toggle="tooltip-custom"]').tooltip({
        template: '<div class="tooltip tooltip-custom" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
    }), e(".left-sidenav a").each(function() {
        var t = window.location.href.split(/[?#]/)[0];
        if (this.href == t) {
            e(this).addClass("active"), e(this).parent().parent().addClass("in"), e(this).parent().parent().addClass("mm-show"), e(this).parent().parent().prev().addClass("active"), e(this).parent().parent().parent().addClass("active"), e(this).parent().parent().parent().addClass("mm-active"), e(this).parent().parent().parent().parent().addClass("in"), e(this).parent().parent().parent().parent().parent().addClass("active"), e(this).parent().parent().parent().parent().parent().parent().addClass("active");
            var a = e(this).closest(".main-icon-menu-pane").attr("id");
            e("a[href='#" + a + "']").addClass("active");
        }
    }),

        $(".mobile-menu-control").click(function(){
            $(".left-sidenav").slideToggle();
        });


    Waves.init()
}(jQuery);







$(document).ready(function(){
    $('[data-toggle="tooltip-custom"]').click(function () {
        $('[data-toggle="tooltip-custom"]').tooltip("hide");
    });
});



$(document).ready(function(){
    $(".chatboxopen").click(function(){
        $(".rightchatarea").animate({
            width: "toggle"
        });
    });
});


$(document).ready(function(){
    $(".show_emoji_small").click(function(){
        $(".chat_emoji_box_small").toggle();
    });
});

$(document).ready(function(){
    $(".show_saved_chat_small").click(function(){
        $(".chat_saved_temp_small").toggle();
    });
});

$(document).ready(function(){
    $(document).on("click", ".search_tables_open_close", function(){
        $(".datasearcharea").animate({
            width: "toggle"
        });
        $('#InputToFocus').focus();
    });
});


$(document).ready(function(){
    $(document).on("click", ".close_sidebar", function(){
        $(".page_sidebar").animate({
            width: "toggle"
        });
    });
});

$(document).ready(function(){
    // wf  top navigation fixed on scroll
    $( window ).scroll( function () {
        var sc = $( window ).scrollTop();
        if ( sc > 100 ) {
            $( "#wf_top_bar" ).addClass( "wf_top_area_fixed" );
        } else {
            $( "#wf_top_bar" ).removeClass( "wf_top_area_fixed" );
        }
    } );

    // wf  top navigation fixed on scroll
    $( window ).scroll( function () {
        var sc = $( window ).scrollTop();
        if ( sc > 100 ) {
            $( "#wf_top_btn_area" ).addClass( "wf_button_fixed" );
        } else {
            $( "#wf_top_btn_area" ).removeClass( "wf_button_fixed" );
        }
    } );

    $(document).on("click", ".slideAddNodebox", function(){
        $(".addNodeBoxContent").animate({
            width: "toggle"
        });
    });

    $(document).on("click", ".slideAddActionbox", function(){
        $(".addActionBoxContent").animate({
            width: "toggle"
        });
    });

    $(document).on("click", ".slideAddDecisionbox", function(){
        $(".addDecisionBoxContent").animate({
            width: "toggle"
        });
    });

    $(document).on("click", ".slideAddDelaybox", function(){
        $(".addDelayBoxContent").animate({
            width: "toggle"
        });
    });

    $(document).on("click", ".slideAddSplitbox", function(){
        $(".addSplitBoxContent").animate({
            width: "toggle"
        });
    });

    $(document).on("click", ".slideTriggerbox", function(){
        $(".triggerBoxContent").animate({
            width: "toggle"
        });
    });

    $(document).on("click", ".slideGoalbox", function(){
        $(".goalBoxContent").animate({
            width: "toggle"
        });
    });

    $(document).on('dragend', function(){
        let elems = document.querySelectorAll(".droppable_grid");
        elems.forEach(function(elem){
            elem.classList.remove('droppable_highlight');
        })
    });
});
function triggerSlider(){
    var slider = new Slider('#ex1', {
        formatter: function (value) {
            return 'Current value: ' + value;
        }
    });
}

function parseNotificationMessage(type, message){
    var selector = '';
    if(type == 'success'){
        selector = '.Successfullysaved2';
    }else if(type == 'error'){
        selector = '.Successfullysaved4';
    }
    if(selector != ''){
        var notice = new PNotify({
            text: $(selector).html().replace('__message__', message),
            width: '400px',
            hide: true,
            buttons: {
                closer: false,
                sticker: false
            },
            insert_brs: false
        });
        notice.get().find('a[name=cancel]').on('click', function() {
            notice.remove();
        })
    }

}
