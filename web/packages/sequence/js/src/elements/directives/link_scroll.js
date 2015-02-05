/* global Power2 */
angular.module('sequence.elements').

    directive('linkScroll', ['$window', 'Tween',
        function( $window, Tween ){

            function _link( scope, $element, attrs ){
                // Find the element
                var targetElement = document.querySelector('#' + attrs.linkScroll);
                // If it exists, bind click handler
                if( targetElement ){
                    $element.on('click', function(_ev){
                        _ev.preventDefault();
                        Tween.to($window, 0.65, {
                            scrollTo: {y:targetElement.offsetTop},
                            ease: Power2.easeOut
                        });
                    });
                }
            }

            return {
                restrict: 'A',
                link: _link,
                scope: false
            };
        }
    ]);