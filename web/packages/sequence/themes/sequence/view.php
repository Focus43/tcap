<?php
//    if( !($this->controller instanceof TitlecardPageController) ){
//        $pageController = new TitlecardPageController;
//        $pageController->attachThemeAssets( $this->controller );
//    }
?>
<!DOCTYPE HTML>
<html ng-app="sequence" ng-controller="CtrlRoot" ng-class="rootClasses" lang="<?php echo LANGUAGE; ?>" class="<?php echo $cmsClasses; ?>">
<?php Loader::packageElement('theme/head', \Concrete\Package\Sequence\Controller::PACKAGE_HANDLE); ?>

<body>

    <?php echo $innerContent; ?>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>