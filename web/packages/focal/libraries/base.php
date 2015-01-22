<?php
/**
 * Base controller, common for the theme
 */
namespace Concrete\Package\Focal\Libraries {
    defined('C5_EXECUTE') or die(_("Access Denied."));

    /**
     * Class Base
     * @package Concrete\Package\Focal\Libraries
     */
    class Base extends \Concrete\Core\Page\Controller\PageController {

        public function on_start(){
            $this->addHeaderItem($this->get('html')->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css'));
            $this->addFooterItem($this->get('html')->javascript('http://cdnjs.cloudflare.com/ajax/libs/gsap/1.14.2/TweenMax.min.js'));
            $this->addFooterItem($this->get('html')->javascript('http://cdnjs.cloudflare.com/ajax/libs/gsap/1.14.2/plugins/ScrollToPlugin.min.js'));
        }

    }
}