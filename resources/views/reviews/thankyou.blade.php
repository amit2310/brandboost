<section class="top_text price">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert-success" style="margin-bottom:10px;">
					{{ $this->session->flashdata('success_msg') }}
                </div>
                <div class="alert-danger" style="margin-bottom:10px;">
					{{ $this->session->flashdata('error_msg') }}
                </div>
				<br>
				<h1>Thank you</h1>
                <br>
                @if($this->session->userdata('customer_user_id'))
					<strong>We are redirecting you into your admin panel shortly. Please wait</strong>
                @endif
            </div>
        </div>
    </div>
</section>

@if($this->session->userdata('customer_user_id'))
	<script>
		$(document).ready(function(){
			setTimeout(function(){
				window.location.href='admin/dashboard';
			}, 4000);
		});
	</script>
@endif
