<?php namespace Concrete\Package\Sequence\Theme\Sequence {

    class PageTheme extends \Concrete\Core\Page\Theme\Theme {

        protected $pThemeGridFrameworkHandle = 'bootstrap3';

        protected static $_blockClasses = array(
            'iconified',
            'anglified'
        );

        protected static $_sectionClasses = array(
            'parallax',
            'boxd-orange',
            'boxd-gray'
        );

        public function getThemeEditorClasses(){
            return array(
                array('title' => t('Text:Orange'), 'menuClass' => '', 'spanClass' => 'text-orange')
            );
        }

        /**
         * @return array|void
         */
        public function getThemeAreaClasses(){
            return array(
                'Main 1' => self::$_sectionClasses,
                'Main 2' => self::$_sectionClasses,
                'Main 3' => self::$_sectionClasses,
                'Main 4' => self::$_sectionClasses,
                'Main 5' => self::$_sectionClasses
            );
        }


        public function getThemeBlockClasses(){
            return array(
                'content'   => self::$_blockClasses
            );
        }

    }

}