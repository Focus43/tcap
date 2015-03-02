<?php
$textHelper = Loader::helper('text');
?>

<div isotope>
    <ul class="text-center" isotope-filters>
        <li><a class="active" data-filter="*">Show All</a></li>
        <?php
        foreach($categoryList AS $key=>$category){
            echo '<li><a data-filter="['.$key.']">'.$category.'</a></li>' . "\n";
        }
        ?>
    </ul>
    <div class="grid-wrapper">
        <div isotope-grid class="portfolio-grid">
            <?php foreach( $portfolioList AS $portfolio) : ?>
                <a class="isotope-node" modalize="<?php echo Loader::helper('concrete/urls')->getBlockTypeToolsURL($bt); ?>/portfolio_modal?pId=<?php echo $portfolio->getID(); ?>'" data-modal-classes="['portfolio']" <?php echo str_replace(",", " ",$portfolio->getCategory()); ?>>
                    <div class="isotope-box" style="background-image:url('<?php echo File::getByID((int)$portfolio->getMainImageID())->getRelativePath(); ?>');">
                        <div class="isotope-content">
                            <h5><?php echo $portfolio->getTitle(); ?></h5>
                            <p><?php echo $portfolio->getCategoriesString(); ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
    </div>
</div>
