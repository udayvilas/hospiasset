<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends CI_Controller
{
    public $shref = NULL;
    public $ha_content_type = NULL;
    public $true_href = NULL;
    public $ha_authorization = NULL;
	public $ha_logo_url = "http://missionhospiasset.com/hospiasset/";
    function __construct()
    {
        parent::__construct();
        $this->load->library('zend');
        date_default_timezone_set('Asia/Kolkata');
        //header('Content-Type: application/json');
        $this->load->library('pdf');
        $this->load->library('mailer');
        //$this->load->library('excel');
        $this->load->library('baselibrary');
        $this->load->model('mailing');
        $this->load->model('organizations');
        $this->load->model('contactpersons');
        $this->load->model('qceqcats');
        $this->load->model('cearcategory');
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
        $this->load->model('equpconditions');
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
        $this->load->model('indents');
        $this->load->model('cear');
        $this->load->model('stock');
        $this->load->model('gatepass');
        include APPPATH . 'libraries/simplexlsx_class.php';
        //include APPPATH .'libraries/phpexcel/Classes/PHPExcel.php';
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
            //print_r($jodata);
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

                    //$branchs = $this->basemodel->fetch_records_from($this->branches->tbl_name,array($this->branches->STATUS=>ACTIVESTS),$this->branches->BRANCH_ID);
                    for($i = 0; $i < count($branchs); $i++)
                        $branch[$i] = "'".$branchs[$i]['BRANCH_ID']."'";
                    $branch = '(' . implode($branch, ',') . ')';

                }
            }

            defined('BRANCHALL') OR define('BRANCHALL', $branch);



            $action = $jodata->action;
            if ($action == 'get_adverse_reports')
                $data = $this->_get_adverse_reports($jodata);
            else if ($action == 'get_adverse_reports_data')
                $data = $this->_get_adverse_reports_data($jodata);
            else if ($action == 'get_deployment_reports')
                $data = $this->_get_deployment_reports($jodata);
            else if ($action == 'get_deployment_reports_pdf')
                $data = $this->_get_deployment_reports_pdf($jodata);
            else if ($action == 'get_viabilty_reports')
                $data = $this->_get_viabilty_reports($jodata);
            else if ($action == 'get_viabilty_reports_pdf')
                $data = $this->_get_viabilty_reports_pdf($jodata);
            else if ($action == 'get_condemnation_reports')
                $data = $this->_get_condemnation_reports($jodata);
            else if ($action == 'get_condemnation_reports_pdf')
                $data = $this->_get_condemnation_reports_pdf($jodata);
            else if ($action == 'get_pms_reports')
                $data = $this->_get_pms_reports($jodata);
            else if ($action == 'get_pms_reports_pdf')
                $data = $this->_get_pms_reports_pdf($jodata);
            else if ($action == 'get_qc_reports')
                $data = $this->_get_qc_reports($jodata);
            else if ($action == 'get_qc_reports_pdf')
                $data = $this->_get_qc_reports_pdf($jodata);
            else if ($action == 'get_equipment_summary_reports_pdf')
                $data = $this->_get_equipment_summary_reports_pdf($jodata);
            else if ($action == 'get_redeployment_reports_pdf')
                $data = $this->_get_redeployment_reports_pdf($jodata);
            else if ($action == 'get_calllog_reports_pdf')
                $data = $this->_get_calllog_reports_pdf($jodata);
            else if ($action == 'get_cms_reports_pdf')
                $data = $this->_get_cms_reports_pdf($jodata);
            else if ($action == 'get_monthly_performance_report_pdf')
                $data = $this->_get_monthly_performance_report_pdf($jodata);
            else if ($action == 'get_service_reports_pdf')
                $data = $this->_get_service_reports_pdf($jodata);
            else if ($action == 'get_indent_reports_pdf')
                $data = $this->_get_indent_reports_pdf($jodata);
            else if ($action == 'get_cear_reports_pdf')
                $data = $this->_get_cear_reports_pdf($jodata);
            else if ($action == 'get_gate_pass_report')
                $data = $this->_get_gate_pass_report($jodata);
            else if ($action == 'cms_barchart')
                $data = $this->_cms_barchart($jodata);
            else if ($action == 'gatepass_barchart')
                $data = $this->_gatepass_barchart($jodata);
            else if ($action == 'asset_management_other_assets')
                $data = $this->_asset_management_other_assets($jodata);
            else if ($action == 'get_equp_hstry_reports_pdf')
                $data = $this->_get_equp_hstry_reports_pdf($jodata);
            else if ($action == 'get_nscr_reports')
                $data = $this->_get_nscr_reports($jodata);
            else if ($action == 'get_nscr_reports_view')
                $data = $this->_get_nscr_reports_view($jodata);
            else if ($action == 'get_scr_reports')
                $data = $this->_get_scr_reports($jodata);
            else if ($action == 'get_scr_reports_view')
                $data = $this->_get_scr_reports_view($jodata);
            else if ($action == 'get_qcscr_reports')
                $data = $this->_get_qcscr_reports($jodata);
            else if ($action == 'get_qcscr_reports_view')
                $data = $this->_get_qcscr_reports_view($jodata);
            else if ($action == 'get_gate_pass_list')
                $data = $this->_get_gate_pass_list($jodata);
            else if ($action == 'get_cear_list')
                $data = $this->_get_cear_list($jodata);
            echo json_encode($data);
        }
    }
    /* Dialogs Start Here*/
    public function view_adverse_report_dialog()
    {
        $this->load->view('dialogs/view_adverse_report_dialog');
    }
    public function view_adverse_report_pdf_dialog()
    {
        $this->load->view('dialogs/view_adverse_report_pdf_dialog');
    }
    public function view_deployment_report_dialog()
    {
        $this->load->view('dialogs/view_deployment_report_dialog');
    }
    public function view_viability_report_dialog()
    {
        $this->load->view('dialogs/view_viability_report_dialog');
    }
    public function view_re_deployment_report_dialog()
    {
        $this->load->view('dialogs/view_re_deployment_report_dialog');
    }
    public function view_condemnation_report_dialog()
    {
        $this->load->view('dialogs/view_condemnation_report_dialog');
    }
    public function view_pms_report_dialog()
    {
        $this->load->view('dialogs/view_pms_report_dialog');
    }
    public function view_qc_report_dialog()
    {
        $this->load->view('dialogs/view_qc_report_dialog');
    }
    public function view_equipment_report_dialog()
    {
        $this->load->view('dialogs/view_equipment_report_dialog');
    }
    public function view_services_report_dialog()
    {
        $this->load->view('dialogs/view_services_report_dialog');
    }
    public function edit_cear_dialog()
    {
        $this->load->view('dialogs/edit_cear_dialog');
    }
    public function view_indent_report_dialog()
    {
        $this->load->view('dialogs/view_indent_report_dialog');
    }
    public function view_cear_report_dialog()
    {
        $this->load->view('dialogs/view_cear_report_dialog');
    }
    public function view_gate_pass_pdf()
    {
        $this->load->view('dialogs/view_gate_pass_pdf');
    }
    public function view_equp_history_report_dialog()
    {
        $this->load->view('dialogs/view_equp_history_report_pdf');
    }
    /*Reports Dialogs*/

    /*Reports Functionality*/
    private function _get_adverse_reports($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $data = array();
            $where = array();
            $like = array();
            if ($jodata->eqpid !='')
                $where[$this->incedents->EQUP_ID] = $jodata->eqpid;
            $where[$this->incedents->COMPLETED_ON." !="] = NULL;
            /*if ($jodata->spono !='')
                $like[$this->incedents->E_NAME] = $jodata->spono;
            // $where[$this->incedents->EQUP_ID." !="] = NULL;
            if ($jodata->saccessoriesno !='')
                $where[$this->incedents->ES_NUMBER] = $jodata->saccessoriesno;*/

            $where[$this->incedents->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
           // $where[$this->incedents->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $or_where = '';
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            if($branch_id !='All')
            {
                $where[$this->incedents->BRANCH_ID] = $branch_id;
            }
            else
            {
                $or_where = $this->incedents->BRANCH_ID. " IN " .BRANCHALL;
            }
           
            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $where[$this->incedents->DEPT_ID] = $jodata->dept_id;
           /* if ($jodata->saccessoriesno !='')
               $like[$this->incedents->ES_NUMBER] = $jodata->saccessoriesno; */
                $list = $this->basemodel->fetch_records_from_multi_where($this->incedents->tbl_name,$where,$or_where,'*',$this->incedents->ID,'DESC');
            $data['qry'] = $this->db->last_query();
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                $data['adversereports'] = $this->baselibrary->adverse_incidents($list);
                $data['org_id'] = $this->session->org_id;
                //print_r( $data['adversereports']);
                //die();
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
            /*}
            else{
                $data['response'] = EMPTYDATA;
            }*/
            return $data;
        }
    }

    private function _get_adverse_reports_data($jodata=array())
    {
        //print_r($jodata);
        $where="";
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->incedents->BRANCH_ID] = $branch_id;
            $where[$this->incedents->ORG_ID] = $org_id;
            $where[$this->incedents->EQUP_ID] = $jodata->equp_id;
            $list = $this->basemodel->fetch_records_from($this->incedents->tbl_name,$where);
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                $data['list'] = $this->baselibrary->adverse_incidents($list);
               // print_r($data['list']);
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }


    private function _get_deployment_reports($jodata = array())
    {

        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $data = array();
            $where = array();
            $like = array();
            if ($jodata->eqpid != '')
                $where[$this->devices->E_ID] = $jodata->eqpid;
            if ($jodata->ename != '')
                $like[$this->devices->E_NAME] = $jodata->ename;
           // $where[$this->devices->E_ID . " !="] = NULL;
            if ($jodata->saccessoriesno != '')
                $where[$this->devices->ES_NUMBER] = $jodata->saccessoriesno;
            $where[$this->devices->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
           // $where[$this->devices->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $branch_id =  isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;

            if($branch_id !='All')
            {
                $where[$this->devices->BRANCH_ID] = $branch_id;
            }else
            {
                $or_where = $this->devices->BRANCH_ID. " IN " . BRANCHALL;
            }
            if ($jodata->dept_id != ALL && $jodata->dept_id != '')
                $where[$this->devices->DEPT_ID] = $jodata->dept_id;
           /* if ($jodata->eqpid != '')
                $where[$this->devices->E_ID] = $jodata->eqpid;*/
               //return $where;
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;

                $cnt = $this->basemodel->fetch_records_with_like_multiwhere($this->devices->tbl_name, $where,$or_where, $like, 'count(' . $this->devices->ID . ') AS CNT');
              // return $this->db->last_query();
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

                $list = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->devices->tbl_name, $where, $or_where, $like, '*', $this->devices->ADDED_ON, 'asc', '10', $limit_val * 10);
            }
          else
              $list = $this->basemodel->fetch_records_with_like_multiwhere($this->devices->tbl_name, $where,$or_where, $like, '*', $this->devices->ADDED_ON);
          //return $this->db->last_query();
            if (!empty($list))
            {
                for($i=0;$i<count($list);$i++)
                {
                    $list[$i]['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_NAME,array($this->branches->BRANCH_ID=>$list[$i][$this->devices->BRANCH_ID]));
                    $list[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name,$this->userdeprts->USER_DEPT_NAME,array($this->userdeprts->CODE=>$list[$i][$this->devices->DEPT_ID]));
                    $list[$i]['contract_type'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_TYPE,array($this->deviceamcs->EID=>$list[$i][$this->devices->E_ID]));
                    $list[$i]['cms'] = $this->basemodel->fetch_single_row($this->cms->tbl_name,array($this->deviceamcs->EID=>'HYD-BME-1215-BN-COT-HCU-0374'));

                }
                $data['response'] = SUCCESSDATA;
                $data['deployment_report'] =$list;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
            //print_r($data);
            return $data;
        }
    }
    private function _get_redeployment_reports($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $data = array();
            $where = array();
            $like = array();
            if ($jodata->eqpid != '')
                $where[$this->transfer->EQUP_ID] = $jodata->eqpid;
            if ($jodata->ename != '')
                $like[$this->transfer->E_NAME] = $jodata->ename;
            $where[$this->transfer->EQUP_ID . " !="] = NULL;
            if ($jodata->saccessoriesno != '')
                $where[$this->transfer->ES_NUMBER] = $jodata->saccessoriesno;
            $where[$this->transfer->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->transfer->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            if ($jodata->dept_id != ALL && $jodata->dept_id != '')
                $where[$this->transfer->DEPT_ID] = $jodata->dept_id;
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_with_like($this->transfer->tbl_name, $where, $like, 'count(' . $this->transfer->ID . ') AS CNT');
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
                $list = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->transfer->tbl_name, $where, '', $like, '*', $this->transfer->ADDED_ON, 'asc', '10', $limit_val * 10);
            }
            else
            {
                $list = $this->basemodel->fetch_records_with_like($this->devices->tbl_name, $where, $like, '*', $this->devices->ADDED_ON);
            }

           // $list = $this->basemodel->fetch_records_with_like($this->devices->tbl_name, $where,$like,'*',$this->devices->ADDED_ON);
            //$data['qry'] = $this->db->last_query();
            if (!empty($list))
            {
                for($i=0;$i<count($list);$i++)
                {
                    $list[$i]['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_NAME,array($this->branches->BRANCH_ID=>$list[$i][$this->transfer->BRANCH_ID]));
                    $list[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name,$this->userdeprts->USER_DEPT_NAME,array($this->userdeprts->CODE=>$list[$i][$this->transfer->DEPT_ID]));
                    $list[$i]['contrat_type'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_TYPE,array($this->deviceamcs->EID=>$list[$i][$this->transfer->EQUP_ID]));
                }
                $data['response'] = SUCCESSDATA;
                $data['deployment_report'] =$list;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
            return $data;
        }
    }

    private function _get_deployment_reports_pdf($jodata=array())
    {

        //print_r($jodata);
        $where="";
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $or_where = '';
            if($branch_id !='All')
            {
                $where[$this->devices->BRANCH_ID] = $branch_id;
            }else
            {
                $or_where = $this->devices->BRANCH_ID. " IN " . BRANCHALL;
            }
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
           // $where[$this->devices->BRANCH_ID] = $branch_id;
            $where[$this->devices->ORG_ID] = $org_id;
           // $where[$this->devices->E_ID] = $jodata->equp_id;
            $list = $this->basemodel->fetch_single_row_multi_where($this->devices->tbl_name,$where,$or_where);
          // return $this->db->last_query();
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                    $list['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$this->devices->DEPT_ID]));
                    $list['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$this->devices->USERNAME]));
                    $list['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$this->devices->BRANCH_ID]));
                $list['contrat_type'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_TYPE, array($this->deviceamcs->EID => $list[$this->devices->E_ID]));
                $list[$this->deviceamcs->AMC_VENDOR]=$this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VENDOR,array($this->deviceamcs->EID => $list[$this->devices->E_ID]),$this->deviceamcs->AMC_TO ,'desc');

                    $list['vendorname'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));
                    $list['vendoraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));
                    $list['vendorcontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));

                $list['suppliername'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));
                    $list['supplieraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));
                    $list['suppliercontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));

                $data['list'] = $list;
                 //print_r($data['list']);
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }
    private function _get_viabilty_reports_pdf($jodata=array())
    {
        //print_r($jodata);
        $where="";
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->devices->BRANCH_ID] = $branch_id;
            $where[$this->devices->ORG_ID] = $org_id;
            $where[$this->devices->E_ID] = $jodata->equp_id;
            $list = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where);
            if(!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                    $list['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$this->devices->DEPT_ID]));
                    $list['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$this->devices->USERNAME]));
                    $list['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$this->devices->BRANCH_ID]));
                $list[$this->deviceamcs->AMC_VENDOR]=$this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VENDOR,array($this->deviceamcs->EID => $list[$this->devices->E_ID]),$this->deviceamcs->AMC_TO ,'desc');

                    $list['vendorname'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));
                    $list['vendoraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));
                    $list['vendorcontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));

                $list['suppliername'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));
                    $list['supplieraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));
                    $list['suppliercontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));

                $data['list'] = $list;
                 //print_r($data['list']);
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }
    private function _get_viabilty_reports($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $data = array();
            $where = array();
            $like = array();
          /*  if ($jodata->eqpid !='')
                $where[$this->viability->E_ID] = $jodata->eqpid;
            if ($jodata->ename !='')
                $like[$this->viability->E_NAME] = $jodata->ename;
            $where[$this->viability->E_ID." !="] = NULL;
            if ($jodata->saccessoriesno !='')
                $where[$this->viability->ES_NUMBER] = $jodata->saccessoriesno;
          if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $where[$this->viability->DEPT_ID] = $jodata->dept_id;
          */
            $where[$this->viability->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->viability->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from($this->viability->tbl_name, $where,'count('.$this->devices->ID.') AS CNT');
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
                $list = $this->basemodel->fetch_records_from_multi_where_pagination($this->viability->tbl_name, $where, '*',$this->viability->ADDED_ON,'asc','10',$limit_val*10);
                log_message("error",$this->db->last_query());
            }
            else
                $list = $this->basemodel->fetch_records_from($this->viability->tbl_name, $where,'*',$this->viability->ADDED_ON);

            $data['qry'] = $this->db->last_query();
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                for($i=0;$i<count($list);$i++)
                {

                    $list[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$i][$this->viability->DEPT_ID]));
                    $list[$i]['Ename'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $list[$i][$this->viability->E_ID]));
                    $list[$i]['serial_no'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $list[$i][$this->viability->E_ID]));
                    $list[$i]['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$i][$this->viability->BRANCH_ID]));
                    $list[$i][$this->deviceamcs->AMC_VENDOR]=$this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VENDOR,array($this->deviceamcs->EID => $list[$i][$this->viability->E_ID]),$this->deviceamcs->AMC_TO ,'desc');
                    $list[$i]['vendorname'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$i][$this->deviceamcs->AMC_VENDOR]));
                    $list[$i]['vendoraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$i][$this->deviceamcs->AMC_VENDOR]));
                    $list[$i]['vendorcontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$i][$this->deviceamcs->AMC_VENDOR]));

                 /*   $list[$i]['suppliername'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$i][$this->viability->DISTRIBUTOR]));
                    $list[$i]['supplieraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$i][$this->viability->DISTRIBUTOR]));
                    $list[$i]['suppliercontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$i][$this->viability->DISTRIBUTOR]));*/
                }
                $data['viability'] = $list;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }

            return $data;
        }
    }
    private function  _get_redeployment_reports_pdf($jodata = array())
    {
        $where="";
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->transfer->BRANCH_ID] = $branch_id;
            $where[$this->transfer->ORG_ID] = $org_id;
            $where[$this->transfer->E_ID] = $jodata->equp_id;
            $list = $this->basemodel->fetch_single_row($this->transfer->tbl_name,$where);
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                $list['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$this->transfer->DEPT_ID]));
                $list['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$this->transfer->USERNAME]));
                $list['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$this->transfer->BRANCH_ID]));
                $list[$this->deviceamcs->AMC_VENDOR]=$this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VENDOR,array($this->deviceamcs->EID => $list[$this->devices->E_ID]),$this->deviceamcs->AMC_TO ,'desc');

                $list['vendorname'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));
                $list['vendoraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));
                $list['vendorcontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));

                $list['suppliername'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));
                $list['supplieraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));
                $list['suppliercontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));

                $data['list'] = $list;
                //print_r($data['list']);
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }
    private function _get_condemnation_reports($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
           
            $where = array();
           // $like = array();
            if ($jodata->eqpid !='')
                $where[$this->condemnation->EQUP_ID] = $jodata->eqpid;
          /*  if ($jodata->ename !='')
                $where[$this->condemnation->E_NAME] = $jodata->ename;
           // $where[$this->condemnation->EQUP_ID." !="] = NULL;
            if ($jodata->saccessoriesno !='')
                $where[$this->condemnation->ES_NUMBER] = $jodata->saccessoriesno;*/
            $where[$this->condemnation->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id :$this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
          
		   $or_where = '';
            if($branch_id !='All')
            {
                $where[$this->condemnation->BRANCH_ID] = $branch_id;
            }
            else
                {
                    $or_where = $this->condemnation->BRANCH_ID. " IN " . BRANCHALL;
                }

            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $where[$this->condemnation->DEPT_ID] = $jodata->dept_id;

            $condemnation = $this->basemodel->fetch_records_from_multi_where($this->condemnation->tbl_name, $where,$or_where,'*',$this->condemnation->ADDED_ON);

            //$data['qry'] = $this->db->last_query();
         //   return $this->db->last_query();
            if (!empty($condemnation))
            {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($condemnation); $i++)
                {
                    $condemnation[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $condemnation[$i][$this->condemnation->EQUP_ID]));
                    $condemnation[$i]['model'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_MODEL, array($this->devices->E_ID => $condemnation[$i][$this->condemnation->EQUP_ID]));
                    $condemnation[$i]['es_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $condemnation[$i][$this->condemnation->EQUP_ID]));
                    $condemnation[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $condemnation[$i][$this->condemnation->DEPT_ID]));
                    $condemnation[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $condemnation[$i][$this->condemnation->BRANCH_ID]));
                    $condemnation[$i]['year_of_purchage'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DATEOF_INSTALL, array($this->devices->E_ID =>$condemnation[$i][$this->condemnation->EQUP_ID]));
                    $condemnation[$i]['equp_val'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_COST, array($this->devices->E_ID => $condemnation[$i][$this->condemnation->EQUP_ID]));
                    $condemnation[$i]['comany_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->C_NAME, array($this->devices->E_ID =>  $condemnation[$i][$this->condemnation->EQUP_ID]));
                }
                $data['condemnation'] =$condemnation;
                //print_r( $data['condemnation']);
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }


        }

        return $data;
    }

    private function _get_condemnation_reports_pdf($jodata=array())
    {
        $where="";
        $data = array();
        if(!empty($jodata))
        {
            $or_where = '';
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            if($branch_id !='All')
            {
                $where[$this->condemnation->BRANCH_ID] = $branch_id;
            }
            else {
                $or_where = $this->condemnation->BRANCH_ID. " IN " .BRANCHALL;
            }
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            $where[$this->condemnation->ORG_ID] = $org_id;
            $where[$this->condemnation->EQUP_ID] = $jodata->equp_id;
            $list = $this->basemodel->fetch_single_row_multi_where($this->condemnation->tbl_name,$where,$or_where);
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                $list['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$this->condemnation->DEPT_ID]));
                $list['manfature'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->C_NAME, array($this->devices->E_ID => $list[$this->condemnation->EQUP_ID]));
                $list['year_of_purchage'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DATEOF_INSTALL, array($this->devices->E_ID => $list[$this->condemnation->EQUP_ID]));
                $list['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$this->condemnation->BRANCH_ID]));
                $list['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $list[$this->condemnation->EQUP_ID]));
                $list['comany_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->C_NAME, array($this->devices->E_ID => $list[$this->condemnation->EQUP_ID]));
                $list['model'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_MODEL, array($this->devices->E_ID => $list[$this->condemnation->EQUP_ID]));
                $list['equp_val'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_COST, array($this->devices->E_ID => $list[$this->condemnation->EQUP_ID]));
                $list['es_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $list[$this->condemnation->EQUP_ID]));
                $resons=explode(",",$list[$this->condemnation->REASON]);

                for($i=0;$i<count($resons);$i++) {
                    $list['reasons'][] = $this->basemodel->get_single_column_value($this->condemnationrequest->tbl_name, $this->condemnationrequest->REQUEST_NAME, array($this->condemnationrequest->CODE => $resons[$i]));
                }
                    $reusableparts=explode(",",$list[$this->condemnation->REUSABLE_PARTS]);

                for($j=0;$j<count($reusableparts);$j++) {
                    $list['reusableparts'][] = $this->basemodel->get_single_column_value($this->reusableparts->tbl_name, $this->reusableparts->REUSABLE_PARTS, array($this->reusableparts->CODE => $reusableparts[$j]));
                }

                //$list['date'] = date('Y-m-d',strtotime($list[$this->condemnation->ADDED_ON]));
                //$list['time'] = date('H:i:s',strtotime($list[$this->condemnation->ADDED_ON]));
                $timestamp =$list[$this->condemnation->ADDED_ON] ;
                $splitTimeStamp = explode(" ",$timestamp);
                $list['date'] = $splitTimeStamp[0];
                $list['time'] = $splitTimeStamp[1];
                $data['list'] = $list;
                //print_r($data['list']);

            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _get_pms_reports($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $data = array();
            $where = array();
            $like = array();
           /* if($jodata->eqpid !='')
                $where[$this->pmsdetails->EID] = $jodata->eqpid;*/
            if(isset($jodata->pms_type))
            {
                if($jodata->pms_type==PENDING)
                    $where[$this->pmsdetails->PMS_ACTL_DONE] = NULL;
                else if($jodata->pms_type==COMPLETED)
                    $where[$this->pmsdetails->PMS_ACTL_DONE." != "] = NULL;
            }
            if(isset($jodata->fromdate))
            {
                $from_date = date("Y-m",strtotime($jodata->fromdate));
                $like[$this->pmsdetails->PMS_DUE_DATE] = $from_date;
            }
            else
            {
                $like[$this->pmsdetails->PMS_DUE_DATE] = date('Y-m');
            }
            /* if ($jodata->ename !='')
                 $where[$this->pmsdetails->E_NAME] = $jodata->ename;

             if ($jodata->saccessoriesno !='')
                 $where[$this->pmsdetails->ES_NUMBER] = $jodata->saccessoriesno;*/
            $where[$this->pmsdetails->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
           // $where[$this->pmsdetails->BRANCH_ID] = $this->session->branch_id;
            $or_where = '';
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            if($branch_id !='All')
            {
                $where[$this->pmsdetails->BRANCH_ID] = $branch_id;
            }
            else
            {
                $or_where = $this->pmsdetails->BRANCH_ID. " IN " .BRANCHALL;
            }
            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $where[$this->pmsdetails->EID." LIKE"] = '___-___-____-__-'.$jodata->dept_id.'-___-%';
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_with_like_multiwhere($this->pmsdetails->tbl_name, $where,$or_where,$like,'count('.$this->pmsdetails->ID.') AS CNT');

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
                $pms_report = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->pmsdetails->tbl_name, $where,$or_where,$like, '*',$this->pmsdetails->PMS_DONE,'DESC','10',$limit_val*10);
            }
            else
                $pms_report = $this->basemodel->fetch_records_with_like_multiwhere($this->pmsdetails->tbl_name, $where,$or_where,$like,'*',$this->pmsdetails->PMS_DONE,'DESC');

            $data['qry'] = $this->db->last_query();

            if (!empty($pms_report))
            {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($pms_report); $i++)
                {
                    $pms_report[$i]['Completed_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $pms_report[$i][$this->pmsdetails->COMPLETED_BY]));
                    $pms_report[$i]['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $pms_report[$i][$this->pmsdetails->PMS_ASSIGNED_BY]));
                    $pms_report[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $pms_report[$i][$this->pmsdetails->EID]));
                    $pms_report[$i]['model'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_MODEL, array($this->devices->E_ID => $pms_report[$i][$this->pmsdetails->EID]));
                    $pms_report[$i]['es_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $pms_report[$i][$this->pmsdetails->EID]));
                    $pms_report[$i]['contract_type'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_TYPE, array($this->deviceamcs->EID => $pms_report[$i][$this->pmsdetails->EID]));
                    $pms_report[$i]['dept_id'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DEPT_ID, array($this->devices->E_ID => $pms_report[$i][$this->pmsdetails->EID]));
                    $pms_report[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $pms_report[$i]['dept_id']));
                    $pms_report[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $pms_report[$i][$this->pmsdetails->BRANCH_ID]));
                    $list['date'] =$pms_report[$i][$this->pmsdetails->PMS_DONE];
                }
                $data['pmsreport'] =$pms_report;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }

            return $data;
        }
    }


    private function _get_pms_reports_pdf($jodata=array())
    {
        //print_r($jodata);
        $where="";
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->pmsdetails->BRANCH_ID] = $branch_id;
            $where[$this->pmsdetails->ORG_ID] = $org_id;
            $where[$this->pmsdetails->EID] = $jodata->equp_id;
            $list = $this->basemodel->fetch_single_row($this->pmsdetails->tbl_name,$where,'*',$this->pmsdetails->ID,'DESC');
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                $list['dept_id'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DEPT_ID, array($this->devices->E_ID => $list[$this->pmsdetails->EID]));
                $list['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list['dept_id']));
                $list['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $list[$this->pmsdetails->EID]));
                $list['model'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_MODEL, array($this->devices->E_ID => $list[$this->pmsdetails->EID]));
                $list['es_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $list[$this->pmsdetails->EID]));
                $list['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$this->pmsdetails->BRANCH_ID]));
                $list['date'] =$list[$this->pmsdetails->PMS_DONE];
                $data['list'] = $list;
                //print_r($data['list']);

            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }



    private function _get_qc_reports($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $data = array();
            $where = array();
            $like = array();
            if ($jodata->eqpid !='')
                $where[$this->qcdetails->EID] = $jodata->eqpid;
            if ($jodata->ename !='')
                 $like[$this->condemnation->E_NAME] = $jodata->ename;
             //$where[$this->condemnation->EQUP_ID." !="] = NULL;
             if ($jodata->saccessoriesno !='')
                 $where[$this->condemnation->ES_NUMBER] = $jodata->saccessoriesno;
            $where[$this->qcdetails->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $or_where = '';
            if($branch_id !='All')
            {
                $where[$this->qcdetails->BRANCH_ID] = $branch_id;
            }else
            {
                $or_where = $this->qcdetails->BRANCH_ID ." IN ".BRANCHALL;
            }
            //$where[$this->qcdetails->BRANCH_ID] = $this->session->branch_id;

            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $where[$this->qcdetails->EID." LIKE"] = '___-___-____-__-'.$jodata->dept_id.'-___-%';

            if(isset($jodata->qc_type))
            {
                if($jodata->qc_type==PENDING)
                    $where[$this->qcdetails->QC_ACTL_DONE] = NULL;
                else if($jodata->qc_type==COMPLETED)
                    $where[$this->qcdetails->QC_ACTL_DONE." != "] = NULL;
            }
            if(isset($jodata->fromdate))
            {
                $from_date = date("Y-m",strtotime($jodata->fromdate));
                $like[$this->qcdetails->QC_DUE] = $from_date;
            }
            else
            {
                $like[$this->qcdetails->QC_DUE] = date('Y-m');
            }
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_with_like_multiwhere($this->qcdetails->tbl_name, $where,$or_where,$like,'count('.$this->qcdetails->ID.') AS CNT');
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
                $qc_report = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->qcdetails->tbl_name, $where,$or_where,$like, '*',$this->qcdetails->QC_DONE,'DESC','10',$limit_val*10);
            }
            else
                $qc_report = $this->basemodel->fetch_records_with_like_multiwhere($this->qcdetails->tbl_name, $where,$or_where,$like,'*',$this->qcdetails->QC_DONE,'DESC');

            $data['qry'] = $this->db->last_query();
            if (!empty($qc_report))
            {
                $data['response'] = SUCCESSDATA;
                for ($i = 0;$i < count($qc_report);$i++)
                {
                    $qc_report[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $qc_report[$i][$this->qcdetails->EID]));
                    $qc_report[$i]['contract_type'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_TYPE, array($this->deviceamcs->EID => $qc_report[$i][$this->qcdetails->EID]));
                    $vendor_id = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->C_NAME, array($this->devices->E_ID => $qc_report[$i][$this->qcdetails->EID]));
                        $vendor_dtls=$this->basemodel->fetch_single_row($this->devicevendors->tbl_name,array($this->devicevendors->ID=>$vendor_id));
                        if(!empty($vendor_dtls))
                        {

                            $qc_report[$i]['vendor_name']= $vendor_dtls[$this->devicevendors->NAME];
                            $qc_report[$i]['vendor_cno']= $vendor_dtls[$this->devicevendors->MOBILE_NO];

                            $cpwhere[$this->contactpersons->ORG_ID]=$this->session->org_id;
                            $cpwhere[$this->contactpersons->BRANCH_ID]=$this->session->branch_id;
                            $cpwhere[$this->contactpersons->VENDOR_ID]=$vendor_id;
                            $cp_details = $this->basemodel->get_single_column_value($this->contactpersons->tbl_name,$this->contactpersons->CPS_DETAILS,$cpwhere);
                            if($cp_details!='-')
                            {
                                $cp_details1 = json_decode($cp_details,TRUE);
                                foreach($cp_details1['contact_persons'] as $cps)
                                {
                                    if($cps['priority']==1)
                                    {
                                        $qc_report[$i][$this->devicevendors->CP_NAME] = $cps['contact_person'];
                                        $qc_report[$i][$this->devicevendors->CP_EMAIL] = $cps['cpemail'];
                                        $qc_report[$i][$this->devicevendors->CP_NUMBER] = $cps['contact_person_no'];
                                        break;
                                    }
                                }
                            }
                            else
                            {
                                $qc_report[$i][$this->devicevendors->CP_NAME] = $qc_report[$i][$this->devicevendors->CP_EMAIL] = $qc_report[$i][$this->devicevendors->CP_NUMBER] = NULL;
                            }
                        }
                        else{
                            $qc_report[$i]['vendor_name']= $qc_report[$i]['vendor_cno']= $qc_report[$i][$this->devicevendors->CP_NAME] = $qc_report[$i][$this->devicevendors->CP_EMAIL] = $qc_report[$i][$this->devicevendors->CP_NUMBER] = NULL;
                        }

                    $qc_report[$i]['model'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_MODEL, array($this->devices->E_ID => $qc_report[$i][$this->qcdetails->EID]));
                    $qc_report[$i]['es_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $qc_report[$i][$this->qcdetails->EID]));
                    $qc_report[$i]['dept_id'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DEPT_ID, array($this->devices->E_ID => $qc_report[$i][$this->qcdetails->EID]));
                    $qc_report[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $qc_report[$i]['dept_id']));
                    $qc_report[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $qc_report[$i][$this->qcdetails->BRANCH_ID]));
                    $qc_report[$i]['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $qc_report[$i][$this->qcdetails->ASSIGNED_BY]));
                    $qc_report[$i]['Completed_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $qc_report[$i][$this->qcdetails->COMPLETED_BY]));
                }
                $data['qcreport'] =$qc_report;
                //print_r( $data['condemnation']);
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }

            return $data;
        }
    }


    private function _get_qc_reports_pdf($jodata=array())
    {
        //print_r($jodata);
        $where="";
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->qcdetails->BRANCH_ID] = $branch_id;
            $where[$this->qcdetails->ORG_ID] = $org_id;
            $where[$this->qcdetails->EID] = $jodata->equp_id;
            $list = $this->basemodel->fetch_single_row($this->qcdetails->tbl_name,$where);
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                $list['dept_id'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DEPT_ID, array($this->devices->E_ID => $list[$this->qcdetails->EID]));
                $list['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list['dept_id']));
                $list['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $list[$this->qcdetails->EID]));
                $list['model'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_MODEL, array($this->devices->E_ID => $list[$this->qcdetails->EID]));
                $list['es_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $list[$this->qcdetails->EID]));
                $list['contract_type'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_TYPE, array($this->deviceamcs->EID => $list[$this->qcdetails->EID]));
                $list['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$this->qcdetails->BRANCH_ID]));
                //$list['date'] = date('Y-m-d',strtotime($list[$this->condemnation->ADDED_ON]));
                //$list['time'] = date('H:i:s',strtotime($list[$this->condemnation->ADDED_ON]));
                $timestamp =$list[$this->qcdetails->QC_DONE] ;
                $splitTimeStamp = explode(" ",$timestamp);
                $list['date'] = $splitTimeStamp[0];
                //$list['time'] = $splitTimeStamp[1];
                $list[$this->deviceamcs->AMC_VENDOR]=$this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VENDOR,array($this->deviceamcs->EID => $list[$this->devices->E_ID]),$this->deviceamcs->AMC_TO ,'desc');
                $list['amc_value']=$this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,array($this->deviceamcs->EID => $list[$this->devices->E_ID]),$this->deviceamcs->AMC_TO ,'desc');

                $list['vendorname'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));
                $list['vendoraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));
                $list['vendorcontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$this->deviceamcs->AMC_VENDOR]));
                $list['suppliername'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));
                $list['supplieraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));
                $list['suppliercontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$this->devices->DISTRIBUTOR]));
                $data['list'] = $list;
                //print_r($data['list']);
                //exit();

            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }
    private function _get_calllog_reports_pdf($jodata=array())
    {
        //print_r($jodata);
        $where="";
        $where_date="";
        $data = $like = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->incedents->BRANCH_ID] = $branch_id;
            $where[$this->incedents->ORG_ID] = $org_id;
            $where[$this->cms->TO_ADVERSE] =NULL;
            if ($jodata->eqpid !='')
                $where[$this->cms->EID] = $jodata->equp_id;
            $where[$this->cms->ORG_ID] = $org_id;
            $where[$this->cms->BRANCH_ID] =$branch_id;
            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $like[$this->cms->EID] = $jodata->dept_id;
            if ($jodata->contract_type != ALL && $jodata->contract_type !='')
                $where[$this->cms->TYPE] = $jodata->contract_type;
            if ($jodata->call_cost !='')
                $where[$this->cms->EID] = $jodata->call_cost;
            if ($jodata->vendor !='')
                $where[$this->cms->EID] = $jodata->vendor;
            if ($jodata->completed_time !='')
                $where[$this->cms->RESPONDED_TIME] = date('H:i',strtotime($jodata->responded_time));
            if ($jodata->completed_time !='')
                $where[$this->cms->CTIME] = date('H:i',strtotime($jodata->completed_time));

            if (isset($jodata->fromdate) && isset($jodata->todate) && $jodata->fromdate != "" && $jodata->todate != "")
            {
                $where_date = $this->cms->JOBCOMPLETED_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            }
            $list = $this->basemodel->fetch_records_from_multi_where_like($this->cms->tbl_name, $where, $where_date,$like, '*', $this->cms->JOBCOMPLETED_DATE, 'desc');
            if (!empty($list))
            {

           for($i=0;$i<count($list);$i++)
                {
                    $vendorid = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_VENDOR, array($this->deviceamcs->EID => $list[$i][$this->cms->EID]),$this->deviceamcs->AMC_TO,'desc');
                    if($vendorid!=NULL && $vendorid!='-' && $vendorid !='')
                    {
                        $list[$i]['vendorname']=$this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID =>$vendorid));
                    }
                    else
                    {
                        $list[$i]['vendorname']='';
                    }
                    //print_r($list[$i]['vendorname']);
                }
                $data['response'] = SUCCESSDATA;
                //$list['time']=date("Y-m-d");
                //$list['date']=date("h:i:sa");
                $data['list'] = $this->baselibrary->cms_call_details($list);
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _get_equipment_summary_reports_pdf($jodata = array())
    {
        $data = array();
        $where = array();
        $like = array();

        $where[$this->branches->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

        if($role_code == HMADMIN)
        {
            $list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
        }
        else if($role_code == HBBME || $role_code == HBHOD)
        {
            $branch_id = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->ORG_BRANCH_ID,array($this->users->USER_ID =>$user_id));
            $branchid=explode(",",$branch_id);
            $or_where="(";
            for($k=0;$k<count($branchid);$k++)
            {
                if($k!=0)
                {
                    $or_where .= " OR ";
                }
                $or_where .= $this->branches->BRANCH_ID . " = '".$branchid[$k]."'";
            }
            $or_where.=")";
            $list = $this->basemodel->fetch_records_from_multi_where($this->branches->tbl_name, $where,$or_where);
        }

        if (!empty($list))
        {
            $no_eqp_total=0;
            $no_contract_total=0;
            $no_equp_value_total=0;
            $no_cont_value_total=0;
            $no_valueeq_unser_contract_total=0;
            $number_total=0;
            $cvalue_total=0;
            $tvalue_total=0;
            $ctvalue_total=0;
            for($i=0;$i<count($list);$i++)
            {
                $where[$this->devices->BRANCH_ID]=$list[$i][$this->branches->BRANCH_ID];
                //$where[$this->devices->AMC_TYPE .' !=']="Biomedical";
                $list[$i]['no_of_equipment']=$this->basemodel->num_of_res($this->devices->tbl_name,$where);
                $list[$i]['value_equipment']=round($this->basemodel->sum_of_column($this->devices->tbl_name,$this->devices->E_COST,$where),2);
                $rwhere[$this->deviceamcs->STATUS]=OPEN;
                $rwhere[$this->deviceamcs->BRANCH_ID]=$where[$this->devices->BRANCH_ID];
                $rwhere[$this->deviceamcs->ORG_ID]=$where[$this->devices->ORG_ID];
                $rwhere[$this->deviceamcs->AMC_TYPE .' !=']="Biomedical";
               // $rwhere[$this->deviceamcs->UPDATED_ON .' !=']="NULL";
                $list[$i]['no_of_contracts']=$this->basemodel->count_no_distinct_records($this->deviceamcs->tbl_name,$this->deviceamcs->EID,$rwhere,'','',$this->deviceamcs->AMC_TO,'DESC');
                $list[$i]['value_contracts']=round($this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$where),2);
                $contracts=$this->basemodel->fetch_distinct_records($this->deviceamcs->tbl_name,$rwhere,$this->deviceamcs->EID,'','DESC');

                $cec=0;
                for($j=0;$j<count($contracts);$j++)
                {
                    $dwhere[$this->devices->STATUS]="ACT";
                    $dwhere[$this->devices->BRANCH_ID]=$where[$this->devices->BRANCH_ID];
                    $dwhere[$this->devices->ORG_ID]=$where[$this->devices->ORG_ID];
                    $dwhere[$this->devices->E_ID]=$contracts[$j][$this->deviceamcs->EID];
                    $dwhere[$this->devices->E_COST.' !=']=RENTAL;
                    $contract_equp_cost = $this->basemodel->get_single_column_value($this->devices->tbl_name,$this->devices->E_COST,$dwhere);
                    if(is_numeric($contract_equp_cost))
                    {
                        $cec = $cec+$contract_equp_cost;
                    }
                }
				
				$list[$i]['cec']=$cec;
                if (!is_nan($list[$i]['no_of_contracts'] / $list[$i]['no_of_equipment'])) {
                    $number = ($list[$i]['no_of_contracts'] / $list[$i]['no_of_equipment']) * 100;
                    $list[$i]['NUMBER'] = round($number, 2);
                } else {
                    $list[$i]['NUMBER'] = floatval(0.00);
                }

                if (!is_nan($list[$i]['value_contracts'] / $list[$i]['value_equipment'])) {
                    $t_value = ($list[$i]['value_contracts'] / $list[$i]['value_equipment']) * 100;
                    $list[$i]['TVALUE'] = round($t_value, 2);
                } else {
                    $list[$i]['TVALUE'] = floatval(0.00);
                }

                if($cec != 0) {
                    if (!is_nan($list[$i]['value_contracts'] / $list[$i]['cec'])) {
                        $t_value = ($list[$i]['value_contracts'] / $list[$i]['cec']) * 100;
                        $list[$i]['CVALUE'] = round($t_value, 2);
                    } else {
                        $list[$i]['CVALUE'] = floatval(0.00);
                    }
                    if (!is_nan($list[$i]['cec'] / $list[$i]['value_equipment'])) {
                        $t_value = ($list[$i]['cec'] / $list[$i]['value_equipment']) * 100;
                        $list[$i]['CTVALUE'] = round($t_value, 2);
                    } else {
                        $list[$i]['CTVALUE'] = floatval(0.00);
                    }
                }
                else
                    $list[$i]['CVALUE'] = floatval(0.00);

                $no_eqp_total=$no_eqp_total+$list[$i]['no_of_equipment'];
                $no_contract_total=$no_contract_total+$list[$i]['no_of_contracts'];
                $no_equp_value_total=$no_equp_value_total+$list[$i]['value_equipment'];
                $no_cont_value_total=$no_cont_value_total+$list[$i]['value_contracts'];
                $no_valueeq_unser_contract_total=$no_valueeq_unser_contract_total+$list[$i]['cec'];
                $number_total=$number_total+$list[$i]['NUMBER'];
                $cvalue_total=$cvalue_total+$list[$i]['CVALUE'];
                $tvalue_total=$tvalue_total+$list[$i]['TVALUE'];
                $ctvalue_total=$ctvalue_total+$list[$i]['CTVALUE'];

            }

            $data['no_eqp_total'] = $no_eqp_total;
            $data['no_contract_total'] = $no_contract_total;
            $data['no_equp_value_total'] = $no_equp_value_total;
            $data['no_cont_value_total'] = $no_cont_value_total;
            $data['no_valueeq_unser_contract_total'] = $no_valueeq_unser_contract_total;
            $data['number_total'] = $number_total;
            $data['cvalue_total'] = $cvalue_total;
            $data['tvalue_total'] = $tvalue_total;
            $data['ctvalue_total'] = $ctvalue_total;
            $data['response'] = SUCCESSDATA;
            $data['equpment_summary'] = $list;
            //print_r( $data['equpment_summary']);
        }
        else
        {
            $data['response'] = EMPTYDATA;
        }
       //print_r($data);
        return $data;
    }

    private function _get_cms_reports_pdf($jodata=array())
    {
        /*if (!empty($jodata))
        {*/
            $data = array();
            $where = array();
            $like = array();

        $where[$this->branches->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

            if($role_code == HMADMIN)
            {
                $list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
            }
            else if($role_code==HBBME || $role_code==HBHOD)
            {
                $branch_id = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->ORG_BRANCH_ID,array($this->users->USER_ID =>$user_id));
                $branchid=explode(",",$branch_id);
                $or_where="(";
                for($k=0;$k<count($branchid);$k++)
                {
                    if($k!=0)
                    {
                        $or_where .= " OR ";
                    }
                    $or_where .= $this->branches->BRANCH_ID . " = '".$branchid[$k]."'";
                }
                $or_where.=")";
                $list = $this->basemodel->fetch_records_from_multi_where($this->branches->tbl_name, $where,$or_where);
            }

            //$data['qry'] = $this->db->last_query();
            $contracts=$this->basemodel->fetch_records_from($this->contracttypes->tbl_name);

            if (!empty($list))
            {
                $data['tot_subtotal_pms']=0;
                $data['tot_subtotal_bkdwms']=0;
                $data['total_lt_1d']=0;
                $data['total_lt_3d']=0;
                $data['total_gt_3d']=0;
                $data['total_lt_1d_pcs']=0;
                $data['total_lt_10']=0;
                $data['total_lt_60']=0;
                $data['total_gt_60']=0;
                $data['total_lt_10_pcs']=0;
                $data['total_lt_60_pcs']=0;
                $data['total_calls_total']=0;
                $data['total_install_total']=0;

                for($i=0;$i<count($list);$i++)
                {
                    $no_tot_bkdwn_total=0;
                    $no_tot_pms_total=0;
                    $tot_subtotal_Bbd=0;
                    $where[$this->cms->BRANCH_ID]=$list[$i][$this->branches->BRANCH_ID];
                    $where[$this->cms->TO_ADVERSE]=NULL;
                    $where_date = '';
                    if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
                    {
                        $where_date = $this->cms->CDATE." BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) ."' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
                    }

                    else{
                        $date=date('Y-m-d');
                        $date2 = date('Y-m-d',strtotime("+1 month",strtotime($date)));
                        $where_date = $this->cms->CDATE." BETWEEN '" . $date ."' AND '" . $date2 . "'";
                    }
                    $pwhere[$this->pmsdetails->BRANCH_ID]=$list[$i][$this->branches->BRANCH_ID];

                    for($j=0;$j<count($contracts);$j++)
                    {
                    $like[$this->cms->CALLER_ID]="-".$contracts[$j][$this->contracttypes->CFORM]."BD-";
                    $list[$i]['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_bkdwns']=$this->basemodel->num_of_res($this->cms->tbl_name,$where,$where_date,'','',$like);
                        log_message('error',$this->db->last_query());
                        $data["tot_no_".$contracts[$j][$this->contracttypes->CFORM]."bd"]=$list[$i]['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_bkdwns']+$data["tot_no_".$contracts[$j][$this->contracttypes->CFORM]."bd"];
                    $no_tot_bkdwn_total=$no_tot_bkdwn_total+$list[$i]['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_bkdwns'];
                        //$tot_subtotal_Bbd=$tot_subtotal_Bbd+$no_tot_bkdwn_total;
                        $plike[$this->pmsdetails->JOB_ID]="-".$contracts[$j][$this->contracttypes->CFORM]."P-";
                        $list[$i]['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_pms']=$this->basemodel->num_of_res($this->pmsdetails->tbl_name,$pwhere,'','','',$plike);
                        $iwhere=$this->pmsdetails->JOB_ID;
                        $list[$i]['no_of_installs']=$this->basemodel->num_of_res($this->pmsdetails->tbl_name,$iwhere,'','');
                        $data["tot_no_".$contracts[$j][$this->contracttypes->CFORM]."pms"]=$list[$i]['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_pms']+$data["tot_no_".$contracts[$j][$this->contracttypes->CFORM]."pms"];
                        $no_tot_pms_total=$no_tot_pms_total+$list[$i]['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_pms'];
                        $rwhere[$this->cms->RESPONSE_TIME.' <=']=10;
                        $rwhere[$this->cms->RESPONSE_TIME.' !=']=NULL;
                        $list[$i]['response_lt_10']=$this->basemodel->num_of_res($this->cms->tbl_name,$rwhere,$where,'');

                        $rwhere1[$this->cms->RESPONSE_TIME.' <=']=60;
                        $rwhere1[$this->cms->RESPONSE_TIME.' >']=10;
                        $rwhere1[$this->cms->RESPONSE_TIME.' !=']=NULL;
                        $list[$i]['response_lt_60']=$this->basemodel->num_of_res($this->cms->tbl_name,$rwhere1,$where,'');
                        $rwhere2[$this->cms->RESPONSE_TIME.' >']=60;
                        $rwhere2[$this->cms->RESPONSE_TIME.' !=']=NULL;
                        $list[$i]['response_gt_60']=$this->basemodel->num_of_res($this->cms->tbl_name,$rwhere2,$where,'');

                        $list[$i]['toatl_response_time']=$list[$i]['response_gt_60']+ $list[$i]['response_lt_60']+$list[$i]['response_lt_10'];
                        $list[$i]['response_time_lt_10pcs']=round(($list[$i]['response_lt_10']/$list[$i]['toatl_response_time'])*100,2);                      $list[$i]['response_time_lt_60pcs']=round(($list[$i]['response_lt_60']/$list[$i]['toatl_response_time'])*100,2);
                        $twhere[$this->cms->TIME_TO_REPAIR.' <=']=1;
                        $twhere[$this->cms->TIME_TO_REPAIR.' !=']=NULL;

                        $list[$i]['ttr_lt_1d']=$this->basemodel->num_of_res($this->cms->tbl_name,$twhere,$where,'');
                        $twhere1[$this->cms->TIME_TO_REPAIR.' <=']=3;
                        $twhere1[$this->cms->TIME_TO_REPAIR.' >']=1;
                        $twhere1[$this->cms->TIME_TO_REPAIR.' !=']=NULL;

                        $list[$i]['ttr_lt_3d']=$this->basemodel->num_of_res($this->cms->tbl_name,$twhere1,$where,'');
                        $twhere2[$this->cms->TIME_TO_REPAIR.' >']=3;
                        $twhere2[$this->cms->TIME_TO_REPAIR.' !=']=NULL;

                        $list[$i]['ttr_gt_3d']=$this->basemodel->num_of_res($this->cms->tbl_name,$twhere2,$where,'');
                        $list[$i]['timetoreparir_total']=$list[$i]['ttr_lt_1d']+$list[$i]['ttr_lt_3d']+$list[$i]['ttr_gt_3d'];
                        $list[$i]['ttr_lt_1d_inpcs']=round(($list[$i]['ttr_lt_1d']/$list[$i]['timetoreparir_total'])*100,2);


                    }
                    $list[$i]['no_tot_bkdwn_total']=$no_tot_bkdwn_total;
                    $list[$i]['no_tot_pms_total']=$no_tot_pms_total;
                    $list[$i]['no_calls_total']=$no_tot_pms_total+$no_tot_bkdwn_total;
                    $data['tot_subtotal_pms']=$no_tot_pms_total+$data['tot_subtotal_pms'];
                    $data['tot_subtotal_bkdwms']=$no_tot_bkdwn_total+$data['tot_subtotal_bkdwms'];
                    $data['total_calls_total']=$data['tot_subtotal_pms']+$data['tot_subtotal_bkdwms'];
                    $data['total_lt_1d']=$data['total_lt_1d']+$list[$i]['ttr_lt_1d'];
                    $data['total_lt_3d']=$data['total_lt_3d']+$list[$i]['ttr_lt_3d'];
                    $data['total_gt_3d']=$data['total_gt_3d']+$list[$i]['ttr_gt_3d'];
                    $data['total_lt_1d_pcs']=$data['total_lt_1d_pcs']+$list[$i]['ttr_lt_1d_inpcs'];
                    $data['total_lt_10']=$data['total_lt_10']+$list[$i]['response_lt_10'];
                    $data['total_lt_60']=$data['total_lt_60']+$list[$i]['response_lt_60'];
                    $data['total_gt_60']=$data['total_gt_60']+$list[$i]['response_gt_60'];
                    $data['total_lt_10_pcs']=$data['total_lt_10_pcs']+$list[$i]['response_time_lt_10pcs'];
                    $data['total_lt_60_pcs']=$data['total_lt_60_pcs']+$list[$i]['response_time_lt_60pcs'];
                }
                $data['response'] = SUCCESSDATA;
                $data['cms_report'] =$list;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
            return $data;
        /*}*/
    }
    private function _get_monthly_performance_report_pdf($jodata=array())
    {
        $swhere=$dawhere=$data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;

            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            if($jodata->mprsdate!="")
            {
                $date=date('Y-m-d',strtotime($jodata->mprsdate));
            }
            else
            {
                $date=date('Y-m-d');
            }
            $date2 = date('Y-m-d',strtotime("+1 month",strtotime($date)));

            /*cause codes*/
            /*
              $cclist=$this->basemodel->fetch_records_from($this->causecodes->tbl_name);
            if (!empty($cclist))
            {
                for($p=0;$p<count($cclist);$p++)
                {
                    $where[$this->cms->RESPONDED_TIME.' >']=60;
                    $where[$this->cms->TIME_TO_REPAIR.' >']=1;
                    $where[$this->cms->PENDING_REASON]=$cclist[$p][$this->causecodes->CAUSE];
                    $data['count'][$p]=$this->basemodel->num_of_res($this->cms->tbl_name,$where);
                    $data['cause_codes'][$p]=$cclist[$p][$this->causecodes->CAUSE];
                    //print_r( $data['cause_code']);
                }
                // $data['cause_codes'] = $this->basemodel->fetch_records_from($this->cms->tbl_name,$where);
                //print_r($data);
            }*/
                $clist=$this->basemodel->fetch_records_from($this->causecodes->tbl_name, '', array($this->causecodes->CAUSE, $this->causecodes->ID));
                   $list=array();
                   $data['cause_codes'] =$this->basemodel->fetch_records_from($this->causecodes->tbl_name);


            /*live contracts*/
            $tlc_where[$this->deviceamcs->ORG_ID] = $org_id;
            $tlc_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $tlc_where[$this->deviceamcs->STATUS] = OPEN;
            $tlc_where[$this->deviceamcs->AMC_FROM." <="]=$date;
            $tlc_where[$this->deviceamcs->AMC_TO." >"]=$date2;
            $tlc_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$tlc_where);
            $tlc_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$tlc_where);
            $data['tlc_cost']=$tlc_sum;
            $data['tlc_count']=$tlc_count;

            /* expired contracts till last month*/
            $exc_where[$this->deviceamcs->ORG_ID] = $org_id;
            $exc_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $exc_where[$this->deviceamcs->AMC_TYPE." !="] = WARRANTY;
            $last_mnth = date('Y-m-01',strtotime("-1 month",strtotime($date)));
            $exc_where1 = $this->deviceamcs->AMC_TO . " BETWEEN '" . $last_mnth . "' AND '" . $date . "'";
            $exc_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$exc_where,$exc_where1);
            $exc_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$exc_where,$exc_where1);
            $data['exc_sum']=$exc_sum;
            $data['exc_count']=$exc_count;

            /* expired warranty till last month  */
            unset($exc_where[$this->deviceamcs->AMC_TYPE." !="]);
            $exc_where[$this->deviceamcs->AMC_TYPE] = WARRANTY;
            $exw_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$exc_where,$exc_where1);
            $exw_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$exc_where,$exc_where1);
            $data['exw_sum']=$exw_sum;
            $data['exw_count']=$exw_count;

            /* contracts expired and sent for renewal */
            $cesr_where[$this->deviceamcs->ORG_ID] = $org_id;
            $cesr_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $cesr_where[$this->deviceamcs->RID." !="] = NULL;
            $cesr_where[$this->deviceamcs->AMC_TYPE." !="] = WARRANTY;
            $cesr_where[$this->deviceamcs->UPDATE_TYPE] = 'R';
            $cesr_like[$this->deviceamcs->ADDED_ON] = date('Y-m',strtotime($date));
            $cesr_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$cesr_where,'',$cesr_like);
            $cesr_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$cesr_where,'','','',$cesr_like);
            $data['cesr_sum']=$cesr_sum;
            $data['cesr_count']=$cesr_count;

            /* warranty expired and sent for renewal */
            unset($cesr_where[$this->deviceamcs->AMC_TYPE." !="]);
            $cesr_where[$this->deviceamcs->AMC_TYPE] = WARRANTY;
            $wesr_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$cesr_where,'',$cesr_like);
            $wesr_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$cesr_where,'','','',$cesr_like);
            $data['wesr_sum']=$wesr_sum;
            $data['wesr_count']=$wesr_count;

            /* contract renewals done since last month */
            $crlm_where[$this->deviceamcs->ORG_ID] = $org_id;
            $crlm_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $crlm_where[$this->deviceamcs->AMC_TYPE." !="] = WARRANTY;
            $crlm_where[$this->deviceamcs->UPDATE_TYPE] = 'R';
            $crlm_where1 = $this->deviceamcs->ADDED_ON . " BETWEEN '" . $last_mnth . " 00:00:00' AND '" . $date . " 23:59:59'";
            $crlm_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$crlm_where,$crlm_where1);
            $crlm_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$crlm_where,$crlm_where1);
            $data['crlm_sum']=$crlm_sum;
            $data['crlm_count']=$crlm_count;

            /* contract renewals Pending */
            $crp_where[$this->deviceamcs->ORG_ID] = $org_id;
            $crp_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $crp_where[$this->deviceamcs->AMC_TYPE." !="] = WARRANTY;
            $crp_where[$this->deviceamcs->UPDATE_TYPE] = 'R';
            $crp_where[$this->deviceamcs->AMC_TO." <"] = $date;
            $crp_where[$this->deviceamcs->STATUS] = OPEN;
            $crp_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$crp_where);
            $crp_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$crp_where);
            $data['crp_sum']=$crp_sum;
            $data['crp_count']=$crp_count;

            /* total contracts renewal pening */
            unset($crp_where[$this->deviceamcs->AMC_TYPE." !="]);
            $tcrp_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$crp_where);
            $tcrp_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$crp_where);
            $data['tcrp_sum']=$tcrp_sum;
            $data['tcrp_count']=$tcrp_count;
            /* expiring contracts in cmg month*/
            $eccm_where[$this->deviceamcs->ORG_ID] = $org_id;
            $eccm_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $eccm_where[$this->deviceamcs->AMC_TYPE." !="] = WARRANTY;
            $next_mnth = date('Y-m-d',strtotime("+1 month",strtotime($date)));
            $eccm_where1 = $this->deviceamcs->AMC_TO . " BETWEEN '" . $date . "' AND '" . $next_mnth . "'";
            $eccm_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$eccm_where,$eccm_where1);
            $eccm_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$eccm_where,$eccm_where1);
            $data['eccm_sum']=$eccm_sum;
            $data['eccm_count']=$eccm_count;

            /* expiring warranty in cmg month  */
            unset($eccm_where[$this->deviceamcs->AMC_TYPE." !="]);
            $eccm_where[$this->deviceamcs->AMC_TYPE] = WARRANTY;
            $ewcm_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$eccm_where,$eccm_where1);
            $ewcm_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$eccm_where,$eccm_where1);
            $data['ewcm_sum']=$ewcm_sum;
            $data['ewcm_count']=$ewcm_count;
            /* warr. to contracts not desired  */
            $data['wcnd_sum']=0;
            $data['wcnd_count']=0;
            /* contract renewals not desired  */
            $data['crnd_sum']=0;
            $data['crnd_count']=0;
            /* cont's (to be) indented for renewal */
            $data['cir_sum']=0;
            $data['cir_count']=0;
            /* branch engineers productivity */
            $users_where[$this->users->ORG_ID]=$org_id;
            $users_where[$this->users->ROLE_CODE." !="]=HBUSER;
            $users_like[$this->users->ORG_BRANCH_ID]=$branch_id;
            $branch_users = $this->basemodel->fetch_records_with_like($this->users->tbl_name,$users_where,$users_like,array($this->users->USER_ID,$this->users->USER_NAME));
            if(!empty($branch_users))
            {
                /*cms*/
                $user_cms_done[$this->cms->STATUS]= DW;
                $user_cms_done[$this->cms->ORG_ID]= $org_id;
                $user_cms_done[$this->cms->BRANCH_ID]= $branch_id;
                $user_cms_done_like[$this->cms->CDATE]= date('Y-m',strtotime($date));
                /*rounds*/
                $user_rounds_done[$this->rounds->BRANCH_ID]= $branch_id;
                $user_rounds_done[$this->rounds->ORG_ID]= $org_id;
                $user_rounds_like[$this->rounds->START_DATE]= date('Y-m',strtotime($date));
                /*pms*/
                $user_pms_done[$this->pmsdetails->BRANCH_ID]= $branch_id;
                $user_pms_done[$this->pmsdetails->ORG_ID]= $org_id;
                $user_pms_like[$this->pmsdetails->PMS_ACTL_DONE]= date('Y-m',strtotime($date));
                for($l=0;$l<count($branch_users);$l++)
                {
                    $user_cms_done[$this->cms->ATTENDED_BY]= $branch_users[$l][$this->users->USER_ID];
                    $user_rounds_done[$this->rounds->USERNAME]= $branch_users[$l][$this->users->USER_ID];
                    $user_pms_done[$this->pmsdetails->COMPLETED_BY]= $branch_users[$l][$this->users->USER_ID];
                    $user_cms_count=$this->basemodel->num_of_res($this->cms->tbl_name,$user_cms_done,'','','',$user_cms_done_like);
                    $user_rounds_count=$this->basemodel->num_of_res($this->rounds->tbl_name,$user_rounds_done,'','','',$user_rounds_like);
                    $user_pms_count=$this->basemodel->num_of_res($this->pmsdetails->tbl_name,$user_pms_done,'','','',$user_pms_like);
                    $user_trngs_count=0;
                    $data['calls'][$l]['cms_cnt']=$user_cms_count;
                    $data['calls'][$l]['rounds_cnt']=$user_rounds_count;
                    $data['calls'][$l]['pms_cnt']=$user_pms_count;
                    $data['calls'][$l]['trngs_cnt']=$user_trngs_count;
                    $data['calls'][$l]['name']=$branch_users[$l][$this->users->USER_NAME];
                    $data['calls'][$l]['total_trips']=$user_cms_count+$user_rounds_count+$user_pms_count+$user_trngs_count;
                }
            }
            $condem_like[$this->condemnation->ADDED_ON] = date('Y-m',strtotime($date));
            $condem_where[$this->condemnation->EXPECTED_COST." !="] = NULL;
            $condem_where[$this->condemnation->ORG_ID] = $this->session->org_id;
            $condem_where[$this->condemnation->BRANCH_ID] = $this->session->branch_id;
            $condem_where[$this->condemnation->EXPECTED_COST." !="] = NULL;
            $condem_list=$this->basemodel->sum_of_column($this->condemnation->tbl_name,$this->condemnation->EXPECTED_COST,$condem_where,'',$condem_like);
            $data['condem_cost'] = $condem_list;
            $condem_cnt=$this->basemodel->num_of_res($this->condemnation->tbl_name,$condem_where,'','','',$condem_like);
            $data['condem_count'] = $condem_cnt;

            $aidlike[$this->incedents->DATE_OCCRANCE] =date('Y-m',strtotime($date));
            $aidwhere[$this->incedents->COMPLETED_BY." !="] =NULL;
            $aidwhere[$this->incedents->ACTION_TACKEN." !="] =NULL;
            $aidwhere[$this->incedents->ORG_ID] = $this->session->org_id;
            $aidwhere[$this->incedents->BRANCH_ID] = $this->session->branch_id;
            $aid_list=$this->basemodel->sum_of_column($this->incedents->tbl_name,$this->incedents->TOTAL_COST,$aidwhere,'',$aidlike);
            $data['incidents_cost'] = $aid_list;
            $aid_cnt=$this->basemodel->num_of_res($this->incedents->tbl_name,$aidwhere,'','','',$aidlike);
            $data['incidents_count'] = $aid_cnt;
            //Grn COUNT And COST
            $dvc_like[$this->devices->GRN_DATE] = date('Y-m',strtotime($date));
            $dvc__where[$this->devices->GRN_VALUE." !="] = NULL;
            $dvc__where[$this->devices->ORG_ID] = $this->session->org_id;
            $dvc__where[$this->devices->BRANCH_ID] = $branch_id;
            $dvc__list=$this->basemodel->sum_of_column($this->devices->tbl_name,$this->devices->GRN_VALUE,$dvc__where,'',$dvc_like);
            $data['grn_cost'] = $dvc__list;
            $grn_cnt=$this->basemodel->num_of_res($this->devices->tbl_name,$dvc__where,'','','',$dvc_like);
            $data['grn_count'] = $grn_cnt;
            //Equp COUNT And COST
            $eqp__where[$this->devices->DATEOF_INSTALL." !="] = NULL;
            $eqp__where[$this->devices->ORG_ID] = $this->session->org_id;
            $eqp__where[$this->devices->BRANCH_ID] = $branch_id;
            $eqp__list=$this->basemodel->sum_of_column($this->devices->tbl_name,$this->devices->E_COST,$eqp__where,'');
            $data['eq_cost'] = $eqp__list;
            $eqp_cnt=$this->basemodel->num_of_res($this->devices->tbl_name,$eqp__where,'','','');
            $data['eq_count'] = $eqp_cnt;
            /*print_r( $data['eq_cost']);
            print_r( $data['eq_count']);
           die();*/
            //Accessories Cnt And Cost
            $abwhere[$this->accessories->STATUS]='A';
            $alist=$this->basemodel->sum_of_column($this->accessories->tbl_name,$this->accessories->COST,$abwhere);
            $data['accessories_cost']=$alist;
            $alist_cnt=$this->basemodel->num_of_res($this->accessories->tbl_name,$abwhere);
            $data['accessories_cnt']=$alist_cnt;
            //Spares Cnt And Cost
            $swhere[$this->criticalspares->STATUS]='A';
            $slist=$this->basemodel->sum_of_column($this->criticalspares->tbl_name,$this->criticalspares->COST,$swhere);
            $data['spares_cost']=$slist;
            $slist_cnt=$this->basemodel->num_of_res($this->criticalspares->tbl_name,$swhere);
            $data['spares_cnt']=$slist_cnt;
            $data['astotalcount']=$data['accessories_cnt']+$data['spares_cnt'];
            $data['astotalcost']=$data['accessories_cost']+$data['spares_cost'];
            //services Details
            $srwhere[$this->cms->STATUS]='A';
            $srlist=$this->basemodel->sum_of_column($this->cms->tbl_name,$this->cms->COST,$srwhere);
            $data['services_cost']=$srlist;
            $srlist_cnt=$this->basemodel->num_of_res($this->cms->tbl_name,$swhere);
            $data['services_cnt']=$srlist_cnt;
            $data['consubble_cost']=0;
            $data['consubble_cnt']=0;
            //print_r($data);
            $dalist_tot = $dalist_tot_cnt = 0;
            $contracts=$this->basemodel->fetch_records_from($this->contracttypes->tbl_name);
            for($k=0;$k<count($contracts);$k++)
            {
                $dawhere[$this->deviceamcs->AMC_TYPE]=$contracts[$k][$this->contracttypes->CTYPE];
                $dawhere[$this->deviceamcs->STATUS]=OPEN;
                $dawhere[$this->deviceamcs->AMC_FROM." <="]=$date;
                $dawhere[$this->deviceamcs->AMC_TO." >"]=$date2;
                $dalist=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$dawhere);
                $dalist_cnt=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$dawhere);
                $data['Assets'][$contracts[$k][$this->contracttypes->CTYPE]] = $dalist;
                $dalist_tot = $dalist_tot+$dalist;
                $data['assets_cnt'][$contracts[$k][$this->contracttypes->CTYPE]]= $dalist_cnt;
                $dalist_tot_cnt = $dalist_tot_cnt+$dalist_cnt;
            }
            $data['Assets']['total'] = $dalist_tot;
            $data['assets_cnt']['total'] = $dalist_tot_cnt;
            $qclike[$this->qcdetails->QC_DUE]=date('Y-m',strtotime($date));
            $qcwhere[$this->qcdetails->COMPLETED_BY." !="]=NULL;
            $qclist=$this->basemodel->sum_of_column($this->qcdetails->tbl_name,$this->qcdetails->COST,$qcwhere,'',$qclike);
            //print_r($this->db->last_query());
            $data['qcdone_cost']=$qclist;
            $qclist_cnt=$this->basemodel->num_of_res($this->qcdetails->tbl_name,$qcwhere,'','','',$qclike);
            $data['qcdone_cnt']=$qclist_cnt;
            //print_r($data);
            $where[$this->cms->BRANCH_ID] = $branch_id;
            $where[$this->cms->ORG_ID] = $org_id;
            //$list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
            //print_r($list);

            /*if (!empty($list))
            {*/
                /*for($i=0;$i<count($list);$i++)
                {*/
                    $no_tot_bkdwn_total=0;
                    $no_tot_pms_total=0;
                    $tot_subtotal_Bbd=0;
                    $where[$this->cms->BRANCH_ID]=$branch_id;
                    $pwhere[$this->pmsdetails->BRANCH_ID]=$branch_id;
                    for($j=0;$j<count($contracts);$j++)
                    {
                        $like[$this->cms->CALLER_ID]="-".$contracts[$j][$this->contracttypes->CFORM]."BD-";
                        $data['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_bkdwns']=$this->basemodel->num_of_res($this->cms->tbl_name,$where,'','','',$like);
                        //log_message('error',$contracts[$j][$this->contracttypes->CFORM].":::::".$this->db->last_query());
                        $data["tot_no_".$contracts[$j][$this->contracttypes->CFORM]."bd"]=$data['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_bkdwns']+$data["tot_no_".$contracts[$j][$this->contracttypes->CFORM]."bd"];
                        $no_tot_bkdwn_total=$no_tot_bkdwn_total+$data['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_bkdwns'];
                        //$tot_subtotal_Bbd=$tot_subtotal_Bbd+$no_tot_bkdwn_total;
                        $plike[$this->pmsdetails->JOB_ID]="-".$contracts[$j][$this->contracttypes->CFORM]."P-";
                        $data['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_pms']=$this->basemodel->num_of_res($this->pmsdetails->tbl_name,$pwhere,'','','',$plike);

                        $data["tot_no_".$contracts[$j][$this->contracttypes->CFORM]."pms"]=$data['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_pms']+$data["tot_no_".$contracts[$j][$this->contracttypes->CFORM]."pms"];
                        $no_tot_pms_total=$no_tot_pms_total+$data['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_pms'];

                        $rwhere[$this->cms->RESPONSE_TIME.' <=']=10;
                        $rwhere[$this->cms->RESPONSE_TIME.' !=']=NULL;
                        $data['response_lt_10']=$this->basemodel->num_of_res($this->cms->tbl_name,$rwhere,$where,'');
                        $rwhere1[$this->cms->RESPONSE_TIME.' <=']=60;
                        $rwhere1[$this->cms->RESPONSE_TIME.' >']=10;
                        $rwhere1[$this->cms->RESPONSE_TIME.' !=']=NULL;
                        $data['response_lt_60']=$this->basemodel->num_of_res($this->cms->tbl_name,$rwhere1,$where,'');
                        $rwhere2[$this->cms->RESPONSE_TIME.' >']=60;
                        $rwhere2[$this->cms->RESPONSE_TIME.' !=']=NULL;
                        $data['response_gt_60']=$this->basemodel->num_of_res($this->cms->tbl_name,$rwhere2,$where,'');

                        $data['toatl_response_time']=$data['response_gt_60']+$data['response_lt_60']+$data['response_lt_10'];
                        $data['response_time_lt_10pcs']=round(($data['response_lt_10']/$data['toatl_response_time'])*100,2);                                  $data['response_time_lt_60pcs']=round(($data['response_lt_60']/$data['toatl_response_time'])*100,2);
                        $twhere[$this->cms->TIME_TO_REPAIR.' <=']=1;
                        $twhere[$this->cms->TIME_TO_REPAIR.' !=']=NULL;
                        $data['ttr_lt_1d']=$this->basemodel->num_of_res($this->cms->tbl_name,$twhere,$where,'');
                        $twhere1[$this->cms->TIME_TO_REPAIR.' <=']=3;
                        $twhere1[$this->cms->TIME_TO_REPAIR.' >']=1;
                        $twhere1[$this->cms->TIME_TO_REPAIR.' !=']=NULL;
                        $data['ttr_lt_3d']=$this->basemodel->num_of_res($this->cms->tbl_name,$twhere1,$where,'');
                        $twhere2[$this->cms->TIME_TO_REPAIR.' >']=3;
                        $twhere2[$this->cms->TIME_TO_REPAIR.' !=']=NULL;
                        $data['ttr_gt_3d']=$this->basemodel->num_of_res($this->cms->tbl_name,$twhere2,$where,'');
                        $data['timetoreparir_total']=$data['ttr_lt_1d']+$data['ttr_lt_3d']+$data['ttr_gt_3d'];
                        $data['ttr_lt_1d_inpcs']=round(($data['ttr_lt_1d']/$data['timetoreparir_total'])*100,2);

                    }
                    $data['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $branch_id));
                    $data['dept_id'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DEPT_ID, array($this->devices->BRANCH_ID => $branch_id));
                    $data['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name,$this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $data['dept_id']));
            //print_r($data['branchname']);
            //print_r($data['dept_id']);
           // die();
                    $data['no_tot_bkdwn_total']=$no_tot_bkdwn_total;
                    $data['no_tot_pms_total']=$no_tot_pms_total;
                    $data['no_calls_total']=$no_tot_pms_total+$no_tot_bkdwn_total;
                    $data['tot_subtotal_pms']=$no_tot_pms_total+$data['tot_subtotal_pms'];
                    $data['tot_subtotal_bkdwms']=$no_tot_bkdwn_total+$data['tot_subtotal_bkdwms'];
                    $data['total_calls_total']=$data['tot_subtotal_pms']+$data['tot_subtotal_bkdwms'];
                    $data['total_lt_1d']=$data['total_lt_1d']+$data['ttr_lt_1d'];
                    $data['total_lt_3d']=$data['total_lt_3d']+$data['ttr_lt_3d'];
                    $data['total_gt_3d']=$data['total_gt_3d']+$data['ttr_gt_3d'];
                    $data['total_lt_1d_pcs']=$data['total_lt_1d_pcs']+$data['ttr_lt_1d_inpcs'];
                    $data['total_lt_10']=$data['total_lt_10']+$data['response_lt_10'];
                    $data['total_lt_60']=$data['total_lt_60']+$data['response_lt_60'];
                    $data['total_gt_60']=$data['total_gt_60']+$data['response_gt_60'];
                    $data['total_lt_10_pcs']=$data['total_lt_10_pcs']+$data['response_time_lt_10pcs'];
                    $data['total_lt_60_pcs']=$data['total_lt_60_pcs']+$data['response_time_lt_60pcs'];
                    /* adverse incidents */
                    $qclist = $this->basemodel->fetch_records_from($this->qceqcats->tbl_name);
                    for($p=0;$p<count($qclist);$p++)
                    {
                        $qc_cats= explode(",",$qclist[$p][$this->qceqcats->CODES]);
                        $this->db->select('count(hsp_tbl_qc_details.ID) as cnt,sum(hsp_tbl_qc_details.COST) as cost');
                        $this->db->from($this->db->dbprefix($this->qcdetails->tbl_name));
                        $this->db->join($this->db->dbprefix($this->devices->tbl_name), 'hsp_tbl_devices.E_ID = hsp_tbl_qc_details.EID');
                        $this->db->join($this->db->dbprefix($this->devicenames->tbl_name), 'hsp_tbl_devices.E_CAT = hsp_tbl_m_device_names.ID');
                        $this->db->where_in('hsp_tbl_m_device_names.CODE',$qc_cats);
                        $qc_devices_qry = $this->db->get();
                        $qc_devices = $qc_devices_qry->result_array();
                        $data['keys'][$p]=$qclist[$p][$this->qceqcats->NAME];
                        //$data['dn_dt'][$p]=$qc_devices[0]['dn_dt'];
                       // $data['due_dt'][$p]=$qc_devices[0]['due_dt'];
                        $data['count'][$p]=$qc_devices[0]['cnt'];
                        $data['cost'][$p]=$qc_devices[0]['cost']=='' ? 0 : $qc_devices[0]['cost'];
                        $data['total_count_eqps']=$data['total_count_eqps']+$data['count'][$p];
                        $data['total_cost_eqps']=$data['total_cost_eqps']+$data['cost'][$p];
                        $no_same_equpts=0;
                       // print_r($data['dn_dt'][$p]);
                        //print_r($data['due_dt'][$p]);
                       // die();
                    }
                    //Grn COUNT And COST
                    $dvc_like[$this->devices->GRN_DATE] = date('Y-m',strtotime($date));
                    $dvc__where[$this->devices->GRN_VALUE." !="] = NULL;
                    $dvc__where[$this->devices->ORG_ID] = $this->session->org_id;
                    $dvc__where[$this->devices->BRANCH_ID] = $branch_id;
                    $dvc__list=$this->basemodel->sum_of_column($this->devices->tbl_name,$this->devices->GRN_VALUE,$dvc__where,'',$dvc_like);
                    $data['cc']['grn_cost'] = $dvc__list;
                    $grn_cnt=$this->basemodel->num_of_res($this->devices->tbl_name,$dvc__where,'','','',$dvc_like);
                    $data['ct']['grn_count'] = $grn_cnt;
                /*}*/
                $data['response'] = SUCCESSDATA;
                //$data['time']=
                //$data['date']=date('M-Y',strtotime(mprsdate));
                $data['date']=date("F Y");
                $data['time']=date("h:i:s A");
                    //$data['asset_management'] = $list;
                     //print_r($data['list']);
                /*}*/
            /*else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }*/
        }
        return $data;
    }

    private function _get_service_reports_pdf($jodata=array())
    {
        $where="";
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->devices->BRANCH_ID] = $branch_id;
            $where[$this->devices->ORG_ID] = $org_id;
            $where[$this->devices->E_ID] = $jodata->equp_id;
            $list = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where);
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                $list['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$this->devices->DEPT_ID]));
                $list['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$this->devices->USERNAME]));
                $list['cdate'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->CDATE, array($this->cms->EID => $list[$this->devices->E_ID]));
                $list['ctime'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->CTIME, array($this->cms->EID => $list[$this->devices->E_ID]));
                $list['JOBCOMPLETED_DATE'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->JOBCOMPLETED_DATE, array($this->cms->EID => $list[$this->devices->E_ID]));
                $list['JOBCOMPLETED_TIME'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->JOBCOMPLETED_TIME, array($this->cms->EID => $list[$this->devices->E_ID]));
                $list['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$this->devices->BRANCH_ID]));
                $list[$this->deviceamcs->AMC_VENDOR]=$this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VENDOR,array($this->deviceamcs->EID => $list[$this->devices->E_ID]),$this->deviceamcs->AMC_TO ,'desc');
                $data['list'] = $list;
                //print_r($data['list']);
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;

    }
    /**
     * @param array $jodata
     * @return array
     */
    private function _get_indent_reports_pdf($jodata=array())
    {
        //print_r($jodata);
        $where="";
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->indents->BRANCH_ID] = $branch_id;
            $where[$this->indents->ORG_ID] = $org_id;
            $where[$this->indents->INDENT_ID] = $jodata->indent_id;
            $list = $this->basemodel->fetch_single_row($this->indents->tbl_name,$where);
            //print_r($list);
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                $list['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$this->indents->DEPT]));
                $list['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$this->indents->BRANCH_ID]));
                $list['Indented_By'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$this->indents->RAISED_BY]));
                $list['Approved_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$this->indents->APPROVED_BY]));
                $list['Sanctioned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$this->indents->SANCTIONED_BY]));
                //$list['date'] = date('Y-m-d',strtotime($list[$this->condemnation->ADDED_ON]));
                //$list['time'] = date('H:i:s',strtotime($list[$this->condemnation->ADDED_ON]));
                $timestamp =$list[$this->indents->RAISED_DATETIME] ;
                $splitTimeStamp = explode(" ",$timestamp);
                $list['date'] = $splitTimeStamp[0];
                $list['time'] = $splitTimeStamp[1];
                $data['list'] = $list;
                //print_r($data['list']);

            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }
    private function _get_cear_reports_pdf($jodata=array())
    {
        //print_r($jodata);
        $where="";
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->cear->BRANCH_ID] = $branch_id;
            $where[$this->cear->ORG_ID] = $org_id;
            $where[$this->cear->CEAR_ID] = $jodata->cear_id;
            $list = $this->basemodel->fetch_single_row($this->cear->tbl_name,$where);
            //print_r($list);
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                $list['dept_id'] = $this->basemodel->get_single_column_value($this->indents->tbl_name, $this->indents->DEPT, array($this->indents->INDENT_ID => $list[$this->cear->INDENT_ID]));
                $list['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list['dept_id']));
                $list['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$this->cear->BRANCH_ID]));
             $list['category'] = $this->basemodel->get_single_column_value($this->cearcategory->tbl_name, $this->cearcategory->NAME, array($this->cearcategory->CODE => $list[$this->cear->CATEGORY]));
                //$list['date'] = date('Y-m-d',strtotime($list[$this->condemnation->ADDED_ON]));
                //$list['time'] = date('H:i:s',strtotime($list[$this->condemnation->ADDED_ON]));
                $timestamp =$list[$this->cear->COMPETED_ON] ;
                $splitTimeStamp = explode(" ",$timestamp);
                $list['date'] = $splitTimeStamp[0];
                $list['time'] = $splitTimeStamp[1];
                $data['list'] = $list;
                //print_r($data['list']);

            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }

    private function _get_gate_pass_report($jodata = array())
    {
        $like = array();
        $data = array();
        $where_date = "";
        if (!empty($jodata)) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->gatepass->BRANCH_ID] = $branch_id;
            $where[$this->gatepass->ORG_ID] = $org_id;
            if ($jodata->eqpid !='')
            $where[$this->gatepass->E_ID] = $jodata->equp_id;
            $where[$this->gatepass->ORG_ID] = $org_id;
            $where[$this->gatepass->BRANCH_ID] =$branch_id;
            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $like[$this->gatepass->DEPT_ID] = $jodata->dept_id;
            if (isset($jodata->fromdate) && isset($jodata->todate) && $jodata->fromdate != "" && $jodata->todate != "")
            {
                $where_date = $this->gatepass->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            }
            $list = $this->basemodel->fetch_records_from_multi_where_like($this->gatepass->tbl_name, $where, $where_date,$like, '*', $this->gatepass->GP_ID, 'desc');
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
               for($i=0;$i<count($list);$i++)
                {
                    $list[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$i][$this->gatepass->BRANCH_ID]));
                    $list[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$i][$this->gatepass->DEPT_ID]));
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
                    $list[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $list[$i][$this->gatepass->E_ID]));
                    $list[$i]['serial_no'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $list[$i][$this->gatepass->E_ID]));
                    $timestamp =$list[$this->gatepass->ADDED_ON] ;
                    $splitTimeStamp = explode(" ",$timestamp);
                    $list['date'] = $splitTimeStamp[0];
                    $list['time'] = $splitTimeStamp[1];
                }
                $data['list'] = $list;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }
 private function _asset_management_other_assets($jodata = array())
 {
     $data = array();
     $where = array();
     $like = array();
     $where[$this->branches->ORG_ID] = $this->session->org_id;
     if($this->session->role_code==HMADMIN)
     {
         $list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
     }
     else if($this->session->role_code==HBBME || $this->session->role_code==HBHOD)
     {
         $branch_id = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->ORG_BRANCH_ID,array($this->users->USER_ID =>$this->session->user_id));
         $branchid=explode(",",$branch_id);
         $or_where="(";
         for($k=0;$k<count($branchid);$k++)
         {
             if($k!=0)
             {
                 $or_where .= " OR ";
             }
             $or_where .= $this->branches->BRANCH_ID . " = '".$branchid[$k]."'";
         }
         $or_where.=")";
         $list = $this->basemodel->fetch_records_from_multi_where($this->branches->tbl_name, $where,$or_where);
     }

     if (!empty($list))
     {
         if (!empty($list))
         {
             $date=date('Y-m-d');
             $date2 = date('Y-m-d',strtotime("+1 month",strtotime($date)));
             $tot_spr_acc_ser_cons=0;
             $data['tot_no_savings']=0;
             $data['tot_no_Events']=0;
             $data['tot_no_ppls']=0;
             $data['tot_no_nabh_cnt']=0;
             $data['tot_no_nabh_cost']=0;
             $data['tot_no_expenses_sprs']=0;
             $data['tot_no_expenses_servcs']=0;
             $data['tot_no_expenses_accers']=0;
             $data['tot_no_expenses_cnsbls']=0;
             $data['tot_no_expenses_tot']=0;
             $data['tot_no_grns_cnt']=0;
             $data['tot_no_grns_cost']=0;
             $data['tot_no_adverse_cnt']=0;
             $data['tot_no_adverse_cost']=0;
             $data['tot_no_contracts_cnt']=0;
             $data['tot_no_contracts_cost']=0;
             $data['tot_no_assets_cnt']=0;
             $data['tot_no_assets_cost']=0;
             $data['tot_no_percent_count']=0;
             $data['tot_no_percent_cost']=0;
             $data['tot_no_cond_count']=0;
             $data['tot_no_cond_cost']=0;
             $data['tot_no_repl_count']=0;
             $data['tot_no_repl_cost']=0;
             $data['tot_no_deplyment_count']=0;
             $data['tot_no_manpower_count']=0;
         for($i=0;$i<count($list);$i++)
         {
             $qcwhere[$this->qcdetails->ORG_ID]=$list[$i][$this->branches->ORG_ID];
             $qcwhere[$this->qcdetails->BRANCH_ID]=$list[$i][$this->branches->BRANCH_ID];
             $qcwhere[$this->qcdetails->COMPLETED_BY." !="]=NULL;
             $qclike[$this->qcdetails->QC_DUE]=date('Y-m',strtotime($date));
             $qclist=$this->basemodel->sum_of_column($this->qcdetails->tbl_name,$this->qcdetails->COST,$qcwhere,'',$qclike);
             //print_r($this->db->last_query());
             //Calibration Details
             $list[$i]['qcdone_cost']=$qclist;
             $qclist_cnt=$this->basemodel->num_of_res($this->qcdetails->tbl_name,$qcwhere,'','','',$qclike);
             $list[$i]['qcdone_cnt']=$qclist_cnt;
            //Spares Details
             $swhere[$this->criticalspares->STATUS]='A';
             $slist=$this->basemodel->sum_of_column($this->criticalspares->tbl_name,$this->criticalspares->COST,$swhere);
             $list[$i]['spares_cost']=$slist;
             $slist_cnt=$this->basemodel->num_of_res($this->criticalspares->tbl_name,$swhere);
             $list[$i]['spares_cnt']=$slist_cnt;
             //accessories Details
             $abwhere[$this->accessories->STATUS]='A';
             $alist=$this->basemodel->sum_of_column($this->accessories->tbl_name,$this->accessories->COST,$abwhere);
             $list[$i]['accessories_cost']=$alist;
             $alist_cnt=$this->basemodel->num_of_res($this->accessories->tbl_name,$abwhere);
             $list[$i]['accessories_cnt']=$alist_cnt;
             //services Details
             $srwhere[$this->cms->ORG_ID] = $list[$i][$this->branches->ORG_ID];
             $srwhere[$this->cms->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
             $srwhere[$this->cms->STATUS]='A';
             $srlist=$this->basemodel->sum_of_column($this->cms->tbl_name,$this->cms->COST,$srwhere);
             $list[$i]['services_cost']=$srlist;
             $savinglist[$i]=$this->basemodel->sum_of_column($this->cms->tbl_name,$this->cms->SAVINGS_COST,$srwhere);
             $list[$i]['saving_cost']=$savinglist[$i];
             $srlist_cnt=$this->basemodel->num_of_res($this->cms->tbl_name,$swhere);
             $list[$i]['services_cnt']=$srlist_cnt;
             $list[$i]['cons_cost']=0;
             $tot_spr_acc_ser_cons= $list[$i]['services_cost']+$list[$i]['accessories_cost']+$list[$i]  ['services_cost']+$list[$i]['cons_cost'];
             $list[$i]['tot_spr_acc_ser_cons']=$tot_spr_acc_ser_cons;
             /*contracts*/
             $tlc_where[$this->deviceamcs->ORG_ID] = $list[$i][$this->branches->ORG_ID];
             $tlc_where[$this->deviceamcs->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
             $tlc_where[$this->deviceamcs->STATUS] = OPEN;
             $tlc_where[$this->deviceamcs->AMC_FROM." <="]=$date;
             $tlc_where[$this->deviceamcs->AMC_TO." >"]=$date2;
             $tlc_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$tlc_where);
             $tlc_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$tlc_where);
             $list[$i]['tlc_count']=$tlc_count;
             $list[$i]['tlc_cost']=$tlc_sum;
             $list[$i]['conttacts_lachs']=$this->basemodel->to_lakhs($list[$i]['tlc_cost']);
             //Grn COUNT And COST
             $dvc_like[$this->devices->GRN_DATE] = date('Y-m',strtotime($date));
             $dvc__where[$this->devices->GRN_VALUE." !="] = NULL;
             $dvc__where[$this->devices->ORG_ID] =$list[$i][$this->branches->ORG_ID];
             $dvc__where[$this->devices->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
             $dvc__list=$this->basemodel->sum_of_column($this->devices->tbl_name,$this->devices->GRN_VALUE,$dvc__where,'',$dvc_like);
             $list[$i]['grn_cost'] = $dvc__list;
             $list[$i]['grn_in_lachs']=$data['asset_crores']+$this->basemodel->to_lakhs($list[$i]['grn_cost']);
             $grn_cnt=$this->basemodel->num_of_res($this->devices->tbl_name,$dvc__where,'','','',$dvc_like);
             $list[$i]['grn_count'] = $grn_cnt;
             $dvc__where[$this->devices->E_ID.'!='] ='';
             $deployment_cnt=$this->basemodel->num_of_res($this->devices->tbl_name,$dvc__where,'','','',$dvc_like);
             $list[$i]['deployment_count'] = $deployment_cnt;

             //Tranings COUNT And COST
             //$trng_like[$this->trainings->TR_DATE] = date('Y-m',strtotime($date));
             $trng_where[$this->trainings->TR_COMP.'!='] ='';
             $trng_where[$this->trainings->ORG_ID] =$list[$i][$this->branches->ORG_ID];
             $trng_where[$this->trainings->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
             $trng_list=$this->basemodel->sum_of_column($this->trainings->tbl_name,$this->trainings->T_COUNT,$trng_where,'','');
             $list[$i]['trngs_cost'] = $trng_list;
             $trng_cnt=$this->basemodel->num_of_res($this->trainings->tbl_name,$trng_where,'','','','');
             $list[$i]['trngs_count'] = $trng_cnt;
             //Adverse Incidents Details
             $aidlike[$this->incedents->DATE_OCCRANCE] =date('Y-m',strtotime($date));
             $aidwhere[$this->incedents->COMPLETED_BY." !="] =NULL;
             $aidwhere[$this->incedents->ACTION_TACKEN." !="] =NULL;
             $aidwhere[$this->incedents->ORG_ID] = $list[$i][$this->branches->ORG_ID];
             $aidwhere[$this->incedents->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
             $aid_list=$this->basemodel->sum_of_column($this->incedents->tbl_name,$this->incedents->TOTAL_COST,$aidwhere,'',$aidlike);
             $list[$i]['incidents_cost'] = $aid_list;
             $list[$i]['consuble_cost'] = 0;
             $aid_cnt=$this->basemodel->num_of_res($this->incedents->tbl_name,$aidwhere,'','','',$aidlike);
             $list[$i]['incidents_count'] = $aid_cnt;
             //Condemnation Count Cost
             $condem_like[$this->condemnation->ADDED_ON] = date('Y-m',strtotime($date));
             $condem_where[$this->condemnation->EXPECTED_COST." !="] = NULL;
             $condem_where[$this->condemnation->ORG_ID] = $list[$i][$this->branches->ORG_ID];
             $condem_where[$this->condemnation->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
             $condem_where[$this->condemnation->EXPECTED_COST." !="] = NULL;
             $condem_list=$this->basemodel->sum_of_column($this->condemnation->tbl_name,$this->condemnation->EXPECTED_COST,$condem_where,'',$condem_like);
             $list[$i]['condem_cost'] = $condem_list;
             $list[$i]['condem_cost_lacks'] = $this->basemodel->to_lakhs($list[$i]['condem_cost']);

             $condem_cnt=$this->basemodel->num_of_res($this->condemnation->tbl_name,$condem_where,'','','',$condem_like);
             $list[$i]['condem_count'] = $condem_cnt;
             //Man Power Details
             $mp_like[$this->users->ORG_BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
             $mp_where[$this->users->ORG_ID] = $list[$i][$this->branches->ORG_ID];
             $mp_cnt[$i]=$this->basemodel->num_of_res($this->users->tbl_name,$mp_where,'','','',$mp_like);
             $list[$i]['mp_count'] = $mp_cnt[$i];
             $list[$i]['percent_cnt']=($list[$i]['tlc_count']+$list[$i]['count'])/100;
             $list[$i]['percent_cost']=($list[$i]['tlc_cost']+$list[$i]['cost'])/100;
             $list[$i]['percent_in_crores']=$this->basemodel->to_cr($list[$i]['percent_cost']);
             //Assets Count And COST
             $dalist_tot = $dalist_tot_cnt = 0;
             $contracts=$this->basemodel->fetch_records_from($this->contracttypes->tbl_name);
             for($k=0;$k<=count($contracts);$k++)
             {
                 $dawhere[$this->deviceamcs->AMC_TYPE]=$contracts[$k][$this->contracttypes->CTYPE];
                 $dawhere[$this->deviceamcs->BRANCH_ID]=$list[$i][$this->branches->BRANCH_ID];
                 $dawhere[$this->deviceamcs->ORG_ID]=$list[$i][$this->branches->ORG_ID];
                 $dawhere[$this->deviceamcs->STATUS]=OPEN;
                 $dawhere[$this->deviceamcs->AMC_FROM." <="]=$date;
                 $dawhere[$this->deviceamcs->AMC_TO." >"]=$date2;
                 $dalist[$k]=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$dawhere);
                 $dalist_cnt[$k]=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$dawhere);
                 $assets_cost=0;
                 $assets_cnt=0;
                 $assets_cost=$assets_cost+$dalist[$k];
                 $assets_cnt=$assets_cnt+$dalist_cnt[$k];
                 $list[$i]['cost']=  $assets_cost;
                 $list[$i]['count']= $assets_cnt;
                 $list[$i]['asset_in_lacs']=$this->basemodel->to_lakhs($list[$i]['cost']);
                 //print_r($list[$i]['asset_in_lacs']);
             }

             $data['tot_no_savings']=$data['tot_no_savings']+$list[$i]['saving_cost'];
             $data['tot_no_Events']=$data['tot_no_Events']+$list[$i]['trngs_count'];
             $data['tot_no_ppls']=$data['tot_no_ppls']+$list[$i]['trngs_cost'];
             $data['tot_no_nabh_cnt']=$data['tot_no_nabh_cnt']+$list[$i]['qcdone_cnt'];
             $data['tot_no_nabh_cost']=$data['tot_no_nabh_cost']+$list[$i]['qcdone_cost'];
             $data['tot_no_expenses_sprs']=$data['tot_no_expenses_sprs']+$list[$i]['spares_cost'];
             $data['tot_no_expenses_servcs']=$data['tot_no_expenses_servcs']+$list[$i]['services_cost'];
             $data['tot_no_expenses_accers']=$data['tot_no_expenses_accers']+$list[$i]['accessories_cost'];
             $data['tot_no_expenses_cnsbls']=$data['tot_no_expenses_cnsbls']+$list[$i]['consuble_cost'];
             $data['tot_no_expenses_tot']=$data['tot_no_expenses_tot']+$list[$i]['tot_spr_acc_ser_cons'];
             $data['tot_no_grns_cnt']=$data['tot_no_grns_cnt']+$list[$i]['grn_count'];
             $data['tot_no_grns_cost']=$data['tot_no_grns_cost']+$list[$i]['grn_in_lachs'];
             $data['tot_no_adverse_cnt']=$data['tot_no_adverse_cnt']+$list[$i]['incidents_count'];
             $data['tot_no_adverse_cost']=$data['tot_no_adverse_cost']+$list[$i]['incidents_cost'];
             $data['tot_no_contracts_cnt']=$data['tot_no_contracts_cnt']+$list[$i]['tlc_count'];
            $data['tot_no_contracts_cost']=$data['tot_no_contracts_cost']+$list[$i]['tlc_cost_lacs'];
            $data['tot_no_assets_cnt']=$data['tot_no_assets_cnt']+$list[$i]['count'];
             $data['tot_no_assets_cost']=$data['tot_no_assets_cost']+$list[$i]['asset_in_lacs'];
             $data['tot_no_percent_count']=$data['tot_no_percent_count']+$list[$i]['pecent_count'];
             $data['tot_no_percent_cost']= $data['tot_no_percent_cost']+$list[$i]['pecent_cost'];
             $data['tot_no_cond_count']=  $data['tot_no_cond_count']+$list[$i]['condem_count'];
             $data['tot_no_cond_cost']=$data['tot_no_cond_cost']+$list[$i]['condem_cost_lacks'];
             $data['tot_no_repl_count']=$data['tot_no_repl_count']+$list[$i]['replce_count'];
             $data['tot_no_repl_cost']=$data['tot_no_repl_cost']+$list[$i]['replce_cost'];
             $data['tot_no_deplyment_count']=$data['tot_no_deplyment_count']+$list[$i]['deployment_count'];
             $data['tot_no_manpower_count']=$data['tot_no_manpower_count']+$list[$i]['mp_count'];
             $data['percnt_cnt_tot']=$data['percnt_cnt_tot']+$list[$i]['percent_cnt'];
             $data['percnt_cost_tot']=$data['percnt_cost_tot']+$list[$i]['percent_in_crores'];
            //$data['percent_crores'] =$data['percent_crores']+$this->basemodel->nubersincourse($list[$i]['percent_in_crores']);
           // $data['asset_crores'] =$data['asset_crores']+$this->basemodel->nubersincourse($list[$i]['asset_in_lacs']);
           //  $data['tot_no_contracts_cost'] =$data['asset_crores']+$this->basemodel->nubersincourse($data['conttacts_lachs']);
            // $data['tot_no_grn_lacks'] =$data['asset_crores']+$this->basemodel->nubersincourse($list[$i]['grn_in_lachs']);
         }
         $data['response'] = SUCCESSDATA;
         $data['asset_management'] = $list;
        }
         else
         {
             $data['response'] = EMPTYDATA;
         }
     }
     return $data;
 }

    private function _get_equp_hstry_reports_pdf($jodata=array())
    {
        $where="";
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->devices->BRANCH_ID] = $branch_id;
            $where[$this->devices->ORG_ID] = $org_id;
            $where[$this->devices->E_ID] = $jodata->equp_id;
            $list = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where);
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                $list['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_CODE => $list[$this->devices->BRANCH_ID]));
                $list['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$this->devices->DEPT_ID]));
                $list['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$this->devices->USERNAME]));
                $list['cdate'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->CDATE, array($this->cms->EID => $list[$this->devices->E_ID]));
                $list['ctime'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->CTIME, array($this->cms->EID => $list[$this->devices->E_ID]));
                $list['JOBCOMPLETED_DATE'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->JOBCOMPLETED_DATE, array($this->cms->EID => $list[$this->devices->E_ID]));
                $list['JOBCOMPLETED_TIME'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->JOBCOMPLETED_TIME, array($this->cms->EID => $list[$this->devices->E_ID]));
                $list['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$this->devices->BRANCH_ID]));
                $list[$this->deviceamcs->AMC_VENDOR]=$this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VENDOR,array($this->deviceamcs->EID => $list[$this->devices->E_ID]),$this->deviceamcs->AMC_TO ,'desc');
                $data['list'] = $list;
                //print_r($data['list']);
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;

    }
    /*Reports Display Functionality*/
    public function cms_report_pdf()
    {
        $tdata = $this->_get_cms_reports_pdf();
        $data['amoa'] = $this->_asset_management_other_assets();
        $data['tdata'] = $tdata;
        $this->load->view('reports/cms_report_pdf',$data);
    }
    public function gate_pass_pdf()
    {
        $post_data =json_decode($_POST['gate_post']);
        $data['gp'] = json_decode($post_data->gate_pass);
        //print_r($data['gp']);
        $this->load->view('reports/gatepass_report_pdf',$data);
    }

    public function view_adverse_report_pdf()
    {
        $data['advr'] = json_decode($_POST['pdf_data']);
        $this->load->view('reports/view_adverse_report_pdf1',$data);
    }
    public function eq_summ_print_pdf()
    {
        $data['esrp'] = $this->_get_equipment_summary_reports_pdf();
        $this->load->view('reports/equp_summary_pdf',$data);
    }
    public function condemnation_repost_pdf()
    {
        $post_data =json_decode($_POST['condem_data']);
        $cdata = json_decode($post_data->condem_data);
        $jodata = [];
        $jodata['equp_id'] = $cdata->EQUP_ID;
        $jodata = json_encode($jodata);
        $jodata = json_decode($jodata);
        $list = $this->_get_condemnation_reports($jodata);
        if($list['response']==SUCCESSDATA)
        {
            $data['cr'] = $list['list'];
        }
        else
        {
            $data['cr'] = array();
        }
        //print("<pre>".print_r($list,true)."</pre>");
        $this->load->view('reports/condemnation_repost_pdf',$data);
    }
    public function viability_report_pdf()
    {
        $post_data =json_decode($_POST['via_data']);
        $data['vr'] = json_decode($post_data->via_data);
        //print("<pre>".print_r($data['vr'],true)."</pre>");
        $this->load->view('reports/viability_report_pdf',$data);
    }
    public function viability_total_report_pdf()
    {
        $post_data = json_decode($_POST['viability_data'],true);
        $data['vrs'] = json_decode($post_data['condem_data'],true);
        $this->load->view('reports/viability_total_report_pdf',$data);
    }
    public function stock_all_report_pdf()
    {
        $data['stocks'] = json_decode($_POST['stocks_data'],true);
        $this->load->view('reports/stock_all_report_pdf',$data);
    }
    public function stock_total_report_pdf()
    {
        $where=$data=$swhere=array();
        $where[$this->branches->ORG_ID]=$this->session->org_id;
        $post_data = json_decode($_POST['stock_data'],true);
        if($post_data['branch_id']!="")
        {
            $where[$this->branches->BRANCH_ID] = $post_data['branch_id'];
        }
        $branches = $this->basemodel->fetch_records_from($this->branches->tbl_name,$where,array($this->branches->BRANCH_ID,$this->branches->BRANCH_NAME),$this->branches->BRANCH_NAME);
        for($i=0;$i<count($branches);$i++)
        {
            $swhere[$this->stock->BRANCH_ID] = $branches[$i][$this->branches->BRANCH_ID];
            $swhere[$this->stock->ORG_ID] = $where[$this->branches->ORG_ID];
            $swhere[$this->stock->INDENT_TYPE] = EQPMNT;
            $swhere[$this->stock->IN_STOCK] = YESSTATE;
            $branches[$i]["e_count"] = $this->basemodel->num_of_res($this->stock->tbl_name,$swhere);
            $branches[$i]["e_cost"] = $this->basemodel->sum_of_column($this->stock->tbl_name,$this->stock->E_COST,$swhere);
            $swhere[$this->stock->INDENT_TYPE] = ACCESS;
            $branches[$i]["acc_count"] = $this->basemodel->num_of_res($this->stock->tbl_name,$swhere);
            $branches[$i]["acc_cost"] = $this->basemodel->sum_of_column($this->stock->tbl_name,$this->stock->E_COST,$swhere);
            $swhere[$this->stock->INDENT_TYPE] = SPARES;
            $branches[$i]["spr_count"] = $this->basemodel->num_of_res($this->stock->tbl_name,$swhere);
            $branches[$i]["spr_cost"] = $this->basemodel->sum_of_column($this->stock->tbl_name,$this->stock->E_COST,$swhere);
        }
        $data["stocks"] = $branches;
        $this->load->view('reports/stock_total_report_pdf',$data);
    }
    public function pms_report_pdf()
    {
        $data['pms'] =json_decode($_POST['pms_data']);
        $this->load->view('reports/pms_report_pdf',$data);
    }
    public function stock_report_pdf()
    {
        $data['single_stock'] =json_decode($_POST['new_stock_data']);
        $this->load->view('reports/stock_report_pdf',$data);
    }
    public function qc_report_pdf()
    {
        $data['qc'] =json_decode($_POST['qc_data']);
        //print_r($data['qc']);
        $this->load->view('reports/qc_report_pdf',$data);
    }
    public function indent_report_pdf()
    {
        $data['indent'] =json_decode($_POST['indent_data']);
        //print_r($data['qc']);
        $this->load->view('reports/indent_report_pdf1',$data);
    }
    public function redeployement_report_pdf()
    {
        $data['redeployement_data'] =json_decode($_POST['redeployement_data']);
        //print_r($data['qc']);
        $this->load->view('reports/redeployement_report_pdf',$data);
    }
    public function deployement_report_pdf()
    {
        $data['deployement_data'] =json_decode($_POST['deployement_data']);
        //print_r($data['qc']);
        $this->load->view('reports/deployement_report_pdf',$data);
    }
    public function cear_report_pdf()
    {
        $data['cear'] =json_decode($_POST['cear_data']);
        $this->load->view('reports/cear_report_pdf',$data);
    }
  /*  public function MPR_report_pdf()
    {
        $data['mpr'] =json_decode($_POST['mpr_data']);
        $this->load->view('reports/MPR_report_pdf',$data);
    }*/
    public function MPR_report_pdf()
    {
        $data['mpr'] = json_decode($_POST['mpr']);
        $this->load->view('reports/MPR_report_pdf',$data);
    }
    public function service_report_pdf()
    {
        $data['ser'] =json_decode($_POST['ser_data']);
        //print_r($data['ser']);
        $this->load->view('reports/service_report_pdf',$data);
    }
    public function device_history_pdf()
    {
        $data['dh'] = json_decode($_POST['dh_data'],true);
        $this->load->view('reports/device_history_pdf',$data);
    }
    public function down_time_data_report_pdf()
    {
        $data['dts'] = json_decode($_POST['down_time_data'],true);
        $this->load->view('reports/down_time_data_report_pdf',$data);
    }
    public function call_log_report_pdf()
    {
        $data['clogs'] = json_decode($_POST['call_log_data'],true);
        $this->load->view('reports/call_log_report_pdf',$data);
    }
    public function nsc_report_pdf()
    {
        $data['nscr'] = json_decode($_POST['nsc_data']);
        $this->load->view('reports/nsc_report_pdf', $data);
    }
    public function sc_report_pdf()
    {

        $data['scr'] = json_decode($_POST['sc_data']);
        //print_r($data['scr']);
        $this->load->view('reports/sc_report_pdf',$data);
    }
    public function eq_summ_print_pdf_bat()
    {
        log_message('error',"bat success");
        return true;
    }

    public function mailing_fun()
    {
        /* Added Equipments */
        $organizations = $this->basemodel->fetch_records_from($this->organizations->tbl_name,array(),array($this->organizations->ORG_ID,$this->organizations->ORG_NAME,$this->organizations->LOGO),$this->branches->ORG_AID);
        for($m=0;$m<count($organizations);$m++)
        {
            $org_id = $organizations[$m][$this->organizations->ORG_ID];
            $logo = "http://".$_SERVER['SERVER_NAME']."/hospiasset/assets/org_logos/".$organizations[$m][$this->organizations->LOGO];
            $branches = $this->basemodel->fetch_records_from($this->branches->tbl_name,array($this->branches->ORG_ID=>$org_id),array($this->branches->BRANCH_ID,$this->branches->BRANCH_NAME),$this->branches->BRANCH_AID);
            $brchs=array();
            //print_r($branches);
            $coma_braches = "";
            for($i=0;$i<count($branches);$i++)
            {
                $ad_where[$this->devices->ORG_ID] = $org_id;
                $acms_where[$this->cms->ORG_ID] = $org_id;
                $apms_where[$this->pmsdetails->ORG_ID] = $org_id;
                $cpms_where[$this->pmsdetails->ORG_ID] = $org_id;
                $cqc_where[$this->qcdetails->ORG_ID] = $org_id;
                $cadv_where[$this->incedents->ORG_ID] = $org_id;
                $ards_where[$this->rounds_assigned->ORG_ID] = $org_id;
                $crds_where[$this->rounds->ORG_ID] = $org_id;
                $ctrf_where[$this->transfer->ORG_ID] = $org_id;
                $ccon_where[$this->condemnation->ORG_ID] = $org_id;
                $contract_where[$this->deviceamcs->ORG_ID]=$org_id;
                if($i!=0)
                {
                    $coma_braches .=",".$branches[$i][$this->branches->BRANCH_ID];
                }
                else
                {
                    $coma_braches .=$branches[$i][$this->branches->BRANCH_ID];
                }
                $ad_where[$this->devices->BRANCH_ID] = $branches[$i][$this->branches->BRANCH_ID];
                $acms_where[$this->cms->BRANCH_ID] = $branches[$i][$this->branches->BRANCH_ID];
                $acms_where[$this->cms->TO_ADVERSE] = NULL;
                $apms_where[$this->pmsdetails->BRANCH_ID] = $branches[$i][$this->branches->BRANCH_ID];
                $apms_where[$this->pmsdetails->PMS_DUE_DATE." <="] = date('Y-m-d');
                $apms_where_like[$this->pmsdetails->PMS_DUE_DATE] = date('Y-m');
                $cqc_where[$this->qcdetails->BRANCH_ID] = $branches[$i][$this->branches->BRANCH_ID];
                $cqc_where[$this->qcdetails->QC_DUE." <="] = date('Y-m-d');
                $cqc_where_like[$this->qcdetails->QC_DUE] = date('Y-m');
                $cadv_where[$this->incedents->BRANCH_ID] = $branches[$i][$this->branches->BRANCH_ID];
                $crds_where[$this->rounds->BRANCH_ID] = $branches[$i][$this->branches->BRANCH_ID];
                $ards_where[$this->rounds_assigned->BRANCH_ID] = $branches[$i][$this->branches->BRANCH_ID];
                $ards_where[$this->rounds_assigned->ROUND_DATE] = date('Y-m-d');
                $ctrf_where[$this->transfer->TRANSFER_BRANCH] = $branches[$i][$this->branches->BRANCH_ID];
                $ccon_where[$this->condemnation->BRANCH_ID] = $branches[$i][$this->branches->BRANCH_ID];
                $contract_where[$this->deviceamcs->BRANCH_ID]= $branches[$i][$this->branches->BRANCH_ID];

                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['name'] = $branches[$i][$this->branches->BRANCH_NAME];
                /*  cms */
                $acms_where[$this->cms->JOBCOMPLETED_DATE] = NULL;
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_cms'] = $this->basemodel->num_of_res($this->cms->tbl_name,$acms_where);
                unset($acms_where[$this->cms->JOBCOMPLETED_DATE]);
                $acms_where_like[$this->cms->JOBCOMPLETED_DATE] = date('Y-m');
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_cms'] = $this->basemodel->num_of_res($this->cms->tbl_name,$acms_where,'','','',$acms_where_like);
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_cms'] = $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_cms'] + $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_cms'];
                /* Pms Details*/
                //$brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_pms'] = $this->basemodel->num_of_res($this->pmsdetails->tbl_name,$apms_where);
                $apms_where[$this->pmsdetails->PMS_ACTL_DONE] = NULL;
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_pms'] = $this->basemodel->num_of_res($this->pmsdetails->tbl_name,$apms_where,'','','',$apms_where_like);
                unset($apms_where[$this->pmsdetails->PMS_ACTL_DONE]);
                unset($apms_where[$this->pmsdetails->PMS_DUE_DATE." <="]);
                $apms_where[$this->pmsdetails->PMS_ACTL_DONE.' != '] = NULL;
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_pms'] = $this->basemodel->num_of_res($this->pmsdetails->tbl_name,$apms_where,'','','',$apms_where_like);
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_pms'] = $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_pms'] + $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_pms'];

                /* qc Details*/
                //$brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_qc'] = $this->basemodel->num_of_res($this->qcdetails->tbl_name,$cqc_where);
                $cqc_where[$this->qcdetails->QC_ACTL_DONE] = NULL;
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_qc'] = $this->basemodel->num_of_res($this->qcdetails->tbl_name,$cqc_where,'','','',$cqc_where_like);
                unset($apms_where[$this->qcdetails->QC_ACTL_DONE]);
                $cqc_where[$this->qcdetails->QC_ACTL_DONE.' != '] = NULL;
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_qc'] = $this->basemodel->num_of_res($this->qcdetails->tbl_name,$cqc_where,'','','',$cqc_where_like);
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_qc'] = $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_qc'] + $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_qc'];
                /*Adverse Incedents*/
                //$brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_adv'] = $this->basemodel->num_of_res($this->incedents->tbl_name,$cadv_where);
                $cadv_where[$this->incedents->UPDATED_ON] = NULL;
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_adv'] = $this->basemodel->num_of_res($this->incedents->tbl_name,$cadv_where);
                unset($cadv_where[$this->incedents->UPDATED_ON]);
                $cadv_where_like[$this->incedents->UPDATED_ON] = date('Y-m');
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_adv'] = $this->basemodel->num_of_res($this->incedents->tbl_name,$cadv_where,'','','',$cadv_where_like);
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_adv'] = $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_adv'] + $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_adv'];

                /*Rounds*/
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_rds'] = $this->basemodel->num_of_res($this->rounds_assigned->tbl_name,$ards_where);
                $crds_where[$this->rounds->START_DATE] = date("Y-m-d");
                $crds_where[$this->rounds->END_TIME." !="] = NULL;
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_rds'] = $this->basemodel->num_of_res($this->rounds->tbl_name,$crds_where);
                unset($crds_where[$this->rounds->END_TIME." !="]);
                $crds_where[$this->rounds->END_TIME] = NULL;
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_rds'] = $this->basemodel->num_of_res($this->rounds->tbl_name,$crds_where);

                /*Transfer Details*/
                //$brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_trnsfers'] = $this->basemodel->num_of_res($this->transfer->tbl_name,$ctrf_where);
                $ctrf_where[$this->transfer->UPDATED_ON] = NULL;
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_trnsfers'] = $this->basemodel->num_of_res($this->transfer->tbl_name,$ctrf_where);
                unset($ctrf_where[$this->transfer->UPDATED_ON]);
                $ctrf_where_like[$this->transfer->UPDATED_ON] = date('Y-m');
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_trnsfers'] = $this->basemodel->num_of_res($this->transfer->tbl_name,$ctrf_where,'','','',$ctrf_where_like);
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_trnsfers'] = $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_trnsfers']+$brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_trnsfers'];
                /*Condemination  Details*/
                //$brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_cods'] = $this->basemodel->num_of_res($this->condemnation->tbl_name,$ccon_where);
                $ccon_where[$this->condemnation->UPDATED_ON] = NULL;
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_cods'] = $this->basemodel->num_of_res($this->rounds->tbl_name,$ccon_where);
                unset($ccon_where[$this->condemnation->UPDATED_ON]);
                $ccon_where_like[$this->condemnation->UPDATED_ON] = date('Y-m');
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_cods'] = $this->basemodel->num_of_res($this->condemnation->tbl_name,$ccon_where,'','','',$ccon_where_like);
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_cods'] =  $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_cods']+ $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_cods'];

                /*Contracts Details*/
                //$brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_contrcts']=$this->basemodel->count_no_distinct_records($this->deviceamcs->tbl_name,$this->deviceamcs->EID,$contract_where,'','',$this->deviceamcs->AMC_TO,'DESC');
                $contract_where[$this->deviceamcs->AMC_VALUE]="AMC";
                $contract_where[$this->deviceamcs->AMC_TO." <"]=date('Y-m-d');
                $contract_where[$this->deviceamcs->STATUS." !="]=OPEN;
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_contrcts'] = $this->basemodel->count_no_distinct_records($this->deviceamcs->tbl_name,$this->deviceamcs->EID,$contract_where,'','',$this->deviceamcs->AMC_TO,'DESC');
                unset($contract_where[$this->deviceamcs->AMC_TO." <"]);
                unset($contract_where[$this->deviceamcs->STATUS." !="]);
                $contract_where[$this->deviceamcs->STATUS]=OPEN;
                $contract_where_like[$this->deviceamcs->ADDED_ON] = date('Y-m');
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_contracts'] = $this->basemodel->num_of_res($this->deviceamcs->tbl_name,$contract_where,'','','',$contract_where_like);
                $brchs[$branches[$i][$this->branches->BRANCH_ID]]['total_contrcts'] = $brchs[$branches[$i][$this->branches->BRANCH_ID]]['completed_contracts']+$brchs[$branches[$i][$this->branches->BRANCH_ID]]['pending_contrcts'];

            }
            $users=$this->basemodel->fetch_records_from($this->users->tbl_name,array($this->users->ORG_ID=>$org_id,$this->users->EMAIL_ID." !="=>NULL),array($this->users->USER_NAME,$this->users->EMAIL_ID,$this->users->ROLE_CODE,$this->users->ORG_BRANCH_ID));
            foreach($users as $user)
            {
                if($user[$this->users->ORG_BRANCH_ID]==NULL && $user[$this->users->ROLE_CODE]==HMADMIN)
                {
                    $user_branches = explode(",",$coma_braches);
                }
                else if($user[$this->users->ORG_BRANCH_ID]!=NULL)
                {
                    $user_branches = explode(",",$user[$this->users->ORG_BRANCH_ID]);
                }
                $mail_body='';
                foreach($user_branches as $user_branch)
                {
                    if(array_key_exists($user_branch,$brchs))
                    {
                        $mail_body.='<tr>
									<td style="text-align: center;font-weight: bold;">
									<table width="100%" cellpadding="2" cellspacing="0" style="border-collapse:collapse;color:#0C2238;font-size:14px;font-family:Helvetica Neue,Helvetica,Arial,sans-serif"><tr><td>'.$brchs[$user_branch]['name'].'</td></tr></table></td>
								</tr>
								<tr>
									<td valign="top" align="center" style="padding:10px 10px;font-size:0;background-color:#fff">
										<table border="1" width="100%" cellpadding="2" cellspacing="0" style="border:1px solid #0073cf;border-collapse:collapse;color:#0C2238;font-size:14px;font-family:Helvetica Neue,Helvetica,Arial,sans-serif">
											<tr>
												<th width="40%">Tasks</th>
												<th width="20%">Total</th>
												<th width="20%">Pending</th>
												<th width="20%">Completed</th>
											</tr>
											<tr>
												<td style="padding-left:10px;">CMS</td>
												<td>'.$brchs[$user_branch]['total_cms'].'</td>
												<td>'.$brchs[$user_branch]['pending_cms'].'</td>
												<td>'.$brchs[$user_branch]['completed_cms'].'</td>

											</tr>
											<tr>
												<td style="padding-left:10px;">PMS</td>
												<td>'.$brchs[$user_branch]['total_pms'].'</td>
												<td>'.$brchs[$user_branch]['pending_pms'].'</td>
												<td>'.$brchs[$user_branch]['completed_pms'].'</td>
											</tr>
											<tr>
												<td style="padding-left:10px;">Calibration</td>
												<td>'.$brchs[$user_branch]['total_qc'].'</td>
												<td>'.$brchs[$user_branch]['pending_qc'].'</td>
												<td>'.$brchs[$user_branch]['completed_qc'].'</td>
											</tr>
											<tr>
												<td style="padding-left:10px;">Adverse</td>
												<td>'.$brchs[$user_branch]['total_adv'].'</td>
												<td>'.$brchs[$user_branch]['pending_adv'].'</td>
												<td>'.$brchs[$user_branch]['completed_adv'].'</td>
											</tr>
											<tr>
												<td style="padding-left:10px;">Rounds</td>
												<td>'.$brchs[$user_branch]['total_rds'].'</td>
												<td>'.$brchs[$user_branch]['pending_rds'].'</td>
												<td>'.$brchs[$user_branch]['completed_rds'].'</td>
											</tr>
											<tr>
												<td style="padding-left:10px;">Transfers</td>
												<td>'.$brchs[$user_branch]['total_trnsfers'].'</td>
												<td>'.$brchs[$user_branch]['pending_trnsfers'].'</td>
												<td>'.$brchs[$user_branch]['completed_trnsfers'].'</td>
											</tr>
											<tr>
												<td style="padding-left:10px;">Contracts</td>
												<td>'.$brchs[$user_branch]['total_contrcts'].'</td>
												<td>'.$brchs[$user_branch]['pending_contrcts'].'</td>
												<td>'.$brchs[$user_branch]['completed_contracts'].'</td>
											</tr>
											<tr>
												<td style="padding-left:10px;">Condemnation</td>
												<td>'.$brchs[$user_branch]['total_cods'].'</td>
												<td>'.$brchs[$user_branch]['pending_cods'].'</td>
												<td>'.$brchs[$user_branch]['completed_cods'].'</td>
											</tr>
										</table>
									</td>
								</tr>';
                    }
                }
                $body='<html>
					<body>
						<table width="700px" border="0" cellpadding="0" cellspacing="0" align="center" style="min-width:700px;border:1px solid #614da4">
						<tbody>
						<tr>
							<td bgcolor="#f5f7f9" valign="middle" style="padding:25px;box-sizing:border-box">

								<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
									<tbody>
									<tr>
										<td valign="middle" align="center" style="padding:0px 0px" bgcolor="#614da4">

										<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;font-family:Helvetica Neue,Helvetica,Arial,sans-serif">
											<tbody>
											<tr>
												<td align="center" style="margin-bottom:10px;padding:15px 5px 0;color:#d1d6da;text-align:center;font-size:11px;font-weight:bold">
													<p style="margin:0 0 10px 0;float:left">
														<img src="'.$logo.'" width="150px" height="100px" style="display:inline-block" class="CToWUd">
													</p>
													<p style="margin:0 0 10px 0;float:right">
														<img src="http://'.$_SERVER['SERVER_NAME'].'/hospiasset/assets/images/ha_logo.PNG" width="150px" height="100" style="display:inline-block" class="CToWUd">
													</p>

												</td>
											</tr>
												</tbody>
										 </table>
										</td>
									</tr>

									<tr>
										<td valign="top" align="center" style="border:0px solid #0073cf;padding:25px;box-sizing:border-box;font-size:0">
											<p style="clear:both"></p>
											<p style="margin:0;color:#404040;font-size:18px;font-family:Helvetica Neue,Helvetica,Arial,sans-serif">Hi, <a style="color:#0073cf;text-decoration:none;text-align:left;margin-bottom:10px;">'.$user[$this->users->USER_NAME].'</a></p>

											<table border="1" bgcolor="#fff" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #614da4">
												<tbody>'.$mail_body.'</tbody>
											</table>

										</td>
									</tr>

									<tr>
										<td valign="middle" align="center" style="padding:0px 25px" bgcolor="#614da4">

											<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;font-family:Helvetica Neue,Helvetica,Arial,sans-serif">
												<tbody>
												<tr>
													<td valign="middle" align="center" style="padding:15px 0px" bgcolor="#614da4">

														<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;font-family:Helvetica Neue,Helvetica,Arial,sans-serif">
															<tbody>
															<tr>
																<td align="center" style="padding:15px 0px 0px;color:#d1d6da;text-align:center;font-size:11px;font-weight:bold">&copy; copyright 2017, Renown Analytics Pvt Ltd. All rights reserved.</td>
												</tr>
												</tbody>
												</table>
												  </td>
												</tr>
												</tbody>
												</table>
										</td>
									</tr>

									</tbody>
								</table>
							</td>
						</tr>
				</tbody>
					</table>
					</body>
					</html>';
                //echo $body;
                $mail = new PHPMailer();
                // ---------- adjust these lines ---------------------------------------
                $mail->Username = "hospiasset.renown@gmail.com"; // your GMail user name
                $mail->Password = "analytics@123";
                $mail->SetFrom($mail->Username);
                //$mail->AddAddress($user[$this->users->EMAIL_ID]); // recipients email
				$mail->Addbcc('udaykumar.borra@carehospitals.com'); // recipients email
                $mail->FromName = "Renown Hospiasset"; // readable name
                $mail->Subject = "Today's Equipments Summary.";
                $mail->Body    = $body;
                //-----------------------------------------------------------------------

                $mail->Host = "smtp.gmail.com"; // GMail
                $mail->Port = 465;
                $mail->IsHTML(true);
                $mail->IsSMTP(); // use SMTP
                //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // turn on SMTP authentication
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mail->From = $mail->Username;
                if(!$mail->Send())
                    echo "Mailer Error: " . $mail->ErrorInfo;
                else
                    echo "Message has been sent to".$user[$this->users->EMAIL_ID]." at ".date('Y-m-d H:i:s').", ";
				
				
            }
        }
        /* $data['branches'] = $brchs;
        $data['users'] = $users;
        $data['coma_branches'] = $coma_braches;
        $this->load->view("emailing",$data); */
    }

    public function test_mail()
    {

        $body = "test mail";
        //echo $body;
        $mail = new PHPMailer();
        // ---------- adjust these lines ---------------------------------------
        $mail->Username = "hospiasset.renown@gmail.com"; // your GMail user name
        $mail->Password = "analytics@123";
        $mail->SetFrom($mail->Username);
        //$mail->AddAddress($user[$this->users->EMAIL_ID]); // recipients email
        $mail->AddAddress('udaykumar.borra@carehospitals.com'); // recipients email
        $mail->FromName = "Renown Hospiasset"; // readable name
        $mail->Subject = "Today's Equipments Summary.";
        $mail->Body    = $body;
        //-----------------------------------------------------------------------

        $mail->Host = "smtp.gmail.com"; // GMail
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->IsSMTP(); // use SMTP
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->From = $mail->Username;
        if(!$mail->Send())
            echo "Mailer Error: " . $mail->ErrorInfo;
        else
            echo "Message has been sent to udaykumar.borra@carehospitals.com at ".date('Y-m-d H:i:s').", ";
    }


    private function _get_nscr_reports($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $data = array();
            $where = array();
            $like = array();
            $today = strtotime(date('Y-m-d'));
            if ($jodata->eqpid !='')
                $where[$this->cms->EID] = $jodata->eqpid;
            /* if ($jodata->ename !='')
                 $like[$this->condemnation->E_NAME] = $jodata->ename;
             $where[$this->condemnation->EQUP_ID." !="] = NULL;
             if ($jodata->saccessoriesno !='')
                 $where[$this->condemnation->ES_NUMBER] = $jodata->saccessoriesno;*/
            $where[$this->cms->ORG_ID] = $this->session->org_id;
            $where[$this->cms->BRANCH_ID] = $this->session->branch_id;

            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $where[$this->cms->EID." LIKE"] = '___-___-____-__-'.$jodata->dept_id.'-___-%';
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_with_like($this->cms->tbl_name, $where,$like,'count('.$this->cms->ID.') AS CNT');
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
                $nsc_report = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->cms->tbl_name, $where, '',$like, '*',$this->cms->JOBCOMPLETED_DATE,'DESC','10',$limit_val*10);
            }
            else
                $nsc_report = $this->basemodel->fetch_records_with_like($this->cms->tbl_name, $where,$like,'*',$this->cms->JOBCOMPLETED_DATE,'DESC');

            $data['qry'] = $this->db->last_query();
            if (!empty($nsc_report))
            {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($nsc_report); $i++)
                {
                    $nsc_report[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $nsc_report[$i][$this->cms->EID]));
                    $nsc_report[$i]['Attended_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $nsc_report[$i][$this->cms->ATTENDED_BY]));
                        $nsc_report[$i]['Responded_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $nsc_report[$i][$this->cms->RESPONDED_BY]));
                    $nsc_report[$i]['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $nsc_report[$i][$this->cms->ASSIGNED_BY]));           $nsc_report[$i]['serial_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $nsc_report[$i][$this->cms->EID]));
                    $nsc_report[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $nsc_report[$i][$this->cms->CALLER_DEPT]));
                    $nsc_report[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $nsc_report[$i][$this->cms->BRANCH_ID]));
                    $nsc_report[$i]['date'] =strtotime('Y-m-d',$today);
                    $nsc_report[$i]['time'] =strtotime('Y-m-d',$today);
                }
                $data['nsc_report'] =$nsc_report;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }

            return $data;
        }
    }
    private function _get_scr_reports($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $where = array();
            $like = array();
            $today = strtotime(date('Y-m-d'));
            if ($jodata->eqpid !='')
                $where[$this->pmsdetails->EID] = $jodata->eqpid;
            /* if ($jodata->ename !='')
                 $like[$this->condemnation->E_NAME] = $jodata->ename;
             $where[$this->condemnation->EQUP_ID." !="] = NULL;
             if ($jodata->saccessoriesno !='')
                 $where[$this->condemnation->ES_NUMBER] = $jodata->saccessoriesno;*/
            $where[$this->pmsdetails->ORG_ID] = $this->session->org_id;
            $where[$this->pmsdetails->BRANCH_ID] = $this->session->branch_id;

            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $where[$this->pmsdetails->EID." LIKE"] = '___-___-____-__-'.$jodata->dept_id.'-___-%';
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_with_like($this->pmsdetails->tbl_name, $where,$like,'count('.$this->pmsdetails->ID.') AS CNT');
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
                $sc_report = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->pmsdetails->tbl_name, $where, '',$like, '*',$this->pmsdetails->PMS_DONE,'DESC','10',$limit_val*10);
            }
            else
                $sc_report = $this->basemodel->fetch_records_with_like($this->pmsdetails->tbl_name, $where,$like,'*',$this->pmsdetails->PMS_DONE,'DESC');

            $data['qry'] = $this->db->last_query();
            if (!empty($sc_report))
            {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($sc_report); $i++)
                {
                    $sc_report[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $sc_report[$i][$this->pmsdetails->EID]));
                    $sc_report[$i]['Completed_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $sc_report[$i][$this->pmsdetails->COMPLETED_BY]));
                    $sc_report[$i]['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $sc_report[$i][$this->pmsdetails->PMS_ASSIGNED_BY]));
                    $nsc_report[$i]['serial_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $sc_report[$i][$this->pmsdetails->EID]));
                    $sc_report[$i]['dept_id'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DEPT_ID, array($this->devices->E_ID => $sc_report[$i][$this->pmsdetails->EID]));
                    $sc_report[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $sc_report[$i]['dept_id']));
                    $sc_report[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $sc_report[$i][$this->pmsdetails->BRANCH_ID]));
                    $sc_report[$i]['date'] =strtotime('Y-m-d',$today);
                    $sc_report[$i]['time'] =strtotime('Y-m-d',$today);
                }
                $data['sc_report'] =$sc_report;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
 private function _get_qcscr_reports($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $where = array();
            $like = array();
            $today = strtotime(date('Y-m-d'));
            if ($jodata->eqpid !='')
                $where[$this->qcdetails->EID] = $jodata->eqpid;
            /* if ($jodata->ename !='')
                 $like[$this->condemnation->E_NAME] = $jodata->ename;
             $where[$this->condemnation->EQUP_ID." !="] = NULL;
             if ($jodata->saccessoriesno !='')
                 $where[$this->condemnation->ES_NUMBER] = $jodata->saccessoriesno;*/
            $where[$this->qcdetails->ORG_ID] = $this->session->org_id;
            $where[$this->qcdetails->BRANCH_ID] = $this->session->branch_id;

            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $where[$this->qcdetails->EID." LIKE"] = '___-___-____-__-'.$jodata->dept_id.'-___-%';
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_with_like($this->qcdetails->tbl_name, $where,$like,'count('.$this->qcdetails->ID.') AS CNT');
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
                $sc_report = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->qcdetails->tbl_name, $where, '',$like, '*',$this->qcdetails->QC_DONE,'DESC','10',$limit_val*10);
            }
            else
                $sc_report = $this->basemodel->fetch_records_with_like($this->qcdetails->tbl_name, $where,$like,'*',$this->qcdetails->QC_DONE,'DESC');

            $data['qry'] = $this->db->last_query();
            if (!empty($sc_report))
            {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($sc_report); $i++)
                {
                    $sc_report[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $sc_report[$i][$this->qcdetails->EID]));
                    $sc_report[$i]['Completed_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $sc_report[$i][$this->qcdetails->COMPLETED_BY]));
                    $sc_report[$i]['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $sc_report[$i][$this->qcdetails->ASSIGNED_BY]));
                    $nsc_report[$i]['serial_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $sc_report[$i][$this->qcdetails->EID]));
                    $sc_report[$i]['dept_id'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DEPT_ID, array($this->devices->E_ID => $sc_report[$i][$this->qcdetails->EID]));
                    $sc_report[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $sc_report[$i]['dept_id']));
                    $sc_report[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $sc_report[$i][$this->qcdetails->BRANCH_ID]));
                    $sc_report[$i]['date'] =strtotime('Y-m-d',$today);
                    $sc_report[$i]['time'] =strtotime('Y-m-d',$today);
                }
                $data['sc_report'] =$sc_report;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _get_nscr_reports_view($jodata=array())
    {
        //print_r($jodata);
        $where="";
        $data = array();
        $today = date('Y-m-d H:i:s');
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->cms->BRANCH_ID] = $branch_id;
            $where[$this->cms->ORG_ID] = $org_id;
            $where[$this->cms->EID] = $jodata->equp_id;
            $nsc_report = $this->basemodel->fetch_single_row($this->cms->tbl_name,$where);
            if (!empty($nsc_report))
            {
                    $nsc_report['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $nsc_report[$this->cms->EID]));
                    $nsc_report['Attended_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $nsc_report[$this->cms->ATTENDED_BY]));
                    $nsc_report['Responded_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $nsc_report[$this->cms->RESPONDED_BY]));
                    $nsc_report['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $nsc_report[$this->cms->ASSIGNED_BY]));           $nsc_report['serial_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $nsc_report[$this->cms->EID]));
                    $nsc_report['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $nsc_report[$this->cms->CALLER_DEPT]));
                    $nsc_report['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $nsc_report[$this->cms->BRANCH_ID]));
                    $nsc_report['date']=date('Y-m-d');
                    $nsc_report['time'] =date('H:i:s');
                $data['response'] = SUCCESSDATA;
                $data['list'] = $nsc_report;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }
    private function _get_qcscr_reports_view($jodata=array())
    {
        //print_r($jodata);
        $where="";
        $data = array();
        $today = date('Y-m-d H:i:s');
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->qcdetails->BRANCH_ID] = $branch_id;
            $where[$this->qcdetails->ORG_ID] = $org_id;
            $where[$this->qcdetails->EID] = $jodata->equp_id;
            $qcsc_report = $this->basemodel->fetch_single_row($this->qcdetails->tbl_name,$where);
            if (!empty($qcsc_report))
            {
                $qcsc_report['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $qcsc_report[$this->qcdetails->EID]));
                $qcsc_report['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $qcsc_report[$this->qcdetails->ASSIGNED_BY]));
                $qcsc_report['Completed_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $qcsc_report[$this->qcdetails->COMPLETED_BY]));
                $qcsc_report['serial_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $qcsc_report[$this->qcdetails->EID]));
                $qcsc_report['dept_id'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DEPT_ID, array($this->devices->E_ID => $qcsc_report[$this->pmsdetails->EID]));
                $qcsc_report['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $qcsc_report['dept_id']));
                $qcsc_report['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $qcsc_report[$this->qcdetails->BRANCH_ID]));
                $qcsc_report['date']=date('Y-m-d');
                $qcsc_report['time'] =date('H:i:s');
                $data['response'] = SUCCESSDATA;
                $data['list'] = $qcsc_report;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }

    private function _get_scr_reports_view($jodata=array())
    {
        //print_r($jodata);
        $where="";
        $data = array();
        $today = date('Y-m-d H:i:s');
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->pmsdetails->BRANCH_ID] = $branch_id;
            $where[$this->pmsdetails->ORG_ID] = $org_id;
            $where[$this->pmsdetails->EID] = $jodata->equp_id;
            $sc_report = $this->basemodel->fetch_single_row($this->pmsdetails->tbl_name,$where);
            if (!empty($sc_report))
            {
                    $sc_report['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $sc_report[$this->pmsdetails->EID]));
                    $sc_report['completed_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $sc_report[$this->pmsdetails->COMPLETED_BY]));
                    $sc_report['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $sc_report[$this->pmsdetails->PMS_ASSIGNED_BY]));
                $sc_report['serial_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $sc_report[$this->pmsdetails->EID]));
                $sc_report['dept_id'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DEPT_ID, array($this->devices->E_ID => $sc_report[$this->pmsdetails->EID]));
                $sc_report['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $sc_report['dept_id']));
                    $sc_report['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $sc_report[$this->pmsdetails->BRANCH_ID]));
                    $sc_report['date']=date('Y-m-d');
                    $sc_report['time'] =date('H:i:s');
                $data['response'] = SUCCESSDATA;
                $data['list'] = $sc_report;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }

    private function _get_cear_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->cear->tbl_name, array(), '', 'count(' . $this->cear->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['cnt'] = 0;
                }
                $cear = $this->basemodel->fetch_records_from_pagination($this->cear->tbl_name, '', '*', $this->cear->CATEGORY, 'ASC', '10', $limit_val * 10);

            }
            else {
                $cear = $this->basemodel->fetch_records_from($this->cear->tbl_name);
            }
        log_message('error',"CEA:".$this->db->last_query());
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
                $data['list'] = null;
            }
        }
        return $data;
    }
    private function _get_indent_equpiment_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val))
            {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->indents->tbl_name, array(), '', 'count(' . $this->indents->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['cnt'] = 0;
                }
                $indents = $this->basemodel->fetch_records_from_pagination($this->indents->tbl_name, '', '*', $this->indents->INDENT_ID, 'DESC', '10', $limit_val * 10);

            }
            else
            {
                $indents = $this->basemodel->fetch_records_from($this->indents->tbl_name);
            }
            if (!empty($indents))
            {
                for($i=0;$i<count($indents);$i++)
                {
                    $indents[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $indents[$i][$this->indents->BRANCH_ID]));
                    $indents[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $indents[$i][$this->indents->DEPT]));
                }

                $data['response'] = SUCCESSDATA;

                $data['list'] =$indents;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }
    public function nsc_total_report_pdf()
    {
        $data['tnscs'] = json_decode($_POST['nsc_total_data'],true);
        $this->load->view('reports/nsc_total_report_pdf',$data);
    }
    public function pms_total_report_pdf()
    {
        $data['pms_reports'] = json_decode($_POST['pms_total_data'],true);
        $this->load->view('reports/pms_total_report_pdf',$data);
    }
    public function qc_total_report_pdf()
    {
        $data['tqcs'] = json_decode($_POST['qc_total_data'],true);
        $this->load->view('reports/qc_total_report_pdf',$data);
    }
    public function gatepass_total_report_pdf()
    {
        $data['gate_pass_news'] = json_decode($_POST['gatepass_total_data'],true);
        $this->load->view('reports/gatepass_total_report_pdf',$data);
    }
    public function cear_total_report_pdf()
    {
        $data['cear_lists'] = json_decode($_POST['cear_total_data'],true);
        $this->load->view('reports/cear_total_report_pdf',$data);
    }
    public function indent_total_report_pdf()
    {
        $data['indent_equps'] = json_decode($_POST['indent_total_data'],true);
        $this->load->view('reports/indent_total_report_pdf',$data);
    }
    public function adverse_total_report_pdf()
    {
        $data['adv'] = json_decode($_POST['adv_total_data'],true);
        $this->load->view('reports/adverse_total_report_pdf',$data);
    }
    public function condemination_total_report_pdf()
    {
        $data['condemination_reports'] = json_decode($_POST['cond_total_data'],true);
        $this->load->view('reports/condemination_total_report_pdf',$data);
    }
    public function deployment_total_report_pdf()
    {
        $data['deployemnt_reports'] = json_decode($_POST['deployement_total_data'],true);
       // return $data;       
	   $this->load->view('reports/deployment_total_report_pdf',$data);
    }
    public function Redeployment_total_report_pdf()
    {
        $data['redeployemnt_reports'] = json_decode($_POST['redeployement_total_data'],true);
        $this->load->view('reports/Redeployment_total_report_pdf',$data);
    }
    public function services_total_report_pdf()
    {
        $data['services'] = json_decode($_POST['service_total_data'],true);
        $this->load->view('reports/services_total_report_pdf',$data);
    }
   /* public function download_devices()
    {
        $data=array();
        $where='';
		//$branch =  isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $branch=$this->session->branch_id;
        $orgid=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id; 
        $where[$this->devices->ORG_ID]=$orgid;
		if($branch !='All')
        $where[$this->devices->BRANCH_ID]=$branch;
	    else
			$or_where = $this->devices->BRANCH_ID. "IN".BRANCHALL;
        //$where[$this->devices->E_ID.' !='] = NULL;
        $list=$this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$where,$or_where);
       // echo $this->db->last_query();
		//$data['devices']=$list;
        $this->load->view('downlaod_devices',$data);
    }*/
    private function _get_gate_pass_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->gatepass->tbl_name, array(), '', 'count(' . $this->gatepass->ID . ') AS CNT');
                if (!empty($cnt))
                {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                }
                else {
                    $data['no_of_recs'] = 0;
                    $data['cnt'] = 0;
                }
                $list = $this->basemodel->fetch_records_from_pagination($this->gatepass->tbl_name, '', '*', $this->gatepass->ID, 'DESC', '10', $limit_val * 10);
            }
            else {
                $list = $this->basemodel->fetch_records_from($this->gatepass->tbl_name,'','*',$this->gatepass->ID,'DESC');
            }
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
                    $timestamp =$list[$i][$this->gatepass->ADDED_ON] ;
                    $splitTimeStamp = explode(" ",$timestamp);
                    $list[$i]['date'] = $splitTimeStamp[0];
                    $list[$i]['time'] = $splitTimeStamp[1];
                }
                $data['list'] = $list;
                // print_r($data);
            }
            else {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }
}