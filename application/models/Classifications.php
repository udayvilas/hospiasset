<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classifications extends CI_Model
{
    public $tbl_name = "m_classifications";

    public $ID		         = "ID";
    public $MASTER_CLASS	 = "MASTER_CLASS";
    public $RESPONSIBLE_DEPT = "RESPONSIBLE_DEPT";
    public $CODE	         = "CODE";
    public $STATUS  	= "STATUS";
}

/* End of file Classifications.php */
/* Location: ./application/models/Classifications.php */