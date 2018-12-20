<?php
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Indent Report');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'ADVERSE REPORT', array(0,64,55), array(0,64,128));
$pdf->setFooterData(array(0,64,55), array(0,64,128));
$pdf->SetHeaderMargin(5);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetAuthor('Renown');
$pdf->SetFont('times', 'R', 8);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage('L','A4');
$html='<table cellspacing="0" cellpadding="2" style="width: 100%;" border="0">
    <thead>
    <tr>
        <td style="width:4%;border:1px solid black;">SN</td>
        <th style="width:22%;border: 1px solid black;">Eq. ID</th>
        <th style="width:18%;border: 1px solid black;">Eq. Name</th>
        <th style="width:8%;border: 1px solid black;">DEPT ID</th>
        <th style="width:8%;border: 1px solid black;">Location</th>
        <th style="width:4%;border: 1px solid black;">Type</th>
        <th style="width:8%;border: 1px solid black;">Model</th>
        <th style="width:8%;border: 1px solid black;">Serial No.</th>
        <th style="width:10%;border: 1px solid black;">Incident Type</th>
        <th style="width:10%;border: 1px solid black;">Date & Time</th>
    </tr>
    </thead>
    <tbody>';
    $i=1;
    foreach($adv as $ad)
    {
        $html.='<tr>
        <td style="width:4%;border:1px solid black;">'.$i.'</td>
        <td style="width:22%;border:1px solid black;">'.$ad['EQUP_ID'].'</td>
        <td style="width:18%;border:1px solid black;">'.$ad["eq_name"].'</td>
        <td style="width:8%;border:1px solid black;">'.$ad["DEPT_ID"].'</td>
        <td style="width:8%;border:1px solid black;">'.$ad["location"].'</td>
        <td style="width:4%;border:1px solid black;">'.$ad["type"].'</td>
        <td style="width:8%;border:1px solid black;">'.$ad["model"].'</td>
        <td style="width:8%;border:1px solid black;">'.$ad["serial_no"].'</td>
        <td style="width:10%;border:1px solid black;">'.$ad["incidents_type"].'</td>
        <td style="width:10%;border:1px solid black;">'.$ad["ADDED_ON"].'</td>
        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>