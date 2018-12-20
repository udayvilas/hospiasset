<?php
//print_r($tcears);
//die();
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('Cear Report PDf');
//$pdf->setPrintHeader(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $this->session->org_name, 'CEAR REPORT', array(0,64,55), array(0,64,128));
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
        <th style="border:1px solid black;width:5%;">Branch</th>
        <th style="border:1px solid black;width:3%;">Dept</th>
          <th style="border:1px solid black;width:5%;">CR No</th>
        <th style="border:1px solid black;width:5%;">PJ No.</th>
        <th style="border:1px solid black;width:6%;">Req Unit</th>
        <th style="border:1px solid black;width:6%;">Req DEPT</th>
        <th style="border:1px solid black;width:6%;">Scope of pj</th>
        <th style="border:1px solid black;width:6%;">Purpose</th>
        <th style="border:1px solid black;width:6%;">Alternatives Considered </th>
        <th style="border:1px solid black;width:6%;">Not Approving Expenditure </th>
        <th style="border:1px solid black;width:6%;">Budget /Experts </th>
        <th style="border:1px solid black;width:6%;">Equipment Purchage  </th>
        <th style="border:1px solid black;width:6%;">Start Date   </th>
        <th style="border:1px solid black;width:6%;">Start Timee   </th>
        <th style="border:1px solid black;width:5%;">   Finacial Attached</th>
        <th style="border:1px solid black;width:5%;">   Conclusion</th>
        <th style="border:1px solid black;width:5%;">  Cost Centered to be Charged </th>
        <th style="border:1px solid black;width:5%;">  Cost Estimate</th>



    </tr>
    </thead>
    <tbody>';
    $i=1;
        foreach($cear_lists as $tcear)
        {
        $html.='
<tr>
        <td style="border:1px solid black;width:2%;">'.$i.'</td>
        <td style="border:1px solid black;width:5%;">'.$tcear["branch_name"].'</td>
        <td style="border:1px solid black;width:3%;">'.$tcear["dept_id"].'</td>
        <td style="border:1px solid black;width:5%;">'.$tcear["DEPT_ID"].'</td>
        <td style="border:1px solid black;width:5%;">'.$tcear["CEAR_ID"].'</td>
        <td style="border:1px solid black;width:6%;">'.$tcear["PROJECT_ID"].'</td>
        <td style="border:1px solid black;width:6%;">'.$tcear["REQ_UNIT"].'</td>
        <td style="border:1px solid black;width:6%;">'.$tcear["REQ_DEPT"].'</td>
        <td style="border:1px solid black;width:6%;">'.$tcear["SOP"].'</td>
        <td style="border:1px solid black;width:6%;">'.$tcear["PAJ"].'</td>
        <td style="border:1px solid black;width:6%;">'.$tcear["AC"].'</td>
        <td style="border:1px solid black;width:6%;">'.$tcear["CONAE"].'</td>
        <td style="border:1px solid black;width:6%;">'.$tcear["EOOBE"].'</td>
        <td style="border:1px solid black;width:6%;">'.$tcear["EP"].'</td>
        <td style="border:1px solid black;width:6%;">'.$tcear["DATE"].'</td>
        <td style="border:1px solid black;width:5%;">'.$tcear["CDATE"].'</td>
        <td style="border:1px solid black;width:5%;">'.$tcear["DFATTACHED"].'</td>
        <td style="border:1px solid black;width:5%;">'.$tcear["CONSLUSION"].'</td>
        <td style="border:1px solid black;width:5%;">'.$tcear["COST"].'</td>

        </tr>';
        $i++;
    }
    $html.='</tbody></table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output();
?>