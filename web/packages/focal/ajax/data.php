<?php
/**
 * Ajax data accessors
 */
namespace Concrete\Package\Focal\Ajax {
    defined('C5_EXECUTE') or die(_("Access Denied."));
    use PageType;
    use Controller;

    class Data extends Controller {

        /**
         * @todo: build out dynamic handler
         */
        public function handler(){
            /** @var $pageType \Concrete\Core\Page\Type\Type */
//            $pageType = PageType::getByHandle('page');
//            if( !((int)$pageType->getPackageID() >= 1) ){
//                $pageType->delete();
//            }
        }

    }
}