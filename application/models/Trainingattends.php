<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TrainingAttends extends CI_Model
{
	public $tbl_name = "training_attends";

	public $ID			= "ID";
	public $TID			= "TID";
	public $ORG_ID		= "ORG_ID";
	public $BRANCH_ID	= "BRANCH_ID";
	public $DEPT_ID		= "DEPT_ID";
	public $USER_NAME	= "USER_NAME";
	public $FEEDBACK	= "FEEDBACK";
	public $TOPIC 		= "TOPIC";
	public $MAKE_OEM 	= "MAKE_OEM";
	public $EQ_MODEL 	= "EQ_MODEL";
	public $UNDRSTD_TRNG 	= "UNDRSTD_TRNG";
	
	public $TRNG_LNGTH 	= "TRNG_LNGTH";
	public $NEW_INFO_IN_TRNG 	= "NEW_INFO_IN_TRNG";
	public $ON_JOB_USE_OF_TRNG 	= "ON_JOB_USE_OF_TRNG";
	public $EXAMPLES_HTLP_IN_TRNG 	= "EXAMPLES_HTLP_IN_TRNG";
	public $USEFULNES_IN_CURENT_JOB 	= "USEFULNES_IN_CURENT_JOB";
	public $TRAINER_ACTIVNES 	= "TRAINER_ACTIVNES";
	public $DOUBTS_CLARIFY_TRAINER 	= "DOUBTS_CLARIFY_TRAINER";
	public $OVER_ALL_MARKS 	= "OVER_ALL_MARKS";
	public $SUBJECT_FIT_TO_TRAIN 	= "SUBJECT_FIT_TO_TRAIN";
	public $TRAINING_FEDBACK_RATING 	= "TRAINING_FEDBACK_RATING";
	public $APPROVED_BY	= "APPROVED_BY";
	public $STATUS		= "STATUS";
	public $ADDED_ON	= "ADDED_ON";
}

/* End of file TrainingAttends.php */
/* Location: ./application/models/TrainingAttends.php */