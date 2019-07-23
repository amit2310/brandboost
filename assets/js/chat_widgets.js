!function(t,e){"object"==typeof exports&&"object"==typeof module?module.exports=e():"function"==typeof define&&define.amd?define([],e):"object"==typeof exports?exports.io=e():t.io=e()}(this,function(){return function(t){function e(r){if(n[r])return n[r].exports;var o=n[r]={exports:{},id:r,loaded:!1};return t[r].call(o.exports,o,o.exports,e),o.loaded=!0,o.exports}var n={};return e.m=t,e.c=n,e.p="",e(0)}([function(t,e,n){"use strict";function r(t,e){"object"===("undefined"==typeof t?"undefined":o(t))&&(e=t,t=void 0),e=e||{};var n,r=i(t),s=r.source,p=r.id,h=r.path,f=u[p]&&h in u[p].nsps,l=e.forceNew||e["force new connection"]||!1===e.multiplex||f;return l?(c("ignoring socket cache for %s",s),n=a(s,e)):(u[p]||(c("new io instance for %s",s),u[p]=a(s,e)),n=u[p]),r.query&&!e.query&&(e.query=r.query),n.socket(r.path,e)}var o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},i=n(1),s=n(7),a=n(12),c=n(3)("socket.io-client");t.exports=e=r;var u=e.managers={};e.protocol=s.protocol,e.connect=r,e.Manager=n(12),e.Socket=n(37)},function(t,e,n){(function(e){"use strict";function r(t,n){var r=t;n=n||e.location,null==t&&(t=n.protocol+"//"+n.host),"string"==typeof t&&("/"===t.charAt(0)&&(t="/"===t.charAt(1)?n.protocol+t:n.host+t),/^(https?|wss?):\/\//.test(t)||(i("protocol-less url %s",t),t="undefined"!=typeof n?n.protocol+"//"+t:"https://"+t),i("parse %s",t),r=o(t)),r.port||(/^(http|ws)$/.test(r.protocol)?r.port="80":/^(http|ws)s$/.test(r.protocol)&&(r.port="443")),r.path=r.path||"/";var s=r.host.indexOf(":")!==-1,a=s?"["+r.host+"]":r.host;return r.id=r.protocol+"://"+a+":"+r.port,r.href=r.protocol+"://"+a+(n&&n.port===r.port?"":":"+r.port),r}var o=n(2),i=n(3)("socket.io-client:url");t.exports=r}).call(e,function(){return this}())},function(t,e){var n=/^(?:(?![^:@]+:[^:@\/]*@)(http|https|ws|wss):\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?((?:[a-f0-9]{0,4}:){2,7}[a-f0-9]{0,4}|[^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/,r=["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"];t.exports=function(t){var e=t,o=t.indexOf("["),i=t.indexOf("]");o!=-1&&i!=-1&&(t=t.substring(0,o)+t.substring(o,i).replace(/:/g,";")+t.substring(i,t.length));for(var s=n.exec(t||""),a={},c=14;c--;)a[r[c]]=s[c]||"";return o!=-1&&i!=-1&&(a.source=e,a.host=a.host.substring(1,a.host.length-1).replace(/;/g,":"),a.authority=a.authority.replace("[","").replace("]","").replace(/;/g,":"),a.ipv6uri=!0),a}},function(t,e,n){(function(r){function o(){return!("undefined"==typeof window||!window.process||"renderer"!==window.process.type)||("undefined"==typeof navigator||!navigator.userAgent||!navigator.userAgent.toLowerCase().match(/(edge|trident)\/(\d+)/))&&("undefined"!=typeof document&&document.documentElement&&document.documentElement.style&&document.documentElement.style.WebkitAppearance||"undefined"!=typeof window&&window.console&&(window.console.firebug||window.console.exception&&window.console.table)||"undefined"!=typeof navigator&&navigator.userAgent&&navigator.userAgent.toLowerCase().match(/firefox\/(\d+)/)&&parseInt(RegExp.$1,10)>=31||"undefined"!=typeof navigator&&navigator.userAgent&&navigator.userAgent.toLowerCase().match(/applewebkit\/(\d+)/))}function i(t){var n=this.useColors;if(t[0]=(n?"%c":"")+this.namespace+(n?" %c":" ")+t[0]+(n?"%c ":" ")+"+"+e.humanize(this.diff),n){var r="color: "+this.color;t.splice(1,0,r,"color: inherit");var o=0,i=0;t[0].replace(/%[a-zA-Z%]/g,function(t){"%%"!==t&&(o++,"%c"===t&&(i=o))}),t.splice(i,0,r)}}function s(){return"object"==typeof console&&console.log&&Function.prototype.apply.call(console.log,console,arguments)}function a(t){try{null==t?e.storage.removeItem("debug"):e.storage.debug=t}catch(n){}}function c(){var t;try{t=e.storage.debug}catch(n){}return!t&&"undefined"!=typeof r&&"env"in r&&(t=r.env.DEBUG),t}function u(){try{return window.localStorage}catch(t){}}e=t.exports=n(5),e.log=s,e.formatArgs=i,e.save=a,e.load=c,e.useColors=o,e.storage="undefined"!=typeof chrome&&"undefined"!=typeof chrome.storage?chrome.storage.local:u(),e.colors=["#0000CC","#0000FF","#0033CC","#0033FF","#0066CC","#0066FF","#0099CC","#0099FF","#00CC00","#00CC33","#00CC66","#00CC99","#00CCCC","#00CCFF","#3300CC","#3300FF","#3333CC","#3333FF","#3366CC","#3366FF","#3399CC","#3399FF","#33CC00","#33CC33","#33CC66","#33CC99","#33CCCC","#33CCFF","#6600CC","#6600FF","#6633CC","#6633FF","#66CC00","#66CC33","#9900CC","#9900FF","#9933CC","#9933FF","#99CC00","#99CC33","#CC0000","#CC0033","#CC0066","#CC0099","#CC00CC","#CC00FF","#CC3300","#CC3333","#CC3366","#CC3399","#CC33CC","#CC33FF","#CC6600","#CC6633","#CC9900","#CC9933","#CCCC00","#CCCC33","#FF0000","#FF0033","#FF0066","#FF0099","#FF00CC","#FF00FF","#FF3300","#FF3333","#FF3366","#FF3399","#FF33CC","#FF33FF","#FF6600","#FF6633","#FF9900","#FF9933","#FFCC00","#FFCC33"],e.formatters.j=function(t){try{return JSON.stringify(t)}catch(e){return"[UnexpectedJSONParseError]: "+e.message}},e.enable(c())}).call(e,n(4))},function(t,e){function n(){throw new Error("setTimeout has not been defined")}function r(){throw new Error("clearTimeout has not been defined")}function o(t){if(p===setTimeout)return setTimeout(t,0);if((p===n||!p)&&setTimeout)return p=setTimeout,setTimeout(t,0);try{return p(t,0)}catch(e){try{return p.call(null,t,0)}catch(e){return p.call(this,t,0)}}}function i(t){if(h===clearTimeout)return clearTimeout(t);if((h===r||!h)&&clearTimeout)return h=clearTimeout,clearTimeout(t);try{return h(t)}catch(e){try{return h.call(null,t)}catch(e){return h.call(this,t)}}}function s(){y&&l&&(y=!1,l.length?d=l.concat(d):m=-1,d.length&&a())}function a(){if(!y){var t=o(s);y=!0;for(var e=d.length;e;){for(l=d,d=[];++m<e;)l&&l[m].run();m=-1,e=d.length}l=null,y=!1,i(t)}}function c(t,e){this.fun=t,this.array=e}function u(){}var p,h,f=t.exports={};!function(){try{p="function"==typeof setTimeout?setTimeout:n}catch(t){p=n}try{h="function"==typeof clearTimeout?clearTimeout:r}catch(t){h=r}}();var l,d=[],y=!1,m=-1;f.nextTick=function(t){var e=new Array(arguments.length-1);if(arguments.length>1)for(var n=1;n<arguments.length;n++)e[n-1]=arguments[n];d.push(new c(t,e)),1!==d.length||y||o(a)},c.prototype.run=function(){this.fun.apply(null,this.array)},f.title="browser",f.browser=!0,f.env={},f.argv=[],f.version="",f.versions={},f.on=u,f.addListener=u,f.once=u,f.off=u,f.removeListener=u,f.removeAllListeners=u,f.emit=u,f.prependListener=u,f.prependOnceListener=u,f.listeners=function(t){return[]},f.binding=function(t){throw new Error("process.binding is not supported")},f.cwd=function(){return"/"},f.chdir=function(t){throw new Error("process.chdir is not supported")},f.umask=function(){return 0}},function(t,e,n){function r(t){var n,r=0;for(n in t)r=(r<<5)-r+t.charCodeAt(n),r|=0;return e.colors[Math.abs(r)%e.colors.length]}function o(t){function n(){if(n.enabled){var t=n,r=+new Date,i=r-(o||r);t.diff=i,t.prev=o,t.curr=r,o=r;for(var s=new Array(arguments.length),a=0;a<s.length;a++)s[a]=arguments[a];s[0]=e.coerce(s[0]),"string"!=typeof s[0]&&s.unshift("%O");var c=0;s[0]=s[0].replace(/%([a-zA-Z%])/g,function(n,r){if("%%"===n)return n;c++;var o=e.formatters[r];if("function"==typeof o){var i=s[c];n=o.call(t,i),s.splice(c,1),c--}return n}),e.formatArgs.call(t,s);var u=n.log||e.log||console.log.bind(console);u.apply(t,s)}}var o;return n.namespace=t,n.enabled=e.enabled(t),n.useColors=e.useColors(),n.color=r(t),n.destroy=i,"function"==typeof e.init&&e.init(n),e.instances.push(n),n}function i(){var t=e.instances.indexOf(this);return t!==-1&&(e.instances.splice(t,1),!0)}function s(t){e.save(t),e.names=[],e.skips=[];var n,r=("string"==typeof t?t:"").split(/[\s,]+/),o=r.length;for(n=0;n<o;n++)r[n]&&(t=r[n].replace(/\*/g,".*?"),"-"===t[0]?e.skips.push(new RegExp("^"+t.substr(1)+"$")):e.names.push(new RegExp("^"+t+"$")));for(n=0;n<e.instances.length;n++){var i=e.instances[n];i.enabled=e.enabled(i.namespace)}}function a(){e.enable("")}function c(t){if("*"===t[t.length-1])return!0;var n,r;for(n=0,r=e.skips.length;n<r;n++)if(e.skips[n].test(t))return!1;for(n=0,r=e.names.length;n<r;n++)if(e.names[n].test(t))return!0;return!1}function u(t){return t instanceof Error?t.stack||t.message:t}e=t.exports=o.debug=o["default"]=o,e.coerce=u,e.disable=a,e.enable=s,e.enabled=c,e.humanize=n(6),e.instances=[],e.names=[],e.skips=[],e.formatters={}},function(t,e){function n(t){if(t=String(t),!(t.length>100)){var e=/^((?:\d+)?\.?\d+) *(milliseconds?|msecs?|ms|seconds?|secs?|s|minutes?|mins?|m|hours?|hrs?|h|days?|d|years?|yrs?|y)?$/i.exec(t);if(e){var n=parseFloat(e[1]),r=(e[2]||"ms").toLowerCase();switch(r){case"years":case"year":case"yrs":case"yr":case"y":return n*p;case"days":case"day":case"d":return n*u;case"hours":case"hour":case"hrs":case"hr":case"h":return n*c;case"minutes":case"minute":case"mins":case"min":case"m":return n*a;case"seconds":case"second":case"secs":case"sec":case"s":return n*s;case"milliseconds":case"millisecond":case"msecs":case"msec":case"ms":return n;default:return}}}}function r(t){return t>=u?Math.round(t/u)+"d":t>=c?Math.round(t/c)+"h":t>=a?Math.round(t/a)+"m":t>=s?Math.round(t/s)+"s":t+"ms"}function o(t){return i(t,u,"day")||i(t,c,"hour")||i(t,a,"minute")||i(t,s,"second")||t+" ms"}function i(t,e,n){if(!(t<e))return t<1.5*e?Math.floor(t/e)+" "+n:Math.ceil(t/e)+" "+n+"s"}var s=1e3,a=60*s,c=60*a,u=24*c,p=365.25*u;t.exports=function(t,e){e=e||{};var i=typeof t;if("string"===i&&t.length>0)return n(t);if("number"===i&&isNaN(t)===!1)return e["long"]?o(t):r(t);throw new Error("val is not a non-empty string or a valid number. val="+JSON.stringify(t))}},function(t,e,n){function r(){}function o(t){var n=""+t.type;if(e.BINARY_EVENT!==t.type&&e.BINARY_ACK!==t.type||(n+=t.attachments+"-"),t.nsp&&"/"!==t.nsp&&(n+=t.nsp+","),null!=t.id&&(n+=t.id),null!=t.data){var r=i(t.data);if(r===!1)return g;n+=r}return f("encoded %j as %s",t,n),n}function i(t){try{return JSON.stringify(t)}catch(e){return!1}}function s(t,e){function n(t){var n=d.deconstructPacket(t),r=o(n.packet),i=n.buffers;i.unshift(r),e(i)}d.removeBlobs(t,n)}function a(){this.reconstructor=null}function c(t){var n=0,r={type:Number(t.charAt(0))};if(null==e.types[r.type])return h("unknown packet type "+r.type);if(e.BINARY_EVENT===r.type||e.BINARY_ACK===r.type){for(var o="";"-"!==t.charAt(++n)&&(o+=t.charAt(n),n!=t.length););if(o!=Number(o)||"-"!==t.charAt(n))throw new Error("Illegal attachments");r.attachments=Number(o)}if("/"===t.charAt(n+1))for(r.nsp="";++n;){var i=t.charAt(n);if(","===i)break;if(r.nsp+=i,n===t.length)break}else r.nsp="/";var s=t.charAt(n+1);if(""!==s&&Number(s)==s){for(r.id="";++n;){var i=t.charAt(n);if(null==i||Number(i)!=i){--n;break}if(r.id+=t.charAt(n),n===t.length)break}r.id=Number(r.id)}if(t.charAt(++n)){var a=u(t.substr(n)),c=a!==!1&&(r.type===e.ERROR||y(a));if(!c)return h("invalid payload");r.data=a}return f("decoded %s as %j",t,r),r}function u(t){try{return JSON.parse(t)}catch(e){return!1}}function p(t){this.reconPack=t,this.buffers=[]}function h(t){return{type:e.ERROR,data:"parser error: "+t}}var f=n(3)("socket.io-parser"),l=n(8),d=n(9),y=n(10),m=n(11);e.protocol=4,e.types=["CONNECT","DISCONNECT","EVENT","ACK","ERROR","BINARY_EVENT","BINARY_ACK"],e.CONNECT=0,e.DISCONNECT=1,e.EVENT=2,e.ACK=3,e.ERROR=4,e.BINARY_EVENT=5,e.BINARY_ACK=6,e.Encoder=r,e.Decoder=a;var g=e.ERROR+'"encode error"';r.prototype.encode=function(t,n){if(f("encoding packet %j",t),e.BINARY_EVENT===t.type||e.BINARY_ACK===t.type)s(t,n);else{var r=o(t);n([r])}},l(a.prototype),a.prototype.add=function(t){var n;if("string"==typeof t)n=c(t),e.BINARY_EVENT===n.type||e.BINARY_ACK===n.type?(this.reconstructor=new p(n),0===this.reconstructor.reconPack.attachments&&this.emit("decoded",n)):this.emit("decoded",n);else{if(!m(t)&&!t.base64)throw new Error("Unknown type: "+t);if(!this.reconstructor)throw new Error("got binary data when not reconstructing a packet");n=this.reconstructor.takeBinaryData(t),n&&(this.reconstructor=null,this.emit("decoded",n))}},a.prototype.destroy=function(){this.reconstructor&&this.reconstructor.finishedReconstruction()},p.prototype.takeBinaryData=function(t){if(this.buffers.push(t),this.buffers.length===this.reconPack.attachments){var e=d.reconstructPacket(this.reconPack,this.buffers);return this.finishedReconstruction(),e}return null},p.prototype.finishedReconstruction=function(){this.reconPack=null,this.buffers=[]}},function(t,e,n){function r(t){if(t)return o(t)}function o(t){for(var e in r.prototype)t[e]=r.prototype[e];return t}t.exports=r,r.prototype.on=r.prototype.addEventListener=function(t,e){return this._callbacks=this._callbacks||{},(this._callbacks["$"+t]=this._callbacks["$"+t]||[]).push(e),this},r.prototype.once=function(t,e){function n(){this.off(t,n),e.apply(this,arguments)}return n.fn=e,this.on(t,n),this},r.prototype.off=r.prototype.removeListener=r.prototype.removeAllListeners=r.prototype.removeEventListener=function(t,e){if(this._callbacks=this._callbacks||{},0==arguments.length)return this._callbacks={},this;var n=this._callbacks["$"+t];if(!n)return this;if(1==arguments.length)return delete this._callbacks["$"+t],this;for(var r,o=0;o<n.length;o++)if(r=n[o],r===e||r.fn===e){n.splice(o,1);break}return this},r.prototype.emit=function(t){this._callbacks=this._callbacks||{};var e=[].slice.call(arguments,1),n=this._callbacks["$"+t];if(n){n=n.slice(0);for(var r=0,o=n.length;r<o;++r)n[r].apply(this,e)}return this},r.prototype.listeners=function(t){return this._callbacks=this._callbacks||{},this._callbacks["$"+t]||[]},r.prototype.hasListeners=function(t){return!!this.listeners(t).length}},function(t,e,n){(function(t){function r(t,e){if(!t)return t;if(s(t)){var n={_placeholder:!0,num:e.length};return e.push(t),n}if(i(t)){for(var o=new Array(t.length),a=0;a<t.length;a++)o[a]=r(t[a],e);return o}if("object"==typeof t&&!(t instanceof Date)){var o={};for(var c in t)o[c]=r(t[c],e);return o}return t}function o(t,e){if(!t)return t;if(t&&t._placeholder)return e[t.num];if(i(t))for(var n=0;n<t.length;n++)t[n]=o(t[n],e);else if("object"==typeof t)for(var r in t)t[r]=o(t[r],e);return t}var i=n(10),s=n(11),a=Object.prototype.toString,c="function"==typeof t.Blob||"[object BlobConstructor]"===a.call(t.Blob),u="function"==typeof t.File||"[object FileConstructor]"===a.call(t.File);e.deconstructPacket=function(t){var e=[],n=t.data,o=t;return o.data=r(n,e),o.attachments=e.length,{packet:o,buffers:e}},e.reconstructPacket=function(t,e){return t.data=o(t.data,e),t.attachments=void 0,t},e.removeBlobs=function(t,e){function n(t,a,p){if(!t)return t;if(c&&t instanceof Blob||u&&t instanceof File){r++;var h=new FileReader;h.onload=function(){p?p[a]=this.result:o=this.result,--r||e(o)},h.readAsArrayBuffer(t)}else if(i(t))for(var f=0;f<t.length;f++)n(t[f],f,t);else if("object"==typeof t&&!s(t))for(var l in t)n(t[l],l,t)}var r=0,o=t;n(o),r||e(o)}}).call(e,function(){return this}())},function(t,e){var n={}.toString;t.exports=Array.isArray||function(t){return"[object Array]"==n.call(t)}},function(t,e){(function(e){function n(t){return r&&e.Buffer.isBuffer(t)||o&&(t instanceof e.ArrayBuffer||i(t))}t.exports=n;var r="function"==typeof e.Buffer&&"function"==typeof e.Buffer.isBuffer,o="function"==typeof e.ArrayBuffer,i=function(){return o&&"function"==typeof e.ArrayBuffer.isView?e.ArrayBuffer.isView:function(t){return t.buffer instanceof e.ArrayBuffer}}()}).call(e,function(){return this}())},function(t,e,n){"use strict";function r(t,e){if(!(this instanceof r))return new r(t,e);t&&"object"===("undefined"==typeof t?"undefined":o(t))&&(e=t,t=void 0),e=e||{},e.path=e.path||"/socket.io",this.nsps={},this.subs=[],this.opts=e,this.reconnection(e.reconnection!==!1),this.reconnectionAttempts(e.reconnectionAttempts||1/0),this.reconnectionDelay(e.reconnectionDelay||1e3),this.reconnectionDelayMax(e.reconnectionDelayMax||5e3),this.randomizationFactor(e.randomizationFactor||.5),this.backoff=new l({min:this.reconnectionDelay(),max:this.reconnectionDelayMax(),jitter:this.randomizationFactor()}),this.timeout(null==e.timeout?2e4:e.timeout),this.readyState="closed",this.uri=t,this.connecting=[],this.lastPing=null,this.encoding=!1,this.packetBuffer=[];var n=e.parser||c;this.encoder=new n.Encoder,this.decoder=new n.Decoder,this.autoConnect=e.autoConnect!==!1,this.autoConnect&&this.open()}var o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},i=n(13),s=n(37),a=n(8),c=n(7),u=n(39),p=n(40),h=n(3)("socket.io-client:manager"),f=n(36),l=n(41),d=Object.prototype.hasOwnProperty;t.exports=r,r.prototype.emitAll=function(){this.emit.apply(this,arguments);for(var t in this.nsps)d.call(this.nsps,t)&&this.nsps[t].emit.apply(this.nsps[t],arguments)},r.prototype.updateSocketIds=function(){for(var t in this.nsps)d.call(this.nsps,t)&&(this.nsps[t].id=this.generateId(t))},r.prototype.generateId=function(t){return("/"===t?"":t+"#")+this.engine.id},a(r.prototype),r.prototype.reconnection=function(t){return arguments.length?(this._reconnection=!!t,this):this._reconnection},r.prototype.reconnectionAttempts=function(t){return arguments.length?(this._reconnectionAttempts=t,this):this._reconnectionAttempts},r.prototype.reconnectionDelay=function(t){return arguments.length?(this._reconnectionDelay=t,this.backoff&&this.backoff.setMin(t),this):this._reconnectionDelay},r.prototype.randomizationFactor=function(t){return arguments.length?(this._randomizationFactor=t,this.backoff&&this.backoff.setJitter(t),this):this._randomizationFactor},r.prototype.reconnectionDelayMax=function(t){return arguments.length?(this._reconnectionDelayMax=t,this.backoff&&this.backoff.setMax(t),this):this._reconnectionDelayMax},r.prototype.timeout=function(t){return arguments.length?(this._timeout=t,this):this._timeout},r.prototype.maybeReconnectOnOpen=function(){!this.reconnecting&&this._reconnection&&0===this.backoff.attempts&&this.reconnect()},r.prototype.open=r.prototype.connect=function(t,e){if(h("readyState %s",this.readyState),~this.readyState.indexOf("open"))return this;h("opening %s",this.uri),this.engine=i(this.uri,this.opts);var n=this.engine,r=this;this.readyState="opening",this.skipReconnect=!1;var o=u(n,"open",function(){r.onopen(),t&&t()}),s=u(n,"error",function(e){if(h("connect_error"),r.cleanup(),r.readyState="closed",r.emitAll("connect_error",e),t){var n=new Error("Connection error");n.data=e,t(n)}else r.maybeReconnectOnOpen()});if(!1!==this._timeout){var a=this._timeout;h("connect attempt will timeout after %d",a);var c=setTimeout(function(){h("connect attempt timed out after %d",a),o.destroy(),n.close(),n.emit("error","timeout"),r.emitAll("connect_timeout",a)},a);this.subs.push({destroy:function(){clearTimeout(c)}})}return this.subs.push(o),this.subs.push(s),this},r.prototype.onopen=function(){h("open"),this.cleanup(),this.readyState="open",this.emit("open");var t=this.engine;this.subs.push(u(t,"data",p(this,"ondata"))),this.subs.push(u(t,"ping",p(this,"onping"))),this.subs.push(u(t,"pong",p(this,"onpong"))),this.subs.push(u(t,"error",p(this,"onerror"))),this.subs.push(u(t,"close",p(this,"onclose"))),this.subs.push(u(this.decoder,"decoded",p(this,"ondecoded")))},r.prototype.onping=function(){this.lastPing=new Date,this.emitAll("ping")},r.prototype.onpong=function(){this.emitAll("pong",new Date-this.lastPing)},r.prototype.ondata=function(t){this.decoder.add(t)},r.prototype.ondecoded=function(t){this.emit("packet",t)},r.prototype.onerror=function(t){h("error",t),this.emitAll("error",t)},r.prototype.socket=function(t,e){function n(){~f(o.connecting,r)||o.connecting.push(r)}var r=this.nsps[t];if(!r){r=new s(this,t,e),this.nsps[t]=r;var o=this;r.on("connecting",n),r.on("connect",function(){r.id=o.generateId(t)}),this.autoConnect&&n()}return r},r.prototype.destroy=function(t){var e=f(this.connecting,t);~e&&this.connecting.splice(e,1),this.connecting.length||this.close()},r.prototype.packet=function(t){h("writing packet %j",t);var e=this;t.query&&0===t.type&&(t.nsp+="?"+t.query),e.encoding?e.packetBuffer.push(t):(e.encoding=!0,this.encoder.encode(t,function(n){for(var r=0;r<n.length;r++)e.engine.write(n[r],t.options);e.encoding=!1,e.processPacketQueue()}))},r.prototype.processPacketQueue=function(){if(this.packetBuffer.length>0&&!this.encoding){var t=this.packetBuffer.shift();this.packet(t)}},r.prototype.cleanup=function(){h("cleanup");for(var t=this.subs.length,e=0;e<t;e++){var n=this.subs.shift();n.destroy()}this.packetBuffer=[],this.encoding=!1,this.lastPing=null,this.decoder.destroy()},r.prototype.close=r.prototype.disconnect=function(){h("disconnect"),this.skipReconnect=!0,this.reconnecting=!1,"opening"===this.readyState&&this.cleanup(),this.backoff.reset(),this.readyState="closed",this.engine&&this.engine.close()},r.prototype.onclose=function(t){h("onclose"),this.cleanup(),this.backoff.reset(),this.readyState="closed",this.emit("close",t),this._reconnection&&!this.skipReconnect&&this.reconnect()},r.prototype.reconnect=function(){if(this.reconnecting||this.skipReconnect)return this;var t=this;if(this.backoff.attempts>=this._reconnectionAttempts)h("reconnect failed"),this.backoff.reset(),this.emitAll("reconnect_failed"),this.reconnecting=!1;else{var e=this.backoff.duration();h("will wait %dms before reconnect attempt",e),this.reconnecting=!0;var n=setTimeout(function(){t.skipReconnect||(h("attempting reconnect"),t.emitAll("reconnect_attempt",t.backoff.attempts),t.emitAll("reconnecting",t.backoff.attempts),t.skipReconnect||t.open(function(e){e?(h("reconnect attempt error"),t.reconnecting=!1,t.reconnect(),t.emitAll("reconnect_error",e.data)):(h("reconnect success"),t.onreconnect())}))},e);this.subs.push({destroy:function(){clearTimeout(n)}})}},r.prototype.onreconnect=function(){var t=this.backoff.attempts;this.reconnecting=!1,this.backoff.reset(),this.updateSocketIds(),this.emitAll("reconnect",t)}},function(t,e,n){t.exports=n(14),t.exports.parser=n(21)},function(t,e,n){(function(e){function r(t,n){if(!(this instanceof r))return new r(t,n);n=n||{},t&&"object"==typeof t&&(n=t,t=null),t?(t=p(t),n.hostname=t.host,n.secure="https"===t.protocol||"wss"===t.protocol,n.port=t.port,t.query&&(n.query=t.query)):n.host&&(n.hostname=p(n.host).host),this.secure=null!=n.secure?n.secure:e.location&&"https:"===location.protocol,n.hostname&&!n.port&&(n.port=this.secure?"443":"80"),this.agent=n.agent||!1,this.hostname=n.hostname||(e.location?location.hostname:"localhost"),this.port=n.port||(e.location&&location.port?location.port:this.secure?443:80),this.query=n.query||{},"string"==typeof this.query&&(this.query=h.decode(this.query)),this.upgrade=!1!==n.upgrade,this.path=(n.path||"/engine.io").replace(/\/$/,"")+"/",this.forceJSONP=!!n.forceJSONP,this.jsonp=!1!==n.jsonp,this.forceBase64=!!n.forceBase64,this.enablesXDR=!!n.enablesXDR,this.timestampParam=n.timestampParam||"t",this.timestampRequests=n.timestampRequests,this.transports=n.transports||["polling","websocket"],this.transportOptions=n.transportOptions||{},this.readyState="",this.writeBuffer=[],this.prevBufferLen=0,this.policyPort=n.policyPort||843,this.rememberUpgrade=n.rememberUpgrade||!1,this.binaryType=null,this.onlyBinaryUpgrades=n.onlyBinaryUpgrades,this.perMessageDeflate=!1!==n.perMessageDeflate&&(n.perMessageDeflate||{}),!0===this.perMessageDeflate&&(this.perMessageDeflate={}),this.perMessageDeflate&&null==this.perMessageDeflate.threshold&&(this.perMessageDeflate.threshold=1024),this.pfx=n.pfx||null,this.key=n.key||null,this.passphrase=n.passphrase||null,this.cert=n.cert||null,this.ca=n.ca||null,this.ciphers=n.ciphers||null,this.rejectUnauthorized=void 0===n.rejectUnauthorized||n.rejectUnauthorized,this.forceNode=!!n.forceNode;var o="object"==typeof e&&e;o.global===o&&(n.extraHeaders&&Object.keys(n.extraHeaders).length>0&&(this.extraHeaders=n.extraHeaders),n.localAddress&&(this.localAddress=n.localAddress)),this.id=null,this.upgrades=null,this.pingInterval=null,this.pingTimeout=null,this.pingIntervalTimer=null,this.pingTimeoutTimer=null,this.open()}function o(t){var e={};for(var n in t)t.hasOwnProperty(n)&&(e[n]=t[n]);return e}var i=n(15),s=n(8),a=n(3)("engine.io-client:socket"),c=n(36),u=n(21),p=n(2),h=n(30);t.exports=r,r.priorWebsocketSuccess=!1,s(r.prototype),r.protocol=u.protocol,r.Socket=r,r.Transport=n(20),r.transports=n(15),r.parser=n(21),r.prototype.createTransport=function(t){a('creating transport "%s"',t);var e=o(this.query);e.EIO=u.protocol,e.transport=t;var n=this.transportOptions[t]||{};this.id&&(e.sid=this.id);var r=new i[t]({query:e,socket:this,agent:n.agent||this.agent,hostname:n.hostname||this.hostname,port:n.port||this.port,secure:n.secure||this.secure,path:n.path||this.path,forceJSONP:n.forceJSONP||this.forceJSONP,jsonp:n.jsonp||this.jsonp,forceBase64:n.forceBase64||this.forceBase64,enablesXDR:n.enablesXDR||this.enablesXDR,timestampRequests:n.timestampRequests||this.timestampRequests,timestampParam:n.timestampParam||this.timestampParam,policyPort:n.policyPort||this.policyPort,pfx:n.pfx||this.pfx,key:n.key||this.key,passphrase:n.passphrase||this.passphrase,cert:n.cert||this.cert,ca:n.ca||this.ca,ciphers:n.ciphers||this.ciphers,rejectUnauthorized:n.rejectUnauthorized||this.rejectUnauthorized,perMessageDeflate:n.perMessageDeflate||this.perMessageDeflate,extraHeaders:n.extraHeaders||this.extraHeaders,forceNode:n.forceNode||this.forceNode,localAddress:n.localAddress||this.localAddress,requestTimeout:n.requestTimeout||this.requestTimeout,protocols:n.protocols||void 0});return r},r.prototype.open=function(){var t;if(this.rememberUpgrade&&r.priorWebsocketSuccess&&this.transports.indexOf("websocket")!==-1)t="websocket";else{if(0===this.transports.length){var e=this;return void setTimeout(function(){e.emit("error","No transports available")},0)}t=this.transports[0]}this.readyState="opening";try{t=this.createTransport(t)}catch(n){return this.transports.shift(),void this.open()}t.open(),this.setTransport(t)},r.prototype.setTransport=function(t){a("setting transport %s",t.name);var e=this;this.transport&&(a("clearing existing transport %s",this.transport.name),this.transport.removeAllListeners()),this.transport=t,t.on("drain",function(){e.onDrain()}).on("packet",function(t){e.onPacket(t)}).on("error",function(t){e.onError(t)}).on("close",function(){e.onClose("transport close")})},r.prototype.probe=function(t){function e(){if(f.onlyBinaryUpgrades){var e=!this.supportsBinary&&f.transport.supportsBinary;h=h||e}h||(a('probe transport "%s" opened',t),p.send([{type:"ping",data:"probe"}]),p.once("packet",function(e){if(!h)if("pong"===e.type&&"probe"===e.data){if(a('probe transport "%s" pong',t),f.upgrading=!0,f.emit("upgrading",p),!p)return;r.priorWebsocketSuccess="websocket"===p.name,a('pausing current transport "%s"',f.transport.name),f.transport.pause(function(){h||"closed"!==f.readyState&&(a("changing transport and sending upgrade packet"),u(),f.setTransport(p),p.send([{type:"upgrade"}]),f.emit("upgrade",p),p=null,f.upgrading=!1,f.flush())})}else{a('probe transport "%s" failed',t);var n=new Error("probe error");n.transport=p.name,f.emit("upgradeError",n)}}))}function n(){h||(h=!0,u(),p.close(),p=null)}function o(e){var r=new Error("probe error: "+e);r.transport=p.name,n(),a('probe transport "%s" failed because of error: %s',t,e),f.emit("upgradeError",r)}function i(){o("transport closed")}function s(){o("socket closed")}function c(t){p&&t.name!==p.name&&(a('"%s" works - aborting "%s"',t.name,p.name),n())}function u(){p.removeListener("open",e),p.removeListener("error",o),p.removeListener("close",i),f.removeListener("close",s),f.removeListener("upgrading",c)}a('probing transport "%s"',t);var p=this.createTransport(t,{probe:1}),h=!1,f=this;r.priorWebsocketSuccess=!1,p.once("open",e),p.once("error",o),p.once("close",i),this.once("close",s),this.once("upgrading",c),p.open()},r.prototype.onOpen=function(){if(a("socket open"),this.readyState="open",r.priorWebsocketSuccess="websocket"===this.transport.name,this.emit("open"),this.flush(),"open"===this.readyState&&this.upgrade&&this.transport.pause){a("starting upgrade probes");for(var t=0,e=this.upgrades.length;t<e;t++)this.probe(this.upgrades[t])}},r.prototype.onPacket=function(t){if("opening"===this.readyState||"open"===this.readyState||"closing"===this.readyState)switch(a('socket receive: type "%s", data "%s"',t.type,t.data),this.emit("packet",t),this.emit("heartbeat"),t.type){case"open":this.onHandshake(JSON.parse(t.data));break;case"pong":this.setPing(),this.emit("pong");break;case"error":var e=new Error("server error");e.code=t.data,this.onError(e);break;case"message":this.emit("data",t.data),this.emit("message",t.data)}else a('packet received with socket readyState "%s"',this.readyState)},r.prototype.onHandshake=function(t){this.emit("handshake",t),this.id=t.sid,this.transport.query.sid=t.sid,this.upgrades=this.filterUpgrades(t.upgrades),this.pingInterval=t.pingInterval,this.pingTimeout=t.pingTimeout,this.onOpen(),"closed"!==this.readyState&&(this.setPing(),this.removeListener("heartbeat",this.onHeartbeat),this.on("heartbeat",this.onHeartbeat))},r.prototype.onHeartbeat=function(t){clearTimeout(this.pingTimeoutTimer);var e=this;e.pingTimeoutTimer=setTimeout(function(){"closed"!==e.readyState&&e.onClose("ping timeout")},t||e.pingInterval+e.pingTimeout)},r.prototype.setPing=function(){var t=this;clearTimeout(t.pingIntervalTimer),t.pingIntervalTimer=setTimeout(function(){a("writing ping packet - expecting pong within %sms",t.pingTimeout),t.ping(),t.onHeartbeat(t.pingTimeout)},t.pingInterval)},r.prototype.ping=function(){var t=this;this.sendPacket("ping",function(){t.emit("ping")})},r.prototype.onDrain=function(){this.writeBuffer.splice(0,this.prevBufferLen),this.prevBufferLen=0,0===this.writeBuffer.length?this.emit("drain"):this.flush()},r.prototype.flush=function(){"closed"!==this.readyState&&this.transport.writable&&!this.upgrading&&this.writeBuffer.length&&(a("flushing %d packets in socket",this.writeBuffer.length),this.transport.send(this.writeBuffer),this.prevBufferLen=this.writeBuffer.length,this.emit("flush"))},r.prototype.write=r.prototype.send=function(t,e,n){return this.sendPacket("message",t,e,n),this},r.prototype.sendPacket=function(t,e,n,r){if("function"==typeof e&&(r=e,e=void 0),"function"==typeof n&&(r=n,n=null),"closing"!==this.readyState&&"closed"!==this.readyState){n=n||{},n.compress=!1!==n.compress;var o={type:t,data:e,options:n};this.emit("packetCreate",o),this.writeBuffer.push(o),r&&this.once("flush",r),this.flush()}},r.prototype.close=function(){function t(){r.onClose("forced close"),a("socket closing - telling transport to close"),r.transport.close()}function e(){r.removeListener("upgrade",e),r.removeListener("upgradeError",e),t()}function n(){r.once("upgrade",e),r.once("upgradeError",e)}if("opening"===this.readyState||"open"===this.readyState){this.readyState="closing";var r=this;this.writeBuffer.length?this.once("drain",function(){this.upgrading?n():t()}):this.upgrading?n():t()}return this},r.prototype.onError=function(t){a("socket error %j",t),r.priorWebsocketSuccess=!1,this.emit("error",t),this.onClose("transport error",t)},r.prototype.onClose=function(t,e){if("opening"===this.readyState||"open"===this.readyState||"closing"===this.readyState){a('socket close with reason: "%s"',t);var n=this;clearTimeout(this.pingIntervalTimer),clearTimeout(this.pingTimeoutTimer),this.transport.removeAllListeners("close"),this.transport.close(),this.transport.removeAllListeners(),this.readyState="closed",this.id=null,this.emit("close",t,e),n.writeBuffer=[],n.prevBufferLen=0}},r.prototype.filterUpgrades=function(t){for(var e=[],n=0,r=t.length;n<r;n++)~c(this.transports,t[n])&&e.push(t[n]);return e}}).call(e,function(){return this}())},function(t,e,n){(function(t){function r(e){var n,r=!1,a=!1,c=!1!==e.jsonp;if(t.location){var u="https:"===location.protocol,p=location.port;
p||(p=u?443:80),r=e.hostname!==location.hostname||p!==e.port,a=e.secure!==u}if(e.xdomain=r,e.xscheme=a,n=new o(e),"open"in n&&!e.forceJSONP)return new i(e);if(!c)throw new Error("JSONP disabled");return new s(e)}var o=n(16),i=n(18),s=n(33),a=n(34);e.polling=r,e.websocket=a}).call(e,function(){return this}())},function(t,e,n){(function(e){var r=n(17);t.exports=function(t){var n=t.xdomain,o=t.xscheme,i=t.enablesXDR;try{if("undefined"!=typeof XMLHttpRequest&&(!n||r))return new XMLHttpRequest}catch(s){}try{if("undefined"!=typeof XDomainRequest&&!o&&i)return new XDomainRequest}catch(s){}if(!n)try{return new(e[["Active"].concat("Object").join("X")])("Microsoft.XMLHTTP")}catch(s){}}}).call(e,function(){return this}())},function(t,e){try{t.exports="undefined"!=typeof XMLHttpRequest&&"withCredentials"in new XMLHttpRequest}catch(n){t.exports=!1}},function(t,e,n){(function(e){function r(){}function o(t){if(c.call(this,t),this.requestTimeout=t.requestTimeout,this.extraHeaders=t.extraHeaders,e.location){var n="https:"===location.protocol,r=location.port;r||(r=n?443:80),this.xd=t.hostname!==e.location.hostname||r!==t.port,this.xs=t.secure!==n}}function i(t){this.method=t.method||"GET",this.uri=t.uri,this.xd=!!t.xd,this.xs=!!t.xs,this.async=!1!==t.async,this.data=void 0!==t.data?t.data:null,this.agent=t.agent,this.isBinary=t.isBinary,this.supportsBinary=t.supportsBinary,this.enablesXDR=t.enablesXDR,this.requestTimeout=t.requestTimeout,this.pfx=t.pfx,this.key=t.key,this.passphrase=t.passphrase,this.cert=t.cert,this.ca=t.ca,this.ciphers=t.ciphers,this.rejectUnauthorized=t.rejectUnauthorized,this.extraHeaders=t.extraHeaders,this.create()}function s(){for(var t in i.requests)i.requests.hasOwnProperty(t)&&i.requests[t].abort()}var a=n(16),c=n(19),u=n(8),p=n(31),h=n(3)("engine.io-client:polling-xhr");t.exports=o,t.exports.Request=i,p(o,c),o.prototype.supportsBinary=!0,o.prototype.request=function(t){return t=t||{},t.uri=this.uri(),t.xd=this.xd,t.xs=this.xs,t.agent=this.agent||!1,t.supportsBinary=this.supportsBinary,t.enablesXDR=this.enablesXDR,t.pfx=this.pfx,t.key=this.key,t.passphrase=this.passphrase,t.cert=this.cert,t.ca=this.ca,t.ciphers=this.ciphers,t.rejectUnauthorized=this.rejectUnauthorized,t.requestTimeout=this.requestTimeout,t.extraHeaders=this.extraHeaders,new i(t)},o.prototype.doWrite=function(t,e){var n="string"!=typeof t&&void 0!==t,r=this.request({method:"POST",data:t,isBinary:n}),o=this;r.on("success",e),r.on("error",function(t){o.onError("xhr post error",t)}),this.sendXhr=r},o.prototype.doPoll=function(){h("xhr poll");var t=this.request(),e=this;t.on("data",function(t){e.onData(t)}),t.on("error",function(t){e.onError("xhr poll error",t)}),this.pollXhr=t},u(i.prototype),i.prototype.create=function(){var t={agent:this.agent,xdomain:this.xd,xscheme:this.xs,enablesXDR:this.enablesXDR};t.pfx=this.pfx,t.key=this.key,t.passphrase=this.passphrase,t.cert=this.cert,t.ca=this.ca,t.ciphers=this.ciphers,t.rejectUnauthorized=this.rejectUnauthorized;var n=this.xhr=new a(t),r=this;try{h("xhr open %s: %s",this.method,this.uri),n.open(this.method,this.uri,this.async);try{if(this.extraHeaders){n.setDisableHeaderCheck&&n.setDisableHeaderCheck(!0);for(var o in this.extraHeaders)this.extraHeaders.hasOwnProperty(o)&&n.setRequestHeader(o,this.extraHeaders[o])}}catch(s){}if("POST"===this.method)try{this.isBinary?n.setRequestHeader("Content-type","application/octet-stream"):n.setRequestHeader("Content-type","text/plain;charset=UTF-8")}catch(s){}try{n.setRequestHeader("Accept","*/*")}catch(s){}"withCredentials"in n&&(n.withCredentials=!0),this.requestTimeout&&(n.timeout=this.requestTimeout),this.hasXDR()?(n.onload=function(){r.onLoad()},n.onerror=function(){r.onError(n.responseText)}):n.onreadystatechange=function(){if(2===n.readyState)try{var t=n.getResponseHeader("Content-Type");r.supportsBinary&&"application/octet-stream"===t&&(n.responseType="arraybuffer")}catch(e){}4===n.readyState&&(200===n.status||1223===n.status?r.onLoad():setTimeout(function(){r.onError(n.status)},0))},h("xhr data %s",this.data),n.send(this.data)}catch(s){return void setTimeout(function(){r.onError(s)},0)}e.document&&(this.index=i.requestsCount++,i.requests[this.index]=this)},i.prototype.onSuccess=function(){this.emit("success"),this.cleanup()},i.prototype.onData=function(t){this.emit("data",t),this.onSuccess()},i.prototype.onError=function(t){this.emit("error",t),this.cleanup(!0)},i.prototype.cleanup=function(t){if("undefined"!=typeof this.xhr&&null!==this.xhr){if(this.hasXDR()?this.xhr.onload=this.xhr.onerror=r:this.xhr.onreadystatechange=r,t)try{this.xhr.abort()}catch(n){}e.document&&delete i.requests[this.index],this.xhr=null}},i.prototype.onLoad=function(){var t;try{var e;try{e=this.xhr.getResponseHeader("Content-Type")}catch(n){}t="application/octet-stream"===e?this.xhr.response||this.xhr.responseText:this.xhr.responseText}catch(n){this.onError(n)}null!=t&&this.onData(t)},i.prototype.hasXDR=function(){return"undefined"!=typeof e.XDomainRequest&&!this.xs&&this.enablesXDR},i.prototype.abort=function(){this.cleanup()},i.requestsCount=0,i.requests={},e.document&&(e.attachEvent?e.attachEvent("onunload",s):e.addEventListener&&e.addEventListener("beforeunload",s,!1))}).call(e,function(){return this}())},function(t,e,n){function r(t){var e=t&&t.forceBase64;p&&!e||(this.supportsBinary=!1),o.call(this,t)}var o=n(20),i=n(30),s=n(21),a=n(31),c=n(32),u=n(3)("engine.io-client:polling");t.exports=r;var p=function(){var t=n(16),e=new t({xdomain:!1});return null!=e.responseType}();a(r,o),r.prototype.name="polling",r.prototype.doOpen=function(){this.poll()},r.prototype.pause=function(t){function e(){u("paused"),n.readyState="paused",t()}var n=this;if(this.readyState="pausing",this.polling||!this.writable){var r=0;this.polling&&(u("we are currently polling - waiting to pause"),r++,this.once("pollComplete",function(){u("pre-pause polling complete"),--r||e()})),this.writable||(u("we are currently writing - waiting to pause"),r++,this.once("drain",function(){u("pre-pause writing complete"),--r||e()}))}else e()},r.prototype.poll=function(){u("polling"),this.polling=!0,this.doPoll(),this.emit("poll")},r.prototype.onData=function(t){var e=this;u("polling got data %s",t);var n=function(t,n,r){return"opening"===e.readyState&&e.onOpen(),"close"===t.type?(e.onClose(),!1):void e.onPacket(t)};s.decodePayload(t,this.socket.binaryType,n),"closed"!==this.readyState&&(this.polling=!1,this.emit("pollComplete"),"open"===this.readyState?this.poll():u('ignoring poll - transport state "%s"',this.readyState))},r.prototype.doClose=function(){function t(){u("writing close packet"),e.write([{type:"close"}])}var e=this;"open"===this.readyState?(u("transport open - closing"),t()):(u("transport not open - deferring close"),this.once("open",t))},r.prototype.write=function(t){var e=this;this.writable=!1;var n=function(){e.writable=!0,e.emit("drain")};s.encodePayload(t,this.supportsBinary,function(t){e.doWrite(t,n)})},r.prototype.uri=function(){var t=this.query||{},e=this.secure?"https":"http",n="";!1!==this.timestampRequests&&(t[this.timestampParam]=c()),this.supportsBinary||t.sid||(t.b64=1),t=i.encode(t),this.port&&("https"===e&&443!==Number(this.port)||"http"===e&&80!==Number(this.port))&&(n=":"+this.port),t.length&&(t="?"+t);var r=this.hostname.indexOf(":")!==-1;return e+"://"+(r?"["+this.hostname+"]":this.hostname)+n+this.path+t}},function(t,e,n){function r(t){this.path=t.path,this.hostname=t.hostname,this.port=t.port,this.secure=t.secure,this.query=t.query,this.timestampParam=t.timestampParam,this.timestampRequests=t.timestampRequests,this.readyState="",this.agent=t.agent||!1,this.socket=t.socket,this.enablesXDR=t.enablesXDR,this.pfx=t.pfx,this.key=t.key,this.passphrase=t.passphrase,this.cert=t.cert,this.ca=t.ca,this.ciphers=t.ciphers,this.rejectUnauthorized=t.rejectUnauthorized,this.forceNode=t.forceNode,this.extraHeaders=t.extraHeaders,this.localAddress=t.localAddress}var o=n(21),i=n(8);t.exports=r,i(r.prototype),r.prototype.onError=function(t,e){var n=new Error(t);return n.type="TransportError",n.description=e,this.emit("error",n),this},r.prototype.open=function(){return"closed"!==this.readyState&&""!==this.readyState||(this.readyState="opening",this.doOpen()),this},r.prototype.close=function(){return"opening"!==this.readyState&&"open"!==this.readyState||(this.doClose(),this.onClose()),this},r.prototype.send=function(t){if("open"!==this.readyState)throw new Error("Transport not open");this.write(t)},r.prototype.onOpen=function(){this.readyState="open",this.writable=!0,this.emit("open")},r.prototype.onData=function(t){var e=o.decodePacket(t,this.socket.binaryType);this.onPacket(e)},r.prototype.onPacket=function(t){this.emit("packet",t)},r.prototype.onClose=function(){this.readyState="closed",this.emit("close")}},function(t,e,n){(function(t){function r(t,n){var r="b"+e.packets[t.type]+t.data.data;return n(r)}function o(t,n,r){if(!n)return e.encodeBase64Packet(t,r);var o=t.data,i=new Uint8Array(o),s=new Uint8Array(1+o.byteLength);s[0]=v[t.type];for(var a=0;a<i.length;a++)s[a+1]=i[a];return r(s.buffer)}function i(t,n,r){if(!n)return e.encodeBase64Packet(t,r);var o=new FileReader;return o.onload=function(){t.data=o.result,e.encodePacket(t,n,!0,r)},o.readAsArrayBuffer(t.data)}function s(t,n,r){if(!n)return e.encodeBase64Packet(t,r);if(g)return i(t,n,r);var o=new Uint8Array(1);o[0]=v[t.type];var s=new k([o.buffer,t.data]);return r(s)}function a(t){try{t=d.decode(t,{strict:!1})}catch(e){return!1}return t}function c(t,e,n){for(var r=new Array(t.length),o=l(t.length,n),i=function(t,n,o){e(n,function(e,n){r[t]=n,o(e,r)})},s=0;s<t.length;s++)i(s,t[s],o)}var u,p=n(22),h=n(23),f=n(24),l=n(25),d=n(26);t&&t.ArrayBuffer&&(u=n(28));var y="undefined"!=typeof navigator&&/Android/i.test(navigator.userAgent),m="undefined"!=typeof navigator&&/PhantomJS/i.test(navigator.userAgent),g=y||m;e.protocol=3;var v=e.packets={open:0,close:1,ping:2,pong:3,message:4,upgrade:5,noop:6},b=p(v),w={type:"error",data:"parser error"},k=n(29);e.encodePacket=function(e,n,i,a){"function"==typeof n&&(a=n,n=!1),"function"==typeof i&&(a=i,i=null);var c=void 0===e.data?void 0:e.data.buffer||e.data;if(t.ArrayBuffer&&c instanceof ArrayBuffer)return o(e,n,a);if(k&&c instanceof t.Blob)return s(e,n,a);if(c&&c.base64)return r(e,a);var u=v[e.type];return void 0!==e.data&&(u+=i?d.encode(String(e.data),{strict:!1}):String(e.data)),a(""+u)},e.encodeBase64Packet=function(n,r){var o="b"+e.packets[n.type];if(k&&n.data instanceof t.Blob){var i=new FileReader;return i.onload=function(){var t=i.result.split(",")[1];r(o+t)},i.readAsDataURL(n.data)}var s;try{s=String.fromCharCode.apply(null,new Uint8Array(n.data))}catch(a){for(var c=new Uint8Array(n.data),u=new Array(c.length),p=0;p<c.length;p++)u[p]=c[p];s=String.fromCharCode.apply(null,u)}return o+=t.btoa(s),r(o)},e.decodePacket=function(t,n,r){if(void 0===t)return w;if("string"==typeof t){if("b"===t.charAt(0))return e.decodeBase64Packet(t.substr(1),n);if(r&&(t=a(t),t===!1))return w;var o=t.charAt(0);return Number(o)==o&&b[o]?t.length>1?{type:b[o],data:t.substring(1)}:{type:b[o]}:w}var i=new Uint8Array(t),o=i[0],s=f(t,1);return k&&"blob"===n&&(s=new k([s])),{type:b[o],data:s}},e.decodeBase64Packet=function(t,e){var n=b[t.charAt(0)];if(!u)return{type:n,data:{base64:!0,data:t.substr(1)}};var r=u.decode(t.substr(1));return"blob"===e&&k&&(r=new k([r])),{type:n,data:r}},e.encodePayload=function(t,n,r){function o(t){return t.length+":"+t}function i(t,r){e.encodePacket(t,!!s&&n,!1,function(t){r(null,o(t))})}"function"==typeof n&&(r=n,n=null);var s=h(t);return n&&s?k&&!g?e.encodePayloadAsBlob(t,r):e.encodePayloadAsArrayBuffer(t,r):t.length?void c(t,i,function(t,e){return r(e.join(""))}):r("0:")},e.decodePayload=function(t,n,r){if("string"!=typeof t)return e.decodePayloadAsBinary(t,n,r);"function"==typeof n&&(r=n,n=null);var o;if(""===t)return r(w,0,1);for(var i,s,a="",c=0,u=t.length;c<u;c++){var p=t.charAt(c);if(":"===p){if(""===a||a!=(i=Number(a)))return r(w,0,1);if(s=t.substr(c+1,i),a!=s.length)return r(w,0,1);if(s.length){if(o=e.decodePacket(s,n,!1),w.type===o.type&&w.data===o.data)return r(w,0,1);var h=r(o,c+i,u);if(!1===h)return}c+=i,a=""}else a+=p}return""!==a?r(w,0,1):void 0},e.encodePayloadAsArrayBuffer=function(t,n){function r(t,n){e.encodePacket(t,!0,!0,function(t){return n(null,t)})}return t.length?void c(t,r,function(t,e){var r=e.reduce(function(t,e){var n;return n="string"==typeof e?e.length:e.byteLength,t+n.toString().length+n+2},0),o=new Uint8Array(r),i=0;return e.forEach(function(t){var e="string"==typeof t,n=t;if(e){for(var r=new Uint8Array(t.length),s=0;s<t.length;s++)r[s]=t.charCodeAt(s);n=r.buffer}e?o[i++]=0:o[i++]=1;for(var a=n.byteLength.toString(),s=0;s<a.length;s++)o[i++]=parseInt(a[s]);o[i++]=255;for(var r=new Uint8Array(n),s=0;s<r.length;s++)o[i++]=r[s]}),n(o.buffer)}):n(new ArrayBuffer(0))},e.encodePayloadAsBlob=function(t,n){function r(t,n){e.encodePacket(t,!0,!0,function(t){var e=new Uint8Array(1);if(e[0]=1,"string"==typeof t){for(var r=new Uint8Array(t.length),o=0;o<t.length;o++)r[o]=t.charCodeAt(o);t=r.buffer,e[0]=0}for(var i=t instanceof ArrayBuffer?t.byteLength:t.size,s=i.toString(),a=new Uint8Array(s.length+1),o=0;o<s.length;o++)a[o]=parseInt(s[o]);if(a[s.length]=255,k){var c=new k([e.buffer,a.buffer,t]);n(null,c)}})}c(t,r,function(t,e){return n(new k(e))})},e.decodePayloadAsBinary=function(t,n,r){"function"==typeof n&&(r=n,n=null);for(var o=t,i=[];o.byteLength>0;){for(var s=new Uint8Array(o),a=0===s[0],c="",u=1;255!==s[u];u++){if(c.length>310)return r(w,0,1);c+=s[u]}o=f(o,2+c.length),c=parseInt(c);var p=f(o,0,c);if(a)try{p=String.fromCharCode.apply(null,new Uint8Array(p))}catch(h){var l=new Uint8Array(p);p="";for(var u=0;u<l.length;u++)p+=String.fromCharCode(l[u])}i.push(p),o=f(o,c)}var d=i.length;i.forEach(function(t,o){r(e.decodePacket(t,n,!0),o,d)})}}).call(e,function(){return this}())},function(t,e){t.exports=Object.keys||function(t){var e=[],n=Object.prototype.hasOwnProperty;for(var r in t)n.call(t,r)&&e.push(r);return e}},function(t,e,n){(function(e){function r(t){if(!t||"object"!=typeof t)return!1;if(o(t)){for(var n=0,i=t.length;n<i;n++)if(r(t[n]))return!0;return!1}if("function"==typeof e.Buffer&&e.Buffer.isBuffer&&e.Buffer.isBuffer(t)||"function"==typeof e.ArrayBuffer&&t instanceof ArrayBuffer||s&&t instanceof Blob||a&&t instanceof File)return!0;if(t.toJSON&&"function"==typeof t.toJSON&&1===arguments.length)return r(t.toJSON(),!0);for(var c in t)if(Object.prototype.hasOwnProperty.call(t,c)&&r(t[c]))return!0;return!1}var o=n(10),i=Object.prototype.toString,s="function"==typeof e.Blob||"[object BlobConstructor]"===i.call(e.Blob),a="function"==typeof e.File||"[object FileConstructor]"===i.call(e.File);t.exports=r}).call(e,function(){return this}())},function(t,e){t.exports=function(t,e,n){var r=t.byteLength;if(e=e||0,n=n||r,t.slice)return t.slice(e,n);if(e<0&&(e+=r),n<0&&(n+=r),n>r&&(n=r),e>=r||e>=n||0===r)return new ArrayBuffer(0);for(var o=new Uint8Array(t),i=new Uint8Array(n-e),s=e,a=0;s<n;s++,a++)i[a]=o[s];return i.buffer}},function(t,e){function n(t,e,n){function o(t,r){if(o.count<=0)throw new Error("after called too many times");--o.count,t?(i=!0,e(t),e=n):0!==o.count||i||e(null,r)}var i=!1;return n=n||r,o.count=t,0===t?e():o}function r(){}t.exports=n},function(t,e,n){var r;(function(t,o){!function(i){function s(t){for(var e,n,r=[],o=0,i=t.length;o<i;)e=t.charCodeAt(o++),e>=55296&&e<=56319&&o<i?(n=t.charCodeAt(o++),56320==(64512&n)?r.push(((1023&e)<<10)+(1023&n)+65536):(r.push(e),o--)):r.push(e);return r}function a(t){for(var e,n=t.length,r=-1,o="";++r<n;)e=t[r],e>65535&&(e-=65536,o+=w(e>>>10&1023|55296),e=56320|1023&e),o+=w(e);return o}function c(t,e){if(t>=55296&&t<=57343){if(e)throw Error("Lone surrogate U+"+t.toString(16).toUpperCase()+" is not a scalar value");return!1}return!0}function u(t,e){return w(t>>e&63|128)}function p(t,e){if(0==(4294967168&t))return w(t);var n="";return 0==(4294965248&t)?n=w(t>>6&31|192):0==(4294901760&t)?(c(t,e)||(t=65533),n=w(t>>12&15|224),n+=u(t,6)):0==(4292870144&t)&&(n=w(t>>18&7|240),n+=u(t,12),n+=u(t,6)),n+=w(63&t|128)}function h(t,e){e=e||{};for(var n,r=!1!==e.strict,o=s(t),i=o.length,a=-1,c="";++a<i;)n=o[a],c+=p(n,r);return c}function f(){if(b>=v)throw Error("Invalid byte index");var t=255&g[b];if(b++,128==(192&t))return 63&t;throw Error("Invalid continuation byte")}function l(t){var e,n,r,o,i;if(b>v)throw Error("Invalid byte index");if(b==v)return!1;if(e=255&g[b],b++,0==(128&e))return e;if(192==(224&e)){if(n=f(),i=(31&e)<<6|n,i>=128)return i;throw Error("Invalid continuation byte")}if(224==(240&e)){if(n=f(),r=f(),i=(15&e)<<12|n<<6|r,i>=2048)return c(i,t)?i:65533;throw Error("Invalid continuation byte")}if(240==(248&e)&&(n=f(),r=f(),o=f(),i=(7&e)<<18|n<<12|r<<6|o,i>=65536&&i<=1114111))return i;throw Error("Invalid UTF-8 detected")}function d(t,e){e=e||{};var n=!1!==e.strict;g=s(t),v=g.length,b=0;for(var r,o=[];(r=l(n))!==!1;)o.push(r);return a(o)}var y="object"==typeof e&&e,m=("object"==typeof t&&t&&t.exports==y&&t,"object"==typeof o&&o);m.global!==m&&m.window!==m||(i=m);var g,v,b,w=String.fromCharCode,k={version:"2.1.2",encode:h,decode:d};r=function(){return k}.call(e,n,e,t),!(void 0!==r&&(t.exports=r))}(this)}).call(e,n(27)(t),function(){return this}())},function(t,e){t.exports=function(t){return t.webpackPolyfill||(t.deprecate=function(){},t.paths=[],t.children=[],t.webpackPolyfill=1),t}},function(t,e){!function(){"use strict";for(var t="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",n=new Uint8Array(256),r=0;r<t.length;r++)n[t.charCodeAt(r)]=r;e.encode=function(e){var n,r=new Uint8Array(e),o=r.length,i="";for(n=0;n<o;n+=3)i+=t[r[n]>>2],i+=t[(3&r[n])<<4|r[n+1]>>4],i+=t[(15&r[n+1])<<2|r[n+2]>>6],i+=t[63&r[n+2]];return o%3===2?i=i.substring(0,i.length-1)+"=":o%3===1&&(i=i.substring(0,i.length-2)+"=="),i},e.decode=function(t){var e,r,o,i,s,a=.75*t.length,c=t.length,u=0;"="===t[t.length-1]&&(a--,"="===t[t.length-2]&&a--);var p=new ArrayBuffer(a),h=new Uint8Array(p);for(e=0;e<c;e+=4)r=n[t.charCodeAt(e)],o=n[t.charCodeAt(e+1)],i=n[t.charCodeAt(e+2)],s=n[t.charCodeAt(e+3)],h[u++]=r<<2|o>>4,h[u++]=(15&o)<<4|i>>2,h[u++]=(3&i)<<6|63&s;return p}}()},function(t,e){(function(e){function n(t){for(var e=0;e<t.length;e++){var n=t[e];if(n.buffer instanceof ArrayBuffer){var r=n.buffer;if(n.byteLength!==r.byteLength){var o=new Uint8Array(n.byteLength);o.set(new Uint8Array(r,n.byteOffset,n.byteLength)),r=o.buffer}t[e]=r}}}function r(t,e){e=e||{};var r=new i;n(t);for(var o=0;o<t.length;o++)r.append(t[o]);return e.type?r.getBlob(e.type):r.getBlob()}function o(t,e){return n(t),new Blob(t,e||{})}var i=e.BlobBuilder||e.WebKitBlobBuilder||e.MSBlobBuilder||e.MozBlobBuilder,s=function(){try{var t=new Blob(["hi"]);return 2===t.size}catch(e){return!1}}(),a=s&&function(){try{var t=new Blob([new Uint8Array([1,2])]);return 2===t.size}catch(e){return!1}}(),c=i&&i.prototype.append&&i.prototype.getBlob;t.exports=function(){return s?a?e.Blob:o:c?r:void 0}()}).call(e,function(){return this}())},function(t,e){e.encode=function(t){var e="";for(var n in t)t.hasOwnProperty(n)&&(e.length&&(e+="&"),e+=encodeURIComponent(n)+"="+encodeURIComponent(t[n]));return e},e.decode=function(t){for(var e={},n=t.split("&"),r=0,o=n.length;r<o;r++){var i=n[r].split("=");e[decodeURIComponent(i[0])]=decodeURIComponent(i[1])}return e}},function(t,e){t.exports=function(t,e){var n=function(){};n.prototype=e.prototype,t.prototype=new n,t.prototype.constructor=t}},function(t,e){"use strict";function n(t){var e="";do e=s[t%a]+e,t=Math.floor(t/a);while(t>0);return e}function r(t){var e=0;for(p=0;p<t.length;p++)e=e*a+c[t.charAt(p)];return e}function o(){var t=n(+new Date);return t!==i?(u=0,i=t):t+"."+n(u++)}for(var i,s="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_".split(""),a=64,c={},u=0,p=0;p<a;p++)c[s[p]]=p;o.encode=n,o.decode=r,t.exports=o},function(t,e,n){(function(e){function r(){}function o(t){i.call(this,t),this.query=this.query||{},a||(e.___eio||(e.___eio=[]),a=e.___eio),this.index=a.length;var n=this;a.push(function(t){n.onData(t)}),this.query.j=this.index,e.document&&e.addEventListener&&e.addEventListener("beforeunload",function(){n.script&&(n.script.onerror=r)},!1)}var i=n(19),s=n(31);t.exports=o;var a,c=/\n/g,u=/\\n/g;s(o,i),o.prototype.supportsBinary=!1,o.prototype.doClose=function(){this.script&&(this.script.parentNode.removeChild(this.script),this.script=null),this.form&&(this.form.parentNode.removeChild(this.form),this.form=null,this.iframe=null),i.prototype.doClose.call(this)},o.prototype.doPoll=function(){var t=this,e=document.createElement("script");this.script&&(this.script.parentNode.removeChild(this.script),this.script=null),e.async=!0,e.src=this.uri(),e.onerror=function(e){t.onError("jsonp poll error",e)};var n=document.getElementsByTagName("script")[0];n?n.parentNode.insertBefore(e,n):(document.head||document.body).appendChild(e),this.script=e;var r="undefined"!=typeof navigator&&/gecko/i.test(navigator.userAgent);r&&setTimeout(function(){var t=document.createElement("iframe");document.body.appendChild(t),document.body.removeChild(t)},100)},o.prototype.doWrite=function(t,e){function n(){r(),e()}function r(){if(o.iframe)try{o.form.removeChild(o.iframe)}catch(t){o.onError("jsonp polling iframe removal error",t)}try{var e='<iframe src="javascript:0" name="'+o.iframeId+'">';i=document.createElement(e)}catch(t){i=document.createElement("iframe"),i.name=o.iframeId,i.src="javascript:0"}i.id=o.iframeId,o.form.appendChild(i),o.iframe=i}var o=this;if(!this.form){var i,s=document.createElement("form"),a=document.createElement("textarea"),p=this.iframeId="eio_iframe_"+this.index;s.className="socketio",s.style.position="absolute",s.style.top="-1000px",s.style.left="-1000px",s.target=p,s.method="POST",s.setAttribute("accept-charset","utf-8"),a.name="d",s.appendChild(a),document.body.appendChild(s),this.form=s,this.area=a}this.form.action=this.uri(),r(),t=t.replace(u,"\\\n"),this.area.value=t.replace(c,"\\n");try{this.form.submit()}catch(h){}this.iframe.attachEvent?this.iframe.onreadystatechange=function(){"complete"===o.iframe.readyState&&n()}:this.iframe.onload=n}}).call(e,function(){return this}())},function(t,e,n){(function(e){function r(t){var e=t&&t.forceBase64;e&&(this.supportsBinary=!1),this.perMessageDeflate=t.perMessageDeflate,this.usingBrowserWebSocket=h&&!t.forceNode,this.protocols=t.protocols,this.usingBrowserWebSocket||(l=o),i.call(this,t)}var o,i=n(20),s=n(21),a=n(30),c=n(31),u=n(32),p=n(3)("engine.io-client:websocket"),h=e.WebSocket||e.MozWebSocket;if("undefined"==typeof window)try{o=n(35)}catch(f){}var l=h;l||"undefined"!=typeof window||(l=o),t.exports=r,c(r,i),r.prototype.name="websocket",r.prototype.supportsBinary=!0,r.prototype.doOpen=function(){if(this.check()){var t=this.uri(),e=this.protocols,n={agent:this.agent,perMessageDeflate:this.perMessageDeflate};n.pfx=this.pfx,n.key=this.key,n.passphrase=this.passphrase,n.cert=this.cert,n.ca=this.ca,n.ciphers=this.ciphers,n.rejectUnauthorized=this.rejectUnauthorized,this.extraHeaders&&(n.headers=this.extraHeaders),this.localAddress&&(n.localAddress=this.localAddress);try{this.ws=this.usingBrowserWebSocket?e?new l(t,e):new l(t):new l(t,e,n)}catch(r){return this.emit("error",r)}void 0===this.ws.binaryType&&(this.supportsBinary=!1),this.ws.supports&&this.ws.supports.binary?(this.supportsBinary=!0,this.ws.binaryType="nodebuffer"):this.ws.binaryType="arraybuffer",this.addEventListeners()}},r.prototype.addEventListeners=function(){var t=this;this.ws.onopen=function(){t.onOpen()},this.ws.onclose=function(){t.onClose()},this.ws.onmessage=function(e){t.onData(e.data)},this.ws.onerror=function(e){t.onError("websocket error",e)}},r.prototype.write=function(t){function n(){r.emit("flush"),setTimeout(function(){r.writable=!0,r.emit("drain")},0)}var r=this;this.writable=!1;for(var o=t.length,i=0,a=o;i<a;i++)!function(t){s.encodePacket(t,r.supportsBinary,function(i){if(!r.usingBrowserWebSocket){var s={};if(t.options&&(s.compress=t.options.compress),r.perMessageDeflate){var a="string"==typeof i?e.Buffer.byteLength(i):i.length;a<r.perMessageDeflate.threshold&&(s.compress=!1)}}try{r.usingBrowserWebSocket?r.ws.send(i):r.ws.send(i,s)}catch(c){p("websocket closed before onclose event")}--o||n()})}(t[i])},r.prototype.onClose=function(){i.prototype.onClose.call(this)},r.prototype.doClose=function(){"undefined"!=typeof this.ws&&this.ws.close()},r.prototype.uri=function(){var t=this.query||{},e=this.secure?"wss":"ws",n="";this.port&&("wss"===e&&443!==Number(this.port)||"ws"===e&&80!==Number(this.port))&&(n=":"+this.port),this.timestampRequests&&(t[this.timestampParam]=u()),this.supportsBinary||(t.b64=1),t=a.encode(t),t.length&&(t="?"+t);var r=this.hostname.indexOf(":")!==-1;return e+"://"+(r?"["+this.hostname+"]":this.hostname)+n+this.path+t},r.prototype.check=function(){return!(!l||"__initialize"in l&&this.name===r.prototype.name)}}).call(e,function(){return this}())},function(t,e){},function(t,e){var n=[].indexOf;t.exports=function(t,e){if(n)return t.indexOf(e);for(var r=0;r<t.length;++r)if(t[r]===e)return r;return-1}},function(t,e,n){"use strict";function r(t,e,n){this.io=t,this.nsp=e,this.json=this,this.ids=0,this.acks={},this.receiveBuffer=[],this.sendBuffer=[],this.connected=!1,this.disconnected=!0,this.flags={},n&&n.query&&(this.query=n.query),this.io.autoConnect&&this.open()}var o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},i=n(7),s=n(8),a=n(38),c=n(39),u=n(40),p=n(3)("socket.io-client:socket"),h=n(30),f=n(23);t.exports=e=r;var l={connect:1,connect_error:1,connect_timeout:1,connecting:1,disconnect:1,error:1,reconnect:1,reconnect_attempt:1,reconnect_failed:1,reconnect_error:1,reconnecting:1,ping:1,pong:1},d=s.prototype.emit;s(r.prototype),r.prototype.subEvents=function(){if(!this.subs){var t=this.io;this.subs=[c(t,"open",u(this,"onopen")),c(t,"packet",u(this,"onpacket")),c(t,"close",u(this,"onclose"))]}},r.prototype.open=r.prototype.connect=function(){return this.connected?this:(this.subEvents(),this.io.open(),"open"===this.io.readyState&&this.onopen(),this.emit("connecting"),this)},r.prototype.send=function(){var t=a(arguments);return t.unshift("message"),this.emit.apply(this,t),this},r.prototype.emit=function(t){if(l.hasOwnProperty(t))return d.apply(this,arguments),this;var e=a(arguments),n={type:(void 0!==this.flags.binary?this.flags.binary:f(e))?i.BINARY_EVENT:i.EVENT,data:e};return n.options={},n.options.compress=!this.flags||!1!==this.flags.compress,"function"==typeof e[e.length-1]&&(p("emitting packet with ack id %d",this.ids),this.acks[this.ids]=e.pop(),n.id=this.ids++),this.connected?this.packet(n):this.sendBuffer.push(n),this.flags={},this},r.prototype.packet=function(t){t.nsp=this.nsp,this.io.packet(t)},r.prototype.onopen=function(){if(p("transport is open - connecting"),"/"!==this.nsp)if(this.query){var t="object"===o(this.query)?h.encode(this.query):this.query;p("sending connect packet with query %s",t),this.packet({type:i.CONNECT,query:t})}else this.packet({type:i.CONNECT})},r.prototype.onclose=function(t){p("close (%s)",t),this.connected=!1,this.disconnected=!0,delete this.id,this.emit("disconnect",t)},r.prototype.onpacket=function(t){var e=t.nsp===this.nsp,n=t.type===i.ERROR&&"/"===t.nsp;if(e||n)switch(t.type){case i.CONNECT:this.onconnect();break;case i.EVENT:this.onevent(t);break;case i.BINARY_EVENT:this.onevent(t);break;case i.ACK:this.onack(t);break;case i.BINARY_ACK:this.onack(t);break;case i.DISCONNECT:this.ondisconnect();break;case i.ERROR:this.emit("error",t.data)}},r.prototype.onevent=function(t){var e=t.data||[];p("emitting event %j",e),null!=t.id&&(p("attaching ack callback to event"),e.push(this.ack(t.id))),this.connected?d.apply(this,e):this.receiveBuffer.push(e)},r.prototype.ack=function(t){var e=this,n=!1;return function(){if(!n){n=!0;var r=a(arguments);p("sending ack %j",r),e.packet({type:f(r)?i.BINARY_ACK:i.ACK,id:t,data:r})}}},r.prototype.onack=function(t){var e=this.acks[t.id];"function"==typeof e?(p("calling ack %s with %j",t.id,t.data),e.apply(this,t.data),delete this.acks[t.id]):p("bad ack %s",t.id)},r.prototype.onconnect=function(){this.connected=!0,this.disconnected=!1,this.emit("connect"),this.emitBuffered()},r.prototype.emitBuffered=function(){var t;for(t=0;t<this.receiveBuffer.length;t++)d.apply(this,this.receiveBuffer[t]);for(this.receiveBuffer=[],t=0;t<this.sendBuffer.length;t++)this.packet(this.sendBuffer[t]);this.sendBuffer=[]},r.prototype.ondisconnect=function(){p("server disconnect (%s)",this.nsp),this.destroy(),this.onclose("io server disconnect")},r.prototype.destroy=function(){if(this.subs){for(var t=0;t<this.subs.length;t++)this.subs[t].destroy();this.subs=null}this.io.destroy(this)},r.prototype.close=r.prototype.disconnect=function(){return this.connected&&(p("performing disconnect (%s)",this.nsp),this.packet({type:i.DISCONNECT})),this.destroy(),this.connected&&this.onclose("io client disconnect"),this},r.prototype.compress=function(t){return this.flags.compress=t,this},r.prototype.binary=function(t){return this.flags.binary=t,this}},function(t,e){function n(t,e){var n=[];e=e||0;for(var r=e||0;r<t.length;r++)n[r-e]=t[r];return n}t.exports=n},function(t,e){"use strict";function n(t,e,n){return t.on(e,n),{destroy:function(){t.removeListener(e,n)}}}t.exports=n},function(t,e){var n=[].slice;t.exports=function(t,e){if("string"==typeof e&&(e=t[e]),"function"!=typeof e)throw new Error("bind() requires a function");var r=n.call(arguments,2);return function(){return e.apply(t,r.concat(n.call(arguments)))}}},function(t,e){function n(t){t=t||{},this.ms=t.min||100,this.max=t.max||1e4,this.factor=t.factor||2,this.jitter=t.jitter>0&&t.jitter<=1?t.jitter:0,this.attempts=0}t.exports=n,n.prototype.duration=function(){var t=this.ms*Math.pow(this.factor,this.attempts++);if(this.jitter){var e=Math.random(),n=Math.floor(e*this.jitter*t);t=0==(1&Math.floor(10*e))?t-n:t+n}return 0|Math.min(t,this.max)},n.prototype.reset=function(){this.attempts=0},n.prototype.setMin=function(t){this.ms=t},n.prototype.setMax=function(t){this.max=t},n.prototype.setJitter=function(t){this.jitter=t}}])});

BB = function (t) {
    function t(e, o) {
        this.userSettings = o;
        this.userbbkey = e;
        v.call(this)
        //njs.call(this)
    }

    function v() {
        var e = this.userSettings.host + "/assets/css/chat_widget_style.css";
        var a = document.getElementsByTagName("head")[0];
        l = document.createElement("link");
        l.type = "text/css";
        l.rel = "stylesheet";
        l.href = e;
        a.appendChild(l);
    }
	
    function h(e) {
		hostURL = this.userSettings.host;
		setTimeout(function(){
			bbClientId = document.getElementById('bb_client_id').value;
			bbcp_bg_color = document.getElementById('bbcp_bg_color').value;
			bbContactConfig = document.getElementById('bb_contact_details_config').value;
			sound = document.getElementById("bbcp_audio");
		}, 500);
        var o = [];
        try {
            o = JSON.parse(e);
            if (o.length != undefined) {
                for (var n = -1, i = 0; i < o.length; i++)
                    if ("list" == o[i].method) {
                        n = i;
                        if (this.userSettings.widget == 'chat') {
                            document.getElementsByClassName("bb main-chat-widget")[0].innerHTML = o[n].content;
                        }
                        break
                    }
            } else {
                if (this.userSettings.widget == 'chat') {
                    document.getElementsByClassName("bb main-chat-widget")[0].innerHTML = o.content;
                }
            }
        } catch (r) {
            t.safeConsole(r.message)
        }

    }
	
	 t.prototype.njs = function () {
        var e = this.userSettings.host + "/node_modules/socket.io-client/dist/socket.io.js";
        var a = document.getElementsByTagName("head")[0];
        l = document.createElement("script");
        l.type = "text/javascript";
        l.src = e;
        a.appendChild(l);
    }

    t.prototype.hola = function () {
        alert('called, hola amigo');
    }
	
	t.prototype.getTime = function () {
        var date = new Date();
		var hours = date.getHours();
		var minutes = date.getMinutes();
		var ampm = hours >= 12 ? 'PM' : 'AM';
		hours = hours % 12;
		hours = hours ? hours : 12; // the hour '0' should be '12'
		minutes = minutes < 10 ? '0'+minutes : minutes;
		var strTime = hours + ':' + minutes + ' ' + ampm;
		return strTime;
    }
	
    t.prototype.init_widget = function () {
        if (this.userSettings.widget === 'chat') {
            var t = document.createElement("div");
            t.className = "bb main-chat-widget";
            document.body.appendChild(t);
        }
    }

    t.prototype.display_widget = function () {
        var e = this;
        var bb_key = this.userbbkey;
        var bb_widget_name = this.userSettings.widget;
        var bbsrc = this.userSettings.host + "/webchat/display_chat_widget/" + bb_widget_name + "/" + bb_key;
        var a = {};
        //i = call back function
        //a = POST data
        var i = function (o) {
            //Display Json on browser
            h.call(e, o), e.trigger("ready"), f.call(e);
        };
        t.ajax(bbsrc, i, 'POST', a);
    }
	
	t.prototype.hide_bb_chat_box = function (e) {	
		var x = document.getElementById('bbchatpopup');
		if (x.style.display === "none") {
			
			t.show(x);
			
			showbbchatpopup = 1;
			
			var bc = document.getElementById('bb_chat_unread_counter');
			t.hide(bc);
			
			unreadmsgCounter = 0;
			document.getElementById('bb_chat_unread_counter').innerHTML = unreadmsgCounter;
			
			var b = document.getElementById('bbopenbtn');
			t.hide(b);
			
			var c = document.getElementById('bbclosebtn');
			t.show(c);
			
		} else {
			
			t.hide(x);
			
			showbbchatpopup = '';
			
			var b = document.getElementById('bbopenbtn');
			t.show(b);
			
			var c = document.getElementById('bbclosebtn');
			t.hide(c);
		}
	}
	
	t.prototype.show_bb_chat = function (e) {
		var msgBG;
		var x = document.getElementById('bbchatpopup');
		if (x.style.display === "none") {
			
			t.show(x);
			
			showbbchatpopup = 1;
			
			var bc = document.getElementById('bb_chat_unread_counter');
			t.hide(bc);
			
			unreadmsgCounter = 0;
			document.getElementById('bb_chat_unread_counter').innerHTML = unreadmsgCounter;
			
			var b = document.getElementById('bbopenbtn');
			t.hide(b);
			
			var c = document.getElementById('bbclosebtn');
			t.show(c);
			
		} else {
			
			t.hide(x);
			
			showbbchatpopup = '';
			
			var b = document.getElementById('bbopenbtn');
			t.show(b);
			
			var c = document.getElementById('bbclosebtn');
			t.hide(c);
		}
		
		if(bbvisitortoken !== null){
			//console.log(bbvisitortoken, 'test 1');
			bb_chat_socket.emit('subscribe', bbvisitortoken);
			//var ch = document.getElementById('bb_msg_head');
			var cb = document.getElementById('bb_msg_wrap');
			var ub = document.getElementById('bb_msg_wrap1');
			//t.show(ch);
			t.show(cb);
			t.hide(ub);
			
			var bbsrc = this.userSettings.host + "/webchat/getUserMessages/";
			var a = 'room=' + bbvisitortoken + '&offset=0';
			//i = call back function
			//a = POST data
			var showchatdata = function (o) {
				var rsp = JSON.parse(o);
				if (rsp.status == 'ok') {

					//console.log(rsp);
					showbbdata = 1;
					
					currentUser = rsp.current_user_id;
                    currentSupportName = currentUsername = rsp.currentUsername;

					var result = rsp.res;
					for(var inc = 0; inc < result.length; inc++) {
						msgBG = '1';
						var row = result[inc];
						var newUserTo = row.user_to;
						var newUserFrom = row.user_form;
						var newMessage = row.message;
						var created = row.created;
						

						var messageSmilies = newMessage.match(smileyReg) || [];
						for(var i=0; i<messageSmilies.length; i++) {
							var messageSmiley = messageSmilies[i],
							messageSmileyLower = messageSmiley.toLowerCase();
							if(smiliesMap[messageSmileyLower]) {
								msgBG = '';
								newMessage = newMessage.replace(messageSmiley, "<img src='http://brandboostx.com/assets/img-smile/"+smiliesMap[messageSmileyLower]+".gif' alt='smiley' />");
							}
						}

						var fileext = (/[.]/.exec(newMessage)) ? /[^.]+$/.exec(newMessage) : undefined;
						//console.log('newMessage', newMessage);
						//console.log('fileext', fileext);
						if(typeof fileext != 'undefined' && fileext !== null){
							msgBG = '';
							if(fileext[0] == 'png' || fileext[0] == 'jpg' || fileext[0] == 'jpeg' || fileext[0] == 'gif') {
								newMessage = "<a href='javascript:void(0)' class='bb_image_preview_btn' img-data='"+newMessage+"'><img src='"+newMessage+"' style='width:150px; height:auto;' /></a>";
																
							}else if(fileext[0] == 'doc' || fileext[0] == 'docx' || fileext[0] == 'odt' || fileext[0] == 'csv' || fileext[0] == 'pdf') {
								newMessage = "<a href='"+newMessage+"' target='_blank'>Download '"+fileext[0].toUpperCase()+"' File</a>";
							}
							else if(fileext[0] == 'mp4') {
								newMessage = "<video class='media_file' controls><source src='"+newMessage+"' type='video/"+fileext[0]+"'></video>";
							}
						}
						
						var imgBgColor = '';
						var imgClass = '';
						if(msgBG != 1){
							//imgBgColor = 'style="background:none; padding: 10px 0px; box-shadow:none;"';
							imgClass = 'bb_img_msg_row';
						}

						if(newUserFrom == bbClientId){
						document.getElementsByClassName('bb_msg_push')[0].innerHTML += '<div class="bb_msg"><div class="msg-left '+imgClass+'" '+imgBgColor+'><div class="msg_time">'+created+'</div> ' + newMessage + '</div></div>';
						}
						else {
							document.getElementsByClassName('bb_msg_push')[0].innerHTML += '<div class="bb_msg"><div class="msg-right '+imgClass+' '+bbcp_bg_color+'" '+imgBgColor+'><div class="msg_time">'+created+'</div> ' + newMessage + '</div></div>';
						}
						
						var msgHeight = document.getElementById("bb_msg_body").scrollHeight;
						document.getElementById("bb_msg_body").scrollTop = msgHeight;
					}
				}
			};
			
			if(showbbdata == ''){
				t.ajax(bbsrc, showchatdata, 'POST', a);
			}
		}
	}
		
	t.prototype.show_bb_smiley = function (e) {
		var x = document.getElementById('bb_smiley_box');
		if (x.style.display === "none") {
			t.show(x);
		} else {
			t.hide(x);
		}
	}
	
	t.prototype.bb_show_image_modal_popup = function (e, imageURL) {
		var x = document.getElementById('bb_chat_modal');
		document.getElementById('bb_preview_image').innerHTML = '<img src="'+imageURL+'" style="width:100%; height:auto;">';
		if (x.style.display === "none") {
			t.show(x);
		} else {
			t.hide(x);
		}
	}
	
	t.prototype.bb_close_modal_popup = function (e) {
		var x = document.getElementById('bb_chat_modal');
		t.hide(x);
	}
	
	t.prototype.bb_get_smiley_value = function (e) {
		var smileyVal = e.getAttribute('smiley-data');
		document.getElementById('bb_chat_msg_input').value = smileyVal;
		document.getElementById('bb_smiley_box').style.display = "none";
		document.getElementById('bb_chat_msg_input').focus();
	}
	
	t.prototype.get_bb_attechment_value = function (e) {
		document.getElementById("bb_attechment_file").click();
	}
	
	t.prototype.get_bb_attechment_file = function (e) {	
		document.getElementById("bb_chat_loading").style.display = 'block';
		const files = document.querySelector('[id=bb_attechment_file]').files;
		const bb_client_id = document.getElementById('bb_client_id').value;
		//console.log(files);
		const formData = new FormData();
		
		for (let i = 0; i < files.length; i++) {
			let file = files[i];
			formData.append('files[]', file);
		}
		
		fetch(this.userSettings.host + '/dropzone/upload_s3_attachment/'+ bb_client_id +'/webchat', { 
			method: 'POST',
			body: formData // This is your file object
		}).then(
			response => response.json() // if the response is a JSON object
		).then(success => {
			//console.log(success);
			if(success.error == '') {
				var filename = success.result;
				var fileext = (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
				var msg = 'https://s3-us-west-2.amazonaws.com/brandboost.io/'+filename;
				var newMessage = '';
				
				if(typeof fileext != 'undefined'){
					if(fileext[0] == 'png' || fileext[0] == 'jpg' || fileext[0] == 'jpeg' || fileext[0] == 'gif') {
						newMessage = "<a href='javascript:void(0)' class='bb_image_preview_btn' img-data='"+msg+"'><img src='"+msg+"' style='width:150px; height:auto;' /></a>";
						
						setTimeout(function(){
							if(document.getElementsByClassName('bb_image_preview_btn').length > 0){
								for(var imageCounter = 0; imageCounter < document.getElementsByClassName('bb_image_preview_btn').length; imageCounter++){
									document.getElementsByClassName('bb_image_preview_btn')[imageCounter].addEventListener('click', function () {
										var imageURL = this.getAttribute('img-data');
										bindPopupThisVal.bb_show_image_modal_popup(this, imageURL);
									});
								}
							}
						}, 1000);
						
					}else if(fileext[0] == 'doc' || fileext[0] == 'docx' || fileext[0] == 'odt' || fileext[0] == 'csv' || fileext[0] == 'pdf') {
						newMessage = "<a href='"+msg+"' target='_blank'>Download '"+fileext[0].toUpperCase()+"' File</a>";
					}else if(fileext[0] == 'mp4' || fileext[0] == 'webm' || fileext[0] == 'ogg') {
						newMessage = "<video class='media_file' controls><source src='"+msg+"' type='video/"+fileext[0]+"'></video>";
					}
	
				}
				//console.log(localStorage.getItem("bb_user_chat_token"), 'bbvisitortoken');
				
				//var newBBvisitortoken = (bbvisitortoken == '' || bbvisitortoken == null) ? localStorage.getItem("bb_user_chat_token") : bbvisitortoken;
				var newBBvisitortoken = localStorage.getItem("bb_user_chat_token");
				//console.log(newBBvisitortoken, 'newBBvisitortoken');
				bb_chat_socket.emit('chat_message', {room:newBBvisitortoken, msg:newMessage, chatTo:bbClientId, currentUser:currentUser, currentUserName:currentSupportName,msgType:'file' });
				var bbsrc = this.userSettings.host + "/webchat/addChatMsg";
				var a = 'room=' + newBBvisitortoken + '&msg=' + msg + '&chatTo=' + bbClientId + '&currentUser=' + currentUser;
				e.value = '';
				//i = call back function
				//a = POST data
				var i = function (o) {
					document.getElementById("bb_chat_loading").style.display = 'none';
				};
				t.ajax(bbsrc, i, 'POST', a);
			}
		}).catch(
			error => console.log(error) // Handle the error response object
		);
	}

	t.prototype.show_bb_loading = function (e) {

		var aToken = Number(bbClientId) + Number(currentUser);
		if(Number(bbClientId) > Number(currentUser)){
			var sToken = Number(bbClientId) - Number(currentUser);
		}else {
			var sToken = Number(currentUser) - Number(bbClientId);
		}
		var newToken = aToken+'n'+sToken;
		var wait = '5000';

		bb_chat_socket.emit('wait_message', {room:newToken,chatTo:bbClientId, currentUser:currentUser, wait:wait});
	}
	
	t.prototype.send_bb_msg = function (e) {
		
		var msg = e.value;
		
		/*if(bbvisitortoken === null){
			
		}else{
			newToken = bbvisitortoken;
		}*/

		var aToken = Number(bbClientId) + Number(currentUser);
		if(Number(bbClientId) > Number(currentUser)){
			var sToken = Number(bbClientId) - Number(currentUser);
		}else {
			var sToken = Number(currentUser) - Number(bbClientId);
		}
		var newToken = aToken+'n'+sToken;
		
		var msg = msg.trim();
		if(msg.length > 0 ){
			setTimeout(() => {
				bb_chat_socket.emit('chat_message', {room:newToken, msg:msg, chatTo:bbClientId, currentUser:currentUser, name:currentSupportName, currentUserName:currentSupportName, msgType:'text' });
				var bbsrc = this.userSettings.host + "/webchat/addChatMsg";
				var a = 'room=' + newToken + '&msg=' + msg + '&chatTo=' + bbClientId + '&currentUser=' + currentUser;
				e.value = '';
				//i = call back function
				//a = POST data
				var i = function (o) {
					
				};
				t.ajax(bbsrc, i, 'POST', a);
			}, 500);

		}
		return false;
	}
	
	t.prototype.start_new_bb_widget_chat = function (e) {
		
		startingChatMsg = e.value;
		
		startingChatMsg = startingChatMsg.trim();

		if(startingChatMsg.length > 0 ){
			document.getElementById('bb_chat_message').value = startingChatMsg;
			//alert(bbContactConfig);
			if(bbContactConfig == 1){
				var cb = document.getElementById('bb_msg_wrap2');
				var ub = document.getElementById('bb_msg_wrap1');
				t.show(cb);
				t.hide(ub);
			}else{
				document.getElementById('bb_chat_username').value = 'New User';
				document.getElementById('bb_chat_email').value = 'Add Email';
				document.getElementById("bb_user_info_submit_btn").click();
				var ub = document.getElementById('bb_msg_wrap1');
				t.hide(ub);
			}
		}
		return false;
	}

	t.prototype.bb_chat_end = function (e) {
	
		bbvisitortoken = localStorage.getItem("bb_user_chat_token");
		bb_chat_socket.emit('leaveroom', bbvisitortoken);
		//localStorage.removeItem("bb_user_chat_token");
		localStorage.clear();
		document.getElementById("bb_chat_msg_input2").value = '';
		document.getElementById("bb_chat_username").value = '';
		document.getElementById("bb_chat_email").value = '';
		document.getElementsByClassName("bb_msg_push")[0].innerHTML = '';
		document.getElementsByClassName('bb_drop_icon')[0].innerHTML = '';
		document.getElementById("bb_msg_wrap").style.display = "none";
		document.getElementById("bb_msg_wrap1").style.display = "block";
		chatReplyByAdmin = '';

	}
	
	t.prototype.bb_submit_user_details = function (e) {
		var username = document.getElementById('bb_chat_username').value;
		var email = document.getElementById('bb_chat_email').value;
		var message = document.getElementById('bb_chat_message').value = startingChatMsg;
		currentSupportName = username;
		if(username == ''){
			document.getElementById('bb_chat_username').style.border = '1px solid #F00';
			document.getElementById('bb_chat_username').focus;
		}else if(email == ''){
			document.getElementById('bb_chat_username').style.border = 'none';
			document.getElementById('bb_chat_email').style.border = '1px solid #F00';
			document.getElementById('bb_chat_email').focus;
		}else if((bbpwValidateEmail(email) === false) && bbContactConfig == 1){
			document.getElementById('bb_chat_username').style.border = 'none';
			document.getElementById('bb_chat_email').style.border = '1px solid #F00';
			document.getElementById('bb_chat_email').focus;
		}else if(message == ''){
			document.getElementById('bb_chat_username').style.border = 'none';
			document.getElementById('bb_chat_email').style.border = 'none';
			document.getElementById('bb_chat_message').style.border = '1px solid #F00';
			document.getElementById('bb_chat_message').focus;
		}else{
			document.getElementById('bb_chat_username').style.border = 'none';
			document.getElementById('bb_chat_email').style.border = 'none';
			document.getElementById('bb_chat_message').style.border = 'none';
			
			var cb = document.getElementById('bb_msg_wrap');
			var ub = document.getElementById('bb_msg_wrap2');
			t.show(cb);
			t.hide(ub);
			
			greattingMessage = document.getElementById('greattingMessageArray').innerHTML;
			greattingMsgTime = document.getElementById('greattingMsgTimeArray').innerHTML;
			bbClientAvtarImg = document.getElementById('bbClientAvtarImg').innerHTML;
			
			var greattingMessageArray = greattingMessage.split('||');
			var greattingMsgTimeArray = greattingMsgTime.split('||');
			var q, greattingTime='', greatingMsgCounter=0;
			for(q = 0; q < greattingMessageArray.length; q++){
				greattingTime = Number(greattingTime) + Number(greattingMsgTimeArray[q]);
				var sentMsgTime = greattingTime * 1000;
				setTimeout(function(){
					//console.log('chatReplyByAdmin', chatReplyByAdmin);
					if(chatReplyByAdmin == ''){
						//console.log(bbClientAvtarImg, 'bbClientAvtarImg');
						bb_chat_socket.emit('chat_message', {room:newToken, avatar:bbClientAvtarImg, msg:greattingMessageArray[greatingMsgCounter],currentUserName:currentSupportName, chatTo:currentUser, currentUser:bbClientId, greatingMsg:'default' });
						
						var bbsrc = hostURL + "/webchat/addChatMsg";
						var a = 'room=' + newToken + '&msg=' + greattingMessageArray[greatingMsgCounter] + '&chatTo=' + currentUser + '&currentUser=' + bbClientId;
						//e.value = '';
						var i = function (o) {
							
						};
						t.ajax(bbsrc, i, 'POST', a);
						
						greatingMsgCounter++;
					}
				}, sentMsgTime);
			}
			
			checknewuser = 1;
			
			//var support_name = 'New User';
			var currentDay = new Date();
			var currentDate = currentDay.getFullYear()+'-'+((currentDay.getMonth() + 1) < 10 ? '0' : '') + (currentDay.getMonth() + 1)+'-'+(currentDay.getDate() < 10 ? '0' : '') + currentDay.getDate();
			var currentTime = (currentDay.getHours() < 10 ? '0' : '') + currentDay.getHours() + ":" + (currentDay.getMinutes() < 10 ? '0' : '') + currentDay.getMinutes() + ":" + (currentDay.getSeconds() < 10 ? '0' : '') + currentDay.getSeconds();
			var dateTimeVal = currentDate+' '+currentTime;

			var msg = message.trim();
			var timeStamp = Math.floor(Date.now() / 1000);
			var randumNum = Math.floor((Math.random() * 1000000) + 1);
			var support_id = timeStamp+'0'+randumNum;
			currentUser = support_id;
			bb_chat_socket.emit('support_user', {name: username, id: support_id, suppUserID:bbClientId,email:email, msg:msg, currentTime:dateTimeVal});


			var aToken = Number(bbClientId) + Number(currentUser);

			if(Number(bbClientId) > Number(currentUser)){
				var sToken = Number(bbClientId) - Number(currentUser);
			}
			else {
				var sToken = Number(currentUser) - Number(bbClientId);
			}

			var newToken = aToken+'n'+sToken;
			localStorage.setItem("bb_user_chat_token", newToken);
			//localStorage.setItem("bb_chat_geatting_data", newToken);

			//console.log(newToken, 'test 2');
			bb_chat_socket.emit('subscribe', newToken);
			
			var bbsrc = this.userSettings.host + "/webchat/supportUser";
			var a = 'room=' + newToken + '&userID=' + bbClientId + '&currentUser=' + currentUser + '&support_name=' + username + '&email=' + email;
			//i = call back function
			//a = POST data
			var i = function (o) {
				//Display Json on browser
				//ch.call(e, o), e.trigger("ready"), cf.call(e);
			};
			t.ajax(bbsrc, i, 'POST', a);
			
			//var msg = message;
			
			
			
			if(msg.length > 0 ){
				bb_chat_socket.emit('chat_message', {room:newToken, msg:msg, chatTo:bbClientId, currentUser:currentUser,currentUserName:currentSupportName });
				var bbsrc = this.userSettings.host + "/webchat/addChatMsg";
				var a = 'room=' + newToken + '&msg=' + msg + '&chatTo=' + bbClientId + '&currentUser=' + currentUser;
				e.value = '';
				//i = call back function
				//a = POST data
				var i = function (o) {
					
				};
				t.ajax(bbsrc, i, 'POST', a);
			}
			return false;
		}
	}
	
	t.prototype.bb_submit_username = function (e) {
        		
		//var ch = document.getElementById('bb_msg_head');
		var cb = document.getElementById('bb_msg_wrap');
		var ub = document.getElementById('bb_msg_wrap1');
		//t.show(ch);
		t.show(cb);
		t.hide(ub);
		
		var support_name = document.getElementById('bb_chat_username').value;
        var email = document.getElementById('bb_chat_email').value;
		var timeStamp = Math.floor(Date.now() / 1000);
		var randumNum = Math.floor((Math.random() * 1000000) + 1);
		var support_id = timeStamp+'0'+randumNum;
		currentUser = support_id;
		
		bb_chat_socket.emit('support_user', {name: support_name, id: support_id, suppUserID:bbClientId,email:email});


		var aToken = Number(bbClientId) + Number(currentUser);

		if(Number(bbClientId) > Number(currentUser)){
			var sToken = Number(bbClientId) - Number(currentUser);
		}
		else {
			var sToken = Number(currentUser) - Number(bbClientId);
		}

		var newToken = aToken+'n'+sToken;
		localStorage.setItem("bb_user_chat_token", newToken);

		//console.log(newToken, 'test 3');
		bb_chat_socket.emit('subscribe', newToken);
		
		var bbsrc = this.userSettings.host + "/webchat/supportUser";
		var a = 'room=' + newToken + '&userID=' + bbClientId + '&currentUser=' + currentUser + '&support_name=' + support_name;
        //i = call back function
        //a = POST data
        var i = function (o) {
            //Display Json on browser
            //ch.call(e, o), e.trigger("ready"), cf.call(e);
        };
        t.ajax(bbsrc, i, 'POST', a);
	}
	
    function f() {
        var e = this;
		if (this.userSettings.widget == 'chat') {
			e.bb_chat_event('click', 'bbshowchatpopup', 'bb_display_chat_popup');
			//e.bb_chat_event('click', 'bb_un_submit_btn', 'bb_submit_chat_username');
			//e.bb_chat_event('keypress', 'bb_chat_username', 'bb_enter_chat_username');
			e.bb_chat_event('click', 'bb_smiley_btn', 'bb_smiley_popup_box');
			
			//e.bb_chat_event('keypress', 'bb_chat_msg_input2', 'bb_chat_popup_msg_input2');
			//e.bb_chat_event('keypress', 'bb_chat_msg_input3', 'bb_chat_popup_msg_input3');
			
			e.bb_chat_event('keypress', 'bb_chat_msg_input2', 'start_new_bb_chat');
			e.bb_chat_event('keypress', 'bb_chat_msg_input3', 'start_new_bb_chat');
			e.bb_chat_event('click', 'bb_un_submit_btn', 'bb_submit_user_details');
			
			e.bb_chat_event('keypress', 'bb_chat_msg_input', 'bb_chat_popup_msg_input');
			e.bb_chat_event('click', 'bb_smiley_icon_value', 'bb_get_smiley_value');
			e.bb_chat_event('click', 'bb_attechment_btn', 'bb_get_attechment_value');
			e.bb_chat_event('change', 'bb_attechment_file', 'bb_get_attechment_file');
			e.bb_chat_event('click', 'bb_image_preview_btn', 'bb_show_image_popup');
			e.bb_chat_event('click', 'bb_chat_close', 'bb_close_modal_popup');
			e.bb_chat_event('click', 'bb_chat_modal', 'bb_close_modal_popup');
			e.bb_chat_event('click', 'bb_chat_close_btn', 'hide_bb_chat_box');
			e.bb_chat_event('click', 'bb_chat_end', 'bb_chat_end');
		}
    }

    function u(t) {
        var e;
        return t >= 960 ? e = 3 : t >= 600 && 960 > t ? e = 2 : 600 > t && (e = 1), e
    }


    t.prototype.bb_chat_event = function (ev, c, an) {
        var e = this;
		bindPopupThisVal = this;
        var col = document.getElementsByClassName(c);
        var i = document.getElementsByClassName(c)[0];
		
        if (ev == 'click') {
            if (an == 'bb_display_chat_popup') {
                i.addEventListener(ev, function () {
                    e.show_bb_chat(this);
                });
            } else if (an == 'bb_submit_chat_username') {
                i.addEventListener(ev, function (event) {
					e.bb_submit_username(this);
                });
            } else if (an == 'bb_smiley_popup_box') {
                i.addEventListener(ev, function () {
                    e.show_bb_smiley(this);
                });
            } else if (an == 'bb_get_attechment_value') {
                i.addEventListener(ev, function () {
                    e.get_bb_attechment_value(this);
                });
            } else if (an == 'bb_show_image_popup') {
				setInterval(function(){
					if(col.length > 0 && showbbpopup === ''){
						showbbpopup = 1;
						for(var imageCounter = 0; imageCounter < col.length; imageCounter++){
							document.getElementsByClassName('bb_image_preview_btn')[imageCounter].addEventListener(ev, function () {
								var imageURL = this.getAttribute('img-data');
								e.bb_show_image_modal_popup(this, imageURL);
							});
						}
					}
				}, 1000);
            }else if (an == 'bb_close_modal_popup') {
				i.addEventListener(ev, function () {
                    e.bb_close_modal_popup(this);
                });
            } else if (an == 'hide_bb_chat_box') {
				i.addEventListener(ev, function () {
                    e.hide_bb_chat_box(this);
                });
            } else if (an == 'bb_chat_end') {
            	i.addEventListener(ev, function (event) {
					e.bb_chat_end(this);
                });

            } else if (an == 'bb_submit_user_details') {
                i.addEventListener(ev, function (event) {
					e.bb_submit_user_details(this);
                });
            } 
			else if (an == 'bb_get_smiley_value') {
                document.getElementById('bb_smiley_icon_value1').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value2').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value3').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value4').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value5').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value6').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value7').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value8').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value9').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value10').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value11').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value12').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value13').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value14').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value15').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value16').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value17').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value18').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value19').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value20').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value21').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value22').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value23').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value24').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value25').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value26').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
				
				document.getElementById('bb_smiley_icon_value27').addEventListener(ev, function () {
                    e.bb_get_smiley_value(this);
                });
            }
        }else if (ev == 'keypress') {
			if (an == 'bb_chat_popup_msg_input') {	

				i.addEventListener(ev, function (event) {

					e.show_bb_loading(this);

					if ( event.keyCode == 13 ) {
						e.send_bb_msg(this);
					}
				});
			} else if (an == 'start_new_bb_chat') {
                i.addEventListener(ev, function (event) {
					if ( event.keyCode == 13 ) {
						e.start_new_bb_widget_chat(this);
					}
                });
            } else if (an == 'bb_chat_popup_msg_input3') {
                i.addEventListener(ev, function (event) {
					if ( event.keyCode == 13 ) {
						e.start_bb_chat(this);
					}
                });
            }
		}else if (ev == 'change') {
			if (an == 'bb_get_attechment_file') {
                i.addEventListener(ev, function () {
                    e.get_bb_attechment_file(this);
                });
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
	
	function isAnchor(str){
		return /^\<a.*\>.*\<\/a\>/i.test(str);
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

//localStorage.removeItem("bb_user_chat_token");
var bbkey = document.getElementById("bbscriptloader").getAttribute("data-key");
var bbwidget = document.getElementById("bbscriptloader").getAttribute("data-widgets");
var bbvisitortoken = localStorage.getItem("bb_user_chat_token");
//var bbchatgeattingdata = localStorage.getItem("bb_chat_geatting_data");
var bb_chat_socket;
bb_chat_socket = io('http://brandboostx.com:3000');
var currentUser = '';
var currentUserName ='';
var unreadmsgCounter = 0;
var bbClientId = '';
//bbkey = atob(bbkey);
//bbkey = btoa(bbkey);
var showbbdata = '';
var checknewuser = '';
var showbbchatpopup = '';
var bindPopupThisVal = '';
var showbbpopup = '';
var greattingMessage = '';
var greattingMsgTime = '';
var hostURL = '';
var chatReplyByAdmin = '';
var bbcp_bg_color = '';
var sound = '';
var startingChatMsg = '';
var bbContactConfig = '';
var currentSupportName = '';
var bbClientAvtarImg = '';

function bbpwValidateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

setTimeout(function(){
	if(bbvisitortoken !== null){
		//console.log(bbvisitortoken, 'test 4');
		bb_chat_socket.emit('subscribe', bbvisitortoken);
	}
}, 500);
	
var smiliesMap = {
            ":)" : "1",
            ":(" : "2",
            ";)" : "3",
            ":d" : "4",
            ";;)": "5",
            ":/" : "7",
            ":x" : "8",
            ":p" : "10",
            ":*" : "11",
            ":o" : "13",
            ":>" : "15",
            ":s" : "17",
            ":((": "20",
            ":))": "21",
            ":|": "22",
            ":b": "26",
            ":&": "31",
            ":$": "32",
            ":?" : "39",
            "#o": "40",
            ":ss": "42",
            "@)": "43",
            ":w": "45",
            ":c": "101",
            ":h": "103",
            ":t": "104",
            ":q": "112"
        }, smileyReg = /[:;#@]{1,2}[\)\/\(\&\$\>\|xXbBcCdDpPoOhHsStTqQwW*?]{1,2}/g;
  
if (bbkey != 'undefined' && bbwidget != 'undefined') { 

    var oBB = new BB(bbkey, {
        "host": "http://brandboostx.com",
        "widget": bbwidget
    });

    BB.ready(function () {
        oBB.init_widget();
		
        if (bbwidget == 'chat') {
            oBB.display_widget();
        }
    });
}

bb_chat_socket.on('supportname', function(data) {

	currentSupportName = data.supportname;
});

bb_chat_socket.on('wait_widget_message', function(data) {

	var typing_messsage = document.getElementsByClassName('typing_messsage');
	if(typing_messsage.length > 0) {

 	} 
 	else {

 		setTimeout(function() {
			document.getElementsByClassName('loading_message_li')[0].remove();
			document.getElementsByClassName('bb_msg_push')[0].classList.remove('typing_messsage');
		}, data.wait);

 		document.getElementsByClassName('bb_msg_push')[0].innerHTML += `<div class="bb_msg loading_message_li"><div class="msg-left "><img src="assets/images/messageloading.gif" style="height: 25px;"></div></div>`;
	 	
		var msgHeight = document.getElementById("bb_msg_body").scrollHeight;
		document.getElementById("bb_msg_body").scrollTop = msgHeight;
 	}
 	document.getElementsByClassName('bb_msg_push')[0].classList.add('typing_messsage');

});

bb_chat_socket.on('team_data_show', function(data) {
	document.getElementsByClassName('client_box')[0].style.display = 'none';
	document.getElementsByClassName('team_box')[0].style.display = 'block';
	document.getElementsByClassName('team_box')[0].innerHTML = "<p>"+data.teamName+"</p><p> <span>Active</span></p>";
});

bb_chat_socket.on('chat message', function(data){

	var newImgCount = '';
	var msg = data.msg;
	//var msg_noti = data.msg;
	if(data.currentUser == bbClientId){
		checknewuser = '';
		document.getElementById('bb_msg_wrap').style.display='block';
		document.getElementById('bb_msg_wrap1').style.display='none';
	}

	/*------ remove the loading message -----*/ 

	//console.log(bbClientId);
	//console.log(data);

	var loading_messsage = document.getElementsByClassName('loading_message_li');
	if(loading_messsage.length > 0) {
		document.getElementsByClassName('loading_message_li')[0].remove();
		if(bbClientId == data.currentUser) {
			document.getElementsByClassName('bb_msg_push')[0].classList.remove('typing_messsage');
		}
	}
	
	
	//$('#msg_box_show_'+data.currentUser).removeClass('typing_messsage');
	/*---- end remove the loading message ---*/
	
	var imgBgColor = '';
	var messageSmilies = msg.match(smileyReg) || [];

	for(var i=0; i<messageSmilies.length; i++) {
		var messageSmiley = messageSmilies[i],
		messageSmileyLower = messageSmiley.toLowerCase();
		if(smiliesMap[messageSmileyLower]) {
			//imgBgColor = 'style="background:none; padding: 10px; box-shadow:none;"';
			msg = msg.replace(messageSmiley, "<img src='http://brandboostx.com/assets/img-smile/"+smiliesMap[messageSmileyLower]+".gif' alt='smiley' />");
		}
	}

	var strTime = oBB.getTime();
	var imageClass = '';
	if ( msg.trim().length != 0 ) {
		
		if(data.msgType == 'file'){
			imageClass = 'bb_img_msg_row';
		}
		
		if(checknewuser == ''){
			
			if(currentUser == data.currentUser) {
				
				document.getElementsByClassName('bb_msg_push')[0].innerHTML += '<div class="bb_msg"><div class="msg-right '+imageClass+' '+bbcp_bg_color+'" '+imgBgColor+'><div class="msg_time">'+strTime+'</div> ' + msg + '</div></div>';
				
			}else{
				if(data.greatingMsg != 'default'){
					chatReplyByAdmin = 1;
				}
				
				document.getElementsByClassName('bb_msg_push')[0].innerHTML += '<div class="bb_msg"><div class="msg-left '+imageClass+'" '+imgBgColor+'><div class="msg_time">'+strTime+'</div> ' + msg + '</div></div>'; 
				//sound.play();
				
				/*newImgCount = document.getElementsByClassName('bb_image_preview_btn').length;
				//alert(newImgCount);
				document.getElementsByClassName('bb_image_preview_btn')[newImgCount].addEventListener('click', function () {
					var imageURL = this.getAttribute('img-data');
					bindPopupThisVal.bb_show_image_modal_popup(this, imageURL);
				});*/
			}

			var typing_messsage = document.getElementsByClassName('typing_messsage');
			if(typing_messsage.length > 0) { 

				document.getElementsByClassName('bb_msg_push')[0].innerHTML += `<div class="bb_msg loading_message_li"><div class="msg-left "><img src="assets/images/messageloading.gif" style="height: 25px;"></div></div>`;
			}
			
			var msgHeight = document.getElementById("bb_msg_body").scrollHeight;
			document.getElementById("bb_msg_body").scrollTop = msgHeight;
		}else{
			
			document.getElementsByClassName('bb_msg_push')[0].innerHTML += '<div class="bb_msg"><div class="msg-right '+bbcp_bg_color+'" '+imgBgColor+'><div class="msg_time">'+strTime+'</div> ' + msg + '</div></div>'; 
			
			//document.getElementsByClassName('bb_msg_push')[2].innerHTML += '<div class="bb_msg"><div class="msg-right '+bbcp_bg_color+'" '+imgBgColor+'><div class="msg_time">'+strTime+'</div> ' + msg + '</div></div>';
			
			document.getElementsByClassName('bb_msg_push')[1].innerHTML += '<div class="bb_white_box '+bbcp_bg_color+'" '+imgBgColor+'><p style="color: #fff;">Me</p><p><span style="color: #fff; font-size: 13px;">' + msg + '</span></p></div>';
			
			var msgHeight = document.getElementById("bb_msg_body2").scrollHeight;
			document.getElementById("bb_msg_body2").scrollTop = msgHeight;
		}
	}
	
	if(showbbchatpopup == ''){
		++unreadmsgCounter;
		//console.log(unreadmsgCounter, 'unreadmsgCounter');
		if(unreadmsgCounter > 0){
			document.getElementById('bb_chat_unread_counter').style.display = 'block';
			document.getElementById('bb_chat_unread_counter').innerHTML = unreadmsgCounter;
		}
	}else{
		unreadmsgCounter = 0;
		document.getElementById('bb_chat_unread_counter').style.display = 'none';
		document.getElementById('bb_chat_unread_counter').innerHTML = unreadmsgCounter;
	}
});