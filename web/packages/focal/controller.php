<?php
namespace Concrete\Package\Focal;
defined('C5_EXECUTE') or die(_("Access Denied."));

/** @link https://github.com/concrete5/concrete5-5.7.0/blob/develop/web/concrete/config/app.php#L10-L90 Aliases */
use Loader; /** @see \Concrete\Core\Legacy\Loader */
use Route; /** @see \Concrete\Core\Routing\Router */
use Package; /** @see \Concrete\Core\Package\Package */
use PageType; /** @see \Concrete\Core\Page\Type\Type */
use PageTemplate; /** @see \Concrete\Core\Page\Template */
use PageTheme; /** @see \Concrete\Core\Page\Theme\Theme */
use CollectionAttributeKey; /** @see \Concrete\Core\Attribute\Key\CollectionKey */
use Concrete\Core\Page\Type\PublishTarget\Type\Type as PublishTargetType;

class Controller extends Package {

    const COLLECTION_ATTRIBUTE_SECTIONS = 'page_sections';

    protected $pkgHandle            = 'focal';
    protected $appVersionRequired   = '5.7';
    protected $pkgVersion           = '0.14';


    /** @return string */
    public function getPackageName(){
        return t('Focal');
    }


    /** @return string */
    public function getPackageDescription(){
        return t('Focal site package');
    }


    /**
     * @link http://www.concrete5.org/community/forums/5-7-discussion/a-few-questions-about-porting-packages-and-themes-to-5.7/#654225
     */
    public function on_start(){
        Route::register('/__data', '\Concrete\Package\Focal\Ajax\Data::handler');
    }


    /** @return void */
    public function uninstall(){
        parent::uninstall();
    }


    /** @return void */
    public function install(){
        parent::install();
        $this->installOrUpdate();
    }


    /** @return void */
    public function upgrade(){
        parent::upgrade();
        $this->installOrUpdate();
    }


    /**
     * Handle both install and update tasks. Easier to keep everything
     * in sync.
     * @return void
     */
    protected function installOrUpdate(){
        $this->pkgThemes()
             ->pkgTemplates()
             ->pkgPageTypes()
             ->pkgCollectionAttributes();
    }


    /**
     * @return Controller
     */
    protected function pkgThemes(){
        try {
            if( ! is_object(PageTheme::getByHandle('focalize')) ){
                /** @var $theme \Concrete\Core\Page\Theme\Theme */
                $theme = PageTheme::add('focalize', $this->packageObject());
                $theme->applyToSite();
            }
        }catch(Exception $e){ /* All good, fail silently */ }

        return $this;
    }


    /**
     * @return Controller
     */
    protected function pkgTemplates(){
        if( ! PageTemplate::getByHandle('article') ){
            PageTemplate::add('article', t('Article'), 'full.png', $this->packageObject());
        }

        return $this;
    }


    /**
     * @return Controller
     */
    protected function pkgPageTypes(){
        // Setup Article Page Type, if not defined yet
        if( !(PageType::getByHandle('article')) ){
            /** @var $ptArticle \Concrete\Core\Page\Type\Type */
            $ptArticle = PageType::add(array(
                'handle'                => 'article',
                'name'                  => t('Article'),
                'defaultTemplate'       => PageTemplate::getByHandle('article'),
                'ptIsFrequentlyAdded'   => 1,
                'ptLaunchInComposer'    => 1
            ), $this->packageObject());

            // Set configured publish target
            $ptArticle->setConfiguredPageTypePublishTargetObject(
                PublishTargetType::getByHandle('all')->configurePageTypePublishTarget($ptArticle, array(
                    'ptID' => $ptArticle->getPageTypeID()
                ))
            );

            /** @var $layoutSet \Concrete\Core\Page\Type\Composer\FormLayoutSet */
            $layoutSet = $ptArticle->addPageTypeComposerFormLayoutSet('Basics', 'Basics');

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
    protected function pkgCollectionAttributes(){
        if( ! is_object(CollectionAttributeKey::getByHandle(self::COLLECTION_ATTRIBUTE_SECTIONS)) ){
            CollectionAttributeKey::add($this->attributeType('number'), array(
                'akHandle' =>  self::COLLECTION_ATTRIBUTE_SECTIONS,
                'akName'    => 'Page Sections'
            ), $this->packageObject());
        }

        return $this;
    }


    /**
     * Memoize attribute types.
     * @param string $handle
     * @return \Concrete\Core\Attribute\Type || Null
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


    /**
     * Memoize the package object instance.
     * @return mixed Package | null
     */
    private function packageObject(){
        if( $this->_packageObj === null ){
            $this->_packageObj = Package::getByHandle($this->pkgHandle);
        }
        return $this->_packageObj;
    }

}