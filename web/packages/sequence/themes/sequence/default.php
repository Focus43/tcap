<!DOCTYPE HTML>
<html ng-app="sequence" ng-controller="CtrlRoot" ng-class="rootClasses" lang="<?php echo LANGUAGE; ?>" class="<?php echo $isEditMode ? 'cms-edit-mode' : ''; ?>">
<?php $this->inc('elements/head.php'); ?>

<body>

<div id="c-level-1" class="<?php echo $c->getPageWrapperClass(); ?>">
    <?php $this->inc('elements/header.php'); ?>

    <main slideable>
        <?php if(!empty($mastheadImages)): ?>
            <section id="intro">
                <div masthead data-transition-speed="0.5"<?php if(!$isEditMode){echo ' data-loop-timing="12"';} ?>>
                    <?php foreach($mastheadImages AS $index => $fileObj): ?>
                        <div class="node tabular" style="background-image:url('<?php echo $fileObj->getRelativePath(); ?>');">
                            <div class="cellular text-left">
                                <div class="node-content">
                                    <?php $index++; $a = new Area("Masthead {$index}"); $a->display($c); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <a class="arrows icn-angle-left"></a>
                    <a class="arrows icn-angle-right"></a>
                    <div class="markers">
                        <?php for($i = 0; $i < count($mastheadImages); $i++): ?>
                            <a class="<?php echo $i === 0 ? 'active' : ''; ?>"><i class="icn-circle"></i></a>
                        <?php endfor; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php for($i = 1; $i <= (int)$areaCount; $i++): ?>
            <section id="<?php echo "section-{$i}"; ?>">
                <?php
                $a = new Area("Main {$i}"); /** @var $a \Concrete\Core\Area\Area */
                $a->enableGridContainer();
                $a->display($c); ?>
            </section>
        <?php endfor; ?>

        <section id="people">
            <div class="wrap-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>The People Behind TitleCard Capital</h2>
                        </div>
                    </div>
                </div>
                <div isotope>
                    <ul class="list-inline text-center" isotope-filters>
                        <li><a class="active" data-filter="*">Show All</a></li>
                        <?php
                            foreach($userInvolvementLevels AS $levelString){
                                echo '<li><a data-filter="['.$textHelper->handle($levelString).']">'.$levelString.'</a></li>' . "\n";
                            }
                        ?>
                    </ul>
                    <div class="grid-wrapper">
                        <div isotope-grid>
                            <?php
                                foreach($peopleFileList AS $fileObj){
                                    Loader::packageElement('partials/person_grid', \Concrete\Package\Sequence\Controller::PACKAGE_HANDLE, array(
                                        'fileObj'    => $fileObj,
                                        'textHelper' => $textHelper
                                    ));
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2><span class="text-orange">Contact:</span> Get In Touch With The Team.</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-3 col-md-offset-1">
                        <?php $a = new Area('Column Left Footer'); $a->display($c); ?>
                    </div>
                    <div class="col-sm-9 col-md-7">
                        <form>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label class="sr-only">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="sr-only">Email</label>
                                    <input type="text" class="form-control" placeholder="Email" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <textarea class="form-control" placeholder="Message" rows="5"></textarea>
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
            </div>
        </section>

        <footer>Copyright &copy; <?php echo date('Y'); ?></footer>
    </main>
    <aside scroll-top class="icn-angle-up"></aside>
</div>

<?php Loader::element('footer_required'); // REQUIRED BY C5 // ?>
</body>
</html>