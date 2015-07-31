<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php if (count($dates)): foreach($dates as $date) { ?>
        <li>
            <a href="<?php echo $view->controller->getDateLink($date); ?>">
                <i class="icn-angle-right"></i> <?php echo $view->controller->getDateLabel($date); ?>
            </a>
        </li>
<?php } endif;