<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<ul<?php echo Page::getCurrentPage()->isEditMode() ? ' style="height:70px;min-width:200px;"' : ''; ?>>
    <?php if(!empty($parsedData)): foreach($parsedData AS $stdObj): ?>
        <li><a href="#<?php echo $stdObj->id; ?>"><span><?php echo $stdObj->label; ?></span></a></li>
    <?php endforeach; else: ?>
        <li><a><span>! LIST IS EMPTY !</span></a></li>
    <?php endif; ?>
</ul>