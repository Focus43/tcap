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
         * @Column(type="string", length=255)
         */
        protected $shortName;
        /**
         * @Column(type="string", length=255)
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
         * @return string
         */
        public function getShortName(){
            return $this->shortName;
        }
        /**
         * @return string
         */
        public function getCategory(){
            return $this->category;
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
    }
}