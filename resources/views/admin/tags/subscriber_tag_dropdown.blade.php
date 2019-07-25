<button type="button" class="btn btn-xs btn_white_table dropdown-toggle " data-toggle="dropdown"><i class="icon-hash"></i> <?php echo count($oTags); ?> Tags &nbsp; <span class="caret"></span></button>
<ul class="dropdown-menu dropdown-menu-right width-200">
    <?php if (!empty($oTags)): ?>
        <?php foreach ($oTags as $oTag): ?>
            <li><a href="javascript:void(0);"><?php echo $oTag->tag_name; ?></a>
            <?php endforeach; ?>
        <?php endif; ?>

</ul>