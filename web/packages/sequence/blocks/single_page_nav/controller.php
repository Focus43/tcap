<?php namespace Concrete\Package\Sequence\Block\SinglePageNav;

    use Loader;

    class Controller extends \Concrete\Core\Block\BlockController {

        protected $btTable 									= 'btSinglePageNav';
        protected $btInterfaceWidth 						= '580';
        protected $btInterfaceHeight						= '400';
        protected $btDefaultSet                             = 'sequence';
        protected $btCacheBlockRecord 						= true;
        protected $btCacheBlockOutput 						= true;
        protected $btCacheBlockOutputOnPost 				= true;
        protected $btCacheBlockOutputForRegisteredUsers 	= false;
        protected $btCacheBlockOutputLifetime 				= 0;

        public function getBlockTypeDescription(){
            return t("Link to areas of a single page");
        }


        public function getBlockTypeName(){
            return t("Single Page Nav");
        }


        public function add(){
            $this->edit();
        }


        public function composer(){
            $this->edit();
        }


        public function edit(){
            $this->set('existingAsJson', $this->navListData);
        }


        public function view(){
            $this->set('parsedData', (array) Loader::helper('json')->decode($this->navListData));
        }


        public function save( $args ){
            $data = array();
            foreach( (array)$args['item'] AS $index => $idString ){
                array_push($data, (object)array(
                    'id'    => $idString,
                    'label' => $args['label'][$index]
                ));
            }

            parent::save(array(
                'navListData' => Loader::helper('json')->encode( $data )
            ));
        }

    }