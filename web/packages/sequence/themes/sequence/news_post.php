<!DOCTYPE HTML>
<html ng-app="sequence" ng-controller="CtrlRoot" ng-class="rootClasses" lang="<?php echo LANGUAGE; ?>" class="pt-news-post no-disclaimer <?php echo $isEditMode ? 'cms-edit-mode' : ''; ?>">
<?php $this->inc('elements/head.php'); ?>

<body<?php if($pagePermissionObj->canWrite()){ echo ' can-admin'; } ?>>

<div id="c-level-1" class="<?php echo $c->getPageWrapperClass(); ?>">

    <?php $this->inc('elements/header.php', array('homeLinkOnly' => true)); ?>

    <main slideable>
        <div class="container news-page-container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="post-img-title">
                        <?php if( $pageImageURL ){ ?>
                            <img src="<?php echo $pageImageURL; ?>" class="img-rounded" />
                        <?php } ?>
                        <h1><?php echo $pageTitle; ?> <small><?php echo $publishDate; ?></small></h1>
                    </div>

                    <div class="news-body">
                        <?php
                            $a = new Area("Main"); /** @var $a \Concrete\Core\Area\Area */
                            $a->display($c);
                        ?>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="sidebar-box">
                        <input type="text" class="form-control" placeholder="Search" />
                    </div>
                    <?php Loader::packageElement('news/recent_posts', 'sequence'); ?>
                    <?php Loader::packageElement('news/archives', 'sequence'); ?>
                    <?php Loader::packageElement('news/categories', 'sequence'); ?>
                </div>
            </div>
        </div>

        <?php $this->inc('elements/footer.php'); ?>
    </main>
    <aside scroll-top class="icn-angle-up"></aside>
</div>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>