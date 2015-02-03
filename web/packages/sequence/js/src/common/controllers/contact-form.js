angular.module('sequence.common').

    controller('CtrlContactForm', ['$scope', '$http',
        function( $scope, $http ){

            $scope.forceDisable = false;

            $scope.submitHandler = function(event){
                event.preventDefault();

                var $btnSubmit = angular.element(event.target.querySelector('button[type="submit"]'));
                $btnSubmit.empty().text('Sending...');

                $http.post(event.target.getAttribute('action'), $scope.form_data).
                    success(function(data,status,headers,config){
                        $btnSubmit.empty().text('Sent! We will be in touch.');
                        $scope.forceDisable = true;
                    }).
                    error(function(data,status,headers,config){

                    });
            };

            $scope.isDisabled = function(){
                if( $scope.forceDisable === true ){
                    return true;
                }
                return $scope.contactForm.$invalid;
            };

        }
    ]);