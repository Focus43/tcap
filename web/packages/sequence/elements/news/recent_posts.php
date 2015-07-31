<div class="sidebar-box">
    <h4>Recent Posts</h4>
    <ul class="list-unstyled">
        <?php
            $pageList = new \Concrete\Core\Page\PageList();
            $pageList->disableAutomaticSorting();
            $pageList->sortByPublicDateDescending();
            $pageList->filterByPath('/news');
            $pageList->filterByPageTypeID( \Concrete\Core\Page\Type\Type::getByHandle('news_post')->getPageTypeID() );
            $pageList->setItemsPerPage(3);

            $paginationObj  = $pageList->getPagination();
            $pageResults    = $paginationObj->getCurrentPageResults();

            if( count($pageResults) >= 1 ){
                foreach($pageResults AS $pageObj){ ?>
                    <li>
                        <a href="<?php echo $pageObj->getCollectionPath(); ?>">
                            <i class="icn-angle-right"></i>  <?php echo $pageObj->getCollectionName(); ?>
                        </a>
                    </li>
                <?php }
            }else{ ?>
                <li><i>No Recent Posts</i></li>
            <?php }
        ?>
    </ul>
</div>