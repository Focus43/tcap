<?php $formInstanceID = 'sl-' . rand(0,1000000); ?>

<style type="text/css">
    .sortable-list-form {}
    .sortable-list-form .list-items .sl-item {padding:5px 0;position:relative;}
    .sortable-list-form .list-items .sl-item input {width:100%;padding-left:1.25rem;padding-right:1.25rem;}
    .sortable-list-form .list-items .sl-item span {display:inline-block;padding:0 8px;position:absolute;top:50%;z-index:2;margin-top:-10px;}
    .sortable-list-form .list-items .sl-item [sl-sort] {left:0;}
    .sortable-list-form .list-items .sl-item [sl-remove] {right:0;}
</style>

<div id="<?php echo $formInstanceID; ?>" class="sortable-list-form">
    <div class="list-items">
        <!-- values -->
        <?php if(!empty($listData)): foreach($listData AS $item): ?>
            <div class="sl-item">
                <span sl-sort><i class="fa fa-arrows-v"></i></span>
                <input type="text" value="<?php echo $item; ?>" name="<?php echo $this->field('list_values'); ?>[]" />
                <span sl-remove><i class="fa fa-minus-circle"></i></span>
            </div>
        <?php endforeach; endif; ?>
    </div>
    <button sl-add type="button" class="btn btn-sm"><i class="fa fa-plus-circle"></i></button>

    <!-- cloneable -->
    <div style="display:none;">
        <div class="sl-item cloneable" data-name="<?php echo $this->field('list_values'); ?>[]">
            <span sl-sort><i class="fa fa-arrows-v"></i></span>
            <input type="text" />
            <span sl-remove><i class="fa fa-minus-circle"></i></span>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        var $form   = $('#<?php echo $formInstanceID; ?>'),
            $list   = $('.list-items', $form),
            $btnAdd = $('[sl-add]', $form);

        $btnAdd.on('click', function(){
            var $cloned = $('.sl-item.cloneable').clone();
            $cloned.removeClass('cloneable');
            $('input', $cloned).attr('name', $cloned.attr('data-name'));
            $list.append( $cloned );
        });

        $form.on('click', '[sl-remove]', function(){
            $(this).parent().remove();
        });

        $list.sortable({
            handle: '[sl-sort]',
            containment: 'parent'
        });
    });
</script>