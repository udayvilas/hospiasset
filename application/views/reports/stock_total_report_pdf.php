<?php
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('STOCK REPORT');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'STOCK REPORT', array(0,64,55), array(0,64,128));
$pdf->setFooterData(array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 10);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage('L','A4');
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
    <thead>
    <tr>
        <th style="width:3%;border: 1px solid black;">SN</th>
        <th style="width:19%;border: 1px solid black;">Branch</th>
        <th style="width:10%;border: 1px solid black;">Eq. Count</th>
        <th style="width:17%;border: 1px solid black;">Eq. Cost</th>
        <th style="width:10%;border: 1px solid black;">Spr. Count</th>
        <th style="width:17%;border: 1px solid black;">Spr. Cost</th>
        <th style="width:10%;border: 1px solid black;">Acc. Count</th>
        <th style="width:14%;border: 1px solid black;">Acc. Cost</th>
    </tr>
    </thead>
    <tbody>';
    $i=1;
    foreach($stocks as $stock)
    {
        $html.='<tr>
        <td style="border:1px solid black;width:3%;">'.$i.'</td>
        <td style="border:1px solid black;width:19%;">'.$stock[$this->branches->BRANCH_NAME].'</td>
        <td style="border:1px solid black;width:10%;">'.$stock["e_count"].'</td>
        <td style="border:1px solid black;width:17%;">'.$stock["e_cost"].'</td>
        <td style="border:1px solid black;width:10%;">'.$stock["spr_count"].'</td>
        <td style="border:1px solid black;width:17%;">'.$stock["spr_cost"].'</td>
        <td style="border:1px solid black;width:10%;">'.$stock["acc_count"].'</td>
        <td style="border:1px solid black;width:14%;">'.$stock["acc_cost"].'</td>

        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>