<?php namespace Concrete\Package\Sequence\Src {

    /**
     * Class Calendar
     * @package Concrete\Package\Sequence\Src
     * @Entity
     * @HasLifecycleCallbacks
     */
    class SequencePortfolio extends Abstracts\Base {
        use Traits\Persistable;

        /**
         * @Column(type="string", length=255)
         */
        protected $title;
        /**
         * @Column(type="text")
         */
        protected $description;
        /**
         * @Column(type="simple_array")
         */
        protected $category;
        /**
         * @Column(type="string", length=255)
         */
        protected $toolsUsed;
        /**
         * @Column(type="string", length=255)
         */
        protected $clientName;
        /**
         * @Column(type="string", length=255)
         */
        protected $clientUrl;
        /**
         * @Column(type="string", length=255)
         */
        protected $projectUrl;
        /**
         * @Column(columnDefinition="integer unsigned")
         */
        protected $mainImageID;
        /**
         * @Column(columnDefinition="integer unsigned")
         */
        protected $galleryFileSetID;
        /**
         * @Column(columnDefinition="integer unsigned")
         */
        protected $clientLogoFileID;
        /**
         * @Column(columnDefinition="boolean")
         */
        protected $isFeatured;


        /**
         * Constructor
         */
        public function __construct(){

        }
        /**
         * @return string
         */
        public function __toString(){
            return ucwords( $this->title );
        }
        /**
         * @return string
         */
        public function getTitle(){
            return $this->title;
        }
        /**
         * @return string
         */
        public function getDescription(){
            return $this->description;
        }

        /**
         * In the DB, this is stored as a comma-separated string. Doctrine
         * knows to convert to an array automatically.
         * @return array
         */
        public function getMemberCategories(){
            return $this->category ? $this->category : array();
        }

        /**
         * Get a concatenated list of the topics, defaults to being comma
         * separated.
         * @param string $glue
         * @return string
         */
        public function getCategoriesString( $glue = ', ' ){
            $nodeLabels = array();
            if(!empty($this->category)): foreach($this->category AS $categoryID){
                /** @var $topic \Concrete\Core\Tree\Node\Type\Topic */
                $topic = \Concrete\Core\Tree\Node\Type\Topic::getByID($categoryID);
                if( is_object($topic) ){
                    array_push($nodeLabels, $topic->getTreeNodeDisplayName());
                }
            } endif;

            return join($glue, $nodeLabels);
        }

        /**
         * Get a list of all categories as an array, whereas the categoryID
         * is the key and => value is the label.
         * @return array
         */
        public static function getCategoriesAvailableList(){
            $topicTree = \Concrete\Core\Tree\Type\Topic::getByName('PortfolioCategories');
            if( $topicTree instanceof \Concrete\Core\Tree\Tree ){
                /** @var $rootNode \Concrete\Core\Tree\Node\Node */
                $rootNode = $topicTree->getRootTreeNodeObject();
                $rootNode->populateDirectChildrenOnly();
                /** @var $kids array */
                $kids = $rootNode->getChildNodes();
                if( !empty($kids) ){
                    $iterable = array();
                    /** @var $topicObj \Concrete\Core\Tree\Node\Type\Topic */
                    foreach($kids AS $topicObj){
                        $iterable[$topicObj->getTreeNodeID()] = $topicObj->getTreeNodeDisplayName();
                    }
                    return $iterable;
                }
            }
            return array();
        }

        /**
         * @return string
         */
        public function getToolsUsed(){
            return $this->toolsUsed;
        }
        /**
         * @return string
         */
        public function getClientName(){
            return $this->clientName;
        }
        /**
         * @return string
         */
        public function getClientUrl(){
            return $this->clientUrl;
        }
        /**
         * @return string
         */
        public function getProjectUrl(){
            return $this->projectUrl;
        }
        /**
         * @return int
         */
        public function getMainImageID(){
            return $this->mainImageID;
        }
        /**
         * @return int
         */
        public function getGalleryFileSetID(){
            return $this->galleryFileSetID;
        }
        /**
         * @return int
         */
        public function getClientLogoFileID(){
            return $this->clientLogoFileID;
        }
        /**
         * @return bool
         */
        public function getIsFeatured(){
            return $this->isFeatured;
        }

        /**
         * @param $id Int
         * @return mixed SequencePortfolio|null
         */
        public static function getByID( $id ){
            return self::entityManager()->find(__CLASS__, $id);
        }

        /****************************************************************
         * List queries
         ***************************************************************/
        /**
         * @return array
         */
        public static function findAll(){
            return self::entityManager()->getRepository(__CLASS__)->findAll();
        }
        /**
         * @param $title string
         * @return array
         */
        public static function findByCategory( $category ){
            return self::entityManager()->getRepository(__CLASS__)->createQueryBuilder('portfolio')
                ->where('portfolio.category LIKE :category')
                ->setParameter('title', "%{$category}%")
                ->getQuery()
                ->getResult();
        }
        /**
         * @return array
         */
        public static function findFeatured( ){
            return self::entityManager()->getRepository(__CLASS__)->createQueryBuilder('portfolio')
                ->where('portfolio.isFeatured = :isFeatured')
                ->setParameter('isFeatured', true)
                ->getQuery()
                ->getResult();
        }
    }
}
