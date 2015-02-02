/* global FastClick */
;(function( window, angular, undefined ){ 'use strict';

    angular.module('sequence', [
            'sequence.common',
            'sequence.elements'
        ]).

        /**
         * @description App configuration
         * @param $provide
         * @param $locationProvider
         */
        config(['$provide', '$locationProvider',
            function( $provide ){

                // Applications paths
                (function( head ){
                    $provide.value('ApplicationPaths', {
                        images  : head.getAttribute('data-image-path')
                    });
                })( document.querySelector('head') );

                // Provide the breakpoints from Bootstrap as values
                $provide.value('Breakpoints', {
                    xs: 480,
                    sm: 768,
                    md: 992,
                    lg: 1200
                });
            }
        ]);

})(window, window.angular);
angular.module('sequence.common', []);
angular.module('sequence.elements', []);
angular.module('sequence.common').

    /**
     * @description Generic body controller
     * @param $rootScope
     * @param $scope
     * @param $location
     */
    controller('CtrlRoot', ['$rootScope', 'Modernizr', 'FastClick',
        function( $rootScope, Modernizr, FastClick ){
            // Initialize FastClick
            FastClick.attach(document.body);

            $rootScope.rootClasses = {
                'sidebar-nav': false
            };
        }
    ]);
/* global Modernizr */
/* global FastClick */
angular.module('sequence.common').

    /**
     * @description Modernizr provider
     * @param $window
     * @param $log
     * @returns Modernizr | false
     */
    provider('Modernizr', function(){
        this.$get = ['$window', '$log',
            function( $window, $log ){
                return $window['Modernizr'] || ($log.warn('Modernizr unavailable!'), false);
            }
        ];
    }).

    /**
     * @description TweenLite OR TweenMax provider
     * @param $window
     * @param $log
     * @returns TweenMax | TweenLite | false
     */
    provider('Tween', function(){
        this.$get = ['$window', '$log',
            function( $window, $log ){
                return $window['TweenMax'] || $window['TweenLite'] || ($log.warn('Tween library unavailable!'), false);
            }
        ];
    }).

    /**
     * @description Isotope provider
     * @param $window
     * @param $log
     * @returns Isotope | false
     */
    provider('Isotope', function(){
        this.$get = ['$window', '$log',
            function( $window, $log ){
                return $window['Isotope'] || ($log.warn('Isotope unavailable!'), false);
            }
        ];
    }).

    /**
     * @description FastClick provider
     * @param $window
     * @param $log
     * @returns FastClick | false
     */
    provider('FastClick', function(){
        this.$get = ['$window', '$log',
            function( $window, $log ){
                return $window['FastClick'] || ($log.warn('FastClick unavailable!'), false);
            }
        ];
    });
angular.module('sequence.elements').

    directive('accordion', ['Tween',
        function( Tween ){

            function _link( scope, $element, attrs ){
                var _groups = $element[0].querySelectorAll('.group'),
                    _bodies = $element[0].querySelectorAll('.accordion-body'),
                    _speed  = +(attrs.speed);

                angular.element(_groups).on('click', function(){
                    if( angular.element(this).hasClass('active') ){
                        Tween.to(_bodies, _speed, {height:0});
                        angular.element(_groups).removeClass('active');
                        return;
                    }

                    Tween.to(_bodies, _speed, {height:0});
                    Tween.to(this.querySelector('.accordion-body'), _speed, {
                        height:this.querySelector('.accordion-content').clientHeight
                    });
                    angular.element(_groups).removeClass('active');
                    angular.element(this).addClass('active');
                });
            }

            return {
                restrict: 'A',
                link:     _link
            };
        }
    ]);
angular.module('sequence.elements').

    directive('incrementable', ['Tween',
        function( Tween ){

            var _completedCount     = 0,
                _lastScroll         = window.pageYOffset,
                _bodyBoundingRect   = document.body.getBoundingClientRect(),
                _toleranceDefault   = 50,
                _durationDefault    = 1.5,
                _trackers           = {},
                _positions;


            /**
             * Register an element for tracking (finds its' position and adds it to
             * the cache)
             * @param $element
             * @private
             */
            function _register( $element ){
                var elemBoundRect   = $element[0].getBoundingClientRect(),
                    realYPosition   = Math.round(elemBoundRect.top - _bodyBoundingRect.top),
                    positionY       = realYPosition + ($element._tolerance || 0);
                // If tracker cache hasn't been created yet...
                if( ! _trackers[positionY] ){
                    _trackers[positionY] = {
                        complete: false,
                        nodes: []
                    };
                }
                // Push the element to the cache
                _trackers[positionY].nodes.push( $element );
                // Update positions cache
                _positions = Object.keys(_trackers);
            }


            /**
             * onUpdate callback for the Tweens
             * @param tween
             * @param val
             * @private
             */
            function _onUpdate(tween, val){
                this.text(Math.ceil(tween.target[val]));
            }


            /**
             * Loops through the dom nodes to trigger the animations.
             * @param positionY
             * @private
             */
            function _run( positionY ){
                for( var i = 0, len = _trackers[positionY].nodes.length; i < len; i++ ){
                    Tween.to({val:0}, _trackers[positionY].nodes[i]._duration, {
                        val:            +(_trackers[positionY].nodes[i].text()),
                        onUpdate:       _onUpdate,
                        onUpdateScope:  _trackers[positionY].nodes[i],
                        onUpdateParams: ["{self}", 'val']
                    });
                }
            }


            /**
             * Monitor scroll progress, and only do something if the scroll position
             * changes. (Loops through the cached positions and compares with current
             * scroll location to see if Tween should be run or not). Uses GreenSock
             * 'tick' event for requestAnimationFrame or falls back to setTimeout.
             */
            function _scrollMonitor(){
                if( _lastScroll !== window.pageYOffset ){
                    _lastScroll = window.pageYOffset;
                    for( var i = 0, len = _positions.length; i < len; i++ ){
                        var positionY = +(_positions[i]),
                            inView    = (window.pageYOffset + document.documentElement.clientHeight) > positionY;
                        if( inView && (_trackers[positionY].complete === false) ){
                            // Increment the completed count
                            _completedCount++;
                            // Immediately mark as complete so won't run again
                            _trackers[positionY].complete = true;
                            // Now initialize the animation
                            _run(positionY);
                        }

                        // Watch the completed count, and if all are ran, unbind the ticker
                        if( _completedCount === len ){
                            Tween.ticker.removeEventListener('tick', _scrollMonitor);
                        }
                    }
                }
            }


            /**
             * Bind callback
             */
            Tween.ticker.addEventListener('tick', _scrollMonitor);


            /**
             * Link function for the directive; sends to the _register function
             * and keeps track of all elements in the singleton.
             * @param scope
             * @param $element
             * @param attrs
             * @private
             */
            function _link( scope, $element, attrs ){
                $element._tolerance = +(attrs.tolerance || _toleranceDefault);
                $element._duration  = +(attrs.duration || _durationDefault);
                _register($element);
            }


            return {
                restrict: 'C',
                link:     _link
            };
        }
    ]);
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
angular.module('sequence.elements').

    directive('isotope', ['Isotope',
        function( Isotope ){

            function _link(scope, $elem, attrs){
                var element     = $elem[0],
                    filters     = element.querySelectorAll('[isotope-filters] a[data-filter]'),
                    container   = element.querySelector('[isotope-grid]'),
                    gridNodes   = element.querySelectorAll('.isotope-node');

                // Initialize Isotope instance
                scope.isotopeInstance = new Isotope(container, {
                    itemSelector: '.isotope-node',
                    layoutMode: attrs.isotope || 'masonry'
                });

                // Filters
                angular.element(filters).on('click', function(){
                    angular.element(filters).removeClass('active');
                    angular.element(this).addClass('active');
                    var _filter = this.getAttribute('data-filter');
                    scope.isotopeInstance.arrange({
                        filter: _filter
                    });
                });

                angular.element(gridNodes).on('click', function(){
                    angular.element(gridNodes).removeClass('active');
                    angular.element(this).addClass('active');
                });
            }

            return {
                restrict:   'A',
                link:       _link
            };
        }
    ]);
angular.module('sequence.elements').

    directive('masthead', ['Tween',
        function( Tween ){

            function _link( scope, $elem, attrs ){
                var element             = $elem[0],
                    nodes               = element.querySelectorAll('.node'),
                    nodeCount           = nodes.length - 1, // -1, make it zero-based index
                    $markers            = angular.element(element.querySelectorAll('.markers a')),
                    indexActive         = 0,
                    _loopTiming         = +(attrs.loopTiming || 0),
                    _transitionSpeed    = +(attrs.transitionSpeed || 0.75);

                function _render( _index ){
                    var indexNext       = _index,
                        currentNode     = nodes[indexActive],
                        currentNodeKids = currentNode.querySelector('.node-content').children,
                        nextNode        = nodes[indexNext],
                        nextNodeKids    = nextNode.querySelector('.node-content').children;

                    // Current
                    Tween.to(currentNode, _transitionSpeed, {autoAlpha:0});
                    Tween.staggerTo(currentNodeKids, _transitionSpeed, {x:200,autoAlpha:0}, (_transitionSpeed/currentNodeKids.length));
                    // Next
                    Tween.staggerFromTo(nextNodeKids, _transitionSpeed, {x:-200,autoAlpha:0}, {x:0,autoAlpha:1}, (_transitionSpeed/nextNodeKids.length));
                    Tween.to(nextNode, _transitionSpeed, {autoAlpha:1});

                    indexActive = indexNext;
                    $markers.removeClass('active').eq(indexActive).addClass('active');
                }


                function _next(){
                    _render((indexActive === nodeCount) ? 0 : indexActive + 1);
                }


                function _prev(){
                    _render((indexActive === 0) ? nodeCount : indexActive - 1);
                }


                angular.element(element.querySelectorAll('.arrows')).on('click', function(){
                    if( angular.element(this).hasClass('icn-angle-left') ){
                        _prev();
                        return;
                    }
                    _next();
                });

                $markers.on('click', function(){
                    var index = Array.prototype.slice.call(element.querySelectorAll('.markers a')).indexOf(this);
                    _render(index);
                });

                if( _loopTiming > 0 ){
                    (function _loop( _delay ){
                        setTimeout(function(){
                            _next();
                            _loop(_delay);
                        }, (_loopTiming * 1000));
                    })( 3000 );
                }
            }

            return {
                restrict: 'A',
                link: _link
            };
        }
    ]);
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
                angular.element($elem[0].querySelector('.icn-close')).on('click', function(){
                    scope.$apply(function(){
                        scope._data.open = false;
                    });
                });

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
                template:   '<span class="icn-close"></span><div class="modal-inner" ng-include="_data.src.url"></div>',
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
angular.module('sequence.elements').

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