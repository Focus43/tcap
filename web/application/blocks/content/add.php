<?
defined('C5_EXECUTE') or die("Access Denied.");
$fp = FilePermissions::getGlobal();
$tp = new TaskPermission();

?>

<div id="redactor-edit-content"></div>
<textarea style="display: none" id="redactor-content" name="content"></textarea>

<script type="text/javascript">

var CCM_EDITOR_SECURITY_TOKEN = "<?=Loader::helper('validation/token')->generate('editor')?>";

$(function() {
    // Custom plugin
    RedactorPlugins.singlepagenav = {
        init: function(){
            var pageWrapper = document.querySelector('.ccm-page'),
                elements    = pageWrapper.querySelectorAll('[id]'),
                fragment    = document.createDocumentFragment(),
                dropdown    = {};

            /**
             * Redactor handler for adding the link
             */
            function _handler(key, element, obj, and){
                this.exec('inserthtml', this.outerHtml($('<a href="#'+obj.linkID+'">'+this.getSelectionText()+'</a>')), false);
            }

            /**
             * Find all elements with IDs on the page
             */
            Array.prototype.slice.call(elements).forEach(function(el){
                var attrID = el.getAttribute('id');
                for(var i = 0, attrs = el.attributes, n = attrs.length; i < n; i++){
                    if( /data|dialog/.test(attrs[i].nodeName) || /ccm|redactor/.test(attrID) ){
                        return;
                    }
                }
                // Push to available dropdown list
                dropdown[attrID] = {
                    title: (attrID.charAt(0).toUpperCase() + attrID.slice(1)),
                    linkID: attrID,
                    callback: _handler
                };
            });

            var btn = this.buttonAddAfter('formatting', 'retweet', 'Internal Page Link', false, dropdown);
        }
    };

	$('#redactor-content').redactor({
        minHeight: '300',
        'concrete5': {
            filemanager: <?=$fp->canAccessFileManager()?>,
            sitemap: <?=$tp->canAccessSitemap()?>,
            lightbox: true
        },
		'plugins': [
            'fontcolor', 'concrete5inline', 'concrete5', 'underline', 'singlepagenav'
		]
	});
});
</script>