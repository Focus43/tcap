<header>
    <nav slideable>
        <a class="trigger"></a>
        <div class="inner">
            <?php if($homeLinkOnly === true): ?>
                <ul>
                    <li style="display:inline-block;"><a href="/"><span>Home</span></a></li>
                </ul>
            <?php else: $a = new GlobalArea('Header Right'); $a->display($c); endif; ?>
        </div>
    </nav>

    <figure slideable>
        <?php if($homeLinkOnly === true): ?>
            <a href="/">
                <img src="<?php echo SEQUENCE_IMAGE_PATH; ?>TitleCard_LogoWO_Center.svg" width="180px" class="img-responsive" />
            </a>
        <?php else: $a = new GlobalArea('Header Left'); $a->display($c); endif; ?>
    </figure>
</header>