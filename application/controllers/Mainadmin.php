<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainadmin extends CI_Controller
{
        
    public function __construct()
    {
		
        parent::__construct();
		 date_default_timezone_set('Asia/Kolkata');
        header('Access-Control-Allow-Origin:*');
		 
        $this->load->model('organizations');
        $this->load->model('hospitals');
        $this->load->library('pdf');
        $this->load->library('mailer');
        $this->load->library('baselibrary');
        $this->load->model('contactpersons');
        $this->load->model('qceqcats');
        $this->load->model('basemodel');
        $this->load->model('devices');
        $this->load->model('pmsdetails');
        $this->load->model('qcdetails');
        $this->load->model('contractstatus');
        $this->load->model('equpstatus');
        $this->load->model('users');
        $this->load->model('cms');
        $this->load->model('userdeprts');
        $this->load->model('equprelocation');
        $this->load->model('contracttypes');
        $this->load->model('equptypes');
        //$this->load->model('equpconditions');
        $this->load->model('baseauth');
        $this->load->model('branches');
        $this->load->model('cities');
        $this->load->model('roles');
        $this->load->model('tkn');
        $this->load->model('reasons');
        $this->load->model('priorities');
        $this->load->model('causecodes');
        $this->load->model('trainings');
        $this->load->model('trainingtypes');
        $this->load->model('trainingby');
        $this->load->model('trainingattends');
        $this->load->model('rounds');
        $this->load->model('rounds_assigned');
        $this->load->model('devicenames');
        $this->load->model('dbrkdwns');
        $this->load->model('deviceamcs');
        $this->load->model('classifications');
        $this->load->model('utillvalues');
        $this->load->model('incedenttype');
        $this->load->model('incedents');
        $this->load->model('condemnation');
        $this->load->model('transfer');
        $this->load->model('condemnationrequest');
        $this->load->model('reusableparts');
        $this->load->model('accessories');
        $this->load->model('criticalspares');
        $this->load->model('countrieslabels');
        $this->load->model('statelabels');
        $this->load->model('citieslabels');
		$this->load->model('scheduledcalls');
		$this->load->model('equptypelabels');
        $this->load->model('indents');
        $this->load->model('cear');
        $this->load->model('gatepass');
        $this->load->model('state');
        $this->load->model('country');
        $this->load->model('cities');
        $this->load->model('organizationtypes');
        $this->load->model('features');
        $this->load->model('subfeatures');
        $this->load->model('ssubfeatures');
        $this->load->model('orgroles');
        $this->load->model('rolelabels');
       // $this->load->model('utilization_label');
        $this->load->model('equpcondlabels');
        $this->load->model('aptorganizations');
        $this->load->model('incidenttypelables');
        $this->load->model('contracttypelabels');
        $this->load->model('branchlabels');
        $this->load->model('appointments');
        $this->load->model('roletypes');
        $this->load->model('devicenameslabels');
        $this->load->model('departmentlabels');
        $this->load->model('userlabels');
		$this->load->model('depreciation');
		$this->load->model('statuslabels');
		$this->load->model('depreciation_label');
		$this->load->model('modules');
		$this->load->model('vendor_label');
		$this->load->model('esclabels');
		$this->load->model('esclevellabels');
		$this->load->model('devicelabels');
		$this->load->model('esctypelabels');
		$this->load->model('table_names');
		$this->load->model('master_table');
		$this->load->model('item_master');
		$this->load->model('datatypes');
	
		
       
        include APPPATH . 'libraries/simplexlsx_class.php';
    }
    public function index()
    {
        include_once APPPATH . 'libraries/HA_BKP/MainRest.php';
    }
    private function _key_rest($base_data = '', $content_type = '')
    {
		
            
        if (!is_null($base_data) && $content_type == $this->baseauth->appjson) {
            if(isset($jodata->org))
                $orgs = $this->basemodel->fetch_records_from($this->organizations->tbl_name,array($this->organizations->STATUS=>ACTIVESTS),$this->organizations->ORG_ID);
            for($i = 0; $i < count($orgs); $i++)
                $org[$i] = "'".$orgs[$i]['ORG_ID']."'";
            $org = '(' . implode($org, ',') . ')';
            //$dw =[$this->organizations->ORG_ID]. "IN " .$org;
            defined('ORGALL') OR define('ORGALL', $org);

            $data = array();
            $jodata = json_decode($base_data);
            $action = $jodata->action;
            if ($action == 'add_hospital')
                $data = $this->_add_hospital($jodata);
            else if($action=="get_hospitals")
                $data=$this->_get_hospitals($jodata);
            else if($action=="update_hospitals")
                $data=$this->_update_hospitals($jodata);
            else if($action=="get_orgtypes")
                $data=$this->_get_orgtypes($jodata);
            else if($action=="get_states_by_country_id")
                $data=$this->_get_states_by_country_id($jodata);
            else if($action=="get_Branch_DetailsBy_HospitalID")
                $data = $this->_get_Branch_DetailsBy_HospitalID($jodata);
            else if($action=="get_branch_by_hospital_id")
                $data = $this->_get_branch_by_hospital_id($jodata);
            else if($action=="get_cities_by_state_id")
                $data=$this->_get_cities_by_state_id($jodata);
            else if($action=="get_role_type_list")
                $data=$this->_get_role_type_list($jodata);
            else if($action=="update_role_type")
                $data=$this->_update_role_type($jodata);
            else if($action=="get_futures_list")
                $data=$this->_get_futures_list($jodata);
            else if($action=="get_hospitals_vendor")
                $data=$this->_get_hospitals_vendor($jodata);
            else if($action=="get_subfetures_by_futures_id")
                $data=$this->_get_subfetures_by_futures_id($jodata);
            else if($action=="get_subfetures")
                $data=$this->_get_subfetures($jodata);
            else if($action=="get_org_role_features")
                $data=$this->_get_org_role_features($jodata);
            else if($action=="add_org_role")
                $data=$this->_add_org_role($jodata);
			else if($action=="check_hospital_email")
				$data=$this->_check_hospital_email($jodata);
            else if($action=="add_role_type")
                $data=$this->_add_role_type($jodata);
            else if ($action == 'get_edit_org_roles')
                $data = $this->_get_edit_org_roles($jodata);
            else if($action=='get_equp_type_labels_list')
                $data = $this->_get_equp_type_labels_list($jodata);
            else if($action=='update_equp_type_labels_list')
                $data = $this->_update_equp_type_labels_list($jodata);
            else if($action=='get_countries_labels_list')
                $data=$this->_get_countries_labels_list($jodata);
            else if($action=='get_states_labels_list')
                $data=$this->_get_states_labels_list($jodata);
            else if($action=='get_cities_labels_list')
                $data=$this->_get_cities_labels_list($jodata);
            else if($action=='update_country_label')
                $data=$this->_update_country_label($jodata);
            else if($action=='update_cities_label')
                $data=$this->_update_cities_label($jodata);
            else if($action=='update_states_label')
                $data=$this->_update_states_label($jodata);
            else if ($action == 'get_apt_organizations')
                $data = $this->_get_apt_organizations($jodata);
            else if ($action == 'add_apt_hospital')
                $data = $this->_add_apt_hospital($jodata);
            else if ($action == 'update_apt_hospitals')
                $data = $this->_update_apt_hospitals($jodata);
            else if ($action == 'get_appointment_list')
                $data = $this->_get_appointment_list($jodata);
            else if($action=="equp_cond_labels_list")
                $data = $this->_equp_cond_labels_list($jodata);
            else if($action=="update_equp_cond_labels")
                $data = $this->_update_equp_cond_labels($jodata);
            else if($action=="equp_cond_labels_orglist")
                $data = $this->_equp_cond_labels_orglist($jodata);
            else if($action=="add_equpcond_label")
                $data = $this->_add_equpcond_label($jodata);
            else if ($action == 'add_appoinment_list')
                $data = $this->_add_appoinment_list($jodata);
            else if ($action == 'update_appointment_list')
                $data = $this->_update_appointment_list($jodata);
            else if ($action == 'convert_appointment_list')
                $data = $this->_convert_appointment_list($jodata);
            else if ($action == 'get_cp_apt_details')
                $data = $this->_get_cp_apt_details($jodata);
            else if ($action == 'hospital_assign')
                $data = $this->_hospital_assign($jodata);
            else if($action =='add_equp_type_label')
                $data = $this->_add_equp_type_label($jodata);
			else if($action=="get_existing_list")
                $data=$this->_get_existing_list($jodata);
			else if($action=="add_scheduled_call")
                $data=$this->_add_scheduled_call($jodata);
			 else if($action=="get_depreciation_devices")
                $data=$this->_get_depreciation_devices($jodata);
			else if($action=="get_org_features_list")
                $data=$this->_get_org_features_list($jodata);
			else if($action=="get_existing_org_features_list")
                $data=$this->_get_existing_org_features_list($jodata);
			else if($action=="add_country_label")
			    $data = $this->_add_country_label($jodata);
			else if($action=="add_state_label")
			    $data = $this->_add_state_label($jodata);
			else if($action=="add_city_label")
			    $data = $this->_add_city_label($jodata);
			else if($action=="add_user_label")
			    $data = $this->_add_user_label($jodata);
			else if($action=="add_device_label")
				$data = $this->_add_device_label($jodata);
            else if($action=="add_department_label")
                $data = $this->_add_department_label($jodata);
            else if($action=="add_devicenames_label")
                $data = $this->_add_devicenames_label($jodata);
            else if($action=="get_user_labels")
                $data = $this->_get_user_labels($jodata);
            else if($action=="get_esctype_labels")
                $data = $this->_get_esctype_labels($jodata);
			else if($action=="get_label_list")
				$data = $this->_get_label_list($jodata);
            else if($action=="get_esclevels_labels")
                $data = $this->_get_esclevels_labels($jodata);
            else if($action=="get_escalation_labels")
                $data = $this->_get_escalation_labels($jodata);
            else if($action=="get_branch_labels")
                $data = $this->_get_branch_labels($jodata);
            else if($action=="get_incidenttype_lables")
                $data = $this->_get_incidenttype_lables($jodata);
            else if($action=="get_contracttype_labels")
                $data = $this->_get_contracttype_labels($jodata);
            else if($action=="add_branch_label")
                $data = $this->_add_branch_label($jodata);
            else if($action=="add_contracttype_label")
                $data = $this->_add_contracttype_label($jodata);
            else if($action=="add_incidenttype_label")
                $data = $this->_add_incidenttype_label($jodata);
            else if($action=="get_devicenames_labels")
                $data = $this->_get_devicenames_labels($jodata);
            else if($action=="get_department_labels")
                $data = $this->_get_department_labels($jodata);
            else if($action=="update_user_label")
                $data = $this->_update_user_label($jodata);
            else if($action=="update_dept_label")
                $data = $this->_update_dept_label($jodata);
            else if($action=="update_branch_label")
                $data = $this->_update_branch_label($jodata);
            else if($action=="update_escalation_labels")
                $data = $this->_update_escalation_labels($jodata);
            else if($action=="update_escalation_level_labels")
                $data = $this->_update_escalation_level_labels($jodata);
            else if($action=="update_escalation_type_labels")
                $data = $this->_update_escalation_type_labels($jodata);
            else if($action=="update_incidenttype_label")
                $data = $this->_update_incidenttype_label($jodata);
            else if($action=="update_contracttype_label")
                $data = $this->_update_contracttype_label($jodata);
            else if($action=="add_esctype_label")
                $data = $this->_add_esctype_label($jodata);
            else if($action=="add_esclevel_label")
                $data = $this->_add_esclevel_label($jodata);
            else if($action=="add_escalation_label")
                $data = $this->_add_escalation_label($jodata);
            else if($action=="update_devicename_label")
                $data = $this->_update_devicename_label($jodata);
            else if($action=="update_role_labels")
                $data = $this->_update_role_labels($jodata);
            else if($action=="update_vendor_label")
                $data = $this->_update_vendor_label($jodata);
            else if($action=="update_util_labels")
                $data = $this->_update_util_labels($jodata);
            else if($action=="add_role_label")
                $data = $this->_add_role_label($jodata);
            else if($action=="get_util_labels")
                $data = $this->_get_util_labels($jodata);
            else if($action=="add_util_label")
                $data = $this->_add_util_label($jodata);
            else if($action=="add_vendor_label")
                $data = $this->_add_vendor_label($jodata);
            else if($action=="get_vendor_label")
                $data = $this->_get_vendor_label($jodata);
            else if($action=="get_role_labels")
                $data = $this->_get_role_labels($jodata);
			else if($action=="get_scheduled_call_type")
                $data=$this->_get_scheduled_call_type($jodata);
            else if ($action == 'get_hosp_urls')
                $data = $this->_get_hosp_urls($jodata);
            else if($action=="get_subsubfeatures")
                $data=$this->_get_subsubfeatures($jodata);
            else if($action=="add_status_label")
                $data = $this->_add_status_label($jodata);
            else if($action=="get_status_label")
                $data = $this->_get_status_label($jodata);
            else if($action=="get_depreciation_label")
                $data = $this->_get_depreciation_label($jodata);
            else if($action=="update_status_label")
                $data = $this->_update_status_label($jodata);
            else if($action=="update_depreciation_label")
                $data = $this->_update_depreciation_label($jodata);
            else if($action=="add_depreciation_label")
                $data = $this->_add_depreciation_label($jodata);
			else if($action=="add_table_name")
				$data = $this->_add_table_name($jodata);
			else if($action=="update_table_name")
				$data = $this->_update_table_name($jodata);
			else if($action=="get_table_name")
				$data = $this->_get_table_name($jodata);
			else if($action=="get_item_masters")
				$data = $this->_get_item_masters($jodata);
			else if($action=="add_item_master")
				$data = $this->_add_item_model($jodata);
			else if($action=="update_labels_list")
				$data = $this->_update_labels_list($jodata);
			else if($action=="update_item_master")
				$data = $this->_update_item_master($jodata);
			else if($action=="update_module_list")
				$data = $this->_update_module($jodata);
			else if($action=="add_master_table")
				$data = $this->_add_master_table($jodata);
			else if($action=="get_master_table")
				$data = $this->_get_master_table($jodata);
			else if($action=="get_tables_by_module")
				$data = $this->_get_tables_by_module($jodata);
			else if($action=="get_org_forms")
				$data = $this->_get_org_forms($jodata);
			else if($action=="get_org_master_table")
				$data = $this->_get_org_master_table($jodata);
			else if($action=="get_device_form")
				$data = $this->_get_device_form($jodata);
			else if($action=="get_datatypes")
				$data = $this->_get_datatypes($jodata);
			else if($action=="get_org_master_table1")
				$data= $this->_get_org_master_table1($jodata);

            echo json_encode($data);
        }
    }

    public function madmin_home()
    {
        $this->load->view('madmin/madmin-home');

    }
    public function vendor_home()
    {
        $this->load->view('vendor/load_hospitals');
    }

    public function today_calls()
    {
        $this->load->view('vendor/today_calls');
    }
	public function location()
    {
        $this->load->view('location');
    }

    public function add_location()
    {
        $this->load->view('add_location');
    }
    public function countries()
    {
        $this->load->view('countries');
    }
    public function states()
    {
        $this->load->view('states');
    }
    public function add_state()
    {
        $this->load->view('add_state');
    }
    public function add_country()
    {
        $this->load->view('add_country');
			
    }
	public function add_table_name()
	{
		$this->load->view('add_table_name');
	}
	public function get_table_name()
	{
		$this->load->view('get_table_name');
	}
	public function get_master_table()
	{
		$this->load->view('get_master_table');
	}
	public function add_master_table()
	{
		$this->load->view('add_master_table');
	}
	public function edit_table_name()
	{
		$this->load->view('dialogs/edit_table_name');
	}
    public function add_country_label()
    {
        $this->load->view('madmin/add_country_label');
    }
    public function add_state_label()
    {
        $this->load->view('madmin/add_state_label');
    }
    public function add_city_label()
    {
        $this->load->view('madmin/add_city_label');
    }
    public function edit_state_label_list()
    {
        $this->load->view('madmin/dialogs/edit_state_label_list');
    }
    public function edit_city_label_list()
    {
        $this->load->view('madmin/dialogs/edit_city_label_list');
    }
	public function edit_org_form_creation()
	{
		$this->load->view('dialogs/edit_org_form_creation');
	}
    public function edit_country_label_list()
    {
        $this->load->view('madmin/dialogs/edit_country_label_list');
    }
    public function edit_user_label_list()
    {
        $this->load->view('madmin/dialogs/edit_user_label_list');
    }

    public function edit_dept_label_list()
    {
        $this->load->view('madmin/dialogs/edit_dept_label_list');
    }

    public function edit_util_label()
    {
        $this->load->view('madmin/dialogs/edit_util_label');
    }
	
	public function edit_module_list()
	{
		$this->load->view('dialogs/edit_module_list');
	}


    public function edit_role_label()
    {
        $this->load->view('madmin/dialogs/edit_role_label');
    }

    public function edit_devicenames_label_list()
    {
        $this->load->view('madmin/dialogs/edit_devicenames_label_list');
    }
    public function edit_incidenttype_label_list()
    {
        $this->load->view('madmin/dialogs/edit_incidenttype_label_list');
    }
    public function edit_contracttype_label_list()
    {
        $this->load->view('madmin/dialogs/edit_contracttype_label_list');
    }
    public function edit_branch_label_list()
    {
        $this->load->view('madmin/dialogs/edit_branch_label_list');
    }

    public function role_labels()
    {
        $this->load->view('madmin/role_labels');
    }

    public function add_role_labels()
    {
        $this->load->view('madmin/add_role_labels');
    }

    public function vendor_label()
    {
        $this->load->view('madmin/vendor_label');
    }
   
    public function depreciation_label()
	{
		$this->load->view('madmin/depreciation_label');
	}
    
	public function status_label()
	{
		$this->load->view('madmin/status_label');
	}
	public function add_status_label()
	{
		$this->load->view('madmin/add_status_label');
	}
	public function edit_status_label_list()
	{
		$this->load->view('madmin/dialogs/edit_status_label_list');
	}
	
	public function depreciation_add_label()
	{
		$this->load->view('madmin/depreciation_add_label');
	}
	
	public function edit_depreciation_label_list()
	{
		$this->load->view('madmin/dialogs/edit_depreciation_label_list');
	}
	
    public function utilization_label()
    {
        $this->load->view('madmin/utilization_label');
    }
    public function add_utilization_label()
    {
        $this->load->view('madmin/add_utilization_label');
    }

    public function edit_vendor_label()
    {
        $this->load->view('madmin/dialogs/edit_vendor_label');
    }

    public function contracttype_labels()
    {
        $this->load->view('madmin/contracttype_labels');
    }
    public function escalation_label()
    {
        $this->load->view('madmin/escalation_labels');
    }
    public function esctype_label()
    {
        $this->load->view('madmin/esctype_labels');
    }
    public function escalationlevel_label()
    {
        $this->load->view('madmin/esclevel_labels');
    }
    public function incidenttype_labels()
   {
    $this->load->view('madmin/incidenttype_labels');
   }
    public function branch_labels()
    {
        $this->load->view('madmin/branch_labels');
    }

    public function countries_label()
    {
        $this->load->view('madmin/countries_label_list');
    }
    public function states_label()
    {
        $this->load->view('madmin/states_labels_list');
    }
    public function cities_label()
    {
        $this->load->view('madmin/cities_label_list');
    }
    public function department_label()
    {
        $this->load->view('madmin/department_labels');
    }
    public function user_label()
    {
        $this->load->view('madmin/user_labels');
    }
    public function devicenames_label()
    {
    $this->load->view('madmin/devicenames_labels');
    }

    public function edit_escalation_label_dialog()
    {
        $this->load->view('madmin/dialogs/edit_escalation_label_dialog');
    }

    public function edit_escalation_type_label()
    {
        $this->load->view('madmin/dialogs/edit_escalation_type_label');
    }

    public function edit_escalation_level_label()
    {
        $this->load->view('madmin/dialogs/edit_escalation_level_label');
    }
    public function add_vendor_label()
    {
        $this->load->view('madmin/add_vendor_label');
    }

    public function add_user_label()
    {
        $this->load->view('madmin/add_user_label');
    }
    public function add_department_label()
    {
        $this->load->view('madmin/add_department_label');
    }
    public function add_devicenames_label()
    {
        $this->load->view('madmin/add_devicenames_label');
    }
    public function add_branch_labels()
    {
        $this->load->view('madmin/add_branch_label');
    }
    public function add_contracttype_labels()
    {
        $this->load->view('madmin/add_contracttype_label');
    }
    public function add_incidenttype_labels()
    {
        $this->load->view('madmin/add_incidenttype_label');
    }

    public function add_esctype_label()
    {
        $this->load->view('madmin/add_esctype_label');
    }
    public function add_esclevel_label()
    {
        $this->load->view('madmin/add_esclevel_label');
    }
    public function add_escalation_label()
    {
        $this->load->view('madmin/add_escalation_label');
    }

    public function cps_appointment_org()
    {
        $this->load->view('madmin/cps_appointment_org');
    }
    public function appointment_organizations()
    {
        $this->load->view('madmin/appointment_organizations');
    }
    public function add_organization_appointments()
    {
        $this->load->view('madmin/add_organization_appointments');
    }
    public function edit_organization_appointments()
    {
        $this->load->view('madmin/edit_organization_appointments');
    }
	 public function view_itemmaser_dialog()
    {
        $this->load->view('dialogs/show_item_master_dialog');
    }
	
	public function edit_item_master()
	{
		$this->load->view('dialogs/edit_item_master_dialog');
	}

    public function edit_role_type_dialog()
    {
        $this->load->view('madmin/dialogs/edit_role_type_dialog');
    }
    public function equptypeslabels()
    {
        $this->load->view('madmin/equptypeslabelslist');
    }
    public function addequptypelabels()
    {
        $this->load->view('madmin/add_equp_type_label');
    }
    public function appointment_hospitals()
    {
        $this->load->view('madmin/appointment_hospitals');
    }
    public function add_appointments()
    {
        $this->load->view('madmin/add_appointments');
    }
    public function add_vendor()
    {
        $this->load->view('madmin/add_vendor');
    }

    public function add_modules()
    {
        $this->load->view('madmin/add_module');
    }
    public function vendor_list()
    {
        $this->load->view('madmin/vendor_list');
    }
    public function modules_list()
    {
        $this->load->view('madmin/modules_list');
    }

    public function viewhospitals()
    {
        $this->load->view('madmin/madmin-hospitals');
    }
    public function add_hospitals()
    {
        $this->load->view('madmin/madmin-add_hospitals');
    }
    public function add_new_org_contact_person()
    {
        $this->load->view('madmin/dialogs/add_new_org_contract_person');
    }
    public function add_apt_org_contact_person()
    {
        $this->load->view('madmin/dialogs/add_apt_org_contact_person');
    }
    public function edit_new_org_contact_person()
    {
        $this->load->view('madmin/dialogs/edit_new_org_contract_person');
    }
    public function edit_apt_org_contact_person()
    {
        $this->load->view('madmin/dialogs/edit_apt_org_contract_person');
    }
    public function edit_appointment()
    {
        $this->load->view('madmin/dialogs/edit_appointment');
    }
    public function view_appointment()
    {
        $this->load->view('madmin/dialogs/view_appointment');
    }
    public function add_asset()
    {
        $this->load->view('vendor/add-device');
    }

    public function view_device()
    {
        $this->load->view('vendor/vendor_device');
    }
    public function labelPrint()
    {

        $this->load->view('vendor/vendor_print_labels');
    }

    public function equpcondlabels()
    {
        $this->load->view('madmin/equpcondlabels');
    }
    public function role_types()
    {
        $this->load->view('madmin/role_type');
    }
    public function add_role_type()
    {
        $this->load->view('madmin/add_role_type');
    }
    public function add_equpcondlabels()
    {
        $this->load->view('madmin/add_equpcondlabels');
    }
    public function add_equptypelabels()
    {
        $this->load->view('madmin/add_equptypelabels');
    }
    public function vendor_maintain_contracts()
    {
        $this->load->view('vendor/vendor_maintain_contracts');
    }
    public function convert_appointment()
    {
        $this->load->view('madmin/dialogs/convert_appointment');
    }
    public function edit_hospital_dialog()
    {
        $this->load->view('madmin/dialogs/madmin_update_hospitals');
    }
    public function assign_org_branch()
    {
        $this->load->view('madmin/dialogs/assign_org_branch');
    }
    public function edit_org_roles()
    {
        $this->load->view('dialogs/edit_org_roles');
    }

	public function depreciation()
    {
        $this->load->view('depreciation');
    }
    public function add_depreciation()
    {
        $this->load->view('add_depreciation');
    }
    public function depreciation_details()
    {
        $this->load->view('depreciation_details');
    }
	
	public function device_label()
	{
		$this->load->view('device_label');
	}
    public function add_device_label()
	{
		$this->load->view('add_device_label');
	}
	public function add_item_master()
	{
		$this->load->view('add_item_master');
	}
	public function item_master()
	{
		$this->load->view('item_master');
	}
	public function edit_labels_dialog()
	{
		$this->load->view('dialogs/edit_labels_dialog');
	}
	
    public function edit_equp_type_lables()
    {
        $this->load->view('madmin/dialogs/edit_equp_type_labels_list');
    }

	private function _get_depreciation_devices($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $list1 = $data = $like= $where1 =$where2 = array();
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            if ($jodata->eqpid != ''){
                $where[$this->devices->E_ID] = $jodata->eqpid;
            }
            if ($jodata->equip_name != ''){
                $where1[$this->depreciation->NAME] = $jodata->equip_name;
                $like[$this->devices->E_NAME] = $jodata->equip_name;
            }
            $where[$this->devices->ORG_ID] = $org_id;
            if ($jodata->dept_id != ALL && $jodata->dept_id != '')
                $where2[$this->devices->DEPT_ID] = $jodata->dept_id;
            $select = array($this->devices->ID,$this->devices->E_ID,$this->devices->E_NAME,$this->devices->E_COST,$this->devices->DATEOF_INSTALL);
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;

               if($jodata->eqpid != '' || $jodata->equip_name != '' || $jodata->dept_id != ''){
                   if($jodata->dept_id == ALL)
                       $where2 = '';
                   $list = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->devices->tbl_name, $where,$where2, $like, $select, $this->devices->ID, 'asc','10',$limit_val*10);

                   foreach($list as $mainlist){
                       $depreciation_percentage = $this->basemodel->get_single_column_value($this->depreciation->tbl_name,$this->depreciation->PERCENTAGE,
                           array($this->depreciation->NAME => $mainlist['E_NAME']));
                       $first_year = $mainlist['E_COST'];
                       $second_year = round($mainlist['E_COST'] - ($mainlist['E_COST']*$depreciation_percentage/100),2);
                       $third_year = round($second_year - ($second_year*$depreciation_percentage/100),2);
                       $fourth_year = round($third_year - ($third_year*$depreciation_percentage/100),2);
                       $fifth_year = round($fourth_year - ($fourth_year*$depreciation_percentage/100),2);
                       $sixth_year = round($fifth_year - ($fifth_year*$depreciation_percentage/100),2);
                       $seventh_year = round($sixth_year - ($sixth_year*$depreciation_percentage/100),2);
                       $eigth_year = round($seventh_year - ($seventh_year*$depreciation_percentage/100),2);
                       $ninth_year = round($eigth_year - ($eigth_year*$depreciation_percentage/100),2);
                       $tenth_year = round($ninth_year - ($ninth_year*$depreciation_percentage/100),2);
                       $year11 = round($tenth_year - ($tenth_year*$depreciation_percentage/100),2);
                       $year12 = round($year11 - ($year11*$depreciation_percentage/100),2);
                       $year13 = round($year12 - ($year12*$depreciation_percentage/100),2);
                       $year14 = round($year13 - ($year13*$depreciation_percentage/100),2);
                       $year15 = round($year14 - ($year14*$depreciation_percentage/100),2);
                       $year16 = round($year15 - ($year15*$depreciation_percentage/100),2);
                       $year17 = round($year16 - ($year16*$depreciation_percentage/100),2);
                       $year18 = round($year17 - ($year17*$depreciation_percentage/100),2);
                       $year19 = round($year18 - ($year18*$depreciation_percentage/100),2);
                       $year20 = round($year19 - ($year19*$depreciation_percentage/100),2);
                       $year21 = round($year20 - ($year20*$depreciation_percentage/100),2);
                       $year22 = round($year21 - ($year21*$depreciation_percentage/100),2);
                       $year23 = round($year22 - ($year22*$depreciation_percentage/100),2);
                       $year24 = round($year23 - ($year23*$depreciation_percentage/100),2);
                       $year25 = round($year24 - ($year24*$depreciation_percentage/100),2);
                       $f_year1 = substr($mainlist['DATEOF_INSTALL'],0,4);
                       array_push($list1,array(
                           "E_ID" => $mainlist['E_ID'],
                           "E_NAME" => $mainlist['E_NAME'],
                           "DATEOF_INSTALL" => $mainlist['DATEOF_INSTALL'],
                           "first_year" => $mainlist['E_COST'],
                           "second_year" => $second_year,
                           "third_year" => $third_year,
                           "fourth_year" => $fourth_year,
                           "fifth_year" => $fifth_year,
                           "sixth_year" => $sixth_year,
                           "seventh_year" => $seventh_year,
                           "eigth_year" => $eigth_year,
                           "ninth_year" => $ninth_year,
                           "tenth_year" => $tenth_year,
                           "year11" => $year11,
                           "year12" => $year12,
                           "year13" => $year13,
                           "year14" => $year14,
                           "year15" => $year15,
                           "year16" => $year16,
                           "year17" => $year17,
                           "year18" => $year18,
                           "year19" => $year19,
                           "year20" => $year20,
                           "year21" => $year21,
                           "year22" => $year22,
                           "year23" => $year23,
                           "year24" => $year24,
                           "year25" => $year25,
                            "f_year1" => $f_year1,
                            "depreciation_percentage" => $depreciation_percentage
                           )

                       );
                   }
               }
                $cnt = $this->basemodel->fetch_records_from_multi_where_like($this->devices->tbl_name, $where,$where2, $like, 'count('.$this->devices->ID.') AS CNT');

               // return $list1;
                if(!empty($cnt))
                {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT']/10);
                }
                else
                {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }

            }

        }
        if(!empty($list)){
            $data['response'] = SUCCESSDATA;
            $data['list'] = $list1;

        }else{
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

	private function _get_existing_list($jodata=array()){
        $data=array();
        $sub_data=array();
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $list = $this->basemodel->fetch_records_from($this->features->tbl_name,array($this->features->STATUS=>ACTIVESTS),
            array($this->features->MMENU_ID,$this->features->MMENU_TITLE,$this->features->MMENU_PATH,$this->features->APP,$this->features->MMENU_ICON,$this->features->ICON,$this->features->STATUS));
        if(!empty($list)) {
            for ($j = 0; $j < count($list); $j++) {
                $list[$j]['selected'] = "false";
                $fw[$this->subfeatures->MMENU_ID] = $list[$j]['MMENU_ID'];
                $fw[$this->subfeatures->STATUS] = ACTIVESTS;
                $sub_data[$j] = $this->basemodel->fetch_records_from($this->subfeatures->tbl_name, $fw,
                    array($this->subfeatures->SMENU_AID, $this->subfeatures->SMENU_TITLE, $this->subfeatures->SMENU_PATH, $this->subfeatures->APP,$this->subfeatures->ICON,
                        $this->subfeatures->MENU_PROP, $this->subfeatures->ACTIVITY, $this->subfeatures->STATUS));
                for ($k = 0; $k < count($sub_data[$j]); $k++) {
                    $subsub_data = array();
                    $subdata_array = explode(',', $sub_data[$j][$k]['MENU_PROP']);
                    for ($m = 0; $m < count($subdata_array); $m++) {
                        $fetch_single = $this->basemodel->fetch_single_row($this->ssubfeatures->tbl_name, array($this->ssubfeatures->SSMENU_AID => $subdata_array[$m]));
                        if ($fetch_single) {
                            $subsub_data[$m]['name'] = $fetch_single['SSMENU_TITLE'];
                            $subsub_data[$m]['SSMENU_AID'] = $fetch_single['SSMENU_AID'];
                            $subsub_data[$m]['selected'] = "false";
                        } else {
                            $subsub_data = "";
                        }
                    }
                    $sub_data[$j][$k]['subsubfeatures'] = $subsub_data;
                    $sub_data[$j][$k]['selected'] = "false";
                }
                $list[$j]['subfeatures'] = $sub_data[$j];
            }
            $data['response'] = SUCCESSDATA;
            $data['list'] = $list;
        }else{
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

	private  function _get_org_features_list($jodata){
        $data = array();
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        //$role_id = $jodata->role_id;
        $fetch_features = $this->basemodel->fetch_single_row($this->organizations->tbl_name,array($this->organizations->ORG_ID => $org_id),array($this->organizations->FEATURES));
        $features = json_decode($fetch_features['FEATURES']);
        $total_menu=array();
        foreach($features->menu as $ft){
            if($ft->selected == "true") {
                $sub_menu = array();
                //if(!empty($ft->subfeatures)){
                    foreach ($ft->subfeatures as $sf) {
                        if ($sf->selected == "true") {
                            $sub_sub_menu = array();
                            //if(!empty($sf->subsubfeatures)) {
                                foreach ($sf->subsubfeatures as $ssf) {
                                    if ($ssf->selected == "true") {
                                        array_push($sub_sub_menu,array('ssmenu_id'=>$ssf->ssmenu_id,'name'=>$ssf->name,"selected" => "false"));
                                    }
                                }
                                array_push($sub_menu,array('smenu_id'=>$sf->smenu_id,'name'=>$sf->name,"state"=>$sf->state,'activity'=>$sf->activity,'icon'=>$sf->icon,"selected" => "false","subsubfeatures" =>$sub_sub_menu));
                           // }
                        }
                    }
                    array_push($total_menu,array('menu_id'=>$ft->menu_id,'name'=>$ft->name,'state'=>$ft->state,'icon'=>$ft->icon,"selected" => "false",'subfeatures'=>$sub_menu));
               // }
            }
        }


        if(!empty($features)){
            $data['response'] = SUCCESSDATA;
            $data['list'] = $total_menu;

        }else{
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

	private  function _get_existing_org_features_list($jodata){
        $data = array();
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $fetch_features = $this->basemodel->fetch_single_row($this->organizations->tbl_name,array($this->organizations->ORG_ID => $org_id),array($this->organizations->FEATURES));
        $features = json_decode($fetch_features['FEATURES']);
        $total_menu=array();
        foreach($features->menu as $ft) {
            if($ft->selected == "true") {
                $sub_menu = array();
                foreach ($ft->subfeatures as $sf) {
                    if($sf->selected == "true") {
                        $sub_sub_menu = array();
                        foreach ($sf->subsubfeatures as $ssf) {
                            if($ssf->selected == "true") {
                                array_push($sub_sub_menu, array('ssmenu_id' => $ssf->ssmenu_id, 'name' => $ssf->name, "selected" => "false"));
                            }
                        }
                        array_push($sub_menu, array('smenu_id' => $sf->smenu_id, 'name' => $sf->name, "state" => $sf->state, 'activity' => $sf->activity, 'icon' => $sf->icon, "selected" => "false", "subsubfeatures" => $sub_sub_menu));
                    }
                }
                array_push($total_menu, array('menu_id' => $ft->menu_id, 'name' => $ft->name, 'state' => $ft->state, 'icon' => $ft->icon, "selected" => "false", 'subfeatures' => $sub_menu));
            }
        }


        if(!empty($features)){
            $data['response'] = SUCCESSDATA;
            $data['list'] = $total_menu;

        }else{
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

    private function _get_edit_org_roles($jodata=array())
    {
        $data=array();
        if(!empty($jodata)){
            $features_list = $jodata->features;
            if(isset($jodata->features))
            {
                $total_menu=array();
                foreach($features_list as $ft){
                    $sub_menu = array();
                    foreach ($ft->subfeatures as $sf) {
                       $sub_sub_menu = array();
                           foreach ($sf->subsubfeatures as $ssf) {
                               array_push($sub_sub_menu,array('ssmenu_id'=>$ssf->ssmenu_id,'name'=>$ssf->name,'selected'=>$ssf->selected));
                           }
                           array_push($sub_menu,array('smenu_id'=>$sf->smenu_id,'name'=>$sf->name,"state"=>$sf->state,'activity'=>$sf->activity,'APP'=>$sf->APP,'icon'=>$sf->icon,'selected'=>$sf->selected,"subsubfeatures" =>$sub_sub_menu));
                    }
                    array_push($total_menu,array('menu_id'=>$ft->menu_id,'name'=>$ft->name,'state'=>$ft->state,'APP'=>$ft->APP,'icon'=>$ft->icon,'ICON'=>$ft->ICON_PATH.ICON,'selected'=>$ft->selected,'subfeatures'=>$sub_menu));
                }
            }
        }
        $flist = json_encode(array('menu' => $total_menu));
        $today = date('Y-m-d H:i:s');
        $where[$this->orgroles->ROLE_AID]=$jodata->ROLE_AID;
        $indata[$this->orgroles->ORG_ID]=$this->session->org_id;
        $indata[$this->orgroles->ROLE_CODE]=$jodata->role_code;
        $indata[$this->orgroles->EROLE_CODE]=$jodata->erole_code;
        $indata[$this->orgroles->ROLE_NAME]=$jodata->role_name;
        $indata[$this->orgroles->ESCALATION]=$jodata->role_code==HBBME ? "L1":"L2";
        $indata[$this->orgroles->ACTUAL_FEARTURES_LIST] = json_encode($features_list);
        $indata[$this->orgroles->ROLE_PATH]="home.".strtolower($indata[$this->orgroles->ROLE_CODE])."_today_calls";
        $indata[$this->orgroles->ROLE_FEATURES]=$flist;

        if($this->basemodel->update_operation($indata,$this->orgroles->tbl_name,$where))
        {
            $data['response']=SUCCESSDATA;
            $data['call_back']="Org Roles are Updated Successfully";

        }
        else
        {
            $data['response']=EMPTYDATA;
            $data['call_back']="Unable to Process Your Request";
        }
        return $data;
    }


private function _get_hospitals($jodata = array())
{
    $data = array();
    //log_message('error',print_r($jodata,true));
    if(!empty($jodata))
    {

		if(isset($jodata->limit_val))
        {
            if($jodata->limit_val!='')
                $limit_val = $jodata->limit_val;
            else
                $limit_val = 0;
            $cnt = $this->basemodel->fetch_records_from($this->organizations->tbl_name,'','count('.$this->organizations->ORG_ID.') AS CNT');

            if(!empty($cnt))
            {
                $data['no_of_recs'] = $cnt[0]['CNT'];
                $data['rcnt'] = ceil($cnt[0]['CNT']/10);
            }
            else
            {
                $data['no_of_recs'] = 0;
                $data['rcnt'] = 0;
            }
            //return $data;
            $resp_data = $this->basemodel->fetch_records_from_pagination($this->organizations->tbl_name,array(),'*',$this->organizations->ORG_NAME,'asc','10',$limit_val*10);

        }

        else
        {
            $resp_data = $this->basemodel->fetch_records_from($this->organizations->tbl_name,'','*',$this->organizations->ORG_NAME);
        }



       // $where = $data = array();
        //$where[$this->organizations->ORG_TYPE] = HOSPITAL;
       // $resp_data = $this->basemodel->fetch_records_from($this->organizations->tbl_name);
        if(!empty($resp_data))
        {
            $data['response'] = SUCCESSDATA;
            for($i=0;$i<count($resp_data);$i++)
            {
                $resp_data[$i]['no_of_branches']=$this->basemodel->num_of_res($this->branches->tbl_name,array($this->branches->ORG_ID=>$resp_data[$i][$this->organizations->ORG_ID]));
                $resp_data[$i]['no_of_users']=$this->basemodel->num_of_res($this->users->tbl_name,array($this->users->ORG_ID=>$resp_data[$i][$this->organizations->ORG_ID]));
                $resp_data[$i]['appurl'] = $this->basemodel->fetch_single_row($this->hospitals->tbl_name,array($this->hospitals->ORG_ID=>$resp_data[$i][$this->organizations->ORG_ID]),$this->hospitals->ORGURL);
            }
            $data['list'] = $resp_data;

        }
        else
        {
            $data['response'] = EMPTYDATA;
        }
    }
    return $data;
}

private function _get_hospitals_vendor($jodata = array())
{

    $data = array();
    $where = array();
    //  $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
    $user_id = isset($jodata->user_id) ? $jodata->user_id :$this->session->user_id;

    $where[$this->users->USER_ID]= $user_id;
    $select = array($this->users->ORG_ID);
    $hospitals = $this->basemodel->fetch_records_from($this->users->tbl_name,$where,array($this->users->ORG_ID));
    foreach ($hospitals as $hospital)
        $resp_data = $hospital[$this->users->ORG_ID];
    $hospitals = explode(",", $resp_data);
    $hospital = array();
    foreach ($hospitals as $x)
        array_push($hospital, "'" . $x . "'");
    $hospital = '(' . implode($hospital, ',') . ')';
    $or_where = $this->organizations->ORG_ID . " IN " . $hospital;
    //return $or_where;
    $select = array($this->organizations->ORG_ID,$this->organizations->ORG_NAME);
    $organisations = $this->basemodel->fetch_records_from_multi_where($this->organizations->tbl_name,'',$or_where,$select);
    //  return $this->db->last_query();
    $data['list'] = $organisations;

    if (!empty($data['list']))
    {
        if(count($data['list']) > 1 )
        {
            array_unshift ($data['list'],array("ORG_ID"=>"All","ORG_NAME"=>"All"));
        }
        $data['response'] = SUCCESSDATA;
    }
    else
    {
        $data['response'] = EMPTYDATA;
    }

    return $data;
}
private function _get_apt_organizations($jodata = array())
{
    $data = array();
    if(!empty($jodata))
    {
        if(isset($jodata->limit_val))
        {
            if($jodata->limit_val!='')
                $limit_val = $jodata->limit_val;
            else
                $limit_val = 0;
            $cnt = $this->basemodel->fetch_records_from_multi_where($this->aptorganizations->tbl_name,'','','count('.$this->aptorganizations->ID.') AS CNT');
            if(!empty($cnt))
            {
                $data['no_of_recs'] = $cnt[0]['CNT'];
                $data['rcnt'] = ceil($cnt[0]['CNT']/10);
            }
            else
            {
                $data['no_of_recs'] = 0;
                $data['rcnt'] = 0;
            }
            //print_r($data);
            $resp_data = $this->basemodel->fetch_records_from_pagination($this->aptorganizations->tbl_name,'','*',$this->aptorganizations->ADDED_ON,'DESC','10',$limit_val*10);
        }
        else
        {
            $resp_data = $resp_data = $this->basemodel->fetch_records_from($this->aptorganizations->tbl_name);
        }
        if(!empty($resp_data))
        {
            $data['response'] = SUCCESSDATA;
            for($i=0;$i<count($resp_data);$i++)
            {
                $resp_data[$i]['no_of_branches']=$this->basemodel->num_of_res($this->branches->tbl_name,array($this->branches->ORG_ID=>$resp_data[$i][$this->aptorganizations->ORG_ID]));
                $resp_data[$i]['no_of_users']=$this->basemodel->num_of_res($this->users->tbl_name,array($this->users->ORG_ID=>$resp_data[$i][$this->aptorganizations->ORG_ID]));
                $resp_data[$i]['CONTACT_PERSONS'] = json_decode($resp_data[$i]['CONTACT_PERSONS']);
            }
            $data['list'] = $resp_data;
        }
        else
        {
            $data['response'] = EMPTYDATA;
        }
    }
    return $data;
}

 private function _add_scheduled_call($jodata = array())
    {
       //return "fh";

        $data = array();
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $idata[$this->scheduledcalls->SCHEDULE_TYPE] = $jodata->name;
        $idata[$this->scheduledcalls->USERNAME] = $user_id;
        $idata[$this->scheduledcalls->ORG_ID] = $org_id;
        $idata[$this->scheduledcalls->YEAR] = $jodata->years;
        $idata[$this->scheduledcalls->MONTH] = $jodata->months;
        $idata[$this->scheduledcalls->DAY] = $jodata->days;
        $idata[$this->scheduledcalls->ADDED_ON] = date("Y-m-d H:i:s");
        $idata[$this->scheduledcalls->ADDED_BY] = $user_id;
        if ($this->basemodel->insert_into_table($this->scheduledcalls->tbl_name, $idata)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Schedule Call Type Inserted Successfully';
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = 'Unable to Process Your Request Try Again...!';
        }
        return $data;
    }

private function _get_scheduled_call_type($jodata=array())
    {

        $data=array();
        if(!empty($jodata) && $this->ha_content_type==$this->baseauth->appjson)
        {
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->scheduledcalls->tbl_name,array(),'','count('.$this->scheduledcalls->ID.') AS CNT');
                if(!empty($cnt))
                {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT']/10);
                }
                else
                {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $scheduled_types = $this->basemodel->fetch_records_from_pagination($this->scheduledcalls->tbl_name,'','*',$this->scheduledcalls->SCHEDULE_TYPE,'ASC','10',$limit_val*10);

            }
            else
            {
                $scheduled_types = $this->basemodel->fetch_records_from($this->scheduledcalls->tbl_name,'','*',$this->scheduledcalls->SCHEDULE_TYPE);

            }

            if(!empty($scheduled_types))
            {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $scheduled_types;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = array();
            }
        }
        return $data;
    }

private function _check_scheduled_call($jodata=array())
{

    $where = array();
    $data = array();
    $where[$this->scheduledcalls->SCHEDULE_TYPE] = $jodata->caller_name;
    $result = $this->basemodel->fetch_records_from($this->scheduledcalls->tbl_name,$where);
    //  return $this->db->last_query();
    if(!empty($result))
    {
        $data['response'] = SUCCESSDATA;
    }
    else{
        $data['response'] = FAILEDATA;
    }
    return $data;
}

private function _add_hospital($jodata=array())
{
    $data = array();
    if(!empty($jodata))
    {

        $today = date("Y-m-d H:i:s");
        //$org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $max_val = (int)$this->basemodel->select_max_val($this->organizations->tbl_name, $this->organizations->ORG_AID);
        if ($max_val == "")
        {
            $max_val = 0;
        }
        $org_id = $this->baselibrary->org_id_creation($max_val);

        $features_list = $jodata->featuers;
        $total_menu=array();
        foreach($features_list as $ft){
            if($ft->selected == "true") {
                $sub_menu = array();
                    foreach ($ft->subfeatures as $sf) {
                            $sub_sub_menu = array();
							foreach ($sf->subsubfeatures as $ssf) {
									array_push($sub_sub_menu,array('name'=>$ssf->name,"selected" =>$ssf->selected));
							}
							array_push($sub_menu,array('name'=>$sf->SMENU_TITLE,"state"=>$sf->SMENU_PATH,'activity'=>$sf->ACTIVITY,'APP'=>$sf->APP,'icon'=>ICON_PATH.$sf->ICON,"selected" =>$sf->selected,"subsubfeatures" =>$sub_sub_menu));

                    }
                    array_push($total_menu,array('name'=>$ft->MMENU_TITLE,'state'=>$ft->MMENU_PATH,'APP'=>$ft->APP,'icon'=>$ft->MMENU_ICON,'ICON'=>ICON_PATH.$ft->ICON,"selected" =>$ft->selected,'subfeatures'=>$sub_menu));

            }
        }
        $flist = json_encode(array('menu' => $total_menu));
		//return $flist;
        $today = date('Y-m-d H:i:s');
        $isdata[$this->organizations->ORG_ID] = ORG . $org_id;
        $isdata[$this->organizations->ORG_NAME] = $jodata->org_name;
        $isdata[$this->organizations->ORG_TYPE] = implode(",",$jodata->org_type);
        //$isdata[$this->organizations->ROLE_PATH] = $this->basemodel->get_single_column_value($this->roles->tbl_name,$this->roles->ROLE_PATH,array($this->roles->ROLE_CODE => HMADMIN));
        $isdata[$this->organizations->ROLE_PATH] = "home.hmadmin_today_calls";
        $isdata[$this->organizations->ORG_MODULE] = $jodata->org_module; //implode(",",$jodata->org_module);
        $isdata[$this->organizations->ORG_ADDRESS] = $jodata->org_address;
         $isdata[$this->organizations->ROLE_CODE] =  HMADMIN; //$jodata->role_type; 
		//$isdata[$this->organizations->ROLE_CODE] = $jodata->role_type;
        $isdata[$this->organizations->EROLE_CODE] = ADMIN;
        $isdata[$this->organizations->ORG_CODE] = $jodata->org_code;
        $isdata[$this->organizations->NO_OF_BRANCHES] = $jodata->no_of_branches;
        $isdata[$this->organizations->NO_OF_USERS] = $jodata->no_of_users;
        $isdata[$this->organizations->NO_OF_EQUPIMENTS] = $jodata->no_of_equipments;
        $isdata[$this->organizations->CP_NAME] = $jodata->contact_person;
        $isdata[$this->organizations->CP_EMAIL] = $jodata->email_id;
        $isdata[$this->organizations->CP_NUMBER] = $jodata->contact_no;
        $isdata[$this->organizations->COUNTRY] = $jodata->country;
        $isdata[$this->organizations->STATE] = $jodata->states;
        $isdata[$this->organizations->CITY] = $jodata->cities;
        $isdata[$this->organizations->FEATURES] = $flist;
        $isdata[$this->organizations->ACTUAL_FEARTURES_LIST] = json_encode($features_list);
        $isdata[$this->organizations->EX_DATE] = date("Y-m-d",strtotime($jodata->expire));
        $isdata[$this->organizations->ADDED_ON] = $today;
        $isdata[$this->organizations->ADDED_BY] = $user_id;
        //$isdata[$this->organizations->LOGO] = $jodata->org_logo;
        //return $isdata;
        //$isdata[$this->organizations->LOGO] = $this->save_base64_image($isdata[$this->organizations->LOGO],$isdata[$this->organizations->ORG_ID],"assets/org_logos/");
        if(!empty($jodata->cp_details))
        {
            $cp_dtls['contact_persons'] = $jodata->cp_details;
            $isdata[$this->organizations->CP_DETAILS] = json_encode($cp_dtls);
        }
        else
        {
            $isdata[$this->organizations->CP_DETAILS] = NULL;
        }

        
   
        if($this->basemodel->insert_into_table($this->organizations->tbl_name,$isdata))
        {


        /*   if (count($_FILES) > 0) {
                    $uploaded = $not_uploaded = 0;
                    $uploaded_round_floder = $isdata[$this->organizations->ORG_ID];

                  //  for ($f = 0; $f < count($_FILES); $f++) {
                       // $f_type = explode('.', $_FILES[$f]['name']);
                    $f_type = $_FILES['name']['name'];
                   // echo $f_type;

                       // $last_in = end($f_type);
                        $config['upload_path'] = ROUNDS_UPLOAD_PATH.$uploaded_round_floder;
                        $config['allowed_types'] = '*';
                      //  $time = time();
                       // $config['file_name'] = $f_type;
                       // echo $config['file_name'];
                       // die();
                        if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('userfile')) {
                            $uploaded++;
                        } else {
                            $not_uploaded++;
                            $data['uploaded_files_errors'] = $this->upload->display_errors();

                        }
                                       //   }
                    $data['uploaded_files'] = $uploaded;
                    $data['not_uploaded_files'] = $not_uploaded;
                    $this->basemodel->update_operation(array($this->organizations->LOGO => $uploaded_round_floder), $this->organizations->tbl_name, array($this->organizations->ORG_ID => $where_assigned_round[$this->organizations->ORG_ID]));

              // return $this->db->last_query();
           }    */

            
            // return $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $max_val = (int)$this->basemodel->select_max_val($this->users->tbl_name, $this->users->UID);
            $user_id = $this->baselibrary->user_id_creation($max_val);
            $today = date('Y-m-d H:i:s');
            $iudata[$this->users->USER_ID] = HA . $user_id;
            $iudata[$this->users->USER_NAME] = $jodata->contact_person;
            $iudata[$this->users->EMAIL_ID] = $jodata->email_id;
            $iudata[$this->users->MOBILE_NO] = $jodata->contact_no;
            $iudata[$this->users->EMP_NO] = $jodata->contact_no;   
            $iudata[$this->users->ROLE_CODE] = HMADMIN; 
            $iudata[$this->users->ORG_ID] = ORG . $org_id;
            $iudata[$this->users->PSWRD] = $this->bcrypt->hash_password(DFFPASS);
            $iudata[$this->users->STATUS] = ACTIVESTS;
            $iudata[$this->users->LEVEL] = "L1";
			$iudata[$this->users->ORG_MODULE] = $jodata->org_module;
            $iudata[$this->users->START_DATE] = $today;
            $iudata[$this->users->ADDED_ON] = $today;
            $iudata[$this->users->END_DATE] = $enddate = date('9999-m-d H:i:s');
            $iudata[$this->users->ADDED_BY] = $this->session->user_id;
         if ($this->basemodel->insert_into_table($this->users->tbl_name, $iudata))
         {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = $jodata->org_name." Successfully Registered with HospiAsset";
         }
	}    
        else
        {
            $data['response'] = FAILEDATA;
            $data['qry'] = $this->db->last_query();
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }
    }

    return $data;

}


 private function _check_hospital_email($jodata)
    {
        $where = array();
        $data = array();
        $where[$this->users->EMAIL_ID] = $jodata->email_id;
        $wwhere[$this->organizations->CP_EMAIL] = $jodata->email_id;
        $result = $this->basemodel->fetch_records_from($this->users->tbl_name, $where);
        $result1 = $this->basemodel->fetch_records_from($this->organizations->tbl_name, $wwhere);
		//return $this->db->last_query();
        if($result || $result1) {
            $data['response'] = SUCCESSDATA;
        } else {
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

private function _add_apt_hospital($jodata=array())
{
    $data = array();
    if(!empty($jodata))
    {
        $today = date("Y-m-d H:i:s");
        //$org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $max_val = (int)$this->basemodel->select_max_val($this->aptorganizations->tbl_name, $this->aptorganizations->ID);
        if ($max_val == "")
        {
            $max_val = 0;
        }
        $org_id = $this->baselibrary->org_id_creation($max_val);
        $today = date('Y-m-d H:i:s');
        $isdata[$this->aptorganizations->ORG_ID] = ORG . $org_id;
        $isdata[$this->aptorganizations->ORG_NAME] = $jodata->org_name;
        if(is_array($jodata->org_type))
            $isdata[$this->aptorganizations->ORG_TYPE] = implode(",",$jodata->org_type);
        else
            $isdata[$this->aptorganizations->ORG_TYPE] = $jodata->org_type;
        $isdata[$this->aptorganizations->ORG_ADDRESS] = $jodata->org_address;
        $isdata[$this->aptorganizations->ORG_CONTACTNO] = $jodata->org_contact_no;
        $isdata[$this->aptorganizations->ORG_EMAIL] = $jodata->org_email_id;
        $isdata[$this->aptorganizations->ORG_COUNTRY] = $jodata->country;
        $isdata[$this->aptorganizations->ORG_STATE] = $jodata->states;
        $isdata[$this->aptorganizations->ORG_CITY] = $jodata->cities;
        $isdata[$this->aptorganizations->ADDED_ON] = $today;
        $isdata[$this->aptorganizations->ADDED_BY] = $user_id;
        if(!empty($jodata->cp_details))
        {
            $cp_dtls['contact_persons'] = $jodata->cp_details;
            $isdata[$this->aptorganizations->CONTACT_PERSONS] = json_encode($cp_dtls);
        }
        else
        {
            $isdata[$this->aptorganizations->CONTACT_PERSONS] = NULL;
        }

        if($this->basemodel->insert_into_table($this->aptorganizations->tbl_name,$isdata))
        {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = $jodata->org_name . "Appointment Orgnizations List Added Suucessfully";
        }
        else
        {
            $data['response'] = FAILEDATA;
            $data['call_back'] =  $jodata->org_name." Not Added with HospiAsset...!";
        }
    }
    return $data;
}
private function _update_apt_hospitals($jodata=array())
{
    $data = array();
    if(!empty($jodata))
    {
        $where[$this->aptorganizations->ID]=$jodata->ID;
        $today = date("Y-m-d H:i:s");
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $isdata[$this->aptorganizations->ORG_ID] = $jodata->ORG_ID;
        $isdata[$this->aptorganizations->ORG_NAME] = $jodata->org_name;
        if(is_array($jodata->org_type))
            $isdata[$this->aptorganizations->ORG_TYPE] = implode(",",$jodata->org_type);
        else
            $isdata[$this->aptorganizations->ORG_TYPE] = $jodata->org_type;
        $isdata[$this->aptorganizations->ORG_ADDRESS] = $jodata->org_address;
        $isdata[$this->aptorganizations->ORG_CONTACTNO] = $jodata->org_contact_no;
        $isdata[$this->aptorganizations->ORG_EMAIL] = $jodata->org_email_id;
        $isdata[$this->aptorganizations->ORG_COUNTRY] = $jodata->country;
        $isdata[$this->aptorganizations->ORG_STATE] = $jodata->states;
        $isdata[$this->aptorganizations->ORG_CITY] = $jodata->cities;
        $isdata[$this->aptorganizations->STATUS] = $jodata->status;
        $isdata[$this->aptorganizations->UPDATED_ON] = $today;
        $isdata[$this->aptorganizations->UPDATED_BY] = $user_id;
        if(!empty($jodata->cp_details))
        {
            $cp_dtls['contact_persons'] = $jodata->cp_details;
            $isdata[$this->aptorganizations->CONTACT_PERSONS] = json_encode($cp_dtls);
        }
        else
        {
            $isdata[$this->aptorganizations->CONTACT_PERSONS] = NULL;
        }
        if($this->basemodel->update_operation($isdata, $this->aptorganizations->tbl_name,$where))
        {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] ="Orgnization Appointments Updated Successfully";
        }
        else
        {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }
    }
    return $data;
}


    private function _equp_cond_labels_list($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
            $where[$this->equpcondlabels->ORG_MODULE] = $org_type;
            //  return $where;
			if($role_code!=HA_ADMIN){
				$where[$this->equpcondlabels->ORG_MODULE] = $org_type;
              $halabelslist = $this->basemodel->fetch_records_from($this->equpcondlabels->tbl_name,$where);
			}else{
				$halabelslist = $this->basemodel->fetch_records_from($this->equpcondlabels->tbl_name);
			}
           
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for($i=0;$i<(count($halabelslist)); $i++)
                {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name,$this->modules->MODULE_NAME,array($this->modules->MODULE_ID=>$halabelslist[$i]['ORG_MODULE']));
                    $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $halabelslist[$i]['ORG_ID']));
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _get_equp_type_labels_list($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			if($role_code!=HA_ADMIN){
				$where[$this->equptypelabels->ORG_MODULE] = $org_type;
            $halabelslist = $this->basemodel->fetch_records_from($this->equptypelabels->tbl_name,$where);
            }else{
				 $halabelslist = $this->basemodel->fetch_records_from($this->equptypelabels->tbl_name);
			}//  return $this->db->last_query();
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                    $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID =>$halabelslist[$i]['ORG_ID']));
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }

    private function _get_cities_labels_list($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
			  $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            // return $this->db->last_query();
			if($role_code!=HA_ADMIN) {

                $where[$this->citieslabels->MODULE_ID] = $org_type;
                $halabelslist = $this->basemodel->fetch_records_from($this->citieslabels->tbl_name, $where);
            }else
                {
                    $halabelslist = $this->basemodel->fetch_records_from($this->citieslabels->tbl_name);
                }
             
            //  return $this->db->last_query();
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['MODULE_ID']));
                    // return $this->db->last_query();
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }
           
		   
		   private function _get_datatypes($jodata = array())
		   {
			   $data = array();
				   $res = "SELECT * FROM `hsp_tbl_datatypes`";
				   $result_qry = $this->basemodel->execute_qry($res);
				   if(!empty($result_qry))
				   {
					   $data['response'] = SUCCESSDATA;
					   $data['list'] = $result_qry;
				   }
                   else
				   {
					   $data['response'] = EMPTYDATA;
				   }	
              return $data;				   
			   
		   }
		   
    private function _get_user_labels($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
			  $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            // return $this->db->last_query();
			if($role_code!=HA_ADMIN){
              $where[$this->userlabels->ORG_MODULE] = $org_type;
            //  return $where;
            $halabelslist = $this->basemodel->fetch_records_from($this->userlabels->tbl_name,$where);
			}else{
				$halabelslist = $this->basemodel->fetch_records_from($this->userlabels->tbl_name);
			}
            //  return $this->db->last_query();
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                    $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID => $halabelslist[$i]['ORG_ID']));
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }

    private function _get_branch_labels($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			if($role_code!=HA_ADMIN){
			
              $where[$this->branchlabels->ORG_MODULE] = $org_type;
            //  return $where;
            $halabelslist = $this->basemodel->fetch_records_from($this->branchlabels->tbl_name,$where);
			}else
			{
				$halabelslist = $this->basemodel->fetch_records_from($this->branchlabels->tbl_name);
			}
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                    $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID=>$halabelslist[$i]['ORG_ID']));
                }
                
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }
     
	 
	 
	 private function _get_label_list($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			if($role_code!=HA_ADMIN){
			
              $where[$this->branchlabels->ORG_MODULE] = $org_type;
            //  return $where;
            $halabelslist = $this->basemodel->fetch_records_from($this->devicelabels->tbl_name,$where);
			}else
			{
				$halabelslist = $this->basemodel->fetch_records_from($this->devicelabels->tbl_name);
			}
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                    $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID=>$halabelslist[$i]['ORG_ID']));
                    //$halabelslist[$i]['TABLE'] = $this->basemodel->get_single_column_value($this->table_names->tbl_name,$this->table_names->TABLE_NAME,array($this->table_names->TBL_ID=>$halabelslist[$i]['TABLE_NAME']));              
 				}
                
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }
	 
	 private function _get_item_masters($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
            
			
            $halabelslist = $this->basemodel->fetch_records_from($this->item_master->tbl_name);
			
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                    //$halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID=>$halabelslist[$i]['ORG_ID']));
                    //$halabelslist[$i]['TABLE'] = $this->basemodel->get_single_column_value($this->table_names->tbl_name,$this->table_names->TABLE_NAME,array($this->table_names->TBL_ID=>$halabelslist[$i]['TABLE_NAME']));              
 				}
                
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }
	 
	 
	/* private function _get_table_name($jodata = array())
    {
          
        $data = array();
        if (!empty($jodata)) {
			
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from($this->table_names->tbl_name,'','count('.$this->table_names->TBL_ID.') AS CNT');
                if(!empty($cnt))
                {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT']/10);
                }
                else
                {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
			        
             $table_names = $this->basemodel->fetch_records_from_pagination($this->table_names->tbl_name,array(),'*',$this->table_names->TABLE_NAME,'asc','10',$limit_val*10);
			      
		    }      
			else{
				$table_names = $this->basemodel->fetch_records_from($this->table_names->tbl_name);
			}
           if (!empty($table_names)) {
				
				for($i=0;$i<count($table_names);$i++)
				{
					 $table_names[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $table_names[$i]['ORG_MODULE']));
				}

                $data['response'] = SUCCESSDATA;

                $data['list'] = $table_names;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
       
	   return $data;

    }*/
	
	private function _get_master_table($jodata = array())
    {
          
        $data = array();
        if (!empty($jodata)) {
			
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from($this->master_table->tbl_name,'','count('.$this->master_table->MASTER_ID.') AS CNT');
                if(!empty($cnt))
                {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT']/10);
                }
                else
                {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
			        
             $master_table_names = $this->basemodel->fetch_records_from_pagination($this->master_table->tbl_name,array(),'*',$this->master_table->MASTER_TABLE_NAME,'asc','10',$limit_val*10);
			      
		    }      
			else{
				$master_table_names = $this->basemodel->fetch_records_from($this->master_table->tbl_name);
			}
           if (!empty($master_table_names)) {
				
				/*for($i=0;$i<count($table_names);$i++)
				{
					 $table_names[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $table_names[$i]['ORG_MODULE']));
				}*/

                $data['response'] = SUCCESSDATA;

                $data['list'] = $master_table_names;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
       
	   return $data;

    }

    private function _get_esctype_labels($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
             $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			if($role_code!=HA_ADMIN){
			// return $this->db->last_query();
              $where[$this->esctypelabels->MODULE_ID] = $org_type;
            //  return $where;
            $halabelslist = $this->basemodel->fetch_records_from($this->esctypelabels->tbl_name,$where);
			}else
			{
				 $halabelslist = $this->basemodel->fetch_records_from($this->esctypelabels->tbl_name);
			}
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['MODULE_ID']));
                    // return $this->db->last_query();
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }

    private function _get_escalation_labels($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			if($role_code!=HA_ADMIN){
				$where[$this->esclabels->MODULE_ID] = $org_type;
            $halabelslist = $this->basemodel->fetch_records_from($this->esclabels->tbl_name,$where);
            }else{
				
				 $halabelslist = $this->basemodel->fetch_records_from($this->esclabels->tbl_name);
			}
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['MODULE_ID']));
                    // return $this->db->last_query();
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }


    private function _get_role_labels($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;             
            if($role_code!="HA_ADMIN")
			{
		          $where[$this->rolelabels->ORG_MODULE] = $org_type;
         
            $halabelslist = $this->basemodel->fetch_records_from($this->rolelabels->tbl_name,$where);
			}else{
				$halabelslist = $this->basemodel->fetch_records_from($this->rolelabels->tbl_name);
			}
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                   $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID =>$halabelslist[$i]['ORG_ID']));
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }

    private function _get_vendor_label($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			// return $this->db->last_query();
            //  $where[$this->equpcondlabels->MODULE_ID] = $org_type;
            //  return $where;
			if($role_code!="HA_ADMIN")
			{
				$where[$this->vendor_label->ORG_MODULE] = $org_type;
				$halabelslist = $this->basemodel->fetch_records_from($this->vendor_label->tbl_name,$where);
			}else{
            $halabelslist = $this->basemodel->fetch_records_from($this->vendor_label->tbl_name);
            }
			//  return $this->db->last_query();
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                    $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $halabelslist[$i]['ORG_ID']));
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }

    private function _get_util_labels($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			if($role_code!=HA_ADMIN)
			{
              $where[$this->utilization_label->MODULE_ID] = $org_type;
            //  return $where;
            $halabelslist = $this->basemodel->fetch_records_from($this->utilization_label->tbl_name,$where);
            }else{
				$halabelslist = $this->basemodel->fetch_records_from($this->utilization_label->tbl_name);
			}
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['MODULE_ID']));
                    // return $this->db->last_query();
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }





    private function _get_esclevels_labels($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			if($role_code!=HA_ADMIN)
			{
			  $where[$this->esclevellabels->ORG_MODULE] = $org_type;
			// return $this->db->last_query();
            //  
            //  return $where;
            $halabelslist = $this->basemodel->fetch_records_from($this->esclevellabels->tbl_name,$where);
            }
			else
			{
				 $halabelslist = $this->basemodel->fetch_records_from($this->esclevellabels->tbl_name);
			}
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                    $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $halabelslist[$i]['ORG_ID']));
                    
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }


    private function _get_incidenttype_lables($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
             $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			if($role_code!=HA_ADMIN)
			{
				$where[$this->incidenttypelables->ORG_MODULE] = $org_type;
               $halabelslist = $this->basemodel->fetch_records_from($this->incidenttypelables->tbl_name,$where);
            }
		    else{
				$halabelslist = $this->basemodel->fetch_records_from($this->incidenttypelables->tbl_name);
			}
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                    $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $halabelslist[$i]['ORG_ID']));
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }

    private function _get_contracttype_labels($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
			 $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            // return $this->db->last_query();
			if($role_code!=HA_ADMIN){
              $where[$this->contracttypelabels->ORG_MODULE] = $org_type;
            //  return $where;
            $halabelslist = $this->basemodel->fetch_records_from($this->contracttypelabels->tbl_name,$where);
            
			}else{
				 $halabelslist = $this->basemodel->fetch_records_from($this->contracttypelabels->tbl_name);
			}
			//  return $this->db->last_query();
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                    $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $halabelslist[$i]['ORG_ID']));
                }
                
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }


    private function _get_devicenames_labels($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
             $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			if($role_code!=HA_ADMIN)
			{
				$where[$this->devicenameslabels->ORG_MODULE] = $org_type;
				 $halabelslist = $this->basemodel->fetch_records_from($this->devicenameslabels->tbl_name);
			}else
			{
				$halabelslist = $this->basemodel->fetch_records_from($this->devicenameslabels->tbl_name);
			}
            
           
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
					$halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $halabelslist[$i]['ORG_ID']));
                    
                }
                
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }

    private function _get_department_labels($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
             $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			if($role_code!=HA_ADMIN)
			{
			  $where[$this->departmentlabels->ORG_MODULE] = $org_type;
			 $halabelslist = $this->basemodel->fetch_records_from($this->departmentlabels->tbl_name,$where);
			}else{
            $halabelslist = $this->basemodel->fetch_records_from($this->departmentlabels->tbl_name);
			}
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
					$halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                    $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $halabelslist[$i]['ORG_ID']));    
                }
                
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }

    private function _get_countries_labels_list($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
             $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
              if($role_code!=HA_ADMIN) {           

		    $where[$this->countrieslabels->MODULE_ID] = $org_type;
            //  return $where;
            $halabelslist = $this->basemodel->fetch_records_from($this->countrieslabels->tbl_name,$where);
			  }else
			  {
				  $halabelslist = $this->basemodel->fetch_records_from($this->countrieslabels->tbl_name);
			  }
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                   $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['MODULE_ID']));
                   /* $halabelslist[$i]['MODULE_NAME'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['MODULE_ID']));
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_ID, array($this->modules->MODULE_ID => $halabelslist[$i]['MODULE_ID']));*/
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }


    private function _get_states_labels_list($jodata = array())
    {
           
		   
     
		
		
		$data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
			
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
             //return $this->db->last_query();
            if($role_code!=HA_ADMIN) {

                $where[$this->statelabels->MODULE_ID] = $org_type;
				//return $where;
                $halabelslist = $this->basemodel->fetch_records_from($this->statelabels->tbl_name, $where);
            }else
                {
                    $halabelslist = $this->basemodel->fetch_records_from($this->statelabels->tbl_name);
                }
            //  return $this->db->last_query();
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
					 $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['MODULE_ID']));
                    /*$halabelslist[$i]['MODULE_NAME'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['MODULE_ID']));
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_ID, array($this->modules->MODULE_ID => $halabelslist[$i]['MODULE_ID']));*/
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;



    }



    private function _update_equp_type_labels_list($jodata = array())

    {
        $data = array();
		 if (!empty($jodata)) {
        $equptypedata[$this->equptypelabels->TYPE] = $jodata->equp_type_name;
        //$equptypedata[$this->equptypelabels->MODULE_ID] = $jodata->module_id;
        $equptypedata[$this->equptypelabels->CODE] = $jodata->code;
        $equptypedata[$this->equptypelabels->STATUS] = $jodata->status;
        $equptypedata[$this->equptypelabels->ACTION] = $jodata->actions;
        $where[$this->equptypelabels->EQUP_TYPE_ID] = $jodata->EQUP_TYPE_ID;

        if ($this->basemodel->update_operation($equptypedata, $this->equptypelabels->tbl_name, $where)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Equptypelabels Updated Successfully';
        } else {

            $data['response'] = FAILEDATA;

        }
	}    
        return $data;
    }

	
	private function _update_module($jodata = array())

    {
		
		
        $data = array();
		 if (!empty($jodata)) {
        $moduel[$this->modules->MODULE_NAME] = $jodata->module_name;
		$moduel[$this->modules->STATUS] = $jodata->status;
        $where[$this->modules->MODULE_ID] = $jodata->MODULE_ID;
        if ($this->basemodel->update_operation($moduel, $this->modules->tbl_name, $where)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Modules Updated Successfully';
        } else {

            $data['response'] = FAILEDATA;
			$data['qry']  = $this->db->last_query();
			 $data['call_back'] = 'Modules Not Updated';

        }
	}    
        return $data;
    }


    private function _add_country_label($jodata = array())
    {
        $data = array();

                $countrieslabel[$this->countrieslabels->MODULE_ID] = $jodata->module_id;
                $countrieslabel[$this->countrieslabels->COUNTRY_CODE] = $jodata->country_code;
                $countrieslabel[$this->countrieslabels->COUNTRY_NAME] = $jodata->country_name;
                $countrieslabel[$this->countrieslabels->STATUS] = $jodata->status;
                $countrieslabel[$this->countrieslabels->ACTION] = $jodata->actions;


                if ($this->basemodel->insert_into_table($this->countrieslabels->tbl_name, $countrieslabel)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Reasons Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }

                     return $data;
            }

    private function _add_state_label($jodata = array())
    {
        $data = array();

        $statelabel[$this->statelabels->MODULE_ID] = $jodata->module_id;
        $statelabel[$this->statelabels->STATE_NAME] = $jodata->state_name;
        $statelabel[$this->statelabels->STATE_CODE] = $jodata->state_code;
        $statelabel[$this->statelabels->STATUS] = $jodata->status;
        $statelabel[$this->statelabels->ACTION] = $jodata->actions;


        if ($this->basemodel->insert_into_table($this->statelabels->tbl_name, $statelabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Reasons Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }

    private function _add_city_label($jodata = array())
    {
        $data = array();

        $citylabel[$this->citieslabels->MODULE_ID] = $jodata->module_id;
        $citylabel[$this->citieslabels->CITY_CODE] = $jodata->city_code;
        $citylabel[$this->citieslabels->CITY_NAME] = $jodata->city_name;
        $citylabel[$this->citieslabels->STATUS] = $jodata->status;
        $citylabel[$this->citieslabels->ACTION] = $jodata->actions;


        if ($this->basemodel->insert_into_table($this->citieslabels->tbl_name, $citylabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Reasons Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }

    private function _add_user_label($jodata = array())
    {
        $data = array();

        $userlabel[$this->userlabels->ORG_MODULE] = $jodata->module_id;
		$userlabel[$this->userlabels->ORG_ID]  = $jodata->org_id;
        $userlabel[$this->userlabels->USER_NAME] = $jodata->user_name;
        $userlabel[$this->userlabels->EMAIL_ID] = $jodata->email;
        $userlabel[$this->userlabels->EMP_NO] = $jodata->contact;
        $userlabel[$this->userlabels->ROLE_NAME] = $jodata->role;
        $userlabel[$this->userlabels->LEVEL] = $jodata->levels;
        $userlabel[$this->userlabels->BRANCH] = $jodata->branch;
        $userlabel[$this->userlabels->STATUS] = $jodata->status;
        $userlabel[$this->userlabels->ACTION] = $jodata->actions;

        if ($this->basemodel->insert_into_table($this->userlabels->tbl_name, $userlabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }

    private function _add_department_label($jodata = array())
    {
        $data = array();

        $deptlabel[$this->departmentlabels->ORG_MODULE] = $jodata->module_id;
		$deptlabel[$this->departmentlabels->ORG_ID] = $jodata->org_id;
       // $userlabel[$this->departmentlabels->USER_NAME] = $jodata->user_name;
        $deptlabel[$this->departmentlabels->USER_DEPT_NAME] = $jodata->department;
        $deptlabel[$this->departmentlabels->CODE] = $jodata->code;
        //$userlabel[$this->departmentlabels->ROLE] = $jodata->role;
        $deptlabel[$this->departmentlabels->STATUS] = $jodata->status;
        $deptlabel[$this->departmentlabels->ACTION] = $jodata->actions;



        if ($this->basemodel->insert_into_table($this->departmentlabels->tbl_name, $deptlabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }

    private function _add_escalation_label($jodata = array())
    {
        $data = array();

        $escalation[$this->esclabels->MODULE_ID] = $jodata->module_id;
        // $userlabel[$this->departmentlabels->USER_NAME] = $jodata->user_name;
        $escalation[$this->esclabels->EQUP_TYPE] = $jodata->equp_type;
        $escalation[$this->esclabels->ESC_TYPES] = $jodata->esc_type;
        $escalation[$this->esclabels->L1] = $jodata->l1;
        $escalation[$this->esclabels->L2] = $jodata->l2;
        $escalation[$this->esclabels->L3] = $jodata->l3;
        //$userlabel[$this->departmentlabels->ROLE] = $jodata->role;
        $escalation[$this->esclabels->ESC_CAT] = $jodata->esc_cat;
        $escalation[$this->esclabels->ACTION] = $jodata->actions;


        if ($this->basemodel->insert_into_table($this->esclabels->tbl_name, $escalation)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }


    private function _add_esctype_label($jodata = array())
    {
        $data = array();

        $esctype[$this->esctypelabels->MODULE_ID] = $jodata->module_id;
        // $userlabel[$this->departmentlabels->USER_NAME] = $jodata->user_name;
        $esctype[$this->esctypelabels->ESC_NAME] = $jodata->esc_name;
        $esctype[$this->esctypelabels->STATUS] = $jodata->status;
        $esctype[$this->esctypelabels->ACTION] = $jodata->actions;




        if ($this->basemodel->insert_into_table($this->esctypelabels->tbl_name, $esctype)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }

    private function _add_esclevel_label($jodata = array())
    {
        $data = array();

        $esclevel[$this->esclevellabels->ORG_MODULE] = $jodata->module_id;
		$esclevel[$this->esclevellabels->ORG_ID]     = $jodata->org_id;
        // $userlabel[$this->departmentlabels->USER_NAME] = $jodata->user_name;
        $esclevel[$this->esclevellabels->LEVEL_NAME] = $jodata->level_name;
        $esclevel[$this->esclevellabels->LEVEL_CODE] = $jodata->level_code;
        $esclevel[$this->esclevellabels->STATUS] = $jodata->status;
        $esclevel[$this->esclevellabels->ACTION] = $jodata->actions;



        if ($this->basemodel->insert_into_table($this->esclevellabels->tbl_name, $esclevel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }



    private function _add_devicenames_label($jodata = array())
    {
        $data = array();

        $devicelabel[$this->devicenameslabels->ORG_MODULE] = $jodata->module_id;
        $devicelabel[$this->devicenameslabels->NAME] = $jodata->device_name;
		$devicelabel[$this->devicenameslabels->ORG_ID]  = $jodata->org_id;
        $devicelabel[$this->devicenameslabels->CODE] = $jodata->code;
        $devicelabel[$this->devicenameslabels->STATUS] = $jodata->status;
        $devicelabel[$this->devicenameslabels->ACTION] = $jodata->actions;
           
		   
        if ($this->basemodel->insert_into_table($this->devicenameslabels->tbl_name, $devicelabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }

    private function _add_role_label($jodata = array())
    {
        $data = array();

        $rolelabel[$this->rolelabels->ORG_MODULE] = $jodata->module_id;
		$rolelabel[$this->rolelabels->ORG_ID] = $jodata->org_id;
        $rolelabel[$this->rolelabels->ROLE_NAME] = $jodata->role_name;
        $rolelabel[$this->rolelabels->ROLE_CODE] = $jodata->role_code;
        $rolelabel[$this->rolelabels->STATUS] = $jodata->status;
        $rolelabel[$this->rolelabels->ACTION] = $jodata->actions;


        if ($this->basemodel->insert_into_table($this->rolelabels->tbl_name, $rolelabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }


    private function _add_util_label($jodata = array())
    {
        $data = array();

        $utillabel[$this->utilization_label->MODULE_ID] = $jodata->module_id;
        $utillabel[$this->utilization_label->EQUIP_UTIL] = $jodata->util_name;
        $utillabel[$this->utilization_label->CODE] = $jodata->code;
        $utillabel[$this->utilization_label->STATUS] = $jodata->status;
        $utillabel[$this->utilization_label->ACTION] = $jodata->actions;


        if ($this->basemodel->insert_into_table($this->utilization_label->tbl_name, $utillabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }


    private function _add_depreciation_label($jodata = array())
    {
        $data = array();

        $depreciationlabel[$this->depreciation_label->ORG_MODULE] = $jodata->module_id;
		$depreciationlabel[$this->depreciation_label->ORG_ID] = $jodata->org_id;
        $depreciationlabel[$this->depreciation_label->NAME] = $jodata->name;
        $depreciationlabel[$this->depreciation_label->PERCENTAGE] = $jodata->percentage;
        $depreciationlabel[$this->depreciation_label->STATUS] = $jodata->status;
        $depreciationlabel[$this->depreciation_label->ACTION] = $jodata->actions;


        if ($this->basemodel->insert_into_table($this->depreciation_label->tbl_name, $depreciationlabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Depreciation Label Added Successfully";
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }




    private function _add_vendor_label($jodata = array())
    {
        $data = array();

        $vendorlabel[$this->vendor_label->ORG_MODULE] = $jodata->module_id;
		$vendorlabel[$this->vendor_label->ORG_ID] = $jodata->org_id;
        $vendorlabel[$this->vendor_label->NAME] = $jodata->vendor_name;
        $vendorlabel[$this->vendor_label->TYPE] = $jodata->type;
        $vendorlabel[$this->vendor_label->EMAIL_ID] = $jodata->email;
        $vendorlabel[$this->vendor_label->MOBILE_NO] = $jodata->contactno;
        $vendorlabel[$this->vendor_label->CP_NAME] = $jodata->contactperson;
        $vendorlabel[$this->vendor_label->CP_NUMBER] = $jodata->cpnumber;
        $vendorlabel[$this->vendor_label->CP_EMAIL]     = $jodata->cpemail;
		$vendorlabel[$this->vendor_label->STATUS] = $jodata->status;
        $vendorlabel[$this->vendor_label->ACTION]   = $jodata->actions;


        if ($this->basemodel->insert_into_table($this->vendor_label->tbl_name, $vendorlabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }




    private function _add_branch_label($jodata = array())
    {
        $data = array();

        $branchlabel[$this->branchlabels->ORG_MODULE] = $jodata->module_id;
		$branchlabel[$this->branchlabels->ORG_ID] = $jodata->org_id;
        $branchlabel[$this->branchlabels->BRANCH_NAME] = $jodata->branch_name;
        $branchlabel[$this->branchlabels->BRANCH_CODE] = $jodata->branch_code;
        $branchlabel[$this->branchlabels->USER_NAME] = $jodata->hod;
        $branchlabel[$this->branchlabels->BRANCH_ADDRESS] = $jodata->address;
        $branchlabel[$this->branchlabels->ADDED_ON] = $jodata->addeddate;
        $branchlabel[$this->branchlabels->STATUS] = $jodata->status;
        $branchlabel[$this->branchlabels->ACTION] = $jodata->actions;

       

        if ($this->basemodel->insert_into_table($this->branchlabels->tbl_name, $branchlabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Branch Label Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }
         
		 
		/* private function _add_table_name($jodata = array())
    {
		
		
        $data = array();

        $table_name[$this->table_names->TABLE_NAME] = $jodata->table_name;
		$table_name[$this->table_names->ORG_MODULE] = $jodata->module_id;

       

        if ($this->basemodel->insert_into_table($this->table_names->tbl_name, $table_name)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Table Label Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }*/
      
	  
	  private function _add_master_table($jodata = array())
	  {
		  $data = array();

        $master_table[$this->master_table->MASTER_TABLE_NAME] = $jodata->master_table_name;
		$master_table[$this->master_table->MASTER_TABLE_DESC] = $jodata->master_table_desc;

       

        if ($this->basemodel->insert_into_table($this->master_table->tbl_name, $master_table)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Table Label Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }

  
    
  
	
    private function _add_contracttype_label($jodata = array())
    {
        $data = array();

        $contractlabel[$this->contracttypelabels->ORG_MODULE] = $jodata->module_id;
		$contractlabel[$this->contracttypelabels->ORG_ID] = $jodata->org_id;
        $contractlabel[$this->contracttypelabels->CTYPE] = $jodata->contracttype_name;
        $contractlabel[$this->contracttypelabels->CFORM] = $jodata->contracttype_code;
        $contractlabel[$this->contracttypelabels->STATUS] = $jodata->status;
        $contractlabel[$this->contracttypelabels->ACTION] = $jodata->actions;



        if ($this->basemodel->insert_into_table($this->contracttypelabels->tbl_name, $contractlabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }

    private function _add_incidenttype_label($jodata = array())
    {
        $data = array();

        $incidentlabel[$this->incidenttypelables->ORG_MODULE] = $jodata->module_id;
		$incidentlabel[$this->incidenttypelables->ORG_ID]  = $jodata->org_id;
        $incidentlabel[$this->incidenttypelables->ITYPE] = $jodata->incidenttype_type;
        $incidentlabel[$this->incidenttypelables->CODE] = $jodata->incidenttype_code;
        $incidentlabel[$this->incidenttypelables->STATUS] = $jodata->status;
        $incidentlabel[$this->incidenttypelables->ACTION] = $jodata->actions;

          

        if ($this->basemodel->insert_into_table($this->incidenttypelables->tbl_name, $incidentlabel)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
			$data['qry'] = $this->db->last_query();
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

        return $data;
    }
	
	/*private function _add_device_label($jodata = array())
	{
		$data = array();
		
		/*$device_label[$this->devicelabels->E_ID] = $jodata->e_id;
		$device_label[$this->devicelabels->ORG_MODULE] = $jodata->module_id;
		$device_label[$this->devicelabels->ORG_ID] = $jodata->org_id;
		$device_label[$this->devicelabels->E_NAME] = $jodata->e_name;
		$device_label[$this->devicelabels->E_CAT] = $jodata->e_cat;
		$device_label[$this->devicelabels->E_TYPE] = $jodata->e_type;
		$device_label[$this->devicelabels->ACCSSORIES] = $jodata->accssories;
		$device_label[$this->devicelabels->CRITICAL_SPARES] = $jodata->critical_spares;
		$device_label[$this->devicelabels->C_NAME] = $jodata->c_name;
		$device_label[$this->devicelabels->E_MODEL] = $jodata->e_model;
		$device_label[$this->devicelabels->ES_NUMBER] = $jodata->serial_no;
		$device_label[$this->devicelabels->PHY_LOCATION] = $jodata->phy_location;
		$device_label[$this->devicelabels->DESC_P] = $jodata->desc;
		$device_label[$this->devicelabels->MF_DATE] = $jodata->mf_date;
		$device_label[$this->devicelabels->E_COST] = $jodata->e_cost;
		$device_label[$this->devicelabels->DISTRIBUTOR] = $jodata->distributor;
		$device_label[$this->devicelabels->VENDOR] = $jodata->vendor;
		$device_label[$this->devicelabels->REMARKS] = $jodata->remarks;
		$device_label[$this->devicelabels->DEPT_ID]  = $jodata->dept_id;
		$device_label[$this->devicelabels->PONO] = $jodata->po_no;
		$device_label[$this->devicelabels->USERNAME] = $jodata->username;
		$device_label[$this->devicelabels->GRN_DATE] = $jodata->grn_date;
		$device_label[$this->devicelabels->GRN_VALUE] = $jodata->grn_value;
		$device_label[$this->devicelabels->DATEOF_INSTALL] = $jodata->date_of_install;
		$device_label[$this->devicelabels->END_OF_LIFE] = $jodata->end_of_life;
		$device_label[$this->devicelabels->END_OF_SUPPORT] = $jodata->end_of_support;
		$device_label[$this->devicelabels->PDATE] = $jodata->po_date;
		$device_label[$this->devicelabels->E_COND] = $jodata->e_cond;
		$device_label[$this->devicelabels->BRANCH_ID] = $jodata->e_branch;
		//$device_label[$this->devicelabels->STATUS] = $jodata->status;*/
		
		
		/*$label_value[$this->devicelabels->ORG_ID] = $jodata->org_id;
		$label_value[$this->devicelabels->ORG_MODULE] = $jodata->module_id;
		$label_value[$this->devicelabels->TABLE_NAME] = $jodata->table_id;
		$label_value[$this->devicelabels->LABEL_1] = $jodata->label_1;
		$label_value[$this->devicelabels->LABEL_2] = $jodata->label_2;
		$label_value[$this->devicelabels->LABEL_3] = $jodata->label_3;
		$label_value[$this->devicelabels->LABEL_4] = $jodata->label_4;
		$label_value[$this->devicelabels->LABEL_5] = $jodata->label_5;
		$label_value[$this->devicelabels->LABEL_6] = $jodata->label_6;
		$label_value[$this->devicelabels->LABEL_7] = $jodata->label_7;
		$label_value[$this->devicelabels->LABEL_8] = $jodata->label_8;
		$label_value[$this->devicelabels->LABEL_9] = $jodata->label_9;
		$label_value[$this->devicelabels->LABEL_10] = $jodata->label_10;
		$label_value[$this->devicelabels->LABEL_11] = $jodata->label_11;
		$label_value[$this->devicelabels->LABEL_12] = $jodata->label_12;
		$label_value[$this->devicelabels->LABEL_13] = $jodata->label_13;
		$label_value[$this->devicelabels->LABEL_14] = $jodata->label_14;
		$label_value[$this->devicelabels->LABEL_15] = $jodata->label_15;
		$label_value[$this->devicelabels->LABEL_16] = $jodata->label_16;
		$label_value[$this->devicelabels->LABEL_17] = $jodata->label_17;
		$label_value[$this->devicelabels->LABEL_18] = $jodata->label_18;
		$label_value[$this->devicelabels->LABEL_19] = $jodata->label_19;
		$label_value[$this->devicelabels->LABEL_20] = $jodata->label_20;
		$label_value[$this->devicelabels->LABEL_21] = $jodata->label_21;
		$label_value[$this->devicelabels->LABEL_22] = $jodata->label_22;
		$label_value[$this->devicelabels->LABEL_23] = $jodata->label_23;
		$label_value[$this->devicelabels->LABEL_24] = $jodata->label_24;
		$label_value[$this->devicelabels->LABEL_25] = $jodata->label_25;
		$label_value[$this->devicelabels->LABEL_26] = $jodata->label_26;
		$label_value[$this->devicelabels->LABEL_27] = $jodata->label_27;
		$label_value[$this->devicelabels->LABEL_28] = $jodata->label_28;
		$label_value[$this->devicelabels->LABEL_29] = $jodata->label_29;
		$label_value[$this->devicelabels->LABEL_30] = $jodata->label_30;
		$label_value[$this->devicelabels->LABEL_31] = $jodata->label_31;
		$label_value[$this->devicelabels->LABEL_32] = $jodata->label_32;
		$label_value[$this->devicelabels->LABEL_33] = $jodata->label_33;
		$label_value[$this->devicelabels->LABEL_34] = $jodata->label_34;
		$label_value[$this->devicelabels->LABEL_35] = $jodata->label_35;
		$label_value[$this->devicelabels->LABEL_36] = $jodata->label_36;
		$label_value[$this->devicelabels->LABEL_37] = $jodata->label_37;
		$label_value[$this->devicelabels->LABEL_38] = $jodata->label_38;
		$label_value[$this->devicelabels->LABEL_39] = $jodata->label_39;
		$label_value[$this->devicelabels->LABEL_40] = $jodata->label_40;
		$label_value[$this->devicelabels->LABEL_41] = $jodata->label_41;
		$label_value[$this->devicelabels->LABEL_42] = $jodata->label_42;
		$label_value[$this->devicelabels->LABEL_43] = $jodata->label_43;
		$label_value[$this->devicelabels->LABEL_44] = $jodata->label_44;
		$label_value[$this->devicelabels->LABEL_45] = $jodata->label_45;
		$label_value[$this->devicelabels->LABEL_46] = $jodata->label_46;
		$label_value[$this->devicelabels->LABEL_47] = $jodata->label_47;
		$label_value[$this->devicelabels->LABEL_48] = $jodata->label_48;
		$label_value[$this->devicelabels->LABEL_49] = $jodata->label_49;
		$label_value[$this->devicelabels->LABEL_50] = $jodata->label_50;
		$label_value[$this->devicelabels->LABEL_51] = $jodata->label_51;
		$label_value[$this->devicelabels->LABEL_51] = $jodata->label_51;
		$label_value[$this->devicelabels->LABEL_52] = $jodata->label_52;
		$label_value[$this->devicelabels->LABEL_53] = $jodata->label_53;
		$label_value[$this->devicelabels->LABEL_54] = $jodata->label_54;
		$label_value[$this->devicelabels->LABEL_55] = $jodata->label_55;
		$label_value[$this->devicelabels->LABEL_56] = $jodata->label_56;
		$label_value[$this->devicelabels->LABEL_57] = $jodata->label_57;
		$label_value[$this->devicelabels->LABEL_58] = $jodata->label_58;
		$label_value[$this->devicelabels->LABEL_59] = $jodata->label_59;
		$label_value[$this->devicelabels->LABEL_60] = $jodata->label_60;
		$label_value[$this->devicelabels->LABEL_61] = $jodata->label_61;
		$label_value[$this->devicelabels->LABEL_62] = $jodata->label_62;
		$label_value[$this->devicelabels->LABEL_63] = $jodata->label_63;
		$label_value[$this->devicelabels->LABEL_64] = $jodata->label_64;
		$label_value[$this->devicelabels->LABEL_65] = $jodata->label_65;
		$label_value[$this->devicelabels->LABEL_66] = $jodata->label_66;
		$label_value[$this->devicelabels->LABEL_67] = $jodata->label_67;
		$label_value[$this->devicelabels->LABEL_68] = $jodata->label_68;
		$label_value[$this->devicelabels->LABEL_69] = $jodata->label_69;
		$label_value[$this->devicelabels->LABEL_70] = $jodata->label_70;
		$label_value[$this->devicelabels->LABEL_71] = $jodata->label_71;
		$label_value[$this->devicelabels->LABEL_72] = $jodata->label_72;
		$label_value[$this->devicelabels->LABEL_73] = $jodata->label_73;
		$label_value[$this->devicelabels->LABEL_74] = $jodata->label_74;
		$label_value[$this->devicelabels->LABEL_75] = $jodata->label_75;
		$label_value[$this->devicelabels->LABEL_76] = $jodata->label_76;
		$label_value[$this->devicelabels->LABEL_77] = $jodata->label_77;
		$label_value[$this->devicelabels->LABEL_78] = $jodata->label_78;
		$label_value[$this->devicelabels->LABEL_79] = $jodata->label_79;
		$label_value[$this->devicelabels->LABEL_80] = $jodata->label_80;
		$label_value[$this->devicelabels->LABEL_81] = $jodata->label_81;
		$label_value[$this->devicelabels->LABEL_82] = $jodata->label_82;
		$label_value[$this->devicelabels->LABEL_83] = $jodata->label_83;
		$label_value[$this->devicelabels->LABEL_84] = $jodata->label_84;
		$label_value[$this->devicelabels->LABEL_85] = $jodata->label_85;
		$label_value[$this->devicelabels->LABEL_86] = $jodata->label_86;
		$label_value[$this->devicelabels->LABEL_87] = $jodata->label_87;
		$label_value[$this->devicelabels->LABEL_88] = $jodata->label_88;
		$label_value[$this->devicelabels->LABEL_89] = $jodata->label_89;
		$label_value[$this->devicelabels->LABEL_90] = $jodata->label_90;
		$label_value[$this->devicelabels->LABEL_91] = $jodata->label_91;
		$label_value[$this->devicelabels->LABEL_92] = $jodata->label_92;
		$label_value[$this->devicelabels->LABEL_93] = $jodata->label_93;
		$label_value[$this->devicelabels->LABEL_94] = $jodata->label_94;
		$label_value[$this->devicelabels->LABEL_95] = $jodata->label_95;
		$label_value[$this->devicelabels->LABEL_96] = $jodata->label_96;
		$label_value[$this->devicelabels->LABEL_97] = $jodata->label_97;
		$label_value[$this->devicelabels->LABEL_98] = $jodata->label_98;
		$label_value[$this->devicelabels->LABEL_99] = $jodata->label_99;
		$label_value[$this->devicelabels->LABEL_100] = $jodata->label_100;
		
        if ($this->basemodel->insert_into_table($this->devicelabels->tbl_name, $label_value)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "User Label Added Successfully";
        } else {
            $data['response'] = FAILEDATA;
			$data['qry'] = $this->db->last_query();
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }
		return $data;
	}
 
 */
         private function _add_item_model($jodata = array())
	{
		$data = array();
		
		//$device_label[$this->item_master->E_ID] = $jodata->e_id;
		$item_master_label[$this->item_master->ORG_MODULE] = $jodata->module_id;
		//$item_master_label[$this->item_master->ORG_TABLE] = $jodata->table_id;
		$item_master_label[$this->item_master->MASTER_TABLE] = $jodata->master_table_id;
		//$device_label[$this->item_master->ORG_ID] = 
		$item_master_label[$this->item_master->FIELD_TYPE] = $jodata->field_type;
		$item_master_label[$this->item_master->FIELD_DESC] = $jodata->field_desc;
		$item_master_label[$this->item_master->FIELD_ID] = $jodata->field_id;
		 $qid = (int)$this->basemodel->select_max_val($this->item_master->tbl_name, $this->item_master->SNO);
		$item_master_label[$this->item_master->Q_ID]    = $this->baselibrary->set_question_id($qid);
		$item_master_label[$this->item_master->DISABLED]  = $jodata->disabled;
		$item_master_label[$this->item_master->MANDETORY]  = $jodata->mandatory;
		$item_master_label[$this->item_master->DB_FIELD]  = $jodata->db_field;
		//$data_type = $this->basemodel->fetch_single_row($this->datatypes->tbl_name,,array($this->datatypes->DATA_TYPE_KEY=>$jodata->db_field));
		    //  $data_type = "SELECT * FROM `hsp_tbl_datatypes` where DATA_TYPE_KEY='$jodata->db_field'";
			//  $data_type_res = $this->basemodel->execute_qry($data_type);
		$item_master_label[$this->item_master->MAX_OPT]   = $jodata->max_opt;
 		$item_master_label[$this->item_master->OPT1]  = $jodata->opt1;
		$item_master_label[$this->item_master->OPT2]  = $jodata->opt2;
		$item_master_label[$this->item_master->OPT3]  = $jodata->opt3;
		$item_master_label[$this->item_master->OPT4]  = $jodata->opt4;
		$item_master_label[$this->item_master->OPT5]  = $jodata->opt5;
		$item_master_label[$this->item_master->OPT6]  = $jodata->opt6;
		$item_master_label[$this->item_master->OPT7]  = $jodata->opt7;
		$item_master_label[$this->item_master->OPT8]  = $jodata->opt8;
		$item_master_label[$this->item_master->OPT9]  = $jodata->opt9;
		$item_master_label[$this->item_master->OPT10] = $jodata->opt10;
		$item_master_label[$this->item_master->OPT11] = $jodata->opt11;
		$item_master_label[$this->item_master->OPT12] = $jodata->opt12;
		$item_master_label[$this->item_master->OPT13] = $jodata->opt13;
		$item_master_label[$this->item_master->OPT14] = $jodata->opt14;
		$item_master_label[$this->item_master->OPT15] = $jodata->opt15;
		$item_master_label[$this->item_master->OPT16] = $jodata->opt16;
		$item_master_label[$this->item_master->OPT17] = $jodata->opt17;
		$item_master_label[$this->item_master->OPT18] = $jodata->opt18;
		$item_master_label[$this->item_master->OPT19] = $jodata->opt19;
		$item_master_label[$this->item_master->OPT20] = $jodata->opt20;
		$item_master_label[$this->item_master->OPT21] = $jodata->opt21;
		$item_master_label[$this->item_master->OPT22] = $jodata->opt22;
		$item_master_label[$this->item_master->OPT23] = $jodata->opt23;
		$item_master_label[$this->item_master->OPT24] = $jodata->opt24;
		$item_master_label[$this->item_master->OPT25] = $jodata->opt25;
		$item_master_label[$this->item_master->CREATED_BY] = isset($jodata->user_id) ? ($jodata->user_id) : $this->session->user_id;
		
		if ($this->basemodel->insert_into_table($this->item_master->tbl_name, $item_master_label)) {
			$module_name=$this->basemodel->get_single_column_value($this->modules->tbl_name,$this->modules->MODULE_NAME,array($this->modules->MODULE_ID=>$item_master_label[$this->item_master->ORG_MODULE]));
			if($item_master_label[$this->item_master->DB_FIELD]!=NULL){
				if($item_master_label[$this->item_master->FIELD_TYPE]=='DA')
				{
				 $data_types = $this->basemodel->fetch_single_row($this->datatypes->tbl_name,array($this->datatypes->DATA_TYPE_KEY=>$jodata->field_type));
				 $qry = "ALTER TABLE `hsp_tbl_".$module_name."` ADD `".$item_master_label[$this->item_master->DB_FIELD]."` ".$data_types[$this->datatypes->DATA_TYPE_TYPE]."  NOT NULL AFTER `STATUS`";
				 $qwr = $this->basemodel->executeqry($qry);
				}else
				{
					$data_types = $this->basemodel->fetch_single_row($this->datatypes->tbl_name,array($this->datatypes->DATA_TYPE_KEY=>$jodata->field_type));
				    $qry = "ALTER TABLE hsp_tbl_".$module_name." ADD `".$item_master_label[$this->item_master->DB_FIELD]."` ".$data_types[$this->datatypes->DATA_TYPE_TYPE]."(".$data_types[$this->datatypes->DATA_TYPE_LENGTH].") NOT NULL AFTER `STATUS`";
				    $qwr = $this->basemodel->executeqry($qry);
				}
			
			 $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Item Master Added Successfully";
			}else
			{
				 $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Item Master Added Successfully";
			}
           
        } else {
            $data['response'] = FAILEDATA;
			$data['qry'] = $this->db->last_query();
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }
		return $data;
	}
		
		
 
      
	/*  private function _update_labels_list($jodata = array())
	{
		$data = array();
		
		
		
		
		$label_value[$this->devicelabels->LABEL_1] = $jodata->label_1;
		$label_value[$this->devicelabels->LABEL_2] = $jodata->label_2;
		$label_value[$this->devicelabels->LABEL_3] = $jodata->label_3;
		$label_value[$this->devicelabels->LABEL_4] = $jodata->label_4;
		$label_value[$this->devicelabels->LABEL_5] = $jodata->label_5;
		$label_value[$this->devicelabels->LABEL_6] = $jodata->label_6;
		$label_value[$this->devicelabels->LABEL_7] = $jodata->label_7;
		$label_value[$this->devicelabels->LABEL_8] = $jodata->label_8;
		$label_value[$this->devicelabels->LABEL_9] = $jodata->label_9;
		$label_value[$this->devicelabels->LABEL_10] = $jodata->label_10;
		$label_value[$this->devicelabels->LABEL_11] = $jodata->label_11;
		$label_value[$this->devicelabels->LABEL_12] = $jodata->label_12;
		$label_value[$this->devicelabels->LABEL_13] = $jodata->label_13;
		$label_value[$this->devicelabels->LABEL_14] = $jodata->label_14;
		$label_value[$this->devicelabels->LABEL_15] = $jodata->label_15;
		$label_value[$this->devicelabels->LABEL_16] = $jodata->label_16;
		$label_value[$this->devicelabels->LABEL_17] = $jodata->label_17;
		$label_value[$this->devicelabels->LABEL_18] = $jodata->label_18;
		$label_value[$this->devicelabels->LABEL_19] = $jodata->label_19;
		$label_value[$this->devicelabels->LABEL_20] = $jodata->label_20;
		$label_value[$this->devicelabels->LABEL_21] = $jodata->label_21;
		$label_value[$this->devicelabels->LABEL_22] = $jodata->label_22;
		$label_value[$this->devicelabels->LABEL_23] = $jodata->label_23;
		$label_value[$this->devicelabels->LABEL_24] = $jodata->label_24;
		$label_value[$this->devicelabels->LABEL_25] = $jodata->label_25;
		$label_value[$this->devicelabels->LABEL_26] = $jodata->label_26;
		$label_value[$this->devicelabels->LABEL_27] = $jodata->label_27;
		$label_value[$this->devicelabels->LABEL_28] = $jodata->label_28;
		$label_value[$this->devicelabels->LABEL_29] = $jodata->label_29;
		$label_value[$this->devicelabels->LABEL_30] = $jodata->label_30;
		$label_value[$this->devicelabels->LABEL_31] = $jodata->label_31;
		$label_value[$this->devicelabels->LABEL_32] = $jodata->label_32;
		$label_value[$this->devicelabels->LABEL_33] = $jodata->label_33;
		$label_value[$this->devicelabels->LABEL_34] = $jodata->label_34;
		$label_value[$this->devicelabels->LABEL_35] = $jodata->label_35;
		$label_value[$this->devicelabels->LABEL_36] = $jodata->label_36;
		$label_value[$this->devicelabels->LABEL_37] = $jodata->label_37;
		$label_value[$this->devicelabels->LABEL_38] = $jodata->label_38;
		$label_value[$this->devicelabels->LABEL_39] = $jodata->label_39;
		$label_value[$this->devicelabels->LABEL_40] = $jodata->label_40;
		$label_value[$this->devicelabels->LABEL_41] = $jodata->label_41;
		$label_value[$this->devicelabels->LABEL_42] = $jodata->label_42;
		$label_value[$this->devicelabels->LABEL_43] = $jodata->label_43;
		$label_value[$this->devicelabels->LABEL_44] = $jodata->label_44;
		$label_value[$this->devicelabels->LABEL_45] = $jodata->label_45;
		$label_value[$this->devicelabels->LABEL_46] = $jodata->label_46;
		$label_value[$this->devicelabels->LABEL_47] = $jodata->label_47;
		$label_value[$this->devicelabels->LABEL_48] = $jodata->label_48;
		$label_value[$this->devicelabels->LABEL_49] = $jodata->label_49;
		$label_value[$this->devicelabels->LABEL_50] = $jodata->label_50;
		$label_value[$this->devicelabels->LABEL_51] = $jodata->label_51;
		$label_value[$this->devicelabels->LABEL_51] = $jodata->label_51;
		$label_value[$this->devicelabels->LABEL_52] = $jodata->label_52;
		$label_value[$this->devicelabels->LABEL_53] = $jodata->label_53;
		$label_value[$this->devicelabels->LABEL_54] = $jodata->label_54;
		$label_value[$this->devicelabels->LABEL_55] = $jodata->label_55;
		$label_value[$this->devicelabels->LABEL_56] = $jodata->label_56;
		$label_value[$this->devicelabels->LABEL_57] = $jodata->label_57;
		$label_value[$this->devicelabels->LABEL_58] = $jodata->label_58;
		$label_value[$this->devicelabels->LABEL_59] = $jodata->label_59;
		$label_value[$this->devicelabels->LABEL_60] = $jodata->label_60;
		$label_value[$this->devicelabels->LABEL_61] = $jodata->label_61;
		$label_value[$this->devicelabels->LABEL_62] = $jodata->label_62;
		$label_value[$this->devicelabels->LABEL_63] = $jodata->label_63;
		$label_value[$this->devicelabels->LABEL_64] = $jodata->label_64;
		$label_value[$this->devicelabels->LABEL_65] = $jodata->label_65;
		$label_value[$this->devicelabels->LABEL_66] = $jodata->label_66;
		$label_value[$this->devicelabels->LABEL_67] = $jodata->label_67;
		$label_value[$this->devicelabels->LABEL_68] = $jodata->label_68;
		$label_value[$this->devicelabels->LABEL_69] = $jodata->label_69;
		$label_value[$this->devicelabels->LABEL_70] = $jodata->label_70;
		$label_value[$this->devicelabels->LABEL_71] = $jodata->label_71;
		$label_value[$this->devicelabels->LABEL_72] = $jodata->label_72;
		$label_value[$this->devicelabels->LABEL_73] = $jodata->label_73;
		$label_value[$this->devicelabels->LABEL_74] = $jodata->label_74;
		$label_value[$this->devicelabels->LABEL_75] = $jodata->label_75;
		$label_value[$this->devicelabels->LABEL_76] = $jodata->label_76;
		$label_value[$this->devicelabels->LABEL_77] = $jodata->label_77;
		$label_value[$this->devicelabels->LABEL_78] = $jodata->label_78;
		$label_value[$this->devicelabels->LABEL_79] = $jodata->label_79;
		$label_value[$this->devicelabels->LABEL_80] = $jodata->label_80;
		$label_value[$this->devicelabels->LABEL_81] = $jodata->label_81;
		$label_value[$this->devicelabels->LABEL_82] = $jodata->label_82;
		$label_value[$this->devicelabels->LABEL_83] = $jodata->label_83;
		$label_value[$this->devicelabels->LABEL_84] = $jodata->label_84;
		$label_value[$this->devicelabels->LABEL_85] = $jodata->label_85;
		$label_value[$this->devicelabels->LABEL_86] = $jodata->label_86;
		$label_value[$this->devicelabels->LABEL_87] = $jodata->label_87;
		$label_value[$this->devicelabels->LABEL_88] = $jodata->label_88;
		$label_value[$this->devicelabels->LABEL_89] = $jodata->label_89;
		$label_value[$this->devicelabels->LABEL_90] = $jodata->label_90;
		$label_value[$this->devicelabels->LABEL_91] = $jodata->label_91;
		$label_value[$this->devicelabels->LABEL_92] = $jodata->label_92;
		$label_value[$this->devicelabels->LABEL_93] = $jodata->label_93;
		$label_value[$this->devicelabels->LABEL_94] = $jodata->label_94;
		$label_value[$this->devicelabels->LABEL_95] = $jodata->label_95;
		$label_value[$this->devicelabels->LABEL_96] = $jodata->label_96;
		$label_value[$this->devicelabels->LABEL_97] = $jodata->label_97;
		$label_value[$this->devicelabels->LABEL_98] = $jodata->label_98;
		$label_value[$this->devicelabels->LABEL_99] = $jodata->label_99;
		$label_value[$this->devicelabels->LABEL_100] = $jodata->label_100;
		$where[$this->devicelabels->DEVICE_ID] = $jodata->DEVICE_ID;
 		
        if ($this->basemodel->update_operation($label_value,$this->devicelabels->tbl_name, $where)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Update Labellist  Successfully";
        } else {
            $data['response'] = FAILEDATA;
			$data['qry'] = $this->db->last_query();
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }
		return $data;
	}
*/
	  
	  
	  
	  
	  
    private function _update_equp_cond_labels($jodata = array())

       {
           $data = array();
           $equpconddata[$this->equpcondlabels->ECODE] = $jodata->cond_name;
           //$equpconddata[$this->equpcondlabels->MODULE_ID] = $jodata->module_id;
           $equpconddata[$this->equpcondlabels->EVAL] = $jodata->code;
           $equpconddata[$this->equpcondlabels->STATUS] = $jodata->status;
           $equpconddata[$this->equpcondlabels->ACTION] = $jodata->actions;
           $where[$this->equpcondlabels->ID] = $jodata->ID;
           if ($this->basemodel->update_operation($equpconddata, $this->equpcondlabels->tbl_name, $where)) {
               $data['response'] = SUCCESSDATA;
               $data['call_back'] = 'Classification Updated Successfully';
           } else {
               $data['response'] = FAILEDATA;

           }


       }

    private function _update_role_type($jodata = array())

    {
        $data = array();
        $eroletypes[$this->roletypes->MODULE_ID] = $jodata->module_id;
        $eroletypes[$this->roletypes->ROLE_TYPE] = $jodata->role_type;
        $eroletypes[$this->roletypes->ROLE_TYPE_NAME] = $jodata->role_type_name;
        $eroletypes[$this->roletypes->STATUS] = $jodata->status;

        $where[$this->roletypes->ROLE_ID] = $jodata->ROLE_ID;

        if ($this->basemodel->update_operation($eroletypes, $this->roletypes->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Role Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }


    }

    private function _update_country_label($jodata = array())

    {
        $data = array();
        //$ecountry[$this->countrieslabels->MODULE_ID] = $jodata->module_id;
        $ecountry[$this->countrieslabels->COUNTRY_NAME] = $jodata->country_name;
        $ecountry[$this->countrieslabels->COUNTRY_CODE] = $jodata->country_code;
        $ecountry[$this->countrieslabels->STATUS] = $jodata->status;
        $ecountry[$this->countrieslabels->ACTION]  = $jodata->actions;
        $where[$this->countrieslabels->COUNTRY_ID] = $jodata->COUNTRY_ID;

        if ($this->basemodel->update_operation($ecountry, $this->countrieslabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Role Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }


    }

    private function _update_cities_label($jodata = array())

    {
        $data = array();
        //$ecitylabel[$this->citieslabels->MODULE_ID] = $jodata->module_id;
        $ecitylabel[$this->citieslabels->CITY_NAME] = $jodata->city_name;
        $ecitylabel[$this->citieslabels->CITY_CODE] = $jodata->city_code;
        $ecitylabel[$this->citieslabels->STATUS] = $jodata->status;
        $ecitylabel[$this->citieslabels->ACTION] = $jodata->actions;

        $where[$this->citieslabels->CITY_ID] = $jodata->CITY_ID;

        if ($this->basemodel->update_operation($ecitylabel, $this->citieslabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Role Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }


    }

    private function _update_states_label($jodata = array())

    {
        $data = array();
        //$estatelabel[$this->statelabels->MODULE_ID] = $jodata->module_id;
        $estatelabel[$this->statelabels->STATE_NAME] = $jodata->state_name;
        $estatelabel[$this->statelabels->STATE_CODE] = $jodata->state_code;
        $estatelabel[$this->statelabels->STATUS] = $jodata->status;
        $estatelabel[$this->statelabels->ACTION] = $jodata->actions;

        $where[$this->statelabels->STATE_ID] = $jodata->STATE_ID;

        if ($this->basemodel->update_operation($estatelabel, $this->statelabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Role Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }
		
		return $data;


    }

    private function _update_user_label($jodata = array())

    {
        $data = array();
        //$userlabel[$this->userlabels->MODULE_ID] = $jodata->module_id;
        $userlabel[$this->userlabels->USER_NAME] = $jodata->user_name;
        $userlabel[$this->userlabels->EMAIL_ID] = $jodata->email;
        $userlabel[$this->userlabels->EMP_NO] = $jodata->contact;
        $userlabel[$this->userlabels->ROLE_NAME] = $jodata->role;
        $userlabel[$this->userlabels->LEVEL] = $jodata->levels;
        $userlabel[$this->userlabels->BRANCH] = $jodata->branch;
        $userlabel[$this->userlabels->STATUS] = $jodata->status;
        $userlabel[$this->userlabels->ACTION] = $jodata->actions;


        $where[$this->userlabels->ID] = $jodata->ID;


        if ($this->basemodel->update_operation($userlabel, $this->userlabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Role Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }
          return $data;

    }
    private function _update_dept_label($jodata = array())

    {
        $data = array();
        //$deptlabel[$this->departmentlabels->MODULE_ID] = $jodata->module_id;
        $deptlabel[$this->departmentlabels->USER_DEPT_NAME] = $jodata->department;
		$deptlabel[$this->departmentlabels->CODE]  = $jodata->code;
        $deptlabel[$this->departmentlabels->STATUS] = $jodata->status;
        $deptlabel[$this->departmentlabels->ACTION] = $jodata->actions;


        $where[$this->departmentlabels->DEPT_ID] = $jodata->DEPT_ID;


        if ($this->basemodel->update_operation($deptlabel, $this->departmentlabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Dept Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }
      return $data;
        
    }



    private function _update_branch_label($jodata = array())

    {
        $data = array();
        //$branchlabel[$this->branchlabels->MODULE_ID] = $jodata->module_id;
        $branchlabel[$this->branchlabels->BRANCH_NAME] = $jodata->branch_name;
        $branchlabel[$this->branchlabels->BRANCH_CODE] = $jodata->branch_code;
        $branchlabel[$this->branchlabels->USER_NAME] = $jodata->hod;
        $branchlabel[$this->branchlabels->BRANCH_ADDRESS] = $jodata->address;
        $branchlabel[$this->branchlabels->ADDED_ON] = $jodata->added_date;
        $branchlabel[$this->branchlabels->STATUS] = $jodata->status;
        $branchlabel[$this->branchlabels->ACTION] = $jodata->actions;



        $where[$this->branchlabels->BRANCH_ID] = $jodata->BRANCH_ID;


        if ($this->basemodel->update_operation($branchlabel, $this->branchlabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Role Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }
         return $data;

    }

        private function _update_item_master($jodata = array())

    {
        $data = array();
        //$branchlabel[$this->branchlabels->MODULE_ID] = $jodata->module_id;
        $item_master[$this->item_master->FIELD_DESC] = $jodata->field_desc;
		//$item_master[$this->item_master->QID] = $jodata->qid;
        $item_master[$this->item_master->FIELD_TYPE] = $jodata->field_type;
		$item_master[$this->item_master->MAX_OPT] = $jodata->max_opt;
		//$item_master[$this->item_master->Q_ID]  = $jodata->qid;
		$item_master[$this->item_master->DB_FIELD] = $jodata->db_field;
		$item_master[$this->item_master->MANDETORY] = $jodata->mandetory;
        $item_master[$this->item_master->DISABLED] = $jodata->disabled;
        $item_master[$this->item_master->OPT1] = $jodata->opt1;
        $item_master[$this->item_master->OPT2] = $jodata->opt2;
        $item_master[$this->item_master->OPT3] = $jodata->opt3;
        $item_master[$this->item_master->OPT4] = $jodata->opt4;
        $item_master[$this->item_master->OPT5] = $jodata->opt5;
	    $item_master[$this->item_master->OPT6] = $jodata->opt6;
		$item_master[$this->item_master->OPT7] = $jodata->opt7;
		$item_master[$this->item_master->OPT8] = $jodata->opt8;
		$item_master[$this->item_master->OPT9] = $jodata->opt9;
		$item_master[$this->item_master->OPT10] = $jodata->opt10;
		$item_master[$this->item_master->OPT11] = $jodata->opt11;
		$item_master[$this->item_master->OPT12] = $jodata->opt12;
		$item_master[$this->item_master->OPT13] = $jodata->opt13;
		$item_master[$this->item_master->OPT14] = $jodata->opt14;
		$item_master[$this->item_master->OPT15] = $jodata->opt15;
		$item_master[$this->item_master->OPT16] = $jodata->opt16;
		$item_master[$this->item_master->OPT17] = $jodata->opt17;
		$item_master[$this->item_master->OPT18] = $jodata->opt18;
		$item_master[$this->item_master->OPT19] = $jodata->opt19;
		$item_master[$this->item_master->OPT20] = $jodata->opt20;
		$item_master[$this->item_master->OPT21] = $jodata->opt21;
		$item_master[$this->item_master->OPT22] = $jodata->opt22;
		$item_master[$this->item_master->OPT23] = $jodata->opt23;
		$item_master[$this->item_master->OPT24] = $jodata->opt24;
		$item_master[$this->item_master->OPT25] = $jodata->opt25;
		
		 
        $where[$this->item_master->SNO] = $jodata->SNO;


        if ($this->basemodel->update_operation($item_master, $this->item_master->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Updated  Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;
			$data['call_back'] = 'update_failed';

        }
         return $data;

    }
 
		 
		 
		 
		/* private function _update_table_name($jodata = array())

    {
        $data = array();
        //$branchlabel[$this->branchlabels->MODULE_ID] = $jodata->module_id;
        $branchlabel[$this->table_names->TABLE_NAME] = $jodata->table_name;
		
        
        



        $where[$this->table_names->TBL_ID] = $jodata->TBL_ID;


        if ($this->basemodel->update_operation($branchlabel, $this->table_names->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Table Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }
         return $data;

    }*/

		 
    private function _update_incidenttype_label($jodata = array())

    {
        $data = array();
        //$incidenttypelabel[$this->incidenttypelables->MODULE_ID] = $jodata->module_id;
        $incidenttypelabel[$this->incidenttypelables->ITYPE] = $jodata->incident_type;
        $incidenttypelabel[$this->incidenttypelables->CODE] = $jodata->incident_code;
        $incidenttypelabel[$this->incidenttypelables->STATUS] = $jodata->status;
        $incidenttypelabel[$this->incidenttypelables->ACTION] = $jodata->actions;



        $where[$this->incidenttypelables->INCIDENT_ID] = $jodata->INCIDENT_ID;


        if ($this->basemodel->update_operation($incidenttypelabel, $this->incidenttypelables->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Incident  Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }

         return $data;
    }

    private function _update_contracttype_label($jodata = array())

    {
        $data = array();
        //$contracttypelabel[$this->contracttypelabels->MODULE_ID] = $jodata->module_id;
        $contracttypelabel[$this->contracttypelabels->CTYPE] = $jodata->contract_type;
        $contracttypelabel[$this->contracttypelabels->CFORM] = $jodata->contract_type;
        $contracttypelabel[$this->contracttypelabels->STATUS] = $jodata->status;
        $contracttypelabel[$this->contracttypelabels->ACTION] = $jodata->actions;



        $where[$this->contracttypelabels->CON_ID] = $jodata->CON_ID;


        if ($this->basemodel->update_operation($contracttypelabel, $this->contracttypelabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Contract Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }

          return $data;
    }

    private function _update_devicename_label($jodata = array())

    {
        $data = array();
        //$devicenamelabel[$this->devicenameslabels->MODULE_ID] = $jodata->module_id;
        $devicenamelabel[$this->devicenameslabels->DEVICE_NAME] = $jodata->device_name;
        $devicenamelabel[$this->devicenameslabels->CODE] = $jodata->code;
        $devicenamelabel[$this->devicenameslabels->STATUS] = $jodata->status;
        $devicenamelabel[$this->devicenameslabels->ACTION] = $jodata->actions;


        $where[$this->devicenameslabels->NAME_ID] = $jodata->NAME_ID;


        if ($this->basemodel->update_operation($devicenamelabel, $this->devicenameslabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Device Name  Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }

        return $data;
    }

    private function _update_vendor_label($jodata = array())

    {
        $data = array();
        //$vendorlabel[$this->vendor_label->MODULE_ID] = $jodata->module_id;
        $vendorlabel[$this->vendor_label->NAME] = $jodata->vendor_name;
        $vendorlabel[$this->vendor_label->TYPE] = $jodata->type;
        $vendorlabel[$this->vendor_label->EMAIL_ID] = $jodata->email;
        $vendorlabel[$this->vendor_label->MOBILENO] = $jodata->contactno;
        $vendorlabel[$this->vendor_label->CP_NAME] = $jodata->contactperson;
        $vendorlabel[$this->vendor_label->CP_NUMBER] = $jodata->cpnumber;
		$vendorlabel[$this->vendor_label->STATUS] = $jodata->status;
		$vendorlabel[$this->vendor_label->ACTION] = $jodata->actions;


        $where[$this->vendor_label->VENDOR_ID] = $jodata->VENDOR_ID;


        if ($this->basemodel->update_operation($vendorlabel, $this->vendor_label->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Vendor label Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }

           return $data;
    }


    private function _update_role_labels($jodata = array())

    {
        $data = array();
        //$rolelabel[$this->rolelabels->MODULE_ID] = $jodata->module_id;
        $rolelabel[$this->rolelabels->ROLE_NAME] = $jodata->role_name;
        $rolelabel[$this->rolelabels->ROLE_CODE] = $jodata->role_code;
        $rolelabel[$this->rolelabels->STATUS] = $jodata->status;
        $rolelabel[$this->rolelabels->ACTION] = $jodata->actions;


        $where[$this->rolelabels->ROLE_ID] = $jodata->ROLE_ID;


        if ($this->basemodel->update_operation($rolelabel, $this->rolelabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Role Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }

           return $data;
    }


    private function _update_util_labels($jodata = array())

    {
        $data = array();
        //$utillabel[$this->utilization_label->MODULE_ID] = $jodata->module_id;
        $utillabel[$this->utilization_label->EQUIP_UTIL] = $jodata->util;
        $utillabel[$this->utilization_label->CODE] = $jodata->CODE;
        $utillabel[$this->utilization_label->STATUS] = $jodata->status;
        $utillabel[$this->utilization_label->ACTION] = $jodata->actions;


        $where[$this->utilization_label->UTIL_ID] = $jodata->UTIL_ID;


        if ($this->basemodel->update_operation($utillabel, $this->utilization_label->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Role Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }

            return $data;
    }


    private function _update_escalation_labels($jodata = array())

    {
        $data = array();
        //$escalationlabel[$this->esclabels->MODULE_ID] = $jodata->module_id;
        $escalationlabel[$this->esclabels->EQUP_TYPE] = $jodata->equp_type;
        $escalationlabel[$this->esclabels->ESC_TYPES] = $jodata->esc_types;
        $escalationlabel[$this->esclabels->ESC_CAT] = $jodata->esc_cat;
        $escalationlabel[$this->esclabels->L1] = $jodata->l1;
        $escalationlabel[$this->esclabels->L2] = $jodata->l2;
        $escalationlabel[$this->esclabels->L3] = $jodata->L3;
        $escalationlabel[$this->esclabels->ACTION] =$jodata->actions;

        $where[$this->esclabels->ESC_ID] = $jodata->ESC_ID;

        if ($this->basemodel->update_operation($escalationlabel, $this->devicenameslabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Role Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }

        return $data;
    }

    private function _update_escalation_level_labels($jodata = array())

    {
        $data = array();
        //$esclevellabel[$this->esclevellabels->MODULE_ID] = $jodata->module_id;
        $esclevellabel[$this->esclevellabels->LEVEL_NAME] = $jodata->level_name;
        $esclevellabel[$this->esclevellabels->LEVEL_CODE] = $jodata->level_code;
        $esclevellabel[$this->esclevellabels->STATUS] = $jodata->status;
        $esclevellabel[$this->esclevellabels->ACTION] =$jodata->actions;


        $where[$this->esclevellabels->LEVEL_ID] = $jodata->LEVEL_ID;


        if ($this->basemodel->update_operation($esclevellabel, $this->esclevellabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Role Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }
             return $data;

    }

    private function _update_escalation_type_labels($jodata = array())

    {
        $data = array();
        //$esctypelabel[$this->esctypelabels->MODULE_ID] = $jodata->module_id;
        $esctypelabel[$this->esctypelabels->ESC_NAME] = $jodata->esc_name;
        $esctypelabel[$this->esctypelabels->STATUS] = $jodata->status;
        $esctypelabel[$this->esctypelabels->ACTION] =$jodata->actions;


        $where[$this->esctypelabels->ESC_TYPE_ID] = $jodata->ESC_TYPE_ID;

        if ($this->basemodel->update_operation($esctypelabel, $this->esctypelabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Role Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }

        return $data;
    }




    private function _equp_cond_labels_orglist($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            // return $this->db->last_query();
              $where[$this->equpcondlabels->MODULE_ID] = $org_type;
            //  return $where;
            $halabelslist = $this->basemodel->fetch_records_from($this->equpcondlabels->tbl_name,$where);
            // return $this->db->last_query();
            if (!empty($halabelslist)) {
                $data['response'] = SUCCESSDATA;
                $data['equpconditionorglabel'] = $halabelslist;

            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
    private function _add_equpcond_label($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {

            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $today = date('Y-m-d H:i:s');
            $labeldata[$this->equpcondlabels->ORG_MODULE] = $jodata->module_id;
			$labeldata[$this->equpcondlabels->ORG_ID]   = $jodata->org_id;
            $labeldata[$this->equpcondlabels->ECODE] = $jodata->label_name;
            $labeldata[$this->equpcondlabels->EVAL]   = $jodata->code;
            $labeldata[$this->equpcondlabels->STATUS] = $jodata->status;
            $labeldata[$this->equpcondlabels->ACTION] = $jodata->actions;
          

            if ($this->basemodel->insert_into_table($this->equpcondlabels->tbl_name, $labeldata))
            {
                $data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Equp Conditon Label  Added Successfully";
            }
            else
            {
                $data['qry'] = $this->db->last_query();
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable to Added Label";
            }
        }
        return $data;
    }

private function _update_hospitals($jodata=array())
{
	
    $data = array();
    if(!empty($jodata))
    {
        $where[$this->organizations->ORG_AID]=$jodata->ORG_AID;
        $features_list = $jodata->features;
        if(isset($jodata->features))
        {
            $total_menu=array();
            foreach($features_list as $ft){
                    $sub_menu = array();
                        foreach ($ft->subfeatures as $sf) {
							$sub_sub_menu = array();
							foreach ($sf->subsubfeatures as $ssf) {
									array_push($sub_sub_menu,array('ssmenu_id'=>$ssf->SSMENU_AID,'name'=>$ssf->name,"selected" => $ssf->selected));
							}
							array_push($sub_menu,array('smenu_id'=>$sf->SMENU_AID,'name'=>$sf->SMENU_TITLE,"state"=>$sf->SMENU_PATH,'activity'=>$sf->ACTIVITY,'APP'=>$sf->APP,'icon'=>ICON_PATH.$sf->ICON,"selected" => $sf->selected,"subsubfeatures" =>$sub_sub_menu));
                        }
                        array_push($total_menu,array('menu_id'=>$ft->MMENU_ID,'name'=>$ft->MMENU_TITLE,'state'=>$ft->MMENU_PATH,'APP'=>$ft->APP,'icon'=>$ft->MMENU_ICON,'ICON'=>ICON_PATH.$ft->ICON,"selected" => $ft->selected,'subfeatures'=>$sub_menu));

            }
        }
        $flist = json_encode(array('menu' => $total_menu));
        $today = date("Y-m-d H:i:s");
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $isdata[$this->organizations->ORG_ID] = $jodata->ORG_ID;
        $isdata[$this->organizations->ORG_NAME] = $jodata->org_name;
        $isdata[$this->organizations->STATUS] = $jodata->status;
		$isdata[$this->organizations->ORG_CODE] = $jodata->org_code;
		$isdata[$this->organizations->ORG_MODULE] = $jodata->org_module;//implode(",",$jodata->org_module);
        $isdata[$this->organizations->ORG_ADDRESS] = $jodata->org_address;
        $isdata[$this->organizations->NO_OF_BRANCHES] = $jodata->no_of_branches;
        $isdata[$this->organizations->NO_OF_USERS] = $jodata->no_of_users;
        $isdata[$this->organizations->NO_OF_EQUPIMENTS] = $jodata->no_of_equipments;
        $isdata[$this->organizations->CP_NAME] = $jodata->contact_person;
        $isdata[$this->organizations->CP_EMAIL] = $jodata->email_id;
		//$isdata[$this->organizations->EX_DATE] = $jodata->ex_date;
        $isdata[$this->organizations->CP_NUMBER] = $jodata->contact_no;
        $isdata[$this->organizations->COUNTRY] = $jodata->country;
        $isdata[$this->organizations->STATE] = $jodata->states;
        $isdata[$this->organizations->CITY] = $jodata->cities;
        $isdata[$this->organizations->FEATURES] = $flist;
        $isdata[$this->organizations->ACTUAL_FEARTURES_LIST] = json_encode($features_list);
        $isdata[$this->organizations->EX_DATE] = $jodata->ex_date;
        $isdata[$this->organizations->UPDATED_ON] = $today;
        $isdata[$this->organizations->UPDATED_BY] = $user_id;
        if(!empty($jodata->cp_details))
        {
            $cp_dtls['contact_persons'] = $jodata->cp_details;
            $isdata[$this->organizations->CP_DETAILS] = json_encode($cp_dtls);
        }
        else
        {
            $isdata[$this->organizations->CP_DETAILS] = NULL;
        }
		
        if($this->basemodel->update_operation($isdata, $this->organizations->tbl_name,$where))
        {
			
			
			$max_val = (int)$this->basemodel->select_max_val($this->users->tbl_name, $this->users->UID);
            $userr_id = $this->baselibrary->user_id_creation($max_val);
			$orgg_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $today = date('Y-m-d H:i:s');
            $iudata[$this->users->USER_ID] = HA . $userr_id;
            $iudata[$this->users->USER_NAME] = $jodata->contact_person;
            $iudata[$this->users->EMAIL_ID] = $jodata->email_id;
            $iudata[$this->users->MOBILE_NO] = $jodata->contact_no;
            $iudata[$this->users->EMP_NO] = $jodata->contact_no;
			
			$iudata[$this->users->ROLE_CODE] = HMADMIN;
		    $isdata[$this->users->ORG_MODULE] = $jodata->org_module; //implode(",",$jodata->org_module);
            $iudata[$this->users->ORG_ID] = $jodata->ORG_ID;
            $iudata[$this->users->PSWRD] = $this->bcrypt->hash_password(DFFPASS);
            $iudata[$this->users->STATUS] = ACTIVESTS;
            $iudata[$this->users->LEVEL] = "L1";
            $iudata[$this->users->START_DATE] = $today;
            $iudata[$this->users->ADDED_ON] = $today;
            $iudata[$this->users->END_DATE] = $enddate = date('9999-m-d H:i:s');
            $iudata[$this->users->ADDED_BY] = $this->session->user_id;
			$this->db->select($this->users->USER_NAME, FALSE);
            $this->db->from($this->db->dbprefix($this->users->tbl_name));
            $this->db->where($this->users->MOBILE_NO, $iudata[$this->users->MOBILE_NO]);
            $this->db->or_where($this->users->EMAIL_ID, $iudata[$this->users->EMAIL_ID]);
            $this->db->or_where($this->users->EMP_NO, $iudata[$this->users->EMP_NO]);
            $result = $this->db->get();
            $user_array = $result->result_array();
           
            if (empty($user_array))
			{
			if ($this->basemodel->insert_into_table($this->users->tbl_name, $iudata))
                {
					$data['response'] = SUCCESSDATA;
				$data['call_back'] = $isdata[$this->organizations->ORG_NAME]." Updated Successfully";
				
            }
			}
			else {
				$data['response'] = SUCCESSDATA;
            $data['call_back'] = $iudata[$this->users->USER_NAME]. " This User Name Already Exists But Organization Updated Successfully";
			}
		}
        else
        {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }
    }
           
    return $data;
}

private function _hospital_assign($jodata=array())
{
    $data = array();
    if(!empty($jodata))
    {
        $where[$this->organizations->ORG_AID]=$jodata->ORG_AID;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

        $isdata[$this->organizations->ORG_NAME] = $jodata->ORG_NAME;
        $isdata[$this->organizations->ORG_BRANCH] = ($jodata->org_branch != '') ? json_encode($jodata->org_branch) : '' ;
        $isdata[$this->organizations->UPDATED_ON] = date('Y-m-d');
        $isdata[$this->organizations->UPDATED_BY] = $user_id;

        if($this->basemodel->update_operation($isdata, $this->organizations->tbl_name,$where))
        {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = $isdata[$this->organizations->ORG_NAME]." Updated Successfully";
        }
        else
        {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }
    }
    return $data;
}


private function _get_orgtypes($jodata=array())
{
    $data=array();
    if(!empty($jodata))
    {
        $list=$this->basemodel->fetch_records_from($this->organizationtypes->tbl_name);

        if(!empty($list))
        {
            $data['response']=SUCCESSDATA;
            $data['list']=$list;
            // print_r( $data['list']);
        }
        else
        {
            $data['response']=EMPTYDATA;
        }
    }
    return $data;
    //print_r($data);
}

    private function _get_role_type_list($jodata=array())
    {
        $data=array();
        if(!empty($jodata))
        {
            $list=$this->basemodel->fetch_records_from($this->roletypes->tbl_name);

            if(!empty($list))
            {

                $data['response']=SUCCESSDATA;

                for($i=0;$i<count($list);$i++)
                {
                    $list[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name,$this->modules->MODULE_NAME,array($this->modules->MODULE_ID=>$list[$i]['MODULE_ID']));
                }

                $data['list']=$list;
                // print_r( $data['list']);
            }
            else
            {
                $data['response']=EMPTYDATA;
            }
        }
        return $data;
        //print_r($data);
    }

public function getvendors()
{
    $rawinput = $this->security->xss_clean($this->input->raw_input_stream);
    if($rawinput!="")
    {
        $data = array();
        $jdata = json_decode($rawinput);
        $action = $jdata->action;
        if($action="get_vendors")
        {
            $where = $data = array();
            $where[$this->organizations->ORG_TYPE] = VENDOR;
            $resp_data = $this->basemodel->fetch_records_from($this->organizations->tbl_name,$where);
            if(!empty($resp_data))
            {
                $data['response'] = SUCCESSDATA;
                $data['data'] = $resp_data;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
            echo json_encode($data);
        }
    }
}
private function _get_states_by_country_id($jodata=array())
{
    $data=array();

    $dw[$this->state->COUNTRY_CODE]=$jodata->countryid;
    $dw[$this->state->STATUS]=ACTIVESTS;
    $list =$this->basemodel->fetch_records_from($this->state->tbl_name,$dw);
	
    if(!empty($list))
    {
        $data['list'] = $list;
        $data['response'] = SUCCESSDATA;
    }
    else
        $data['response'] = EMPTYDATA;
    return $data;
}

/*private function _get_tables_by_module($jodata=array())
{
	$data = array();
	$dw[$this->table_names->ORG_MODULE] = $jodata->moduleid;
	$list =$this->basemodel->fetch_records_from($this->table_names->tbl_name,$dw);
	//return $this->db->last_query();
	if(!empty($list))
	{
		$data['list'] = $list;
		$data['response'] = SUCCESSDATA;
	}else
	{
		$data['response'] = EMPTYDATA;
	}
	return $data;
}*/

private function _get_org_forms($jodata=array())
{
	$data = array();
	$org_module = isset($jodata->org_module) ? $jodata->org_module : $this->session->org_module;
	$qry = "SELECT * FROM `hsp_tbl_item_master` WHERE ORG_MODULE = '".$org_module."'";
	
	$res = $this->basemodel->execute_qry($qry);

       $result_array = array();
       $option_array = array();
       $res_index = '';

       for($i = 0; $i < count($res); $i++)
       {
           for($j = 0; $j < $res[$i]['MAX_OPT']; $j++)
           {
               $opt = 'OPT'.($j+1);
               $res[$i]['OPT_ARR'][$j] = $res[$i][$opt];
           }
		   
		   if($res[$i]['MASTER_TABLE'] != '')
			   $res[$i]['masters'] = $this->_get_org_master_table1($res[$i]['MASTER_TABLE']);
		   else
			   $res[$i]['masters'] = '';
		   
           array_push($option_array,$res[$i]);
       }

       $result_array = $option_array;
	   
       if(!empty($result_array))
	   {
        $data["response"] = SUCCESSDATA;
        $data["list"] = $result_array;
	   }
	   else
	   {
		   $data["response"] = EMPTYDATA;
		   $data["list"]  = null;
	   }
      

       return $data;

     }
 
	private function _get_org_master_table($jodata=array())
	{
		$data = array();

     $org_module = isset($jodata->org_module) ? $jodata->org_module :  $this->session->org_module;
	 $db_field = $jodata->db_field;
	//return $db_field;
	 $item_master = $this->basemodel->get_single_column_value($this->item_master->tbl_name,$this->item_master->MASTER_TABLE,array($this->item_master->ORG_MODULE=>$org_module,$this->item_master->DB_FIELD=>$db_field));
    // return $item_master;	
	$master_table_name = $this->basemodel->get_single_column_value($this->master_table->tbl_name,$this->master_table->MASTER_TABLE_NAME,array($this->master_table->MASTER_ID=>$item_master));
	  //return $master_table_name;
	 
	 $qry_fld  = '';
	 if($master_table_name == 'hsp_tbl_m_user_deprts')
		$qry_fld  = 'CODE as code, USER_DEPT_NAME as name ';
	 else if($master_table_name == 'hsp_tbl_m_equp_types')
        $qry_fld  = 'CODE as code, TYPE as name ';
     else if($master_table_name == 'hsp_tbl_m_device_names')
        $qry_fld  = 'CODE as code, NAME as name ';	
     else if($master_table_name == 'hsp_tbl_m_contract_types')
        $qry_fld  = 'CFORM as code, CTYPE as name';		 
	 
	 $qry = "SELECT ".$qry_fld." FROM " .$master_table_name. " WHERE ORG_MODULE = '$org_module'";
	 //return $qry;
	 $res = $this->basemodel->execute_qry($qry);
	 
	
		 if(!empty($res))
    {
        $data['response'] = SUCCESSDATA;
		$data['list'] = $res;
		
	}
    else{
        $data['response'] = EMPTYDATA;
		$data['response'] = null;
	}
    return $data;
}
	
	private function _get_org_master_table1($masterid)
	{
	 $res = $this->basemodel->get_single_column_value($this->master_table->tbl_name,$this->master_table->MASTER_TABLE_NAME,array	
	($this->master_table->MASTER_ID=>$masterid));
	 
	 $org_module = $this->basemodel ->get_single_column_value($this->item_master->tbl_name,$this->item_master->ORG_MODULE,array($this->item_master->MASTER_TABLE=>$masterid));
	
	 $qry_fld  = '';
	 if($res == 'hsp_tbl_m_user_deprts')
		$qry_fld  = 'CODE as code, USER_DEPT_NAME as name ';
	 else if($res == 'hsp_tbl_m_equp_types')
        $qry_fld  = 'CODE as code, TYPE as name ';
     else if($res == 'hsp_tbl_m_device_names')
        $qry_fld  = 'CODE as code, NAME as name ';	
     else if($res == 'hsp_tbl_m_contract_types')
        $qry_fld  = 'CFORM as code, CTYPE as name';		 
	 
	 
	  $qry = "SELECT ".$qry_fld." FROM " .$res. " WHERE ORG_MODULE = '$org_module'";
	  return $this->basemodel->execute_qry($qry);
	  
	}
	
	 
private function _get_Branch_DetailsBy_HospitalID($jodata=array())
{
    $data=array();
    if(isset($jodata->org_id))
        $dw[$this->branches->ORG_ID]=$jodata->org_id;
    $list =$this->basemodel->fetch_records_from($this->branches->tbl_name,$dw);
    //return $this->db->last_query();
    if(!empty($list))
    {
        $data['list'] = $list;
        $data['response'] = SUCCESSDATA;
    }
    else
        $data['response'] = EMPTYDATA;
    return $data;
}
/*
     private function _get_branch_by_hospital_id($jodata=array())
     {

         $data=array();
         if(isset($jodata->org_list))
             $dw[$this->organizations->ORG_ID] = $jodata->org;
          //$wd =  implode(',',$dw[$this->organizations->ORG_ID]);
        //$qry = "SELECT * FROM hsp_tbl_organizations WHERE ORG_ID IN $wd";
        $this->db->select('BRANCH_ID,BRANCH_NAME');
        $this->db->from('hsp_tbl_branches');
        $this->db->where_in('ORG_ID',$dw[$this->organizations->ORG_ID]);
         $query=$this->db->get();
         $list =$query->result_array();
        // return $list;
         if(!empty($list))
         {
             $data['list'] =  $list;
             $data['response'] = SUCCESSDATA;
         }
         else
             $data['response'] = EMPTYDATA;

         return $data;
     }*/
private function _get_cities_by_state_id($jodata=array())
{

    $data=array();

        $dw[$this->cities->STATE_CODE]=$jodata->stateid;
	    $dw[$this->cities->COUNTRY_CODE] = $jodata->countryid;
		$dw[$this->cities->STATUS]=ACTIVESTS;;
    $list =$this->basemodel->fetch_records_from($this->cities->tbl_name,$dw);
    //return $this->db->last_query();
    if(!empty($list))
    {
        $data['list'] = $list;
        $data['response'] = SUCCESSDATA;
    }
    else
        $data['response'] = EMPTYDATA;
    return $data;
}

private function _get_futures_list($jodata=array())
{
    $data=array();
        $sub_data=array();
		$select = array($this->features->MMENU_ID,$this->features->MMENU_TITLE,$this->features->MMENU_PATH,$this->features->MMENU_ICON,$this->features->ICON,$this->features->APP,$this->features->STATUS);
        $list =$this->basemodel->fetch_records_from($this->features->tbl_name,array($this->features->STATUS=>ACTIVESTS),$select
            );
       // return $list;
	   if(!empty($list))
        {

            for($j = 0; $j < count($list); $j++ ){
                $list[$j]['selected'] = "false";
                $fw[$this->subfeatures->MMENU_ID]=$list[$j]['MMENU_ID'];
                $fw[$this->subfeatures->STATUS]= ACTIVESTS;
                $sub_data[$j]=$this->basemodel->fetch_records_from($this->subfeatures->tbl_name,$fw,
                    array($this->subfeatures->SMENU_AID,$this->subfeatures->MMENU_ID,$this->subfeatures->SMENU_TITLE,$this->subfeatures->SMENU_PATH,$this->subfeatures->APP,$this->subfeatures->ICON,$this->subfeatures->MENU_PROP,$this->subfeatures->ACTIVITY,$this->subfeatures->STATUS));

                for($k=0;$k<count($sub_data[$j]);$k++){
                    $sub_data[$j][$k]['selected'] = "false";
                    $subsub_data = array();
                    $subdata_array = explode(',',$sub_data[$j][$k]['MENU_PROP']);
					//return $sub_data[$j][$k]['MENU_PROP'];
                    for($m=0;$m<count($subdata_array);$m++){
                        $fetch_single = $this->basemodel->fetch_single_row($this->ssubfeatures->tbl_name,array($this->ssubfeatures->SSMENU_AID => $subdata_array[$m]));

                        if($fetch_single){
                            $subsub_data[$m]['SSMENU_AID'] = $fetch_single['SSMENU_AID'];
                            $subsub_data[$m]['name'] = $fetch_single['SSMENU_TITLE'];
                            $subsub_data[$m]['selected'] = "false";
                        }else{
                            $subsub_data ="";
                        }
                    }
                    $sub_data[$j][$k]['subsubfeatures'] = $subsub_data;
                }
                $list[$j]['subfeatures'] = $sub_data[$j];
            }
            $data['list'] = $list;
            $data['response'] = SUCCESSDATA;
        }
        else
            $data['response'] = EMPTYDATA;
        return $data;
}

private function _get_futures_list2($jodata=array())
{
    $data=array();
    $list =$this->basemodel->fetch_records_from($this->features->tbl_name,array($this->features->STATUS=>ACTIVESTS));
    if(!empty($list))
    {
        $data['list'] = $list;
        $data['response'] = SUCCESSDATA;
    }
    else
        $data['response'] = EMPTYDATA;
    return $data;
}

private function _get_subfetures_by_futures_id($jodata=array())
{
    $data=array();
    if(isset($jodata->futureid))
        $fw[$this->subfeatures->MMENU_ID]=$jodata->futureid;
    $list =$this->basemodel->fetch_records_from($this->subfeatures->tbl_name,$fw);
    if(!empty($list))
    {
        $data['list'] = $list;
        $data['response'] = SUCCESSDATA;
    }
    else
        $data['response'] = EMPTYDATA;
    return $data;
}
private function _get_subfetures($jodata=array())
{
    $data=array();
    $list =$this->basemodel->fetch_records_from($this->subfeatures->tbl_name);
    /*if(!empty($list))
    {
        $data['list'] = $list;
        $data['response'] = SUCCESSDATA;
    }*/
    if(!empty($list))
    {
        $i=0;
        foreach($list as $ls){
            $subfr = $ls['MENU_PROP'];
            if($subfr != '')
            {
                $subfr = explode($subfr,',');
                $list[$i]['subsubfeatures'] = $this->basemodel->execute_qry("SELECT `SSMENU_AID`,`SSMENU_TITLE` FROM `hsp_tbl_ssubfeatures` WHERE `SSMENU_AID` in (1,2,3,4)");
            }else{
                $list[$i]['subsubfeatures'] = "";
            }
            $i++;
        }


        $data['list'] = $list;
        $data['response'] = SUCCESSDATA;
    }
    else
        $data['response'] = EMPTYDATA;
    return $data;
}
private function _get_subsubfeatures($jodata=array())
{
    $data=array();
    $list =$this->basemodel->fetch_records_from($this->ssubfeatures->tbl_name);
    if(!empty($list))
    {
        $data['list'] = $list;
        $data['response'] = SUCCESSDATA;
    }
    else
        $data['response'] = EMPTYDATA;
    return $data;
}
private function _get_org_role_features($jodata=array())
{
    $data=$where=$swhere_like=$swhere=array();
    if(!empty($jodata))
    {
        $where[$this->features->STATUS]=ACTIVESTS;
        $list = $this->basemodel->fetch_records_from($this->features->tbl_name,$where,array($this->features->MMENU_ID,$this->features->MMENU_TITLE,$this->features->MMENU_PATH,$this->features->MMENU_ICON));
        if(!empty($list))
        {
            $data['response'] = SUCCESSDATA;
            for($i=0;$i<count($list);$i++)
            {
                $swhere[$this->subfeatures->MMENU_ID] =$list[$i][$this->features->MMENU_ID];
                $swhere_like[$this->subfeatures->USER_TYPE] =$jodata->role_code;
                $list[$i]['sub_features'] = $this->basemodel->fetch_records_with_like($this->subfeatures->tbl_name,$swhere,$swhere_like,array($this->subfeatures->SMENU_TITLE,$this->subfeatures->MMENU_ID,$this->subfeatures->SMENU_AID,$this->subfeatures->SMENU_PATH));
            }
            $data['list'] = $list;
        }
        else
            $data['response'] = EMPTYDATA;
    }
    return $data;
}
private function _get_branch_by_hospital_id($jodata=array())
{
    $data=$where=$swhere=array();
    if(!empty($jodata))
    {

        $where[$this->organizations->STATUS]=ACTIVESTS;
        //  $where[$this->organizations->ORG_ID] = $jodata->org_id;
        $list = $this->basemodel->fetch_records_from($this->organizations->tbl_name,$where,array($this->organizations->ORG_ID,$this->organizations->ORG_NAME));
        if(!empty($list))
        {
            $data['response'] = SUCCESSDATA;
            for($i=0;$i<count($list);$i++)
            {

                $swhere[$this->branches->ORG_ID] =$list[$i][$this->organizations->ORG_ID];
                //  $swhere_like[$this->branches->ORG_ID] =$jodata->org_id;
                $list[$i]['branches'] = $this->basemodel->fetch_records_from($this->branches->tbl_name,$swhere,array($this->branches->BRANCH_ID,$this->branches->BRANCH_NAME));

            }
            $data['list'] = $list;
        }
        else
            $data['response'] = EMPTYDATA;
    }
    // return $this->db->last_query();
    return $data;
}
private function _add_org_role($jodata=array())
{

    //return "deepthi";
	$data=array();
    if(!empty($jodata)){

        $features_list = $jodata->featuers;
		//return $jodata->featuers;
        /*$total_menu=array();
        foreach($features_list as $ft){
            if($ft->selected == "true") {
                $sub_menu = array();
                if(!empty($ft->subfeatures)){
                    foreach ($ft->subfeatures as $sf) {
                        if ($sf->selected == "true") {
                            $sub_sub_menu = array();
                            if(!empty($sf->subsubfeatures)) {
                                foreach ($sf->subsubfeatures as $ssf) {
                                    if ($ssf->selected == "true") {
                                        array_push($sub_sub_menu,array('name'=>$ssf->name));
                                    }
                                }
                                array_push($sub_menu,array('name'=>$sf->SMENU_TITLE,"state"=>$sf->SMENU_PATH,activity=>$sf->ACTIVITY,'APP'=>$sf->APP,icon=>ICON_PATH.$sf->ICON,"subsubfeatures" =>$sub_sub_menu));
                            }else{
                                array_push($sub_menu,array('name'=>$sf->SMENU_TITLE,"state"=>$sf->SMENU_PATH,activity=>$sf->ACTIVITY,'APP'=>$sf->APP,icon=>ICON_PATH.$sf->ICON,"subsubfeatures" =>null));
                            }
                        }
                    }
                    array_push($total_menu,array('name'=>$ft->MMENU_TITLE,'state'=>$ft->MMENU_PATH,'APP'=>$ft->APP,'icon'=>$ft->MMENU_ICON,'subfeatures'=>$sub_menu));
                }else{
                    $total_menu['subfeatures'] = null;
                }
            }
        }*/
        $flist = json_encode(array('menu' => $features_list));
        $today = date('Y-m-d H:i:s');
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $indata[$this->orgroles->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $indata[$this->orgroles->ROLE_CODE] = $jodata->role_code;
        $indata[$this->orgroles->EROLE_CODE] = $jodata->erole_code;
        $indata[$this->orgroles->ROLE_NAME] = $jodata->role_name;
        $indata[$this->orgroles->ESCALATION] = $jodata->level_name;
		$indata[$this->orgroles->ACTUAL_FEARTURES_LIST] = json_encode($features_list);

        /*indent request*/
        if(isset($jodata->indent_req) && $jodata->indent_req==YESSTATE)
        {
            $indata[$this->orgroles->INDENT_REQ] = $jodata->indent_req;
        }
        else
        {
            $indata[$this->orgroles->INDENT_REQ] = NOSTATE;
        }

        /*indent approve*/
        if(isset($jodata->indent_approve) && $jodata->indent_approve==YESSTATE)
        {
            $indata[$this->orgroles->INDENT_APRV] = $jodata->indent_approve;
        }
        else
        {
            $indata[$this->orgroles->INDENT_APRV] = NOSTATE;
        }

        /*cear request*/
        if(isset($jodata->cear_req) && $jodata->cear_req==YESSTATE)
        {
            $indata[$this->orgroles->CEAR_ADD] = $jodata->cear_req;
        }
        else
        {
            $indata[$this->orgroles->CEAR_ADD] = NOSTATE;
        }

        /*cear approve*/
        if(isset($jodata->cear_approve) && $jodata->cear_approve==YESSTATE)
        {
            $indata[$this->orgroles->CEAR_APRV] = $jodata->cear_approve;
        }
        else
        {
            $indata[$this->orgroles->CEAR_APRV] = NOSTATE;
        }

        /*purchase request*/
        if(isset($jodata->pur_req) && $jodata->pur_req==YESSTATE)
        {
            $indata[$this->orgroles->PUR_ADD] = $jodata->pur_req;
        }
        else
        {
            $indata[$this->orgroles->PUR_ADD] = NOSTATE;
        }

        /*purchase approve*/
        if(isset($jodata->pur_approve) && $jodata->pur_approve==YESSTATE)
        {
            $indata[$this->orgroles->PUR_APRV] = $jodata->pur_approve;
        }
        else
        {
            $indata[$this->orgroles->PUR_APRV] = NOSTATE;
        }

        /*purchase update*/
        if(isset($jodata->pur_status_update) && $jodata->pur_status_update==YESSTATE)
        {
            $indata[$this->orgroles->PUR_UPDATE] = $jodata->pur_status_update;
        }
        else
        {
            $indata[$this->orgroles->PUR_UPDATE] = NOSTATE;
        }

        /*purchase to stock adding*/
        if(isset($jodata->pur_stock_into_stock) && $jodata->pur_stock_into_stock==YESSTATE)
        {
            $indata[$this->orgroles->PUR_TO_STOCK] = $jodata->pur_stock_into_stock;
        }
        else
        {
            $indata[$this->orgroles->PUR_TO_STOCK] = NOSTATE;
        }

        /*add device*/
        if(isset($jodata->add_device) && $jodata->add_device==YESSTATE)
        {
            $indata[$this->orgroles->ADD_EQ] = $jodata->add_device;
        }
        else
        {
            $indata[$this->orgroles->ADD_EQ] = NOSTATE;
        }

        /*add device*/
        if(isset($jodata->add_device) && $jodata->add_device==YESSTATE)
        {
            $indata[$this->orgroles->ADD_EQ] = $jodata->add_device;
        }
        else
        {
            $indata[$this->orgroles->ADD_EQ] = NOSTATE;
        }

        /*update device*/
        if(isset($jodata->edit_device) && $jodata->edit_device==YESSTATE)
        {
            $indata[$this->orgroles->UPDATE_EQ] = $jodata->edit_device;
        }
        else
        {
            $indata[$this->orgroles->UPDATE_EQ] = NOSTATE;
        }

        /*edit gatepass*/
        if(isset($jodata->gate_pass_edit) && $jodata->gate_pass_edit==YESSTATE)
        {
            $indata[$this->orgroles->GP_UPDATE] = $jodata->gate_pass_edit;
        }
        else
        {
            $indata[$this->orgroles->GP_UPDATE] = NOSTATE;
        }

        /*transfer within unit*/
        if(isset($jodata->with_in_unit) && $jodata->with_in_unit==YESSTATE)
        {
            $indata[$this->orgroles->TRANSFER_WUNIT] = $jodata->with_in_unit;
        }
        else
        {
            $indata[$this->orgroles->TRANSFER_WUNIT] = NOSTATE;
        }

        /*transfer other unit*/
        if(isset($jodata->other_unit) && $jodata->other_unit==YESSTATE)
        {
            $indata[$this->orgroles->TRANSFER_OUNIT] = $jodata->other_unit;
        }
        else
        {
            $indata[$this->orgroles->TRANSFER_OUNIT] = NOSTATE;
        }

        /*condemnation request*/
        if(isset($jodata->condem_req) && $jodata->condem_req==YESSTATE)
        {
            $indata[$this->orgroles->CNDM_REQ] = $jodata->condem_req;
        }
        else
        {
            $indata[$this->orgroles->CNDM_REQ] = NOSTATE;
        }

        /*condemnation approve*/
        if(isset($jodata->condem_approve) && $jodata->condem_approve==YESSTATE)
        {
            $indata[$this->orgroles->CNDM_APRV] = $jodata->condem_approve;
        }
        else
        {
            $indata[$this->orgroles->CNDM_APRV] = NOSTATE;
        }

        /*condemnation close*/
        if(isset($jodata->condem_close) && $jodata->condem_close==YESSTATE)
        {
            $indata[$this->orgroles->CNDM_CLOSE] = $jodata->condem_close;
        }
        else
        {
            $indata[$this->orgroles->CNDM_CLOSE] = NOSTATE;
        }

        /*can print qr labels*/
        if(isset($jodata->qr_label) && $jodata->qr_label==YESSTATE)
        {
            $indata[$this->orgroles->PRINT_QR] = $jodata->qr_label;
        }
        else
        {
            $indata[$this->orgroles->PRINT_QR] = NOSTATE;
        }

        /*can print pms/cal labels*/
        if(isset($jodata->pms_cal_label) && $jodata->pms_cal_label==YESSTATE)
        {
            $indata[$this->orgroles->PRINT_PMSCAL] = $jodata->pms_cal_label;
        }
        else
        {
            $indata[$this->orgroles->PRINT_PMSCAL] = NOSTATE;
        }

        /*add contract*/
        if(isset($jodata->add_contract) && $jodata->add_contract==YESSTATE)
        {
            $indata[$this->orgroles->CNTRCT_ADD] = $jodata->add_contract;
        }
        else
        {
            $indata[$this->orgroles->CNTRCT_ADD] = NOSTATE;
        }

        /*renew contract*/
        if(isset($jodata->renew_contract) && $jodata->renew_contract==YESSTATE)
        {
            $indata[$this->orgroles->CNTRCT_RENEW] = $jodata->renew_contract;
        }
        else
        {
            $indata[$this->orgroles->CNTRCT_RENEW] = NOSTATE;
        }

        /*close contract*/
        if(isset($jodata->close_contract) && $jodata->close_contract==YESSTATE)
        {
            $indata[$this->orgroles->CNTRCT_CLOSE] = $jodata->close_contract;
        }
        else
        {
            $indata[$this->orgroles->CNTRCT_CLOSE] = NOSTATE;
        }

        /*add adverse incident*/
        if(isset($jodata->add_incident) && $jodata->add_incident==YESSTATE)
        {
            $indata[$this->orgroles->ADVRS_ADD] = $jodata->add_incident;
        }
        else
        {
            $indata[$this->orgroles->ADVRS_ADD] = NOSTATE;
        }

        /*approve adverse incident*/
        if(isset($jodata->approve_incident) && $jodata->approve_incident==YESSTATE)
        {
            $indata[$this->orgroles->ADVRS_APRV] = $jodata->approve_incident;
        }
        else
        {
            $indata[$this->orgroles->ADVRS_APRV] = NOSTATE;
        }

        /*close adverse incident*/
        if(isset($jodata->close_incident) && $jodata->close_incident==YESSTATE)
        {
            $indata[$this->orgroles->ADVRS_CLOSE] = $jodata->close_incident;
        }
        else
        {
            $indata[$this->orgroles->ADVRS_CLOSE] = NOSTATE;
        }

        /*add viability*/
        if(isset($jodata->viability_generate) && $jodata->viability_generate==YESSTATE)
        {
            $indata[$this->orgroles->VIABIL_ADD] = $jodata->viability_generate;
        }
        else
        {
            $indata[$this->orgroles->VIABIL_ADD] = NOSTATE;
        }

        /*approve viability*/
        if(isset($jodata->viability_approve) && $jodata->viability_approve==YESSTATE)
        {
            $indata[$this->orgroles->VIABIL_APRV] = $jodata->viability_approve;
        }
        else
        {
            $indata[$this->orgroles->VIABIL_APRV] = NOSTATE;
        }

        /* show non scheduled calls */
        if(isset($jodata->ns_show) && $jodata->ns_show==YESSTATE)
        {
            $indata[$this->orgroles->NS_SHOW] = $jodata->ns_show;
        }
        else
        {
            $indata[$this->orgroles->NS_SHOW] = NOSTATE;
        }

        /* show pms calls */
        if(isset($jodata->pms_show) && $jodata->pms_show==YESSTATE)
        {
            $indata[$this->orgroles->PMS_SHOW] = $jodata->pms_show;
        }
        else
        {
            $indata[$this->orgroles->PMS_SHOW] = NOSTATE;
        }

        /* show calibration calls */
        if(isset($jodata->calibration_show) && $jodata->calibration_show==YESSTATE)
        {
            $indata[$this->orgroles->CALIB_SHOW] = $jodata->calibration_show;
        }
        else
        {
            $indata[$this->orgroles->CALIB_SHOW] = NOSTATE;
        }

        /* create training */
        if(isset($jodata->training_create) && $jodata->training_create==YESSTATE)
        {
            $indata[$this->orgroles->TRING_ADD] = $jodata->training_create;
        }
        else
        {
            $indata[$this->orgroles->TRING_ADD] = NOSTATE;
        }

        /* create approve */
        if(isset($jodata->training_approve) && $jodata->training_approve==YESSTATE)
        {
            $indata[$this->orgroles->TRING_APRV] = $jodata->training_approve;
        }
        else
        {
            $indata[$this->orgroles->TRING_APRV] = NOSTATE;
        }

       // $org_role_path = $this->basemodel->get_single_column_value($this->roles->tbl_name,$this->roles->ROLE_PATH,array($this->roles->ROLE_CODE=>$indata[$this->orgroles->ROLE_CODE]));
        $indata[$this->orgroles->ROLE_PATH] = "home.hbhod_today_calls";
        $indata[$this->orgroles->ROLE_FEATURES]=$flist;
        $indata[$this->orgroles->ADDED_ON]=$today;
        $indata[$this->orgroles->ADDED_BY]=$user_id;
        if($this->basemodel->insert_into_table($this->orgroles->tbl_name,$indata))
        {
            $data['response']=SUCCESSDATA;
            $data['call_back']="Role added Successfully";
        }
        else
        {
            $data['response']=EMPTYDATA;
            $data['call_back']="Unable to Process Your Request";
        }
    }
    return $data;
}

private function _add_role_type($jodata=array())
{
    $data = array();
    if (!empty($jodata))
    {

        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $today = date('Y-m-d H:i:s');
        $roletype[$this->roletypes->MODULE_ID] = $jodata->module_id;
        $roletype[$this->roletypes->ROLE_TYPE] = $jodata->role_type;
        $roletype[$this->roletypes->ROLE_TYPE_NAME]   = $jodata->role_name;
       //$roletype[$this->roletypes->STATUS] = $jodata->status;
       // $roletype[$this->roletypes->ACTION] = $jodata->action;
        // $labeldata[$this->equpcondlabels->LENGTH] = $jodata->length;

        if ($this->basemodel->insert_into_table($this->roletypes->tbl_name, $roletype))
        {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Role Type  Added Successfully";
        }
        else
        {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable to Added Label";
        }
    }
    return $data;
}


    private function _add_status_label($jodata = array())
    {
        $data = array();

        $statuslabel[$this->statuslabels->ORG_MODULE] = $jodata->module_id;
		$statuslabel[$this->statuslabels->ORG_ID] = $jodata->org_id;
        $statuslabel[$this->statuslabels->STATUS] = $jodata->status_name;
        $statuslabel[$this->statuslabels->SCODE] = $jodata->code;
        $statuslabel[$this->statuslabels->STATUSS] = $jodata->status;
        $statuslabel[$this->statuslabels->ACTION] = $jodata->actions;
            
			
		

        if($this->basemodel->insert_into_table($this->statuslabels->tbl_name,$statuslabel)){
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Status Label Added Successfully";
        }
        else{
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }
            return $data;
    }




    private function _get_status_label($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
			 $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            // return $this->db->last_query();
            //  
            //  return $where;
			if($role_code!=HA_ADMIN)
			{
				$where[$this->statuslabels->ORG_MODULE] = $org_type;
				$halabelslist = $this->basemodel->fetch_records_from($this->statuslabels->tbl_name,$where);
			}else{
            $halabelslist = $this->basemodel->fetch_records_from($this->statuslabels->tbl_name);
            }//  return $this->db->last_query();
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
					 $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $halabelslist[$i]['ORG_ID']));
                    // return $this->db->last_query();
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }

    private function _update_status_label($jodata = array())

    {
        $data = array();
        //$statuslabel[$this->statuslabels->MODULE_ID] = $jodata->module_id;
        $statuslabel[$this->statuslabels->STATUS_NAME] = $jodata->status_name;
        $statuslabel[$this->statuslabels->STATUS_CODE] = $jodata->code;
        $statuslabel[$this->statuslabels->STATUS] = $jodata->status;
        $statuslabel[$this->statuslabels->ACTION] = $jodata->actions;

        $where[$this->statuslabels->STATUS_ID] = $jodata->STATUS_ID;


        if ($this->basemodel->update_operation($statuslabel, $this->statuslabels->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Status Type Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }

         return $data;
    }

    private function _update_depreciation_label($jodata = array())

    {
        $data = array();
        //$depreciationlabel[$this->depreciation_label->MODULE_ID] = $jodata->module_id;
        $depreciationlabel[$this->depreciation_label->NAME] = $jodata->name;
        $depreciationlabel[$this->depreciation_label->PERCENTAGE] = $jodata->percentage;
        $depreciationlabel[$this->depreciation_label->STATUS] = $jodata->status;
        $depreciationlabel[$this->depreciation_label->ACTION] = $jodata->actions;

        $where[$this->depreciation_label->DEPR_ID] = $jodata->DEPR_ID;


        if ($this->basemodel->update_operation($depreciationlabel, $this->depreciation_label->tbl_name, $where)) {
            $data['qry'] = $this->db->last_query();
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Depreciation Label Updated Successfully';
        } else {
            $data['qry'] = $this->db->last_query();
            $data['response'] = FAILEDATA;

        }

         return $data;
    }


    private function _get_depreciation_label($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
           $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
			if($role_code!=HA_ADMIN){
             $where[$this->depreciation_label->ORG_MODULE] = $org_type;
			 $halabelslist = $this->basemodel->fetch_records_from($this->depreciation_label->tbl_name,$where);
            }else{
            $halabelslist = $this->basemodel->fetch_records_from($this->depreciation_label->tbl_name);
            }
            if (!empty($halabelslist)) {

                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < (count($halabelslist)); $i++) {
                   $halabelslist[$i]['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $halabelslist[$i]['ORG_ID']));
                    $halabelslist[$i]['MODULE_ID'] = $this->basemodel->get_single_column_value($this->modules->tbl_name, $this->modules->MODULE_NAME, array($this->modules->MODULE_ID => $halabelslist[$i]['ORG_MODULE']));
                }
                //return $halabelslist;
                $data['list'] = $halabelslist;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;

    }


    private function _add_equp_type_label($jodata=array())
    {
        $data = array();
        if (!empty($jodata))
        {

            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $today = date('Y-m-d H:i:s');
            $equptypelabel[$this->equptypelabels->ORG_MODULE] = $jodata->module_id;
            $equptypelabel[$this->equptypelabels->TYPE] = $jodata->equp_type_name;
			$equptypelabel[$this->equptypelabels->ORG_ID] = $jodata->org_id;
            $equptypelabel[$this->equptypelabels->CODE]   = $jodata->code;
            $equptypelabel[$this->equptypelabels->STATUS] = $jodata->status;
            $equptypelabel[$this->equptypelabels->ACTION] = $jodata->actions;
            // $labeldata[$this->equpcondlabels->LENGTH] = $jodata->length;

            if ($this->basemodel->insert_into_table($this->equptypelabels->tbl_name, $equptypelabel))
            {
                $data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Equp Type Label  Added Successfully";
            }
            else
            {
                $data['qry'] = $this->db->last_query();
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable to Added Label";
            }
        }
        return $data;
    }

private function _get_appointment_list($jodata = array())
{
    //print_r($jodata);
    $data = $where=array();
    $where_date = '';
    if(!empty($jodata))
    {
        $data = array();
        if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            $where_date = $this->appointments->APT_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
        if(isset($jodata->limit_val))
        {
            if($jodata->limit_val!='')
                $limit_val = $jodata->limit_val;
            else
                $limit_val = 0;
            $cnt = $this->basemodel->fetch_records_from_multi_where($this->appointments->tbl_name,$where_date,'','count('.$this->appointments->ID.') AS CNT');
            if(!empty($cnt))
            {
                $data['no_of_recs'] = $cnt[0]['CNT'];
                $data['rcnt'] = ceil($cnt[0]['CNT']/10);
            }
            else
            {
                $data['no_of_recs'] = 0;
                $data['rcnt'] = 0;
            }
            //print_r($data);
            $resp_data = $this->basemodel->fetch_records_from_pagination($this->appointments->tbl_name,$where_date,'*',$this->appointments->APT_DATE,'DESC','10',$limit_val*10);
        }
        else
        {
            $resp_data = $this->basemodel->fetch_records_from($this->appointments->tbl_name,$where_date,'*',$this->appointments->APT_DATE,'DESC');
        }
        //$data['qry'] = $this->db->last_query();

        if(!empty($resp_data))
        {
            $data['response'] = SUCCESSDATA;
            for($i=0;$i<count($resp_data);$i++)
            {
                $resp_data[$i]['org_name'] = $this->basemodel->get_single_column_value($this->aptorganizations->tbl_name, $this->aptorganizations->ORG_NAME, array($this->aptorganizations->ORG_ID => $resp_data[$i][$this->appointments->ORG_NAME]));
                $resp_data[$i]['date_time'] = strtotime($resp_data[$i][$this->appointments->APT_DATE]." ".$resp_data[$i][$this->appointments->APT_TIME]);
                if($resp_data[$i]['PRVS_APT_DATES'] != NULL)
                    $resp_data[$i]['PRVS_APT_DATES'] = json_decode($resp_data[$i]['PRVS_APT_DATES']);
            }
            $data['list'] = $resp_data;
        }
        else
        {
            $data['response'] = EMPTYDATA;
        }
    }
    //print_r($data);
    return $data;
}
private function _add_appoinment_list($jodata=array())
{
    $data = array();
    if (!empty($jodata)){
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $today = date('Y-m-d H:i:s');
        $ibdata[$this->appointments->ORG_ID] =$jodata->apt_orgnizations;
        $ibdata[$this->appointments->APT_DATE] = date('Y-m-d',strtotime($jodata->apt_date));
        $ibdata[$this->appointments->APT_TIME] = date('H:m:s',strtotime($jodata->apt_time));
        $ibdata[$this->appointments->APT_CONTACT_TYPE] = $jodata->apt_contract_type;
        $ibdata[$this->appointments->CONTACT_PERSON] = $jodata->contract_person;
        $ibdata[$this->appointments->ORG_NAME] = $jodata->apt_orgnizations;
        $ibdata[$this->appointments->APT_PLACE] = $jodata->apt_place;
        $ibdata[$this->appointments->APT_STATUS] = $jodata->apt_status;
        $ibdata[$this->appointments->APT_FEEDBACKS] = $jodata->feedback;
        $ibdata[$this->appointments->ADDED_BY] = $user_id;
        $ibdata[$this->appointments->ADDED_ON] = $today;
        if (isset($jodata->lat))
            $ibdata[$this->appointments->LATITUDE] = $jodata->lat;
        if (isset($jodata->lag))
            $ibdata[$this->appointments->LOGITUDE] = $jodata->lag;
        if ($this->basemodel->insert_into_table($this->appointments->tbl_name, $ibdata))
        {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Appointment list Added Successfully";
        }
        else
        {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

    }
    return $data;
}
private function _update_appointment_list($jodata=array())
{
    $data = array();

    if (!empty($jodata)) {
        $where = $data = array();
        $where[$this->appointments->ID] = $jodata->ID;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $today = date('Y-m-d H:i:s');
        $date = date('H:i:s');
        $ibdata[$this->appointments->ORG_ID] = $jodata->ORG_ID;
        $ibdata[$this->appointments->APT_DATE] = date('Y-m-d',strtotime($jodata->apt_date));
        $ibdata[$this->appointments->APT_TIME] = date('H:m:s',strtotime($jodata->apt_time));
        $ibdata[$this->appointments->CONTACT_PERSON] = $jodata->contract_person;
        $ibdata[$this->appointments->ORG_NAME] = $jodata->apt_orgnizations;
        $ibdata[$this->appointments->ORG_NAME] = $jodata->apt_orgnizations;
        $ibdata[$this->appointments->APT_PLACE] = $jodata->apt_place;
        $ibdata[$this->appointments->APT_STATUS] = $jodata->apt_status;
        $ibdata[$this->appointments->APT_FEEDBACKS] = $jodata->feedback;
        $ibdata[$this->appointments->UPDATED_BY] = $user_id;
        $ibdata[$this->appointments->UPDATED_ON] = $today;
        if (isset($jodata->lat))
            $ibdata[$this->appointments->LATITUDE] = $jodata->lat;
        if (isset($jodata->lag))
            $ibdata[$this->appointments->LOGITUDE] = $jodata->lag;
        if(!empty($jodata->contract_person))
        {
            $cp_dtls['contact_persons'] = $jodata->contract_person;
            $isdata[$this->appointments->CONTACT_PERSON] = json_encode($cp_dtls);
        }
        else
        {
            $isdata[$this->appointments->CONTACT_PERSON] = NULL;
        }

        if ($this->basemodel->update_operation($ibdata,$this->appointments->tbl_name,$where)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Appointment list Updated Successfully";
        }
        else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

    }

    return $data;
}
private function _convert_appointment_list($jodata=array())
{
    $data = array();

    if (!empty($jodata)) {
        $where = $data = array();
        $where[$this->appointments->ID] = $jodata->ID;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $today = date('Y-m-d H:i:s');
        $date = date('H:i:s');
        $ibdata[$this->appointments->ORG_ID] = $jodata->ORG_ID;
        $ibdata[$this->appointments->APT_DATE] = date('Y-m-d',strtotime($jodata->apt_date));
        $ibdata[$this->appointments->APT_TIME] = date('H:m:s',strtotime($jodata->apt_time));
        $ibdata[$this->appointments->APT_CONTACT_TYPE] = $jodata->apt_contract_type;
        $ibdata[$this->appointments->ORG_NAME] = $jodata->apt_orgnizations;
        $ibdata[$this->appointments->APT_PLACE] = $jodata->apt_place;
        $ibdata[$this->appointments->APT_STATUS] = $jodata->apt_status;
        $ibdata[$this->appointments->APT_FEEDBACKS] = $jodata->feedback;
        $ibdata[$this->appointments->UPDATED_BY] = $user_id;
        $ibdata[$this->appointments->UPDATED_ON] = $today;
        $ibdata[$this->appointments->CONTACT_PERSON]=$jodata->contract_person;
        $ibdata[$this->appointments->PRVS_APT_DATES]=json_encode($jodata->history);
        if (isset($jodata->lat))
            $ibdata[$this->appointments->LATITUDE] = $jodata->lat;
        if (isset($jodata->lag))
            $ibdata[$this->appointments->LOGITUDE] = $jodata->lag;
        if ($this->basemodel->update_operation($ibdata,$this->appointments->tbl_name,$where)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Appointment list Convert Updated Successfully";
        }
        else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }

    }

    return $data;
}
private function _get_cp_apt_details($jodata = array())
{
    $data = $where = array();
    if(!empty($jodata))
    {
        $select=array($this->appointments->ORG_ID,$this->appointments->PRVS_APT_DATES);
        $where[$this->appointments->ORG_ID]=$jodata->org_id;
        $list=$this->basemodel->fetch_records_from($this->appointments->tbl_name,$where,$select);
        if(!empty($list))
        {
            $data['response']=SUCCESSDATA;
            for($i=0;$i<count($list);$i++)
            {
                $list[$i]['org_name'] = $this->basemodel->get_single_column_value($this->aptorganizations->tbl_name, $this->aptorganizations->ORG_NAME, array($this->aptorganizations->ORG_ID => $list[$i][$this->appointments->ORG_ID]));
            }
            $data['list']=$list;
        }
        else{
            $data['response'] = EMPTYDATA;
            $data['list'] = array();
        }

    }
    return $data;
}
public function save_base64_image($base64_image_string, $output_file_without_extension, $path_with_end_slash="")
{
    //usage:  if( substr( $img_src, 0, 5 ) === "data:" )
    /*{  $filename=save_base64_image($base64_image_string, $output_file_without_extentnion, getcwd() . "/application/assets/pins/$user_id/");
    }  */
    //
    //data is like:    data:image/png;base64,asdfasdfasdf
    $splited = explode(',', substr( $base64_image_string , 5 ) , 2);
    $mime=$splited[0];
    $data=$splited[1];

    $mime_split_without_base64=explode(';', $mime,2);
    $mime_split=explode('/', $mime_split_without_base64[0],2);
    if(count($mime_split)==2)
    {
        $extension=$mime_split[1];
        if($extension=='jpeg')$extension='jpg';
        //if($extension=='javascript')$extension='js';
        //if($extension=='text')$extension='txt';
        $output_file_with_extension=$output_file_without_extension.'.'.$extension;
    }
    file_put_contents($path_with_end_slash . $output_file_with_extension, base64_decode($data));
    return $output_file_with_extension;
}

public function _get_hosp_urls($jodata = array())
{

    $data = array();
    if(!empty($jodata))
    {

        $list=$this->basemodel->fetch_records_from($this->hospitals->tbl_name);

        if(!empty($list))
        {
            $data['response']=SUCCESSDATA;
            $data['list']=$list;
        }
        else{
            $data['response'] = EMPTYDATA;
            $data['list'] = array();
        }
    }
    return $data;
}

}

/* End of file Mainadmin.php */
/* Location: .//C/Users/Renown/AppData/Local/Temp/fz3temp-1/Mainadmin.php */
