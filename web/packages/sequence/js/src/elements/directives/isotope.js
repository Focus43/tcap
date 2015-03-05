angular.module('sequence.elements').
//    .isotope-box {width:100%;height:100%;
//      &::before {content:'';visibility:hidden;opacity:0;display:block;background-color:rgba($theme-highlight-color,0.85);min-width:100%;min-height:100%;@include transition(all 0.25s ease);}
//      .isotope-content {visibility:hidden;opacity:0;position:absolute;bottom:15%;left:$node-spacing;right:$node-spacing;padding:1rem;@include transition(all 0.25s ease);
//        h5 {text-transform:uppercase;font-size:130%;margin:0;}
//        p {margin-bottom:0;font-size:90%;}
//      }
//}
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