<?php

ob_start();

?>

<html

    xmlns:o='urn:schemas-microsoft-com:office:office'

    xmlns:w='urn:schemas-microsoft-com:office:word'

    xmlns='https://www.w3.org/TR/html401/'>

    <head>

        <title>Generate a document Word</title>

        <!--[if gte mso 9]-->

    <xml>

        <w:WordDocument>

            <w:View>Print</w:View>

            <w:Zoom>100</w:Zoom>

            <w:DoNotOptimizeForBrowser/>

        </w:WordDocument>

        <w:fonts>

	<w:defaultFonts w:ascii="Times New Roman" w:fareast="Times New Roman" w:h-ansi="Times New Roman" w:cs="Times New Roman"/>

	<w:sz w:val="20"/>

    </xml>

    <!-- [endif]-->

    <style>

        p.MsoFooter, li.MsoFooter, div.MsoFooter{

  

           mso-pagination:widow-orphan;

           mso-page-orientation:PORTRAIT;

        }



        @page Section1

        {



            size: 74mm 35mm;

            margin: 0.1cm 0cm 0cm 0.1cm; 

        }

        div.Section1 { page:Section1;}

    </style>

</head>

<body>

<?php

foreach($pdevices as $pdevice)

{

	$pms_where[$this->pmsdetails->EID] = $pdevice[$this->devices->E_ID];

	$pms_where[$this->pmsdetails->ORG_ID] = $pdevice[$this->devices->ORG_ID];

	$pms_where[$this->pmsdetails->BRANCH_ID] = $pdevice[$this->devices->BRANCH_ID];

	$pms_select = array($this->pmsdetails->PMS_DONE, $this->pmsdetails->PMS_DUE_DATE);

	$pms_data = $this->basemodel->fetch_single_row($this->pmsdetails->tbl_name, $pms_where, $pms_select,$this->pmsdetails->ID,'DESC');



	//device qc details

	$qc_where[$this->qcdetails->EID] = $pdevice[$this->devices->E_ID];

	$qc_where[$this->qcdetails->ORG_ID] = $pdevice[$this->devices->ORG_ID];

	$qc_where[$this->qcdetails->BRANCH_ID] = $pdevice[$this->devices->BRANCH_ID];

	$qc_select = array($this->qcdetails->QC_DONE, $this->qcdetails->QC_DUE);

	$cal_data = $this->basemodel->fetch_single_row($this->qcdetails->tbl_name, $qc_where, $qc_select,$this->qcdetails->ID,'DESC');



	$dept_name = $this->basemodel->get_single_column_value($this->userdeprts->tbl_name, $this->userdeprts->USER_DEPT_NAME, array($this->userdeprts->CODE => $pdevice[$this->devices->DEPT_ID]));

	if($dept_name=="-" OR $dept_name=="")

	{

		$dept_name=$pdevice[$this->devices->DEPT_ID];

	}

?>

<div class="Section1" style="margin-left:0px;">

<br clear=all style='mso-special-character:line-break;page-break-after:always' />

	<table border="1" style="border-collapse:collapse;border:1px groove black;" width="99.8%">

	<tr>

	<td colspan="3" align="center" style="font-weight:bold;font-size:10.0pt;font-family:Arial;">ID : <?= $pdevice[$this->devices->E_ID]; ?>

	</td>

	</tr>

	<tr>

		<td align="left" style="font-weight:bold;font-size:10.0pt;font-family:Arial;">Dept</td>

		<td align="left" colspan="2" style="font-weight:bold;font-size:10.0pt;font-family:Arial;"><?= $pdevice[$this->devices->DEPT_ID]; ?></td>

	</tr>

	<tr>

		<td align="left" style="font-weight:bold;font-size:10.0pt;font-family:Arial;">Type</td>

	    <td align="left" style="font-weight:bold;font-size:10.0pt;font-family:Arial;">Done Date</td>

		<td align="left" style="font-weight:bold;font-size:10.0pt;font-family:Arial;">Due Date</td>

	</tr>

	<tr>

		<td align="left" style="font-weight:bold;font-size:10.0pt;font-family:Arial;">PMS</td>

		<td align="left" style="font-weight:bold;font-size:10.0pt;font-family:Arial;">

			<?= date('d-m-Y',strtotime($pms_data[$this->pmsdetails->PMS_DONE])) ?>

		</td>

		<td align="left" style="font-weight:bold;font-size:10.0pt;font-family:Arial;">

			<?= date('d-m-Y',strtotime($pms_data[$this->pmsdetails->PMS_DUE_DATE])) ?>

		</td>

	</tr>

	<tr>

		<td align="left" style="font-weight:bold;font-size:10.0pt;font-family:Arial;">CAL</td>

		<td align="left" style="font-weight:bold;font-size:10.0pt;font-family:Arial;">

			<?= date('d-m-Y',strtotime($cal_data[$this->qcdetails->QC_DONE])) ?>

		</td>

		<td align="left" style="font-weight:bold;font-size:10.0pt;font-family:Arial;">

			<?= date('d-m-Y',strtotime($cal_data[$this->qcdetails->QC_DUE])) ?>

		</td>

	</tr>

	</table>

</div>

<?php

}

$download_date = date('d-m-Y h_i_s_A');

header("Content-type: application/vnd.ms-word");

header('Content-Disposition: attachment;Filename="Equipments-PMS-Calibration-Labels-('.$download_date.').doc"');

exit();

?>