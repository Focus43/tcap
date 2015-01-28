<header>
    <nav slideable>
        <a class="trigger icn-layers"></a>
        <div class="inner">
            <ul>
                <?php for($i = 1; $i <= (int)$areaCount; $i++): ?>
                    <li><a href="#<?php echo "section-{$i}"; ?>"><span><?php echo "Section {$i}"; ?></span></a></li>
                <?php endfor; ?>
            </ul>
<!--            <ul>-->
<!--                <li><a href="#the-fund"><span>Fund</span></a></li>-->
<!--                <li><a href="#strategy"><span>Strategy</span></a></li>-->
<!--                <li><a href="#people"><span>People</span></a></li>-->
<!--                <li><a href="#contact"><span>Contact</span></a></li>-->
<!--            </ul>-->
        </div>
    </nav>

    <figure slideable>
        <?php $a = new GlobalArea('Header Left'); $a->display($c); ?>
<!--        <a class="logo" href="#intro">-->
<!--            <img src="--><?php //echo SEQUENCE_IMAGE_PATH; ?><!--titlecard-logo.svg" />-->
<!--        </a>-->
    </figure>
</header>