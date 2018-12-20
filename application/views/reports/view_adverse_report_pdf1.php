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
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Date</th>
        <td style="border:1px solid black;width:35%;">'.date('d-m-Y').'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Location</th>
        <td   colspan="2" style="border:1px solid black;width:35%;">Hyderabad</td>
    </tr>
   <tr>
         <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Department</th>
        <td  colspan="2" style="border:1px solid black;width:35%;">'.$advr->DEPT_ID.'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Time</th>
        <td style="border:1px solid black;width:35%;">'.date('h:i A').'</td>

    </tr>
     <tr>
     <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Hod Name</th>
        <td  colspan="1" style="border:1px solid black;width:35%;"></td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Operator Name</th>
        <td   colspan="1" style="border:1px solid black;width:35%;">'.$advr->OPERATOR_NAME.'</td>
    </tr>
    <tr>
        <th  style="border:1px solid black;width:10%;background-color:#f1f1f1"> Equipment</th>
        <td  style="border:1px solid black;width:25%;">'.$advr->eq_name.'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Approximate Cost</th>
        <td style="border:1px solid black;width:10%;">'.$advr->APPROXIMATE_COST.'</td>
        <th  style="border:1px solid black;width:25%;background-color:#f1f1f1;">Exp. Restoration time (days)</th>
        <td style="border:1px solid black;width:15%;">'.$advr->RESTORATION_TIME.'</td>

    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1;">Part damaged</th>
        <td  colspan="1" style="border:1px solid black;width:25%;">'.$advr->SPARES.','.$advr->ACCESSORIES.'</td>
        <th style="border:1px solid black;width:35%;background-color:#f1f1f1;">Approx. cost for repairs / replacement</th>
         <td  colspan="1" style="border:1px solid black;width:25%;">'.$advr->APPROXIMATE_COST.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">Nature of the Report: Cautionary</th>
        <td style="border:1px solid black;width:70%;">'.$advr->NATURE_REPORT.'</td>
    </tr>
    <tr  valign="top">
        <th style="border:1px solid black;width:25%;;background-color:#f1f1f1;">Damage noticed / informed by</th>
        <td style="border:1px solid black;width:35%;">'.$advr->ADDED_BY_NAME.'</td>
        <th style="border:1px solid black;width:10%;background-color:#f1f1f1">Date</th>
        <td style="border:1px solid black;width:10%;">'.date('d-m-Y').'</td>
          <th style="border:1px solid black;width:10%;background-color:#f1f1f1">Time</th>
        <td style="border:1px solid black;width:10%;">'.date('h:i A').'</td>

    </tr>
    <tr  valign="top">
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">Biomedical Engineers’ Observations:</th>
        <td  colspan="5" style="border:1px solid black;width:70%;"> '.$advr->OBSERVATIONS.'</td>

    </tr>
     <tr  valign="top">
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">Apparent causes that led to damage</th>
        <td colspan="5" colspan="5" style="border:1px solid black;width:70%;"> '.$advr->SPARES.','.$advr->ACCESSORIES.'</td>

    </tr>
    <tr valign="top">
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">Occurrence Report</th>
        <td colspan="5" style="border:1px solid black;width:70%;">'.$advr->OCCRANCE_REPORT.'</td>

    </tr>
    <tr valign="top">
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">HOD’s observation:</th>
        <td  colspan="5" style="border:1px solid black;width:70%;">'.$advr->OPERATOR_OBSER.'</td>

    </tr>
     <tr valign="top">
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">Chief Engineer’s observations</th>
        <td colspan="5" style="border:1px solid black;width:70%;">'.$advr->CHIEF_ENG_OBSERV.'</td>

    </tr>
     <tr valign="top">
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">Conclusions</th>
        <td colspan="5" style="border:1px solid black;width:70%;">'.$advr->CONCLUSION.'</td>
    </tr>
    <tr valign="top">
        <th style="border:1px solid black;width:30%;background-color:#f1f1f1;">Cause probability</th>
        <td colspan="5" style="border:1px solid black;width:70%;">'.$advr->CAUSE_PROBABILITY.'</td>
    </tr>

     <tr valign="top">
        <th  style="border:1px solid black;width:20%;background-color:#f1f1f1;">Action Taken</th>
        <td colsapn="5" style="border:1px solid black;width:80%;" align="left">'.$advr->ACTION_TACKEN.'</td>
    </tr>
    <tr>
    <td height="40"> </td>
    </tr>
            <tr>
                <td colspan="2" style="text-align:left;width:33%">Report Prepared By</td>
                <td colspan="2" style="text-align:center;width:33%">Report Verified By</td>
                <td  colspan="2" style="text-align:right;width:34%">Signature of the HA /MA</td>
            </tr>

    </table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output();
?>