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
