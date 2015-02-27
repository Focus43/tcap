<div class="legal-popups">
    <div class="scrollable">
        <?php
        $a = new \Concrete\Core\Area\GlobalArea('Disclaimer');
        $a->display(\Concrete\Core\Page\Page::getByID(1));
        ?>
    </div>

    <p class="confirm-it"><button type="button" class="btn btn-default" close-modal>YES</button> I hereby certify that I have reviewed and understand that this site relates to accredited investing.</p>
</div>