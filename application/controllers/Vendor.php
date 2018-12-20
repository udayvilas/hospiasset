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
        $this->load->model('organizations');
        $this->load->model('aptorganizations');
        $this->load->model('appointments');
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
                if ($branchs[$this->users->ORG_BRANCH_ID] != null) {
                    $branchs = explode(',', $branchs[$this->users->ORG_BRANCH_ID]);
                    $branch = array();
                    foreach ($branchs as $x)
                        array_push($branch, "'" . $x . "'");
                    $branch = '(' . implode($branch, ',') . ')';
                } else {
                    $branchs = $this->basemodel->fetch_records_from($this->branches->tbl_name, array($this->branches->STATUS => ACTIVESTS), $this->branches->BRANCH_ID);
                    for ($i = 0; $i < count($branchs); $i++)
                        $branch[$i] = "'" . $branchs[$i]['BRANCH_ID'] . "'";
                    $branch = '(' . implode($branch, ',') . ')';
                }
            }
            defined('BRANCHALL') OR define('BRANCHALL', $branch);


        }
    }

    public function vendor_home()
    {
        $this->load->view('vendor/load_hospitals');
    }
    public function add_asset()
    {

        $this->load->view('vendor/add-device');
    }
}
