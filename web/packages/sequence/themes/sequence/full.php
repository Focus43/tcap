<!DOCTYPE HTML>
<html ng-app="sequence" ng-controller="CtrlRoot" ng-class="rootClasses" lang="<?php echo LANGUAGE; ?>" class="pt-full no-disclaimer <?php echo $isEditMode ? 'cms-edit-mode' : ''; ?>">
<?php $this->inc('elements/head.php'); ?>

<body<?php if($pagePermissionObj->canWrite()){ echo ' can-admin'; } ?>>

<div id="c-level-1" class="<?php echo $c->getPageWrapperClass(); ?>">

    <?php $this->inc('elements/header.php', array('homeLinkOnly' => true)); ?>

    <main slideable>
        <section>
            <?php
                $a = new Area("Main {$i}"); /** @var $a \Concrete\Core\Area\Area */
                $a->enableGridContainer();
                $a->display($c);
            ?>
        </section>

        <?php $this->inc('elements/footer.php'); ?>
    </main>
    <aside scroll-top class="icn-angle-up"></aside>
</div>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>