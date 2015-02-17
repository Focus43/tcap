<span class="icn-close" close-modal></span>

<div class="legal-popups">
    <?php
        $a = new \Concrete\Core\Area\GlobalArea('Terms');
        $a->display(\Concrete\Core\Page\Page::getByID(1));
    ?>
</div>