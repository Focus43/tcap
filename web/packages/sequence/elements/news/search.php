<div class="sidebar-box">
    <?php
        $btSearch = BlockType::getByHandle('search');
        $btSearch->controller->title            = '';
        $btSearch->controller->buttonText       = '';
        $btSearch->controller->baseSearchPath   = '/news';
        $btSearch->controller->externalTarget   = 1;
        $btSearch->controller->postTo_cID       = Page::getByPath('/news')->getCollectionID();
        $btSearch->render('templates/news_search');
    ?>
</div>