<table class="table datatable-basic datatable-sorting notes-table">
    <thead class="hidden">
        <tr>
            <th><i class="icon-stack-star"></i>Name</th>
            <th><i class="icon-star-full2"></i>Rating</th> 
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($oNotes)) {
            foreach ($oNotes as $key => $value) {
                $icon = '<i class="icon-star-full2 txt_purple"></i>';
                ?>
                <tr class="notesShow">
                    <td>
                        <div class="media-left media-middle"> <a class="icons" style="cursor: text;"><?php echo $icon; ?></a> </div>
                        <div class="media-left" style="max-width: 530px;">
                            <div class="pt-5">
                                <a style="cursor: pointer;" class="text-default text-semibold" notesId="<?php echo $value->id; ?>"><?php echo make_links_clickable($value->notes); ?></a></div>
                        </div>
                    </td> 
                    <td class="text-right">
                        <span class="text-muted text-size-small">Added By <?php echo $value->firstname . ' ' . $value->lastname; ?></span><br>
                        <span class="text-muted text-size-small"><?php echo date('F d Y', strtotime($value->created)); ?>  <?php //echo date('h:i A ',strtotime($value->created));                        ?></span>

                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>