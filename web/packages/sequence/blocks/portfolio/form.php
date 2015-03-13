<style type="text/css">
    #portfolioBlock img {margin:0;padding:0;}
    #portfolioBlock table thead th:last-child {width:99%;}
    #portfolioBlock table tr {cursor:move;}
    #portfolioBlock table th,
    #portfolioBlock table td {background:rgba(255,255,255,0.9);white-space:nowrap;padding:0.5rem;vertical-align:top;border-bottom:1px solid #e1e1e1;}
</style>

<div id="portfolioBlock">
    <p><strong>Note:</strong> If you're editing this block and portfolio items are not showing up, remove it from the page and re-add it from the sidebar.</p>
    <table class="table">
        <thead>
            <tr>
                <th>Include</th>
                <th>Main Img</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($portfolioList AS $portfolioItem): ?>
                <tr>
                    <td><?php echo $form->checkbox('items[]', $portfolioItem->getID(), in_array($portfolioItem->getID(), $chosenPortfolioItems)); ?></td>
                    <!--<td><input type="checkbox" name="items[]" value="<?php echo $portfolioItem->getID(); ?>" /></td>-->
                    <td><?php $f = File::getByID((int)$portfolioItem->getMainImageID()); if ($f) { echo $f->getListingThumbnailImage(); }?></td>
                    <td><?php echo $portfolioItem; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(function(){
        $('tbody', '#portfolioBlock').sortable({
            items: 'tr',
            cursor: 'move',
            containment: 'parent',
            tolerance: 'pointer',
            helper: function(e, ui){
                ui.children().each(function(){
                    $(this).width($(this).width());
                });
                return ui;
            }
        });
    });
</script>