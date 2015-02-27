<?php
namespace Concrete\Package\Sequence\Block\POrtfolio;

use Loader;
use FileList;
use FileSet;
use Concrete\Package\Sequence\Src\SequencePortfolio;

class Controller extends \Concrete\Core\Block\BlockController {

    private $_portfolioList;
//    protected $_categoryOptions = array("Strategic Design", "Case Study", "Branding");

//    protected $btTable 									= 'btPhotoWall';
//    protected $btTableSecondary                         = 'btPhotoWallFiles';
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


    public function view(){
        $this->set('portfolioList', $this->portfolioList());
        $this->set('categoryList', $this->getCategoryList());
    }

    protected function portfolioList(){
        $this->_portfolioList = SequencePortfolio::findAll();
        return $this->_portfolioList;
    }

    public function getCategoryList() {
        return SequencePortfolio::getCategoryOptions();
    }
//
//    /**
//     * @return \Concrete\Core\File\FileList
//     */
//    protected function fileListObj(){
//        if( $this->_fileListObj === null ){
//            $this->_fileListObj = new FileList();
//            $this->applyFileListFilters($this->_fileListObj);
//        }
//        return $this->_fileListObj;
//    }
//
//
//    /**
//     * Apply any customizations to the FileList query
//     * @param \Concrete\Core\File\FileList $fileListObj
//     */
//    protected function applyFileListFilters( \Concrete\Core\File\FileList $fileListObj ){
//        if( (int)$this->fileSource === self::FILE_SOURCE_CUSTOM ){
//            $fileListObj->getQueryObject()->rightJoin('f', $this->btTableSecondary, 'btsecondary', 'f.fID = btsecondary.fileID');
//            $fileListObj->getQueryObject()->andWhere('btsecondary.bID = :bRecordID');
//            $fileListObj->getQueryObject()->setParameter(':bRecordID', $this->bID);
//            $fileListObj->getQueryObject()->orderBy('btsecondary.displayOrder', 'asc');
//        }
//
//        if( (int)$this->fileSource === self::FILE_SOURCE_SET ){
//            $fileSetObj = FileSet::getByID((int)$this->fileSetID);
//            if( is_object($fileSetObj) ){
//                $this->_fileListObj->filterBySet($fileSetObj);
//            }
//        }
//    }
//
//
//    /**
//     * Get a list of available file sets.
//     * @return Array
//     */
//    protected function availableFileSets(){
//        if( $this->_availableFileSets === null ){
//            $fileSetListObj = new \Concrete\Core\File\Set\SetList;
//            $fileSetListObj->filterByType(\Concrete\Core\File\Set\Set::TYPE_PUBLIC);
//            $fileSets = $fileSetListObj->get();
//
//            $this->_availableFileSets = array();
//            foreach($fileSets AS $fileSetObj){ /** @var $fileSetObj \Concrete\Core\File\Set\Set */
//                $this->_availableFileSets[$fileSetObj->getFileSetID()] = $fileSetObj->getFileSetName();
//            }
//        }
//        return $this->_availableFileSets;
//    }
}