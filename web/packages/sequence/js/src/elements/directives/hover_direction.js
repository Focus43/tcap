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