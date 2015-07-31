<?php defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */

foreach($pages AS $page):
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

    <a class="post-img-title and-descr" href="<?php echo $url; ?>">
        <?php if($imageURL): ?>
            <img src="<?php echo $imageURL; ?>" class="img-rounded" />
        <?php endif; ?>
        <h2><?php echo $title; ?> <small><?php echo $date; ?></small></h2>
        <p><?php echo $description; ?></p>
    </a>

<?php endforeach; ?>

<div class="pagination">
    <?php echo $pagination; ?>
</div>

