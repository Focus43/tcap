<?php
namespace Concrete\Package\Focal\Theme\Focalize;

class PageTheme extends \Concrete\Core\Page\Theme\Theme {

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    protected static $_backgroundClasses = array(
        'background-green',
        'background-blue',
        'background-red'
    );

    /**
     * @return array|void
     */
    public function getThemeAreaClasses(){
        return array(
            'Main 0' => array(
                'parallaxer',
                'otherwise'
            ),
            'Main' => array(
                'padless-grid'
            ),
            'Main 4' => array(
                'dist',
                'mk'
            ),
            'Main Stuff' => array(
                'asdiofew',
                'asdioewre34sdf'
            ),
            'Otro' => array(
                'something',
                'fancy'
            )
        );
    }


    public function getThemeBlockClasses(){
        return array(
            'content'   => self::$_backgroundClasses,
            'image'     => self::$_backgroundClasses
        );
    }

}