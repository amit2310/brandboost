export default {
    methods: {
        capitalizeFirstLetter(str) {
            if (typeof str !== 'string') return str;
            return str.charAt(0).toUpperCase() + str.slice(1);
        },
        paginate(tableId, time = 1000) {
            setTimeout(function () {
                custom_data_table(tableId);
            }, time);
        },
        mobileNoFormat(mobileNo) {
            if (mobileNo.length <= 3) {
                return '';
            }
            mobileNo = mobileNo.replace(/\D/g,'');
            var len = mobileNo.length;
            switch (len) {
                case 7:
                    mobileNo = mobileNo.replace(/[^\d]+/g, '').replace(/(\d{3})(\d{4})/, '$1-$2');
                    break;
                case 10:
                    mobileNo = mobileNo.replace(/[^\d]+/g, '').replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
                    break;
                case 11:
                    mobileNo = mobileNo.substr(1);
                    mobileNo = mobileNo.replace(/[^\d]+/g, '').replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
                    break;
                case 12:
                    mobileNo = mobileNo.substr(2);
                    mobileNo = mobileNo.replace(/[^\d]+/g, '').replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
                    break;
                default:
                    break;
            }

            return mobileNo;
        },
        csrf_token() {
            let tkn = $('meta[name="_token"]').attr('content');
            return tkn;
        },
        setStringLimit(str, limit) {
            if (typeof str !== 'string') return '';
            var cLimit = limit == '' ? 35 : limit;
            var post = str.substr(0, cLimit);
            var dotVal = '';
            if (str.length >= cLimit) {
                dotVal = '...';
            }
            return post + dotVal;
        },
        displayNoData() {
            return "<span class=\"text-muted text-size-small\">[No Data]</span>";
        },
        nl2br (str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
        },
        number_format(num, placeVal) {
            var placeVal = placeVal != '' ? placeVal : 2;
            return parseFloat(Math.round(num * 100) / 100).toFixed(placeVal);
        },
        Base64EncodeUrl(str){
            return str.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
        },
        Base64DecodeUrl(str){
            str = (str + '===').slice(0, str.length + (str.length % 4));
            return str.replace(/-/g, '+').replace(/_/g, '/');
        },
        formattedDateTime() {
            /*
             * Accepts a date, a mask, or a date and a mask.
             * Returns a formatted version of the given date.
             * The date defaults to the current date/time.
             * The mask defaults to dateFormat.masks.default.
             */

            var dateFormat = function () {
                var    token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
                    timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
                    timezoneClip = /[^-+\dA-Z]/g,
                    pad = function (val, len) {
                        val = String(val);
                        len = len || 2;
                        while (val.length < len) val = "0" + val;
                        return val;
                    };

                // Regexes and supporting functions are cached through closure
                return function (date, mask, utc) {
                    var dF = dateFormat;

                    // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
                    if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
                        mask = date;
                        date = undefined;
                    }

                    // Passing date through Date applies Date.parse, if necessary
                    date = date ? new Date(date) : new Date;
                    if (isNaN(date)) throw SyntaxError("invalid date");

                    mask = String(dF.masks[mask] || mask || dF.masks["default"]);

                    // Allow setting the utc argument via the mask
                    if (mask.slice(0, 4) == "UTC:") {
                        mask = mask.slice(4);
                        utc = true;
                    }

                    var    _ = utc ? "getUTC" : "get",
                        d = date[_ + "Date"](),
                        D = date[_ + "Day"](),
                        m = date[_ + "Month"](),
                        y = date[_ + "FullYear"](),
                        H = date[_ + "Hours"](),
                        M = date[_ + "Minutes"](),
                        s = date[_ + "Seconds"](),
                        L = date[_ + "Milliseconds"](),
                        o = utc ? 0 : date.getTimezoneOffset(),
                        flags = {
                            d:    d,
                            dd:   pad(d),
                            ddd:  dF.i18n.dayNames[D],
                            dddd: dF.i18n.dayNames[D + 7],
                            m:    m + 1,
                            mm:   pad(m + 1),
                            mmm:  dF.i18n.monthNames[m],
                            mmmm: dF.i18n.monthNames[m + 12],
                            yy:   String(y).slice(2),
                            yyyy: y,
                            h:    H % 12 || 12,
                            hh:   pad(H % 12 || 12),
                            H:    H,
                            HH:   pad(H),
                            M:    M,
                            MM:   pad(M),
                            s:    s,
                            ss:   pad(s),
                            l:    pad(L, 3),
                            L:    pad(L > 99 ? Math.round(L / 10) : L),
                            t:    H < 12 ? "a"  : "p",
                            tt:   H < 12 ? "am" : "pm",
                            T:    H < 12 ? "A"  : "P",
                            TT:   H < 12 ? "AM" : "PM",
                            Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
                            o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
                            S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
                        };

                    return mask.replace(token, function ($0) {
                        return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
                    });
                };
            }();

            // Some common format strings
            dateFormat.masks = {
                "default":      "ddd mmm dd yyyy HH:MM:ss",
                shortDate:      "m/d/yy",
                mediumDate:     "mmm d, yyyy",
                longDate:       "mmmm d, yyyy",
                fullDate:       "dddd, mmmm d, yyyy",
                shortTime:      "h:MM TT",
                mediumTime:     "h:MM:ss TT",
                longTime:       "h:MM:ss TT Z",
                isoDate:        "yyyy-mm-dd",
                isoTime:        "HH:MM:ss",
                isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
                isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
            };

            // Internationalization strings
            dateFormat.i18n = {
                dayNames: [
                    "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
                    "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
                ],
                monthNames: [
                    "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
                ]
            };

            // For convenience...
            Date.prototype.format = function (mask, utc) {
                return dateFormat(this, mask, utc);
            };

            var today = new Date();
            var dateString = today.format("ddS-m-yy");
            //alert("Formatted Date: "+dateString);
        },
        displayDateFormat(format, datetime) {
            /*
                Day:
                d - Numeric day of the month with leading zeros (01 to 31)
                D - Short day abbreviation (three letters). Mon through Sun.
                j - Day of the month without leading zeros ( 1 to 31)
                l (lowercase 'L') - Full day name (Sunday through Saturday)
                N - ISO-8601 numeric representation of a day of a week (1 (for Monday) through 7 (for Sunday).
                S - English ordinal suffix for the day of the month, 2 characters (st, nd, rd or th. Works well with j)
                w - Numeric day of the week. (0 (for Sunday) through 6 (for Saturday)
                z - Numeric day of the year (0 to 365)

                Week:
                W - ISO-8601 numeric representation of week number of year. Week starting from Monday

                Month :
                F - Full month name. (January through December)
                m - Numeric representation of a month with leading zeros (01 to 12)
                M - Short month abbreviation (three letters). Jan through Dec
                n - Numeric representation of a month, without leading zeros (1 through 12)
                t -Number of days of a specified month (28 through 31)

                Year :
                L - Whether it's a leap year (set 1 if leapyear otherwise 0)
                o - ISO-8601 year number
                Y - Numeric year value in 4 digits (1999)
                y - Numeric year value in two digit (1999 as 99)

                Time :
                a - Lowercase am or pm.
                A - Uppercase AM or PM.
                B - Swatch Internet time (000 through 999)
                g - 12-hour format of an hour without leading zeros (1 to 12)
                G - 24-hour format of an hour without leading zeros (0 to 23)
                h - 12-hour format of an hour with leading zeros (01 to 12)
                H - 24-hour format of an hour with leading zeros(00 to 23)
                i - Minutes with leading zeros (00 to 59)
                s - Seconds, with leading zeros (00 to 59)
                u - Microseconds(numeric value) Example : 574925

                Timezone :
                T - Timezone abbreviation. (Examples: EST, MDT)
             */

            //return date("l jS F Y", strtotime('2019-06-19 16:36:46'));
            return date(format, strtotime(datetime));
        },
        makeBreadcrumb(elements){
            if(elements!= ''){
                let breadcrumbString = '';
                breadcrumbString = '<ul class="list-unstyled topbar-nav top-breadcrumb float-left mt8 mb-0">';
                for(name in elements){
                    let url = elements[name];
                    breadcrumbString += '<li>';
                    if(url != ''){
                        breadcrumbString += '<a href="'+url+'">';
                        breadcrumbString += '<img src="/assets/images/mail-open-line.svg"/>';
                    }
                    breadcrumbString += ' &nbsp;' + name;
                    if(url != ''){
                        breadcrumbString += '</a>';
                    }
                    breadcrumbString += '</li>';
                    if(url != '') {
                        breadcrumbString += '<li class="ml10 mr10"><img src="/assets/images/chevron-left.svg"/></li>';
                    }
                }

                breadcrumbString += '</ul>';
                document.getElementById("breadcrumb").innerHTML = breadcrumbString;

            }
        }

    }
}
