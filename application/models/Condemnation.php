<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Condemnation extends CI_Model
{
    public $tbl_name = "condemnation";

    public $ID   	        = "ID";
    public $ORG_ID          = "ORG_ID";
    public $BRANCH_ID	    = "BRANCH_ID";
    public $DEPT_ID         = "DEPT_ID";
    public $EQUP_ID         = "EQUP_ID";
    public $REASON          = "REASONS";
    public $REUSABLE_PARTS  = "REUSABLE_PARTS";
    public $AMC_TYPE        = "AMC_TYPE";
    public $EXPECTED_COST   = "EXPECTED_COST";
    public $DATE_TIME       = "DATE_TIME";
    public $FEEDBACK        = "FEEDBACK";
    public $ADDED_ON        = "ADDED_ON";
    public $ADDED_BY        = "ADDED_BY";
    public $UPDATED_ON      = "UPDATED_ON";
    public $UPDATED_BY      = "UPDATED_BY";
    public $ADMIN_FEEDBACK  = "ADMIN_FEEDBACK";
    public $STATUS	        = "STATUS";
    public $CONDEMNATION_STATUS = "CONDEMNATION_STATUS";
    public $RESOLD_VALUE = "RESOLD_VALUE";
    public $REASON2= "REASON2";
    public $FEEDBACK2= "FEEDBACK2";
    public $APPROVED_BY= "APPROVED_BY";

}

/* End of file Equphistory.php */
/* Location: ./application/models/Equphistory.php */