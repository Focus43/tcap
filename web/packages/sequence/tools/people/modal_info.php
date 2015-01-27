<?php $userInfoObj = UserInfo::getByID( (int)$_REQUEST['id'] ); /** @var $userInfoObj UserInfo */
$photoObj   = $userInfoObj->getAttribute(TitlecardPackage::USER_ATTR_SECONDARY_PHOTO);
$fullName   = sprintf('%s %s', $userInfoObj->getAttribute(TitlecardPackage::USER_ATTR_FIRST_NAME), $userInfoObj->getAttribute(TitlecardPackage::USER_ATTR_LAST_NAME));
$title      = $userInfoObj->getAttribute(TitlecardPackage::USER_ATTR_TITLE);
$descr      = $userInfoObj->getAttribute(TitlecardPackage::USER_ATTR_DESCRIPTION);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <img src="<?php echo ($photoObj instanceof File) ? $photoObj->getRelativePath() : ''; ?>" />
        </div>
        <div class="col-sm-8">
            <div class="gutter-pad anglified">
                <h3><?php echo $fullName; ?><br/><span class="text-orange"><?php echo $title; ?></span></h3>
                <?php echo $descr; ?>
            </div>
        </div>
    </div>
</div>

<a class="modal-nav prev icn-angle-left" modal-reload=""></a>
<a class="modal-nav next icn-angle-right" modal-reload=""></a>