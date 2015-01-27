<?php $userInfoObj; /** @var $userInfoObj UserInfo */
$userID         = $userInfoObj->getUserID();
$photoObj       = $userInfoObj->getAttribute(TitlecardPackage::USER_ATTR_PHOTO);
$fullName       = sprintf('%s %s', $userInfoObj->getAttribute(TitlecardPackage::USER_ATTR_FIRST_NAME), $userInfoObj->getAttribute(TitlecardPackage::USER_ATTR_LAST_NAME));
$title          = $userInfoObj->getAttribute(TitlecardPackage::USER_ATTR_TITLE);
$groupListObj   = new GroupList($userInfoObj, true);
$groupList      = $groupListObj->getGroupList();
$groups         = array();
$textHelper     = Loader::helper('text'); /** @var $textHelper TextHelper */
foreach($groupList AS $groupObj){ /** @var $groupObj Group */
    array_push($groups, $textHelper->handle($groupObj->getGroupName()));
}
?>
<a class="isotope-node" modalize="<?php echo TitlecardPackage::ToolPath('people/modal_info?id=%s', array($userID)); ?>" <?php echo join(' ', $groups); ?>>
    <div class="isotope-box" style="background-image:url('<?php echo ($photoObj instanceof File) ? $photoObj->getRelativePath() : ''; ?>');">
        <div class="isotope-content">
            <h5><?php echo $fullName; ?></h5>
            <p><?php echo $title; ?></p>
        </div>
    </div>
</a>