<?php foreach($portfolioList AS $portfolio): ?>
    <img src="<?php echo File::getByID((int)$portfolio->getMainImageID())->getRelativePath(); ?>" style="max-width:600px;max-height:425px;" />
<?php endforeach; ?>