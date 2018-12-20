<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BaseCtrl extends CI_Controller {
    public $shref = NULL;
    public $ha_content_type = NULL;
    public $true_href = NULL;
    public $ha_authorization = NULL;
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        //header('Content-Type: application/json');
        $this->load->library('baselibrary');
        $this->load->model('contactpersons');
        $this->load->model('basemodel');
        $this->load->model('contracttypes');
        $this->load->model('departments');
        $this->load->model('userdeprts');
        $this->load->model('userstatus');
        $this->load->model('utillvalues');
        $this->load->model('pmsdetails');
        $this->load->model('qcdetails');
        $this->load->model('equpconditions');
        $this->load->model('devices');
        $this->load->model('equpstatus');
        $this->load->model('calllogs');
        $this->load->model('baseauth');
        $this->load->model('tkn');
        $this->load->model('users');
        $this->load->model('deviceamcs');
        $this->load->model('trainingtypes');
        $this->load->model('trainingattends');
        $this->load->model('devicevendors');
        $this->load->model('rounds_assigned');
        $this->load->model('trainingby');
        $this->load->model('trainings');
        $this->load->model('branches');
        $this->load->model('cities');
		$this->load->model('departmentlabels');
		$this->load->model('organizations');
		//echo "dgdfg"; die();
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


            $jodata = json_decode($base_data);
            $action = $jodata->action;
            if($action=="get_hod_bmes_of_branch")
                $data = $this->_get_hod_bmes_data($jodata);
            if($action=="get_hod_bmes_of_branch_rounds")
                $data = $this->get_hod_bmes_of_branch_rounds($jodata);
            else if($action=="search_eids")
                $data = $this->_search_eids($jodata);
            else if($action=="get_dept_data")
                $data = $this->_load_departments($jodata);
            else if($action=="get_unit_dept_data")
                $data = $this->_load_unit_departments($jodata);
            else if($action=="get_trainingtypes")
                $data = $this->_get_trainingtypes_data($jodata);
            else if($action=="get_trainers_roles")
                $data = $this->_get_trainingby_data($jodata);
            else if($action=="get_conduct_training_data")
                $data = $this->_get_conduct_training_data($jodata);
            else if($action=="get_feedback_training_data")
                $data = $this->_get_feedback_training_data($jodata);
            else if($action=="get_request_training_data")
                $data = $this->_get_request_training_data($jodata);
            else if($action=="get_equipment_vendor_details")
                $data = $this->_get_equipment_vendor_details($jodata);
            else if($action=="get_user_sround_depts")
                $data = $this->_get_user_sround_depts($jodata);
            else if($action=="remaind_pending_round_hod")
                $data = $this->_remaind_pending_round_hod($jodata);
            else if($action=="get_feedbacks_of_my_ctraining")
                $data = $this->_get_feedbacks_of_my_ctraining($jodata);
            else if($action=="get_user_branches")
                $data = $this->_get_user_branches($jodata);
            else if($action=="get_city_names")
                $data = $this->_get_city_names($jodata);
            else if($action=="update_my_details")
                $data = $this->_update_my_details($jodata);
            else if($action=="update_my_password")
                $data = $this->_update_my_password($jodata);
            echo json_encode($data);
        }
    }
    private function _get_user_branches($jodata=array())
    {
        $data=array();
        if(!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            if(isset($jodata->user_id) && $jodata->user_id!='')
            {
                //$uwhere[$this->users->STATUS] = ACTIVESTS;
                $uwhere[$this->users->EMP_NO] = $jodata->user_id;
                $user_data = $this->basemodel->fetch_single_row($this->users->tbl_name,$uwhere);
              
                //$data['user_d'] = $this->db->last_query();
                if(!empty($user_data))
                {

                    if($user_data[$this->users->STATUS]=='')
                    {
                        $data['response'] = "inactive";
                        $data['call_back'] = "Your acccount is inactive, please contact admin...!";
                        return $data;
                    }
                    else
                    {
                        if($user_data[$this->users->ROLE_CODE]==HMADMIN)
                        {
                            $data['response'] = $user_data[$this->users->ROLE_CODE];
                            return $data;
                        }
                       else if($user_data[$this->users->ROLE_CODE]==VENDOR)
                       {
                           $data['response'] = $user_data[$this->users->ROLE_CODE];
                           return $data;
                       }

                        else if($user_data[$this->users->ROLE_CODE]==HA_ADMIN)
                        {
                            $data['response'] = $user_data[$this->users->ROLE_CODE];
                            return $data;
                        }
                        else if($user_data[$this->users->ROLE_CODE]==PURCHASE)
                        {
                            $data['response'] = $user_data[$this->users->ROLE_CODE];
                            return $data;
                        }
                        else
                        {
                            $data['response'] = SUCCESSDATA;
                            $branches = explode(",",$user_data[$this->users->ORG_BRANCH_ID]);
                            $branche_list = $this->basemodel->awesome_fetch($this->branches->tbl_name,'','',$branches,$this->branches->BRANCH_ID,'','',array($this->branches->BRANCH_ID,$this->branches->BRANCH_NAME));
                            if(empty($branche_list))
                            {
                                $data['response'] = EMPTYDATA;
                            }
                            else
                            {
                                $data['list'] = $branche_list;
								 array_unshift($data['list'],array('BRANCH_ID'=>'All','BRANCH_NAME'=>'All'));
                            }

                        }
                    }
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
        else
            $data['response'] = FAILEDATA;
        return $data;
    }
    private function _get_feedbacks_of_my_ctraining($jodata=array())
    {
        $data=array();
        if(!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $where[$this->trainingattends->TID] = $jodata->id;
            $where[$this->trainingattends->STATUS] = ACTIVESTS;
            $list = $this->basemodel->fetch_records_from($this->trainingattends->tbl_name,$where,'*',$this->trainingattends->ADDED_ON,'DESC');
            if(!empty($list))
            {
                for($i=0;$i<count($list);$i++)
                {
                    $list[$i]['EMP_NAME'] = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->USER_NAME,array($this->users->USER_ID=>$list[$i][$this->trainingattends->USER_NAME]));
                    if($list[$i][$this->trainingattends->STATUS]==ACTIVESTS)
                        $list[$i]['status'] = 'Accepted';
                    else if($list[$i][$this->trainingattends->STATUS]==INACTIVESTS)
                        $list[$i]['status'] = 'Declined';
                }
                $data['feedbacks'] = $list;
                $data['response'] = SUCCESSDATA;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
    private function _remaind_pending_round_hod($jodata=array())
    {
        $data=array();
        if(!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $training_data = $this->basemodel->fetch_single_row($this->trainings->tbl_name,array($this->trainings->ID=>$jodata->ID,$this->trainings->STATUS=>PENDING));
            if(!empty($training_data))
            {
                $training_data['USER_NAME'] = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->USER_NAME,array($this->users->USER_ID=>$training_data[$this->trainings->USERNAME]));;
                $notification="Approve Training Scheduled By ".$training_data['USER_NAME'].", Training By: ".$training_data[$this->trainings->TR_BY]." On ".date('Y-m-d h:i A',strtotime($training_data[$this->trainings->TR_DATE]." ".$training_data[$this->trainings->TR_TIME]));
                $data = $this->baselibrary->send_notification($training_data[$this->trainings->ORG_ID], $training_data[$this->trainings->BRANCH_ID], $notification,HBHOD);
                if($data['notification']=='sent')
                {
                    $data['response']= $data['notification_success']>0 ? SUCCESSDATA : FAILEDATA;
                    $data['call_back']= $data['notification_success']>0 ? 'notification sent' : 'notification not sent';
                }
                else
                {
                    $data['response']=FAILEDATA;
                    $data['call_back']='notification not sent';
                }
            }
            else
            {
                $data['response']=FAILEDATA;
                $data['call_back']='No Training Data Found';
            }
        }
        return $data;
    }
    private function _get_user_sround_depts($jodata=array())
    {
        $data = array();
        if(!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $rdepts_array = array();
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->rounds_assigned->BRANCH_ID]=$branch_id;
            $where[$this->rounds_assigned->ORG_ID]=$org_id;
            $where[$this->rounds_assigned->ASSIGNED_TO]=$user_id;
            $where[$this->rounds_assigned->STATUS]=PERMANENT;
            $pr_user_depts = $this->basemodel->fetch_single_row($this->rounds_assigned->tbl_name,$where,$this->rounds_assigned->DEPT_ID);
            if(!empty($pr_user_depts))
                $rdepts_array = explode(",",$pr_user_depts[$this->rounds_assigned->DEPT_ID]);
            $where[$this->rounds_assigned->STATUS]=TEMPORARY;
            $where[$this->rounds_assigned->ROUND_DATE]=date('Y-m-d');
            $tr_user_depts = $this->basemodel->fetch_single_row($this->rounds_assigned->tbl_name,$where,$this->rounds_assigned->DEPT_ID);
            if(!empty($tr_user_depts))
            {
                $trdepts_array = explode(",",$tr_user_depts[$this->rounds_assigned->DEPT_ID]);
                $rdepts_array=array_merge($rdepts_array,$trdepts_array);
            }
            $rdepts_array=array_unique($rdepts_array);
            if(!empty($rdepts_array))
                $rdepts1 = $this->basemodel->awesome_fetch($this->userdeprts->tbl_name, '', '', $rdepts_array, $this->userdeprts->CODE,'','');
            else
                $rdepts1 = $this->basemodel->fetch_records_from($this->userdeprts->tbl_name,'',$this->userdeprts->CODE);
            if (!empty($rdepts1))
            {
                $data['response'] = SUCCESSDATA;
                $data['list'] = $rdepts1;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
    private function _get_equipment_vendor_details($jodata=array())
    {
        $data = array();
        if(!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->deviceamcs->BRANCH_ID]=$branch_id;
            $where[$this->deviceamcs->ORG_ID]=$org_id;
            $where[$this->deviceamcs->EID]=$jodata->EID;
            $vendor = $this->basemodel->fetch_single_row($this->deviceamcs->tbl_name,$where,$this->deviceamcs->AMC_VENDOR);
            //print_r($vendor);
            if(!empty($vendor))
            {
                $vendor_dtls = $this->basemodel->fetch_single_row($this->devicevendors->tbl_name,array($this->devicevendors->ID=>$vendor[$this->deviceamcs->AMC_VENDOR]));
                if(!empty($vendor))
                {
                    $data['response'] = SUCCESSDATA;
                    $data['vendor'] = $vendor_dtls;
                }
                else
                {
                    $data['response'] = EMPTYDATA;
                }
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
    private function _search_eids($jodata=array())
    {
        $data = array();
        if(!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $like = array();
            if(!is_null($jodata->department) AND $jodata->department!="")
                $where[$this->devices->DEPT_ID] = $jodata->department;
            $like[$this->devices->E_ID] = $jodata->eq_key;
            $where[$this->devices->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->devices->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $eids = $this->basemodel->fetch_records_with_like($this->devices->tbl_name,$where,$like,$this->devices->E_ID);
            if(!empty($eids))
            {
                $data['response'] = SUCCESSDATA;
                $data['eids'] = $eids;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        return $data;
    }
    private function _get_hod_bmes_data($jodata=array())
    {
		
        $data = array();
        $or_where = '';
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        if(!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {

            $select = array($this->users->USER_NAME,$this->users->USER_ID);
            if(isset($jodata->org_id) && isset($jodata->branch_id))
            {
                $where[$this->users->ORG_ID] = $org_id;

                if($branch_id != 'All')
                    $where[$this->users->ORG_BRANCH_ID] = $branch_id;
                else
                    $or_where = $this->users->ORG_BRANCH_ID . " IN " . BRANCHALL;


            }
            else
            {
                $where[$this->users->ORG_ID] = $org_id;

                if($branch_id != 'All')
                 $where[$this->users->ORG_BRANCH_ID] = $branch_id;
                else
                    $or_where = $this->users->ORG_BRANCH_ID . " IN " . BRANCHALL;
            }

            if(isset($jodata->user_id))
                $where[$this->users->USER_ID." !="] = $jodata->user_id;
            $where_not_in = array(HBADMIN,HMADMIN,HBUSER);

            $users = $this->basemodel->fetch_records_from_multi_where_not_in($this->users->tbl_name,$where,$or_where,$this->users->ROLE_CODE,$where_not_in,$select);
         // return $this->db->last_query();
            $data['qry'] = $this->db->last_query();
            if(!empty($users))
            {
                $data['response'] = SUCCESSDATA;
                $data['users'] = $users;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        return $data;
    }
    private function get_hod_bmes_of_branch_rounds($jodata=array())
    {
        $data = array();
        if(!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $select = array($this->users->USER_NAME,$this->users->USER_ID);
            if(isset($jodata->org_id) && isset($jodata->branch_id))
            {
                $where[$this->users->ORG_ID] = $jodata->org_id;
                $where[$this->users->ORG_BRANCH_ID." LIKE"] = '%'.$jodata->branch_id.'%';
            }
            else
            {
                $where[$this->users->ORG_ID] = $this->session->org_id;
                $where[$this->users->ORG_BRANCH_ID." LIKE"] = "%".$this->session->branch_id."%";
            }
            if(isset($jodata->user_id))
                $where[$this->users->USER_ID." !="] = $jodata->user_id;
            $where_not_in = array(HBADMIN,HMADMIN,HBUSER);
            $users = $this->basemodel->fetch_records_from_where_not_in($this->users->tbl_name,$where,$this->rounds_assigned->ASSIGNED_TO,$where_not_in,$select);
            if(!empty($users))
            {
                $data['response'] = SUCCESSDATA;
                $data['users'] = $users;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        return $data;
    }
    public function loadContractsTypes()
    {

        $basedata = $this->security->xss_clean($this->input->raw_input_stream);
        if($basedata!="")
        {
            $jodata = json_decode($basedata);
            $action = $jodata->action;
            if($action=="get_contract_type")
            {

               // $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
              //  $where[$this->contracttypes->BRANCH_ID] =$branch_id;
                $data['list']=$this->basemodel->fetch_records_from($this->contracttypes->tbl_name);

                if(!empty($data['list']))
                {
                    $data['response'] = SUCCESSDATA;
                }
                else
                {
                    $data['response'] = EMPTYDATA;
                }
                $jdata = json_encode($data);
                echo $jdata;
            }
        }
    }
    public function loadPmsDetails()
    {
        $basedata = $this->security->xss_clean($this->input->raw_input_stream);
        if($basedata!="")
        {
            $jodata = json_decode($basedata);
            $action = $jodata->action;
            if($action=="get_pms_data")
            {
                $data['list']=$this->basemodel->fetch_records_from($this->pmsdetails->tbl_name);
                if(!empty($data['list']))
                {
                    $data['response'] = SUCCESSDATA;
                }
                else
                {
                    $data['response'] = EMPTYDATA;
                }
                $jdata = json_encode($data);
                echo $jdata;
            }
        }
    }
    public function loadQcsDetails()
    {
        $basedata = $this->security->xss_clean($this->input->raw_input_stream);
        if($basedata!="")
        {
            $jodata = json_decode($basedata);
            $action = $jodata->action;
            if($action=="get_qcs_data")
            {
                $data['list']=$this->basemodel->fetch_records_from($this->qcdetails->tbl_name);
                if(!empty($data['list']))
                {
                    $data['response'] = SUCCESSDATA;
                }
                else
                {
                    $data['response'] = EMPTYDATA;
                }
                $jdata = json_encode($data);
                echo $jdata;
            }
        }
    }
    private function _load_departments($jodata=array())
    {

        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {

            if(isset($jodata->all_depts))
            {
                if($jodata->all_depts==YESSTATE)
                {  
			        $bwhere[$this->userdeprts->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                   
					$dlist = $this->basemodel->fetch_records_from($this->userdeprts->tbl_name, $bwhere,'*',$this->userdeprts->ID);

                    for($i=0;$i<count($dlist);$i++)
                    {
                        if($dlist[$i]['USER_DEPT_NAME'] == '' || $dlist[$i]['USER_DEPT_NAME'] == null)
                            $dlist[$i]['USER_DEPT_NAME'] = $dlist[$i]['CODE'];
                    }
					$org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                 $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->departmentlabels->ORG_MODULE] = $org_type;
				$where[$this->departmentlabels->ORG_ID]  = $org_id;	
                $data['labels'] = $this->basemodel->fetch_records_from($this->departmentlabels->tbl_name,$where);				
                
                    $data['list'] = $dlist;
                }
                else
                {
                    $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
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

                    $where[$this->devices->ORG_ID]=$org_id;
                    $where[$this->devices->DEPT_ID." !="] = NULL;
                    $where[$this->devices->E_ID." !="] = NULL;
                    $where[$this->devices->STATUS] = ACT;
                    $where[$this->devices->EQ_CONDATION] = DW;
                    $list=$this->basemodel->fetch_distinct_records_multi_where($this->devices->tbl_name,$where,$or_where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');

                    for($i=0;$i<count($list);$i++)
                    {
                        $bwhere[$this->userdeprts->CODE]=$list[$i][$this->devices->DEPT_ID];
						$bwhere[$this->userdeprts->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                        $depts = $this->basemodel->fetch_single_row($this->userdeprts->tbl_name,$bwhere);
                        if(!empty($depts))
                        {
                            $dlist = '';
                            $dlist = $this->basemodel->fetch_single_row($this->userdeprts->tbl_name,$bwhere,'',$this->userdeprts->ID);
                            if($dlist['USER_DEPT_NAME'] == '' || $dlist['USER_DEPT_NAME'] == null)
                                $dlist['USER_DEPT_NAME'] = $dlist['CODE'];
                            $data['list'][]= $dlist;
                        }
                    }
                
				$org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                 $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->departmentlabels->ORG_MODULE] = $org_type;
				$where[$this->departmentlabels->ORG_ID]  = $org_id;	
				$dept = array($this->departmentlabels->USER_DEPT_NAME,$this->departmentlabels->CODE,$this->departmentlabels->STATUS,$this->departmentlabels->ACTION);
                $data['labels'] = $this->basemodel->fetch_records_from($this->departmentlabels->tbl_name,$where,$dept);
				
				
				}
				
								
            }
            else
            {
				$dwhere[$this->userdeprts->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                //return $dwhere;
				$data['list'] = $this->basemodel->fetch_records_from($this->userdeprts->tbl_name,$dwhere,'',$this->userdeprts->ID);
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                 $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->departmentlabels->ORG_MODULE] = $org_type;
				$where[$this->departmentlabels->ORG_ID]  = $org_id;	
				$dept = array($this->departmentlabels->USER_DEPT_NAME,$this->departmentlabels->CODE,$this->departmentlabels->STATUS,$this->departmentlabels->ACTION);
                $data['labels'] = $this->basemodel->fetch_records_from($this->departmentlabels->tbl_name,$where,$dept);				
				 
			}
            if (!empty($data['list']) || !empty($data['labels'])) {


                $data['response'] = SUCCESSDATA;
				
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
       //return $this->db->last_query();
        return $data;
    }
    private function _load_unit_departments($jodata=array())
    {

        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            if(isset($jodata->all_depts))
            {
                if($jodata->all_depts==YESSTATE)
                {
                    $data['list'] = $this->basemodel->fetch_records_from($this->userdeprts->tbl_name);
                }
                else
                {
                    $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                    $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
                    if($branch_id != 'All')
                        $where[$this->devices->BRANCH_ID]=$branch_id;
                    $where[$this->devices->ORG_ID]=$org_id;
                    $where[$this->devices->DEPT_ID." !="] = NULL;
                    $where[$this->devices->E_ID." !="] = NULL;
                    $where[$this->devices->STATUS] = ACT;
                    $where[$this->devices->EQ_CONDATION] = DW;
                    $list=$this->basemodel->fetch_distinct_records($this->devices->tbl_name,$where,$this->devices->DEPT_ID,$this->devices->DEPT_ID,'asc');
                    for($i=0;$i<count($list);$i++)
                    {
                        $bwhere[$this->userdeprts->CODE]=$list[$i][$this->devices->DEPT_ID];
                        $depts = $this->basemodel->fetch_single_row($this->userdeprts->tbl_name,$bwhere);
                        if(!empty($depts))
                        {
                            $data['list'][]=$this->basemodel->fetch_single_row($this->userdeprts->tbl_name,$bwhere);
                        }
                    }
                }
            }
            else
            {
                $data['list'] = $this->basemodel->fetch_records_from($this->userdeprts->tbl_name);
            }
            if (!empty($data['list'])) {
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }

        return $data;
    }
    private function _get_trainingtypes_data($jodata=array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->trainingtypes->tbl_name,array(),'','count('.$this->trainingtypes->ID.') AS CNT');
                if(!empty($cnt))
                {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT']/10);
                }
                else
                {
                    $data['no_of_recs'] = 0;
                    $data['cnt'] = 0;
                }
                $data['list'] = $this->basemodel->fetch_records_from_pagination($this->trainingtypes->tbl_name,'','*',$this->trainingtypes->TRAINING_TYPE,'ASC','10',$limit_val*10);
            }
            else
            {
                $data['list'] = $this->basemodel->fetch_records_from($this->trainingtypes->tbl_name);
            }
            if (!empty($data['list'])) {
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
    private function _get_conduct_training_data($jodata=array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $data = array();
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->trainings->USERNAME]=$user_id;
           // $where[$this->trainings->BRANCH_ID]=$branch_id;
			if($branch_id !='All') 
				$where[$this->trainings->BRANCH_ID]=$branch_id;
			else
				$where_date = $this->trainings->BRANCH_ID. "IN" .BRANCHALL;
			
            $where[$this->trainings->ORG_ID]=$org_id ;
            $where[$this->trainings->STATUS]=APPROVED;
            $where["concat_ws(' ',".$this->trainings->TR_DATE.",".$this->trainings->TR_TIME.") <="]=date('Y-M-d H:i:s');
            $where_date = "";
           if(isset($jodata->fromdate) && isset($jodata->todate))
            {
                if ($jodata->fromdate != "" && $jodata->todate != "")
                {
                    $where_date = $this->trainings->TR_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
                }
            }
            //$data['qry'] = $this->db->last_query();
            $data['list'] = $this->basemodel->fetch_records_from_multi_where($this->trainings->tbl_name,$where,$where_date,'*',$this->trainings->TR_DATE,'desc');
			//return $this->db->last_query();
            if (!empty($data['list']))
            {
                $data['list'] = $this->baselibrary->training_list($data['list']);
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
    private function _get_feedback_training_data($jodata=array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $data = array();
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->trainings->BRANCH_ID]=$branch_id;
            $where[$this->trainings->ORG_ID]=$org_id ;
            $where[$this->trainings->TR_COMP." !="]=NULL;
            $where_date = "";
            if(isset($jodata->fromdate) && isset($jodata->todate))
            {
                if ($jodata->fromdate != "" && $jodata->todate != "")
                    $where_date = $this->trainings->TR_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            }
            $data['list'] = $this->basemodel->fetch_records_from_multi_where($this->trainings->tbl_name,$where,$where_date,'*',$this->trainings->TR_DATE,'DESC');
            //$data['q']=$this->db->last_query();
            if (!empty($data['list']))
            {
                $data['list'] = $this->baselibrary->training_list($data['list'],'user_feedbacks',$user_id);
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
            ksort($data);
        }
        return $data;
    }
    private function _get_request_training_data($jodata=array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $data = array();
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->trainings->BRANCH_ID]=$branch_id;
            $where[$this->trainings->ORG_ID]=$org_id ;
            $where[$this->trainings->STATUS]=PENDING;
            $where[$this->trainings->TR_COMP] =NULL;
            $where_date = "";
            if(isset($jodata->fromdate) && isset($jodata->todate))
            {
                if ($jodata->fromdate != "" && $jodata->todate != "")
                    $where_date = $this->trainings->TR_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            }
            $list = $this->basemodel->fetch_records_from_multi_where($this->trainings->tbl_name,$where,$where_date,'*',$this->trainings->TR_DATE,'DESC');
            if (!empty($list))
            {
                for($i=0;$i<count($list);$i++)
                {
                    $data['list'] =$this->baselibrary->training_list($list);
                }
                //print_r($data['list']);
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
    private function _get_trainingby_data($jodata=array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $data['list'] = $this->basemodel->fetch_records_from($this->trainingby->tbl_name);
            if (!empty($data['list'])) {
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
    public function loadStatus()
    {
        $basedata = $this->security->xss_clean($this->input->raw_input_stream);
        if($basedata!="")
        {
            $jodata = json_decode($basedata);
            $action = $jodata->action;
            if($action=="get_status")
            {
                $data['list']=$this->basemodel->fetch_records_from($this->userstatus->tbl_name);
                if(!empty($data['list']))
                {
                    $data['response'] = SUCCESSDATA;
                }
                else
                {
                    $data['response'] = EMPTYDATA;
                }
                $jdata = json_encode($data);
                echo $jdata;
            }
        }
    }
    public function loadUtillization()
    {
        $basedata = $this->security->xss_clean($this->input->raw_input_stream);
        if($basedata!="")
        {
            $jodata = json_decode($basedata);
            $action = $jodata->action;
            if($action=="get_utilvalues")
            {
                $data['list']=$this->basemodel->fetch_records_from($this->utillvalues->tbl_name);
                if(!empty($data['list']))
                {
                    $data['response'] = SUCCESSDATA;
                }
                else
                {
                    $data['response'] = EMPTYDATA;
                }
                $jdata = json_encode($data);
                echo $jdata;
            }
        }
    }
    public function loadEupConditions()
    {
        $basedata = $this->security->xss_clean($this->input->raw_input_stream);
        if($basedata!="")
        {
            $jodata = json_decode($basedata);
            $action = $jodata->action;
            if($action=="get_equp_cond")
            {
                $data['list']=$this->basemodel->fetch_records_from($this->equpconditions->tbl_name);
                if(!empty($data['list']))
                {
                    $data['response'] = SUCCESSDATA;
                }
                else
                {
                    $data['response'] = EMPTYDATA;
                }
                $jdata = json_encode($data);
                echo $jdata;
            }
        }
    }
    public function getEqupDept()
    {
        $basedata = $this->security->xss_clean($this->input->raw_input_stream);
        if($basedata!="")
        {
            $jodata = json_decode($basedata);
            $action = $jodata->action;
            if($action=="get_equp_dept")
            {
                $response['list']=$this->basemodel->fetch_distinct_records($this->devices->tbl_name,'',$this->devices->DEPT_ID);
                if(!empty($response['list']))
                {
                    $response['response'][]=SUCCESSDATA;
                    for($i=0;$i<count($response['list']);$i++)
                    {
                        $response['list'][$i]['DEPT_NAME'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name,$this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $response['list'][$i][$this->devices->DEPT_ID]));
                    }
                }
                else
                {
                    $response['response'][]=EMPTYDATA;
                }
                $jdata = json_encode($response);
                echo $jdata;
            }
        }
    }
    public function geteids($eq_id="",$dept="",$branch="",$user_id="",$org_id="")
    {
		
        //echo "eid ".$eq_id."  branch ".$branch."  user_id  ".$user_id." dept ".$dept;
	
        $data = array();
        $like = array();
        if($dept!="ABCD")
            $where[$this->devices->DEPT_ID] = $dept;

        $or_where = '';
        if ($user_id != '' && $branch == 'All') {
            $uwher[$this->users->USER_ID] = $user_id;
            $branch = '';
            $branchs = $this->basemodel->fetch_single_row($this->users->tbl_name, $uwher, array($this->users->ORG_BRANCH_ID,$this->users->USER_ID));
            // echo $this->db->last_query(); die();
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
                //$bwhere[$this->branches->org_id] = $org_id;
                $branchs = $this->basemodel->fetch_records_from($this->branches->tbl_name,array($this->branches->STATUS=>ACTIVESTS,$this->branches->ORG_ID=>$org_id),$this->branches->BRANCH_ID);
                for($i = 0; $i < count($branchs); $i++)
                    $branch[$i] = "'".$branchs[$i]['BRANCH_ID']."'";
                $branch = '(' . implode($branch, ',') . ')';
            }
            $or_where = $this->devices->BRANCH_ID ." IN ".$branch;
        }
        else{
            $where[$this->devices->BRANCH_ID] = $branch;
        }
         $where[$this->devices->E_ID." !="] = NULL;
        if($eq_id!="ABCD")
        {
            $like[$this->devices->E_ID] = $eq_id;
            //$where[$this->devices->ORG_ID] = $this->session->org_id;
           // $where[$this->devices->ORG_ID] = 'ORG0000001';
        }
        $eids = $this->basemodel->fetch_records_from_multi_where_like($this->devices->tbl_name,$where,$or_where,$like,$this->devices->E_ID);
        
       //echo $this->db->last_query();
        //log_message('error',$this->db->last_query());
        if(!empty($eids))
        {
            $data['response'] = SUCCESSDATA;
            $data['eids'] = $eids;

        }
        else
            $data['response'] = EMPTYDATA;


        echo json_encode($data);
    }
    public function getvnames($vname)
    {
        $data = array();
        if($vname!="")
        {
            $vname = str_replace("%20"," ",$vname);
            $like = array();
            $like[$this->devicevendors->NAME] = $vname;
            $vnames = $this->basemodel->fetch_records_with_like($this->devicevendors->tbl_name,'',$like,array($this->devicevendors->NAME,$this->devicevendors->ID));
            if(!empty($vnames))
            {
                $data['response'] = SUCCESSDATA;
                $data['vnames'] = $vnames;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }
    public function getcpnames($cpname)
    {
        $data = array();
        if($cpname!="")
        {
            $cpname = str_replace("%20"," ",$cpname);
            $like = array();
            $like[$this->devicevendors->CP_NAME] = $cpname;
			
            $cpnames = $this->basemodel->fetch_records_with_like($this->devicevendors->tbl_name,'',$like,$this->devicevendors->CP_NAME);
			if(!empty($cpnames))
            {
                $data['response'] = SUCCESSDATA;
                $data['cpnames'] = $cpnames;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }
	
	
	public function get_assign_vendor_list($vendorname)
    {
		$data = array();
        if($vendorname!="")
        {
            $vendorname = str_replace("%20"," ",$vendorname);
            $like = array();
              $like[$this->organizations->ORG_NAME] = $vendorname;
           $where[$this->organizations->ORG_TYPE] = "Vendor";
           
            $vendornames = $this->basemodel->fetch_records_with_like($this->organizations->tbl_name,$where,$like,array($this->organizations->ORG_NAME,$this->organizations->ORG_ID));
			if(!empty($vendornames))
            {
                $data['response'] = SUCCESSDATA;
                $data['vendornames'] = $vendornames;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }
	
	
	public function getdistributerlist($vendorname)
    {
		
        $data = array();
        if($vendorname!="")
        {
            $vendorname = str_replace("%20"," ",$vendorname);
            $like = array();
			$like1 = array();
              $like[$this->organizations->ORG_NAME] = $vendorname;
			  $like1[$this->devicevendors->NAME] = $vendorname;
           $where[$this->organizations->ORG_TYPE] = "Vendor";
           $device_vendors = $this->basemodel->fetch_records_with_like($this->devicevendors->tbl_name,'',$like1,array($this->devicevendors->ID,$this->devicevendors->NAME));
		   
		   
		   $device_vendors1 = array();
		   
		   for($i=0; $i<count($device_vendors); $i++)
			   $device_vendors1[$i] = array("ORG_NAME1"=>$device_vendors[$i]['NAME'],"ORG_ID1"=>$device_vendors[$i]['ID']);
		   
	
		
            $vendornames = $this->basemodel->fetch_records_with_like($this->organizations->tbl_name,$where,$like,array($this->organizations->ORG_NAME,$this->organizations->ORG_ID));
			
			$vendornames1 = array();

                    for($i = 0; $i < count($vendornames); $i++)
                        $vendornames1[$i] = array("ORG_NAME1"=>$vendornames[$i]['ORG_NAME'],"ORG_ID1"=>$vendornames[$i]['ORG_ID']);
					
			
			$device_vendor = array_merge($vendornames1,$device_vendors1);
            if(!empty($device_vendor))
            {
                $data['response'] = SUCCESSDATA;
                $data['vendornames1'] = $device_vendor;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }
	public function get_assign_user_list($username)
    {
		
		

        $data = array();
        if($username!="")
        {
            $username = str_replace("%20"," ",$username);
            $like = array();
           
            $where[$this->users->ROLE_CODE."!="] = HMADMIN;
			 $where[$this->users->ORG_ID] =  $this->session->org_id;
            $where[$this->users->USER_ID. "!="] = $this->session->user_id;
            $like[$this->users->USER_NAME]= $username;
         
            $usernames = $this->basemodel->fetch_records_with_like($this->users->tbl_name,$where,$like,array($this->users->USER_NAME,$this->users->USER_ID));
           
          
            if(!empty($usernames))
            {
                $data['response'] = SUCCESSDATA;
                $data['usernames'] = $usernames;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }
	public function getdepartments($dep)
    {
        //return $dep;
        $data = array();
        if($dep!="")
        {
            $dep = str_replace("%20"," ",$dep);
            $like = array();
            $like[$this->userdeprts->USER_DEPT_NAME] = $dep;
            $department = $this->basemodel->fetch_records_with_like($this->userdeprts->tbl_name,'',$like,array($this->userdeprts->USER_DEPT_NAME,$this->userdeprts->CODE));
            //return $this->db->last_query();
            if(!empty($department))
            {
                $data['response'] = SUCCESSDATA;
                $data['department'] = $department;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }
    public function getequipmentcat($cat)
    {
        //return $dep;
        $data = array();
        if($cat!="")
        {
            $cat = str_replace("%20"," ",$cat);
            $like = array();
            $like[$this->devicenames->NAME] = $cat;
            $equp = $this->basemodel->fetch_records_with_like($this->devicenames->tbl_name,'',$like,array($this->devicenames->NAME,$this->devicenames->CODE,$this->devicenames->ID));
            //return $this->db->last_query();
			
			 $equp_array = array();

                    for($i = 0; $i < count($equp); $i++)
                        $equp_array[$i] = array("NAME1"=>$equp[$i]['NAME'],"CODE1"=>$equp[$i]['CODE'],"DID"=>$equp[$i]['ID']);

            if(!empty($equp_array))
            {
                $data['response'] = SUCCESSDATA;
                $data['ecat'] = $equp_array;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }

    public function getcompanynames($cat)
    {
        //return $dep;
        $data = array();
        if($cat!="")
        {
            $cat = str_replace("%20"," ",$cat);
            $like = array();
            $like[$this->devicevendors->NAME] = $cat;
            $like[$this->devicevendors->TYPE] = "OEM";
            $equp = $this->basemodel->fetch_records_with_like($this->devicevendors->tbl_name,'',$like,array($this->devicevendors->NAME,$this->devicevendors->ID));
            //echo $this->db->last_query();
			
			$equp_comp = array();
			
			for($i = 0; $i < count($equp); $i++)
                        $equp_comp[$i] = array("NAME"=>$equp[$i]['NAME'],"ID2"=>$equp[$i]['ID']);
				
            if(!empty($equp_comp))
            {
                $data['response'] = SUCCESSDATA;
                $data['cname'] = $equp_comp;
            }
            else
                $data['response'] = EMPTYDATA;
        }
		/*else{
			
			$like[$this->devicevendors->TYPE] = "OEM";
			$equp = $this->basemodel->fetch_records_with_like($this->devicevendors->tbl_name,'',$like,array($this->devicevendors->NAME,$this->devicevendors->ID));
		    
			$data['response'] = SUCCESSDATA;
			$data['cname'] = $equp;
		}*/
        echo json_encode($data);
    }
	
	/*public function  getorg_master_table($code)
	{
		$data = array();
		if($code!="")
		{
			$code = str_replace("%20"," ",$code);
			
		}
	}*/
	
 public function getEquipmentType($class)
    {

        //return $dep;
        $data = array();
        if($class!="")
        {
            $class = str_replace("%20"," ",$class);
            $like = array();
            $like[$this->equptypes->TYPE] = $class;
            $equp_class = $this->basemodel->fetch_records_with_like($this->equptypes->tbl_name,'',$like,array($this->equptypes->TYPE,$this->equptypes->CODE));
            //echo $this->db->last_query();
			 $equp_type = array();

                    for($i = 0; $i < count($equp_class); $i++)
                        $equp_type[$i] = array("TYPE"=>$equp_class[$i]['TYPE'],"CODE2"=>$equp_class[$i]['CODE']);

			
            if(!empty($equp_type))
            {
                $data['response'] = SUCCESSDATA;
                $data['etype'] = $equp_type;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }
	
	public function getEquipmentbybranch($str,$branch_id)
    {
       
       // echo $branch;
	   $data = array();
        if($str!="")
        {
            //$branch = str_replace("%20"," ",$branch);
            $like = array();
            $where = array();
            $select = array($this->devices->E_ID);
            $like[$this->devices->E_ID] = $str;
			if($branch_id!= 'All'){
            $where[$this->devices->BRANCH_ID] = $branch_id;
			}else{
			  $or_where = $this->devices->BRANCH_ID . " IN " . BRANCHALL;
			}
		    
            $where[$this->devices->E_ID. "!="] = NULL;
            $equipment = $this->basemodel->fetch_records_from_multi_where_like($this->devices->tbl_name,$where,$or_where,$like,$select);
          //echo $this->db->last_query();         
		 if(!empty($equipment))
            {
                $data['response'] = SUCCESSDATA;
                $data['eid'] = $equipment;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }
	
	public function getEquipmentbybranchdept($str,$branch,$dept)
    {
       
        
	   $data = array();
        if($str!="")
        {
            //$branch = str_replace("%20"," ",$branch);
            $like = array();
            $where = array();
            $select = array($this->devices->E_ID);
            $like[$this->devices->E_ID] = $str;
            $where[$this->devices->BRANCH_ID] = $branch;
			$where[$this->devices->DEPT_ID] = $dept;
            $where[$this->devices->E_ID. "!="] = NULL;
            $equipment = $this->basemodel->fetch_records_with_like($this->devices->tbl_name,$where,$like,$select);
          //  echo $this->db->last_query();
           //   die();
            if(!empty($equipment))
            {
                $data['response'] = SUCCESSDATA;
                $data['eid'] = $equipment;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }
	
	public function getequipmentnames($dep)
    {
        //return $dep;
        $data = array();
        if($dep!="")
        {
            $dep = str_replace("%20"," ",$dep);
            $like = array();
            $like[$this->devices->E_NAME] = $dep;
            $department = $this->basemodel->fetch_distinct_records_with_like($this->devices->tbl_name,"",$like,array($this->devices->E_NAME));
            //return $this->db->last_query();
            //$deprt = array_unique($department,SORT_REGULAR);
            if(!empty($department))
            {
                $data['response'] = SUCCESSDATA;
                $data['department'] = $department;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }
	
	public function getEquipmentbybranch1($str,$branch_id,$org_id)
    {
        $data = array();
        if($str!="")
        {
            //$branch = str_replace("%20"," ",$branch);
            $like = array();
            $where = array();
            $select = array($this->devices->E_ID);
            $like[$this->devices->E_ID] = $str;
            if($branch_id!= 'All'){
                $where[$this->devices->BRANCH_ID] = $branch_id;
            }else{
                //$or_where = $this->devices->BRANCH_ID . " IN " . BRANCHALL;
                $or_where = "";
            }
            $where[$this->devices->ORG_ID] = $org_id;
            $where[$this->devices->E_ID. "!="] = NULL;

            $equipment = $this->basemodel->fetch_records_from_multi_where_like($this->devices->tbl_name,$where,$or_where,$like,$select);

            if(!empty($equipment))
            {
                $data['response'] = SUCCESSDATA;
                $data['eid'] = $equipment;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }
 
    public function getSerialnobybranch($str,$branch)
    {
        $data = array();
        if($str!="")
        {
            //$branch = str_replace("%20"," ",$branch);
            $like = array();
            $where = array();
            $select = array($this->devices->ES_NUMBER);
            $like[$this->devices->ES_NUMBER] = $str;
            $where[$this->devices->BRANCH_ID] = $branch;
            $where[$this->devices->ES_NUMBER. "!="] = NULL;
            $equipment = $this->basemodel->fetch_records_with_like($this->devices->tbl_name,$where,$like,$select);

            if(!empty($equipment))
            {
                $data['response'] = SUCCESSDATA;
                $data['serial'] = $equipment;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        echo json_encode($data);
    }

	
	
	
    private function _get_city_names($jodata=array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $data['list'] = $this->basemodel->fetch_records_from($this->cities->tbl_name);
            if (!empty($data['list'])) {
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
    private function _update_my_details($jodata=array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $wuser[$this->users->USER_ID] = $jodata->USER_ID;
            $iuser[$this->users->USER_NAME] = $jodata->USER_NAME;
            $iuser[$this->users->EMAIL_ID] = $jodata->EMAIL_ID;
            $iuser[$this->users->MOBILE_NO] = $jodata->MOBILE_NO;
            if($this->basemodel->update_operation($iuser,$this->users->tbl_name,$wuser))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Your Details Updated Successfully...";
                $this->session->user_name = $jodata->USER_NAME;
                $this->session->email_id = $jodata->EMAIL_ID;
                $this->session->mobile_no = $jodata->MOBILE_NO;
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable to Update Your Details, Please try Again Later...";
            }
        }
        return $data;
    }
    private function _update_my_password($jodata=array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $current_password = $jodata->currentpswrd;
            $newpswrd = $jodata->newpswrd;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $hash_pass = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->PSWRD,array($this->users->USER_ID=>$user_id));
            if($hash_pass!='-' && $hash_pass!=null && $hash_pass!='')
            {
				if($this->bcrypt->check_password($current_password, $hash_pass))
                {
					$wudata[$this->users->USER_ID] = $user_id;
                    $iudata[$this->users->PSWRD] = $this->bcrypt->hash_password($newpswrd);
                    if($this->basemodel->update_operation($iudata,$this->users->tbl_name,$wudata))
                    {
						$data['response'] = SUCCESSDATA;
                        $data['call_back'] = "Password Updated Successfully...";
                    }
                    else
                    {
                        $data['response'] = FAILEDATA;
                        $data['call_back'] = "Unable to Change Password, Please try Again Later...";
                    }
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Current password was incorrect..!";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Invalid User..!";
            }
        }
        return $data;
    }
}
/* End of file BaseCtrl.php */
/* Location: ./application/controllers/BaseCtrl.php */