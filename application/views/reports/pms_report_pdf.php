<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('PMS Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                              PMS REPORT', array(0,64,55), array(0,64,128));
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
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Date</th>
        <td style="border:1px solid black;width:35%;">'.date('d-m-Y').'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Time</th>
        <td style="border:1px solid black;width:35%">'.date('h:i A').'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Branch</th>
        <td style="border:1px solid black;width:35%;">'.$pms->branch_name.'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Department</th>
        <td style="border:1px solid black;width:35%;">'.$pms->dept_id.'</td>
    </tr>
    <tr>

        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Eq. ID</th>
        <td style="border:1px solid black;width:70%;">'.$pms->EID.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Eq. Name</th>
        <td style="border:1px solid black;width:70%;">'.$pms->equp_name.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Model</th>
        <td style="border:1px solid black;width:70%;">'.$pms->model.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1">Serial No.</th>
        <td style="border:1px solid black;width:70%;">'.$pms->es_number.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:100%;background-color:#f1f1f1;text-align:center;">Preventive Maintenance:</th>
    </tr>
    <tr>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">PMS Done Date</th>
        <td style="border:1px solid black;width:25%;">'.$pms->PMS_DONE.'</td>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">PMS Due Date</th>
        <td style="border:1px solid black;width:25%;">'.$pms->PMS_DUE_DATE.' </td>
    </tr>
    <tr height="70" valign="top">
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Engineers Observation</th>
        <td style="border:1px solid black;width:75%;">'.$pms->ASSIGN_REMARKS.'</td>
    </tr>
    <tr height="70" valign="top">
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Remarks</th>
        <td style="border:1px solid black;width:75%;">'.$pms->COMPLETED_REMARKS.'</td>
    </tr>
    <tr>
    <td height="45"></td>
    </tr>
    <tr valign="bottom">
        <td style="width:50%;">User Dept. BME Signature</td>
        <td style="width:50%;text-align:right;padding-right:15px">Unit Head Signature</td>
    </tr></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>