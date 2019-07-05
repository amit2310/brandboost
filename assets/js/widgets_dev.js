BB = function (t) {
    function t(e, o) {
        this.userSettings = o;
        this.userbbkey = e;
        v.call(this)
    }

    function v() {
        var e = this.userSettings.host + "/assets/css/widget_style.css";
        var a = document.getElementsByTagName("head")[0];
        l = document.createElement("link");
        l.type = "text/css";
        l.rel = "stylesheet";
        l.href = e;
        a.appendChild(l);
    }

    function h(e) {
        //alert(e);
        var o = [];
        try {
            o = JSON.parse(e);
            for (var n = -1, i = 0; i < o.length; i++)
                if ("list" == o[i].method) {
                    n = i;
                    if (this.userSettings.popup_widget === true) {
                        document.getElementsByClassName("bb main-widget")[0].innerHTML = o[n].popup_result;
                    }

                    if (this.userSettings.testimonial_widget === true) {
                        //alert('Hi');
                        document.getElementsByClassName("bb testimonials-widget")[0].innerHTML = o[n].testimonial_result;

                        var x = document.getElementsByClassName("bb_slides_inner")[0];
                        var ts = x.getAttribute("bb_total_slides");
                        var o = u(x.clientWidth) + 1;
                        //        n = ts < o ? 0 : o;
                        n = 1;
                        this.slider = new t.Modules.Slide(x, {
                            imageCount: ts,
                            displayWindowCount: 3,
                            initialPosition: n,
                            slideDirection: 'right',
                            delayInterval: '3000',
                            autoSlide: 1,
                            rtl: 1,
                            animationDuration: '2800'
                        });

                        this.slider.start();
                    }

                    if (this.userSettings.inline_widget === true) {
                        document.getElementsByClassName("bb_txt_review")[0].innerHTML = o[n].inline_result;
                    }

                    break
                }
        } catch (r) {
            t.safeConsole(r.message)
        }

    }

    t.prototype.hola = function () {
        alert('called, hola amigo');
    }

    t.prototype.p_widget = function () {
        if (this.userSettings.popup_widget === true) {
            var t = document.createElement("div");
            t.className = "bb main-widget";
            document.body.appendChild(t);
        }

        if (this.userSettings.testimonial_widget === true) {
            var t = document.createElement("div");
            t.className = "bb testimonials-widget";
            document.body.appendChild(t);
        }

        if (this.userSettings.inline_widget === true) {
            var t = document.createElement("div");
            t.className = "bb_txt_review";
            document.body.appendChild(t);
        }

    }

    t.prototype.g_reviews = function () {
        var e = this;
        var bb_key = this.userbbkey;
        var bbsrc = this.userSettings.host + "/reviews/displayreivew/" + bb_key;
        var a = {};
        //i = call back function
        //a = POST data
        var i = function (o) {
            //Display Json on browser
            h.call(e, o), e.trigger("ready"), f.call(e);
        };
        t.ajax(bbsrc, i, 'POST', a);
    }

    t.prototype.a_helpful = function (e) {
        var c = this;
        var ac = e.getAttribute("action-name");
        var rid = e.getAttribute("bb-review-id");
        var cc = e.getAttribute("class");
        var allclasses = cc.split(" ");
        a = 'bbrid=' + rid + '&ha=' + ac;
        var bbsrc = this.userSettings.host + "/reviews/saveHelpful/";
        var i = function (o) {
            var rsp = JSON.parse(o);

            if (c.userSettings.popup_widget === true && allclasses.indexOf("helpful-action") > -1) {
                document.getElementById("bbhelpfulcount").innerHTML = rsp.yes;
            }

            if (c.userSettings.inline_widget === true && allclasses.indexOf("bb-inline-helpful") > -1) {
                e.innerHTML = ' ' + rsp.yes;
            }

        }

        t.ajax(bbsrc, i, 'POST', a);
    }

    t.prototype.a_comment = function (e) {
        var ac = e.getAttribute("action-name");
        var rid = e.getAttribute("bb-review-id");
        a = 'bbrid=' + rid + '&ha=' + ac;
        var bbsrc = this.userSettings.host + "/reviews/saveHelpful/";
        var i = function (o) {
            var rsp = JSON.parse(o);
            document.getElementById("bbhelpfulcount").innerHTML = rsp.yes;
        }
        t.ajax(bbsrc, i, 'POST', a);

    }

    t.prototype.d_comment = function () {
        var s = document.getElementsByClassName('cmt-ctr');
        for (r = 0; r < s.length; ++r) {
            t.show(s[r]);
        }

    }

    t.prototype.s_comment = function () {
        var cmttxt = document.getElementById("bbcmt").value;
        var fullname = document.getElementById("bbcmtname").value;
        var emailadd = document.getElementById("bbcmtemail").value;
        var rid = document.getElementById("bb-review-id").value;
        a = 'bbrid=' + rid + '&bbcmtname=' + fullname + '&bbcmtemail=' + emailadd + '&bbcmt=' + cmttxt;
        var bbsrc = this.userSettings.host + "/reviews/addcomment/";
        var i = function (o) {
            var rsp = JSON.parse(o);
            if (rsp.status == 'ok') {
                var s = document.getElementsByClassName('bb-popup-cmt-alert-success-msg')[0];
                var err = document.getElementsByClassName('bb-popup-cmt-alert-error-msg')[0];
                t.show(s);
                t.hide(err);
            }

        }
        t.ajax(bbsrc, i, 'POST', a);

    }

    function f() {
        var e = this,
                o = document.getElementsByClassName("bb-loaded")[0];
        if ("undefined" == typeof o) {
            setTimeout(function () {
                f.call(e)
            }, 50);
        } else {
            if (this.userSettings.popup_widget === true) {
                e.b_event('click', 'shortreview', 'popup-toggle-slide');
                e.b_event('click', 'fullreview', 'save_helpful');
                e.b_event('blur', 'bbcmt', 'display_comment_form');
                e.b_event('click', 'bbcmtsubmit', 'save_comment');
            }

            if (this.userSettings.testimonial_widget === true) {
                e.b_event('click', 'bb_slides_btn', 'move_slider');
            }

            if (this.userSettings.inline_widget === true) {
                e.b_event('click', 'bb_txt_inner', 'save_inline_helpful');
            }

        }

    }
    
    function u(t) {
        var e;
        return t >= 960 ? e = 3 : t >= 600 && 960 > t ? e = 2 : 600 > t && (e = 1), e
    }
    
    t.prototype.popup_toggle_slide = function () {
        var i = document.getElementsByClassName('fullreview')[0];
        t.toggleVisibility(i);

    };

    t.prototype.b_event = function (ev, c, an) {
        var e = this;
        var i = document.getElementsByClassName(c)[0];
        var j = document.getElementsByClassName(c)[1];
        if (ev == 'click') {
            if (an == 'save_helpful') {
                var s = i.getElementsByClassName("helpful-action");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.a_helpful(this);
                    });

                }

            } else if (an == 'save_comment') {

                i.addEventListener('click', function () {
                    e.s_comment(this);
                });
            } else if (an == 'popup-toggle-slide') {
                i.addEventListener('click', function () {
                    e.popup_toggle_slide(this);
                });

                j.addEventListener('click', function () {
                    e.popup_toggle_slide(this);
                });

            } else if (an == 'move_slider') {
                i.addEventListener('click', function () {
                    e.move_review_slider(this);

                });

                j.addEventListener('click', function () {
                    e.move_review_slider(this);

                });
            } else if (an == 'save_inline_helpful') {
                var s = i.getElementsByClassName("bb-inline-helpful");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.a_helpful(this);

                    });

                }
            }

        } else if (ev == 'blur') {
            i.addEventListener('blur', function () {
                e.d_comment(this);
            });

        }
    }

    t.prototype.move_review_slider = function (e) {
        var j = 0, k = 0;
        var bd = (e.getAttribute("bb_direction"));
        var sc = document.getElementsByClassName('bb_slides_inner')[0];
        var myListItems = sc.getElementsByClassName('bb_slides_box');
        //alert(bd + ' ' + myListItems.length);
        if (bd == 'right') {
            for (i = 0; i < myListItems.length; ++i) {
                var s = t.getDisplayStyle(myListItems[i]);
                if (s == 'block' || s == 'inline-block') {
                    j++;
                    if (j == 1)
                        t.toggleVisibility(myListItems[i]);

                }
                if (j > 0 && s == 'none') {
                    k++;
                    if (k == 1)
                        t.toggleVisibility(myListItems[i]);

                }
            }
        } else if (bd == 'left') {
            var j = 0, k = 0;
            for (i = myListItems.length - 1; i > 0; i--) {
                var s = t.getDisplayStyle(myListItems[i]);
                if (s == 'block' || s == 'inline-block') {
                    j++;
                    if (j == 1)
                        t.toggleVisibility(myListItems[i]);

                }
                if (j > 0 && s == 'none') {
                    k++;
                    if (k == 1)
                        t.toggleVisibility(myListItems[i]);

                }
            }

        }

    }

    t.prototype.trigger = function (e, o) {
        t.Modules.Event.trigger.call(this, e, o)
    }
    return t;
}(),
        BB.ajax = function (t, e, o, n, i) {
            function s(t, e) {
                var o = r();
                return o && "withCredentials" in o ? (o.open(t, e, true), o.withCredentials = false, o.setRequestHeader("Accept", "application/json", "text/html")) : "undefined" != typeof XDomainRequest ? (o = new XDomainRequest, o.onprogress = function () {}, o.open(t, e)) : o = null, o
            }

            function r() {
                if (window.XMLHttpRequest)
                    return new XMLHttpRequest;
                try {
                    return new ActiveXObject("MSXML2.XMLHTTP.3.0")
                } catch (t) {
                    return null
                }
            }
            var a = s(o ? o : "GET", t);
            return a ? (a.readyState ? a.onreadystatechange = function () {
                if (4 == a.readyState) {
                    var t = a.responseText;
                    i ? e(t, i) : e(t)
                }
            } : a.onload = function () {
                var t = a.responseText;
                i ? e(t, i) : e(t)
            }, a.onerror = function () {
                BB.safeConsole("There was an error making the request.", "error")
            }, "POST" == o && "withCredentials" in a && a.setRequestHeader("Content-type", "application/x-www-form-urlencoded"), a.send(n), true) : (BB.safeConsole("CORS not supported", "error"), false)
        },
        BB.validateEmail = function (t) {
            var e = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return e.test(t)
        },
        BB.capitalize = function (t) {
            return t.charAt(0).toUpperCase() + t.slice(1)
        },
        BB.getIEVersion = function () {
            var t = navigator.userAgent,
                    e = /MSIE\s?(\d+)(?:\.(\d+))?/i,
                    o = t.match(e);
            return null != o ? {
                major: o[1],
                minor: o[2]
            } : {
                major: "-1",
                minor: "-1"
            }
        },
        BB.ready = function (t) {
            BB.isIE10OrLess && 10 != BB.getIEVersion().major || "interactive" !== document.readyState ? "complete" === document.readyState ? setTimeout(function () {
                t()
            }, 1) : document.addEventListener ? document.addEventListener("DOMContentLoaded", function () {
                t()
            }, false) : document.attachEvent("onreadystatechange", function () {
                "complete" === document.readyState && t()
            }) : setTimeout(function () {
                t()
            }, 1)
        },
        BB.hasClass = function (t, e) {
            return t.classList ? t.classList.contains(e) : new RegExp("(^| )" + e + "( |$)", "gi").test(t.className)
        },
        BB.addClass = function (t, e) {
            t.classList ? t.classList.add(e) : t.className += " " + e
        },
        BB.removeClass = function (t, e) {
            t.classList ? t.classList.remove(e) : t.className = t.className.replace(new RegExp("(^|\\b)" + e.split(" ").join("|") + "(\\b|$)", "gi"), " ")
        },
        BB.toggleClass = function (t, e) {
            BB.hasClass(t, e) ? BB.removeClass(t, e) : BB.addClass(t, e)
        },
        BB.addEventListener = function (t, e, o) {
            t.addEventListener ? t.addEventListener(e, o, false) : t.attachEvent && t.attachEvent("on" + e, o)
        },
        BB.removeEventListener = function (t, e, o) {
            t.removeEventListener ? t.removeEventListener(e, o, false) : t.detachEvent && t.detachEvent("on" + e, o)
        },
        BB.toggleVisibility = function (t) {
            t.style.display = "none" == BB.getDisplayStyle(t) ? "inline-block" : "none"
        },
        BB.getDisplayStyle = function (t) {
            return t.currentStyle ? t.currentStyle.display : window.getComputedStyle ? window.getComputedStyle(t, null).getPropertyValue("display") : null
        },
        BB.getComputedStyle = function (t, e) {
            return t ? t.currentStyle ? t.currentStyle[e] : window.getComputedStyle ? window.getComputedStyle(t, null).getPropertyValue(e) : null : null
        },
        BB.show = function (t, e) {
            t.style.display = e ? e : "inline-block", BB.removeClass(t, "bb-hidden")
        },
        BB.hide = function (t) {
            t.style.display = "none", BB.addClass(t, "bb-hidden")
        },
        BB.remove = function (t) {
            t.parentNode.removeChild(t)
        },
        BB.getStyle = function (t, e) {
            if (t.currentStyle)
                var o = t.currentStyle[e];
            else if (window.getComputedStyle)
                var o = document.defaultView.getComputedStyle(t, null).getPropertyValue(e);
            return o
        },
        BB.isHidden = function (t) {
            return !BB.isIE10OrLess && t.classList ? null === t.offsetParent && t != document.body : "none" == BB.getStyle(t, "display") || "hidden" == BB.getStyle(t, "visibilty")
        },
        BB.forEach = function (t, e) {
            //alert(t);
            if (Array.prototype.forEach)
                t.forEach(e);
            else {
                if ("function" != typeof e)
                    throw new TypeError;
                for (var o = arguments.length >= 2 ? arguments[1] : void 0, n = 0; n < t.length; n++)
                    n in t && e.call(o, t[n], n, t)
            }
        },
        BB.isArray = "isArray" in Array ? Array.isArray : function (t) {
            var e = Object.prototype.toString.call(t);
            return "[object Array]" === e
        },
        BB.safeConsole = function () {},
        BB.isString = function (t) {
            return "string" == typeof t || t instanceof String
        },
        document.getElementsByClassName || (document.getElementsByClassName = function (t) {
            return this.querySelectorAll("." + t)
        },
                Element.prototype.getElementsByClassName = document.getElementsByClassName),
        "function" != typeof String.prototype.trim && (String.prototype.trim = function () {
            return this.replace(/^\s+|\s+$/g, "")
        }),
        Object.keys || (Object.keys = function () {
            "use strict";
            var t = Object.prototype.hasOwnProperty,
                    e = !{
                        toString: null
                    }.propertyIsEnumerable("toString"),
                    o = ["toString", "toLocaleString", "valueOf", "hasOwnProperty", "isPrototypeOf", "propertyIsEnumerable", "constructor"],
                    n = o.length;
            return function (i) {
                if ("object" != typeof i && ("function" != typeof i || null === i))
                    throw new TypeError("Object.keys called on non-object");
                var s, r, a = [];
                for (s in i)
                    t.call(i, s) && a.push(s);
                if (e)
                    for (r = 0; n > r; r++)
                        t.call(i, o[r]) && a.push(o[r]);
                return a
            }
        }()),
        BB.Modules = BB.Modules || {}, BB.Modules.Slide = function (t) {

    function e(t, e) {
        //alert(e.initialPosition);
        this.element = t,
                this.imageCount = e.imageCount,
                this.displayWindowCount = e.displayWindowCount,
                this.position = e.initialPosition || s(e.imageCount, e.displayWindowCount),
                this.offset = e.useOffset ? i(this.displayWindowCount) : u,
                this.autoSlide = !!e.autoSlide && e.imageCount > e.displayWindowCount,
                this.interval = e.delayInterval || a,
                this.direction = e.slideDirection || l,
                this.percentage = 100 / parseFloat(this.displayWindowCount),
                this.isSliding = false,
                this.animationDuration = e.animationDuration || d,
                this.displayDirection = "left",
                this.directionVector = this.displayDirection == l ? -1 : 1,
                this.onSlideCallbacks = []
    }

    function o(e) {

        var o = this,
                i = 0;
        //alert(this.position + ' Class '+o.element + 'ClassName='+c);
        //alert(i);
        //Need to work from here
        this.isSliding || (this.isSliding = true, this.position += e, r.call(this), 0 === this.position ? i = this.imageCount : this.position === this.imageCount + 1 && (i = -this.imageCount), setTimeout(function () {
            0 !== i && (t.removeClass(o.element, c), o.position += i, r.call(o)), setTimeout(function () {
                t.addClass(o.element, c), o.isSliding = false
            }, 50)
        }, this.animationDuration))
    }

    function i(t) {
        return 100 / t / 2
    }

    function s(t, e) {
        return e >= t ? 0 : e
    }

    function r() {
        this.element.style[this.displayDirection] = -(this.position * this.percentage + this.offset) + "%"
        
    }
    
    function inisl(t){
        
        this.position= 0;
        
    }
    var a = 3e3,
            l = "left",
            c = "y-slide-left-animations",
            d = 450,
            u = 0;
    return e.prototype.left = function () {
        o.call(this, this.directionVector)
    }, e.prototype.right = function () {
        o.call(this, -this.directionVector)
    }, e.prototype.setCurrentPosition = function (t) {
        this.position = t, r.call(this)
    }, e.prototype.start = function () {
        r.call(this), this.autoSlide && this.play()
    }, e.prototype.play = function () {
        var t = this;
        !this.timerID && this.autoSlide && (this.timerID = setInterval(function () {
            //alert(t.direction);
            //alert(t.imageCount + t.position);
            var remainingSlides = t.imageCount-3;
            if(remainingSlides == t.position){
                //alert("Now should be reset");
                //this.pause();
                inisl.call(t);
                
            }
            t[t.direction]()
        }, this.interval))
    }, e.prototype.pause = function () {
        this.timerID && this.autoSlide && (clearInterval(this.timerID), delete this.timerID)
    }, e.prototype.onSlide = function (t) {
        this.onSlideCallbacks.push(t)
    }, e
}(BB),
        BB.Modules = BB.Modules || {}, BB.Modules.Event = function (t) {
    var e = {};
    return e.on = function (t, e) {
        this.callbacks = this.callbacks || {}, this.callbacks[t] = this.callbacks[t] || [], this.callbacks[t].push(e)
    }, e.trigger = function (e, o, n) {
        var i = this;
        t.forEach(i.callbacks && i.callbacks[e] || [], function (t) {
            t.call(i, o, n)
        })
    }, e.removeEvent = function (t) {
        var e = this;
        e.callbacks[t] && delete e.callbacks[t]
    }, e
}(BB);

var bbkey = document.getElementById("bbscriptloader").getAttribute("data-key");
var bbwidgets = document.getElementById("bbscriptloader").getAttribute("data-widgets");

if (bbkey != 'undefined' && bbwidgets != 'undefined') {
    var bbwidget = bbwidgets.split("|");
    // Include Css
    var oBB = new BB(bbkey, {
        "host": "//dev.brandboost.io",
        "popup_widget": (bbwidget.indexOf("pw") > -1) ? true : false,
        "testimonial_widget": (bbwidget.indexOf("tw") > -1) ? true : false,
        "inline_widget": (bbwidget.indexOf("iw") > 0) ? true : false,
    });

    BB.ready(function () {
        // Include Widget
        oBB.p_widget();
        // Display Content
        oBB.g_reviews();

    });
}