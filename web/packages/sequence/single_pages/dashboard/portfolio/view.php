<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<style>
    .description {
        display: inline-block;
        width: 350px;
        height: 20px;
        overflow: hidden;
        cursor: pointer;
    }
    .description:hover { font-style: italic; }
    .description.open {
        height: auto;
    }
    /*.description.open:hover { font-weight: normal; }*/
    .description .ellipsis {
        white-space: nowrap;
        overflow: hidden;
        min-width: 0;
        text-overflow: ellipsis;
        -o-text-overflow: ellipsis;
        -ms-text-overflow: ellipsis;
    }
    @-moz-document url-prefix() {
        fieldset { display: table-cell; }
    }
</style>

<?php if ( $list && sizeof($list) > 0 ) : ?>
<div class="table-responsive">
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
                <td><?php $f = File::getByID((int)$item->getMainImageID()); if ($f) { echo $f->getListingThumbnailImage(); }?></td>
                <td><?php echo $item->getTitle(); ?></td>
                <td><?php echo $item->getClientName(); ?></td>
                <td><div class="description"><div class="ellipsis"><?php echo strip_tags($item->getDescription()); ?></div></div></td>
                <td>
                    <a href="/dashboard/portfolio/item/<?php echo $item->getID(); ?>" class="btn btn-info">Edit</a>
                </td>
            </tr>
        <?php  endforeach; ?>
    </table>
</div>
<?php  else: ?>
    There are no portfolio items.
<?php  endif; ?>

<div class="ccm-dashboard-header-buttons">
    <a class="btn btn-primary" href="<?php echo View::url('/dashboard/portfolio/item'); ?>"><?php echo t("Create Portfolio Item"); ?></a>
</div>

<script>
    $(".description").on('click', function(){

        if ( $(this).hasClass("open") ) {
            $(this).removeClass("open", {
                duration: 1000,
                complete: function () {
                    $(this).children("div").addClass("ellipsis");
                }
            })
        } else {
            $(this).children("div").removeClass("ellipsis");
            $(this).addClass("open", { duration: 1000 });
        }
    });
</script>