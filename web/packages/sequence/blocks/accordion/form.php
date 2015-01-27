<?php
$fp = FilePermissions::getGlobal();
$tp = new TaskPermission();
?>

<style type="text/css">
    #accordionForm .node {position:relative;padding:8px;margin-bottom:12px;background:#f1f1f1;}
    #accordionForm .node input[type="text"]{height:auto;padding:8px;font-size:14px;width:100%;margin-bottom:8px;}
    #accordionForm .node textarea {width:100%;}
    #accordionForm .node [remove] {height:auto;padding:8px;margin-top:8px;font-size:14px;width:100%;}
</style>

<div id="accordionForm">
    <div class="accordion-nodes">
        <?php foreach($dataFields AS $pair): ?>
            <div class="node">
                <input type="text" name="heading[]" placeholder="Section Name" value="<?php echo $pair->heading; ?>" />
                <textarea name="body[]" class="redactor-editor"><?php echo $this->controller->_translateFromEditMode($pair->body); ?></textarea>
                <button remove class="btn btn-danger btn-block">Remove</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button add type="button" class="btn btn-lg btn-block btn-default">Add Section</button>

    <!-- clonable element -->
    <div style="display:none;" clonable>
        <div class="node">
            <input type="text" name="heading[]" placeholder="Section Name" />
            <textarea name="body[]" class="redactor-editor"></textarea>
            <button remove type="button" class="btn btn-danger btn-block">Remove</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    var CCM_EDITOR_SECURITY_TOKEN = "<?php echo Loader::helper('validation/token')->generate('editor'); ?>";
    $(function() {
        function _initEditors(){
            $('.redactor-editor', '.accordion-nodes').redactor({
                minHeight: '125',
                'concrete5': {
                    filemanager: <?=$fp->canAccessFileManager()?>,
                    sitemap: <?=$tp->canAccessSitemap()?>,
                    lightbox: true
                },
                'plugins': [
                    'fontcolor', 'concrete5', 'underline'
                ]
            });
        }

        $('[add]', '#accordionForm').on('click', function(){
            var $clone = $('.node', '[clonable]').clone();
            $('.accordion-nodes', '#accordionForm').append($clone);
            _initEditors();
        });

        $('[remove]', '#accordionForm').on('click', function(){
            $(this).parent('.node').remove();
        });

        _initEditors();
    });
</script>