app.config(['$stateProvider', '$urlRouterProvider','unsavedWarningsConfigProvider',function ($stateProvider, $urlRouterProvider,unsavedWarningsConfigProvider)
{
    $urlRouterProvider.otherwise('/login');
    $stateProvider
        .state('login', {
            url: '/login',
            views: {
                "main_content": {
                    templateUrl:'welcome/index',
                    controller:'loginRegisterCtrl'
                }
            }
        })
        .state('callgeneration', {
            url: '/callgeneration',
            views: {
                "main_content": {
                    templateUrl:'welcome/callgeneration',
                    controller:'loginRegisterCtrl'
                }
            }
        })
        .state('home',
            {
                url:'/home',
                views: {
                    "main_content": {
                        templateUrl:'welcome/main_home',
                        controller:'homeCtrl',
                        abstract:true
                    }
                }
            })
        .state('home.equipment_save_and_deploy', {
            url:'/equipment_save_and_deploy',
            templateUrl:'device/device_save_and_deploy',
            controller:'HBbmeCtrl'
        })
        .state('home.call_log_reports',{
            url: '/call_log_reports',
            templateUrl:'master/call_log_reports',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_deployment', {
            url:'/hbbme_deployment',
            templateUrl:'device/deployment_devices',
            controller:'HBbmeCtrl'
        })
        .state('home.transfer_save_and_deploy', {
            url:'/transfer_save_and_deploy',
            templateUrl:'master/transfer_save_and_deploy',
            controller:'HBbmeCtrl'
        })
		
		.state('home.change_password',{
            url:'/change_password',
            templateUrl:'master/change_password',
            controller:'HBbmeCtrl'
        })
		
        /* Routing for Hospital Admin*/
        .state('home.appointments',{
            url:'/appointments',
            templateUrl:'mainadmin/appointments',
            controller:'MAdminCtrl'
        })
        .state('home.mahospitals',{
            url:'/mahospitals',
            templateUrl:'mainadmin/viewhospitals',
            controller:'MAdminCtrl'
        })
        .state('home.appointment_organizations',{
            url:'/appointment_organizations',
            templateUrl:'mainadmin/appointment_organizations',
            controller:'MAdminCtrl'
        })
        .state('home.add_organization_appointments',{
            url:'/add_organization_appointments',
            templateUrl:'mainadmin/add_organization_appointments',
            controller:'MAdminCtrl'
        })
        .state('home.edit_organization_appointments',{
            url:'/edit_organization_appointments',
            templateUrl:'mainadmin/edit_organization_appointments',
            controller:'MAdminCtrl'
        })
        .state('home.appointment_hospitals',{
            url:'/appointment_hospitals',
            templateUrl:'mainadmin/appointment_hospitals',
            controller:'MAdminCtrl'
        })
        .state('home.add_appointments',{
            url:'/add_appointments',
            templateUrl:'mainadmin/add_appointments',
            controller:'MAdminCtrl'
        })
        .state('home.madmin_home',{
            url:'/madmin_home',
            templateUrl:'mainadmin/madmin_home',
            controller:'MAdminCtrl'
        })
        .state('home.add_hospitals',{
            url:'/add_hospitals',
            templateUrl:'mainadmin/add_hospitals',
            controller:'MAdminCtrl'
        })				 
		.state('home.haadmin_modules',{           
		url:'/haadmin_modules',           
		templateUrl:'mainadmin/modules_list',           
		controller:'MAdminCtrl'       
		})
		.state('home.haadmin_add_modules',{           
		url:'/add_modules',           
		templateUrl:'mainadmin/add_modules',           
		controller:'MAdminCtrl'       
		})
        .state('home.edit_hospitals',{
            url:'/edit_hospitals',
            templateUrl:'mainadmin/edit_hospital_dialog',
            controller:'MAdminCtrl'
             })
       
         .state('home.assign_hospital',{
            url:'/assign_hospital',
            templateUrl:'mainadmin/assign_org_branch',
            controller:'MAdminCtrl'
        });

    /* for hmadmin routing */

    $stateProvider
        .state('home.hmadmin_home', {
            url: '/hmadmin_home',
            templateUrl:'hmadmin/home',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_users',{
            url:'/hmadmin_users',
            templateUrl:'hmadmin/users',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_equipment_names',{
            url:'/hmadmin_equipment_names',
            templateUrl:'hmadmin/show_equp_names',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_add_equipment_name',{
            url:'/hmadmin_add_equipment_name',
            templateUrl:'hmadmin/add_equp_name',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_add_user',{
            url:'/hmadmin_add_user',
            templateUrl:'hmadmin/add_user',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_branches' +
            '',{
            url:'/hmadmin_branches',
            templateUrl:'hmadmin/branches',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_add_branch',{
            url:'/hmadmin_add_branch',
            templateUrl:'hmadmin/add_branch',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_search',{
            url: '/hmadmin_search',
            templateUrl:'hmadmin/search',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_print_labels',{
            url: '/hmadmin_print_labels',
            templateUrl:'hmadmin/labelPrint',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_equipment_summary',{
            url: '/hmadmin_equipment_summary',
            templateUrl:'welcome/coming_soon',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_today_calls',{
            url: '/hmadmin_today_calls',
            templateUrl:'hmadmin/today_calls',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_responded_calls',{
            url: '/hmadmin_responded_calls',
            templateUrl:'hmadmin/responded_calls',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_attended_calls',{
            url: '/hmadmin_attended_calls',
            templateUrl:'hmadmin/attended_calls',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_propen_calls',{
            url: '/hmadmin_propen_calls',
            templateUrl:'hmadmin/propen_calls',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_completed_calls',{
            url: '/hmadmin_completed_calls',
            templateUrl:'hmadmin/completed_calls',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_pending_pms',{
            url: '/hmadmin_pending_pms',
            templateUrl:'hbbme/Pending_pms',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_pending_qcs',{
            url: '/hmadmin_pending_qcs',
            templateUrl:'hbbme/Pending_qc',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_completed_pms',{
            url: '/hmadmin_completed_pms',
            templateUrl:'hbbme/Completed_pms',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_completed_qcs',{
            url: '/hmadmin_completed_qcs',
            templateUrl:'hbbme/Completed_qc',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_response_time_gmins',{
            url: '/hmadmin_response_time_gmins',
            templateUrl:'hmadmin/ResponseTime',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_time_repair_gdays',{
            url: '/hmadmin_time_repair_gdays',
            templateUrl:'hmadmin/TimeToRepair',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_call_log',{
            url: '/hmadmin_call_log',
            templateUrl:'welcome/coming_soon',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_activity_log',{
            url: '/hmadmin_activity_log',
            templateUrl:'welcome/coming_soon',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_monthly_performance_report',{
            url: '/hmadmin_monthly_performance_report',
            templateUrl:'welcome/coming_soon',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_vendors',{
            url: '/hmadmin_vendors',
            templateUrl:'hbhod/device_vendor',
            controller:'HMadminCtrl'
        })
		
		.state('home.hbhod_scheduled_calls',{
            url:'/hbhod_scheduled_calls',
            templateUrl:'hbhod/scheduled_calls',
            controller:'HBhodCtrl'
        })
		
		 .state('home.hbhod_add_scheduled_call',{
            url:'/hbhod_add_scheduled_call',
            templateUrl:'hbhod/add_scheduled_call',
            controller:'HBhodCtrl'
        })

        .state('home.hmadmin_add_vendor',{
            url: '/hmadmin_add_vendor',
            templateUrl:'hbhod/add_vendor',
            controller:'HMadminCtrl'
        })
        .state('home.hbbme_vendors',{
            url: '/hbbme_vendors',
            templateUrl:'hbhod/device_vendor',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_add_vendor',{
            url: '/hbbme_add_vendor',
            templateUrl:'hbhod/add_vendor',
            controller:'HBbmeCtrl'
        })
        .state('home.haadmin_countries',{
            url:'/haadmin_countries',
            templateUrl:'mainadmin/countries',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_country',{
            url:'/haadmin_add_country',
            templateUrl:'mainadmin/add_country',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_states',{
            url:'/haadmin_states',
            templateUrl:'mainadmin/states',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_state',{
            url:'/haadmin_add_state',
            templateUrl:'mainadmin/add_state',
            controller:'MAdminCtrl'
        })
		
		.state('home.depreciation',{
            url:'/depreciation',
            templateUrl:'mainadmin/depreciation',
            controller:'MAdminCtrl'
        })
		
		.state('home.add_table_name',{
			url:'/add_table_name',
			templateUrl:'mainadmin/add_table_name',
			controller:'MAdminCtrl'
		})
		
		.state('home.get_table_name',{
			url:'/get_table_name',
			templateUrl:'mainadmin/get_table_name',
			controller:'MAdminCtrl'
		})
		.state('home.ha_master_table',{
			url:'/ha_master_table',
			templateUrl:'mainadmin/get_master_table',
			controller:'MAdminCtrl'
		})
		.state('home.ha_add_master_table',{
			url:'/ha_add_master_table',
			templateUrl:'mainadmin/add_master_table',
			controller:'MAdminCtrl'
		})
		
		.state('home.update_table_name',{
			url:'/update_table_name',
			templateUrl:'mainadmin/update_table_name',
			controller:'MAdminCtrl'
		})

        .state('home.add_depreciation',{
            url:'/add_depreciation',
            templateUrl:'mainadmin/add_depreciation',
            controller:'MAdminCtrl'
        })
		
		.state('home.depreciation_details',{
            url:'/depreciation_details',
            templateUrl:'mainadmin/depreciation_details',
            controller:'MAdminCtrl'
        })
		
		.state('home.location',{
            url:'/location',
            templateUrl:'mainadmin/location',
            controller:'MAdminCtrl'
        })

        .state('home.add_location',{
            url:'/add_location',
            templateUrl:'mainadmin/add_location',
            controller:'MAdminCtrl'
        })
		
        .state('home.hmadmin_cities',{
            url: '/hmadmin_cities',
            templateUrl:'hbhod/cities',
            controller:'HMadminCtrl'
        })
        .state('home.hmadmin_add_city',{
            url: '/hmadmin_add_city',
            templateUrl:'hbhod/add_city',
            controller:'HMadminCtrl'
        })
        .state('home.admin_condemnation',{
            url: '/admin_condemnation',
            templateUrl:'master/admin_condemnation',
            controller:'HMadminCtrl'
        });

    /* for haadmin routing end */

    /* for hbhod routing */

    $stateProvider
        .state('home.hbhod_home', {
            url:'/hbhod_home',
            templateUrl:'hbhod/index',
            controller:'HBhodCtrl',
            resolve:
                {
                    // Static $title
                    $title: function() { return "Home"; },
                }
        })


        .state('home.hbhod_equipment_names',{
            url:'/hbhodn_equipment_names',
            templateUrl:'hbhod/show_equp_names',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_add_equipment_name',{
            url:'/hbhod_add_equipment_name',
            templateUrl:'hbhod/add_equp_name',
            controller:'HBhodCtrl'
        })

        .state('home.hbhod_import_asset',{
            url: '/hbhod_import_asset',
            templateUrl:'hbhod/importAsset',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_add_asset',{
            url: '/hbhod_add_asset',
            templateUrl:'hbhod/addAsset',
            controller:'HBhodCtrl'
        })

        .state('home.hbhod_search',{
            url: '/hbhod_search',
            templateUrl:'hbhod/search',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_print_labels',{
            url: '/hbhod_print_labels',
            templateUrl:'hbhod/labelPrint',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_equipment_summary',{
            url: '/hbhod_equipment_summary',
            templateUrl:'welcome/coming_soon',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_generate_call',{
            url: '/hbhod_generate_call',
            templateUrl:'hbhod/generateCalls',
            controller:'HBhodCtrl'
        })
		.state('home.hbbme_incident_call',{
            url: '/hbbme_incident_call',
            templateUrl:'hbbme/incidentCalls',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_transfer_call',{
            url: '/hbbme_transfer_call',
            templateUrl:'hbbme/transferCalls',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_non_scheduled_call',{
            url: '/hbbme_non_scheduled_call',
            templateUrl:'hbbme/NonScheduleCalls',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_condemn_call',{
            url: '/hbbme_condemn_call',
            templateUrl:'hbbme/condemnCalls',
            controller:'HBbmeCtrl'
        })
		
        .state('home.hbhod_today_calls',{
            url: '/hbhod_today_calls',
            templateUrl:'hbhod/today_calls',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_responded_calls',{
            url: '/hbhod_responded_calls',
            templateUrl:'hbbme/responded_calls',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_attended_calls',{
            url: '/hbhod_attended_calls',
            templateUrl:'hbhod/attended_calls',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_propen_calls',{
            url: '/hbhod_propen_calls',
            templateUrl:'hbhod/propen_calls',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_completed_calls',{
            url: '/hbhod_completed_calls',
            templateUrl:'hbhod/completed_calls',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_rounds_start',{
            url: '/hbhod_rounds_start',
            templateUrl:'hbhod/rounds_start',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_rounds_complete',{
            url: '/hbhod_rounds_complete',
            templateUrl:'hbhod/rounds_complete',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_rounds_assign',
            {
                url: '/hbhod_rounds_assign',
                templateUrl:'hbhod/rounds_assign',
                controller:'HBhodCtrl'
            })
        .state('home.hbhod_rounds_assigned',{
            url: '/hbhod_rounds_assigned',
            templateUrl:'hbhod/rounds_assigned',
            controller:'HBhodCtrl'
        })

        .state('home.hbhod_pending_pms',{
            url: '/hbhod_pending_pms',
            templateUrl:'hbhod/Pending_pms',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_pending_qcs',{
            url: '/hbhod_pending_qcs',
            templateUrl:'hbhod/Pending_qc',
            controller:'HBhodCtrl'
        })
		.state('home.hbhod_pending_scheduled',{
            url:'/hbhod_pending_scheduled',
            templateUrl:'hbhod/Scheduled_call',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_completed_pms',{
            url: '/hbhod_completed_pms',
            templateUrl:'hbhod/Completed_pms',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_completed_qcs',{
            url: '/hbhod_completed_qcs',
            templateUrl:'hbhod/Completed_qc',
            controller:'HBhodCtrl'
        })

        .state('home.hbhod_training_create',{
            url: '/hbhod_training_create',
            templateUrl:'hbhod/training_create',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_training_approved',{
            url: '/hbhod_training_approved',
            templateUrl:'hbhod/training_approved',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_training_conduct',{
            url: '/hbhod_training_conduct',
            templateUrl:'hbhod/training_conduct',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_training_feedback',{
            url: '/hbhod_training_feedback',
            templateUrl:'hbhod/training_feedback',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_training_request',{
            url: '/hbhod_training_request',
            templateUrl:'hbhod/training_request',
            controller:'HBhodCtrl'
        })

        .state('home.hbhod_call_log',{
            url: '/hbhod_call_log',
            templateUrl:'welcome/coming_soon',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_activity_log',{
            url: '/hbhod_activity_log',
            templateUrl:'welcome/coming_soon',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_monthly_performance_report',{
            url: '/hbhod_monthly_performance_report',
            templateUrl:'welcome/coming_soon',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_add_user',{
            url: '/hbhod_add_user',
            templateUrl:'hbhod/add_user',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_users',{
            url: '/hbhod_users',
            templateUrl:'hbhod/users',
            controller:'HBhodCtrl'
        })

        .state('home.hbhod_add_vendor',{
            url: '/hbhod_add_vendor',
            templateUrl:'hbhod/add_vendor',
            controller:'HBhodCtrl'
        })
        .state('home.hbhod_vendors',{
            url: '/hbhod_vendors',
            templateUrl:'hbhod/device_vendor',
            controller:'HBhodCtrl'
        });

    /* for hbhod routing end */

    /* for hbbme routing */

    $stateProvider
        .state('home.hbbme_home',
            {
                url:'/hbbme_home',
                templateUrl:'hbbme/index',
                controller:'HBbmeCtrl',
                resolve:
                    {
                        // Static $title
                        $title: function() { return "Home"; }
                    }
            })

        .state('home.hbbme_equipment_names',
            {
                url:'/hbbme_equipment_names',
                templateUrl:'hbbme/show_equp_names',
                controller:'HBbmeCtrl'
            })
        .state('home.hbbme_add_equipment_name',{
            url:'/hbbme_add_equipment_name',
            templateUrl:'hbbme/add_equp_name',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_import_asset',{
            url: '/hbbme_import_asset',
            templateUrl:'hbbme/importAsset',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_add_asset',{
            url: '/hbbme_add_asset',
            templateUrl:'hbbme/addAsset',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_edit_asset',{
            url: '/hbbme_edit_asset',
            templateUrl:'hbbme/editAsset',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_search',{
            url: '/hbbme_search',
            templateUrl:'hbbme/search',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_print_labels',{
            url: '/hbbme_print_labels',
            templateUrl:'hbbme/labelPrint',
            controller:'HBbmeCtrl'
        })
        .state('home.print_labels_pms_cal',{
            url: '/print_labels_pms_cal',
            templateUrl:'hbbme/labelPrintPmsQc',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_equipment_summary',{
            url: '/hbbme_equipment_summary',
            templateUrl:'welcome/coming_soon',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_generate_call',{
            url: '/hbbme_generate_call',
            templateUrl:'hbbme/generateCalls',
            controller:'HBbmeCtrl'
        })
        .state('home.other_generate_call',{
            url: '/other_generate_call',
            templateUrl:'hbbme/generateCallType',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_today_calls',{
            url: '/hbbme_today_calls',
            templateUrl:'hbbme/today_calls',
            controller:'HBbmeCtrl'
        })

        .state('home.hbbme_responded_calls',{
            url: '/hbbme_responded_calls',
            templateUrl:'hbbme/responded_calls',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_attended_calls',{
            url: '/hbbme_attended_calls',
            templateUrl:'hbbme/attended_calls',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_propen_calls',{
            url: '/hbbme_propen_calls',
            templateUrl:'hbbme/propen_calls',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_completed_calls',{
            url: '/hbbme_completed_calls',
            templateUrl:'hbbme/completed_calls',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_scheduled_calls',
            {
                url: '/hbbme_scheduled_calls',
                templateUrl:'hbbme/scheduled_calls',
                controller:'HBbmeCtrl'
            })
        .state('home.hbbme_pending_pms',{
            url: '/hbbme_pending_pms',
            templateUrl:'hbbme/Pending_pms',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_pending_qcs',{
            url: '/hbbme_pending_qcs',
            templateUrl:'hbbme/Pending_qc',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_completed_pms',{
            url: '/hbbme_completed_pms',
            templateUrl:'hbbme/Completed_pms',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_completed_qcs',{
            url: '/hbbme_completed_qcs',
            templateUrl:'hbbme/Completed_qc',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_rounds_start',{
            url: '/hbbme_rounds_start',
            templateUrl:'hbbme/rounds_start',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_rounds_complete',{
            url: '/hbbme_rounds_complete',
            templateUrl:'hbbme/rounds_complete',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_rounds_assign',{
            url: '/hbbme_rounds_assign',
            templateUrl:'hbbme/rounds_assign',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_rounds_assigned',{
            url: '/hbbme_rounds_assigned',
            templateUrl:'hbbme/rounds_assigned',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_response_time_gmins',{
            url: '/hbbme_response_time_gmins',
            templateUrl:'hbbme/ResponseTime',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_time_repair_gdays',{
            url: '/hbbme_time_repair_gdays',
            templateUrl:'hbbme/TimeToRepair',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_call_log',{
            url: '/hbbme_call_log',
            templateUrl:'welcome/coming_soon',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_activity_log',{
            url: '/hbbme_activity_log',
            templateUrl:'welcome/coming_soon',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_monthly_performance_report',{
            url: '/hbbme_monthly_performance_report',
            templateUrl:'welcome/coming_soon',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_training_create',{
            url: '/hbbme_training_create',
            templateUrl:'hbbme/training_create',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_training_approved',{
            url: '/hbbme_training_approved',
            templateUrl:'hbbme/training_approved',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_training_conduct',{
            url: '/hbbme_training_conduct',
            templateUrl:'hbbme/training_conduct',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_training_feedback',{
            url: '/hbbme_training_feedback',
            templateUrl:'hbbme/training_feedback',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_users',{
            url: '/hbbme_users',
            templateUrl:'hbbme/users',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_add_user',{
            url: '/hbbme_add_user',
            templateUrl:'hbbme/add_user',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_contract_type',{
            url: '/hbbme_contract_type',
            templateUrl:'hbbme/contract_types_list',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_add_contract_type',{
            url: '/hbbme_add_contract_type',
            templateUrl:'hbbme/add_contract_type',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_status',{
            url: '/hbbme_status',
            templateUrl:'hbbme/status_list',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_add_status',{
            url: '/hbbme_add_status',
            templateUrl:'hbbme/add_status',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_equipment_condition',{
            url: '/hbbme_equipment_condition',
            templateUrl:'hbbme/equipment_condition',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_add_equp_condition',{
            url: '/hbbme_add_equp_condition',
            templateUrl:'hbbme/add_equp_condition',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_equipment_class',{
            url: '/hbbme_equipment_class',
            templateUrl:'hbbme/equipment_class',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_add_equipment_class',{
            url: '/hbbme_add_equipment_class',
            templateUrl:'hbbme/add_equipment_class',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_utlization_value',{
            url: '/hbbme_utlization_value',
            templateUrl:'hbbme/utlization_value',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_add_utlization_value',{
            url: '/hbbme_add_utlization_value',
            templateUrl:'hbbme/add_utlization_value',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_training_type',{
            url: '/hbbme_training_type',
            templateUrl:'hbbme/training_type',
            controller:'HBbmeCtrl'
        })
        .state('home.hbbme_add_training_type',{
            url: '/hbbme_add_training_type',
            templateUrl:'hbbme/add_training_type',
            controller:'HBbmeCtrl'
        })


        .state('home.accessories',{
            url: '/accessories',
            templateUrl:'master/accessories',
            controller:'HBbmeCtrl'
        })
        .state('home.add_accessor',{
            url: '/add_accessor',
            templateUrl:'master/add_accessor',
            controller:'HBbmeCtrl'
        })
        .state('home.critical_spares',{
            url: '/critical_spares',
            templateUrl:'master/critical_spares',
            controller:'HBbmeCtrl'
        })
        .state('home.add_critical_spare',{
            url: '/add_critical_spare',
            templateUrl:'master/add_critical_spare',
            controller:'HBbmeCtrl'
        })
        .state('home.classifications',{
            url: '/classifications',
            templateUrl:'master/classifications',
            controller:'HBbmeCtrl'
        })
        .state('home.add_classification',{
            url: '/add_classification',
            templateUrl:'master/add_classification',
            controller:'HBbmeCtrl'
        })
        .state('home.equipment_types',{
            url: '/equipment_types',
            templateUrl:'master/equipment_types',
            controller:'HBbmeCtrl'
        })
        .state('home.add_equipment_type',{
            url: '/add_equipment_type',
            templateUrl:'master/add_equipment_type',
            controller:'HBbmeCtrl'
        })
        .state('home.departments',{
            url: '/departments',
            templateUrl:'master/view_departments',
            controller:'HBbmeCtrl'
        })
        .state('home.add_departments',{
            url: '/add_departments',
            templateUrl:'master/add_departments',
            controller:'HBbmeCtrl'
        })
        .state('home.cearcategory',{
            url: '/cear_category',
            templateUrl:'master/cear_category',
            controller:'HBbmeCtrl'
        })
        .state('home.add_cear_category',{
            url: '/add_cear_category',
            templateUrl:'master/add_cear_category',
            controller:'HBbmeCtrl'
        })
        .state('home.reasons',{
            url: '/reasons',
            templateUrl:'master/reasons',
            controller:'HBbmeCtrl'
        })
        .state('home.add_reasons',{
            url: '/add_reasons',
            templateUrl:'master/add_reasons',
            controller:'HBbmeCtrl'
        })
		.state('home.add_non_scheduled_reasons',{
            url: '/add_non_scheduled_reasons',
            templateUrl:'master/add_non_scheduled_reasons',
            controller:'HBbmeCtrl'
        })
        .state('home.haadmin_equpcondlabels',{
            url:'/haadmin_equpcondlabels',
            templateUrl:'mainadmin/equpcondlabels',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_equp_types_labels',{
            url:'/haadmin_equp_types_labels',
            templateUrl:'mainadmin/equptypeslabels',
            controller:'MAdminCtrl'
        })
		.state('home.haadmin_add_equp_type_labels',{
			url:'/haadmin_add_equp_type_labels',
			templateUrl:'mainadmin/addequptypelabels',
			controller:'MAdminCtrl',
		})
		.state('home.haadmin_countris_label',{
			url:'/haadmin_countris_label',
			templateUrl:'mainadmin/countries_label',
			controller:'MAdminCtrl',
		})
        .state('home.haadmin_add_country_label',{
            url:'/haadmin_add_country_label',
            templateUrl:'mainadmin/add_country_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_state_label',{
            url:'/haadmin_add_state_label',
            templateUrl:'mainadmin/add_state_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_city_label',{
            url:'/haadmin_add_city_label',
            templateUrl:'mainadmin/add_city_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_countries_label',{
            url:'/haadmin_countries_label',
            templateUrl:'mainadmin/countries_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_states_label',{
            url:'/haadmin_states_label',
            templateUrl:'mainadmin/states_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_cities_label',{
            url:'/haadmin_cities_label',
            templateUrl:'mainadmin/cities_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_user_label',{
                url:'/haadmin_user_label',
                templateUrl:'mainadmin/user_label',
                controller:'MAdminCtrl'
        })
        .state('home.haadmin_dept_label',{
            url:'/haadmin_dept_label',
            templateUrl:'mainadmin/department_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_devicenames_label',{
            url:'/haadmin_devicenames_label',
            templateUrl:'mainadmin/devicenames_label',
            controller:'MAdminCtrl'
        })
      .state('home.haadmin_add_user_label',{
                url:'/haadmin_add_user_label',
                templateUrl:'mainadmin/add_user_label',
                controller:'MAdminCtrl'
        })
     .state('home.haadmin_add_department_label',{
                url:'/haadmin_add_department_label',
                templateUrl:'mainadmin/add_department_label',
                controller:'MAdminCtrl'
            })
            .state('home.haadmin_add_devicenames_label',{
                url:'/haadmin_add_devicenames_label',
                templateUrl:'mainadmin/add_devicenames_label',
                controller:'MAdminCtrl'
            })
        .state('home.haadmin_branch_label',{
            url:'/haadmin_branch_label',
            templateUrl:'mainadmin/branch_labels',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_contracttype_labels',{
            url:'/haadmin_contracttype_labels',
            templateUrl:'mainadmin/contracttype_labels',
            controller:'MAdminCtrl'
         })
        .state('home.haadmin_incidenttype_labels',{
            url:'/haadmin_incidenttype_labels',
            templateUrl:'mainadmin/incidenttype_labels',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_branch_label',{
            url:'/haadmin_add_branch_label',
            templateUrl:'mainadmin/add_branch_labels',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_contracttype_label',{
            url:'/haadmin_add_contracttype_label',
            templateUrl:'mainadmin/add_contracttype_labels',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_incidenttype_label',{
            url:'/haadmin_add_incidenttype_label',
            templateUrl:'mainadmin/add_incidenttype_labels',
            controller:'MAdminCtrl'
        })
		.state('home.haadmin_device_label',{
			url:'/haadmin_device_label',
			templateUrl:'mainadmin/device_label',
			controller:'MAdminCtrl'
		})
		.state('home.haadmin_add_device_label',{
			url:'/haadmin_add_device_label',
			templateUrl:'mainadmin/add_device_label',
			controller:'MAdminCtrl'
		})
		
		.state('home.hadmin_item_master',{
			url:'/hadmin_item_master',
			templateUrl:'mainadmin/item_master',
			controller:'MAdminCtrl'
		})
		.state('home.hadmin_add_item_master',{
			url:'/hadmin_add_item_master',
			templateUrl:'mainadmin/add_item_master',
			controller:'MAdminCtrl'
		})


        .state('home.haadmin_escalation_label',{
            url:'/haadmin_escalation_label',
            templateUrl:'mainadmin/escalation_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_role_labels',{
            url:'/haadmin_role_labels',
            templateUrl:'mainadmin/role_labels',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_role_label',{
            url:'/haadmin_add_role_label',
            templateUrl:'mainadmin/add_role_labels',
            controller:'MAdminCtrl',
        })
        .state('home.haadmin_vendor_label',{
            url:'/haadmin_vendor_label',
            templateUrl:'mainadmin/vendor_label',
            controller:'MAdminCtrl',
        })
        .state('home.haadmin_add_vendor_label',{
            url:'/haadmin_add_vendor_label',
            templateUrl:'mainadmin/add_vendor_label',
            controller:'MAdminCtrl'
        })
		.state('home.haadmin_status_label',{
			url:'/haadmin_status_label',
			templateUrl:'mainadmin/status_label',
			controller:'MAdminCtrl'
		})
		.state('home.haadmin_add_status_label',{
			url:'/haadmin_add_status_label',
			templateUrl:'mainadmin/add_status_label',
			controller:'MAdminCtrl'
		})
		.state('home.haadmin_depreciation_label',{
			url:'/haadmin_depreciation_label',
			templateUrl:'mainadmin/depreciation_label',
			controller:'MAdminCtrl'
		})
		
		.state('home.haadmin_depreciation_add_label',{
		    url:'/haadmin_depreciation_add_label',
			templateUrl:'mainadmin/depreciation_add_label',
			controller:'MAdminCtrl'
		})
		
		.state('home.haadmin_util_label',{
            url:'/haadmin_util_label',
            templateUrl:'mainadmin/utilization_label',
            controller:'MAdminCtrl'
        })

        .state('home.haadmin_add_utilization_label',{
            url:'/haadmin_add_utilization_label',
            templateUrl:'mainadmin/add_utilization_label',
            controller:'MAdminCtrl'
        })

		
        .state('home.haadmin_esctype_label',{
            url:'/haadmin_esctype_label',
            templateUrl:'mainadmin/esctype_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_escalationlevel_label',{
            url:'/haadmin_escalationlevel_label',
            templateUrl:'mainadmin/escalationlevel_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_escalation_label',{
            url:'/haadmin_add_escalation_label',
            templateUrl:'mainadmin/add_escalation_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_esctype_label',{
            url:'/haadmin_add_esctype_label',
            templateUrl:'mainadmin/add_esctype_label',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_esclevel_label',{
            url:'/haadmin_add_esclevel_label',
            templateUrl:'mainadmin/add_esclevel_label',
            controller:'MAdminCtrl'
        })

        .state('home.haadmin_roles',{
            url:'/haadmin_roles',
            templateUrl:'mainadmin/role_types',
            controller:'MAdminCtrl'
        })
        .state('home.haadmin_add_role_type',{
            url:'/haadmin_add_role_type',
            templateUrl:'mainadmin/add_role_type',
            controller:'MAdminCtrl'
        })

        .state('home.haadmin_add_equpcondlabels',{
            url:'/haadmin_add_equpcondlabels',
            templateUrl:'mainadmin/add_equpcondlabels',
            controller:'MAdminCtrl'
        })

        .state('home.haadmin_add_equplabel',{
            url:'/add_equplabels',
            templateUrl:'mainadmin/add_equplabels',
            controller:'MAdminCtrl'
        })
        .state('home.non_scheduled_reasons',{
            url: '/non_scheduled_reasons',
            templateUrl:'master/non_scheduled_reasons',
            controller:'HBbmeCtrl'
        })
		
		.state('home.levels',{
            url: '/levels',
            templateUrl:'master/levels',
            controller:'HBbmeCtrl'
        })
        .state('home.add_levels',{
            url: '/add_levels',
            templateUrl:'master/add_levels',
            controller:'HBbmeCtrl'
        })
        .state('home.escalation',{
            url: '/escalation',
            templateUrl:'master/escalation',
            controller:'HBbmeCtrl'
        })
        .state('home.add_escalation',{
            url: '/add_escalation',
            templateUrl:'master/add_escalation',
            controller:'HBbmeCtrl'
        })
        .state('home.escalations',{
            url: '/escalations',
            templateUrl:'master/escalations',
            controller:'HBbmeCtrl'
        })
        .state('home.add_escalations1',{
            url: '/add_escalations1',
            templateUrl:'master/add_escalations1',
            controller:'HBbmeCtrl'
        })
        .state('home.view_devies',{
            url: '/view_devies',
            templateUrl:'master/view_devies',
            controller:'HBbmeCtrl'
        })
        .state('home.incident',{
            url: '/incident',
            templateUrl:'master/view_incident',
            controller:'HBbmeCtrl'
        })
        .state('home.replace_device',{
            url: '/replacement',
            templateUrl:'master/replace_device',
            controller:'HBbmeCtrl'
        })
        .state('home.observations',{
            url: '/observations',
            templateUrl:'master/view_observations',
            controller:'HBbmeCtrl'
        })
        .state('home.incident_type',{
            url: '/incident_type',
            templateUrl:'master/incident_type',
            controller:'HBbmeCtrl'
        })
        .state('home.add_incident_type',{
            url: '/add_incident_type',
            templateUrl:'master/add_incident_type',
            controller:'HBbmeCtrl'
        })
        .state('home.maintain_contracts',{
            url: '/maintain_contracts',
            templateUrl:'master/maintain_contracts',
            controller:'HBbmeCtrl'
        })
        .state('home.add_maintain_contracts',{
            url: '/add_maintain_contracts',
            templateUrl:'master/add_maintain_contracts',
            controller:'HBbmeCtrl'
        })
        .state('home.add_multiple_contracts',{
            url: '/add_multiple_contracts',
            templateUrl:'master/add_multiple_contracts',
            controller:'HBbmeCtrl'
        })
        .state('home.edit_device',{
            url: '/edit_device',
            templateUrl:'master/edit_device',
            controller:'HBbmeCtrl'
        })
    
        .state('home.gatepass',{
            url: '/gatepass',
            templateUrl:'master/gatepass',
            controller:'HBbmeCtrl'
        })
        .state('home.rindent',{
            url: '/rindent',
            templateUrl:'master/rindent',
            controller:'HBbmeCtrl'
        })
        .state('home.rcear',{
            url: '/rcear',
            templateUrl:'master/rcear',
            controller:'HBbmeCtrl'
        })
        .state('home.rscreport',{
            url: '/rscreport',
            templateUrl:'master/rscreport',
            controller:'HBbmeCtrl'
        });
    $stateProvider
        .state('home.hbuser_home', {
            url:'/hbuser_home',
            templateUrl:'hbuser/index',
            controller:'HBuserCtrl'
        })
        .state('home.hbuser_generate_call',{
            url: '/hbuser_generate_call',
            templateUrl:'hbuser/generate_call',
            controller:'HBuserCtrl'
        })
        .state('home.hbuser_training_feedback',{
            url: '/hbuser_training_feedback',
            templateUrl:'hbuser/training_feedback',
            controller:'HBuserCtrl'
        });

    /* for hbbme routing end */


    /* for new */

    $stateProvider
        .state('home.viability', {
            url:'/viability',
            templateUrl:'master/viability',
            controller:'HBbmeCtrl'
        })
        .state('home.add_viabilty', {
            url:'/add_viabilty',
            templateUrl:'master/add_viabilty',
            controller:'HBbmeCtrl'
        })
        .state('home.rviability', {
            url:'/rviability',
            templateUrl:'master/viability_report',
            controller:'HBbmeCtrl'
        })
        .state('home.rnscreport', {
            url:'/rnscreport',
            templateUrl:'master/rnscreport',
            controller:'HBbmeCtrl'
        })
        .state('home.radverse',{
            url: '/radverse',
            templateUrl:'master/adverse_reports',
            controller:'HBbmeCtrl'
        })
        .state('home.reports',{
            url: '/reports',
            templateUrl:'master/reports',
            controller:'HBbmeCtrl'
        })
        .state('home.rservices',{
            url: '/rservices',
            templateUrl:'master/services_report',
            controller:'HBbmeCtrl'
        })
        .state('home.rredeployment',{
            url: '/rredeployment',
            templateUrl:'master/redeployment_report',
            controller:'HBbmeCtrl'
        })
        .state('home.rpms',{
            url: '/pms_report',
            templateUrl:'master/pms_report',
            controller:'HBbmeCtrl'
        })
        .state('home.rqc',{
            url: '/qc_report',
            templateUrl:'master/qc_report',
            controller:'HBbmeCtrl'
        })
        .state('home.condemnation',{
            url: '/condemnation',
            templateUrl:'master/condemnation',
            controller:'HBbmeCtrl'
        })
        .state('home.rcondemnation',{
            url: '/condemnation_report',
            templateUrl:'master/condemnation_report',
            controller:'HBbmeCtrl'
        })
        .state('home.condemnation_request',{
            url: '/condemnation_request',
            templateUrl:'master/condemnation_request',
            controller:'HBbmeCtrl'
        })
        .state('home.condemnation_reason',{
            url: '/condemnation_reason',
            templateUrl:'master/condemnation_reason',
            controller:'HBbmeCtrl'
        })
        .state('home.condmnation_resold_values',{
            url: '/condmnation_resold_values',
            templateUrl:'master/condmnation_resold_values',
            controller:'HBbmeCtrl'
        })
        .state('home.add_condmnation_resold_values',{
            url: '/add_condmnation_resold_values',
            templateUrl:'master/add_condmnation_resold_values',
            controller:'HBbmeCtrl'
        })
        .state('home.add_condemnation',{
            url: '/add_condemnation',
            templateUrl:'master/add_condemnation',
            controller:'HBbmeCtrl'
        })
        .state('home.rcall_log',{
            url: '/call_log_reports',
            templateUrl:'master/call_log_reports',
            controller:'HBbmeCtrl'
        })
        .state('home.requipment_summary',{
            url: '/requipment_summary',
            templateUrl:'master/equipment_summary',
            controller:'HBbmeCtrl'
        })
        .state('home.cear',{
            url: '/cear',
            templateUrl:'master/cear',
            controller:'HBbmeCtrl'
        })
        .state('home.cear_request',{
            url: '/cear_request',
            templateUrl:'master/cear_request',
            controller:'HBbmeCtrl'
        })
        .state('home.indent_equipment',{
            url: '/indent_equipment',
            templateUrl:'master/indent_equipment',
            controller:'HBbmeCtrl'
        })
        .state('home.indent_equipment_request',{
            url: '/indent_equipment_request',
            templateUrl:'master/indent_equipment_request',
            controller:'HBbmeCtrl'
        })
        .state('home.gate_pass_new',{
            url: '/gate_pass_new',
            templateUrl:'master/gate_pass_new',
            controller:'HBbmeCtrl'
        })
        .state('home.gate_pass_request',{
            url: '/gate_pass_request',
            templateUrl:'master/gate_pass_request',
            controller:'HBbmeCtrl'
        })
        .state('home.add_stock',{
            url: '/add_stock',
            templateUrl:'device/add_stock',
            controller:'HBbmeCtrl'
        })
        .state('home.ractivity_log',{
            url: '/ractivity_log',
            templateUrl:'welcome/coming_soon',
            controller:'HBuserCtrl'
        })
        .state('home.rmonthly_performance_report',{
            url: '/rmonthly_performance_report',
            templateUrl:'master/view_monthly_performance_report',
            controller:'HBuserCtrl'
        })
        .state('home.monthly_performance_report',{
            url: '/monthly_performance_report',
            templateUrl:'master/view_monthly_performance_report',
            controller:'HBbmeCtrl'
        })
        .state('home.rdemo_equipment',{
            url: '/rdemo_equipment',
            templateUrl:'welcome/coming_soon',
            controller:'HBuserCtrl'
        })
        .state('home.rtrainings',{
            url: '/rtrainings',
            templateUrl:'welcome/coming_soon',
            controller:'HBuserCtrl'
        })

        .state('home.rreplacement',{
            url: '/rreplacement',
            templateUrl:'welcome/coming_soon',
            controller:'HBuserCtrl'
        })
        .state('home.other_unit',{
            url: '/other_unit',
            templateUrl:'master/other_unit_request',
            controller:'HBbmeCtrl'
        })
        .state('home.transfer',{
            url: '/transfer',
            templateUrl:'master/transfer',
            controller:'HBbmeCtrl'
        })
        .state('home.transfer_within_unit',{
            url: '/transfer_within_unit',
            templateUrl:'master/transfer_within_unit',
            controller:'HBbmeCtrl'
        })
        .state('home.other_unit_approval',{
            url: '/other_unit_approval',
            templateUrl:'master/other_unit_approval',
            controller:'HBbmeCtrl'
        })
        .state('home.other_unit_transfer',{
            url: '/other_unit_transfer',
            templateUrl:'master/other_unit_transfer',
            controller:'HBbmeCtrl'
        })
        .state('home.transfer_calls',{
            url: '/transfer_calls',
            templateUrl:'master/transfer_calls',
            controller:'HBbmeCtrl'
        })
        .state('home.condemnation_calls',{
            url: '/condemnation_calls',
            templateUrl:'master/condemnation_calls',
            controller:'HBbmeCtrl'
        })
        .state('home.rounds_calls',{
            url: '/rounds_calls',
            templateUrl:'master/rounds_calls',
            controller:'HBbmeCtrl'
        })
        .state('home.adverse_calls',{
            url: '/adverse_calls',
            templateUrl:'master/adverse_calls',
            controller:'HBbmeCtrl'
        })
        .state('home.adverse_reports',{
            url: '/adverse_reports',
            templateUrl:'master/adverse_reports',
            controller:'HBbmeCtrl'
        })
        .state('home.adverse_report_pdf',{
            url: '/adverse_report_pdf',
            templateUrl:'master/adverse_report_pdf',
            controller:'HBbmeCtrl'
        })
        .state('home.deployment_report',{
            url: '/deployment_report',
            templateUrl:'master/deployment',
            controller:'HBbmeCtrl'
        })
        .state('home.deployment',{
            url: '/deployment',
            templateUrl:'master/deployment',
            controller:'HBbmeCtrl'
        })
        .state('home.graphs',{
            url: '/graphs',
            templateUrl:'master/graphs',
            controller:'HBbmeCtrl'
        })
        .state('home.dummy_pdf',{
            url: '/dummy_pdf',
            templateUrl:'master/dummy_pdf',
            controller:'HBbmeCtrl'
        })
        .state('home.cms_report',{
            url: '/cms_report',
            templateUrl:'master/cms_report',
            controller:'HBbmeCtrl'
        })
        .state('home.pdf_deployment_report',{
            url: '/pdf_deployment_report',
            templateUrl:'reports/view_deployment_report_dialog',
            controller:'HBbmeCtrl'
        })
        .state('home.open_calls',{
            url: '/open_calls',
            templateUrl:'device/open_calls',
            controller:'HBbmeCtrl'
        })
        .state('home.about_product',{
            url: '/about_product',
            templateUrl:'master/about_product',
            controller:'HBbmeCtrl'
        })
        .state('home.web_application',{
            url: '/web_application',
            templateUrl:'master/web_application',
            controller:'HBbmeCtrl'
        })
        .state('home.mobile_app',{
            url: '/mobile_app',
            templateUrl:'master/mobile_app',
            controller:'HBbmeCtrl'
        })
        .state('home.equp_down_time',{
            url: '/equp_down_time',
            templateUrl:'master/equp_down_time',
            controller:'HBbmeCtrl'
        })
        .state('home.monthly_performance_graph',{
            url: '/monthly_performance_graph',
            templateUrl:'master/monthly_performance_graph',
            controller:'HBbmeCtrl'
        })
        .state('home.asset_management_other_activites',{
            url: '/asset_management_other_activites',
            templateUrl:'master/asset_management_other_activites',
            controller:'HBbmeCtrl'
        })
        .state('home.equp_history_card',{
            url: '/equp_history_card',
            templateUrl:'master/equp_history_card',
            controller:'HBbmeCtrl'
        })
        .state('home.mail_fun',{
            url: '/mail_fun',
            templateUrl:'master/mail_fun',
            controller:'HBbmeCtrl'
        })
        .state('home.stock',{
            url: '/stock',
            templateUrl:'master/stock',
            controller:'HBbmeCtrl'
        })
        .state('home.stock_report',{
            url: '/stock_report',
            templateUrl:'master/stock_report',
            controller:'HBbmeCtrl'
        })
        .state('home.org_roles',{
            url: '/org_roles',
            templateUrl:'master/org_roles',
            controller:'HMadminCtrl'
        })
        .state('home.add_org_roles',{
            url: '/add_org_roles',
            templateUrl:'master/add_org_roles',
            controller:'HMadminCtrl'
        })
        .state('home.edit_org_roles',{
            url: '/edit_org_roles',
            templateUrl:'mainadmin/edit_org_roles',
            controller:'HMadminCtrl'
        })

        .state('home.my_transitions',{
            url: '/my_transitions',
            templateUrl:'master/my_transitions',
            controller:'HBbmeCtrl'
        })
        .state('home.condemination_new',{
            url: '/condemination_new',
            templateUrl:'master/condemination_new',
            controller:'HBbmeCtrl'
        })
        .state('home.adverse_call_new',{
            url: '/adverse_call_new',
            templateUrl:'master/adverse_call_new',
            controller:'HBbmeCtrl'
        })
        .state('home.gate_pass_new_mytransion',{
            url: '/gate_pass_new_mytransion',
            templateUrl:'master/gate_pass_new_mytransion',
            controller:'HBbmeCtrl'
        })
        .state('home.viability_new',{
            url: '/viability_new',
            templateUrl:'master/viability_new',
            controller:'HBbmeCtrl'
        })
        .state('home.transfer_new',{
            url: '/transfer_new',
            templateUrl:'master/transfer_new',
            controller:'HBbmeCtrl'
        })
        .state('home.cear_new',{
            url: '/cear_new',
            templateUrl:'master/cear_new',
            controller:'HBbmeCtrl'
        })
        .state('home.indent_new',{
            url: '/indent_new',
            templateUrl:'master/indent_new',
            controller:'HBbmeCtrl'
        })
        .state('home.rounds_new',{
            url: '/rounds_new',
            templateUrl:'master/rounds_new',
            controller:'HBbmeCtrl'
        })
        .state('home.maintance_contracts_new',{
            url: '/maintance_contracts_new',
            templateUrl:'master/maintance_contracts_new',
            controller:'HBbmeCtrl'
        })
        .state('home.instalation_new',{
            url: '/instalation_new',
            templateUrl:'master/instalation_new',
            controller:'HBbmeCtrl'
        })
        .state('home.scheduled_calls_new',{
            url: '/scheduled_calls_new',
            templateUrl:'master/scheduled_calls_new',
            controller:'HBbmeCtrl'
        })
        .state('home.non_scheduled_calls_new',{
            url: '/non_scheduled_calls_new',
            templateUrl:'master/non_scheduled_calls_new',
            controller:'HBbmeCtrl'
        })
        .state('home.generated_calls_new',{
            url: '/generated_calls_new',
            templateUrl:'master/generated_calls_new',
            controller:'HBbmeCtrl'
        })
		.state('home.org_create_form',{
			url:'/org_create_form',
			templateUrl:'master/org_create_form',
			controller:'MAdminCtrl'
		})
		.state('home.add_org_create_form',{
			url:'/add_org_create_form',
			templateUrl:'master/add_org_create_form',
			controller:'MAdminCtrl'
		})
        .state('home.mycalls',{
            url: '/mycalls',
            templateUrl:'master/mycalls',
            controller:'HBhodCtrl'
        })
        .state('home.transfer_device',{
            url: '/transfer_device',
            templateUrl:'master/transfer_device',
            controller:'HBbmeCtrl'
        })
		.state('home.vendor_pending_pms',{
            url: '/pending_pms',
            templateUrl:'master/vendor_pending_pms',
            controller:'HBbmeCtrl'
        })
        .state('home.edit-vequipment',{
                url: '/edit_vendor_equipment',
                templateUrl:'master/edit_vequipment',
                controller:'HBhodCtrl'
            }
       
        );

    unsavedWarningsConfigProvider.useTranslateService = true;
    unsavedWarningsConfigProvider.logEnabled = true;
    unsavedWarningsConfigProvider.routeEvent = '$stateChangeStart';
    unsavedWarningsConfigProvider.navigateMessage = "This page is asking you to confirm that you want to leave - data you have entered may not be saved";
    unsavedWarningsConfigProvider.reloadMessage = "This page is asking you to confirm that you want to leave - data you have entered may not be saved";
}]);