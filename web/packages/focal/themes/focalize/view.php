<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage(); ?>" class="<?php echo Page::getCurrentPage()->isEditMode() ? 'cms-editing' : 'false'; ?>">
<head>
    <?php $this->inc('elements/head.php'); ?>
</head>

<body>

    <div id="page-body" class="<?php echo $c->getPageWrapperClass()?>">
        <?php $this->inc('elements/header.php'); ?>
        <main>
            <section>
                <?php
                    Loader::element('system_errors', array('error' => $error));
                    print $innerContent;
                ?>
            </section>
        </main>
        <?php $this->inc('elements/footer.php'); ?>
    </div>

<?php Loader::element('footer_required'); ?>
<script type="text/javascript" src="<?php echo $this->getThemePath(); ?>/js/theme.js"></script>
</body>
</html>