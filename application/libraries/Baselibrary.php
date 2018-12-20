<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BaseLibrary
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('users');
        $this->CI->load->library('baselibrary');
        $this->CI->load->model('condemnationrequest');
        $this->CI->load->model('contactpersons');
        $this->CI->load->model('condemnation');
        $this->CI->load->model('basemodel');
        $this->CI->load->model('qceqcats');
        $this->CI->load->model('devices');
        $this->CI->load->model('pmsdetails');
        $this->CI->load->model('devicenames');
        $this->CI->load->model('incedents');
        $this->CI->load->model('qcdetails');
        $this->CI->load->model('orgroles');
        $this->CI->load->model('calllogs');
        $this->CI->load->model('equpstatus');
        $this->CI->load->model('cms');
        $this->CI->load->model('userdeprts');
        $this->CI->load->model('equprelocation');
        $this->CI->load->model('equphistory');
        $this->CI->load->model('contracttypes');
        $this->CI->load->model('equptypes');
        $this->CI->load->model('equpconditions');
        $this->CI->load->model('baseauth');
        $this->CI->load->model('roles');
        $this->CI->load->model('tkn');
        $this->CI->load->model('reasons');
        $this->CI->load->model('priorities');
        $this->CI->load->model('causecodes');
        $this->CI->load->model('trainings');
        $this->CI->load->model('trainingtypes');
        $this->CI->load->model('trainingattends');
        $this->CI->load->model('trainingby');
        $this->CI->load->model('rounds');
        $this->CI->load->model('rounds_assigned');
        $this->CI->load->model('devicevendors');
        $this->CI->load->model('deviceamcs');
        $this->CI->load->model('escalationsnew');
        $this->CI->load->model('transfer');
        $this->CI->load->model('indents');
		$this->CI->load->model('scheduledcallsdetails');
		$this->CI->load->model('organizations');
    }
    public function set_indent_id($uid)
    {
        $user_id='';
        $uid= $uid+1;
        if (strlen($uid) == 1)
            $user_id = "IN".date('my')."000".$uid;
        else if (strlen($uid) == 2)
            $user_id = "IN".date('my')."00".$uid;
        else if (strlen($uid) == 3)
            $user_id = "IN".date('my')."0".$uid;
        else if (strlen($uid) == 4)
            $user_id = "IN".date('my').$uid;
        return $user_id;
    }
	
    public function set_cear_id($uid)
    {
        $user_id='';
        $uid= $uid+1;
        if (strlen($uid) == 1)
            $user_id = "CE".date('my')."000".$uid;
        else if (strlen($uid) == 2)
            $user_id = "CE".date('my')."00".$uid;
        else if (strlen($uid) == 3)
            $user_id = "CE".date('my')."0".$uid;
        else if (strlen($uid) == 4)
            $user_id = "CE".date('my').$uid;
        return $user_id;
    }
    public function set_gatepass_id($uid)
    {
        $user_id='';
        $uid= $uid+1;
        if (strlen($uid) == 1)
            $user_id = "GP".date('my')."000".$uid;
        else if (strlen($uid) == 2)
            $user_id = "GP".date('my')."00".$uid;
        else if (strlen($uid) == 3)
            $user_id = "GP".date('my')."0".$uid;
        else if (strlen($uid) == 4)
            $user_id = "GP".date('my').$uid;
        return $user_id;
    }
	public function set_question_id($uid)
    {
        $user_id='';
        $uid= $uid+1;
        if (strlen($uid) == 1)
            $user_id = "QU"."00000".$uid;
        else if (strlen($uid) == 2)
            $user_id = "QU"."0000".$uid;
        else if (strlen($uid) == 3)
            $user_id = "QU"."000".$uid;
        else if (strlen($uid) == 4)
            $user_id = "QU"."00".$uid;
		else if (strlen($uid) == 5)
            $user_id = "QU"."0".$uid;
		else if (strlen($uid) == 6)
            $user_id = "QU".$uid;
        return $user_id;
    }
    public function send_push_notification($reg_ids, $notification)
    {
        $message = array("message" => $notification);
        $notif = array("title"=>"HospiAsset","body"=>$notification);
        //$fields = array('registration_ids' => $reg_ids,'notification' => $notif, 'data' => $message);
        $fields = array('registration_ids' => $reg_ids,'data' => $notif);
        $headers = array(
            'Authorization: key=' . GOOGLE_FB_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, FIRE_BASE_URL);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        // Close connection
        curl_close($ch);
        return $result;
    }

    public function user_id_creation($uid = "")
    {
        $user_id = "";
        $uid = $uid+1;
        if (strlen($uid) == 1)
            $user_id = "0000000" . $uid;
        else if (strlen($uid) == 2)
            $user_id = "000000" . $uid;
        else if (strlen($uid) == 3)
            $user_id = "00000" . $uid;
        else if (strlen($uid) == 4)
            $user_id = "0000" . $uid;
        else if (strlen($uid) == 5)
            $user_id = "000" . $uid;
        else if (strlen($uid) == 6)
            $user_id = "00" . $uid;
        else if (strlen($uid) == 7)
            $user_id = "0" . $uid;
        else if (strlen($uid) == 8)
            $user_id = $uid;
        else
            $user_id = "A" . $user_id;
        return $user_id;
    }
    public function org_id_creation($uid = "")
    {
        $user_id = "";
        $uid = $uid+1;
        if (strlen($uid) == 1)
            $user_id = "000000" . $uid;
        else if (strlen($uid) == 2)
            $user_id = "00000" . $uid;
        else if (strlen($uid) == 3)
            $user_id = "0000" . $uid;
        else if (strlen($uid) == 4)
            $user_id = "000" . $uid;
        else if (strlen($uid) == 5)
            $user_id = "00" . $uid;
        else if (strlen($uid) == 6)
            $user_id = "0" . $uid;
        else if (strlen($uid) == 7)
            $user_id = $uid;
        return $user_id;
    }

    public function getpmsqc_id($uid)
    {
            if (strlen($uid) == 1)
                $user_id = "0000000" . $uid;
            else if (strlen($uid) == 2)
                $user_id = "000000" . $uid;
            else if (strlen($uid) == 3)
                $user_id = "00000" . $uid;
            else if (strlen($uid) == 4)
                $user_id = "0000" . $uid;
            else if (strlen($uid) == 5)
                $user_id = "000" . $uid;
            else if (strlen($uid) == 6)
                $user_id = "00" . $uid;
            else if (strlen($uid) == 7)
                $user_id = "0" . $uid;
            else if (strlen($uid) == 8)
                $user_id = $uid;
            else
                $user_id =  $uid;
        return $user_id;
    }

    public function get_branch_hods($org_id, $branch_id)
    {
        $user = "";
        if ($org_id != "" && $branch_id != "") {
            $where[$this->CI->users->ORG_ID] = $org_id;
            $where[$this->CI->users->ROLE_CODE] = HBHOD;
            $select = $this->CI->users->USER_NAME;
            $like = array($this->CI->users->ORG_BRANCH_ID => $branch_id);
            $user = $this->CI->basemodel->fetch_records_with_like($this->CI->users->tbl_name, $where, $like, $select);
        }
        return $user;
    }

    public function send_notification($org_id = '', $branch_id = '', $notifcation = '',$user_type='',$to='')
    {
		$data = array();
        if ($org_id != "" && $branch_id != "" && $notifcation != "") {
            $uwhere[$this->CI->users->ORG_ID] = $org_id;
            if($branch_id != 'All') {
                $ulike[$this->CI->users->ORG_BRANCH_ID] = $branch_id;
            }else
                {

                }
            $uwhere[$this->CI->users->STATUS] = ACTIVESTS;
            $uwhere[$this->CI->users->GCM_ID . " !="] = NULL;
            if($user_type!='')
                $uwhere[$this->CI->users->ROLE_CODE] = $user_type;
            if($to!='')
                $uwhere[$this->CI->users->USER_ID] = $to;
            $gcm_ids_all = $this->CI->basemodel->fetch_records_with_like($this->CI->users->tbl_name, $uwhere,$ulike, array($this->CI->users->GCM_ID));
            if (!empty($gcm_ids_all))
            {
                $gcm_ids = array();
                foreach ($gcm_ids_all as $gcm_id) /* to send notification */
                {
                    $gcm_ids[] = $gcm_id[$this->CI->users->GCM_ID];
                }
                $notifcation_res = $this->send_push_notification($gcm_ids, $notifcation);
                if ($notifcation_res !== FALSE) {
                    $notifcation_json = json_decode($notifcation_res);
                    $data['notification_success'] = $notifcation_json->success;
                    $data['notification'] = "sent";
                } else {
                    $data['notification'] = 'not sent';
                }
            }
            else {
                $data['notification'] = 'not sent';
            }
        }
        return $data;
    }

    public function send_vendor_notification( $notifcation = '',$distributer='')
    {
        $data = array();
        $dvendor = $this->CI->basemodel->get_single_column_value($this->CI->devicevendors->tbl_name, $this->CI->devicevendors->MOBILE_NO, array($this->CI->devicevendors->ID => $distributer));

        if($dvendor)
        {
            $vendor_gcm = $this->basemodel->get_single_column_value($this->CI->users->tbl_name,$this->CI->users->GCM_ID, array($this->CI->users->MOBILE_NO=>$dvendor));
            if($vendor_gcm) {
                $notifcation_res = $this->send_push_notification($vendor_gcm, $notifcation);
                if ($notifcation_res !== FALSE) {
                    $notifcation_json = json_decode($notifcation_res);
                    $data['notification_success'] = $notifcation_json->success;
                    $data['notification'] = "sent";
                } else {
                    $data['notification'] = 'not sent';
                }
            }
        }
        else
        {
            $dvendor = $this->CI->basemodel->get_single_column_value($this->CI->organizations->tbl_name,$this->CI->organizations->CP_NUMBER, array($this->CI->organizations->ORG_ID=>$distributer));

            if($dvendor)
            {
                $vendor_gcm = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name,$this->CI->users->GCM_ID, array($this->CI->users->MOBILE_NO=>$dvendor));

                if($vendor_gcm)
                {
                    $notifcation_res = $this->send_push_notification($vendor_gcm, $notifcation);
                    if ($notifcation_res !== FALSE) {
                        $notifcation_json = json_decode($notifcation_res);
                        $data['notification_success'] = $notifcation_json->success;
                        $data['notification'] = "sent";
                    } else {
                        $data['notification'] = 'not sent';
                    }
                }
            }
        }

        return $data;
    }


    public function insert_device_history($device_id, $complaint, $device_status, $datetime,$o,$b,$d)
    {
        $insert_dhis[$this->CI->equphistory->EID] = $device_id;
        $insert_dhis[$this->CI->equphistory->COMMENT] = $complaint;
        $insert_dhis[$this->CI->equphistory->STATUS] = $device_status;
        $insert_dhis[$this->CI->equphistory->NOTTED] = $datetime;
        $insert_dhis[$this->CI->equphistory->ORG_ID] = $o;
        $insert_dhis[$this->CI->equphistory->BRANCH_ID] = $b;
        $insert_dhis[$this->CI->equphistory->DEPT_ID] = $d;
        if ($this->CI->basemodel->insert_into_table($this->CI->equphistory->tbl_name, $insert_dhis))
            $data = 'inserted';
        else
            $data = 'not inserted';
        return $data;
    }

    public function insert_calllog($caller_id, $notifcation, $date, $time, $date_time,$org_id=NULL,$branch_id=NULL)
    {
        $insert_logs[$this->CI->calllogs->BRANCH_ID] = $branch_id;
        $insert_logs[$this->CI->calllogs->ORG_ID] = $org_id;
        $insert_logs[$this->CI->calllogs->USERNAME] = $caller_id;
        $insert_logs[$this->CI->calllogs->DESCRIPTION] = $notifcation;
        $insert_logs[$this->CI->calllogs->ENTRY] = $date_time;
        $insert_logs[$this->CI->calllogs->DATE] = $date;
        $insert_logs[$this->CI->calllogs->TIME] = $time;
        if ($this->CI->basemodel->insert_into_table($this->CI->calllogs->tbl_name, $insert_logs))
            $data = 'inserted';
        else
            $data = 'not inserted';
        return $data;
    }

    public function equipment_status_tbl_insert($eid,$company,$status,$date)
    {
        $insert_status[$this->CI->equpstatus->EID] = $eid;
        $insert_status[$this->CI->equpstatus->COMPANY] = $company;
        $insert_status[$this->CI->equpstatus->STATUS] = $status;
        $insert_status[$this->CI->equpstatus->DATE_UPDATE_ON] = $date;

        if ($this->CI->basemodel->insert_into_table($this->CI->equpstatus->tbl_name, $insert_status))
        {
            return SUCCESSDATA;
        }
        else
        {
            return FAILEDATA;
        }
    }

    public function get_device_vendor_data($device_id)
    {
        $select = array($this->CI->devices->VENDOR,$this->CI->devices->S_CONTACT,$this->CI->devices->SCO_NUMBER);
        $device_data = $this->CI->basemodel->fetch_single_row($this->CI->devices->tbl_name,array($this->CI->devices->E_ID=>$device_id),$select);
        if(!empty($device_data))
        {
            if(!is_null($device_data[$this->CI->devices->VENDOR]) && is_numeric($device_data[$this->CI->devices->VENDOR]))
            {
                $vselect = array($this->CI->devicevendors->NAME,$this->CI->devicevendors->MOBILE_NO,$this->CI->devicevendors->ADDRESS);
                $vendor_data = $this->CI->basemodel->fetch_single_row($this->CI->devicevendors->tbl_name,array($this->CI->devicevendors->ID=>$device_data[$this->CI->devices->VENDOR]),$vselect);
                if(!empty($vendor_data))
                {
                    $device_data['response'] = "success";
                    return $vendor_data;
                }
                else
                {
                    $device_data['response'] = "empty";
                    return $device_data;
                }
            }
            else
            {
                $device_data['response'] = "empty";
                return $device_data;
            }
        }
        else
        {
            return false;
        }
    }
    public function datediff($doi,$type='')
    {
        $final = '';
        $date2 = date('Y-m-d');
        if($type=='months')
        {
            $date1 = $doi;

            $ts1 = strtotime($date1);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);

            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);

            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
            $final = date("Y-m-d", strtotime("+$diff month", $ts1));
        }
        else if($type=='years')
        {
            $d2 = new DateTime($doi);
            $d1 = new DateTime($date2);
            $diff = $d2->diff($d1);
            $diff_years = $diff->y;
            $final = date('Y-m-d', strtotime("+".$diff_years." years", strtotime($doi)));
        }
        return $final;
    }

    public function get_pms_due_date($no_of_pms,$done_date)
    {
        $pmsval = ceil(365 / $no_of_pms);
        $date_arr = explode('-', $done_date);
        $pmsdue = Date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[2] + $pmsval, $date_arr[0]));
        return $pmsdue;
    }
    public function get_qc_due_date($no_of_qc,$done_date)
    {
        $qval = ceil(365 / $no_of_qc);
        $date_arr1 = explode('-', $done_date);
        $qcdue = Date("Y-m-d", mktime(0, 0, 0, $date_arr1[1], $date_arr1[2], $date_arr1[0]+ $qval));
        return $qcdue;
    }
    public function cal_escl_time($val,$type)
    {
        if($type==MINUTES)
            $mins = $val;
        else if($type==HOURS)
        {
            $mins = $val*60;
        }
        else if($type==DAYS)
        {
            $mins = $val*60*24;
        }
        return $mins;
    }
    public function read_files($dir_name='')
    {
        $data = array();
        if($dir_name!='')
        {
            $dir = DEVICE_UPLOAD_PATH.$dir_name;
            if (is_dir($dir))
            {
                if ($dh = opendir($dir))
                {
                    while (($file = readdir($dh)) !== false)
                    {
                        $f['href'] = base_url().$dir."/".$file;
                        $f['fname'] = $file;
                        $data[]=$f;
                    }
                    closedir($dh);
                }
            }
        }
        return $data;
    }

    public function get_brch_code_f_eid($eid)
    {
        $eid_array = explode("-",$eid);
        return $eid_array[3];
    }
    public function get_etype_f_eid($eid)
    {
        $etype = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->E_TYPE,array($this->CI->devices->E_ID=>$eid));
        return $etype;
    }

    public function time_diff_min($stime,$rtime)
    {
        $start_date = new DateTime($stime);
        $since_start = $start_date->diff(new DateTime($rtime));
        /*echo $since_start->days.' days total<br>';
        echo $since_start->y.' years<br>';
        echo $since_start->m.' months<br>';
        echo $since_start->d.' days<br>';
        echo $since_start->s.' seconds<br>';
        echo $since_start->h.' hours<br>';*/
        return $since_start->i;
    }

    public function set_ecolor($not_respond_time,$l1,$l2,$l3)
    {
        if($not_respond_time>$l3)
            $color  = '#E63535';
        else if($not_respond_time>$l2)
            $color  = '#E68635';
        else if($not_respond_time>$l1)
            $color  = '#E3DB47';
        else
            $color  = '#71E347';
        return $color;
    }

    public function cms_call_details($cms_data=array(),$type_call='',$role_code='',$user_id='')
    {
        if(!empty($cms_data))
        {
            for ($i = 0; $i < count($cms_data); $i++)
            {
                $cms_data[$i]['cctype'] ='cms';
                if ($cms_data[$i][$this->CI->cms->RESPONDED_DATE] == NULL)
                {
                    $cms_data[$i]['complaint_status'] = 'not_responded';
                    $cms_data[$i]['complaint_color'] = '#00b9ee';
                }
                else
                {
                    if($role_code!='' && $user_id!='')
                    {
                        if($role_code==HBHOD)
                        {
                            if($type_call=='responded')
                            {
                                if($cms_data[$i][$this->CI->cms->RESPONDED_BY]==$user_id && $cms_data[$i][$this->CI->cms->ASSIGNED_TO]==NULL)
                                    $cms_data[$i]['my_call'] = YESSTATE;
                                else
                                    $cms_data[$i]['my_call'] = NOSTATE;
                            }
                            if($type_call=='assigned')
                            {
                                if($cms_data[$i][$this->CI->cms->ASSIGNED_TO]==$user_id)
                                   $cms_data[$i]['my_call'] = YESSTATE;
                                else
                                   $cms_data[$i]['my_call'] = NOSTATE;
                            }
                            if($type_call=='attended' || $type_call=='pending' || $type_call=='completed')
                            {
                                if($cms_data[$i][$this->CI->cms->ATTENDED_BY]==$user_id)
                                   $cms_data[$i]['my_call'] = YESSTATE;
                                else
                                   $cms_data[$i]['my_call'] = NOSTATE;
                            }
                        }
                    }
                    $cms_data[$i]['complaint_status'] = 'assigned';
                    $cms_data[$i]['complaint_color'] = '#353bf0';
                    if ($cms_data[$i][$this->CI->cms->ATTENDED_DATE] != NULL)
                    {
                        $cms_data[$i]['complaint_status'] = 'in_progress';
                        $cms_data[$i]['complaint_color'] = '#f58f20';
                    }
                    if ($cms_data[$i][$this->CI->cms->STATUS] == UMAINTENCE)
                    {
                        $cms_data[$i]['complaint_status'] = 'on_hold';
                        $cms_data[$i]['complaint_color'] = '#ffc425';
                    }
                    if ($cms_data[$i][$this->CI->cms->STATUS] == DW)
                    {
                        $cms_data[$i]['complaint_status'] = 'completed';
                        $cms_data[$i]['complaint_color'] = '#6c1f7d';
                    }
                }
                if($type_call!='')
                    $cms_data[$i]['call_type'] = $type_call;
                $cms_data[$i]['CALLER_UNAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->EMP_NO => $cms_data[$i][$this->CI->cms->CEMP_ID]));
				 $cms_data[$i]['Assign'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->ASSIGN_ID,array($this->CI->devices->E_ID => $cms_data[$i][$this->CI->cms->EID]));
                $cms_data[$i]['Assign_id'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->ORG_ID,array($this->CI->devices->E_ID=>$cms_data[$i]['Assign']));
                //$srray = array($this->CI->organizations->ORG_ID,$this->CI->organizations->ORG_NAME);
                $cms_data[$i]['vendor_org'] = $this->CI->basemodel->fetch_single_row($this->CI->organizations->tbl_name,array($this->CI->organizations->ORG_ID=>$cms_data[$i]['Assign_id']));
				if($cms_data[$i][vendor_org])
				{
					$cms_data[$i]['VENDOR_ORG_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->organizations->tbl_name,$this->CI->organizations->ORG_NAME,array($this->CI->organizations->ORG_ID=>$cms_data[$i]['Assign_id']));
					$cms_data[$i]['VENDOR_ORG_ID'] = $this->CI->basemodel->get_single_column_value($this->CI->organizations->tbl_name,$this->CI->organizations->ORG_ID,array($this->CI->organizations->ORG_ID=>$cms_data[$i]['Assign_id']));
					$cms_data[$i]['VENDOR_ORG_TYPE'] = $this->CI->basemodel->get_single_column_value($this->CI->organizations->tbl_name,$this->CI->organizations->ORG_TYPE,array($this->CI->organizations->ORG_ID=>$cms_data[$i]['Assign_id']));
				}
				
              
                $cms_data[$i]['ATTENDEE_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $cms_data[$i][$this->CI->cms->ATTENDED_BY]));
                $cms_data[$i]['RESPONDED_BY_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $cms_data[$i][$this->CI->cms->RESPONDED_BY]));
				$cms_data[$i]['COMPLETED_BY_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $cms_data[$i][$this->CI->cms->COMPLETED_BY]));
               /* if($cms_data[$i][$this->CI->cms->ASSIGNED_TO]!=Vendor)
                {
                    $cms_data[$i]['ASSIGNED_TO_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $cms_data[$i][$this->CI->cms->ASSIGNED_TO]));
                }
                else
                {
                    $cms_data[$i]['ASSIGNED_TO_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->organizations->tbl_name, $this->CI->organizations->ORG_NAME, array($this->CI->organizations->ORG_ID => $cms_data[$i][$this->CI->cms->ASSIGNED_TO]));
                }*/
				
				$cms_vendor[$i]['assigned'] = $this->CI->basemodel->fetch_single_row($this->CI->organizations->tbl_name,array($this->CI->organizations->ORG_ID=>$cms_data[$i][$this->CI->cms->ASSIGNED_TO]));
				
                if($cms_vendor[$i]['assigned'])
                {
                    $cms_data[$i]['ASSIGNED_TO_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->organizations->tbl_name, $this->CI->organizations->ORG_NAME,array($this->CI->organizations->ORG_ID => $cms_data[$i][$this->CI->cms->ASSIGNED_TO]));
                }
                else
                {
                    $cms_data[$i]['ASSIGNED_TO_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $cms_data[$i][$this->CI->cms->ASSIGNED_TO]));
                }

                if($cms_data[$i][$this->CI->cms->RESPONDED_BY]==NULL)
                {
                    $cms_data[$i]['assigned_to'] = "";
                }
                else if($cms_data[$i][$this->CI->cms->RESPONDED_BY]!=NULL && $cms_data[$i][$this->CI->cms->ASSIGNED_TO]==NULL)
                {
                    $cms_data[$i]['assigned_to'] = $cms_data[$i]['RESPONDED_BY_NAME'];
                }
                else
                {
                    $cms_data[$i]['assigned_to'] = $cms_data[$i]['ASSIGNED_TO_NAME'];
                }

                $cms_data[$i]['ASSIGNED_BY_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $cms_data[$i][$this->CI->cms->ASSIGNED_BY]));
                $cms_data[$i]['CDATETIME'] = strtotime($cms_data[$i][$this->CI->cms->CDATE] . ' ' . $cms_data[$i][$this->CI->cms->CTIME]);
                if($cms_data[$i][$this->CI->cms->JOBCOMPLETED_DATE]!=NULL)
                {
                    $cms_data[$i]['JOBCOMPLETEDATETIME'] = strtotime($cms_data[$i][$this->CI->cms->JOBCOMPLETED_DATE] . ' ' . $cms_data[$i][$this->CI->cms->JOBCOMPLETED_TIME]);
                    $cms_data[$i]['jobcomplete_date'] = date('d-m-Y h:i A',$cms_data[$i]['JOBCOMPLETEDATETIME']);
                }
				if($cms_data[$i][$this->CI->cms->ASSIGNED_TO]==VENDOR)
                {
                    $cms_data[$i]['VENDOR_DTLS'] = $this->get_device_vendor_data($cms_data[$i][$this->CI->cms->EID]);
                }
               /* else
                {
                    $cms_data[$i]['VENDOR_DTLS'] = $this->CI->basemodel->get_single_column_value($this->CI->devicevendors->tbl_name, $this->CI->devicevendors->NAME, array($this->CI->devicevendors->ID => $cms_data[$i][$this->CI->cms->ATTENDED_BY]));
                }*/
                $cms_data[$i]['DEPT_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->userdeprts->tbl_name, $this->CI->userdeprts->USER_DEPT_NAME, array($this->CI->userdeprts->CODE => $cms_data[$i][$this->CI->cms->CALLER_DEPT]));
                $cms_data[$i]['location'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->PHY_LOCATION,array($this->CI->devices->E_ID=>$cms_data[$i][$this->CI->cms->EID]));
                $cms_data[$i]['serial_number'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->ES_NUMBER,array($this->CI->devices->E_ID=>$cms_data[$i][$this->CI->cms->EID]));
                $cms_data[$i]['eq_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->E_NAME,array($this->CI->devices->E_ID=>$cms_data[$i][$this->CI->cms->EID]));
                $cms_data[$i]['c_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$cms_data[$i][$this->CI->cms->EID]));
                if(strlen($cms_data[$i][$this->CI->cms->TYPE])!=1)
                {
                    $cms_data[$i]['contract_type'] = $cms_data[$i][$this->CI->cms->TYPE];
                }
                else
                {
                    $cms_data[$i]['contract_type'] = $this->CI->basemodel->get_single_column_value($this->CI->contracttypes->tbl_name, $this->CI->contracttypes->CTYPE, array($this->CI->contracttypes->CFORM => $cms_data[$i][$this->CI->cms->TYPE]));
                }
                if(is_numeric($cms_data[$i]['c_name']))
                {
                    $cms_data[$i]['company_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devicevendors->tbl_name,$this->CI->devicevendors->NAME,array($this->CI->devicevendors->ID=>$cms_data[$i]['c_name']));
                }
                else
                {
                    $cms_data[$i]['company_name'] =$this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$cms_data[$i][$this->CI->cms->EID]));
                }
                $cms_data[$i]['branch_name'] = $this->CI->basemodel->get_single_column_value($this->CI->branches->tbl_name, $this->CI->branches->BRANCH_NAME, array($this->CI->branches->BRANCH_ID => $cms_data[$i][$this->CI->cms->BRANCH_ID]));                            //$cms_data[$i]['contract_type'] = $this->CI->basemodel->get_single_column_value($this->CI->contracttypes->tbl_name, $this->CI->contracttypes->CTYPE, array($this->CI->contracttypes->CFORM => $cms_data[$i][$this->CI->cms->TYPE]));
                /* escalation*/
                //$e_type = $this->get_etype_f_eid($cms_data[$i][$this->CI->cms->EID]);
                $e_util = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->UTILIZATION,array($this->CI->devices->E_ID=>$cms_data[$i][$this->CI->cms->EID]));
                $e_cat = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->E_CAT,array($this->CI->devices->E_ID=>$cms_data[$i][$this->CI->cms->EID]));

                $es_where[$this->CI->escalationsnew->ES_MODULE] = 'Non-Scheduled';
                $es_where[$this->CI->escalationsnew->STATUS] = ACTIVESTS;
                $es_or_where = "(" . $this->CI->escalationsnew->EQUIPMENT_TYPE . "='" . $e_cat . "' OR " . $this->CI->escalationsnew->EQUIPMENT_UTIL . "='" . $e_util . "')";
                $es_data = $this->CI->basemodel->fetch_single_row_multi_where($this->CI->escalationsnew->tbl_name,$es_where,$es_or_where);
                if(!empty($es_data))
                {
                    if($cms_data[$i][$this->CI->cms->RESPONDED_BY]==NULL)
                    {
                        $time = $cms_data[$i][$this->CI->cms->CDATE]." ".$cms_data[$i][$this->CI->cms->CTIME];
                        $not_respond_time = $this->time_diff_min($time,date('Y-m-d H:i:s'));
                        $cms_data[$i]['color'] = $this->set_ecolor($not_respond_time,$es_data[$this->CI->escalationsnew->L1],$es_data[$this->CI->escalationsnew->L2],$es_data[$this->CI->escalationsnew->L3]);
                    }
                    else if($cms_data[$i][$this->CI->cms->RESPONDED_BY]!=NULL && $cms_data[$i][$this->CI->cms->ASSIGNED_TO]==NULL)
                    {
                        $time = $cms_data[$i][$this->CI->cms->RESPONDED_DATE]." ".$cms_data[$i][$this->CI->cms->RESPONDED_TIME];
                        $not_respond_time = $this->time_diff_min($time,date('Y-m-d H:i:s'));
                        $cms_data[$i]['color'] = $this->set_ecolor($not_respond_time,$es_data[$this->CI->escalationsnew->L1],$es_data[$this->CI->escalationsnew->L2],$es_data[$this->CI->escalationsnew->L3]);
                    }
                else if($cms_data[$i][$this->CI->cms->ASSIGNED_TO]!=NULL && $cms_data[$i][$this->CI->cms->ATTENDED_BY]==NULL)
                    {
                        $time = $cms_data[$i][$this->CI->cms->ASSIGNED_ON];
                        $not_respond_time = $this->time_diff_min($time,date('Y-m-d H:i:s'));
                        $cms_data[$i]['color'] = $this->set_ecolor($not_respond_time,$es_data[$this->CI->escalationsnew->L1],$es_data[$this->CI->escalationsnew->L2],$es_data[$this->CI->escalationsnew->L3]);
                    }
                    else if($cms_data[$i][$this->CI->cms->ATTENDED_BY]!=NULL && $cms_data[$i][$this->CI->cms->ASSIGNED_TO]!=NULL && $cms_data[$i][$this->CI->cms->PENDING_REASON]==NULL)
                    {
                        $time = $cms_data[$i][$this->CI->cms->ATTENDED_DATE]." ".$cms_data[$i][$this->CI->cms->ATTENDED_TIME];
                        $not_respond_time = $this->time_diff_min($time,date('Y-m-d H:i:s'));
                        $cms_data[$i]['color'] = $this->set_ecolor($not_respond_time,$es_data[$this->CI->escalationsnew->L1],$es_data[$this->CI->escalationsnew->L2],$es_data[$this->CI->escalationsnew->L3]);
                    }
                    else if($cms_data[$i][$this->CI->cms->PENDING_REASON]!=NULL && $cms_data[$i][$this->CI->cms->STATUS]!=DW)
                    {
                        $time = $cms_data[$i][$this->CI->cms->ATTENDED_DATE]." ".$cms_data[$i][$this->CI->cms->ATTENDED_TIME];
                        $not_respond_time = $this->time_diff_min($time,date('Y-m-d H:i:s'));
                        $cms_data[$i]['color'] = $this->set_ecolor($not_respond_time,$es_data[$this->CI->escalationsnew->L1],$es_data[$this->CI->escalationsnew->L2],$es_data[$this->CI->escalationsnew->L3]);
                    }
                    else
                    {
                        $cms_data[$i]['color']  = '#89bcf0';
                    }
                }
                else
                {
                    $cms_data[$i]['color']  = '#89bcf0';
                }
            }
        }
        return $cms_data;
    }
	 public function scheduled_calls_pending_details($data=array(),$role_code='',$user_id='')
    {
        if(!empty($data))
        {
            for ($i = 0; $i < count($data); $i++)
            {
                $data[$i]['cctype'] ='pms';
                if($data[$i][$this->CI->scheduledcallsdetails->ASSIGNED_ON]!=NULL)
                {
                    $data[$i]['assigned_on'] = date('d-m-Y h:i A',strtotime($data[$i][$this->CI->scheduledcallsdetails->ASSIGNED_ON]));
                    $data[$i]['color'] = "#ddc066";
                }
                else
                {
                    $data[$i]['assigned_on'] = "";
                    $data[$i]['color'] = "#CBB778";
                }
                $data[$i]['Assigned_by'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $data[$i][$this->CI->scheduledcallsdetails->ASSIGNED_BY]));
                $data[$i]['Assigned_to'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $data[$i][$this->CI->scheduledcallsdetails->ASSIGNED_TO]));

                $data[$i]['location'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->PHY_LOCATION,array($this->CI->devices->E_ID=>$data[$i][$this->CI->scheduledcallsdetails->EID]));
                $data[$i]['eq_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->E_NAME,array($this->CI->devices->E_ID=>$data[$i][$this->CI->scheduledcallsdetails->EID]));
                $data[$i]['serial_number'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->ES_NUMBER,array($this->CI->devices->E_ID=>$data[$i][$this->CI->scheduledcallsdetails->EID]));
                $data[$i]['c_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$data[$i][$this->CI->scheduledcallsdetails->EID]));
                $data[$i]['c_type'] = $this->CI->basemodel->get_single_column_value($this->CI->deviceamcs->tbl_name, $this->CI->deviceamcs->AMC_TYPE, array($this->CI->deviceamcs->EID=> $data[$i][$this->CI->scheduledcallsdetails->EID],$this->CI->deviceamcs->STATUS=> OPEN));
                if(strlen($data[$i]['c_type'])!=1)
                {
                    $data[$i]['contract_type'] = $data[$i]['c_type'];
                }
                else
                {
                    $data[$i]['contract_type'] = $this->CI->basemodel->get_single_column_value($this->CI->contracttypes->tbl_name, $this->CI->contracttypes->CTYPE, array($this->CI->contracttypes->CFORM => $data[$i]['c_type']));
                }
                if(is_numeric($data[$i]['c_name']))
                {
                    $data[$i]['company_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devicevendors->tbl_name,$this->CI->devicevendors->NAME,array($this->CI->devicevendors->ID=>$data[$i]['c_name']));
                }
                else
                {
                    $data[$i]['company_name'] =$this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$data[$i][$this->CI->scheduledcallsdetails->EID]));
                }

                $last_done_by = $this->CI->basemodel->get_single_column_value($this->CI->scheduledcallsdetails->tbl_name,$this->CI->scheduledcallsdetails->COMPLETED_BY,array($this->CI->scheduledcallsdetails->EID=>$data[$i][$this->CI->scheduledcallsdetails->EID]),$this->CI->scheduledcallsdetails->SCHEDULED_DUE,'DESC',1);
                if($last_done_by!="-")
                {
                    $data[$i]['last_done_by'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name,$this->CI->users->USER_NAME,array($this->CI->users->USER_ID=>$last_done_by));
                }
                else
                {
                    $data[$i]['last_done_by'] = "";
                }
                $data[$i]['model'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->E_MODEL,array($this->CI->devices->E_ID=>$data[$i][$this->CI->scheduledcallsdetails->EID]));
                $data[$i]['serial_no'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->ES_NUMBER,array($this->CI->devices->E_ID=>$data[$i][$this->CI->scheduledcallsdetails->EID]));
                $data[$i]['department'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->DEPT_ID,array($this->CI->devices->E_ID=>$data[$i][$this->CI->scheduledcallsdetails->EID]));
                $data[$i]['type'] = $this->CI->basemodel->get_single_column_value($this->CI->deviceamcs->tbl_name,$this->CI->deviceamcs->AMC_TYPE,array($this->CI->deviceamcs->EID=>$data[$i][$this->CI->scheduledcallsdetails->EID],$this->CI->deviceamcs->STATUS=>OPEN),$this->CI->deviceamcs->AMC_FROM,'DESC');
                if($data[$i][$this->CI->scheduledcallsdetails->COMPLETED_BY]!=NULL)
                    $data[$i]['COMPLETED_BY_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $data[$i][$this->CI->pmsdetails->COMPLETED_BY]));
                if($role_code!='' && $role_code=HBHOD)
                {
                    //if($data[$i][$this->CI->pmsdetails->PMS_ASSIGNED_TO]==$user_id || $data[$i][$this->CI->pmsdetails->PMS_ASSIGNED_TO]==NULL)

                    if($data[$i][$this->CI->scheduledcallsdetails->ASSIGNED_TO]==$user_id)
                    {
                        $data[$i]['my_call'] = YESSTATE;
                    }
                    else
                    {
                        $data[$i]['my_call'] = NOSTATE;
                    }
                }
            }
        }
        return $data;
    }

	
    public function scheduled_pms_details($data=array(),$role_code='',$user_id='')
    {
        if(!empty($data))
        {
            for ($i = 0; $i < count($data); $i++)
            {
                $data[$i]['cctype'] ='pms';
                if($data[$i][$this->CI->pmsdetails->ASSIGNED_ON]!=NULL)
                {
                    $data[$i]['assigned_on'] = date('d-m-Y h:i A',strtotime($data[$i][$this->CI->pmsdetails->ASSIGNED_ON]));
                    $data[$i]['color'] = "#ddc066";
                }
                else
                {
                    $data[$i]['assigned_on'] = "";
                    $data[$i]['color'] = "#CBB778";
                }
                $data[$i]['Assigned_by'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $data[$i][$this->CI->pmsdetails->PMS_ASSIGNED_BY]));
                $data[$i]['Assigned_to'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $data[$i][$this->CI->pmsdetails->PMS_ASSIGNED_TO]));

                $data[$i]['location'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->PHY_LOCATION,array($this->CI->devices->E_ID=>$data[$i][$this->CI->pmsdetails->EID]));
                $data[$i]['eq_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->E_NAME,array($this->CI->devices->E_ID=>$data[$i][$this->CI->pmsdetails->EID]));
                $data[$i]['serial_number'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->ES_NUMBER,array($this->CI->devices->E_ID=>$data[$i][$this->CI->pmsdetails->EID]));
                $data[$i]['c_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$data[$i][$this->CI->pmsdetails->EID]));
                $data[$i]['c_type'] = $this->CI->basemodel->get_single_column_value($this->CI->deviceamcs->tbl_name, $this->CI->deviceamcs->AMC_TYPE, array($this->CI->deviceamcs->EID=> $data[$i][$this->CI->pmsdetails->EID],$this->CI->deviceamcs->STATUS=> OPEN));
                if(strlen($data[$i]['c_type'])!=1)
                {
                    $data[$i]['contract_type'] = $data[$i]['c_type'];
                }
                else
                {
                    $data[$i]['contract_type'] = $this->CI->basemodel->get_single_column_value($this->CI->contracttypes->tbl_name, $this->CI->contracttypes->CTYPE, array($this->CI->contracttypes->CFORM => $data[$i]['c_type']));
                }
                if(is_numeric($data[$i]['c_name']))
                {
                    $data[$i]['company_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devicevendors->tbl_name,$this->CI->devicevendors->NAME,array($this->CI->devicevendors->ID=>$data[$i]['c_name']));
                }
                else
                {
                    $data[$i]['company_name'] =$this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$data[$i][$this->CI->pmsdetails->EID]));
                }

                $last_done_by = $this->CI->basemodel->get_single_column_value($this->CI->pmsdetails->tbl_name,$this->CI->pmsdetails->COMPLETED_BY,array($this->CI->pmsdetails->EID=>$data[$i][$this->CI->pmsdetails->EID]),$this->CI->pmsdetails->PMS_DUE_DATE,'DESC',1);
                if($last_done_by!="-")
                {
                    $data[$i]['last_done_by'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name,$this->CI->users->USER_NAME,array($this->CI->users->USER_ID=>$last_done_by));
                }
                else
                {
                    $data[$i]['last_done_by'] = "";
                }
                $data[$i]['model'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->E_MODEL,array($this->CI->devices->E_ID=>$data[$i][$this->CI->pmsdetails->EID]));
                $data[$i]['serial_no'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->ES_NUMBER,array($this->CI->devices->E_ID=>$data[$i][$this->CI->pmsdetails->EID]));
                $data[$i]['department'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->DEPT_ID,array($this->CI->devices->E_ID=>$data[$i][$this->CI->pmsdetails->EID]));
                $data[$i]['type'] = $this->CI->basemodel->get_single_column_value($this->CI->deviceamcs->tbl_name,$this->CI->deviceamcs->AMC_TYPE,array($this->CI->deviceamcs->EID=>$data[$i][$this->CI->pmsdetails->EID],$this->CI->deviceamcs->STATUS=>OPEN),$this->CI->deviceamcs->AMC_FROM,'DESC');
                if($data[$i][$this->CI->pmsdetails->COMPLETED_BY]!=NULL)
                    $data[$i]['COMPLETED_BY_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $data[$i][$this->CI->pmsdetails->COMPLETED_BY]));
                if($role_code!='' && $role_code=HBHOD)
                {
                    //if($data[$i][$this->CI->pmsdetails->PMS_ASSIGNED_TO]==$user_id || $data[$i][$this->CI->pmsdetails->PMS_ASSIGNED_TO]==NULL)  
						
					if($data[$i][$this->CI->pmsdetails->PMS_ASSIGNED_TO]==$user_id)
                    {
                        $data[$i]['my_call'] = YESSTATE;
                    }
                    else
                    {
                        $data[$i]['my_call'] = NOSTATE;
                    }
                }
            }
        }
        return $data;
    }
    public function condemnation_details($condemnation=array())
    {
        if(!empty($condemnation))
        {
            for ($i = 0; $i < count($condemnation); $i++)
            {
                $condemnation[$i]['cctype'] ='condemnation';
                $condemnation[$i]['equp_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name, $this->CI->devices->E_NAME, array($this->CI->devices->E_ID => $condemnation[$i][$this->CI->condemnation->EQUP_ID]));
                $condemnation[$i]['model_no'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name, $this->CI->devices->E_MODEL, array($this->CI->devices->E_ID => $condemnation[$i][$this->CI->condemnation->EQUP_ID]));
                $condemnation[$i]['serial_no'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name, $this->CI->devices->ES_NUMBER, array($this->CI->devices->E_ID => $condemnation[$i][$this->CI->condemnation->EQUP_ID]));
                $condemnation[$i]['po_date'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name, $this->CI->devices->PDATE, array($this->CI->devices->E_ID => $condemnation[$i][$this->CI->condemnation->EQUP_ID]));
                $condemnation[$i]['branch_name'] = $this->CI->basemodel->get_single_column_value($this->CI->branches->tbl_name, $this->CI->branches->BRANCH_NAME, array($this->CI->branches->BRANCH_ID => $condemnation[$i][$this->CI->condemnation->BRANCH_ID]));
                $condemnation[$i]['phy_location'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name, $this->CI->devices->PHY_LOCATION, array($this->CI->devices->E_ID => $condemnation[$i][$this->CI->condemnation->EQUP_ID]));
                $condemnation[$i]['equp_cost'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name, $this->CI->devices->E_COST, array($this->CI->devices->E_ID => $condemnation[$i][$this->CI->condemnation->EQUP_ID]));
                $condemnation[$i]['department'] = $this->CI->basemodel->get_single_column_value($this->CI->userdeprts->tbl_name, $this->CI->userdeprts->USER_DEPT_NAME, array($this->CI->userdeprts->CODE => $condemnation[$i][$this->CI->condemnation->DEPT_ID]));
                $condemnation[$i]['added_by'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $condemnation[$i][$this->CI->condemnation->ADDED_BY]));
                $condemnation[$i]['c_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$condemnation[$i][$this->CI->condemnation->EQUP_ID]));
                $condemnation[$i]['contract_type'] = $this->CI->basemodel->get_single_column_value($this->CI->deviceamcs->tbl_name,$this->CI->deviceamcs->AMC_TYPE,array($this->CI->deviceamcs->EID=>$condemnation[$i][$this->CI->condemnation->EQUP_ID]));
                if(is_numeric($condemnation[$i]['c_name']))
                {
                    $condemnation[$i]['company_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devicevendors->tbl_name,$this->CI->devicevendors->NAME,array($this->CI->devicevendors->ID=>$condemnation[$i]['c_name']));
                }
                else
                {
                    $condemnation[$i]['company_name'] =$this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$condemnation[$i][$this->CI->condemnation->EQUP_ID]));
                }

                $condemnation[$i]['added_on'] = strtotime($condemnation[$i][$this->CI->condemnation->ADDED_ON]);
                $reasons = explode(",",$condemnation[$i][$this->CI->condemnation->REASON]);
                for($j=0;$j<count($reasons);$j++)
                {
                    $condemnation[$i]['reasons'][] = $this->CI->basemodel->get_single_column_value($this->CI->condemnationrequest->tbl_name,$this->CI->condemnationrequest->REQUEST_NAME,array($this->CI->condemnationrequest->CODE=>$reasons[$j]));
                }
            }
        }
        return $condemnation;
    }
    public function scheduled_qc_details($data=array(),$role_code='',$user_id='')
    {
        if(!empty($data))
        {
            for ($i = 0; $i < count($data); $i++)
            {
                $data[$i]['cctype'] ='calibration';
                if($data[$i][$this->CI->qcdetails->ASSIGNED_ON]!=NULL)
                {
                    $data[$i]['assigned_on'] = date('d-m-Y h:i A',strtotime($data[$i][$this->CI->qcdetails->ASSIGNED_ON]));
                    $data[$i]['color'] = "#2989C3";
                }
                else
                {
                    $data[$i]['assigned_on'] = "";
                    $data[$i]['color'] = "#81a1b5";
                }
                $data[$i]['Assigned_by'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $data[$i][$this->CI->qcdetails->ASSIGNED_BY]));
                $data[$i]['Assigned_to'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $data[$i][$this->CI->qcdetails->ASSIGNED_TO]));
                $data[$i]['location'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->PHY_LOCATION,array($this->CI->devices->E_ID=>$data[$i][$this->CI->qcdetails->EID]));
                $data[$i]['eq_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->E_NAME,array($this->CI->devices->E_ID=>$data[$i][$this->CI->qcdetails->EID]));
                $data[$i]['model'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->E_MODEL,array($this->CI->devices->E_ID=>$data[$i][$this->CI->qcdetails->EID]));
                $data[$i]['serial_no'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->ES_NUMBER,array($this->CI->devices->E_ID=>$data[$i][$this->CI->qcdetails->EID]));
                $data[$i]['department'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->DEPT_ID,array($this->CI->devices->E_ID=>$data[$i][$this->CI->qcdetails->EID]));
                $data[$i]['serial_number'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->ES_NUMBER,array($this->CI->devices->E_ID=>$data[$i][$this->CI->qcdetails->EID]));
                $data[$i]['c_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$data[$i][$this->CI->qcdetails->EID]));
                $data[$i]['c_type'] = $this->CI->basemodel->get_single_column_value($this->CI->deviceamcs->tbl_name, $this->CI->deviceamcs->AMC_TYPE, array($this->CI->deviceamcs->EID=> $data[$i][$this->CI->qcdetails->EID],$this->CI->deviceamcs->STATUS=> OPEN));
                if(strlen($data[$i]['c_type'])!=1)
                {
                    $data[$i]['contract_type'] = $data[$i]['c_type'];
                }
                else
                {
                    $data[$i]['contract_type'] = $this->CI->basemodel->get_single_column_value($this->CI->contracttypes->tbl_name, $this->CI->contracttypes->CTYPE, array($this->CI->contracttypes->CFORM => $data[$i]['c_type']));
                }
                if(is_numeric($data[$i]['c_name']))
                {
                    $data[$i]['company_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devicevendors->tbl_name,$this->CI->devicevendors->NAME,array($this->CI->devicevendors->ID=>$data[$i]['c_name']));
                }
                else
                {
                    $data[$i]['company_name'] =$this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$data[$i][$this->CI->pmsdetails->EID]));
                }
                $last_done_by = $this->CI->basemodel->get_single_column_value($this->CI->qcdetails->tbl_name,$this->CI->qcdetails->COMPLETED_BY,array($this->CI->qcdetails->EID=>$data[$i][$this->CI->qcdetails->EID]),$this->CI->qcdetails->QC_DUE,'DESC',1);
                if($last_done_by!="-")
                {
                    $data[$i]['last_done_by'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name,$this->CI->users->USER_NAME,array($this->CI->users->USER_ID=>$last_done_by));
                }
                else
                {
                    $data[$i]['last_done_by'] = "";
                }
                $data[$i]['type'] = $this->CI->basemodel->get_single_column_value($this->CI->deviceamcs->tbl_name,$this->CI->deviceamcs->AMC_TYPE,array($this->CI->deviceamcs->EID=>$data[$i][$this->CI->qcdetails->EID],$this->CI->deviceamcs->STATUS=>OPEN),$this->CI->deviceamcs->AMC_FROM,'DESC');
                if($data[$i][$this->CI->qcdetails->COMPLETED_BY]!=NULL)
                    $data[$i]['COMPLETED_BY_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $data[$i][$this->CI->qcdetails->COMPLETED_BY]));
                if($role_code!='' && $role_code=HBHOD)
                {
                    if($data[$i][$this->CI->qcdetails->ASSIGNED_TO]==$user_id)
                    {
                        $data[$i]['my_call'] = YESSTATE;
                    }
                    else
                    {
                        $data[$i]['my_call'] = NOSTATE;
                    }
                }
            }
        }
        return $data;
    }

    public function get_training_to_roles($tr_to='')
    {
        $data = array();
        if($tr_to!=NULL && $tr_to!='')
        {
            $tr_to_ary = explode(",",$tr_to);

            $data = $this->CI->basemodel->awesome_fetch($this->CI->roles->tbl_name,'','',$tr_to_ary,$this->CI->roles->ROLE_CODE,'','',array($this->CI->roles->ROLE_CODE,$this->CI->roles->ROLE_NAME));
        }
        //$this->basemodel->get_single_column_value($this->trainingby->tbl_name, $this->trainingby->ROLE_NAME, array($this->trainingby->ROLE_CODE=>$approve_data[$i][$this->trainings->TR_BY]))
        return $data;
    }

    public function adverse_incidents($add_incedent,$role_code='',$user_id='')
    {
        for($i=0;$i<count($add_incedent);$i++)
        {
            if($role_code!='' && $role_code=HBHOD && $user_id!='')
            {
                if($add_incedent[$i][$this->CI->incedents->ASSIGNED_TO]==$user_id)
                {
                    $add_incedent[$i]['my_call'] = YESSTATE;
                }
                else
                {
                    $add_incedent[$i]['my_call'] = NOSTATE;
                }
            }
            $add_incedent[$i]['depart'] = $this->CI->basemodel->get_single_column_value($this->CI->userdeprts->tbl_name, $this->CI->userdeprts->USER_DEPT_NAME, array($this->CI->userdeprts->CODE => $add_incedent[$i][$this->CI->incedents->DEPT_ID]));
            $add_incedent[$i]['Branch_name']= $this->CI->basemodel->get_single_column_value($this->CI->branches->tbl_name,$this->CI->branches->BRANCH_NAME,array($this->CI->branches->BRANCH_ID=>$add_incedent[$i][$this->CI->incedents->BRANCH_ID]));
            $add_incedent[$i]['incidents_type'] = $this->CI->basemodel->get_single_column_value($this->CI->incedenttype->tbl_name,$this->CI->incedenttype->ITYPE,array($this->CI->incedenttype->CODE=>$add_incedent[$i][$this->CI->incedents->INCIDENT_TYPE]));
            $add_incedent[$i]['location'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->PHY_LOCATION,array($this->CI->devices->E_ID=>$add_incedent[$i][$this->CI->incedents->EQUP_ID]));
            $add_incedent[$i]['eq_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->E_NAME,array($this->CI->devices->E_ID=>$add_incedent[$i][$this->CI->incedents->EQUP_ID]));
            $add_incedent[$i]['model'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->E_MODEL,array($this->CI->devices->E_ID=>$add_incedent[$i][$this->CI->incedents->EQUP_ID]));
            $add_incedent[$i]['serial_no'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->ES_NUMBER,array($this->CI->devices->E_ID=>$add_incedent[$i][$this->CI->incedents->EQUP_ID]));
            $add_incedent[$i]['department'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->DEPT_ID,array($this->CI->devices->E_ID=>$add_incedent[$i][$this->CI->incedents->EQUP_ID]));
            $add_incedent[$i]['type'] = $this->CI->basemodel->get_single_column_value($this->CI->deviceamcs->tbl_name,$this->CI->deviceamcs->AMC_TYPE,array($this->CI->deviceamcs->EID=>$add_incedent[$i][$this->CI->incedents->EQUP_ID],$this->CI->deviceamcs->STATUS=>OPEN),$this->CI->deviceamcs->AMC_FROM,'DESC');
            $add_incedent[$i]['assigned_to'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $add_incedent[$i][$this->CI->incedents->ASSIGNED_TO]));
            $add_incedent[$i]['assigned_by'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $add_incedent[$i][$this->CI->incedents->ASSIGNED_BY]));
			$add_incedent[$i]['updated_by'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name,$this->CI->users->USER_NAME,array($this->CI->users->USER_ID => $add_incedent[$i][$this->CI->incedents->UPDATED_BY]));
            if($add_incedent[$i][$this->CI->incedents->COMPLETED_BY]!=NULL)
            {
                $add_incedent[$i]['completed_by'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $add_incedent[$i][$this->CI->incedents->COMPLETED_BY]));
            }
            $add_incedent[$i]['c_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$add_incedent[$i][$this->CI->incedents->EQUP_ID]));
            $add_incedent[$i]['contract_type'] = $this->CI->basemodel->get_single_column_value($this->CI->deviceamcs->tbl_name,$this->CI->deviceamcs->AMC_TYPE,array($this->CI->deviceamcs->EID=>$add_incedent[$i][$this->CI->incedents->EQUP_ID]));
            if(is_numeric($add_incedent[$i]['c_name']))
            {
                $add_incedent[$i]['company_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devicevendors->tbl_name,$this->CI->devicevendors->NAME,array($this->CI->devicevendors->ID=>$add_incedent[$i]['c_name']));
            }
            else
            {
                $add_incedent[$i]['company_name'] =$this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name,$this->CI->devices->C_NAME,array($this->CI->devices->E_ID=>$add_incedent[$i][$this->CI->incedents->EQUP_ID]));
            }
            /*if(is_string($add_incedent[$i][$this->CI->incedents->ADDED_BY]))
            {
                $add_incedent[$i]['ADDED_BY_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name,$this->CI->users->USER_NAME,array($this->CI->users->USER_ID=>$add_incedent[$i][$this->CI->incedents->ADDED_BY]));
            }
            else
            {
                $add_incedent[$i]['ADDED_BY_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name,$this->CI->users->USER_NAME,array($this->CI->users->EMP_NO=>$add_incedent[$i][$this->CI->incedents->ADDED_BY]));
            }*/
            $add_incedent[$i]['color'] ='#efc373';
            $add_incedent[$i]['cctype'] ='adverse';
        }
        return $add_incedent;
    }
    public function training_list($trainings,$feedbacks_type='',$user_id='')
    {
        for ($i = 0; $i < count($trainings); $i++)
        {
            if($trainings[$i][$this->CI->trainings->STATUS]==APPROVED)
            {
                $trainings[$i]['color'] = "#26a69a";
            }
            else if($trainings[$i][$this->CI->trainings->STATUS]==PENDING)
            {
                $trainings[$i]['color'] = "#ffe57f";
            }
            else if($trainings[$i][$this->CI->trainings->STATUS]==CANCELLED)
            {
                $trainings[$i]['color'] = "#fb8c00";
            }
            $trainings[$i]['USER_NAME'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $trainings[$i][$this->CI->trainings->USERNAME]));
            $trainings[$i]['TDATETIME'] = strtotime($trainings[$i][$this->CI->trainings->TR_DATE] . ' ' . $trainings[$i][$this->CI->trainings->TR_TIME]);
            $trainings[$i]['TRAINING_TYPE'] = $this->CI->basemodel->get_single_column_value($this->CI->trainingtypes->tbl_name, $this->CI->trainingtypes->TRAINING_TYPE, array($this->CI->trainingtypes->CODE=>$trainings[$i][$this->CI->trainings->TR_TYPE]));
            $trainings[$i]['TRAINING_BY'] = $this->CI->basemodel->get_single_column_value($this->CI->trainingby->tbl_name, $this->CI->trainingby->ROLE_NAME, array($this->CI->trainingby->ROLE_CODE=>$trainings[$i][$this->CI->trainings->TR_BY]));
            $trainings[$i]['TRAINING_TO'] = $this->get_training_to_roles($trainings[$i][$this->CI->trainings->TR_TO]);
            if($trainings[$i][$this->CI->trainings->TR_COMP]!=NULL && $trainings[$i][$this->CI->trainings->TR_COMP]!='')
            {
                if($feedbacks_type=='')
                {
                    $feedback = $this->CI->basemodel->fetch_single_row($this->CI->trainingattends->tbl_name,array($this->CI->trainingattends->TID=>$trainings[$i][$this->CI->trainings->ID]));
                    if(empty($feedback))
                    {
                        $trainings[$i]['FEEDBACK'] = NULL;
                    }
                    else
                    {
                        $trainings[$i]['FEEDBACK'] = YESSTATE;
                    }
                }
                else if($feedbacks_type=='user_feedbacks')
                {
                    $feedback = $this->CI->basemodel->fetch_single_row($this->CI->trainingattends->tbl_name,array($this->CI->trainingattends->TID=>$trainings[$i][$this->CI->trainings->ID],$this->CI->trainingattends->USER_NAME=>$user_id));
                    if(empty($feedback))
                    {
                        $trainings[$i]['FEED_GIVEN'] = NOSTATE;
                    }
                    else
                    {
                        $trainings[$i]['FEED_GIVEN'] = YESSTATE;
                        $trainings[$i]['FEEDBACK_DATA'] = $feedback[$this->CI->trainingattends->FEEDBACK];
                    }
                }
            }
        }
        return $trainings;
    }
    public function transfer_list($othransfer)
    {
        for ($i = 0; $i < count($othransfer); $i++)
        {
            $othransfer[$i]['req_eq_name'] = $this->CI->basemodel->get_single_column_value($this->CI->devicenames->tbl_name, $this->CI->devicenames->NAME, array($this->CI->devicenames->ID => $othransfer[$i][$this->CI->transfer->E_NAME]));
            $othransfer[$i]['ename'] = $this->CI->basemodel->get_single_column_value($this->CI->devices->tbl_name, $this->CI->devices->E_NAME, array($this->CI->devices->E_ID => $othransfer[$i][$this->CI->transfer->EQUP_ID]));
			$othransfer[$i]['department'] = $this->CI->basemodel->get_single_column_value($this->CI->userdeprts->tbl_name, $this->CI->userdeprts->USER_DEPT_NAME, array($this->CI->userdeprts->CODE => $othransfer[$i][$this->CI->transfer->DEPT_ID]));
            $othransfer[$i]['username'] = $this->CI->basemodel->get_single_column_value($this->CI->users->tbl_name, $this->CI->users->USER_NAME, array($this->CI->users->USER_ID => $othransfer[$i][$this->CI->transfer->USERNAME]));
            $othransfer[$i]['branch_name'] = $this->CI->basemodel->get_single_column_value($this->CI->branches->tbl_name, $this->CI->branches->BRANCH_NAME, array($this->CI->branches->BRANCH_ID => $othransfer[$i][$this->CI->transfer->BRANCH_ID]));
            $othransfer[$i]['tbranch_name'] = $this->CI->basemodel->get_single_column_value($this->CI->branches->tbl_name, $this->CI->branches->BRANCH_NAME, array($this->CI->branches->BRANCH_ID => $othransfer[$i][$this->CI->transfer->TRANSFER_BRANCH]));
            $othransfer[$i]['added_on'] = strtotime($othransfer[$i][$this->CI->transfer->ADDED_ON]);
            $othransfer[$i]['tbranch_code'] = $this->CI->basemodel->get_single_column_value($this->CI->branches->tbl_name, $this->CI->branches->BRANCH_CODE, array($this->CI->branches->BRANCH_ID => $othransfer[$i][$this->CI->transfer->TRANSFER_BRANCH]));
            $othransfer[$i]['status'] = $this->CI->basemodel->get_single_column_value($this->CI->cms->tbl_name, $this->CI->cms->STATUS, array($this->CI->cms->EID => $othransfer[$i][$this->CI->transfer->EQUP_ID]));
            $othransfer[$i]['equp_type'] = $this->CI->basemodel->get_single_column_value($this->CI->cms->tbl_name, $this->CI->cms->TYPE, array($this->CI->cms->EID => $othransfer[$i][$this->CI->transfer->EQUP_ID]));
            $othransfer[$i]['cctype'] = "transfer";
        }
        return $othransfer;
    }
    public function assign_rounds($org_id,$branches,$user_id_assign,$assign_to)
    {
        $data = array();
        /*for($i=0;$i<count($branches);$i++)
        {
            $ser_where[$this->CI->devices->ORG_ID] = $org_id;
            $ser_where[$this->CI->devices->BRANCH_ID] = $branches[$i];
            $ser_where[$this->CI->devices->DEPT_ID." !="] = NULL;
            $depts = $this->CI->basemodel->fetch_distinct_records($this->CI->devices->tbl_name,$ser_where,$this->CI->devices->DEPT_ID);
            for($j=0;$j<count($depts);$j++)
            {
                $iround[$this->CI->rounds_assigned->ORG_ID] = $org_id;
                $iround[$this->CI->rounds_assigned->BRANCH_ID] = $branches[$i];
                $iround[$this->CI->rounds_assigned->DEPT_ID] = $depts[$j][$this->CI->devices->DEPT_ID];
                $iround[$this->CI->rounds_assigned->ASSIGNED_BY] = $user_id_assign;
                $iround[$this->CI->rounds_assigned->ASSIGNED_TO] = $assign_to;
                $iround[$this->CI->rounds_assigned->ROUND_DATE] = date('Y-m-d');
                $iround[$this->CI->rounds_assigned->STATUS] = PERMANENT;
                $iround[$this->CI->rounds_assigned->REMARKS] = "Complete the Round";
                if($this->CI->basemodel->insert_into_table($this->CI->rounds_assigned->tbl_name,$iround))
                {
                    $data[]  = SUCCESSDATA;
                }
                else
                {
                    $data[]  = FAILEDATA;
                }
            }
        }*/
        return $data;
    }

    public function assign_round_new_dept($org_id,$branch_id,$dept_id)
    {
        $data = array();
        /*$ser_where[$this->CI->users->ORG_ID] = $org_id;
        $ser_where_like[$this->CI->users->ORG_BRANCH_ID] = $branch_id;
        $users = $this->CI->basemodel->fetch_records_with_like($this->CI->users->tbl_name,$ser_where,$ser_where_like,array($this->CI->users->USER_ID));
        for($j=0;$j<count($users);$j++)
        {
            $iround[$this->CI->rounds_assigned->ORG_ID] = $org_id;
            $iround[$this->CI->rounds_assigned->BRANCH_ID] = $branch_id;
            $iround[$this->CI->rounds_assigned->DEPT_ID] = $dept_id;
            $iround[$this->CI->rounds_assigned->ASSIGNED_BY] = NULL;
            $iround[$this->CI->rounds_assigned->ASSIGNED_TO] = $users[$j][$this->CI->users->USER_ID];
            $iround[$this->CI->rounds_assigned->ROUND_DATE] = date('Y-m-d');
            $iround[$this->CI->rounds_assigned->STATUS] = PERMANENT;
            $iround[$this->CI->rounds_assigned->REMARKS] = "Complete the Round";
            if($this->CI->basemodel->insert_into_table($this->CI->rounds_assigned->tbl_name,$iround))
            {
                $data[]  = SUCCESSDATA;
            }
            else
            {
                $data[]  = FAILEDATA;
            }
        }*/
        return $data;
    }

    public function get_adverse_approvals_count($org_id,$state=YESSTATE)
    {
        $count = "-";
       $count = $this->CI->basemodel->get_single_column_value($this->CI->orgroles->tbl_name,"COUNT(".$this->CI->orgroles->ROLE_AID.")",array($this->CI->orgroles->ORG_ID=>$org_id,$this->CI->orgroles->ADVRS_APRV=>$state));
        return $count;
    }
    public function get_indent_approvals_count($org_id,$state=YESSTATE)
    {
        $count = "-";
       $count = $this->CI->basemodel->get_single_column_value($this->CI->orgroles->tbl_name,"COUNT(".$this->CI->orgroles->ROLE_AID.")",array($this->CI->orgroles->ORG_ID=>$org_id,$this->CI->orgroles->INDENT_APRV=>$state));
        return $count;
    }
    public function get_condem_approvals_count($org_id,$state=YESSTATE)
    {
        $count = "-";
        $count = $this->CI->basemodel->get_single_column_value($this->CI->orgroles->tbl_name,"COUNT(".$this->CI->orgroles->ROLE_AID.")",array($this->CI->orgroles->ORG_ID=>$org_id,$this->CI->orgroles->CNDM_APRV=>$state));
        return $count;
    }
    public function get_cear_approvals_count($org_id,$state=YESSTATE)
    {
        $count = "-";
        $count = $this->CI->basemodel->get_single_column_value($this->CI->orgroles->tbl_name,"COUNT(".$this->CI->orgroles->ROLE_AID.")",array($this->CI->orgroles->ORG_ID=>$org_id,$this->CI->orgroles->CEAR_APRV=>$state));
        return $count;
    }
	public function validateDate($date)
	{
		$d = DateTime::createFromFormat('Y-m-d', $date);
		return $d && $d->format('Y-m-d') === $date;
	}
}
?>