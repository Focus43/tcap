<header>
    <nav>
        <?php //$a = new GlobalArea('Header Right'); $a->display($c); ?>
        <ul class="list-inline">
            <?php for($i = 1; $i <= (int)$areaCount; $i++): ?>
                <li><a><span><?php echo "Section {$i}"; ?></span></a></li>
            <?php endfor; ?>
        </ul>
    </nav>

    <h1 class="logo"><?php echo Config::get('concrete.site'); ?></h1>
</header>