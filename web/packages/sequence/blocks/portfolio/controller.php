<?php
namespace Concrete\Package\Sequence\Block\Portfolio;

use Loader;
use FileList;
use FileSet;
use Concrete\Package\Sequence\Src\SequencePortfolio;

class Controller extends \Concrete\Core\Block\BlockController {

    protected $portfolioItems;

    protected $btTable 									= 'btPortfolio';
    protected $btInterfaceWidth 						= '650';
    protected $btInterfaceHeight						= '480';
    protected $btCacheBlockRecord 						= true;
    protected $btCacheBlockOutput 						= true;
    protected $btCacheBlockOutputOnPost 				= true;
    protected $btCacheBlockOutputForRegisteredUsers 	= false;
    protected $btCacheBlockOutputLifetime 				= 0;

    public function getBlockTypeDescription(){
        return t("Add portfolio display");
    }


    public function getBlockTypeName(){
        return t("Portfolio");
    }

    public function add(){ $this->edit(); }
    public function edit(){
        $this->set('portfolioList', $this->portfolioList());
        $this->set('chosenPortfolioItems', $this->chosenPortfolioItems());
    }


    public function view(){
        $this->set('portfolioList', $this->portfolioList());
        $this->set('categoryList', SequencePortfolio::getCategoriesAvailableList());
        $this->set('chosenPortfolioItems', $this->chosenPortfolioItems());
    }

    protected function chosenPortfolioItems(){
        if( $this->_chosenItems === null ){
            if( is_string($this->portfolioItems) ){
                $this->_chosenItems = json_decode($this->portfolioItems);
            }else{
                $this->_chosenItems = array();
            }
        }
        return $this->_chosenItems;
    }

    protected function portfolioList(){
        if( $this->_portfolioList === null ){
            $sortOrder = $this->chosenPortfolioItems();
            if( !empty($sortOrder) ){
                $this->_portfolioList = array_filter(SequencePortfolio::findAll(), function( $item ) use ($sortOrder){
                    return in_array($item->getID(), $sortOrder);
                });
                usort($this->_portfolioList, function($item1, $item2) use ($sortOrder){
                    $pos1 = array_search((int)$item1->getID(), $sortOrder);
                    $pos2 = array_search((int)$item2->getID(), $sortOrder);
                    return ($pos1 > $pos2) ? 1 : -1;
                });
            }else{
                $this->_portfolioList = SequencePortfolio::findAll();
            }
        }
        return $this->_portfolioList;
    }

    public function save( $args ){
        parent::save(array(
            'portfolioItems' => json_encode((array)$args['items'])
        ));
    }
}