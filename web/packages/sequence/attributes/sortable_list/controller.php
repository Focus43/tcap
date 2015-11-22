<?php namespace Concrete\Package\Sequence\Attribute\SortableList {
    defined('C5_EXECUTE') or die(_("Access Denied."));

    use Loader;

    class Controller extends \Concrete\Core\Attribute\Controller {

        protected $searchIndexFieldDefinition = array('type' => 'integer', 'options' => array('default' => 0, 'notnull' => false));

        public function getValue() {
            $value = Loader::db()->GetOne("select value from atSortableList where avID = ?", array($this->getAttributeValueID()));
            try {
                return json_decode($value);
            }catch(\Exception $e){
                return array();
            }
        }

        public function getDisplaySanitizedValue(){
            $value = $this->getValue();
            if( ! empty($value) && is_array($value) ){
                return join(',', $value);
            }
        }

        public function searchForm($list) {
            return $list;
        }

        public function search() {
            print "Search Disabled";
        }

        public function form() {
            $this->set('listData', $this->getValue());
        }

        public function validateForm($p) {
            return $p['value'] != 0;
        }

        public function saveValue( $value ) {
            if( empty($value) ){
                $value = json_encode(array());
            }
            Loader::db()->Replace('atSortableList', array('avID' => $this->getAttributeValueID(), 'value' => $value), 'avID', true);
        }

        public function deleteKey() {
            $db = Loader::db();
            $arr = $this->attributeKey->getAttributeValueIDList();
            foreach($arr as $id) {
                $db->Execute('delete from atSortableList where avID = ?', array($id));
            }
        }

        public function saveForm($data) {
            $serialized = json_encode($data['list_values']);
            $this->saveValue($serialized);
        }

        public function deleteValue() {
            Loader::db()->Execute('delete from atSortableList where avID = ?', array($this->getAttributeValueID()));
        }

    }

}