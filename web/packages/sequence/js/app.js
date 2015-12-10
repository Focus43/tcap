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
                        images  : head.getAttribute('data-image-path'),
                        tools   : head.getAttribute('data-tools-path')
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

    controller('CtrlContactForm', ['$scope', '$http', '$timeout',
        function( $scope, $http, $timeout ){

            var $btnSubmit   = angular.element(document.querySelector('[name="contactForm"] button')),
                originalText = $btnSubmit.text();

            $scope.sent_message = false;
            $scope.has_errors   = false;
            $scope.EMAIL_REGEX  = /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/;

            $scope.submitHandler = function(event){
                event.preventDefault();
                if( $scope.contactForm.$invalid ){
                    $scope.has_errors = true;
                    return;
                }

                $scope.has_errors = false;
                $btnSubmit.empty().text('Sending...');
                $http.post(event.target.getAttribute('action'), $scope.form_data).
                    success(function(data,status,headers,config){
                        $btnSubmit.text(originalText);
                        $scope.sent_message = true;
                        $scope.form_data    = {};
                        $scope.contactForm.$setPristine();
                        $timeout(function(){
                            $scope.sent_message = false;
                        }, 3500);
                    });
            };
        }
    ]);
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
                $scope._modal.classes['disclaimer'] = true;
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

            var _noDisclaimer = document.documentElement.classList.contains('no-disclaimer');

            // If user is not logged in...
            if( ! document.querySelector('body').hasAttribute('can-admin') ){
                if( _noDisclaimer !== true ){
                    if( Modernizr.touch ){
                        _showDisclaimer();
                    }else{
                        angular.element($window).on('scroll', _onScroll);
                    }
                }

            // User is logged in, don't show disclaimer and setup helpers
            }else{
                // Mobile editing
                angular.element(document).on('keydown', function( event ){
                    if( event.ctrlKey && event.keyCode === 77 ){
                        angular.element('html').toggleClass('edit-mode-mobile');
                    }
                });

                // Directive re-compilation
                if( typeof(ConcreteEvent) !== 'undefined' ){
                    // Recompile the whole page to make sure directives are run!
                    ConcreteEvent.subscribe('EditModeUpdateBlockComplete', function(a,b,c){
                        $compile(document.body)($rootScope);
                    });
                }
            }
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
    }).

    /**
     * @description Moment provider
     * @param $window
     * @param $log
     * @returns moment | false
     */
    provider('moment', function(){
        this.$get = ['$window', '$log',
            function( $window, $log ){
                return $window['moment'] || ($log.warn('Moment unavailable!'), false);
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
angular.module('sequence.elements').

    directive('hoverDirection', ['$window', 'Tween', 'Modernizr',
        function( $window, Tween, Modernizr ){

            var _options = {
                speed :0.15,
//                hoverDelay : 0, // not used
                inverse : false
            };

            var _getDir = function( $el, coordinates ) {
                var w = $el.offsetWidth,
                    h = $el.offsetHeight,
                // calculate the x and y to get an angle to the center of the div from that x and y.
                // gets the x value relative to the center of the DIV and "normalize" it
                    x = ( coordinates.x - ($el.getBoundingClientRect().left + window.pageXOffset) - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
                    y = ( coordinates.y - ($el.getBoundingClientRect().top + window.pageYOffset)  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ),
                // the angle and the direction from where the mouse came in/went out clockwise (TRBL=0123);
                // first calculate the angle of the point, add 180 deg to get rid of the negative values divide by 90 to get the quadrant
                // add 3 and do a modulo by 4 to shift the quadrants to a proper clockwise TRBL (top/right/bottom/left) **/
                    direction = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 ) % 4;

                return direction;
            };

            var _getStyle = function( direction ) {

                var fromStyle, toStyle,
                    slideFromTop =    { 'left' : '0', 'top' : '-100%' },
                    slideFromBottom = { 'left' : '0', 'top' : '100%' },
                    slideFromLeft =   { 'left' : '-100%', 'top' : '0' },
                    slideFromRight =  { 'left' : '100%', 'top' : '0' },
                    slideTop =        { 'top'  : '0' },
                    slideLeft =       { 'left' : '0' };

                switch( direction ) {
                    case 0:
                        // from top
                        fromStyle = ! _options.inverse ? slideFromTop : slideFromBottom;
                        toStyle = slideTop;
                        break;
                    case 1:
                        // from right
                        fromStyle = ! _options.inverse ? slideFromRight : slideFromLeft;
                        toStyle = slideLeft;
                        break;
                    case 2:
                        // from bottom
                        fromStyle = ! _options.inverse ? slideFromBottom : slideFromTop;
                        toStyle = slideTop;
                        break;
                    case 3:
                        // from left
                        fromStyle = ! _options.inverse ? slideFromLeft : slideFromRight;
                        toStyle = slideLeft;
                        break;
                }
                return { from : fromStyle, to : toStyle };
            };

            var _applyAnimation = function( el, styleCSS, speed ) {
                Tween.to(el, speed, styleCSS);
            };

            var _loadEvents = function( $elm, hoverElm ) {
                var _this = angular.element($elm);
                _options["hoverElem"] = hoverElm;
                _this.on( 'mouseenter mouseleave', function( event ) {

                    var $hoverElem = angular.element(_this[0].querySelector( "." + _options.hoverElem )),
                        direction = _getDir( $elm[0], { x : event.pageX, y : event.pageY } ),
                        styleCSS = _getStyle( direction );

                    if( event.type === 'mouseover' ) {
                        $hoverElem.css( styleCSS.from );
                        $hoverElem.css("display", "block");
                        _applyAnimation( $hoverElem, styleCSS.to, _options.speed );
                    } else {
                        _applyAnimation( $hoverElem, styleCSS.from, _options.speed );
                    }
                } );
            };

            function _link( scope, $elem, attrs ) {
                if( Modernizr.touch ){
                    return;
                }
                var _hoverElem = attrs.hoverDirection;
                _loadEvents($elem, _hoverElem);
            }

            return {
                restrict: 'A',
                scope: false,
                link: _link
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
                restrict: 'A',
                link:     _link
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

                // @todo: THIS IS SUPER GHETTO, and only in place to as the container
                // @todo: parent class can't be worked around yet
                (function upOne( _el ){
                    if( !_el.classList.contains('container') ){
                        upOne(_el.parentElement);
                        return;
                    }
                    _el.style.width = '100%';
                    _el.style.padding = 0;
                })( element );

                // Initialize Isotope instance
                scope.isotopeInstance = new Isotope(container, {
                    itemSelector: '.isotope-node',
                    layoutMode: attrs.isotope || 'masonry',
                    // Banner wants the first two categories "Influencers"
                    // and "Investment Team" to be visible by default, and
                    // since we don't support a way to dynamically choose
                    // the defaults (originally it was just "Show All"),
                    // we use a default-filters attribute on the directive DOM
                    // node (so its hardcoded on the block view template, or
                    // anywhere this directive is used)
                    filter: attrs.defaultFilters ? attrs.defaultFilters : null
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

                // Click to activate
                angular.element(gridNodes).on('click', function(){
                    angular.element(gridNodes).removeClass('active');
                    angular.element(this).addClass('active');
                });
            }

            return {
                restrict:   'A',
                scope:      true,
                link:       _link
            };
        }
    ]);
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
/* global Linear */
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
                    _transitionSpeed    = +(attrs.transitionSpeed || 0.75),
                    _progressBar        = null;

                function _render( _index ){
                    var indexNext       = _index,
                        currentNode     = nodes[indexActive],
                        currentNodeKids = currentNode.querySelector('.node-content').children,
                        nextNode        = nodes[indexNext],
                        nextNodeKids    = nextNode.querySelector('.node-content').children;

                    if ( attrs.progressIndicator ) {
                        var _progressBar = element.querySelectorAll('.' + attrs.progressIndicator);
                        Tween.killTweensOf(_progressBar);
                        angular.element(_progressBar).css('width', '0');
                        Tween.to(_progressBar, _loopTiming, { css:{'width':'100%'}, ease:Linear.easeNone });
                    }
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

                if ( attrs.progressIndicator ) {
                    _progressBar = element.querySelectorAll('.' + attrs.progressIndicator);
                    Tween.to(_progressBar, _loopTiming, { css:{'width':'100%'}, ease:Linear.easeNone });
                }

                if( _loopTiming > 0 ){
                    (function _loop( _delay ){
                        setTimeout(function(){
                            _next();
                            _loop(_delay);
                        }, (_loopTiming * 1000));
                        if ( attrs.progressIndicator ) { Tween.to(_progressBar, _loopTiming, { css:{'width':'100%'}, ease:Linear.easeNone }); }
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
                        Tween.fromTo(element, 0.5, {height:element.clientHeight}, {height:_height()});
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
/**
 * Created by superrunt on 2/23/15.
 */
angular.module('sequence.elements').
    filter("timeAgo", [ "moment", function (moment) {
        return function (datetime) {
            return moment(datetime).fromNow();
        };
    }]).
    directive("showTwitterFeed", [ "$http", "$interval", "$timeout", function($http, $interval, $timeout) {
        return {
            restrict : "A",
            link : function(scope, element, attrs) {

                var _errorMsg = angular.element( document.querySelectorAll("ul.errors") );
                var _twContainer = angular.element( document.querySelectorAll(".twitter div.container") );
//                _errorMsg.hide();
                _errorMsg[0].style.display = 'none';
                var _waitForIt = angular.element("<div class='waitForIt'><i class='fa fa-circle-o-notch fa-spin fa-5x'></i></div>");
                element.append(_waitForIt);

                scope.moving = false;
                scope.tweetWatcher = null;
                scope.$watch('tweetWatcher', function(newData, oldData) {
                    if (newData && newData !== oldData) {
                        scope.tweets = newData;
                    }
                });


                var getTweets = function () {
                    $http.get(attrs['showTwitterFeed']).
                        success(function(data, status) {
                            if ( !data.errors ) {
                                //console.log(data);
//                                _waitForIt.hide();
//                                _errorMsg.hide();
//                                _twContainer.show();
                                _waitForIt[0].style.display = 'none';
                                _errorMsg[0].style.display = 'none';
                                _twContainer[0].style.display = 'block';
                                scope.tweetWatcher = data;
                            } else {
                                scope.errors = data.errors;
//                                _twContainer.hide();
//                                _waitForIt.show();
//                                _errorMsg.show();
                                _waitForIt[0].style.display = 'block';
                                _errorMsg[0].style.display = 'block';
                                _twContainer[0].style.display = 'none';
                            }
                        }).
                        error(function(data, status) {
                            console.log("ERROR");
                            console.log(data);
                            console.log(status);
                        });
                };

                var reListTweets = function () {
                    if ( scope.moving ){
                        scope.tweets.push(scope.tweets.shift());
                    }
                    scope.moving = !scope.moving;
                };

                // get first data set, then look every 120 secs after that
                getTweets();
                $interval(getTweets, 120000);
                // rotate tweets
                $interval(reListTweets, 2000);
//                $interval(function () {
//                    $timeout(reListTweets, 2000)
//                }, 4000);
            }
        };
    }]);