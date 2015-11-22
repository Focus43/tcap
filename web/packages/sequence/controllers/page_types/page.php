<?php namespace Concrete\Package\Sequence\Controller\PageType {

    use FileSet;
    use Concrete\Package\Sequence\Controller AS PackageController;

    class Page extends \Concrete\Package\Sequence\Controller\BaseController {

        protected $_includeThemeAssets = true;

        public function on_start(){
            parent::on_start();
            $this->set('isEditMode', $this->getPageObject()->isEditMode());
            $this->set('textHelper', $this->getHelper('helper/text'));
            $this->set('mastheadImages', $this->getMastheadImages());


            $sections = $this->getPageObject()->getAttribute(PackageController::COLLECTION_ATTR_SECTIONS);
            $this->set('pageSections', $sections);
        }

        /**
         * Get images for the masthead
         * @return array
         */
        private function getMastheadImages(){
            $fileSetObj = FileSet::getByName(PackageController::FILE_SET_MASTHEAD);
            if( is_object($fileSetObj) ){
                $list = array();
                $fileObjectResults = $fileSetObj->getFiles();
                foreach($fileObjectResults AS $fileObj){
                    if( $fileObj instanceof \Concrete\Core\File\File ){
                        array_push($list, $fileObj);
                    }
                }
                return $list;
            }
            return array();
        }

    }

}