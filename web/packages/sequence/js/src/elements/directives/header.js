/* global Power2 */
angular.module('sequence.elements').

    directive('header', ['$window', 'Tween',
        function( $window, Tween ){

            function _link( scope, $element, attrs, Controller ){
                angular.element(document.querySelector('nav')).on('click', function(){
                    Controller.toggleSidebarNav();
                });

                angular.element(document.querySelectorAll('header [href*="#"]')).on('click', function(_ev){
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
                restrict: 'E',
                link:     _link,
                controller: ['$rootScope',
                    function( $rootScope ){
                        this.toggleSidebarNav = function(){
                            $rootScope.$apply(function(){
                                $rootScope.rootClasses['sidebar-nav'] = !($rootScope.rootClasses['sidebar-nav']);
                            });
                        };
                    }
                ]
            };
        }
    ]);