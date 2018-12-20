<?php
//print_r($tindents);
//die();
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Indent Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'INDENT REPORT', array(0,64,55), array(0,64,128));
$pdf->setFooterData(array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 8);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage('P','A4');
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
    <thead>
    <tr>
        <th style="border:1px solid black;">SN</th>
        <th style="border:1px solid black;">Indent ID</th>
        <th style="border:1px solid black;">Eq. Name</th>
        <th style="border:1px solid black;">Dept</th>
        <th style="border:1px solid black;">Qty</th>
        <th style="border:1px solid black;">Es.Features</th>
        <th style="border:1px solid black;">Ds.Features</th>
        <th style="border:1px solid black;">Lx.Features</th>
        <th style="border:1px solid black;">Std Accessories </th>
        <th style="border:1px solid black;">opt Accessories </th>
        <th style="border:1px solid black;">Contract Vendor </th>
        <th style="border:1px solid black;">Reasons</th>
        <th style="border:1px solid black;">Estimated Cost </th>
        <th style="border:1px solid black;">Appr revenue generation</th>
        <th style="border:1px solid black;">Benefits with Desirous Features</th>
        <th style="border:1px solid black;">Benefits with LuxuriousFeatures</th>
        <th style="border:1px solid black;">Budget approved By</th>
        <th style="border:1px solid black;">Budget reference</th>
        <th style="border:1px solid black;">Bio-Medical Receipt Date</th>
        <th style="border:1px solid black;">Quotes called for : (2 weeks)</th>
        <th style="border:1px solid black;">Evaluation period :(4 weeks)</th>
        <th style="border:1px solid black;">PO Release Date</th>
        <th style="border:1px solid black;">Remarks </th>
    </tr>
    </thead>
    <tbody>';
    $i=1;
    foreach($indent_equps as $indent_equp)
    {		
        $html.='<tr>
        <td style="border:1px solid black;">'.$i.'</td>
        <td style="border:1px solid black;">'.$indent_equp['INDENT_ID'].'</td>
        <td style="border:1px solid black;">'.$indent_equp["EQ_NAME"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["DEPT"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["QTY"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["ESNTL_FEATURES"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["OPTIMAL_FEATURES"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["OPTIONAL_FEATURES"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["STNRD_ACCESSORIES"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["OPTIONAL_ACCESSORIES"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["EQ_CAT"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["EQ_CAT"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["ESTIMATED_COST"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["REVENEW_GENERATION"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["DESIROUS_REVENEW"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["LUXURY_REVENEW"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["BUDGET_APPROVED_BY"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["BUDGET_REFF"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["BUDGET_APPROVED_DATETIME"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["QUOTES"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["EVALUATION_PEROID"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["PO_DATE"].'</td>
        <td style="border:1px solid black;">'.$indent_equp["REMARKS"].'</td>
        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>