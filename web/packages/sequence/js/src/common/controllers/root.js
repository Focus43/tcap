/* global ConcreteEvent */
angular.module('sequence.common').

    /**
     * @description Generic body controller
     * @param $rootScope
     * @param $scope
     * @param $location
     */
    controller('CtrlRoot', ['$rootScope', 'Modernizr', 'FastClick', '$compile',
        function( $rootScope, Modernizr, FastClick, $compile ){
            // Initialize FastClick
            FastClick.attach(document.body);

            $rootScope.rootClasses = {
                'sidebar-nav': false
            };


            if( typeof(ConcreteEvent) !== 'undefined' ){
                // Recompile the whole page to make sure directives are run!
                ConcreteEvent.subscribe('EditModeUpdateBlockComplete', function(a,b,c){
                    $compile(document.body)($rootScope);
                });
            }
        }
    ]);