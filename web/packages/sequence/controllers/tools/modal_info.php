<?php namespace Concrete\Package\Sequence\Controller\Tools {

    use Concrete\Package\Sequence\Controller AS PackageController;

    final class ModalInfo extends \Concrete\Core\Controller\Controller {

        protected $viewPath = 'modal_info';

        public function view( $id = null ){
            $fileObj = \Concrete\Core\File\File::getByID((int)$id);
            if( is_object($fileObj) && $fileObj->getFileID() >= 1 ){
                $fileVersionObj = $fileObj->getApprovedVersion();
                $this->set('photoFileObj', $fileVersionObj->getAttribute(PackageController::FILE_ATTR_SECONDARY_PHOTO));
                $this->set('fullName', $fileVersionObj->getTitle());
                $this->set('title', $fileVersionObj->getDescription());
                $this->set('bio', $fileVersionObj->getAttribute(PackageController::FILE_ATTR_BIO));
            }
        }

    }

}