<div class="sidebar-box">
    <h4>Archives</h4>
    <ul class="list-unstyled">
        <?php
            $newsHomeParentID = Page::getByPath('/news')->getCollectionID();

            $blockTypeDateNav = BlockType::getByHandle('date_navigation');
            $blockTypeDateNav->controller->filterByParent       = 1;
            $blockTypeDateNav->controller->cParentID            = $newsHomeParentID;
            $blockTypeDateNav->controller->ptID                 = \Concrete\Core\Page\Type\Type::getByHandle('news_post')->getPageTypeID();
            $blockTypeDateNav->controller->redirectToResults    = 1;
            $blockTypeDateNav->controller->cTargetID            = $newsHomeParentID;
            $blockTypeDateNav->controller->title                = 'Archives';
            $blockTypeDateNav->render('templates/news_post');
        ?>
    </ul>
</div>