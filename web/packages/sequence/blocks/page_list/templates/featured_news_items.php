<?php defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
?>

<div class="row featured-news-items">
    <?php foreach($pages AS $page):
        $title          = $th->entities($page->getCollectionName());
        $url            = $nh->getLinkToCollection($page);
        $description    = $th->entities($th->wordSafeShortText($page->getCollectionDescription(), 250));
        $date           = $dh->formatCustom('M d, Y', $page->getCollectionDatePublic());

        // Page image, if it exists
        $imageURL       = null;
        $pageImageObj   = $page->getAttribute(\Concrete\Package\Sequence\Controller::COLLECTION_ATTR_PAGE_IMAGE);
        if( $pageImageObj instanceof File && $pageImageObj->getFileID() >= 1 ){
            $imageURL   = $pageImageObj->getApprovedVersion()->getThumbnailURL('large');
        }
        ?>

        <div class="col-sm-4">
            <a class="news-item" href="<?php echo $url; ?>">
                <?php if($imageURL): ?>
                    <img src="<?php echo $imageURL; ?>" class="img-rounded" />
                <?php endif; ?>
                <h2><?php echo $title; ?></h2>
                <p><?php echo $description; ?></p>
            </a>
        </div>

    <?php endforeach; ?>
</div>

