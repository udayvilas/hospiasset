app.controller('HBbmeCtrl', ['$scope', '$state', '$timeout', '$http', '$rootScope', '$q', '$mdToast', '$cookies', '$log', 'baseFactory', '$mdDialog', '$mdMedia','$window','$element', function($scope, $state, $timeout, $http, $rootScope, $q, $mdToast, $cookies, $log, baseFactory,$mdDialog, $mdMedia,$window,$element)
{
  if($cookies.get('user_id')==undefined || $cookies.get('user_id')=="")
  {
    $state.go('login');
  }
  $scope.showToast = function()
  {
    var pinTo = "bottom right";
    $mdToast.show(
        $mdToast.simple()
            .textContent($scope.toast_text)
            .position(pinTo)
            .hideDelay(5000)
    );
  };
  $scope.searchTerm='';
  $scope.clearSearchTerm = function()
  {
    $scope.searchTerm = '';
  };
  $element.find('input').on('keydown', function(ev) {
    ev.stopPropagation();
  });
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
                $scope.toast_text = dicnts+" Device(s) Details Saved Successfully.";
                $scope.showToast();
                $scope.dept_device_search={eqpid:"",dept_id:"",branch_id:$scope.user_branch,spono:"",saccessoriesno:""};
                $scope.getDepartDevices();
                $state.go("home.view_devies");
              }
              else
              {
                $scope.toast_text = dicnts+" Device(s) Details Saved, "+dicntf+" Device(s) Details Not Saved!";
                $scope.showToast();
                //$state.go("home.hbbme_search");
              }
            },
            function(errorPayload)
            {
              $log.error('failure loading', errorPayload);
            });
  };
  /*$scope.ppls = [];
   $scope.pcfs = [];
   $scope.foaibs = [];
   $scope.pp = [];
   $scope.roiirr = [];
   $scope.addCear=function(cear)
   {
   $log.log(cear);
   var ufiles = [];
   ufiles =  ufiles.concat($scope.ppls);
   ufiles =  ufiles.concat($scope.pcfs);
   ufiles =  ufiles.concat($scope.foaibs);
   ufiles =  ufiles.concat($scope.pp);
   ufiles =  ufiles.concat($scope.roiirr);
   baseFactory.addDeviceFileUpload(cear,ufiles,'user/add_cear_list')
   .then(function(payload)
   {
   $log.log(payload);
   if (payload.response == $rootScope.successdata)
   {
   $scope.toast_text = payload.call_back;
   $scope.mdDialogHide();
   $scope.showToast();
   $state.go('home.cear');
   }
   else if (payload.response == $rootScope.failedata)
   {
   $scope.toast_text = payload.call_back;
   $scope.showToast();
   }
   },
   function(errorPayload)
   {
   $log.error('failure loading', errorPayload);
   });
   };*/
  $scope.device_manuals = [];
  $scope.device_pos = [];
  $scope.device_othr_files = [];
  $scope.SaveDevice=function(input_data,action) /* Add device */
  {
	$log.info(JSON.stringify($scope.add_device));
    var files = [];
    files =  files.concat($scope.device_manuals);
    files =  files.concat($scope.device_pos);
    files =  files.concat($scope.device_othr_files);
    input_data.action=action;
	input_data.org_id = $scope.user_org;
	input_data.org_type = $scope.org_type;
	input_data.user_name = $scope.user_name;
	if(input_data.user_name != undefined)
	input_data.user_name =$scope.user_name;
	console.log(files);
	baseFactory.addDeviceFileUpload(input_data,files,'device/save_device')
        .then(function(payload)
            {
              console.log(JSON.stringify(payload));
         if(payload.device_response==$rootScope.successdata)
              {
                $scope.add_device = null;
                $scope.toast_text = payload.call_back;
                $scope.showToast();
               $scope.dept_device_search={eqpid:payload.device_id,dept_id:"",branch_id:$scope.user_branch,spono:"",saccessoriesno:""};
                $scope.getDepartDevices();
                $state.go('home.view_devies');
                $scope.equipment_clear();
              }
              else
              {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
				$scope.equipment_clear();
              }
            },
            function(errorPayload)
            {
              $log.error('failure loading', errorPayload);
            });
  };

  $scope.saveStock=function(input_data) /* Add device */
  {
    var files = [];
    files =  files.concat($scope.device_manuals);
    files =  files.concat($scope.device_othr_files);
    files =  files.concat($scope.device_pos);
    $log.log(files);
    baseFactory.addDeviceFileUpload(input_data,files,'device/save_stock')
    .then(function(payload)
    {
        $log.debug(payload);
        if(payload.response==$rootScope.successdata)
        {
          $scope.add_device = null;
          $scope.toast_text = payload.call_back;
          $scope.showToast();
          $state.go("home.stock");
        }
        else if(payload.response==$rootScope.failedata)
        {
          $scope.toast_text = payload.call_back;
          $scope.showToast();
        }
    },
    function(errorPayload)
    {
        $log.error('failure loading', errorPayload);
    });
  };

  $scope.updateDevice=function(data)
  {
    $log.log(data);
    var files = [];
    files =  files.concat($scope.device_manuals);
    files =  files.concat($scope.device_othr_files);
    files =  files.concat($scope.device_pos);
    data.action='update_device';

    if(data.AMC_FROM == undefined || data.AMC_TO == undefined )
    {
        $scope.toast_text = "Invalid Date formats, Please select it from datepicker";
        $scope.showToast();
        return false;
    }

    baseFactory.addDeviceFileUpload(data,files,'device/update_device')
        .then(function(payload)
            {
              $log.debug(payload);
              if (payload.response == $rootScope.successdata)
              {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
                $state.go("home.view_devies");
              }
              else if (payload.response == $rootScope.failedata)
              {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
              }
            },
            function(errorPayload)
            {
              $log.error('failure loading', errorPayload);
            });
  };
  $scope.EquipmentReplacementSubmit=function(data)
  {
    $log.log(data);
    var files = [];
    files =  files.concat($scope.device_manuals);
    files =  files.concat($scope.device_othr_files);
    files =  files.concat($scope.device_pos);
    data.action='replace_device';
    baseFactory.addDeviceFileUpload(data,files,'device/replace_device')
    .then(function(payload)
      {
        console.log(payload);
        if(payload.device_response==$rootScope.successdata)
        {
          $scope.add_device = null;
          $scope.toast_text = payload.call_back;
          $scope.showToast();
          $scope.dept_device_search={eqpid:payload.device_id,dept_id:"",branch_id:$scope.user_branch,spono:"",saccessoriesno:""};
          $scope.getDepartDevices();
          $state.go('home.view_devies');
        }
        else if(payload.device_response==$rootScope.failedata)
        {
          $scope.toast_text = payload.call_back;
          $scope.showToast();
        }
      },
    function(errorPayload)
    {
      $log.error('failure loading', errorPayload);
    });
  };
  if($state.is("home.hbbme_home"))
  {
    $scope.getAllCallsCount();
  }
  else if($state.is("home.radverse"))
  {

    $scope.AdverseReportGraphs();
    //$scope.adverseReportbarchart();
    $scope.loadDepartments();
    $scope.loadBranches();
    $scope.getAdverseReport();
    $scope.adversebarchart();
  }
  else if($state.is("home.rcall_log"))
  {
    //console.log("Depts");
    $scope.loadDepartments();
    $scope.loadBranches();
    $scope.loadContracts();
    $scope.getSupportVendors();
    $scope.CalllogReportGraphs();
  }
  else if($state.is("home.cms_report"))
  {
    $scope.loadDepartments();
    $scope.loadBranches();
    $scope.loadCMSReports();
    $scope.loadAssetManagementndOtherActivites();
  }
  else if($state.is("home.cear_request"))
  {
    $scope.loadDepartments();
    $scope.loadBranches();
    $scope.loadCearCategory();
  }
  else if($state.is("home.equp_down_time"))
  {
    $scope.loadBranches();
    $scope.loadDepartments();
    $scope.EquipmentDownTimeReportGraphs();
    $scope.getEquipmentDownTime();
  }
  else if($state.is("home.hbbme_add_asset") || $state.is("home.edit_device") || $state.is("home.replace_device") || $state.is("home.add_stock"))
  {
    $scope.loadBranches();
    //$scope.getSupportVendors();
    //$scope.getClassifications($scope.nostate);
    //$scope.getEqupCategories();
    //$scope.getDistributors();
    //$scope.getEqupOEMS();
    //$scope.getEqupTypes();
    //$scope.loadDepartments();
    //$scope.loadQcsDetails();
    //$scope.loadStatus();
    //$scope.loadEquipmentClass($scope.nostate);
    //$scope.loadEupConditions();
    //$scope.loadUtillization();
    //$scope.loadPmsDetails();
    $scope.loadContracts();
    //$scope.loadVendorList($scope.nostate);
    //$scope.getAccessories();
    //$scope.getCriticalSpares();
	$scope.getorgmodule();
	//$scope.getorgmastertable();
	//$scope.getDepartDevices();
	$scope.getorgform();
	$scope.SaveValues();
	//$scope.get_org_master_table1();
	//$scope.getorgmastertable();
	//$scope.getitemmaster();
    //$scope.loadContractlTypeList();

    //$scope.scopeadd_device();
  }
  else if($state.is("home.indent_equipment"))
  {
    //if($scope.user_role_code!=$scope.HBBME && $scope.user_role_code!=$scope.HBHOD)
    {
       $scope.loadIncidentsElements();
      $scope.loadBranches();
        $scope.loadHospitals($scope.nostate);
        $scope.getBranchDetailsByHospitalID();
      //$scope.getAllStockCount();
    }
  }
  else if($state.is("home.indent_equipment_request"))
  {
    $scope.loadBranches();
    //$scope.loadAllDepartments();
    $scope.loadDepartments();
    $scope.getEqupCategories();
    $scope.getSupportVendors();
    $scope.getAccessories();
    $scope.getCriticalSpares();
    $scope.getEqupOEMS();		$scope.getVendorDetails($scope.user_org);
    //$scope.getVendorAndEquipmentsDtls(hdfh);
  }

  else if($state.is("home.cear"))
  {
    $scope.loadCear();
    $scope.loadBranches();
  }
  else if($state.is("home.rservices"))
  {
    $scope.loadBranches();
    $scope.loadDepartments();
    $scope.ServiceReportGraphs();
    $scope.getDeployementReport();
  }
  else if($state.is("home.hbbme_equipment_names"))
  {
	  //$scope.loaddevicenameslabels();
    $scope.loadEquipmentNames();
    //$scope.getEqupTypes();
  }
  else if($state.is("home.hbbme_add_equipment_name"))
  {
    $scope.loaddevicenameslabels();
	$scope.getEqupTypes();
    $scope.getDevicePriorities();
  }
  else if($state.is("home.hbbme_print_labels"))
  {
    $scope.loadBranches();
    $scope.loadDepartments();
    //$scope.loadAllDepartments();
  }
  else if($state.is("home.print_labels_pms_cal"))
  {
    $scope.loadBranches();
    $scope.loadDepartments();
  }
  else if($state.is("home.hbbme_equipment_summary"))
  {
    $scope.equpDepts();
    $scope.getEqupUnitWise();
  }
  else if($state.is("home.monthly_performance_report"))
  {
    $scope.loadBranches();
    $scope.loadMPReports();
    //$scope.causeCodes();
  }
  else if($state.is("home.hbbme_generate_call"))
  {
    //$scope.getDevices();
    $scope.loadCondmnReasonsList($scope.nostate);
    $scope.getCallMasters();
    $scope.loadAllDepartments();
    //$scope.getDeviceReasons();
    $scope.getDevicePriorities();
    $scope.loadIncidentType();
    $scope.loadBranches();
    //$scope.getDepartmentDevices();
  }
  else if($state.is("home.hbbme_incident_call"))
  {
      $scope.loadCondmnReasonsList($scope.nostate);
      $scope.getCallMasters();
      $scope.loadAllDepartments();
      //$scope.getDeviceReasons();
      $scope.getDevicePriorities();
      $scope.loadIncidentType();
      $scope.loadBranches();
  }
  else if($state.is("home.hbbme_transfer_call"))
  {
      $scope.loadCondmnReasonsList($scope.nostate);
      $scope.getCallMasters();
      $scope.loadAllDepartments();
      //$scope.getDeviceReasons();
      $scope.getDevicePriorities();
      $scope.loadIncidentType();
      $scope.loadBranches();
  }
  else if($state.is("home.hbbme_non_scheduled_call"))
  {
      //$scope.getDevices();
      $scope.loadCondmnReasonsList($scope.nostate);
      $scope.getCallMasters();
      $scope.loadAllDepartments();
      //$scope.getDeviceReasons();
      $scope.getDevicePriorities();
      $scope.loadIncidentType();
      $scope.loadBranches();
	  $scope.loadNonScheduledReasons();
      //$scope.getDepartmentDevices();
  }
  else if($state.is("home.hbbme_condemn_call"))
  {
      $scope.loadCondmnReasonsList($scope.nostate);
      $scope.getCallMasters();
      $scope.loadAllDepartments();
      //$scope.getDeviceReasons();
      $scope.getDevicePriorities();
      $scope.loadIncidentType();
      $scope.loadBranches();
  }
  else if($state.is("home.hbbme_today_calls"))
  {
    $scope.title="Today Calls";
    //$scope.RespondedCalls();
    //$scope.AttendedCalls();
    //$scope.CompletedCalls();
    $scope.bmetoDayCalls();
    $scope.getOtherunitUnitTransferCalls($scope.nostate,'');
    $scope.loadCondemenationRequest($scope.nostate,'');
    $scope.loadAdverseIncedents('',$scope.nostate);
    $scope.SearchPendingPms($scope.nostate);
    $scope.SearchPendingQc($scope.nostate);
    $scope.loadRoundAssigned($scope.nostate);
    $scope.getAllCallsCount();
    $scope.loadBranches();
  }
  else if($state.is("home.hbbme_responded_calls"))
  {
    $scope.title="Assigned Calls";
    //$scope.RespondedCalls();
    $scope.SearchRespondedCalls();
    $scope.loadDepartments();
    $scope.getAllCallsCount();
  }
  else if($state.is("home.open_calls"))
  {
    $scope.title="Open Calls";
    $scope.openNsCalls();
    $scope.loadBranches();
    //$scope.loadDepartments();
      $scope.getSupportVendors();
    $scope.getAllCallsCount();
	$scope.getorganisations();
	//$scope.loadUser();
	$scope.getHodBmes();
    if($scope.user_role_code==$scope.HMADMIN)
    {
      $scope.loadBranches();
    }
  }
  else if($state.is("home.hbbme_attended_calls"))
  {
    $scope.title="In Progress Calls";
    $scope.SearchAttendedCalls();
    //$scope.AttendedCalls();
    $scope.loadDepartments();
    $scope.getAllCallsCount();
  }
  else if($state.is("home.hbbme_propen_calls"))
  {
    $scope.title="On Hold Calls";
    //$scope.PendingCalls();
    $scope.SearchProcessPendimgCalls();
    //$scope.loadDepartments();
    $scope.getAllCallsCount();
    if($scope.user_role_code==$scope.HMADMIN)
      $scope.loadBranches();
  }
  else if($state.is("home.hbbme_completed_calls"))
  {
    $scope.title="Completed Calls";
    $scope.SearchCompletedCalls($scope.nostate);
    $scope.SearchCompletedPms($scope.nostate);
    $scope.SearchCompletedQcs($scope.nostate);
    $scope.getAdverseIncedents($scope.nostate);
    $scope.loadRoundCompleted($scope.nostate);
    $scope.allCompletedTransfers($scope.nostate);
    $scope.loadCompletedCondemenationRequest($scope.nostate);
    $scope.getAllCallsCount();
  }
  else if($state.is("home.hbbme_pending_pms"))
  {
    $scope.title="Pending PMS";
    //$scope.SearchPendingPms();
    //$scope.loadDepartments();
    $scope.getAllCallsCount();
  }
  else if($state.is("home.haadmin_add_labels"))
  {
      $scope.loadhamodulelist();
  }
  else if($state.is("home.hbbme_pending_qcs"))
  {
    $scope.title="Pending Calibration";
    //$scope.SearchPendingQc();
    //$scope.loadDepartments();
    $scope.getAllCallsCount();
  }
  else if($state.is("home.hbbme_completed_pms"))
  {
    $scope.title="Completed PMS";
    $scope.SearchCompletedPms();
    //$scope.loadDepartments();
    $scope.getAllCallsCount();
  }
  else if($state.is("home.hbbme_completed_qcs"))
  {
    $scope.title="Completed QC";
    $scope.SearchCompletedQcs();
    //$scope.loadDepartments();
    $scope.getAllCallsCount();
  }
  else if($state.is("home.transfer_calls"))
  {
    $scope.title="Transfer Calls";

    $scope.getOtherunitUnitTransferCalls();
	$scope.getAllCallsCount();
    //$scope.loadDepartments();
    //if($scope.user_role_code==$scope.HMADMIN)
      $scope.loadBranches();
     // $scope.loadTransferUnits();

    if($scope.user_role_code==$scope.HBHOD)
    {
      $scope.hodMyCalls();
	  $scope.getOtherunitUnitTransferCalls();
	  $scope.getAllCallsCount();
       // $scope.loadTransferUnits();
    }
    else
      $scope.getAllCallsCount();
     
     // $scope.loadTransferUnits();
  }
  else if($state.is("home.condemnation_calls"))
  {
    $scope.title="Condemnation Calls";
    $scope.loadReusableParts($scope.nostate);
    $scope.loadCondemenationRequest();
    //$scope.loadDepartments();
    //$scope.getAllCallsCount();
    //if($scope.user_role_code==$scope.HMADMIN)
      $scope.loadBranches();
    if($scope.user_role_code==$scope.HBHOD)
    {
      $scope.hodMyCalls();
    }
    else
      $scope.getAllCallsCount();
  }
  else if($state.is("home.rounds_calls"))
  {
    $scope.title="Round Calls";
    $scope.loadBranches();
    $scope.loadRoundAssigned($scope.nostate);
    $scope.loadDepartments();
    if($scope.user_role_code==$scope.HBHOD)
    {
      $scope.hodMyCalls();
    }
    else
      $scope.getAllCallsCount();
  }
  else if($state.is("home.adverse_calls"))
  {
    $scope.title="Adverse Calls";
    //$scope.loadDepartments();
    //if($scope.user_role_code==$scope.HMADMIN)
      $scope.loadBranches();
    if($scope.user_role_code==$scope.HBHOD)
    {
      $scope.loadAdverseIncedents();
      $scope.hodMyCalls();
    }
    else
    {
      $scope.getAllCallsCount();
        $scope.loadAdverseIncedents();
    }
  }
  else if($state.is("home.hbbme_training_create"))
  {
    $scope.getRoles();
    $scope.loadTrainingTypes();
    $scope.loadTrainingBy();
  }
  else if($state.is("home.hbbme_training_approved"))
  { 
    $scope.loadBranches();
    $scope.TrainingsApproved();
  }
  else if($state.is("home.hbbme_training_conduct"))
  {
    $scope.loadTraingConductdata();
  }
  else if($state.is("home.hbbme_training_feedback"))
  {
    $scope.loadTraingFeedbackdata();
    $scope.getEqupOEMS();
  }
  else if($state.is("home.hbbme_rounds_complete"))
  {
    $scope.loadRoundCompleted();
    $scope.loadDepartments();
  }
  else if($state.is("home.hbbme_rounds_assign"))
  {
    $scope.loadDepartments();
    $scope.getRoles();
    $scope.getHodBmes();
  }
  else if($state.is("home.hbbme_rounds_assigned"))
  {
    $scope.loadRoundAssigned($scope.nostate);
  }
  else if($state.is("home.hbbme_users"))
  {
    $scope.getBranchUsers();
  }
  else if($state.is("home.hbbme_add_user"))
  {
    $scope.getRoles();
  }
  else if($state.is("home.equipment_save_and_deploy"))
  {
    $scope.getClassifications($scope.nostate);
    $scope.loadDepartments();
    $scope.loadEquipmentNames($scope.nostate);
  }
  else if($state.is("home.hbbme_contract_type"))
  {
    $scope.loadBranches();
	$scope.loadContractTypeList();
	//$scope.loadcontracttypelabels();
  }
  else if($state.is("home.hbbme_add_contract_type"))
  {
	  $scope.loadcontracttypelabels();
	  $scope.loadContractTypeList();
  }
  else if($state.is("home.hbbme_status"))
  {
    
	$scope.loadStatusList();
  }
  else if($state.is("home.hbbme_add_status"))
  {
	  $scope.loadStatuslabel();
  }
  else if($state.is("home.hbbme_equipment_condition"))
  {
    $scope.loadEqupCondition();
    $scope.equpcondlabelsorglist();
	$scope.equpcondlabelslist();
  }
  else if($state.is("home.hbbme_add_equp_condition"))
  {
	  $scope.equpcondlabelslist();
  }
  else if($state.is("home.hbbme_equipment_class"))
  {
    $scope.loadEquipmentClass();
  }
  else if($state.is("home.hbbme_utlization_value"))
  {
    $scope.loadUtillizationValue();
  }
  else if($state.is("home.hbbme_training_type"))
  {
    $scope.loadBranches();
	$scope.loadTrainingTypes();
	
  }
  else if($state.is("home.accessories"))
  {
    $scope.getAccessories();
  }
  else if($state.is("home.critical_spares"))
  {
    $scope.getCriticalSpares();
  }
  else if($state.is("home.add_critical_spare"))
  {
    $scope.loadBranches();
  }
  else if($state.is("home.hbbme_add_vendor"))
  {
    $scope.loadBranches();
    $scope.getVendorTypes();
      $scope.getStateDetailsByCountryID();
      $scope.loadOrgnasationTypes();

      $scope.loadCountry($scope.nostate);

      $scope.loadFuters();

      $scope.getSubFeatures();
      $scope.getCityDetailsByStateID();


  }
  else if($state.is("home.classifications"))
  {
    $scope.loadBranches();
	$scope.getClassifications();
  }
  else if($state.is("home.equipment_types"))
  {
    $scope.loadBranches();
	$scope.getEqupTypes();

  }
  else if($state.is("home.departments"))
  {
	$scope.loadBranches();
	//$scope.loaddepartmentlabels();
	//$scope.loadDepartments();
	$scope.loadDEpatmentsList();
	
  }
  else if($state.is("home.add_departments"))
  {
	  $scope.loaddepartmentlabels();
	  $scope.loadhamodulelist();
  }
  else if($state.is("home.reasons"))
  {
    $scope.loadBranches();  
    $scope.loadReasonsList();
  }
  else if($state.is("home.non_scheduled_reasons"))
  {
       $scope.loadNonScheduledReasons();
  }
  else if($state.is("home.levels"))
  {
    $scope.loadBranches();
	$scope.loadLevelsList();
	
  }
  else if($state.is("home.escalation"))
  {
     $scope.loadBranches();
	 $scope.escalation_label();
   //$scope.loadEscalationList();
  }
  else if($state.is("home.view_devies"))
  {
    $scope.loadBranches();
    $scope.loadDepartments();
	$scope.getDepartDevices();
    //$scope.getDepartmentDevices();
    //$scope.getDepartDevices();
  }
  else if($state.is("home.escalations"))
  {
    //$scope.loadEscalations();
    //$scope.getEqupTypes($scope.nostate);
  }
  else if($state.is("home.add_escalations1"))
  {
    $scope.getEqupCategories();
    $scope.loadEscalationList($scope.nostate);
    $scope.loadUtillization();
  }
  else if($state.is("home.incident_type"))
  {
    $scope.loadBranches();
	$scope.loadIncidentType();
	

  }
  else if($state.is("home.add_incident_type"))
  {
	  $scope.loadincidenttypelabels();
  }
  else if($state.is("home.incident"))
  {
    $scope.loadIncidentType();
    $scope.loadDepartments();
  }
  else if($state.is("home.observations"))
  {
    $scope.loadBranches();
    $scope.loadAdverseIncedents();
    $scope.loadIncidentType();
    $scope.loadDepartments();
    $scope.getAdverseIncedents();
	$scope.loadIncedentsandobservations();
  }
  else if($state.is("home.maintain_contracts"))
  {
    $scope.loadMaintanceContracts();
	$scope.getContractVendorDetails();
    $scope.loadDepartments();
    $scope.loadContracts();
    $scope.loadBranches();
  }
  else if($state.is("home.add_maintain_contracts"))
  {
    $scope.loadContractTypeList();
    $scope.loadBranches();
    //$scope.loadContracts();
    $scope.getSupportVendors();
  }
  else if($state.is("home.add_multiple_contracts"))
  {
    $scope.loadBranches();
    $scope.loadContracts();
    $scope.getSupportVendors();
    $scope.loadContractTypeList();
	//$scope.getVendorAndEquipmentsDtls();
  }
  else if($state.is("home.transfer_within_unit"))
  {
    $scope.loadDepartments();
  }
  else if($state.is("home.other_unit"))
  {
    $scope.loadDepartments();
  }
  else if($state.is("home.other_unit_approval"))
  {
    $scope.loadOtherUnitApproval();
  }
  else if($state.is("home.other_unit_transfer"))
  {
    $scope.loadOtherUnitTransfer();
  }
  else if($state.is("home.transfer"))
  {
    $scope.loadBranches();
    $scope.loadTransferUnits();
  }
  else if($state.is("home.condemnation_request"))
  {
    $scope.loadDepartments();
    $scope.loadCondmnReasonsList();
    $scope.loadReusableParts();
  }
  else if($state.is("home.condemnation"))
  {
    $scope.loadDepartments();
    $scope.loadCondemenationRequest();
    $scope.loadBranches();
    $scope.loadReusableParts();
  }
  else if($state.is("home.transfer_save_and_deploy"))
  {
    $scope.loadDepartments();
    $scope.loadBranches();
  }
  else if($state.is("home.adverse_reports"))
  {
    $scope.loadDepartments();
    $scope.loadBranches();
    $scope.getAdverseReport();
  }
  else if($state.is("home.deployment"))
  {
    $scope.loadDepartments();
    $scope.loadBranches();
    $scope.getDeployementReport();
    $scope.DeployementReportGraphs();
  }
  else if($state.is("home.rviability"))
  {
    //$scope.loadDepartments();
    $scope.loadBranches();
   // $scope.viabilityReportGraphsNew();
    $scope.ViabiltyReportGraphs();
  }
  else if($state.is("home.rpms"))
  {
    $scope.loadDepartments();
    $scope.loadBranches();
    $scope.pmsReportGraphs();
    $scope.getPMSReport();
  }
  else if($state.is("home.rqc"))
  {

    $scope.loadDepartments();
    $scope.loadBranches();
    $scope.qcReportGraphs();
    //$scope.getViabilityReport();
  }

  else if($state.is("home.requipment_summary"))
  {
    $scope.loadDepartments();
    $scope.loadBranches();
    $scope.loadEqupSummryReports();
    $scope.Equipmentsumarybarchart();
  }
  else if($state.is("home.gate_pass_request"))
  {
    $scope.loadAllDepartments();
    $scope.loadBranches();
    $scope.getDepartmentDevices();
    $scope.getCriticalSpares();
    $scope.getAccessories();
    $scope.loadGatepass();
  }

  else if($state.is("home.graphs"))
  {
    $scope.loadBranches();
    $scope.Equipmentsumarybarchart();
      /* $scope.cmsbarchart();
       $scope.gatepassbarchart();
       $scope.viabiltybarchart();
       $scope.adversebarchart();
       $scope.calllogbarchart();
       $scope.servicesbarchart();
       $scope.Deployementbarchart();
       $scope.Redeployementbarchart();
       $scope.Pmsbarchart();
       $scope.QCbarchart();
          $scope.Indentbarchart();
          $scope.Cearbarchart();
          $scope.Condemnationbarchart();
         $scope.MonthlyPerformancebarchart();
           $scope.transferbarchart();
          $scope.ViabiltyReportGraphs();*/

  }

  else if($state.is("home.hbbme_deployment"))
  {
       $scope.loadBranches();
       $scope.UndeployedDevices();
  }
  else if($state.is("home.rcondemnation"))
  {
    $scope.loadBranches();
    $scope.CondemnationReportGraphs();
      $scope.getCondemnationReport();
    $scope.loadDepartments();
  }
  else if($state.is("home.call_log_reports"))
  {
      $scope.loadDepartments();
      $scope.loadCalllogsReports();
      $scope.loadContracts();
     //$scope.getSupportVendors();
	 $scope.loadVendorList($scope.nostate);
      $scope.loadBranches();

  }
  else if($state.is("home.asset_management_other_activites"))
  {
    $scope.loadAssetManagementndOtherActivites();
  }
  else if($state.is("home.deployment_report"))
  {
    $scope.loadBranches();
      $scope.loadDepartments();
    $scope.loadDeployementReports();
    $scope.DeployementReportGraphs();
    $scope.getDeployementReport();
  }
  else if($state.is("home.rredeployment"))
  {
    $scope.loadBranches();
    $scope.loadDepartments();
    $scope.ReDeployementReportGraphs();
    $scope.getReDeployementReport();
  }
  else if($state.is("home.pms_report"))
  {
    $scope.Pmsbarchart();
  }
  else if($state.is("home.qc_report"))
  {
    $scope.loadDepartments();
    $scope.loadBranches();
    $scope.qcReportGraphs();
  }
  else if($state.is("home.rqc"))
  {
      $scope.loadDepartments();
      $scope.loadBranches();
      $scope.qcReportGraphs();
  }
  else if($state.is("home.equp_history_card"))
  {
    $scope.loadBranches();
    $scope.getEquipmentHistory();
    $scope.loadDepartments();
    //$scope.EquipmentDownTimeReportGraphs();
    $scope.EquipmentHistorybarchart();
  }
  else if($state.is("home.monthly_performance_graph"))
  {
    $scope.loadBranches();
    $scope.MPRNonSheduledGraphs();
    $scope.MPRResponseTimeGraphs();
    $scope.MPRTimeToRepairGraphs();
    $scope.MPRSheduledGraphs();
    $scope.MPRTrainingSessionGraphs();
    $scope.MPRCauseCodesGraphs();
    $scope.MPRReasonsfordelayGraphs();
    $scope.MPRAssetsCountGraphs();
    $scope.MPRAssetsValuesGraphs();
    $scope.MPRManpowerGraphs();
    $scope.MPRReplacementGraphs();
    $scope.MPRActivitiesCountGraphs();
    $scope.MPRExpensesValuetGraphs();
    $scope.MPRExpensesCountGraphs();
    $scope.MPRActivitiesValuesGraphs();
    $scope.MPRContractsGraphs();
    $scope.MPREngineerProductivityGraphs();
    $scope.MPRnabhreadinessGraphs();
  }
  else if($state.is("home.rnscreport"))
  {
    $scope.loadDepartments();
  }
  else if($state.is("home.rscreport"))
  {
    $scope.loadDepartments();
    $scope.getqcSCReport();
  }
  else if($state.is("home.add_viabilty"))
  {
    $scope.loadBranches();
    $scope.loadAllDepartments();
    $scope.getDepartmentDevices();
  }
  else if($state.is("home.reports"))
  {
    $scope.Indentbarchart();
    $scope.Cearbarchart();
    $scope.EquipmentDownTimeReportGraphs();
    $scope.CalllogReportGraphs();
    $scope.ViabiltyReportGraphs();
    $scope.AdverseReportGraphs();
    $scope.ServiceReportGraphs();
    $scope.DeployementReportGraphs();
    $scope.ReDeployementReportGraphs();
    $scope.qcReportGraphs();
    $scope.pmsReportGraphs();
    $scope.CondemnationReportGraphs();
    $scope.cmsbarchart();
    $scope.Equipmentsumarybarchart();
    $scope.gatepassbarchart();
  }
  else if($state.is("home.equp_down_time"))
  {
    $scope.loadBranches();
    $scope.loadDepartments();
    $scope.getEquipmentDownTime();
    $scope.EquipmentDownTimeReportGraphs();
  }
  else if($state.is("home.rindent"))
  {
    $scope.loadBranches();
    $scope.Indentbarchart();
    $scope.getIndentReportPDF();
    $scope.loadIncidentsElements();
  }
  else if($state.is("home.Cear"))
  {
    $scope.Cearbarchart();
  }
  else if($state.is("home.gatepass"))
  {
    $scope.loadBranches();
    $scope.gatepassbarchart();
  }
  else if($state.is("home.rcall_log"))
  {
    $scope.CalllogReportGraphs();
      $scope.loadBranches();

  }
  else if($state.is("home.cearcategory"))
  {
	  $scope.loadBranches();
  }
	  
  else if($state.is("home.cms_report"))
  {
    $scope.loadBranches();
    $scope.CalllogReportGraphs();
    $scope.loadDepartments();
    $scope.loadCMSReports();
    $scope.loadAssetManagementndOtherActivites();
  }
  else if($state.is("home.stock"))
  {
    $scope.loadBranches();
    $scope.getAllStockCount();
  }
  else if($state.is("home.stock_report"))
  {
    $scope.loadBranches();
    $scope.getStock();
  }
  else if($state.is("home.condemination_new"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
  }
  else if($state.is("home.adverse_call_new"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
  }
  else if($state.is("home.gate_pass_new_mytransion"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
  }
  else if($state.is("home.viability_new"))
  {
    $scope.loadDepartments();
    $scope.getMyTransAllCallsCount();

  }
  else if($state.is("home.viability"))
  {
      $scope.getViability();
      $scope.loadBranches();
  }
  else if($state.is("home.gate_pass_new"))
  {
      $scope.loadGatepass();
      $scope.loadBranches();
  }
  else if($state.is("home.hbbme_scheduled_calls"))
  {
     $scope.loadBranches();
     $scope.getAllCallsCount();
  }
  else if($state.is("home.transfer_new"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
  }
  else if($state.is("home.cear_new"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
  }

  else if($state.is("home.rcear"))
  {
      $scope.loadCear();
      $scope.loadBranches();
  }
  else if($state.is("home.indent_new"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
  }
  else if($state.is("home.rounds_new"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
  }
  else if($state.is("home.instalation_new"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
  }
  else if($state.is("home.scheduled_calls_new"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
  }
  else if($state.is("home.non_scheduled_calls_new"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
  }
  else if($state.is("home.generated_calls_new"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
  }
  else if($state.is("home.maintance_contracts_new"))
  {
    $scope.getMyTransAllCallsCount();
    $scope.loadDepartments();
    //$scope.loadBranches();
  }
  $scope.equipment_clear = function (device) {
        //console.clear();
       // console.log(JSON.stringify($scope.add_device));
        $scope.add_device.branch_id = '';
        $scope.add_device.device_remarks = '';
        $scope.add_device.description = '';
        $scope.add_device.cat = '';
        $scope.add_device.company_name = '';
        $scope.add_device.department = '';
        $scope.add_device.equp_type = '';
        $scope.add_device.distributor = '';
        $scope.add_device.vendor = '';
        $scope.add_device.device_name = '';
        $scope.add_device.device_model = '';
        $scope.add_device.device_cost = '';
        $scope.add_device.present_condition = '';
        $scope.add_device.pms_date = '';
        $scope.add_device.qc_date = '';
        $scope.add_device.date_of_install = '';
        $scope.add_device.utilization = '';
        $scope.add_device.device_class = '';
        $scope.add_device.device_status = '';
        $scope.add_device.accessories = '';
        $scope.add_device.critical_spares = '';
        $scope.add_device.phy_location = '';
        $scope.add_device.end_of_life = '';
        $scope.add_device.end_of_support = '';
        $scope.add_device.manufacture_date = '';
        $scope.add_device.contract_type = '';
        $scope.add_device.contract_value = '';
        $scope.add_device.contract_from_date = '';
        $scope.add_device.contract_to_date = '';
        $scope.add_device.vendor_contact_no = '';
        $scope.add_device.vemail_id = '';
        $scope.add_device.vcontact_person = '';
        $scope.add_device.vcontact_person_no = '';
        $scope.add_device.vcontact_person_email_id = '';
        $scope.add_device.vendor_address = '';
        $scope.add_device.po_number = '';
        $scope.add_device.po_date = '';
        $scope.add_device.grn_no = '';
        $scope.add_device.grn_date = '';
        $scope.add_device.serial_number = '';
        $scope.add_device.no_of_pms = '';
        $scope.add_device.no_of_qcs = '';
        $scope.add_device.no_of_qcs_ym = '';

  };
}]);