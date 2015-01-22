<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage(); ?>">
<head>
<?php $this->inc('elements/head.php'); ?>
</head>

<body>

    <div id="page-body" class="<?php echo $c->getPageWrapperClass()?>">
        <header>
            <nav>
                <ul>
                    <li>Manufacturing</li>
                    <li>Mission</li>
                    <li>Services</li>
                    <li>Contact</li>
                </ul>
            </nav>
        </header>

        <main>
            <?php
                Loader::element('system_errors', array('error' => $error));
                print $innerContent;
            ?>
        </main>
        <?php $this->inc('elements/footer.php'); ?>
    </div>

<?php Loader::element('footer_required'); ?>
<script type="text/javascript" src="<?php echo $this->getThemePath(); ?>/js/theme.js"></script>
</body>
</html>