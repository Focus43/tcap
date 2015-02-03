<?php namespace Concrete\Package\Sequence\Block\Statistic;

    use Loader;
    use \Concrete\Core\Editor\LinkAbstractor;

    class Controller extends \Concrete\Core\Block\BlockController {

        protected $btTable 									= 'btStatistic';
        protected $btInterfaceWidth 						= '580';
        protected $btInterfaceHeight						= '400';
        protected $btDefaultSet                             = 'sequence';
        protected $btCacheBlockRecord 						= true;
        protected $btCacheBlockOutput 						= true;
        protected $btCacheBlockOutputOnPost 				= true;
        protected $btCacheBlockOutputForRegisteredUsers 	= false;
        protected $btCacheBlockOutputLifetime 				= 0;

        public function getBlockTypeDescription(){
            return t("Add a statistic that counts up");
        }


        public function getBlockTypeName(){
            return t("Statistic");
        }


        public function add(){
            $this->edit();
        }


        public function composer(){
            $this->edit();
        }


        public function edit(){
            $this->requireAsset('redactor');
            $this->requireAsset('core/file-manager');
        }


        public function _translateFromEditMode( $content ){
            return LinkAbstractor::translateFromEditMode($content);
        }


        public function _translateFrom( $content ){
            return LinkAbstractor::translateFrom($content);
        }


        public function save( $args ){
            $args['statDetails'] = LinkAbstractor::translateTo($args['statDetails']);
            parent::save($args);
        }

    }