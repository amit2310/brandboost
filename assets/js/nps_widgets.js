BB = function (t) {
    function t(e, o) {
        this.userSettings = o;
        this.userbbkey = e;
        v.call(this)
    }

    function v() {
        var e = this.userSettings.host + "/assets/css/nps_widget_style.css";
        var a = document.getElementsByTagName("head")[0];
        l = document.createElement("link");
        l.type = "text/css";
        l.rel = "stylesheet";
        l.href = e;
        a.appendChild(l);
    }

    function h(e) {
        var o = [];
        try {
            o = JSON.parse(e);
            if (o.length != undefined) {
                for (var n = -1, i = 0; i < o.length; i++)
                    if ("list" == o[i].method) {
                        n = i;
                        if (this.userSettings.widget == 'nps') {
                            document.getElementsByClassName("bb main-widget")[0].innerHTML = o[n].content;
                        }
                        break
                    }
            } else {
                if (this.userSettings.widget == 'nps') {
                    document.getElementsByClassName("bb main-widget")[0].innerHTML = o.content;
                }
            }
			
			setTimeout(function(){
				document.getElementById("bbnpspopup").classList.add('bbOpenVPopup');
			}, 1000);
        } catch (r) {
            t.safeConsole(r.message)
        }
    }

    t.prototype.hola = function () {
        alert('called, hola amigo');
    }

    t.prototype.init_widget = function () {
        if (this.userSettings.widget === 'nps') {
            var t = document.createElement("div");
            t.className = "bb main-widget";
            document.body.appendChild(t);
        }
    }

    t.prototype.display_widget = function () {
        var e = this;
        var bb_key = this.userbbkey;
        var bb_widget_name = this.userSettings.widget;
        var sub_id = this.userSettings.subid;
		var nextPara = '';
		if(sub_id != ''){
			nextPara = "/" + sub_id;
		}
        var bbsrc = this.userSettings.host + "/nps/display_widget/" + bb_widget_name + "/" + bb_key + nextPara;
        var a = {};
        //i = call back function
        //a = POST data
        var i = function (o) {
            //Display Json on browser
            h.call(e, o), e.trigger("ready"), f.call(e);
        };
        t.ajax(bbsrc, i, 'POST', a);
    }

    
    t.prototype.c_nps = function (e, y) {
        //var s = document.getElementsByClassName('bb_txt_success')[0];
        var err = document.getElementsByClassName('bb_txt_danger')[0];
        //var bbrtbx = document.getElementsByClassName("bbratingbox")[0];
        var bbforms = document.getElementsByClassName("nps_bb_form_box")[0];
        document.getElementById("bb-score-val").value = y;
        //t.hide(s);
        t.hide(err);
        //t.hide(bbrtbx);
        t.show(bbforms);
    }
	
	t.prototype.bb_nps_widget_close = function (e, y) {
        document.getElementById('bbnpspopup').style.display='none';
    }
	
	t.prototype.ratingSelect = function (e, selectedVal, btnColor, btnTextColor, btnOverColor, btnOverTextColor) {
		var m;
		for(m=0; m <= 10; m++){
			if(m <= selectedVal){
				document.getElementsByClassName('bb_nps_rating')[m].style.background=btnOverColor;
				document.getElementsByClassName('bb_nps_rating')[m].style.color=btnOverTextColor;
				document.getElementsByClassName('bb_nps_rating')[m].style.borderColor=btnOverColor;
			}else{
				document.getElementsByClassName('bb_nps_rating')[m].style.background=btnColor;
				document.getElementsByClassName('bb_nps_rating')[m].style.color=btnTextColor;
			}
		}
	}

    t.prototype.s_nps = function (e) {
        var s = document.getElementsByClassName('bb_nps_success_box')[0];
        var err = document.getElementsByClassName('bb_txt_danger')[0];
        var bbrtbx = document.getElementsByClassName("nps_bb_bot_widget")[0];
        //var bbforms = document.getElementsByClassName("bb_nps_form")[0];
        var mainwidget = document.getElementById("bbnpspopup");
		//t.hide(s);
		t.hide(err);
		
        var fullname = document.getElementById("bbnpsname").value;
        var emailadd = document.getElementById("bbnpsemail").value;
        var titleline = document.getElementById("bbnpstitle").value;
        var descline = document.getElementById("bbnpsdesc").value;
        var selscore = document.getElementById("bb-score-val").value;
        var aid = document.getElementById("bb-account-id").value;
        /*if (emailadd == '' || fullname == '' || titleline == "" || descline == "") {
            err.innerHTML = 'Fields should not leave blank';
            t.show(err);
            return;
        }
		
		if(bbpwValidateEmail(emailadd) === false){
			err.innerHTML = 'Please enter valid email address.';
            t.show(err);
            return;
		}*/
        
		document.getElementsByClassName("bb_overlay")[0].style.display = 'block';
        a = 'bbaid=' + aid + '&bbnpsname=' + fullname + '&bbnpsemail=' + emailadd + '&bbnpstitle=' + titleline + '&bbnpsdesc=' + descline + '&score='+selscore;
        var bbsrc = this.userSettings.host + "/nps/recordSurvey/";
        var i = function (o) {
            var rsp = JSON.parse(o);
			document.getElementsByClassName("bb_overlay")[0].style.display = 'none';
            if (rsp.status == 'success') {
                //s.innerHTML = '<strong>Thank you for your feedback!</strong>';
                t.show(s);
                t.hide(err);
                t.hide(bbrtbx);
                //t.hide(bbforms);
				
				document.getElementById("bbnpsname").value='';
				document.getElementById("bbnpsemail").value='';
				document.getElementById("bbnpstitle").value='';
				document.getElementById("bbnpsdesc").value='';
				
				setTimeout(function(){
					mainwidget.classList.remove('bbOpenVPopup');
					t.hide(mainwidget);
				}, 3000);
            }
        }
        t.ajax(bbsrc, i, 'POST', a);

    }

    function f() {
        if (document.getElementById("bbnpspopup")) {
            document.getElementById("bbnpspopup").style.display = 'block';
        }

        var e = this,
                o = document.getElementsByClassName("bb-loaded")[0];
        if ("undefined" == typeof o) {
            setTimeout(function () {
                f.call(e)
            }, 50);
        } else {
            if (this.userSettings.widget == 'nps') {
                e.b_event('click', 'bbsurveybtn', 'bb_display_survey_form');
                e.b_event('click', 'bbnpssubmit', 'bb_submit_survey_form');
                e.b_event('click', 'bb_nps_rating', 'bb_rating_value_select');
                e.b_event('click', 'bb_nps_widget_close', 'bb_nps_widget_close');
                e.b_event('click', 'bb_nps_widget_close2', 'bb_nps_widget_close');
            }
        }
    }

    function u(t) {
        var e;
        return t >= 960 ? e = 3 : t >= 600 && 960 > t ? e = 2 : 600 > t && (e = 1), e
    }


    t.prototype.b_event = function (ev, c, an) {
        var e = this;
        var col = document.getElementsByClassName(c);
        var i = document.getElementsByClassName(c)[0];
        var j = document.getElementsByClassName(c)[1];
        if (ev == 'click') {
            if (an == 'bb_display_survey_form') {
                for (k = 0; k < col.length; k++) {
                    col[k].addEventListener('click', function () {
                        var selectedVal = this.getAttribute('rating_value');
                        e.c_nps(this, selectedVal);
                    });
                }
            } else if (an == 'bb_submit_survey_form') {
                i.addEventListener('click', function () {
                    e.s_nps(this);
                });
            } else if (an == 'bb_nps_widget_close') {
                i.addEventListener('click', function () {
                    e.bb_nps_widget_close(this);
                });
            } else if (an == 'bb_rating_value_select') {
				var liTag;
				for(liTag = 0; liTag < col.length; liTag++){
					col[liTag].addEventListener('mouseover', function () {
						var selectedVal = this.getAttribute('rating_value');
						var btnOverColor = this.getAttribute('over_btn_color');
						var btnOverTextColor = this.getAttribute('over_btn_text_color');
						var btnColor = this.getAttribute('btn_color');
						var btnTextColor = this.getAttribute('btn_text_color');
						e.ratingSelect(this, selectedVal, btnColor, btnTextColor, btnOverColor, btnOverTextColor);
					});
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
            t.style.display = "none" == BB.getDisplayStyle(t) ? "block" : "none"
        },
        BB.getDisplayStyle = function (t) {
            return t.currentStyle ? t.currentStyle.display : window.getComputedStyle ? window.getComputedStyle(t, null).getPropertyValue("display") : null
        },
        BB.getComputedStyle = function (t, e) {
            return t ? t.currentStyle ? t.currentStyle[e] : window.getComputedStyle ? window.getComputedStyle(t, null).getPropertyValue(e) : null : null
        },
        BB.show = function (t, e) {
            t.style.display = e ? e : "block", BB.removeClass(t, "bb-hidden")
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

    function inisl(t) {

        this.position = 0;

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
            var remainingSlides = t.imageCount - 3;
            if (remainingSlides == t.position) {
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

function bbpwValidateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

var bbkey = document.getElementById("bbscriptloader").getAttribute("data-key");
var bbwidget = document.getElementById("bbscriptloader").getAttribute("data-widgets");
var subId = document.getElementById("bbscriptloader").getAttribute("async");

if (bbkey != 'undefined' && bbwidget != 'undefined') {

    // Include Css
    var oBB = new BB(bbkey, {
        "host": "//brandboost.io",
        "widget": bbwidget,
        "subid": subId
    });

    BB.ready(function () {
        oBB.init_widget();
        if (bbwidget == 'nps') {
            oBB.display_widget();
        }
    });
}