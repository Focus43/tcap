/* global Power2 */
angular.module('sequence.elements').

    directive('scrollTop', ['$window', 'Tween',
        function( $window, Tween ){

            function _link( scope, $elem, attrs ){
                var _lastState = ($window.pageYOffset > 0);
                $elem.toggleClass('visible', _lastState);

                // Watch scroll position on the page to determine if visible
                Tween.ticker.addEventListener('tick', function(){
                    if( !_lastState && ($window.pageYOffset > 0) ){
                        _lastState = true;
                        $elem.toggleClass('visible', _lastState);
                        return;
                    }

                    if( _lastState && ($window.pageYOffset === 0) ){
                        _lastState = false;
                        $elem.toggleClass('visible', _lastState);
                    }
                });

                $elem.on('click', function(){
                    Tween.to($window, 1, {
                        scrollTo: {y:0},
                        ease: Power2.easeOut
                    });
                });
            }

            return {
                restrict: 'A',
                scope: false,
                link: _link
            };
        }
    ]);