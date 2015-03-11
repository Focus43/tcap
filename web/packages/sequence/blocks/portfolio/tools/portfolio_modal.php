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

<div class="container-fluid portfolio">
    <div class="row">
        <div class="col-sm-12 portfolio-head">
            <div class="close" close-modal><span class="icn-close-circle"></span></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <?php
            if ( is_object($fileSetObj) ){ $filesInSet = $fileSetObj->getFiles(); }
            $fileCount = 0;
            ?>
            <div masthead progress-indicator="progress" data-transition-speed="0.5"<?php if(!$isEditMode && (count((array)$filesInSet) > 1)){echo ' data-loop-timing="12"';} ?>
                 style="max-height: 500px;height: 390px;margin-bottom: 20px;">
                <?php if(!empty($filesInSet)): foreach($filesInSet AS $index => $fileObj): if($fileObj): ?>
                <div class="node" style="max-height: 500px;height: 390px;background-image:url('<?php echo $fileObj->getRelativePath(); ?>');">
                    <div class="progress"></div>
                    <div class="inner" style="display: none;"><div class="node-content"></div></div>
                </div>
                <?php $fileCount ++;
                endif; endforeach; endif; ?>
                <?php if( $fileCount > 1 ): ?>
                    <a class="arrows icn-angle-left"></a>
                    <a class="arrows icn-angle-right"></a>
                    <div class="markers">
                        <?php for($i = 0; $i < $fileCount; $i++): ?>
                            <a class="<?php echo $i === 0 ? 'active' : ''; ?>"><i class="icn-circle"></i></a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 portfolio-details">
            <div class="anglified">
                <h3><?php echo $portfolioObj->getTitle(); ?></h3>
                <div accordion="" data-speed="0.25">
                    <div class="group active">
                        <div class="accordion-header"><span class="icn-file-text"></span> Project Overview</div>
                        <div class="accordion-body" style="height: 200px;overflow-y: auto;">
                            <div class="accordion-content"><?php echo $portfolioObj->getDescription(); ?></div>
                        </div>
                    </div>
                    <div class="group">
                        <div class="accordion-header"><span class="icn-office"></span> Client</div>
                        <div class="accordion-body" style="height: 0px;">
                            <div class="accordion-content"><a href="<?php echo getClientUrl; ?>" class="client-link" target="_blank"><?php echo $portfolioObj->getClientName(); ?></a></div>
                        </div>
                    </div>
                    <div class="group">
                        <div class="accordion-header"><span class="icn-cabinet"></span> Category</div>
                        <div class="accordion-body" style="height: 0px;">
                            <div class="accordion-content"><?php echo $portfolioObj->getCategoryString(); ?></div>
                        </div>
                    </div>
                    <div class="group">
                        <div class="accordion-header"><span class="icn-tools"></span> Tools Used</div>
                        <div class="accordion-body" style="height: 0px;">
                            <div class="accordion-content"><?php echo $portfolioObj->getToolsUsed(); ?></div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo getProjectUrl; ?>" class="btn-portfolio" target="_blank">View Project</a>
            </div>
        </div>
    </div>
</div>