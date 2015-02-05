<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <img src="<?php echo ($photoFileObj instanceof File) ? $photoFileObj->getRelativePath() : ''; ?>" />
        </div>
        <div class="col-sm-8">
            <div class="anglified">
                <h3><?php echo $fullName; ?><br/><span class="theme-highlight-color"><?php echo $title; ?></span></h3>
                <?php echo $bio; ?>
            </div>
        </div>
    </div>
</div>

<a class="modal-nav prev icn-angle-left" modal-reload=""></a>
<a class="modal-nav next icn-angle-right" modal-reload=""></a>