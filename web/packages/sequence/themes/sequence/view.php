<?php
    if( !($this->controller instanceof TitlecardPageController) ){
        $pageController = new TitlecardPageController;
        $pageController->attachThemeAssets( $this->controller );
    }
?>
<!DOCTYPE HTML>
<html lang="<?php echo LANGUAGE; ?>" class="<?php echo $cmsClasses; ?>">
<?php Loader::packageElement('theme/head_tag', TitlecardPackage::PACKAGE_HANDLE); ?>

<body ng-controller="CtrlRoot">

    <?php echo $innerContent; ?>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>