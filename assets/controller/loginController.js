app.controller('loginRegisterCtrl',['$scope', '$state', '$timeout', '$http', '$rootScope', 'socialconfactory', '$q', '$mdToast', '$cookies', '$log','baseFactory','$window', function ($scope, $state, $timeout, $http, $rootScope, socialconfactory, $q, $mdToast, $cookies, $log,baseFactory,$window)
{
    $scope.showToast = function()
    {
        var pinTo = "bottom right";
        $mdToast.show(
            $mdToast.simple()
                .textContent($scope.toast_text)
                .position(pinTo)
                .hideDelay(3000)
        );
    };
    $log.debug(window.location.protocol+'//'+window.location.hostname+window.location.pathname);
    $scope.pageClass = 'page-login-register';
    $scope.myDate = new Date();
    $scope.minDate = new Date
    (
        $scope.myDate.getFullYear(),
        $scope.myDate.getMonth(),
        $scope.myDate.getDate()
    );
    $scope.gen_call = {};
    $rootScope.successdata = "success";
    $rootScope.failedata = "failed";
    $rootScope.emptydata = "empty";
    $rootScope.errordata = "error";
    $scope.appname = "HospiAsset";
    $scope.reguser = {ruc:"Client", rhusername:"", rhnumber:"", rhname:"", rhcountry:"", rhcity:"", rhstate:"", rhlocation:"",rhemail:"",rhpswrd:""};
    $scope.usercategory = {uc1 : 'Client',uc2 : 'Hospital',uc3 : 'Vendor'};
    $scope.countries = [];
    $scope.Other = 'Other';
    $scope.nature_of_calls = ['Incident Call',$scope.Other];
    $scope.states = [];
    $scope.cities = [];
    $scope.HMADMIN = "HMADMIN";
    $scope.HA_ADMIN = "HA_ADMIN";
    $scope.Add = "Add";
    $scope.Edit = "Edit";
    $scope.View = 'View';
    $scope.Renew = 'Renew';
    $scope.GeneratePDF = 'GeneratePDF';
    $scope.PURCHASE = "PURCHASE";
    $scope.VENDOR = "VENDOR";
    $scope.isArray = angular.isArray;
    $scope.user_lbranches = null;
    $scope.lgn = {username:"",password:"",branch:""};
    $scope.login_text = 'Login';
    $scope.logout = function()
    {
        window.localStorage.removeItem("user_menu");
        $rootScope.manin_menu=null;
        var cookies = $cookies.getAll();
        angular.forEach(cookies, function (v, k)
        {
            $cookies.remove(k);
        });
        window.location.href=window.location.protocol+'//'+window.location.hostname+window.location.pathname+"auth/logout";
        if($cookies.get('user_id')==undefined || $cookies.get('user_id')=="")
        {
            $state.go('login');
        }
    };
    $scope.loadIncidentType=function() /* For Contracts */
    {
        var send={action:"get_incident_type_list"};
        baseFactory.UserCtrl(send)
            .then(function(payload)
                {
                    $log.debug(payload);
                    $log.info(payload);
                    if(payload.response==$rootScope.successdata)
                    {
                        $scope.itypes = angular.fromJson(payload.list);
                    }
                    else if(payload.response==$rootScope.emptydata)
                    {
                        $scope.itypes = null;
                    }
                },
                function(errorPayload)
                {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.loadBranches = function()  /* To Get branch List */
    {
        var send={action:"get_branches_call"};
        baseFactory.UserCtrl(send)
            .then(function(payload)
                {
                    $log.log(payload);
                    if(payload.response==$rootScope.successdata)
                    {
                        $scope.branchs = angular.fromJson(payload.branchs);
                    }
                    else if(payload.response==$rootScope.emptydata)
                    {
                        $scope.branchs = [{BRANCH_ID: "", BRANCH_NAME: "No Branchs Found"}];
                    }
                },
                function(errorPayload)
                {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.loadDepartments = function ()
    {

        var send = {action: "get_dept_data"};
        console.log(send);
        $log.warn(send);
        baseFactory.getDepartments(send)
            .then(function (payload)
                {
                    $log.debug("depts");
                    $log.debug(payload);
                    if (payload.response == $rootScope.successdata) {
                        $scope.depts = angular.fromJson(payload.list);

                    }
                    else if (payload.response == $rootScope.emptydata) {
                        $scope.depts = null;
                    }
                    $log.log($scope.depts);
                },
                function (errorPayload) {
                    $log.error('failure loading', errorPayload);
                });
    };

    $scope.getCCCEmpDetls = function(empid)
    {
        if(empid.length > 4)
        {
            var send={emp_id:empid,action:"get_ccc_user_dtls"};
            $log.debug(send);
            baseFactory.authCtrl(send)
                .then(function(payload)
                    {
                        console.log(payload);
                        if(payload.response==$rootScope.successdata)
                        {
                            var data = angular.fromJson(payload.emp_dtls[0]);
                            $scope.gen_call.user_name = data.USER_NAME;
                            $scope.gen_call.mobile_no = data.MOBILE_NO;
                            $scope.gen_call.email = data.EMAIL_ID;
                            //  $scope.gen_call.dept_id = data.DEPT_NAME;

                            /* console.log($scope.gen_call);
                             if(data.DEPT_NAME!=null)
                             {
                             }*/
                        }
                        else if(payload.response==$rootScope.emptydata || payload.response==$rootScope.failedata)
                        {
                            $scope.gen_call.user_name = null;
                            $scope.gen_call.mbl_no = null;
                            //$scope.gen_call.dept_id = null;
                        }
                    },
                    function(errorPayload)
                    {
                        $log.error('failure loading', errorPayload);
                    });
        }
        else
        {
            $scope.gen_call.user_name = null;
            $scope.gen_call.mbl_no = null;
            $scope.gen_call.dept_id = null;
        }
    };
    $scope.getBranchDevices = function(branch_id)
    {
        var data= {};
        data.action = "get_branch_devices";
        data.branch_id = branch_id;
        baseFactory.deviceCall(data)
            .then(function (payload)
            {
                console.log(payload);
                $scope.devices = angular.fromJson(payload.list);
            });
    };

    $scope.getDepartmentDevices = function (dept_id) {

        var data = {};
        data.action = "get_dept_devices";
        data.dept_id = dept_id;

        baseFactory.deviceCall(data)
            .then(function (payload) {
                //console.log(payload);
                $scope.devices = angular.fromJson(payload.list);
            });
    };

    $scope.getDevicePriorities = function()
    {
        $scope.device_priorities=null;
        data = {action:"get_device_priorities"};
        baseFactory.getDevicePriorities(data)
            .then(function(payload)
                {
                    if(payload.response==$rootScope.successdata)
                    {
                        $scope.device_priorities = angular.fromJson(payload.priorities);
                    }
                    else if(payload.response==$rootScope.emptydata)
                    {
                        $scope.device_priorities = null;
                    }
                },
                function(errorPayload)
                {
                    $log.error('failure loading', errorPayload);
                });
    };
    $scope.UserCallgenerate = function()
    {
        $log.debug($scope.gen_call);
        if($scope.gen_call.complaint==$scope.Other)
        {
            $scope.gen_call.action = "call_generation_all";
            baseFactory.GenerateCallByUser($scope.gen_call)
                .then(function(payload)
                    {
                        $log.log(payload);
                        if(payload.response==$rootScope.successdata || payload.response==$rootScope.exsitsdata)
                        {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                            $scope.gen_call = null;
                            $scope.gen_call = {};
                            $state.go('login');
                        }
                        else if(payload.response==$rootScope.failedata || payload.response==$rootScope.emptydata)
                        {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                        }
                    },
                    function(errorPayload)
                    {
                        $log.error('failure loading', errorPayload);
                    });
        }
        else if($scope.gen_call.complaint==$scope.nature_of_calls[0])
        {
            $scope.gen_call.action = "add_incidents";
            $scope.gen_call.feedback = $scope.gen_call.remarks;
            $scope.gen_call.user_id = $scope.gen_call.caller_id;
            //$scope.gen_call.user_name = $scope.gen_call.user_name;
            $scope.gen_call.equp_id = $scope.gen_call.device_id;
            $scope.gen_call.departments = $scope.gen_call.dept_id;
            baseFactory.UserCtrl($scope.gen_call)
                .then(function(payload)
                    {
                        $log.debug(payload);
                        if (payload.response == $rootScope.successdata)
                        {
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                            $scope.gen_call = null;
                            $scope.gen_call = {};
                            $state.go('login');
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
        }
    };
    if($cookies.get('user_id')==undefined || $cookies.get('user_id')=="")
    {
        if(!$state.is("callgeneration"))
        {
            window.localStorage.removeItem("user_menu");
            if(!$state.is('login'))
            {
                $scope.logout();
                window.location.href=window.location.href=window.location.protocol+'//'+window.location.hostname+window.location.pathname+"auth/logout";
            }
            $state.go('login');
        }
        else
        {
            $scope.getDevicePriorities();
            $scope.loadBranches();
            $scope.loadIncidentType();
            $scope.loadDepartments();

        }
    }
    else
    {
        $state.go($cookies.get('user_path'));
    }
    $scope.uc_divs = {client_div:true,hospital_div:true,vendor_div:true}; /* used for hide divs in registration */
    $scope.$watch('reguser.ruc', function(newValue, oldValue)  /*  used in on change radio buttons in registration */
    {
        if(newValue=="Client")
        {
            $scope.uc_divs.hospital_div = true;
            $scope.uc_divs.vendor_div = true;
            $scope.uc_divs.client_div = false;
        }
        else if(newValue=="Hospital")
        {
            $scope.uc_divs.client_div = true;
            $scope.uc_divs.vendor_div = true;
            $scope.uc_divs.hospital_div = false;
        }
        else if(newValue=="Vendor")
        {
            $scope.uc_divs.hospital_div = true;
            $scope.uc_divs.client_div = true;
            $scope.uc_divs.vendor_div = false;
        }
    }, true);
    $scope.loadUserBranches=function(user_id)
    {
        if(user_id!=undefined)
        {
            if(user_id.length > 4)
            {
                var input = {};
                input.user_id = user_id;
                input.action = "get_user_branches";
                baseFactory.baseCall(input)
                    .then(function (payload) {
                        //console.log("its query "+JSON.stringify(payload));
                        if(payload.response == $scope.HMADMIN)
                        {
                            $scope.user_lbranches = $scope.HMADMIN;
                        }
                        else if(payload.response == $scope.HA_ADMIN)
                        {
                            $scope.user_lbranches = $scope.HA_ADMIN;
                        }
                        else if(payload.response == $scope.PURCHASE)
                        {
                            $scope.user_lbranches = $scope.PURCHASE;
                        }
                        else if(payload.response == $scope.VENDOR)
                        {
                            $scope.user_lbranches = $scope.VENDOR;

                        }
                        else if (payload.response == $rootScope.successdata)
                        {
                            $scope.user_lbranches = null;
                            // $scope.user_lbranches = angular.fromJson(payload.list);
                        }
                        else if (payload.response == 'inactive')
                        {
                            $scope.user_lbranches = null;
                            $scope.toast_text = payload.call_back;
                            $scope.showToast();
                        }
                        else if (payload.response == $rootScope.emptydata || payload.response == $rootScope.failedata)
                        {
                            $scope.user_lbranches = null;
                        }
                        $log.error(typeof $scope.user_lbranches);
                    });
            }
            else
            {
                $scope.user_lbranches = null;
            }
        }
        else
        {
            $scope.user_lbranches = null;
        }
    };
    $scope.defaultLogin = function(lgn_credentials)
    {
        //console.log("lgn_credentials "+lgn_credentials );
        if(lgn_credentials.username=="" || lgn_credentials.username==undefined || lgn_credentials.password==undefined || lgn_credentials.password=="")
        {
            $scope.toast_text = "Please Enter Employee ID Number and Password";
            $scope.showToast();
            return false;
        }
        else
        {
            $scope.login_text = 'Checking...';
            $rootScope.lgn_credentials = lgn_credentials;
            socialconfactory.userLogin(function(lgn_response)
            {
                $log.error(lgn_response);
                $scope.AllLogin(lgn_response);
            });
        }
    };
    $scope.AllLogin = function(lgn_response)
    {
        if(lgn_response.response==$rootScope.successdata)
        {
            var user_lgn_dtls = angular.fromJson(lgn_response.user_login);
            //console.log(JSON.stringify(user_lgn_dtls));
            var msections = angular.fromJson(user_lgn_dtls.FEATURES_LIST);

           /* if(user_lgn_dtls.VALIDITY_EXPIRED=='YES')
            {
                $scope.login_text = 'Expired';
                $scope.toast_text = "Validity Expired, Please Contact Administrator!";
                $scope.showToast();
                return false;
            }*/
            if(user_lgn_dtls.password_match=='YES')
            {
               console.log("hfh");
                var now = new Date();
                exp = new Date(now.getFullYear(), now.getMonth(), now.getDate()+1);
                $cookies.put('user_name',user_lgn_dtls.USER_NAME,{expires:exp});
                $cookies.put('user_path',user_lgn_dtls.ROLE_PATH ,{expires:exp});
                $cookies.put('user_role_priority',user_lgn_dtls.ROLE_PRIORITY ,{expires:exp});
                $cookies.put('user_role_code',user_lgn_dtls.ROLE_CODE,{expires:exp});
                $cookies.put('user_erole_code',user_lgn_dtls.EROLE_CODE,{expires:exp});
                $cookies.put('user_id',user_lgn_dtls.USER_ID,{expires:exp});
                $cookies.put('org_type',user_lgn_dtls.ORG_TYPE,{expires:exp});
                $cookies.put('user_email_id',user_lgn_dtls.EMAIL_ID,{expires:exp});
                $cookies.put('user_mobile_no',user_lgn_dtls.MOBILE_NO,{expires:exp});
                $cookies.put('user_branch',user_lgn_dtls.ORG_BRANCH_ID,{expires:exp});
				$cookies.put('user_org_module',user_lgn_dtls.ORG_MODULE,{expires:exp});
                $cookies.put('emp_no',user_lgn_dtls.EMP_NO,{expires:exp});
                $cookies.put('user_org',user_lgn_dtls.ORG_ID,{expires:exp});
                $cookies.put('org_code',user_lgn_dtls.ORG_CODE,{expires:exp});
                $cookies.put('user_branch_name',user_lgn_dtls.BRANCH_NAME,{expires:exp});
                $cookies.put('user_general_asset',user_lgn_dtls.GENERAL_ASSET,{expires:exp});
                $cookies.put('user_org_type',user_lgn_dtls.ORG_TYPE,{expires:exp});
				//$cookies.put('user_org_module',user_lgn_dtls.ORG_MODULE,{expires:exp});
				
                /* permissions */
                $cookies.put('Add_Indent',user_lgn_dtls.Add_Indent,{expires:exp});
                $cookies.put('Transfer_Indent',user_lgn_dtls.Transfer_Indent,{expires:exp});
                $cookies.put('Edit_Indent',user_lgn_dtls.Edit_Indent,{expires:exp});
                $cookies.put('View_Indent',user_lgn_dtls.View_Indent,{expires:exp});
                $cookies.put('Approve_Indent',user_lgn_dtls.Approve_Indent,{expires:exp});
                $cookies.put('Rise_Cear',user_lgn_dtls.Rise_Cear,{expires:exp});
                $cookies.put('Indent_PDF_Generated',user_lgn_dtls.Indent_PDF_Generated,{expires:exp});
                $cookies.put('Sanction_Indent',user_lgn_dtls.Sanction_Indent,{expires:exp});
                $cookies.put('Sanctioned_Indent',user_lgn_dtls.Sanctioned_Indent,{expires:exp});
                $cookies.put('Transfer_Indent',user_lgn_dtls.Transfer_Indent,{expires:exp});
                $cookies.put('Stock_Indent',user_lgn_dtls.Stock_Indent,{expires:exp});
                $cookies.put('Edit_Cear',user_lgn_dtls.Edit_Cear,{expires:exp});
                $cookies.put('View_Cear',user_lgn_dtls.View_Cear,{expires:exp});
                $cookies.put('Approve_Cear',user_lgn_dtls.Approve_Cear,{expires:exp});
                $cookies.put('Add_Gatepass',user_lgn_dtls.Add_Gatepass,{expires:exp});
                $cookies.put('Edit_Gatepass',user_lgn_dtls.Edit_Gatepass,{expires:exp});
                $cookies.put('View_Gatepass',user_lgn_dtls.View_Gatepass,{expires:exp});
                $cookies.put('Edit_Equipment',user_lgn_dtls.Edit_Equipment,{expires:exp});
                $cookies.put('Replace_Equipment',user_lgn_dtls.Replace_Equipment,{expires:exp});
                $cookies.put('View_Equipment',user_lgn_dtls.View_Equipment,{expires:exp});
                $cookies.put('print_Equipment',user_lgn_dtls.print_Equipment,{expires:exp});
                $cookies.put('View_Print',user_lgn_dtls.View_Print,{expires:exp});
                $cookies.put('Edit_Transfer',user_lgn_dtls.Edit_Transfer,{expires:exp});
                $cookies.put('View_Transfer',user_lgn_dtls.View_Transfer,{expires:exp});
                $cookies.put('Edit_Condemnation',user_lgn_dtls.Edit_Condemnation,{expires:exp});
                $cookies.put('Approve_Condemnation',user_lgn_dtls.Approve_Condemnation,{expires:exp});
                $cookies.put('View_Condemnation',user_lgn_dtls.View_Condemnation,{expires:exp});
                $cookies.put('Add_Contracts',user_lgn_dtls.Add_Contracts,{expires:exp});
                $cookies.put('Edit_Contracts',user_lgn_dtls.Edit_Contracts,{expires:exp});
                $cookies.put('Renew_Contracts',user_lgn_dtls.Renew_Contracts,{expires:exp});
                $cookies.put('Add_Viability',user_lgn_dtls.Add_Viability,{expires:exp});
                $cookies.put('Edit_Viability',user_lgn_dtls.Edit_Viability,{expires:exp});
                $cookies.put('Viability_Generate_PDF',user_lgn_dtls.Viability_Generate_PDF,{expires:exp});
                $cookies.put('View_Viabilty',user_lgn_dtls.View_Viabilty,{expires:exp});
                $cookies.put('Add_Vendor',user_lgn_dtls.Add_Vendor,{expires:exp});
                $cookies.put('Edit_Vendor',user_lgn_dtls.Edit_Vendor,{expires:exp});
                $cookies.put('View_Vendor',user_lgn_dtls.View_Vendor,{expires:exp});
                $cookies.put('Add_Country',user_lgn_dtls.Add_Country,{expires:exp});
                $cookies.put('Edit_Country',user_lgn_dtls.Edit_Country,{expires:exp});
                $cookies.put('View_Country',user_lgn_dtls.View_Country,{expires:exp});
                $cookies.put('Add_State',user_lgn_dtls.Add_State,{expires:exp});
                $cookies.put('Edit_State',user_lgn_dtls.Edit_State,{expires:exp});
                $cookies.put('View_State',user_lgn_dtls.View_State,{expires:exp});
                $cookies.put('Add_City',user_lgn_dtls.Add_City,{expires:exp});
                $cookies.put('Edit_City',user_lgn_dtls.Edit_City,{expires:exp});
                $cookies.put('View_City',user_lgn_dtls.View_City,{expires:exp});
                $cookies.put('Edit_User',user_lgn_dtls.Edit_User,{expires:exp});
                $cookies.put('Add_User',user_lgn_dtls.Add_User,{expires:exp});
                $cookies.put('View_User',user_lgn_dtls.View_User,{expires:exp});
                $cookies.put('Add_Contract_Type',user_lgn_dtls.Add_Contract_Type,{expires:exp});
                $cookies.put('Edit_Contract_Type',user_lgn_dtls.Edit_Contract_Type,{expires:exp});
                $cookies.put('View_Contract_Type',user_lgn_dtls.View_Contract_Type,{expires:exp});
                $cookies.put('Add_Branches',user_lgn_dtls.Add_Branches,{expires:exp});
                $cookies.put('Edit_Branches',user_lgn_dtls.Edit_Branches,{expires:exp});
                $cookies.put('View_Branches',user_lgn_dtls.View_Branches,{expires:exp});
                $cookies.put('Add_Escalations',user_lgn_dtls.Add_Escalations,{expires:exp});
                $cookies.put('Edit_Escalations',user_lgn_dtls.Edit_Escalations,{expires:exp});
                $cookies.put('View_Escalations',user_lgn_dtls.View_Escalations,{expires:exp});
                $cookies.put('Add_Escalation_type',user_lgn_dtls.Add_Escalation_type,{expires:exp});
                $cookies.put('Edit_Escalation_type',user_lgn_dtls.Edit_Escalation_type,{expires:exp});
                $cookies.put('View_Escalation_type',user_lgn_dtls.View_Escalation_type,{expires:exp});
                $cookies.put('Add_Escalationlevel',user_lgn_dtls.Add_Escalationlevel,{expires:exp});
                $cookies.put('Edit_Escalationlevel',user_lgn_dtls.Edit_Escalationlevel,{expires:exp});
                $cookies.put('Add_Cear_Category',user_lgn_dtls.Add_Cear_Category,{expires:exp});
                $cookies.put('Edit_Cear_Category',user_lgn_dtls.Edit_Cear_Category,{expires:exp});
                $cookies.put('View_Cear_Category',user_lgn_dtls.View_Cear_Category,{expires:exp});
                $cookies.put('Add_Training_Type',user_lgn_dtls.Add_Training_Type,{expires:exp});
                $cookies.put('View_Training_Type',user_lgn_dtls.View_Training_Type,{expires:exp});
                $cookies.put('Edit_Training_Type',user_lgn_dtls.Edit_Training_Type,{expires:exp});
                $cookies.put('Add_Reasons',user_lgn_dtls.Add_Reasons,{expires:exp});
                $cookies.put('Edit_Reasons',user_lgn_dtls.Edit_Reasons,{expires:exp});
                $cookies.put('View_Reasons',user_lgn_dtls.View_Reasons,{expires:exp});
                $cookies.put('Add_Department',user_lgn_dtls.Add_Department,{expires:exp});
                $cookies.put('Edit_Department',user_lgn_dtls.Edit_Department,{expires:exp});
                $cookies.put('View_Department',user_lgn_dtls.View_Department,{expires:exp});
                $cookies.put('Add_Category',user_lgn_dtls.Add_Category,{expires:exp});
                $cookies.put('Edit_Category',user_lgn_dtls.Edit_Category,{expires:exp});
                $cookies.put('View_Cateogry',user_lgn_dtls.View_Cateogry,{expires:exp});
                $cookies.put('Add_Deployment',user_lgn_dtls.Add_Deployment,{expires:exp});
                $cookies.put('View_Deployment',user_lgn_dtls.View_Deployment,{expires:exp});
                $cookies.put('Add_Condition',user_lgn_dtls.Add_Condition,{expires:exp});
                $cookies.put('Edit_Condition',user_lgn_dtls.Edit_Condition,{expires:exp});
                $cookies.put('Edit_Category',user_lgn_dtls.Edit_Category,{expires:exp});
                $cookies.put('View_Condition',user_lgn_dtls.View_Condition,{expires:exp});
                $cookies.put('Add_Classes',user_lgn_dtls.Add_Classes,{expires:exp});
                $cookies.put('Edit_Classes',user_lgn_dtls.Edit_Classes,{expires:exp});
                $cookies.put('View_Classes',user_lgn_dtls.View_Classes,{expires:exp});
                $cookies.put('Add_Utilization',user_lgn_dtls.Add_Utilization,{expires:exp});
                $cookies.put('Edit_Utilization',user_lgn_dtls.Edit_Utilization,{expires:exp});
                $cookies.put('View_Utilization',user_lgn_dtls.View_Utilization,{expires:exp});
                $cookies.put('Add_Status',user_lgn_dtls.Add_Status,{expires:exp});
                $cookies.put('Edit_Status',user_lgn_dtls.Add_Status,{expires:exp});
                $cookies.put('View_Status',user_lgn_dtls.Add_Status,{expires:exp});
                $cookies.put('Add_Classification',user_lgn_dtls.Add_Classification,{expires:exp});
                $cookies.put('Edit_Classification',user_lgn_dtls.Edit_Classification,{expires:exp});
                $cookies.put('View_Classification',user_lgn_dtls.View_Classification,{expires:exp});
                $cookies.put('Add_Equipment_Type',user_lgn_dtls.Add_Equipment_Type,{expires:exp});
                $cookies.put('Edit_Equipment_Type',user_lgn_dtls.Edit_Equipment_Type,{expires:exp});
                $cookies.put('View_Equipment_Type',user_lgn_dtls.View_Equipment_Type,{expires:exp});
                $cookies.put('Add_Incident_Type',user_lgn_dtls.Add_Incident_Type,{expires:exp});
                $cookies.put('Edit_Incident_Type',user_lgn_dtls.Edit_Incident_Type,{expires:exp});
                $cookies.put('View_Incident_Type',user_lgn_dtls.View_Incident_Type,{expires:exp});
                $cookies.put('Add_Role',user_lgn_dtls.Add_Role,{expires:exp});
                $cookies.put('Edit_Role',user_lgn_dtls.Edit_Role,{expires:exp});
                $cookies.put('View_Role',user_lgn_dtls.View_Role,{expires:exp});
                $cookies.put('Add_CEAR_TYPE',user_lgn_dtls.Add_CEAR_TYPE,{expires:exp});
                $cookies.put('Edit_CEAR_TYPE',user_lgn_dtls.Edit_CEAR_TYPE,{expires:exp});
                $cookies.put('View_CEAR_TYPE',user_lgn_dtls.View_CEAR_TYPE,{expires:exp});
                $cookies.put('Respond_Open_Calls',user_lgn_dtls.Respond_Open_Calls,{expires:exp});
                $cookies.put('Attend_Open_Calls',user_lgn_dtls.Attend_Open_Calls,{expires:exp});
                $cookies.put('Hold_Open_Calls',user_lgn_dtls.Hold_Open_Calls,{expires:exp});
                $cookies.put('Complete_Open_Calls',user_lgn_dtls.Complete_Open_Calls,{expires:exp});
                $cookies.put('View_Open_Calls',user_lgn_dtls.View_Open_Calls,{expires:exp});
                $cookies.put('Complete_Open_Calls',user_lgn_dtls.Complete_Open_Calls,{expires:exp});
                $cookies.put('Add_Adverse_Incident',user_lgn_dtls.Add_Adverse_Incident,{expires:exp});
                $cookies.put('Edit_Adverse_Incident',user_lgn_dtls.Edit_Adverse_Incident,{expires:exp});
                $cookies.put('Report_Gatepass_Pdf',user_lgn_dtls.Report_Gatepass_Pdf,{expires:exp});
                $cookies.put('View_Gatepass_report',user_lgn_dtls.View_Gatepass_report,{expires:exp});
                $cookies.put('View_Call_Log',user_lgn_dtls.View_Call_Log,{expires:exp});
                $cookies.put('Report_Summary_Pdf',user_lgn_dtls.Report_Summary_Pdf,{expires:exp});
                $cookies.put('Report_Summary_view',user_lgn_dtls.Report_Summary_view,{expires:exp});
                $cookies.put('Report_Downtime_view',user_lgn_dtls.Report_Downtime_view,{expires:exp});
                $cookies.put('Report_History_Pdf',user_lgn_dtls.Report_History_Pdf,{expires:exp});
                $cookies.put('Report_History_View',user_lgn_dtls.Report_History_View,{expires:exp});
                $cookies.put('Cms_Pdf_Report',user_lgn_dtls.Cms_Pdf_Report,{expires:exp});
                $cookies.put('Cms_Pdf_View',user_lgn_dtls.Cms_Pdf_View,{expires:exp});
                $cookies.put('Monthly_Pdf_Report',user_lgn_dtls.Monthly_Pdf_Report,{expires:exp});
                $cookies.put('Monthly_Pdf_View',user_lgn_dtls.Monthly_Pdf_View,{expires:exp});
                $cookies.put('Viability_pdf_report',user_lgn_dtls.Viability_pdf_report,{expires:exp});
                $cookies.put('Viability_pdf_view',user_lgn_dtls.Viability_pdf_view,{expires:exp});
                $cookies.put('Adverse_pdf_report',user_lgn_dtls.Adverse_pdf_report,{expires:exp});
                $cookies.put('Adverse_pdf_view',user_lgn_dtls.Adverse_pdf_view,{expires:exp});
                $cookies.put('Service_pdf_report',user_lgn_dtls.Service_pdf_report,{expires:exp});
                $cookies.put('Service_pdf_view',user_lgn_dtls.Service_pdf_view,{expires:exp});
                $cookies.put('Deployment_pdf_report',user_lgn_dtls.Deployment_pdf_report,{expires:exp});
                $cookies.put('Deployment_pdf_view',user_lgn_dtls.Deployment_pdf_view,{expires:exp});
                $cookies.put('Replacement_pdf_report',user_lgn_dtls.Replacement_pdf_report,{expires:exp});
                $cookies.put('Replacement_pdf_view',user_lgn_dtls.Replacement_pdf_view,{expires:exp});
                $cookies.put('PMS_pdf_report',user_lgn_dtls.PMS_pdf_report,{expires:exp});
                $cookies.put('PMS_pdf_view',user_lgn_dtls.PMS_pdf_view,{expires:exp});
                $cookies.put('QC_pdf_report',user_lgn_dtls.QC_pdf_report,{expires:exp});
                $cookies.put('QC_pdf_view',user_lgn_dtls.QC_pdf_view,{expires:exp});
                $cookies.put('Condemnation_pdf_report',user_lgn_dtls.Condemnation_pdf_report,{expires:exp});
                $cookies.put('Condemnation_pdf_view',user_lgn_dtls.Condemnation_pdf_view,{expires:exp});
                $cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
                $cookies.put('Indent_pdf_view',user_lgn_dtls.Indent_pdf_view,{expires:exp});
                $cookies.put('CEAR_pdf_report',user_lgn_dtls.CEAR_pdf_report,{expires:exp});
                $cookies.put('CEAR_pdf_view',user_lgn_dtls.CEAR_pdf_view,{expires:exp});
                $cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
                $cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
                $cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
                $cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
                $cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
                $cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
                $cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});









                /* $cookies.put('can_req_indent',user_lgn_dtls.can_req_indent,{expires:exp});
                 $cookies.put('can_approve_indent',user_lgn_dtls.can_approve_indent,{expires:exp});
                 $cookies.put('can_add_cear',user_lgn_dtls.can_add_cear,{expires:exp});
                 $cookies.put('can_approve_cear',user_lgn_dtls.can_approve_cear,{expires:exp});
                 $cookies.put('can_add_purchase',user_lgn_dtls.can_add_purchase,{expires:exp});
                 $cookies.put('can_approve_purchase',user_lgn_dtls.can_approve_purchase,{expires:exp});
                 $cookies.put('can_update_purchase',user_lgn_dtls.can_update_purchase,{expires:exp});
                 $cookies.put('can_add_purchase_to_stock',user_lgn_dtls.can_add_purchase_to_stock,{expires:exp});
                 $cookies.put('can_add_equp',user_lgn_dtls.can_add_equp,{expires:exp});
                 $cookies.put('can_update_equp',user_lgn_dtls.can_update_equp,{expires:exp});
                 $cookies.put('can_update_gatepass',user_lgn_dtls.can_update_gatepass,{expires:exp});
                 $cookies.put('can_transfer_within_unit',user_lgn_dtls.can_transfer_within_unit,{expires:exp});
                 $cookies.put('can_transfer_other_unit',user_lgn_dtls.can_transfer_other_unit,{expires:exp});
                 $cookies.put('can_request_condemnation',user_lgn_dtls.can_request_condemnation,{expires:exp});
                 $cookies.put('can_approve_condemnation',user_lgn_dtls.can_approve_condemnation,{expires:exp});
                 $cookies.put('can_close_condemnation',user_lgn_dtls.can_close_condemnation,{expires:exp});
                 $cookies.put('can_print_qr',user_lgn_dtls.can_print_qr,{expires:exp});
                 $cookies.put('can_print_pmscal',user_lgn_dtls.can_print_pmscal,{expires:exp});
                 $cookies.put('can_add_contract',user_lgn_dtls.can_add_contract,{expires:exp});
                 $cookies.put('can_renew_contract',user_lgn_dtls.can_renew_contract,{expires:exp});
                 $cookies.put('can_close_contract',user_lgn_dtls.can_close_contract,{expires:exp});
                 $cookies.put('can_add_adverse',user_lgn_dtls.can_add_adverse,{expires:exp});
                 $cookies.put('can_approve_adverse',user_lgn_dtls.can_approve_adverse,{expires:exp});
                 $cookies.put('can_close_adverse',user_lgn_dtls.can_close_adverse,{expires:exp});
                 $cookies.put('can_add_viability',user_lgn_dtls.can_add_viability,{expires:exp});
                 $cookies.put('can_approve_viability',user_lgn_dtls.can_approve_viability,{expires:exp});
                 $cookies.put('show_ns_calls',user_lgn_dtls.show_ns_calls,{expires:exp});
                 $cookies.put('show_pms_calls',user_lgn_dtls.show_pms_calls,{expires:exp});
                 $cookies.put('show_calibration_calls',user_lgn_dtls.show_calibration_calls,{expires:exp});
                 $cookies.put('can_add_training',user_lgn_dtls.can_add_training,{expires:exp});
                 $cookies.put('can_approve_training',user_lgn_dtls.can_approve_training,{expires:exp});*/

                var msections = angular.fromJson(user_lgn_dtls.FEATURES_LIST);
                $rootScope.manin_menu = JSON.stringify(msections.menu);
                /*$cookies.put('user_menu',$rootScope.manin_menu,{expires:exp});*/
                window.localStorage.setItem("user_menu", $rootScope.manin_menu);
                $scope.login_text = 'Loading...';
                $state.go("home.change_password");
            }

    else
            {
                var now = new Date();
                exp = new Date(now.getFullYear(), now.getMonth(), now.getDate()+1);
                $cookies.put('user_name',user_lgn_dtls.USER_NAME,{expires:exp});
                $cookies.put('user_path',user_lgn_dtls.ROLE_PATH ,{expires:exp});
                $cookies.put('user_role_priority',user_lgn_dtls.ROLE_PRIORITY ,{expires:exp});
                $cookies.put('user_role_code',user_lgn_dtls.ROLE_CODE,{expires:exp});
                $cookies.put('user_erole_code',user_lgn_dtls.EROLE_CODE,{expires:exp});
                $cookies.put('user_id',user_lgn_dtls.USER_ID,{expires:exp});
                $cookies.put('org_type',user_lgn_dtls.ORG_TYPE,{expires:exp});
                $cookies.put('user_email_id',user_lgn_dtls.EMAIL_ID,{expires:exp});
                $cookies.put('user_mobile_no',user_lgn_dtls.MOBILE_NO,{expires:exp});
				$cookies.put('user_org_module',user_lgn_dtls.ORG_MODULE,{expires:exp});
                $cookies.put('user_branch',user_lgn_dtls.ORG_BRANCH_ID,{expires:exp});
                $cookies.put('emp_no',user_lgn_dtls.EMP_NO,{expires:exp});
                $cookies.put('user_org',user_lgn_dtls.ORG_ID,{expires:exp});
                $cookies.put('org_code',user_lgn_dtls.ORG_CODE,{expires:exp});
                $cookies.put('user_branch_name',user_lgn_dtls.BRANCH_NAME,{expires:exp});
                $cookies.put('user_general_asset',user_lgn_dtls.GENERAL_ASSET,{expires:exp});
                $cookies.put('user_org_type',user_lgn_dtls.ORG_TYPE,{expires:exp});
				//$cookies.put('user_org_module',user_lgn_dtls.ORG_MODULE,{expires:exp});
				
                /* permissions */
				$cookies.put('Add_Indent',user_lgn_dtls.Add_Indent,{expires:exp});
                $cookies.put('Transfer_Indent',user_lgn_dtls.Transfer_Indent,{expires:exp});
                $cookies.put('Edit_Indent',user_lgn_dtls.Edit_Indent,{expires:exp});
                $cookies.put('View_Indent',user_lgn_dtls.View_Indent,{expires:exp});
                $cookies.put('Approve_Indent',user_lgn_dtls.Approve_Indent,{expires:exp});
				$cookies.put('Rise_Cear',user_lgn_dtls.Rise_Cear,{expires:exp});
				$cookies.put('Indent_PDF_Generated',user_lgn_dtls.Indent_PDF_Generated,{expires:exp});
				$cookies.put('Sanction_Indent',user_lgn_dtls.Sanction_Indent,{expires:exp});
				$cookies.put('Sanctioned_Indent',user_lgn_dtls.Sanctioned_Indent,{expires:exp});
				$cookies.put('Transfer_Indent',user_lgn_dtls.Transfer_Indent,{expires:exp});
				$cookies.put('Stock_Indent',user_lgn_dtls.Stock_Indent,{expires:exp});
                $cookies.put('Edit_Cear',user_lgn_dtls.Edit_Cear,{expires:exp});
                $cookies.put('View_Cear',user_lgn_dtls.View_Cear,{expires:exp});
                $cookies.put('Approve_Cear',user_lgn_dtls.Approve_Cear,{expires:exp});
                $cookies.put('Add_Gatepass',user_lgn_dtls.Add_Gatepass,{expires:exp});
                $cookies.put('Edit_Gatepass',user_lgn_dtls.Edit_Gatepass,{expires:exp});
                $cookies.put('View_Gatepass',user_lgn_dtls.View_Gatepass,{expires:exp});
                $cookies.put('Edit_Equipment',user_lgn_dtls.Edit_Equipment,{expires:exp});
                $cookies.put('Replace_Equipment',user_lgn_dtls.Replace_Equipment,{expires:exp});
                $cookies.put('View_Equipment',user_lgn_dtls.View_Equipment,{expires:exp});
                $cookies.put('print_Equipment',user_lgn_dtls.print_Equipment,{expires:exp});
                $cookies.put('View_Print',user_lgn_dtls.View_Print,{expires:exp});
                $cookies.put('Edit_Transfer',user_lgn_dtls.Edit_Transfer,{expires:exp});
                $cookies.put('View_Transfer',user_lgn_dtls.View_Transfer,{expires:exp});
                $cookies.put('Edit_Condemnation',user_lgn_dtls.Edit_Condemnation,{expires:exp});
                $cookies.put('Approve_Condemnation',user_lgn_dtls.Approve_Condemnation,{expires:exp});
                $cookies.put('View_Condemnation',user_lgn_dtls.View_Condemnation,{expires:exp});
                $cookies.put('Add_Contracts',user_lgn_dtls.Add_Contracts,{expires:exp});
                $cookies.put('Edit_Contracts',user_lgn_dtls.Edit_Contracts,{expires:exp});
                $cookies.put('Renew_Contracts',user_lgn_dtls.Renew_Contracts,{expires:exp});
                $cookies.put('Add_Viability',user_lgn_dtls.Add_Viability,{expires:exp});
                $cookies.put('Edit_Viability',user_lgn_dtls.Edit_Viability,{expires:exp});
                $cookies.put('Viability_Generate_PDF',user_lgn_dtls.Viability_Generate_PDF,{expires:exp});
                $cookies.put('View_Viabilty',user_lgn_dtls.View_Viabilty,{expires:exp});
                $cookies.put('Add_Vendor',user_lgn_dtls.Add_Vendor,{expires:exp});
                $cookies.put('Edit_Vendor',user_lgn_dtls.Edit_Vendor,{expires:exp});
                $cookies.put('View_Vendor',user_lgn_dtls.View_Vendor,{expires:exp});
                $cookies.put('Add_Country',user_lgn_dtls.Add_Country,{expires:exp});
                $cookies.put('Edit_Country',user_lgn_dtls.Edit_Country,{expires:exp});
                $cookies.put('View_Country',user_lgn_dtls.View_Country,{expires:exp});
                $cookies.put('Add_State',user_lgn_dtls.Add_State,{expires:exp});
                $cookies.put('Edit_State',user_lgn_dtls.Edit_State,{expires:exp});
                $cookies.put('View_State',user_lgn_dtls.View_State,{expires:exp});
                $cookies.put('Add_City',user_lgn_dtls.Add_City,{expires:exp});
                $cookies.put('Edit_City',user_lgn_dtls.Edit_City,{expires:exp});
                $cookies.put('View_City',user_lgn_dtls.View_City,{expires:exp});
                $cookies.put('Edit_User',user_lgn_dtls.Edit_User,{expires:exp});
                $cookies.put('Add_User',user_lgn_dtls.Add_User,{expires:exp});
                $cookies.put('View_User',user_lgn_dtls.View_User,{expires:exp});
                $cookies.put('Add_Contract_Type',user_lgn_dtls.Add_Contract_Type,{expires:exp});
                $cookies.put('Edit_Contract_Type',user_lgn_dtls.Edit_Contract_Type,{expires:exp});
                $cookies.put('View_Contract_Type',user_lgn_dtls.View_Contract_Type,{expires:exp});
                $cookies.put('Add_Branches',user_lgn_dtls.Add_Branches,{expires:exp});
                $cookies.put('Edit_Branches',user_lgn_dtls.Edit_Branches,{expires:exp});
                $cookies.put('View_Branches',user_lgn_dtls.View_Branches,{expires:exp});
                $cookies.put('Add_Escalations',user_lgn_dtls.Add_Escalations,{expires:exp});
                $cookies.put('Edit_Escalations',user_lgn_dtls.Edit_Escalations,{expires:exp});
                $cookies.put('View_Escalations',user_lgn_dtls.View_Escalations,{expires:exp});
				$cookies.put('Add_Escalation_type',user_lgn_dtls.Add_Escalation_type,{expires:exp});
                $cookies.put('Edit_Escalation_type',user_lgn_dtls.Edit_Escalation_type,{expires:exp});
                $cookies.put('View_Escalation_type',user_lgn_dtls.View_Escalation_type,{expires:exp});
                $cookies.put('Add_Escalationlevel',user_lgn_dtls.Add_Escalationlevel,{expires:exp});
                $cookies.put('Edit_Escalationlevel',user_lgn_dtls.Edit_Escalationlevel,{expires:exp});
                $cookies.put('Add_Cear_Category',user_lgn_dtls.Add_Cear_Category,{expires:exp});
                $cookies.put('Edit_Cear_Category',user_lgn_dtls.Edit_Cear_Category,{expires:exp});
                $cookies.put('View_Cear_Category',user_lgn_dtls.View_Cear_Category,{expires:exp});
                $cookies.put('Add_Training_Type',user_lgn_dtls.Add_Training_Type,{expires:exp});
                $cookies.put('View_Training_Type',user_lgn_dtls.View_Training_Type,{expires:exp});
                $cookies.put('Edit_Training_Type',user_lgn_dtls.Edit_Training_Type,{expires:exp});
                $cookies.put('Add_Reasons',user_lgn_dtls.Add_Reasons,{expires:exp});
                $cookies.put('Edit_Reasons',user_lgn_dtls.Edit_Reasons,{expires:exp});
                $cookies.put('View_Reasons',user_lgn_dtls.View_Reasons,{expires:exp});
                $cookies.put('Add_Department',user_lgn_dtls.Add_Department,{expires:exp});
                $cookies.put('Edit_Department',user_lgn_dtls.Edit_Department,{expires:exp});
                $cookies.put('View_Department',user_lgn_dtls.View_Department,{expires:exp});
                $cookies.put('Add_Category',user_lgn_dtls.Add_Category,{expires:exp});
                $cookies.put('Edit_Category',user_lgn_dtls.Edit_Category,{expires:exp});
                $cookies.put('View_Cateogry',user_lgn_dtls.View_Cateogry,{expires:exp});
                $cookies.put('Add_Deployment',user_lgn_dtls.Add_Deployment,{expires:exp});
                $cookies.put('View_Deployment',user_lgn_dtls.View_Deployment,{expires:exp});
                $cookies.put('Add_Condition',user_lgn_dtls.Add_Condition,{expires:exp});
                $cookies.put('Edit_Condition',user_lgn_dtls.Edit_Condition,{expires:exp});
                $cookies.put('Edit_Category',user_lgn_dtls.Edit_Category,{expires:exp});
                $cookies.put('View_Condition',user_lgn_dtls.View_Condition,{expires:exp});
                $cookies.put('Add_Classes',user_lgn_dtls.Add_Classes,{expires:exp});
                $cookies.put('Edit_Classes',user_lgn_dtls.Edit_Classes,{expires:exp});
                $cookies.put('View_Classes',user_lgn_dtls.View_Classes,{expires:exp});
                $cookies.put('Add_Utilization',user_lgn_dtls.Add_Utilization,{expires:exp});
                $cookies.put('Edit_Utilization',user_lgn_dtls.Edit_Utilization,{expires:exp});
                $cookies.put('View_Utilization',user_lgn_dtls.View_Utilization,{expires:exp});
				$cookies.put('Add_Status',user_lgn_dtls.Add_Status,{expires:exp});
				$cookies.put('Edit_Status',user_lgn_dtls.Add_Status,{expires:exp});
				$cookies.put('View_Status',user_lgn_dtls.Add_Status,{expires:exp});
                $cookies.put('Add_Classification',user_lgn_dtls.Add_Classification,{expires:exp});
                $cookies.put('Edit_Classification',user_lgn_dtls.Edit_Classification,{expires:exp});
                $cookies.put('View_Classification',user_lgn_dtls.View_Classification,{expires:exp});
                $cookies.put('Add_Equipment_Type',user_lgn_dtls.Add_Equipment_Type,{expires:exp});
                $cookies.put('Edit_Equipment_Type',user_lgn_dtls.Edit_Equipment_Type,{expires:exp});
                $cookies.put('View_Equipment_Type',user_lgn_dtls.View_Equipment_Type,{expires:exp});
                $cookies.put('Add_Incident_Type',user_lgn_dtls.Add_Incident_Type,{expires:exp});
                $cookies.put('Edit_Incident_Type',user_lgn_dtls.Edit_Incident_Type,{expires:exp});
                $cookies.put('View_Incident_Type',user_lgn_dtls.View_Incident_Type,{expires:exp});
                $cookies.put('Add_Role',user_lgn_dtls.Add_Role,{expires:exp});
                $cookies.put('Edit_Role',user_lgn_dtls.Edit_Role,{expires:exp});
                $cookies.put('View_Role',user_lgn_dtls.View_Role,{expires:exp});
                $cookies.put('Add_CEAR_TYPE',user_lgn_dtls.Add_CEAR_TYPE,{expires:exp});
                $cookies.put('Edit_CEAR_TYPE',user_lgn_dtls.Edit_CEAR_TYPE,{expires:exp});
                $cookies.put('View_CEAR_TYPE',user_lgn_dtls.View_CEAR_TYPE,{expires:exp});
                $cookies.put('Respond_Open_Calls',user_lgn_dtls.Respond_Open_Calls,{expires:exp});
                $cookies.put('Attend_Open_Calls',user_lgn_dtls.Attend_Open_Calls,{expires:exp});
                $cookies.put('Hold_Open_Calls',user_lgn_dtls.Hold_Open_Calls,{expires:exp});
                $cookies.put('Complete_Open_Calls',user_lgn_dtls.Complete_Open_Calls,{expires:exp});
                $cookies.put('View_Open_Calls',user_lgn_dtls.View_Open_Calls,{expires:exp});
                $cookies.put('Complete_Open_Calls',user_lgn_dtls.Complete_Open_Calls,{expires:exp});
                $cookies.put('Add_Adverse_Incident',user_lgn_dtls.Add_Adverse_Incident,{expires:exp});
				$cookies.put('Edit_Adverse_Incident',user_lgn_dtls.Edit_Adverse_Incident,{expires:exp});               
                $cookies.put('Report_Gatepass_Pdf',user_lgn_dtls.Report_Gatepass_Pdf,{expires:exp});
				$cookies.put('View_Gatepass_report',user_lgn_dtls.View_Gatepass_report,{expires:exp});
				$cookies.put('View_Call_Log',user_lgn_dtls.View_Call_Log,{expires:exp});
				$cookies.put('Report_Summary_Pdf',user_lgn_dtls.Report_Summary_Pdf,{expires:exp});
				$cookies.put('Report_Summary_view',user_lgn_dtls.Report_Summary_view,{expires:exp});
				$cookies.put('Report_Downtime_view',user_lgn_dtls.Report_Downtime_view,{expires:exp});
				$cookies.put('Report_History_Pdf',user_lgn_dtls.Report_History_Pdf,{expires:exp});
				$cookies.put('Report_History_View',user_lgn_dtls.Report_History_View,{expires:exp});
				$cookies.put('Cms_Pdf_Report',user_lgn_dtls.Cms_Pdf_Report,{expires:exp});
				$cookies.put('Cms_Pdf_View',user_lgn_dtls.Cms_Pdf_View,{expires:exp});
				$cookies.put('Monthly_Pdf_Report',user_lgn_dtls.Monthly_Pdf_Report,{expires:exp});
				$cookies.put('Monthly_Pdf_View',user_lgn_dtls.Monthly_Pdf_View,{expires:exp});
				$cookies.put('Viability_pdf_report',user_lgn_dtls.Viability_pdf_report,{expires:exp});
				$cookies.put('Viability_pdf_view',user_lgn_dtls.Viability_pdf_view,{expires:exp});
				$cookies.put('Adverse_pdf_report',user_lgn_dtls.Adverse_pdf_report,{expires:exp});
				$cookies.put('Adverse_pdf_view',user_lgn_dtls.Adverse_pdf_view,{expires:exp});
				$cookies.put('Service_pdf_report',user_lgn_dtls.Service_pdf_report,{expires:exp});
				$cookies.put('Service_pdf_view',user_lgn_dtls.Service_pdf_view,{expires:exp});
				$cookies.put('Deployment_pdf_report',user_lgn_dtls.Deployment_pdf_report,{expires:exp});
				$cookies.put('Deployment_pdf_view',user_lgn_dtls.Deployment_pdf_view,{expires:exp});
				$cookies.put('Replacement_pdf_report',user_lgn_dtls.Replacement_pdf_report,{expires:exp});
				$cookies.put('Replacement_pdf_view',user_lgn_dtls.Replacement_pdf_view,{expires:exp});
				$cookies.put('PMS_pdf_report',user_lgn_dtls.PMS_pdf_report,{expires:exp});
				$cookies.put('PMS_pdf_view',user_lgn_dtls.PMS_pdf_view,{expires:exp});
				$cookies.put('QC_pdf_report',user_lgn_dtls.QC_pdf_report,{expires:exp});
				$cookies.put('QC_pdf_view',user_lgn_dtls.QC_pdf_view,{expires:exp});
				$cookies.put('Condemnation_pdf_report',user_lgn_dtls.Condemnation_pdf_report,{expires:exp});
				$cookies.put('Condemnation_pdf_view',user_lgn_dtls.Condemnation_pdf_view,{expires:exp});
				$cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
				$cookies.put('Indent_pdf_view',user_lgn_dtls.Indent_pdf_view,{expires:exp});
				$cookies.put('CEAR_pdf_report',user_lgn_dtls.CEAR_pdf_report,{expires:exp});
				$cookies.put('CEAR_pdf_view',user_lgn_dtls.CEAR_pdf_view,{expires:exp});
				$cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
				$cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
				$cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
				$cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
				$cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
				$cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
				$cookies.put('Indent_pdf_report',user_lgn_dtls.Indent_pdf_report,{expires:exp});
				
				
				
				
				
				
				
				
				
               /* $cookies.put('can_req_indent',user_lgn_dtls.can_req_indent,{expires:exp});
                $cookies.put('can_approve_indent',user_lgn_dtls.can_approve_indent,{expires:exp});
                $cookies.put('can_add_cear',user_lgn_dtls.can_add_cear,{expires:exp});
                $cookies.put('can_approve_cear',user_lgn_dtls.can_approve_cear,{expires:exp});
                $cookies.put('can_add_purchase',user_lgn_dtls.can_add_purchase,{expires:exp});
                $cookies.put('can_approve_purchase',user_lgn_dtls.can_approve_purchase,{expires:exp});
                $cookies.put('can_update_purchase',user_lgn_dtls.can_update_purchase,{expires:exp});
                $cookies.put('can_add_purchase_to_stock',user_lgn_dtls.can_add_purchase_to_stock,{expires:exp});
                $cookies.put('can_add_equp',user_lgn_dtls.can_add_equp,{expires:exp});
                $cookies.put('can_update_equp',user_lgn_dtls.can_update_equp,{expires:exp});
                $cookies.put('can_update_gatepass',user_lgn_dtls.can_update_gatepass,{expires:exp});
                $cookies.put('can_transfer_within_unit',user_lgn_dtls.can_transfer_within_unit,{expires:exp});
                $cookies.put('can_transfer_other_unit',user_lgn_dtls.can_transfer_other_unit,{expires:exp});
                $cookies.put('can_request_condemnation',user_lgn_dtls.can_request_condemnation,{expires:exp});
                $cookies.put('can_approve_condemnation',user_lgn_dtls.can_approve_condemnation,{expires:exp});
                $cookies.put('can_close_condemnation',user_lgn_dtls.can_close_condemnation,{expires:exp});
                $cookies.put('can_print_qr',user_lgn_dtls.can_print_qr,{expires:exp});
                $cookies.put('can_print_pmscal',user_lgn_dtls.can_print_pmscal,{expires:exp});
                $cookies.put('can_add_contract',user_lgn_dtls.can_add_contract,{expires:exp});
                $cookies.put('can_renew_contract',user_lgn_dtls.can_renew_contract,{expires:exp});
                $cookies.put('can_close_contract',user_lgn_dtls.can_close_contract,{expires:exp});
                $cookies.put('can_add_adverse',user_lgn_dtls.can_add_adverse,{expires:exp});
                $cookies.put('can_approve_adverse',user_lgn_dtls.can_approve_adverse,{expires:exp});
                $cookies.put('can_close_adverse',user_lgn_dtls.can_close_adverse,{expires:exp});
                $cookies.put('can_add_viability',user_lgn_dtls.can_add_viability,{expires:exp});
                $cookies.put('can_approve_viability',user_lgn_dtls.can_approve_viability,{expires:exp});
                $cookies.put('show_ns_calls',user_lgn_dtls.show_ns_calls,{expires:exp});
                $cookies.put('show_pms_calls',user_lgn_dtls.show_pms_calls,{expires:exp});
                $cookies.put('show_calibration_calls',user_lgn_dtls.show_calibration_calls,{expires:exp});
                $cookies.put('can_add_training',user_lgn_dtls.can_add_training,{expires:exp});
                $cookies.put('can_approve_training',user_lgn_dtls.can_approve_training,{expires:exp});*/

                var msections = angular.fromJson(user_lgn_dtls.FEATURES_LIST);
                $rootScope.manin_menu = JSON.stringify(msections.menu);
                /*$cookies.put('user_menu',$rootScope.manin_menu,{expires:exp});*/
                window.localStorage.setItem("user_menu", $rootScope.manin_menu);
                $scope.login_text = 'Loading...';
                $state.go(user_lgn_dtls.ROLE_PATH);
            }
        }
        else if(lgn_response.response==$rootScope.emptydata || lgn_response.response==$rootScope.failedata)
        {
            $scope.login_text = 'Login';
            $scope.toast_text = "Invalid Credentials";
            $scope.showToast();
            return false;
        }
    };
    $scope.gotoLogin = function()
    {
        $state.go('login')
    };
    /* End User Login */
}]);
