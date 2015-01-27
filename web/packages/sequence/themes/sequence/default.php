<!DOCTYPE HTML>
<html ng-app="sequence" ng-controller="CtrlRoot" ng-class="rootClasses" lang="<?php echo LANGUAGE; ?>" class="<?php echo $isEditMode; ?>">
<?php Loader::packageElement('theme/head', \Concrete\Package\Sequence\Controller::PACKAGE_HANDLE); ?>

<body>

    <div id="c-level-1" class="<?php echo $c->getPageWrapperClass(); ?>">
        <?php Loader::packageElement('theme/header', \Concrete\Package\Sequence\Controller::PACKAGE_HANDLE); ?>

        <main slideable>
            <?php for($i = 1; $i <= (int)$areaCount; $i++): ?>
                <section id="<?php echo "section-{$i}"; ?>">
                    <?php
                    $a = new Area("Main {$i}"); /** @var $a \Concrete\Core\Area\Area */
                    $a->enableGridContainer();
                    $a->display($c); ?>
                </section>
            <?php endfor; ?>

            <footer>Copyright &copy; <?php echo date('Y'); ?></footer>
        </main>
        <aside scroll-top class="icn-angle-up"></aside>
    </div>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>