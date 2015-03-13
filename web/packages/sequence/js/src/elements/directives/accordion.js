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