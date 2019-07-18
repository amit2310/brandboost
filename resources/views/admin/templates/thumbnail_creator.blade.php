<div id="thumbtemplateContent" style="padding:10px;<?php if($templateType == 'sms'):?>width:276px;<?php endif; ?>">
    <?php echo $content; ?>
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/modules/html2canvas/html2canvas.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/modules/html2canvas/jquery.js"></script>
<script type="text/javascript">


    $(document).ready(function () {
        html2canvas(document.querySelector("#thumbtemplateContent")).then(canvas => {
            //document.body.appendChild(canvas)
            var img = canvas.toDataURL("image/png");
            document.write('<img src="' + img + '" border="1"/>');
            createThumbnail(img);
        });

    });

    function createThumbnail(imagestring) {
        var templateId = '<?php echo $templateID; ?>';
        $.ajax({
            url: '/admin/templates/updateThumbnail',
            type: "POST",
            data: {_token: '{{csrf_token()}}', templateId: templateId, imgsrc: imagestring},
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    //alert('Saved changes successfully');
                    console.log('thumbnail created successfully!');
                }
            }
        });
    }
</script>   
