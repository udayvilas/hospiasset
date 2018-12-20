<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rounds extends CI_Model
{
	public $tbl_name = "rounds";
	
	public $ID				=	"ID";
	public $ORG_ID			=	"ORG_ID";
	public $BRANCH_ID		=	"BRANCH_ID";
	public $DEPT_ID			=	"DEPT_ID";
	public $USERNAME		=	"USERNAME";
	public $DESG			=	"DESG";
	public $START_DATE		=	"START_DATE";
	public $START_TIME		=	"START_TIME";
	public $REMARKS			=	"REMARKS";
	public $SUGESSIONS		=	"SUGESSIONS";
	public $END_TIME		=	"END_TIME";
	public $ADDED_ON		=	"ADDED_ON";
	public $ADDED_BY		=	"ADDED_BY";
	public $UPDATED_ON		=	"UPDATED_ON";
	public $UPDATED_BY		=	"UPDATED_BY";
}

/* End of file Rounds.php */
/* Location: ./application/models/Rounds.php */