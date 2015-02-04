<header>
    <nav slideable>
        <a class="trigger"></a>
        <div class="inner">
            <?php $a = new GlobalArea('Header Right'); $a->display($c); ?>
        </div>
    </nav>

    <figure slideable>
        <?php $a = new GlobalArea('Header Left'); $a->display($c); ?>
        <!--<a class="logo" href="#intro">
            <img src="<?php echo SEQUENCE_IMAGE_PATH; ?>titlecard-logo.svg" />
        </a>-->
    </figure>
</header>