<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branches extends CI_Model
{
     public $tbl_name = "branches";

     public $BRANCH_AID        = "BRANCH_AID";
     public $BRANCH_ID         = "BRANCH_ID";
     public $BRANCH_CODE       = "BRANCH_CODE";
     public $BRANCH_ERP_CODE   = "BRANCH_ERP_CODE";
     public $BRANCH_NAME       = "BRANCH_NAME";
     public $ORG_ID            = "ORG_ID";	 	 public $ORG_MODULE        = "ORG_MODULE";
     public $BRANCH_ADDRESS    = "BRANCH_ADDRESS";
     public $STATE             = "STATE";
     public $CATEGORY          = "CATEGORY";
     public $ADDED_ON          = "ADDED_ON";
     public $ADDED_BY          = "ADDED_BY";
     public $UPDATED_ON        = "UPDATED_ON";
     public $UPDATED_BY        = "UPDATED_BY";
     public $CITY              = "CITY";
     public $STATUS            = "STATUS";
}
