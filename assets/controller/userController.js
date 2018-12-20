app.controller('HBuserCtrl', ['$scope', '$state', '$timeout', '$http', '$rootScope', '$q', '$mdToast', '$cookies', '$log', 'baseFactory', function($scope, $state, $timeout, $http, $rootScope, $q, $mdToast, $cookies, $log, baseFactory)
{
    if($cookies.get('user_id')==undefined || $cookies.get('user_id')=="")
    {
        $state.go('login');
    }

    if($state.is("home.hbuser_home"))
    {
        //$scope.loadHospitals();
    }
    else if($state.is("home.hbuser_generate_call"))
    {
        $scope.getDevices();
    }
    else if($state.is("home.hbhod__training_feedback"))
    {
        $scope.loadTraingFeedbackdata();
    }
}]);