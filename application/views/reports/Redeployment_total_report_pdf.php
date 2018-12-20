<?php
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('ReDeployment Report PDf');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'REDEPLOYEMENT REPORT', array(0,64,55), array(0,64,128));
$pdf->setFooterData(array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 9);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage('L','A4');
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
    <thead>
    <tr>
        <th style="border:1px solid black;width:2%;">SN</th>
        <th style="border:1px solid black;width:12%;">Branch </th>
        <th style="border:1px solid black;width:4%;">Dept</th>
        <th style="border:1px solid black;width:12%;">Eq. Name</th>
        <th style="border:1px solid black;width:16%;">Eq. Id</th>
        <th style="border:1px solid black;width:16%;">QTY</th>
        <th style="border:1px solid black;width:10%;">From(Location)</th>
        <th style="border:1px solid black;width:10%;">Contract Person</th>
        <th style="border:1px solid black;width:10%;">To(Location)</th>
       <th style="border:1px solid black;width:10%;">Contract Person</th>
    </tr>
    </thead>
    <tbody>';
    $i=1;
    foreach($redeployements as $redeployement)
    {
        $html.='<tr>
        <td style="border:1px solid black;width:2%;">'.$i.'</td>
        <td style="border:1px solid black;width:12%;">'.$redeployement["branchname"].'</td>
        <td style="border:1px solid black;width:4%;">'.$redeployement["DEPT_ID"].'</td>
        <td style="border:1px solid black;width:12%;">'.$redeployement["E_NAME"].'</td>
        <td style="border:1px solid black;width:16%;">'.$redeployement["E_ID"].'</td>
        <td style="border:1px solid black;width:16%;"></td>
        <td style="border:1px solid black;width:10%;"></td>
        <td style="border:1px solid black;width:10%;"></td>
        <td style="border:1px solid black;width:10%;"></td>
        <td style="border:1px solid black;width:10%;"></td>
        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>