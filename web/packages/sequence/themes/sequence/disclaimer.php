<?php
  setcookie("agreed",'yes', time() + (300), "/"); // 86400 = 1 day
?>
<!DOCTYPE HTML>
<html ng-app="sequence" ng-controller="CtrlRoot" ng-class="rootClasses" lang="<?php echo LANGUAGE; ?>" class="pt-full no-disclaimer <?php echo $isEditMode ? 'cms-edit-mode' : ''; ?>">
<head data-image-path="<?php echo SEQUENCE_IMAGE_PATH; ?>" data-tools-path="<?php echo URL::route(array('', 'sequence')); ?>">
<base href="/" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="no" />
<?php Loader::element('header_required'); // REQUIRED BY C5 // ?>
<?php echo $html->css($view->getStylesheet('theme.less')); ?>
</head>


<body<?php if($pagePermissionObj->canWrite()){ echo ' can-admin'; } ?>>

<div class="<?php echo $c->getPageWrapperClass(); ?>">

    <?php $this->inc('elements/header.php', array('homeLinkOnly' => true)); ?>

    <main>
        <section>
          <?php
              $a = new Area("Disclaimer"); /** @var $a \Concrete\Core\Area\Area */
              $a->enableGridContainer();
              $a->display($c);
          ?>
          <div class="agree-banner">
            <div class="container">
              <div class="row">
                <div class="col-sm-3">
                  <a type="button" class="btn btn-default btn-lg btn-block" href="/">YES</a>
                </div>
                <div class="col-sm-9">
                  <p>I hereby certify that I have reviewed and understand that this site relates to accredited investing.</p>
                </div>
              </div>
            </div>
          </div>
        </section>

        <?php $this->inc('elements/footer.php'); ?>
    </main>
    <aside scroll-top class="icn-angle-up"></aside>
</div>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>