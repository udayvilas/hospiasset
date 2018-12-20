<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Gatepass Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, ucfirst($this->session->org_name), 'GATE PASS REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,10);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 10);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage();
if($gp->EXPECTED_RETURN!=NULL || $gp->EXPECTED_RETURN!="")
    $expected_return = date('Y-m-d',strtotime($gp->EXPECTED_RETURN));
else
    $expected_return = "-";

$html='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
    <tr>
		<td style="border:1px solid black;width:20%">Hospital</td>
		<td style="border:1px solid black;width:30%">'.ucfirst($this->session->org_name).'</td>
		<td style="border:1px solid black;width:20%">Branch</td>
		<td style="border:1px solid black;width:30%">
		'.$this->basemodel->get_single_column_value($this->branches->tbl_name,$this->branches->BRANCH_NAME,array($this->branches->BRANCH_ID=>$gp->BRANCH_ID)).'
		</td>
	</tr>
	<tr>
		<td style="border:1px solid black;width:20%">Date</td>
		<td style="border:1px solid black;width:30%">'.date('d-m-Y').'</td>
		<td style="border:1px solid black;width:20%">Time</td>
		<td style="border:1px solid black;width:30%">'.date('h:i A').'</td>
	</tr>
	<tr>
		<td style="border:1px solid black;width:20%">Dept</td>
		<td style="border:1px solid black;width:30%">'.$gp->DEPT_ID.'</td>
		<td style="border:1px solid black;width:20%">GP No</td>
		<td style="border:1px solid black;width:30%">'.$gp->GP_ID.'</td>
	</tr>';
    if($gp->E_ID!=NULL || $gp->E_ID!="")
    {
       $html.= '<tr>
		<td style="border:1px solid black;width:20%">Eq. ID</td>
		<td style="border:1px solid black;width:30%">'.$gp->E_ID.'</td>
		<td style="border:1px solid black;width:20%">Serial No.</td>
		<td style="border:1px solid black;width:30%">'.$this->basemodel->get_single_column_value($this->devices->tbl_name,$this->devices->ES_NUMBER,array($this->devices->E_ID=>$gp->E_ID)).'</td></tr>';
    }
	$html.='<tr>
		<td style="border:1px solid black;width:20%">Returnable Type</td>
		<td style="border:1px solid black;width:30%">'.$gp->RETURN_TYPE.'</td>
		<td style="border:1px solid black;width:20%">Return Due Dt</td>
		<td style="border:1px solid black;width:30%">'.$expected_return.'</td>
	</tr>
    <tr>
    <td height="10"></td>
    </tr>
	<tr >
        <th style="width:15%;">Name of the Party</th>
        <th style="width:85%;border-bottom:1px solid black;">'.$gp->TO_WHOME.'</th>
    </tr>
	<tr>
    <td height="20"></td>
    </tr>
	<tr>
		<td style="border-left:1px solid black;border-right:1px solid black;border-top:1px solid black;width:10%;background-color:#f1f1f1">S. No.</td>
		<td style="border-left:1px solid black;border-right:1px solid black;border-top:1px solid black;width:70%;background-color:#f1f1f1">Material Description</td>
		<td style="border-left:1px solid black;border-right:1px solid black;border-top:1px solid black;width:20%;background-color:#f1f1f1">Quantity</td>
	</tr>
	<tr>
		<td style="border:1px solid black;width:10%;">1</td>
		<td style="border:1px solid black;width:70%;"><b>Critical Spares</b>:<br>';
		foreach($gp->SPARES as $cspares)
        {
            $html.=' &nbsp;&nbsp;'.$cspares.'<br>';
        }
		$html.='</td>
		<td style="border:1px solid black;width:20%;">'.$gp->SPARES_CNT.'</td>
	</tr>';
    $html.='<tr>
		<td style="border:1px solid black;width:10%;">2</td>
		<td style="border:1px solid black;width:70%;"><b>Accessories</b>:<br>';
        foreach($gp->ACCESSORIES as $accesses)
        {
            $html.=' &nbsp;&nbsp;'.$accesses.'<br>';
        }
		$html.='</td>
		<td style="border:1px solid black;width:20%;">'.$gp->ACCESSORIES_CNT.'</td>
	</tr>
	<tr>
    <td height="45"></td>
    </tr>
	<tr valign="top">
	    <td style="width:5%;"></td>
		<td style="width:30%;">Security Supervisor</td>
		<td style="width:30%;text-align:center;">Receiver</td>
		<td style="width:30%;text-align:right;">Authorised Signatory</td>
		<td style="width:5%;"></td>
	</tr></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>