<!DOCTYPE HTML>
<html ng-app="sequence" ng-controller="CtrlRoot" ng-class="rootClasses" lang="<?php echo LANGUAGE; ?>" class="<?php echo $isEditMode ? 'cms-edit-mode' : ''; ?>">
<?php $this->inc('elements/head.php'); ?>

<body>

<div id="c-level-1" class="<?php echo $c->getPageWrapperClass(); ?>" single-page-scroll>
    <?php $this->inc('elements/header.php'); ?>

    <main slideable>
        <section id="section-1">
            <div masthead data-transition-speed="0.5"<?php if(!$isEditMode && (count((array)$mastheadImages) > 1)){echo ' data-loop-timing="12"';} ?>>
                <?php if(!empty($mastheadImages)): foreach($mastheadImages AS $index => $fileObj): ?>
                    <div class="node" style="background-image:url('<?php echo $fileObj->getRelativePath(); ?>');">
                        <div class="inner">
                            <div class="node-content">
                                <?php $index++; $a = new Area("Masthead {$index}"); $a->display($c); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; ?>

                <?php if(count((array)$mastheadImages) > 1): ?>
                <a class="arrows icn-angle-left"></a>
                <a class="arrows icn-angle-right"></a>
                <div class="markers">
                    <?php for($i = 0; $i < count($mastheadImages); $i++): ?>
                        <a class="<?php echo $i === 0 ? 'active' : ''; ?>"><i class="icn-circle"></i></a>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <?php $i = 2; while($i <= (int)$areaCount): ?>
            <section id="<?php echo "section-{$i}"; ?>">
                <?php
                    $a = new Area("Main {$i}"); /** @var $a \Concrete\Core\Area\Area */
                    $a->enableGridContainer();
                    $a->display($c);
                ?>
            </section>
        <?php $i++; endwhile; ?>

        <section id="<?php echo "section-{$i}"; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php $a = new Area('Contact Top'); $a->display($c); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-3 col-md-offset-1">
                        <?php $a = new Area('Contact Left'); $a->display($c); ?>
                    </div>
                    <div class="col-sm-9 col-md-7">
                        <?php $a = new Area('Contact Right'); $a->display($c); ?>
                    </div>
                </div>
            </div>
        </section>

        <footer>TitleCard Capital&trade;. Copyright &copy; <?php echo date('Y'); ?></footer>
    </main>
    <aside scroll-top class="icn-angle-up"></aside>
</div>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>