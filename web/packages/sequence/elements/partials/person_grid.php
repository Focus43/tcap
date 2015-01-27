<?php $userInfoObj; /** @var $userInfoObj UserInfo */
$userID         = $userInfoObj->getUserID();
$photoObj       = $userInfoObj->getAttribute(\Concrete\Package\Sequence\Controller::USER_ATTR_PHOTO);
$fullName       = sprintf('%s %s', $userInfoObj->getAttribute(\Concrete\Package\Sequence\Controller::USER_ATTR_FIRST_NAME), $userInfoObj->getAttribute(\Concrete\Package\Sequence\Controller::USER_ATTR_LAST_NAME));
$title          = $userInfoObj->getAttribute(\Concrete\Package\Sequence\Controller::USER_ATTR_TITLE);
$groupListObj   = new GroupList();
$groupListObj->filterByUserID($userID);
$groupList      = $groupListObj->get();
$groups         = array();
$textHelper     = Loader::helper('text'); /** @var $textHelper TextHelper */
foreach((array)$groupList AS $groupObj){ /** @var $groupObj Group */
    array_push($groups, $textHelper->handle($groupObj->getGroupName()));
}
?>
<a class="isotope-node" modalize="<?php echo URL::route(array('/modal_info', 'sequence'), $userID); ?>" <?php echo join(' ', $groups); ?>>
    <div class="isotope-box" style="background-image:url('<?php echo ($photoObj instanceof File) ? $photoObj->getRelativePath() : ''; ?>');">
        <div class="isotope-content">
            <h5><?php echo $fullName; ?></h5>
            <p><?php echo $title; ?></p>
        </div>
    </div>
</a>