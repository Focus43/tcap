<?php namespace Concrete\Package\Sequence\Controller\SinglePage {

    use Concrete\Package\Sequence\Controller AS PackageController;

    class News extends \Concrete\Package\Sequence\Libraries\BaseController {

        protected $_includeThemeAssets  = true;
        //protected $supportsPageCache    = false;

        public function on_start(){
            parent::on_start();
            $this->set('singlePageBodyClasses', 'pg-news');
        }

    }

}