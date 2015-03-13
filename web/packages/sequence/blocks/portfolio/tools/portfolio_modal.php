<?php
use Concrete\Package\Sequence\Controller AS PackageController;
use Concrete\Package\Sequence\Src\SequencePortfolio;

$portfolioObj = SequencePortfolio::getByID((int)$_REQUEST['pId']);
$fileSetObj = FileSet::getByID((int) $portfolioObj->getGalleryFileSetID());
?>

<div class="container-fluid portfolio">
    <div class="row">
        <div class="col-sm-12 portfolio-head text-center">
            <div class="close" close-modal><span class="icn-th"></span></div>
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
            <h4><?php echo $portfolioObj->getTitle(); ?> <small>Details</small></h4>
            <?php echo $portfolioObj->getDescription(); ?>

            <div accordion data-speed="0.25">
                <!--<div class="group active">
                    <div class="accordion-header"><span class="icn-file-text"></span> Project Overview</div>
                    <div class="accordion-body">
                        <div class="accordion-content">
                            <?php echo $portfolioObj->getDescription(); ?>
                        </div>
                    </div>
                </div>-->
                <div class="group">
                    <div class="accordion-header"><span class="icn-pie-chart"></span> Client</div>
                    <div class="accordion-body">
                        <div class="accordion-content">
                            <p><a href="<?php echo getClientUrl; ?>" class="client-link" target="_blank"><?php echo $portfolioObj->getClientName(); ?></a></p>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <div class="accordion-header"><span class="icn-inbox"></span> Category</div>
                    <div class="accordion-body">
                        <div class="accordion-content">
                            <p><?php echo $portfolioObj->getCategoryString(); ?></p>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <div class="accordion-header"><span class="icn-cog"></span> Tools Used</div>
                    <div class="accordion-body">
                        <div class="accordion-content">
                            <p><?php echo $portfolioObj->getToolsUsed(); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?php echo getProjectUrl; ?>" class="btn btn-lg btn-primary btn-block" target="_blank">View Project</a>
        </div>
    </div>
</div>