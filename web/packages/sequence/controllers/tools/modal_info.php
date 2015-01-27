<?php namespace Concrete\Package\Sequence\Controller\Tools {

    use UserInfo;
    use Concrete\Package\Sequence\Controller AS PackageController;

    final class ModalInfo extends \Concrete\Core\Controller\Controller {

        protected $viewPath = 'modal_info';

        public function view( $id = null ){
            $userInfoObj = UserInfo::getByID((int)$id);
            if( $userInfoObj instanceof UserInfo ){
                $this->set('photoFileObj', $userInfoObj->getAttribute(PackageController::USER_ATTR_SECONDARY_PHOTO));
                $this->set('fullName', sprintf('%s %s', $userInfoObj->getAttribute(PackageController::USER_ATTR_FIRST_NAME), $userInfoObj->getAttribute(PackageController::USER_ATTR_LAST_NAME)));
                $this->set('title', $userInfoObj->getAttribute(PackageController::USER_ATTR_TITLE));
                $this->set('description', $userInfoObj->getAttribute(PackageController::USER_ATTR_DESCRIPTION));
            }
        }

    }

}