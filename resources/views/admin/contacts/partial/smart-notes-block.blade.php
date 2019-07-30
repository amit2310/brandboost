<?php
if (!empty($oNotes)) {
    foreach ($oNotes as $key => $noteData) {
        ?>
        <p class="txt_grey2 fsize13 lh24 bbot">
            <?php echo $noteData->notes; ?>
            <br>
            <small class="text-muted">On <?php echo date('F d, Y h:i A', strtotime($noteData->created)); ?> by <?php echo $noteData->firstname . ' ' . $noteData->lastname; ?></small>
        </p>    

        <?php
    }
} else {
    ?>
    <div class="text-center mt10"><?php echo displayNoData(); ?></div> 
    <?php
}
?>


