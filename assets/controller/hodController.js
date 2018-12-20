app.controller('HBhodCtrl', ['$scope', '$state', '$timeout', '$http', '$rootScope', '$q', '$mdToast', '$cookies', '$log', 'baseFactory', function($scope, $state, $timeout, $http, $rootScope, $q, $mdToast, $cookies, $log, baseFactory)
{
	if($cookies.get('user_id')==undefined || $cookies.get('user_id')=="")
    {
        $state.go('login');
    }
    $scope.uploadFile = function()
    {
        var file = $scope.myFile;

        //console.log('file is ');
        //console.dir(file);
        var uploadUrl = 'device/import_asset_list';
        baseFactory.uploadFileToUrl(file,uploadUrl)
        .then(function(payload)
        {
            $log.debug(payload);
            var ff = payload.device_response;
            var dicnts = 0;
            var dicntf = 0;
            var id=0;
            for(id=0;id<ff.length;id++)
            {
                if(payload.device_response[id]==$rootScope.successdata)
                {
                    dicnts++;
                }
                else if(payload.device_response[id]==$rootScope.failedata)
                {
                    dicntf++;
                }
            }
            if(dicntf==0)
            {
                var toast = dicnts+" Device(s) Details Saved Successfully.";
                $scope.showToastText(toast);
                $scope.dept_device_search={eqpid:"",dept_id:"",branch_id:$scope.user_branch,spono:"",saccessoriesno:""};
                $scope.getDepartDevices();
                $state.go("home.view_devies");
            }
            else
            {
                $scope.toast_text = dicnts+" Device(s) Details Saved, "+dicntf+" Device(s) Details Not Saved!";
                var toast = dicnts+" Device(s) Details Saved Successfully.";
                $scope.showToastText(toast);
                //$state.go("home.hbbme_search");
            }
        },
        function(errorPayload)
        {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.device_manuals = [];
    $scope.device_pos = [];
    $scope.device_othr_files = [];
    $scope.SaveDevice=function(input_data,action) /* Add device */
    {

        //return false;
        var files = [];
        files =  files.concat($scope.device_manuals);
        files =  files.concat($scope.device_othr_files);
        files =  files.concat($scope.device_pos);
        input_data.org_id = $scope.user_org;
        input_data.org_type = $scope.org_type;
        baseFactory.addDeviceFileUpload(input_data,files,'device/save_device')
        .then(function(payload)
        {
            console.log(payload);
            if(payload.device_response==$rootScope.successdata)
            {
                $scope.add_device = null;
                $scope.toast_text = payload.call_back;
                $scope.showToast();
                $scope.dept_device_search={eqpid:payload.device_id,dept_id:"",branch_id:$scope.user_branch,spono:"",saccessoriesno:""};
                $state.go('home.view_devies');
            }
            else
            {
                $scope.showToastText(payload.call_back);
            }
        },
        function(errorPayload)
        {
            $log.error('failure loading', errorPayload);
        });
    };


    $scope.savedevice  = function (add_device,action) {
       add_device.action =action;
        console.log(add_device);
        baseFactory.deviceCall(add_device,'device/save_device')
            .then(function (payload) {
                       console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $state.go("home.view_devies");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                       }
                    $log.debug(payload);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    if($state.is("home.hbhod_home"))
    {
        $scope.getAllCallsCount();
    	//$scope.loadHospitals();
    }
    else if($state.is("home.hbhod_search"))
    {
        //$scope.loadVendors();
    }
    else if($state.is("home.hbhod_import_asset"))
    {
        $scope.loadBranches();
    }
    else if($state.is("home.hbhod_add_asset"))
    {
        $scope.getSupportVendors();
        $scope.getEqupCategories();
        $scope.getDistributors();
        $scope.getEqupOEMS();
        $scope.getEqupTypes();
        $scope.loadDepartments();
        $scope.loadQcsDetails();
        $scope.loadStatus();
        $scope.loadEupConditions();
        $scope.loadEquipmentClass($scope.nostate);
        $scope.loadUtillization();
        $scope.loadPmsDetails();
        $scope.loadContracts();
        $scope.loadVendorList();
        $scope.getAccessories();
        $scope.getCriticalSpares();
        $scope.scopeadd_device();
    }
    else if($state.is("home.hbhod_print_labels"))
    {
        $scope.loadDepartments();
		$scope.loadBranches();
    }
    else if($state.is("home.hbhod_equipment_summary"))
    {
        $scope.equpDepts();
        $scope.getEqupUnitWise();
    }
    else if($state.is("home.hbhod_generate_call"))
    {
        //$scope.getDevices();
        $scope.loadCondmnReasonsList($scope.nostate);
        $scope.getCallMasters();
        $scope.loadDepartments();
        //$scope.getDeviceReasons();
        $scope.getDevicePriorities();
        $scope.loadIncidentType();
        //$scope.getDepartmentDevices();
        $scope.loadBranches();
    }
    else if($state.is("home.hbhod_today_calls"))
    {
        $scope.title="Today Calls";
        $scope.loadBranches();
        $scope.myCallsHod($scope.hod_calls_select[0]);
        //$scope.getAllCallsCount();
    }
    else if($state.is("home.hbhod_responded_calls"))
    {
        $scope.title="Assigned Calls";
        $scope.loadBranches();
        $scope.SearchRespondedCalls();
        //$scope.loadDepartments();		$scope.getHodBmes();
        if($scope.myall_hod_select!=undefined)
        {
            if($scope.myall_hod_select==$scope.hod_calls_select[0])
            {
                $scope.getAllCallsCount($scope.user_role_code,$scope.user_id);
            }
            else if($scope.myall_hod_select==$scope.hod_calls_select[1])
            {
                $scope.getAllCallsCount();
            }
        }
        else
        $scope.getAllCallsCount();
    }
    else if($state.is("home.hbhod_attended_calls"))
    {
        $scope.title="Inprogress Calls";
        $scope.loadBranches();
        $scope.SearchAttendedCalls();
        //$scope.loadDepartments();
        if($scope.myall_hod_select!=undefined)
        {
            if($scope.myall_hod_select==$scope.hod_calls_select[0])
            {
                $scope.getAllCallsCount($scope.user_role_code,$scope.user_id);
            }
            else if($scope.myall_hod_select==$scope.hod_calls_select[1])
            {
                $scope.getAllCallsCount();
            }
        }
        else
        $scope.getAllCallsCount();
    }
    else if($state.is("home.hbhod_propen_calls"))
    {
        $scope.title="Onhold Calls";
        $scope.loadBranches();
        $scope.SearchProcessPendimgCalls();
		//$scope.getAllCallsCount();
        //$scope.loadDepartments();
        if($scope.myall_hod_select!=undefined)
        {
            if($scope.myall_hod_select==$scope.hod_calls_select[0])
            {
                $scope.getAllCallsCount($scope.user_role_code,$scope.user_id);
            }
            else if($scope.myall_hod_select==$scope.hod_calls_select[1])
            {
                $scope.getAllCallsCount();
            }
        }
        else
        $scope.getAllCallsCount();
    }
    else if($state.is("home.hbhod_completed_calls"))
    {
        $scope.title="Completed Calls";
        $scope.loadBranches();
        //$scope.loadDepartments();
        $scope.SearchCompletedCalls($scope.nostate);
        $scope.SearchCompletedPms($scope.nostate);
        $scope.SearchCompletedQcs($scope.nostate);
        $scope.getAdverseIncedents($scope.nostate);
        $scope.loadRoundCompleted($scope.nostate);
        $scope.allCompletedTransfers($scope.nostate);
        $scope.loadCompletedCondemenationRequest($scope.nostate);
        if($scope.myall_hod_select!=undefined)
        {
            if($scope.myall_hod_select==$scope.hod_calls_select[0])
            {
                $scope.getAllCallsCount($scope.user_role_code,$scope.user_id);
            }
            else if($scope.myall_hod_select==$scope.hod_calls_select[1])
            {
                $scope.getAllCallsCount();
            }
        }
        else
        $scope.getAllCallsCount();
    }
    else if($state.is("home.hbhod_users"))
    {
        $scope.getBranchUsers();
        $scope.loadBranches();
        $scope.loadLevelsList();
		
		
    }
    else if($state.is("home.hbhod_add_user"))
    {
        $scope.loadBranches();
        $scope.getOrgRoles();
		$scope.loaduserlabels();
    }
    else if($state.is("home.hbhod_vendors"))
    {
        $scope.loadVendorList();
        $scope.getVendorTypes();
        $scope.loadBranches();
    }
    /*else if($state.is("home.hbhod_rounds_start"))
    {
        $scope.StartRound();
        $scope.loadDepartments();
    }*/
    else if($state.is("home.hbhod_rounds_complete"))
    {
       $scope.loadBranches();
       $scope.loadDepartments();
        $scope.loadRoundCompleted();
    }
    else if($state.is("home.vendor_add_asset"))
    {
        $scope.loadBranches();
        $scope.loadhospital();
        $scope.getSupportVendors();
        $scope.getClassifications($scope.nostate);
        $scope.getEqupCategories();
        $scope.getDistributors();
        $scope.getEqupOEMS();
        $scope.getEqupTypes();
        $scope.loadDepartments();
        //$scope.loadQcsDetails();
        $scope.loadStatus();
        $scope.loadEquipmentClass($scope.nostate);
        $scope.loadEupConditions();
        $scope.loadUtillization();
        //$scope.loadPmsDetails();
        $scope.loadContracts();
        $scope.loadVendorList($scope.nostate);
        $scope.getAccessories();
        $scope.getCriticalSpares();
        // $scope.loadContractTypeList();

        //$scope.scopeadd_device();
    }
else if($state.is("home.hbhod_rounds_assign"))
    {
        $scope.loadBranches();
        $scope.loadDepartments();
        $scope.getRoles();
        $scope.getHodBmes();
    }
    else if($state.is("home.hbhod_rounds_assigned"))
    {
        $scope.loadRoundAssigned();
    }
    else if($state.is("home.hbhod_training_create"))
    {
        $scope.getRoles();
		$scope.loadBranches();
        $scope.loadTrainingTypes();
        $scope.loadTrainingBy();
    }
	 else if($state.is("home.hbhod_scheduled_calls"))
    {

    }
    else if($state.is("home.hbhod_add_scheduled_call"))
    {
         $scope.loadBranches();
        $scope.check_scheduled_call();
    }
	
    else if($state.is("home.hbhod_training_approved"))
    {
        $scope.TrainingsApproved();
		$scope.loadBranches();
    }
    else if($state.is("home.hbhod_training_conduct"))
    {
        $scope.loadTraingConductdata();
		$scope.loadBranches();
    }
    else if($state.is("home.hbhod_training_feedback"))
    {
        $scope.loadTraingFeedbackdata();
		$scope.loadBranches();
    }
    else if($state.is("home.hbhod_training_request"))
    {
        $scope.loadTraingRequestdata();
		$scope.loadBranches();
    }
    else if($state.is("home.edit-vequipment"))
    {
        //$scope.loadBranches();
       // $scope.loadhospital();
        $scope.loadHospitals($scope.nostate);
        $scope.getBranchDetailsByHospitalID();
        $scope.getSupportVendors();
        $scope.getClassifications($scope.nostate);
        $scope.getEqupCategories();
        $scope.getDistributors();
        $scope.getEqupOEMS();
        $scope.getEqupTypes();
        $scope.loadDepartments();
        //$scope.loadQcsDetails();
        $scope.loadStatus();
        $scope.loadEquipmentClass($scope.nostate);
        $scope.loadEupConditions();
        $scope.loadUtillization();
        //$scope.loadPmsDetails();
        $scope.loadContracts();
        $scope.loadVendorList($scope.nostate);
        $scope.getAccessories();
        $scope.getCriticalSpares();
        // $scope.loadContractTypeList();
    }
    else if($state.is("home.hbhod_pending_pms"))
    {
        $scope.title="Pending PMS";
        $scope.loadBranches();
        $scope.SearchPendingPms();
        //$scope.loadDepartments();
        if($scope.myall_hod_select!=undefined)
        {
            if($scope.myall_hod_select==$scope.hod_calls_select[0])
            {
                $scope.getAllCallsCount($scope.user_role_code,$scope.user_id);
                action="get_hod_calls";
            }
            else if($scope.myall_hod_select==$scope.hod_calls_select[1])
            {
                $scope.getAllCallsCount();
                action=$scope.hod_calls_select[1];
            }
        }
        else
        $scope.getAllCallsCount();
    }
	
	 else if($state.is("home.hbhod_pending_scheduled"))
    {
        $scope.title="pending scheduled";
        $scope.loadBranches();
        //$scope.SearchPendingPms();
        $scope.SearchScheduledcall();
        //$scope.loadDepartments();
        if($scope.myall_hod_select!=undefined)
        {
            if($scope.myall_hod_select==$scope.hod_calls_select[0])
            {
            //    $scope.getAllCallsCount($scope.user_role_code,$scope.user_id);
                action="get_hod_calls";
            }
            else if($scope.myall_hod_select==$scope.hod_calls_select[1])
            {
              //  $scope.getAllCallsCount();
                action=$scope.hod_calls_select[1];
            }
        }
        else
            $scope.getAllCallsCount();
    }
    else if($state.is("home.hbhod_pending_qcs"))
    {
        $scope.title="Pending Calibration";

        $scope.loadBranches();
        $scope.SearchPendingQc();
        //$scope.loadDepartments();
        if($scope.myall_hod_select!=undefined)
        {
            if($scope.myall_hod_select==$scope.hod_calls_select[0])
            {
                $scope.getAllCallsCount($scope.user_role_code,$scope.user_id);
            }
            else if($scope.myall_hod_select==$scope.hod_calls_select[1])
            {
                $scope.getAllCallsCount();
            }
        }
        else
        $scope.getAllCallsCount();
    }
    else if($state.is("home.hbhod_completed_pms"))
    {
       $scope.loadBranches();
        $scope.SearchCompletedPms();
        //$scope.loadDepartments();
        if($scope.myall_hod_select!=undefined)
        {
            if($scope.myall_hod_select==$scope.hod_calls_select[0])
            {
                $scope.getAllCallsCount($scope.user_role_code,$scope.user_id);
            }
            else if($scope.myall_hod_select==$scope.hod_calls_select[1])
            {
                $scope.getAllCallsCount();
            }
        }
        else
        $scope.getAllCallsCount();
    }
    else if($state.is("home.hbhod_completed_qcs"))
    {
       $scope.loadBranches();
        $scope.SearchCompletedQcs();
        $scope.loadDepartments();
        if($scope.myall_hod_select!=undefined)
        {
            if($scope.myall_hod_select==$scope.hod_calls_select[0])
            {
                $scope.getAllCallsCount($scope.user_role_code,$scope.user_id);
            }
            else if($scope.myall_hod_select==$scope.hod_calls_select[1])
            {
                $scope.getAllCallsCount();
            }
        }
        else
        $scope.getAllCallsCount();
    }
}]);