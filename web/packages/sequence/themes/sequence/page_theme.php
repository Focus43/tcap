<?php namespace Concrete\Package\Sequence\Theme\Sequence {

    class PageTheme extends \Concrete\Core\Page\Theme\Theme {

        protected $pThemeGridFrameworkHandle = 'bootstrap3';

        protected static $_backgroundClasses = array(
            'background-green',
            'background-blue',
            'background-red',
            'box-padding'
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
                'Main 1' => array(
                    'parallax'
                ),
                'Main 2' => array(
                    'parallax'
                ),
                'Main 3' => array(
                    'parallax'
                ),
                'Main 4' => array(
                    'parallax'
                ),
                'Main 5' => array(
                    'parallax'
                ),
            );
        }


        public function getThemeBlockClasses(){
            return array(
//            'content'   => self::$_backgroundClasses,
//            'image'     => self::$_backgroundClasses
            );
        }

    }

}