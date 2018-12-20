<?php
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Condemination Report PDf');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'CONDEMINATION REPORT', array(0,64,55), array(0,64,128));
$pdf->setFooterData(array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 7);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage('L','A4');
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
    <thead>
    <tr>
        <th style="border:1px solid black;width:2%;">SN</th>
        <th style="border:1px solid black;width:10%;">Branch </th>
        <th style="border:1px solid black;width:4%;">Dept</th>
        <th style="border:1px solid black;width:13%;">From</th>
        <th style="border:1px solid black;width:13%;">To</th>
        <th style="border:1px solid black;width:15%;">Eq. ID</th>
        <th style="border:1px solid black;width:10%;">Eq. Name</th>
        <th style="border:1px solid black;width:7%;">OEM(</th>
        <th style="border:1px solid black;width:6%;">Serial No.</th>
        <th style="border:1px solid black;width:6%;">Model</th>
        <th style="border:1px solid black;width:6%;">Eq.Value</th>
        <th style="border:1px solid black;width:8%;">Yr.of.Purchase</th>
    </tr>
    </thead>
    <tbody>';
    $i=1;
    foreach($condemination_reports as $cond)
    {
        $html.='<tr>
        <td style="border:1px solid black;width:2%;">'.$i.'</td>
        <td style="border:1px solid black;width:10%;">'.$cond["branch_name"].'</td>
        <td style="border:1px solid black;width:4%;">'.$cond["DEPT_ID"].'</td>
        <td style="border:1px solid black;width:13%;">HOSPITAL ADMINISTRATION</td>
        <td style="border:1px solid black;width:13%;">BIOMEDICAL ENGINEERING</td>
        <td style="border:1px solid black;width:15%;">'.$cond["EQUP_ID"].'</td>
        <td style="border:1px solid black;width:10%;">'.$cond["equp_name"].'</td>
        <td style="border:1px solid black;width:7%;">'.$cond["comany_name"].'</td>
        <td style="border:1px solid black;width:6%;">'.$cond["es_number"].'</td>
        <td style="border:1px solid black;width:6%;">'.$cond["model"].'</td>
        <td style="border:1px solid black;width:6%;">'.$cond["equp_val"].'</td>
        <td style="border:1px solid black;width:8%;">'.$cond["year_of_purchage"].'</td>
        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>