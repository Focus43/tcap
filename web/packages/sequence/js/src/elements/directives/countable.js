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