<?php namespace Concrete\Package\Sequence\Block\Quotes;

    use Loader;
    use \Concrete\Core\Editor\LinkAbstractor;

    /**
     * Accordion
     */
    class Controller extends \Concrete\Core\Block\BlockController {

        protected $btTable 									= 'btQuotes';
        protected $btInterfaceWidth 						= '580';
        protected $btInterfaceHeight						= '400';
        protected $btDefaultSet                             = 'sequence';
        protected $btCacheBlockRecord 						= true;
        protected $btCacheBlockOutput 						= true;
        protected $btCacheBlockOutputOnPost 				= true;
        protected $btCacheBlockOutputForRegisteredUsers 	= false;
        protected $btCacheBlockOutputLifetime 				= 0;

        public function getBlockTypeDescription(){
            return t("Create A Group Of Quotes");
        }


        public function getBlockTypeName(){
            return t("Quotes");
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

            // Pass data
            $this->set('dataFields', (array) Loader::helper('json')->decode($this->dataFields));
        }


        public function view(){
            $this->set('dataFields', (array) Loader::helper('json')->decode($this->dataFields));
        }


        public function _translateFromEditMode( $content ){
            return LinkAbstractor::translateFromEditMode($content);
        }


        public function _translateFrom( $content ){
            return LinkAbstractor::translateFrom($content);
        }


        public function save( $args ){
            $data = array();
            foreach((array)$args['author'] AS $index => $author){
                if( !empty($author) ){
                    array_push($data, (object)array(
                        'author' => $author,
                        'body'    => LinkAbstractor::translateTo($args['body'][$index])
                    ));
                }
            }

            parent::save(array(
                'dataFields' => Loader::helper('json')->encode($data)
            ));
        }

    }