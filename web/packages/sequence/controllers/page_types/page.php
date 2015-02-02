<?php namespace Concrete\Package\Sequence\Controller\PageType {

    use FileSet;
    use GroupSet;
    use UserList;
    use FileAttributeKey;
    use Concrete\Package\Sequence\Controller AS PackageController;

    class Page extends \Concrete\Package\Sequence\Libraries\BaseController {

        protected $_includeThemeAssets = true;

        public function on_start(){
            parent::on_start();
            $this->set('isEditMode', $this->getPageObject()->isEditMode());
            $this->set('areaCount', $this->getPageObject()->getAttribute(PackageController::COLLECTION_ATTR_SECTIONS));
            $this->set('textHelper', $this->getHelper('helper/text'));
            $this->set('mastheadImages', $this->getMastheadImages());
//            $this->set('userGroupFilters', $this->getUserGroupsFilters());
            $this->set('userInvolvementLevels', $this->getuserInvolvementLevels());
//            $this->set('userList', $this->getUserList());
            $this->set('peopleFileList', $this->getPeopleFileList());
        }

        /**
         * Get images for the masthead
         * @return array
         */
        private function getMastheadImages(){
            $fileSetObj = FileSet::getByName(PackageController::FILE_SET_MASTHEAD);
            if( is_object($fileSetObj) ){
                return $fileSetObj->getFiles();
            }
            return array();
        }


        private function getuserInvolvementLevels(){
            $ak = FileAttributeKey::getByHandle(PackageController::FILE_ATTR_INVOLVEMENT_LEVEL);
            $ctrl = $ak->getController();
            $opts = $ctrl->getOptions();

            $list = array();
            foreach($opts AS $optObj){ /** $optObj \Concrete\Attribute\Select\Option */
                array_push($list, $optObj->getSelectAttributeOptionValue());
            }

            return $list;
        }


        private function getPeopleFileList(){
            $fileSetObj = FileSet::getByName(PackageController::FILE_SET_PEOPLE);
            if( is_object($fileSetObj) ){
                return $fileSetObj->getFiles();
            }
            return array();
        }


        /**
         * Get list of user groups we should use for filtering
         * @return array
         */
//        private function getUserGroupsFilters(){
//            $groupSetObj = GroupSet::getByName(\Concrete\Package\Sequence\Controller::USER_GROUP_SET_ALL);
//            if( is_object($groupSetObj) ){
//                return $groupSetObj->getGroups();
//            }
//            return array();
//        }


        /**
         * Get user list results to show
         */
//        private function getUserList(){
//            $userListObj = new UserList();
//            return $userListObj->get();
//        }

    }

}