<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public $shref = NULL;
    public $ha_content_type = NULL;
    public $true_href = NULL;
    public $ha_authorization = NULL;
    public $ccc_con = NULL;

    public function __construct()
    {

        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        //$this->ccc_con = odbc_connect("CORPDB","HIDDB","HIDDB");
        //header('Content-Type: application/json');
        $this->load->model('users');
        $this->load->model('contactpersons');
        $this->load->model('organizations');
        $this->load->model('orgroles');
        $this->load->model('roles');
        $this->load->model('basemodel');
        $this->load->model('branches');
        $this->load->model('baseauth');
        $this->load->model('tkn');

        $this->load->library('baselibrary');

    }

    public function index()
    {
        include_once APPPATH.'libraries/HA_BKP/MainRest.php';
    }

    private function _key_rest($base_data='',$content_type='')
    {


        if(!is_null($base_data) && $content_type==$this->baseauth->appjson)
        {


            $data = array();
            $jodata = json_decode($base_data);
            $action = $jodata->action;
            if($action=="login_user_check")
                $data = $this->_ha_default_login($jodata);
            else if($action=="user_fcm_update")
                $data = $this->_update_user($jodata);
            else if($action=="check_fcm_exists")
                $data = $this->_check_fcm_exists($jodata);
            else if($action=="get_ccc_user_dtls")
                $data = $this->_get_ccc_user_dtls($jodata);
            else if($action=="check_session_exists")
                $data = $this->_check_session_exists();
            else if($action=="clear_fcm_id")
                $data = $this->_clear_fcm_id($jodata);
            else if($action=="get_version")
                $data = $this->_get_version($jodata);
            else if($action=="check_user_no")
                $data = $this->_check_user_no($jodata);
            else if($action=="check_user_email")
                $data = $this->_check_user_email($jodata);
            else if($action=="check_serial_number")
                $data = $this->_check_serial_number($jodata);
            else if($action=="check_password")
                $data = $this->_check_password($jodata);
            else if($action=="check_cms_eq_id")
                $data = $this->_check_cms_eq_id($jodata);
            else if($action=="check_contact_number")
                $data = $this->_check_contact_number($jodata);
            echo json_encode($data);
        }
    }

    public function testing()
    {
        $base_data = $this->security->xss_clean($this->input->raw_input_stream);
        $headers = apache_request_headers();
        $jdata= json_decode($base_data);
        $data['response'] = $jdata->username;
        echo json_encode($data);
    }

    private function _check_serial_number($jodata=array()){

        //return $jodata->serial_no;
        $where = array();
        $data = array();
        $where[$this->devices->ES_NUMBER] = $jodata->serial_no;
        $result = $this->basemodel->fetch_records_from($this->devices->tbl_name, $where);

        if (!empty($result)) {
            // $data['emp_dtls'] = $result;
            $data['response'] = SUCCESSDATA;
        } else {
            $data['emp_dtls'] = array();
            $data['response'] = EMPTYDATA;
        }
        return $data;

    }

    private function _check_password($jodata = array()){
        $email_mobile = $jodata->userem;
        $pswrd = $jodata->pswrd;
        $check_pass = $this->bcrypt->hash_password($pswrd);
        $where[$this->users->EMP_NO] = $email_mobile;
        $where[$this->users->STATUS] = ACTIVESTS;
        $select = array($this->users->USER_ID, $this->users->PSWRD, $this->users->USER_NAME,$this->users->EMAIL_ID,$this->users->MOBILE_NO,$this->users->ORG_ID,$this->users->ORG_BRANCH_ID,$this->users->DEPT_CODE,$this->users->EMP_NO,$this->users->ROLE_CODE,$this->users->FEATURES_LIST,$this->users->END_DATE);
        $data1 = $this->basemodel->fetch_single_row($this->users->tbl_name,$where,$select);
        if($data1){
            if(isset($jodata->reg_id) && $jodata->reg_id!='')
                $reg_id = $jodata->reg_id;
            else
                $reg_id = '';
            if($this->verify('asset123', $data1['PSWRD']) == "true")
            {
                $data['response'] = "YES";

            }
            else
            {
                $data['response'] = "NO";
            }
        }else{
            $data['response'] = "Please check Username";
        }

        return $data;
    }

    public function verify($input, $existingHash){
        $hash = crypt($input, $existingHash);

        return $hash === $existingHash;
    }


   private function _check_contact_number($jodata)
    {
        $where = array();
        $data = array();
        $where[$this->users->MOBILE_NO] = $jodata->contact_no;
        $where[$this->users->EMP_NO] = $jodata->contact_no;
        $wwhere[$this->organizations->CP_NUMBER] = $jodata->contact_no;
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


    private function _check_cms_eq_id($jodata=array()){

        //return $jodata->serial_no;
        $where = array();
        $data = array();
        $where[$this->cms->EID] = $jodata->device_id;
        $result = $this->basemodel->fetch_records_from($this->cms->tbl_name, $where);
        // return $this->db->last_query();
        if (!empty($result)) {
            // $data['emp_dtls'] = $result;
            $data['response'] = SUCCESSDATA;
        } else {
            $data['emp_dtls'] = array();
            $data['response'] = EMPTYDATA;
        }
        return $data;

    }


    private function _check_user_email($jodata=array()){

        //return $jodata->email_id;
        $where = array();
        $data = array();
        $where[$this->users->EMAIL_ID] = $jodata->email_id;
        $result = $this->basemodel->fetch_records_from($this->users->tbl_name, $where);

        if (!empty($result)) {
            // $data['emp_dtls'] = $result;
            $data['response'] = SUCCESSDATA;
        } else {
            $data['emp_dtls'] = array();
            $data['response'] = EMPTYDATA;
        }
        return $data;

    }

    private function _check_user_no($jodata)
    {
        $where = array();
        $data = array();
        $where[$this->users->EMP_NO] = $jodata->emp_no;
        $result = $this->basemodel->fetch_records_from($this->users->tbl_name, $where);

        if (!empty($result)) {
            // $data['emp_dtls'] = $result;
            $data['response'] = SUCCESSDATA;
        } else {
            $data['emp_dtls'] = array();
            $data['response'] = EMPTYDATA;
        }

        return $data;
    }

    private function _ha_default_login($jodata=array())
    {

        $data = array();
        if(!empty($jodata) && $this->ha_content_type==$this->baseauth->appjson)
        {
            $action = $jodata->action;
            $login_type = $jodata->lgn_type;
            $email_mobile = $jodata->userem;
            // $pswrd = $jodata->pswrd;
            if($action=="login_user_check")
            {
				

                $where = array();
                if($login_type=="defaultlogin")
                {
                    $pswrd= $jodata->pswrd;
                    $where[$this->users->EMP_NO] = $email_mobile;
                    $where[$this->users->STATUS] = ACTIVESTS;
                }
                else if($login_type=="socallogin")
                {
                    $where[$this->users->EMAIL_ID] = $email_mobile;
                    $where[$this->users->STATUS] = ACTIVESTS;
                }

                $select = array($this->users->USER_ID, $this->users->PSWRD, $this->users->USER_NAME,$this->users->EMAIL_ID,$this->users->MOBILE_NO,$this->users->ORG_ID,$this->users->ORG_BRANCH_ID,$this->users->ORG_MODULE,$this->users->DEPT_CODE,$this->users->EMP_NO,$this->users->ROLE_CODE,$this->users->FEATURES_LIST,$this->users->END_DATE);
                $data['user_login'] = $this->basemodel->fetch_single_row($this->users->tbl_name,$where,$select);


                if(!empty($data['user_login']))
                {

                    if($login_type=="defaultlogin")
                    {
                        if(isset($jodata->reg_id) && $jodata->reg_id!='')
                            $reg_id = $jodata->reg_id;
                        else
                            $reg_id = '';

                        if($this->_ha_check_password($pswrd,$data['user_login'][$this->users->PSWRD])===true)
                        {

                            $org_id = $data['user_login'][$this->users->ORG_ID];
                            $branchs = $data['user_login'][$this->users->ORG_BRANCH_ID];

                            $org_id = explode(',',$org_id);
                            if(count($org_id) > 1)
                                $data['user_login'][$this->users->ORG_ID] = 'All';

                            if($branchs != null)
                                $branchs = explode(',',$branchs);
                            else
                                $branchs[0] = 'All';

                            if(count($branchs) == 1)
                            {
                                $data['user_login'][$this->users->ORG_BRANCH_ID] = $branchs[0];
                                $branch_id = $branchs[0];
                            }
                            else
                            {
                                $branch_id = 'All';
                                $data['user_login'][$this->users->ORG_BRANCH_ID] = 'All';
                            }

                            $data = $this->_user_properties($data,$branch_id ,$reg_id);

                        }
                        else
                        {
                            unset($data['user_login']);
                            $data['response'] = EMPTYDATA;
                        }
                    }
                    else if($login_type=="socallogin")
                    {
                        $data = $this->_user_properties($data);
                    }
                    else
                    {
                        $data['response'] = UNKNOWN;
                        unset($data['user_login']);
                    }
                    unset($data['user_login'][$this->users->PSWRD]);
                }
                else
                {
                    unset($data['user_login']);
                    $data['response'] = FAILEDATA;
                }
            }
            /*	else($action=="login_vendor_check") {


                }*/
        }

        return $data;
    }
   private function _user_properties($data=array(),$branch='',$fcm_id='')
    {

        if(!empty($data)) {
            if ($data['user_login'][$this->users->ROLE_CODE] != HA_ADMIN) {

                /*  if ($data['user_login'][$this->users->END_DATE] >= date('Y-m-d H:i:s')) {
                      $data['user_login']['VALIDITY_EXPIRED'] = NOSTATE;
                  } else {
                      $data['user_login']['VALIDITY_EXPIRED'] = YESSTATE;
                  }
              } else {
                  $data['user_login']['VALIDITY_EXPIRED'] = NOSTATE;
              }*/

                if($this->bcrypt->check_password(DFFPASS, $data['user_login'][$this->users->PSWRD]))
                {
                    $data['user_login']['password_match'] = YESSTATE;
                }
                else
                {
                    $data['user_login']['password_match'] = NOSTATE;
                }
            }
            else
            {
                $data['user_login']['password_match'] = NOSTATE;
            }


            $unrc = $data['user_login'][$this->users->ROLE_CODE];

            if ($unrc != HA_ADMIN && $unrc != HMADMIN ) {

                $fwhere[$this->orgroles->ROLE_CODE] = $data['user_login'][$this->users->ROLE_CODE];
                $fwhere[$this->orgroles->STATUS] = ACTIVESTS;
                $fwhere[$this->orgroles->ORG_ID] = $data['user_login'][$this->users->ORG_ID];
                $fdata['user_features'] = $this->basemodel->fetch_single_row($this->orgroles->tbl_name, $fwhere);
                //return $fdata['user_features'];//echo $fdata['user_features']; die();


            } else if ($unrc == HA_ADMIN) {
                $fselect = array($this->roles->ROLE_PATH, $this->roles->ROLE_FEATURES, $this->roles->ROLE_CODE, $this->roles->ROLE_PRIORITY, $this->roles->EROLE_CODE);

                $fwhere[$this->roles->ROLE_CODE] = $data['user_login'][$this->users->ROLE_CODE];
                $fwhere[$this->roles->STATUS] = ACTIVESTS;

                $fdata['user_features'] = $this->basemodel->fetch_single_row($this->roles->tbl_name, $fwhere, $fselect);

            } else {


                $fselect = array($this->organizations->ROLE_PATH, $this->organizations->FEATURES, $this->organizations->ROLE_CODE, $this->organizations->EROLE_CODE,$this->organizations->NO_OF_EQUPIMENTS,$this->organizations->NO_OF_BRANCHES,$this->organizations->NO_OF_USERS,$this->organizations->ORG_MODULE);

                $fwhere[$this->organizations->ROLE_CODE] = $data['user_login'][$this->users->ROLE_CODE];
                $fwhere[$this->organizations->CP_NUMBER] = $data['user_login'][$this->users->EMP_NO];
                $fwhere[$this->organizations->STATUS] = ACTIVESTS;
                // return $fwhere;
                $fdata['user_features'] = $this->basemodel->fetch_single_row($this->organizations->tbl_name, $fwhere, $fselect);


            }

            if ($unrc != HA_ADMIN && $unrc != HMADMIN ) {


                $data['user_login'][$this->orgroles->ROLE_PATH] = $fdata['user_features'][$this->orgroles->ROLE_PATH];
                $data['user_login'][$this->orgroles->GENERAL_ASSET] = $fdata['user_features'][$this->orgroles->GENERAL_ASSET];
                $data['user_login'][$this->orgroles->EROLE_CODE] = $fdata['user_features'][$this->orgroles->EROLE_CODE];
                $data['user_login'][$this->orgroles->ROLE_CODE] = $fdata['user_features'][$this->orgroles->ROLE_CODE];
                $data['user_login'][$this->orgroles->ROLE_PRIORITY] = $fdata['user_features'][$this->orgroles->ROLE_PRIORITY];
               // $data['user_login'][$this->orgroles->ORG_MODULE]   = $fdata['user_features'][$this->orgroles->ORG_MODULE];
                $ffdata['user_features'] = $fdata['user_features'][$this->orgroles->ROLE_FEATURES];


                if ($data['user_login'][$this->users->FEATURES_LIST] == NULL || $data['user_login'][$this->users->FEATURES_LIST] == "") {

                    $data['user_login'][$this->users->FEATURES_LIST] = json_decode($fdata['user_features'][$this->orgroles->ROLE_FEATURES], true);
                    // echo $fdata['user_features'][$this->orgroles->ROLE_FEATURES]; die();
                    $features = $data['user_login'][$this->users->FEATURES_LIST];

                    foreach ($features['menu'] as $v) {
                        //

                        if ($v['name'] == "Equipment" && $v['selected'] == true) {

                            foreach ($v['subfeatures'] as $m) {
                                if ($m['name'] == "Indent" &&  $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {

                                        if ($n['name'] == "Add" && $n['selected'] == true) {
                                            $data['user_login']['Add_Indent'] = 'Add';
                                        }
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Indent'] = 'Edit';
                                        }
                                        if ($n['name'] == "Transfer" && $n['selected'] == true) {
                                            $data['user_login']['Transfer_Indent'] = 'Transfer';
                                        }
                                        if ($n['name'] == "Approve" && $n['selected'] == true) {
                                            $data['user_login']['Approve_Indent'] = 'Approve';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Indent'] = 'View';
                                        }
                                        if($n['name'] == "Rise CEAR" && $n['selected'] == true){

                                            $data['user_login']['Rise_Cear'] = 'Rise CEAR';

                                        }
                                        if($n['name'] == "GeneratePDF" && $n['selected'] == true){

                                            $data['user_login']['Indent_PDF_Generated'] = 'GeneratePDF';

                                        }
                                        if($n['name'] == "Sanction" && $n['selected'] == true){

                                            $data['user_login']['Sanction_Indent'] = 'Sanction';

                                        }
                                        if($n['name'] == "Sanctioned" && $n['selected'] == true){

                                            $data['user_login']['Sanctioned_Indent'] = 'Sanctioned';

                                        }
                                        if($n['name'] == "Stock" && $n['selected'] == true){

                                            $data['user_login']['Stock_Indent'] = 'Stock';

                                        }
                                    }
                                }

                                if ($m['name'] == "Cear" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Cear'] = 'Edit';
                                        }
                                        if ($n['name'] == "Approve" && $n['selected'] == true) {
                                            $data['user_login']['Approve_Cear'] = 'Approve';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Cear'] = 'View';
                                        }
                                    }
                                }

                                if ($m['name'] == "Gate Pass" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Add" && $n['selected'] == true) {
                                            $data['user_login']['Add_Gatepass'] = 'Add';
                                        }
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Gatepass'] = 'Approve';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Gatepass'] = 'View';
                                        }
                                    }
                                }
                               /* if ($m['name'] == "Add Equipment" && $m['selected'] == true) {

                                }*/
                                if ($m['name'] == "View Equipment" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Equipment'] = 'Edit';
                                        }
                                        if ($n['name'] == "Replace" && $n['selected'] == true) {
                                            $data['user_login']['Replace_Equipment'] = 'Replace';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Equipment'] = 'View';
                                        }
                                    }
                                }
                                if ($m['name'] == "Print Labels" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Print" && $n['selected'] == true) {
                                            $data['user_login']['print_Equipment'] = 'Print Equipment';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Print'] = 'View';
                                        }

                                    }
                                }
                                if ($m['name'] == "Transfer" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Transfer'] = 'Edit';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Transfer'] = 'View';
                                        }

                                    }
                                }
                                if ($m['name'] == "Condemnation" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Condemnation'] = 'Edit';
                                        }
                                        if ($n['name'] == "Approve" && $n['selected'] == true) {
                                            $data['user_login']['Approve_Condemnation'] = 'Approve';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Condemnation'] = 'Approve';
                                        }

                                    }
                                }
                                if ($m['name'] == "Contracts" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Add" && $n['selected'] == true) {
                                            $data['user_login']['Add_Contracts'] = 'Add';
                                        }
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Contracts'] = 'Edit';
                                        }
                                        if ($n['name'] == "Renew" && $n['selected'] == true) {
                                            $data['user_login']['Renew_Contracts'] = 'Renew';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Contracts'] = 'View';
                                        }

                                    }
                                }
                                if ($m['name'] == "Viability" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Add" && $n['selected'] == true) {
                                            $data['user_login']['Add_Viability'] = 'Add';
                                        }
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Viability'] = 'Edit';
                                        }
                                        if ($n['name'] == "GeneratePDF" && $n['selected'] == true) {
                                            $data['user_login']['Viability_Generate_PDF'] = 'GeneratePDF';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Viabilty'] = 'View';
                                        }

                                    }
                                }
                            }
                        }
                        if ($v['name'] == "Setup" && $v['selected'] == true) {

                            foreach ($v['subfeatures'] as $f) {
                                if ($f['name'] == "Vendors" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Vendor'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Vendor'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Vendor'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Modules" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Module'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Module'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Module'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Countries" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Country'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Country'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Country'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "States" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_State'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_State'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_State'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Cities" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_City'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_City'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_City'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Users" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_User'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_User'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_User'] = 'View';
                                        }
                                    }
                                }

                                if ($f['name'] == "Contract Types" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Contract_Type'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Contract_Type'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Contract_Type'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Branches" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Branches'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Branches'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Branches'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Escalation Types" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Escalation_type'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Escalation_type'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Escalation_type'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Escalations" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Escalations'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Escalations'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Escalations'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Escalation Levels" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Escalationlevel'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Escalationlevel'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Escalationlevel'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Cear Category" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Cear_Category'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Cear_Category'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Cear_Category'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Training Types" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Training_Type'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Training_Type'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Training_Type'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Reasons" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Reasons'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Reasons'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Reasons'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Departments" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Department'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Department'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Department'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Categories" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Category'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Category'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Cateogry'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Deployment" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Deployment'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Deployment'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Deployment'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Conditions" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Condition'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Condition'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Condition'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Classes" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Classes'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Classes'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Classes'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Utilizations" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Utilization'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Utilization'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View") {
                                            $data['user_login']['View_Utilization'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Status" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Status'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Status'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Status'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Classifications" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Classification'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Classification'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Classification'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Equipment Types" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Equipment_Type'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Equipment_Type'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Equipment_Type'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Incident Type" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Incident_Type'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Incident_Type'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Incident_Type'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Roles" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Role'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Role'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Role'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "CEAR Type" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_CEAR_TYPE'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_CEAR_TYPE'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_CEAR_TYPE'] = 'View';
                                        }
                                    }
                                }
                            }
                        }
                        if ($v['name'] == "CMS" && $v['selected']==true) {
                            foreach ($v['subfeatures'] as $fs) {
                                if ($fs['name'] == "Open Calls" && $fs['selected']==true) {
                                    foreach ($fs['subsubfeatures'] as $ab) {

                                        if ($ab['name'] == "Respond" && $ab['selected']==true) {
                                            $data['user_login']['Respond_Open_Calls'] = 'Respond';
                                        }
                                        if ($ab['name'] == "Attend" && $ab['selected']==true) {
                                            $data['user_login']['Attend_Open_Calls'] = 'Attend';
                                        }
                                        if ($ab['name'] == "Hold" && $ab['selected']==true) {
                                            $data['user_login']['Hold_Open_Calls'] = 'Hold';
                                        }
                                        if ($ab['name'] == "Complete" && $ab['selected']==true) {
                                            $data['user_login']['Complete_Open_Calls'] = 'Complete';
                                        }
                                        if ($ab['name'] == "View" && $ab['selected']==true) {
                                            $data['user_login']['View_Open_Calls'] = 'View';
                                        }
                                    }
                                }
                               /* if ($fs['name'] == "Scheduled Calls" && $fs['selected']==true) {
                                    foreach ($ab['subsubfeatures'] as $ab) {

                                    }
                                }*/
                                if($fs['name']=="Incident Call" && $fs['selected']==true){
                                    foreach($fs['subsubfeatures'] as $ab){
                                        if($ab['name']=="View" && $ab['selected']==true)
                                        {
                                            $data['user_login']['Incident_Call_View'] = 'View';
                                        }
                                    }

                                }
                                if($fs['name']=="Transfer Call" && $fs['selected']==true){
                                    foreach($fs['subsubfeatures'] as $ab){
                                        if($ab['name']=="View" && $ab['selected']==true){
                                            $data['user_login']['Transfer_Call_View'] = 'View';
                                        }
                                    }
                                }
                                if($fs['name']=="Non-schedule Call" && $fs['selected']==true){
                                    foreach($fs['subsubfeatures'] as $ab){
                                        if($ab['name']=="View" && $ab['selected']==true){
                                            $data['user_login']['Non_Call_View'] = 'View';
                                        }
                                    }
                                }
                                if($fs['name']=="Condemnation Call" && $fs['selected']==true){
                                    foreach($fs['subsubfeatures'] as $ab){
                                        if($ab['name']=="View" && $ab['selected']==true){
                                            $data['user_login']['Condmn_Call_View'] = 'View';
                                        }
                                    }
                                }
                               /* if ($fs['name'] == "Trainings" && $fs['selected']==true) {
                                    foreach ($fs['subsubfeatures'] as $ab) {

                                    }
                                }*/
                                if ($fs['name'] == "Adverse Incident" && $fs['selected']==true) {
                                    foreach ($fs['subsubfeatures'] as $ab) {
                                        if ($ab['name'] == "Add" && $ab['selected']==true) {
                                            $data['user_login']['Add_Adverse_Incident'] = 'Add';
                                        }
                                        if ($ab['name'] == "Edit" && $ab['selected']==true) {
                                            $data['user_login']['Edit_Adverse_Incident'] = 'Edit';
                                        }
                                    }
                                }
                            }
                        }
                        if ($v['name'] == "Reports" && $v['selected'] ==true) {
                            foreach ($v['subfeatures'] as $fg) {
                                if ($fg['name'] == "GatePass" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Report_Gatepass_Pdf'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['View_Gatepass_report'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Call Log" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['View_Call_Log'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Equipment Summary" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Report_Summary_Pdf'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Report_Summary_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Equipment Down Time" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Report_Downtime_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Equipment History" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Report_History_Pdf'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Report_History_View'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "CMS" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Cms_Pdf_Report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Cms_Pdf_View'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Monthly Performance Report" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Monthly_Pdf_Report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Monthly_Pdf_View'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Viability" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Viability_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Viability_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Adverse" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Adverse_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Adverse_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Services" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Service_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Service_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Deployment" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Deployment_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Deployment_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Replacement" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Replacement_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Replacement_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "PMS" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['PMS_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['PMS_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "QC" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['QC_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['QC_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Condemnation" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF"){
                                            $data['user_login']['Condemnation_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View"){
                                            $data['user_login']['Condemnation_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Indent" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF"){
                                            $data['user_login']['Indent_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View"){
                                            $data['user_login']['Indent_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "CEAR" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF"){
                                            $data['user_login']['CEAR_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View"){
                                            $data['user_login']['CEAR_pdf_view'] = 'View';
                                        }
                                    }
                                }

                            }
                        }
                        /*if ($v['name'] == "Call") {
                            foreach ($v['subfeatures'] as $f) {
                                if($f['name']=="Incident Call"){
                                    foreach($f['subsubfeatures'] as $j){
                                        if($j['name']=="View")
                                        {
                                            $data['user_login']['Incident_Call_View'] = 'View';
                                        }
                                    }

                                }
                                if($f['name']=="Transfer Call"){
                                    foreach($f['subsubfeatures'] as $j){
                                        if($j['name']=="View"){
                                            $data['user_login']['Transfer_Call_View'] = 'View';
                                        }
                                    }
                                }
                                if($f['name']=="Non-schedule Call"){
                                    foreach($f['subsubfeatures'] as $j){
                                        if($j['name']=="View"){
                                            $data['user_login']['Non_Call_View'] = 'View';
                                        }
                                    }
                                }
                                if($f['name']=="Condemnation Call"){
                                    foreach($f['subsubfeatures'] as $j){
                                        if($j['name']=="View"){
                                            $data['user_login']['Condmn_Call_View'] = 'View';
                                        }
                                    }
                                }
                            }
                        }*/
                    }
                }

            }
            else if ($unrc == HA_ADMIN) {

                $data['user_login'][$this->roles->ROLE_PATH] = $fdata['user_features'][$this->roles->ROLE_PATH];

                $data['user_login'][$this->roles->GENERAL_ASSET] = $fdata['user_features'][$this->roles->GENERAL_ASSET];
                $data['user_login'][$this->roles->EROLE_CODE] = $fdata['user_features'][$this->roles->EROLE_CODE];
                $data['user_login'][$this->roles->ROLE_CODE] = $fdata['user_features'][$this->roles->ROLE_CODE];
                $data['user_login'][$this->roles->ROLE_PRIORITY] = $fdata['user_features'][$this->roles->ROLE_PRIORITY];


                if ($data['user_login'][$this->users->FEATURES_LIST] == NULL || $data['user_login'][$this->users->FEATURES_LIST] == "") {
                    $data['user_login'][$this->users->FEATURES_LIST] = json_decode($fdata['user_features'][$this->roles->ROLE_FEATURES]);
                }
            } else {
                $data['user_login'][$this->organizations->ROLE_PATH] = $fdata['user_features'][$this->organizations->ROLE_PATH];

                $data['user_login'][$this->organizations->EROLE_CODE] = $fdata['user_features'][$this->organizations->EROLE_CODE];
                $data['user_login'][$this->organizations->ROLE_CODE] = $fdata['user_features'][$this->organizations->ROLE_CODE];
                $data['user_login'][$this->organizations->NO_OF_BRANCHES] = $fdata['user_features'][$this->organizations->NO_OF_BRANCHES];
                $data['user_login'][$this->organizations->NO_OF_USERS] = $fdata['user_features'][$this->organizations->NO_OF_USERS];
                $data['user_login'][$this->organizations->NO_OF_EQUPIMENTS] = $fdata['user_features'][$this->organizations->NO_OF_EQUPIMENTS];
                //$data['user_login'][$this->organizations->ORG_MODULE]   = $fdata['user_features'][$this->organizations->ORG_MODULE];

                if ($data['user_login'][$this->users->FEATURES_LIST] == NULL || $data['user_login'][$this->users->FEATURES_LIST] == "") {

                    $data['user_login'][$this->users->FEATURES_LIST] = json_decode($fdata['user_features'][$this->organizations->FEATURES], true);
                    $features = $data['user_login'][$this->users->FEATURES_LIST];
                    //return $features;

                    //echo $features; die();
                    foreach ($features['menu'] as $v) {
                        //

                        if ($v['name'] == "Equipment" && $v['selected'] == true) {

                            foreach ($v['subfeatures'] as $m) {
                                if ($m['name'] == "Indent" &&  $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {

                                        if ($n['name'] == "Add" && $n['selected'] == true) {
                                            $data['user_login']['Add_Indent'] = 'Add';
                                        }
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Indent'] = 'Edit';
                                        }
                                        if ($n['name'] == "Transfer" && $n['selected'] == true) {
                                            $data['user_login']['Transfer_Indent'] = 'Transfer';
                                        }
                                        if ($n['name'] == "Approve" && $n['selected'] == true) {
                                            $data['user_login']['Approve_Indent'] = 'Approve';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Indent'] = 'View';
                                        }
                                        if($n['name'] == "Rise CEAR" && $n['selected'] == true){

                                            $data['user_login']['Rise_Cear'] = 'Rise CEAR';

                                        }
                                        if($n['name'] == "GeneratePDF" && $n['selected'] == true){

                                            $data['user_login']['Indent_PDF_Generated'] = 'GeneratePDF';

                                        }
                                        if($n['name'] == "Sanction" && $n['selected'] == true){

                                            $data['user_login']['Sanction_Indent'] = 'Sanction';

                                        }
                                        if($n['name'] == "Sanctioned" && $n['selected'] == true){

                                            $data['user_login']['Sanctioned_Indent'] = 'Sanctioned';

                                        }
                                        if($n['name'] == "Stock" && $n['selected'] == true){

                                            $data['user_login']['Stock_Indent'] = 'Stock';

                                        }
                                    }
                                }

                                if ($m['name'] == "Cear" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Cear'] = 'Edit';
                                        }
                                        if ($n['name'] == "Approve" && $n['selected'] == true) {
                                            $data['user_login']['Approve_Cear'] = 'Approve';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Cear'] = 'View';
                                        }
                                    }
                                }

                                if ($m['name'] == "Gate Pass" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Add" && $n['selected'] == true) {
                                            $data['user_login']['Add_Gatepass'] = 'Add';
                                        }
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Gatepass'] = 'Approve';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Gatepass'] = 'View';
                                        }
                                    }
                                }
                                /*if($m['name'] == "Add Equipment" && $m['selected'] == true) {

                                }*/
                                if ($m['name'] == "View Equipment" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Equipment'] = 'Edit';
                                        }
                                        if ($n['name'] == "Replace" && $n['selected'] == true) {
                                            $data['user_login']['Replace_Equipment'] = 'Replace';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Equipment'] = 'View';
                                        }
                                    }
                                }
                                if ($m['name'] == "Print Labels" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Print" && $n['selected'] == true) {
                                            $data['user_login']['print_Equipment'] = 'Print Equipment';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Print'] = 'View';
                                        }

                                    }
                                }
                                if ($m['name'] == "Transfer" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Transfer'] = 'Edit';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Transfer'] = 'View';
                                        }

                                    }
                                }
                                if ($m['name'] == "Condemnation" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Condemnation'] = 'Edit';
                                        }
                                        if ($n['name'] == "Approve" && $n['selected'] == true) {
                                            $data['user_login']['Approve_Condemnation'] = 'Approve';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Condemnation'] = 'Approve';
                                        }

                                    }
                                }
                                if ($m['name'] == "Contracts" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Add" && $n['selected'] == true) {
                                            $data['user_login']['Add_Contracts'] = 'Add';
                                        }
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Contracts'] = 'Edit';
                                        }
                                        if ($n['name'] == "Renew" && $n['selected'] == true) {
                                            $data['user_login']['Renew_Contracts'] = 'Renew';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Contracts'] = 'View';
                                        }

                                    }
                                }
                                if ($m['name'] == "Viability" && $m['selected'] == true) {
                                    foreach ($m['subsubfeatures'] as $n) {
                                        if ($n['name'] == "Add" && $n['selected'] == true) {
                                            $data['user_login']['Add_Viability'] = 'Add';
                                        }
                                        if ($n['name'] == "Edit" && $n['selected'] == true) {
                                            $data['user_login']['Edit_Viability'] = 'Edit';
                                        }
                                        if ($n['name'] == "GeneratePDF" && $n['selected'] == true) {
                                            $data['user_login']['Viability_Generate_PDF'] = 'GeneratePDF';
                                        }
                                        if ($n['name'] == "View" && $n['selected'] == true) {
                                            $data['user_login']['View_Viabilty'] = 'View';
                                        }

                                    }
                                }
                            }
                        }
                        if ($v['name'] == "Setup" && $v['selected'] == true) {

                            foreach ($v['subfeatures'] as $f) {
                                if ($f['name'] == "Vendors" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Vendor'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Vendor'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Vendor'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Modules" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Module'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Module'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Module'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Countries" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Country'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Country'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Country'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "States" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_State'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_State'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_State'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Cities" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_City'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_City'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_City'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Users" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_User'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_User'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_User'] = 'View';
                                        }
                                    }
                                }

                                if ($f['name'] == "Contract Types" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Contract_Type'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Contract_Type'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Contract_Type'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Branches" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Branches'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Branches'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Branches'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Escalation Types" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Escalation_type'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Escalation_type'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Escalation_type'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Escalations" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Escalations'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Escalations'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Escalations'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Escalation Levels" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Escalationlevel'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Escalationlevel'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Escalationlevel'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Cear Category" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Cear_Category'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Cear_Category'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Cear_Category'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Training Types" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Training_Type'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Training_Type'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Training_Type'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Reasons" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Reasons'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Reasons'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Reasons'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Departments" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Department'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Department'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Department'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Categories" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Category'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Category'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Cateogry'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Deployment" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Deployment'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Deployment'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Deployment'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Conditions" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Condition'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Condition'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Condition'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Classes" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Classes'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Classes'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Classes'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Utilizations" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Utilization'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Utilization'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View") {
                                            $data['user_login']['View_Utilization'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Status" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Status'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Status'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Status'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Classifications" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Classification'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Classification'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Classification'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Equipment Types" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Equipment_Type'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Equipment_Type'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Equipment_Type'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Incident Type" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Incident_Type'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Incident_Type'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Incident_Type'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "Roles" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_Role'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_Role'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_Role'] = 'View';
                                        }
                                    }
                                }
                                if ($f['name'] == "CEAR Type" && $f['selected'] == true) {

                                    foreach ($f['subsubfeatures'] as $fff) {
                                        if ($fff['name'] == "Add" && $fff['selected'] == true) {
                                            $data['user_login']['Add_CEAR_TYPE'] = 'Add';
                                        }
                                        if ($fff['name'] == "Edit" && $fff['selected'] == true) {
                                            $data['user_login']['Edit_CEAR_TYPE'] = 'Edit';
                                        }
                                        if ($fff['name'] == "View" && $fff['selected'] == true) {
                                            $data['user_login']['View_CEAR_TYPE'] = 'View';
                                        }
                                    }
                                }
                            }
                        }
                        if ($v['name'] == "CMS" && $v['selected']==true) {
                            foreach ($v['subfeatures'] as $fs) {
                                if ($fs['name'] == "Open Calls" && $fs['selected']==true) {
                                    foreach ($fs['subsubfeatures'] as $ab) {

                                        if ($ab['name'] == "Respond" && $ab['selected']==true) {
                                            $data['user_login']['Respond_Open_Calls'] = 'Respond';
                                        }
                                        if ($ab['name'] == "Attend" && $ab['selected']==true) {
                                            $data['user_login']['Attend_Open_Calls'] = 'Attend';
                                        }
                                        if ($ab['name'] == "Hold" && $ab['selected']==true) {
                                            $data['user_login']['Hold_Open_Calls'] = 'Hold';
                                        }
                                        if ($ab['name'] == "Complete" && $ab['selected']==true) {
                                            $data['user_login']['Complete_Open_Calls'] = 'Complete';
                                        }
                                        if ($ab['name'] == "View" && $ab['selected']==true) {
                                            $data['user_login']['View_Open_Calls'] = 'View';
                                        }
                                    }
                                }
                               /* if ($fs['name'] == "Scheduled Calls" && $fs['selected']==true) {
                                    foreach ($ab['subsubfeatures'] as $ab) {

                                    }
                                }*/
                                if($fs['name']=="Incident Call" && $fs['selected']==true){
                                    foreach($fs['subsubfeatures'] as $ab){
                                        if($ab['name']=="View" && $ab['selected']==true)
                                        {
                                            $data['user_login']['Incident_Call_View'] = 'View';
                                        }
                                    }

                                }
                                if($fs['name']=="Transfer Call" && $fs['selected']==true){
                                    foreach($fs['subsubfeatures'] as $ab){
                                        if($ab['name']=="View" && $ab['selected']==true){
                                            $data['user_login']['Transfer_Call_View'] = 'View';
                                        }
                                    }
                                }
                                if($fs['name']=="Non-schedule Call" && $fs['selected']==true){
                                    foreach($fs['subsubfeatures'] as $ab){
                                        if($ab['name']=="View" && $ab['selected']==true){
                                            $data['user_login']['Non_Call_View'] = 'View';
                                        }
                                    }
                                }
                                if($fs['name']=="Condemnation Call" && $fs['selected']==true){
                                    foreach($fs['subsubfeatures'] as $ab){
                                        if($ab['name']=="View" && $ab['selected']==true){
                                            $data['user_login']['Condmn_Call_View'] = 'View';
                                        }
                                    }
                                }
                               /* if ($fs['name'] == "Trainings" && $fs['selected']==true) {
                                    foreach ($fs['subsubfeatures'] as $ab) {

                                    }
                                }*/
                                if ($fs['name'] == "Adverse Incident" && $fs['selected']==true) {
                                    foreach ($fs['subsubfeatures'] as $ab) {
                                        if ($ab['name'] == "Add" && $ab['selected']==true) {
                                            $data['user_login']['Add_Adverse_Incident'] = 'Add';
                                        }
                                        if ($ab['name'] == "Edit" && $ab['selected']==true) {
                                            $data['user_login']['Edit_Adverse_Incident'] = 'Edit';
                                        }
                                    }
                                }
                            }
                        }
                        if ($v['name'] == "Reports" && $v['selected'] ==true) {
                            foreach ($v['subfeatures'] as $fg) {
                                if ($fg['name'] == "GatePass" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Report_Gatepass_Pdf'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['View_Gatepass_report'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Call Log" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['View_Call_Log'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Equipment Summary" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Report_Summary_Pdf'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Report_Summary_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Equipment Down Time" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Report_Downtime_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Equipment History" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Report_History_Pdf'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Report_History_View'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "CMS" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Cms_Pdf_Report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Cms_Pdf_View'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Monthly Performance Report" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Monthly_Pdf_Report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Monthly_Pdf_View'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Viability" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Viability_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Viability_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Adverse" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Adverse_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Adverse_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Services" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Service_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Service_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Deployment" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Deployment_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Deployment_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Replacement" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Replacement_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Replacement_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "PMS" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['PMS_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['PMS_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "QC" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['QC_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['QC_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Condemnation" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Condemnation_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Condemnation_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "Indent" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['Indent_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['Indent_pdf_view'] = 'View';
                                        }
                                    }
                                }
                                if ($fg['name'] == "CEAR" && $fg['selected'] ==true) {
                                    foreach ($fg['subsubfeatures'] as $ac) {
                                        if($ac['name']=="GeneratePDF" && $ac['selected'] ==true){
                                            $data['user_login']['CEAR_pdf_report'] = 'GeneratePDF';
                                        }
                                        if($ac['name']=="View" && $ac['selected'] ==true){
                                            $data['user_login']['CEAR_pdf_view'] = 'View';
                                        }
                                    }
                                }

                            }
                        }
                        /*if ($v['name'] == "Call") {
                                             foreach ($v['subfeatures'] as $f) {
                                                 if($f['name']=="Incident Call"){
                                                     foreach($f['subsubfeatures'] as $j){
                                                         if($j['name']=="View")
                                                         {
                                                             $data['user_login']['Incident_Call_View'] = 'View';
                                                         }
                                                     }

                                                 }
                                                 if($f['name']=="Transfer Call"){
                                                     foreach($f['subsubfeatures'] as $j){
                                                         if($j['name']=="View"){
                                                             $data['user_login']['Transfer_Call_View'] = 'View';
                                                         }
                                                     }
                                                 }
                                                 if($f['name']=="Non-schedule Call"){
                                                     foreach($f['subsubfeatures'] as $j){
                                                         if($j['name']=="View"){
                                                             $data['user_login']['Non_Call_View'] = 'View';
                                                         }
                                                     }
                                                 }
                                                 if($f['name']=="Condemnation Call"){
                                                     foreach($f['subsubfeatures'] as $j){
                                                         if($j['name']=="View"){
                                                             $data['user_login']['Condmn_Call_View'] = 'View';
                                                         }
                                                     }
                                                 }
                                             }
                                         }*/
                    }


                }
            }
        }
        if ($branch == '' || $branch == HMADMIN || $branch == 'All')
            $data['user_login']['BRANCH_NAME'] = "";
        else
            $data['user_login']['BRANCH_NAME'] = $this->basemodel->get_single_column_value($this->branches->tbl_name, $this->branches->BRANCH_NAME, array($this->branches->BRANCH_ID => $branch));


        if ($this->shref != NULL) {

            $usersession = array();
            $usersession['is_login'] = TRUE;
            $usersession['role_priority'] = $data['user_login'][$this->orgroles->ROLE_PRIORITY];
            $usersession['erole_code'] = $data['user_login'][$this->orgroles->EROLE_CODE];
            $usersession['gen_asset'] = $data['user_login'][$this->orgroles->GENERAL_ASSET];
            $usersession['role_path'] = $data['user_login'][$this->orgroles->ROLE_PATH];
            $usersession['role_code'] = $data['user_login'][$this->users->ROLE_CODE];
            $usersession['user_id'] = $data['user_login'][$this->users->USER_ID];
            $usersession['user_name'] = $data['user_login'][$this->users->USER_NAME];
            $usersession['email_id'] = $data['user_login'][$this->users->EMAIL_ID];
            $usersession['mobile_no'] = $data['user_login'][$this->users->MOBILE_NO];
            $usersession['org_id'] = $data['user_login'][$this->users->ORG_ID];

            if ($usersession['role_code'] != HA_ADMIN) {
                $data['user_login']['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $usersession['org_id']));
                $usersession['org_type'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_TYPE, array($this->organizations->ORG_ID => $usersession['org_id']));

                $usersession['org_logo'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->LOGO, array($this->organizations->ORG_ID => $usersession['org_id']));

                $data['user_login'][$this->organizations->ORG_TYPE] = $usersession['org_type'];
                $data['user_login'][$this->organizations->LOGO] = $usersession['org_logo'];

            } else {

                $usersession['org_type'] = "";
                $data['user_login'][$this->organizations->ORG_TYPE] = "";
            }
            $usersession['branch_name'] = $data['user_login']['BRANCH_NAME'];
            $usersession['org_name'] = $data['user_login']['ORG_NAME'];
            $usersession['org_type'] = $data['user_login']['ORG_TYPE'];
            $usersession['branch_id'] = $branch;
            $usersession['dept_id'] = $data['user_login'][$this->users->DEPT_CODE];
            $usersession['emp_no'] = $data['user_login'][$this->users->EMP_NO];
            $this->session->set_userdata($usersession);
        } else {
            if ($fcm_id != '') {
                $usersession = array();
                $data['user_login']['ORG_NAME'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_NAME, array($this->organizations->ORG_ID => $data['user_login'][$this->users->ORG_ID]));
                $usersession['org_type'] = $this->basemodel->get_single_column_value($this->organizations->tbl_name, $this->organizations->ORG_TYPE, array($this->organizations->ORG_ID => $data['user_login'][$this->users->ORG_ID]));


                $data['user_login'][$this->organizations->ORG_TYPE] = $usersession['org_type'];


                $fcm_update = array();
                $fcm_update['name'] = $data['user_login'][$this->users->USER_NAME];
                $fcm_update['username'] = $data['user_login'][$this->users->EMP_NO];
                $fcm_update['reg_id'] = $fcm_id;
                $fcm_update1 = json_encode($fcm_update);
                $fcm_update2 = json_decode($fcm_update1);
                $this->_update_user($fcm_update2);
            }

        }
        $data['response'] = SUCCESSDATA;

        return $data;

    }
    private function _ha_generate_password($paswrd)
    {
        if($this->ha_content_type==$this->baseauth->appjson)
        {
            $hash = $this->bcrypt->hash_password($paswrd);
            return $hash;
        }
    }

    private function _ha_check_password($paswrd='',$hashcode='')
    {
        if($this->ha_content_type==$this->baseauth->appjson)
        {
            if($this->bcrypt->check_password($paswrd, $hashcode))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    private function _update_user($jodata=array())
    {
        if(!empty($jodata))
        {
            $name = $jodata->name;
            $username = $jodata->username;
            $reg_id = $jodata->reg_id;
            $select = array($this->users->USER_ID, $this->users->EMAIL_ID,$this->users->MOBILE_NO);
            $where[$this->users->EMP_NO] = $username;
            $user = $this->basemodel->fetch_single_row($this->users->tbl_name,$where,$select);
            if(!empty($user))
            {
                $data['response'] = SUCCESSDATA;
                $update_user[$this->users->GCM_ID] = $reg_id;
                if($this->basemodel->update_operation($update_user,$this->users->tbl_name,array($this->users->USER_ID=>$user[$this->users->USER_ID])))
                {
                    $data['updated']= 'yes';
                    $gcm_ids = array($reg_id);
                    $notifcation = "Welcome to Hospiasset ".$name;
                    $notifcation_res = $this->baselibrary->send_push_notification($gcm_ids,$notifcation);
                    if($notifcation_res!==FALSE)
                    {
                        $notifcation_json = json_decode($notifcation_res);
                        $data['notification_success'] = $notifcation_json->success;
                        $data['notification'] = "sent";
                    }
                    else
                        $data['notification'] = 'not sent';
                }
                else
                {
                    $data['updated']= 'no';
                }
            }
            else
                $data['response'] = FAILEDATA;
            return $data;
        }
    }

    private function _check_fcm_exists($jodata=array())
    {
        if(!empty($jodata) && $this->ha_content_type==$this->baseauth->appjson)
        {
            $data1 = $this->basemodel->fetch_records_from($this->users->tbl_name,array($this->users->GCM_ID=>$jodata->fcm_id),$this->users->GCM_ID);
            if(!empty($data1))
                $data['response'] = SUCCESSDATA;
            else
                $data['response'] = FAILEDATA;
        }
        return $data;
    }

    public function logout()
    {
        $user_session_ary = array('is_login','role_code','user_id','user_name','email_id','mobile_no','org_id','branch_id','dept_id','emp_no','branch_name','gen_asset','org_type');
        $this->session->unset_userdata($user_session_ary);
        redirect(base_url(),'refresh');
    }
    private function _get_ccc_user_dtls($jodata)
    {

        if ($this->ccc_con != null) {
            $data = array();
            $emp_id = $jodata->emp_id;
            $qry = "select * from EMPLOYEES where EMP_CODE = '$emp_id'";
            // return $qry;
            $result = odbc_exec($this->ccc_con, $qry);
            if ($result) {
                while ($info = odbc_fetch_array($result)) {
                    $content = $info;
                }
                if (!empty($content)) {
                    $data['emp_dtls'] = $content;
                    $data['response'] = SUCCESSDATA;
                } else {
                    $data['emp_dtls'] = array();
                    $data['response'] = EMPTYDATA;
                }
            } else {
                $data['emp_dtls'] = array();
                $data['response'] = FAILEDATA;
            }
        }
        else {

            $where = array();
            $data = array();
            $where[$this->users->EMP_NO] = $jodata->emp_id;
            $result = $this->basemodel->fetch_records_from($this->users->tbl_name, $where);

            if (!empty($result)) {
                $data['emp_dtls'] = $result;
                $data['response'] = SUCCESSDATA;
            } else {
                $data['emp_dtls'] = array();
                $data['response'] = EMPTYDATA;
            }
        }

        return $data;
    }
    public function ccc_mail($mid)
    {
        $content = array();
        $qry = "select * from EMPLOYEES where MOBILE_PHONE = '$mid'";
        $result = odbc_exec($this->ccc_con,$qry);
        while($info = odbc_fetch_array($result))
        {
            $content = $info;
        }
        print_r($content);
    }

    private function _check_session_exists()
    {
        $data = array();
        if($this->session->user_id!='')
            $data['response'] =  SUCCESSDATA;
        else
            $data['response'] =  FAILEDATA;
        return $data;
    }
    private function _clear_fcm_id($jodata)
    {
        $data = array();
        if(isset($jodata->user_id) && $jodata->user_id!='')
        {
            $user_id = $jodata->user_id;
            $uidata[$this->users->GCM_ID] = NULL;
            $where[$this->users->USER_ID] = $user_id;
            if($this->basemodel->update_operation($uidata,$this->users->tbl_name,$where))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Logged out Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Problem Occurred";
            }
        }
        return $data;
    }
    private function _get_version($jodata)
    {
        $data = array();
        if(isset($jodata->user_id) && $jodata->user_id!='')
        {
            $user_id = $jodata->user_id;
            $uidata[$this->users->GCM_ID] = NULL;
            $where[$this->users->USER_ID] = $user_id;
            if($this->basemodel->update_operation($uidata,$this->users->tbl_name,$where))
            {
                $data['response'] = SUCCESSDATA;
                $data['call_back'] = "Logged out Successfully";
            }
            else
            {
                $data['response'] = FAILEDATA;
                $data['call_back'] = "Problem Occurred";
            }
        }
        return $data;
    }
}

/* End of file Auth.php */
/* Location: .//C/Users/Renown/AppData/Local/Temp/fz3temp-1/Auth.php */
