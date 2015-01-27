<?php
namespace Concrete\Package\Sequence\Block\Accordion;
use \Concrete\Core\Block\BlockController;
use Loader;

    /**
     * Accordion
     */
    class Controller extends BlockController {

        protected $btTable 									= 'btAccordion';
        protected $btInterfaceWidth 						= '460';
        protected $btInterfaceHeight						= '400';
        protected $btWrapperClass                           = 'ccm-ui';
        protected $btDefaultSet                             = 'sequence';
//        protected $btIgnorePageThemeGridFrameworkContainer  = true;
//        protected $btCacheBlockRecord 						= true;
//        protected $btCacheBlockOutput 						= true;
//        protected $btCacheBlockOutputOnPost 				= true;
//        protected $btCacheBlockOutputForRegisteredUsers 	= true;
//        protected $btCacheBlockOutputLifetime 				= CACHE_LIFETIME;

        // database fields
        //public $dataFields;


        public function getBlockTypeDescription(){
            return t("Create an accordion");
        }


        public function getBlockTypeName(){
            return t("Accordion");
        }


        public function add(){
            $this->edit();
        }


        public function edit(){
            // Pass helpers
            $this->set('textHelper', Loader::helper('text'));
            $this->set('contentHelper', Loader::helper('content'));

            // Get themeCSS
            $currentTheme = Page::getCurrentPage()->getCollectionThemeObject();
            if( is_object($currentTheme) ){
                $this->set('contentCSSPath', $currentTheme->getThemeEditorCSS());
            }

            // Pass data
            $this->set('dataFields', (array) Loader::helper('json')->decode($this->dataFields));
        }


        public function view(){
            $this->set('contentHelper', Loader::helper('content'));
            $this->set('dataFields', (array) Loader::helper('json')->decode($this->dataFields));
        }


        public function save( $args ){
            $data = array();
            $contentHelper = Loader::helper('content');
            foreach($args['heading'] AS $key => $heading){
                if( !empty($heading) ){
                    array_push($data, (object)array(
                        'heading' => $heading,
                        'body'    => $contentHelper->translateTo($args['body'][$key])
                    ));
                }
            }

            parent::save(array(
                'dataFields' => Loader::helper('json')->encode($data)
            ));
        }

    }