<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php
    $node = $tree->getRootTreeNodeObject();
    if( is_object($node) ){
        $node->populateDirectChildrenOnly();
        foreach($node->getChildNodes() AS $child): ?>
            <li>
                <a href="<?php echo $view->controller->getTopicLink($child); ?>">
                    <i class="icn-angle-right"></i> <?php echo $child->getTreeNodeDisplayName(); ?>
                </a>
            </li>
        <?php endforeach;
    }