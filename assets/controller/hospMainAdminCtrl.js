app.controller('HMadminCtrl', ['$scope', '$state', '$timeout', '$http', '$rootScope', '$q', '$mdToast', '$cookies', '$log', 'baseFactory','$element','$mdDialog', function($scope, $state, $timeout, $http, $rootScope, $q, $mdToast, $cookies, $log, baseFactory,$element,$mdDialog)
{
    if($cookies.get('user_id')==undefined || $cookies.get('user_id')=="")
    {
        $state.go('login');
    }
    $element.find('input').on('keydown', function(ev)
    {
        ev.stopPropagation();
    });
    $rootScope.successdata = "success";
    $rootScope.failedata = "failed";
    $rootScope.emptydata = "empty";
    $rootScope.errordata = "error";
    $scope.selectbranch = '';
    $scope.userstatus = {};
    $scope.getBranchesDetails = function()
    {
        var data = {action:"get_branches_details"};
        baseFactory.UserCtrl(data)
        .then(function(payload)
        {
            $log.log(payload);
            if(payload.response==$rootScope.successdata)
            {
                $scope.branches_dtls = angular.fromJson(payload.branches);
				$scope.branch_labels = angular.fromJson(payload.labels);
            }
            else if(payload.response==$rootScope.emptydata)
            {
                $scope.branches_dtls = null;
				$scope.branch_labels = null;
            }
        },
        function(errorPayload)
        {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.addBranch = function(add_branch)
    {
        add_branch.action = "add_new_branch";
        $log.debug(add_branch);
        baseFactory.UserCtrl(add_branch)
        .then(function(payload)
        {
            $log.info(payload);
            if(payload.response==$rootScope.successdata)
            {
                $scope.showToastText(payload.call_back);
                $scope.getBranchesDetails();
                $state.go('home.hmadmin_branches');
            }
            else if(payload.response==$rootScope.failedata)
            {
                $scope.showToastText(payload.call_back);
            }
            else if(payload.response==$rootScope.exsitsdata)
            {
                $scope.showToastText(payload.call_back);
            }
        },
        function(errorPayload)
        {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.UpdateBranch = function(ubranch_data)
    {
        ubranch_data.action = "update_branch";
        $log.debug(ubranch_data);
        baseFactory.UserCtrl(ubranch_data)
        .then(function(payload)
        {
            $log.info(payload);
            if(payload.response==$rootScope.successdata)
            {
                $scope.showToastText(payload.call_back);
                $scope.getBranchesDetails();
                $scope.hide();
            }
            else if(payload.response==$rootScope.failedata)
            {
                $scope.showToastText(payload.call_back);
            }
        },
        function(errorPayload)
        {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.editBranch = function(ev,branch_data)
    {
        var template_name = 'user/edit_branch_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent : angular.element(document.body),
            targetEvent: ev,
            locals: {ebranch_data: branch_data},
            controller: _BranchCtrl
        }).then(function() {},
            function() {});
    };
    function _BranchCtrl($scope, ebranch_data)
    {
        $scope.loadCities();
        $scope.ebranch_data = "";
        $scope.ebranch_data=ebranch_data;
        $scope.ebranch_data.branch_name=$scope.ebranch_data.BRANCH_NAME;
        $scope.ebranch_data.branch_code=$scope.ebranch_data.BRANCH_CODE;
        $scope.ebranch_data.branch_address=$scope.ebranch_data.BRANCH_ADDRESS;
        $scope.ebranch_data.status=$scope.ebranch_data.STATUS;
        $scope.ebranch_data.city_name=$scope.ebranch_data.CITY;
        $log.warn($scope.ebranch_data);
    }


    if($state.is("home.hmadmin_all_calls"))
    {
        $scope.title = "Unit Wise Calls";
        $scope.getAllCallsCount();
        $scope.getUnitWiseSecCounts();
        $scope.loadBranches();
    }

    if($state.is("home.hmadmin_home") || $state.is("home.hmadmin_today_calls"))
    {
        $scope.title = "Total Calls";
        $scope.getAllCallsCount();
        $scope.toDayCalls();
        $scope.loadBranches();
        $scope.loadhospital();
    }
    else if($state.is("home.hmadmin_search"))
    {

    }
    else if($state.is("home.hmadmin_users"))
    {
     $scope.loadBranches();
     $scope.getOrgUsersLimit();
     $scope.getBranchUsers();
    }
    else if($state.is("home.hmadmin_add_user"))
    {
      $scope.getOrgRoles();
      $scope.loadBranches();
    }
    else if($state.is("home.hmadmin_branches"))
    {
      $scope.getBranchesDetails();      
	  $scope.getOrgBranchesLimit();
	  $scope.loadBranches();
		
    }
    else if($state.is("home.hmadmin_add_branch"))
    {
      $scope.loadCities();
	  $scope.getBranchesDetails();
    }
    else if($state.is("home.hmadmin_search"))
    {

    }
    else if($state.is("home.hmadmin_print_labels"))
    {
        $scope.loadBranches();
        $scope.loadAllDepartments();
        $scope.loadhospital();
    }
    else if($state.is("home.hmadmin_equipment_summary"))
    {
        $scope.loadBranches();
        $scope.equpDepts();
        $scope.getEqupUnitWise();
    }

    else if($state.is("home.hmadmin_today_calls"))
    {
        $scope.title = "Open Calls";
        $scope.loadBranches();
        $scope.myCallsAdmin($scope.admin_calls_select[0]);
    }
    else if($state.is("home.hmadmin_responded_calls"))
    {
        $scope.title = "Attended Calls";
        $scope.loadBranches();
        $scope.SearchRespondedCalls();
        $scope.loadDepartments();
    }
    else if($state.is("home.hmadmin_attended_calls"))
    {
        $scope.title = "Inprogress Calls";
        $scope.loadBranches();
        // $scope.SearchAttendedCalls();
        $scope.loadDepartments();
        $scope.SearchAttendedCalls();
}
    else if($state.is("home.hmadmin_propen_calls"))
    {
        $scope.title = "Obhold Calls";
        $scope.loadBranches();
        $scope.SearchProcessPendimgCalls();
        $scope.loadDepartments();
    }
    else if($state.is("home.hmadmin_completed_calls"))
    {
        $scope.title = "Completed Calls";
        $scope.loadBranches();
        //$scope.forAdminCompletedCalls();
        //$scope.loadDepartments();
    }
    else if($state.is("home.hmadmin_completed_qcs"))
    {
        $scope.title = "Completed QCS";
        $scope.loadBranches();
        $scope.loadDepartments();
    }
    else if($state.is("home.hmadmin_completed_pms"))
    {
        $scope.title = "Completed PMS";
        $scope.loadBranches();
        $scope.loadDepartments();
    }
    else if($state.is("home.hmadmin_pending_qcs"))
        {
        $scope.title = "Pending Calibration";
        $scope.loadBranches();
        $scope.loadDepartments();
    }
    else if($state.is("home.hmadmin_pending_pms"))
    {
        $scope.title = "Pending PMS";
        $scope.loadBranches();
        $scope.loadDepartments();
    }
  else if($state.is("home.hmadmin_cities"))
    {
       $scope.loadBranches();
	   $scope.loadCityList();
	   $scope.loadcitieslabels();
    }
    else if($state.is("home.hmadmin_add_city"))
    {
		$scope.loadBranches();
		$scope.loadCountry();
		$scope.loadcitieslabels();
    }	
	else if($state.is("home.add_org_roles")) 
	{       
       $scope.loadBranches();  
	   $scope.loadRoletypes();
	   $scope.LoadOrgFeatures();
	   $scope.loadrolelabels();
	   $scope.loadLevelsList();
    }
    else if($state.is("home.org_roles"))
    {
        $scope.loadBranches();
        $scope.getOrgRoles();
		$scope.loadrolelabels();
    }
}]);