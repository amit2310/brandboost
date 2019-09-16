<style>
    .box.box3.smpop_fixed h5 { background:none!important; color:#000!important}
</style>
<div class="p20" style="width: 585px;overflow: hidden; height: 100%;">
    <h5 class="panel-title">Question</h5>

    <form name="UpdateQuestionFrm" id="UpdateQuestionFrm" method="post" class="form-horizontal">
        @csrf
        <input name="faq_id" id="faq_id" type="hidden" value="{{ $oFdetails->id }}">
        <a style="position: absolute; right: 20px; top: 17px;" href="javascript:void(0)"><i class="editIconPre"><img src="/assets/images/edit_icon.png"></i>
            <i style="display:none" class="editIconPost"><img src="/assets/images/edit_icon.png"></i>
        </a>
        <div class="p20">
            <div class="">
                <p class="pre fsize14 fw400 txt_dark">{{ $oFdetails->question }}</p>

                <p style="display:none" class="post fsize14 fw400 txt_dark"><textarea name="question" id="question_update" required class="fsize14 fw400 txt_dark form-control">{{ $oFdetails->question }}</textarea></p>
            </div>
            <div class="bbot btop pt15 pb15 mt20 mb20">
                <p class="fsize14 fw500 txt_dark m0">Answer</p>
            </div>
            <div class="">
                <p class="pre fsize14 fw300 txt_dark2">{{ trim($oFdetails->answer) }}</p>
                <p style="display:none" class="post fsize14 fw300 txt_dark2">
                    <textarea style="min-height:180px" name="answer" id="answer_update" required class="fsize14 fw300 txt_dark2 form-control">{{ trim($oFdetails->answer) }}</textarea></p>
            </div>
        </div>
        <div class="box_footer_btn">
            <div class="p30">
            <button type="submit" class="btn dark_btn mr20 brand_sec_bkg">Save</button>
            <a style="display:none" href="btn-link" class="txt_dred deleteFaq">Delete</a>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#UpdateQuestionFrm').on('submit', function (e) {
            e.preventDefault();
            $('.overlaynew').show();
            $.ajax({
                url: "{{ base_url() }}/admin/brandboost/UpdateFaqData",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false, //
                dataType: "json",
                success: function (data)
                {
                    if (data.status == "success")
                    {
                        setTimeout(function () {
                            $('.overlaynew').hide();
                            window.location.href = '?tab=3';
                        }, 1000);
                    } else {
                        alertMessage("Something went wrong");
                    }
                }
            });
        });
    });

    $(document).on('click', '.editIconPre', function () {
        $('.pre').hide();
        $('.post').show();
        $('.editIconPre').hide();
        $('.editIconPost').show();
    });

    $(document).on('click', '.editIconPost', function () {
        $('.pre').show();
        $('.post').hide();
        $('.editIconPost').hide();
        $('.editIconPre').show();
    });
</script>
