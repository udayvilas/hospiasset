<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Graphs extends CI_Controller
{
    public $shref = NULL;
    public $ha_content_type = NULL;
    public $true_href = NULL;
    public $ha_authorization = NULL;
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        //header('Content-Type: application/json');
        $this->load->library('pdf');
        $this->load->library('baselibrary');
        $this->load->model('basemodel');
        $this->load->model('devices');
        $this->load->model('qceqcats');
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
        $this->load->model('gatepass');
        $this->load->model('viability');
        include APPPATH . 'libraries/simplexlsx_class.php';
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
                    for($i = 0; $i < count($branchs); $i++)
                        $branch[$i] = "'".$branchs[$i]['BRANCH_ID']."'";
                    $branch = '(' . implode($branch, ',') . ')';
                }
            }

            defined('BRANCHALL') OR define('BRANCHALL', $branch);

            $action = $jodata->action;
            if ($action == 'cms_barchart')
                $data = $this->_cms_barchart($jodata);
            else if ($action == 'gatepass_barchart')
                $data = $this->_gatepass_barchart($jodata);
            else if ($action == 'vaibilty_barchart')
                $data = $this->_vaibilty_barchart($jodata);
            else if ($action == 'adverse_barchart')
                $data = $this->_adverse_barchart($jodata);
            else if ($action == 'services_barchart')
                $data = $this->_services_barchart($jodata);
            else if ($action == 'calllog_barchart')
                $data = $this->_calllog_barchart($jodata);
            else if ($action == 'deployement_barchart')
                $data = $this->_deployement_barchart($jodata);
            else if ($action == 'redeployement_barchart')
                $data = $this->_redeployement_barchart($jodata);
            else if ($action == 'pms_barchart')
                $data = $this->_pms_barchart($jodata);
            else if ($action == 'qc_barchart')
                $data = $this->_qc_barchart($jodata);
            else if ($action == 'indent_barchart')
                $data = $this->_indent_barchart($jodata);
            else if ($action == 'cear_barchart')
                $data = $this->_cear_barchart($jodata);
            else if ($action == 'condemnation_barchart')
                $data = $this->_condemnation_barchart($jodata);
            else if ($action == 'equipmentsumary_barchart')
                $data = $this->_equipmentsumary_barchart($jodata);
            else if ($action == 'monthly_performance_barchart')
                $data = $this->_monthly_performance_barchart($jodata);
            else if ($action == 'adverse_report_graph')
                $data = $this->_adverse_report_graph($jodata);
            else if ($action == 'pms_report_graph')
                $data = $this->_pms_report_graph($jodata);
            else if ($action == 'condemnation_report_graph')
                $data = $this->_condemnation_report_graph($jodata);
            else if ($action == 'viabilty_report_graph')
                $data = $this->_viabilty_report_graph($jodata);
            else if ($action == 'deployement_report_graph')
                $data = $this->_deployement_report_graph($jodata);
            else if ($action == 'service_report_graph')
                $data = $this->_service_report_graph($jodata);
            else if ($action == 'calllog_report_graph')
                $data = $this->_calllog_report_graph($jodata);
            else if ($action == 'transfer_barchart')
                $data = $this->_transfer_barchart($jodata);
            else if ($action == 'nonsheduled_graph')
                $data = $this->_nonsheduled_graph($jodata);
            else if ($action == 'response_time_graph')
                $data = $this->_response_time_graph($jodata);
            else if ($action == 'time_to_repair_graph')
                $data = $this->_time_to_repair_graph($jodata);
            else if ($action == 'sheduled_graph')
                $data = $this->_sheduled_graph($jodata);
            else if ($action == 'cause_codes_graph')
                $data = $this->_cause_codes_graph($jodata);
            else if ($action == 'rt_ttr_graph')
                $data = $this->_rt_ttr_graph($jodata);
            else if ($action == 'assets_graph')
                $data = $this->_assets_graph($jodata);
            else if ($action == 'activities_graph')
                $data = $this->_activities_graph($jodata);
            else if ($action == 'expenses_graph')
                $data = $this->_expenses_graph($jodata);
            else if ($action == 'contracts_graph')
                $data = $this->_contracts_graph($jodata);
            else if ($action == 'engineering_productivity_graph')
                $data = $this->_engineering_productivity_graph($jodata);
            else if ($action == 'nabhreadiness_graph')
                $data = $this->_nabhreadiness_graph($jodata);
            else if ($action == 'equp_dwntm_report_graph')
                $data = $this->_equp_dwntm_report_graph($jodata);
            else if ($action == 'redeployement_report_graph')
                $data = $this->_redeployement_report_graph($jodata);
            else if ($action == 'qc_report_graph')
                $data = $this->_qc_report_graph($jodata);
            else if ($action == 'viability_report_graph_bar')
                $data = $this->_viability_report_graph_bar($jodata);
            else if ($action == 'redeployement_report_graph')
                $data = $this->_redeployement_report_graph($jodata);
            else if ($action == 'equipment_history_barchart')
                $data = $this->_equipment_history_barchart($jodata);
            echo json_encode($data);
        }
    }
    private function _cms_barchart($jodata = array())
    {
        $data=array();
        // $cms_where="";
        $or_where = "";
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME) {
            $where = "(" . $this->cms->RESPONDED_BY . " = '" . $this->session->user_id . "' OR " . $this->cms->ATTENDED_BY . "='" . $this->session->user_id . "')";
        }
        for($i=1;$i<=$last_day;$i++)
        {
            $data['day'][$i]=$i;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;

            if($branch_id !='All')
            {
                $where[$this->cms->BRANCH_ID] = $branch_id;
            }
            else
            {
                $or_where = $this->cms->BRANCH_ID ." IN ".BRANCHALL;
            }

            $where[$this->cms->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $date1=date('Y-m-'.$i,strtotime($date));
            $where[$this->cms->CDATE] = date('Y-m-d',strtotime($date1));
            $count=$this->basemodel->num_of_res($this->cms->tbl_name,$where,$or_where);
            $data['count'][$i]=$count;
        }
        // return $this->db->last_query();
        return $data;
    }
    private function _gatepass_barchart($jodata = array())
    {

        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->gatepass->ADDED_BY]=isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        }
        for($i=1;$i<=$last_day;$i++)
        {
            $data['day'][$i]=$i;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $or_where = '';
            if($branch_id != 'All')
            {
                $where[$this->gatepass->BRANCH_ID] = $branch_id;
            }
            else{

                $or_where = $this->gatepass->BRANCH_ID. " IN " .BRANCHALL;

            }

            $where[$this->gatepass->ORG_ID]= isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $date1 = date('Y-m-'.$i,strtotime($date));
            $where[$this->gatepass->ADDED_ON." LIKE"]="%".date('Y-m-d',strtotime($date1))."%";
            $count=$this->basemodel->num_of_res($this->gatepass->tbl_name,$where,$or_where);
            $data['qry'][$i]=$this->db->last_query();
            $data['count'][$i]=$count;
        }

        return $data;
    }
    private function _vaibilty_barchart($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->devices->USERNAME]=isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        }
        for($i=1;$i<=$last_day;$i++)
        {
            $data['day'][$i]=$i;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $or_where = '';
            if($branch_id != 'All')
            {
                $where[$this->devices->BRANCH_ID]=$branch_id;
            }
            else
            {
                $or_where = $this->devices->BRANCH_ID. " IN " .BRANCHALL;
            }

            $where[$this->devices->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $date1 = date('Y-m-'.$i,strtotime($date));
            $where[$this->devices->ADDED_ON." LIKE"]="%".date('Y-m-d',strtotime($date1))."%";
            $count=$this->basemodel->num_of_res($this->devices->tbl_name,$where,$or_where);
            $data['qry'][$i]=$this->db->last_query();
            $data['count'][$i]=$count;
        }
        //return $this->db->last_query();
        return $data;
    }
    private function _adverse_barchart($jodata = array())
    {
        /* $data=array();
         $date=date('Y-m-d');
         $last_day= date("t", strtotime($date));
         if($this->session->role_code==HBBME)
         {
             $where[$this->incedents->ADDED_BY]= isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
         }
         for($i=1;$i<=$last_day;$i++)
         {
             $data['day'][$i]=$i;
             $data['day'][$i]=$i;
             $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
             $or_where = '';
             if($branch_id != 'All')
             {
                 $where[$this->incedents->BRANCH_ID] = $branch_id;
             }
             else{
 
                 $or_where = $this->incedents->BRANCH_ID. " IN " .BRANCHALL;
 
             }
 
             $where[$this->incedents->ORG_ID]= isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
             $date1 = date('Y-m-'.$i,strtotime($date));
             $where[$this->incedents->ADDED_ON." LIKE"]="%".date('Y-m-d',strtotime($date1))."%";
             $count=$this->basemodel->num_of_res($this->incedents->tbl_name,$where,$or_where);
             $data['qry'][$i]=$this->db->last_query();
             $data['count'][$i]=$count;
         }
       //return $this->db->last_query();
         return $data;*/

        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->incedents->ADDED_BY]=$this->session->user_id;
        }
        /*for($i=0;$i<$last_day;$i++)
        {*/
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        // $where[$this->incedents->BRANCH_ID]= $branch_id;
        if($branch_id !='All')
        {
            $where[$this->incedents->BRANCH_ID]=$branch_id;
        }
        else
        {
            $c_where = $this->incedents->BRANCH_ID. " IN ". BRANCHALL;
        }
        $where[$this->incedents->ORG_ID]=$this->session->org_id;
        $dwhere[$this->devices->ORG_ID]=$this->session->org_id;
        // $dwhere[$this->devices->BRANCH_ID]=$branch_id;
        if($branch_id !='All')
        {
            $dwhere[$this->incedents->BRANCH_ID]=$branch_id;
        }
        else
        {
            $oc_where = $this->incedents->BRANCH_ID. " IN ". BRANCHALL;
        }
        $dwhere[$this->devices->DEPT_ID.' !=']=NULL;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$dwhere,$oc_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        for($i=0;$i<count($list);$i++)
        {
            $where[$this->incedents->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->incedents->tbl_name,$where,$c_where);
        }
        /*}*/
        return $data;
    }
    private function _services_barchart($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->devices->USERNAME]=  isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        }
        for($i=1;$i<=$last_day;$i++)
        {
            $data['day'][$i]=$i;
            $or_where ='';
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;

            if($branch_id !='All')
            {
                $where[$this->devices->BRANCH_ID]=$branch_id;
            }
            else
            {
                $or_where = $this->devices->BRANCH_ID . " IN " .BRANCHALL;

            }

            $where[$this->devices->ORG_ID]= isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $date1 = date('Y-m-'.$i,strtotime($date));
            $where[$this->devices->ADDED_ON." LIKE"]="%".date('Y-m-d',strtotime($date1))."%";
            $count=$this->basemodel->num_of_res($this->devices->tbl_name,$where,$or_where);
            $data['qry'][$i]=$this->db->last_query();
            $data['count'][$i]=$count;
        }
        // return $this->db->last_query();
        return $data;
    }
    private function _calllog_barchart($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $cms_where="";
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME) {
            $cms_where = "(" . $this->cms->RESPONDED_BY . " = '" . $this->session->user_id . "' OR " . $this->cms->ATTENDED_BY . "='" . $this->session->user_id . "')";
        }
        for($i=1;$i<=$last_day;$i++)
        {
            $data['day'][$i]=$i;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            if($branch_id != 'All')
            {
                $where[$this->cms->BRANCH_ID]=$branch_id;
            }
            else
            {
                $cms_where = $this->cms->BRANCH_ID." IN ". BRANCHALL;
            }

            // $where[$this->cms->BRANCH_ID]=$branch_id;
            $where[$this->cms->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $date1=date('Y-m-'.$i,strtotime($date));
            $where[$this->cms->CDATE] = date('Y-m-d',strtotime($date1));
            $count=$this->basemodel->num_of_res($this->cms->tbl_name,$where,$cms_where);
            $data['count'][$i]=$count;
        }
        // return $this->db->last_query();
        return $data;
    }
    private function _deployement_barchart($jodata = array())
    {
        /* $data=array();
         $date=date('Y-m-d');
         $last_day= date("t", strtotime($date));
         if($this->session->role_code==HBBME)
         {
             $where[$this->devices->USERNAME]=isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
         }
         for($i=1;$i<=$last_day;$i++)
         {
             $data['day'][$i]=$i;
             $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
             $or_where = '';
             if($branch_id !='All')
             {
                 $where[$this->devices->BRANCH_ID]=$branch_id;
             }
             else
             {
                 $or_where = $this->devices->BRANCH_ID. " IN " .BRANCHALL;
             }
 
             $where[$this->devices->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
             $date1 = date('Y-m-'.$i,strtotime($date));
             $where[$this->devices->ADDED_ON." LIKE"]="%".date('Y-m-d',strtotime($date1))."%";
             $count=$this->basemodel->num_of_res($this->devices->tbl_name,$where,$or_where);
             //$data['qry'][$i]=$this->db->last_query();
             $data['count'][$i]=$count;
         }
        //return $this->db->last_query();
         return $data;*/

        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        /*    if($this->session->role_code==HBBME)
            {
                $where[$this->devices->USERNAME]=$this->session->user_id;
            }*/
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        //   $where[$this->devices->BRANCH_ID]= $branch_id;
        if($branch_id != 'All')
        {
            $where[$this->devices->BRANCH_ID]=$branch_id;
        }
        else
        {
            $orr_where = $this->devices->BRANCH_ID."IN".BRANCHALL;
        }
        $where[$this->devices->ORG_ID]=$this->session->org_id;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$where,$orr_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        //print_r($this->db->last_query());
        for($i=0;$i<count($list);$i++)
        {
            $where[$this->devices->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->devices->tbl_name,$where,$or_where);
        }
        /*    print_r($data);
            die();*/
        return $data;
    }
    private function _redeployement_barchart($jodata = array())
    {
        /* $data=array();
         $date=date('Y-m-d');
         $last_day= date("t", strtotime($date));
         if($this->session->role_code==HBBME)
         {
             $where[$this->transfer->ADDED_BY]=$this->session->user_id;
         }
         for($i=1;$i<=$last_day;$i++)
         {
             $data['day'][$i]=$i;
             $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
             $where[$this->transfer->BRANCH_ID]=$branch_id;
             $where[$this->transfer->ORG_ID]=$this->session->org_id;
             $date1=date('Y-m-'.$i,strtotime($date));
             $where[$this->transfer->ADDED_ON." LIKE"]="%".date('Y-m-d',strtotime($date1))."%";
             $count=$this->basemodel->num_of_res($this->transfer->tbl_name,$where);
             //$data['qry'][$i]=$this->db->last_query();
             $data['count'][$i]=$count;
         }
         return $data;*/
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        /* if($this->session->role_code==HBBME)
         {
             $where[$this->transfer->USERNAME]=$this->session->user_id;
         }*/
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        //  $where[$this->transfer->TRANSFER_BRANCH]=$this->session->branch_id;
        if($branch_id != 'All')
            $where[$this->transfer->TRANSFER_BRANCH] = $branch_id;
        else
            $or_where = $this->transfer->TRANSFER_BRANCH. "IN" . BRANCHALL;

        $where[$this->transfer->ORG_ID]=$this->session->org_id;
        $where[$this->transfer->DEPLOYMENT_ID.' != ']=NULL;
        $dwhere[$this->devices->BRANCH_ID]=$branch_id;
        if($branch_id != 'All')
            $dwhere[$this->devices->BRANCH_ID] = $branch_id;
        else
            $orr_where = $this->devices->BRANCH_ID. "IN" . BRANCHALL;

        $dwhere[$this->devices->ORG_ID]=$this->session->org_id;
        $dwhere[$this->devices->DEPT_ID.' !=']=NULL;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$dwhere,$orr_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        //print_r($this->db->last->query());
        for($i=0;$i<count($list);$i++)
        {
            $where[$this->transfer->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->transfer->tbl_name,$where,$or_where);
        }
        // print_r($data);
        //die();
        return $data;
    }
    private function _transfer_barchart($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->transfer->ADDED_BY]=$this->session->user_id;
        }
        for($i=1;$i<=$last_day;$i++)
        {
            $data['day'][$i]=$i;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id  : $this->session->branch_id;
            $or_where = '';
            if($branch_id !='All')
            {
                $where[$this->transfer->BRANCH_ID]=$branch_id;
            }
            else
            {
                $or_where = $this->transfer->BRANCH_ID. " IN " .BRANCHALL;
            }

            $where[$this->transfer->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $date1=date('Y-m-'.$i,strtotime($date));
            $where[$this->transfer->ADDED_ON." LIKE"]="%".date('Y-m-d',strtotime($date1))."%";
            $count=$this->basemodel->num_of_res($this->transfer->tbl_name,$where,$or_where);
            //$data['qry'][$i]=$this->db->last_query();
            $data['count'][$i]=$count;
        }

        return $data;
    }
    private function _pms_barchart($jodata = array())
    {
        /*$data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->pmsdetails->PMS_DONE]=$this->session->user_id;
        }
        for($i=1;$i<=$last_day;$i++)
        {
            $data['day'][$i]=$i;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $or_where = '';
            if($branch_id != 'All')
            {
                $where[$this->pmsdetails->BRANCH_ID] = $branch_id;
            }
            else
            {
                $or_where = $this->pmsdetails->BRANCH_ID. " IN " .BRANCHALL;
            }
            $where[$this->pmsdetails->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $date1=date('Y-m-'.$i,strtotime($date));
            $where[$this->pmsdetails->PMS_DONE]=date('Y-m-d',strtotime($date1));
            $count=$this->basemodel->num_of_res($this->pmsdetails->tbl_name,$where,$or_where);
            //$data['qry'][$i]=$this->db->last_query();
            $data['count'][$i]=$count;
        }
         
        return $data;
		 */

        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        //$where[$this->pmsdetails->BRANCH_ID]=$branch_id;
        if($branch_id !='All')
            $where[$this->devices->BRANCH_ID]=$branch_id;
        else
            $oc_where = $this->devices->BRANCH_ID. " IN ". BRANCHALL;

        $where[$this->pmsdetails->ORG_ID]=$this->session->org_id;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$where,$oc_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        if($this->session->role_code==HBBME)
        {
            $where[$this->pmsdetails->COMPLETED_BY]=$this->session->user_id;
        }
        for($i=0;$i<count($list);$i++) {
            // $list[$i]['dept_id'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DEPT_ID, array($this->devices->BRANCH_ID => $list[$i][$this->pmsdetails->BRANCH_ID]));
            //$where[$list[$i]['dept_id']]=$list[$i][$this->userdeprts->CODE];
            /*Join Two Tables*/
            $this->db->select('count(hsp_tbl_pms_details.EID) as cnt,(hsp_tbl_devices.DEPT_ID) as dept');
            $this->db->from($this->db->dbprefix($this->pmsdetails->tbl_name));
            $this->db->join($this->db->dbprefix($this->devices->tbl_name), 'hsp_tbl_devices.E_ID = hsp_tbl_pms_details.EID');
            $this->db->where('hsp_tbl_devices.BRANCH_ID', $branch_id);
            $this->db->where('hsp_tbl_devices.ORG_ID', $this->session->org_id);
            $this->db->where('hsp_tbl_devices.DEPT_ID', $list[$i][$this->devices->DEPT_ID]);
            $pms_devices_qry = $this->db->get();
            $pms_depts = $pms_devices_qry->result_array();
            //$data['qry']=$this->db->last_query();
            $data['cnt'][$i]=$pms_depts[0]['cnt'];
            $data['dept'][$i]=$pms_depts[0]['dept'];
        }
        //print_r($data);
        return $data;
    }
    private function _qc_barchart($jodata = array())
    {
        /* $data=array();
         $date=date('Y-m-d');
         $last_day= date("t", strtotime($date));
         if($this->session->role_code==HBBME)
         {
             $where[$this->qcdetails->QC_DONE]=$this->session->user_id;
         }
         for($i=1;$i<=$last_day;$i++)
         {
             $data['day'][$i]=$i;
             $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
             $or_where = '';
             if($branch_id !='All')
             {
                 $where[$this->qcdetails->BRANCH_ID]=$branch_id;
             }
             else
             {
               $or_where = $this->qcdetails->BRANCH_ID. " IN " .BRANCHALL;
             }
 
             $where[$this->qcdetails->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
             $date1=date('Y-m-'.$i,strtotime($date));
             $where[$this->qcdetails->QC_DONE]=date('Y-m-d',strtotime($date1));
             $count=$this->basemodel->num_of_res($this->qcdetails->tbl_name,$where,$or_where);
             $data['qry'][$i]=$this->db->last_query();
             $data['count'][$i]=$count;
         }
         return $this->db->last_query();
         return $data;*/
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $where[$this->qcdetails->BRANCH_ID]= $branch_id;
        if($branch_id !='All')
            $where[$this->qcdetails->BRANCH_ID]=$branch_id;
        else
            $oc_where = $this->qcdetails->BRANCH_ID. " IN ". BRANCHALL;
        $where[$this->qcdetails->ORG_ID]=$this->session->org_id;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$where,$oc_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        if($this->session->role_code==HBBME)
        {
            $where[$this->qcdetails->COMPLETED_BY]=$this->session->user_id;
        }
        for($i=0;$i<count($list);$i++) {
            $this->db->select('count(hsp_tbl_qc_details.EID) as cnt,(hsp_tbl_devices.DEPT_ID) as dept');
            $this->db->from($this->db->dbprefix($this->qcdetails->tbl_name));
            $this->db->join($this->db->dbprefix($this->devices->tbl_name), 'hsp_tbl_devices.E_ID = hsp_tbl_qc_details.EID');
            $this->db->where('hsp_tbl_devices.BRANCH_ID',$branch_id);
            $this->db->where('hsp_tbl_devices.ORG_ID', $this->session->org_id);
            $this->db->where('hsp_tbl_devices.DEPT_ID', $list[$i][$this->devices->DEPT_ID]);
            $qc_devices_qry = $this->db->get();
            $qc_depts = $qc_devices_qry->result_array();
            //$data['qry']=$this->db->last_query();
            $data['cnt'][$i]=$qc_depts[0]['cnt'];
            $data['dept'][$i]=$qc_depts[0]['dept'];
        }
        //print_r($data);
        return $data;
    }
    private function _indent_barchart($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->indents->ADDED_BY]=$this->session->user_id;
        }
        for($i=1;$i<=$last_day;$i++)
        {
            $data['day'][$i]=$i;
            $or_where = '';
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            if($branch_id !='All')
            {
                $where[$this->indents->BRANCH_ID] = $branch_id;
            }
            else
            {
                $or_where = $this->indents->BRANCH_ID."IN".BRANCHALL;
            }
            $where[$this->indents->ORG_ID]=$this->session->org_id;
            $date1=date('Y-m-'.$i,strtotime($date));
            $where[$this->indents->ADDED_ON." LIKE"]="%".date('Y-m-d',strtotime($date1))."%";
            $count=$this->basemodel->num_of_res($this->indents->tbl_name,$where,$or_where);
            //$data['qry'][$i]=$this->db->last_query();
            $data['count'][$i]=$count;
        }
        return $data;
    }
    private function _cear_barchart($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->cear->ADDED_BY]=$this->session->user_id;
        }
        for($i=1;$i<=$last_day;$i++)
        {
            $data['day'][$i]=$i;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $or_where = '';
            if($branch_id != 'All')
            {
                $where[$this->cear->BRANCH_ID]=$branch_id;
            }
            else
            {
                $or_where = $this->cear->BRANCH_ID. " IN " .BRANCHALL;
            }

            $where[$this->cear->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $date1=date('Y-m-'.$i,strtotime($date));
            $where[$this->cear->ADDED_ON." LIKE"]="%".date('Y-m-d',strtotime($date1))."%";
            $count=$this->basemodel->num_of_res($this->cear->tbl_name,$where,$or_where);
            //$data['qry'][$i]=$this->db->last_query();
            $data['count'][$i]=$count;
        }
        // return $this->db->last_query();
        return $data;
    }
    private function _condemnation_barchart($jodata = array())
    {
        /*$data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->condemnation->ADDED_BY]=$this->session->user_id;
        }
        for($i=1;$i<=$last_day;$i++)
        {
            $data['day'][$i]=$i;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $or_where = '';
            if($branch_id !='All')
            {
                $where[$this->condemnation->BRANCH_ID]=$branch_id;
            }
            else
            {
                $or_where = $this->condemnation->BRANCH_ID. " IN " .BRANCHALL;
            }
            $where[$this->condemnation->ORG_ID]=$this->session->org_id;
            $date1=date('Y-m-'.$i,strtotime($date));
            $where[$this->condemnation->ADDED_ON." LIKE"]="%".date('Y-m-d',strtotime($date1))."%";
            $count=$this->basemodel->num_of_res($this->condemnation->tbl_name,$where,$or_where);
            //$data['qry'][$i]=$this->db->last_query();
            $data['count'][$i]=$count;
        }
       // return $this->db->last_query();
        return $data;*/

        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        if($this->session->role_code==HBBME)
        {
            $where[$this->condemnation->ADDED_BY]=$this->session->user_id;
        }
        for($i=0;$i<$last_day;$i++)
        {

        if($branch_id !='All')
            $where[$this->condemnation->BRANCH_ID]=$branch_id;
        else
            $or_where = $this->condemnation->BRANCH_ID. " IN " .BRANCHALL;
        $where[$this->condemnation->ORG_ID]=$this->session->org_id;
        $dwhere[$this->devices->ORG_ID]=$this->session->org_id;
        //$dwhere[$this->devices->BRANCH_ID]=$branch_id;
        if($branch_id !='All')
            $dwhere[$this->devices->BRANCH_ID]=$branch_id;
        else
            $orr_where = $this->devices->BRANCH_ID. " IN " .BRANCHALL;
        $dwhere[$this->devices->DEPT_ID.' !=']=NULL;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$dwhere,$orr_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        for($i=0;$i<count($list);$i++)
        {
            $where[$this->condemnation->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->condemnation->tbl_name,$where,$or_where);
        }
        }
        return $data;
    }
    private function _equipmentsumary_barchart($jodata = array())
    {
		//return "fg";
          
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        /*if($this->session->role_code==HBBME)
        {
            $where[$this->devices->USERNAME]=isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        }*/
		
        for($i=0;$i<$last_day;$i++)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
			$where[$this->devices->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                  
		  // $where[$this->devices->BRANCH_ID]=$branch_id;
             if($branch_id != 'All'){
                 $where[$this->devices->BRANCH_ID]=$branch_id;
			 }else{
				  $or_where = $this->devices->BRANCH_ID. " IN ".BRANCHALL;
			 }
				 
               
           
            $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$where,$or_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
                 
		   for($i=0;$i<count($list);$i++)
            {
				
                $where[$this->devices->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
                $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->devices->tbl_name,$where,$or_where);
			 
            }
			return $data;
        }
        
    }
    private function _equipment_history_barchart($jodata = array())
    {
        /* $data=array();
         $date=date('Y-m-d');
         $last_day= date("t", strtotime($date));
         $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
         $where[$this->equphistory->BRANCH_ID]=$branch_id;
         $where[$this->equphistory->ORG_ID]=$this->session->org_id;
         $dwhere[$this->devices->BRANCH_ID]=$this->session->branch_id;
         $dwhere[$this->devices->ORG_ID]=$this->session->org_id;
         $dwhere[$this->devices->DEPT_ID.' != ']=NULL;
         $list=$this->basemodel->fetch_distinct_records($this->devices->tbl_name,$where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
         for($i=0;$i<count($list);$i++)
         {
             $where[$this->equphistory->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
             $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->equphistory->tbl_name,$where);
         }
         return $data;*/
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
       // $where[$this->equphistory->BRANCH_ID]=$branch_id;
        if($branch_id !='All')
        {
            $where[$this->equphistory->BRANCH_ID]=$branch_id;
        }else
        {
            $or_where = $this->equphistory->BRANCH_ID. " IN " .BRANCHALL;
        }
        
        $where[$this->equphistory->ORG_ID]=$this->session->org_id;
     
        if($branch_id !='All')
        {
            $dwhere[$this->devices->BRANCH_ID] = $branch_id;
        }else
        {
            $dor_where = $this->devices->BRANCH_ID. " IN " .BRANCHALL;
        }
        $dwhere[$this->devices->ORG_ID]=$this->session->org_id;
        $dwhere[$this->devices->DEPT_ID.' != ']=NULL;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$dwhere,$dor_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
              
	   for($i=0;$i<count($list);$i++)
        {
            $where[$this->equphistory->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->equphistory->tbl_name,$where,$or_where);
        }
        return $data;
    }
    private function _monthly_performance_barchart($jodata = array())
    {
        $data=array();
        $cms_where="";
        $date=date('Y-m');
        if($this->session->role_code==HBBME)
        {
            $cms_where = "(" . $this->cms->RESPONDED_BY . " = '".$this->session->user_id."' OR " . $this->cms->ATTENDED_BY . "='" . $this->session->user_id ."')";
            $rwhere[$this->rounds->USERNAME]=isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $pwhere[$this->pmsdetails->COMPLETED_BY]=isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $qwhere[$this->qcdetails->COMPLETED_BY]=isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $cwhere[$this->condemnation->ADDED_BY]=isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $twhere[$this->transfer->ADDED_BY]=isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $iwhere[$this->incedents->ADDED_BY]=isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        }
        /*DAMCS Monthly Performance Graph*/
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $d_where = '';
        if($branch_id !='All')
        {
            $dwhere[$this->deviceamcs->BRANCH_ID] = $branch_id;
        }
        else
        {
            $d_where = $this->deviceamcs->BRANCH_ID. " IN " .BRANCHALL;
        }

        $dwhere[$this->deviceamcs->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $dwhere[$this->deviceamcs->ADDED_ON." LIKE"]="%".$date."%";
        $dcount=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$dwhere,$d_where);
        $data['CONTRACTS']=$dcount;
        /*CMS Monthly Performance Graph*/
        if($branch_id !='All')
        {
            $cmswhere[$this->cms->BRANCH_ID]=$branch_id;
        }
        else
        {
            $cms_where = $this->cms->BRANCH_ID. " IN " .BRANCHALL;
        }

        $cmswhere[$this->cms->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $cmswhere[$this->cms->CDATE]=$date;
        $cmscount=$this->basemodel->num_of_res($this->cms->tbl_name,$cmswhere,$cms_where);
        $data['CMS']=$cmscount;
        /*Rounds Performance Graph*/
        $r_where = '';
        if($branch_id !='All')
        {
            $rwhere[$this->rounds->BRANCH_ID]=$branch_id;
        }
        else
        {
            $r_where = $this->rounds->BRANCH_ID. " IN " .BRANCHALL;
        }

        $rwhere[$this->rounds->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $rwhere[$this->rounds->ADDED_ON." LIKE"]="%".$date."%";
        $rcount=$this->basemodel->num_of_res($this->rounds->tbl_name,$rwhere,$r_where);
        $data['ROUNDS']=$rcount;
        //print_r($data);
        /*Incedents Monthly Performance Graph*/
        $i_where = '';
        if($branch_id !='All')
        {
            $iwhere[$this->incedents->BRANCH_ID]=$branch_id;
        }
        else
        {
            $i_where = $this->incedents->BRANCH_ID. " IN " .BRANCHALL;
        }
        $iwhere[$this->incedents->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $iwhere[$this->incedents->ADDED_ON." LIKE"]="%".$date."%";
        $icount=$this->basemodel->num_of_res($this->incedents->tbl_name,$iwhere,$i_where);
        $data['INCEDENTS']=$icount;
        /*Pms Monthly Performance Graph*/
        $p_where = '';
        if($branch_id !='All')
        {
            $pwhere[$this->pmsdetails->BRANCH_ID]=$branch_id;
        }
        else
        {
            $p_where = $this->pmsdetails->BRANCH_ID. " IN ".BRANCHALL;
        }

        $pwhere[$this->pmsdetails->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $pwhere[$this->pmsdetails->PMS_DONE]=$date;
        $pcount=$this->basemodel->num_of_res($this->pmsdetails->tbl_name,$pwhere,$p_where);
        $data['PMS']=$pcount;
        /*QC Monthly Performance Graph*/
        $q_where = '';
        if($branch_id != 'All')
        {
            $qwhere[$this->qcdetails->BRANCH_ID] = $branch_id;
        }
        else
        {
            $q_where = $this->qcdetails->BRANCH_ID. " IN " .BRANCHALL;
        }

        $qwhere[$this->qcdetails->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $qwhere[$this->qcdetails->QC_DONE]=$date;
        $qcount=$this->basemodel->num_of_res($this->qcdetails->tbl_name,$qwhere,$q_where);
        $data['CAL']=$qcount;
        /*Transfer Monthly Performance Graph*/
        $t_where = '';
        if($branch_id != 'All')
        {
            $twhere[$this->transfer->BRANCH_ID]=$branch_id;
        }
        else
        {
            $t_where = $this->transfer->BRANCH_ID. " IN " .BRANCHALL;
        }
        $twhere[$this->transfer->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $twhere[$this->transfer->ADDED_ON." LIKE"]="%".$date."%";
        $tcount=$this->basemodel->num_of_res($this->transfer->tbl_name,$twhere,$t_where);
        $data['TRNFR']=$tcount;
        /*Condemnation Monthly Performance Graph*/
        $c_where = '';
        if($branch_id !='All')
        {
            $cwhere[$this->condemnation->BRANCH_ID]=$branch_id;
        }
        else
        {
            $c_where = $this->condemnation->BRANCH_ID. " IN ". BRANCHALL;
        }

        $cwhere[$this->condemnation->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $cwhere[$this->condemnation->ADDED_ON." LIKE"]="%".$date."%";
        $ccount=$this->basemodel->num_of_res($this->condemnation->tbl_name,$cwhere,$c_where);
        $data['CONDEM']=$ccount;
        return $data;
    }
    private function _adverse_report_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->incedents->ADDED_BY]=$this->session->user_id;
        }
        for($i=0;$i<$last_day;$i++)
        {
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        if($branch_id !='All')
        {
            $where[$this->incedents->BRANCH_ID]= $branch_id;
        }else
        {
            $or_where = $this->incedents->BRANCH_ID. " IN " . BRANCHALL;
        }
        if($branch_id !='All')
        {
            $dwhere[$this->devices->BRANCH_ID]= $branch_id;
        }else
        {
            $dor_where = $this->devices->BRANCH_ID. " IN " . BRANCHALL;
        }
        $where[$this->incedents->ORG_ID]=$this->session->org_id;
        $dwhere[$this->devices->ORG_ID]=$this->session->org_id;
       // $dwhere[$this->devices->BRANCH_ID]=$branch_id;
        $dwhere[$this->devices->DEPT_ID.' !=']=NULL;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$dwhere,$dor_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
       
        for($i=0;$i<count($list);$i++)
        {
            $where[$this->incedents->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->incedents->tbl_name,$where,$or_where);
        }
        return $data;
        }
        
    }
    private function _pms_report_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        if($branch_id !='All')
        {
        $where[$this->pmsdetails->BRANCH_ID]=$branch_id;
        }
        else
        {
            $or_where = $this->pmsdetails->BRANCH_ID. " IN " .BRANCHALL;
        }
        $where[$this->pmsdetails->ORG_ID]=$this->session->org_id;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$where,$or_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        if($this->session->role_code==HBBME)
        {
            $where[$this->pmsdetails->COMPLETED_BY]=$this->session->user_id;
        }
        for($i=0;$i<count($list);$i++) {
            // $list[$i]['dept_id'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DEPT_ID, array($this->devices->BRANCH_ID => $list[$i][$this->pmsdetails->BRANCH_ID]));
            //$where[$list[$i]['dept_id']]=$list[$i][$this->userdeprts->CODE];
            /*Join Two Tables*/
            $this->db->select('count(hsp_tbl_pms_details.EID) as cnt,(hsp_tbl_devices.DEPT_ID) as dept');
            $this->db->from($this->db->dbprefix($this->pmsdetails->tbl_name));
            $this->db->join($this->db->dbprefix($this->devices->tbl_name), 'hsp_tbl_devices.E_ID = hsp_tbl_pms_details.EID');
            $this->db->where('hsp_tbl_devices.BRANCH_ID', $branch_id);
            $this->db->where('hsp_tbl_devices.ORG_ID', $this->session->org_id);
            $this->db->where('hsp_tbl_devices.DEPT_ID', $list[$i][$this->devices->DEPT_ID]);
            $pms_devices_qry = $this->db->get();
            $pms_depts = $pms_devices_qry->result_array();
            //$data['qry']=$this->db->last_query();
            $data['cnt'][$i]=$pms_depts[0]['cnt'];
            $data['dept'][$i]=$pms_depts[0]['dept'];
        }
        //print_r($data);
        return $data;
    }
    private function _viability_report_graph_bar($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->viability->ADDED_BY]=$this->session->user_id;
        }
        for($i=0;$i<$last_day;$i++)
        {
            $where[$this->viability->BRANCH_ID]=$this->session->branch_id;
            $where[$this->viability->ORG_ID]=$this->session->org_id;
            $list=$this->basemodel->fetch_records_from($this->userdeprts->tbl_name);
            for($i=0;$i<count($list);$i++)
            {
                $where[$this->viability->DEPT_ID]=$list[$i][$this->userdeprts->CODE];
                $data[$list[$i][$this->userdeprts->CODE]]=$this->basemodel->num_of_res($this->viability->tbl_name,$where);
            }
        }
        return $data;
    }
    private function _qc_report_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        if($branch_id !='All')
        {
            $where[$this->qcdetails->BRANCH_ID]= $branch_id;
        }
        else
        {
            $or_where = $this->qcdetails->BRANCH_ID. " IN " .BRANCHALL;
            
        }
        
        $where[$this->qcdetails->ORG_ID]=$this->session->org_id;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$where,$or_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        if($this->session->role_code==HBBME)
        {
            $where[$this->qcdetails->COMPLETED_BY]=$this->session->user_id;
        }
        for($i=0;$i<count($list);$i++) {
            $this->db->select('count(hsp_tbl_qc_details.EID) as cnt,(hsp_tbl_devices.DEPT_ID) as dept');
            $this->db->from($this->db->dbprefix($this->qcdetails->tbl_name));
            $this->db->join($this->db->dbprefix($this->devices->tbl_name), 'hsp_tbl_devices.E_ID = hsp_tbl_qc_details.EID');
            $this->db->where('hsp_tbl_devices.BRANCH_ID',$branch_id);
            $this->db->where('hsp_tbl_devices.ORG_ID', $this->session->org_id);
            $this->db->where('hsp_tbl_devices.DEPT_ID', $list[$i][$this->devices->DEPT_ID]);
            $qc_devices_qry = $this->db->get();
            $qc_depts = $qc_devices_qry->result_array();
            //$data['qry']=$this->db->last_query();
            $data['cnt'][$i]=$qc_depts[0]['cnt'];
            $data['dept'][$i]=$qc_depts[0]['dept'];
        }
        //print_r($data);
        return $data;
    }
    private function _condemnation_report_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->condemnation->ADDED_BY]=$this->session->user_id;
        }
        for($i=0;$i<$last_day;$i++)
        {
        
        if($branch_id !='All')
        {
            $where[$this->condemnation->BRANCH_ID]= $branch_id;
        }
        else
        {
            $or_where = $this->condemnation->BRANCH_ID. " IN " .BRANCHALL;
            
        }
        if($branch_id !='All')
        {
            $dwhere[$this->devices->BRANCH_ID]= $branch_id;
        }
        else
        {
            $dor_where = $this->devices->BRANCH_ID. " IN " .BRANCHALL;
            
        }
        //$where[$this->condemnation->BRANCH_ID]=$this->session->branch_id;
        $where[$this->condemnation->ORG_ID]=$this->session->org_id;
        $dwhere[$this->devices->ORG_ID]=$this->session->org_id;
        //$dwhere[$this->devices->BRANCH_ID]=$this->session->branch_id;
        $dwhere[$this->devices->DEPT_ID.' !=']=NULL;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$dwhere,$dor_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        for($i=0;$i<count($list);$i++)
        {
            $where[$this->condemnation->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->condemnation->tbl_name,$where,$or_where);
        }
        return $data;
        }
        
    }
    private function _viabilty_report_graph($jodata = array())
    {
        /* $data=array();
         $date=date('Y-m-d');
         $last_day= date("t", strtotime($date));
         if($this->session->role_code==HBBME)
         {
             $where[$this->viability->ADDED_BY]=$this->session->user_id;
         }
         /*for($i=0;$i<$last_day;$i++)*/
        /*  $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
          $or_where = '';
          if($branch_id != 'All')
          {
              $where[$this->viability->BRANCH_ID]=$branch_id;
          }
          else
          {
              $or_where = $this->viability->BRANCH_ID."IN".BRANCHALL;
          }
  
          $where[$this->viability->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
          $dwhere[$this->devices->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
          $dwhere[$this->devices->BRANCH_ID]=$branch_id;
          $dwhere[$this->devices->DEPT_ID.' !=']=NULL;
          $list=$this->basemodel->fetch_distinct_records($this->devices->tbl_name,$dwhere,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
          for($i=0;$i<count($list);$i++)
          {
              $where[$this->viability->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
              $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->viability->tbl_name,$where,$or_where);
          }
          /*}
          return $data;*/


        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->viability->ADDED_BY]=$this->session->user_id;
        }
        /*for($i=0;$i<$last_day;$i++)*/
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $or_where = '';
        if($branch_id != 'All')
        {
            $where[$this->viability->BRANCH_ID]=$branch_id;
        }
        else
        {
            $or_where = $this->viability->BRANCH_ID." IN ".BRANCHALL;
        }

        $where[$this->viability->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $dwhere[$this->devices->ORG_ID]=isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        //   $dwhere[$this->devices->BRANCH_ID]=$branch_id;
        if($branch_id != 'All')
        {
            $dwhere[$this->devices->BRANCH_ID]=$branch_id;
        }
        else
        {
            $orr_where = $this->devices->BRANCH_ID." IN ".BRANCHALL;
        }
        $dwhere[$this->devices->DEPT_ID.' !=']=NULL;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$dwhere,$orr_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        for($i=0;$i<count($list);$i++)
        {
            $where[$this->viability->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->viability->tbl_name,$where,$or_where);
        }
        /*}*/
        return $data;
    }
    private function _deployement_report_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        /*    if($this->session->role_code==HBBME)
            {
                $where[$this->devices->USERNAME]=$this->session->user_id;
            }*/
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        if($branch_id !='All')
        {
           $where[$this->devices->BRANCH_ID]= $branch_id;
        }
        else
        {
            $or_where = $this->devices->BRANCH_ID. " IN " .BRANCHALL;
        }
        
        $where[$this->devices->ORG_ID]=$this->session->org_id;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$where,$or_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        //print_r($this->db->last_query());
        for($i=0;$i<count($list);$i++)
        {
            $where[$this->devices->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->devices->tbl_name,$where,$or_where);
        }
        /*    print_r($data);
            die();*/
        return $data;
    }
    private function _redeployement_report_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        /* if($this->session->role_code==HBBME)
         {
             $where[$this->transfer->USERNAME]=$this->session->user_id;
         }*/
        $where[$this->transfer->TRANSFER_BRANCH]=$this->session->branch_id;
        $where[$this->transfer->ORG_ID]=$this->session->org_id;
        $where[$this->transfer->DEPLOYMENT_ID.' != ']=NULL;
        $dwhere[$this->devices->BRANCH_ID]=$this->session->branch_id;
        $dwhere[$this->devices->ORG_ID]=$this->session->org_id;
        $dwhere[$this->devices->DEPT_ID.' !=']=NULL;
        $list=$this->basemodel->fetch_distinct_records($this->devices->tbl_name,$dwhere,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        //print_r($this->db->last->query());
        for($i=0;$i<count($list);$i++)
        {
            $where[$this->transfer->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->transfer->tbl_name,$where);
        }
        // print_r($data);
        //die();
        return $data;
    }
    private function _service_report_graph($jodata = array())
    {
        /*  $data=array();
          $date=date('Y-m-d');
          $last_day= date("t", strtotime($date));
          /*    if($this->session->role_code==HBBME)
              {
                  $where[$this->devices->USERNAME]=$this->session->user_id;
              }
          $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
          $where[$this->devices->BRANCH_ID]= $branch_id;
          $where[$this->devices->ORG_ID]=$this->session->org_id;
          $dwhere[$this->devices->DEPT_ID.' !=']=NULL;
          $list=$this->basemodel->fetch_distinct_records($this->devices->tbl_name,$where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
          //print_r($this->db->last_query());
          for($i=0;$i<count($list);$i++)
          {
              $where[$this->devices->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
              $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->devices->tbl_name,$where);
          }
          /*    print_r($data);
              die();
          return $data;*/

        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        /*    if($this->session->role_code==HBBME)
            {
                $where[$this->devices->USERNAME]=$this->session->user_id;
            }*/
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        //$where[$this->devices->BRANCH_ID]= $branch_id;
        if($branch_id != 'All'){
            $where[$this->devices->BRANCH_ID] = $branch_id;
		}
        else {
            $or_where = $this->devices->BRANCH_ID. " IN " . BRANCHALL;
		}
        $where[$this->devices->ORG_ID]=$this->session->org_id;
        $where[$this->devices->DEPT_ID.' !=']=NULL;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$where,$or_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        //return $this->db->last_query();
        for($i=0;$i<count($list);$i++)
        {
            $where[$this->devices->DEPT_ID]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->devices->tbl_name,$where,$or_where);
        }
        /*    print_r($data);
            die();*/
        return $data;
    }
    private function _calllog_report_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        /* if($this->session->role_code==HBBME)
         {
             $where[$this->transfer->USERNAME]=$this->session->user_id;
         }*/
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $where[$this->cms->ORG_ID]=$this->session->org_id;
       // $where[$this->cms->BRANCH_ID]=$branch_id;
		if($branch_id !='All')
		{
			$where[$this->cms->BRANCH_ID]=$branch_id;
		}
		else
		{
			$or_where = $this->cms->BRANCH_ID. " IN" .BRANCHALL;
		}
		if($branch_id !='All')
		{
			$dwhere[$this->devices->BRANCH_ID]=$branch_id;
		}
		else
		{
			$dor_where = $this->devices->BRANCH_ID. " IN" .BRANCHALL;
		}
       // $dwhere[$this->devices->BRANCH_ID]=$branch_id;
        $dwhere[$this->devices->ORG_ID]=$this->session->org_id;
        $dwhere[$this->devices->DEPT_ID.' !=']=NULL;
        $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$dwhere,$dor_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
        //print_r($this->db->last->query());
        for($i=0;$i<count($list);$i++)
        {
            $where[$this->cms->CALLER_DEPT]=$list[$i][$this->devices->DEPT_ID];
            $data[$list[$i][$this->devices->DEPT_ID]]=$this->basemodel->num_of_res($this->cms->tbl_name,$where,$or_where);
        }
        /* print_r($data);
        die();*/
        return $data;
    }
    private function _nonsheduled_graph($jodata = array())
    {

        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $or_where = '';
        if($branch_id!='All')
        {
            $bwhere[$this->branches->BRANCH_ID] = $branch_id;
        }
        else
        {
            $or_where = $this->branches->BRANCH_ID. " IN " .BRANCHALL;
        }
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $last_day= date("t", strtotime($date));
        $bwhere[$this->branches->BRANCH_ID] = $branch_id;
        $bwhere[$this->branches->ORG_ID] = $org_id;
        $where[$this->cms->ORG_ID] = $org_id;
        $where[$this->cms->TO_ADVERSE] = NULL;
        $list = $this->basemodel->fetch_records_from_multi_where($this->branches->tbl_name, $bwhere,$or_where);
        //  return $this->db->last_query();
        $contracts=$this->basemodel->fetch_records_from($this->contracttypes->tbl_name);
        for($i=0;$i<count($list);$i++)
        {
            $no_tot_bkdwn_total = 0;
            $where[$this->cms->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
            for ($j = 0; $j < count($contracts); $j++)
            {
                $like[$this->cms->CALLER_ID] = "-" . $contracts[$j][$this->contracttypes->CFORM] . "BD-";
                $list[$i]['no_of_' . $contracts[$j][$this->contracttypes->CFORM] . '_bkdwns'] = $this->basemodel->num_of_res($this->cms->tbl_name, $where, '','','', $like);
                $data["tot_no_" . $contracts[$j][$this->contracttypes->CFORM] . "bd"] = $list[$i]['no_of_' . $contracts[$j][$this->contracttypes->CFORM] . '_bkdwns'] + $data["tot_no_" . $contracts[$j][$this->contracttypes->CFORM] . "bd"];
                $no_tot_bkdwn_total = $no_tot_bkdwn_total + $list[$i]['no_of_' . $contracts[$j][$this->contracttypes->CFORM] . '_bkdwns'];
                //$tot_subtotal_Bbd=$tot_subtotal_Bbd+$no_tot_bkdwn_total;
            }
        }
        return $data;
    }
    private function _response_time_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $or_where = '';
        if($branch_id !='All')
        {
            $b_where[$this->branches->BRANCH_ID] = $branch_id;

        }
        else
        {
            $or_where = $this->branches->BRANCH_ID. " IN " .BRANCHALL;
        }
        $org_id = $this->session->org_id;
        //  $b_where[$this->branches->BRANCH_ID] = $branch_id;
        $b_where[$this->branches->ORG_ID] = $org_id;
        $where[$this->cms->ORG_ID] = $org_id;
        $where[$this->cms->TO_ADVERSE] = NULL;
        $list = $this->basemodel->fetch_records_from_multi_where($this->branches->tbl_name, $b_where,$or_where);
        // return $this->db->last_query();
        if(!empty($list))
        {
            for($i=0;$i<count($list);$i++)
            {
                $where[$this->cms->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
                $rwhere[$this->cms->RESPONSE_TIME.' <=']=10;
                $rwhere[$this->cms->RESPONSE_TIME.' !=']=NULL;
                $data['rt']['response_lt_10']=$this->basemodel->num_of_res($this->cms->tbl_name,$rwhere,$where);
                $rwhere1[$this->cms->RESPONSE_TIME.' <=']=60;
                $rwhere1[$this->cms->RESPONSE_TIME.' >']=10;
                $rwhere1[$this->cms->RESPONSE_TIME.' !=']=NULL;
                $data['rt']['response_lt_60']=$this->basemodel->num_of_res($this->cms->tbl_name,$rwhere1,$where);
                $rwhere2[$this->cms->RESPONSE_TIME.' >']=60;
                $rwhere2[$this->cms->RESPONSE_TIME.' !=']=NULL;
                $data['rt']['response_gt_60']=$this->basemodel->num_of_res($this->cms->tbl_name,$rwhere2,$where);
                //$list[$i]['toatl_response_time']=$list[$i]['response_gt_60']+ $list[$i]['response_lt_60']+$list[$i]['response_lt_10'];
            }
        }
        return $data;
    }
    private function _time_to_repair_graph($jodata = array())
    {

        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $or_where = '';
        if($branch_id !='All')
        {
            $where[$this->cms->BRANCH_ID] = $branch_id;
        }
        else
        {
            $or_where = $this->cms->BRANCH_ID. " IN " .BRANCHALL;
        }

        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $last_day= date("t", strtotime($date));
        $where[$this->cms->ORG_ID] = $org_id;
        $where[$this->cms->TO_ADVERSE] = NULL;
        $list = $this->basemodel->fetch_records_from_multi_where($this->branches->tbl_name,$where,$or_where);
        // return $list;
        if(!empty($list))
        {
            for($i=0;$i<count($list);$i++)
            {
                $twhere[$this->cms->TIME_TO_REPAIR.' <=']=1;
                $twhere[$this->cms->TIME_TO_REPAIR.' !=']=NULL;
                $list[$i]['tt']['ttr_lt_1d']=$this->basemodel->num_of_res($this->cms->tbl_name,$twhere,$where,'');
                $twhere1[$this->cms->TIME_TO_REPAIR.' <=']=3;
                $twhere1[$this->cms->TIME_TO_REPAIR.' >']=1;
                $twhere1[$this->cms->TIME_TO_REPAIR.' !=']=NULL;
                $list[$i]['tt']['ttr_lt_3d']=$this->basemodel->num_of_res($this->cms->tbl_name,$twhere1,$where,'');
                $twhere2[$this->cms->TIME_TO_REPAIR.' >']=3;
                $twhere2[$this->cms->TIME_TO_REPAIR.' !=']=NULL;
                $list[$i]['tt']['ttr_gt_3d']=$this->basemodel->num_of_res($this->cms->tbl_name,$twhere2,$where,'');
            }
            $data['response'] = SUCCESSDATA;
            $data['list'] = $list;
        }
        else
        {
            $data['response'] = EMPTYDATA;
            $data['list'] = null;
        }
        //print_r($data);
        return $data;
    }
    private function _sheduled_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $last_day= date("t", strtotime($date));
        $where[$this->cms->BRANCH_ID] = $branch_id;
        $where[$this->cms->ORG_ID] = $org_id;
        $where[$this->cms->TO_ADVERSE] = NULL;
        $list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
        $contracts=$this->basemodel->fetch_records_from($this->contracttypes->tbl_name);
        if (!empty($list))
        {
            for($i=0;$i<count($list);$i++)
            {
                $no_tot_bkdwn_total=0;
                $no_tot_pms_total=0;
                $tot_subtotal_Bbd=0;
                $where[$this->cms->BRANCH_ID]=$list[$i][$this->branches->BRANCH_ID];
                $pwhere[$this->pmsdetails->BRANCH_ID]=$list[$i][$this->branches->BRANCH_ID];
                for($j=0;$j<count($contracts);$j++)
                {
                    $plike[$this->pmsdetails->JOB_ID]="-".$contracts[$j][$this->contracttypes->CFORM]."P-";
                    $list[$i]['s']['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_pms']=$this->basemodel->num_of_res($this->pmsdetails->tbl_name,$pwhere,'','','',$plike);
                    $data["tot_no_".$contracts[$j][$this->contracttypes->CFORM]."pms"]=$list[$i]['s']['no_of_'.$contracts[$j][$this->contracttypes->CFORM].'_pms']+$data["tot_no_".$contracts[$j][$this->contracttypes->CFORM]."pms"];
                }
                /* adverse incidents */
            }
            $data['response'] = SUCCESSDATA;
            $data['list'] = $list;
            //print_r($data['list']);
        }
        else
        {
            $data['response'] = EMPTYDATA;
            $data['list'] = null;
        }
        //print_r($data);
        return $data;
    }
    private function _cause_codes_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $or_where = '';
        if($branch_id !='All')
        {
            $where[$this->cms->BRANCH_ID] = $branch_id;
        }
        else
        {
            $or_where = $this->cms->BRANCH_ID. " IN ".BRANCHALL;
        }
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $last_day= date("t", strtotime($date));
        // $where[$this->cms->BRANCH_ID] = $branch_id;
        $where[$this->cms->ORG_ID] = $org_id;
        $where[$this->cms->TO_ADVERSE] = NULL;
        //$list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
        //$clist = $this->basemodel->fetch_records_from($this->cms->tbl_name, $where);
        $cclist=$this->basemodel->fetch_records_from($this->causecodes->tbl_name);
        if (!empty($cclist))
        {
            for($i=0;$i<count($cclist);$i++)
            {
                $where[$this->cms->RESPONDED_TIME.' >']=60;
                $where[$this->cms->TIME_TO_REPAIR.' >']=1;
                $where[$this->cms->PENDING_REASON]=$cclist[$i][$this->causecodes->CAUSE];
                $data['count'][$i]=$this->basemodel->num_of_res($this->cms->tbl_name,$where);
                $data['name'][$i]=$cclist[$i][$this->causecodes->CAUSE];
                //print_r( $data['cause_code']);
            }
            $data['response'] = SUCCESSDATA;
            //print_r($data);
        }
        else
        {
            $data['response'] = EMPTYDATA;
            $data['list'] = null;
        }
        //print_r($data);
        return $data;
    }
    private function _rt_ttr_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        /* $or_where = '';
         if($branch_id !='All')
         {
             $where[$this->cms->BRANCH_ID] = $branch_id;
 
         }
         else
         {
             $or_where = $this->cms->BRANCH_ID. " IN " .BRANCHALL;
         } */
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $last_day= date("t", strtotime($date));
        $where[$this->cms->BRANCH_ID] = $branch_id;
        $where[$this->cms->ORG_ID] = $org_id;
        $where[$this->cms->TO_ADVERSE] = NULL;
        $list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
        if (!empty($list))
        {
            for($i=0;$i<count($list);$i++)
            {
                $where1[$this->cms->RESPONDED_TIME.' >']=60;
                $where1[$this->cms->BRANCH_ID]=$list[$i][$this->branches->BRANCH_ID];
                $data['rt_count']=$this->basemodel->num_of_res($this->cms->tbl_name,$where1);
                $where2[$this->cms->TIME_TO_REPAIR.' >']=1;
                $where2[$this->cms->BRANCH_ID]=$list[$i][$this->branches->BRANCH_ID];
                $data['ttr_count']=$this->basemodel->num_of_res($this->cms->tbl_name,$where2);
            }
            $data['response'] = SUCCESSDATA;
        }
        else
        {
            $data['response'] = EMPTYDATA;
        }
        //print_r($data);
        return $data;
    }
    private function _assets_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $last_day= date("t", strtotime($date));
        $where[$this->cms->BRANCH_ID] = $branch_id;
        $where[$this->cms->ORG_ID] = $org_id;
        $where[$this->cms->TO_ADVERSE] = NULL;
        $date2 = date('Y-m-d',strtotime("+1 month",strtotime($date)));
        $list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
        if (!empty($list))
        {
            $dalist_tot = $dalist_tot_cnt = 0;
            $contracts=$this->basemodel->fetch_records_from($this->contracttypes->tbl_name);
            for($k=0;$k<=count($contracts);$k++)
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
            }
            $data['response'] = SUCCESSDATA;
        }
        else
        {
            $data['response'] = EMPTYDATA;
            $data['list'] = null;
        }
        //print_r($data);
        return $data;
    }
    private function _activities_graph($jodata = array())
    {
        return "ok";
        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        /* if($branch_id !='All')
         {
             $
         }*/
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $last_day= date("t", strtotime($date));
        $where[$this->cms->BRANCH_ID] = $branch_id;
        $where[$this->cms->ORG_ID] = $org_id;
        $where[$this->cms->TO_ADVERSE] = NULL;
        $list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
        //  return $this->db->last_query();
        $contracts=$this->basemodel->fetch_records_from($this->contracttypes->tbl_name);
        if (!empty($list))
        {
            for($i=0;$i<count($list);$i++)
            {
                //Grn COUNT And COST
                $dvc_like[$this->devices->GRN_DATE] = date('Y-m',strtotime($date));
                $dvc__where[$this->devices->GRN_VALUE." !="] = NULL;
                $dvc__where[$this->devices->ORG_ID] = $this->session->org_id;
                $dvc__where[$this->devices->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
                $dvc__list=$this->basemodel->sum_of_column($this->devices->tbl_name,$this->devices->GRN_VALUE,$dvc__where,'',$dvc_like);
                $data['cc']['grn_cost'] = $dvc__list;
                $grn_cnt=$this->basemodel->num_of_res($this->devices->tbl_name,$dvc__where,'','','',$dvc_like);
                $data['ct']['grn_count'] = $grn_cnt;
                //Adverse Incidents Details
                $aidlike[$this->incedents->DATE_OCCRANCE] =date('Y-m',strtotime($date));
                $aidwhere[$this->incedents->COMPLETED_BY." !="] =NULL;
                $aidwhere[$this->incedents->ACTION_TACKEN." !="] =NULL;
                $aidwhere[$this->incedents->ORG_ID] = $this->session->org_id;
                $aidwhere[$this->incedents->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
                $aid_list=$this->basemodel->sum_of_column($this->incedents->tbl_name,$this->incedents->TOTAL_COST,$aidwhere,'',$aidlike);
                $data['cc']['incidents_cost'] = $aid_list;
                $aid_cnt=$this->basemodel->num_of_res($this->incedents->tbl_name,$aidwhere,'','','',$aidlike);
                $data['ct']['incidents_count'] = $aid_cnt;
            }
            //Equp COUNT And COST
            $eqp__where[$this->devices->DATEOF_INSTALL." !="] = NULL;
            $eqp__where[$this->devices->ORG_ID] = $this->session->org_id;
            $eqp__where[$this->devices->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
            $eqp__list=$this->basemodel->sum_of_column($this->devices->tbl_name,$this->devices->E_COST,$eqp__where,'');
            $data['cc']['eq_cost'] = $eqp__list;
            $eqp_cnt=$this->basemodel->num_of_res($this->devices->tbl_name,$eqp__where,'','','');
            $data['ct']['eq_count'] = $eqp_cnt;
            //Condemnation Count Cost
            $condem_like[$this->condemnation->ADDED_ON] = date('Y-m',strtotime($date));
            $condem_where[$this->condemnation->EXPECTED_COST." !="] = NULL;
            $condem_where[$this->condemnation->ORG_ID] = $this->session->org_id;
            $condem_where[$this->condemnation->BRANCH_ID] = $list[$i][$this->branches->BRANCH_ID];
            $condem_where[$this->condemnation->EXPECTED_COST." !="] = NULL;
            $condem_list=$this->basemodel->sum_of_column($this->condemnation->tbl_name,$this->condemnation->EXPECTED_COST,$condem_where,'',$condem_like);
            $data['cc']['condem_cost'] = $condem_list;
            $condem_cnt=$this->basemodel->num_of_res($this->condemnation->tbl_name,$condem_where,'','','',$condem_like);
            $data['ct']['condem_count'] = $condem_cnt;
            $data['response'] = SUCCESSDATA;
            $data['list'] = $list;
            //print_r($data['list']);
        }
        else
        {
            $data['response'] = EMPTYDATA;
            $data['list'] = null;
        }
        //print_r($data);
        return $data;
    }
    private function _expenses_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $last_day= date("t", strtotime($date));
        $where[$this->cms->BRANCH_ID] = $branch_id;
        $where[$this->cms->ORG_ID] = $org_id;
        $where[$this->cms->TO_ADVERSE] = NULL;
        $list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
        //$clist = $this->basemodel->fetch_records_from($this->cms->tbl_name, $where);
        $cclist=$this->basemodel->fetch_records_from($this->causecodes->tbl_name);
        if(!empty($list))
        {
            for($i=0;$i<count($list);$i++)
            {
                $qclike[$this->qcdetails->QC_DUE]=date('Y-m',strtotime($date));
                $qcwhere[$this->qcdetails->COMPLETED_BY." !="]=NULL;
                $qclist=$this->basemodel->sum_of_column($this->qcdetails->tbl_name,$this->qcdetails->COST,$qcwhere,'',$qclike);
                //print_r($this->db->last_query());
                //Calibration Details
                $data['cost']['qcdone_cost']=$qclist;
                $qclist_cnt=$this->basemodel->num_of_res($this->qcdetails->tbl_name,$qcwhere,'','','',$qclike);
                $data['count']['qcdone_cnt']=$qclist_cnt;
                $swhere[$this->criticalspares->STATUS]='A';
                $slist=$this->basemodel->sum_of_column($this->criticalspares->tbl_name,$this->criticalspares->COST,$swhere);
                $data['cost']['spares_cost']=$slist;
                $slist_cnt=$this->basemodel->num_of_res($this->criticalspares->tbl_name,$swhere);
                $data['count']['spares_cnt']=$slist_cnt;
                //accessories Details
                $abwhere[$this->accessories->STATUS]='A';
                $alist=$this->basemodel->sum_of_column($this->accessories->tbl_name,$this->accessories->COST,$abwhere);
                $data['cost']['accessories_cost']=$alist;
                $alist_cnt=$this->basemodel->num_of_res($this->accessories->tbl_name,$abwhere);
                $data['count']['accessories_cnt']=$alist_cnt;
                //services Details
                $srwhere[$this->cms->STATUS]='A';
                $srlist=$this->basemodel->sum_of_column($this->cms->tbl_name,$this->cms->COST,$srwhere);
                $data['cost']['services_cost']=$srlist;
                $srlist_cnt=$this->basemodel->num_of_res($this->cms->tbl_name,$swhere);
                $data['count']['services_cnt']=$srlist_cnt;
                //consumbles Details
                $data['cost']['consubble_cost']=0;
                $data['count']['consubble_cnt']=0;
            }
            $data['response'] = SUCCESSDATA;
            //print_r($data);
        }
        else
        {
            $data['response'] = EMPTYDATA;
        }
        //print_r($data);
        return $data;
    }
    private function _contracts_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $last_day= date("t", strtotime($date));
        $where[$this->cms->BRANCH_ID] = $branch_id;
        $where[$this->cms->ORG_ID] = $org_id;
        $where[$this->cms->TO_ADVERSE] = NULL;
        $list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
        if (!empty($list))
        {
            if($jodata->mprsdate!="")
            {
                $date=date('Y-m-d',strtotime($jodata->mprsdate));
            }
            else
            {
                $date=date('Y-m-d');
            }
            $date2 = date('Y-m-d',strtotime("+1 month",strtotime($date)));
            /*live contracts*/
            $tlc_where[$this->deviceamcs->ORG_ID] = $org_id;
            $tlc_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $tlc_where[$this->deviceamcs->STATUS] = OPEN;
            $tlc_where[$this->deviceamcs->AMC_FROM." <="]=$date;
            $tlc_where[$this->deviceamcs->AMC_TO." >"]=$date2;
            $tlc_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$tlc_where);
            $tlc_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$tlc_where);
            $data['cost']['tlc_cost']=$tlc_sum;
            $data['count']['tlc_count']=$tlc_count;
            /* expired contracts till last month*/
            $exc_where[$this->deviceamcs->ORG_ID] = $org_id;
            $exc_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $exc_where[$this->deviceamcs->AMC_TYPE." !="] = WARRANTY;
            $last_mnth = date('Y-m-01',strtotime("-1 month",strtotime($date)));
            $exc_where1 = $this->deviceamcs->AMC_TO . " BETWEEN '" . $last_mnth . "' AND '" . $date . "'";
            $exc_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$exc_where,$exc_where1);
            $exc_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$exc_where,$exc_where1);
            $data['cost']['exc_sum']=$exc_sum;
            $data['count']['exc_count']=$exc_count;
            /* expired warranty till last month  */
            unset($exc_where[$this->deviceamcs->AMC_TYPE." !="]);
            $exc_where[$this->deviceamcs->AMC_TYPE] = WARRANTY;
            $exw_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$exc_where,$exc_where1);
            $exw_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$exc_where,$exc_where1);
            $data['cost']['exw_sum']=$exw_sum;
            $data['count']['exw_count']=$exw_count;
            /* contracts expired and sent for renewal */
            $cesr_where[$this->deviceamcs->ORG_ID] = $org_id;
            $cesr_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $cesr_where[$this->deviceamcs->RID." !="] = NULL;
            $cesr_where[$this->deviceamcs->AMC_TYPE." !="] = WARRANTY;
            $cesr_where[$this->deviceamcs->UPDATE_TYPE] = 'R';
            $cesr_like[$this->deviceamcs->ADDED_ON] = date('Y-m',strtotime($date));
            $cesr_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$cesr_where,'',$cesr_like);
            $cesr_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$cesr_where,'','','',$cesr_like);
            $data['cost']['cesr_sum']=$cesr_sum;
            $data['count']['cesr_count']=$cesr_count;
            /* warranty expired and sent for renewal */
            unset($cesr_where[$this->deviceamcs->AMC_TYPE." !="]);
            $cesr_where[$this->deviceamcs->AMC_TYPE] = WARRANTY;
            $wesr_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$cesr_where,'',$cesr_like);
            $wesr_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$cesr_where,'','','',$cesr_like);
            $data['cost']['wesr_sum']=$wesr_sum;
            $data['count']['wesr_count']=$wesr_count;
            /* WARR. TO CONTRACTS NOT DESIRED */
            $data['cost']['wtcnd_sum']=0;
            $data['count']['wtcnd_count']=0;
            /* CONTRACT renewals NOT DESIRED */
            $data['cost']['crnd_sum']=0;
            $data['count']['crnd_count']=0;
            /* contract renewals done since last month */
            $crlm_where[$this->deviceamcs->ORG_ID] = $org_id;
            $crlm_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $crlm_where[$this->deviceamcs->AMC_TYPE." !="] = WARRANTY;
            $crlm_where[$this->deviceamcs->UPDATE_TYPE] = 'R';
            $crlm_where1 = $this->deviceamcs->ADDED_ON . " BETWEEN '" . $last_mnth . " 00:00:00' AND '" . $date . " 23:59:59'";
            $crlm_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$crlm_where,$crlm_where1);
            $crlm_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$crlm_where,$crlm_where1);
            $data['cost']['crlm_sum']=$crlm_sum;
            $data['count']['crlm_count']=$crlm_count;
            /* contract renewals Pending */
            $crp_where[$this->deviceamcs->ORG_ID] = $org_id;
            $crp_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $crp_where[$this->deviceamcs->AMC_TYPE." !="] = WARRANTY;
            $crp_where[$this->deviceamcs->UPDATE_TYPE] = 'R';
            $crp_where[$this->deviceamcs->AMC_TO." <"] = $date;
            $crp_where[$this->deviceamcs->STATUS] = OPEN;
            $crp_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$crp_where);
            $crp_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$crp_where);
            $data['cost']['crp_sum']=$crp_sum;
            $data['count']['crp_count']=$crp_count;
            /* expiring contracts in cmg month*/
            $eccm_where[$this->deviceamcs->ORG_ID] = $org_id;
            $eccm_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $eccm_where[$this->deviceamcs->AMC_TYPE." !="] = WARRANTY;
            $next_mnth = date('Y-m-d',strtotime("+1 month",strtotime($date)));
            $eccm_where1 = $this->deviceamcs->AMC_TO . " BETWEEN '" . $date . "' AND '" . $next_mnth . "'";
            $eccm_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$eccm_where,$eccm_where1);
            $eccm_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$eccm_where,$eccm_where1);
            $data['cost']['eccm_sum']=$eccm_sum;
            $data['count']['eccm_count']=$eccm_count;
            /* expiring warranty in cmg month  */
            unset($eccm_where[$this->deviceamcs->AMC_TYPE." !="]);
            $eccm_where[$this->deviceamcs->AMC_TYPE] = WARRANTY;
            $ewcm_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$eccm_where,$eccm_where1);
            $ewcm_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$eccm_where,$eccm_where1);
            $data['cost']['ewcm_sum']=$ewcm_sum;
            $data['count']['ewcm_count']=$ewcm_count;
            /* CONT's (TO BE) INDENTED FOR RENEWAL */
            $data['cost']['cifr_sum']=0;
            $data['count']['cifr_count']=0;
            /* total contracts renewal pening */
            unset($crp_where[$this->deviceamcs->AMC_TYPE." !="]);
            $tcrp_sum=$this->basemodel->sum_of_column($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VALUE,$crp_where);
            $tcrp_count=$this->basemodel->num_of_res($this->deviceamcs->tbl_name,$crp_where);
            $data['cost']['tcrp_sum']=$tcrp_sum;
            $data['count']['tcrp_count']=$tcrp_count;
            $data['response'] = SUCCESSDATA;
        }
        else
        {
            $data['response'] = EMPTYDATA;
        }
        //print_r($data);
        return $data;
    }
    private function _engineering_productivity_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $last_day= date("t", strtotime($date));
        $where[$this->cms->BRANCH_ID] = $branch_id;
        $where[$this->cms->ORG_ID] = $org_id;
        $where[$this->cms->TO_ADVERSE] = NULL;
        $list = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
        if (!empty($list))
        {
            if($jodata->mprsdate!="")
            {
                $date=date('Y-m-d',strtotime($jodata->mprsdate));
            }
            else
            {
                $date=date('Y-m-d');
            }
            $date2 = date('Y-m-d',strtotime("+1 month",strtotime($date)));
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
                    $data['calls']['name'][$l]=$branch_users[$l][$this->users->USER_NAME];
                    $data['calls']['cms_cnt'][$l]=$user_cms_count;
                    $data['calls']['rounds_cnt'][$l]=$user_rounds_count;
                    $data['calls']['pms_cnt'][$l]=$user_pms_count;
                    $data['calls']['trngs_cnt'][$l]=$user_trngs_count;
                    $data['calls']['total_trips'][$l]=$user_cms_count+$user_rounds_count+$user_pms_count+$user_trngs_count;
                }
            }
            $data['response'] = SUCCESSDATA;
        }
        else
        {
            $data['response'] = EMPTYDATA;
        }
        //print_r($data);
        return $data;
    }
    private function _nabhreadiness_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        /*/  if($branch_id !='All')
          {
  
          }*/
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $last_day= date("t", strtotime($date));
        $qclist = $this->basemodel->fetch_records_from($this->qceqcats->tbl_name);
        for($i=0;$i<count($qclist);$i++)
        {
            $qc_cats= explode(",",$qclist[$i][$this->qceqcats->CODES]);
            $this->db->select('count(hsp_tbl_qc_details.ID) as cnt,sum(hsp_tbl_qc_details.COST) as cost');
            $this->db->from($this->db->dbprefix($this->qcdetails->tbl_name));
            $this->db->join($this->db->dbprefix($this->devices->tbl_name), 'hsp_tbl_devices.E_ID = hsp_tbl_qc_details.EID');
            $this->db->join($this->db->dbprefix($this->devicenames->tbl_name), 'hsp_tbl_devices.E_CAT = hsp_tbl_m_device_names.ID');
            $this->db->where_in('hsp_tbl_m_device_names.CODE',$qc_cats);
            $this->db->where('hsp_tbl_qc_details.BRANCH_ID',$branch_id);
            $this->db->where('hsp_tbl_qc_details.ORG_ID',$org_id);
            $qc_devices_qry = $this->db->get();
            $qc_devices = $qc_devices_qry->result_array();
            $data['keys'][$i]=$qclist[$i][$this->qceqcats->NAME];
            $data['count'][$i]=$qc_devices[0]['cnt'];
            $data['cost'][$i]=$qc_devices[0]['cost']=='' ? 0 : $qc_devices[0]['cost'];
            $no_same_equpts=0;
        }
        //print_r($data);
        return $data;
    }
    private function _equp_dwntm_report_graph($jodata = array())
    {
        $data=array();
        $date=date('Y-m-d');
        $last_day= date("t", strtotime($date));
        if($this->session->role_code==HBBME)
        {
            $where[$this->devices->USERNAME]=$this->session->user_id;
        }
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $data = array();
        $where = array();
		$where_date = '';
        if(!empty($jodata))
        {
           // $where[$this->cms->BRANCH_ID] = $branch_id;
			  if($branch_id != 'All'){
            $where[$this->cms->BRANCH_ID] = $branch_id;
			  }
        else{
            $where_date = $this->cms->BRANCH_ID." IN ".BRANCHALL;
		}
            $where[$this->cms->STATUS." !="] = DNW;
            $where[$this->cms->ORG_ID] = $org_id;
            $where[$this->cms->TO_ADVERSE] = NULL;
            if (isset($jodata->equp_id) && $jodata->equp_id != "" && $jodata->equp_id != null)
                $where[$this->cms->EID] = $jodata->equp_id;
            if (isset($jodata->dept_id) && $jodata->dept_id != "" && $jodata->dept_id != null)
                $where[$this->cms->CALLER_DEPT] = $jodata->dept_id;
            
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = "CONCAT_WS(' ',".$this->cms->CDATE.",".$this->cms->CTIME.") BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }
            $equp_dwn_tm= $this->basemodel->awesome_fetch($this->cms->tbl_name,$where,$where_date);
            //$data['qry'] = $this->db->last_query();
            if (!empty($equp_dwn_tm))
            {
                $data['response'] = SUCCESSDATA;
                for($i=0;$i<count($equp_dwn_tm);$i++)
                {
                    $equp_dwn_tm[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $equp_dwn_tm[$i][$this->cms->EID]));
                    $equp_dwn_tm[$i]['cmpny_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->C_NAME, array($this->devices->E_ID => $equp_dwn_tm[$i][$this->cms->EID]));
                    $no_same_equpts=0;
                    $dev_where[$this->devices->C_NAME] = $equp_dwn_tm[$i]['cmpny_name'];
                    $dev_where[$this->devices->E_NAME] = $equp_dwn_tm[$i]['equp_name'];
				 if($branch_id != 'All'){
            $dev_where[$this->devices->BRANCH_ID] = $branch_id;
                      }
                   else{
            $or_where = $this->devices->BRANCH_ID." IN ".BRANCHALL;
		}
                   // $dev_where[$this->devices->BRANCH_ID] = $branch_id;
                    $dev_where[$this->devices->ORG_ID] = $org_id;
                    $dev_where[$this->devices->E_ID." !="] = NULL;
                    $dev_cnt = $this->basemodel->num_of_res($this->devices->tbl_name,$dev_where,$or_where);
                    $no_same_equpts = $no_same_equpts+$dev_cnt;
                    if($equp_dwn_tm[$i][$this->cms->JOBCOMPLETED_DATE]!=NULL)
                    {
                        $dwntime=$this->basemodel->timeDifference($equp_dwn_tm[$i][$this->cms->CDATE].' '.$equp_dwn_tm[$i][$this->cms->CTIME],$equp_dwn_tm[$i][$this->cms->JOBCOMPLETED_DATE].' '.$equp_dwn_tm[$i][$this->cms->JOBCOMPLETED_TIME]);
                    }
                    else
                    {
                        $dwntime=$this->basemodel->timeDifference($equp_dwn_tm[$i][$this->cms->CDATE].' '.$equp_dwn_tm[$i][$this->cms->CTIME],date('Y-m-d H:i:s'));
                    }
                    $last_day= date("t", strtotime(date('Y-m-d H:i:s')));
                    /* count no of equipments based on equp_name,Cmny_name */
                    $equp_dwn_tm[$i]['no_same_equpts'] = $no_same_equpts;
                    /* count no of equipments based on equp_name,Cmny_name */
                    $equp_dwn_tm[$i]['total_down_time']=round((($dwntime)/($last_day*$no_same_equpts))*100,2);
                    if(is_numeric($equp_dwn_tm[$i]['cmpny_name']))
                    {
                        $equp_dwn_tm[$i]['cmpny_name']=$this->basemodel->get_single_column_value($this->devicevendors->tbl_name,$this->devicevendors->NAME,array($this->devicevendors->ID=> $equp_dwn_tm[$i]['cmpny_name']));
                    }
                    $data['total_down_time'][$i] = $equp_dwn_tm[$i]['total_down_time'];
                    $data['equp_name'][$i]= $equp_dwn_tm[$i]['equp_name'];
                }
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
        /*  $data=array();
          $date=date('Y-m-d');
          $last_day= date("t", strtotime($date));
          if($this->session->role_code==HBBME)
          {
              $where[$this->devices->USERNAME]=$this->session->user_id;
          }
          $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
          $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
          $data = array();
          $where = array();
          $where_date = '';
          if(!empty($jodata))
          {
              if($branch_id !='All')
                  $where[$this->cms->BRANCH_ID] = $branch_id;
              else
                  $where_date = $this->cms->BRANCH_ID. "IN". BRANCHALL;
              $where[$this->cms->STATUS." !="] = DNW;
              $where[$this->cms->ORG_ID] = $org_id;
              $where[$this->cms->TO_ADVERSE] = NULL;
              if (isset($jodata->equp_id) && $jodata->equp_id != "" && $jodata->equp_id != null)
                  $where[$this->cms->EID] = $jodata->equp_id;
              if (isset($jodata->dept_id) && $jodata->dept_id != "" && $jodata->dept_id != null)
                  $where[$this->cms->CALLER_DEPT] = $jodata->dept_id;
              if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
              {
                  $where_date = "CONCAT_WS(' ',".$this->cms->CDATE.",".$this->cms->CTIME.") BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
              }
              $equp_dwn_tm= $this->basemodel->awesome_fetch($this->cms->tbl_name,$where,$where_date);
              //$data['qry'] = $this->db->last_query();
              if (!empty($equp_dwn_tm))
              {
                  $data['response'] = SUCCESSDATA;
                  for($i=0;$i<count($equp_dwn_tm);$i++)
                  {
                      $equp_dwn_tm[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $equp_dwn_tm[$i][$this->cms->EID]));
                      $equp_dwn_tm[$i]['cmpny_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->C_NAME, array($this->devices->E_ID => $equp_dwn_tm[$i][$this->cms->EID]));
                      $no_same_equpts=0;
                      $dev_where[$this->devices->C_NAME] = $equp_dwn_tm[$i]['cmpny_name'];
                      $dev_where[$this->devices->E_NAME] = $equp_dwn_tm[$i]['equp_name'];
                      $dev_where[$this->devices->BRANCH_ID] = $branch_id;
                      $dev_where[$this->devices->ORG_ID] = $org_id;
                      $dev_where[$this->devices->E_ID." !="] = NULL;
                      $dev_cnt = $this->basemodel->num_of_res($this->devices->tbl_name,$dev_where);
                      $no_same_equpts = $no_same_equpts+$dev_cnt;
                      if($equp_dwn_tm[$i][$this->cms->JOBCOMPLETED_DATE]!=NULL)
                      {
                          $dwntime=$this->basemodel->timeDifference($equp_dwn_tm[$i][$this->cms->CDATE].' '.$equp_dwn_tm[$i][$this->cms->CTIME],$equp_dwn_tm[$i][$this->cms->JOBCOMPLETED_DATE].' '.$equp_dwn_tm[$i][$this->cms->JOBCOMPLETED_TIME]);
                      }
                      else
                      {
                          $dwntime=$this->basemodel->timeDifference($equp_dwn_tm[$i][$this->cms->CDATE].' '.$equp_dwn_tm[$i][$this->cms->CTIME],date('Y-m-d H:i:s'));
                      }
                      $last_day= date("t", strtotime(date('Y-m-d H:i:s')));
                      /* count no of equipments based on equp_name,Cmny_name */
        //  $equp_dwn_tm[$i]['no_same_equpts'] = $no_same_equpts;
        /* count no of equipments based on equp_name,Cmny_name 
        $equp_dwn_tm[$i]['total_down_time']=round((($dwntime)/($last_day*$no_same_equpts))*100,2);
        if(is_numeric($equp_dwn_tm[$i]['cmpny_name']))
        {
            $equp_dwn_tm[$i]['cmpny_name']=$this->basemodel->get_single_column_value($this->devicevendors->tbl_name,$this->devicevendors->NAME,array($this->devicevendors->ID=> $equp_dwn_tm[$i]['cmpny_name']));
        }
        $data['total_down_time'][$i] = $equp_dwn_tm[$i]['total_down_time'];
        $data['equp_name'][$i]= $equp_dwn_tm[$i]['equp_name'];
    }
}
else
{
    $data['response'] = EMPTYDATA;
}
}
return $data;*/
    }
}
