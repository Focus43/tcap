angular.module('sequence.elements').

    factory('ModalData', [function(){
        return {
            open: false,
            src: {
                url: null
            }
        };
    }]).

    /**
     * Elements that should trigger opening a modalWindow
     * @returns {{restrict: string, scope: boolean, link: Function, controller: Array}}
     */
    directive('modalize', [
        function(){

            // Will automatically initialize modalWindow directive
            angular.element(document.querySelector('body')).append('<div modal-window ng-class="{open:_data.open}"></div>');

            /**
             * Link function with ModalData service bound to the scope
             * @param scope
             * @param $elem
             * @param attrs
             * @private
             */
            function _link( scope, $elem, attrs ){
                $elem.on('click', function(){
                    scope.$apply(function(){
                        scope._data.src.url = attrs.modalize;
                    });
                });
            }

            return {
                restrict:   'A',
                scope:      true,
                link:       _link,
                controller: ['$scope', 'ModalData', function( $scope, ModalData ){
                    $scope._data = ModalData;
                }]
            };
        }
    ]).


    /**
     * Close the modal window
     */
    directive('closeModal', ['ModalData', function( ModalData ){

        function _link( scope, $elem, attrs ){
            $elem.on('click', function(){
                scope.$apply(function(){
                    ModalData.open = false;
                });
            });
        }

        return {
            restrict: 'A',
            scope: false,
            link: _link
        };
    }]).


    /**
     * Actual ModalWindow directive handler
     * @param Tween
     * @returns {{restrict: string, scope: boolean, link: Function, controller: Array}}
     */
    directive('modalWindow', [
        function(){

            /**
             * Link function with ModalData service bound to the scope
             * @param scope
             * @param $elem
             * @param attrs
             * @private
             */
            function _link( scope, $elem, attrs ){
                scope.$watch('_data.open', function( _val ){
                    angular.element(document.documentElement).toggleClass('no-scroll', scope._data.open);

                    if( ! _val ){
                        scope._data.src.url = null;
                        angular.element(document.querySelectorAll('.isotope-node')).removeClass('active');
                    }
                });
            }

            return {
                restrict:   'A',
                scope:      true,
                link:       _link,
                template:   '<span class="icn-close" close-modal></span><div class="modal-inner" ng-include="_data.src.url"></div>',
                controller: ['$scope', 'ModalData', function( $scope, ModalData ){
                    $scope._data = ModalData;

                    $scope.$on('$includeContentLoaded', function(){
                        $scope._data.open = true;
                    });
                }]
            };
        }
    ]).

    directive('modalReload', [function(){

        var gridNodes       = document.querySelectorAll('.isotope-node'),
            gridNodesLength = gridNodes.length - 1;

        function _link( scope, $elem, attrs, Controller ){
            $elem.on('click', function(){
                var indexActive = Array.prototype.slice.call(gridNodes).indexOf(document.querySelector('.isotope-node.active')),
                    _index;

                if( $elem.hasClass('prev') ){
                    _index = (indexActive === 0) ? gridNodesLength : indexActive - 1;
                }else{
                    _index = (indexActive === gridNodesLength) ? 0 : indexActive + 1;
                }

                angular.element(gridNodes).removeClass('active');
                angular.element(gridNodes[_index]).addClass('active');

                scope.$apply(function(){
                    scope._data.src.url = gridNodes[_index].getAttribute('modalize');
                });
            });
        }

        return {
            restrict: 'A',
            scope: true,
            link: _link,
            controller: ['$scope', 'ModalData', function( $scope, ModalData ){
                $scope._data = ModalData;
            }]
        };
    }]);