<?php
namespace Concrete\Package\Sequence\Libraries {
    defined('C5_EXECUTE') or die(_("Access Denied."));

    /**
     * Class BaseController
     * @package Concrete\Package\Sequence\Libraries
     */
    class BaseController extends \Concrete\Core\Page\Controller\PageController {

        public function on_start(){

        }

    }
}

//    class TitlecardPageController extends Controller {
//
//        protected $supportsPageCache = true;
//
//        /** @property $_includeThemeAssets bool */
//        protected $_includeThemeAssets = false;
//
//        /** @property $_canEdit bool : Set in on_start method */
//        protected $_canEdit = false;
//
//        /** @property $_isEditMode bool : Set in on_start method */
//        protected $_isEditMode = false;
//
//        /**
//         * Base controller's view method.
//         * @return void
//         */
//        public function view(){
//            if( $this->_includeThemeAssets === true ){
//                $this->attachThemeAssets( $this );
//            }
//        }
//
//
//        /**
//         * @return void
//         */
//        public function on_start(){
//            $this->_canEdit     = $this->pagePermissionObject()->canWrite();
//            $this->_isEditMode  = $this->getCollectionObject()->isEditMode();
//
//            $this->set('canEdit', $this->_canEdit);
//            $this->set('isEditMode', $this->_isEditMode);
//
//            $classes = array();
//            if( $this->_canEdit ){ array_push($classes, 'cms-admin'); }
//            if( $this->_isEditMode ){ array_push($classes, 'cms-editing'); }
//            $this->set('cmsClasses', join(' ', $classes));
//        }
//
//
//        /**
//         * Include css/js assets in page output.
//         * @param $pageController Controller : Forces the page controller to be injected!
//         * @return void
//         */
//        public function attachThemeAssets( Controller $pageController ){
//            // CSS
//            $pageController->addHeaderItem('<link href="http://fonts.googleapis.com/css?family=Ropa+Sans:400,400italic" rel="stylesheet" type="text/css">');
//            $pageController->addHeaderItem( $this->getHelper('html')->css('core.css', TitlecardPackage::PACKAGE_HANDLE) );
//            $pageController->addHeaderItem( $this->getHelper('html')->css('app.css', TitlecardPackage::PACKAGE_HANDLE) );
//            // JS
//            $pageController->addFooterItem( $this->getHelper('html')->javascript('core.js', TitlecardPackage::PACKAGE_HANDLE) );
//            $pageController->addFooterItem( $this->getHelper('html')->javascript('app.js', TitlecardPackage::PACKAGE_HANDLE) );
//        }
//
//
//        /**
//         * Memoize helpers (beware, once loaded its always the same instance).
//         * @param string $handle Handle of the helper to load
//         * @param bool | Package $pkg Package to get the helper from
//         * @return ...Helper class of some sort
//         */
//        public function getHelper( $handle, $pkg = false ){
//            $helper = '_helper_' . preg_replace("/[^a-zA-Z0-9]+/", "", $handle);
//            if( $this->{$helper} === null ){
//                $this->{$helper} = Loader::helper($handle, $pkg);
//            }
//            return $this->{$helper};
//        }
//
//
//        /**
//         * Get the Concrete5 permission object for the given page.
//         * @return Permissions
//         */
//        protected function pagePermissionObject(){
//            if( $this->_pagePermissionObj === null ){
//                $this->_pagePermissionObj = new Permissions( $this->getCollectionObject() );
//            }
//            return $this->_pagePermissionObj;
//        }
//
//    }