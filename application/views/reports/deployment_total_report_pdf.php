<?php
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Depolyment Report PDf');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'DEPOLYMENT REPORT', array(0,64,55), array(0,64,128));
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
        <th style="border:1px solid black;width:13%;">Indent No</th>
        <th style="border:1px solid black;width:10%;">Eq. Name</th>
        <th style="border:1px solid black;width:16%;">Eq. Id</th>
        <th style="border:1px solid black;width:7%;">OEM(</th>
        <th style="border:1px solid black;width:6%;">Serial No.</th>
        <th style="border:1px solid black;width:6%;">Model</th>
        <th style="border:1px solid black;width:6%;">Accessories</th>
        <th style="border:1px solid black;width:6%;">Consumables</th>
        <th style="border:1px solid black;width:10%;">Remarks</th>
    </tr>
    </thead>
    <tbody>';
    $i=1;
    foreach($deployemnt_reports as $deployement)
    {
        $html.='<tr>
        <td style="border:1px solid black;width:2%;">'.$i.'</td>
        <td style="border:1px solid black;width:12%;">'.$deployement["branchname"].'</td>
        <td style="border:1px solid black;width:4%;">'.$deployement["DEPT_ID"].'</td>
        <td style="border:1px solid black;width:13%;"></td>
        <td style="border:1px solid black;width:10%;">'.$deployement["E_NAME"].'</td>
        <td style="border:1px solid black;width:16%;">'.$deployement["E_ID"].'</td>
        <td style="border:1px solid black;width:7%;">'.$deployement["C_NAME"].'</td>
        <td style="border:1px solid black;width:6%;">'.$deployement["ES_NUMBER"].'</td>
        <td style="border:1px solid black;width:6%;">'.$deployement["E_MODEL"].'</td>
        <td style="border:1px solid black;width:6%;">'.$deployement["ACCSSORIES"].'</td>
        <td style="border:1px solid black;width:6%;">'.$deployement["ACCSSORIES"].'</td>
        <td style="border:1px solid black;width:10%;"></td>
        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>