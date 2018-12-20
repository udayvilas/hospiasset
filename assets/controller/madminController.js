app.controller('MAdminCtrl', ['$scope', '$state', '$timeout', '$http', '$rootScope', '$q', '$mdToast', '$cookies','$log','baseFactory', function($scope, $state, $timeout, $http, $rootScope, $q, $mdToast, $cookies,$log,baseFactory)
{
    if($cookies.get('user_id')==undefined || $cookies.get('user_id')=="")
    {
        $state.go('login');
    }
    if($state.is("home.appointment_hospitals"))
    {
        //$scope.loadAppointments();
    }
    else if($state.is("home.mahospitals"))
    {
        $scope.loadHospitals();
    }
    else if($state.is("home.appointment_organizations"))
    {
        $scope.loadAPTOrgnigations();
    }
    else if($state.is("home.add_appointments"))
    {
        $scope.loadAllAppointmentOrgizations();
    }
    else if($state.is("home.haadmin_vendors"))
    {
        $scope.loadhavendorlist();
    }
    else if($state.is("home.haadmin_modules"))
    {
        $scope.loadBranches();
		$scope.loadhamodulelist();
    }
	else if($state.is("home.haadmin_countries"))
	{
		$scope.loadBranches();
		$scope.loadCountry();
	}
	else if($state.is("home.haadmin_states"))
	{
		$scope.loadBranches();
		$scope.loadStates();
		$scope.loadstateslabels();
	}
	else if($state.is("home.haadmin_add_equpcondlabels"))
    {
       $scope.loadhamodulelist();
	   $scope.loadHospitals();
    }
    else if($state.is("home.haadmin_equpcondlabels"))
    {
        $scope.equpcondlabelslist();
        $scope.loadhamodulelist();
    }
	else if($state.is("home.add_org_create_form"))
	{
		$scope.loadhamodulelist();
		$scope.getorgform();
	}		
	else if($state.is("home.org_create_form"))	
	{		
         // $scope.gettablesbymodule();
          $scope.getorgform();		  
		  $scope.getorgtablemaster();
    }
	else if($state.is("home.haadmin_add_device_label"))
	{
		$scope.loadhamodulelist();
		$scope.loadHospitals();
		//$scope.get_table_names();
	}
	else if($state.is("home.hadmin_add_item_master"))
	{
		$scope.loadhamodulelist();
		//$scope.get_table_names();
		$scope.get_master_table();
		//$scope.gettablesbymodule();
		$scope.getdatatypes();
	}
	else if($state.is("home.ha_master_table"))
	{
		$scope.get_master_table();
	}
	else if($state.is("home.hadmin_item_master"))
	{
		$scope.loaditemmasters();
	}
    else if($state.is("home.haadmin_add_equp_type_labels"))
    {
        $scope.loadhamodulelist();
    }
	else if($state.is("home.haadmin_device_label"))
	{
		$scope.loadlabelslist();
	}
    else if($state.is("home.haadmin_equp_types_labels"))
    {
        $scope.loadEqupTypeLabelslist();
        $scope.loadhamodulelist();
		$scope.loadHospitals();
		$scope.getEqupTypes();
    }
	else if($state.is("home.get_table_name"))
	{
		$scope.get_table_names();
		$scope.loadhamodulelist();
	}
	else if($state.is("home.add_table_name"))
	{
		
		$scope.loadhamodulelist();
	}
	else if($state.is("home.haadmin_add_department_label"))
	{
		$scope.loadHospitals();
		$scope.loadhamodulelist();
	}
	else if($state.is("home.haadmin_depreciation_add_label"))
	{
		$scope.loadHospitals();
		$scope.loadhamodulelist();
	}
	else if($state.is("home.haadmin_add_incidenttype_label"))
	{
		$scope.loadHospitals();
	}
       else if($state.is("home.haadmin_equpcondlabels"))
          {
                 $scope.equpcondlabelslist();
                 $scope.loadhamodulelist();
           }
    else if($state.is("home.haadmin_roles"))
    {
        $scope.loadRoletypes();
        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_countries_label"))
    {
        $scope.loadcountrieslabels();
        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_states_label"))
    {
        $scope.loadstateslabels();
        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_cities_label"))
    {
       $scope.loadcitieslabels();
        $scope.loadhamodulelist();
    }
     else if($state.is("home.haadmin_user_label"))
     {
         $scope.loaduserlabels();
         $scope.loadhamodulelist();
     }
    else if($state.is("home.haadmin_dept_label"))
    {
        $scope.loaddepartmentlabels();
        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_devicenames_label"))
    {
        $scope.loaddevicenameslabels();
        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_add_user_label"))
    {
        $scope.loadHospitals();
        $scope.loadhamodulelist();
    }
	else if($state.is("home.haadmin_add_status_label"))
	{
		$scope.loadhamodulelist();
		$scope.loadHospitals();
	}
	else if($state.is("home.haadmin_status_label"))
	{
		$scope.loadStatuslabel();
		$scope.loadhamodulelist();
	}
	else if($state.is("home.haadmin_depreciation_label"))
	{
		$scope.loadDepreciationlabel();
		$scope.loadhamodulelist();
	}
	 else if($state.is("home.haadmin_add_utilization_label"))
    {
        $scope.loadhamodulelist();

    }
	
	else if($state.is("home.haadmin_util_label"))
    {
        
        $scope.loadhamodulelist();
		$scope.loadUtillabels();
    }
   
	
    else if($state.is("home.haadmin_depreciation_add_label"))
    {

        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_add_devicenames_label"))
    {

        $scope.loadhamodulelist();
		$scope.loadHospitals();
    }
    else if($state.is("home.haadmin_branch_label"))
    {
        $scope.loadbranchlabels();
        $scope.loadhamodulelist();
    }
	else if($state.is("home.haadmin_add_branch_label"))
	{
		$scope.loadHospitals();
		$scope.loadhamodulelist();
	}
    else if($state.is("home.haadmin_contracttype_labels"))
    {
        $scope.loadcontracttypelabels();
        $scope.loadhamodulelist();
    }
	else if($state.is("home.haadmin_add_country_label"))
	{
		$scope.loadhamodulelist();
	}
	else if($state.is("home.haadmin_countris_label"))
	{
		$scope.loadhamodulelist();
		$scope.loadcountrieslabels();
	}
    else if($state.is("home.haadmin_incidenttype_labels"))
    {
        $scope.loadincidenttypelabels();
        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_escalation_label"))
    {
        $scope.loadescalationlabels();
        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_esctype_label"))
    {
        $scope.loadesctypelabels();
        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_escalationlevel_label"))
    {
        $scope.loadesclevellabels();
        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_add_escalation_label"))
    {

        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_add_esctype_label"))
    {

        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_add_esclevel_label"))
    {

        $scope.loadhamodulelist();
		$scope.loadHospitals();
    }

    else if($state.is("home.haadmin_role_labels"))
    {
        $scope.loadrolelabels();
        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_vendor_label"))
    {
        $scope.loadVendorlabel();
        $scope.loadhamodulelist();
    }
    else if($state.is("home.haadmin_add_role_label"))
    {
        $scope.loadhamodulelist();
		$scope.loadHospitals();
    }
    else if($state.is("home.haadmin_add_vendor_label"))
    {
        $scope.loadHospitals();
		$scope.loadhamodulelist();
    }
	else if($state.is("home.haadmin_add_contracttype_label"))
	{
		$scope.loadhamodulelist();
		$scope.loadHospitals();
	}
    /*else if($state.is("home.haadmin_add_modules"))
    {

    }*/
    else if($state.is("home.haadmin_add_vendors"))
    {
        $scope.getOrgRoles();
        $scope.loadHospitals();
        $scope.getBranchDetailsByHospitalID();
        $scope.getVendorTypes();
        $scope.getStateDetailsByCountryID();
        $scope.loadOrgnasationTypes();
        $scope.loadCountry($scope.nostate);
        $scope.loadFuters();
        $scope.getSubFeatures();
        $scope.getCityDetailsByStateID();
    }
    else if($state.is("home.add_hospitals"))
    {
        $scope.getStateDetailsByCountryID();
        $scope.loadOrgnasationTypes();
        $scope.loadCountry($scope.nostate);
        $scope.loadFuters();
		$scope.loadRoletypes();
        $scope.getSubFeatures();
		$scope.checkhospitalemail();  
		$scope.user_check();
		$scope.getsubSubFeatures();
        $scope.getCityDetailsByStateID();

        $scope.loadhamodulelist();
    }
    else if($state.is("home.add_organization_appointments"))
    {
        $scope.loadOrgnasationTypes();
        $scope.loadCountry($scope.nostate);
        $scope.loadFuters();
    }
    else if($state.is("home.edit_organization_appointments"))
    {
        $scope.loadOrgnasationTypes();
        $scope.loadCityList();
        $scope.loadCities();
        $scope.loadStates($scope.nostate);
        $scope.loadCountry($scope.nostate);
    }
    else if($state.is("home.haadmin_add_state"))
    {
       $scope.loadstateslabels();       
	   $scope.loadCountry($scope.nostate);
    }
	 else if($state.is("home.depreciation"))
    {
        $scope.loadDepreciation();
    }
	else if($state.is("home.location"))
    {
        $scope.loadLocation();
    }
	else if($state.is("home.depreciation_details"))
    {
        $scope.loadDepartments();
        $scope.loadBranches();
    }
    else if($state.is("home.edit_hospitals"))
    {
      $scope.loadFuters();
	  $scope.getSubFeatures();
	  $scope.getsubSubFeatures();
	  $scope.loadhamodulelist();
	}
    else if($state.is("home.mavendors"))
    {
    }
    else if ($state.is("home.assign_hospital"))
    {
    }
    else if($state.is("home.vendor_home"))
    {
        $scope.loadvendorpage();
    }
    else if($state.is("home.vendor_add_asset"))
    {
        $scope.loadBranches();
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
    else if($state.is("home.vendor_print_labels"))
    {
        $scope.loadDepartments();
        $scope.loadBranches();
    }
    $scope.loadVendors = function()
    {
        var get_vendors = {action:"get_hospitals"};
        baseFactory.getHospitals(get_vendors)
            .then(function(payload)
                {
                    $log.debug(payload);
                    if(payload.response==$rootScope.successdata)
                    {
                        $scope.vendors = angular.fromJson(payload.data);
                        $log.debug($scope.vendors);
                    }
                    else
                    {
                        $scope.vendors = {};
                    }
                },
                function(errorPayload)
                {
                    $log.error('failure loading', errorPayload);
                });
    };
}]);
