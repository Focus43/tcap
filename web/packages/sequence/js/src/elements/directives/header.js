angular.module('sequence.elements').

    directive('header', ['$window', 'Tween',
        function( $window, Tween ){

            function _link( scope, $element, attrs, Controller ){
                angular.element(document.querySelector('nav')).on('click', function(){
                    Controller.toggleSidebarNav();
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