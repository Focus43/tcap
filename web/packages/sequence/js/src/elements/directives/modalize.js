angular.module('sequence.elements').

    factory('ModalData', [function(){
        return {
            classes: {open:false},
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
            angular.element(document.querySelector('body')).append('<div modal-window ng-class="_data.classes"></div>');

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
                        if( angular.isArray(scope.extraClasses) ){
                            angular.forEach(scope.extraClasses, function( className ){
                                scope._data.classes[className] = true;
                            });
                        }
                    });
                });
            }

            return {
                restrict:   'A',
                scope:      {extraClasses: '=modalClasses'},
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
                    ModalData.src.url = null;
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
    directive('modalWindow', ['$rootScope',
        function( $rootScope ){

            /**
             * Link function with ModalData service bound to the scope
             * @param scope
             * @param $elem
             * @param attrs
             * @private
             */
            function _link( scope, $elem, attrs ){
                scope.$watch('_data.src.url', function( _url ){
                    if( _url ){
                        $rootScope.rootClasses['no-scroll'] = true;
                        scope._data.classes.open    = true;
                        scope._data.classes.loading = true;
                        return;
                    }
                    // reset the object here to clear other set classes
                    scope._data.classes = {open:false};
                    $rootScope.rootClasses['no-scroll'] = false;
                    //angular.element(document.querySelectorAll('.isotope-node')).removeClass('active');
                });
            }

            return {
                restrict:   'A',
                scope:      true,
                link:       _link,
                template:   '<div class="modal-inner" ng-include="_data.src.url"></div>',
                controller: ['$scope', 'ModalData', function( $scope, ModalData ){
                    $scope._data = ModalData;

                    $scope.$on('$includeContentLoaded', function(){
                        $scope._data.classes.loading = false;
                    });
                }]
            };
        }
    ]).

    directive('modalSwap', [function(){

        /**
         * Bind click event in the modal window that inspects the dom for the isotope-node element
         * that currently has the class active, get its siblings (implicitly limits to make sure
         * the next/prev only accounts for WITHIN this list), and activate the relevant one.
         * @param scope
         * @param $elem
         * @param attrs
         * @param Controller
         * @private
         */
        function _link( scope, $elem, attrs, Controller ){
            $elem.on('click', function(){
                var active          = document.querySelector('.isotope-node.active'),
                    siblings        = active.parentNode.children,
                    siblingCount    = siblings.length - 1,
                    activeIndex     = Array.prototype.slice.call(siblings).indexOf(active),
                    indexToActivate = $elem.hasClass('prev') ? ((activeIndex === 0) ? siblingCount : activeIndex - 1)
                        : ((activeIndex === siblingCount) ? 0 : activeIndex + 1);

                angular.element(active).removeClass('active');
                angular.element(siblings[indexToActivate]).addClass('active');

                scope.$apply(function(){
                    scope._data.src.url = siblings[indexToActivate].getAttribute('modalize');
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