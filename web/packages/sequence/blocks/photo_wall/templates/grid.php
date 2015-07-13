<div isotope-gallery>
    <?php foreach((array)$fileListResults AS $fileObj){
        if( is_object($fileObj) ){ ?>
            <div class="isotope-node">
                <div class="isotope-box" style="background-image:url('<?php echo $fileObj->getRelativePath(); ?>');"></div>
            </div>
        <?php }
    } ?>
</div>