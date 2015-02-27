<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$form = Loader::helper('form');
$fp = FilePermissions::getGlobal();
$tp = new TaskPermission();
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
            <?php
            $al = Loader::helper('concrete/asset_library');
            $f = File::getByID((int)$portfolioObj->getMainImageID());
            echo $al->image('mainImage', 'mainImageID', t('Select an image'), $f);
            ?>
        </div>
    </div>
    <button type="submit" class="btn primary pull-right">Save</button>

</form>
<script type="text/javascript">
    $(function() {
        $('#description').redactor({
            minHeight: '125',
            'concrete5': {
                filemanager: <?=$fp->canAccessFileManager()?>,
                sitemap: <?=$tp->canAccessSitemap()?>,
                lightbox: true
            },
            'plugins': [
                'fontcolor', 'concrete5', 'underline'
            ]
        });
    });
</script>