<?php
namespace Concrete\Package\Sequence\Controller\PageType {

    class Page extends \Concrete\Package\Sequence\Libraries\BaseController {

        public function on_start(){
            parent::on_start();
        }

        public function view(){

        }

    }

}


//    class HomePageTypeController extends TitlecardPageController {
//
//        protected $_includeThemeAssets = true;
//
//        public function on_start(){
//            parent::on_start();
//            $this->set('mastheadImages', $this->getMastheadImages());
//        }
//
//
//        /**
//         * Get images for the masthead
//         * @return array
//         */
//        private function getMastheadImages(){
//            $fileSetObj = FileSet::getByName(TitlecardPackage::FILE_SET_MASTHEAD);
//            if( is_object($fileSetObj) ){
//                return $fileSetObj->getFiles();
//            }
//            return array();
//        }
//
//    }