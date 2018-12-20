app.controller('HBadminCtrl', ['$scope', '$state', '$timeout', '$http', '$rootScope', '$q', '$mdToast', '$cookies', '$log', 'baseFactory', function($scope, $state, $timeout, $http, $rootScope, $q, $mdToast, $cookies, $log, baseFactory)
{
	if($cookies.get('user_id')==undefined || $cookies.get('user_id')=="")
    {
        $state.go('login');
    }


    if($state.is("home.hbadmin_home"))
    {
    	//$scope.loadHospitals();
    }
    else if($state.is("home.hbadmin_search"))
    {
    	//$scope.loadVendors();
    }
}])