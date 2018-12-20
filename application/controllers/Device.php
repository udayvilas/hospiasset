<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Device extends CI_Controller
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
        $this->load->library('baselibrary');
        $this->load->model('contactpersons');
        $this->load->model('callmasters');
        $this->load->model('gatepass');
        $this->load->model('qceqcats');
        $this->load->model('basemodel');
        $this->load->model('organizations');
        $this->load->model('devices');
        $this->load->model('pmsdetails');
        $this->load->model('qcdetails');
        $this->load->model('cear');
        $this->load->model('viability');
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
		$this->load->model('devicenameslabels');
        $this->load->model('condemnation');
        $this->load->model('scheduledcallsdetails');
        $this->load->model('transfer');
        $this->load->model('stock');
		$this->load->model('modules');
		$this->load->model('equptypelabels');
		$this->load->model('devicelabels');
        $this->load->model('condemnationrequest');
        include APPPATH . 'libraries/simplexlsx_class.php';

        /*
                if(isset($this->session->user_id) )
                {
                    $uwher[$this->users->USER_ID] = $this->session->user_id;
                    $branchs = $this->basemodel->fetch_single_row($this->users->tbl_name,$uwher, $this->users->ORG_BRANCH_ID);
                    $branchs = explode(',',$branchs[$this->users->ORG_BRANCH_ID]);
                    $branch = array();
                    foreach($branchs as $x)
                        array_push($branch,"'".$x."'");
                    $branch = '('.implode($branch,',').')';
                }
                defined('BRANCHALL') OR define('BRANCHALL', $branch);
        */
    }

    public function index()
    {
        include_once APPPATH . 'libraries/HA_BKP/MainRest.php';
    }

    /* Dialogs Start Here*/
    public function call_generation_dailog()
    {
        $this->load->view('dialogs/call_generation_dialog');
    }
    public function add_stock()
    {
        $this->load->view('add_stock');
    }
    public function call_respond_dailog()
    {
        $this->load->view('dialogs/call_respond_dailog');
    }
    public function call_attend_dailog()
    {
        $this->load->view('dialogs/call_attend_dailog');
    }
    public function call_complete_assign()
    {
        $this->load->view('dialogs/call_complete_assign');
    }
    public function call_pending_dailog()
    {
        $this->load->view('dialogs/call_pending_dailog');
    }
    public function call_complete_dailog()
    {
        $this->load->view('dialogs/call_complete_dailog');
    }
    public function call_pending_assign()
    {
        $this->load->view('dialogs/call_pending_assign');
    }
    public function round_assign_dialog()
    {
        $this->load->view('dialogs/rounds_assign_dialog');
    }
    public function round_complete_dialog()
    {
        $this->load->view('dialogs/round_complete_dialog');
    }
    public function pendingpms_dailog()
    {
        $this->load->view('dialogs/multi_pendingpms_dailog');
    }
    public function pendingqc_dailog()
    {
        $this->load->view('dialogs/multi_pendingqc_dailog');
    }
    public function conduct_taining_dailog()
    {
        $this->load->view('dialogs/conduct_taining_dailog');
    }
    public function feedback_taining_dailog()
    {
        $this->load->view('dialogs/feedback_taining_dailog');
    }
    public function my_training_feedbacks()
    {
        $this->load->view('dialogs/my_training_feedbacks');
    }
    public function training_request_dailog()
    {
        $this->load->view('dialogs/training_request_dialog');
    }
    public function edit_equp_name_dialog()
    {
        $this->load->view('dialogs/edit_equp_name_dialog');
    }
    public function device_save_and_deploy()
    {
        $this->load->view('device_save_and_deploy');
    }
    public function deployment_devices()
    {
        $this->load->view('deployment_devices');
    }
    public function edit_mcontracts_dialog()
    {
        $this->load->view('dialogs/edit_mcontracts_dialog');
    }
    public function edit_renuval_type_dialog()
    {
        $this->load->view('dialogs/edit_renuval_type');
    }
    public function view_adverse_incedents_dialog()
    {
        $this->load->view('dialogs/view_adverse_incedents_dialog');
    }
    public function open_calls()
    {
        $this->load->view('open_calls');
    }
    private function _generate_id($val)
    {
        if (strlen($val) == 1) {
            $val = $val + 1;
            $valid = "0000" . $val;
        } else if (strlen($val) == 2) {
            $val = $val + 1;
            $valid = "000" . $val;
        } else if (strlen($val) == 3) {
            $val = $val + 1;
            $valid = "00" . $val;
        } else if (strlen($val) == 4) {
            $val = $val + 1;
            $valid = "0" . $val;
        } else {
            $valid = "00001";
        }
        return $valid;
    }
    public function word_print_labels()
    {
        if (isset($_POST['wdp']))


        {
            $data = array();
            $where = array();
            $jodata = json_decode($_POST['wdp']);
            $action = $jodata->action;
            if ($action == "word_print_labels") {
                $device_ids = json_decode($jodata->wrd_devices);
                if (!empty($device_ids))
                {
                    foreach ($device_ids as $device_id)
                    {
                        $where[$this->devices->ORG_ID] = $this->session->org_id;
                        $where[$this->devices->BRANCH_ID] = isset($jodata->branch) ? $jodata->branch : $this->session->branch_id;
                        $select = array($this->devices->E_NAME, $this->devices->E_ID, $this->devices->DEPT_ID, $this->devices->QR_CODE, $this->devices->ES_NUMBER, $this->devices->E_MODEL);
                        $where[$this->devices->E_ID] = $device_id;
                        $data['pdevices'][] = $this->basemodel->fetch_single_row($this->devices->tbl_name, $where, $select);

                    }
                    $this->load->view('word_print_devices', $data);
                }
            }
        }
    }
    public function word_print_labels_pms_qc()
    {
        if (isset($_POST['wdp']))
        {
            $data = array();
            $where = array();
            $jodata = json_decode($_POST['wdp']);
            $action = $jodata->action;
            if ($action == "word_print_labels_pms_qc")
            {
                $device_ids = json_decode($jodata->wrd_devices);
                if (!empty($device_ids))
                {
                    foreach ($device_ids as $device_id)
                    {
                        $where[$this->devices->ORG_ID] = $this->session->org_id;
                        $where[$this->devices->BRANCH_ID] = isset($jodata->branch) ? $jodata->branch : $this->session->branch_id;
                        $select = array($this->devices->E_NAME, $this->devices->E_ID, $this->devices->DEPT_ID, $this->devices->QR_CODE, $this->devices->ES_NUMBER, $this->devices->E_MODEL,$this->devices->BRANCH_ID, $this->devices->ORG_ID);
                        $where[$this->devices->E_ID] = $device_id;
                        $data['pdevices'][] = $this->basemodel->fetch_single_row($this->devices->tbl_name, $where, $select);
                    }
                    $this->load->view('word_print_devices_pms_qc', $data);
                }
            }
        }
    }

    public function import_asset_list()
    {
        if ($_FILES['assetlist']['size'] > 0)
        {
            $xlsx = new SimpleXLSX($_FILES['assetlist']['tmp_name']);
            list($cols,) = $xlsx->dimension();
            $totaldata = $xlsx->rows();
            //$totaldata= array_reverse($this->sort_device_array($totaldata));
            $counter = 0;
            foreach ($totaldata as $k => $r)
            {
                $check_dept_exists_for_round= false;
                $insert_device = array();
                $insert_device[$this->devices->ORG_ID] = $this->session->org_id;
                $insert_device[$this->devices->USERNAME] = $this->session->user_id;
                $insert_device[$this->devices->BRANCH_ID] = $this->session->branch_id;
                if ($r[0] != "" && is_numeric($r[0]))
                {
                    $edept_id = str_replace('  ', '', $r[9]);
                    $d_date_of_install = trim($r[6])!='' ? $this->basemodel->convertExcelDate(str_replace('  ', '', $r[12])) : NULL;
                    //log_message("error","DI:".$r[6].", CDI:".$d_date_of_install.", IID:".$r[3]);
                    $idevice_id = trim(str_replace('  ', '', $r[3]));
                    $idevice_id = preg_replace('/\s+/', '', $idevice_id); // remove spaces
                    $insert_device[$this->devices->IMPORT_EID] = $idevice_id;
                    $allow_insert = false;
                    if($d_date_of_install!=NULL)
                    {
                        $insert_device[$this->devices->DATEOF_INSTALL] = $d_date_of_install;
                        $allow_insert = true;
                    }
                    else if($idevice_id!='' && strtolower($idevice_id)!='x')
                    {
                        $explode_eid = explode("-",$idevice_id);
                        if(count($explode_eid)>2)
                        {
                            $install_dm = $explode_eid[2];
                            if(is_numeric($install_dm))
                            {
                                $install_dm_arr = str_split($install_dm, 2);
                                $insert_device[$this->devices->DATEOF_INSTALL] = date('Y-m-01',strtotime($install_dm_arr[1]."-".$install_dm_arr[0]."-01"));
                                $allow_insert = true;
                            }
                            else
                            {
                                $allow_insert = false;
                            }
                        }
                        else
                        {
                            $allow_insert = false;
                        }
                    }
                    else
                    {
                        $allow_insert = false;
                    }
                    if($insert_device[$this->devices->DATEOF_INSTALL]=="1970-01-01")
                    {
                        $insert_device[$this->devices->DATEOF_INSTALL] = NULL;
                        $allow_insert = false;
                    }
                    if($edept_id!='')
                    {
                        $srch_dept = $this->basemodel->fetch_single_row($this->userdeprts->tbl_name,array($this->userdeprts->CODE=>$edept_id));
                        if(empty($srch_dept))
                        {
                            $ins_dept = array();
                            $ins_dept[$this->userdeprts->CODE] = $edept_id;
                            $ins_dept[$this->userdeprts->USER_DEPT_NAME] = trim($r[23]);
                            $this->basemodel->insert_into_table($this->userdeprts->tbl_name,$ins_dept);
                        }
                        $insert_device[$this->devices->DEPT_ID] = $edept_id;
                    }

                    $ename = trim($r[1]);
                    if(trim($ename)!='')
                    {
                        $device_ename = $this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->NAME,array($this->devicenames->CODE=>$ename));
                        $insert_device[$this->devices->E_NAME] = $device_ename;
                        $ename_code = $this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->CODE,array($this->devicenames->CODE=>$ename));
                        $ename_id = $this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->ID,array($this->devicenames->NAME=>$ename));
                        $insert_device[$this->devices->E_CAT] = $ename_id;
                        if($ename_code=="-")
                        {
                            $ename1 = preg_replace('/\s+/', '', $ename); // remove spaces
                            $ename1 = preg_replace('/[^A-Za-z0-9]/', "", $ename1); // remove spe. char.
                            $ename_code = strtoupper(substr($ename1, 0, 3));
                            $insrt_device_names[$this->devicenames->NAME] = $ename;
                            $ename_code = $insrt_device_names[$this->devicenames->CODE] = $ename_code;
                            $this->basemodel->insert_into_table($this->devicenames->tbl_name,$insrt_device_names);
                            $insert_device[$this->devices->E_CAT] = $this->db->insert_id();
                        }
                    }
                    if($allow_insert)
                    {
                        $branch_dtls = $this->basemodel->fetch_single_row($this->branches->tbl_name, array($this->branches->BRANCH_ID => $this->session->branch_id));
                        $qry = "SELECT ".$this->devices->E_ID." FROM ".$this->db->dbprefix($this->devices->tbl_name)." WHERE ".$this->devices->ORG_ID." = '".$this->session->org_id."' AND ".$this->devices->E_ID." LIKE '".$branch_dtls[$this->branches->CITY]."-___-____-".$branch_dtls[$this->branches->BRANCH_CODE]."-%-___-____' ORDER BY Right(".$this->devices->E_ID.",4) DESC";
                        $devices = $this->basemodel->execute_qry($qry);
                        if(!empty($devices))
                        {
                            $devicenumbers = array();
                            for($i = 0; $i < count($devices); $i++)
                            {
                                $device = $devices[$i];
                                $eid=$device[$this->devices->E_ID];
                                $data['last_equp'] = $eid;
                                $number_array=explode("-",$eid);
                                array_push($devicenumbers,(int)end($number_array));
                            }
                            // given array. 3 and 6 are missing.
                            //$arr1 = array(1,2,4,5,7);
                            // construct a new array:1,2....max(given array).
                            $arr2 = range(1,max($devicenumbers));
                            // use array_diff to get the missing elements
                            $missing = array_diff($arr2,$devicenumbers); // (3,6)

                            if(count($missing) > 0)
                            {
                                reset($missing);  // to get first value
                                $number = (int)key($missing);
                            }
                            else{
                                $device = $devices[0];
                                $eid=$device[$this->devices->E_ID];
                                $data['last_equp'] = $eid;
                                $number_array=explode("-",$eid);
                                $number = end($number_array);
                                $number = (int)$number;
                                $number = $number+1;
                            }
                        }
                        else
                            $number=1;
                        $elast_id= sprintf('%04d',$number);

                        if($insert_device[$this->devices->DEPT_ID] != NULL)
                            $main_device_id =  $branch_dtls[$this->branches->CITY]."-"."BME"."-".date('my',strtotime($insert_device[$this->devices->DATEOF_INSTALL]))."-".$branch_dtls[$this->branches->BRANCH_CODE]."-".$insert_device[$this->devices->DEPT_ID]."-".$ename_code."-".$elast_id;
                        else
                            $main_device_id = NULL;

                        $main_device_id = ($main_device_id == '') ? NULL : $main_device_id;
                        $insert_device[$this->devices->E_ID] = str_replace(' ', '', $main_device_id);
                        $insert_device[$this->devices->END_OF_LIFE] = date('Y-m-d',(strtotime($insert_device[$this->devices->DATEOF_INSTALL]." + 15 years")));
                        $insert_device[$this->devices->END_OF_SUPPORT] = date('Y-m-d',(strtotime($insert_device[$this->devices->DATEOF_INSTALL]." + 10 years")));
                    }
                    else
                    {
                        $insert_device[$this->devices->E_ID] = NULL;
                    }

                    $oem_name = str_replace('  ', '', $r[11]);
                    if(trim($oem_name)!='')
                    {
                        $oem_id = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ID, array($this->devicevendors->NAME => $oem_name));
                        if ($oem_id != "-")
                        {
                            $insert_device[$this->devices->C_NAME] = $oem_id;
                        }
                        else
                        {
                            $insert_device[$this->devices->C_NAME] = $oem_name;
                        }
                    }
                    $insert_device[$this->devices->E_MODEL] = str_replace('  ', '', $r[5]);
                    $insert_device[$this->devices->ES_NUMBER] = str_replace('  ', '', $r[6]);
                    $ecost = trim(str_replace('  ', '', $r[13]));
                    if($ecost!='')
                    {
                        if(preg_match("/^[0-9,]+$/", $ecost))
                        {
                            $ecost = str_replace(',', '', $ecost);
                            $ecost = (int)$ecost;
                        }
                        if(is_numeric($ecost))
                            $insert_device[$this->devices->E_COST] = $ecost;
                        else
                            $insert_device[$this->devices->E_COST] = RENTAL;
                    }
                    $insert_device[$this->devices->E_COND] = "G";
                    $insert_device[$this->devices->PONO] = trim($r[10])!='' ? trim($r[10]) : NULL;
                    $insert_device[$this->devices->PDATE] = trim($r[11])!='' ? $this->basemodel->convertExcelDate(str_replace('  ', '', $r[11])) : NULL;

                    if($edept_id!='')
                    {
                        $dept_name = $this->basemodel->fetch_single_row($this->userdeprts->tbl_name,array($this->userdeprts->CODE=>$edept_id),$this->userdeprts->USER_DEPT_NAME);
                    }
                    else
                        $dept_name = '';

                    $insert_device[$this->devices->PHY_LOCATION] = trim($r[22])!='' ? str_replace('  ', '', $r[22]) : (($dept_name != '') ? $dept_name : NULL);
                    //$insert_device[$this->devices->UTILIZATION] = str_replace('  ', '', $r[19]);
                    //$insert_device[$this->devices->EQ_CLASS] = str_replace('  ', '', $r[20]);
                    $insert_device[$this->devices->REMARKS] = str_replace('  ', '', $r[15]);
                    $insert_device[$this->devices->ACCSSORIES] = str_replace('  ', '', $r[2]);
                    $amc_vendor = trim(str_replace('  ', '', $r[12]));
                    if($amc_vendor!='')
                    {
                        $amc_vendor_id  = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ID,array($this->devicevendors->NAME =>$amc_vendor));
                        if($amc_vendor_id!="-")
                        {
                            $insert_device[$this->devices->DISTRIBUTOR] = $amc_vendor_id;
                        }
                    }
                    else
                    {
                        if($oem_id != "-")
                        {
                            $amc_vendor_id = $oem_id;
                            $insert_device[$this->devices->DISTRIBUTOR] = $amc_vendor_id;
                        }
                    }
                    $insert_device[$this->devices->EQ_CONDATION] = DW;
                    if($insert_device[$this->devices->E_ID]!=NULL)
                    {
                        $insert_device[$this->devices->QR_CODE] = QR_URL . $insert_device[$this->devices->E_ID];
                        $insert_device[$this->devices->ORGINAL_ID] = $insert_device[$this->devices->E_ID];
                    }
                    $insert_device[$this->devices->BRANCH_RELOCATION] = "N";
                    $insert_device[$this->devices->FROM_OTHER_UNIT] = "N";
                    $check_dept_exists_for_round = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->DEPT_ID=>$insert_device[$this->devices->DEPT_ID],$this->devices->BRANCH_ID=>$this->session->branch_id,$this->devices->ORG_ID=>$this->session->org_id),$this->devices->DEPT_ID);
                    $insert_device[$this->devices->PHY_LOCATION]= $insert_device[$this->devices->DEPT_ID];
                    if($this->basemodel->insert_into_table($this->devices->tbl_name, $insert_device))
                    {
                        if(empty($check_dept_exists_for_round))
                        {
                            $response['users_rounds'] = $this->baselibrary->assign_round_new_dept($this->session->org_id,$this->session->branch_id,$insert_device[$this->devices->DEPT_ID]);
                        }
                        $device_insert = true;
                        if($insert_device[$this->devices->E_ID]==NULL)
                            $insert_device[$this->devices->E_ID] = $this->db->insert_id();
                        $response['device_response'][] = SUCCESSDATA;
                        $counter = $counter+1;
                    }
                    else
                    {
                        $device_insert = false;
                        $response['device_error'][] = $this->db->error();
                        $response['device_response'][] = FAILEDATA;
                    }
                    if ($device_insert)
                    {
                        //contract info
                        $amc_from =  trim($r[8])!='' ? $this->basemodel->convertExcelDate(str_replace('  ', '', $r[8])) : NULL;
                        $amc_to = $insert_amc[$this->deviceamcs->AMC_TO] = trim($r[9])!='' ? $this->basemodel->convertExcelDate(str_replace('  ', '', $r[9])) : NULL;
                        $amc_val = trim(str_replace('  ', '', $r[10]));
                        $amc_type = trim(str_replace('  ', '', $r[7]));
                        if(strtolower($amc_type)!="new" || strtolower($amc_type)!="no")
                        {
                            if(isset($insert_device[$this->devices->DISTRIBUTOR]))
                            {
                                $insert_amc[$this->deviceamcs->AMC_VENDOR] = $amc_vendor_id;
                                $insert_amc[$this->deviceamcs->ORG_ID] = $this->session->org_id;
                                $insert_amc[$this->deviceamcs->BRANCH_ID] = $this->session->branch_id;
                                $insert_amc[$this->deviceamcs->EID] = $insert_device[$this->devices->E_ID];
                                $insert_amc[$this->deviceamcs->AMC_TYPE] = $amc_type;
                                $if_warrenty = false;
                                if(strlen($amc_type)>2)
                                {
                                    $amc_type1 = strtolower(substr($amc_type, 0, 3));
                                    if($amc_type1=="war")
                                    {
                                        $if_warrenty = true;
                                    }
                                    else
                                    {
                                        $if_warrenty = false;
                                    }
                                }
                                else
                                {
                                    $amc_type1 = $amc_type;
                                    if(strtolower($amc_type1)=="w")
                                    {
                                        $if_warrenty = true;
                                    }
                                    else
                                    {
                                        $if_warrenty = false;
                                    }
                                }
                                if($if_warrenty)
                                {
                                    $amc_val = trim($r[10]);
                                    if(strpos($amc_val, 'year') !== false || strpos($amc_val, 'month') !== false)
                                    {
                                        $insert_amc[$this->deviceamcs->AMC_FROM] = $insert_device[$this->devices->DATEOF_INSTALL];
                                        $insert_amc[$this->deviceamcs->AMC_TO] = date('Y-m-d',strtotime(date("Y-m-d", strtotime($insert_amc[$this->deviceamcs->AMC_FROM])) . " + ".$amc_val));
                                        $insert_amc[$this->deviceamcs->AMC_VALUE] = trim($r[10]);
                                    }
                                    else
                                    {
                                        $insert_amc[$this->deviceamcs->AMC_VALUE] = $amc_val;
                                        $insert_amc[$this->deviceamcs->AMC_FROM] = NULL;
                                        $insert_amc[$this->deviceamcs->AMC_TO] = NULL;
                                    }
                                }
                                else
                                {
                                    if($insert_amc[$this->deviceamcs->AMC_TYPE]=="Biomedical")
                                    {
                                        $amc_from = $r[8]=="Biomedical" ? "Biomedical" : $amc_from;
                                        $amc_to = $r[9]=="Biomedical" ? "Biomedical" : $amc_to;
                                    }
                                    $insert_amc[$this->deviceamcs->AMC_FROM] = $amc_from;
                                    $insert_amc[$this->deviceamcs->AMC_TO] = $amc_to;
                                    $insert_amc[$this->deviceamcs->AMC_VALUE] = $amc_val!='' ? $amc_val : NULL;

                                }
                                $insert_amc[$this->deviceamcs->ADDED_ON] = date('Y-m-d');
                                $insert_amc[$this->deviceamcs->ADDED_BY] = $insert_device[$this->devices->USERNAME];
                                $this->basemodel->insert_into_table($this->deviceamcs->tbl_name,$insert_amc);

                                $insert_status[$this->equpstatus->EID] = $insert_device[$this->devices->E_ID];
                                $insert_status[$this->equpstatus->COMPANY] = isset($insert_device[$this->devices->C_NAME]) ? $insert_device[$this->devices->C_NAME] : NULL;
                                $insert_status[$this->equpstatus->STATUS] = DW;
                                $date = date('Y-m-d H:i:s');
                                $insert_status[$this->equpstatus->DATE_UPDATE_ON] = $date;
                                $response['status_response'][] = $this->baselibrary->equipment_status_tbl_insert($insert_status[$this->equpstatus->EID],$insert_status[$this->equpstatus->COMPANY], $insert_status[$this->equpstatus->STATUS],$insert_status[$this->equpstatus->DATE_UPDATE_ON]);
                            }
                        }
                        //PMS Calculations:
                        $insert_pms[$this->pmsdetails->PMS_COUNT] = $no_of_pms = 4;
                        $doi = $insert_device[$this->devices->DATEOF_INSTALL];
                        $pms_max_val = $this->basemodel->select_max_val($this->pmsdetails->tbl_name, $this->pmsdetails->ID);
                        $pms_max_val = $pms_max_val + 1;
                        if ($amc_type != '') {
                            $amcval = $amc_type[0];
                        } else {
                            $amcval = 'N';
                        }
                        $insert_pms[$this->pmsdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $amcval . "P-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($pms_max_val);
                        $insert_pms[$this->pmsdetails->ORG_ID] = $this->session->org_id;
                        $insert_pms[$this->pmsdetails->EID] = $insert_device[$this->devices->E_ID];
                        $insert_pms[$this->pmsdetails->BRANCH_ID] = $this->session->branch_id;
                        $pms_start = trim($r[13])!='' ? $this->basemodel->convertExcelDate(str_replace('  ', '', $r[13])) : NULL;
                        $pms_end = trim($r[14])!='' ? $this->basemodel->convertExcelDate(str_replace('  ', '', $r[14])) : NULL;
                        if($pms_end!=NULL && $this->baselibrary->validateDate($pms_end) && strtotime($pms_end)>strtotime(date('Y-m-d')))
                        {
                            $insert_pms[$this->pmsdetails->PMS_DONE] = $pms_start;
                            $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                        }
                        else
                        {
                            if(($doi!=NULL && $doi!='') || $pms_start!=NULL && $pms_start!='')
                            {
                                $pmsdue = NULL;
                                if($pms_start!=NULL && $pms_start!='')
                                {
                                    $insert_pms[$this->pmsdetails->PMS_DONE] = $pms_start;
                                }
                                else
                                {
                                    $insert_pms[$this->pmsdetails->PMS_DONE] = $this->baselibrary->datediff($doi, 'months');
                                }
                                $pmsval = 30 * (12 / $no_of_pms);
                                $pmsdue = date('Y-m-d', strtotime($insert_pms[$this->pmsdetails->PMS_DONE] . " + $pmsval days"));
                                $pmsdue_strtotime = strtotime($pmsdue);
                                if($pmsdue_strtotime>=strtotime(date('Y-m-d')))
                                {
                                    $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                                }
                                else
                                {
                                    $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = date("Y-m-d", strtotime("+1 month",strtotime(date('Y-m-d'))));
                                }
                            }
                        }
                        if ($this->basemodel->insert_into_table($this->pmsdetails->tbl_name, $insert_pms))
                        {
                            /* $pms_insert=true; */
                            $response['pms_response'][] = SUCCESSDATA;
                        }
                        else
                        {
                            $response['pms_response'][] = FAILEDATA;
                        }

                        // Calibration:
                        if($doi!=NULL && $doi!='')
                        {
                            if(trim(strtolower($r[15]))!='not required' || trim(strtolower($r[15]))!='NEW')
                            {
                                $qccount = 1;
                                $qcdue = NULL;
                                $qc_max_val = $this->basemodel->select_max_val($this->qcdetails->tbl_name,$this->qcdetails->ID);
                                $qc_max_val = $qc_max_val+1;
                                $insert_qc[$this->qcdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE]."-JQ-".date('my')."-".$this->baselibrary->getpmsqc_id($qc_max_val);
                                $insert_qc[$this->qcdetails->QC_COUNT] = $qccount;
                                $qcval = 365*(1 / $qccount);
                                $qcdue = date('Y-m-d', strtotime($insert_qc[$this->qcdetails->QC_DONE]. " + $qcval days"));
                                $insert_qc[$this->qcdetails->QC_COUNT_TYPE] = 'Year';
                                $insert_qc[$this->qcdetails->ORG_ID] = $this->session->org_id;
                                $insert_qc[$this->qcdetails->EID] = $insert_device[$this->devices->E_ID];
                                $insert_qc[$this->qcdetails->BRANCH_ID] = $this->session->branch_id;
                                $qc_start = trim($r[13])!='' ? $this->basemodel->convertExcelDate(str_replace('  ', '', $r[15])) : NULL;
                                $qc_end = trim($r[14])!='' ? $this->basemodel->convertExcelDate(str_replace('  ', '', $r[16])) : NULL;
                                if($qc_end!=NULL && $this->baselibrary->validateDate($qc_end) && strtotime($pms_end)>strtotime(date('Y-m-d')))
                                {
                                    $insert_pms[$this->pmsdetails->PMS_DONE] = $qc_start;
                                    $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $qc_end;
                                }
                                else
                                {
                                    $insert_qc[$this->qcdetails->QC_DONE] = $this->baselibrary->datediff($doi,'years');
                                    $qcdue_strtotime = strtotime($qcdue);
                                    if($qcdue_strtotime>=strtotime(date('Y-m-d')))
                                    {
                                        $insert_qc[$this->qcdetails->QC_DUE] = $qcdue;
                                    }
                                    else
                                    {
                                        $insert_qc[$this->qcdetails->QC_DUE] = date("Y-m-d", strtotime("+1 month",strtotime(date('Y-m-d'))));
                                    }
                                }
                                if($this->basemodel->insert_into_table($this->qcdetails->tbl_name, $insert_qc))
                                {
                                    $qc_insert = true;
                                    $response['qc_response'][] = SUCCESSDATA;
                                }
                                else
                                {
                                    $response['qc_response'][] = FAILEDATA;
                                }
                            }
                        }
                    }
                }
                if ($counter == 1)
                {
                    $date = date('Y-m-d H:i:s');
                    $curenttime = date('H:i:s');
                    $curentdate = date('Y-m-d');
                    $desc = "Asset list Imported from Excel file ". $this->session->user_name;
                    $response['calllog_response'][] = $this->baselibrary->insert_calllog($this->session->user_id,$desc,$curentdate,$curenttime,$date,$this->session->org_id,$this->session->branch_id);
                }
            }
            $f_type = explode(".",$_FILES['assetlist']['name']);
            $last_in = (count($f_type)-1);
            $config['upload_path'] = ASSETS_UPLOAD_PATH;
            $config['allowed_types'] = '*';
            $time=date('Y_m_d_H_i_s');
            $config['file_name'] = $f_type[0]."_".$time;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if($this->upload->do_upload('assetlist'))
            {
                $response['sheet_uploaded'] = SUCCESSDATA;
            }
            else
            {
                $response['sheet_uploaded'] = FAILEDATA;
                $response['sheet_upload_errors'] = $this->upload->display_errors();
            }
            print_r(json_encode($response));
        }
    }



    public function save_device($input=array())
    {

        $data = $response = array();
        if (count((array)$input) > 0) {
            $device_limit_check = $this->_get_org_devices_cnt($input);
        }
        else if (isset($_POST['device_data'])) {
            $input = json_decode($_POST['device_data']);
            $device_limit_check = $this->_get_org_devices_cnt($input);
        }


        if ($device_limit_check['od_cnt'] < $device_limit_check['od_value']) {
            if (isset($_POST['device_data']) || count((array)$input) > 0) {
                $device_insert = false;
                $pms_insert = false;
                $qc_insert = false;

                if (count((array)$input) == 0)
                    $input = json_decode($_POST['device_data']);

                /* if (isset($input->manufacture_date)) {

                     $manufacture_date1 = $input->manufacture_date;
                     $manf_date = explode("-", $manufacture_date1);
                     if ($manf_date[0] > 12 || $manf_date[1] > date('Y')) {
                         $data['device_response'] = FAILEDATA;
                         $data['call_back'] = "Invalid Manufacture Date";
                         print_r(json_encode($data));
                         return $data;
                     }
                 } else {
                     $manufacture_date1 = NULL;
                 }*/
                if (isset($input->end_of_life)) {
                    $eol = $input->end_of_life;
                    $eol_ary = explode("-", $eol);
                    if ($eol_ary[0] > 12) {
                        $data['device_response'] = FAILEDATA;
                        $data['call_back'] = "Invalid End of Life Date";
                        print_r(json_encode($data));
                        return $data;
                    }
                } else {
                    $eol = NULL;
                }
                if (isset($input->end_of_support)) {
                    $eos = $input->end_of_support;
                    $eos_ary = explode("-", $eos);
                    if ($eos_ary[0] > 12) {
                        $data['device_response'] = FAILEDATA;
                        $data['call_back'] = "Invalid End of Support Date";
                        print_r(json_encode($data));
                        return $data;
                    }
                } else {
                    $eos = NULL;
                }
                //print_r(date('m-Y', strtotime($input->manufacture_date)));
                $insert_device[$this->devices->MF_DATE] = date('m-Y', strtotime($input->manufacture_date));
                $insert_device[$this->devices->END_OF_LIFE] = $eol;
                $insert_device[$this->devices->END_OF_SUPPORT] = $eos;
                $insert_device[$this->devices->MF_DATE];

                $insert_device[$this->devices->DEPT_ID] = $input->department;
                $insert_device[$this->devices->VENDOR] = $input->vendor;
                $insert_device[$this->devices->GENERAL_ASSET] = NOSTATE;
                $podate1 = isset($input->po_date) ? date('Y-m-d', strtotime($input->po_date)) : NULL;

                $pmsdate = isset($input->pms_date) ? date('Y-m-d', strtotime($input->pms_date)) : NULL;
                $qcdate = isset($input->qc_date) ? date('Y-m-d', strtotime($input->qc_date)) : NULL;

                $insert_device[$this->devices->HOSPITAL_ASSET_CODE] = isset($input->asset_code) ? $input->asset_code : NULL;
                if (isset($input->date_of_install)) {
                    $date_of_install1 = date('Y-m-d', strtotime($input->date_of_install));
                    $insert_device[$this->devices->DATEOF_INSTALL] = $date_of_install1;
                }

                if (isset($input->grn_date) && $input->grn_date != '')
                    $insert_device[$this->devices->GRN_DATE] = date('Y-m-d', strtotime($input->grn_date));

                if (isset($input->grn_no) && $input->grn_no != '')
                    $insert_device[$this->devices->GRN_VALUE] = $input->grn_no;

                /* contract */

                if (isset($input->contract_from_date) && $input->contract_from_date != null)
                    $insert_amc[$this->deviceamcs->AMC_FROM] = date('Y-m-d', strtotime($input->contract_from_date));
                if (isset($input->contract_to_date) && $input->contract_to_date != null)
                    $insert_amc[$this->deviceamcs->AMC_TO] = date('Y-m-d', strtotime($input->contract_to_date));
                $insert_amc[$this->deviceamcs->AMC_TYPE] = $input->contract_type;
                $insert_amc[$this->deviceamcs->AMC_VALUE] = isset($input->contract_value) ? $input->contract_value : NULL;
                $insert_amc[$this->deviceamcs->AMC_VENDOR] = isset($input->vendor) ? $input->vendor : NULL;

                /* breakdown */
                if (isset($input->last_breakdown_date)) {
                    $insrt_bd[$this->dbrkdwns->BD_DATETIME] = date('Y-m-d', strtotime($input->last_breakdown_date));
                    $insrt_bd[$this->dbrkdwns->BD_COST] = $input->break_down_cost;
                    $insrt_bd[$this->devices->LB_DATE] = date('Y-m-d', strtotime($input->last_breakdown_date));
                    $insert_device[$this->devices->BD_COST] = $input->break_down_cost;
                    $insert_device[$this->devices->BD_COUNT] = $input->break_down_count;
                }

            }

            $branch_id = isset($input->branch_id) ? $input->branch_id : $this->session->branch_id;
            $org_id = isset($input->org_id) ? $input->org_id : $this->session->org_id;

            $insert_device[$this->devices->PDATE] = $podate1;
            $insert_device[$this->devices->DISTRIBUTOR] = $input->distributor;

            $insert_device[$this->devices->ORG_ID] = $org_id;

            //  echo $insert_device->$this->devices->ORG_ID;

            // $insert_device[$this->devices->USERNAME] = $this->session->user_id;
            $insert_device[$this->devices->BRANCH_ID] = $branch_id;

            $insert_device[$this->devices->USERNAME] = $this->session->user_id;
            $insert_device[$this->devices->E_COND] = $input->present_condition;
            $insert_device[$this->devices->DESC_P] = $input->description;
            $insert_device[$this->devices->EQ_CLASS] = $input->device_class;

            $insert_device[$this->devices->C_NAME] = $input->company_name;

            $insert_device[$this->devices->E_NAME] = $input->device_name;
            $insert_device[$this->devices->E_CAT] = $input->cat;
            $cat = $this->basemodel->get_single_column_value($this->devicenames->tbl_name, $this->devicenames->CODE, array($this->devicenames->ID => $insert_device[$this->devices->E_CAT]));
            $insert_device[$this->devices->E_COST] = $input->device_cost;
            $insert_device[$this->devices->E_TYPE] = $input->equp_type;
            $insert_device[$this->devices->E_MODEL] = $input->device_model;
            $insert_device[$this->devices->ACCSSORIES] = $input->accessories;
            $insert_device[$this->devices->CRITICAL_SPARES] = $input->critical_spares;
            if (isset($input->phy_location) && $input->phy_location != '')
                $insert_device[$this->devices->PHY_LOCATION] = $input->phy_location;
            $insert_device[$this->devices->PONO] = $input->po_number;
            $insert_device[$this->devices->REMARKS] = $input->device_remarks;
            $insert_device[$this->devices->ES_NUMBER] = $input->serial_number;
            $insert_device[$this->devices->EQ_CONDATION] = $input->device_status;
            $insert_device[$this->devices->UTILIZATION] = $input->utilization;

            /* device Id gen. */
            $branch_dtls = $this->basemodel->fetch_single_row($this->branches->tbl_name, array($this->branches->BRANCH_ID => $branch_id));
            $qry = "SELECT " . $this->devices->E_ID . " FROM " . $this->db->dbprefix($this->devices->tbl_name) . " WHERE " .
                $this->devices->ORG_ID . " = '" . $org_id . "' AND " . $this->devices->E_ID . " LIKE '" .
                $branch_dtls[$this->branches->CITY] . "-___-____-" . $branch_dtls[$this->branches->BRANCH_CODE] .
                "-%-___-____' ORDER BY Right(" . $this->devices->E_ID . ",4) DESC";


            /* if(!empty($devices))
             {

                 $devicenumbers = array();
                 for($i = 0; $i < count($devices); $i++)
                 {

                     $device = $devices[$i];
                     $eid=$device[$this->devices->E_ID];
                     $data['last_equp'] = $eid;
                     $number_array=explode("-",$eid);
                     array_push($devicenumbers,(int)end($number_array));
                 }
                 // given array. 3 and 6 are missing.
                 //$arr1 = array(1,2,4,5,7);
                 // construct a new array:1,2....max(given array).
                 $arr2 = range(1,max($devicenumbers));
                 // use array_diff to get the missing elements
                 $missing = array_diff($arr2,$devicenumbers); // (3,6)

                 if(count($missing) > 0)
                 {
                     reset($missing);  // to get first value
                     $number = (int)key($missing);
                 }
                 else{
                     $device = $devices[0];
                     $eid=$device[$this->devices->E_ID];
                     $data['last_equp'] = $eid;
                     $number_array=explode("-",$eid);
                     $number = end($number_array);
                     $number = (int)$number;
                     $number = $number+1;
                 }
             }*/
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
                // given array. 3 and 6 are missing.
                //$arr1 = array(1,2,4,5,7);
                // construct a new array:1,2....max(given array).
                $arr2 = range(1, max($devicenumbers));
                // use array_diff to get the missing elements
                $missing = array_diff($arr2, $devicenumbers); // (3,6)

                if (count($missing) < 0) {

                    reset($missing);  // to get first value
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
            // $org_type = isset($input->org_type) ? $input->org_type : $this->session->org_type;
            $user_name = isset($input->user_name) ? $input->user_name : $this->session->user_name;
            //   if($org_type != Vendor) {

            $main_device_id = $branch_dtls[$this->branches->CITY] . "-" . "BME" . "-" . date('my', strtotime($insert_device[$this->devices->DATEOF_INSTALL])) . "-" . $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_device[$this->devices->DEPT_ID] . "-" . $cat . "-" . $elast_id;
            $insert_device[$this->devices->E_ID] = $main_device_id;
            $insert_device[$this->devices->USERNAME] = $user_name;
            //    $insert_device[$this->devices->H_ID] = $main_device_id;
            $insert_device[$this->devices->QR_CODE] = QR_URL . $insert_device[$this->devices->E_ID];
            //echo   $insert_devcice[$this->devices->H_ID];
            // die();

            //}
            // else {

            //   $main_device_id = $branch_dtls[$this->branches->CITY] . "-" . "BME" . "-" . date('my', strtotime($insert_device[$this->devices->DATEOF_INSTALL])) . "-" . $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_device[$this->devices->DEPT_ID] . "-" . $cat . "-" . $elast_id;
            //  $insert_device[$this->devices->ASSIGN_ID] = $main_device_id;
            //  $insert_device[$this->devices->E_ID] = $main_device_id;
            //  $insert_device[$this->devices->QR_CODE] = QR_URL . $insert_device[$this->devices->ASSIGN_ID];
            //  }

            /* Device Id Gen. End */
            $check_dept_exists_for_round = $this->basemodel->fetch_single_row($this->devices->tbl_name, array($this->devices->DEPT_ID => $input->department, $this->devices->BRANCH_ID => $branch_id, $this->devices->ORG_ID => $org_id), $this->devices->DEPT_ID);
            // $this->basemodel->insert_into_table($this->devices->tbl_name, $insert_device);

            if ($this->basemodel->insert_into_table($this->devices->tbl_name, $insert_device)) {
                $device_id = $main_device_id;
                $device_insert = true;
                $response['device_id'] = $device_id;
                $response['device_response'] = SUCCESSDATA;
                if (empty($check_dept_exists_for_round)) {
                    $response['users_rounds'] = $this->baselibrary->assign_round_new_dept($this->session->org_id, $branch_id, $input->department);
                }
                $response['call_back'] = $response['device_id'] . " Equipment Details Saved";
                //$sess_org = isset($device_data->orgid) ? $device_data->orgid : $this->session->org_id;
                /*   if($device_data->ORG_ID != $org_id) // new org != current org
                   {

                   }*/

                // assign -> update current eqid with current (org + branch) + generate neweqpid with selected (org + branch) ->
                // update new eqid with exeing eqid at assign column

            } else {
                $device_insert = false;
                $response['device_response'] = FAILEDATA;
                $response['call_back'] = "Unable to Process Your Request Try again";
            }

            if ($device_insert) {

                /* insert device breakdown table */
                if (isset($input->last_breakdown_date)) {
                    $insrt_bd[$this->dbrkdwns->ORG_ID] = $insert_device[$this->devices->ORG_ID];
                    $insrt_bd[$this->dbrkdwns->BRANCH_ID] = $insert_device[$this->devices->BRANCH_ID];
                    $insrt_bd[$this->dbrkdwns->EID] = $device_id;
                    $insrt_bd[$this->dbrkdwns->ADDED_BY] = $insert_device[$this->devices->USERNAME];
                    $insrt_bd[$this->dbrkdwns->ADDED_ON] = date('Y-m-d H:i:s');
                    $this->basemodel->insert_into_table($this->dbrkdwns->tbl_name, $insrt_bd);
                }
                /* insert amc table */
                $insert_amc[$this->deviceamcs->ORG_ID] = $insert_device[$this->devices->ORG_ID];
                $insert_amc[$this->deviceamcs->BRANCH_ID] = $insert_device[$this->devices->BRANCH_ID];
                $insert_amc[$this->deviceamcs->EID] = $device_id;
                $insert_amc[$this->deviceamcs->ADDED_BY] = $insert_device[$this->devices->USERNAME];
                $insert_amc[$this->deviceamcs->ADDED_ON] = date('Y-m-d H:i:s');
                $this->basemodel->insert_into_table($this->deviceamcs->tbl_name, $insert_amc);

                //if ($insert_device[$this->devices->GENERAL_ASSET] == YESSTATE) {
                /* insert pms */
                $pmsval = 30 * (12 / $input->no_of_pms);
                if ($pmsdate != '') {
                    $pmsdue = date('Y-m-d', strtotime($pmsdate . " + $pmsval days"));
                    $insert_pms[$this->pmsdetails->PMS_COUNT] = $input->no_of_pms;
                    $insert_pms[$this->pmsdetails->ORG_ID] = $org_id;
                    $insert_pms[$this->pmsdetails->EID] = $device_id;
                    $insert_pms[$this->pmsdetails->BRANCH_ID] = isset($input->branch_id) ? $input->branch_id : $this->session->branch_id;
                    $insert_pms[$this->pmsdetails->PMS_DONE] = $pmsdate;
                    $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                    $insert_pms[$this->pmsdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_amc[$this->deviceamcs->AMC_TYPE][0] . "P-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->pmsdetails->tbl_name, $this->pmsdetails->ID));
                    if ($this->basemodel->insert_into_table($this->pmsdetails->tbl_name, $insert_pms)) {
                        $pms_insert = true;
                        $response['pms_response'] = SUCCESSDATA;
                    } else {
                        $response['pms_response'] = FAILEDATA;
                    }
                }
                // ee function comment remove chey

                $callername   = json_encode($input->callername);
                // return $callername;
                $callername1 = json_decode($callername,TRUE);
                $callername2 = json_encode($callername1);
                /* for($i=0; $i<count($callername); $i++)
                  {

                      $insert_scheduled[$this->scheduledcallsdetails->SCHEDULE_TYPE]  = $callername[$i]['caller_name'];
                     // $nsert_scheduled[$this->scheduledcallsdetails->SCHEDULED_COUNT] = $callername1[$i]['DAY'];
                  }*/

                $insert_scheduled[$this->scheduledcallsdetails->SCHEDULE_TYPE] = ($callername2);
                //return $insert_scheduled;
                $insert_scheduled[$this->scheduledcallsdetails->SCHEDULED_DUE] = $input->scheduled_call_date;
                $insert_scheduled[$this->scheduledcallsdetails->EID] = $device_id;
                $insert_scheduled[$this->scheduledcallsdetails->ORG_ID] = $org_id;
                $insert_scheduled[$this->scheduledcallsdetails->BRANCH_ID] = isset($input->branch_id) ? $input->branch_id : $this->session->branch_id;
                $insert_scheduled[$this->scheduledcallsdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_amc[$this->deviceamcs->AMC_TYPE][0] . "P-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->scheduledcallsdetails->tbl_name, $this->scheduledcallsdetails->ID));

                if($this->basemodel->insert_into_table($this->scheduledcallsdetails->tbl_name,$insert_scheduled)){
                    $response['scheduled_response']  = SUCCESSDATA;
                }else {
                    $response['scheduled_response'] = FAILEDDATA;
                }

                /* inser qc */
                $ym = $input->no_of_qcs_ym;
                if ($ym == 'Month')
                    $qcval = 30 * (12 / $input->no_of_qcs);
                else if ($ym == 'Year')
                    $qcval = ceil(365 * (1 / $input->no_of_qcs));
                if ($qcdate != '') {
                    $qcdue = date('Y-m-d', strtotime($qcdate . " + $qcval days"));
                    $insert_qc[$this->qcdetails->QC_COUNT_TYPE] = $input->no_of_qcs_ym;
                    $insert_qc[$this->qcdetails->QC_COUNT] = $input->no_of_qcs;
                    $insert_qc[$this->qcdetails->ORG_ID] = $org_id;
                    $insert_qc[$this->qcdetails->EID] = $device_id;
                    $insert_qc[$this->qcdetails->BRANCH_ID] = isset($input->branch_id) ? $input->branch_id : $this->session->branch_id;
                    $insert_qc[$this->qcdetails->QC_DONE] = $qcdate;
                    $insert_qc[$this->qcdetails->QC_DUE] = $qcdue;
                    $insert_qc[$this->qcdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_amc[$this->deviceamcs->AMC_TYPE][0] . "Q-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->qcdetails->tbl_name, $this->qcdetails->ID));
                    if ($this->basemodel->insert_into_table($this->qcdetails->tbl_name, $insert_qc)) {
                        $qc_insert = true;
                        $response['qc_response'] = SUCCESSDATA;
                    } else {
                        $response['qc_response'] = FAILEDATA;
                    }
                }
                //}
                if (isset($device_id)) {
                    if (count($_FILES) > 0) {
                        $uploaded = $not_uploaded = 0;
                        $upload_device_folder = isset($input->po_number) ? $input->po_number : $input->serial_number;
                        for ($f = 0; $f < count($_FILES); $f++) {
                            $f_type = explode(".", $_FILES[$f]['name']);
                            $last_in = (count($f_type) - 1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH . $upload_device_folder;
                            $config['allowed_types'] = '*';
                            $time = time();
                            $config['file_name'] = $f_type[0] . "_" . $time;
                            if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload($f))
                                $uploaded++;
                            else {
                                $not_uploaded++;
                                $response['uploaded_files_errors'][] = $this->upload->display_errors();
                            }
                        }
                        $response['uploaded_files'] = $uploaded;
                        $response['not_uploaded_files'] = $not_uploaded;
                        $this->basemodel->update_operation(array($this->devices->UPLOAD_PATH => $upload_device_folder), $this->devices->tbl_name, array($this->devices->E_ID => $device_id));
                    }
                }

                $date = date('Y-m-d H:i:s');
                $curenttime = date('H:i:s');
                $curentdate = date('Y-m-d');
                $desc = $device_id . " Record is Inserted Manually by " . $user_name;
                $response['status_response'] = $this->baselibrary->equipment_status_tbl_insert($device_id, $input->company_name, $input->device_status, $date);
                $response['calllog_response'] = $this->baselibrary->insert_calllog($user_name, $desc, $curentdate, $curenttime, $date, $org_id, $branch_id);

            }


        } else {
            $response['device_response'] = FAILEDATA;
            $response['qry'] = json_encode($device_limit_check);
            $response['call_back'] = "Devices Limit Completed Already";
        }

        print_r(json_encode($response));
        return true;
    }

    public function save_stock()
    {
        $response = array();
        if(isset($_POST['device_data']))
        {
            $device_data = json_decode($_POST['device_data']);
            $sdata[$this->stock->ORG_ID] = $device_data->ORG_ID;
            $sdata[$this->stock->BRANCH_ID] = $device_data->BRANCH_ID;
            $sdata[$this->stock->DEPT_ID] = $device_data->department;
            $sdata[$this->stock->INDENT_ID] = $device_data->INDENT_ID;
            $sdata[$this->stock->INDENT_TYPE] = $device_data->INDENT_TYPE;
            $sdata[$this->stock->ADDED_BY] = $this->session->user_id;
            $sdata[$this->stock->IN_STOCK] = YESSTATE;
            $sdata[$this->stock->USERNAME] = $this->session->user_id;
            $sdata[$this->stock->E_NAME] = $device_data->device_name;
            $sdata[$this->stock->E_CAT] = $device_data->cat;
            $sdata[$this->stock->E_TYPE] = $device_data->equp_type;
            $sdata[$this->stock->ACCSSORIES] = $device_data->accessories;
            $sdata[$this->stock->SPARES] = $device_data->critical_spares;
            $sdata[$this->stock->C_NAME] = $device_data->company_name;
            $sdata[$this->stock->E_MODEL] = $device_data->device_model;
            $sdata[$this->stock->ES_NUMBER] = $device_data->serial_number;
            $sdata[$this->stock->PONO] = $device_data->po_number;
            if(isset($device_data->po_date) && $device_data->po_date!="")
            {
                $sdata[$this->stock->PDATE] = date('Y-m-d',strtotime($device_data->po_date));
            }
            if(isset($device_data->date_of_install) && $device_data->date_of_install!="")
            {
                $sdata[$this->stock->DATEOF_INSTALL] =  date('Y-m-d',strtotime($device_data->date_of_install));
            }
            $sdata[$this->stock->E_COST] = $device_data->device_cost;
            $sdata[$this->stock->DISTRIBUTOR] = $device_data->distributor;
            $sdata[$this->stock->VENDOR] = $device_data->vendor;
            $sdata[$this->stock->AMC_TYPE] = $device_data->contract_type;
            if(isset($device_data->contract_from_date) && $device_data->contract_from_date!="")
                $sdata[$this->stock->C_FROM] = date('Y-m-d',strtotime($device_data->contract_from_date));
            if(isset($device_data->contract_to_date) && $device_data->contract_to_date!="")
            {
                $sdata[$this->stock->C_TO] = date('Y-m-d',strtotime($device_data->contract_to_date));
            }
            $sdata[$this->stock->AMC_VALUE] = $device_data->contract_value;
            $sdata[$this->stock->UTILIZATION] = $device_data->utilization;
            $sdata[$this->stock->EQ_CONDATION] = $device_data->device_status;
            $sdata[$this->stock->REMARKS] = $device_data->device_remarks;
            if(isset($device_data->grn_date) && $device_data->grn_date!="")
            {
                $sdata[$this->stock->GRN_DATE] = date('Y-m-d',strtotime($device_data->grn_date));
            }
            $sdata[$this->stock->GRN_VALUE] = $device_data->grn_no;
            $sdata[$this->stock->EQ_CLASS] = $device_data->device_class;
            $sdata[$this->stock->E_COND] = $device_data->present_condition;
            $sdata[$this->stock->DESC_P] = $device_data->description;
            $sdata[$this->stock->MF_DATE] = $device_data->manufacture_date;
            $sdata[$this->stock->PHY_LOCATION] = $device_data->phy_location;
            $sdata[$this->stock->HOSPITAL_ASSET_CODE] = $device_data->asset_code;
            $sdata[$this->stock->END_OF_LIFE] = $device_data->end_of_life;
            $sdata[$this->stock->END_OF_SUPPORT] = $device_data->end_of_support;
            $sdata[$this->stock->STATUS] = "ACT";
            $sdata[$this->stock->ADDED_ON] = date('Y-m-d H:i:s');
            if($this->basemodel->insert_into_table($this->stock->tbl_name,$sdata))
            {
                $response['response'] = SUCCESSDATA;
                $response['call_back'] = $sdata[$this->stock->E_NAME]." added to stock";
                if(count($_FILES)>0)
                {
                    $uploaded = $not_uploaded =0;
                    $upload_device_folder =  isset($device_data->po_number) ? $device_data->po_number : $device_data->serial_number;
                    for($f=0;$f<count($_FILES);$f++)
                    {
                        $f_type = explode(".",$_FILES[$f]['name']);
                        $last_in = (count($f_type)-1);
                        $config['upload_path'] = INDENT_UPLOAD_PATH.$sdata[$this->stock->INDENT_ID];
                        $config['allowed_types'] = '*';
                        $time=time();
                        $config['file_name'] = $f_type[0]."_".$time;
                        if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if($this->upload->do_upload($f))
                            $uploaded++;
                        else
                        {
                            $not_uploaded++;
                            $response['uploaded_files_errors'][] = $this->upload->display_errors();
                        }
                    }
                    $response['uploaded_files'] = $uploaded;
                    $response['not_uploaded_files'] = $not_uploaded;
                }
                $date = date('Y-m-d H:i:s');
                $curenttime = date('H:i:s');
                $curentdate = date('Y-m-d');
                $desc = $sdata[$this->stock->INDENT_ID] . " ".$sdata[$this->stock->INDENT_TYPE]." Type Stock Inserted by " . $this->session->user_name;
                $response['calllog_response'] = $this->baselibrary->insert_calllog($this->session->user_name, $desc, $curentdate, $curenttime, $date,$sdata[$this->stock->ORG_ID],$sdata[$this->stock->BRANCH_ID]);
            }
            else
            {
                $response['response'] = FAILEDATA;
                $response['call_back'] = "Unable to add stock";
            }
        }
        else
        {
            $response['response'] = FAILEDATA;
            $response['call_back'] = "Invalid Request";
        }
        print_r(json_encode($response));
        return true;
    }
    public function replace_device($input=array())
    {

        /*$data=array();
        if(isset($_POST['device_data']))
        {
            $device_insert = false;
            $pms_insert = false;
            $qc_insert = false;
            $response = array();
            $device_data = json_decode($_POST['device_data']);
           if(isset($device_data->manufacture_date))
            {
                $manufacture_date1 =$device_data->manufacture_date;
                $manf_date = explode("-",$manufacture_date1);
                if($manf_date[0]>12 || $manf_date[1]>date('Y'))
                {
                    $data['device_response'] = FAILEDATA;
                    $data['call_back'] = "Invalid Manufacture Date";
                    print_r(json_encode($data));
                    return $data;
                }
            }
            else
            {
                $manufacture_date1 = NULL;
            }
            if(isset($device_data->end_of_life))
            {
                $eol =$device_data->end_of_life;
                $eol_ary = explode("-",$eol);
                if($eol_ary[0]>12)
                {
                    $data['device_response'] = FAILEDATA;
                    $data['call_back'] = "Invalid End of Life Date";
                    print_r(json_encode($data));
                    return $data;
                }
            }
            else
            {
                $eol = NULL;
            }
            if(isset($device_data->end_of_support))
            {
                $eos =$device_data->end_of_support;
                $eos_ary = explode("-",$eos);
                if($eos_ary[0]>12)
                {
                    $data['device_response'] = FAILEDATA;
                    $data['call_back'] = "Invalid End of Support Date";
                    print_r(json_encode($data));
                    return $data;
                }
            }
            else
            {
                $eos = NULL;
            }
            $insert_device[$this->devices->MF_DATE] = date('m-Y', strtotime($device_data->manufacture_date));
            $insert_device[$this->devices->REPLACEMENT_DATE] = date('Y-m-d H:i:s');
            $insert_device[$this->devices->REPLACEMENT_ID] = $device_data->EQ_ID;
            $insert_device[$this->devices->REPLACEMENT_BY] = $this->session->user_id;
            $insert_device[$this->devices->END_OF_LIFE] = $eol;
            $insert_device[$this->devices->END_OF_SUPPORT] = $eos;
            $insert_device[$this->devices->DEPT_ID] = $device_data->department;
            $insert_device[$this->devices->GENERAL_ASSET] = $device_data->general_asset;
            $podate1 = date('Y-m-d', strtotime($device_data->po_date));
            $pmsdate = isset($device_data->pms_date) ? date('Y-m-d', strtotime($device_data->pms_date)) : NULL;
            $qcdate = isset($device_data->qc_date) ? date('Y-m-d', strtotime($device_data->qc_date)) : NULL;
            $insert_device[$this->devices->HOSPITAL_ASSET_CODE] = isset($device_data->asset_code) ? $device_data->asset_code : NULL;
            if(isset($device_data->date_of_install))
            {
                $date_of_install1 = date('Y-m-d', strtotime($device_data->date_of_install));
                $insert_device[$this->devices->DATEOF_INSTALL] = $date_of_install1;
            }

            if(isset($device_data->grn_date) && $device_data->grn_date!='')
                $insert_device[$this->devices->GRN_DATE] = date('Y-m-d', strtotime($device_data->grn_date));

            if(isset($device_data->grn_no) && $device_data->grn_no!='')
                $insert_device[$this->devices->GRN_VALUE] = $device_data->grn_no;

            // contract
            if(isset($device_data->contract_from_date) && $device_data->contract_from_date!=null)
                $insert_amc[$this->deviceamcs->AMC_FROM] = date('Y-m-d', strtotime($device_data->contract_from_date));
            if(isset($device_data->contract_to_date) && $device_data->contract_to_date!=null)
                $insert_amc[$this->deviceamcs->AMC_TO] = date('Y-m-d', strtotime($device_data->contract_to_date));
            $insert_amc[$this->deviceamcs->AMC_TYPE] = $device_data->contract_type;
            $insert_amc[$this->deviceamcs->AMC_VALUE] = isset($device_data->contract_value) ? $device_data->contract_value : NULL;
            $insert_amc[$this->deviceamcs->AMC_VENDOR] = isset($device_data->vendor) ? $device_data->vendor : NULL;

            //breakdown
            if(isset($device_data->last_breakdown_date))
            {
                $insrt_bd[$this->dbrkdwns->BD_DATETIME] = date('Y-m-d', strtotime($device_data->last_breakdown_date));
                $insrt_bd[$this->dbrkdwns->BD_COST] = $device_data->break_down_cost;
                $insrt_bd[$this->devices->LB_DATE] = date('Y-m-d', strtotime($device_data->last_breakdown_date));
                $insert_device[$this->devices->BD_COST] =  $device_data->break_down_cost;
                $insert_device[$this->devices->BD_COUNT] =  $device_data->break_down_count;
            }

            $insert_device[$this->devices->PDATE] = $podate1;
            $insert_device[$this->devices->DISTRIBUTOR] = $device_data->distributor;
            $insert_device[$this->devices->ORG_ID] = $this->session->org_id;
            $insert_device[$this->devices->USERNAME] = $this->session->user_id;
            $insert_device[$this->devices->BRANCH_ID] = $this->session->branch_id;
            $insert_device[$this->devices->E_COND] = $device_data->present_condition;
            $insert_device[$this->devices->DESC_P] = $device_data->description;
            $insert_device[$this->devices->EQ_CLASS] = $device_data->device_class;

            $insert_device[$this->devices->C_NAME] = $device_data->company_name;
            $insert_device[$this->devices->E_NAME] = $device_data->device_name;
            $insert_device[$this->devices->E_CAT] = $device_data->cat;
            $cat=$this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->CODE,array($this->devicenames->ID=>$insert_device[$this->devices->E_CAT]));
            $insert_device[$this->devices->E_COST] = $device_data->device_cost;
            $insert_device[$this->devices->E_TYPE] = $device_data->equp_type;
            $insert_device[$this->devices->E_MODEL] = $device_data->device_model;
            $insert_device[$this->devices->ACCSSORIES] = $device_data->accessories;
            $insert_device[$this->devices->CRITICAL_SPARES] =$device_data->critical_spares;
            if(isset($device_data->phy_location) && $device_data->phy_location!='')
                $insert_device[$this->devices->PHY_LOCATION] = $device_data->phy_location;
            $insert_device[$this->devices->PONO] = $device_data->po_number;
            $insert_device[$this->devices->REMARKS] = $device_data->device_remarks;
            $insert_device[$this->devices->ES_NUMBER] = $device_data->serial_number;
            $insert_device[$this->devices->EQ_CONDATION] = $device_data->device_status;
            $insert_device[$this->devices->UTILIZATION] = $device_data->utilization;

            // device Id gen
            $branch_dtls = $this->basemodel->fetch_single_row($this->branches->tbl_name, array($this->branches->BRANCH_ID => $this->session->branch_id));
            $qry = "SELECT ".$this->devices->E_ID." FROM ".$this->db->dbprefix($this->devices->tbl_name)." WHERE ".$this->devices->ORG_ID." = '".$this->session->org_id."' AND ".$this->devices->E_ID." LIKE '".$branch_dtls[$this->branches->CITY]."-___-____-".$branch_dtls[$this->branches->BRANCH_CODE]."-%-___-____' ORDER BY Right(".$this->devices->E_ID.",4) DESC";
            $devices = $this->basemodel->execute_qry($qry);
            if(!empty($devices))
            {
                $device = $devices[0];
                $eid=$device[$this->devices->E_ID];
                $data['last_equp'] = $eid;
                $number_array=explode("-",$eid);
                $number = end($number_array);
                $number = (int)$number;
                $number = $number+1;
            }
            else
                $number=1;
            $len = strlen($number);
            if($len==1)
                $elast_id="000".$number;
            else if($len==2)
                $elast_id="00".$number;
            else if($len==3)
                $elast_id="0".$number;
            else
                $elast_id=$number;

            $main_device_id =  $branch_dtls[$this->branches->CITY]."-"."BME"."-".date('my',strtotime($insert_device[$this->devices->DATEOF_INSTALL]))."-".$branch_dtls[$this->branches->BRANCH_CODE]."-".$insert_device[$this->devices->DEPT_ID]."-".$cat."-".$elast_id;
            $insert_device[$this->devices->E_ID] = $main_device_id;
            //print_r($main_device_id);exit;
            $ress = $this->basemodel->insert_into_table($this->devices->tbl_name, $insert_device);
            // Device Id Gen. End
            if ($ress)
            {
                $device_id = $main_device_id;
                $device_insert = true;
                $response['device_id'] = $device_id;
                $response['device_response'] = SUCCESSDATA;
                $response['call_back'] = $response['device_id']." Equipment Details Saved";
                $urpl[$this->devices->STATUS]= "RPL";
                $urpl_where[$this->devices->ID]= $device_data->ID;
                $response['device_rpl'] = $this->basemodel->update_operation($urpl,$this->devices->tbl_name,$urpl_where);
            }
            else
            {
                $device_insert = false;
                $response['device_response'] = FAILEDATA;
                $response['call_back'] = "Unable to Process Your Request Try again";
            }
            if ($device_insert)
            {
                // insert device breakdown table
                if(isset($device_data->last_breakdown_date))
                {
                    $insrt_bd[$this->dbrkdwns->ORG_ID] = $insert_device[$this->devices->ORG_ID];
                    $insrt_bd[$this->dbrkdwns->BRANCH_ID] = $insert_device[$this->devices->BRANCH_ID];
                    $insrt_bd[$this->dbrkdwns->EID] = $device_id;
                    $insrt_bd[$this->dbrkdwns->ADDED_BY] = $insert_device[$this->devices->USERNAME];
                    $insrt_bd[$this->dbrkdwns->ADDED_ON] = date('Y-m-d H:i:s');
                    $this->basemodel->insert_into_table($this->dbrkdwns->tbl_name,$insrt_bd);
                }
                // insert amc table
                $insert_amc[$this->deviceamcs->ORG_ID] = $insert_device[$this->devices->ORG_ID];
                $insert_amc[$this->deviceamcs->BRANCH_ID] = $insert_device[$this->devices->BRANCH_ID];
                $insert_amc[$this->deviceamcs->EID] = $device_id;
                $insert_amc[$this->deviceamcs->ADDED_BY] = $insert_device[$this->devices->USERNAME];
                $insert_amc[$this->deviceamcs->ADDED_ON] = date('Y-m-d H:i:s');
                $this->basemodel->insert_into_table($this->deviceamcs->tbl_name,$insert_amc);

                if($insert_device[$this->devices->GENERAL_ASSET]==YESSTATE)
                {
                    // insert pms
                    $pmsval = 30*(12 / $device_data->no_of_pms);
                    if ($pmsdate != '')
                    {
                        $pmsdue = date('Y-m-d', strtotime($pmsdate. " + $pmsval days"));
                        $insert_pms[$this->pmsdetails->PMS_COUNT] = $device_data->no_of_pms;
                        $insert_pms[$this->pmsdetails->ORG_ID] = $this->session->org_id;
                        $insert_pms[$this->pmsdetails->EID] = $device_id;
                        $insert_pms[$this->pmsdetails->BRANCH_ID] = $this->session->branch_id;
                        $insert_pms[$this->pmsdetails->PMS_DONE] = $pmsdate;
                        $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                        $insert_pms[$this->pmsdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE]."-".$insert_amc[$this->deviceamcs->AMC_TYPE][0]."P-".date('my')."-".$this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->pmsdetails->tbl_name,$this->pmsdetails->ID));
                        if($this->basemodel->insert_into_table($this->pmsdetails->tbl_name, $insert_pms))
                        {
                            $pms_insert = true;
                            $response['pms_response'] = SUCCESSDATA;
                        }
                        else
                        {
                            $response['pms_response'] = FAILEDATA;
                        }
                    }

                    // inser qc
                    $ym = $device_data->no_of_qcs_ym;
                    if($ym=='Month')
                        $qcval = 30*(12 / $device_data->no_of_qcs);
                    else if($ym=='Year')
                        $qcval = ceil(365*(1 / $device_data->no_of_qcs));
                    if ($qcdate != '')
                    {
                        $qcdue = date('Y-m-d', strtotime($qcdate. " + $qcval days"));
                        $insert_qc[$this->qcdetails->QC_COUNT_TYPE] = $device_data->no_of_qcs_ym;
                        $insert_qc[$this->qcdetails->QC_COUNT] = $device_data->no_of_qcs;
                        $insert_qc[$this->qcdetails->ORG_ID] = $this->session->org_id;
                        $insert_qc[$this->qcdetails->EID] = $device_id;
                        $insert_qc[$this->qcdetails->BRANCH_ID] = $this->session->branch_id;
                        $insert_qc[$this->qcdetails->QC_DONE] = $qcdate;
                        $insert_qc[$this->qcdetails->QC_DUE] = $qcdue;
                        $insert_pms[$this->qcdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE]."-".$insert_amc[$this->deviceamcs->AMC_TYPE][0]."Q-".date('my')."-".$this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->qcdetails->tbl_name,$this->qcdetails->ID));
                        if ($this->basemodel->insert_into_table($this->qcdetails->tbl_name, $insert_qc)) {
                            $qc_insert = true;
                            $response['qc_response'] = SUCCESSDATA;
                        } else {
                            $response['qc_response'] = FAILEDATA;
                        }
                    }
                }
                if(isset($device_id))
                {
                    if(count($_FILES)>0)
                    {
                        $uploaded = $not_uploaded =0;
                        $upload_device_folder =  isset($device_data->po_number) ? $device_data->po_number : $device_data->serial_number;
                        for($f=0;$f<count($_FILES);$f++)
                        {
                            $f_type = explode(".",$_FILES[$f]['name']);
                            $last_in = (count($f_type)-1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH.$upload_device_folder;
                            $config['allowed_types'] = '*';
                            $time=time();
                            $config['file_name'] = $f_type[0]."_".$time;
                            if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if($this->upload->do_upload($f))
                                $uploaded++;
                            else
                            {
                                $not_uploaded++;
                                $response['uploaded_files_errors'][] = $this->upload->display_errors();
                            }
                        }
                        $response['uploaded_files'] = $uploaded;
                        $response['not_uploaded_files'] = $not_uploaded;
                        $this->basemodel->update_operation(array($this->devices->UPLOAD_PATH=>$upload_device_folder),$this->devices->tbl_name,array($this->devices->ID=>$device_id));
                    }
                }
                $date = date('Y-m-d H:i:s');
                $curenttime = date('H:i:s');
                $curentdate = date('Y-m-d');
                $desc = $device_id . " Record is Replaced by " . $this->session->user_name;
                $response['status_response'] = $this->baselibrary->equipment_status_tbl_insert($device_id,$device_data->company_name, $device_data->device_status, $date);
                $response['calllog_response'] = $this->baselibrary->insert_calllog($this->session->user_name, $desc, $curentdate, $curenttime, $date,$this->session->org_id,$this->session->branch_id);
            }
            print_r(json_encode($response));
        }
        return true;*/

        $data = $response = array();
        if (count((array)$input) > 0) {
            $device_limit_check = $this->_get_org_devices_cnt($input);
        }
        else if (isset($_POST['device_data'])) {
            $input = json_decode($_POST['device_data']);
            $device_limit_check = $this->_get_org_devices_cnt($input);
        }


        if ($device_limit_check['od_cnt'] < $device_limit_check['od_value']) {
            if (isset($_POST['device_data']) || count((array)$input) > 0) {
                $device_insert = false;
                $pms_insert = false;
                $qc_insert = false;

                if (count((array)$input) == 0)
                    $input = json_decode($_POST['device_data']);

                /* if (isset($input->manufacture_date)) {

                     $manufacture_date1 = $input->manufacture_date;
                     $manf_date = explode("-", $manufacture_date1);
                     if ($manf_date[0] > 12 || $manf_date[1] > date('Y')) {
                         $data['device_response'] = FAILEDATA;
                         $data['call_back'] = "Invalid Manufacture Date";
                         print_r(json_encode($data));
                         return $data;
                     }
                 } else {
                     $manufacture_date1 = NULL;
                 }*/
                if (isset($input->end_of_life)) {
                    $eol = $input->end_of_life;
                    $eol_ary = explode("-", $eol);
                    if ($eol_ary[0] > 12) {
                        $data['device_response'] = FAILEDATA;
                        $data['call_back'] = "Invalid End of Life Date";
                        print_r(json_encode($data));
                        return $data;
                    }
                } else {
                    $eol = NULL;
                }
                if (isset($input->end_of_support)) {
                    $eos = $input->end_of_support;
                    $eos_ary = explode("-", $eos);
                    if ($eos_ary[0] > 12) {
                        $data['device_response'] = FAILEDATA;
                        $data['call_back'] = "Invalid End of Support Date";
                        print_r(json_encode($data));
                        return $data;
                    }
                } else {
                    $eos = NULL;
                }
                //print_r(date('m-Y', strtotime($input->manufacture_date)));
                $insert_device[$this->devices->MF_DATE] = date('m-Y', strtotime($input->manufacture_date));
                $insert_device[$this->devices->END_OF_LIFE] = $eol;
                $insert_device[$this->devices->END_OF_SUPPORT] = $eos;
                $insert_device[$this->devices->MF_DATE];

                $insert_device[$this->devices->DEPT_ID] = $input->department;
                $insert_device[$this->devices->VENDOR] = $input->vendor;
                $insert_device[$this->devices->GENERAL_ASSET] = NOSTATE;
                $podate1 = isset($input->po_date) ? date('Y-m-d', strtotime($input->po_date)) : NULL;

                $pmsdate = isset($input->pms_date) ? date('Y-m-d', strtotime($input->pms_date)) : NULL;
                $qcdate = isset($input->qc_date) ? date('Y-m-d', strtotime($input->qc_date)) : NULL;

                $insert_device[$this->devices->HOSPITAL_ASSET_CODE] = isset($input->asset_code) ? $input->asset_code : NULL;
                if (isset($input->date_of_install)) {
                    $date_of_install1 = date('Y-m-d', strtotime($input->date_of_install));
                    $insert_device[$this->devices->DATEOF_INSTALL] = $date_of_install1;
                }

                if (isset($input->grn_date) && $input->grn_date != '')
                    $insert_device[$this->devices->GRN_DATE] = date('Y-m-d', strtotime($input->grn_date));

                if (isset($input->grn_no) && $input->grn_no != '')
                    $insert_device[$this->devices->GRN_VALUE] = $input->grn_no;

                /* contract */

                if (isset($input->contract_from_date) && $input->contract_from_date != null)
                    $insert_amc[$this->deviceamcs->AMC_FROM] = date('Y-m-d', strtotime($input->contract_from_date));
                if (isset($input->contract_to_date) && $input->contract_to_date != null)
                    $insert_amc[$this->deviceamcs->AMC_TO] = date('Y-m-d', strtotime($input->contract_to_date));
                $insert_amc[$this->deviceamcs->AMC_TYPE] = $input->contract_type;
                $insert_amc[$this->deviceamcs->AMC_VALUE] = isset($input->contract_value) ? $input->contract_value : NULL;
                $insert_amc[$this->deviceamcs->AMC_VENDOR] = isset($input->vendor) ? $input->vendor : NULL;

                /* breakdown */
                if (isset($input->last_breakdown_date)) {
                    $insrt_bd[$this->dbrkdwns->BD_DATETIME] = date('Y-m-d', strtotime($input->last_breakdown_date));
                    $insrt_bd[$this->dbrkdwns->BD_COST] = $input->break_down_cost;
                    $insrt_bd[$this->devices->LB_DATE] = date('Y-m-d', strtotime($input->last_breakdown_date));
                    $insert_device[$this->devices->BD_COST] = $input->break_down_cost;
                    $insert_device[$this->devices->BD_COUNT] = $input->break_down_count;
                }

            }

            $branch_id = isset($input->branch_id) ? $input->branch_id : $this->session->branch_id;
            $org_id = isset($input->org_id) ? $input->org_id : $this->session->org_id;

            $insert_device[$this->devices->PDATE] = $podate1;
            $insert_device[$this->devices->DISTRIBUTOR] = $input->distributor;

            $insert_device[$this->devices->ORG_ID] = $org_id;

            //  echo $insert_device->$this->devices->ORG_ID;

            // $insert_device[$this->devices->USERNAME] = $this->session->user_id;
            $insert_device[$this->devices->BRANCH_ID] = $branch_id;

            $insert_device[$this->devices->USERNAME] = $this->session->user_id;
            $insert_device[$this->devices->E_COND] = $input->present_condition;
            $insert_device[$this->devices->DESC_P] = $input->description;
            $insert_device[$this->devices->EQ_CLASS] = $input->device_class;

            $insert_device[$this->devices->C_NAME] = $input->company_name;

            $insert_device[$this->devices->E_NAME] = $input->device_name;
            $insert_device[$this->devices->E_CAT] = $input->cat;
            $cat = $this->basemodel->get_single_column_value($this->devicenames->tbl_name, $this->devicenames->CODE, array($this->devicenames->ID => $insert_device[$this->devices->E_CAT]));
            $insert_device[$this->devices->E_COST] = $input->device_cost;
            $insert_device[$this->devices->E_TYPE] = $input->equp_type;
            $insert_device[$this->devices->E_MODEL] = $input->device_model;
            $insert_device[$this->devices->ACCSSORIES] = $input->accessories;
            $insert_device[$this->devices->CRITICAL_SPARES] = $input->critical_spares;
            if (isset($input->phy_location) && $input->phy_location != '')
                $insert_device[$this->devices->PHY_LOCATION] = $input->phy_location;
            $insert_device[$this->devices->PONO] = $input->po_number;
            $insert_device[$this->devices->REMARKS] = $input->device_remarks;
            $insert_device[$this->devices->ES_NUMBER] = $input->serial_number;
            $insert_device[$this->devices->EQ_CONDATION] = $input->device_status;
            $insert_device[$this->devices->UTILIZATION] = $input->utilization;




            // device Id gen
            /*$branch_dtls = $this->basemodel->fetch_single_row($this->branches->tbl_name, array($this->branches->BRANCH_ID => $this->session->branch_id));
            $qry = "SELECT ".$this->devices->E_ID." FROM ".$this->db->dbprefix($this->devices->tbl_name)." WHERE ".$this->devices->ORG_ID." = '".$this->session->org_id."' AND ".$this->devices->E_ID." LIKE '".$branch_dtls[$this->branches->CITY]."-___-____-".$branch_dtls[$this->branches->BRANCH_CODE]."-%-___-____' ORDER BY Right(".$this->devices->E_ID.",4) DESC";
            $devices = $this->basemodel->execute_qry($qry);
            if(!empty($devices))
            {
                $device = $devices[0];
                $eid=$device[$this->devices->E_ID];
                $data['last_equp'] = $eid;
                $number_array=explode("-",$eid);
                $number = end($number_array);
                $number = (int)$number;
                $number = $number+1;
            }
            else
                $number=1;
            $len = strlen($number);
            if($len==1)
                $elast_id="000".$number;
            else if($len==2)
                $elast_id="00".$number;
            else if($len==3)
                $elast_id="0".$number;
            else
                $elast_id=$number;

            $main_device_id =  $branch_dtls[$this->branches->CITY]."-"."BME"."-".date('my',strtotime($insert_device[$this->devices->DATEOF_INSTALL]))."-".$branch_dtls[$this->branches->BRANCH_CODE]."-".$insert_device[$this->devices->DEPT_ID]."-".$cat."-".$elast_id;
            */
            // device Id gen.

            $branch_dtls = $this->basemodel->fetch_single_row($this->branches->tbl_name, array($this->branches->BRANCH_ID => $branch_id));
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
            $main_device_id = $branch_dtls[$this->branches->CITY] . "-" . "BME" . "-" . date('my', strtotime($insert_device[$this->devices->DATEOF_INSTALL])) . "-" . $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_device[$this->devices->DEPT_ID] . "-" . $cat . "-" . $elast_id;
            $insert_device[$this->devices->E_ID] = $main_device_id;
            $insert_device[$this->devices->USERNAME] = $user_name;
            $insert_device[$this->devices->QR_CODE] = QR_URL . $insert_device[$this->devices->E_ID];


            /* Device Id Gen. End */
            $check_dept_exists_for_round = $this->basemodel->fetch_single_row($this->devices->tbl_name, array($this->devices->DEPT_ID => $input->department, $this->devices->BRANCH_ID => $branch_id, $this->devices->ORG_ID => $org_id), $this->devices->DEPT_ID);
            // $this->basemodel->insert_into_table($this->devices->tbl_name, $insert_device);
            $insert_device[$this->devices->E_ID] = $main_device_id;
            if ($this->basemodel->insert_into_table($this->devices->tbl_name, $insert_device)) {
                $device_id = $main_device_id;
                $device_insert = true;
                $response['device_id'] = $device_id;
                $response['device_response'] = SUCCESSDATA;
                $urpl[$this->devices->STATUS]= "RPL";
                $urpl_where[$this->devices->ID]= $device_data->ID;
                $response['device_rpl'] = $this->basemodel->update_operation($urpl,$this->devices->tbl_name,$urpl_where);
                if (empty($check_dept_exists_for_round)) {
                    $response['users_rounds'] = $this->baselibrary->assign_round_new_dept($this->session->org_id, $branch_id, $input->department);
                }
                $response['call_back'] = $response['device_id'] . " Equipment Details Saved";
            } else {
                $device_insert = false;
                $response['device_response'] = FAILEDATA;
                $response['call_back'] = "Unable to Process Your Request Try again";
            }

            if ($device_insert) {

                /* insert device breakdown table */
                if (isset($input->last_breakdown_date)) {
                    $insrt_bd[$this->dbrkdwns->ORG_ID] = $insert_device[$this->devices->ORG_ID];
                    $insrt_bd[$this->dbrkdwns->BRANCH_ID] = $insert_device[$this->devices->BRANCH_ID];
                    $insrt_bd[$this->dbrkdwns->EID] = $device_id;
                    $insrt_bd[$this->dbrkdwns->ADDED_BY] = $insert_device[$this->devices->USERNAME];
                    $insrt_bd[$this->dbrkdwns->ADDED_ON] = date('Y-m-d H:i:s');
                    $this->basemodel->insert_into_table($this->dbrkdwns->tbl_name, $insrt_bd);
                }
                /* insert amc table */
                $insert_amc[$this->deviceamcs->ORG_ID] = $insert_device[$this->devices->ORG_ID];
                $insert_amc[$this->deviceamcs->BRANCH_ID] = $insert_device[$this->devices->BRANCH_ID];
                $insert_amc[$this->deviceamcs->EID] = $device_id;
                $insert_amc[$this->deviceamcs->ADDED_BY] = $insert_device[$this->devices->USERNAME];
                $insert_amc[$this->deviceamcs->ADDED_ON] = date('Y-m-d H:i:s');
                $this->basemodel->insert_into_table($this->deviceamcs->tbl_name, $insert_amc);

                //if ($insert_device[$this->devices->GENERAL_ASSET] == YESSTATE) {
                /* insert pms */
                $pmsval = 30 * (12 / $input->no_of_pms);
                if ($pmsdate != '') {
                    $pmsdue = date('Y-m-d', strtotime($pmsdate . " + $pmsval days"));
                    $insert_pms[$this->pmsdetails->PMS_COUNT] = $input->no_of_pms;
                    $insert_pms[$this->pmsdetails->ORG_ID] = $org_id;
                    $insert_pms[$this->pmsdetails->EID] = $device_id;
                    $insert_pms[$this->pmsdetails->BRANCH_ID] = isset($input->branch_id) ? $input->branch_id : $this->session->branch_id;
                    $insert_pms[$this->pmsdetails->PMS_DONE] = $pmsdate;
                    $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                    $insert_pms[$this->pmsdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_amc[$this->deviceamcs->AMC_TYPE][0] . "P-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->pmsdetails->tbl_name, $this->pmsdetails->ID));
                    if ($this->basemodel->insert_into_table($this->pmsdetails->tbl_name, $insert_pms)) {
                        $pms_insert = true;
                        $response['pms_response'] = SUCCESSDATA;
                    } else {
                        $response['pms_response'] = FAILEDATA;
                    }
                }
                // ee function comment remove chey

                /* inser qc */
                $ym = $input->no_of_qcs_ym;
                if ($ym == 'Month')
                    $qcval = 30 * (12 / $input->no_of_qcs);
                else if ($ym == 'Year')
                    $qcval = ceil(365 * (1 / $input->no_of_qcs));
                if ($qcdate != '') {
                    $qcdue = date('Y-m-d', strtotime($qcdate . " + $qcval days"));
                    $insert_qc[$this->qcdetails->QC_COUNT_TYPE] = $input->no_of_qcs_ym;
                    $insert_qc[$this->qcdetails->QC_COUNT] = $input->no_of_qcs;
                    $insert_qc[$this->qcdetails->ORG_ID] = $org_id;
                    $insert_qc[$this->qcdetails->EID] = $device_id;
                    $insert_qc[$this->qcdetails->BRANCH_ID] = isset($input->branch_id) ? $input->branch_id : $this->session->branch_id;
                    $insert_qc[$this->qcdetails->QC_DONE] = $qcdate;
                    $insert_qc[$this->qcdetails->QC_DUE] = $qcdue;
                    $insert_qc[$this->qcdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_amc[$this->deviceamcs->AMC_TYPE][0] . "Q-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->qcdetails->tbl_name, $this->qcdetails->ID));
                    if ($this->basemodel->insert_into_table($this->qcdetails->tbl_name, $insert_qc)) {
                        $qc_insert = true;
                        $response['qc_response'] = SUCCESSDATA;
                    } else {
                        $response['qc_response'] = FAILEDATA;
                    }
                }
                //}
                if (isset($device_id)) {
                    if (count($_FILES) > 0) {
                        $uploaded = $not_uploaded = 0;
                        $upload_device_folder = isset($input->po_number) ? $input->po_number : $input->serial_number;
                        for ($f = 0; $f < count($_FILES); $f++) {
                            $f_type = explode(".", $_FILES[$f]['name']);
                            $last_in = (count($f_type) - 1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH . $upload_device_folder;
                            $config['allowed_types'] = '*';
                            $time = time();
                            $config['file_name'] = $f_type[0] . "_" . $time;
                            if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload($f))
                                $uploaded++;
                            else {
                                $not_uploaded++;
                                $response['uploaded_files_errors'][] = $this->upload->display_errors();
                            }
                        }
                        $response['uploaded_files'] = $uploaded;
                        $response['not_uploaded_files'] = $not_uploaded;
                        $this->basemodel->update_operation(array($this->devices->UPLOAD_PATH => $upload_device_folder), $this->devices->tbl_name, array($this->devices->ID => $device_id));
                    }
                }

                $date = date('Y-m-d H:i:s');
                $curenttime = date('H:i:s');
                $curentdate = date('Y-m-d');
                $desc = $device_id . " Record is Replaced  by " . $user_name;
                $response['status_response'] = $this->baselibrary->equipment_status_tbl_insert($device_id, $input->company_name, $input->device_status, $date);
                $response['calllog_response'] = $this->baselibrary->insert_calllog($user_name, $desc, $curentdate, $curenttime, $date, $org_id, $branch_id);

            }


        } else {
            $response['device_response'] = FAILEDATA;
            $response['qry'] = json_encode($device_limit_check);
            $response['call_back'] = "Devices Limit Completed Already";
        }

        print_r(json_encode($response));
        return true;
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
            $aaction = isset($jodata->aaction) ? $jodata->aaction : '';

            if($aaction != '' && $aaction == "get_assigned_calls")
                $data = $this->_get_assigned_calls($jodata);
            else if ($action == 'search_by_accserial' OR $action == 'search_by_id' OR $action == 'search_by_spono')
                $data = $this->_search_device($jodata);
            else if ($action == "print_labels")
                $data = $this->_print_labels($jodata);
            else if ($action == "print_labels_pms_cal")
                $data = $this->_print_labels_pms_cal($jodata);
            else if ($action == "get_equp_sumry")
                $data = $this->_get_equp_summary($jodata);
            else if ($action == "get_equp_company_summary")
                $data = $this->_get_equp_unit_wise($jodata);
            else if ($action == "get_allhb_devices")
                $data = $this->_get_devices($jodata);
            else if ($action == "device_search_cg")
                $data = $this->_search_device_call_genetation($jodata);
            else if ($action == "get_device_reasons")
                $data = $this->_get_reasons();
            else if ($action == "get_device_priorities")
                $data = $this->_get_priorities();
            else if ($action == "call_generation_by_user" || $action == "call_generation_all")
                $data = $this->_call_generation_by_user($jodata);
            else if ($action == "get_today_calls")
                $data = $this->_get_today_calls($jodata);
            else if ($action == "get_not_responded_calls")
                $data = $this->_app_not_responded_calls($jodata);
            else if ($action == "self_respond_call")
                $data = $this->_self_respond_call($jodata);
            else if ($action == "assign_call" || $action == "re_assign_call")
                $data = $this->_assign_call($jodata);
            else if($action == "re_pending_assign_call")
                $data = $this->_re_pending_assign_call($jodata);
            else if ($action == "get_bme_today_calls")
                $data = $this->_get_bme_today_calls($jodata);
            else if ($action == "get_working_devices")
                $data = $this->_get_working_devices($jodata);
            else if ($action == "attend_responded_call")
                $data = $this->_attend_responded_call($jodata);
            else if ($action == "get_responded_bmecalls" || $action=="get_responded_hodcalls" || $action == "get_bme_responded_calls")
                $data = $this->_get_responded_bmecalls($jodata);
            else if ($action == "get_attended_bmecalls" || $action=="get_attended_hodcalls" || $action=="get_bme_attended_calls")
                $data = $this->_get_attended_bmecalls($jodata);
            else if ($action == "get_processpending_bmecalls" || $action=="get_processpending_hodcalls" ||$action =="get_bme_pending_calls" )
                $data = $this->_get_processpending_bmecalls($jodata);
            else if ($action == "get_complete_bmecalls" || $action=="get_complete_hodcalls"|| $action=="get_bme_completed_calls")
                $data = $this->_get_complete_bmecalls($jodata);
            else if ($action == "get_completed_all_bmecalls")
                $data = $this->_get_completed_all_calls($jodata);
            else if ($action == "get_pending_bmepms" || $action=="get_pending_hodpms")
                $data = $this->_get_pending_bmepms($jodata);
            else if ($action == "get_pending_bmeqc" || $action=="get_pending_hodqc")
                $data = $this->_get_pending_bmeqc($jodata);
            else if ($action == "make_pending_call")
                $data = $this->_make_pending_call($jodata);
            else if ($action == "complete_the_call")
                $data = $this->_complete_the_call($jodata);
            else if ($action == "pending_pms_assign")
                $data = $this->_pending_pms_assign($jodata);
            else if ($action == "pending_pms_self")
                $data = $this->_pending_pms_self($jodata);
            else if ($action == "pending_qc_assign")
                $data = $this->_pending_qc_assign($jodata);
            else if ($action == "pending_qc_self")
                $data = $this->_pending_qc_self($jodata);
            else if ($action == "get_completed_bmepms" || $action=="get_complete_hodpms")
                $data = $this->_get_completed_bmepms($jodata);
            else if ($action == "get_completed_bmepms_new" || $action=="get_complete_hodpms_new")
                $data = $this->_get_completed_bmepms_new($jodata);
            else if ($action == "get_completed_bmeqcs" || $action=="get_completed_hodqcs")
                $data = $this->_get_completed_bmeqcs($jodata);
            else if ($action == "get_cause_codes")
                $data = $this->_get_cause_codes($jodata);
            else if ($action == "create_training")
                $data = $this->_create_training($jodata);
            else if ($action == "hod_approve_training")
                $data = $this->_get_request_approve($jodata);
            else if ($action == "get_trainings")
                $data = $this->_get_trainings($jodata);
            else if ($action == "conduct_training")
                $data = $this->_conduct_training($jodata);
            else if ($action == "training_feedback")
                $data = $this->_training_feedback($jodata);
            else if ($action == "give_training_feedback")
                $data = $this->_give_training_feedback($jodata);
            else if ($action == "submit_round")
                $data = $this->_submit_round($jodata);
            else if ($action == "submit_round_start_time")
                $data = $this->_submit_round_start_time($jodata);
            else if ($action == "get_complete_round")
                $data = $this->_get_complete_round($jodata);
            else if ($action == "assign_round")
                $data = $this->_assign_round($jodata);
            else if ($action == "re_assign_round")
                $data = $this->_re_assign_round($jodata);
            else if ($action == "get_assigned_round")
                $data = $this->_get_assigned_round($jodata);
            else if ($action == "device_ids_search")
                $data = $this->_get_all_equipments_of_org_branch($jodata);
            else if ($action == "get_call_counts")
                $data = $this->_get_call_counts($jodata);
            else if ($action == "get_rounds_depts")
                $data = $this->_get_rounds_depts($jodata);
            else if ($action == "get_round_perminent_useres")
                $data = $this->_get_round_perminent_useres($jodata);
            else if ($action == "remaind_to_bme")
                $data = $this->_remaind_to_bme($jodata);
            else if ($action == "get_vendor_calls")
                $data = $this->_get_vendor_calls($jodata);
            else if ($action == "get_equp_types")
                $data = $this->_get_equp_types_master($jodata);
            else if ($action == "get_equp_names_by_type")
                $data = $this->_get_equp_names($jodata);
            else if ($action == "add_equp_name")
                $data = $this->_add_equp_name($jodata);
            else if ($action == "get_equip_names")
                $data = $this->_get_equip_names($jodata);
            else if ($action == "update_equp_name")
                $data = $this->_update_equp_name($jodata);
            else if ($action == "get_classifications")
                $data = $this->_get_classifications($jodata);
            else if ($action == "search_by_equp_aid" || $action == "search_by_equp_eid")
                $data = $this->_search_by_equp_aid($jodata);
            else if ($action == "device_deployment")
                $data = $this->_device_deployment($jodata);
            else if ($action == "get_undeployed_equipments")
                $data = $this->_undeployed_equipments($jodata);
            else if ($action == "get_depart_devices")
                $data = $this->_get_depart_devices($jodata);
            else if ($action == "get_m_contracts")
                $data = $this->_get_m_contracts($jodata);
            else if ($action == "get_contracts_count")
                $data = $this->_get_contracts_count($jodata);
            else if ($action == "add_maintaince_contracts")
                $data = $this->_add_maintaince_contracts($jodata);
            else if ($action == "assigned_calls" || $action=="assigned_calls_hod")
                $data = $this->_assigned_calls($jodata);
            else if ($action == "my_open_calls")
                $data = $this->_my_open_calls($jodata);
            else if ($action == "open_calls")
                $data = $this->_open_calls($jodata);
            else if ($action == "update_maintain_contract")
                $data = $this->_update_maintain_contract($jodata);
            else if ($action == "add_renuval_contracts")
                $data = $this->_add_renuval_contracts($jodata);
            else if ($action == "update_device")
                $data = $this->_update_device($jodata);
            else if ($action == "get_incedents_observations_data")
                $data = $this->_get_incedents_observations_data($jodata);
            else if ($action == "get_branch_devices")
                $data = $this->_get_branch_devices($jodata);
            else if ($action == "get_dept_devices")
                $data = $this->_get_dept_devices($jodata);
            else if ($action == "get_priority_by_equpmentid")
                $data = $this->_get_priority_by_equpmentid($jodata);
            else if ($action == "get_adverse_incidents")
                $data = $this->_get_adverse_incidents($jodata);
            else if ($action == "get_adverse_incidents_clist")
                $data = $this->_get_adverse_incidents_clist($jodata);
            else if ($action == "assigned_responded_calls")
                $data = $this->_assigned_responded_calls($jodata);
            else if ($action == "get_equp_contracts")
                $data = $this->_get_equp_contracts($jodata);
            else if ($action == "my_closed_calls")
                $data = $this->_my_closed_calls($jodata);
            else if ($action == "transfer_device_deployment")
                $data = $this->_transfer_device_deployment($jodata);
            else if ($action == "get_calls_master")
                $data = $this->_get_calls_master($jodata);
            else if ($action == "get_call_reasons")
                $data = $this->_get_call_reasons($jodata);
            else if ($action == "vendor_equipments_expired")
                $data = $this->_vendor_equipments_expired($jodata);
            else if ($action == "insert_multi_contracts")
                $data = $this->_insert_multi_contracts($jodata);
            else if ($action == "get_equp_down_time_list")
                $data = $this->_get_equp_down_time_list($jodata);
            else if ($action == "get_equpiment_history_list")
                $data = $this->_get_equpiment_history_list($jodata);
            else if ($action == "get_hmadmin_call_counts")
                $data = $this->_get_hmadmin_call_counts($jodata);
            else if ($action == "get_same_equps_cat")
                $data = $this->_get_same_equps_cat($jodata);
            else if ($action == "get_equps_by_unit_ecat")
                $data = $this->_get_equps_by_unit_ecat($jodata);
            else if ($action == "get_equps_by_unit_ecat")
                $data = $this->_get_equps_by_unit_ecat($jodata);
            else if ($action == "get_adverse_new_incidents")
                $data = $this->_get_adverse_new_incidents($jodata);
            else if ($action == "get_m_contracts_new")
                $data = $this->_get_m_contracts_new($jodata);
            else if ($action == "get_complete_round_new")
                $data = $this->_get_complete_round_new($jodata);
            else if ($action == "get_scr_calls_new")
                $data = $this->_get_scr_calls_new($jodata);
            else if ($action == "get_undeployed_new_equipments")
                $data = $this->_get_undeployed_new_equipments($jodata);
            else if ($action == "get_generated_calls_new")
                $data = $this->_get_generated_calls_new($jodata);
            else if ($action == "get_mytrans_call_counts_new")
                $data = $this->_get_mytrans_call_counts_new($jodata);
            else if ($action == "get_All_Unit_Counts")
                $data = $this->_get_All_Unit_Counts($jodata);
            else if ($action == "get_equipment")
                $data = $this->_get_equipment($jodata);
            else if($action == "get_conrequest_list")
                $data = $this->_get_conrequest_list($jodata);
            else if($action == "get_org_devices_cnt")
                $data = $this->_get_org_devices_cnt($jodata);
            else if($action == "device_save_deploy")
                $data = $this->save_device($jodata);
            else if($action == "check_cms_call")
                $data = $this->_check_cms_call($jodata);
            else if($action ="org_module")
                $data = $this->_org_module($jodata);
			

            print_r(json_encode($data));
        }
    }

    private function _check_cms_call($jodata){

        $result = $this->basemodel->fetch_single_row($this->cms->tbl_name,array($this->cms->EID => $jodata->device_id));
        if($result){
            $data['response'] = SUCCESSDATA;
        }else{
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

    private function _get_adverse_incidents($jodata=array())
    {
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $data['adverse_approvals_count'] = $this->baselibrary->get_adverse_approvals_count($org_id,YESSTATE);
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;



        $data = $where = array();
        $where[$this->incedents->ORG_ID] = $org_id;
        $where[$this->incedents->COMPLETED_BY] = NULL;
        if($jodata->action=='my_open_calls' || (isset($jodata->aaction) && $jodata->aaction=="get_hod_calls") || (isset($jodata->mine) && $jodata->mine==YESSTATE))
        {
            $where[$this->incedents->ASSIGNED_TO] = $user_id;
        }
        if($jodata->action=='get_not_responded_calls')
        {
            $where[$this->incedents->ASSIGNED_TO] = NULL;
        }
        if(!empty($jodata))
        {
            if (isset($jodata->equp_id) && $jodata->equp_id != "" && $jodata->equp_id != null)
                $where[$this->incedents->EQUP_ID] = $jodata->equp_id;
            if (isset($jodata->itype) && $jodata->itype != "" && $jodata->itype != null)
                $where[$this->incedents->INCIDENT_TYPE] = $jodata->itype;
            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
                $where_date = $this->incedents->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";

            if($branch_id != 'All')
                $where[$this->incedents->BRANCH_ID] = $branch_id;
            else
            {
                $where_date .= ($where_date == '') ? '' : " AND ";
                $where_date .= $this->incedents->BRANCH_ID." IN ". BRANCHALL;
            }
            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls" )
            {
                $swhere[$this->devices->DISTRIBUTOR] = $jodata->vendor_org;
                $swhere[$this->devices->ASSIGN_ID. "!="] = NULL;
                $swhere[$this->devices->ORG_ID] = $jodata->org_id;
                $swhere[$this->devices->BRANCH_ID] = $jodata->branch_id;

                $devices = $this->basemodel->fetch_records_from($this->devices->tbl_name,$swhere,array($this->devices->E_ID));
                // return $this->db->last_query();
                for($i = 0; $i < count($devices); $i++)
                    $device[$i] = "'".$devices[$i]['E_ID']."'";
                if(count($devices) > 0 )
                {
                    $device = '(' . implode($device, ',') . ')';
                    $where_date = $this->incedents->EQUP_ID . " IN " . $device;
                }

                else
                    $where_date = '';

            }

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->incedents->tbl_name, $where, $where_date, 'count('.$this->incedents->ID.') AS CNT');

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

                $add_incedent = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->incedents->tbl_name, $where, $where_date,'','','','', '*',$this->incedents->DATE_OCCRANCE,'DESC','10',$limit_val*10);


                for($i = 0; $i<count($add_incedent); $i++)
                {
                    $where1[$this->devices->E_ID] = $add_incedent[$i]['EQUP_ID'];
                    $devices1 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1,array($this->devices->ASSIGN_ID));


                    if(!empty($devices1)){

                        $add_incedent[$i]['ASSIGN_ID'] = $devices1['ASSIGN_ID'];

                    }

                }


            }
            else
            {

                $add_incedent =  $this->basemodel->awesome_fetch($this->incedents->tbl_name,$where,$where_date);
                for($i = 0; $i<count($add_incedent); $i++)
                {
                    $where1[$this->devices->E_ID] = $add_incedent[$i]['EQUP_ID'];
                    $devices1 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1 , array($this->devices->ASSIGN_ID));

                    if(!empty($devices1)){

                        $add_incedent[$i]['ASSIGN_ID'] = $devices1['ASSIGN_ID'];

                    }

                }

            }



            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }
            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));

            $adverse = array();
            for($i = 0; $i < count($devices); $i++) {

                $bwhere[$this->incedents->ACTION_TACKEN] = NULL;
                $bwhere[$this->incedents->EQUP_ID] = $devices[$i]['ASSIGN_ID'];

                $adverse_incedents = $this->basemodel->fetch_single_row($this->incedents->tbl_name, $bwhere);

                if(!empty($adverse_incedents))
                {

                    $adverse_incedents['ASSIGN_ID'] = $devices[$i]['E_ID'];
                    //$adverse_incedents['ORG_ID'] = $devices[$i]['ORG_ID'];
                    //  $adverse_incedents['BRANCH_ID'] = $devices[$i]['BRANCH_ID'];

                    array_push($adverse,$adverse_incedents);

                }

            }


            if(!empty($adverse) || !empty($add_incedent)){
                $add_incedent = array_merge($add_incedent, $adverse);
                $data['response'] = SUCCESSDATA;
                $data['list'] = $this->baselibrary->adverse_incidents($add_incedent,$role_code,$user_id);
            }else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;

            }


            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls" )
                return $add_incedent;

        }
        return $data;

    }
    private function _get_adverse_incidents_clist($jodata=array())
    {
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
        $data = $where = $add_incedent = array();
        if(!empty($jodata))
        {
            $where[$this->incedents->ORG_ID] = $org_id;
            if($role_code==HBBME)
            {
                $where[$this->incedents->COMPLETED_BY] = $user_id;
            }
            //$where[$this->incedents->ACTION_TACKEN] = NULL;
            if (isset($jodata->equp_id) && $jodata->equp_id != "" && $jodata->equp_id != null)
                $where[$this->incedents->EQUP_ID] = $jodata->equp_id;
            if (isset($jodata->itype) && $jodata->itype != "" && $jodata->itype != null)
                $where[$this->incedents->INCIDENT_TYPE] = $jodata->itype;
            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->incedents->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }
              else
               {
                   $where_date = $this->incedents->COMPLETED_ON . " BETWEEN '" . date('Y-m-d') . " 00:00:00' AND '" . date('Y-m-d') . " 23:59:59'";
               }

            if($branch_id != 'All')
                $where[$this->incedents->BRANCH_ID] = $branch_id;
            else
            {
                $where_date .= ($where_date == '') ? '' : " AND ";
                $where_date .= $this->incedents->BRANCH_ID ." IN ".BRANCHALL;
            }

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->incedents->tbl_name, $where, $where_date, 'count('.$this->incedents->ID.') AS CNT');
                if(!empty($cnt))
                {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT']/10);
                    //print_r($data['rcnt']);
                }
                else
                {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $add_incedent = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->incedents->tbl_name, $where, $where_date,'','','','', '*',$this->incedents->DATE_OCCRANCE,'DESC','10',$limit_val*10);
            }
            else
            {
                $add_incedent= $this->basemodel->fetch_records_from_multi_where($this->incedents->tbl_name,$where,$where_date,'*',$this->incedents->DATE_OCCRANCE,'DESC');
            }
            // return $this->db->last_query();
            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }


            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));

            $adverse = array();
            for($i = 0; $i < count($devices); $i++) {

                $bwhere[$this->incedents->ACTION_TACKEN] = NULL;
                if($role_code==HBBME){
                    $bwhere[$this->incedents->COMPLETED_BY] = $user_id;
                }

                $bwhere[$this->incedents->EQUP_ID] = $devices[$i]['ASSIGN_ID'];
                $bwhere[$this->incedents->ACTION_TACKEN] = NULL;
                $adverse_incedents = $this->basemodel->fetch_single_row($this->incedents->tbl_name, $bwhere);

                if(!empty($adverse_incedents))
                {

                    $adverse_incedents['ASSIGN_ID'] = $devices[$i]['E_ID'];
                    array_push($adverse,$adverse_incedents);
                }

            }

            if(!empty($add_incedent) || !empty($adverse)){
                $add_incedent = array_merge($add_incedent,$adverse);
                //return $add_incedent;
                $data['response'] = SUCCESSDATA;
                for($i=0;$i<count($add_incedent);$i++)
                {
                    $add_incedent[$i]['incidents_type'] = $this->basemodel->get_single_column_value($this->incedenttype->tbl_name,$this->incedenttype->ITYPE,array($this->incedenttype->CODE=>$add_incedent[$i][$this->incedents->INCIDENT_TYPE]));
                    $add_incedent[$i]['location'] = $this->basemodel->get_single_column_value($this->devices->tbl_name,$this->devices->PHY_LOCATION,array($this->devices->E_ID=>$add_incedent[$i][$this->incedents->EQUP_ID]));
                    $add_incedent[$i]['eq_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name,$this->devices->E_NAME,array($this->devices->E_ID=>$add_incedent[$i][$this->incedents->EQUP_ID]));
                }
                $data['list'] = $add_incedent;
                $data['no_of_recs'] = count($add_incedent);
            }else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;

            }


            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls" )
                return $add_incedent;

        }
        return $data;

    }
    private function _get_adverse_new_incidents($jodata=array())
    {
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
        $data = array();
        $where = array();
        if(!empty($jodata))
        {
            $where[$this->incedents->BRANCH_ID] = $branch_id;
            $where[$this->incedents->ORG_ID] = $org_id;
            $where[$this->incedents->COMPLETED_BY] = $user_id;
            if (isset($jodata->dept_id) && $jodata->dept_id!="")
                $where[$this->incedents->DEPT_ID] = $jodata->dept_id;
            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "") {
                $where_date = $this->incedents->COMPLETED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }
            else
            {
                $where[$this->incedents->COMPLETED_ON] = date('Y-m-d');
            }
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->incedents->tbl_name, $where, $where_date, 'count('.$this->incedents->ID.') AS CNT');
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
                $add_incedent =  $this->basemodel->fetch_records_from_multi_where_pagination($this->incedents->tbl_name,$where,$where_date,'*', $this->incedents->ID,'DESC','10',$limit_val*10);
            }
            else
            {
                $add_incedent= $this->basemodel->fetch_records_from_multi_where($this->incedents->tbl_name,$where,$where_date,'*',$this->incedents->ID,'DESC');
            }
            //$data['qry'] = $this->db->last_query();
            if (!empty($add_incedent))
            {
                $data['response'] = SUCCESSDATA;
                $add_incedent = $this->baselibrary->adverse_incidents($add_incedent,$role_code,$user_id);
                $data['list'] = $add_incedent;
                $data['no_of_recs'] = count($add_incedent);
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
    private function _get_branch_devices($jodata)
    {
        $data  = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $where[$this->devices->BRANCH_ID] = $jodata->branch_id;
            $where[$this->devices->EQ_CONDATION] = DW;
            $where[$this->devices->E_ID." !="] = NULL;
            $data['list'] = $this->basemodel->fetch_records_from($this->devices->tbl_name, $where,$this->devices->E_ID,$this->devices->ADDED_ON);
        }
        return $data;
    }
    private function _get_dept_devices($jodata)
    {
        //print_r($jodata);
        $data  = array();
        if (!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_type = isset($jodata->org_type) ? $jodata->org_type : $this->session->org_type;
            $where[$this->devices->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            if (isset($jodata->dept_id) && $jodata->dept_id != "" && $jodata->dept_id != null)
                $where[$this->devices->DEPT_ID] = $jodata->dept_id;
            $where[$this->devices->DEPT_ID . " !="] = NULL;

            $qry = $this->devices->EQ_CONDATION . " IN ('" . DW . "','" . DNW . "' ) ";
            if ($branch_id != 'All') {
                $qry .= " AND ((" . $this->devices->RELOCATION_STATUS . "='" . YESSTATE . "' AND " . $this->devices->BRANCH_RELOCATION . "='" . $branch_id . "') OR " . $this->devices->RELOCATION_STATUS . " is null ) ";
                $qry .= " AND ( " . $this->devices->BRANCH_ID . "='" . $branch_id . "' OR " . $this->devices->BRANCH_RELOCATION . "='" . $branch_id . "') ";
            } else {
                $qry .= " AND ((" . $this->devices->RELOCATION_STATUS . "='" . YESSTATE . "' AND " . $this->devices->BRANCH_RELOCATION . " IN " . BRANCHALL . ") OR " . $this->devices->RELOCATION_STATUS . " is null ) ";
                $qry .= " AND ( " . $this->devices->BRANCH_ID . " IN " . BRANCHALL . " OR " . $this->devices->BRANCH_RELOCATION . " IN " . BRANCHALL . ") ";
            }

            //$where[$this->devices->EQ_CONDATION] = DW;
            $where[$this->devices->E_ID . " !="] = NULL;
            $where[$this->devices->STATUS] = ACT;
            $data['list'] = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name, $where, $qry, $this->devices->E_ID, $this->devices->ADDED_ON);

        }

        return $data;
    }

    private function _get_priority_by_equpmentid($jodata=array()){
        $data=array();
        if(!empty($jodata))
        {
            $where[$this->devices->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->devices->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id:  $this->session->org_id;
            if(isset($jodata->device_id) && $jodata->device_id!="" && $jodata->device_id!=null)
                $where[$this->devices->E_ID] = $jodata->device_id;
            $where[$this->devices->E_CAT." !="] = NULL;
            $list= $this->basemodel->fetch_single_row($this->devices->tbl_name, $where,$this->devices->E_CAT,$this->devices->ADDED_ON);
            if(!empty($list))
            {
                $pwhere[$this->devicenames->ID] = $list[$this->devices->E_CAT];
                $list1=$this->basemodel->fetch_single_row($this->devicenames->tbl_name,$pwhere,$this->devicenames->PRIORITY);
                if(!empty($list1))
                {
                    $data['priority']=$list1[$this->devicenames->PRIORITY];
                    $data['response']=SUCCESSDATA;
                }
                else{
                    $data['response']=EMPTYDATA;
                }
            }
            else{
                $data['response']=EMPTYDATA;
            }
        }
        return $data;
    }
    private  function _update_device($jodata=array())
    {
        /*print_r($jodata);
        die();*/
        $device_update='';
        $data =array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $udata[$this->devices->E_NAME] = $jodata->E_NAME;
            $udata[$this->devices->E_CAT] = $jodata->E_CAT;
            $udata[$this->devices->C_NAME] = $jodata->C_NAME;
            $udata[$this->devices->E_MODEL] = $jodata->E_MODEL;
            $udata[$this->devices->ES_NUMBER] = $jodata->ES_NUMBER;
            $udata[$this->devices->E_COST] = $jodata->E_COST;
            $udata[$this->devices->E_COND] = $jodata->E_COND;
            $udata[$this->devices->UTILIZATION] = $jodata->UTILIZATION;
            $udata[$this->devices->EQ_CLASS] = $jodata->EQ_CLASS;
            $udata[$this->devices->EQ_CONDATION] = $jodata->EQ_CONDATION;
            $udata[$this->devices->ACCSSORIES] = $jodata->ACCSSORIES;
            $udata[$this->devices->CRITICAL_SPARES] = $jodata->CRITICAL_SPARES;
            $udata[$this->devices->E_TYPE] = $jodata->E_TYPE;
            $udata[$this->devices->PHY_LOCATION] = $jodata->PHY_LOCATION;
            $udata[$this->devices->BD_COST] = $jodata->BD_COST;
            $udata[$this->devices->BD_COUNT] = $jodata->BD_COUNT;
            if(isset($jodata->GRN_DATE) && $jodata->GRN_DATE!=null)
                $udata[$this->devices->GRN_DATE] = date('Y-m-d',strtotime($jodata->GRN_DATE));
            else
                $udata[$this->devices->GRN_DATE] = NULL;

            if(isset($jodata->LB_DATE) && $jodata->LB_DATE!=null)
                $udata[$this->devices->LB_DATE] = date('Y-m-d',strtotime($jodata->LB_DATE));
            else
                $udata[$this->devices->LB_DATE] = NULL;
            $udata[$this->devices->GRN_VALUE] = $jodata->GRN_VALUE;

            if(isset($jodata->DATEOF_INSTALL) && $jodata->DATEOF_INSTALL!=null)
                $udata[$this->devices->DATEOF_INSTALL] = date('Y-m-d',strtotime($jodata->DATEOF_INSTALL));
            else
                $udata[$this->devices->DATEOF_INSTALL] = NULL;

            $udata[$this->devices->MF_DATE] = date('m-Y',strtotime($jodata->MF_DATE));
            /*if(isset($jodata->MF_DATE) && $jodata->MF_DATE!=NULL)
            {
                $manufacture_date1 =$jodata->MF_DATE;
                $manf_date = explode("-",$manufacture_date1);
                if($manf_date[0]>12 || $manf_date[1]>date('Y'))
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Invalid Manufacture Date";
                    print_r(json_encode($data));
                    return $data;
                }
            }
            else
            {
                $manufacture_date1 = NULL;
            }*/
            if(isset($jodata->END_OF_LIFE) && $jodata->END_OF_LIFE!=NULL)
            {
                $eol =$jodata->END_OF_LIFE;
                $eol_ary = explode("-",$eol);
                if($eol_ary[0]>12)
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Invalid End of Life Date";
                    print_r(json_encode($data));
                    return $data;
                }
            }
            else
            {
                $eol = NULL;
            }
            if(isset($jodata->END_OF_SUPPORT) && $jodata->END_OF_SUPPORT!=NULL)
            {
                $eos =$jodata->END_OF_SUPPORT;
                $eos_ary = explode("-",$eos);
                if($eos_ary[0]>12)
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Invalid End of Support Date";
                    print_r(json_encode($data));
                    return $data;
                }
            }
            else
            {
                $eos = NULL;
            }
            $udata[$this->devices->MF_DATE] = $manufacture_date1;
            $udata[$this->devices->END_OF_LIFE] = $eol;
            $udata[$this->devices->END_OF_SUPPORT] = $eos;
            $udata[$this->devices->DISTRIBUTOR] =$jodata->DISTRIBUTOR;
            $udata[$this->devices->HOSPITAL_ASSET_CODE] = $jodata->HOSPITAL_ASSET_CODE;
            $udata[$this->devices->REMARKS] = isset($jodata->REMARKS) ? $jodata->REMARKS : NULL;
            $udata[$this->devices->DESC_P] = isset($jodata->DESC_P) ? $jodata->DESC_P : NULL;
            $wdata[$this->devices->E_ID] = $jodata->E_ID;

            /* contract */
            if(isset($jodata->AMC_FROM) && $jodata->AMC_FROM!='')
                $damcdata[$this->deviceamcs->AMC_FROM] = date('Y-m-d', strtotime($jodata->AMC_FROM));
            if(isset($jodata->AMC_TO) && $jodata->AMC_TO!='')
                $damcdata[$this->deviceamcs->AMC_TO] = date('Y-m-d', strtotime($jodata->AMC_TO));
            $damcdata[$this->deviceamcs->AMC_TYPE] = $jodata->AMC_TYPE;
            $damcdata[$this->deviceamcs->AMC_VALUE] = isset($jodata->AMC_VALUE) ? $jodata->AMC_VALUE : NULL;
            $damcdata[$this->deviceamcs->AMC_VENDOR] = $jodata->VENDOR;
            if($jodata->AMC_ID=='new')
            {
                $damcdata[$this->deviceamcs->EID] = $jodata->E_ID;
                $damcdata[$this->deviceamcs->ORG_ID] = $jodata->ORG_ID;
                $damcdata[$this->deviceamcs->BRANCH_ID] = $jodata->BRANCH_ID;
                $damcdata[$this->deviceamcs->ADDED_ON] = date('Y-m-d');
                $damcdata[$this->deviceamcs->ADDED_BY] = $this->session->user_id;
                $damcdata[$this->deviceamcs->REMARKS] = 'added updating device details';
                if(isset($jodata->AMC_TYPE) && $jodata->AMC_TYPE!='')
                {
                    if($this->basemodel->insert_into_table($this->deviceamcs->tbl_name,$damcdata))
                    {
                        $data['amc_inserted'] = SUCCESSDATA;
                    }
                    else
                        $data['amc_inserted'] = FAILEDATA;
                }
            }
            else
            {
                $wamcupdate[$this->deviceamcs->ID] = $jodata->AMC_ID;
                $this->basemodel->update_operation($damcdata,$this->deviceamcs->tbl_name,$wamcupdate);
            }

            /* breakdown */
            if(isset($jodata->last_breakdown_date))
            {
                $udata[$this->dbrkdwns->BD_DATETIME] = date('Y-m-d', strtotime($jodata->last_breakdown_date));
                $udata[$this->dbrkdwns->BD_COST] = $jodata->BD_COST;
                $udata[$this->devices->BD_COUNT] =  $jodata->BD_COUNT;
            }
            if($this->basemodel->update_operation($udata,$this->devices->tbl_name,$wdata))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Equipment Details Updated Successfully";
                if(is_numeric($jodata->PMS_ID))
                {
                    $chk_pval = $this->basemodel->get_single_column_value($this->pmsdetails->tbl_name,$this->pmsdetails->PMS_COUNT,array($this->pmsdetails->ID=>$jodata->PMS_ID));
                    if($chk_pval!=$jodata->PMS_COUNT)
                    {
                        $pms_update[$this->pmsdetails->PMS_DONE] = date('Y-m-d',strtotime($jodata->PMS_DONE));
                        $pms_update[$this->pmsdetails->PMS_COUNT] = $jodata->PMS_COUNT;
                        $pmsval = 30*(12 / $jodata->PMS_COUNT);
                        $pmsdue = date('Y-m-d', strtotime($pms_update[$this->pmsdetails->PMS_DONE]. " + $pmsval days"));
                        $pms_update[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                        if($this->basemodel->update_operation($pms_update,$this->pmsdetails->tbl_name,array($this->pmsdetails->ID=>$jodata->PMS_ID)))
                        {
                            $data['response_pms'] = SUCCESSDATA;
                            $device_update=true;
                        }
                    }
                }

                if(is_numeric($jodata->QC_ID))
                {
                    $chk_qval = $this->basemodel->get_single_column_value($this->qcdetails->tbl_name,$this->qcdetails->QC_COUNT,array($this->qcdetails->ID=>$jodata->QC_ID));
                    $chk_qtype = $this->basemodel->get_single_column_value($this->qcdetails->tbl_name,$this->qcdetails->QC_COUNT_TYPE,array($this->qcdetails->ID=>$jodata->QC_ID));
                    if($chk_qval!=$jodata->QC_COUNT || $chk_qtype!=$jodata->QC_COUNT_TYPE)
                    {
                        $qc_update[$this->qcdetails->QC_COUNT] = $no_of_qcs = $jodata->QC_COUNT;
                        $qc_update[$this->qcdetails->QC_DONE] =  date('Y-m-d',strtotime($jodata->QC_DONE));
                        $qc_update[$this->qcdetails->QC_COUNT_TYPE] =  $jodata->QC_COUNT_TYPE;
                        if($jodata->QC_COUNT_TYPE=='Month')
                            $qcval = 30*(12 / $no_of_qcs);
                        else if($jodata->QC_COUNT_TYPE=='Year')
                            $qcval = ceil(365*(1 / $no_of_qcs));
                        $qcdue = date('Y-m-d', strtotime($qc_update[$this->qcdetails->QC_DONE]. " + $qcval days"));
                        $qc_update[$this->qcdetails->QC_DUE] = $qcdue;
                        if($this->basemodel->update_operation($qc_update,$this->qcdetails->tbl_name,array($this->qcdetails->ID=>$jodata->QC_ID)))
                        {
                            $data['response_qc'] = SUCCESSDATA;

                        }
                    }
                }


                if($device_update)
                {
                    $where[$this->deviceamcs->BD_DATETIME]=$jodata->ID;
                    $amc_update[$this->deviceamcs->AMC_FROM] = date('Y-m-d',strtotime($jodata->AMC_FROM));
                    $amc_update[$this->deviceamcs->AMC_TO] = date('Y-m-d',strtotime($jodata->AMC_TO));
                    $amc_update[$this->deviceamcs->AMC_VALUE] = $jodata->AMC_VALUE;
                    $amc_update[$this->deviceamcs->AMC_VENDOR] = $jodata->AMC_VENDOR;
                    $amc_update[$this->deviceamcs->AMC_TYPE] = $jodata->AMC_VENDOR;
                    if($this->basemodel->update_operation($amc_update,$this->deviceamcs->tbl_name,$where))
                    {
                        $data['response_deviceamc'] = SUCCESSDATA;
                    }
                }
                if($device_update)
                {
                    $where[$this->dbrkdwns->BD_DATETIME]=$jodata->ID;
                    $brkdwn_update[$this->dbrkdwns->BD_DATETIME] = date('Y-m-d',strtotime($jodata->BD_DATETIME));
                    $brkdwn_update[$this->dbrkdwns->BD_COST] = $jodata->BD_COST;
                    $brkdwn_update[$this->dbrkdwns->BD_COUNT] = $jodata->BD_COUNT;
                    if($this->basemodel->update_operation($brkdwn_update,$this->dbrkdwns->tbl_name,$where))
                    {
                        $data['response_devicebrkdwn'] = SUCCESSDATA;
                    }
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable to Update Details, Try Again";
            }
        }
        return $data;
    }
    /* update device public */
    public function update_device()
    {
        if(isset($_POST['device_data']))
        {
            $device_update='';
            $data =array();
            $jodata = json_decode($_POST['device_data']);
            $udata[$this->devices->E_NAME] = $jodata->E_NAME;
            $udata[$this->devices->E_CAT] = $jodata->E_CAT;
            $cat=$this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->CODE,array($this->devicenames->ID=>$udata[$this->devices->E_CAT]));
            $udata[$this->devices->C_NAME] = $jodata->C_NAME;
            $udata[$this->devices->E_MODEL] = $jodata->E_MODEL;
            $udata[$this->devices->ES_NUMBER] = $jodata->ES_NUMBER;
            $udata[$this->devices->E_COST] = $jodata->E_COST;
            $udata[$this->devices->E_COND] = $jodata->E_COND;
            $udata[$this->devices->UTILIZATION] = $jodata->UTILIZATION;
            $udata[$this->devices->EQ_CLASS] = $jodata->EQ_CLASS;
            $udata[$this->devices->EQ_CONDATION] = $jodata->EQ_CONDATION;
            $udata[$this->devices->ACCSSORIES] = $jodata->ACCSSORIES;
            $udata[$this->devices->CRITICAL_SPARES] = $jodata->CRITICAL_SPARES;
            $udata[$this->devices->E_TYPE] = $jodata->E_TYPE;
            $udata[$this->devices->PHY_LOCATION] = $jodata->PHY_LOCATION;
            $udata[$this->devices->BD_COST] = $jodata->BD_COST;
            $udata[$this->devices->BD_COUNT] = $jodata->BD_COUNT;
            $udata[$this->devices->DEPT_ID] = $jodata->dept_id;
            $udata[$this->devices->PONO] = $jodata->PONO;
            $udata[$this->devices->PDATE] = $jodata->PDATE;
            $udata[$this->devices->UPDATED_ON] = date('Y-m-d H:i:s');
            if($jodata->UPLOAD_PATH==NULL)
                $udata[$this->devices->UPLOAD_PATH] =  $jodata->ES_NUMBER;
            if(isset($jodata->GRN_DATE) && $jodata->GRN_DATE!=null)
                $udata[$this->devices->GRN_DATE] = date('Y-m-d',strtotime($jodata->GRN_DATE));
            else
                $udata[$this->devices->GRN_DATE] = NULL;

            if(isset($jodata->LB_DATE) && $jodata->LB_DATE!=null)
                $udata[$this->devices->LB_DATE] = date('Y-m-d',strtotime($jodata->LB_DATE));
            else
                $udata[$this->devices->LB_DATE] = NULL;
            $udata[$this->devices->GRN_VALUE] = $jodata->GRN_VALUE;

            if(isset($jodata->DATEOF_INSTALL) && $jodata->DATEOF_INSTALL!=null)
                $udata[$this->devices->DATEOF_INSTALL] = date('Y-m-d',strtotime($jodata->DATEOF_INSTALL));
            else
                $udata[$this->devices->DATEOF_INSTALL] = NULL;

            /* if(isset($jodata->MF_DATE) && $jodata->MF_DATE!=NULL)
             {
                 $manufacture_date1 =$jodata->MF_DATE;
                 /*$manf_date = explode("-",$manufacture_date1);
                 if($manf_date[0]>12 || $manf_date[1]>date('Y'))
                 {
                     $data['response'] = FAILEDATA;
                     $data['call_back'] = "Invalid Manufacture Date";
                     print_r(json_encode($data));
                     return false;
                 }
             }
             else
             {
                 $manufacture_date1 = NULL;
             }*/
            if(isset($jodata->END_OF_LIFE) && $jodata->END_OF_LIFE!=NULL)
            {
                $eol =$jodata->END_OF_LIFE;
                $eol_ary = explode("-",$eol);
                if($eol_ary[0]>12)
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Invalid End of Life Date";
                    print_r(json_encode($data));
                    return false;
                }
            }
            else
            {
                $eol = NULL;
            }
            if(isset($jodata->END_OF_SUPPORT) && $jodata->END_OF_SUPPORT!=NULL)
            {
                $eos =$jodata->END_OF_SUPPORT;
                $eos_ary = explode("-",$eos);
                if($eos_ary[0]>12)
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Invalid End of Support Date";
                    print_r(json_encode($data));
                    return false;
                }
            }
            else
            {
                $eos = NULL;
            }
            $udata[$this->devices->MF_DATE] = $jodata->MF_DATE;           // $manufacture_date1;
            $udata[$this->devices->END_OF_LIFE] = $eol;
            $udata[$this->devices->END_OF_SUPPORT] = $eos;
            $udata[$this->devices->DISTRIBUTOR] =$jodata->DISTRIBUTOR;
            $udata[$this->devices->HOSPITAL_ASSET_CODE] = $jodata->HOSPITAL_ASSET_CODE;
            $udata[$this->devices->REMARKS] = isset($jodata->REMARKS) ? $jodata->REMARKS : NULL;
            $udata[$this->devices->DESC_P] = isset($jodata->DESC_P) ? $jodata->DESC_P : NULL;
            $udata[$this->devices->E_ID] = $jodata->E_ID;
            $branch_dtls = $this->basemodel->fetch_single_row($this->branches->tbl_name, array($this->branches->BRANCH_ID => $this->session->branch_id));
            if($jodata->E_ID==null || $jodata->E_ID=="")
            {
                /* device Id gen. */
                $qry = "SELECT ".$this->devices->E_ID." FROM ".$this->db->dbprefix($this->devices->tbl_name)." WHERE ".$this->devices->ORG_ID." = '".$this->session->org_id."' AND ".$this->devices->E_ID." LIKE '".$branch_dtls[$this->branches->CITY]."-___-____-".$branch_dtls[$this->branches->BRANCH_CODE]."-%-___-____' ORDER BY Right(".$this->devices->E_ID.",4) DESC";
                $devices = $this->basemodel->execute_qry($qry);
                if(!empty($devices))
                {
                    $device = $devices[0];
                    $eid=$device[$this->devices->E_ID];
                    $data['last_equp'] = $eid;
                    $number_array=explode("-",$eid);
                    $number = end($number_array);
                    $number = (int)$number;
                    $number = $number+1;
                }
                else
                    $number=1;
                $len = strlen($number);
                if($len==1)
                    $elast_id="000".$number;
                else if($len==2)
                    $elast_id="00".$number;
                else if($len==3)
                    $elast_id="0".$number;
                else
                    $elast_id=$number;

                $main_device_id =  $branch_dtls[$this->branches->CITY]."-"."BME"."-".date('my',strtotime($udata[$this->devices->DATEOF_INSTALL]))."-".$branch_dtls[$this->branches->BRANCH_CODE]."-".$udata[$this->devices->DEPT_ID]."-".$cat."-".$elast_id;
                $udata[$this->devices->E_ID] = $main_device_id;
                /* Device Id Gen. End */
            }
            $udata[$this->devices->QR_CODE] = QR_URL.$udata[$this->devices->E_ID];
            $wdata[$this->devices->ID] = $jodata->ID;

            /* contract */
            if($jodata->AMC_TYPE!='Biomedical')
            {
                if(isset($jodata->AMC_FROM) && $jodata->AMC_FROM!='')
                    $damcdata[$this->deviceamcs->AMC_FROM] = date('Y-m-d', strtotime($jodata->AMC_FROM));
                if(isset($jodata->AMC_TO) && $jodata->AMC_TO!='')
                    $damcdata[$this->deviceamcs->AMC_TO] = date('Y-m-d', strtotime($jodata->AMC_TO));
                $damcdata[$this->deviceamcs->AMC_VALUE] = isset($jodata->AMC_VALUE) ? $jodata->AMC_VALUE : NULL;
                $damcdata[$this->deviceamcs->AMC_VENDOR] = $jodata->VENDOR;
            }
            else
            {
                $damcdata[$this->deviceamcs->AMC_FROM] = NULL;
                $damcdata[$this->deviceamcs->AMC_TO] = NULL;
                $damcdata[$this->deviceamcs->AMC_VALUE] = NULL;
                $damcdata[$this->deviceamcs->AMC_VENDOR] = NULL;
            }
            $damcdata[$this->deviceamcs->AMC_TYPE] = $jodata->AMC_TYPE;
            $damcdata[$this->deviceamcs->EID] = $udata[$this->devices->E_ID];
            if($jodata->AMC_ID=='new')
            {
                $damcdata[$this->deviceamcs->ORG_ID] = $jodata->ORG_ID;
                $damcdata[$this->deviceamcs->BRANCH_ID] = $jodata->BRANCH_ID;
                $damcdata[$this->deviceamcs->ADDED_ON] = date('Y-m-d');
                $damcdata[$this->deviceamcs->ADDED_BY] = $this->session->user_id;
                $damcdata[$this->deviceamcs->REMARKS] = 'added updating device details';
                if(isset($jodata->AMC_TYPE) && $jodata->AMC_TYPE!='')
                {
                    if($this->basemodel->insert_into_table($this->deviceamcs->tbl_name,$damcdata))
                    {
                        $data['amc_inserted'] = SUCCESSDATA;
                    }
                    else
                        $data['amc_inserted'] = FAILEDATA;
                }
            }
            else
            {
                $wamcupdate[$this->deviceamcs->ID] = $jodata->AMC_ID;
                $this->basemodel->update_operation($damcdata,$this->deviceamcs->tbl_name,$wamcupdate);
            }

            $amctodevice[$this->devices->C_FROM] = $damcdata[$this->deviceamcs->AMC_FROM];
            $amctodevice[$this->devices->C_TO] =$damcdata[$this->deviceamcs->AMC_TO];
            $amctodevice[$this->devices->AMC_TYPE] = $jodata->AMC_TYPE;
            $amctodevice[$this->devices->AMC_VALUE] = $jodata->AMC_VALUE;
            $amctodevice[$this->devices->VENDOR] = $jodata->VENDOR;

            $wamctodevice[$this->devices->E_ID] = $jodata->E_ID;
            $wamctodevice[$this->devices->ORG_ID] = $jodata->ORG_ID;
            $wamctodevice[$this->devices->BRANCH_ID] = $jodata->BRANCH_ID;
            $this->basemodel->update_operation($amctodevice,$this->devices->tbl_name,$wamctodevice);

            $check_dept_exists_for_round = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->DEPT_ID=>$udata[$this->devices->DEPT_ID],$this->devices->BRANCH_ID=>$this->session->branch_id,$this->devices->ORG_ID=>$this->session->org_id),$this->devices->DEPT_ID);
            if($this->basemodel->update_operation($udata,$this->devices->tbl_name,$wdata))
            {
                if(empty($check_dept_exists_for_round))
                {
                    $data['users_rounds'] = $this->baselibrary->assign_round_new_dept($this->session->org_id,$this->session->branch_id,$udata[$this->devices->DEPT_ID]);
                }
                $device_update=true;
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Equipment(".$udata[$this->devices->E_ID].") Details Updated Successfully";
                $pms_update[$this->pmsdetails->EID] = $udata[$this->devices->E_ID];
                $pms_update[$this->pmsdetails->PMS_DONE] = date('Y-m-d',strtotime($jodata->PMS_DONE));
                $pms_update[$this->pmsdetails->PMS_COUNT] = $jodata->PMS_COUNT;
                $pmsval = 30*(12 / $jodata->PMS_COUNT);
                $pmsdue = date('Y-m-d', strtotime($pms_update[$this->pmsdetails->PMS_DONE]. " + $pmsval days"));
                $pms_update[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                $pms_update[$this->pmsdetails->ORG_ID] = $jodata->ORG_ID;
                $pms_update[$this->pmsdetails->BRANCH_ID] = $jodata->BRANCH_ID;
                if($jodata->PMS_ID!="new")
                {
                    $chk_pval = $this->basemodel->get_single_column_value($this->pmsdetails->tbl_name,$this->pmsdetails->PMS_COUNT,array($this->pmsdetails->ID=>$jodata->PMS_ID));
                    /*if($chk_pval!=$jodata->PMS_COUNT)
                    {*/
                    if($this->basemodel->update_operation($pms_update,$this->pmsdetails->tbl_name,array($this->pmsdetails->ID=>$jodata->PMS_ID)))
                    {
                        $data['response_pms'] = SUCCESSDATA;
                    }
                    /*}*/
                }
                else
                {
                    $pms_update[$this->pmsdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE]."-".$damcdata[$this->deviceamcs->AMC_TYPE][0]."P-".date('my')."-".$this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->pmsdetails->tbl_name,$this->pmsdetails->ID));
                    if($this->basemodel->insert_into_table($this->pmsdetails->tbl_name,$pms_update))
                    {
                        $data['response_pms'] = SUCCESSDATA;
                    }
                }

                $qc_update[$this->qcdetails->ORG_ID] = $jodata->ORG_ID;
                $qc_update[$this->qcdetails->BRANCH_ID] = $jodata->BRANCH_ID;
                $qc_update[$this->qcdetails->EID] = $udata[$this->devices->E_ID];
                if($jodata->QC_COUNT!=0)
                {
                    $qc_update[$this->qcdetails->QC_COUNT] = $no_of_qcs = $jodata->QC_COUNT;
                    $qc_update[$this->qcdetails->QC_DONE] =  date('Y-m-d',strtotime($jodata->QC_DONE));
                    $qc_update[$this->qcdetails->QC_COUNT_TYPE] =  $jodata->QC_COUNT_TYPE;
                    if($jodata->QC_COUNT_TYPE=='Month')
                        $qcval = 30*(12 / $no_of_qcs);
                    else if($jodata->QC_COUNT_TYPE=='Year')
                        $qcval = ceil(365*(1 / $no_of_qcs));
                    $qcdue = date('Y-m-d', strtotime($qc_update[$this->qcdetails->QC_DONE]. " + $qcval days"));
                    $qc_update[$this->qcdetails->QC_DUE] = $qcdue;
                }
                else
                {
                    $qc_update[$this->qcdetails->QC_COUNT] =$jodata->QC_COUNT;
                    $qc_update[$this->qcdetails->QC_DONE] = NULL;
                    $qc_update[$this->qcdetails->QC_DUE] = NULL;
                }
                if($jodata->QC_ID!="new")
                {
                    if($this->basemodel->update_operation($qc_update,$this->qcdetails->tbl_name,array($this->qcdetails->ID=>$jodata->QC_ID)))
                    {
                        $data['response_qc'] = SUCCESSDATA;

                    }
                }
                else
                {
                    $qc_update[$this->qcdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE]."-".$damcdata[$this->deviceamcs->AMC_TYPE][0]."Q-".date('my')."-".$this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->qcdetails->tbl_name,$this->qcdetails->ID));
                    if($this->basemodel->insert_into_table($this->qcdetails->tbl_name,$qc_update))
                    {
                        $data['response_qc'] = SUCCESSDATA;
                    }
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable to Update Details, Try Again";
            }
            if(count($_FILES)>0)
            {
                $uploaded = $not_uploaded =0;
                for($f=0;$f<count($_FILES);$f++)
                {
                    $f_type = explode(".",$_FILES[$f]['name']);
                    $last_in = (count($f_type)-1);
                    $upload_device_folder = $jodata->UPLOAD_PATH==NULL ? $udata[$this->devices->UPLOAD_PATH] : $jodata->UPLOAD_PATH;
                    $config['upload_path'] = DEVICE_UPLOAD_PATH.$upload_device_folder;
                    $config['allowed_types'] = '*';
                    $time=time();
                    $config['file_name'] = $f_type[0]."_".$time;
                    if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload($f))
                        $uploaded++;
                    else
                    {
                        $not_uploaded++;
                        $response['uploaded_files_errors'][] = $this->upload->display_errors();
                    }
                }
                $response['uploaded_files'] = $uploaded;
                $response['not_uploaded_files'] = $not_uploaded;
                $this->basemodel->update_operation(array($this->devices->UPLOAD_PATH=>$upload_device_folder),$this->devices->tbl_name,array($this->devices->ID=>$jodata->ID));
            }
            print_r(json_encode($data));
            return true;
        }
        else
        {
            return false;
        }
    }
    private  function _my_open_calls($jodata=array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $where = array();
            $where[$this->cms->ORG_ID] = $org_id;
            $where[$this->cms->TO_ADVERSE] = NULL;
            $where[$this->cms->BRANCH_ID] = $branch_id;
            if($role_code!='')
            {
                if($role_code==HBBME || (isset($jodata->mine) && $jodata->mine==YESSTATE))
                    $where[$this->cms->RESPONDED_BY] = $user_id;
            }
            else
            {
                $where[$this->cms->RESPONDED_BY] = $user_id;
            }
            $where[$this->cms->ASSIGNED_TO] = NULL;
            $where[$this->cms->ATTENDED_BY] = NULL;
            $where[$this->cms->RESPONDED_BY." !="] = NULL;
            $where[$this->cms->STATUS] = DNW;

            $respnd_calls	= $this->basemodel->fetch_records_from($this->cms->tbl_name,$where,'*',$this->cms->RESPONDED_DATE,'DESC');
            // $data['responded_calls'] = $respnd_calls;
            //return $this->db->last_query();
            //$data['responded_qry'][] = $this->db->last_query();
            $data['responded_calls'] = $this->baselibrary->cms_call_details($respnd_calls,'responded',$role_code,$user_id);
            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $swhere[$this->devices->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));

            $cms = array();
            // $cms_count = array();
            for($i = 0; $i < count($devices); $i++) {

                $bwhere[$this->cms->STATUS . " !="] = DW;
                $bwhere[$this->cms->RESPONDED_DATE."!="] = NULL;
                $bwhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];

                $call_res = $this->basemodel->fetch_single_row($this->cms->tbl_name, $bwhere);

                if(!empty($call_res))
                {

                    $call_res['ASSIGN_ID'] = $devices[$i]['E_ID'];

                    array_push($cms,$call_res);

                }


            }

            if(!empty($cms))
                $respnd_calls = array_merge($respnd_calls, $cms);
            $data['responded_calls'] = $this->baselibrary->cms_call_details($respnd_calls,'responded',$role_code,$user_id);

            unset($where[$this->cms->RESPONDED_BY]);
            unset($where[$this->cms->RESPONDED_BY." !="]);
            unset($where[$this->cms->ASSIGNED_TO]);
            if($role_code!='')
            {
                if($role_code==HBBME || (isset($jodata->mine) && $jodata->mine==YESSTATE))
                {
                    $where[$this->cms->ASSIGNED_TO] = $user_id;
                }
            }
            else
            {
                $where[$this->cms->ASSIGNED_TO] = $user_id;
            }
            $where[$this->cms->ASSIGNED_TO." !="] = NULL;
            // $data['assigned_calls']
            $assigned_cals = $this->basemodel->fetch_records_from($this->cms->tbl_name, $where, '*',$this->cms->ASSIGNED_ON, 'DESC');

            //$data['assigned_qry'][] = $this->db->last_query();
            $data['assigned_calls'] = $this->baselibrary->cms_call_details($assigned_cals,'assigned',$role_code,$user_id);

            $twhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $twhere[$this->devices->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $twhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices1 = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$twhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));
            //return $devices;
            $cms1 = array();
            // $cms_count = array();
            for($i = 0; $i < count($devices1); $i++) {

                $qwhere[$this->cms->STATUS] = DNW;
                $qwhere[$this->cms->ATTENDED_BY] = NULL;
                $qwhere[$this->cms->RESPONDED_BY."!="] = NULL;
                $qwhere[$this->cms->EID] = $devices1[$i]['ASSIGN_ID'];

                $call_res1 = $this->basemodel->fetch_single_row($this->cms->tbl_name, $qwhere);
                // return $this->db->last_query();
                if(!empty($call_res1))
                {

                    $call_res1['ASSIGN_ID'] = $devices1[$i]['E_ID'];

                    array_push($cms1,$call_res1);

                }


            }

            if(!empty($cms1))
                $assigned_cals = array_merge($assigned_cals, $cms1);
            $data['assigned_calls'] = $this->baselibrary->cms_call_details($assigned_cals,'assigned',$role_code,$user_id);


            if($jodata->action=='assigned_responded_calls')
            {
                return $data;
            }
            unset($where[$this->cms->ATTENDED_BY]);
            unset($where[$this->cms->ASSIGNED_TO." !="]);
            if($role_code!='')
            {
                if($role_code==HBBME)
                {
                    $where[$this->cms->ATTENDED_BY] = $user_id;
                }
            }
            else
            {
                $where[$this->cms->ATTENDED_BY] = $user_id;
            }

            $where[$this->cms->PENDING_REASON] = NULL;
            $where[$this->cms->ATTENDED_BY." !="] = NULL;

            $attended_calls = $this->basemodel->fetch_records_from($this->cms->tbl_name,$where,'*',$this->cms->ATTENDED_DATE,'DESC');

            $data['attended_calls'] = $this->baselibrary->cms_call_details($attended_calls,'attended',$role_code,$user_id);


            $atwhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $atwhere[$this->devices->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $atwhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices_attend = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$atwhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));



            $cms2 = array();
            // $cms_count = array();
            for($i = 0; $i < count($devices_attend); $i++) {


                $qewhere[$this->cms->EID] = $devices_attend[$i]['ASSIGN_ID'];
                $qewhere[$this->cms->PENDING_REASON] = NULL;
                $qewhere[$this->cms->ATTENDED_BY." !="] = NULL;

                $call_res4 = $this->basemodel->fetch_single_row($this->cms->tbl_name, $qewhere);
                // return $this->db->last_query();
                if(!empty($call_res1))
                {

                    $call_res4['ASSIGN_ID'] = $devices_attend[$i]['E_ID'];

                    array_push($cms2,$call_res4);

                }


            }


            if(!empty($cms2))
                $attended_calls = array_merge($attended_calls, $cms2);
            $data['attended_calls'] = $this->baselibrary->cms_call_details($attended_calls,'attended',$role_code,$user_id);


            //$data['qry'][] = $this->db->last_query();
            unset($where[$this->cms->PENDING_REASON]);
            unset($where[$this->cms->ASSIGNED_TO]);
            $where[$this->cms->PENDING_REASON." !="] = NULL;
            $where[$this->cms->STATUS] = UMAINTENCE;
            $pending_calls  = $this->basemodel->fetch_records_from($this->cms->tbl_name,$where,'*',$this->cms->ATTENDED_DATE,'DESC');

            $data['pending_calls'] = $this->baselibrary->cms_call_details($pending_calls,'pending',$role_code,$user_id);



            $apwhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $apwhere[$this->devices->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $apwhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices_pending = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$apwhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));



            $cms3 = array();
            // $cms_count = array();
            for($i = 0; $i < count($devices_pending); $i++) {


                $qwwhere[$this->cms->EID] = $devices_pending[$i]['ASSIGN_ID'];
                $qwwhere[$this->cms->PENDING_REASON." !="] = NULL;
                $qwwhere[$this->cms->STATUS] = UMAINTENCE;

                $call_res5 = $this->basemodel->fetch_single_row($this->cms->tbl_name, $qwwhere);
                // return $this->db->last_query();
                if(!empty($call_res5))
                {

                    $call_res5['ASSIGN_ID'] = $devices_attend[$i]['E_ID'];

                    array_push($cms3,$call_res5);

                }


            }


            if(!empty($cms3))
                $pending_calls = array_merge($pending_calls, $cms3);
            $data['pending_calls'] = $this->baselibrary->cms_call_details($pending_calls,'pending',$role_code,$user_id);


            //$data['qry'][] = $this->db->last_query();
            $pending_pms = $this->_get_pending_bmepms($jodata);
            if(isset($pending_pms['pending_pms']))
                $data['pending_pms'] = $pending_pms['pending_pms'];
            else
                $data['pending_pms'] = array();

            $pending_qc = $this->_get_pending_bmeqc($jodata);
            if(isset($pending_qc['pending_qc']))
                $data['pending_qc'] = $pending_qc['pending_qc'];
            else
                $data['pending_qc'] = array();
            $assigned_rounds = $this->_get_assigned_round($jodata);
            if(!empty($assigned_rounds) &&  $assigned_rounds['response']==EMPTYDATA)
                $data['rounds'] = array();
            else
                $data['rounds'] = $assigned_rounds['list'];
            $data['attended_calls'] = $this->baselibrary->cms_call_details($data['attended_calls'],'attended',$role_code,$user_id);
            $data['pending_calls'] = $this->baselibrary->cms_call_details($data['pending_calls'],'pending',$role_code,$user_id);
            $adverse_incidents = $this->_get_adverse_incidents($jodata);
            if(!empty($adverse_incidents) && $adverse_incidents['response']==SUCCESSDATA)
            {
                $data['adverse_incedents'] = $adverse_incidents['list'];
            }
            else
            {
                $data['adverse_incedents'] = array();
            }



        }
        return $data;
    }
    private  function _open_calls($jodata=array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $where = array();
            $where[$this->cms->ORG_ID] = $org_id;
            $where[$this->cms->TO_ADVERSE] = NULL;
            // $where[$this->cms->BRANCH_ID] = $branch_id;
            if($branch_id != 'All')
                $swhere[$this->cms->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->cms->BRANCH_ID ." IN ".BRANCHALL;
            }

            $where[$this->cms->STATUS] = DNW;
            $where[$this->cms->RESPONDED_BY] = NULL;
            $open_calls = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name,$where,$orr_where,'*',$this->cms->RESPONDED_DATE,'DESC');
            $data['open_calls'] = $this->baselibrary->cms_call_details($open_calls);
            $data['qry']['open_calls'] = $this->db->last_query();
            unset($where[$this->cms->RESPONDED_BY]);

            $where[$this->cms->ASSIGNED_TO] = NULL;
            $where[$this->cms->ATTENDED_BY] = NULL;
            $where[$this->cms->RESPONDED_BY." !="] = NULL;
            if((isset($jodata->mine) && $jodata->mine==YESSTATE) || $role_code==HBBME)
            {
                $where[$this->cms->RESPONDED_BY] = $user_id;
            }
            $data['responded_calls'] = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name,$where,$orr_where,'*',$this->cms->RESPONDED_DATE,'DESC');
            $data['qry']['responded_calls'] = $this->db->last_query();
            $data['responded_calls'] = $this->baselibrary->cms_call_details($data['responded_calls'],'responded',$role_code,$user_id);
            unset($where[$this->cms->RESPONDED_BY]);
            unset($where[$this->cms->RESPONDED_BY." !="]);
            unset($where[$this->cms->ASSIGNED_TO]);
            unset($where[$this->cms->ATTENDED_BY]);
            $where[$this->cms->ATTENDED_BY] = NULL;
            $where[$this->cms->ASSIGNED_TO." !="] = NULL;
            if((isset($jodata->mine) && $jodata->mine==YESSTATE) || $role_code==HBBME)
            {
                $where[$this->cms->ASSIGNED_TO] = $user_id;
            }
            $data['assigned_calls'] = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name, $where,$orr_where,'*',$this->cms->ASSIGNED_ON, 'DESC');
            $data['qry']['assigned_calls'] = $this->db->last_query();
            $data['assigned_calls'] = $this->baselibrary->cms_call_details($data['assigned_calls'],'assigned',$role_code,$user_id);
            unset($where[$this->cms->ATTENDED_BY]);
            unset($where[$this->cms->ASSIGNED_TO." !="]);
            $where[$this->cms->PENDING_REASON] = NULL;
            $where[$this->cms->ATTENDED_BY." !="] = NULL;
            if((isset($jodata->mine) && $jodata->mine==YESSTATE) || $role_code==HBBME)
            {
                unset($where[$this->cms->ASSIGNED_TO]);
                $where[$this->cms->ATTENDED_BY] = $user_id;
            }
            $data['attended_calls'] = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name,$where,$orr_where,'*',$this->cms->ATTENDED_DATE,'DESC');
            $data['qry']['attended_calls'] = $this->db->last_query();
            unset($where[$this->cms->PENDING_REASON]);
            unset($where[$this->cms->ASSIGNED_TO]);
            $where[$this->cms->PENDING_REASON." !="] = NULL;
            $where[$this->cms->STATUS] = UMAINTENCE;
            if((isset($jodata->mine) && $jodata->mine==YESSTATE) || $role_code==HBBME)
            {
                $where[$this->cms->ATTENDED_BY] = $user_id;
            }
            $data['pending_calls'] = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name,$where,$orr_where,'*',$this->cms->ATTENDED_DATE,'DESC');
            $data['qry']['pending_calls'] = $this->db->last_query();
            /*  $pending_pms = $this->_get_pending_bmepms($jodata);
              if(isset($pending_pms['pending_pms']))
                  $data['pending_pms'] = $pending_pms['pending_pms'];
              else
                  $data['pending_pms'] = array();

              $pending_qc = $this->_get_pending_bmeqc($jodata);
              if(isset($pending_qc['pending_qc']))
                  $data['pending_qc'] = $pending_qc['pending_qc'];
              else
                  $data['pending_qc'] = array();
              $assigned_rounds = $this->_get_assigned_round($jodata);
              if(!empty($assigned_rounds) &&  $assigned_rounds['response']==EMPTYDATA)
                  $data['rounds'] = array();
              else
                  $data['rounds'] = $assigned_rounds['list'];*/
            $data['attended_calls'] = $this->baselibrary->cms_call_details($data['attended_calls'],'attended',$role_code,$user_id);
            $data['pending_calls'] = $this->baselibrary->cms_call_details($data['pending_calls'],'pending',$role_code,$user_id);
            $adverse_incidents = $this->_get_adverse_incidents($jodata);
            if(!empty($adverse_incidents) && $adverse_incidents['response']==SUCCESSDATA)
            {
                $data['adverse_incedents'] = $adverse_incidents['list'];
            }
            else
            {
                $data['adverse_incedents'] = array();
            }
        }
        return $data;
    }

    private function _my_closed_calls($jodata=array())
    {
        $data=array();
        if(!empty($jodata))
        {
            $pdata = $this->_get_completed_bmepms($jodata);
            if($pdata['response']==SUCCESSDATA)
            {
                $data['completed_pms'] = $pdata['completed_pms'];
                $data['completed_pms_response'] = $pdata['response'];
            }
            else
            {
                $data['completed_pms'] = array();
                $data['completed_pms_response'] = $pdata['response'];
            }
            $qdata = $this->_get_completed_bmeqcs($jodata);
            if($qdata['response']==SUCCESSDATA)
            {
                $data['completed_qcs'] = $qdata['completed_qcs'];
                $data['completed_qcs_response'] = $qdata['response'];
            }
            else
            {
                $data['completed_qcs'] = array();
                $data['completed_qcs_response'] = $qdata['response'];
            }
            $cms_data = $this->_get_complete_bmecalls($jodata);
            if($cms_data['response']==SUCCESSDATA)
            {
                $data['completed_calls'] = $cms_data['completed_calls'];
                $data['completed_calls_response'] = $cms_data['response'];
            }
            else
            {
                $data['completed_calls'] = array();
                $data['completed_calls_response'] = $cms_data['response'];
            }
            $rounds = $this->_get_complete_round($jodata);
            if($rounds['response']==SUCCESSDATA)
            {
                $data['completed_rounds'] = $rounds['list'];
                $data['completed_rounds_response'] = $rounds['response'];
            }
            else
            {
                $data['completed_rounds'] = array();
                $data['completed_rounds_response'] = $rounds['response'];
            }

            $cincidents = $this->_get_adverse_incidents_clist($jodata);
            if($cincidents['response']==SUCCESSDATA)
            {
                $data['completed_advs'] = $cincidents['list'];
                $data['completed_advs_response'] = $cincidents['response'];
            }
            else
            {
                $data['completed_advs'] = array();
                $data['completed_advs_response'] = $cincidents['response'];
            }
        }
        return $data;
    }

    private function _assigned_responded_calls($jodata=array())
    {
        $data = $this->_my_open_calls($jodata);
        if(empty($data['responded_calls']) && empty($data['assigned_calls']))
        {
            $data['response'] = EMPTYDATA;
        }
        else
        {
            $data['response'] = SUCCESSDATA;
        }
        return $data;
    }
    private function _assigned_calls($jodata=array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where = array();
            $where[$this->cms->TO_ADVERSE] = NULL;
            if(isset($jodata->department) && $jodata->department != "")
                $where[$this->cms->CALLER_DEPT] = $jodata->department;
            if(isset($jodata->eqpid) && $jodata->eqpid != "")
                $where[$this->cms->EID] = $jodata->eqpid;
            if($jodata->action=='assigned_calls_hod')
                $where[$this->cms->ASSIGNED_TO." !="] = NULL;
            else
                $where[$this->cms->ASSIGNED_TO] = $user_id;
            $where[$this->cms->ATTENDED_BY] = NULL;
            $where[$this->cms->PENDING_REASON] = NULL;
            $where[$this->cms->ORG_ID] = $org_id;
            $where[$this->cms->BRANCH_ID] = $branch_id;
            $where_in[$this->cms->STATUS . " !="] = DW;
            $where_date = '';
            if ($jodata->fromdate != "" && $jodata->todate != "")
                $where_date = $this->cms->ASSIGNED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            $cms_data = $this->basemodel->awesome_fetch($this->cms->tbl_name, $where, $where_date, '', '', '', '', '*', $this->cms->ASSIGNED_ON, 'desc');
            //return $this->db->last_query();
            //$data['qry'] = $this->db->last_query();
            if (!empty($cms_data))
            {
                $data['assigned_calls'] = $this->baselibrary->cms_call_details($cms_data);
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
            return $data;
        }
    }
    private function _undeployed_equipments($jodata=array())
    {   //print_r($jodata);
        $data =array();
        $where=array();
        if(!empty($jodata)) {
            $qry = "";
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->devices->BRANCH_ID] = $branch_id;
            $where[$this->devices->ORG_ID] = $org_id;

            $qry = "(" . $this->devices->E_ID ." IS NULL OR ".$this->devices->DEPT_ID ." IS NULL ". NULL.")";

            if ($jodata->po_no != "")
                $where[$this->devices->PONO] = $jodata->po_no;
            if ($jodata->serial_no != "")
                $where[$this->devices->ES_NUMBER] = $jodata->serial_no;
            if (isset($jodata->limit_val))
            {
                if($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$where,$qry,'count('.$this->devices->ID.') AS CNT');

                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                }
                else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }

                $list =  $this->basemodel->fetch_records_from_multi_where_vndr($this->devices->tbl_name,$where,$qry,'*',$this->devices->E_NAME,'ASC','10',$limit_val*10);
            }
            else
            {
                $list =  $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$where,$qry,'*',$this->devices->E_NAME);
            }
            //$data['qry'] = $this->db->last_query();
            //return $this->db->last_query();

            //$list = $this->basemodel->fetch_records_from($this->devices->tbl_name,$where,'*');
            if (!empty($list)) {
                //$data['qry'] = $this->db->last_query();
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($list); $i++) {
                    $list[$i]['VENDOR_ID'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_VENDOR, array($this->deviceamcs->EID => $list[$i][$this->devices->ID]), $this->deviceamcs->AMC_TO, 'DESC');
                    $list[$i]['company_name'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name,$this->devicevendors->NAME,array($this->devicevendors->ID=>$list[$i][$this->devices->C_NAME]));
                    $list[$i]['VENDOR_NAME'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$i]['VENDOR_ID']));
                }
                $data['list'] = $list;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }


    private function _device_deployment($jodata=array())
    {
        $main_device_id = "";
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $data=array();
        $new_or_old = $jodata->eq_condition;
        $branch_code = $jodata->branch_code;
        $city_code = $jodata->city_code;
        $dateof_install = date('Y-m-d',strtotime($jodata->dateof_install));
        $device_auto_id = $jodata->ID;
        $eq_data = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->ID=>$device_auto_id));
        if(empty($eq_data))
        {
            $data['device_update'] = FAILEDATA;
            $data['call_back'] = "No Equipment Found...!";
            return $data;
        }
        if($new_or_old==NEWEQ)
        {
            $department = $jodata->department;
            $classification = $jodata->classification;
            $equp_type = $jodata->E_TYPE;
            $qry = "SELECT ".$this->devices->E_ID." FROM ".$this->db->dbprefix($this->devices->tbl_name)." WHERE ".$this->devices->ORG_ID." = '".$org_id."' AND ".$this->devices->E_ID." LIKE '".$city_code."-___-____-".$branch_code."-%-___-____' ORDER BY Right(".$this->devices->E_ID.",4) DESC";
            $devices = $this->basemodel->execute_qry($qry);
            if($devices===false)
            {
                return false;
            }
            if(!empty($devices))
            {
                $devicenumbers = array();
                for($i = 0; $i < count($devices); $i++)
                {
                    $device = $devices[$i];
                    $eid=$device[$this->devices->E_ID];
                    $data['last_equp'] = $eid;
                    $number_array=explode("-",$eid);
                    array_push($devicenumbers,(int)end($number_array));
                }
                // given array. 3 and 6 are missing.
                //$arr1 = array(1,2,4,5,7);
                // construct a new array:1,2....max(given array).
                $arr2 = range(1,max($devicenumbers));
                // use array_diff to get the missing elements
                $missing = array_diff($arr2,$devicenumbers); // (3,6)

                if(count($missing) > 0)
                {
                    reset($missing);  // to get first value
                    $number = (int)key($missing);
                }
                else{
                    $device = $devices[0];
                    $eid=$device[$this->devices->E_ID];
                    $data['last_equp'] = $eid;
                    $number_array=explode("-",$eid);
                    $number = end($number_array);
                    $number = (int)$number;
                    $number = $number+1;
                }
            }
            else
                $number=1;
            $elast_id= sprintf('%04d',$number);

            $main_device_id =  $city_code."-BME-".date('my',strtotime($dateof_install))."-".$branch_code."-".$department."-".$equp_type."-".$elast_id;
        }
        else if($new_or_old==EXSITSEQ)
        {
            if(isset($jodata->eqpid) && $jodata->eqpid!='')
            {
                $main_device_id = $jodata->eqpid;
                $exsits_id = explode("-",$jodata->eqpid);
                if(count($exsits_id)!=7)
                {
                    $data['device_update'] = FAILEDATA;
                    $data['call_back'] = "Equipment ID not matched with standard format...!";
                    return $data;
                }
                $department = $exsits_id[4];
                $equp_type  = $exsits_id[5];
            }
            else
            {
                $data['device_update'] = FAILEDATA;
                $data['call_back'] = "Please Enter Device ID";
                return $data;
            }
        }
        $udevice[$this->devices->DATEOF_INSTALL] = $dateof_install;
        $udevice[$this->devices->E_ID] = $main_device_id;
        $udevice[$this->devices->QR_CODE] = QR_URL . $main_device_id;
        $udevice[$this->devices->DEPT_ID] = $department;
        $udevice[$this->devices->E_TYPE] = $equp_type;
        $udevice[$this->devices->USER_FINISH] = $user_id;
        $udevice[$this->devices->FINISH_DATE] = date('Y-m-d H:i:s');
        $uwhere[$this->devices->ORG_ID] = $org_id;
        $uwhere[$this->devices->ID] = $device_auto_id;
        if($this->basemodel->update_operation($udevice,$this->devices->tbl_name,$uwhere))
        {
            $data['device_update'] = SUCCESSDATA;
            $data['eid'] = $main_device_id;
            $data['call_back'] = "Equipment(".$main_device_id.") Deployed Successfully";
            /*update amc table*/
            $amc_update[$this->deviceamcs->EID] = $main_device_id;
            $amc_where[$this->deviceamcs->EID] = $device_auto_id;
            $this->basemodel->update_operation($amc_update,$this->deviceamcs->tbl_name,$amc_where);
            $amc_type=$this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_TYPE,array($this->deviceamcs->EID=>$main_device_id),$this->deviceamcs->AMC_TO,'DESC');
            if($amc_type=="-")
            {
                $amcval = "N";
            }
            else
            {
                $amcval = $amc_type;
            }
            $device_pms_details = $this->basemodel->fetch_single_row($this->pmsdetails->tbl_name,array($this->pmsdetails->EID=>$device_auto_id));
            if(!empty($device_pms_details))
            {
                if (is_null($device_pms_details[$this->pmsdetails->PMS_DONE]) || $device_pms_details[$this->pmsdetails->PMS_DONE] == '')
                {
                    $pms_update[$this->pmsdetails->PMS_COUNT] = $no_of_pms = $device_pms_details[$this->pmsdetails->PMS_COUNT] != 0 ? $device_pms_details[$this->pmsdetails->PMS_COUNT] : 4;
                    $pms_update[$this->pmsdetails->PMS_DONE] = $this->baselibrary->datediff($dateof_install, 'months');
                    $pmsval = 30 * (12 / $no_of_pms);
                    $pmsdue = date('Y-m-d', strtotime($pms_update[$this->pmsdetails->PMS_DONE] . " + $pmsval days"));
                    $pms_update[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                }
                $pms_update[$this->pmsdetails->JOB_ID] = $jodata->branch_code . "-".$amcval."P-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($device_pms_details[$this->pmsdetails->ID]);
                $pms_update[$this->pmsdetails->EID] = $main_device_id;
                $pms_where[$this->pmsdetails->EID] = $device_auto_id;
                if ($this->basemodel->update_operation($pms_update, $this->pmsdetails->tbl_name, $pms_where))
                {
                    $data['pms_update'] = SUCCESSDATA;
                }

                else
                    $data['pms_update'] = FAILEDATA;
            }
            else
            {
                $pmsdue = NULL;
                $no_of_pms = $insert_pms[$this->pmsdetails->PMS_COUNT] = 4;
                $insert_pms[$this->pmsdetails->PMS_DONE] = $this->baselibrary->datediff($dateof_install,'months');
                $pmsval = 30*(12 / $no_of_pms);
                $pmsdue = date('Y-m-d', strtotime($insert_pms[$this->pmsdetails->PMS_DONE]. " + $pmsval days"));
                $insert_pms[$this->pmsdetails->ORG_ID] = $org_id;
                $insert_pms[$this->pmsdetails->BRANCH_ID] = $branch_id;
                $insert_pms[$this->pmsdetails->EID] = $main_device_id;
                $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                if ($this->basemodel->insert_into_table($this->pmsdetails->tbl_name, $insert_pms))
                {
                    $response['pms_insert'][] = SUCCESSDATA;
                    $insert_pms_id = $this->db->insert_id();
                    $pms_max_val = $this->basemodel->select_max_val($this->pmsdetails->tbl_name,$this->pmsdetails->ID);
                    $pms_max_val = $pms_max_val+1;
                    $uinsert_pms[$this->pmsdetails->JOB_ID] = $this->baselibrary->get_brch_code_f_eid($main_device_id)."-".$amcval."P-".date('my')."-".$this->baselibrary->getpmsqc_id($pms_max_val);
                    if($this->basemodel->update_operation($uinsert_pms,$this->pmsdetails->tbl_name,array($this->pmsdetails->ID=>$insert_pms_id)))
                    {
                        $data['pms_update_new'] = SUCCESSDATA;
                    }
                    else
                    {
                        $data['pms_update_new'] = FAILEDATA;
                    }
                } else {
                    $response['pms_insert'][] = FAILEDATA;
                }
            }
            $device_qc_details = $this->basemodel->fetch_single_row($this->qcdetails->tbl_name,array($this->qcdetails->EID=>$device_auto_id));
            if(!empty($device_qc_details))
            {
                if(is_null($device_qc_details[$this->qcdetails->QC_DONE]) || $device_qc_details[$this->qcdetails->QC_DONE]=='')
                {
                    $qc_update[$this->qcdetails->QC_COUNT] = $no_of_qcs = 1;
                    $qcval = 365*(1 /$no_of_qcs);
                    $qc_update[$this->qcdetails->QC_DONE] = $this->baselibrary->datediff($dateof_install,'years');
                    $qcdue = date('Y-m-d', strtotime($qc_update[$this->qcdetails->QC_DONE]. " + $qcval days"));
                    $qc_update[$this->qcdetails->QC_DUE] = $qcdue;
                }
                $qc_update[$this->qcdetails->JOB_ID]= $jodata->branch_code."-JQ-".date('my')."-".$this->baselibrary->getpmsqc_id($device_qc_details[$this->qcdetails->ID]);
                $qc_update[$this->qcdetails->EID] = $main_device_id;
                $qc_where[$this->qcdetails->EID] = $device_auto_id;
                if($this->basemodel->update_operation($qc_update,$this->qcdetails->tbl_name,$qc_where))
                {
                    $data['qc_update'] = SUCCESSDATA;
                }
                else
                    $data['qc_update'] = FAILEDATA;
            }
            else
            {
                $qccount = 1;
                $qcdue = NULL;
                $insert_qc[$this->qcdetails->QC_DONE] = $this->baselibrary->datediff($dateof_install,'years');
                $insert_qc[$this->qcdetails->QC_COUNT] = $qccount;
                $qcval = 365*(1 / $qccount);
                $qcdue = date('Y-m-d', strtotime($insert_qc[$this->qcdetails->QC_DONE]. " + $qcval days"));
                $insert_qc[$this->qcdetails->QC_COUNT_TYPE] = 'Year';
                $insert_qc[$this->qcdetails->ORG_ID] = $org_id;
                $insert_qc[$this->qcdetails->EID] = $main_device_id;
                $insert_qc[$this->qcdetails->BRANCH_ID] = $branch_id;
                $insert_qc[$this->qcdetails->QC_DUE] = $qcdue;
                if ($this->basemodel->insert_into_table($this->qcdetails->tbl_name, $insert_qc))
                {
                    $response['qc_insert'][] = SUCCESSDATA;
                    $insert_qc_id = $this->db->insert_id();
                    $qc_max_val = $this->basemodel->select_max_val($this->qcdetails->tbl_name,$this->pmsdetails->ID);
                    $qc_max_val = $qc_max_val+1;
                    $uinsert_qc[$this->qcdetails->JOB_ID] = $this->baselibrary->get_brch_code_f_eid($main_device_id)."-JQ-".date('my')."-".$this->baselibrary->getpmsqc_id($qc_max_val);
                    $this->basemodel->update_operation($uinsert_qc,$this->qcdetails->tbl_name,array($this->qcdetails->ID=>$insert_qc_id));
                } else {
                    $response['qc_insert'][] = FAILEDATA;
                }
            }

            $data['eq_status'] = $this->baselibrary->equipment_status_tbl_insert($main_device_id,$eq_data[$this->devices->C_NAME],$eq_data[$this->devices->EQ_CONDATION],date('Y-m-d H:i:s'));
        }
        else
        {
            $data['device_update'] = FAILEDATA;
            $data['call_back'] = "Unable to Deploy Device";
        }
        return $data;
    }
    private function _search_by_equp_aid($jodata=array())
    {
        $data=array();
        if($jodata->action == "search_by_equp_eid")
        {
            $dw[$this->devices->E_ID] = $jodata->esid;
            if(isset($jodata->dept_id))
                $dw[$this->devices->DEPT_ID]=$jodata->dept_id;
        }
        else
            $dw = array($this->devices->ID=>$jodata->esid);
        $list =$this->basemodel->fetch_single_row($this->devices->tbl_name,$dw);
        if(!empty($list))
        {
            $data['list'] = $list;
            $data['list']['branch_code'] = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_CODE,array($this->branches->BRANCH_ID=>$data['list'][$this->devices->BRANCH_ID]));
            $data['list']['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_NAME,array($this->branches->BRANCH_ID=>$data['list'][$this->devices->BRANCH_ID]));
            $data['list']['city_code'] = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->CITY,array($this->branches->BRANCH_ID=>$data['list'][$this->devices->BRANCH_ID]));
            $data['list']['city_name'] = $this->basemodel->get_single_column_value($this->cities->tbl_name,$this->cities->CITY_NAME,array($this->cities->CITY_CODE=>$data['list']['city_code']));
            $data['list']['monthyear'] = date('my');
            $data['response'] = SUCCESSDATA;
        }
        else
            $data['response'] = EMPTYDATA;
        return $data;
    }
    private function _get_classifications($jodata=array())
    {
        $data = array();
        $where = array();
        if(isset($jodata->code) && $jodata->code!="")
            $where[$this->classifications->CODE] = $jodata->code;
        if(isset($jodata->limit_val))
        {
            if($jodata->limit_val!='')
                $limit_val = $jodata->limit_val;
            else
                $limit_val = 0;
            $cnt = $this->basemodel->fetch_records_from_multi_where($this->classifications->tbl_name,array(),$where,'count('.$this->classifications->ID.') AS CNT');
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
            $classifications = $this->basemodel->fetch_records_from_pagination($this->classifications->tbl_name,$where,'*',$this->classifications->MASTER_CLASS,'ASC','10',$limit_val*10);
        }
        else
        {
            $classifications = $this->basemodel->fetch_records_from($this->classifications->tbl_name,$where);
        }

        if(!empty($classifications))
        {
            $data['response'] = SUCCESSDATA;
            $data['list'] = $classifications;
        }
        else
            $data['response'] = EMPTYDATA;
        return $data;
    }
    private function _add_equp_name($jodata=array())
    {
        $data=array();
        if (!empty($jodata))
        {
            $equp_name = $this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->CODE,array($this->devicenames->CODE=>$jodata->ecode));
            if($equp_name=="-") {
                $idata[$this->devicenames->NAME] = $jodata->ename;
                $idata[$this->devicenames->CODE] = $jodata->ecode;
				$idata[$this->devicenames->ORG_MODULE] = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $idata[$this->devicenames->PRIORITY] = $jodata->priority;
                if ($this->basemodel->insert_into_table($this->devicenames->tbl_name, $idata)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Device Category Added Successfully";
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable to Process Your Request, Try again...!";
                }
            }else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = $jodata->ecode." Equipment Name Code Already Exists";
            }
        }
        return $data;
    }
    private function _update_equp_name($jodata=array())
    {
        $data=array();
        if (!empty($jodata)) {

            $device_name = $this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->CODE,array($this->devicenames->CODE=>$jodata->code));
            if(!empty($device_name)) {
                log_message('error',print_r($jodata,TRUE));
                $where[$this->devicenames->ID]=$jodata->ID;
                $udata[$this->devicenames->NAME] = $jodata->equp_name;
                $udata[$this->devicenames->CODE] = $jodata->code;
                $udata[$this->devicenames->PRIORITY] = $jodata->priority;
                $udata[$this->devicenames->STATUS] = $jodata->status;
                if($this->basemodel->update_operation($udata,$this->devicenames->tbl_name,$where))
                {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Device Name Updated Successfully";
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = $udata[$this->devicenames->CODE]." Equipment Name Code Already Exists";
                }
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] ="Unable To Process Your Request..!";
            }
        }
        return $data;
    }
    private function _get_equip_names($jodata=array())
    {
        //return "fg";
		/*$data=array();
        if(!empty($jodata) && $this->ha_content_type==$this->baseauth->appjson)
        {
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->devicenames->tbl_name,array(),'','count('.$this->devicenames->ID.') AS CNT');
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
                $equp_names = $this->basemodel->fetch_records_from_pagination($this->devicenames->tbl_name,'','*',$this->devicenames->NAME,'ASC','10',$limit_val*10);

            }
            else
            {
                $equp_names = $this->basemodel->fetch_records_from($this->devicenames->tbl_name,'','*',$this->devicenames->NAME);

            }

            if(!empty($equp_names))
            {

				 $data['response'] = SUCCESSDATA;

              for ($i = 0; $i < count($equp_names); $i++)
			  {
                    $equp_names[$i]['priority'] = $this->basemodel->get_single_column_value($this->priorities->tbl_name, $this->priorities->PNAME, array($this->priorities->PID => $equp_names[$i][$this->devicenames->PRIORITY]));
              }
                $data['list'] = $equp_names;
             }

            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = array();
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
				
				$eqwhere[$this->devicenames->ORG_MODULE]  = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $cnt = $this->basemodel->fetch_records_from($this->devicenames->tbl_name, $eqwhere, 'count(' . $this->devicenames->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $eqwhere[$this->devicenames->ORG_MODULE]  = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $equp_names = $this->basemodel->fetch_records_from_pagination($this->devicenames->tbl_name,$eqwhere, '*', $this->devicenames->NAME, 'ASC', '10', $limit_val * 10);
               // return $equp_names;               
			   $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->devicenameslabels->ORG_MODULE] = $org_type;
				$where[$this->devicenameslabels->ORG_ID]  = $org_id;
                $dtypes_label = $this->basemodel->fetch_single_row($this->devicenameslabels->tbl_name,$where);
                
			} else {
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->devicenameslabels->ORG_ID]  = $org_id;
				$where[$this->devicenameslabels->ORG_MODULE] = $org_type;
				
			      $eqwhere[$this->devicenames->ORG_MODULE]  = isset($jodata->user_org_module) ? $jodata->user_org_module : $this->session->user_org_module;
                $equp_names = $this->basemodel->fetch_records_from($this->devicenames->tbl_name,$eqwhere);
				$dselect = array($this->devicenameslabels->NAME,$this->devicenameslabels->EQ_TYPE,$this->devicenameslabels->PRIORITY,$this->devicenameslabels->STATUS,$this->devicenameslabels->ACTION);
                $dtypes_label = $this->basemodel->fetch_single_row($this->devicenameslabels->tbl_name,$where,$dselect);
                
		  }
                
            if (!empty($equp_names) || !empty($dtypes_label)) {
              // $ctypelabel = array_merge($ctypes_label,$ctypes);
				
                $data['response'] = SUCCESSDATA;
                
				for ($i = 0; $i < count($equp_names); $i++)
			  {
                    $equp_names[$i]['priority'] = $this->basemodel->get_single_column_value($this->priorities->tbl_name, $this->priorities->PNAME, array($this->priorities->PID => $equp_names[$i][$this->devicenames->PRIORITY]));
              }
			    $data['list'] = $equp_names;
				$data['labels'] = $dtypes_label;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = NULL;
				$data['labels'] = NULL;
            }
        }
        return $data;

    }

    private function _get_equp_names($jodata=array())
    {
        $data= $where = array();
        if(!empty($jodata) && $this->ha_content_type==$this->baseauth->appjson)
        {
            if(isset($jodata->type))
            {
                $where[$this->devicenames->EQ_TYPE] =$jodata->type;
            }
            $data['device_names'] = $this->basemodel->fetch_records_from($this->devicenames->tbl_name,$where);
        }
        return $data;
		
		
		    }
    private function _get_equp_types_master($jodata=array())
    {
        /*$data=array();
        if(!empty($jodata) && $this->ha_content_type==$this->baseauth->appjson)
        {

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->equptypes->tbl_name,array(),'','count('.$this->equptypes->ID.') AS CNT');
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
                $data['equip_types'] = $this->basemodel->fetch_records_from_pagination($this->equptypes->tbl_name,'','*',$this->equptypes->TYPE,'ASC','10',$limit_val*10);

            }
            else{
                $data['equip_types'] = $this->basemodel->fetch_records_from($this->equptypes->tbl_name);
            }
            if(!empty($data['equip_types']))
                $data['response'] = SUCCESSDATA;
            else
                $data['response'] = EMPTYDATA;
        }
        return $data;*/
		
		$data = array();
        if (!empty($jodata)) {
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->equptypes->tbl_name, array(), '', 'count(' . $this->equptypes->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

                $equip_types = $this->basemodel->fetch_records_from_pagination($this->equptypes->tbl_name, '', '*', $this->equptypes->TYPE, 'ASC', '10', $limit_val * 10);
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->equptypelabels->ORG_MODULE] = $org_type;
				$where[$this->equptypelabels->ORG_ID]  = $org_id;
                $equp_type_label = $this->basemodel->fetch_single_row($this->equptypelabels->tbl_name,$where);
                
			} else {
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $where[$this->equptypelabels->ORG_ID]  = $org_id;
				$where[$this->equptypelabels->ORG_MODULE] = $org_type;
				//return $where;
				
			
                $equip_types = $this->basemodel->fetch_records_from($this->equptypes->tbl_name);
				$dselect = array($this->equptypelabels->NAME,$this->equptypelabels->TYPE,$this->equptypelabels->CODE,$this->equptypelabels->STATUS,$this->equptypelabels->ACTION);
                $equp_type_label = $this->basemodel->fetch_single_row($this->equptypelabels->tbl_name,$where,$dselect);
                
		  }
                
            if (!empty($equip_types) || !empty($equp_type_label)) {
              // $ctypelabel = array_merge($ctypes_label,$ctypes);
				
                $data['response'] = SUCCESSDATA;
                
				
			    $data['equip_types'] = $equip_types;
				$data['labels'] = $equp_type_label;
            } else {
                $data['response'] = EMPTYDATA;
                
				$data['labels'] = NULL;
            }
        }
        return $data;

		
		
    }
    private function _remaind_to_bme($jodata=array())
    {
        $data=array();
        $notify_to='';
        if(!empty($jodata) && $this->ha_content_type==$this->baseauth->appjson)
        {
            $call_data = $this->basemodel->fetch_single_row($this->cms->tbl_name,array($this->cms->CALLER_ID=>$jodata->CALLER_ID));
            if(!empty($call_data)) {
                if (strtolower($jodata->type) == "responded")
                {
                    if ($call_data[$this->cms->ASSIGNED_TO] != null && $call_data[$this->cms->ASSIGNED_TO] != VENDOR)
                        $notify_to = $call_data[$this->cms->ASSIGNED_TO];
                    else if($call_data[$this->cms->RESPONDED_BY]!=NULL)
                        $notify_to = $call_data[$this->cms->RESPONDED_BY];
                    $notification = "Attend the call " . $call_data[$this->cms->EID] . ", as soon as possible";
                }
                else {
                    $notify_to = $call_data[$this->cms->ATTENDED_BY];
                    $notification = "Complete the call " . $call_data[$this->cms->EID] . ", as soon as possible";
                }
                $user_role = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->ROLE_CODE,array($this->users->USER_ID=>$notify_to));
                $data = $this->baselibrary->send_notification($call_data[$this->cms->ORG_ID], $call_data[$this->cms->BRANCH_ID], $notification, $user_role, $notify_to);

                //return $this->db->last_query();
                //$data['q'] = $this->db->last_query();
                if ($data['notification'] == 'sent') {
                    $data['response'] = $data['notification_success'] > 0 ? SUCCESSDATA : FAILEDATA;
                    $data['call_back'] = $data['notification_success'] > 0 ? 'notification sent' : 'notification not sent';
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = 'notification not sent';
                }
            }
        }
        return $data;
    }

    private function _get_vendor_calls($jodata=array())
    {
        $data=array();
        if(!empty($jodata))
        {
            $where[$this->cms->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->cms->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            /*if($jodata->user_role_code==HBBME)
                $where[$this->cms->RESPONDED_BY] = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;*/
            $where[$this->cms->ASSIGNED_TO]=VENDOR;
            $where[$this->cms->JOBCOMPLETED_DATE]=NULL;
            $where[$this->cms->TO_ADVERSE] = NULL;
            $cms_data = $this->basemodel->fetch_records_from($this->cms->tbl_name,$where);
            if(!empty($cms_data))
            {
                $data['response'] = SUCCESSDATA;
                $data['list'] = $this->baselibrary->cms_call_details($cms_data);
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _get_round_perminent_useres($jodata=array())
    {
        $data=array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->rounds_assigned->BRANCH_ID]=$branch_id;
            $where[$this->rounds_assigned->ORG_ID]=$org_id;
            $where[$this->rounds_assigned->STATUS]=PERMANENT;
            $rp_users = $this->basemodel->fetch_records_from($this->rounds_assigned->tbl_name,$where,$this->rounds_assigned->ASSIGNED_TO);
            if(!empty($rp_users))
            {
                $data['response'] = SUCCESSDATA;
                for($i=0;$i<count($rp_users);$i++)
                {
                    $rp_users[$i]['ASSIGNED_TO_NAME'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $rp_users[$i][$this->rounds_assigned->ASSIGNED_TO]));
                }
                $data['rp_users'] = $rp_users;
            }
            else
                $data['response'] = EMPTYDATA;
        }
        return $data;
    }

    private function _get_rounds_depts($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id :       $this->session->branch_id;
            $rdepts_array=array();
            $prdepts_array=array();
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->rounds_assigned->BRANCH_ID]=$branch_id;
            $where[$this->rounds_assigned->ORG_ID]=$org_id;
            if($jodata->status==TEMPORARY)
            {
                $where[$this->rounds_assigned->STATUS]=PERMANENT;
                $where[$this->rounds_assigned->ASSIGNED_TO]=$jodata->assignfrom;
                $pr_user_depts = $this->basemodel->fetch_single_row($this->rounds_assigned->tbl_name,$where,$this->rounds_assigned->DEPT_ID);
                if(!empty($pr_user_depts))
                    $prdepts_array = explode(",",$pr_user_depts[$this->rounds_assigned->DEPT_ID]);
                //$data['pq'] = $this->db->last_query();
                unset($where[$this->rounds_assigned->ASSIGNED_TO]);

                $where[$this->rounds_assigned->STATUS]=TEMPORARY;
                $where[$this->rounds_assigned->ROUND_DATE]=date('Y-m-d',strtotime($jodata->current_date));
                $where[$this->rounds_assigned->ASSIGNED_TO]=$jodata->assignfrom;
                $tt_depts=$this->basemodel->fetch_records_from($this->rounds_assigned->tbl_name,$where,$this->rounds_assigned->DEPT_ID);
                if(!empty($tt_depts))
                {
                    for($i=0;$i<count($tt_depts);$i++)
                    {
                        $ttrdpts = explode(',',$tt_depts[$i][$this->rounds_assigned->DEPT_ID]);

                        $rdepts_array=array_merge($rdepts_array,$ttrdpts);

                    }
                    $rdepts_array=array_unique($rdepts_array);
                }
                if(!empty($rdepts_array))
                {
                    for($j=0;$j<count($rdepts_array);$j++)
                    {
                        if(in_array($rdepts_array[$j],$prdepts_array))
                        {
                            if(($key = array_search($rdepts_array[$j], $prdepts_array)) !== false) {
                                unset($prdepts_array[$key]);
                            }
                        }
                    }
                }
                if(!empty($prdepts_array))
                    $rdepts1 = $this->basemodel->awesome_fetch($this->userdeprts->tbl_name,'','',$prdepts_array,$this->userdeprts->CODE);
                else
                    $rdepts1 = $this->basemodel->fetch_records_from($this->userdeprts->tbl_name,'',array($this->userdeprts->CODE,$this->userdeprts->USER_DEPT_NAME));
            }
            else
            {
                $where[$this->rounds_assigned->STATUS]=PERMANENT;
                $rdepts = $this->basemodel->fetch_records_from($this->rounds_assigned->tbl_name,$where,$this->rounds_assigned->DEPT_ID);
                //$data['pq1'] = $this->db->last_query();
                for($i=0;$i<count($rdepts);$i++)
                {
                    $edpts = explode(',',$rdepts[$i][$this->rounds_assigned->DEPT_ID]);

                    $rdepts_array=array_merge($rdepts_array,$edpts);
                }
                $rdepts_array=array_unique($rdepts_array);
                if(!empty($rdepts_array))
                    $rdepts1 = $this->basemodel->fetch_records_from_where_not_in($this->userdeprts->tbl_name,'',$this->userdeprts->CODE,$rdepts_array);
                else
                    $rdepts1 = $this->basemodel->fetch_records_from($this->userdeprts->tbl_name,'',array($this->userdeprts->USER_DEPT_NAME,$this->userdeprts->CODE));
            }
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

    private function _get_cause_codes($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $causes = $this->basemodel->fetch_records_from($this->causecodes->tbl_name);
            if (!empty($causes)) {
                $data['response'] = SUCCESSDATA;
                $data['causecodes'] = $causes;
                //print_r($data);
            } else {
                $data['response'] = FAILEDATA;
            }
        }
        return $data;
    }

    private function _get_responded_bmecalls($jodata = array())
    {

        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $qry = "";
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $where = array();
            $where[$this->cms->TO_ADVERSE] = NULL;
            if ($jodata->department != "")
                $where[$this->cms->CALLER_DEPT] = $jodata->department;
            if ($jodata->eqpid != "" AND $jodata->eqpid != null)
                $where[$this->cms->EID] = $jodata->eqpid;
            if($jodata->action=="get_responded_bmecalls" || (isset($jodata->mine) && $jodata->mine==YESSTATE))
            {

                $qry = "(" . $this->cms->RESPONDED_BY . "='" . $user_id ."' OR " . $this->cms->ASSIGNED_TO . "='" . $user_id ."')";
            }
            else
                $where[$this->cms->RESPONDED_DATE." !="] = NULL;
            $where[$this->cms->ATTENDED_BY] = NULL;
            $where[$this->cms->ORG_ID] = $org_id;

            $where[$this->cms->STATUS] = DNW;

            if($branch_id != 'All')
                $where[$this->cms->BRANCH_ID] = $branch_id;
            else
                $qry = $this->cms->BRANCH_ID." IN " .BRANCHALL;
            
            if(isset($jodata->limit_val) && $jodata->limit_val!='')
                $limit_val = $jodata->limit_val;
            else
                $limit_val = 0;
            $cnt = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name,$where,$qry,'count('.$this->cms->ID.') AS CNT');
            //return $this->db->last_query();
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

            $where_not_in = "";
            $where_not_in_key = "";
            $where_date = '';
            /*if($jodata->fromdate != "" && $jodata->todate != "")
                $where_date = $this->cms->RESPONDED_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";*/



            $cms_data = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->cms->tbl_name, $where, $qry, '', '', $where_not_in, $where_not_in_key, '*', $this->cms->RESPONDED_DATE, 'desc','10',$limit_val*10);


            for($i = 0; $i < count($cms_data); $i++) {

                //$where1[$this->devices->BRANCH_ID] =  $cms_data[$i]['BRANCH_ID'];
                //$where1[$this->devices->ORG_ID]  = $cms_data[$i]['ORG_ID'];
                $where1[$this->devices->E_ID] = $cms_data[$i]['EID'];

                $devices = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1 , array($this->devices->ASSIGN_ID));

                if($devices)
                {

                    $cms_data[$i]['ASSIGN_ID'] = $devices['ASSIGN_ID'];

                }


            }



            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }

            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));

            $cms = array();
            for($i = 0; $i < count($devices); $i++) {

                $bwhere[$this->cms->STATUS] = DNW;
                $bwhere[$this->cms->ATTENDED_BY] = NULL;
                $bwhere[$this->cms->RESPONDED_BY."!="] = NULL;
                $bwhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];

                $call_res = $this->basemodel->fetch_single_row($this->cms->tbl_name, $bwhere);

                if(!empty($call_res))
                {

                    $call_res['ASSIGN_ID'] = $devices[$i]['E_ID'];

                    array_push($cms,$call_res);

                }

            }


            if(!empty($cms) || !empty($cms_data)){
                $cms_data = array_merge($cms_data, $cms);
                $data['response'] = SUCCESSDATA;
                $data['respond_calls'] = $this->baselibrary->cms_call_details($cms_data,'responded',$role_code,$user_id);
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['respond_calls'] = NULL;
            }

            return $data;

        }
    }
    private function _get_attended_bmecalls($jodata = array())
    {

        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $where = array();
            $where[$this->cms->TO_ADVERSE] = NULL;
            if($jodata->action != "get_bme_attended_calls")
            {
                if ($jodata->department != "")
                    $where[$this->cms->CALLER_DEPT] = $jodata->department;
                if ($jodata->eqpid != "" AND $jodata->eqpid != null)
                    $where[$this->cms->EID] = $jodata->eqpid;
            }
            if($jodata->action=="get_attended_bmecalls" || $jodata->action=="get_bme_attended_calls" || (isset($jodata->mine) && $jodata->mine==YESSTATE))
                $where[$this->cms->ATTENDED_BY] = $user_id;
            else
                $where[$this->cms->ATTENDED_BY." !="] = NULL;

            $where[$this->cms->PENDING_REASON] = NULL;
            $where[$this->cms->ORG_ID] = $org_id;

            $where_not_in = array(DW, UMAINTENCE);
            $where_not_in_key = $this->cms->STATUS;
            $where_date = '';
            if ($jodata->fromdate != "" && $jodata->todate != "")
                $where_date = $this->cms->RESPONDED_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";

            if($branch_id != "All")
                $where[$this->cms->BRANCH_ID] = $branch_id;
            else
            {
                $where_date .= ($where_date == '') ? '' : " AND ";
                $where_date .= $this->cms->BRANCH_ID." IN ".BRANCHALL;
            }


            if(isset($jodata->limit_val))
            {
                $limit_val = $jodata->limit_val;
                $cnt = $this->basemodel->awesome_fetch($this->cms->tbl_name, $where, $where_date, '', '', $where_not_in, $where_not_in_key, 'count(' . $this->cms->ID . ') AS CNT', $this->cms->ATTENDED_DATE, 'desc');
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


                $cms_data = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->cms->tbl_name, $where, $where_date, '', '', $where_not_in, $where_not_in_key, '*', $this->cms->ATTENDED_DATE, 'desc','10',$limit_val*10);



                for($i = 0 ; $i <count($cms_data); $i++)
                {

                    $where1[$this->devices->E_ID] = $cms_data[$i]['EID'];

                    $devices1 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1,array($this->devices->ASSIGN_ID));


                    if($devices1)
                    {

                        $cms_data[$i]['ASSIGN_ID'] = $devices1['ASSIGN_ID'];

                    }

                    //array_push($cms_data,$call_res3[$k]);


                }





                //  $cms_data = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->cms->tbl_name, $where, $where_date, '', '', $where_not_in, $where_not_in_key, '*', $this->cms->ATTENDED_DATE, 'desc','10',$limit_val*10);
            }
            else
            {
                $cms_data = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->cms->tbl_name, $where, $where_date, '', '', $where_not_in, $where_not_in_key, '*', $this->cms->ATTENDED_DATE, 'desc','10',$limit_val*10);


                for($i = 0 ; $i <count($cms_data); $i++)
                {

                    $where1[$this->devices->E_ID] = $cms_data[$i]['EID'];
                    $devices2 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1, array($this->devices->ASSIGN_ID));


                    if($devices2) {

                        $cms_data[$i]['ASSIGN_ID'] = $devices2['ASSIGN_ID'];

                        //  array_push($cms_data,$call_res3[$k]);
                    }

                }



                // $cms_data = $this->basemodel->awesome_fetch($this->cms->tbl_name, $where, $where_date, '', '', $where_not_in, $where_not_in_key, '*', $this->cms->ATTENDED_DATE, 'desc');
            }




            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }
            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));
            //return $devices;
            $cms = array();
            for($i = 0; $i < count($devices); $i++) {
                $bwhere = '';
                $bwhere[$this->cms->STATUS] = DNW;
                $bwhere[$this->cms->ATTENDED_BY." !="] = NULL;
                $bwhere[$this->cms->PENDING_REASON] = NULL;
                $bwhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];

                $call_res = $this->basemodel->fetch_single_row($this->cms->tbl_name, $bwhere);

                if(!empty($call_res))
                {

                    $call_res['ASSIGN_ID'] = $devices[$i]['E_ID'];

                    array_push($cms,$call_res);

                }

            }
            // return $cms;
            if(!empty($cms) || !empty($cms_data)){
                $cms_data = array_merge($cms_data, $cms);
                $data['response'] = SUCCESSDATA;
                $data['attended_calls'] = $this->baselibrary->cms_call_details($cms_data,'attended',$role_code,$user_id);
            }
            else{
                $data['response'] = EMPTYDATA;
                $data['attended_calls'] = NULL;
            }
            return $data;
        }


    }


    private function _get_processpending_bmecalls($jodata = array())
    {



        if(!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;


            $where = array();
            $where[$this->cms->TO_ADVERSE] = NULL;
            if($jodata->action != "get_bme_pending_calls")
            {
                if ($jodata->department != "")
                    $where[$this->cms->CALLER_DEPT] = $jodata->department;
                if ($jodata->eqpid != "" AND $jodata->eqpid != null)
                    $where[$this->cms->EID] = $jodata->eqpid;
            }
            if($jodata->action=="get_processpending_bmecalls" || $jodata->action=="get_bme_pending_calls"  || (isset($jodata->mine) && $jodata->mine==YESSTATE))
                $where[$this->cms->ATTENDED_BY] = $user_id;
            else
                $where[$this->cms->ATTENDED_DATE." !="] = NULL;
            $where[$this->cms->PENDING_REASON . " !="] = NULL;
            $where[$this->cms->JOBCOMPLETED_DATE] = NULL;
            $where[$this->cms->ORG_ID] = $org_id;

            $where[$this->cms->STATUS . " !="] = DW;
            $where_date = "";
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
                $where_date = $this->cms->ATTENDED_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";

            if($branch_id != 'All')
                $where[$this->cms->BRANCH_ID] = $branch_id;
            else
            {
                $where_date .= ($where_date == '') ? '' : " AND ";
                $where_date .= $this->cms->BRANCH_ID." IN ".BRANCHALL;
            }
            
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name, $where, $where_date, 'count('.$this->cms->ID.') AS CNT');
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


                $cms_data = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->cms->tbl_name, $where, $where_date, '', '', '', '', '*', $this->cms->ATTENDED_DATE, 'desc', '10', $limit_val * 10);

                //return $this->db->last_query();


                for($i = 0; $i<count($cms_data); $i++) {

                    $where1[$this->devices->E_ID] = $cms_data[$i]['EID'];

                    $devices1 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1,array($this->devices->ASSIGN_ID));

                    if(!empty($devices1)) {

                        $cms_data[$i]['ASSIGN_ID'] = $devices1['ASSIGN_ID'];


                    }
                }
            }

            else
            {

                $cms_data = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name, $where, $where_date, '*', $this->cms->ATTENDED_DATE, 'desc');


                for($i = 0; $i<count($cms_data); $i++) {

                    $where1[$this->devices->E_ID] = $cms_data[$i]['EID'];
                    $devices2 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1, array($this->devices->ASSIGN_ID));

                    if(!empty($devices2)) {

                        $cms_data[$i]['ASSIGN_ID'] = $devices2['ASSIGN_ID'];

                    }
                }


            }



            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }
            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));
            $cms = array();
            for($i = 0; $i < count($devices); $i++) {

                $bwhere[$this->cms->ATTENDED_DATE." !="] = NULL;
                $bwhere[$this->cms->PENDING_REASON . " !="] = NULL;
                $bwhere[$this->cms->JOBCOMPLETED_DATE] = NULL;
                $bwhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];

                $call_res = $this->basemodel->fetch_single_row($this->cms->tbl_name, $bwhere);

                if(!empty($call_res))
                {

                    $call_res['ASSIGN_ID'] = $devices[$i]['E_ID'];

                    array_push($cms,$call_res);

                }

            }

            if(!empty($cms) || !empty($cms_data)){


                $cms_data = array_merge($cms_data, $cms);
                $data['response'] = SUCCESSDATA;
                $data['processpending_calls'] = $this->baselibrary->cms_call_details($cms_data,'pending',$role_code, $user_id);
            }
            else{
                $data['response'] = EMPTYDATA;
                $data['processpending_calls'] = NULL;
            }
            return $data;
        }

    }

    private function _get_complete_bmecalls($jodata = array())
    {


        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;


            $where = array();
            $where[$this->cms->TO_ADVERSE] = NULL;
            if($jodata->action != "get_bme_pending_calls")
            {
                if (isset($jodata->department) && $jodata->department != "")
                    $where[$this->cms->CALLER_DEPT] = $jodata->department;
                if (isset($jodata->eqpid) && $jodata->eqpid != "" && $jodata->eqpid != null)
                    $where[$this->cms->EID] = $jodata->eqpid;
            }
            if($jodata->action=="get_complete_bmecalls" || $jodata->action=="get_bme_completed_calls"|| $jodata->action=="my_closed_calls")
                $where[$this->cms->ATTENDED_BY] = $user_id;
                else
                $where[$this->cms->ATTENDED_DATE." !="] = NULL;

			$where[$this->cms->ORG_ID] = $org_id;
            $where[$this->cms->STATUS] = DW;
            $where_date = "";
            //if (isset($jodata->fromdate) && isset($jodata->todate) && $jodata->fromdate != "" && $jodata->todate != "")
            //{
            //    $where_date = $this->cms->JOBCOMPLETED_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
           // }
            //else
          //  {
                $where[$this->cms->JOBCOMPLETED_DATE] = date('Y-m-d');
          //  }
            if($branch_id != 'All')
                $where[$this->cms->BRANCH_ID] = $branch_id;
            else
            {
                $where_date .= ($where_date == "") ? '' : " AND ";
                $where_date .= $this->cms->BRANCH_ID." IN ".BRANCHALL;
            }




            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name, $where, $where_date, 'count('.$this->cms->ID.') AS CNT');

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


                $cms_data =  $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->cms->tbl_name, $where, $where_date,'','','','', '*', $this->cms->JOBCOMPLETED_TIME, 'desc','10',$limit_val*10);


                for($i = 0 ; $i<count($cms_data); $i++){
                    $where1[$this->devices->E_ID] = $cms_data[$i]['EID'];

                    $devices1 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1 , array($this->devices->ASSIGN_ID));
                    if(!empty($devices1))
                    {

                        $cms_data[$i]['ASSIGN_ID'] = $devices1['ASSIGN_ID'];

                    }
                }


                // $cms_data = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->cms->tbl_name, $where, $where_date,'','','','', '*', $this->cms->JOBCOMPLETED_DATE, 'desc','10',$limit_val*10);
            }

            else
            {

                $cms_data = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name, $where, $where_date, '*', $this->cms->JOBCOMPLETED_TIME, 'desc');
                // return $this->db->last_query();

                for($i = 0 ; $i<count($cms_data); $i++){
                    $where1[$this->devices->E_ID] = $cms_data[$i]['EID'];

                    $devices2 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1, array($this->devices->ASSIGN_ID));

                    if(!empty($devices2))
                    {

                        $cms_data[$i]['ASSIGN_ID'] = $devices2['ASSIGN_ID'];

                    }
                }

                //  $cms_data = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name, $where, $where_date, '*', $this->cms->JOBCOMPLETED_DATE, 'desc');
            }


            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }
            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));
            //return $this->db->last_query();

            $cms = array();
            for($i = 0; $i < count($devices); $i++) {

                $bwhere[$this->cms->ATTENDED_DATE." !="] = NULL;
                $bwhere[$this->cms->STATUS] = DW;
                $bwhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];
				$bwhere[$this->cms->JOBCOMPLETED_DATE] = date('Y-m-d');

                $call_res = $this->basemodel->fetch_records_from($this->cms->tbl_name, $bwhere,'*',$this->cms->ID,desc);

                for($k =0 ; $k<count($call_res); $k++)
                {
                    $call_res[$k]['ASSIGN_ID'] = $devices[$i]['E_ID'];
                    array_push($cms,$call_res[$k]);
                }
                //  array_push($cms,$call_res[$k]);
                /* if(!empty($call_res))
                 {


                     $call_res['ASSIGN_ID'] = $devices[$i]['E_ID'];*/



                // }

            }


            if(!empty($cms) || !empty($cms_data)){
                $cms_data = array_merge($cms_data, $cms);
                $data['response'] = SUCCESSDATA;
                $data['completed_calls'] = $this->baselibrary->cms_call_details($cms_data,'completed',$role_code,$user_id);
            }
            else{
                $data['response'] = EMPTYDATA;
                $data['completed_calls'] = NULL;
            }
            return $data;
        }
    }

    private function _get_completed_all_calls($jodata)
    {

        $data = array();
        if(!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $cms_where[$this->cms->TO_ADVERSE] = NULL;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

            $cms_where[$this->cms->ORG_ID] = $org_id;
            $or_where = '';
            if($branch_id != 'All')
                $cms_where[$this->cms->BRANCH_ID] = $branch_id;
            else
                $or_where = $this->cms->BRANCH_ID ." IN ".BRANCHALL;

            if($this->session->role_code==HBBME)
                $cms_where[$this->cms->ATTENDED_BY] = $user_id;
            else
                $cms_where[$this->cms->ATTENDED_DATE." !="] = NULL;
            $cms_where[$this->cms->STATUS] = DW;
            $cms_where[$this->cms->JOBCOMPLETED_DATE] = date('Y-m-d');
            $cms_calls = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name,$cms_where,$or_where);
            if(!empty($cms_calls))
            {
                $data['response'] = SUCCESSDATA;
                $data['cms_list'] = $this->baselibrary->cms_call_details($cms_calls);
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _get_pending_bmepms($jodata = array())
    {


        $where_date = $or_where = "";
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $mycalls = isset($jodata->mycalls) ? $jodata->mycalls : '';
            $where = array();
            //if (isset($jodata->department) && $jodata->department != "")
            //  $where[$this->pmsdetails->BRANCH_ID] = $jodata->department; // need yo check this condition
            if (isset($jodata->eqpid) && $jodata->eqpid != "")
                $where[$this->pmsdetails->EID] = $jodata->eqpid;
            $where[$this->pmsdetails->ORG_ID] = $org_id;
            $where[$this->pmsdetails->COMPLETED_BY] = NULL;

            /*if ($role_code != HMADMIN) {
               if ($jodata->action == "my_open_calls" || (isset($jodata->mine) && $jodata->mine == YESSTATE) || (isset($jodata->aaction) && $jodata->aaction == "get_hod_calls")) {

                   if ($jodata->action == "my_open_calls" && $role_code == HBHOD) {
                       $or_where = "(" . $this->pmsdetails->PMS_ASSIGNED_TO . " IS NULL OR " . $this->pmsdetails->PMS_ASSIGNED_TO . "='" . $user_id . "')";
                   } else {
                       $where[$this->pmsdetails->PMS_ASSIGNED_TO] = $user_id;
                   }
               } else {
                   //return "OPEN CALLS";
                   //$or_where = "(" . $this->pmsdetails->PMS_ASSIGNED_TO . " IS NULL OR " . $this->pmsdetails->PMS_ASSIGNED_BY . " = '" . $user_id . "' OR " . $this->pmsdetails->PMS_ASSIGNED_TO . " = '" . $user_id . "')";
               }
           }*/
            if ($role_code != HMADMIN) {
                if ($jodata->action == "my_open_calls" || (isset($jodata->aaction) && $jodata->aaction == "get_hod_calls") || (isset($jodata->mycalls))) {
                    if ($mycalls != '' && $mycalls == YESSTATE) {
                        $where[$this->pmsdetails->PMS_ASSIGNED_TO] = $user_id;
                    }
                } else {

                    // $or_where = "(" . $this->qcdetails->ASSIGNED_TO . " IS NULL OR " . $this->qcdetails->ASSIGNED_TO . "='" . $user_id . "')";
                }
            }
            if (isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls")
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
                    $or_where = $this->pmsdetails->EID . " IN " . $device;
                }

                else
                    $or_where = '';

            }
            $where_date_like = array();
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "") {
                $where_date = $this->pmsdetails->PMS_DONE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            } else {
                $where_date_like = array($this->pmsdetails->PMS_DUE_DATE => date('Y-m'));
                //$where_date_like = "";
            }

            if ($branch_id != 'All')
                $where[$this->pmsdetails->BRANCH_ID] = $branch_id;
            else {
                $or_where .= ($or_where == '') ? '' : " AND ";
                $or_where .= $this->pmsdetails->BRANCH_ID . " IN " . BRANCHALL;
            }

            // $or_where = '';
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_three_multi_where($this->pmsdetails->tbl_name, $where, $where_date, $or_where, 'count(' . $this->pmsdetails->ID . ') AS CNT', '', '', '', $where_date_like);

                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $ppms_data = $this->basemodel->fetch_records_from_three_multi_where_pagination($this->pmsdetails->tbl_name, $where, $where_date, $or_where, '*', $this->pmsdetails->PMS_DONE, 'desc', '10', $limit_val * 10, $where_date_like);
            } else {
                $ppms_data = $this->basemodel->fetch_records_from_three_multi_where($this->pmsdetails->tbl_name, $where, $where_date, $or_where, '*', $this->pmsdetails->PMS_DONE, 'desc', '', $where_date_like);
            }
            //return $this->db->last_query();

            $uwhere = array();
            $uwhere[$this->pmsdetails->PMS_ASSIGNED_TO] = $user_id;
            $uwhere[$this->pmsdetails->COMPLETED_BY] = NULL;

            $user_pms = $this->basemodel->fetch_records_from($this->pmsdetails->tbl_name,$uwhere);
            if(!empty($user_pms)){
                if(empty($ppms_data)){
                    $ppms_data = $user_pms;
                } else{
                    $ppms_data = array_merge($ppms_data,$user_pms);
                }
            }
            if(!empty($user_pms)){
                if(empty($ppms_data)){
                    $ppms_data = $user_pms;
                } else{
                    $ppms_data = array_merge($ppms_data,$user_pms);
                }
            }
            $new_array = array();
            foreach ($ppms_data as $entry) {
                if (empty($new_array[$entry['EID']]))
                    $new_array[$entry['EID']] = $entry;
            }
            $ppms_data = array_values($new_array);

            for($i=0;$i<count($ppms_data);$i++){
                $fetch_device = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID => $ppms_data[$i]['EID']),array($this->devices->ASSIGN_ID));
                //return $this->db->last_query();
                if($fetch_device){
                    $ppms_data[$i]['ASSIGN_ID'] = $fetch_device['ASSIGN_ID'];
                }
            }
            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }
            // return $this->db->last_query();
            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));
            $pms = array();
            for ($i = 0; $i < count($devices); $i++) {
                if($mycalls == "YES"){
                    $bwhere[$this->pmsdetails->PMS_ASSIGNED_TO] = $user_id;
                }
                $bwhere[$this->pmsdetails->COMPLETED_BY] = NULL;
                $bwhere[$this->pmsdetails->EID] = $devices[$i]['ASSIGN_ID'];
                $whereQ_date_like = array($this->pmsdetails->PMS_DUE_DATE => date('Y-m'));
                $pms_details = $this->basemodel->fetch_single_row_like($this->pmsdetails->tbl_name, $bwhere,$whereQ_date_like);
                if (!empty($pms_details)) {
                    $pms_details['ASSIGN_ID'] = $devices[$i]['E_ID'];
                    array_push($pms, $pms_details);
                }
            }
            if (!empty($pms) || !empty($ppms_data))
                $ppms_data = array_merge($ppms_data, $pms);

            if (!empty($ppms_data)) {
                $data['pending_pms'] = $this->baselibrary->scheduled_pms_details($ppms_data, $role_code, $user_id);
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }

            /* if (!empty($ppms_data)) {
                 $data['pending_pms'] = $this->baselibrary->scheduled_pms_details($ppms_data, $role_code, $user_id);
                 $data['response'] = SUCCESSDATA;
             } else {
                 $data['response'] = EMPTYDATA;
             }*/


            if (isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls")
                return $ppms_data;
        }
        return $data;
    }


    private function _get_pending_bmeqc($jodata = array())
    {
        $or_where = '';
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $mycalls = isset($jodata->mycalls) ? $jodata->mycalls : '';
            $where = array();
            if (isset($jodata->department) && $jodata->department != "")
                $where[$this->qcdetails->BRANCH_ID] = $jodata->department;
            if (isset($jodata->eqpid) && $jodata->eqpid != "")
                $where[$this->qcdetails->EID] = $jodata->eqpid;
            if ($jodata->action == "get_complete_bmecalls")
                $where[$this->cms->ATTENDED_BY] = $user_id;
            $where[$this->qcdetails->ORG_ID] = $org_id;
            $where[$this->qcdetails->COMPLETED_BY] = NULL;
            if ($role_code != HMADMIN) {
                if ($jodata->action == "my_open_calls" || (isset($jodata->aaction) && $jodata->aaction == "get_hod_calls") || (isset($jodata->mycalls))) {
                    if ($mycalls != '' && $mycalls == YESSTATE) {
                        $where[$this->qcdetails->ASSIGNED_TO] = $user_id;
                    }
                } else {

                    // $or_where = "(" . $this->qcdetails->ASSIGNED_TO . " IS NULL OR " . $this->qcdetails->ASSIGNED_TO . "='" . $user_id . "')";
                }
            }

            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls" )
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
                    $or_where = $this->qcdetails->EID . " IN " . $device;
                }

                else
                    $or_where = '';

            }

            if ($branch_id != 'All')
                $where[$this->qcdetails->BRANCH_ID] = $branch_id;
            else {
                $or_where .= ($or_where == '') ? '' : " AND ";
                $or_where .= $this->qcdetails->BRANCH_ID . " IN " . BRANCHALL;
            }

            $where_date = "";
            $where_date_like = array();
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
                $where_date = $this->qcdetails->QC_DONE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            else
                $where_date_like = array($this->qcdetails->QC_DUE => date('Y-m'));
            //$where_date_like = "";
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_three_multi_where($this->qcdetails->tbl_name, $where, $where_date, $or_where, 'count(' . $this->qcdetails->ID . ') AS CNT', '', '', '', $where_date_like);
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $pqc_data = $this->basemodel->fetch_records_from_three_multi_where_pagination($this->qcdetails->tbl_name, $where, $where_date, $or_where, '*', $this->qcdetails->QC_DONE, 'desc', '10', $limit_val * 10, $where_date_like);
            } else {
                $pqc_data = $this->basemodel->fetch_records_from_three_multi_where($this->qcdetails->tbl_name, $where, $where_date, $or_where, '*', $this->qcdetails->QC_DONE, 'desc', '', $where_date_like);
            }
            //return $this->db->last_query();
            //$data['qry'] = $this->db->last_query();
            /* if (!empty($pqc_data)) {
                 $data['pending_qc'] = $this->baselibrary->scheduled_qc_details($pqc_data, $role_code, $user_id);
                 $data['response'] = SUCCESSDATA;
             }
             else {
                 $data['response'] = EMPTYDATA;
             }
             */

            $uwhere = array();
            $uwhere[$this->qcdetails->ASSIGNED_TO] = $user_id;
            $uwhere[$this->qcdetails->COMPLETED_BY] = NULL;

            $user_qc = $this->basemodel->fetch_records_from($this->qcdetails->tbl_name,$uwhere);
            if(!empty($user_qc)){
                if(empty($pqc_data)){
                    $pqc_data = $user_qc;
                } else{
                    $pqc_data = array_merge($pqc_data,$user_qc);
                }
            }
            $new_array = array();
            foreach ($pqc_data as $entry) {
                if (empty($new_array[$entry['EID']]))
                    $new_array[$entry['EID']] = $entry;
            }
            $pqc_data = array_values($new_array);

            for($i=0;$i<count($pqc_data);$i++){
                $fetch_device = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID => $pqc_data[$i]['EID']),array($this->devices->ASSIGN_ID));
                //return $this->db->last_query();
                if($fetch_device){
                    $pqc_data[$i]['ASSIGN_ID'] = $fetch_device['ASSIGN_ID'];
                }
            }
            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }
            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));
            //return $this->db->last_query();
            $qc = array();
            for ($i = 0; $i < count($devices); $i++) {
                if($mycalls == "YES"){
                    $bwhere[$this->qcdetails->ASSIGNED_TO] = $user_id;
                }
                $bwhere[$this->qcdetails->COMPLETED_BY] = NULL;
                $bwhere[$this->qcdetails->EID] = $devices[$i]['ASSIGN_ID'];
                $whereQ_date_like = array($this->qcdetails->QC_DUE => date('Y-m'));
                $qc_details = $this->basemodel->fetch_single_row_like($this->qcdetails->tbl_name, $bwhere,$whereQ_date_like);
                if (!empty($qc_details)) {
                    $qc_details['ASSIGN_ID'] = $devices[$i]['E_ID'];
                    array_push($qc, $qc_details);
                }
            }
            if (!empty($qc) || !empty($pqc_data))
                $pqc_data = array_merge($pqc_data, $qc);

            $new_array1 = array();
            foreach ($pqc_data as $entry) {
                if (empty($new_array1[$entry['ID']]))
                    $new_array1[$entry['ID']] = $entry;
            }
            $pqc_data = array_values($new_array1);

            if (!empty($pqc_data)) {
                $data['pending_qc'] = $this->baselibrary->scheduled_qc_details($pqc_data, $role_code, $user_id);
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }

            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls" )
                return $pqc_data;

        }

        return $data;
    }

    private function _get_completed_bmepms($jodata = array())
    {
        $data = array();
        $where_date = "";
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where = array();
            if (isset($jodata->department) && $jodata->department != "")
                $where[$this->pmsdetails->BRANCH_ID] = $jodata->department;
            if (isset($jodata->eqpid) && $jodata->eqpid != "")
                $where[$this->pmsdetails->EID] = $jodata->eqpid;
            if($jodata->action=="get_completed_bmepms" || $jodata->action=="my_closed_calls")
            {
                $where[$this->pmsdetails->COMPLETED_BY] = $user_id;
                $where[$this->pmsdetails->PMS_ACTL_DONE]=date('Y-m-d');
            }
            else
                $where[$this->pmsdetails->PMS_ACTL_DONE]=date('Y-m-d');

            $where[$this->pmsdetails->PMS_ACTL_DONE." !="]=NULL;
            $where[$this->pmsdetails->ORG_ID] = $org_id;
            $where[$this->pmsdetails->BRANCH_ID] = $branch_id;

           // if (isset($jodata->fromdate) && isset($jodata->todate) && $jodata->fromdate != ""  && $jodata->todate != "")
              //  $where_date = $this->pmsdetails->PMS_DUE_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
           // else
           // {
                $where_date = $this->pmsdetails->PMS_DUE_DATE." LIKE '%".date('Y-m')."%'";
         //   }

            if($branch_id != 'All')
                $where[$this->pmsdetails->BRANCH_ID] = $branch_id;
            else
            {
                $where_date .= ($where_date == '') ? '' : " AND ";
                $where_date .= $this->pmsdetails->BRANCH_ID. " IN ".BRANCHALL;
            }

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->pmsdetails->tbl_name, $where, $where_date, 'count('.$this->pmsdetails->ID.') AS CNT');
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
                $cpms_data = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->pmsdetails->tbl_name, $where, $where_date,'','','','', '*', $this->pmsdetails->PMS_DONE, 'desc','10',$limit_val*10);
            }
            else
            {
                $cpms_data = $this->basemodel->fetch_records_from_multi_where($this->pmsdetails->tbl_name, $where, $where_date, '*', $this->pmsdetails->PMS_DONE, 'desc');
            }

            //$data['qry'] = $this->db->last_query();
            if (!empty($cpms_data)) {
                $data['completed_pms'] = $this->baselibrary->scheduled_pms_details($cpms_data);
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
            return $data;
        }
    }

    private function _get_completed_bmeqcs($jodata = array())
    {
        if (!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where = array();
            if (isset($jodata->department) && $jodata->department != "")
                $where[$this->qcdetails->BRANCH_ID] = $jodata->department;
            if (isset($jodata->eqpid) && $jodata->eqpid != "")
                $where[$this->qcdetails->EID] = $jodata->eqpid;
            if($jodata->action=="get_completed_bmeqcs" || $jodata->action=="my_closed_calls")
            {
                $where[$this->qcdetails->COMPLETED_BY] = $user_id;
            }
            else
                $where[$this->qcdetails->QC_ACTL_DONE." !="] = NULL;
            $where[$this->qcdetails->QC_ACTL_DONE] = date('Y-m-d');
            $where[$this->qcdetails->ORG_ID] = $org_id;

            //$where[$this->Pmsdetails->STATUS]=DW;
            $where_date = "";
          //  if (isset($jodata->fromdate) && isset($jodata->todate) && $jodata->fromdate != ""  && $jodata->todate != "")
               // $where_date = $this->qcdetails->QC_DONE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
          //  else
           // {
                $where[$this->qcdetails->QC_ACTL_DONE] = date('Y-m-d');
         //   }

            if($branch_id != 'All')
                $where[$this->qcdetails->BRANCH_ID] = $branch_id;
            else
            {
                $where_date .= ($where_date == '') ? '' : " AND ";
                $where_date .= $this->qcdetails->BRANCH_ID ." IN ".BRANCHALL;
            }

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->qcdetails->tbl_name, $where, $where_date, 'count('.$this->qcdetails->ID.') AS CNT');
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
                $cqc_data = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->qcdetails->tbl_name, $where, $where_date,'','','','', '*', $this->qcdetails->QC_DONE, 'desc','10',$limit_val*10);
            }
            else
            {
                $cqc_data = $this->basemodel->fetch_records_from_multi_where($this->qcdetails->tbl_name, $where, $where_date, '*', $this->qcdetails->QC_DONE, 'desc');
            }

            //$data['qry'] = $this->db->last_query();
            if (!empty($cqc_data)) {
                $data['completed_qcs'] = $this->baselibrary->scheduled_qc_details($cqc_data);
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
    private function _create_training($jodata = array())
    {
        $data =array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $insert_training[$this->trainings->ORG_ID] = $org_id;
            $insert_training[$this->trainings->BRANCH_ID] = $branch_id;
            $insert_training[$this->trainings->TR_TYPE] = $jodata->ttype;
            $insert_training[$this->trainings->TR_BY] = $jodata->trngby;
            $insert_training[$this->trainings->TR_DATE] = date('Y-m-d', strtotime($jodata->current_date));
            $insert_training[$this->trainings->TR_TIME] = date('H:i:00', strtotime($jodata->current_time));
            $insert_training[$this->trainings->USERNAME] = $user_id;
            $insert_training[$this->trainings->SUBJECT] = $jodata->content;
            $insert_training[$this->trainings->TR_TO] = implode(',', $jodata->trainees);
            if ($role_code == HBHOD || $role_code == HMADMIN)
                $insert_training[$this->trainings->STATUS] = APPROVED;
            else
                $insert_training[$this->trainings->STATUS] = PENDING;
            if ($this->basemodel->insert_into_table($this->trainings->tbl_name, $insert_training)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Training Created Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Update Training Failed";
            }
        }
        return $data;

    }

    private function _conduct_training($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {

            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $insert_training[$this->trainings->TR_COMP] = date('Y-m-d', strtotime($jodata->End_date));
            $insert_training[$this->trainings->REMARKS] = $jodata->Remarks;
            $insert_training[$this->trainings->T_COUNT] = (int)$jodata->tcount;
            $where[$this->trainings->ID] = $jodata->ID;
            if ($this->basemodel->update_operation($insert_training, $this->trainings->tbl_name, $where)) {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Training Conducted Successfully";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Training Failed";
            }
        }
        return $data;
    } private function _get_request_approve($jodata = array())
{
    $data =array();
    if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
    {
        $updat_training[$this->trainings->STATUS] = $jodata->tstatus;
        $where[$this->trainings->ID] = $jodata->ID;
        if ($this->basemodel->update_operation($updat_training, $this->trainings->tbl_name, $where)) {
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Request ".$jodata->tstatus." Successfully";
        } else {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable to Process Your Request Try again";
        }
    }
    return $data;
}

    private function _give_training_feedback($jodata = array())
    {
        $data =array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $itrain_attends[$this->trainingattends->TID] = $jodata->ID;
            $itrain_attends[$this->trainingattends->USER_NAME] = $user_id;
            $itrain_attends[$this->trainingattends->BRANCH_ID] = $branch_id;
            $itrain_attends[$this->trainingattends->ORG_ID] = $org_id;
            $itrain_attends[$this->trainingattends->FEEDBACK] = $jodata->feedback;
            $itrain_attends[$this->trainingattends->TOPIC] = $jodata->TOPIC;
            $itrain_attends[$this->trainingattends->MAKE_OEM] = $jodata->MAKE_OEM;
            $itrain_attends[$this->trainingattends->EQ_MODEL] = $jodata->EQ_MODEL;
            $itrain_attends[$this->trainingattends->UNDRSTD_TRNG] = $jodata->UNDRSTD_TRNG;
            $itrain_attends[$this->trainingattends->TRNG_LNGTH] = $jodata->TRNG_LNGTH;
            $itrain_attends[$this->trainingattends->NEW_INFO_IN_TRNG] = $jodata->NEW_INFO_IN_TRNG;
            $itrain_attends[$this->trainingattends->ON_JOB_USE_OF_TRNG] = $jodata->ON_JOB_USE_OF_TRNG;
            $itrain_attends[$this->trainingattends->EXAMPLES_HTLP_IN_TRNG] = $jodata->EXAMPLES_HTLP_IN_TRNG;
            $itrain_attends[$this->trainingattends->USEFULNES_IN_CURENT_JOB] = $jodata->USEFULNES_IN_CURENT_JOB;
            $itrain_attends[$this->trainingattends->TRAINER_ACTIVNES] = $jodata->TRAINER_ACTIVNES;
            $itrain_attends[$this->trainingattends->DOUBTS_CLARIFY_TRAINER] = $jodata->DOUBTS_CLARIFY_TRAINER;
            $itrain_attends[$this->trainingattends->SUBJECT_FIT_TO_TRAIN] = $jodata->SUBJECT_FIT_TO_TRAIN;
            $itrain_attends[$this->trainingattends->TRAINING_FEDBACK_RATING] = $jodata->TRAINING_FEDBACK_RATING;
            if($this->basemodel->insert_into_table($this->trainingattends->tbl_name,$itrain_attends))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Thankyou for Feedback";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable to submit your feedback, please try again";
            }
        }
        return $data;
    }


    private function _get_trainings($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->trainings->USERNAME]=$user_id;
            $where[$this->trainings->STATUS] = $jodata->tstatus;
            $where[$this->trainings->ORG_ID] = $org_id;
            $where[$this->trainings->BRANCH_ID] = $branch_id;
            $where[$this->trainings->TR_COMP] =NULL;
            $where_date = "";
            if ($jodata->fromdate != "" && $jodata->todate != "")
                $where_date = $this->trainings->TR_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            $approve_data = $this->basemodel->fetch_records_from_multi_where($this->trainings->tbl_name, $where, $where_date, '*',  $this->trainings->TR_DATE, 'desc');
            // return  $this->db->last_query();
            if (!empty($approve_data))
            {
                $approve_data = $this->baselibrary->training_list($approve_data);
                $data['tranings_approved'] = $approve_data;
                $data['response'] = SUCCESSDATA;
            }
            else
            {
                $data['response'] = EMPTYDATA;

            }
            return $data;

        }
    }

    private function _training_feedback($jodata = array())
    {
        $data=array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            //$where[$this->trainings->USERNAME]=$user_id;
            $where[$this->trainings->STATUS] = $jodata->tstatus;
            $where[$this->trainings->ORG_ID] = $org_id;
            $where[$this->trainings->BRANCH_ID] = $branch_id;
            $feedback_data = $this->basemodel->fetch_records_from($this->trainings->tbl_name, $where);
            if (!empty($feedback_data)) {
                for ($i = 0; $i < count($feedback_data); $i++) {
                    $feedback_data[$i]['USERNAME'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $feedback_data[$i][$this->trainings->USERNAME]));
                    $approve_data[$i]['TDATETIME'] = strtotime($feedback_data[$i][$this->trainings->TR_DATE] . ' ' . $feedback_data[$i][$this->trainings->TR_TIME]);

                }
                $data['tranings_feedback'] = $feedback_data;
                $data['response'] = SUCCESSDATA;

            } else {
                $data['response'] = EMPTYDATA;

            }
        }
        return $data;
    }

    private function _add_device($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            /*$device_insert = false;
            $pms_insert = false;
            $qc_insert = false;
            $response = array();
            $device_data = $jodata->device_data;
            //$qrcode = QR_URL . $device_data->eqpid;
            $breackdowndate = date('Y-m-d', strtotime($device_data->breackdowndate));
            $contractfrom = date('Y-m-d', strtotime($device_data->contractfrom));
            $contractto = date('Y-m-d', strtotime($device_data->contractto));
            $date_of_install1 = date('Y-m-d', strtotime($device_data->date_of_install));
            $manufacture_date1 = date('Y-m-d', strtotime($device_data->manufacture_date));
            $podate1 = date('Y-m-d', strtotime($device_data->podate));
            $pmsdate = date('Y-m-d', strtotime($device_data->pmsdate));
            $qcdate = date('Y-m-d', strtotime($device_data->qcdate));
            $insert_device[$this->devices->LB_DATE] = $breackdowndate;
            $insert_device[$this->devices->C_FROM] = $contractfrom;
            $insert_device[$this->devices->C_TO] = $contractto;
            $insert_device[$this->devices->DATEOF_INSTALL] = $date_of_install1;
            $insert_device[$this->devices->MF_DATE] = $manufacture_date1;
            $insert_device[$this->devices->PDATE] = $podate1;
            $insert_device[$this->devices->PDATE] = $podate1;
            $insert_device[$this->devices->ORG_ID] = $this->session->org_id;
            $insert_device[$this->devices->USERNAME] = $this->session->user_name;
            $insert_device[$this->devices->BRANCH_ID] = $this->session->branch_id;
            $insert_device[$this->devices->DEPT_ID] = $device_data->department;
            $insert_device[$this->devices->E_COND] = $device_data->equpcon;
            $insert_device[$this->devices->AMC_TYPE] = $device_data->ctypes;
            $insert_device[$this->devices->DESC_P] = $device_data->desc;
            $insert_device[$this->devices->EQ_CLASS] = $device_data->equpmentclass;
            $insert_device[$this->devices->BD_COST] = $device_data->rcbreakdowncost;
            $insert_device[$this->devices->BD_COUNT] = $device_data->rcbreakdown;
            $insert_device[$this->devices->AMC_VALUE] = $device_data->rccntrctvalue;
            $insert_device[$this->devices->C_NAME] = $device_data->rccompnyname;
            $insert_device[$this->devices->E_COST] = $device_data->rcecost;
            $insert_device[$this->devices->E_MODEL] = $device_data->rcemodel;
            $insert_device[$this->devices->ACCSSORIES] = $device_data->rcaccessoriesno;
            $insert_device[$this->devices->E_NAME] = $device_data->rcename;
            $insert_device[$this->devices->PONO] = $device_data->rcpono;
            $insert_device[$this->devices->REMARKS] = $device_data->rcremark;
            $insert_device[$this->devices->VENDOR] = $device_data->rcsname;
            $insert_device[$this->devices->ES_NUMBER] = $device_data->rcserial_number;
            $insert_device[$this->devices->E_ID] = $device_data->eqpid;
            $insert_device[$this->devices->EQ_CONDATION] = $device_data->status;
            $insert_device[$this->devices->UTILIZATION] = $device_data->utilization;
            $insert_device[$this->devices->QR_CODE] = $qrcode;

            if ($this->basemodel->insert_into_table($this->devices->tbl_name, $insert_device)) {
                $device_insert = true;
                $response['device_response'] = SUCCESSDATA;
            } else {
                $device_insert = false;
                $response['device_response'] = FAILEDATA;
            }

            if ($device_insert) {
                $pmsval = ceil(365 / $device_data->noofpms);
                $pmsdue = '';
                if ($pmsdate != '') {
                    $date_arr = explode('-', $pmsdate);
                    $pmsdue = date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[2] + $pmsval, $date_arr[0]));
                    $insert_pms[$this->pmsdetails->PMS_COUNT] = $device_data->noofpms;
                    $insert_pms[$this->pmsdetails->ORG_ID] = $this->session->org_id;
                    $insert_pms[$this->pmsdetails->EID] = $device_data->eqpid;
                    $insert_pms[$this->pmsdetails->BRANCH_ID] = $this->session->branch_id;
                    $insert_pms[$this->pmsdetails->PMS_DONE] = $pmsdate;
                    $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                    if ($this->basemodel->insert_into_table($this->pmsdetails->tbl_name, $insert_pms)) {
                        $pms_insert = true;
                        $response['pms_response'] = SUCCESSDATA;
                    } else {
                        $response['pms_response'] = FAILEDATA;
                    }
                }

                $qcval = ceil(365 / $device_data->noofqcs);
                if ($qcdate != '') {
                    $date_arr = explode('-', $qcdate);
                    $qcdue = date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[2] + $qcval, $date_arr[0]));
                    $insert_qc[$this->qcdetails->QC_COUNT] = $device_data->noofqcs;
                    $insert_qc[$this->qcdetails->ORG_ID] = $this->session->org_id;
                    $insert_qc[$this->qcdetails->EID] = $device_data->eqpid;
                    $insert_qc[$this->qcdetails->BRANCH_ID] = $this->session->branch_id;
                    $insert_qc[$this->qcdetails->QC_DONE] = $qcdate;
                    $insert_qc[$this->qcdetails->QC_DUE] = $qcdue;
                    if ($this->basemodel->insert_into_table($this->qcdetails->tbl_name, $insert_qc)) {
                        $qc_insert = true;
                        $response['qc_response'] = SUCCESSDATA;
                    } else {
                        $response['qc_response'] = FAILEDATA;
                    }
                }
                $date = date('Y-m-d H:i:s');
                $curenttime = date('H:i:s');
                $curentdate = date('Y-m-d');
                $desc = $device_data->eqpid . " Record is Inserted Manually by " . $this->session->user_name;
                $response['status_response'] = $this->baselibrary->equipment_status_tbl_insert($device_data->eqpid,$device_data->rccompnyname,$device_data->status,$date);
                $response['calllog_response'] = $this->baselibrary->insert_calllog($this->session->user_name,$desc,$curentdate,$curenttime,$date);
            }*/
            //return $response;
        }
    }

    private function _search_device($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $data = array();
            $where = array();
            $action = $jodata->action;
            if ($action == "search_by_id") {
                $where[$this->devices->E_ID] = $jodata->esid;
            } else if ($action == "search_by_accserial") {
                $where[$this->devices->ES_NUMBER] = $jodata->esid;
            } else if ($action == "search_by_spono") {
                $where[$this->devices->PONO] = $jodata->esid;
            }
            if($jodata->user_role_code!=HMADMIN)
                $where[$this->devices->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->devices->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $device_id = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_ID, $where);
            if ($device_id == "-")
            {
                $data['response'] = EMPTYDATA;
            }
            else
            {
                $data['response'] = SUCCESSDATA;
                unset($where[$this->devices->E_ID]);
                unset($where[$this->devices->ES_NUMBER]);
                unset($where[$this->devices->PONO]);
                $where[$this->pmsdetails->EID] = $device_id;
                $pms_data = $this->basemodel->fetch_single_row($this->pmsdetails->tbl_name, $where, '*' ,$this->pmsdetails->ID,'desc');
                $data[$this->pmsdetails->PMS_COUNT] = $pms_data[$this->pmsdetails->PMS_COUNT];
                $data[$this->pmsdetails->PMS_DONE] = $pms_data[$this->pmsdetails->PMS_DONE];
                $data[$this->pmsdetails->PMS_DUE_DATE] = $pms_data[$this->pmsdetails->PMS_DUE_DATE];
                $data[$this->pmsdetails->PMS_ACTL_DONE] = $pms_data[$this->pmsdetails->PMS_ACTL_DONE];

                $qc_details = $this->basemodel->fetch_single_row($this->qcdetails->tbl_name, $where,'*',$this->qcdetails->ID,'desc');
                $data['contract_details'] = $this->basemodel->fetch_single_row($this->deviceamcs->tbl_name, $where,'*',$this->deviceamcs->ID,'desc');
                $data['contract_details']['vednor_details'] = $this->basemodel->fetch_single_row($this->devicevendors->tbl_name,array($this->devicevendors->ID => $data['contract_details'][$this->deviceamcs->AMC_VENDOR]));
                $data[$this->qcdetails->QC_COUNT] = $qc_details[$this->qcdetails->QC_COUNT];
                $data[$this->qcdetails->QC_DONE] = $qc_details[$this->qcdetails->QC_DONE];
                $data[$this->qcdetails->QC_DUE] = $qc_details[$this->qcdetails->QC_DUE];
                $data[$this->qcdetails->QC_ACTL_DONE] = $qc_details[$this->qcdetails->QC_ACTL_DONE];
                $ewhere[$this->devices->E_ID] = $device_id;
                $expolded_eid = explode("-",$device_id);
                $classification_id = $expolded_eid[4];
                $ewhere[$this->devices->ORG_ID] = $where[$this->devices->ORG_ID];
                if($jodata->user_role_code!=HMADMIN)
                    $ewhere[$this->devices->BRANCH_ID] = $where[$this->devices->BRANCH_ID];

                $data['device_details'] = $this->basemodel->fetch_single_row($this->devices->tbl_name, $ewhere);
                $data['device_details']['classification'] = $this->basemodel->get_single_column_value($this->classifications->tbl_name, $this->classifications->MASTER_CLASS, array($this->classifications->CODE => $classification_id));
                $data['device_details'][$this->devices->E_COND] = $this->basemodel->get_single_column_value($this->equpconditions->tbl_name, $this->equpconditions->ECODE, array($this->equpconditions->EVAL => $data['device_details'][$this->devices->E_COND]));
                $data['device_details'][$this->devices->UTILIZATION] = $this->basemodel->get_single_column_value($this->utillvalues->tbl_name, $this->utillvalues->NAME, array($this->utillvalues->VALUE => $data['device_details'][$this->devices->UTILIZATION]));
                $data['device_details'][$this->devices->DISTRIBUTOR] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $data['device_details'][$this->devices->DISTRIBUTOR]));
                $data['device_details'][$this->devices->C_NAME] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $data['device_details'][$this->devices->C_NAME]));
               
                




			   if (isset($jodata->last_cms) && $jodata->last_cms == "yes")
                {
                    $lcms_details = $this->basemodel->fetch_single_row($this->cms->tbl_name, $where, '*', $this->cms->CDATE, 'desc');
                    if (!empty($lcms_details))
                    {
                        $data['cms_details'] = $lcms_details;
                        if ($data['cms_details'][$this->cms->RESPONDED_DATE] == NULL)
                        {
                            $data['attend_by'] = array();
                            $data['cms_details']['complaint_status'] = 'not_responded';
                        }
                        else
                        {
                            $data['attend_by'] = $this->basemodel->fetch_single_row($this->users->tbl_name,array($this->users->USER_ID=>$data['cms_details'][$this->cms->RESPONDED_BY]),array($this->users->USER_NAME,$this->users->EMP_NO,$this->users->MOBILE_NO));
                            $data['cms_details']['complaint_status'] = 'responded';
                            if ($data['cms_details'][$this->cms->ATTENDED_DATE] != NULL)
                            {
                                $data['attend_by'] = $this->basemodel->fetch_single_row($this->users->tbl_name,array($this->users->USER_ID=>$data['cms_details'][$this->cms->ATTENDED_BY]),array($this->users->USER_NAME,$this->users->EMP_NO,$this->users->MOBILE_NO));
                                $data['cms_details']['complaint_status'] = 'attended';
                            }

                            if ($data['cms_details'][$this->cms->STATUS] == UMAINTENCE)
                            {
                                $data['cms_details']['complaint_status'] = 'pending';
                                $data['attend_by'] = $this->basemodel->fetch_single_row($this->users->tbl_name,array($this->users->USER_ID=>$data['cms_details'][$this->cms->ATTENDED_BY]),array($this->users->USER_NAME,$this->users->EMP_NO,$this->users->MOBILE_NO));
                                $data['cms_details']['complaint_status'] = 'attended';
                            }

                            if ($data['cms_details'][$this->cms->STATUS] == DW)
                                $data['cms_details']['complaint_status'] = 'completed';
                        }
                        $data['cms_details']['response'] = SUCCESSDATA;
                    }
                    else
                    {
                        $data['cms_details']['response'] = EMPTYDATA;
                        $data['cms_details']['complaint_status'] = "completed";
                    }
                }
                else
                {
                    $cms_details = $this->basemodel->fetch_records_from($this->cms->tbl_name, $where, '*', $this->cms->CDATE, 'desc');
                    if (!empty($cms_details))
                    {
                        $data['cms_details'] = $this->baselibrary->cms_call_details($cms_details);
                        $data['cms_details']['response'] = SUCCESSDATA;
                    }
                    else
                    {
                        $data['cms_details']['response'] = EMPTYDATA;
                    }
                }
                $data['history'] = $this->_equipment_history($jodata,$device_id);
				$org_id =isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                 $lablewhere[$this->devicelabels->ORG_MODULE] = $org_type;
                $lablewhere[$this->devicelabels->ORG_ID] = $org_id;
                //$select = array($this->equpcondlabels->ECOND,$this->devicelabels->EVAL,$this->equpcondlabels->STATUS,$this->equpcondlabels->ACTION);
                $data['labels'] = $this->basemodel->fetch_single_row($this->devicelabels->tbl_name,$lablewhere);
            }
            return $data;
        }
    }

    private function _print_labels($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $data = array();
            $where = array();
            if (isset($jodata->dept_id) && $jodata->dept_id != "")
            {
                $where[$this->devices->E_ID." !="] = NULL;
                $where[$this->devices->E_ID." !="] = '';
                $where[$this->devices->ORG_ID] = $this->session->org_id;
                $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
                $or_where = '';
                if($branch_id != 'All' )
                    $where[$this->devices->BRANCH_ID] = $branch_id;
                else
                    $or_where = $this->devices->BRANCH_ID." IN ".BRANCHALL;

                $select = array($this->devices->E_NAME, $this->devices->E_ID, $this->devices->DEPT_ID, $this->devices->QR_CODE,$this->devices->ES_NUMBER,$this->devices->E_MODEL);
                if ($jodata->dept_id != ALL)
                {
                    $where[$this->devices->DEPT_ID] = $jodata->dept_id;
                }
                $data['devices'] = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name, $where,$or_where, $select);

                if (!empty($data['devices'])) {
                    $data['response'] = SUCCESSDATA;
                    for ($dc = 0; $dc < count($data['devices']); $dc++) {
                        // device pms details
                        /*$pms_where[$this->pmsdetails->EID] = $data['devices'][$dc][$this->devices->E_ID];
                        $pms_where[$this->pmsdetails->ORG_ID] = $where[$this->devices->ORG_ID];
                        $pms_where[$this->pmsdetails->BRANCH_ID] = $where[$this->devices->BRANCH_ID];
                        $pms_select = array($this->pmsdetails->PMS_DONE, $this->pmsdetails->PMS_DUE_DATE);
                        $data['devices'][$dc]['pms'] = $this->basemodel->fetch_single_row($this->pmsdetails->tbl_name, $pms_where, $pms_select);

                        // device qc details
                        $qc_where[$this->qcdetails->EID] = $data['devices'][$dc][$this->devices->E_ID];
                        $qc_where[$this->qcdetails->ORG_ID] = $where[$this->devices->ORG_ID];
                        $qc_where[$this->qcdetails->BRANCH_ID] = $where[$this->devices->BRANCH_ID];
                        $qc_select = array($this->qcdetails->QC_DONE, $this->qcdetails->QC_DUE);
                        $data['devices'][$dc]['qc'] = $this->basemodel->fetch_single_row($this->qcdetails->tbl_name, $qc_where, $qc_select);*/

                        /* device department name */
                        $data['devices'][$dc]['DEPT_NAME'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $data['devices'][$dc][$this->devices->DEPT_ID]));
                    }
                } else {
                    $data['response'] = EMPTYDATA;
                }
            }
            else
                $data['response'] = EMPTYDATA;
            return $data;
        }
    }
    private function _print_labels_pms_cal($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $data = array();
            $where = array();
            if (isset($jodata->dept_id) && $jodata->dept_id != "")
            {
                $where[$this->devices->E_ID." !="] = NULL;
                $where[$this->devices->ORG_ID] = $this->session->org_id;
                $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
                $or_where = '';
                if(branch_id != 'All')
                {
                    $where[$this->devices->BRANCH_ID] = $branch_id;
                }
                else
                    $or_where = $this->devices->BRANCH_ID."IN".BRANCHALL;

                $select = array($this->devices->E_NAME, $this->devices->E_ID, $this->devices->DEPT_ID, $this->devices->QR_CODE,$this->devices->ES_NUMBER,$this->devices->E_MODEL);
                if($jodata->dept_id != ALL)
                {
                    $where[$this->devices->DEPT_ID] = $jodata->dept_id;
                }
                $data['devices'] = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name, $where,$or_where, $select);
                if (!empty($data['devices']))
                {
                    $data['response'] = SUCCESSDATA;
                    for ($dc = 0; $dc < count($data['devices']); $dc++)
                    {
                        //device pms details
                        $pms_where[$this->pmsdetails->EID] = $data['devices'][$dc][$this->devices->E_ID];
                        $pms_where[$this->pmsdetails->ORG_ID] = $where[$this->devices->ORG_ID];
                        $pms_where[$this->pmsdetails->BRANCH_ID] = $branch_id;
                        $pms_select = array($this->pmsdetails->PMS_DONE, $this->pmsdetails->PMS_DUE_DATE);
                        $data['devices'][$dc]['pms'] = $this->basemodel->fetch_single_row($this->pmsdetails->tbl_name, $pms_where, $pms_select,$this->pmsdetails->ID,'DESC');

                        //device qc details
                        $qc_where[$this->qcdetails->EID] = $data['devices'][$dc][$this->devices->E_ID];
                        $qc_where[$this->qcdetails->ORG_ID] = $where[$this->devices->ORG_ID];
                        $qc_where[$this->qcdetails->BRANCH_ID] = $branch_id;
                        $qc_select = array($this->qcdetails->QC_DONE, $this->qcdetails->QC_DUE);
                        $data['devices'][$dc]['qc'] = $this->basemodel->fetch_single_row($this->qcdetails->tbl_name, $qc_where, $qc_select,$this->qcdetails->ID,'DESC');

                        /* device department name */
                        $data['devices'][$dc]['DEPT_NAME'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $data['devices'][$dc][$this->devices->DEPT_ID]));
                    }
                } else {
                    $data['response'] = EMPTYDATA;
                }
            }
            else
                $data['response'] = EMPTYDATA;
            return $data;
        }
    }

    private function _get_depart_devices($jodata = array())
    {

		if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $data = array();
            $where = array();
            $like = array();
            /*if($jodata->eqpid!='' ||  $jodata->spono!='' || $jodata->saccessoriesno!='' || $jodata->dept_id!='')
            {*/
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $org_type = isset($jodata->org_type) ? $jodata->org_type : $this->session->org_type;
            $today = date('Y-m-d');
            if($org_type != "Vendor")
            {
                if ($jodata->eqpid != '')
                    $where[$this->devices->E_ID] = $jodata->eqpid;
                if ($jodata->spono != '')
                    $like[$this->devices->E_NAME] = $jodata->spono;
                if ($jodata->saccessoriesno != '')
                    $where[$this->devices->ES_NUMBER] = $jodata->saccessoriesno;
                $where[$this->devices->ORG_ID] = $org_id;

                /*$where[$this->devices->E_ID." !="] = NULL;*/

                if ($jodata->dept_id != ALL && $jodata->dept_id != '')
                    $where[$this->devices->DEPT_ID] = $jodata->dept_id;

                $where[$this->devices->E_ID . " !="] = NULL;
                $where[$this->devices->STATUS] = ACT;

                $qry = $this->devices->EQ_CONDATION . " IN ('" . DW . "','" . DNW . "' ) ";
                if ($branch_id != 'All') {
                    $where[$this->devices->BRANCH_ID] = $branch_id;
                    $qry .= " AND ((" . $this->devices->RELOCATION_STATUS . "='" . YESSTATE . "' AND " . $this->devices->BRANCH_RELOCATION . "='" . $branch_id . "') OR " . $this->devices->RELOCATION_STATUS . " is null ) ";
                    $qry .= " AND ( " . $this->devices->BRANCH_ID . "='" . $branch_id . "' OR " . $this->devices->BRANCH_RELOCATION . "='" . $branch_id . "') ";
                } else {
                    $qry .= " AND ((" . $this->devices->RELOCATION_STATUS . "='" . YESSTATE . "' AND " . $this->devices->BRANCH_RELOCATION . " IN " . BRANCHALL . ") OR " . $this->devices->RELOCATION_STATUS . " is null ) ";
                    $qry .= " AND ( " . $this->devices->BRANCH_ID . " IN " . BRANCHALL . " OR " . $this->devices->BRANCH_RELOCATION . " IN " . BRANCHALL . ") ";
                }
            }
            else{
                $qry = '';
                $like = '';
                if ($jodata->spono != '')
                    $like[$this->devices->E_NAME] = $jodata->spono;
                if ($jodata->saccessoriesno != '')
                    $where[$this->devices->ES_NUMBER] = $jodata->saccessoriesno;
                // $where[$this->devices->STATUS] = ACT;
                $where[$this->devices->VENDOR] = $org_id;
				$where[$this->devices->C_TO.">="] = $today;
            }

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where_like($this->devices->tbl_name, $where,$qry, $like, 'count('.$this->devices->ID.') AS CNT');

                // $data['qry'] = $this->db->last_query();
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
                $list = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->devices->tbl_name, $where,$qry, $like, '*', $this->devices->ID, 'asc','10',$limit_val*10);
               /* $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $swhere[$this->devicelabels->ORG_MODULE] = $org_type;
                $swhere[$this->devicelabels->ORG_ID] = $org_id;
               // $select = array($this->equpcondlabels->ECODE,$this->equpcondlabels->EVAL,$this->equpcondlabels->STATUS,$this->equpcondlabels->ACTION);
                //$device_label = $this->basemodel->fetch_single_row($this->devicelabels->tbl_name,$swhere);*/
			}
            else
            {
                $list = $this->basemodel->fetch_records_from_multi_where_like($this->devices->tbl_name, $where,$qry,$like,'*',$this->devices->ID,'asc');
               /* $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $org_type = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_MODULE,array($this->organizations->ORG_ID=>$org_id));
                $swhere[$this->devicelabels->ORG_MODULE] = $org_type;
                $swhere[$this->devicelabels->ORG_ID] = $org_id;
               // $select = array($this->equpcondlabels->ECODE,$this->equpcondlabels->EVAL,$this->equpcondlabels->STATUS,$this->equpcondlabels->ACTION);
                $device_label = $this->basemodel->fetch_single_row($this->devicelabels->tbl_name,$swhere);*/
			
			}

           //  return $this->db->last_query();
            if (!empty($list) || !empty($device_label))
            {
                $data['response'] = SUCCESSDATA;
                for ($dc = 0; $dc < count($list); $dc++)
                {
                    $list[$dc]['docs'] = $this->baselibrary->read_files($list[$dc][$this->devices->UPLOAD_PATH]);
                    /* device pms details */
                    if(is_numeric($list[$dc][$this->devices->C_NAME]))
                    {
                        $list[$dc]['OEM'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name,$this->devicevendors->NAME,array($this->devicevendors->ID=>$list[$dc][$this->devices->C_NAME]));
                    }
                    else
                    {
                        $list[$dc]['OEM'] = $list[$dc][$this->devices->C_NAME]." (Update as per masters)";
                    }
                    $list[$dc]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_NAME,array($this->branches->BRANCH_ID=>$list[$dc][$this->devices->BRANCH_ID]));
                    $list[$dc]['category'] = $this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->NAME,array($this->devicenames->ID=>$list[$dc][$this->devices->E_CAT]));
                    $list[$dc]['vendor'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID=>$list[$dc][$this->devices->VENDOR]));
                    $list[$dc]['DISTRIBUTION'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $list[$dc][$this->devices->DISTRIBUTOR]));
                    $list[$dc]['eq_condition'] = $this->basemodel->get_single_column_value($this->equpconditions->tbl_name, $this->equpconditions->ECODE, array($this->equpconditions->EVAL => $list[$dc][$this->devices->E_COND]));
                    $list[$dc]['equp_type'] = $this->basemodel->get_single_column_value($this->equptypes->tbl_name, $this->equptypes->TYPE, array($this->equptypes->CODE => $list[$dc][$this->devices->E_TYPE]));
                    $list[$dc]['eq_util'] = $this->basemodel->get_single_column_value($this->utillvalues->tbl_name, $this->utillvalues->NAME, array($this->utillvalues->VALUE => $list[$dc][$this->devices->UTILIZATION]));
                    $expolded_eid = explode("-",$list[$dc][$this->devices->E_ID]);
                    $classification_id = $expolded_eid[4];
                    $list[$dc]['classification'] = $this->basemodel->get_single_column_value($this->classifications->tbl_name, $this->classifications->MASTER_CLASS, array($this->classifications->CODE => $classification_id));
                    $pms_where[$this->pmsdetails->EID] = $list[$dc][$this->devices->E_ID];
                    /*$pms_where[$this->pmsdetails->ORG_ID] = $where[$this->devices->ORG_ID];

                    $or_pms_whr = '';
                    if($branch_id != 'All')
                        $pms_where[$this->pmsdetails->BRANCH_ID] = $where[$this->devices->BRANCH_ID];
                    else
                        $or_pms_whr = $this->pmsdetails->BRANCH_ID. " IN ".BRANCHALL;*/


                    $list[$dc]['pms'] = $this->basemodel->fetch_records_from_multi_where($this->pmsdetails->tbl_name, $pms_where,$or_pms_whr,'*',$this->pmsdetails->PMS_DUE_DATE,'desc');

                    //return $where[$this->devices->BRANCH_ID];
                    //return $list[$dc]['pms'];
                    /* device qc details */
                    $qc_where[$this->qcdetails->EID] = $list[$dc][$this->devices->E_ID];
                   /* $qc_where[$this->qcdetails->ORG_ID] = $where[$this->devices->ORG_ID];

                    $or_qc_where = '';
                    if($branch_id != 'All')
                        $qc_where[$this->qcdetails->BRANCH_ID] = $where[$this->devices->BRANCH_ID];
                    else
                        $or_qc_where = $this->qcdetails->BRANCH_ID." IN ".BRANCHALL;*/

                    $list[$dc]['qc'] = $this->basemodel->fetch_records_from_multi_where($this->qcdetails->tbl_name, $qc_where,$or_qc_where,'*',$this->qcdetails->QC_DUE,'desc');
                    /* device department name */
                    $list[$dc]['DEPT_NAME'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$dc][$this->devices->DEPT_ID]));

                    /* cms details */
                    $cms_w[$this->cms->EID] = $list[$dc][$this->devices->E_ID];
                   /* $cms_w[$this->cms->ORG_ID] = $where[$this->devices->ORG_ID];

                    $or_cms_w = '';
                    if($branch_id != 'All')
                        $cms_w[$this->cms->BRANCH_ID] = $where[$this->devices->BRANCH_ID];
                    else
                        $or_cms_w = $this->cms->BRANCH_ID." IN ".BRANCHALL;*/

                    $cms_w[$this->cms->STATUS] = DW;
                    $list[$dc]['cms_data'] = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name,$cms_w,$or_cms_w);
                    for($ci=0;$ci<count($list[$dc]['cms_data']);$ci++)
                    {
                        $list[$dc]['cms_data'][$ci]['ATTENDED_BY_NAME'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$dc]['cms_data'][$ci][$this->cms->ATTENDED_BY]));
                    }
                    /* amc details */
                    $deviceamcs[$this->deviceamcs->EID] = $list[$dc][$this->devices->E_ID];
                   /* $deviceamcs[$this->deviceamcs->ORG_ID] = $where[$this->devices->ORG_ID];
                    $or_deviceamcs = '';
                    if($branch_id != 'All')
                        $deviceamcs[$this->deviceamcs->BRANCH_ID] = $where[$this->devices->BRANCH_ID];
                    else
                        $or_deviceamcs = $this->deviceamcs->BRANCH_ID." IN ".BRANCHALL ;*/

                    $list[$dc]['amcs'] = $this->basemodel->fetch_records_from_multi_where($this->deviceamcs->tbl_name,$deviceamcs,$or_deviceamcs,'*',$this->deviceamcs->AMC_TO,'DESC');
                    for($j=0;$j<count($list[$dc]['amcs']);$j++)
                    {
						$oselect = array($this->organizations->ORG_ID, $this->organizations->ORG_NAME,$this->organizations->CP_NAME,$this->organizations->CP_NUMBER,$this->organizations->CP_EMAIL,$this->organizations->CP_DETAILS);
                        $list[$dc]['amcs'][$j]['cvendor'] = $this->basemodel->fetch_single_row($this->organizations->tbl_name,array($this->organizations->ORG_ID=>$list[$dc]['amcs'][$j][$this->deviceamcs->AMC_VENDOR]),$oselect);
                        $where1 =  $list[$dc]['amcs'][$j]['cvendor']['ORG_ID'];
                        //return $where1;
                        $cp_details = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->CP_DETAILS,array($this->organizations->ORG_ID=>$where1)
                        );

                        if($cp_details!='-')
                        {

                            $cp_details1 = json_decode($cp_details,TRUE);

                            foreach($cp_details1['contact_persons'] as $cps)
                            {
                                $list[$dc]['amcs'][$j]['cvendor']['contact_person'][$this->organizations->CP_NAME] = $cps['contact_person'];
                                $list[$dc]['amcs'][$j]['cvendor']['cp_email'][$this->organizations->CP_EMAIL] = $cps['cpemail'];
                                $list[$dc]['amcs'][$j]['cvendor']['contact_person_no'][$this->organizations->CP_NUMBER] = $cps['contact_person_no'];

                            }
                        }
                        else
                        {

                            $list[$dc]['amcs'][$j]['cvendor'][$this->organizations->CP_NAME] =  $list[$dc]['amcs'][$j]['cvendor'][$this->organizations->CP_EMAIL] =  $list[$dc]['amcs'][$j]['cvendor'][$this->organizations->CP_NUMBER] = NULL;
                        }



					}

                    /* breakdown details */
                    $dbrkdwns[$this->dbrkdwns->EID] = $list[$dc][$this->devices->E_ID];
                   /* $dbrkdwns[$this->dbrkdwns->ORG_ID] = $where[$this->devices->ORG_ID];
                    $or_dbrkdwns = '';
                    if($branch_id != 'All')
                        $dbrkdwns[$this->dbrkdwns->BRANCH_ID] = $where[$this->devices->BRANCH_ID];
                    else
                        $or_dbrkdwns = $this->dbrkdwns->BRANCH_ID." IN ".BRANCHALL;*/
                    $list[$dc]['brk_dwns'] = $this->basemodel->fetch_records_from_multi_where($this->dbrkdwns->tbl_name,$dbrkdwns,$or_dbrkdwns);

                    /* history details */
                    $equphistory[$this->equphistory->EID] = $list[$dc][$this->devices->E_ID];
                    $list[$dc]['eq_history'] = $this->basemodel->fetch_records_from($this->equphistory->tbl_name,$equphistory);
                }
                $data['devices'] = $list;
				$data['labels'] = $device_label;
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
	
	/*private function _get_devices_org($jodata=array())
	{
		return "ddg";
		$org_module = isset($jodata->org_module) ? $jodata->org_module : $this->session->org_module;
		
		$qry = "SELECT * FROM hsp_tbl_table_names WHERE ORG_MODULE='$org_module'";
		return $qry;
	}*/

    private function _get_m_contracts($jodata=array())
    {
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
        /*if($role_code!=HMADMIN)
        {
           // $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->deviceamcs->BRANCH_ID] = $branch_id;
        }*/
        $data = array();
        $where = array();
        /* if($role_code!=HMADMIN)
        {
            //$branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->deviceamcs->BRANCH_ID] = $branch_id;
        }*/
        $where[$this->deviceamcs->ORG_ID] = $org_id;
        $where[$this->deviceamcs->STATUS] = OPEN;
        $where_date = '';
        $or_where = '';
        if (!empty($jodata)) {

            if ($jodata->equp_id != "" AND $jodata->equp_id != null)
                $where[$this->deviceamcs->EID] = $jodata->equp_id;
            else
                $where[$this->deviceamcs->EID." !="] = NULL;
            if ($jodata->contract_type != "" AND $jodata->contract_type != null)
                $where[$this->deviceamcs->AMC_TYPE] = $jodata->contract_type;
            if (isset($jodata->vendor1) AND $jodata->vendor1 != "")
                $where[$this->deviceamcs->AMC_VENDOR] = $jodata->vendor1;

            $where[$this->deviceamcs->AMC_TYPE." !="] = 'Biomedical';
            if($branch_id != 'All')
            {
                $where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            }
            else
            {
                $or_where = $this->deviceamcs->BRANCH_ID. " IN " .BRANCHALL;
            }
            if ($jodata->expiry_in !="" && $jodata->expiry_in != null)
            {
                if($jodata->expiry_in==1)
                {
                    $where[$this->deviceamcs->AMC_TO." <="] = date('Y-m-d');
                }
                else
                {
                    $date = date("Y-m-d");
                    $toDate = strtotime(date("Y-m-d", strtotime($date)) . " + ".$jodata->expiry_in." days");
                    $where_date = $this->deviceamcs->AMC_TO . " BETWEEN '" . date('Y-m-d') . "' AND '" . date('Y-m-d',$toDate) . "'";
                }
            }
            else if($jodata->fromdate != "" && $jodata->todate != "") {
                $where_date = $this->deviceamcs->AMC_TO . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            }


            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_three_multi_where($this->deviceamcs->tbl_name, $where, $where_date, $or_where,'count('.$this->deviceamcs->ID.') AS CNT');
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
                //  $list = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->deviceamcs->tbl_name, $where, $where_date,'','','','', '*', $this->deviceamcs->AMC_TO, 'desc','10',$limit_val*10);
                $list = $this->basemodel->fetch_records_from_three_multi_where_pagination($this->deviceamcs->tbl_name,$where,$where_date,$or_where,'',$this->deviceamcs->AMC_TO,'desc','10',$limit_val*10);
            }
            else
            {
                //$list = $this->basemodel->awesome_fetch($this->deviceamcs->tbl_name,$where,$where_date,'','','','','*',$this->deviceamcs->AMC_TO,'DESC');
                $list = $this->basemodel->fetch_records_from_three_multi_where($this->deviceamcs->tbl_name,$where,$where_date,$or_where,$this->deviceamcs->AMC_TO,'DESC');
            }

            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                for($i=0;$i<count($list);$i++)
                {
                    $list[$i]['contracttypes'] = $this->basemodel->get_single_column_value($this->contracttypes->tbl_name, $this->contracttypes->CTYPE, array($this->contracttypes->CFORM=>$list[$i][$this->deviceamcs->AMC_TYPE]));

                    $list[$i]['eq_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID=>$list[$i][$this->deviceamcs->EID]));
                    $list[$i]['serial_no'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID=>$list[$i][$this->deviceamcs->EID]));

                    /*$list[$i]['VENDOR_NAME'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name,$this->devicevendors->NAME,array($this->devicevendors->ID=>$list[$i][$this->deviceamcs->AMC_VENDOR]));*/
                    $list[$i]['VENDOR_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID => $list[$i][$this->deviceamcs->AMC_VENDOR]));
                    $list[$i]['status'] = $this->basemodel->get_single_column_value($this->contractstatus->tbl_name,$this->contractstatus->NAME,array($this->contractstatus->CODE=>$list[$i][$this->deviceamcs->STATUS]));
                }
                $data['list'] = $list;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }







    private function _get_equp_summary($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $data = array();
            $where = array();
            if ($jodata->dept_id != "") {
                $where[$this->devices->ORG_ID] = $this->session->org_id;
                $where[$this->devices->BRANCH_ID] = $this->session->branch_id;
                if ($jodata->dept_id != 'ALL') {
                    $where[$this->devices->DEPT_ID] = $jodata->dept_id;
                }
                $select = array($this->devices->E_NAME, $this->devices->E_ID, $this->devices->DEPT_ID, $this->devices->E_TYPE);
                $data['devices'] = $this->basemodel->fetch_records_from($this->devices->tbl_name, $where, $select);
                if (!empty($data['devices'])) {
                    $data['response'] = SUCCESSDATA;
                    for ($dc = 0; $dc < count($data['devices']); $dc++) {
                        /* device department name */
                        $data['devices'][$dc]['DEPT_NAME'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $data['devices'][$dc][$this->devices->DEPT_ID]));
                    }
                } else {
                    $data['response'] = EMPTYDATA;
                }
            }
            return $data;
        }
    }

    private function _get_equp_unit_wise($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $count = 0;
            $tcount = 0;
            $data = array();
            $where = array();
            $data['company_wise'] = $this->_get_company_equp_unit_wise();
            $where[$this->devices->ORG_ID] = $this->session->org_id;
            if($this->session->branch_id!="" or $this->session->branch_id!=null)
                $where[$this->devices->BRANCH_ID] = $this->session->branch_id;
            $select = array($this->devices->E_NAME, 'count(' . $this->devices->E_NAME . ') as TOTAL');
            $data['e_wise'] = $this->basemodel->fetch_records_groupby($this->devices->tbl_name, $where, $select, $this->devices->E_NAME);
            //$data['ewise_qry'] = $this->db->last_query();
            if (!empty($data['e_wise'])) {
                foreach ($data['e_wise'] as $GrandTotal) {
                    $count += $GrandTotal['TOTAL'];
                }
                $data['GrandTotal'] = $count;
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
            return $data;
        }
    }

    private function _get_company_equp_unit_wise()
    {
        $where[$this->devices->ORG_ID] = $this->session->org_id;
        if($this->session->branch_id!="" or $this->session->branch_id!=null)
            $where[$this->devices->BRANCH_ID] = $this->session->branch_id;
        $select = array($this->devices->C_NAME);
        $cname = $this->basemodel->fetch_distinct_records($this->devices->tbl_name, $where, $select, $this->devices->C_NAME);
        //$actual['cwise_qry'] = $this->db->last_query();
        $ctype = $this->basemodel->fetch_records_from($this->contracttypes->tbl_name);
        $dselect = array($this->devices->AMC_VALUE, $this->devices->AMC_TYPE, $this->devices->C_NAME);
        $amc_gtotal = 0;
        $equp_gtotal = 0;
        if (!empty($cname)) {
            $actual['response'] = SUCCESSDATA;
            for ($i = 0; $i < count($cname); $i++) {
                $dtotal = 0;
                $stotal = 0;
                $at = 0;
                $k = 1;
                $where[$this->devices->C_NAME] = $cname[$i][$this->devices->C_NAME];
                $cdevices[$i] = $this->basemodel->fetch_records_from($this->devices->tbl_name, $where, $dselect, $this->devices->AMC_TYPE);
                for ($j = 0; $j < count($cdevices[$i]); $j++) {
                    $actual['device'][$i]['cname'] = $cdevices[$i][$j][$this->devices->C_NAME];

                    if ($j > 0) {
                        if ($cdevices[$i][$j][$this->devices->AMC_TYPE] != $cdevices[$i][$j - $k][$this->devices->AMC_TYPE]) {
                            $at = 0;
                        }
                    }
                    foreach ($ctype as $ct) {
                        if ($ct[$this->contracttypes->CTYPE] == $cdevices[$i][$j][$this->devices->AMC_TYPE]) {
                            $at = $at + 1;
                            $actual['device'][$i][$ct[$this->contracttypes->CFORM]]['dc'] = $at;
                            $actual['device'][$i][$ct[$this->contracttypes->CFORM]]['type'] = $cdevices[$i][$j][$this->devices->AMC_TYPE];
                            if ($j > 0) {
                                if ($cdevices[$i][$j][$this->devices->AMC_TYPE] == $cdevices[$i][$j - $k][$this->devices->AMC_TYPE]) {
                                    $actual['device'][$i][$ct[$this->contracttypes->CFORM]]['dv'] = (int)$cdevices[$i][$j][$this->devices->AMC_VALUE] + $actual['device'][$i][$ct[$this->contracttypes->CFORM]]['dv'];
                                } else {
                                    $actual['device'][$i][$ct[$this->contracttypes->CFORM]]['dv'] = (int)$cdevices[$i][$j][$this->devices->AMC_VALUE];
                                }
                            } else {
                                $actual['device'][$i][$ct[$this->contracttypes->CFORM]]['dv'] = (int)$cdevices[$i][$j][$this->devices->AMC_VALUE];
                            }
                            break;
                        }
                    }
                }
                foreach ($ctype as $cts) {
                    if (!array_key_exists($cts[$this->contracttypes->CFORM], $actual['device'][$i])) {
                        $actual['device'][$i][$cts[$this->contracttypes->CFORM]] = array("dc" => 0, "dv" => 0, "type" => $cts[$this->contracttypes->CTYPE]);
                    }
                    $sval = $actual['device'][$i][$cts[$this->contracttypes->CFORM]]['dv'];
                    $stotal = $stotal + $sval;

                    $dval = $actual['device'][$i][$cts[$this->contracttypes->CFORM]]['dc'];
                    $dtotal = $dtotal + $dval;

                    $actual['device'][$i]['dv_stotal'] = $stotal;
                    $actual['device'][$i]['dc_stotal'] = $dtotal;
                    $equp_gtotal = $equp_gtotal + $dtotal;
                    $amc_gtotal = $amc_gtotal + $stotal;
                }
                ksort($actual['device'][$i]);
            }
            $actual['amc_gtotal'] = $amc_gtotal;
            $actual['equp_gtotal'] = $equp_gtotal;
        } else {
            $actual['response'] = FAILEDATA;
        }
        return $actual;
    }

    private function _get_devices($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $where['EQ_CONDATION'] = DW;
            $where['E_ID != '] = NULL;
            $where['BRANCH_ID'] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where['ORG_ID'] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $data['devices_ids'] = $this->basemodel->fetch_records_from($this->devices->tbl_name, $where, $this->devices->E_ID, $this->devices->E_ID);
            unset($where['EQ_CONDATION']);
            unset($where['E_ID != ']);

            $data['dequipment_names'] = $this->basemodel->fetch_distinct_records($this->devices->tbl_name, $where, $this->devices->E_NAME, $this->devices->E_NAME);

            $data['equip_types'] = $this->basemodel->fetch_records_from($this->equptypes->tbl_name);

            $data['dcompany_names'] = $this->basemodel->fetch_distinct_records($this->devices->tbl_name, $where, $this->devices->C_NAME, $this->devices->C_NAME);

            $data['equp_conditions'] = $this->basemodel->fetch_records_from($this->equpconditions->tbl_name);

            $data['ddeparts'] = $this->basemodel->fetch_distinct_records($this->devices->tbl_name, $where, $this->devices->DEPT_ID, $this->devices->DEPT_ID);

            for ($dc = 0; $dc < count($data['ddeparts']); $dc++) {
                $data['ddeparts'][$dc]['DEPT_NAME'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $data['ddeparts'][$dc]['DEPT_ID']));
            }
            if (!empty($data['devices_ids'])) {
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
            return $data;
        }
    }

    private function _search_device_call_genetation($jodata = array())
    {
        $data = array();
        $like = '';
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $select = array($this->devices->E_ID, $this->devices->E_NAME, $this->devices->C_NAME, $this->devices->DEPT_ID, $this->devices->E_COND);
            $where = array();
            if (isset($jodata->org_id) && isset($jodata->branch_id)) /* for app request */ {
                $where[$this->devices->ORG_ID] = $jodata->org_id;
                $where[$this->devices->BRANCH_ID] = $jodata->branch_id;
            } else /* for website request */ {
                $where[$this->devices->ORG_ID] = $this->session->org_id;
                $where[$this->devices->BRANCH_ID] = $this->session->branch_id;
            }

            if ($jodata->device_id == ALL OR $jodata->device_id == "") {
                if ($jodata->equp_condition == "" && $jodata->device_name == "" && $jodata->device_type == "" && $jodata->device_company == "" && $jodata->cg_equp_depart == "") /* if second option all values are NULL */ {
                    $where[$this->devices->EQ_CONDATION] = DW;
                } else {
                    if ($jodata->device_name == ALL || $jodata->device_type == "")
                        $where[$this->devices->E_NAME . " !="] = '';
                    else
                        $where[$this->devices->E_NAME] = $jodata->device_name;
                    if ($jodata->device_type != ALL && $jodata->device_type != "")
                        $like = array($this->devices->E_ID => $jodata->device_type);
                    if ($jodata->device_company != ALL && $jodata->device_company != "")
                        $where[$this->devices->C_NAME] = $jodata->device_company;
                    if ($jodata->cg_equp_depart != ALL && $jodata->cg_equp_depart != "")
                        $where[$this->devices->DEPT_ID] = $jodata->cg_equp_depart;
                    if ($jodata->equp_condition != ALL && $jodata->equp_condition != "")
                        $where[$this->devices->E_COND] = $jodata->equp_condition;
                }
            } else {
                $where[$this->devices->E_ID] = $jodata->device_id;
            }
            $data['devices'] = $this->basemodel->fetch_records_with_like($this->devices->tbl_name, $where, $like, $select, $this->devices->E_NAME);
            //$data['qry'] = $this->db->last_query();
            if (!empty($data['devices'])) {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($data['devices']); $i++) {
                    $data['devices'][$i]['DEPT_NAME'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $data['devices'][$i][$this->devices->DEPT_ID]));
                    $data['devices'][$i]['PRSNT_COND'] = $this->basemodel->get_single_column_value($this->equpconditions->tbl_name, $this->equpconditions->ECODE, array($this->equpconditions->EVAL => $data['devices'][$i][$this->devices->E_COND]));

                }
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _get_reasons()
    {
        $data = array();
        if ($this->ha_content_type == $this->baseauth->appjson) {
            $data['reasons'] = $this->basemodel->fetch_records_from($this->reasons->tbl_name);
            if (!empty($data['reasons'])) {
                $data['response'] = SUCCESSDATA;
                //asort($data['reasons']);
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _pending_pms_assign($jodata = array())
    {
        // print_r($jodata);
        //die();
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            for($i=0;$i<count($jodata->values);$i++)
            {
                $where[$this->pmsdetails->ID] = $jodata->values[$i];
                $where[$this->pmsdetails->COMPLETED_BY] = NULL;
                $pms_dtls = $this->basemodel->fetch_single_row($this->pmsdetails->tbl_name,$where);
                $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
                $assignto = $jodata->assignto;
                $inputdata[$this->pmsdetails->PMS_ASSIGNED_BY] = $user_id;
                $inputdata[$this->pmsdetails->PMS_ASSIGNED_TO] = $assignto;
                $inputdata[$this->pmsdetails->ASSIGNED_ON] = date('Y-m-d H:i:s');
                if (isset($jodata->pmscompleteremarks))
                    $inputdata[$this->pmsdetails->ASSIGN_REMARKS] = $jodata->pmscompleteremarks;
                if ($this->basemodel->update_operation($inputdata, $this->pmsdetails->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name, array($this->devices->E_ID => $jodata->EID));
                    if (is_numeric($user_id))
                        $emp_id = $user_id;
                    else
                        $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));
                    $assign_emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $assignto));
                    if ($device_details[$this->devices->PHY_LOCATION] != NULL)
                        $notification = "Call From " . $device_details[$this->devices->PHY_LOCATION] . " Assigned By " . $emp_id . " To " . $assign_emp_id . " From " . $device_details[$this->devices->DEPT_ID] . " Department For Equipment " . $device_details[$this->devices->E_NAME] . ",Id: " . $device_details[$this->devices->E_ID] . " Due to PMS";
                    else
                        $notification = "Call Assigned By " . $emp_id . " To " . $assign_emp_id . " From " . $device_details[$this->devices->DEPT_ID] . " Department For Equipment " . $device_details[$this->devices->E_NAME] . ",Id: " . $device_details[$this->devices->E_ID] . " Due to PMS";
                    $data['notification'] = $this->baselibrary->send_notification($pms_dtls[$this->pmsdetails->ORG_ID], $pms_dtls[$this->pmsdetails->BRANCH_ID], $notification);
                    $data['call_back'] = "Assign Successfully";
                } else {
                    $data['response'] = EMPTYDATA;
                    $data['call_back'] = "Unable to Assign Try Again";
                }
            }
        }
        return $data;
    }

    private function _pending_qc_assign($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            for($i=0;$i<count($jodata->values);$i++)
            {
                $where[$this->qcdetails->ID] = $jodata->values[$i];
                $where[$this->qcdetails->COMPLETED_BY] = NULL;
                $qcd = $this->basemodel->fetch_single_row($this->qcdetails->tbl_name,$where);
                $org_id = $qcd[$this->pmsdetails->ORG_ID];
                $branch_id = $qcd[$this->pmsdetails->BRANCH_ID];
                $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
                $assignto = $jodata->assignto;
                $inputdata[$this->qcdetails->ASSIGNED_BY] = $user_id;
                $inputdata[$this->qcdetails->ASSIGNED_TO] = $assignto;
                $inputdata[$this->qcdetails->ASSIGNED_ON] = date('Y-m-d H:i:s');
                if(isset($jodata->qcassignremarks))
                    $inputdata[$this->qcdetails->ASSIGN_REMARKS] = $jodata->qcassignremarks;
                if ($this->basemodel->update_operation($inputdata, $this->qcdetails->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Calibration Assigned Successfully";
                    $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$jodata->EID));
                    if(is_numeric($user_id))
                        $emp_id = $user_id;
                    else
                        $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));
                    $assign_emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $assignto));
                    if($device_details[$this->devices->PHY_LOCATION]!=NULL)
                        $notification = "Call From ".$device_details[$this->devices->PHY_LOCATION]." Assigned By ".$emp_id." To ".$assign_emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to Calibration";
                    else
                        $notification = "Call Assigned By ".$emp_id." To ".$assign_emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to Calibration";
                    $data['notification']=$this->baselibrary->send_notification($org_id,$branch_id,$notification);
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable to Complete Calibration Try Again";
                }
            }
        }
        return $data;
    }

    private function _pending_pms_self($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->pmsdetails->EID] = $jodata->EID;
            $where[$this->pmsdetails->BRANCH_ID] = $branch_id;
            $where[$this->pmsdetails->ORG_ID] = $org_id;
            $where[$this->pmsdetails->COMPLETED_BY] = NULL;
            $self_pmsdata = $this->basemodel->fetch_single_row($this->pmsdetails->tbl_name, $where);
            if(empty($self_pmsdata))
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "This PMS Already Completed";
                return $data;
            }
            $inputdata[$this->pmsdetails->COMPLETED_BY] = $user_id;
            $inputdata[$this->pmsdetails->SW] = $jodata->sw;
            $inputdata[$this->pmsdetails->ACC] = $jodata->acc;
            $inputdata[$this->pmsdetails->SPARES] = $jodata->spares;
            $inputdata[$this->pmsdetails->CLEAN] = $jodata->clean;
            $inputdata[$this->pmsdetails->TD] = date('Y-m-d');
            $inputdata[$this->pmsdetails->PMS_ACTL_DONE] = date('Y-m-d');
            if(isset($jodata->pmsassignremarks))
                $inputdata[$this->pmsdetails->COMPLETED_REMARKS] = $jodata->pmsassignremarks;
            if ($this->basemodel->update_operation($inputdata, $this->pmsdetails->tbl_name, $where))
            {
                $pmsval = 30*(12 / $self_pmsdata[$this->pmsdetails->PMS_COUNT]);
                $pmsdue = date('Y-m-d', strtotime($self_pmsdata[$this->pmsdetails->PMS_DUE_DATE]. " + $pmsval days"));
                $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                $insert_pms[$this->pmsdetails->PMS_DONE] = $self_pmsdata[$this->pmsdetails->PMS_DUE_DATE];
                $pms_max_val = $this->basemodel->select_max_val($this->pmsdetails->tbl_name,$this->pmsdetails->ID);
                $pms_max_val = $pms_max_val+1;
                $amc_type=$this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_TYPE,array($this->deviceamcs->EID=>$self_pmsdata[$this->pmsdetails->EID]),$this->deviceamcs->AMC_TO,'DESC');
                if($amc_type=="-")
                {
                    $amcval = "N";
                }
                else
                {
                    $amcval = $amc_type;
                }
                $insert_pms[$this->pmsdetails->JOB_ID] = $this->baselibrary->get_brch_code_f_eid($self_pmsdata[$this->pmsdetails->EID])."-".$amcval."P-".date('my')."-".$this->baselibrary->getpmsqc_id($pms_max_val);
                $insert_pms[$this->pmsdetails->ORG_ID] = $this->session->org_id;
                $insert_pms[$this->pmsdetails->EID] = $self_pmsdata[$this->pmsdetails->EID];
                $insert_pms[$this->pmsdetails->BRANCH_ID] = $branch_id;
                $insert_pms[$this->pmsdetails->PMS_COUNT] = $self_pmsdata[$this->pmsdetails->PMS_COUNT];
                if ($this->basemodel->insert_into_table($this->pmsdetails->tbl_name, $insert_pms))
                    $data['new_pms'] = 'created';
                else
                    $data['new_pms'] = 'not created';
                $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$jodata->EID));
                if(is_numeric($user_id))
                    $emp_id = $user_id;
                else
                    $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));
                if($device_details[$this->devices->PHY_LOCATION]!=NULL)
                    $notification = "Call From ".$device_details[$this->devices->PHY_LOCATION]." Completed By ".$emp_id."  From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to PMS";
                else
                    $notification = "Call Completed By ".$emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to PMS";
                $data['notification']=$this->baselibrary->send_notification($org_id,$branch_id,$notification);
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "PMS Completed Successfully";
                $comment = $jodata->EID . " PMS Details Updated By " . $user_id;
                $insertlog['USERNAME'] = $user_id;
                $insertlog['DESCRIPTION'] = $comment;
                $insertlog['ENTRY'] = date('Y-m-d H:i:s');
                $insertlog['DATE'] = date('Y-m-d');
                $insertlog['TIME'] = date('H:i:s');
                $this->basemodel->insert_into_table($this->calllogs->tbl_name, $insertlog);
                $dwhere[$this->devices->E_ID] = $jodata->EID;
                $dwhere[$this->devices->BRANCH_ID] = $branch_id;
                $dwhere[$this->devices->ORG_ID] = $org_id;
                $list = $this->basemodel->fetch_single_row($this->devices->tbl_name, $dwhere);
                $status = $list[$this->devices->EQ_CONDATION];
                $data['equipment_insert'] = $this->baselibrary->insert_device_history($jodata->EID,$comment,$status,date('Y-m-d H:i:s'),$org_id,$branch_id,$device_details[$this->devices->DEPT_ID]);
            }
            else
            {
                $data['response'] = FAILEDATA;
                //$data['qry'] = $this->db->last_query();
                $data['call_back'] = "Unable to Process PMS Request Try Again..!";
            }

        }
        return $data;
    }
    public function pending_pms_self()
    {
        $jdata=json_decode($_POST['data'],true);
        $jodata = $jdata['values'];
        /* log_message('error',print_r($_POST,true));
        log_message('error',print_r($_FILES,true)); */
        $data = array();
        for($i=0;$i<count($jodata);$i++)
        {
            $where[$this->pmsdetails->ID] = $jodata[$i];
            $where[$this->pmsdetails->PMS_ACTL_DONE] = NULL;
            $pcd = $this->basemodel->fetch_single_row($this->pmsdetails->tbl_name,$where);
            if(!empty($pcd))
            {
                $branch_id = $pcd[$this->pmsdetails->BRANCH_ID];
                $org_id = $pcd[$this->pmsdetails->ORG_ID];
                $user_id = isset($jdata['userid']) ? $jdata['userid'] : $this->session->user_id;
                $where[$this->pmsdetails->COMPLETED_BY] = NULL;
                $inputdata[$this->pmsdetails->COMPLETED_BY] = $user_id;
                // $inputdata[$this->pmsdetails->SW] = $jodata->sw;
                //$inputdata[$this->pmsdetails->ACC] = $jodata->acc;
                //$inputdata[$this->pmsdetails->SPARES] = $jodata->spares;
                //$inputdata[$this->pmsdetails->CLEAN] = $jodata->clean;
                $inputdata[$this->pmsdetails->TD] = date('Y-m-d');
                $inputdata[$this->pmsdetails->PMS_ACTL_DONE] = date('Y-m-d');
                if (isset($jdata['remarks']))
                    $inputdata[$this->pmsdetails->COMPLETED_REMARKS] = $jdata['remarks'];
                if ($this->basemodel->update_operation($inputdata, $this->pmsdetails->tbl_name, $where)) {
                    $pms_insert = true;
                    $pmsval = 30 * (12 / $pcd[$this->pmsdetails->PMS_COUNT]);
                    $pmsdue = date('Y-m-d', strtotime($pcd[$this->pmsdetails->PMS_DUE_DATE] . " + $pmsval days"));
                    $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                    $insert_pms[$this->pmsdetails->PMS_DONE] = $pcd[$this->pmsdetails->PMS_DUE_DATE];
                    $pms_max_val = $this->basemodel->select_max_val($this->pmsdetails->tbl_name, $this->pmsdetails->ID);
                    $pms_max_val = $pms_max_val + 1;
                    $amc_type = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_TYPE, array($this->deviceamcs->EID => $pcd[$this->pmsdetails->EID]), $this->deviceamcs->AMC_TO, 'DESC');
                    if ($amc_type == "-")
                    {
                        $amcval = "N";
                    } else {
                        $amcval = $amc_type;
                    }
                    $insert_pms[$this->pmsdetails->JOB_ID] = $this->baselibrary->get_brch_code_f_eid($pcd[$this->pmsdetails->EID]) . "-" . $amcval . "P-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($pms_max_val);
                    $insert_pms[$this->pmsdetails->ORG_ID] = $org_id;
                    $insert_pms[$this->pmsdetails->EID] = $pcd[$this->pmsdetails->EID];
                    $insert_pms[$this->pmsdetails->BRANCH_ID] = $branch_id;
                    $insert_pms[$this->pmsdetails->PMS_COUNT] = $pcd[$this->pmsdetails->PMS_COUNT];
                    $this->basemodel->insert_into_table($this->pmsdetails->tbl_name, $insert_pms);
                    $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name, array($this->devices->E_ID => $pcd[$this->pmsdetails->EID]));
                    $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));
                    if ($device_details[$this->devices->PHY_LOCATION] != NULL)
                        $notification = "Call From " . $device_details[$this->devices->PHY_LOCATION] . " Completed By " . $emp_id . "  From " . $device_details[$this->devices->DEPT_ID] . " Department For Equipment " . $device_details[$this->devices->E_NAME] . ",Id: " . $device_details[$this->devices->E_ID] . " Due to PMS";
                    else
                        $notification = "Call Completed By " . $emp_id . " From " . $device_details[$this->devices->DEPT_ID] . " Department For Equipment " . $device_details[$this->devices->E_NAME] . ",Id: " . $device_details[$this->devices->E_ID] . " Due to PMS";
                    //$data['notification'] = $this->baselibrary->send_notification($org_id, $branch_id, $notification);
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "PMS Completed Successfully";
                    //asort($data['reasons']);
                    if (count($_FILES) > 0) {
                        $uploaded = $not_uploaded = 0;
                        $uploaded_pms_floder = $device_details[$this->devices->ES_NUMBER];
                        for ($f = 0; $f < count($_FILES); $f++) {
                            $f_type = explode('.', $_FILES[$f]['name']);
                            $last_in = end($f_type);
                            $config['upload_path'] = PMS_UPLOAD_PATH . $uploaded_pms_floder;
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
                                //$data['uploaded_files_errors'][] = $this->upload->display_errors();

                            }
                            //$data['uploaded_files'] = $uploaded;
                            //$data['not_uploaded_files'] = $not_uploaded;
                        }
                    }
                    $comment = $jodata->EID . " PMS Details Updated By " . $emp_id;
                    $insertlog['USERNAME'] = $user_id;
                    $insertlog['DESCRIPTION'] = $comment;
                    $insertlog['ENTRY'] = date('Y-m-d H:i:s');
                    $insertlog['DATE'] = date('Y-m-d');
                    $insertlog['TIME'] = date('H:i:s');
                    $this->basemodel->insert_into_table($this->calllogs->tbl_name, $insertlog);
                    $dwhere[$this->devices->E_ID] = $pcd[$this->pmsdetails->EID];
                    $dwhere[$this->devices->BRANCH_ID] = $branch_id;
                    $dwhere[$this->devices->ORG_ID] = $org_id;
                    $list = $this->basemodel->fetch_single_row($this->devices->tbl_name, $dwhere);
                    $status = $list[$this->devices->EQ_CONDATION];
                    //$data['equipment_insert'][$i] = $this->baselibrary->insert_device_history($pcd[$this->pmsdetails->EID], $comment, $status, date('Y-m-d H:i:s'),$org_id,$branch_id,$list[$this->devices->DEPT_ID]);
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    //$data['qry'] = $this->db->last_query();
                    $data['call_back'] = "Unable to Process PMS Request Try Again..!";
                }
            }
        }
        print_r(json_encode($data));
        return true;
    }


    public function pending_qc_self()
    {
        $jdata=json_decode($_POST['data'],true);
        $jodata = $jdata['values'];
        /* log_message('error',print_r($_POST,true));
        log_message('error',print_r($_FILES,true)); */
        $data = array();
        for($i=0;$i<count($jodata);$i++)
        {
            $where[$this->qcdetails->ID] = $jodata[$i];
            $where[$this->qcdetails->QC_ACTL_DONE] = NULL;
            $qcd = $this->basemodel->fetch_single_row($this->qcdetails->tbl_name,$where);
            if(!empty($qcd))
            {
                $branch_id = $qcd[$this->qcdetails->BRANCH_ID];
                $org_id = $qcd[$this->qcdetails->ORG_ID];
                $user_id = isset($jdata['userid']) ? $jdata['userid'] : $this->session->user_id;
                $inputdata[$this->qcdetails->COMPLETED_BY] = $user_id;
                //$inputdata[$this->qcdetails->COST] = $jodata->cost;
                $inputdata[$this->qcdetails->TD] = date('Y-m-d H:i:s');
                $inputdata[$this->qcdetails->QC_ACTL_DONE] = date('Y-m-d');
                if(isset($jdata['remarks']))
                    $inputdata[$this->pmsdetails->COMPLETED_REMARKS] = isset($jdata['remarks']) ? isset($jdata['remarks']) : "Completed";
                if($this->basemodel->update_operation($inputdata, $this->qcdetails->tbl_name, $where))
                {
                    $qc_max_val = $this->basemodel->select_max_val($this->qcdetails->tbl_name,$this->qcdetails->ID);
                    $qc_max_val = $qc_max_val+1;
                    $insert_qc[$this->qcdetails->JOB_ID] = $this->baselibrary->get_brch_code_f_eid($jodata->EID)."-JQ-".date('my')."-".$this->baselibrary->getpmsqc_id($qc_max_val);
                    $insert_qc[$this->qcdetails->QC_COUNT] = $no_of_qcs = $qcd[$this->qcdetails->QC_COUNT];
                    $insert_qc[$this->qcdetails->BRANCH_ID] =  $branch_id;
                    $insert_qc[$this->qcdetails->ORG_ID] =  $org_id;
                    $insert_qc[$this->qcdetails->EID] =  $qcd[$this->qcdetails->EID];
                    $insert_qc[$this->qcdetails->QC_DONE] =  $qcd[$this->qcdetails->QC_DUE];
                    $insert_qc[$this->qcdetails->QC_COUNT_TYPE] =  $qcd[$this->qcdetails->QC_COUNT_TYPE];
                    if($insert_qc[$this->qcdetails->QC_COUNT_TYPE]=='Month')
                        $qcval = 30*(12 / $no_of_qcs);
                    else if($insert_qc[$this->qcdetails->QC_COUNT_TYPE]=='Year')
                        $qcval = ceil(365*(1 / $no_of_qcs));
                    $insert_qc[$this->qcdetails->QC_DUE] = date('Y-m-d', strtotime($insert_qc[$this->qcdetails->QC_DONE]. " + $qcval days"));
                    $this->basemodel->insert_into_table($this->qcdetails->tbl_name, $insert_qc);

                    $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$qcd[$this->qcdetails->EID]));
                    $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));
                    if($device_details[$this->devices->PHY_LOCATION]!=NULL)
                        $notification = "Call From ".$device_details[$this->devices->PHY_LOCATION]." Completed By ".$emp_id."  From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to Calibration";
                    else
                        $notification = "Call Completed By ".$emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to Calibration";
                    //$data['notification'][$i]=$this->baselibrary->send_notification($org_id,$branch_id,$notification);
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Calibration Completed Successfully";
                    //asort($data['reasons']);
                    if(count($_FILES)>0)
                    {
                        $uploaded=$not_uploaded=0;
                        $uploaded_qc_floder=$device_details[$this->devices->ES_NUMBER];
                        for($f=0;$f<count($_FILES);$f++)
                        {
                            $f_type=explode('.',$_FILES[$f]['name']);
                            $last_in=(count($f_type)-1);
                            $config['upload_path']=QC_UPLOAD_PATH.$uploaded_qc_floder;
                            $config['allowed_types'] = '*';
                            $time=time();
                            $config['file_name']=$f_type[0].'-'.$time;
                            if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                            $this->load->library('upload',$config);
                            $this->upload->initialize($config);
                            if($this->upload->do_upload($f))
                            {
                                $uploaded++;
                            }
                            else
                            {
                                $not_uploaded++;
                                //$data['uploaded_files_errors'][$i][$f] =$this->upload->display_errors();

                            }
                            //$data['uploaded_files']=$uploaded;
                            //$data['not_uploaded_files']=$not_uploaded;
                        }
                    }

                    $comment = $qcd[$this->qcdetails->EID]. " Calibration Details Updated By " . $emp_id;
                    $insertlog['USERNAME'] = $user_id;
                    $insertlog['DESCRIPTION'] = $comment;
                    $insertlog['ENTRY'] = date('Y-m-d H:i:s');
                    $insertlog['DATE'] = date('Y-m-d');
                    $insertlog['TIME'] = date('H:i:s');
                    $this->basemodel->insert_into_table($this->calllogs->tbl_name, $insertlog);
                    $dwhere[$this->devices->E_ID] = $qcd[$this->qcdetails->EID];
                    $dwhere[$this->devices->BRANCH_ID] = $branch_id;
                    $dwhere[$this->devices->ORG_ID] = $org_id;
                    $list = $this->basemodel->fetch_single_row($this->devices->tbl_name, $dwhere);
                    $status = $list[$this->devices->EQ_CONDATION];
                    $this->baselibrary->insert_device_history($qcd[$this->qcdetails->EID],$comment,$status,date('Y-m-d H:i:s'),$org_id,$branch_id,$list[$this->devices->DEPT_ID]);
                } else {
                    $data['response'] = FAILEDATA;
                    //$data['qry'] = $this->db->last_query();
                    $data['call_back'] = "Unable to Complete Calibration Try Again";
                }
            }
        }
        print_r(json_encode($data));
        return true;
    }


    public function submit_round()
    {

        $jdata=json_decode($_POST['data'],true);
        $jodata = $jdata['values'];
        $data = array();

        // for($i=0;$i<count($jodata);$i++)
        //{
        /* $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
         $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
         $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
         $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;*/

        $insert_rounds[$this->rounds->END_TIME] = date('H:i:s');
        $insert_rounds[$this->rounds->REMARKS] = $jodata['remarks'];
        $where_rounds[$this->rounds->ID] = $jodata['rid'];



        if($this->basemodel->update_operation($insert_rounds,$this->rounds->tbl_name,$where_rounds))
        {
            $insert_assigned_round[$this->rounds_assigned->COMPLETED_ON] = date('Y-m-d');
            $where_assigned_round[$this->rounds_assigned->ID] = $jodata['ID'];
            $this->basemodel->update_operation($insert_assigned_round,$this->rounds_assigned->tbl_name,$where_assigned_round);

            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Round Submitted Successfully";

            $data['files'] = count($_FILES);
            if (count($_FILES) > 0) {
                $uploaded = $not_uploaded = 0;
                $uploaded_round_floder = $where_assigned_round[$this->rounds_assigned->ID];

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
                $this->basemodel->update_operation(array($this->rounds_assigned->IMAGE => $uploaded_round_floder), $this->rounds_assigned->tbl_name, array($this->rounds_assigned->ID => $where_assigned_round[$this->rounds_assigned->ID]));

            }

        }
        else
        {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable to submit round try again";
        }
        //  }

        print_r(json_encode($data));
        return true;
    }





    private function _pending_qc_self($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->qcdetails->EID] = $jodata->EID;
            $where[$this->qcdetails->BRANCH_ID] = $branch_id;
            $where[$this->qcdetails->ORG_ID] = $org_id;
            $where[$this->qcdetails->COMPLETED_BY] = NULL;
            $self_qcdata = $this->basemodel->fetch_single_row($this->qcdetails->tbl_name, $where);
            if(empty($self_qcdata))
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "This Calibration Already Completed";
                return $data;
            }
            $inputdata[$this->qcdetails->COMPLETED_BY] = $user_id;
            $inputdata[$this->qcdetails->COST] = $jodata->cost;
            $inputdata[$this->qcdetails->TD] = date('Y-m-d H:i:s');
            $inputdata[$this->qcdetails->QC_ACTL_DONE] = date('Y-m-d');
            if(isset($jodata->qccompleteremarks))
                $inputdata[$this->pmsdetails->COMPLETED_REMARKS] = $jodata->qccompleteremarks;
            if ($this->basemodel->update_operation($inputdata, $this->qcdetails->tbl_name, $where))
            {
                $qc_max_val = $this->basemodel->select_max_val($this->qcdetails->tbl_name,$this->qcdetails->ID);
                $qc_max_val = $qc_max_val+1;
                $insert_qc[$this->qcdetails->JOB_ID] = $this->baselibrary->get_brch_code_f_eid($jodata->EID)."-JQ-".date('my')."-".$this->baselibrary->getpmsqc_id($qc_max_val);
                $insert_qc[$this->qcdetails->QC_COUNT] = $no_of_qcs = $self_qcdata[$this->qcdetails->QC_COUNT];
                $insert_qc[$this->qcdetails->BRANCH_ID] =  $branch_id;
                $insert_qc[$this->qcdetails->ORG_ID] =  $org_id;
                $insert_qc[$this->qcdetails->EID] =  $jodata->EID;
                $insert_qc[$this->qcdetails->QC_DONE] =  $self_qcdata[$this->qcdetails->QC_DUE];
                $insert_qc[$this->qcdetails->QC_COUNT_TYPE] =  $self_qcdata[$this->qcdetails->QC_COUNT_TYPE];
                if($insert_qc[$this->qcdetails->QC_COUNT_TYPE]=='Month')
                    $qcval = 30*(12 / $no_of_qcs);
                else if($insert_qc[$this->qcdetails->QC_COUNT_TYPE]=='Year')
                    $qcval = ceil(365*(1 / $no_of_qcs));
                $insert_qc[$this->qcdetails->QC_DUE] = date('Y-m-d', strtotime($insert_qc[$this->qcdetails->QC_DONE]. " + $qcval days"));
                if ($this->basemodel->insert_into_table($this->qcdetails->tbl_name, $insert_qc))
                    $data['new_qc'] = 'created';
                else
                    $data['new_qc'] = 'not created';

                $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$jodata->EID));
                if(is_numeric($user_id))
                    $emp_id = $user_id;
                else
                    $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));
                if($device_details[$this->devices->PHY_LOCATION]!=NULL)
                    $notification = "Call From ".$device_details[$this->devices->PHY_LOCATION]." Completed By ".$emp_id."  From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to Calibration";
                else
                    $notification = "Call Completed By ".$emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to QC";
                $data['notification']=$this->baselibrary->send_notification($org_id,$branch_id,$notification);
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Completed Calibration Successfully";
                //asort($data['reasons'])
                $comment = $jodata->EID . "Calibration Details Updated By " . $user_id;
                $insertlog['USERNAME'] = $user_id;
                $insertlog['DESCRIPTION'] = $comment;
                $insertlog['ENTRY'] = date('Y-m-d H:i:s');
                $insertlog['DATE'] = date('Y-m-d');
                $insertlog['TIME'] = date('H:i:s');
                $this->basemodel->insert_into_table($this->calllogs->tbl_name, $insertlog);
                $dwhere[$this->devices->E_ID] = $jodata->EID;
                $dwhere[$this->devices->BRANCH_ID] = $branch_id;
                $dwhere[$this->devices->ORG_ID] = $org_id;
                $list = $this->basemodel->fetch_single_row($this->devices->tbl_name, $dwhere);
                $status = $list[$this->devices->EQ_CONDATION];
                $this->baselibrary->insert_device_history($jodata->EID,$comment,$status,date('Y-m-d H:i:s'),$org_id,$branch_id,$device_details[$this->devices->DEPT_ID]);
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable to Complete Calibration Try Again";
            }

        }
        return $data;
    }

    private function _get_priorities()
    {
        $data = array();
        if ($this->ha_content_type == $this->baseauth->appjson) {
            $data['priorities'] = $this->basemodel->fetch_records_from($this->priorities->tbl_name);
            if (!empty($data['priorities'])) {
                $data['response'] = SUCCESSDATA;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    private function _call_generation_by_user($jodata = array())
    {
        $data = array();
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $where[$this->devices->ORG_ID] = $org_id;
        $where[$this->devices->BRANCH_ID] = $branch_id;
        $device_id = $jodata->device_id;

        if(isset($jodata->source) && $jodata->source=='A')
        {

            $caller_uid = $jodata->caller_id;
            $caller_data = $this->basemodel->fetch_single_row($this->users->tbl_name,array($this->users->EMP_NO=>$caller_uid),array($this->users->EMP_NO,$this->users->USER_NAME,$this->users->MOBILE_NO,$this->users->EMAIL_ID));

            if(!empty($caller_data))
            {
                $caller_id = $caller_data[$this->users->EMP_NO];
                $caller_name = $caller_data[$this->users->USER_NAME];
                $caller_mobile = $caller_data[$this->users->MOBILE_NO];
                $caller_email = $caller_data[$this->users->EMAIL_ID];
            }
        }
        else
        {
            $caller_id = isset($jodata->caller_id) ? $jodata->caller_id : $this->session->emp_no;
            $caller_name = isset($jodata->user_name) ? $jodata->user_name : $this->session->user_name;
            $caller_email = isset($jodata->email) ? $jodata->email : $this->session->email;
            $caller_mobile = isset($jodata->mobile_no) ? $jodata->mobile_no : $this->session->mobile_no;
        }
        $priority = $jodata->priority;
		$reason = $jodata->reasons;
        /* get device amc type and department */
        $amc_type = "";
        $dept = "";

        $where[$this->devices->E_ID] = $device_id;
        $device_data = $this->basemodel->fetch_single_row($this->devices->tbl_name, $where);
        //return $this->db->last_query();

        if(!empty($device_data)){
            $amc_where[$this->deviceamcs->EID] = $device_data[$this->devices->E_ID];
            $amc_where[$this->deviceamcs->ORG_ID] = $device_data[$this->devices->ORG_ID];
            $amc_where[$this->deviceamcs->BRANCH_ID] = $device_data[$this->devices->BRANCH_ID];
            $amc_data = $this->basemodel->fetch_single_row($this->deviceamcs->tbl_name,$amc_where,$this->deviceamcs->AMC_TYPE,$this->deviceamcs->ID,'desc');

            if(!empty($amc_data))
            {
                $amc_type = $amc_data[$this->deviceamcs->AMC_TYPE];
            }
            else
            {
                $amc_type = 'NA';
            }
            if($jodata->action!="call_generation_all")
                $dept = $device_data[$this->devices->DEPT_ID];
            else
                $dept = $jodata->dept_id;
        }


        else {
            $data['response'] = EMPTYDATA;
            $data['call_back'] = "No Device Found";
            return $data;
        }
        /* notication */
        if(isset($jodata->generationremarks))
        {
            $complaint = $jodata->generationremarks;
        }
        else
        {
            $complaint = NULL;
        }
        if($jodata->action!="call_generation_all")
            if($device_data[$this->devices->PHY_LOCATION]==NULL)
                $notifcation = $notifcation = "Call Generated By ".$caller_name." From ".$dept." For ". $device_data[$this->devices->E_NAME]." Due to ".$complaint;
            else
                $notifcation = "Call From ".$device_data[$this->devices->PHY_LOCATION]. "Generated By ".$caller_name." From ".$dept." For ". $device_data[$this->devices->E_NAME]." Due to ".$complaint;

        /* to create job id */
        $type_id = $amc_type[0]."BD";
        $tdate = date('my');
        $device_branch = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_CODE,array($this->branches->BRANCH_ID=>$device_data[$this->devices->BRANCH_ID]));
        $call_id = $this->basemodel->select_max_val($this->cms->tbl_name, $this->cms->ID);
        $mainc_id = $this->_generate_id($call_id);
        $job_id = $device_branch . "-" . $type_id . "-" . $tdate . "-" . $mainc_id;

        /* cms table insert */
        $cwhere[$this->cms->EID] = $device_id;
        $cwhere[$this->cms->STATUS . " !="] = DW;
        $cwhere[$this->cms->ORG_ID] = $where[$this->devices->ORG_ID];
        $cwhere[$this->cms->BRANCH_ID] = $where[$this->devices->BRANCH_ID];

        $cms_rec_count = $this->basemodel->num_of_res($this->cms->tbl_name, $cwhere);
        if ($cms_rec_count == 0)  /* insert cms */
        {
            $insert_cms[$this->cms->ORG_ID] = $where[$this->devices->ORG_ID];
            $insert_cms[$this->cms->BRANCH_ID] = $where[$this->devices->BRANCH_ID];
            $insert_cms[$this->cms->CALLER_ID] = $job_id;
            $insert_cms[$this->cms->CDATE] = date('Y-m-d');
            $insert_cms[$this->cms->CTIME] = date('H:i:s');
            $insert_cms[$this->cms->CALLER_DEPT] = $dept;
            $insert_cms[$this->cms->CALLER_NAME] = $caller_name;
            $insert_cms[$this->cms->CEMP_ID] = $caller_id;
            $insert_cms[$this->cms->NATURE_OF_COMP] = $complaint;
            $insert_cms[$this->cms->EID] = $device_id;
            $insert_cms[$this->cms->STATUS] = DNW;
            $insert_cms[$this->cms->TYPE] = $amc_type;
            $insert_cms[$this->cms->PRIORITY] = $priority;
			$insert_cms[$this->cms->REASON]  = $reason;

            if ($this->basemodel->insert_into_table($this->cms->tbl_name, $insert_cms))
            {

                $data['response'] = SUCCESSDATA;
                $data['call_back'] = 'Call Generated Successfully';
                $caller_uuid = $jodata->caller_id;
                $caller_data1 = $this->basemodel->fetch_single_row($this->users->tbl_name,array($this->users->EMP_NO=>$caller_uuid),array($this->users->USER_NAME,$this->users->MOBILE_NO,$this->users->EMAIL_ID));

                if(!empty($caller_data1))
                {

                    $data['response'] = SUCCESSDATA;
                    //  $data['call_back'] .= ' AND This User is already exists';


                }else {
                    $max_val = (int)$this->basemodel->select_max_val($this->users->tbl_name, $this->users->UID);
                    $user_id = $this->baselibrary->user_id_creation($max_val);
                    $insert_dms[$this->users->USER_ID] = HA . $user_id;
                    $insert_dms[$this->users->ORG_ID] = $where[$this->devices->ORG_ID];
                    $insert_dms[$this->users->ORG_BRANCH_ID] = $where[$this->devices->BRANCH_ID];
                    $insert_dms[$this->users->MOBILE_NO] = $caller_mobile;
                    $insert_dms[$this->users->EMAIL_ID] = $caller_email;
                    $insert_dms[$this->users->EMP_NO] = $caller_id;
                    $insert_dms[$this->users->USER_NAME] = $caller_name;
                    $insert_dms[$this->users->ROLE_CODE] = "user";
                    $insert_dms[$this->users->DEPT_CODE] = $dept;
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
                        //$data['call_back'] .= ' AND USER SAVED SUCCESSFULLY';
                    } else {
                        $data['response'] = FAILEDATA;
                        // $data['call_back'] .= ' AND Unable to Process Your Request Try Again...';
                    }
                }
                if ($this->basemodel->update_operation(array($this->devices->EQ_CONDATION => DNW), $this->devices->tbl_name, $where))
                    $data['update_devices_tbl'] = 'updated';
                else
                    $data['update_devices_tbl'] = 'not updated';

                /* device history table insert , for maintaining history */
                $data['history_table'] = $this->baselibrary->insert_device_history($device_id,$complaint,DNW,date('Y-m-d H:i:s'),$org_id,$branch_id,$dept);

                /*for maintaining Log Activities, inserting log table */
                $data['log_table'] = $this->baselibrary->insert_calllog($caller_id,$notifcation,date('Y-m-d'),date('H:i:s'),date('Y-m-d H:i:s'),$org_id,$branch_id);

                /*update Equipment Status table*/
                if ($this->basemodel->update_operation(array($this->equpstatus->STATUS => DNW), $this->equpstatus->tbl_name, array($this->equpstatus->EID => $device_id)))
                    $data['estatus_table'] = 'updated';
                else
                    $data['estatus_table'] = 'not updated';

                /* send notification */
                $data['notification'] = $this->baselibrary->send_notification($where[$this->devices->ORG_ID], $where[$this->devices->BRANCH_ID], $notifcation);
               // return $this->db->last_query();
                /* if($device_data[$this->devices->AMC_TYPE."!="] = NULL && $device_data[$this->devices->AMC_TYPE."!="] = 'BME' &&  $device_data[$this->devices->AMC_TYPE."!="] = 'No' && $device_data[$this->devices->AMC_TYPE."!="] = '' && $device_data[$this->devices->DISTRIBUTOR."!="] != '' && $device_data[$this->devices->DISTRIBUTOR."="] != NULL)
                 {
                     $distributer = $device_data[$this->devices->DISTRIBUTOR];
                     $data['vnotification']=$this->baselibrary->send_vendor_notification($notifcation,$distributer);
                 }*/


            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = 'Call Generation Failed';
            }
        }
        else
        {
            $device_cms = $this->basemodel->fetch_single_row($this->cms->tbl_name, $cwhere);
            if ($device_cms[$this->cms->RESPONDED_DATE] == NULL)
                $data['status'] = 'not_responded';
            else
            {
                $responded_by = $device_cms[$this->cms->RESPONDED_BY];
                $data['attend_by'] = $this->basemodel->fetch_single_row($this->users->tbl_name,array($this->users->USER_ID=>$responded_by),array($this->users->USER_NAME,$this->users->EMP_NO,$this->users->MOBILE_NO));
                $data['status'] = 'responded';
                if ($device_cms[$this->cms->ATTENDED_DATE] != NULL)
                {
                    $responded_by = $device_cms[$this->cms->ATTENDED_BY];
                    $data['attend_by'] = $this->basemodel->fetch_single_row($this->users->tbl_name,array($this->users->USER_ID=>$responded_by),array($this->users->USER_NAME,$this->users->EMP_NO,$this->users->MOBILE_NO));
                    $data['status'] = 'attended';
                }
                if ($device_cms[$this->cms->STATUS] == UMAINTENCE)
                {
                    $responded_by = $device_cms[$this->cms->ATTENDED_BY];
                    $data['attend_by'] = $this->basemodel->fetch_single_row($this->users->tbl_name,array($this->users->USER_ID=>$responded_by),array($this->users->USER_NAME,$this->users->EMP_NO,$this->users->MOBILE_NO));
                    $data['status'] = 'pending';
                }
            }
            $data['response'] = EXISTSDATA;
            $data['call_back'] = "Already Call Generated To this Device, it is at ".ucfirst(str_replace("_"," ",$data['status']))." Status";
        }
        return $data;
    }

    private function _get_assigned_calls($jodata = array())
    {

        $data = array();
        $myflag = false;
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            //  $where[$this->devices->ORG_ID] = $org_id;
            $calls_data = array();
            $assigned_data = array();

            $org_branch = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_BRANCH,array($this->organizations->ORG_ID=>$org_id) );
            $org_branch = json_decode($org_branch);
            foreach ($org_branch as $key => $br_value)
            {
                foreach($br_value as $value)
                {

                    $assigned_calls = (object)array();
                    $assigned_calls->org_id = $key;
                    $assigned_calls->branch_id = $value;
                    $assigned_calls->user_id = $user_id;
                    $assigned_calls->vendor_org = $org_id;
                    $assigned_calls->aaction = "get_assigned_calls";
                    if($jodata->action == "get_today_calls")
                        $calls_data = $this->_get_today_calls($assigned_calls);
                    else if($jodata->action == "get_pending_hodpms" || $jodata->action =="get_pending_bmepms")
                        $calls_data = $this->_get_pending_bmepms($assigned_calls);
                    else if($jodata->action == "get_pending_hodqc" || $jodata->action == "get_pending_bmeqc")
                        $calls_data = $this->_get_pending_bmeqc($assigned_calls);
                    else if($jodata->action == "get_adverse_incidents")
                        $calls_data  = $this->_get_adverse_incidents($assigned_calls);
                    else if($jodata->action == "get_conrequest_list")
                        $calls_data = $this->_get_conrequest_list($assigned_calls);
                    else if($jodata->action == "get_otherunit_unit_transfer_calls")
                        $calls_data = $this->_get_otherunit_unit_transfer_calls($assigned_calls);
                    else
                        $calls_data = [];

                    if(!empty($calls_data))
                        array_push($assigned_data , $calls_data);
                }
            }

            if (!empty($assigned_data)) {
                $data['response'] = SUCCESSDATA;
                $data['devices'] = $assigned_data;
            } else {
                $data['response'] = EMPTYDATA;
            }
        }

        return $data;
    }


    private function _get_today_calls($jodata = array())
    {
        // return "fgfg";
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
			$branchs = $this->basemodel->fetch_records_from($this->branches->tbl_name,array($this->branches->STATUS=>ACTIVESTS,$this->branches->ORG_ID=>$org_id),$this->branches->BRANCH_ID);
			for($i = 0; $i < count($branchs); $i++)
				$branch[$i] = "'".$branchs[$i]['BRANCH_ID']."'";
			$branch = '(' . implode($branch, ',') . ')';
            $where[$this->cms->ORG_ID] = $org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->cms->STATUS . " !="] = DW;$where[$this->cms->TO_ADVERSE . " ="] = NULL;
            $or_where = '';

            if (isset($jodata->aaction) && $jodata->aaction == "get_hod_calls") {
                $or_where = "(" . $this->cms->RESPONDED_BY . "='" . $user_id . "' OR " . $this->cms->ASSIGNED_TO . "='" . $user_id . "')";
            }
            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls" ){
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

            }


            if ($branch_id != 'All')
                $where[$this->cms->BRANCH_ID] = $branch_id;
            else {
                $or_where .= ($or_where == '') ? '' : " AND ";
                $or_where .= $this->cms->BRANCH_ID . " IN " . $branch;
            }
            $cms_data = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name, $where, $or_where, '*', $this->cms->ID, 'desc');
            if (!empty($cms_data)) {
                $data['response'] = SUCCESSDATA;
                $cms_data = $this->baselibrary->cms_call_details($cms_data);
                $data['devices'] = $cms_data;
            } else {
                $data['response'] = EMPTYDATA;
            }

            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls")
                return $cms_data;
        }

        return $data;
    }

    private function _get_bme_today_calls($jodata = array())
    {
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->cms->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->cms->TO_ADVERSE] = NULL;
            if (isset($jodata->user_id))
                $user_id = $jodata->user_id;
            else
                $user_id = $this->session->user_id;
            $where[$this->cms->STATUS . " !="] = DW;

            $or_where = "(" . $this->cms->RESPONDED_DATE . " IS NULL OR " . $this->cms->RESPONDED_BY . "='" . $user_id . "' OR " . $this->cms->ASSIGNED_TO . "='" . $user_id . "' OR " . $this->cms->ASSIGNED_BY . "='" . $user_id . "' OR " . $this->cms->ATTENDED_BY . " = '" . $user_id . "')";
            if($branch_id != 'All')
                $where[$this->cms->BRANCH_ID] = $branch_id;
            else
                $or_where .= " AND ".$this->cms->BRANCH_ID ." IN ".BRANCHALL;

            $cms_data = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name, $where, $or_where, '*', $this->cms->CDATE . "," . $this->cms->CTIME, 'desc');
            if (!empty($cms_data)) {
                $data['response'] = SUCCESSDATA;
                $data['devices'] = $this->baselibrary->cms_call_details($cms_data);
            } else {
                $data['response'] = EMPTYDATA;
            }

            return $data;
        }
    }
    
    private function _get_branch($jodata){
        
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
            return $branch;
    }

    private function _app_not_responded_calls($jodata = array())
    {


        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {

            $cms_data = array();
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->cms->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->cms->STATUS . " !="] = DW;
            $where[$this->cms->RESPONDED_DATE] = NULL;
            
            $branch = $this->_get_branch($jodata);

            // $where1[$this->devices->ASSIGN_ID] = '';


            if($branch_id != 'All')
                $where[$this->cms->BRANCH_ID] = $branch_id;
            else {
                $or_where = $this->cms->BRANCH_ID ." IN ".$branch;
            }




            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;

                $cnt = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name, $where, $or_where, 'count(' . $this->cms->ID . ') AS CNT');



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


                $cms_data = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->cms->tbl_name, $where, $or_where,'','','','', '*', $this->cms->CDATE, 'desc','10',$limit_val*10);



                for($i = 0; $i < count($cms_data); $i++) {

                    //  $where1[$this->devices->BRANCH_ID] = $cms_data[$i]['BRANCH_ID'];
                    //  $where1[$this->devices->ORG_ID] = $cms_data[$i]['ORG_ID'];
                    $where1[$this->devices->E_ID] = $cms_data[$i]['EID'];


                    $devices1 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1,array($this->devices->ASSIGN_ID));

                    if(!empty($devices1)) {

                        $cms_data[$i]['ASSIGN_ID'] = $devices1['ASSIGN_ID'];


                    }

                }

            }


            else
            {


                $cms_data = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name, $where,$or_where);


                for($i = 0; $i < count($cms_data); $i++) {

                    //  $where1[$this->devices->BRANCH_ID] = $cms_data[$i]['BRANCH_ID'];
                    //  $where1[$this->devices->ORG_ID] = $cms_data[$i]['ORG_ID'];
                    $where1[$this->devices->E_ID] = $cms_data[$i]['EID'];


                    $devices2 = $this->basemodel->fetch_single_row($this->devices->tbl_name,$where1,array($this->devices->ASSIGN_ID));


                    if(!empty($devices2)){



                        $cms_data[$i]['ASSIGN_ID'] = $devices2['ASSIGN_ID'];



                    }

                }
                //  array_push($cms_data,$call_res1);
            }

            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }

            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));

            $cms = array();
            for($i = 0; $i < count($devices); $i++) {

                $bwhere[$this->cms->STATUS . " !="] = DW;
                $bwhere[$this->cms->RESPONDED_DATE] = NULL;
                $bwhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];

                $call_res = $this->basemodel->fetch_single_row($this->cms->tbl_name, $bwhere);

                if(!empty($call_res))
                {

                    $call_res['ASSIGN_ID'] = $devices[$i]['E_ID'];

                    array_push($cms,$call_res);

                }

            }

            if(!empty($cms) ||  !empty($cms_data)){
                $cms_data = array_merge($cms_data, $cms);
                $data['response'] = SUCCESSDATA;
                $data['devices'] = $this->baselibrary->cms_call_details($cms_data);
            }else
            {

                $data['response']  = EMPTYDATA;
                $data['devices'] = array();

            }

            if(isset($jodata->only_ns) && $jodata->only_ns==YESSTATE)
            {
                return $data;
            }
            $pending_pms = $this->_get_pending_bmepms($jodata);
            if(isset($pending_pms['pending_pms']))
                $data['pending_pms'] = $pending_pms['pending_pms'];
            else
                $data['pending_pms'] = array();

            $pending_qc = $this->_get_pending_bmeqc($jodata);
            if(isset($pending_qc['pending_qc']))
                $data['pending_qc'] = $pending_qc['pending_qc'];
            else
                $data['pending_qc'] = array();

            //adverse incidents
            $adverse_incidents = $this->_get_adverse_incidents($jodata);
            if(!empty($adverse_incidents) && $adverse_incidents['response']==SUCCESSDATA)
            {
                $data['adverse_incedents'] = $adverse_incidents['list'];
            }
            else
            {
                $data['adverse_incedents'] = array();
            }
            $transfers = $this->_get_tansfer_list($jodata);
            if(!empty($transfers) && $transfers['response']==SUCCESSDATA)
            {
                $data['transfer'] = $transfers['list'];
            }
            else
            {
                $data['transfer'] = array();
            }
            $condmnation = $this-> _get_conrequest_list($jodata);
            if(!empty($condmnation) && $condmnation['response']==SUCCESSDATA)
            {
                $data['condmnation'] = $condmnation['list'];
            }
            else
            {
                $data['condmnation'] = array();
            }

            return $data;
        }

    }

    private function _self_respond_call($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            
            $where[$this->cms->BRANCH_ID] = isset($jodata->BRANCH_ID) ? $jodata->BRANCH_ID : $this->session->branch_id;
            $where[$this->cms->ORG_ID] = ($jodata->orgg_id == $jodata->org_id) ?  $jodata->orgg_id : $jodata->org_id;

            $user_id = isset($jodata->user_id) ? $jodata->user_id :$this->session->user_id;

            $caller_id = isset($jodata->org_id) ?  $jodata->CALLER_ID : $jodata->CALLER_ID;

            $eid = $jodata->EID;
            if (isset($jodata->REMARKS))
                $remarks = $jodata->REMARKS;
            else
                $remarks = NULL;
            $where[$this->cms->CALLER_ID] = $caller_id;
            $where[$this->cms->EID] = $eid;
            $call_details = $this->basemodel->fetch_single_row($this->cms->tbl_name, $where);
            if (!empty($call_details)) {
                if ($call_details[$this->cms->RESPONDED_DATE] != NULL) {
                    $data['response'] = EXISTSDATA;
                    $data['call_back'] = 'Some one Already Responded to this Call';
                } else {
                    $rdate = date('Y-m-d');
                    $rtime = date('H:i:s');
                    $start_datetime = $call_details[$this->cms->CDATE] . " " . $call_details[$this->cms->CTIME];
                    $end_datetime = $rdate . " " . $rtime;
                    $response_time = $this->basemodel->timeDifference($start_datetime, $end_datetime, 'minutes');
                    //   $cms_update[$this->cms->CALLER_NAME] =
                    $cms_update[$this->cms->RESPONDED_BY] = $user_id;
                    $cms_update[$this->cms->RESPONDED_DATE] = $rdate;
                    $cms_update[$this->cms->RESPONDED_TIME] = $rtime;
                    $cms_update[$this->cms->RESPONSE_TIME] = $response_time;
                    $cms_update[$this->cms->REMARKS] = $remarks;
                    $update = $this->basemodel->update_operation($cms_update, $this->cms->tbl_name, $where);
                    if ($this->basemodel->update_operation($cms_update, $this->cms->tbl_name, $where)) {
                        $data['response'] = SUCCESSDATA;
                        $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$eid));
                        $data['call_back'] = 'Your Respond To Call, Please Attend as soon as Possible';
                        if(is_numeric($user_id))
                            $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->EMP_NO => $user_id));
                        else
                            $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));
                        if($device_details[$this->devices->PHY_LOCATION]!=NULL)
                        {
                            $notification = "Call From ".$device_details[$this->devices->PHY_LOCATION]." Responded By ".$emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to ".$call_details[$this->cms->NATURE_OF_COMP];
                        }
                        else
                        {
                            $notification =  $notification = "Call Responded By ".$emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to ".$call_details[$this->cms->NATURE_OF_COMP];
                        }

                        $data['notification'] = $this->baselibrary->send_notification($where[$this->cms->ORG_ID], $where[$this->cms->BRANCH_ID], $notification);
                        /* if($device_details[$this->devices->AMC_TYPE. "!="] = NULL && $device_details[$this->devices->AMC_TYPE. "!="] = 'BME' && $device_details[$this->devices->DISTRIBUTOR. "!="] = '' && $device_details[$this->devices->DISTRIBUTOR. "!="] = NULL )
                                               {
                                                   $distributer = $device_details[$this->devices->DISTRIBUTOR];
                                                   $data['vnotification']=$this->baselibrary->send_vendor_notification($notification,$distributer);
                                               }*/

                    } else {
                        $data['response'] = FAILEDATA;
                        $data['call_back'] = 'Unable to Process Your Request Try Again...';
                    }
                }
            } else {
                $data['response'] = EMPTYDATA;
                $data['call_back'] = 'No Call is there With Your Request';
            }
        }
        return $data;
    }

    private function _attend_responded_call($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $where[$this->cms->BRANCH_ID] = isset($jodata->BRANCH_ID) ? $jodata->BRANCH_ID : $this->session->branch_id;
            $where[$this->cms->ORG_ID] =  ($jodata->orgg_id == $jodata->org_id) ? $jodata->orgg_id : $jodata->org_id;
            $user_id  =  isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

            $caller_id = $jodata->CALLER_ID;
            $eid =  $jodata->EID;
            if (isset($jodata->REMARKS))
                $remarks = $jodata->REMARKS;
            else
                $remarks = NULL;
            $where[$this->cms->CALLER_ID] = $caller_id;
            $where[$this->cms->EID] = $eid;
            $call_details = $this->basemodel->fetch_single_row($this->cms->tbl_name, $where);
            // return $this->db->last_query();
            if (!empty($call_details)) {
                $adate = date('Y-m-d');
                $atime = date('H:i:s');
                $cms_update[$this->cms->ATTENDED_BY] = $user_id;
                $cms_update[$this->cms->ATTENDED_DATE] = $adate;
                $cms_update[$this->cms->ATTENDED_TIME] = $atime;
                $cms_update[$this->cms->REMARKS] = $remarks;
                if ($this->basemodel->update_operation($cms_update, $this->cms->tbl_name, $where)) {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = 'You have attended the Call, Please Complete as soon as Possible';
                    $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$eid));
                    if(is_numeric($user_id))
                        $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->EMP_NO => $user_id));
                    else
                        $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));
                    if($device_details[$this->devices->PHY_LOCATION]!=NULL)
                        $notification = "Call From ".$device_details[$this->devices->PHY_LOCATION]." Attended By ".$emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to ".$call_details[$this->cms->NATURE_OF_COMP];
                    else
                        $notification = "Call Attended By ".$emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to ".$call_details[$this->cms->NATURE_OF_COMP];
                    /* insert log table */
                    $data['calllog'] = $this->baselibrary->insert_calllog($user_id,$notification,$adate,$atime,$adate . " " . $atime,$where[$this->cms->ORG_ID],$where[$this->cms->BRANCH_ID]);

                    $data['history_table'] = $this->baselibrary->insert_device_history($eid,$notification,REPAIRING, $adate. " " .$atime,$where[$this->cms->ORG_ID],$where[$this->cms->BRANCH_ID],$device_details[$this->devices->DEPT_ID]);

                    $data['notification'] = $this->baselibrary->send_notification($where[$this->cms->ORG_ID], $where[$this->cms->BRANCH_ID], $notification);
                    /*  if($device_details[$this->devices->AMC_TYPE. "!="] = NULL && $device_details[$this->devices->AMC_TYPE. "!="] = 'BME' && $device_details[$this->devices->DISTRIBUTOR. "!="] = '' && $device_details[$this->devices->DISTRIBUTOR. "!="] = NULL )
                      {
                          $distributer = $device_details[$this->devices->DISTRIBUTOR];
                          $data['vnotification']=$this->baselibrary->send_vendor_notification($notification,$distributer);
                      }*/

                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = 'Unable to Process Your Request Try Again...';
                }
            } else {
                $data['response'] = EMPTYDATA;
                $data['call_back'] = 'No Call is there With Your Request';
            }

        }
        return $data;
    }

    private function _assign_call($jodata = array())
    {

        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->BRANCH_ID) ? $jodata->BRANCH_ID : $this->session->branch_id;
            $org_id = ($jodata->orgg_id == $jodata->org_id) ? $jodata->orgg_id : $jodata->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $org_type[$this->organizations->ORG_TYPE] = 'Vendor';

            $where[$this->cms->BRANCH_ID] = $branch_id;
            $where[$this->cms->ORG_ID] = $org_id;
            $caller_id = $jodata->CALLER_ID;
            $eid =  $jodata->EID;
            if (isset($jodata->assignremarks))
                $remarks = $jodata->assignremarks;
            else
                $remarks = NULL;
            $assign_to = $jodata->vendor_user_id;
            $where[$this->cms->CALLER_ID] = $caller_id;
            $where[$this->cms->EID] = $eid;

            $call_details = $this->basemodel->fetch_single_row($this->cms->tbl_name, $where);
            // return $this->db->last_query();
            if (!empty($call_details)) {
                $rdate = date('Y-m-d');
                $rtime = date('H:i:s');
                $end_datetime = $rdate . " " . $rtime;
                if ($jodata->action == "re_assign_call")
                {
                    $start_datetime = $call_details[$this->cms->CDATE] . " " . $call_details[$this->cms->CTIME];
                    $response_time = $this->basemodel->timeDifference($start_datetime, $end_datetime, 'minutes');
                    $cms_update[$this->cms->RESPONDED_BY] = $user_id;
                    $cms_update[$this->cms->RESPONDED_DATE] = $rdate;
                    $cms_update[$this->cms->RESPONDED_TIME] = $rtime;
                    $cms_update[$this->cms->RESPONSE_TIME] = $response_time;
                    $cms_update[$this->cms->PENDING_REASON] = NULL;
                    $cms_update[$this->cms->ATTENDED_DATE] =NULL;
                    $cms_update[$this->cms->ATTENDED_TIME] = NULL;
                    $cms_update[$this->cms->ATTENDED_BY]=NULL;
                    $cms_update[$this->cms->PENDING_DATE] =NULL;
                    $cms_update[$this->cms->STATUS] = "Not Working";
                }
                if($jodata->action == "re_pending_assign_call")
                {
                    // return "dfgg";
                    /* $cms_update[$this->cms->ASSIGNED_BY] = $user_id;
                    $cms_update[$this->cms->ASSIGNED_TO] = $assign_to;
                    $cms_update[$this->cms->ASSIGNED_ON] = $end_datetime;
                    $cms_update[$this->cms->REMARKS] = $remarks;*/
                    $cms_update[$this->cms->PENDING_REASON] = NULL;
                    $cms_update[$this->cms->ATTENDED_DATE] =NULL;
                    $cms_update[$this->cms->ATTENDED_TIME] = NULL;
                    $cms_update[$this->cms->ATTENDED_BY]=NULL;
                    $cms_update[$this->cms->PENDING_DATE] =NULL;
                    $cms_update[$this->cms->STATUS] = "Not Working";

                    //   $cms_update[$this->cms->ASSIGNED_STATUS] = YESSTATE;

                }
                $cms_update[$this->cms->ASSIGNED_BY] = $user_id;
                $cms_update[$this->cms->ASSIGNED_TO] = $assign_to;
                $cms_update[$this->cms->ASSIGNED_ON] = $end_datetime;
                $cms_update[$this->cms->REMARKS] = $remarks;
                //$cms_update[$this->cms->STATUS] = DNW;
                // $cms_update[$this->cms->ATTENDED_BY] = $cms_update[$this->cms->ATTENDED_DATE] = $cms_update[$this->cms->ATTENDED_TIME] = NULL;


                if ($this->basemodel->update_operation($cms_update, $this->cms->tbl_name, $where)) {

                    /*if($jodata->action =="re_pending_assign_call") {
                        $cms_insert[$this->cms->RESPONDED_BY] = $jodata->RESPONDED_BY;
                        $cms_insert[$this->cms->RESPONDED_DATE] = $jodata->RESPONDED_DATE;
                        $cms_insert[$this->cms->RESPONDED_TIME] = $jodata->RESPONDED_TIME;
                        $cms_insert[$this->cms->RESPONSE_TIME] = $jodata->RESPONSE_TIME;
                        $cms_insert[$this->cms->ATTENDED_BY]= $jodata->ATTENDED_BY;
                        $cms_insert[$this->cms->ATTENDED_DATE] = $jodata->ATTENDED_DATE;
                        $cms_insert[$this->cms->ATTENDED_TIME] = $jodata->ATTENDED_TIME;
                        $cms_insert[$this->cms->ORG_ID] = $jodata->ORG_ID;
                        $cms_insert[$this->cms->BRANCH_ID] = $jodata->BRANCH_ID;
                        $cms_insert[$this->cms->EID] = $jodata->EID;
                        $cms_insert[$this->cms->NATURE_OF_COMP] =$jodata->NATURE_OF_COMP;
                        $cms_insert[$this->cms->CALLER_ID]  = $jodata->CALLER_ID;
                        $cms_insert[$this->cms->CDATE] = $jodata->CDATE;
                        $cms_insert[$this->cms->CTIME] = $jodata->CTIME;
                        $cms_insert[$this->cms->CALLER_DEPT] = $jodata->CALLER_DEPT;
                        $cms_insert[$this->cms->JOBCOMPLETED_TIME] = $jodata->JOBCOMPLETED_TIME;
                        $cms_insert[$this->cms->PO_NUMBER] = $jodata->PO_NUMBER;
                        $cms_insert[$this->cms->JOBCOMPLETED_DATE] = $jodata->JOBCOMPLETED_DATE;
                        //  $cms_insert[$this->cms->INCIDENT_TYPE] = $jodata->INCIDENT_TYPE;
                        $cms_insert[$this->cms->PENDING_REASON] = $jodata->PENDING_REASON;
                        $cms_insert[$this->cms->PENDING_DATE] = $jodata->PENDING_DATE;
                        $cms_insert[$this->cms->PO_DATE] = $jodata->PO_DATE;
                        $cms_insert[$this->cms->TO_ADVERSE] = $jodata->TO_ADVERSE;
                        $cms_insert[$this->cms->CALLER_DEPT] = $jodata->CALLER_DEPT;
                        $cms_insert[$this->cms->PARTS_CHANGE] = $jodata->PARTS_CHANGE;
                        $cms_insert[$this->cms->ACTION_TAKEN] = $jodata->ACTION_TAKEN;
                        $cms_insert[$this->cms->REMARKS] = $jodata->REMARKS;
                        $cms_insert[$this->cms->DELIVERY_DATE] = $jodata->DELIVERY_DATE;
                        $cms_insert[$this->cms->TYPE] = $jodata->TYPE;
                        $cms_insert[$this->cms->PRIORITY] = $jodata->PRIORITY;
                        $cms_insert[$this->cms->STATUS] = $jodata->STATUS;
                        $cms_insert[$this->cms->COST] = $jodata->COST;

                        $this->basemodel->insert_into_table($this->cms->tbl_name, $cms_insert);
                    }*/
                    $data['response'] = SUCCESSDATA;

                    $res = $this->basemodel->fetch_records_from($this->users->tbl_name,  array($this->users->USER_ID=>$jodata->vendor_user_id));
                    //return $this->db->last_query();
                    if($res)
                        $assigned_to = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID =>$assign_to));
                    else
                        $assigned_to = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID =>$assign_to));

                    // return $assigned_to;

                    // $assigned_to = $assign_to==Vendor ? $assign_to : $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $assign_to));
                    $data['call_back'] = "Call Assigned to " . $assigned_to . " Successfully";
                    $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$eid));
                    //  return $this->db->last_query();

                    //if($res)
                    if(is_numeric($user_id))
                        $emp_id = $user_id;
                    else
                        $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));

                    $assign_to_emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $assign_to));
                    // else

                    if($device_details[$this->devices->PHY_LOCATION]!=NULL)
                        $notification = "Call From ".$device_details[$this->devices->PHY_LOCATION]." Assigned By ".$emp_id." To ".$assign_to_emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to ".$call_details[$this->cms->NATURE_OF_COMP];
                    else
                        $notification = "Call Assigned By ".$emp_id." To ".$assign_to_emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to ".$call_details[$this->cms->NATURE_OF_COMP];
                    $data['notification'] = $this->baselibrary->send_notification($where[$this->cms->ORG_ID], $where[$this->cms->BRANCH_ID], $notification);
                    /*  if($device_details[$this->devices->AMC_TYPE."!="] = NULL && $device_details[$this->devices->AMC_TYPE."!="] = 'BME' && $device_details[$this->devices->AMC_TYPE."!="] = '' && $device_details[$this->devices->DISTRIBUTOR. "!="]= NULL )
                      {
                          $distributer = $device_details[$this->devices->DISTRIBUTOR];
                          $data['vnotification']=$this->baselibrary->send_vendor_notification($notification,$distributer);
                      }*/

                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = 'Unable to Process Your Request Try Again...';
                }
            } else {
                $data['response'] = EMPTYDATA;
                $data['call_back'] = 'No Call is there With Your Request';
            }
        }
        return $data;
    }




    private function _re_pending_assign_call($jodata = array())
    {

        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {

            $branch_id = isset($jodata->BRANCH_ID) ? $jodata->BRANCH_ID : $this->session->branch_id;
            $org_id = ($jodata->orgg_id == $jodata->org_id) ? $jodata->orgg_id : $jodata->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $org_type[$this->organizations->ORG_TYPE] = 'Vendor';

            $where[$this->cms->BRANCH_ID] = $branch_id;
            $where[$this->cms->ORG_ID] = $org_id;
            $caller_id = $jodata->CALLER_ID;
            $eid =  $jodata->EID;
            if (isset($jodata->assignremarks))
                $remarks = $jodata->assignremarks;
            else
                $remarks = NULL;
            $assign_to = $jodata->vendor_user_id;
            $where[$this->cms->CALLER_ID] = $caller_id;
            $where[$this->cms->EID] = $eid;


            $call_details = $this->basemodel->fetch_single_row($this->cms->tbl_name, $where);
            //return $this->db->last_query();
            if (!empty($call_details)) {
                $rdate = date('Y-m-d');
                $rtime = date('H:i:s');
                $end_datetime = $rdate . " " . $rtime;
                if ($jodata->action == "re_assign_call")
                {
                    $start_datetime = $call_details[$this->cms->CDATE] . " " . $call_details[$this->cms->CTIME];
                    $response_time = $this->basemodel->timeDifference($start_datetime, $end_datetime, 'minutes');
                    $cms_update[$this->cms->RESPONDED_BY] = $user_id;
                    $cms_update[$this->cms->RESPONDED_DATE] = $rdate;
                    $cms_update[$this->cms->RESPONDED_TIME] = $rtime;
                    $cms_update[$this->cms->RESPONSE_TIME] = $response_time;
                    //$cms_update[$this->cms->PENDING_REASON] = NULL;
                    $cms_update[$this->cms->ATTENDED_DATE] =NULL;
                    $cms_update[$this->cms->ATTENDED_TIME] = NULL;
                    $cms_update[$this->cms->ATTENDED_BY]=NULL;
                    $cms_update[$this->cms->PENDING_DATE] =NULL;
                    $cms_update[$this->cms->STATUS] = "Not Working";
                    return $cms_update;
                }
                $cms_update[$this->cms->ASSIGNED_BY] = $user_id;
                $cms_update[$this->cms->ASSIGNED_TO] = $assign_to;
                $cms_update[$this->cms->ASSIGNED_ON] = $end_datetime;
                $cms_update[$this->cms->REMARKS] = $remarks;


                //$cms_update[$this->cms->STATUS] = DNW;
                // $cms_update[$this->cms->ATTENDED_BY] = $cms_update[$this->cms->ATTENDED_DATE] = $cms_update[$this->cms->ATTENDED_TIME] = NULL;
                //return $cms_update;
                //  $cms_insert[$this->cms->RESP]





                // return $this->db->last_query();

                if ($this->basemodel->update_operation($cms_update, $this->cms->tbl_name, $where)) {


                    $data['response'] = SUCCESSDATA;

                    $res = $this->basemodel->fetch_records_from($this->users->tbl_name,  array($this->users->USER_ID=>$jodata->vendor_user_id));
                    //return $this->db->last_query();
                    if($res)
                        $assigned_to = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID =>$assign_to));
                    else
                        $assigned_to = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID =>$assign_to));

                    // return $assigned_to;

                    // $assigned_to = $assign_to==Vendor ? $assign_to : $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $assign_to));
                    $data['call_back'] = "Call Assigned to " . $assigned_to . " Successfully";
                    $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$eid));
                    //  return $this->db->last_query();

                    //if($res)
                    if(is_numeric($user_id))
                        $emp_id = $user_id;
                    else
                        $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));

                    $assign_to_emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $assign_to));
                    // else

                    if($device_details[$this->devices->PHY_LOCATION]!=NULL)
                        $notification = "Call From ".$device_details[$this->devices->PHY_LOCATION]." Assigned By ".$emp_id." To ".$assign_to_emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to ".$call_details[$this->cms->NATURE_OF_COMP];
                    else
                        $notification = "Call Assigned By ".$emp_id." To ".$assign_to_emp_id." From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ",Id: ". $device_details[$this->devices->E_ID] ." Due to ".$call_details[$this->cms->NATURE_OF_COMP];
                    $data['notification'] = $this->baselibrary->send_notification($where[$this->cms->ORG_ID], $where[$this->cms->BRANCH_ID], $notification);
                    /*  if($device_details[$this->devices->AMC_TYPE."!="] = NULL && $device_details[$this->devices->AMC_TYPE."!="] = 'BME' && $device_details[$this->devices->AMC_TYPE."!="] = '' && $device_details[$this->devices->DISTRIBUTOR. "!="]= NULL )
                      {
                          $distributer = $device_details[$this->devices->DISTRIBUTOR];
                          $data['vnotification']=$this->baselibrary->send_vendor_notification($notification,$distributer);
                      }*/
                } else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = 'Unable to Process Your Request Try Again...';
                }
            } else {
                $data['response'] = EMPTYDATA;
                $data['call_back'] = 'No Call is there With Your Request';
            }
        }
        return $data;
    }




    private function _make_pending_call($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->BRANCH_ID) ? $jodata->BRANCH_ID : $this->session->branch_id;
            $org_id = ($jodata->orgg_id == $jodata->org_id) ? $jodata->orgg_id : $jodata->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $ucms[$this->cms->ACTION_TAKEN] = $jodata->ACTION_TAKEN;
            $ucms[$this->cms->PENDING_REASON] = $jodata->PENDING_REASON;
            $ucms[$this->cms->PENDING_DATE] = date("Y-m-d H:i:s");
            $ucms[$this->cms->PARTS_CHANGE] = $jodata->PARTS_CHANGE;
            if(isset($jodata->PART_TYPE))
                $ucms[$this->cms->PART_TYPE] = $jodata->PART_TYPE;
            if(isset($jodata->PART_NAME))
                $ucms[$this->cms->PART_NAME] = $jodata->PART_NAME;
            if(isset($jodata->PO_NUMBER))
                $ucms[$this->cms->PO_NUMBER] = $jodata->PO_NUMBER;
            if(isset($jodata->REMARKS))
                $ucms[$this->cms->REMARKS] = $jodata->REMARKS;
            if(isset($jodata->COST))
                $ucms[$this->cms->COST] = $jodata->COST;
            if (!is_null($jodata->PO_DATE))
                $ucms[$this->cms->PO_DATE] = date('Y-m-d', strtotime($jodata->PO_DATE));
            if (!is_null($jodata->DELIVERY_DATE))
                $ucms[$this->cms->DELIVERY_DATE] = date('Y-m-d', strtotime($jodata->DELIVERY_DATE));
            $ucms[$this->cms->STATUS] = UMAINTENCE;

            $ucwhere[$this->cms->CALLER_ID] = $jodata->CALLER_ID;
            $ucwhere[$this->cms->EID] = $jodata->EID ;

            $ucwhere[$this->cms->ORG_ID] = $org_id;
            $ucwhere[$this->cms->BRANCH_ID] = $branch_id;

            if ($this->basemodel->update_operation($ucms, $this->cms->tbl_name, $ucwhere))
            {
                unset($ucwhere[$this->cms->CALLER_ID]);
                $ucwhere[$this->devices->E_ID] = $ucwhere[$this->cms->EID];
                unset($ucwhere[$this->cms->EID]);
                $device_dtls = $this->basemodel->fetch_single_row($this->devices->tbl_name,$ucwhere);
                $pdate = date('Y-m-d');
                $ptime = date('H:i:s');
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = 'Call set as Pending, Please Resolve it as soon as Possible';
                $notification = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id)) . " set as pending job: " . $jodata->CALLER_ID . " on Eq.ID: " . $jodata->EID;

                $this->baselibrary->insert_calllog($user_id,$notification,$pdate,$ptime,$pdate . " " . $ptime,$org_id,$branch_id);
                $data['history_table'] = $this->baselibrary->insert_device_history($jodata->EID,$notification,UMAINTENCE, $pdate. " " .$ptime,$org_id,$branch_id,$device_dtls[$this->devices->DEPT_ID]);

                $dvwhere[$this->devices->E_ID] = $jodata->EID;
                $dvwhere[$this->devices->ORG_ID] = $org_id;
                $dvwhere[$this->devices->BRANCH_ID] = $branch_id;
                $udevice[$this->devices->REMARKS] = $jodata->REMARKS;
                $udevice[$this->devices->EQ_CONDATION] = UMAINTENCE;
                $this->basemodel->update_operation($udevice, $this->devices->tbl_name, $dvwhere);  //update device info

                $data['notification'] = $this->baselibrary->send_notification($org_id, $branch_id, $notification);
                /* if($device_dtls[$this->devices->AMC_TYPE."!="] = NULL && $device_dtls[$this->devices->AMC_TYPE."!="]  = 'BME' && $device_dtls[$this->devices->DISTRIBUTOR. "!="] = '' && $device_dtls[$this->devices->DISTRIBUTOR. "!="] = NULL )
                 {
                     $distributer = $device_dtls[$this->devices->DISTRIBUTOR];
                     $data['vnotification']=$this->baselibrary->send_vendor_notification($notification,$distributer);
                 }*/
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = 'Unable To Process Your Request, Please Try Again';
            }
        }
        return $data;
    }

    private function _complete_the_call($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->BRANCH_ID) ? $jodata->BRANCH_ID : $this->session->branch_id;
            $org_id = ($jodata->orgg_id == $jodata->org_id) ? $jodata->orgg_id : $jodata->org_id;
            if (isset($jodata->user_id))
                $user_id = $jodata->user_id;
            else
                $user_id = $this->session->user_id;
            //

            $caller_id = $jodata->CALLER_ID;
            $eid =  $jodata->EID;
            $cms_where[$this->cms->CALLER_ID] = $caller_id;
            $cms_where[$this->cms->EID] = $eid;
            $cms_where[$this->cms->BRANCH_ID] = $branch_id;
            $cms_where[$this->cms->ORG_ID] = $org_id;

            $call_details = $this->basemodel->fetch_single_row($this->cms->tbl_name, $cms_where);
            $old_remarks = $call_details[$this->cms->REMARKS];
            if (is_null($old_remarks))
                $ucms[$this->cms->REMARKS] = $jodata->REMARKS;
            else
                $ucms[$this->cms->REMARKS] = $old_remarks . "::" . $jodata->REMARKS;
            $cdate = date('Y-m-d');
            $ctime = date('H:i:s');
            $gdatetime = $call_details[$this->cms->CDATE] . " " . $call_details[$this->cms->CTIME];
            $adatetime = $call_details[$this->cms->ATTENDED_DATE] . " " . $call_details[$this->cms->ATTENDED_TIME];
            $cdatetime = $cdate . " " . $ctime;
            $ucms[$this->cms->DOWN_TIME] = $this->basemodel->timeDifference($gdatetime, $cdatetime, 'days');
            $ucms[$this->cms->TIME_TO_REPAIR] = $this->basemodel->timeDifference($adatetime, $cdatetime, 'days');
            $ucms[$this->cms->JOBCOMPLETED_DATE] = $cdate;
            $ucms[$this->cms->JOBCOMPLETED_TIME] = $ctime;
            $ucms[$this->cms->APPROVAL] = PENDING;
            $ucms[$this->cms->STATUS] = DW;

            $ucms[$this->cms->ACTION_TAKEN] = isset($jodata->ACTION_TAKEN) ? $jodata->ACTION_TAKEN : NULL;
            $ucms[$this->cms->PENDING_REASON] = isset($jodata->PENDING_REASON) ? $jodata->PENDING_REASON : NULL;
            $ucms[$this->cms->PARTS_CHANGE] = isset($jodata->PARTS_CHANGE) ? $jodata->PARTS_CHANGE : NULL;
            $ucms[$this->cms->PART_TYPE] = isset($jodata->PART_TYPE) ? $jodata->PART_TYPE : NULL;
            $ucms[$this->cms->PART_NAME] = isset($jodata->PART_NAME) ? $jodata->PART_NAME : NULL;
            $ucms[$this->cms->PO_NUMBER] = isset($jodata->PO_NUMBER) ? $jodata->PO_NUMBER : NULL;
            $ucms[$this->cms->COST] = isset($jodata->COST) ? (int)$jodata->COST : NULL;
            $ucms[$this->cms->SPENT_COST] = isset($jodata->SPENT_COST) ? (int)$jodata->SPENT_COST : NULL;
            if(isset($jodata->SPENT_COST) && isset($jodata->SPENT_COST))
                $ucms[$this->cms->SAVINGS_COST] = $ucms[$this->cms->COST] - $ucms[$this->cms->SPENT_COST];
            if (isset($jodata->PO_NUMBER) && $jodata->PO_DATE!=NULL)
                $ucms[$this->cms->PO_DATE] = date('Y-m-d', strtotime($jodata->PO_DATE));
            if (isset($jodata->DELIVERY_DATE) && $jodata->DELIVERY_DATE!=NULL)
                $ucms[$this->cms->DELIVERY_DATE] = date('Y-m-d', strtotime($jodata->DELIVERY_DATE));
            if ($this->basemodel->update_operation($ucms, $this->cms->tbl_name, $cms_where))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = 'Call Completed Successfully';
                $device_details = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$eid));
                if(is_numeric($user_id))
                    $emp_id = $user_id;
                else
                    $emp_id = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $user_id));
                if($device_details[$this->devices->PHY_LOCATION]!=NULL)
                    $notification = "Call From ".$device_details[$this->devices->PHY_LOCATION]." Completed By ".$emp_id."  From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ", ID: ". $device_details[$this->devices->E_ID] ." Due to ".$call_details[$this->cms->NATURE_OF_COMP];
                else
                    $notification = "Call Completed By ".$emp_id."  From ".$device_details[$this->devices->DEPT_ID]." Department For Equipment ". $device_details[$this->devices->E_NAME] . ", ID: ". $device_details[$this->devices->E_ID] ." Due to ".$call_details[$this->cms->NATURE_OF_COMP];

                $this->baselibrary->insert_calllog($user_id,$notification,$cdate,$ctime,$cdate . " " . $ctime,$org_id,$branch_id);

                /* device hitory table */
                $dvwhere[$this->devices->E_ID] = $jodata->EID;
                $dvwhere[$this->devices->ORG_ID] = $org_id;
                $dvwhere[$this->devices->BRANCH_ID] = $branch_id;
                $device_dtls = $this->basemodel->fetch_single_row($this->devices->tbl_name,$dvwhere);
                $data['history_table'] = $this->baselibrary->insert_device_history($jodata->EID,$notification,DW,  $cdate . " " . $ctime,$org_id,$branch_id,$device_dtls[$this->devices->DEPT_ID]);
                $udevice[$this->devices->REMARKS] = $jodata->REMARKS;
                $udevice[$this->devices->EQ_CONDATION] = DW;
                $this->basemodel->update_operation($udevice, $this->devices->tbl_name, $dvwhere); /* update device info */
                $data['notification'] = $this->baselibrary->send_notification($org_id, $branch_id, $notification);
                /* if($device_details[$this->devices->AMC_TYPE."!="] = NULL && $device_details[$this->devices->AMC_TYPE."!="] = 'BME' && $device_details[$this->devices->AMC_TYPE."!="] = '' && $device_details[$this->devices->DISTRIBUTOR."!="] = '' && $device_details[$this->devices->DISTRIBUTOR."!="] = NULL )
                 {
                     $distributer = $device_details[$this->devices->DISTRIBUTOR];
                     $data['vnotification']=$this->baselibrary->send_vendor_notification($notification,$distributer);
                 } */

            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = 'Unable To Process Your Request, Please Try Again';
            }
        }
        return $data;
    }

    private function _get_working_devices($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->devices->ORG_ID] = $org_id;
            $where[$this->devices->BRANCH_ID] = $branch_id;
            $where[$this->devices->EQ_CONDATION] = DW;
            $devices = $this->basemodel->fetch_records_from($this->devices->tbl_name, $where, $this->devices->E_ID, $this->devices->E_ID);
            if (!empty($devices)) {
                $data['devices_ids'] = $devices;
                $data['response'] = SUCCESSDATA;
            } else
                $data['response'] = EMPTYDATA;
        }
        return $data;
    }
    /* private function _submit_round($jodata = array())
     {
         $data = array();
         if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
         {
             $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
             $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
             $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
             $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;

             $insert_rounds[$this->rounds->END_TIME] = date('H:i:s');
             $insert_rounds[$this->rounds->REMARKS] = $jodata->remarks;
             $where_rounds[$this->rounds->ID] = $jodata->rid;
             if($this->basemodel->update_operation($insert_rounds,$this->rounds->tbl_name,$where_rounds))
             {
                 $insert_assigned_round[$this->rounds_assigned->COMPLETED_ON] = date('Y-m-d');
                 $where_assigned_round[$this->rounds_assigned->ID] = $jodata->ID;
                 $this->basemodel->update_operation($insert_assigned_round,$this->rounds_assigned->tbl_name,$where_assigned_round);
                 $data['response'] = SUCCESSDATA;
                 $data['call_back'] = "Round Submitted Successfully";
             }
             else
             {
                 $data['response'] = FAILEDATA;
                 $data['call_back'] = "Unable to submit round try again";
             }
         }
         return $data;
     } */
    private function _submit_round_start_time($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {

            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $dept_id = $jodata->departments;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;

            if (isset($jodata->start_date))
            {
                $insert_rounds[$this->rounds->START_DATE] = date('Y-m-d');
                $insert_rounds[$this->rounds->START_TIME] = date('H:i:s');
            }
            else
            {
                $insert_rounds[$this->rounds->START_DATE] = date('Y-m-d');
                $insert_rounds[$this->rounds->START_TIME] = date('H:i:s');
            }
            $insert_rounds[$this->rounds->ORG_ID] = $org_id;
            $insert_rounds[$this->rounds->BRANCH_ID] = $branch_id;
            $insert_rounds[$this->rounds->DEPT_ID] = $dept_id;
            $insert_rounds[$this->rounds->USERNAME] = $user_id;
            $insert_rounds[$this->rounds->DESG] = $role_code;
            if ($this->basemodel->insert_into_table($this->rounds->tbl_name, $insert_rounds))
            {
                $data['rid'] = $this->db->insert_id();
                $insert_assigned_round[$this->rounds_assigned->COMPLETED_ON] = STARTED;
                $where_assigned_round[$this->rounds_assigned->ID] = $jodata->ID;
                $this->basemodel->update_operation($insert_assigned_round,$this->rounds_assigned->tbl_name,$where_assigned_round);
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Round Started";
            } else {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable to submit round try again";
            }
        }
        return $data;
    }

    private function _get_complete_round($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $where[$this->rounds->ORG_ID] = $org_id;

            if(isset($jodata->department) && $jodata->department!='')
            {
                $where[$this->rounds->DEPT_ID] = $jodata->department;
            }
            if($role_code!=HMADMIN)
            {
                $where[$this->rounds->USERNAME] = $user_id;
            }
            $where[$this->rounds->END_TIME." !="] = NULL;

            $where_date = "";
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->rounds->START_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            }
            else
            {
                $where[$this->rounds->START_DATE] = date('Y-m-d');
            }

            if($branch_id != 'All')
                $where[$this->rounds->BRANCH_ID] = $branch_id;
            else
            {
                $where_date .= ($where_date == '') ? '' : " AND ";
                $where_date .= $this->rounds->BRANCH_ID ." IN ".BRANCHALL;
            }

            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->rounds->tbl_name, $where, $where_date, 'count('.$this->rounds->ID.') AS CNT');
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
                $round_complete = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->rounds->tbl_name, $where, $where_date,'','','','', '*', $this->rounds->START_DATE, 'desc','10',$limit_val*10);
            }
            else
            {
                $round_complete = $this->basemodel->fetch_records_from_multi_where($this->rounds->tbl_name, $where, $where_date, '*', $this->rounds->START_DATE, 'desc');
            }

            //return $this->db->last_query();
            //$data['qry'] = $this->db->last_query();
            if (!empty($round_complete))
            {
                for ($i = 0; $i < count($round_complete); $i++)
                {
                    $round_complete[$i]['Username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $round_complete[$i][$this->rounds->USERNAME]));
                    $round_complete[$i]['Designation'] = $this->basemodel->get_single_column_value($this->roles->tbl_name, $this->roles->ROLE_NAME, array($this->roles->ROLE_CODE => $round_complete[$i][$this->rounds->DESG]));
                    $round_complete[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE=> $round_complete[$i][$this->rounds->DEPT_ID]));
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $round_complete;
            }
            else {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }

    /*private function _assign_round($jodata = array())
     {
          $data = array();
          if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
          {
              $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
              $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
              $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
              $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

              $depts =(array_values($jodata->depts));
              for($i=0;$i<count($depts);$i++)
              {
                  $insert_roundassign[$this->rounds_assigned->ORG_ID] = $org_id;
                  $insert_roundassign[$this->rounds_assigned->BRANCH_ID] = $branch_id;
                  $insert_roundassign[$this->rounds_assigned->DEPT_ID]= $depts[$i];
                  $insert_roundassign[$this->rounds_assigned->ASSIGNED_TO] = $jodata->assign_to;
                  $insert_roundassign[$this->rounds_assigned->ASSIGNED_BY] = $user_id;
                  if(isset($jodata->remarks))
                      $insert_roundassign[$this->rounds_assigned->REMARKS] = $jodata->remarks;
                  if(isset($jodata->assignfrom) && $jodata->assignfrom!="" && $jodata->assignfrom!=null)
                      $insert_roundassign[$this->rounds_assigned->ASSIGNED_FROM] = $jodata->assignfrom;
                  if(isset($jodata->current_date) && $jodata->current_date!="" && $jodata->current_date!=null)
                      $insert_roundassign[$this->rounds_assigned->ROUND_DATE] = date('Y-m-d',strtotime($jodata->current_date));
                  else
                      $insert_roundassign[$this->rounds_assigned->ROUND_DATE] = date('Y-m-d');
                  if($role_code==HBHOD)
                      $insert_roundassign[$this->rounds_assigned->STATUS] = $jodata->status;
                 //  return $insert_roundassign;

                 if ($this->basemodel->insert_into_table($this->rounds_assigned->tbl_name, $insert_roundassign)) {
                     $notif_depts[] = $depts[$i];
                     $data['response'] = SUCCESSDATA;
                     $data['call_back'] = "Rounds Assigned Successfully";
                 }

                 else {
                     $data['response'] = FAILEDATA;
                     $data['call_back'] = "Unable to Assigned Rounds please try again";
                 }
             }
             $depts_all = implode(",",$notif_depts);
             $assign_by = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $insert_roundassign[$this->rounds_assigned->ASSIGNED_BY]));
             $assign_to = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $insert_roundassign[$this->rounds_assigned->ASSIGNED_TO]));
             $notification = "Following Rounds(Departments) " . $depts_all." Assigned to ".$assign_to." By ".$assign_by;
             $data['notification'] = $this->baselibrary->send_notification($org_id, $branch_id, $notification, '', $insert_roundassign[$this->rounds_assigned->ASSIGNED_TO]);

         }
         return $data;
     }*/

    private function _assign_round($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

            $depts =(array_values($jodata->depts));
            for($i=0;$i<count($depts);$i++)
            {
                $insert_roundassign[$this->rounds_assigned->ORG_ID] = $org_id;
                $insert_roundassign[$this->rounds_assigned->BRANCH_ID] = $branch_id;
                $insert_roundassign[$this->rounds_assigned->DEPT_ID]= $depts[$i];
                $insert_roundassign[$this->rounds_assigned->ASSIGNED_TO] = $jodata->assign_to;
                $insert_roundassign[$this->rounds_assigned->ASSIGNED_BY] = $user_id;
                if(isset($jodata->remarks))
                    $insert_roundassign[$this->rounds_assigned->REMARKS] = $jodata->remarks;
                if(isset($jodata->assignfrom) && $jodata->assignfrom!="" && $jodata->assignfrom!=null)
                    $insert_roundassign[$this->rounds_assigned->ASSIGNED_FROM] = $jodata->assignfrom;
                if(isset($jodata->current_date) && $jodata->current_date!="" && $jodata->current_date!=null)
                    $insert_roundassign[$this->rounds_assigned->ROUND_DATE] = date('Y-m-d',strtotime($jodata->current_date));
                else
                    $insert_roundassign[$this->rounds_assigned->ROUND_DATE] = date('Y-m-d');
                if($role_code==HBHOD)
                    $insert_roundassign[$this->rounds_assigned->STATUS] = $jodata->status;

                // return $insert_roundassign;
                if ($this->basemodel->insert_into_table($this->rounds_assigned->tbl_name, $insert_roundassign)) {
                    $notif_depts[] = $depts[$i];
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Rounds Assigned Successfully";
                }

                else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable to Assigned Rounds please try again";
                }
            }
            $depts_all = implode(",",$notif_depts);
            $assign_by = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $insert_roundassign[$this->rounds_assigned->ASSIGNED_BY]));
            $assign_to = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $insert_roundassign[$this->rounds_assigned->ASSIGNED_TO]));
            $notification = "Following Rounds(Departments) " . $depts_all." Assigned to ".$assign_to." By ".$assign_by;
            $data['notification'] = $this->baselibrary->send_notification($org_id, $branch_id, $notification, '', $insert_roundassign[$this->rounds_assigned->ASSIGNED_TO]);

        }
        return $data;
    }

    private function assign_round_shedule($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

            $depts =(array_values($jodata->depts));
            for($i=0;$i<count($depts);$i++)
            {
                $insert_roundassign[$this->rounds_assigned->ORG_ID] = $org_id;
                $insert_roundassign[$this->rounds_assigned->BRANCH_ID] = $branch_id;
                $insert_roundassign[$this->rounds_assigned->DEPT_ID]= $depts[$i];
                $insert_roundassign[$this->rounds_assigned->ASSIGNED_TO] = $jodata->assign_to;
                $insert_roundassign[$this->rounds_assigned->ASSIGNED_BY] = $user_id;
                if(isset($jodata->remarks))
                    $insert_roundassign[$this->rounds_assigned->REMARKS] = $jodata->remarks;
                if(isset($jodata->assignfrom) && $jodata->assignfrom!="" && $jodata->assignfrom!=null)
                    $insert_roundassign[$this->rounds_assigned->ASSIGNED_FROM] = $jodata->assignfrom;
                if(isset($jodata->current_date) && $jodata->current_date!="" && $jodata->current_date!=null)
                    $insert_roundassign[$this->rounds_assigned->ROUND_DATE] = date('Y-m-d',strtotime($jodata->current_date));
                else
                    $insert_roundassign[$this->rounds_assigned->ROUND_DATE] = date('Y-m-d');
                if($role_code==HBHOD)
                    $insert_roundassign[$this->rounds_assigned->STATUS] = $jodata->status;
                //$insert_roundassign[$this->rounds_assigned->ROUND_DATE] = date('Y-m-d', strtotime($jodata->current_date));

                if ($this->basemodel->insert_into_table($this->rounds_assigned->tbl_name, $insert_roundassign)) {
                    $notif_depts[] = $depts[$i];
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Rounds Assigned Successfully";
                }
                else {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable to Assigned Rounds please try again";
                }
            }
            $depts_all = implode(",",$notif_depts);
            $assign_by = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $insert_roundassign[$this->rounds_assigned->ASSIGNED_BY]));
            $assign_to = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $insert_roundassign[$this->rounds_assigned->ASSIGNED_TO]));
            $notification = "Following Rounds(Departments) " . $depts_all." Assigned to ".$assign_to." By ".$assign_by;
            $data['notification'] = $this->baselibrary->send_notification($org_id, $branch_id, $notification, '', $insert_roundassign[$this->rounds_assigned->ASSIGNED_TO]);

        }
        return $data;
    }


    private function _re_assign_round($jodata=array())
    {
        $data=array();
        if(!empty($jodata))
        {
            //print_r($jodata);
            $role_code = isset($jodata->user_role_code) ? $jodata->user_role_code : $this->session->role_code;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $rid = $jodata->ID;
            $round_data = $this->basemodel->fetch_single_row($this->rounds_assigned->tbl_name,array($this->rounds_assigned->ID=>$rid));
            if(!empty($round_data))
            {
                $iround[$this->rounds_assigned->ORG_ID] = $round_data[$this->rounds_assigned->ORG_ID];
                $iround[$this->rounds_assigned->BRANCH_ID] = $round_data[$this->rounds_assigned->BRANCH_ID];
                $iround[$this->rounds_assigned->DEPT_ID] = $round_data[$this->rounds_assigned->DEPT_ID];
                $iround[$this->rounds_assigned->ASSIGNED_BY] = $user_id;
                $iround[$this->rounds_assigned->ASSIGNED_TO] = $jodata->assigning_to;
                $iround[$this->rounds_assigned->ROUND_DATE] = $round_data[$this->rounds_assigned->ROUND_DATE];
                $iround[$this->rounds_assigned->ASSIGNED_FROM] = $round_data[$this->rounds_assigned->ASSIGNED_TO];
                $iround[$this->rounds_assigned->ADDED_ON] = date('Y-m-d H:i:s');
                if( $round_data[$this->rounds_assigned->STATUS]==TEMPORARY)
                {
                    $uround[$this->rounds_assigned->REMARKS] = 're assigned to other';
                }
                $iround[$this->rounds_assigned->ADDED_ON] = date('Y-m-d H:i:s');
                $iround[$this->rounds_assigned->STATUS] = TEMPORARY;

                $uround[$this->rounds_assigned->COMPLETED_ON] = date('Y-m-d');
                $wround[$this->rounds_assigned->ID] = $round_data[$this->rounds_assigned->ID];
                if($this->basemodel->update_operation($uround,$this->rounds_assigned->tbl_name,$wround))
                {
                    if($this->basemodel->insert_into_table($this->rounds_assigned->tbl_name,$iround))
                    {
                        $assign_by = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $iround[$this->rounds_assigned->ASSIGNED_BY]));
                        $assign_to = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $iround[$this->rounds_assigned->ASSIGNED_TO]));
                        $notification = "Following Rounds(Departments) " . $iround[$this->rounds_assigned->DEPT_ID]." Assigned to ".$assign_to." By ".$assign_by;
                        $data['notification'] = $this->baselibrary->send_notification($iround[$this->rounds_assigned->ORG_ID], $iround[$this->rounds_assigned->BRANCH_ID], $notification, '', $iround[$this->rounds_assigned->ASSIGNED_TO]);
                        $data['response'] = SUCCESSDATA;
                        $data['call_back'] = "Round Assigned Successfully";
                    }
                    else
                    {
                        $data['response'] = FAILEDATA;
                        $data['call_back'] = "Unable to assign Round, please try again";
                    }
                }
                else
                {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Unable to assign Round, please try again...";
                }
            }
        }
        return $data;
    }

    private function _get_equipment($jodata = array())
    {

        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $where[$this->devices->E_ID] = isset($jodata->e_id) ? $jodata->e_id : $this->session->e_id;
            $select = array($this->devices->E_NAME, $this->devices->E_ID, $this->devices->E_TYPE);
            $data = $this->basemodel->fetch_single_row($this->devices->tbl_name, $where, $select);

            //$data['qry'] = $this->db->last_query();
            if (!empty($data)) {
                $data['response'] = SUCCESSDATA;
                $data['devices'] = $data;
            } else {
                $data['response'] = EMPTYDATA;
            }

        }
        return $data;
    }

    private function _get_assigned_round($jodata = array())
    {

        $j = 0;
        $rounds_statred = NOSTATE;
        $data = array();
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
        $where[$this->rounds_assigned->ORG_ID] = $org_id;

        //if(isset($jodata->request_from) && $jodata->request_from=="app" && $role_code==HBHOD)
        if($role_code==HBHOD)
            $where[$this->rounds_assigned->ASSIGNED_TO." !="] = NULL;
        else
            $where[$this->rounds_assigned->ASSIGNED_TO] = $user_id;

        $where[$this->rounds_assigned->ROUND_DATE] = date('Y-m-d');

        $or_where = "(" . $this->rounds_assigned->COMPLETED_ON . " IS NULL OR " . $this->rounds_assigned->COMPLETED_ON . " != '" . date('Y-m-d') . "' OR " . $this->rounds_assigned->COMPLETED_ON . " = '" . STARTED . "' ) ";

        if($branch_id == 'All')
            $or_where .= " AND ".$this->rounds_assigned->BRANCH_ID." IN ". BRANCHALL;
        else
            $where[$this->rounds_assigned->BRANCH_ID] = $branch_id;

        if(isset($jodata->limit_val))
        {
            if($jodata->limit_val!='')
                $limit_val = $jodata->limit_val;
            else
                $limit_val = 0;
            $cnt = $this->basemodel->fetch_records_from_multi_where($this->rounds_assigned->tbl_name, $where, $or_where, 'count('.$this->rounds_assigned->ID.') AS CNT');

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
            $round_assignd = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->rounds_assigned->tbl_name, $where, $or_where,'','','','', '*', $this->rounds_assigned->ROUND_DATE, 'desc','10',$limit_val*10);
        }
        else
        {
            $round_assignd = $this->basemodel->fetch_records_from_multi_where($this->rounds_assigned->tbl_name, $where,$or_where, '*', $this->rounds_assigned->ROUND_DATE, 'desc');
        }
        //return $this->db->last_query();
        if (!empty($round_assignd)) {
            $today = strtotime(date('Y-m-d'));
            for ($i = 0; $i < count($round_assignd); $i++)
            {
                if($role_code==HBHOD)
                {
                    if($round_assignd[$i][$this->rounds_assigned->ASSIGNED_TO]==$user_id)
                    {
                        $round_assignd[$i]["my_call"] = YESSTATE;
                    }
                    else
                    {
                        $round_assignd[$i]["my_call"] = NOSTATE;
                    }
                }
                $round_assignd[$i]['departs'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $round_assignd[$i][$this->rounds_assigned->DEPT_ID]));


                if($round_assignd[$i][$this->rounds_assigned->ASSIGNED_FROM] == null) {
                    $round_assignd[$i]['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $round_assignd[$i][$this->rounds_assigned->ASSIGNED_BY]));
                }
                else if($round_assignd[$i][$this->rounds_assigned->ASSIGNED_BY] == null)
                {
                    $round_assignd[$i]['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $round_assignd[$i][$this->rounds_assigned->ASSIGNED_FROM]));
                }


                $round_assignd[$i]['assigned_to'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $round_assignd[$i][$this->rounds_assigned->ASSIGNED_TO]));

                if ($round_assignd[$i][$this->rounds_assigned->STATUS] == TEMPORARY && strtotime($round_assignd[$i][$this->rounds_assigned->ROUND_DATE]) < $today)
                {
                    $round_assignd[$i]['exp'] = YESSTATE;
                    $j++;
                    unset($round_assignd[$i]);
                    $round_assignd = array_values($round_assignd);
                    $i = ($i == 0) ? 0 : ($i - 1);
                }
                else
                {
                    $round_assignd[$i]['exp'] = NOSTATE;

                    if ($round_assignd[$i][$this->rounds_assigned->COMPLETED_ON] == STARTED)
                    {
                        $round_where[$this->rounds->USERNAME] = $user_id;
                        $round_where[$this->rounds->DEPT_ID] = $round_assignd[$i][$this->rounds_assigned->DEPT_ID];
                        $round_where[$this->rounds->START_DATE] = date('Y-m-d');
                        $round_where[$this->rounds->END_TIME] = NULL;
                        $round_assignd[$i]['scolor'] = "#87A82F";
                        $round_assignd[$i]['sround'] = STARTED;
                        $rounds_statred = YESSTATE;
                        $round_assignd[$i]['rid'] = $this->basemodel->get_single_column_value($this->rounds->tbl_name,$this->rounds->ID,$round_where);
                    }
                    else
                    {
                        $round_assignd[$i]['sround'] = "";
                        $round_assignd[$i]['color'] = "#41BDB0";
                        $round_assignd[$i]['rid'] = NOSTATE;
                    }
                }

            }

            $round_assignd2 = array_values($round_assignd);
            $data['response'] = SUCCESSDATA;
            $data['rounds_started'] = $rounds_statred;
            $data['list'] = $round_assignd2;
            $data['expired'] = 0;
            $data['all_expired'] = NOSTATE;
        } else {
            $data['response'] = EMPTYDATA;
        }

        return $data;
    }

    private function _get_all_equipments_of_org_branch($jodata=array())
    {
        $data = array();
        if (!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;

            $where[$this->devices->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            if($branch_id !='All')
            {
                $where[$this->devices->BRANCH_ID] = $branch_id;
            }
            else
            {
                $or_where = $this->devices->BRANCH_ID . " IN " .BRANCHALL;
            }
            if(isset($jodata->dept_id) && $jodata->dept_id!="" && $jodata->dept_id!=NULL)
            {
                $where[$this->devices->DEPT_ID] = $jodata->dept_id;
            }
            if(isset($jodata->device_search_key) && $jodata->device_search_key!="")
            {
                $data['devices'] = $this->basemodel->fetch_records_from_multi_where_like($this->devices->tbl_name,$where,$or_where,array($this->devices->E_ID=>strtoupper($jodata->device_search_key)),array($this->devices->E_ID,$this->devices->E_NAME),$this->devices->E_ID);
            }
            else
            {
                $data['devices'] = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$where,$or_where,array($this->devices->E_ID,$this->devices->E_NAME),$this->devices->E_ID);
            }

            // return $this->db->last_query();
            //$data['qry'] = $this->db->last_query();
            if(!empty($data['devices']))
                $data['response'] = SUCCESSDATA;
            else
                $data['response'] = EMPTYDATA;
        }
        return $data;
    }
    private function _get_call_counts($jodata)
    {
        $data = array();
        if (!empty($jodata))
        {
            $where[$this->cms->TO_ADVERSE] = NULL;
            $where[$this->cms->ORG_ID] = $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

            $cm_qry = $cn_qry = $t_orwhere = $pms_qry = $cmpms_qry = $cmqc_qry = $qc_qry = $ai_qry = $rl_qry = $rounds_qry = $cround_qry = '';

            if ($branch_id == 'All') {
                $cm_qry = $this->cms->BRANCH_ID . " IN " . BRANCHALL;
                $cn_qry = $this->condemnation->BRANCH_ID . " IN " . BRANCHALL;
                $t_orwhere = "(" . $this->transfer->BRANCH_ID . " IN " . BRANCHALL . " OR " . $this->transfer->TRANSFER_BRANCH . " IN " . BRANCHALL . " )";
                $pms_qry = $this->pmsdetails->BRANCH_ID . " IN " . BRANCHALL;
                $cmpms_qry = $this->pmsdetails->BRANCH_ID . " IN " . BRANCHALL;
                $cmqc_qry = $this->qcdetails->BRANCH_ID . " IN " . BRANCHALL;
                $qc_qry = $this->qcdetails->BRANCH_ID . " IN " . BRANCHALL;
                $ai_qry = $this->incedents->BRANCH_ID . " IN " . BRANCHALL;
                $rl_qry = $this->rounds_assigned->BRANCH_ID . " IN " . BRANCHALL;
                $rounds_qry = $this->rounds_assigned->BRANCH_ID . " IN " . BRANCHALL;
                $cround_qry = $this->rounds_assigned->BRANCH_ID . " IN " . BRANCHALL;
            } else {
                $where[$this->cms->BRANCH_ID] = $branch_id;
                $cn_where[$this->condemnation->BRANCH_ID] = $branch_id;
                $t_orwhere = "(" . $this->transfer->BRANCH_ID . "='" . $branch_id . "' OR " . $this->transfer->TRANSFER_BRANCH . "='" . $branch_id . "')";
                $pmswhere[$this->pmsdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $cmpms_where[$this->pmsdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $cmqcwhere[$this->qcdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $qcwhere[$this->qcdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $aiwhere[$this->incedents->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $rlwhere[$this->rounds_assigned->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $round_where[$this->rounds_assigned->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $cround_where[$this->rounds->BRANCH_ID] = $branch_id;
            }

            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->cms->STATUS . " !="] = DW;
            $where[$this->cms->RESPONDED_BY] = NULL;

            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }

            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            $swhere[$this->devices->ASSIGN_ID. "!="] = '';
            $devices = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$swhere ,$orr_where, array($this->devices->E_ID, $this->devices->ORG_ID, $this->devices->BRANCH_ID,$this->devices->ASSIGN_ID));

            $today_calls = array();
            for($i = 0; $i < count($devices); $i++) {

                $rrwhere[$this->cms->STATUS . "!="] = DW;
                $rrwhere[$this->cms->RESPONDED_BY] = NULL;
                $rrwhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];

                $today = $this->basemodel->num_of_res($this->cms->tbl_name, $rrwhere);
                if(!empty($today))
                {
                    array_push($today_calls,$today);
                }

            }
            $count_today = count($today_calls);
            $calls_today  = $this->basemodel->num_of_res($this->cms->tbl_name, $where, $cm_qry);
            $data['today_calls_cnt'] = $calls_today+$count_today;

            unset($where[$this->cms->RESPONDED_BY]);
            if($role_code==HBBME || (isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
            {
                $where[$this->cms->RESPONDED_BY] = $user_id;
            }
            unset($where[$this->cms->STATUS . " !="]);
            $where[$this->cms->STATUS] = DNW;
            $where[$this->cms->ASSIGNED_TO] = NULL;
            $where[$this->cms->ATTENDED_BY] = NULL;
            $where[$this->cms->RESPONDED_DATE." !="] = NULL;



            $count_respond = array();

            for($i = 0; $i < count($devices); $i++) {

                $bwhere[$this->cms->STATUS] = DNW;
                $bwhere[$this->cms->ATTENDED_BY] = NULL;
                $bwhere[$this->cms->RESPONDED_BY . "!="] = NULL;
                $bwhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];

                $cdata = $this->basemodel->num_of_res($this->cms->tbl_name,$bwhere);

                if(!empty($cdata)) {
                    array_push($count_respond,$cdata);

                }

            }
            $respond_count =   count($count_respond);


            $cdata1 = $this->basemodel->num_of_res($this->cms->tbl_name, $where, $cm_qry);

            $data['responded_calls_cnt1'] = $cdata1+$respond_count;


            unset($where[$this->cms->ASSIGNED_TO]);
            if($role_code==HBBME || (isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
            {
                $where[$this->cms->ASSIGNED_TO] = $user_id;
            }
            unset($where[$this->cms->RESPONDED_BY]);
            $where[$this->cms->ASSIGNED_TO." !="] = NULL;

            $assign_call = array();
            for($i = 0; $i < count($devices); $i++) {

                $qwhere[$this->cms->STATUS] = DNW;
                $qwhere[$this->cms->ASSIGNED_TO . "!="] = NULL;
                $qwhere[$this->cms->ATTENDED_BY] = NULL;
                $qwhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];

                $cdata2 =  $this->basemodel->num_of_res($this->cms->tbl_name,$qwhere);

                if(!empty($cdata2))
                {
                    array_push($assign_call,$cdata2);
                }


            }

            $assing_calls = count($assign_call);
            $cdata3 = $this->basemodel->num_of_res($this->cms->tbl_name,$where,$cm_qry);


            $data['assigned_calls_cnt1'] = $cdata3+$assing_calls;


            $data['responded_calls_cnt'] = $data['responded_calls_cnt1']+$data['assigned_calls_cnt1'];


            unset($where[$this->cms->ASSIGNED_TO]);
            unset($where[$this->cms->ATTENDED_BY]);
            unset($where[$this->cms->ASSIGNED_TO." !="]);
            unset($data['assigned_calls_cnt']);
            if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
            {
                unset($where[$this->cms->ATTENDED_DATE]);
                unset($where[$this->cms->RESPONDED_BY]);
                $where[$this->cms->ATTENDED_BY] = $user_id;
            }
            unset($where[$this->cms->RESPONDED_DATE]);
            unset($where[$this->cms->RESPONDED_DATE." !="]);
            $where[$this->cms->ATTENDED_DATE." !="] = NULL;
            $where[$this->cms->PENDING_REASON] = NULL;
            $count_attend = array();
            for($i = 0; $i < count($devices); $i++) {

                $twhere[$this->cms->STATUS] = DNW;
                $twhere[$this->cms->ATTENDED_BY . "!="] = NULL;
                $twhere[$this->cms->PENDING_REASON] = NULL;
                $twhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];

                $cdata5  = $this->basemodel->num_of_res($this->cms->tbl_name,$twhere);
                if(!empty($cdata5))
                {
                    array_push($count_attend,$cdata5);
                }

            }
            $attend_count = count($count_attend);
            $cdata6  = $this->basemodel->num_of_res($this->cms->tbl_name,$where,$cm_qry);

            $data['attended_calls_cnt'] = $cdata6+$attend_count;

            unset($where[$this->cms->PENDING_REASON]);
            unset($where[$this->cms->ATTENDED_DATE." !="]);
            $where[$this->cms->STATUS] = UMAINTENCE;
            $where[$this->cms->PENDING_REASON." !="] = NULL;
            $pending = array();
            for($i = 0; $i < count($devices); $i++) {

                $wwwwhere[$this->cms->STATUS] = UMAINTENCE;

                $wwwwhere[$this->cms->PENDING_REASON."!="] = NULL;
                $wwwwhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];

                $cdata8  = $this->basemodel->num_of_res($this->cms->tbl_name,$wwwwhere);
                if(!empty($cdata8))
                {
                    array_push($pending,$cdata8);
                }

            }
            $pending_array = count($pending);


            $cdata9 = $this->basemodel->num_of_res($this->cms->tbl_name,$where,$cm_qry);

            $data['pending_calls_cnt'] = $cdata9+$pending_array;

            unset($where[$this->cms->STATUS." !="]);
            unset($where[$this->cms->PENDING_REASON." !="]);
            $where[$this->cms->STATUS] = DW;
            $where[$this->cms->JOBCOMPLETED_DATE] = date('Y-m-d');

            $ns_calls = array();
            for($i = 0; $i < count($devices); $i++) {

                $wqwhere[$this->cms->STATUS] = DW;
                $wqwhere[$this->cms->JOBCOMPLETED_DATE] = date('Y-m-d');
                $wqwhere[$this->cms->EID] = $devices[$i]['ASSIGN_ID'];

                $cdata10  = $this->basemodel->num_of_res($this->cms->tbl_name,$wqwhere);
                if(!empty($cdata10))
                {
                    array_push($ns_calls,$cdata10);
                }

            }
            $ns_calls_count = count($ns_calls);

            $cdata11 =  $this->basemodel->num_of_res($this->cms->tbl_name,$where,$cm_qry);

            $data['ns_calls_cnt'] = $ns_calls_count+$cdata11;

            $pmswhere[$this->pmsdetails->ORG_ID] = $where[$this->cms->ORG_ID];
            $pmswhere[$this->pmsdetails->COMPLETED_BY] =  NULL;
            $pmswhere_like[$this->pmsdetails->PMS_DUE_DATE] =  date('Y-m');
            $pms_or_where = "";
            if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
            {
                if(isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
                {
                    $pmswhere[$this->pmsdetails->PMS_ASSIGNED_TO] =  $user_id;
                }
                else
                {
                    $pms_or_where = "(" . $this->pmsdetails->PMS_ASSIGNED_TO . " IS NULL OR " . $this->pmsdetails->PMS_ASSIGNED_TO . "='" . $user_id . "')";
                    if($branch_id == 'All')
                        $pms_or_where .= ' AND '.$pms_qry;
                }
                $cmpms_where[$this->pmsdetails->COMPLETED_BY] =  $user_id;
            }

            $pending_pms = array();

            for($i = 0; $i < count($devices); $i++) {

                $cmpwhere[$this->pmsdetails->PMS_DUE_DATE] =date('Y-m');
                $cmpwhere[$this->pmsdetails->COMPLETED_BY] = NULL;
                $cmpwhere[$this->pmsdetails->EID] = $devices[$i]['ASSIGN_ID'];

                $pms_assign  = $this->basemodel->num_of_res($this->pmsdetails->tbl_name,$cmpwhere);
                if(!empty($pms_assign))
                {
                    array_push($pending_pms,$pms_assign);
                }

            }
            $pending_count = count($pending_pms);
            $pend_count = $this->basemodel->num_of_res($this->pmsdetails->tbl_name, $pmswhere, $pms_or_where  ,'','',$pmswhere_like);
            //return $this->db->last_query();
            $data['pending_pms'] = $pending_count+$pend_count;

            $cmpms_where[$this->pmsdetails->ORG_ID] = $where[$this->cms->ORG_ID];
            $cmpms_where[$this->pmsdetails->COMPLETED_BY." !="] =  NULL;
            $cmpms_where[$this->pmsdetails->PMS_ACTL_DONE] =  date('Y-m-d');
            $completed_pms = array();
            for($i = 0; $i < count($devices); $i++) {

                $cmpcomwhere[$this->pmsdetails->PMS_DUE_DATE] =date('Y-m');
                $cmpcomwhere[$this->pmsdetails->COMPLETED_BY."!="] = NULL;
                $cmpcomwhere[$this->pmsdetails->EID] = $devices[$i]['ASSIGN_ID'];

                $pms_complete  = $this->basemodel->num_of_res($this->pmsdetails->tbl_name,$cmpcomwhere);
                if(!empty($pms_complete))
                {
                    array_push($completed_pms,$pms_complete);
                }

            }

            $complete_pmms = count($completed_pms);
            $completed_pms_cal  = $this->basemodel->num_of_res($this->pmsdetails->tbl_name,$cmpms_where,$cmpms_qry);
            $data['completed_pms'] = $complete_pmms+$completed_pms_cal;


            /*pending qc*/
            $qcwhere[$this->qcdetails->ORG_ID] =  $where[$this->cms->ORG_ID];
            $qcwhere_like[$this->qcdetails->QC_DUE] =  date('Y-m');
            $qcwhere[$this->qcdetails->COMPLETED_BY] =  NULL;
            $qc_or_where = "";
            if($role_code==HBBME || (isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
            {
                if(isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
                {
                    $qcwhere[$this->qcdetails->ASSIGNED_TO] =  $user_id;
                }
                else
                {
                    $qc_or_where = "(" . $this->qcdetails->ASSIGNED_TO . " IS NULL OR " . $this->qcdetails->ASSIGNED_TO . "='" . $user_id . "')";
                    if($branch_id == 'All')
                        $qc_or_where .= ' AND '.$qc_qry;
                }
                $cmqcwhere[$this->qcdetails->COMPLETED_BY] =  $user_id;
            }
            $pending_qc = array();
            for($i = 0; $i < count($devices); $i++) {

                $qcpwhere[$this->qcdetails->QC_DUE] =date('Y-m');
                $qcpwhere[$this->qcdetails->COMPLETED_BY] = NULL;
                $qcpwhere[$this->qcdetails->EID] = $devices[$i]['ASSIGN_ID'];

                $qc_pending  = $this->basemodel->num_of_res($this->qcdetails->tbl_name,$qcpwhere);
                if(!empty($qc_pending))
                {
                    array_push($pending_qc,$qc_pending);
                }

            }

            $pending_qcc = count($pending_qc);
            $pending_qcp =    $this->basemodel->num_of_res($this->qcdetails->tbl_name, $qcwhere,$qc_or_where ,'','',$qcwhere_like);
            $data['pending_qc'] = $pending_qcc+$pending_qcp;

            $cmqcwhere[$this->qcdetails->ORG_ID] = $where[$this->cms->ORG_ID];
            $cmqcwhere[$this->qcdetails->COMPLETED_BY." !="] =  NULL;
            $cmqcwhere[$this->qcdetails->QC_ACTL_DONE] =  date('Y-m-d');
            $com_qc = array();
            for($i = 0; $i < count($devices); $i++) {

                $qccwhere[$this->qcdetails->QC_ACTL_DONE] =date('Y-m');
                $qccwhere[$this->qcdetails->COMPLETED_BY."!="] = NULL;
                $qccwhere[$this->qcdetails->EID] = $devices[$i]['ASSIGN_ID'];

                $qc_com  = $this->basemodel->num_of_res($this->qcdetails->tbl_name,$qccwhere);
                if(!empty($qc_com))
                {
                    array_push($com_qc,$qc_com);
                }

            }
            $comqcc = count($com_qc);
            $comqccc = $this->basemodel->num_of_res($this->qcdetails->tbl_name,$cmqcwhere,$cmqc_qry);
            $data['completed_qcs'] = $comqcc+$comqccc;

            $round_where[$this->rounds_assigned->ORG_ID] = $org_id;
            $round_where[$this->rounds_assigned->ASSIGNED_TO] = $user_id;
            $data['rounds_cnt'] = $this->basemodel->num_of_res($this->rounds_assigned->tbl_name, $round_where,$rounds_qry,'');

            $cround_where[$this->rounds->ORG_ID] = $org_id;
            $cround_where[$this->rounds->USERNAME] = $user_id;
            $cround_where[$this->rounds->START_DATE] = date('Y-m-d');
            $cround_where[$this->rounds->END_TIME." !="] = NULL;
            $data['completed_rounds_cnt'] = $this->basemodel->num_of_res($this->rounds->tbl_name, $cround_where,$cround_qry);

            /*  adverse incidents */
            $aiwhere[$this->incedents->ORG_ID] = $where[$this->cms->ORG_ID];
            $aiwhere[$this->incedents->ACTION_TACKEN] = NULL;
            $ai_or_where = '';
            if((isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
            {
                $aiwhere[$this->incedents->ASSIGNED_TO] =  $user_id;
            }
            else if($role_code==HBBME || $role_code==HBHOD)
            {
                $ai_or_where = "(" . $this->incedents->ASSIGNED_TO . " = '".$user_id."' OR " . $this->incedents->ASSIGNED_TO . " IS NULL)";
                if($branch_id == 'All')
                    $ai_or_where .= ' AND '.$ai_qry;
            }


            $adv_count = array();
            for($i = 0; $i < count($devices); $i++) {

                $advwhere[$this->incedents->ACTION_TACKEN] = NULL;
                $advwhere[$this->incedents->EQUP_ID] = $devices[$i]['ASSIGN_ID'];

                $advv_count  = $this->basemodel->num_of_res($this->incedents->tbl_name,$advwhere);

                if(!empty($advv_count))
                {
                    array_push($adv_count,$advv_count);
                }

            }
            $adv_counts = count($adv_count);

            $adv_counts_inc = $this->basemodel->num_of_res($this->incedents->tbl_name, $aiwhere,$ai_or_where);
            // return $this->db->last_query();
            //  return $this->db->last_query();
            $data['adverse_incidents_count'] = $adv_counts_inc+$adv_counts;
            //$data['aiq'] = $this->db->last_query();
            //  return $this->db->last_query();
            unset($aiwhere[$this->incedents->ACTION_TACKEN]);
            if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
            {
                $aiwhere[$this->incedents->COMPLETED_BY] =  $user_id;
            }
            $aiwhere[$this->incedents->ACTION_TACKEN." !="] = NULL;
            $ailike[$this->incedents->COMPLETED_ON] = date('Y-m-d');

            $adv_count_complete = array();
            for($i = 0; $i < count($devices); $i++) {

                $advwhere[$this->incedents->ACTION_TACKEN."!="] = NULL;
                $advwhere[$this->incedents->COMPLETED_ON] = date('Y-m-d');
                $advwhere[$this->incedents->EQUP_ID] = $devices[$i]['ASSIGN_ID'];

                $advv_count_complete  = $this->basemodel->num_of_res($this->incedents->tbl_name,$advwhere);
                if(!empty($advv_count_complete))
                {
                    array_push($adv_count_complete,$advv_count_complete);
                }

            }

            $adverse_count = count($adv_count_complete);
            $adverse_incident_count = $this->basemodel->num_of_res($this->incedents->tbl_name, $aiwhere,$ai_qry,'','',$ailike);

            $data['completed_adverse_calls'] =  $adverse_count+$adverse_incident_count;    //$data['adc_qry'] = $this->db->last_query();
            // return $data;

            /* rounds */
            $rounds = $this->_get_assigned_round($jodata);
            if($rounds['response']==SUCCESSDATA)
                $data['rounds_count'] = count($rounds['list']);
            else
                $data['rounds_count'] = 0;

            $uwhere[$this->transfer->ORG_ID] = $org_id;
            $uwhere[$this->transfer->DEPLOYMENT_ID] = NULL;
            $uwhere[$this->transfer->TRANSFER] = 'Other Unit';

            $transfer_count = array();
            for($i = 0; $i < count($devices); $i++) {

                $trnwhere[$this->transfer->DEPLOYMENT_ID] = NULL;
                $trnwhere[$this->transfer->TRANSFER] = 'Other Unit';
                $trnwhere[$this->transfer->EQUP_ID] = $devices[$i]['ASSIGN_ID'];

                $trn_count  = $this->basemodel->num_of_res($this->transfer->tbl_name,$trnwhere,$t_orwhere);
                if(!empty($trn_count))
                {
                    array_push($transfer_count,$trn_count);
                }

            }
            $trnfr_count = count($transfer_count);
            $transfer_counts = $this->basemodel->num_of_res($this->transfer->tbl_name, $uwhere,$t_orwhere);
            $data['transfers_cnt'] = $transfer_counts+$trnfr_count;
            unset($uwhere[$this->transfer->DEPLOYMENT_ID]);
            unset($uwhere[$this->transfer->TRANSFER]);
            $uwhere[$this->transfer->DEPLOYMENT_ID." !="] = NULL;
            $tclike[$this->transfer->UPDATED_ON] = date('Y-m-d');
            if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
            {
                $uwhere[$this->transfer->UPDATED_BY] = $user_id;
            }
            $tnss_count = array();
            for($i = 0; $i < count($devices); $i++) {

                $tnnwhere[$this->transfer->DEPLOYMENT_ID."!="] = NULL;
                $tnnwhere[$this->transfer->UPDATED_ON] = date('Y-m-d');
                $tnnwhere[$this->transfer->EQUP_ID] = $devices[$i]['ASSIGN_ID'];

                $tnr_count  = $this->basemodel->num_of_res($this->transfer->tbl_name,$tnnwhere);
                if(!empty($tnr_count))
                {
                    array_push($tnss_count,$tnr_count);
                }

            }
            $tnnn_cont =   count($tnss_count);
            $tnnnn_cont = $this->basemodel->num_of_res($this->transfer->tbl_name, $uwhere,$t_orwhere,'','',$tclike);

            $data['completed_condemnation_cnt'] = $tnnn_cont+$tnnnn_cont;
            $cn_where[$this->condemnation->ORG_ID] = $org_id;
            $cn_where[$this->condemnation->RESOLD_VALUE] = NULL;
            $cnd_count = array();
            for($i = 0; $i < count($devices); $i++) {

                $cnddwhere[$this->condemnation->RESOLD_VALUE] = NULL;
                $cnddwhere[$this->condemnation->EQUP_ID] = $devices[$i]['ASSIGN_ID'];

                $cndd_count  = $this->basemodel->num_of_res($this->condemnation->tbl_name,$cnddwhere);
                if(!empty($cndd_count))
                {
                    array_push($cnd_count,$cndd_count);
                }

            }
            $cndddd_count = count($cnd_count);
            $cnds_count = $this->basemodel->num_of_res($this->condemnation->tbl_name, $cn_where,$cn_qry);
            $data['condemnation_cnt'] = $cnds_count+$cndddd_count;
            unset($cn_where[$this->condemnation->RESOLD_VALUE]);
            $cn_where[$this->condemnation->RESOLD_VALUE." !="] = NULL;
            $cn_clike[$this->condemnation->UPDATED_ON] = date('Y-m-d');
            if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
            {
                $cn_where[$this->condemnation->UPDATED_BY] = $user_id;
            }

            $condemn_count = array();
            for($i = 0; $i < count($devices); $i++) {

                $cndwhere[$this->condemnation->RESOLD_VALUE. "!="] = NULL;
                $cndwhere[$this->condemnation->UPDATED_ON] = date('Y-m-d');
                $cndwhere[$this->condemnation->EQUP_ID] = $devices[$i]['ASSIGN_ID'];

                $condemns_count  = $this->basemodel->num_of_res($this->condemnation->tbl_name,$cndwhere);
                if(!empty($condemns_count))
                {
                    array_push($condemn_count,$condemns_count);
                }

            }

            $condemnt_count = count($condemn_count);
            $condemnts_count = $this->basemodel->num_of_res($this->condemnation->tbl_name, $cn_where,$cn_qry,'','',$cn_clike);


            $data['completed_condemnation_cnt'] =  $condemnts_count+$condemnt_count;
            $data['completed_calls_cnt'] = $data['completed_condemnation_cnt']+$data['completed_condemnation_cnt']+$data['completed_adverse_calls']+$data['completed_rounds_cnt']+$data['completed_qcs']+$data['completed_pms']+$data['ns_calls_cnt'];

            //$data['tickets_cnt'] = $data['adverse_incidents_count']+$data['attended_calls_cnt']+$data['completed_calls_cnt']+$data['pending_calls_cnt']+$data['pending_pms']+$data['pending_qc']+$data['responded_calls_cnt']+$data['rounds_count']+$data['today_calls_cnt']+$data['transfers_cnt']+$data['condemnation_cnt'];
            $data['tickets_cnt'] = $data['adverse_incidents_count']+$data['attended_calls_cnt']+$data['completed_calls_cnt']+$data['pending_calls_cnt']+$data['responded_calls_cnt']+$data['rounds_count']+$data['today_calls_cnt']+$data['transfers_cnt']+$data['condemnation_cnt'];

        }



        return $data;
    }
    private function _get_call_counts_org_admin($jodata)
    {
        $data = array();
        if (!empty($jodata))
        {
            $t_orwhere = '';
            $where[$this->cms->ORG_ID] = $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

            if($role_code!=HMADMIN)
            {
                $where[$this->cms->BRANCH_ID] = $branch_id;
                $cn_where[$this->condemnation->BRANCH_ID] = $branch_id;
                $t_orwhere = "(".$this->transfer->BRANCH_ID."='".$branch_id."' OR ". $this->transfer->TRANSFER_BRANCH."='".$branch_id."')";
                $pmswhere[$this->pmsdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $cmpms_where[$this->pmsdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $cmqcwhere[$this->qcdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $qcwhere[$this->qcdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $aiwhere[$this->incedents->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $rlwhere[$this->rounds_assigned->BRANCH_ID] = $branch_id;
            }

            $where[$this->cms->STATUS . " !="] = DW;
            $where[$this->cms->RESPONDED_BY] = NULL;

            $uitname = $this->basemodel->fetch_records_from($this->branches->tbl_name, array($this->branches->BRANCH_ID=>$branch_id),$this->branches->BRANCH_NAME);
            $data['branch_name'] = $uitname[0]['BRANCH_NAME'];
            $data['branch_id'] =  $branch_id;
            $data['ORG_ID'] = $where[$this->cms->ORG_ID];

            $data['today_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
            unset($where[$this->cms->RESPONDED_BY]);
            if($role_code==HBBME || (isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
            {
                $where[$this->cms->RESPONDED_BY] = $user_id;
            }
            unset($where[$this->cms->STATUS . " !="]);
            $where[$this->cms->STATUS] = DNW;
            $where[$this->cms->ATTENDED_BY] = NULL;
            $where[$this->cms->RESPONDED_DATE." !="] = NULL;
            $data['responded_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
            //$data['responded_callsqry'] = $this->db->last_query();
            if($role_code==HBBME || (isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
            {
                $where[$this->cms->ASSIGNED_TO] = $user_id;
            }
            unset($where[$this->cms->RESPONDED_BY]);
            $where[$this->cms->ASSIGNED_TO." !="] = NULL;
            $data['assigned_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
            //$data['assigned_calls_qry'] = $this->db->last_query();
            $data['responded_calls_cnt'] = $data['responded_calls_cnt']+$data['assigned_calls_cnt'];
            unset($where[$this->cms->ASSIGNED_TO]);
            unset($where[$this->cms->ATTENDED_BY]);
            unset($where[$this->cms->ASSIGNED_TO." !="]);
            unset($data['assigned_calls_cnt']);
            if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
            {
                unset($where[$this->cms->ATTENDED_DATE]);
                unset($where[$this->cms->RESPONDED_BY]);
                $where[$this->cms->ATTENDED_BY] = $user_id;
            }
            unset($where[$this->cms->RESPONDED_DATE]);
            unset($where[$this->cms->RESPONDED_DATE." !="]);
            $where[$this->cms->ATTENDED_DATE." !="] = NULL;
            $where[$this->cms->PENDING_REASON] = NULL;
            $data['attended_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
            //$data['attended_callsqry'] = $this->db->last_query();

            unset($where[$this->cms->PENDING_REASON]);
            unset($where[$this->cms->ATTENDED_DATE." !="]);
            $where[$this->cms->STATUS] = UMAINTENCE;
            $where[$this->cms->PENDING_REASON." !="] = NULL;
            $data['pending_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
            //$data['pending_callsqry'] = $this->db->last_query();

            unset($where[$this->cms->STATUS." !="]);
            unset($where[$this->cms->PENDING_REASON." !="]);
            $where[$this->cms->STATUS] = DW;
            $where[$this->cms->JOBCOMPLETED_DATE] = date('Y-m-d');
            $data['ns_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
            //$data['completed_callsqry'] = $this->db->last_query();

            /*pending pms*/
            $pmswhere[$this->pmsdetails->ORG_ID] = $where[$this->cms->ORG_ID];
            $pmswhere[$this->pmsdetails->COMPLETED_BY] =  NULL;
            //$pmswhere_like[$this->pmsdetails->PMS_DUE_DATE] =  date('Y-m');
            $pms_or_where = "";
            if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
            {
                if(isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
                {
                    $pmswhere[$this->pmsdetails->PMS_ASSIGNED_TO] =  $user_id;
                }
                else
                {
                    $pms_or_where = "(" . $this->pmsdetails->PMS_ASSIGNED_TO . " IS NULL OR " . $this->pmsdetails->PMS_ASSIGNED_TO . "='" . $user_id . "')";
                }
                $cmpms_where[$this->pmsdetails->COMPLETED_BY] =  $user_id;
            }
            $data['pending_pms'] = $this->basemodel->num_of_res($this->pmsdetails->tbl_name, $pmswhere, $pms_or_where,'','',$pmswhere_like);
            $cmpms_where[$this->pmsdetails->ORG_ID] = $where[$this->cms->ORG_ID];
            $cmpms_where[$this->pmsdetails->COMPLETED_BY." !="] =  NULL;
            $cmpms_where[$this->pmsdetails->PMS_ACTL_DONE] =  date('Y-m-d');
            $data['completed_pms'] = $this->basemodel->num_of_res($this->pmsdetails->tbl_name,$cmpms_where);
            /*pending qc*/
            $qcwhere[$this->qcdetails->ORG_ID] =  $where[$this->cms->ORG_ID];
            //$qcwhere_like[$this->qcdetails->QC_DUE] =  date('Y-m');
            $qcwhere[$this->qcdetails->COMPLETED_BY] =  NULL;
            $qc_or_where = "";
            if($role_code==HBBME || (isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
            {
                if(isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
                {
                    $qcwhere[$this->qcdetails->ASSIGNED_TO] =  $user_id;
                }
                else
                {
                    $qc_or_where = "(" . $this->qcdetails->ASSIGNED_TO . " IS NULL OR " . $this->qcdetails->ASSIGNED_TO . "='" . $user_id . "')";
                }
                $cmqcwhere[$this->qcdetails->COMPLETED_BY] =  $user_id;
            }
            $data['pending_qc'] = $this->basemodel->num_of_res($this->qcdetails->tbl_name, $qcwhere,$qc_or_where,'','',$qcwhere_like);
            //$data['qq_callsqry'] = $this->db->last_query();
            $cmqcwhere[$this->qcdetails->ORG_ID] = $where[$this->cms->ORG_ID];
            $cmqcwhere[$this->qcdetails->COMPLETED_BY." !="] =  NULL;
            $cmqcwhere[$this->qcdetails->QC_ACTL_DONE] =  date('Y-m-d');
            $data['completed_qcs'] = $this->basemodel->num_of_res($this->qcdetails->tbl_name,$cmqcwhere);

            $round_where[$this->rounds_assigned->ORG_ID] = $org_id;
            $round_where[$this->rounds_assigned->BRANCH_ID] = $branch_id;
            $round_where[$this->rounds_assigned->ASSIGNED_TO] = $user_id;
            $data['rounds_cnt'] = $this->basemodel->num_of_res($this->rounds_assigned->tbl_name, $round_where,'','');

            $cround_where[$this->rounds->ORG_ID] = $org_id;
            $cround_where[$this->rounds->BRANCH_ID] = $branch_id;
            $cround_where[$this->rounds->USERNAME] = $user_id;
            $cround_where[$this->rounds->START_DATE] = date('Y-m-d');
            $cround_where[$this->rounds->END_TIME." !="] = NULL;
            $data['completed_rounds_cnt'] = $this->basemodel->num_of_res($this->rounds->tbl_name, $cround_where);

            /*  adverse incidents */
            $aiwhere[$this->incedents->ORG_ID] = $where[$this->cms->ORG_ID];
            $aiwhere[$this->incedents->ACTION_TACKEN] = NULL;
            $ai_or_where = '';
            if((isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
            {
                $aiwhere[$this->incedents->ASSIGNED_TO] =  $user_id;
            }
            else if($role_code==HBBME)
            {
                $ai_or_where = "(" . $this->incedents->ASSIGNED_TO . " = '".$user_id."' OR " . $this->incedents->ASSIGNED_TO . " IS NULL)";
            }
            $data['adverse_incidents_count'] = $this->basemodel->num_of_res($this->incedents->tbl_name, $aiwhere,$ai_or_where);
            //$data['aiq'] = $this->db->last_query();

            unset($aiwhere[$this->incedents->ACTION_TACKEN]);
            if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
            {
                $aiwhere[$this->incedents->COMPLETED_BY] =  $user_id;
            }
            $aiwhere[$this->incedents->ACTION_TACKEN." !="] = NULL;
            $ailike[$this->incedents->COMPLETED_ON] = date('Y-m-d');
            $data['completed_adverse_calls'] = $this->basemodel->num_of_res($this->incedents->tbl_name, $aiwhere,'','','',$ailike);
            //$data['adc_qry'] = $this->db->last_query();

            /* rounds */
            $rounds = $this->_get_assigned_round($jodata);
            if($rounds['response']==SUCCESSDATA)
                $data['rounds_count'] = count($rounds['list']);
            else
                $data['rounds_count'] = 0;
            $twhere[$this->transfer->ORG_ID] = $org_id;
            $twhere[$this->transfer->DEPLOYMENT_ID] = NULL;
            $twhere[$this->transfer->TRANSFER] = 'Other Unit';
            $data['transfers_cnt'] = $this->basemodel->num_of_res($this->transfer->tbl_name, $twhere,$t_orwhere);

            unset($twhere[$this->transfer->DEPLOYMENT_ID]);
            unset($twhere[$this->transfer->TRANSFER]);
            $twhere[$this->transfer->DEPLOYMENT_ID." !="] = NULL;
            $tclike[$this->transfer->UPDATED_ON] = date('Y-m-d');
            if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
            {
                $twhere[$this->transfer->UPDATED_BY] = $user_id;
            }
            $data['completed_transfer_count'] = $this->basemodel->num_of_res($this->transfer->tbl_name, $twhere,$t_orwhere,'','',$tclike);

            $cn_where[$this->condemnation->ORG_ID] = $org_id;
            $cn_where[$this->condemnation->RESOLD_VALUE] = NULL;
            $data['condemnation_cnt'] = $this->basemodel->num_of_res($this->condemnation->tbl_name, $cn_where);
            unset($cn_where[$this->condemnation->RESOLD_VALUE]);
            $cn_where[$this->condemnation->RESOLD_VALUE." !="] = NULL;
            $cn_clike[$this->condemnation->UPDATED_ON] = date('Y-m-d');
            if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
            {
                $cn_where[$this->condemnation->UPDATED_BY] = $user_id;
            }
            $data['completed_condemnation_cnt'] = $this->basemodel->num_of_res($this->condemnation->tbl_name, $cn_where,'','','',$cn_clike);
            $data['completed_calls_cnt'] = $data['completed_condemnation_cnt']+$data['completed_transfer_count']+$data['completed_adverse_calls']+$data['completed_rounds_cnt']+$data['completed_qcs']+$data['completed_pms']+$data['ns_calls_cnt'];

            $data['tickets_cnt'] = $data['adverse_incidents_count']+$data['attended_calls_cnt']+$data['completed_calls_cnt']+$data['pending_calls_cnt']+$data['pending_pms']+$data['pending_qc']+$data['responded_calls_cnt']+$data['rounds_count']+$data['today_calls_cnt']+$data['transfers_cnt']+$data['condemnation_cnt'];
        }

        return $data;
    }

    public function _get_All_Unit_Counts($jodata=array())
    {
        $where = array();
        $list = array();
        $where[$this->branches->STATUS] = ACTIVESTS;
        $where[$this->branches->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

        if($jodata->branch_id == 'All') {
            $units = $this->basemodel->fetch_records_from($this->branches->tbl_name, $where);
            for ($i = 0; $i < count($units); $i++) {
                $jodata->branch_id = $units[$i]['BRANCH_ID'];
                $list[$i] = $this->_get_call_counts_org_admin($jodata);
            }
        }
        else
        {
            $list[0] = $this->_get_call_counts_org_admin($jodata);
        }

        if (!empty($list))
        {
            $data['response'] = SUCCESSDATA;
            $data['list'] = $list;
        } else {
            $data['response'] = EMPTYDATA;
            $data['list'] = null;
        }
        return $data;

    }

    /*Rounds Assigned*/
    private function _get_contracts_count($jodata=array())
    {
        $where_date = '';
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;

        $data = array();
        $where = array();
        if($role_code!=HMADMIN)
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->deviceamcs->BRANCH_ID] = $branch_id;
        }
        $where[$this->deviceamcs->ORG_ID] = $org_id;
        $where[$this->deviceamcs->STATUS] = OPEN;
        $expires = array(0,15,30,90,180,1);
        $main_data =array();
        for($i=0;$i<count($expires);$i++)
        {
            if($expires[$i]==0)
            {

            }
            else if($expires[$i]!=1 && $expires[$i]!=0)
            {
                $date = date("Y-m-d");
                $toDate = strtotime(date("Y-m-d", strtotime($date)) . " + ".$expires[$i]." days");
                $where_date = $this->deviceamcs->AMC_TO . " BETWEEN '" . date('Y-m-d') . "' AND '" . date('Y-m-d',$toDate) . "'";
            }
            else if($expires[$i]==1)
            {
                $where[$this->deviceamcs->AMC_TO." <="] = date('Y-m-d');
            }
            $cnt = $this->basemodel->fetch_records_from_multi_where($this->deviceamcs->tbl_name, $where, $where_date, 'count('.$this->deviceamcs->ID.') AS CNT');
            $data[] = $cnt[0]['CNT'];
            //unset($where_date[$this->deviceamcs->AMC_TO." <="]);
            $where_date = '';
        }
        for($i=0;$i<count($data);$i++)
        {
            if($expires[$i]==0)
            {
                $k = "all";
            }
            else if($expires[$i]==1)
            {
                $k = "expired";
            }
            else
            {
                $k = "d".$expires[$i];
            }
            $main_data[$k] = $data[$i];
        }
        return $main_data;
    }

    private function _add_maintaince_contracts($jodata=array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $insert_amc[$this->deviceamcs->BRANCH_ID]=$branch_id;
            $insert_amc[$this->deviceamcs->ORG_ID]=$org_id;
            $insert_amc[$this->deviceamcs->AMC_FROM] = date('Y-m-d', strtotime($jodata->contract_from_date));
            $insert_amc[$this->deviceamcs->AMC_TO] = date('Y-m-d', strtotime($jodata->contract_to_date));
            $insert_amc[$this->deviceamcs->AMC_TYPE] = $jodata->contract_type;
            $insert_amc[$this->deviceamcs->AMC_VALUE] = $jodata->contract_value;
            $insert_amc[$this->deviceamcs->AMC_VENDOR] = $jodata->vendor;
            $insert_amc[$this->deviceamcs->REMARKS] = $jodata->remarks;
            $insert_amc[$this->deviceamcs->EID] = $jodata->searchEid;
            $previous_contract = $this->basemodel->fetch_single_row($this->deviceamcs->tbl_name,array($this->deviceamcs->EID=>$jodata->searchEid),$this->deviceamcs->AMC_TO,$this->deviceamcs->AMC_TO,'DESC');
            //return $this->db->last_query();
            if(strtotime($previous_contract[$this->deviceamcs->AMC_TO])<strtotime($insert_amc[$this->deviceamcs->AMC_FROM]))
            {
                $this->basemodel->update_operation(array($this->deviceamcs->STATUS=>CLOSE),$this->deviceamcs->tbl_name,array($this->deviceamcs->EID=>$jodata->equp_id));
                if($this->basemodel->insert_into_table($this->deviceamcs->tbl_name,$insert_amc))
                {
                    $data['response'] = SUCCESSDATA;
                    $data['call_back'] = "Contract Added Successfully";
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
                $data['call_back'] = "Contract Not Completed, available up to ".$previous_contract[$this->deviceamcs->AMC_TO];
            }
        }
        return $data;
    }
    private function _insert_multi_contracts($jodata=array())
    {
        $data = array();
        if(!empty($jodata))
        {
            $j=$k=0;
            $equps = $jodata->equps;
            for($i=0;$i<count($equps);$i++)
            {
                $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
                $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
                $insert_amc[$this->deviceamcs->BRANCH_ID]=$branch_id;
                $insert_amc[$this->deviceamcs->ORG_ID]=$org_id;
                $insert_amc[$this->deviceamcs->AMC_FROM] = date('Y-m-d', strtotime      ($jodata->contract_from_date));
                $insert_amc[$this->deviceamcs->AMC_TO] = date('Y-m-d', strtotime    ($jodata->contract_to_date));
                $insert_amc[$this->deviceamcs->AMC_TYPE] = $jodata->contract_type;
                $insert_amc[$this->deviceamcs->AMC_VALUE] = $jodata->contract_value;
                $insert_amc[$this->deviceamcs->AMC_VENDOR] = $jodata->vendor;
                $insert_amc[$this->deviceamcs->REMARKS] = $jodata->remarks;
                $insert_amc[$this->deviceamcs->EID] = $equps[$i];
                $previous_contract = $this->basemodel->fetch_single_row($this->deviceamcs->tbl_name,array($this->deviceamcs->EID=>$equps[$i]),$this->deviceamcs->AMC_TO,$this->deviceamcs->AMC_TO,'DESC');
                if(strtotime($previous_contract[$this->deviceamcs->AMC_TO])<strtotime($insert_amc[$this->deviceamcs->AMC_FROM]))
                {
                    $this->basemodel->update_operation(array($this->deviceamcs->STATUS=>CLOSE),$this->deviceamcs->tbl_name,array($this->deviceamcs->EID=>$equps[$i]));
                    if($this->basemodel->insert_into_table($this->deviceamcs->tbl_name,$insert_amc))
                    {
                        $j++;
                        $data['response'] = SUCCESSDATA;
                        $data['call_back'] = "Contract Added Successfully";
                    }
                    else
                    {
                        $k++;
                        $data['response'] = FAILEDATA;
                        $data['call_back'] = "Unable Process Your Request Try Again...!";
                    }
                }
                else
                {
                    $k++;
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Contract Not Completed, available up to ".$previous_contract[$this->deviceamcs->AMC_TO];
                }
            }
            if($k==0)
                $data['call_back'] = $j." Contracts Added Successfully";
            else
                $data['call_back'] = $j." Contracts Added, ".$k." Contracts Not Updated";
        }
        return $data;
    }
    private function _update_maintain_contract($jodata=array())
    {
        $data = array();
        $where=array();
        if(!empty($jodata))
        {
            $where[$this->deviceamcs->ID]=$jodata->ID;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $insert_amc[$this->deviceamcs->BRANCH_ID]=$branch_id;
            $insert_amc[$this->deviceamcs->ORG_ID]=$org_id;
            $insert_amc[$this->deviceamcs->AMC_FROM] = date('Y-m-d', strtotime      ($jodata->contract_from_date));
            $insert_amc[$this->deviceamcs->AMC_TO] = date('Y-m-d', strtotime    ($jodata->contract_to_date));
            $insert_amc[$this->deviceamcs->AMC_TYPE] = $jodata->contract_type;
            $insert_amc[$this->deviceamcs->AMC_VALUE] = $jodata->contract_value;
            $insert_amc[$this->deviceamcs->AMC_VENDOR] = $jodata->vendor;
            $insert_amc[$this->deviceamcs->REMARKS] = $jodata->remarks;
            if(isset($jodata->sstatus)) {
                $insert_amc[$this->deviceamcs->STATUS] = $jodata->sstatus;
            }
            $insert_amc[$this->deviceamcs->EID] = $jodata->equp_id;
            if($this->basemodel->update_operation($insert_amc,$this->deviceamcs->tbl_name,$where))
            {
                //$data['qry'] = $this->db->last_query();
                $device_insert = true;
                $data['response'] = SUCCESSDATA;

                $data['call_back'] = "Contracts Updated Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }

        }
        return $data;
    }

    private function _add_renuval_contracts($jodata=array())
    {

        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $insert_amc[$this->deviceamcs->BRANCH_ID]=$branch_id;
            $insert_amc[$this->deviceamcs->ORG_ID]=$org_id;
            $insert_amc[$this->deviceamcs->AMC_FROM] = date('Y-m-d', strtotime($jodata->contract_from_date));
            $insert_amc[$this->deviceamcs->AMC_TO] = date('Y-m-d', strtotime($jodata->contract_to_date));
            $insert_amc[$this->deviceamcs->AMC_TYPE] = $jodata->contract_type;
            $insert_amc[$this->deviceamcs->AMC_VALUE] = $jodata->contract_value;
            $insert_amc[$this->deviceamcs->AMC_VENDOR] = $jodata->vendor;
            $insert_amc[$this->deviceamcs->REMARKS] = $jodata->remarks;
            $insert_amc[$this->deviceamcs->EID] = $jodata->EID;
            $insert_amc[$this->deviceamcs->RID] = $jodata->ID;
            $insert_amc[$this->deviceamcs->ADDED_ON] = date('Y-m-d H:i:s');
            $insert_amc[$this->deviceamcs->ADDED_BY] = $user_id;
            $insert_amc[$this->deviceamcs->UPDATE_TYPE] = 'R';
            $this->basemodel->update_operation(array($this->deviceamcs->STATUS=>CLOSE),$this->deviceamcs->tbl_name,array($this->deviceamcs->EID=>$jodata->EID));
            if($this->basemodel->insert_into_table($this->deviceamcs->tbl_name,$insert_amc))
            {
                $data['response'] = SUCCESSDATA;
                $lid = $this->db->insert_id();
                $data['call_back'] = "Renewal Contracts Added Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Unable Process Your Request Try Again...!";
            }

        }
        return $data;
    }

    private function _get_incedents_observations_data($jodata=array())
    {
        //print_r($jodata);
        $where=array();
        $data = array();
        if(!empty($jodata))
        {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            //$where[$this->incedents->BRANCH_ID] = $branch_id;
            //$where[$this->incedents->ORG_ID] = $org_id;
            $where[$this->incedents->EQUP_ID] = $jodata->equp_id;
            $list = $this->basemodel->fetch_records_from($this->incedents->tbl_name,$where);
            //return $this->db->last_query();
            if (!empty($list))
            {
                for($i=0;$i<count($list);$i++)
                {
                    $list[$i]['DEPT_NAME'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name,$this->userdeprts->USER_DEPT_NAME,array($this->userdeprts->CODE=>$list[$i][$this->incedents->DEPT_ID]));
                    $list[$i]['INCIDENT_TYPE_NAME'] = $this->basemodel->get_single_column_value($this->incedenttype->tbl_name,$this->incedenttype->ITYPE,array($this->incedenttype->CODE=>$list[$i][$this->incedents->INCIDENT_TYPE]));
                    $list[$i]['ADDEDBY_NAME'] = $this->basemodel->get_single_column_value($this->users->tbl_name,$this->users->USER_NAME,array($this->users->USER_ID=>$list[$i][$this->incedents->ADDED_BY]));
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $list;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }

    public function randid()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $m_time = microtime();

        $unique_id = sha1($ip . $m_time . rand(0, time()));
        echo $unique_id;
    }

    private function _get_equp_contracts($jodata=array())
    {
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $data = array();
        $where = array();
        $where[$this->deviceamcs->ORG_ID] = $org_id;
        $where[$this->deviceamcs->BRANCH_ID] = $branch_id;
        $where_date = '';
        if (!empty($jodata))
        {
            $where[$this->deviceamcs->EID] = $jodata->eid;
            $where[$this->deviceamcs->AMC_TO." >="] = date('Y-m-d');

            $list = $this->basemodel->awesome_fetch($this->deviceamcs->tbl_name,$where,'','','','','','*',$this->deviceamcs->AMC_TO,'DESC');

            // $data['qry'] = $this->db->last_query();
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                for($i=0;$i<count($list);$i++)
                {
                    $list[$i]['contracttypes'] = $this->basemodel->get_single_column_value($this->contracttypes->tbl_name, $this->contracttypes->CTYPE, array($this->contracttypes->CFORM=>$list[$i][$this->deviceamcs->AMC_TYPE]));

                    $list[$i]['eq_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID=>$list[$i][$this->deviceamcs->EID]));

                    $list[$i]['VENDOR_NAME'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name,$this->devicevendors->NAME,array($this->devicevendors->ID=>$list[$i][$this->deviceamcs->AMC_VENDOR]));
                    $list[$i]['status'] = $this->basemodel->get_single_column_value($this->contractstatus->tbl_name,$this->contractstatus->NAME,array($this->contractstatus->CODE=>$list[$i][$this->deviceamcs->STATUS]));
                }
                $data['list'] = $list;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }

    private function _transfer_device_deployment($jodata=array())
    {
        $data=array();
        $main_device_id = "";
        $eq_data = $this->basemodel->fetch_single_row($this->transfer->tbl_name,array($this->transfer->ID=>$jodata->ID));

        if(empty($eq_data))
        {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "No Record Found...!";
            return $data;
        }
        $org_id = $eq_data[$this->transfer->ORG_ID];
        $brach_id = $eq_data[$this->transfer->TRANSFER_BRANCH];
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $tbranch_code = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_CODE,array($this->branches->BRANCH_ID=>$brach_id));

        $city_code = $this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->CITY,array($this->branches->BRANCH_ID=>$brach_id));

        $qry = "SELECT ".$this->devices->E_ID." FROM ".$this->db->dbprefix($this->devices->tbl_name)." WHERE ".$this->devices->ORG_ID." = '".$org_id."' AND ".$this->devices->E_ID." LIKE '".$city_code."-___-____-".$tbranch_code."-%-___-____' ORDER BY Right(".$this->devices->E_ID.",4) DESC";
        $devices = $this->basemodel->execute_qry($qry);
        if($devices===false)
        {
            return false;
        }
        if(!empty($devices))
        {
            $device = $devices[0];
            $eid=$device[$this->devices->E_ID];
            $data['last_equp'] = $eid;
            $number_array=explode("-",$eid);
            $number = end($number_array);
            $number = (int)$number;
            $number = $number+1;
        }
        else
            $number=1;
        $len = strlen($number);
        if($len==1)
            $elast_id="000".$number;
        else if($len==2)
            $elast_id="00".$number;
        else if($len==3)
            $elast_id="0".$number;
        else
            $elast_id=$number;
        $teq_id = explode("-",$eq_data[$this->transfer->EQUP_ID]);
        $equp_name_code = strtoupper(substr($eq_data[$this->transfer->E_NAME], 0, 3));
        $e_name = $this->basemodel->get_single_column_value($this->devicenames->tbl_name,$this->devicenames->NAME,array($this->devicenames->ID=>$eq_data[$this->transfer->E_NAME]));
        $main_device_id =  $city_code."-".$teq_id[1]."-".date('my')."-".$tbranch_code."-".$eq_data[$this->transfer->DEPT_ID]."-".$teq_id[5]."-".$elast_id;
        $device_dtls = $this->basemodel->fetch_single_row($this->devices->tbl_name,array($this->devices->E_ID=>$eq_data[$this->transfer->EQUP_ID],$this->devices->BRANCH_ID=>$eq_data[$this->transfer->BRANCH_ID],$this->devices->ORG_ID=>$eq_data[$this->transfer->ORG_ID]));

        $iddata[$this->devices->ORG_ID]=$org_id;
        $iddata[$this->devices->BRANCH_ID]=$eq_data[$this->transfer->TRANSFER_BRANCH];
        $iddata[$this->devices->DEPT_ID]=$eq_data[$this->transfer->DEPT_ID];
        $iddata[$this->devices->USERNAME]=$user_id;
        $iddata[$this->devices->E_NAME]=$e_name;
        $iddata[$this->devices->C_NAME]=$device_dtls[$this->devices->C_NAME];
        $iddata[$this->devices->E_CAT]=$device_dtls[$this->devices->E_CAT];
        $iddata[$this->devices->ACCSSORIES]=$eq_data[$this->transfer->ACCSSORIES];
        $iddata[$this->devices->E_TYPE]=$device_dtls[$this->devices->E_TYPE];
        $iddata[$this->devices->E_MODEL]=$device_dtls[$this->devices->E_MODEL];
        $iddata[$this->devices->ES_NUMBER]=$device_dtls[$this->devices->ES_NUMBER];
        $iddata[$this->devices->PONO]=$device_dtls[$this->devices->PONO];
        $iddata[$this->devices->PHY_LOCATION]=$eq_data[$this->transfer->PHYSICAL_LOCATION];
        $iddata[$this->devices->E_COST]=$device_dtls[$this->devices->E_COST];
        $iddata[$this->devices->DISTRIBUTOR]=$device_dtls[$this->devices->DISTRIBUTOR];
        $iddata[$this->devices->DATEOF_INSTALL]=date('Y-m-d');
        $iddata[$this->devices->EQ_CONDATION]=DW;
        $iddata[$this->devices->QR_CODE]=QR_URL . $main_device_id;
        $iddata[$this->devices->E_COND]='G';
        $iddata[$this->devices->ADDED_ON]=date('Y-m-d H:i:s');
        $iddata[$this->devices->ORGINAL_ID]=$eq_data[$this->transfer->EQUP_ID];
        $iddata[$this->devices->BRANCH_RELOCATION]=$iddata[$this->devices->FROM_OTHER_UNIT]=YESSTATE;
        $iddata[$this->devices->STATUS]='ACT';
        $iddata[$this->devices->E_ID]=$main_device_id;
        if($this->basemodel->insert_into_table($this->devices->tbl_name,$iddata))
        {
            $wpddata[$this->devices->E_ID]=$eq_data[$this->transfer->EQUP_ID];
            $wpddata[$this->devices->ORG_ID]=$org_id;
            $wpddata[$this->devices->BRANCH_ID]=$eq_data[$this->transfer->BRANCH_ID];
            $upddata[$this->devices->STATUS]='TRF';
            $data['trf'] = $this->basemodel->update_operation($upddata,$this->devices->tbl_name,$wpddata);
            $data['trf_qry'] = $this->db->last_query();

            $udevice[$this->transfer->DEPLOYMENT_ID] = $main_device_id;
            $udevice[$this->transfer->UPDATED_ON] = date('Y-m-d H:i:s');
            $udevice[$this->transfer->UPDATED_BY] = $user_id;
            $uwhere[$this->transfer->ID] = $eq_data[$this->transfer->ID];
            $this->basemodel->update_operation($udevice,$this->transfer->tbl_name,$uwhere);
            $data['tid'] = $main_device_id;
            $data['response'] = SUCCESSDATA;
            $data['call_back'] = "Device Transferred Successfully(EID:".$main_device_id.")";
        }
        else
        {
            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable to Deploy Transfer  Device";
        }
        return $data;
    }

    private function _get_calls_master($jodata=array())
    {
        $data =array();
        $list = $this->basemodel->fetch_records_from($this->callmasters->tbl_name);
        if(!empty($list))
        {
            $data['list'] = $list;
            $data['response'] = SUCCESSDATA;
        }
        else
        {
            $data['list'] = array();
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }
    private function _get_call_reasons($jodata=array())
    {
        $data = $where =array();
        $where[$this->reasons->TYPE] = $jodata->call_type;
        $list = $this->basemodel->fetch_records_from($this->reasons->tbl_name,$where);
        if(!empty($list))
        {
            $data['list'] = $list;
            $data['response'] = SUCCESSDATA;
        }
        else
        {
            $data['list'] = array();
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

    private function _get_tansfer_list($jodata = array())
    {
        return "ffh";
        $data = array();
        $like = array();
        $or_where = '';
        if (!empty($jodata)) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $where[$this->transfer->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            if (isset($jodata->unit_type) && $jodata->unit_type != "" && $jodata->unit_type != null)
                $like[$this->transfer->TRANSFER] = $jodata->unit_type;

            //$where[$this->transfer->TRANSFER_BRANCH] = $branch_id;

            if (isset($jodata->status) && $jodata->status != "" && $jodata->status != null)
            {
                if($jodata->status=="Approved" || $jodata->status=="Disapproved")
                {
                    $where[$this->transfer->TRANSFER_BRANCH]=$branch_id;
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


            if(isset($jodata->aaction) && $jodata->aaction=="get_admin_calls")
            {
                unset($where[$this->transfer->TRANSFER_BRANCH]);
            }
            else
            {
                $or_where = "(" . $this->transfer->TRANSFER_BRANCH . " = '".$branch_id."' OR " . $this->transfer->BRANCH_ID . "='" . $branch_id ."')";
            }

            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->transfer->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
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
                    $or_where = $this->transfer->EQUP_ID . " IN " . $device;
                }

                else
                    $or_where = '';

            }



            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_three_multi_where($this->transfer->tbl_name, $where, $where_date,$or_where, 'count(' . $this->transfer->ID . ') AS CNT','','','',$like);

                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $transfer = $this->basemodel->fetch_records_from_three_multi_where_pagination($this->transfer->tbl_name, $where, $where_date, $or_where, '*', $this->transfer->ADDED_ON, 'DESC', '10', $limit_val * 10,$like);

            } else {

                $transfer = $this->basemodel->fetch_records_from_three_multi_where($this->transfer->tbl_name, $where, $where_date,$or_where,'*',$this->transfer->ADDED_ON, 'DESC','', $like);
            }
            $data['qry'] = $this->db->last_query();
            // return $this->db->last_query();
            if (!empty($transfer)) {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($transfer); $i++) {
                    $data['list'] = $transfer;
                    $transfer[$i]['ename'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['equp_type'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->TYPE, array($this->cms->EID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['status'] = $this->basemodel->get_single_column_value($this->cms->tbl_name, $this->cms->STATUS, array($this->cms->EID => $transfer[$i][$this->transfer->EQUP_ID]));
                    $transfer[$i]['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $transfer[$i][$this->transfer->USERNAME]));
                    $transfer[$i]['tbranch_code'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_CODE, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->TRANSFER_BRANCH]));
                    $transfer[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->BRANCH_ID]));
                    $transfer[$i]['tbranch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $transfer[$i][$this->transfer->TRANSFER_BRANCH]));
                    $transfer[$i]['added_on'] = strtotime($transfer[$i][$this->transfer->ADDED_ON]);
                }
                // print_r($transfer);
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }

            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls" )
                return $transfer;
        }
        return $data;
    }

    private function _get_conrequest_list($jodata=array())
    {
        $data = array();
        $like = array();
        $branch_id =  isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;

        if(!empty($jodata))
        {
            $where[$this->condemnation->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $where[$this->condemnation->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            if(isset($jodata->action) && $jodata->action=="get_admin_calls") {
                unset($where[$this->condemnation->BRANCH_ID]);
            }
            $where_date = '';
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
            if (isset($jodata->reasons) && $jodata->reasons != "" && $jodata->reasons != null)
                $like[$this->condemnation->REUSABLE_PARTS] = $jodata->reasons;

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

                $condemnation = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->condemnation->tbl_name,$where,$where_date, $like, '*','','','10',$limit_val*10);

            }
            else
            {

                $condemnation= $this->basemodel->fetch_records_from_multi_where_like($this->condemnation->tbl_name,$where,$where_date,$like);

            }

            //     return $this->db->last_query();
            if (!empty($condemnation))
            {
                //$data['qry'] = $this->db->last_query();
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
                $data['list'] = $condemnation;
                //print_r($condemnation);
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }





            $swhere[$this->devices->ORG_ID]  = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;

            if($branch_id != 'All')
                $swhere[$this->devices->BRANCH_ID] = $branch_id;
            else {
                $orr_where = $this->devices->BRANCH_ID ." IN ".BRANCHALL;
            }
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
                    $condemn_call_res['BRANCH_ID'] = $devices[$i]['BRANCH_ID'];
                    $condemn_call_res['ORG_ID'] = $devices[$i]['ORG_ID'];

                    array_push($condemnation_data,$condemn_call_res);

                }

            }

            if(!empty($condemnation_data))
                $condemnation = array_merge($condemnation, $condemnation_data);
            $data['list'] = $condemnation;



            if(isset($jodata->aaction) && $jodata->aaction == "get_assigned_calls" )
                return $condemnation;

        }

        return $data;
    }

    private function _vendor_equipments_expired($jodata=array())
    {

	   $data=array();
        $where[$this->deviceamcs->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $where[$this->deviceamcs->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $where[$this->deviceamcs->AMC_VENDOR] = $jodata->vendor_id;
        $where[$this->deviceamcs->STATUS] = OPEN;
        $where[$this->deviceamcs->AMC_TO." <="] = date('Y-m-d');
        $list = $this->basemodel->fetch_records_from($this->deviceamcs->tbl_name,$where,'*',$this->deviceamcs->AMC_TO,'DESC');
        $data['qry'] = $this->db->last_query();
        //return $this->db->last_query();
        if(!empty($list))
        {
            $data['list'] = $list;
            $data['response'] = SUCCESSDATA;
        }
        else
        {
            $data['list'] = array();
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

    private function _equipment_history($jodata,$device_id='')
    {
        $data=array();
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        if($device_id!="")
        {
            $limit = 10;
            $cms_where[$this->cms->ORG_ID] = $org_id;
            $cms_where[$this->cms->BRANCH_ID] = $branch_id;
            $cms_where[$this->cms->EID] = $device_id;
            $cms_where[$this->cms->JOBCOMPLETED_DATE." !="] = NULL;
            $cms = $this->basemodel->fetch_records_from_multi_where_pagination($this->cms->tbl_name,$cms_where,'','*',$this->cms->JOBCOMPLETED_DATE,'DESC',$limit);
            if(!empty($cms))
            {
                $cms = $this->baselibrary->cms_call_details($cms,'completed');
                for($i=0;$i<count($cms);$i++)
                {
                    $data[] = $cms[$i];
                }
            }
            $pms_where[$this->pmsdetails->ORG_ID] = $org_id;
            $pms_where[$this->pmsdetails->BRANCH_ID] = $branch_id;
            $pms_where[$this->pmsdetails->EID] = $device_id;
            $pms_where[$this->pmsdetails->COMPLETED_BY." !="] = NULL;
            $pms = $this->basemodel->fetch_records_from_multi_where_pagination($this->pmsdetails->tbl_name,$pms_where,'','*',$this->pmsdetails->COMPLETED_BY,'DESC',$limit);
            if(!empty($pms))
            {
                $pms = $this->baselibrary->scheduled_pms_details($pms);
                for($j=0;$j<count($pms);$j++)
                {
                    $data[] = $pms[$j];
                }
            }
            $qc_where[$this->qcdetails->ORG_ID] = $org_id;
            $qc_where[$this->qcdetails->BRANCH_ID] = $branch_id;
            $qc_where[$this->qcdetails->EID] = $device_id;
            $qc_where[$this->qcdetails->COMPLETED_BY." !="] = NULL;
            $qc = $this->basemodel->fetch_records_from_multi_where_pagination($this->qcdetails->tbl_name,$qc_where,'','*',$this->qcdetails->COMPLETED_BY,'DESC',$limit);
            if(!empty($qc))
            {
                $cal = $this->baselibrary->scheduled_qc_details($qc);
                for($k=0;$k<count($cal);$k++)
                {
                    $data[] = $cal[$k];
                }
            }
            $ad_where[$this->incedents->ORG_ID] = $org_id;
            $ad_where[$this->incedents->BRANCH_ID] = $branch_id;
            $ad_where[$this->incedents->EQUP_ID] = $device_id;
            $ad_where[$this->incedents->COMPLETED_BY." !="] = NULL;
            $ad = $this->basemodel->fetch_records_from_multi_where_pagination($this->incedents->tbl_name,$ad_where,'','*',$this->incedents->COMPLETED_BY,'DESC',$limit);
            if(!empty($ad))
            {
                $adv = $this->baselibrary->adverse_incidents($ad);
                for($l=0;$l<count($adv);$l++)
                {
                    $data[] = $adv[$l];
                }
            }
            $con_where[$this->condemnation->ORG_ID] = $org_id;
            $con_where[$this->condemnation->BRANCH_ID] = $branch_id;
            $con_where[$this->condemnation->EQUP_ID] = $device_id;
            $con_where[$this->condemnation->REASON2." !="] = NULL;
            $con = $this->basemodel->fetch_records_from_multi_where_pagination($this->condemnation->tbl_name,$con_where,'','*',$this->condemnation->REASON2,'DESC',$limit);
            if(!empty($con))
            {
                $condem = $this->baselibrary->condemnation_details($con);
                for($m=0;$m<count($condem);$m++)
                {
                    $data[] = $condem[$m];
                }
            }
            $trf_where[$this->transfer->ORG_ID] = $org_id;
            $trf_where[$this->transfer->BRANCH_ID] = $branch_id;
            $trf_where[$this->transfer->EQUP_ID] = $device_id;
            $trf_where[$this->transfer->DEPLOYMENT_ID." !="] = NULL;
            $trf = $this->basemodel->fetch_records_from_multi_where_pagination($this->transfer->tbl_name,$trf_where,'','*',$this->transfer->ADDED_ON,'DESC',$limit);
            if(!empty($trf))
            {
                $transfer = $this->baselibrary->transfer_list($trf);
                for($n=0;$n<count($transfer);$n++)
                {
                    $data[] = $transfer[$n];
                }
            }
        }
        return $data;
    }

    public function sort_device_array($data)
    {
        // Obtain a list of columns
        foreach ($data as $key => $row)
        {
            $mid[$key]  = $row[6];
        }
        // Sort the data with mid descending
        // Add $data as the last parameter, to sort by the common key
        array_multisort($mid, SORT_DESC, $data);
        return $data;
    }
    public function img_url()
    {
        $b64image = base64_encode(file_get_contents('http://chart.apis.google.com/chart?chs=200x200&cht=qr&chl=HYD-BME-0101-BN-BLB-MIC-0074'));
        echo "data:image/png;base64,".$b64image;
    }



    /*Get Equipment Down Time*/
    private function _get_equp_down_time_list($jodata=array())
    {
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
        $data = array();
        $where = array();
        if(!empty($jodata))
        {
            $where[$this->cms->BRANCH_ID] = $branch_id;
            $where[$this->cms->STATUS." !="] = DNW;
            $where[$this->cms->ORG_ID] = $org_id;
            if (isset($jodata->equp_id) && $jodata->equp_id != "" && $jodata->equp_id != null)
                $where[$this->cms->EID] = $jodata->equp_id;
            if (isset($jodata->dept_id) && $jodata->dept_id != "" && $jodata->dept_id != null)
                $where[$this->cms->CALLER_DEPT] = $jodata->dept_id;
            $where_date = '';
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = "CONCAT_WS(' ',".$this->cms->CDATE.",".$this->cms->CTIME.") BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . " 00:00:00' AND '" . date('Y-m-d', strtotime($jodata->todate)) . " 23:59:59'";
            }
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name, $where, $where_date, 'count('.$this->cms->ID.') AS CNT');
                //$data['qry'] = $this->db->last_query();
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
                $equp_dwn_tm = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->cms->tbl_name, $where, $where_date,'','','','', '*','','','10',$limit_val*10);
            }
            else
            {
                $equp_dwn_tm= $this->basemodel->awesome_fetch($this->cms->tbl_name,$where,$where_date);
            }

            //$data['qry'] = $this->db->last_query();
            if (!empty($equp_dwn_tm))
            {
                $data['response'] = SUCCESSDATA;
                $total_no_same_equpts = $total_down_time = $total_delay_in_hours = $total_delay_in_days = 0;
                for($i=0;$i<count($equp_dwn_tm);$i++)
                {
                    $equp_dwn_tm[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $equp_dwn_tm[$i][$this->cms->BRANCH_ID]));
                    $equp_dwn_tm[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $equp_dwn_tm[$i][$this->cms->CALLER_DEPT]));
                    $equp_dwn_tm[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $equp_dwn_tm[$i][$this->cms->EID]));
                    $equp_dwn_tm[$i]['serial_no'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $equp_dwn_tm[$i][$this->cms->EID]));

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
                    $equp_dwn_tm[$i]['no_same_equpts'] = $no_same_equpts;
                    $total_no_same_equpts = $total_no_same_equpts+$no_same_equpts;
                    /* count no of equipments based on equp_name,Cmny_name */
                    $equp_dwn_tm[$i]['total_down_time']=round((($dwntime)/($last_day*$no_same_equpts))*100,2);
                    $total_down_time = $equp_dwn_tm[$i]['total_down_time']+$total_down_time;
                    if(is_numeric($equp_dwn_tm[$i]['cmpny_name']))
                    {
                        $equp_dwn_tm[$i]['cmpny_name']=$this->basemodel->get_single_column_value($this->devicevendors->tbl_name,$this->devicevendors->NAME,array($this->devicevendors->ID=> $equp_dwn_tm[$i]['cmpny_name']));
                    }
                    $equp_dwn_tm[$i]['date_of_install'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->DATEOF_INSTALL, array($this->devices->E_ID => $equp_dwn_tm[$i][$this->cms->EID]));
                    $total_delay_in_days = $equp_dwn_tm[$i][$this->cms->TIME_TO_REPAIR]+$total_delay_in_days;
                    $equp_dwn_tm[$i]['Deal_in_Hours'] =$equp_dwn_tm[$i][$this->cms->TIME_TO_REPAIR]*24;
                    $total_delay_in_hours = $equp_dwn_tm[$i]['Deal_in_Hours']+$total_delay_in_hours;
                }
                $data['total_no_same_equpts'] = $total_no_same_equpts;
                $data['all_total_down_time'] = $total_down_time;
                $data['total_delay_in_hours'] = $total_delay_in_hours;
                $data['total_delay_in_days'] = $total_delay_in_days;
                $data['list'] = $equp_dwn_tm;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }

    private function _get_equpiment_history_list($jodata = array())
    {
        $data = array();
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson)
        {
            $where = array();
            $like = array();
            if ($jodata->eqpid !='')
                $where[$this->devices->E_ID] = $jodata->eqpid;
            if ($jodata->ename !='')
                $like[$this->devices->E_NAME] = $jodata->ename;
            //$where[$this->devices->E_ID." !="] = NULL;
            if ($jodata->saccessoriesno !='')
                $where[$this->devices->ES_NUMBER] = $jodata->saccessoriesno;
            $where[$this->devices->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            //$where[$this->devices->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $branch_id =  isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;

            if($branch_id !='All')
            {
                $where[$this->devices->BRANCH_ID] = $branch_id;
            }else
            {
                $or_where = $this->devices->BRANCH_ID. " IN " . BRANCHALL;
            }


            if ($jodata->dept_id != ALL && $jodata->dept_id !='')
                $where[$this->devices->DEPT_ID] = $jodata->dept_id;
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_with_like_multiwhere($this->devices->tbl_name, $where,$or_where,$like,'count('.$this->devices->ID.') AS CNT');
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
                $list = $this->basemodel->fetch_records_from_multi_where_pagination_like($this->devices->tbl_name, $where, $or_where,$like, '*',$this->devices->ADDED_ON,'asc','10',$limit_val*10);
            }
            else
                $list = $this->basemodel->fetch_records_with_like_multiwhere($this->devices->tbl_name, $where,$or_where,$like,'*',$this->devices->ADDED_ON);

            //$data['qry'] = $this->db->last_query();
            if (!empty($list))
            {
                $data['response'] = SUCCESSDATA;
                for($i=0;$i<count($list);$i++)
                {
                    $list[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$i][$this->devices->DEPT_ID]));
                    $list[$i]['username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$i][$this->devices->USERNAME]));
                    $list[$i]['branchname'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$i][$this->devices->BRANCH_ID]));
                    $list[$i]['contarct_type'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_TYPE, array($this->deviceamcs->EID => $list[$i][$this->devices->E_ID]));
                    $list[$i][$this->deviceamcs->AMC_VENDOR]=$this->basemodel->get_single_column_value($this->deviceamcs->tbl_name,$this->deviceamcs->AMC_VENDOR,array($this->deviceamcs->EID => $list[$i][$this->devices->E_ID]),$this->deviceamcs->AMC_TO ,'desc');

                    $list[$i]['vendorname'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$i][$this->deviceamcs->AMC_VENDOR]));
                    $list[$i]['vendoraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$i][$this->deviceamcs->AMC_VENDOR]));
                    $list[$i]['vendorcontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$i][$this->deviceamcs->AMC_VENDOR]));

                    $list[$i]['suppliername'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$i][$this->devices->DISTRIBUTOR]));
                    $list[$i]['supplieraddress'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->ADDRESS, array($this->devicevendors->ID => $list[$i][$this->devices->DISTRIBUTOR]));
                    $list[$i]['suppliercontact_no'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->MOBILE_NO, array($this->devicevendors->ID => $list[$i][$this->devices->DISTRIBUTOR]));
                }
                $data['list'] = $list;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        // print_r($data);
        return $data;
    }
    private function _get_hmadmin_call_counts($jodata)
    {
        $data = array();
        if (!empty($jodata))
        {
            $t_orwhere = '';
            $where[$this->cms->ORG_ID] = $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $branch_id = $this->basemodel->fetch_records_from($this->branches->tbl_name,array($this->branches->ORG_ID=>$org_id),array($this->branches->BRANCH_ID,$this->branches->BRANCH_NAME));
            for($i=0;$i<count($branch_id);$i++)
            {
                $data[$i]["branch_name"] = $branch_id[$i][$this->branches->BRANCH_NAME];
                $where[$this->cms->BRANCH_ID] = $branch_id[$i][$this->branches->BRANCH_ID];
                $cn_where[$this->condemnation->BRANCH_ID] = $branch_id[$i][$this->branches->BRANCH_ID];
                $t_orwhere = "(".$this->transfer->BRANCH_ID."='".$branch_id[$i][$this->branches->BRANCH_ID]."' OR ". $this->transfer->TRANSFER_BRANCH."='".$branch_id[$i][$this->branches->BRANCH_ID]."')";
                $pmswhere[$this->pmsdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $cmpms_where[$this->pmsdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $cmqcwhere[$this->qcdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $qcwhere[$this->qcdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $aiwhere[$this->incedents->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $rlwhere[$this->rounds_assigned->BRANCH_ID] = $branch_id[$i][$this->branches->BRANCH_ID];
                $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
                $where[$this->cms->STATUS . " !="] = DW;
                $where[$this->cms->RESPONDED_BY] = NULL;
                $data[$i]['today_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
                unset($where[$this->cms->RESPONDED_BY]);
                if($role_code==HBBME || (isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
                {
                    $where[$this->cms->RESPONDED_BY] = $user_id;
                }
                unset($where[$this->cms->STATUS . " !="]);
                $where[$this->cms->STATUS] = DNW;
                $where[$this->cms->ATTENDED_BY] = NULL;
                $where[$this->cms->RESPONDED_DATE." !="] = NULL;
                $data[$i]['responded_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
                //$data['responded_callsqry'] = $this->db->last_query();
                if($role_code==HBBME || (isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
                {
                    $where[$this->cms->ASSIGNED_TO] = $user_id;
                }
                unset($where[$this->cms->RESPONDED_BY]);
                $where[$this->cms->ASSIGNED_TO." !="] = NULL;
                $data[$i]['assigned_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
                //$data['assigned_calls_qry'] = $this->db->last_query();
                $data[$i]['responded_calls_cnt'] = $data[$i]['responded_calls_cnt']+$data[$i]['assigned_calls_cnt'];
                unset($where[$this->cms->ASSIGNED_TO]);
                unset($where[$this->cms->ATTENDED_BY]);
                unset($where[$this->cms->ASSIGNED_TO." !="]);
                unset($data[$i]['assigned_calls_cnt']);
                if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
                {
                    unset($where[$this->cms->RESPONDED_BY]);
                    $where[$this->cms->ATTENDED_BY] = $user_id;
                }
                unset($where[$this->cms->RESPONDED_DATE." !="]);
                unset($where[$this->cms->RESPONDED_DATE]);
                $where[$this->cms->ATTENDED_DATE." !="] = NULL;
                $where[$this->cms->PENDING_REASON] = NULL;
                $data[$i]['attended_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
                //$data['attended_callsqry'] = $this->db->last_query();

                unset($where[$this->cms->PENDING_REASON]);
                unset($where[$this->cms->ATTENDED_DATE." !="]);
                $where[$this->cms->STATUS] = UMAINTENCE;
                $where[$this->cms->PENDING_REASON." !="] = NULL;
                $data[$i]['pending_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
                //$data['pending_callsqry'] = $this->db->last_query();

                unset($where[$this->cms->STATUS." !="]);
                unset($where[$this->cms->PENDING_REASON." !="]);
                $where[$this->cms->STATUS] = DW;
                $where[$this->cms->JOBCOMPLETED_DATE] = date('Y-m-d');
                $data[$i]['ns_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
                //$data['completed_callsqry'] = $this->db->last_query();

                /*pending pms*/
                $pmswhere[$this->pmsdetails->ORG_ID] = $where[$this->cms->ORG_ID];
                $pmswhere[$this->pmsdetails->COMPLETED_BY] =  NULL;
                $pmswhere_like[$this->pmsdetails->PMS_DUE_DATE] =  date('Y-m');
                $pms_or_where = "";
                if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
                {
                    if(isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
                    {
                        $pmswhere[$this->pmsdetails->PMS_ASSIGNED_TO] =  $user_id;
                    }
                    else
                    {
                        $pms_or_where = "(" . $this->pmsdetails->PMS_ASSIGNED_TO . " IS NULL OR " . $this->pmsdetails->PMS_ASSIGNED_TO . "='" . $user_id . "')";
                    }
                    $cmpms_where[$this->pmsdetails->COMPLETED_BY] =  $user_id;
                }
                $data[$i]['pending_pms'] = $this->basemodel->num_of_res($this->pmsdetails->tbl_name, $pmswhere, $pms_or_where,'','',$pmswhere_like);
                $cmpms_where[$this->pmsdetails->ORG_ID] = $where[$this->cms->ORG_ID];
                $cmpms_where[$this->pmsdetails->COMPLETED_BY." !="] =  NULL;
                $cmpms_where[$this->pmsdetails->PMS_ACTL_DONE] =  date('Y-m-d');
                $data[$i]['completed_pms'] = $this->basemodel->num_of_res($this->pmsdetails->tbl_name,$cmpms_where);
                /*pending qc*/
                $qcwhere[$this->qcdetails->ORG_ID] =  $where[$this->cms->ORG_ID];
                $qcwhere_like[$this->qcdetails->QC_DUE] =  date('Y-m');
                $qcwhere[$this->qcdetails->COMPLETED_BY] =  NULL;
                $qc_or_where = "";
                if($role_code==HBBME || (isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
                {
                    if(isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
                    {
                        $qcwhere[$this->qcdetails->ASSIGNED_TO] =  $user_id;
                    }
                    else
                    {
                        $qc_or_where = "(" . $this->qcdetails->ASSIGNED_TO . " IS NULL OR " . $this->qcdetails->ASSIGNED_TO . "='" . $user_id . "')";
                    }
                    $cmqcwhere[$this->qcdetails->COMPLETED_BY] =  $user_id;
                }
                $data[$i]['pending_qc'] = $this->basemodel->num_of_res($this->qcdetails->tbl_name, $qcwhere,$qc_or_where,'','',$qcwhere_like);
                //$data['qq_callsqry'] = $this->db->last_query();
                $cmqcwhere[$this->qcdetails->ORG_ID] = $where[$this->cms->ORG_ID];
                $cmqcwhere[$this->qcdetails->COMPLETED_BY." !="] =  NULL;
                $cmqcwhere[$this->qcdetails->QC_ACTL_DONE] =  date('Y-m-d');
                $data[$i]['completed_qcs'] = $this->basemodel->num_of_res($this->qcdetails->tbl_name,$cmqcwhere);

                $round_where[$this->rounds_assigned->ORG_ID] = $org_id;
                $round_where[$this->rounds_assigned->BRANCH_ID] = $branch_id[$i][$this->branches->BRANCH_ID];
                $data[$i]['rounds_cnt'] = $this->basemodel->num_of_res($this->rounds_assigned->tbl_name, $round_where,'','');

                $cround_where[$this->rounds->ORG_ID] = $org_id;
                $cround_where[$this->rounds->BRANCH_ID] = $branch_id[$i][$this->branches->BRANCH_ID];
                $cround_where[$this->rounds->USERNAME] = $user_id;
                $cround_where[$this->rounds->START_DATE] = date('Y-m-d');
                $cround_where[$this->rounds->END_TIME." !="] = NULL;
                $data[$i]['completed_rounds_cnt'] = $this->basemodel->num_of_res($this->rounds->tbl_name, $cround_where);

                /*  adverse incidents */
                $aiwhere[$this->incedents->ORG_ID] = $where[$this->cms->ORG_ID];
                $aiwhere[$this->incedents->ACTION_TACKEN] = NULL;
                $ai_or_where = '';
                if((isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD))
                {
                    $aiwhere[$this->incedents->ASSIGNED_TO] =  $user_id;
                }
                else if($role_code==HBBME)
                {
                    $ai_or_where = "(" . $this->incedents->ASSIGNED_TO . " = '".$user_id."' OR " . $this->incedents->ASSIGNED_TO . " IS NULL)";
                }
                $data[$i]['adverse_incidents_count'] = $this->basemodel->num_of_res($this->incedents->tbl_name, $aiwhere,$ai_or_where);

                unset($aiwhere[$this->incedents->ACTION_TACKEN]);
                if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
                {
                    $aiwhere[$this->incedents->COMPLETED_BY] =  $user_id;
                }
                $aiwhere[$this->incedents->ACTION_TACKEN." !="] = NULL;
                $ailike[$this->incedents->COMPLETED_ON] = date('Y-m-d');
                $data[$i]['completed_adverse_calls'] = $this->basemodel->num_of_res($this->incedents->tbl_name, $aiwhere,'','','',$ailike);
                //$data['adc_qry'] = $this->db->last_query();

                /* rounds */
                $rounds = $this->_get_assigned_round($jodata);
                if($rounds['response']==SUCCESSDATA)
                    $data[$i]['rounds_count'] = count($rounds['list']);
                else
                    $data[$i]['rounds_count'] = 0;
                $twhere[$this->transfer->ORG_ID] = $org_id;
                $twhere[$this->transfer->DEPLOYMENT_ID] = NULL;
                $twhere[$this->transfer->TRANSFER] = 'Other Unit';
                $data[$i]['transfers_cnt'] = $this->basemodel->num_of_res($this->transfer->tbl_name, $twhere,$t_orwhere);

                unset($twhere[$this->transfer->DEPLOYMENT_ID]);
                unset($twhere[$this->transfer->TRANSFER]);
                $twhere[$this->transfer->DEPLOYMENT_ID." !="] = NULL;
                $tclike[$this->transfer->UPDATED_ON] = date('Y-m-d');
                if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
                {
                    $twhere[$this->transfer->UPDATED_BY] = $user_id;
                }
                $data[$i]['completed_condemnation_cnt'] = $this->basemodel->num_of_res($this->transfer->tbl_name, $twhere,$t_orwhere,'','',$tclike);

                $cn_where[$this->condemnation->ORG_ID] = $org_id;
                $cn_where[$this->condemnation->RESOLD_VALUE] = NULL;
                $data[$i]['condemnation_cnt'] = $this->basemodel->num_of_res($this->condemnation->tbl_name, $cn_where);
                unset($cn_where[$this->condemnation->RESOLD_VALUE]);
                $cn_where[$this->condemnation->RESOLD_VALUE." !="] = NULL;
                $cn_clike[$this->condemnation->UPDATED_ON] = date('Y-m-d');
                if($role_code==HBBME || isset($jodata->user_role_code) && $jodata->user_role_code==HBHOD)
                {
                    $cn_where[$this->condemnation->UPDATED_BY] = $user_id;
                }
                $data[$i]['completed_condemnation_cnt'] = $this->basemodel->num_of_res($this->condemnation->tbl_name, $cn_where,'','','',$cn_clike);
                $data[$i]['completed_calls_cnt'] = $data[$i]['completed_condemnation_cnt']+$data[$i]['completed_condemnation_cnt']+$data[$i]['completed_adverse_calls']+$data[$i]['completed_rounds_cnt']+$data[$i]['completed_qcs']+$data[$i]['completed_pms']+$data[$i]['ns_calls_cnt'];

                $data[$i]['tickets_cnt'] = $data[$i]['adverse_incidents_count']+$data[$i]['attended_calls_cnt']+$data[$i]['completed_calls_cnt']+$data[$i]['pending_calls_cnt']+$data[$i]['pending_pms']+$data[$i]['pending_qc']+$data['responded_calls_cnt']+$data[$i]['rounds_count']+$data[$i]['today_calls_cnt']+$data[$i]['transfers_cnt']+$data[$i]['condemnation_cnt'];
            }
        }
        return $data;
    }

    private function _get_same_equps_cat($jodata)
    {
        $data=array();
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $where[$this->devices->ORG_ID] = $org_id;
        $where[$this->devices->E_CAT] = $jodata->eq_cat;
        $where[$this->devices->E_ID." !="] = NULL;

        if($branch_id !='All')
            $where[$this->devices->BRANCH_ID] = $branch_id;
        else
            $or_where = $this->devices->BRANCH_ID. " IN ".BRANCHALL;



        $list = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$where,$or_where,array($this->devices->E_ID));
        // return $this->db->last_query();
        if(!empty($list))
        {
            $data['response'] = SUCCESSDATA;
            $data['list'] = $list;
        }
        else
        {
            $data['response'] = EMPTYDATA;
        }
        return $data;
    }

    private function _get_equps_by_unit_ecat($jodata=array())
    {
        $data=$where=array();
        if(!empty($jodata))
        {
            $where[$this->devices->E_CAT] = $jodata->e_cat;
            $where[$this->devices->E_ID." !="] = NULL;
            $where[$this->devices->EQ_CONDATION] = DW;
            $where[$this->devices->STATUS] = ACT;
            $where[$this->devices->BRANCH_ID] = $jodata->branch_id;
            $where[$this->devices->ORG_ID] = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $devices = $this->basemodel->fetch_records_from($this->devices->tbl_name,$where,array($this->devices->E_ID));
            if(!empty($devices))
            {
                $data['response'] = SUCCESSDATA;
                $data['list'] = $devices;
            }
            else
            {
                $data['response'] = EMPTYDATA;
            }
        }
        return $data;
    }
    private function _get_m_contracts_new($jodata=array())
    {
        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
        $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;

        $data = array();
        $where = array();
        $where[$this->deviceamcs->ORG_ID] = $org_id;
        $where[$this->deviceamcs->BRANCH_ID] = $branch_id;
        $where[$this->deviceamcs->ADDED_BY] = $user_id;
        $where_date = '';
        if (!empty($jodata)) {

            /*     if (isset($jodata->dept_id))
                     $where[$this->deviceamcs->D] = $jodata->dept_id;*/
            if ($jodata->fromdate != "" && $jodata->todate != "") {
                $where_date = $this->deviceamcs->AMC_TO . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            } else {
                $where[$this->deviceamcs->AMC_TO] = date('Y-m-d');
            }
            if (isset($jodata->limit_val)) {
                if ($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->deviceamcs->tbl_name, $where, $where_date, 'count(' . $this->deviceamcs->ID . ') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                } else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }
                $list = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->deviceamcs->tbl_name, $where, $where_date, '', '', '', '', '*', $this->deviceamcs->AMC_TO, 'desc', '10', $limit_val * 10);
            } else {
                $list = $this->basemodel->fetch_records_from_multi_where($this->deviceamcs->tbl_name, $where, $where_date, '*', $this->deviceamcs->AMC_TO, 'DESC');
            }

            //return $this->db->last_query();
            if (!empty($list)) {
                $data['response'] = SUCCESSDATA;
                for ($i = 0; $i < count($list); $i++) {
                    $list[$i]['contracttypes'] = $this->basemodel->get_single_column_value($this->contracttypes->tbl_name, $this->contracttypes->CTYPE, array($this->contracttypes->CFORM => $list[$i][$this->deviceamcs->AMC_TYPE]));

                    $list[$i]['eq_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $list[$i][$this->deviceamcs->EID]));
                    $list[$i]['serial_no'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $list[$i][$this->deviceamcs->EID]));

                    $list[$i]['VENDOR_NAME'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$i][$this->deviceamcs->AMC_VENDOR]));
                    /*$list[$i]['VENDOR_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->ORG_NAME,array($this->organizations->ORG_ID => $list[$i][$this->deviceamcs->AMC_VENDOR]));*/
                    $list[$i]['status'] = $this->basemodel->get_single_column_value($this->contractstatus->tbl_name, $this->contractstatus->NAME, array($this->contractstatus->CODE => $list[$i][$this->deviceamcs->STATUS]));
                }
                $data['list'] = $list;
            } else {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }

    private function _get_complete_round_new($jodata = array())
    {
        $data =array();
        //print_r($jodata);
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $where[$this->rounds->ORG_ID] = $org_id;
            $where[$this->rounds->BRANCH_ID] = $branch_id;
            $where[$this->rounds->USERNAME] = $user_id;
            if(isset($jodata->dept_id) && $jodata->dept_id!='')
            {
                $where[$this->rounds->DEPT_ID] = $jodata->dept_id;
            }
            $where_date = "";
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->rounds->START_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            }
            else
            {
                $where[$this->rounds->START_DATE] = date('Y-m-d');
            }
            if(isset($jodata->limit_val))
            {
                if($jodata->limit_val!='')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->rounds->tbl_name, $where, $where_date, 'count('.$this->rounds->ID.') AS CNT');
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
                $round_complete = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->rounds->tbl_name, $where, $where_date,'','','','', '*', $this->rounds->START_DATE, 'desc','10',$limit_val*10);
            }
            else
            {
                $round_complete = $this->basemodel->fetch_records_from_multi_where($this->rounds->tbl_name, $where, $where_date, '*', $this->rounds->START_DATE, 'desc');
            }
            //$data['qry'] = $this->db->last_query();
            if (!empty($round_complete))
            {
                for ($i = 0; $i < count($round_complete); $i++)
                {
                    $round_complete[$i]['Username'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $round_complete[$i][$this->rounds->USERNAME]));
                    $round_complete[$i]['Designation'] = $this->basemodel->get_single_column_value($this->roles->tbl_name, $this->roles->ROLE_NAME, array($this->roles->ROLE_CODE => $round_complete[$i][$this->rounds->DESG]));
                    $round_complete[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE=> $round_complete[$i][$this->rounds->DEPT_ID]));
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $round_complete;
            }
            else {
                $data['response'] = EMPTYDATA;
            }
        }
        // print_r($data);
        return $data;
    }
    private function _get_undeployed_new_equipments($jodata=array())
    {   //print_r($jodata);
        $data =array();
        $where=array();
        if(!empty($jodata)) {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->devices->BRANCH_ID] = $branch_id;
            $where[$this->devices->ORG_ID] = $org_id;
            $where[$this->devices->USERNAME] = $user_id;
            if ($jodata->dept_id != "")
                $where[$this->devices->DEPT_ID] = $jodata->dept_id;
            $where_date = "";
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->devices->ADDED_ON . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            }
            else
            {
                $where[$this->devices->ADDED_ON] = date('Y-m-d');
            }
            if (isset($jodata->limit_val))
            {
                if($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->devices->tbl_name,$where,$where_date,'count('.$this->devices->ID.') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                }
                else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }

                $list =  $this->basemodel->fetch_records_from_multi_where_vndr($this->devices->tbl_name,$where,$where_date,'*',$this->devices->E_NAME,'ASC','10',$limit_val*10);
            }
            else
            {
                $list =  $this->basemodel->fetch_records_from($this->devices->tbl_name,$where,'*',$this->devices->E_NAME);
            }
            //$data['qry'] = $this->db->last_query();

            if (!empty($list))
            {
                for ($i = 0; $i < count($list); $i++) {
                    $list[$i]['VENDOR_ID'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_VENDOR, array($this->deviceamcs->EID => $list[$i][$this->devices->ID]), $this->deviceamcs->AMC_TO, 'DESC');
                    $list[$i]['company_name'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name,$this->devicevendors->NAME,array($this->devicevendors->ID=>$list[$i][$this->devices->C_NAME]));
                    $list[$i]['VENDOR_NAME'] = $this->basemodel->get_single_column_value($this->devicevendors->tbl_name, $this->devicevendors->NAME, array($this->devicevendors->ID => $list[$i]['VENDOR_ID']));
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $list;
            }
            else {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }
    private function _get_scr_calls_new($jodata=array())
    {
        $data = $where = array();
        if(!empty($jodata))
        {
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->cms->BRANCH_ID] = $branch_id;
            $where[$this->cms->ORG_ID] = $org_id;
            $where[$this->cms->ATTENDED_BY] = $user_id;
            if ($jodata->dept_id != "")
                $where[$this->cms->CALLER_DEPT] = $jodata->dept_id;
            $where_date = "";
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->cms->CDATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            }
            else
            {
                $where[$this->cms->CDATE] = date('Y-m-d');
            }
            if (isset($jodata->limit_val))
            {
                if($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name,$where,$where_date,'count('.$this->cms->ID.') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                }
                else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }

                $list =  $this->basemodel->fetch_records_from_multi_where_pagination($this->cms->tbl_name,$where,$where_date,'*',$this->cms->ID,'ASC','10',$limit_val*10);
            }
            else
            {
                $list =  $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name,$where,$where_date,'*',$this->cms->CALLER_NAME);
            }
            if (!empty($list))
            {
                for($i=0;$i<count($list);$i++){
                    $list[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $list[$i][$this->cms->EID]));
                    $list[$i]['Attended_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$i][$this->cms->ATTENDED_BY]));
                    $list[$i]['Responded_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$i][$this->cms->RESPONDED_BY]));
                    $list[$i]['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$i][$this->cms->ASSIGNED_BY]));
                    $list[$i]['serial_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $list[$i][$this->cms->EID]));
                    $list[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$i][$this->cms->CALLER_DEPT]));
                    $list[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$i][$this->cms->BRANCH_ID]));
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $list;

            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        return $data;
    }


    private function _get_completed_bmepms_new($jodata = array())
    {
        log_message('error',print_r($jodata,TRUE));
        $data = array();
        $where_date = "";
        if (!empty($jodata) && $this->ha_content_type == $this->baseauth->appjson) {
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where = array();
            if ($jodata->schduled_type == "PMS")
            {
                $where[$this->pmsdetails->BRANCH_ID] = $branch_id;

                $where[$this->pmsdetails->ORG_ID] = $org_id;
                /*  if (isset($jodata->dept_id) && $jodata->dept_id != "")
                      $where[$this->pmsdetails->EID] = $jodata->dept_id;*/
                if ($jodata->action == "get_completed_bmepms_new") {
                    $where[$this->pmsdetails->COMPLETED_BY] = $user_id;
                }
                $where[$this->pmsdetails->PMS_ACTL_DONE . " !="] = NULL;
                if (isset($jodata->fromdate) && isset($jodata->todate) && $jodata->fromdate != "" && $jodata->todate != "")
                    $where_date = $this->pmsdetails->PMS_DUE_DATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
                if (isset($jodata->limit_val))
                {
                    if ($jodata->limit_val != '')
                        $limit_val = $jodata->limit_val;
                    else
                        $limit_val = 0;
                    $cnt = $this->basemodel->fetch_records_from_multi_where($this->pmsdetails->tbl_name, $where, $where_date, 'count(' . $this->pmsdetails->ID . ') AS CNT');
                    if (!empty($cnt)) {
                        $data['no_of_recs'] = $cnt[0]['CNT'];
                        $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                    } else {
                        $data['no_of_recs'] = 0;
                        $data['rcnt'] = 0;
                    }
                    $cpms_data = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->pmsdetails->tbl_name, $where, $where_date, '', '', '', '', '*', $this->pmsdetails->PMS_DONE, 'desc', '10', $limit_val * 10);
                }
                else
                {
                    $cpms_data = $this->basemodel->fetch_records_from_multi_where($this->pmsdetails->tbl_name, $where, $where_date, '*', $this->pmsdetails->PMS_DONE, 'desc');
                }
                if (!empty($cpms_data)) {
                    $data['completed_pms'] = $this->baselibrary->scheduled_pms_details($cpms_data);
                    $data['response'] = SUCCESSDATA;
                } else {
                    $data['response'] = EMPTYDATA;
                }
                //return $data;
            }

            else if($jodata->schduled_type == "Calibration")
            {
                if ($jodata->action == "get_completed_bmepms_new")
                {
                    $where[$this->qcdetails->COMPLETED_BY] = $user_id;

                }
                $where[$this->qcdetails->QC_ACTL_DONE. " !="] = NULL;
                $where[$this->qcdetails->ORG_ID] = $org_id;
                $where[$this->qcdetails->BRANCH_ID] = $branch_id;
                if (isset($jodata->fromdate) && isset($jodata->todate) && $jodata->fromdate != "" && $jodata->todate != "")
                    $where_date = $this->qcdetails->QC_DUE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
                if (isset($jodata->limit_val)) {
                    if ($jodata->limit_val != '')
                        $limit_val = $jodata->limit_val;
                    else
                        $limit_val = 0;
                    $cnt = $this->basemodel->fetch_records_from_multi_where($this->qcdetails->tbl_name, $where, $where_date, 'count(' . $this->qcdetails->ID . ') AS CNT');
                    if (!empty($cnt)) {
                        $data['no_of_recs'] = $cnt[0]['CNT'];
                        $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                    } else {
                        $data['no_of_recs'] = 0;
                        $data['rcnt'] = 0;
                    }
                    $cqc_data = $this->basemodel->awesome_fetch_records_from_multi_where_pagination($this->qcdetails->tbl_name, $where, $where_date, '', '', '', '', '*', $this->qcdetails->QC_DONE, 'desc', '10', $limit_val * 10);
                } else {
                    $cqc_data = $this->basemodel->fetch_records_from_multi_where($this->qcdetails->tbl_name, $where, $where_date, '*', $this->qcdetails->QC_DONE, 'desc');
                }
                if (!empty($cqc_data)) {
                    $data['completed_qc'] = $this->baselibrary->scheduled_qc_details($cqc_data);
                    $data['response'] = SUCCESSDATA;
                } else {
                    $data['response'] = NULL;
                }

            }
        }
        return $data;
    }

    private function _get_generated_calls_new($jodata=array())
    {
        $data = array();
        $where = array();
        if(!empty($jodata))
        {
            $qry = "";
            $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $emp_no = isset($jodata->emp_no) ? $jodata->emp_no : $this->session->emp_no;
            $where[$this->cms->BRANCH_ID] = $branch_id;
            $where[$this->cms->ORG_ID] = $org_id;
            $where[$this->cms->CEMP_ID] = $emp_no;
            if (isset($jodata->dept_id)&& $jodata->dept_id !='')
                $where[$this->cms->CALLER_DEPT] = $jodata->dept_id;
            $where_date = "";
            if (isset($jodata->fromdate) && $jodata->fromdate != "" && isset($jodata->todate) && $jodata->todate != "")
            {
                $where_date = $this->cms->CDATE . " BETWEEN '" . date('Y-m-d', strtotime($jodata->fromdate)) . "' AND '" . date('Y-m-d', strtotime($jodata->todate)) . "'";
            }
            else
            {
                $where[$this->cms->CDATE] = date('Y-m-d');
            }
            if (isset($jodata->limit_val))
            {
                if($jodata->limit_val != '')
                    $limit_val = $jodata->limit_val;
                else
                    $limit_val = 0;
                $cnt = $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name,$where,$where_date,'count('.$this->cms->ID.') AS CNT');
                if (!empty($cnt)) {
                    $data['no_of_recs'] = $cnt[0]['CNT'];
                    $data['rcnt'] = ceil($cnt[0]['CNT'] / 10);
                }
                else {
                    $data['no_of_recs'] = 0;
                    $data['rcnt'] = 0;
                }

                $list =  $this->basemodel->fetch_records_from_multi_where_pagination($this->cms->tbl_name,$where,$where_date,'*',$this->cms->ID,'DESC','10',$limit_val*10);
            }
            else
            {
                $list =  $this->basemodel->fetch_records_from_multi_where($this->cms->tbl_name,$where,$where_date,'*',$this->cms->ID,'DESC');
            }
            // $data['qry']=$this->db->last_query();
            if (!empty($list))
            {
                for($i=0;$i<count($list);$i++)
                {
                    $list[$i]['equp_name'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->E_NAME, array($this->devices->E_ID => $list[$i][$this->cms->EID]));
                    $list[$i]['Attended_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$i][$this->cms->ATTENDED_BY]));
                    $list[$i]['Responded_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$i][$this->cms->RESPONDED_BY]));
                    $list[$i]['assigned_by'] = $this->basemodel->get_single_column_value($this->users->tbl_name, $this->users->USER_NAME, array($this->users->USER_ID => $list[$i][$this->cms->ASSIGNED_BY]));
                    $list[$i]['serial_number'] = $this->basemodel->get_single_column_value($this->devices->tbl_name, $this->devices->ES_NUMBER, array($this->devices->E_ID => $list[$i][$this->cms->EID]));
                    $list[$i]['contract_type'] = $this->basemodel->get_single_column_value($this->deviceamcs->tbl_name, $this->deviceamcs->AMC_TYPE, array($this->deviceamcs->EID
                    => $list[$i][$this->cms->EID]));
                    $list[$i]['department'] = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $list[$i][$this->cms->CALLER_DEPT]));
                    $list[$i]['branch_name'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $list[$i][$this->cms->BRANCH_ID]));
                }
                $data['response'] = SUCCESSDATA;
                $data['list'] = $list;
            }
            else
            {
                $data['response'] = EMPTYDATA;
                $data['list'] = null;
            }
        }
        // print_r($data);
        return $data;
    }
    private function _get_mytrans_call_counts_new($jodata)
    {
        $data = array();
        $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
        $emp_no = isset($jodata->emp_no) ? $jodata->emp_no : $this->session->emp_no;
        if (!empty($jodata))
        {
            $t_orwhere = '';
            $where[$this->cms->TO_ADVERSE] = NULL;
            $where[$this->cms->ORG_ID] = $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
            $role_code = isset($jodata->role_code) ? $jodata->role_code : $this->session->role_code;
            $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
            if($role_code!=HMADMIN)
            {
                $where[$this->cms->BRANCH_ID] = $branch_id;
                $cn_where[$this->condemnation->BRANCH_ID] = $branch_id;
                $t_orwhere = "(".$this->transfer->BRANCH_ID."='".$branch_id."' OR ". $this->transfer->TRANSFER_BRANCH."='".$branch_id."')";
                $cmpms_where[$this->pmsdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $cmqcwhere[$this->qcdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $qcwhere[$this->qcdetails->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $aiwhere[$this->incedents->BRANCH_ID] = $where[$this->cms->BRANCH_ID];
                $rlwhere[$this->rounds_assigned->BRANCH_ID] = $branch_id;
            }
            $user_id = isset($jodata->user_id) ? $jodata->user_id : $this->session->user_id;
            $where[$this->cms->CEMP_ID] = $emp_no;
            $data['generated_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);
            unset($where[$this->cms->CEMP_ID]);
            $where[$this->cms->STATUS] = DW;
            $where[$this->cms->ATTENDED_BY] = $user_id;
            $data['non_sheduled_calls_cnt'] = $this->basemodel->num_of_res($this->cms->tbl_name,$where);

            /*completed pms*/
            $cmpms_where[$this->pmsdetails->ORG_ID] = $where[$this->cms->ORG_ID];
            $cmpms_where[$this->pmsdetails->COMPLETED_BY] =  $user_id;
            //$cmpms_where[$this->pmsdetails->PMS_ACTL_DONE] =  date('Y-m-d');
            $data['completed_pms_call_count'] = $this->basemodel->num_of_res($this->pmsdetails->tbl_name,$cmpms_where);
            /*completed qc*/
            $cmqcwhere[$this->qcdetails->ORG_ID] = $where[$this->cms->ORG_ID];
            $cmqcwhere[$this->qcdetails->COMPLETED_BY." !="] =  NULL;
            //$cmqcwhere[$this->qcdetails->QC_ACTL_DONE] =  date('Y-m-d');
            $cmqcwhere[$this->qcdetails->COMPLETED_BY] = $user_id;
            $data['completed_qcs_call'] = $this->basemodel->num_of_res($this->qcdetails->tbl_name,$cmqcwhere);

            $data['scheduled_call_cnt'] = $data['completed_qcs_call']+$data['completed_pms_call_count'];

            /*compelted rouds*/
            $cround_where[$this->rounds->ORG_ID] = $org_id;
            $cround_where[$this->rounds->BRANCH_ID] = $branch_id;
            $cround_where[$this->rounds->USERNAME] = $user_id;
            $cround_where[$this->rounds->END_TIME." !="] = NULL;
            $data['completed_rounds_cnt'] = $this->basemodel->num_of_res($this->rounds->tbl_name, $cround_where);

            /* completed adverse incidents */
            $aiwhere[$this->incedents->COMPLETED_BY] =  $user_id;
            $aiwhere[$this->incedents->ACTION_TACKEN." !="] = NULL;
            //$ailike[$this->incedents->COMPLETED_ON] = date('Y-m-d');
            $data['completed_adverse_calls'] = $this->basemodel->num_of_res($this->incedents->tbl_name, $aiwhere,'','','');
            //$data['adc_qry'] = $this->db->last_query();

            /* completed transfer count */
            $twhere[$this->transfer->ORG_ID] = $org_id;
            $twhere[$this->transfer->BRANCH_ID] = $branch_id;
            $twhere[$this->transfer->DEPLOYMENT_ID." !="] = NULL;
            $twhere[$this->transfer->ADDED_BY] = $user_id;
            $data['transfers_cnt'] = $this->basemodel->num_of_res($this->transfer->tbl_name, $twhere,$t_orwhere);

            /* completed condemnation count */
            $cn_where[$this->condemnation->ORG_ID] = $org_id;
            $cn_where[$this->condemnation->RESOLD_VALUE." !="] = NULL;
            $cn_where[$this->condemnation->UPDATED_BY] = $user_id;
            $data['completed_condemnation_cnt'] = $this->basemodel->num_of_res($this->condemnation->tbl_name, $cn_where);

            /*device installations*/
            $di_where[$this->devices->USERNAME] = $user_id;
            $di_where[$this->devices->BRANCH_ID] = $branch_id;
            $di_where[$this->devices->ORG_ID] = $org_id;
            $di_where[$this->devices->E_ID." !="] = NULL;
            $data['installs_cnt'] = $this->basemodel->num_of_res($this->devices->tbl_name, $di_where);

            /* gatepass */
            $gp_where[$this->gatepass->ADDED_BY] = $user_id;
            $gp_where[$this->gatepass->BRANCH_ID] = $branch_id;
            $gp_where[$this->gatepass->ORG_ID] = $org_id;
            $data['gatepass_cnt'] = $this->basemodel->num_of_res($this->gatepass->tbl_name, $gp_where);

            /* contracts */
            $mc_where[$this->deviceamcs->ADDED_BY] = $user_id;
            $mc_where[$this->deviceamcs->BRANCH_ID] = $branch_id;
            $mc_where[$this->deviceamcs->ORG_ID] = $org_id;
            $data['contracts_cnt'] = $this->basemodel->num_of_res($this->deviceamcs->tbl_name, $mc_where);

            /* viability*/
            $vi_where[$this->viability->ADDED_BY] = $user_id;
            $vi_where[$this->viability->BRANCH_ID] = $branch_id;
            $vi_where[$this->viability->ORG_ID] = $org_id;
            $data['viability_cnt'] = $this->basemodel->num_of_res($this->viability->tbl_name, $vi_where);

            /* CEAR*/
            $cear_where[$this->cear->ADDED_BY] = $user_id;
            $cear_where[$this->cear->BRANCH_ID] = $branch_id;
            $cear_where[$this->cear->ORG_ID] = $org_id;
            $cear_where[$this->cear->COMPETED_ON." !="] = NULL;
            $data['cear_cnt'] = $this->basemodel->num_of_res($this->cear->tbl_name, $cear_where);

            /* CEAR*/
            $ind_where[$this->indents->ADDED_BY] = $user_id;
            $ind_where[$this->indents->BRANCH_ID] = $branch_id;
            $ind_where[$this->indents->ORG_ID] = $org_id;
            $ind_where[$this->indents->SANCTIONED_BY." !="] = NULL;
            $data['indent_cnt'] = $this->basemodel->num_of_res($this->indents->tbl_name, $ind_where);
        }
        return $data;
    }
    private function _get_org_devices_cnt($jodata=array())
    {
        $data = array();

        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $data['od_cnt'] = $this->basemodel->num_of_res($this->devices->tbl_name,array($this->devices->ORG_ID=>$org_id));
        $data['od_value'] = (int)$this->basemodel->get_single_column_value($this->organizations->tbl_name,$this->organizations->NO_OF_EQUPIMENTS,array($this->organizations->ORG_ID=>$org_id));
        return $data;
    }

    public function  assign_vendor_device(){

        if(isset($_POST['device_data'])) {

            $data = array();
            $jodata = json_decode($_POST['device_data']);
            $branch_id = isset($jodata->ebranch_id) ? $jodata->ebranch_id : $this->session->branch_id;
            $org_id = isset($jodata->eorg_id) ? $jodata->eorg_id : $this->session->org_id;
            $udata[$this->devices->ORG_ID] = $org_id;
            /*   if($branch_id = 'All')
               {
                   =[$this->devices->BRANCH_ID]. 'IN' .BRANCHALL;
               }*/
            $udata[$this->devices->BRANCH_ID] = $branch_id;
            $udata[$this->devices->DEPT_ID] = $jodata->DEPT_ID;
            $udata[$this->devices->E_NAME] = $jodata->E_NAME;
            $udata[$this->devices->E_CAT] = $jodata->E_CAT;
            $cat = $this->basemodel->get_single_column_value($this->devicenames->tbl_name, $this->devicenames->CODE, array($this->devicenames->ID => $udata[$this->devices->E_CAT]));
            $udata[$this->devices->C_NAME] = $jodata->C_NAME;
            $udata[$this->devices->E_MODEL] = $jodata->E_MODEL;
            $udata[$this->devices->ES_NUMBER] = $jodata->ES_NUMBER;
            $udata[$this->devices->E_COST] = $jodata->E_COST;
            $udata[$this->devices->E_COND] = $jodata->E_COND;
            $udata[$this->devices->UTILIZATION] = $jodata->UTILIZATION;
            $udata[$this->devices->EQ_CLASS] = $jodata->EQ_CLASS;
            $udata[$this->devices->EQ_CONDATION] = $jodata->EQ_CONDATION;
            $udata[$this->devices->ACCSSORIES] = $jodata->ACCSSORIES;
            $udata[$this->devices->CRITICAL_SPARES] = $jodata->CRITICAL_SPARES;
            $udata[$this->devices->E_TYPE] = $jodata->E_TYPE;
            $udata[$this->devices->PHY_LOCATION] = $jodata->PHY_LOCATION;
            $udata[$this->devices->BD_COST] = $jodata->BD_COST;
            $udata[$this->devices->PONO] = $jodata->PONO;
            $udata[$this->devices->BD_COUNT] = $jodata->BD_COUNT;
            $pmsdate = isset($jodata->pms_date) ? date('Y-m-d', strtotime($jodata->pms_date)) : NULL;
            $qcdate = isset($jodata->qc_date) ? date('Y-m-d', strtotime($jodata->qc_date)) : NULL;
            if (isset($jodata->GRN_DATE) && $jodata->GRN_DATE != null)
                $udata[$this->devices->GRN_DATE] = date('Y-m-d', strtotime($jodata->GRN_DATE));
            else
                $udata[$this->devices->GRN_DATE] = NULL;

            if (isset($jodata->LB_DATE) && $jodata->LB_DATE != null)
                $udata[$this->devices->LB_DATE] = date('Y-m-d', strtotime($jodata->LB_DATE));
            else
                $udata[$this->devices->LB_DATE] = NULL;
            $udata[$this->devices->GRN_VALUE] = $jodata->GRN_VALUE;

            if (isset($jodata->DATEOF_INSTALL) && $jodata->DATEOF_INSTALL != null)
                $udata[$this->devices->DATEOF_INSTALL] = date('Y-m-d', strtotime($jodata->DATEOF_INSTALL));
            else
                $udata[$this->devices->DATEOF_INSTALL] = NULL;

           /* if (isset($jodata->MF_DATE) && $jodata->MF_DATE != NULL) {
                $manufacture_date1 = $jodata->MF_DATE;
                $manf_date = explode("-", $manufacture_date1);
                if ($manf_date[0] > 12 || $manf_date[1] > date('Y')) {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Invalid Manufacture Date";
                    print_r(json_encode($data));
                    return $data;
                }
            } else {
                $manufacture_date1 = NULL;
            }*/
            if (isset($jodata->END_OF_LIFE) && $jodata->END_OF_LIFE != NULL) {
                $eol = $jodata->END_OF_LIFE;
                $eol_ary = explode("-", $eol);
                if ($eol_ary[0] > 12) {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Invalid End of Life Date";
                    print_r(json_encode($data));
                    return $data;
                }
            } else {
                $eol = NULL;
            }
            if (isset($jodata->END_OF_SUPPORT) && $jodata->END_OF_SUPPORT != NULL) {
                $eos = $jodata->END_OF_SUPPORT;
                $eos_ary = explode("-", $eos);
                if ($eos_ary[0] > 12) {
                    $data['response'] = FAILEDATA;
                    $data['call_back'] = "Invalid End of Support Date";
                    print_r(json_encode($data));
                    return $data;
                }
            } else {
                $eos = NULL;
            }
            $udata[$this->devices->MF_DATE] = $jodata->MF_DATE;
            $udata[$this->devices->END_OF_LIFE] = $eol;
            $udata[$this->devices->END_OF_SUPPORT] = $eos;
            $udata[$this->devices->DISTRIBUTOR] = $jodata->DISTRIBUTOR;
            $udata[$this->devices->HOSPITAL_ASSET_CODE] = $jodata->HOSPITAL_ASSET_CODE;
            $udata[$this->devices->REMARKS] = isset($jodata->REMARKS) ? $jodata->REMARKS : NULL;
            $udata[$this->devices->DESC_P] = isset($jodata->DESC_P) ? $jodata->DESC_P : NULL;

            $wdata[$this->devices->ID] = $jodata->ID;

            /* contract */
            if (isset($jodata->AMC_FROM) && $jodata->AMC_FROM != '')
                $damcdata[$this->deviceamcs->AMC_FROM] = date('Y-m-d', strtotime($jodata->AMC_FROM));
            if (isset($jodata->AMC_TO) && $jodata->AMC_TO != '')
                $damcdata[$this->deviceamcs->AMC_TO] = date('Y-m-d', strtotime($jodata->AMC_TO));
            $damcdata[$this->deviceamcs->AMC_TYPE] = $jodata->AMC_TYPE;
            $damcdata[$this->deviceamcs->AMC_VALUE] = isset($jodata->AMC_VALUE) ? $jodata->AMC_VALUE : NULL;
            $damcdata[$this->deviceamcs->AMC_VENDOR] = $jodata->VENDOR;
            if ($jodata->AMC_ID == 'new') {
                $damcdata[$this->deviceamcs->EID] = $jodata->E_ID;
                $damcdata[$this->deviceamcs->ORG_ID] = $jodata->ORG_ID;
                $damcdata[$this->deviceamcs->BRANCH_ID] = $jodata->BRANCH_ID;
                $damcdata[$this->deviceamcs->ADDED_ON] = date('Y-m-d');
                $damcdata[$this->deviceamcs->ADDED_BY] = $this->session->user_id;
                $damcdata[$this->deviceamcs->REMARKS] = 'added updating device details';
                if (isset($jodata->AMC_TYPE) && $jodata->AMC_TYPE != '') {
                    if ($this->basemodel->insert_into_table($this->deviceamcs->tbl_name, $damcdata)) {
                        $data['amc_inserted'] = SUCCESSDATA;
                    } else
                        $data['amc_inserted'] = FAILEDATA;
                }
            } else {
                $wamcupdate[$this->deviceamcs->ID] = $jodata->AMC_ID;
                $this->basemodel->update_operation($damcdata, $this->deviceamcs->tbl_name, $wamcupdate);
            }

            /* breakdown */
            if (isset($jodata->last_breakdown_date)) {
                $udata[$this->dbrkdwns->BD_DATETIME] = date('Y-m-d', strtotime($jodata->last_breakdown_date));
                $udata[$this->dbrkdwns->BD_COST] = $jodata->BD_COST;
                $udata[$this->devices->BD_COUNT] = $jodata->BD_COUNT;
            }

            $branch_dtls = $this->basemodel->fetch_single_row($this->branches->tbl_name, array($this->branches->BRANCH_ID => $branch_id));
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
                // given array. 3 and 6 are missing.
                //$arr1 = array(1,2,4,5,7);
                // construct a new array:1,2....max(given array).
                $arr2 = range(1, max($devicenumbers));
                // use array_diff to get the missing elements
                $missing = array_diff($arr2, $devicenumbers); // (3,6)

                if (count($missing) < 0) {
                    reset($missing);  // to get first value
                    $number = (int)key($missing);
                } else {
                    $device = $devices[0];
                    $eid = $device[$this->devices->E_ID];
                    $data['last_equp'] = $eid;
                    $number_array = explode("-", $eid);
                    $number = end($number_array);
                    $number = (int)$number;
                    $number = $number;
                }
            } else
                $number = 1;
            $elast_id = sprintf('%04d', $number);

            $main_device_id = $branch_dtls[$this->branches->CITY] . "-" . "BME" . "-" . date('my', strtotime($udata[$this->devices->DATEOF_INSTALL])) . "-" . $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $udata[$this->devices->DEPT_ID] . "-" . $cat . "-" . $elast_id;
            $udata[$this->devices->E_ID] = $main_device_id;
            $udata[$this->devices->QR_CODE] = QR_URL . $udata[$this->devices->E_ID];

            if ($this->basemodel->update_operation($udata, $this->devices->tbl_name, $wdata)) {

                $device_id = $main_device_id;
                $device_insert = true;
                $response['device_id'] = $device_id;
                $response['response'] = SUCCESSDATA;

                if (empty($check_dept_exists_for_round)) {
                    $response['users_rounds'] = $this->baselibrary->assign_round_new_dept($this->session->org_id, $branch_id, $jodata->DEPT_ID);
                }
                $response['call_back'] = $response['device_id'] . " Equipment Details Saved";

                if ($org_id != $jodata->ORG_ID) {


                    /*   if (isset($jodata->MF_DATE)) {
                           $manufacture_date1 = $jodata->MF_DATE;
                           $manf_date = explode("-", $manufacture_date1);
                           if ($manf_date[0] > 12 || $manf_date[1] > date('Y')) {
                               $data['device_response'] = FAILEDATA;
                               $data['call_back'] = "Invalid Manufacture Date";
                               print_r(json_encode($data));
                               return $data;
                           }
                       } else {
                           $manufacture_date1 = NULL;
                       }
                       if (isset($jodata->END_OF_LIFE)) {
                           $eol = $jodata->END_OF_LIFE;
                           $eol_ary = explode("-", $eol);
                           if ($eol_ary[0] > 12) {
                               $data['device_response'] = FAILEDATA;
                               $data['call_back'] = "Invalid End of Life Date";
                               print_r(json_encode($data));
                               return $data;
                           }
                       } else {
                           $eol = NULL;
                       }
                       if (isset($jodata->END_OF_SUPPORT)) {
                           $eos = $jodata->END_OF_SUPPORT;
                           $eos_ary = explode("-", $eos);
                           if ($eos_ary[0] > 12) {
                               $data['device_response'] = FAILEDATA;
                               $data['call_back'] = "Invalid End of Support Date";
                               print_r(json_encode($data));
                               return $data;
                           }
                       } else {
                           $eos = NULL;
                       }*/
                    $insert_device[$this->devices->MF_DATE] = $jodata->MF_DATE;
                    $insert_device[$this->devices->END_OF_LIFE] = $eol;
                    $insert_device[$this->devices->END_OF_SUPPORT] = $eos;
                    $insert_device[$this->devices->DEPT_ID] = $jodata->DEPT_ID;
                    $insert_device[$this->devices->GENERAL_ASSET] = NOSTATE;
                    $podate1 = date('Y-m-d', strtotime($jodata->PDATE));

                    $pmsdate = isset($jodata->pms_date) ? date('Y-m-d', strtotime($jodata->pms_date)) : NULL;
                    $qcdate = isset($jodata->qc_date) ? date('Y-m-d', strtotime($jodata->qc_date)) : NULL;

                    $insert_device[$this->devices->HOSPITAL_ASSET_CODE] = isset($jodata->HOSPITAL_ASSET_CODE) ? $jodata->HOSPITAL_ASSET_CODE : NULL;
                    if (isset($jodata->DATEOF_INSTALL)) {
                        $date_of_install1 = date('Y-m-d', strtotime($jodata->DATEOF_INSTALL));
                        $insert_device[$this->devices->DATEOF_INSTALL] = $date_of_install1;
                    }

                    if (isset($jodata->GRN_DATE) && $jodata->GRN_DATE != '')
                        $insert_device[$this->devices->GRN_DATE] = date('Y-m-d', strtotime($jodata->GRN_DATE));

                    if (isset($jodata->GRN_VALUE) && $jodata->GRN_VALUE != '')
                        $insert_device[$this->devices->GRN_VALUE] = $jodata->GRN_VALUE;

                    /* contract */

                    if (isset($jodata->AMC_FROM) && $jodata->AMC_FROM != null)
                        $insert_amc[$this->deviceamcs->AMC_FROM] = date('Y-m-d', strtotime($jodata->AMC_FROM));
                    if (isset($jodata->AMC_TO) && $jodata->AMC_TO != null)
                        $insert_amc[$this->deviceamcs->AMC_TO] = date('Y-m-d', strtotime($jodata->AMC_TO));
                    $insert_amc[$this->deviceamcs->AMC_TYPE] = $jodata->AMC_TYPE;
                    $insert_amc[$this->deviceamcs->AMC_VALUE] = isset($jodata->AMC_VALUE) ? $jodata->AMC_VALUE : NULL;
                    $insert_amc[$this->deviceamcs->AMC_VENDOR] = isset($jodata->VENDOR) ? $jodata->VENDOR : NULL;

                    /* breakdown */
                    if (isset($jodata->last_breakdown_date)) {
                        $insrt_bd[$this->dbrkdwns->BD_DATETIME] = date('Y-m-d', strtotime($jodata->last_breakdown_date));
                        $insrt_bd[$this->dbrkdwns->BD_COST] = $jodata->break_down_cost;
                        $insrt_bd[$this->devices->LB_DATE] = date('Y-m-d', strtotime($jodata->last_breakdown_date));
                        $insert_device[$this->devices->BD_COST] = $jodata->break_down_cost;
                        $insert_device[$this->devices->BD_COUNT] = $jodata->break_down_count;
                    }


                    //    $branch_id = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
                    //  $org_id = isset($jodata->orgid) ? $jodata->orgid : $this->session->org_id;
                    $insert_device[$this->devices->PDATE] = $podate1;
                    $insert_device[$this->devices->DISTRIBUTOR] = $jodata->DISTRIBUTOR;
                    $insert_device[$this->devices->ORG_ID] = $jodata->ORG_ID;
                    $insert_device[$this->devices->BRANCH_ID] = $jodata->BRANCH_ID;
                    $insert_device[$this->devices->USERNAME] = $this->session->user_id;
                    $insert_device[$this->devices->E_COND] = $jodata->E_COND;
                    $insert_device[$this->devices->DESC_P] = $jodata->DESC_P;
                    $insert_device[$this->devices->EQ_CLASS] = $jodata->EQ_CLASS;
                    $insert_device[$this->devices->C_NAME] = $jodata->C_NAME;
                    $insert_device[$this->devices->E_NAME] = $jodata->E_NAME;
                    $insert_device[$this->devices->E_CAT] = $jodata->E_CAT;
                    $cat = $this->basemodel->get_single_column_value($this->devicenames->tbl_name, $this->devicenames->CODE, array($this->devicenames->ID => $insert_device[$this->devices->E_CAT]));
                    $insert_device[$this->devices->E_COST] = $jodata->E_COST;
                    $insert_device[$this->devices->E_TYPE] = $jodata->E_TYPE;
                    $insert_device[$this->devices->E_MODEL] = $jodata->E_MODEL;
                    $insert_device[$this->devices->ACCSSORIES] = $jodata->ACCSSORIES;
                    $insert_device[$this->devices->CRITICAL_SPARES] = $jodata->CRITICAL_SPARES;
                    if (isset($jodata->phy_location) && $jodata->phy_location != '')
                        $insert_device[$this->devices->PHY_LOCATION] = $jodata->PHY_LOCATION;
                    $insert_device[$this->devices->PONO] = $jodata->PONO;
                    $insert_device[$this->devices->REMARKS] = $jodata->REMARKS;
                    $insert_device[$this->devices->ES_NUMBER] = $jodata->ES_NUMBER;
                    $insert_device[$this->devices->EQ_CONDATION] = $jodata->EQ_CONDATION;
                    $insert_device[$this->devices->UTILIZATION] = $jodata->UTILIZATION;

                    /* device Id gen. */
                    $branch_dtls = $this->basemodel->fetch_single_row($this->branches->tbl_name, array($this->branches->BRANCH_ID => $jodata->BRANCH_ID));
                    $qry = "SELECT " . $this->devices->E_ID . " FROM " . $this->db->dbprefix($this->devices->tbl_name) . " WHERE " .
                        $this->devices->ORG_ID . " = '" . $jodata->ORG_ID . "' AND " . $this->devices->E_ID . " LIKE '" .
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
                        // given array. 3 and 6 are missing.
                        //$arr1 = array(1,2,4,5,7);
                        // construct a new array:1,2....max(given array).
                        $arr2 = range(1, max($devicenumbers));
                        // use array_diff to get the missing elements
                        $missing = array_diff($arr2, $devicenumbers); // (3,6)

                        if (count($missing) < 0) {
                            reset($missing);  // to get first value
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

                    $main_device_id = $branch_dtls[$this->branches->CITY] . "-" . "BME" . "-" . date('my', strtotime($insert_device[$this->devices->DATEOF_INSTALL])) . "-" . $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_device[$this->devices->DEPT_ID] . "-" . $cat . "-" . $elast_id;
                    $insert_device[$this->devices->E_ID] = $main_device_id;
                    $inset_device[$this->devices->QR_CODE] = QR_URL . $insert_device[$this->devices->E_ID];
                    $insert_device[$this->devices->ASSIGN_ID] = $udata[$this->devices->E_ID];


                    /* Device Id Gen. End */
                    $check_dept_exists_for_round = $this->basemodel->fetch_single_row($this->devices->tbl_name, array($this->devices->DEPT_ID => $jodata->department, $this->devices->BRANCH_ID => $branch_id, $this->devices->ORG_ID => $org_id), $this->devices->DEPT_ID);


                    if ($this->basemodel->insert_into_table($this->devices->tbl_name, $insert_device)) {


                        $device_id = $main_device_id;
                        $device_insert = true;
                        $response['device_id'] = $device_id;
                        $response['response'] = SUCCESSDATA;
                        if (empty($check_dept_exists_for_round)) {
                            $response['users_rounds'] = $this->baselibrary->assign_round_new_dept($this->session->org_id, $branch_id, $jodata->department);
                        }
                        //  $response['call_back'] = $response['device_id'] . " Equipment Details Saved";
                        //$sess_org = isset($device_data->orgid) ? $device_data->orgid : $this->session->org_id;
                        if ($jodata->ORG_ID != $org_id) // new org != current org
                        {

                            $main_device_id = $branch_dtls[$this->branches->CITY] . "-" . "BME" . "-" . date('my', strtotime($insert_device[$this->devices->DATEOF_INSTALL])) . "-" . $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_device[$this->devices->DEPT_ID] . "-" . $cat . "-" . $elast_id;
                            $update_device[$this->devices->ASSIGN_ID] = $main_device_id;
                            $this->basemodel->update_operation($update_device, $this->devices->tbl_name, $wdata);

                        }

                        // assign -> update current eqid with current (org + branch) + generate neweqpid with selected (org + branch) ->
                        // update new eqid with exeing eqid at assign column

                    } else {
                        $device_insert = false;
                        $response['response'] = FAILEDATA;
                        $response['call_back'] = "Unable to Process Your Request Try again";
                    }

                    if ($device_insert) {

                        /* insert device breakdown table */
                        if (isset($device_data->last_breakdown_date)) {
                            $insrt_bd[$this->dbrkdwns->ORG_ID] = $insert_device[$this->devices->ORG_ID];
                            $insrt_bd[$this->dbrkdwns->BRANCH_ID] = $insert_device[$this->devices->BRANCH_ID];
                            $insrt_bd[$this->dbrkdwns->EID] = $device_id;
                            $insrt_bd[$this->dbrkdwns->ADDED_BY] = $insert_device[$this->devices->USERNAME];
                            $insrt_bd[$this->dbrkdwns->ADDED_ON] = date('Y-m-d H:i:s');
                            $this->basemodel->insert_into_table($this->dbrkdwns->tbl_name, $insrt_bd);
                        }
                        /* insert amc table */
                        $insert_amc[$this->deviceamcs->ORG_ID] = $insert_device[$this->devices->ORG_ID];
                        $insert_amc[$this->deviceamcs->BRANCH_ID] = $insert_device[$this->devices->BRANCH_ID];
                        $insert_amc[$this->deviceamcs->EID] = $device_id;
                        $insert_amc[$this->deviceamcs->ADDED_BY] = $insert_device[$this->devices->USERNAME];
                        $insert_amc[$this->deviceamcs->ADDED_ON] = date('Y-m-d H:i:s');
                        $this->basemodel->insert_into_table($this->deviceamcs->tbl_name, $insert_amc);

                        if ($insert_device[$this->devices->GENERAL_ASSET] == YESSTATE) {
                            /* insert pms */
                            $pmsval = 30 * (12 / $jodata->no_of_pms);
                            if ($pmsdate != '') {
                                $pmsdue = date('Y-m-d', strtotime($pmsdate . " + $pmsval days"));
                                $insert_pms[$this->pmsdetails->PMS_COUNT] = $jodata->no_of_pms;
                                $insert_pms[$this->pmsdetails->ORG_ID] = $org_id;
                                $insert_pms[$this->pmsdetails->EID] = $device_id;
                                $insert_pms[$this->pmsdetails->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
                                $insert_pms[$this->pmsdetails->PMS_DONE] = $pmsdate;
                                $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                                $insert_pms[$this->pmsdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_amc[$this->deviceamcs->AMC_TYPE][0] . "P-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->pmsdetails->tbl_name, $this->pmsdetails->ID));
                                if ($this->basemodel->insert_into_table($this->pmsdetails->tbl_name, $insert_pms)) {
                                    $pms_insert = true;
                                    $response['pms_response'] = SUCCESSDATA;
                                } else {
                                    $response['pms_response'] = FAILEDATA;
                                }
                            }

                            /* inser qc */
                            $ym = $jodata->no_of_qcs_ym;
                            if ($ym == 'Month')
                                $qcval = 30 * (12 / $jodata->no_of_qcs);
                            else if ($ym == 'Year')
                                $qcval = ceil(365 * (1 / $jodata->no_of_qcs));
                            if ($qcdate != '') {
                                $qcdue = date('Y-m-d', strtotime($qcdate . " + $qcval days"));
                                $insert_qc[$this->qcdetails->QC_COUNT_TYPE] = $jodata->no_of_qcs_ym;
                                $insert_qc[$this->qcdetails->QC_COUNT] = $jodata->no_of_qcs;
                                $insert_qc[$this->qcdetails->ORG_ID] = $org_id;
                                $insert_qc[$this->qcdetails->EID] = $device_id;
                                $insert_qc[$this->qcdetails->BRANCH_ID] = isset($jodata->branch_id) ? $jodata->branch_id : $this->session->branch_id;
                                $insert_qc[$this->qcdetails->QC_DONE] = $qcdate;
                                $insert_qc[$this->qcdetails->QC_DUE] = $qcdue;
                                $insert_pms[$this->qcdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_amc[$this->deviceamcs->AMC_TYPE][0] . "Q-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->qcdetails->tbl_name, $this->qcdetails->ID));
                                if ($this->basemodel->insert_into_table($this->qcdetails->tbl_name, $insert_qc)) {
                                    $qc_insert = true;
                                    $response['qc_response'] = SUCCESSDATA;
                                } else {
                                    $response['qc_response'] = FAILEDATA;
                                }
                            }
                        }
                        if (isset($device_id)) {
                            if (count($_FILES) > 0) {
                                $uploaded = $not_uploaded = 0;
                                $upload_device_folder = isset($jodata->PONO) ? $jodata->PONO : $jodata->ES_NUMBER;
                                for ($f = 0; $f < count($_FILES); $f++) {
                                    $f_type = explode(".", $_FILES[$f]['name']);
                                    $last_in = (count($f_type) - 1);
                                    $config['upload_path'] = DEVICE_UPLOAD_PATH . $upload_device_folder;
                                    $config['allowed_types'] = '*';
                                    $time = time();
                                    $config['file_name'] = $f_type[0] . "_" . $time;
                                    if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                                    $this->load->library('upload', $config);
                                    $this->upload->initialize($config);
                                    if ($this->upload->do_upload($f))
                                        $uploaded++;
                                    else {
                                        $not_uploaded++;
                                        $response['uploaded_files_errors'][] = $this->upload->display_errors();
                                    }
                                }
                                $response['uploaded_files'] = $uploaded;
                                $response['not_uploaded_files'] = $not_uploaded;
                                $this->basemodel->update_operation(array($this->devices->UPLOAD_PATH => $upload_device_folder), $this->devices->tbl_name, array($this->devices->ID => $device_id));
                            }
                        }

                        $date = date('Y-m-d H:i:s');
                        $curenttime = date('H:i:s');
                        $curentdate = date('Y-m-d');
                        $desc = $device_id . " Record is Inserted Manually by " . $this->session->user_name;
                        $response['status_response'] = $this->baselibrary->equipment_status_tbl_insert($device_id, $jodata->company_name, $jodata->device_status, $date);
                        $response['calllog_response'] = $this->baselibrary->insert_calllog($this->session->user_name, $desc, $curentdate, $curenttime, $date, $org_id, $branch_id);

                    }


                } else {
                    $response['response'] = FAILEDATA;
                    //$response['qry'] = json_encode($device_limit_check);
                    $response['call_back'] = "Devices Limit Completed Alredy";
                }


            } else {
                $device_insert = false;
                $response['response'] = FAILEDATA;
                $response['call_back'] = "Unable to Process Your Request Try again";

            }


            if ($device_insert) {
                /* insert device breakdown table */
                if (isset($jodata->last_breakdown_date)) {
                    $insrt_bd[$this->dbrkdwns->ORG_ID] = $udata[$this->devices->ORG_ID];
                    $insrt_bd[$this->dbrkdwns->BRANCH_ID] = $udata[$this->devices->BRANCH_ID];
                    $insrt_bd[$this->dbrkdwns->EID] = $device_id;
                    $insrt_bd[$this->dbrkdwns->ADDED_BY] = $udata[$this->devices->USERNAME];
                    $insrt_bd[$this->dbrkdwns->ADDED_ON] = date('Y-m-d H:i:s');
                    $this->basemodel->insert_into_table($this->dbrkdwns->tbl_name, $insrt_bd);

                }
                /* insert amc table */
                $insert_amc[$this->deviceamcs->ORG_ID] = $jodata->ORG_ID;
                $insert_amc[$this->deviceamcs->BRANCH_ID] = $jodata->BRANCH_ID;
                $insert_amc[$this->deviceamcs->EID] = $device_id;
                $insert_amc[$this->deviceamcs->ADDED_BY] = $udata[$this->devices->USERNAME];
                $insert_amc[$this->deviceamcs->ADDED_ON] = date('Y-m-d H:i:s');
                $this->basemodel->insert_into_table($this->deviceamcs->tbl_name, $insert_amc);


                if ($device_insert[$this->devices->GENERAL_ASSET] == YESSTATE) {
                    /* insert pms */

                    $pmsval = 30 * (12 / $jodata->no_of_pms);
                    if ($pmsdate != '') {
                        $pmsdue = date('Y-m-d', strtotime($pmsdate . " + $pmsval days"));
                        $insert_pms[$this->pmsdetails->PMS_COUNT] = $jodata->no_of_pms;
                        $insert_pms[$this->pmsdetails->ORG_ID] = $this->session->org_id;
                        $insert_pms[$this->pmsdetails->EID] = $device_id;
                        $insert_pms[$this->pmsdetails->BRANCH_ID] = $jodata->BRANCH_ID;
                        $insert_pms[$this->pmsdetails->PMS_DONE] = $pmsdate;
                        $insert_pms[$this->pmsdetails->PMS_DUE_DATE] = $pmsdue;
                        $insert_pms[$this->pmsdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_amc[$this->deviceamcs->AMC_TYPE][0] . "P-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->pmsdetails->tbl_name, $this->pmsdetails->ID));
                        if ($this->basemodel->insert_into_table($this->pmsdetails->tbl_name, $insert_pms)) {
                            $pms_insert = true;
                            $response['pms_response'] = SUCCESSDATA;
                        } else {
                            $response['pms_response'] = FAILEDATA;
                        }
                    }

                    /* inser qc */
                    $ym = $jodata->no_of_qcs_ym;
                    if ($ym == 'Month')
                        $qcval = 30 * (12 / $jodata->no_of_qcs);
                    else if ($ym == 'Year')
                        $qcval = ceil(365 * (1 / $jodata->no_of_qcs));
                    if ($qcdate != '') {
                        $qcdue = date('Y-m-d', strtotime($qcdate . " + $qcval days"));
                        $insert_qc[$this->qcdetails->QC_COUNT_TYPE] = $jodata->no_of_qcs_ym;
                        $insert_qc[$this->qcdetails->QC_COUNT] = $jodata->no_of_qcs;
                        $insert_qc[$this->qcdetails->ORG_ID] = $jodata->ORG_ID;
                        $insert_qc[$this->qcdetails->EID] = $device_id;
                        $insert_qc[$this->qcdetails->BRANCH_ID] = $jodata->BRANCH_ID;
                        $insert_qc[$this->qcdetails->QC_DONE] = $qcdate;
                        $insert_qc[$this->qcdetails->QC_DUE] = $qcdue;
                        $insert_pms[$this->qcdetails->JOB_ID] = $branch_dtls[$this->branches->BRANCH_CODE] . "-" . $insert_amc[$this->deviceamcs->AMC_TYPE][0] . "Q-" . date('my') . "-" . $this->baselibrary->getpmsqc_id($this->basemodel->select_max_val($this->qcdetails->tbl_name, $this->qcdetails->ID));
                        if ($this->basemodel->insert_into_table($this->qcdetails->tbl_name, $insert_qc)) {
                            $qc_insert = true;
                            $response['qc_response'] = SUCCESSDATA;
                        } else {
                            $response['qc_response'] = FAILEDATA;
                        }
                    }
                }
                if (isset($device_id)) {

                    if (count($_FILES) > 0) {

                        $uploaded = $not_uploaded = 0;
                        $upload_device_folder = isset($jodata->PONO) ? $jodata->PONO : $jodata->ES_NUMBER;
                        for ($f = 0; $f < count($_FILES); $f++) {
                            $f_type = explode(".", $_FILES[$f]['name']);
                            $last_in = (count($f_type) - 1);
                            $config['upload_path'] = DEVICE_UPLOAD_PATH . $upload_device_folder;
                            $config['allowed_types'] = '*';
                            $time = time();
                            $config['file_name'] = $f_type[0] . "_" . $time;
                            if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload($f))
                                $uploaded++;
                            else {
                                $not_uploaded++;
                                $response['uploaded_files_errors'][] = $this->upload->display_errors();
                            }
                        }
                        $response['uploaded_files'] = $uploaded;
                        $response['not_uploaded_files'] = $not_uploaded;
                        $this->basemodel->update_operation(array($this->devices->UPLOAD_PATH => $upload_device_folder), $this->devices->tbl_name, array($this->devices->E_ID => $device_id));
                        //echo $this->db->last_query();
                    }
                }

                $date = date('Y-m-d H:i:s');
                $curenttime = date('H:i:s');
                $curentdate = date('Y-m-d');
                $desc = $device_id . " Record is Inserted Manually by " . $this->session->user_name;
                $response['status_response'] = $this->baselibrary->equipment_status_tbl_insert($device_id, $jodata->C_NAME, $jodata->device_status, $date);
                $response['calllog_response'] = $this->baselibrary->insert_calllog($this->session->user_name, $desc, $curentdate, $curenttime, $date, $this->session->org_id, $branch_id);

            }

        }
        else
        {

            $data['response'] = FAILEDATA;
            $data['call_back'] = "Unable to Update Details, Try Again";
        }

        return $data;
    }

    private function _org_module($jodata=array())
    {


        $org_id = isset($jodata->org_id) ? $jodata->org_id : $this->session->org_id;
        $data = array();

        $org_module = $this->basemodel->fetch_single_row($this->organizations->tbl_name, array($this->organizations->ORG_ID => $org_id), $this->organizations->ORG_MODULE);



        if($org_module) {
            $data['response'] = SUCCESSDATA;
            $data['org_module'] = $org_module;
        }else {
            $data['response'] = EXISTSDATA;
            $data['org_module'] = NULL;
        }

        return $data;
    }



}



/*Get Equipment Down Time*/
/* End of file Device.php */
/* Location: ./application/controllers/Device.php */