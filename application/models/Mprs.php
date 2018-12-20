<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mprs extends CI_Model
{
	public $tbl_name = "mprs";

	public $ID    		= "ID";
	public $YEARMONTH   = "YEARMONTH";
	public $ORG_ID    	= "ORG_ID";
	public $BRANCH_ID   = "BRANCH_ID";
	public $DEPT_ID    	= "DEPT_ID";
	public $USERNAME    = "USERNAME";
	public $GENON    	= "GENON";
	public $NSBFBMD    	= "NSBFBMD";
	public $NSADBMD    	= "NSADBMD";
	public $NSTOTBMD    = "NSTOTBMD";
	public $NSCMPBMD    = "NSCMPBMD";
	public $NSBFWBD    	= "NSBFWBD";
	public $NSADWBD    	= "NSADWBD";
	public $NSTOTWBD    = "NSTOTWBD";
	public $NSCMPWBD    = "NSCMPWBD";
	public $NSBFCBD    	= "NSBFCBD";
	public $NSADCBD    	= "NSADCBD";
	public $NSTOTCBD    = "NSTOTCBD";
	public $NSCMPCBD    = "NSCMPCBD";
	public $NSBFOS    	= "NSBFOS";
	public $NSADOS    	= "NSADOS";
	public $NSTOTOS    	= "NSTOTOS";
	public $NSCMPOS    	= "NSCMPOS";
	public $NSBFTOT    	= "NSBFTOT";
	public $NSADTOT    	= "NSADTOT";
	public $NSTOTTOT    = "NSTOTTOT";
	public $NSCMPTOT    = "NSCMPTOT";
	public $NSRTLTBMD   = "NSRTLTBMD";
	public $NSRTLSBMD   = "NSRTLSBMD";
	public $NSRTGSBMD   = "NSRTGSBMD";
	public $NSRTLTWBD   = "NSRTLTWBD";
	public $NSRTLSWBD   = "NSRTLSWBD";
	public $NSRTGSWBD   = "NSRTGSWBD";
	public $NSRTLTCBD   = "NSRTLTCBD";
	public $NSRTLSCBD   = "NSRTLSCBD";
	public $NSRTGSCBD   = "NSRTGSCBD";
	public $NSRTLTOS    = "NSRTLTOS";
	public $NSRTLSOS    = "NSRTLSOS";
	public $NSRTGSOS    = "NSRTGSOS";
	public $NSRTLTTOT   = "NSRTLTTOT";
	public $NSRTLSTOT   = "NSRTLSTOT";
	public $NSRTGSTOT   = "NSRTGSTOT";
	public $NSTTRLODBMD = "NSTTRLODBMD";
	public $NSTTRLTDBMD = "NSTTRLTDBMD";
	public $NSTTRGTDBMD = "NSTTRGTDBMD";
	public $NSTTRLODWBD = "NSTTRLODWBD";
	public $NSTTRLTDWBD = "NSTTRLTDWBD";
	public $NSTTRGTDWBD = "NSTTRGTDWBD";
	public $NSTTRLODCBD = "NSTTRLODCBD";
	public $NSTTRLTDCBD = "NSTTRLTDCBD";
	public $NSTTRGTDCBD = "NSTTRGTDCBD";
	public $NSTTRLODOS  = "NSTTRLODOS";
	public $NSTTRLTDOS  = "NSTTRLTDOS";
	public $NSTTRGTDOS  = "NSTTRGTDOS";
	public $NSTTRLODTOT = "NSTTRLODTOT";
	public $NSTTRLTDTOT = "NSTTRLTDTOT";
	public $NSTTRGTDTOT = "NSTTRGTDTOT";
	public $SDBFNINS    = "SDBFNINS";
	public $SDADNINS    = "SDADNINS";
	public $SDTOTNINS   = "SDTOTNINS";
	public $SDCMPNINS   = "SDCMPNINS";
	public $SDBFWPMS    = "SDBFWPMS";
	public $SDADWPMS    = "SDADWPMS";
	public $SDTOTWPMS   = "SDTOTWPMS";
	public $SDCMPWPMS   = "SDCMPWPMS";
	public $SDBFCPMS    = "SDBFCPMS";
	public $SDADCPMS    = "SDADCPMS";
	public $SDTOTCPMS   = "SDTOTCPMS";
	public $SDCMPCPMS   = "SDCMPCPMS";
	public $SDBFBPMS    = "SDBFBPMS";
	public $SDADBPMS    = "SDADBPMS";
	public $SDTOTBPMS   = "SDTOTBPMS";
	public $SDCMPBPMS   = "SDCMPBPMS";
	public $SDBFDRN     = "SDBFDRN";
	public $SDADDRN     = "SDADDRN";
	public $SDTOTDRN    = "SDTOTDRN";
	public $SDCMPDRN    = "SDCMPDRN";
	public $TTSSSBST    = "TTSSSBST";
	public $TTSTSBST    = "TTSTSBST";
	public $TTSSSVTB    = "TTSSSVTB";
	public $TTSTSVTB    = "TTSTSVTB";
	public $TTSSSOJT    = "TTSSSOJT";
	public $TTSTSOJT    = "TTSTSOJT";
	public $TTSSSBTT    = "TTSSSBTT";
	public $TTSTSBTT    = "TTSTSBTT";
	public $TTSSSTDR    = "TTSSSTDR";
	public $TTSTSTDR    = "TTSTSTDR";
	public $CCRTGSNOS1  = "CCRTGSNOS1";
	public $CCRTGSCC1   = "CCRTGSCC1";
	public $CCRTGSNOS2  = "CCRTGSNOS2";
	public $CCRTGSCC2   = "CCRTGSCC2";
	public $CCRTGSNOS3  = "CCRTGSNOS3";
	public $CCRTGSCC3   = "CCRTGSCC3";
	public $CCRTGSNOS4  = "CCRTGSNOS4";
	public $CCRTGSCC4   = "CCRTGSCC4";
	public $CCTTRGTNOS1 = "CCTTRGTNOS1";
	public $CCTTRGTCC1  = "CCTTRGTCC1";
	public $CCTTRGTNOS2 = "CCTTRGTNOS2";
	public $CCTTRGTCC2  = "CCTTRGTCC2";
	public $CCTTRGTNOS3 = "CCTTRGTNOS3";
	public $CCTTRGTCC3  = "CCTTRGTCC3";
	public $CCTTRGTNOS4 = "CCTTRGTNOS4";
	public $CCTTRGTCC4  = "CCTTRGTCC4";
	public $ASTNOSNIN   = "ASTNOSNIN";
	public $ASTVALNIN   = "ASTVALNIN";
	public $ASTNOSUWR   = "ASTNOSUWR";
	public $ASTVALUWR   = "ASTVALUWR";
	public $ASTNOSUCR   = "ASTNOSUCR";
	public $ASTVALUCR   = "ASTVALUCR";
	public $ASTNOSUBM   = "ASTNOSUBM";
	public $ASTVALUBM   = "ASTVALUBM";
	public $ASTNOSTAV   = "ASTNOSTAV";
	public $ASTVALTAV   = "ASTVALTAV";
	public $ASTNOSERD   = "ASTNOSERD";
	public $ASTVALERD   = "ASTVALERD";
	public $MP11		= "MP11";
	public $MP21    	= "MP21";
	public $MP12   	 	= "MP12";
	public $MP22   	 	= "MP22";
	public $MP13    	= "MP13";
	public $MP23    	= "MP23";
	public $MP14    	= "MP14";
	public $MP24    	= "MP24";
	public $MP15    	= "MP15";
	public $MP25    	= "MP25";
	public $MP16    	= "MP16";
	public $MP26   		= "MP26";
}

/* End of file Mprs.php */
/* Location: ./application/models/Mprs.php */