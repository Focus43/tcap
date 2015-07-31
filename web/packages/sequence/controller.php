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
    use FileAttributeKey; /** @see \Concrete\Core\Attribute\Key\FileKey */
    use Group; /** @see \Concrete\Core\User\Group\Group */
    use GroupSet; /** @see \Concrete\Core\User\Group\GroupSet */
    use SinglePage; /** @see \Concrete\Core\Page\Single */
    use Concrete\Core\Page\Type\PublishTarget\Type\Type as PublishTargetType;
    use Zend\Feed\Reader\Collection;

    class Controller extends Package {

        const PACKAGE_HANDLE                = 'sequence',
            // Collection Attributes
            COLLECTION_ATTR_SECTIONS        = 'page_sections',
            COLLECTION_ATTR_PAGE_IMAGE      = 'image', // @todo: rename to page_image
            // User Attributes
            FILE_ATTR_BIO                   = 'bio',
            FILE_ATTR_SECONDARY_PHOTO       = 'secondary_photo',
            FILE_ATTR_INVOLVEMENT_LEVEL     = 'involvement_level',
            // File Set
            FILE_SET_MASTHEAD               = 'Masthead Slider';


        protected $pkgHandle 			= self::PACKAGE_HANDLE;
        protected $appVersionRequired 	= '5.7';
        protected $pkgVersion 			= '0.304';


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

            Route::register(
                Router::route(array('/disclaimer', 'sequence')),
                '\Concrete\Package\Sequence\Controller\Tools\Disclaimer::view'
            );

            Route::register(
                Router::route(array('/terms_of_use', 'sequence')),
                '\Concrete\Package\Sequence\Controller\Tools\TermsOfUse::view'
            );

            Route::register(
                Router::route(array('/contact_form', 'sequence')),
                '\Concrete\Package\Sequence\Controller\Tools\Contact::handler'
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
            $this->setupAttributeTypeAssociations()
                ->setupCollectionAttributes()
                ->setupFileAttributes()
                ->setupFileSets()
                ->setupTheme()
                ->setupTemplates()
                ->setupPageTypes()
                ->assignPageTypes()
                ->setupSinglePages()
                ->setupBlockTypeSets()
                ->setupBlocks()
                ->setupThumbnailTypes();
        }


        /**
         * @return Controller
         */
        private function setupAttributeTypeAssociations(){
            $fileAKC = \Concrete\Core\Attribute\Key\Category::getByHandle('file');
            if( is_object($fileAKC) ){
                $fileAKC->associateAttributeKeyType($this->attributeType('image_file'));
            }

            return $this;
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

            if( ! is_object(CollectionAttributeKey::getByHandle(self::COLLECTION_ATTR_PAGE_IMAGE)) ){
                CollectionAttributeKey::add($this->attributeType('image_file'), array(
                    'akHandle'  => self::COLLECTION_ATTR_PAGE_IMAGE,
                    'akName'    => 'Page Image'
                ), $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupFileAttributes(){
            if( !(is_object(FileAttributeKey::getByHandle(self::FILE_ATTR_BIO))) ){
                FileAttributeKey::add($this->attributeType('textarea'), array(
                    'akHandle'					=> self::FILE_ATTR_BIO,
                    'akName'					=> t('Bio'),
                    'uakRegisterEdit'			=> 1,
                    'uakRegisterEditRequired' 	=> 0,
                    'akIsSearchable'            => 1,
                    'akIsSearchableIndexed'     => 1,
                    'akTextareaDisplayMode'     => 'rich_text'
                ), $this->packageObject());
            }

            if( !(is_object(FileAttributeKey::getByHandle(self::FILE_ATTR_SECONDARY_PHOTO))) ){
                FileAttributeKey::add($this->attributeType('image_file'), array(
                    'akHandle'					=> self::FILE_ATTR_SECONDARY_PHOTO,
                    'akName'					=> t('Secondary Photo'),
                    'uakRegisterEdit'			=> 1,
                    'uakRegisterEditRequired' 	=> 0
                ), $this->packageObject());
            }

            if( !(is_object(FileAttributeKey::getByHandle(self::FILE_ATTR_INVOLVEMENT_LEVEL))) ){
                FileAttributeKey::add($this->attributeType('select'), array(
                    'akHandle'                  => self::FILE_ATTR_INVOLVEMENT_LEVEL,
                    'akName'                    => t('Involvement Level'),
                    'uakRegisterEdit'           => 1,
                    'uakRegisterEditRequired'   => 0
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

            $fullPageTemplate = PageTemplate::getByHandle('full');
            if( is_object($fullPageTemplate) && ((int)$fullPageTemplate->getPackageID() !== $this->packageObject()->getPackageID()) ){
                $fullPageTemplate->delete();
            }

            if( ! PageTemplate::getByhandle('full') ){
                PageTemplate::add('full', t('Full'), 'full.png', $this->packageObject());
            }

            if( ! PageTemplate::getByhandle('news_post') ){
                PageTemplate::add('news_post', t('News Post'), 'full.png', $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupPageTypes(){
            /** @var $pageType \Concrete\Core\Page\Type\Type */
            $pageType = PageType::getByHandle('page');

            // Delete it? Only works if the $pageType isn't assigned to this package already
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

            if( !is_object(PageType::getByHandle('news_post')) ){
                /** @var $ptPage \Concrete\Core\Page\Type\Type */
                $ptPage = PageType::add(array(
                    'handle'                => 'news_post',
                    'name'                  => t('News Post'),
                    'defaultTemplate'       => PageTemplate::getByHandle('news_post'),
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
            Loader::db()->Execute('UPDATE Pages set pkgID = ? WHERE cID = 1', array(
                (int) $this->packageObject()->getPackageID()
            ));

            // Things available through the API
            $homePageCollection = \Concrete\Core\Page\Page::getByID(1)->getVersionToModify();
            $homePageCollection->update(array(
                'pTemplateID' => PageTemplate::getByHandle('default')->getPageTemplateID()
            ));
            $homePageCollection->setPageType(PageType::getByHandle('page'));

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupSinglePages(){
            // Dashboard pages
            SinglePage::add('/dashboard/portfolio/', $this->packageObject());
            /** @var $sp \Concrete\Core\Page\Page */
            $sp = SinglePage::add('/dashboard/portfolio/item', $this->packageObject());
            // since $sp is only returned if it's NEW:
            if ($sp) {
                $sp->update(array(
                    'cName' => 'New Portfolio Item'
                ));
            }

            // Public single pages
            SinglePage::add('/news', $this->packageObject());

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

            if(!is_object(BlockType::getByHandle('quotes'))) {
                BlockType::installBlockTypeFromPackage('quotes', $this->packageObject());
            }

            if(!is_object(BlockType::getByHandle('statistic'))) {
                BlockType::installBlockTypeFromPackage('statistic', $this->packageObject());
            }

            if(!is_object(BlockType::getByHandle('photo_wall'))) {
                BlockType::installBlockTypeFromPackage('photo_wall', $this->packageObject());
            }

            if(!is_object(BlockType::getByHandle('single_page_nav'))) {
                BlockType::installBlockTypeFromPackage('single_page_nav', $this->packageObject());
            }

            if(!is_object(BlockType::getByHandle('twitter_feed'))) {
                BlockType::installBlockTypeFromPackage('twitter_feed', $this->packageObject());
            }

            if(!is_object(BlockType::getByHandle('portfolio'))) {
                BlockType::installBlockTypeFromPackage('portfolio', $this->packageObject());
            }

            return $this;
        }


        private function setupThumbnailTypes(){
            $largeThumbnail = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('large');
            if( ! is_object($largeThumbnail) ){
                $type = new \Concrete\Core\File\Image\Thumbnail\Type\Type();
                $type->setName('Large');
                $type->setHandle('large');
                $type->setWidth(1440);
                $type->save();
            }

            return $this;
        }


        /**
         * Get the package object; if it hasn't been instantiated yet, load it.
         * @return \Concrete\Core\Package\Package
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
