<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Model
{
	public $tbl_name = "stock";

	public $ID   	= "ID";
	public $ORG_ID  = "ORG_ID";
	public $BRANCH_ID	= "BRANCH_ID";
	public $GENERAL_ASSET	= "GENERAL_ASSET";
	public $DEPT_ID  = "DEPT_ID";
	public $INDENT_ID  = "INDENT_ID";
	public $INDENT_TYPE  = "INDENT_TYPE";
	public $IN_STOCK  = "IN_STOCK";
	public $OUT_ON  = "OUT_ON";
	public $OUT_BY  = "OUT_BY";
	public $USERNAME  = "USERNAME";
	public $E_NAME  = "E_NAME";
	public $E_TYPE  = "E_TYPE";
	public $E_CAT  = "E_CAT";
	public $ACCSSORIES  = "ACCSSORIES";
	public $C_NAME  = "C_NAME";
	public $E_MODEL  = "E_MODEL";
	public $EQ_CLASS  = "EQ_CLASS";
	public $ES_NUMBER  = "ES_NUMBER";
	public $DISTRIBUTOR  = "DISTRIBUTOR";
	public $VENDOR  = "VENDOR";
	public $PONO  = "PONO";
	public $PDATE  = "PDATE";
	public $UPLOAD_PATH  = "UPLOAD_PATH";
	public $DATEOF_INSTALL  = "DATEOF_INSTALL";
	public $E_COST  = "E_COST";
	public $AMC_TYPE  = "AMC_TYPE";
	public $AMC_VALUE  = "AMC_VALUE";
	public $C_FROM  = "C_FROM";
	public $C_TO  = "C_TO";
	public $UTILIZATION  = "UTILIZATION";
	public $E_COND  = "E_COND";
	public $REMARKS  = "REMARKS";
	public $QR_CODE  = "QR_CODE";
	public $USER_INSTALL  = "USER_INSTALL";
	public $GRN_DATE  = "GRN_DATE";
	public $GRN_VALUE  = "GRN_VALUE";
	public $ADDED_ON  = "ADDED_ON";
	public $UPDATED_ON  = "UPDATED_ON";
	public $ADDED_BY  = "ADDED_BY";
	public $UPDATED_BY  = "UPDATED_BY";
	public $EQ_CONDATION  = "EQ_CONDATION";
	public $DESC_P  = "DESC_P";
	public $MF_DATE  = "MF_DATE";
	public $ORGINAL_ID  = "ORGINAL_ID";
	public $PHY_LOCATION  = "PHY_LOCATION";
	public $SPARES  = "SPARES";
	public $HOSPITAL_ASSET_CODE  = "HOSPITAL_ASSET_CODE";
	public $END_OF_LIFE  = "END_OF_LIFE";
	public $END_OF_SUPPORT  = "END_OF_SUPPORT";
	public $STATUS  = "STATUS";
}

/* End of file Equphistory.php */
/* Location: ./application/models/Equphistory.php */