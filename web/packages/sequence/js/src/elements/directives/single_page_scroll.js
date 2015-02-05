/* global Power2 */
angular.module('sequence.elements').

    directive('singlePageScroll', ['$window', 'Tween',
        function( $window, Tween ){

            function _link( scope, $element, attrs ){
                angular.element($element[0].querySelectorAll('[href*="#"]')).on('click', function(_ev){
                    _ev.preventDefault();
                    var navTo = document.querySelector(this.getAttribute('href'));
                    if( navTo ){
                        Tween.to($window, 0.65, {
                            scrollTo: {y:navTo.offsetTop},
                            ease: Power2.easeOut
                        });
                    }
                });
            }

            return {
                restrict: 'A',
                link: _link,
                scope: false
            };
        }
    ]);