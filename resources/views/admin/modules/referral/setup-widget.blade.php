@extends('layouts.main_template') 

@section('title')
{{ $title }}
@endsection

@section('contents')
<div class="content">
				  
  <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
	<div class="page_header">
	  <div class="row">
	  <!--=============Headings & Tabs menu==============-->
		<div class="col-md-7">
		  <h3 class="mt30"><img style="width: 16px;" src="{{ base_url() }}assets/images/refferal_icon.png"> New Referral Campaign</h3>
		</div>
		<!--=============Button Area Right Side==============-->
		<div class="col-md-5 text-right btn_area">

        <button type="button" style="padding: 7px 15px!important;" class="btn dark_btn publishReferralStatus" status="draft"><i class="icon-plus3"></i><span> &nbsp;  Save as Draft</span> </button>

        <button type="button" style="padding: 7px 15px!important;" class="btn dark_btn publishReferralStatus" status="active"><i class="icon-plus3"></i><span> &nbsp;  Publish</span> </button>
		 </div>
	  </div>
	</div>
  <!--&&&&&&&&&&&& PAGE HEADER END&&&&&&&&&&-->
  
  
	<!--&&&&&&&&&&&& TABBED CONTENT START &&&&&&&&&&-->
	
	   <!--==================Broadcasts Menu============-->
		<div class="row">
			<div class="col-md-12">
				<div class="white_box broadcast_menu nps">
					<ul>
					<li><a href="{{ base_url() }}admin/modules/referral/setup/{{ $moduleUnitID }}"><img src="<?php echo base_url(); ?>assets/images/email_br_icon1_grey.png">Select Source</a></li>
					<li><a href="{{ base_url() }}admin/modules/referral/reward/{{ $moduleUnitID }}"><img src="<?php echo base_url(); ?>assets/images/email_br_icon2.png">Rewards</a></li>
					<li><a href="{{ base_url() }}admin/modules/referral/workflow/{{ $moduleUnitID }}"><img src="<?php echo base_url(); ?>assets/images/email_br_icon3.png">Email Workflow</a></li>
					<li><a href="{{ base_url() }}admin/modules/referral/configurations/{{ $moduleUnitID }}"><img src="<?php echo base_url(); ?>assets/images/email_br_icon4.png">Configuration</a></li>
					<li><a class="active" href="javascript:void(0);"><img src="{{ base_url() }}assets/images/email_br_icon5_act.png">Integration</a></li>
				</ul>
				</div>
			</div>
		</div>
		<div class="select_section" style="max-width: 100%;">
	<div class="row">
      <div class="col-md-3">
        <div style="margin: 0;" class="panel panel-flat">
          <div class="panel-heading">
            <h6 class="panel-title">How to add widget</h6>
          </div>
          <div class="panel-body p0">
            <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item br0"  src="https://www.youtube.com/embed/2H_Jsgh2Z3Y?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-6">
        <div  class="panel panel-flat">
          <div class="panel-heading">
            <h6 class="panel-title">Invite Code</h6>
          </div>
          <div class="panel-body min_h270 p0">
          <div class="p20 bbot">
            <pre class="prettyprint">
&lt;script
    type="text/javascript" 
    id="bbscriptloader" 
    data-key="{{ $oSettings->hashcode }}" 
    data-widgets="referral" 
    async="true" src="{{ base_url() }}assets/js/ref_widgets.js"&gt;
&lt;/script&gt;</pre>                        
    </div>
    <div class="invite_code_copy" style="display: none;">&lt;script type="text/javascript" id="bbscriptloader" data-key="{{ $oSettings->hashcode }}" data-widgets="referral" async="true" src="{{ base_url() }}assets/js/ref_widgets.js"&gt;&lt;/script&gt;
    </div> 
    <div class="p20">
    <button class="btn btn-xs btn_white_table pl10 pr10"  onclick="copyToClipboard('.invite_code_copy')">Copy Code</button>
    </div>
    
  </div>
</div>

<div  class="panel panel-flat">
  <div class="panel-heading">
    <h6 class="panel-title">Post Purchase Code</h6>
  </div>
  <div class="panel-body min_h270 p0">
  <div class="p20 bbot">

<pre class="prettyprint dummyPostSaleCodeWithoutPopup_new">
&lt;div id="bb-invoice_details" 
        data-bb-firstname="Alen"
        data-bb-lastname="Sultanic"
        data-bb-email="umair.products@gmail.com"
        data-bb-invoice-id="12345"
        data-bb-amount="10"
        data-bb-currency="USD"
        data-bb-timestamp="{{ time() }}"&gt;
&lt;/div&gt;
&lt;script type="text/javascript" 
         id="bbscriptloader" 
         data-key="{{ $oSettings->hashcode }}" 
         data-widgets="referral-sale" 
         async="true" 
         src="{{ base_url() }}assets/js/ref_widgets.js"&gt;
&lt;/script&gt;
</pre>                      

<pre class="prettyprint dummyPostSaleCodeWithPopup_new" style="display: none;" >
&lt;div id="bb-invoice_details" 
        data-bb-firstname="Alen"
        data-bb-lastname="Sultanic"
        data-bb-email="umair.products@gmail.com"
        data-bb-invoice-id="12345"
        data-bb-amount="10"
        data-bb-currency="USD"
        data-bb-timestamp="{{ time() }}"
        data-bb-showwidget="true"&gt;
&lt;/div&gt;
&lt;script type="text/javascript" 
         id="bbscriptloader" 
         data-key="{{ $oSettings->hashcode }}" 
         data-widgets="referral-sale" 
         async="true" 
         src="{{ base_url() }}assets/js/ref_widgets.js"&gt;
&lt;/script&gt;
</pre> 
                                
    </div>

   
    <div class="p20">
    <button class="btn btn-xs btn_white_table pl10 pr10 withOutPopup" onclick="copyToClipboard('.dummyPostSaleCodeWithoutPopup_new')">Copy Code</button>
    <button class="btn btn-xs btn_white_table pl10 pr10 withPopup" style="display: none;" onclick="copyToClipboard('.dummyPostSaleCodeWithPopup_new')">Copy Code</button>
    </div>
    
  </div>
</div>
  </div>
  
  
  <div class="col-md-3">

    <div style="margin: 0;" class="panel panel-flat">
      <div class="panel-heading">
        <h6 class="panel-title">You’re All Set!</h6>
      </div>
      <div class="panel-body min_h270 p0">
        <div class="bbot p20 m0">
          <p>Visit your store's dashboard and find your purchase completed page.Paste this code just before the closing body tag on your purchase completed page after replacing these dynamic variables: You must replace the following dummy fields in the code snippet with dynamic checkout data from your store platform:
          </p>
        </div>
      
      
        <div class="bbot p20">
            <p class="fsize11 text-muted m0">
            data-bb-firstname: Customer First Name<br><br>

            data-bb-lastname: Customer Last Name<br><br>

            data-bb-email: Customer Email Address<br><br>

            data-bb-invoice-id: Invoice Number<br><br>

            data-bb-amount: Invoice Amount<br><br>

            data-bb-currency: Invoice Currency (3 letter code)<br><br>

            data-bb-timestamp: Purchase Timestamp (UNIX time)<br><br>                      
            </p>
        </div>
        <div class="p20" style="padding-bottom:30px!important;">
            <label class="custmo_checkbox">
            <input type="checkbox" class="showPopupAfterSaleIntegration">
            <span class="custmo_checkmark"></span>
            &nbsp; Display Referral popup after successful purchase
            </label>
        </div>
      </div>
    </div>
  </div>
  
<div class="row">
	<input type="hidden" name="refId" id="refId" value="<?php echo $moduleUnitID; ?>">
	<div class="col-md-6"><button class="btn btn_white bkg_white h52 txt_dark minw_140 shadow br5 backPage"><i class="icon-arrow-left12 mr20"></i> Back</button></div>
	<div class="col-md-6 text-right"><button class="btn dark_btn bkg_dgreen2 h52 minw_160 publishReferral">Publish <i class="icon-arrow-right13 ml20"></i></button></div>
</div>  
</div>

</div>

<div id="addPeopleList" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-user"></i>&nbsp; Contacts</h5>
            </div>
            <div class="modal-body">
                <div class="panel-body">

                    <form name="frmInviteCustomer" id="frmInviteCustomer" method="post" action="" >
						@csrf
                        <input type="hidden" name="userid" value="{{ $userID }}" />
                        <input type="hidden" name="bbaid" value="{{ $oSettings->hashcode }}" />
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <div class="">
                                    <input name="firstname" id="firstname" class="form-control" type="text" required="">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <div class="">
                                    <input name="lastname" id="lastname" class="form-control" value="" type="text" required="">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="">
                                    <input name="email" id="email" value="" class="form-control" type="text" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="">
                                    <input name="phone" id="phone" value="" class="form-control" type="text">
                                </div>
                            </div>

                            <button class="btn btn-success pull-right" id="btnInvite" type="submit">
                                Invite Advocates
                            </button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
		$(".publishReferral").click(function () {
			$('.overlaynew').show();
			window.location.href = "{{ base_url('/admin/modules/referral/') }}";
        });
		
		$(".backPage").click(function () {
			var refId = $('#refId').val();
			$('.overlaynew').show();
			window.location.href = "{{ base_url('/admin/modules/referral/configurations/') }}"+refId;
        });
		
		$(".showPopupAfterSaleIntegration").change(function () {

            if ($(this).is(":checked")) {
            	$(".dummyPostSaleCodeWithoutPopup_new").hide();
                $(".dummyPostSaleCodeWithPopup_new").show();

                $('.withOutPopup').hide();
                $('.withPopup').show();
				$(".showPopupAfterSaleIntegration").prop("checked", true);

			} else {
                $(".dummyPostSaleCodeWithoutPopup_new").show();
                $(".dummyPostSaleCodeWithPopup_new").hide();

                $('.withOutPopup').show();
                $('.withPopup').hide();
                $(".showPopupAfterSaleIntegration").prop("checked", false);
			}
			
		});
		
		$("#frmInviteCustomer").submit(function () {
			$('.overlaynew').show();
			var formData = new FormData($(this)[0]);
			$('#btnInvite').prop("disabled", true);
			$.ajax({
				url: "{{ base_url('admin/modules/referral/registerInvite') }}",
				type: "POST",
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (data) {
					$('.overlaynew').hide();
					if (data.status == 'success') {
						window.location.href = window.location.href;
					} else {
						alertMessage('Error: Some thing wrong!');
						$('.overlaynew').hide();
					}
				}
			});
			return false;
		});

    $(document).on('click', '.publishReferralStatus', function() {

        var status = $(this).attr('status');
        $.ajax({
            url: "{{ base_url('admin/modules/referral/publishReferralStatus') }}",
            type: "POST",
            data: {'ref_id': "{{ $moduleUnitID }}", 'status':status, _token: '{{csrf_token()}}'},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    if(status == 'active') {
                        displayMessagePopup('success', 'Campaign pushlished successfully');
                    }
                    else {
                         displayMessagePopup('success', 'Campaign saved as draft successfully');
                    }
                } else {
                    alertMessage('Error: Some thing wrong!');
                }
            }
        });
    });
});
	
	function copyToClipboard(element) {
		console.log(element);
		var $temp = $("<input>");
		$("body").append($temp);
		var widgetScript = String($(element).text());
		$temp.val(widgetScript).select();
		document.execCommand("copy");
		$temp.remove();
	}
</script>
@endsection