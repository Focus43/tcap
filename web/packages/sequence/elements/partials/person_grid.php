<?php
$fileObj; /** @var $fileObj \Concrete\Core\File\File */
$fileVersionObj = $fileObj->getApprovedVersion(); /** @var $fileVersionObj \Concrete\Core\File\Version */

$groups = array();
$levelsOptionsList = $fileVersionObj->getAttribute(\Concrete\Package\Sequence\Controller::FILE_ATTR_INVOLVEMENT_LEVEL);
if( is_object($levelsOptionsList) ){
    $levels = $levelsOptionsList->getOptions();
    foreach($levels AS $optionObj){
        array_push($groups, $textHelper->handle($optionObj->getSelectAttributeOptionValue()));
    }
}
?>

<a class="isotope-node" modalize="<?php echo URL::route(array('/modal_info', 'sequence'), $fileObj->getFileID()); ?>" <?php echo join(' ', $groups); ?>>
    <div class="isotope-box" style="background-image:url('<?php echo $fileObj->getRelativePath(); ?>');">
        <div class="isotope-content">
            <h5><?php echo $fileVersionObj->getTitle(); ?></h5>
            <p><?php echo $fileVersionObj->getDescription(); ?></p>
        </div>
    </div>
</a>