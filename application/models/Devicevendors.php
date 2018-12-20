<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DeviceVendors extends CI_Model
{
    public $tbl_name = "device_vendors";

    public $ID				=	"ID";		public $ORG_MODULE = "ORG_MODULE";			public $ORG_ID   = "ORG_ID";
    public $NAME			=	"NAME";
    public $MOBILE_NO		=	"MOBILE_NO";		
    public $EMAIL_ID		=	"EMAIL_ID";
    public $CP_NAME		    =	"CP_NAME";
    public $CP_NUMBER	    =	"CP_NUMBER";
    public $CP_EMAIL		=	"CP_EMAIL";
    public $TYPE		    =	"TYPE";
    public $ADDRESS		    =	"ADDRESS";
    public $ADDED_ON	    =	"ADDED_ON";
    public $ADDED_BY	    =	"ADDED_BY";
    public $UPDATED_ON	    =	"UPDATED_ON";
    public $UPDATED_BY	    =	"UPDATED_BY";
    public $STATUS  	    = "STATUS";
}

/* End of file Rounds.php */
/* Location: ./application/models/Rounds.php */