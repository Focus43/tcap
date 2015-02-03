<header>
    <nav slideable>
        <a class="trigger icn-layers"></a>
        <div class="inner">
            <?php $a = new GlobalArea('Header Right'); $a->display($c); ?>
            <!--<ul>
                <li><a href="#the-fund"><span>Fund</span></a></li>
                <li><a href="#strategy"><span>Strategy</span></a></li>
                <li><a href="#people"><span>People</span></a></li>
                <li><a href="#contact"><span>Contact</span></a></li>
                <?php /*for($i = 1; $i <= (int)$areaCount; $i++):
                    echo '<li><a href="#section-'.$i.'"><span>Section '.$i.'</span></a></li>';
                endfor;*/ ?>
            </ul>-->
        </div>
    </nav>

    <figure slideable>
        <?php $a = new GlobalArea('Header Left'); $a->display($c); ?>
        <!--<a class="logo" href="#intro">
            <img src="<?php echo SEQUENCE_IMAGE_PATH; ?>titlecard-logo.svg" />
        </a>-->
    </figure>
</header>