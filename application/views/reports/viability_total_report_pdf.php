<?php
//print_r($vrs);
//die();
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('VIABILITY REPORT');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'VIABILITY REPORT', array(0,64,55), array(0,64,128));
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
        <th style="width:3%;border: 1px solid black;">SN</th>
        <th style="width:20%;border: 1px solid black;">Eq. ID</th>
        <th style="width:12%;border: 1px solid black;">Eq. Name</th>
        <th style="width:10%;border: 1px solid black;">Serial No</th>
        <th style="width:5%;border: 1px solid black;">Dept</th>
        <th style="width:10%;border: 1px solid black;">Cost of Consumables</th>
        <th style="width:10%;border: 1px solid black;">Disposable Cost</th>
        <th style="width:10%;border: 1px solid black;">No.of Cases Per Day</th>
        <th style="width:10%;border: 1px solid black;">Code Operation</th>
        <th style="width:10%;border: 1px solid black;">Advantages</th>
    </tr>
    </thead>
    <tbody>';
    $i=1;
    foreach($vrs as $vr)
    {
        $html.='<tr>
        <td style="border:1px solid black;width:3%;">'.$i.'</td>
        <td style="border:1px solid black;width:20%;">'.$vr["E_ID"].'</td>
        <td style="border:1px solid black;width:12%;">'.$vr["ename"].'</td>
        <td style="border:1px solid black;width:10%;">'.$vr["esnumber"].'</td>
        <td style="border:1px solid black;width:5%;">'.$vr["DEPT_ID"].'</td>
        <td style="border:1px solid black;width:10%;">'.$vr["COST_OF_CONSUMABLES"].'</td>
        <td style="border:1px solid black;width:10%;">'.$vr["DISPOSABLE_COST"].'</td>
        <td style="border:1px solid black;width:10%;">'.$vr["NO_CASES_DONE_DAILY"].'</td>
        <td style="border:1px solid black;width:10%;">'.$vr["CHRGS_PER_OPE"].'</td>
        <td style="border:1px solid black;width:10%;">'.$vr["ADVANTAGES"].'</td>
        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>