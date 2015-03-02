<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<?php if ( $list && sizeof($list) > 0 ) : ?>
    <table class="table table-striped">
        <tr>
            <th><?=t('Main Image')?></th>
            <th><?=t('Title')?></th>
            <th><?=t('Client')?></th>
            <th><?=t('Description')?></th>
            <th></th>
        </tr>
        <?php foreach ($list as $item): /** @var $item Concrete\Package\Sequence\Src\PortfolioItem  */ ?>
            <tr>
                <td><?php $f = File::getByID((int)$item->getMainImageID()); echo $f->getListingThumbnailImage();?></td>
                <td><?php  echo $item->getTitle(); ?></td>
                <td><?php  echo $item->getClientName(); ?></td>
                <td><?php  echo $item->getDescription(); // TODO: Shorten and open full in modal?></td>
                <td>
                    <a href="/dashboard/portfolio/item/<?php echo $item->getID(); ?>" class="btn btn-info">Edit</a>
                    <a href="/dashboard/portfolio/item/delete/<?php echo $item->getID(); ?>" class="btn btn-info">Delete</a>
                </td>
            </tr>
        <?php  endforeach; ?>
    </table>
<?php  else: ?>
    There are no portfolio items.
<?php  endif; ?>

<div class="ccm-dashboard-header-buttons">
    <a class="btn btn-primary" href="<?php echo View::url('/dashboard/portfolio/item'); ?>"><?php echo t("Create Portfolio Item"); ?></a>
</div>