<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deviceamcs extends CI_Model
{
    public $tbl_name = "device_amcs";

    public $ID           = "ID";
    public $RID           = "RID";
    public $ORG_ID       = "ORG_ID";
    public $BRANCH_ID    = "BRANCH_ID";
    public $EID          = "EID";
    public $AMC_VENDOR   = "AMC_VENDOR";
    public $AMC_TYPE     = "AMC_TYPE";
    public $AMC_VALUE    = "AMC_VALUE";
    public $AMC_FROM     = "AMC_FROM";
    public $AMC_TO       = "AMC_TO";
    public $ADDED_ON     = "ADDED_ON";
    public $ADDED_BY     = "ADDED_BY";
    public $UPDATED_ON   = "UPDATED_ON";
    public $UPDATED_BY   = "UPDATED_BY";
    public $UPDATE_TYPE   = "UPDATE_TYPE";
    public $STATUS       = "STATUS";
    public $REMARKS      = "REMARKS";
}
