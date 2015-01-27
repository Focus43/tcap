<?php namespace Concrete\Package\Sequence {
    defined('C5_EXECUTE') or die(_("Access Denied."));

    /** @link https://github.com/concrete5/concrete5-5.7.0/blob/develop/web/concrete/config/app.php#L10-L90 Aliases */
    use Loader; /** @see \Concrete\Core\Legacy\Loader */
    use Router; /** @see \Concrete\Core\Routing\Router */
    use Route; /** @see \Concrete\Core\Support\Facade\Route */
    use Package; /** @see \Concrete\Core\Package\Package */
    use BlockType; /** @see \Concrete\Core\Block\BlockType\BlockType */
    use BlockTypeSet; /** @see \Concrete\Core\Block\BlockType\Set */
    use PageType; /** @see \Concrete\Core\Page\Type\Type */
    use PageTemplate; /** @see \Concrete\Core\Page\Template */
    use PageTheme; /** @see \Concrete\Core\Page\Theme\Theme */
    use FileSet; /** @see \Concrete\Core\File\Set\Set */
    use CollectionAttributeKey; /** @see \Concrete\Core\Attribute\Key\CollectionKey */
    use UserAttributeKey; /** @see \Concrete\Core\Attribute\Key\UserKey */
    use Group; /** @see \Concrete\Core\User\Group\Group */
    use GroupSet; /** @see \Concrete\Core\User\Group\GroupSet */
    use Concrete\Core\Page\Type\PublishTarget\Type\Type as PublishTargetType;

    class Controller extends Package {

        const PACKAGE_HANDLE                = 'sequence',
            // Collection Attributes
            COLLECTION_ATTR_SECTIONS        = 'page_sections',
            // User Attributes
            USER_ATTR_FIRST_NAME            = 'first_name',
            USER_ATTR_LAST_NAME             = 'last_name',
            USER_ATTR_TITLE                 = 'title',
            USER_ATTR_DESCRIPTION           = 'description',
            USER_ATTR_PHOTO                 = 'photo',
            USER_ATTR_SECONDARY_PHOTO       = 'secondary_photo',
            // File Sets
            FILE_SET_MASTHEAD               = 'Masthead Slider',
            // User Groups
            USER_GROUP_SET_ALL              = 'All',
            USER_GROUP_GENERAL_PARTNERS     = 'General Partners',
            USER_GROUP_FUND_MANAGERS        = 'Fund Managers',
            USER_GROUP_COMPANY_LEADERS      = 'Company Leaders',
            USER_GROUP_STRATEGIC_PARTNERS   = 'Strategic Partners';


        protected $pkgHandle 			= self::PACKAGE_HANDLE;
        protected $appVersionRequired 	= '5.7';
        protected $pkgVersion 			= '0.01';


        /**
         * @return string
         */
        public function getPackageName(){
            return t('Sequence');
        }


        /**
         * @return string
         */
        public function getPackageDescription() {
            return t('Sequence Theme');
        }


        /**
         * Run hooks high up in the load chain.
         * @return void
         */
        public function on_start(){
            define('SEQUENCE_IMAGE_PATH', DIR_REL . '/packages/' . $this->pkgHandle . '/images/');

            Route::register(
                Router::route(array('/modal_info/{id}', 'sequence')),
                '\Concrete\Package\Sequence\Controller\Tools\ModalInfo::view'
            );
        }


        /**
         * Proxy to the parent uninstall method
         * @return void
         */
        public function uninstall() {
            parent::uninstall();

            try {
                // delete database tables (if applicable)
            }catch(Exception $e){ /* FAIL GRACEFULLY */ }
        }


        /**
         * Run before install or upgrade to ensure dependencies
         * are present.
         * @todo: include package dependency checks
         */
        private function checkDependencies(){

        }


        /**
         * @return void
         */
        public function upgrade(){
            $this->checkDependencies();
            parent::upgrade();
            $this->installAndUpdate();
        }


        /**
         * @return void
         */
        public function install() {
            $this->checkDependencies();
            $this->_packageObj = parent::install();
            $this->installAndUpdate();
        }


        /**
         * Handle all the updating methods.
         * @return void
         */
        private function installAndUpdate(){
            $this->setupCollectionAttributes()
                ->setupUserAttributes()
                ->setupFileSets()
                ->setupUserGroups()
                ->setupTheme()
                ->setupTemplates()
                ->setupPageTypes()
                //->assignPageTypes()
                ->setupSinglePages()
                ->setupBlockTypeSets()
                ->setupBlocks();
        }


        /**
         * @return Controller
         */
        private function setupCollectionAttributes(){
            if( ! is_object(CollectionAttributeKey::getByHandle(self::COLLECTION_ATTR_SECTIONS)) ){
                CollectionAttributeKey::add($this->attributeType('number'), array(
                    'akHandle' =>  self::COLLECTION_ATTR_SECTIONS,
                    'akName'    => 'Page Sections'
                ), $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupUserAttributes(){
            if( !(is_object(UserAttributeKey::getByHandle(self::USER_ATTR_FIRST_NAME))) ){
                UserAttributeKey::add($this->attributeType('text'), array(
                    'akHandle'					=> self::USER_ATTR_FIRST_NAME,
                    'akName'					=> t('First Name'),
                    'uakRegisterEdit'			=> 1,
                    'uakRegisterEditRequired' 	=> 0,
                    'akIsSearchable'            => 1,
                    'akIsSearchableIndexed'     => 1
                ), $this->packageObject());
            }

            if( !(is_object(UserAttributeKey::getByHandle(self::USER_ATTR_LAST_NAME))) ){
                UserAttributeKey::add($this->attributeType('text'), array(
                    'akHandle'					=> self::USER_ATTR_LAST_NAME,
                    'akName'					=> t('Last Name'),
                    'uakRegisterEdit'			=> 1,
                    'uakRegisterEditRequired' 	=> 0,
                    'akIsSearchable'            => 1,
                    'akIsSearchableIndexed'     => 1
                ), $this->packageObject());
            }

            if( !(is_object(UserAttributeKey::getByHandle(self::USER_ATTR_TITLE))) ){
                UserAttributeKey::add($this->attributeType('text'), array(
                    'akHandle'					=> self::USER_ATTR_TITLE,
                    'akName'					=> t('Title'),
                    'uakRegisterEdit'			=> 1,
                    'uakRegisterEditRequired' 	=> 0,
                    'akIsSearchable'            => 1,
                    'akIsSearchableIndexed'     => 1
                ), $this->packageObject());
            }

            if( !(is_object(UserAttributeKey::getByHandle(self::USER_ATTR_DESCRIPTION))) ){
                UserAttributeKey::add($this->attributeType('textarea'), array(
                    'akHandle'					=> self::USER_ATTR_DESCRIPTION,
                    'akName'					=> t('Description'),
                    'uakRegisterEdit'			=> 1,
                    'uakRegisterEditRequired' 	=> 0,
                    'akIsSearchable'            => 1,
                    'akIsSearchableIndexed'     => 1,
                    'akTextareaDisplayMode'     => 'rich_text'
                ), $this->packageObject());
            }

            if( !(is_object(UserAttributeKey::getByHandle(self::USER_ATTR_PHOTO))) ){
                UserAttributeKey::add($this->attributeType('image_file'), array(
                    'akHandle'					=> self::USER_ATTR_PHOTO,
                    'akName'					=> t('Photo'),
                    'uakRegisterEdit'			=> 1,
                    'uakRegisterEditRequired' 	=> 0
                ), $this->packageObject());
            }

            if( !(is_object(UserAttributeKey::getByHandle(self::USER_ATTR_SECONDARY_PHOTO))) ){
                UserAttributeKey::add($this->attributeType('image_file'), array(
                    'akHandle'					=> self::USER_ATTR_SECONDARY_PHOTO,
                    'akName'					=> t('Secondary Photo'),
                    'uakRegisterEdit'			=> 1,
                    'uakRegisterEditRequired' 	=> 0
                ), $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupFileSets(){
            if( ! is_object(FileSet::getByName(self::FILE_SET_MASTHEAD)) ){
                FileSet::createAndGetSet(self::FILE_SET_MASTHEAD, FileSet::TYPE_PUBLIC);
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupUserGroups(){
            if( !(Group::getByName(self::USER_GROUP_GENERAL_PARTNERS) instanceof Group ) ){
                Group::add(self::USER_GROUP_GENERAL_PARTNERS, self::USER_GROUP_GENERAL_PARTNERS);
            }

            if( !(Group::getByName(self::USER_GROUP_FUND_MANAGERS) instanceof Group ) ){
                Group::add(self::USER_GROUP_FUND_MANAGERS, self::USER_GROUP_FUND_MANAGERS);
            }

            if( !(Group::getByName(self::USER_GROUP_COMPANY_LEADERS) instanceof Group ) ){
                Group::add(self::USER_GROUP_COMPANY_LEADERS, self::USER_GROUP_COMPANY_LEADERS);
            }

            if( !(Group::getByName(self::USER_GROUP_STRATEGIC_PARTNERS) instanceof Group ) ){
                Group::add(self::USER_GROUP_STRATEGIC_PARTNERS, self::USER_GROUP_STRATEGIC_PARTNERS);
            }

            // Group Sets
            if( !(GroupSet::getByName(self::USER_GROUP_SET_ALL) instanceof GroupSet) ){
                $groupSetAll = GroupSet::add(self::USER_GROUP_SET_ALL, $this->packageObject());
                $groupSetAll->addGroup(Group::getByName(self::USER_GROUP_GENERAL_PARTNERS));
                $groupSetAll->addGroup(Group::getByName(self::USER_GROUP_FUND_MANAGERS));
                $groupSetAll->addGroup(Group::getByName(self::USER_GROUP_COMPANY_LEADERS));
                $groupSetAll->addGroup(Group::getByName(self::USER_GROUP_STRATEGIC_PARTNERS));
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupTheme(){
            try {
                if( ! is_object(PageTheme::getByHandle('sequence')) ){
                    /** @var $theme \Concrete\Core\Page\Theme\Theme */
                    $theme = PageTheme::add('sequence', $this->packageObject());
                    $theme->applyToSite();
                }
            }catch(Exception $e){ /* fail gracefully */ }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupTemplates(){
            if( ! PageTemplate::getByHandle('default') ){
                PageTemplate::add('default', t('Default'), 'full.png', $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupPageTypes(){
            /** @var $pageType \Concrete\Core\Page\Type\Type */
            $pageType = PageType::getByHandle('page');

            // Delete it?
            if( is_object($pageType) && !((int)$pageType->getPackageID() >= 1) ){
                $pageType->delete();
            }

            if( !is_object(PageType::getByHandle('page')) ){
                /** @var $ptPage \Concrete\Core\Page\Type\Type */
                $ptPage = PageType::add(array(
                    'handle'                => 'page',
                    'name'                  => t('Page'),
                    'defaultTemplate'       => PageTemplate::getByHandle('default'),
                    'ptIsFrequentlyAdded'   => 1,
                    'ptLaunchInComposer'    => 1
                ), $this->packageObject());

                // Set configured publish target
                $ptPage->setConfiguredPageTypePublishTargetObject(
                    PublishTargetType::getByHandle('all')->configurePageTypePublishTarget($ptPage, array(
                        'ptID' => $ptPage->getPageTypeID()
                    ))
                );

                /** @var $layoutSet \Concrete\Core\Page\Type\Composer\FormLayoutSet */
                $layoutSet = $ptPage->addPageTypeComposerFormLayoutSet('Basics', 'Basics');

                /** @var $controlTypeCorePageProperty \Concrete\Core\Page\Type\Composer\Control\Type\CorePagePropertyType */
                $controlTypeCorePageProperty = \Concrete\Core\Page\Type\Composer\Control\Type\Type::getByHandle('core_page_property');

                /** @var $controlTypeName \Concrete\Core\Page\Type\Composer\Control\CorePageProperty\NameCorePageProperty */
                $controlTypeName = $controlTypeCorePageProperty->getPageTypeComposerControlByIdentifier('name');
                $controlTypeName->addToPageTypeComposerFormLayoutSet($layoutSet)
                    ->updateFormLayoutSetControlRequired(true);

                /** @var $controlTypePublishTarget \Concrete\Core\Page\Type\Composer\Control\CorePageProperty\PublishTargetCorePageProperty */
                $controlTypePublishTarget = $controlTypeCorePageProperty->getPageTypeComposerControlByIdentifier('publish_target');
                $controlTypePublishTarget->addToPageTypeComposerFormLayoutSet($layoutSet)
                    ->updateFormLayoutSetControlRequired(true);
            }

            return $this;
        }


        /**
         * @return Controller
         */
        function assignPageTypes(){
            // Assign Home to CollectionType 'Home'
//            Page::getByID(1)->update(array(
//                'ctID' => $this->pageType('home')->getCollectionTypeID()
//            ));

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupSinglePages(){
            return $this;
        }


        /**
         * @return Controller
         */
        private function setupBlockTypeSets(){
            if( !is_object(BlockTypeSet::getByHandle(self::PACKAGE_HANDLE)) ){
                BlockTypeSet::add(self::PACKAGE_HANDLE, self::PACKAGE_HANDLE, $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupBlocks(){
            if(!is_object(BlockType::getByHandle('accordion'))) {
                BlockType::installBlockTypeFromPackage('accordion', $this->packageObject());
            }

            return $this;
        }


        /**
         * Get the package object; if it hasn't been instantiated yet, load it.
         * @return Package
         */
        private function packageObject(){
            if( $this->_packageObj === null ){
                $this->_packageObj = Package::getByHandle( $this->pkgHandle );
            }
            return $this->_packageObj;
        }


        /**
         * @return AttributeType
         */
        private function attributeType( $handle ){
            if( is_null($this->{"at_{$handle}"}) ){
                $attributeType = \Concrete\Core\Attribute\Type::getByHandle($handle);
                if( is_object($attributeType) && $attributeType->getAttributeTypeID() >= 1 ){
                    $this->{"at_{$handle}"} = $attributeType;
                }
            }
            return $this->{"at_{$handle}"};
        }

    }
}
