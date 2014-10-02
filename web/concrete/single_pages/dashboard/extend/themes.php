<?
defined('C5_EXECUTE') or die("Access Denied.");
if ($controller->getTask() == 'view_detail') { ?>


    <div class="ccm-marketplace-detail-theme-slideshow-wrapper">
    <div class="ccm-marketplace-detail-theme-slideshow">
        <?
        $screenshots = $item->getSlideshow();
        $detailShots = $item->getScreenshots();
        ?>
        <ul data-slideshow="marketplace-theme">
            <?php foreach($screenshots as $i => $image) {
                $detail = $detailShots[$i]; ?>
                <li><a href="<?=$detail->src?>"><img src="<?=$image->src?>" /></a></li>
            <? } ?>
        </ul>
    </div>
        <div class="ccm-marketplace-detail-theme-slideshow-nav">
            <nav>
                <li><a href="#" data-navigation="marketplace-slideshow-previous"><i class="fa fa-chevron-left"></i></a></li>
                <li><a href="#" data-navigation="marketplace-slideshow-next"><i class="fa fa-chevron-right"></i></a></li>
                <li><a href="#" data-launch="marketplace-slideshow-gallery"><i class="fa fa-image"></i></a></li>
            </nav>
        </div>
    </div>

    <script type="text/javascript">
    $(function () {
        $("ul[data-slideshow=marketplace-theme]").responsiveSlides({
            prevText: "",   // String: Text for the "previous" button
            nextText: "",
            nav: true
        });

        $('a[data-navigation=marketplace-slideshow-previous]').on('click', function(e) {
            e.preventDefault();
            $('.rslides_nav.prev').trigger('click');
        });

        $('a[data-navigation=marketplace-slideshow-next]').on('click', function(e) {
            e.preventDefault();
            $('.rslides_nav.next').trigger('click');
        });

        $('a[data-launch=marketplace-slideshow-gallery]').on('click', function(e) {
            e.preventDefault();
            $('ul[data-slideshow=marketplace-theme] li:first-child a').trigger('click');
        });

        $('ul[data-slideshow=marketplace-theme]').magnificPopup({
          delegate: 'a',
          type: 'image',
          closeOnContentClick: false,
          closeBtnInside: false,
          mainClass: 'mfp-zoom-in mfp-img-mobile',
          image: {
            verticalFit: true
          },
          gallery: {
            enabled: true
          },
          callbacks: {
              open: function() {
                $('.mfp-content').addClass('ccm-ui');
              }
          },
          zoom: {
            enabled: true,
            duration: 300,
            opener: function(element) {
              return element.find('img');
            }
          }

        });
    });
    </script>

<? } else if (count($items)) { ?>

    <? foreach($items as $mi) { ?>

        <div class="ccm-marketplace-list-item">
            <div class="ccm-marketplace-list-item-theme-thumbnail"><a href="<?=$this->action('view_detail', $mi->getMarketplaceItemID())?>"><?
                $thumb = $mi->getLargeThumbnail();
                printf('<img src="%s">', $thumb->src);
                ?></a></div>
            <div class="ccm-marketplace-list-item-theme-description">
                <h2><a href="<?=$this->action('view_detail', $mi->getMarketplaceItemID())?>"><?=$mi->getName()?></a></h2>
                    <p><?=$mi->getDescription()?></p>
            </div>
            <div class="ccm-marketplace-list-item-theme-price">
                    <?=$mi->getDisplayPrice()?>
            </div>
        </div>

    <? } ?>

    <?=$list->displayPagingV2()?>

<? } else { ?>
   <div class="ccm-marketplace-list-item">
   <div class="ccm-marketplace-list-item-theme-description">
    <p><?=t('No themes found.')?></p>
    </div>
    </div>
<? } ?>