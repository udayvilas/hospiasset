<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Rounds_Assigned extends CI_Model

{

    public $tbl_name = "rounds_assigned";



    public $ID				=	"ID";

    public $ORG_ID			=	"ORG_ID";

    public $BRANCH_ID		=	"BRANCH_ID";

    public $DEPT_ID			=	"DEPT_ID";

    public $ASSIGNED_BY		=	"ASSIGNED_BY";

    public $ASSIGNED_TO		=   "ASSIGNED_TO";

    public $ASSIGNED_FROM	=   "ASSIGNED_FROM";

    public $ROUND_DATE		=	"ROUND_DATE";

    public $COMPLETED_ON	=	"COMPLETED_ON";

    public $REMARKS			=	"REMARKS";

    public $IMAGE           =  "IMAGE";

    public $ADDED_ON		=	"ADDED_ON";

    public $STATUS		    =	"STATUS";

}



/* End of file Rounds.php */

/* Location: ./application/models/Rounds.php */