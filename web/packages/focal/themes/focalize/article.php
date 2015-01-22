<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage(); ?>">
<head>
<?php $this->inc('elements/head.php'); ?>
</head>

<body>

    <div id="page-body" class="<?php echo $c->getPageWrapperClass()?>">
        <main style="padding:1rem;">
            <?php for($i = 1; $i <= (int)$areaCount; $i++): ?>
                <section style="padding:2rem;">
                    <?php $a = new Area("Main {$i}"); $a->enableGridContainer(); $a->display($c); ?>
                </section>
            <?php endfor; ?>
        </main>
        <?php $this->inc('elements/footer.php'); ?>
    </div>

<?php Loader::element('footer_required'); ?>
<script type="text/javascript" src="<?php echo $this->getThemePath(); ?>/js/theme.js"></script>
</body>
</html>