<?php
namespace Concrete\Package\Sequence\Controller\SinglePage\Dashboard\Portfolio {
    use \Concrete\Core\Page\Controller\DashboardPageController;
    use \Concrete\Package\Sequence\Src\SequencePortfolio;
    use Loader;

    class Item extends DashboardPageController {

        protected static $categoryOptions = array("Strategic Design", "Case Study", "Branding");

        public function view( $id = null ) {
            $this->set('categoryOptions', self::$categoryOptions);
            $this->set('availableFileSets', $this->availableFileSets());
            if ( $id ) {
                $portfolio = SequencePortfolio::getByID($id);
                $this->set('pageTitle', "Edit " . $portfolio->getTitle());
            } else {
                $portfolio = new SequencePortfolio();
            }
            $this->set('portfolioObj', $portfolio);
            $this->requireAsset('redactor');
            $this->requireAsset('core/file-manager');
            $this->addFooterItem('<script type="text/javascript">var CCM_EDITOR_SECURITY_TOKEN = \''.Loader::helper('validation/token')->generate('editor').'\'</script>');
        }

//        public function edit( $id ){
//            $this->set('portfolioObj', PortfolioItem::getByID($id));
//        }

        public function save( $id = null ) { /** @var params Symfony\Component\HttpFoundation\ParameterBag */
//            print_r($this->getRequestActionParameters());
            if ( $id == null ) {
                SequencePortfolio::create($_POST);
            } else {
                $portfolio = SequencePortfolio::getByID($id);
                $portfolio->update($_POST);
            }

            $this->redirect('/dashboard/portfolio');
        }

        public function delete( $id ) {
            $portfolio = SequencePortfolio::getByID($id);
            $portfolio->remove();
        }

        /**
         * Get a list of available file sets.
         * @return Array
         */
        protected function availableFileSets(){
            if( $this->_availableFileSets === null ){
                $fileSetListObj = new \Concrete\Core\File\Set\SetList;
                $fileSetListObj->filterByType(\Concrete\Core\File\Set\Set::TYPE_PUBLIC);
                $fileSets = $fileSetListObj->get();

                $this->_availableFileSets = array();
                foreach($fileSets AS $fileSetObj){ /** @var $fileSetObj \Concrete\Core\File\Set\Set */
                    $this->_availableFileSets[$fileSetObj->getFileSetID()] = $fileSetObj->getFileSetName();
                }
            }
            return $this->_availableFileSets;
        }
    }
}