<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('Viability Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '                  '.$this->session->org_name, 'BIOMEDICAL ENGINEERING DEPARTMENT                                                              VIABILITY REPORT', array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(22);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,10);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 10);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->AddPage();
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Date</th>
        <td style="border:1px solid black;width:35%;">'.date('d-m-Y').'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Time</th>
        <td style="border:1px solid black;width:35%;">'.date('h:i A').'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Branch</th>
        <td style="border:1px solid black;width:35%;">'.$vr->branchname.'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Department</th>
        <td style="border:1px solid black;width:35%;">'.$vr->DEPT_ID.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:40%;background-color:#f1f1f1">Eq. ID</th>
        <td style="border:1px solid black;width:60%;">'.$vr->E_ID.'</td>

    </tr>
     <tr>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Eq. Name</th>
        <td style="border:1px solid black;width:35%;">'.$vr->ename.'</td>
        <th style="border:1px solid black;width:15%;background-color:#f1f1f1">Serial No</th>
        <td style="border:1px solid black;width:35%;">'.$vr->esnumber.'</td>
    </tr>
    <tr>
        <th style="border:1px solid black;width:40%;background-color:#f1f1f1">Cost of Consumables</th>
        <td style="border:1px solid black;width:60%;">'.$vr->COST_OF_CONSUMABLES.'</td>

    </tr>
    <tr>
        <th height="50" style="border:1px solid black;width:40%;background-color:#f1f1f1">If Disposal: Cost</th>
        <td height="50" style="border:1px solid black;width:60%;">'.$vr->DISPOSABLE_COST.'</td>
    </tr>
    <tr>
        <th height="50" style="border:1px solid black;width:40%;background-color:#f1f1f1">No.of Cases Per Day</th>
        <td height="50" style="border:1px solid black;width:60%;">'.$vr->NO_CASES_DONE_DAILY.'</td>
    </tr>
    <tr>
        <th height="50" style="border:1px solid black;width:40%;background-color:#f1f1f1">Charges Per Operation/Procedure</th>
        <td height="50" style="border:1px solid black;width:60%;">'.$vr->CHRGS_PER_OPE.'</td>
    </tr>
    <tr>
        <th height="50" style="border:1px solid black;width:40%;background-color:#f1f1f1">Number of Operations Per Year</th>
        <td height="50" style="border:1px solid black;width:60%;">'.$vr->NUM_OPER_PER_YEAR.'</td>
    </tr>
    <tr>
        <th height="50" style="border:1px solid black;width:40%;background-color:#f1f1f1">Revenue Per Year</th>
        <td height="50" style="border:1px solid black;width:60%;">'.$vr->REV_PER_YEAR.'</td>
    </tr>
    <tr>
        <th height="50" style="border:1px solid black;width:40%;background-color:#f1f1f1">Profit Over One Year</th>
        <td height="50" style="border:1px solid black;width:60%;">'.$vr->PROFIT_PER_YEAR.'</td>
    </tr>
    <tr>

        <th height="50" style="border:1px solid black;width:40%;background-color:#f1f1f1">Profit Over Three Year</th>
        <td height="50" style="border:1px solid black;width:60%;">'.$vr->PROFIT_THREE_YEARS.'</td>
    </tr>
    <tr>

        <th height="50" style="border:1px solid black;width:40%;background-color:#f1f1f1">Code of Operation</th>
        <td height="50" style="border:1px solid black;width:60%;">'.$vr->CODE_OPERATION.'</td>
    </tr>
    <tr>
        <th height="50" style="border:1px solid black;width:40%;background-color:#f1f1f1">Justification</th>
        <td height="50" style="border:1px solid black;width:60%;">'.$vr->JUSTIFICATION.'</td>
    </tr>
    <tr>
        <th height="50" style="border:1px solid black;width:40%;background-color:#f1f1f1">Advantages</th>
        <td height="50" style="border:1px solid black;width:60%;">'.$vr->ADVANTAGES.'</td>
    </tr>
    <tr>
        <th height="50" style="border:1px solid black;width:40%;background-color:#f1f1f1">Technical Specifications of the Eq. being Purchased
            </th>
        <td height="50" style="border:1px solid black;width:60%;">'.$vr->TECH_SPECF_EQ_PURC.'</td>
    </tr>
    <tr>
    <td height="45"></td>
    </tr>
    <tr valign="top">
        <td style="width:50%;">User Dept HOD Signature</td>
        <td  style="text-align:right;padding-right:15px;width:50%;">Unit Head Signature</td>
    </tr></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    //watermark
    /*$pdf->setPage(1);

    // Get the page width/height
    $myPageWidth = $pdf->getPageWidth();
    $myPageHeight = $pdf->getPageHeight();

    // Find the middle of the page and adjust.
    $myX = ( $myPageWidth / 2 ) - 75;
    $myY = ( $myPageHeight / 2 ) + 25;

    // Set the transparency of the text to really light
    $pdf->SetAlpha(0.09);

    // Rotate 45 degrees and write the watermarking text
    $pdf->StartTransform();
    $pdf->Rotate(45, $myX, $myY);
    $pdf->SetFont("courier", "", 30);
    $pdf->Text($myX, $myY,"HospiAsset");
    $pdf->StopTransform();

    // Reset the transparency to default
    $pdf->SetAlpha(1);*/
    //watermark end
    $pdf->Output();
?>