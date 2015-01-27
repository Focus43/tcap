<?php namespace Concrete\Package\Sequence\Controller\PageType {

    use FileSet;
    use Concrete\Package\Sequence\Controller AS PackageController;

    class Page extends \Concrete\Package\Sequence\Libraries\BaseController {

        protected $_includeThemeAssets = true;

        public function on_start(){
            parent::on_start();
            $this->set('mastheadImages', $this->getMastheadImages());
        }

        /**
         * Get images for the masthead
         * @return array
         */
        private function getMastheadImages(){
            $fileSetObj = FileSet::getByName(PackageController::FILE_SET_MASTHEAD);
            if( is_object($fileSetObj) ){
                return $fileSetObj->getFiles();
            }
            return array();
        }

    }

}