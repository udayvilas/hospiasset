<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dbrkdwns extends CI_Model
{
    public $tbl_name = "device_breakdowns";

    public $ID           = "ID";
    public $ORG_ID       = "ORG_ID";
    public $BRANCH_ID    = "BRANCH_ID";
    public $EID          = "EID";
    public $BD_DATETIME  = "BD_DATETIME";
    public $BD_COST      = "BD_COST";
    public $BD_COUNT     = "BD_COUNT";
    public $ADDED_BY     = "ADDED_BY";
    public $ADDED_ON     = "ADDED_ON";
    public $UPDATED_ON   = "UPDATED_ON";
    public $UPDATED_BY   = "UPDATED_BY";
    public $STATUS       = "STATUS";
}
