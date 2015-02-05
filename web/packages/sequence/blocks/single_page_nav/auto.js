function _singlePageNavHandler( opts ){

    var pageWrapper = document.querySelector('.ccm-page'),
        elements    = pageWrapper.querySelectorAll('[id]'),
        fragment    = document.createDocumentFragment(),
        linkable    = [],
        existing    = opts.existing;

    /**
     * Find all elements with IDs on the page
     */
    Array.prototype.slice.call(elements).forEach(function(el){
        for(var i = 0, attrs = el.attributes, n = attrs.length; i < n; i++){
            if( /data|dialog/.test(attrs[i].nodeName) ){
            return;
            }
        }
        linkable.push(el.getAttribute('id'));
    });

    /**
     * Generate the list; cross-checking for existing ones
     */
    linkable.forEach(function(value, idx){
        var li   = document.createElement('li'),
            name = (value.charAt(0).toUpperCase() + value.slice(1));

        var _match = existing.filter(function(el){
            return el.id === value;
        });

        if( _match.length >= 1 ){
            var obj = _match[0];
            li.innerHTML = '<input type="checkbox" checked="checked" name="item['+idx+']" value="'+obj.id+'" />&nbsp;&nbsp;<input type="text" name="label['+idx+']" placeholder="Display Name" value="'+obj.label+'" /> ' + name;
        }else{
            li.innerHTML = '<input type="checkbox" name="item['+idx+']" value="'+value+'" />&nbsp;&nbsp;<input type="text" name="label['+idx+']" placeholder="Display Name" /> ' + name;
        }

        fragment.appendChild(li);
    });

    opts.container.appendChild(fragment);

}