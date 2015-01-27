<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<style type="text/css">
    #accordionForm .node {position:relative;padding:16px;margin-bottom:8px;background:#e1e1e1;margin-bottom:5px;}
    #accordionForm .node input[type="text"]{height:auto;padding:8px;font-size:14px;width:100%;margin-bottom:8px;}
    #accordionForm .node textarea {width:100%;}
    #accordionForm .node [remove] {height:auto;padding:8px;margin-top:8px;font-size:14px;width:100%;}
</style>

<div id="accordionForm" class="ccm-ui">
    <div class="accordion-nodes">
        <?php foreach($dataFields AS $pair): ?>
            <div class="node">
                <input type="text" name="heading[]" placeholder="Section Name" value="<?php echo $pair->heading; ?>" />
                <textarea name="body[]" class="custom-editor"><?php echo $textHelper->specialchars($contentHelper->translateFromEditMode($pair->body)); ?></textarea>
                <button remove class="btn btn-danger btn-block">Remove</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button add type="button" class="btn btn-large btn-block">Add Section</button>

    <!-- clonable element -->
    <div style="display:none;" clonable>
        <div class="node">
            <input type="text" name="heading[]" placeholder="Section Name" />
            <textarea name="body[]"></textarea>
            <button remove type="button" class="btn btn-danger btn-block">Remove</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    function _initEditors(){
        tinymce.init({
            mode:'specific_textareas',
            editor_selector:'custom-editor',
            theme:'simple',
            width:'100%',
            height:150,
            content_css:'<?php echo $contentCSSPath; ?>'
        });
    }

    $('[add]', '#accordionForm').on('click', function(){
        var $clone = $('.node', '[clonable]').clone();
        $('textarea', $clone).addClass('custom-editor');
        $('.accordion-nodes', '#accordionForm').append($clone);
        _initEditors();
    });

    $('[remove]', '#accordionForm').on('click', function(){
        $(this).parent('.node').remove();
    });

    _initEditors();
</script>