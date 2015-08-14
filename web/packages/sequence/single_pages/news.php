<div class="container news-page-container">
    <div class="row">
        <div class="col-sm-9">
            <?php
                $a = new Area("Main"); /** @var $a \Concrete\Core\Area\Area */
                $a->display($c);

//                $btPageList = BlockType::getByHandle('page_list');
//                $btPageList->controller->num                        = 10;
//                $btPageList->controller->ptID                       = \Concrete\Core\Page\Type\Type::getByHandle('news_post')->getPageTypeID();;
//                $btPageList->controller->cParentID                  = Page::getCurrentPage()->getCollectionID();
//                $btPageList->controller->includeName                = 1;
//                $btPageList->controller->displayFeaturedOnly        = 0;
//                $btPageList->controller->filterByRelated            = 0;
//                $btPageList->controller->includeAllDescendents      = 1;
//                $btPageList->controller->enableExternalFiltering    = 1;
//                $btPageList->controller->paginate                   = 1;
//                $btPageList->controller->orderBy                    = 'chrono_desc';
//                $btPageList->controller->includeDescription         = 1;
//                $btPageList->controller->truncateSummaries          = 1;
//                $btPageList->controller->truncateChars              = 250;
//                $btPageList->controller->includeDate                = 1;
//                $btPageList->render('templates/news_page_list');
            ?>

        </div>
        <div class="col-sm-3">
            <?php Loader::packageElement('news/search', 'sequence'); ?>
            <?php Loader::packageElement('news/recent_posts', 'sequence'); ?>
            <?php Loader::packageElement('news/archives', 'sequence'); ?>
            <?php Loader::packageElement('news/categories', 'sequence'); ?>
        </div>
    </div>
</div>