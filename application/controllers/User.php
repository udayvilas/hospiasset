<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        //header('Content-Type: application/json');
        $this->load->library('baselibrary');
        $this->load->model('basemodel');
        $this->load->model('contactpersons');
        $this->load->model('devices');
        $this->load->model('qceqcats');
        $this->load->model('pmsdetails');
        $this->load->model('qcdetails');
        $this->load->model('calllogs');
        $this->load->model('equpstatus');
        $this->load->model('users');
        $this->load->model('rounds');
        $this->load->model('rounds_assigned');
        $this->load->model('roles');
        $this->load->model('orgroles');
        $this->load->model('cms');
        $this->load->model('userdeprts');
        $this->load->model('equprelocation');
        $this->load->model('equphistory');
        $this->load->model('contracttypes');
        $this->load->model('equptypes');
        $this->load->model('equpconditions');
        $this->load->model('baseauth');
        $this->load->model('tkn');
        $this->load->model('reasons');
        $this->load->model('branches');
        $this->load->model('priorities');
        $this->load->model('devicevendors');
        $this->load->model('status');
        $this->load->model('cities');
        $this->load->model('equpclass');
        $this->load->model('utillvalues');
        $this->load->model('accessories');
        $this->load->model('criticalspares');
        $this->load->model('trainingtypes');
        $this->load->model('vendortypes');
        $this->load->model('devicenames');
        $this->load->model('classifications');
        $this->load->model('userdeprts');
        $this->load->model('reasons');
        $this->load->model('levels');
        $this->load->model('escalations');
        $this->load->model('escalationsnew');
        $this->load->model('incedenttype');
        $this->load->model('incedents');
        $this->load->model('transfer');
        $this->load->model('condemnation');
        $this->load->model('condemnationrequest');
        $this->load->model('reusableparts');
        $this->load->model('indents');
        $this->load->model('cearcategory');
        $this->load->model('cear');
        $this->load->model('gatepass');
        $this->load->model('country');
        $this->load->model('state');
        $this->load->model('viability');
        $this->load->model('stock');
        $this->load->model('status');
        $this->load->model('scheduledcalls');
        $this->load->model('nonscheduledreasons');
        $this->load->model('organizations');
        $this->load->model('aptorganizations');
        $this->load->model('appointments');
        $this->load->model('contracttypelabels');
        $this->load->model('incidenttypelables');
        $this->load->model('modules');
        $this->load->model('depreciation');
        $this->load->model('departmentlabels');
        $this->load->model('statuslabels');
        $this->load->model('userlabels');
        $this->load->model('branchlabels');
        $this->load->model('rolelabels');
        $this->load->model('esclevellabels');
        $this->load->model('depreciation_label');
        $this->load->model('equpcondlabels');
        $this->load->model('location');
        $this->load->model('features');
        $this->load->model('subfeatures');
        $this->load->model('ssubfeatures');
        $this->load->model('vendor_label');
        $this->load->model('devicelabels');
        $this->load->model('table_names');
        $this->load->model('item_master');
        $this->load->model('biomedical');

    }

    public function index()
    {
        include_once APPPATH . 'libraries/HA_BKP/MainRest.php';
    }

    private function _key_rest($base_data = '', $content_type = '')
    {


        if (!is_null($base_data) && $content_type == $this->baseauth->appjson) {
            $data = array();
            $jodata = json_decode($base_data);
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            if (isset($user_id)) {
                $uwher[$this->users->USER_ID] = $user_id;
                $branch = '';
                $branchs = $this->basemodel->fetch_single_row($this->users->tbl_name, $uwher, $this->users->ORG_BRANCH_ID);
                if($branchs[$this->users->ORG_BRANCH_ID] !=null)
                {
                    $branchs = explode(',', $branchs[$this->users->ORG_BRANCH_ID]);
                    $branch = array();
                    foreach ($branchs as $x)
                        array_push($branch, "'" . $x . "'");
                    $branch = '(' . implode($branch, ',') . ')';
                }
                else
                {
                    $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                    $branchs = $this->basemodel->fetch_records_from($this->branches->tbl_name,array($this->branches->STATUS=>ACTIVESTS,$this->branches->ORG_ID=>$org_id),$this->branches->BRANCH_ID);
                    for($i = 0; $i < count($branchs); $i++)
                        $branch[$i] = "'".$branchs[$i]['BRANCH_ID']."'";
                    $branch = '(' . implode($branch, ',') . ')';
                }
            }
            defined('BRANCHALL') OR define('BRANCHALL', $branch);



            $action = $jodata->action;
            if ($action == 'get_roles')
                $data = $this->_get_roles($jodata);
            else if ($action == 'get_org_roles')
                $data = $this->_get_org_roles($jodata);
            else if ($action == 'get_branches' || $action == 'get_branches_call' || $action == 'get_all_branches')
                $data = $this->_get_branches($jodata);
            else if ($action == 'get_branch_users')
                $data = $this->_get_branch_users($jodata);
            else if ($action == 'add_new_user')
                $data = $this->_add_new_user($jodata);
            else if($action == 'add_new_havendor')
                $data = $this->_add_new_havendor($jodata);
            else if($action == 'load_havendor_list')
                $data = $this->_load_havendor_list($jodata);
            else if ($action == 'get_user_features_list')
                $data = $this->_get_user_features_list($jodata);
            else if ($action == 'add_new_branch')
                $data = $this->_add_new_branch($jodata);
            else if ($action == 'get_branches_details')
                $data = $this->_get_branches_details($jodata);
            else if($action == 'get_all_branch_list')
                $data = $this->_get_all_branch_list($jodata);
            else if ($action == 'update_user')
                $data = $this->_update_user($jodata);
            else if ($action =='get_user_branches')
                $data = $this->_get_user_branches($jodata);
            else if ($action == 'add_new_vendor')
                $data = $this->_add_new_vendor($jodata);
            else if ($action == 'get_vendorcp_user_dtls')
                $data = $this->_get_vendorcp_user_dtls($jodata);
            else if ($action == 'get_vendorcp_exists')
                $data = $this->_get_vendorcp_exists($jodata);
            else if ($action == 'get_vendor_list')
                $data = $this->_get_vendor_list($jodata);
            else if ($action == 'update_vendor')
                $data = $this->_update_vendor($jodata);
            else if ($action == 'update_branch')
                $data = $this->_update_branch($jodata);
            else if($action=='get_scheduled_calls')
                $data = $this->_get_scheduled_calls($jodata);
            else if ($action == 'get_my_details')
                $data = $this->_get_my_details($jodata);
            else if ($action == 'update_city')
                $data = $this->_update_city($jodata);
            else if ($action == 'update_country')
                $data = $this->_update_country($jodata);
            else if ($action == 'update_state')
                $data = $this->_update_state($jodata);
            else if ($action == 'add_new_city')
                $data = $this->_add_new_city($jodata);
            else if ($action == 'get_city_list')
                $data = $this->_get_city_list($jodata);
            else if ($action == "get_contract_type_list")
                $data = $this->_get_contract_type_list($jodata);
            else if ($action == "add_contract_type")
                $data = $this->_add_contract_type($jodata);
            else if ($action == "update_contract_type")
                $data = $this->_update_contract_type($jodata);
            else if ($action == "get_status_list")
                $data = $this->_get_status_list($jodata);
            else if ($action == "add_status")
                $data = $this->_add_status($jodata);
            else if ($action == "update_staus")
                $data = $this->_update_staus($jodata);
            else if ($action == "get_equp_cond")
                $data = $this->_get_equp_cond($jodata);
            else if ($action == "add_equp_condition")
                $data = $this->_add_equp_condition($jodata);
            else if ($action == "update_equp_cond")
                $data = $this->_update_equp_cond($jodata);
            else if ($action == "get_equip_class")
                $data = $this->_get_equip_class($jodata);
            else if ($action == "add_equp_class")
                $data = $this->_add_equp_class($jodata);
            else if ($action == "update_equp_class")
                $data = $this->_update_equp_class($jodata);
            else if ($action == "get_utilization_list")
                $data = $this->_get_utilization_list($jodata);
            else if ($action == "add_utill_value")
                $data = $this->_add_utill_value($jodata);
            else if ($action == "update_utill_values")
                $data = $this->_update_utill_values($jodata);
            else if ($action == "get_training_type_list")
                $data = $this->_get_training_type_list($jodata);
            else if ($action == "add_training_type")
                $data = $this->_add_training_type($jodata);
            else if ($action == "update_training_type")
                $data = $this->_update_training_type($jodata);
            else if ($action == "get_accessories")
                $data = $this->_get_accessories($jodata);
            else if ($action == "add_accessor")
                $data = $this->_add_accessor($jodata);
            else if ($action == "update_accessor")
                $data = $this->_update_accessor($jodata);
            else if ($action == "get_critical_spares")
                $data = $this->_get_critical_spares($jodata);
            else if ($action == "add_critical_spare")
                $data = $this->_add_critical_spare($jodata);
            else if ($action == "update_critical_spare")
                $data = $this->_update_critical_spare($jodata);
            else if ($action == "get_vendor_types")
                $data = $this->_get_vendor_types($jodata);
            else if ($action == "get_equp_cats")
                $data = $this->_get_equp_cats($jodata);
            else if ($action == "get_oems" || $action == "get_distrbts" || $action == "get_vsupport")
                $data = $this->_get_oem_dis_sup($jodata);
            else if ($action == "add_classification")
                $data = $this->_add_classification($jodata);
            else if ($action == "update_classification")
                $data = $this->_update_classification($jodata);
            else if ($action == "add_equp_type")
                $data = $this->_add_equp_type($jodata);
            else if ($action == "update_eq_type")
                $data = $this->_update_eq_type($jodata);
            else if ($action == "get_depts_list")
                $data = $this->_get_depts_list($jodata);
            else if ($action == "add_departments")
                $data = $this->_add_departments($jodata);
            else if ($action == "update_department")
                $data = $this->_update_department($jodata);
            else if ($action == "get_reasons_list")
                $data = $this->_get_reasons_list($jodata);
            else if ($action == "add_reasons")
                $data = $this->_add_reasons($jodata);
            else if($action=='add_non_scheduled')
                $data = $this->_add_non_scheduled($jodata);
            else if ($action == "update_reasons")
                $data = $this->_update_reasons($jodata);
            else if($action == "update_non_reasons")
                $data = $this->_update_non_reasons($jodata);
            else if ($action == "get_levels_list")
                $data = $this->_get_levels_list($jodata);
            else if ($action == "add_levels")
                $data = $this->_add_levels($jodata);
            else if ($action == "update_levels")
                $data = $this->_update_levels($jodata);
            else if ($action == "get_Escalation_list")
                $data = $this->_get_Escalation_list($jodata);
            else if ($action == "get_nonscheduled_reasons_list")
                $data = $this->_get_nonscheduled_reasons_list($jodata);
            else if ($action == "add_escalation")
                $data = $this->_add_escalation($jodata);
            else if ($action == "update_escalation")
                $data = $this->_update_escalation($jodata);
            else if ($action == "get_Escalations_list")
                $data = $this->_get_Escalations_list($jodata);
            else if ($action == "add_escalations1")
                $data = $this->_add_escalations1($jodata);
            else if ($action == "update_escalations1")
                $data = $this->_update_escalations1($jodata);
            else if ($action == "get_incident_type_list")
                $data = $this->_get_incident_type_list($jodata);
            else if ($action == "add_incident_type")
                $data = $this->_add_incident_type($jodata);
            else if ($action == "update_incident_type")
                $data = $this->_update_incident_type($jodata);
            else if ($action == "add_incidents")
                $data = $this->_add_incidents($jodata);
            else if ($action == "update_observations")
                $data = $this->_update_observations($jodata);
            else if ($action == "update_observations_approve")
                $data = $this->_update_observations_approve($jodata);
            else if ($action == "observation_assign")
                $data = $this->_observation_assign($jodata);
            else if ($action == "update_adverse_incedets")
                $data = $this->_update_adverse_incedets($jodata);
            else if ($action == "get_contract_vendor_details")
                $data = $this->_get_contract_vendor_details($jodata);
            else if ($action == "other_unit_request")
                $data = $this->_other_unit_request($jodata);
            else if ($action == "transfer_with_in_unit")
                $data = $this->_transfer_with_in_unit($jodata);
            else if ($action == "get_transfer_Approval_list")
                $data = $this->_get_transfer_Approval_list($jodata);
            else if ($action == "update_otherunit_approval_list")
                $data = $this->_update_otherunit_approval_list($jodata);
            else if ($action == "get_otherunit_tansfer_list")
                $data = $this->_get_otherunit_tansfer_list($jodata);
            else if ($action == "get_otherunit_unit_transfer_calls")
                $data = $this->_get_otherunit_unit_transfer_calls($jodata);
            else if ($action == "update_otherunit_trnsfer_list")
                $data = $this->_update_otherunit_trnsfer_list($jodata);
            else if ($action == "get_tansfer_list")
                $data = $this->_get_tansfer_list($jodata);
            else if ($action == "all_completed_transfers_search")
                $data = $this->_all_completed_transfers_search($jodata);
            else if ($action == "update_otherunit_disapproval_list")
                $data = $this->_update_otherunit_disapproval_list($jodata);
            else if ($action == "update_transfer_within_requ_list")
                $data = $this->_update_transfer_within_requ_list($jodata);
            else if ($action == "update_transfer_other_requ_list")
                $data = $this->_update_transfer_other_requ_list($jodata);
            else if ($action == "get_conreasons_list")
                $data = $this->_get_conreasons_list($jodata);
            else if ($action == "get_completed_condemnations_search")
                $data = $this->_get_completed_condemnations_search($jodata);
            else if ($action == "add_condemnation_reasons")
                $data = $this->_add_condemnation_reasons($jodata);
            else if ($action == "update_cond_reasons")
                $data = $this->_update_cond_reasons($jodata);
            else if ($action == "get_conrequest_list")
                $data = $this->_get_conrequest_list($jodata);
            else if ($action == "add_condemnation_requests")
                $data = $this->_add_condemnation_requests($jodata);
            else if ($action == "update_cond_approval_list")
                $data = $this->_update_cond_approval_list($jodata);
            else if ($action == "update_cond_disapproval_list")
                $data = $this->_update_cond_disapproval_list($jodata);
            else if ($action == "update_approved_condemnation_list")
                $data = $this->_update_approved_condemnation_list($jodata);
            else if ($action == "update_condemnation_request_list")
                $data = $this->_update_condemnation_request_list($jodata);
            else if ($action == "get_reusableparts_list")
                $data = $this->_get_reusableparts_list($jodata);
            else if ($action == "add_reusablepart_requests")
                $data = $this->_add_reusablepart_requests($jodata);
            else if ($action == "update_reusableparts_list")
                $data = $this->_update_reusableparts_list($jodata);
            else if ($action == "add_indent_equipment")
                $data = $this->_add_indent_equipment($jodata);
            else if ($action == "get_indent_equpiment_list")
                $data = $this->_get_indent_equpiment_list($jodata);
            else if ($action == "update_indent_equp")
                $data = $this->_update_indent_equp($jodata);
            else if ($action == 'get_cear_list')
                $data = $this->_get_cear_list($jodata);
            else if ($action == 'get_cear_category_list')
                $data = $this->_get_cear_category_list($jodata);
            else if ($action == 'add_cear_category_list')
                $data = $this->_add_cear_category_list($jodata);
            else if ($action == 'update_cear_category_list')
                $data = $this->_update_cear_category_list($jodata);
            else if ($action == 'update_indent_approved_list')
                $data = $this->_update_indent_approved_list($jodata);
            else if ($action == 'update_indent_disapproved_list')
                $data = $this->_update_indent_disapproved_list($jodata);
            else if ($action == 'update_indent_dissanctioned_list')
                $data = $this->_update_indent_dissanctioned_list($jodata);
            else if ($action == 'get_gate_pass_list')
                $data = $this->_get_gate_pass_list($jodata);
            else if ($action == 'add_gate_pass_list')
                $data = $this->_add_gate_pass_list($jodata);
            else if ($action == 'add_gate_pass_list_one')
                $data = $this->_add_gate_pass_list_one($jodata);
            else if ($action == 'update_gate_pass')
                $data = $this->_update_gate_pass($jodata);
            else if ($action == 'get_country_list')
                $data = $this->_get_country_list($jodata);
            else if ($action == 'get_states_list')
                $data = $this->_get_states_list($jodata);
            else if ($action == 'add_viability')
                $data = $this->_add_viability($jodata);
            else if ($action == 'get_viability_list')
                $data = $this->_get_viability_list($jodata);
            else if ($action == 'get_stock_list')
                $data = $this->_get_stock_list($jodata);
            else if ($action == 'update_viability')
                $data = $this->_update_viability($jodata);
            else if ($action == 'get_indent_stock_counts')
                $data = $this->_get_indent_stock_counts($jodata);
            else if ($action == 'get_org_roles')
                $data = $this->_get_org_roles($jodata);
            else if ($action == 'get_con_new_request_list')
                $data = $this->_get_con_new_request_list($jodata);
            else if ($action == 'get_gate_pass_new_list')
                $data = $this->_get_gate_pass_new_list($jodata);
            else if ($action == 'get_viability_new_list')
                $data = $this->_get_viability_new_list($jodata);
            else if ($action == 'get_tansfer_new_list')
                $data = $this->_get_tansfer_new_list($jodata);
            else if ($action == 'get_cear_new_list')
                $data = $this->_get_cear_new_list($jodata);
            else if ($action == 'get_indent_new_list')
                $data = $this->_get_indent_new_list($jodata);
            else if ($action == 'get_org_data')
                $data = $this->_get_org_data($jodata);
            else if ($action == 'get_apt_org_cps')
                $data = $this->_get_apt_org_cps($jodata);
            else if ($action == 'update_cear_approve')
                $data = $this->_update_cear_approve($jodata);
            else if ($action == 'get_org_branch_cnt')
                $data = $this->_get_org_branch_cnt($jodata);
            else if ($action == 'get_org_users_cnt')
                $data = $this->_get_org_users_cnt($jodata);
            else if ($action == 'get_all_branchs')
                $data = $this->_get_all_branchs($jodata);
            else if($action=="add_country")
                $data = $this->_add_country($jodata);
            else if($action=="add_state")
                $data = $this->_add_state($jodata);
            else if($action=="vendor_home_page")
                $data = $this->_vendor_home_page($jodata);
            else if($action=="get_user_units")
                $data = $this->_get_user_units($jodata);
            else if($action=="get_vendor_details")
                $data = $this->_get_vendor_details($jodata);
            else if($action=="get_equipments")
                $data = $this->_get_equipments($jodata);
            else if($action=="get_single_device_data")
                $data = $this->_getsingle_device_data($jodata);
            else if($action=="get_scheduled_year_days")
                $data = $this->_get_scheduled_year_days($jodata);
            else if($action=="transfer_equipments")
                $data = $this->_transfer_equipments($jodata);
            else if($action == "vendor_add_gate_pass_list")
                $data = $this->_vendor_add_gate_pass_list($jodata);
            else if($action == "get_user_details")
                $data = $this->_get_user_details($jodata);
            else if($action == "pmsself_respond_call")
                $data = $this->_pmsself_respond_call($jodata);
            else if($action == "qcself_respond_call")
                $data = $this->_qcself_respond_call($jodata);
            else if($action == "get_organisations")
                $data = $this->_get_organisations($jodata);
            else if($action=="get_gatepass_details")
                $data = $this->_get_gatepass_details($jodata);
            else if($action=="add_new_module")
                $data = $this->_add_new_module($jodata);
            else if($action=="load_hamodule_list")
                $data = $this->_load_hamodule_list($jodata);
            else if($action=="add_depreciation")
                $data = $this->_add_depreciation($jodata);
            else if ($action == 'get_depreciation_list')
                $data = $this->_get_depreciation_list($jodata);
            else if($action == "get_equp_details")
                $data = $this->_get_equp_details($jodata);
            else if ($action == 'update_depreciation')
                $data = $this->_update_depreciation($jodata);
            else if ($action == 'get_location_list')
                $data = $this->_get_location_list($jodata);
            else if($action=="add_location")
                $data = $this->_add_location($jodata);
            else if ($action == 'update_location')
                $data = $this->_update_location($jodata);
            else if($action=='get_item_master')
                $data = $this->_get_item_master($jodata);
            else if($action == "get_equp_details_by_serial")
                $data = $this->_get_equp_details_by_serial($jodata);
            else if($action == "save_module_table")
                $data = $this->_save_module_table($jodata);
            else if($action == "module_base_table_data")
                $data = $this->_module_base_table_data($jodata);
            else if($action == "get_devices_org")
                $data = $this->_get_devices_org($jodata);



            print_r(json_encode($data));
        }
    }

    private function _update_location($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            //$check = $this->basemodel->get_single_column_value($this->depreciation->tbl_name,$this->depreciation->NAME,array($this->depreciation->NAME=>$jodata->name));
            //if(!empty($check)) {

            $where[$this->location->ID] = $jodata->id;
            $ivdata[$this->location->Location] = $jodata->location_name;
            $ivdata[$this->location->STATUS] = $jodata->status;
            if ($this->basemodel->update_operation($ivdata, $this->location->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Location Updated Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable To Process Your Request..!";
            }
            /*    }
            }else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable To Process Your Request..!";
            }*/
        }
        return $data;
    }



    private function _module_base_table_data($jodata=array())
    {

        /*$data = array();
        $res = array();
        $table_list  =  $this->basemodel->fetch_records_from($this->table_names->tbl_name);

        for($i =0;$i<count($table_list);$i++)
        {
            $module_tables[$i]['table']  = "SELECT * FROM " .$table_list[$i]['TABLE_NAME'];

            $result  = $this->basemodel->execute_qry($module_tables[$i]['table']);
            //return $result;
            array_push($res,$result);
            //return $res;
        }

        //return $res;
        if(!empty($res))
        {

            $data['response'] = SUCCESSDATA;
            $data['list'] = $res;
        }
        else
        {
            $data['response'] = EMPTYDATA;
            $data['list'] = null;
        }
        return $data;*/

        $data = array();

        $module_id  =   $jodata->moduleid;

        $qry  = "SELECT * FROM " .$module_id;
        //  return $qry;
        $result  = $this->basemodel->execute_qry($qry);

        if(!empty($result))
        {

            $data['response'] = SUCCESSDATA;
            $data['list'] = $result;
        }
        else
        {
            $data['response'] = EMPTYDATA;
            $data['list'] = null;
        }
        return $data;
    }

    private function _get_devices_org($jodata=array())
    {
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $org_module = isset($jodata->org_module) ? $jodata->org_module : $this->session->org_module;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $qry = $this->basemodel->get_single_column_value($this->modules->tbl_name,$this->modules->MODULE_TABLE,array($this->modules->MODULE_ID=>$org_module));
        $qry1  = "SELECT * FROM $qry";
        $qry_res = $this->basemodel->execute_qry($qry1);
        if(!empty($qry_res))
        {
            $data['response'] = SUCCESSDATA;

            for($dc=0; $dc<count($qry_res);$dc++)
            {
                $qry_res[$dc]['NMAE']= $this->basemodel->get_single_column_value($this->devicevendors->tbl_name,$this->devicevendors->NAME,array($this->devicevendors->ID=>$qry_res[$dc]['EQ_NAME']));
                //return $this->db->last_query();
            }
            $qry_res[$dc]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_NAME,array($this->branches->BRANCH_ID=>$qry_res[$dc]['BRANCH_ID']));
            $qry_res[$dc]['category'] = $this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->NAME,array($this->devicenames->ID=>$qry_res[$dc][$this->devices->E_CAT]));
            $qry_res[$dc]['vendor'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID=>$qry_res[$dc]['VENDOR']));
            $qry_res[$dc]['DISTRIBUTION'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $qry_res[$dc]['DISTRIBUTER']));
            $qry_res[$dc]['eq_condition'] = $this->basemodel->get_single_column_value($this->equpconditions->tbl_name, $this->equpconditions->ECODE, array($this->equpconditions->EVAL => $qry_res[$dc]['E_COND']));
            $qry_res[$dc]['equp_type'] = $this->basemodel->get_single_column_value($this->equptypes->tbl_name, $this->equptypes->TYPE, array($this->equptypes->CODE =>  $qry_res[$dc]['E_TYPE']));
            $qry_res[$dc]['eq_util'] = $this->basemodel->get_single_column_value($this->utillvalues->tbl_name, $this->utillvalues->NAME, array($this->utillvalues->VALUE => $qry_res[$dc]['UTILIZATION']));

            // return $qry_res;
            /* for($dc = 0 ; $dc<count($qry_res); $dc++)
             {


                 // return
                 $qry_res[$dc]['docs'] = $this->baselibrary->read_files($qry_res[$dc]['EQ_NAME']);
                 //return $this->db->last_query;
             }*/
        }
        else
        {
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

    private function _save_module_table($jodata=array())
    {

        $data = array();
        $data1 = $jodata->value;
        return $data1;
 

        $org_id = isset($jodata->org_id) ?  $jodata->org_id : $this->session->org_id;
        $added_by = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

        $org_module  = isset($jodata->org_module) ? $jodata->org_module : $this->session->org_module;
        $qry = $this->basemodel->get_single_column_value($this->modules->tbl_name,$this->modules->MODULE_TABLE,array($this->modules->MODULE_ID=>$org_module));
          
          //$res = $this->basemodel->insert_into_table_without_prefix($qry,$data1);
		  
        if($qry == 'hsp_tbl_biomedical')
        {
               $data1 = $jodata->value;
			   return $data1;
            /*  $data = array(
			  
       'BRANCH_ID' => $data1->BRANCH_ID,
       'EQ_NAME' => $data1->EQ_NAME,
       'ES_NUMBER' => $data1->ES_NUMBER,
       'REMARKS' => $data1->REMARKS,
       'PHY_LOC'=> $data1->PHY_LOC,
	   'DATE_OF_INSTALL'=>$data1->DATE_OF_INSTALL,
	   'AMC_TYPE' => $data1->AMC_TYPE;
	   'C_NAME' => $data1->C_NAME,
        );*/
           //$res =  $this->db->insert('hsp_tbl_biomedical',$data1);
		   
		   
               /*  $branch_id =>  $data1->BRANCH_ID;
			    $eq_name => $data1->EQ_NAME;
			   $es_number = $data1->ES_NUMBER;
			   $remarks   = $data1->REMARKS;
			   $location  = $data1->PHY_LOC;
			   $amc_type  = $data->AMC_TYPE;
			   $company_name  = $data1->C_NAME;
			   $desc_p    = $data1->DESC_P;
			   $date_of_install = $data1->DATE_OF_INSTALL;
			   $distributer = $data1->DISTRIBUTER;
			   $cost    = $data1->E_COST;
			   $cform   = $data1->C_FROM;
			   $cto     = $data1->C_TO;
			   $endoflife  = $data1->END_OF_LIFE;
			   $endofsupport = $data1->END_OF_SUPPORT;
			   $eq_model = $data1->EQ_MODEL;
			   $equp_type  = $data1->EQUP_TYPE;
			   $dept_id  = $data1->DEPT_ID;
			   $pdue     = $data1->PDUE;*/


			  /*$qry_biomedical = "INSERT INTO `hsp_tbl_biomedical`(`ORG_ID`,`EQ_NAME`,`BRANCH_ID`,`ES_NUMBER`,`DATE_OF_INSTALL`,`END_OF_LIFE`,`END_OF_SUPPORT`,`EQ_MODEL`,`EQUP_TYPE`) values('$org_id','$eq_name','$branch_id','$es_number','$date_of_install','$endoflife','$endofsupport','$eq_model','')";
			  $res = $this->basemodel->executeqry($qry_biomedical);*/
		   }
        else if($qry == 'hsp_tbl_it')
        {
             
        }
        else if($qry == 'hsp_tbl_general')
        {

        }
        else{
            return "No Query Received";
        }

        /*$res = $this->basemodel->insert_into_table_without_prefix($qry,$data1);*/

        if($res)
        {
            $data['response'] = SUCCESSDATA;
            $data['qry'] = $this->db->last_query();
            $data['call_back'] = "added moduleinfo successfully";
        }
        else
        {
            $data['response'] = EMPTYDATA;
            $data['qry']  = $this->db->last_query();
            $data['call_back'] = "unable to added moduleinfo";
        }
        return $data;

    }


    //$res =  "'INSERT INTO'  .'$qry'. () VALUES()";
    //return $this->db->last_query();

    // $this->basemodel->insert_into_table($this->->tbl_name, $insert);
    /*  for($i=0;$i<count($qry);$i++)
      {
          $qry_result[$i]['tables'] = $qry[$i]['TABLE_NAME'];
          $this->basemodel->
      }*/

    /*$key = '107';

    $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

    $key = '119';
    $branch_id = isset($data1->$key) ? $data1->$key : $this->session->branch_id;

    $insert[$this->devices->ORG_ID]  = $org_id;

    $key = '119';
    $insert[$this->devices->BRANCH_ID] =  $branch_id;
    $key='107';
    $insert[$this->devices->E_NAME] = isset($data1->$key) ? $data1->$key : '';
     $key = '108';
    $insert[$this->devices->E_MODEL] = isset($data1->$key) ? $data1->$key : '';
    $key = '120';
   /* $insert[$this->devices->E_COND] = isset($data1->$key) ? $data1->$key : '' ;
    $key = '123';
    $insert[$this->devices->DATEOF_INSTALL] = isset($data1->$key) ? $data1->$key : '';
    $key = '112';
    $insert[$this->devices->DESC_P]  = isset($data1->$key) ? $data1->$key : '';
    $key = '111';
    $insert[$this->devices->REMARKS] = isset($data1->$key) ? $data1->$key : '';
    $key = '110';
    $insert[$this->devices->CRITICAL_SPARES] = isset($data1->$key) ? $data1->$key : '';
    $key = '121';
    $insert[$this->devices->UTILIZATION] = isset($data1->$key) ? $data1->$key : '';
    $key = '114';
    $insert[$this->devices->ES_NUMBER] = isset($data1->$key) ? $data1->$key : '';
    $key = '113';
    $insert[$this->devices->PONO]  =    isset($data1->$key) ? $data1->$key : '';
    $key = '115';
    $insert[$this->devices->GRN_VALUE]   = isset($data1->$key) ? $data1->$key : '';
    $key = '142';
    $insert[$this->devices->E_COST] = isset($data1->$key) ? $data1->$key : '';
    $key = '126';
    $insert[$this->devices->C_FROM] = isset($data1->$key)  ? $data1->$key : '';
    $key = '127';
    $insert[$this->devices->C_TO] = isset($data1->$key) ? $data1->$key : '';
    $key = '124';
    $insert[$this->devices->MF_DATE] = isset($data1->$key) ? $data1->$key : '';
    $key = '117';
    $insert[$this->devices->C_NAME]  = isset($data1->$key) ? $data1->$key : '';
    $key = '129';
    $insert[$this->devices->PDATE] = isset($data1->$key) ? $data1->$key : '';
    $key = '131';
    $insert[$this->devices->GRN_DATE] = isset($data1->$key)? $data1->$key : '';
    $key = '135';
    $insert[$this->devices->DEPT_ID] = isset($data1->$key)? $data1->$key : '';
    $key = '133';
    $insert[$this->devices->E_CAT] = isset($data1->$key) ? $data1->$key : '';
    $cat = $this->basemodel->get_single_column_value($this->devicenames->tbl_name, $this->devicenames->CODE, array($this->devicenames->ID => $insert[$this->devices->E_CAT]));
    $key = '142';
    $insert[$this->devices->E_COST] = isset($data1->$key) ? $data1->$key : '';
    $key = '122';
    $insert[$this->devices->EQ_CONDATION]  = isset($data1->$key) ? $data1->$key : '';

    /* $branch_dtls = $this->basemodel->fetch_single_row($this->branches->tbl_name, array($this->branches->BRANCH_ID => $branch_id));
    //	return $this->db->last_query();
    $qry = "SELECT " . $this->devices->E_ID . " FROM " . $this->db->dbprefix($this->devices->tbl_name) . " WHERE " .
          $this->devices->ORG_ID . " = '" . $org_id . "' AND " . $this->devices->E_ID . " LIKE '" .
          $branch_dtls[$this->branches->CITY] . "-___-____-" . $branch_dtls[$this->branches->BRANCH_CODE] .
          "-%-___-____' ORDER BY Right(" . $this->devices->E_ID . ",4) DESC";

          $devices = $this->basemodel->execute_qry($qry);
      if (!empty($devices)) {
          $devicenumbers = array();
          for ($i = 0; $i < count($devices); $i++) {
              $device = $devices[$i];
              $eid = $device[$this->devices->E_ID];
              $data['last_equp'] = $eid;
              $number_array = explode("-", $eid);
              array_push($devicenumbers, (int)end($number_array));
          }

          $arr2 = range(1, max($devicenumbers));

          $missing = array_diff($arr2, $devicenumbers);

          if (count($missing) < 0) {

              reset($missing);
              $number = (int)key($missing);

          } else {
              $device = $devices[0];
              $eid = $device[$this->devices->E_ID];
              $data['last_equp'] = $eid;
              $number_array = explode("-", $eid);
              $number = end($number_array);
              $number = (int)$number;
              $number = $number + 1;

          }
      } else
          $number = 1;
      $elast_id = sprintf('%04d', $number);

      $user_name = isset($input->user_name) ? $input->user_name : $this->session->user_name;


    $main_device_id = $branch_dtls[$this->branches->CITY] . "-" . "BME" . "-" . date('my', strtotime($insert[$this->devices->DATEOF_INSTALL])) . "-" . $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert[$this->devices->DEPT_ID] . "-" . $cat . "-" . $elast_id;
      $insert[$this->devices->E_ID] = $main_device_id;
      $insert[$this->devices->USERNAME] = $user_name;
      $insert[$this->devices->QR_CODE] = QR_URL . $insert[$this->devices->E_ID];*/


    /*  $res = $this->basemodel->insert_into_table($this->devices->tbl_name, $insert);


        if($res)
        {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "added device successfully";
        }
        else
        {
            $data['response'] = EMPTYDATA;
            $data['qry']  = $this->db->last_query();
            $data['call_back'] = "unable to added device";
        }
        return $data;
}*/


    private function _get_item_master($jodata=array())
    {
        $org_module = isset($jodata->org_module) ? $jodata->org_module : $this->session->org_module;
        // $qry1 = $this->basemodel->fetch_single_row($this->table_names->tbl_name,array($this->table_names->ORG_MODULE=>$org_module));
        //return $this->db->last_query();
        $qry = "SELECT * FROM `hsp_tbl_item_master` WHERE ORG_MODULE = '".$org_module."'  ORDER BY `hsp_tbl_item_master`.`SNO` ASC";
        $quest = $this->basemodel->execute_qry($qry);

        $quest_arr = array();
        // $head_qst = array();
        $body_qst = array();
        $quest_index = '';

        for($i = 0; $i < count($quest); $i++)
        {

            for($j = 0; $j < $quest[$i]['MAX_OPT']; $j++)
            {

                $opt = 'OPT'.($j+1);

                $quest[$i]['OPT_ARR'][$j] = $quest[$i][$opt];

            }
            array_push($body_qst,$quest[$i]);
        }

        $quest_arr = $body_qst;


        $data["response"] = SUCCESSDATA;
        $data["list"] = $quest_arr;
        $data["status"] = "Success";

        return $data;

    }


    private function _add_location($jodata=array())
    {

        if (!empty($jodata)) {
            $check = $this->basemodel->fetch_single_row($this->location->tbl_name, array($this->location->Location => $jodata->location_name),$this->location->Location);
            if ($check['location'] == null) {
                $input_data[$this->location->Location] = $jodata->location_name;
                $input_data[$this->location->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                if ($this->basemodel->insert_into_table($this->location->tbl_name, $input_data)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = 'Location Added Successfully';
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = 'Location Not Added Successfully';
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->location_name . " Already Exists";
            }
        }
        return $data;
    }

    private function _get_location_list($jodata = array())
    {

        $data = array();

        if (!empty($jodata)) {

            if(isset($jodata->limit_val))
            {

                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;



                $lwhere[$this->location->ORG_MODULE]=isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;

                $cnt = $this->basemodel->fetch_records_from($this->location->tbl_name,$lwhere,'count('.$this->location->ID.') AS CNT');

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
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->devicelabels->ORG_MODULE] = $org_type;
                $where[$this->devicelabels->ORG_ID] = $org_id;
                $where[$this->devicelabels->TABLE_NAME] = "Location";

                $select = array($this->devicelabels->LABEL_1,$this->devicelabels->LABEL_2,$this->devicelabels->LABEL_3,$this->devicelabels->LABEL_4);
                $label_location = $this->basemodel->fetch_single_row($this->devicelabels->tbl_name,$where,$select);
                $lwhere[$this->location->ORG_MODULE]=isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $location = $this->basemodel->fetch_records_from_pagination($this->location->tbl_name,$lwhere,'*',$this->location->Location,'asc','10',$limit_val*10);
            }
            else
            {
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->devicelabels->ORG_MODULE] = $org_type;
                $where[$this->devicelabels->ORG_ID] = $org_id;
                $where[$this->devicelabels->TABLE_NAME] = "Location";

                $select = array($this->devicelabels->LABEL_1,$this->devicelabels->LABEL_2,$this->devicelabels->LABEL_3,$this->devicelabels->LABEL_4);
                $label_location = $this->basemodel->fetch_single_row($this->devicelabels->tbl_name,$where,$select);
                $lwhere[$this->location->ORG_MODULE]=isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $location= $this->basemodel->fetch_records_from($this->location->tbl_name,$lwhere);
            }

            if (!empty($location) || !empty($label_location)) {
                $data['response'] = SUCCESSDATA;
                $data['list'] = $location;
                $data['labels'] = $label_location;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
                $data['labels'] = NULL;
            }
        }
        return $data;
    }

    private function _update_depreciation($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            //$check = $this->basemodel->get_single_column_value($this->depreciation->tbl_name,$this->depreciation->NAME,array($this->depreciation->NAME=>$jodata->name));
            //if(!empty($check)) {

            $where[$this->depreciation->DEPC_ID] = $jodata->DEPC_ID;
            $ivdata[$this->depreciation->NAME] = $jodata->name;
            $ivdata[$this->depreciation->PERCENTAGE] = $jodata->percentage;
            $ivdata[$this->depreciation->STATUS] = $jodata->status;
            if ($this->basemodel->update_operation($ivdata, $this->depreciation->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Depreciation Updated Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable To Process Your Request..!";
            }
            /*    }
            }else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable To Process Your Request..!";
            }*/
        }
        return $data;
    }

    private function _get_depreciation_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from($this->depreciation->tbl_name,'','count('.$this->depreciation->DEPC_ID.') AS CNT');
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
                $depreciation = $this->basemodel->fetch_records_from_pagination($this->depreciation->tbl_name,array(),'*',$this->depreciation->NAME,'asc','10',$limit_val*10);
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->depreciation_label->ORG_MODULE] = $org_type;
                $where[$this->depreciation_label->ORG_ID]  = $org_id;
                $depr_label = $this->basemodel->fetch_single_row($this->depreciation_label->tbl_name,$where);
            }
            else
            {
                $depreciation= $this->basemodel->fetch_records_from($this->depreciation->tbl_name);
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->depreciation_label->ORG_MODULE] = $org_type;
                $where[$this->depreciation_label->ORG_ID]  = $org_id;
                $depr_label = $this->basemodel->fetch_single_row($this->depreciation_label->tbl_name,$where);
            }

            if (!empty($depreciation)) {
                $data['response'] = SUCCESSDATA;
                $data['list'] = $depreciation;
                $data['labels'] = $depr_label;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _add_depreciation($jodata=array())
    {

        if (!empty($jodata)) {
            $check = $this->basemodel->fetch_single_row($this->depreciation->tbl_name, array($this->depreciation->NAME => $jodata->equipment_name),$this->depreciation->NAME);
            if ($check['NAME'] == null) {
                $input_data[$this->depreciation->NAME] = $jodata->equipment_name;
                $input_data[$this->depreciation->PERCENTAGE] = $jodata->percentage;
                if ($this->basemodel->insert_into_table($this->depreciation->tbl_name, $input_data)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = 'Depreciation Value  Added Successfully';
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = 'Depreciation Value Added Successfully';
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->equipment_name . " Already Exists";
            }
        }
        return $data;
    }

    private function _get_equp_details_by_serial($jodata){
        $result = $this->basemodel->fetch_single_row($this->devices->tbl_name, array($this->devices->ES_NUMBER => $jodata->sr_no));
        if ($result) {
            $data['response'] = SUCCESSDATA;
            $data['list'] = $result;
        } else {
            $data['response'] = FAILEDATA;
        }
        return $data;
    }
    private function _get_equp_details($jodata){
        $result = $this->basemodel->fetch_single_row($this->devices->tbl_name, array($this->devices->E_ID => $jodata->eqpid));

        if ($result) {
            $data['response'] = SUCCESSDATA;
            $data['list'] = $result;
        } else {
            $data['response'] = FAILEDATA;
        }
        return $data;
    }

    private function  _get_gatepass_details($jodata = array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $result = $this->basemodel->fetch_single_row($this->gatepass->tbl_name,array($this->gatepass->ID => $jodata->id));
            if($result){
                $data['list'] = $result;
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = FAILEDATA;
            }
        }
        return $data;
    }

    private function _get_scheduled_calls($jodata=array())
    {

        $data = array();
        $select = array($this->scheduledcalls->SCHEDULE_TYPE,$this->scheduledcalls->YEAR,$this->scheduledcalls->MONTH,$this->scheduledcalls->DAY);

        $data['scheduled'] = $this->basemodel->fetch_records_from($this->scheduledcalls->tbl_name, '', $select);
        if (!empty($data['scheduled'])) {
            $data['response'] = SUCCESSDATA;
        } else {
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

    private function _get_scheduled_year_days($jodata = array())
    {

        $data = array();
        if(!empty($jodata)) {


            $select = array($this->scheduledcalls->SCHEDULE_TYPE,$this->scheduledcalls->YEAR,$this->scheduledcalls->MONTH,$this->scheduledcalls->DAY,$this->scheduledcalls->ID);

            $data['list'] = $this->basemodel->fetch_single_row($this->scheduledcalls->tbl_name, array($this->scheduledcalls->SCHEDULE_TYPE => $jodata->caller_name));
            //  return $this->db->last_query();
        }
        return $data;
    }

    private function  _qcself_respond_call($jodata=array())
    {
        $data[$this->qcdetails->ASSIGNED_BY] = $this->session->user_id;
        $data[$this->qcdetails->ASSIGNED_TO] = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;;
        $data[$this->qcdetails->ASSIGNED_ON] = date('Y-m-d');
        $data[$this->qcdetails->ASSIGN_REMARKS] = $jodata->REMARKS;
        $where[$this->qcdetails->EID] = $jodata->EID;
        $result = $this->basemodel->update_operation($data,$this->qcdetails->tbl_name,$where);
        if (!empty($result)){
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "QC Call Updated Successfully";
        }
        else{
            $data['response'] = FAILEDATA;
            $data['call_back'] = "QC Call Not Updated Successfully";
        }
        return $data;
    }

    private function  _pmsself_respond_call($jodata=array())
    {
        $data[$this->pmsdetails->PMS_ASSIGNED_BY] = $this->session->user_id;
        $data[$this->pmsdetails->PMS_ASSIGNED_TO] = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;;
        $data[$this->pmsdetails->ASSIGNED_ON] = date('Y-m-d');
        $data[$this->pmsdetails->ASSIGN_REMARKS] = $jodata->REMARKS;
        $where[$this->pmsdetails->EID] = $jodata->EID;
        $result = $this->basemodel->update_operation($data,$this->pmsdetails->tbl_name,$where);
        if (!empty($result)){
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "PMS Call Updated Successfully";
        }
        else{
            $data['response'] = FAILEDATA;
            $data['call_back'] = "PMS Call Not Updated Successfully";
        }
        return $data;
    }
    private function _get_user_details($jodata=array())
    {
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $where[$this->users->ORG_ID] = $org_id;
        $where[$this->users->ROLE_CODE ." !="] = HMADMIN;
        $where[$this->users->USER_NAME ." !="] = NULL;
        $where[$this->users->USER_ID ." !="] = $user_id;
        $result = $this->basemodel->fetch_records_from($this->users->tbl_name,$where,array($this->users->USER_ID,$this->users->USER_NAME));
        if (!empty($result)){
            $data['response'] = SUCCESSDATA;
            $data['list'] = $result;
        }
        else
            $data['response'] = FAILEDATA;

        return $data;
    }

    private function _vendor_add_gate_pass_list($jodata=array())
    {
        $data = array();
        $org_id = $this->session->org_id;
        $branch_id = $jodata->branch;
        $today = date('Y-m-d H:i:s');
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        if(!empty($jodata))
        {
            $lcear_id = $this->basemodel->get_single_column_value($this->gatepass->tbl_name, $this->gatepass->GP_ID, array($this->gatepass->GP_ID . " LIKE" => "%GP" . date('my') . "%"), $this->gatepass->GP_ID, 'desc');
            //return $this->db->last_query();
            if ($lcear_id == "-") {
                $isdata[$this->gatepass->GP_ID] = "GP" . date('my') . "0001";
            } else {
                $last_val = substr($lcear_id, -4);
                $to_int = (int)$last_val;
                $isdata[$this->gatepass->GP_ID] = $this->baselibrary->set_gatepass_id($to_int);
            }
            $isdata[$this->gatepass->BRANCH_ID] = $branch_id;
            if(isset($jodata->to_whom) && $jodata->to_whom!=null && $jodata->to_whom!="")
            {
                if(ctype_alnum($jodata->to_whom))
                {
                    $to_whom = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_NAME,array($this->branches->BRANCH_ID=>$jodata->to_whom));
                }

                else
                {
                    $to_whom = $jodata->to_whom;
                }
                $isdata[$this->gatepass->TO_WHOME] = $to_whom;
            }
            //return $this->db->last_query();
            $isdata[$this->gatepass->ORG_ID] = $org_id;
            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $isdata[$this->gatepass->DEPT_ID] = $jodata->dept_id;
            if (isset($jodata->E_ID))
                $isdata[$this->gatepass->E_ID] = $jodata->E_ID;
            if (isset($jodata->gtype))
                $isdata[$this->gatepass->RETURN_TYPE] = $jodata->gtype;
            if (isset($jodata->expert_return))
                $isdata[$this->gatepass->EXPECTED_RETURN] = date('Y-m-d',strtotime($jodata->expert_return));
            if ($jodata->critical_spare != ALL && $jodata->critical_spare !='')
                $isdata[$this->gatepass->SPARES] = implode(',',$jodata->critical_spare);
            if (isset($jodata->spars_cnt))
                $isdata[$this->gatepass->SPARES_CNT] = $jodata->spars_cnt;
            if ($jodata->accessories != ALL && $jodata->accessories !='')
                $isdata[$this->gatepass->ACCESSORIES] = implode(',',$jodata->accessories);
            if (isset($jodata->accessories_cnt))
                $isdata[$this->gatepass->ACCESSORIES_CNT] = $jodata->accessories_cnt;
            if (isset($jodata->reasons))
                $isdata[$this->gatepass->REASONS] = $jodata->reasons;
            if (isset($jodata->phy_location))
                $isdata[$this->gatepass->LOCATION] = $jodata->PHY_LOCATION;
            if (isset($jodata->remarks))
                $isdata[$this->gatepass->REMARKS] = $jodata->remarks;
            $isdata[$this->gatepass->ADDED_ON] = $today;
            $isdata[$this->gatepass->ADDED_BY] = $user_id;
            $isdata[$this->gatepass->INDENT_ID] = $jodata->INDENT_ID;
            $result = $this->basemodel->insert_into_table($this->gatepass->tbl_name, $isdata);
            $last_id = $this->db->insert_id();
            $res = $this->basemodel->update_operation(array($this->indents->GATEPASS_ID => $last_id),$this->indents->tbl_name,array($this->indents->ID => $jodata->INDENT_ID));
            if($res){
                $data['response'] = SUCCESSDATA;
                $data['list'] = $res;
                $data['call_back'] = "Gate Pass Added Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }

        return $data;
    }
    private  function _getsingle_device_data($jodata = array())
    {
        $data = array();
        if(!empty($jodata))
        {
            // $result = $this->basemodel->get_single_column_value($this->devices->tbl_name,$this->devices->DEPT_ID,array($this->devices->E_ID => $jodata->eid));
            $result = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID => $jodata->eid),$this->devices->DEPT_ID);
            // return $result;
            if($result){
                $data['response'] = SUCCESSDATA;
                $data['list'] = $result;
            } else {
                $data['response'] = FAILEDATA;
            }
        }
        return $data;
    }
    private function _get_equipments($jodata=array())
    {
        //return $jodata->trans_branch;
        $where[$this->devices->E_ID." !="]= "NULL";
        $where[$this->devices->ASSIGN_ID] = "";
        $where[$this->devices->BRANCH_ID]= $jodata->trans_branch;
        //$where[$this->devices->DEPT_ID]= $jodata->dept_id;
        //$where[$this->devices->TRANS_BRANCH_ID]= $jodata->tbranch;
        $like[$this->devices->E_NAME] = $jodata->name;
        //$where[$this->devices->BRANCH_ID]= $jodata->BRANCH_ID;
        //return $jodata->BRANCH_ID;
        // $res = $this->basemodel->fetch_records_from($this->devices->tbl_name,$where);
        $res = $this->basemodel->fetch_records_from_multi_where_like($this->devices->tbl_name,$where,'',$like,'*','','','');
        //return $this->db->last_query();
        if($res)
        {
            $data['response'] = SUCCESSDATA;
            $data['list'] = $res;
        }else{
            $data['response'] = FAILEDATA;
            $data['list'] = NULL;
        }
        return $data;
    }
    private function _get_vendor_details($jodata = array()){

        $cp_details = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->CP_DETAILS,array($this->organizations->ORG_ID => $jodata->vid));
        $vendor_org = $this->basemodel->fetch_single_row($this->organizations->tbl_name,array($this->organizations->ORG_ID => $jodata->vid),$this->organizations->ORG_NAME);
        if($cp_details!='-'){

            $cp_details1 = json_decode($cp_details,TRUE);
            foreach($cp_details1['contact_persons'] as $cps){

                $data['list']['contact_person'] = $cps['contact_person'];
                $data['list']['cpemail'] = $cps['cpemail'];
                $data['list']['contact_person_no'] = $cps['contact_person_no'];
                $data['list']['org_name'] = $vendor_org['ORG_NAME'];
                $data['list']['vendor_id'] = $jodata->vid;
            }
        }
        return $data;
    }
    private function _get_contract_vendor_details($jodata = array())
    {
        $data = array();
        if(!empty($jodata))
        {
            /* $where[$this->contactpersons->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
             $where[$this->contactpersons->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
             $data['list'] = $this->basemodel->fetch_single_row($this->devicevendors->tbl_name, array($this->devicevendors->ID => $jodata->vid));
             $where[$this->contactpersons->VENDOR_ID] = $data['list'][$this->devicevendors->ID];
             $cp_details = $this->basemodel->get_single_column_value($this->contactpersons->tbl_name,$this->contactpersons->CPS_DETAILS,$where
             );
             if($cp_details!='-')
             {
                 $cp_details1 = json_decode($cp_details,TRUE);
                 foreach($cp_details1['contact_persons'] as $cps)
                 {
                     if($cps['priority']==1)
                     {
                         $data['list'][$this->devicevendors->CP_NAME] = $cps['contact_person'];
                         $data['list'][$this->devicevendors->CP_EMAIL] = $cps['cpemail'];
                         $data['list'][$this->devicevendors->CP_NUMBER] = $cps['contact_person_no'];
                         break;
                     }
                 }
             }
             else
             {
                 $data['list'][$this->devicevendors->CP_NAME] = $data['list'][$this->devicevendors->CP_EMAIL] = $data['list'][$this->devicevendors->CP_NUMBER] = NULL;
             }
         }
         return $data;*/


            $where[$this->organizations->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->organizations->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;

            $data['list'] = $this->basemodel->fetch_single_row($this->organizations->tbl_name, array($this->organizations->ORG_ID => $jodata->vid));
            $data['list']['vendor_number'] = $data['list']['CP_NUMBER'];
            $data['list']['vendor_email'] = $data['list']['CP_EMAIL'];
            $data['list']['vendor_address'] = $data['list']['ORG_ADDRESS'];
            $where1 = $data['list'][$this->organizations->ORG_ID];
            //return $this->db->last_query();
            $cp_details = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->CP_DETAILS,array($this->organizations->ORG_ID=>$where1)
            );

            if($cp_details!='-')
            {

                $cp_details1 = json_decode($cp_details,TRUE);

                foreach($cp_details1['contact_persons'] as $cps)
                {
                    $data['list'][$this->organizations->CP_NAME] = $cps['contact_person'];
                    $data['list'][$this->organizations->CP_EMAIL] = $cps['cpemail'];
                    $data['list'][$this->organizations->CP_NUMBER] = $cps['contact_person_no'];

                }

            }
            else
            {

                $data['list'][$this->organizations->CP_NAME] = $data['list'][$this->organizations->CP_EMAIL] = $data['list'][$this->organizations->CP_NUMBER] = NULL;
            }

        }
        return $data;
    }



    private function _get_oem_dis_sup($jodata = array())
    {
        if($jodata->action == "get_oems"){
            if (!empty($jodata)) {
                $data['list'] = $this->basemodel->fetch_records_from($this->devicevendors->tbl_name, array($this->devicevendors->TYPE . " LIKE " => "%" . $jodata->type . "%"), array($this->devicevendors->NAME, $this->devicevendors->ID), $this->devicevendors->NAME);
                if (!empty($data['list']))
                    $data['response'] = SUCCESSDATA;
                else
                    $data['response'] = FAILEDATA;
            }
            return $data;
        }else{
            $data = array();
            if (!empty($jodata)) {
                $res = $this->basemodel->fetch_records_from($this->devicevendors->tbl_name, array($this->devicevendors->TYPE . " LIKE " => "%" . $jodata->type . "%"), array($this->devicevendors->NAME, $this->devicevendors->ID), $this->devicevendors->NAME);

                $myres[0] = array("category"=>"Others","list"=>$res);
                if(isset($jodata->aaction))
                {
                    $where = array($this->organizations->ORG_TYPE=>'Vendor',$this->organizations->STATUS=>ACTIVESTS);
                    $select = array($this->organizations->ORG_ID, $this->organizations->ORG_NAME);
                    $res2 = $this->basemodel->fetch_records_from($this->organizations->tbl_name,$where,$select);

                    $org_vendor = array();

                    for($i = 0; $i < count($res2); $i++)
                        $org_vendor[$i] = array("NAME"=>$res2[$i]['ORG_NAME'],"ID"=>$res2[$i]['ORG_ID']);

                    if(count($org_vendor) > 0)
                        array_unshift($myres,array("category"=>"Vendor Orgs.","list"=>$org_vendor));
                }

                $data['list'] = $myres;
                if (!empty($data['list']))
                    $data['response'] = SUCCESSDATA;
                else
                    $data['response'] = FAILEDATA;
            }
            return $data;
        }
    }



    private function _get_equp_cats($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $data['list'] = $this->basemodel->fetch_records_from($this->devicenames->tbl_name, '', array($this->devicenames->NAME, $this->devicenames->ID),$this->devicenames->NAME);
            if (!empty($data['list']))
                $data['response'] = SUCCESSDATA;
            else
                $data['response'] = FAILEDATA;
        }
        return $data;
    }

    private function _get_vendor_types($jodata = array())
    {
        $data = array();
        // $where[] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        if (!empty($jodata)) {
            $data['list'] = $this->basemodel->fetch_records_from($this->vendortypes->tbl_name);
            if (!empty($data['list']))
                $data['response'] = SUCCESSDATA;
            else
                $data['response'] = FAILEDATA;
        }
        return $data;
    }



    private function _get_organisations($jodata = array())
    {


        $data  = array();

        if(!empty($jodata))
        {
            $where = array($this->organizations->ORG_TYPE=>'Vendor',$this->organizations->STATUS=>ACTIVESTS);
            $select = array($this->organizations->ORG_ID, $this->organizations->ORG_NAME);
            $data['list'] = $this->basemodel->fetch_records_from($this->organizations->tbl_name,$where,$select);
            if (!empty($data['list']))
                $data['response'] = SUCCESSDATA;
            else
                $data['response'] = FAILEDATA;
        }
        return $data;
    }



    private function _get_critical_spares($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $list = $this->basemodel->fetch_records_from($this->criticalspares->tbl_name, array($this->criticalspares->STATUS => ACTIVESTS), '*', $this->accessories->NAME);
            if (!empty($list)) {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($list); $i++) {
                    $list[$i]['Branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$i][$this->criticalspares->BRANCH]));
                }
                $data['list'] = $list;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _add_equp_type($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $equp_type = $this->basemodel->get_single_column_value($this->equptypes->tbl_name, $this->equptypes->CODE, array($this->equptypes->CODE => $jodata->code));
            if ($equp_type == "-") {
                $idata[$this->equptypes->TYPE] = $jodata->type;
                $idata[$this->equptypes->CODE] = $jodata->code;
                $idata[$this->equptypes->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                if ($this->basemodel->insert_into_table($this->equptypes->tbl_name, $idata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = 'Equipment Type Added Successfully';
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = 'Unable to Process Your Request Try Again...!';
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->code . ' Code Already Exists...!';
            }
        }
        return $data;
    }

    private function _update_eq_type($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $equp_type = $this->basemodel->get_single_column_value($this->equptypes->tbl_name, $this->equptypes->CODE, array($this->equptypes->CODE => $jodata->code));
            if (!empty($equp_type)) {

                $idata[$this->equptypes->TYPE] = $jodata->type;
                $idata[$this->equptypes->CODE] = $jodata->code;
                $idata[$this->equptypes->STATUS] = $jodata->status;
                $where[$this->equptypes->ID] = $jodata->ID;
                if ($this->basemodel->update_operation($idata, $this->equptypes->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = 'Equipment Type Updated Successfully';
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $idata[$this->equptypes->CODE] . ' Code Already Exists...!';
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = 'Unable to Process Your Request Try Again...!';
            }
        }
        return $data;
    }

    private function _add_critical_spare($jodata = array())
    {
        $data = array();
        $idata[$this->criticalspares->NAME] = $jodata->name;
        $idata[$this->criticalspares->CODE] = $jodata->code;
        $idata[$this->criticalspares->BRANCH] = $jodata->branchid;
        $idata[$this->criticalspares->COUNT] = $jodata->count;
        $res = $this->basemodel->insert_into_table($this->criticalspares->tbl_name, $idata);
        //return $this->db->last_query();
        if ($res) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Record Inserted Successfully';
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = 'Unable to Process Your Request Try Again...!';
        }
        return $data;
    }

    private function _add_classification($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $classification = $this->basemodel->get_single_column_value($this->classifications->tbl_name, $this->classifications->CODE, array($this->classifications->CODE => $jodata->code));
            if ($classification == "-") {
                $idata[$this->classifications->MASTER_CLASS] = $jodata->master_class;
                $idata[$this->classifications->RESPONSIBLE_DEPT] = $jodata->responsible_dept;
                $idata[$this->classifications->CODE] = $jodata->code;
                if ($this->basemodel->insert_into_table($this->classifications->tbl_name, $idata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = 'Classification Added Successfully';
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable To Process Your Request..!";
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->code . " Classification Code Already Exists";
            }
        }
        return $data;
    }

    private function _update_classification($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $classification = $this->basemodel->get_single_column_value($this->classifications->tbl_name, $this->classifications->CODE, array($this->classifications->CODE => $jodata->code));
            if (!empty($classification)) {
                $idata[$this->classifications->MASTER_CLASS] = $jodata->master_class;
                $idata[$this->classifications->RESPONSIBLE_DEPT] = $jodata->responsible_dept;
                $idata[$this->classifications->CODE] = $jodata->code;
                $idata[$this->classifications->STATUS] = $jodata->status;
                $where[$this->classifications->ID] = $jodata->ID;
                if ($this->basemodel->update_operation($idata, $this->classifications->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = 'Classification Updated Successfully';
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $idata[$this->classifications->CODE] . ' Code Already Exists...!';
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable To Process Your Request..!";
            }
        }
        return $data;
    }

    private function _update_critical_spare($jodata = array())
    {
        $data = array();
        $idata[$this->criticalspares->NAME] = $jodata->name;
        $idata[$this->criticalspares->CODE] = $jodata->code;
        $idata[$this->criticalspares->BRANCH] = $jodata->branch;
        $idata[$this->criticalspares->COUNT] = $jodata->count;
        $where[$this->criticalspares->ID] = $jodata->ID;
        if ($this->basemodel->update_operation($idata, $this->criticalspares->tbl_name, $where)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Record Updated Successfully';
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = 'Unable to Process Your Request Try Again...!';
        }
        return $data;
    }

    private function _add_accessor($jodata = array())
    {
        $data = array();
        $idata[$this->accessories->NAME] = $jodata->name;
        $idata[$this->accessories->CODE] = $jodata->code;
        if ($this->basemodel->insert_into_table($this->accessories->tbl_name, $idata)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Record Inserted Successfully';
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = 'Unable to Process Your Request Try Again...!';
        }
        return $data;
    }

    private function _update_accessor($jodata = array())
    {
        $data = array();
        $idata[$this->accessories->NAME] = $jodata->name;
        $idata[$this->accessories->CODE] = $jodata->code;
        $where[$this->accessories->ID] = $jodata->ID;
        if ($this->basemodel->update_operation($idata, $this->accessories->tbl_name, $where)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Record Updated Successfully';
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = 'Unable to Process Your Request Try Again...!';
        }
        return $data;
    }

    private function _get_accessories($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $list = $this->basemodel->fetch_records_from($this->accessories->tbl_name, array($this->accessories->STATUS => ACTIVESTS), '*', $this->accessories->NAME);
            if (!empty($list)) {
                $data['response'] = SUCCESSDATA;
                $data['list'] = $list;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _get_my_details($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $where[$this->users->USER_ID] = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $mydata = $this->basemodel->fetch_single_row($this->users->tbl_name, $where);
            if (!empty($mydata)) {
                $data['response'] = SUCCESSDATA;
                $branches = explode(",", $mydata[$this->users->ORG_BRANCH_ID]);
                for ($i = 0; $i < count($branches); $i++) {
                    $mydata['BRANCHES'][] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $branches[$i]));
                }
                $mydata['ROLE_CODE_NAME'] = $this->basemodel->get_single_column_value($this->roles->tbl_name, $this->roles->ROLE_NAME, array($this->roles->ROLE_CODE => $mydata[$this->users->ROLE_CODE]));
                $mydata['ORG_NAME']  = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID=>$mydata[$this->users->ORG_ID]));
                $mydata['ORG_TYPE'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_TYPE,array($this->organizations->ORG_ID=>$mydata[$this->users->ORG_ID]));
                $mydata['EROLE_CODE'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->EROLE_CODE,array($this->organizations->ORG_ID=>$mydata[$this->users->ORG_ID]));
                $mydata['ROLE_CODE'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ROLE_CODE,array($this->organizations->ORG_ID=>$mydata[$this->users->ORG_ID]));
                $mydata['ORG_ADDRESS'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_ADDRESS,array($this->organizations->ORG_ID=>$mydata[$this->users->ORG_ID]));
                $mydata['ORG_MODULE'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$mydata[$this->users->ORG_ID]));
                $mydata['BRANCHES_DATA'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->NO_OF_BRANCHES,array($this->organizations->ORG_ID=>$mydata[$this->users->ORG_ID]));
                $mydata['USERS'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->NO_OF_USERS,array($this->organizations->ORG_ID=>$mydata[$this->users->ORG_ID]));
                $mydata['EQUIPMENTS'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->NO_OF_EQUPIMENTS,array($this->organizations->ORG_ID=>$mydata[$this->users->ORG_ID]));
                $data['mydata'] = $mydata;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _load_havendor_list($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
            //$where[$this->users->USER_ID] = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = "VENDOR";
            $where[$this->users->ROLE_CODE] = $role_code;
            $where[$this->users->status] = ACTIVESTS;
            $havendorlist = $this->basemodel->fetch_records_from($this->users->tbl_name, $where);
            //  return $this->db->last_query();
            if (!empty($havendorlist)) {
                $data['response'] = SUCCESSDATA;
                $data['list'] = $havendorlist;

            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _load_hamodule_list($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {


            $hamodulelist = $this->basemodel->fetch_records_from($this->modules->tbl_name);

            if (!empty($hamodulelist)) {
                $data['response'] = SUCCESSDATA;
                $data['list'] = $hamodulelist;

            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }


    private function _vendor_home_page($jodata = array())
    {

        $data[$this->organizations->ORG_ID] = $jodata->org_id;
        return $data;
    }
    private function _update_branch($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

            $today = date('Y-m-d H:i:s');
            $ibdata[$this->branches->BRANCH_NAME] = $jodata->branch_name;
            $ibdata[$this->branches->BRANCH_ADDRESS] = $jodata->branch_address;
            $ibdata[$this->branches->STATUS] = $jodata->status;
            $ibdata[$this->branches->UPDATED_ON] = $today;
            if(isset($jodata->branch_code) && $jodata->branch_code!="")
            {
                $ibdata[$this->branches->BRANCH_CODE] = $jodata->branch_code;
            }
            $ibdata[$this->users->UPDATED_BY] = $user_id;
            $ibdata[$this->branches->CITY] = $jodata->city_name;
            $where[$this->branches->BRANCH_ID] = $jodata->BRANCH_ID;
            $where[$this->branches->ORG_ID] = $org_id;
            if ($this->basemodel->update_operation($ibdata, $this->branches->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = $jodata->branch_name . " Branch Updated Successfully.";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _update_user($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $user_id_assign = isset($jodata->USER_ID) ? $jodata->USER_ID : $this->session->user_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            $iudata[$this->users->USER_NAME] = $jodata->USER_NAME;
            $iudata[$this->users->USER_ID] = $jodata->USER_ID;
            $iudata[$this->users->EMAIL_ID] = $jodata->EMAIL_ID;
            $iudata[$this->users->MOBILE_NO] = $jodata->EMP_NO;
            $iudata[$this->users->EMP_NO] = $jodata->EMP_NO;
            $iudata[$this->users->ROLE_CODE] = $jodata->ROLE_CODE;
            $iudata[$this->users->ORG_BRANCH_ID] = implode(",", $jodata->org_branch_id);
            $iudata[$this->users->STATUS] = $jodata->STATUS;
            if(isset($jodata->STATUS) && $jodata->STATUS!=ACTIVESTS)
            {
                $iudata[$this->users->GCM_ID] = NULL;
            }
            $role_dtls = $this->basemodel->fetch_single_row($this->orgroles->tbl_name,array($this->orgroles->ROLE_CODE => $iudata[$this->users->ROLE_CODE],$this->orgroles->ORG_ID=>$org_id));

            $iudata[$this->users->LEVEL] = $role_dtls[$this->orgroles->ESCALATION];
            $iudata[$this->users->UPDATED_BY] = $user_id_assign;
            $iudata[$this->users->UPDATED_ON] = date('Y-m-d H:i:s');

            if ($this->basemodel->update_operation($iudata, $this->users->tbl_name, array($this->users->USER_ID => $jodata->USER_ID)))
            {
                $this->basemodel->delete_row($this->rounds_assigned->tbl_name,array($this->rounds_assigned->ASSIGNED_TO=>$jodata->USER_ID));
                $data['rounds'] = $this->baselibrary->assign_rounds($org_id,$jodata->org_branch_id,$user_id_assign,$jodata->USER_ID);

                $data['response'] = SUCCESSDATA;
                $data['call_back'] = $jodata->USER_NAME . " Details updated Successfully.";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable to Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _get_branches_details($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branches = $this->basemodel->fetch_records_from($this->branches->tbl_name, array($this->branches->ORG_ID => $org_id),'*',$this->branches->BRANCH_NAME);
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $where[$this->branchlabels->ORG_MODULE] = $org_type;
            $where[$this->branchlabels->ORG_ID]  = $org_id;
            $branch_labels = $this->basemodel->fetch_single_row($this->branchlabels->tbl_name,$where);

            if(!empty($branches) || !empty($branch_labels))
            {
                $c = count($branches);
                for($i = 0; $i < $c; $i++)
                {
                    $branches[$i]["hod"] = $this->baselibrary->get_branch_hods($org_id, $branches[$i][$this->branches->BRANCH_ID]);
                }
                $data['response'] = SUCCESSDATA;
                $data['branches'] = $branches;
                $data['labels'] = $branch_labels;
            }
            else
            {
                $data['response'] = FAILEDATA;
            }
        }
        return $data;
    }

    public function edit_user_dialog()
    {
        $this->load->view('dialogs/edit_user_dailog');
    }

    public function edit_branch_dialog()
    {
        $this->load->view('dialogs/edit_branch_dialog');
    }

    public function edit_vendor_dialog()
    {
        $this->load->view('dialogs/edit_vendor_dialog');
    }

    public function show_profile_dialog()
    {
        $this->load->view('dialogs/show_profile_dialog');
    }

    public function edit_city_dialog()
    {
        $this->load->view('dialogs/edit_city_dialog');
    }
    public function edit_country_dialog()
    {
        $this->load->view('dialogs/edit_country_dialog');
    }
    public function edit_state_dialog()
    {
        $this->load->view('dialogs/edit_state_dialog');
    }
    public function edit_ctype_dialog()
    {
        $this->load->view('dialogs/edit_ctype_dialog');
    }

    public function edit_status_dialog()
    {
        $this->load->view('dialogs/edit_status_dialog');
    }

    public function edit_equp_cond_dialog()
    {
        $this->load->view('dialogs/edit_equp_cond_dialog');
    }

    public function edit_equp_class_dialog()
    {
        $this->load->view('dialogs/edit_equp_class_dialog');
    }

    public function edit_equp_util_dialog()
    {
        $this->load->view('dialogs/edit_equp_util_dialog');
    }

    public function edit_training_type_dialog()
    {
        $this->load->view('dialogs/edit_training_type_dialog');
    }

    public function edit_dept_dialog()
    {
        $this->load->view('dialogs/edit_dept_dialog');
    }

    public function edit_reason_dialog()
    {
        $this->load->view('dialogs/edit_reason_dialog');
    }
    public function edit_non_scheduled_reason_dialog()
    {
        $this->load->view('dialogs/edit_non_scheduled_reason_dialog');
    }

    public function edit_levels_dialog()
    {
        $this->load->view('dialogs/edit_levels_dialog');
    }

    public function edit_escalations_dialog()
    {
        $this->load->view('dialogs/edit_escalations_dialog');
    }

    public function edit_escalations1_dialog()
    {
        $this->load->view('dialogs/edit_escalations1_dialog');
    }

    public function edit_itype_dialog()
    {
        $this->load->view('dialogs/edit_itype_dialog');
    }

    public function edit_observation_dialog()
    {
        $this->load->view('dialogs/edit_observation_dialog');
    }

    public function edit_adverse_incidents_dialog()
    {
        $this->load->view('dialogs/edit_adverse_incidents_dialog');
    }

    public function edit_transfer_approval_dialog()
    {
        $this->load->view('dialogs/edit_transefer_approval_dialog');
    }
    public function edit_otherunit_transfer_dialog()
    {
        $this->load->view('dialogs/edit_otherunit_transfer_dialog');
    }
    public function edit_transfer_request_dialog()
    {
        $this->load->view('dialogs/edit_transfer_request_dialog');
    }
    public function transfer_deploy_dialog()
    {
        $this->load->view('dialogs/transfer_deploy_dialog');
    }
    public function edit_con_reasons_dialog()
    {
        $this->load->view('dialogs/edit_con_reasons_dialog');
    }
    public function edit_condemnation_aprroved_dialog()
    {
        $this->load->view('dialogs/edit_condemnation_aprroved_dialog');
    }
    public function edit_condemnation_admin_aprroved_dialog()
    {
        $this->load->view('dialogs/edit_conde_admin_aprroved_dialog');
    }
    public function edit_condemnation_request_dialog()
    {
        $this->load->view('dialogs/edit_condemnation_request_dialog');
    }
    public function edit_reusablepart_dialog()
    {
        $this->load->view('dialogs/edit_reusablepart_dialog');
    }
    public function edit_indent_equp_dialog()
    {
        $this->load->view('dialogs/edit_indent_equp_dialog');
    }
    public function edit_cear_category_dialog()
    {
        $this->load->view('dialogs/edit_cear_category_dialog');
    }
    public function adverse_incident_aprrove_dialog()
    {
        $this->load->view('dialogs/adverse_incident_aprrove_dialog');
    }
    public function edit_cear_dialog()
    {
        $this->load->view('dialogs/edit_cear_dialog');
    }

    public function approve_cear_dialog()
    {
        $this->load->view('dialogs/approve_cear_dialog');
    }
    public function edit_indedent_admin_aprroved_dialog()
    {
        $this->load->view('dialogs/edit_indedent_admin_aprroved_dialog');
    }
    public function edit_indedent_sactioned_dialog()
    {
        $this->load->view('dialogs/edit_indedent_sactioned_dialog');
    }
    public function edit_indent_cear_request_dialog()
    {
        $this->load->view('dialogs/edit_indent_cear_request_dialog');
    }
    public function edit_gate_pass_dialog()
    {
        $this->load->view('dialogs/edit_gate_pass_dialog');
    }
    public function add_new_gate_pass_dialog()
    {
        $this->load->view('dialogs/add_new_gate_pass_dialog');
    }
    public function add_new_contact_person()
    {
        $this->load->view('dialogs/add_new_contact_person');
    }
    public function edit_new_gate_pass_dialog()
    {
        $this->load->view('dialogs/edit_new_gate_pass_dialog');
    }
    public function add_call_log_filters()
    {
        $this->load->view('dialogs/add_call_log_filters');
    }
    public function view_viability_dialog()
    {
        $this->load->view('dialogs/view_viability_dialog');
    }
    public function add_vendor_gatepass(){

        $this->load->view('dialogs/add_vendor_gatepass');
    }
    public function vendor_pmscall_respond_dailog(){

        $this->load->view('dialogs/vendor_pmscall_respond_dailog');
    }
    public function vendor_qccall_respond_dailog(){

        $this->load->view('dialogs/vendor_qccall_respond_dailog');
    }
    public function edit_depreciation_dialog()
    {
        $this->load->view('dialogs/edit_depreciation_dialog');
    }

    public function edit_location_dialog()
    {
        $this->load->view('dialogs/edit_location_dialog');
    }

    private function _get_user_features_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $features = $this->basemodel->fetch_single_row($this->users->tbl_name, array($this->users->USER_ID => $this->session->user_id), $this->users->FEATURES_LIST);
            if (!empty($features)) {
                if ($features[$this->users->FEATURES_LIST] == "") {
                    $features = $this->basemodel->fetch_single_row($this->roles->tbl_name, array($this->roles->ROLE_CODE => $this->session->role_code), $this->roles->ROLE_FEATURES);
                    $features[$this->users->FEATURES_LIST] = $features[$this->roles->ROLE_FEATURES];
                }

                $data['response'] = SUCCESSDATA;
                $data['features_list'] = $features;
            } else {
                $data['response'] = EXISTSDATA;
                $data['features_list'] = NULL;
            }
        }
        return $data;
    }

    private function _add_new_user($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id_assign = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $max_val = (int)$this->basemodel->select_max_val($this->users->tbl_name, $this->users->UID);
            $user_id = $this->baselibrary->user_id_creation($max_val);
            $today = date('Y-m-d H:i:s');
            $iudata[$this->users->USER_ID] = HA . $user_id;
            $iudata[$this->users->USER_NAME] = $jodata->user_name;
            $iudata[$this->users->EMAIL_ID] = $jodata->user_email;
            $iudata[$this->users->MOBILE_NO] = $jodata->emp_no;
            $iudata[$this->users->EMP_NO] = $jodata->emp_no;
            $iudata[$this->users->ROLE_CODE] = $jodata->roleid;
			//$iudata[$this->users->]
            $iudata[$this->users->ORG_BRANCH_ID] = implode(",",$jodata->branch_id);
            $iudata[$this->users->ORG_ID] = $org_id;
            $iudata[$this->users->PSWRD] = $this->bcrypt->hash_password(DFFPASS);
            $iudata[$this->users->STATUS] = ACTIVESTS;
            // $role_dtls = $this->basemodel->fetch_single_row($this->orgroles->tbl_name,array($this->orgroles->ROLE_CODE => $iudata[$this->users->ROLE_CODE]));
            //  $iudata[$this->users->LEVEL] = $role_dtls[$this->orgroles->ESCALATION];
            $iudata[$this->users->START_DATE] = $today;
            $iudata[$this->users->ADDED_ON] = $today;
            $iudata[$this->users->END_DATE] = $enddate = date('9999-m-d H:i:s');
            $iudata[$this->users->ADDED_BY] = $user_id_assign;
            $this->db->select($this->users->USER_NAME, FALSE);
            $this->db->from($this->db->dbprefix($this->users->tbl_name));
            $this->db->where($this->users->MOBILE_NO, $iudata[$this->users->MOBILE_NO]);
            $this->db->or_where($this->users->EMAIL_ID, $iudata[$this->users->EMAIL_ID]);
            $this->db->or_where($this->users->EMP_NO, $iudata[$this->users->EMP_NO]);
            $result = $this->db->get();
            $user_array = $result->result_array();
            if(empty($user_array))
            {
                $res = $this->basemodel->insert_into_table($this->users->tbl_name, $iudata);
                $id = $this->db->insert_id();
                if($res)
                {
                    $recent_result = $this->basemodel->fetch_single_row($this->users->tbl_name,array($this->users->UID => $id),array($this->users->ROLE_CODE));
                    $role_dtls = $this->basemodel->fetch_single_row($this->orgroles->tbl_name,array($this->orgroles->ROLE_CODE => $recent_result['ROLE_CODE']),array($this->orgroles->ESCALATION));
                    if($role_dtls){
                        $this->basemodel->update_operation(array($this->users->LEVEL => $role_dtls['ESCALATION']));
                    }

                    $branches =  $jodata->branch_id;
                    $data['rounds'] = $this->baselibrary->assign_rounds($org_id,$branches,$user_id_assign,$iudata[$this->users->USER_ID]);
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = $jodata->user_name . " Successfully Registered with HospiAsset.";
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = EXISTSDATA;
                $data['call_back'] = "User Already Registered With HospiAsset...!";
            }
        }
        return $data;
    }

    private function _add_new_havendor($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id_assign = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $max_val = (int)$this->basemodel->select_max_val($this->users->tbl_name, $this->users->UID);
            $user_id = $this->baselibrary->user_id_creation($max_val);
            $today = date('Y-m-d H:i:s');
            $iudata[$this->users->USER_ID] = HA . $user_id;
            $iudata[$this->users->USER_NAME] = $jodata->user_name;
            $iudata[$this->users->EMAIL_ID] = $jodata->user_email;
            $iudata[$this->users->MOBILE_NO] = $jodata->mbl_no;
            $iudata[$this->users->EMP_NO] = $jodata->emp_no;
            $iudata[$this->users->ROLE_CODE] = $jodata->roleid;
            $iudata[$this->users->ORG_BRANCH_ID] = implode(",",$jodata->branch_id);
            $iudata[$this->users->ORG_ID] = $org_id;
            $iudata[$this->users->PSWRD] = $this->bcrypt->hash_password(DFFPASS);
            $iudata[$this->users->STATUS] = ACTIVESTS;
            $role_dtls = $this->basemodel->fetch_single_row($this->orgroles->tbl_name,array($this->orgroles->EROLE_CODE => $iudata[$this->users->ROLE_CODE]));
            $iudata[$this->users->LEVEL] = $role_dtls[$this->orgroles->ESCALATION];
            $iudata[$this->users->START_DATE] = $today;
            $iudata[$this->users->ADDED_ON] = $today;
            $iudata[$this->users->END_DATE] = $enddate = date('9999-m-d H:i:s');
            $iudata[$this->users->ADDED_BY] = $this->session->user_id;
            // $iudata[$this->devicevendors->]
            $this->db->select($this->users->USER_NAME, FALSE);
            $this->db->from($this->db->dbprefix($this->users->tbl_name));
            $this->db->where($this->users->MOBILE_NO, $iudata[$this->users->MOBILE_NO]);
            $this->db->or_where($this->users->EMAIL_ID, $iudata[$this->users->EMAIL_ID]);
            $this->db->or_where($this->users->EMP_NO, $iudata[$this->users->EMP_NO]);
            $result = $this->db->get();
            $user_array = $result->result_array();
            if(empty($user_array))
            {
                if ($this->basemodel->insert_into_table($this->users->tbl_name, $iudata))
                {
                    // $branches =  $jodata->branch_id;
                    //$data['rounds'] = $this->baselibrary->assign_rounds($org_id,$branches,$user_id_assign,$iudata[$this->users->USER_ID]);
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = $jodata->user_name . " Successfully Registered with HospiAsset.";
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = EXISTSDATA;
                $data['call_back'] = "User Already Registered With HospiAsset...!";
            }
        }
        return $data;
    }



    private function _add_new_branch($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $max_val = (int)$this->basemodel->select_max_val($this->branches->tbl_name, $this->branches->BRANCH_AID);
            if ($max_val == "") {
                $max_val = 0;
            }
            $where1[$this->organizations->ORG_ID] = $org_id;
            $select = array($this->organizations->ORG_CODE);
            $organisations = $this->basemodel->fetch_records_from($this->organizations->tbl_name,$where1,$select);
            foreach($organisations as $orgs){
                $org_code  = $orgs[$this->organizations->ORG_CODE];
            }
            $branch_id = $this->baselibrary->user_id_creation($max_val);
            $today = date('Y-m-d H:i:s');
            $ibdata[$this->branches->BRANCH_ID] = $org_code . $branch_id;
            $ibdata[$this->branches->BRANCH_NAME] = $jodata->branch_name;
            $ibdata[$this->branches->BRANCH_CODE] = $jodata->branch_code;
            $ibdata[$this->branches->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
            $ibdata[$this->branches->BRANCH_ADDRESS] = $jodata->branch_address;
            $ibdata[$this->branches->ORG_ID] = $org_id;
            $ibdata[$this->branches->STATUS] = ACTIVESTS;
            $ibdata[$this->branches->ADDED_ON] = $today;
            $ibdata[$this->branches->CITY] = $jodata->city_name;
            $ibdata[$this->branches->ADDED_BY] = $user_id;
            $select = array($this->branches->BRANCH_AID);
            $where[$this->branches->BRANCH_CODE] = $jodata->branch_code;
            $where[$this->branches->ORG_ID] = $org_id;
            $branch_array = $this->basemodel->fetch_single_row($this->branches->tbl_name, $where, $select);
            if (empty($branch_array)) {
                $res = $this->basemodel->insert_into_table($this->branches->tbl_name, $ibdata);
                //return $this->db->last_query();
                if ($res) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = $jodata->branch_name . " Branch Successfully Added To Hospiasset.";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            } else {
                $data['response'] = EXISTSDATA;
                $data['call_back'] = "Branch Code Exists Try With Another Code!";
            }
        }
        return $data;
    }

    private function _get_roles($jodata=array())
    {
        $data = array();
        $select = array($this->roles->ROLE_CODE, $this->roles->ROLE_NAME, $this->roles->ROLE_PRIORITY);
        $roles = $this->basemodel->fetch_records_from($this->roles->tbl_name, array($this->roles->ADDED_BY . " !=" => NULL), $select);
        if (!empty($roles)) {
            $data['response'] = SUCCESSDATA;
            $data['roles'] = $roles;
        } else
            $data['response'] = EMPTYDATA;
        return $data;
    }

    private function _get_org_roles($jodata=array())
    {
        $data = array();
        $select = array($this->orgroles->ROLE_CODE,$this->orgroles->EROLE_CODE, $this->orgroles->ROLE_NAME, $this->orgroles->ROLE_PRIORITY,$this->orgroles->ESCALATION);
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $roles = $this->basemodel->fetch_records_from($this->orgroles->tbl_name,array($this->orgroles->ORG_ID=>$org_id));
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
        $where[$this->rolelabels->ORG_MODULE] = $org_type;
        $where[$this->rolelabels->ORG_ID]  = $org_id;
        $role_labels = $this->basemodel->fetch_single_row($this->rolelabels->tbl_name,$where);
        if (!empty($roles) || !empty($role_labels)) {
            $data['response'] = SUCCESSDATA;
            /*for($i=0;$i<count($roles);$i++)
            {
                $roles[$i]['org_name']=$this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID=>$roles[$i][$this->orgroles->ORG_ID]));
            }*/
            $data['roles'] = $roles;
            $data['labels'] = $role_labels;
        } else
            $data['response'] = EMPTYDATA;

        return $data;
    }

    private function _get_branches($jodata = array())
    {

        $where = array();
        $data = array();
        $where[$this->branches->STATUS] = ACTIVESTS;
        $branch_stat = isset($jodata->branch_stat) ? $jodata->branch_stat : '';
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        //$org_module = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;


        if($jodata->action != 'get_all_branches'){

            if($org_id == 'All')
            {
                $data['response'] = EMPTYDATA;
                return $data;
            }

            $like = array();
            if ($jodata->action != "get_branches_call")
            {
                if($role_code != VENDOR)
                    $where[$this->branches->ORG_ID] = $org_id;
                //  $where[$this->branches->ORG_MODULE] = $org_module;
                else
                    $like[$this->branches->ORG_ID] = $org_id;

            }
            else
                $branch_stat = 'All';
            $select = array($this->branches->BRANCH_ID, $this->branches->BRANCH_NAME);

            if($branch_stat == 'All')
                $data['branchs'] = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where, $select,$this->branches->BRANCH_NAME,'ASC');
            //return $data;

            else {

                $where[$this->users->USER_ID] = $user_id;

                $mydata1 = $this->basemodel->fetch_records_with_like($this->users->tbl_name, $where, $like, array($this->users->ORG_BRANCH_ID, $this->users->ROLE_CODE));

                $mydata1 = $mydata1[0];



                if ($mydata1[$this->users->ORG_BRANCH_ID] != null && $mydata1[$this->users->ROLE_CODE] != VENDOR) {
                    $branches = explode(",", $mydata1[$this->users->ORG_BRANCH_ID]);
                    $branch = array();
                    foreach ($branches as $x)
                        array_push($branch, "'" . $x . "'");
                    $branch = '(' . implode($branch, ',') . ')';
                    $select = array($this->branches->BRANCH_NAME, $this->branches->BRANCH_ID);
                    $or_where = $this->branches->BRANCH_ID . " IN " . $branch;
                    $data['branchs'] = $this->basemodel->fetch_records_from_multi_where($this->branches->tbl_name, array(), $or_where, $select, $this->branches->BRANCH_NAME,'ASC');

                } else if ($mydata1[$this->users->ROLE_CODE] == VENDOR && $mydata1[$this->users->ORG_BRANCH_ID] != null) {
                    $branchs = json_decode($mydata1[$this->users->ORG_BRANCH_ID]);
                    $branchs = $branchs->$org_id;
                    if (count($branchs) > 0) {
                        $branch = array();
                        foreach ($branchs as $x)
                            array_push($branch, "'" . $x . "'");

                        $branch = '(' . implode($branch, ',') . ')';

                        $select = array($this->branches->BRANCH_NAME, $this->branches->BRANCH_ID);
                        $or_where = $this->branches->BRANCH_ID . " IN " . $branch;
                        $cwhere[$this->branches->ORG_ID] = $org_id;
                        //$cwhere[$this->branches->ORG_MODULE] = $org_module;
                        $data['branchs'] = $this->basemodel->fetch_records_from_multi_where($this->branches->tbl_name, $cwhere, $or_where, $select, $this->branches->BRANCH_NAME,'ASC');
                    } else
                        $data['branchs'] = [];
                }
                else if ($mydata1[$this->users->ORG_BRANCH_ID] == null) {
                    $bwhere[$this->branches->ORG_ID] = $org_id;
                    $bwhere[$this->branches->STATUS] = ACTIVESTS;
                    //$bwhere[$this->branches->ORG_MODULE] = $org_module;
                    $select = array($this->branches->BRANCH_NAME, $this->branches->BRANCH_ID);
                    $data['branchs'] = $this->basemodel->fetch_records_from($this->branches->tbl_name, $bwhere, $select,$this->branches->BRANCH_NAME,'ASC');
                }
                else {
                    $select = array($this->branches->BRANCH_NAME, $this->branches->BRANCH_ID);
                    $data['branchs'] = $this->basemodel->fetch_records_from($this->branches->tbl_name, array($this->branches->STATUS => ACTIVESTS), $select,$this->branches->BRANCH_NAME,'ASC');

                }
            }

            if (!empty($data['branchs']))
            {

                if(count($data['branchs']) > 1 && $jodata->action != "get_branches_call")
                {
                    array_unshift ($data['branchs'],array("BRANCH_ID"=>"All","BRANCH_NAME"=>"All"));
                }

                $data['response'] = SUCCESSDATA;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }else{

            $branch_data = $this->basemodel->fetch_records_from($this->branches->tbl_name,array($this->branches->ORG_ID => $this->session->org_id),$this->branches->BRANCH_NAME,'ASC');
            // return $this->db->last_query();
            if($branch_data){
                $data['list'] = $branch_data;
                $data['response'] = SUCCESSDATA;
            }else{
                $data['response'] = EMPTYDATA;
            }
        }

        return $data;
    }

    private function _get_user_branches($jodata=array())
    {
        $where = array();
        $data = array();
        $where[$this->users->ROLE_CODE] = $jodata->role_code;
        $where[$this->users->EMP_NO] = $jodata->empno;
        $where[$this->branches->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $select = array($this->branches->BRANCH_ID,$this->branches->BRANCH_NAME);

        $data['branchs'] = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where, $select);
        if (!empty($data['branchs'])) {
            $data['response'] = SUCCESSDATA;
        } else {
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

    private function _get_branch_users($jodata = array())
    {
        $data = array();

        $where = array();
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $where[$this->users->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
        $select = array($this->users->USER_ID, $this->users->LEVEL, $this->users->USER_NAME, $this->users->EMAIL_ID, $this->users->MOBILE_NO, $this->users->ORG_ID, $this->users->ORG_BRANCH_ID, $this->users->DEPT_CODE, $this->users->EMP_NO, $this->users->ROLE_CODE, $this->users->FEATURES_LIST, $this->users->END_DATE, $this->users->STATUS);

        /*if($role_code !='HMADMIN'){*/

        $or_where = '';
        if($role_code != 'HMADMIN') {
            if($branch_id != 'All')
                $where[$this->users->ORG_BRANCH_ID] = $branch_id;
            else
            {
                $or_where = $this->users->ORG_BRANCH_ID . " IN " .BRANCHALL;
            }
        }
        //}
        //$like[$this->users->ORG_BRANCH_ID] = $branch_id;

        if (isset($jodata->limit_val)) {
            if ($jodata->limit_val != '')
                $limit_val = $jodata->limit_val;
            else
                $limit_val = 0;
            $cnt = $this->basemodel->fetch_records_from_multi_where($this->users->tbl_name, $where, $or_where, 'count(*) as CNT');

            if (!empty($cnt)) {
                $data['no_of_recs'] = $cnt[0]['CNT'];
                $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
            } else {
                $data['no_of_recs'] = 0;
                $data['rcnt'] = 0;
            }
            $data['users'] = $this->basemodel->fetch_records_from_multi_where_pagination($this->users->tbl_name, $where, $or_where, $select,$this->users->ROLE_CODE,'DESC', '10', $limit_val * 10);
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $uwhere[$this->userlabels->ORG_MODULE] = $org_type;
            $uwhere[$this->userlabels->ORG_ID]  = $org_id;

            $user_label = $this->basemodel->fetch_single_row($this->userlabels->tbl_name,$uwhere);


        } else {
            $data['users'] = $this->basemodel->fetch_records_from_multi_where($this->users->tbl_name, $where, $or_where, $select);
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $uwhere[$this->userlabels->ORG_MODULE] = $org_type;
            $uwhere[$this->userlabels->ORG_ID]  = $org_id;

            $user_label = $this->basemodel->fetch_single_row($this->userlabels->tbl_name,$uwhere);



        }

        if (!empty($data['users']) || !empty($user_label)) {
            for ($i = 0; $i < sizeof($data['users']); $i++) {
                $data['users'][$i][$this->orgroles->ROLE_NAME] = $this->basemodel->get_single_column_value($this->orgroles->tbl_name, $this->orgroles->ROLE_NAME, array($this->orgroles->ROLE_CODE => $data['users'][$i][$this->users->ROLE_CODE]));
                $branches = explode(",", $data['users'][$i][$this->users->ORG_BRANCH_ID]);
                for ($j = 0; $j < sizeof($branches); $j++) {
                    $brach_name[] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $branches[$j]));
                }
                $data['users'][$i]['BRANCH_NAMES'] = $brach_name;
                $brach_name = NULL;
            }
            $data['labels']  = $user_label;
            $data['response'] = SUCCESSDATA;

        } else {
            $data['response'] = EMPTYDATA;
        }

        return $data;
    }

    /* Add Vendor*/
    private function _add_new_vendor($jodata = array())
    {

        $data = array();
        if (!empty($jodata))
        {

            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $today = date('Y-m-d H:i:s');
            $max_val = (int)$this->basemodel->select_max_val($this->organizations->tbl_name, $this->organizations->ORG_AID);
            if ($max_val == "")
            {
                $max_val = 0;
            }
            $org = $this->baselibrary->org_id_creation($max_val);
            //  $user_id_assign = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            //$max_val = (int)$this->basemodel->select_max_val($this->users->tbl_name, $this->users->UID);
            // $userid = $this->baselibrary->user_id_creation($max_val);
            $ivdata[$this->devicevendors->ADDED_BY] = $user_id;
            $ivdata[$this->devicevendors->ADDED_ON] = $today;
            $ivdata[$this->devicevendors->NAME] = $jodata->vendor_name;
            if (in_array("OEM", $jodata->type))
            {
                $ivdata[$this->devicevendors->TYPE] = "OEM,Distributor,Support";

            }
            else
            {
                $ivdata[$this->devicevendors->TYPE] = implode(",", $jodata->type);
            }
            if (isset($jodata->email))
                $ivdata[$this->devicevendors->EMAIL_ID] = $jodata->email;

            if (isset($jodata->address))
                $ivdata[$this->devicevendors->ADDRESS] = $jodata->country.'  '.$jodata->states . ' ' . $jodata->cities;
            if (isset($jodata->mbl_no) && $jodata->mbl_no!="")
            {
                $ivdata[$this->devicevendors->MOBILE_NO] = $jodata->mbl_no;

                $vmbl = $this->basemodel->fetch_single_row($this->devicevendors->tbl_name,array($this->devicevendors->MOBILE_NO=>$jodata->mbl_no));
                if(!empty($vmbl))
                {
                    // return $vmbl;
                    $icpdata[$this->contactpersons->BRANCH_ID] = $branch_id;
                    $icpdata[$this->contactpersons->ORG_ID] = $org_id;
                    $icpdata[$this->contactpersons->VENDOR_ID] = $vmbl[$this->devicevendors->ID];
                    $chk_cp_tbl = $this->basemodel->fetch_single_row($this->contactpersons->tbl_name,$icpdata);

                    if (isset($jodata->contact_person_address))
                        $icpdata[$this->contactpersons->CP_ADDRESS] = $jodata->contact_person_address;
                    if (isset($jodata->contact_person))
                        $icpdata[$this->contactpersons->CP_NAME] = $jodata->contact_person;
                    if (isset($jodata->cpemail))
                        $icpdata[$this->contactpersons->CP_EMAIL] = $jodata->cpemail;
                    if (isset($jodata->contact_person_no))
                        $icpdata[$this->contactpersons->CP_NUMBER] = $jodata->contact_person_no;
                    if(!empty($jodata->cp_details))
                    {
                        $cp_dtls['contact_persons'] = $jodata->cp_details;
                        $icpdata[$this->contactpersons->CPS_DETAILS] = json_encode($cp_dtls);
                    }
                    else
                    {
                        $icpdata[$this->contactpersons->CPS_DETAILS] = NULL;
                    }

                    if(empty($chk_cp_tbl))
                    {
                        if($this->basemodel->insert_into_table($this->contactpersons->tbl_name, $icpdata))
                        {
                            $data['call_back'] = "Vendor already exists & contact person added successfully";
                            $data['response'] = SUCCESSDATA;
                        }
                        else
                        {
                            $data['response'] = FAILEDATA;
                            $data['call_back'] = "Unable Process Your Request Try Again...!";
                        }
                    }
                    else
                    {
                        if($this->basemodel->update_operation($icpdata,$this->contactpersons->tbl_name, array($this->contactpersons->ID=>$chk_cp_tbl[$this->contactpersons->ID])))
                        {
                            $data['call_back'] = "Vendor already exists & contact person updated successfully";
                            $data['response'] = SUCCESSDATA;
                        }
                        else
                        {
                            $data['response'] = FAILEDATA;
                            $data['call_back'] = "Unable Process Your Request Try Again...!";
                        }
                    }
                    return $data;
                }

            }


            if ($this->basemodel->insert_into_table($this->devicevendors->tbl_name, $ivdata))

            {
                $iudata[$this->organizations->ORG_ID] = ORG. $org;
                $iudata[$this->organizations->ORG_NAME] = $jodata->vendor_name;
                $iudata[$this->organizations->ORG_TYPE] = "Vendor";
                $iudata[$this->organizations->ROLE_CODE] = HMADMIN;
                $isdata[$this->organizations->ROLE_PATH] = "home.hmadmin_today_calls";
                $isdata[$this->organizations->EROLE_CODE] = ADMIN;
                $iudata[$this->organizations->CP_EMAIL] = $jodata->email;
                $iudata[$this->organizations->CP_NUMBER] = $jodata->mbl_no;
                $iudata[$this->organizations->COUNTRY] = $jodata->country;
                $iudata[$this->organizations->STATE] = $jodata->states;
                $iudata[$this->organizations->CITY] = $jodata->cities;
                $iudata[$this->organizations->ADDED_ON] = $today;
                $iudata[$this->organizations->ADDED_BY] = $user_id;
                $total_menu=array();
                $list =$this->basemodel->fetch_records_from($this->features->tbl_name,array($this->features->STATUS=>ACTIVESTS),
                    array($this->features->MMENU_ID,$this->features->MMENU_TITLE,$this->features->MMENU_PATH,$this->features->MMENU_ICON,$this->features->STATUS));
                foreach($list as $ft){
                    $sub_menu = array();
                    $sub_data=$this->basemodel->fetch_records_from($this->subfeatures->tbl_name,array($this->subfeatures->MMENU_ID => $ft['MMENU_ID'],$this->subfeatures->STATUS => ACTIVESTS),
                        array($this->subfeatures->SMENU_AID,$this->subfeatures->MMENU_ID,$this->subfeatures->SMENU_TITLE,$this->subfeatures->SMENU_PATH,$this->subfeatures->ICON,
                            $this->subfeatures->MENU_PROP,$this->subfeatures->ACTIVITY,$this->subfeatures->STATUS));
                    foreach($sub_data as $sf){
                        $sub_sub_menu = $subsub_data = array();
                        $subdata_array = explode(',',$sf['MENU_PROP']);
                        for ($m = 0; $m < count($subdata_array); $m++) {
                            $fetch_single = $this->basemodel->fetch_single_row($this->ssubfeatures->tbl_name, array($this->ssubfeatures->SSMENU_AID => $subdata_array[$m]));                                    if ($fetch_single) {                                        array_push($sub_sub_menu,array('ssmenu_id' => $fetch_single['SSMENU_AID'],'name'=>$fetch_single['SSMENU_TITLE'],"selected" =>"false"));                                    }                                }                            array_push($sub_menu,array('smenu_id'=>$sf['SMENU_AID'],'name'=>$sf['SMENU_TITLE'],"state"=>$sf['SMENU_PATH'],'activity'=>$sf['ACTIVITY'],'icon'=>ICON_PATH.$sf['ICON'],"selected" =>"false","subsubfeatures" =>$sub_sub_menu));                        }                        array_push($total_menu,array('menu_id'=>$ft['MMENU_ID'],'name'=>$ft['MMENU_TITLE'],'state'=>$ft['MMENU_PATH'],'icon'=>$ft['MMENU_ICON'],"selected" =>"false",'subfeatures'=>$sub_menu));				}                $flist = json_encode(array('menu' => $total_menu));                $iudata[$this->organizations->FEATURES] = $flist;
                if(!empty($jodata->cp_details))
                {
                    $cp_dtls['contact_persons'] = $jodata->cp_details;
                    $iudata[$this->organizations->CP_DETAILS] = json_encode($cp_dtls);
                }
                else
                {
                    $iudata[$this->organizations->CP_DETAILS] = NULL;
                }

                $this->basemodel->insert_into_table($this->organizations->tbl_name, $iudata);

                $icpdata[$this->contactpersons->BRANCH_ID] = $branch_id;
                $icpdata[$this->contactpersons->ORG_ID] = $org_id;
                $icpdata[$this->contactpersons->VENDOR_ID] = $this->db->insert_id();
                if (isset($jodata->contact_person_address))
                    $icpdata[$this->contactpersons->CP_ADDRESS] = $jodata->contact_person_address;
                if (isset($jodata->contact_person))
                    $icpdata[$this->contactpersons->CP_NAME] = $jodata->contact_person;
                if (isset($jodata->cpemail))
                    $icpdata[$this->contactpersons->CP_EMAIL] = $jodata->cpemail;
                if (isset($jodata->contact_person_no))
                    $icpdata[$this->contactpersons->CP_NUMBER] = $jodata->contact_person_no;

                if(!empty($jodata->cp_details))
                {
                    $cp_dtls['contact_persons'] = $jodata->cp_details;
                    $icpdata[$this->contactpersons->CPS_DETAILS] = json_encode($cp_dtls);
                }
                else
                {
                    $icpdata[$this->contactpersons->CPS_DETAILS] = NULL;
                }
                if ($this->basemodel->insert_into_table($this->contactpersons->tbl_name, $icpdata))
                {
                    $data['call_back'] = "Vendor & Contact Person Added Successfully";
                }
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Vendor Added Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }

        return $data;
    }

    private function _get_vendor_list($jodata = array())
    {

        $data = array();
        $where = "";
        if (!empty($jodata)) {

            $qry = "";
            if ($jodata->vendor_name != '')
                $where[$this->devicevendors->NAME] = $jodata->vendor_name;

            if (isset($jodata->type) && !empty($jodata->type)) {
                for ($i = 0; $i < count($jodata->type); $i++) {
                    $qry .= $this->devicevendors->TYPE . " LIKE '%" . $jodata->type[$i] . "%' ";
                    if (end($jodata->type) != $jodata->type[$i]) {
                        $qry .= " OR ";
                    }
                }
            }
            if ($jodata->contact_person != '')
                $where[$this->devicevendors->CP_NAME] = $jodata->contact_person;
            if (isset($jodata->limit_val) && $jodata->limit_val != '')
                $limit_val = $jodata->limit_val;
            else
                $limit_val = 0;
            $cnt = $this->basemodel->fetch_records_from_multi_where($this->devicevendors->tbl_name, $where, $qry, 'count(' . $this->devicevendors->ID . ') AS CNT');

            if (!empty($cnt)) {
                $data['no_of_recs'] = $cnt[0]['CNT'];
                $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
            } else {
                $data['no_of_recs'] = 0;
                $data['rcnt'] = 0;
            }

            $vendors = $this->basemodel->fetch_records_from_multi_where_vndr($this->devicevendors->tbl_name, $where, $qry, '*', $this->devicevendors->NAME, 'ASC', '10', $limit_val * 10);
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $where[$this->vendor_label->ORG_MODULE] = $org_type;
            $where[$this->vendor_label->ORG_ID] = $org_id;
            $select = array($this->vendor_label->NAME,$this->vendor_label->TYPE,$this->vendor_label->EMAIL_ID,$this->vendor_label->MOBILE_NO,$this->vendor_label->CP_NAME,$this->vendor_label->CP_NUMBER,$this->vendor_label->CP_EMAIL,$this->vendor_label->STATUS,$this->vendor_label->ACTION);
            $vendor_label = $this->basemodel->fetch_single_row($this->vendor_label->tbl_name,$where,$select);
            // return $this->db->last_query();
            if (!empty($vendors) || !empty($vendor_label))
            {



                //   $cp_where[$this->contactpersons->BRANCH_ID]= isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
                for ($i = 0; $i < count($vendors); $i++)
                {

                    $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;

                    $or_where = '';
                    $cp_where[$this->contactpersons->ORG_ID]= isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                    if($branch_id != 'All')
                    {
                        $cp_where[$this->contactpersons->BRANCH_ID] = $branch_id;
                    }
                    else
                    {

                        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                        $branchs = $this->basemodel->fetch_records_from($this->branches->tbl_name, array($this->branches->STATUS => ACTIVESTS, $this->branches->ORG_ID => $org_id), $this->branches->BRANCH_ID);
                        for($i = 0; $i < count($branchs); $i++)
                            $branch[$i] = "'".$branchs[$i]['BRANCH_ID']."'";
                        $branch = '(' . implode($branch, ',') . ')';



                        $or_where = $this->contactpersons->BRANCH_ID . " IN " .$branch;

                    }



                    $cp_where[$this->contactpersons->VENDOR_ID]=$vendors[$i][$this->devicevendors->ID];
                    $vendors[$i]['added_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $vendors[$i][$this->devicevendors->ADDED_BY]));
                    //$select = array($this->contactpersons->CPS_DETAILS);

                    $cp_details = $this->basemodel->fetch_single_row_multi_where($this->contactpersons->tbl_name,$cp_where,$or_where,'*');
                    //  return $this->db->last_query();
                    if($cp_details!='-')
                    {

                        $cp_details1 = json_decode($cp_details,TRUE);
                        foreach($cp_details1['contact_persons'] as $cps)
                        {
                            if($cps['priority']==1)
                            {
                                $vendors[$i][$this->devicevendors->CP_NAME] = $cps['contact_person'];
                                $vendors[$i][$this->devicevendors->CP_EMAIL] = $cps['cpemail'];
                                $vendors[$i][$this->devicevendors->CP_NUMBER] = $cps['contact_person_no'];
                                $vendors[$i][$this->contactpersons->CP_ADDRESS] = $cps['contact_person_address'];
                                break;
                            }
                        }
                    }
                    else
                    {
                        $vendors[$i][$this->devicevendors->CP_NAME] = $vendors[$i][$this->devicevendors->CP_EMAIL] = $vendors[$i][$this->devicevendors->CP_NUMBER] = $vendors[$i][$this->contactpersons->CP_ADDRESS] = NULL;
                    }
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $vendors;
                $data['labels'] = $vendor_label;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        //return $this->db->last_query();
        return $data;
    }

    private function _update_vendor($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $today = date('Y-m-d H:i:s');
            $where[$this->devicevendors->ID] = $jodata->ID;
            $ivdata[$this->devicevendors->UPDATED_BY] = $user_id;
            $ivdata[$this->devicevendors->UPDATED_ON] = $today;
            $ivdata[$this->devicevendors->NAME] = $jodata->vendor_name;
            $ivdata[$this->devicevendors->MOBILE_NO] = $jodata->vendor_mbno;
            $ivdata[$this->devicevendors->ADDRESS] = $jodata->address;
            $ivdata[$this->devicevendors->EMAIL_ID] = $jodata->email_id;
            $ivdata[$this->devicevendors->TYPE] = implode(",", $jodata->type);
            //return $ivdata;
            if ($this->basemodel->update_operation($ivdata, $this->devicevendors->tbl_name, $where))
            {
                /*$icpdata[$this->contactpersons->CP_NAME] = $jodata->cp_name;
                $icpdata[$this->contactpersons->CP_NUMBER] = $jodata->cp_number;
                $icpdata[$this->contactpersons->CP_EMAIL] = $jodata->cp_email;
                $icpdata[$this->contactpersons->CP_ADDRESS] = $jodata->cp_address;

                $cpwhere[$this->contactpersons->ORG_ID] = $org_id;
                $cpwhere[$this->contactpersons->BRANCH_ID] = $branch_id;
                $cpwhere[$this->contactpersons->VENDOR_ID] = $jodata->ID;
                $cp_data = $this->basemodel->fetch_single_row($this->contactpersons->tbl_name,$cpwhere);
                if(!empty($cp_data))
                {
                    $this->basemodel->update_operation($icpdata,$this->contactpersons->tbl_name,$cpwhere);
                }
                else
                {
                    $icpdata[$this->contactpersons->ORG_ID]= $cpwhere[$this->contactpersons->ORG_ID];
                    $icpdata[$this->contactpersons->BRANCH_ID]= $cpwhere[$this->contactpersons->BRANCH_ID];
                    $icpdata[$this->contactpersons->VENDOR_ID]= $cpwhere[$this->contactpersons->VENDOR_ID];
                    $this->basemodel->insert_into_table($this->contactpersons->tbl_name,$icpdata);
                }*/
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Vendor Updated Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _update_city($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $city = $this->basemodel->get_single_column_value($this->cities->tbl_name,$this->cities->CITY_CODE,array($this->cities->CITY_CODE=>$jodata->city_code));
            if(!empty($city)) {
                $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
                $today = date('Y-m-d H:i:s');
                $where[$this->cities->CITY_ID] = $jodata->CITY_ID;
                $ivdata[$this->cities->UPDATED_BY] = $user_id;
                $ivdata[$this->cities->UPDATED_ON] = $today;
                $ivdata[$this->cities->CITY_NAME] = $jodata->city_name;
                $ivdata[$this->cities->CITY_CODE] = $jodata->city_code;
                $ivdata[$this->cities->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($ivdata, $this->cities->tbl_name, $where)) {
                    //$data['qry'] = $this->db->last_query();
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = " City Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $ivdata[$this->cities->CITY_CODE]. " City Code Already Exists";
                }
            }else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _update_country($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {

            $country = $this->basemodel->get_single_column_value($this->country->tbl_name,$this->country->COUNTRY_CODE,array($this->country->COUNTRY_CODE=>$jodata->country_code));
            if(!empty($country)) {
                $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
                $today = date('Y-m-d H:i:s');
                $where[$this->country->	COUNTRY_ID] = $jodata->COUNTRY_ID;
                $ivdata[$this->country->UPDATED_BY] = $user_id;
                $ivdata[$this->country->UPDATED_ON] = $today;
                $ivdata[$this->country->COUNTRY_NAME] = $jodata->country_name;
                $ivdata[$this->country->COUNTRY_CODE] = $jodata->country_code;
                $ivdata[$this->country->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($ivdata, $this->country->tbl_name, $where)) {
                    //$data['qry'] = $this->db->last_query();
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = " Country Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $ivdata[$this->country->COUNTRY_CODE]." Country Code Already Exists";
                }
            }else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";


            }
        }
        return $data;
    }
    private function _update_state($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $state = $this->basemodel->get_single_column_value($this->state->tbl_name,$this->state->STATE_CODE,array($this->state->STATE_CODE=>$jodata->state_code));
            if(!empty($state)) {
                $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
                $today = date('Y-m-d H:i:s');
                $where[$this->state->STATE_ID] = $jodata->STATE_ID;
                $ivdata[$this->state->UPDATED_BY] = $user_id;
                $ivdata[$this->state->UPDATED_ON] = $today;
                $ivdata[$this->state->STATE_NAME] = $jodata->state_name;
                $ivdata[$this->state->STATE_CODE] = $jodata->state_code;
                $ivdata[$this->state->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($ivdata, $this->state->tbl_name, $where)) {
                    $data['qry'] = $this->db->last_query();
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "State Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $ivdata[$this->state->STATE_CODE]." State Code Already Exists";
                }
            }else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable To Process Your Request..!";
            }
        }
        return $data;
    }

    private function _add_new_city($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $city = $this->basemodel->get_single_column_value($this->cities->tbl_name, $this->cities->CITY_CODE, array($this->cities->CITY_CODE => $jodata->city_code));
            if ($city == "-") {

                $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
                $today = date('Y-m-d H:i:s');
                $icdata[$this->cities->ADDED_BY] = $user_id;
                $icdata[$this->cities->ADDED_ON] = $today;
                $icdata[$this->cities->CITY_NAME] = $jodata->city_name;
                $icdata[$this->cities->CITY_CODE] = $jodata->city_code;
                $icdata[$this->cities->STATE_CODE] = $jodata->states;
                $icdata[$this->cities->COUNTRY_CODE] = $jodata->country;
                if ($this->basemodel->insert_into_table($this->cities->tbl_name, $icdata))
                {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "City Added Successfully";
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable To Process Your Request..!";
                }
            }else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] =  $jodata->city_code. "City Code Already Exists!, Please Try with Another Code";
            }
        }
        return $data;
    }

    private function _add_new_module($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {

            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $today = date('Y-m-d H:i:s');
            $icdata[$this->modules->ADDED_BY] = $user_id;
            $icdata[$this->modules->ADDED_ON] = $today;
            $icdata[$this->modules->MODULE_NAME] = strtoupper($jodata->module_name);
            $icdata[$this->modules->MODULE_TABLE] = "hsp_tbl_".$jodata->module_name;

            $res = $this->basemodel->insert_into_table($this->modules->tbl_name, $icdata);
            //return $this->db->last_query();
            //$last_id =  $this->db->insert_id();
            //return $last_id;
            if ($res)
            {
                $qry = "CREATE TABLE `".$icdata[$this->modules->MODULE_TABLE]. "` (
    TBL_ID int NOT NULL AUTO_INCREMENT,
	MODULE_ID varchar(111),
    ADDEDE_BY varchar(111) NOT NULL,
    ADDED_ON varchar(111),
	UPDATED_BY Varchar(111),
	E_ID   varchar(111),
	ASSIGN_ID varchar(111),
	USERNAME  varchar(111),
	QR_CODE   varchar(111),
	ORIGINAL_ID varchar(111),
	IMPORT_EID  varchar(111),
	ORG_ID      varchar(111),
	BRANCH_RELOCATION varchar(111),
	RELOCATION_STATUS  varchar(111),
	STATUS ENUM('A','I') DEFAULT 'A',
    PRIMARY KEY (TBL_ID)
);";
                //return $qry;
                $qwr = $this->basemodel->executeqry($qry);

                /*$tbl_data[$this->table_names->TABLE_NAME] = "hsp_tbl_".$icdata[$this->modules->MODULE_NAME];
                $tbl_data[$this->table_names->TABLE_DESC] = strtoupper($icdata[$this->modules->MODULE_NAME]);
                $tbl_data[$this->table_names->ORG_MODULE] =   $last_id;
                $result = $this->basemodel->insert_into_table($this->table_names->tbl_name, $tbl_data);*/
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Module Added Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable to Added Module";
            }
        }
        return $data;
    }





    private function _get_city_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from($this->cities->tbl_name,'','count('.$this->cities->CITY_ID.') AS CNT');
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
                $cities = $this->basemodel->fetch_records_from_pagination($this->cities->tbl_name,array(),'*',$this->cities->CITY_NAME,'asc','10',$limit_val*10);
            }
            else
            {
                $cities = $this->basemodel->fetch_records_from($this->cities->tbl_name,'','*',$this->cities->CITY_NAME);
            }

            if(!empty($cities))
            {
                for ($i = 0; $i < count($cities); $i++)
                {
                    $cities[$i]['added_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $cities[$i][$this->cities->ADDED_BY]));
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $cities;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _get_country_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from($this->country->tbl_name,'','count('.$this->country->COUNTRY_ID.') AS CNT');
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
                $countires = $this->basemodel->fetch_records_from_pagination($this->country->tbl_name,'','*',$this->country->COUNTRY_NAME,'asc','10',$limit_val*10);
            }
            else
            {
                $countires = $this->basemodel->fetch_records_from($this->country->tbl_name);
            }
            if (!empty($countires))
            {
                for ($i = 0; $i < count($countires); $i++) {
                    $countires[$i]['added_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $countires[$i][$this->country->ADDED_BY]));
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $countires;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    /* private function _get_country_list($jodata = array())
     {
         $data = array();
         if (!empty($jodata))
         {
             if(isset($jodata->limit_val))
             {
                 if($jodata->limit_val!='')
                     $limit_val = $jodata->limit_val;
                 else
                     $limit_val = 0;
                 $cnt = $this->basemodel->fetch_records_from($this->country->tbl_name,array($this->country->STATUS=>ACTIVE),'count('.$this->country->COUNTRY_ID.') AS CNT');
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
                 $countires = $this->basemodel->fetch_records_from_pagination($this->country->tbl_name,array(),'*',$this->country->COUNTRY_NAME,'asc','10',$limit_val*10);
             }
             else
             {
                 $countires = $this->basemodel->fetch_records_from($this->country->tbl_name);
             }
             if (!empty($countires))
             {
                 for ($i = 0; $i < count($countires); $i++) {
                     $countires[$i]['added_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $countires[$i][$this->country->ADDED_BY]));
                 }
                 $data['response'] = SUCCESSDATA;
                 $data['list'] = $countires;
             } else {
                 $data['response'] = EMPTYDATA;
                 $data['list'] = NULL;
             }
         }
         return $data;
     }*/
    private function _get_states_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from($this->state->tbl_name,'','count('.$this->state->STATE_ID.') AS CNT');
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
                $state = $this->basemodel->fetch_records_from_pagination($this->state->tbl_name,array(),'*',$this->state->STATE_NAME,'asc','10',$limit_val*10);
            }
            else
            {
                $state= $this->basemodel->fetch_records_from($this->state->tbl_name);
            }

            if (!empty($state)) {
                for ($i = 0; $i < count($state); $i++) {
                    $state[$i]['added_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $state[$i][$this->state->ADDED_BY]));
                    $state[$i]['country_name'] = $this->basemodel->get_single_column_value($this->country->tbl_name, $this->country->COUNTRY_NAME, array($this->country->COUNTRY_CODE => $state[$i][$this->state->COUNTRY_CODE]));
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $state;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _get_contract_type_list($jodata = array())
    {
        /*$data = array();
         if (!empty($jodata)) {
             if (isset($jodata->limit_val)) {
                 if ($jodata->limit_val != '')
                     $limit_val = $jodata->limit_val;
                 else
                     $limit_val = 0;
                 $cnt = $this->basemodel->fetch_records_from_multi_where($this->contracttypes->tbl_name, array(), '', 'count(' . $this->contracttypes->ID . ') AS CNT');
                 if (!empty($cnt)) {
                     $data['no_of_recs'] = $cnt[0]['CNT'];
                     $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                 } else {
                     $data['no_of_recs'] = 0;
                     $data['rcnt'] = 0;
                 }
                 $ctypes = $this->basemodel->fetch_records_from_pagination($this->contracttypes->tbl_name, '', '*', $this->contracttypes->CTYPE, 'ASC', '10', $limit_val * 10);

             } else {
                 $ctypes = $this->basemodel->fetch_records_from($this->contracttypes->tbl_name);
             }

             if (!empty($ctypes)) {
                 //$data['qry'] = $this->db->last_query();
                 $data['response'] = SUCCESSDATA;
                 $data['list'] = $ctypes;
             } else {
                 $data['response'] = EMPTYDATA;
                 $data['list'] = NULL;
             }
         }
         return $data;*/


        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                $ccwhere[$this->contracttypes->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->contracttypes->tbl_name, $ccwhere, '', 'count(' . $this->contracttypes->ID . ') AS CNT');
              //  return $cnt;               
			   if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $cewhere[$this->contracttypes->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $ctypes = $this->basemodel->fetch_records_from_pagination($this->contracttypes->tbl_name, $cewhere, '*', $this->contracttypes->CTYPE, 'ASC', '10', $limit_val * 10);
                //$org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->contracttypelabels->ORG_MODULE] =  isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $ctypes_label = $this->basemodel->fetch_single_row($this->contracttypelabels->tbl_name,$where);
               // return $ctypes_label;
            } else {
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $where[$this->contracttypelabels->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                //$where[$this->contracttypelabels->ORG_ID] = $org_id;
                $cewhere[$this->contracttypes->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $ctypes = $this->basemodel->fetch_records_from($this->contracttypes->tbl_name,$cewhere);
                $cselect = array($this->contracttypelabels->CTYPE,$this->contracttypelabels->CFORM,$this->contracttypelabels->STATUS,$this->contracttypelabels->ACTION);
                $ctypes_label = $this->basemodel->fetch_single_row($this->contracttypelabels->tbl_name,$where,$cselect);

            }

            if (!empty($ctypes) || !empty($ctypes_label)) {
                // $ctypelabel = array_merge($ctypes_label,$ctypes);

                $data['response'] = SUCCESSDATA;
                $data['list'] = $ctypes;
                $data['labels'] = $ctypes_label;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _add_contract_type($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
            $contract_type = $this->basemodel->get_single_column_value($this->contracttypes->tbl_name,$this->contracttypes->CFORM,array($this->contracttypes->CFORM=>$jodata->contract_code));
            if($contract_type=="-") {

                $icdata[$this->contracttypes->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $icdata[$this->contracttypes->CTYPE] = $jodata->contract_type;
                $icdata[$this->contracttypes->CFORM] = strtoupper($jodata->contract_code);

                $res = $this->basemodel->insert_into_table($this->contracttypes->tbl_name, $icdata);
                if ($res) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Contract Type Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->contract_code." Contract Type Code Already Exists";
            }
        }

        log_message('error',$this->db->last_query());
        return $data;
    }

    private function _update_contract_type($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $contract_type = $this->basemodel->get_single_column_value($this->contracttypes->tbl_name,$this->contracttypes->CFORM,array($this->contracttypes->CFORM=>$jodata->ctype_code));
            if(!empty($contract_type)) {
                $where[$this->contracttypes->ID] = $jodata->ID;
                $icdata[$this->contracttypes->CTYPE] = $jodata->ctype_name;
                $icdata[$this->contracttypes->CFORM] = $jodata->ctype_code;
                $icdata[$this->contracttypes->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($icdata, $this->contracttypes->tbl_name, $where))
                {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = " Contract Type Updated Successfully";
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] =  $icdata[$this->contracttypes->CFORM]." Contract Type Code Already Exists";

                }
            }else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable To Process Please Try Again..!";

            }
        }
        return $data;
    }


    private function _get_status_list($jodata = array())
    {
        /* $data = array();
         if (!empty($jodata)) {
             if (isset($jodata->limit_val)) {
                 if ($jodata->limit_val != '')
                     $limit_val = $jodata->limit_val;
                 else
                     $limit_val = 0;
                 $cnt = $this->basemodel->fetch_records_from_multi_where($this->status->tbl_name, array(), '', 'count(' . $this->status->ID . ') AS CNT');
                 if (!empty($cnt)) {
                     $data['no_of_recs'] = $cnt[0]['CNT'];
                     $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                 } else {
                     $data['no_of_recs'] = 0;
                     $data['rcnt'] = 0;
                 }
                 $status = $this->basemodel->fetch_records_from_pagination($this->status->tbl_name, '', '*', $this->status->STATUS, 'ASC', '10', $limit_val * 10);

             } else {
                 $status = $this->basemodel->fetch_records_from($this->status->tbl_name);
             }
             if (!empty($status)) {
                 //$data['qry'] = $this->db->last_query();
                 $data['response'] = SUCCESSDATA;
                 $data['list'] = $status;
             } else {
                 $data['response'] = EMPTYDATA;
                 $data['list'] = NULL;
             }
         }
         return $data;
         */

        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->status->tbl_name, array(), '', 'count(' . $this->status->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

                $status = $this->basemodel->fetch_records_from_pagination($this->status->tbl_name, '', '*', $this->status->STATUS, 'ASC', '10', $limit_val * 10);
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));

                $where[$this->statuslabels->ORG_MODULE] = $org_type;
                $where[$this->statuslabels->ORG_ID]  = $org_id;
                $dselect = array($this->statuslabels->STATUS,$this->statuslabels->SCODE,$this->statuslabels->STATUSS,$this->statuslabels->ACTION);
                $status_labels = $this->basemodel->fetch_single_row($this->statuslabels->tbl_name,$where,$dselect);



            } else {
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->statuslabels->ORG_ID]  = $org_id;
                $where[$this->statuslabels->ORG_MODULE] = $org_type;



                $status = $this->basemodel->fetch_records_from($this->status->tbl_name);

                $dselect = array($this->statuslabels->STATUS,$this->statuslabels->SCODE,$this->statuslabels->STATUSS,$this->statuslabels->ACTION);
                $status_labels = $this->basemodel->fetch_single_row($this->statuslabels->tbl_name,$where,$dselect);

            }

            if (!empty($status) || !empty($status_labels)) {
                // $ctypelabel = array_merge($ctypes_label,$ctypes);

                $data['response'] = SUCCESSDATA;

                $data['list'] = $status;
                $data['labels'] = $status_labels;
            } else {
                $data['response'] = EMPTYDATA;

                $data['labels'] = NULL;
            }
        }
        return $data;


    }

    private function _add_status($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {

            $status = $this->basemodel->get_single_column_value($this->status->tbl_name,$this->status->SCODE,array($this->status->SCODE=>$jodata->status_code));
            if($status=="-") {

                $isdata[$this->status->STATUS] = $jodata->status;
                $isdata[$this->status->SCODE] = $jodata->status_code;
                $res = $this->basemodel->insert_into_table($this->status->tbl_name, $isdata);
                if ($res) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = " Status Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->status_code." Status Code Already Exists";
            }
        }
        return $data;
    }

    private function _update_staus($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $status = $this->basemodel->get_single_column_value($this->status->tbl_name, $this->status->SCODE, array($this->status->SCODE => $jodata->status_code));
            if (!empty($status)) {

                $where[$this->status->ID] = $jodata->ID;
                $icdata[$this->status->STATUS] = $jodata->status;
                $icdata[$this->status->SCODE] = $jodata->status_code;
                $icdata[$this->status->STATUSS] = $jodata->statuss;

                if ($this->basemodel->update_operation($icdata, $this->status->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Status Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $icdata[$this->status->SCODE] . " Status Code Already Exists";
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _get_equp_cond($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $where[$this->equpconditions->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->equpconditions->tbl_name, $where, '', 'count(' . $this->equpconditions->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $econd = $this->basemodel->fetch_records_from_pagination($this->equpconditions->tbl_name, $where, '*', $this->equpconditions->ECODE, 'ASC', '10', $limit_val * 10);
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->equpcondlabels->ORG_MODULE] = $org_type;
                $where[$this->equpcondlabels->ORG_ID] = $org_id;
                $select = array($this->equpcondlabels->ECODE,$this->equpcondlabels->EVAL,$this->equpcondlabels->STATUS,$this->equpcondlabels->ACTION);
                $econd_label = $this->basemodel->fetch_single_row($this->equpcondlabels->tbl_name,$where,$select);
            } else {
                $econd = $this->basemodel->fetch_records_from($this->equpconditions->tbl_name,$where);
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->equpcondlabels->ORG_MODULE] = $org_type;
                $where[$this->equpcondlabels->ORG_ID] = $org_id;
                $select = array($this->equpcondlabels->ECODE,$this->equpcondlabels->EVAL,$this->equpcondlabels->STATUS,$this->equpcondlabels->ACTION);
                $econd_label = $this->basemodel->fetch_single_row($this->equpcondlabels->tbl_name,$where,$select);

            }
            if (!empty($econd) || !empty($econd_label)) {
                // $data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $econd;
                $data['labels'] = $econd_label;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
                $data['labels'] = NULL;
            }
        }
        return $data;
    }

    private function _add_equp_condition($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $equp_cond = $this->basemodel->get_single_column_value($this->equpconditions->tbl_name,$this->equpconditions->EVAL,array($this->equpconditions->EVAL=>$jodata->equp_code));
            if($equp_cond=="-") {
                $isdata[$this->equpconditions->ECODE] = $jodata->equp_condition;
                $isdata[$this->equpconditions->EVAL] = $jodata->equp_code;
                $isdata[$this->equpconditions->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                if ($this->basemodel->insert_into_table($this->equpconditions->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = " Equipment Condition Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->equp_code." Equipment Code Already Exists";
            }
        }
        return $data;
    }


    private function _update_equp_cond($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $equp_cond = $this->basemodel->get_single_column_value($this->equpconditions->tbl_name, $this->equpconditions->EVAL, array($this->equpconditions->EVAL => $jodata->equp_code));
            if (!empty($equp_cond)) {

                $where[$this->equpconditions->ID] = $jodata->ID;
                $icdata[$this->equpconditions->ECODE] = $jodata->equp_condition;
                $icdata[$this->equpconditions->EVAL] = $jodata->equp_code;
                $icdata[$this->equpconditions->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($icdata, $this->equpconditions->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = " Equipment Condition Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $icdata[$this->equpconditions->EVAL]." Equipment Code Already Exists";
                }

            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _get_equip_class($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->equpclass->tbl_name, array(), '', 'count(' . $this->equpclass->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $eclass = $this->basemodel->fetch_records_from_pagination($this->equpclass->tbl_name, '', '*', $this->equpclass->EQ_CLASS, 'ASC', '10', $limit_val * 10);

            } else {
                $eclass = $this->basemodel->fetch_records_from($this->equpclass->tbl_name);
            }

            if (!empty($eclass)) {
                // $data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $eclass;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _add_equp_class($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {

            $equp_class = $this->basemodel->get_single_column_value($this->equpclass->tbl_name,$this->equpclass->EQ_CODE,array($this->equpclass->EQ_CODE=>$jodata->eq_code));
            if($equp_class=="-") {
                $isdata[$this->equpclass->EQ_CLASS] = $jodata->equp_class;
                $isdata[$this->equpclass->EQ_CODE] = $jodata->eq_code;

                if ($this->basemodel->insert_into_table($this->equpclass->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = " Equipment Class Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->eq_code." Equipment Class Code Already Exists";
            }
        }
        return $data;
    }


    private function _update_equp_class($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {

            $equp_class = $this->basemodel->get_single_column_value($this->equpclass->tbl_name, $this->equpclass->EQ_CODE, array($this->equpclass->EQ_CODE => $jodata->eclass_code));
            if (!empty($equp_class)) {
                $where[$this->equpclass->ID] = $jodata->ID;
                $icdata[$this->equpclass->EQ_CLASS] = $jodata->equp_class;
                $icdata[$this->equpclass->EQ_CODE] = $jodata->eclass_code;
                $icdata[$this->equpclass->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($icdata, $this->equpclass->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = " Equipment Class Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $icdata[$this->equpclass->EQ_CODE] . " Equipment Class Code Already Exists";

                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _get_utilization_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $utilwhere[$this->utillvalues->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;


                $cnt = $this->basemodel->fetch_records_from($this->utillvalues->tbl_name, $utilwhere,'count(' . $this->utillvalues->ID . ') AS CNT');

                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->devicelabels->ORG_MODULE] = $org_type;
                $where[$this->devicelabels->ORG_ID] = $org_id;
                $where[$this->devicelabels->TABLE_NAME] = "Utilization";

                $select = array($this->devicelabels->LABEL_1,$this->devicelabels->LABEL_2,$this->devicelabels->LABEL_3,$this->devicelabels->LABEL_4);
                $label_utlization = $this->basemodel->fetch_single_row($this->devicelabels->tbl_name,$where,$select);

                $utilwhere[$this->utillvalues->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $utlization = $this->basemodel->fetch_records_from_pagination($this->utillvalues->tbl_name, $utilwhere, '*', $this->utillvalues->ID, 'ASC', '10', $limit_val * 10);

            }
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
            $where[$this->devicelabels->ORG_MODULE] = $org_type;
            $where[$this->devicelabels->ORG_ID] = $org_id;
            $where[$this->devicelabels->TABLE_NAME] = "Utilization";

            $select = array($this->devicelabels->LABEL_1,$this->devicelabels->LABEL_2,$this->devicelabels->LABEL_3,$this->devicelabels->LABEL_4);
            $label_utlization = $this->basemodel->fetch_single_row($this->devicelabels->tbl_name,$where,$select);
            $utilwhere[$this->utillvalues->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
            $utlization = $this->basemodel->fetch_records_from($this->utillvalues->tbl_name,$utilwhere);
            if (!empty($utlization) || !empty($label_utlization)) {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $utlization;
                $data['labels'] = $label_utlization;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
                $data['labels'] = NULL;
            }
        }
        return $data;
    }


    private function _add_utill_value($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $util_value = $this->basemodel->get_single_column_value($this->utillvalues->tbl_name,$this->utillvalues->VALUE,array($this->utillvalues->VALUE=>$jodata->util_value));
            if($util_value=="-") {

                $isdata[$this->utillvalues->NAME] = $jodata->util_name;
                $isdata[$this->utillvalues->VALUE] = $jodata->util_value;
                $isdata[$this->utillvalues->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                if ($this->basemodel->insert_into_table($this->utillvalues->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Utilization Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['qry'] = $this->db->last_query();
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->util_value." Utilization Value Already Exists";
            }

        }
        return $data;
    }


    private function _update_utill_values($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $util_value = $this->basemodel->get_single_column_value($this->utillvalues->tbl_name, $this->utillvalues->VALUE, array($this->utillvalues->VALUE => $jodata->equp_value));
            // return $this->db->last_query();
            if (!empty($util_value)) {

                $where[$this->utillvalues->ID] = $jodata->ID;
                $icdata[$this->utillvalues->NAME] = $jodata->equp_utill;
                $icdata[$this->utillvalues->VALUE] = $jodata->equp_value;
                $icdata[$this->utillvalues->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($icdata, $this->utillvalues->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Utilization Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] =   $icdata[$this->utillvalues->VALUE] . " Utilization Value Already Exists";
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }


    private function _get_training_type_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->trainingtypes->tbl_name, array(), '', 'count(' . $this->trainingtypes->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $ttype = $this->basemodel->fetch_records_from_pagination($this->trainingtypes->tbl_name, '', '*', $this->trainingtypes->TRAINING_TYPE, 'ASC', '10', $limit_val * 10);
            } else {
                $ttype = $this->basemodel->fetch_records_from($this->trainingtypes->tbl_name);
            }
            if (!empty($ttype)) {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $ttype;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _add_training_type($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {


            $training_type = $this->basemodel->get_single_column_value($this->trainingtypes->tbl_name,$this->trainingtypes->CODE,array($this->trainingtypes->CODE=>$jodata->training_code));
            if($training_type=="-")
            {
                $isdata[$this->trainingtypes->TRAINING_TYPE] = $jodata->training_type;
                $isdata[$this->trainingtypes->CODE] = $jodata->training_code;

                if ($this->basemodel->insert_into_table($this->trainingtypes->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Training Types Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->training_code." Training Type Code Already Exists";
            }
        }
        return $data;
    }

    private function _update_training_type($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $training_type = $this->basemodel->get_single_column_value($this->trainingtypes->tbl_name,$this->trainingtypes->CODE,array($this->trainingtypes->CODE=>$jodata->training_code));
            if($training_type=="-")
            {
                $where[$this->trainingtypes->ID] = $jodata->ID;
                $icdata[$this->trainingtypes->TRAINING_TYPE] = $jodata->traing_type;
                $icdata[$this->trainingtypes->CODE] = $jodata->traing_type_code;
                $icdata[$this->trainingtypes->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($icdata, $this->trainingtypes->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Training Types Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $icdata[$this->trainingtypes->CODE]." Training Type Code Already Exists";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] =  "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }


    private function _get_depts_list($jodata = array())
    {

        /*$data = array();
         if (!empty($jodata)) {

             if (isset($jodata->limit_val)) {
                 if ($jodata->limit_val != '')
                     $limit_val = $jodata->limit_val;
                 else
                     $limit_val = 0;

                 $where = array();
                 if(isset($jodata->deptid))
                 {
                     if($jodata->deptid != '')
                     {
                         $where[$this->userdeprts->ID] = $jodata->deptid;
                     }
                 }

                 $cnt = $this->basemodel->fetch_records_from_multi_where($this->userdeprts->tbl_name, $where, '', 'count(' . $this->userdeprts->ID . ') AS CNT');

                 if (!empty($cnt)) {
                     $data['no_of_recs'] = $cnt[0]['CNT'];
                     $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                 } else {
                     $data['no_of_recs'] = 0;
                     $data['rcnt'] = 0;
                 }

                 $depts = $this->basemodel->fetch_records_from_pagination($this->userdeprts->tbl_name, $where, '*', $this->userdeprts->ID, 'ASC', '10', $limit_val * 10);
                 //return $this->db->last_query();
             } else {
                 $depts = $this->basemodel->fetch_records_from($this->userdeprts->tbl_name);
             }
             if (!empty($depts)) {
                 //$data['qry'] = $this->db->last_query();
                 $data['response'] = SUCCESSDATA;
                 $data['list'] = $depts;
             } else {
                 $data['response'] = EMPTYDATA;
                 $data['list'] = NULL;
             }
         }
         return $data;*/


        $data = array();
        if (!empty($jodata)) {

            if (isset($jodata->limit_val)) {
                $where = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                // return $where;
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;

                $where = array();
                if(isset($jodata->deptid))
                {
                    if($jodata->deptid != '')
                    {
                        $where[$this->userdeprts->ID] = $jodata->deptid;
                    }
                }

                $cnt = $this->basemodel->fetch_records_from_multi_where($this->userdeprts->tbl_name, $where, '', 'count(' . $this->userdeprts->ID . ') AS CNT');

                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }

                $depts = $this->basemodel->fetch_records_from_pagination($this->userdeprts->tbl_name, $where, '*', $this->userdeprts->ID, 'ASC', '10', $limit_val * 10);
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $swhere[$this->departmentlabels->ORG_MODULE] = $org_type;
                $swhere[$this->departmentlabels->ORG_ID]  = $org_id;
                $depart_labels = $this->basemodel->fetch_single_row($this->departmentlabels->tbl_name,$swhere);



            } else {
                $where = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $depts = $this->basemodel->fetch_records_from($this->userdeprts->tbl_name,$where);
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $swhere[$this->departmentlabels->ORG_MODULE] = $org_type;
                $swhere[$this->departmentlabels->ORG_ID]  = $org_id;
                $depart_labels = $this->basemodel->fetch_single_row($this->departmentlabels->tbl_name,$swhere);

            }
            if (!empty($depts) || !empty($depart_labels)) {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $depts;
                $data['labels'] = $depart_labels;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;



    }
    private function _add_departments($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $dept_data = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name,$this->userdeprts->CODE,array($this->userdeprts->CODE=>$jodata->dept_code));
            if($dept_data=="-")
            {

                $isdata[$this->userdeprts->ORG_MODULE] =  isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $isdata[$this->userdeprts->USER_DEPT_NAME] = $jodata->department;
                $isdata[$this->userdeprts->CODE] = $jodata->dept_code;


                if ($this->basemodel->insert_into_table($this->userdeprts->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Departments Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->dept_code." Department CODE Already Exists";
            }
        }
        return $data;
    }

    private function _update_department($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $dept_data = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name,$this->userdeprts->CODE,array($this->userdeprts->CODE=>$jodata->code));
            //return $dept_data;
            if(!empty($dept_data))
            {
                $where[$this->userdeprts->ID] = $jodata->ID;
                $icdata[$this->userdeprts->USER_DEPT_NAME] = $jodata->departments;
                $icdata[$this->userdeprts->CODE] = $jodata->code;
                $icdata[$this->userdeprts->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($icdata, $this->userdeprts->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Department Updated Successfully";
                }  else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $icdata[$this->userdeprts->CODE]." Department CODE Already Exists";
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

    private function _get_reasons_list($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->reasons->tbl_name,array(), '', 'count(' . $this->reasons->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }


                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $rwhere[$this->reasons->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $reasons = $this->basemodel->fetch_records_from_pagination($this->reasons->tbl_name,$rwhere, '*', $this->reasons->COMPLANT_NAME, 'ASC', '10', $limit_val * 10);

            } else {
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $rwhere[$this->reasons->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $reasons = $this->basemodel->fetch_records_from($this->reasons->tbl_name,$rwhere);

            }

            if (!empty($reasons)) {

                $data['response'] = SUCCESSDATA;
                $data['list'] =   $reasons;
                //$data['labels'] = $label_reasons;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
                //$data['labels'] = NULL;
            }
        }
        return $data;
    }

    private function _get_nonscheduled_reasons_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->nonscheduledreasons->tbl_name, array(), '', 'count(' . $this->nonscheduledreasons->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $reasons = $this->basemodel->fetch_records_from_pagination($this->nonscheduledreasons->tbl_name, '', '*', $this->nonscheduledreasons->REASON, 'ASC', '10', $limit_val * 10);

            } else {
                $reasons = $this->basemodel->fetch_records_from($this->nonscheduledreasons->tbl_name);
            }

            if (!empty($reasons)) {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $reasons;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }


    private function _add_reasons($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $reason = $this->basemodel->get_single_column_value($this->reasons->tbl_name, $this->reasons->COMPLANT_NAME, array($this->reasons->COMPLANT_NAME => $jodata->reason));
            if ($reason == "-") {
                $isdata[$this->reasons->COMPLANT_NAME] = $jodata->reason;
                $isdata[$this->reasons->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;

                if ($this->basemodel->insert_into_table($this->reasons->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Reasons Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->reason." Reason Already Exists";
            }
        }
        return $data;
    }

    private function _add_non_scheduled($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $reason = $this->basemodel->get_single_column_value($this->nonscheduledreasons->tbl_name, $this->nonscheduledreasons->CODE, array($this->nonscheduledreasons->CODE => $jodata->code));
            if ($reason == "-") {
                $isdata[$this->nonscheduledreasons->REASON] = $jodata->reason;

                if ($this->basemodel->insert_into_table($this->nonscheduledreasons->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Reasons Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->reason." Reason Already Exists";
            }
        }
        return $data;
    }





    private function _update_reasons($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $reason = $this->basemodel->get_single_column_value($this->reasons->tbl_name, $this->reasons->COMPLANT_NAME, array($this->reasons->COMPLANT_NAME => $jodata->reason));
            if (!empty($reason)) {
                $where[$this->reasons->ID] = $jodata->ID;
                $icdata[$this->reasons->COMPLANT_NAME] = $jodata->reason;
                $icdata[$this->reasons->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($icdata, $this->reasons->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Reasons Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $icdata[$this->reasons->COMPLANT_NAME] . " Reason Already Exists";
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _update_non_reasons($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $reason = $this->basemodel->get_single_column_value($this->nonscheduledreasons->tbl_name, $this->nonscheduledreasons->REASON, array($this->nonscheduledreasons->REASON => $jodata->reason));
            if (!empty($reason)) {
                $where[$this->nonscheduledreasons->ID] = $jodata->ID;
                $icdata[$this->nonscheduledreasons->REASON] = $jodata->reason;
                $icdata[$this->nonscheduledreasons->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($icdata, $this->nonscheduledreasons->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Reasons Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $icdata[$this->nonscheduledreasons->REASON] . " Reason Already Exists";
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }




    private function _get_levels_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->levels->tbl_name, array(), '', 'count(' . $this->levels->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $levels = $this->basemodel->fetch_records_from_pagination($this->levels->tbl_name, '', '*', $this->levels->LEVEL_NAME, 'ASC', '10', $limit_val * 10);

                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->esclevellabels->ORG_MODULE] = $org_type;
                $where[$this->esclevellabels->ORG_ID]  = $org_id;
                $level_labels = $this->basemodel->fetch_single_row($this->esclevellabels->tbl_name,$where);
            } else {
                $levels = $this->basemodel->fetch_records_from($this->levels->tbl_name);
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->esclevellabels->ORG_MODULE] = $org_type;
                $where[$this->esclevellabels->ORG_ID]  = $org_id;
                $level_labels = $this->basemodel->fetch_single_row($this->esclevellabels->tbl_name,$where);
            }
            if (!empty($levels) || !empty($level_labels)) {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $levels;
                $data['labels'] = $level_labels;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }


    private function _add_levels($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
            $levels = $this->basemodel->get_single_column_value($this->levels->tbl_name,$this->levels->LEVEL_CODE,array($this->levels->LEVEL_CODE=>$jodata->level_code));

            if($levels=="-") {
                $isdata[$this->levels->LEVEL_NAME] = $jodata->level;
                $isdata[$this->levels->LEVEL_CODE] = $jodata->level_code;

                if ($this->basemodel->insert_into_table($this->levels->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Levels Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->level_code." Level Code Already Exists";
            }
        }

        return $data;
    }

    private function _update_levels($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $levels = $this->basemodel->get_single_column_value($this->levels->tbl_name,$this->levels->LEVEL_CODE,array($this->levels->LEVEL_CODE=>$jodata->LEVEL_CODE));

            if(!empty($levels)) {
                $where[$this->levels->ID] = $jodata->ID;
                $icdata[$this->levels->LEVEL_NAME] = $jodata->level;
                $icdata[$this->levels->LEVEL_CODE] = $jodata->LEVEL_CODE;
                $icdata[$this->levels->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($icdata, $this->levels->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Levels Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $icdata[$this->levels->LEVEL_NAME]." Level Code Already Exists";
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

    private function _get_Escalation_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->escalations->tbl_name, array(), '', 'count(' . $this->escalations->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $esc = $this->basemodel->fetch_records_from_pagination($this->escalations->tbl_name, '', '*', $this->escalations->ES_NAME, 'ASC', '10', $limit_val * 10);

            } else {
                $esc = $this->basemodel->fetch_records_from($this->escalations->tbl_name);
            }

            if (!empty($esc)) {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $esc;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = array();
            }
        }
        return $data;
    }


    private function _add_escalation($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {

            $escalation = $this->basemodel->get_single_column_value($this->escalations->tbl_name,$this->escalations->ES_NAME,array($this->escalations->ES_NAME=>$jodata->escalation));
            if($escalation=="-") {
                $isdata[$this->escalations->ES_NAME] = $jodata->escalation;

                if ($this->basemodel->insert_into_table($this->escalations->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Escalation Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->escalation." Escalation Name Already Exists";
            }
        }
        return $data;
    }


    private function _update_escalation($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $escalation = $this->basemodel->get_single_column_value($this->escalations->tbl_name, $this->escalations->ES_NAME, array($this->escalations->ES_NAME => $jodata->escalation));
            if (!empty($escalation)) {
                $where[$this->escalations->ID] = $jodata->ID;
                $icdata[$this->escalations->ES_NAME] = $jodata->escalation;
                $icdata[$this->escalations->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($icdata, $this->escalations->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Escalation Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $icdata[$this->escalations->ES_NAME] . " Escalation Name Already Exists";
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";

            }
        }
        return $data;
    }

    private function _get_Escalations_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->escalationsnew->tbl_name, array(), '', 'count(' . $this->escalationsnew->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $esc1 = $this->basemodel->fetch_records_from_pagination($this->escalationsnew->tbl_name, '', '*', $this->escalationsnew->EQUIPMENT_TYPE, 'ASC', '10', $limit_val * 10);

            } else {
                $esc1 = $this->basemodel->fetch_records_from($this->escalationsnew->tbl_name);
            }

            if (!empty($esc1)) {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                for($i=0;$i<count($esc1);$i++)
                {
                    $esc1[$i]['equp_cat'] = $this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->NAME,array($this->devicenames->ID=>$esc1[$i][$this->escalationsnew->EQUIPMENT_TYPE]));
                    $esc1[$i]['equp_util'] = $this->basemodel->get_single_column_value($this->utillvalues->tbl_name,$this->utillvalues->NAME,array($this->utillvalues->VALUE=>$esc1[$i][$this->escalationsnew->EQUIPMENT_UTIL]));
                }
                $data['list'] = $esc1;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _add_escalations1($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $escl_val1 = $this->baselibrary->cal_escl_time($jodata->level1, $jodata->l1_type);
            $escl_val2 = $this->baselibrary->cal_escl_time($jodata->level2, $jodata->l2_type);
            $escl_val3 = $this->baselibrary->cal_escl_time($jodata->level3, $jodata->l3_type);
            $isdata[$this->escalationsnew->EQUIPMENT_TYPE] = $jodata->equp_type;
            $isdata[$this->escalationsnew->ES_MODULE] = $jodata->es_module;
            $isdata[$this->escalationsnew->EQUIPMENT_UTIL] = $jodata->es_util;
            $isdata[$this->escalationsnew->L1] = $escl_val1;
            $isdata[$this->escalationsnew->L2] = $escl_val2;
            $isdata[$this->escalationsnew->L3] = $escl_val3;

            if ($this->basemodel->insert_into_table($this->escalationsnew->tbl_name, $isdata)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Escalations Added Successfully";
            } else {
                $data['qry'] = $this->db->last_query();
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }


    private function _update_escalations1($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $where[$this->escalationsnew->ID] = $jodata->ID;
            $escl_val1 = $this->baselibrary->cal_escl_time($jodata->level1, $jodata->l1_type);
            $escl_val2 = $this->baselibrary->cal_escl_time($jodata->level2, $jodata->l2_type);
            $escl_val3 = $this->baselibrary->cal_escl_time($jodata->level3, $jodata->l3_type);
            $isdata[$this->escalationsnew->EQUIPMENT_TYPE] = $jodata->equp_type;
            $isdata[$this->escalationsnew->EQUIPMENT_UTIL] = $jodata->es_util;
            $isdata[$this->escalationsnew->ES_MODULE] = $jodata->es_module1;
            $isdata[$this->escalationsnew->L1] = $escl_val1;
            $isdata[$this->escalationsnew->L2] = $escl_val2;
            $isdata[$this->escalationsnew->L3] = $escl_val3;
            if ($this->basemodel->update_operation($isdata, $this->escalationsnew->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Escalations Updated Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }


    private function _get_incident_type_list($jodata = array())
    {

        /* $data = array();
         if (!empty($jodata)) {
             if (isset($jodata->limit_val)) {
                 if ($jodata->limit_val != '')
                     $limit_val = $jodata->limit_val;
                 else
                     $limit_val = 0;
                 $cnt = $this->basemodel->fetch_records_from_multi_where($this->incedenttype->tbl_name, array(), '', 'count(' . $this->incedenttype->ID . ') AS CNT');
                 if (!empty($cnt)) {
                     $data['no_of_recs'] = $cnt[0]['CNT'];
                     $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                 } else {
                     $data['no_of_recs'] = 0;
                     $data['rcnt'] = 0;
                 }
                 $itype = $this->basemodel->fetch_records_from_pagination($this->incedenttype->tbl_name, '', '*', $this->incedenttype->ITYPE, 'ASC', '10', $limit_val * 10);

             } else {
                 $itype = $this->basemodel->fetch_records_from($this->incedenttype->tbl_name);
             }
             if (!empty($itype)) {
                 //$data['qry'] = $this->db->last_query();
                 $data['response'] = SUCCESSDATA;
                 $data['list'] = $itype;
             } else {
                 $data['response'] = EMPTYDATA;
                 $data['list'] = NULL;
             }
         }
         return $data;*/


        $data = array();
        if (!empty($jodata)) {

            if (isset($jodata->limit_val)) {

                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;

                $iwhere[$this->incedenttype->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;

                $ct =  "SELECT COUNT(ID) AS CNT FROM `hsp_tbl_m_incident_type` WHERE ORG_MODULE='$iwhere'";
                $cnt = $this->basemodel->execute_qry($ct);

                //$this->basemodel->fetch_records_from($this->incedenttype->tbl_name,$iwhere,'count('.$this->incidenttype->ID.') AS CNT');

                //return $cnt;
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }

                $iwhere[$this->incedenttype->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $itype = $this->basemodel->fetch_records_from_pagination($this->incedenttype->tbl_name, $iwhere, '*', $this->incedenttype->ITYPE, 'ASC', '10', $limit_val * 10);
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));

                $where[$this->incidenttypelables->ORG_MODULE] = $org_type;
                $where[$this->incidenttypelables->ORG_ID] = $org_id;
                $iselect = array($this->incidenttypelables->ITYPE,$this->incidenttypelables->CODE,$this->incidenttypelables->STATUS,$this->incidenttypelables->ACTION);
                $itypes_label = $this->basemodel->fetch_single_row($this->incidenttypelables->tbl_name,$where,$iselect);

            } else {
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));

                $where[$this->incidenttypelables->ORG_MODULE] = $org_type;
                $where[$this->incidenttypelables->ORG_ID] = $org_id;
                $iwhere[$this->incedenttype->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $itype = $this->basemodel->fetch_records_from($this->incedenttype->tbl_name,$iwhere);
                $iselect = array($this->incidenttypelables->ITYPE,$this->incidenttypelables->CODE,$this->incidenttypelables->STATUS,$this->incidenttypelables->ACTION);
                $itypes_label = $this->basemodel->fetch_single_row($this->incidenttypelables->tbl_name,$where,$iselect);

            }

            if (!empty($itype) || !empty($itypes_label)) {
                // $ctypelabel = array_merge($ctypes_label,$ctypes);

                $data['response'] = SUCCESSDATA;
                $data['list'] = $itype;
                $data['labels'] = $itypes_label;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;



    }

    private function _add_incident_type($jodata = array())
    {


        $data = array();
        if (!empty($jodata)) {
            $incident = $this->basemodel->get_single_column_value($this->incedenttype->tbl_name,$this->incedenttype->CODE,array($this->incedenttype->CODE=>$jodata->icode));
            if($incident=="-") {
                $isdata[$this->incedenttype->ITYPE] = $jodata->itype;
                $isdata[$this->incedenttype->CODE] = $jodata->icode;
                $isdata[$this->incedenttype->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;

                if ($this->basemodel->insert_into_table($this->incedenttype->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Incident Type Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->icode . " Incident Type Code Already Exists";
            }
        }
        return $data;
    }

    private function _update_incident_type($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $incident = $this->basemodel->get_single_column_value($this->incedenttype->tbl_name, $this->incedenttype->CODE, array($this->incedenttype->CODE => $jodata->icode));
            if (!empty($incident)) {
                $where[$this->incedenttype->ID] = $jodata->ID;
                $isdata[$this->incedenttype->ITYPE] = $jodata->itype;
                $isdata[$this->incedenttype->CODE] = $jodata->icode;
                $isdata[$this->incedenttype->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($isdata, $this->incedenttype->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Incident Type Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $isdata[$this->incedenttype->CODE] . " Incident Type Code Already Exists";
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _add_incidents($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {

            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $today = date('Y-m-d H:i:s');
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id  : $this->session->org_id ;

            $indata[$this->incedents->BRANCH_ID] = $branch_id;
            $indata[$this->incedents->ORG_ID] = $org_id;
            $iwhere[$this->incedents->ORG_ID] = $org_id;

            $iwhere[$this->incedents->BRANCH_ID] = $indata[$this->incedents->BRANCH_ID];
            $iwhere[$this->incedents->EQUP_ID] = $jodata->equp_id;
            $iwhere[$this->incedents->STATUS] = ACTIVESTS;

            if(!is_numeric($user_id))
            {
                $user_name = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->USER_NAME,array($this->users->USER_ID=>$user_id));
                $user_email = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->EMAIL_ID,array($this->users->USER_ID=>$user_id));
                $user_mobile = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->MOBILE_NO,array($this->users->USER_ID=>$user_id));
                $user_emp_no = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->EMP_NO,array($this->users->USER_ID=>$user_id));
                //$user_id = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->EMP_NO,array($this->users->USER_ID=>$user_id));
            }
            else
            {
                $user_name = $jodata->user_name;
                $user_email = $jodata->email;
                $user_mobile = $jodata->mobile_no;
                $user_emp_no = $jodata->caller_id;
            }
            $incident_data = $this->basemodel->fetch_single_row($this->incedents->tbl_name, $iwhere);
            // return $this->db->last_query();
            if (!empty($incident_data))
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Already incident raised to this device!";
                return $data;
            }

            $indata[$this->incedents->ADDED_BY] = $user_id;
            $indata[$this->incedents->ADDED_BY_NAME] = $user_name;
            $indata[$this->incedents->ADDED_ON] = $today;
            $indata[$this->incedents->DATE_OCCRANCE] = isset($jodata->current_date) ? date("Y-m-d", strtotime($jodata->current_date)) : date("Y-m-d");
            $indata[$this->incedents->TIME_OCCRANCE] = isset($jodata->current_time) ? date("H:i:s", strtotime($jodata->current_time)) : date("H:i:s");
            $indata[$this->incedents->INCIDENT_TYPE] = $jodata->itype;
            $indata[$this->incedents->FEEDBACK] = $jodata->feedback;
            $indata[$this->incedents->DEPT_ID] = $jodata->departments;
            if(isset($jodata->observation))
                $indata[$this->incedents->OBSERVATIONS] = $jodata->observation;
            $indata[$this->incedents->EQUP_ID] = $jodata->equp_id;

            if($this->basemodel->insert_into_table($this->incedents->tbl_name, $indata))
            {

                $caller_uuid = $jodata->caller_id;
                $caller_data1 = $this->basemodel->fetch_single_row($this->users->tbl_name, array($this->users->EMP_NO => $caller_uuid), array($this->users->USER_NAME, $this->users->MOBILE_NO, $this->users->EMAIL_ID));
                /*$caller_id = $caller_data1[$this->users->EMP_NO];
                $caller_name = $caller_data1[$this->users->USER_NAME];
                $caller_mobile = $caller_data1[$this->users->MOBILE_NO];
                $caller_email = $caller_data1[$this->users->EMAIL_ID];*/
                if (!empty($caller_data1)) {

                    $data['response'] = SUCCESSDATA;
                    //$data['call_back'] = 'This User is already exists';

                } else {
                    $max_val = (int)$this->basemodel->select_max_val($this->users->tbl_name, $this->users->UID);
                    $user_id = $this->baselibrary->user_id_creation($max_val);
                    $insert_dms[$this->users->USER_ID] = HA . $user_id;
                    $insert_dms[$this->users->ORG_ID] = $org_id;
                    $insert_dms[$this->users->ORG_BRANCH_ID] = $branch_id;
                    $insert_dms[$this->users->MOBILE_NO] = $user_mobile;
                    $insert_dms[$this->users->EMAIL_ID] = $user_email;
                    $insert_dms[$this->users->EMP_NO] =$user_emp_no;
                    $insert_dms[$this->users->USER_NAME] = $user_name;
                    $insert_dms[$this->users->ROLE_CODE] = "user";
                    //$insert_dms[$this->users->DEPT_CODE] = $dept;
                    $insert_dms[$this->users->START_DATE] = date('Y-m-d H:i:s');
                    $insert_dms[$this->users->END_DATE] = $enddate = date('9999-m-d H:i:s');
                    $insert_dms[$this->users->ADDED_ON] = date('Y-m-d H:i:s');
                    // $insert_dms[$this->users->PSWRD]= $this->bcrypt->hash_password(DFFPASS);
                    //  $insert_dms[$this->users->CEMP_ID] = $caller_id;
                    /*$insert_dms[$this->new->NATURE_OF_COMP] = $complaint;
                    $insert_dms[$this->new->EID] = $device_id;
                    $insert_dms[$this->new->STATUS] = DNW;
                    $insert_dms[$this->new->TYPE] = $amc_type;
                    $insert_dms[$this->new->PRIORITY] = $priority;*/
                    if ($this->basemodel->insert_into_table($this->users->tbl_name, $insert_dms)) {
                        $data['response'] = SUCCESSDATA;
                        //  $data['call_back'] = 'USER SAVED SUCCESSFULLY';
                    } else {
                        $data['response'] = FAILEDATA;
                        //  $data['call_back'] = 'Unable to Process Your Request Try Again...';
                    }
                }


                if(isset($jodata->form_cms) && $jodata->form_cms==YESSTATE)
                {
                    $cms_where[$this->cms->ID] = $jodata->cms_id;
                    $data['cms_update'] = $this->basemodel->update_operation(array($this->cms->TO_ADVERSE=>$jodata->form_cms),$this->cms->tbl_name,$cms_where);
                }
                $dt_where[$this->devices->E_ID] = $indata[$this->incedents->EQUP_ID];
                $dt_where[$this->devices->ORG_ID] = $indata[$this->incedents->ORG_ID];
                $dt_where[$this->devices->BRANCH_ID] = $indata[$this->incedents->BRANCH_ID];
                $dt_update[$this->devices->EQ_CONDATION] = DNW;
                $this->basemodel->update_operation($dt_update,$this->devices->tbl_name,$dt_where);
                //$data['qry'] = $this->db->last_query();
                $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name, array($this->devices->E_ID => $jodata->equp_id));
                if (is_numeric($user_id))
                    $emp_id = $user_id;
                else
                    $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));

                if ($device_details[$this->devices->PHY_LOCATION] != NULL)
                    $notification = "Adverse call From " . $device_details[$this->devices->PHY_LOCATION] . " generated By " . $emp_id . "  From " . $device_details[$this->devices->DEPT_ID] . " Department For Equipment " . $device_details[$this->devices->E_NAME] . ", ID: " . $device_details[$this->devices->E_ID] . " Due to " . $jodata->itype;
                else
                    $notification = "Adverse call generated by " . $emp_id . " From " . $device_details[$this->devices->DEPT_ID] . " for " . $device_details[$this->devices->E_NAME] . ", ID: " . $device_details[$this->devices->E_ID] . " Due to " . $jodata->itype;

                log_message('error',$org_id.", B:".$branch_id.", N:".$notification);
                $data['notification']=$this->baselibrary->send_notification($org_id,$branch_id,$notification);

                /*  if($device_details[$this->devices->AMC_TYPE."!="] = NULL && $device_details[$this->devices->AMC_TYPE."!="] = 'BME' && $device_details[$this->devices->DISTRIBUTOR."!="] = '' && $device_details[$this->devices->DISTRIBUTOR."!="] = NULL )
                  {
                      $distributer = $device_details[$this->devices->DISTRIBUTOR];
                      $data['vnotification']=$this->baselibrary->send_vendor_notification($notification,$distributer);
                  }*/

                $data['response'] = SUCCESSDATA;
                $data['call_back'] = " Adverse Incident Raised Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "  Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _update_observations($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $where[$this->incedents->ID] = $jodata->ID;
            $device_details1 = $this->basemodel->fetch_single_row($this->incedents->tbl_name,$where);
            $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$device_details1[$this->incedents->EQUP_ID]));
            $incident_device = $this->basemodel->fetch_single_row($this->incedents->tbl_name,$where);
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $today = date('Y-m-d H:i:s');
            $isdata[$this->incedents->UPDATED_BY] = $user_id;
            $isdata[$this->incedents->UPDATED_ON] = $today;
            $isdata[$this->incedents->INCHARGE_COMMENT] = $jodata->icomment;
            $isdata[$this->incedents->OBSERVATIONS] = $jodata->observation;
            $isdata[$this->incedents->OCCRANCE_REPORT] = $jodata->report;
            $isdata[$this->incedents->SPARES] = $jodata->spares;
            $isdata[$this->incedents->ACCESSORIES] = $jodata->accessories;
            $isdata[$this->incedents->APPROXIMATE_COST] = $jodata->acost;
            $isdata[$this->incedents->TOTAL_COST] = $jodata->tcost;
            $isdata[$this->incedents->ACTION_TACKEN] = $jodata->action_taken;
            $isdata[$this->incedents->CONCLUSION] = $jodata->conclusion;
            $isdata[$this->incedents->OPERATOR_OBSER] = $jodata->ope_obser;
            $isdata[$this->incedents->CHIEF_ENG_OBSERV] = $jodata->ceobser;
            $isdata[$this->incedents->OPERATOR_NAME] = $jodata->operator_name;
            $isdata[$this->incedents->RESTORATION_TIME] = $jodata->eexp_Restorations;
            $isdata[$this->incedents->CAUSE_PROBABILITY] = $jodata->cause_probability;
            $isdata[$this->incedents->NATURE_REPORT] = $jodata->nreport;

            if (isset($jodata->observationscompleteremarks))
            {
                $isdata[$this->incedents->COMPLETE_REMARKS] = $jodata->observationscompleteremarks;
            }
            $isdata[$this->incedents->COMPLETED_BY] = $user_id;
            $isdata[$this->incedents->COMPLETED_ON] = $today;
            $isdata[$this->incedents->STATUS] = INACTIVESTS;
            if ($this->basemodel->update_operation($isdata, $this->incedents->tbl_name, $where))
            {
                $dt_where[$this->devices->E_ID] = $incident_device[$this->incedents->EQUP_ID];
                $dt_where[$this->devices->ORG_ID] = $incident_device[$this->incedents->ORG_ID];
                $dt_where[$this->devices->BRANCH_ID] = $incident_device[$this->incedents->BRANCH_ID];
                $dt_update[$this->devices->EQ_CONDATION] = DW;
                $this->basemodel->update_operation($dt_update,$this->devices->tbl_name,$dt_where);
                $notification = "Adverse call Completed By " . $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->USER_NAME,array($this->users->USER_ID=>$user_id)) . " From " . $device_details[$this->devices->DEPT_ID] . " for " . $device_details[$this->devices->E_NAME] . ",Id: " . $device_details[$this->devices->E_ID];
                $data['notification']=$this->baselibrary->send_notification($org_id,$branch_id,$notification);
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Adverse Incident Completed Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }
    private function _update_observations_approve($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $where[$this->cear->ID] = $jodata->ID;
            $isdata[$this->cear->APPROVED_BY] = json_encode($jodata->approved_by);
            if ($this->basemodel->update_operation($isdata, $this->cear->tbl_name, $where))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "CEAR Approved Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _observation_assign($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $where[$this->incedents->ID] = $jodata->ID;
            $device_details1 = $this->basemodel->fetch_single_row($this->incedents->tbl_name,$where);
            $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$device_details1[$this->incedents->EQUP_ID]));
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            /*$isdata[$this->incedents->BRANCH_ID] = $branch_id;
            $isdata[$this->incedents->ORG_ID] = $org_id;*/
            $today = date('Y-m-d H:i:s');
            $isdata[$this->incedents->UPDATED_BY] = $user_id;
            $isdata[$this->incedents->UPDATED_ON] = $today;
            $isdata[$this->incedents->ASSIGNED_TO] = $jodata->assignto;
            $isdata[$this->incedents->ASSIGNED_BY] = $user_id;
            if (isset($jodata->observationsassignremarks))
                $isdata[$this->incedents->ASSIGN_REMARKS] = $jodata->observationsassignremarks;
            $isdata[$this->incedents->STATUS] = INACTIVESTS;
            if ($this->basemodel->update_operation($isdata, $this->incedents->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $isdata[$this->incedents->ASSIGNED_TO]));
                $data['call_back'] = "Adverse Incident Assigned Successfully";
                $notification = "Adverse call Assigned to " . $emp_id . " From " . $device_details[$this->devices->DEPT_ID] . " for " . $device_details[$this->devices->E_NAME] . ",Id: " . $device_details[$this->devices->E_ID] . " Due to " . $jodata->itype;
                //$notification = "Adverse call Assigned to " . $emp_id;
                $data['notification']=$this->baselibrary->send_notification($org_id,$branch_id,$notification);
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _update_adverse_incedets($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $where[$this->incedents->ID] = $jodata->ID;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $indata[$this->incedents->BRANCH_ID] = $branch_id;
            $indata[$this->incedents->ORG_ID] = $org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $today = date('Y-m-d H:i:s');
            $isdata[$this->incedents->UPDATED_BY] = $user_id;
            $isdata[$this->incedents->UPDATED_ON] = $today;
            $isdata[$this->incedents->INCHARGE_COMMENT] = $jodata->icomment;
            $isdata[$this->incedents->OBSERVATIONS] = $jodata->observation;
            $isdata[$this->incedents->OCCRANCE_REPORT] = $jodata->report;
            $isdata[$this->incedents->SPARES] = $jodata->spares;
            $isdata[$this->incedents->ACCESSORIES] = $jodata->accessories;
            $isdata[$this->incedents->APPROXIMATE_COST] = $jodata->acost;
            $isdata[$this->incedents->TOTAL_COST] = $jodata->tcost;
            $isdata[$this->incedents->ACTION_TACKEN] = $jodata->action_taken;
            if ($this->basemodel->update_operation($isdata, $this->incedents->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Adverse Incidents Updated Successfully";

                $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name, array($this->devices->E_ID => $jodata->EQUP_ID));
                if (is_numeric($user_id))
                    $emp_id = $user_id;
                else
                    $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->EMP_NO, array($this->users->USER_ID => $user_id));
                if ($device_details[$this->devices->PHY_LOCATION] != NULL)
                    $notification = "Adverse call From " . $device_details[$this->devices->PHY_LOCATION] . " completed By " . $emp_id . "  From " . $device_details[$this->devices->DEPT_ID] . " Department For Equipment " . $device_details[$this->devices->E_NAME] . ",Id: " . $device_details[$this->devices->E_ID] . " Due to " . $jodata->itype;
                else
                    $notification = "Adverse call completed by " . $emp_id . " From " . $device_details[$this->devices->DEPT_ID] . " for " . $device_details[$this->devices->E_NAME] . ",Id: " . $device_details[$this->devices->E_ID] . " Due to " . $jodata->itype;
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    /* transfers starting*/

    private function _other_unit_request($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $today = date("Y-m-d H:i:s");
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $indata[$this->transfer->TRANSFER_BRANCH] = $jodata->from_eq_transfer_unit;
            $indata[$this->transfer->BRANCH_ID] = $branch_id;
            $indata[$this->transfer->EQUP_ID] = $jodata->device_id;
            $indata[$this->transfer->TRANSFER_STATUS] = APPROVED;
            $indata[$this->transfer->ORG_ID] = $org_id;

            $eq_cat = $this->basemodel->get_single_column_value($this->devices->tbl_name,$this->devices->E_CAT,array($this->devices->E_ID=>$indata[$this->transfer->EQUP_ID]));
            if($eq_cat=="-")
            {
                $eq_cat = NULL;
            }
            $indata[$this->transfer->E_NAME] = $eq_cat;
            $indata[$this->transfer->DEPT_ID] = $jodata->dept_id;
            /*$indata[$this->transfer->PHYSICAL_LOCATION] = $jodata->plocation;*/
            $indata[$this->transfer->REASON] = $jodata->reasons;
            $indata[$this->transfer->USERNAME] = $user_id;
            //  $indata[$this->transfer->TRANSFER_DEPT] = $jodata->newdepts;
            $indata[$this->transfer->TRANSFER_TYPE] = $jodata->ttype;
            if($indata[$this->transfer->TRANSFER_TYPE]=='Returnable')
            {
                $indata[$this->transfer->EXPECTED_RETURN] = date('Y-m-d',strtotime($jodata->expect_return));
            }
            $indata[$this->transfer->TRANSFER] = $jodata->unit_type;
            $indata[$this->transfer->ADDED_ON] = $today;
            $indata[$this->transfer->ADDED_BY] = $user_id;
            if ($this->basemodel->insert_into_table($this->transfer->tbl_name, $indata))
            {
                $whr[$this->devices->E_ID] = $jodata->device_id;
                $whr[$this->devices->DEPT_ID] = $jodata->dept_id;
                //  $whr[$this->devices->]
                $upd[$this->devices->RELOCATION_STATUS] = YESSTATE;
                $upd[$this->devices->BRANCH_RELOCATION] = $jodata->from_eq_transfer_unit;
                $this->basemodel->update_operation($upd,$this->devices->tbl_name,$whr);

                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Transfer Other Unit Request Raised Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _transfer_with_in_unit($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $today = date("Y-m-d H:i:s");
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $indata[$this->transfer->BRANCH_ID] = $branch_id;
            $indata[$this->transfer->TRANSFER_BRANCH] = $branch_id;
            $indata[$this->transfer->ORG_ID] = $org_id;
            $indata[$this->transfer->DEPT_ID] = $jodata->departments;
            $indata[$this->transfer->TRANSFER] = $jodata->unit_type;
            $indata[$this->transfer->PHYSICAL_LOCATION] = $jodata->plocation;
            if(isset($jodata->reasons))
                $indata[$this->transfer->REASON] = $jodata->reasons;
            $indata[$this->transfer->EQUP_ID] = $jodata->equp_id;
            $indata[$this->transfer->DEPLOYMENT_ID] = $jodata->equp_id;
            $indata[$this->transfer->E_NAME] = $jodata->equp_name;
            $indata[$this->transfer->TRANSFER_DEPT] = $jodata->newdepts;
            $indata[$this->transfer->DATE_TIME] = $today;
            $indata[$this->transfer->ADDED_ON] = $today;
            $indata[$this->transfer->UPDATED_ON] = $today;
            $indata[$this->transfer->UPDATED_BY] = $user_id;
            $indata[$this->transfer->ADDED_BY] = $user_id;
            $indata[$this->transfer->USERNAME] = $user_id;
            $indata[$this->transfer->TRANSFER_STATUS] = "Approved";

            if($this->basemodel->insert_into_table($this->transfer->tbl_name, $indata))
            {
                $wupdate[$this->devices->E_ID] = $indata[$this->transfer->EQUP_ID];
                $uupdate[$this->devices->DEPT_ID] = $indata[$this->transfer->TRANSFER_DEPT];
                $uupdate[$this->devices->PHY_LOCATION] = $indata[$this->transfer->PHYSICAL_LOCATION];
                if($this->basemodel->update_operation($uupdate,$this->devices->tbl_name,$wupdate))
                {
                    $data['call_back'] = "Device Transferred to ".$indata[$this->transfer->TRANSFER_DEPT]."  Department Successfully";
                    $data['response'] = SUCCESSDATA;
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
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

    private function _get_transfer_Approval_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $where[$this->transfer->TRANSFER] = 'Other Unit';
            // $where[$this->transfer->TRANSFER_STATUS] = NULL;
            $oapproval = $this->basemodel->fetch_records_from($this->transfer->tbl_name, $where);
            //$data['qry'] = $this->db->last_query();
            if (!empty($oapproval)) {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($oapproval); $i++) {
                    $oapproval[$i]['ename'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $oapproval[$i][$this->transfer->EQUP_ID]));
                    $oapproval[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $oapproval[$i][$this->transfer->DEPT_ID]));
                    $oapproval[$i]['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $oapproval[$i][$this->transfer->USERNAME]));
                    $oapproval[$i]['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $oapproval[$i][$this->transfer->TRANSFER_BRANCH]));
                    $oapproval[$i]['added_on'] = strtotime($oapproval[$i][$this->transfer->ADDED_ON]);
                }

                $data['list'] = $oapproval;
                //print_r($oapproval);
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _update_otherunit_approval_list($jodata = array())//geetha
    {
        $data = array();
        $data = array();
        $udata[$this->transfer->TRANSFER_STATUS] = $jodata->atransfer_status;
        $udata[$this->transfer->ADMIN_FEEDBACK] = $jodata->feedback;
        $where[$this->transfer->ID] = $jodata->ID;
        $where[$this->transfer->APPROVED_BY] = is_array($jodata->approved_by)?json_encode($jodata->approved_by):$jodata->approved_by;
        if ($this->basemodel->update_operation($udata, $this->transfer->tbl_name, $where)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Approved Successfully';
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = 'Unable to Process Your Request Try Again...!';
        }
        return $data;
    }

    private function _update_otherunit_disapproval_list($jodata = array())//geetha
    {
        $data = array();
        $udata[$this->transfer->TRANSFER_STATUS] = $jodata->atransfer_status;
        $udata[$this->transfer->REQU_FEEDBACK] = $jodata->feedback;
        $where[$this->transfer->APPROVED_BY] = is_array($jodata->approved_by)?json_encode($jodata->approved_by):$jodata->approved_by;
        $where[$this->transfer->ID] = $jodata->ID;
        if ($this->basemodel->update_operation($udata, $this->transfer->tbl_name, $where)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'DisApproved Successfully';
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = 'Unable to Process Your Request Try Again...!';
        }
        return $data;
    }

    private function _get_otherunit_tansfer_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $where[$this->transfer->TRANSFER_BRANCH.' !='] = $jodata->BRANCH_ID;
            $where[$this->transfer->TRANSFER_STATUS] = "Approved";
            $othransfer = $this->basemodel->fetch_records_from($this->transfer->tbl_name, $where);
            if (!empty($oapproval)) {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($othransfer); $i++) {
                    $othransfer[$i]['ename'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $othransfer[$i][$this->transfer->EQUP_ID]));
                    $othransfer[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $othransfer[$i][$this->transfer->DEPT_ID]));
                    $othransfer[$i]['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $othransfer[$i][$this->transfer->USERNAME]));
                    $othransfer[$i]['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $othransfer[$i][$this->transfer->BRANCH_ID]));
                }

                $data['list'] = $othransfer;
                //print_r($oapproval);
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _get_otherunit_unit_transfer_calls($jodata = array())
    {


        $data = array();
        if (!empty($jodata))
        {
            $or_where = '';
            $where[$this->transfer->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->transfer->DEPLOYMENT_ID] = NULL;
            $where[$this->transfer->TRANSFER] = 'Other Unit';

            //$where[$this->transfer->TRANSFER_STATUS] = 'Other Unit';
            if($branch_id != 'All')
                $or_where = "(" . $this->transfer->TRANSFER_BRANCH . " = '".$branch_id ."' OR " . $this->transfer->BRANCH_ID . "='".$branch_id ."')";
            else
                $or_where = "(" . $this->transfer->TRANSFER_BRANCH . " IN ".BRANCHALL ." OR " . $this->transfer->BRANCH_ID . " IN ".BRANCHALL." )";


            if(isset($jodata->aaction) && $jodata->aaction=='get_admin_calls')
            {
                $or_where = '';
            }

            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls")
            {
                $twhere[$this->devices->DISTRIBUTOR] = $jodata->vendor_org;
                $twhere[$this->devices->ASSIGN_ID. "!="] = NULL;
                $twhere[$this->devices->ORG_ID] = $jodata->org_id;
                $twhere[$this->devices->BRANCH_ID] = $jodata->branch_id;

                $devices = $this->basemodel->fetch_records_from($this->devices->tbl_name,$twhere,array($this->devices->E_ID));
                // return $this->db->last_query();
                for($i = 0; $i < count($devices); $i++)
                    $device[$i] = "'".$devices[$i]['E_ID']."'";
                if(count($devices) > 0 )
                {
                    $device = '(' . implode($device, ',') . ')';
                    $or_where = $this->transfer->EQUP_ID . " IN " . $device;
                }

                else
                    $or_where = '';

            }



            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->transfer->tbl_name, $where, $or_where, 'count('.$this->transfer->ID.') AS CNT');

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


                $othransfer = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->transfer->tbl_name, $where, $or_where,'','','','', '*','','10',$limit_val*10);


                for($i =0; $i<count($othransfer); $i++)
                {
                    $where1[$this->devices->E_ID] = $othransfer[$i]['EID'];
                    $devices1 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1,array($this->devices->ASSIGN_ID));
                    if(!empty($devices1))
                    {

                        $othransfer[$i]['ASSIGN_ID'] = $devices1['ASSIGN_ID'];

                    }
                }


            }
            else
            {
                $othransfer = $this->basemodel->fetch_records_from_multi_where($this->transfer->tbl_name, $where, $or_where);

                for($i =0; $i<count($othransfer); $i++)
                {
                    $where1[$this->devices->E_ID] = $othransfer[$i]['EID'];
                    $devices1 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1,array($this->devices->ASSIGN_ID));
                    if(!empty($devices1))
                    {

                        $othransfer[$i]['ASSIGN_ID'] = $devices1['ASSIGN_ID'];

                    }
                }


            }

            // return $this->db->last_query();
            //$data['qry'] = $this->db->last_query();
            /* if (!empty($othransfer)) //{
                 $data['response'] = SUCCESSDATA;
                 $data['list'] = $this->baselibrary->transfer_list($othransfer);*/
            /*  } else {
                  $data['response'] = EMPTYDATA;
                  $data['list'] = NULL;
              }*/


            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }
            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));
            // return $devices;
            $othertransfer_data = array();
            for($i = 0; $i < count($devices); $i++) {

                $bwhere[$this->transfer->DEPLOYMENT_ID] = NULL;
                $bwhere[$this->transfer->TRANSFER] = 'Other Unit';
                $bwhere[$this->transfer->EQUP_ID] = $devices[$i]['ASSIGN_ID'];

                $othertrans_call_res = $this->basemodel->fetch_single_row($this->transfer->tbl_name, $bwhere);

                if(!empty($othertrans_call_res))
                {

                    $othertrans_call_res['ASSIGN_ID'] = $devices[$i]['E_ID'];
                    // $condemn_call_res['BRANCH_ID'] = $devices[$i]['BRANCH_ID'];
                    //  $condemn_call_res['ORG_ID'] = $devices[$i]['ORG_ID'];

                    array_push($othertransfer_data,$othertrans_call_res);

                }

            }

            //  return $this->db->last_query();
            if(!empty($othertransfer_data) || !empty($othransfer)) {
                $othransfer = array_merge($othransfer, $othertransfer_data);
                //return $othransfer;
                $data['response'] = SUCCESSDATA;
                $data['list'] =  $this->baselibrary->transfer_list($othransfer);
            }else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }

            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls" )
                return $othransfer;

        }
        return $data;
    }



    private function _update_otherunit_trnsfer_list($jodata = array())
    {
        // print_r($jodata);
        $today = strtotime(date("Y-m-d h:i:s a"));
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $data = array();
        $udata[$this->transfer->UPDATED_ON] = $today;
        $udata[$this->transfer->BRANCH_ID] = $branch_id;
        $udata[$this->transfer->UPDATED_BY] = $user_id;
        $udata[$this->transfer->E_NAME] = $jodata->E_NAME;
        $udata[$this->transfer->EQUP_ID] = $jodata->EQUP_ID;
        $udata[$this->transfer->SENDER_FEEDBACK] = $jodata->feedback;
        $udata[$this->transfer->ACCSSORIES] = $jodata->accssories;
        $where[$this->transfer->ID] = $jodata->ID;
        if ($this->basemodel->update_operation($udata, $this->transfer->tbl_name, $where)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = 'Transfer Details Updated Successfully';
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = 'Unable to Process Your Request Try Again...!';
        }
        return $data;
    }


    private function _get_tansfer_list($jodata = array())
    {


        $data = array();
        $like = array();
        if (!empty($jodata)) {
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->transfer->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            if (isset($jodata->unit_type) && $jodata->unit_type != "" && $jodata->unit_type != NULL)
                $like[$this->transfer->TRANSFER] = $jodata->unit_type;

            //   $where[$this->transfer->DEPLOYMENT_ID] = NULL;

            if (isset($jodata->status) && $jodata->status != "" && $jodata->status != NULL)
            {
                if($jodata->status=="Approved" || $jodata->status=="Disapproved")
                {
                    // $where[$this->transfer->TRANSFER_BRANCH]=$branch_id;
                    if($branch_id != 'All')
                        $where[$this->transfer->TRANSFER_BRANCH] = $branch_id;
                    else
                        $where_date =$this->transfer->TRANSFER_BRANCH." IN ". BRANCHALL;

                    if($jodata->status=="Approved")
                    {
                        $where[$this->transfer->TRANSFER_STATUS]="Approved";
                    }
                    else if($jodata->status=="Disapproved")
                    {
                        $where[$this->transfer->TRANSFER_STATUS]="Disapproved";
                    }
                }
                else if($jodata->status=="Requests")
                {
                    unset($where[$this->transfer->TRANSFER_BRANCH]);
                    $where[$this->transfer->TRANSFER_STATUS]="Approved";
                    $where[$this->transfer->BRANCH_ID]=$branch_id;
                    $where[$this->transfer->TRANSFER_BRANCH." !="]=$branch_id;
                }
            }
            if((isset($jodata->aaction) && $jodata->aaction=="get_admin_calls") || $role_code==HMADMIN)
            {
                unset($where[$this->transfer->TRANSFER_BRANCH]);
            }
            /*  if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls")
              {
                  $swhere[$this->devices->DISTRIBUTOR] = $jodata->vendor_org;
                  $swhere[$this->devices->ASSIGN_ID. "!="] = NULL;
                  $swhere[$this->devices->ORG_ID] = $jodata->org_id;
                  $swhere[$this->devices->BRANCH_ID] = $jodata->branch_id;

                  $devices = $this->basemodel->fetch_records_from($this->devices->tbl_name,$swhere,array($this->devices->E_ID));

                  for($i = 0; $i < count($devices); $i++)
                      $device[$i] = "'".$devices[$i]['E_ID']."'";
                  if(count($devices) > 0 )
                  {
                      $device = '(' . implode($device, ',') . ')';
                      $or_where = $this->cms->EID . " IN " . $device;
                  }

                  else
                      $or_where = '';

             }*/

            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
                $where_date = $this->transfer->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";

            if($branch_id != 'All')
                $where[$this->transfer->TRANSFER_BRANCH] = $branch_id;
            else
            {
                $where_date .= ($where_date == '') ? '' : " AND ";
                $where_date .= $this->transfer->TRANSFER_BRANCH." IN ". BRANCHALL;
            }

            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_with_like_multiwhere($this->transfer->tbl_name, $where, $where_date, $like, 'count(' . $this->transfer->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $transfer = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->transfer->tbl_name, $where, $where_date, $like, '*',$this->transfer->ADDED_ON, 'DESC', '10', $limit_val * 10);

            } else {
                $transfer = $this->basemodel->fetch_records_with_like_multiwhere($this->transfer->tbl_name, $where, $where_date, $like);
            }
            //$data['qry'] = $this->db->last_query();
            // return $this->db->last_query();
            if (!empty($transfer)) {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($transfer); $i++)
                {
                    //$transfer[$i]['emodel'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_MODEL, array($this->devices->E_ID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['emodel'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_MODEL, array($this->devices->E_ID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['pono'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->PONO, array($this->devices->E_ID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['ctype'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_TYPE, array($this->deviceamcs->EID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['serial_no'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['equp_type'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->TYPE, array($this->cms->EID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['status'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->STATUS, array($this->cms->EID => $transfer[$i][$this->transfer->EQUP_ID]));
                    //$transfer[$i]['req_eq_name'] = $this->basemodel->get_single_column_value($this->devicenames->tbl_name, $this->devicenames->NAME, array($this->devicenames->ID => $transfer[$i][$this->transfer->E_NAME]));
                    $transfer[$i]['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $transfer[$i][$this->transfer->USERNAME]));
                    $transfer[$i]['tbranch_code'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_CODE, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->TRANSFER_BRANCH]));
                    $transfer[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->BRANCH_ID]));
                    $transfer[$i]['tbranch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->TRANSFER_BRANCH]));
                    $transfer[$i]['added_on'] = strtotime($transfer[$i][$this->transfer->ADDED_ON]);
                }
                $data['list'] = $transfer;
                // print_r($transfer);
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }

            //    if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls" )
            //   return $transfer;


        }
        return $data;
    }
    private function _get_tansfer_new_list($jodata = array())
    {
        //print_r($jodata);
        $data = array();
        $like = array();
        if (!empty($jodata)) {
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->transfer->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            /* if (isset($jodata->unit_type) && $jodata->unit_type != "" && $jodata->unit_type != NULL)
                 $like[$this->transfer->TRANSFER] = $jodata->unit_type;*/

            $where[$this->transfer->UPDATED_BY] = $user_id;
            $where[$this->transfer->TRANSFER_BRANCH] = $branch_id;
            $where[$this->transfer->DEPLOYMENT_ID." !="] = NULL;

            /*  if((isset($jodata->aaction) && $jodata->aaction=="get_admin_calls") || $role_code==HMADMIN)
              {
                  unset($where[$this->transfer->TRANSFER_BRANCH]);
              }*/
            if (isset($jodata->dept_id)  && $jodata->dept_id !='')
                $where[$this->transfer->DEPT_ID] = $jodata->dept_id;
            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->transfer->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }
            else
            {
                $where[$this->transfer->ADDED_ON] = date('Y-m-d');
            }
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_with_like_multiwhere($this->transfer->tbl_name, $where, $where_date, $like, 'count(' . $this->transfer->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $transfer = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->transfer->tbl_name, $where, $where_date, $like, '*',$this->transfer->ADDED_ON, 'DESC', '10', $limit_val * 10);

            }
            else {
                $transfer = $this->basemodel->fetch_records_with_like_multiwhere($this->transfer->tbl_name, $where, $where_date, $like);
            }
            //$data['qry'] = $this->db->last_query();
            if (!empty($transfer)) {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($transfer); $i++)
                {
                    $transfer[$i]['ename'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['equp_type'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->TYPE, array($this->cms->EID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['status'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->STATUS, array($this->cms->EID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['req_eq_name'] = $this->basemodel->get_single_column_value($this->devicenames->tbl_name, $this->devicenames->NAME, array($this->devicenames->ID => $transfer[$i][$this->transfer->E_NAME]));
                    $transfer[$i]['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $transfer[$i][$this->transfer->USERNAME]));
                    $transfer[$i]['tbranch_code'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_CODE, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->TRANSFER_BRANCH]));
                    $transfer[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->BRANCH_ID]));
                    $transfer[$i]['tbranch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->TRANSFER_BRANCH]));
                    $transfer[$i]['added_on'] = strtotime($transfer[$i][$this->transfer->ADDED_ON]);
                }
                $data['list'] = $transfer;
                // print_r($transfer);
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _update_transfer_within_requ_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $today = date("Y-m-d H:i:s");
            $where[$this->transfer->ID] = $jodata->ID;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $indata[$this->transfer->DEPT_ID] = $jodata->departments;
            $indata[$this->transfer->TRANSFER] = $jodata->etransfer_status;
            $indata[$this->transfer->PHYSICAL_LOCATION] = $jodata->plocation;
            if (isset($jodata->reasons))
                $indata[$this->transfer->REASON] = $jodata->reasons;
            $indata[$this->transfer->EQUP_ID] = $jodata->equp_id;
            $indata[$this->transfer->E_NAME] = $jodata->equp_name;
            $indata[$this->transfer->TRANSFER_DEPT] = $jodata->newdepts;
            $indata[$this->transfer->DATE_TIME] = $today;
            $indata[$this->transfer->UPDATED_ON] = $today;
            $indata[$this->transfer->UPDATED_BY] = $user_id;
            $indata[$this->transfer->USERNAME] = $user_id;
            if ($this->basemodel->update_operation($indata, $this->transfer->tbl_name, $where))
            {
                $wupdate[$this->devices->E_ID] = $indata[$this->transfer->EQUP_ID];
                $uupdate[$this->devices->DEPT_ID] = $indata[$this->transfer->TRANSFER_DEPT];
                $uupdate[$this->devices->PHY_LOCATION] = $indata[$this->transfer->PHYSICAL_LOCATION];
                if($this->basemodel->update_operation($uupdate,$this->devices->tbl_name,$wupdate))
                {
                    $data['call_back'] = "Device Transferred to ".$indata[$this->transfer->TRANSFER_DEPT]."  Department Successfully";
                    $data['response'] = SUCCESSDATA;
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = 'Record Updated Successfully';
            } else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = 'Unable to Process Your Request Try Again...!';
            }
            return $data;
        }
    }

    private function _update_transfer_other_requ_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $where[$this->transfer->ID] = $jodata->ID;
            $today = date("Y-m-d H:i:s");
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            //$indata[$this->transfer->E_NAME] = $jodata->equp_name;
            // $indata[$this->transfer->DEPLOYMENT_ID] = substr_replace($jodata->equp_id,$jodata->tbranch_code,13,2);
            $indata[$this->transfer->DEPT_ID] = $jodata->departments;
            $indata[$this->transfer->PHYSICAL_LOCATION] = $jodata->plocation;
            $indata[$this->transfer->REASON] = $jodata->reasons;
            $indata[$this->transfer->USERNAME] = $user_id;
            //$indata[$this->transfer->TRANSFER_TYPE] = $jodata->ttype;
            $indata[$this->transfer->UPDATED_ON] = $today;
            $indata[$this->transfer->UPDATED_BY] = $user_id;
            $indata[$this->transfer->APPROVED_BY] = $user_id;
            if ($this->basemodel->update_operation($indata, $this->transfer->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = 'Record Updated Successfully';
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = 'Unable to Process Your Request Try Again...!';
            }
        }
        return $data;
    }


    private function _all_completed_transfers_search($jodata = array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $today = date("Y-m-d H:i:s");
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            if(isset($jodata->ttype))
            {
                $indata[$this->transfer->TRANSFER_TYPE] = $jodata->ttype;
            }
            if($branch_id != 'All')
                $t_orwhere = "(".$this->transfer->BRANCH_ID."='".$branch_id."' OR ". $this->transfer->TRANSFER_BRANCH."='".$branch_id."')";
            else
                $t_orwhere = "(".$this->transfer->BRANCH_ID." IN ".BRANCHALL." OR ". $this->transfer->TRANSFER_BRANCH." IN ".BRANCHALL." )";
            $where[$this->transfer->ORG_ID] = $org_id;
            if($role_code==HBBME)
            {
                $where[$this->transfer->ADDED_BY] = $user_id;
            }
            $where[$this->transfer->DEPLOYMENT_ID." !="] = NULL;
            $like[$this->transfer->UPDATED_ON] = date('Y-m-d');
            $transfer = $this->basemodel->fetch_records_from_multi_where_like($this->transfer->tbl_name,$where,$t_orwhere,$like);
            $data['qry'] = $this->db->last_query();
            if (!empty($transfer))
            {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($transfer); $i++)
                {
                    $transfer[$i]['ename'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['equp_type'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->TYPE, array($this->cms->EID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['status'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->STATUS, array($this->cms->EID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $transfer[$i][$this->transfer->USERNAME]));
                    $transfer[$i]['tbranch_code'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_CODE, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->TRANSFER_BRANCH]));
                    $transfer[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->BRANCH_ID]));
                    $transfer[$i]['tbranch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->TRANSFER_BRANCH]));
                    $transfer[$i]['added_on'] = strtotime($transfer[$i][$this->transfer->ADDED_ON]);
                }
                $data['list'] = $transfer;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
            return $data;
        }
    }

    /*Condemnation Reasons*/
    private function _get_conreasons_list($jodata=array())
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
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->condemnationrequest->tbl_name,'','','count('.$this->condemnationrequest->ID.') AS CNT');
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
                $creasons = $this->basemodel->fetch_records_from_pagination($this->condemnationrequest->tbl_name,'','*',$this->condemnationrequest->REQUEST_NAME,'ASC','10',$limit_val*10);
            }
            else
            {
                $creasons= $this->basemodel->fetch_records_from($this->condemnationrequest->tbl_name);
            }
            if (!empty($creasons))
            {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $creasons;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }
    private function _get_conrequest_list($jodata=array())
    {


        $data = array();
        $like = array();
        if(!empty($jodata))
        {
            $where[$this->condemnation->ORG_ID] = $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $data['condem_approvals_count'] = $this->baselibrary->get_condem_approvals_count($org_id,YESSTATE);
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->condemnation->RESOLD_VALUE] = NULL;

            if($branch_id != 'All')
                $where1[$this->condemnation->BRANCH_ID] = $branch_id;
            else
            {

                $where_or = $this->condemnation->BRANCH_ID." IN ". BRANCHALL;
            }



            if(isset($jodata->aaction) && $jodata->aaction=="get_admin_calls")
            {
                unset($where[$this->condemnation->BRANCH_ID]);
            }

            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls")
            {

                $swhere[$this->devices->DISTRIBUTOR] = $jodata->vendor_org;
                $swhere[$this->devices->ASSIGN_ID. "!="] = NULL;
                $swhere[$this->devices->ORG_ID] = $jodata->org_id;
                $swhere[$this->devices->BRANCH_ID] = $jodata->branch_id;

                $devices = $this->basemodel->fetch_records_from($this->devices->tbl_name,$swhere,array($this->devices->E_ID));

                for($i = 0; $i < count($devices); $i++)
                    $device[$i] = "'".$devices[$i]['E_ID']."'";
                if(count($devices) > 0 )
                {
                    $device = '(' . implode($device, ',') . ')';
                    $where_date = $this->condemnation->EQUP_ID . " IN " . $device;
                }

                else
                    $where_date = '';

            }


            if (isset($jodata->reasons) && $jodata->reasons != "" && $jodata->reasons != NULL)
                $like[$this->condemnation->REUSABLE_PARTS] = $jodata->reasons;
            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->condemnation->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }

            if($branch_id != 'All')
                $where[$this->condemnation->BRANCH_ID] = $branch_id;
            else
            {
                $where_date .= ($where_date == '') ? '' : " AND ";
                $where_date .= $this->condemnation->BRANCH_ID." IN ". BRANCHALL;
            }

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where_like($this->condemnation->tbl_name,$where,$where_date, $like,'count('.$this->condemnation->ID.') AS CNT');

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


                $condemnation = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->condemnation->tbl_name,$where,$where_date, $like, '*',$this->condemnation->DATE_TIME,'desc','10',$limit_val*10);

                for($i = 0; $i<count($condemnation); $i++)
                {
                    $where1[$this->devices->E_ID] = $condemnation[$i]['EQUP_ID'];
                    $devices1 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1 , array($this->devices->ASSIGN_ID));

                    if(!empty($devices1)){

                        $condemnation[$i]['ASSIGN_ID'] = $devices1['ASSIGN_ID'];

                    }
                }


            }
            else
            {

                $condemnation = $this->basemodel->fetch_records_from_multi_where_like($this->condemnation->tbl_name,$where,$where_date,$like,'*',$this->condemnation->DATE_TIME,'desc');


                for($i = 0; $i<count($condemnation); $i++)
                {
                    $where1[$this->devices->E_ID] = $condemnation[$i]['EQUP_ID'];
                    $devices2 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1 ,array($this->devices->ASSIGN_ID));

                    if(!empty($devices2)){
                        // for($k = 0; $k<count($devices2); $k++)
                        //{
                        $condemnation[$i]['ASSIGN_ID'] = $devices2['ASSIGN_ID'];
                        // }
                    }
                }


            }
            //return $this->db->last_query();
            /*  if (!empty($condemnation))

                  $data['response'] = SUCCESSDATA;
                //  $data['list'] = $this->baselibrary->condemnation_details($condemnation);
             */
            if($branch_id != 'All')
                $swhere[$this->condemnation->BRANCH_ID] = $branch_id;
            else
            {

                $orr_where = $this->condemnation->BRANCH_ID." IN ". BRANCHALL;
            }
            $swhere[$this->condemnation->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));
            // return $devices;
            $condemnation_data = array();
            for($i = 0; $i < count($devices); $i++) {

                // $bwhere[$this->condemnation->STATUS . " !="] = DW;
                //$bwhere[$this->condemnation->RESPONDED_DATE] = NULL;
                $bwhere[$this->condemnation->EQUP_ID] = $devices[$i]['ASSIGN_ID'];

                $condemn_call_res = $this->basemodel->fetch_single_row($this->condemnation->tbl_name, $bwhere);

                if(!empty($condemn_call_res))
                {

                    $condemn_call_res['ASSIGN_ID'] = $devices[$i]['E_ID'];
                    // $condemn_call_res['BRANCH_ID'] = $devices[$i]['BRANCH_ID'];
                    //  $condemn_call_res['ORG_ID'] = $devices[$i]['ORG_ID'];

                    array_push($condemnation_data,$condemn_call_res);

                }

            }

            if(!empty($condemnation_data) || !empty($condemnation)){
                $condemnation = array_merge($condemnation, $condemnation_data);
                $data['response'] = SUCCESSDATA;
                $data['list'] = $this->baselibrary->condemnation_details($condemnation);
            }

            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }

            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls")
                return $condemnation;

        }
        return $data;


    }
    private function _get_con_new_request_list($jodata=array())
    {
        $data = array();
        $like = array();
        if(!empty($jodata))
        {
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->condemnation->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->condemnation->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            //$where[$this->condemnation->RESOLD_VALUE] = NULL;
            $where[$this->condemnation->ADDED_BY] = $user_id;
            if (isset($jodata->dept_id))
            {
                $where[$this->condemnation->DEPT_ID]=$jodata->dept_id;
            }
            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->condemnation->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where_like($this->condemnation->tbl_name,$where,$where_date, $like,'count('.$this->condemnation->ID.') AS CNT');
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
                $condemnation = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->condemnation->tbl_name,$where,$where_date, $like, '*',$this->condemnation->DATE_TIME,'desc','10',$limit_val*10);
            }
            else
            {
                $condemnation= $this->basemodel->fetch_records_from_multi_where_like($this->condemnation->tbl_name,$where,$where_date,$like,'*',$this->condemnation->DATE_TIME,'desc');
            }
            //$data['qry'] = $this->db->last_query();
            if (!empty($condemnation))
            {
                $data['response'] = SUCCESSDATA;
                $data['list'] = $this->baselibrary->condemnation_details($condemnation);
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }
    private function _get_completed_condemnations_search($jodata=array())
    {

        $data = array();
        $like = array();
        if(!empty($jodata))
        {
            $where[$this->condemnation->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->condemnation->RESOLD_VALUE." !="] = NULL;
            $where_date = '';

            if($branch_id != 'All'){

                $where[$this->condemnation->BRANCH_ID] = $branch_id;

            }
            else
            {
                $where_date .= ($where_date == '') ? '' : ' AND ';
                $where_date .= $this->condemnation->BRANCH_ID ." IN ".BRANCHALL;
            }
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->condemnation->UPDATED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }
            else
            {
                $like[$this->condemnation->UPDATED_ON] = date('Y-m-d');
            }



            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where_like($this->condemnation->tbl_name,$where,$where_date, $like,'count('.$this->condemnation->ID.') AS CNT');
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
                $condemnation = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->condemnation->tbl_name,$where,$where_date, $like, '*',$this->condemnation->DATE_TIME,'desc','10',$limit_val*10);

            }
            else
            {
                $condemnation= $this->basemodel->fetch_records_from_multi_where_like($this->condemnation->tbl_name,$where,$where_date,$like,'*',$this->condemnation->DATE_TIME,'desc');
            }

            //return $condemnation;
            if (!empty($condemnation))
            {
                $data['response'] = SUCCESSDATA;

                for ($i = 0; $i < count($condemnation); $i++)
                {
                    $condemnation[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $condemnation[$i][$this->condemnation->EQUP_ID]));
                    $condemnation[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $condemnation[$i][$this->condemnation->BRANCH_ID]));
                    $condemnation[$i]['phy_location'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->PHY_LOCATION, array($this->devices->E_ID => $condemnation[$i][$this->condemnation->EQUP_ID]));
                    $condemnation[$i]['equp_cost'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_COST, array($this->devices->E_ID => $condemnation[$i][$this->condemnation->EQUP_ID]));
                    $condemnation[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $condemnation[$i][$this->condemnation->DEPT_ID]));
                    $condemnation[$i]['added_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $condemnation[$i][$this->condemnation->ADDED_BY]));
                    $condemnation[$i]['added_on'] = strtotime($condemnation[$i][$this->condemnation->ADDED_ON]);
                    $reasons = explode(",",$condemnation[$i][$this->condemnation->REASON]);
                    for($j=0;$j<count($reasons);$j++)
                    {
                        $condemnation[$i]['reasons'][] = $this->basemodel->get_single_column_value($this->condemnationrequest->tbl_name,$this->condemnationrequest->REQUEST_NAME,array($this->condemnationrequest->CODE=>$reasons[$j]));
                    }
                }
                $data['list'] = $this->baselibrary->condemnation_details($condemnation);
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _add_condemnation_reasons($jodata=array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $isdata[$this->condemnationrequest->REQUEST_NAME] = $jodata->reasons;
            $isdata[$this->condemnationrequest->CODE] = $jodata->code;

            if($this->basemodel->insert_into_table($this->condemnationrequest->tbl_name,$isdata))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Condemnation Reasons Added Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }
    private function _add_condemnation_requests($jodata=array())
    {

        $data = array();
        if(!empty($jodata))
        {
            $today = date("Y-m-d H:i:s");
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $isdata[$this->condemnation->BRANCH_ID] = $branch_id;
            $isdata[$this->condemnation->ORG_ID] = $org_id;
            $isdata[$this->condemnation->DEPT_ID] = $jodata->dept_id;
            $isdata[$this->condemnation->EQUP_ID] = $jodata->equp_id;
            $isdata[$this->condemnation->REASON] = implode(',',$jodata->reasons);
            $isdata[$this->condemnation->FEEDBACK] = $jodata->feedback;
            $isdata[$this->condemnation->ADDED_ON] = $today;
            $isdata[$this->condemnation->ADDED_BY] = $user_id;
            //return $isdata;
            if($this->basemodel->insert_into_table($this->condemnation->tbl_name,$isdata))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Condemnations Added Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }
    private function _update_condemnation_request_list($jodata=array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $where[$this->condemnation->ID]=$jodata->ID;
            $today = date("Y-m-d H:i:s");
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $indata[$this->condemnation->BRANCH_ID] = $branch_id;
            $indata[$this->condemnation->ORG_ID] = $org_id;
            $isdata[$this->condemnation->DEPT_ID] = $jodata->departments;
            $isdata[$this->condemnation->EQUP_ID] = $jodata->equp_id;
            //$isdata[$this->condemnation->REASON] = implode(',',$jodata->reasons);
            $isdata[$this->condemnation->REASON] = implode(',',$jodata->reasons);
            $isdata[$this->condemnation->FEEDBACK] = $jodata->feedback;
            $isdata[$this->condemnation->UPDATED_ON] = $today;
            $isdata[$this->condemnation->UPDATED_BY] = $user_id;
            if($this->basemodel->update_operation($isdata,$this->condemnation->tbl_name,$where))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Condemnation Request Updated Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _update_cond_reasons($jodata=array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $where[$this->condemnationrequest->ID]=$jodata->ID;
            $isdata[$this->condemnationrequest->REQUEST_NAME] = $jodata->reasons;
            $isdata[$this->condemnationrequest->CODE] = $jodata->code;
            $isdata[$this->condemnationrequest->STATUS] = $jodata->status;
            if($this->basemodel->update_operation($isdata,$this->condemnationrequest->tbl_name,$where))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Condemnation Reasons Updated Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }
    private function _update_cond_approval_list($jodata=array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $where[$this->condemnation->ID]=$jodata->ID;
            $isdata[$this->condemnation->REUSABLE_PARTS] =implode(',',$jodata->reusable_part);
            $isdata[$this->condemnation->EXPECTED_COST] = $jodata->expected_cost;
            $isdata[$this->condemnation->ADMIN_FEEDBACK] = $jodata->admin_feedback;
            $isdata[$this->condemnation->CONDEMNATION_STATUS] = $jodata->acondemnation_status;
            $isdata[$this->condemnation->APPROVED_BY] = json_encode($jodata->approved_by);
            if($this->basemodel->update_operation($isdata,$this->condemnation->tbl_name,$where))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Condemnation Approval Updated Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }
    private function _update_cond_disapproval_list($jodata=array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $where[$this->condemnation->ID]=$jodata->ID;
            $isdata[$this->condemnation->ADMIN_FEEDBACK] = $jodata->admin_reasons;
            $isdata[$this->condemnation->CONDEMNATION_STATUS] = $jodata->acondemnation_status;
            if($this->basemodel->update_operation($isdata,$this->condemnation->tbl_name,$where))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Condemnation disApproval Updated Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }
    private function _update_approved_condemnation_list($jodata=array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->condemnation->ID]=$jodata->ID;
            $isdata[$this->condemnation->FEEDBACK2] = $jodata->feedback;
            $isdata[$this->condemnation->REASON2] = implode(",",$jodata->reasons);
            $isdata[$this->condemnation->RESOLD_VALUE] = $jodata->resold_value;
            $isdata[$this->condemnation->UPDATED_ON] = $user_id;
            $icdata[$this->condemnation->APPROVED_BY] = is_array($jodata->approved_by) ? json_encode($jodata->approved_by) : $jodata->approved_by;
            $isdata[$this->condemnation->UPDATED_BY] = date('Y-m-d H:i:s');
            if($this->basemodel->update_operation($isdata,$this->condemnation->tbl_name,$where))
            {

                $equip_id = $this->basemodel->get_single_column_value($this->condemnation->tbl_name,$this->condemnation->EQUP_ID,$where);

                $eqdata[$this->devices->EQ_CONDATION] = 'Condem';
                $ewhere[$this->devices->E_ID]= $equip_id;
                $this->basemodel->update_operation($eqdata,$this->devices->tbl_name,$ewhere);

                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Condemnation Approved List Updated Successfully";
            }
            else
            {
                $data['error'] = $this->db->display_error();
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }


    private function _get_reusableparts_list($jodata=array())
    {
        // print_r($jodata);
        $data = array();
        if(!empty($jodata))
        {
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->reusableparts->tbl_name,array(),'','count('.$this->reusableparts->ID.') AS CNT');
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
                $reusable_parts = $this->basemodel->fetch_records_from_pagination($this->reusableparts->tbl_name,'','*',$this->reusableparts->REUSABLE_PARTS,'ASC','10',$limit_val*10);

            }
            else
            {
                $reusable_parts= $this->basemodel->fetch_records_from($this->reusableparts->tbl_name);
            }
            if (!empty($reusable_parts))
            {
                // $data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $reusable_parts;
                //print_r($condemnation);
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }

    private function _add_reusablepart_requests($jodata=array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $isdata[$this->reusableparts->REUSABLE_PARTS] = $jodata->reusablepart;
            $isdata[$this->reusableparts->CODE] = $jodata->code;
            if($this->basemodel->insert_into_table($this->reusableparts->tbl_name,$isdata))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Reusable Parts Added Successfully";
            }
            else
            {
                $data['qry'] = $this->db->last_query();
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }


    private function _update_reusableparts_list($jodata=array())
    {
        //print_r($jodata);
        $data = array();
        if(!empty($jodata))
        {
            $where[$this->reusableparts->ID]=$jodata->ID;
            $isdata[$this->reusableparts->REUSABLE_PARTS] = $jodata->reusableparts;
            $isdata[$this->reusableparts->CODE] = $jodata->code;
            $isdata[$this->reusableparts->STATUS] = $jodata->status;
            if($this->basemodel->update_operation($isdata,$this->reusableparts->tbl_name,$where))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Reusable Parts Updated Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _add_indent_equipment($jodata = array())
    {
        $data = array();
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $today = date('Y-m-d H:i:s');
        $ivdata[$this->indents->ORG_ID] = $org_id;
        $ivdata[$this->indents->BRANCH_ID] = $branch_id;
        if (!empty($jodata))
        {
            $lindent_id = $this->basemodel->get_single_column_value($this->indents->tbl_name,$this->indents->INDENT_ID,array($this->indents->INDENT_ID." LIKE"=>"%IN".date('my')."%"),$this->indents->INDENT_ID,'desc');
            if($lindent_id=="-")
            {
                $ivdata[$this->indents->INDENT_ID] = "IN".date('my')."0001";
            }
            else
            {
                $last_val = substr($lindent_id, -4);
                $to_int = (int)$last_val;
                $ivdata[$this->indents->INDENT_ID] = $this->baselibrary->set_indent_id($to_int);
            }
            if (isset($jodata->equp_name))
                $ivdata[$this->indents->EQ_NAME] = $jodata->equp_name;
            if (isset($jodata->critical_spare))
                $ivdata[$this->indents->SPARES] = $jodata->critical_spare;
            if (isset($jodata->aindent_request))
                $ivdata[$this->indents->INDENT_TYPE] = $jodata->aindent_request;
            if (isset($jodata->accessories))
                $ivdata[$this->indents->ACCESSORIES] = $jodata->accessories;
            if (isset($jodata->company_name))
                $ivdata[$this->indents->MAKE_ID] = $jodata->company_name;
            if (isset($jodata->cat))
                $ivdata[$this->indents->EQ_CAT] = $jodata->cat;
            if (isset($jodata->departments))
                $ivdata[$this->indents->DEPT] = $jodata->departments;
            if (isset($jodata->quantity))
                $ivdata[$this->indents->QTY] = $jodata->quantity;
            if (isset($jodata->required_date))
                $ivdata[$this->indents->INDENT_REQUIRED_BY_WHEN] = $jodata->required_date;
            if (isset($jodata->desc))
                $ivdata[$this->indents->DESCRP] = strip_tags($jodata->desc);
            if (isset($jodata->essential_feature))
                $ivdata[$this->indents->ESNTL_FEATURES] = strip_tags($jodata->essential_feature);
            if (isset($jodata->desirous_features))
                $ivdata[$this->indents->OPTIMAL_FEATURES] = strip_tags($jodata->desirous_features);
            if (isset($jodata->luxrious_features))
                $ivdata[$this->indents->OPTIONAL_FEATURES] = strip_tags($jodata->luxrious_features);
            if (isset($jodata->stard_access))
                $ivdata[$this->indents->STNRD_ACCESSORIES] = strip_tags($jodata->stard_access);
            if (isset($jodata->stard_access))
                $ivdata[$this->indents->STNRD_ACCESSORIES] = strip_tags($jodata->stard_access);
            if (isset($jodata->optional_access))
                $ivdata[$this->indents->OPTIONAL_ACCESSORIES] =strip_tags( $jodata->optional_access);
            if (isset($jodata->vendor_id))
                $ivdata[$this->indents->VENDOR_ID] = $jodata->vendor_id;
            if (isset($jodata->reasons))
                $ivdata[$this->indents->REASONS] = strip_tags($jodata->reasons);
            if (isset($jodata->estimated_cost))
                $ivdata[$this->indents->ESTIMATED_COST] = $jodata->estimated_cost;
            if (isset($jodata->app_revenu_gen))
                $ivdata[$this->indents->REVENEW_GENERATION] = $jodata->app_revenu_gen;
            if (isset($jodata->benfits_desirous_features))
                $ivdata[$this->indents->DESIROUS_REVENEW] = strip_tags($jodata->benfits_desirous_features);
            if (isset($jodata->benfit_luxurious_feature))
                $ivdata[$this->indents->LUXURY_REVENEW] = strip_tags($jodata->benfit_luxurious_feature);
            if (isset($jodata->budget_approved_by))
                $ivdata[$this->indents->BUDGET_APPROVED_DATETIME] = strip_tags($jodata->budget_approved_by);
            if (isset($jodata->budget_refrence))
                $ivdata[$this->indents->BUDGET_REFF] = $jodata->budget_refrence;
            if (isset($jodata->biomedical_receipt_date))
                $ivdata[$this->indents->BME_RECEIPT_DATE] = $jodata->biomedical_receipt_date;
            if (isset($jodata->quotes_called))
                $ivdata[$this->indents->QUOTES] = $jodata->quotes_called;
            if (isset($jodata->evalution_period))
                $ivdata[$this->indents->EVALUATION_PEROID] = $jodata->evalution_period;
            if (isset($jodata->po_date))
                $ivdata[$this->indents->PO_DATE] = $jodata->po_date;
            $ivdata[$this->indents->ADDED_ON] = $today;
            $ivdata[$this->indents->RAISED_DATETIME] = $today;
            $ivdata[$this->indents->ADDED_BY] = $user_id;
            $ivdata[$this->indents->RAISED_BY] = $user_id;
            if (isset($jodata->remarks))
                $ivdata[$this->indents->REMARKS] = strip_tags($jodata->remarks);
            if ($this->basemodel->insert_into_table($this->indents->tbl_name, $ivdata)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Indent Request Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }
    private function _update_indent_equp($jodata = array())
    {
        $where =$data = array();

        if (!empty($jodata)) {
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $today = date('Y-m-d H:i:s');
            $where[$this->indents->ID]=$jodata->ID;
            if (isset($jodata->equp_name))
                $ivdata[$this->indents->EQ_NAME] = $jodata->equp_name;
            if (isset($jodata->critical_spare))
                $ivdata[$this->indents->SPARES] = $jodata->critical_spare;
            if (isset($jodata->aindent_request))
                $ivdata[$this->indents->INDENT_TYPE] = $jodata->aindent_request;
            if (isset($jodata->accessories))
                $ivdata[$this->indents->ACCESSORIES] = $jodata->accessories;
            if (isset($jodata->company_name))
                $ivdata[$this->indents->MAKE_ID] = $jodata->company_name;
            if(isset($jodata->category_name))
                $ivdata[$this->indents->EQ_CAT] = $jodata->category_name;
            if (isset($jodata->departments))
                $ivdata[$this->indents->DEPT] = $jodata->departments;
            if (isset($jodata->quantity))
                $ivdata[$this->indents->QTY] = $jodata->quantity;
            if (isset($jodata->required_date))
                $ivdata[$this->indents->INDENT_REQUIRED_BY_WHEN] = $jodata->required_date;
            if (isset($jodata->desc))
                $ivdata[$this->indents->DESCRP] = strip_tags($jodata->desc);
            if (isset($jodata->essential_feature))
                $ivdata[$this->indents->ESNTL_FEATURES] = strip_tags($jodata->essential_feature);
            if (isset($jodata->desirous_features))
                $ivdata[$this->indents->OPTIMAL_FEATURES] = strip_tags(strip_tags($jodata->desirous_features));
            if (isset($jodata->luxrious_features))
                $ivdata[$this->indents->OPTIONAL_FEATURES] = strip_tags($jodata->luxrious_features);
            if (isset($jodata->stard_access))
                $ivdata[$this->indents->STNRD_ACCESSORIES] = strip_tags($jodata->stard_access);
            if (isset($jodata->stard_access))
                $ivdata[$this->indents->STNRD_ACCESSORIES] = strip_tags($jodata->stard_access);
            if (isset($jodata->optional_access))
                $ivdata[$this->indents->OPTIONAL_ACCESSORIES] = strip_tags($jodata->optional_access);
            if (isset($jodata->vendor))
                $ivdata[$this->indents->VENDOR_ID] = $jodata->vendor;
            if (isset($jodata->reasons))
                $ivdata[$this->indents->REASONS] = strip_tags($jodata->reasons);;
            if (isset($jodata->estimated_cost))
                $ivdata[$this->indents->ESTIMATED_COST] = $jodata->estimated_cost;
            if (isset($jodata->app_revenu_gen))
                $ivdata[$this->indents->REVENEW_GENERATION] = $jodata->app_revenu_gen;
            if (isset($jodata->benfits_desirous_features))
                $ivdata[$this->indents->DESIROUS_REVENEW] = strip_tags           ($jodata->benfits_desirous_features);
            if (isset($jodata->benfit_luxurious_feature))
                $ivdata[$this->indents->LUXURY_REVENEW] = strip_tags($jodata->benfit_luxurious_feature);
            if (isset($jodata->budget_approved_by))
                $ivdata[$this->indents->BUDGET_APPROVED_DATETIME] = $jodata->budget_approved_by;
            if (isset($jodata->budget_refrence))
                $ivdata[$this->indents->BUDGET_REFF] = $jodata->budget_refrence;
            if (isset($jodata->biomedical_receipt_date))
                $ivdata[$this->indents->BME_RECEIPT_DATE] = $jodata->biomedical_receipt_date;
            if (isset($jodata->quotes_called))
                $ivdata[$this->indents->QUOTES] = $jodata->quotes_called;
            if (isset($jodata->evalution_period))
                $ivdata[$this->indents->EVALUATION_PEROID] = $jodata->evalution_period;
            if (isset($jodata->po_date))
                $ivdata[$this->indents->PO_DATE] = $jodata->po_date;
            if (isset($jodata->remarks))
                $ivdata[$this->indents->REMARKS] =strip_tags( $jodata->remarks);


            $icdata[$this->indents->BRANCH_ID] = $jodata->branch_id;
            $icdata[$this->indents->INDENT_STATUS] = $jodata->aindent_status;
            $ivdata[$this->indents->UPDATED_ON] = $today;
            $ivdata[$this->indents->UPDATED_BY] = $user_id;

            if($this->basemodel->update_operation($ivdata,$this->indents->tbl_name,$where))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Indent Equipment Updated Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _get_indent_equpiment_list($jodata = array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->indents->ORG_ID] = $org_id;

            $or_where = '';
            if($branch_id != 'All')
                $where[$this->indents->BRANCH_ID] = $branch_id;
            else
                $or_where = $this->indents->BRANCH_ID ." IN ".BRANCHALL;

            if($this->session->role_code==PURCHASE || $this->session->role_code==HMADMIN)
            {
                if($this->session->role_code==PURCHASE)
                {
                    $where[$this->indents->APPROVED_BY." !="] = NULL;
                    $where[$this->indents->INDENT_STATUS] = APPROVED;
                }
            }

            if (isset($jodata->limit_val))
            {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                // return  $or_where;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->indents->tbl_name, $where, $or_where, 'count(' . $this->indents->ID . ') AS CNT');

                if (!empty($cnt))
                {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                }
                else
                {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $indents = $this->basemodel->fetch_records_from_multi_where_pagination($this->indents->tbl_name, $where,$or_where,'*', $this->indents->INDENT_ID, 'DESC', '10', $limit_val * 10);
            }
            else
            {
                $indents = $this->basemodel->fetch_records_from_multi_where($this->indents->tbl_name,$where,$or_where);
            }

            //$data['qry'] = $this->db->last_query();
            if (!empty($indents))
            {

                /* get approval members count begin */

                $data['indent_approvals_count'] = $this->baselibrary->get_indent_approvals_count($org_id,YESSTATE);

                /* get approval members count end */
                for($i=0;$i<count($indents);$i++)
                {
                    $swhere[$this->stock->INDENT_ID]=$indents[$i][$this->indents->INDENT_ID];
                    $indents[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $indents[$i][$this->indents->BRANCH_ID]));
                    // $indents[$i]['no_of_recs'] = $this->basemodel->num_of_res($this->stock->tbl_name,$swhere);
                    $indents[$i]['department_name'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name,$this->userdeprts->USER_DEPT_NAME,array($this->userdeprts->CODE => $indents[$i][$this->indents->DEPT]));
                    $indents[$i]['category_name'] = $this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->NAME,array($this->devicenames->ID => $indents[$i][$this->indents->EQ_CAT]));
                    $indents[$i]['company_name'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name,$this->devicevendors->NAME,array($this->devicevendors->ID => $indents[$i][$this->indents->MAKE_ID]));
                    $indents[$i]['vendor_name'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID => $indents[$i][$this->indents->VENDOR_ID]));
                    if($indents[$i][$this->indents->ACCESSORIES]!=NULL)
                    {
                        $indents[$i][$this->indents->EQ_NAME] = $this->basemodel->get_single_column_value($this->accessories->tbl_name,$this->accessories->NAME,array($this->accessories->CODE=>$indents[$i][$this->indents->ACCESSORIES]));
                    }
                    else if($indents[$i][$this->indents->SPARES]!=NULL)
                    {
                        $indents[$i][$this->indents->EQ_NAME] = $this->basemodel->get_single_column_value($this->criticalspares->tbl_name,$this->criticalspares->NAME,array($this->criticalspares->CODE=>$indents[$i][$this->indents->SPARES]));
                    }
                }
                $data['response'] = SUCCESSDATA;

                $data['list'] =$indents;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }
    private function _get_indent_new_list($jodata = array())
    {
        //print_r($jodata);
        $data = array();
        if(!empty($jodata))
        {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->indents->ORG_ID] = $org_id;
            $where[$this->indents->BRANCH_ID] = $branch_id;
            $where[$this->indents->ADDED_BY] = $user_id;
            if (isset($jodata->dept_id))
                $where[$this->indents->DEPT] = $jodata->dept_id;
            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->indents->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }
            else
            {
                $where[$this->indents->ADDED_ON] = date('Y-m-d');
            }
            /*  if($this->session->role_code==PURCHASE || $this->session->role_code==HMADMIN)
              {
                  if($branch_id=="")
                  {
                      unset($where[$this->indents->BRANCH_ID]);
                  }
                  if($this->session->role_code==PURCHASE)
                  {
                      $where[$this->indents->APPROVED_BY." !="] = NULL;
                      $where[$this->indents->INDENT_STATUS] = APPROVED;
                  }
              }*/
            if (isset($jodata->limit_val))
            {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->indents->tbl_name, $where,$where_date, '', 'count(' . $this->indents->ID . ') AS CNT');
                if (!empty($cnt))
                {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                }
                else
                {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $indents = $this->basemodel->fetch_records_from_multi_where_pagination($this->indents->tbl_name, $where,$where_date, '*', $this->indents->INDENT_ID, 'DESC', '10', $limit_val * 10);
            }
            else
            {
                $indents = $this->basemodel->fetch_records_from_multi_where($this->indents->tbl_name,$where,$where_date,'*',$this->indents->ID,'DESC');
            }
            //$data['qry'] = $this->db->last_query();
            if (!empty($indents))
            {
                for($i=0;$i<count($indents);$i++)
                {
                    $swhere[$this->stock->INDENT_ID]=$indents[$i][$this->indents->INDENT_ID];
                    $indents[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $indents[$i][$this->indents->BRANCH_ID]));
                    $indents[$i]['no_of_res'] = $this->basemodel->num_of_res($this->stock->tbl_name,$swhere);
                    if($indents[$i][$this->indents->ACCESSORIES]!=NULL)
                    {
                        $indents[$i][$this->indents->EQ_NAME] = $this->basemodel->get_single_column_value($this->accessories->tbl_name,$this->accessories->NAME,array($this->accessories->CODE=>$indents[$i][$this->indents->ACCESSORIES]));
                    }
                    else if($indents[$i][$this->indents->SPARES]!=NULL)
                    {
                        $indents[$i][$this->indents->EQ_NAME] = $this->basemodel->get_single_column_value($this->criticalspares->tbl_name,$this->criticalspares->NAME,array($this->criticalspares->CODE=>$indents[$i][$this->indents->SPARES]));
                    }
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] =$indents;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        //print_r($data);
        return $data;
    }
    private function _get_cear_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $data['cear_approvals_count'] = $this->baselibrary->get_cear_approvals_count($org_id,$state=YESSTATE);
            $where[$this->cear->ORG_ID] = $org_id;
            if($branch_id !='All')
            {
                $where[$this->cear->BRANCH_ID] = $branch_id;
            }
            else
            {
                $or_where= $this->cear->BRANCH_ID. "IN" . BRANCHALL;
            }

            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->cear->tbl_name, $where, '', 'count(' . $this->cear->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $cear = $this->basemodel->fetch_records_from_pagination($this->cear->tbl_name, $where, '*', $this->cear->CATEGORY, 'ASC', '10', $limit_val * 10);

            }
            else {
                $cear = $this->basemodel->fetch_records_from($this->cear->tbl_name,$where);
            }
            if (!empty($cear)) {
                for($i=0;$i<count($cear);$i++)
                {
                    $data['category']=$this->basemodel->get_single_column_value($this->cearcategory->tbl_name, $this->cearcategory->NAME, array($this->cearcategory->CODE => $cear[$i][$this->cear->CATEGORY]));
                    $cear[$i]['dept_id'] = $this->basemodel->get_single_column_value($this->indents->tbl_name, $this->indents->DEPT, array($this->indents->INDENT_ID => $cear[$i][$this->cear->INDENT_ID]));
                    $cear[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $cear[$i][$this->cear->REQ_DEPT]));
                    $cear[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $cear[$i][$this->cear->BRANCH_ID]));
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] =$cear;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }
    private function _get_cear_new_list($jodata = array())
    {
        //print_r($jodata);
        $data = array();
        $where = array();
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        if (!empty($jodata)) {
            $where[$this->cear->ORG_ID] = $org_id;
            $where[$this->cear->BRANCH_ID] = $branch_id;
            $where[$this->cear->ADDED_BY] = $user_id;
            $where[$this->cear->ADDED_BY] = $user_id;
            if (isset($jodata->dept_id))
                $where[$this->cear->REQ_DEPT] = $jodata->dept_id;
            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->cear->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }
            else
            {
                $where[$this->cear->ADDED_ON] = date('Y-m-d');
            }
            if (isset($jodata->limit_val)) {

                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->cear->tbl_name, array(), $where_date, 'count(' . $this->cear->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $cear = $this->basemodel->fetch_records_from_multi_where_pagination($this->cear->tbl_name, $where,$where_date, '*', $this->cear->CATEGORY, 'ASC', '10', $limit_val * 10);

            }
            else {
                $cear = $this->basemodel->fetch_records_from_multi_where($this->cear->tbl_name,$where,$where_date,'*',$this->cear->ID,'DESC');
            }
            // $data['qry'] = $this->db->last_query();
            if (!empty($cear)) {
                for($i=0;$i<count($cear);$i++)
                {
                    $data['category']=$this->basemodel->get_single_column_value($this->cearcategory->tbl_name, $this->cearcategory->NAME, array($this->cearcategory->CODE => $cear[$i][$this->cear->CATEGORY]));
                    $cear[$i]['dept_id'] = $this->basemodel->get_single_column_value($this->indents->tbl_name, $this->indents->DEPT, array($this->indents->INDENT_ID => $cear[$i][$this->cear->INDENT_ID]));
                    $cear[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $cear[$i]['dept_id']));
                    $cear[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $cear[$i][$this->cear->BRANCH_ID]));
                }

                $data['response'] = SUCCESSDATA;
                $data['list'] =$cear;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        // print_r($data);
        return $data;
    }


    private function _get_cear_category_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->cearcategory->tbl_name, array(), '', 'count(' . $this->cearcategory->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $cearcategory = $this->basemodel->fetch_records_from_pagination($this->cearcategory->tbl_name, '', '*', $this->cearcategory->NAME, 'ASC', '10', $limit_val * 10);

            }
            else {
                $cearcategory = $this->basemodel->fetch_records_from($this->cearcategory->tbl_name);
            }
            if (!empty($cearcategory)) {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                $data['list'] = $cearcategory;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = array();
            }
        }
        return $data;
    }

    private function _add_cear_category_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $cear_category = $this->basemodel->get_single_column_value($this->cearcategory->tbl_name,$this->cearcategory->CODE,array($this->cearcategory->CODE=>$jodata->code));
            if($cear_category=="-") {

                $isdata[$this->cearcategory->NAME] = $jodata->cear_category_name;
                $isdata[$this->cearcategory->CODE] = $jodata->code;

                if ($this->basemodel->insert_into_table($this->cearcategory->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "CEAR Category Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->code." Cear Category Code Already Exists";
            }
        }
        return $data;
    }

    private function _update_cear_category_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $cear_category = $this->basemodel->get_single_column_value($this->cearcategory->tbl_name,$this->cearcategory->CODE,array($this->cearcategory->CODE=>$jodata->code));
            if(!empty($cear_category)) {

                $where[$this->cearcategory->ID] = $jodata->ID;
                $icdata[$this->cearcategory->NAME] = $jodata->cear_category_name;
                $icdata[$this->cearcategory->CODE] = $jodata->code;
                $icdata[$this->cearcategory->STATUS] = $jodata->status;
                if ($this->basemodel->update_operation($icdata, $this->cearcategory->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "CEAR Category Updated Successfully";
                }else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $icdata[$this->cearcategory->CODE]." Cear Category Code Already Exists";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }        return $data;
    }
    private function _update_indent_approved_list($jodata = array())
    {
        $data = array();
        $today = date('Y-m-d H:i:s');
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        //$branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        if (!empty($jodata))
        {
            $where[$this->indents->ID] = $jodata->ID;
            $icdata[$this->indents->APPROVED_BY_FEEDBACK] = $jodata->feedback;
            $icdata[$this->indents->APPROVED_BY] = $user_id;
            $icdata[$this->indents->APPROVED_DATETIME] = $today;
            $icdata[$this->indents->INDENT_STATUS] =$jodata->status;
            $icdata[$this->indents->MAKE_ID] =$jodata->company_name;
            $icdata[$this->indents->TRANS_BRANCH_ID] =$jodata->branch_id;
            $icdata[$this->indents->VENDOR_ID] =$jodata->vendor_name;

            if ($this->basemodel->update_operation($icdata, $this->indents->tbl_name, $where))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Indent Request Approved Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _update_indent_disapproved_list($jodata = array())
    {
        $data = array();
        $today = date('Y-m-d H:i:s');
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        if (!empty($jodata)) {
            $where[$this->indents->ID] = $jodata->ID;
            $icdata[$this->indents->APPROVED_BY_FEEDBACK] = $jodata->feedback;
            $icdata[$this->indents->APPROVED_BY] = $user_id;
            $icdata[$this->indents->APPROVED_DATETIME] = $today;
            $icdata[$this->indents->INDENT_STATUS] = $jodata->aindent_status;
            $icdata[$this->indents->MAKE_ID] =$jodata->company_name;
            if ($this->basemodel->update_operation($icdata, $this->indents->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Indents Disapproved Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    public function add_cear_list()
    {
        $data = array();
        if(isset($_POST['device_data']))
        {
            $jodata = json_decode($_POST['device_data']);
            $user_id = $this->session->user_id;
            $org_id = $this->session->org_id;
            // $branch_id = $this->session->branch_id;
            $today = date('Y-m-d H:i:s');
            $ivdata[$this->cear->ORG_ID] = $org_id;
            //$ivdata[$this->cear->BRANCH_ID] = $branch_id;
            if (!empty($jodata))
            {
                $lcear_id = $this->basemodel->get_single_column_value($this->cear->tbl_name, $this->cear->CEAR_ID, array($this->cear->CEAR_ID . " LIKE" => "%CE" . date('my') . "%"), $this->cear->CEAR_ID, 'desc');
                if ($lcear_id == "-") {
                    $ivdata[$this->cear->CEAR_ID] = "CE" . date('my') . "0001";
                } else {
                    $last_val = substr($lcear_id, -4);
                    $to_int = (int)$last_val;
                    $ivdata[$this->cear->CEAR_ID] = $this->baselibrary->set_cear_id($to_int);
                }
                if (isset($jodata->date))
                    $ivdata[$this->cear->DATE] = $jodata->date;
                if (isset($jodata->cear_category))
                    $ivdata[$this->cear->CATEGORY] = $jodata->cear_category;
                if (isset($jodata->indent_id))
                    $ivdata[$this->cear->INDENT_ID] = $jodata->indent_id;
                if (isset($jodata->prj_title))
                    $ivdata[$this->cear->TITLE] = $jodata->prj_title;
                if (isset($jodata->BRANCH_NAME))
                    $ivdata[$this->cear->REQ_UNIT] = $jodata->BRANCH_NAME;
                if(isset($jodata->branch))
                    $ivdata[$this->cear->BRANCH_ID] = $jodata->branch;
                if (isset($jodata->department))
                    $ivdata[$this->cear->REQ_DEPT] = $jodata->department;
                if (isset($jodata->scope_prj))
                    $ivdata[$this->cear->SOP] = strip_tags($jodata->scope_prj);
                if (isset($jodata->purpose_justification))
                    $ivdata[$this->cear->PAJ] = strip_tags($jodata->purpose_justification);
                if (isset($jodata->alernative_considered))
                    $ivdata[$this->cear->AC] = strip_tags($jodata->alernative_considered);
                if (isset($jodata->cnae))
                    $ivdata[$this->cear->CONAE] = strip_tags($jodata->cnae);
                if (isset($jodata->eobe))
                    $ivdata[$this->cear->EOOBE] = strip_tags($jodata->eobe);
                if (isset($jodata->equp_purcg))
                    $ivdata[$this->cear->EP] = strip_tags($jodata->equp_purcg);
                if (isset($jodata->cear_conformation))
                    $ivdata[$this->cear->DFATTACHED] = strip_tags($jodata->cear_conformation);
                if (isset($jodata->sdate))
                    $ivdata[$this->cear->DATE] = $jodata->sdate;
                if (isset($jodata->cdate))
                    $ivdata[$this->cear->CDATE] = $jodata->cdate;
                if (isset($jodata->cost))
                    $ivdata[$this->cear->COST] = $jodata->cost;
                if (isset($jodata->conclusion))
                    $ivdata[$this->cear->CONSLUSION] = strip_tags($jodata->conclusion);
                if (isset($jodata->cear_conformation) && $jodata->cear_conformation==YESSTATE)
                {
                    if (!empty($_FILES)) {
                        if (isset($_FILES['ppls'])) {
                            $f_type = explode(".", $_FILES['ppls']['name']);
                            $last_in = (count($f_type) - 1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH;
                            $config['allowed_types'] = '*';
                            $config['file_name'] = $f_type[0] . "_" . time() . "." . $f_type[$last_in];
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload('ppls')) {
                                $ivdata[$this->cear->PPLS] = $config['file_name'];
                            }
                        }
                        if (isset($_FILES['pp'])) {
                            usleep(1000000);
                            $f_type = explode(".", $_FILES['pp']['name']);
                            $last_in = (count($f_type) - 1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH;
                            $config['allowed_types'] = '*';
                            $config['file_name'] = $f_type[0] . "_" . time() . "." . $f_type[$last_in];
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload('pp')) {
                                $ivdata[$this->cear->PP] = $config['file_name'];
                            }
                        }
                        if (isset($_FILES['pcfs'])) {
                            usleep(1000000);
                            $f_type = explode(".", $_FILES['pcfs']['name']);
                            $last_in = (count($f_type) - 1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH;
                            $config['allowed_types'] = '*';
                            $config['file_name'] = $f_type[0] . "_" . time() . "." . $f_type[$last_in];
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload('pcfs')) {
                                $ivdata[$this->cear->PCFS] = $config['file_name'];
                            }
                        }
                        if (isset($_FILES['foaibs'])) {
                            usleep(1000000);
                            $f_type = explode(".", $_FILES['foaibs']['name']);
                            $last_in = (count($f_type) - 1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH;
                            $config['allowed_types'] = '*';
                            $config['file_name'] = $f_type[0] . "_" . time() . "." . $f_type[$last_in];
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload('foaibs')) {
                                $ivdata[$this->cear->FOAINBS] = $config['file_name'];
                            }
                        }
                        if (isset($_FILES['roiirr'])) {
                            usleep(1000000);
                            $f_type = explode(".", $_FILES['roiirr']['name']);
                            $last_in = (count($f_type) - 1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH;
                            $config['allowed_types'] = '*';
                            $config['file_name'] = $f_type[0] . "_" . time() . "." . $f_type[$last_in];
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload('roiirr')) {
                                $ivdata[$this->cear->RON_IRR] = $config['file_name'];
                            }
                        }
                    }
                    else
                    {
                        $data['response'] = FAILEDATA;
                        $data['call_back'] = "Please Upload minimum one file.";
                        print_r(json_encode($data));
                        return false;
                    }
                }
                $ivdata[$this->cear->ADDED_ON] = $today;
                $ivdata[$this->cear->ADDED_ON] = $today;
                $ivdata[$this->cear->ADDED_BY] = $user_id;
                if ($this->basemodel->insert_into_table($this->cear->tbl_name, $ivdata))
                {
                    $uwdata[$this->indents->INDENT_ID] = $ivdata[$this->cear->INDENT_ID];
                    $uidata[$this->indents->CEAR_RAISED] = YESSTATE;
                    $this->basemodel->update_operation($uidata,$this->indents->tbl_name,$uwdata);
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Cear Added Successfully";
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
        }
        print_r(json_encode($data));
        return true;
    }
    public function update_cear_list()
    {
        $where= $data = array();
        if(isset($_POST['device_data'])) {
            $jodata = json_decode($_POST['device_data']);
            $user_id = $this->session->user_id;
            $today = date('Y-m-d H:i:s');
            if (!empty($jodata))
            {
                $where[$this->cear->ID] = $jodata->ID;
                if (isset($jodata->date))
                    $ivdata[$this->cear->DATE] = date('Y-m-d', strtotime($jodata->esdate));
                if (isset($jodata->category))
                    $ivdata[$this->cear->CATEGORY] = $jodata->category;
                if (isset($jodata->prj_title))
                    $ivdata[$this->cear->TITLE] = $jodata->prj_title;
                if (isset($jodata->req_dept))
                    $ivdata[$this->cear->REQ_DEPT] = $jodata->req_dept;
                if (isset($jodata->scope_prj))
                    $ivdata[$this->cear->SOP] = strip_tags($jodata->scope_prj);
                if (isset($jodata->purpose_justification))
                    $ivdata[$this->cear->PAJ] = strip_tags($jodata->purpose_justification);
                if (isset($jodata->alernative_considered))
                    $ivdata[$this->cear->AC] = strip_tags($jodata->alernative_considered);
                if (isset($jodata->cnae))
                    $ivdata[$this->cear->CONAE] = strip_tags($jodata->cnae);
                if (isset($jodata->eobe))
                    $ivdata[$this->cear->EOOBE] = strip_tags($jodata->eobe);
                if (isset($jodata->equp_purcg))
                    $ivdata[$this->cear->EP] = strip_tags($jodata->equp_purcg);
                if (isset($jodata->cear_conformation))
                    $ivdata[$this->cear->DFATTACHED] = strip_tags($jodata->cear_conformation);
                if (isset($jodata->sdate))
                    $ivdata[$this->cear->DATE] = date('Y-m-d', strtotime($jodata->edate));
                if (isset($jodata->cdate))
                    $ivdata[$this->cear->CDATE] = date('Y-m-d', strtotime($jodata->ecdate));
                if (isset($jodata->cost))
                    $ivdata[$this->cear->COST] = $jodata->cost;
                if (isset($jodata->conclusion))
                    $ivdata[$this->cear->CONSLUSION] = strip_tags($jodata->conclusion);
                if (isset($jodata->cear_conformation) && $jodata->cear_conformation==YESSTATE)
                {
                    if(!empty($_FILES))
                    {
                        if(isset($_FILES['ppls']))
                        {
                            $f_type = explode(".",$_FILES['ppls']['name']);
                            $last_in = (count($f_type)-1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH;
                            $config['allowed_types'] = '*';
                            $config['file_name'] = $f_type[0]."_".time().".".$f_type[$last_in];
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('ppls'))
                            {
                                $ivdata[$this->cear->PPLS] = $config['file_name'];
                            }
                        }
                        if(isset($_FILES['pp']))
                        {
                            usleep(1000000);
                            $f_type = explode(".",$_FILES['pp']['name']);
                            $last_in = (count($f_type)-1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH;
                            $config['allowed_types'] = '*';
                            $config['file_name'] = $f_type[0]."_".time().".".$f_type[$last_in];
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('pp'))
                            {
                                $ivdata[$this->cear->PP] = $config['file_name'];
                            }
                        }
                        if(isset($_FILES['pcfs']))
                        {
                            usleep(1000000);
                            $f_type = explode(".",$_FILES['pcfs']['name']);
                            $last_in = (count($f_type)-1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH;
                            $config['allowed_types'] = '*';
                            $config['file_name'] = $f_type[0]."_".time().".".$f_type[$last_in];
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('pcfs'))
                            {
                                $ivdata[$this->cear->PCFS] = $config['file_name'];
                            }
                        }
                        if(isset($_FILES['foaibs']))
                        {
                            usleep(1000000);
                            $f_type = explode(".",$_FILES['foaibs']['name']);
                            $last_in = (count($f_type)-1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH;
                            $config['allowed_types'] = '*';
                            $config['file_name'] = $f_type[0]."_".time().".".$f_type[$last_in];
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('foaibs'))
                            {
                                $ivdata[$this->cear->FOAINBS] = $config['file_name'];
                            }
                        }
                        if(isset($_FILES['roiirr']))
                        {
                            usleep(1000000);
                            $f_type = explode(".",$_FILES['roiirr']['name']);
                            $last_in = (count($f_type)-1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH;
                            $config['allowed_types'] = '*';
                            $config['file_name'] = $f_type[0]."_".time().".".$f_type[$last_in];
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('roiirr'))
                            {
                                $ivdata[$this->cear->RON_IRR] = $config['file_name'];
                            }
                        }
                    }
                }
                if ($this->basemodel->update_operation($ivdata, $this->cear->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Cear Updated Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
        }
        print_r(json_encode($data));
    }
    private function _update_cear_approve($jodata=array())
    {
        $where= $data = array();
        if(!empty($jodata))
        {
            $today = date('Y-m-d H:i:s');
            if (!empty($jodata))
            {
                $where[$this->cear->ID] = $jodata->ID;
                $ivdata[$this->cear->APPROVED_BY] = json_encode($jodata->approved_by);
                if($this->basemodel->update_operation($ivdata,$this->cear->tbl_name,$where))
                {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "CEAR Approved Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
        }
        return $data;
    }

    public function update_indent_sanctioned_list()
    {
        $jodata=json_decode($_POST['device_data']);
        $data = array();
        $today = date('Y-m-d H:i:s');
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        if (!empty($jodata)) {
            $where[$this->indents->ID] = $jodata->ID;
            $icdata[$this->indents->MAKE_ID] = $jodata->company_name;
            $icdata[$this->indents->VENDOR_ID] = $jodata->vendor_name;
            $icdata[$this->indents->SANCTIONED_BY_FEEDBACK] = $jodata->feedback;
            $icdata[$this->indents->SANCTIONED_BY] = $user_id;
            $icdata[$this->indents->SANCTIONED_DATETIME] = $today;
            $icdata[$this->indents->INV_NO] = $jodata->invoice_no;
            $icdata[$this->indents->PO_NO] = $jodata->po_no;
            $icdata[$this->indents->SANCTION_STATUS] = $jodata->status;
            $icdata[$this->indents->COST] = $jodata->total_cost;
            if ($this->basemodel->update_operation($icdata, $this->indents->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                if (count($_FILES) > 0) {
                    $uploaded = $not_uploaded = 0;
                    $uploaded_indent_floder = $jodata->INDENT_ID;
                    for ($f = 0; $f < count($_FILES); $f++) {
                        $f_type = explode('.', $_FILES[$f]['name']);
                        $last_in = (count($f_type) - 1);
                        $config['upload_path'] = INDENT_UPLOAD_PATH . $uploaded_indent_floder;
                        $config['allowed_types'] = '*';
                        $time = time();
                        $config['file_name'] = $f_type[0] . '-' . $time;
                        if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload($f)) {
                            $uploaded++;
                        } else {
                            $not_uploaded++;
                            $data['uploaded_files_errors'][] = $this->upload->display_errors();

                        }
                        $data['uploaded_files'] = $uploaded;
                        $data['not_uploaded_files'] = $not_uploaded;
                    }
                }
                $data['call_back'] = "Indents Sactioned Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        print_r(json_encode($data));
        return true;
    }
    private function _update_indent_dissanctioned_list($jodata = array())
    {
        $data = array();
        $today = date('Y-m-d H:i:s');
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        if (!empty($jodata)) {
            $where[$this->indents->ID] = $jodata->ID;
            $icdata[$this->indents->SANCTIONED_BY_FEEDBACK] = $jodata->feedback;
            $icdata[$this->indents->SANCTIONED_BY] = $user_id;
            $icdata[$this->indents->SANCTIONED_DATETIME] = $today;
            $icdata[$this->indents->SANCTION_STATUS] = $jodata->indent_sactioned_status;
            if ($this->basemodel->update_operation($icdata, $this->indents->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Indents DisSactioned Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _get_gate_pass_list($jodata = array())
    {


        $data = array();
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $where[$this->gatepass->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

        $or_where = '';
        if($branch_id != 'All')
            $where[$this->gatepass->BRANCH_ID] = $branch_id;
        else
            $or_where = $this->gatepass->BRANCH_ID." IN ".BRANCHALL;

        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->gatepass->tbl_name, $where, $or_where , 'count(' . $this->gatepass->ID . ') AS CNT');
                if (!empty($cnt))
                {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                }
                else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $list = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->gatepass->tbl_name, $where, $or_where ,'*', $this->gatepass->ID, 'DESC', '10', $limit_val * 10);
            }
            else {
                $list = $this->basemodel->fetch_records_from_multi_where($this->gatepass->tbl_name,$where,$or_where ,'*',$this->gatepass->ID,'DESC');
            }

            //	return $this->db->last_query();
            if (!empty($list)) {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                for($i=0;$i<count($list);$i++)
                {
                    $spares1 = $list[$i][$this->gatepass->SPARES];
                    $spares = explode(",",$spares1);
                    for($j=0;$j<count($spares);$j++)
                    {
                        $list[$i]['cspares'][] = $this->basemodel->get_single_column_value($this->criticalspares->tbl_name, $this->criticalspares->NAME, array($this->criticalspares->CODE => $spares[$j]));
                    }
                    $accesses1 = $list[$i][$this->gatepass->ACCESSORIES];
                    $accesses = explode(",",$accesses1);
                    for($k=0;$k<count($accesses);$k++)
                    {
                        $list[$i]['accesses'][] = $this->basemodel->get_single_column_value($this->accessories->tbl_name, $this->accessories->NAME, array($this->accessories->CODE => $accesses[$k]));
                    }
                    $list[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$i][$this->gatepass->BRANCH_ID]));
                    $list[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$i][$this->gatepass->DEPT_ID]));
                    $list[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $list[$i][$this->gatepass->E_ID]));
                    $list[$i]['serial_no'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $list[$i][$this->gatepass->E_ID]));
                    $list[$i]['contract_type'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_TYPE, array($this->deviceamcs->EID => $list[$i][$this->gatepass->E_ID]));
                    $timestamp =$list[$i][$this->gatepass->ADDED_ON] ;
                    $splitTimeStamp = explode(" ",$timestamp);
                    $list[$i]['date'] = $splitTimeStamp[0];
                    $list[$i]['time'] = $splitTimeStamp[1];
                }
                $data['list'] = $list;
            }
            else {
                $data['response'] = EMPTYDATA;
                $data['list'] = array();
            }
        }
        return $data;
    }
    private function _get_gate_pass_new_list($jodata = array())
    {
        $data = array();
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        if (!empty($jodata)) {

            //$where[$this->gatepass->BRANCH_ID] = $branch_id;
            $where[$this->gatepass->ORG_ID] = $org_id;
            $where[$this->gatepass->ADDED_BY] = $user_id;
            if (isset($jodata->dept_id) && $jodata->dept_id!="")
                $where[$this->gatepass->DEPT_ID] = $jodata->dept_id;
            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->gatepass->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }
            if($branch_id != 'All')
                $where[$this->gatepass->BRANCH_ID] = $branch_id;
            else
            {

                $where_date .= $this->gatepass->BRANCH_ID." IN ". BRANCHALL;
            }

            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->gatepass->tbl_name, $where,$where_date, 'count(' . $this->gatepass->ID . ') AS CNT');
                if (!empty($cnt))
                {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                }
                else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $list = $this->basemodel->fetch_records_from_multi_where_pagination($this->gatepass->tbl_name, $where,$where_date, '*', $this->gatepass->ID, 'DESC', '10', $limit_val * 10);
            }
            else {
                $list = $this->basemodel->fetch_records_from($this->gatepass->tbl_name,$where,'*',$this->gatepass->ID,'DESC');
            }

            //return $this->db->last_query();
            if (!empty($list))
            {
                for($i=0;$i<count($list);$i++)
                {
                    $spares1 = $list[$i][$this->gatepass->SPARES];
                    $spares = explode(",",$spares1);
                    for($j=0;$j<count($spares);$j++)
                    {
                        $list[$i]['cspares'][] = $this->basemodel->get_single_column_value($this->criticalspares->tbl_name, $this->criticalspares->NAME, array($this->criticalspares->CODE => $spares[$j]));
                    }
                    $accesses1 = $list[$i][$this->gatepass->ACCESSORIES];
                    $accesses = explode(",",$accesses1);
                    for($k=0;$k<count($accesses);$k++)
                    {
                        $list[$i]['accesses'][] = $this->basemodel->get_single_column_value($this->accessories->tbl_name, $this->accessories->NAME, array($this->accessories->CODE => $accesses[$k]));
                    }
                    $list[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$i][$this->gatepass->BRANCH_ID]));
                    $list[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$i][$this->gatepass->DEPT_ID]));
                    $list[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $list[$i][$this->gatepass->E_ID]));
                    $list[$i]['serial_no'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $list[$i][$this->gatepass->E_ID]));
                    //$list[$i]['contract_type'] = $this->basemodel->get_single_column_value($this->)
                    $timestamp =$list[$i][$this->gatepass->ADDED_ON] ;
                    $splitTimeStamp = explode(" ",$timestamp);
                    $list[$i]['date'] = $splitTimeStamp[0];
                    $list[$i]['time'] = $splitTimeStamp[1];
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $list;
            }
            else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        // print_r($data);
        return $data;
    }

    private function _add_gate_pass_list($jodata = array())
    {
        $data = array();
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $today = date('Y-m-d H:i:s');
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        if(!empty($jodata))
        {
            foreach($jodata->data as $jdata)
            {
                $lcear_id = $this->basemodel->get_single_column_value($this->gatepass->tbl_name, $this->gatepass->GP_ID, array($this->gatepass->GP_ID . " LIKE" => "%GP" . date('my') . "%"), $this->gatepass->GP_ID, 'desc');
                if ($lcear_id == "-") {
                    $isdata[$this->gatepass->GP_ID] = "GP" . date('my') . "0001";
                } else {
                    $last_val = substr($lcear_id, -4);
                    $to_int = (int)$last_val;
                    $isdata[$this->gatepass->GP_ID] = $this->baselibrary->set_gatepass_id($to_int);
                }
                $isdata[$this->gatepass->BRANCH_ID] = $branch_id;
                if(isset($jdata->to_whom) && $jdata->to_whom!=null && $jdata->to_whom!="")
                {
                    if(ctype_alnum($jdata->to_whom))
                    {
                        $to_whom = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_NAME,array($this->branches->BRANCH_ID=>$jdata->to_whom));
                    }

                    else
                    {
                        $to_whom = $jdata->to_whom;
                    }
                    $isdata[$this->gatepass->TO_WHOME] = $jdata->to_whom;
                }
                $isdata[$this->gatepass->ORG_ID] = $org_id;
                if ($jdata->dept_id != ALL && $jdata->dept_id !='')
                    $isdata[$this->gatepass->DEPT_ID] = $jdata->dept_id;
                if (isset($jdata->device_id))
                    $isdata[$this->gatepass->E_ID] = $jdata->device_id;
                if (isset($jdata->gtype))
                    $isdata[$this->gatepass->RETURN_TYPE] = $jdata->gtype;
                if (isset($jdata->expert_return))
                    $isdata[$this->gatepass->EXPECTED_RETURN] = date('Y-m-d',strtotime($jdata->expert_return));
                if ($jdata->critical_spare != ALL && $jdata->critical_spare !='')
                    $isdata[$this->gatepass->SPARES] = implode(',',$jdata->critical_spare);
                if (isset($jdata->spars_cnt))
                    $isdata[$this->gatepass->SPARES_CNT] = $jdata->spars_cnt;
                if ($jdata->accessories != ALL && $jdata->accessories !='')
                    $isdata[$this->gatepass->ACCESSORIES] = implode(',',$jdata->accessories);
                if (isset($jdata->accessories_cnt))
                    $isdata[$this->gatepass->ACCESSORIES_CNT] = $jdata->accessories_cnt;
                if (isset($jdata->reasons))
                    $isdata[$this->gatepass->REASONS] = $jdata->reasons;
                if (isset($jdata->phy_location))
                    $isdata[$this->gatepass->LOCATION] = $jdata->phy_location;
                if (isset($jdata->remarks))
                    $isdata[$this->gatepass->REMARKS] = $jdata->remarks;
                $isdata[$this->gatepass->ADDED_ON] = $today;
                $isdata[$this->gatepass->ADDED_BY] = $user_id;
                //return $isdata;
                if ($this->basemodel->insert_into_table($this->gatepass->tbl_name, $isdata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Gate Pass Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable Process Your Request Try Again...!";
                }
            }
        }

        return $data;
    }

    private function _update_gate_pass($jodata = array())
    {
        $data = array();
        $org_id = isset($jodata->org_id) ? $jodata->org_id :$this->session->org_id;
        $branch_id =isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $today = date('Y-m-d H:i:s');
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        if (!empty($jodata))
        {
            log_message('error',print_r($jodata,TRUE));
            $where[$this->gatepass->ID]=$jodata->ID;
            $isdata[$this->gatepass->BRANCH_ID] = $branch_id;
            $isdata[$this->gatepass->ORG_ID] = $org_id;
            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $isdata[$this->gatepass->DEPT_ID] = $jodata->dept_id;
            if (isset($jodata->device_id))
                $isdata[$this->gatepass->E_ID] = $jodata->device_id;
            if (isset($jodata->gtype))
                $isdata[$this->gatepass->RETURN_TYPE] = $jodata->gtype;
            if (isset($jodata->to_whome))
                $isdata[$this->gatepass->TO_WHOME] = $jodata->to_whome;
            if (isset($jodata->expert_return))
                $isdata[$this->gatepass->EXPECTED_RETURN] = $jodata->expert_return;
            if ($jodata->critical_spare != ALL && $jodata->critical_spare !='')
                $isdata[$this->gatepass->SPARES] = implode(',',$jodata->critical_spare);
            if (isset($jodata->spars_cnt))
                $isdata[$this->gatepass->SPARES_CNT] = $jodata->spars_cnt;
            if ($jodata->accessories != ALL && $jodata->accessories !='')
                $isdata[$this->gatepass->ACCESSORIES] = implode(',',$jodata->accessories);
            if (isset($jodata->accessories_cnt))
                $isdata[$this->gatepass->ACCESSORIES_CNT] = $jodata->accessories_cnt;
            if (isset($jodata->reasons))
                $isdata[$this->gatepass->REASONS] = $jodata->reasons;
            if (isset($jodata->phy_location))
                $isdata[$this->gatepass->LOCATION] = $jodata->phy_location;
            if (isset($jodata->remarks))
                $isdata[$this->gatepass->REMARKS] = $jodata->remarks;
            $isdata[$this->gatepass->UPDATED_ON] = $today;
            $isdata[$this->gatepass->UPDATED_BY] = $user_id;
            if ($this->basemodel->update_operation($isdata, $this->gatepass->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Gatepass Updated Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }

    private function _get_vendorcp_user_dtls($jodata=array())
    {
        $data=array();
        if(!empty($jodata))
        {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

            $vmbl = $jodata->vmbl_no;
            $dv_where[$this->devicevendors->MOBILE_NO] = $vmbl;
            $vndr_dtls = $this->basemodel->fetch_single_row($this->devicevendors->tbl_name,$dv_where,'',$this->devicevendors->ID,'DESC',1);
            if(!empty($vndr_dtls))
            {
                $data['vendor'] = $vndr_dtls;
                $cp_where[$this->contactpersons->BRANCH_ID] = $branch_id;
                $cp_where[$this->contactpersons->ORG_ID] = $org_id;
                $cp_where[$this->contactpersons->VENDOR_ID] = $vndr_dtls[$this->devicevendors->ID];
                $cp_dtls = $this->basemodel->fetch_single_row($this->contactpersons->tbl_name,$cp_where);
                if(!empty($cp_dtls))
                {
                    $data['response'] = SUCCESSDATA;
                    $data['cps'] = $cp_dtls[$this->contactpersons->CPS_DETAILS];
                }
                else
                {
                    $data['response'] = EMPTYDATA;
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
            }
        }
        return $data;
    }

    private  function _get_vendorcp_exists($jodata)
    {
        $data=array();
        if(!empty($jodata))
        {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

            $vmbl = $jodata->vmbl_no;
            $dv_where[$this->devicevendors->MOBILE_NO] = $vmbl;
            $vndr_cnt = $this->basemodel->num_of_res($this->devicevendors->tbl_name,$dv_where);

            if($vndr_cnt == 0)
                $data['response'] = SUCCESSDATA;
            else
                $data['response'] = FAILEDATA;
        }
        return $data;
    }

    private function _add_viability($jodata = array())
    {

        $data = array();
        if (!empty($jodata)) {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $today = date('Y-m-d H:i:s');
            $ivdata[$this->viability->ADDED_BY] = $user_id;
            $ivdata[$this->viability->ADDED_ON] = $today;
            $ivdata[$this->viability->BRANCH_ID] = $branch_id;
            $ivdata[$this->viability->ORG_ID] = $org_id;
            $ivdata[$this->viability->DEPT_ID] = $jodata->dept_id;
            $ivdata[$this->viability->E_ID] = $jodata->equp_id;
            $ivdata[$this->viability->COST_OF_CONSUMABLES] = $jodata->cost_consumables;
            $ivdata[$this->viability->DISPOSABLE_COST] = $jodata->disposal_cost;
            $ivdata[$this->viability->NO_CASES_DONE_DAILY] = $jodata->no_of_cases_daily;
            $ivdata[$this->viability->CHRGS_PER_OPE] = $jodata->charge_operation;
            $ivdata[$this->viability->NUM_OPER_PER_YEAR] = $jodata->no_of_oper_per_year;
            $ivdata[$this->viability->REV_PER_YEAR] = $jodata->revenu_year;
            $ivdata[$this->viability->PROFIT_PER_YEAR	] = $jodata->Profit_over_one_year;
            $ivdata[$this->viability->PROFIT_THREE_YEARS] = $jodata->Profit_over_three_year;
            $ivdata[$this->viability->CODE_OPERATION] = $jodata->Code_of_operation;
            $ivdata[$this->viability->JUSTIFICATION] = strip_tags($jodata->justification);
            $ivdata[$this->viability->ADVANTAGES] = strip_tags($jodata->advantages);
            $ivdata[$this->viability->TECH_SPECF_EQ_PURC] = strip_tags($jodata->tsebp);
            /*$icdata[$this->cities->STATE_CODE ] = $jodata->state_code;*/
            //  $this->basemodel->insert_into_table($this->viability->tbl_name, $ivdata);
            //return $this->db->last_query();
            if ($this->basemodel->insert_into_table($this->viability->tbl_name, $ivdata)) {

                $data['response'] = SUCCESSDATA;
                $data['call_back'] = " Viability Added Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }
    private function _update_viability($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $today = date('Y-m-d H:i:s');
            $where[$this->viability->ID]=$jodata->ID;
            $ivdata[$this->viability->UPDATED_BY] = $user_id;
            $ivdata[$this->viability->UPDATED_ON] = $today;
            $ivdata[$this->viability->BRANCH_ID] = $branch_id;
            $ivdata[$this->viability->ORG_ID] = $org_id;
            $ivdata[$this->viability->DEPT_ID] = $jodata->dept_id;
            $ivdata[$this->viability->E_ID] = $jodata->equp_id;
            $ivdata[$this->viability->COST_OF_CONSUMABLES] = $jodata->cost_consumables;
            $ivdata[$this->viability->DISPOSABLE_COST] = $jodata->disposal_cost;
            $ivdata[$this->viability->NO_CASES_DONE_DAILY] = $jodata->no_of_cases_daily;
            $ivdata[$this->viability->CHRGS_PER_OPE] = $jodata->charge_operation;
            $ivdata[$this->viability->NUM_OPER_PER_YEAR] = $jodata->no_of_oper_per_year;
            $ivdata[$this->viability->REV_PER_YEAR] = $jodata->revenu_year;
            $ivdata[$this->viability->PROFIT_PER_YEAR	] = $jodata->Profit_over_one_year;
            $ivdata[$this->viability->PROFIT_THREE_YEARS] = $jodata->Profit_over_three_year;
            $ivdata[$this->viability->CODE_OPERATION] = $jodata->Code_of_operation;
            $ivdata[$this->viability->JUSTIFICATION] = strip_tags($jodata->justification);
            $ivdata[$this->viability->ADVANTAGES] = strip_tags($jodata->advantages);
            $ivdata[$this->viability->TECH_SPECF_EQ_PURC] = strip_tags($jodata->tsebp);
            /*$icdata[$this->cities->STATE_CODE ] = $jodata->state_code;*/
            if ($this->basemodel->update_operation($ivdata,$this->viability->tbl_name, $where)) {

                $data['response'] = SUCCESSDATA;
                $data['call_back'] = " Viability Upadated Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        return $data;
    }
    private function _get_viability_list($jodata=array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->viability->ORG_ID] = $org_id;
            $or_where ='';
            if($branch_id !='All')
            {
                $where[$this->viability->BRANCH_ID] = $branch_id;
            }
            else
            {
                $or_where = $this->viability->BRANCH_ID. " IN " .BRANCHALL;
            }

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;

                $cnt = $this->basemodel->fetch_records_from_multi_where($this->viability->tbl_name, $where, $or_where, 'count(' . $this->viability->ID . ') AS CNT');

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
                $viability = $this->basemodel->fetch_records_from_multi_where_pagination($this->viability->tbl_name,$where,$or_where,'*',$this->viability->ID,'ASC','10',$limit_val*10);

            }
            else
            {
                $viability= $this->basemodel->fetch_records_from_multi_where($this->viability->tbl_name,$where,$or_where);
            }



            if (!empty($viability))
            {
                $data['response'] = SUCCESSDATA;
                for($i=0;$i<count($viability);$i++)
                {


                    $where[$this->viability->E_ID] = $viability[$i][$this->viability->E_ID];
                    $device_data = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where,array($this->devices->ES_NUMBER,$this->devices->E_NAME));
                    if(!empty($device_data))
                    {
                        $viability[$i]['ename'] = $device_data[$this->devices->E_NAME];
                        $viability[$i]['esnumber'] = $device_data[$this->devices->ES_NUMBER];
                    }
                    else
                    {
                        $viability[$i]['ename'] = "-";
                        $viability[$i]['esnumber'] = "-";
                    }
                    $viability[$i]['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $viability[$i][$this->viability->BRANCH_ID]));

                    $viability[$i]['contract_type'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_TYPE, array($this->deviceamcs->EID => $viability[$i][$this->viability->E_ID]));

                    $viability[$i]['DEPT_NAME'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $viability[$i][$this->viability->DEPT_ID]));
                }

                $data['list'] = $viability;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        return $data;
    }
    private function _get_viability_new_list($jodata=array())
    {
        //print_r($jodata);
        $data = array();
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        if(!empty($jodata))
        {
            $where[$this->viability->ORG_ID] = $org_id;
            $where[$this->viability->BRANCH_ID] = $branch_id;
            $where[$this->viability->ADDED_BY] = $user_id;
            if (isset($jodata->dept_id) && $jodata->dept_id!='')
                $where[$this->viability->DEPT_ID] = $jodata->dept_id;
            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->viability->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }
            else
            {
                $where_date = $this->viability->ADDED_ON . " BETWEEN '" . date('Y-m-d') . " 00:00:00' AND '" . date('Y-m-d') . " 23:59:59'";
            }
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->viability->tbl_name,$where,$where_date,'count('.$this->viability->ID.') AS CNT');
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
                $viability = $this->basemodel->fetch_records_from_multi_where_pagination($this->viability->tbl_name,$where,$where_date,'*',$this->viability->ID,'ASC','10',$limit_val*10);
            }
            else
            {
                $viability= $this->basemodel->fetch_records_from_multi_where($this->viability->tbl_name,$where,$where_date,'*',$this->viability->ID,'DESC');
            }
            //$data['qry'] = $this->db->last_query();
            log_message('error',$this->db->last_query());
            if (!empty($viability))
            {
                for($i=0;$i<count($viability);$i++)
                {
                    $viability[$i]['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $viability[$i][$this->viability->BRANCH_ID]));
                    $viability[$i]['eq_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $viability[$i][$this->viability->E_ID]));
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $viability;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }
        // print_r($data);
        return $data;
    }

    private function _get_stock_list($jodata=array())
    {


        $data = array();
        if(!empty($jodata))
        {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;

            $or_where = '';
            if($branch_id !='All')
            {
                $where[$this->stock->BRANCH_ID]=$branch_id;
            }
            else
            {
                $or_where = $this->stock->BRANCH_ID. " IN " .BRANCHALL;
            }

            $where[$this->stock->ORG_ID] = $org_id;
            //$where[$this->stock->BRANCH_ID] = $branch_id;
            $where[$this->stock->IN_STOCK] = YESSTATE;
            /*  if($this->session->role_code==PURCHASE || $this->session->role_code==HMADMIN)
              {
                  if($branch_id=="")
                  {
                      unset($where[$this->stock->BRANCH_ID]);
                  }
              }*/

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;

                $cnt = $this->basemodel->fetch_records_from_multi_where($this->stock->tbl_name,$where,$or_where,'*',$this->stock->ID);

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
                $stock = $this->basemodel->fetch_records_from_multi_where_pagination($this->stock->tbl_name,$where,$or_where,'*',$this->stock->ID,'ASC','10',$limit_val*10);
            }
            else
            {
                $stock= $this->basemodel->fetch_records_from_multi_where($this->stock->tbl_name,$where,$or_where);
            }

            if (!empty($stock))
            {
                $data['response'] = SUCCESSDATA;
                for($i=0;$i<count($stock);$i++)
                {
                    if($stock[$i][$this->stock->INDENT_TYPE]==EQPMNT)
                    {
                        $stock[$i]['eq_cat'] = $this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->NAME,array($this->devicenames->ID=>$stock[$i][$this->stock->E_CAT]));
                    }
                    else
                    {
                        $stock[$i]['eq_cat'] = "";
                    }
                    $stock[$i]['make'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name,$this->devicevendors->NAME,array($this->devicevendors->ID=>$stock[$i][$this->stock->C_NAME]));
                    $stock[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_NAME,array($this->branches->BRANCH_ID=>$stock[$i][$this->stock->BRANCH_ID]));
                }
                $data['list'] = $stock;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
            }
        }

        return $data;
    }
    private function _get_indent_stock_counts($jodata)
    {
        $data=$iwhere=array();
        $iwhere[$this->indents->ORG_ID] = $iwhere[$this->stock->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $branch_id = $iwhere[$this->stock->BRANCH_ID] = isset($jodata->branch_id) ? isset($jodata->branch_id) : $this->session->branch_id;

        $or_where = '';
        if($branch_id != 'All')
            $iwhere[$this->indents->BRANCH_ID] = $branch_id;
        else
        {
            $or_where = $this->indents->BRANCH_ID . " IN " .BRANCHALL;
        }
        $list=$this->basemodel->fetch_records_from_multi_where($this->stock->tbl_name,array(),$or_where);
        if(!empty($list))
        {
            for($i=0;$i<count($list);$i++)
            {
                // $iwhere[$this->indents->INDENT_ID]=$list[$i][$this->stock->INDENT_ID];
                $iwhere[$this->indents->APPROVED_BY_FEEDBACK]="Approved";
                $iwhere[$this->indents->SANCTIONED_BY_FEEDBACK]="NotSanctioned";
                $data['pending_indent_cnt']=$this->basemodel->num_of_res($this->indents->tbl_name,$iwhere,$or_where);
                $swhere[$this->indents->APPROVED_BY_FEEDBACK]="Approved";
                $swhere[$this->indents->SANCTIONED_BY_FEEDBACK]="Sanctioned";
                $where[$this->indents->INDENT_ID]=$list[$i][$this->stock->INDENT_ID];
                $data['sanctioned_indent_cnt']=$this->basemodel->num_of_res($this->indents->tbl_name,$swhere,$or_where);
                $iswhere[$this->stock->IN_STOCK]=YESSTATE;
                $data['in_stock_cnt']=$this->basemodel->num_of_res($this->stock->tbl_name,$iswhere,$or_where);                                                  $oswhere[$this->stock->IN_STOCK]=NOSTATE;
                $data['out_stock_cnt']=$this->basemodel->num_of_res($this->stock->tbl_name,$oswhere,$or_where);
            }

        }
        return $data;
    }

    private function _get_org_data($jodata = array())
    {
        $data = $where = array();
        if(!empty($jodata))
        {
            $select=array($this->aptorganizations->ORG_ID,$this->aptorganizations->ORG_NAME,$this->aptorganizations->CONTACT_PERSONS);
            $list=$this->basemodel->fetch_records_from($this->aptorganizations->tbl_name,$where,$select);
            if(!empty($list))
            {
                $data['response']=SUCCESSDATA;
                for($i = 0; $i < count($list); $i++)
                    $list[$i]['CONTACT_PERSONS'] = json_decode($list[$i]['CONTACT_PERSONS']);
                $data['list']=$list;
            }
            else{
                $data['response'] = EMPTYDATA;
                $data['list'] = array();
            }

        }

        return $data;
    }
    private function _get_apt_org_cps($jodata=array())
    {
        $data=$where=array();
        if(!empty($jodata))
        {
            $where[$this->aptorganizations->ORG_ID]=$jodata->org_id;
            $list=$this->basemodel->get_single_column_value($this->aptorganizations->tbl_name,$this->aptorganizations->CONTACT_PERSONS,$where);
            //$data['qry']=$this->db->last_query();
            if($list!='-')
                $data['list']= json_decode($list);
            else
                $data['list']=array();
        }
        return $data;
    }
    private function _get_org_branch_cnt($jodata=array())
    {
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $data['ob_cnt'] = $this->basemodel->num_of_res($this->branches->tbl_name,array($this->branches->ORG_ID=>$org_id));
        $data['ob_value'] = (int)$this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->NO_OF_BRANCHES,array($this->organizations->ORG_ID=>$org_id));
        return $data;
    }
    private function _get_org_users_cnt($jodata=array())
    {
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $data['ou_cnt'] = $this->basemodel->num_of_res($this->users->tbl_name, array($this->users->ORG_ID => $org_id));
        $data['ou_value'] = (int)$this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->NO_OF_USERS, array($this->organizations->ORG_ID => $org_id));
        return $data;
    }

    private function _get_all_branchs($jodata=array())
    {
        $data = array();
        $list = $this->basemodel->fetch_records_from($this->branches->tbl_name);
        //return $this->db->last_query();
        if(!empty($list))
        {
            $data['response']=SUCCESSDATA;
            $data['list'] = $list;
        }
        else
        {
            $data['response'] = EMPTYDATA;
            $data['list'] = array();
        }
        return $data;
    }

    /* private function _add_country($jodata=array())
     {
         $input_data[$this->country->COUNTRY_CODE] = $jodata->country_code;
         $input_data[$this->country->COUNTRY_NAME] = $jodata->country_name;
         $input_data[$this->country->ADDED_ON] = date('Y-m-d h:i:s');
         //$this->basemodel->insert_into_table($this->classifications->tbl_name, $idata))

         if($this->basemodel->insert_into_table($this->country->tbl_name,$input_data)){
             $data['response'] = SUCCESSDATA;
             $data['call_back'] = 'Country Added Successfully';
         }else{
             $data['response'] = FAILEDATA;
             $data['call_back'] = 'Country Not Added Successfully';
         }
         return $data;
     }*/
    private function _add_country($jodata=array())
    {
        if (!empty($jodata)) {
            $country = $this->basemodel->get_single_column_value($this->country->tbl_name, $this->country->COUNTRY_CODE, array($this->country->COUNTRY_CODE => $jodata->country_code));
            if ($country == "-") {
                $input_data[$this->country->COUNTRY_CODE] = $jodata->country_code;
                $input_data[$this->country->COUNTRY_NAME] = $jodata->country_name;
                $input_data[$this->country->ADDED_ON] = date('Y-m-d h:i:s');
                //$this->basemodel->insert_into_table($this->classifications->tbl_name, $idata))

                if ($this->basemodel->insert_into_table($this->country->tbl_name, $input_data)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = 'Country Added Successfully';
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = 'Country Not Added Successfully';
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->country_code . " Country Code Already Exists";
            }
        }
        return $data;
    }
    private function _add_state($jodata=array())
    {
        if (!empty($jodata)) {
            $state = $this->basemodel->get_single_column_value($this->state->tbl_name, $this->state->STATE_CODE, array($this->state->STATE_CODE => $jodata->state_code));
            if ($state == "-") {
                $input_data[$this->state->STATE_CODE] = $jodata->state_code;
                $input_data[$this->state->STATE_NAME] = $jodata->state_name;
                $input_data[$this->state->COUNTRY_CODE] = $jodata->county_code;
                $input_data[$this->state->ADDED_ON] = date('Y-m-d h:i:s');
                if ($this->basemodel->insert_into_table($this->state->tbl_name, $input_data)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = 'State Added Successfully';
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = 'State Not Added Successfully';
                }
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->state_code . " State Code Already Exists";
            }
        }
        return $data;
    }
    private function _get_user_units($jodata=array())
    {
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $res = $this->basemodel->fetch_single_row($this->users->tbl_name,array($this->users->EMP_NO=>$user_id),$this->users->ORG_BRANCH_ID);

        if($res)
        {
            $data['response'] = SUCCESSDATA;
            $data['list'] = $res;
        }else{
            $data['response'] = FAILEDATA;
            $data['list'] = NULL;
        }
        return $data;
    }

    private function _transfer_equipments($jodata=array())
    {
        $today = date("Y-m-d H:i:s");
        $indent = $this->basemodel->fetch_single_row($this->indents->tbl_name,array($this->indents->ID => $jodata->id));
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $indata[$this->transfer->BRANCH_ID] = $indent[$this->indents->TRANS_BRANCH_ID];
        $indata[$this->transfer->TRANSFER_BRANCH] = $indent[$this->indents->BRANCH_ID];
        $indata[$this->transfer->ORG_ID] = $indent[$this->indents->ORG_ID];
        $indata[$this->transfer->DEPT_ID] = $indent[$this->indents->DEPT];
        $indata[$this->transfer->TRANSFER] = "Within Organisation";
        //$indata[$this->transfer->PHYSICAL_LOCATION] = $jodata->plocation;
        $indata[$this->transfer->REASON] = $indent[$this->indents->REASONS];
        $indata[$this->transfer->EQUP_ID] = $jodata->e_id;
        // $indata[$this->transfer->DEPLOYMENT_ID] = $jodata->equp_id;
        $indata[$this->transfer->E_NAME] = $indent[$this->indents->EQ_NAME];
        $indata[$this->transfer->TRANSFER_DEPT] = $indent[$this->indents->DEPT];
        $indata[$this->transfer->DATE_TIME] = $today;
        $indata[$this->transfer->ADDED_ON] = $today;
        $indata[$this->transfer->UPDATED_ON] = $today;
        $indata[$this->transfer->UPDATED_BY] = $user_id;
        $indata[$this->transfer->ADDED_BY] = $user_id;
        $indata[$this->transfer->USERNAME] = $user_id;
        $indata[$this->transfer->TRANSFER_STATUS] = "Approved";
        if($this->basemodel->insert_into_table($this->transfer->tbl_name, $indata))
        {
            $whr[$this->devices->E_ID] = $jodata->e_id;
            $upd[$this->devices->RELOCATION_STATUS] = YESSTATE;
            //$upd[$this->devices->BRANCH_RELOCATION] = $jodata->from_eq_transfer_unit;
            $tran_res = $this->basemodel->update_operation($upd,$this->devices->tbl_name,$whr);
            if($tran_res)
            {
                $data['call_back'] = "Device Transferred Successfully";
                $data['response'] = SUCCESSDATA;
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }
        }
        else
        {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable Process Your Request Try Again...!";
        }
        return $data;
    }

}

/* End of file Hbadmin.php */
/* Location: .//C/Users/Renown/AppData/Local/Temp/fz3temp-1/Hbadmin.php */