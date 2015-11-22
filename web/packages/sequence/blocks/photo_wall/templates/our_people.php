<?php
$textHelper = Loader::helper('text');
$ak = FileAttributeKey::getByHandle(Concrete\Package\Sequence\Controller::FILE_ATTR_INVOLVEMENT_LEVEL);
$ctrl = $ak->getController();
$opts = $ctrl->getOptions();
$userInvolvementLevels = array();
foreach($opts AS $optObj){ /** $optObj \Concrete\Attribute\Select\Option */
    array_push($userInvolvementLevels, $optObj->getSelectAttributeOptionValue());
}
?>

<div isotope>
    <ul class="text-center" isotope-filters>
        <?php
            foreach($userInvolvementLevels AS $levelString){
                echo '<li><a data-filter="['.$textHelper->handle($levelString).']">'.$levelString.'</a></li>' . "\n";
            }
        ?>
        <li><a data-filter="*">Show All</a></li>
    </ul>
    <div class="grid-wrapper">
        <div isotope-grid>
            <?php
                foreach((array)$fileListResults AS $fileObj){
                    Loader::packageElement('partials/person_grid', \Concrete\Package\Sequence\Controller::PACKAGE_HANDLE, array(
                        'fileObj'    => $fileObj,
                        'textHelper' => $textHelper
                    ));
                }
            ?>
        </div>
    </div>
</div>