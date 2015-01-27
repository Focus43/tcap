<?php namespace Concrete\Package\Sequence\Theme\Sequence {

    class PageTheme extends \Concrete\Core\Page\Theme\Theme {

        protected $pThemeGridFrameworkHandle = 'bootstrap3';

        protected static $contentBlockClasses = array(
            'iconified',
            'anglified',
            'countable'
        );

        protected static $sectionClasses = array(
            'wrap-parallax',
            'wrap-orange',
            'wrap-gray'
        );

        public function getThemeEditorClasses(){
            return array(
                array('title' => t('Text:Orange'), 'menuClass' => '', 'spanClass' => 'text-orange'),
                array('title' => t('Incrementable'), 'menuClass' => '', 'spanClass' => 'incrementable')
            );
        }

        /**
         * @return array|void
         */
        public function getThemeAreaClasses(){
            return array(
                'Main 1' => self::$sectionClasses,
                'Main 2' => self::$sectionClasses,
                'Main 3' => self::$sectionClasses,
                'Main 4' => self::$sectionClasses,
                'Main 5' => self::$sectionClasses
            );
        }


        public function getThemeBlockClasses(){
            return array(
                'content'   => self::$contentBlockClasses
            );
        }

    }

}