<?php namespace Concrete\Package\Sequence\Libraries {
    defined('C5_EXECUTE') or die(_("Access Denied."));

    use Loader;
    use Concrete\Package\Sequence\Controller AS PackageController;

    /**
     * Class BaseController
     * @package Concrete\Package\Sequence\Libraries
     */
    abstract class BaseController extends \Concrete\Core\Page\Controller\PageController {

        /** @property $_includeThemeAssets bool */
        protected $_includeThemeAssets = false;

        /**
         *
         */
        public function on_start(){

        }


        /**
         * Base controller's view method.
         * @return void
         */
        public function view(){
            if( $this->_includeThemeAssets === true ){
                $this->attachThemeAssets( $this );
            }
        }


        /**
         * Include css/js assets in page output.
         * @param $pageController Controller : Forces the page controller to be injected!
         * @return void
         */
        public function attachThemeAssets( \Concrete\Core\Page\Controller\PageController $pageController ){
            // CSS
            $pageController->addHeaderItem('<link href="http://fonts.googleapis.com/css?family=Ropa+Sans:400,400italic" rel="stylesheet" type="text/css">');
            $pageController->addHeaderItem( $this->getHelper('helper/html')->css('core.css', PackageController::PACKAGE_HANDLE) );
            $pageController->addHeaderItem( $this->getHelper('helper/html')->css('app.css', PackageController::PACKAGE_HANDLE) );
            // JS
            $pageController->addFooterItem( $this->getHelper('helper/html')->javascript('core.js', PackageController::PACKAGE_HANDLE) );
            $pageController->addFooterItem( $this->getHelper('helper/html')->javascript('app.js', PackageController::PACKAGE_HANDLE) );
        }


        /**
         * Memoize helpers (beware, once loaded its always the same instance).
         * @param string $handle Handle of the helper to load
         * @param bool | Package $pkg Package to get the helper from
         * @return ...Helper class of some sort
         */
        public function getHelper( $handle ){
            $helper = '_helper_' . preg_replace("/[^a-zA-Z0-9]+/", "", $handle);
            if( $this->{$helper} === null ){
                $this->{$helper} = \Core::make($handle);
            }
            return $this->{$helper};
        }

    }
}