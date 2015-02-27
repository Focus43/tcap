<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$form = Loader::helper('form');
?>

<form method="post" action="<?php echo $this->action('save', $portfolioObj->getID()); ?>">
    <div class="form-group">
        <label>Title</label>
        <?php echo $form->text("title", $portfolioObj->getTitle()); ?>
    </div>
    <div class="form-group">
        <label>Description</label>
<!--        <textarea class="form-control" rows="3" name="description" value="--><?php //echo $title; ?><!--"></textarea>-->
        <?php echo $form->textarea("description", $portfolioObj->getDescription(), array('rows' => '3')); ?>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label>Category</label>
            <?php echo $form->select("category[]", $categoryOptions, $portfolioObj->getCategory(), array('multiple' => 'multiple')); ?>
        </div>
        <div class="form-group col-sm-6">
            <label>Tools Used</label>
            <?php  echo $form->textarea("toolsUsed", $portfolioObj->getToolsUsed(), array('rows' => '3')); ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label>Client Name</label>
            <?php echo $form->text("clientName", $portfolioObj->getClientName()); ?>
        </div>
        <div class="form-group col-sm-6">
            <label>Client URL</label>
            <?php echo $form->text("clientUrl", $portfolioObj->getClientUrl()); ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label>Project URL</label>
            <?php echo $form->text("projectUrl", $portfolioObj->getProjectUrl()); ?>
        </div>
        <div class="form-group col-sm-6">
            <label>Portfolio Image Set</label>
            <?php echo $form->select('galleryFileSetID', $availableFileSets, $portfolioObj->getGalleryFileSetID()); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label>Main Image</label>
            <?php $al = Loader::helper('concrete/asset_library'); echo $al->image('mainImage', 'mainImageID', t('Select an image'), $portfolioObj->getMainImageID()); ?>
        </div>
    </div>
    <button type="submit" class="btn primary pull-right">Save</button>

</form>




<!--    <div class="form-group">-->
<!--        <label for="exampleInputPassword1">Password</label>-->
<!--        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="exampleInputFile">File input</label>-->
<!--        <input type="file" id="exampleInputFile">-->
<!--        <p class="help-block">Example block-level help text here.</p>-->
<!--    </div>-->
<!--    <div class="checkbox">-->
<!--        <label>-->
<!--            <input type="checkbox"> Check me out-->
<!--        </label>-->
<!--    </div>-->
<!--    <button type="submit" class="btn btn-default">Submit</button>-->
<!--</form>-->