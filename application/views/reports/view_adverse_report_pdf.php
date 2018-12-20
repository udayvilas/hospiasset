<?php
//print_r($advr);
//die();
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Adverse Report');
//$pdf->setPrintHeader(false));
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                     '.$this->session->org_name, ' BIOMEDICAL ENGINEERING DEPARTMENT                                                        ADVERSE REPORT', array(0,64,55), array(0,64,128));
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setFooterData(array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,10);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 9);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage();
$html='<table cellspacing="0" cellpadding="3" style="width:100%;" border="0">
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Branch</th>
        <th style="border:1px solid black;width:35%;">'.$advr->Branch_name.' </th>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Department</th>
        <th style="border:1px solid black;width:35%;">'.$advr->DEPT_ID.' </th>
    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Date</th>
        <th style="border:1px solid black;width:35%;">'.date('d-m-Y').'</th>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Time</th>
        <th style="border:1px solid black;width:35%;">'.date('h:i A').'</th>
    </tr>
    <tr>
        <th style="border:1px solid black;width:35%;background-color:#f1f1f1">Date of Occurrence:</th>
        <th colspan="2" style="border:1px solid black;width:15%;">'.date('d-m-Y',strtotime($advr->DATE_OCCRANCE)).'</th>
        <th style="border:1px solid black;width:35%;background-color:#f1f1f1">Time of Occurrence:</th>
        <td colspan="2" style="border:1px solid black;width:15%;">'.date('h:i A',strtotime($advr->TIME_OCCARANCE)).'</td>
    </tr>
    <tr>
        <th span="2" style="border:1px solid black;width:50%;background-color:#f1f1f1">Name of Equipment/Spares</th>
        <td colspan="2" style="border:1px solid black;width:50%;">'.$advr->eq_name.'</td>
    </tr>
    <tr style="border:1px solid black;height:40 !important">
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Model</th>
        <td style="border:1px solid black;width:25%;">'.$advr->model.'</td>
        <th style="border:1px solid black;width:25%;;background-color:#f1f1f1">Responded by</th>
        <td style="border:1px solid black;width:25%;">'.$advr->assigned_by.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Serial No </th>
        <td style="border:1px solid black;width:25%;">'.$advr->serial_no.'</td>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Completed by</th>
        <td style="border:1px solid black;width:25%;">'.$advr->completed_by.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:10%;;background-color:#f1f1f1"> Eq. ID</th>
        <td style="border:1px solid black;width:40%;">'.$advr->EQUP_ID.'</td>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Incident Type</th>
        <td style="border:1px solid black;width:25%;">'.$advr->incidents_type.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:20%;background-color:#f1f1f1;">Contract Type</th>
        <td style="border:1px solid black;width:15%;">'.$advr->type.'</td>
        <th style="border:1px solid black;width:20%;background-color:#f1f1f1;">Staff Involved</th>
        <td style="border:1px solid black;width:45%;">'.$advr->assigned_by.', '.$advr->completed_by.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">Incident Happened/Problem Occurred</th>
        <td style="border:1px solid black;width:70%;">'.$advr->FEEDBACK.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">Incident Reported by</th>
        <td style="border:1px solid black;width:70%;"> '.$advr->completed_by.'</td>
    </tr>
    <tr  valign="top">
        <th style="border:1px solid black;width:30%;;background-color:#f1f1f1;">User dept HOD/Incharge Comment</th>
        <td style="border:1px solid black;width:70%;">'.$advr->INCHARGE_COMMENT.'</td>

    </tr>
    <tr  valign="top">
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">Observation(by Biomedical)</th>
        <td style="border:1px solid black;width:70%;"> '.$advr->OBSERVATIONS.'</td>

    </tr>
    <tr valign="top">
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">Occurrence Report</th>
        <td style="border:1px solid black;width:70%;">'.$advr->OCCRANCE_REPORT.'</td>

    </tr>
    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;" colspan="1">Parts / Accessories Damaged</th>
        <td style="border:1px solid black;width:70%;" colspan="3">'.$advr->SPARES.','.$advr->ACCESSORIES.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1;">Total Cost</th>
        <td style="border:1px solid black;width:25%;">'.$advr->TOTAL_COST.'</td>
        <th style="border:1px solid black;width:25%;background-color:#f1f1f1">Approximate Cost</th>
        <td style="border:1px solid black;width:25%;">'.$advr->APPROXIMATE_COST.'</td>
    </tr>
    <tr rowspan="4" valign="top" >
        <th style="border:1px solid black;width:20%;background-color:#f1f1f1;" colspan="1" align="left">Action Taken</th>
        <td style="border:1px solid black;width:80%;" colspan="3" align="left">'.$advr->ACTION_TACKEN.'</td>
    </tr>
    <tr valign="top" height="60">
            <td style="width:33.3%;colspan="3 height="60"></td>
        </tr>
        <tr valign="bottom" height="60" bo>
            <td style="width:33.3%;padding-left:50px;text-align:center" height="60">Hod Signature</td>
            <td style="width:33.3%;padding-left:50px;text-align:center;" height="60">BME / Service Person</td>
            <td style="width:33.4%;padding-left:50px;text-align:center" height="60">User Signature</td>
        </tr>
</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output();
?>