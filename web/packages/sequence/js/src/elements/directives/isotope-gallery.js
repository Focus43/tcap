angular.module('sequence.elements').

    directive('isotopeGallery', ['Isotope',
        function( Isotope ){

            function _link(scope, $elem, attrs){
                console.log($elem);
            }

            return {
                restrict:   'A',
                scope:      true,
                link:       _link
            };

        }
    ]);