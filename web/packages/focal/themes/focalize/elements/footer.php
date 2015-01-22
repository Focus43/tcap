<footer>
    <div class="container columns">
        <div class="row">
            <div class="col-sm-3">
                <?php
                $a = new GlobalArea('Footer 1'); /* @var $a \Concrete\Core\Area\Area */ //$a->setAreaGridMaximumColumns(12);
                $a->display($c);
                ?>
            </div>
            <div class="col-sm-3">
                <?php
                $a = new GlobalArea('Footer 2'); /* @var $a \Concrete\Core\Area\Area */ //$a->setAreaGridMaximumColumns(12);
                $a->display($c);
                ?>
            </div>
            <div class="col-sm-3">
                <?php
                $a = new GlobalArea('Footer 3'); /* @var $a \Concrete\Core\Area\Area */ //$a->setAreaGridMaximumColumns(12);
                $a->display($c);
                ?>
            </div>
            <div class="col-sm-3">
                <?php
                $a = new GlobalArea('Footer 4'); /* @var $a \Concrete\Core\Area\Area */ //$a->setAreaGridMaximumColumns(12);
                $a->display($c);
                ?>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <?php
                    $a = new GlobalArea('Footer 5'); /* @var $a \Concrete\Core\Area\Area */ //$a->setAreaGridMaximumColumns(12);
                    $a->display($c);
                    ?>
                </div>
                <div class="col-sm-7">
                    <?php
                    $a = new GlobalArea('Footer 6'); /* @var $a \Concrete\Core\Area\Area */ //$a->setAreaGridMaximumColumns(12);
                    $a->display($c);
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>