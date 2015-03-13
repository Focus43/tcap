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