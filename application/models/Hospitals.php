<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospitals extends CI_Model
{
    public $tbl_name = "hospital_url";

    public $ID		= "ID";
    public $ORG_ID = "ORG_ID";
    public $ORGNAME	= "ORGNAME";
    public $ORGURL	= "ORGURL";
    public $ORGLOGO	= "ORGLOGO";
    public $STATUS  = "STATUS";
}

/* End of file Hospitals.php */
/* Location: ./application/models/Hospitals.php */