<style type="text/css">
    #singlePageNav ul li {padding:0.5rem 0;}
</style>

<div id="singlePageNav">
    <div class="row">
        <div class="col-sm-12">
            <p>This block scans your page for sections you can link/auto-scroll to.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12" available-sections>
            <ul class="list-unstyled">
                <!-- javascripted -->
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        var pageWrapper = document.querySelector('.ccm-page'),
            elements    = pageWrapper.querySelectorAll('[id]'),
            fragment    = document.createDocumentFragment(),
            linkable    = [],
            existing    = <?php echo !empty($existingAsJson) ? $existingAsJson : '[]'; ?>;

        Array.prototype.slice.call(elements).forEach(function(el){
            for(var i = 0, attrs = el.attributes, n = attrs.length; i < n; i++){
                if( attrs[i].nodeName.indexOf('data') !== -1 ){
                    return;
                }
            }
            linkable.push(el.getAttribute('id'));
        });

        linkable.forEach(function(value, idx){
            var li   = document.createElement('li'),
                name = (value.charAt(0).toUpperCase() + value.slice(1));

            var _match = existing.filter(function(el){
                return el.id === value;
            });

            if( _match.length >= 1 ){
                var obj = _match[0];
                li.innerHTML = '<input type="checkbox" checked="checked" name="item['+idx+']" value="'+obj.id+'" /> ' + name + ' <input type="text" name="label['+idx+']" placeholder="Display Name" value="'+obj.label+'" />';
            }else{
                li.innerHTML = '<input type="checkbox" name="item['+idx+']" value="'+value+'" /> ' + name + ' <input type="text" name="label['+idx+']" placeholder="Display Name" />';
            }


            fragment.appendChild(li);
        });

        document.querySelector('[available-sections] > ul').appendChild(fragment);
    });
</script>