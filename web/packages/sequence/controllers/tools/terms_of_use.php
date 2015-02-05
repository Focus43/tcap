<?php namespace Concrete\Package\Sequence\Controller\Tools {

    use Page;
    use Request; /** @see \Concrete\Core\Http\Request */
    use Concrete\Package\Sequence\Controller AS PackageController;

    final class TermsOfUse extends \Concrete\Core\Controller\Controller {

        protected $viewPath = 'terms_of_use';

        public function __construct(){
            Request::getInstance()->setCurrentPage(\Concrete\Core\Page\Page::getByID(1));
            parent::__construct();
        }

        public function view(){

        }

    }

}