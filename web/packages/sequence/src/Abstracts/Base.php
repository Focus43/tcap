<?php

namespace Concrete\Package\Sequence\Src\Abstracts {
    use Concrete\Package\Sequence\Src\Interfaces\BaseInterface;
    /**
     * Class Base
     * @package Concrete\Package\Sequence\Src\Abstracts
     */
    abstract class Base implements BaseInterface {
        /**
         * @param array $properties
         */
        public function setPropertiesFromArray( array $properties = array() ){
            foreach($properties as $key => $prop) {
                $this->{$key} = $prop;
            }
            return $this;
        }
    }
}

//namespace Concrete\Package\Sequence\Src\Abstracts {
//    /**
//     * Interface BaseInterface
//     * @package Concrete\Package\Sequence\Src\Abstracts
//     */
//    interface BaseInterface {
//        const PACKAGE_HANDLE    = 'sequence';
//        const TIMESTAMP_FORMAT  = 'Y-m-d H:i:s';
//        public function __construct( array $properties = array() );
//        public function setPropertiesFromArray( array $properties = array() );
//    }
//    /**
//     * Class Base
//     * @package Concrete\Package\Sequence\Src\Abstracts
//     */
//    abstract class Base implements BaseInterface {
//        /**
//         * @param array $properties
//         */
//        public function __construct( array $properties = array() ){
//            $this->setPropertiesFromArray($properties);
//        }
//        /**
//         * @param array $properties
//         */
//        public function setPropertiesFromArray( array $properties = array() ){
//            foreach($properties as $key => $prop) {
//                $this->{$key} = $prop;
//            }
//        }
//    }
//}