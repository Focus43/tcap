<?php namespace Concrete\Package\Sequence\Controller\PageType {

    use \DateTime;
    use File;
    use Concrete\Package\Sequence\Controller AS PackageController;
    use Zend\Http\Header\Date;

    class NewsPost extends \Concrete\Package\Sequence\Libraries\BaseController {

        protected $_includeThemeAssets = true;

        public function on_start(){
            parent::on_start();
            $this->set('isEditMode', $this->getPageObject()->isEditMode());
        }

        public function view(){
            parent::view();

            // Pass page title
            $this->set('pageTitle', $this->getPageObject()->getCollectionName());

            // Pass date (page public date property on collection obj)
            $dateStr = new DateTime($this->getPageObject()->getCollectionDatePublic());
            $this->set('publishDate', $dateStr->format('M dS, Y'));

            // Page image
            $pageImageFileObj = $this->getPageObject()->getAttribute(PackageController::COLLECTION_ATTR_PAGE_IMAGE);
            if( $pageImageFileObj instanceof File && $pageImageFileObj->getFileID() >= 1 ){
                $this->set('pageImageURL', $pageImageFileObj->getApprovedVersion()->getThumbnailURL('large'));
            }
        }

    }

}