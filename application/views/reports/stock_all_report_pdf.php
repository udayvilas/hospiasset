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
        <th style="width:10%;border: 1px solid black;">Indent Id</th>
        <th style="width:15%;border: 1px solid black;">Branch</th>
        <th style="width:15%;border: 1px solid black;">Name</th>
        <th style="width:12%;border: 1px solid black;">Make</th>
        <th style="width:11%;border: 1px solid black;">Model</th>
        <th style="width:12%;border: 1px solid black;">Serial No</th>
        <th style="width:10%;border: 1px solid black;">Cost</th>
        <th style="width:12%;border: 1px solid black;">Category</th>
    </tr>
    </thead>
    <tbody>';
    $i=1;
    foreach($stocks as $stock)
    {
        $html.='<tr>
        <td style="border:1px solid black;width:3%;">'.$i.'</td>
        <td style="border:1px solid black;width:10%;">'.$stock['INDENT_ID'].'</td>
        <td style="border:1px solid black;width:15%;">'.$stock['branch_name'].'</td>
        <td style="border:1px solid black;width:15%;">'.$stock["E_NAME"].'</td>
        <td style="border:1px solid black;width:12%;">'.$stock["make"].'</td>
        <td style="border:1px solid black;width:11%;">'.$stock["E_MODEL"].'</td>
        <td style="border:1px solid black;width:12%;">'.$stock["ES_NUMBER"].'</td>
        <td style="border:1px solid black;width:10%;">'.$stock["E_COST"].'</td>
        <td style="border:1px solid black;width:12%;">'.$stock["eq_cat"].'</td>
        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>