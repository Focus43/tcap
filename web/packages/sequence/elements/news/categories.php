<div class="sidebar-box">
    <h4>Categories</h4>
    <ul class="list-unstyled">
        <?php
        $topicTree = \Concrete\Core\Tree\Type\Topic::getByName('News Post Categories');
        if( $topicTree instanceof \Concrete\Core\Tree\Tree ){
            $newsHomeParentID = Page::getByPath('/news')->getCollectionID();

            $blockTypeTopicList = BlockType::getByHandle('topic_list');
            $blockTypeTopicList->controller->mode           = 'S';
            $blockTypeTopicList->controller->topicTreeID    = $topicTree->getTreeID();
            $blockTypeTopicList->controller->externalTarget = 1;
            $blockTypeTopicList->controller->cParentID      = $newsHomeParentID;
            $blockTypeTopicList->render('templates/news_categories');
        }
        ?>
    </ul>
</div>