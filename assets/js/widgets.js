BB = function (t) {
    function t(e, o) {
        this.userSettings = o;
        this.userbbkey = e;
        v.call(this)
	}
	
    function v() {
        var e = this.userSettings.host + "/assets/css/brandboost_widget.css";
        var a = document.getElementsByTagName("head")[0];
        l = document.createElement("link");
        l.type = "text/css";
        l.rel = "stylesheet";
        l.href = e;
        a.appendChild(l);
	}
	
    function h(e) {
        //alert(e);
		//console.log(this.userSettings);
        var o = [];
        try {
            o = JSON.parse(e);
            for (var n = -1, i = 0; i < o.length; i++)
			if ("list" == o[i].method) {
				//console.log(o[i]);
				n = i;
				if (this.userSettings.center_popup_widget === true) {
					document.getElementsByClassName("bb_main_cp_widget")[0].innerHTML = o[n].center_popup_widget_result;
				}
				
				if (this.userSettings.bottom_fixed_widget === true) {
					interval = setInterval(showSlides, 8000);
					document.getElementsByClassName("bb_main_bf_widget")[0].innerHTML = o[n].bottom_fixed_widget_result;
				}
				
				if (this.userSettings.vertical_popup_widget === true) {
					document.getElementsByClassName("bb_main_vp_widget")[0].innerHTML = o[n].vertical_popup_widget_result;
				}
				
				if (this.userSettings.button_widget === true) {
					document.getElementsByClassName("bb_main_button_widget")[0].innerHTML = o[n].button_widget_result;
				}
				
				if (this.userSettings.reviews_feed_widget === true) {
					document.getElementsByClassName("bb_main_reviews_feed_widget")[0].innerHTML = o[n].reviews_feed_widget_result;
				}
				
				break
			}
			} catch (r) {
            t.safeConsole(r.message)
		}
	}
	
	function ps(e) {
        //alert(e);
		//console.log(this.userSettings);
        var po = [];
        try {
            po = JSON.parse(e);
            for (var n = -1, i = 0; i < po.length; i++)
			if ("common_comments" == po[i].method) {
				//console.log(o[i]);
				n = i;
				
				document.getElementsByClassName("bbpw_common_comments_box")[0].innerHTML = po[n].commentsData;
				
				document.getElementsByClassName("bbpw_close_ccp")[0].addEventListener('click', function (a) {
					document.getElementsByClassName('bbpw_common_comments_box')[0].innerHTML='';
				});
				
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
        if (this.userSettings.center_popup_widget === true) {
            var t = document.createElement("div");
            t.className = "bb_main_cp_widget";
            document.body.appendChild(t);
		}
		
        if (this.userSettings.bottom_fixed_widget === true) {
            var t = document.createElement("div");
            t.className = "bb_main_bf_widget";
            document.body.appendChild(t);
		}
		
        if (this.userSettings.vertical_popup_widget === true) {
            var t = document.createElement("div");
            t.className = "bb_main_vp_widget";
            document.body.appendChild(t);
		}
		
		if (this.userSettings.button_widget === true) {
            var t = document.createElement("div");
            t.className = "bb_main_button_widget";
            document.body.appendChild(t);
		}
		
		if (this.userSettings.reviews_feed_widget === true) {
            var t = document.createElement("div");
            t.className = "bb_main_reviews_feed_widget";
            document.body.appendChild(t);
		}
	}
	
    t.prototype.g_reviews = function () {
        var e = this;
        var bb_key = this.userbbkey;
        var bbsrc = this.userSettings.host + "/reviews/displayReview/" + bb_key;
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
        var classPosition = e.getAttribute("class-position");
        var cc = e.getAttribute("class");
        var allclasses = cc.split(" ");
		if(ac == 'Yes'){
			document.getElementsByClassName("bb_review_like")[classPosition].style.opacity = '0.4';
			if(bbwidget == 'bfw'){
				document.getElementById("bb_review_like_cp_"+classPosition).style.opacity = '0.4';
			}
			}else{
			document.getElementsByClassName("bb_review_dislike")[classPosition].style.opacity = '0.4';
			if(bbwidget == 'bfw'){
				document.getElementById("bb_review_dislike_cp_"+classPosition).style.opacity = '0.4';
			}
		}
        a = 'bbrid=' + rid + '&ha=' + ac;
        var bbsrc = this.userSettings.host + "/reviews/saveHelpful";
        var i = function (o) {
            var rsp = JSON.parse(o);
            if (allclasses.indexOf("bbpw_helpful_action") > -1) {
				var peopleSP = ' found this helpful';
				if(rsp.yes > 1){
					peopleSP = ' found this helpful';
				}
				
				document.getElementsByClassName("bb_review_helpful")[classPosition].innerHTML = rsp.yes+peopleSP;
				if(bbwidget == 'bfw'){
					document.getElementById("bb_review_helpful_cp_"+classPosition).innerHTML = rsp.yes+peopleSP;
				}
				if(ac == 'Yes'){
					document.getElementsByClassName("bb_review_like")[classPosition].style.opacity = '1';
					if(bbwidget == 'bfw'){
						document.getElementById("bb_review_like_cp_"+classPosition).style.opacity = '1';
					}
					}else{
					document.getElementsByClassName("bb_review_dislike")[classPosition].style.opacity = '1';
					if(bbwidget == 'bfw'){
						document.getElementById("bb_review_dislike_cp_"+classPosition).style.opacity = '1';
					}
				}
			}
		}
		
        t.ajax(bbsrc, i, 'POST', a);
	}
	
	t.prototype.shareWithSocialSites = function (e) {
		var shareType = e.getAttribute("share-type");
		var siteUrl = e.getAttribute("site-url");
        var reviewMsg = e.getAttribute("review-msg");
        var titleName = e.getAttribute("title-name");
        var reviewRating = e.getAttribute("review-rating");
        var productImage = e.getAttribute("product-image");
        var reviewImage = e.getAttribute("review-image");
		var reviewRatingStr = '';
		if(reviewRating != ''){ reviewRatingStr = '\n Rating : '+reviewRating+'/5'; }
		
		if(shareType == 'twitter'){
			var shareURL = "http://twitter.com/share?";
			var params = {
				url: siteUrl, 
				text: reviewMsg
			}
			for(var prop in params) shareURL += '&' + prop + '=' + encodeURIComponent(params[prop]);
			window.open(shareURL, '', 'left=0,top=0,width=550,height=550,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
		}
		
		if(shareType == 'facebook'){
			//window.open('https://www.facebook.com/dialog/feed?app_id=524948044663882&link='+siteUrl, '', 'left=0,top=0,width=550,height=550,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
			
			FB.ui({
				method: 'share_open_graph',
				action_type: 'og.likes',
				action_properties: JSON.stringify({
					object: {
						'og:url': siteUrl,
						'og:title': titleName,
						'og:description': reviewMsg+reviewRatingStr,
						'og:image': reviewImage
					}
				})
			},
			function (response) {
				// Action after response
			});
		}
		
		if(shareType == 'google'){
			window.open('https://plus.google.com/share?url='+siteUrl, '', 'left=0,top=0,width=550,height=550,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
		}
		
		if(shareType == 'linkedin'){
			window.open('http://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(siteUrl)+'&summary='+encodeURIComponent(reviewMsg), '', 'left=0,top=0,width=550,height=550,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
		}
		
	}
	
	t.prototype.save_comment_like = function (e) {
        var c = this;
        var av = e.getAttribute("action-value");
        var rid = e.getAttribute("bb-review-id");
        var cid = e.getAttribute("bb-comment-id");
        var reviewPosition = e.getAttribute("review-position");
        var commentPosition = e.getAttribute("comment-position");
        var cc = e.getAttribute("class");
        var allclasses = cc.split(" ");
        a = 'bbrid=' + rid + '&av=' + av + '&bbcid=' + cid;
        var bbsrc = this.userSettings.host + "/reviews/saveCommentLike";
        var i = function (o) {
            var rsp = JSON.parse(o);
            if (allclasses.indexOf("bbpw_comment_like_action") > -1) {
				
				document.getElementsByClassName("bbpw_comment_like_"+cid)[0].innerHTML = rsp.like;
				document.getElementsByClassName("bbpw_comment_dislike_"+cid)[0].innerHTML = rsp.dislike;
			}
		}
		
        t.ajax(bbsrc, i, 'POST', a);
	}
	
	t.prototype.zoom_image = function (e) {
        var c = this;
        var classPosition = e.getAttribute("class-position");
        var mediaPosition = e.getAttribute("media-position");
        var cc = e.getAttribute("class");
        var allclasses = cc.split(" ");
		
		if (allclasses.indexOf("bb_normal_image") > -1) {
			e.classList.remove('bb_normal_image');
			e.classList.add('bb_zoom_image');
			}else{
			e.classList.add('bb_normal_image');
			e.classList.remove('bb_zoom_image');
		}
		
	}
	
	t.prototype.a_comment = function (e) {
        var ac = e.getAttribute("action-name");
        var rid = e.getAttribute("bb-review-id");
        a = 'bbrid=' + rid + '&ha=' + ac;
        var bbsrc = this.userSettings.host + "/reviews/saveHelpful";
        var i = function (o) {
            var rsp = JSON.parse(o);
            document.getElementById("bbhelpfulcount").innerHTML = rsp.yes;
		}
        t.ajax(bbsrc, i, 'POST', a);
		
	}
	
    t.prototype.bbpwShowCCP = function (e) {
		var bb_key = this.userbbkey;
        var rid = e.getAttribute("bb-review-id");
        a = 'bbrid=' + rid;
        var bbsrc = this.userSettings.host + "/reviews/getCommonCommentPopup/"+bb_key;
        var i = function (o) {
            ps.call(e, o), e.trigger("ready"), pf.call(e);
		}
        t.ajax(bbsrc, i, 'POST', a);
	}
	
    t.prototype.d_comment = function () {
        var s = document.getElementsByClassName('cmt-ctr');
        for (r = 0; r < s.length; ++r) {
            t.show(s[r]);
		}
	}
	
	t.prototype.bbpwSliderWidget = function () {
        clearInterval(interval);
	}
	
	t.prototype.bbpwSliderWidgetMOut = function () {
		setInterval(showSlides, 8000);
	}
	
	t.prototype.bbpw_comment_section = function(e) {
		var classPosition = e.getAttribute("class-position");
		var s = document.getElementsByClassName('bbpw_comment_box')[classPosition];
		if(document.getElementsByClassName('bbpw_comment_box')[classPosition].style.display == 'inline-block'){
			t.hide(s);
			var s1 = document.getElementsByClassName('bbpw_all_comments_box')[classPosition];
			var e1 = document.getElementsByClassName('bbpw_show_all_comment')[classPosition];
			t.hide(s1);
			t.show(e1);
			}else{
			t.show(s);
		}
	}
	
	t.prototype.bbServiceReviews = function(e) {
		document.getElementsByClassName('bb_product_reviews')[0].classList.remove("active");
		document.getElementsByClassName('bb_site_reviews')[0].classList.remove("active");
		
		document.getElementById('bb_product_rating_area').style.display = 'none';
		document.getElementById('bb_service_rating_area').style.display = 'block';
		document.getElementById('bb_site_rating_area').style.display = 'none';
		
		e.classList.add("active");
		
		var allReviews = document.getElementsByClassName('bbw_main_loop_cantainer').length;
		var s1 = '';
		var i = 0;
		for(i = 0; i < allReviews; i++){
			s1 = document.getElementsByClassName('bbw_main_loop_cantainer')[i];
			if(s1.getAttribute("data-product-type") == 'service'){
				t.showOb(s1);
			}else{
				t.hide(s1);
			}
		}
	}
	
	t.prototype.bbSiteReviews = function(e) {
		document.getElementsByClassName('bb_service_reviews')[0].classList.remove("active");
		document.getElementsByClassName('bb_product_reviews')[0].classList.remove("active");
		
		document.getElementById('bb_product_rating_area').style.display = 'none';
		document.getElementById('bb_service_rating_area').style.display = 'none';
		document.getElementById('bb_site_rating_area').style.display = 'block';
		
		e.classList.add("active");
		
		var allReviews = document.getElementsByClassName('bbw_main_loop_cantainer').length;
		var s1 = '';
		var i = 0;
		for(i = 0; i < allReviews; i++){
			s1 = document.getElementsByClassName('bbw_main_loop_cantainer')[i];
			if(s1.getAttribute("data-product-type") == 'site'){
				t.showOb(s1);
			}else{
				t.hide(s1);
			}
		}
	}
	
	t.prototype.bbProductReviews = function(e) {
		document.getElementsByClassName('bb_service_reviews')[0].classList.remove("active");
		document.getElementsByClassName('bb_site_reviews')[0].classList.remove("active");
		
		document.getElementById('bb_product_rating_area').style.display = 'block';
		document.getElementById('bb_service_rating_area').style.display = 'none';
		document.getElementById('bb_site_rating_area').style.display = 'none';
		
		e.classList.add("active");
		
		var allReviews = document.getElementsByClassName('bbw_main_loop_cantainer').length;
		var s1 = '';
		var i = 0;
		for(i = 0; i < allReviews; i++){
			s1 = document.getElementsByClassName('bbw_main_loop_cantainer')[i];
			if(s1.getAttribute("data-product-type") == 'product'){
				t.showOb(s1);
			}else{
				t.hide(s1);
			}
		}
	}
	t.prototype.bbpwCommentReply = function(e) {
		var reviewPosition = e.getAttribute("review-position");
		var commentsPosition = e.getAttribute("comment-position");
		var s = document.getElementById('bb_comment_reply_box_'+reviewPosition+'_'+commentsPosition);
		if(s.style.display == 'inline-block'){
			t.hide(s);
			}else{
			t.show(s);
		}
	}
	
	t.prototype.bbcpwCloseAction = function(e) {
		var s = '';
		//s = document.getElementById('bb_vpw_section');
		if(bbwidgets == 'cpw'){
			s = document.getElementById('bb_cpw_section');
		}
		
		if(bbwidgets == 'bfw'){
			s = document.getElementById('bb_bfw_section');
		}
		t.hide(s);
	}
	
	t.prototype.bbWidgetScroll = function(e) {
		var c = this;
		var scrollVal = 382;
        clickValue = e.getAttribute("click-data");
        var scrollType = e.getAttribute("scroll-type");
		if(clickValue == -1){ clickValue = 0; }
		if(clickValue >= 0){
			if(scrollType ==  'top'){ ++clickValue; } else { --clickValue; }
			newScrollVal = clickValue * scrollVal;
			
			if((document.getElementById('bb_main_comments_section').scrollTop + scrollVal) >= newScrollVal){
				if(bbwidgets != 'bww'){
					document.getElementById('bb_main_comments_section').scroll({top:newScrollVal, behavior: 'smooth', duration: 1000});
					//document.getElementById('bb_main_comments_section').scrollTop = newScrollVal;
					}else{
					document.getElementById('bb_main_comments_section').scroll({top:newScrollVal, behavior: 'smooth', duration: 1000});
					//document.getElementById('bb_main_comments_section').scrollTop = newScrollVal;
				}
				
				document.getElementsByClassName('bb_widget_scroll')[0].setAttribute("click-data", clickValue);
				document.getElementsByClassName('bb_widget_scroll')[1].setAttribute("click-data", clickValue);
			}
		}
	}
	
	t.prototype.bbCloseBPW = function(e) {
		var c = this;
        var classPosition = e.getAttribute("class-position");
		var s = document.getElementsByClassName('bb_bfw_section')[classPosition];
		t.hide(s);
	}
	
	t.prototype.bbpwShowAllComments = function(e) {
		var classPosition = e.getAttribute("class-position");
		var s = document.getElementsByClassName('bbpw_all_comments_box')[classPosition];
		t.show(s);
		//console.log(e);
		//alert(e.length);
		t.hide(e);
	}
	
	t.prototype.bbpwShowSSLink = function(e) {
		var classPosition = e.getAttribute("class-position");
		var s = document.getElementsByClassName('bbpw_share_links')[classPosition];
		if(document.getElementsByClassName('bbpw_share_links')[classPosition].style.display == 'inline-block'){
			t.hide(s);
			}else{
			t.show(s);
		}
	}
	
	t.prototype.vpwReviewAction = function(e) {
		var s = document.getElementById('bbpw_vpwSection');
		
		if(document.getElementById('bbpw_vpwSection').style.display == 'inline-block'){
			//t.hide(s);
			document.getElementById('bbpw_vpwSection').style.display = 'block';
			document.getElementsByClassName('bbw_section_007')[0].getElementsByClassName('review_chat3')[0].classList.remove("bbOpenVPopup");
			}else{
			t.show(s);
			document.getElementsByClassName('bbw_section_007')[0].getElementsByClassName('review_chat3')[0].classList.add("bbOpenVPopup");
		}
	}
	
	t.prototype.bpwReviewAction = function(e) {
		var s = document.getElementById('bbpwButtonWidget');
		
		if(document.getElementById('bbpwButtonWidget').style.display == 'inline-block'){
			t.hide(s);
			//document.getElementById('bbpwButtonWidget').style.display = 'block';
			document.getElementsByClassName('bbw_section_007')[0].getElementsByClassName('review_chat')[0].classList.remove("bbOpenBPopup");
			}else{
			t.show(s);
			document.getElementsByClassName('bbw_section_007')[0].getElementsByClassName('review_chat')[0].classList.add("bbOpenBPopup");
		}
	}
	
	t.prototype.s_comment_reply = function (e) {
		var comment_id = e.getAttribute("comment-id");
        var cmttxt = document.getElementById("bbcmtreply_"+comment_id).value;
        var fullname = document.getElementById("bbcmtreplyname_"+comment_id).value;
        var phoneNo = document.getElementById("bbcmtreplyphone_"+comment_id).value;
        var emailadd = document.getElementById("bbcmtreplyemail_"+comment_id).value;
        var rid = document.getElementById("bb_review_id_"+comment_id).value;
		var bbCommentTerms = document.getElementById("bb_comment_terms_"+comment_id).checked;
        var bbCommentProcessing = document.getElementById("bb_comment_processing_"+comment_id).checked;
		
		if(fullname == ''){
			document.getElementById("bbcmtreplyname_"+comment_id).style.border = '1px solid #F00';
			document.getElementById("bbcmtreplyname_"+comment_id).focus();
			}else if(bbpwValidateEmail(emailadd) === false){
			document.getElementById("bbcmtreplyname_"+comment_id).style.border = '1px solid #ddd';
			document.getElementById("bbcmtreplyemail_"+comment_id).style.border = '1px solid #F00';
			document.getElementById("bbcmtreplyemail_"+comment_id).focus();
			}else if(cmttxt == ''){
			document.getElementById("bbcmtreplyname_"+comment_id).style.border = '1px solid #ddd';
			document.getElementById("bbcmtreplyemail_"+comment_id).style.border = '1px solid #ddd';
			document.getElementById("bbcmtreply_"+comment_id).style.border = '1px solid #F00';
			document.getElementById("bbcmtreply_"+comment_id).focus();
			}else if(!bbCommentTerms){
			alert('Please accept terms and condiation of brandboost.');
			}else if(!bbCommentProcessing){
			alert('Please accept, Agree to Disqus processing of email and IP address, and the use of cookies, to facilitate my authentication and posting of comments, explained further in the Privacy Policy.');
			}else{
			document.getElementById("bb_overlay_"+comment_id).style.display = 'block';
			document.getElementById("bbcmtreplyname_"+comment_id).style.border = '1px solid #ddd';
			document.getElementById("bbcmtreplyemail_"+comment_id).style.border = '1px solid #ddd';
			document.getElementById("bbcmtreply_"+comment_id).style.border = '1px solid #ddd';
			
			a = 'bbpcid=' + comment_id + '&bbrid=' + rid + '&bbcmtname=' + fullname + '&bbcmtphone=' + phoneNo + '&bbcmtemail=' + emailadd + '&bbcmt=' + cmttxt;
			var bbsrc = this.userSettings.host + "/reviews/addcomment";
			var i = function (o) {
				var rsp = JSON.parse(o);
				var s = document.getElementById("bb_success_msg_"+comment_id);
				var err = document.getElementById("bb_error_msg_"+comment_id);
				document.getElementById("bb_overlay_"+comment_id).style.display = 'none';
				
				if (rsp.status == 'ok') {
					//alert(rsp.status);
					t.show(s);
					t.hide(err);
					document.getElementById("bbcmtreply_"+comment_id).value='';
					document.getElementById("bbcmtreplyname_"+comment_id).value='';
					document.getElementById("bbcmtreplyemail_"+comment_id).value='';
					document.getElementById("bbcmtreplyphone_"+comment_id).value='';
					//document.getElementById("bb_comment_terms_"+comment_id).checked=false;
					//document.getElementById("bb_comment_processing_"+comment_id).checked=false;
					}else{
					t.hide(s);
					t.show(err);
				}
				
				setTimeout(function(){
					t.hide(s);
					t.hide(err);
				}, 6000);
			}
			t.ajax(bbsrc, i, 'POST', a);
		}
	}
	
    t.prototype.s_comment = function (e) {
		var classPosition = e.getAttribute("class-position");
        var cmttxt = document.getElementsByClassName("bbcmt")[classPosition].value;
        var fullname = document.getElementsByClassName("bbcmtname")[classPosition].value;
        var emailadd = document.getElementsByClassName("bbcmtemail")[classPosition].value;
        var phoneNo = document.getElementsByClassName("bbcmtphone")[classPosition].value;
        //var password = document.getElementsByClassName("bbcmtpassword")[classPosition].value;
        var bbCommentTerms = document.getElementsByClassName("bb_comment_terms")[classPosition].checked;
        var bbCommentProcessing = document.getElementsByClassName("bb_comment_processing")[classPosition].checked;
        var rid = document.getElementsByClassName("bb-review-id")[classPosition].value;
		
		if(fullname == ''){
			document.getElementsByClassName("bbcmtname")[classPosition].style.border = '1px solid #F00';
			document.getElementsByClassName("bbcmtname")[classPosition].focus();
			}else if(bbpwValidateEmail(emailadd) === false){
			document.getElementsByClassName("bbcmtname")[classPosition].style.border = '1px solid #ddd';
			document.getElementsByClassName("bbcmtemail")[classPosition].style.border = '1px solid #F00';
			document.getElementsByClassName("bbcmtemail")[classPosition].focus();
			}/*else if(password == ''){
			document.getElementsByClassName("bbcmtname")[classPosition].style.border = '1px solid #ddd';
			document.getElementsByClassName("bbcmtemail")[classPosition].style.border = '1px solid #ddd';
			document.getElementsByClassName("bbcmtpassword")[classPosition].style.border = '1px solid #F00';
			document.getElementsByClassName("bbcmtpassword")[classPosition].focus();
			}*/else if(cmttxt == ''){
			document.getElementsByClassName("bbcmtname")[classPosition].style.border = '1px solid #ddd';
			document.getElementsByClassName("bbcmtemail")[classPosition].style.border = '1px solid #ddd';
			//document.getElementsByClassName("bbcmtpassword")[classPosition].style.border = '1px solid #ddd';
			document.getElementsByClassName("bbcmt")[classPosition].style.border = '1px solid #F00';
			document.getElementsByClassName("bbcmt")[classPosition].focus();
			}else if(!bbCommentTerms){
			alert('Please accept terms and condiation of brandboost.');
			}else if(!bbCommentProcessing){
			alert('Please accept, Agree to Disqus processing of email and IP address, and the use of cookies, to facilitate my authentication and posting of comments, explained further in the Privacy Policy.');
			}else{
			document.getElementsByClassName("bb_overlay")[classPosition].style.display = 'block';
			document.getElementsByClassName("bbcmtname")[classPosition].style.border = '1px solid #ddd';
			document.getElementsByClassName("bbcmtemail")[classPosition].style.border = '1px solid #ddd';
			//document.getElementsByClassName("bbcmtpassword")[classPosition].style.border = '1px solid #ddd';
			document.getElementsByClassName("bbcmt")[classPosition].style.border = '1px solid #ddd';
			
			a = 'bbrid=' + rid + '&bbcmtname=' + fullname + '&bbcmtphone=' + phoneNo + '&bbcmtemail=' + emailadd + '&bbcmt=' + cmttxt;
			var bbsrc = this.userSettings.host + "/reviews/addcomment";
			var i = function (o) {
				var rsp = JSON.parse(o);
				var s = document.getElementsByClassName('bb-success-msg')[classPosition];
				var err = document.getElementsByClassName('bb-error-msg')[classPosition];
				document.getElementsByClassName("bb_overlay")[classPosition].style.display = 'none';
				
				if (rsp.status == 'ok') {
					//alert(rsp.status);
					t.show(s);
					t.hide(err);
					document.getElementsByClassName("bbcmt")[classPosition].value='';
					document.getElementsByClassName("bbcmtname")[classPosition].value='';
					document.getElementsByClassName("bbcmtemail")[classPosition].value='';
					document.getElementsByClassName("bbcmtphone")[classPosition].value='';
					//document.getElementsByClassName("bbcmtpassword")[classPosition].value='';
					//document.getElementsByClassName("bb_comment_terms")[classPosition].checked=false;
					//document.getElementsByClassName("bb_comment_processing")[classPosition].checked=false;
					}else{
					t.hide(s);
					t.show(err);
				}
				
				setTimeout(function(){
					t.hide(s);
					t.hide(err);
				}, 6000);
			}
			t.ajax(bbsrc, i, 'POST', a);
		}
	}
	
    function f() {
        var e = this,
		o = document.getElementsByClassName("bb-loaded")[0];
        if ("undefined" == typeof o) {
            setTimeout(function () {
                f.call(e)
			}, 50);
			} else {
			e.b_event('click', 'bbpw_helpful_action', 'save_helpful');
			e.b_event('click', 'bbcmtsubmit', 'save_comment');
			e.b_event('click', 'bbcmtreplysubmit', 'save_comment_reply');
			e.b_event('click', 'bbpw_comment_counter', 'bbpw_comment_section');
			
			e.b_event('click', 'bbpw_comment_like_action', 'bbpwCommentLikeBtnAction');
			e.b_event('click', 'bb_img_enlagre', 'bbpwZoomImg');
			e.b_event('click', 'bb_comment_reply', 'bbpwCommentReply');
			e.b_event('click', 'bbpw_show_all_comment', 'bbpwShowAllComments');
			e.b_event('click', 'bb_share_btn', 'bbpwShowSSLink');
			e.b_event('click', 'bbpw_share_ss', 'shareWithSocialSites');
			
            if (this.userSettings.center_popup_widget === true) {
                e.b_event('click', 'bbcpw_close_btn', 'bbcpw_close_action');
                e.b_event('click', 'bb_widget_scroll', 'bbWidgetScroll');
                e.b_event('click', 'bb_service_reviews', 'bbServiceReviews');
                e.b_event('click', 'bb_product_reviews', 'bbProductReviews');
                e.b_event('click', 'bb_site_reviews', 'bbSiteReviews');
			}
			
            if (this.userSettings.bottom_fixed_widget === true) {
                e.b_event('click', 'bb_slide_btn', 'move_slider');
				e.b_event('mouseover', 'bbpw_slider_widget', 'bbpwSliderWidget');
				e.b_event('click', 'bbpw_close_bfpw', 'bbCloseBPW');
			}
			
            if (this.userSettings.vertical_popup_widget === true) {
                //e.b_event('click', 'bbpw_vpw_review_btn', 'vpwReviewBtnAction');
				e.b_event('click', 'bbcpw_close_btn', 'bbcpw_close_action');
                e.b_event('click', 'bb_widget_scroll', 'bbWidgetScroll');
			}
			
			if (this.userSettings.button_widget === true) {
                e.b_event('click', 'bbpw_bw_review_btn', 'bpwReviewBtnAction');
				e.b_event('click', 'bb_widget_scroll', 'bbWidgetScroll');
			}
			
			if (this.userSettings.reviews_feed_widget === true) {
                //e.b_event('click', 'bbpw_comment_like_action', 'bbpwCommentLikeBtnAction');
                //e.b_event('click', 'bb_img_enlagre', 'bbpwZoomImg');
                //e.b_event('click', 'bb_comment_reply', 'bbpwCommentReply');
				//e.b_event('click', 'bbpw_show_all_comment', 'bbpwShowAllComments');
				//e.b_event('click', 'bb_share_btn', 'bbpwShowSSLink');
				//e.b_event('click', 'bbpw_share_ss', 'shareWithSocialSites');
                //e.b_event('click', 'bbpw_show_all_comment_popup', 'bbpwShowCCP');
				
				e.b_event('click', 'bb_service_reviews', 'bbServiceReviews');
                e.b_event('click', 'bb_product_reviews', 'bbProductReviews');
                e.b_event('click', 'bb_site_reviews', 'bbSiteReviews');
			}
		}
	}
	
	
	function pf() {
        var e = this,
		o = document.getElementsByClassName("bb-loaded")[0];
        if ("undefined" == typeof o) {
            setTimeout(function () {
                f.call(e)
			}, 50);
			} else {
			e.b_event('click', 'bbpw_helpful_action', 'save_helpful');
			e.b_event('click', 'bbcmtsubmit', 'save_comment');
			e.b_event('click', 'bbcmtreplysubmit', 'save_comment_reply');
			e.b_event('click', 'bbpw_comment_counter', 'bbpw_comment_section');
			e.b_event('click', 'bbpw_comment_like_action', 'bbpwCommentLikeBtnAction');
			e.b_event('click', 'bb_img_enlagre', 'bbpwZoomImg');
			e.b_event('click', 'bb_comment_reply', 'bbpwCommentReply');
		}
	}
    
    function u(t) {
        var e;
        return t >= 960 ? e = 3 : t >= 600 && 960 > t ? e = 2 : 600 > t && (e = 1), e
	}
    
    t.prototype.b_event = function (ev, c, an) {
        var e = this;
        var i = document.getElementsByClassName(c)[0];
        var j = document.getElementsByClassName(c)[1];
        if (ev == 'click') {
            if (an == 'save_helpful') {
                var s = document.getElementsByClassName("bbpw_helpful_action");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.a_helpful(this);
					});
				}
				} else if (an == 'save_comment') {
				var s = document.getElementsByClassName("bbcmtsubmit");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.s_comment(this);
					});
				}
				}else if (an == 'save_comment_reply') {
				var s = document.getElementsByClassName("bbcmtreplysubmit");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.s_comment_reply(this);
					});
				}
				} else if (an == 'bbpwCommentReply') {
				var s = document.getElementsByClassName("bb_comment_reply");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.bbpwCommentReply(this);
					});
				}
				} else if (an == 'bbpwShowCCP') {
				var s = document.getElementsByClassName("bbpw_common_comment_popup");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.bbpwShowCCP(this);
					});
				}
				} else if (an == 'bbpw_comment_section') {
				var s = document.getElementsByClassName("bbpw_comment_counter");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.bbpw_comment_section(this);
					});
				}
				} else if (an == 'vpwReviewBtnAction') {
                i.addEventListener('click', function () {
                    e.vpwReviewAction(this);
				});
				} else if (an == 'bbpwShowAllComments') {
				var s = document.getElementsByClassName("bbpw_show_all_comment");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.bbpwShowAllComments(this);
					});
				}
				} else if (an == 'bpwReviewBtnAction') {
                i.addEventListener('click', function () {
                    e.bpwReviewAction(this);
				});
				} else if (an == 'bbpwCommentLikeBtnAction') {
                var s = document.getElementsByClassName("bbpw_comment_like_action");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.save_comment_like(this);
					});
				}
				} else if (an == 'bbpwShowSSLink') {
                var s = document.getElementsByClassName("bb_share_btn");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.bbpwShowSSLink(this);
					});
				}
				} else if (an == 'shareWithSocialSites') {
                var s = document.getElementsByClassName("bbpw_share_ss");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.shareWithSocialSites(this);
					});
				}
				} else if (an == 'bbpwZoomImg') {
                var s = document.getElementsByClassName("bb_img_enlagre");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.zoom_image(this);
					});
				}
				} else if (an == 'bbcpw_close_action') {
                i.addEventListener('click', function () {
                    e.bbcpwCloseAction(this);
				});
				} else if (an == 'bbWidgetScroll') {
                var s = document.getElementsByClassName("bb_widget_scroll");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.bbWidgetScroll(this);
					});
				}
				} else if (an == 'bbServiceReviews') {
					i.addEventListener('click', function () {
						e.bbServiceReviews(this);
					});
				} else if (an == 'bbProductReviews') {
					i.addEventListener('click', function () {
						e.bbProductReviews(this);
					});
				} else if (an == 'bbSiteReviews') {
					i.addEventListener('click', function () {
						e.bbSiteReviews(this);
					});
				} else if (an == 'bbCloseBPW') {
                var s = document.getElementsByClassName("bbpw_close_bfpw");
                for (r = 0; r < s.length; ++r) {
                    var o = s[r];
                    s[r].addEventListener('click', function () {
                        e.bbCloseBPW(this);
					});
				}
				} else if (an == 'move_slider') {
				var classSH = 0;
                i.addEventListener('click', function () {
                    e.move_review_slider(this);
				});
				
                j.addEventListener('click', function () {
                    e.move_review_slider(this);
				});
			}
			}else if (ev == 'mouseover') {
			if (an == 'bbpwSliderWidget') {
				i.addEventListener('mouseenter', function () {
					e.bbpwSliderWidget(this);
				});
				
				i.addEventListener('mouseleave', function () {
					e.bbpwSliderWidgetMOut(this);
				});
			}
		}
	}
	
    t.prototype.move_review_slider = function (e) {
        var bd = (e.getAttribute("bb_direction"));
        if (bd == 'right') {
            showSlides(1)
			} else if (bd == 'left') {
            showSlides(-1)
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
BB.showOb = function (t, e) {
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
var sliderBoxCount = 4;
var slideIndex = 0;
var interval = null;
var clickValue = 0;
var newScrollVal = 0;

window.fbAsyncInit = function() {
	FB.init({
		appId            : '524948044663882',
		autoLogAppEvents : true,
		xfbml            : true,
		version          : 'v2.10'
	});
	FB.AppEvents.logPageView();
};

(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function showSlides(n=1) {
	var i;
	var slides = document.getElementsByClassName("bb_small_comment_box");
	if(n > 0){
		if(slides.length > sliderBoxCount + slideIndex){
			slides[slideIndex].style.display = "none";
			slides[sliderBoxCount + slideIndex].style.display = "block";
			slideIndex++;
			document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#fff';
			document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#fff';
			if(slides.length == sliderBoxCount + slideIndex){
				document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#eee';
			}
			}else{
			document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#eee';
		}
		}else{
		if((slides.length >= sliderBoxCount + slideIndex) && (slideIndex > 0)){
			--slideIndex;
			slides[slideIndex].style.display = "block";
			slides[sliderBoxCount + slideIndex].style.display = "none";
			document.getElementsByClassName("right_arrow")[0].style.backgroundColor = '#fff';
			document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#fff';
			
			if(sliderBoxCount == sliderBoxCount + slideIndex){
				document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#eee';
			}
			}else{
			document.getElementsByClassName("left_arrow")[0].style.backgroundColor = '#eee';
		}
	}
}

function bbpwValidateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

if (bbkey != 'undefined' && bbwidgets != 'undefined') {
    var bbwidget = bbwidgets.split("|");
	//console.log(bbwidget);
    // Include Css
    var oBB = new BB(bbkey, {
        "host": "http://brandboostx.com",
        "center_popup_widget": (bbwidget.indexOf("cpw") > -1) ? true : false,
        "bottom_fixed_widget": (bbwidget.indexOf("bfw") > -1) ? true : false,
        "vertical_popup_widget": (bbwidget.indexOf("vpw") > -1) ? true : false,
        "button_widget": (bbwidget.indexOf("bww") > -1) ? true : false,
        "reviews_feed_widget": (bbwidget.indexOf("rfw") > -1) ? true : false,
	});
	
    BB.ready(function () {
        // Include Widget
        oBB.p_widget();
        // Display Content
        oBB.g_reviews();
		
	});
}