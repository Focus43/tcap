<header>
    <nav slideable>
        <a class="trigger"></a>
        <div class="inner">
            <?php $a = new GlobalArea('Header Right'); $a->display($c); ?>
        </div>
    </nav>

    <figure slideable>
        <?php $a = new GlobalArea('Header Left'); $a->display($c); ?>
    </figure>
</header>