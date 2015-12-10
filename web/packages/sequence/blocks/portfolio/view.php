<?php
$textHelper = Loader::helper('text');
?>

<div isotope>
    <ul class="text-center" isotope-filters>
        <li><a class="active" data-filter="*">Show All</a></li>
        <?php
        foreach($categoryList AS $key=>$category){
            echo '<li><a data-filter="[data-category-'.$key.']">'.$category.'</a></li>' . "\n";
        }
        ?>
    </ul>
    <div class="grid-wrapper">
        <div isotope-grid>
            <?php foreach( $portfolioList AS $portfolio) : ?>
                <a class="isotope-node" hover-direction="isotope-box" modalize="<?php echo Loader::helper('concrete/urls')->getBlockTypeToolsURL($bt); ?>/portfolio_modal?pId=<?php echo $portfolio->getID(); ?>" data-modal-classes="['portfolio']" <?php echo implode(" ", array_map(function($id){return "data-category-{$id}";}, array_values($portfolio->getMemberCategories()) )); ?> style="background-image:url('<?php $fileObj = File::getByID((int)$portfolio->getMainImageID()); if($fileObj){echo $fileObj->getRelativePath();} ?>');">
                    <div class="isotope-box" >
                        <div class="isotope-content">
                            <h5><?php echo $portfolio->getTitle(); ?></h5>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
    </div>
</div>
