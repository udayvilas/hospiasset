<?php
//print_r($services);
//die();
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Service Report PDf');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'SERVICES REPORT', array(0,64,55), array(0,64,128));
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
        <th style="border:1px solid black;width:2%;">SN</th>
        <th style="border:1px solid black;width:12%;">Btanch</th>
        <th style="border:1px solid black;width:4%;">Dept</th>
        <th style="border:1px solid black;width:16%;">Eq. ID</th>
        <th style="border:1px solid black;width:10%;">Eq. Name</th>
        <th style="border:1px solid black;width:6%;">Model</th>
        <th style="border:1px solid black;width:6%;">Serial No.</th>
        <th style="border:1px solid black;width:8%;">Eq. Location</th>
        <th style="border:1px solid black;width:8%;">Call Date </th>
        <th style="border:1px solid black;width:8%;">Job Date </th>
        <th style="border:1px solid black;width:6%;">Fault Reported</th>
        <th style="border:1px solid black;width:8%;">Remarks</th>

    </tr>
    </thead>
    <tbody>';
    $i=1;
    foreach($services as $service)
    {
        $html.='<tr>
        <td style="border:1px solid black;width:2%;">'.$i.'</td>
        <td style="border:1px solid black;width:12%;">'.$service['branchname'].'</td>
        <td style="border:1px solid black;width:4%;">'.$service['DEPT_ID'].'</td>
        <td style="border:1px solid black;width:16%;">'.$service['E_ID'].'</td>
        <td style="border:1px solid black;width:10%;">'.$service["E_NAME"].'</td>
        <td style="border:1px solid black;width:6%;">'.$service["E_MODEL"].'</td>
        <td style="border:1px solid black;width:6%;">'.$service["ES_NUMBER"].'</td>
        <td style="border:1px solid black;width:8%;">'.$service["PHY_LOCATION"].'</td>
        <td style="border:1px solid black;width:8%;">'.$service["cdate"] .'</td>
        <td style="border:1px solid black;width:8%;">'.$service["JOBCOMPLETED_DATE"].'</td>
        <td style="border:1px solid black;width:6%;"></td>
        <td style="border:1px solid black;width:8%;"></td>
        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>