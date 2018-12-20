<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gatepass extends CI_Model
{
    public $tbl_name = "gatepass";

    public $ID   	        = "ID";
    public $GP_ID           = "GP_ID";
    public $E_ID   	        = "E_ID";
    public $BRANCH_ID       = "BRANCH_ID";
    public $ORG_ID          = "ORG_ID";
    public $DEPT_ID         = "DEPT_ID";		public $INDENT_ID       = "INDENT_ID";
    public $TO_WHOME        = "TO_WHOME";
    public $RETURN_TYPE     = "RETURN_TYPE";
    public $SPARES          = "SPARES";
    public $ACCESSORIES     = "ACCESSORIES";
    public $SPARES_CNT      = "SPARES_CNT";
    public $ACCESSORIES_CNT = "ACCESSORIES_CNT";
    public $EQ_NAME         = "EQ_NAME";
    public $LOCATION        = "LOCATION";
    public $VENDOR_ID       = "VENDOR_ID";
    public $REMARKS         = "REMARKS";
    public $REASONS         = "REASONS";
    public $ADDED_ON        = "ADDED_ON";
    public $ADDED_BY        = "ADDED_BY";
    public $UPDATED_ON      = "UPDATED_ON";
    public $UPDATED_BY      = "UPDATED_BY";
    public $EXPECTED_RETURN = "EXPECTED_RETURN";
}

/* End of file Equphistory.php */
/* Location: ./application/models/Equphistory.php */