<?php namespace Concrete\Package\Sequence\Controller\PageType {

    use FileSet;
    use Concrete\Package\Sequence\Controller AS PackageController;

    class News extends \Concrete\Package\Sequence\Libraries\BaseController {

        protected $_includeThemeAssets = true;

        public function on_start(){
            parent::on_start();
            $this->set('isEditMode', $this->getPageObject()->isEditMode());
            $this->set('pageImage', $this->getPageObject()->getAttribute(PackageController::COLLECTION_ATTR_PAGE_IMAGE));
        }

    }

}