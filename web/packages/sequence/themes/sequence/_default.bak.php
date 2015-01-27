<!DOCTYPE HTML>
<html ng-app="sequence" ng-controller="CtrlRoot" ng-class="rootClasses" lang="<?php echo LANGUAGE; ?>" class="<?php echo $cmsClasses; ?>">
<?php Loader::packageElement('theme/head', \Concrete\Package\Sequence\Controller::PACKAGE_HANDLE); ?>

<body>

    <div id="c-level-1" class="<?php echo $c->getPageWrapperClass(); ?>">
        <?php Loader::packageElement('theme/header', \Concrete\Package\Sequence\Controller::PACKAGE_HANDLE); ?>

        <main slideable>
            <section id="intro">
                <div masthead data-transition-speed="0.5" data-loop-timing="10">
                    <?php foreach((array)$mastheadImages AS $index => $fileObj): ?>
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

            <section id="the-fund" class="boxd-gray">
                <div class="container">
                    <?php $a = new Area('Main 1'); $a->setAreaGridMaximumColumns(3); $a->display($c); ?>
                </div>
            </section>

            <section parallax style="background-image:url('<?php echo SEQUENCE_IMAGE_PATH; ?>_scratch/blurry_bg.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>In a different league</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="quotes" quote-cycle="5">
                                <div class="group">
                                    <q>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</q>
                                    <cite>- Napolean Hill</cite>
                                </div>
                                <div class="group">
                                    <q>Lorem ipsum dolor sit amet, consectetur adipiscing elit, dolore eu fugiat nulla pariatur.</q>
                                    <cite>- Alpaca</cite>
                                </div>
                                <div class="group">
                                    <q>Lorem ipsum dolor sit amet, consectetur adipiscing elit, dolore eu fugiat nulla pariatur.</q>
                                    <cite>- Alpaca</cite>
                                </div>
                                <div class="group">
                                    <q>Lorem ipsum dolor sit amet, consectetur adipiscing elit, dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, dolore eu fugiat nulla pariatur.</q>
                                    <cite>- Alpaca</cite>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <p class="text-orange">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        </div>
                        <div class="col-sm-4">
                            <div accordion data-speed="0.25">
                                <div class="group active">
                                    <span class="accordion-header">Lorem Ipsum Dolor</span>
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="group">
                                    <span class="accordion-header">Lorem Ipsum Dolor</span>
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="group">
                                    <span class="accordion-header">Lorem Ipsum Dolor</span>
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="group">
                                    <span class="accordion-header">Lorem Ipsum Dolor</span>
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="boxd-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Bringing Purpose To Professional Prowess</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="iconified anglified">
                                <h4>Our Target</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="iconified anglified">
                                <h4>Our Target</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="iconified anglified">
                                <h4>Our Target</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="iconified anglified">
                                <h4>Our Target</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="boxd-orange">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>[Collective Impact In Social Media]</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <p class="statistic"><b><span countable data-tolerance="25" data-duration="1.25">250</span>M</b>Social Media Followers</p>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <p class="statistic"><b><span countable data-tolerance="50" data-duration="2">49</span></b>Combined Awards and MVP Rankings</p>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <p class="statistic"><b>$<span countable data-tolerance="75" data-duration="3">75</span>k</b>Aggregate Worth Of Partners Tweets</p>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <p class="statistic"><b><span countable data-tolerance="100">13</span></b>Positions of Partners In Social Media Recognition</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="strategy" parallax style="background-image:url('<?php echo SEQUENCE_IMAGE_PATH; ?>theme/gt_au_fb.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2><span class="text-orange">Strategy:</span> Unique Positioning FOr Personal Brands.</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <p>Lorem ipsum</p>
                        </div>
                        <div class="col-sm-4">
                            <p>Lorem ipsum</p>
                        </div>
                        <div class="col-sm-4">
                            <h4 style="padding-bottom:1rem;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</h4>
                            <div accordion data-speed="0.25">
                                <div class="group active">
                                    <span class="accordion-header">Lorem Ipsum Dolor</span>
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="group">
                                    <span class="accordion-header">Lorem Ipsum Dolor</span>
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="group">
                                    <span class="accordion-header">Lorem Ipsum Dolor</span>
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="group">
                                    <span class="accordion-header">Lorem Ipsum Dolor</span>
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="people" parallax style="background-image:url('<?php echo SEQUENCE_IMAGE_PATH; ?>theme/1908_playoff.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2><span class="text-orange">People:</span> Phenomenal Fund Management.</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="iconified anglified">
                                <h4>Our Target</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="iconified anglified">
                                <h4>Our Target</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                            <div class="iconified anglified">
                                <h4>Our Target</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="iconified anglified">
                                <h4>Our Target</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                            <div class="iconified anglified">
                                <h4>Our Target</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="boxd-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Lorem Ipsum Dolor Sit Amet Consectet Tetur</h2>
                        </div>
                    </div>
                </div>
                <div isotope>
                    <ul class="list-inline text-center" isotope-filters>
                        <li><a class="active" data-filter="*">Show All</a></li>
                        <?php
                            foreach($userGroupFilters AS $groupObj){ /** @var $groupObj Group */
                                echo '<li><a data-filter="['.$textHelper->handle($groupObj->getGroupName()).']">'.$groupObj->getGroupName().'</a></li>' . "\n";
                            }
                        ?>
                    </ul>
                    <div class="grid-wrapper">
                        <div isotope-grid>
                            <?php
                                foreach($userList AS $userInfoObj){
                                    Loader::packageElement('partials/person_grid', \Concrete\Package\Sequence\Controller::PACKAGE_HANDLE, array(
                                        'userInfoObj' => $userInfoObj
                                    ));
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </section>

            <section id="contact" class="boxd-gray" style="min-height:100%;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2><span class="text-orange">Contact:</span> Get In Touch With The Team.</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-md-offset-1">
                            <p><span class="text-orange">Em:</span> replace@me-here.com</p>
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