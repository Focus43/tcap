<?php

use Concrete\Package\Sequence\Controller AS PackageController;
use Concrete\Package\Sequence\Src\SequencePortfolio;

$portfolioObj = SequencePortfolio::getByID((int)$_REQUEST['pId']);
$fileSetObj = FileSet::getByID((int) $portfolioObj->getGalleryFileSetID());
?>
<style>
    div.portfolio-head { text-align: center; }
    div.portfolio-head div.close { display: inline-block;margin: 10px auto;font-size: 50px; }
    div.portfolio-details p { padding-top: 10px; }
    div.portfolio-image { text-align: center; }
    div.portfolio-image img { display: inline-block;margin: 10px auto; }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 portfolio-head">
            <div class="close" close-modal><span class="icn-close-circle"></span></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 portfolio-details">
            <div class="anglified">
                <h3><?php echo $portfolioObj->getTitle(); ?></h3>
                <span class="theme-highlight-color"><?php echo $portfolioObj->getCategoriesString(); ?></span>
                <?php echo $portfolioObj->getDescription(); ?>
            </div>
        </div>
    </div>
    <?php
    if( is_object($fileSetObj) ){
    $filesInSet = $fileSetObj->getFiles();
    if(!empty($filesInSet)): foreach($filesInSet AS $fileObj): if($fileObj): /** @var $fileObj \Concrete\Core\File\File */ ?>
        <div class="row"><div class="col-sm-12 portfolio-image"><img src="<?php echo $fileObj->getRelativePath(); ?>"></div></div>
    <?php endif; endforeach; endif;
    }
    ?>
</div>