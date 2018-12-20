<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devicenames extends CI_Model
{
    public $tbl_name = "m_device_names";

    public $ID        = "ID";
    public $NAME      = "NAME";		public $ORG_MODULE = "ORG_MODULE";
    public $EQ_TYPE   = "EQ_TYPE";
    public $CODE      = "CODE";
    public $PRIORITY  = "PRIORITY";
    public $STATUS    = "STATUS";
}
