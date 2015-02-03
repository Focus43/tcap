<?php namespace Concrete\Package\Sequence\Controller\Tools {

    use Loader;
    use Log;
    use Concrete\Package\Sequence\Controller AS PackageController;

    final class Contact extends \Concrete\Core\Controller\Controller {

        public function handler(){
            // Parse POST from angular
            $requestBody = Loader::helper('json')->decode(file_get_contents('php://input'));

            // Log entry
            Log::addEntry(print_r($requestBody, true));

            // Render JSON response
            echo Loader::helper('json')->encode((object)array(
                'ok' => 1
            ));

            exit(0);
        }

    }

}