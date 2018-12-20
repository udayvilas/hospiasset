<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Scheduledcalls extends CI_Model

{

    public $tbl_name = "scheduledcalls";



    public $ID				=	"ID";

    public $SCHEDULE_TYPE		=	"SCHEDULE_TYPE";

    public $BRANCH_ID		=	"BRANCH_ID";

    public $ORG_ID			=	"ORG_ID";

    public $USERNAME		=	"USERNAME";

    public $REPEATED		=	"REPEATED";

    public $YEAR            =   "YEAR";

    public $MONTH           =  "MONTH";

    public $DAY             =  "DAY";

    public $REMARKS			=	"REMARKS";

    public $ADDED_ON		=	"ADDED_ON";

    public $ADDED_BY		=	"ADDED_BY";

    public $UPDATED_ON		=	"UPDATED_ON";

    public $UPDATED_BY		=	"UPDATED_BY";

}



/* End of file Rounds.php */

/* Location: ./application/models/Rounds.php */