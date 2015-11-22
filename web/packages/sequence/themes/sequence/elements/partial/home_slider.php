<div masthead data-transition-speed="0.5"<?php if(!$isEditMode && (count($mastheadImages) > 1)){echo ' data-loop-timing="12"';} ?>>
    <?php if(!empty($mastheadImages)): foreach($mastheadImages AS $index => $fileObj): ?>
        <div class="node" style="background-image:url('<?php echo $fileObj->getRelativePath(); ?>');">
            <div class="inner">
                <div class="node-content">
                    <div class="hidden-xs" data-viz-d>
                        <?php $index++; $a = new Area("Masthead {$index}"); $a->display($c); ?>
                    </div>
                    <div class="visible-xs" data-viz-m>
                        <?php $a = new Area("Masthead Mobile {$index}"); $a->display($c); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; endif; ?>

    <?php if(count($mastheadImages) > 1): ?>
        <a class="arrows icn-angle-left"></a>
        <a class="arrows icn-angle-right"></a>
        <div class="markers">
            <?php for($i = 0; $i < count($mastheadImages); $i++): ?>
                <a class="<?php echo $i === 0 ? 'active' : ''; ?>"><i class="icn-circle"></i></a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>