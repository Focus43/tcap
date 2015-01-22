<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage(); ?>">
<head>
<?php $this->inc('elements/head.php'); ?>
</head>

<body>

    <div id="page-body" class="<?php echo $c->getPageWrapperClass()?>">
        <?php $this->inc('elements/header.php'); ?>

        <section id="masthead">
            <img src="<?php echo $this->getThemePath(); ?>/images/masthead.jpg" />
        </section>

        <main>
            <div class="container-fluid">
                <div class="row padless-grid">
                    <div class="col-sm-4">
                        <?php
                            $a = new Area('Main 1'); /* @var $a \Concrete\Core\Area\Area */ //$a->setAreaGridMaximumColumns(12);
                            $a->display($c);
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        $a = new Area('Main 2'); /* @var $a \Concrete\Core\Area\Area */
                        $a->display($c);
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        $a = new Area('Main 3'); /* @var $a \Concrete\Core\Area\Area */
                        $a->display($c);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <?php
                        $a = new Area('Main 4'); /* @var $a \Concrete\Core\Area\Area */
                        $a->display($c);
                        ?>
                    </div>
                    <div class="col-sm-7">
                        <?php
                        $a = new Area('Main 5'); /* @var $a \Concrete\Core\Area\Area */
                        $a->display($c);
                        ?>
                    </div>
                </div>
                <div class="row padless-grid">
                    <div class="col-sm-12">
                        <div class="parallax">
                            <div class="layer backdrop"></div>
                            <?php
                            $a = new Area('Main 6'); /* @var $a \Concrete\Core\Area\Area */
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php $this->inc('elements/footer.php'); ?>
    </div>

<?php Loader::element('footer_required'); ?>
<script type="text/javascript" src="<?php echo $this->getThemePath(); ?>/js/theme.js"></script>
</body>
</html>