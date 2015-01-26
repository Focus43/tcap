<?php
/**
 * Article page type controller
 */
namespace Concrete\Package\Focal\Controller\PageType {
    defined('C5_EXECUTE') or die(_("Access Denied."));

    //use Loader, Page, Permissions, View;
    use Concrete\Package\Focal\Controller AS PackageController;

    /**
     * Class Article
     * @package Concrete\Package\Focal\Controller\PageType
     */
    class Page extends \Concrete\Package\Focal\Libraries\Base {

        public function on_start(){
            parent::on_start();
        }

        public function view(){
            $this->set('areaCount', $this->getPageObject()->getAttribute(PackageController::COLLECTION_ATTRIBUTE_SECTIONS));
        }
    }
}