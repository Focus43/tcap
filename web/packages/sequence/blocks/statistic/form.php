<?php
$fp = FilePermissions::getGlobal();
$tp = new TaskPermission();
?>

<style type="text/css">
    #statisticForm .node {position:relative;padding:8px;margin-bottom:12px;background:#f1f1f1;}
    #statisticForm .node input[type="text"]{height:auto;padding:8px;font-size:14px;width:100%;margin-bottom:8px;}
    #statisticForm .node textarea {width:100%;}
    #statisticForm .node [remove] {height:auto;padding:8px;margin-top:8px;font-size:14px;width:100%;}
</style>

<div id="statisticForm">
    <div class="row">
        <div class="form-group col-sm-3">
            <input name="statBefore" type="text" class="form-control" placeholder="Before" value="<?php echo $statBefore; ?>" />
        </div>
        <div class="form-group col-sm-6">
            <input name="statNumber" type="text" class="form-control" placeholder="NUMBER" value="<?php echo $statNumber; ?>" />
        </div>
        <div class="form-group col-sm-3">
            <input name="statAfter" type="text" class="form-control" placeholder="After" value="<?php echo $statAfter; ?>" />
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-12">
            <textarea name="statDetails" class="redactor-editor"><?php echo $this->controller->_translateFromEditMode($statDetails); ?></textarea>
        </div>
    </div>
</div>

<script type="text/javascript">
    var CCM_EDITOR_SECURITY_TOKEN = "<?php echo Loader::helper('validation/token')->generate('editor'); ?>";
    $(function() {
        $('.redactor-editor', '#statisticForm').redactor({
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
    });
</script>