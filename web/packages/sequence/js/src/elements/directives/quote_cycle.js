angular.module('titlecard.elements').

    directive('quoteCycle', ['Tween',
        function( Tween ){

            function _link( scope, $elem, attrs ){
                var element     = $elem[0],
                    groups      = element.querySelectorAll('.group'),
                    groupsCount = groups.length - 1,
                    indexActive = 0,
                    timing      = +(attrs.quoteCycle || 5) * 1000;

                function _height(){
                    var height = 0;
                    angular.forEach(groups, function(el, index){
                        height = (el.clientHeight > height) ? el.clientHeight : height;
                    });
                    return height;
                }

                // Adjust the height of the parent before doing anything else
                Tween.fromTo(element, 0.5, {height:element.clientHeight}, {height:_height()});

                // Iterator
                (function _loop( _delay ){
                    setTimeout(function(){
                        var indexNext = (indexActive === groupsCount) ? 0 : indexActive + 1;
                        Tween.to(groups[indexActive], 0.5, {y:-100,autoAlpha:0});
                        Tween.fromTo(groups[indexNext], 0.5, {y:100,autoAlpha:0}, {y:0,autoAlpha:1, delay:0.5});
                        indexActive = indexNext;
                        _loop(_delay);
                    }, _delay);
                })( timing );
            }

            return {
                restrict: 'A',
                link: _link
            };
        }
    ]);