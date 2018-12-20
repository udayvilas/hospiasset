<?php
/*print_r($dh);
die();*/
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Equpiment Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                              EQUPIMENT HISTORY REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,10);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 10);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage();
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;"  border="0">
    <tr>
		<th style="border:1px solid black;background-color:#f1f1f1;width:12%" colspan="1">Unit</th>
		<td style="border:1px solid black;width:20%" colspan="2">'.$dh['branchname'].'</td>
		<th style="border:1px solid black;background-color:#f1f1f1;width:14%" colspan="1">Department</th>
		<td style="border:1px solid black;width:14%;" colspan="2">'.$dh['DEPT_ID'].'</td>
		<th style="border:1px solid black;background-color:#f1f1f1;width:20%" colspan="1">Equipment Name</th>
		<td style="border:1px solid black;width:20%" colspan="3">'.$dh['E_NAME'].'</td>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;text-align:center;width:16%;">Equipment Details</th>
		<th style="border:1px solid black;background-color:#f1f1f1;text-align:center;width:60%;">Services</th>
		<th style="border:1px solid black;background-color:#f1f1f1;text-align:center;width:24%;">Accessories/Consumables</th>
	</tr>
	<tr>
		<td style="border:1px solid black;width:14%;background-color:#f1f1f1;" colspan="1"></td>
		<td style="border:1px solid black;width:12%;background-color:#f1f1f1;" colspan="2"></td>
		<td style="border:1px solid black;width:12%;background-color:#f1f1f1;" colspan="1">Date</td>
		<td style="border:1px solid black;width:12%;background-color:#f1f1f1;" colspan="1">Down Time</td>
		<td style="border:1px solid black;width:12%;background-color:#f1f1f1;" colspan="1">Carried by</td>
		<td style="border:1px solid black;width:14%;background-color:#f1f1f1;" colspan="1">Remarks</td>
		<td style="border:1px solid black;width:24%;background-color:#f1f1f1;" colspan="3">1)</td>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Equipment</th>
		<td style="border:1px solid black;" colspan="2">'.$dh['E_NAME'].'</td>
		<td style="border:1px solid black;" colspan="1">'.$dh['DATEOF_INSTALL'].'</td>
		<td style="border:1px solid black;" colspan="1">'.$dh[''].'</td>
		<td style="border:1px solid black;" colspan="1">'.$dh[''].'</td>
		<td style="border:1px solid black;" colspan="1">'.$dh['REMARKS'].'</td>
		<td style="border:1px solid black;" colspan="3">2)'.$dh['ACCSSORIES'].'</td>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Model</th>
		<td style="border:1px solid black;" colspan="2">'.$dh['E_MODEL'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="3">3)</td>
	</tr>
	<tr>
		<td style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Sr.no</td>
		<td style="border:1px solid black;" colspan="2">'.$dh['ES_NUMBER'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="4">3)</td>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Eq ID</th>
		<td style="border:1px solid black;" colspan="2">'.$dh['E_ID'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="4">4)</td>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;width:14%;" colspan="1">Manufacturer</th>
		<td style="border:1px solid black;" colspan="2">'.$dh['MF_DATE'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="4">5)</td>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Dealer</th>
		<td style="border:1px solid black;" colspan="2">'.$dh['DISTRIBUTOR'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		   <th style="border:1px solid black;background-color:#f1f1f1;text-align:center"  colspan="4">Consumables Replacement History</th>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Equp Cost</th>
		<td style="border:1px solid black;" colspan="2">'.$dh['E_COST'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="2"></td>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Installed Dt</th>
		<td style="border:1px solid black;" colspan="2">'.$dh['DATEOF_INSTALL'].' </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="2"></td>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Equp Life</th>
		<td style="border:1px solid black;" colspan="2">'.$dh['END_OF_LIFE'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="2"></td>

	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Life Cycle Cost</th>
		<td style="border:1px solid black;" colspan="2"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="2"></td>

	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">User Dept</th>
		<td style="border:1px solid black;" colspan="2"> '.$dh['department'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="2"></td>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Contract</th>
		<td style="border:1px solid black;" colspan="2"> '.$dh['AMC_TYPE'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="2"></td>

	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">From</th>
		<td style="border:1px solid black;" colspan="2"> '.$dh['C_FROM'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="2"></td>

	</tr>

	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">To</th>
		<td style="border:1px solid black;" colspan="2"> '.$dh['C_TO'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="2"></td>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Contract Cost</th>
		<td style="border:1px solid black;" colspan="2"> '.$dh['AMC_VALUE'].'</td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="2"></td>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Serviced By</th>
		<td style="border:1px solid black;" colspan="2"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		 <th style="border:1px solid black;background-color:#f1f1f1;text-align:center" colspan="4">Spares Replacement</th>
	</tr>
	<tr>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1" rowspan="4">Servicing Company</th>
		<td style="border:1px solid black;" colspan="2" rowspan="4"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1">Date</td>
		<td style="border:1px solid black;" colspan="1">Cost</td>
		<td style="border:1px solid black;" colspan="2">Details</td>
	</tr>
	<tr>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="2"></td>

	</tr>
	<tr>
	   <th style="border:1px solid black;background-color:#f1f1f1;text-align:center" colspan="4">PMS Scheduleds & Adherence History</th>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="1"> </td>
		<td style="border:1px solid black;" colspan="2"></td>

	</tr>
	<tr>
	   <th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">1st year</th>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="2"></td>
	</tr>
	<tr>
	   <th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Phone</th>
		<td style="border:1px solid black;" colspan="2"></td>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">2nd year</th>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="2"></td>
	</tr>
	<tr>
	   <th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Ser Eng</th>
		<td style="border:1px solid black;" colspan="2"></td>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">3rd year</th>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="2"></td>
	</tr>
	<tr>
	   <th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">Mobile</th>
		<td style="border:1px solid black;" colspan="2"></td>
		<th style="border:1px solid black;background-color:#f1f1f1;" colspan="1">4th year</th>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="1"></td>
		<td style="border:1px solid black;" colspan="2"></td>
	</tr></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>