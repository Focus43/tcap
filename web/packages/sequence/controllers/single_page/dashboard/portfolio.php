<?php
namespace Concrete\Package\Sequence\Controller\SinglePage\Dashboard {

    use \Concrete\Core\Page\Controller\DashboardPageController;
    use \Concrete\Package\Sequence\Src\SequencePortfolio;

    class Portfolio extends DashboardPageController {

        public function view() {
            $list = SequencePortfolio::findAll();
            $this->set('list', $list);
        }

    }
}