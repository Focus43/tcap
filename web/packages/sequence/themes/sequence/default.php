<!DOCTYPE HTML>
<html ng-app="sequence" ng-controller="CtrlRoot" ng-class="rootClasses" lang="<?php echo LANGUAGE; ?>" class="<?php echo $isEditMode ? 'cms-edit-mode' : ''; ?>">
<?php $this->inc('elements/head.php'); ?>

<body<?php if($pagePermissionObj->canWrite()){ echo ' can-admin'; } ?>>

<?php if( ! $pagePermissionObj->canWrite() ): ?>
<script type="text/ng-template" id="<?php echo URL::route(array('disclaimer', 'sequence')); ?>">
    <?php Loader::packageElement('partials/disclaimer', 'sequence'); ?>
</script>
<?php endif; ?>

<div id="c-level-1" class="<?php echo $c->getPageWrapperClass(); ?>">

    <?php $this->inc('elements/header.php'); ?>

    <main slideable>
        <section id="section-0">
            <div class="tabular">
                <div class="cellular">
                    <div class="homepage-intro">
                        <div class="hidden-xs" data-viz-d>
                            <?php $a = new Area("Masthead 1"); $a->display($c); ?>
                        </div>
                        <div class="visible-xs" data-viz-m>
                            <?php $a = new Area("Masthead Mobile 1"); $a->display($c); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php //$this->inc('elements/partial/home_slider.php'); ?>
        </section>

        <?php if( !empty($pageSections) ): foreach($pageSections AS $section): ?>
            <section id="section-<?php echo $section; ?>">
                <?php
                    $a = new Area("Main {$section}"); /** @var $a \Concrete\Core\Area\Area */
                    $a->enableGridContainer();
                    $a->display($c);
                ?>
                <div class="section-footer"><?php $a = new Area("Sub {$section}"); $a->display($c); ?></div>
            </section>
        <?php endforeach; endif; ?>

<!--        --><?php //$i = 1; while($i <= (int)$areaCount): ?>
<!--            <section id="--><?php //echo "section-{$i}"; ?><!--">-->
<!--                --><?php
//                    $a = new Area("Main {$i}"); /** @var $a \Concrete\Core\Area\Area */
//                    $a->enableGridContainer();
//                    $a->display($c);
//                ?>
<!--                <div class="section-footer">--><?php //$a = new Area("Sub {$i}"); $a->display($c); ?><!--</div>-->
<!--            </section>-->
<!--        --><?php //$i++; endwhile; ?>

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
                        <form name="contactForm" ng-controller="CtrlContactForm" ng-submit="submitHandler($event)" role="form" action="<?php echo URL::route(array('contact_form', 'sequence')); ?>" novalidate>
                            <div class="row confirm-msg" ng-show="sent_message">
                                <div class="col-sm-12">
                                    <p>Thanks for inquiring.</p>
                                </div>
                            </div>
                            <ul class="show-errors" ng-show="has_errors && contactForm.$invalid">
                                <li ng-show="contactForm.name.$invalid">Name field is required.</li>
                                <li ng-show="contactForm.email.$invalid">A <i>valid</i> email address is required.</li>
                            </ul>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <span class="show-required">
                                        <input name="name" ng-model="form_data.name" type="text" class="form-control" placeholder="Name" required />
                                    </span>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <span class="show-required">
                                        <input name="email" ng-model="form_data.email" type="email" class="form-control" placeholder="Email" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/" required />
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <textarea name="message" ng-model="form_data.message" class="form-control" placeholder="Message" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <button type="submit" class="btn btn-default">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php $a = new Area('Contact Bottom'); $a->enableGridContainer(); $a->display($c); ?>
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