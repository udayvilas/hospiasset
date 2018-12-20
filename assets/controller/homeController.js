app.controller('homeCtrl', ['$filter','$scope','$state','$timeout','$http','$rootScope','$q','$mdToast','$cookies','$mdSidenav','$log', 'baseFactory', 'ImportExportToExcel','$mdDialog', '$mdMedia','$window','$element','$interval',function($filter,$scope, $state, $timeout, $http, $rootScope, $q, $mdToast, $cookies,$mdSidenav, $log, baseFactory,ImportExportToExcel, $mdDialog, $mdMedia, $window, $element,$interval)
{
// setup editor custom settings
    $scope.user_branch = $cookies.get('user_branch');

    $log.log("this is homeCtrl  "+$scope.user_branch);
	
	$scope.user_org_module = $cookies.get('user_org_module');
	console.log($scope.user_org_module);
       
	
	
    $scope.editorOptions =
	{
        // settings more at http://docs.ckeditor.com/#!/guide/dev_configuration
    };

    $scope.showToast = function () /* show alerts and toasts */
    {
        var pinTo = "bottom right";
        $mdToast.show(
            $mdToast.simple()
                .textContent($scope.toast_text)
                .position(pinTo)
                .hideDelay(5000)
        );
    };
    $scope.showToastText = function (text) /* show alerts and toasts */
    {
        var pinTo = "bottom right";
        $mdToast.show(
            $mdToast.simple()
                .textContent(text)
                .position(pinTo)
                .hideDelay(5000)
        );
    };
	
    $rootScope.successdata = "success";
    $rootScope.failedata = "failed";
    if ($cookies.get('user_id') == undefined || $cookies.get('user_id') == "" || $cookies.get('user_id') == null)
    {
        if (!$state.is("login"))
        {
            $state.go('login');
        }
    }
    else {
        $scope.check_session_exists = function ()
        {
            var send = {action: "check_session_exists"};
            baseFactory.authCtrl(send)
                .then(function (payload) {
                        $log.log(payload);
                        if (payload.response == $rootScope.failedata) {
                            $scope.showToastText("Session Expired, Logging Out!...");
                            $timeout(function () {
                                $scope.logout();
                            }, 3000);
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        };
        $scope.check_session_exists();
        $scope.user_main_menus = angular.fromJson(window.localStorage.getItem("user_menu"));
		console.log($scope.user_main_menus);
        $scope.user_name = $cookies.get('user_name');
        $scope.emp_no = $cookies.get('emp_no');
        $scope.org_code = $cookies.get('org_code');
        $log.log("user branch:" + $cookies.get('user_branch'));
        $log.log("user_org:" + $cookies.get('user_org'));
        $scope.org_type = $cookies.get('org_type');
		$scope.user_org_module = $cookies.get('user_org_module');
        $log.log("user_role_code:" + $cookies.get('user_role_code'));
        $scope.user_branch = $cookies.get('user_branch');
        $scope.user_general_asset = $cookies.get('user_general_asset');
        $scope.user_org_type = $cookies.get('user_org_type');
        $scope.Add_User = $cookies.get('Add_User');
        $scope.Edit_User = $cookies.get('Edit_User');
        $scope.View_User = $cookies.get('View_User');
        $scope.Add_Indent = $cookies.get('Add_Indent');
        $scope.Edit_Indent = $cookies.get('Edit_Indent');
        $scope.View_Indent = $cookies.get('View_Indent');
        $scope.Add_Vendor = $cookies.get('Add_Vendor');
        $scope.Edit_Vendor = $cookies.get('Edit_Vendor');
        $scope.View_Vendor = $cookies.get('View_Vendor');
        $scope.Add_Country = $cookies.get('Add_Country');
        $scope.Edit_Country = $cookies.get('Edit_Country');
        $scope.View_Country = $cookies.get('View_Country');
        $scope.Add_State = $cookies.get('Add_State');
        $scope.Edit_State = $cookies.get('Edit_State');
        $scope.View_State = $cookies.get('View_State');
        $scope.Add_City = $cookies.get('Add_City');
        $scope.Edit_City = $cookies.get('Edit_City');
        $scope.Add_Contract_Type = $cookies.get('Add_Contract_Type');
        $scope.Edit_Contract_Type = $cookies.get('Edit_Contract_Type');
        $scope.View_Contract_Type  = $cookies.get('View_Contract_Type');
        $scope.Add_Branches = $cookies.get('Add_Branches');
        $scope.Edit_Branches = $cookies.get('Edit_Branches');
        $scope.View_Branches = $cookies.get('View_Branches');
        $scope.Add_Escalations = $cookies.get('Add_Escalations');
        $scope.Edit_Escalations = $cookies.get('Edit_Escalations');
        $scope.View_Escalations = $cookies.get('View_Escalations');
        $scope.Add_Escalation_type = $cookies.get('Add_Escalation_type');
        $scope.Edit_Escalation_type = $cookies.get('Edit_Escalation_type');
        $scope.View_Escalation_type = $cookies.get('View_Escalation_type');
        $scope.Add_Escalationlevel = $cookies.get('Add_Escalationlevel');
        $scope.Edit_Escalationlevel = $cookies.get('Edit_Escalationlevel');
        $scope.Add_Cear_Category = $cookies.get('Add_Cear_Category');
        $scope.Edit_Cear_Category = $cookies.get('Edit_Cear_Category');
        $scope.View_Cear_Category = $cookies.get('View_Cear_Category');
        $scope.Add_Training_Type  = $cookies.get('Add_Training_Type');
        $scope.View_Training_Type = $cookies.get('View_Training_Type');
        $scope.Edit_Training_Type = $cookies.get('Edit_Training_Type');
        $scope.Add_Reasons = $cookies.get('Add_Reasons');
        $scope.Edit_Reasons = $cookies.get('Edit_Reasons');
        $scope.View_Reasons = $cookies.get('View_Reasons');
        $scope.Add_Department = $cookies.get('Add_Department');
        $scope.Edit_Department = $cookies.get('Edit_Department');
        $scope.View_Department = $cookies.get('View_Department');
        $scope.Add_Category = $cookies.get('Add_Category');
        $scope.Edit_Category  = $cookies.get('Edit_Category');
        $scope.View_Cateogry = $cookies.get('View_Cateogry');
        $scope.Add_Condition  =  $cookies.get('Add_Condition');
        $scope.Edit_Condition  = $cookies.get('Edit_Condition');
        $scope.Edit_Category   = $cookies.get('Edit_Category');
        $scope.View_Condition  = $cookies.get('View_Condition');
        $scope.Add_Classes = $cookies.get('Add_Classes');
        $scope.Edit_Classes  = $cookies.get('Edit_Classes');
        $scope.View_Classes  = $cookies.get('View_Classes');
        $scope.Add_Utilization = $cookies.get('Add_Utilization');
        $scope.Edit_Utilization = $cookies.get('Edit_Utilization');
        $scope.View_Utilization  = $cookies.get('View_Utilization');
        $scope.Add_Status = $cookies.get('Add_Status');
        $scope.Edit_Status = $cookies.get('Edit_Status');
        $scope.View_Status = $cookies.get('View_Status');
        $scope.Add_Classification = $cookies.get('Add_Classification');
        $scope.Edit_Classification  = $cookies.get('Edit_Classification');
        $scope.View_Classification = $cookies.get('View_Classification');
        $scope.Add_Equipment_Type  = $cookies.get('Add_Equipment_Type');
        $scope.Edit_Equipment_Type = $cookies.get('Edit_Equipment_Type');
        $scope.View_Equipment_Type = $cookies.get('View_Equipment_Type');
        $scope.Add_Incident_Type   = $cookies.get('Add_Incident_Type');
        $scope.Edit_Incident_Type  = $cookies.get('Edit_Incident_Type');
        $scope.View_Incident_Type  = $cookies.get('View_Incident_Type');
        $scope.Add_Role            = $cookies.get('Add_Role');
        $scope.Edit_Role           = $cookies.get('Edit_Role');
        $scope.View_Role           = $cookies.get('View_Role');
        $scope.Add_CEAR_TYPE   = $cookies.get('Add_CEAR_TYPE');
        $scope.Edit_CEAR_TYPE    = $cookies.get('Edit_CEAR_TYPE');
        $scope.View_CEAR_TYPE    = $cookies.get('View_CEAR_TYPE');
        $scope.Respond_Open_Calls     = $cookies.get('Respond_Open_Calls');
        $scope.Attend_Open_Calls    = $cookies.get('Attend_Open_Calls');
        $scope.Hold_Open_Calls   = $cookies.get('Hold_Open_Calls');
        $scope.Complete_Open_Calls    = $cookies.get('Complete_Open_Calls');
        $scope.View_Open_Calls    = $cookies.get('View_Open_Calls');
        $scope.Add_Adverse_Incident     = $cookies.get('Add_Adverse_Incident');
        $scope.Edit_Adverse_Incident     = $cookies.get('Edit_Adverse_Incident');
        $scope.Report_Gatepass_Pdf     = $cookies.get('Report_Gatepass_Pdf');
        $scope.View_Gatepass_report   = $cookies.get('View_Gatepass_report');
        $scope.View_Call_Log           = $cookies.get('View_Call_Log');
        $scope.Report_Summary_Pdf      = $cookies.get('Report_Summary_Pdf');
        $scope.Report_Summary_view      = $cookies.get('Report_Summary_view');
        $scope.Report_Downtime_view       = $cookies.get('Report_Downtime_view');
        $scope.Report_History_Pdf     = $cookies.get('Report_History_Pdf');
        $scope.Cms_Pdf_Report      = $cookies.get('Cms_Pdf_Report');
        $scope.Cms_Pdf_View      = $cookies.get('Cms_Pdf_View');
        $scope.Monthly_Pdf_Report   = $cookies.get('Monthly_Pdf_Report');
        $scope.Monthly_Pdf_View    = $cookies.get('Monthly_Pdf_View');
        $scope.Viability_pdf_report    = $cookies.get('Viability_pdf_report');
        $scope.Viability_pdf_report     = $cookies.get('Viability_pdf_report');
        $scope.Adverse_pdf_report     = $cookies.get('Adverse_pdf_report');
        $scope.Adverse_pdf_view     = $cookies.get('Adverse_pdf_view');
        $scope.Service_pdf_report   = $cookies.get('Service_pdf_report');
        $scope.Service_pdf_view     = $cookies.get('Service_pdf_view');
        $scope.Deployment_pdf_report  = $cookies.get('Deployment_pdf_report');
        $scope.Deployment_pdf_view      = $cookies.get('Deployment_pdf_view');
        $scope.Replacement_pdf_report   = $cookies.get('Replacement_pdf_report');
        $scope.Replacement_pdf_view     = $cookies.get('Replacement_pdf_view');
        $scope.PMS_pdf_report      = $cookies.get('PMS_pdf_report');
        $scope.PMS_pdf_view       = $cookies.get('PMS_pdf_view');
        $scope.QC_pdf_report      = $cookies.get('QC_pdf_report');
        $scope.QC_pdf_view       = $cookies.get('QC_pdf_view');
        $scope.Condemnation_pdf_report    = $cookies.get('Condemnation_pdf_report');
        $scope.Condemnation_pdf_view    = $cookies.get('Condemnation_pdf_view');
        $scope.Indent_pdf_report   = $cookies.get('Indent_pdf_report');
        $scope.Indent_pdf_view    = $cookies.get('Indent_pdf_view');
        $scope.CEAR_pdf_report    = $cookies.get('CEAR_pdf_report');
        $scope.CEAR_pdf_view   = $cookies.get('CEAR_pdf_view');
        $scope.Indent_pdf_report   = $cookies.get('Indent_pdf_report');
        $scope.Add_Deployment  = $cookies.get('Add_Deployment');
        $scope.View_Deployment = $cookies.get('View_Deployment');
        $scope.View_City  = $cookies.get('View_City');
        $scope.View_Viabilty = $cookies.get('View_Viabilty');
        $scope.Viability_Generate_PDF  = $cookies.get('Viability_Generate_PDF');
        $scope.Edit_Viability  = $cookies.get('Edit_Viability');
        $scope.Add_Viability = $cookies.get('Add_Viability');
        $scope.Renew_Contracts = $cookies.get('Renew_Contracts');
        $scope.Edit_Contracts  = $cookies.get('Edit_Contracts');
        $scope.Add_Contracts  = $cookies.get('Add_Contracts');
        $scope.View_Condemnation = $cookies.get('View_Condemnation');
        $scope.Approve_Condemnation = $cookies.get('Approve_Condemnation');
        $scope.Edit_Condemnation  = $cookies.get('Edit_Condemnation');
        $scope.View_Transfer = $cookies.get('View_Transfer');
        $scope.Edit_Transfer = $cookies.get('Edit_Transfer');
        $scope.View_Print  = $cookies.get('View_Print');
        $scope.print_Equipment = $cookies.get('print_Equipment');
        $scope.View_Equipment = $cookies.get('View_Equipment');
        $scope.Replace_Equipment = $cookies.get('Replace_Equipment');
        $scope.Edit_Equipment = $cookies.get('Edit_Equipment');
         $scope.View_Equipment = $cookies.get('View_Equipment');
        $scope.View_Gatepass = $cookies.get('View_Gatepass');
        $scope.Edit_Gatepass = $cookies.get('Edit_Gatepass');
        $scope.Add_Gatepass = $cookies.get('Add_Gatepass');
        $scope.Approve_Cear = $cookies.get('Approve_Cear');
        $scope.View_Cear = $cookies.get('View_Cear');
        $scope.Edit_Cear = $cookies.get('Edit_Cear');
        $scope.Stock_Indent = $cookies.get('Stock_Indent');
        $scope.Transfer_Indent = $cookies.get('Transfer_Indent');
        $scope.Sanctioned_Indent = $cookies.get('Sanctioned_Indent');
        $scope.Sanction_Indent = $cookies.get('Sanction_Indent');
        $scope.Indent_PDF_Generated = $cookies.get('Indent_PDF_Generated');
        $scope.Rise_Cear = $cookies.get('Rise_Cear');
        $scope.Approve_Indent = $cookies.get('Approve_Indent');
        $scope.Viability_pdf_view = $cookies.get('Viability_pdf_view');
		


        /* permissions begin */
        $scope.can_req_indent = $cookies.get('can_req_indent'); //
        $scope.add_country = {country_name:"",country_code:""};
        $scope.can_approve_indent = $cookies.get('can_approve_indent'); //
        $scope.can_add_cear = $cookies.get('can_add_cear'); //
        $scope.can_approve_cear = $cookies.get('can_approve_cear');
        $scope.can_add_purchase = $cookies.get('can_add_purchase');
        $scope.can_approve_purchase = $cookies.get('can_approve_purchase'); //
        $scope.can_update_purchase = $cookies.get('can_update_purchase');
        $scope.can_add_purchase_to_stock = $cookies.get('can_add_purchase_to_stock');
        $scope.can_add_equp = $cookies.get('can_add_equp'); // already in menu
        $scope.can_update_equp = $cookies.get('can_update_equp'); //
        $scope.can_update_gatepass = $cookies.get('can_update_gatepass'); //
        $scope.can_transfer_within_unit = $cookies.get('can_transfer_within_unit');
        $scope.can_transfer_other_unit = $cookies.get('can_transfer_other_unit');
        $scope.can_request_condemnation = $cookies.get('can_request_condemnation');//
        $scope.can_approve_condemnation = $cookies.get('can_approve_condemnation');//
        $scope.can_close_condemnation = $cookies.get('can_close_condemnation');//
        $scope.can_print_qr = $cookies.get('can_print_qr');  // already in menu
        $scope.can_print_pmscal = $cookies.get('can_print_pmscal'); // already in menu
        $scope.can_add_contract = $cookies.get('can_add_contract');//
        $scope.can_renew_contract = $cookies.get('can_renew_contract');//
        $scope.can_close_contract = $cookies.get('can_close_contract');//
        $scope.can_add_adverse = $cookies.get('can_add_adverse');//
        $scope.can_approve_adverse = $cookies.get('can_approve_adverse');//
        $scope.can_close_adverse = $cookies.get('can_close_adverse');//
        $scope.can_add_viability = $cookies.get('can_add_viability'); //
        $scope.can_approve_viability = $cookies.get('can_approve_viability');
        $scope.show_ns_calls = $cookies.get('show_ns_calls');
        $scope.show_pms_calls = $cookies.get('show_pms_calls');
        $scope.show_calibration_calls = $cookies.get('show_calibration_calls');
        $scope.can_add_training = $cookies.get('can_add_training'); //
        $scope.can_approve_training = $cookies.get('can_approve_training'); //
        /* permissions end */

        $scope.indent_elements = {dept_id: "",branch_id: $scope.user_branch};
        $scope.stock_elements = {dept_id: "",branch_id: $scope.user_branch};
        $scope.dept_device_search = {
            eqpid: "",
            dept_id: "",
            branch_id: $scope.user_branch,
            spono: "",
            saccessoriesno: ""
        };
        $scope.user_branch_name = $cookies.get('user_branch_name');
        $scope.user_role_code = $cookies.get('user_role_code');
        $scope.indent_equipment = {};
        $scope.edit_indent_equipment = {};
        $scope.update_indent_equipment = {};
        $scope.HBBME = 'HBBME';
        $scope.HBHOD = 'HBHOD';
        $scope.HBUSER = 'HBUSER';
        $scope.HA_ADMIN = 'HA_ADMIN';
        $scope.HMADMIN = 'HMADMIN';
        $scope.Add    = 'Add';
        $scope.Edit = 'Edit';
        $scope.View = 'View';
        $scope.Renew = 'Renew';
        $scope.GeneratePDF = 'GeneratePDF';
        $scope.PURCHASE = "PURCHASE";
        $scope.VENDOR = "VENDOR";
        $log.log("UserBranch:" + $scope.user_branch);
        $scope.user_org = $cookies.get('user_org');
        $scope.user_path = $cookies.get('user_path');
        $scope.user_role_code = $cookies.get('user_role_code');
        $scope.user_erole_code = $cookies.get('user_erole_code');
        $scope.user_role_priority = $cookies.get('user_role_priority');
        $scope.user_id = $cookies.get('user_id');
        $scope.user_email_id = $cookies.get('user_email_id');
        $scope.user_mobile_no = $cookies.get('user_mobile_no');
        $scope.org_role_main_types = [{code:$scope.HBHOD,value:"Unit Admin"},{code:$scope.HBBME,value:"Under Unit Admin"},{code:$scope.PURCHASE,value:"Purchase"},{code:$scope.HBUSER,value:"User"},{code:$scope.VENDOR,value:"Vendor"}];
    }
    $scope.currentPage = 0;
    $scope.paging = {
        total: 0,
        current: 1
        /*onPageChanged: loadPages,*/
    };
    $rootScope.$on('$stateChangeStart',
        function (event, toState, toParams, fromState, fromParams) {
            $scope.check_session_exists();
            /*$log.log("State Changed From");
             $log.log(fromState);
             $log.log("State Changed To");
             $log.log(toState);*/
            //$scope.add_device={present_condition:'G'};
            $scope.all_cps = [];
            //$scope.add_vendor = {};
            $scope.paging.current = 1;
            $scope.prnt_devices = null;
            $scope.prnt_device_ids = [];
            $scope.pd_selected = [];
            $scope.no_of_recs = 0;
            $scope.add_mcontract = {};
            $scope.gen_call = {};
            $scope.add_mlcontract = {};
            $scope.indent_equipment = {};
            $scope.sub_features_selected = [];
            $scope.features_selected = [];
            $scope.hospital_branch = [];
            //$scope.org_types= {};
            //$scope.dept_device_search = {};
            $scope.searched = {EID: "", CONTACT_PERSON: "", VENDOR: ""};
        });
    /*function loadPages()
     {
     $scope.currentPage = $scope.paging.current;
     }*/
    $scope.cancel = function () {
        $scope.atransfer_status = '';
        $mdDialog.cancel();
    };
	$scope.raise_call = 'SR';
	$scope.assign_call='user';
    $scope.hide = function () {
        $mdDialog.hide();
    };
    $scope.onClickMenu = function () /* Side Menu */ {
        $mdSidenav('left').toggle();
    };
    //$scope.menu = ssSideNav;
    $scope.Other = "Other";

    $scope.searchTerm = '';
    $scope.clearSearchTerm = function () {
        $scope.searchTerm = '';
    };
    $element.find('input').on('keydown', function (ev) {
        ev.stopPropagation();
    });
    $scope.getRoles = function () {
        var send = {action: "get_roles"};
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.roles = angular.fromJson(payload.roles);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.roles = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getOrgRoles = function ()
    {
        var send = {action: "get_org_roles"};
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.org_roles = angular.fromJson(payload.roles);
						$scope.role_labels = angular.fromJson(payload.labels);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.org_roles = null;
						$scope.role_labels = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    // Listen event SS_SIDENAV_CLICK_ITEM to close menu
    /*$rootScope.$on('SS_SIDENAV_CLICK_ITEM', function()
     {
     //console.log('do whatever you want after click on item');
     });*/

    $scope.logout = function () {
        window.localStorage.removeItem("user_menu");
        $rootScope.manin_menu = '';
        var cookies = $cookies.getAll();
        angular.forEach(cookies, function (v, k) {
            $cookies.remove(k);
        });
        window.location.href = "auth/logout";

        /* if($cookies.get('user_id')==undefined || $cookies.get('user_id')=="")
         {
         $state.go('login');
         } */
    };
    $scope.myDate = new Date();
    $scope.maxDate = new Date(
        $scope.myDate.getFullYear(),
        $scope.myDate.getMonth(),
        $scope.myDate.getDate());
    $scope.minDate = new Date(
        $scope.myDate.getFullYear(),
        $scope.myDate.getMonth(),
        $scope.myDate.getDate());
    $scope.weekDate = new Date(
        $scope.myDate.getFullYear(),
        $scope.myDate.getMonth(),
        $scope.myDate.getDate() + 7);

	$scope.monthDate = new Date(
        $scope.myDate.getFullYear(),
        $scope.myDate.getMonth()+1,
        $scope.myDate.getDate());
    $scope.isvisiblevalue = '+';
    $scope.ShowHide = function () {
        //If DIV is visible it will be hidden and vice versa.
        $scope.IsVisible = $scope.IsVisible ? false : true;
        if ($scope.IsVisible == true) {
            $scope.isvisiblevalue = '-';
        }
        else {
            $scope.isvisiblevalue = '+';
        }
    };
	
	$scope.addNewChoice = function() {
        var newItemNo = $scope.choices.length+1;
        var maxfileds  = 5;
        $scope.choices.push({'id':'choice'+newItemNo});
    };
    $scope.removeChoice = function() {
        var lastItem = $scope.choices.length-1;

        if (lastItem >= 1) {
            $scope.choices.splice(lastItem, 1);
        }
        //  $scope.choices.splice(lastItem,1);
    };
    $scope.choices = [{id: 'choice'}];
	
	$scope.search_apt_dates = {search_apt_date_of_apt_from:$scope.maxDate,search_apt_date_of_apt_to:$scope.monthDate};
    $scope.nullValue = "";
    $scope.dash = "-";
    $scope.estatuss = [{"estatus": "Working"}, {"estatus": "Not Working"}];
    $scope.ticket_sts = ["Working", "Not Working", "Under Maintenance"];
    $scope.apt_statuss = ["Progress", "Not Yet Started", "Closed"];
    $scope.ticket_sts1 = ["Closed", "Open", "Pending"];
    $scope.admin_calls_select = ["My Calls", "All Calls"];
    $scope.hod_calls_select = ["My Calls", "All Calls","Assigned Calls"];
    $scope.org_types = ["General", "Vendor", "Hospital"];
    $scope.months = ["Year", "Month", "Day"];
    $scope.hod_call_selected = null;
    $scope.admin_call_selected = null;
    if ($scope.user_role_code == $scope.HMADMIN) {
        $scope.admin_call_selected = $scope.admin_calls_select[0];
    }
    else {
        $scope.admin_call_selected = null;
    }
    if ($scope.user_role_code == $scope.HBHOD) {
        $scope.hod_call_selected = $scope.hod_calls_select[0];
    }
    else {
        $scope.hod_call_selected = null;
    }
    $scope.expires = [{"code": "15", value: "15 Days"}, {"code": "30", value: "1 Month"}, {
        "code": "90",
        value: "3 Months"
    }, {"code": "180", value: "6 Months"}, {"code": "1", value: "Expired"}];
    $scope.amc_status = [{"code": "O", value: "Open"},{"code": "C", value: "Close"},{"code": "F",value: "Forceclose"}];
    $scope.user_statues = [{ID: "A", VALUE: "Active"}, {ID: "I", VALUE: "Inactive"}];
    $scope.pmscounts = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    $scope.qcscounts = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
	$scope.years  = [1,2,3,4,5,6,7,8,9,10];
    $scope.months_values = [1,2,3,4,5,6,7,8,9,10,11,12];
    $scope.days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
    $scope.feedback_counts = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
    $scope.equpclasses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $scope.transfer_types = ["Returnable", "Non-Returnable"];
    $scope.transfer_types_view = ["R", "NR"];
    $scope.cear_conformations = ["YES", "NO"];
    $scope.cnf_general_asset = ["YES", "NO"];
    $scope.transfers = ["with in Unit", "Other Unit"];
    $scope.transfers_status = ["Approved", "Disapproved", "Requests"];
    $scope.trngstatuss = ["Approved", "Cancelled", "Pending"];
    $scope.transfer_statuss = ["Approved", "Disapproved"];
    $scope.condemnation_statuss = ["Approved", "Disapproved"];
    $scope.indent_statuss = ["Approved", "Disapproved"];
    $scope.indent_statuss_new = [{key:"Approve",value:$scope.indent_statuss[0]},{key:"Disapprove",value:$scope.indent_statuss[1]}];
    $scope.indent_sactioned_statuss = ["Sanctioned", "NotSanctioned"];
    $scope.indent_sactioned_statuss_new = [{key:"Sanction",value:$scope.indent_sactioned_statuss[0]},{key:"Unsanction",value:$scope.indent_sactioned_statuss[1]}];
    $scope.indent_requests = ["Equipment", "Spares", "Accessories"];
    $scope.pms_types = ["Pending", "Completed"];
    $scope.sheduled_types = ["PMS", "Calibration"];
    $scope.cause_probabilitys = ["Untrained Operator", "Negligence","Accident","Patient Emergency","Willful"];
	$scope.org_modules = ['BIOMEDICAL','IT','GENERAL'];
    $scope.nreports = ["Minor", "Serious","Major"];
    $scope.trngstatus_updates = [{key:"Approved",name:'Approve'},{key:"Cancelled",name:'Cancel'},{key:"Pending",name:'Pending'}];
    $scope.rounds_status = ["temporary", "permanent"];
    $scope.equipment_deploy_condition = ["New", "Exsits"];
    $scope.time_types = ['Minutes', 'Hours', 'Days'];
    $scope.statuss = ['Active', 'Inactive'];
    $scope.ROUND = 'round';
    $scope.Vendor = 'Vendor';
    $scope.call_alert_type = ["responded", "attended", "pending"];
    $rootScope.emptydata = "empty";
    $rootScope.errordata = "error";
    $rootScope.exsitsdata = "exists";
    $rootScope.yesstate = 'YES';
    $rootScope.nostate = 'NO';
    $scope.yesstate = $rootScope.yesstate;
    $scope.nostate = $rootScope.nostate;
    $scope.inhouse = 'Inhouse';
    $scope.company = 'Company';
    $scope.add_device = {};
    $scope.replace_device = {};
    $scope.add_device.device_remarks = "";
    $scope.add_device.description = "";
    $scope.devicedocfiles = [];
    $scope.allValue = "ALL";
    $scope.all = "ALL";
    $scope.select_department = "Total Summary";
    $scope.equp_summary_dept = "Total Summary";
    $scope.esearch = {eqpid: "", saccessoriesno: "", spono: ""};
    $scope.sequp_depts = null;
    $scope.cg_rdevices = null;
    $scope.tc_devices = null;
    $scope.unit_devices = null;
    $scope.after_respond = 'after_respond';
    $scope.before_respond = 'before_respond';
    $scope.make_pending_call = 'make_pending_call';
    $scope.complete_call = 'complete_call';
    $scope.select_selected = 'selected';
    $scope.searched = {EID: "", CONTACT_PERSON: "", VENDOR: ""};
    $scope.not_found = "not found";
    $scope.ed_pms = {};
    $scope.ed_qc = {};
    $scope.add_user = {};
    $scope.add_havendor = {};
    $scope.edit_cond_reasons = {};
    $scope.approved_condmnation = {};
    $scope.edit_condmnation_req = {};
    $scope.mprsdate = $scope.minDate;
    $scope.transfer_search = {fromdate: "", todate: "", unit_type: "", branch_id: $scope.user_branch, limit_val: 0};
    $scope.compelted_transfers_search = {
        fromdate: "",
        todate: "",
        ttype: "",
        branch_id: $scope.user_branch,
        limit_val: 0
    };
    $scope.completed_condemnations_search = {fromdate: "", todate: "", branch_id: $scope.user_branch, limit_val: 0};
    $scope.condimnation_search = {fromdate: "", todate: "", reasons: "", branch_id: $scope.user_branch};
    $scope.condimnation_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.adverse_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.gatepass_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.viability_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.transfer_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.cear_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.indent_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.rounds_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.contracts_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.install_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.sheduled_search_new = {fromdate: "", todate: "", dept_id: "",schedule_type:$scope.sheduled_types[0],limit_val: 0};
    $scope.non_sheduled_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.generated_search_new = {fromdate: "", todate: "", dept_id: "",limit_val: 0};
    $scope.gen_call = {};
    $scope.nature_of_calls = ["IN", "TR", "NS", "CN"];
    $scope.vendor_search = {type: [], contact_person: "", vendor_name: "", branch_id: $scope.user_branch, limit_val: 0};
    $scope.respondcall_search = {
        fromdate: "",
        todate: "",
        department: "",
        eqpid: "",
        branch_id: $scope.user_branch,
        limit_val: 0
    };
    $scope.attendedcall_search = {
        fromdate: "",
        todate: "",
        department: "",
        eqpid: "",
        branch_id: $scope.user_branch,
        limit_val: 0
    };
    $scope.pprocesscall_search = {
        fromdate: "",
        todate: "",
        department: "",
        eqpid: "",
        branch_id: $scope.user_branch,
        limit_val: 0
    };
    $scope.completecall_search = {
        fromdate: new Date(),
        todate: new Date(),
        department: "",
        eqpid: "",
        branch_id: $scope.user_branch,
        limit_val: 0
    };
    $scope.rounds_completed_search = {
        fromdate: "",
        todate: "",
        department: "",
        branch_id: $scope.user_branch,
        limit_val: 0
    };
    $scope.pendingpms_search = {
        fromdate: "",
        todate: "",
        department: "",
        eqpid: "",
        branch_id: $scope.user_branch,
        limit_val: 0
    };
	
	 $scope.pendingscheduled_search = {
        fromdate: "",
        todate: "",
        department: "",
        eqpid: "",
        branch_id: $scope.user_branch,
        limit_val: 0
    };
	
    $scope.completedpms_search = {
        fromdate: "",
        todate: "",
        department: "",
        eqpid: "",
        branch_id: $scope.user_branch,
        limit_val: 0
    };
    $scope.completedqcs_search = {
        fromdate: "",
        todate: "",
        department: "",
        eqpid: "",
        branch_id: $scope.user_branch,
        limit_val: 0
    };
    $scope.pendingqc_search = {
        fromdate: "",
        todate: "",
        department: "",
        eqpid: "",
        branch_id: $scope.user_branch,
        limit_val: 0
    };
    $scope.deployment_devices = {po_no: "", serial_no: "", branch_id: $scope.user_branch, limit_val: 0};
    $scope.training_list = {fromdate: new Date(), todate: new Date(), tstatus: $scope.trngstatuss[0]};
    $scope.training_conduct = {fromdate: new Date(), todate: new Date()};
    $scope.training_feedback = {fromdate: new Date(), todate: new Date()};
    $scope.round_start = {departments: "", remarks: "", sugessions: ""};
    $scope.cgsd = {
        device_id: "",
        equp_condition: "",
        device_name: "",
        device_type: "",
        device_company: "",
        cg_equp_depart: ""
    };
	 $scope.depreciation_device_search = {
            eqpid: "",
            dept_id: "",
            equip_name: ""
        };
    $scope.device_vendor_data = null;
    //$scope.user_branch_id = undefined;
    $scope.add_vendor = {vendor_name:'',type:'',mbl_no:'',email:'',address:''};
    //$scope.add_vendor.devices = [];
    $scope.with_in_unit = {};
    $scope.gatepass_req = {};
    $scope.edit_gate_pass = {};
    $scope.edit_within_unit = {};
	$scope.transfer_deploy = {};
    $scope.other_request = {};
    $scope.add_incdent = {};
    $scope.add_mcontract = {};
   // $scope.add_viability = {};
    $scope.edit_mcontract = {};
    $scope.add_r_mcontract = {};
    $scope.condmnation_req = {};
    $scope.edit_cond_approval = {};
    $scope.edit_cond_disapproval = {};
    $scope.incdent = {todate: "", fromdate: "", itype: "", equp_id: "", departments: "", branch_id: $scope.user_branch};
    $scope.calllog_report_search = {todate: "", fromdate: "", contract_type: "", equp_id: "", departments: ""};
    $scope.adverseincdent = {todate: "", fromdate: "", itype: "", equp_id: "", departments: "", limit_val: 0};
    //$scope.adverse_report_search1={eqpid:"",dept_id:"",branch_id:$scope.user_branch,spono:"",saccessoriesno:""};
    $scope.adverse_report_search = {eqpid: "", dept_id: "", saccessoriesno:"",spono:"",branch_id: $scope.user_branch};
    $scope.viabilty_report_search = {
        eqpid: "",
        ename: "",
        saccessoriesno: "",
        dept_id: "",
        branch_id: $scope.user_branch
    };
    $scope.deployement_report_search = {
        eqpid: "",
        ename: "",
        saccessoriesno: "",
        dept_id: "",
        branch_id: $scope.user_branch
    };
    $scope.re_deployement_report_search = {
        eqpid: "",
        ename: "",
        saccessoriesno: "",
        dept_id: "",
        branch_id: $scope.user_branch
    };
    $scope.equp_report_search = {eqpid: "", ename: "", saccessoriesno: "", dept_id: "", branch_id: $scope.user_branch};
    $scope.cms_report_search = {eqpid: "", ename: "", saccessoriesno: "", dept_id: "", branch_id: $scope.user_branch};
    $scope.pms_report_search = {eqpid: "", dept_id: "", branch_id: $scope.user_branch,pms_type:$scope.pms_types[1]};
    $scope.nscr_report_search = {eqpid: "", dept_id: "", branch_id: $scope.user_branch};
    $scope.scr_report_search = {eqpid: "", dept_id: "", branch_id: $scope.user_branch};
    $scope.qc_report_search = {eqpid: "", dept_id: "", branch_id: $scope.user_branch,qc_type:$scope.pms_types[1]};
    $scope.equp_dwtime_report_search = {eqpid: "", dept_id: "", fromdate: "", todate: "", limit_val: 0};
    $scope.equp_history_report_search = {eqpid: "", dept_id: "", fromdate: "", todate: "", limit_val: 0};
    $scope.cms_report_search = {fromdate: "", todate: ""};
    $scope.condemnation_report_search = {eqpid: "", dept_id: "",ename:"",saccessoriesno:"", branch_id: $scope.user_branch};
    var cftdate = new Date();
    var cfirstDay = new Date(cftdate.getFullYear(), cftdate.getMonth(), 1);
    var clastDay = new Date(cftdate.getFullYear(), cftdate.getMonth() + 1, 0);
    $scope.mcontract = {
        fromdate: "",
        todate: "",
        contract_type: "",
        equp_id: "",
        departments: "",
        limit_val: 0,
        expiry_in: "",
        vendor: ""
    };
    $scope.mdDialogHide = function () {
        $mdDialog.hide();
    };
    /* vendor search */

    $scope.searched.VENDOR = "";
    $scope.searchVname = "";
    $scope.searched.CONTACT_PERSON = "";
    $scope.searchCPname = "";
	
	/*$scope.searched.USER_NAME = "";
	$scope.searchUSER_NAME = "";
	
	
	$scope.searchORG_NAME = "";
    $scope.searched.ORG_NAME = "";	*/
	
	$scope.searched.ECategory = "";
    $scope.searchECategory = "";

    $scope.searched.CompanyName = "";
    $scope.searchCompanyName = "";
	
	$scope.searched.EquipmentType = "";
    $scope.searchEquipmentType= "";

    $scope.searched.Department = "";
    $scope.searchDepartment = "";

    /* equipment search for calls */
    $scope.searchEid = "";
	$scope.searchSerialno = "";
    $scope.searched.sno = "";
    $scope.searched.EID = "";
    $scope.isDisabled = false;
    $scope.noCache = false;
    $scope.scopeadd_device = function () {
        $scope.add_device = {};
    };
    $scope.setPmsQcDate = function (ev, date) {
        if ($scope.add_device.present_condition == 'N') {
            $scope.add_device.pms_date = date;
            $scope.add_device.qc_date = date;
        }
        $scope.end_of_life='';
        console.log('date val');
        console.log(date.getFullYear());
        var eof=date.getFullYear();
        console.log(eof+15);
        var eofyear=eof+15;
        var eofsupp=eof+10;
        dateval=date.getMonth();
        var int_length = (''+dateval).length;
        if(int_length==1){
            dateval = '0'+dateval;
        }
       $scope.add_device.end_of_life=dateval+'-'+eofyear;
        $scope.add_device.end_of_support=dateval+'-'+eofsupp;
    };
	$scope.setPmsQcDate1 = function (ev, date) {
       
		 if ($scope.replace_device.present_condition == 'N') {
            $scope.replace_device.pms_date = date;
            $scope.replace_device.qc_date = date;
        }
        $scope.end_of_life='';
        console.log('date val');
        console.log(date.getFullYear());
        var eof=date.getFullYear();
        console.log(eof+15);
        var eofyear=eof+15;
        var eofsupp=eof+10;
        dateval=date.getMonth();
        if(dateval.length==1){
            dateval = '0'+dateval;
        }
		$scope.replace_device.end_of_life=dateval+'-'+eofyear;
        $scope.replace_device.end_of_support=dateval+'-'+eofsupp;
    };
    $scope.removeDates = function () {
        $scope.add_device.pms_date = '';
        $scope.add_device.qc_date = '';
        $scope.add_device.date_of_install = '';
    };
	$scope.removeDates1 = function () {
        $scope.replace_device.pms_date = '';
        $scope.replace_device.qc_date = '';
        $scope.replace_device.date_of_install = '';
    };
    $scope.UndeployedDevices = function (limit_val) {
        if (typeof limit_val === 'undefined')
            $scope.deployment_devices.limit_val = 0;
        else if (limit_val == 0)
            $scope.deployment_devices.limit_val = 0;
        else
            $scope.deployment_devices.limit_val = limit_val - 1;
        $log.error($scope.deployment_devices.limit_val);
        //$scope.vendors = "Fetching Data, Please Wait...";
        $log.log($scope.searched);
        $scope.deployment_devices.action = "get_undeployed_equipments";
        $scope.deployment_devices.branch_id = $scope.user_branch;
        console.log(JSON.stringify($scope.deployment_devices));

        baseFactory.deviceCall($scope.deployment_devices)
            .then(function (payload) {
                    $log.error(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.ud_devices = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.ud_devices = null;
                        $scope.paging.total = $scope.paging.current = $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getDeviceDetails = function (eid) {
        var data = {};
        data.esid = eid;
        data.action = "search_by_equp_aid";
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.deploy_device = angular.fromJson(payload.list);
                        if ($scope.deploy_device.DATEOF_INSTALL != '' && $scope.deploy_device.DATEOF_INSTALL != null) {
                            $scope.deploy_device.dateof_install = new Date($scope.deploy_device.DATEOF_INSTALL);
                        }
                        else {
                            $scope.deploy_device.dateof_install = '';
                        }
                        $state.go("home.equipment_save_and_deploy");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.deploy_device = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    /*$scope.getDeviceDetailsByEID=function(deptid,eid)
     {
     var data = {};
     data.esid = eid;
     data.dept_id = deptid;
     data.action="search_by_equp_eid";
     baseFactory.deviceCall(data)
     .then(function(payload)
     {
     if(payload.response==$rootScope.successdata)
     {
     var ai_device = angular.fromJson(payload.list);
     $scope.add_incdent.equp_name = ai_device.E_NAME;
     $scope.add_incdent.equp_model = ai_device.E_MODEL;
     $scope.add_incdent.srial_no = ai_device.ES_NUMBER;
     $scope.add_incdent.ctype = ai_device.AMC_TYPE;

     }
     else if(payload.response==$rootScope.emptydata)
     {
     //$scope.toast_text = "No Device Found";
     //$scope.showToast();
     $scope.add_incdent.equp_name = "";
     $scope.add_incdent.equp_model = "";
     $scope.add_incdent.srial_no = "";
     $scope.add_incdent.ctype = "";
     }
     },
     function(errorPayload)
     {
     $log.error('failure loading', errorPayload);
     });
     };*/

    $scope.userUnits = function () {
        var send = {};
        send.action = "get_user_units";
        $log.log(JSON.stringify(send));
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.device_update == $rootScope.successdata) {

                    }
                    else if (payload.device_update == $rootScope.failedata) {

                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

	$scope.getDeviceDetailByEID = function(eid){

	    //console.log("get device callsed");
        //console.log(JSON.stringify(eid));
        if(eid == undefined)
            return false;

        var epid = eid.E_ID;
        var data = {eqpid:epid,action:"get_equp_details"};

        //console.log("get device details ");
        //console.log(JSON.stringify(data));
        baseFactory.UserCtrl(data).then(
            function(payload){
                // console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    var ai_device = angular.fromJson(payload.list);
                    $scope.gen_call.sequp_name = ai_device.E_NAME;
                    $scope.gen_call.ssrial_no = ai_device.ES_NUMBER;
                    $scope.gen_call.sequp_model = ai_device.E_MODEL;
                    $scope.gen_call.sphy_location = ai_device.PHY_LOCATION;
                    $scope.gen_call.dept_id = ai_device.DEPT_ID;
                }

            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });
    };
	$scope.getDeviceDetailBySerial = function(serial){
        var serial_no = serial.ES_NUMBER;
        var data = {sr_no:serial_no,action:"get_equp_details_by_serial"};
        //console.log(data);
        baseFactory.UserCtrl(data).then(
            function(payload){
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    var ai_device = angular.fromJson(payload.list);
                    $scope.gen_call.sequp_name = ai_device.E_NAME;
                    $scope.gen_call.ssrial_no = ai_device.ES_NUMBER;
                    $scope.gen_call.sequp_model = ai_device.E_MODEL;
                    $scope.gen_call.sphy_location = ai_device.PHY_LOCATION;
                    $scope.gen_call.dept_id = ai_device.DEPT_ID;
                    $scope.gen_call.device_id = ai_device.E_ID;
                }

            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });
    };

	$scope.clear_gen_calls = function()
    {
        $scope.gen_call.device_id = "";
        $scope.gen_call.sequp_model = "";
        $scope.gen_call.sequp_name = "";
        $scope.gen_call.ssrial_no="";
        $scope.gen_call.sphy_location="";

    }




    $scope.getDeviceDetailsByEID = function (deptid, eid) {//equipmnet id ki e functin
        var data = {};
        data.esid = eid;
        data.dept_id = deptid;
        data.action = "search_by_equp_eid";
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.error(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        if ($state.is("home.hbbme_generate_call") || $state.is("home.hbhod_generate_call") || $state.is("home.hbbme_incident_call") || $state.is("home.hbbme_non_scheduled_call") || $state.is("home.hbbme_transfer_call") || $state.is("home.hbbme_condemn_call")) {
                            var ai_device = angular.fromJson(payload.list);
                            $scope.gen_call.sequp_name = ai_device.E_NAME;
                            $scope.gen_call.ssrial_no = ai_device.ES_NUMBER;
                            $scope.gen_call.sequp_model = ai_device.E_MODEL;
                            $scope.gen_call.sphy_location = ai_device.PHY_LOCATION;
                        }
                        else if ($state.is("home.transfer_within_unit")) {
                            var ai_device = angular.fromJson(payload.list);
                            $scope.with_in_unit.equp_name = ai_device.E_NAME;
                            $scope.with_in_unit.srial_no = ai_device.ES_NUMBER;
                            $scope.with_in_unit.equp_model = ai_device.E_MODEL;
                            $scope.with_in_unit.srial_no = ai_device.ES_NUMBER;
                            $scope.with_in_unit.phy_location = ai_device.PHY_LOCATION;
                            $scope.with_in_unit.ctype = ai_device.amc_type;
                        }
                        else if ($state.is("home.gate_pass_request")) {
                            var ai_device = angular.fromJson(payload.list);
                            $scope.gatepass_req.equp_name = ai_device.E_NAME;
                            $scope.gatepass_req.srial_no = ai_device.ES_NUMBER;
                            $scope.gatepass_req.equp_model = ai_device.E_MODEL;
                            $scope.gatepass_req.srial_no = ai_device.ES_NUMBER;
                        }
                        else {
                            var ai_device = angular.fromJson(payload.list);
                            $log.info("hii");
                            $log.info(ai_device);
                            $scope.edit_condmnation_req.equp_name = ai_device.E_NAME;
                            $scope.edit_condmnation_req.srial_no = ai_device.ES_NUMBER;
                            $scope.edit_condmnation_req.equp_model = ai_device.E_MODEL;
                            $scope.edit_condmnation_req.srial_no = ai_device.ES_NUMBER;
                            $scope.edit_condmnation_req.po_date = ai_device.PDATE;
                            $scope.edit_condmnation_req.equp_cost = ai_device.E_COST;
                            $scope.edit_condmnation_req.ctype = ai_device.amc_type;

                            $scope.edit_cond_disapproval.equp_name = ai_device.E_NAME;
                            $scope.edit_cond_disapproval.srial_no = ai_device.ES_NUMBER;
                            $scope.edit_cond_disapproval.equp_model = ai_device.E_MODEL;
                            $scope.edit_cond_disapproval.srial_no = ai_device.ES_NUMBER;
                            $scope.edit_cond_disapproval.po_date = ai_device.PDATE;
                            $scope.edit_cond_disapproval.equp_cost = ai_device.E_COST;


                            var ai_device = angular.fromJson(payload.list);
                            $scope.edit_within_unit.equp_name = ai_device.E_NAME;
                            $scope.edit_within_unit.srial_no = ai_device.ES_NUMBER;
                            $scope.edit_within_unit.equp_model = ai_device.E_MODEL;
                            $scope.edit_within_unit.srial_no = ai_device.ES_NUMBER;
                            $scope.edit_within_unit.pono = ai_device.PONO;
                            $scope.edit_within_unit.ctype = ai_device.amc_type;

                            var ai_device = angular.fromJson(payload.list);
                            $scope.add_incdent.equp_name = ai_device.E_NAME;
                            $scope.add_incdent.equp_model = ai_device.E_MODEL;
                            $scope.add_incdent.srial_no = ai_device.ES_NUMBER;
                            $scope.add_incdent.pono = ai_device.PONO;
                            $scope.add_incdent.ctype = ai_device.AMC_TYPE;
                        }
                        if ("home.condemnation_request") {
                            var ai_device = angular.fromJson(payload.list);
                            $scope.condmnation_req.equp_name = ai_device.E_NAME;
                            $scope.condmnation_req.srial_no = ai_device.ES_NUMBER;
                            $scope.condmnation_req.equp_model = ai_device.E_MODEL;
                            $scope.condmnation_req.srial_no = ai_device.ES_NUMBER;
                            $scope.condmnation_req.po_date = ai_device.PDATE;
                            $scope.condmnation_req.equp_cost = ai_device.E_COST;
                            $scope.condmnation_req.ctype = ai_device.amc_type;
                        }
                        else {
                            var ai_device = angular.fromJson(payload.list);
                            $scope.edit_cond_approval.equp_name = ai_device.E_NAME;
                            $scope.edit_cond_approval.srial_no = ai_device.ES_NUMBER;
                            $scope.edit_cond_approval.equp_model = ai_device.E_MODEL;
                            $scope.edit_cond_approval.srial_no = ai_device.ES_NUMBER;
                            $scope.edit_cond_approval.po_date = ai_device.PDATE;
                            $scope.edit_cond_approval.equp_cost = ai_device.E_COST;
                        }
                    }
                    else if ($state.is("home.transfer_within_unit")) {

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        //$scope.toast_text = "No Device Found";
                        //$scope.showToast();
                        $scope.add_incdent.equp_name = "";
                        $scope.add_incdent.equp_model = "";
                        $scope.add_incdent.srial_no = "";
                        $scope.add_incdent.ctype = "";
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.deployDevice = function (ev, deploy_device) {
        deploy_device.action = "device_deployment";
        $log.log(JSON.stringify(deploy_device));
        baseFactory.deviceCall(deploy_device)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.device_update == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $state.go('home.view_devies');
                    }
                    else if (payload.device_update == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.assign_devices ={};
    $scope.edit_vequipment = {};
   /* $scope.editvequipment = function (assign_devices) {
        //  var data = {};
        // data.esid = eid;
        $scope.assign_devices = assign_devices;
        console.log($scope.assign_devices);
        //  return false;
        $state.go("home.edit-vequipment");
        /*
        // data.action = "update_vequipment";
        console.log(data);
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.log(payload);
                    $state.go("home.edit-vequipment");
                    if (payload.response == $rootScope.successdata) {
                       // $scope.edit_vequipment = angular.fromJson(payload.list);
                      /*  if ($scope.deploy_device.DATEOF_INSTALL != '' && $scope.deploy_device.DATEOF_INSTALL != null) {
                            $scope.deploy_device.dateof_install = new Date($scope.deploy_device.DATEOF_INSTALL);
                        }
                        else {
                            $scope.deploy_device.dateof_install = '';
                        }
                        $log.log(payload);
                        $state.go("home.edit-vequipment");
                    }
                    else if (payload.response == $rootScope.failedata) {
                      //  $scope.edit_vequipment = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };*/
    $scope.editvequipment = function (ev, assign_devices)
    {
       // console.log(JSON.stringify(assign_devices));

        $scope.edit_vequipment = '';
        $scope.edit_vequipment = assign_devices;
        console.log($scope.edit_vequipment);
        $scope.edit_vequipment.ID = assign_devices.ID;
        $scope.edit_vequipment.ebranch_id = assign_devices.BRANCH_ID;
        $scope.edit_vequipment.eorg_id = assign_devices.ORG_ID;
        $scope.edit_vequipment.dept_id = assign_devices.DEPT_ID;
        $scope.edit_vequipment.general_asset = assign_devices.GENERAL_ASSET;
		$scope.edit_vequipment.category = assign_devices.category;
        $scope.edit_vequipment.cpname = assign_devices.OEM;
        $scope.edit_vequipment.equp_type = assign_devices.equp_type;
        $scope.edit_vequipment.distributor = assign_devices.DISTRIBUTION;
        $scope.edit_vequipment.vendor = assign_devices.vendor;
		$scope.edit_vequipment.MF_DATE = assign_devices.MF_DATE;
		
        if (assign_devices.GRN_DATE != null && assign_devices.GRN_DATE != '')
        {
            $scope.edit_vequipment.GRN_DATE = new Date(assign_devices.GRN_DATE);
        }
        if (assign_devices.DATEOF_INSTALL != null && assign_devices.DATEOF_INSTALL != '')
        {
            $scope.edit_vequipment.DATEOF_INSTALL = new Date(assign_devices.DATEOF_INSTALL);
        }
        if (assign_devices.PDATE != null && assign_devices.PDATE != '')
        {
            $scope.edit_vequipment.PDATE = new Date(assign_devices.PDATE);
        }
        if (assign_devices.LB_DATE != null && assign_devices.LB_DATE != '')
        {
            $scope.edit_vequipment.LB_DATE = new Date(assign_devices.LB_DATE);
        }
        if (!$scope.isEmpty($scope.edit_vequipment.pms))
        {
            $scope.edit_vequipment.PMS_ID = $scope.edit_vequipment.pms[0].ID;
            if($scope.edit_vequipment.pms[0].PMS_DONE != null)
                $scope.edit_vequipment.PMS_DONE = new Date($scope.edit_vequipment.pms[0].PMS_DONE);
            else
                $scope.edit_vequipment.PMS_DONE = '';
            $scope.edit_vequipment.PMS_COUNT = $scope.edit_vequipment.pms[0].PMS_COUNT;
        }
        else {
            $scope.edit_vequipment.PMS_ID = 'new';
            $scope.edit_vequipment.PMS_DONE = '';
            $scope.edit_vequipment.PMS_COUNT = '';
        }

        if (!$scope.isEmpty($scope.edit_vequipment.qc)) {
            $scope.edit_vequipment.QC_ID = $scope.edit_vequipment.qc[0].ID;
            if ($scope.edit_vequipment.qc[0].QC_DONE != null)
                $scope.edit_vequipment.QC_DONE = new Date($scope.edit_vequipment.qc[0].QC_DONE);
            else
                $scope.edit_vequipment.QC_DONE = null;
            $scope.edit_vequipment.QC_COUNT = $scope.edit_vequipment.qc[0].QC_COUNT;
            $scope.edit_vequipment.QC_COUNT_TYPE = $scope.edit_vequipment.qc[0].QC_COUNT_TYPE;
        }
        else {
            $scope.edit_vequipment.QC_ID = 'new';
            $scope.edit_vequipment.QC_DONE = '';
            $scope.edit_vequipment.QC_COUNT = '';
            $scope.edit_vequipment.QC_COUNT_TYPE = '';
        }

        console.log(JSON.stringify($scope.edit_vequipment.amcs));
        if (!$scope.isEmpty($scope.edit_vequipment.amcs)) {
            $scope.getContractVendorDetails($scope.edit_vequipment.amcs[$scope.edit_vequipment.amcs.length - 1].AMC_VENDOR);
            $scope.edit_vequipment.AMC_ID = $scope.edit_vequipment.amcs[$scope.edit_vequipment.amcs.length - 1].ID;
        }
        else {
            $scope.edit_vequipment.AMC_ID = 'new';
        }

        $scope.edit_vequipment.VENDOR = $scope.edit_vequipment.VENDOR;
       /* $scope.edit_vequipment.AMC_TYPE = $scope.edit_vequipment.AMC_TYPE;
        $scope.edit_vequipment.AMC_VALUE = $scope.edit_vequipment.AMC_VALUE;*/
		$scope.edit_vequipment.AMC_TYPE = $scope.edit_vequipment.amcs[0].AMC_TYPE;
        $scope.edit_vequipment.AMC_VALUE = $scope.edit_vequipment.amcs[0].AMC_VALUE;
        $scope.edit_vequipment.AMC_FROM = new Date($scope.edit_vequipment.amcs[0].AMC_FROM);
        $scope.edit_vequipment.AMC_TO = new Date($scope.edit_vequipment.amcs[0].AMC_TO);


        /*if($scope.edit_vequipment.C_FROM != null)
            $scope.edit_vequipment.AMC_FROM = new Date($scope.edit_vequipment.C_FROM);
        else
            $scope.edit_vequipment.AMC_FROM = '';

        if($scope.edit_vequipment.C_TO != null)
            $scope.edit_vequipment.AMC_TO = new Date($scope.edit_vequipment.C_TO);
        else
            $scope.edit_vequipment.AMC_TO = '';*/


        $log.log("going to eidt device");
//        console.log(JSON.stringify($scope.edit_vequipment));
     //   return false;
        $state.go('home.edit-vequipment');
    };

    $scope.device_manuals = [];
    $scope.device_pos = [];
    $scope.device_othr_files = [];
    $scope.vendorassign = function(data)
    {


        var files = [];
        files =  files.concat($scope.device_manuals);
        files =  files.concat($scope.device_othr_files);
        files =  files.concat($scope.device_pos);
        data.action='assign_vendor_device';
        //data.unit_id = $scope.user_branch;
        //data.org_id = $scope.user_org;
      console.log(data);
        /*if(data.AMC_FROM == undefined || data.AMC_TO == undefined )
        {
            $scope.toast_text = "Invalid Date formats, Please select it from datepicker";
            $scope.showToast();
            return false;
        }*/

        baseFactory.addDeviceFileUpload(data,files,'device/assign_vendor_device')
            .then(function(payload)
                {
                     console.log(payload);
                    if (payload.response == $rootScope.successdata){

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
	$scope.searchTextChangeOne = function(str,type){

	    console.log("string "+str+'\n'+" type "+type);

        var data = baseFactory.getSerialno(str,type);
        return data;
    };
    $scope.searchTextChange = function (str, type,type1)
    {
		console.log("dgg");
        var dept = "";
        var branch_id = "";
        //$scope.user_branch = $cookies.get('user_branch');
        if ($state.is("home.hbhod_vendors")) {
            if (type == 'cp') {
				console.log("fdgfh");
                var data = baseFactory.getContactPersonName(str,type);
            }
            else {
                var data = baseFactory.getVendorNames(str);
            }
            return data;
        }
		 else if($state.is("home.hbhod_rounds_assign"))
        {
           if(type == "Department"){
                var data = baseFactory.getDepartment(str);
            }
            else{
                var data = baseFactory.getassignusernames(str);
            }
            return data;
        }
		 else if($state.is("home.depreciation_details")){
            if(type == "Department"){
                var data = baseFactory.getDepartment(str);
            }else if(type == "Eqname"){
                var data = baseFactory.getEquipmentname(str);
            }else{
                var data = baseFactory.getEquipmentbybranch1(str,type,type1);
            }
            return data;
        }
		else if($state.is("home.hbbme_add_asset") || $state.is("home.edit_device") || $state.is("home.edit-vequipment") || $state.is("home.indent_equipment_request")|| $state.is("home.indent_equipment") || $state.is("home.hbhod_add_asset") 
			|| $state.is("home.replace_device")){
           /* if( type == "Ecategory"){
                var data = baseFactory.getequipmentcategory(str);
            }else if(type == "Companyname"){
                var data = baseFactory.getcompanynames(str);
            } else if(type == "Department"){
                var data = baseFactory.getDepartment(str);
            }else if(type == "EType"){
                var data = baseFactory.getEquipmentType(str);
				
            }else if(type == "Distributor"){
				var data = baseFactory.getdistributerlist(str);
			}
			else{
				var data = baseFactory.getassignvendornames(str);
			}*/
			
			var data =  baseFactory.getorgmastertable(str);
			
            return data;
        }
		else if($state.is("home.hbbme_today_calls"))
        {
            if(type == 'up'){
                var data = baseFactory.getassignvendornames(str);
            }else{
                var data = baseFactory.getassignusernames(str);
            }
            return data;
        }
		else if($state.is("home.hbbme_generate_call")){

            console.log("string "+str+'\n'+" type "+type);
            var data = baseFactory.getEquipmentbybranch(str,type);
            // console.log(JSON.stringify(data));
            return data;
        }
		
         else if($state.is("home.hbbme_incident_call"))
        {

            var data = baseFactory.getEquipmentbybranch(str,type);


            return data;
        }
        else if($state.is("home.hbbme_transfer_call"))
        {

            var data = baseFactory.getEquipmentbybranch(str,type);


            return data;
        }
        else if($state.is("home.hbbme_non_scheduled_call"))
        {

            var data = baseFactory.getEquipmentbybranch(str,type);


            return data;
        }
        else if($state.is("home.hbbme_condemn_call"))
        {

            var data = baseFactory.getEquipmentbybranch(str,type);


            return data;
        }
		else if($state.is("home.hbhod_training_feedback")){
			var data =baseFactory.getassignvendornames(str);
			return data;
		}
        else if ($state.is("home.hbbme_responded_calls") || $state.is("home.hmadmin_responded_calls") || $state.is("home.hbhod_responded_calls")) {
			if(type == 'up'){
				
			 var data = baseFactory.getassignvendornames(str);
			}else{
				console.log("gfg");
				var data = baseFactory.getassignusernames(str);
			}
            branch_id = $scope.respondcall_search.branch_id;
            dept = $scope.respondcall_search.department;
			return data;
        }
		else if($state.is("home.open_calls")){
			
			if(type == 'up'){
				
			 var data = baseFactory.getassignvendornames(str);
			}else{
				 console.log("fg");
				var data = baseFactory.getassignusernames(str);
			}
			return data;
		}
		
		else if($state.is("home.condemnation_calls"))
		{
			var data = baseFactory.getDepartment(str);
			return data;
		}
		
		else if($state.is("home.adverse_calls")){
			
			if(type == 'up'){
				
			 var data = baseFactory.getassignvendornames(str);
			}else{
				 console.log("fg");
				var data = baseFactory.getassignusernames(str);
			}
			return data;
		}
		
		else if($state.is("home.hbhod_today_calls"))
		{
			if(type == 'up'){
				
			 var data = baseFactory.getassignvendornames(str);
			}else{
				 console.log("fg");
				var data = baseFactory.getassignusernames(str);
			}
			return data;
		}
        else if ($state.is("home.hbbme_attended_calls") || $state.is("home.hmadmin_attended_calls") || $state.is("home.hbhod_attended_calls")) {
            branch_id = $scope.attendedcall_search.branch_id;
            dept = $scope.attendedcall_search.department;
        }
        else if ($state.is("home.hbbme_propen_calls") || $state.is("home.hmadmin_propen_calls") || $state.is("home.hbhod_propen_calls")) {
           
		   if(type == 'up'){
				
			 var data = baseFactory.getassignvendornames(str);
			}else{
				console.log("gfg");
				var data = baseFactory.getassignusernames(str);
			}
           
		   branch_id = $scope.pprocesscall_search.branch_id;
            dept = $scope.pprocesscall_search.department;
			return data;
        }
        else if ($state.is("home.hbbme_completed_calls") || $state.is("home.hbbme_completed_calls") || $state.is("home.hbhod_completed_calls")) {
            branch_id = $scope.completecall_search.branch_id;
            dept = $scope.completecall_search.department;
        }
        else if ($state.is("home.hbbme_pending_pms") || $state.is("home.hmadmin_pending_pms") || $state.is("home.hbhod_pending_pms")) {
            branch_id = $scope.pendingpms_search.branch_id;
            dept = $scope.pendingpms_search.department;
        }
        else if ($state.is("home.hbbme_pending_qcs") || $state.is("home.hmadmin_pending_qcs") || $state.is("home.hbhod_pending_qcs")) {
            branch_id = $scope.pendingqc_search.branch_id;
            dept = $scope.pendingqc_search.department;
        }
		 else if ($state.is("home.hbhod_pending_scheduled")) {
            branch_id = $scope.pendingscheduled_search.branch_id;
            dept = $scope.pendingscheduled_search.department;
        }
        else if ($state.is("home.hbbme_completed_pms") || $state.is("home.hmadmin_completed_pms") || $state.is("home.hbhod_completed_pms")) {
            branch_id = $scope.completedpms_search.branch_id;
            dept = $scope.completedpms_search.department;
        }
        else if ($state.is("home.hbbme_completed_qcs") || $state.is("home.hmadmin_completed_qcs") || $state.is("home.hbhod_completed_qcs")) {
            branch_id = $scope.completedqcs_search.branch_id;
            dept = $scope.completedqcs_search.departments;
        }
        else if ($state.is("home.adverse_reports")) {
            branch_id = $scope.adverse_report_search.branch_id;
            //dept = $scope.adverse_report_search.department;
        }
        else if($state.is("home.radverse")) {
            branch_id = $scope.adverse_report_search.branch_id;
			
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
		  }else{
			  console.log("fgfg");
			var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		  }
			return data;
        }
        else if ($state.is("home.rviability")) {
            branch_id = $scope.viabilty_report_search.branch_id;
            dept = $scope.viabilty_report_search.department;
        }
        else if ($state.is("home.deployment")) {
            branch_id = $scope.deployement_report_search.branch_id;
            //dept = $scope.deployement_report_search.department;
        }
		else if($state.is("home.cear")){
			
			var data  = baseFactory.getDepartment(str);
			
		    return data;
		}
	else if($state.is("home.hbbme_print_labels") || $state.is("home.hbhod_print_labels")){
		console.log("fghgh");
		var data  = baseFactory.getDepartment(str);
			
		    return data;
	}
	else if($state.is("home.print_labels_pms_cal")){
		var data  = baseFactory.getDepartment(str);
			
		    return data;
	}
        else if($state.is("home.deployment_report")){
            branch_id = $scope.deployement_report_search.branch_id;
			
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
		  }else{
			  console.log("fgfg");
			var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		  }
			return data;
			
        }
        else if ($state.is("home.rredeployment")) {
            branch_id = $scope.re_deployement_report_search.branch_id;
			
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
		  }else{
			  console.log("fgfg");
			var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		  }
			return data;
			
            //dept = $scope.deployement_report_search.department;
        }
        else if ($state.is("home.requipment_summary")) {
		
            branch_id = $scope.equp_report_search.branch_id;
            //dept = $scope.equp_report_search.department;
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
		  }else{
			  console.log("fgfg");
			var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		  }
			return data;
        }
        else if($state.is("home.indent_equipment")){
          //  branch_id = $scope.update_indent_equipment.branch_id;
            branch_id = $scope.user_branch;
        }
       else if($state.is("home.equp_down_time")){
            branch_id = $scope.equp_dwtime_report_search.branch_id;
			
            //dept = $scope.equp_report_search.department;
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
		  }else{
			
			var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		  }
			return data;
			
        }
        else if($state.is("home.equp_history_card"))
        {
            branch_id = $scope.equp_history_report_search.branch_id;
			
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
		  }else{
			 
			var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		  }
			return data;
        }
        else if($state.is("home.rservices"))
        {
            branch_id = $scope.deployement_report_search.branch_id;
			
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
		  }else{
			  console.log("fgfg");
			var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		  }
			return data;
        }
        else if ($state.is("home.rcondemnation")) {
            branch_id = $scope.condemnation_report_search.branch_id;
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
		  }else{
			  console.log("fgfg");
			var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		  }
			return data;
			
            //dept = $scope.deployement_report_search.department;
        }
        else if($state.is("home.call_log_reports")){
			
			branch_id = $scope.calllog_report_search.branch_id;
			
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
			
		  }else if(type=='Vendor'){
		      
		      var data = baseFactory.getassignvendornames(str);
		  }else{
			  console.log("fgfg");
			var data = baseFactory.getEquipment(str,dept,branch_id,user_id,org_id);
		  }
			return data;
        }
        else if ($state.is("home.pms_report")) {
            branch_id = $scope.pms_report_search.branch_id;
			
			
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
		  }else{
			  console.log("fgfg");
			var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		  }
			return data;
            //dept = $scope.pms_report_search.department;
        }
		else if($state.is("home.transfer_calls"))
		{
			var data = baseFactory.getDepartment(str);
			return data;
		}
        else if ($state.is("home.rnscreport")) {
            branch_id = $scope.nscr_report_search.branch_id;
            //dept = $scope.nscr_report_search.department;
        }
        else if ($state.is("home.rscreport")) {
            branch_id = $scope.scr_report_search.branch_id;
            //dept = $scope.scr_report_search.department;
        }
        else if($state.is("home.rpms")){
            branch_id = $scope.pms_report_search.branch_id;
			
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
		  }else{
			  console.log("fgfg");
			var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		  }
			return data;
			
        }
        else if ($state.is("home.rqc")) {
            branch_id = $scope.qc_report_search.branch_id;
			
			var user_id = $scope.user_id;
            var org_id = $scope.user_org;
		  if(type=='Department'){
			  var data = baseFactory.getDepartment(str);
		  }else{
			  console.log("fgfg");
			var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		  }
			return data;
            //dept = $scope.qc_report_search.department;
        }
        else if ($state.is("home.observations")) {
            branch_id = $scope.user_branch;
            // dept = $scope.adverseincdent.departments;
        }
        else if($state.is("home.vendor_maintain_contracts")){

            branch_id = $scope.user_branch;
            var user_id = $scope.user_id;
            var org_id = $scope.user_org;
            var data = baseFactory.getEquipment(str,dept,branch_id,user_id,org_id);
        }
        else if ($state.is("home.maintain_contracts")) {
            if (type == 'vendor') {
                var data = baseFactory.getassignvendornames(str);
		   }
			else if(type=='vendor1')
			{
				var data = baseFactory.getdistributerlist(str);
			}
            else {

                branch_id = $scope.user_branch;
                var user_id = $scope.user_id;
                var org_id = $scope.user_org;
                var data = baseFactory.getEquipment(str,dept,branch_id,user_id,org_id);

            }
			return data;
        }
        else if ($state.is("home.add_maintain_contracts")) {
            branch_id = $scope.add_mcontract.branch_id;
			
			if(type=='Vendor2')
			{
				console.log("dgdfg");
				var data = baseFactory.getassignvendornames(str);
			}
			else{
				
			var data = baseFactory.getEquipmentbybranch(str,type);
			}
			return data;
        }
		
		else if($state.is("home.add_multiple_contracts"))
		{
			console.log("dfgdf");
			if(type=='Vendor')
			{
				console.log("dgdf");
				var data = baseFactory.getassignvendornames(str);
			}
			else
			{
				console.log("fgfg");
				var data = baseFactory.getEquipmentbybranch(str,type);
			}
		
		         return data;
		
		}
		
		else if($state.is("home.gate_pass_request")){
			
			if(type=='Department')
			{
				console.log("fghfd");
				var data = baseFactory.getDepartment(str);
			}else{
				console.log("fgdgg");
				var data = baseFactory.getEquipmentbybranchdept(str,type,type1);
				
			}
			
			
			return data;
		}
		else if($state.is("home.add_classification"))
		{
			if(type=='Department')
			{
				
				var data = baseFactory.getDepartment(str);
			}
			else
			{ 
		           
			    	var data = baseFactory.getEquipmentbybranchdept(str,type,type1);
			}
			
			return data;
		}
		
		else if($state.is("home.classifications"))
		{
			if(type=='Department')
			{
				
				var data = baseFactory.getDepartment(str);
			}
			else
			{ 
		           
			    	var data = baseFactory.getEquipmentbybranchdept(str,type,type1);
			}
			
			return data;
		}
		
		else if($state.is("home.add_viabilty"))
		{
			if(type=='Department')
			{
				
				var data = baseFactory.getDepartment(str);
			}
			else
			{ 
		           
			    	var data = baseFactory.getEquipmentbybranchdept(str,type,type1);
			}
			
			return data;
		}
		else if($state.is("home.viability"))
		{
			
			if(type=='Department')
			{
				
				var data = baseFactory.getDepartment(str);
			}else
			{
				console.log("fd");	
				var data = baseFactory.getEquipmentbybranchdept(str,type,type1);
			}

			return data;
		}
        else if ($state.is("home.incident"))
        {
            branch_id = $scope.user_branch;

            dept = $scope.add_incdent.departments;
        }
        else if ($state.is("home.add_viabilty") || $state.is("home.rredeployment"))
        {
            branch_id = $scope.user_branch;
            dept = "";
        }
        else {
            dept = "";
            branch_id = "";
        }
        var user_id = $scope.user_id;
        var org_id = $scope.user_org;
        var data = baseFactory.getEquipment(str, dept,branch_id,user_id,org_id);
		//var data = baseFactory.getassignvendornames(str);
        return data;
    };

    $scope.getDepartmentByID = function(deptid)
    {
        console.log(deptid);
        $scope.loadDEpatmentsList(1,deptid)

    }

    $scope.searchDeptChange = function(query) {
        var results = query ? $scope.deptStates.filter( createFilterFor(query) ) : $scope.deptStates,
            deferred;
        if (self.simulateQuery) {
            deferred = $q.defer();
            $timeout(function () { deferred.resolve( results ); }, Math.random() * 1000, false);
            return deferred.promise;
        } else {
            return results;
        }
    }

    function createFilterFor(query) {
        var lowercaseQuery = angular.lowercase(query);
        return function filterFn(deptStates) {
            return (deptStates.param.indexOf(lowercaseQuery) === 0);
        };
    }

    $scope.deptStates = [];
    $scope.loadDeptStates = function()
    {
        for(var i = 0; i < $scope.depts.length; i++)
        {
            if($scope.depts[i]['USER_DEPT_NAME'] != null && $scope.depts[i]['USER_DEPT_NAME'] != '') {
                $scope.deptStates.push({
                    value: $scope.depts[i]['ID'],
                    param: $scope.depts[i]['USER_DEPT_NAME'].toLowerCase(),
                    display: $scope.depts[i]['USER_DEPT_NAME']
                });
            }
        }
    }


    $scope.excelReport = function(depart_devices) {
        var depart_device_view = '';
        var civval = cival = msval = crval = '';

        $scope.ebd = $scope.ci = $scope.ms = $scope.cr = $scope.doc = [];

        for(var i = 0; i < depart_devices.length; i++)
        {
            depart_device_view = depart_devices[i];
            $scope.ebd = $scope.ebd.concat([{
                "Equipment ID": depart_device_view['E_ID'],
                "Hospital Asset Code": depart_device_view['MF_DATE'],
                "Branch": depart_device_view['branch_name'],
                "Equipment Name": depart_device_view['E_NAME'],
                "Equipment Category": depart_device_view['category'],
                "Company Name": depart_device_view['OEM'],
                "Distributor": depart_device_view['DISTRIBUTION_BY'],
                "Serial Number": depart_device_view['ES_NUMBER'],
                "Equipment Cost": depart_device_view['E_COST'],
                "Present Condition": depart_device_view['eq_condition'],
                "Utilization": depart_device_view['eq_util'],
                "Department": depart_device_view['DEPT_ID'],
                "Type": depart_device_view['equp_type'],
                "Class": depart_device_view['EQ_CLASS'],
                "Status": depart_device_view['EQ_CONDATION'],
                "Classification": depart_device_view['classification'],
                "Model": depart_device_view['E_MODEL'],
                "Accessories": depart_device_view['ACCSSORIES'],
                "Critical Spares": depart_device_view['CRITICAL_SPARES'],
                "GRN No.": depart_device_view['GRN_VALUE'],
                "GRN Date": depart_device_view['GRN_DATE'],
                "Date of Install": depart_device_view['DATEOF_INSTALL'],
                "Manufacture Date": depart_device_view['MF_DATE'],
                "End of Life": depart_device_view['END_OF_LIFE'],
                "End of Support": depart_device_view['END_OF_SUPPORT'],
                "PO NO": depart_device_view['PONO'],
                "PO Date": depart_device_view['PDATE'],
                "Physical Location": depart_device_view['PHY_LOCATION'],
                "Description": depart_device_view['DESC_P'],
                "Remarks": depart_device_view['REMARKS']
            }]);

            if(depart_device_view['amcs'].length == 0)
                $scope.ci = $scope.ci.concat([{"Equipment ID":depart_device_view['E_ID'],"Vednor":'-',"Contact No":'-',"Email ID":'-',"Contact Person(CP)":'-',"CP No.":'-',"CP Email":'-',"Type":'-',"Value":'-',"From":'-',"To":'-'}]);
            else
            {
                cival = depart_device_view['amcs'];
                $scope.ci = $scope.ci.concat([{"Equipment ID":depart_device_view['E_ID'],
                  /*  "Vednor":cival['cvendor']['CP_NAME'],
                    "Contact No":cival['cvendor']['CP_NUMBER'],
                    "Email ID": cival['cvendor']['CP_EMAIL'],
                    "Contact Person(CP)": cival['cvendor']['contact_person']['CP_NAME'],
                    "CP No.": cival['cvendor']['contact_person_no']['CP_NUMBER'],
                    "CP Email":cival['cvendor']['cp_email']['CP_EMAIL'],
                    "Type":cival['AMC_TYPE'],
                    "Value":cival['AMC_VALUE'],
                    "From":cival['AMC_FROM'],
                    "To":cival['AMC_TO']*/
                }]);
            }

            if(depart_device_view['qc'].length == 0)
                $scope.ms = $scope.ms.concat([{"Equipment ID":depart_device_view['E_ID'],"Type":'-',"ID":'-',"Done":'-',"Actual Done":'-',"Due Date":'-',"Cost":'-'}]);
            else
            {
                msval = depart_device_view['qc'];
                $scope.ms = $scope.ms.concat({"Equipment ID":depart_device_view['E_ID'],
                    "Type":msval['PMS'],
                    "ID":msval['JOB_ID'],
                    "Done":msval['PMS_DONE'],
                    "Actual Done":msval['PMS_ACTL_DONE'],
                    "Due Date":msval['PMS_DUE_DATE'],
                    "Cost":''
                });
            }

            if(depart_device_view['cms_data'].length == 0)
                $scope.cr = $scope.cr.concat([{"Equipment ID":depart_device_view['E_ID'],"Call Date":'-',"Complaint":'-',"Completed By":'-',"Completed Date Time":'-',"DownTime":'-',"Cost":'-'}]);
            else
            {
                crval = depart_device_view['cms_data'];
                $scope.cr = $scope.cr.concat([{"Equipment ID":depart_device_view['E_ID'],
                    "Call Date":crval['CDATE'],
                    "Complaint":crval['NATURE_OF_COMP'],
                    "Completed By":crval['ATTENDED_BY_NAME'],
                    "Completed Date Time":crval['JOBCOMPLETED_DATE'],
                    "DownTime":crval['DOWN_TIME'],
                    "Cost":crval['Cost']
                }]);
            }

            $scope.doc[i] = depart_device_view['docs'];
        }

        var options = [{
            sheetid: 'Equipment Basic Details',
            header: true
        }, {
            sheetid: 'Contract Info',
            header: false
        },{
            sheetid: 'Maintenance Schedule',
            header: false
        },{
            sheetid: 'Call Register',
            header: false
        },{
            sheetid: 'Documents',
            header: false
        }];

        var targetData = [$scope.ebd, $scope.ci, $scope.ms, $scope.cr, $scope.doc];

        ImportExportToExcel.exportToMultipleSheets("device_report", targetData, options);
    }




    /* Print Devices Start */
    $scope.pd_selected = [];
    $scope.prnt_device_ids = [];
    $scope.prnt_devices = "Search For Devices With above Criteria";
    $scope.pd_toggle = function (item, list) {
        var idx = list.indexOf(item);
        if (idx > -1) {
            list.splice(idx, 1);
        }
        else {
            list.push(item);
        }
    };
    $scope.pd_exists = function (item, list) {
        return list.indexOf(item) > -1;
    };
    $scope.pd_isIndeterminate = function () {
        return ($scope.pd_selected.length !== 0 && $scope.pd_selected.length !== $scope.prnt_device_ids.length);
    };
    $scope.pd_isChecked = function () {
        return $scope.pd_selected.length === $scope.prnt_device_ids.length;
    };
    $scope.pd_toggleAll = function () {
        if ($scope.pd_selected.length === $scope.prnt_device_ids.length) {
            $scope.pd_selected = [];
        }
        else if ($scope.pd_selected.length === 0 || $scope.pd_selected.length > 0) {
            $scope.pd_selected = $scope.prnt_device_ids.slice(0);
        }
    };
    $scope.PrintLables = function (pldept) /* Show Device Details with QR details */
    {
        $scope.prnt_devices = "Fetching Data, Please Wait...";
        $scope.prnt_device_ids = [];
        $scope.pd_selected = [];
        $scope.print_lable_branch = $scope.user_branch;
        var send = {dept_id: pldept, branch_id:$scope.user_branch,hospital_id:$scope.user_org, action: "print_labels"};

        console.log(send);
        baseFactory.PrintLables(send)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.prnt_devices = angular.fromJson(payload.devices);
                    angular.forEach(payload.devices, function (value) {
                        $scope.prnt_device_ids.push(value.E_ID);
                    });
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.prnt_devices = "No Devices Found With Your Search";
                    $scope.prnt_device_ids = [];
                    $scope.pd_selected = [];
                }
            });
    };
    $scope.PrintLablesPmsCal = function (pl_depatment) /* Show Device Details with QR details */
    {
        $scope.prnt_devices = "Fetching Data, Please Wait...";
        $scope.prnt_device_ids = [];
        $scope.pd_selected = [];
        $scope.print_lable_branch = $scope.user_branch;
        var send = {dept_id: pl_depatment, branch_id: $scope.user_branch, action: "print_labels_pms_cal"};
        $log.log(send);
        baseFactory.PrintLables(send)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.prnt_devices = angular.fromJson(payload.devices);
                    angular.forEach(payload.devices, function (value) {
                        $scope.prnt_device_ids.push(value.E_ID);
                    });
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.prnt_devices = "No Devices Found With Your Search";
                    $scope.prnt_device_ids = [];
                    $scope.pd_selected = [];
                }
            });
    };
    $scope.getDepartDevices = function (limit_val) /* Show Device Details with QR details */
    {
        $log.log("in side depart_devices\n\n\n");
        if (limit_val != $scope.nostate) {
            if (typeof limit_val === 'undefined')
                $scope.dept_device_search.limit_val = 0;
            else if (limit_val == 0)
                $scope.dept_device_search.limit_val = 0;
            else
                $scope.dept_device_search.limit_val = limit_val - 1;
            $log.error(status);
        }
        else {
            delete $scope.dept_device_search.limit_val;
        }
        $scope.dept_device_search.action = "get_depart_devices";
        $scope.dept_device_search.branch_id = $scope.user_branch;
        console.log("Depart Devices");
        console.log(JSON.stringify($scope.dept_device_search));
        baseFactory.deviceCall($scope.dept_device_search)
        .then(function (payload)
        {
            //console.log(JSON.stringify(payload.devices));
            if (payload.response == $rootScope.successdata) {
                $scope.depart_devices = angular.fromJson(payload.devices);
				$scope.device_labels = angular.fromJson(payload.labels);
                $scope.paging.total = payload.rcnt;
                $scope.no_of_recs = payload.no_of_recs;
            }
            else if (payload.response == $rootScope.emptydata) {
                $scope.depart_devices = null;
				$scope.device_labels = null;
                $scope.paging.total = 0;
                $scope.no_of_recs = 0;
            }
        });
    };
    $scope.wordPrintLables = function () /* Download MSWord */ {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/device/word_print_labels';
        var word_data = angular.toJson($scope.pd_selected);
        var send = {wrd_devices: word_data, branch: $scope.print_lable_branch, action: "word_print_labels"};
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'wdp';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.wordPrintLablesPmsQc = function () /* Download MSWord */ {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/device/word_print_labels_pms_qc';
        var word_data = angular.toJson($scope.pd_selected);
        var send = {wrd_devices: word_data, branch: $scope.print_lable_branch, action: "word_print_labels_pms_qc"};
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'wdp';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.pdfCondemationReportTCPDF = function (condemnation_reports) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/condemnation_repost_pdf';
        var word_data = angular.toJson(condemnation_reports);
        var send = {condem_data: word_data};
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'condem_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.showEqupSummaryPdf = function () /* Download MSWord */ {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/eq_summ_print_pdf';
        var equp_reports_data = $scope.equp_reports_pdfs;
        var send = {equp_reports: equp_reports_data};
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'equp_report_post';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.loadMPReportsTCPDF = function ()
    {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/MPR_report_pdf';
        var send = $scope.mpr_report_pdf_data;
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'mpr';
        child1.value = prev_data2;
        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.pdfViabilityReportTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/viability_report_pdf';
        var word_data = angular.toJson(data);
        var send = {via_data: word_data};
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'via_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };

    $scope.pdfPMSReportTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/pms_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'pms_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.pdfQCReportTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/qc_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'qc_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.pdfIndentReportTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/indent_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'indent_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.pdfCearReportTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/cear_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
       console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'cear_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.pdfDeploymentReportTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/deployement_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'deployement_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.pdfReDeploymentReportTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/redeployement_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'redeployement_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.callLogTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/call_log_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'call_log_data';
        child1.value = prev_data2;
        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.eupDownTimeTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/down_time_data_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'down_time_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.pdfServicesReportTCPDF = function (ev, data) {

        console.log(JSON.stringify(data));
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/service_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'ser_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.pdfStockReportTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/stock_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'new_stock_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.pdfEquipmentHistorytReportTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/device_history_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'dh_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };

    $scope.GatepasspdfNEW = function (data) /* Download MSWord */ {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/gate_pass_pdf';
        var gatepass_data = angular.toJson(data);
        var send = {gate_pass: gatepass_data};
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'gate_post';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };

    $scope.showEqupSummaryPdf = function () /* Download MSWord */ {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/eq_summ_print_pdf';
        var equp_reports_data = $scope.equp_reports_pdfs;
        var send = {equp_reports: equp_reports_data};
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'equp_report_post';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };

    $scope.pdfNSCReportTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/nsc_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'nsc_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.pdfSCReportTCPDF = function (ev, data) {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/sc_report_pdf';
        var word_data = angular.toJson(data);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'sc_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    /* Print Devices End */

    /* add device */
    $scope.addDevice = function (input_data) /* Add device */ {
        var send = {device_data: input_data, action: "add_device"};
        baseFactory.addDevice(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.device_response == $rootScope.successdata) {
                        $mdDialog.show(
                            $mdDialog.alert()
                                .parent(angular.element(document.querySelector('#popupContainer')))
                                .clickOutsideToClose(false)
                                .title('Success')
                                .textContent(input_data.rcename + ' Device Added Successfully.')
                                .ariaLabel('device_add_alert')
                                .ok('OK!')
                            /*.targetEvent(ev)*/
                        );
                    }
                    else if (payload.response == $rootScope.failedata) {

                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
        $state.go("login");
    };

    $scope.loadContracts = function () /* For Contracts */ {

        var send = {action: "get_contract_type"};

        baseFactory.getContractTypes(send)
            .then(function (payload) {
                   // $log.debug(payload);
                      console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.contract_types = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.contract_types = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadPmsDetails = function () /* Pms Details */ {
        var send = {action: "get_pms_data"};
        baseFactory.getPmsDetails(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.pms_count = angular.fromJson(payload.list);
                        console.log($scope.pms_count);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.pms_count = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    /*$scope.loadTrainingTypes=function(limit_val)
     {
     if(limit_val!=$scope.nostate)
     {
     var traingtype;
     if(typeof limit_val==='undefined')
     traingtype = 0;
     else if(limit_val==0)
     traingtype= 0;
     else
     traingtype = limit_val-1;
     $log.error(traingtype);
     var send= {limit_val:traingtype,action:"get_trainingtypes"};
     }
     else
     {
     var send={action:"get_trainingtypes"};
     }
     $log.error(send);
     baseFactory.baseCall(send)
     .then(function(payload)
     {
     $log.debug(payload);
     if(payload.response==$rootScope.successdata)
     {
     $scope.ttypes = angular.fromJson(payload.list);
     $scope.paging.total = payload.rcnt;
     $scope.no_of_recs = payload.no_of_recs;
     }
     else if(payload.response==$rootScope.emptydata)
     {
     $scope.ttypes = null;
     $scope.paging.total = 0;
     $scope.no_of_recs = 0;
     }
     },
     function(errorPayload)
     {
     $log.error('failure loading', errorPayload);
     });
     };*/
    $scope.loadTrainingBy = function () /* Training By Details */ {
        var send = {action: "get_trainers_roles"};
        $log.debug(send);
        baseFactory.baseCall(send)
            .then(function (payload) {
                    $log.error(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.trngbys = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.trngbys = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.conduct_trainings_send = {fromdate: $scope.minDate, todate: $scope.weekDate};
    $scope.loadTraingConductdata = function () /* Training By Details */ {
        $scope.conduct_trainings_send.action = "get_conduct_training_data";
        $log.debug($scope.conduct_trainings_send);
        baseFactory.baseCall($scope.conduct_trainings_send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.trng_cndts = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.trng_cndts = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadTraingFeedbackdata = function () /* Training By Details */ {
        $scope.training_feedback.action = "get_feedback_training_data";
        $log.debug($scope.training_feedback);
        baseFactory.baseCall($scope.training_feedback)
            .then(function (payload) {
                    $log.error(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.trng_fdbks = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.trng_fdbks = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.training_requests_send = {fromdate: $scope.myDate, todate: $scope.weekDate};
    $scope.loadTraingRequestdata = function () /* Training By Details */ {
        $scope.training_requests_send.action = "get_request_training_data";
        $log.log($scope.training_requests_send);
        baseFactory.baseCall($scope.training_requests_send)
            .then(function (payload) {
                    $log.error(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.trng_rquests = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.trng_rquests = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadQcsDetails = function () /* Qc Details */ {
        var send = {action: "get_qcs_data"};
        baseFactory.getQcsDetails(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.qcs_counts = angular.fromJson(payload.list);
                        console.log($scope.qcs_counts);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.qcs_counts = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.loadDepartments = function (all)
    {
        var send = {action: "get_dept_data"};
        if(all==$scope.all)
        {

            send.all_depts = $scope.yesstate;
        }
       else if($scope.user_role_code == $scope.HMADMIN || $state.is("home.hbbme_deployment") || $state.is("home.departments") || $state.is("home.hbhod_add_asset") || $state.is("home.hbbme_add_asset") || $state.is("home.vendor_add_asset") || $state.is("home.edit_device") || $state.is("home.hbhod_rounds_assign") || $state.is("home.equipment_save_and_deploy") || $scope.org_type == $scope.Vendor)
        {

            send.all_depts = $scope.yesstate;
        }
        else
        {
            send.all_depts = $scope.nostate;
        }
        $log.warn(send);
        send.branch_id = $scope.user_branch;
		send.user_org_module = $scope.user_org_module;
        console.log(send);
        baseFactory.getDepartments(send)
        .then(function (payload)
        {
            $log.debug("depts");
            console.log(payload);
            if (payload.response == $rootScope.successdata) {
                $scope.depts = angular.fromJson(payload.list);
				$scope.depart_labels = angular.fromJson(payload.labels);
			
			if($state.is("home.departments"))
                $scope.loadDeptStates();
			
            }
            else if (payload.response == $rootScope.emptydata) {
                $scope.depts = null;
				$scope.depart_labels = null;
            }
            $log.log($scope.depts);
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.loadAllDepartments = function ()
    {
        var send = {action: "get_dept_data"};
        send.all_depts = $scope.yesstate;
        baseFactory.getDepartments(send)
        .then(function (payload)
        {
            $log.debug("depts");
            $log.debug(payload);
            if (payload.response == $rootScope.successdata) {
                $scope.all_depts = angular.fromJson(payload.list);
				
            }
            else if (payload.response == $rootScope.emptydata) {
                $scope.all_depts = null;
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };

    $scope.loadUnitDepartments = function (branch_id)
    {
        var send = {action: "get_unit_dept_data"};
        send.unit_depts = $scope.nostate;
        send.branch_id = branch_id;
        $log.log(send.action);
        $log.log(JSON.stringify(send));
        //return false;

        baseFactory.getDepartments(send)
            .then(function (payload)
                {
                    $log.debug("depts");
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.unit_depts = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.unit_depts = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.loadStatus = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var status;
            if (typeof limit_val === 'undefined')
                status = 0;
            else if (limit_val == 0)
                status = 0;
            else
                status = limit_val - 1;
            $log.error(status);
            var send = {limit_val: status, action: "get_status"};
        }
        else
        {
            var send = {action: "get_status"};
        }
        baseFactory.getStatus(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.statuss = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.statuss = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loaduserlabels = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var user_label;
            if (typeof limit_val === 'undefined')
                user_label = 0;
            else if (limit_val == 0)
                user_label = 0;
            else
                user_label = limit_val - 1;
            $log.error(user_label);
            var send = {limit_val: user_label, action: "get_user_labels"};
        }
        else
        {
            var send = {action: "get_user_labels"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.user_label = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.user_label = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadescalationlabels = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var esc_label;
            if (typeof limit_val === 'undefined')
                esc_label = 0;
            else if (limit_val == 0)
                esc_label = 0;
            else
                esc_label = limit_val - 1;
            $log.error(esc_label);
            var send = {limit_val: esc_label, action: "get_escalation_labels"};
        }
        else
        {
            var send = {action: "get_escalation_labels"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.escalation_label = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.escalation_label = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadrolelabels = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var role_label;
            if (typeof limit_val === 'undefined')
                role_label = 0;
            else if (limit_val == 0)
                role_label = 0;
            else
                role_label = limit_val - 1;
            $log.error(role_label);
            var send = {limit_val: role_label, action: "get_role_labels"};
        }
        else
        {
            var send = {action: "get_role_labels"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.rolelabels = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.rolelabels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.loadVendorlabel = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var vendor_label;
            if (typeof limit_val === 'undefined')
                vendor_label = 0;
            else if (limit_val == 0)
                vendor_label = 0;
            else
                vendor_label = limit_val - 1;
            $log.error(vendor_label);
            var send = {limit_val: vendor_label, action: "get_vendor_label"};
        }
        else
        {
            var send = {action: "get_vendor_label"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.vendorlabels = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.vendorlabels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };



    $scope.loadesclevellabels = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var esclevel_label;
            if (typeof limit_val === 'undefined')
                esclevel_label = 0;
            else if (limit_val == 0)
                esclevel_label = 0;
            else
                esclevel_label = limit_val - 1;
            $log.error(esclevel_label);
            var send = {limit_val: esclevel_label, action: "get_esclevels_labels"};
        }
        else
        {
            var send = {action: "get_esclevels_labels"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.escalation_levels_labels = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.escalation_levels_labels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadesctypelabels = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var esctype_label;
            if (typeof limit_val === 'undefined')
                esctype_label = 0;
            else if (limit_val == 0)
                esctype_label = 0;
            else
                esctype_label = limit_val - 1;
            $log.error(esctype_label);
            var send = {limit_val: esctype_label, action: "get_esctype_labels"};
        }
        else
        {
            var send = {action: "get_esctype_labels"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.esctype_labels = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.esctype_labels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

      
	  $scope.get_table_names = function (limit_val) /* User Status */ {
         if (limit_val != $scope.nostate)
        {
            var table_name;
            if (typeof limit_val === 'undefined')
                table_name = 0;
            else if (limit_val == 0)
                table_name = 0;
            else
                table_name = limit_val - 1;
            $log.error(table_name);
            var send = {limit_val: table_name, action: "get_table_name"};
        }
        else
        {
            var send = {action: "get_table_name"};
        }
         
        
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.table_names = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.branch_labels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
      
	  
	 /* $scope.gettablesbymodule = function (moduleid) {
        var data = {};
        data.moduleid = moduleid;
        data.action = "get_tables_by_module";
		console.log(data);
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata)
                        $scope.module_table = angular.fromJson(payload.list);
                    else
                        $scope.module_table = null;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };*/
	
	$scope.getorgform = function (data) {
        var data = {};
       data.org_module = $scope.user_org_module;
        data.action = "get_org_forms";
		console.log(data);
		//return false;
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata){
                        $scope.module_forms = angular.fromJson(payload.list);
					
					}
                    else if(payload.response== $rootScope.emptydata){
                        $scope.module_forms = null;
					}
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	
	  
	  $scope.getorgtablemaster = function (moduleid) {
        var data = {};
        data.moduleid = moduleid;
        data.action = "module_base_table_data";
		console.log(data);
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata){
                        $scope.master_table_data = angular.fromJson(payload.list);
					}
                    else if(payload.response == $rootScope.emptydata){
                        $scope.master_table_data = null;
					}
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	  
	  $scope.get_master_table = function (limit_val) /* User Status */ {
         if (limit_val != $scope.nostate)
        {
            var table_name;
            if (typeof limit_val === 'undefined')
                table_name = 0;
            else if (limit_val == 0)
                table_name = 0;
            else
                table_name = limit_val - 1;
            $log.error(table_name);
            var send = {limit_val: table_name, action: "get_master_table"};
        }
        else
        {
            var send = {action: "get_master_table"};
        }
         
        
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.mastertables = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.branch_labels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	  
	  
	  
	  $scope.loadlabelslist = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var branch_label;
            if (typeof limit_val === 'undefined')
                branch_label = 0;
            else if (limit_val == 0)
                branch_label = 0;
            else
                branch_label = limit_val - 1;
            $log.error(branch_label);
            var send = {limit_val: branch_label, action: "get_label_list"};
        }
        else
        {
            var send = {action: "get_label_list"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.label_list = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.label_list = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

	  
	  
	  
	  $scope.loaditemmasters = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var label_master;
            if (typeof limit_val === 'undefined')
                branch_label = 0;
            else if (limit_val == 0)
                label_master = 0;
            else
                label_master = limit_val - 1;
            $log.error(label_master);
            var send = {limit_val: label_master, action: "get_item_masters"};
        }
        else
        {
            var send = {action: "get_item_masters"};
        }
		console.log("gfg");
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.item_masters = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.item_masters = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	$scope.demog = {};
	  $scope.SaveValues = function(send)
    {
		console.log(send);
		//return false;
        var send = {action: "save_module_table"};//,org_id:$scope.user_org,org_module:$scope.user_org_module};
		//send.action = "save_module_table";
		send.org_id =$scope.user_org;
		send.org_module=$scope.user_org_module;
		send.value = $scope.demog;
        console.log(JSON.stringify(send));
		return false;
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    console.log(payload);
			
                    if (payload.response == $rootScope.successdata) {
                           
						   $scope.toast_text = payload.call_back;
						    $scope.showToast();
                          
                    }
                    else {
						
						$scope.toast_text = payload.call_back;
						 $scope.showToast();
                       
                    }
                    

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                   
                });
    }
	  
	  $scope.loadBranches = function(limit_val){
		  
	  }


    $scope.loadbranchlabels = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var branch_label;
            if (typeof limit_val === 'undefined')
                branch_label = 0;
            else if (limit_val == 0)
                branch_label = 0;
            else
                branch_label = limit_val - 1;
            $log.error(branch_label);
            var send = {limit_val: branch_label, action: "get_branch_labels"};
        }
        else
        {
            var send = {action: "get_branch_labels"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.branch_labels = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.branch_labels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadcontracttypelabels = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var branch_label;
            if (typeof limit_val === 'undefined')
                branch_label = 0;
            else if (limit_val == 0)
                branch_label = 0;
            else
                branch_label = limit_val - 1;
            $log.error(branch_label);
            var send = {limit_val: branch_label, action: "get_contracttype_labels"};
        }
        else
        {
            var send = {action: "get_contracttype_labels"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.contracttype_labels = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.contracttype_labels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadincidenttypelabels = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var branch_label;
            if (typeof limit_val === 'undefined')
                branch_label = 0;
            else if (limit_val == 0)
                branch_label = 0;
            else
                branch_label = limit_val - 1;
            $log.error(branch_label);
            var send = {limit_val: branch_label, action: "get_incidenttype_lables"};
        }
        else
        {
            var send = {action: "get_incidenttype_lables"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.incidenttype_labels = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.incidenttype_labels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.loaddepartmentlabels = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var department_label;
            if (typeof limit_val === 'undefined')
                department_label = 0;
            else if (limit_val == 0)
                department_label = 0;
            else
                department_label = limit_val - 1;
            $log.error(department_label);
            var send = {limit_val: department_label, action: "get_department_labels"};
        }
        else
        {
            var send = {action: "get_department_labels"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.department_label = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.department_label = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loaddevicenameslabels = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var devicenames_label;
            if (typeof limit_val === 'undefined')
                devicenames_label = 0;
            else if (limit_val == 0)
                devicenames_label = 0;
            else
                devicenames_label = limit_val - 1;
            $log.error(devicenames_label);
            var send = {limit_val: devicenames_label, action: "get_devicenames_labels"};
        }
        else
        {
            var send = {action: "get_devicenames_labels"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.devicenames_label = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.devicenames_label = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadUtillization = function ()  /* Util Values */ {
        var send = {action: "get_utilvalues"};
        baseFactory.getUtilizations(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.util_values = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.util_values = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadEupConditions = function () /* Equipment Conditions */ {
        var send = {action: "get_equp_cond"};
        baseFactory.getEupConditions(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equp_conds = angular.fromJson(payload.list);
                        console.log($scope.equp_conds);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equp_conds = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.equpDepts = function () /* Equipment Departments */ {
        var send = {action: "get_equp_dept"};
        baseFactory.getEqupDept(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equp_depts = angular.fromJson(payload.list);
                        console.log($scope.equp_depts);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equp_depts = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.equpSearch = function (esearch) /* Equipment Search */ {
        $log.error(esearch);
        var esearch_data = {};
        if (esearch.eqpid != "") {
            esearch_data = {esid: esearch.eqpid, action: "search_by_id"};
        }
        else if (esearch.saccessoriesno != "") {
            esearch_data = {esid: esearch.saccessoriesno, action: "search_by_accserial"};
        }
        else if (esearch.spono != "") {
            esearch_data = {esid: esearch.spono, action: "search_by_spono"};
        }
        else {
            $log.debug(esearch);
            $scope.toast_text = "Please Enter Equipment ID/Serial No./PO No.";
            $scope.showToast();
            return false;
        }
        esearch_data.user_role_code = $scope.user_role_code;
        baseFactory.searchEquipment(esearch_data) /* equipment search */
            .then(function (payload) {
                    $scope.device_details = {};
                    $scope.device_details.E_ID = '';
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.search_device_dtls = angular.fromJson(payload);
                        $scope.device_details = $scope.search_device_dtls.device_details;
						$scope.device_labels = $scope.search_device_dtls.labels;
                        $scope.cms_details = $scope.search_device_dtls.cms_details;
                        $scope.device_history = $scope.search_device_dtls.history;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equpsresult = null;
                        $scope.toast_text = "No Equipment Found With Your Search..!";
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    /* Equipment Summary */
    $scope.equipmentSummary = function (equp_summary_dept) {

        $scope.sequp_depts = null;
        if (equp_summary_dept != $scope.select_department) {
            var send = {dept_id: equp_summary_dept, action: "get_equp_sumry"};
            baseFactory.getEqupDeptSumry(send)
                .then(function (payload) {
                        $log.debug(payload);
                        if (payload.response == $rootScope.successdata) {
                            $scope.sequp_depts = angular.fromJson(payload.devices);
                            console.log($scope.sequp_depts);
                        }
                        else if (payload.response == $rootScope.emptydata) {
                            $scope.sequp_depts = null;
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }
        else if (equp_summary_dept == $scope.select_department) {
            $scope.getEqupUnitWise();
        }
    };
    /*  Display EquipmentDetails UnitWise */
    $scope.getEqupUnitWise = function () {
        var send = {action: "get_equp_company_summary"};
        baseFactory.getEqupUnitWise(send)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.gt_unit_equps = payload.GrandTotal;
                        $scope.unit_equps = angular.fromJson(payload.e_wise);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.unit_equps = null;
                    }
                    $scope.c_wise = payload.company_wise;
                    if ($scope.c_wise.response == $rootScope.successdata) {
                        $scope.cmpny_equps = angular.fromJson($scope.c_wise.device);
                    }
                    else if ($scope.c_wise.response == $rootScope.emptydata) {
                        $scope.cmpny_equps = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    /* Class Generation Begin */
    $scope.getDevices = function () {
        var send = {action: "get_allhb_devices"};
        baseFactory.getDevices(send)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cg_devices = angular.fromJson(payload.devices_ids);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cg_devices = null;
                    }
                    $scope.getEqupTypes();
                    $scope.cg_equp_names = angular.fromJson(payload.dequipment_names);
                    $scope.cg_equp_companies = angular.fromJson(payload.dcompany_names);
                    $scope.cg_equp_conditions = angular.fromJson(payload.equp_conditions);
                    $scope.cg_equp_departs = angular.fromJson(payload.ddeparts);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getEqupTypes = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var equp_type;
            if (typeof limit_val === 'undefined')
                equp_type = 0;
            else if (limit_val == 0)
                equp_type = 0;
            else
                equp_type = limit_val - 1;
            $log.error(equp_type);
            var send = {limit_val: equp_type, action: "get_equp_types",user_org_module:$scope.user_org_module};
        }
        else {
            var send = {action: "get_equp_types",user_org_module:$scope.user_org_module};
        }
        baseFactory.getDevices(send)
            .then(function (payload) {
                    $scope.cg_equp_types = angular.fromJson(payload.equip_types);
					$scope.equp_type_labels  = angular.fromJson(payload.labels);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
					$scope.equp_type_labels = NULL;
                    $scope.paging.total = 0;
                    $scope.no_of_recs = 0;
                });
    };
    $scope.GetDeviceNames = function (dtype) {

        send.action = "get_equp_names_by_type";
        baseFactory.getDevices(send)
            .then(function (payload) {
                    $log.info(payload);
                    $scope.equp_names = angular.fromJson(payload.device_names);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadEquipmentNames = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var equp_name;
            if (typeof limit_val === 'undefined')
                equp_name = 0;
            else if (limit_val == 0)
                equp_name = 0;
            else
                equp_name = limit_val - 1;
            $log.error(equp_name);
            var send = {limit_val: equp_name, action: "get_equip_names",user_org_module:$scope.user_org_module};
        }
        else {
            var send = {action: "get_equip_names",user_org_module:$scope.user_org_module};
        }
        baseFactory.deviceCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equp_names = angular.fromJson(payload.list);
						$scope.dtypes_label = angular.fromJson(payload.labels);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equp_names = null;
						$scope.dtypes_label = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.CallGenerationsearchDevice = function (cgsd) {
        if (cgsd.hasOwnProperty('action')) {
            delete cgsd.action;
        }
        $log.debug(cgsd);
        baseFactory.searchDeviceCG(cgsd)
            .then(function (payload) {
                    $log.warn(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cg_rdevices = payload.devices;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cg_rdevices = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.CreateTraining = function (training_create) {
        training_create.create_by = $scope.user_role_code;
        training_create.action = "create_training";
        $log.debug(training_create);
        baseFactory.deviceCall(training_create)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home." + $scope.user_role_code.toLowerCase() + "_training_approved");
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
    $scope.RequestforApprove = function (request_approve) {
        // request_approve.create_by=$scope.user_role_code;
        request_approve.action = "hod_approve_training";
        $log.debug(request_approve);
        baseFactory.deviceCall(request_approve)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadTraingRequestdata();
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
    $scope.ConductTraining = function (training_conduct) {
        training_conduct.action = "conduct_training";
        $log.debug(training_conduct);
        baseFactory.deviceCall(training_conduct)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadTraingConductdata();
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
    $scope.SearchRespondedCalls = function (limit_val) {
        if (typeof limit_val === 'undefined')
            $scope.respondcall_search.limit_val = 0;
        else if (limit_val == 0)
            $scope.respondcall_search.limit_val = 0;
        else
            $scope.respondcall_search.limit_val = limit_val - 1;
        $log.error($scope.respondcall_search.limit_val);

        if ($scope.searched.EID == null)
            $scope.respondcall_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.respondcall_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.respondcall_search.eqpid = "";
        if ($scope.user_role_code == $scope.HBBME)
            $scope.respondcall_search.action = "get_responded_bmecalls";
        else if ($scope.user_role_code == $scope.HBHOD) {
            $scope.respondcall_search.action = "get_responded_hodcalls";
            if ($scope.myall_hod_select != undefined) {
                if ($scope.myall_hod_select == $scope.hod_calls_select[0]) {
                    $scope.respondcall_search.mine = $scope.yesstate;
                }
                else if ($scope.myall_hod_select == $scope.hod_calls_select[1]) {
                    delete $scope.respondcall_search.mine;
                }
            }
            else
                delete $scope.respondcall_search.mine;
        }
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.respondcall_search.action = "get_responded_hodcalls";

        $scope.respondcall_search.branch_id = $scope.user_branch;

        console.log("get_responded_hodorbmecalls");
        $log.info(JSON.stringify($scope.respondcall_search));
        baseFactory.deviceCall($scope.respondcall_search)
            .then(function (payload) {
				console.log("get_responded_hodorbmecalls");
				console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.rc_devices = angular.fromJson(payload.respond_calls);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
						//$state.go('home.hbhod_responded_calls');
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.rc_devices = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.SearchAttendedCalls = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var attendedcall;
            if (typeof limit_val === 'undefined')
                attendedcall = 0;
            else if (limit_val == 0)
                attendedcall = 0;
            else
                attendedcall = limit_val - 1;
            $log.error(attendedcall);
            $scope.attendedcall_search.limit_val = attendedcall;
        }
        else {
            delete $scope.attendedcall_search.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.attendedcall_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.attendedcall_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.attendedcall_search.eqpid = "";
        if ($scope.user_role_code == "HBBME")
            $scope.attendedcall_search.action = "get_attended_bmecalls";
        else if ($scope.user_role_code == "HBHOD") {
            $scope.attendedcall_search.action = "get_attended_hodcalls";
            if ($scope.myall_hod_select != undefined) {
                if ($scope.myall_hod_select == $scope.hod_calls_select[0]) {
                    $scope.attendedcall_search.mine = $scope.yesstate;
                }
                else if ($scope.myall_hod_select == $scope.hod_calls_select[1]) {
                    delete $scope.attendedcall_search.mine;
                }
            }
            else
                delete $scope.attendedcall_search.mine;
        }
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.attendedcall_search.action = "get_attended_hodcalls";

        $scope.attendedcall_search.branch_id = $scope.user_branch;

        $log.log(JSON.stringify($scope.attendedcall_search));
		
        baseFactory.deviceCall($scope.attendedcall_search)
            .then(function (payload) {
                   console.log(payload);
                    $log.warn(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.ac_devices = angular.fromJson(payload.attended_calls);
                        $scope.paging.total = payload.rcnt;
                        $scope.ac_devices.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.ac_devices = null;
                        $scope.paging.total = 0;
                        $scope.ac_devices.no_of_recs = 0;
                    }
                    $log.debug(payload);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.SearchProcessPendimgCalls = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var pendingcall;
            if (typeof limit_val === 'undefined')
                pendingcall = 0;
            else if (limit_val == 0)
                pendingcall = 0;
            else
                pendingcall = limit_val - 1;
            $log.error(pendingcall);
            $scope.pprocesscall_search.limit_val = pendingcall;
        }
        else {
            delete $scope.pprocesscall_search.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.pprocesscall_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.pprocesscall_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.pprocesscall_search.eqpid = "";

        if ($scope.user_role_code == $scope.HBBME)
            $scope.pprocesscall_search.action = "get_processpending_bmecalls";
        else if ($scope.user_role_code == $scope.HBHOD) {
            $scope.pprocesscall_search.action = "get_processpending_hodcalls";
            if ($scope.myall_hod_select != undefined) {
                if ($scope.myall_hod_select == $scope.hod_calls_select[0]) {
                    $scope.pprocesscall_search.mine = $scope.yesstate;
                }
                else if ($scope.myall_hod_select == $scope.hod_calls_select[1]) {
                    delete $scope.pprocesscall_search.mine;
                }
            }
            else
                delete $scope.pprocesscall_search.mine;
        }
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.pprocesscall_search.action = "get_processpending_hodcalls";

        $scope.pprocesscall_search.branch_id = $scope.user_branch;
        $log.debug($scope.pprocesscall_search);
        baseFactory.deviceCall($scope.pprocesscall_search)
            .then(function (payload) {
                    console.clear();
                    $log.error(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.ppc_devices = angular.fromJson(payload.processpending_calls);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.ppc_devices = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }

                    $log.debug(payload);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.SearchCompletedCalls = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var completedcall;
            if (typeof limit_val === 'undefined')
                completedcall = 0;
            else if (limit_val == 0)
                completedcall = 0;
            else
                completedcall = limit_val - 1;
            $log.error(completedcall);
            $scope.completecall_search.limit_val = completedcall;
        }
        else {
            delete $scope.completecall_search.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.completecall_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.completecall_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.completecall_search.eqpid = "";

        if ($scope.user_role_code == $scope.HBBME)
            $scope.completecall_search.action = "get_complete_bmecalls";
        else if ($scope.user_role_code == $scope.HBHOD)
            $scope.completecall_search.action = "get_complete_hodcalls";
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.completecall_search.action = "get_complete_hodcalls";

        $scope.completecall_search.branch_id = $scope.user_branch;

        $log.debug($scope.completecall_search);
		console.log($scope.completecall_search);
        baseFactory.deviceCall($scope.completecall_search)
            .then(function (payload) {
				console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cc_devices = angular.fromJson(payload.completed_calls);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cc_devices = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                    $log.debug(payload);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.all_completed_calls_search = {};

    $scope.getAllCompletedCalls = function () {
        if ($scope.user_role_code == $scope.HBBME)
            $scope.completecall_search.action = "get_completed_all_bmecalls";
        else if ($scope.user_role_code == $scope.HBHOD)
            $scope.completecall_search.action = "get_completed_all_hodcalls";
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.completecall_search.action = "get_completed_all_hodcalls";
        $log.debug($scope.completecall_search);
        baseFactory.deviceCall($scope.completecall_search)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.acc_devices = angular.fromJson(payload.completed_calls);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.acc_devices = null;
                    }
                    $log.debug(payload);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.SearchCompletedPms = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var completedpms;
            if (typeof limit_val === 'undefined')
                completedpms = 0;
            else if (limit_val == 0)
                completedpms = 0;
            else
                completedpms = limit_val - 1;
            $log.error(completedpms);
            $scope.completedpms_search.limit_val = completedpms;
        }
        else {
            delete $scope.completedpms_search.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.completedpms_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.completedpms_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.completedpms_search.eqpid = "";
        if ($scope.user_role_code == $scope.HBBME)
            $scope.completedpms_search.action = "get_completed_bmepms";
        else if ($scope.user_role_code == $scope.HBHOD)
            $scope.completedpms_search.action = "get_complete_hodpms";
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.completedpms_search.action = "get_complete_hodpms";

        $scope.completedpms_search.branch_id = $scope.branch_id;

        $log.debug($scope.completedpms_search);
        baseFactory.deviceCall($scope.completedpms_search)
            .then(function (payload) {
                    $log.debug("pms data");
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cpms_devices = angular.fromJson(payload.completed_pms);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cpms_devices = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.SearchCompletedQcs = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var completedqcs;
            if (typeof limit_val === 'undefined')
                completedqcs = 0;
            else if (limit_val == 0)
                completedqcs = 0;
            else
                completedqcs = limit_val - 1;
            $log.error(completedqcs);
            $scope.completedqcs_search.limit_val = completedqcs;
        }
        else {
            delete $scope.completedqcs_search.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.completedqcs_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.completedqcs_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.completedqcs_search.eqpid = "";

        if ($scope.user_role_code == $scope.HBBME)
            $scope.completedqcs_search.action = "get_completed_bmeqcs";
        else if ($scope.user_role_code == $scope.HBHOD)
            $scope.completedqcs_search.action = "get_completed_hodqcs";
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.completedqcs_search.action = "get_completed_hodqcs";

        $scope.completedqcs_search.branch_id = $scope.user_branch;
        $log.debug($scope.completedqcs_search);
        baseFactory.deviceCall($scope.completedqcs_search)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.cqc_devices = angular.fromJson(payload.completed_qcs);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cqc_devices = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                    $log.debug(payload);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.SearchPendingPms = function (limit_val, hod_call)
    {
        $scope.pms_eq_selected = [];
        if (typeof hod_call != "undefined") {
            if (hod_call == "get_hod_calls")
                $scope.pendingpms_search.aaction = hod_call;
            else if (hod_call == "get_assigned_calls")
                $scope.pendingpms_search.aaction = "get_assigned_calls";

            else {
                delete $scope.pendingpms_search.aaction;
            }
        }
        else {
            delete $scope.pendingpms_search.aaction;
        }
        if (limit_val != $scope.nostate) {
            var pendingpms;
            if (typeof limit_val === 'undefined')
                pendingpms = 0;
            else if (limit_val == 0)
                pendingpms = 0;
            else
                pendingpms = limit_val - 1;
            $log.error(pendingpms);
            $scope.pendingpms_search.limit_val = pendingpms;
        }
        else {
            delete $scope.pendingpms_search.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.pendingpms_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.pendingpms_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.pendingpms_search.eqpid = "";

        if ($scope.user_role_code == $scope.HBBME)
            $scope.pendingpms_search.action = "get_pending_bmepms";
        else if ($scope.user_role_code == $scope.HBHOD) {
            $scope.pendingpms_search.action = "get_pending_hodpms";
            if ($scope.myall_hod_select != undefined) {
                if ($scope.myall_hod_select == $scope.hod_calls_select[0]) {
                    $scope.pendingpms_search.mine = $scope.yesstate;
                }
                else if ($scope.myall_hod_select == $scope.hod_calls_select[1]) {
                    delete $scope.pendingpms_search.mine;
                }
            }
            else
                delete $scope.pendingpms_search.mine;
        }
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.pendingpms_search.action = "get_pending_hodpms";
        $log.log($scope.pendingpms_search);
        $scope.pendingpms_search.branch_id = $scope.user_branch;
        // console.log(JSON.stringify($scope.pendingpms_search));
        baseFactory.deviceCall($scope.pendingpms_search)
            .then(function (payload) {
					console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.ppms_devices = angular.fromJson(payload.pending_pms);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.ppms_devices = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    $log.debug(payload);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	$scope.SearchScheduledcall = function (limit_val, hod_call)
    {
        console.log("ffghfgh");
       // return false;
        //$scope.pms_eq_selected = [];
        if (typeof hod_call != "undefined") {
            if (hod_call == "get_hod_calls")
                $scope.pendingscheduled_search.aaction = hod_call;
            else if (hod_call == "get_assigned_calls")
                $scope.pendingscheduled_search.aaction = "get_assigned_calls";

            else {
                delete $scope.pendingscheduled_search.aaction;
            }
        }
        else {
            delete $scope.pendingscheduled_search.aaction;
        }
        if (limit_val != $scope.nostate) {
            var scheduledcall;
            if (typeof limit_val === 'undefined')
                scheduledcall = 0;
            else if (limit_val == 0)
                scheduledcall = 0;
            else
                scheduledcall = limit_val - 1;
            $log.error(scheduledcall);
            $scope.pendingscheduled_search.limit_val = scheduledcall;
        }
        else {
            delete $scope.pendingscheduled_search.limit_val;
        }
       /* if ($scope.searched.EID == null)
            $scope.pendingscheduled_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.pendingscheduled_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.pendingscheduled_search.eqpid = ""; */

        if ($scope.user_role_code == $scope.HBBME)
            $scope.pendingscheduled_search.action = "get_pending_scheduled";
        else if ($scope.user_role_code == $scope.HBHOD) {
            $scope.pendingscheduled_search.action = "get_pending_scheduled";
            if ($scope.myall_hod_select != undefined) {
                if ($scope.myall_hod_select == $scope.hod_calls_select[0]) {
                    $scope.pendingscheduled_search.mine = $scope.yesstate;
                }
                else if ($scope.myall_hod_select == $scope.hod_calls_select[1]) {
                    delete $scope.pendingscheduled_search.mine;
                }
            }
            else
                delete $scope.pendingscheduled_search.mine;
        }
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.pendingscheduled_search.action = "get_pending_scheduled";
        $log.log($scope.pendingscheduled_search);
        $scope.pendingscheduled_search.branch_id = $scope.user_branch;
        console.log($scope.pendingscheduled_search);
      //  return false;
        baseFactory.deviceCall($scope.pendingscheduled_search)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.scheduled_details_call = angular.fromJson(payload.scheduled_details_call);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.scheduled_details_call = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    $log.debug(payload);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

	
	
    $scope.SearchPendingQc = function (limit_val, hod_call)
    {
        $scope.qc_eq_selected = [];
        if (typeof hod_call != "undefined") {
            if (hod_call == "get_hod_calls")
                $scope.pendingqc_search.aaction = hod_call;
            else if (hod_call == "get_assigned_calls")
                $scope.pendingqc_search.aaction = "get_assigned_calls";
            else {
                delete $scope.pendingqc_search.aaction;
            }
        }
        else {
            delete $scope.pendingqc_search.aaction;
        }
        if (limit_val != $scope.nostate) {
            var pendingqcs;
            if (typeof limit_val === 'undefined')
                pendingqcs = 0;
            else if (limit_val == 0)
                pendingqcs = 0;
            else
                pendingqcs = limit_val - 1;
            $log.error(pendingqcs);
            $scope.pendingqc_search.limit_val = pendingqcs;
        }
        else {
            delete $scope.pendingqc_search.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.pendingqc_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.pendingqc_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.pendingqc_search.eqpid = "";
        if ($scope.user_role_code == $scope.HBBME)
            $scope.pendingqc_search.action = "get_pending_bmeqc";
        else if ($scope.user_role_code == $scope.HBHOD) {
            $scope.pendingqc_search.action = "get_pending_hodqc";
            if ($scope.myall_hod_select != undefined) {
                if ($scope.myall_hod_select == $scope.hod_calls_select[0]) {
                    $scope.pendingqc_search.mine = $scope.yesstate;
                }
                else if ($scope.myall_hod_select == $scope.hod_calls_select[1]) {
                    delete $scope.pendingqc_search.mine;
                }
            }
            else
                delete $scope.pendingqc_search.mine;
        }
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.pendingqc_search.action = "get_pending_hodqc";

        $scope.pendingqc_search.branch_id = $scope.user_branch;

        $log.debug($scope.pendingqc_search);
        baseFactory.deviceCall($scope.pendingqc_search)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.pqc_devices = angular.fromJson(payload.pending_qc);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.pqc_devices = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    $log.debug(payload);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getDeviceReasons = function () {
        $scope.device_reasons = null;
        data = {action: "get_device_reasons"};
        baseFactory.getDeviceReasons(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.device_reasons = angular.fromJson(payload.reasons);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.device_reasons = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

   

    $scope.org_module = {};
    $scope.getorgmodule = function () {
        data = {action: "org_module"};
        baseFactory.deviceCall(data)
            .then(function (payload) {
                  console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.org_module = angular.fromJson(payload.org_module);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.org_module = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };







   $scope.getDevicePriorities = function () {
        $scope.device_priorities = null;
        data = {action: "get_device_priorities"};
        baseFactory.getDevicePriorities(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.device_priorities = angular.fromJson(payload.priorities);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.device_priorities = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.generateCall = function (event, device_id)
    {
        var template_name = 'device/call_generation_dailog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: event,
            locals: {cg_device_id: device_id},
            controller: _CallGenerationDialogCtrl
        }).then(function (answer) {
            },
            function () {
            });
    };


    function _CallGenerationDialogCtrl($scope, $mdDialog, cg_device_id) {
        $scope.getDeviceReasons();
        $scope.getDevicePriorities();
        $scope.fcg = {
            device_id: cg_device_id,
            caller_name: $cookies.get('user_name'),
            complaint: '',
            priority: '',
            other_compalint: ''
        };
    }
    $scope.GiveTrainingFeedback = function (training_feedback) {
        training_feedback.action = "give_training_feedback";
        $log.debug(training_feedback);
        baseFactory.deviceCall(training_feedback)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadTraingFeedbackdata();
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
    $scope.ConductTrainingDialog = function (event, cntds_training) {
        var template_name = 'device/conduct_taining_dailog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: event,
            locals: {cntds_training_data: cntds_training},
            controller: ConductTraingDialogCtrl
        }).then(function (answer) {
            },
            function () {
            });
    };


    function ConductTraingDialogCtrl($scope, $mdDialog, cntds_training_data) {

        $scope.condct_traing_data = cntds_training_data;
        /*if (cntds_training_data.TR_COMP != null)
        $scope.condct_traing_data.TR_COMP = new Date(cntds_training_data.TR_COMP);
        $scope.condct_traing_data.tr_date = new Date(cntds_training_data.TR_DATE);
        $log.log($scope.condct_traing_data.tr_date);*/
    }

    $scope.FeedbackTrainingDialog = function (event, fdbk_training) {
        var template_name = 'device/feedback_taining_dailog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: event,
            locals: {fdbk_training_data: fdbk_training},
            controller: FeedbackTraingDialogCtrl
        }).then(function (answer) {
            },
            function () {
            });
    };


    function FeedbackTraingDialogCtrl($scope, $mdDialog, fdbk_training_data) {
        $scope.fdbk_training_data = fdbk_training_data;
        //if(fdbk_training_data.TR_COMP!=null)
        //$scope.condct_traing_data.TR_COMP=new Date(fdbk_training_data.TR_COMP);
        $log.debug($scope.fdbk_training_data);
    }


    $scope.RequestToApprovedDialog = function (event, request_training) {
        var template_name = 'device/training_request_dailog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: event,
            locals: {requst_training_data: request_training},
            controller: RequestTraingDialogCtrl
        }).then(function (answer) {
            },
            function () {
            });
    };


    function RequestTraingDialogCtrl($scope, $mdDialog, requst_training_data) {
        $scope.requst_training_data = requst_training_data;
        $scope.requst_training_data.tstatus = requst_training_data.STATUS;
        //if(fdbk_training_data.TR_COMP!=null)
        //$scope.condct_traing_data.TR_COMP=new Date(fdbk_training_data.TR_COMP);
        $log.debug($scope.requst_training_data);
    }

    $scope.fetchMyTrainingFeedbacks = function (feedback_id) {
        var fdata = {};
        //$scope.ct_feedbacks = null;
        fdata.id = feedback_id;
        fdata.action = "get_feedbacks_of_my_ctraining";
        baseFactory.baseCall(fdata)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.ct_feedbacks = payload.feedbacks;
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.ct_feedbacks = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getMyTrainingFeedbacks = function (ev, feedback_id) {
        var template_name = 'device/my_training_feedbacks';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {feedback_id: feedback_id},
            controller: _MyTrainingFeedbacks
        }).then(function (answer) {
            },
            function () {
            });
    };


    $scope.GenerateCallByUser = function (fcg) /* call generation */ {
        fcg.org_type = $scope.org_type;
        fcg.action = "call_generation_by_user";
        if (fcg.hasOwnProperty('caller_name')) {
            delete fcg.caller_name;
        }
        $log.log(fcg);
        baseFactory.GenerateCallByUser(fcg)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata || payload.response == $rootScope.exsitsdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.cg_rdevices = null;
                        $state.go('home.' + angular.lowercase($scope.user_role_code) + '_today_calls');
                    }
                    else if (payload.response == $rootScope.failedata || payload.response == $rootScope.emptydata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.toDayCalls = function ( hod_call) {
        var data = {};
        if (typeof hod_call != "undefined") {
            if (hod_call == "get_hod_calls")
                data.aaction = hod_call;
            else if (hod_call == "get_assigned_calls")
                data.aaction = "get_assigned_calls";
            else {
                delete data.aaction;
            }
        }
        else {
            delete data.aaction;
        }
        $scope.tc_devices = null;
        $scope.admin_call_selected = null;

        if($scope.user_role_code == $scope.HMADMIN) {
            $scope.loadTransferUnits($scope.nostate);
            $scope.loadCondemenationRequest($scope.nostate);
        }

        data.branch_id = $scope.user_branch;
        data.action = "get_today_calls";
        baseFactory.deviceCall(data)
            .then(function (payload) {
                console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.tc_devices = angular.fromJson(payload.devices);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.tc_devices = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.openNsCalls = function (branch_id,limit_val) {
        var data = {action: "get_not_responded_calls", only_ns: $scope.yesstate,branch_id:$scope.user_branch,org_id:$scope.user_org};
        if (limit_val != $scope.nostate) {
            var lv;
            if (typeof limit_val === 'undefined')
                lv = 0;
            else if (limit_val == 0)
                lv = 0;
            else
                lv = limit_val - 1;
            data.limit_val = lv;
        }


        $log.log("get_not_responded_calls");
        $log.log(data);
		console.log(JSON.stringify(data));
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.open_ns_calls = angular.fromJson(payload.devices);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.open_ns_calls = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.myCallsAdmin = function (select) {
        $scope.user_branch_id = null;
        //$scope.user_branch = null;
        var data = {};
        if (select == $scope.admin_calls_select[0]) {
            data.action = "get_admin_calls";
        }
        else if (select == $scope.admin_calls_select[1]) {
            data.action = $scope.admin_calls_select[1];
        }
        $scope.loadTransferUnits($scope.nostate, data.action);
        $scope.loadCondemenationRequest($scope.nostate, data.action);
    };



    $scope.branch_all_loading =  function(bid) {

        $scope.user_branch = bid;
        console.log("success"+$scope.user_branch);

        if($state.is("home.hbhod_today_calls"))
        {
            $scope.hod_call_selected = "My Calls";
            $scope.myCallsHod($scope.hod_calls_select[0]);
			$scope.getAllCallsCount();
        }
		else if($state.is("home.replace_device")){
			$scope.searchTextChange('ABCD','');
		}
        else if($state.is("home.open_calls"))
        {
            $scope.openNsCalls();
            $scope.getAllCallsCount();
        }
        else if($state.is("home.hbhod_responded_calls"))
        {
            $scope.SearchRespondedCalls();
			$scope.getAllCallsCount();
        }
        else if($state.is("home.hbhod_attended_calls"))
        {
            $scope.SearchAttendedCalls();
			$scope.getAllCallsCount();
        }

        else if($state.is("home.hbhod_propen_calls"))
        {
            $scope.SearchProcessPendimgCalls();
			$scope.getAllCallsCount();
        }
        else if($state.is("home.hbhod_pending_pms"))
        {
            $scope.SearchPendingPms();
			$scope.getAllCallsCount();
        }

         else if($state.is("home.hbhod_pending_scheduled"))
        {
           // $scope.getAllCallsCount();
            $scope.SearchScheduledcall();
        }
        else if($state.is("home.hbhod_completed_pms"))
        {
            $scope.SearchCompletedPms();
			$scope.getAllCallsCount();
        }
        else if($state.is("home.hbhod_completed_qcs"))
        {
            $scope.SearchCompletedQcs();
			$scope.getAllCallsCount();
        }
        else if($state.is("home.hbhod_pending_qcs"))
        {
            $scope.SearchPendingQc();
			$scope.getAllCallsCount();
        }
        else if($state.is("home.adverse_calls"))
        {
            $scope.title="Adverse Calls";

            if($scope.user_role_code==$scope.HBHOD)
            {
                $scope.hodMyCalls();
                $scope.loadAdverseIncedents();
            }
            else
            {
                $scope.getAllCallsCount();
                $scope.loadAdverseIncedents();
            }
        }

        else if($state.is("home.rounds_calls"))
        {
            $scope.title="Round Calls";
            if($scope.user_role_code==$scope.HBHOD)
            {
                $scope.hodMyCalls();
            }
            else
                $scope.getAllCallsCount();
        }
		else if($state.is("home.hbhod_rounds_assign"))
		{
			$scope.loadDepartments();
        $scope.getRoles();
        $scope.getHodBmes();
		}
        else if($state.is("home.transfer_calls"))
        {
            $scope.title="Transfer Calls";

            $scope.getOtherunitUnitTransferCalls();
			$scope.getAllCallsCount();
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
            if($scope.user_role_code==$scope.HBHOD)
            {
                $scope.hodMyCalls();
            }
            else
                $scope.getAllCallsCount();
        }
        else if($state.is("home.hbhod_completed_calls"))
        {
            $scope.title="Completed Calls";
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
        else if($state.is("home.indent_equipment"))
        {
            
              // $scope.loadBranches();
                $scope.loadIncidentsElements();
              // $scope.getAllStockCount();
           
        }
		else if($state.is("home.hbhod_training_feedback"))
		{
			$scope.loadTraingFeedbackdata();
		}
		else if($state.is("home.hbhod_training_conduct"))
		{
			$scope.loadTraingConductdata();
		}
		else if($state.is("home.hbhod_training_create"))
		{
			$scope.getRoles();
            $scope.loadTrainingTypes();
            $scope.loadTrainingBy();
		}
		else if($state.is("home.hbhod_training_approved"))
		{
			$scope.TrainingsApproved();
		}
		else if($state.is("home.hbhod_training_request"))
		{
			$scope.loadTraingRequestdata();
		}
        else if($state.is("home.cear"))
        {
            $scope.loadCear();

        }
        else if($state.is("home.gate_pass_new"))
        {
            $scope.loadGatepass();

        }
        else if($state.is("home.hbbme_scheduled_calls"))
        {
            $scope.getAllCallsCount();
        }
        else if($state.is("home.gate_pass_request"))
        {
            $scope.loadAllDepartments();
            $scope.getDepartmentDevices();
            $scope.getCriticalSpares();
            $scope.getAccessories();
            $scope.loadGatepass();
        }
        else if($state.is("home.view_devies"))
        {
            $scope.getDepartDevices();
            $scope.loadDepartments();
        }

        else if($state.is("home.hbbme_print_labels"))
        {
            $scope.loadDepartments();
        }
        else if($state.is("home.hmadmin_print_labels"))
        {
            $scope.loadDepartments();
        }
        else if($state.is("home.print_labels_pms_cal"))
        {
            $scope.loadDepartments();
        }
        else if($state.is("home.transfer"))
        {
            $scope.loadTransferUnits();
        }
        else if($state.is("home.condemnation"))
        {
            $scope.loadDepartments();
            $scope.loadCondemenationRequest();
            $scope.loadReusableParts();

        }
        else if($state.is("home.stock"))
        {

            $scope.getAllStockCount();
        }
        else if($state.is("home.maintain_contracts"))
        {
            $scope.loadMaintanceContracts();
            $scope.loadDepartments();
            $scope.loadContracts();
            $scope.searchTextChange('ABCD','');
        }
        else if($state.is("home.viability"))
        {

            $scope.getViability();

        }

        else if($state.is("home.hbbme_today_calls"))
        {
            $scope.title="Today Calls";
            $scope.bmetoDayCalls();
            $scope.getOtherunitUnitTransferCalls($scope.nostate);
            $scope.loadCondemenationRequest($scope.nostate);
            $scope.loadAdverseIncedents($scope.nostate);
            $scope.SearchPendingPms($scope.nostate);
            $scope.SearchPendingQc($scope.nostate);
            $scope.loadRoundAssigned($scope.nostate);
            $scope.getAllCallsCount();
        }
        else if($state.is("home.hbbme_scheduled_calls"))
        {

        }
        else if($state.is("home.observations"))
        {
            $scope.loadAdverseIncedents();
            $scope.loadIncidentType();
            $scope.loadDepartments();
            $scope.getAdverseIncedents();
            $scope.searchTextChange('ABCD','');
        }
        else if($state.is("home.hbhod_rounds_complete"))
        {
            $scope.loadDepartments();
            $scope.loadRoundCompleted();
        }
        else if($state.is("home.requipment_summary"))
            {
            $scope.loadDepartments();
            $scope.loadEqupSummryReports();
            $scope.Equipmentsumarybarchart();
            $scope.searchTextChange('ABCD','');

        }
        else if($state.is("home.equp_down_time"))
        {
            $scope.loadDepartments();
            $scope.getEquipmentDownTime();
            $scope.EquipmentDownTimeReportGraphs();
            $scope.searchTextChange('ABCD','');
        }
        else if($state.is("home.equp_history_card"))
        {
            $scope.getEquipmentHistory();
            $scope.loadDepartments();
           // $scope.EquipmentHistorybarchart();
            $scope.searchTextChange('ABCD','');
        }
        else if($state.is("home.rservices"))
        {
            $scope.loadDepartments();
            $scope.ServiceReportGraphs();
            $scope.getDeployementReport();
            $scope.searchTextChange('ABCD','');

        }
        else if($state.is("home.rviability"))
        {
            $scope.ViabiltyReportGraphs();
        }
        else if($state.is("home.rindent"))
        {
            $scope.getIndentReportPDF();
            $scope.loadIncidentsElements();
            $scope.Indentbarchart();
        }
        else if($state.is("home.rcear"))
        {
           $scope.loadCear();
        }
        else if($state.is("home.gatepass"))
        {
            $scope.gatepassbarchart();
        }
        else if($state.is("home.rcall_log"))
        {
            $scope.loadDepartments();
            $scope.loadContracts();
            $scope.getSupportVendors();
            $scope.CalllogReportGraphs();
        }
        else if($state.is("home.cms_report"))
        {
            $scope.loadDepartments();
            $scope.loadCMSReports();
            $scope.loadAssetManagementndOtherActivites();
        }
        else if($state.is("home.rpms"))
        {
            $scope.loadDepartments();
            $scope.pmsReportGraphs();
            $scope.getPMSReport();
            $scope.searchTextChange('ABCD','');

        }
        else if($state.is("home.call_log_reports"))
        {
            $scope.loadDepartments();
            $scope.loadCalllogsReports();
            $scope.loadContracts();
            $scope.getSupportVendors();
            $scope.searchTextChange('ABCD','');

        }
        else if($state.is("home.rqc")) {

            $scope.loadDepartments();
            $scope.qcReportGraphs();
            $scope.searchTextChange('ABCD','');
        }
        else if($state.is("home.radverse"))
        {
            $scope.AdverseReportGraphs();
            $scope.loadDepartments();
            $scope.getAdverseReport();
            $scope.adversebarchart();
            $scope.searchTextChange('ABCD','');
        }
        else if($state.is("home.deployment_report"))
        {
            $scope.loadDepartments();
            $scope.loadDeployementReports();
            $scope.DeployementReportGraphs();
            $scope.getDeployementReport();
            $scope.searchTextChange('ABCD','');
        }
        else if($state.is("home.rredeployment"))
        {
            $scope.loadDepartments();
            $scope.ReDeployementReportGraphs();
            $scope.getReDeployementReport();
            $scope.searchTextChange('ABCD','');
        }
        else if($state.is("home.rcondemnation"))
        {
            $scope.CondemnationReportGraphs();
            $scope.getCondemnationReport();
            $scope.loadDepartments();
            $scope.searchTextChange('ABCD','');
    }
        else if($state.is("home.monthly_performance_report"))
        {
            $scope.loadMPReports();
        }
        else if($state.is("home.stock_report"))
        {
            $scope.getStock();
        }
        else if($state.is("home.graphs"))
        {
            $scope.Equipmentsumarybarchart();
            /*  $scope.cmsbarchart();
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
        else if($state.is("home.monthly_performance_graph"))
        {
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
        else if($state.is("home.hbhod_vendors"))
        {
            $scope.loadVendorList();
            $scope.getVendorTypes();
        }
        else if($state.is("home.hmadmin_users"))
        {
            $scope.getBranchUsers();
        }
        else if($state.is("home.hbhod_users"))
        {
            console.log("ffh");
			$scope.getBranchUsers();
            $scope.loadLevelsList();
        }
		else if($state.is("home.hbbme_incident_call"))
  {
	  console.log("fgf");
      $scope.loadCondmnReasonsList($scope.nostate);
      $scope.getCallMasters();
      $scope.loadAllDepartments();
      //$scope.getDeviceReasons();
      $scope.getDevicePriorities();
      $scope.loadIncidentType();
	  $scope.searchTextChange('ABCD','');
      //$scope.loadBranches();
  }
        else if($state.is("home.hbbme_deployment"))
        {
            $scope.UndeployedDevices();
        }
        else if($state.is("home.hbbme_add_contract_type"))
        {

        }
        else
        {
            console.log("else_condition");
        }
    }

    $scope.myCallsHod = function (select) {
        $scope.myall_hod_select = select;


        var action = null;
        if (select == $scope.hod_calls_select[0]) {
            $scope.getAllCallsCount($scope.user_role_code, $scope.user_id);
            action = "get_hod_calls";
        }
        else if (select == $scope.hod_calls_select[1]) {
            $scope.getAllCallsCount();
            action = $scope.hod_calls_select[1];
        }
        else if (select == $scope.hod_calls_select[2]) {
            $scope.getAllCallsCount();
            action = "get_assigned_calls";
        }

        $scope.toDayCalls(action);
        //$scope.SearchPendingPms($scope.nostate, action);
       // $scope.SearchPendingQc($scope.nostate, action);
        $scope.loadRoundAssigned($scope.nostate, action);
        $scope.loadAdverseIncedents(action);
        $scope.loadTransferUnits($scope.nostate, action);
        $scope.loadCondemenationRequest($scope.nostate, action);
    };
    $scope.RespondedCalls = function () {
        var data = {action: "get_bme_responded_calls"};
        $log.info(data);
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.tc_devices = angular.fromJson(payload.devices);
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.tc_devices = null;
                    }
                    $log.info($scope.tc_devices);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.bmetoDayCalls = function () {
        var data = {action: "get_bme_today_calls",branch_id:$scope.user_branch};

        $log.log(data);
         baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.tc_devices = angular.fromJson(payload.devices);
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.tc_devices = null;
                    }
                    $log.debug($scope.tc_devices);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.CompletedCalls = function () {
        var data = {action: "get_bme_completed_calls"};
        $log.log(data);
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.tc_devices = angular.fromJson(payload.devices);
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.tc_devices = null;
                    }
                    $log.debug($scope.tc_devices);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.AttendedCalls = function () {
        var data = {action: "get_bme_attended_calls"};
        $log.log(data);
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.tc_devices = angular.fromJson(payload.devices);
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.tc_devices = null;
                    }
                    $log.debug($scope.tc_devices);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.PendingCalls = function () {
        var data = {action: "get_bme_pending_calls"};
        $log.log(data);
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.tc_devices = angular.fromJson(payload.devices);
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.tc_devices = null;
                    }
                    $log.debug($scope.tc_devices);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.getRoleCalls = function () {
        if ($scope.user_role_code == 'HBHOD') {
            $scope.toDayCalls()
        }
        else if ($scope.user_role_code == 'HBBME') {
            $scope.bmetoDayCalls();
        }
    }
    $scope.getHodBmes = function (branch_id) {
        var data = {action: "get_hod_bmes_of_branch", user_id: $scope.user_id};
		if(branch_id !=undefined)
            data.branch_id = branch_id;
        else
            data.branch_id = $scope.user_branch;
		console.log(data);
        baseFactory.getHodBmes(data)
            .then(function (payload) {
				 
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.bmehods = angular.fromJson(payload.users);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.bmehods = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getHodBmesRounds = function () {
        var data = {action: "get_hod_bmes_of_branch_rounds", user_id: $scope.user_id};
        baseFactory.getHodBmes(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.rbmehods = angular.fromJson(payload.users);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.rbmehods = null;
                    }
                    $log.debug($scope.bmehods);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.AssignPendingqc = function (qc_assign_dtls,assign_to) {
        $log.debug(qc_assign_dtls);
        var qc_assign_dtl = {};
        qc_assign_dtl.values = qc_assign_dtls;
        qc_assign_dtl.assignto = assign_to;
        qc_assign_dtl.action = "pending_qc_assign";
        $log.log(qc_assign_dtl);
        baseFactory.deviceCall(qc_assign_dtl)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                        $scope.SearchPendingQc();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    };
    $scope.AssignObservations = function (observations_assign_dtls) {
        /*$scope.getHodBmes();*/
        observations_assign_dtls.action = "observation_assign";
        $log.debug("Assig OBS");
        $log.debug(observations_assign_dtls);
        baseFactory.UserCtrl(observations_assign_dtls)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                        $scope.loadAdverseIncedents();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    };

    $scope.TrainingsApproved = function () {
        $scope.training_list.action = "get_trainings";
        $log.log($scope.training_list);
        baseFactory.deviceCall($scope.training_list)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.approved_trainings = angular.fromJson(payload.tranings_approved)
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.approved_trainings = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    };
    $scope.RemindToHod = function (data, type) {
        $log.debug(data);
        $log.debug(type);
        if (type == $scope.ROUND) {
            data.action = "remaind_pending_round_hod";
            baseFactory.baseCall(data)
                .then(function (payload) {
                        $log.info(payload);
                        if (payload.response == $rootScope.successdata) {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                        }
                        else {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                        }
                    },
                    function (errorPayload) {
                        $log.error("Failure Loading", errorPayload)
                    });

        }

    };
    $scope.RemindtoBME = function (data, type) {
        data.type = type;
        data.action = "remaind_to_bme";
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                    else {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error("Failure Loading", errorPayload)
                });
    };

    $scope.TrainingFeedback = function (training_approved_list) {
        $scope.training_approved_list.action = "training_feedback";
        $log.log($scope.training_approved_list);
        baseFactory.deviceCall($scope.training_approved_list)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.feedback_trainings = angular.fromJson(payload.tranings_feedback)
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.feedback_trainings = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    };
    function _MyTrainingFeedbacks($scope, $mdDialog, feedback_id) {
        $scope.fetchMyTrainingFeedbacks(feedback_id);
        $log.debug(feedback_id);
    }
    /*$scope.getQCDevicesByQCID = function (data)
    {
        baseFactory.deviceCall(data)
        .then(function (payload)
        {
            $log.info(payload);
            if (payload.response == $rootScope.successdata) {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
                $scope.hide();
                $state.forceReload();
            }
            else if (payload.response == $rootScope.failedata)
            {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
                $scope.hide();
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };*/
    $scope.PendingQcDialog = function (event, pqc_device)
    {
        var template_name = 'device/pendingqc_dailog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: event,
            locals: {pqc_device_data: pqc_device},
            controller: _PendingQcDialogCtrl
        }).then(function (answer) {
            },
            function () {
            });
    };
    function _PendingQcDialogCtrl($scope, $mdDialog, pqc_device_data) {
        $scope.getHodBmes();
		$scope.loadUser();
        $log.debug(pqc_device_data);
        $scope.pqc_device_data = pqc_device_data;
        $scope.pqc_device_data.qccompleteremarks = "Completed";
        $scope.pqc_device_data.qcassignremarks = "Assigned";
        $scope.qc_reports=[];
        $scope.SelfPendingqc = function (data)
        {
            var files=[];

            files=files.concat($scope.qc_reports);
            $log.debug(data);
            baseFactory.addQCFileUpload(data,files,'device/pending_qc_self')
            .then(function (payload)
            {
                $log.info(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.toast_text = payload.call_back;
                    $scope.showToast();
                    $scope.hide();
                //    $state.go('home.hbhod_pending_qcs');
                    $state.forceReload();
                }
                else if (payload.response == $rootScope.failedata)
                {
                    $scope.toast_text = payload.call_back;
                    $scope.showToast();
                    $scope.hide();
                }
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });

        };
    }

    $scope.qc_divs = {assigndiv: true, selfdiv: true};
    /* used for hide divs in registration */
    $scope.pendingqc = {qc: "YES"};
    $scope.$watch('pendingqc.qc', function (newValue, oldValue)  /*  used in on change radio buttons in registration */
    {
        if (newValue == "YES") {
            $scope.qc_divs.assigndiv = true;
            $scope.qc_divs.selfdiv = false;
        }
        else if (newValue == "NO") {
            $scope.qc_divs.assigndiv = false;
            $scope.qc_divs.selfdiv = true;
        }
    }, true);

    $scope.PendingPmsDialog = function (event, ppms_device) {
        var template_name = 'device/pendingpms_dailog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: event,
            locals: {ppms_device_data: ppms_device},
            controller: _PendingPmsDialogCtrl
        }).then(function (answer) {
            },
            function () {
            });
    };
    function _PendingPmsDialogCtrl($scope, $mdDialog, ppms_device_data) {
        $scope.getHodBmes();
		$scope.loadUser();
        $log.debug(ppms_device_data);
        $scope.ppms_device_data = ppms_device_data;
        $scope.ppms_device_data.pmscompleteremarks = "Completed";
        $scope.ppms_device_data.pmsassignremarks = "Assigned";
        $scope.pms_files=[];
        $scope.NotAssignPendingpms = function (data) {
            var files=[];
            files=files.concat($scope.pms_files);
            $log.warn("dadadad");
            $log.log(data);
            baseFactory.addQCFileUpload(data,files,'device/pending_pms_self')
                .then(function (payload) {
                        $log.info("pending_pms_self payload");
                        $log.info(payload);
                        if (payload.response == $rootScope.successdata) {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                            $scope.hide();
                            $state.forceReload();
                        }
                        else if (payload.response == $rootScope.failedata) {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        };
    }

    $scope.pms_divs = {assigndiv: true, selfdiv: true};
    /* used for hide divs in registration */
    $scope.pendingpms = {ppm: "YES"};
    $scope.$watch('pendingpms.ppm', function (newValue, oldValue)  /*  used in on change radio buttons in registration */ {
        if (newValue == "YES") {
            $scope.pms_divs.assigndiv = true;
            $scope.pms_divs.selfdiv = false;
        }
        else if (newValue == "NO") {
            $scope.pms_divs.assigndiv = false;
            $scope.pms_divs.selfdiv = true;
        }
    }, true);
    /*$scope.issueChange = function()
     {
     $log.log($scope.fcg.complaint);
     if($scope.fcg.complaint==$scope.Other)
     {

     }
     }*/
    $scope.AssignPendingpms = function (pms_assign_dtls,assign_to)
    {
        $log.debug(pms_assign_dtls);
        var pms_assign_dtl = {};
        pms_assign_dtl.values = pms_assign_dtls;
        pms_assign_dtl.assignto = assign_to;
        $log.debug(pms_assign_dtl);
        pms_assign_dtl.action = "pending_pms_assign";
        $log.log(pms_assign_dtl);
        baseFactory.deviceCall(pms_assign_dtl)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.cancel();
                        $scope.SearchPendingPms();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.SelfPendingqc1 = function (qc_sejfassign_dtls) {
        $log.debug(qc_sejfassign_dtls);
        qc_sejfassign_dtls.action = "pending_qc_self";
        $log.log(qc_sejfassign_dtls);
        baseFactory.deviceCall(qc_sejfassign_dtls)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    };

    $scope.NotAssignPendingpms = function (pms_notassign_dtls) {
        $log.debug(pms_notassign_dtls);
        pms_notassign_dtls.action = "pending_pms_self";
        $log.log(pms_notassign_dtls);
        baseFactory.deviceCall(pms_notassign_dtls)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadIncidentType = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var itype;
            if (typeof limit_val === 'undefined')
                itype = 0;
            else if (limit_val == 0)
                itype = 0;
            else
                itype = limit_val - 1;
            $log.error(itype);
            var send = {limit_val: itype, action: "get_incident_type_list",user_org_module:$scope.user_org_module};
        }
        else {
            var send = {action: "get_incident_type_list",user_org_module:$scope.user_org_module};
        }
        send.branch_id = $scope.user_branch;
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.itypes = angular.fromJson(payload.list);
						$scope.itypes_label = angular.fromJson(payload.labels);
                        if(limit_val != $scope.nostate)
                        {
                            $scope.paging.total = payload.rcnt;
                            $scope.no_of_recs = payload.no_of_recs;
                        }
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.itypes = null;
						$scope.itypes_label = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.RespondToCall = function (event, device_details, respond_type)
    {

        $scope.cms_to_incident = [];
        $scope.loadContracts();
        $scope.device_vendor_data = null;
        device_details.assignremarks="Assigning";
        device_details.org_id = device_details.ORG_ID;
        if (respond_type == $scope.after_respond)
        {
           // ratc_device_dtls.assignremarks
            device_details.assignremarks="Assigning";
            device_details.REMARKS="Attending";
            var template_name = 'device/call_attend_dailog';
        }

        else if (respond_type == $scope.before_respond)
        {
            device_details.branch_id = device_details.BRANCH_ID;
            device_details.assignremarks="Assigning";
            device_details.REMARKS="Assigning";
            device_details.assignremarks="Assigning";
            device_details.respondremarks="Responding";
            var template_name = 'device/call_respond_dailog';
        }

        else if (respond_type == $scope.make_pending_call)
        {
           device_details.branch_id = device_details.BRANCH_ID;           
		   device_details.REMARKS="Completed";
            var template_name = 'device/call_pending_dailog';
            $scope.causeCodes();
        }
        else if (respond_type == $scope.complete_call)
        {
             device_details.branch_id = device_details.BRANCH_ID;
			device_details.REMARKS="Completed";
            var template_name = 'device/call_pending_assign';
        }

        else if (respond_type == $scope.Vendor)
        {
            $scope.getEquipmentVendorDetails(device_details.EID);
            device_details.vendor_user_id = '';
            var template_name = 'device/call_attend_dailog';
        }
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            autoWrap: false,
            parent: angular.element(document.body),
            targetEvent: event,
            locals: {rtc_device_dtls: device_details},
            controller: _respondToCallDialogCtrl
        }).then(function (answer) {
            },
            function () {
            });
    };

    function _respondToCallDialogCtrl($scope, $mdDialog, rtc_device_dtls)
    {
        $scope.rtc_device_dtls = rtc_device_dtls;
        /*respond call*/
        $scope.atc_device_dtls = rtc_device_dtls;
        /*assign call*/
        $scope.artc_device_dtls = rtc_device_dtls;
        /* attend responded or assigned call */
        $scope.ratc_device_dtls = rtc_device_dtls;
        /* re assign assigned or responded call */
        $scope.mpending_device_dtls = rtc_device_dtls;
		
        $scope.ratc_device_dtls.assignremarks = "Assiging";
        $scope.ctc_device_dtls = rtc_device_dtls;
		 //$scope.ctcc_device_dtls = rtc_device_dtls;
        if ($scope.ctc_device_dtls.DELIVERY_DATE != null) {
            $scope.ctc_device_dtls.DELIVERY_DATE = new Date($scope.ctc_device_dtls.DELIVERY_DATE);
        }
        if ($scope.ctc_device_dtls.PO_DATE != null) {
            $scope.ctc_device_dtls.PO_DATE = new Date($scope.ctc_device_dtls.PO_DATE);
        }
        if ($scope.ctc_device_dtls.COST == null || $scope.ctc_device_dtls.COST == 0)
            $scope.ctc_device_dtls.COST = "";
        $scope.getHodBmes();


    }
    $scope.cms_to_incident = [];
    $scope.loadIncidentType($scope.nostate);
    $scope.callRespondAsIncidentCall = function(menu,list)
    {
        var idx = list.indexOf(menu);
        $log.log(idx);
        if (idx > -1) {
            list.splice(idx, 1);
        }
        else {
            list.push(menu);
        }
        $log.log($scope.cms_to_incident);
    };
    $scope.cms_and_gatepass = [];
    $scope.TransferAndGatePass = function(menu,list)
    {
        var idx = list.indexOf(menu);
        $log.log(idx);
        if (idx > -1) {
            list.splice(idx, 1);

        }
        else {
            list.push(menu);
        }
        $log.log($scope.cms_and_gatepass);
    };

    $scope.selfRespondToCall = function (rtc_device_dtls) {
        rtc_device_dtls.action = "self_respond_call";
		rtc_device_dtls.branch_id = rtc_device_dtls.BRANCH_ID; 
        rtc_device_dtls.orgg_id = $scope.user_org;	
        console.log(JSON.stringify(rtc_device_dtls));
        baseFactory.deviceCall(rtc_device_dtls)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                        $state.go('home.hbhod_responded_calls');
                       // $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                    else if (payload.response == $rootScope.exsitsdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                     //   $state.forceReload();
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.assignCall = function (atc_device_dtls) {
        atc_device_dtls.action = "assign_call";
        //atc_device_dtls.branch_id = $scope.user_branch;
		  atc_device_dtls.branch_id = atc_device_dtls.BRANCH_ID;
        atc_device_dtls.orgg_id = $scope.user_org;
        console.log(JSON.stringify(atc_device_dtls));
        baseFactory.deviceCall(atc_device_dtls)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                        //$state.go('home.hbhod_responded_calls');
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	$scope.reassignCall = function (ratc_device_dtls) {
        ratc_device_dtls.action = "re_assign_call";
        //atc_device_dtls.branch_id = $scope.user_branch;
        ratc_device_dtls.branch_id = ratc_device_dtls.BRANCH_ID;
        ratc_device_dtls.orgg_id = $scope.user_org;
        $log.info(JSON.stringify(ratc_device_dtls));
       // return false;
        baseFactory.deviceCall(ratc_device_dtls)
            .then(function (payload) {
                    console.log(payload);
				//	return false;
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                        //$state.go('home.hbhod_responded_calls');
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	
	 $scope.pendingreassignCall = function (ctcc_device_dtls) {
        ctcc_device_dtls.action = "re_pending_assign_call";
        //atc_device_dtls.branch_id = $scope.user_branch;
        ctcc_device_dtls.branch_id = ctcc_device_dtls.BRANCH_ID;
        ctcc_device_dtls.orgg_id = $scope.user_org;
        $log.info(JSON.stringify(ctcc_device_dtls));
       // return false;
        baseFactory.deviceCall(ctcc_device_dtls)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                        //$state.go('home.hbhod_responded_calls');
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

	

    $scope.AttendRespondedCall = function (artc_device_dtls)
    {
        if($scope.isEmpty($scope.cms_to_incident))
        {
            artc_device_dtls.REMARKS="Attended";
            artc_device_dtls.action = "attend_responded_call";
           // artc_device_dtls.branch_id = $scope.user_branch;
			artc_device_dtls.orgg_id = $scope.user_org;
            artc_device_dtls.branch_id = artc_device_dtls.BRANCH_ID;
            $log.log(JSON.stringify(artc_device_dtls));
          //  artc_device_dtls.branch_id = $scope.BRANCH_ID;
		  $log.log(artc_device_dtls);
		 
            baseFactory.deviceCall(artc_device_dtls)
            .then(function (payload)
            {
                $log.info(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.toast_text = payload.call_back;
                    $scope.showToast();
                    $scope.hide();
                    $state.go('home.hbhod_attended_calls');
                    //$state.forceReload();
                }
                else if (payload.response == $rootScope.failedata) {
                    $scope.toast_text = payload.call_back;
                    $scope.showToast();
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.toast_text = payload.call_back;
                    $scope.showToast();
                    $scope.hide();
                }
            },
            function (errorPayload) {
            $log.error('failure loading', errorPayload);
            });
        }
        else
        {
            artc_device_dtls.action = "add_incidents";
            //artc_device_dtls.branch_id = $scope.user_branch;
            artc_device_dtls.branch_id = artc_device_dtls.BRANCH_ID;
		//	artc_device_dtls.orgg_id = $scope.user_org;
            artc_device_dtls.user_id = artc_device_dtls.CEMP_ID;
            artc_device_dtls.user_name = artc_device_dtls.CALLER_NAME;
            artc_device_dtls.equp_id =  artc_device_dtls.EID;
            artc_device_dtls.feedback = artc_device_dtls.REMARKS;
            artc_device_dtls.departments = artc_device_dtls.CALLER_DEPT;
            artc_device_dtls.form_cms = $rootScope.yesstate;
            artc_device_dtls.cms_id= artc_device_dtls.ID;
			console.log(JSON.stringify(artc_device_dtls));
            baseFactory.UserCtrl(artc_device_dtls)
            .then(function (payload)
            {
                $log.info(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.toast_text = payload.call_back;
                    $scope.showToast();
                    $scope.hide();
                    $state.go('home.adverse_calls');
                    //$state.forceReload();
                }
                else if (payload.response == $rootScope.failedata)
                {
                    $scope.toast_text = payload.call_back;
                    $scope.showToast();
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.toast_text = payload.call_back;
                    $scope.showToast();
                    $scope.hide();
                }
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });
        }
        $log.warn("attend_call");
        $log.debug(artc_device_dtls);
    };
    $scope.causeCodes = function()
    {
        var data = {action: "get_cause_codes"};
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cause_codes = angular.fromJson(payload.causecodes);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cause_codes = payload.causecodes;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MakeCallAsPending = function (pending_data)
    {
        pending_data.action = "make_pending_call";
        //pending_data.branch_id = $scope.user_branch;
        pending_data.orgg_id = $scope.user_org;
		pending_data.branch_id = pending_data.BRANCH_ID;
        $log.log(JSON.stringify(pending_data));
        
        if(angular.lowercase(pending_data.PENDING_REASON)=="other")
        {
            pending_data.PENDING_REASON = pending_data.other_reason;
        }
        $log.debug(pending_data);
        baseFactory.deviceCall(pending_data)
            .then(function (payload)
            {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata)
                    {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                        $state.go('home.hbhod_propen_calls');
                        //$state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata)
                    {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.completeCall = function (completing_call_data) {
        completing_call_data.action = "complete_the_call";
        //completing_call_data.branch_id = $scope.user_branch;
		completing_call_data.branch_id = completing_call_data.BRANCH_ID;
        completing_call_data.orgg_id = $scope.user_org;
      //  completing_call_data.user_id = completing_call_data.USER_ID;
        $log.log(completing_call_data);
      
        baseFactory.deviceCall(completing_call_data)
            .then(function (payload) {
                    $log.info(payload);
				//	return false;
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                        $state.go('home.hbhod_completed_calls');
                      //  $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    /* Rounds */
    $scope.StartRound = function (ev, round_assigned) {
        $log.log(round_assigned);
        if (round_assigned != undefined)
        {
            var template_name = 'device/round_assign_dialog';
            $mdDialog.show({
                templateUrl: template_name,
                clickOutsideToClose: false,
                scope: $scope,        // use parent scope in template
                preserveScope: true,  // do not forget this if use parent scope
                parent: angular.element(document.body),
                targetEvent: ev,
                locals: {round_assigned: round_assigned},
                controller: _RoundAttendOrAssignrCtrl
            }).then(function () {
                },
                function () {
                });
        }
    };
    $scope.AttendRound = function (round_assigned) {
        if (round_assigned != undefined) {
            $log.error("Attending");
            $log.warn(round_assigned);
            round_assigned.sround = new Date();
            $scope.RoundSubmitStartTime(round_assigned);
        }
    };
    function _RoundAttendOrAssignrCtrl(round_assigned) {
        $scope.getHodBmes();
        $scope.round_assigned = round_assigned;
    }

    $scope.removeAssignedRound = function (item) {
        var index = $scope.round_assigneds.indexOf(item);
        $scope.round_assigneds.splice(index, 1);
    };
   /* $scope.RoundSubmit = function (round_assigned)
    {
        $scope.round_start.ID = round_assigned.ID;
        $scope.round_start.departments = round_assigned.DEPT_ID;
        $scope.round_start.action = "submit_round";
        $scope.round_start.rid = round_assigned.rid;
        $scope.round_start.remarks = round_assigned.remarks;
        $log.info($scope.round_start);
        baseFactory.deviceCall($scope.round_start)
        .then(function (payload)
        {
            $log.info(payload);
            if (payload.response == $rootScope.successdata)
            {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
                $scope.loadRoundAssigned($scope.nostate);
                $state.forceReload();
            }
            else if (payload.response == $rootScope.failedata)
            {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };*/
	
	 $scope.RoundSubmit = function (data)
   {
       console.log("fgfg");
    //   var files = [];
      // files = files.concat($scope.rounds_docs);
       var files = $scope.rounds_docs;

       console.log('file is ' );
      // console.dir(file);
       console.log(files);
       data.branch_id = $scope.user_branch;
       console.log(data);
      // return false;
       baseFactory.addRoundFileUpload(data, files, 'device/submit_round')
           .then(function (payload) {
                   console.log(payload);
                  // return false;
                   if (payload.response == $rootScope.successdata) {
                       $scope.toast_text = payload.call_back;
                       $scope.mdDialogHide();
                       $scope.showToast();
                       $state.forceReload();
                   }
                   else if (payload.response == $rootScope.failedata) {
                       $scope.toast_text = payload.call_back;
                       $scope.showToast();
                   }
               },
               function (errorPayload) {
                   $log.error('failure loading', errorPayload);
               });
   };

    $scope.RoundSubmit1 = function (ev,round_assigned)
    {
        if (round_assigned != undefined)
        {
            var template_name = 'device/round_complete_dialog';
            $mdDialog.show({
                templateUrl: template_name,
                clickOutsideToClose: false,
                scope: $scope,        // use parent scope in template
                preserveScope: true,  // do not forget this if use parent scope
                parent: angular.element(document.body),
                targetEvent: ev,
                locals: {round_assigned: round_assigned},
                controller: _RoundAttendOrAssignrCtrl1
            }).then(function () {
                },
                function () {
                });
        }
    };
    function _RoundAttendOrAssignrCtrl1(round_assigned)
    {
        $scope.round_complete = round_assigned;
    }
    $scope.RoundSubmitStartTime = function (round_assigned) {
		$scope.round_start.branch_id = round_assigned.BRANCH_ID;
        $scope.round_start.departments = round_assigned.DEPT_ID;
        $scope.round_start.sround = round_assigned.sround;
        $scope.round_start.ID = round_assigned.ID;
        $scope.round_start.action = "submit_round_start_time";
        baseFactory.deviceCall($scope.round_start)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.cancel();
                        $scope.loadRoundAssigned($scope.nostate);
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadRoundCompleted = function (limit_val) /* Training By Details */ {
        if (limit_val != $scope.nostate) {
            var crounds;
            if (typeof limit_val === 'undefined')
                crounds = 0;
            else if (limit_val == 0)
                crounds = 0;
            else
                crounds = limit_val - 1;
            $log.error(crounds);
            $scope.rounds_completed_search.limit_val = crounds;
        }
        else {
            delete $scope.rounds_completed_search.limit_val;
        }
        $scope.rounds_completed_search.branch_id = $scope.user_branch;
        $scope.rounds_completed_search.action = "get_complete_round";
        $log.debug($scope.rounds_completed_search.action);
        console.log($scope.rounds_completed_search);
        baseFactory.deviceCall($scope.rounds_completed_search)
            .then(function (payload) {
                    $log.debug($scope.rounds_completed_search.action);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.round_complets = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.round_complets = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.RoundAssign = function (round_assign) {
		//round_assign.branch_id = $scope.user_branch;
        round_assign.action = "assign_round";
        $log.debug("Assigning Round");
        $log.debug(round_assign);
        baseFactory.deviceCall(round_assign)
        .then(function (payload)
        {
            if (payload.response == $rootScope.successdata)
            {
                $scope.toast_text = payload.call_back;
                $scope.mdDialogHide();
                $scope.showToast();
                $scope.round_assign = {};
                /*if($scope.user_role_code==$scope.HBHOD)
                 $state.go('home.hbhod_rounds_assigned');
                 else if($scope.user_role_code==$scope.HBBME)
                 $state.go('home.hbbme_rounds_assigned');*/
                $state.go($scope.user_path);
            }
            else if (payload.response == $rootScope.failedata)
            {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
                $scope.round_assign = {};
            }
            $log.debug(payload);
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };


    /* Reassign Round */
    $scope.ReRoundAssign = function (round) {
        $log.log("Reasigning Round");
        round.action = "re_assign_round";
        $log.debug(round);
        baseFactory.deviceCall(round)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.forceReload();
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
    /*Rounds Assigned*/
    $scope.loadRoundAssigned = function (limit_val, hod_call) /* Training By Details */ {
        if (limit_val != $scope.nostate) {
            var rrounds;
            if (typeof limit_val === 'undefined')
                rrounds = 0;
            else if (limit_val == 0)
                rrounds = 0;
            else
                rrounds = limit_val - 1;
            $log.error(rrounds);
            var send = {limit_val: rrounds, action: "get_assigned_round"};
        }
        else {
            var send = {action: "get_assigned_round"};
        }
        if (typeof hod_call != "undefined") {
            if (hod_call == "get_hod_calls")
                send.aaction = hod_call;
            else if (hod_call == "get_assigned_calls")
                send.aaction = "get_assigned_calls";
            else {
                delete send.aaction;
            }
        }
        else {
            delete send.aaction;
        }
        send.branch_id = $scope.user_branch;

        $log.debug(send.action);
        //$log.debug(JSON.stringify(send));
        baseFactory.deviceCall(send)
        .then(function (payload)
        {
            //console.log("Rounds Here");
            //$log.info(JSON.stringify(payload));
            if (payload.response == $rootScope.successdata)
            {
                $scope.round_assigneds = angular.fromJson(payload.list);
                $scope.round_assigneds_started = payload.rounds_started;
                $scope.paging.total = payload.rcnt;
                $scope.no_of_recs = payload.no_of_recs;
            }
            else if (payload.response == $rootScope.emptydata)
            {
                $scope.round_assigneds = null;
                $scope.paging.total = payload.rcnt;
                $scope.no_of_recs = payload.no_of_recs;
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    /*Rounds Assigned*/
    $scope.getBranchUsers = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var busers;
            if (typeof limit_val === 'undefined')
                busers = 0;
            else if (limit_val == 0)
                busers = 0;
            else
                busers = limit_val - 1;
            $log.error(busers);
           // $scope.gbbranchid = branchid;
            var send = {limit_val: busers, action: "get_branch_users", branch_id: $scope.user_branch};
        }
        else {
           // $scope.gbbranchid = branchid;
            var send = {action: "get_branch_users", branch_id: $scope.user_branch};
        }
       console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    //$log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.users = angular.fromJson(payload.users);
						$scope.users_label = angular.fromJson(payload.labels);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        console.log($scope.users);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                        $scope.users = null;
						$scope.users_label = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addUser = function (add_user) {
        console.log(add_user);

        if (typeof add_user.branch_id === 'undefined')
        {
            add_user.branch_id = [];
            $scope.user_branch = $cookies.get('user_branch');
            add_user.branch_id[0] = $scope.user_branch;
            $log.log(add_user.branch_id);
        }
        add_user.action = "add_new_user";
        $log.debug(add_user);
        baseFactory.UserCtrl(add_user)
            .then(function (payload) {
                    console.log(payload);

                    if (payload.response == $rootScope.successdata) {
                        $scope.add_user = {};
                        $scope.showToastText(payload.call_back);
                        if ($scope.user_role_code == $scope.HMADMIN) {
                            $scope.getBranchUsers(add_user.branch_id[0]);
                            $scope.getBranchUsers();
							$state.go('home.hbhod_users');
                            //$state.go('home.hmadmin_users');

                        }
                        else if ($scope.user_role_code == $scope.HBHOD) {
                            $scope.getBranchUsers();
                            $state.go('home.hbhod_users');
                        }
                        else if ($scope.user_role_code == $scope.HBBME) {
                            $scope.getBranchUsers();
                            $state.go('home.hbhod_users');
							//$state.go('home.hbbme_users');
                        }
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.showToastText(payload.call_back);
                    }
                    else if (payload.response == $rootScope.exsitsdata) {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editUser = function (ev, user_data) {
        $scope.loadBranches();
        $scope.getOrgRoles();

        var template_name = 'user/edit_user_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {user_data: user_data},
            controller: _UserCtrl
        }).then(function () {
            },
            function () {
            });
			
		  $scope.toggle = function (item, list) {
            var idx = list.indexOf(item.BRANCH_ID);
            if (idx > -1) {
                $scope.euser_data.org_branch_id.splice(idx, 1);
            }
            else {
                $scope.euser_data.org_branch_id.push(item.BRANCH_ID);
            }
        }

        $scope.isIndeterminate = function() {
            return ($scope.euser_data.org_branch_id.length !== 0 &&
            $scope.euser_data.org_branch_id.length !== $scope.branchs.length - 1);
        };

        $scope.isChecked = function() {
            return $scope.euser_data.org_branch_id.length === $scope.branchs.length - 1;
        };

        $scope.exists = function (item, list) {
            return list.indexOf(item.BRANCH_ID) > -1;
        };

        $scope.toggleAll = function() {
            if ($scope.euser_data.org_branch_id.length === $scope.branchs.length - 1) {
                $scope.euser_data.org_branch_id = [];
            } else if ($scope.euser_data.org_branch_id.length === 0 || $scope.euser_data.org_branch_id.length > 0) {

                $scope.euser_data.org_branch_id = [];
                for (var i = 0; i < $scope.branchs.length; i++) {
                    if($scope.branchs[i]['BRANCH_ID'] != 'All')
                    $scope.euser_data.org_branch_id.push($scope.branchs[i]['BRANCH_ID']);
                }
            }
        };

    };

    function _UserCtrl($scope, user_data) {
        $log.info(user_data);
        $scope.euser_data = "";
        $scope.euser_data = user_data;
        $scope.euser_data.org_branch_id = $scope.euser_data.ORG_BRANCH_ID.split(',');
    }

    $scope.UpdateUser = function (user_data) {
        user_data.action = "update_user";

        $log.warn(user_data);
        baseFactory.UserCtrl(user_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.showToastText(payload.call_back);
                        $log.log($cookies.get('user_branch'));
                           $scope.getBranchUsers($scope.gbbranchid);
                        $scope.hide();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
        $log.log(user_data);
    };
    $scope.addVednorEquipments = function (vd_list) {
        var data = {};
        data.etype = vd_list.vdevice_type;
        data.ename = vd_list.vdevice_name;
        data.ectype = vd_list.vdevice_ctype;
        $scope.add_vendor.devices.push(data);
        $scope.add_vendor.vdevice_type = null;
        $scope.add_vendor.vdevice_name = null;
        $scope.add_vendor.vdevice_ctype = null;
    };
    $scope.removeVednorEquipment = function (add_vendor_device) {
        $scope.add_vendor.devices.splice($scope.add_vendor.devices.indexOf(add_vendor_device), 1);
    };
    /*   $scope.removeVednorOrgnasation = function(add_hospitals_orgnasation)
     {
     $scope.add_hospitals_orgnasation.devices.splice($scope.add_hospitals_orgnasation.devices.indexOf(add_hospitals_orgnasation),1);
     };*/
    $scope.getRoundsDepts = function (rounddata)  /* To Get branch List */ {
        rounddata.action = "get_rounds_depts";
        baseFactory.deviceCall(rounddata)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.depts = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.depts = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadUserRoundsDepartments = function () {
        var ip_data = {};
        ip_data.action = "get_user_sround_depts";
        baseFactory.baseCall(ip_data)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.depts = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.depts = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadBranches = function ()  /* To Get branch List */ {
        var send = {action: "get_branches"};
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.log("get_branches");
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.branchs = angular.fromJson(payload.branchs);
                    }
                    else if (payload.response == $rootScope.emptydata)
                    {
                        $scope.branchs = [{BRANCH_ID: "", BRANCH_NAME: "No Branchs Found"}];
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	$scope.getallbranches = function (){
        var send = {action: "get_all_branches"};
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    //$log.log("get_all_branches");
                   // console.log(payload.list);
                    if (payload.response == $rootScope.successdata) {
                        $scope.branches = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata)
                    {
                        $scope.branches = [{BRANCH_ID: "", BRANCH_NAME: "No Branchs Found"}];
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getUserBranches = function (user_role_code, emp_no) {
        var send = {action: "get_user_branches", role_code: user_role_code, empno: emp_no};
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.user_branchs = angular.fromJson(payload.branchs);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.user_branchs = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    //$scope.getUserBranches($scope.user_role_code,$scope.emp_no);


    /*  Vendors*/



    $scope.loadVendorList = function (limit_val)  /* To Get branch List */ {
        $scope.add_vendor={};
        if (typeof limit_val === 'undefined')
            $scope.vendor_search.limit_val = 0;
        else if (limit_val == 0)
            $scope.vendor_search.limit_val = 0;
        else
            $scope.vendor_search.limit_val = limit_val - 1;
       // $log.error(limit_val);
        //$scope.vendors = "Fetching Data, Please Wait...";
       // $log.log($scope.searched);
        if ($scope.searched.VENDOR == null)
            $scope.vendor_search.vendor_name = "";
        else if (typeof $scope.searched.VENDOR === 'object')
            $scope.vendor_search.vendor_name = $scope.searched.VENDOR.NAME;
        else
            $scope.vendor_search.vendor_name = "";

        if ($scope.searched.CONTACT_PERSON == null)
            $scope.vendor_search.contact_person = "";
        else if (typeof $scope.searched.CONTACT_PERSON === 'object')
            $scope.vendor_search.contact_person = $scope.searched.CONTACT_PERSON.CP_NAME;
        else
            $scope.vendor_search.contact_person = "";
        $scope.vendor_search.action = "get_vendor_list";
        $scope.vendor_search.branch_id = $scope.user_branch;
        console.log($scope.vendor_search);
        baseFactory.UserCtrl($scope.vendor_search)
            .then(function (payload) {
                     console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.vendors = angular.fromJson(payload.list);
						$scope.vendor_label = angular.fromJson(payload.labels); 
                        $scope.paging.total = payload.rcnt;
                        $scope.vendors.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.vendors = "No Vendors Found";
						$scope.vendor_label = "NO";
                        $scope.paging.total = $scope.vendors.no_of_recs = $scope.paging.current = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addVendor = function (add_vendor) {
        add_vendor.action = "add_new_vendor";
        add_vendor.cp_details = $scope.all_cps;
        $log.debug(add_vendor);
        baseFactory.UserCtrl(add_vendor)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadVendorList();
                        $state.go("home.hbhod_vendors");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
       $scope.add_module={};
    $scope.addhaVendor = function (add_vendor) {
        add_vendor.action = "add_new_vendor";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(JSON.stringify(add_vendor));
		return false;
        baseFactory.UserCtrl(add_vendor)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadhavendorlist();
                        $state.go("home.haadmin_vendors");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	$scope.addhamodule = function (add_module) {
        add_module.action = "add_new_module";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_module);
        baseFactory.UserCtrl(add_module)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadhamodulelist();
                        $state.go("home.haadmin_modules");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addUSerLabels = function (add_user_label) {
        add_user_label.action = "add_user_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_user_label);
        baseFactory.Mainadmin(add_user_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_user_label");
						
						

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }; 

    $scope.addDepreciationlabel = function (add_depreciation_label) {
		console.log("fhfh");
        add_depreciation_label.action = "add_depreciation_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_depreciation_label);
        baseFactory.Mainadmin(add_depreciation_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_depreciation_label");
						
						

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };	
	
	$scope.loadStatuslabel = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var status_label;
            if (typeof limit_val === 'undefined')
                status_label = 0;
            else if (limit_val == 0)
                status_label = 0;
            else
                status_label = limit_val - 1;
            $log.error(status_label);
            var send = {limit_val: status_label, action: "get_status_label"};
        }
        else
        {
            var send = {action: "get_status_label"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.status_label = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.status_label = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

	 $scope.loadDepreciationlabel = function (limit_val) /* User Status */ {
        if (limit_val != $scope.nostate)
        {
            var status_label;
            if (typeof limit_val === 'undefined')
                status_label = 0;
            else if (limit_val == 0)
                status_label = 0;
            else
                status_label = limit_val - 1;
            $log.error(status_label);
            var send = {limit_val: status_label, action: "get_depreciation_label"};
        }
        else
        {
            var send = {action: "get_depreciation_label"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.depreciation_label = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.depreciation_label = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

	
	
	$scope.addStatusLabel = function (add_status_label) {
        add_status_label.action = "add_status_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_status_label);
        baseFactory.Mainadmin(add_status_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_status_label");
						
						

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addEsctypeLabels = function (add_esctype_label) {
        add_esctype_label.action = "add_esctype_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_esctype_label);
        baseFactory.Mainadmin(add_esctype_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_esctype_label");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addEsclevelLabels = function (add_esclevel_label) {
        add_esclevel_label.action = "add_esclevel_label";
    //add_havendor.cp_details = $scope.all_cps;
    console.log(add_esclevel_label);
    baseFactory.Mainadmin(add_esclevel_label)
        .then(function (payload){
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.toast_text = payload.call_back;
                    //$scope.mdDialogHide();
                    $scope.showToast();
					$state.go("home.haadmin_escalationlevel_label");

                }
                else if (payload.response == $rootScope.failedata) {
                    $scope.toast_text = payload.call_back;
                    $scope.showToast();
                    //$scope.DeviceVendors();
                }
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });
};

    $scope.addEscalationLabels = function (add_escalation_label) {
        add_escalation_label.action = "add_escalation_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_escalation_label);
        baseFactory.Mainadmin(add_escalation_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_escalation_label");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addRolelabels = function (add_role_label) {
        add_role_label.action = "add_role_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_role_label);
        baseFactory.Mainadmin(add_role_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_role_labels");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addVendorlabel = function (add_vendor_label) {
        add_vendor_label.action = "add_vendor_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_vendor_label);
        baseFactory.Mainadmin(add_vendor_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_vendor_label");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
        
		
		$scope.addDevicelabel = function (add_device_label) {
        add_device_label.action = "add_device_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_device_label);
        baseFactory.Mainadmin(add_device_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_device_label");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
       
	   
	   
		$scope.additemmaster = function (add_item_master) {
        add_item_master.action = "add_item_master";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_item_master);
        baseFactory.Mainadmin(add_item_master)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.hadmin_item_master");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	   
	   
	   
    $scope.addBranchLabels = function (add_branch_label) {
        add_branch_label.action = "add_branch_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_branch_label);
        baseFactory.Mainadmin(add_branch_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_branch_label");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	$scope.addTablelabel = function (add_table_name) {
        add_table_name.action = "add_table_name";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_table_name);
        baseFactory.Mainadmin(add_table_name)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.get_table_name");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
 
 $scope.addMasterTable = function (add_master_table) {
        add_master_table.action = "add_master_table";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_master_table);
        baseFactory.Mainadmin(add_master_table)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.ha_master_table");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
 
 
 
 
 
 
    $scope.addcontracttypelabel = function (add_contracttype_label) {
        add_contracttype_label.action = "add_contracttype_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_contracttype_label);
        baseFactory.Mainadmin(add_contracttype_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_contracttype_labels");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addincidenttypelabel = function (add_incidenttype_label) {
        add_incidenttype_label.action = "add_incidenttype_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_incidenttype_label);
        baseFactory.Mainadmin(add_incidenttype_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_incidenttype_labels");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };



    $scope.adddeptLabels = function (add_dept_label) {
        add_dept_label.action = "add_department_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_dept_label);
        baseFactory.Mainadmin(add_dept_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_dept_label");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.adddevicenameLabels = function (add_device_name_label) {
        add_device_name_label.action = "add_devicenames_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_device_name_label);
        baseFactory.Mainadmin(add_device_name_label)
            .then(function (payload){
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.haadmin_devicenames_label");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.equpcondlabelslist = function () {
        var send ={action:"equp_cond_labels_list"}
        console.log(send);
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    //$log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equpconditionlabel = angular.fromJson(payload.list);
                        console.log($scope.equpconditionlabel);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        //console.log($scope.users);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equpconditionlabel = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;

                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.equpcondlabelsorglist = function () {
        var send ={action:"equp_cond_labels_orglist",org_id:$scope.user_org}
        console.log(send);
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    //$log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equpconditionorglabel = angular.fromJson(payload.equpconditionorglabel);
                        console.log($scope.equpconditionorglabel);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        //console.log($scope.users);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equpconditionlabel = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;

                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addequpcondlabel = function (add_equplabel) {
        add_equplabel.action = "add_equpcond_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_equplabel);
        baseFactory.Mainadmin(add_equplabel)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadhamodulelist();
                        $state.go("home.haadmin_equpcondlabels");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addhaequptypelabel = function (add_label) {
        add_label.action = "add_new_equp_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_label);
        baseFactory.Mainadmin(add_label)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadhamodulelist();
                        $state.go("home.haadmin_labels");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.loadhavendorlist = function () {
         var send ={action:"load_havendor_list"}
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    //$log.debug(payload);
                  //  console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.havendors = angular.fromJson(payload.list);
                        console.log($scope.havendors);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        //console.log($scope.users);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                        $scope.havendors = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    /*$scope.loadhavendorlist = function () {
        var send ={action:""}
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    //$log.debug(payload);
                    //  console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.havendors = angular.fromJson(payload.list);
                        console.log($scope.havendors);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        //console.log($scope.users);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                        $scope.havendors = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };*/

	$scope.loadhamodulelist = function () {
         var send ={action:"load_hamodule_list"}
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    //$log.debug(payload);
                  console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.hamodules = angular.fromJson(payload.list);
                        console.log($scope.hamodules);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        //console.log($scope.users);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                        $scope.havendors = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
     
	 
	 $scope.getdatatypes = function(){
		 
		  var send ={action:"get_datatypes"}
        console.log(send);
		baseFactory.Mainadmin(send)
		.then(function(payload){
			console.log(payload);
			if(payload.response == $rootScope.successdata){
				$scope.datatypes = angular.fromJson(payload.list);
			}
			else if(payload.response == $rootScope.emptydata){
				$scope.datatypes = null;
			}
			 },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
		}
	 
	 
	 
    $scope.UpdateVendor = function (user_data) {
        user_data.action = "update_vendor";
        $log.debug(user_data);
        baseFactory.UserCtrl(user_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadVendorList();
                        $state.go("home.hbhod_vendors");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
        $log.log(user_data);
    };

    $scope.editVendorNew = function (ev, vendor_data)
    {
        $scope.add_vendor = {};
        $scope.add_vendor.mbl_no = vendor_data.MOBILE_NO;
        $scope.checktheVendorandCPs($scope.add_vendor.mbl_no);
        $state.go("home.hbbme_add_vendor");
    };
    $scope.editVendor = function (ev, vendor_data)
    {
        $scope.getVendorTypes();
        var template_name = 'user/edit_vendor_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {vendor_data: vendor_data},
            controller: _VendorCtrl
        }).then(function () {
            },
            function () {
            });
    };

    function _VendorCtrl($scope, vendor_data)
    {
        $scope.evendor_data = {};
        $scope.evendor_data = vendor_data;
        $scope.evendor_data.vendor_name = vendor_data.NAME;
        $scope.evendor_data.vendor_mbno = vendor_data.MOBILE_NO;
        $scope.evendor_data.email_id = vendor_data.EMAIL_ID;
        /*$scope.evendor_data.cp_name=vendor_data.CP_NAME;
         $scope.evendor_data.cp_number=vendor_data.CP_NUMBER;
         $scope.evendor_data.cp_email=vendor_data.CP_EMAIL;*/
        $scope.evendor_data.address = vendor_data.ADDRESS;
        if (vendor_data.TYPE != null && vendor_data.TYPE != '')
            $scope.evendor_data.type = vendor_data.TYPE.split(',');
        else
            $scope.evendor_data.type = vendor_data.TYPE;
    }

    /*  Vendors*/

    $scope.getAllCallsCount = function (user_type, uid)
	{
      
		var input = {};
        if (user_type != undefined) {
            input.user_role_code = user_type;
        }
        if (uid != undefined) {
            input.user_id = uid;
        }

        input.action = "get_call_counts";
        input.branch_id = $scope.user_branch;
        baseFactory.deviceCall(input)
        .then(function (payload)
        {
			console.log(payload);
            $scope.call_counts = {};
			$scope.call_counts = payload;
			$log.debug($scope.call_counts);
        },
        function (errorPayload)
        {
            $log.error('failure loading', errorPayload);
        });
    };

    $scope.getUnitWiseSecCounts = function(getsrc)    {

        if(getsrc == undefined)
            var input = {"branch_id":"All"};
        else
            var input = {"branch_id":getsrc.branch_id,"fromdate":getsrc.fromdate,"todate":getsrc.todate,"dept_id":getsrc.dept_id};

        input.action = "get_All_Unit_Counts";
        $log.debug("get_All_Unit_Counts");
        $log.log(input);
        baseFactory.deviceCall(input)
            .then(function (payload)
                {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.unit_devices = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.unit_devices = null;
                    }
                },
                function (errorPayload)
                {
                    $log.error('failure loading', errorPayload);
                });
    }


    $scope.getAllStockCount = function () {
        var send = {};
        send.branch_id = $scope.user_branch;
        send.action = "get_indent_stock_counts";
        $log.error("get_indent_stock_counts");
        $log.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.error(payload);
                    $scope.stock_indent_counts = payload;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getEquipmentVendorDetails = function (edata)
    {
        var vendor_ip = {};
        vendor_ip.EID = edata;
        vendor_ip.action = "get_equipment_vendor_details";
        $log.debug(vendor_ip);
        baseFactory.baseCall(vendor_ip)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.device_vendor_data = payload.vendor;
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.device_vendor_data = "no_vendor";
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.rp_users = null;
    $scope.getRoundPerminentUsers = function (round_data) {
        round_data.action = "get_round_perminent_useres";
        $log.debug(round_data);
        baseFactory.deviceCall(round_data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.rp_users = payload.rp_users;
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.rp_users = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.isEmpty = function (obj) {
        for (var prop in obj) {
            if (obj.hasOwnProperty(prop))
                return false;
        }
        return true;
    };
    $scope.isObject = function (obj) {
        return typeof obj === 'object';
    };
    $scope.showProfile = function (ev, user_id)
    {
        var template_name = 'user/show_profile_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {my_user_id: user_id},
            controller: _ProfileCtrl
        }).then(function () {
            },
            function () {
            });
    };

    $scope.getMyDetails = function (my_user_id)
    {
        $scope.mydata = null;
        var data = {};
        data.user_id = my_user_id;
        data.action = "get_my_details";
        $log.debug(data);
        baseFactory.UserCtrl(data)
        .then(function (payload)
        {
            $log.debug(payload);
            if (payload.response == $rootScope.successdata) {
                $scope.my_data = payload.mydata;
            }
            else if (payload.response == $rootScope.emptydata) {
                $scope.my_data = null;
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.loadCountry = function (limit_val)  /* To Get branch List */
    {
        var send = {action: "get_country_list"};
        if (limit_val != $scope.nostate)
        {
            var lm;
            if (typeof limit_val === 'undefined')
                lm = 0;
            else if (limit_val == 0)
                lm = 0;
            else
                lm = limit_val - 1;
            send.limit_val=lm;
        }
        else
        {
            delete send.limit_val;
        }
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.countries = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.countries = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs =  0;
                    }

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.UpdateCountry = function (country_data) {
        country_data.action = "update_country";
        $log.log(country_data);
        $log.debug(country_data);
        baseFactory.UserCtrl(country_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadCountry();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
        $log.log(country_data);
    };
    $scope.editCountry = function (ev, country_data) {
        var template_name = 'user/edit_country_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {country_data: country_data},
            controller: _CountryCtrl
        }).then(function () {
            },
            function () {
            });
    };
    function _CountryCtrl($scope, country_data)
    {
        $scope.ecountry_data = "";
        $scope.ecountry_data = country_data;
        $scope.ecountry_data.country_name = country_data.COUNTRY_NAME;
        $scope.ecountry_data.country_code = country_data.COUNTRY_CODE;
        $scope.ecountry_data.status = country_data.STATUS;
    }

    $scope.UpdateState = function (state_data) {
        state_data.action = "update_state";
        $log.log(state_data);
        $log.debug(state_data);
        baseFactory.UserCtrl(state_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadStates();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
        $log.log(state_data);
    };
    $scope.loadStates = function (limit_val)  /* To Get branch List */ {
        var send = {action: "get_states_list"};
        if (limit_val != $scope.nostate)
        {
            var ln;
            if (typeof limit_val === 'undefined')
                ln = 0;
            else if (limit_val == 0)
                ln = 0;
            else
                ln = limit_val - 1;
            send.limit_val=ln;
        }
        else
        {
            delete send.limit_val;
        }
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.states = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.states = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs =  0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.editState = function (ev, state_data) {
        var template_name = 'user/edit_state_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {state_data: state_data},
            controller: _StateCtrl
        }).then(function () {
            },
            function () {
            });
    };
    function _StateCtrl($scope, state_data)
    {
        $scope.estate_data = "";
        $scope.estate_data = state_data;
        $scope.estate_data.state_name = state_data.STATE_NAME;
        $scope.estate_data.state_code = state_data.STATE_CODE;
        $scope.estate_data.status = state_data.STATUS;
    }
    $scope.loadCities = function () /* For Contracts */ {
        var send = {action: "get_city_names"};
        baseFactory.baseCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.city_names = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.city_names = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadCityList = function (limit_val)  /* To Get branch List */ {
        var send = {action: "get_city_list"};
        if (limit_val != $scope.nostate)
        {
            var ln;
            if (typeof limit_val === 'undefined')
                ln = 0;
            else if (limit_val == 0)
                ln = 0;
            else
                ln = limit_val - 1;
            send.limit_val=ln;
        }
        else
        {
            delete send.limit_val;
        }
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cities = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cities = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs =  0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addCity = function (add_city) {
        add_city.action = "add_new_city";
        $log.debug(add_city);
        baseFactory.UserCtrl(add_city)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
						$state.go("home.hmadmin_cities");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                    $log.debug(payload);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.UpdateCity = function (city_data) {
        city_data.action = "update_city";
        $log.log(city_data);
        $log.debug(city_data);
        baseFactory.UserCtrl(city_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadCityList();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
        $log.log(city_data);
    };
    $scope.editCity = function (ev, city_data) {
        var template_name = 'user/edit_city_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {city_data: city_data},
            controller: _CityCtrl
        }).then(function () {
            },
            function () {
            });
    };

    function _CityCtrl($scope, city_data)
    {
        $scope.ecity_data = "";
        $scope.ecity_data = city_data;
        $scope.ecity_data.city_name = city_data.CITY_NAME;
        $scope.ecity_data.city_code = city_data.CITY_CODE;
        $scope.ecity_data.status = city_data.STATUS;
    }
	
	 $scope.EditModulelist = function (ev, module) {
        var template_name = 'mainadmin/edit_module_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {module: module},
            controller: _EmoduleCtrl
        }).then(function () {
            },
            function () {
            })
    };

    function _EmoduleCtrl($scope, module) {
        
        $scope.hamodule = module;
        $scope.hamodule.module_name = module.MODULE_NAME;
        $scope.hamodule.statuss = module.STATUS;
       
    }

	
	$scope.updateModules = function (hamodule)
    {
        hamodule.action = "update_module_list";
        baseFactory.Mainadmin(hamodule)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	

    /*City Data*/
    function _ProfileCtrl($scope, my_user_id) {
        $scope.getMyDetails(my_user_id);
    }

    $scope.addEupName = function (details) {
        details.action = "add_equp_name";
		details.user_org_module = $scope.user_org_module;
        $log.log(details);
        baseFactory.deviceCall(details)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $state.go("home.hbbme_equipment_names");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getEqupNames = function () {
        details.action = "get_equp_name";
        baseFactory.deviceCall(details)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.hbbme_equipment_names");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editEquipmentName = function (ev, equp_name) {
        var template_name = 'device/edit_equp_name_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {equp_name: equp_name},
            controller: _EqupNameCtrl
        }).then(function () {
            },
            function () {
            })
    };

    function _EqupNameCtrl($scope, equp_name) {
        $scope.getDevicePriorities();
        $scope.eeqname_data = "";
        $scope.eeqname_data = equp_name;
        $scope.eeqname_data.equp_name = equp_name.NAME;
        $scope.eeqname_data.priority = equp_name.PRIORITY;
        $scope.eeqname_data.code = equp_name.CODE;
        $scope.eeqname_data.status = equp_name.STATUS;
    }

    $scope.UpdateEqupname = function (eeqname_data)
    {
        eeqname_data.action = "update_equp_name";
        baseFactory.deviceCall(eeqname_data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadEquipmentNames();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getClassifications = function (limit_val) {

        if (limit_val != $scope.nostate) {
            var eq_classification;
            if (typeof limit_val === 'undefined')
                eq_classification = 0;
            else if (limit_val == 0)
                eq_classification = 0;
            else
                eq_classification = limit_val - 1;
            $log.error(eq_classification);
            var send = {limit_val: eq_classification, action: "get_classifications"};
        }
        else {
            var send = {action: "get_classifications"};
        }
        baseFactory.deviceCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.m_classifications = payload.list;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.m_classifications = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;

                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addClassification = function (details) {
        details.action = "add_classification";
        baseFactory.UserCtrl(details)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $state.go("home.classifications");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.editClassification = function (ev, classification) {
        var template_name = 'master/edit_classification';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {eclassification: classification},
            controller: _eClassification
        }).then(function () {
            },
            function () {
            });
    };
    function _eClassification($scope, eclassification) {
        $scope.eclassification = eclassification;
        $scope.eclassification.master_class = eclassification.MASTER_CLASS;
        $scope.eclassification.responsible_dept = eclassification.RESPONSIBLE_DEPT;
        $scope.eclassification.code = eclassification.CODE;
        $scope.eclassification.status = eclassification.STATUS;
    }

    $scope.updateClassification = function (data) {
        data.action = "update_classification";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.getClassifications();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };



    $scope.editEqupConditonlabel = function (ev, equpconditon) {
        var template_name = 'master/edit_equp_cond_label_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {econdlabel: equpconditon},
            controller: _eCondlabel
        }).then(function () {
            },
            function () {
            });
    };
    function _eCondlabel($scope, econdlabel) {
        $scope.econdlabel = econdlabel;
        $scope.econdlabel.module_id = econdlabel.MODULE_ID;
		$scope.econdlabel.org_id  = econdlabel.ORG_NAME;
        $scope.econdlabel.cond_name = econdlabel.ECOND;
        $scope.econdlabel.code = econdlabel.EVAL;
        $scope.econdlabel.status = econdlabel.STATUS;
        $scope.econdlabel.actions = econdlabel.ACTION;
    }

    $scope.updateequpcondlable = function (econdlabel) {
        econdlabel.action = "update_equp_cond_labels";
        baseFactory.Mainadmin(econdlabel)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.equpcondlabelslist();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editescalationlabel = function (ev, escalation) {
        var template_name = 'mainadmin/edit_escalation_label_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {escalation: escalation},
            controller: _eScaltion_level
        }).then(function () {
            },
            function () {
            });
    };
    function _eScaltion_level($scope, escalation) {
        $scope.eescalation = escalation;
        $scope.eescalation.module_id = escalation.MODULE_ID;
        $scope.eescalation.equp_type = escalation.EQUP_TYPE;
        $scope.eescalation.esc_types = escalation.ESC_TYPES;
        $scope.eescalation.esc_cat = escalation.ESC_CAT;
        $scope.eescalation.l1 = escalation.L1;
        $scope.eescalation.l2 = escalation.L2;
        $scope.eescalation.l3=escalation.L3;
        $scope.eescalation.actions = escalation.ACTION;
    }

    $scope.updateescalationlabel = function (escalation) {
        escalation.action = "update_escalation_labels";
        baseFactory.Mainadmin(escalation)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

 $scope.editstatuslabel = function (ev, status) {
        var template_name = 'mainadmin/edit_status_label_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {status: status},
            controller: _eStatus_label
        }).then(function () {
            },
            function () {
            });
    };
    function _eStatus_label($scope, status) {
        $scope.estatuslabel = status;
        $scope.estatuslabel.module_id = status.MODULE_ID;
		$scope.estatuslabel.org_id = status.ORG_NAME;
        $scope.estatuslabel.status_name = status.STATUS;
        $scope.estatuslabel.code = status.SCODE;
		$scope.estatuslabel.status = status.STATUSS;
		$scope.estatuslabel.actions = status.ACTION;
        
    }
	
	$scope.editdepreciationlabel = function (ev, depreciationlabel) {
        var template_name = 'mainadmin/edit_depreciation_label_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {depreciationlabel: depreciationlabel},
            controller: _eDepreciation_label
        }).then(function () {
            },
            function () {
            });
    };
    function _eDepreciation_label($scope, depreciationlabel) {
        $scope.edepreciation = depreciationlabel;
        $scope.edepreciation.module_id = depreciationlabel.MODULE_ID;
		$scope.edepreciation.org_id  = depreciationlabel.ORG_NAME;
        $scope.edepreciation.name = depreciationlabel.NAME;
        $scope.edepreciation.percentage = depreciationlabel.PERCENTAGE;
		$scope.edepreciation.status = depreciationlabel.STATUS;
		$scope.edepreciation.actions = depreciationlabel.ACTION;
        
    }
	
	
	$scope.Updatedepreciationlabel = function (edepreciation) {
        edepreciation.action = "update_depreciation_label";
        baseFactory.Mainadmin(edepreciation)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
						$scope.loadVendorlabel();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

	$scope.updateescalationlabel = function (escalation) {
        escalation.action = "update_escalation_labels";
        baseFactory.Mainadmin(escalation)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	

    $scope.Updatestatuslabel = function (estatuslabel) {
        estatuslabel.action = "update_status_label";
        baseFactory.Mainadmin(estatuslabel)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
						

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

 
 
    $scope.editrolelabel = function (ev, role) {
        var template_name = 'mainadmin/edit_role_label';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {role: role},
            controller: _eRole
        }).then(function () {
            },
            function () {
            });
    };
    function _eRole($scope, role) {
        $scope.erole = role;
        $scope.erole.module_id = role.MODULE_ID;
		$scope.erole.org_id   = role.ORG_NAME;
        $scope.erole.role_name = role.ROLE_NAME;
        $scope.erole.role_code = role.ROLE_CODE;
        $scope.erole.status = role.STATUS;
        $scope.erole.actions = role.ACTION;
    }

    $scope.updaterolelabel = function (role) {
        role.action = "update_role_labels";
        baseFactory.Mainadmin(role)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
						$scope.loadrolelabels();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };




    $scope.editesclevellabels = function (ev, escalation_level) {
        var template_name = 'mainadmin/edit_escalation_level_label';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {escalation_level: escalation_level},
            controller: _eScaltion_level_label
        }).then(function () {
            },
            function () {
            });
    };
    function _eScaltion_level_label($scope, escalation_level) {
        $scope.eescalation_level_label = escalation_level;
        $scope.eescalation_level_label.module_id = escalation_level.MODULE_ID;
		$scope.eescalation_level_label.org_id = escalation_level.ORG_NAME;
        $scope.eescalation_level_label.level_name = escalation_level.LEVEL_NAME;
        $scope.eescalation_level_label.level_code = escalation_level.LEVEL_CODE;
        $scope.eescalation_level_label.status = escalation_level.STATUS;
        $scope.eescalation_level_label.actions = escalation_level.ACTION;
    }

    $scope.updateescalationlevellabel = function (escalation_level) {
        escalation_level.action = "update_escalation_level_labels";
        baseFactory.Mainadmin(escalation_level)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editvendorlabels = function (ev, vendor_label) {
        var template_name = 'mainadmin/edit_vendor_label';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {vendor_label: vendor_label},
            controller: _eVendor_label
        }).then(function () {
            },
            function () {
            });
    };
    function _eVendor_label($scope, vendor_label) {
        $scope.evendor_label = vendor_label;
        $scope.evendor_label.module_id = vendor_label.MODULE_ID;
		$scope.evenodr_label.org_id = vendor_label.ORG_NAME;
        $scope.evendor_label.vendor_name = vendor_label.NAME;
        $scope.evendor_label.type = vendor_label.TYPE;
        $scope.evendor_label.email = vendor_label.EMAIL_ID;
        $scope.evendor_label.contactno = vendor_label.CP_NUMBER;
        $scope.evendor_label.contactperson  =  vendor_label.CP_NAME;
        $scope.evendor_label.cpnumber   = vendor_label.CP_NUMBER;
		$scope.evendor_label.status = vendor_label.STATUS;
        $scope.evendor_label.actions    = vendor_label.ACTION;
    }

    $scope.updatevendorlabel = function (evendor_label) {
        evendor_label.action = "update_vendor_label";
        baseFactory.Mainadmin(evendor_label)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
						$scope.loadVendorlabel();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editesctypelabels = function (ev, esctype) {
        var template_name = 'mainadmin/edit_escalation_type_label';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {esctype: esctype},
            controller: _eSctype
        }).then(function () {
            },
            function () {
            });
    };
    function _eSctype($scope, esctype) {
        $scope.eesctype = esctype;
        $scope.eesctype.module_id = esctype.MODULE_ID;
        $scope.eesctype.esc_name = esctype.ESC_NAME;
        $scope.eesctype.status = esctype.STATUS;
        $scope.eesctype.actions = esctype.ACTION;
    }

    $scope.updateescalationtypelabel = function (esctype) {
        esctype.action = "update_escalation_type_labels";
        baseFactory.Mainadmin(esctype)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };








    $scope.addroletype = function (add_role_type) {
        add_role_type.action = "add_role_type";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_role_type);
        baseFactory.Mainadmin(add_role_type)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();

                        $state.go("home.haadmin_roles");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addequptypelabel = function (add_equptype_label) {
        add_equptype_label.action = "add_equp_type_label";
        //add_havendor.cp_details = $scope.all_cps;
        console.log(add_equptype_label);
        baseFactory.Mainadmin(add_equptype_label)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
					

                        $state.go("home.haadmin_equp_types_labels");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.DeviceVendors();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadEqupTypeLabelslist = function (limit_val)  /* To Get branch List */ {
        if (limit_val != $scope.nostate) {
            var ctype;
            if (typeof limit_val === 'undefined')
                ctype = 0;
            else if (limit_val == 0)
                ctype = 0;
            else
                ctype = limit_val - 1;
            $log.error(ctype);
            var send = {limit_val: ctype, action: "get_equp_type_labels_list"};
        }
        else {
            var send = {action: "get_equp_type_labels_list"};
        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.log(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equptypelabelslist = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.ctypes = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    /*if($scope.user_role_code!=$scope.HBUSER)
     {
     $scope.getAllCallsCount();
     $interval(function()
     {
     $scope.getAllCallsCount();
     }, 60000);
     }*/
    /* masters List*/
    $scope.loadContractTypeList = function (limit_val)  /* To Get branch List */ {
        if (limit_val != $scope.nostate) {
            var ctype;
            if (typeof limit_val === 'undefined')
                ctype = 0;
            else if (limit_val == 0)
                ctype = 0;
            else
                ctype = limit_val - 1;
            $log.error(ctype);
            var send = {limit_val: ctype, action: "get_contract_type_list",user_org_module:$scope.user_org_module};
        }
        else {
            var send = {action: "get_contract_type_list",user_org_module:$scope.user_org_module};
        }
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.log(payload);
                     console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.ctypes = angular.fromJson(payload.list);
						$scope.ctype_labels = angular.fromJson(payload.labels);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.ctypes = null;
						$scope.ctype_labels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    
	 $scope.addContractType = function (ctype_data) {
        ctype_data.action = "add_contract_type";
		ctype_data.user_org_module = $scope.user_org_module;
        console.log(ctype_data);
        baseFactory.UserCtrl(ctype_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.loadEquipmentNames();
                        $state.go("home.hbbme_contract_type");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	
    $scope.editCtype = function (ev, ctype_data) {
        var template_name = 'user/edit_ctype_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {ctype_data: ctype_data},
            controller: _CtypeCtrl
        }).then(function () {
            },
            function () {
            });
    };

    function _CtypeCtrl($scope, ctype_data) {

        $scope.etype_data = "";
        $scope.etype_data = ctype_data;
        $scope.etype_data.ctype_name = ctype_data.CTYPE;
        $scope.etype_data.ctype_code = ctype_data.CFORM;
        $scope.etype_data.status = ctype_data.STATUS;
    }

    $scope.UpdateCtype = function (ectype_data) {
        ectype_data.action = "update_contract_type";
        baseFactory.UserCtrl(ectype_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadContractTypeList();
                        //$state.go("home.hbbme_contract_type");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadStatusList = function ()  /* To Get status List */ {
        var send = {action: "get_status_list"};
		
        baseFactory.UserCtrl(send)
            .then(function (payload) {
				console.log(payload);
                    if (payload.response == $rootScope.successdata) {
						$scope.stat_label    = angular.fromJson(payload.labels);
                        $scope.equp_statuses = angular.fromJson(payload.list);						
						 $scope.paging.total = payload.rcnt;
                         $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equp_statuses = null;
						$scope.stat_label = null;
						 $scope.paging.total = 0;
                          $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addStatus = function (status_data) {
        status_data.action = "add_status";
        baseFactory.UserCtrl(status_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //$scope.loadEquipmentNames();
                        $state.go("home.hbbme_status");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.editStatus = function (ev, status_data) {
        var template_name = 'user/edit_status_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {status_data: status_data},
            controller: _StatusCtrl
        }).then(function () {
            },
            function () {
            });
    };

    function _StatusCtrl($scope, status_data) {
        $scope.estatus_data = "";
        $scope.estatus_data = status_data;
        $scope.estatus_data.status = status_data.STATUS;
        $scope.estatus_data.status_code = status_data.SCODE;
        $scope.estatus_data.statuss = status_data.STATUSS;
    }

    $scope.UpdateStatus = function (staus_data) {
        staus_data.action = "update_staus";
        baseFactory.UserCtrl(staus_data)
            .then(function (payload) {
                    $log.info(payload);
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadStatusList();
                        $state.go("home.hbbme_status");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadEqupCondition = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var equp_cond;
            if (typeof limit_val === 'undefined')
                equp_cond = 0;
            else if (limit_val == 0)
                equp_cond = 0;
            else
                equp_cond = limit_val - 1;
            $log.error(equp_cond);
            var send = {limit_val: equp_cond, action: "get_equp_cond",user_org_module:$scope.user_org_module};
        }
        else {
            var send = {action: "get_equp_cond",user_org_module:$scope.user_org_module};
        }
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.econds = angular.fromJson(payload.list);
						$scope.econd_labels = angular.fromJson(payload.labels);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.econds = null;
						$scope.econd_labels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addEqupCondition = function (econd_data) {
        econd_data.action = "add_equp_condition";
		econd_data.user_org_module = $scope.user_org_module;
        baseFactory.UserCtrl(econd_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $state.go("home.hbbme_equipment_condition");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editEqupConditon = function (ev, eqcon_data) {
        var template_name = 'user/edit_equp_cond_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {eqcon_data: eqcon_data},
            controller: _EQqCondCtrl
        }).then(function () {
            },
            function () {
            });
    };

    function _EQqCondCtrl($scope, eqcon_data) {
        console.log(eqcon_data);
        $scope.eeqcond_data = "";
        $scope.eeqcond_data = eqcon_data;
        $scope.eeqcond_data.equp_condition = eqcon_data.ECODE;
        $scope.eeqcond_data.equp_code = eqcon_data.EVAL;
        $scope.eeqcond_data.status = eqcon_data.STATUS;
    };


    $scope.UpdateEqupCondition = function (eqcond_data) {
        eqcond_data.action = "update_equp_cond";
        baseFactory.UserCtrl(eqcond_data)
            .then(function (payload) {
                    $log.info(payload);
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadEqupCondition();
                        //$state.go("home.hbbme_equipment_condition");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    /*  $scope.loadEquipmentNames=function() /!* For Contracts *!/
     {
     var send={action:"get_equip_names"};
     baseFactory.UserCtrl(send)
     .then(function(payload)
     {
     $log.debug(payload);
     $log.info(payload);
     if(payload.response==$rootScope.successdata)
     {
     $scope.eclass = angular.fromJson(payload.list);
     }
     else if(payload.response==$rootScope.emptydata)
     {
     $scope.eclass = null;
     }
     },
     function(errorPayload)
     {
     $log.error('failure loading', errorPayload);
     });
     };*/

    /*$scope.loadEquipmentClass=function() /!* For Contracts *!/
     {
     var send= {action:"get_equip_class"};
     $log.debug(send);
     baseFactory.UserCtrl(send)
     .then(function(payload)
     {
     $log.info(payload);
     if(payload.response==$rootScope.successdata)
     {
     $scope.eclass = angular.fromJson(payload.list);
     }
     else if(payload.response==$rootScope.emptydata)
     {
     $scope.eclass = null;
     }
     },
     function(errorPayload)
     {
     $log.error('failure loading', errorPayload);
     });
     };*/

    $scope.loadEquipmentClass = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var eclimt;
            if (typeof limit_val === 'undefined')
                eclimt = 0;
            else if (limit_val == 0)
                eclimt = 0;
            else
                eclimt = limit_val - 1;
            $log.error(eclimt);
            var send = {limit_val: eclimt, action: "get_equip_class"};
        }
        else {
            var send = {action: "get_equip_class"};
        }
        $log.debug(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {

                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.eclass = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.eclass.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.eclass = null;
                        $scope.paging.total = $scope.eclass.no_of_recs = $scope.paging.current = 0;

                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addEqClass = function (eclass_data) {
        eclass_data.action = "add_equp_class";
        baseFactory.UserCtrl(eclass_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.hbbme_equipment_class");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addUtillValue = function (eclass_data) {
        eclass_data.action = "add_utill_value";
        baseFactory.UserCtrl(eclass_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.hbbme_utlization_value");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.editEqupClass = function (ev, eqclass_data) {
        var template_name = 'user/edit_equp_class_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {eqclass_data: eqclass_data},
            controller: _EQqClassCtrl
        }).then(function () {
            },
            function () {
            });
    };

    function _EQqClassCtrl($scope, eqclass_data) {
        console.log(eqclass_data);
        $scope.eclass_data = "";
        $scope.eclass_data = eqclass_data;
        $scope.eclass_data.equp_class = eqclass_data.EQ_CLASS;
        $scope.eclass_data.eclass_code = eqclass_data.EQ_CODE;
        $scope.eclass_data.status = eqclass_data.STATUS;
    }


    $scope.UpdateEqClass = function (eqclass_data) {
        eqclass_data.action = "update_equp_class";
        baseFactory.UserCtrl(eqclass_data)
            .then(function (payload) {
                    $log.info(payload);
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadEquipmentClass();
                        $state.go("home.hbbme_equipment_class");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadUtillizationValue = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var uvalue;
            if (typeof limit_val === 'undefined')
                uvalue = 0;
            else if (limit_val == 0)
                uvalue = 0;
            else
                uvalue = limit_val - 1;
            $log.error(uvalue);
            var send = {limit_val: uvalue, action: "get_utilization_list"};
        }
        else {
            var send = {action: "get_utilization_list"};
        }
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.uvalues = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.uvalues = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;

                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addUtillValue = function (util_data) {
        util_data.action = "add_utill_value";
        baseFactory.UserCtrl(util_data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadUtillizationValue();
                        $state.go("home.hbbme_utlization_value");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editUtillValue = function (ev, eutil_data) {
        var template_name = 'user/edit_equp_util_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {eutil_data: eutil_data},
            controller: _EQqUtillCtrl
        }).then(function () {
            },
            function () {
            });
    };

    function _EQqUtillCtrl($scope, eutil_data)
    {
        console.log(eutil_data);
        $scope.eutill_data = "";
        $scope.eutill_data = eutil_data;
        $scope.eutill_data.equp_utill = eutil_data.NAME;
        $scope.eutill_data.equp_value = eutil_data.VALUE;
        $scope.eutill_data.status = eutil_data.STATUS;
    }

    $scope.UpdateUtileValue = function (eutil_data)
    {
        eutil_data.action = "update_utill_values";
        baseFactory.UserCtrl(eutil_data)
            .then(function (payload) {
                    $log.info(payload);
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                      $scope.loadUtillizationValue();
                       // $state.go("home.hbbme_utlization_value");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.loadTrainingTypes = function (limit_val) /* For Contracts */
    {
        if (limit_val != $scope.nostate) {
            var traingtype;
            if (typeof limit_val === 'undefined')
                traingtype = 0;
            else if (limit_val == 0)
                traingtype = 0;
            else
                traingtype = limit_val - 1;
            $log.error(traingtype);
            var send = {limit_val: traingtype, action: "get_training_type_list"};
        }
        else {
            var send = {action: "get_training_type_list"};
        }

        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.ttypes = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.ttypes = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addTrainigType = function (add_ttype)
    {
        add_ttype.action = "add_training_type";
        baseFactory.UserCtrl(add_ttype)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadTrainingTypes();
                        $state.go("home.hbbme_training_type");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editTrainingType = function (ev, trining_type)
    {
        var template_name = 'user/edit_training_type_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {trining_type: trining_type},
            controller: _TTypeCtrl
        }).then(function () {
            },
            function () {
            });
    };

    function _TTypeCtrl($scope, trining_type) {
        console.log(trining_type);
        $scope.etrining_type = "";
        $scope.etrining_type = trining_type;
        $scope.etrining_type.traing_type = trining_type.TRAINING_TYPE;
        $scope.etrining_type.traing_type_code = trining_type.CODE;
        $scope.etrining_type.status = trining_type.STATUS;
    }

    $scope.UpdateTrainingType = function (etraining_type)
    {
        etraining_type.action = "update_training_type";
        baseFactory.UserCtrl(etraining_type)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadTrainingTypes();
                        $state.go("home.hbbme_training_type");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getAccessories = function ()
    {
        var data = {};
        data.action = "get_accessories";
        baseFactory.UserCtrl(data)
        .then(function (payload)
        {
            $log.log(payload);
            if (payload.response == $rootScope.successdata)
            {
                $scope.m_accessories = payload.list;
            }
            else if (payload.response == $rootScope.emptydata)
            {
                $scope.m_accessories = null;
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.addAccessor = function (data) {
        data.action = "add_accessor";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.accessories");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	  $scope.addscheduledcall = function (data)
    {
        console.log("ddg");
        //  return false;
        data.action = "add_scheduled_call";
        console.log(data);
        baseFactory.Mainadmin(data)
            .then(function(payload){
                    console.log(payload);
                    if(payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        //$scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.hbhod_scheduled_calls");
                    }else if(payload.response == $rootScope.faileddata){
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload){
                    $log.error('failure loading',errorPayload);
                });
    };
	
	 $scope.loadScheduledtypes = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var name;
            if (typeof limit_val === 'undefined')
                name = 0;
            else if (limit_val == 0)
                name = 0;
            else
                name = limit_val - 1;
            $log.error(name);
            var send = {limit_val: name, action: "get_scheduled_call_type"};
        }
        else {
            var send = {action: "get_scheduled_call_type"};
        }

        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    console.log(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.scheduled_types = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.scheduled_types = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

   $scope.getscheduledyeardays = function(caller_name,index)
    {
        console.log("fg");
        var data = {};
        data.caller_name = caller_name;
       // data.index = index;
        data.action = "get_scheduled_year_days";
      //  data.index = index;
        console.log(data);
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    console.log(payload);
                     var vdata = angular.fromJson(payload.list);
                    $scope.add_device.callername[index].YEAR = vdata.YEAR;
                    $scope.add_device.callername[index].MONTH = vdata.MONTH;
                    $scope.add_device.callername[index].DAY = vdata.DAY;

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

	$scope.loadscheduledcalls = function ()  /* To Get branch List */ {
        var send = {action: "get_scheduled_calls"};
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.log("get_scheduled_calls");
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.scheduled = angular.fromJson(payload.scheduled);
                    }
                    else if (payload.response == $rootScope.emptydata)
                    {
                        $scope.scheduled = [{ CALLER_NAME: "No Branchs Found"}];
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
    $scope.updateAccessor = function (data) {
        data.action = "update_accessor";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.getAccessories();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.editAccessor = function (ev, eaccessor) {
        var template_name = 'master/edit_accessor';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {eaccessor: eaccessor},
            controller: _eAccessor
        }).then(function () {
            },
            function () {
            });
    };
    function _eAccessor($scope, eaccessor) {
        $scope.eaccessor = eaccessor;
        $scope.eaccessor.name = eaccessor.NAME;
        $scope.eaccessor.code = eaccessor.CODE;
        $scope.eaccessor.status = eaccessor.STATUS;
    }

    $scope.getCriticalSpares = function () {
        var data = {};
        data.branch_id = $scope.user_branch;
        data.action = "get_critical_spares";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.m_critical_spares = payload.list;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.m_critical_spares = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addCriticalSpare = function (data) {
        data.action = "add_critical_spare";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.critical_spares");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addEqupType = function (data) {
        data.action = "add_equp_type";
		data.user_org_module = $scope.user_org_module;
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.equipment_types");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.editCriticalSpare = function (ev, ecrispare) {
        $scope.loadBranches();
        var template_name = 'master/edit_critical_spare';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
			locals: {ecrispare: ecrispare},
            controller: _eCrickSpare
        }).then(function () {
            },
            function () {
            });
    };
    function _eCrickSpare($scope, ecrispare) {

        $scope.ecrispare = ecrispare;
        $scope.ecrispare.name = ecrispare.NAME;
        $scope.ecrispare.code = ecrispare.CODE;
        $scope.ecrispare.branch = ecrispare.BRANCH;
        $scope.ecrispare.count = ecrispare.COUNT;
    }

    $scope.editEqupType = function (ev, equp_type) {
        var template_name = 'master/edit_equp_type';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {equp_type: equp_type},
            controller: _eEqupType
        }).then(function () {
            },
            function () {
            });
    };
    function _eEqupType($scope, equp_type) {
        $scope.eequp_type = equp_type;
        $scope.eequp_type.type = equp_type.TYPE;
        $scope.eequp_type.code = equp_type.CODE;
        $scope.eequp_type.status = equp_type.STATUS;
    }

    $scope.updateEqupType = function (data) {
        data.action = "update_eq_type";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.getEqupTypes();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.updatecrickSpare = function (data) {
        data.action = "update_critical_spare";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.getCriticalSpares();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getVendorTypes = function () {
        var data = {};
        data.action = "get_vendor_types";
        data.branch_id = $scope.user_branch;
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                   // $log.log(payload);
                    $scope.vdr_types = payload.list;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getEqupCategories = function () {
        var data = {};
        data.action = "get_equp_cats";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    $scope.equp_cats = payload.list;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getEqupOEMS = function () {
        var data = {};
        data.aaction =  "All";
        data.action = "get_oems";
        data.type = "OEM";
        $log.log(JSON.stringify(data));
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    $scope.oems = payload.list;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	 $scope.getorganisations = function()
    {
        var data = {};
        data.action = "get_organisations";
       $log.log(JSON.stringify(data));
       baseFactory.UserCtrl(data)
           .then(function(payload) {
               $scope.organisations = payload.list;
           },
           function (errorPayload){
               $log.error('failure loading', errorPaylaod);
           });

    };
	
    $scope.getDistributors = function () {
        var data = {};
        data.action = "get_distrbts";
        data.aaction = "All";
        data.type = "Distributor";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    $scope.distrbts = payload.list;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getSupportVendors = function () {
        var data = {};
        data.action = "get_vsupport";
        data.type = "Support";
        data.aaction = "All";
        data.branch_id = $scope.user_branch;
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    $scope.sprt_vendrs = payload.list;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.viewEquipmentDetails = function (ev, depart_device) {

        console.log(JSON.stringify(depart_device));
        var template_name = 'master/view_devies_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {depart_device: depart_device},
            controller: _eViewdeviceDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewdeviceDetails($scope, depart_device) {
        $scope.depart_device_view = depart_device;
    }
	
	$scope.viewitemmasterDetails = function (ev, label) {

        console.log(JSON.stringify(label));
        var template_name = 'mainadmin/view_itemmaser_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {label: label},
            controller: _eViewitemDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewitemDetails($scope, label) {
        $scope.item_master_view = label;
    }
	
	
	$scope.viewDepreciationDetails = function (ev, detail) {
        var template_name = 'master/view_depreciation_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {detail: detail},
            controller: _eViewdepreciationDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewdepreciationDetails($scope, detail) {
        $scope.depreciation_view = detail;
    }
	
    $scope.loadDEpatmentsList = function (limit_val,deptid) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var eclimt;
            if (typeof limit_val === 'undefined')
                eclimt = 0;
            else if (limit_val == 0)
                eclimt = 0;
            else
                eclimt = limit_val - 1;
            if(deptid == 'undefined')
                var send = {limit_val: eclimt, action: "get_depts_list"};
            else
                var send = {limit_val: eclimt,"deptid":deptid , action: "get_depts_list",user_org_module:$scope.user_org_module};
        }
        else {
            var send = {action: "get_depts_list",user_org_module : $scope.user_org_module};
        }
              
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.depts = angular.fromJson(payload.list);
						$scope.depart_labels = angular.fromJson(payload.labels);
                        $scope.paging.total = payload.rcnt;
                        $scope.depts.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.depts = null;
						$scope.depart_labels = null;
                        $scope.paging.total = 0;
                        $scope.depts.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addDepartment = function (depts) {
        depts.action = "add_departments";
	    depts.user_org_module = $scope.user_org_module;
		console.log(depts);
        baseFactory.UserCtrl(depts)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.departments");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.editDepartment = function (ev, depts) {
        var template_name = 'user/edit_dept_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {depts: depts},
            controller: _eDepartments
        }).then(function () {
            },
            function () {
            });
    };
    function _eDepartments($scope, depts) {
        $scope.edepts = depts;
        $scope.edepts.departments = depts.USER_DEPT_NAME;
        $scope.edepts.code = depts.CODE;
        $scope.edepts.status = depts.STATUS;
    }

    $scope.UpdateDepartment = function (dept) {
        dept.action = "update_department";
        baseFactory.UserCtrl(dept)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadDepartments();
                        //$state.go("home.departments");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadReasonsList = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var reason;
            if (typeof limit_val === 'undefined')
                reason = 0;
            else if (limit_val == 0)
                reason = 0;
            else
                reason = limit_val - 1;
            $log.error(reason);
            var send = {limit_val: reason, action: "get_reasons_list",user_module_org:$scope.user_module_org};

        }
        else {
            var send = {action: "get_reasons_list",user_module_org:$scope.user_module_org};

        }
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.reasons = angular.fromJson(payload.list);
						$scope.reason_label = angular.fromJson(payload.labels);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.reasons = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.loadUtillabels = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var util;
            if (typeof limit_val === 'undefined')
                util = 0;
            else if (limit_val == 0)
                util = 0;
            else
                util = limit_val - 1;
            $log.error(util);
            var send = {limit_val: util, action: "get_util_labels"};

        }
        else {
            var send = {action: "get_util_labels"};

        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.utillabels = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.utillabels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }





    $scope.loadcountrieslabels = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var reason;
            if (typeof limit_val === 'undefined')
                reason = 0;
            else if (limit_val == 0)
                reason = 0;
            else
                reason = limit_val - 1;
            $log.error(reason);
            var send = {limit_val: reason, action: "get_countries_labels_list"};

        }
        else {
            var send = {action: "get_countries_labels_list"};

        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.countrieslabels = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.countrieslabels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.loadstateslabels = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var reason;
            if (typeof limit_val === 'undefined')
                reason = 0;
            else if (limit_val == 0)
                reason = 0;
            else
                reason = limit_val - 1;
            $log.error(reason);
            var send = {limit_val: reason, action: "get_states_labels_list"};

        }
        else {
            var send = {action: "get_states_labels_list"};

        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.stateslabelslist = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.stateslabelslist = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.loadcitieslabels = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var reason;
            if (typeof limit_val === 'undefined')
                reason = 0;
            else if (limit_val == 0)
                reason = 0;
            else
                reason = limit_val - 1;
            $log.error(reason);
            var send = {limit_val: reason, action: "get_cities_labels_list"};

        }
        else {
            var send = {action: "get_cities_labels_list"};

        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.citieslabelslist = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.citieslabelslist = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.loadRoletypes = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var role;
            if (typeof limit_val === 'undefined')
                role = 0;
            else if (limit_val == 0)
                role = 0;
            else
                role = limit_val - 1;
            $log.error(role);
            var send = {limit_val: role, action: "get_role_type_list"};

        }
        else {
            var send = {action: "get_role_type_list"};

        }
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.roletypes = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.reasons = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.addReason = function (reasons) {
        reasons.action = "add_reasons";
        baseFactory.UserCtrl(reasons)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.reasons");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }
	
	$scope.addnonshceduledreason = function (reasons) {
        reasons.action = "add_non_scheduled";
        baseFactory.UserCtrl(reasons)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.non_scheduled_reasons");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }
	 
	$scope.loadNonScheduledReasons = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var reason;
            if (typeof limit_val === 'undefined')
                reason = 0;
            else if (limit_val == 0)
                reason = 0;
            else
                reason = limit_val - 1;
            $log.error(reason);
            var send = {limit_val: reason, action: "get_nonscheduled_reasons_list"};

        }
        else {
            var send = {action: "get_nonscheduled_reasons_list"};

        }
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                   console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.non_reasons = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.non_reasons = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }
	 
	
    $scope.editreasons = function (ev, reasons) {
        var template_name = 'user/edit_reason_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {reasons: reasons},
            controller: _eReasons
        }).then(function () {
            },
            function () {
            });
    };
    function _eReasons($scope, reasons) {
        $scope.ereasons = reasons;
        $scope.ereasons.reason = reasons.COMPLANT_NAME;
        $scope.ereasons.status = reasons.STATUS;
    }
    $scope.UpdateReasons = function (reason) {
        reason.action = "update_reasons";
        baseFactory.UserCtrl(reason)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadReasonsList();
                       // $state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editequptypelabellist = function (ev, equptypelabels) {
        var template_name = 'mainadmin/edit_equp_type_lables';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {equptypelabels: equptypelabels},
            controller: _eEquptypelabels
        }).then(function () {
            },
            function () {
            });
    };
    function _eEquptypelabels($scope, equptypelabels) {
        $scope.eequptypelabels = equptypelabels;
        $scope.eequptypelabels.module_id = equptypelabels.MODULE_ID;
		$scope.eequptypelabels.org_id  = equptypelabels.ORG_NAME;
        $scope.eequptypelabels.equp_type_name = equptypelabels.TYPE;
        $scope.eequptypelabels.code = equptypelabels.CODE;
        $scope.eequptypelabels.status = equptypelabels.STATUS;
        $scope.eequptypelabels.actions = equptypelabels.ACTION;
    }
    $scope.Updateequptypelabelslist = function (equptypelabels) {
        equptypelabels.action = "update_equp_type_labels_list";
        baseFactory.Mainadmin(equptypelabels)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadEqupTypeLabelslist();
                        // $state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };




  $scope.edittablename = function (ev, table) {
        var template_name = 'mainadmin/edit_table_name';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {table: table},
            controller: _eTtable
        }).then(function () {
            },
            function () {
            });
    };
    function _eTtable($scope,table) {
        $scope.etable = table;
        $scope.etable.table_name = table.TABLE_NAME;
		$scope.etable.module_id = table.MODULE_ID;
		
    }
	
	
	$scope.UpdateTablename = function (etable) {
        etable.action = "update_table_name";
        baseFactory.Mainadmin(etable)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadEqupTypeLabelslist();
                        // $state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
   
   
   $scope.editformtable = function (ev,master)
   {
	   var template_name = 'mainadmin/edit_org_form_creation';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {master: master},
            controller: _eOrgformctrl
        }).then(function () {
            },
            function () {
            });
    }; 	
    function _eOrgformctrl($scope,master) {
            $scope.demog = master;
			//return $scope.demog;
		
    }
   


    $scope.editroletypes = function (ev, roles) {
        var template_name = 'mainadmin/edit_role_type_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {roles: roles},
            controller: _eRoles
        }).then(function () {
            },
            function () {
            });
    };
    function _eRoles($scope, roles) {
        $scope.eroles = roles;
        $scope.eroles.role_type = roles.ROLE_TYPE;
        $scope.eroles.role_type_name = roles.ROLE_TYPE_NAME;
        $scope.eroles.module_id = roles.MODULE_ID;
        $scope.eroles.status  = roles.STATUS;
    }
    $scope.Updateroles = function (roles) {
        roles.action = "update_role_type";
        baseFactory.Mainadmin(roles)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadRoletypes();
                         //$state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.editcountrylabels = function (ev, country) {
        var template_name = 'mainadmin/edit_country_label_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {country: country},
            controller: _eCountry
        }).then(function () {
            },
            function () {
            });
    };
    function _eCountry($scope, country) {
        $scope.ecountry = country;
        $scope.ecountry.country_name = country.COUNTRY_NAME;
        $scope.ecountry.country_code = country.COUNTRY_CODE;
        $scope.ecountry.module_id = country.MODULE_ID;
        $scope.ecountry.status  = country.STATUS;
        $scope.ecountry.actions = country.ACTION;
    }
    $scope.UpdateCountrylabel = function (ecountry) {
        ecountry.action = "update_country_label";
        baseFactory.Mainadmin(ecountry)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                        //$state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editcitieslabels = function (ev, citylabels) {
        var template_name = 'mainadmin/edit_city_label_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {citylabels: citylabels},
            controller: _eCitylabels
        }).then(function () {
            },
            function () {
            });
    };
    function _eCitylabels($scope, citylabels) {
        $scope.ecitylabels = citylabels;
        $scope.ecitylabels.city_name = citylabels.CITY_NAME;
        $scope.ecitylabels.city_code = citylabels.CITY_CODE;
        $scope.ecitylabels.module_id = citylabels.MODULE_ID;
        $scope.ecitylabels.status  = citylabels.STATUS;
        $scope.ecitylabels.actions = citylabels.ACTION;
    }
    $scope.UpdateCityLabel = function (ecitylabels) {
        ecitylabels.action = "update_cities_label";
        baseFactory.Mainadmin(ecitylabels)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                        //$state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editstateslabels = function (ev, statelabel) {
        var template_name = 'mainadmin/edit_state_label_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {statelabel: statelabel},
            controller: _eStatelabel
        }).then(function () {
            },
            function () {
            });
    };
    function _eStatelabel($scope, statelabel) {
        $scope.estatelabel = statelabel;
        $scope.estatelabel.state_name = statelabel.STATE_NAME;
        $scope.estatelabel.state_code = statelabel.STATE_CODE;
        $scope.estatelabel.module_id = statelabel.MODULE_ID;
        $scope.estatelabel.status  = statelabel.STATUS;
        $scope.estatelabel.actions = statelabel.ACTION;
    }
    $scope.UpdateStateLabel = function (statelabel) {
        statelabel.action = "update_states_label";
        baseFactory.Mainadmin(statelabel)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                        //$state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.edituserlabels = function (ev, user) {
        var template_name = 'mainadmin/edit_user_label_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {user: user},
            controller: _eUserlabel
        }).then(function () {
            },
            function () {
            });
    };
    function _eUserlabel($scope, user) {
        $scope.euserlabel = user;
		$scope.euserlabel.module_id = user.MODULE_ID;
		$scope.euserlabel.org_id  = user.ORG_NAME;
        $scope.euserlabel.user_name = user.USER_NAME;
        $scope.euserlabel.email = user.EMAIL_ID;
        $scope.euserlabel.contact = user.EMP_ID;
        $scope.euserlabel.role  = user.ROLE_NAME;
        $scope.euserlabel.branch = user.BRANCH;
        $scope.euserlabel.levels = user.LEVEL;
        $scope.euserlabel.status = user.STATUS;
        $scope.euserlabel.actions = user.ACTION;
    }
    $scope.UpdateUserlabel = function (euserlabel) {
        euserlabel.action = "update_user_label";
        baseFactory.Mainadmin(euserlabel)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                        //$state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.editcontracttypelabels = function (ev, contracttype) {
        var template_name = 'mainadmin/edit_contracttype_label_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {contracttype: contracttype},
            controller: _eContracttype
        }).then(function () {
            },
            function () {
            });
    };
    function _eContracttype($scope, contracttype) {
        $scope.econtracttypelabel = contracttype;
        $scope.econtracttypelabel.module_id = contracttype.MODULE_ID;
		$scope.econtracttypelabel.org_id = contracttype.ORG_NAME;
        $scope.econtracttypelabel.contract_type = contracttype.CTYPE;
        $scope.econtracttypelabel.contract_type = contracttype.CFORM;
        $scope.econtracttypelabel.status  = contracttype.STATUS;
        $scope.econtracttypelabel.actions = contracttype.ACTION;
    }
    $scope.UpdateContracttypelabel = function (econtracttypelabel) {
        econtracttypelabel.action = "update_contracttype_label";
        baseFactory.Mainadmin(econtracttypelabel)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                        //$state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editincidenttypeabels = function (ev, incidenttype) {
        var template_name = 'mainadmin/edit_incidenttype_label_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {incidenttype: incidenttype},
            controller: _eIncidenttype
        }).then(function () {
            },
            function () {
            });
    };
    function _eIncidenttype($scope, incidenttype) {
        $scope.eincidenttypelabel = incidenttype;
        $scope.eincidenttypelabel.module_id = incidenttype.MODULE_ID;
		$scope.eincidenttypelabel.org_id = incidenttype.ORG_NAME;
        $scope.eincidenttypelabel.incident_type = incidenttype.ITYPE;
        $scope.eincidenttypelabel.incident_code = incidenttype.CODE;
        $scope.eincidenttypelabel.status  = incidenttype.STATUS;
        $scope.eincidenttypelabel.actions = incidenttype.ACTION;
    }
    $scope.UpdateIncidenttypelabel = function (eincidenttypelabel) {
        eincidenttypelabel.action = "update_incidenttype_label";
        baseFactory.Mainadmin(eincidenttypelabel)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                        //$state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.editbranchlabel = function (ev, branchlabel) {
        var template_name = 'mainadmin/edit_branch_label_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {branchlabel: branchlabel},
            controller: _eBranchlabel
        }).then(function () {
            },
            function () {
            });
    };
    function _eBranchlabel($scope, branchlabel) {
        $scope.ebranchlabel = branchlabel;
        $scope.ebranchlabel.module_id = branchlabel.MODULE_ID;
		$scope.ebranchlabel.org_id  = branchlabel.ORG_ID;
        $scope.ebranchlabel.branch_name = branchlabel.BRANCH_NAME;
        $scope.ebranchlabel.branch_code = branchlabel.BRANCH_CODE;
        $scope.ebranchlabel.hod = branchlabel.USER_NAME;
        $scope.ebranchlabel.address = branchlabel.BRANCH_ADDRESS;
        $scope.ebranchlabel.added_date = branchlabel.ADDED_ON;
        $scope.ebranchlabel.status  = branchlabel.STATUS;
        $scope.ebranchlabel.actions = branchlabel.ACTION;
    }
    $scope.UpdateBranchlabel = function (ebranchlabel) {
        ebranchlabel.action = "update_branch_label";
        baseFactory.Mainadmin(ebranchlabel)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadbranchlabels();
                        //$state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };



$scope.edit_item_master = function (ev, label) {

        var template_name = 'mainadmin/edit_item_master';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {label: label},
            controller: _eItemmaster
        }).then(function () {
            },
            function () {
            });
    };
    function _eItemmaster($scope, label) {
        $scope.eitem_master = label;
        $scope.eitem_master.module_id = label.MODULE_ID;
		$scope.eitem_master.field_type  = label.FIELD_TYPE;
        $scope.eitem_master.field_desc = label.FIELD_DESC;
        $scope.eitem_master.qid = label.Q_ID;
        $scope.eitem_master.max_opt = label.MAX_OPT;
		 $scope.eitem_master.mandetory = label.MANDETORY;
		  $scope.eitem_master.disabled = label.DISABLED;
		$scope.eitem_master.qid = label.Q_ID;
		$scope.eitem_master.db_field = label.DB_FIELD;
        $scope.eitem_master.opt1 = label.OPT1;
        $scope.eitem_master.opt2 = label.OPT2;
        $scope.eitem_master.opt3 = label.OPT3;
        $scope.eitem_master.opt4 = label.OPT4;
		$scope.eitem_master.opt5 = label.OPT5;
		$scope.eitem_master.opt6 = label.OPT6;
		$scope.eitem_master.opt7 = label.OPT7;
		$scope.eitem_master.opt8 = label.OPT8;
		$scope.eitem_master.opt9 = label.OPT9;
		$scope.eitem_master.opt9 = label.OPT9;
		$scope.eitem_master.opt9 = label.OPT9;
		$scope.eitem_master.opt10 = label.OPT10;
		$scope.eitem_master.opt11 = label.OPT11;
		$scope.eitem_master.opt12 = label.OPT12;
		$scope.eitem_master.opt13 = label.OPT13;
		$scope.eitem_master.opt14 = label.OPT14;
		$scope.eitem_master.opt15 = label.OPT15;
		$scope.eitem_master.opt16 = label.OPT16;
		$scope.eitem_master.opt17 = label.OPT17;
		$scope.eitem_master.opt18 = label.OPT18;
		$scope.eitem_master.opt19 = label.OPT19;
		$scope.eitem_master.opt20 = label.OPT20;
		$scope.eitem_master.opt21 = label.OPT21;
		$scope.eitem_master.opt22 = label.OPT22;
		$scope.eitem_master.opt23 = label.OPT23;
		$scope.eitem_master.opt24 = label.OPT24;
		$scope.eitem_master.opt25 = label.OPT25;
    }
    $scope.updateitemmaster = function (eitem_master) {
        eitem_master.action = "update_item_master";
        baseFactory.Mainadmin(eitem_master)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        //$scope.loadbranchlabels();
                        //$state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };




    $scope.editdepartmentlabel = function (ev, department) {
        var template_name = 'mainadmin/edit_dept_label_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {department: department},
            controller: _eDepartlabel
        }).then(function () {
            },
            function () {
            });
    };
    function _eDepartlabel($scope, department) {
        $scope.edepartment = department;
        $scope.edepartment.department = department.DEPARTMENT;
		$scope.edepartment.module_id  = department.MODULE_ID;
		$scope.edepartment.org_id    = department.ORG_NAME;
        $scope.edepartment.code = department.CODE;
        $scope.edepartment.status = department.STATUS;
        $scope.edepartment.actions  = department.ACTION;
    }
    $scope.UpdateDepartmentlabel = function (edepartment) {
        edepartment.action = "update_dept_label";
        baseFactory.Mainadmin(edepartment)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                        //$state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editdevicenameslabel = function (ev, devicenames) {
        var template_name = 'mainadmin/edit_devicenames_label_list';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {devicenames: devicenames},
            controller: _eDevicenames
        }).then(function () {
            },
            function () {
            });
    };
    function _eDevicenames($scope, devicenames) {
        $scope.edevicenames = devicenames;
        $scope.edevicenames.device_name = devicenames.NAME;
		$scope.edevicenames.org_id = devicenames.ORG_NAME;
		$scope.edevicenames.module_id = devicenames.MODULE_ID;
        $scope.edevicenames.code = devicenames.CODE;
        $scope.edevicenames.status = devicenames.STATUS;
        $scope.edevicenames.actions  = devicenames.ACTION;
    }
    $scope.UpdateDevicenameslabel = function (edevicenames) {
        edevicenames.action = "update_devicename_label";
        baseFactory.Mainadmin(edevicenames)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();

                        //$state.go("home.reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };





    $scope.editnonreasons = function (ev, nonreason) {
        var template_name = 'user/edit_non_scheduled_reason_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {nonreason: nonreason},
            controller: _eNonReasons
        }).then(function () {
            },
            function () {
            });
    };
    function _eNonReasons($scope, nonreason) {
        $scope.eereasons = nonreason;
        $scope.eereasons.reason = nonreason.REASON;
        $scope.eereasons.status = nonreason.STATUS;
    }
    $scope.UpdateNonReasons = function (nonreason) {
        nonreason.action = "update_non_reasons";
        baseFactory.UserCtrl(nonreason)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadReasonsList();
                        $state.go("home.non_scheduled_reasons");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

	
	
    $scope.loadLevelsList = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var levels;
            if (typeof limit_val === 'undefined')
                levels = 0;
            else if (limit_val == 0)
                levels = 0;
            else
                levels = limit_val - 1;
            $log.error(levels);
            var send = {limit_val: levels, action: "get_levels_list"};
        }
        else {
            var send = {action: "get_levels_list"};
        }
        send.branch_id = $scope.user_branch;
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.levels = angular.fromJson(payload.list);
						$scope.level_labels  = angular.fromJson(payload.labels);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.levels = null;
						$scope.level_labels = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.addLevels = function (level) {
        level.action = "add_levels";
        baseFactory.UserCtrl(level)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.levels");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.editrLevel = function (ev, level) {
        var template_name = 'user/edit_levels_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {level: level},
            controller: _elevels
        }).then(function () {
            },
            function () {
            });
    };
    function _elevels($scope, level) {
        $scope.elevel = level;
        $scope.elevel.level = level.LEVEL_NAME;
        $scope.elevel.status = level.STATUS;
    }

    $scope.UpdateLevel = function (level) {
        level.action = "update_levels";
        baseFactory.UserCtrl(level)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        //$state.go("home.levels");
                        $scope.loadLevelsList();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadEscalationList = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var esclist;
            if (typeof limit_val === 'undefined')
                esclist = 0;
            else if (limit_val == 0)
                esclist = 0;
            else
                esclist = limit_val - 1;
            $log.error(esclist);
            var send = {limit_val: esclist, action: "get_Escalation_list"};
        }
        else {
            var send = {action: "get_Escalation_list"};
        }

        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug("esccc");
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.escalts_types = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.escalts_types = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addEscalation = function (esca) {
        esca.action = "add_escalation";
        baseFactory.UserCtrl(esca)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.escalation");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editrEscalation = function (ev, escalts) {
        var template_name = 'user/edit_escalations_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {escalts: escalts},
            controller: _eEscalation
        }).then(function () {
            },
            function () {
            });
    };
    function _eEscalation($scope, escalts) {
        $scope.eescal = escalts;
        $scope.eescal.escalation = escalts.ES_NAME;
        $scope.eescal.status = escalts.STATUS;
    }

    $scope.UpdateEscalation = function (escal) {
        escal.action = "update_escalation";
        baseFactory.UserCtrl(escal)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadEscalations();
                        //$state.go("home.escalation");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadEscalations = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var escalations;
            if (typeof limit_val === 'undefined')
                escalations = 0;
            else if (limit_val == 0)
                escalations = 0;
            else
                escalations = limit_val - 1;
            $log.error(escalations);
            var send = {limit_val: escalations, action: "get_Escalations_list"};
        }
        else {
            var send = {action: "get_Escalations_list"};
        }
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug("get_Escalations_list");
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.escalts = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.escalts = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;

                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addEscalations1 = function (escal)
    {
        $scope.loadEscalationList();
        $scope.getEqupTypes();
        escal.action = "add_escalations1";
        baseFactory.UserCtrl(escal)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.escalations");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.editrEscalations1 = function (ev, escalts1) {
        var template_name = 'user/edit_escalations1_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {escalts1: escalts1},
            controller: _eEscalations1
        }).then(function () {
            },
            function () {
            });
    };
    function _eEscalations1($scope, escalts1) {
        $scope.loadEscalationList();
        $scope.loadUtillization();
        $scope.getEqupCategories();
        $scope.edit_escl = escalts1;
        $scope.edit_escl.equp_type = escalts1.EQUIPMENT_TYPE;
        $scope.edit_escl.es_util = escalts1.EQUIPMENT_UTIL;
        $scope.edit_escl.es_module1 = escalts1.ES_MODULE;
        $scope.edit_escl.level1 = escalts1.L1;
        $scope.edit_escl.l1_type = $scope.time_types[0];
        $scope.edit_escl.level2 = escalts1.L2;
        $scope.edit_escl.l2_type = $scope.time_types[0];
        $scope.edit_escl.level3 = escalts1.L3;
        $scope.edit_escl.l3_type = $scope.time_types[0];
    }


    $scope.UpdateEscalations1 = function (escal1) {
        escal1.action = "update_escalations1";
        baseFactory.UserCtrl(escal1)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadEscalations();
                        $state.go("home.escalations");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addIncidentType = function (itype) {
        itype.action = "add_incident_type";
		itype.user_org_module = $scope.user_org_module;
        baseFactory.UserCtrl(itype)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadIncidentType();
                        $state.go("home.incident_type");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }
    $scope.editIncidentType = function (ev, eitype) {
        var template_name = 'user/edit_itype_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {eitype: eitype},
            controller: _eItype
        }).then(function () {
            },
            function () {
            });
    };
    function _eItype($scope, eitype) {

        $scope.eityp = eitype;
        $scope.eityp.itype = eitype.ITYPE;
        $scope.eityp.icode = eitype.CODE;
        $scope.eityp.status = eitype.STATUS;
    }


    $scope.UpdateIncidenttype = function (eitype) {
		console.log(eitype);
        eitype.action = "update_incident_type";
        baseFactory.UserCtrl(eitype)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadIncidentType();
                        $state.go("home.incident_type");

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadAdverseIncedents = function (hod_call, limit_val) {
        if (limit_val != $scope.nostate) {
            var adincedents;
            if (typeof limit_val === 'undefined')
                adincedents = 0;
            else if (limit_val == 0)
                adincedents = 0;
            else
                adincedents = limit_val - 1;
            $log.error(adincedents);
            $scope.incdent.limit_val = adincedents;
        }
        else {
            delete $scope.incdent.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.incdent.equp_id = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.incdent.equp_id = $scope.searched.EID.E_ID;
        else
            $scope.incdent.equp_id = "";
        if (typeof hod_call != "undefined") {
            if (hod_call == "get_hod_calls")
                $scope.incdent.aaction = hod_call;
            else if (hod_call == "get_assigned_calls")
                $scope.incdent.aaction = "get_assigned_calls";
            else {
                delete $scope.incdent.aaction;
            }
        }
        else {
            delete $scope.incdent.aaction;
        }
        if ($scope.user_role_code == $scope.HBHOD) {
            if ($scope.myall_hod_select != undefined) {
                if ($scope.myall_hod_select == $scope.hod_calls_select[0]) {
                    $scope.incdent.mine = $scope.yesstate;
                }
                else if ($scope.myall_hod_select == $scope.hod_calls_select[1]) {
                    delete $scope.incdent.mine;
                }
            }
            else
                delete $scope.incdent.mine;
        }
        $scope.incdent.action = "get_adverse_incidents";
        $scope.incdent.branch_id = $scope.user_branch;
        $log.log(JSON.stringify($scope.incdent));
        baseFactory.deviceCall($scope.incdent)
            .then(function (payload) {
                    $log.info(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.ad_incednts = angular.fromJson(payload.list);
                        $scope.adverse_approvals_count = payload.adverse_approvals_count;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.ad_incednts = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadAdverseIncedentsNew = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var adincedents;
            if (typeof limit_val === 'undefined')
                adincedents = 0;
            else if (limit_val == 0)
                adincedents = 0;
            else
                adincedents = limit_val - 1;
            $log.error(adincedents);
            $scope.adverse_search_new.limit_val = adincedents;
        }
        else {
            delete $scope.adverse_search_new.limit_val;
        }
        $scope.adverse_search_new.action = "get_adverse_new_incidents";
        $scope.adverse_search_new.branch_id = $scope.user_branch;
        $log.log($scope.adverse_search_new);
        baseFactory.deviceCall($scope.adverse_search_new)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.indent_equps_new = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.indent_equps_new = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.getAdverseIncedents = function (limit_val)
    {
		console.log("fgfg");
        $log.info('limit_value'+limit_val);
        if (limit_val != $scope.nostate) {
            var ad;
            if (limit_val == undefined)
                ad = 0;
            else if (limit_val == 0)
                ad = 0;
            else
                ad = limit_val - 1;
            $log.error(ad);
            $scope.adverseincdent.limit_val = ad;
        }
        else {
            delete $scope.adverseincdent.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.adverseincdent.equp_id = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.adverseincdent.equp_id = $scope.searched.EID.E_ID;
        else
            $scope.adverseincdent.equp_id = "";
         $scope.adverseincdent.action = "get_adverse_incidents_clist";
        $scope.adverseincdent.branch_id = $scope.user_branch;
        console.log($scope.adverseincdent);
        baseFactory.deviceCall($scope.adverseincdent)
            .then(function (payload) {
                console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.adverse_incednts = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $log.info($scope.paging.total);
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.adverse_incednts = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {

                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addIncedent = function (incidents)
    {
        incidents.action = "add_incidents";
        baseFactory.UserCtrl(incidents)
            .then(function (payload)
            {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata)
                    {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadAdverseIncedents();
                        $state.go("home.observations")
                    }
                    else if (payload.response == $rootScope.failedata)
                    {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.editObservations = function (ev, obsrt) {
        $scope.getHodBmes();
        //$scope.loadAdverseIncedents();
        var template_name = 'user/edit_observation_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {obsrt: obsrt},
            controller: _eObservation
        }).then(function () {
            },
            function () {
            });
    };
    function _eObservation($scope, obsrt) {
        $scope.edit_obser = obsrt;
        $scope.edit_obser.observation = obsrt.OBSERVATIONS;
		$scope.edit_obser.spares   = obsrt.SPARES;
		$scope.edit_obser.accessories  = obsrt.ACCESSORIES;
		$scope.edit_obser.icomment    = obsrt.INCHARGE_COMMENT;
		$scope.edit_obser.report  = obsrt.OCCRANCE_REPORT;
		$scope.edit_obser.tcost   = obsrt.TOTAL_COST;
		$scope.edit_obser.acost   = obsrt.APPROXIMATE_COST;
		$scope.edit_obser.nreport = obsrt.NATURE_REPORT;
		$scope.edit_obser.cause_probability = obsrt.CAUSE_PROBABILITY;
		$scope.edit_obser.operator_name   = obsrt.OPERATOR_NAME;
		$scope.edit_obser.ceobser       = obsrt.CHIEF_ENG_OBSERV;
		$scope.edit_obser.eexp_Restorations = obsrt.RESTORATION_TIME;
		$scope.edit_obser.ope_obser = obsrt.OPERATOR_OBSER;
		$scope.edit_obser.conclusion = obsrt.CONCLUSION;
		$scope.edit_obser.action_taken = obsrt.ACTION_TACKEN;
		$scope.edit_obser.observationscompleteremarks  = obsrt.COMPLETE_REMARKS;
    }

    $scope.editadverseIncidents = function (ev, add_incedets)
    {
        $scope.loadAdverseIncedents();
        var template_name = 'user/edit_adverse_incidents_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {add_incedets: add_incedets},
            controller: _eAdverseIncidents
        }).then(function () {
            },
            function () {
            });
    };
    function _eAdverseIncidents($scope, add_incedets) {
        $scope.getHodBmes();
        $scope.edit_adv_ind = add_incedets;
        $scope.edit_adv_ind.icomment = add_incedets.INCHARGE_COMMENT;
        $scope.edit_adv_ind.observation = add_incedets.OBSERVATIONS;
        $scope.edit_adv_ind.report = add_incedets.OCCRANCE_REPORT;
        $scope.edit_adv_ind.spares = add_incedets.SPARES;
        $scope.edit_adv_ind.accessories = add_incedets.ACCESSORIES;
        $scope.edit_adv_ind.acost = add_incedets.APPROXIMATE_COST;
        $scope.edit_adv_ind.tcost = add_incedets.TOTAL_COST;
        $scope.edit_adv_ind.action_taken = add_incedets.ACTION_TACKEN;
    }

    $scope.ApproveObservations = function (ev, add_incedets)
    {
        var template_name = 'user/adverse_incident_aprrove_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {add_incedets: add_incedets},
            controller: _eApproveObservations
        }).then(function () {
            },
            function () {
            });
    };
    function _eApproveObservations($scope, add_incedets)
    {
        $scope.approve_adv_ind = add_incedets;
        $scope.approve_adv_ind.icomment = add_incedets.INCHARGE_COMMENT;
        $scope.approve_adv_ind.observation = add_incedets.OBSERVATIONS;
        $scope.approve_adv_ind.approved_by = add_incedets.APPROVED_BY!=null ? angular.fromJson(add_incedets.APPROVED_BY) : null;
        $scope.approve_adv_ind.report = add_incedets.OCCRANCE_REPORT;
        $scope.approve_adv_ind.spares = add_incedets.SPARES;
        $scope.approve_adv_ind.accessories = add_incedets.ACCESSORIES;
        $scope.approve_adv_ind.acost = add_incedets.APPROXIMATE_COST;
        $scope.approve_adv_ind.tcost = add_incedets.TOTAL_COST;
        $scope.approve_adv_ind.action_taken = add_incedets.ACTION_TACKEN;
    }

    $scope.UpdateObservations = function (obser) {
        obser.action = "update_observations";
        baseFactory.UserCtrl(obser)
            .then(function (payload) {
                    $log.log(obser.action);
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadAdverseIncedents();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.UpdateApproveObservations = function (obser,aistatus)
    {
        obser.action = "update_observations_approve";
        var user_id=$cookies.get('user_id');
        var user_erole_code = $cookies.get('user_erole_code');
        var appr={user_id:user_id,role:user_erole_code};
        if(obser.approved_by==null)
        {
            obser.approved_by=[appr];
        }
        else
        {
            obser.approved_by.push(appr);
        }
        obser.approve_status = aistatus;
        baseFactory.UserCtrl(obser)
            .then(function (payload) {
                    $log.log(obser.action);
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadAdverseIncedents();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.UpdateAdverseIncedents = function (adobser) {
        adobser.action = "update_adverse_incedets";
        baseFactory.UserCtrl(adobser)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                     //   $scope.getAdverseIncedents();
					    $scope.loadAdverseIncedents();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getContractVendorDetails = function (vid) {
        var data = {};
        data.vid = vid;
        data.action = "get_contract_vendor_details";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    var vdata = angular.fromJson(payload.list);
                    if ($state.is("home.hbhod_add_asset") || $state.is("home.hbbme_add_asset") || $state.is("home.add_stock"))
                    {
                        $log.log("your stock is here");
                        $scope.add_device.vendor_contact_no = vdata.vendor_number;
                        $scope.add_device.vemail_id = vdata.vendor_email;
                        $scope.add_device.vcontact_person = vdata.CP_NAME;
                        $scope.add_device.vcontact_person_no = vdata.CP_NUMBER;
                        $scope.add_device.vcontact_person_email_id = vdata.CP_EMAIL;
                        $scope.add_device.vendor_address = vdata.vendor_address;
                    }
                    else if ($state.is("home.edit_device") || $state.is("home.view_devies"))
                    {
                        $scope.edit_device.vendor_contact_no = vdata.vendor_number;
                        $scope.edit_device.vemail_id = vdata.vendor_email;
                        $scope.edit_device.vcontact_person = vdata.CP_NAME;
                        $scope.edit_device.vcontact_person_no = vdata.CP_NUMBER;
                        $scope.edit_device.vcontact_person_email_id = vdata.CP_EMAIL;
                        $scope.edit_device.vendor_address = vdata.vendor_address;
                    }
                    else if ($state.is("home.replace_device"))
                    {
                        $scope.replace_device.vendor_contact_no = vdata.vendor_number;
                        $scope.replace_device.vemail_id = vdata.vendor_email;
                        $scope.replace_device.vcontact_person = vdata.CP_NAME;
                        $scope.replace_device.vcontact_person_no = vdata.CP_NUMBER;
                        $scope.replace_device.vcontact_person_email_id = vdata.CP_EMAIL;
                        $scope.replace_device.vendor_address = vdata.vendor_address;
                    }
                    else if ($state.is("home.indent_equipment_request")) {
                        $scope.indent_equipment.vendor_contact_no = vdata.MOBILE_NO;
                        $scope.indent_equipment.vemail_id = vdata.EMAIL_ID;
                        $scope.indent_equipment.vcontact_person = vdata.CP_NAME;
                        $scope.indent_equipment.vcontact_person_no = vdata.CP_NUMBER;
                        $scope.indent_equipment.vcontact_person_email_id = vdata.CP_EMAIL;
                        $scope.indent_equipment.vendor_address = vdata.ADDRESS;
                    }
                    else
                    {
                        $scope.edit_indent_equipment.vendor_contact_no = vdata.MOBILE_NO;
                        $scope.edit_indent_equipment.vemail_id = vdata.EMAIL_ID;
                        $scope.edit_indent_equipment.vcontact_person = vdata.CP_NAME;
                        $scope.edit_indent_equipment.vcontact_person_no = vdata.CP_NUMBER;
                        $scope.edit_indent_equipment.vcontact_person_email_id = vdata.CP_EMAIL;
                        $scope.edit_indent_equipment.vendor_address = vdata.ADDRESS;

                        $scope.add_mcontract.vendor_contact_no = vdata.MOBILE_NO;
                        $scope.add_mcontract.vemail_id = vdata.EMAIL_ID;
                        $scope.add_mcontract.vcontact_person = vdata.CP_NAME;
                        $scope.add_mcontract.vcontact_person_no = vdata.CP_NUMBER;
                        $scope.add_mcontract.vcontact_person_email_id = vdata.CP_EMAIL;
                        $scope.add_mcontract.vendor_address = vdata.ADDRESS;

                        $scope.edit_mcontract.vendor = $scope.add_r_mcontract.vendor = vdata.ID;
                        $scope.edit_mcontract.vendor_contact_no = $scope.add_r_mcontract.vendor_contact_no = vdata.MOBILE_NO;
                        $scope.edit_mcontract.vemail_id = $scope.add_r_mcontract.vemail_id = vdata.EMAIL_ID;
                        $scope.edit_mcontract.vcontact_person = $scope.add_r_mcontract.vcontact_person = vdata.CP_NAME;
                        $scope.edit_mcontract.vcontact_person_no = $scope.add_r_mcontract.vcontact_person_no = vdata.CP_NUMBER;
                        $scope.edit_mcontract.vcontact_person_email_id = $scope.add_r_mcontract.vcontact_person_email_id = vdata.CP_EMAIL;
                        $scope.edit_mcontract.vendor_address = $scope.add_r_mcontract.vendor_address = vdata.ADDRESS;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	$scope.getVendorDetails = function(vid){
        var data = {};
        data.vid = vid;
        data.action = "get_vendor_details";
       // console.log(data);
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    //console.log(payload);
                    var vdata = angular.fromJson(payload.list);
                    $scope.indent_equipment.vcontact_person = vdata.contact_person;
                    $scope.indent_equipment.vendor_contact_no = vdata.contact_person_no;
                    $scope.indent_equipment.vemail_id = vdata.cpemail;
                    $scope.indent_equipment.vendor = vdata.org_name;
                    $scope.indent_equipment.vendor_id = vdata.vendor_id;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
    $scope.getVendorAndEquipmentsDtls = function (vendor_id,branch_id) {
        if(branch_id == '' || branch_id == undefined)
            return false;

        var data = {};
        data.action = "vendor_equipments_expired";
        data.vendor_id = vendor_id;
        data.branch_id = branch_id;
         console.log(data);
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.log(payload);
                    $scope.contract_equps = payload.list
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.addMContracts = function (mcontracts) {
        if ($scope.searched.EID == null)
            mcontracts.equp_id = "";
        else if (typeof $scope.searched.EID === 'object')
            mcontracts.equp_id = $scope.searched.EID.E_ID;
        else
            mcontracts.equp_id = "";
        mcontracts.action = "add_maintaince_contracts";
        $log.log(mcontracts);
        baseFactory.deviceCall(mcontracts)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.cancel();
                        $scope.loadMaintanceContracts();
                        $scope.add_mcontract = {};
                        $state.go("home.maintain_contracts")
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addMultiContracts = function (mul_contracts) {
        mul_contracts.action = "insert_multi_contracts";
        $log.log(mul_contracts);
        baseFactory.deviceCall(mul_contracts)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $state.go("home.maintain_contracts")
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addMContractsOV = function (mcontracts) {
        mcontracts.action = "add_maintaince_contracts";
        $log.log("add_maintaince_contracts");
        $log.log(mcontracts);
        baseFactory.deviceCall(mcontracts)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.cancel();
                        $scope.loadMaintanceContracts();
                        $scope.add_mcontract = {};
                        $state.go("home.maintain_contracts")
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getContractsCount = function () {
        baseFactory.deviceCall({action: "get_contracts_count"})
            .then(function (payload) {
                    $scope.m_contracts_cnt = angular.fromJson(payload);
                    $log.warn($scope.m_contracts_cnt);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadMaintanceContracts = function (limit_val, expiry_in) {
        if (limit_val != $scope.nostate) {
            var mcontracts;
            if (typeof limit_val === 'undefined')
                mcontracts = 0;
            else if (limit_val == 0)
                mcontracts = 0;
            else
                mcontracts = limit_val - 1;
            $log.error(mcontracts);
            $scope.mcontract.limit_val = mcontracts;
        }
        else {
            delete $scope.mcontract.limit_val;
        }
        if (expiry_in != undefined && expiry_in != null) {
            $scope.mcontract.expiry_in = expiry_in;
        }
        else {
            $scope.mcontract.expiry_in = '';
        }
        $log.log($scope.searched.EID);
        if ($scope.searched.EID == null)
            $scope.mcontract.equp_id = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.mcontract.equp_id = $scope.searched.EID.E_ID;
        else
            $scope.mcontract.equp_id = "";
        console.clear();
        console.log($scope.searched.ORG_ID);
        if ($scope.searched.ORG_ID == null)
            $scope.mcontract.vendor = "";
        else if (typeof $scope.searched.ORG_ID === 'object')
            $scope.mcontract.vendor = $scope.searched.ORG_ID.ORG_ID;
        else
            $scope.mcontract.vendor = "";
        $scope.mcontract.action = "get_m_contracts";
        $scope.mcontract.branch_id = $scope.user_branch;
        $log.error("get Contracts");
        console.log(JSON.stringify($scope.mcontract));
        baseFactory.deviceCall($scope.mcontract)
            .then(function (payload) {
                   // $log.info(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.m_contracts = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.m_contracts = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

        $scope.getContractsCount();
    };
    $scope.editEquipment = function (ev, device_data)
    {
        console.clear();
        console.log(JSON.stringify(device_data));
        $scope.edit_device = '';
		$scope.getContractVendorDetails(device_data.VENDOR);
        $scope.edit_device = device_data;
        $scope.edit_device.ID = device_data.ID;
        $scope.edit_device.dept_id = device_data.DEPT_ID;
        $scope.edit_device.general_asset = device_data.GENERAL_ASSET;
        $scope.edit_device.category = device_data.category;
        $scope.edit_device.cpname = device_data.OEM;
        $scope.edit_device.equp_type = device_data.equp_type;
        $scope.edit_device.distributor = device_data.DISTRIBUTION;
		$scope.edit_device.vendor = device_data.vendor;
		$scope.edit_device.MF_DATE = device_data.MF_DATE;
		console.log($scope.edit_device.MF_DATE);
        /*$scope.searchDepartment = device_data.DEPT_NAME;
        $scope.searchEcategory = device_data.E_CAT;
        $scope.searchEquipmentType = device_data.equp_type;
        $scope.		= device_data.category;
        $scope.searchCompanyName = device_data.OEM;*/
		
        if (device_data.GRN_DATE != null && device_data.GRN_DATE != '')
        {
            $scope.edit_device.GRN_DATE = new Date(device_data.GRN_DATE);
        }
        if (device_data.DATEOF_INSTALL != null && device_data.DATEOF_INSTALL != '')
        {
            $scope.edit_device.DATEOF_INSTALL = new Date(device_data.DATEOF_INSTALL);
        }
		/*if (device_data.MF_DATE != null && device_data.MF_DATE != '')
        {
            $scope.edit_device.MF_DATE = new Date(device_data.MF_DATE);
        }*/
        if (device_data.PDATE != null && device_data.PDATE != '')
        {
            $scope.edit_device.PDATE = new Date(device_data.PDATE);
        }
        if (device_data.LB_DATE != null && device_data.LB_DATE != '')
        {
            $scope.edit_device.LB_DATE = new Date(device_data.LB_DATE);
        }
        if (!$scope.isEmpty($scope.edit_device.pms))
        {
            $scope.edit_device.PMS_ID = $scope.edit_device.pms[0].ID;
            if($scope.edit_device.pms[0].PMS_DONE != null)
                $scope.edit_device.PMS_DONE = new Date($scope.edit_device.pms[0].PMS_DONE);
            else
                $scope.edit_device.PMS_DONE = '';
            $scope.edit_device.PMS_COUNT = $scope.edit_device.pms[0].PMS_COUNT;
        }
        else {
            $scope.edit_device.PMS_ID = 'new';
            $scope.edit_device.PMS_DONE = '';
            $scope.edit_device.PMS_COUNT = '';
        }

        if (!$scope.isEmpty($scope.edit_device.qc)) {
            $scope.edit_device.QC_ID = $scope.edit_device.qc[0].ID;
            if ($scope.edit_device.qc[0].QC_DONE != null)
                $scope.edit_device.QC_DONE = new Date($scope.edit_device.qc[0].QC_DONE);
            else
                $scope.edit_device.QC_DONE = null;
            $scope.edit_device.QC_COUNT = $scope.edit_device.qc[0].QC_COUNT;
            $scope.edit_device.QC_COUNT_TYPE = $scope.edit_device.qc[0].QC_COUNT_TYPE;
        }
        else {
            $scope.edit_device.QC_ID = 'new';
            $scope.edit_device.QC_DONE = '';
            $scope.edit_device.QC_COUNT = '';
            $scope.edit_device.QC_COUNT_TYPE = '';
        }

        //console.log(JSON.stringify($scope.edit_device.amcs));
        if (!$scope.isEmpty($scope.edit_device.amcs)) {
            $scope.getContractVendorDetails($scope.edit_device.amcs[$scope.edit_device.amcs.length - 1].AMC_VENDOR);
            $scope.edit_device.AMC_ID = $scope.edit_device.amcs[$scope.edit_device.amcs.length - 1].ID;
         }
        else {
            $scope.edit_device.AMC_ID = 'new';
        }

        $scope.edit_device.VENDOR = $scope.edit_device.VENDOR;
        $scope.edit_device.AMC_TYPE = $scope.edit_device.amcs[0].AMC_TYPE;
        $scope.edit_device.AMC_VALUE = $scope.edit_device.amcs[0].AMC_VALUE;
        $scope.edit_device.AMC_FROM = new Date($scope.edit_device.amcs[0].AMC_FROM);
        $scope.edit_device.AMC_TO = new Date($scope.edit_device.amcs[0].AMC_TO);

        /*if($scope.edit_device.C_FROM != null)
            $scope.edit_device.AMC_FROM = new Date($scope.edit_device.C_FROM);
        else
            $scope.edit_device.AMC_FROM = '';

        if($scope.edit_device.C_TO != null)
            $scope.edit_device.AMC_TO = new Date($scope.edit_device.C_TO);
        else
            $scope.edit_device.AMC_TO = '';
		*/
        //return false;
        $state.go('home.edit_device');
    };
	
	$scope.editEquipment1 = function (depart_device)
    {
	  $state.go('home.hbbme_add_asset');
	}
	
/*	$scope.editEmployee = function (employee) {
 $scope.selected = angular.copy(employee);
};*/
    $scope.EquipmentReplacement = function (ev, device_data)
    {
        $scope.replace_device = {};
        $scope.replace_device.ID = device_data.ID;
        $scope.replace_device.EQ_ID = device_data.E_ID;
        $state.go('home.replace_device');
    };
    $scope.editMContracts = function (ev, emcontracts)
    {
        var template_name = 'device/edit_mcontracts_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {emcontracts: emcontracts},
            controller: _eMcontracts
        }).then(function () {
            },
            function () {
            });
    };

    function _eMcontracts($scope, emcontracts) {
        $scope.loadContracts();
        $scope.getSupportVendors();
        $scope.getContractVendorDetails(emcontracts.AMC_VENDOR);
        $scope.edit_mcontract = emcontracts;
        $scope.edit_mcontract.equp_id = emcontracts.EID;
        $scope.edit_mcontract.vendor = emcontracts.AMC_VENDOR;
		$scope.edit_mcontract.ORG_NAME = emcontracts.VENDOR_NAME;
        $scope.edit_mcontract.contract_type = emcontracts.AMC_TYPE;
        $scope.edit_mcontract.contract_from_date = new Date(emcontracts.AMC_FROM);
        $scope.edit_mcontract.contract_to_date = new Date(emcontracts.AMC_TO);
        $scope.edit_mcontract.contract_value = emcontracts.AMC_VALUE;
        $scope.edit_mcontract.remarks = emcontracts.REMARKS;
        $scope.edit_mcontract.branch_id = emcontracts.BRANCH_ID;
        $scope.edit_mcontract.org_id = emcontracts.ORG_ID;
        $scope.edit_mcontract.sstatus = emcontracts.STATUS;
		//$scope.edit_mcontract.ORG_NAME = 
    }

    $scope.UpdateMContract = function (emcontract) {
        emcontract.action = "update_maintain_contract";
        baseFactory.deviceCall(emcontract)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.cancel();
                        $scope.loadMaintanceContracts();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editRenuvalType = function (ev, ermcontracts) {
        var template_name = 'device/edit_renuval_type_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {ermcontracts: ermcontracts},
            controller: _eRNMcontracts
        }).then(function () {
            },
            function () {
            });
    };

    function _eRNMcontracts($scope, ermcontracts) {
        $log.log(ermcontracts);
        $scope.loadContracts();
        $scope.getSupportVendors();
        $scope.getContractVendorDetails(ermcontracts.AMC_VENDOR);
        $scope.add_r_mcontract = ermcontracts;
        $scope.add_r_mcontract.equp_id = $scope.add_mcontract.equp_id = ermcontracts.EID;
        $scope.add_r_mcontract.org_id = $scope.add_mcontract.org_id = ermcontracts.ORG_ID;
        $scope.add_r_mcontract.branch_id = $scope.add_mcontract.branch_id = ermcontracts.BRANCH_ID;
        $scope.add_r_mcontract.vendor = ermcontracts.AMC_VENDOR;
    }


    $scope.mcontract_r_divs = {samevendordiv: true, othervendordiv: false};
    /* used for hide divs in registration */
    $scope.r_m_contract = {svendor: "YES"};
    $scope.$watch('r_m_contract.svendor', function (newValue, oldValue)  /*  used in on change radio buttons in registration */ {
        $scope.add_mcontract.vendor = $scope.add_mcontract.vendor_contact_no = $scope.add_mcontract.vemail_id = $scope.add_mcontract.vcontact_person = $scope.add_mcontract.vcontact_person_no = $scope.add_mcontract.vcontact_person_email_id = $scope.add_mcontract.vendor_address = null;
        if (newValue == "YES") {
            $scope.mcontract_r_divs.samevendordiv = true;
            $scope.mcontract_r_divs.othervendordiv = false;
        }
        else if (newValue == "NO") {
            $scope.mcontract_r_divs.samevendordiv = false;
            $scope.mcontract_r_divs.othervendordiv = true;
        }
    }, true);

    $scope.AddMRContractVendor = function (rcontracts) {
        /*$scope.loadContracts();
         $scope.getSupportVendors();*/
        rcontracts.action = "add_renuval_contracts";
        $log.error('Renewal Contract');
        $log.warn(rcontracts);
        baseFactory.deviceCall(rcontracts)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.cancel();
                        $scope.loadMaintanceContracts();
                        $state.go("home.maintain_contracts")
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadIncedentsandobservations = function (eid) {
        var send = {};
        send = {equp_id: eid, action: "get_incedents_observations_data"};
        $log.debug(send);
        baseFactory.deviceCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.add_incedents = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.add_incedents = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.viewAdverseIncedentsDetalis = function (ev, v_ad_incidents) {
        $scope.loadDepartments();
        $scope.loadIncidentType();
        var template_name = 'device/view_adverse_incedents_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {vaddverseincidents: v_ad_incidents},
            controller: _vaddverseincidents
        }).then(function () {
            },
            function () {
            });
    };

    function _vaddverseincidents($scope, vaddverseincidents) {
        console.log(vaddverseincidents);
            console.log("fgfg");
        var equp_id = vaddverseincidents.EQUP_ID;

        $scope.loadIncedentsandobservations(equp_id);
        //$scope.getAdverseIncedents(equp_id);
    }

    $scope.getCCCEmpDetls = function (empid) {
        if (empid.length > 4) {
            var send = {emp_id: empid, action: "get_ccc_user_dtls"};
            $log.debug(send);
            baseFactory.authCtrl(send)
                .then(function (payload) {
                        $log.debug(payload);
                        if (payload.response == $rootScope.successdata) {
							$scope.NColor = "red";
                            $scope.NMessage = "Employee Number Aleady Exists";
                           // var data = angular.fromJson(payload.emp_dtls);
                            //$scope.add_user.user_name = data.EMP_NAME;
                            //$scope.add_user.mbl_no = data.MOBILE_PHONE;
                            //$scope.add_user.user_email = data.EMAIL_ID;
                        }
                        else if (payload.response == $rootScope.emptydata || payload.response == $rootScope.failedata) {
							$scope.NColor = "";
                            $scope.NMessage = "";
                           // $scope.add_user.user_name = null;
                            //$scope.add_user.mbl_no = null;
                           // $scope.add_user.user_email = null;
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }
        else {
            $scope.add_user.user_name = null;
            $scope.add_user.mbl_no = null;
            $scope.add_user.user_email = null;
        }
    };
    $scope.gotoViewDevices = function () {
        $state.go('home.view_devies');
    };
    $scope.getDepartmentDevices = function (dept_id,branch_id) {
        console.log("in getDepartmentDevices   ");
        var data = {};
        if(branch_id != undefined)
            data.branch_id =branch_id;
        else
            data.branch_id = $scope.user_branch;

        data.action = "get_dept_devices";
        data.dept_id = dept_id;
        console.log(data);
        $log.log(data);
        $scope.devices = '';
        baseFactory.deviceCall(data)
            .then(function (payload) {
                console.log(payload);
                $scope.devices = angular.fromJson(payload.list);
            });
    };
    $scope.getEIDByPriority=function(device_id)
    {
        var data={};
        data.action="get_priority_by_equpmentid";
        data.device_id=device_id;
        baseFactory.deviceCall(data)
            .then(function(payload){
                console.log(payload);
                if(payload.response==$rootScope.successdata)
                {
                    $scope.gen_call.priority = payload.priority;
                }
                else
                {
                    $scope.gen_call.priority = null;
                }
            })
    };
    $scope.UserCallgenerate = function ()
    {
        if ($scope.gen_call.complaint == $scope.nature_of_calls[2])
        {
            $scope.gen_call.action = "call_generation_by_user";
            console.log($scope.gen_call.action);
           $log.info(JSON.stringify($scope.gen_call));
            baseFactory.GenerateCallByUser($scope.gen_call)
                .then(function (payload) {
                        console.log(payload);
                        if (payload.response == $rootScope.successdata || payload.response == $rootScope.exsitsdata) {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                            $state.go('home.' + angular.lowercase($scope.user_role_code) + '_today_calls');
                        }
                        else if (payload.response == $rootScope.failedata || payload.response == $rootScope.emptydata) {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }
        else if ($scope.gen_call.complaint == $scope.nature_of_calls[0])
        {
            $scope.gen_call.action = "add_incidents";
            $scope.gen_call.feedback = $scope.gen_call.generationremarks;
            $scope.gen_call.user_id = $scope.user_id;
			//$scope.gen_call.orgg_id = $scope.user_org;
            $scope.gen_call.itype = $scope.gen_call.type;
            //$scope.gen_call.itype = $scope.geFeedbackTrainingDialogn_call.type;
            $scope.gen_call.equp_id = $scope.gen_call.device_id;
            $scope.gen_call.departments = $scope.gen_call.dept_id;
             
            $log.info(JSON.stringify($scope.gen_call));
           
            baseFactory.UserCtrl($scope.gen_call)
                .then(function (payload) {
                        $log.debug(payload);
                        if (payload.response == $rootScope.successdata) {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                            $scope.gen_call = null;
                            $scope.gen_call = {};
                          //  $state.go('home.' + angular.lowercase($scope.user_role_code) + '_today_calls');
						  $state.go('home.adverse_calls');
                        }
                        else if (payload.response == $rootScope.failedata) {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }
        else if ($scope.gen_call.complaint == $scope.nature_of_calls[1])
        {
            if ($scope.gen_call.type == $scope.transfers[0])
            {
                $scope.tranferWithinUnit($scope.gen_call, $scope.gen_call.type);
            }
            else if ($scope.gen_call.type == $scope.transfers[1])
            {
                $scope.OtherUnitRequest($scope.gen_call, $scope.gen_call.type);
            }
        }
        else if ($scope.gen_call.complaint == $scope.nature_of_calls[3])
        {
            $scope.addCondmenationRequest($scope.gen_call);
        }
    };
    $scope.ChangeMyDetails = function (my_data) {
        $log.log(my_data);
        my_data.action = "update_my_details";
        $log.debug(my_data);
        baseFactory.baseCall(my_data)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        var now = new Date();
                        exp = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1);
                        $cookies.put('user_name', my_data.USER_NAME, {expires: exp});
                        $cookies.put('user_email_id', my_data.EMAIL_ID, {expires: exp});
                        $cookies.put('user_mobile_no', my_data.MOBILE_NO, {expires: exp});
                        $scope.user_name = $cookies.get('user_name');
                        $scope.user_email_id = $cookies.get('user_email_id');
                        $scope.user_mobile_no = $cookies.get('user_mobile_no');
                        $scope.cancel();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.updatepswrd = {};
    $scope.updateMyPassword = function (updatepswrd) {
        $log.log(updatepswrd);
        updatepswrd.action = "update_my_password";
        $log.debug(updatepswrd);
        baseFactory.baseCall(updatepswrd)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $state.go("home.hbbme_today_calls");
                        $scope.cancel();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getEqContract = function () {
        if (typeof $scope.searched === "object" && $scope.searched.EID != null) {
            var data = {};
            data.eid = $scope.searched.EID.E_ID;
            data.action = "get_equp_contracts";
            baseFactory.deviceCall(data)
                .then(function (payload) {
                        $log.debug(payload);
                        if (payload.response == $rootScope.successdata) {
                            $scope.device_contracts = angular.fromJson(payload.list);
                        }
                        else if (payload.response == $rootScope.emptydata) {
                            $scope.device_contracts = null;
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }
    };
    /* Transver*/
    $scope.OtherUnitRequest = function (other_request, unit_type)
    {
        $scope.other_request = other_request;
        $scope.other_request.reasons = other_request.generationremarks;
        $scope.other_request.unit_type = unit_type;
        $scope.other_request.action = "other_unit_request";
        $log.log("gen call");
        $log.log(JSON.stringify($scope.other_request));
       // return false;

        baseFactory.UserCtrl($scope.other_request)
        .then(function (payload)
        {
            $log.log(payload);
            if (payload.response == $rootScope.successdata)
            {
                $scope.toast_text = payload.call_back;
                $scope.mdDialogHide();
                $scope.showToast();
                if(!$scope.isEmpty($scope.cms_and_gatepass))
                {
                    var submit_gate_pass = $scope.cms_and_gatepass;
                    submit_gate_pass[0].gtype = other_request.ttype;
                    submit_gate_pass[0].critical_spare = other_request.critical_spare;
                    submit_gate_pass[0].to_whom = other_request.from_eq_transfer_unit;
                    submit_gate_pass[0].spars_cnt = other_request.spars_cnt;
                    submit_gate_pass[0].accessories_cnt = other_request.accessories_cnt;
                    submit_gate_pass[0].accessories = other_request.accessories;
                    submit_gate_pass[0].expert_return = other_request.expect_return;
                    submit_gate_pass[0].phy_location = other_request.sphy_location;

                    var send= {data:submit_gate_pass,action:"add_gate_pass_list"};
                    $log.log(JSON.stringify(send));
                    $log.log("cms_and_gatepass123##");
                    //$log.debug(send);
                    baseFactory.UserCtrl(send)
                    .then(function (payload)
                    {
                        $log.error(payload);
                        if (payload.response == $rootScope.successdata)
                        {
                            $scope.other_request = {};
                            $scope.gen_call = {};
                            $scope.cms_and_gatepass = [];

                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                        }
                        else if (payload.response == $rootScope.failedata)
                        {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
                }
                $state.go("home.transfer_calls");
            }
            else if (payload.response == $rootScope.failedata)
            {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.tranferWithinUnit = function (reasons, unit_type) {
        reasons.action = "transfer_with_in_unit";
        reasons.departments = reasons.dept_id;
        reasons.equp_id = reasons.device_id;
        reasons.reasons = reasons.generationremarks;
        reasons.equp_name = reasons.sequp_name;
        reasons.unit_type = unit_type;
        console.clear();
        $log.info(JSON.stringify(reasons));
        //return false;

        baseFactory.UserCtrl(reasons)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go("home.transfer");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.allCompletedTransfers = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var lv;
            if (typeof limit_val === 'undefined')
                lv = 0;
            else if (limit_val == 0)
                lv = 0;
            else
                lv = limit_val - 1;
            $scope.compelted_transfers_search.limit_val = lv;
        }
        else {
            delete $scope.compelted_transfers_search.limit_val;
        }
        $scope.compelted_transfers_search.branch_id = $scope.user_branch;

        $scope.compelted_transfers_search.action = "all_completed_transfers_search";
        baseFactory.UserCtrl($scope.compelted_transfers_search)
            .then(function (payload) {
                    $log.log("all_completed_transfers_search_res");
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.ctrnsfers = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.ctrnsfers = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadOtherUnitApproval = function () /* For approval */ {
        var send = {action: "get_transfer_Approval_list"};
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.Other_unit_approvals = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.Other_unit_approvals = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.OtherUnitApprovedBySuperAdmin = function (ev, aprroval)
    {
        var template_name = 'user/edit_transfer_approval_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {aprroval: aprroval},
            controller: _otherunitApproval
        }).then(function () {
            },
            function () {
            });
    };

    function _otherunitApproval($scope, aprroval)
    {
        $scope.loadDepartments();
        $scope.atransfer_status = aprroval.TRANSFER_STATUS;
        $scope.edit_transfer_approval = aprroval;
        $scope.edit_transfer_approval.username = aprroval.username;
    }

    $scope.editTransfersRequest = function (ev, transfers_requ)
    {
        var template_name = 'user/edit_transfer_request_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {transfers_requ: transfers_requ},
            controller: _EditTransferRequest
        }).then(function(){},
            function(){});
    };

    function _EditTransferRequest($scope, transfers_requ) {
        $scope.loadAllDepartments();
        $scope.loadBranches();
        $log.log("editTransfersRequest");
        $log.log(transfers_requ);
        $scope.edit_within_unit = $scope.edit_other_request = transfers_requ;
        $scope.edit_within_unit.department = transfers_requ.DEPT_ID;
        $scope.edit_within_unit.equp_id = transfers_requ.EQUP_ID;
        $scope.edit_within_unit.plocation = transfers_requ.PHYSICAL_LOCATION;
        $scope.edit_within_unit.newdepts = transfers_requ.TRANSFER_DEPT;
        $scope.edit_within_unit.reasons = transfers_requ.REASON;
		$scope.edit_within_unit.equp_name = transfers_requ.E_NAME;
        $scope.edit_other_request.equp_name = transfers_requ.E_NAME;
		$scope.edit_other_request.equp_model = transfers_requ.emodel;
		$scope.edit_within_unit.equp_model = transfers_requ.emodel;
		$scope.edit_within_unit.srial_no = transfers_requ.serial_no;
		$scope.edit_other_request.srial_no = transfers_requ.serial_no;
        $scope.edit_other_request.departments = transfers_requ.DEPT_ID;
		$scope.edit_within_unit.pono = transfers_requ.pono;
		$scope.edit_within_unit.ctype = transfers_requ.ctype;
        $scope.edit_other_request.plocation = transfers_requ.PHYSICAL_LOCATION;
        $scope.edit_other_request.reasons = transfers_requ.REASON;
        if($scope.edit_other_request.EXPECTED_RETURN!=null)
        {
            $scope.edit_other_request.expected_return = new Date($scope.edit_other_request.EXPECTED_RETURN);
        }
        else
        {
            $scope.edit_other_request.expected_return = null;
        }
        $scope.edit_other_request.ttype = transfers_requ.TRANSFER_TYPE;
    }
 
  $scope.transferdeploy = function (ev,transfers_depl)
    {
        var template_name = 'user/transfer_deploy_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {transfers_depl: transfers_depl},
            controller: _Transferdeploy
        }).then(function(){},
            function(){});
    };

    function _Transferdeploy($scope, transfers_depl) {
        $scope.loadAllDepartments();
        $scope.loadBranches();
        $log.log("transfers_depl");
        $log.log(transfers_depl);
        $scope.transfer_deploy = $scope.transfer_deploy = transfers_depl;
        $scope.transfer_deploy.departments = transfers_depl.DEPT_ID;
        $scope.transfer_deploy.equp_id = transfers_depl.EQUP_ID;
        $scope.transfer_deploy.plocation = transfers_depl.PHYSICAL_LOCATION;
        $scope.transfer_deploy.newdepts = transfers_depl.TRANSFER_DEPT;
        $scope.transfer_deploy.reasons = transfers_depl.REASON;
		$scope.transfer_deploy.srial_no = transfers_depl.serial_no;
        $scope.transfer_deploy.equp_name = transfers_depl.E_NAME;
		//$scope.transfer_deploy.
        $scope.transfer_deploy.departments = transfers_depl.DEPT_ID;
        $scope.transfer_deploy.plocation = transfers_depl.PHYSICAL_LOCATION;
        $scope.transfer_deploy.reasons = transfers_depl.REASON;
        if($scope.transfer_deploy.EXPECTED_RETURN!=null)
        {
            $scope.transfer_deploy.expected_return = new Date($scope.transfer_deploy.EXPECTED_RETURN);
        }
        else
        {
            $scope.transfer_deploy.expected_return = null;
        }
        $scope.transfer_deploy.ttype = transfers_depl.TRANSFER_TYPE;
    }


 
 
 
 
    $scope.UpdateApprovalList = function (data, atransfer_status)
    {
        var user_id=$cookies.get('user_id');
        var user_erole_code = $cookies.get('user_erole_code');
        var appr={user_id:user_id,role:user_erole_code};
        if(data.approved_by==null)
        {
            data.approved_by=[appr];
        }
        else
        {
            data.approved_by.push(appr);
        }
        data.atransfer_status = atransfer_status;
        data.action = "update_otherunit_approval_list";
        //$log.debug(data);
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.showToastText(payload.call_back);
                        $scope.hide();
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.showToastText(payload.call_back);
						$scope.mdDialogHide();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.UpdateDisApprovalList = function (update_approval, atransfer_status) {
        update_approval.atransfer_status = atransfer_status;
        update_approval.action = "update_otherunit_disapproval_list";
        //$log.debug(update_approval);
        baseFactory.UserCtrl(update_approval)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.showToastText(payload.call_back);
                        $scope.hide();
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadOtherUnitTransfer = function () /* For approval */ {
        var send = {action: "get_otherunit_tansfer_list"};
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.Other_unit_transfers = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.Other_unit_transfers = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.getEquipmentsbyName = function(e_name)
    {
        var data = {};
        data.eq_cat = e_name;
        data.action= "get_same_equps_cat";
        $log.warn(data);
        $log.log(JSON.stringify(data));
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.warn(payload);
                    if (payload.response == $rootScope.successdata)
                    {
                        $scope.get_same_equps_cats = payload.list;
                    }
                    else if (payload.response == $rootScope.emptydata)
                    {
                        $scope.get_same_equps_cats = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.OtherUnitTransfer = function (ev, trnsfer) {
        var template_name = 'user/edit_otherunit_transfer_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {trnsfer: trnsfer},
            controller: _otherunitTransfer
        }).then(function () {
            },
            function () {
            });
    };

    function _otherunitTransfer($scope, trnsfer)
    {
        //$scope.loadDepartments();
        //$scope.loadBranches();
        $scope.edit_transfer = trnsfer;
        $scope.getEquipmentsbyName(trnsfer.E_NAME);
    }

    $scope.UpdateOtherunitTransferList = function (update_transfer) {
        update_transfer.action = "update_otherunit_trnsfer_list";
        //$log.debug(update_transfer);
        baseFactory.UserCtrl(update_transfer)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.showToastText(payload.call_back);
                        $scope.hide();
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadTransferUnits = function (limit_val, get_admin_calls) /* For transfer */ {
        $scope.transfer_search.branch_id = $scope.user_branch;
        $log.warn("Branch:" + $scope.user_branch);
        if (limit_val != $scope.nostate) {
            var transfers;
            if (typeof limit_val === 'undefined')
                transfers = 0;
            else if (limit_val == 0)
                transfers = 0;
            else
                transfers = limit_val - 1;
            $log.error(transfers);
            $scope.transfer_search.limit_val = transfers;
        }
        else {
            delete $scope.transfer_search.limit_val;
        }
        $scope.transfer_search.action = "get_tansfer_list";
        if (typeof get_admin_calls != "undefined") {
            if (get_admin_calls == "get_admin_calls" || get_admin_calls == "get_hod_calls")
                $scope.transfer_search.aaction = get_admin_calls;
            else if (get_admin_calls == "get_assigned_calls")
                $scope.transfer_search.aaction =get_admin_calls;
            else {
                delete $scope.transfer_search.aaction;
            }
        }
        else {
            delete $scope.transfer_search.aaction;
        }
        $log.log("Transfer Req.");
        $log.log(JSON.stringify($scope.transfer_search));
	
        baseFactory.UserCtrl($scope.transfer_search)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.pending_trnsfers = $scope.trnsfers = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.pending_trnsfers = $scope.trnsfers = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.transfercall_search = {};
    $scope.getOtherunitUnitTransferCalls = function (limit_val, get_admin_calls) /* For transfer */
    {

            $scope.transfercall_search.branch_id = $scope.user_branch;
        if (limit_val != $scope.nostate) {
            var transfers;
            if (typeof limit_val === 'undefined')
                transfers = 0;
            else if (limit_val == 0)
                transfers = 0;
            else
                transfers = limit_val - 1;
            $log.error(transfers);
            $scope.transfercall_search.limit_val = transfers;
        }
        else {
            delete $scope.transfercall_search.limit_val;
        }
        $scope.transfercall_search.action = "get_otherunit_unit_transfer_calls";
        if (typeof get_admin_calls != "undefined")
        {
            if (get_admin_calls == "get_admin_calls" || get_admin_calls == "get_hod_calls")
                $scope.transfercall_search.aaction = get_admin_calls;
            else
                delete $scope.transfercall_search.aaction;
        }
        else {
            delete $scope.transfercall_search.aaction;
        }
        $log.log("Transfer Reqs");
        $log.log($scope.transfercall_search);
        baseFactory.UserCtrl($scope.transfercall_search)
            .then(function (payload) {
                    $log.debug("pending_trnsfers");
                    console.log(payload);
                    if (payload.response == $rootScope.successdata)
                    {
                        $scope.pending_trnsfers = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata)
                    {
                        $scope.pending_trnsfers = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.UudateTransferRequest = function (update_approval, etransfer_status)
    {
        update_approval.etransfer_status = etransfer_status;
        update_approval.action = "update_transfer_within_requ_list";
        //$log.debug(update_approval);
        baseFactory.UserCtrl(update_approval)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.showToastText(payload.call_back);
                        //$log.log($cookies.get('user_branch'));
                        //$scope.getBranchUsers($scope.gbbranchid);
                        $scope.loadTransferUnits();
                        $scope.hide();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.UpdateOtherUnitRequest = function (update_otherrequ, etransfer_status)
    {
        update_otherrequ.etransfer_status = etransfer_status;
        update_otherrequ.action = "update_transfer_other_requ_list";
        baseFactory.UserCtrl(update_otherrequ)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.showToastText(payload.call_back);
                        //$log.log($cookies.get('user_branch'));
                        //$scope.getBranchUsers($scope.gbbranchid);
                        $scope.loadTransferUnits();
                        $scope.hide();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.TransferDeployee = function (tdata) {
        $log.log("Deploy Device Details");
        $log.warn(tdata);
        //return false;
        var data = {};
        data.esid = tdata.EQUP_ID;
        data.trbranch_code = tdata.tbranch_code;
        //data.dept_id = tdata.DEPT_ID;
        data.action = "search_by_equp_eid";
        $log.error(data);
        baseFactory.deviceCall(data)
            .then(function (payload) {

                    /*$log.log(payload);
                     if(payload.response==$rootScope.successdata)
                     {
                     $scope.transfer_deploy_device = angular.fromJson(payload.list);
                     $scope.transfer_deploy_device.transfer_dept = tdata.TRANSFER_DEPT;
                     $scope.transfer_deploy_device.transfer_branch = tdata.TRANSFER_BRANCH;
                     $state.go("home.transfer_save_and_deploy");
                     }
                     else if(payload.response==$rootScope.failedata)
                     {
                     $scope.transfer_deploy_device = null;
                     }*/
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.transferDeployDevice = function (transfer_deploy_device)
    {
        transfer_deploy_device.action = "transfer_device_deployment";
        $log.log(JSON.stringify(transfer_deploy_device));
	//return false;
        baseFactory.deviceCall(transfer_deploy_device)
            .then(function (payload) {
                console.clear();
                    $log.warn("transfer_device_deployment");
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        //var esearch = {};
                        //esearch.eqpid = payload.tid;
                        //$scope.equpSearch(esearch);
                        //$state.go("home." + $scope.user_role_code.toLowerCase() + "_search");
                        $scope.dept_device_search = {
                            eqpid: payload.tid,
                            dept_id: "",
                            branch_id: $cookies.get('user_branch'),
                            spono: "",
                            saccessoriesno: ""
                        };
                        $state.go("home.view_devies");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    /* Transfer end */

    /*Condemnation*/

    $scope.loadCondmnReasonsList = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var econreasons;
            if (typeof limit_val === 'undefined')
                econreasons = 0;
            else if (limit_val == 0)
                econreasons = 0;
            else
                econreasons = limit_val - 1;
            $log.error(econreasons);
            var send = {limit_val: econreasons, action: "get_conreasons_list"};
        }
        else {
            var send = {action: "get_conreasons_list"};
        }

        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.conreasons = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.conreasons = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }
    $scope.addCondmenationReasons = function (depts) {
        depts.action = "add_condemnation_reasons";
        baseFactory.UserCtrl(depts)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.loadCondmnReasonsList();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }
    $scope.editCondmnReasons = function (ev, conreason) {
        var template_name = 'user/edit_con_reasons_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {conreason: conreason},
            controller: _eCondmnationReasons
        }).then(function () {
            },
            function () {
            });
    };
    function _eCondmnationReasons($scope, conreason) {
        $log.log(conreason);
        $scope.edit_cond_reasons = conreason;
        $scope.edit_cond_reasons.reasons = conreason.REQUEST_NAME;
        $scope.edit_cond_reasons.code = conreason.CODE;
        $scope.edit_cond_reasons.status = conreason.STATUS;
    }

    $scope.UpdateConReasons = function (condreasons) {
        condreasons.action = "update_cond_reasons";
        baseFactory.UserCtrl(condreasons)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadCondmnReasonsList();

                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadCondemenationRequest = function (limit_val, get_admin_calls ) /* For Contracts */ {

        $scope.condimnation_search.branch_id = $scope.user_branch;

        if (limit_val != $scope.nostate) {
            var conreq;
            if (typeof limit_val === 'undefined')
                conreq = 0;
            else if (limit_val == 0)
                conreq = 0;
            else
                conreq = limit_val - 1;
            $log.error(conreq);
            $scope.condimnation_search.limit_val = conreq;
        }
        else {
            delete $scope.condimnation_search.limit_val;
        }
        $scope.condimnation_search.action = "get_conrequest_list";
        if (typeof get_admin_calls != "undefined") {
            if (get_admin_calls == "get_admin_calls" || get_admin_calls == "get_hod_calls")
                $scope.condimnation_search.aaction = get_admin_calls;
            else if (get_admin_calls == "get_assigned_calls")
                $scope.condimnation_search.aaction = get_admin_calls;
            else {
                delete $scope.condimnation_search.aaction;
            }
        }
        else {
            delete $scope.condimnation_search.aaction;
        }
        $log.debug("get_conrequest_list");
        $log.debug($scope.condimnation_search);
        console.log($scope.condimnation_search);
        baseFactory.UserCtrl($scope.condimnation_search)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.condeminations = angular.fromJson(payload.list);
                        $scope.condem_approvals_count = payload.condem_approvals_count;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.condeminations = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadCompletedCondemenationRequest = function (limit_val, get_admin_calls) /* For Contracts */ {
		
	  $scope.condimnation_search.branch_id = $scope.user_branch;
        if (limit_val != $scope.nostate) {
            var conreq;
            if (typeof limit_val === 'undefined')
                conreq = 0;
            else if (limit_val == 0)
                conreq = 0;
            else
                conreq = limit_val - 1;
            $log.error(conreq);
            $scope.condimnation_search.limit_val = conreq;
        }
        else {
            delete $scope.condimnation_search.limit_val;
        }
		
        $scope.condimnation_search.action = "get_completed_condemnations_search";
        if (typeof get_admin_calls != "undefined") {
            if (get_admin_calls == "get_admin_calls" || get_admin_calls == "get_hod_calls")
                $scope.condimnation_search.aaction = get_admin_calls;
            else {
                delete $scope.condimnation_search.aaction;
            }
        }
        else {
            delete $scope.condimnation_search.aaction;
        }
        $log.debug("get_completed_condemnations_search");
        $log.debug($scope.condimnation_search);
        baseFactory.UserCtrl($scope.condimnation_search)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cm_condeminations = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cm_condeminations = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addCondmenationRequest = function (conreq) {
        conreq.departments = conreq.dept_id;
        conreq.reasons = conreq.condem_reasons;
        conreq.feedback = conreq.generationremarks;
        conreq.equp_id = conreq.device_id;
        conreq.action = "add_condemnation_requests";
        $log.log(conreq.action);
        $log.log(JSON.stringify(conreq));
        baseFactory.UserCtrl(conreq)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $state.go('home.' + angular.lowercase($scope.user_role_code) + '_today_calls');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    /* approve condemnation */
    $scope.EditAdminCondemination = function (ev, approved) {
        $scope.loadReusableParts();
        $scope.loadDepartments();
        $scope.loadCondmnReasonsList();
        var template_name = 'user/edit_condemnation_aprroved_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {approved: approved},
            controller: _eCondmnationApproved
        }).then(function () {
            },
            function () {
            });
    };
    function _eCondmnationApproved($scope, approved)
    {
        $scope.edit_cond_approval = approved;
        $scope.edit_cond_approval.departments = approved.DEPT_ID;
        $scope.edit_cond_approval.equp_id = approved.EQUP_ID;
        if(approved.REASONS != null)
        {
            $scope.edit_cond_approval.reasons = approved.REASONS.split(',');
        }
        else
        {
            $scope.edit_cond_approval.reasons = null;
        }
        $scope.edit_cond_approval.feedback = approved.FEEDBACK;
        $scope.edit_cond_approval.approved_by = approved.APPROVED_BY!=null ? angular.fromJson(approved.APPROVED_BY) : approved.APPROVED_BY;
    }

    $scope.UpdateAdminApprovals = function (condapproval, acondemnation_status)
    {
        condapproval.acondemnation_status = acondemnation_status;
        condapproval.action = "update_cond_approval_list";
        var user_id=$cookies.get('user_id');
        var user_erole_code = $cookies.get('user_erole_code');
        var appr={user_id:user_id,role:user_erole_code};
        if(condapproval.approved_by==null)
        {
            condapproval.approved_by=[appr];
        }
        else
        {
            condapproval.approved_by.push(appr);
        }
        $log.log("condapproval Update Admin Approvals");
        $log.log(condapproval);
        baseFactory.UserCtrl(condapproval)
        .then(function (payload)
        {
            $log.log(payload);
            if (payload.response == $rootScope.successdata)
            {
                $scope.toast_text = payload.call_back;
                $scope.mdDialogHide();
                $scope.showToast();
                $state.forceReload();
            }
            else if (payload.response == $rootScope.failedata)
            {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.UpdateAdminDisapprovals = function (conddisapproval, acondemnation_status) {

        conddisapproval.acondemnation_status = acondemnation_status;
        conddisapproval.action = "update_cond_disapproval_list";
        baseFactory.UserCtrl(conddisapproval)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadCondemenationRequest();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.EditApprovedCondemnation = function (ev, eapproved)
    {
        $scope.loadReusableParts();
        $scope.loadDepartments();
        var template_name = 'user/edit_condemnation_admin_aprroved_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {eapproved: eapproved},
            controller: _eCondmnationApproveddialog
        }).then(function () {
            },
            function () {
            });
    };
    function _eCondmnationApproveddialog($scope, eapproved) {
        $log.log(eapproved);
        $scope.approved_condmnation = eapproved;
        $scope.approved_condmnation.departments = eapproved.DEPT_ID;
		$scope.approved_condmnation.departments = eapproved.department;
        $scope.approved_condmnation.equp_id = eapproved.EQUP_ID;
        $scope.approved_condmnation.approved_by = eapproved.APPROVED_BY;
    }


    $scope.UpdateApprovedbmeCondemnation = function (data) {
		console.log("UpdateApprovedbmeCondemnation");
		console.log(data.approved_by);
		data.approved_by = angular.fromJson(data.approved_by);
        var user_id=$cookies.get('user_id');
        var user_erole_code = $cookies.get('user_erole_code');
        var appr={user_id:user_id,role:user_erole_code};
        if(data.approved_by==null || data.approved_by==undefined)
        {
            data.approved_by=[appr];
        }
        else
        {
            data.approved_by.push(appr);
        }
        data.action = "update_approved_condemnation_list";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadCondemenationRequest();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.EditCondeminationRequest = function (ev, econrequest) {
        $scope.loadDepartments();
        $scope.loadCondmnReasonsList();
        $scope.loadReusableParts();
        var template_name = 'user/edit_condemnation_request_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {econrequest: econrequest},
            controller: _eCondmnationRequestdialog
        }).then(function () {
            },
            function () {
            });
    };
    function _eCondmnationRequestdialog($scope, econrequest) {
        $log.log(econrequest);
        $scope.edit_condmnation_req = econrequest;
        $scope.edit_condmnation_req.departments = econrequest.DEPT_ID;
		$scope.edit_condmnation_req.dept = econrequest.departments;
        $scope.edit_condmnation_req.equp_id = econrequest.EQUP_ID;
        $scope.edit_condmnation_req.feedback = econrequest.FEEDBACK;
        $scope.edit_condmnation_req.reasons = econrequest.REASONS.split(',');
    }

    $scope.UpdateCondemnationRequest = function (editcondmenation) {
        editcondmenation.action = "update_condemnation_request_list";
        baseFactory.UserCtrl(editcondmenation)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadCondemenationRequest();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    
    $scope.loadReusableParts = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var reusableparts;
            if (typeof limit_val === 'undefined')
                reusableparts = 0;
            else if (limit_val == 0)
                reusableparts = 0;
            else
                reusableparts = limit_val - 1;
            $log.error(reusableparts);
            var send = {limit_val: reusableparts, action: "get_reusableparts_list"};
        }
        else {
            var send = {action: "get_reusableparts_list"};
        }
        send.branch_id = $scope.user_branch;
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    //$log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.reusable_parts = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.reusable_parts = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }

    $scope.addReusableCode = function (reusablepart) {
        reusablepart.action = "add_reusablepart_requests";
        $log.log(reusablepart);
        baseFactory.UserCtrl(reusablepart)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.loadReusableParts();
                        $state.go('home.condmnation_resold_values');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editReusableparts = function (ev, ereusable) {
        var template_name = 'user/edit_reusablepart_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {ereusable: ereusable},
            controller: _eCondmnationRequestdialog1
        }).then(function () {
            },
            function () {
            });
    };
    function _eCondmnationRequestdialog1($scope, ereusable) {
        $log.log(ereusable);
        $scope.edit_cond_reusableparts = ereusable;
        $scope.edit_cond_reusableparts.reusableparts = ereusable.REUSABLE_PARTS;
        $scope.edit_cond_reusableparts.code = ereusable.CODE;
        $scope.edit_cond_reusableparts.status = ereusable.STATUS;

    }

    $scope.UpdateConReusableparts = function (editreusableparts) {
        editreusableparts.action = "update_reusableparts_list";
        baseFactory.UserCtrl(editreusableparts)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadReusableParts();
                        $state.go('home.condmnation_resold_values');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    /*Condemnation*/

    /* call masters */

    $scope.getCallMasters = function () {
        var data = {action: "get_calls_master"};
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.call_masters = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.call_masters = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getCallReasons = function (call_type) {
        if(call_type==$scope.nature_of_calls[1])
        {
            //$scope.loadEquipmentNames($scope.nostate);
            $scope.getAccessories();
            $scope.getCriticalSpares();
        }
        $scope.gen_call.type = null;
        var data = {};
        data.call_type = call_type;
        data.action = 'get_call_reasons';
        baseFactory.deviceCall(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.call_reasons = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.call_reasons = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    /* call masters end */

    /*Reports*/
    $scope.getAdverseReport = function () /* Show Device Details with QR details */ {
        if ($scope.searched.EID == null)
            $scope.adverse_report_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.adverse_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.adverse_report_search.eqpid = "";
        $scope.adverse_report_search.action = "get_adverse_reports";
        $scope.adverse_report_search.branch_id = $scope.user_branch;
        $log.debug("adverse Reports");
       // $log.debug($scope.adverse_report_search);
        console.log($scope.adverse_report_search);
        baseFactory.reportsCall($scope.adverse_report_search)
            .then(function (payload)
            {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.adverse_reports = angular.fromJson(payload.adversereports);
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.adverse_reports = null;
                }
            });
    };
    $scope.loadAdverseReports = function (eid) {
        var send = {};
        send = {equp_id: eid, action: "get_adverse_reports_data",branch_id:$scope.user_branch};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug("hhhiiiyiigyiygigyi:");
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.view_adverse_reports = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.view_adverse_reports = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.pdfAdverseReport = function (ev, adversereportpdf) {
        //var template_name = 'reports/view_adverse_report_pdf_dialog';
        //$log.log(data);
        var export_html = angular.toJson(adversereportpdf);
        var loc = window.location.pathname;
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/view_adverse_report_pdf';
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'pdf_data';
        child1.value = export_html;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
        /*$mdDialog.show({
         templateUrl: template_name,
         clickOutsideToClose: false,
         scope: $scope,        // use parent scope in template
         preserveScope: true,  // do not forget this if use parent scope
         parent : angular.element(document.body),
         targetEvent: ev,
         locals: {adversereportpdf: adversereportpdf},
         controller: _AdverseReportPdfCtrl
         }).then(function() {},
         function() {})*/
    };

    /*function _AdverseReportPdfCtrl($scope, adversereportpdf)
     {
     $log.log(adversereportpdf);

     var equp_id=adversereportpdf.EQUP_ID;

     $scope.loadAdverseReports(equp_id);

     }*/


    $scope.viewAdverrseReportDetails = function (ev, adverse_reports) {
        var template_name = 'reports/view_adverse_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {adverse_reports: adverse_reports},
            controller: _eViewAdverseReportDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewAdverseReportDetails($scope, adverse_reports) {
        $log.log(adverse_reports);

        var equp_id = adverse_reports.EQUP_ID;			   
		 $scope.getAdverseReport(equp_id);
        //$scope.loadAdverseReports(equp_id);
    }

    $scope.printPdf = function () {
        html2canvas(document.getElementById('exportthis'), {
            onrendered: function (canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500,
                    }]
                };
                /*var docDefinition = {
                 content: [
                 { text: 'This is a header', style: 'header' },
                 'No styling here, this is a standard paragraph',
                 { text: 'Another text', style: 'anotherStyle' },
                 { text: 'Multiple styles applied', style: [ 'header', 'anotherStyle' ] }
                 ],

                 styles: {
                 header: {
                 fontSize: 22,
                 bold: true
                 },
                 anotherStyle: {
                 italics: true,
                 alignment: 'right'
                 }
                 }
                 };*/
                //pdfMake.createPdf(docDefinition).open();
                pdfMake.createPdf(docDefinition).download("Reports.pdf");
            }
        });
    };

    $scope.printTCPDF = function (data) {
        $log.log(data);
        var export_html = angular.toJson($scope.cms_reports);
        var loc = window.location.pathname;
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/create_pdf';
        // var word_data = export_html;
        //var send = {wrd_devices:export_html};
        //console.log(send);
        //var prev_data2=angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'pdf_data';
        child1.value = export_html;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    /*Deployement*/
    $scope.getDeployementReport = function (limit_val) /* Show Device Details with QR details */ {
        if ($scope.searched.EID == null)
            $scope.deployement_report_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.deployement_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.deployement_report_search.eqpid = "";

        if (limit_val != $scope.nostate) {
            var dp_lm;
            if (typeof limit_val === 'undefined')
                dp_lm = 0;
            else if (limit_val == 0)
                dp_lm = 0;
            else
                dp_lm = limit_val - 1;
            $scope.deployement_report_search.limit_val = dp_lm;
        }
        else {
            delete $scope.deployement_report_search.limit_val;
        }
        $scope.deployement_report_search.action = "get_deployment_reports";
        $scope.deployement_report_search.branch_id = $scope.user_branch;
        $log.debug("adverse Reports");
        console.log($scope.deployement_report_search);
        //$log.log(JSON.stringify($scope.deployement_report_search));
        baseFactory.reportsCall($scope.deployement_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.deployemnt_reports = angular.fromJson(payload.deployment_report);

                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.deployemnt_reports = null;
                    $scope.paging.total = 0;
                    $scope.no_of_recs = 0;
                }
            });
    };
    $scope.getReDeployementReport = function (limit_val) /* Show Device Details with QR details */ {
        if ($scope.searched.EID == null)
            $scope.re_deployement_report_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.re_deployement_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.re_deployement_report_search.eqpid = "";

        if (limit_val != $scope.nostate) {
            var dp_lm;
            if (typeof limit_val === 'undefined')
                dp_lm = 0;
            else if (limit_val == 0)
                dp_lm = 0;
            else
                dp_lm = limit_val - 1;
            $scope.re_deployement_report_search.limit_val = dp_lm;
        }
        else {
            delete $scope.re_deployement_report_search.limit_val;
        }
        $scope.re_deployement_report_search.action = "get_redeployment_reports";
        $scope.re_deployement_report_search.branch_id = $scope.user_branch;
        //$log.debug("adverse Reports");
        $log.debug($scope.re_deployement_report_search);
        console.log($scope.re_deployement_report_search);
        baseFactory.graphsCall($scope.re_deployement_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.redeployemnt_reports = angular.fromJson(payload.deployment_report);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.redeployemnt_reports = null;
                    $scope.paging.total = 0;
                    $scope.no_of_recs = 0;
                }
            });
    };
    $scope.loadDeployementReports = function () {
        var send = {};
        send = {action: "get_deployment_reports_pdf"};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.deployemnt_report_pdf = angular.fromJson(payload.list);


                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.deployemnt_report_pdf = null;

                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.pdfDeploymentReport = function (ev, deployment_reports) {
        var template_name = 'reports/view_deployment_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {deployment_reports: deployment_reports},
            controller: _eViewDeploymentReportDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewDeploymentReportDetails($scope, deployment_reports) {
        $log.log(deployment_reports);

        var equp_id = deployment_reports.E_ID;

        $scope.loadDeployementReports(equp_id);
    }

    /*Deployement*/

    $scope.getViabilityReport = function (limit_val) /* Show Device Details with QR details */ {
        if ($scope.searched.EQUP_ID == null)
            $scope.viabilty_report_search.eqpid = "";
        else if (typeof $scope.searched.EQUP_ID === 'object')
            $scope.viabilty_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.viabilty_report_search.eqpid = "";
        if (limit_val != $scope.nostate) {
            var lm;
            if (typeof limit_val === 'undefined')
                lm = 0;
            else if (limit_val == 0)
                lm = 0;
            else
                lm = limit_val - 1;
            $scope.viabilty_report_search.limit_val = lm;
        }
        else {
            delete $scope.viabilty_report_search.limit_val;
        }
        $scope.viabilty_report_search.action = "get_viabilty_reports";
        $log.debug("viabilty Reports");
        $log.debug($scope.viabilty_report_search);
        baseFactory.reportsCall($scope.viabilty_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.viabilty_reports = angular.fromJson(payload.viability);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.viabilty_reports = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };
    $scope.loadViabilityReports = function (eid) {
        var send = {};
        send = {equp_id: eid, action: "get_viabilty_reports_pdf"};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.viabilty_reports_pdf = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.viabilty_reports_pdf = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.pdfViabilityReport = function (ev, viability_reports) {
        var template_name = 'reports/view_viability_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {viability_reports: viability_reports},
            controller: _eViewviabilityReportDetails
        }).then(function () {
        });
    };
    function _eViewviabilityReportDetails($scope, viability_reports) {
        $log.log(viability_reports);

        var equp_id = viability_reports.E_ID;

        $scope.loadViabilityReports(equp_id);
    }

    $scope.pdfReDeploymentReport = function (ev, redeployment_reports) {
        var template_name = 'reports/view_re_deployment_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {redeployment_reports: redeployment_reports},
            controller: _eViewReDeploymentReportDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewReDeploymentReportDetails($scope, redeployment_reports) {
        $log.log(redeployment_reports);

        var equp_id = redeployment_reports.E_ID;

        //$scope.loadDeployementReports(equp_id);
    }

    $scope.loadReDeploymentReports = function (eid) {
        var send = {};
        send = {equp_id: eid, action: "get_redeployment_reports_pdf"};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.redeployment_reports_pdf = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.redeployment_reports_pdf = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.getCondemnationReport = function () /* Show Device Details with QR details */ {
        if ($scope.searched.EID == null)
            $scope.condemnation_report_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.condemnation_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.condemnation_report_search.eqpid = "";
        $scope.condemnation_report_search.action = "get_condemnation_reports";
        $scope.condemnation_report_search.branch_id = $scope.user_branch;
        //$log.debug("condemnation Reports");
        $log.debug($scope.condemnation_report_search);
        console.log($scope.condemnation_report_search);
        baseFactory.reportsCall($scope.condemnation_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.condemination_reports = angular.fromJson(payload.condemnation);
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.condemination_reports = null;
                }
            });
    };
    $scope.loadCondemnationReports = function (eid) {
        send = {equp_id: eid, action: "get_condemnation_reports_pdf"};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.condemnation_reports_pdf = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.condemnation_reports_pdf = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.pdfCondemationReport = function (ev, condemnation_reports) {
        var template_name = 'reports/view_condemnation_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {condemnation_reports: condemnation_reports},
            controller: _eViewCondemnationReportDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewCondemnationReportDetails($scope, condemnation_reports) {
        $log.log(condemnation_reports);

        var equp_id = condemnation_reports.EID;

        $scope.loadCondemnationReports(equp_id);
    }

    $scope.getPMSReport = function (limit_val) /* Show Device Details with QR details */
    {
        if ($scope.searched.EID == null)
            $scope.pms_report_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.pms_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.pms_report_search.eqpid = "";
        if (limit_val != $scope.nostate) {
            var lm;
            if (typeof limit_val === 'undefined')
                lm = 0;
            else if (limit_val == 0)
                lm = 0;
            else
                lm = limit_val - 1;
            $scope.pms_report_search.limit_val = lm;
        }
        else {
            delete $scope.pms_report_search.limit_val;
        }
        $scope.pms_report_search.action = "get_pms_reports";
        $scope.pms_report_search.branch_id = $scope.user_branch;
        $log.debug($scope.pms_report_search);
        baseFactory.reportsCall($scope.pms_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.pms_reports = angular.fromJson(payload.pmsreport);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.pms_reports = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };
    $scope.loadpmsReports = function (eid)
    {
        var send = {};
        send = {equp_id: eid, action: "get_pms_reports_pdf"};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.pms_reports_pdf = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.pms_reports_pdf = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.pdfPMSReport = function (ev, pms_reports) {
        var template_name = 'reports/view_pms_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {pms_reports: pms_reports},
            controller: _eViewPmsReportDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewPmsReportDetails($scope, pms_reports) {
        $log.log(pms_reports);

        var equp_id = pms_reports.EID;

        $scope.loadpmsReports(equp_id);
    }


    $scope.getQCReport = function (limit_val) /* Show Device Details with QR details */ {
        if (limit_val != $scope.nostate) {
            var qc_lim;
            if (typeof limit_val === 'undefined')
                qc_lim = 0;
            else if (limit_val == 0)
                qc_lim = 0;
            else
                qc_lim = limit_val - 1;
            $scope.qc_report_search.limit_val = qc_lim;
        }
        else {
            delete $scope.qc_report_search.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.qc_report_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.qc_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.qc_report_search.eqpid = "";
        $scope.qc_report_search.action = "get_qc_reports";
        $scope.qc_report_search.branch_id = $scope.user_branch;
        //$log.debug("condemnation Reports");
        $log.debug($scope.qc_report_search);
        baseFactory.reportsCall($scope.qc_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.qc_reports = angular.fromJson(payload.qcreport);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.qc_reports = null;
                    $scope.paging.total = 0;
                    $scope.no_of_recs = 0;
                }
            });
    };
    $scope.loadqcReports = function (eid) {
        var send = {};
        send = {equp_id: eid, action: "get_qc_reports_pdf"};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.qc_reports_pdf = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.qc_reports_pdf = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.pdfQCReport = function (ev, qc_reports) {
        var template_name = 'reports/view_qc_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {qc_reports: qc_reports},
            controller: _eViewQCReportDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewQCReportDetails($scope, qc_reports) {
        $log.log(qc_reports);

        var equp_id = qc_reports.EID;

        $scope.loadqcReports(equp_id);
    }

    $scope.getEquipmentReport = function () /* Show Device Details with QR details */ {
        if ($scope.searched.EQUP_ID == null)
            $scope.equp_report_search.eqpid = "";
        else if (typeof $scope.searched.EQUP_ID === 'object')
            $scope.equp_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.equp_report_search.eqpid = "";
        $scope.equp_report_search.action = "get_deployment_reports";
        //$log.debug("adverse Reports");
        $log.debug($scope.equp_report_search);
        baseFactory.reportsCall($scope.equp_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.equp_summary_reports = angular.fromJson(payload.deployment_report);
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.equp_summary_reports = null;
                }
            });
    };
    $scope.loadEqupSummryReports = function () {
        var send = {};
        send = {action: "get_equipment_summary_reports_pdf"};
        send.branch_id = $scope.user_branch;
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(send.action);
                    $log.warn(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equp_reports_pdfs = angular.fromJson(payload.equpment_summary);
                        $scope.equp_reports_pdfs.no_eqp_total = angular.fromJson(payload.no_eqp_total);
                        $scope.equp_reports_pdfs.no_equp_value_total = angular.fromJson(payload.no_equp_value_total);
                        $scope.equp_reports_pdfs.no_contract_total = angular.fromJson(payload.no_contract_total);
                        $scope.equp_reports_pdfs.no_cont_value_total = angular.fromJson(payload.no_cont_value_total);
                        $scope.equp_reports_pdfs.no_valueeq_unser_contract_total = angular.fromJson(payload.no_valueeq_unser_contract_total);
                        $scope.equp_reports_pdfs.number_total = angular.fromJson(payload.number_total);
                        $scope.equp_reports_pdfs.cvalue_total = angular.fromJson(payload.cvalue_total);
                        $scope.equp_reports_pdfs.tvalue_total = angular.fromJson(payload.tvalue_total);
                        $scope.equp_reports_pdfs.ctvalue_total = angular.fromJson(payload.ctvalue_total);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equp_reports_pdfs = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.pdfEquipmentSummaryReport = function (ev, equpment_reports) {
        var template_name = 'reports/view_equipment_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {equpment_reports: equpment_reports},
            controller: _eViewEquipmentSummaryReportDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewEquipmentSummaryReportDetails($scope, equpment_reports) {
        $log.log(equpment_reports);

        var equp_id = equpment_reports.E_ID;

        $scope.loadEqupSummryReports(equp_id);
    }


    $scope.loadCalllogsReports = function (eid) {
        var send = {};
       /* if ($scope.searched.EID == null)
            $scope.calllog_report_search.equp_id = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.calllog_report_search.equp_id = $scope.searched.EID.E_ID;
        else
            $scope.calllog_report_search.equp_id = "";*/
        $scope.calllog_report_search.action = "getPMSReport()";
        $scope.calllog_report_search.branch_id = $scope.user_branch;
        console.log($scope.calllog_report_search);
        baseFactory.reportsCall($scope.calllog_report_search)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.callog_reports_pdfs = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.callog_reports_pdfs = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.loadCMSReports = function () {
        $scope.cms_report_search = {action: "get_cms_reports_pdf"};
        $scope.cms_report_search.branch_id = $scope.user_branch;
        $log.debug($scope.cms_report_search);
        baseFactory.reportsCall($scope.cms_report_search)
            .then(function (payload) {
                    $log.warn($scope.cms_report_search);
                    $log.warn(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cms_reports = angular.fromJson(payload.cms_report);
                        $scope.cms_reports.no_tot_bkdwn_total = angular.fromJson(payload.no_tot_bkdwn_total);
                        $scope.cms_reports.no_tot_pms_total = angular.fromJson(payload.no_tot_bkdwn_total);
                        $scope.cms_reports.no_calls_total = angular.fromJson(payload.no_tot_bkdwn_total);
                        $scope.cms_reports.tot_no_Bbd = angular.fromJson(payload.tot_no_Bbd);
                        $scope.cms_reports.tot_no_Abd = angular.fromJson(payload.tot_no_Abd);
                        $scope.cms_reports.tot_no_Cbd = angular.fromJson(payload.tot_no_Cbd);
                        $scope.cms_reports.tot_no_Wbd = angular.fromJson(payload.tot_no_Wbd);
                        $scope.cms_reports.tot_no_Nbd = angular.fromJson(payload.tot_no_Nbd);
                        $scope.cms_reports.tot_subtotal_bkdwms = angular.fromJson(payload.tot_subtotal_bkdwms);
                        $scope.cms_reports.tot_no_Apms = angular.fromJson(payload.tot_no_Apms);
                        $scope.cms_reports.tot_no_Wpms = angular.fromJson(payload.tot_no_Wpms);
                        $scope.cms_reports.tot_no_Cpms = angular.fromJson(payload.tot_no_Cpms);
                        $scope.cms_reports.tot_no_Bpms = angular.fromJson(payload.tot_no_Bpms);
                        $scope.cms_reports.tot_no_Npms = angular.fromJson(payload.tot_no_Npms);
                        $scope.cms_reports.tot_subtotal_pms = angular.fromJson(payload.tot_subtotal_pms);
                        $scope.cms_reports.total_calls_total = angular.fromJson(payload.total_calls_total);
                        $scope.cms_reports.total_lt_10 = angular.fromJson(payload.total_lt_10);
                        $scope.cms_reports.total_lt_60 = angular.fromJson(payload.total_lt_60);
                        $scope.cms_reports.total_gt_60 = angular.fromJson(payload.total_gt_60);
                        $scope.cms_reports.total_lt_10_pcs = angular.fromJson(payload.total_lt_10_pcs);
                        $scope.cms_reports.total_lt_60_pcs = angular.fromJson(payload.total_lt_60_pcs);
                        $scope.cms_reports.total_lt_1d = angular.fromJson(payload.total_lt_1d);
                        $scope.cms_reports.total_lt_3d = angular.fromJson(payload.total_lt_3d);
                        $scope.cms_reports.total_gt_3d = angular.fromJson(payload.total_gt_3d);
                        $scope.cms_reports.total_lt_1d_pcs = angular.fromJson(payload.total_lt_1d_pcs);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cms_reports = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadMPReports = function()
    {
        var send = {};
        send = {mprsdate: $scope.mprsdate, action: "get_monthly_performance_report_pdf",branch_id:$scope.user_branch};
        $scope.mpr_reports_pdfs = {};
        $log.log(send);
        baseFactory.reportsCall(send)
            .then(function (payload)
            {
                    $log.debug("get_monthly_performance_report_pdf");
                    $log.warn(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata)
                    {
                        $scope.mpr_report_pdf_data = payload;
                        $scope.mpr_reports_pdfs = {};
                        $scope.mpr_reports_pdfs.no_of_B_bkdwns = angular.fromJson(payload.no_of_B_bkdwns);
                        $scope.mpr_reports_pdfs.no_of_C_bkdwns = angular.fromJson(payload.no_of_C_bkdwns);
                        $scope.mpr_reports_pdfs.no_of_N_bkdwns = angular.fromJson(payload.no_of_N_bkdwns);
                        $scope.mpr_reports_pdfs.no_of_W_bkdwns = angular.fromJson(payload.no_of_W_bkdwns);
                        $scope.mpr_reports_pdfs.no_tot_bkdwn_total = angular.fromJson(payload.no_tot_bkdwn_total);
                        $scope.mpr_reports_pdfs.no_tot_pms_total = angular.fromJson(payload.no_tot_pms_total);
                        $scope.mpr_reports_pdfs.no_calls_total = angular.fromJson(payload.no_calls_total);
                        $scope.mpr_reports_pdfs.tot_no_Bbd = angular.fromJson(payload.tot_no_Bbd);
                        $scope.mpr_reports_pdfs.tot_no_Abd = angular.fromJson(payload.tot_no_Abd);
                        $scope.mpr_reports_pdfs.tot_no_Cbd = angular.fromJson(payload.tot_no_Cbd);
                        $scope.mpr_reports_pdfs.tot_no_Wbd = angular.fromJson(payload.tot_no_Wbd);
                        $scope.mpr_reports_pdfs.tot_no_Nbd = angular.fromJson(payload.tot_no_Nbd);
                        $scope.mpr_reports_pdfs.tot_subtotal_bkdwms = angular.fromJson(payload.tot_subtotal_bkdwms);
                        $scope.mpr_reports_pdfs.tot_no_Apms = angular.fromJson(payload.tot_no_Apms);
                        $scope.mpr_reports_pdfs.tot_no_Wpms = angular.fromJson(payload.tot_no_Wpms);
                        $scope.mpr_reports_pdfs.tot_no_Cpms = angular.fromJson(payload.tot_no_Cpms);
                        $scope.mpr_reports_pdfs.tot_no_Bpms = angular.fromJson(payload.tot_no_Bpms);
                        $scope.mpr_reports_pdfs.tot_no_Npms = angular.fromJson(payload.tot_no_Npms);
                        $scope.mpr_reports_pdfs.tot_subtotal_pms = angular.fromJson(payload.tot_subtotal_pms);
                        $scope.mpr_reports_pdfs.total_calls_total = angular.fromJson(payload.total_calls_total);
                        $scope.mpr_reports_pdfs.total_lt_10 = angular.fromJson(payload.total_lt_10);
                        $scope.mpr_reports_pdfs.total_lt_60 = angular.fromJson(payload.total_lt_60);
                        $scope.mpr_reports_pdfs.total_gt_60 = angular.fromJson(payload.total_gt_60);
                        $scope.mpr_reports_pdfs.total_lt_10_pcs = angular.fromJson(payload.total_lt_10_pcs);
                        $scope.mpr_reports_pdfs.total_lt_60_pcs = angular.fromJson(payload.total_lt_60_pcs);
                        $scope.mpr_reports_pdfs.total_lt_1d = angular.fromJson(payload.total_lt_1d);
                        $scope.mpr_reports_pdfs.total_lt_3d = angular.fromJson(payload.total_lt_3d);
                        $scope.mpr_reports_pdfs.total_gt_3d = angular.fromJson(payload.total_gt_3d);
                        $scope.mpr_reports_pdfs.total_lt_1d_pcs = angular.fromJson(payload.total_lt_1d_pcs);
                        $scope.mpr_reports_pdfs.department = payload.department;
                        //$scope.mpr_reports_pdfs.branchname = angular.fromJson(payload.branchname);
                        $scope.cause_codes = angular.fromJson(payload.cause_codes);
                        $scope.mpr_reports_pdfs.cms_count = angular.fromJson(payload.cms_count);
                        $scope.mpr_reports_pdfs.wmcs_count = angular.fromJson(payload.wmcs_count);
                        $scope.mpr_reports_pdfs.bmcs_count = angular.fromJson(payload.bmcs_count);
                        $scope.Assets = angular.fromJson(payload.Assets);
                        $scope.assets_cnt = angular.fromJson(payload.assets_cnt);
                        $scope.qcdone_cost = angular.fromJson(payload.qcdone_cost);
                        $scope.qcdone_cnt = angular.fromJson(payload.qcdone_cnt);
                        $scope.services_cost = angular.fromJson(payload.services_cost);
                        $scope.services_cnt = angular.fromJson(payload.services_cnt);
                        $scope.consubble_cost = angular.fromJson(payload.consubble_cost);
                        $scope.consubble_cnt = angular.fromJson(payload.consubble_cnt);
                        $scope.accessories_cost = angular.fromJson(payload.accessories_cost);
                        $scope.incidents_cost = angular.fromJson(payload.incidents_cost);
                        $scope.incidents_count = angular.fromJson(payload.incidents_count);
                        $scope.grn_cost = angular.fromJson(payload.grn_cost);
                        $scope.grn_count = angular.fromJson(payload.grn_count);
                        $scope.eq_cost = angular.fromJson(payload.eq_cost);
                        $scope.eq_count = angular.fromJson(payload.eq_count);
                        $scope.accessories_cnt = angular.fromJson(payload.accessories_cnt);
                        $scope.condem_cost = angular.fromJson(payload.condem_cost);
                        $scope.condem_count = angular.fromJson(payload.condem_count);
                        $scope.astotalcount = angular.fromJson(payload.astotalcount);
                        $scope.astotalcost = angular.fromJson(payload.astotalcost);
                        $scope.spares_cost = angular.fromJson(payload.spares_cost);
                        $scope.spares_cnt = angular.fromJson(payload.spares_cnt);
                        $scope.tlc_cost = angular.fromJson(payload.tlc_cost);
                        $scope.tlc_count = angular.fromJson(payload.tlc_count);
                        $scope.exc_sum = angular.fromJson(payload.exc_sum);
                        $scope.exw_sum = angular.fromJson(payload.exw_sum);
                        $scope.exc_count = angular.fromJson(payload.exc_count);
                        $scope.exw_count = angular.fromJson(payload.exw_count);
                        $scope.cesr_sum = angular.fromJson(payload.cesr_sum);
                        $scope.cesr_count = angular.fromJson(payload.cesr_count);
                        $scope.wcnd_sum = angular.fromJson(payload.wcnd_sum);
                        $scope.wcnd_count = angular.fromJson(payload.wcnd_count);
                        $scope.crnd_sum = angular.fromJson(payload.crnd_sum);
                        $scope.cir_count = angular.fromJson(payload.cir_count);
                        $scope.cir_sum = angular.fromJson(payload.cir_sum);
                        $scope.crnd_count = angular.fromJson(payload.crnd_count);
                        $scope.wesr_sum = angular.fromJson(payload.wesr_sum);
                        $scope.wesr_count = angular.fromJson(payload.wesr_count);
                        $scope.crlm_sum = angular.fromJson(payload.crlm_sum);
                        $scope.crlm_count = angular.fromJson(payload.crlm_count);
                        $scope.crp_sum = angular.fromJson(payload.crp_sum);
                        $scope.crp_count = angular.fromJson(payload.crp_count);
                        $scope.eccm_sum = angular.fromJson(payload.eccm_sum);
                        $scope.eccm_count = angular.fromJson(payload.eccm_count);
                        $scope.ewcm_sum = angular.fromJson(payload.ewcm_sum);
                        $scope.ewcm_count = angular.fromJson(payload.ewcm_count);
                        $scope.tcrp_sum = angular.fromJson(payload.tcrp_sum);
                        $scope.tcrp_count = angular.fromJson(payload.tcrp_count);
                        $scope.user_calls = angular.fromJson(payload.calls);
                        $scope.cost = angular.fromJson(payload.cost);
                        $scope.count = angular.fromJson(payload.count);
                        $scope.total_count_eqps = angular.fromJson(payload.total_count_eqps);
                        $scope.total_cost_eqps = angular.fromJson(payload.total_cost_eqps);
                        //$scope.due_dt = angular.fromJson(payload.due_dt);
                        //$scope.dn_dt = angular.fromJson(payload.dn_dt);
                        $scope.total_count_eqps = angular.fromJson(payload.total_count_eqps);
                        $scope.mpr_reports_pdfs.no_of_Instals_count = angular.fromJson(payload.no_of_Instals_count);
                        $scope.mpr_reports_pdfs.total_amcs_count = angular.fromJson(payload.total_amcs_count);
                        $scope.mpr_reports_pdfs = $scope.mpr_report_pdf_data;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.mpr_reports_pdfs = null;
                        $scope.mpr_report_pdf_data = [];
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadServices = function (eid) {
        var send = {};
        send = {equp_id: eid, action: "get_service_reports_pdf"};
        $log.log(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.service_report_pdf = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.service_report_pdf = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.pdfServicesReport = function (ev, service_report) {
        var template_name = 'reports/view_services_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {service_report: service_report},
            controller: _eViewServicesReportDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewServicesReportDetails($scope, service_report) {
        $log.log(service_report);

        var equp_id = service_report.E_ID;
        $scope.loadServices(equp_id);
    }

    $scope.loadIncidentsElements = function (limit_val) /* For Contracts */
    {
        if (limit_val != $scope.nostate)
        {
            var indent_equp;
            if (typeof limit_val === 'undefined')
                indent_equp = 0;
            else if (limit_val == 0)
                indent_equp = 0;
            else
                indent_equp = limit_val - 1;
           // $scope.indent_elements.limit_val = indent_equp;

		var send = {limit_val: indent_equp, action: "get_indent_equpiment_list",branch_id:$scope.user_branch};
        }
        else {
            var send = {action: "get_indent_equpiment_list",branch_id:$scope.user_branch};
        }
       // $scope.indent_elements.action= "get_indent_equpiment_list";
      //  $scope.indent_elements.branch_id = $scope.user_branch;
      //  $log.error($scope.indent_elements);
        baseFactory.UserCtrl(send)
            .then(function (payload)
            {
                    $log.debug("get_indent_equpiment_list");
                    $log.info(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata)
                    {
                        $log.debug("get_indent_equpiment_list");
                        $scope.indent_equps = angular.fromJson(payload.list);
                        $scope.indent_approvals_count = payload.adverse_approvals_count;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata)
                    {
                        $scope.indent_equps = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addIndentEquipment = function (itype, aindent_request) {
		console.log(itype);
        itype.aindent_request = aindent_request;
        itype.action = "add_indent_equipment";
        baseFactory.UserCtrl(itype)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $state.go("home.indent_equipment");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.editIndentEqupment = function (ev, indent_equp) {

        var template_name = 'user/edit_indent_equp_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {indent_equp: indent_equp},
            controller: _eIndentEqupment
        }).then(function () {
            },
            function () {
            });
    };
    function _eIndentEqupment($scope, indent_equp) {
        $scope.edit_indent_equipment = indent_equp;
        $scope.loadDepartments();
        $scope.getEqupCategories();
        $scope.getSupportVendors();
        $scope.getSupportVendors();
        $scope.getAccessories();
        $scope.getCriticalSpares();
        $scope.getEqupOEMS();
        $scope.getContractVendorDetails(indent_equp.VENDOR_ID);
		$scope.edit_indent_equipment.DEPT_NAME =  indent_equp.department_name;
        $scope.edit_indent_equipment.CAT_NAME =  indent_equp.category_name;
        $scope.edit_indent_equipment.CMP_NAME =  indent_equp.company_name;
        $scope.edit_indent_equipment.VENDOR_NAME =  indent_equp.vendor_name;
		$scope.edit_indent_equipment.branch_id = indent_equp.BRANCH_ID;
        $scope.edit_indent_equipment.departments = indent_equp.DEPT;
        $scope.edit_indent_equipment.critical_spare = indent_equp.SPARES;
        $scope.edit_indent_equipment.accessories = indent_equp.ACCESSORIES;
        $scope.edit_indent_equipment.equp_name = indent_equp.EQ_NAME;
        $scope.aindent_request = indent_equp.INDENT_TYPE;
        $scope.edit_indent_equipment.quantity = indent_equp.QTY;
        $scope.edit_indent_equipment.company_name = indent_equp.MAKE_ID;
        $scope.edit_indent_equipment.category_name = indent_equp.EQ_CAT;
        $scope.edit_indent_equipment.desc = indent_equp.DESCRP;
        $scope.edit_indent_equipment.essential_feature = indent_equp.ESNTL_FEATURES;
        $scope.edit_indent_equipment.desirous_features = indent_equp.OPTIMAL_FEATURES;
        $scope.edit_indent_equipment.luxrious_features = indent_equp.OPTIONAL_FEATURES;
        $scope.edit_indent_equipment.stard_access = indent_equp.STNRD_ACCESSORIES;
        $scope.edit_indent_equipment.optional_access = indent_equp.OPTIONAL_ACCESSORIES;
        $scope.edit_indent_equipment.vendor = indent_equp.VENDOR_ID;
        $scope.edit_indent_equipment.estimated_cost = indent_equp.ESTIMATED_COST;
        $scope.edit_indent_equipment.app_revenu_gen = indent_equp.REVENEW_GENERATION;
        $scope.edit_indent_equipment.benfits_desirous_features = indent_equp.DESIROUS_REVENEW;
        $scope.edit_indent_equipment.benfit_luxurious_feature = indent_equp.LUXURY_REVENEW;
        $scope.edit_indent_equipment.budget_refrence = indent_equp.BUDGET_REFF;
        $scope.edit_indent_equipment.budget_approved_by = indent_equp.BUDGET_APPROVED_DATETIME;
        $scope.edit_indent_equipment.biomedical_receipt_date = indent_equp.BME_RECEIPT_DATE;
        $scope.edit_indent_equipment.quotes_called = indent_equp.QUOTES;
        $scope.edit_indent_equipment.evalution_period = indent_equp.EVALUATION_PEROID;
        $scope.edit_indent_equipment.po_date = indent_equp.PO_DATE;
        $scope.edit_indent_equipment.reasons = indent_equp.REASONS;
        $scope.edit_indent_equipment.remarks = indent_equp.REMARKS;
    }

    $scope.updateIndentEquipment = function (data, aindent_request) {
        data.aindent_request = aindent_request;
        data.action = "update_indent_equp";
		console.log(JSON.stringify(data));
        baseFactory.UserCtrl(data)
            .then(function (payload) {
				console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadIncidentsElements();
                        $state.go("home.indent_equipment");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadCear = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var cear_cnts;
            if (typeof limit_val === 'undefined')
                cear_cnts = 0;
            else if (limit_val == 0)
                cear_cnts = 0;
            else
                cear_cnts = limit_val - 1;
            $log.error(cear_cnts);
            var send = {limit_val: cear_cnts, action: "get_cear_list",branch_id:$scope.user_branch};
        }
        else {
            var send = {action: "get_cear_list",branch_id:$scope.user_branch};
        }
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cear_lists = angular.fromJson(payload.list);
                        $scope.cear_approvals_count = payload.cear_approvals_count;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        $scope.category = payload.category;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cear_lists = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.ppls = [];
    $scope.pcfs = [];
    $scope.foaibs = [];
    $scope.pp = [];
    $scope.roiirr = [];
    $scope.addCear = function (cear) {
        $log.log(cear);
        var ufiles = [];
        ufiles = ufiles.concat($scope.ppls);
        ufiles = ufiles.concat($scope.pcfs);
        ufiles = ufiles.concat($scope.foaibs);
        ufiles = ufiles.concat($scope.pp);
        ufiles = ufiles.concat($scope.roiirr);
        baseFactory.addDeviceFileUpload1(cear, ufiles, 'user/add_cear_list')
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go('home.cear');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    /*$scope.addCear=function(cear)
     {
     cear.action = "add_cear_list";
     baseFactory.UserCtrl(cear)
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
    $scope.editCear = function (ev, editcear) {
        var template_name = 'user/edit_cear_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {editcear: editcear},
            controller: _eCearEdit
        }).then(function () {
            },
            function () {
            });
    };
    function _eCearEdit($scope, editcear) {
        $scope.loadCearCategory();
        //$scope.loadCear();
        $scope.loadDepartments();
        //$scope.loadBranches();
        $scope.cear_edit = editcear;
        $scope.cear_edit.date = editcear.DATE;
        $scope.cear_edit.cear_number = editcear.CEAR_ID;
        $scope.cear_edit.prj_number = editcear.PROJECT_ID;
		$scope.cear_edit. department = editcear.department;
        $scope.cear_edit.category = editcear.CATEGORY;
        $scope.cear_edit.prj_title = editcear.TITLE;
        $scope.cear_edit.req_unit1 = editcear.REQ_UNIT;
		$scope.cear_edit.req_unit = editcear.branch_name;
        $scope.cear_edit.req_dept = editcear.REQ_DEPT;
        $scope.cear_edit.scope_prj = editcear.SOP;
        $scope.cear_edit.purpose_justification = editcear.PAJ;
        $scope.cear_edit.alernative_considered = editcear.AC;
        $scope.cear_edit.cnae = editcear.CONAE;
        $scope.cear_edit.eobe = editcear.EOOBE;
        $scope.cear_edit.equp_purcg = editcear.EP;
        $scope.cear_edit.cear_conformation = editcear.DFATTACHED;
        $scope.cear_edit.esdate = new Date(editcear.DATE);
        $scope.cear_edit.edate = new Date(editcear.DATE);
        $scope.cear_edit.ecdate = new Date(editcear.CDATE);
        $scope.cear_edit.sdate = editcear.DATE;
        $scope.cear_edit.cdate = editcear.CDATE;
        $scope.cear_edit.cost = editcear.COST;
        $scope.cear_edit.conclusion = editcear.CONSLUSION;
    }

    $scope.updateCear = function (data) {
        var ufiles = [];
        ufiles = ufiles.concat($scope.ppls);
        ufiles = ufiles.concat($scope.pcfs);
        ufiles = ufiles.concat($scope.foaibs);
        ufiles = ufiles.concat($scope.pp);
        ufiles = ufiles.concat($scope.roiirr);
        baseFactory.addDeviceFileUpload1(data, ufiles, 'user/update_cear_list')
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.ApproveCear = function (ev, approve_cear)
    {
        var template_name = 'user/approve_cear_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {approve_cear: approve_cear},
            controller: _eApproveCear
        }).then(function () {
            },
            function () {
            });
    };
    function _eApproveCear($scope, approve_cear)
    {
        $scope.loadCearCategory();
        //$scope.loadCear();
        $scope.loadDepartments();
        //$scope.loadBranches();
        $scope.approve_cear = approve_cear;
        $scope.approve_cear.date = approve_cear.DATE;
        $scope.approve_cear.cear_number = approve_cear.CEAR_ID;
        $scope.approve_cear.prj_number = approve_cear.PROJECT_ID;
        $scope.approve_cear.category = approve_cear.CATEGORY;
        $scope.approve_cear.prj_title = approve_cear.TITLE;
        $scope.approve_cear.req_unit = approve_cear.REQ_UNIT;
        $scope.approve_cear.req_dept = approve_cear.REQ_DEPT;
        $scope.approve_cear.scope_prj = approve_cear.SOP;
        $scope.approve_cear.purpose_justification = approve_cear.PAJ;
        $scope.approve_cear.alernative_considered = approve_cear.AC;
        $scope.approve_cear.cnae = approve_cear.CONAE;
        $scope.approve_cear.eobe = approve_cear.EOOBE;
        $scope.approve_cear.equp_purcg = approve_cear.EP;
        $scope.approve_cear.cear_conformation = approve_cear.DFATTACHED;
        $scope.approve_cear.esdate = new Date(approve_cear.DATE);
        $scope.approve_cear.edate = new Date(approve_cear.DATE);
        $scope.approve_cear.ecdate = new Date(approve_cear.CDATE);
        $scope.approve_cear.sdate = approve_cear.DATE;
        $scope.approve_cear.cdate = approve_cear.CDATE;
        $scope.approve_cear.cost = approve_cear.COST;
        $scope.approve_cear.conclusion = approve_cear.CONSLUSION;
        $scope.approve_cear.approved_by = approve_cear.APPROVED_BY!=null ? angular.fromJson(approve_cear.APPROVED_BY) : null;
    }
    $scope.ApproveupdateCear = function(approve_cear)
    {
        approve_cear.action = "update_observations_approve";
        var user_id=$cookies.get('user_id');
        var user_erole_code = $cookies.get('user_erole_code');
        var appr={user_id:user_id,role:user_erole_code};
        if(approve_cear.approved_by==null)
        {
            approve_cear.approved_by=[appr];
        }
        else
        {
            approve_cear.approved_by.push(appr);
        }
        $log.log("approve_cear");
        $log.log(approve_cear);
        baseFactory.UserCtrl(approve_cear)
            .then(function (payload)
            {
                $log.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.toast_text = payload.call_back;
                    $scope.mdDialogHide();
                    $scope.showToast();
                    $state.forceReload();
                }
                else if (payload.response == $rootScope.failedata) {
                    $scope.toast_text = payload.call_back;
                    $scope.showToast();
                }
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });
    };

    $scope.loadCearCategory = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var cear_category;
            if (typeof limit_val === 'undefined')
                cear_category = 0;
            else if (limit_val == 0)
                cear_category = 0;
            else
                cear_category = limit_val - 1;
            $log.error(cear_category);
            var send = {limit_val: cear_category, action: "get_cear_category_list"};
        }
        else {
            var send = {action: "get_cear_category_list"};
        }
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cear_categorys = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cear_categorys = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addCearCategory = function (cearcategory) {
        cearcategory.action = "add_cear_category_list";
        baseFactory.UserCtrl(cearcategory)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go('home.cearcategory');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.editCearCategory = function (ev, edit_cear_category) {
        var template_name = 'user/edit_cear_category_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {edit_cear_category: edit_cear_category},
            controller: _eCearCategoryEdit
        }).then(function () {
            },
            function () {
            });
    };
    function _eCearCategoryEdit($scope, edit_cear_category) {
        $scope.cear_category_edit = edit_cear_category;
        $scope.cear_category_edit.cear_category_name = edit_cear_category.NAME;
        $scope.cear_category_edit.code = edit_cear_category.CODE;
        $scope.cear_category_edit.status = edit_cear_category.STATUS;
    }

    $scope.updateCearCategory = function (data) {
        data.action = "update_cear_category_list";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadCearCategory();
                        //$state.go('home.cear_category');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.adminApprovedStatus = function (ev, eapprove) {
        $scope.loadReusableParts();
        $scope.loadDepartments();
		$scope.getallbranches();
        var template_name = 'user/edit_indedent_admin_aprroved_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {eapprove: eapprove},
            controller: _eIndentApproveddialog
        }).then(function () {
            },
            function () {
            });
    };
    function _eIndentApproveddialog($scope, eapprove)
    {
        
        $scope.update_indent_equipment = eapprove;
        $scope.loadDepartments();
        $scope.getEqupCategories();
        $scope.getSupportVendors();
        $scope.getContractVendorDetails(eapprove.VENDOR_ID);
        $scope.getEqupOEMS();
		$scope.get_user_branch = {};
        $scope.get_user_branch.userbranch_id = eapprove.BRANCH_ID;
        $scope.aindent_status = eapprove.INDENT_STATUS;
        $scope.update_indent_equipment.update_indent_equipment = eapprove.MAKE_ID;
        //$scope.update_indent_equipment.branch_id = eapprove.BRANCH_ID;
        $scope.update_indent_equipment.departments1 = eapprove.DEPT;
        $scope.update_indent_equipment.equp_name1 = eapprove.EQ_NAME;
        $scope.update_indent_equipment.quantity1 = eapprove.QTY;
        $scope.update_indent_equipment.cat1 = eapprove.EQ_CAT;
        $scope.update_indent_equipment.estimated_cost1 = eapprove.ESTIMATED_COST;
        $scope.update_indent_equipment.app_revenu_gen1 = eapprove.REVENEW_GENERATION;
        $scope.update_indent_equipment.approved_by = eapprove.APPROVED_BY!=null ? angular.fromJson(eapprove.APPROVED_BY) : eapprove.APPROVED_BY;
        $scope.update_indent_equipment.po_date1 = eapprove.PO_DATE;
        $scope.update_indent_equipment.company_name = eapprove.MAKE_ID;
        $scope.update_indent_equipment.vendor_name = eapprove.VENDOR_ID;
        $scope.update_indent_equipment.update_indent_equipment1 = eapprove.BUDGET_REFF;
        $scope.update_indent_equipment.reasons1 = eapprove.REASONS;
        $scope.update_indent_equipment.remarks1 = eapprove.REMARKS;
        $log.log("update_indent_equipment");
        $log.log($scope.update_indent_equipment);
    }

    $scope.UpdateIndentApprovedlist = function (data, aindent_status)
    {
        var user_id = $cookies.get('user_id');
        var user_erole_code = $cookies.get('user_erole_code');
        var appr={user_id:user_id,role:user_erole_code};
        if(data.approved_by==null)
        {
            data.approved_by = [appr];
        }
        else
        {
            data.approved_by.push(appr);
        }
        data.aindent_status = aindent_status;
        data.action = "update_indent_approved_list";
		
        baseFactory.UserCtrl(data)
        .then(function (payload)
        {
            $log.log(payload);
            if(payload.response == $rootScope.successdata)
            {
                $scope.toast_text = payload.call_back;
                $scope.mdDialogHide();
                $scope.showToast();
                $state.forceReload();
            }
            else if (payload.response == $rootScope.failedata)
            {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
	$scope.UpdateVendorIndentApprovedlist = function (data,status)
    {
        data.action = "update_indent_approved_list";
        data.status = status;
        console.log(data);
        baseFactory.UserCtrl(data)
            .then(function (payload)
                {
                    console.log(payload);
                    if(payload.response == $rootScope.successdata)
                    {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata)
                    {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.UpdateIndentDisApprovedlist = function (data, aindent_status) {
        data.aindent_status = aindent_status;
        data.action = "update_indent_disapproved_list";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadIndentReports = function (indid) {
        var send = {};
        send = {indent_id: indid, action: "get_indent_reports_pdf"};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.indent_reports_pdf = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.indent_reports_pdf = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.pdfIndentReport = function (ev, indent_reports) {
        var template_name = 'reports/view_indent_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {indent_reports: indent_reports},
            controller: _eViewIndentReportDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewIndentReportDetails($scope, indent_reports) {
        $log.log(indent_reports);

        var indent_id = indent_reports.INDENT_ID;

        $scope.loadIndentReports(indent_id);
    }

    $scope.loadCearReports = function (cearid) {
        var send = {};
        send = {cear_id: cearid, action: "get_cear_reports_pdf"};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cear_reports_pdf = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cear_reports_pdf = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    $scope.pdfCearReport = function (ev, cear_reports) {
        var template_name = 'reports/view_cear_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {cear_reports: cear_reports},
            controller: _eViewCearReportDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewCearReportDetails($scope, cear_reports) {
        $log.log(cear_reports);

        var cear_id = cear_reports.CEAR_ID;

        $scope.loadCearReports(cear_id);
    }
    $scope.adminSactionedStatus = function (ev, esactioned) {
        $scope.loadReusableParts();
        $scope.loadDepartments();
        var template_name = 'user/edit_indedent_sactioned_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {esactioned: esactioned},
            controller: _eIndentSactioneddialog
        }).then(function () {
            },
            function () {
            });
    };
    function _eIndentSactioneddialog($scope, esactioned)
    {
        $log.log(esactioned);
        $scope.sactioned_indent_equipment = esactioned;
        //$scope.loadDepartments();
        $scope.getEqupCategories();
        $scope.getSupportVendors();
        $scope.getSupportVendors();
        $scope.getEqupOEMS();
        $scope.getContractVendorDetails(esactioned.VENDOR_ID);
        $scope.aindent_sactioned_status = esactioned.SANCTION_STATUS;
        $scope.sactioned_indent_equipment.departments1 = esactioned.DEPT;
        $scope.sactioned_indent_equipment.company_name = esactioned.MAKE_ID;
        $scope.sactioned_indent_equipment.vendor_name = esactioned.VENDOR_ID;
        $scope.sactioned_indent_equipment.equp_name1 = esactioned.EQ_NAME;
        $scope.sactioned_indent_equipment.quantity1 = esactioned.QTY;
        $scope.sactioned_indent_equipment.cat1 = esactioned.EQ_CAT;
        $scope.sactioned_indent_equipment.estimated_cost1 = esactioned.ESTIMATED_COST;
        $scope.sactioned_indent_equipment.app_revenu_gen1 = esactioned.REVENEW_GENERATION;
        $scope.sactioned_indent_equipment.po_date1 = esactioned.PO_DATE;
        $scope.sactioned_indent_equipment.update_indent_equipment1 = esactioned.BUDGET_REFF;
        $scope.sactioned_indent_equipment.reasons1 = esactioned.REASONS;
        $scope.sactioned_indent_equipment.remarks1 = esactioned.REMARKS;
        $scope.indent_invoice_files=[];
        $scope.indent_po_files=[];
        $scope.UpdateIndentSactionedlist = function (data,status)
        {
            data.status=status;
            var files = [];
            files =  files.concat($scope.indent_invoice_files);
            $log.log("files");
            $log.log(files);
            files =  files.concat($scope.indent_po_files);
            $log.warn("dadadad");
            $log.log(data);
            baseFactory.addDeviceFileUpload(data,files,"user/update_indent_sanctioned_list")
            .then(function (payload)
            {
                $log.log(payload);
                    if (payload.response == $rootScope.successdata)
                    {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });
        };
    }


    $scope.UpdateIndentDisSactionedlist = function (data, indent_sactioned_status)
    {
        data.indent_sactioned_status = indent_sactioned_status;
        data.action = "update_indent_dissanctioned_list";
        baseFactory.UserCtrl(data)
        .then(function (payload)
        {
            if(payload.response == $rootScope.successdata)
            {
                $scope.toast_text = payload.call_back;
                $scope.mdDialogHide();
                $scope.showToast();
                $state.forceReload();
            }
            else if(payload.response == $rootScope.failedata)
            {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.addIndendtCearRequest = function (ev, indent_cear_request_equp) {
        var template_name = 'user/edit_indent_cear_request_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {indent_cear_request_equp: indent_cear_request_equp},
            controller: _eIndentCearEqupment
        }).then(function () {
            },
            function () {
            });
    };
    function _eIndentCearEqupment($scope, indent_cear_request_equp) {
        $scope.cear_request = indent_cear_request_equp;
        $scope.loadDepartments();
        $scope.loadCearCategory();
        $scope.loadBranches();
        $scope.cear_request.indent_id = indent_cear_request_equp.INDENT_ID;
        $scope.cear_request.departments = indent_cear_request_equp.department_name;
        $scope.cear_request.equp_name = indent_cear_request_equp.EQ_NAME;
        $scope.cear_request.quantity = indent_cear_request_equp.QTY;
        $scope.cear_request.cat = indent_cear_request_equp.category_name;
        $scope.cear_request.branch = indent_cear_request_equp.branch_name;
    }

    $scope.loadGatepass = function (limit_val) /* For Contracts */
    {
		
        if (limit_val != $scope.nostate) {
            var gate_pass;
            if (typeof limit_val === 'undefined')
                gate_pass = 0;
            else if (limit_val == 0)
                gate_pass = 0;
            else
                gate_pass = limit_val - 1;
            $log.error(gate_pass);
            var send = {limit_val: gate_pass, action: "get_gate_pass_list"};
        }
        else {
            var send = {action: "get_gate_pass_list"};
        }
		
        baseFactory.UserCtrl(send)
            .then(function (payload)
            {
                 console.log(payload);                 
				 $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.gate_pass_news = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.gate_pass_news = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });
    };

    $scope.addGatePass = function ()
    {
       /* if(branch_id == undefined)
        {
            $scope.toast_text = 'Please Select Branch';
            $scope.showToast();
            return false;
        }*/

        var submit_gate_pass = {};
        submit_gate_pass.data = $scope.add_gate_pass;
       // submit_gate_pass.branch_id = branch_id;
        submit_gate_pass.action = "add_gate_pass_list";
        $log.debug(angular.toJson(submit_gate_pass));
        baseFactory.UserCtrl(submit_gate_pass)
            .then(function (payload) {
                    $log.error(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.add_gate_pass = [];
                        $state.go('home.gate_pass_new');
                    }
                    else if (payload.response == $rootScope.failedata)
                    {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.editGatePass = function (ev, edit_gatepass)
    {
        var template_name = 'user/edit_gate_pass_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {edit_gatepass: edit_gatepass},
            controller: _eGatePassdialog
        }).then(function () {
            },
            function () {
            });
    };
    function _eGatePassdialog($scope, edit_gatepass)
    {
        $log.warn("edit_gatepass:");
        $log.warn(edit_gatepass.EXPECTED_RETURN);
        $scope.edit_gate_pass = edit_gatepass;
        $scope.loadDepartments();
        $scope.loadBranches();
        $scope.getDepartmentDevices();
        $scope.getCriticalSpares();
        $scope.getAccessories();
        $scope.edit_gate_pass.dept_id = edit_gatepass.DEPT_ID;
        $scope.edit_gate_pass.device_id = edit_gatepass.E_ID;
        $scope.edit_gate_pass.to_whom = edit_gatepass.TO_WHOM;
        $scope.edit_gate_pass.phy_location = edit_gatepass.LOCATION;
        $scope.edit_gate_pass.gtype = edit_gatepass.RETURN_TYPE;
        $scope.edit_gate_pass.expert_return = edit_gatepass.EXPECTED_RETURN;
        $scope.edit_gate_pass.critical_spare = edit_gatepass.SPARES.split(',');
        $scope.edit_gate_pass.spars_cnt = edit_gatepass.SPARES_CNT;
        $scope.edit_gate_pass.accessories = edit_gatepass.ACCESSORIES.split(',');
        $scope.edit_gate_pass.accessories_cnt = edit_gatepass.ACCESSORIES_CNT;
        $scope.edit_gate_pass.reasons = edit_gatepass.REASONS;
        $scope.edit_gate_pass.remarks = edit_gatepass.REMARKS;
    }

    $scope.UpdateGatePass = function (data, update_gate_pass) {
        data.update_gate_pass = update_gate_pass;
        data.action = "update_gate_pass";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go('home.gate_pass_new');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadGatepassReport = function (eid) /* For Contracts */ {
        var send = {};
        send = {equp_id: eid, action: "get_gate_pass_report"};
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.gate_passs = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.gate_passs = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.Gatepasspdf = function (ev, view_gatepass) {
        var template_name = 'reports/view_gate_pass_pdf';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {view_gatepass: view_gatepass},
            controller: _eviewGatePassdialog
        }).then(function () {
            },
            function () {
            });
    };
    function _eviewGatePassdialog($scope, view_gatepass) {
        $log.log(view_gatepass);
        $scope.gate_passs = view_gatepass;
    }

    $scope.addnewGatePass = function (ev)
    {
        var template_name = 'user/add_new_gate_pass_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            //locals: {view_gatepass: view_gatepass},
            controller: _eaddGatePassdialog
        }).then(function () {
            },
            function () {
            });
    };
    $scope.add_gate_pass = [];
    function _eaddGatePassdialog($scope) {
        $scope.gatepass_req = {};
        //$log.log(view_gatepass);
        //$scope.gate_passs = view_gatepass;
        $scope.appendGatepass = function () {
            $scope.add_gate_pass.push($scope.gatepass_req);
            $log.debug($scope.add_gate_pass);
            $scope.mdDialogHide();
        };
    }

    $scope.removeGatepass = function (item) {
		if (confirm("Are you sure?")) {
        alert("deleted"+ item);
    }
        var index = $scope.add_gate_pass.indexOf(item);
        $scope.add_gate_pass.splice(index, 1);
    };
    /* $scope.editGatePassnew = function(item, index){
     $scope.myItems[index] = item;
     }*/

    $scope.editGatePassnew = function (ev, edit_new_gate_pass) {
        var template_name = 'user/edit_new_gate_pass_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {edit_new_gate_pass: edit_new_gate_pass},
            controller: _eEditGatePassdialog
        }).then(function () {
            },
            function () {
            });
    };
    function _eEditGatePassdialog($scope, edit_new_gate_pass) {
        $scope.gatepass_update = edit_new_gate_pass;

    }

    $scope.addFilter = function (ev) {
        var template_name = 'user/add_call_log_filters';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            //locals: {edit_new_gate_pass: edit_new_gate_pass},
            controller: _eaddcalllogdialog
        }).then(function () {
            },
            function () {
            });
    };
    function _eaddcalllogdialog($scope) {
        //$scope.gatepass_update=edit_new_gate_pass;
    }

    $scope.UpdateNewGatepass = function (iteam, index) {
        $scope.myItems[index] = iteam;
    };
    $scope.printPdf = function () {
        html2canvas(document.getElementById('exportthis'), {
            onrendered: function (canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500,
                    }]
                };
                pdfMake.createPdf(docDefinition).download("Reports.pdf");
            }
        });
    };

    $scope.cmsbarchart = function () {
        var send = {};
        send = {action: "cms_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                 console.log(payload);
                    $log.debug(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.cmslabels = $filter('objtoArray')(days);
                    $scope.cmsdata = $filter('objtoArray')(counts);
                    $scope.cmsseries = ['Series A'];
                    $scope.cmscolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    };
    $scope.gatepassbarchart = function () {
        var send = {};
        send = {action: "gatepass_barchart",branch_id:$scope.user_branch};
        console.log(send);
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    console.log(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.gatepasslabels = $filter('objtoArray')(days);
                    $scope.gatepassdata = $filter('objtoArray')(counts);
                    $scope.gatepassseries = ['Series A'];
                    $scope.gatepasscolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    };
    $scope.viabiltybarchart = function () {
        var send = {};
        send = {action: "vaibilty_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    console.log(payload);
                    $log.debug(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.vaibiltylabels = $filter('objtoArray')(days);
                    $scope.vaibiltydata = $filter('objtoArray')(counts);
                    $scope.vaibiltyssseries = ['Series B'];
                    $scope.vaibiltycolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    }
    $scope.adversebarchart = function () {
        var send = {};
        send = {action: "adverse_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.adverselabels = $filter('objtoArray')(days);
                    $scope.adversedata = $filter('objtoArray')(counts);
                    $scope.adversessseries = ['Series A'];
                    $scope.adversecolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    }
    $scope.servicesbarchart = function () {
        var send = {};
        send = {action: "services_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.serviceslabels = $filter('objtoArray')(days);
                    $scope.servicesdata = $filter('objtoArray')(counts);
                    $scope.servicesseries = ['Series B'];
                    $scope.servicescolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    }
    $scope.calllogbarchart = function () {
        var send = {};
        send = {action: "calllog_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                   console.log(payload);
                    $log.debug(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.callloglabels = $filter('objtoArray')(days);
                    $scope.calllogdata = $filter('objtoArray')(counts);
                    $scope.calllogseries = ['Series D'];
                    $scope.calllogcolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    }
    $scope.Deployementbarchart = function () {
        var send = {};
        send = {action: "deployement_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    console.log(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.deployementlabels = $filter('objtoArray')(days);
                    $scope.deployementdata = $filter('objtoArray')(counts);
                    $scope.deployementseries = ['Series D'];
                    $scope.deployementcolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    }
    $scope.Redeployementbarchart = function () {
        var send = {};
        send = {action: "redeployement_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.error(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.redeployementlabels = $filter('objtoArray')(days);
                    $scope.redeployementdata = $filter('objtoArray')(counts);
                    $scope.redeployementseries = ['Series D'];
                    $scope.redeployementcolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    }
    $scope.Pmsbarchart = function () {
        var send = {};
        send = {action: "pms_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.error(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.pmslabels = $filter('objtoArray')(days);
                    $scope.pmsdata = $filter('objtoArray')(counts);
                    $scope.pmsseries = ['Series D'];
                    $scope.pmscolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    };
    $scope.QCbarchart = function () {
        var send = {};
        send = {action: "qc_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.error(payload);
                    console.log(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.qclabels = $filter('objtoArray')(days);
                    $scope.qcdata = $filter('objtoArray')(counts);
                    $scope.qcseries = ['Series D'];
                    $scope.qccolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    }
    $scope.Indentbarchart = function () {
        var send = {};
        send = {action: "indent_barchart",branch_id:$scope.user_branch};
        console.log(send);
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.debug(send.action);
                    $log.warn(payload);
                    console.log(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.indentlabels = $filter('objtoArray')(days);
                    $scope.indentdata = $filter('objtoArray')(counts);
                    $scope.indentseries = ['Series D'];
                    $scope.indentcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    };
    $scope.transferbarchart = function () {
        var send = {};
        send = {action: "transfer_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.error(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.transferlabels = $filter('objtoArray')(days);
                    $scope.transferdata = $filter('objtoArray')(counts);
                    $scope.transferseries = ['Series D'];
                    $scope.transfercolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    }
    $scope.Cearbarchart = function () {
        var send = {};
        send = {action: "cear_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.error(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.cearlabels = $filter('objtoArray')(days);
                    $scope.ceardata = $filter('objtoArray')(counts);
                    $scope.cearseries = ['Series D'];
                    $scope.cearcolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

    };

    $scope.Condemnationbarchart = function () {
        var send = {};
        send = {action: "condemnation_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.error(payload);
                    console.log(payload);
                    var days = angular.fromJson(payload.day);
                    var counts = angular.fromJson(payload.count);
                    $scope.condemnationlabels = $filter('objtoArray')(days);
                    $scope.condemnationdata = $filter('objtoArray')(counts);
                    $scope.condemnationseries = ['Series D'];
                    $scope.condemnationcolors = ['#46BFBD'];

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.Equipmentsumarybarchart = function () {
        var send = {};
        send = {action: "equipmentsumary_barchart"};
        send.branch_id = $scope.user_branch;
        console.log(send);
        baseFactory.graphsCall(send)
            .then(function (payload)
            {
                    console.log(payload);
                    var data = angular.fromJson(payload);
                    $scope.equipmentsumarylabels = $filter('objKeystoArray')(data);
                    $scope.equipmentsumarydata = $filter('objtoArray')(data);
                    $scope.equipmentsumaryseries = ['Series A'];
                    $scope.equipmentsumarycolors = ['#46BFBD'];
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });
    };
    $scope.EquipmentHistorybarchart = function () {
        var send = {};
        send = {action: "equipment_history_barchart"};
        send.branch_id = $scope.user_branch;
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.error(payload);
                    var data = angular.fromJson(payload);
                    $scope.equipmentHistorylabels = $filter('objKeystoArray')(data);
                    $scope.equipmentHistorydata = $filter('objtoArray')(data);
                    $scope.equipmentHistoryseries = ['Series D'];
                    $scope.equipmentHistorycolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MonthlyPerformancebarchart = function () {
        var send = {};
        send = {action: "monthly_performance_barchart",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {

                    $log.error(payload);
                    var data = angular.fromJson(payload);
                    $scope.montlyperformancelabels = $filter('objKeystoArray')(data);
                    $scope.montlyperformancedata = $filter('objtoArray')(data);
                    $scope.montlyperformanceseries = ['Series D'];
                    $scope.montlyperformancecolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.AdverseReportGraphs = function () {
        var send = {};
        send = {action: "adverse_report_graph",branch_id:$scope.user_branch};
        console.log(send);
        baseFactory.graphsCall(send)
            .then(function (payload) {

                    $log.error(payload);
                    var data = angular.fromJson(payload);
                    $scope.adversegraphlabels = $filter('objKeystoArray')(data);
                    $scope.adversegraphdata = $filter('objtoArray')(data);
                    $scope.adversegraphseries = ['Series A'];
                    $scope.adversegraphcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.pmsReportGraphs = function () {
        var send = {};
        send = {action: "pms_report_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.error(payload);
                    var cnt = angular.fromJson(payload.cnt);
                    var dept = angular.fromJson(payload.dept);
                    $scope.pmsgraphlabels = $filter('objtoArray')(dept);
                    $scope.pmsgraphdata = $filter('objtoArray')(cnt);
                    $scope.pmsgraphgraphseries = ['DEPT'];
                    $scope.pmsgraphcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.viabilityReportGraphsNew = function () {
        var send = {};
        send = {action: "viability_report_graph_bar"};
        baseFactory.graphsCall(send)
            .then(function (payload) {

                    $log.error(payload);
                    var data = angular.fromJson(payload);
                    $scope.viabilitygraphlabels1 = $filter('objKeystoArray')(data);
                    $scope.viabilitygraphdata1 = $filter('objtoArray')(data);
                    $scope.viabilitygraphseries1 = ['Series A'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.qcReportGraphs = function () {
        var send = {};
        send = {action: "qc_report_graph",branch_id:$scope.user_branch};
        console.log(send);
        baseFactory.graphsCall(send)
            .then(function (payload) {

                    $log.error(payload);
                    var cnt = angular.fromJson(payload.cnt);
                    var dept = angular.fromJson(payload.dept);
                    $scope.qcgraphlabels = $filter('objKeystoArray')(dept);
                    $scope.qcgraphdata = $filter('objtoArray')(cnt);
                    $scope.qcgraphseries = ['Series A'];
                    $log.error(dept);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.CondemnationReportGraphs = function ()
    {
        var send = {};
        send = {action: "condemnation_report_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    console.log(paload);
                    var data = angular.fromJson(payload);
                    $scope.condemnationgraphlabels = $filter('objKeystoArray')(data);
                    $scope.condemnationgraphdata = $filter('objtoArray')(data);
                    $scope.condemnationgraphseries = ['Series A'];
                    $scope.condemnationgraphcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.ViabiltyReportGraphs = function () {
        var send = {};
        send = {action: "viabilty_report_graph",branch_id:$scope.user_branch};
        send.branch_id = $scope.user_branch;
        console.log(send);
        baseFactory.graphsCall(send)
        .then(function(payload)
        {
            $log.warn(payload);
            var data = angular.fromJson(payload);
            $scope.viabiltygraphlabels = $filter('objKeystoArray')(data);
            $scope.viabiltygraphdata = $filter('objtoArray')(data);
            console.log($scope.viabiltygraphdata);
            $scope.viabiltygraphseries = ['Series A'];
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.DeployementReportGraphs = function () {
        var send = {};
        send = {action: "deployement_report_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {

                    $log.error(payload);
                    var data = angular.fromJson(payload);
                    $scope.deployementgraphlabels = $filter('objKeystoArray')(data);
                    $scope.deployementgraphdata = $filter('objtoArray')(data);
                    $scope.deployementgraphseries = ['Series A'];
                    $scope.deployementgraphcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.ReDeployementReportGraphs = function ()
    {
        var send = {};
        send = {action: "redeployement_report_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {

                    $log.error(payload);
                    var data = angular.fromJson(payload);
                    $scope.redeployementgraphlabels = $filter('objKeystoArray')(data);
                    $scope.redeployementgraphdata = $filter('objtoArray')(data);
                    $scope.redeployementgraphseries = ['Series A'];
                    $scope.redeployementgraphcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.ServiceReportGraphs = function ()
    {
        var send = {};
        send = {action: "service_report_graph"};
        send.branch_id = $scope.user_branch;
        baseFactory.graphsCall(send)
            .then(function (payload) {

                    $log.error(payload);
                    var data = angular.fromJson(payload);
                    $scope.servicegraphlabels = $filter('objKeystoArray')(data);
                    $scope.servicegraphdata = $filter('objtoArray')(data);
                    $scope.servicegraphseries = ['Series A'];
                    $scope.servicegraphcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.CalllogReportGraphs = function ()
    {
        var send = {};
        send = {action: "calllog_report_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {

                    $log.error(payload);
                    var data = angular.fromJson(payload);
                    $scope.call_logsgraphlabels = $filter('objKeystoArray')(data);
                    $scope.call_logsgraphdata = $filter('objtoArray')(data);
                    $scope.call_logsgraphseries = ['Series A'];
                    $scope.call_logsgraphcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.EquipmentDownTimeReportGraphs = function () {
        var send = {};
        send = {action: "equp_dwntm_report_graph"};
        send.branch_id = $scope.user_branch;
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.warn(payload);
                    var equp_name = angular.fromJson(payload.equp_name);
                    var total_down_time = angular.fromJson(payload.total_down_time);
                    // $log.warn(equp_name);
                    $scope.equipment_downtime_labels = $filter('objtoArray')(equp_name);
                    $scope.equipment_downtime_data = $filter('objtoArray')(total_down_time);
                    $scope.equipment_downtime_series = ['Series A'];
                    $scope.equipment_downtime_colors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    /*
     $scope.EquipmentHistporyReportGraphs=function()
     {
     var send={};
     send={action:"equp_dwntm_report_graph"};
     baseFactory.graphsCall(send)
     .then(function(payload)
     {
     $log.warn(payload);
     var equp_name = angular.fromJson(payload.equp_name);
     var total_down_time = angular.fromJson(payload.total_down_time);
     // $log.warn(equp_name);
     $scope.equipment_downtime_labels= $filter('objtoArray')(equp_name);
     $scope.equipment_downtime_data=   $filter('objtoArray')(total_down_time);
     $scope.equipment_downtime_series = ['Series A'];
     $scope.equipment_downtime_colors = ['#46BFBD'];
     },
     function(errorPayload)
     {
     $log.error('failure loading', errorPayload);
     });
     };*/
    $scope.MPRNonSheduledGraphs = function () {
        var send = {};
        send = {action: "nonsheduled_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    //$log.warn(payload);
                    console.log(payload);
                    var data = angular.fromJson(payload);
                    var mpr_reports_pdfs = angular.fromJson(payload.mpr_reports_pdfs);
                    $scope.nonscheduledlabels = ['AMC B/D', 'Biomedical Direct', 'Contract B/D', 'Warranty B/D', 'Other Support(NS)*'];
                    $scope.nonscheduledseries = ['Series A'];
                    $scope.nonscheduleddata = $filter('objtoArray')(data);
                    $scope.nonscheduledcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRResponseTimeGraphs = function () {
        var send = {};
        send = {action: "response_time_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.warn(payload);
                    var data = angular.fromJson(payload);
                    // var mpr_reports_pdfs = angular.fromJson(payload.mpr_reports_pdfs);
                    $scope.ResponseTimelabels = ['<10min', '<60 mins', '>60 mins'];
                    //var ndata=JSON.stringify(mpr_reports_pdfs);
                    $scope.ResponseTimeseries = ['Series A'];
                    $scope.ResponseTimedata = $filter('objtoArray')(data.rt);
                    $scope.ResponseTimecolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRTimeToRepairGraphs = function () {
        var send = {};
        send = {action: "time_to_repair_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    //$log.warn(payload);
                console.log(payload);
                    var data = angular.fromJson(payload.list);
                    var mpr_reports_pdfs = angular.fromJson(payload.mpr_reports_pdfs);
                    $scope.TimeToRepairlabels = ['<1D', '<3D', '>3D'];
                    //var ndata=JSON.stringify(mpr_reports_pdfs);
                    $scope.TimeToRepairseries = ['Series A'];
                    $scope.TimeToRepairdata = $filter('objtoArray')(data[0].tt);
                    //$scope.TimeToRepairdata=[3,2,1];
                    $scope.TimeToRepaircolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRSheduledGraphs = function () {
        var send = {};
        send = {action: "sheduled_graph",branch_id:$scope.branch_id};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    //$log.warn(payload);
                     console.log(payload);
                    var data = angular.fromJson(payload.list);
                    $scope.scheduledlabels = ['New Installations', 'Comp.Warranty PMS', 'Comp.Contract PMS', 'Biomedical PMS'];
                    $scope.scheduledseries = ['Series A'];
                    $scope.scheduleddata = $filter('objtoArray')(data[0].s);
                    $scope.scheduledcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRTrainingSessionGraphs = function () {
        var send = {};
        send = {action: "training_session_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    //$log.warn(payload);
                    //var data = angular.fromJson(payload.list);
                    $scope.trainingsessionlabels = ['BME Sessions with Trainees', 'OJT to Engineers by BME', 'Vendor Trainings to BME/Technicians', 'BME Training to Technicians', 'Trainings done on Rounds'];
                    $scope.trainingsessionseries = ['Series A'];
                    $scope.trainingsessiondata = [2, 4, 6, 1, 0, 4];
                    $scope.trainingsessioncolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRCauseCodesGraphs = function () {
        var send = {};
        send = {action: "cause_codes_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.warn(payload);
                    //var data = angular.fromJson(payload.cause_codes);
                    var names = angular.fromJson(payload.name);
                    var counts = angular.fromJson(payload.count);
                    $scope.causecodelabels = $filter('objtoArray')(names);
                    $scope.causecodeseries = ['Series A'];
                    $scope.causecodedata = $filter('objtoArray')(counts);
                    $scope.causecodecolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRReasonsfordelayGraphs = function () {
        var send = {};
        send = {action: "rt_ttr_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.warn(payload);
                    console.log(payload);
                    var data = angular.fromJson(payload);
                    $scope.rtTimeandttrlabels = ['RT>60mins', 'TTR>3Days'];
                    $scope.rtTimeandttrseries = ['Series A'];
                    $scope.rtTimeandttrdata = $filter('objtoArray')(data);
                    $scope.rtTimeandttrcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRAssetsCountGraphs = function () {
        var send = {};
        send = {action: "assets_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.warn(payload);
                    var data = angular.fromJson(payload);
                    var assets_cnt = angular.fromJson(payload.assets_cnt);
                    //var Assets = angular.fromJson(payload.Assets);
                    $scope.assetscountlabels = ['AMC', 'Contract', 'Biomedical', 'Warranty', 'Other Supports',];
                    $scope.assetscountseries = ['Series A'];
                    $scope.assetscountdata = $filter('objtoArray')(assets_cnt);
                    $scope.assetscountcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRAssetsValuesGraphs = function () {
        var send = {};
        send = {action: "assets_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.warn(payload);
                    var data = angular.fromJson(payload);
                    // var assets_cnt = angular.fromJson(payload.assets_cnt);
                    var Assets = angular.fromJson(payload.Assets);
                    $scope.assetvalueslabels = ['New Installation', 'Contract', 'AMC', 'Biomedical', 'Warranty', , 'Other Supports'];
                    $scope.assetvaluesseries = ['Series A'];
                    $scope.assetvaluesdata = $filter('objtoArray')(Assets);
                    $scope.assetvaluescolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRManpowerGraphs = function () {
        var send = {};
        send = {action: "manpower_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    //$log.warn(payload);
                    //var data = angular.fromJson(payload.list);
                    $scope.manpowerlabels = ['Number of Engineers sanctioned for Unit', 'Number of Engineers available this month', 'Holidays in the Month', 'Man days Available', 'MD on Training/Meets/OS/Rounds', 'Manpower /IB--MP/Asset Value'];
                    $scope.manpowerseries = ['Series A'];
                    $scope.manpowerdata = [2, 4, 6, 1, 0, 4];
                    $scope.manpowercolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRReplacementGraphs = function () {
        var send = {};
        send = {action: "replacement_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    //$log.warn(payload);
                    var data = angular.fromJson(payload);
                    $scope.replacementlabels = ['Nos', 'BUDGET(LAKHS)', 'NUMBERS RELEASED', 'PO VALUE', 'BALANCE(NO/VALUE)'];
                    $scope.replacementseries = ['Series A'];
                    $scope.replacementdata = $filter('objtoArray')(data);
                    $scope.replacementcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRReplacementGraphs = function () {
        var send = {};
        send = {action: "replacement_graph"};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    //$log.warn(payload);
                    var data = angular.fromJson(payload.list);
                    $scope.replacementlabels = ['Nos', 'BUDGET(LAKHS)', 'NUMBERS RELEASED', 'PO VALUE', 'BALANCE(NO/VALUE)'];
                    $scope.replacementseries = ['Series A'];
                    $scope.replacementdata = $filter('objtoArray')(data);
                    ;
                    $scope.replacementcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRExpensesCountGraphs = function () {
        var send = {};
        send = {action: "expenses_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    //$log.warn(payload);
                    var count = angular.fromJson(payload.count);
                    $scope.expensescountlabels = ['NABH DONE', ' SPARES', 'ACCESSORIES', 'SERVICE', 'CONSUMABLES'];
                    $scope.expensescountseries = ['Series A'];
                    $scope.expensescountdata = $filter('objtoArray')(count);
                    $scope.expensescountcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRExpensesValuetGraphs = function () {
        var send = {};
        send = {action: "expenses_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    //$log.warn(payload);
                    var cost = angular.fromJson(payload.cost);
                    $scope.expensesvaluelabels = ['NABH DONE', ' SPARES', 'ACCESSORIES', 'SERVICE', 'CONSUMABLES'];
                    $scope.expensesvalueseries = ['Series A'];
                    $scope.expensesvaluedata = $filter('objtoArray')(cost);
                    $scope.expensesvaluecolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.MPRActivitiesCountGraphs = function () {
        var send = {};
        send = {action: "activities_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.warn(payload);
                    console.log(payload);
                    var count = angular.fromJson(payload.ct);
                    $scope.activitiescountlabels = ['GRNs DONE', 'ADVERSE INCIDENTS REPORTED', 'EQ.DEPLOYMENTS', 'EQUIPMENTS CONDEMNED', 'MEETING ATTENDED - HOD,MD,CHA(Nos.)', 'CRITICAL EQUIPMENT UPTIME(%)'];
                    $scope.activitiescountseries = ['Series A', 'Series B'];
                    $scope.activitiescountdata = $filter('objtoArray')(count);
                    $scope.activitiescountcolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRActivitiesValuesGraphs = function () {
        var send = {};
        send = {action: "activities_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.warn(payload);
                    var cost = angular.fromJson(payload.cc);
                    $scope.activitiesvalueslabels = ['GRNs DONE', 'ADVERSE INCIDENTS REPORTED', 'EQ.DEPLOYMENTS', 'EQUIPMENTS CONDEMNED', 'MEETING ATTENDED - HOD,MD,CHA(Nos.)', 'CRITICAL EQUIPMENT UPTIME(%)'];
                    $scope.activitiesvaluesseries = ['Series A', 'Series B'];
                    $scope.activitiesvaluesdata = $filter('objtoArray')(cost);
                    $scope.activitiesvaluescolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRnabhreadinessGraphs = function () {
        var send = {};
        send = {action: "activities_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                   //$log.warn(payload);
                    console.log(payload);
                    var cost = angular.fromJson(payload.cc);
                    $scope.activitiesvalueslabels = ['GRNs DONE', 'ADVERSE INCIDENTS REPORTED', 'EQ.DEPLOYMENTS', 'EQUIPMENTS CONDEMNED', 'MEETING ATTENDED - HOD,MD,CHA(Nos.)', 'CRITICAL EQUIPMENT UPTIME(%)'];
                    $scope.activitiesvaluesseries = ['Series A', 'Series B'];
                    $scope.activitiesvaluesdata = $filter('objtoArray')(cost);
                    $scope.activitiesvaluescolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPRContractsGraphs = function () {
        var send = {};
        send = {action: "contracts_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.warn(payload);
                    var data = angular.fromJson(payload);
                    $scope.contractslabels = ['TOTAL LIVE CONTRACTS BF', 'EXPIRED CONTRACTS (till last month)', ' 	EXPIRED WARRANTY (till last month)', 'CONTRACTS expired and sent for renewal', 'WARRANTY expired and sent for CONT.', 'WARR. TO CONTRACTS NOT DESIRED', 'CONTRACT renewals NOT DESIRED', 'CONT RENEWALS DONE since last month', 'CONTRACT RENEWALS PENDING', 'CONTRACTS EXPIRING in coming month', 'WARRANTY EXPIRING in coming month', ' CONTs (TO BE) INDENTED FOR RENEWAL', 'TOTAL CONTRACT RENEWALS PENDING'];
                    $scope.contractsseries = ['COUNT', 'VALUE'];
                    $scope.contractsdata1 = $filter('objtoArray')(data.cost);
                    $scope.contractsdata2 = $filter('objtoArray')(data.count);
                    $scope.contractsdata = [$scope.contractsdata2, $scope.contractsdata1];
                    console.log($scope.contractsdata);
                    $scope.contractscolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.MPREngineerProductivityGraphs = function () {
        var send = {};
        send = {action: "engineering_productivity_graph",branch_id:$scope.user_branch};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.warn(payload);
                    var data = angular.fromJson(payload.calls);
                    $scope.Engineerproductivitylabels = $filter('objtoArray')(data.name);
                    $scope.Engineerproductivityseries = ['Calls', 'Rounds', 'Pms', 'Trainings', 'Total_trips'];
                    $scope.Engineerproductivitydata1 = $filter('objtoArray')(data.cms_cnt);
                    $scope.Engineerproductivitydata2 = $filter('objtoArray')(data.rounds);
                    $scope.Engineerproductivitydata3 = $filter('objtoArray')(data.pms_cnt);
                    $scope.Engineerproductivitydata4 = $filter('objtoArray')(data.trngs_cnt);
                    $scope.Engineerproductivitydata5 = $filter('objtoArray')(data.total_trips);
                    $scope.Engineerproductivitydata = [$scope.Engineerproductivitydata1, $scope.Engineerproductivitydata2, $scope.Engineerproductivitydata3, $scope.Engineerproductivitydata4, $scope.Engineerproductivitydata5];
                    //console.log($scope.Engineerproductivitydata);
                    $scope.Engineerproductivitycolors = ['#00ADF9', '#DCDCDC', '#46BFBD', '#FDB45C', '#949FB1',];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.MPRnabhreadinessGraphs = function () {
        var send = {};
        send = {action: "nabhreadiness_graph"};
        baseFactory.graphsCall(send)
            .then(function (payload) {
                    $log.warn(payload);
                    var data = angular.fromJson(payload);
                    var count = angular.fromJson(payload.count);
                    var cost = angular.fromJson(payload.cost);
                    $scope.nabhreadinesslabels = $filter('objtoArray')(data.keys);
                    $scope.nabhreadinessseries = ['NABH Calibration Numbers', 'NABH Calibration Cost '];
                    $scope.nabhreadinessdata1 = $filter('objtoArray')(data.count);
                    $scope.nabhreadinessdata2 = $filter('objtoArray')(data.cost);
                    $scope.nabhreadinessdata = [$scope.nabhreadinessdata1, $scope.nabhreadinessdata2];
                    $scope.nabhreadinesscolors = ['#46BFBD'];
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getEquipmentDownTime = function (limit_val) {
        limit_val = $scope.nostate;
        if (limit_val != $scope.nostate) {
            var equp_dwn_time;
            if (typeof limit_val === 'undefined')
                equp_dwn_time = 0;
            else if (limit_val == 0)
                equp_dwn_time = 0;
            else
                equp_dwn_time = limit_val - 1;
            $scope.equp_dwtime_report_search.limit_val = equp_dwn_time;
        }
        else {
            delete $scope.equp_dwtime_report_search.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.equp_dwtime_report_search.equp_id = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.equp_dwtime_report_search.equp_id = $scope.searched.EID.E_ID;
        else
            $scope.equp_dwtime_report_search.equp_id = "";
        $scope.equp_dwtime_report_search.action = "get_equp_down_time_list";
        $scope.equp_dwtime_report_search.branch_id = $scope.user_branch;
        $log.log(JSON.stringify($scope.equp_dwtime_report_search));
        baseFactory.deviceCall($scope.equp_dwtime_report_search)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equp_down_times = angular.fromJson(payload);
                        //$scope.no_same_equpments = angular.fromJson(payload.no_same_equpments);
                        //$scope.paging.total = payload.rcnt;
                        //$scope.no_of_recs = payload.no_of_recs;
                        // $scope.no_same_equpts = payload.no_same_equpts;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equp_down_times = null;
                        //$scope.paging.total = 0;
                        //$scope.no_of_recs = 0;
                        $scope.no_of_dtnt_ename = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getEquipmentHistory = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var equp_history_time;
            if (typeof limit_val === 'undefined')
                equp_history_time = 0;
            else if (limit_val == 0)
                equp_history_time = 0;
            else
                equp_history_time = limit_val - 1;
            $scope.equp_history_report_search.limit_val = equp_history_time;
        }
        else {
            delete $scope.equp_history_report_search.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.equp_history_report_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.equp_history_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.equp_history_report_search.eqpid = "";
        $scope.equp_history_report_search.action = "get_equpiment_history_list";
        $scope.equp_history_report_search.branch_id = $scope.user_branch;
        $log.warn($scope.equp_history_report_search);
        baseFactory.deviceCall($scope.equp_history_report_search)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equp_history_cards = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        // $scope.no_same_equpts = payload.no_same_equpts;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equp_history_cards = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                        $scope.no_of_dtnt_ename = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.hodMyCalls = function () {
        if ($scope.myall_hod_select != undefined) {
            if ($scope.myall_hod_select == $scope.hod_calls_select[0]) {
                $scope.getAllCallsCount($scope.user_role_code, $scope.user_id);
            }
            else if ($scope.myall_hod_select == $scope.hod_calls_select[1]) {
                $scope.getAllCallsCount();
            }
        }
        else
            $scope.getAllCallsCount();
    };
    $scope.forAdminCompletedCalls = function (bid) {
        $scope.completecall_search.branch_id = bid;
        $scope.completedpms_search.branch_id = bid;
        $scope.completedqcs_search.branch_id = bid;
        $scope.adverseincdent.branch_id = bid;
        $scope.rounds_completed_search.branch_id = bid;
        $scope.compelted_transfers_search.branch_id = bid;
        $scope.condimnation_search.branch_id = bid;
        $scope.SearchCompletedCalls($scope.nostate,bid);
        $scope.SearchCompletedPms($scope.nostate,bid);
        $scope.SearchCompletedQcs($scope.nostate,bid);
        $scope.getAdverseIncedents($scope.nostate,bid);
        $scope.loadRoundCompleted($scope.nostate,bid);
        $scope.allCompletedTransfers($scope.nostate,bid);
        $scope.loadCompletedCondemenationRequest($scope.nostate,undefined,bid);
    };
    $scope.EditnewOrgContatcPerson = function (ev, all_ocp, index) {
        var template_name = 'mainadmin/edit_new_org_contact_person';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {all_ocp: all_ocp, index: index},
            controller: _eUpdateOCPdialog
        }).then(function () {
            },
            function () {
            });
    };
    function _eUpdateOCPdialog($scope, all_ocp, index) {
        $scope.edit_ocp = {};
        $scope.edit_ocp.econtact_person = all_ocp.contact_person;
        $scope.edit_ocp.econtact_person_no = all_ocp.contact_person_no;
        $scope.edit_ocp.ecpemail = all_ocp.cpemail;
        $log.info($scope.edit_ocp);
        $scope.UpdateOCP = function (edit_ocp) {
            $scope.all_ocps[index].contact_person = edit_ocp.econtact_person;
            $scope.all_ocps[index].contact_person_no = edit_ocp.econtact_person_no;
            $scope.all_ocps[index].cpemail = edit_ocp.ecpemail;
            $log.warn($scope.all_ocps);
            $scope.mdDialogHide();
        };
    }
    $scope.EditaptOrgContatcPerson = function (ev, all_ocp, index) {
        var template_name = 'mainadmin/edit_apt_org_contact_person';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {all_ocp: all_ocp, index: index},
            controller: _eUpdateaptOCPdialog
        }).then(function () {
            },
            function () {
            });
    };
    function _eUpdateaptOCPdialog($scope, all_ocp, index) {
        $scope.edit_ocp = {};
        $scope.edit_ocp.econtact_person = all_ocp.contact_person;
        $scope.edit_ocp.econtact_person_no = all_ocp.contact_person_no;
        $scope.edit_ocp.ecpemail = all_ocp.cpemail;
        $scope.edit_ocp.cp_designation = all_ocp.cp_designation;
        $log.info($scope.edit_ocp);
        $scope.UpdateAptOCP = function (edit_ocp) {
            $scope.all_ocps[index].contact_person = edit_ocp.econtact_person;
            $scope.all_ocps[index].contact_person_no = edit_ocp.econtact_person_no;
            $scope.all_ocps[index].cpemail = edit_ocp.ecpemail;
            $scope.all_ocps[index].cp_designation = edit_ocp.cp_designation;
            $log.warn($scope.all_ocps);
            $scope.mdDialogHide();
        };
    }

    $scope.addnewOrgContatcPerson = function (ev) {
        var template_name = 'mainadmin/add_new_org_contact_person';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            controller: _eaddOCPdialog
        }).then(function () {
            },
            function () {
            });
    };
    $scope.all_ocps = [];
    function _eaddOCPdialog($scope) {
        $scope.add_ocp = {"contact_person": "", "contact_person_no": "", "cpemail": ""};
        $scope.appendOCP = function () {
            $scope.all_ocps.push($scope.add_ocp);
            $log.debug($scope.all_ocps);
            $scope.mdDialogHide();
        };
    }
    $scope.addAPTOrgContatcPerson = function (ev) {
        var template_name = 'mainadmin/add_apt_org_contact_person';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            controller: _eaddOCPdialog1
        }).then(function () {
            },
            function () {
            });
    };
    $scope.all_ocps = [];
    function _eaddOCPdialog1($scope) {
        $scope.add_ocp = {"contact_person": "", "contact_person_no": "", "cpemail": "","cp_designation":""};
        $scope.AptappendOCP = function () {
            $scope.all_ocps.push($scope.add_ocp);
            $log.debug($scope.all_ocps);
            $scope.mdDialogHide();
        };
    }

    $scope.removeOCP = function (item) {
        var index = $scope.all_ocps.indexOf(item);
        $scope.all_ocps.splice(index, 1);
    };
    $scope.addnewContatcPerson = function (ev) {
        var template_name = 'user/add_new_contact_person';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            controller: _eaddCPialog
        }).then(function () {
            },
            function () {
            });
    };
    $scope.all_cps = [];
    function _eaddCPialog($scope) {
        $scope.add_cp = {
            "contact_person": "",
            "contact_person_no": "",
            "cpemail": "",
            "priority": "",
            "contact_person_address": ""
        };
        //$log.log(view_gatepass);
        //$scope.gate_passs = view_gatepass;
        $scope.appendCP = function () {
            $scope.all_cps.push($scope.add_cp);
            $log.debug($scope.all_cps);
            $scope.mdDialogHide();
        };
    }

    $scope.removeCP = function (item) {
        var index = $scope.all_cps.indexOf(item);
        $scope.all_cps.splice(index, 1);
    };
    $scope.checktheVendorandCPs = function (vmbl) {
        if (vmbl != undefined) {
            if (vmbl.length > 6) {
                var send = {vmbl_no: vmbl, action: "get_vendorcp_user_dtls"};
                $log.debug(send);
                baseFactory.UserCtrl(send)
                    .then(function (payload) {
                            $log.debug(payload);
                            if(payload.vendor!=undefined && !$scope.isEmpty(payload.vendor))
                            {
                                $scope.add_vendor.vendor_name = payload.vendor.NAME;
                                $scope.add_vendor.email = payload.vendor.EMAIL_ID;
                                $scope.add_vendor.address = payload.vendor.ADDRESS;
                                var type = payload.vendor.TYPE;
                                $scope.add_vendor.type = type.split(",");
                            }
                            if (payload.response == $rootScope.successdata)
                            {
                                var cps = angular.fromJson(payload.cps);
                                $scope.all_cps = cps.contact_persons;
                            }
                            else if
                            (payload.response == $rootScope.emptydata || payload.response == $rootScope.failedata) {
                                $scope.all_cps = [];
                            }
                        },
                        function (errorPayload) {
                            $log.error('failure loading', errorPayload);
                        });
            }
        }
    };
    $scope.vendorexists = false;
    $scope.checktheVendorexists = function(vmbl)
    {
        if (vmbl != undefined) {
            if (vmbl.length > 6) {
                var send = {vmbl_no: vmbl, action: "get_vendorcp_exists"};
                $log.debug(send);
                baseFactory.UserCtrl(send)
                    .then(function (payload) {
                            $log.debug(payload);
                            if (payload.response == $rootScope.successdata)
                            {
                                $scope.vendorexists = false;
                            }
                            else if( payload.response == $rootScope.failedata) {
                                $scope.vendorexists = true;
                            }
                        },
                        function (errorPayload) {
                            $log.error('failure loading', errorPayload);
                        });
            }
        }
    };

    $scope.loadEqupHistrory = function (eid) {
        var send = {};
        send = {equp_id: eid, action: "get_equp_hstry_reports_pdf"};
        $log.log(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equp_histrory_report_pdf = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equp_histrory_report_pdf = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.pdfEquipmentHistorytReport = function (ev, equp_history_card) {
        var template_name = 'reports/view_equp_history_report_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {equp_history_card: equp_history_card},
            controller: _eViewEqupmentHistoryReportDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewEqupmentHistoryReportDetails($scope, equp_history_card) {
        $log.log(equp_history_card);

        var equp_id = equp_history_card.E_ID;

        $scope.loadEqupHistrory(equp_id);
    }

    $scope.loadMailFunction = function () {
        var send = {};
        send = {action: "mailing_fun"};
        $log.log(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.mail_details = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.mail_details = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadAssetManagementndOtherActivites = function ()  /* To Get branch List */ {
        var send = {action: "asset_management_other_assets"};
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.assets_managements = angular.fromJson(payload.asset_management);
                        $scope.assets_managements.tot_no_savings = angular.fromJson(payload.tot_no_savings);
                        $scope.assets_managements.tot_no_Events = angular.fromJson(payload.tot_no_Events);
                        $scope.assets_managements.tot_no_ppls = angular.fromJson(payload.tot_no_ppls);
                        $scope.assets_managements.tot_no_nabh_cnt = angular.fromJson(payload.tot_no_nabh_cnt);
                        $scope.assets_managements.tot_no_nabh_cost = angular.fromJson(payload.tot_no_nabh_cost);
                        $scope.assets_managements.tot_no_expenses_sprs = angular.fromJson(payload.tot_no_expenses_sprs);
                        $scope.assets_managements.tot_no_expenses_servcs = angular.fromJson(payload.tot_no_expenses_servcs);
                        $scope.assets_managements.tot_no_expenses_accers = angular.fromJson(payload.tot_no_expenses_accers);
                        $scope.assets_managements.tot_no_expenses_cnsbls = angular.fromJson(payload.tot_no_expenses_cnsbls);
                        $scope.assets_managements.tot_no_expenses_tot = angular.fromJson(payload.tot_no_expenses_tot);
                        $scope.assets_managements.tot_no_grns_cnt = angular.fromJson(payload.tot_no_grns_cnt);
                        $scope.assets_managements.tot_no_grns_cost = angular.fromJson(payload.tot_no_grns_cost);
                        $scope.assets_managements.tot_no_adverse_cnt = angular.fromJson(payload.tot_no_adverse_cnt);
                        $scope.assets_managements.tot_no_adverse_cost = angular.fromJson(payload.tot_no_adverse_cost);
                        $scope.assets_managements.tot_no_contracts_cnt = angular.fromJson(payload.tot_no_contracts_cnt);
                        $scope.assets_managements.tot_no_contracts_cost = angular.fromJson(payload.tot_no_contracts_cost);
                        $scope.assets_managements.tot_no_assets_cnt = angular.fromJson(payload.tot_no_assets_cnt);
                        $scope.assets_managements.tot_no_assets_cost = angular.fromJson(payload.tot_no_assets_cost);
                        $scope.assets_managements.tot_no_percent_count = angular.fromJson(payload.tot_no_percent_count);
                        $scope.assets_managements.tot_no_percent_cost = angular.fromJson(payload.tot_no_percent_cost);
                        $scope.assets_managements.tot_no_cond_count = angular.fromJson(payload.tot_no_cond_count);
                        $scope.assets_managements.tot_no_cond_cost = angular.fromJson(payload.tot_no_cond_cost);
                        $scope.assets_managements.tot_no_repl_count = angular.fromJson(payload.tot_no_repl_count);
                        $scope.assets_managements.tot_no_repl_cost = angular.fromJson(payload.tot_no_repl_cost);
                        $scope.assets_managements.tot_no_deplyment_count = angular.fromJson(payload.tot_no_deplyment_count);
                        $scope.assets_managements.tot_no_manpower_count = angular.fromJson(payload.tot_no_manpower_count);
                        $scope.assets_managements.percnt_cnt_tot = angular.fromJson(payload.percnt_cnt_tot);
                        $scope.assets_managements.tot_no_manpower_count = angular.fromJson(payload.tot_no_manpower_count);
                        $scope.assets_managements.percnt_cost_tot = angular.fromJson(payload.percnt_cost_tot);
                        $scope.assets_managements.asset_crores = angular.fromJson(payload.asset_crores);
                        $scope.assets_managements.percent_crores = angular.fromJson(payload.percent_crores);
                        $scope.assets_managements.contracts_lachs = angular.fromJson(payload.contracts_lachs);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.assets_managements = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.generalEqupChange = function (gs)
    {
        if (gs == $scope.yesstate) {
            $scope.add_device.no_of_qcs = 0;
            $scope.add_device.no_of_pms = 0;
            $scope.edit_device.QC_COUNT = 0;
            $scope.edit_device.PMS_COUNT = 0;
            $scope.replace_device.QC_COUNT = 0;
            $scope.replace_device.PMS_COUNT = 0;
        }
    };
    $scope.toJson = function(data)
    {
        return angular.fromJson(data);
    }
    /*Hospital Appointments*/
    $scope.loadAppointments = function (limit_val) {
        if (limit_val != $scope.nostate)
        {
            var appointment;
            if (typeof limit_val === 'undefined')
                appointment = 0;
            else if (limit_val == 0)
                appointment = 0;
            else
                appointment = limit_val - 1;
            var send = {limit_val: appointment, action: "get_appointment_list"};
        }
        else
        {
            var send = {action: "get_appointment_list"};
        }
		send.fromdate = $scope.search_apt_dates.search_apt_date_of_apt_from;
		send.todate = $scope.search_apt_dates.search_apt_date_of_apt_to;
		console.log(send);
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    console.log("get_appointment_list");
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.appointments = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        $log.debug($scope.appointments);
                    }
                    else {
                        $scope.appointments = null;
                        $scope.paging.total = null;
                        $scope.no_of_recs = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addAppointment = function (add_appointments){
        $scope.loadAllAppointmentOrgizations();
        add_appointments.action = "add_appoinment_list";
        $log.log(add_appointments);
        baseFactory.Mainadmin(add_appointments)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.all_ocps = [];
                        $state.go('home.appointment_hospitals');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.EditAppointments = function (ev, edit_appointment)
    {
        var template_name = 'mainadmin/edit_appointment';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {edit_appointment: edit_appointment},
            controller: _editAppointmentController
        });
    };
    function _editAppointmentController($scope, edit_appointment)
    {
        $scope.loadAllAppointmentOrgizations();
        $scope.getAptOrgContactPersonsByOrg(edit_appointment.ORG_ID);
        $log.info(edit_appointment.ORG_ID);
        $scope.update_appointment = edit_appointment;
        $scope.update_appointment.apt_date = new Date(edit_appointment.APT_DATE);
       // $scope.update_appointment.apt_time = new Date(edit_appointment.APT_TIME);
        $scope.update_appointment.apt_time = moment(edit_appointment.APT_TIME, "hh:mm A").toDate();
        $scope.update_appointment.contact_person = edit_appointment.CONTACT_PERSON;
        $scope.update_appointment.apt_place = edit_appointment.APT_PLACE;
        $scope.update_appointment.apt_contract_type = edit_appointment.APT_CONTACT_TYPE;
        $scope.update_appointment.apt_status = edit_appointment.APT_STATUS;
        $scope.update_appointment.feedback = edit_appointment.APT_FEEDBACKS;
        $scope.update_appointment.apt_orgnizations = edit_appointment.ORG_NAME;

    }
    $scope.UpdateAppointment = function (update_appointment) {
        update_appointment.action = "update_appointment_list";
        baseFactory.Mainadmin(update_appointment)
            .then(function (payload) {
                    $log.warn(update_appointment.action);
                    $log.error(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go('home.appointment_hospitals');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.ConvertAppointments = function (ev, convert_appointment)
    {
        var template_name = 'mainadmin/convert_appointment';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {convert_appointment: convert_appointment},
            controller: _covertAppointmentController
        });
    };
    function _covertAppointmentController($scope, convert_appointment)
    {
        $scope.loadAllAppointmentOrgizations();
        $scope.getAptOrgContactPersonsByOrg(convert_appointment.ORG_ID);
        $log.warn(convert_appointment);
       $scope.convert_appointment = convert_appointment;
        //$scope.convert_appointment.apt_date = new Date(convert_appointment.APT_DATE);
       // $scope.convert_appointment.apt_time = moment(convert_appointment.APT_TIME, "hh:mm A").toDate();
       // $scope.convert_appointment.contract_person = convert_appointment.CONTACT_PERSON;
       // $scope.convert_appointment.apt_place = convert_appointment.APT_PLACE;
       $scope.convert_appointment.apt_orgnizations = convert_appointment.ORG_NAME;
       // $scope.convert_appointment.apt_contract_type = convert_appointment.APT_CONTACT_TYPE;
        //$scope.convert_appointment.apt_status = convert_appointment.APT_STATUS;
        //$scope.convert_appointment.feedback = convert_appointment.APT_FEEDBACKS;
    }
    $scope.convertAppointment = function (convert_appointment) {
        convert_appointment.action = "convert_appointment_list";

        if(convert_appointment.PRVS_APT_DATES==null)
        {
            var convert_data=[];
        }
        else {
            var convert_data=angular.fromJson(convert_appointment.PRVS_APT_DATES);
        }
        var history = {};
        history.data=convert_appointment.APT_DATE;
        history.time=convert_appointment.APT_TIME;
        history.cp=convert_appointment.CONTACT_PERSON;
        history.place=convert_appointment.APT_PLACE;
        history.status=convert_appointment.APT_STATUS;
        history.feedback=convert_appointment.APT_FEEDBACKS;
        convert_data.push(history);
        convert_appointment.history=convert_data;
        baseFactory.Mainadmin(convert_appointment)
            .then(function (payload) {
                    $log.warn(convert_appointment.action);
                    $log.error(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go('home.appointment_hospitals');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.all_cp_apts = {};
    $scope.loadCpAppointmentDetails = function(org_id)
    {
        $log.debug('Hello');
        var send = {action: "get_cp_apt_details"};
        send.org_id=org_id;
        $log.debug(send);
        baseFactory.Mainadmin(send)
            .then(function (payload)
                {
                    $log.debug(payload);
                    if(payload.response == $rootScope.successdata) {
                        $scope.all_cp_apts = angular.fromJson(payload.list);
                       for(var i=0;i<$scope.all_cp_apts.length;i++)
                        {
                            $scope.all_cp_apts[i].PRVS_APT_DATES = $scope.all_cp_apts[i].PRVS_APT_DATES!=null ? angular.fromJson($scope.all_cp_apts[i].PRVS_APT_DATES) : null;
                            $log.debug($scope.all_cp_apts[i].PRVS_APT_DATES);
                        }
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.all_apt_orgs = null;
                    }
                    $log.debug($scope.all_apt_orgs);
                },
                function (errorPayload)
                {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.viewAppointmentsList = function (ev, edit_appointment)
    {
        $log.error('This is new Appointment');
        var template_name = 'mainadmin/view_appointment';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {edit_appointment: edit_appointment},
            controller: _viewAppointmentController
        });
    };
    function _viewAppointmentController($scope, edit_appointment)
    {
         $log.error(edit_appointment.ORG_ID);
         $scope.loadCpAppointmentDetails(edit_appointment.ORG_ID);
         $log.error('This is View Appointment');
    }
    $scope.loadAllAppointmentOrgizations = function ()
    {
        var send = {action: "get_org_data"};
        baseFactory.UserCtrl(send)
            .then(function (payload)
                {

                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.all_apt_orgs = angular.fromJson(payload.list);
                        for(var i=0;i<$scope.all_apt_orgs.length;i++)
                        {
                            $scope.all_apt_orgs[i].CONTACT_PERSONS = $scope.all_apt_orgs[i].CONTACT_PERSONS!=null ? angular.fromJson($scope.all_apt_orgs[i].CONTACT_PERSONS) : null;
                        }
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.all_apt_orgs = null;
                    }
                },
                function (errorPayload)
                {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.apt_org_cps = {};
    $scope.getAptOrgContactPersonsByOrg = function(org_id)
    {
        var data={};
        data.org_id=org_id;
        data.action = "get_apt_org_cps";
        $log.debug(data);
        baseFactory.UserCtrl(data)
            .then(function (payload)
            {
                console.log(payload);
                $scope.apt_org_cps = angular.fromJson(payload.list);
                $log.log($scope.apt_org_cps);
            });
    }
    /*Hospital Admins*/
    $scope.loadAPTOrgnigations = function (limit_val)
    {
        if (limit_val != $scope.nostate) {
            var apt_orgs;
            if (typeof limit_val === 'undefined')
                apt_orgs = 0;
            else if (limit_val == 0)
                apt_orgs = 0;
            else
                apt_orgs = limit_val - 1;
            $log.error(apt_orgs);
            var send = {limit_val: apt_orgs, action: "get_apt_organizations"};
        }
        else
        {
            var send = {action: "get_apt_organizations"};
        }
       $log.debug(send);
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.error(payload);
                    $log.debug("helo get_apt_organizations");
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.apt_hospitals = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        for(var i=0;i<$scope.apt_hospitals.length;i++)
                        {
                            $scope.apt_hospitals[i].CONTACT_PERSONS = angular.fromJson($scope.apt_hospitals[i].CONTACT_PERSONS);
                        }
                        $log.debug($scope.apt_hospitals);
                    }
                    else {
                        $scope.apt_hospitals = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addAPTHospitals = function (add_hospitals) {
        $log.log(add_hospitals);
        add_hospitals.action = "add_apt_hospital";
        add_hospitals.cp_details = $scope.all_ocps;
        baseFactory.Mainadmin(add_hospitals)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
						$scope.all_ocps = [];
                        $state.go('home.appointment_organizations');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.EditAPThospitals = function (ev, edithospitals)
    {
        $scope.loadOrgnasationTypes();
        $scope.loadCityList();
        $scope.loadCities();
        $scope.loadStates();
        $scope.loadCountry();
        //console.clear();
        $log.error("This is UpdateAppointment Hospitals");
        $scope.update_hospitals = edithospitals;
        $log.error(edithospitals);
        $scope.update_hospitals.country = edithospitals.ORG_COUNTRY;
        $scope.update_hospitals.states = edithospitals.ORG_STATE;
        $scope.update_hospitals.cities = edithospitals.ORG_CITY;
        $scope.update_hospitals.org_contact_no = edithospitals.ORG_CONTACTNO;
        $scope.update_hospitals.org_email_id = edithospitals.ORG_EMAIL;
        $scope.update_hospitals.org_name = edithospitals.ORG_NAME;
        $scope.update_hospitals.org_address = edithospitals.ORG_ADDRESS;
        $scope.update_hospitals.status = edithospitals.STATUS;
        $log.error($scope.update_hospitals );
        if (edithospitals.ORG_TYPE != null && edithospitals.ORG_TYPE != '')
            $scope.update_hospitals.org_type = edithospitals.ORG_TYPE.split(',');
        else
            $scope.update_hospitals.org_type = edithospitals.ORG_TYPE;
        if(edithospitals.CONTACT_PERSONS != null && edithospitals.CONTACT_PERSONS != '')
        {
            var ocps = angular.fromJson(edithospitals.CONTACT_PERSONS);
            $log.warn(ocps);
            $scope.all_ocps = ocps.contact_persons;
        }
        else
        {
            $scope.all_ocps = [];
        }
        $log.log("update_hospitals scope value");
        $log.log($scope.update_hospitals);
        $state.go('home.edit_organization_appointments');
    };
    $scope.UpdateAPTHospitals = function (data) {
        data.action = "update_apt_hospitals";
        data.cp_details = $scope.all_ocps;
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    $log.warn(data.action);
                    $log.error(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go('home.appointment_organizations');
                        $scope.loadAPTOrgnigations();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadHospitals = function (limit_val) {
       var send = {action: "get_hospitals"};
        if (limit_val != $scope.nostate)
        {
            var ln;
            if (typeof limit_val === 'undefined')
                ln = 0;
            else if (limit_val == 0)
                ln = 0;
            else
                ln = limit_val - 1;
            send.limit_val=ln;
        }
        else
        {
            delete send.limit_val;
        }
        console.log(send);
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.hospitals = angular.fromJson(payload.list);
						$scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        $log.debug($scope.hospitals);
                    }
                    else {
                        $scope.hospitals = null;
						$scope.paging.total = null;
                        $scope.no_of_recs = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
   $scope.addHospitals = function (hospital,aoorg_logo) {
        hospital.action = "add_hospital";
        hospital.cp_details = $scope.all_ocps;
        hospital.featuers = $scope.addfeatures;
        //console.log(JSON.stringify(hospital));
        //return false;
        baseFactory.Mainadmin(hospital)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.all_ocps = [];
                        $state.go('home.mahospitals');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    
	$scope.db_ft_list = {};
    $scope.EditHospitals = function (ev, edithospitals)
    {
        $scope.loadOrgnasationTypes();
        $scope.loadCityList();
        $scope.loadCities();
        $scope.loadStates();
        $scope.loadCountry();
        $scope.loadFuters();
        $scope.getSubFeatures();
        $scope.update_hospitals = edithospitals;
        $scope.update_hospitals.country = edithospitals.COUNTRY;
		$scope.update_hospitals.org_module = edithospitals.ORG_MODULE;
		$scope.update_hospitals.org_code = edithospitals.ORG_CODE;
        $scope.update_hospitals.states = edithospitals.STATE;
        $scope.update_hospitals.cities = edithospitals.CITY;
		$scope.update_hospitals.ex_date = new Date(edithospitals.EX_DATE);
        $scope.update_hospitals.contact_person = edithospitals.CP_NAME;
        $scope.update_hospitals.contact_no = edithospitals.CP_NUMBER;
        $scope.update_hospitals.email_id = edithospitals.CP_EMAIL;
        $scope.update_hospitals.org_name = edithospitals.ORG_NAME;
        $scope.update_hospitals.org_address = edithospitals.ORG_ADDRESS;
        $scope.update_hospitals.status = edithospitals.STATUS;
        $scope.update_hospitals.no_of_branches = edithospitals.NO_OF_BRANCHES;
        $scope.update_hospitals.no_of_users = edithospitals.NO_OF_USERS;
        $scope.update_hospitals.no_of_equipments = edithospitals.NO_OF_EQUPIMENTS;
		$scope.total_list = angular.fromJson(edithospitals.FEATURES);
		$scope.db_ft_list = $scope.total_list.menu;
		
        $scope.get_features_list(edithospitals.ORG_ID);
		
		$scope.toggleAll2 = function() {
			console.log("test");
			$scope.isAllSelected = !$scope.isAllSelected;
			console.log($scope.isAllSelected);
			angular.forEach($scope.existinglist, function(itm){ 						
				angular.forEach(itm.subfeatures, function(itm1){ 
					itm1.selected = $scope.isAllSelected; 
					itm.selected = $scope.isAllSelected; 
					angular.forEach(itm1.subsubfeatures, function(itm2){ 
						itm2.selected = $scope.isAllSelected; 
					});
				});
			});
		}
		$scope.clicker2 = function(option) {
            angular.forEach(option.subfeatures, function(value, key) {
                value.selected = option.selected;
                angular.forEach(value.subsubfeatures, function(value1, key1) {
                    value1.selected = value.selected;
                });


            });
        };
        $scope.clicker3 = function(option) {
            angular.forEach(option.subsubfeatures, function(value, key) {
                value.selected = option.selected;
            });
        };
        if (edithospitals.ORG_TYPE != null && edithospitals.ORG_TYPE != '')
            $scope.update_hospitals.org_type = edithospitals.ORG_TYPE.split(',');
        else
            $scope.update_hospitals.org_type = edithospitals.ORG_TYPE;
        if(edithospitals.CP_DETAILS != null && edithospitals.CP_DETAILS != '')
        {
            var ocps = angular.fromJson(edithospitals.CP_DETAILS);
            $log.warn(ocps);
            $scope.all_ocps = ocps.contact_persons;
        }
        else
        {
            $scope.all_ocps = [];
        }
        $state.go('home.edit_hospitals');
    };
	
	$scope.get_features_list = function (ORG_ID) {
        var data = {};
        data.org_id = ORG_ID;
        data.action = "get_existing_list";
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata){
                        $scope.existinglist = angular.fromJson(payload.list);
                        var i = j = k = 0;
                        
                        
                       /* 
                       for(i = 0; i < $scope.db_ft_list.length; i++ ){
                            if($scope.db_ft_list[i]!= undefined)
                            $scope.existinglist[i].selected = $scope.db_ft_list[i].selected;
                            for(j = 0; j < $scope.existinglist[i].subfeatures.length; j++){
                                if($scope.db_ft_list[i].subfeatures[j] != undefined)
                                $scope.existinglist[i].subfeatures[j].selected = $scope.db_ft_list[i].subfeatures[j].selected;
                                for(k = 0; k < $scope.existinglist[i].subfeatures[j].subsubfeatures.length; k++  ){
                                    if($scope.db_ft_list[i].subfeatures[j].subsubfeatures[k] != undefined)
                                     $scope.existinglist[i].subfeatures[j].subsubfeatures[k].selected = $scope.db_ft_list[i].subfeatures[j].subsubfeatures[k].selected;
                                }
                            }
                        }*/
                        
                        for(i=0 ; i < $scope.existinglist.length; i++) {
                            if ($scope.db_ft_list[i] != undefined)
                                $scope.existinglist[i].selected = $scope.db_ft_list[i].selected;
                            if ($scope.db_ft_list[i].hasOwnProperty($scope.db_ft_list[i].subfeatures) != undefined)
                            for (j = 0; j < $scope.existinglist[i].subfeatures.length; j++) {
                                if ($scope.db_ft_list[i].subfeatures[j] != undefined) {
                                    $scope.existinglist[i].subfeatures[j].selected = $scope.db_ft_list[i].subfeatures[j].selected;
                                    if ($scope.db_ft_list[i].subfeatures[j].subsubfeatures != undefined) {
                                        for (k = 0; k < $scope.existinglist[i].subfeatures[j].subsubfeatures.length; k++) {
                                            if ($scope.db_ft_list[i].subfeatures[j].subsubfeatures[k] != undefined) {
                                                $scope.existinglist[i].subfeatures[j].subsubfeatures[k].selected = $scope.db_ft_list[i].subfeatures[j].subsubfeatures[k].selected;
                                            } else {
                                                $scope.existinglist[i].subfeatures[j].subsubfeatures[k].selected = "false";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        
                    }else{
                        $scope.existinglist = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.AssignHospital = function (ev, edithospitals)
    {
        $log.log(edithospitals);

    console.clear();
    $log.error("This is Assign Hospitals");
    $scope.update_hospitals = edithospitals;
    $log.error(edithospitals);
    $scope.update_hospitals.current_org = edithospitals.ORG_ID;

    $state.go('home.assign_hospital');

};
    $scope.UpdateHospitals = function (data) {
        data.action = "update_hospitals";
        data.cp_details = $scope.all_ocps;
		
		
		 $scope.Checked = [];
        var pushThese = function(ar){
            ar.forEach(function(e){
                if(e.selected) $scope.Checked.push(e);
            });
        }
        pushThese($scope.existinglist);
        //data.features = $scope.Checked;
        data.features = $scope.existinglist;
		
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $state.go('home.mahospitals');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };





    $scope.HospitalAssign = function (data) {
        data.action = "hospital_assign";
        $log.log(JSON.stringify(data));
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    $log.warn(data.action);
                    $log.error(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $state.go('home.mahospitals');
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };


    /* Oragnasation TYpes*/
    $scope.loadOrgnasationTypes = function ()  /* Util Values */ {
        var send = {action: "get_orgtypes"};
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.horg_types = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.horg_types = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.getStateDetailsByCountryID = function (countryid) {
        var data = {};
        data.countryid = countryid;
        data.action = "get_states_by_country_id";
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata)
                        $scope.country_states = angular.fromJson(payload.list);
                    else
                        $scope.country_states = null;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.getBranchsDetailsByHospitalID = function (ORG_ID) {
        var data = {};
        data.org_id = ORG_ID;
        data.action = "get_Branch_DetailsBy_HospitalID";
       // console.log(data);
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata)
                        $scope.branches = angular.fromJson(payload.list);
                    else
                        $scope.branches = null;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.toppings = [
        { category: 'care', name: [{"BRANCH_ID":"CB00000001","BRANCH_NAME":"BANJARA IP"},{"BRANCH_ID":"CB00000002","BRANCH_NAME":"CARE, Nampallly"},{"BRANCH_ID":"CB00000003","BRANCH_NAME":"CARE, Secunderabad"}],"org_id":"ORG00000001" },
        { category: 'apolo', name: [{"BRANCH_ID":"CB00000017","BRANCH_NAME":"Apolllo"}],"org_id":"ORG00000002" }
    ];


    $scope.myselection = [];
    $scope.hospitalbranch = '';

    $scope.getBranchDetailsByHospitalID = function (orgs)
    {
        var data = {};
        data.org_list = orgs;
        data.action = "get_branch_by_hospital_id";
        $log.log(data);


        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata)
                        $scope.hospital_branchs = angular.fromJson(payload.list);
                    else
                        $scope.hospital_branchs = null;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getCityDetailsByStateID = function (countryid,state_id) {
        var data = {};
		data.countryid = countryid;
        data.stateid = state_id;
        data.action = "get_cities_by_state_id";
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    $log.error(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata)
                        $scope.state_cities = angular.fromJson(payload.list);
                    else
                        $scope.state_cities = null;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	$scope.LoadOrgFeatures = function(){
        var send = {action:"get_org_features_list"}
        baseFactory.Mainadmin(send)
            .then(function (payload)
                {
                    if (payload.response == $rootScope.successdata)
                    {
                        $scope.orgfeatures = angular.fromJson(payload.list);

                        $scope.toggleAll4 = function() {
                            $scope.isAllSelected = !$scope.isAllSelected;
                            angular.forEach($scope.orgfeatures, function(itm){
                                angular.forEach(itm.subfeatures, function(itm1){
                                    itm1.selected = $scope.isAllSelected;
                                    itm.selected = $scope.isAllSelected;
                                    angular.forEach(itm1.subsubfeatures, function(itm2){
                                        itm2.selected = $scope.isAllSelected;
                                    });
                                });
                            });
                        }
                        $scope.clicker = function(option) {
                            angular.forEach(option.subfeatures, function(value, key) {
                                value.selected = option.selected;
                                angular.forEach(value.subsubfeatures, function(value1, key1) {
                                    value1.selected = value.selected;
                                });
                            });
                        };
                        $scope.clicker1 = function(option) {
                            angular.forEach(option.subsubfeatures, function(value, key) {
                                value.selected = option.selected;
                            });
                        };
                    }
                    else if (payload.response == $rootScope.emptydata)
                    {
                        $scope.features = null;
                    }

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	$scope.loadFuters = function ()
    {
        var send = {action: "get_futures_list"};
        console.log(JSON.stringify(send));
        baseFactory.Mainadmin(send)
            .then(function (payload)
                {

                    if (payload.response == $rootScope.successdata)
                    {
                        $scope.addfeatures = angular.fromJson(payload.list);
                        $scope.orgtoggleAll = function() {
                            $scope.isAllSelected = !$scope.isAllSelected;
                            angular.forEach($scope.addfeatures, function(itm){
                                angular.forEach(itm.subfeatures, function(itm1){
                                    itm1.selected = $scope.isAllSelected;
                                    itm.selected = $scope.isAllSelected;
                                    angular.forEach(itm1.subsubfeatures, function(itm2){
                                        itm2.selected = $scope.isAllSelected;
                                    });
                                });
                            });
                        }
                        $scope.orgclicker = function(option) {
                            angular.forEach(option.subfeatures, function(value, key) {
                                value.selected = option.selected;
                                angular.forEach(value.subsubfeatures, function(value1, key1) {
                                    value1.selected = value.selected;
                                });


                            });
                        };
                        $scope.orgclicker1 = function(option) {
                            angular.forEach(option.subsubfeatures, function(value, key) {
                                value.selected = option.selected;
                            });
                        };
                    }
                    else if (payload.response == $rootScope.emptydata)
                    {
                        $scope.features = null;
                    }

                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	/*
    $scope.loadFuters = function ()
    {
        var send = {action: "get_futures_list"};
        baseFactory.Mainadmin(send)
        .then(function (payload)
        {
            $log.debug("get_futures_list");
            $log.debug(payload);
            if (payload.response == $rootScope.successdata)
            {
                $scope.features = angular.fromJson(payload.list);

            }
            else if (payload.response == $rootScope.emptydata)
            {
                $scope.features = null;
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };*/
    $scope.getSubFeatures = function () {
        var data = {};
        data.action = "get_subfetures";
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                   $log.debug("get_subfetures");
                   $log.debug(payload);
                    if (payload.response == $rootScope.successdata)
                        $scope.sub_futers = angular.fromJson(payload.list);
                    else
                        $scope.sub_futers = null;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	$scope.getsubSubFeatures = function () {
        var data = {};
        data.action = "get_subsubfeatures";
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    $log.debug("get_subsubfeatures");
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata)
                        $scope.sub_sub_futers = angular.fromJson(payload.list);
                    else
                        $scope.sub_sub_futers = null;
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.features_selected = [];
    $scope.menuToogle = function (menu, list) {
        var idx = list.indexOf(menu);
        $log.log(idx);
        if (idx > -1) {
            list.splice(idx, 1);
        }
        else {
            list.push(menu);
        }
        $log.log($scope.features_selected);
        // $log.log(list);
    };
    $scope.sub_features_selected = [];
    $scope.submenuToogle = function (sub_menu, list) {
        var idx = list.indexOf(sub_menu);
        if (idx > -1) {
            list.splice(idx, 1);
        }
        else {
            list.push(sub_menu);
        }
        $log.log($scope.sub_features_selected);
    };
	 $scope.subsub_features_selected = [];
    $scope.subsubmenuToogle = function (sub_menu, list) {
        //console.log(sub_menu);
        var idx = list.indexOf(sub_menu);
        if (idx > -1) {
            list.splice(idx, 1);
        }
        else {
            list.push(sub_menu);
        }
        $log.log($scope.subsub_features_selected);
    };
    /*Hospital Admins*/
    $scope.loadNSCRReports = function (equp_id) {
        var send = {};
        send = {equp_id: equp_id, action: "get_nscr_reports_view"};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.nsc_report_view = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.nsc_report_view = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.viewNSCRDetails = function (ev, nscr_reports) {
        var template_name = 'master/view_nscr_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {nscr_reports: nscr_reports},
            controller: _eViewNscrDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewNscrDetails($scope, nscr_reports) {
        $log.warn(nscr_reports);
        var equp_id = nscr_reports.EID;
        $scope.loadNSCRReports(equp_id);
    }
    $scope.loadSCRReports = function (equp_id)
    {
        var send = {};
        send = {equp_id: equp_id, action: "get_scr_reports_view"};
        $log.debug(send);
        baseFactory.reportsCall(send)
        .then(function (payload)
        {
                $log.debug(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.sc_report_view = angular.fromJson(payload.list);

                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.sc_report_view = null;
                }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.viewSCRDetails = function (ev, scr_reports) {
        var template_name = 'master/view_scr_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {scr_reports: scr_reports},
            controller: _eViewscrDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewscrDetails($scope, scr_reports) {
        $log.warn(scr_reports);
        var equp_id = scr_reports.EID;
        $scope.loadSCRReports(equp_id);
    }

    $scope.getNSCReport = function (limit_val) /* Show Device Details with QR details */
    {
        if ($scope.searched.EQUP_ID == null)
            $scope.nscr_report_search.eqpid = "";
        else if (typeof $scope.searched.E_ID === 'object')
            $scope.nscr_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.nscr_report_search.eqpid = "";
        if (limit_val != $scope.nostate)
        {
            var lm;
            if (typeof limit_val === 'undefined')
                lm = 0;
            else if (limit_val == 0)
                lm = 0;
            else
                lm = limit_val - 1;
            $scope.nscr_report_search.limit_val = lm;
        }
        else {
            delete $scope.nscr_report_search.limit_val;
        }
        $scope.nscr_report_search.action = "get_nscr_reports";
        $log.debug($scope.nscr_report_search);
        baseFactory.reportsCall($scope.nscr_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.nscr_reports = angular.fromJson(payload.nsc_report);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.nscr_reports = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };
    $scope.getNSCReportPDF = function (limit_val) /* Show Device Details with QR details */
    {
        if ($scope.searched.EQUP_ID == null)
            $scope.nscr_report_search.eqpid = "";
        else if (typeof $scope.searched.E_ID === 'object')
            $scope.nscr_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.nscr_report_search.eqpid = "";
        if (limit_val != $scope.nostate)
        {
            var lm;
            if (typeof limit_val === 'undefined')
                lm = 0;
            else if (limit_val == 0)
                lm = 0;
            else
                lm = limit_val - 1;
            $scope.nscr_report_search.limit_val = lm;
        }
        else {
            delete $scope.nscr_report_search.limit_val;
        }
        $scope.nscr_report_search.action = "get_nscr_reports";
        $log.debug($scope.nscr_report_search);
        baseFactory.reportsCall($scope.nscr_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata)
                {
                    $scope.nscr_report_pdf = angular.fromJson(payload.nsc_report);
                    var loc = window.location.pathname;
                    $log.log(loc);
                    var dir = loc.substring(0, loc.lastIndexOf('/'));
                    var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/nsc_total_report_pdf';
                    var word_data = angular.toJson($scope.nscr_report_pdf);
                    var send = word_data;
                    console.log(send);
                    var prev_data2 = send;
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = post_to;
                    form.target = '_blank'; // target the window
                    // append it to body
                    var body = document.getElementsByTagName('body')[0];
                    body.appendChild(form);
                    // create an element
                    var child1 = document.createElement('input');
                    child1.type = 'text'; // or 'hidden' it is the same
                    child1.name = 'nsc_total_data';
                    child1.value = prev_data2;

                    form.appendChild(child1);
                    //window.open('', 'window_1');
                    form.submit();
                    body.removeChild(form);
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.nscr_report_pdf = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };

    /*$scope.getPMSReportPDF = function (limit_val) /* Show Device Details with QR details */
   /* {
        if ($scope.searched.EID == null)
            $scope.pms_report_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.pms_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.pms_report_search.eqpid = "";
        if (limit_val != $scope.nostate)
        {
            var lm;
            if (typeof limit_val === 'undefined')
                lm = 0;
            else if (limit_val == 0)
                lm = 0;
            else
                lm = limit_val - 1;
            $scope.pms_report_search.limit_val = lm;
        }
        else {
            delete $scope.pms_report_search.limit_val;
        }
        $scope.pms_report_search.action = "get_pms_reports";
        $scope.pms_report_search.branch_id = $scope.user_branch;
        $log.debug($scope.pms_report_search);
        baseFactory.reportsCall($scope.pms_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata)
                {
                    $scope.pms_report_pdf = angular.fromJson(payload.pmsreport);
                    var loc = window.location.pathname;
                    var dir = loc.substring(0, loc.lastIndexOf('/'));
                    var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/pms_total_report_pdf';
                    var word_data = angular.toJson($scope.pms_report_pdf);
                    var send = word_data;
                    console.log(send);
                    var prev_data2 = send;
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = post_to;
                    form.target = '_blank'; // target the window
                    // append it to body
                    var body = document.getElementsByTagName('body')[0];
                    body.appendChild(form);
                    // create an element
                    var child1 = document.createElement('input');
                    child1.type = 'text'; // or 'hidden' it is the same
                    child1.name = 'pms_total_data';
                    child1.value = prev_data2;

                    form.appendChild(child1);
                    //window.open('', 'window_1');
                    form.submit();
                    body.Child(form);
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.pms_report_pdf = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    }; */
   
    $scope.getPMSReportPDF = function (data)
    {
        var loc = window.location.pathname;
        // $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/pms_total_report_pdf';
        $log.log(post_to);
        //var word_data = angular.toJson($scope.service_news_pdf);
        var word_data = data;
        var send = word_data;
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'pms_total_data';
        child1.value = prev_data2;
        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
   
    $scope.getQCReportPDF = function (data) /* Show Device Details with QR details */
    {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/qc_total_report_pdf';
        var word_data = angular.toJson($scope.qc_report_pdf);
        var send = word_data;
        console.log(send);
        var prev_data2 = send;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'qc_total_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };

   /* $scope.getQCReportPDF = function (limit_val) /* Show Device Details with QR details */
  /*  {
        if ($scope.searched.EID == null)
            $scope.qc_report_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.qc_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.qc_report_search.eqpid = "";
        if (limit_val != $scope.nostate)
        {
            var lm;
            if (typeof limit_val === 'undefined')
                lm = 0;
            else if (limit_val == 0)
                lm = 0;
            else
                lm = limit_val - 1;
            $scope.qc_report_search.limit_val = lm;
        }
        else {
            delete $scope.qc_report_search.limit_val;
        }
        $scope.qc_report_search.action = "get_qc_reports";
        $scope.qc_report_search.branch_id = $scope.user_branch;
        $log.debug($scope.qc_report_search);
        baseFactory.reportsCall($scope.qc_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata)
                {
                    $scope.qc_report_pdf = angular.fromJson(payload.qcreport);
                    var loc = window.location.pathname;
                    $log.log(loc);
                    var dir = loc.substring(0, loc.lastIndexOf('/'));
                    var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/qc_total_report_pdf';
                    var word_data = angular.toJson($scope.qc_report_pdf);
                    var send = word_data;
                    console.log(send);
                    var prev_data2 = send;
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = post_to;
                    form.target = '_blank'; // target the window
                    // append it to body
                    var body = document.getElementsByTagName('body')[0];
                    body.appendChild(form);
                    // create an element
                    var child1 = document.createElement('input');
                    child1.type = 'text'; // or 'hidden' it is the same
                    child1.name = 'qc_total_data';
                    child1.value = prev_data2;

                    form.appendChild(child1);
                    //window.open('', 'window_1');
                    form.submit();
                    body.removeChild(form);
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.qc_report_pdf = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };*/
    $scope.getSCReport = function (limit_val) /* Show Device Details with QR details */ {
        if ($scope.searched.EQUP_ID == null)
            $scope.scr_report_search.eqpid = "";
        else if (typeof $scope.searched.E_ID === 'object')
            $scope.scr_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.scr_report_search.eqpid = "";
        if (limit_val != $scope.nostate) {
            var lm;
            if (typeof limit_val === 'undefined')
                lm = 0;
            else if (limit_val == 0)
                lm = 0;
            else
                lm = limit_val - 1;
            $scope.scr_report_search.limit_val = lm;
        }
        else {
            delete $scope.scr_report_search.limit_val;
        }
        $scope.scr_report_search.action = "get_scr_reports";
        $log.debug($scope.scr_report_search);
        baseFactory.reportsCall($scope.scr_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.scr_reports = angular.fromJson(payload.sc_report);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.scr_reports = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };
    $scope.getqcSCReport = function (limit_val) /* Show Device Details with QR details */ {
        if ($scope.searched.EQUP_ID == null)
            $scope.scr_report_search.eqpid = "";
        else if (typeof $scope.searched.E_ID === 'object')
            $scope.scr_report_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.scr_report_search.eqpid = "";
        if (limit_val != $scope.nostate) {
            var lm;
            if (typeof limit_val === 'undefined')
                lm = 0;
            else if (limit_val == 0)
                lm = 0;
            else
                lm = limit_val - 1;
            $scope.scr_report_search.limit_val = lm;
        }
        else {
            delete $scope.scr_report_search.limit_val;
        }
		
        $scope.scr_report_search.action = "get_qcscr_reports";
        $log.debug($scope.scr_report_search);
        baseFactory.reportsCall($scope.scr_report_search)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.qc_scr_reports = angular.fromJson(payload.sc_report);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.qc_scr_reports = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };
    $scope.loadQcSCRReports = function (equp_id)
    {
        var send = {};
        send = {equp_id: equp_id, action: "get_qcscr_reports_view"};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload)
                {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.qcsc_report_view = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.qcsc_report_view = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.getHMAdminCallCounts = function ()
    {
        var send = {};
        send = {action: "get_hmadmin_call_counts"};
        $log.debug(send);
        baseFactory.deviceCall(send)
        .then(function (payload)
        {
            $log.debug(payload);
            if (payload.response == $rootScope.successdata)
            {
                $scope.sc_report_view = angular.fromJson(payload.list);
            }
            else if (payload.response == $rootScope.emptydata)
            {
                $scope.sc_report_view = null;
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    /*Hospital Admins*/
    $scope.loadSCRReports = function (equp_id) {
        var send = {};
        send = {equp_id: equp_id, action: "get_scr_reports_view"};
        $log.debug(send);
        baseFactory.reportsCall(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.sc_report_view = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.sc_report_view = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.viewSCRDetails = function (ev, scr_report) {
        var template_name = 'master/view_scr_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {scr_report: scr_report},
            controller: _eViewscrDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewscrDetails($scope, scr_report) {
        $log.warn(scr_report);
        var equp_id = scr_report.EID;
        $scope.loadSCRReports(equp_id);
    }

/*    $scope.addViability = function (viability) {
        if ($scope.searched.EID == null)
            $scope.viability.equp_id = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.viability.equp_id = $scope.searched.E_ID.E_ID;
        else
            $scope.viability.equp_id = "";
        viability.action = "add_viability";
        baseFactory.UserCtrl(viability)
            .then(function (payload) {
                    $log.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $state.go("home.viability");
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }*/

    $scope.addViability = function (viability)
    {
       /* if ($scope.searched.EID == null)
            viability.equp_id = "";
        else if (typeof $scope.searched.EID === 'object')
            viability.equp_id = $scope.searched.EID.E_ID;
        else
            viability.equp_id = "";*/
        viability.action = "add_viability";
        $log.info(JSON.stringify(viability));
	
        baseFactory.UserCtrl(viability)
        .then(function (payload)
        {
            console.log(payload);
            if (payload.response == $rootScope.successdata) {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
                $state.go("home.viability")
            }
            else if (payload.response == $rootScope.failedata) {
                $scope.toast_text = payload.call_back;
                $scope.showToast();
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.getViability = function (limit_val)
    {
        if (limit_val != $scope.nostate) {
            var viability;
            if (typeof limit_val === 'undefined')
                viability = 0;
            else if (limit_val == 0)
                viability = 0;
            else
                viability = limit_val - 1;
            $log.error(viability);
            var send = {limit_val: viability, action: "get_viability_list",branch_id:$scope.user_branch};
        }
        else
        {
            var send = {action: "get_viability_list",branch_id:$scope.user_branch};
        }
        console.log(send);
        baseFactory.UserCtrl(send)
        .then(function (payload)
        {
            console.log(payload);
            $log.debug(payload);
            if (payload.response == $rootScope.successdata)
            {
                $scope.viability_list = payload.list;
                $scope.paging.total = payload.rcnt;
                $scope.no_of_recs = payload.no_of_recs;
            }
            else if (payload.response == $rootScope.emptydata)
            {
                $scope.viability_list = null;
                $scope.paging.total = 0;
                $scope.no_of_recs = 0;

            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    };
    $scope.getStock= function (limit_val)
    {
        if (limit_val != $scope.nostate) {
            var stock;
            if (typeof limit_val === 'undefined')
                stock = 0;
            else if (limit_val == 0)
                stock = 0;
            else
                stock = limit_val - 1;
            $log.error(stock);
            $scope.stock_elements.limit_val = stock;
        }
        else
        {
            delete $scope.stock_elements.limit_val;
        }
        $scope.stock_elements.action= "get_stock_list";
        $scope.stock_elements.branch_id = $scope.user_branch;
        $log.warn($scope.stock_elements);
        console.log($scope.stock_elements);
        baseFactory.UserCtrl($scope.stock_elements)
        .then(function (payload)
        {
                $log.debug(payload);
                console.log(payload);
                if (payload.response == $rootScope.successdata)
                {
                    $scope.stock_lists = payload.list;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.stock_lists = null;
                    $scope.paging.total = 0;
                    $scope.no_of_recs = 0;

                }
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });
    };
    $scope.getViabilityTCPDF = function (limit_val)
    {
        $scope.getViability(limit_val);
        if($scope.viability_list!=null)
        {
            var loc = window.location.pathname;
            $log.log(loc);
            var dir = loc.substring(0, loc.lastIndexOf('/'));
            var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/viability_total_report_pdf';
            var word_data = angular.toJson($scope.viability_list);
            var send = {condem_data: word_data};
            console.log(send);
            var prev_data2 = angular.toJson(send);
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = post_to;
            form.target = '_blank'; // target the window
            // append it to body
            var body = document.getElementsByTagName('body')[0];
            body.appendChild(form);
            // create an element
            var child1 = document.createElement('input');
            child1.type = 'text'; // or 'hidden' it is the same
            child1.name = 'viability_data';
            child1.value = prev_data2;

            form.appendChild(child1);
            //window.open('', 'window_1');
            form.submit();
            body.removeChild(form);
        }
    };
    $scope.getStockTCPDF = function ()
    {
        $scope.getStock($scope.nostate);
            var loc = window.location.pathname;
            $log.log(loc);
            var dir = loc.substring(0, loc.lastIndexOf('/'));
            var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/stock_all_report_pdf';
            var send = $scope.stock_lists;
            console.log(send);
            var prev_data2 = angular.toJson(send);
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = post_to;
            form.target = '_blank'; // target the window
            // append it to body
            var body = document.getElementsByTagName('body')[0];
            body.appendChild(form);
            // create an element
            var child1 = document.createElement('input');
            child1.type = 'text'; // or 'hidden' it is the same
            child1.name = 'stocks_data';
            child1.value = prev_data2;

            form.appendChild(child1);
            //window.open('', 'window_1');
            form.submit();
            body.removeChild(form);
    };
    $scope.getStockCountTCPDF = function (bid)
    {
        var loc = window.location.pathname;
        $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/stock_total_report_pdf';
        var send = {branch_id: bid};
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'stock_data';
        child1.value = prev_data2;

        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
    $scope.getAdverseReportTCPDF = function(data)
    {
            var loc = window.location.pathname;
            $log.log(loc);
            var dir = loc.substring(0, loc.lastIndexOf('/'));
            var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/adverse_total_report_pdf';
            var word_data = data;
            var send = word_data;
            console.log(send);
            var prev_data2 = angular.toJson(send);
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = post_to;
            form.target = '_blank'; // target the window
            // append it to body
            var body = document.getElementsByTagName('body')[0];
            body.appendChild(form);
            // create an element
            var child1 = document.createElement('input');
            child1.type = 'text'; // or 'hidden' it is the same
            child1.name = 'adv_total_data';
            child1.value = prev_data2;

            form.appendChild(child1);
            //window.open('', 'window_1');
            form.submit();
            body.removeChild(form);
    };
    $scope.EditViability = function (ev, viability) {
        var template_name = 'user/view_viability_dialog';
        console.log("fhg");
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {viability: viability},
            controller: _eViewViabilityDetails
        }).then(function () {
            },
            function () {
            });
    };
    function _eViewViabilityDetails($scope, viability)
    {
        $scope.loadDepartments();
        $log.warn(viability);
        $scope.edit_viability=viability;
        var equp_id = viability.E_ID;
        //$scope.getViability(equp_id);
        $scope.getDepartmentDevices(viability.DEPT_ID);
        $scope.edit_viability.equp_id=viability.E_ID;
        $scope.edit_viability.dept_id=viability.DEPT_ID;
		 $scope.edit_viability.branch_id =viability.BRANCH_ID;
        $scope.edit_viability.cost_consumables=viability.COST_OF_CONSUMABLES;
        $scope.edit_viability.disposal_cost=viability.DISPOSABLE_COST;
        $scope.edit_viability.no_of_cases_daily=viability.NO_CASES_DONE_DAILY;
        $scope.edit_viability.charge_operation=viability.CHRGS_PER_OPE;
        $scope.edit_viability.no_of_oper_per_year=viability.NUM_OPER_PER_YEAR;
        $scope.edit_viability.revenu_year=viability.REV_PER_YEAR;
        $scope.edit_viability.Profit_over_one_year=viability.PROFIT_PER_YEAR;
        $scope.edit_viability.Profit_over_three_year=viability.PROFIT_THREE_YEARS;
        $scope.edit_viability.Code_of_operation=viability.CODE_OPERATION;
        $scope.edit_viability.justification=viability.JUSTIFICATION;
        $scope.edit_viability.advantages=viability.ADVANTAGES;
        $scope.edit_viability.tsebp=viability.TECH_SPECF_EQ_PURC;
    }
    $scope.UpdateViability = function (edit_viability)
    {
        edit_viability.action = "update_viability";
        $log.warn(edit_viability);
        baseFactory.UserCtrl(edit_viability)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $mdDialog.hide();
                        $scope.getViability();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
        $log.log(user_data);
    };
   /* $scope.getGatepassReportPDF = function (limit_val) /* Show Device Details with QR details */
   /* {
        if (limit_val != $scope.nostate) {
            var gate_pass;
            if (typeof limit_val === 'undefined')
                gate_pass = 0;
            else if (limit_val == 0)
                gate_pass = 0;
            else
                gate_pass = limit_val - 1;
            $log.error(gate_pass);
            var send = {limit_val: gate_pass, action: "get_gate_pass_list"};
        }
        else {
            var send = {action: "get_gate_pass_list"};
        }
        baseFactory.reportsCall(send)
            .then(function (payload) {
                $log.debug(payload);
                $log.info(payload);
                if (payload.response == $rootScope.successdata)
                {
                    $scope.gate_pass_news_pdf = angular.fromJson(payload.list);
                    var loc = window.location.pathname;
                    $log.log(loc);
                    var dir = loc.substring(0, loc.lastIndexOf('/'));
                    var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/gatepass_total_report_pdf';
                    var word_data = angular.toJson($scope.gate_pass_news_pdf);
                    var send = word_data;
                    console.log(send);
                    var prev_data2 = send;
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = post_to;
                    form.target = '_blank'; // target the window
                    // append it to body
                    var body = document.getElementsByTagName('body')[0];
                    body.appendChild(form);
                    // create an element
                    var child1 = document.createElement('input');
                    child1.type = 'text'; // or 'hidden' it is the same
                    child1.name = 'gatepass_total_data';
                    child1.value = prev_data2;

                    form.appendChild(child1);
                    //window.open('', 'window_1');
                    form.submit();
                    body.removeChild(form);
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.gate_pass_news_pdf = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };*/
	
	$scope.getGatepassReportPDF = function (data)
    {
        var loc = window.location.pathname;
        // $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/gatepass_total_report_pdf';
        $log.log(post_to);
        //var word_data = angular.toJson($scope.service_news_pdf);
        var word_data = data;
        var send = word_data;
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'gatepass_total_data';
        child1.value = prev_data2;
        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
	
    /*$scope.getCearReportPDF = function (limit_val) /* Show Device Details with QR details */
    /*{
        if (limit_val != $scope.nostate) {
            var cear;
            if (typeof limit_val === 'undefined')
                cear = 0;
            else if (limit_val == 0)
                cear = 0;
            else
                cear = limit_val - 1;
            $log.error(cear);
            var send = {limit_val: cear, action: "get_cear_list"};
        }
        else {
            var send = {action: "get_cear_list"};
        }
        baseFactory.reportsCall(send)
            .then(function (payload)
            {
                $log.info(payload);
                if (payload.response == $rootScope.successdata)
                {
                    $scope.cear_news_pdf = angular.fromJson(payload.list);
                    var loc = window.location.pathname;
                    $log.log(loc);
                    var dir = loc.substring(0, loc.lastIndexOf('/'));
                    var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/cear_total_report_pdf';
                    var word_data = angular.toJson($scope.cear_news_pdf);
                    var send = word_data;
                    console.log(send);
                    var prev_data2 = send;
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = post_to;
                    form.target = '_blank'; // target the window
                    // append it to body
                    var body = document.getElementsByTagName('body')[0];
                    body.appendChild(form);
                    // create an element
                    var child1 = document.createElement('input');
                    child1.type = 'text'; // or 'hidden' it is the same
                    child1.name = 'cear_total_data';
                    child1.value = prev_data2;
                    form.appendChild(child1);
                    //window.open('', 'window_1');
                    form.submit();
                    body.removeChild(form);
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.cear_news_pdf = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };*/
    /*$scope.getIndentReportPDF = function (limit_val) /* Show Device Details with QR details */
    /*{
        if (limit_val != $scope.nostate) {
            var indent;
            if (typeof limit_val === 'undefined')
                indent = 0;
            else if (limit_val == 0)
                indent = 0;
            else
                indent = limit_val - 1;
            $log.error(indent);
            var send = {limit_val: indent, action: "get_indent_equpiment_list",branch_id:$scope.user_branch};
        }
        else {
            var send = {action: "get_indent_equpiment_list",branch_id:$scope.user_branch};
        }
        baseFactory.UserCtrl(send)
            .then(function (payload)
            {
                $log.debug(payload);
                $log.info(payload);
                if (payload.response == $rootScope.successdata)
                {
                    $scope.indent_news_pdf = angular.fromJson(payload.list);
                    var loc = window.location.pathname;
                    $log.log(loc);
                    var dir = loc.substring(0, loc.lastIndexOf('/'));
                    var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/indent_total_report_pdf';
                    var word_data = angular.toJson($scope.indent_news_pdf);
                    var send = word_data;
                    console.log(send);
                    var prev_data2 = send;
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = post_to;
                    form.target = '_blank'; // target the window
                    // append it to body
                    var body = document.getElementsByTagName('body')[0];
                    body.appendChild(form);
                    // create an element
                    var child1 = document.createElement('input');
                    child1.type = 'text'; // or 'hidden' it is the same
                    child1.name = 'indent_total_data';
                    child1.value = prev_data2;
                    form.appendChild(child1);
                    //window.open('', 'window_1');
                    form.submit();
                    body.removeChild(form);
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.indent_news_pdf = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };*/
    $scope.getCearReportPDF = function (data)
    {
        var loc = window.location.pathname;
        // $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/cear_total_report_pdf';
        $log.log(post_to);
        //var word_data = angular.toJson($scope.service_news_pdf);
        var word_data = data;
        var send = word_data;
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'cear_total_data';
        child1.value = prev_data2;
        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
	
    $scope.getIndentReportPDF = function (data)
    {
        var loc = window.location.pathname;
        // $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/indent_total_report_pdf';
        $log.log(post_to);
        //var word_data = angular.toJson($scope.service_news_pdf);
        var word_data = data;
        var send = word_data;
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'indent_total_data';
        child1.value = prev_data2;
        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
  
   /* $scope.getCondeminationReportPDF = function (limit_val) /* Show Device Details with QR details */
  /* {
        if (limit_val != $scope.nostate) {
            var cond;
            if (typeof limit_val === 'undefined')
                cond = 0;
            else if (limit_val == 0)
                cond = 0;
            else
                cond = limit_val - 1;
            $log.error(indent);
            var send = {limit_val: cond, action: "get_condemnation_reports_pdf",branch_id:$scope.user_branch};
        }
        else {
            var send = {action: "get_condemnation_reports_pdf",branch_id:$scope.user_branch};
        }
        baseFactory.reportsCall(send)
            .then(function (payload)
            {
                $log.debug(payload);
                $log.info(payload);
                if(payload.response == $rootScope.successdata)
                {
                    $scope.cond_news_pdf = angular.fromJson(payload.condemnation);
                    var loc = window.location.pathname;
                    $log.log(loc);
                    var dir = loc.substring(0, loc.lastIndexOf('/'));
                    var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/condemination_total_report_pdf';
                    var word_data = angular.toJson($scope.cond_news_pdf);
                    var send = word_data;
                   // console.log(send);
                    var prev_data2 = send;
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = post_to;
                    form.target = '_blank'; // target the window
                    // append it to body
                    var body = document.getElementsByTagName('body')[0];
                    body.appendChild(form);
                    // create an element
                    var child1 = document.createElement('input');
                    child1.type = 'text'; // or 'hidden' it is the same
                    child1.name = 'cond_total_data';
                    child1.value = prev_data2;
                    form.appendChild(child1);
                    //window.open('', 'window_1');
                    form.submit();
                    body.removeChild(form);
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.cond_news_pdf = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    }; */
	
	$scope.getCondeminationReportPDF = function (data)
    {
        var loc = window.location.pathname;
        // $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/condemination_total_report_pdf';
        $log.log(post_to);
        //var word_data = angular.toJson($scope.service_news_pdf);
        var word_data = data;
        var send = word_data;
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'cond_total_data';
        child1.value = prev_data2;
        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
	
	$scope.getDeployementReportPDF = function (data)
    {
        var loc = window.location.pathname;
        // $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/deployment_total_report_pdf';
        $log.log(post_to);
        //var word_data = angular.toJson($scope.service_news_pdf);
        var word_data = data;
        var send = word_data;
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'deployement_total_data';
        child1.value = prev_data2;
        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
	
   /* $scope.getDeployementReportPDF = function (limit_val) /* Show Device Details with QR details */
    /*{
        if (limit_val != $scope.nostate) {
            var deployment;
            if (typeof limit_val === 'undefined')
                deployment = 0;
            else if (limit_val == 0)
                deployment = 0;
            else
                deployment = limit_val - 1;
            $log.error(deployment);
            var send = {limit_val: deployment, action: "get_deployment_reports"};
        }
        else {
            var send = {action: "get_deployment_reports"};
        }
        baseFactory.reportsCall(send)
            .then(function (payload)
            {
                console.log(payload);
                $log.info(payload);
                if(payload.response == $rootScope.successdata)
                {
                    $scope.deployement_news_pdf = angular.fromJson(payload.deployment_report);
					console.log($scope.deployement_news_pdf);
                    var loc = window.location.pathname;
                    $log.log(loc);
                    var dir = loc.substring(0, loc.lastIndexOf('/'));
                    var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/deployment_total_report_pdf';
                    var word_data = angular.toJson($scope.deployement_news_pdf);
                    var send = word_data;
                    console.log(send);
                    var prev_data2 = send;
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = post_to;
                    form.target = '_blank'; // target the window
                    // append it to body
                    var body = document.getElementsByTagName('body')[0];
                    body.appendChild(form);
                    // create an element
                    var child1 = document.createElement('input');
                    child1.type = 'text'; // or 'hidden' it is the same
                    child1.name = 'deployement_total_data';
                    child1.value = prev_data2;
                    form.appendChild(child1);
                    //window.open('', 'window_1');
                    form.submit();
                    body.removeChild(form);
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.deployement_news_pdf = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };*/
    /*$scope.RegetDeployementReportPDF = function (limit_val) /* Show Device Details with QR details */
   /* {
        if (limit_val != $scope.nostate) {
            var deployment;
            if (typeof limit_val === 'undefined')
                deployment = 0;
            else if (limit_val == 0)
                deployment = 0;
            else
                deployment = limit_val - 1;
            $log.error(deployment);
            var send = {limit_val: deployment, action: "get_deployment_reports",branch_id:$scope.user_branch};
        }
        else {
            var send = {action: "get_deployment_reports",branch_id:$scope.user_branch};
        }
        baseFactory.reportsCall(send)
            .then(function (payload)
            {
               // $log.debug(payload);
               // $log.info(payload);
                if(payload.response == $rootScope.successdata)
                {
                    $scope.redeployement_news_pdf = angular.fromJson(payload.deployment_report);
                    var loc = window.location.pathname;
                    $log.log(loc);
                    var dir = loc.substring(0, loc.lastIndexOf('/'));
                    var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/Redeployment_total_report_pdf';
                    var word_data = angular.toJson($scope.redeployement_news_pdf);
                    var send = word_data;
                    console.log(send);
                    var prev_data2 = send;
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = post_to;
                    form.target = '_blank'; // target the window
                    // append it to body
                    var body = document.getElementsByTagName('body')[0];
                    body.appendChild(form);
                    // create an element
                    var child1 = document.createElement('input');
                    child1.type = 'text'; // or 'hidden' it is the same
                    child1.name = 'redeployement_total_data';
                    child1.value = prev_data2;
                    form.appendChild(child1);
                    //window.open('', 'window_1');
                    form.submit();
                    body.removeChild(form);
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.redeployement_news_pdf = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };*/
	
	$scope.RegetDeployementReportPDF = function (data)
    {
        var loc = window.location.pathname;
        // $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/Redeployment_total_report_pdf';
        $log.log(post_to);
        //var word_data = angular.toJson($scope.service_news_pdf);
        var word_data = data;
        var send = word_data;
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'redeployement_total_data';
        child1.value = prev_data2;
        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };	

    $scope.service_news_pdf = {};
    /*$scope.RegetServiceReportPDF = function (limit_val) /* Show Device Details with QR details */
    /*{
        if (limit_val != $scope.nostate) {
            var service;
            if (typeof limit_val === 'undefined')
                service = 0;
            else if (limit_val == 0)
                service = 0;
            else
                service = limit_val - 1;
            $log.error(service);
            var send = {limit_val: service, action: "get_deployment_reports_pdf"};
        }
        else {
            var send = {action: "get_deployment_reports_pdf"};
        }
        baseFactory.reportsCall(send)
            .then(function (payload)
            {
                $log.debug(payload);
                console.log(payload);
                if(payload.response == $rootScope.successdata)
                {
                    $scope.service_news_pdf = angular.fromJson(payload.list);
                    console.log($scope.service_news_pdf);
                    var loc = window.location.pathname;
                    $log.log(loc);
                    var dir = loc.substring(0, loc.lastIndexOf('/'));
                    var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/services_total_report_pdf';
                    var word_data = angular.toJson($scope.service_news_pdf);
                   // console.log(word_data);
                    var send = word_data;
                    console.log(send);
                    var prev_data2 = send;
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = post_to;
                    form.target = '_blank'; // target the window
                    // append it to body
                    var body = document.getElementsByTagName('body')[0];
                    body.appendChild(form);
                    // create an element
                    var child1 = document.createElement('input');
                    child1.type = 'text'; // or 'hidden' it is the same
                    child1.name = 'service_total_data';
                    child1.value = prev_data2;
                    form.appendChild(child1);
                    //window.open('', 'window_1');
                    form.submit();
                    body.removeChild(form);
                }
                else if (payload.response == $rootScope.emptydata)
                {
                    $scope.service_news_pdf = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
            });
    };*/
	
	$scope.RegetServiceReportPDF = function (data)
    {
        var loc = window.location.pathname;
        // $log.log(loc);
        var dir = loc.substring(0, loc.lastIndexOf('/'));
        var post_to = window.location.protocol + '//' + window.location.hostname + dir + '/reports/services_total_report_pdf';
        $log.log(post_to);
        //var word_data = angular.toJson($scope.service_news_pdf);
        var word_data = data;
        var send = word_data;
        console.log(send);
        var prev_data2 = angular.toJson(send);
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = post_to;
        form.target = '_blank'; // target the window
        // append it to body
        var body = document.getElementsByTagName('body')[0];
        body.appendChild(form);
        // create an element
        var child1 = document.createElement('input');
        child1.type = 'text'; // or 'hidden' it is the same
        child1.name = 'service_total_data';
        child1.value = prev_data2;
        form.appendChild(child1);
        //window.open('', 'window_1');
        form.submit();
        body.removeChild(form);
    };
	
	
    $scope.qcSelectEq = function (sub_menu, list)
    {
        var idx = list.indexOf(sub_menu);
        if (idx > -1)
        {
            list.splice(idx, 1);
        }
        else
        {
            list.push(sub_menu);
        }
        $log.warn($scope.qc_eq_selected);
    };
    $scope.pmsSelectEq = function (sub_menu, list)
    {
        var idx = list.indexOf(sub_menu);
        if (idx > -1)
        {
            list.splice(idx, 1);
        }
        else
        {
            list.push(sub_menu);

        }
        $log.warn($scope.pms_eq_selected);
    };
    $scope.addtoStock = function(data)
    {
        $log.log(data);
        $scope.add_device = data;
        $scope.getContractVendorDetails(data.VENDOR_ID);
        $scope.add_device.device_name = data.EQ_NAME;
        $scope.add_device.cat = data.EQ_CAT;
        $scope.add_device.company_name = data.MAKE_ID;
        $scope.add_device.department = data.DEPT;
        $scope.add_device.device_model = null;
        $scope.add_device.device_cost = data.COST/data.QTY;
        $scope.add_device.present_condition = "G";
        $scope.add_device.accessories = data.ACCESSORIES;
        $scope.add_device.critical_spares = data.SPARES;
        $scope.add_device.distributor = $scope.add_device.vendor = data.VENDOR_ID;
        $scope.add_device.po_number = data.PO_NO;
        $scope.add_device.grn_no = data.INV_NO;
        $state.go("home.add_stock");
    };
    $scope.switchState = function(state_data)
    {
        $state.go(state_data);
    };

    $scope.vendor_call = function (vendor_select){
        var vendor_select = {action:"vendor_home_page",role_code:$scope.user_role_code,user_id:$scope.user_id}
        console.log(vendor_select);
        baseFactory.UserCtrl(vendor_select)
            .then(function(payload)
            {
                $state.go("home.vendor_add_asset");
            })
       // $state.go(state_data);

    };

    $scope.addCountry = function(add_country)
    {
        add_country.action = "add_country";
        console.log(add_country);
        baseFactory.UserCtrl(add_country)
            .then(function(payload){
                    console.log(payload);
                    if(payload.response==$rootScope.successdata)
                    {
                        $scope.showToastText(payload.call_back);
                        $scope.add_country = {};
                        $state.go("home.haadmin_countries");
                    }
                    else
                    {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function(errorPayload)
                {
                    $log.error('loading failure',errorPayload);
                });
    }

    $scope.addCitiesLabels = function(add_city_label)
    {
        add_city_label.action = "add_city_label";
        console.log(add_city_label);
        baseFactory.Mainadmin(add_city_label)
            .then(function(payload){
                    console.log(payload);
                    if(payload.response==$rootScope.successdata)
                    {
                        $scope.showToastText(payload.call_back);
                        $state.go("home.haadmin_cities_label");
                    }
                    else
                    {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function(errorPayload)
                {
                    $log.error('loading failure',errorPayload);
                });
    }
    $scope.addCountryLabel = function(add_country_label)
    {
        add_country_label.action = "add_country_label";
        console.log(add_country_label);
        baseFactory.Mainadmin(add_country_label)
            .then(function(payload){
                    console.log(payload);
                    if(payload.response==$rootScope.successdata)
                    {
                        $scope.showToastText(payload.call_back);
                        //$scope.add_country = {};
                        $state.go("home.haadmin_countries_label");
                    }
                    else
                    {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function(errorPayload)
                {
                    $log.error('loading failure',errorPayload);
                });
    }
    $scope.addStateLabels = function(add_state_label)
    {
        add_state_label.action = "add_state_label";
        console.log(add_state_label);
        baseFactory.Mainadmin(add_state_label)
            .then(function(payload){
                    console.log(payload);
                    if(payload.response==$rootScope.successdata)
                    {
                        $scope.showToastText(payload.call_back);
                        //$scope.add_country = {};
                        $state.go("home.haadmin_states_label");
                    }
                    else
                    {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function(errorPayload)
                {
                    $log.error('loading failure',errorPayload);
                });
    }
	
	$scope.getorgmastertable = function(data)
	{
		var send = {action:"get_org_master_table",db_field:data};
		send.org_module = $scope.user_org_module;
		console.log(send);
		 baseFactory.Mainadmin(send)
            .then(function (payload) {
				console.log(payload);
				//return false;
				if (payload.response == $rootScope.successdata) {
					$scope.dropdown_master = angular.fromJson(payload.list);
						
					}
                    else if (payload.response == $rootScope.emptydata) {
						$scope.dropdown_master = null;
					}
				},
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
                   
	};
	
	
	$scope.getitemmaster = function (send)
    {

        var send = {action:"get_item_master"};
         send.org_module = $scope.user_org_module;
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.item_master = angular.fromJson(payload.list);
						console.log($scope.item_master);
						/*$scope.array = $scope.item_master.OPT_ARR;
						console.log($scope.array);
						$scope.item_masterss = $scope.view_dynamic($scope.item_masters,2);*/
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.item_master = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	

    $scope.loadhospital = function (user_id) {
        var send ={action:"get_hospitals_vendor",user_id:user_id}
        baseFactory.Mainadmin(send)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.hospitals_vendor = angular.fromJson(payload.list);
                        $log.debug($scope.hospitals);
                    }
                    else {
                        $scope.hospitals = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.addOrgRoles=function(add_org_role)
    {
		
        var pushThese = function(ar){
            ar.forEach(function(e){
                if(e.selected) $scope.recursiveChecked.push(e);
            });
        }
        $scope.recursiveChecked = [];
        pushThese($scope.orgfeatures);
       // add_org_role.featuers = $scope.recursiveChecked;
        add_org_role.featuers = $scope.orgfeatures;
        add_org_role.action="add_org_role";
        baseFactory.Mainadmin(add_org_role)
        .then(function(payload)
        {
            $log.debug(payload);
			console.log(payload);
			
            if (payload.response == $rootScope.successdata)
            {
                $scope.showToastText(payload.call_back);
                //add_org_role = {};
                //$scope.sub_features_selected = [];
                //$scope.features_selected = [];
                
                window.location.href="#/home/org_roles";
                //$state.go('home.org_roles');
            }
            else {
                $scope.showToastText(payload.call_back);
            }
        },function(errorpayload) {
                $log.log('failure loading', errorpayload);
        })
    };
    $scope.getOrgRoleFeatures = function(role_code)
    {
        send = {};
        send.role_code=role_code;
        send.action="get_org_role_features";
        baseFactory.Mainadmin(send)
            .then(function(payload) {
                $log.log("get_org_role_features");
                $log.log(payload);
                if (payload.response == $rootScope.successdata)
                {
                    $scope.role_all_features = angular.fromJson(payload.list);
                }
                else
                {
                    $scope.role_all_features = null;
                }
            },function(errorpayload) {
                $log.log('failure loading', errorpayload);
            })
    };
    /*$scope.editOrgroles = function (ev, edit_org_roles){
        var template_name = 'mainadmin/edit_org_roles';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {edit_org_roles: edit_org_roles},
            controller: _eRolecodeController
        })
    };
    function _eRolecodeController($scope, edit_org_roles)
    {
        
       $scope.getOrgRoleFeatures(edit_org_roles.ROLE_CODE);
       $scope.edit_orgrole=edit_org_roles;
       $scope.edit_orgrole.role_name=edit_org_roles.ROLE_NAME;
       $scope.edit_orgrole.role_code=edit_org_roles.ROLE_CODE;
       $scope.edit_orgrole.erole_code=edit_org_roles.EROLE_CODE;
       $scope.edit_orgrole.indent_req=edit_org_roles.INDENT_REQ;
       $scope.edit_orgrole.indent_approve=edit_org_roles.INDENT_APRV;
       $scope.edit_orgrole.cear_req=edit_org_roles.CEAR_ADD;
       $scope.edit_orgrole.cear_approve=edit_org_roles.CEAR_APRV;
       $scope.edit_orgrole.pur_req=edit_org_roles.PUR_ADD;
       $scope.edit_orgrole.pur_approve=edit_org_roles.PUR_APRV;
       $scope.edit_orgrole.pur_status_update=edit_org_roles.PUR_UPDATE;
       $scope.edit_orgrole.add_device=edit_org_roles.ADD_EQ;
       $scope.edit_orgrole.edit_device=edit_org_roles.UPDATE_EQ;
       $scope.edit_orgrole.gate_pass_edit=edit_org_roles.GP_UPDATE;
       $scope.edit_orgrole.other_unit=edit_org_roles.TRANSFER_OUNIT;
       $scope.edit_orgrole.with_in_unit=edit_org_roles.TRANSFER_WUNIT;
       $scope.edit_orgrole.condem_req=edit_org_roles.CNDM_REQ;
       $scope.edit_orgrole.condem_approve=edit_org_roles.CNDM_APRV;
       $scope.edit_orgrole.condem_close=edit_org_roles.CNDM_CLOSE;
       $scope.edit_orgrole.qr_label=edit_org_roles.PRINT_QR;
       $scope.edit_orgrole.pms_cal_label=edit_org_roles.PRINT_PMSCAL;
       $scope.edit_orgrole.add_contract=edit_org_roles.CNTRCT_ADD;
       $scope.edit_orgrole.renew_contract=edit_org_roles.CNTRCT_RENEW;
       $scope.edit_orgrole.close_contract=edit_org_roles.CNTRCT_CLOSE;
       $scope.edit_orgrole.add_incident=edit_org_roles.ADVRS_ADD;
       $scope.edit_orgrole.approve_incident=edit_org_roles.ADVRS_APRV;
       $scope.edit_orgrole.close_incident=edit_org_roles.ADVRS_CLOSE;
       $scope.edit_orgrole.viability_generate=edit_org_roles.VIABIL_ADD;
       $scope.edit_orgrole.viability_approve=edit_org_roles.VIABIL_APRV;
       $scope.edit_orgrole.ns_show=edit_org_roles.NS_SHOW;
       $scope.edit_orgrole.pms_show=edit_org_roles.PMS_SHOW;
       $scope.edit_orgrole.calibration_show=edit_org_roles.CALIB_SHOW;
       $scope.edit_orgrole.training_create=edit_org_roles.TRING_ADD;
       $scope.edit_orgrole.training_approve=edit_org_roles.TRING_APRV;
       $scope.edit_orgrole.erole_code=edit_org_roles.EROLE_CODE;
       $scope.edit_orgrole.actual_list=angular.fromJson(edit_org_roles.ACTUAL_FEARTURES_LIST);
       $scope.total_list = angular.fromJson($scope.edit_orgrole.actual_list);
	   $scope.toggleAll1 = function() {
			console.log("test");
			$scope.AllSelected = !$scope.AllSelected;
			angular.forEach($scope.total_list, function(itm){ 						
				angular.forEach(itm.subfeatures, function(itm1){ 
					itm1.selected = $scope.AllSelected; 
					itm.selected = $scope.AllSelected; 
					angular.forEach(itm1.subsubfeatures, function(itm2){ 
						itm2.selected = $scope.AllSelected; 
					});
				});
			});
		}
		$scope.clicker = function(option) {
            angular.forEach(option.subfeatures, function(value, key) {
                value.selected = option.selected;
                angular.forEach(value.subsubfeatures, function(value1, key1) {
                    value1.selected = value.selected;
                });


            });
        };
        $scope.clicker1 = function(option) {
            angular.forEach(option.subsubfeatures, function(value, key) {
                value.selected = option.selected;
            });
        };
    };*/
	
	
	
	
	$scope.db_org_ft_list = {};
    $scope.EditOrgrole = function(ev,edit_org_roles){

        $scope.edit_orgrole=edit_org_roles;
        $scope.edit_orgrole.role_name=edit_org_roles.ROLE_NAME;
        $scope.edit_orgrole.role_code=edit_org_roles.ROLE_CODE;
        $scope.edit_orgrole.erole_code=edit_org_roles.EROLE_CODE;
        $scope.edit_orgrole.indent_req=edit_org_roles.INDENT_REQ;
        $scope.edit_orgrole.indent_approve=edit_org_roles.INDENT_APRV;
        $scope.edit_orgrole.cear_req=edit_org_roles.CEAR_ADD;
        $scope.edit_orgrole.cear_approve=edit_org_roles.CEAR_APRV;
        $scope.edit_orgrole.pur_req=edit_org_roles.PUR_ADD;
        $scope.edit_orgrole.pur_approve=edit_org_roles.PUR_APRV;
        $scope.edit_orgrole.pur_status_update=edit_org_roles.PUR_UPDATE;
        $scope.edit_orgrole.add_device=edit_org_roles.ADD_EQ;
        $scope.edit_orgrole.edit_device=edit_org_roles.UPDATE_EQ;
        $scope.edit_orgrole.gate_pass_edit=edit_org_roles.GP_UPDATE;
        $scope.edit_orgrole.other_unit=edit_org_roles.TRANSFER_OUNIT;
        $scope.edit_orgrole.with_in_unit=edit_org_roles.TRANSFER_WUNIT;
        $scope.edit_orgrole.condem_req=edit_org_roles.CNDM_REQ;
        $scope.edit_orgrole.condem_approve=edit_org_roles.CNDM_APRV;
        $scope.edit_orgrole.condem_close=edit_org_roles.CNDM_CLOSE;
        $scope.edit_orgrole.qr_label=edit_org_roles.PRINT_QR;
        $scope.edit_orgrole.pms_cal_label=edit_org_roles.PRINT_PMSCAL;
        $scope.edit_orgrole.add_contract=edit_org_roles.CNTRCT_ADD;
        $scope.edit_orgrole.renew_contract=edit_org_roles.CNTRCT_RENEW;
        $scope.edit_orgrole.close_contract=edit_org_roles.CNTRCT_CLOSE;
        $scope.edit_orgrole.add_incident=edit_org_roles.ADVRS_ADD;
        $scope.edit_orgrole.approve_incident=edit_org_roles.ADVRS_APRV;
        $scope.edit_orgrole.close_incident=edit_org_roles.ADVRS_CLOSE;
        $scope.edit_orgrole.viability_generate=edit_org_roles.VIABIL_ADD;
        $scope.edit_orgrole.viability_approve=edit_org_roles.VIABIL_APRV;
        $scope.edit_orgrole.ns_show=edit_org_roles.NS_SHOW;
        $scope.edit_orgrole.pms_show=edit_org_roles.PMS_SHOW;
        $scope.edit_orgrole.calibration_show=edit_org_roles.CALIB_SHOW;
        $scope.edit_orgrole.training_create=edit_org_roles.TRING_ADD;
        $scope.edit_orgrole.training_approve=edit_org_roles.TRING_APRV;
        $scope.edit_orgrole.erole_code=edit_org_roles.EROLE_CODE;

        $scope.total_org_list = angular.fromJson(edit_org_roles.ROLE_FEATURES);
        $scope.db_org_ft_list = $scope.total_org_list.menu;
        $scope.get_existing_orgfeatures_list(edit_org_roles.ORG_ID,edit_org_roles.ROLE_AID);

        $scope.toggleAll1 = function() {
            $scope.AllSelected = !$scope.AllSelected;
            angular.forEach($scope.list1, function(itm){
                angular.forEach(itm.subfeatures, function(itm1){
                    itm1.selected = $scope.AllSelected;
                    itm.selected = $scope.AllSelected;
                    angular.forEach(itm1.subsubfeatures, function(itm2){
                        itm2.selected = $scope.AllSelected;
                    });
                });
            });
        }
        $scope.editroleclicker = function(option) {
            angular.forEach(option.subfeatures, function(value, key) {
                value.selected = option.selected;
                angular.forEach(value.subsubfeatures, function(value1, key1) {
                    value1.selected = value.selected;
                });
            });
        };
        $scope.editroleclicker1 = function(option) {
            angular.forEach(option.subsubfeatures, function(value, key) {
                value.selected = option.selected;
            });
        };

        $state.go('home.edit_org_roles');
    };
	$scope.get_existing_orgfeatures_list = function (ORG_ID,role_id) {
        var data = {};
        data.org_id = ORG_ID;
        data.role_id = role_id;
        data.action = "get_existing_org_features_list";
		console.clear();
		console.log($scope.db_org_ft_list);
        baseFactory.Mainadmin(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata){
                        $scope.list1 = angular.fromJson(payload.list);
                        var i = j = k = 0;
                        
                        /*
                        for(i = 0 ; i < $scope.db_org_ft_list.length; i++){
                            if($scope.db_org_ft_list[i] != undefined)
                            $scope.list1[i].selected = $scope.db_org_ft_list[i].selected;
                            for(j = 0; j < $scope.list1[i].subfeatures.length ; j++){
                                if($scope.db_org_ft_list[i].subfeatures[j] != undefined)
                                $scope.list1[i].subfeatures[j].selected = $scope.db_org_ft_list[i].subfeatures[j].selected;
                                for(k = 0; k < $scope.list1[i].subfeatures[j].subsubfeatures.length; k++  )
                                {
                                    if($scope.db_org_ft_list[i].subfeatures[j].subsubfeatures[k] != undefined)
                                    $scope.list1[i].subfeatures[j].subsubfeatures[k].selected = $scope.db_org_ft_list[i].subfeatures[j].subsubfeatures[k].selected;
                                }
                            }
                        }
                        */
                        
                        for(i=0 ; i < $scope.list1.length; i++) {
                            if ($scope.db_org_ft_list[i] != undefined)
                                $scope.list1[i].selected = $scope.db_org_ft_list[i].selected;
                            if ($scope.db_org_ft_list[i].hasOwnProperty($scope.db_org_ft_list[i].subfeatures) != undefined)
                            for (j = 0; j < $scope.list1[i].subfeatures.length; j++) {
                                if ($scope.db_org_ft_list[i].subfeatures[j] != undefined) {
                                    $scope.list1[i].subfeatures[j].selected = $scope.db_org_ft_list[i].subfeatures[j].selected;
                                    if ($scope.db_org_ft_list[i].subfeatures[j].subsubfeatures != undefined) {
                                        for (k = 0; k < $scope.list1[i].subfeatures[j].subsubfeatures.length; k++) {
                                            if ($scope.db_org_ft_list[i].subfeatures[j].subsubfeatures[k] != undefined) {
                                                $scope.list1[i].subfeatures[j].subsubfeatures[k].selected = $scope.db_org_ft_list[i].subfeatures[j].subsubfeatures[k].selected;
                                            } else {
                                                $scope.list1[i].subfeatures[j].subsubfeatures[k].selected = "false";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        
                        
                    }else{
                        $scope.list1 = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.updateOrgRoles=function(edit_org_role)
    {
       $scope.Checked = [];
        var pushThese = function(ar){
            ar.forEach(function(e){
                if(e.selected) $scope.Checked.push(e);
            });
        }
        pushThese($scope.list1);
        //edit_org_role.features = $scope.Checked;
        edit_org_role.features = $scope.list1;
        edit_org_role.action="get_edit_org_roles";
        baseFactory.Mainadmin(edit_org_role)
            .then(function(payload){
				console.log(payload);
                if(payload.response==$rootScope.successdata)
                {
                    $scope.showToastText(payload.call_back);
                    $state.go('home.org_roles');
					//$scope.getOrgRoles();
                }
                else {
                    $scope.showToastText(payload.call_back);
                }
            },function(errorpayload){
                $log.debug('failure loading',errorpayload);
            })
    };
    $scope.getEquipmentsByCatAndBranch = function(unit,e_cat)
    {
        var data = {};
        data.action = "get_equps_by_unit_ecat";
        data.e_cat = e_cat;
        data.branch_id = unit;
        baseFactory.deviceCall(data)
        .then(function (payload)
        {
            $log.debug(payload);
            if (payload.response == $rootScope.successdata)
            {
                $scope.ue_devices = angular.fromJson(payload.list);
            }
            else if (payload.response == $rootScope.emptydata)
            {
                $scope.ue_devices = null;
            }
        },
        function (errorPayload) {
            $log.error('failure loading', errorPayload);
        });
    }


    $scope.changePendingReason = function(pr)
    {
        $log.log(pr);
        if(pr!="")
        {
            $scope.mpending_device_dtls.REMARKS = "Pending";
        }
        else
        {
            $scope.mpending_device_dtls.REMARKS = "Completed";
        }
    }
    $scope.loadCondemenationNewRequest = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var conreq;
            if (typeof limit_val === 'undefined')
                conreq = 0;
            else if (limit_val == 0)
                conreq = 0;
            else
                conreq = limit_val - 1;
            $log.error(conreq);
            $scope.condimnation_search_new.limit_val = conreq;
        }
        else {
            delete $scope.condimnation_search_new.limit_val;
        }
        $scope.condimnation_search_new.action = "get_con_new_request_list";
        $log.error('Hello');
        $log.debug($scope.condimnation_search_new);
        $log.debug($scope.condimnation_search_new);
        baseFactory.UserCtrl($scope.condimnation_search_new)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.condemination_news = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.condemination_news = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadGatepassNew = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var gate_pass;
            if (typeof limit_val === 'undefined')
                gate_pass = 0;
            else if (limit_val == 0)
                gate_pass = 0;
            else
                gate_pass = limit_val - 1;
            $log.error(gate_pass);
            $scope.gatepass_search_new.limit_val = gate_pass;
        }
        $scope.gatepass_search_new.action = "get_gate_pass_new_list";
        $scope.gatepass_search_new.branch_id = $scope.user_branch;
        $log.log("gatepass Req.");
        $log.log($scope.gatepass_search_new);
        baseFactory.UserCtrl($scope.gatepass_search_new)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.gate_pass_news = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.gate_pass_news = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.getViabilityNew = function (limit_val)
    {
        $log.error("Hello");
        if (limit_val != $scope.nostate) {
            var viability;
            if (typeof limit_val === undefined)
                viability = 0;
            else if (limit_val == 0)
                viability = 0;
            else
                viability = limit_val - 1;
            $log.error(viability);
           $scope.viability_search_new.limit_val =viability;
        }
         $scope.viability_search_new.action= "get_viability_new_list";
        $log.error($scope.viability_search_new);
        baseFactory.UserCtrl($scope.viability_search_new)
            .then(function (payload)
                { //$log.error("Hello",payload);
                    $log.debug(payload);
                    $log.debug("Viabilty");
                    if (payload.response == $rootScope.successdata)
                    {
                        $scope.viability_list = payload.list;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata)
                    {
                        $scope.viability_list = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;

                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadTransferUnitsNew = function (limit_val, get_admin_calls) /* For transfer */ {
        //$scope.transfer_search.branch_id = $scope.user_branch;
        $log.warn("Branch:" + $scope.user_branch);
        if (limit_val != $scope.nostate) {
            var transfers;
            if (typeof limit_val === 'undefined')
                transfers = 0;
            else if (limit_val == 0)
                transfers = 0;
            else
                transfers = limit_val - 1;
            $log.error(transfers);
            $scope.transfer_search_new.limit_val = transfers;
        }
        else {
            delete $scope.transfer_search.limit_val;
        }
        $log.debug($scope.transfer_search.limit_val);
        $scope.transfer_search_new.action = "get_tansfer_new_list";
        if (typeof get_admin_calls != "undefined") {
            if (get_admin_calls == "get_admin_calls" || get_admin_calls == "get_hod_calls")
                $scope.transfer_search_new.aaction = get_admin_calls;
            else {
                delete $scope.transfer_search_new.aaction;
            }
        }
        else {
            delete $scope.transfer_search_new.aaction;
        }
        $log.log("Transfer Req.");
        $log.log($scope.transfer_search_new);
        baseFactory.UserCtrl($scope.transfer_search_new)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.trnsfers_new = $scope.trnsfers_new = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.trnsfers_new = $scope.trnsfers_new = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadCearNew = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var transfers;
            if (typeof limit_val === 'undefined')
                transfers = 0;
            else if (limit_val == 0)
                transfers = 0;
            else
                transfers = limit_val - 1;
            $log.error(transfers);
            $scope.cear_search_new.limit_val = transfers;
        }
        else {
            delete $scope.cear_search_new.limit_val;
        }
        $log.debug($scope.cear_search_new.limit_val);
        $scope.cear_search_new.action = "get_cear_new_list";
        $log.debug($scope.cear_search_new);
        baseFactory.UserCtrl($scope.cear_search_new)
            .then(function (payload) {
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.cear_list_new = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                        $scope.category = payload.category;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.cear_list_new = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadGatepass = function (limit_val) /* For Contracts */ {
        if (limit_val != $scope.nostate) {
            var gate_pass;
            if (typeof limit_val === 'undefined')
                gate_pass = 0;
            else if (limit_val == 0)
                gate_pass = 0;
            else
                gate_pass = limit_val - 1;
            $log.error(gate_pass);
            var send = {limit_val: gate_pass, action: "get_gate_pass_new_list",branch_id:$scope.user_branch};
        }
        else {
            var send = {action: "get_gate_pass_new_list",branch_id:$scope.user_branch};
        }
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    $log.debug(payload);
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.gate_pass_news = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.gate_pass_news = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadIndentNew = function (limit_val) /* For Contracts */
    {
        if (limit_val != $scope.nostate)
        {
            var indent_equp;
            if (typeof limit_val === 'undefined')
                indent_equp = 0;
            else if (limit_val == 0)
                indent_equp = 0;
            else
                indent_equp = limit_val - 1;
            $scope.indent_search_new.limit_val = indent_equp;
        }
        else
        {
            delete $scope.indent_search_new.limit_val;
        }
        $scope.indent_search_new.action= "get_indent_new_list";
        $log.error($scope.indent_search_new);
        baseFactory.UserCtrl($scope.indent_search_new)
            .then(function (payload)
                {
                    $log.debug("get_indent_new_list");
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata)
                    {
                        $log.debug("get_indent_new_list");
                        $scope.indent_equps_new = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata)
                    {
                        $scope.indent_equps_new = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadRoundCompletedNew = function (limit_val) /* Training By Details */ {
        if (limit_val != $scope.nostate) {
            var crounds;
            if (typeof limit_val === 'undefined')
                crounds = 0;
            else if (limit_val == 0)
                crounds = 0;
            else
                crounds = limit_val - 1;
            $log.error(crounds);
            $scope.rounds_search_new.limit_val = crounds;
        }
        else {
            delete $scope.rounds_search_new.limit_val;
        }
        $scope.rounds_search_new.action = "get_complete_round_new";
        $log.debug($scope.rounds_search_new.action);
        $log.debug($scope.rounds_search_new);
        baseFactory.deviceCall($scope.rounds_search_new)
            .then(function (payload) {
                    $log.debug($scope.rounds_search_new.action);
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.round_complets_new = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.round_complets_new = null;
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadMaintanceContractsNew = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var mcontracts;
            if (typeof limit_val === 'undefined')
                mcontracts = 0;
            else if (limit_val == 0)
                mcontracts = 0;
            else
                mcontracts = limit_val - 1;
            $log.error(mcontracts);
            $scope.contracts_search_new.limit_val = mcontracts;
        }
        else {
            delete $scope.contracts_search_new.limit_val;
        }
        $scope.contracts_search_new.action = "get_m_contracts_new";
        $log.error("get Contracts");
        $log.info($scope.contracts_search_new);
        baseFactory.deviceCall($scope.contracts_search_new)
            .then(function (payload) {
                    $log.info(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.m_contracts = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.m_contracts = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });

        $scope.getContractsCount();
    };
    $scope.UndeployedDevicesnew = function (limit_val) {
        if (typeof limit_val === 'undefined')
            $scope.install_search_new.limit_val = 0;
        else if (limit_val == 0)
            $scope.install_search_new.limit_val = 0;
        else
            $scope.install_search_new.limit_val = limit_val - 1;
        $log.error($scope.install_search_new.limit_val);
        $scope.install_search_new.action = "get_undeployed_new_equipments";
        $log.log($scope.install_search_new);
        baseFactory.deviceCall($scope.install_search_new)
            .then(function (payload) {
                    $log.error(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.ud_devices = angular.fromJson(payload.list);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.ud_devices = null;
                        $scope.paging.total = $scope.paging.current = $scope.no_of_recs = 0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.getSCCallsNew = function (limit_val) /* Show Device Details with QR details */ {
        if (limit_val != $scope.nostate) {
            var lm;
            if (typeof limit_val === 'undefined')
                lm = 0;
            else if (limit_val == 0)
                lm = 0;
            else
                lm = limit_val - 1;
            $scope.non_sheduled_search_new.limit_val = lm;
        }
        else {
            delete $scope.non_sheduled_search_new.limit_val;
        }
        $scope.non_sheduled_search_new.action = "get_scr_calls_new";
        $log.debug($scope.non_sheduled_search_new);
        baseFactory.deviceCall($scope.non_sheduled_search_new)
            .then(function (payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.scr_calls_news = angular.fromJson(payload.list);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.scr_reports = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.scr_calls_news = payload.no_of_recs;
                }
            });
    };

    $scope.SearchCompletedPmsnew = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var completedpms;
            if (typeof limit_val === 'undefined')
                completedpms = 0;
            else if (limit_val == 0)
                completedpms = 0;
            else
                completedpms = limit_val - 1;
            $log.error(completedpms);
            $scope.sheduled_search_new.limit_val = completedpms;
        }
        else {
            delete $scope.sheduled_search_new.limit_val;
        }
        if ($scope.user_role_code == $scope.HBBME)
            $scope.sheduled_search_new.action = "get_completed_bmepms_new";
        else if ($scope.user_role_code == $scope.HBHOD)
            $scope.sheduled_search_new.action = "get_complete_hodpms_new";
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.sheduled_search_new.action = "get_complete_hodpms_new";
        $log.debug($scope.sheduled_search_new);
        baseFactory.deviceCall($scope.sheduled_search_new)
            .then(function (payload) {
                    $log.debug("pms data");
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        if($scope.sheduled_search_new.schduled_type==$scope.sheduled_types[0])
                        {
                            $scope.cpms_device_new = angular.fromJson(payload.completed_pms);
                            $scope.cqc_device_new=null
                        }
                        else {
                            $scope.cqc_device_new = angular.fromJson(payload.completed_qc);
                            $scope.cpms_device_new=null;
                        }
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        if (payload.response == $rootScope.successdata)
                            $scope.cpms_device_new = null;
                        else
                            $scope.cqc_device_new=null

                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.SearchCompletedQcsNew = function (limit_val) {
        if (limit_val != $scope.nostate) {
            var completedqcs;
            if (typeof limit_val === 'undefined')
                completedqcs = 0;
            else if (limit_val == 0)
                completedqcs = 0;
            else
                completedqcs = limit_val - 1;
            $log.error(completedqcs);
            $scope.completedqcs_search.limit_val = completedqcs;
        }
        else {
            delete $scope.completedqcs_search.limit_val;
        }
        if ($scope.searched.EID == null)
            $scope.completedqcs_search.eqpid = "";
        else if (typeof $scope.searched.EID === 'object')
            $scope.completedqcs_search.eqpid = $scope.searched.EID.E_ID;
        else
            $scope.completedqcs_search.eqpid = "";

        if ($scope.user_role_code == $scope.HBBME)
            $scope.completedqcs_search.action = "get_completed_bmeqcs";
        else if ($scope.user_role_code == $scope.HBHOD)
            $scope.completedqcs_search.action = "get_completed_hodqcs";
        else if ($scope.user_role_code == $scope.HMADMIN)
            $scope.completedqcs_search.action = "get_completed_hodqcs";
        $log.debug($scope.completedqcs_search);
        baseFactory.deviceCall($scope.completedqcs_search)
            .then(function (payload)
            {
                if (payload.response == $rootScope.successdata) {
                    $scope.cqc_devices = angular.fromJson(payload.completed_qcs);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.cqc_devices = null;
                    $scope.paging.total = 0;
                    $scope.no_of_recs = 0;
                }
                $log.debug(payload);
            },
            function (errorPayload) {
                $log.error('failure loading', errorPayload);
            });
    };

    $scope.getGenaratedCallNew = function (limit_val) /* Show Device Details with QR details */ {
        if (limit_val != $scope.nostate) {
            var lm;
            if (typeof limit_val === 'undefined')
                lm = 0;
            else if (limit_val == 0)
                lm = 0;
            else
                lm = limit_val - 1;
            $scope.generated_search_new.limit_val = lm;
        }
        else {
            delete $scope.generated_search_new.limit_val;
        }
        $scope.generated_search_new.action = "get_generated_calls_new";
        $log.error($scope.generated_search_new);
        baseFactory.deviceCall($scope.generated_search_new)
            .then(function (payload) {
                $log.error("Hello",payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.genarated_calls_news = angular.fromJson(payload.list);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.scr_reports = null;
                    $scope.paging.total = payload.rcnt;
                    $scope.scr_calls_news = payload.no_of_recs;
                }
            });
    };

    $scope.getMyTransAllCallsCount = function (user_type, uid) {
        var input = {};
        input.action = "get_mytrans_call_counts_new";
        $log.error("get_mytrans_call_counts_new");
        $log.log(input);
        baseFactory.deviceCall(input)
            .then(function (payload)
                {
                    $log.error(payload);
                    $scope.mytrans_call_counts = {};
                    $scope.mytrans_call_counts = payload;
                },
                function (errorPayload)
                {
                    $log.error('failure loading', errorPayload);
                });
    };
     $scope.fromJsonLength = function(data)
    {
        if(data!=null)
            return angular.fromJson(data).length;
        else
            return 0;
    };
    $scope.isUserNotApproved = function(data)
    {
        var return_type = true;
        if(data!=null)
        {
            var jdata = angular.fromJson(data);
            var user_id = $cookies.get("user_id");
            angular.forEach(jdata, function (value, key)
            {
                if(value.user_id==user_id)
                {
                    return_type = false;
                }
            });
        }
        return return_type;
    };
	$scope.viewContactPersonsAppointmentOrg = function(ev,cps)
	{

	var template_name = 'mainadmin/cps_appointment_org';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {cps: cps},
            controller: _viewContactPersonsAppointmentOrg
        }).then(function (answer) {
            },
            function () {
            });
    };


    function _viewContactPersonsAppointmentOrg($scope, $mdDialog, cps) {
        $scope.dialog_of_cpoa_data = cps;
    }
	$scope.getOrgBranchesLimit = function()
	{
		var send_data = {action:"get_org_branch_cnt"};
        baseFactory.UserCtrl(send_data)
            .then(function(payload)
			{
				console.log(payload);
				$scope.get_org_branch_cnt = payload.ob_cnt;
				$scope.get_org_branch_val = payload.ob_value;
			},
			function (errorPayload)
			{
				$log.error('failure loading', errorPayload);
			});
	};
	$scope.getOrgUsersLimit = function()
	{
		var send_data = {action:"get_org_users_cnt"};
        baseFactory.UserCtrl(send_data)
            .then(function(payload)
			{
				console.log(payload);
				$scope.get_org_users_cnt = payload.ou_cnt;
				$scope.get_org_users_val = payload.ou_value;
			},
			function (errorPayload)
			{
				$log.error('failure loading', errorPayload);
			});
	};
    $scope.addCountry = function(add_country)
    {
        add_country.action = "add_country";
        console.log(add_country);
        baseFactory.UserCtrl(add_country)
            .then(function(payload){
                console.log(payload);
                if(payload.response==$rootScope.successdata)
                {
                    $scope.showToastText(payload.call_back);
                    $scope.add_country = {};
                    $state.go("home.haadmin_countries");
                }
                else
                {
                    $scope.showToastText(payload.call_back);
                }
            },
            function(errorPayload)
            {
               $log.error('loading failure',errorPayload);
            });
    }

    $scope.addState = function(add_state)
    {
        add_state.action = "add_state";
        console.log(add_state);
        baseFactory.UserCtrl(add_state)
            .then(function(payload){
                    console.log(payload);
                    if(payload.response==$rootScope.successdata)
                    {
                        $scope.showToastText(payload.call_back);
                        $scope.add_state = {};
                        $state.go("home.haadmin_states");
                    }
                    else
                    {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function(errorPayload)
                {
                    $log.error('loading failure',errorPayload);
                });
    }
	$scope.getdepreciationdevices = function (limit_val)
    {
        if (limit_val != $scope.nostate) {
            if (typeof limit_val === 'undefined')
                $scope.depreciation_device_search.limit_val = 0;
            else if (limit_val == 0)
                $scope.depreciation_device_search.limit_val = 0;
            else
                $scope.depreciation_device_search.limit_val = limit_val - 1;
        }
        else {
            delete $scope.depreciation_device_search.limit_val;
        }
        $scope.depreciation_device_search.action = "get_depreciation_devices";
        console.log(JSON.stringify($scope.depreciation_device_search));
        baseFactory.Mainadmin($scope.depreciation_device_search)
            .then(function (payload)
            {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.depreciation_details = angular.fromJson(payload.list);
                    $scope.paging.total = payload.rcnt;
                    $scope.no_of_recs = payload.no_of_recs;
                }
                else if (payload.response == $rootScope.emptydata) {
                    $scope.depreciation_details = null;
                    $scope.paging.total = 0;
                    $scope.no_of_recs = 0;
                }
            });
    };
	
	$scope.addDepreciation = function(data)
    {
        data.action = "add_depreciation";
        baseFactory.UserCtrl(data)
            .then(function(payload){
                    console.log(payload);
                    if(payload.response==$rootScope.successdata)
                    {
                        $scope.showToastText(payload.call_back);
                        $scope.add_depreciation = {};
                        $state.go("home.depreciation");
                    }
                    else
                    {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function(errorPayload)
                {
                    $log.error('loading failure',errorPayload);
                });
    }
	
	$scope.editDepreciation = function (ev, dep_data) {
        var template_name = 'user/edit_depreciation_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {dep_data: dep_data},
            controller: _DepcCtrl
        }).then(function () {
            },
            function () {
            });
    };
    function _DepcCtrl($scope, dep_data)
    {
        $scope.depc_data = "";
        $scope.depc_data = dep_data;
        $scope.depc_data.name = dep_data.NAME;
        $scope.depc_data.percentage = dep_data.PERCENTAGE;
        $scope.depc_data.status = dep_data.STATUS;
    }
	
	$scope.loadDepreciation = function (limit_val)  /* To Get branch List */ {
        var send = {action: "get_depreciation_list"};
        if (limit_val != $scope.nostate)
        {
            var ln;
            if (typeof limit_val === 'undefined')
                ln = 0;
            else if (limit_val == 0)
                ln = 0;
            else
                ln = limit_val - 1;
            send.limit_val=ln;
        }
        else
        {
            delete send.limit_val;
        }
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.depreciation = angular.fromJson(payload.list);
						$scope.depr_label   = angular.fromJson(payload.labels);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.depreciation = null;
						$scope.depr_label = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs =  0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	$scope.UpdateDepreciation = function (data) {
        data.action = "update_depreciation";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadDepreciation();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	
	$scope.editlabellist = function (ev, label) {
        var template_name = 'mainadmin/edit_labels_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {label: label},
            controller: _LabelCtrl
        }).then(function () {
            },
            function () {
            });
    };
    function _LabelCtrl($scope, label)
    {
        $scope.label_data = "";
        $scope.label_data = label;
		$scope.label_data.module_id = label.MODULE_ID;
		$scope.label_data.org_name = label.ORG_NAME;
		$scope.label_data.table_name = label.TABLE_NAME;
        $scope.label_data.label_1 = label.LABEL_1;
        $scope.label_data.label_2 = label.LABEL_2;
        $scope.label_data.label_3 = label.LABEL_3;
		$scope.label_data.label_4 = label.LABEL_4;
		$scope.label_data.label_5 = label.LABEL_5;
		$scope.label_data.label_6 = label.LABEL_6;
		$scope.label_data.label_7 = label.LABEL_7;
		$scope.label_data.label_8 = label.LABEL_8;
		$scope.label_data.label_9 = label.LABEL_9;
		$scope.label_data.label_10 = label.LABEL_10;
		$scope.label_data.label_11 = label.LABEL_11;
		$scope.label_data.label_12 = label.LABEL_12;
		$scope.label_data.label_13 = label.LABEL_13;
		$scope.label_data.label_14 = label.LABEL_14;
		$scope.label_data.label_15 = label.LABEL_15;
		$scope.label_data.label_16 = label.LABEL_16;
		$scope.label_data.label_17 = label.LABEL_17;
		$scope.label_data.label_18 = label.LABEL_18;
		$scope.label_data.label_19 = label.LABEL_19;
		$scope.label_data.label_20 = label.LABEL_20;
		$scope.label_data.label_21 = label.LABEL_21;
		$scope.label_data.label_22 = label.LABEL_22;
		$scope.label_data.label_23 = label.LABEL_23;
		$scope.label_data.label_24 = label.LABEL_24;
		$scope.label_data.label_25 = label.LABEL_25;
		$scope.label_data.label_26 = label.LABEL_26;
		$scope.label_data.label_27 = label.LABEL_27;
		$scope.label_data.label_28 = label.LABEL_28;
		$scope.label_data.label_29 = label.LABEL_29;
		$scope.label_data.label_30 = label.LABEL_30;
		$scope.label_data.label_31 = label.LABEL_31;
		$scope.label_data.label_32 = label.LABEL_32;
		$scope.label_data.label_33 = label.LABEL_33;
		$scope.label_data.label_34 = label.LABEL_34;
		$scope.label_data.label_35 = label.LABEL_35;
		$scope.label_data.label_36 = label.LABEL_36;
		$scope.label_data.label_37 = label.LABEL_37;
		$scope.label_data.label_38 = label.LABEL_38;
		$scope.label_data.label_39 = label.LABEL_39;
		$scope.label_data.label_40 = label.LABEL_40;
		$scope.label_data.label_41 = label.LABEL_41;
		$scope.label_data.label_42 = label.LABEL_42;
		$scope.label_data.label_43 = label.LABEL_43;
		$scope.label_data.label_44 = label.LABEL_44;
		$scope.label_data.label_45 = label.LABEL_45;
		$scope.label_data.label_46 = label.LABEL_46;
		$scope.label_data.label_47 = label.LABEL_48;
		$scope.label_data.label_49 = label.LABEL_49;
		$scope.label_data.label_50 = label.LABEL_50;
		$scope.label_data.label_51 = label.LABEL_51;
		$scope.label_data.label_52 = label.LABEL_52;
		$scope.label_data.label_53 = label.LABEL_53;
		$scope.label_data.label_53 = label.LABEL_53;
		$scope.label_data.label_54 = label.LABEL_54;
		$scope.label_data.label_55 = label.LABEL_55;
		$scope.label_data.label_56 = label.LABEL_56;
		$scope.label_data.label_57 = label.LABEL_57;
		$scope.label_data.label_58 = label.LABEL_58;
		$scope.label_data.label_59 = label.LABEL_59;
		$scope.label_data.label_60 = label.LABEL_60;
		$scope.label_data.label_61 = label.LABEL_61;
		$scope.label_data.label_62 = label.LABEL_62;
		$scope.label_data.label_63 = label.LABEL_63;
		$scope.label_data.label_64 = label.LABEL_64;
		$scope.label_data.label_65 = label.LABEL_65;
		$scope.label_data.label_66 = label.LABEL_66;
		$scope.label_data.label_67 = label.LABEL_67;
		$scope.label_data.label_68 = label.LABEL_68;
		$scope.label_data.label_69 = label.LABEL_69;
		$scope.label_data.label_70 = label.LABEL_70;
		$scope.label_data.label_71 = label.LABEL_71;
		$scope.label_data.label_72 = label.LABEL_72;
		$scope.label_data.label_73 = label.LABEL_73;
		$scope.label_data.label_74 = label.LABEL_74;
		$scope.label_data.label_75 = label.LABEL_75;
		$scope.label_data.label_76 = label.LABEL_76;
		$scope.label_data.label_77 = label.LABEL_77;
		$scope.label_data.label_78 = label.LABEL_78;
		$scope.label_data.label_79 = label.LABEL_79;
		$scope.label_data.label_80 = label.LABEL_80;
		$scope.label_data.label_81 = label.LABEL_81;
		$scope.label_data.label_82 = label.LABEL_82;
		$scope.label_data.label_83 = label.LABEL_83;
		$scope.label_data.label_84 = label.LABEL_84;
		$scope.label_data.label_85 = label.LABEL_85;
		$scope.label_data.label_86 = label.LABEL_86;
		$scope.label_data.label_87 = label.LABEL_87;
		$scope.label_data.label_88 = label.LABEL_88;
		$scope.label_data.label_89 = label.LABEL_89;
		$scope.label_data.label_90 = label.LABEL_91;
		$scope.label_data.label_92 = label.LABEL_92;
		$scope.label_data.label_93 = label.LABEL_93;
		$scope.label_data.label_94 = label.LABEL_94;
		$scope.label_data.label_95 = label.LABEL_95;
		$scope.label_data.label_96 = label.LABEL_96;
		$scope.label_data.label_97 = label.LABEL_97;
		$scope.label_data.label_98 = label.LABEL_98;
		$scope.label_data.label_99 = label.LABEL_99;
		$scope.label_data.label_99 = label.LABEL_99;
		
		
		
    }
	
	$scope.UpdateLabelslist = function (label_data) {
        label_data.action = "update_labels_list";
		console.log(label_data);
        baseFactory.Mainadmin(label_data)
            .then(function (payload) {
				console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadDepreciation();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	
	$scope.addLocation = function(data)
    {
        data.action = "add_location";
		data.user_org_module = $scope.user_org_module;
        console.log(JSON.stringify(data));
        baseFactory.UserCtrl(data)
            .then(function(payload){
                    console.log(payload);
                    if(payload.response==$rootScope.successdata)
                    {
                        $scope.showToastText(payload.call_back);
                        $scope.add_location = {};
                        $state.go("home.location");
                    }
                    else
                    {
                        $scope.showToastText(payload.call_back);
                    }
                },
                function(errorPayload)
                {
                    $log.error('loading failure',errorPayload);
                });
    };
	
	$scope.UpdateLocation = function (data) {
        data.action = "update_location";
        baseFactory.UserCtrl(data)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.mdDialogHide();
                        $scope.showToast();
                        $scope.loadLocation();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	$scope.editLocation = function (ev, data) {
        var template_name = 'user/edit_location_dialog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {loc_data: data},
            controller: _LocCtrl
        }).then(function () {
            },
            function () {
            });
    };
    function _LocCtrl($scope, loc_data)
    {
        $scope.location_data = "";
        $scope.location_data = loc_data;
        $scope.location_data.location_name = loc_data.location;
        $scope.location_data.status = loc_data.status;
    };
	
	$scope.loadLocation = function (limit_val)  /* To Get branch List */ {
        var send = {action: "get_location_list",user_org_module:$scope.user_org_module};
        if (limit_val != $scope.nostate)
        {
            var ln;
            if (typeof limit_val === 'undefined')
                ln = 0;
            else if (limit_val == 0)
                ln = 0;
            else
                ln = limit_val - 1;
            send.limit_val=ln;
        }
        else
        {
            delete send.limit_val;
        }
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.location = angular.fromJson(payload.list);
						$scope.label_location = angular.fromJson(payload.labels);
                        $scope.paging.total = payload.rcnt;
                        $scope.no_of_recs = payload.no_of_recs;
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.location = null;
						$scope.label_location = null;
                        $scope.paging.total = 0;
                        $scope.no_of_recs =  0;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	$scope.EquipmentTransfer = function (ev, transferdevice_data)
    {
        //console.log(transferdevice_data);
        //return false;
        $scope.transfer_vequipment = {};
        $scope.transfer_vequipment.ID = transferdevice_data.ID;
        //console.log($scope.transfer_vequipment.ID);
        $scope.transfer_vequipment.E_NAME= transferdevice_data.EQ_NAME;
        $scope.transfer_vequipment.BRANCH_ID= transferdevice_data.BRANCH_ID;
        $scope.transfer_vequipment.TRANS_BRANCH_ID= transferdevice_data.TRANS_BRANCH_ID;
        $scope.transfer_vequipment.DEPT= transferdevice_data.DEPT;
        //$scope.loadEquipments(transfer_vequipment.ID);
        $state.go('home.transfer_device');
    };
	$scope.loadEquipments = function(data)
    {
        console.log(data);
        var send = {action: "get_equipments",name:data.E_NAME,branch:data.BRANCH_ID,trans_branch:data.TRANS_BRANCH_ID,dept_id:data.DEPT};
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                   console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equipments = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equipments = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

	$scope.generate_gate_pass = function (ev, gatepass_data) {
        $scope.loadDepartments();
        $scope.getCriticalSpares();
        $scope.getAccessories();
        $scope.getallbranches();
        //$scope.getsingledevicedata(gatepass_data.EQ_ID);
        //$scope.getTransferDepartmentDevices(gatepass_data);
        var template_name = 'user/add_vendor_gatepass';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            parent: angular.element(document.body),
            targetEvent: ev,
            locals: {gatepass_data: gatepass_data},
            controller: _GatePassdialog
        }).then(function () {
            },
            function () {
            });
    };
    function _GatePassdialog($scope, gatepass_data) {
        $scope.getsingledevicedata(gatepass_data.EQ_ID);
        $scope.gatepass_req = gatepass_data;
        $scope.gatepass_req.branch_id = gatepass_data.BRANCH_ID;
        $scope.gatepass_req.E_ID = gatepass_data.EQ_ID;
        $scope.gatepass_req.trans_branch_id = gatepass_data.TRANS_BRANCH_ID;
        $scope.gatepass_req.INDENT_ID = gatepass_data.ID;
       // $scope.gatepass_req.Dept_id =  gatepass_data.DEPT_ID;// $scope.single_device_data;
    };
	$scope.single_device_data = {};
    $scope.getsingledevicedata = function(id){
        var send = {action: "get_single_device_data",eid:id};
        //console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    //console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.single_device_data = angular.fromJson(payload.list);
                        $scope.gatepass_req.Dept_id = $scope.single_device_data.DEPT_ID;
                        //console.log($scope.gatepass_req.Dept_id)
                    }
                },
                function(){

                });
    };
	$scope.add_gate_pass_list = function(gatedata) {
		console.log(gatedata);
       var send = {
           action: "vendor_add_gate_pass_list",
           name: gatedata.E_NAME,
           branch: gatedata.trans_branch_id,
           to_whom: gatedata.branch_id,
           dept_id: gatedata.Dept_id,
           E_ID: gatedata.E_ID,
           E_NAME: gatedata.E_NAME,
           E_MODEL: gatedata.E_MODEL,
           srial_no: gatedata.srial_no,
           PHY_LOCATION: gatedata.PHY_LOCATION,
           gtype: gatedata.gtype,
           expert_return: gatedata.expert_return,
           critical_spare: gatedata.critical_spare,
           spars_cnt: gatedata.spars_cnt,
           accessories: gatedata.accessories,
           accessories_cnt: gatedata.accessories_cnt,
           reasons: gatedata.reasons,
           remarks: gatedata.remarks,
           INDENT_ID:gatedata.INDENT_ID
       };
       console.log(send);
       baseFactory.UserCtrl(send)
           .then(function (payload) {
                   console.log(payload);
                   if(payload.response==$rootScope.successdata)
                   {
                       $scope.showToastText(payload.call_back);
                       $scope.mdDialogHide();
                       $state.go('home.indent_equipment');
                   }
                   else
                   {
                       $scope.showToastText(payload.call_back);
                   }
               },
               function (errorPayload) {
                   $log.error('failure loading', errorPayload);
               });
   };
   $scope.transferEquipment = function(tdata)
    {
        var send = {action: "transfer_equipments",id:tdata.INDENT_ID,branch:tdata.BRANCH_ID,e_id:tdata.E_ID};
        //console.log(send);
        //return false;
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                   console.log(payload.list);
                    if (payload.response == $rootScope.successdata) {
                        $scope.equipments = angular.fromJson(payload.list);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.equipments = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	$scope.pmsassign = function (ev , pmsdata)
   {
       console.log(pmsdata);
       var pmsdata_details = pmsdata;
       var template_name = 'user/vendor_pmscall_respond_dailog';
       $mdDialog.show({
           templateUrl: template_name,
           clickOutsideToClose: false,
           scope: $scope,        // use parent scope in template
           preserveScope: true,  // do not forget this if use parent scope
           autoWrap: false,
           parent: angular.element(document.body),
           targetEvent: event,
           locals: {pms_vendordetails: pmsdata_details},
           controller: _VendorAssigndialog
       }).then(function (answer) {
           },
           function () {
           });
   }
    function _VendorAssigndialog($scope, pms_vendordetails) {
        $scope.loadUser();
        $scope.pmsv_details = pms_vendordetails;
        $scope.pmsv_details.eid = pms_vendordetails.EID;
        $scope.pmsv_details.eq_name = pms_vendordetails.eq_name;
        $scope.pmsv_details.serial_number = pms_vendordetails.serial_number;
    };
	$scope.qcassign = function (ev , qcdata)
    {
        console.log(qcdata);
        var qcdata_details = qcdata;
        var template_name = 'user/vendor_qccall_respond_dailog';
        $mdDialog.show({
            templateUrl: template_name,
            clickOutsideToClose: false,
            scope: $scope,        // use parent scope in template
            preserveScope: true,  // do not forget this if use parent scope
            autoWrap: false,
            parent: angular.element(document.body),
            targetEvent: event,
            locals: {qc_vendordetails: qcdata_details},
            controller: _QCVendorAssigndialog
        }).then(function (answer) {
            },
            function () {
            });
    }
    function _QCVendorAssigndialog($scope, qc_vendordetails) {
        $scope.loadUser();
        $scope.qcv_details = qc_vendordetails;
        $scope.qcv_details.eid = qc_vendordetails.EID;
        $scope.qcv_details.eq_name = qc_vendordetails.eq_name;
        $scope.qcv_details.serial_number = qc_vendordetails.serial_number;
    };
   $scope.loadUser = function()
   {
       var send = {action: "get_user_details"};
       baseFactory.UserCtrl(send)
           .then(function (payload) {
                  //console.log(payload.list);
                   if (payload.response == $rootScope.successdata) {
                       $scope.userdetails = angular.fromJson(payload.list);
                   }
                   else if (payload.response == $rootScope.emptydata) {
                       $scope.userdetails = null;
                   }
               },
               function (errorPayload) {
                   $log.error('failure loading', errorPayload);
               });
   };
   $scope.pmsselfRespondToCall = function (pmsdetails) {
        pmsdetails.action = "pmsself_respond_call";
        console.log(pmsdetails);
        baseFactory.UserCtrl(pmsdetails)
            .then(function (payload) {
                    $log.info(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                       // $state.go('home.hbhod_responded_calls');
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	$scope.qcselfRespondToCall = function (qcdetails) {
        qcdetails.action = "qcself_respond_call";
        console.log(qcdetails);
        baseFactory.UserCtrl(qcdetails)
            .then(function (payload) {
                    $log.info(payload);
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                        $scope.hide();
                        // $state.go('home.hbhod_responded_calls');
                        $state.forceReload();
                    }
                    else if (payload.response == $rootScope.failedata) {
                        $scope.toast_text = payload.call_back;
                        $scope.showToast();
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	$scope.indent_gatepass = function(gatepass_id)
    {
        var send = {action: "get_gatepass_details",id:gatepass_id};
        //console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    if (payload.response == $rootScope.successdata) {
                        $scope.indentgatepass = angular.fromJson(payload.list);
                        $scope.GatepasspdfNEW($scope.indentgatepass);
                        //console.log($scope.indentgatepass);
                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.indentgatepass = null;
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	$scope.check_emp_no= function (empid) {
        if (empid.length > 4) {
            var send = {emp_no: empid, action: "check_user_no"};
            baseFactory.authCtrl(send)
                .then(function (payload) {
                        if (payload.response == $rootScope.successdata) {
                            //Email available.
                            $scope.Color = "red";
                            $scope.Message = "Mobile Number Already Exists";
                        }
                        else {
                            //Email not available.
                            $scope.Color = "";
                            $scope.Message = "";
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
        }
    };
	$scope.checkemail = function (email) {
            var send = {email_id: email, action: "check_user_email"};
            console.log(send);
            baseFactory.authCtrl(send)
                .then(function (payload) {
                        console.log(payload);
                        if (payload.response == $rootScope.successdata) {
                            //Email available.
                            $scope.EColor = "red";
                            $scope.EMessage = "Email Aleady Exists";
                        }
                        else {
                            //Email not available.
                            $scope.EColor = "";
                            $scope.EMessage = "";
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
    };
	
	$scope.checkhospitalemail = function (email) {
            var send = {email_id: email, action: "check_hospital_email"};
            console.log(send);
            baseFactory.Mainadmin(send)
                .then(function (payload) {
                        console.log(payload);
                        if (payload.response == $rootScope.successdata) {
                            //Email available.
                            $scope.EColor = "red";
                            $scope.EMessage = "Email Aleady Exists";
                        }
                        else {
                            //Email not available.
                            $scope.EColor = "";
                            $scope.EMessage = "";
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
    };
	$scope.checkhospitalmobile = function (contact_no) {
            var send = {contact_no: contact_no, action: "check_hospital_mobile"};
            console.log(send);
            baseFactory.Mainadmin(send)
                .then(function (payload) {
                        console.log(payload);
                        if (payload.response == $rootScope.successdata) {
                            //Email available.
                            $scope.EColor1 = "red";
                            $scope.EMessage1 = "Mobile Aleady Exists";
                        }
                        else {
                            //Email not available.
                            $scope.EColor1 = "";
                            $scope.EMessage1 = "";
                        }
                    },
                    function (errorPayload) {
                        $log.error('failure loading', errorPayload);
                    });
    };
	
	
	
	
	$scope.check_scheduled_call = function (caller_name)
    {
        var send = {caller_name:caller_name,action:"check_scheduled_call"};
        console.log(send);
        baseFactory.Mainadmin(send)
            .then(function(payload) {
                console.log(payload);
                if (payload.response == $rootScope.successdata) {
                    $scope.CColor = "red";
                    $scope.CMessage = "Callername Already Exists";
                }
                else {
                    $scope.CColor = "";
                    $scope.CMessage = "";
                }
            },
            function (errorPayload)
            {
                $log.error('failure loading', errorPayload);
            })
    };

	
	$scope.check_serial_no = function (serial_no) {
        var send = {serial_no: serial_no, action: "check_serial_number"};
        console.log(send);
        baseFactory.authCtrl(send)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        //Email available.
                        $scope.DColor = "red";
                        $scope.DMessage = "Serial Number Aleady Exists";
                    }
                    else {
                        //Email not available.
                        $scope.DColor = "";
                        $scope.DMessage = "";
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
    
     $scope.check_vendor_name = function (vendor_name) {
        var send = {vendor_name: vendor_name, action: "check_vendor_name"};
        console.log(send);
        baseFactory.UserCtrl(send)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        //Email available.
                        $scope.DColor = "red";
                        $scope.DMessage = "Vendor Name Aleady Exists";
                    }
                    else {
                        //Email not available.
                        $scope.DColor = "";
                        $scope.DMessage = "";
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	$scope.user_check = function (contact_no) {
        var send = {contact_no: contact_no, action: "check_contact_number"};
        console.log(send);
        baseFactory.authCtrl(send)
            .then(function (payload) {
                    console.log(payload);
                    if (payload.response == $rootScope.successdata) {
                        //Email available.
                        $scope.uColor = "red";
                        $scope.uMessage = "User Already Exists";
                    }
                    else {
                        //Email not available.
                        $scope.uColor = "";
                        $scope.uMessage = "";
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };
	
	$scope.check_cms_eq_id = function (device_id) {
        var send = {device_id: device_id, action: "check_cms_eq_id"};
        console.log(send);
		console.log("ghg");
        baseFactory.authCtrl(send)
            .then(function (payload) {
                    console.log(payload);
					console.log("fgfg");
                    if (payload.response == $rootScope.successdata) {
                        //Email available.
						console.log("fgdf");
                        $scope.DColor = "red";
                        $scope.DMessage = "Eq_id Call Aleady Generated";
                    }
                    else {
                        //Email not available.
                        $scope.DColor = "";
                        $scope.DMessage = "";
                    }
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    }
	
	$scope.level_check = function(lev1,type1,lev2,type2){
		if(parseInt(lev1) == parseInt(lev2)){
			if(type1 == type2){
				$scope.LMessage = "Level1 value must be less than level2";
				$scope.LColor = "red";
			}
		}else if(parseInt(lev1) > parseInt(lev2)){
			console.log("greater than");
			if(type1 == "Minutes"){
				if(type2 == "Minutes"){
					$scope.LMessage = "Level1 value must be less than level2";
					$scope.LColor = "red";
				}else{
					$scope.LMessage = "";
					$scope.LColor = "";
				}
			}else if(type1 == "Hours"){
				if(type2 == "Days"){
					$scope.LMessage = "";
					$scope.LColor = "";
				}else{
					$scope.LMessage = "Level1 value must be less than level2";
					$scope.LColor = "red";
				}
			}else if(type1 == "Days"){
					$scope.LMessage = "Level1 value must be less than level2";
					$scope.LColor = "red";
			}else{
					$scope.LMessage = "Level1 value must be less than level2";
					$scope.LColor = "red";
				}
		}else if(parseInt(lev1) < parseInt(lev2)){
			console.log("Less than");
			if(type1 == "Hours"){
				if(type2 == "Minutes"){
					$scope.LMessage = "Level1 value must be less than level2";
					$scope.LColor = "red";
				}else{
					$scope.LMessage = "";
					$scope.LColor = "";
				}
			}else if(type1 == "Days"){
				if(type2 == "Days"){
					$scope.LMessage = "";
					$scope.LColor = "";
				}else{
					$scope.LMessage = "Level1 value must be less than level2";
					$scope.LColor = "red";
				}
			}else if(type1 == "Minutes"){
				$scope.LMessage = "";
				$scope.LColor = "";
			}
		}else{
					$scope.LMessage = "Level1 value must be less than level2";
					$scope.LColor = "red";
		}
	};
	$scope.level_check1 = function(lev1,type1,lev2,type2){
		if(parseInt(lev1) == parseInt(lev2)){
			if(type1 == type2){
				$scope.LLMessage = "Level2 value must be less than level3";
				$scope.LLColor = "red";
			}
		}else if(parseInt(lev1) > parseInt(lev2)){
			console.log("greater than");
			if(type1 == "Minutes"){
				if(type2 == "Minutes"){
					$scope.LLMessage = "Level2 value must be less than level3";
					$scope.LLColor = "red";
				}else{
					$scope.LLMessage = "";
					$scope.LLColor = "";
				}
			}else if(type1 == "Hours"){
				if(type2 == "Days"){
					$scope.LLMessage = "";
					$scope.LLColor = "";
				}else{
					$scope.LLMessage = "Level2 value must be less than level3";
					$scope.LLColor = "red";
				}
			}else if(type1 == "Days"){
					$scope.LLMessage = "Level2 value must be less than level3";
					$scope.LLColor = "red";
			}
		}else if(parseInt(lev1) < parseInt(lev2)){
			console.log("Less than");
			if(type1 == "Hours"){
				if(type2 == "Minutes"){
					$scope.LLMessage = "Level2 value must be less than level3";
					$scope.LColor = "red";
				}else{
					$scope.LLMessage = "";
					$scope.LLColor = "";
				}
			}else if(type1 == "Days"){
				if(type2 == "Days"){
					$scope.LLMessage = "";
					$scope.LLColor = "";
				}else{
					$scope.LLMessage = "Level2 value must be less than level3";
					$scope.LLColor = "red";
				}
			}else if(type1 == "Minutes"){
				$scope.LLMessage = "";
				$scope.LLColor = "";
			}
		}else{
				$scope.LLMessage = "Level2 value must be less than level3";
				$scope.LLColor = "red";
		}
	};
	$scope.clear = function () {
        $scope.gatepass_req.searchDepartment = '';
		$scope.gatepass_req.device_id = '';
		$scope.gatepass_req.searchEid='';
    };
	
}]);
    