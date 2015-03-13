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