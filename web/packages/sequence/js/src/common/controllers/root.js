/* global ConcreteEvent */
angular.module('sequence.common').

    /**
     * @description Generic body controller
     * @param $rootScope
     * @param $scope
     * @param $location
     */
    controller('CtrlRoot', ['$window', '$rootScope', '$scope', 'Modernizr', 'FastClick', '$compile', 'ApplicationPaths', 'ModalData',
        function( $window, $rootScope, $scope, Modernizr, FastClick, $compile, ApplicationPaths, ModalData ){
            // Initialize FastClick
            FastClick.attach(document.body);

            $rootScope.rootClasses = {
                'sidebar-nav': false
            };

            var _disclaimerSeen = false;

            function _showDisclaimer(){
                $scope._modal = ModalData;
                $scope._modal.src.url = ApplicationPaths.tools + '/disclaimer';
                $scope._modal.open = true;
                _disclaimerSeen = true;
            }

            function _onScroll(){
                if( ! _disclaimerSeen ){
                    $scope.$apply(_showDisclaimer);
                    return;
                }
                angular.element($window).off('scroll', _onScroll);
            }

            if( Modernizr.touch ){
                _showDisclaimer();
            }else{
                angular.element($window).on('scroll', _onScroll);
            }

            if( typeof(ConcreteEvent) !== 'undefined' ){
                // Recompile the whole page to make sure directives are run!
                ConcreteEvent.subscribe('EditModeUpdateBlockComplete', function(a,b,c){
                    $compile(document.body)($rootScope);
                });
            }
        }
    ]);