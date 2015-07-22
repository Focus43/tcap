<!DOCTYPE HTML>
<html ng-app="sequence" ng-controller="CtrlRoot" ng-class="rootClasses" lang="<?php echo LANGUAGE; ?>" class="pt-news no-disclaimer <?php echo $isEditMode ? 'cms-edit-mode' : ''; ?>">
<?php $this->inc('elements/head.php'); ?>

<body<?php if($pagePermissionObj->canWrite()){ echo ' can-admin'; } ?>>

<div id="c-level-1" class="<?php echo $c->getPageWrapperClass(); ?>">

    <?php $this->inc('elements/header.php', array('homeLinkOnly' => true)); ?>

    <main slideable>
        <div class="container">
            <div class="row" style="padding-top:9rem;">
                <div class="col-sm-9">
                    <?php
                    $a = new Area("Main"); /** @var $a \Concrete\Core\Area\Area */
                    $a->display($c);
                    ?>
                </div>
                <div class="col-sm-3">
                    <div class="sidebar-box">
                        <input type="text" class="form-control" placeholder="Search" />
                    </div>
                    <div class="sidebar-box">
                        <h4>Recent Posts</h4>
                        <ul class="unstyled">
                            <li><a>Lorem Ipsum</a></li>
                            <li><a>Dolor Sit Amet</a></li>
                            <li><a>Consect et tetur</a></li>
                        </ul>
                    </div>
                    <div class="sidebar-box">
                        <h4>Archives</h4>
                        <ul class="unstyled">
                            <li><a>July 2015</a></li>
                            <li><a>June 2015</a></li>
                            <li><a>May 2015</a></li>
                        </ul>
                    </div>
                    <div class="sidebar-box">
                        <h4>Categories</h4>
                        <ul class="unstyled">
                            <li><a>Lorem Ipsum</a></li>
                            <li><a>Dolor Sit Amet</a></li>
                            <li><a>Consect et tetur</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<!--        <div class="container pseudo-header">-->
<!--            <div class="row">-->
<!--                <div class="col-sm-12">-->
<!--                    <h1 class="theme-highlight-color">--><?php //echo Page::getCurrentPage()->getCollectionName(); ?><!-- <small class="theme-extra-light-color">Jun 17, 2015</small></h1>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div>

        </div>

        <?php $this->inc('elements/footer.php'); ?>
    </main>
    <aside scroll-top class="icn-angle-up"></aside>
</div>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>