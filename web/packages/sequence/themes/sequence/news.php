<!DOCTYPE HTML>
<html ng-app="sequence" ng-controller="CtrlRoot" ng-class="rootClasses" lang="<?php echo LANGUAGE; ?>" class="pt-news no-disclaimer <?php echo $isEditMode ? 'cms-edit-mode' : ''; ?>">
<?php $this->inc('elements/head.php'); ?>

<body<?php if($pagePermissionObj->canWrite()){ echo ' can-admin'; } ?>>

<div id="c-level-1" class="<?php echo $c->getPageWrapperClass(); ?>">

    <?php $this->inc('elements/header.php', array('homeLinkOnly' => true)); ?>

    <main slideable>
        <div class="container pseudo-header">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="theme-highlight-color"><?php echo Page::getCurrentPage()->getCollectionName(); ?> <small class="theme-extra-light-color">Jun 17, 2015</small></h1>
                </div>
            </div>
        </div>
        <div>
            <?php
                $a = new Area("Main {$i}"); /** @var $a \Concrete\Core\Area\Area */
                $a->enableGridContainer();
                $a->display($c);
            ?>
        </div>

        <?php $this->inc('elements/footer.php'); ?>
    </main>
    <aside scroll-top class="icn-angle-up"></aside>
</div>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>